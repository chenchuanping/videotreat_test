<?php

class JpushAction extends Action
{
    public function index()
    {
        include_once 'JPush/Client.php';
        include_once 'JPush/Config.php';
        include_once 'JPush/PushPayload.php';
        include_once 'JPush/Http.php';
        include_once 'JPush/ReportPayload.php';
        include_once 'JPush/DevicePayload.php';
        include_once 'JPush/Exceptions/APIRequestException.php';
        include_once 'JPush/Exceptions/APIConnectionException.php';
        include_once 'JPush/Exceptions/JPushException.php';
        /*Jpush的key*/
        $master_secret = '65ea9cd2feed0fe958bed712';
        $app_key = '9f4c66ea416044f26c3623d1';
        $client = new \JPush\Client($app_key, $master_secret);  //调用推送之前，先初始化JPushClient
        $push = $client->push();                              //返回一个Payload构建器
        $platform = array('ios', 'android');//设置推送平台
        $alert = '您好，有医生在呼叫您！';//alert弹出的内容
        $userId = $_POST['userId'];
        $doctorId = $_SESSION['userMsg']['doctorId'];
        $regId = M('user_db_info')->where("userId=" . $userId)->getField('imei');
        $ios_notification = array('sound' => 'default', 'badge' => '+1', 'extras' => ['userId' => $userId, 'doctorId' => $doctorId]);
        //通知提示声音和角标加1,用户的userId,用来判断用户是否登录
        $android_notification = array('title' => '云医视讯', 'extras' => ['userId' => $userId]);
        $options = array(
            'sendno' => time(),
            'time_to_live' => 0,
            'apns_production' => true,
            'big_push_duration' => 0
        );
        $response = $push->setPlatform($platform)
             ->addRegistrationId($regId)
           //   ->addAllAudience()  //广播
            ->iosNotification($alert, $ios_notification)
            ->androidNotification($alert, $android_notification)
            ->options($options);
        try {
            $result = $response->send();//发送推送
            /*设置参数*/
            $resolution = '640p';         //视频分辨率
            $vendorKey = "1546a861c05a4ab6a90529eff16cd306";      //声网的vendorKey
            $data = array();
            $data['resolution'] = $resolution;
            $data['vendorKey'] = $vendorKey;
            if ($result) {
                echo json_encode($data);
            }
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            echo "<script>alert('" . $e . "')</script>";
            return false;
        } catch (\JPush\Exceptions\APIRequestException $e) {
            echo "<script>alert('" . $e . "')</script>";
            return false;
        }
    }
}