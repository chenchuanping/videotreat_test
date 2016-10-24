<?php

class DoctorAction extends Action
{
    public function index()
    {
        if (!isset($_SESSION['userMsg']) && $_SESSION['login'] != 1) {
            $this->redirect('Login/index');
        }
        /*设置参数*/
        //定时刷新排队列表
        $get_line_time = M('system_param')->where("paramCode='get_line_time'")->getField('paramValue');
        $headPic = $_SESSION['userMsg']['headPic'];/*医生头像*/
        /*医生选填备注信息*/
        $remarkInfo=M("case_history_remark")->field('remarkId,remarkName')->select();
        $this->assign('remarkInfo',$remarkInfo);
        $this->assign('headPic', $headPic);/*拼接好的路径*/
        $this->assign("get_line_time", $get_line_time);
        $this->assign('doctorId',$_SESSION['userMsg']['doctorId']);
        $this->display('index');
    }

    //退出页面时，医生状态为忙碌
    public function modifyState()
    {
        $doctorId = $_SESSION['userMsg']['doctorId'];
        $data['stateId'] = 2;
        $result = M("doctor_info")->where('doctorId=' . $doctorId)->data($data)->save();
        echo json_encode($result);
    }

    public function changeState()
    {
        //ajax传过来的数据
        $stateId = $_POST['stateId'];
        $doctorId = $_SESSION['userMsg']['doctorId'];
        $_SESSION['userMsg']['stateId'] = $stateId;
        $data['stateId'] = $stateId;
        //修改医生状态
        $result = M("doctor_info")->where('doctorId=' . $doctorId)->save($data);
        if($result){
            $data['res']=1;
        }
        echo json_encode($data);
    }
}