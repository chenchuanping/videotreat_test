<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/modify_hospital.css">
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
        <form action="__APP__/ModifyHospital/modify/hospitalId/<?php echo ($hospitalId); ?>" method="post" enctype="multipart/form-data">
            <table id="hospital_list" border="1" >
                <tr>
                    <td class="td_left">医院名称</td>
                    <td colspan="2"><input class="td_right" type="text" name="hospitalName" value="<?php echo ($hospitalInfo["hospitalName"]); ?>"></td>
                </tr>
                <tr>
                    <td>医院Logo</td>
                    <td colspan="2">
                        <img src="<?php echo ($hospitalInfo["hospitalLogo"]); ?>" alt="医院Logo">
                        <input  type="file" name="hospitalLogo" >
                    </td>
                </tr>
                <tr>
                    <td>医院图片</td>
                    <td colspan="2">
                        <img src="<?php echo ($hospitalInfo["hospitalImage"]); ?>" alt="医院图片">
                        <input  type="file" name="hospitalImage">
                    </td>
                </tr>
                <tr>
                    <td>医师数量</td>
                    <td colspan="2"><input class="td_right" type="text" name="doctorNumber" value="<?php echo ($hospitalInfo["doctorNumber"]); ?>"></td>
                </tr>
                <tr>
                    <td>医院地址</td>
                    <td colspan="2"><input class="td_right"  type="text" name="hospitalAddress" value="<?php echo ($hospitalInfo["hospitalAddress"]); ?>"></td>
                </tr>
                <tr>
                    <td>标签</td>
                    <td><input class="td_right" style="width: 300px" type="text" value="<?php echo ($hospitalInfo["labelArray"]); ?>" disabled="disabled"></td>
                    <td class="labelList">
                        <?php if(is_array($labelInfo)): foreach($labelInfo as $key=>$v): ?><input  type="checkbox" name="labelArray[]" value="<?php echo ($v["labelId"]); ?>"><?php echo ($v["labelName"]); endforeach; endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>简介</td>
                    <td colspan="2">
                        <textarea name="hospitalIntroduction"><?php echo ($hospitalInfo["hospitalIntroduction"]); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input class="button orange bigrounded" type="submit"  value="修改" />
                        <input class="button orange bigrounded" type="reset"  value="重置"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div id="footer">底</div>
<script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>