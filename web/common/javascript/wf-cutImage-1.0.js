/**
 * 图像切片组件   xmlName->为图像切片的配置文件  repoertName->资源名，对应配置文件的powername属性 cutControl->切片显示控件
 */
    jQuery.fn.extend({  
    	InitCutPosition: function(opts){
    		// 获取当前容器的id
    		 var currDivId = $(this).attr("id");
            		var xmlName = opts["xmlName"];
              	  var reportName = opts["powerName"];
              	  var cutControl = opts["cutControl"];
            	  $.getJSON("imgCutDataInit.action?powerName="+reportName+"&xmlName="+xmlName, function(json){
          
            		  $("#"+currDivId).find("input").each(
            			function (i){
            				
            				//alert($("#"+currDivId).find("input")[i].attr("id"));
            				var currInput = $("#"+currDivId).find("input")[i];
            				for(var prop in json)
            					{
            					if(json[prop]["propPhysicalName"] == currInput.id)
            						{
            						// 绑定光标获取时间后进行切片处理
      							  var x = json[prop]["cutImgX"];
      							  var y = json[prop]["cutImgY"];
      							  var w = json[prop]["cutImgW"];
      							  var h = json[prop]["cutImgH"];
            						$("#"+currInput.id).bind("focus",function(){
            							  // 切片
            							  $("#"+cutControl).css("position","absolute");
            							  $("#"+cutControl).css("width","1082px");
            							  $("#"+cutControl).css("height","810px");
            							  $("#"+cutControl).css("left","-"+x+"px");
            							  $("#"+cutControl).css("top","-"+y+"px");
            							  $("#"+cutControl).css("clip","rect("+y+"px,"+(x+w)+"px,"+(y+h)+"px,"+x+"px)");
            							});
            						}
            					}
            			}	  
            		  );
            	  });
            	
            }  
          });  
 // 加载页面时光标自动聚焦到 第一个文本框
    window.onload = function() {
    	// 聚焦
    	document.getElementById("voucherNo").focus();
    	// 将内容选中
    	document.getElementById("voucherNo").select();
    };
 