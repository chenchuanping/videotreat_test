<?php

/*                          第三方登录接口
 * @param type                  string         类型  登录方式  qq wechat blog
 * @param thirdPartyId          string         第三方登录的Id  2EDC27BC43AB45BD5BEC3A8A61A7AFD3
 * @param imei                  string        手机imei  121c83f7602cd374ddb
 * @param token                 string          token值
 * @param nickName              string         昵称   非必需
 * @param headPic               string         头像   非必需
 * @param gender                int           性别   非必需
 * @param client                int         手机型号区别，1为ios 0为android
 * return code                  int         状态码
 *        message               string      提示信息
 *        data                  array       返回的数据
 *           userId               int             用户登录成功后 给客户端传一个userId
 */

class UserThirdPartyLoginAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $type = $_REQUEST['type'];
        $imei = $_REQUEST['imei'];
        $thirdPartyId = $_REQUEST['thirdPartyId'];
        $token = $_REQUEST['token'];
        $nickName = $_REQUEST['nickName'];
        $headPic = $_REQUEST['headPic'];
        $gender = $_REQUEST['gender'];//性别
        $client = $_REQUEST['client'];/*0为安卓，1为iOS*/
        $thirdPartyInfo = '';
        $model = '';
        switch ($type) {
            case 'QQ':
                $model = M("qq_info");
                $thirdDate['qq_key'] = $thirdPartyId;
                $thirdDate['qq_token'] = $token;
                $thirdPartyInfo = $model->where("qq_key='{$thirdPartyId}'")->find();
                break;
            case 'Wechat':
                $model = M("wechat_info");
                $thirdDate['wechat_key'] = $thirdPartyId;
                $thirdDate['wechat_token'] = $token;
                $thirdPartyInfo = $model->where("wechat_key='{$thirdPartyId}'")->find();
                break;
            case 'SinaWeibo':
                $model = M("blog_info");
                $thirdDate['blog_key'] = $thirdPartyId;
                $thirdDate['blog_token'] = $token;
                $thirdPartyInfo = $model->where("blog_key='{$thirdPartyId}'")->find();
                break;
        }

        /*非首次登录  只需要找到userId 把imei存进表中*/
        if ($thirdPartyInfo) {

            $userId = $thirdPartyInfo['userId'];
            $data['imei'] = $imei;
            $data['userId'] = $userId;
            $data['client'] = $client;
            $result = M("user_db_info")->where("userId='%d'", $userId)->save($data);
            if ($result) {
                $code = 1;
                $message = "第三方" . $type . "非首次登录成功";
            } else {
                $code = 0;
                $message = "第三方" . $type . "非首次登录失败";
            }

        } else {                          /*首次登录 */
            $data['userName'] = $nickName;
            $data['sex_key'] = $gender;
            $data['imei'] = $imei;        /*手机Imei，用来推送的*/
            $data['third_type'] = $type;
            $data['client'] = $client;
            $userId = M("user_db_info")->data($data)->add();/*自增长的，用户userId  将对应的userId  的每个任务和完成情况，在user_task表中，初始化*/;

            $taskInfo = M("task_info")->field('taskId')->select();
            foreach ($taskInfo as $v) {
                $taskData['userId'] = $userId;
                $taskData['taskId'] = $v['taskId'];
                M("user_task")->data($taskData)->add();
            }
            //将数据分别加到对应的表中
            $thirdDate['userId'] = $userId;
            $thirdDate['nickName'] = $nickName;
            $thirdDate['headPic'] = $headPic;
            $model->data($thirdDate)->add();

            //将第三方登录的头像存入user_base_info
            $thirdPartyDate['userId'] = $userId;
            $thirdPartyDate['headPic'] = $headPic;
            $result = M("user_base_info")->data($thirdPartyDate)->add();
            if ($result) {
                $code = 1;
                $message = "第三方" . $type . "首次登录成功";
            } else {
                $code = 0;
                $message = "第三方" . $type . "登录失败";
            }
        }

        return Response::json($code, $message, (int)$userId);
    }
}
