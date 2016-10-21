<?php

/*                          用户信息更改
 * @param    userId                     int          用户Id
 * @param    userName                   string       用户姓名
 * @param    headPic                    string        用户头像
 * @param    tel                        string        手机号
 * @param    birthday                   string         出生日期
 * @param    sex                        string          性别
 * @param    blood                      string          血型
 * @param    stature                    string          身高
 * @param    weight                     string          体重
 * @param    userSmoking                string          有无吸烟史
 * @param    client                     int          手机型号区别，1为ios 0为android
 * return    code                       int         状态码
 *           message                    string      提示信息
 *           data                       array       返回的数据  空
 */

class UserDetailPutAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受并处理客户端POST过来的数据*/
        $userId = $_POST['userId'];
        if ($_POST['sex']) {
            switch ($_POST['sex']) {
                case '男':
                    $_POST['sex_key'] = 1;
                    break;
                case '女':
                    $_POST['sex_key'] = 2;
                    break;
                case '其他':
                    $_POST['sex_key'] = 9;
                    break;
            }
        }

        /*存储用户头像*/
        import('ORG.Net.UploadFile');
        $dir = "Public/userImages/";
        chmod($dir, '0777');
        $upload = new UploadFile();
        $upload->maxSize = "2097152";//上传的文件大小限制 (0-不做限制，1M为1048576字节)
        $upload->allowExts = array('jpg', 'png', 'gif'); //允许上传的文件后缀
        $upload->autoSub = true;//自动子目录保存文件
        $upload->subType = "date";//子目录创建方式
        $upload->savePath = $dir;//保存路径
        $upload->dateFormat = "Ymd";
        $upload->uploadReplace = true;//存在同名是否覆盖
        $info = $upload->upload();  //上传头像
        $userImageUrl = '';//用户头像地址
        if ($info) {
            /*删除以前的头像*/
            $del_headPicInfo = M("user_base_info")->field('headPic')->where("userId={$userId}")->find();
            $del_fileName = substr($del_headPicInfo['headPic'], strrpos($del_headPicInfo['headPic'], 'Public'));
            unlink($del_fileName);
            $arr = $upload->getUploadFileInfo();
            if ($arr) {
                $userImageUrl = "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $arr[0]['savepath'] . $arr[0]['savename'];
                $_POST['headPic'] = $userImageUrl;
            }
        } else {
            $_POST['headPic'] = '';
        }
        $result = M("user_base_info")->where("userId={$userId}")->save($_POST);
        if ($result) {
            $code = 1;
            $message = "个人信息修改成功";
        } else {
            $code = 0;
            $message = "个人信息修改失败";
        }
        $userInfo =  M("user_db_info")
            ->field('userName,sex_key,birthday,blood,stature,weight,userSmoking,user_db_info.userId')
            ->join("user_base_info as base on base.userId=user_db_info.userId")
            ->where("user_db_info.userId={$userId}")
            ->find();
        return Response::json($code, $message, $userInfo);
    }
}
