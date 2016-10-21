<?php

/*                               用户进入视频接口
 * @param userId                  int         用户Id
 * @param doctorId                int         医生Id
 * @param videoStartTime        string       视频开始时间
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 *            videoHistoryId          int   用户记录就诊时间Id
 */

class UserLoginVideoAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        $userId =3;// $_POST['userId'];
        $doctorId = 4;//$_POST['doctorId'];
        $videoStartTime = '2016-10-21 12:11:00';// $_POST['videoStartTime'];
        $doctor_isInVideo = M("doctor_info")->where("doctorId={$doctorId}")->getField("isInVideo");
        if ($doctor_isInVideo == 1) {
            /*添加用户行为*/
            $behaviourInfo=M("user_behaviour")->where("userId={$userId}")->find();

            var_dump($behaviourInfo);exit;
            $behaviourData['behaviourName'] = "进入视频";
            if($behaviourInfo){
                $behaviourData['userId'] = $userId;
                M("user_behaviour")->add($behaviourData);
            }else{
                $behaviourData['userId'] = $userId;
                $behaviourData['create_time']=date("Y-m-d H:i:s");
                M("user_behaviour")->where("behaviourId={$behaviourInfo['behaviourId']}")->save($behaviourData);
            }

            /*添加用户视频开始时间*/
            $videoData['doctorId'] = $doctorId;
            $videoData['userId'] = $userId;
            $videoData['videoStartTime'] = $videoStartTime;
            $videoHistoryId = M("video_history")->data($videoData)->add();
            $code = 1;
            $message = '医生在视频中';
        } else {
            $code = 0;
            $message = '医生不在视频中';
        }
        return Response::json($code, $message, $videoHistoryId);
    }
}
