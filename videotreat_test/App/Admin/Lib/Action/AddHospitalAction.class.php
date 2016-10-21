<?php
class  AddHospitalAction extends BaseAction{
    public function index()
    {
        /*标签信息*/
        $labelInfo=M("label")->select();
        $this->assign("labelInfo",$labelInfo);
        $this->display();
    }
    public function add()
    {
        header('content-type:text/html;charset=utf-8');
        /*处理医院Logo和图像*/
        import('ORG.Net.UploadFile');
        $dir="Public/hospitalImages/";
        $upload = new UploadFile();
        $upload->maxSize="2097152";//上传的文件大小限制 (0-不做限制，1M为1048576字节)
        $upload->allowExts=array('jpg','png','gif'); //允许上传的文件后缀
        $upload->autoSub=true;//自动子目录保存文件
        $upload->subType="date";//子目录创建方式
        $upload->savePath=$dir;//保存路径
        $upload->dateFormat="Ymd";
        $upload->uploadReplace=true;//存在同名是否覆盖
        $info = $upload->upload();
        $userImageUrl='';//用户头像地址
        $arr=$upload->getUploadFileInfo();
        /*对上传图片信息的数组进行处理*/
        foreach($arr as $v){
            $upload_arr[$v['key']]=$v;
        }
        if($_FILES['hospitalLogo']['size']!=0&&$upload_arr['hospitalLogo']['key']=='hospitalLogo'){          //添加了hospitalLogo
            $hospitalLogo="http://".$_SERVER["SERVER_NAME"].__ROOT__ ."/".$upload_arr['hospitalLogo']['savepath'].$upload_arr['hospitalLogo']['savename'];
            $_POST['hospitalLogo']=$hospitalLogo;
        }
        if($_FILES['hospitalImage']['size']!=0&&$upload_arr['hospitalImage']['key']=='hospitalImage'){      //添加了hospitalImage
            $hospitalImages="http://".$_SERVER["SERVER_NAME"].__ROOT__ ."/".$upload_arr['hospitalImage']['savepath'].$upload_arr['hospitalImage']['savename'];
            $_POST['hospitalImage']=$hospitalImages;
        }
        /*处理标签*/
        if($_POST['labelArray']){
            $labelArray=$_POST['labelArray'];
            foreach($labelArray as $v){
                $labelName[]=M("label")->field('labelName')->where("labelId={$v}")->find();
            }
            foreach($labelName as $v){
                $labelNameArray[]=$v['labelName'];
            }
            $labelNameString=implode($labelNameArray);
            $_POST['labelArray']=rtrim($labelNameString,"、");
        }
        /*将数据库数据修改*/
        $result=M("hospital_info")->add($_POST);
        if($result){
            /*添加管理员日志*/
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=1;
            $log['operationContent']="添加了医院：".$_POST['hospitalName'];
            M("manager_log")->add($log);
            $this->redirect("HospitalInfo/index",$_SESSION,1,'添加医院成功');
        }else{
            $this->redirect("HospitalInfo/index",$_SESSION,1,'添加医院失败');
        }
    }
}