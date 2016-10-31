<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>后台管理系统</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="__ROOT__/public/css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="__ROOT__/library/jquery/jquery-2.2.3.js"></script>
    <script type="text/javascript">
	    //删除用户
	    function delUser(id){
	        if(confirm("是否删除用户？")){
	            window.location = "__APP__/Moduser/delete/id/"+id;
	        }
	    }
	    var oldId;
	    var oldUserName;
	    var oldPassword;
	    var oldUserType;
	    var oldRemark;
	    var oldAddnum;
	    var oldLink;
	    //让某一行显示为文本框
	    function showText(id) {
	        hideText(); 
	        oldId=id;//1
	        oldUserName = $("#td"+id+"1").html();//admin
	        oldPassword = $("#td"+id+"2").html();//123
	        oldUserType = $("#td"+id+"3").html();//系统管理员
	        oldRemark = $("#td"+id+"4").html();//用户详情
	        oldAddnum = $("#td"+id+"5").html();//添加新闻数
	        oldLink = $("#td"+id+"6").html();//操作
	        $("#td"+id+"0").css("backgroundColor","gray");
	        $("#td"+id+"1").html("<input type='text' name='userName' size='10' value='"+oldUserName+"'>");
	        $("#td"+id+"2").html("<input type='text' name='password' size='10' value='"+oldPassword+"'>");
	        $("#td"+id+"3").html("<input type='text' name='userType' size='10' value='"+oldUserType+"'>");
	        $("#td"+id+"4").html("<input type='text' name='remark' size='10' value='"+oldRemark+"'>");
	        $("#td"+id+"5").html("<input type='text' name='addnum' size='10' value='"+oldAddnum+"'>");
	        $("#td"+id+"6").html("<a href='#' onclick='submitForm()'>更新</a>  <a href='#' onclick='hideText()'>取消</a>");
	    }
	    //点击了取消按扭
	    function hideText(){
	  	  $("#td"+oldId+"0").css("backgroundColor","white");
	  	  $("#td"+oldId+"1").html(oldUserName);
	  	  $("#td"+oldId+"2").html(oldPassword);
	  	  $("#td"+oldId+"3").html(oldUserType);
	  	  $("#td"+oldId+"4").html(oldRemark);
	  	  $("#td"+oldId+"5").html(oldAddnum);
	  	  $("#td"+oldId+"6").html(oldLink);
	    }
	    //点击了更新按扭
	    function submitForm(){
	        //设置表单的提交地址
	        document.frm.action = "__APP__/Moduser/moduser/id/"+oldId;
	        //让表单提交
	        document.frm.submit();
	    }
    </script>
  </head>
  <body>
    <!-- 网站的头 -->
    <script type="text/javascript">
	$(function(){
		$("#menuDiv1,#menuDiv2,#menuDiv3,#menuDiv4,#menuDiv5").hover(
			function(){
				$(this).css("backgroundColor","#D4D0C8");
				$(this).find("div").show();
			},
			function(){
				$(this).css("backgroundColor","#E4E9EC");
				$(this).find("div").hide();
			});
	});
	 //退出后台
	  function logout()
	  {
		  if(confirm("是否退出后台管理系统?"))
		  {
			  window.location = "__APP__/Admin/logout";
		  }
	  }
</script>
<div class="headDiv">
<div class="headDiv1">www.ttnewS.com</div>
<div class="headDiv2"><img src="__ROOT__/public/images/image6.gif"></div>
</div>
<div class="headDiv3">&nbsp;</div>
<!-- 导航菜单 -->
<div class="menuDiv">
	<div id="menuDiv1"><a href="__ROOT__/default.php" onclick="logout()">重新登陆</a></div>
	 <?php if($userInfo["userType"] == 12): ?><div id="menuDiv2"><a href="#">新闻管理</a><br>
		<div>
			<a href="__APP__/Addnews/index">添加新闻</a><br>
			<a href="__APP__/Modnews/index">修改新闻</a>
		</div>
	</div>
	<div id="menuDiv3"><a href="#">分类管理</a><br>
		<div>
		<a href="__APP__/Addtype/index">添加分类</a><br>
		<a href="__APP__/Modtype/index">修改分类</a>
		</div>
	</div>
	<div id="menuDiv4"><a href="#">用户管理</a><br>
		<div>
		<a href="__APP__/Adduser/index">添加管理员</a><br/>
		<a href="__APP__/Moduser/index">修改管理员</a>
		</div>
	</div><?php endif; ?>
	 <?php if($userInfo["userType"] == 8): ?><div id="menuDiv2"><a href="#">新闻管理</a><br>
		<div>
			<a href="__APP__/Addnews/index">添加新闻</a><br>
			<a href="__APP__/Modnews/index">修改新闻</a>
		</div>
	</div>
	<div id="menuDiv3"><a href="#">分类管理</a><br>
		<div>
		添加分类<br>
		修改分类
		</div>
	</div>
	<div id="menuDiv4"><a href="#">用户管理</a><br>
		<div>
		添加管理员<br/>
		修改管理员
		</div>
	</div><?php endif; ?>
	 <?php if($userInfo["userType"] == 1): ?><div id="menuDiv2"><a href="#">新闻管理</a><br>
		<div>
			<a href="__APP__/Addnews/index">添加新闻</a><br>
			<a href="#">修改新闻</a>
		</div>
	</div>
	<div id="menuDiv3"><a href="#">分类管理</a><br>
		<div>
		添加分类<br>
		修改分类
		</div>
	</div>
	<div id="menuDiv4"><a href="#">用户管理</a><br>
		<div>
		添加管理员<br/>
		修改管理员
		</div>
	</div><?php endif; ?>
<div id="menuDiv5"><a href="__APP__/Admin/index">返回首页</a></div>
</div>

 
    <!-- 当前位置 -->
    <div class="locationDiv">&nbsp;: 后台管理 : 修改管理员</div>  
    <!-- 正文内容 -->
    <div class="mainDiv clear">
      <!-- 左侧树状列表 -->
      <div class="leftDiv"> <script type="text/javascript" src="__ROOT__/public/js/dtree.js"></script>
<script type="text/javascript">

	function hello(){
		
	  d = new dTree('d','__ROOT__/public/');
	//添加一个新的菜单
	  d.add(0,-1,'后台管理','');//最顶级菜单，没有父菜单，为-1
	
	  d.add(1,0,'重新登陆','javascript:logout()');
	  <?php if($userInfo["userType"] == 12): ?>d.add(2,0,'新闻管理','');
		  d.add(21,2,'添加新闻','__APP__/Addnews/index');
		  d.add(22,2,'修改新闻','__APP__/Modnews/index');
	
	  d.add(3,0,'分类管理','');
		  d.add(31,3,'添加分类','__APP__/Addtype/index');
		  d.add(32,3,'修改分类','__APP__/Modtype/index');
	  d.add(4,0,'用户管理','');
	 	  d.add(41,4,'添加管理员','__APP__/Adduser/index');
		  d.add(42,4,'修改管理员','__APP__/Moduser/index');<?php endif; ?>
	 <?php if($userInfo["userType"] == 8): ?>d.add(2,0,'新闻管理','');
		  d.add(21,2,'添加新闻','__APP__/Addnews/index');
		  d.add(22,2,'修改新闻','__APP__/Modnews/index');
	
	  d.add(3,0,'分类管理','');
		  d.add(31,3,'添加分类');
		  d.add(32,3,'修改分类');
	  d.add(4,0,'用户管理','');
	 	  d.add(41,4,'添加管理员');
		  d.add(42,4,'修改管理员');<?php endif; ?>
	 <?php if($userInfo["userType"] == 1): ?>d.add(2,0,'新闻管理','');
		  d.add(21,2,'添加新闻','__APP__/Addnews/index');
		  d.add(22,2,'修改新闻');
	
	  d.add(3,0,'分类管理','');
		  d.add(31,3,'添加分类');
		  d.add(32,3,'修改分类');
	  d.add(4,0,'用户管理');
	 	  d.add(41,4,'添加管理员');
		  d.add(42,4,'修改管理员');<?php endif; ?>
		d.add(5,0,'返回首页','__APP__/Admin/index');
		  document.write(d);
		}
	hello();
</script></div> 
      <!-- 右侧页面内容 -->
      <div class="rightDiv">
            <div class="addTypeDiv1">修改管理员</div>
             <br>
        <form name="frm" method="post" action="__APP__/Moduser/moduser">
        	<table border="1" style="align:center;width:720px;cellpadding:0;cellspacing:0">
	          <tr class="modTypeDiv1">
	            <td width="120px">用户名</td>
	            <td width="120px">密码</td>
	            <td width="120px">用户类型</td>
	            <td width="120px">用户详情</td>
	            <td width="120px">添加新闻数</td>
	            <td width="120px">操作</td>
	          </tr>
	<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr id="td<?php echo ($v["id"]); ?>0" class="modTypeDiv2" style="background-color:#FFFFFF;">
	      <td id="td<?php echo ($v["id"]); ?>1" width="120"><?php echo ($v["userName"]); ?></td>
	      <td id="td<?php echo ($v["id"]); ?>2" width="120"><?php echo ($v["password"]); ?></td>
	      <td id="td<?php echo ($v["id"]); ?>3" width="120"><?php echo ($v["userType"]); ?></td>
	      <td id="td<?php echo ($v["id"]); ?>4" width="120"><?php echo ($v["remark"]); ?></td>
	      <td id="td<?php echo ($v["id"]); ?>5" width="120"><?php echo ($v["addnum"]); ?></td>
	      <td id="td<?php echo ($v["id"]); ?>6" width="130">
	            <a href="#" onclick="showText(<?php echo ($v["id"]); ?>)">编辑</a>
	             &nbsp;&nbsp;&nbsp;
	           <a href="#" onclick="delUser(<?php echo ($v["id"]); ?>)">删除</a>
	      </td>
	    </tr><?php endforeach; endif; ?>
       	 </table>
        </form>
      </div>
    </div>
  </body>
</html>