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
        $userInfo = M("user_base_info")
            ->field("headPic,userName,tel,birthday,sex,blood,stature,weight,userSmoking")
            ->join('user_db_info on user_db_info.userId=user_base_info.userId')
            ->where("user_base_info.userId={$userId}")
            ->find();
        if ($userInfo != null) {
            if ($userInfo['sex'] == 0) {
                $userInfo['sex'] = "男";
            } elseif ($userInfo['sex'] == 1) {
                $userInfo['sex'] = "女";
            } else {
                $userInfo['sex'] = "其他";
            }
            $data = $userInfo;
        } else {
            $data = '';
        }
        if ($data) {
            return Response::json(1, '用户信息获取成功', $data);
        } else {
            return Response::json(1, '用户信息为空', array());
        }
    }
}
