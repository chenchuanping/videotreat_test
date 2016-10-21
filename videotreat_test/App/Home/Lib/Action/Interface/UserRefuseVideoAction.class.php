<?php

/*                               退出登录接口
 * @param userId                int        用户userId
 * @param doctorId              int         医生Id
 * @param videoEndTime          string      视频结束时间
 * @param videoHistoryId        int         用户记录就诊时间Id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 */

class UserRefuseVideoAction extends Action
{
    public function index()
    {
        $userId = 3;//$_POST['userId'];
        $doctorId = 4;//$_POST['doctorId'];
        $line=M("user_line")->where("userId={$userId} and doctorId={$doctorId}")->getField('id');
        if ($line) {
            /*删除用户的排队*/
            M("user_line")->where("userId={$userId}")->delete();
            /*删除临时自述单的内容*/
            $temporary=M("treat_record_report_card")->where("userId={$userId}")->getField("id");
            if($temporary){
                M("treat_record_report_card")->where("userId={$userId}")->delete();
            }
        }
    }
}
