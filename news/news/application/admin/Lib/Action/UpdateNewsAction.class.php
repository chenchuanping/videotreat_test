<?php
class UpdateNewsAction extends BaseAction
{
	public function index()
	{
		$articleId=$_GET['articleId'];
		$typeId=$_GET['typeId'];//当前新闻的未修改以前的typeId
		//查询当前articleId下的信息
		$newsInfo=M("newsarticles")->where("articleId={$articleId}")->field("title,content,articleId,dateandtime,source,writer,userName")->find();
		//查询所有分类的信息 
		$newsTypes=M("newstypes")->field("typeId,typeName")->select();
		$this->assign("articleId",$articleId);
		$this->assign("newsInfo",$newsInfo);
		$this->assign("newsTypes",$newsTypes);
		$this->assign("oldTypeId",$typeId);
		$this->display();
	}
	public function update()
	{
		$articleId=$_GET['articleId'];
		$old_typeId=$_GET['typeId'];
		$result=M("newsarticles")->where("articleId={$articleId}")->save($_POST);
		
		if($result>0)
		{	
			if($old_typeId!=null&&$old_typeId != $_POST['typeId'])
			{
				M("newstypes")->where("typeId={$old_typeId}")->setDec("articleNums");
				M("newstypes")->where("typeId={$_POST['typeId']}")->setInc("articleNums");
				
			}
			$this->success("修改新闻成功！",__APP__."/Modnews/index");
		}
		else
		{
			$this->success("修改新闻失败！",__APP__."/Modnews/index");
		}
	}
}