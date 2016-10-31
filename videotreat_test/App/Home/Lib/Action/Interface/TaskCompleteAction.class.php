<?php

/*                          用户任务完成接口
 * @param userId                  int         用户id
 * @param taskId                  int         任务id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据  空
 */

class TaskCompleteAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $userId = $_POST['userId'];
        $taskId = $_POST['taskId'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/

        if ($userId && $taskId) {
            /*默认任务成功，存入数据库*/
            $data['taskState'] = 1;
            $result = M("user_task")->where("userId={$userId} and taskId={$taskId}")->save($data);
            /*用户等级 加相应的经验值*/
            $taskMark = M('task_info')->where("taskId={$taskId}")->getField('taskMark');
            /*查询用户的总经验值*/
            $userTotalMark = M("user_grade")->where("userId={$userId}")->getField("userTotalMark");
            $userTotalMark = $userTotalMark + $taskMark;
            /*对等级和总经验值进行匹配*/
            switch ($userTotalMark) {
                case $userTotalMark >= 64000:
                    $user_task['userLevel'] = 8;
                    break;
                case $userTotalMark >= 32000:
                    $user_task['userLevel'] = 7;
                    break;
                case $userTotalMark >= 16000:
                    $user_task['userLevel'] = 6;
                    break;
                case $userTotalMark >= 8000:
                    $user_task['userLevel'] = 5;
                    break;
                case $userTotalMark >= 4000:
                    $user_task['userLevel'] = 4;
                    break;
                case $userTotalMark >= 2000:
                    $user_task['userLevel'] = 3;
                    break;
                case $userTotalMark >= 1000:
                    $user_task['userLevel'] = 2;
                    break;
                case $userTotalMark >= 500:
                    $user_task['userLevel'] = 1;
                    break;
            }
            $user_task['userTotalMark'] = $userTotalMark;
            /*添加到user_grade的表中，而且对等级进行处理*/
            M("user_grade")->where("userId={$userId}")->save($user_task);
            if ($result) {
                $code = 1;
                $message = '任务完成';
                Response::log($_POST, $code, $message);
                return Response::json($code, $message);
            } else {
                $code = 0;
                $message = '任务未完成';
                Response::log($_POST, $code, $message);
                return Response::json($code, $message);
            }
        }
    }
}
