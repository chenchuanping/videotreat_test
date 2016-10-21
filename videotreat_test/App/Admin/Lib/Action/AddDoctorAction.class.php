<?php

class  AddDoctorAction extends BaseAction
{
    public function index()
    {
        /*职称*/
        $professInfo = M("profess_info")->select();
        /*科室*/
        $departmentInfo = M("department_info")->select();
        /*标签信息*/
        $labelInfo = M("label")->select();
        //查询所有医院信息
        $hospitalInfo = M('hospital_info')->select();
        $this->assign('hospitalInfo', $hospitalInfo);
        $this->assign("labelInfo", $labelInfo);
        $this->assign("professInfo", $professInfo);
        $this->assign("departmentInfo", $departmentInfo);
        $this->display();
    }

    public function add()
    {
        header('content-type:text/html;charset=utf-8');
        $hospitalId = $_POST['hospitalId'];
        /*处理密码*/
        if ($_POST['password']) {
            $_POST['password'] = md5($_POST['password']);
        }
        /*处理科室*/
        $_POST['professId'] = $_POST['profess'][0];
        unset($_POST['profess']);
        /*处理职称*/
        $_POST['departmentId'] = $_POST['department'][0];
        unset($_POST['department']);
        /*处理标签*/
        if ($_POST['labelArray']) {
            $labelArray = $_POST['labelArray'];
            foreach ($labelArray as $v) {
                $labelName[] = M("label")->field('labelName')->where("labelId={$v}")->find();
            }
            foreach ($labelName as $v) {
                $labelNameArray[] = $v['labelName'];
            }
            $labelNameString = implode($labelNameArray);
            $_POST['labelArray'] = rtrim($labelNameString, "、");
        }
        /*判断医生是否被删除*/
        $doctor_isDel = M('doctor_info')->where("tel={$_POST['tel']} and isDel=1")->find();
        if ($doctor_isDel) {
            $this->redirect("DoctorInfo/index", null, 1, '医师处于停用状态，请联系管理员');
        }

        /*判断手机号是否被注册*/
        $checkInfo = M('doctor_info')->where("tel={$_POST['tel']}")->find();
        if ($checkInfo) {
            $this->redirect("DoctorInfo/index", null, 1, '手机号已被注册');
        } else {
            /*处理医生头像*/
            import('ORG.Net.UploadFile');
            $dir = "Public/doctorImages/";
            $upload = new UploadFile();
            $upload->maxSize = "2097152";//上传的文件大小限制 (0-不做限制，1M为1048576字节)
            $upload->allowExts = array('jpg', 'png', 'gif'); //允许上传的文件后缀
            $upload->autoSub = true;//自动子目录保存文件
            $upload->subType = "date";//子目录创建方式
            $upload->savePath = $dir;//保存路径
            $upload->dateFormat = "Ymd";
            $upload->uploadReplace = true;//存在同名是否覆盖
            $info = $upload->upload();
            $userImageUrl = '';//用户头像地址
            $arr = $upload->getUploadFileInfo();
            if ($_FILES['headPic']['size'] != 0) {
                $doctorImages = "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $arr[0]['savepath'] . $arr[0]['savename'];
                $_POST['headPic'] = $doctorImages;
            } else {
                $_POST['headPic'] = '';
            }
            /*将数据库数据修改*/
            $result = M("doctor_info")->add($_POST);
            if ($result) {
                /*医师数量加 1*/
                M("doctor_info")->where("hospitalId={$hospitalId}")->setInc('doctorNumber');
                /*添加管理员日志*/
                $log['managerId'] = $_SESSION['userMsg']['managerId'];
                $log['operationId'] = 1;
                $log['operationContent'] = "添加了医生：" . $_POST['doctorName'];
                M("manager_log")->add($log);
                $this->redirect("DoctorInfo/index", $_SESSION, 1, '添加医生成功');
            } else {
                $this->redirect("DoctorInfo/index", $_SESSION, 1, '添加医生失败');
            }
        }

    }
}