<%@ page language="java" import="java.util.*" pageEncoding="utf-8"%>
<%
	String path = request.getContextPath();
	String basePath = request.getScheme() + "://"
			+ request.getServerName() + ":" + request.getServerPort()
			+ path + "/";
	response.setHeader("Cache-Control", "no-store"); //HTTP   1.1   
	response.setHeader("Pragma", "no-cache"); //HTTP   1.0   
	response.setDateHeader("Expires", 0); //prevents   caching   at   the   proxy   server
%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@page import="com.opensymphony.xwork2.ognl.OgnlValueStack"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<base href="<%=basePath%>" />
<title>医生信息管理模块</title>

<script type="text/javascript"
	src="<%=path%>/common/javascript/jquery.js"></script>
<link href="<%=path%>/common/indexpage/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="<%=path%>/common/indexpage/css/styleindex.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.useso.com/css?family=Oxygen:300,400,700' rel='stylesheet' type='text/css'>
<style type="text/css">
body,td,th {
	font-family: Oxygen, sans-serif;
	}
#s1{ width: 100px; height: 100px; float: left; } 
#s2{ width: 100px; height: 100px; border:4px;border-bottom-color:blue; float: left; } 
#s3{ width: 100px; height: 100px; border:3px;border-bottom-color:blue; float: left; clear: left; } 
#s4{ width: 100px; height: 100px;  border:3px;border-bottom-color:blue;float: left; } 
</style>

<script src="<%=path%>/common/indexpage/js/jquery.easydropdown.js"></script>
<script src="<%=path%>/common/indexpage/js/responsiveslides.min.js"></script>
<script type="text/javascript">
/*
 * My97 DatePicker 4.72 Release
 * License: http://www.my97.net/dp/license.asp
 */
var $dp,WdatePicker;(function(){var _={
$wdate:true,
$dpPath:"",
$crossFrame:true,
doubleCalendar:false,
enableKeyboard:true,
enableInputMask:true,
autoUpdateOnChanged:null,
whichDayIsfirstWeek:4,
position:{},
lang:"auto",
skin:"default",
dateFmt:"yyyy-MM-dd",
realDateFmt:"yyyy-MM-dd",
realTimeFmt:"HH:mm:ss",
realFullFmt:"%Date %Time",
minDate:"1900-01-01 00:00:00",
maxDate:"2099-12-31 23:59:59",
startDate:"",
alwaysUseStartDate:false,
yearOffset:1911,
firstDayOfWeek:0,
isShowWeek:false,
highLineWeekDay:true,
isShowClear:true,
isShowToday:true,
isShowOK:true,
isShowOthers:true,
readOnly:false,
errDealMode:0,
autoPickDate:null,
qsEnabled:true,
autoShowQS:false,

specialDates:null,specialDays:null,disabledDates:null,disabledDays:null,opposite:false,onpicking:null,onpicked:null,onclearing:null,oncleared:null,ychanging:null,ychanged:null,Mchanging:null,Mchanged:null,dchanging:null,dchanged:null,Hchanging:null,Hchanged:null,mchanging:null,mchanged:null,schanging:null,schanged:null,eCont:null,vel:null,errMsg:"",quickSel:[],has:{}};WdatePicker=U;var X=window,O="document",J="documentElement",C="getElementsByTagName",V,A,T,I,b;switch(navigator.appName){case"Microsoft Internet Explorer":T=true;break;case"Opera":b=true;break;default:I=true;break}A=L();if(_.$wdate)M(A+"skin/WdatePicker.css");V=X;if(_.$crossFrame){try{while(V.parent&&V.parent[O]!=V[O]&&V.parent[O][C]("frameset").length==0)V=V.parent}catch(P){}}if(!V.$dp)V.$dp={ff:I,ie:T,opera:b,el:null,win:X,status:0,defMinDate:_.minDate,defMaxDate:_.maxDate,flatCfgs:[]};B();if($dp.status==0)Z(X,function(){U(null,true)});if(!X[O].docMD){E(X[O],"onmousedown",D);X[O].docMD=true}if(!V[O].docMD){E(V[O],"onmousedown",D);V[O].docMD=true}E(X,"onunload",function(){if($dp.dd)Q($dp.dd,"none")});function B(){V.$dp=V.$dp||{};obj={$:function($){return(typeof $=="string")?X[O].getElementById($):$},$D:function($,_){return this.$DV(this.$($).value,_)},$DV:function(_,$){if(_!=""){this.dt=$dp.cal.splitDate(_,$dp.cal.dateFmt);if($)for(var B in $)if(this.dt[B]===undefined)this.errMsg="invalid property:"+B;else{this.dt[B]+=$[B];if(B=="M"){var C=$["M"]>0?1:0,A=new Date(this.dt["y"],this.dt["M"],0).getDate();this.dt["d"]=Math.min(A+C,this.dt["d"])}}if(this.dt.refresh())return this.dt}return""},show:function(){var A=V[O].getElementsByTagName("div"),$=100000;for(var B=0;B<A.length;B++){var _=parseInt(A[B].style.zIndex);if(_>$)$=_}this.dd.style.zIndex=$+2;Q(this.dd,"block")},hide:function(){Q(this.dd,"none")},attachEvent:E};for(var $ in obj)V.$dp[$]=obj[$];$dp=V.$dp;$dp.dd=V[O].getElementById("_my97DP")}function E(A,$,_){if(T)A.attachEvent($,_);else if(_){var B=$.replace(/on/,"");_._ieEmuEventHandler=function($){return _($)};A.addEventListener(B,_._ieEmuEventHandler,false)}}function L(){var _,A,$=X[O][C]("script");for(var B=0;B<$.length;B++){_=$[B].src.substring(0,$[B].src.toLowerCase().indexOf("wdatepicker.js"));A=_.lastIndexOf("/");if(A>0)_=_.substring(0,A+1);if(_)break}return _}function F(F){var E,C;if(F.substring(0,1)!="/"&&F.indexOf("://")==-1){E=V.location.href;C=location.href;if(E.indexOf("?")>-1)E=E.substring(0,E.indexOf("?"));if(C.indexOf("?")>-1)C=C.substring(0,C.indexOf("?"));var G,I,$="",D="",A="",J,H,B="";for(J=0;J<Math.max(E.length,C.length);J++){G=E.charAt(J).toLowerCase();I=C.charAt(J).toLowerCase();if(G==I){if(G=="/")H=J}else{$=E.substring(H+1,E.length);$=$.substring(0,$.lastIndexOf("/"));D=C.substring(H+1,C.length);D=D.substring(0,D.lastIndexOf("/"));break}}if($!="")for(J=0;J<$.split("/").length;J++)B+="../";if(D!="")B+=D+"/";F=E.substring(0,E.lastIndexOf("/")+1)+B+F}_.$dpPath=F}function M(A,$,B){var D=X[O][C]("HEAD").item(0),_=X[O].createElement("link");if(D){_.href=A;_.rel="stylesheet";_.type="text/css";if($)_.title=$;if(B)_.charset=B;D.appendChild(_)}}function Z($,_){E($,"onload",_)}function G($){$=$||V;var A=0,_=0;while($!=V){var D=$.parent[O][C]("iframe");for(var F=0;F<D.length;F++){try{if(D[F].contentWindow==$){var E=W(D[F]);A+=E.left;_+=E.top;break}}catch(B){}}$=$.parent}return{"leftM":A,"topM":_}}function W(F){if(F.getBoundingClientRect)return F.getBoundingClientRect();else{var A={ROOT_TAG:/^body|html$/i,OP_SCROLL:/^(?:inline|table-row)$/i},E=false,H=null,_=F.offsetTop,G=F.offsetLeft,D=F.offsetWidth,B=F.offsetHeight,C=F.offsetParent;if(C!=F)while(C){G+=C.offsetLeft;_+=C.offsetTop;if(S(C,"position").toLowerCase()=="fixed")E=true;else if(C.tagName.toLowerCase()=="body")H=C.ownerDocument.defaultView;C=C.offsetParent}C=F.parentNode;while(C.tagName&&!A.ROOT_TAG.test(C.tagName)){if(C.scrollTop||C.scrollLeft)if(!A.OP_SCROLL.test(Q(C)))if(!b||C.style.overflow!=="visible"){G-=C.scrollLeft;_-=C.scrollTop}C=C.parentNode}if(!E){var $=a(H);G-=$.left;_-=$.top}D+=G;B+=_;return{"left":G,"top":_,"right":D,"bottom":B}}}function N($){$=$||V;var B=$[O],A=($.innerWidth)?$.innerWidth:(B[J]&&B[J].clientWidth)?B[J].clientWidth:B.body.offsetWidth,_=($.innerHeight)?$.innerHeight:(B[J]&&B[J].clientHeight)?B[J].clientHeight:B.body.offsetHeight;return{"width":A,"height":_}}function a($){$=$||V;var B=$[O],A=B[J],_=B.body;B=(A&&A.scrollTop!=null&&(A.scrollTop>_.scrollTop||A.scrollLeft>_.scrollLeft))?A:_;return{"top":B.scrollTop,"left":B.scrollLeft}}function D($){var _=$?($.srcElement||$.target):null;try{if($dp.cal&&!$dp.eCont&&$dp.dd&&_!=$dp.el&&$dp.dd.style.display=="block")$dp.cal.close()}catch($){}}function Y(){$dp.status=2;H()}function H(){if($dp.flatCfgs.length>0){var $=$dp.flatCfgs.shift();$.el={innerHTML:""};$.autoPickDate=true;$.qsEnabled=false;K($)}}var R,$;function U(J,C){$dp.win=X;B();J=J||{};if(C){if(!G()){$=$||setInterval(function(){if(V[O].readyState=="complete")clearInterval($);U(null,true)},50);return}if($dp.status==0){$dp.status=1;K({el:{innerHTML:""}},true)}else return}else if(J.eCont){J.eCont=$dp.$(J.eCont);$dp.flatCfgs.push(J);if($dp.status==2)H()}else{if($dp.status==0){U(null,true);return}if($dp.status!=2)return;var F=D();if(F){$dp.srcEl=F.srcElement||F.target;F.cancelBubble=true}$dp.el=J.el=$dp.$(J.el||$dp.srcEl);if(!$dp.el||$dp.el["My97Mark"]===true||$dp.el.disabled||($dp.el==$dp.el&&Q($dp.dd)!="none"&&$dp.dd.style.left!="-1970px")){$dp.el["My97Mark"]=false;return}K(J);if(F&&$dp.el.nodeType==1&&$dp.el["My97Mark"]===undefined){$dp.el["My97Mark"]=false;var _,A;if(F.type=="focus"){_="onclick";A="onfocus"}else{_="onfocus";A="onclick"}E($dp.el,_,$dp.el[A])}}function G(){if(T&&V!=X&&V[O].readyState!="complete")return false;return true}function D(){if(I){func=D.caller;while(func!=null){var $=func.arguments[0];if($&&($+"").indexOf("Event")>=0)return $;func=func.caller}return null}return event}}function S(_,$){return _.currentStyle?_.currentStyle[$]:document.defaultView.getComputedStyle(_,false)[$]}function Q(_,$){if(_)if($!=null)_.style.display=$;else return S(_,"display")}function K(H,$){for(var D in _)if(D.substring(0,1)!="$")$dp[D]=_[D];for(D in H)if($dp[D]!==undefined)$dp[D]=H[D];var E=$dp.el?$dp.el.nodeName:"INPUT";if($||$dp.eCont||new RegExp(/input|textarea|div|span|p|a/ig).test(E))$dp.elProp=E=="INPUT"?"value":"innerHTML";else return;if($dp.lang=="auto")$dp.lang=T?navigator.browserLanguage.toLowerCase():navigator.language.toLowerCase();if(!$dp.dd||$dp.eCont||($dp.lang&&$dp.realLang&&$dp.realLang.name!=$dp.lang&&$dp.getLangIndex&&$dp.getLangIndex($dp.lang)>=0)){if($dp.dd&&!$dp.eCont)V[O].body.removeChild($dp.dd);if(_.$dpPath=="")F(A);var B="<iframe style=\"width:1px;height:1px\" src=\""+_.$dpPath+"My97DatePicker.htm\" frameborder=\"0\" border=\"0\" scrolling=\"no\"></iframe>";if($dp.eCont){$dp.eCont.innerHTML=B;Z($dp.eCont.childNodes[0],Y)}else{$dp.dd=V[O].createElement("DIV");$dp.dd.id="_my97DP";$dp.dd.style.cssText="position:absolute";$dp.dd.innerHTML=B;V[O].body.appendChild($dp.dd);Z($dp.dd.childNodes[0],Y);if($)$dp.dd.style.left=$dp.dd.style.top="-1970px";else{$dp.show();C()}}}else if($dp.cal){$dp.show();$dp.cal.init();if(!$dp.eCont)C()}function C(){var F=$dp.position.left,B=$dp.position.top,C=$dp.el;if(C!=$dp.srcEl&&(Q(C)=="none"||C.type=="hidden"))C=$dp.srcEl;var H=W(C),$=G(X),D=N(V),A=a(V),E=$dp.dd.offsetHeight,_=$dp.dd.offsetWidth;if(isNaN(B)){if(B=="above"||(B!="under"&&(($.topM+H.bottom+E>D.height)&&($.topM+H.top-E>0))))B=A.top+$.topM+H.top-E-2;else B=A.top+$.topM+Math.min(H.bottom,D.height-E)+2}else B+=A.top+$.topM;if(isNaN(F))F=A.left+Math.min($.leftM+H.left,D.width-_-5)-(T?2:0);else F+=A.left+$.leftM;$dp.dd.style.top=B+"px";$dp.dd.style.left=F+"px"}}})()

</script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
<script type="text/javascript">
 $(document).ready(function () {
			       
			       
			       
			    });
	//删除
	var autoidDelete;
	function deletedetail(autoidDelete){
		if(confirm('确认删除该条记录?')){
			
			var param="deleteAutoid="+autoidDelete;
			
			$.post('<%=path%>/doctorAction_delete.action',
						param,
						function(data) {
							if (data == "true") {
								alert("删除成功");
								window.location.href = "doctorAction_query.action";
							} else if (data == "false"){
								alert("系统发生异常，请刷新界面重新进行相关操作");
							}else {
								alert(data);
							}
						});
		 
		}
	}
//返回
	function backtodetail(){
		window.location.href="<%=path%>/doctorAction_init.action";
	}
  function detail(autoidUpdate){
            var param="autoidUpdate="+autoidUpdate;
			window.location.href="<%=path%>/doctorAction_detail.action?"+param;
  }
	</script>
</head>

<body id="wrap">
 <body>
<div class="header">
   <div class="header_top">
    <div class="container">
	  <div class="header_top_left">
	  <img src="../common/images/logio.png" height="40px" width="70px"/>
	  </div>
	  
	  <div class="header_top_right">
	 
	  	<div class="lang_list">
			<select tabindex="4" class="dropdown">
				<option value="" class="label" value="">忙碌</option>
				<option value="1">离开</option>
				<option value="2">接诊</option>
			</select>
   		</div>

  <ul class="header_user_info">
   			
		  <a class="login" href="login.html">
			<i class="user"></i> 
			
			<li class="user_desc">我的就诊</li>
		  </a>
 
	    </ul>
          <div class="srch">安全退出</div>
	    <div class="clearfix"> </div>

        </div>
	 
	</div>
  </div>
 
  </div>

 <div class="grid-2">
       	<div class="container">
       	
  <div id="s1">  
<script src="https://static.opentok.com/v2/js/opentok.js"charset="utf-8"></script>

<script charset="utf-8">
var apiKey ='45542302';
var sessionId ='1_MX40NTU0MjMwMn5-MTQ1OTgzNTQ0NzAzNn5nQUpseWRadVVZRWRPbHQrc0doQ29RQWd-UH4';
var token ='T1==cGFydG5lcl9pZD00NTU0MjMwMiZzaWc9NjA5YzBmYjBmNzA1MmVjODYwYWVlOTM2YjI4MTQxZjI4Mzg4N2Y2ZTpzZXNzaW9uX2lkPTJfTVg0ME5UVTBNak13TW41LU1UUTFPVGd6TlRrM01USXhOMzVRY3pGTlNYQk5jbGhOZFhOSFpVSXhUV3BPZGxZNVpXcC1VSDQmY3JlYXRlX3RpbWU9MTQ1OTgzNTk3MyZub25jZT0tMTI1NTYwNDk3NiZyb2xlPXB1Ymxpc2hlciZleHBpcmVfdGltZT0xNDU5OTIyMzcz';
var session = OT.initSession(apiKey,sessionId).on('streamCreated',function(event){ 
 session.subscribe(event.stream);       
 }).connect(token,function(error){
var publisher = OT.initPublisher(); 
 session.publish(publisher);});
</script>
    </div> 
  <div id="s2"></div>
  <div id="s3"></div> 
  <div id="s4"></div>
       	
       		
       	</div>
       </div>
      
       <div class="footer_bottom">
       	<div class="container">
       		<div class="cssmenu">
				<ul>
					<li class="active"><a href="login.html">我们的伙伴</a></li> |
					<li><a href="checkout.html">制作团队</a></li> |
					<li><a href="checkout.html">易接近</a></li> |
					<li><a href="login.html">存储目录</a></li> |
					<li><a href="register.html">关于我们</a></li>
				</ul>
			</div>
			<div class="copy">
			    <p>Copyright 2014. name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/"></a></p>
		    </div>
		    <div class="clearfix"> </div>
       	</div>
       </div>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>