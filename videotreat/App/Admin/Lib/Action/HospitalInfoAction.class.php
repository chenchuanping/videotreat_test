<?php
class  HospitalInfoAction extends BaseAction{
    public function index()
    {
        /*搜索*/
        $keyword = $_POST["keyword"];
        $keyword=str_replace("%","\\%",$keyword);
        $keyword=str_replace("_","\\_",$keyword);
        $keyword=str_replace(" ","\\%",$keyword);
        //分页变量
        $currentPage = $_POST["currentPage"];
        $currentPage = $currentPage==NULL?1:$currentPage;
        $pageSize = 5;
        $totalRow = 0;
        $totalPage = 0;
        $start = ($currentPage-1)*$pageSize;

        /*判断角色，是超级管理员，还是某家医院的管理员*/
        $managerId=$_SESSION['userMsg']['managerId'];
        $systemAdmin = $_SESSION['userMsg']['systemAdmin'];
        if($systemAdmin==1) {               //超级管理员，可以看到所有医生信息
            if($keyword==null){
                //获得总页数、总记录数
                $totalRow = M("hospital_info")->where("isDel=0")->count();
                $totalPage = ceil($totalRow/$pageSize);
                $hospitalInfo=M('hospital_info')
                    ->field('hospitalId,hospitalName,hospitalLogo,hospitalImage,doctorNumber,hospitalAddress,labelArray,hospitalIntroduction')
                    ->where("isDel=0")         //表示没有被删除
                    ->limit($start,$pageSize)
                    ->select();
            }else{
                //获得总页数、总记录数
                $totalRow = M("hospital_info")->where("hospitalName like '%{$keyword}%'")->count();
                $totalPage = ceil($totalRow/$pageSize);
                //查询医院
                $hospitalInfo=M('hospital_info')
                    ->field('hospitalId,hospitalName,hospitalLogo,hospitalImage,doctorNumber,hospitalAddress,labelArray,hospitalIntroduction')
                    ->where("hospitalName like '%{$keyword}%' and isDel=0")   //表示没有被删除
                    ->limit($start,$pageSize)
                    ->select();
                /*添加管理员日志*/
                $managerName=$_SESSION['userMsg']['managerName'];
                $log['managerId']=$_SESSION['userMsg']['managerId'];
                $log['operation']=$managerName."在".date('Y-m-d H:i:s')."搜索了医院：".$keyword;
                M("manager_log")->add($log);
            }
        }else{
            $hospitalId=M("manager_hospital")->field('hospitalId')->where("managerId={$managerId}")->select();
            foreach($hospitalId as $v){
                $hospitalIdArray[]=$v['hospitalId'];            //拼接医院Id数组
            }
            $map_hospital['hospitalId']=array('in',$hospitalIdArray);//当前管理员所管理的医院Id数组
            $map_hospital['isDel']=0;                       //表示没有被删除
            //获得总页数、总记录数
            $totalRow = M("hospital_info")->where($map_hospital)->count();
            $totalPage = ceil($totalRow/$pageSize);
            if($keyword==null){
                $hospitalInfo=M('hospital_info')
                    ->field('hospitalId,hospitalName,hospitalLogo,hospitalImage,doctorNumber,hospitalAddress,labelArray,hospitalIntroduction')
                    ->where($map_hospital)
                    ->limit($start,$pageSize)
                    ->select();
            }else{
                $map_hospital['hospitalName']=array('like',"%{$keyword}%");//搜索查询
                //获得总页数、总记录数
                $totalRow = M("hospital_info")->where("hospitalName like '%{$keyword}%'")->count();
                $totalPage = ceil($totalRow/$pageSize);
                //查询医院
                $hospitalInfo=M('hospital_info')
                    ->field('hospitalId,hospitalName,hospitalLogo,hospitalImage,doctorNumber,hospitalAddress,labelArray,hospitalIntroduction')
                    ->where($map_hospital)   //表示没有被删除
                    ->limit($start,$pageSize)
                    ->select();
                /*添加管理员日志*/
                $managerName=$_SESSION['userMsg']['managerName'];
                $log['managerId']=$_SESSION['userMsg']['managerId'];
                $log['operation']=$managerName."在".date('Y-m-d H:i:s')."搜索了医院：".$keyword;
                M("manager_log")->add($log);
            }
        }
        if($keyword){
            /*添加管理员日志*/
            $log['managerId']=$_SESSION['userMsg']['managerId'];
            $log['operationId']=4;
            $log['operationContent']="查询了医院：".$keyword;
            M("manager_log")->add($log);
        }
        $this->assign("keyword",$keyword);
        $this->assign("currentPage",$currentPage);
        $this->assign("totalPage",$totalPage);
        $this->assign("hospitalInfo",$hospitalInfo);
        $this->display();
    }
}