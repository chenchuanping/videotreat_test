<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:46
 */
class AdminLogAction extends BaseAction
{
    public function index()
    {
        //分页变量
        $currentPage = $_POST["currentPage"];
        $currentPage = $currentPage == NULL ? 1 : $currentPage;
        $pageSize = 5;
        $totalRow = 0;
        $totalPage = 0;
        $start = ($currentPage - 1) * $pageSize;
            //获得总页数、总记录数
        $totalRow = M("manager_log")->where("manager_log.isDel=0")->count();
        $totalPage = ceil($totalRow / $pageSize);
        /*日志信息*/
        $logInfo = M("manager_info")->field("manager_info.managerId,manager_info.systemAdmin,managerName,roleName,hospital_info.hospitalId,hospital_info.hospitalName")
            ->join("manager_hospital on manager_hospital.managerId=manager_info.managerId")
            ->join("hospital_info on hospital_info.hospitalId=manager_hospital.hospitalId")
            ->join("role on role.roleId=manager_hospital.roleId")
            ->where("manager_info.isDel=0")/*没有被删除的管理员*/
            ->order("manager_info.managerId")
            ->limit($start, $pageSize)
            ->select();
            foreach ($managerInfo as $k => $value) {
                if ($value['systemAdmin'] == 1) {            /*超级管理员*/
                    $value['hospitalId'] = 'all';     /*代表所有医院Id*/
                    $value['hospitalName'] = '所有医院';
                    $value['roleName'] = "系统管理员";
                    $managerInfo[$k] = $value;
                }
            }
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $totalPage);
        $this->assign('managerInfo', $managerInfo);
        $this->display();
    }
}