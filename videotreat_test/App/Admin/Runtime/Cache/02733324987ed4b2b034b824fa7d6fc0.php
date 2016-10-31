<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/index.css">
    <script src="__ROOT__/Public/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/admin.js"></script>
</head>
<body>

<div id="header">
    <span>云医视讯管理系统</span>
    <ul>
        <li class="usename">欢迎您，<?php echo ($_SESSION['userMsg']['managerName']); ?></li>
        <li><a href="__APP__/ModifyMyself/index"  target="frame">修改登录信息</a></li>
        <li><a href="#" onclick="logout()">退出登录</a></li>
        <!--<li><a href="#" onclick="gotoIndex()">返回首页</a></li>-->
    </ul>
</div>

    
<script src="__ROOT__/Public/js/easyui/easyui.js"></script>
<div id="content_left" class="left">
			<div title="权限管理" class="firstlist">
			<ul id="authority">
				<li id="authority_manager"><a href="#">角色管理</a></li>
				<li id="post_manager"><a href="#">岗位管理</a></li>
			</ul>
			</div>
		<div title="医院信息管理" class="firstlist"><a href="__APP__/HospitalInfo/index" target="frame">医院信息管理</a></div>
		<div title="医生信息管理" class="firstlist"><a href="__APP__/DoctorInfo/index" target="frame">医生信息管理</a></div>
		<?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><div title="管理员管理" class="firstlist"><a href="__APP__/ManagerInfo/index" target="frame">管理员管理</a></div><?php endif; ?>
		<div title="就诊历史查询" class="firstlist"><a href="__APP__/TreatHistory/index" target="frame">就诊历史查询</a></div>
		<?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><div title="回收站" class="firstlist"><a href="__APP__/RecycleBin/index" target="frame">回收站</a></div>
			<div title="日志管理" class="firstlist"><a href="__APP__/AdminLog/index" target="frame">日志管理</a></div>
			<div title="发布新版本" class="firstlist"><a href="__APP__/PublishVersion/index" target="frame">发布新版本</a></div>
			<div title="用户意见" class="firstlist"><a href="__APP__/UserSuggestion/index" target="frame">用户意见</a></div><?php endif; ?>
</div>
<script>
	//点击了页码的超链接
	function setPage(currentPage)
	{
		document.frm.currentPage.value = currentPage;//设置页码
		document.frm.submit();//提交表单
	}
	$(function(){
		//左侧菜单
		$('#content_left').accordion({
			selected: false
		});

		$('.panel-header').css('height','30px');
		$('#content_left').accordion('collapsible',0);
	})
	function logout(){
		if(confirm("是否退出登录？")){
			window.location = "__APP__/Login/logout";
		}
	}
	function gotoIndex(){
		window.location = "__APP__/Index/index";
	}

</script>

    <div id="content_right" class="right">
        <iframe src="" frameborder="0" name="frame" style="width:100%; height:680px;overflow-x: hidden"></iframe>
    </div>

</body>
</html>