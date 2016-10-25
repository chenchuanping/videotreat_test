<?php

class UserFriendListAction extends Action
{

    public function add()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $relation = $_POST['relation'];
        $userName = $_POST['userName'];
        $data['userName'] = $userName;
        $data['in_friend_list'] = 1;
        //在user_db_info表中插入一条空数据
        $add_userId = M('user_db_info')->add($data);

        //在用户亲友列表中添加相应数据
        $friendListData['userId'] = $userId;
        $friendListData['friendUserId'] = $add_userId;
        $friendListData['relation'] = $relation;
        $result = M("user_friends_list")->add($friendListData);
        if ($result) {
            $code = 1;
            $message = '添加成功';
            echo Response::json($code, $message);
        } else {
            $code = 0;
            $message = '添加失败';
            echo Response::json($code, $message);
        }
    }

    /*
     * 解除绑定
     */
    public function delete()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $friendUserId = $_POST['friendUserId'];
        $result = M("user_friends_list")->where("userId={$userId} and friendUserId={$friendUserId}")->delete();
        $data['in_friend_list'] = 0;
        $result2 = M('user_db_info')->where("userId={$friendUserId}")->save($data);
        if ($result && $result2) {
            $code = 1;
            $message = '解绑成功';
            echo Response::json($code, $message);
        } else {
            $code = 0;
            $message = '解绑失败';
            echo Response::json($code, $message);
        }
    }

    public function modify()
    {
        include_once 'common/Response.class.php';
        $userId = 41;//$_POST['userId'];
        $friendUserId = 44;
        $relation = 'aaa';//$_POST['relation'];
        $userName = '张三丰';//  $_POST['userName'];
        $mod_friends_list = '';
        $mod_db_info = '';
        //修改用户关系表
        $old_relation = M("user_friends_list")->where("userId={$userId} and friendUserId={$friendUserId}")->getField("relation");
        if ($old_relation != $relation) {
            $modify_friend_data['relation'] = $relation;
            $mod_friends_list = M("user_friends_list")->where("userId={$userId} and friendUserId={$friendUserId}")->save($modify_friend_data);
        }
        //修改用户表
        $old_userName = M("user_db_info")->where("userId={$friendUserId}")->getField("userName");
        if ($old_userName != $userName) {
            $modify_db_data['userName'] = $userName;
            $mod_db_info = M('user_db_info')->where("userId={$friendUserId}")->save($modify_db_data);
        }

        if ($mod_friends_list || $mod_db_info) {
            $code = 1;
            $message = '修改成功';
            echo Response::json($code, $message);
        } else {
            $code = 0;
            $message = '修改失败';
            echo Response::json($code, $message);
        }
    }
}