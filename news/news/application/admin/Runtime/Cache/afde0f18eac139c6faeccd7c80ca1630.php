<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>后台管理系统</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
     <link href="__ROOT__/public/css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="__ROOT__/library/jquery/jquery-2.2.3.js"></script>
    <script type="text/javascript" src="__ROOT__/library/kindeditor/kindeditor.js"></script>
    <script type="text/javascript">
      function checkAdd(){
    	  $("#userTd").html("");
    	  $("#pwdTd").html("");
    	  $("#checkPwdTd").html("");
    	  $("#userTypeTd").html("");
          if(document.frm.username.value == "") {
              $("#userTd").html("请输入用户名！");
              document.frm.username.focus();
              return false;
          } else if(document.frm.password.value == "") {
              $("#pwdTd").html("请输入密码！");
              document.frm.password.focus();
              return false;
          } else if(document.frm.checkPwd.value != document.frm.password.value) {
              $("#checkPwdTd").html("两次输入的密码不一致！");
              document.frm.checkPwd.focus();
              return false;
          } else if(document.frm.userType.value == "") {
              $("#userTypeTd").html("请输入用户类型！");
              document.frm.userType.focus();
              return false;
          }
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
    <div class="locationDiv">&nbsp;: 后台管理 : 添加管理员</div>
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
        <div class="addTypeDiv1">添加管理员</div>
        <br>
        <form name="frm" method="post" action="__APP__/Adduser/adduser" onclick="return checkAdd()">
        <table border="0" align="center" width="470" bgcolor="#6599FF">
          <tr>
            <td align="left" width="100">用户名</td>
            <td width="170"><input type="text" name="username" size="20"></td>
            <td id="userTd" style="color:red;" width="170" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left">密码</td>
            <td><input type="password" name="password" size="20"></td>
            <td id="pwdTd" style="color:red;" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left">确认密码</td>
            <td><input type="password" name="checkPwd" size="20"></td>
            <td id="checkPwdTd" style="color:red;" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left">用户类型</td>
            <td><input type="text" name="userType" size="20"></td>
            <td id="userTypeTd" style="color:red;" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left">用户详情</td>
            <td><input type="text" name="remark" size="20"></td>
            <td align="left">&nbsp;</td>
          </tr>
           <tr>
            <td align="left">添加新闻数</td>
            <td><input type="text" name="addnum" size="20"></td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="center">
              <input type="submit" value="添加" class="btn1">
              &nbsp;&nbsp;&nbsp;
              <input type="reset" value="取消" class="btn1">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </form>
      </div>
    </div>
  </body>
</html>