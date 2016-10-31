

var Util = {};
Util.Event = {
    stop: function(ent){          
        var e = ent||window.event;
        if (e.preventDefault){
          e.preventDefault();
          e.stopPropagation();
        }
        else{
          e.returnValue = false;
          e.cancelBubble = true;
        }
    },
    add:function(elem,name,fn,useCapture){
        if (name == 'keypress' &&
        (navigator.appVersion.match(/Konqueror|Safari|KHTML/)
        || elem.attachEvent))
            name = 'keydown';
        if(elem.addEventListener){
            elem.addEventListener(name,fn,useCapture);
        }
        if(elem.attachEvent){
            elem.attachEvent("on"+name,fn);
        }
    },
    getEvent:function() {
        if (window.event) {
            return this.formatEvent(window.event);
        } else {
            return this.getEvent.caller.arguments[0];
        }
    },
    formatEvent:function (oEvent) {
        if (document.all) {
            oEvent.charCode = (oEvent.type == "keypress") ? oEvent.keyCode : 0;
            oEvent.eventPhase = 2;
            oEvent.isChar = (oEvent.charCode > 0);
            oEvent.pageX = oEvent.clientX + document.body.scrollLeft;
            oEvent.pageY = oEvent.clientY + document.body.scrollTop;
            oEvent.layerX = oEvent.offsetX;
            oEvent.layerY = oEvent.offsetY;
            oEvent.preventDefault = function () {
                this.returnValue = false;
            }
            if (oEvent.type == "mouseout") {
                oEvent.relatedTarget = oEvent.toElement;
            } else if (oEvent.type == "mouseover") {
                oEvent.relatedTarget = oEvent.fromElement;
            }
            oEvent.stopPropagation = function () {
                this.cancelBubble = true;
            };
            oEvent.target = oEvent.srcElement;
            oEvent.time = (new Date).getTime();
        }
        return oEvent;
    }
}
function $$(element) {
 return document.getElementById(element);
}
var arrowImage1 = new Image();arrowImage1.src = "common/images/left_btn.gif";
var arrowImage2 = new Image();arrowImage2.src = "common/images/right_btn.gif";
var NextPageTips = function(obj){
    var str = new String('\
                                <div style="width:103px;height:27px; text-align:center;"><img id="cursorImg" style="cursor:url(common/images/transMouse.cur),auto" src="common/images/left_btn.gif" /></div>\
                                <div style="width:103px;height:20px; border:1px solid #ffffff;filter:Alpha(Opacity=70);-moz-opacity: 0.8">\
                                   <div style="width:101px;height:18px;border:1px solid #000000;filter:Alpha(Opacity=60);-moz-opacity: 0.8">\
                                     <div style="width:100%;height:100%; background:#000000; filter:Alpha(Opacity=60);-moz-opacity: 0.6">\
                                     </div>\
                                   </div>\
                                </div>\
                                <span id="NextPageTipsSpan" style="font-size:13px; position:relative; top:-20px;left:8px;color:#ffffff;" ></span>\
                                ');
    Util.Event.add(obj,"mousemove",function(){
   var ObjectX = 0;
   ObjectX = Util.Event.getEvent().layerX;       
   if($$('NextPageTips')==null) {
   var oDiv = document.createElement("div");
   oDiv.style.position = "absolute";
   oDiv.style.left = Util.Event.getEvent().pageX + "px";
   oDiv.style.top = Util.Event.getEvent().pageY  + "px";
   oDiv.id = "NextPageTips";
   oDiv.style.height="20px";
   oDiv.style.width="103px";
   document.body.appendChild(oDiv);
   $$('NextPageTips').innerHTML = str;
  }         
  $$('NextPageTips').style.left = Util.Event.getEvent().pageX - 45 + "px";
  $$('NextPageTips').style.top = Util.Event.getEvent().pageY + 10 + "px";
  if(document.all)
  {
       Util.Event.stop();
  }
  var image = new Image();
  image.src = Util.Event.getEvent().target.src;
  width = 1002;

   if(ObjectX<Math.floor(width/2)) {
   $$('cursorImg').src = arrowImage1.src;
     
   $$('NextPageTipsSpan').innerHTML = "点击查看上一张";
   Util.Event.getEvent().target.onclick = function(){
    prePic();
   }
   }
   else
   {
   $$('cursorImg').src = arrowImage2.src;
   $$('NextPageTipsSpan').innerHTML = "点击查看下一张";
   Util.Event.getEvent().target.onclick = function(){
       nextPic();
   }
   }
    },false);                     
 Util.Event.add(obj,"mouseout",function(){
    if($$('NextPageTips')!=null)
    document.body.removeChild($$('NextPageTips'));
 },false);                               
};
function prePic() {

 if (imgIndex==0)
	 {
	 alert('已经是第一张了');
	 }else{
	 img.src = imgs[--imgIndex];
	 document.getElementById("currCount").innerHTML = (imgIndex+1);
 }
}
function nextPic() {
 if (imgIndex==imgs.length-1) alert('已经是最后一张了');
 else {
	 img.src = imgs[++imgIndex];
	 document.getElementById("currCount").innerHTML = (imgIndex+1);
 }
}
// jiangzhengqiu
var img = document.getElementById("main_img");
//img.style.cursor = "url(common/images/transMouse.cur),auto";

imgIndex = 0;
img.src = imgs[imgIndex];
showImg.src = imgs[0];
// 默认切凭证号
// 切片
var cutControl = "showImg";
var x = 820;
var y = 22;
var w = 189;
var h = 63;
$("#"+cutControl).css("position","absolute");
$("#"+cutControl).css("width","1082px");
$("#"+cutControl).css("height","510px");
$("#"+cutControl).css("left","-"+x+"px");
$("#"+cutControl).css("top","-"+y+"px");
$("#"+cutControl).css("clip","rect("+y+"px,"+(x+w)+"px,"+(y+h)+"px,"+x+"px)");
new NextPageTips(img);
// 监听键盘的左右键
function escButtonDown(){
    var event = document.all?window.event:arguments[0];
   if(event.keyCode == 37 )
   {
   prePic();
   }
   if(event.keyCode == 39)
   {
   nextPic();
   }

   if (event.keyCode == 13 && event.srcElement.type != 'button'
		&& event.srcElement.type != 'reset'
		&& event.srcElement.type != 'textarea' && event.srcElement.type != '' && event.srcElement.title !='密码支付' && event.srcElement.title != '凭证号匹配'){
	   event.keyCode = 9;
	if(event.srcElement.id == "description")
	{
		// 聚焦
    	document.getElementById("docID").focus();
    	// 将内容选中
    	document.getElementById("docID").select();
	}
   }
 }
window.document.onkeydown=escButtonDown; // JavaScript Document
function Hturn()//水平翻转
{
	document.getElementById("main_img").style.filter = document.getElementById("main_img").style.filter =="fliph"?"":"fliph";
}
function Vturn()//垂直翻转
{
	document.getElementById("main_img").style.filter = document.getElementById("main_img").style.filter =="flipV"?"":"flipV";
}
function reset()
{
	document.getElementById("main_img").style.filter = "";	
}