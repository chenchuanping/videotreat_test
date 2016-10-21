<?php

/*                  自述卡信息接口
 * @param userId                    int        用户id
 * @param reportCardId              int         自述卡ID
 * @ param client                    int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *             reportCardId        int         自述卡ID
 *             reportCardName       string      自述卡名称
 *             reportCardDescribe   string      患者病情自述
 *             reportCardRemark     string      患者病情备注说明
 *             image_1              string      患者病情自述材料
 *             image_2              string      患者病情自述材料
 *             image_3              string      患者病情自述材料
 *             image_4              string      患者病情自述材料
 *             image_5              string      患者病情自述材料
 *             image_6             string       患者病情自述材料
 *             image_7             string       患者病情自述材料
 *             image_8             string       患者病情自述材料
 *             image_9             string       患者病情自述材料
 *             imageCount          int         图片数量
 */

class ReportCardGetAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];   //用户id
        $reportCardId = $_POST['reportCardId'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $reportCardInfo = M("user_report_card")
            ->field("reportCardId,reportCardName,reportCardDescribe,reportCardRemark,reportCardImage,imageCount")
            ->where("userId={$userId} and reportCardId={$reportCardId}")
            ->find();//查询没有被删除的自述卡数据
        $data['reportCardId'] = $reportCardInfo['reportCardId'];
        $data['reportCardName'] = $reportCardInfo['reportCardName'];
        $data['reportCardDescribe'] = $reportCardInfo['reportCardDescribe'];
        $data['reportCardRemark'] = $reportCardInfo['reportCardRemark'];
        $data['imageCount'] = $reportCardInfo['imageCount'];
        /*处理图片*/
        $reportCardImages = explode(',', $reportCardInfo['reportCardImage']);
        for ($i = 1; $i <= count($reportCardImages); $i++) {
            $data['image_' . $i] = $reportCardImages[$i - 1];
        }
        if ($data) {
            $code = 1;
            $message = "自述卡详情获取成功";
        } else {
            $code = 0;
            $message = "自述卡详情获取失败";
            $data = array();
        }
        return Response::json($code, $message, $data);
    }
}
