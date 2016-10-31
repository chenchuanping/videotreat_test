<?php
	class ModNewsAction extends BaseAction
	{
		public function index()
		{
			//获得表单提交的数据
			$searchType = $_POST["searchType"];
			$keyword = $_POST["keyword"];
			
			//分页变量
			$currentPage = $_POST["currentPage"];
			$currentPage = $currentPage==NULL?1:$currentPage;
			$pageSize = 6;
			$totalRow = 0;
			$totalPage = 0;
			$start = ($currentPage-1)*$pageSize;
			if($keyword == NULL)
			{
				//获得总页数、总记录数
				$totalRow = M("newsarticles")->count();
				$totalPage = ceil($totalRow/$pageSize);
				//查询新闻
				$sql = "select a.articleId,a.title,a.dateandtime,b.typeName from newsArticles a,newsTypes b where a.typeId=b.typeId order by articleId limit {$start},{$pageSize}";
				$newsInfo = M()->query($sql);
			}
			else 
			{
				//获得总页数、总记录数
				$totalRow = M("newsarticles")->where("{$searchType} like '%{$keyword}%'")->count();
				$totalPage = ceil($totalRow/$pageSize);
				//查询新闻
				$sql = "select a.articleId,a.title,a.dateandtime,b.typeName from newsArticles a,newsTypes b where a.typeId=b.typeId and {$searchType} like '%{$keyword}%' order by articleId limit {$start},{$pageSize}";
				$newsInfo = M()->query($sql);
			}
			$this->assign("searchType",$searchType);
			$this->assign("keyword",$keyword);
			$this->assign("currentPage",$currentPage);
			$this->assign("totalPage",$totalPage);
			$this->assign("newsInfo",$newsInfo);
			$this->display();
		}
		public function delete($articleId)
		{
			M("reviews")->where("articleId={$articleId}")->delete();
			$result=M("newsarticles")->where("articleId={$articleId}")->delete();
			if($result>0)
			{
				$this->success("删除新闻成功！",__APP__."/Modnews/index");
			}
			else 
			{
				$this->success("删除新闻失败！",__APP__."/Modnews/index");
			}
		}
	}








