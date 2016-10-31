<?php if (!defined('THINK_PATH')) exit();?><html>
  <head>
    <title>天天新闻网</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
	<link href="__ROOT__/public/css/news.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="__ROOT__/library/kindeditor/kindeditor.js"></script>
    <script type="text/javascript">
      var editor;//编辑器
      KindEditor.ready(function(e){
          //创建编辑器
          editor = e.create("[name=body]",{
              "width":"560px",
              "height":"200px",
              "items":["source","undo","redo","|","bold","italic","underline"]
          });
      });
      //表单验证
      function checkReview()
      {
          if(editor.html() == "")
          {
              alert("请输入评论内容！");
              editor.focus();
              return false;
          }
          if(document.frm.userName.value == "")
          {
              alert("请输入评论人的姓名！");
              document.frm.userName.focus();
              return false;
          }
      }
    </script>
    </head>
  <body>
    <!-- 网站头 -->
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
	  <!-- 显示的新闻 -->
	  <div class="newsTypeDiv" style="border:1px solid #990100;">
	    <div class="newsTypeDiv1">
	      &nbsp;<a href="__APP__/Default/index" class="a">新闻主页</a> &raquo;<?php echo ($newsInfo["typeName"]); ?>
	    </div>
	  </div>
	  <div class="newsTitle"><?php echo ($newsInfo["title"]); ?></div>
	  <div class="newsTime"><?php echo ($newsInfo["dateandtime"]); ?></div>
	  	<?php if($newsInfo["imagepath"] != null): ?><div class="newsImg"><img src="__ROOT__/public/<?php echo ($newsInfo["imagepath"]); ?>" width="400" height="300"></div><?php endif; ?>
	  <div class="newsContent"><?php echo ($newsInfo["content"]); ?></div>
	 
	  <!-- 发表评论 -->
	<form name="frm" method="post" action="__APP__/News/addreview/articleId/<?php echo ($newsInfo["articleId"]); ?>" onsubmit="return checkReview()">
	  <div class="newsTypeDiv" style="border:1px solid #990100;">
	  
	   	<input type="hidden" name="articleId" value="<?php echo ($newsInfo["articleId"]); ?>"/>
	   	
	    <div class="newsTypeDiv1">&nbsp;&raquo; 发表评论</div>
	  </div>
	  <div class="newsContent">
	    	<img src="__ROOT__/public/images/face/em01.gif"><input type="radio" name="face" value="em01.gif" checked>
		    <img src="__ROOT__/public/images/face/em02.gif"><input type="radio" name="face" value="em02.gif">
		    <img src="__ROOT__/public/images/face/em03.gif"><input type="radio" name="face" value="em03.gif">
		    <img src="__ROOT__/public/images/face/em04.gif"><input type="radio" name="face" value="em04.gif">
		    <img src="__ROOT__/public/images/face/em05.gif"><input type="radio" name="face" value="em05.gif">
		    <img src="__ROOT__/public/images/face/em06.gif"><input type="radio" name="face" value="em06.gif">
		    <img src="__ROOT__/public/images/face/em07.gif"><input type="radio" name="face" value="em07.gif">
		    <img src="__ROOT__/public/images/face/em08.gif"><input type="radio" name="face" value="em08.gif">
		    <img src="__ROOT__/public/images/face/em10.gif"><input type="radio" name="face" value="em10.gif">
		    <img src="__ROOT__/public/images/face/em11.gif"><input type="radio" name="face" value="em11.gif">
	  </div>
	  <div class="newsImg">
	  		<textarea name="body"></textarea>
	  </div>
	  <div class="newsContent">
		    姓名：<input type="text" name="userName" size="20">
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <input type="submit" value="发表">
	  </div>
	  </form>
	  <!-- 评论内容 -->
		  <div class="newsTypeDiv" style="border:1px solid #990100;">
	    <div class="newsTypeDiv1">&nbsp;&raquo; 新闻点评</div>
	  </div>
	<?php if(is_array($reviewsInfo)): $k = 0; $__LIST__ = $reviewsInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; if($k % 2 ==1): ?><div class="reviewDiv" style="background-color:#ff0;"><?php endif; ?>
	  <div class="reviewDiv" style="background-color:#FFFBD6;">
	    <div class="reviewDiv1">
	      <img src="__ROOT__/public/images/face/<?php echo ($v["face"]); ?>">
	      		游客：<?php echo ($v["userName"]); ?>
	      		于 [ <?php echo ($v["dateandtime"]); ?> ] 
	      		发表评论：
	    </div>
	    <div class="reviewDiv1"><?php echo ($v["body"]); ?></div>
	    <div class="reviewDiv1"><hr class="hr1"></div>
	  </div><?php endforeach; endif; else: echo "" ;endif; ?>
	  <br>
	</div>
    <!-- 网页脚 -->
      <!-- 网页脚 -->
<div class="footDiv">
      网站简介 - 广告服务 - 网站地图 - 帮助信息 - 联系方式<br>
      Copyrights &copy; 2014 hys.com All Rights Reserved
</div>
  </body>
</html>