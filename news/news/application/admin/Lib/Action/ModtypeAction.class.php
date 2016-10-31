<?php
class ModtypeAction extends BaseAction
{
	public function index()
	{
		$newstypes=M("newstypes")->field('typeName,articleNums,typeId')->select();
		$this->assign("newstypes",$newstypes);
		$this->display();
	}
	public function delete($typeId)
	{
		M()->query("delete from reviews where articleId in (select articleId from newsarticles where typeId={$typeId})");
		M("newsarticles")->where("typeId={$typeId}")->delete();
		$result=M("newstypes")->where("typeId={$typeId}")->delete();
		if($result>0)
		{
			$this->success("删除分类成功",__APP__."/Modtype/index");
		}	
		else 
		{
			$this->success("删除分类失败",__APP__."/Modtype/index");
		}
	}
	public function modtype($typeId)
	{
		$result=M("newstypes")->where("typeId={$typeId}")->save($_POST);
		if($result>0)
		{
			$this->success("修改分类成功！",__APP__."/Modtype/index");
		}
		else 
		{
			$this->success("修改分类失败！",__APP__."/Modtype/index");
		}
	}
}














