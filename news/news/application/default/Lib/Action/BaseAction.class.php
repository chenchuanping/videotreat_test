<?php
class BaseAction extends Action
{
	public function _initialize()
	{
		//得到所有分类
		$newstypes=M("newstypes")->select();
		$this->assign("newstypes",$newstypes);
	}
}