<?php

/*                               退出登录接口
 * @param userId                int        用户userId
 * @param doctorId              int         医生Id
 * @param type                  string      refuse   noResponse
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 */

class UserRefuseVideoAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        $userId = $_POST['userId'];
        $doctorId = $_POST['doctorId'];
        $type = $_POST['type'];

        $line = M("user_line")->where("userId={$userId} and doctorId={$doctorId}")->getField('id');
        if ($line) {
            /*删除用户的排队*/
            M("user_line")->where("userId={$userId}")->delete();
            /*删除临时自述单的内容*/
            $temporary = M("treat_record_report_card")->where("userId={$userId}")->getField("id");
            if ($temporary) {
                M("treat_record_report_card")->where("userId={$userId}")->delete();
            }
            if ($type == 'refuse') {
                $code = 1;
                $message = "拒绝进入";
            } elseif ($type == 'noResponse') {
                $code = 1;
                $message = "无应答";
            } else {
                $code = 0;
                $message = "参数错误";
            }
            $data['userId'] = $userId;
            $data['doctorId'] = $doctorId;
            $data['videoStartTime'] = date("Y-m-d H:i:s");
            $data['videoEndTime'] = date("Y-m-d H:i:s");
            $data['videoDuration'] = 0;
            M("video_history")->add($data);
            Response::log($_POST, $code, $message);
            return Response::json($code, $message);
        }
    }
}
