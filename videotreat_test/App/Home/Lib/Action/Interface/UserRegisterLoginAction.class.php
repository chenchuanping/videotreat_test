<?php

/*                               登录注册找回密码接口
 * @param type                  string         类型  登录 login  注册 register  重置密码  resetPwd
 * @param tel                   string         手机号
 * @param password              string          密码   md5加密
 * @param imei                  string          登录时使用，传入设备ID 用于推送
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 *              userId                  int             用户登录成功后 给客户端传一个userId
 */

class UserRegisterLoginAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $type = $_POST['type'];
        $tel = $_POST['tel'];
        $password = $_POST['password'];
        $password = md5($password);
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $code = '';
        $message = '';
        if ($type == 'register') {          /*注册*/
            $userData['tel'] = $tel;
            $userData['password'] = $password;
            $userData['client '] = $client;
            $userInfo = M("user_db_info")->where("tel='{$userData['tel']}'")->find();
            if ($userInfo) {
                $code = 101;
                $message = "手机号已注册";
                $userId = $userInfo['userId'];
            } else {
                $result = M("user_db_info")->data($userData)->add();
                if ($result > 0) {
                    $code = 1;
                    $message = "注册成功";
                    $userId = $result;
                    /*初始化基本信息*/
                    $user_base['userId'] = $userId;
                    M("user_base_info")->data($user_base)->add();
                } else {
                    $message = "注册失败";
                }
            }
        } elseif ($type == 'login') {                          /*登录*/
            $imei = $_POST['imei'];
            /*首先判断用户存不存在*/
            $userInfo = M("user_db_info")->where("tel='%s'", $tel)->find();
            if ($userInfo) {
                $userId = $userInfo['userId'];
                $userInfoCheck = M("user_db_info")->where("tel='%s' and password='%s'", array($tel, $password))->find();
                if ($userInfoCheck) {
                    if ($userInfoCheck['imei'] == '') {
                        $data_login['imei'] = $imei;
                        $data_login['client'] = $client;
                        M("user_db_info")->where("userId={$userId}")->save($data_login);
                    }
                    $code = 1;
                    $message = "登录成功";

                } else {
                    $code = 0;
                    $message = "用户名和密码不匹配";
                }
            } else {
                $code = 0;
                $message = "用户不存在";
            }
        } elseif ($type == 'resetPwd') {                    /*重置密码*/
            /* $password  作为新密码*/
            $userInfo = M("user_db_info")->where("tel='%s'", $tel)->find();
            if ($userInfo) {
                $userId = $userInfo['userId'];
                /*密码一样，重置密码为空*/
                if ($userInfo['password'] == $password) {
                    $newPwd['password'] = '';
                    M("user_db_info")->where("userId={$userId}")->save($newPwd);
                }
                $newPwd['password'] = $password;
                $result = M("user_db_info")->where("userId={$userId}")->save($newPwd);
                if ($result) {
                    $code = 1;
                    $message = "重置密码成功";
                } else {
                    $code = 0;
                    $message = "重置密码失败";
                }
            } else {
                $code = 0;
                $message = "用户不存在";
            }
        }
        Response::log($_POST, $code, $message, (int)$userId);
        return Response::json($code, $message, (int)$userId);
    }
}
