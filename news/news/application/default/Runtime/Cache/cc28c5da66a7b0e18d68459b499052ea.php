<?php if (!defined('THINK_PATH')) exit();?><html>
  <head>
    <title>天天新闻网</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="__ROOT__/public/css/news.css" type="text/css" rel="stylesheet" />
    
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
	  <!-- 搜索条件 -->
	  <form name="frm" method="post" action="__APP__/Search/index">
	  <div class="newsTypeDiv" style="border:1px solid #990100;">
	    <div class="newsTypeDiv1">&nbsp;搜索新闻</div>
	    <div class="newsTypeDiv2">&nbsp;</div>
	  </div>
	  <div class="searchDiv">
	   	 搜索类型：
	    <select name="searchType"><!-- value是表的字段名 -->
	      <option value="title">标题</option>
	      <option value="content">内容</option>
	    </select>
		关键字：
	    <input type="text" name="keyword" size="20">
	    <input type="submit" value="搜索">
	  </div>
	  </form>
	  <!-- 显示搜索到的新闻 -->
	  
	  <div class="newsTypeDiv">
	    <div class="newsTypeDiv1">&nbsp;<a href="__APP__/Default/index" class="a">新闻主页</a> &raquo; 搜索新闻</div>
	    <div class="newsTypeDiv2">本次搜索到 <?php echo ($count); ?> 条新闻</div>
	  </div> 
	 <?php if(is_array($newsInfo)): foreach($newsInfo as $key=>$v): ?><div class="newsTypeDiv3">
	    <img src="__ROOT__/public/images/makealltop.gif">
	    <a href="__APP__/News/index/articleId/<?php echo ($v["articleId"]); ?>.html"><?php echo ($v["title"]); ?></a>
	  </div>
	  <div class="newsTypeDiv3">&nbsp;</div><?php endforeach; endif; ?>
	</div>
   
    <!-- 网页脚 -->
    <!-- 网页脚 -->
<div class="footDiv">
      网站简介 - 广告服务 - 网站地图 - 帮助信息 - 联系方式<br>
      Copyrights &copy; 2014 hys.com All Rights Reserved
</div> 
  </body>
</html>