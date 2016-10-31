<?php

class  MyHistoryAction extends Action{
    public function index()
    {
        $startRow=$_POST['startRow'];
        $pageSize=$_POST['pageSize'];
        $doctorId=$_SESSION['userMsg']['doctorId'];
        $myHistory=M("treat_record")
            ->field('base.userId,base.userName,base.sex,base.birthday,treat_record.treatRecordId,treatTime')
            ->join('user_base_info as base on treat_record.userId=base.userId')
            ->where("doctorId={$doctorId}")
            ->limit($startRow,$pageSize)
            ->select();
        $data['myHistory']=$myHistory;
        echo json_encode($data);
    }
}