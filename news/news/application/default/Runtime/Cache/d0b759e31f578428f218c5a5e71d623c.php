<?php if (!defined('THINK_PATH')) exit();?><html>
  <head>
    <title>天天新闻网</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
   	<script type="text/javascript" src="__ROOT__/library/jquery/jquery-2.2.3.js"></script>
   	<script type="text/javascript">
	   	$(function(){
			$("#myImg").click(function(){
				$(this).attr("src","__ROOT__/public/yanzhengma/code.php?id="+new Date());
			});
		});
		function checkLogin() {
	          if(document.frm.userName.value == "") {
	              alert("请输入用户名！");
	              document.frm.userName.focus();
	              return false;
	          } else if(document.frm.password.value == "") {
	              alert("请输入密码！");
	              document.frm.password.focus();
	              return false;
	          }else if(document.frm.checkCode.value == ""){
	              alert("请输入验证码！");
	              document.frm.checkCode.focus();
	              return false;
	          }
	      }
   	</script>
   	<!-- 引入css文件 -->
    <link href="__ROOT__/public/css/news.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <!-- 包含头 -->
    <!-- 网站头 -->
    <div class="headDiv">
      <div class="headDiv1">
        <div class="headDiv10">www.<b>ttnewS</b>.com</div>
        <div class="headDiv11"><img src="__ROOT__/public/images/banner17.gif" width="370" height="50"></div>
      </div>
      <div class="headDiv2">天天新闻网<?php echo (date('Y-m-d g:i a',time())); ?></div>
    </div>
	<!-- 导航菜单 -->
<div class="menuDiv">
  <a href="__APP__/Default/index.html" class="a">首页</a> | 
  	<?php if(is_array($newstypes)): foreach($newstypes as $key=>$v): ?><a href="__APP__/NewsTypes/index/typeId/<?php echo ($v["typeId"]); ?>.html" class="a" ><?php echo ($v["typeName"]); ?></a>|<?php endforeach; endif; ?>
  <a href="__APP__/Search/index.html" class="a">搜索</a>
</div>
	<!-- 正文内容 -->
	<div class="mainDiv clear">
	  <!-- 左侧 -->
	  <div class="leftDiv">
	    <!-- 登陆 -->
	  	<form name="frm" method="post" action="__APP__/Default/checkLogin" onsubmit="return checkLogin()">
			<div class="loginDiv">
				<div class="loginDiv1">会员登陆</div>
				<div class="loginDiv2 clear">
					<div class="loginDiv20">用户名</div>
					<div class="loginDiv21"><input type="text" name="userName"  class="txt1">*</div>
				</div>
				<div class="loginDiv2 clear">
					<div class="loginDiv20">密码</div>
					<div class="loginDiv21"><input type="password" name="password"  class="txt1">*</div>
				</div>
				<div class="loginDiv2 clear">
					<div class="loginDiv20">验证码</div>
					<div class="loginDiv21">
						<input type="text" name="checkCode" size="8" maxlength="4">
						<img id="myImg" style="cursor:pointer" alt="看不清换一张" title="看不清换一张" src="__ROOT__/public/yanzhengma/code.php" align="absmiddle">
					</div>
				</div>
				<div class="loginDiv2 clear">
					<div class="loginDiv20">&nbsp;</div>
				<div class="loginDiv21"><input type="submit" value="登陆"></div>
				</div>
			</div>
		</form>
	    <!-- 一个分类带两条新闻 -->
	    <?php if(is_array($newstypes)): foreach($newstypes as $key=>$v): ?><div class="twoNews">
		<div class="twoNews1">&nbsp;
			<a href="__APP__/NewsTypes/index/typeId/<?php echo ($v["typeId"]); ?>.html" class="a"><?php echo ($v["typeName"]); ?></a>
		</div>
		<div class="twoNews2">
			<a href="__APP__/NewsTypes/index/typeId/<?php echo ($v["typeId"]); ?>.html" class="a">更多</a>&nbsp;
		</div>
	</div>
	<?php if(is_array($v["news"])): foreach($v["news"] as $key=>$v1): ?><div class="twoNews3" ><img src="__ROOT__/public/images/makealltop.gif">
			<a href="__APP__/News/index/articleId/<?php echo ($v1["articleId"]); ?>.html" 
			style="text-overflow:ellipsis;white-space:nowrap;overflow:hidden;
			display:inline-block;width:210px;">
			<?php echo ($v1["title"]); ?></a>
		</div><?php endforeach; endif; endforeach; endif; ?>
	  </div>
	  <!-- 右侧 -->
	  <div class="rightDiv">
	    <!-- 热点要闻 -->
	    <div class="hotNews">热点要闻</div>
	     	<?php if(is_array($hotNews)): foreach($hotNews as $key=>$v): ?><div class="hotNews1">
	  [<a href="__APP__/NewsTypes/index/typeId/<?php echo ($v["typeId"]); ?>.html"><?php echo ($v["typeName"]); ?></a>] 
	  <a href="__APP__/News/index/articleId/<?php echo ($v["articleId"]); ?>.html"><?php echo ($v["title"]); ?></a> 
	 <?php echo ($v["dateandtime"]); ?><img src="__ROOT__/public/images/new1.gif">         
</div><?php endforeach; endif; ?>
	    
	    <!-- 新闻分类导航 -->
	    	<div class="hotNews">新闻分类导航</div> 
	    <div class="newsDh">
	      <div class="newsDh1"><span class="newsCount">新闻总数：</span></div>
	      <div class="newsDh2"><?php echo ($num); ?></div>
	      <div class="newsDh3">&nbsp;</div>
	    </div>
	  
	<?php if(is_array($newstypes)): foreach($newstypes as $key=>$v): ?><div class="newsDh">
	      <div class="newsDh1"><a href="__APP__/NewsTypes/index/typeId/<?php echo ($v["typeId"]); ?>.html"><?php echo ($v["typeName"]); ?>：</a></div>
	      <div class="newsDh2"><?php echo ($v["articleNums"]); ?></div>
	      <div class="newsDh3"><a href="__APP__/NewsTypes/index/typeId/<?php echo ($v["typeId"]); ?>.html"><img src="__ROOT__/public/images/sch.gif" border="0" class="goImg"></a></div>
	    </div><?php endforeach; endif; ?>

















	   </div> 
    </div>
    <!-- 包含脚 -->
       <!-- 网页脚 -->
<div class="footDiv">
      网站简介 - 广告服务 - 网站地图 - 帮助信息 - 联系方式<br>
      Copyrights &copy; 2014 hys.com All Rights Reserved
</div> 
  </body>
</html>