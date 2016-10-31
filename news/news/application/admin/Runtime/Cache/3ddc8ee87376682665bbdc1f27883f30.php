<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>后台管理系统</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
   	<link href="__ROOT__/public/css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="__ROOT__/library/jquery/jquery-2.2.3.js"></script>
 	<script type="text/javascript">
      //点击了页码的超链接
      function setPage(currentPage)
      {
          document.frm.currentPage.value = currentPage;//设置页码
          document.frm.submit();//提交表单
      }
      
      function delnews(articleId,typeId){
    	  if(confirm("是否删除该新闻？")){
    		  window.location = "__APP__/Modnews/delete/articleId/"+articleId+"/typeId/"+typeId;
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
    <div class="locationDiv">&nbsp;: 后台管理 : 修改新闻</div>
    
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
        <form name="frm" method="post" action="__APP__/Modnews/index" >
            <input type="hidden" name="currentPage" value="1">
	        <table border="0" align="center" width="700" cellpadding="0" cellspacing="0">
	          <tr>
	            <td align="left">
	              &nbsp;新闻搜索：
	              <input type="text" name="keyword" size="30" value='<?php echo ($keyword); ?>'/>
	              <select name="searchType"> 
	              		<?php if($searchType=='title'): ?><option value='title' selected='selected'>标题</option>
	                		<option value='content'>内容</option>
						<?php else: ?>
							<option value='title' >标题</option>
							<option value='content' selected='selected' >内容</option><?php endif; ?>
	              </select>
	              <input type="submit" value="搜索">
	            </td>
	          </tr>
	        </table>
        </form>
        <br>
        <table border="1" style="align:center;width:700px;cellpadding:0;cellspacing:0">
          <tr height="30" style="font-weight:bold;">
            <td>新闻编号</td>
            <td>新闻类型</td>
            <td>发表时间</td>
            <td width="300px">新闻标题</td>
            <td>删除评论</td>
            <td >删除新闻</td>
          </tr>
		<?php if(is_array($newsInfo)): foreach($newsInfo as $key=>$v): ?><tr height="25">
            <td><?php echo ($v["articleId"]); ?></td>
            <td><?php echo ($v["typeName"]); ?></td>
            <td><?php echo ($v["dateandtime"]); ?></td>
            <td align="left">
            		<a href="__APP__/UpdateNews/index/articleId/<?php echo ($v["articleId"]); ?>/typeId/<?php echo ($v["typeId"]); ?>">
            			<?php echo ($v["title"]); ?>
            		</a>
            	</td>
            <td><a href="__APP__/Reviews/index/articleId/<?php echo ($v["articleId"]); ?>">查看评论</a></td>
            <td><a href="#" onclick="delnews(<?php echo ($v["articleId"]); ?>,<?php echo ($v["typeId"]); ?>)">删除</a></td>
			</tr><?php endforeach; endif; ?>
          <tr height="25">
            <td colspan="6" align="left">
			<?php $__FOR_START_28811__=1;$__FOR_END_28811__=$totalPage+1;for($i=$__FOR_START_28811__;$i < $__FOR_END_28811__;$i+=1){ if($currentPage == $i): ?>[<?php echo ($i); ?>]&nbsp;&nbsp;
                <?php else: ?>
                  <a href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>