<?php

/*                  删除自述卡接口
 * @param reportCardId              int        自述卡Id
 *@ param client                    int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 */

class ReportCardDeleteAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $reportCardId = $_POST['reportCardId'];   //自述卡Id
        /* 删除以前的存储的图片*/
        $reportCardImage = M("user_report_card")->where("reportCardId={$reportCardId}")->getField("reportCardImage");
        $reportCardImageArr = explode(',', $reportCardImage);
        $len = count($reportCardImageArr);
        for ($i = 0; $i < $len; $i++) {
            $del_fileName = substr($reportCardImageArr[$i], strrpos($reportCardImageArr[$i], 'Public'));
            $fileName = '/var/www/html/' . APP_NAME . '/' . $del_fileName;
            unlink($fileName);
        }
        $result = M("user_report_card")->where("reportCardId={$reportCardId}")->delete();//删除没有被删除的自述卡数据
        if ($result) {
            $code = 1;
            $message = "自述卡删除成功";
        } else {
            $code = 0;
            $message = "自述卡删除失败";
        }
        return Response::json($code, $message);
    }
}
