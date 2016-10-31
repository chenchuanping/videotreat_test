<?php
class NewsAction extends BaseAction
{
	public function index($articleId)
	{
		//查找当前articleId下的新闻信息
		$newsInfo=M()->query("select * from newsarticles a,newstypes b where a.typeId=b.typeId and articleId={$articleId}");
		$this->assign("newsInfo",$newsInfo[0]);
		//点击新闻的时候，点击量加1
		M("newsarticles")->where("articleId={$articleId}")->setInc("hints");
		//查找当前articleId下的新闻信息
		$reviewsInfo=M("reviews")->where("articleId={$articleId}")->select();
		
		//url中的articleId不正常
		if($newsInfo == NULL)
		{
			$this->success("网页访问异常！",__APP__."/Default/index.html");
			exit();
		}
		
		$this->assign("reviewsInfo",$reviewsInfo);
		$this->display();
	}
	public function addreview()
	{
		$content=$_POST['body'];
		//替换敏感字
		$dirty_arr=M("dirtytalk")->select();//找到dirtyTalk表中所有敏感词信息
		foreach ($dirty_arr as $v){
			$search=$v['dirty'];
			$content=str_replace($search, "**", $content);
			$_POST['body']=$content;
		}
		$result=M("reviews")->add($_POST);
		if($result>0)
		{
			$this->success("评论成功！",__APP__."/News/index/articleId/{$_POST['articleId']}");
		}
		else 
		{
			$this->success("评论失败！",__APP__."/News/index/articleId/{$_POST['articleId']}");
		}
	}
}