<?php

class LoginAction extends Action
{
    public function index()
    {
        $this->display();
    }

    public function checkLogin()
    {
        header('content-type:text/html;charset=utf-8');
        $managerName = $_POST['managerName'];
        $password = md5($_POST['pwd']);
        if ($managerName == '' || $password == '') {
            $this->redirect('Login/index', array(), 1, '登录失败！返回重新登录');
        }
        $managerInfo = M('manager_info')
            ->field('managerId,managerName,systemAdmin,isDel')
            ->where("managerName='%s' and password='%s'", array($managerName, $password))
            ->find();
        if ($managerInfo) {
            if ($managerInfo['isDel'] == 0) {            //未删除的管理员
                /*设置session*/
                session('userMsg', $managerInfo);
                /*添加管理员日志*/
                $log['managerId'] = $_SESSION['userMsg']['managerId'];
                $log['operationId'] = 6;
                $ip = $_SERVER["REMOTE_ADDR"];
                $log['operationContent'] = "登录,IP为：" . $ip;
                M("manager_log")->add($log);
                $this->redirect('Index/index', null, 1, "登录系统成功");
            } else {                              //已删除的管理员
                $this->redirect('Login/index', array(), 2, '您的账号已过期，请联系超级管理员，2秒后自动返回');
            }
        } else {
            $this->redirect('Login/index', array(), 1, '账号密码不匹配！返回重新登录');
        }
    }

    public function logout()
    {
        header('content-type:text/html;charset=utf-8');
        /*添加管理员日志*/
        $managerName = $_SESSION['userMsg']['managerName'];
        $log['managerId'] = $_SESSION['userMsg']['managerId'];
        $log['operationId'] = 7;
        $log['operationContent'] = "退出登录";
        M("manager_log")->add($log);
        session("userMsg", null);
        $this->redirect("Login/index", null, 1, "退出系统成功");
    }
}

