<?php

/*                      第三方登录用户手机号录入接口
 * @param type                  string         类型  登录方式  qq wechat blog
 * @param thirdPartyId          string         第三方登录的Id  2EDC27BC43AB45BD5BEC3A8A61A7AFD3
 * @param nickName              string         昵称   非必需
 * @param headPic               string         头像   非必需
 * @param client                int         手机型号区别，1为ios 0为android
 * return code                  int         状态码
 *        message               string      提示信息
 *        data                  array       返回的数据
 *           userId               int             用户登录成功后 给客户端传一个userId
 */

class UserThirdPartyLoginTelPutAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $type = $_POST['type'];
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
        } else {
            $userId = M("user_db_info")->data($data)->add();/*自增长的，用户userId*/
            $thirdDate['userId'] = $userId;
            $thirdDate['nickName'] = $nickName;
            $thirdDate['headPic'] = $headPic;
            $result = $model->data($thirdDate)->add();
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
