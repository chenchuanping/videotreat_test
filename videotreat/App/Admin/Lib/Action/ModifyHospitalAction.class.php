<?php
class  ModifyHospitalAction extends BaseAction{
    public function index($hospitalId)
    {
        /*标签信息*/
        $labelInfo=M("label")->select();
        $hospitalInfo=M("hospital_info")->where("hospitalId={$hospitalId}")->find();
        $this->assign("hospitalInfo",$hospitalInfo);
        $this->assign("labelInfo",$labelInfo);
        $this->assign("hospitalId",$hospitalId);
        $this->display();
    }
    public function delete($hospitalId)
    {
        header('content-type:text/html;charset=utf-8');
        /*将医院表中的del字段改为0*/
        $data['isDel']=1;         //1表示删除
        $result=M("hospital_info")->where("hospitalId={$hospitalId}")->save($data);
        if($result){
            /*添加管理员日志*/
            $hospitalName=M('hospital_info')->where("hospitalId={$hospitalId}")->getField("hospitalName");
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=2;
            $log['operationContent']="删除了医院：".$hospitalName;
            M("manager_log")->add($log);
            $this->redirect("HospitalInfo/index",null,1,'删除医院成功');
        }else{
            $this->redirect("HospitalInfo/index",null,1,'删除医院失败');
        }
    }
    public function modify($hospitalId)
    {
        header('content-type:text/html;charset=utf-8');
        /*处理医院Logo和图像*/
        import('ORG.Net.UploadFile');
        $dir="Public/hospitalImages/";
        $upload = new UploadFile();
        $upload->maxSize="104857600";//上传的文件大小限制 (0-不做限制，1M为1048576字节)
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
        if($_FILES['hospitalLogo']['size']!=0&&$upload_arr['hospitalLogo']['key']=='hospitalLogo'){          //修改了hospitalLogo
            $hospitalLogo="http://".$_SERVER["SERVER_NAME"].__ROOT__ ."/".$upload_arr['hospitalLogo']['savepath'].$upload_arr['hospitalLogo']['savename'];
            $_POST['hospitalLogo']=$hospitalLogo;
        }
        if($_FILES['hospitalImage']['size']!=0&&$upload_arr['hospitalImage']['key']=='hospitalImage'){      //修改了hospitalImage
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
        $result=M("hospital_info")->where("hospitalId={$hospitalId}")->save($_POST);
        if($result){
            /*添加管理员日志*/
            $hospitalName=M('hospital_info')->where("hospitalId={$hospitalId}")->getField("hospitalName");
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=3;
            $log['operationContent']="修改了医院：".$hospitalName;
            M("manager_log")->add($log);
            $this->redirect("HospitalInfo/index",null,1,'医院信息修改成功');
        }else{
            $this->redirect("ModifyHospital/index",array("hospitalId"=>$hospitalId),1,'医院信息修改失败');
        }
    }
}