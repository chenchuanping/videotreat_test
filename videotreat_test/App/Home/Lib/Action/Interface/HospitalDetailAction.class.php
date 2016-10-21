<?php

/*                      医院详情接口
 * @param userId                   int       用户Id,没有登录则输入0
 * @param hospitalId               int       请求的医院序号
 * @param type                     string    请求的数据类型 doctorList   医生   introduction简介
 * @param client                   int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                array             返回的数据
 *           like                 int         是否关注    1为关注
 *          doctorList            array        指定医生数据
 *              doctorId            int         医生id
 *              doctorName          string      医生名称
 *              headPic             string      医生头像
 *              professName         string      医生职称
 *              departmentName      string      医生所在科室
 *              stateName           string      医生在线状态
 *              labelArray          sting       医生标签
 *          introduction         array       医院简介数据
 *              hospitalIntroduction   string   医院简介
 *              hospitalImage       string      医院的图片
 *
 */

class HospitalDetailAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $hospitalId = $_POST['hospitalId'];
        $type = $_POST['type'];//请求的数据类型   $type=doctorList   医生    $type=introduction   简介
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*是否关注*/
        $like = M("attention_hospital")->where("hospitalId={$hospitalId} and userId={$userId}")->find();
        if ($like) {
            $data['like'] = 1;
        } else {
            $data['like'] = 0;
        }
        if ($type == 'doctorList') {
            /*获取当前医院的医生信息*/
            $doctorInfo = M('doctor_info')
                ->field('doctorId,doctorName,headPic,professName,departmentName,doctor_info.stateId,stateName,labelArray')
                ->join('state_info on state_info.stateId=doctor_info.stateId')
                ->join('profess_info on profess_info.professId=doctor_info.professId')
                ->join('department_info on department_info.departmentId=doctor_info.departmentId')
                ->where("hospitalId={$hospitalId} and isDel=0")
                ->order('stateId')
                ->select();
            $message = '医院医生获取成功';
        } elseif ($type == 'introduction') {
            /*获取当前医院的简介*/
            $introduction = M("hospital_info")->field('hospitalIntroduction,hospitalImage')->where("hospitalId={$hospitalId}")->find();
            $message = '医院简介获取成功';
        }
        $data['doctorList'] = $doctorInfo;
        $data['introduction'] = $introduction;
        if ($data) {
            return Response::json(1, $message, $data);
        } else {
            return Response::json(1, "医院详情为空", array());
        }

    }
}
