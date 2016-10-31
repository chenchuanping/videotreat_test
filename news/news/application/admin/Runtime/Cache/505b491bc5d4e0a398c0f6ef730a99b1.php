<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>后台管理系统</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
   <link href="__ROOT__/public/css/admin.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="__ROOT__/library/jquery/jquery-2.2.3.js"></script>
	 <script type="text/javascript">
      //删除分类
      function delType(typeId){
          if(confirm("是否删除该分类及分类下所有新闻？")){
              window.location = "__APP__/Modtype/delete/typeId/"+typeId;
          }
      }
      var oldTypeId;//原来的typeId
      var oldTypeName;//原来的typeName
      var oldArticleNums;//原来articleNums
      var oldLink;//原来的超链接
      //点击了编辑按扭
      //让某一行显示为文本框
      function showText(typeId) {
          hideText(); 
          oldTypeId = typeId;
          oldTypeName = $("#td"+typeId+"1").html();
          oldArticleNums = $("#td"+typeId+"2").html();
          oldLink = $("#td"+typeId+"3").html();
          $("#td"+typeId+"0").css("backgroundColor","gray");
          $("#td"+typeId+"1").html("<input type='text' name='typeName' size='10' value='"+oldTypeName+"'>");
          $("#td"+typeId+"2").html("<input type='text' name='articleNums' size='10' value='"+oldArticleNums+"'>");
          $("#td"+typeId+"3").html("<a href='#' onclick='submitForm()'>更新</a>  <a href='#' onclick='hideText()'>取消</a>");
      }
      //点击了取消按扭，将内容还原成以前的内容
      function hideText(){
    	  $("#td"+oldTypeId+"0").css("backgroundColor","white");
    	  $("#td"+oldTypeId+"1").html(oldTypeName);
    	  $("#td"+oldTypeId+"2").html(oldArticleNums);
    	  $("#td"+oldTypeId+"3").html(oldLink);
      }
      //点击了更新按扭
      function submitForm(){
          //设置表单的提交地址
          document.frm.action = "__APP__/Modtype/modtype/typeId/"+oldTypeId;
          document.frm.submit();//提交表单
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
	<div id="menuDiv1"><a href="#" onclick="logout()">重新登陆</a></div>
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
    <div class="locationDiv">&nbsp;: 后台管理 : 修改分类</div>
    
    <!-- 正文内容 -->
    <div class="mainDiv clear">
    
      <!-- 左侧树状列表 -->
      <div class="leftDiv">  <script type="text/javascript" src="__ROOT__/public/js/dtree.js"></script>
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
      <br><br><br><br>
        <form name="frm" method="post" action="modtype.php">
        	<table border="1" style="align:center;width:600px;cellpadding:0;cellspacing:0">
	          <tr class="modTypeDiv1">
	            <td>类别名称</td>
	            <td>新闻数</td>
	            <td>操作</td>
	          </tr>
	        <?php if(is_array($newstypes)): foreach($newstypes as $key=>$v): ?><tr id="td<?php echo ($v["typeId"]); ?>0" class="modTypeDiv2" style="background-color:#FFFFFF;">
	            <td id="td<?php echo ($v["typeId"]); ?>1" width="200"><?php echo ($v["typeName"]); ?></td>
	            <td id="td<?php echo ($v["typeId"]); ?>2" width="200"><?php echo ($v["articleNums"]); ?></td>
	            <td id="td<?php echo ($v["typeId"]); ?>3" width="200">
	             	 <a href="#" onclick="showText(<?php echo ($v["typeId"]); ?>)">编辑</a>
	             	 &nbsp;&nbsp;&nbsp;
	             	 <a href="#" onclick="delType(<?php echo ($v["typeId"]); ?>)">删除</a>
	            </td>
	          </tr><?php endforeach; endif; ?>
       	 </table>
        </form>
      </div>
    </div>
  </body>
</html>