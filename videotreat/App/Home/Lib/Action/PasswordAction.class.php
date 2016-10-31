<?php
class PasswordAction extends Action{
    public function index($doctorId)
    {
        header('content-type:text/html;charset=utf-8');
        if(!$_SESSION['userMsg']||$_SESSION['login']!=1){
            $this->redirect('Login/index',null,1,'非法URL地址，请登录！');
        }
        $this->assign('doctorName',$_SESSION['userMsg']['doctorName']);
        $this->assign('doctorId',$doctorId);
        $this->display();
    }
    public function modifyPassword($doctorId)
    {
        header('content-type:text/html;charset=utf-8');
        //要修改的数据
        $data['password']=md5($_POST['new_password']);
        if(md5($_POST['old_password'])!=$_SESSION['userMsg']['password']){
            $this->redirect('Password/index',array('doctorId'=>"{$doctorId}"),1,'原始密码不正确！');
        }
        if($_POST['old_password']==$_POST['new_password']){
            $this->redirect('Password/index',array('doctorId'=>"{$doctorId}"),1,'新旧密码一致！');
        }
        try{
            $result=M('doctor_info')->where('doctorId='.$doctorId)->data($data)->save();
            if($result>0){
//                $this->redirect('Doctor/index',array('doctorId'=>"{$doctorId}"),3,'修改密码成功！请重新登录！');
//                $this->success('修改密码成功！请重新登录！'');
                $this->quit();
                echo '<script type="text/javascript" src="../../../../Public/js/jquery.js"></script>';
                echo "<script> alert('密码修改成功，请重新登录！');window.parent.location.reload()</script>";
            }else{
                $this->redirect('Password/index',array('doctorId'=>"{$doctorId}"),2,'修改密码失败！');
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function quit(){
        session_destroy();
    }
}