<%@ page language="java" import="java.util.*" pageEncoding="utf-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<script type="text/javascript">
$(document).ready(function (){
var taskType=$("#taskType").val();
var aa=taskType;
if (typeof(aa) == "undefined" || aa == "") {
	$("#title1").html($("title").html());
}else {
if (taskType=="cs") {
	$("#title1").html("人工初审");
}
if (taskType=="fs") {
	$("#title1").html("人工复审");
}
}
});

</script>
<div style="width:1002px; height:20px;">
<span><span style="font-size: 20px; color: red;" id="title1"></span></span><span id="workDate1">&nbsp;&nbsp;&nbsp;&nbsp;当前工作日期为：<s:property value="curWorkDate" /></span><span id="curWorkScene1">&nbsp;&nbsp;&nbsp;&nbsp;当前场次为：<s:property value="curWorkScene" /></span>
</div>
