<?php

/*                               用户退出视频接口
 * @param userId                int        用户userId
 * @param doctorId              int         医生Id
 * @param videoEndTime          string      视频结束时间
 * @param videoHistoryId        int         用户记录就诊时间Id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 */

class UserLogoutVideoAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        $doctorId = $_POST['doctorId'];
        $videoEndTime = $_POST['videoEndTime'];
        $videoHistoryId = $_POST['videoHistoryId'];
        $data['userId'] = $userId;
        $data['doctorId'] = $doctorId;
        $data['videoEndTime'] = $videoEndTime;
        /*处理视频时间*/
        $start = M("video_history")->where("id={$videoHistoryId}")->getField('videoStartTime');
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
        $result = M("video_history")->where("id={$videoHistoryId}")->save($data);
        if ($result) {
            /*删除用户的排队*/
            M("user_line")->where("userId={$userId}")->delete();
            /*删除临时自述单的内容*/
            M("treat_record_report_card")->where("userId={$userId}")->delete();
        }
    }
}
