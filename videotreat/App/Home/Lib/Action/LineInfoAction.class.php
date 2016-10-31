<?php

class LineInfoAction extends Action
{
    public function index()
    {
        $startRow = $_POST['startRow'];
        $pageSize = $_POST['pageSize'];
        $doctorId = $_SESSION['userMsg']['doctorId'];
        //获取当前排队的基本信息
        //刚注册的患者没有就诊记录表
        $doctor_line = M("user_line")->where("doctorId={$doctorId}")->select();
        foreach ($doctor_line as $v) {
            $userId = $v['userId'];
            /*查询 user_base_info 中有没有信息*/
            $userInfo = M("user_base_info")->where("userId={$userId}")->select();
            /*判断自述卡是否存在*/
            if ($userInfo) {
                $lineInfo = M()->query("select line.doctorId,line.userId,line.reportCardId,base.sex,base.birthday,base.userName,db.tel
                      from user_line as line,user_base_info as base,user_db_info as db
                      where line.userId=db.userId and line.userId=base.userId and line.doctorId={$doctorId}
                      order by line.create_time");

            } else {
                $lineInfo = M()->query("select line.doctorId,line.reportCardId,db.userId,db.tel
                      from user_line as line,user_db_info as db
                      where line.userId=db.userId and line.doctorId={$doctorId}
                      order by line.create_time");
            }
        }
        /*后期要修改  order by */
        echo json_encode($lineInfo);
    }
}