<%@ page language="java" import="java.util.*" pageEncoding="utf-8"%>

<%@ taglib prefix="s" uri="/struts-tags"%>
<script src="/videotreat/common/javascript/CJL.0.1.min.js"></script>
<script src="/videotreat/common/javascript/ImageTrans.js"></script>

<style>


img {
	border: none
}

.txt_1 {
	font: bold 24px Verdana, Tahoma;
	color: #fff
}

img.thumb_img {
	cursor: pointer;
	display: block;
	margin-bottom: 10px
}

img#main_img {
	cursor: pointer;
	display: block;
}

#gotop {
	cursor: pointer;
	display: block;
}

#gobottom {
	cursor: pointer;
	display: block;
}

#showArea {
	height: 300px;
	width: 120px;
	margin: 10px;
	overflow-y: auto;
	overflow-x: hidden
}

.info {
	color: #666;
	font: normal 9px Verdana;
	margin-top: 20px
}

.info a:link,.info a:visited {
	color: #666;
	text-decoration: none
}

.info a:hover {
	color: #fff;
	text-decoration: none
}
</style>

	<table width="760" border="0"  cellpadding="0"
		cellspacing="5">

		<tr>
			<td width="110" align="center" valign="top"><img
				src="/videotreat/common/images/gotop.gif" width="100" height="14" id="gotop" />

				<div id="showArea">
<s:iterator var="img" value="imgList"><s:property value='img'/>
					<img src="/imageSave/<s:property value='img'/>" alt="票据影像" width="80" height="50"
						border="0" class="thumb_img" />
</s:iterator>

				</div> <img src="/videotreat/common/images/gobottom.gif" width="100" height="14"
				id="gobottom" />
			</td>

			<td width="640" align="center"><div
					style=" border:2px solid;overflow:auto;   width:640px; height:300px;">
					<div id="idContainer" style="width:640px; height:300px;"></div>
				</div>
			</td>

		</tr>
	</table>
	<br />

	<p>&nbsp;</p>
	
	
	<script>
	(function() {

		var container = $$("idContainer"), src = "/videotreat/common/images/01.jpg", options = {
			onPreLoad : function() {
				container.style.backgroundImage = "url('loading.gif')";
			},
			onLoad : function() {
				container.style.backgroundImage = "";
			}
		}, it = new ImageTrans(container, options);
		it.load(src);

	})();
</script>
<!-- <script language="javascript" type="text/javascript"> -->
<!-- 	function $(e) { -->
<!-- 		return document.getElementById(e); -->
<!-- 	} -->
<!-- 	document.getElementsByClassName = function(cl) { -->
<!-- 		var retnode = []; -->
<!-- 		var myclass = new RegExp('\\b' + cl + '\\b'); -->
<!-- 		var elem = this.getElementsByTagName('*'); -->
<!-- 		for ( var i = 0; i < elem.length; i++) { -->
<!-- 			var classes = elem[i].className; -->
<!-- 			if (myclass.test(classes)) -->
<!-- 				retnode.push(elem[i]); -->
<!-- 		} -->
<!-- 		return retnode; -->
<!-- 	}; -->
<!-- 	var MyMar; -->
<!-- 	var speed = 1; //速度，越大越慢 -->
<!-- 	var spec = 1; //每次滚动的间距, 越大滚动越快 -->
<!-- 	var ipath = '/videotreat/common/images/'; //图片路径 -->
<!-- 	var thumbs = document.getElementsByClassName('thumb_img'); -->
<!-- 	for ( var i = 0; i < thumbs.length; i++) { -->
<!-- 		thumbs[i].onmouseover = function() { -->
<!-- 			$('main_img').src = this.src; -->
<!-- 		}; -->
<!-- 		thumbs[i].onclick = function() { -->
<!-- 			$('main_img').src = this.src; -->
<!-- 		}; -->
<!-- 	} -->

<!-- 	$('gotop').onmouseover = function() { -->
<!-- 		this.src = ipath + 'gotop2.gif'; -->
<!-- 		MyMar = setInterval(gotop, speed); -->
<!-- 	}; -->
<!-- 	$('gotop').onmouseout = function() { -->
<!-- 		this.src = ipath + 'gotop.gif'; -->
<!-- 		clearInterval(MyMar); -->
<!-- 	}; -->
<!-- 	$('gobottom').onmouseover = function() { -->
<!-- 		this.src = ipath + 'gobottom2.gif'; -->
<!-- 		MyMar = setInterval(gobottom, speed); -->
<!-- 	}; -->
<!-- 	$('gobottom').onmouseout = function() { -->
<!-- 		this.src = ipath + 'gobottom.gif'; -->
<!-- 		clearInterval(MyMar); -->
<!-- 	}; -->
<!-- 	function gotop() { -->
<!-- 		$('showArea').scrollTop -= spec; -->
<!-- 	} -->
<!-- 	function gobottom() { -->
<!-- 		$('showArea').scrollTop += spec; -->
<!-- 	} -->
<!-- </script> -->


