<?php

/*                             用户信息获取
 * @param userId                   int         用户Id
 * @param client                   int        手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *           userName                   string       用户姓名
 *           headPic                  string       用户头像链接
 *           tel                        string        手机号
 *           birthday                   string         出生日期
 *           sex                        string          性别
*            blood                       string          血型
 *           stature                    string          身高
 *           weight                     string          体重
 *           userSmoking                string          有无吸烟史
 */

class UserDetailGetAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $check = M('user_db_info')->where("userId={$userId}")->getField('userId');

        if ($check) {
            $userInfo = M("user_db_info")
                ->field("user_db_info.userId,headPic,userName,tel,birthday,sex_value,blood,stature,weight,userSmoking")
                ->join('user_base_info as base on user_db_info.userId=base.userId')
                ->join('dic_user_sex on user_db_info.sex_key=dic_user_sex.sex_key')
                ->where("user_db_info.userId={$userId}")
                ->find();
            $userInfo['sex'] = $userInfo['sex_value'];
            if ($userInfo['sex'] == null) {
                $userInfo['sex'] = '';
            }
            unset($userInfo['sex_value']);
            if ($userInfo) {
                $code = 1;
                $message = '用户信息获取成功';
                $data = $userInfo;
            } else {
                $code = 1;
                $message = '用户信息为空';
                $data = array();
            }
        } else {
            $code = 0;
            $message = '用户不存在';
        }

        return Response::json($code, $message, $data);
    }
}
