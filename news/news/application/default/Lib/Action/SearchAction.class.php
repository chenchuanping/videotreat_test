<?php
class SearchAction extends BaseAction
{
	public function index()
	{
		//获得表单提交的数据
		$searchType = daddslashes($_POST["searchType"]);
		$keyword = daddslashes($_POST["keyword"]);
		
		$keyword=str_replace("%","\\%",$keyword);
		$keyword=str_replace("_","\\_",$keyword);
		$keyword=str_replace(" ","\\%",$keyword);
		//搜索新闻
		$newsInfo = array();//避免第一次打开页面，没有搜索内容，$newsInfo为空的情况
		if($keyword==null){
			$count=0;
		}else{
			$newsInfo=D("newsarticles")->where("{$searchType} like '%{$keyword}%'")->select();
			$count=count($newsInfo);
		}
		$this->assign("newsInfo",$newsInfo);
		$this->assign("count",$count);
		$this->display();
	}
	
}