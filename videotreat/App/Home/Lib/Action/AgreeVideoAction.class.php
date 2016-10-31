<?php
class AgreeVideoAction extends Action{
    public function index()
    {
        $userId=$_POST['userId'];
        $doctorId=$_POST['doctorId'];
        $RespResult=0;
        switch($RespResult){
            case 0:
                $msg='连接成功';
                break;
            case 1:
                $msg='连接错误';
                break;
            case 3:
                $msg='网络故障';
        }
        $data=array(
            'RespResult'=>$RespResult,
            'msg'=>$msg,
            'userId'=>$userId,
            'doctorId'=>$doctorId
        );
        echo json_encode($data);
    }
}