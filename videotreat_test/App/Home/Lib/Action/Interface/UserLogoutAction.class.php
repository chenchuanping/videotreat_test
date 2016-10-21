<?php

/*                               用户退出登录接口
 * @param userId                int        用户Id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 */

class UserLogoutAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        //退出登录时把imei清除
        $data_logout['imei'] = '';
        $logout = M("user_db_info")->where("userId='%d'", $userId)->save($data_logout);
        if ($logout) {
            $code = 1;
            $message = "退出登录成功";
        } else {
            $code = 0;
            $message = "退出登录失败";
        }
        return Response::json($code, $message);
    }
}
