<%@ page language="java" import="java.util.*" pageEncoding="utf-8"%>
<%
String path = request.getContextPath(); 
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>退票理由</title>
<link href="<%=path %>/common/css/tp.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<%=path%>/common/javascript/jquery.js"></script>
	 
	<script type="text/javascript" src="<%=path%>/common/javascript/untreadReason.js"></script>
	<script type="text/javascript" src="<%=path%>/common/javascript/jquery.form.js"></script>
	<script type="text/javascript" src="<%=path%>/common/javascript/vaility.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#submit").bind("click",function() {
	var value=$('input:radio[name="untreadReason"]:checked').val();
	var untreadReasonInputval=$("#untreadReasonInput").val();
	if (value||untreadReasonInputval) {
		$("#myForm").submit();
	}else{
		alert("退票理由和自输理由至少输入一个！");
	}
		});
	
	});
	
	</script>
</head>
<body style="width: 750; height:auto; overflow-x: hidden">
<form  id="myForm">
<div id="nov_nr" style="width: 750;height: auto;">
<div class="nov_moon" style="width:750;height:auto;">
<h1><s:if test="operType == 1">退票理由</s:if><s:if test="operType == 2">发起录入理由</s:if></h1>
<div style="width:750; height:auto; float:left; margin-left:10px; padding:10px 0px 10px 0px;" class="border_bottom01">
<ul class="tp">

<s:iterator value="reasonList" var="reason">
<li><input type="radio" name="untreadReason" value='<s:property value="#reason.extFields.get('description')"/>' /><s:property value="#reason.extFields.get('description')"/></li>
</s:iterator>
</ul>
</div>
<div style="width:750; height:auto; float:left; margin-left:10px; padding:10px 0px 10px 0px;">
<table width="750" border="0" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
  
      
      <tr>
        <td colspan="4">自输理由：
          <textarea id="untreadReasonInput"  name="untreadReasonInput"  rows="3" cols="55" title="自输理由"></textarea></td>
        </tr>
    </table>

<span class="disblock2 margin_top01"><input id="submit" type="button" class="submit_but05" value="确定" />
&nbsp;&nbsp;
<input name="重置2" type="reset" class="submit_but05" value="重置" />&nbsp;&nbsp;
<input  type="button" onclick="javascript:showDialogDiv.dialog('close');" class="submit_but05" value="取消" /></span>

</div>
</div>
</div>
</form>
<input type="hidden" name="queryAction" id="queryAction" value="<s:property value='queryAction'/>"/>
<input type="hidden" name="queryForm" id="queryForm" value="<s:property value='queryForm'/>"/>
<input type="hidden" name="forwardAction" id="forwardAction" value="<s:property value='forwardAction'/>"/>
</body>
</html>