<?php
class AddnewsAction extends BaseAction
{
	public function index()
	{
		$newsTypes=M("newstypes")->select();
		$this->assign("newsTypes",$newsTypes);
		$this->display();
	}
	public function addnews()
	{
		$title=$_POST['title'];
		$typeId=$_POST['typeId'];
		$writer=$_POST['writer'];
		$source=$_POST['source'];
		$myFile=$_FILES["myFile"];
		$content=$_POST['content'];
		$userName=$_SESSION['userMsg']['userName'];
		$_POST['userName']=$userName;
		var_dump($_POST);
		var_dump($_SESSION);
		if($myFile['name']!=null&&$title!=NULL){
			
				import("ORG.Net.UploadFile");
				$upload=new UploadFile();
				$upload->maxSize=10000000;
				$upload->allowExts=array("jpg","jpeg","gif","png");
				$upload->savePath="public/newspicture/";
				if($upload->upload()){
					$loadInfo=$upload->getUploadFileInfo();
					
					$path=$loadInfo[0]["savepath"].$loadInfo[0]['savename'];
					$path=substr($path, strpos($path,"/")+1);
					$_POST['imagepath']=$path;
					//添加记录
					$result=M("newsarticles")->add($_POST);
					if($result>0){
						//添加新闻时，将当前userName下的新闻数加1
						M("manager")->where("userName='{$userName}'")->setInc("addnum");
						//添加新闻时，将当前typeId下的新闻数加1
						M("newstypes")->where("typeId={$typeId}")->setInc("articleNums");
						$this->success("添加新闻成功！",__APP__."/Addnews/index");
					}
					else{
						$this->success("添加新闻失败！",__APP__."/Addnews/index");
					}
				}else{
					$msg=$upload->getErrorMsg();
					$this->success($msg,__APP__."/Addnews/index");
				}
		}
		if($myFile['name']==null&&$title!=NULL){
			//添加记录
			$result=M("newsarticles")->add($_POST);
			if($result>0){
				//添加新闻时，将当前userName下的新闻数加1
				M("manager")->where("userName='{$userName}'")->setInc("addnum");
				//添加新闻时，将当前typeId下的新闻数加1
				M("newstypes")->where("typeId={$typeId}")->setInc("articleNums");
				$this->success("添加新闻成功！",__APP__."/Addnews/index");
			}else{
				$this->success("添加新闻失败！",__APP__."/Addnews/index");
			}
		}
	}
} 
