<?php

/*                              用户修改密码接口
 * @param userId                string        用户userId
 * @param tel                   string        用户手机号
 * @param old_pwd              string        用户旧密码
 * @param new_pwd              string        用户新密码
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 */

class UserModifyPWDAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $tel = trim($_POST['tel']);
        $old_pwd = $_POST['old_pwd'];
        $new_pwd = $_POST['new_pwd'];
        $old_pwd = md5($old_pwd);
        $new_pwd = md5($new_pwd);
        $userInfo = M("user_db_info")->where("tel='%s' and password='%s'", array($tel, $old_pwd))->find();
        if ($userInfo) {
            $new['password'] = $new_pwd;
            $changePWD = M("user_db_info")->where("userId={$userId}")->save($new);
            if ($changePWD) {
                $code = 1;
                $message = "修改密码成功";
            } else {
                $code = 0;
                $message = "新旧密码一致";
            }
        } else {
            $code = 0;
            $message = "旧密码不正确";
        }
        return Response::json($code, $message);
    }
}
