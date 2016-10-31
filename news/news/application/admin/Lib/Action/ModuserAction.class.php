<?php
class ModuserAction extends BaseAction
{
	public function index()
	{
		$user=M("manager")->field("id",true)->select();
		$this->assign("user",$user);
		$this->display();
	}
	public function delete()
	{
		$id=$_GET['id'];
		$result=M("manager")->where("id={$id}")->delete();
		if($result>0)
		{
			$this->success("删除管理员成功！",__APP__."/Moduser/index");
		}
		else
		{
			$this->success("删除管理员失败！",__APP__."/Moduser/index");
		}
	}
	public function moduser()
	{
		$id=$_GET['id'];
		$result=M("manager")->where("id={$id}")->data($_POST)->save();
		if($result>0)
		{
			$this->success("修改管理员成功！",__APP__."/Moduser/index");
		}
		else
		{
			$this->success("修改管理员失败！",__APP__."/Moduser/index");
		}
	}
}