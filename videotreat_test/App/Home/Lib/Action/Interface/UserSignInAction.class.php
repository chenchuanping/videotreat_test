<?php

/*                          用户签到页面接口
 * @param userId                  int          用户id
 * @param signInDate             int          签到日期
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 *           signInDate                 array           签到的日期   2，3，4,...
 */

class UserSignInAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $signInDate = $_POST['signInDate'];     //签到日期
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $date['signInDate'] = $signInDate;
        $date['signIn'] = 1;          /*表示已签到*/
        $date['userId'] = $userId;

        //判断当天有没有签到过
        $user_sign = M("user_sign_in")->where("userId={$userId} and signInDate={$signInDate}")->find();
        if (!$user_sign) {     //未签到过
            /*将签到日期保存到数据库*/
            $result = M("user_sign_in")->where("userId={$userId}")->data($date)->add();
            if (!$result) {
                $code = 0;
                $message = "签到失败";
            } else {
                $code = 1;
                $message = "签到成功";
            }
        } else {
            $code = 101;
            $message = "已签到";
            $data = array();
        }
        $userSignInInfo = M("user_sign_in")
            ->field('signInDate')
            ->where("userId={$userId}")
            ->order('signInDate')
            ->select();
        foreach ($userSignInInfo as $item) {
            $signInDateList[] = $item['signInDate'];
        }
        $data['signInDate'] = $signInDateList;
        if ($data) {
            Response::log($_POST, $code, $message, $data);
            return Response::json($code, $message, $data);
        } else {
            Response::log($_POST, $code, $message);
            return Response::json($code, $message, array());
        }
    }
}
