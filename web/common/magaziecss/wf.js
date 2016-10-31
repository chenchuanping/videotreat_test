/**
 * 自定义提示框
 * 
 * @param strContent
 *            需要提示的内容
 * @param useCheck
 *            是否显示禁用选项
 * @param parentView
 *            在哪个界面进行弹出，如为空，则直接在最外层进行弹出
 */

function wfAlert(strContent, useCheck, parentView, callback) {

	message = strContent;
	if (!showAlert && useCheck) {
		return;
	}
	if (!parentView) {
		parentView = document;
	}
	lockScreen(parentView); // 锁屏
	var strTitle = "提示框";
	var msgw, msgh, bordercolor;
	msgw = 400;// 提示窗口的宽度
	msgh = 100;// 提示窗口的高度
	titleheight = 25; // 提示窗口标题高度
	// bordercolor = "#336699";// 提示窗口的边框颜色
	titlecolor = "#99CCFF";// 提示窗口的标题颜色
	var msgObj = parentView.createElement("div");
	msgObj.setAttribute("id", "msgDiv");
	msgObj.setAttribute("align", "center");
	msgObj.style.background = "white";
	// msgObj.style.border = "1px solid " + bordercolor;
	msgObj.style.position = "absolute";
	msgObj.style.left = "55%";
	msgObj.style.top = "50%";
	msgObj.style.font = "12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";
	msgObj.style.marginLeft = "-225px";
	msgObj.style.marginTop = -75 + parentView.documentElement.scrollTop + "px";
	msgObj.style.width = msgw + "px";
	msgObj.style.height = msgh + "px";
	msgObj.style.textAlign = "center";
	msgObj.style.lineHeight = "25px";
	msgObj.style.zIndex = "10051";
	var title = parentView.createElement("h4");
	title.setAttribute("id", "msgTitle");
	title.setAttribute("align", "right");
	title.style.margin = "0";
	title.style.padding = "3px";
	// title.style.background = bordercolor;
	title.style.filter = "progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";
	title.style.opacity = "0.75";
	// title.style.border = "10px solid " + bordercolor;
	title.style.height = "18px";
	title.style.font = "12px Verdana, Geneva, Arial, Helvetica, sans-serif";
	// title.style.color = "white";
	title.style.cursor = "pointer";
	title.title = "点击关闭";
	title.innerHTML = "<table border='0' width='400px' style='vertical-align:top'><tr style='vertical-align:top'><td align='left'><b>"
			+ strTitle
			+ "</b></td><td align='right'><input type='button' id='closeButton'value='关闭'  style='margin-top:-5px'/></td></tr></table></div>";
	var txt = parentView.createElement("div");
	txt.setAttribute("id", "msgTxtDiv");
	var subContent = strContent;
	if (strContent.length > 40) { // 提示语过长时只显示前40位
		subContent = strContent.substring(0, 40) + "...";
		subContent += "<a href='#' style='color:#FF0000' id='showDetail' >详情</a>";
	}
	txt.innerHTML = "<table style='width:100%'><tr style='vertical-align:top'><td id='msgTxt'>"
			+ subContent + "</td></tr></table>";

	var checkText = parentView.createElement("p");
	checkText.innerHTML = "<table border='0' width='100%'><tr><td align='left' width='5%'><input type='checkbox' id='wfCheckBox'></td><td align='left'>不再弹出提示框</td></tr></table>";
	parentView.body.appendChild(msgObj);
	msgObj.appendChild(title);
	msgObj.appendChild(txt);
	if (useCheck) {
		msgObj.appendChild(checkText);
	}
	if (parentView.getElementById("showDetail") != null) {
		parentView.getElementById("showDetail").onclick = function() {
			showMsgDetail(parentView);
		};
	}
	parentView.getElementById("closeButton").onblur = function() {
		closeBlur(parentView);

	};
	parentView.getElementById("closeButton").focus();
	parentView.getElementById("closeButton").onclick = function() {
		closeAlert(parentView, useCheck);
		if (callback) {
			callback();
		}
	};

}