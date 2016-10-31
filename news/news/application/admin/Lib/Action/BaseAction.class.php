<?php
class BaseAction extends Action
{
	public function _initialize()
	{
		if(session('userMsg')==NULL)
		{
			$this->success("您还没有登录，无权访问",__APP__."/Login/index");
			exit;
		}
		
		//获得当前管理员信息
		$userInfo=session('userMsg');
		$this->assign("userInfo",$userInfo);
	}
}