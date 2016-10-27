<?php

class ModFriendListAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $friendUserId = $_POST['friendUserId'];
        $userName = $_POST['userName'];
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];
        $blood = $_POST['blood'];
        $stature = $_POST['stature'];
        $weight = $_POST['weight'];
        $smoking = $_POST['userSmoking'];
        $mod_friends_list = '';
        $mod_db_info = '';
        if ($sex) {
            switch ($sex) {
                case '男':
                    $sex = 1;
                    break;
                case '女':
                    $sex = 2;
                    break;
                case '其他':
                    $sex = 9;
                    break;
            }
        }
        /*存储用户头像*/
        import('ORG.Net.UploadFile');
        $dir = "Public/userImages/";
        chmod($dir, '0777');
        $upload = new UploadFile();
        $upload->maxSize = "10485760";//上传的文件大小限制 (0-不做限制，1M为1048576字节)
        $upload->allowExts = array('jpg', 'png', 'gif'); //允许上传的文件后缀
        $upload->autoSub = true;//自动子目录保存文件
        $upload->subType = "date";//子目录创建方式
        $upload->savePath = $dir;//保存路径
        $upload->dateFormat = "Ymd";
        $upload->uploadReplace = true;//存在同名是否覆盖
        $info = $upload->upload();  //上传头像
        $userImageUrl = M("user_base_info")->where("userId={$friendUserId}")->getField('headPic');//用户头像地址
        if ($info) {
            /*删除以前的头像*/
            $del_headPicInfo = M("user_base_info")->field('headPic')->where("userId={$friendUserId}")->find();
            if ($del_headPicInfo) {
                $del_fileName = substr($del_headPicInfo['headPic'], strrpos($del_headPicInfo['headPic'], 'Public'));
                unlink($del_fileName);
            }
            $arr = $upload->getUploadFileInfo();
            if ($arr) {
                $userImageUrl = "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $arr[0]['savepath'] . $arr[0]['savename'];
            }
        }
        //修改用户表

        $modify_db_data['userName'] = $userName;
        $modify_db_data['sex_key'] = $sex;
        $modify_db_data['birthday'] = $birthday;
        $mod_db_info = M('user_db_info')->where("userId={$friendUserId}")->save($modify_db_data);

        //修改base表
        $modify_base_data['blood'] = $blood;
        $modify_base_data['stature'] = $stature;
        $modify_base_data['weight'] = $weight;
        $modify_base_data['userSmoking'] = $smoking;
        $modify_base_data['headPic'] = $userImageUrl;
        $mod_base_info = M('user_base_info')->where("userId={$friendUserId}")->save($modify_base_data);

        //修改亲友关系表
        $modifyTime['modifyTime'] = date("Y-m-d H:i:s");
        M("user_friends_list")->where("userId={$userId} and friendUserId={$friendUserId}")->save($modifyTime);


        if ($mod_base_info || $mod_db_info) {
            $code = 1;
            $message = '修改成功';
            $userInfo = M("user_db_info")
                ->field('user_db_info.userId,headPic,userName,sex_value,birthday,blood,stature,weight,userSmoking')
                ->join("user_base_info as base on base.userId=user_db_info.userId")
                ->join('dic_user_sex as sex on sex.sex_key=user_db_info.sex_key')
                ->where("user_db_info.userId={$friendUserId}")
                ->find();
            $userInfo['sex'] = $userInfo['sex_value'];
            unset($userInfo['sex_value']);
            return Response::json($code, $message, $userInfo);
        } else {
            $code = 0;
            $message = '修改失败';
            return Response::json($code, $message);
        }
    }
}