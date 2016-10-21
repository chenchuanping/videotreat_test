<?php
class LoginAction extends Action
{
    public function index()
    {
        $_SESSION['login']=0;//用来判断用户是登录还是刷新  等于0说明不是由登录进来的
        $this->display();
    }
    public function checkLogin()
    {
        header('content-type:text/html;charset=utf-8');
        $tel=$_POST['tel'];
        $dpassword=md5($_POST['dpass']);
        if($tel=='' || $dpassword==''){
            $this->redirect('Login/index',array(),1,'登录失败！返回重新登录');
        }
        /*将状态改成忙碌*/
        $data['stateId']=2;
        D('doctor_info')->where("tel='{$tel}'")->save($data);
        $result=D('doctor_info')->where("tel='%s' and password='%s'",array($tel,$dpassword))->find();
        if($result){
           if($result['isDel']==1){
               $this->redirect('Login/index',array(),2,'您的账号已过期，请联系管理员，2秒后自动返回');
               return false;
           }
            $_SESSION['userMsg']=$result;
            $_SESSION['login']+=1;
            $this->redirect('Doctor/index');
        }else{
            $this->redirect('Login/index',array(),2,'账号密码不匹配！返回重新登录');
        }
    }
    public function loginOut()
    {
        header('content-type:text/html;charset=utf-8');
        if($_GET['_URL_'][1]=='loginOut'){
            $doctorId=$_SESSION['userMsg']['doctorId'];
            $data['stateId']=3;
            $result=M("doctor_info")->where('doctorId='.$doctorId)->data($data)->save();
            if($result){
                session_destroy();
            }
             $this->redirect('Login/index',null,0,'退出登录成功！');
        }
        exit;
    }
}