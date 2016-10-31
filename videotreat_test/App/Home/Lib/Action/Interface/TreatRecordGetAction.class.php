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

class TreatRecordGetAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];   //用户id
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        $treatRecordId = $_POST['treatRecordId'];//病历卡Id
        $userTreatInfo = M("treat_record")
            ->field('treatRecordId,treat_record.doctorId,db.userName,doctor.doctorName,userComplaint,userHPC,userPMH,doctorSuggest,treatTime,reportCardRemark,reportCardDescribe,reportCardImage')
            ->join('user_db_info as db on treat_record.userId=db.userId')
            ->join("doctor_info as doctor on treat_record.doctorId=doctor.doctorId")
            ->where("treat_record.userId={$userId} and treatRecordId={$treatRecordId}")
            ->find();
        if ($userTreatInfo) {
            $otherInfo = M("doctor_info")
                ->field('departmentName,hospitalName')
                ->join("department_info as d on d.departmentId=doctor_info.departmentId")
                ->join("hospital_info as h on doctor_info.hospitalId=h.hospitalId")
                ->where("doctorId={$userTreatInfo['doctorId']}")
                ->find();
            $userTreatInfo['departmentName'] = $otherInfo['departmentName'];
            $userTreatInfo['hospitalName'] = $otherInfo['hospitalName'];
            /*处理图片*/
            $reportCardImages = explode(',', $userTreatInfo['reportCardImage']);
            $len = count($reportCardImages);
            for ($i = 1; $i <= $len; $i++) {
                $userTreatInfo['treatmentImage_' . $i] = $reportCardImages[$i - 1];
            }
            unset($userTreatInfo['reportCardImage']);
            unset($userTreatInfo['doctorId']);
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
