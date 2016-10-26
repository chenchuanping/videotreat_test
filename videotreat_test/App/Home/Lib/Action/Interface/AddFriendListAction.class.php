<?php

class AddFriendListAction extends Action
{

    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];
        $stature = $_POST['stature'];
        $weight = $_POST['weight'];
        $smoking = $_POST['userSmoking'];
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
        $userImageUrl = '';//用户头像地址
        if ($info) {
            $arr = $upload->getUploadFileInfo();
            if ($arr) {
                $userImageUrl = "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $arr[0]['savepath'] . $arr[0]['savename'];
            }
        }
        /*分别加入user_db_info  user_base_info 表中*/
        $db_data['userName'] = $userName;
        $db_data['in_friend_list'] = 1;
        $db_data['sex_key'] = $sex;
        $db_data['birthday'] = $birthday;
        //在user_db_info表中插入一条数据
        $add_userId = M('user_db_info')->add($db_data);
        //在user_base_info表中插入一条数据
        $base_data['userId'] = $add_userId;
        $base_data['stature'] = $stature;
        $base_data['weight'] = $weight;
        $base_data['headPic'] = $userImageUrl;
        $base_data['userSmoking'] = $smoking;
        $base_result = M("user_base_info")->add($base_data);
        if ($add_userId && $base_result) {
            //在用户亲友列表中添加相应数据
            $friendListData['userId'] = $userId;
            $friendListData['friendUserId'] = $add_userId;
            $result = M("user_friends_list")->add($friendListData);
            if ($result) {
                $code = 1;
                $message = '添加亲友成功';
                $userInfo = M("user_db_info")
                    ->field('user_db_info.userId,headPic,userName,sex_key,birthday,blood,stature,weight,userSmoking')
                    ->join("user_base_info as base on base.userId=user_db_info.userId")
                    ->where("user_db_info.userId={$add_userId}")
                    ->find();
                if ($userInfo['sex_key']) {
                    switch ($sex) {
                        case 1:
                            $userInfo['sex'] = '男';
                            break;
                        case 2:
                            $userInfo['sex'] = '女';
                            break;
                        case 9:
                            $userInfo['sex'] = '其他';
                            break;
                    }
                }
                unset($userInfo['sex_key']);
                return Response::json($code, $message, $userInfo);
            } else {
                $code = 0;
                $message = '添加亲友失败';
                return Response::json($code, $message);
            }
        } else {
            $code = 0;
            $message = '添加亲友失败';
            return Response::json($code, $message);
        }
    }

}