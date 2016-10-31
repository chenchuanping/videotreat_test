<?php

/*                          第三方登录接口
 * @param type                  string         类型  登录方式  qq wechat blog
 * @param thirdPartyId          string         第三方登录的Id  2EDC27BC43AB45BD5BEC3A8A61A7AFD3
 * @param imei                  string        手机imei  121c83f7602cd374ddb
 * @param nickName              string         昵称   非必需
 * @param headPic               string         头像   非必需
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
        $type = $_POST['type'];
        $imei = $_POST['imei'];
        $thirdPartyId = $_POST['thirdPartyId'];
        $nickName = $_POST['nickName'];
        $headPic = $_POST['headPic'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*先加入user_db_info  再加入qq_info中*/
        $data['third_type'] = $type;
        $thirdPartyInfo = '';
        $model = '';
        switch ($type) {
            case 'qq':
                $data['qq_key'] = $thirdPartyId;
                $thirdDate['qq_key'] = $thirdPartyId;
                $model = M("qq_info");
                $thirdPartyInfo = $model->where("qq_key='{$thirdPartyId}'")->find();
                break;
            case 'wechat':
                $data['wechat_key'] = $thirdPartyId;
                $thirdDate['wechat_key'] = $thirdPartyId;
                $model = M("wechat_info");
                $thirdPartyInfo = $model->where("wechat_key='{$thirdPartyId}'")->find();
                break;
            case 'blog':
                $data['blog_key'] = $thirdPartyId;
                $thirdDate['blog_key'] = $thirdPartyId;
                $model = M("blog_info");
                $thirdPartyInfo = $model->where("blog_key='{$thirdPartyId}'")->find();
                break;
            default :
                $code = 0;
                $message = "类型错误";
                break;
        }
        if ($thirdPartyInfo) {
            $code = 1;
            $message = "第三方" . $type . "非首次登录成功";
            $userId = $thirdPartyInfo['userId'];
            //修改第三方登录信息
            $thirdDate['userId'] = $userId;
            $thirdDate['imei'] = $imei;
            $thirdDate['nickName'] = $nickName;
            $thirdDate['headPic'] = $headPic;
            switch ($type) {
                case 'qq':
                    $thirdDate['qq_key'] = $thirdPartyId;
                    $model->where("qq_key='{$thirdPartyId}'")->save($thirdDate);
                    break;
                case 'wechat':
                    $thirdDate['wechat_key'] = $thirdPartyId;
                    $model->where("wechat_key='{$thirdPartyId}'")->save($thirdDate);
                    break;
                case 'blog':
                    $thirdDate['blog_key'] = $thirdPartyId;
                    $model->where("blog_key='{$thirdPartyId}'")->save($thirdDate);
                    break;
                default :
                    break;
            }
            unset($thirdDate['nickName']);
            unset($thirdDate['imei']);
            $thirdDate['userName'] = $nickName;
            M('user_base_info')->where("userId='{$userId}'")->save($thirdDate);
        } else {
            $data['imei'] = $imei;        /*手机Imei，用来推送的*/
            $userId = M("user_db_info")->data($data)->add();/*自增长的，用户userId*//*将对应的userId  的每个任务和完成情况，在user_task表中，初始化*/;
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
            //将第三方登录的信息存入user_base_info中
            $thirdPartyDate['userName'] = $nickName;
            $thirdPartyDate['userId'] = $userId;
            $thirdPartyDate['headPic'] = $headPic;
            $result = M("user_base_info")->data($thirdPartyDate)->add();
            if ($result) {
                $code = 1;
                $message = "第三方" . $type . "登录成功";
            } else {
                $code = 0;
                $message = "第三方" . $type . "登录失败";
            }
        }

        return Response::json($code, $message, (int)$userId);
    }
}
