<?php

/*                          新增自述卡接口
 * @param userId                    int        用户id
 * @param reportCardName            string     自述卡名称
 * @param reportCardDescribe        string     患者病情自述
 * @param reportCardRemark          string     患者病情备注说明
 * @param reportCardDescribe        string     患者病情自述
 * @param imageCount                int         图片数量
 * @param image_1                   file       患者病情自述材料
 * @param image_2                   file       患者病情自述材料
 * @param image_3                   file       患者病情自述材料
 * @param image_4                   file       患者病情自述材料
 * @param image_5                   file       患者病情自述材料
 * @param image_6                   file       患者病情自述材料
 * @param image_7                   file       患者病情自述材料
 * @param image_8                   file       患者病情自述材料
 * @param image_9                   file       患者病情自述材料
 *@ param client                    int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *             reportCardId        int         自述卡ID
 *             reportCardName       string      自述卡名称
 *             reportCardDescribe   string      患者病情自述
 *             reportCardRemark     string      患者病情备注说明
 *             image_1              string       患者病情自述材料
 *             image_2              string       患者病情自述材料
 *             image_3              string       患者病情自述材料
 *             image_4              string       患者病情自述材料
 *             image_5              string       患者病情自述材料
 *             image_6             string        患者病情自述材料
 *             image_7             string       患者病情自述材料
 *             image_8             string       患者病情自述材料
 *             image_9             string       患者病情自述材料
 */

class ReportCardPutAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];   //用户id
        $reportCardName = trim($_POST['reportCardName']);   //自述卡名称
        $reportCardDescribe = $_POST['reportCardDescribe'] ? $_POST['reportCardDescribe'] : "";  //患者病情自述
        $reportCardRemark = $_POST['reportCardRemark'] ? $_POST['reportCardRemark'] : "";    //患者病情备注说明
        $imageCount = $_POST['imageCount'] ? $_POST['imageCount'] : 0;                      //给IOS专用的字段  图片数量
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*存储患者病情自述材料图片*/
        import('ORG.Net.UploadFile');
        $dir = "Public/userReportCard/";
        chmod($dir, 0777);       //设置权限问题
        $upload = new UploadFile();
        $upload->maxSize = "10485760";//上传的文件大小限制  10M (0-不做限制，1M为1048576字节) -1不限制大小
        $upload->allowExts = array('jpg', 'png', 'gif', 'jpeg', 'bmp'); //允许上传的文件后缀
        $upload->autoSub = true;//自动子目录保存文件
        $upload->subType = "date";//子目录创建方式
        $upload->saveRule = 'uniqid';// 上传文件命名规则
        $upload->savePath = $dir;//保存路径
        $upload->dateFormat = "Ymd";
        $upload->uploadReplace = false;//存在同名是否覆盖
        if ($reportCardName != '') {        //自述卡名称不为空，才能上传
            $info = $upload->upload();  //上传头像
            if ($info) {
                $reportCardImage = '';//患者病情自述材料图片
                $arr = $upload->getUploadFileInfo();
                if ($arr) {
                    foreach ($arr as $value) {
                        $reportCardImage .= "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $value['savepath'] . $value['savename'] . ",";
                    }
                    $add_data['reportCardImage'] = rtrim($reportCardImage, ',');
                }
            } else {
                $add_data['reportCardImage'] = '';//没有上传就为空
            }
            $add_data['userId'] = $userId;
            $add_data['reportCardName'] = $reportCardName;
            $add_data['reportCardDescribe'] = $reportCardDescribe;
            $add_data['reportCardRemark'] = $reportCardRemark;
            $add_data['imageCount'] = $imageCount;
            $reportCardId = M("user_report_card")->data($add_data)->add();//自述卡Id
            if ($reportCardId) {
                $code = 1;
                $message = "自述卡填写成功";
                $reportCardInfo = M("user_report_card")->where("reportCardId={$reportCardId}")->find();//查询没有被删除的自述卡数据
                $data['reportCardId'] = $reportCardInfo['reportCardId'];
                $data['reportCardName'] = $reportCardInfo['reportCardName'];
                $data['reportCardDescribe'] = $reportCardInfo['reportCardDescribe'];
                $data['reportCardRemark'] = $reportCardInfo['reportCardRemark'];
                /*处理图片*/
                $reportCardImages = explode(',', $reportCardInfo['reportCardImage']);
                $len = count($reportCardImages);
                for ($i = 1; $i <= $len; $i++) {
                    $data['image_' . $i] = $reportCardImages[$i - 1];
                }
                Response::log($_POST, $code, $message, $data);
                return Response::json($code, $message, $data);
            } else {
                $code = 0;
                $message = '添加失败';
                Response::log($_POST, $code, $message);
                return Response::json($code, $message, array());
            }
        } else {
            $code = 0;
            $message = "自述卡填写失败";
            $data = array();
            Response::log($_POST, $code, $message, $data);
            return Response::json($code, $message, $data);
        }

    }
}