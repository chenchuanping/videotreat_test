<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:46
 */
class ManagerInfoAction extends BaseAction
{
    public function index()
    {
        /*搜索*/
        $keyword = $_POST["keyword"];
        $keyword = str_replace("%", "\\%", $keyword);
        $keyword = str_replace("_", "\\_", $keyword);
        $keyword = str_replace(" ", "\\%", $keyword);
        //分页变量
        $currentPage = $_POST["currentPage"];
        $currentPage = $currentPage == NULL ? 1 : $currentPage;
        $pageSize = 6;
        $totalRow = 0;
        $totalPage = 0;
        $start = ($currentPage - 1) * $pageSize;
        if ($keyword == null) {
            //获得总页数、总记录数
            $totalRow = M("manager_info")
                ->join("manager_hospital on manager_hospital.managerId=manager_info.managerId")
                ->where("manager_info.isDel=0")
                ->count();
            $totalPage = ceil($totalRow / $pageSize);
            /*管理员信息*/
            $managerInfo = M("manager_info")->field("manager_info.managerId,manager_info.systemAdmin,managerName,roleName,hospital_info.hospitalId,hospital_info.hospitalName")
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
        } else {
            //获得总页数、总记录数
            $totalRow = M("manager_info")
                ->join("manager_hospital on manager_hospital.managerId=manager_info.managerId")
                ->where("manager_info.isDel=0 and managerName like '%{$keyword}%'")
                ->count();
            $totalPage = ceil($totalRow / $pageSize);
            /*管理员信息*/
            $managerInfo = M("manager_info")->field("manager_info.managerId,manager_info.systemAdmin,managerName,roleName,hospital_info.hospitalId,hospital_info.hospitalName")
                ->join("manager_hospital on manager_hospital.managerId=manager_info.managerId")
                ->join("hospital_info on hospital_info.hospitalId=manager_hospital.hospitalId")
                ->join("role on role.roleId=manager_hospital.roleId")
                ->where("manager_info.isDel=0 and managerName like '%{$keyword}%'")/*没有被删除的管理员*/
                ->order("manager_info.managerId")
                ->limit($start, $pageSize)
                ->select();
            foreach ($managerInfo as $k => $value) {
                if ($value['systemAdmin'] == 1) {            /*超级管理员*/
                    $value['hospitalId'] = 'all';     /*代表所有医院Id*/
                    $value['hospitalName'] = '所有医院';
                    $managerInfo[$k] = $value;
                }
            }
        }
        if ($keyword) {
            /*添加管理员日志*/
            $log['managerId'] = $_SESSION['userMsg']['managerId'];
            $log['operationId'] = 4;
            $log['operationContent'] = "查询了管理员：" . $keyword;
            M("manager_log")->add($log);
        }
        $this->assign('totalRow',$totalRow);
        $this->assign("keyword", $keyword);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $totalPage);
        $this->assign('managerInfo', $managerInfo);
        $this->display();
    }
}