<?php

class TreatRecordPutAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        /*查找自述卡中的信息*/
        $reportCardId = $_POST['reportCardId'];
        if ($reportCardId != null) {
            $reportCardInfo = M('treat_record_report_card')->where("reportCardId={$reportCardId} and userId={$userId}")->find();
            $_POST['reportCardName'] = $reportCardInfo['reportCardName'];
            $_POST['reportCardDescribe'] = $reportCardInfo['reportCardDescribe'];
            $_POST['reportCardImage'] = $reportCardInfo['reportCardImage'];
        }

        unset($_POST['reportCardId']);
        $doctorId = $_SESSION['userMsg']['doctorId'];
        $_POST['doctorId'] = $doctorId;

        /*添加到就诊记录表中*/
        $result = M("treat_record")->data($_POST)->add();
        if ($result) {
            /*清空 treat_record_report_card表中的信息*/
            M('treat_record_report_card')->where("reportCardId={$reportCardId} and userId={$userId}")->delete();

            /*如果排队还在，就删除排队*/
            $userInfo = M("user_line")->where("userId ={$userId} and doctorId={$doctorId}")->find();
            if ($userInfo) {
                M("user_line")->where("userId ={$userId} and doctorId={$doctorId}")->delete();
            }
            $data['res'] = 1;
        } else {
            $data['res'] = 0;
        }
        echo json_encode($data);
    }
}