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
            /*获取图片的宽高*/
            foreach ($reportCardInfo['reportCardImages'] as $k => $value) {
                $imageInfo=getimagesize($value);
                $width=$imageInfo[0];
                $hight=$imageInfo[1];
                $reportCardInfo['reportCardImageInfo'][$k]['width']=$width;
                $reportCardInfo['reportCardImageInfo'][$k]['height']=$hight;
                $reportCardInfo['reportCardImageInfo'][$k]['image']=$value;
            }
            unset($reportCardInfo['reportCardImages']);
        } else {
            $reportCardInfo = '';
        }
        //获取当前用户的基本信息
        $userInfo = M("user_db_info")
            ->field('tel,userName,sex_value,birthday,address,stature,weight')
            ->join('dic_user_sex as sex on sex.sex_key=user_db_info.sex_key')
            ->join("user_base_info as base on base.userId=user_db_info.userId")
            ->where("user_db_info.userId={$userId}")
            ->find();
        if (!$userInfo) {
            $userInfo = '';
        }
        $data['reportCardInfo'] = $reportCardInfo;
        $data['userInfo'] = $userInfo;
        echo json_encode($data);
    }
}