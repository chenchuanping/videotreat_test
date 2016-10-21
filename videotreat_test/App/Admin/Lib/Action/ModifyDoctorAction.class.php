<?php
class  ModifyDoctorAction extends BaseAction{
    public function delete($doctorId)
    {
        header('content-type:text/html;charset=utf-8');
        /*将医院表中的del字段改为0*/
        $data['isDel']=1;         //1表示删除
        $result=M("doctor_info")->where("doctorId={$doctorId}")->save($data);
        if($result){
            /*添加管理员日志*/
            $doctorName=M('doctor_info')->where("doctorId={$doctorId}")->getField("doctorName");
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=2;
            $log['operationContent']="删除了医生：".$doctorName;
            M("manager_log")->add($log);

            $this->redirect("DoctorInfo/index",null,1,'删除医生成功');
        }else{
            $this->redirect("DoctorInfo/index",null,1,'删除医生失败');
        }
    }

}