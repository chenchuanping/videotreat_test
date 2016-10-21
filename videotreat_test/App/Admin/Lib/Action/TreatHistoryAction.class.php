<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 17:46
 */
class TreatHistoryAction extends BaseAction
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
        if ($systemAdmin == 1) {               //超级管理员，可以看到所有就诊历史信息
            if ($keyword == null) {
                //获得总页数、总记录数
                $totalRow = M("treat_record")->count();
                $totalPage = ceil($totalRow / $pageSize);
                $userTreatInfo = M("treat_record")
                    ->field('base.userName,doctor.doctorId,doctor.doctorName,treatRecordId,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardDescribe,reportCardRemark,reportCardImage')
                    ->join('user_base_info as base on treat_record.userId=base.userId')
                    ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
                    ->order("treat_record.treatRecordId")
                    ->limit($start, $pageSize)
                    ->select();
                if ($userTreatInfo) {
                    foreach ($userTreatInfo as $k => $value) {
                        $otherInfo = M("doctor_info")
                            ->field('departmentName,hospitalName')
                            ->join("department_info as d on d.departmentId=doctor_info.departmentId")
                            ->join("hospital_info as h on doctor_info.hospitalId=h.hospitalId")
                            ->where("doctorId={$value['doctorId']}")
                            ->find();
                        $userTreatInfo[$k]['departmentName'] = $otherInfo['departmentName'];
                        $userTreatInfo[$k]['hospitalName'] = $otherInfo['hospitalName'];
                    }
                    foreach ($userTreatInfo as $k => $value) {
                        /*处理图片*/
                        $reportCardImages = explode(',', $value['reportCardImage']);
                        for ($i = 1; $i <= count($reportCardImages); $i++) {
                            $userTreatInfo[$k]['image_' . $i] = $reportCardImages[$i - 1];
                        }
                        unset($userTreatInfo[$k]['reportCardImage']);
                    }
                }
            } else {
                //获得总页数、总记录数
                $totalRow = M("treat_record")
                    ->join('user_base_info as base on treat_record.userId=base.userId')
                    ->where("userName like '%{$keyword}%'")
                    ->count();
                $totalPage = ceil($totalRow / $pageSize);
                $userTreatInfo = M("treat_record")
                    ->field('base.userName,doctor.doctorId,doctor.doctorName,treatRecordId,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardDescribe,reportCardRemark,reportCardImage')
                    ->join('user_base_info as base on treat_record.userId=base.userId')
                    ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
                    ->where("base.userName like '%{$keyword}%'")
                    ->order("treat_record.treatRecordId")
                    ->limit($start, $pageSize)
                    ->select();
                if ($userTreatInfo) {
                    foreach ($userTreatInfo as $k => $value) {
                        $otherInfo = M("doctor_info")
                            ->field('departmentName,hospitalName')
                            ->join("department_info as d on d.departmentId=doctor_info.departmentId")
                            ->join("hospital_info as h on doctor_info.hospitalId=h.hospitalId")
                            ->where("doctorId={$value['doctorId']}")
                            ->find();
                        $userTreatInfo[$k]['departmentName'] = $otherInfo['departmentName'];
                        $userTreatInfo[$k]['hospitalName'] = $otherInfo['hospitalName'];
                    }
                    foreach ($userTreatInfo as $k => $value) {
                        /*处理图片*/
                        $reportCardImages = explode(',', $value['reportCardImage']);
                        for ($i = 1; $i <= count($reportCardImages); $i++) {
                            $userTreatInfo[$k]['image_' . $i] = $reportCardImages[$i - 1];
                        }
                        unset($userTreatInfo[$k]['reportCardImage']);
                    }
                }
            }
        } else {           //普通管理员，只能查看他所管理的医院的病历
            $hospitalId = M("manager_hospital")->field('hospitalId')->where("managerId={$managerId}")->select();
            foreach ($hospitalId as $v) {
                $hospitalIdArray[] = $v['hospitalId'];            //拼接医院Id数组
            }
            $hospitalIdArray = array_unique($hospitalIdArray);        //去重复，以防万一有重复的
            $hospitalId_toString = implode(',', $hospitalIdArray);   //当前管理员所管理的医院所有Id
            /*查找当前管理员管理的医院的所有医生Id*/
            foreach ($hospitalIdArray as $value) {
                $doctorId_list = M("doctor_info")->field("doctorId")->where("hospitalId in ($hospitalId_toString)")->select();
            }
            foreach ($doctorId_list as $v) {
                $doctorIdArray[] = $v['doctorId'];            //拼接医生Id数组
            }
            $doctorIdArray = array_unique($doctorIdArray);        //去重复，以防万一有重复的
            $doctorId_toString = implode(',', $doctorIdArray);     //拼接成医生Id字符串
            if ($keyword == null) {
                //获得总页数、总记录数
                $totalRow = M("treat_record")->count();
                $totalPage = ceil($totalRow / $pageSize);
                $userTreatInfo = M("treat_record")
                    ->field('base.userName,doctor.doctorId,doctor.doctorName,treatRecordId,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardDescribe,reportCardRemark,reportCardImage')
                    ->join('user_base_info as base on treat_record.userId=base.userId')
                    ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
                    ->order("treat_record.treatRecordId")
                    ->where("treat_record.doctorId in ($doctorId_toString)")
                    ->limit($start, $pageSize)
                    ->select();
                if ($userTreatInfo) {
                    foreach ($userTreatInfo as $k => $value) {
                        $otherInfo = M("doctor_info")
                            ->field('departmentName,doctor_info.hospitalId,hospitalName')
                            ->join("department_info as d on d.departmentId=doctor_info.departmentId")
                            ->join("hospital_info as h on doctor_info.hospitalId=h.hospitalId")
                            ->where("doctorId={$value['doctorId']} and h.hospitalId in ({$doctorId_toString})")
                            ->find();
                        $userTreatInfo[$k]['departmentName'] = $otherInfo['departmentName'];
                        $userTreatInfo[$k]['hospitalName'] = $otherInfo['hospitalName'];
                    }
                    foreach ($userTreatInfo as $k => $value) {
                        /*处理图片*/
                        $reportCardImages = explode(',', $value['reportCardImage']);
                        for ($i = 1; $i <= count($reportCardImages); $i++) {
                            $userTreatInfo[$k]['image_' . $i] = $reportCardImages[$i - 1];
                        }
                        unset($userTreatInfo[$k]['reportCardImage']);
                    }
                }
            } else {
                //获得总页数、总记录数
                $totalRow = M("treat_record")
                    ->join('user_base_info as base on treat_record.userId=base.userId')
                    ->where("userName like '%{$keyword}%' and treat_record.doctorId in ($doctorId_toString)")
                    ->count();
                $totalPage = ceil($totalRow / $pageSize);
                $userTreatInfo = M("treat_record")
                    ->field('base.userName,doctor.doctorId,doctor.doctorName,treatRecordId,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardDescribe,reportCardRemark,reportCardImage')
                    ->join('user_base_info as base on treat_record.userId=base.userId')
                    ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
                    ->where("treat_record.doctorId in ($doctorId_toString)  and base.userName like '%{$keyword}%'")
                    ->limit($start, $pageSize)
                    ->select();
                if ($userTreatInfo) {
                    foreach ($userTreatInfo as $k => $value) {
                        $otherInfo = M("doctor_info")
                            ->field('departmentName,hospitalName')
                            ->join("department_info as d on d.departmentId=doctor_info.departmentId")
                            ->join("hospital_info as h on doctor_info.hospitalId=h.hospitalId")
                            ->where("doctorId={$value['doctorId']}")
                            ->find();
                        $userTreatInfo[$k]['departmentName'] = $otherInfo['departmentName'];
                        $userTreatInfo[$k]['hospitalName'] = $otherInfo['hospitalName'];
                    }
                    foreach ($userTreatInfo as $k => $value) {
                        /*处理图片*/
                        $reportCardImages = explode(',', $value['reportCardImage']);
                        for ($i = 1; $i <= count($reportCardImages); $i++) {
                            $userTreatInfo[$k]['image_' . $i] = $reportCardImages[$i - 1];
                        }
                        unset($userTreatInfo[$k]['reportCardImage']);
                    }
                }
            }
        }
        if ($keyword) {
            /*添加管理员日志*/
            $log['managerId'] = $_SESSION['userMsg']['managerId'];
            $log['operationId'] = 4;
            $log['operationContent'] = "查询了患者：" . $keyword . " 的就诊记录";
            M("manager_log")->add($log);
        }
        $this->assign("keyword", $keyword);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $totalPage);
        $this->assign("userTreatInfo", $userTreatInfo);
        $this->display();
    }
}