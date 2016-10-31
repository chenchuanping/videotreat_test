<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/treat_history.css">
</head>
<body>

<div id="header">
    <span>云医视讯管理系统</span>
    <ul>
        <li><a href="__APP__/ModifyMyself/index">修改登录信息</a></li>
        <li><a href="#" onclick="logout()">退出登录</a></li>
        <li><a href="#" onclick="gotoIndex()">返回首页</a></li>
    </ul>
</div>

<div id="content">
    <div id="content_left" class="left">
	<ul>
		<li>
			<span>权限管理</span>
			<ul id="authority">
				<li id="authority_manager">角色管理</li>
				<li id="post_manager">岗位管理</li>
			</ul>
		</li>
		<li><a href="__APP__/HospitalInfo/index">医院信息管理</a></li>
		<li><a href="__APP__/DoctorInfo/index">医生信息管理</a></li>
		<?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><li><a href="__APP__/ManagerInfo/index">管理员管理</a></li><?php endif; ?>
		<li><a href="__APP__/TreatHistory/index">就诊历史查询</a></li>
		<?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><li><a href="__APP__/RecycleBin/index">回收站</a></li>
			<li><a href="__APP__/AdminLog/index">日志管理</a></li>
			<li><a href="__APP__/PublishVersion/index">发布新版本</a></li>
			<li><a href="__APP__/UserSuggestion/index">用户意见</a></li><?php endif; ?>
	</ul>
</div>
<script src="__ROOT__/Public/js/jquery.js"></script>
<script>
	function logout(){
		if(confirm("是否退出登录？")){
			window.location = "__APP__/Login/logout";
		}
	}
	function gotoIndex(){
		window.location = "__APP__/Index/index";
	}
	//点击了页码的超链接
	function setPage(currentPage)
	{
		document.frm.currentPage.value = currentPage;//设置页码
		document.frm.submit();//提交表单
	}
</script>

    <div id="content_right" class="right">
        <form name="frm" method="post" action="__APP__/TreatHistory/index" >
            <input  type="hidden" name="currentPage" value="1">
            <table  style="height: 50px;font-size: 18px">
                <tr>
                    <td align="left">
                        &nbsp;患者搜索：
                        <input id="searchHospital"  type="text" name="keyword" size="50" value='<?php echo ($keyword); ?>'/>
                        <input class="button orange bigrounded" type="submit" value="搜索">
                    </td>
                    </if>
                    </td>
                </tr>
            </table>
        </form>
        <br>
        <table id="treat_history_list" border="1" >
            <tr>
                <th>患者姓名</th>
                <th>医师姓名</th>
                <th>医院名称</th>
                <th>科室</th>
                <th>主诉</th>
                <th>现病史</th>
                <th>既往史</th>
                <th>医生建议</th>
                <th>自述卡内容</th>
                <th>自述卡描述</th>
                <th>自述材料1</th>
                <th>自述材料2</th>
                <th>自述材料3</th>
                <th>自述材料4</th>
                <th>自述材料5</th>
                <th>自述材料6</th>
                <th>自述材料7</th>
                <th>自述材料8</th>
                <th>自述材料9</th>
            </tr>
            <?php if($userTreatInfo != null): if(is_array($userTreatInfo)): foreach($userTreatInfo as $key=>$v): ?><tr>
                        <td>
                            <input type="text" value="<?php echo ($v["userName"]); ?>"></td>
                        <td>
                            <input type="text" value="<?php echo ($v["doctorName"]); ?>">
                        </td>
                        <td>
                            <input type="text" value="<?php echo ($v["hospitalName"]); ?>">
                        </td>
                        <td>
                            <input type="text" value="<?php echo ($v["departmentName"]); ?>">
                        </td>
                        <td>
                            <textarea><?php echo ($v["userComplaint"]); ?></textarea>
                        </td>
                        <td>
                            <textarea><?php echo ($v["userHPC"]); ?></textarea>
                        </td>
                        <td>
                            <textarea><?php echo ($v["userPMH"]); ?></textarea>
                        </td>
                        <td>
                            <textarea><?php echo ($v["doctorSuggest"]); ?></textarea>
                        </td>
                        <td>
                            <textarea><?php echo ($v["reportCardDescribe"]); ?></textarea>
                        </td>
                        <td>
                            <textarea><?php echo ($v["reportCardRemark"]); ?></textarea>
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_1"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_2"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_3"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_4"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_5"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_6"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_7"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_8"]); ?>" alt="无">
                        </td>
                        <td>
                            <img src="<?php echo ($v["image_9"]); ?>" alt="无">
                        </td>
                    </tr><?php endforeach; endif; ?>
                <tr>
                    <td colspan="19" id="pageSize" >
                        <?php $__FOR_START_32621__=1;$__FOR_END_32621__=$totalPage+1;for($i=$__FOR_START_32621__;$i < $__FOR_END_32621__;$i+=1){ if($currentPage == $i): ?>[<?php echo ($i); ?>]&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                    </td>
                </tr>
                <?php else: ?>
                <tr>
                    <td colspan="19">暂无信息</td>
                </tr><?php endif; ?>
        </table>
    </div>
</div>
<div id="footer">底</div>
<script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>