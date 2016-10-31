<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>后台管理系统</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="__ROOT__/public/css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="__ROOT__/library/jquery/jquery-2.2.3.js"></script>
    <script type="text/javascript" src="__ROOT__/library/kindeditor/kindeditor.js"></script>
    <script type="text/javascript">
      var editor;
      KindEditor.ready(function(e){
          editor = e.create("[name=content]",{
              width:"700px",
              height:"260px"
          });
      });
      //表单验证
      function checkAdd(){
    	  if(document.frm.title.value == ""){
              alert("请输入新闻标题！");
              document.frm.title.focus();
              return false;
          }else if(editor.html() == ""){
              alert("请输入新闻内容！");
              editor.focus();
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
    <div class="locationDiv">&nbsp;: 后台管理 : 添加新闻</div>
    
    <!-- 正文内容 -->
    <div class="mainDiv clear">
    
      <!-- 左侧树状列表 -->
      <div class="leftDiv">
      <script type="text/javascript" src="__ROOT__/public/js/dtree.js"></script>
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
</script>
      </div>
      
      <!-- 右侧页面内容 -->
      <div class="rightDiv">
        <br>
        <form name="frm" method="post" action="__APP__/Addnews/addnews" enctype="multipart/form-data" onsubmit="return checkAdd()">
	        <table class="addNewsTb" bgcolor="#DCDCDC" border="0" align="center" width="700">
	          <tr>
	            <td>新闻标题：</td>
	            <td><input type="text" name="title" size="50"></td>
	          </tr>
	          <tr>
	            <td>新闻类型：</td>
	            <td>
	              <select name="typeId"> 
	       <?php if(is_array($newsTypes)): foreach($newsTypes as $key=>$v): ?><option value="<?php echo ($v["typeId"]); ?>"><?php echo ($v["typeName"]); ?></option><?php endforeach; endif; ?>
	              </select>
	            </td>
	          </tr>
	          <tr>
	            <td>新闻作者：</td>
	            <td><input type="text" name="writer" size="50"></td>
	          </tr>
	          <tr>
	            <td>新闻来源：</td>
	            <td><input type="text" name="source" size="50"></td>
	          </tr>
	          <tr>
	            <td>新闻图片：</td>
	            <td><input type="file" name="myFile" size="20"></td>
	          </tr>
	          <tr>
	            <td colspan="2"><textarea name="content"></textarea></td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	            <td>
	              <input type="submit" value="添加" class="btn2">
	              &nbsp;&nbsp;&nbsp;
	              <input type="reset" value="取消" class="btn2">
	            </td>
	          </tr>
	        </table>
        </form>
      </div> 
    </div>
  </body>
</html>