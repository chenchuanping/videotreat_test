<?php
class  TreatRecordHistoryAction extends Action{
    public function index()
    {
        $doctorId=$_SESSION['userMsg']['doctorId'];

        $treatRecordHistory=M("treat_record");
        //搜索设置
        if(I('get.keywords')){
            $where="name like '%". I('get.keywords')."%'";
        }else {
            $where = '';
        }
    //获取总共多少条数据
        $count=$treatRecordHistory->where("doctorId={$doctorId}")->where($where)->count();
        //实例化分页类
        import('ORG.Util.Page');
        $page=new Page($count,8);
        //设置分页参数
        $page->setConfig('prev','<<');
        $page->setConfig('next','>>');
        $page->setConfig('theme','  %upPage% %first% %linkPage%%downPage% %end%');


        //设置limit
        $limit=$page->firstRow.','.$page->listRows;
        //查询
        $treatRecordHistory=M("treat_record")
            ->field('db.tel,base.userId,base.userName,base.sex,base.birthday,treat_record.treatRecordId,treatTime')
            ->join('user_base_info as base on treat_record.userId=base.userId')
            ->join("user_db_info as db on treat_record.userId=db.userId")
            ->where("doctorId={$doctorId}")
            ->limit($limit)
            ->select();
        //获取总共多少条数据
        $treatRecordCount=count($treatRecordHistory);
        //显示页码
        $show=$page->show();
        $this->assign('count',$treatRecordCount);
        $this->assign('treatRecordHistory',$treatRecordHistory);
        $this->assign('num',8);
        $this->assign('keywords',I('get.keywords'));
        $this->assign('page',$show);
        //显示{$start}到{$end}
        //特殊情况的判断[首页两种情况(记录不足,空表)  尾页页一种情况(记录不足))]
        if(10 >= $treatRecordCount) {//总记录不足一页的情况
            $this->assign('start',1);
            $this->assign('end',$treatRecordCount);
        }elseif($treatRecordCount==0){
            $this->assign('start',0);
            $this->assign('end',0);
        }else{
            $this->assign('start', $page->firstRow+1);
            if($page->firstRow+1 > floor($treatRecordCount/8)*8){//通过limit(m,n)的m即$page->firstRow锁定最后一页
                $this->assign('end', $page->firstRow + $treatRecordCount-floor($treatRecordCount/8)*8);
            }else{
                $this->assign('end', $page->firstRow + $page->listRows);
            }
        }
        $this->display();
    }
}