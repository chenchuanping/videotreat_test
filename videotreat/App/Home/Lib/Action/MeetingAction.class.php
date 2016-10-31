<?php
class MeetingAction extends Action{
    public function index()
    {
        $room=$_REQUEST['room'];
        $vendorKey=$_REQUEST['vendorKey'];
        $resolution=$_REQUEST['resolution'];
        if($room && $vendorKey && $resolution){
            $this->assign('room',$room);
            $this->assign('vendorKey',$vendorKey);
            $this->assign('resolution',$resolution);
            $this->display();
        }
    }
}