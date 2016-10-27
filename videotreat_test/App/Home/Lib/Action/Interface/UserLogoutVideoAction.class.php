<?php

/*                               用户退出视频接口
 * @param userId                int         用户userId
 * @param doctorId              int         医生Id
 * @param videoStartTime        string      视频开始时间
 * @param videoEndTime          string      视频结束时间
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 */

class UserLogoutVideoAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $doctorId = $_POST['doctorId'];
        $videoStartTime = $_POST['videoStartTime'];
        $videoEndTime = $_POST['videoEndTime'];


        $data['userId'] = $userId;
        $data['doctorId'] = $doctorId;
        $data['videoStartTime'] = $videoStartTime;
        $data['videoEndTime'] = $videoEndTime;
        /*处理视频时间*/
        $start = $videoStartTime;
        $start_minute = substr($start, strpos($start, ':') + 1, 2);
        $start_second = substr($start, strrpos($start, ':') + 1, 2);
        $end_minute = substr($videoEndTime, strpos($videoEndTime, ':') + 1, 2);
        $end_second = substr($videoEndTime, strrpos($videoEndTime, ':') + 1, 2);
        $minute = $end_minute - $start_minute;
        $second = $end_second - $start_second;
        if ($second < 10) {
            $second = "0" . $second;
        }
        $data['videoDuration'] = $minute . ":" . $second;

        $add = M("video_history")->add($data);
        if ($add) {
            /*添加用户行为*/
            $behaviourInfo = M("user_behaviour")->where("userId={$userId}")->find();
            $behaviourData['behaviourName'] = "退出视频";
            if (!$behaviourInfo) {
                $behaviourData['userId'] = $userId;
                M("user_behaviour")->add($behaviourData);
            } else {
                $behaviourData['userId'] = $userId;
                $behaviourData['create_time'] = date("Y-m-d H:i:s");
                M("user_behaviour")->where("behaviourId={$behaviourInfo['behaviourId']}")->save($behaviourData);
            }
            /*删除用户的排队*/
            $del_line = M("user_line")->where("userId={$userId}")->delete();
            /*删除临时自述单的内容*/
            $temporary = M("treat_record_report_card")->where("userId={$userId}")->getField("id");
            if ($temporary) {
                $del_report = M("treat_record_report_card")->where("id={$temporary}")->delete();
            } else {
                $del_report = true;
            }
            if ($del_line && $del_report) {
                $code = 1;
                $message = '挂断视频成功';
            } else {
                $code = 0;
                $message = '挂断视频失败';
            }

        } else {
            $code = 0;
            $message = '填写视频记录失败';
        }
        return Response::json($code, $message);
    }
}
