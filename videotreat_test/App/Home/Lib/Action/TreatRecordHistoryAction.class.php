<?php

class  TreatRecordHistoryAction extends Action
{
    public function index()
    {
        $doctorId = $_SESSION['userMsg']['doctorId'];
        $keyword = $_GET['userName'];
        $keyword=str_replace("%","\\%",$keyword);
        $keyword=str_replace("_","\\_",$keyword);
        $keyword=str_replace(" ","\\%",$keyword);
        $pageSize = 6;
        if ($keyword) {
            $totalRow = M('treat_record')->join('user_db_info as db on treat_record.userId=db.userId')->where("doctorId={$doctorId} and userName like '%{$keyword}%'")->count('treatRecordId');
            //实例化分页类
            import('ORG.Util.Page');
            $page = new Page($totalRow, $pageSize);

            $page->parameter = "userName=".urlencode($keyword);

            $treatRecordHistory = M("treat_record")
                ->field('tel,db.userId,userName,sex_key,db.birthday,treat_record.treatRecordId,treatTime')
                ->join('user_db_info as db on treat_record.userId=db.userId')
                ->where("doctorId={$doctorId} and userName like '%{$keyword}%'")
                ->limit($page->firstRow, $page->listRows)
                ->select();

        } else {
            $totalRow = M('treat_record')->join('user_db_info as db on treat_record.userId=db.userId')->where("doctorId={$doctorId}")->count('treatRecordId');
            //实例化分页类
            import('ORG.Util.Page');
            $page = new Page($totalRow, $pageSize);
            $treatRecordHistory = M("treat_record")
                ->field('tel,db.userId,userName,sex_key,db.birthday,treat_record.treatRecordId,treatTime')
                ->join('user_db_info as db on treat_record.userId=db.userId')
                ->where("doctorId={$doctorId}")
                ->limit($page->firstRow, $pageSize)
                ->select();

        }
        foreach ($treatRecordHistory as $k => $value) {
            $sex_value = M("dic_user_sex")->where("sex_key={$value['sex_key']}")->getField('sex_value');
            $treatRecordHistory[$k]['sex'] = $sex_value;
            unset($treatRecordHistory[$k]['sex_key']);
        }
        //设置分页参数

        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', "%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first% %prePage% %linkPage% %nextPage% %end%");
        //显示页码
        $show = $page->show();
        $this->assign('count', $totalRow);
        $this->assign('treatRecordHistory', $treatRecordHistory);
        $this->assign('keyword', $keyword);
        $this->assign('page', $show);

        $this->display();
    }
}