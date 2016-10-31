<?php

/*                      附近医院接口
 * @param nearHospital             array       附近医院数组
 * @param client                   int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *           hospitalList          array       附近医院数据
 *              hospitalId         int         医院序列号
 *              hospitalName       string      医院名称
 *              hospitalLogo       string      医院LOGO的URL链接
 *              doctorNumber       int         入驻医师数量
 *              labelArray         sting       医院特长标签
 *
 */

class NearHospitalAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $nearby = $_POST['nearHospital'] ? $_POST['nearHospital'] : ["河北省邢台市医院", '昌平区中医院'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/

        $hospital_total = D('hospital_info')->field('hospitalName')->select();   //医院的全部数据
        foreach ($hospital_total as $k => $v) {
            foreach ($v as $vv) {
                $hospital_total_name[] = $vv;       //$hospital_total_name就是数据库中存在的医院名称的数据
            }
        }
        foreach ($nearby as $v) {
            if (in_array($v, $hospital_total_name)) {  /*如果附近的医院在数据表中存在，而且是合作的医院*/
                $hospitalList[] = $v;      //把附近在数据库表中的医院，放在$hospitalList中
            }
        }
        /*查找符合条件的医院的信息*/
        foreach ($hospitalList as $v) {
            $hospitalList_detail[] = D("hospital_info")
                ->field('hospitalId,hospitalName,hospitalLogo,doctorNumber,labelArray')
                ->where("hospitalName='{$v}' and isDel=0")//查找没有被删除的医院
                ->find();
        }
        $data['hospitalList'] = $hospitalList_detail;
        if ($data) {
            return Response::json(1, '附近医院获取成功', $data);
        } else {
            return Response::json(1, '附近医院为空', array());
        }
    }
}
