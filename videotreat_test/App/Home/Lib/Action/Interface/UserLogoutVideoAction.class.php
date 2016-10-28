<?php

/*                               用户退出视频接口
 * @param userId                int         用户userId
 * @param doctorId              int         医生Id
 * @param videoStartTime        string      视频开始时间戳
 * @param videoEndTime          string      视频结束时间戳
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
        $videoStartTime = date('Y-m-d H:i:s', substr($videoStartTime, 0, 10));
        $videoEndTime = date('Y-m-d H:i:s', substr($videoEndTime, 0, 10));
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

        if ($second < 0) {
            $second = 60 + $second;
            $minute = $minute - 1;
        } elseif ($second < 10) {
            $second = "0" . $second;
        }

        $data['videoDuration'] = $minute . ":" . $second;

        $add = M("video_history")->add($data);
        if ($add) {

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
