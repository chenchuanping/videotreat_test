<?php

class  DetailTreatRecordAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        $treatRecordId = $_POST['treatRecordId'];
        $doctorId = $_SESSION['userMsg']['doctorId'];
        $userTreatInfo = M("treat_record")
            ->field('base.userName,userComplaint,userHPC,doctorSuggest,treatTime')
            ->join('user_base_info as base on treat_record.userId=base.userId')
            ->where("treat_record.userId={$userId} and treat_record.treatRecordId={$treatRecordId} and doctorId={$doctorId}")
            ->find();
        echo json_encode($userTreatInfo);
    }
}