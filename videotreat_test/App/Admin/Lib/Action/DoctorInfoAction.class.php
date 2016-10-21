<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:46
 */
class DoctorInfoAction extends BaseAction
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
        $pageSize = 5;
        $totalRow = 0;
        $totalPage = 0;
        $start = ($currentPage - 1) * $pageSize;
        /*判断角色，是超级管理员，还是某家医院的管理员*/
        $managerId = $_SESSION['userMsg']['managerId'];
        $systemAdmin = $_SESSION['userMsg']['systemAdmin'];
        if ($systemAdmin == 1) {               //超级管理员，可以看到所有医生信息
            if ($keyword == null) {
                //获得总页数、总记录数
                $totalRow = M("doctor_info")->where("isDel=0")->count();
                $totalPage = ceil($totalRow / $pageSize);
                $doctorInfo = M('doctor_info')
                    ->field('doctorId,doctorName,headPic,professName,departmentName,special,profile,doctor_info.stateId,stateName,doctor_info.labelArray,hospitalName')
                    ->join('state_info on state_info.stateId=doctor_info.stateId')
                    ->join('profess_info on profess_info.professId=doctor_info.professId')
                    ->join('department_info on department_info.departmentId=doctor_info.departmentId')
                    ->join('hospital_info on hospital_info.hospitalId=doctor_info.hospitalId')
                    ->where("doctor_info.isDel=0")//表示没有被删除的医生
                    ->order('doctor_info.hospitalId')
                    ->limit($start, $pageSize)
                    ->select();
            } else {
                //获得总页数、总记录数
                $totalRow = M("doctor_info")->where("doctorName like '%{$keyword}%'")->count();
                $totalPage = ceil($totalRow / $pageSize);
                //查询医院
                $doctorInfo = M('doctor_info')
                    ->field('doctorId,doctorName,headPic,professName,departmentName,special,profile,doctor_info.stateId,stateName,doctor_info.labelArray,hospitalName')
                    ->join('state_info on state_info.stateId=doctor_info.stateId')
                    ->join('profess_info on profess_info.professId=doctor_info.professId')
                    ->join('department_info on department_info.departmentId=doctor_info.departmentId')
                    ->join('hospital_info on hospital_info.hospitalId=doctor_info.hospitalId')
                    ->where("doctor_info.isDel=0 and doctorName like '%{$keyword}%'")//表示没有被删除的医生
                    ->limit($start, $pageSize)
                    ->select();
            }
        } else{       //单个医院的管理员，只能看到他所管理的医院的医生
            $hospitalId = M("manager_hospital")->field('hospitalId')->where("managerId={$managerId}")->select();
            foreach ($hospitalId as $v) {
                $hospitalIdArray[] = $v['hospitalId'];            //拼接医院Id数组
            }
            //获得总页数、总记录数
            $map['hospitalId'] = array('in', $hospitalIdArray);
            $map['isDel'] = 0;
            $totalRow = M("doctor_info")->where($map)->count();
            $totalPage = ceil($totalRow / $pageSize);
            /*查找医生的条件*/
            $map_doctor['doctor_info.isDel'] = 0;   //表示没有被删除的医生
            $map_doctor['doctor_info.hospitalId'] = array('in', $hospitalIdArray);
            if ($keyword == null) {
                $doctorInfo = M('doctor_info')
                    ->field('doctorId,doctorName,headPic,professName,departmentName,special,profile,doctor_info.stateId,stateName,doctor_info.labelArray,hospitalName')
                    ->join('state_info on state_info.stateId=doctor_info.stateId')
                    ->join('profess_info on profess_info.professId=doctor_info.professId')
                    ->join('department_info on department_info.departmentId=doctor_info.departmentId')
                    ->join('hospital_info on hospital_info.hospitalId=doctor_info.hospitalId')
                    ->where($map_doctor)
                    ->order('doctor_info.hospitalId')
                    ->limit($start, $pageSize)
                    ->select();
            } else {
                $map_doctor['doctorName'] = array('like', "%{$keyword}%"); //搜索查询
                $doctorInfo = M('doctor_info')
                    ->field('doctorId,doctorName,headPic,professName,departmentName,special,profile,doctor_info.stateId,stateName,doctor_info.labelArray,hospitalName')
                    ->join('state_info on state_info.stateId=doctor_info.stateId')
                    ->join('profess_info on profess_info.professId=doctor_info.professId')
                    ->join('department_info on department_info.departmentId=doctor_info.departmentId')
                    ->join('hospital_info on hospital_info.hospitalId=doctor_info.hospitalId')
                    ->where($map_doctor)
                    ->order('doctor_info.hospitalId')
                    ->limit($start, $pageSize)
                    ->select();
            }
        }
        if ($keyword) {
            /*添加管理员日志*/
            $log['managerId'] = $_SESSION['userMsg']['managerId'];
            $log['operationId'] = 4;
            $log['operationContent'] = "查询了医生：" . $keyword;
            M("manager_log")->add($log);
        }
        $this->assign("keyword", $keyword);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $totalPage);
        $this->assign("doctorInfo", $doctorInfo);
        $this->display();
    }
}