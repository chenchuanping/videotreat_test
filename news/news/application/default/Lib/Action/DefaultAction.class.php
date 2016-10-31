<?php
class DefaultAction extends BaseAction 
{
    public function index()
    {
    	$newstypes=M("newstypes")->select();
    	foreach ($newstypes as $k=>$v)
    	{
    		//获得当前typeId下的两条新闻，按点击量排序
    		$v['news']=M("newsarticles")->where("typeId={$v[typeId]}")->order("dateandtime desc")->limit(0,2)->field("articleId,title")->select();
    		$newstypes[$k]=$v;
    	}
    	//var_dump($newstypes);  //四维数组
    	//获得newsArticles表，点击量最高的6条新闻
    	$sql="select a.articleId,a.title,a.dateandtime,b.typeName from newsarticles a,newstypes b where a.typeId=b.typeId order by hints desc limit 0,6";
    	$hotNews=M()->query($sql);
    	
    	//得到新闻总数
    	$num=M("newsarticles")->count();
    	$this->assign("newstypes",$newstypes);
    	//$this->newstypes=$newstypes;//也可以这样传值
    	$this->assign("hotNews",$hotNews);
    	$this->assign("num",$num);
    	$this->display();
    }
    public function checkLogin()
    {
    	$userName=$_POST['userName'];
    	$password=$_POST['password'];
    	$checkCode=$_POST['checkCode'];
    	$vcode=$_SESSION['vcode'];
    	if($checkCode==$vcode)
    	{
    		//验证登录
    		$userInfo=M("manager")->where("userName='%s' and password='%s'",array($userName,$password))->find();
    		if($userInfo!=null)
    		{
    			//$_SESSION['userMsg']=$userInfo;
    			session('userMsg',$userInfo);
    			var_dump($_COOKIE);
    			$this->success("登录成功",__ROOT__."/admin.php");
    		}
    		else 
    		{
    			$this->success("用户名或密码不正确",__APP__);
    		}
    	}else {
    		$this->success("验证码不正确",__APP__);
    	}
    }
}














