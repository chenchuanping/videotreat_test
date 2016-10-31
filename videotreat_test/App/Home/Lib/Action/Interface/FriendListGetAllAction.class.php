<?php

class FriendListGetAllAction extends Action
{

    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        //得到当前用户的所有亲友id
        $friendUserIdArray = M('user_friends_list')->field("friendUserId")->where("userId={$userId}")->select();
        if ($friendUserIdArray) {
            foreach ($friendUserIdArray as $k => $value) {
                $userInfo[] = M("user_db_info")
                    ->field('user_db_info.userId,headPic,userName,sex_value,birthday,blood,stature,weight,userSmoking')
                    ->join("user_base_info as base on base.userId=user_db_info.userId")
                    ->join('dic_user_sex as sex on sex.sex_key=user_db_info.sex_key')
                    ->where("user_db_info.userId={$value['friendUserId']} and user_db_info.in_friend_list=1")
                    ->find();
            }

            foreach ($userInfo as $k => $value) {
                $value['sex'] = $value['sex_value'];
                if ($value['sex'] == null) {
                    $value['sex'] = '';
                }
                unset($value['sex_value']);
                $userInfo[$k] = $value;
            }
            if ($userInfo) {
                $code = 1;
                $message = "亲友列表获取成功";
                $data = $userInfo;
            }
        } else {
            $code = 1;
            $message = "亲友列表为空";
            $data = '';
        }
        Response::log($_POST, $code, $message, $data);
        return Response::json($code, $message, $data);
    }

}