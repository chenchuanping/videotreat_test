<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:46
 */
class ModifyMyselfAction extends BaseAction{
    public function index()
    {
        $managerId=$_SESSION['userMsg']['managerId'];
        $managerName=M("manager_info")->where("managerId={$managerId}")->getField('managerName');
        $this->assign("managerName",$managerName);
        $this->display();
    }
    public function modify()
    {
        header('content-type:text/html;charset=utf-8');
        unset($_POST['checkPwd']);
        $_POST['password']=md5($_POST['password']);//md5加密
        $managerId=$_SESSION['userMsg']['managerId'];
        $result=M("manager_info")->where("managerId={$managerId}")->save($_POST);
        if($result){
            $this->redirect("ModifyMyself/index",$_SESSION,2,"修改信息成功");
        }else{
            $this->redirect("ModifyMyself/index",$_SESSION,2,"修改信息失败");
        }
    }
}