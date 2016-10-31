<?php

/*                      版本更新接口
 * @param client                int         手机型号区别，1为ios 0为android
 * @param version               string      版本号  1.0
 * @param userId                int         用户Id
 * @param suggestion            string      用户建议
 * @param image_1               file       用户建议图片1
 * @param image_2               file       用户建议图片2
 * @param image_3               file       用户建议图片3
 * @param tel                   string      用户手机号，默认是当前手机号，可以修改
 * return code                  int         状态码
 *        message               string      提示信息
 */

class SuggestionFeedBackAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $client = $_POST['client'];  //1为ios 0为android
        $version = $_POST['version'];
        $userId = $_POST['userId'];
        $suggestion = $_POST['suggestion'];
        $tel = $_POST['tel'];
        /*存储用户建议图片*/
        import('ORG.Net.UploadFile');
        $dir = "Public/suggestionImages/";
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
        $info = $upload->upload();  //上传头像
        if ($info) {
            $suggestionImage = '';//患者病情自述材料图片
            $arr = $upload->getUploadFileInfo();
            if ($arr) {
                foreach ($arr as $value) {
                    $suggestionImage .= "http://" . $_SERVER["SERVER_NAME"] . __ROOT__ . "/" . $value['savepath'] . $value['savename'] . ",";
                }
                $suggestion_add['suggestionImage'] = rtrim($suggestionImage, ',');
            }
        } else {
            $suggestion_add['suggestionImage'] = '';//没有上传就为空
        }
        $suggestion_add['userId'] = $userId;
        $suggestion_add['suggestion'] = $suggestion;
        $suggestion_add['tel'] = $tel;
        if ($suggestion_add) {
            $result = M("suggestion_feedback")->add($suggestion_add);
            if ($result) {
                $code = 1;
                $message = "意见反馈填写成功";
            } else {
                $code = 0;
                $message = "意见反馈填写失败";
            }
        }
        Response::log($_POST, $code, $message);
        return Response::json($code, $message);
    }
}