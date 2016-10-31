/***-------校验是否是数字----------***/
function isNumber(str)
   {
	var array=str.split(",");
	for(var i=0;i<array.length;i++){
		var id=array[i];
	var jq="#"+id;
	var idVal=$(jq).val();
	var tip=$(jq).attr("title");
  var strP=/^\d+(\.\d+)?$/;
  if(!strP.test(idVal)){
	  alert(tip+"不是数字！");
	  return false;
  }
  try{
  if(parseFloat(idVal)!=idVal){
	  alert(tip+"不是数字！");
	  return false;  
  }
  }
  catch(ex)
  {
	alert(tip+"不是数字！");
   return false;
  }
  }
	return true;
   }

/***-------校验是否是中文----------***/
function isChinese(str)
{
	var array=str.split(",");
	for(var i=0;i<array.length;i++){
		var id=array[i];
		var jq="#"+id;
		var idVal=$(jq).val();
	var reg = /^[\u4e00-\u9fa5]+$/i; 
	if (!reg.test(idVal)) 
	{
	alert("请输入中文!"); 
	return false; 
	}
	}
	return true;
}

/***-------校验是否是为空----------***/
function isNull(str){
	var array=str.split(",");
	for(var i=0;i<array.length;i++){
		var id=array[i];
		var jq="#"+id;
		var idVal=$(jq).val();
		if(!idVal){
			var tip=$(jq).attr("title");
			alert(tip+"不能为空！");
			return true;
		}
	}
	return false;
}

