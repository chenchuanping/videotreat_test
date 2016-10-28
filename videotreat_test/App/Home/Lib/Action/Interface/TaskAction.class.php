<?php

/*                              任务界面接口
 * @param type                    string       判断任务类型   daily 每日任务  newbie 新手任务
 * @param userId                  int         用户id
 * @param client                  int         手机型号区别，1为ios 0为android
 * return code                    int         状态码
 *        message                 string      提示信息
 *        data                    array       返回的数据
 *            userData                  array           用户相关数据
 *                  headPic                     string           用户头像链接
 *                  userLevel                   int             用户等级
 *                  userTotalMark               int             用户总经验值
 *             task                     array           任务相关数据
 *                  taskId                      int             任务序列号从0开始
 *                  taskMark                    string             每个任务对应的经验值
 *                  taskState                   int             任务完成状态      1 完成   0 未完成
 */

class TaskAction extends Action
{
    public function index()
    {
        include_once 'common/Response.class.php';
        /*接受客户端POST过来的数据*/
        $type = $_POST['type'];
        $userId = $_POST['userId'];
        $client = $_POST['client'];/*0为安卓，1为iOS*/
        /*用户签到*/
        /*得到今天的日期*/
        $today = date('j');
        $userSignInfo = M("user_sign_in")->field('signIn')->where("userId={$userId} and signInDate={$today}")->find();
        $userSignInfo['signIn'] += 0;
        /*用户头像*/
        $headPic = M("user_base_info")->field('headPic')->where("userId={$userId}")->find();
        /*用户相关数据*/
        $userData = M('user_grade')->field('userLevel,userTotalMark')->where("userId={$userId}")->find();
        /*等级和总分的关系*/
        /*用户初始    等级为0，积分也为0*/
        if (!$userData) {
            $data_start['userLevel'] = 0;
            $data_start['userTotalMark'] = 0;
            $data_start['userId'] = $userId;
            M("user_grade")->data($data_start)->add();
        }
        switch ($userData['userLevel']) {
            case 0:
                $userMark = ($userData['userTotalMark']) . "/500";
                break;
            case 1:
                $userMark = ($userData['userTotalMark']) . "/1000";
                break;
            case 2:
                $userMark = ($userData['userTotalMark']) . "/2000";
                break;
            case 3:
                $userMark = ($userData['userTotalMark']) . "/4000";
                break;
            case 4:
                $userMark = ($userData['userTotalMark']) . "/8000";
                break;
            case 5:
                $userMark = ($userData['userTotalMark']) . "/16000";
                break;
            case 6:
                $userMark = ($userData['userTotalMark']) . "/32000";
                break;
            case 7:
                $userMark = ($userData['userTotalMark']) . "/64000";
                break;
            default:
                $userMark = 0;
                break;
        }
        $userData['userTotalMark'] = $userMark;
        $userData['headPic'] = $headPic['headPic'];
        $task = M("user_task")
            ->field('user_task.taskId,taskState,t.taskMark,t.taskContent')
            ->join("task_info as t on t.taskId=user_task.taskId")
            ->where("taskType='{$type}' and user_task.userId={$userId}")
            ->select();
        foreach ($task as $k => $v) {
            $v['taskMark'] = "+" . $v['taskMark'] . "经验值";
            $taskInfo[$k] = $v;
        }
        $data['singIn'] = $userSignInfo['signIn'];
        $data['userData'] = $userData;
        $data['task'] = $taskInfo;

        if ($data && $userId) {
            return Response::json(1, '任务详情获取成功', $data);
        } else {
            return Response::json(0, '任务详情获取失败');
        }
    }
}
