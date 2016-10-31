<?php
class NewsTypesAction extends BaseAction
{
	public function index($typeId)
	{
		//查询当前分类下的所有新闻
		$newsInfo=M("newsarticles")->where("typeId={$typeId}")->select();
		//获得一个typeId下的所有信息
		$newstype=M("newstypes")->where("typeId={$typeId}")->find();
		
		//url中的typeId不正常
		if($newstype == NULL)
		{
			$this->success("网页访问异常！",__APP__."/Default/index.html");
			exit();
		}
		
		$this->assign("newsInfo",$newsInfo);
		$this->assign("newstype",$newstype);
		$this->display();
	}
}