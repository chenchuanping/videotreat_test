<?php

use JPush;

class JpushAction extends Action
{
    public function index()
    {
        include_once 'library/JPush/Client.php';
        include_once 'library/JPush/Config.php';
        include_once 'library/JPush/PushPayload.php';
        include_once 'library/JPush/Http.php';
        include_once 'library/JPush/ReportPayload.php';
        include_once 'library/JPush/DevicePayload.php';

        /*jpush主密码*/
        $master_secret = M("system_param")->where("paramCode='jpush_master_secret'")->getField("paramValue");
        /*jpushApKey*/
        $app_key =M("system_param")->where("paramCode='jpush_app_key'")->getField("paramValue");

        $client = new \JPush\Client($app_key, $master_secret);  //调用推送之前，先初始化JPushClient
        $push = $client->push();                              //返回一个Payload构建器
        $platform = array('ios', 'android');//设置推送平台
        $alert = '您好，有医生在呼叫您！';//alert弹出的内容

        $userId = $_POST['userId'];         //无法知道userId是自己的还是亲友的，所以要判断
        $regId = M('user_db_info')->where("userId=" . $userId)->getField('imei');
        if ($regId == '') {
            $check_friend = M("user_db_info")->where("userId={$userId}")->getField("in_friend_list");
            if ($check_friend == 1) {
                $last_userId = M("user_friends_list")->where("friendUserId={$userId}")->getField('userId');
                $regId = M('user_db_info')->where("userId=" . $last_userId)->getField('imei');
            }
        }
        $doctorId = $_SESSION['userMsg']['doctorId'];

        $ios_notification = array(
            'sound' => 'default',
            'badge' => '+1',
            'extras' => [
                'userId' => $userId,
                'doctorId' => $doctorId
            ]
        );
        //通知提示声音和角标加1,用户的userId,用来判断用户是否登录
        $android_notification = array(
            'title' => '云医视讯',
            'extras' => [
                'userId' => $userId,
                'doctorId' => $doctorId
            ]
        );
        $options = array(
            'sendno' => time(),
            'time_to_live' => 0,
            'apns_production' => false,   //上线为true,测试为false
            'big_push_duration' => 0
        );
        $response = $push->setPlatform($platform)
            ->addRegistrationId($regId)
            //   ->addAllAudience()  //广播
            ->iosNotification($alert, $ios_notification)
            ->androidNotification($alert, $android_notification)
            ->options($options);

        $result = $response->send();//发送推送

        /*设置参数*/
        //视频分辨率
        $resolution = M("system_param")->where("paramCode='agora_resolution'")->getField("paramValue");
        //声网的vendorKey
        $vendorKey = M("system_param")->where("paramCode='agora_vendorKey'")->getField("paramValue");
        $data = array();
        $data['resolution'] = $resolution;
        $data['vendorKey'] = $vendorKey;
        if ($result) {
            echo json_encode($data);
        }

    }
}