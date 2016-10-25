<?php

/*                               用户登录验证接口
 * @param userId                  int         用户Id
 * @param imei                  string      手机imei
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 *
 */

class UserLoginVerifyAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';

        $userId =  $_POST['userId'];
        $imei =  $_POST['imei'];
        $user_login_imei = M('user_db_info')->where("userId={$userId}")->getField('imei');
        if ($user_login_imei != '') {
            if ($user_login_imei != $imei) {
                include_once 'library/JPush/Client.php';
                include_once 'library/JPush/Config.php';
                include_once 'library/JPush/PushPayload.php';
                include_once 'library/JPush/Http.php';
                include_once 'library/JPush/ReportPayload.php';
                include_once 'library/JPush/DevicePayload.php';

                /*Jpush的key*/
                $master_secret = '65ea9cd2feed0fe958bed712';
                $app_key = '9f4c66ea416044f26c3623d1';

                $client = new JPush\Client($app_key, $master_secret);  //调用推送之前，先初始化JPushClient

                $push = $client->push();                              //返回一个Payload构建器
                $platform = array('ios', 'android');//设置推送平台
                $alert = '您的账号在别处登录，如果非您本人操作，请尽快修改密码！';//alert弹出的内容
                $regId = $user_login_imei;

                $ios_notification = array('sound' => 'default', 'badge' => '+1');
                $options = array(
                    'sendno' => time(),
                    'time_to_live' => 86400,
                    'apns_production' => false,   //上线为true,测试为false
                    'big_push_duration' => 0
                );
                $response = $push->setPlatform($platform)
                    ->addRegistrationId($regId)
                    ->iosNotification($alert, $ios_notification)
                    ->androidNotification($alert)
                    ->options($options);
                $result = $response->send();//发送推送
                if ($result) {
                    echo Response::json(1, '推送成功');
                }
            }
        }
    }
}