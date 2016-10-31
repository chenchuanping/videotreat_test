<?php
class ReviewsAction extends BaseAction
{
	public function index($articleId)
	{
		$reviews=M("reviews")->where("articleId={$articleId}")->field("id,articleId,userName,body,dateandtime")->select();
		$this->assign("reviews",$reviews);
		$this->display();
	}
	public function delete()
	{
		$articleId=$_GET['articleId'];
		$id=$_GET['id'];
		$result=M("reviews")->where(" articleId={$articleId} and id={$id}")->delete();
		if($result>0)
		{
			$this->success("删除评论成功！",__APP__."/Reviews/index/articleId/{$articleId}");
		}
		else
		{
			$this->success("删除评论失败！",__APP__."/Reviews/index/articleId/{$articleId}");
		}
		
	}
}