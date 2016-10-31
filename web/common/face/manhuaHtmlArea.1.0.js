/***
 * 漫画原创在线表情编辑器Jquery插件
 * 编写时间：2012年10月13号
 * 支持原创 关注JquerySchool
 * http://www.jq-school.com
 * version:manhuaHtmlArea.1.0.js
***/
$(function() {
	$.fn.manhuaHtmlArea = function(options) {
		var defaults = {
			Event : "click",	//响应的事件
			Left : 0,			//表情层显示偏移元素左边的位置
			Top : 22,			//表情层显示偏移元素上边的位置
			id : "content"  	//内容插件表单的ID
		};
		var options = $.extend(defaults,options);
		var bid = parseInt(Math.random()*100000);	
		$("body").prepend("<div id='showAddFacePic"+bid+"'class='addons layer-emotions'><b class='tri-b'></b><b class='tri-t'></b>" +
				"<div class='layer-tab clearfix'><a id='close"+bid+"' class='close' href='javascript:void(0)'></a><span>常用表情</span></div><div class='layer-content'>" +
						"<ul id='emotions"+bid+"' class='emotions clearfix'>" +
								"<li><img src='common/face/images/faces/z_f000.png' addFacesPic='z_f000' alt='心' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f001.png' addFacesPic='z_f001' alt='酷' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f002.png' addFacesPic='z_f002' alt='难过' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f003.png' addFacesPic='z_f003' alt='高兴' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f004.png' addFacesPic='z_f004' alt='伤心' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f005.png' addFacesPic='z_f005' alt='难受' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f006.png' addFacesPic='z_f006' alt='色' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f007.png' addFacesPic='z_f007' alt='囧' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f008.png' addFacesPic='z_f008' alt='难过' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f009.png' addFacesPic='z_f009' alt='开心' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f010.png' addFacesPic='z_f010' alt='星星' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f011.png' addFacesPic='z_f011' alt='流泪' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f012.png' addFacesPic='z_f012' alt='挑逗' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f013.png' addFacesPic='z_f013' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f014.png' addFacesPic='z_f014' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f015.png' addFacesPic='z_f015' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f016.png' addFacesPic='z_f016' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f017.png' addFacesPic='z_f017' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f018.png' addFacesPic='z_f018' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f019.png' addFacesPic='z_f019' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f020.png' addFacesPic='z_f020' alt='大哭' title=''/></li>" +
								"<li><img src='common/face/images/faces/z_f021.png' addFacesPic='z_f021' alt='大哭' title=''/></li>" +
								"</ul></div></div>");	
		var $btn = $(this);
		var $biaoqing = $("#showAddFacePic"+bid);	
		var $emotions = $("#emotions"+bid+" li img");
		var $close = $("#close"+bid);
		var $input = $("#"+options.id);
		//表情点击事件
		$emotions.die().click(function(){
			 $biaoqing.hide();
			 $input.die().insertContent($(this).attr("addFacesPic"));			 
		});		
		//关闭表情层
		$close.click(function(){
			 $biaoqing.hide();			 	 
		});
		$biaoqing.hover(function(){$biaoqing.show();},function(){$biaoqing.hide();	});
		//选择表情按钮触发事件
		$btn.live(options.Event,function(e){						
		  var iof = $(this).offset();
		  var w = $(this).width();
		  var h = $(this).height();
		  $biaoqing.css({ "left" : iof.left+options.Left,"top" : iof.top+options.Top });
		  $biaoqing.show();		  
		});			
	};
	
	
//	String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) {  
//		   if (!RegExp.prototype.isPrototypeOf(reallyDo)) {  
//		    return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi": "g")), replaceWith);  
//		   } else {  
//		    return this.replace(reallyDo, replaceWith);  
//		   }  
//		  }  
	
	String.prototype.replaceAll  = function(s1,s2){       return this.replace(new RegExp(s1,"gm"),s2);       }

	
	//代替表情内容
	$.fn.extend({
		replaceContent : function(content){
		content = content.replaceAll("\\[呵呵\\]","<img src='common/face/images/faces/smilea.gif' addFacesPic='[呵呵]' alt='呵呵' title='呵呵' />").replaceAll("\\[嘻嘻\\]","<img src='common/face/images/faces/tootha.gif' addFacesPic='[嘻嘻]' alt='嘻嘻' title='嘻嘻'/>").replaceAll("\\[哈哈\\]","<img src='common/face/images/faces/laugh.gif' addFacesPic='[哈哈]' alt='哈哈' title='哈哈'/>").replaceAll("\\[可爱\\]","<img src='common/face/images/faces/tza.gif' addFacesPic='[可爱]' alt='可爱' title='可爱'/>").replaceAll("\\[可怜\\]","<img src='common/face/images/faces/kl.gif' addFacesPic='[可怜]' alt='可怜' title='可怜'/>").replaceAll("\\[挖鼻屎\\]","<img src='common/face/images/faces/kbsa.gif' addFacesPic='[挖鼻屎]' alt='挖鼻屎' title='挖鼻屎'/>").replaceAll("\\[吃惊\\]","<img src='common/face/images/faces/cj.gif' addFacesPic='[吃惊]' alt='吃惊' title='吃惊'/>").replaceAll("\\[害羞\\]","<img src='common/face/images/faces/shamea.gif' addFacesPic='[害羞]' alt='害羞' title='害羞'/>").replaceAll("\\[挤眼\\]","<img src='common/face/images/faces/zy.gif' addFacesPic='[挤眼]' alt='挤眼' title='挤眼'/>").replaceAll("\\[闭嘴\\]","<img src='common/face/images/faces/bz.gif' addFacesPic='[闭嘴]' alt='闭嘴' title='闭嘴'/>").replaceAll("\\[鄙视\\]","<img src='common/face/images/faces/bs2.gif' addFacesPic='[鄙视]' alt='鄙视' title='鄙视'/>").replaceAll("\\[爱你\\]","<img src='common/face/images/faces/lovea.gif' addFacesPic='[爱你]' alt='爱你' title='爱你'/>").replaceAll("\\[泪\\]","<img src='common/face/images/faces/sada.gif' addFacesPic='[泪]' alt='泪' title='泪'/>").replaceAll("\\[偷笑\\]","<img src='common/face/images/faces/heia.gif' addFacesPic='[偷笑]' alt='偷笑' title='偷笑'/>").replaceAll("\\[亲亲\\]","<img src='common/face/images/faces/qq.gif' addFacesPic='[亲亲]' alt='亲亲' title='亲亲'/>").replaceAll("\\[生病\\]","<img src='common/face/images/faces/sb.gif' addFacesPic='[生病]' alt='生病' title='生病'/>").replaceAll("\\[太开心\\]","<img src='common/face/images/faces/mb.gif' addFacesPic='[太开心]' alt='太开心' title='太开心'/>").replaceAll("\\[懒得理你\\]","<img src='common/face/images/faces/ldln.gif' addFacesPic='[懒得理你]' alt='懒得理你' title='懒得理你'/>").replaceAll("\\[右哼哼\\]","<img src='common/face/images/faces/yhh.gif' addFacesPic='[右哼哼]' alt='右哼哼' title='右哼哼'/>").replaceAll("\\[左哼哼\\]","<img src='common/face/images/faces/zhh.gif' addFacesPic='[左哼哼]' alt='左哼哼' title='左哼哼'/>").replaceAll("\\[嘘\\]","<img src='common/face/images/faces/x.gif' addFacesPic='[嘘]' alt='嘘' title='嘘'/>").replaceAll("\\[衰\\]","<img src='common/face/images/faces/cry.gif' addFacesPic='[衰]' alt='衰' title='衰'/>").replaceAll("\\[委屈\\]","<img src='common/face/images/faces/wq.gif' addFacesPic='[委屈]' alt='委屈' title='委屈'/>").replaceAll("\\[吐\\]","<img src='common/face/images/faces/t.gif' addFacesPic='[吐]' alt='吐' title='吐'/>").replaceAll("\\[打哈气\\]","<img src='common/face/images/faces/k.gif' addFacesPic='[打哈气]' alt='打哈气' title='打哈气'/>").replaceAll("\\[抱抱\\]","<img src='common/face/images/faces/bba.gif' addFacesPic='[抱抱]' alt='抱抱' title='抱抱'/>").replaceAll("\\[怒\\]","<img src='common/face/images/faces/angrya.gif' addFacesPic='[怒]' alt='怒' title='怒'/>").replaceAll("\\[疑问\\]","<img src='common/face/images/faces/yw.gif' addFacesPic='[疑问]' alt='疑问' title='疑问'/>").replaceAll("\\[馋嘴\\]","<img src='common/face/images/faces/cza.gif' addFacesPic='[馋嘴]' alt='馋嘴' title='馋嘴'/>").replaceAll("\\[拜拜\\]","<img src='common/face/images/faces/88.gif' addFacesPic='[拜拜]' alt='拜拜' title='拜拜'/>").replaceAll("\\[思考\\]","<img src='common/face/images/faces/sk.gif' addFacesPic='[思考]' alt='思考' title='思考'/>").replaceAll("\\[汗\\]","<img src='common/face/images/faces/sweata.gif' addFacesPic='[汗]' alt='汗' title='汗'/>").replaceAll("\\[困\\]","<img src='common/face/images/faces/sleepya.gif' addFacesPic='[困]' alt='困' title='困'/>").replaceAll("\\[睡觉\\]","<img src='common/face/images/faces/sleepa.gif' addFacesPic='[睡觉]' alt='睡觉' title='睡觉'/>").replaceAll("\\[钱\\]","<img src='common/face/images/faces/money.gif' addFacesPic='[钱]' alt='钱' title='钱'/>").replaceAll("\\[失望\\]","<img src='common/face/images/faces/sw.gif' addFacesPic='[失望]' alt='失望' title='失望'/>").replaceAll("\\[酷\\]","<img src='common/face/images/faces/cool.gif' addFacesPic='[酷]' alt='酷' title='酷'/>").replaceAll("\\[花心\\]","<img src='common/face/images/faces/hsa.gif' addFacesPic='[花心]' alt='花心' title='花心'/>").replaceAll("\\[哼\\]","<img src='common/face/images/faces/hatea.gif' addFacesPic='[哼]' alt='哼' title='哼'/>").replaceAll("\\[鼓掌\\]","<img src='common/face/images/faces/gza.gif' addFacesPic='[鼓掌]' alt='鼓掌' title='鼓掌'/>").replaceAll("\\[晕\\]","<img src='common/face/images/faces/dizzya.gif' addFacesPic='[晕]' alt='晕' title='晕'/>").replaceAll("\\[悲伤\\]","<img src='common/face/images/faces/bs.gif' addFacesPic='[悲伤]' alt='悲伤' title='悲伤'/>").replaceAll("\\[抓狂\\]","<img src='common/face/images/faces/crazya.gif' addFacesPic='[抓狂]' alt='抓狂' title='抓狂'/>").replaceAll("\\[黑线\\]","<img src='common/face/images/faces/h.gif' addFacesPic='[黑线]' alt='黑线' title='黑线'/>").replaceAll("\\[阴险\\]","<img src='common/face/images/faces/yx.gif' addFacesPic='[阴险]' alt='阴险' title='阴险'/>").replaceAll("\\[怒骂\\]","<img src='common/face/images/faces/nm.gif' addFacesPic='[怒骂]' alt='怒骂' title='怒骂'/>").replaceAll("\\[心\\]","<img src='common/face/images/faces/hearta.gif' addFacesPic='[心]' alt='心' title='心'/>").replaceAll("\\[伤心\\]","<img src='common/face/images/faces/unheart.gif' addFacesPic='[伤心]' alt='伤心' title='伤心'/>");
		content = content.replaceAll("\n","<br>");
		content = "<div>" + content + "</div>";
		$(this).html(content);
		}		
	})	
	//插入光标处的插件
	$.fn.extend({  
		insertContent : function(myValue, t) {  
			var $t = $(this)[0];  
			if (document.selection) {  
				this.focus();  
				var sel = document.selection.createRange();  
				sel.text = myValue;  
				this.focus();  
				sel.moveStart('character', -l);  
				var wee = sel.text.length;  
				if (arguments.length == 2) {  
				var l = $t.value.length;  
				sel.moveEnd("character", wee + t);  
				t <= 0 ? sel.moveStart("character", wee - 2 * t	- myValue.length) : sel.moveStart("character", wee - t - myValue.length);  
				sel.select();  
				}  
			} else if ($t.selectionStart || $t.selectionStart == '0') {  
				var startPos = $t.selectionStart;  
				var endPos = $t.selectionEnd;  
				var scrollTop = $t.scrollTop;  
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos,$t.value.length);  
				this.focus();  
				$t.selectionStart = startPos + myValue.length;  
				$t.selectionEnd = startPos + myValue.length;  
				$t.scrollTop = scrollTop;  
				if (arguments.length == 2) { 
					$t.setSelectionRange(startPos - t,$t.selectionEnd + t);  
					this.focus(); 
				}  
			} else {                              
				this.value += myValue;                              
				this.focus();  
			}  
		}  
	})  
});
