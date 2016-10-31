<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:47
 */
class RecycleBinAction extends BaseAction
{
    public function index()
    {
        $this->display();
    }

    public function restore()
    {
        $type = $_POST['type'];
        if ($type == 'hospital') {
            /*查寻被删除的医院*/
            $hospital_recyle_info = M("hospital_info")->field("hospitalId,hospitalName")->where("isDel=1")->select();
            echo json_encode($hospital_recyle_info);
        } elseif ($type == 'doctor') {
            /*查寻被删除的医生*/
            $doctor_recyle_info = M("doctor_info")->field("doctorId,doctorName")->where("isDel=1")->select();
            echo json_encode($doctor_recyle_info);
        }
    }

    public function restoreHospital()
    {
        $hospitalId = $_POST['hospitalId'];
        /*将hospital_info 表中的对应的医院Id  isDel改为0*/
        $data['isDel'] = 0;
        $result = M("hospital_info")->where("hospitalId={$hospitalId}")->save($data);
        /*添加管理员日志*/
        $hospitalName = M('hospital_info')->where("hospitalId={$hospitalId}")->getField("hospitalName");
        $log['managerId'] = $_SESSION['userMsg']['managerId'];
        $log['operationId'] = 5;
        $log['operationContent'] = "恢复了医院：" . $hospitalName;
        M("manager_log")->add($log);
        echo json_encode($result);
    }

    public function restoreDoctor()
    {
        $doctorId = $_POST['doctorId'];
        $hospitalId = M('doctor_info')->where("doctorId={$doctorId}")->getField('hospitalId');
        /* doctor_info 表中的对应的医院Id  isDel改为0*/
        $data['isDel'] = 0;
        $result = M("doctor_info")->where("doctorId={$doctorId}")->save($data);
        if ($result) {
            /*医师数量加 1*/
            M("doctor_info")->where("hospitalId={$hospitalId}")->setInc('doctorNumber');
            /*添加管理员日志*/
            $doctorName = M('doctor_info')->where("doctorId={$doctorId}")->getField("doctorName");
            $log['managerId'] = $_SESSION['userMsg']['managerId'];
            $log['operationId'] = 5;
            $log['operationContent'] = "恢复了医生：" . $doctorName;
            M("manager_log")->add($log);
            echo json_encode($result);
        }
    }
}