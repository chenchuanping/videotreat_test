// Parameters
//   inputID 输入框ID
//   spanID 输入框对应的span标签ID
//   typeID 校验类型 1.金额 2.消除span标签的提示信息
function inputVerify(inputID, spanID, typeID) {
	var inputObject = document.getElementById(inputID);
	var spanObject = document.getElementById(spanID);
	
	if(typeID == "1") {
		inputObject.setAttribute("onblur", "this.value=focusNoForAmount(this.value, '"+spanID+"')");
		inputObject.setAttribute("onfocus", "this.value=focusYesForAmount(this.value, '"+spanID+"')");
		inputObject.setAttribute("onkeyup", "this.value=checkContent(this.value, '"+spanID+"')");
	} else if(typeID == 2) {
		inputObject.setAttribute("onfocus", "deleteSpanNotice('"+spanID+"')");
	}
	
	
}

function focusYesForAmount(verifyData, spanID) {
	document.getElementById(spanID).style.display = "none";
	if(verifyData.length == 0) {
		return "";
	} else {
		var a1 = verifyData.replace(".","").replace(/,/g,"");
		return a1.replace(/\b(0+)/gi,"");
	}
}

function focusNoForAmount(verifyData, spanID) {
	
	var verifyData1 = verifyData.replace(/\b(0+)/gi,"");
	var dataLength = verifyData1.length;
	if(dataLength>0) {
		if(dataLength == 1) {
			return "0.0"+verifyData1;
		} else if(dataLength == 2) {
				return "0."+verifyData1;
		} else {
			var t1 = verifyData1.substr(0,verifyData1.length-2);
			var t2 = verifyData1.substr(verifyData1.length-2,2);
			var t3 = t1.split("").reverse().join("").replace(/(\d{3})/g, "$1,").split("").reverse().join("")+"."+t2;
			if(t3.substr(0,1) == ",") {
				return t3.substr(1,t3.length);
			} else {
				return t3;
			}
		}
	} else {
		return "0";
	}
}

function checkContent(verifyData, spanID) {
	return verifyData.replace(/\D/g,'');
}

function deleteSpanNotice(spanID) {
	document.getElementById(spanID).style.display = "none";
}

function accountingFormatToString (data) {
	var a1 = data.replace(".","").replace(/,/g,"");
	var a2 =  a1.replace(/\b(0+)/gi,"");
	return a2.replace(/\b(0+)/gi,"");
}