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
            $lineInfo = M('user_line')
                ->field('doctorId,db.userId,reportCardId,db.userName,db.birthday,sex_value,behaviourName')
                ->join("user_db_info as db on db.userId=user_line.userId")
                ->join('dic_user_sex as sex on sex.sex_key=db.sex_key')
                ->join("user_behaviour on user_behaviour.userId=user_line.userId")
                ->order('user_line.create_time')
                ->select();
        }
        /*后期要修改  order by */
        echo json_encode($lineInfo);
    }
}