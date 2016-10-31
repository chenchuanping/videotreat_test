<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/hospital_info.css">
    <!--js-->
    <script>
        function  modifyHospital(id){
            window.location = "__APP__/ModifyHospital/index/hospitalId/"+id;
        }
        function  deleteHospital(id){
            if(confirm("是否删除该医院？")){
                window.location = "__APP__/ModifyHospital/delete/hospitalId/"+id;
            }
        }
        function addHospital(){
            window.location = "__APP__/AddHospital/index";
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
        <form name="frm" method="post" action="__APP__/HospitalInfo/index" >
            <input  type="hidden" name="currentPage" value="1">
            <table  style="height: 50px;font-size: 18px">
                <tr>
                    <td align="left">
                        &nbsp;医院搜索：
                        <input id="searchHospital"  type="text" name="keyword" size="50" value='<?php echo ($keyword); ?>'/>
                        <input class="button orange bigrounded" type="submit" value="搜索">
                    </td>
                    <?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><td id="addHospital" onclick="addHospital()">
                            <input class="button orange bigrounded" type="button" value="添加">
                        </td><?php endif; ?>
                </tr>
            </table>
        </form>
        <br>
        <table id="hospital_list" border="1" >
            <tr>
                <th>编号</th>
                <th class="hospitalName">医院名称</th>
                <th>医院Logo</th>
                <th>医院图片</th>
                <th>医师数量</th>
                <th class="labelArrayText">标签</th>
                <th class="hospitalAddress">医院地址</th>
                <th class="introductionText">简介</th>
                <th>操作</th>
            </tr>
            <?php if($hospitalInfo != null): if(is_array($hospitalInfo)): foreach($hospitalInfo as $key=>$v): ?><tr>
                        <td><?php echo ($v["hospitalId"]); ?></td>
                        <td class="hospitalName"><?php echo ($v["hospitalName"]); ?></td>
                        <td>
                            <img class="hospital_image" src="<?php echo ($v["hospitalLogo"]); ?>" alt="暂无图片"/>
                        </td>
                        <td>
                            <img class="hospital_image" src="<?php echo ($v["hospitalImage"]); ?>" alt="暂无图片"/>
                        </td>
                        <td><?php echo ($v["doctorNumber"]); ?></td>
                        <td class="labelArray"><?php echo ($v["labelArray"]); ?></td>
                        <td class="hospitalAddress"><?php echo ($v["hospitalAddress"]); ?></td>
                        <td class="introduction"><?php echo ($v["hospitalIntroduction"]); ?></td>
                        <td>
                            <input class="button orange bigrounded" type="button" onclick="modifyHospital('<?php echo ($v["hospitalId"]); ?>')" value="修改" />
                            <input class="button orange bigrounded"  type="button" onclick="deleteHospital('<?php echo ($v["hospitalId"]); ?>')" value="停用"/>
                        </td>
                    </tr><?php endforeach; endif; ?>
                <tr>
                    <td colspan="9" id="pageSize" >
                        <?php $__FOR_START_8214__=1;$__FOR_END_8214__=$totalPage+1;for($i=$__FOR_START_8214__;$i < $__FOR_END_8214__;$i+=1){ if($currentPage == $i): ?>[<?php echo ($i); ?>]&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                   <td colspan="9">暂无信息</td>
                </tr><?php endif; ?>
        </table>
    </div>
</div>
<div id="footer">底</div>
<script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>