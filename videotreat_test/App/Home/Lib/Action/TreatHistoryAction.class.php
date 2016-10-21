<?php

class  TreatHistoryAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        if ($userId) {
            $userTreatInfo = M("treat_record")
                ->field('db.userName,treatRecordId,treat_record.doctorId,doctorName,hospitalId,userComplaint,treatTime')
                ->join('user_db_info as db on treat_record.userId=db.userId')
                ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
                ->where("treat_record.userId={$userId}")
                ->order('treatTime')
                ->select();
            foreach($userTreatInfo as  $k=>$v){
                $hospitalName=M("hospital_info")->where("hospitalId={$v['hospitalId']}")->getField('hospitalName');
                $userTreatInfo[$k]['hospitalName']=$hospitalName;
                $userTreatInfo[$k]['userId'] = $userId;
            }
            $data['userTreatInfo'] = $userTreatInfo;
        } else {
            $data['userTreatInfo'] = '';
        }
        echo json_encode($data);
    }
}