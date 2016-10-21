<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/20
 * Time: 16:37
 */
class  VideoHangUpAction extends Action
{
    public function disconnect()
    {
        $userId = $_POST['userId'];
        $doctorId = $_POST['doctorId'];
        /*检测医师是否还在视频中*/
        $doctor_isInVideo=M('doctor_info')->where("doctorId={$doctorId}")->getField("isInVideo");
        if($doctor_isInVideo==1){
            $isInVideo['isInVideo'] = 0;
            M("doctor_info")->where("doctorId={$doctorId}")->save($isInVideo);
        }
        $data['res']=1;
        echo json_encode($data);
    }
}