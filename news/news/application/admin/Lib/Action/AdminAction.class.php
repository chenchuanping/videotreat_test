<?php
class AdminAction extends BaseAction 
{
    public function index()
    {
    		$this->display();
    }
    public function logout()
    {
    	//unset($_SESSION["userMsg"]);
    	session("userMsg",null);
    	$this->success("退出系统成功",__ROOT__."/default.php");
    }
}