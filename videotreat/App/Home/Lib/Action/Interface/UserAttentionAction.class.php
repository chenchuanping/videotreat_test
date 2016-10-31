<?php

/*                      用户的关注列表接口
 * @param type                    string       关注类型      doctor  或   hospital
 * @param start                   int          数据请求的起始位置
 * @param limit                   int          请求的条数
 * @param userId                  int          用户id
 * @param id                      int         医生或医院的id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 *           hospitalList            array       附近医院数据
 *              hospitalId              int         医院序列号
 *              hospitalName            string      医院名称
 *              hospitalLogo            string      医院LOGO的URL链接
 *              doctorNumber            int         入驻医师数量
 *              labelArray              sting       医院特长标签
 *          doctorList           array        指定医生数据
 *              doctorId                int         医生序列号
 *              doctorName              string      医生姓名
 *              headPic                 string      医生头像
 *              professName             string      医生职称
 *              departmentName          string      医生所在科室
 *              special                 string      医生特长
 *              profile                 string      医生简介
 *              doctorState         string      医生在线状态  有4人在队列中，空闲，离开
 */

class UserAttentionAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $type = $_POST['type'];                                    //请求的数据类型   doctor  或   hospital
        $start = $_POST['start'];                                 //数据请求的起始位置
        $limit = $_POST['limit'];                                 //请求的条数
        $client = $_POST['client'];                             /*0为安卓，1为iOS*/
        $data = array();
        if ($type === 'hospital') {
            $sql = "select h.hospitalId,h.hospitalName,h.hospitalLogo,h.doctorNumber,h.labelArray from hospital_info as h,attention_hospital as a
                where h.hospitalId=a.hospitalId and a.userId={$userId} limit {$start},{$limit}";
            $hospitalList = M()->query($sql);
            $message = '用户关注医院详情获取成功';
            $count = M("attention_hospital")->where("userId={$userId}")->count();
        } elseif ($type === 'doctor') {
            $sql = "select d.doctorId,d.doctorName,d.headPic,d.labelArray,pro.professName,dep.departmentName,s.stateId,s.stateName from state_info as s, doctor_info as d, attention_doctor as a,department_info as dep,profess_info as pro
                where d.doctorId=a.doctorId and d.departmentId=dep.departmentId and d.professId=pro.professId and d.stateId=s.stateId  and a.userId={$userId}  limit {$start},{$limit}";
            $doctorList = M()->query($sql);
            $message = '用户关注医生详情获取成功';
            $count = M("attention_doctor")->where("userId={$userId}")->count();
        }
        $data['hospitalList'] = $hospitalList;
        $data['doctorList'] = $doctorList;

        if (($start + $limit) >= $count) {
            $message = "没有更多数据了";
        }
        if ($data) {
            return Response::json(1, $message, $data);
        } else {
            return Response::json(1, '用户关注为空', array());
        }
    }
}
