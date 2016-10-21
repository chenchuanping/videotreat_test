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
            $lineInfo = M()->query("select line.doctorId,line.userId,line.reportCardId,sex_value,db.birthday,db.userName
                  from user_line as line,user_db_info as db,dic_user_sex as sex
                  where line.userId=db.userId  and line.doctorId={$doctorId} and db.sex_key=sex.sex_key
                  order by line.create_time");
        }
        /*后期要修改  order by */
        echo json_encode($lineInfo);
    }
}