<?php

/*                          排队、取消排队接口
 * @param state                   string       判断是排队还是取消排队  join排队   leave离开排队
 * @param userId                  int         用户id
 * @param doctorId                int         医生id
 * @param reportCardId            int         自述卡Id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据  为空
 *              doctorId            int             医生Id
 *
 */

class LineInfoAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $state = $_POST['state'];
        $userId = $_POST['userId'];
        $doctorId = $_POST['doctorId'];
        $reportCardId = $_POST['reportCardId'] ? $_POST['reportCardId'] : null;
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $add_data['userId'] = $userId;
        $add_data['doctorId'] = $doctorId;
        if ($state == 'join') {
            /*当前用户已在队列中*/
            $user_line_check = M("user_line")->where("userId={$userId}")->find();
            if ($user_line_check) {
                $code = 101;
                $message = "您已经在队列中了";
            } else {              /*没有排队*/
                $doctorState = M("doctor_info")->where("doctorId={$doctorId}")->getField("stateId");
                if ($doctorState != 1) {
                    $code = 0;
                    $message = "当前医生忙碌或离开";
                } else {
                    if ($reportCardId == null) {
                        $add_data['reportCardId'] = null;
                    } else {
                        $add_data['reportCardId'] = $reportCardId;
                        /*将就诊卡的记录 复制一份到另一张数据表中*/
                        $reportCardInfo = M("user_report_card")->where("reportCardId={$reportCardId}")->find();
                        $data_repeat['reportCardId'] = $reportCardInfo['reportCardId'];
                        $data_repeat['userId'] = $reportCardInfo['userId'];
                        $data_repeat['reportCardName'] = $reportCardInfo['reportCardName'];
                        $data_repeat['reportCardDescribe'] = $reportCardInfo['reportCardDescribe'];
                        $data_repeat['reportCardImage'] = $reportCardInfo['reportCardImage'];
                        M("treat_record_report_card")->add($data_repeat);
                    }
                    /*获取系统参数，排队人数*/
                    $line_up_number = M("system_param")->where("paramCode='line_up_number'")->getField("paramValue");
                    /*获取医师当前排队人数*/
                    $doctor_line_up_num = M("user_line")->where("doctorId={$doctorId}")->count('id');
                    if ($doctor_line_up_num < $line_up_number) {
                        $result = M("user_line")->add($add_data);
                        if ($result) {
                            $code = 1;
                            $message = '加入队列成功';
                            $doctorInfo = M("doctor_info")->field("doctorId,doctorName,headPic")->where("doctorId={$doctorId}")->find();
                        } else {
                            $code = 0;
                            $message = '加入队列失败';
                        }
                    } else {
                        $code = 0;
                        $message = '当前医生排队已满，您可以等待或选择其他医师';
                    }

                }
            }
        } elseif ($state == 'leave') {
            /*当推送成功后，删除当前用户的排队*/
            $result = M("user_line")->where("userId={$userId}")->delete();
            if ($result) {
                $code = 1;
                $message = '取消排队成功';
            } else {
                $code = 0;
                $message = '取消排队失败';
            }
        }
        return Response::json($code, $message, $doctorInfo);
    }
}
