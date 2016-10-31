<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/manager_info.css">

    <!--js-->
    <script>
        function  modifyManager(managerId,hospitalId){
            window.location = "__APP__/ModifyManager/index/managerId/"+managerId+"/hospitalId/"+hospitalId;
        }
        function  deleteManager(managerId,hospitalId){
            if(confirm("是否删除该医院？")){
                window.location = "__APP__/ModifyManager/delete/managerId/"+managerId+"/hospitalId/"+hospitalId;
            }
        }
        function addManager(){
            window.location="__APP__/AddManager/index";
        }
    </script>
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
        <form name="frm" method="post" action="__APP__/ManagerInfo/index" >
            <input  type="hidden" name="currentPage" value="1">
            <table  style="height: 50px;font-size: 18px">
                <tr>
                    <td align="left">
                        &nbsp;管理员搜索：
                        <input id="searchHospital"  type="text" name="keyword" size="50" value='<?php echo ($keyword); ?>'/>
                        <input class="button orange bigrounded" type="submit" value="搜索">
                    </td>
                    <td id="addManager" class="button orange bigrounded" onclick="addManager()">添加</td>
                    </if>
                    </td>
                </tr>
            </table>
        </form>
        <br>
        <table id="manager_list" border="1" >
            <tr>
                <th>编号</th>
                <th>姓名</th>
                <th>角色</th>
                <th class="manager_hospital">管理的医院</th>
                <th>操作</th>
            </tr>
            <?php if($managerInfo != null): if(is_array($managerInfo)): foreach($managerInfo as $k=>$v): ?><tr>
                        <td><?php echo ($k+1); ?></td>
                        <td><?php echo ($v["managerName"]); ?></td>
                        <td><?php echo ($v["roleName"]); ?></td>
                        <td><?php echo ($v["hospitalName"]); ?></td>
                        <td>
                            <?php if($v["hospitalId"] != all): ?><input class="button orange bigrounded"  type="button" onclick="modifyManager('<?php echo ($v["managerId"]); ?>','<?php echo ($v["hospitalId"]); ?>')" value="修改"/><?php endif; ?>
                            <input class="button orange bigrounded"  type="button" onclick="deleteManager('<?php echo ($v["managerId"]); ?>','<?php echo ($v["hospitalId"]); ?>')" value="停用"/>
                        </td>
                    </tr><?php endforeach; endif; ?>
                <tr>
                    <td colspan="5" id="pageSize" >
                        <?php $__FOR_START_31620__=1;$__FOR_END_31620__=$totalPage+1;for($i=$__FOR_START_31620__;$i < $__FOR_END_31620__;$i+=1){ if($currentPage == $i): ?>[<?php echo ($i); ?>]&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                    </td>
                </tr>
                <?php else: ?>
                <tr>
                    <td colspan="5">暂无信息</td>
                </tr><?php endif; ?>
        </table>
    </div>
</div>
<div id="footer">底</div>
<script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>