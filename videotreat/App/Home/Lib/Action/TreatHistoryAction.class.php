<?php

class  TreatHistoryAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        $doctorId = $_SESSION['userMsg']['doctorId'];
        if ($userId && $doctorId) {
            $userTreatInfo = M("treat_record")
                ->field('base.userName,userComplaint,userHPC,userPMH,doctorSuggest,remark,reportCardDescribe,reportCardImage,treatTime')
                ->join('user_base_info as base on treat_record.userId=base.userId')
                ->where("treat_record.userId={$userId}  and doctorId={$doctorId}")
                ->select();
            foreach($userTreatInfo as  $k=>$v){
                $userTreatInfo[$k]['userId'] = $userId;
                $userTreatInfo[$k]['doctorId'] = $doctorId;
            }
            $data['userTreatInfo'] = $userTreatInfo;
        } else {
            $data['userTreatInfo'] = '';
        }
        echo json_encode($data);
    }
}