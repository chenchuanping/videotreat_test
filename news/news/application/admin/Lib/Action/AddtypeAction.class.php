<?php
class AddtypeAction extends BaseAction
{
	public function index()
	{
		$this->display();
	}
	public function addtype()
	{
		$result=M("newstypes")->add($_POST);
		if($result>0)
		{
			$this->success("添加分类成功！",__APP__."/Addtype/index");
		}	
		else
		{
			$this->success("添加分类失败！",__APP__."/Addtype/index");
		}
	}
}