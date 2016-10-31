function focusYes(data) {
	if(data.length == 0) {
		return "";
	} else {
		var a1 = data.replace(".","").replace(/,/g,"");
		return a1.replace(/\b(0+)/gi,"");
	}
}

function focusNo(data) {
	var dataLength = data.length;
	if(dataLength>0) {
		if(dataLength == 1) {
			return "0.0"+data;
		} else {
			var first = data.substr(0, 1);
			if(first == 0) {
				return data;
			} else {
				if(dataLength == 2) {
				return "0."+data;
				} else {
					var t1 = data.substr(0,data.length-2);
					var t2 = data.substr(data.length-2,2);
					var t3 = t1.split("").reverse().join("").replace(/(\d{3})/g, "$1,").split("").reverse().join("")+"."+t2;
					if(t3.substr(0,1) == ",") {
						return t3.substr(1,t3.length);
					} else {
						return t3;
					}
				}
			}
		}
	} else {
		return "";
	}
}

function checkContent(data){
	return data.replace(/\D/g,'');
}