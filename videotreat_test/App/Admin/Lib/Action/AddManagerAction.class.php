<?php
class  AddManagerAction extends BaseAction{
    public function index()
    {
        /*角色*/
        $roleInfo=M("role")->select();
        //查询所有医院信息
        $hospitalInfo=M('hospital_info')->select();
        $this->assign('hospitalInfo',$hospitalInfo);
        $this->assign("roleInfo",$roleInfo);

        $this->display();
    }
    public function add()
    {
        header('content-type:text/html;charset=utf-8');
        /*处理密码*/
        if($_POST['password']){
            $_POST['password']=md5($_POST['password']);
        }
        /*处理角色*/
        if($_POST['roleId']==1){        //超级管理员
            $manager_data['managerName']=$_POST['managerName'];
            $manager_data['password']=$_POST['password'];
            $manager_data['roleId']=$_POST['roleId'];
            /*判断超级管理员是否存在在表中*/
            $manager_exists=M("manager_info")->where("managerName='{$_POST['managerName']}' and password='{$_POST['password']}'")->find();
            if($manager_exists){
                $this->redirect("ManagerInfo/index",$_SESSION,1,'已存在超级管理员');
                return false;
            }else{
                /*添加到管理员表中*/
                $result=M("manager_info")->add($manager_data);
                if($result){
                    /*添加管理员日志*/
                    $log['managerId']=$_SESSION['userMsg']['managerId'];
                    $log['operationId']=1;
                    $log['operationContent']="添加了超级管理员：".$_POST['managerName'];
                    M("manager_log")->add($log);
                    $this->redirect("ManagerInfo/index",$_SESSION,1,'添加超级管理员成功');
                }else {
                    $this->redirect("ManagerInfo/index",$_SESSION,1,'添加超级管理员失败');
                }
            }
        }elseif($_POST['roleId']==2){                          //普通管理员
            $common_data['managerName']=$_POST['managerName'];
            $common_data['password']=$_POST['password'];
            $common_data['roleId']=$_POST['roleId'];
            /*判断管理员是否存在*/
            $manager_exists=M("manager_info")->where("managerName='{$_POST['managerName']}' and password='{$_POST['password']}' and roleId={$_POST['roleId']}")->find();
            if(!$manager_exists){               //管理员不存在
                /*添加到管理员表中*/
                $result=M("manager_info")->add($common_data);
                $manager_hospital['managerId']=$result;//新加记录的主键值，作为管理员Id
                $manager_hospital['hospitalId']=$_POST['hospitalId'];//普通管理员对应的医院Id
                /*添加到管理员——医院表中*/
                $add=M("manager_hospital")->add($manager_hospital);
            }else{
                $manager_hospital['managerId']=M("manager_info")->where("managerName='{$_POST['managerName']}' and password='{$_POST['password']}' and roleId={$_POST['roleId']}")->getField("managerId");
                $manager_hospital['hospitalId']=$_POST['hospitalId'];//普通管理员对应的医院Id
                /*添加到管理员——医院表中*/
                $add=M("manager_hospital")->add($manager_hospital);
            }
            if($result||$add){
                /*添加管理员日志*/
                $log['managerId']=$_SESSION['userMsg']['managerId'];
                $log['operationId']=1;
                $log['operationContent']="添加了普通管理员：".$_POST['managerName'];
                M("manager_log")->add($log);
                $this->redirect("ManagerInfo/index",$_SESSION,1,'添加普通管理员成功');
            }else {
                $this->redirect("ManagerInfo/index",$_SESSION,1,'添加普通管理员失败');
            }
        }elseif($_POST['roleId']==3){                          //财务统计人员
            $common_data['managerName']=$_POST['managerName'];
            $common_data['password']=$_POST['password'];
            $common_data['roleId']=$_POST['roleId'];
            /*判断管理员是否存在*/
            $manager_exists=M("manager_info")->where("managerName='{$_POST['managerName']}' and password='{$_POST['password']}' and roleId={$_POST['roleId']}")->find();
            if(!$manager_exists){               //管理员不存在
                /*添加到管理员表中*/
                $result=M("manager_info")->add($common_data);
                $manager_hospital['managerId']=$result;//新加记录的主键值，作为管理员Id
                $manager_hospital['hospitalId']=$_POST['hospitalId'];//普通管理员对应的医院Id
                /*添加到管理员——医院表中*/
                $add=M("manager_hospital")->add($manager_hospital);
            }else{
                $manager_hospital['managerId']=M("manager_info")->where("managerName='{$_POST['managerName']}' and password='{$_POST['password']}' and roleId={$_POST['roleId']}")->getField("managerId");
                $manager_hospital['hospitalId']=$_POST['hospitalId'];//普通管理员对应的医院Id
                /*添加到管理员——医院表中*/
                $add=M("manager_hospital")->add($manager_hospital);
            }
            if($result||$add){
                /*添加管理员日志*/
                $log['managerId']=$_SESSION['userMsg']['managerId'];
                $log['operationId']=1;
                $log['operationContent']="添加了财务统计人员：".$_POST['managerName'];
                M("manager_log")->add($log);
                $this->redirect("ManagerInfo/index",$_SESSION,1,'添加普通管理员成功');
            }else {
                $this->redirect("ManagerInfo/index",$_SESSION,1,'添加普通管理员失败');
            }
        }
    }
}