<?php

/*                               退出登录接口
 * @param userId                int        用户userId
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
        $videoDuration = $_POST['videoDuration'] ? $_POST['videoDuration'] : "";
        $data['userId'] = $userId;
        $data['doctorId'] = $doctorId;
        $data['videoDuration'] = $videoDuration;
        $add = M("video_history")->add($data);
        if ($add) {
            /*删除用户的排队*/
            M("user_line")->where("userId={$userId}")->delete();
            /*删除临时自述单的内容*/
            M("treat_record_report_card")->where("userId={$userId}")->delete();
        }
    }
}
