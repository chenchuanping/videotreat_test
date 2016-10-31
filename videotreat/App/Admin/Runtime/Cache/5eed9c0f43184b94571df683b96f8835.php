<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/add_doctor.css">
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
		<?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><li><a href="__APP__/RecycleBin/index">回收站</a></li><?php endif; ?>
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
        <form action="__APP__/AddDoctor/add" method="post" enctype="multipart/form-data">
            <table id="hospital_list" border="1" >
                <tr>
                    <td class="td_left">姓名</td>
                    <td class="td_right"><input class="td_right" type="text" name="doctorName" required></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input class="td_right" type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>手机号</td>
                    <td><input   class="td_right" type="text" name="tel" required ></td>
                </tr>
                <tr>
                    <td>性别</td>
                    <td>
                        <select name="sex" required  class="doctor_select">
                            <option value="0">男</option>
                            <option value="1">女</option>
                            <option value="2">其他</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>年龄</td>
                    <td>
                        <input   class="td_right" type="text" name="age" required >
                    </td>
                </tr>
                <tr>
                    <td>职称</td>
                    <td>
                        <select name="profess" required  class="doctor_select">
                            <?php if(is_array($professInfo)): foreach($professInfo as $key=>$v): ?><option value="<?php echo ($v["professId"]); ?>"><?php echo ($v["professName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>科室</td>
                    <td>
                        <select name="department" required  class="doctor_select">
                            <?php if(is_array($departmentInfo)): foreach($departmentInfo as $key=>$v): ?><option value="<?php echo ($v["departmentId"]); ?>"><?php echo ($v["departmentName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>医生头像</td>
                    <td>
                        <input  type="file" name="headPic" >
                    </td>
                </tr>
                <tr>
                    <td>标签</td>
                    <td class="labelList">
                        <?php if(is_array($labelInfo)): foreach($labelInfo as $key=>$v): ?><input  type="checkbox" name="labelArray[]" value="<?php echo ($v["labelId"]); ?>" ><?php echo ($v["labelName"]); endforeach; endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>特长</td>
                    <td>
                        <textarea name="special" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>简介</td>
                    <td>
                        <textarea name="profile" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>所属医院</td>
                    <td>
                        <select name="hospitalId"  class="doctor_select" >
                            <?php if(is_array($hospitalInfo)): foreach($hospitalInfo as $key=>$v): ?><option value="<?php echo ($v["hospitalId"]); ?>" ><?php echo ($v["hospitalName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="button orange bigrounded" type="submit"  value="添加" />
                        <input class="button orange bigrounded" type="reset"  value="重置"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div id="footer">底</div>

<script src="__ROOT__/Public/js/jquery.js"></script>
<script src="__ROOT__/Public/js/jquery.validate.js"></script>
<script>
    $(function(){
        $('#frm').validate();
    });
</script>
</body>
</html>