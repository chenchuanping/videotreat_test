<?php

class MeetingAction extends Action
{
    public function index()
    {
        $room = $_REQUEST['room'];
        $vendorKey = $_REQUEST['vendorKey'];
        $resolution = $_REQUEST['resolution'];
        /*获取视频时间*/
        $videoDuration = M("system_param")->where("paramCode='video_duration'")->getField('paramValue');
        if ($room && $vendorKey && $resolution) {
            /*修改医生表中，医生进入视频*/
            $isInVideo['isInVideo'] = 1;
            $doctorId = $_SESSION['userMsg']['doctorId'];
            M("doctor_info")->where("doctorId={$doctorId}")->save($isInVideo);

            $this->assign('room', $room);
            $this->assign('vendorKey', $vendorKey);
            $this->assign('resolution', $resolution);
            $this->assign('videoDuration', $videoDuration);
            $this->display();

        }
    }
}