<?php

/*                  医生详情接口
 * @param userId                   int        用户Id
 * @param doctorId                 int        医生Id
 * @param client                   int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *           on_line_sign         int           当前用户在当前医生排队中
 *           like                 int         是否关注医生    1为关注
 *          doctorState         string      医生在线状态  有4人在队列中，空闲，离开
 *          waitTime            string      每人的就诊时间预计为15分钟
 *          doctorList           array        指定医生数据
 *              doctorId                int         医生序列号
 *              headPic                 string      医生头像
 *              professName             string      医生职称
 *              departmentName          string      医生所在科室
 *              special                 string      医生特长
 *              profile                 string      医生简介
 */

class DoctorDetailAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $doctorId = $_POST['doctorId'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*判断当前用户是否在队列中*/
        /*这个人的所有亲友Id*/
        $friends = M("user_friends_list")->field('friendUserId')->where("userId={$userId}")->select();
        $friend_user_line_info = '';
        foreach ($friends as $v) {
            $friend_user_line_info .= M("user_line")->where("userId={$v['friendUserId']} and doctorId={$doctorId}")->find();
        }
        $user_line_info = M("user_line")->where("userId={$userId} and doctorId={$doctorId}")->find();
        if ($friend_user_line_info || $user_line_info) {
            $data['on_line_sign'] = 1;        /*当前用户在当前医生排队中*/
        } else {
            $data['on_line_sign'] = 0;
        }
        /*是否关注*/
        $like = M("attention_doctor")->where("doctorId={$doctorId} and userId={$userId}")->find();
        if ($like) {
            $data['like'] = 1;
        } else {
            $data['like'] = 0;
        }
        /*获取当前医生信息*/
        $doctorInfo = M('doctor_info')
            ->field('doctorId,headPic,professName,departmentName,special,profile')
            ->join('profess_info on profess_info.professId=doctor_info.professId')
            ->join('department_info on department_info.departmentId=doctor_info.departmentId')
            ->where("doctorId={$doctorId}")
            ->find();
        /* 医生在线状态  有4人在队列中，空闲，离开*/
        $doctorState = M("user_line")->where("doctorId={$doctorId}")->select();
        /*判断医生是否空闲或忙碌*/
        $state = M("doctor_info")->field('stateId')->where("doctorId={$doctorId}")->find();
        if ($state['stateId'] != 3) {
            if ($doctorState != null) {
                $data['doctorState'] = '有' . count($doctorState) . '人在队列中';
                $data['waitTime'] = "预计时间为" . (count($doctorState) * 15) . "分钟";   //每人的就诊时间预计为15分钟
            } else {
                if ($state['stateId'] == 2) {
                    $data['doctorState'] = '忙碌';
                } else {
                    $data['doctorState'] = '空闲';
                }
            }
        } else {
            $data['doctorState'] = '离开';
        }
        $data['doctorList'] = $doctorInfo;
        if ($data) {
            $code = 1;
            $message = "医生详情获取成功";
        } else {
            $code = 1;
            $message = "医生详情为空";
            $data = '';
        }
        return Response::json($code, $message, $data);
    }
}
