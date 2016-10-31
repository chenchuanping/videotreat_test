<?php

/*                      就诊记录信息接口
 * @param userId                    int        用户id
 * @ param client                    int         手机型号区别，1为ios 0为android
 * return code                     int         状态码
 *        message                  string      提示信息
 *        data                     array       返回的数据
 *             treatRecordId        int         病例Id
 *              treatTime           string      病例填写时间
 *              doctorName          string      医师姓名
 *              departmentName      string      医师对应科室
 *              hospitalName        string      医师所在医院名称
 *              userName            string      患者姓名
 *             reportCardDescribe   string      患者病情自述
 *             reportCardName     string        患者病情名称
 *             treatmentImage_1     string       患者病情自述材料
 *             treatmentImage_2     string       患者病情自述材料
 *             treatmentImage_3     string       患者病情自述材料
 *             treatmentImage_4     string       患者病情自述材料
 *             treatmentImage_5     string       患者病情自述材料
 *             treatmentImage_6     string        患者病情自述材料
 *             treatmentImage_7     string       患者病情自述材料
 *             treatmentImage_8     string       患者病情自述材料
 *             treatmentImage_9     string       患者病情自述材料
 *             zusu                 string       主诉
 *             xianbingshi          string      现病史
 *             jiwangshi            string      既往史
 *             doctorSuggest        string      医生建议
 */

class TreatRecordGetAllAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];   //用户id
        $client = $_POST['client'];/*0为安卓，1为iOS*/

        $userTreatInfo = M("treat_record")
            ->field('treatRecordId,treat_record.doctorId,db.userName,doctor.doctorName,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardDescribe,reportCardImage')
            ->join('user_db_info as db on treat_record.userId=db.userId')
            ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
            ->where("treat_record.userId={$userId}")
            ->select();
        $friends = M('user_friends_list')->field('friendUserId')->where("userId={$userId}")->select();
        foreach ($friends as $value) {
            $friendTreatInfo = M("treat_record")
                ->field('treatRecordId,treat_record.doctorId,db.userName,doctor.doctorName,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardDescribe,reportCardImage')
                ->join('user_db_info as db on treat_record.userId=db.userId')
                ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
                ->where("treat_record.userId={$value['friendUserId']}")
                ->find();

            if ($friendTreatInfo != null) {
                $userTreatInfo[] = $friendTreatInfo;
            }
        }

        if ($userTreatInfo) {
            foreach ($userTreatInfo as $k => $value) {
                $otherInfo = M("doctor_info")
                    ->field('departmentName,hospitalName')
                    ->join("department_info as d on d.departmentId=doctor_info.departmentId")
                    ->join("hospital_info as h on doctor_info.hospitalId=h.hospitalId")
                    ->where("doctorId={$value['doctorId']}")
                    ->find();
                $userTreatInfo[$k]['departmentName'] = $otherInfo['departmentName'];
                $userTreatInfo[$k]['hospitalName'] = $otherInfo['hospitalName'];
            }
            foreach ($userTreatInfo as $k => $value) {
                /*处理图片*/
                $reportCardImages = explode(',', $value['reportCardImage']);
                for ($i = 1; $i <= count($reportCardImages); $i++) {
                    $userTreatInfo[$k]['treatmentImage_' . $i] = $reportCardImages[$i - 1];
                }
                unset($userTreatInfo[$k]['reportCardImage']);
                unset($userTreatInfo[$k]['doctorId']);
            }
            $code = 1;
            $message = "就诊记录获取成功";
            $data = $userTreatInfo;
        } else {
            $code = 1;
            $message = "就诊记录为空";
            $data = array();
        }
        Response::log($_POST, $code, $message, $data);
        return Response::json($code, $message, $data);
    }
}
