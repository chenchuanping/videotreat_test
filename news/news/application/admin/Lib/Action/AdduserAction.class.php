<?php
class AdduserAction extends BaseAction
{
	public function index()
	{
		$this->display();
	}
	public function adduser()
	{
		$arr=array(
				"userName"=>$_POST['username'],
				"password"=>$_POST['password'],
				"userType"=>$_POST['userType'],
				"remark"=>$_POST['remark'],
				"addnum"=>$_POST['addnum']
		);
		$result=M("manager")->add($arr);
		if($result>0)
		{
			$this->success("添加管理员成功！",__APP__."/Moduser/index");
		}
		else
		{
			$this->success("添加管理员失败！",__APP__."/Adduser/index");
		}
	}
}