<?php

/*                  修改自述卡接口
 * @param reportCardId              int        自述卡Id
 * @param reportCardName            string     自述卡名称
 * @param reportCardDescribe        string     患者病情自述
 * @param reportCardRemark          string     患者病情备注说明
 * @param reportCardDescribe        string     患者病情自述
 * @param image_1                   file       患者病情自述材料
 * @param image_2                   file       患者病情自述材料
 * @param image_3                   file       患者病情自述材料
 * @param image_4                   file       患者病情自述材料
 * @param image_5                   file       患者病情自述材料
 * @param image_6                   file       患者病情自述材料
 * @param image_7                   file       患者病情自述材料
 * @param image_8                   file       患者病情自述材料
 * @param image_9                   file       患者病情自述材料
 * @param imageCount                int         图片数量
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
 *             imageCount           int         图片数量
 */

class ReportCardModifyAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $reportCardId = $_POST['reportCardId'];   //自述卡Id
        $reportCardName = $_POST['reportCardName'];   //自述卡名称
        $reportCardDescribe = $_POST['reportCardDescribe'];  //患者病情自述
        $reportCardRemark = $_POST['reportCardRemark'];    //患者病情备注说明
        $imageCount = $_POST['imageCount'] ? $_POST['imageCount'] : 0;                      //给IOS专用的字段  图片数量
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*存储患者病情自述材料图片*/
        import('ORG.Net.UploadFile');
        $dir = "Public/userReportCard/";
        chmod($dir, 0777);       //设置权限问题
        $upload = new UploadFile();
        $upload->maxSize = "10485760";//上传的文件大小限制  10M (0-不做限制，1M为1048576字节)
        $upload->allowExts = array('jpg', 'png', 'gif', 'jpeg'); //允许上传的文件后缀
        $upload->autoSub = true;//自动子目录保存文件
        $upload->subType = "date";//子目录创建方式
        $upload->savePath = $dir;//保存路径
        $upload->dateFormat = "Ymd";
        $upload->uploadReplace = true;//存在同名是否覆盖
        //删除自述卡数据中的路径，以便于再次生成路径
        $del_image_data['reportCardImage'] = '';
        M("user_report_card")->where("reportCardId = {$reportCardId}")->save($del_image_data);
        $info = $upload->upload();  //上传头像
        $arr = $upload->getUploadFileInfo();
        $new_reportCardImage = '';
        if ($info) {
            foreach ($arr as $value) {
                $new_reportCardImage .= "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $value['savepath'] . $value['savename'] . ",";
            }
            $mod_data['reportCardImage'] = rtrim($new_reportCardImage, ',');
        } else {
            $mod_data['reportCardImage'] = '';
            //捕获上传异常
            $err = $upload->getErrorMsg();
            $code = 0;
            $message = "图片上传报错，错误为：" . $err;
        }

        $mod_data['reportCardName'] = $reportCardName;
        $mod_data['reportCardDescribe'] = $reportCardDescribe;
        $mod_data['reportCardRemark'] = $reportCardRemark;
        $mod_data['imageCount'] = $imageCount;
        $result = M("user_report_card")->where("reportCardId = {$reportCardId}")->save($mod_data);//修改自述卡数据
        if ($result) {
            $code = 1;
            $message = "自述卡修改成功";
            $reportCardInfo = M("user_report_card")->where("reportCardId = {$reportCardId}")->find();//查询自述卡数据
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
        } else {
            $code = 0;
            $message = "自述卡修改失败";
            $data = array();
        }

        return Response::json($code, $message, $data);
    }
}
