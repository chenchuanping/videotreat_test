<?php

/*
 *                            医生、医院的关注/取消关注接口
 * @param state                   string       判断是关注还是取消  attention关注  cancel取消关注
 * @param type                    string       关注类型      doctor  或   hospital
 * @param userId                  int         用户id
 * @param id                      int         医生或医院的id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据  为空
 */

class AttentionAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $state = $_POST['state'];/*判断是关注还是取消*/
        $type = $_POST['type'];/*关注类型 */
        $userId = $_POST['userId'];/*用户id*/
        $id = $_POST['id'];           /*医生或医院的id*/
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $data['userId'] = $userId;
        if ($type == 'hospital') {
            if ($state == 'attention') {                //关注医院
                $data['hospitalId'] = $id;
                $attention_info = M("attention_hospital")->where("userId={$userId} and hospitalId={$id}")->find();
                if ($attention_info) {
                    $code = 101;
                    $message = '医院已被关注';
                } else {
                    $result = M("attention_hospital")->add($data);
                    if ($result) {
                        $code = 1;
                        $message = '关注医院成功';
                    } else {
                        $code = 0;
                        $message = '关注医院失败';
                    }
                }
            } elseif ($state == 'cancel') {              //取消关注医院
                $attention_info = M("attention_hospital")->where("userId={$userId} and hospitalId={$id}")->find();
                if (!$attention_info) {
                    $code = 101;
                    $message = '医院已取消关注';
                } else {
                    $result = M("attention_hospital")->where("userId={$userId} and hospitalID={$id}")->delete();
                    if ($result) {
                        $code = 1;
                        $message = '取消关注成功';
                    } else {
                        $code = 0;
                        $message = '取消关注失败';
                    }
                }
            } else {
                $code = 0;
                $message = 'state参数不正确';
            }
        } elseif ($type == 'doctor') {
            if ($state == 'attention') {                //关注医生
                $data['doctorId'] = $id;
                $attention_info = M("attention_doctor")->where("userId={$userId} and doctorId={$id}")->find();
                if ($attention_info) {
                    $code = 101;
                    $message = '医生已关注';
                } else {
                    $result = M("attention_doctor")->add($data);
                    if ($result) {
                        $code = 1;
                        $message = '关注医生成功';
                    } else {
                        $code = 0;
                        $message = '关注医生失败';
                    }
                }
            } elseif ($state == 'cancel') {              //取消关注医生
                $attention_info = M("attention_doctor")->where("userId={$userId} and doctorId={$id}")->find();
                if (!$attention_info) {
                    $code = 101;
                    $message = '医生已取消关注';
                } else {
                    $result = M("attention_doctor")->where("userId={$userId} and doctorId={$id}")->delete();
                    if ($result) {
                        $code = 1;
                        $message = '取消关注成功';
                    } else {
                        $code = 0;
                        $message = '取消关注失败';
                    }
                }
            } else {
                $code = 0;
                $message = 'state参数不正确';
            }
        } else {
            $code = 0;
            $message = 'type参数不正确';
        }
        return Response::json($code, $message);
    }
}
