<?php

class UnbindFriendListAction extends Action
{

    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $friendUserId = $_POST['friendUserId'];
        $result = M("user_friends_list")->where("userId={$userId} and friendUserId={$friendUserId}")->delete();
        $data['in_friend_list'] = 0;
        $result2 = M('user_db_info')->where("userId={$friendUserId}")->save($data);
        if ($result && $result2) {
            $code = 1;
            $message = '解除绑定成功';
            return Response::json($code, $message);
        } else {
            $code = 0;
            $message = '解除绑定失败';
            return Response::json($code, $message);
        }
    }
}