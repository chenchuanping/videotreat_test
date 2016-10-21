<?php

/*                     判断重复注册接口
 * @param tel                   string         手机号
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据     空
 */

class UserRepeatRegisterAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $tel = $_POST['tel'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $data = array();
        $code = '';
        $message = '';
        $repeatRegister = M("user_db_info")->where("tel={$tel}")->find();
        if ($repeatRegister) {
            $code = 0;
            $message = "手机号已注册！";
        } else {
            $code = 1;
            $message = "手机号未注册！";
        }
        return Response::json($code, $message, $data);
    }
}
