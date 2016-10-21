<?php

class  DetailTreatRecordAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        $treatRecordId = $_POST['treatRecordId'];
        $userTreatInfo = M("treat_record")
            ->field('db.userName,doctorName,hospitalId,userComplaint,userHPC,userPMH,doctorSuggest,reportCardDescribe,reportCardImage,treatTime')
            ->join('user_db_info as db on treat_record.userId=db.userId')
            ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
            ->where("treat_record.userId={$userId} and treat_record.treatRecordId={$treatRecordId}")
            ->find();
        $hospitalName = M("hospital_info")->where("hospitalId={$userTreatInfo['hospitalId']}")->getField('hospitalName');
        $userTreatInfo['hospitalName'] = $hospitalName;
        if ($userTreatInfo['reportCardImage']) {
            /*处理图片*/
            $reportCardImages = explode(',', $userTreatInfo['reportCardImage']);
            unset($userTreatInfo['reportCardImage']);

            $userTreatInfo['reportCardImages'] = $reportCardImages;
            /*
             *  /处理图片/
            $reportCardImages = explode(',', $userTreatInfo['reportCardImage']);
            unset($userTreatInfo['reportCardImage']);
            /获取图片的宽高/
            foreach ($reportCardImages as $k => $value) {
                $imageInfo=getimagesize($value);
                $width=$imageInfo[0];
                $hight=$imageInfo[1];
                $userTreatInfo['reportCardImageInfo'][$k]['width']=$width;
                $userTreatInfo['reportCardImageInfo'][$k]['height']=$hight;
                $userTreatInfo['reportCardImageInfo'][$k]['image']=$value;
            }*/
        } else {
            $userTreatInfo['reportCardImages'] = '';
        }
        $data['userTreatInfo'] = $userTreatInfo;
        unset($userTreatInfo['reportCardImage']);
        echo json_encode($data);
    }
}