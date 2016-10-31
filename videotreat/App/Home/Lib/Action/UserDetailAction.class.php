<?php

class UserDetailAction extends Action
{
    public function index()
    {
        $userId = $_POST['userId'];
        $reportCardId = $_POST['reportCardId'] ? $_POST['reportCardId'] : "";
        //获取自述卡信息
        if ($reportCardId != null && $reportCardId != '') {
            $result = M("treat_record_report_card")
                ->field("reportCardName,reportCardDescribe,reportCardImage")
                ->where("userId={$userId} and reportCardId={$reportCardId}")
                ->find();//查询没有被删除的自述卡数据
            $reportCardInfo['reportCardName'] = $result['reportCardName'];
            $reportCardInfo['reportCardDescribe'] = $result['reportCardDescribe'];
            /*处理图片*/
            $reportCardImages = explode(',', $result['reportCardImage']);
            $reportCardInfo['reportCardImages'] = $reportCardImages;
        } else {
            $reportCardImages = '';
        }
        //获取当前用户的基本信息
        $userInfo = M("user_base_info")->field('db.tel,userName,sex,birthday,address,stature,weight')
            ->join("user_db_info as db on db.userId=user_base_info.userId")
            ->where("user_base_info.userId={$userId}")
            ->find();
        if (!$userInfo) {
            $userInfo = '';
        }
        $data['reportCardInfo'] = $reportCardInfo;
        $data['userInfo'] = $userInfo;
        echo json_encode($data);
    }
}