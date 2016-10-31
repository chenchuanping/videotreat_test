<?php

class DetectionUserQueueAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $user_line = M('user_line')->where("userId={$userId}")->getField("id");

        if ($user_line) {       //用户在队列中
            $code = 1;
            $message = "在队列中";
        } else {                 //判断用户亲友在不在队列
            $friend_user_line_info = '';
            $friends = M("user_friends_list")->field('friendUserId')->where("userId={$userId}")->select();
            foreach ($friends as $v) {
                $friend_user_line_info .= M("user_line")->where("userId={$v['friendUserId']}")->find();
            }
            if ($friend_user_line_info != '') {
                $code = 1;
                $message = "在队列中";
            } else {
                $code = 0;
                $message = "不在队列中";
            }
        }
        Response::log($_POST, $code, $message);
        return Response::json($code, $message);
    }
}