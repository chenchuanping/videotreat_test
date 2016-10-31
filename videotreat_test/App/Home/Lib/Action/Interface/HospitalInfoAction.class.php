<?php

/*                      医院列表接口
 * @param start                    int       数据请求的起始位置
 * @param limit                    int       请求的医院条数
 * @param client                   int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *           advert                array       首页广告数据
 *              advertId           int         广告序列号
 *              advertImage        string      广告图片的URL链接
 *              advertURL          string      广告跳转链接
 *           hospitalList          array       附近医院数据
 *              hospitalId         int         医院序列号
 *              hospitalName       string      医院名称
 *              hospitalLogo      string      医院LOGO的URL链接
 *              doctorNumber       int         入驻医师数量
 *              labelArray         sting       医院特长标签
 */

class HospitalInfoAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*按照是否投放，选择广告，0为投放，1为不投放 */
        $advertisement = D('advertisement')->field('advertId,advertImage,advertURL')->where('isDel=0')->select();
        $count = M("hospital_info")->count();
        $hospitalList = D('hospital_info')
            ->field('hospitalId,hospitalName,hospitalLogo,doctorNumber,labelArray')
            ->limit($start, $limit)
            ->where('isDel=0')//查找没有被删除的医院
            ->select();
        /*将广告和附近的医院放在一个数组中*/
        $data['advert'] = $advertisement;
        $data['hospitalList'] = $hospitalList;

        if ($data) {
            $code = 1;
            $message = "医院列表获取成功";
            if (($start + $limit) >= $count) {
                $message = "没有更多数据了";
            }
        } else {
            $code = 1;
            $message = "医院列表为空";
        }

        Response::log($_POST, $code, $message, $data);
        return Response::json($code, $message, $data);
    }
}
