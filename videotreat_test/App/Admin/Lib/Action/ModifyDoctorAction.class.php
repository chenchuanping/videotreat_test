<?php

class  ModifyDoctorAction extends BaseAction
{
    public function index($doctorId)
    {

        $doctorInfo = M('doctor_info')
            ->field('doctorName,tel,professName,departmentName,sex,age,headPic,special,profile,hospitalName')
            ->join("profess_info on profess_info.professId=doctor_info.professId")
            ->join("department_info on department_info.departmentId=doctor_info.departmentId")
            ->join("hospital_info on hospital_info.hospitalId=doctor_info.hospitalId")
            ->where("doctorId={$doctorId}")
            ->find();
        switch($doctorInfo['sex']){
            case 0:
                $doctorInfo['sex']='其他';
                break;
            case 1:
                $doctorInfo['sex']="男";
                break;
            case 2:
                $doctorInfo['sex']="女";
                break;
        }

        $professInfo = M("profess_info")->field("professId,professName")->select();
        $departmentInfo = M("department_info")->field("departmentId,departmentName")->select();
        /*所有医院*/
        $hospitalInfo = M("hospital_info")->field("hospitalId,hospitalName")->select();
        //所有标签
        $labelInfo = M("label")->field("labelId,labelName")->select();

        $this->assign("doctorId", $doctorId);
        $this->assign("doctorInfo", $doctorInfo);
        $this->assign("professInfo", $professInfo);
        $this->assign("departmentInfo", $departmentInfo);
        $this->assign("hospitalInfo", $hospitalInfo);
        $this->assign("labelInfo", $labelInfo);
        $this->display();
    }
    public function modify($doctorId)
    {
        header('content-type:text/html;charset=utf-8');
        /*处理医院Logo和图像*/
        import('ORG.Net.UploadFile');
        $dir="Public/hospitalImages/";
        chmod($dir,'0777');
        $upload = new UploadFile();
        $upload->maxSize="104857600";//上传的文件大小限制 (0-不做限制，1M为1048576字节)
        $upload->allowExts=array('jpg','png','gif'); //允许上传的文件后缀
        $upload->autoSub=true;//自动子目录保存文件
        $upload->subType="date";//子目录创建方式
        $upload->savePath=$dir;//保存路径
        $upload->dateFormat="Ymd";
        $upload->uploadReplace=true;//存在同名是否覆盖
        $info = $upload->upload();
        $doctorImages='';//医生头像
        $arr=$upload->getUploadFileInfo();
        /*对上传图片信息的数组进行处理*/
        if ($_FILES['headPic']['size'] != 0) {
            $doctorImages = "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $arr[0]['savepath'] . $arr[0]['savename'];
            $_POST['headPic'] = $doctorImages;
        } else {
            $_POST['headPic'] = '';
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

    public function delete($doctorId)
    {
        header('content-type:text/html;charset=utf-8');
        /*将医院表中的del字段改为0*/
        $data['isDel'] = 1;         //1表示删除
        $result = M("doctor_info")->where("doctorId={$doctorId}")->save($data);
        if ($result) {
            /*添加管理员日志*/
            $doctorName = M('doctor_info')->where("doctorId={$doctorId}")->getField("doctorName");
            $log['managerId'] = $_SESSION['userMsg']['managerId'];
            $log['operationId'] = 2;
            $log['operationContent'] = "删除了医生：" . $doctorName;
            M("manager_log")->add($log);

            $this->redirect("DoctorInfo/index", null, 1, '删除医生成功');
        } else {
            $this->redirect("DoctorInfo/index", null, 1, '删除医生失败');
        }
    }

}