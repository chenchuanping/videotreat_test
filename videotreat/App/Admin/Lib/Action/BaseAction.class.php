<?php
class BaseAction extends Action
{
	public function _initialize()
	{
		if(session('userMsg')==NULL)
		{
			header('content-type:text/html;charset=utf-8');
			$this->redirect("Login/index",array(),2,"您还没有登录，无权访问");
			exit;
		}
		
		//获得当前管理员信息
		$userInfo=session('userMsg');
		$this->assign("userInfo",$userInfo);
	}
}