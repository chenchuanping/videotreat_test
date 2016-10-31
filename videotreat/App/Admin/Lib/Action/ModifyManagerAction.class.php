<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:46
 */
class ModifyManagerAction extends BaseAction{
    public function index($managerId,$hospitalId)
    {
      if($hospitalId!='all') {          //不是超级管理员  ，超级管理员不做修改功能
           $managerInfo = M("manager_info")->field("manager_info.managerId,managerName,roleName,hospital_info.hospitalId,hospital_info.hospitalName")
               ->join("manager_hospital on manager_hospital.managerId=manager_info.managerId")
               ->join("hospital_info on hospital_info.hospitalId=manager_hospital.hospitalId")
               ->join("role on role.roleId=manager_info.roleId")
               ->where("manager_info.managerId={$managerId} and manager_hospital.hospitalId={$hospitalId}")
               ->find();
     }
        /*所有医院*/
        $hospitalInfo=M("hospital_info")->field("hospitalId,hospitalName")->select();
        $this->assign("managerInfo",$managerInfo);
        $this->assign("hospitalInfo",$hospitalInfo);
        $this->display();
    }
    public function modify()
    {
        header('content-type:text/html;charset=utf-8');
        $hospitalId=$_POST['old_hospitalId'];            //未修改前的医院Id
        $data['managerId']=$_POST['managerId'];
        $data['hospitalId']=$_POST['hospitalId'];
        $result=M("manager_hospital")->where("managerId={$_POST['managerId']} and hospitalId={$hospitalId}")->save($data);
        if($result){
            /*添加管理员日志*/
            $managerName=M('manager_info')->where("managerId={$_POST['managerId']}")->getField("managerName");
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=3;
            $log['operationContent']="修改了管理员：".$managerName;
            M("manager_log")->add($log);
            $this->redirect("ManagerInfo/index",$_SESSION,2,"修改信息成功");
        }else{
            $this->redirect("ManagerInfo/index",$_SESSION,2,"修改信息失败");
        }
    }

    public function delete($managerId,$hospitalId)
    {
        header('content-type:text/html;charset=utf-8');
        /*删除管理员——医院表中的对应数据*/
        $result=M("manager_hospital")->where("managerId={$managerId} and hospitalId={$hospitalId}")->delete();
        $manager_hospital=M("manager_hospital")->where("managerId={$managerId}")->find();
        if($manager_hospital==null){
            /*删除管理员，将isDel变为1*/
            $data['isDel']=1;
          $result=  M("manager_info")->where("managerId={$managerId}")->save($data);
        }
        if($result){
            /*添加管理员日志*/
            $managerName=M('manager_info')->where("managerId={$managerId}")->getField("managerName");
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=2;
            $log['operationContent']="删除了管理员：".$managerName;
            M("manager_log")->add($log);
            $this->redirect("ManagerInfo/index",$_SESSION,1,"删除成功");
        }else{
            $this->redirect("ManagerInfo/index",$_SESSION,1,"删除失败");
        }
    }
}