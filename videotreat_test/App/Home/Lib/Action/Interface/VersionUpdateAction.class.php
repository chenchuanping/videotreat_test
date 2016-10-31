<?php

/*                      版本更新接口
 * @param client                int         手机型号区别，1为ios 0为android
 * @param version               string      版本号  1.0
 * return code                  int         状态码
 *        message               string      提示信息
 *        data                  array       返回的数据
 *           version                   string           版本号
 *           forcedUpdate               int             是否强制更新，1为强制，0为不强制
 *           versionContent             string          版本内容
 *           updateUrl                  string          升级链接
 *           updateTime                 string          升级时间
 */

class VersionUpdateAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $client = $_POST['client'];  //1为ios 0为android
        $old_version = $_POST['version'];
        //查找最新的版本信息
        $new_version = '';
        switch ($client) {
            case 1:
                $new_version = M("version")->where("phoneModel=1")->order("updateTime desc")->getField('version');
                break;
            case 0:
                $new_version = M("version")->where("phoneModel=0")->order("updateTime desc")->getField('version');
                break;
        }
        if ($old_version == $new_version) {
            $code = 0;
            $message = "您当前已是最新版本";
            $data = array();
        } else {
            $code = 1;
            $message = "检测到有新版本更新";
            $data = M("version")->field("version,forcedUpdate,versionContent,updateUrl,updateTime")->where("version='{$new_version}'")->order("updateTime desc")->find();
        }
        Response::log($code, $message, $data);
        return Response::json($code, $message, $data);
    }
}