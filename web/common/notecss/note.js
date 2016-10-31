var dataSize;
var noteHTML = "";
var pageNo;
var pageSum = 0;
var pagecontent = "";
var trindx = 1;
var ifFirstSubmit = true;
var isGoodNull = false;
var note_name_hidden;
var note_auther_hidden;
var headpic_hidden;
var headpicsmall_hidden;
var detail_acontent_hidden;
var note_realbrowse_hidden;
var goodindex = 1;
var goodDelArray = new Array();
var goodAddArray = new Array();
// ===============自动生成初始页面显示信息（加载笔记）-开始===================
function init() {
	pageNo = $("#pageNo").val();
	var dataparm = "pageNo = " + pageNo;
	$
			.post(
					path+"/note_queryInit.action",
					dataparm,
					function(data) {
						dataSize = data.DATASIZE;
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							addTip();
							return;
						}
						// 生成图片列表
						var notedata = data.DATALIST;
						if (typeof (notedata) != "undefined") {
							var notelistShow = eval("(" + notedata + ")");
							noteHTML = "";
							noteHTML += "<thead><tr><th style='border-left:none;font-size:14px; '>编号</th>"
									+ "<th  style='font-size:14px;'>笔记名称</th>"
									+ "<th  style='font-size:14px;'>作者</th>"
									+ "<th  style='font-size:14px;'>上传日期</th>"
									+ "<th  style='font-size:14px;'>上传时间</th>"
									+ "<th  style='font-size:14px;'>发布状态</th>"
									+ "<th  style='font-size:14px;'>笔记类型</th>"
									+ "<th  style='font-size:14px;'>静态页面地址</th>"
									+ "<th  style='font-size:14px;'>专辑封面</th>"
									+ "<th  style='font-size:14px;'>操作</th></tr></thead>";
							$
									.each(
											notelistShow,
											function(index, note) {
												noteHTML += "<tr><td style='font-size:13px; font-family: 宋体;'>"
														+ note.Autoid
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ note.Name
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ note.Author
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getShowDate(note.Createdate)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ note.Createtime
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getPublishstateDesc(note.Publishstate)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getNotetypeDesc(note.notetype)
														+ "</td>"
														+ "<td style='font-size:10px; font-family: 宋体;'>"
														+ note.htmlurl
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'><a href='javascript:void(0)' onclick='showPic("+note.Autoid+")'><img src='"
														+ note.Notefacepic
														+ "' id='headpic' style='height: 25px;width: 50px' /></a>"
														+ "</td>";
												        if(0==note.Publishstate){
												        	noteHTML+= "<td style='font-size:13px; font-family: 宋体; width: 220px;'><input class='button' type='button' value='修改' onclick='change("
															+ note.Autoid
															+ ")'/><input class='button' type='button' value='发布'  onclick='publishInitList("
															+ note.Autoid+","+note.Publishstate
															+ ")'/>"
															+ "</td></tr>";
												        }else{
												        	noteHTML+="<td style='font-size:13px; font-family: 宋体;'><input class='button' type='button' value='取消发布' ondblclick='doubleclick()'  onclick='publishInitList("
															+ note.Autoid+","+note.Publishstate
															+ ")'/>"
															+ "</td></tr>";
												        }
											});
							$("#tasklist").empty();
							$("#tasklist").append(noteHTML);
						}
						generatePageInfo(data);
					}, "json");
}
// ===============自动生成初始页面显示信息（加载笔记）-结束===================

function queryList() {
	$("#tasklist").empty();
	$("#taskListpagebar").empty();
	var note_id = $("#note_id").val();
	var note_name = $("#note_name").val();
	var note_type = $("#note_type").val();
	var note_starttime = $("#note_starttime").val();
	var note_endtime = $("#note_endtime").val();
	var note_auther = $("#note_auther").val();
	var note_state = $("#note_state").val();
	pageNo = $("#pageNo").val();
	$
			.post(
					path+"/note_queryByCondition.action",
					{
						"note_id" : note_id,
						"note_name" : note_name,
						"note_type" : note_type,
						"note_starttime" : note_starttime,
						"note_endtime" : note_endtime,
						"note_auther" : note_auther,
						"note_state" : note_state,
						"pageNo" : pageNo
					},
					function dealResult(data) {

						dataSize = data.DATASIZE;
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							addTip();
							return;
						}
						// 生成列表
						var notedata = data.DATALIST;
						if (typeof (notedata) != "undefined") {
							var notelistShow = eval("(" + notedata + ")");
							noteHTML = "";
							noteHTML += "<thead><tr><th style='border-left:none;font-size:14px; '>编号</th>"
									+ "<th  style='font-size:14px;'>笔记名称</th>"
									+ "<th  style='font-size:14px;'>作者</th>"
									+ "<th  style='font-size:14px;'>上传日期</th>"
									+ "<th  style='font-size:14px;'>上传时间</th>"
									+ "<th  style='font-size:14px;'>发布状态</th>"
									+ "<th  style='font-size:14px;'>笔记类型</th>"
									+ "<th  style='font-size:14px;'>静态页面地址</th>"
									+ "<th  style='font-size:14px;'>专辑封面</th>"
									+ "<th  style='font-size:14px;'>操作</th></tr></thead>";
							$
									.each(
											notelistShow,
											function(index, note) {
												noteHTML += "<tr><td style='font-size:13px; font-family: 宋体;'>"
														+ note.Autoid
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ note.Name
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ note.Author
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getShowDate(note.Createdate)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ note.Createtime
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getPublishstateDesc(note.Publishstate)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getNotetypeDesc(note.notetype)
														+ "</td>"
														+ "<td style='font-size:10px; font-family: 宋体;'>"
														+ note.htmlurl
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'><a href='javascript:void(0)' onclick='showPic("+note.Autoid+")'><img src='"
														+ note.Notefacepic
														+ "' id='headpic' style='height: 25px;width: 50px' /></a> "
														+ "</td>";
														  if(0==note.Publishstate){
													        	noteHTML+= "<td style='font-size:13px; font-family: 宋体; width: 220px;'><input class='button' type='button' value='修改' onclick='change("
																+ note.Autoid
																+ ")'/><input class='button' type='button' value='发布'  onclick='publishInitList("
																+ note.Autoid+","+note.Publishstate
																+ ")'/>"
																+ "</td></tr>";
													        }else{
													        	noteHTML+="<td style='font-size:13px; font-family: 宋体;'><input class='button' type='button' value='取消发布'  onclick='publishInitList("
																+ note.Autoid+","+note.Publishstate
																+ ")'/>"
																+ "</td></tr>";
													        }
											});
							$("#tasklist").append(noteHTML);
						}
						generatePageInfo(data);
					}, "json");

}

function changeCondition() {
	$("#pageNo").val("1");
}
/*
 * 没有查询到数据时，提示信息
 */
function addTip() {
	var listHTML = "<thead><tr><th style='border-left:none;font-size:14px; '>编号</th>"
			+ "<th  style='font-size:14px;'>笔记名称</th>"
			+ "<th  style='font-size:14px;'>作者</th>"
			+ "<th  style='font-size:14px;'>上传日期</th>"
			+ "<th  style='font-size:14px;'>上传时间</th>"
			+ "<th  style='font-size:14px;'>发布状态</th>"
			+ "<th  style='font-size:14px;'>笔记类型</th>"
			+ "<th  style='font-size:14px;'>静态页面地址</th>"
			+ "<th  style='font-size:14px;'>专辑封面</th>"
			+ "<th  style='font-size:14px;'>操作</th></tr></thead>";
	listHTML += "<tr><td colspan='11'  style='text-align: left; color:red;font-size:14px;'>无符合该查询条件数据</td></tr>";
	$("#tasklist").append(listHTML);
	pagecontent = "";
	pagecontent += "<span>总共[ 0 ]页</span><span>当前第[ 0 ]页</span><a>[&nbsp;&nbsp;首页&nbsp;&nbsp;]</a><a>[&nbsp;&nbsp;上一页&nbsp;&nbsp;]</a><a>[&nbsp;&nbsp;下一页&nbsp;&nbsp;]</a>"
			+ "<a>[&nbsp;&nbsp;末页&nbsp;&nbsp;]</a><div class='clear'></div>";
	$("#taskListpagebar").html(pagecontent);
}

/**
 * 生成分页信息
 * 
 */
function generatePageInfo(data) {
	pageSum = data.PAGESUM;
	$("#pageSum").val(pageSum);
	pageNo = $("#pageNo").val();
	var pageInfo = "<span>总共[ " + pageSum + " ]页</span><span>当前第[ " + pageNo
			+ " ]页</span>";
	pageInfo = pageInfo + "<a href=javascript:void(0)  onclick='goToPage(0,"
			+ pageNo + ")'>[&nbsp;&nbsp;首页&nbsp;&nbsp;]</a>";
	if (pageNo == 1) {
		pageInfo = pageInfo + "  <a >[&nbsp;&nbsp;上一页&nbsp;&nbsp;]</a> ";
	} else {
		pageInfo = pageInfo
				+ "  <a href=javascript:void(0) onclick='goToPage(1," + pageNo
				+ ")'>[&nbsp;&nbsp;上一页&nbsp;&nbsp;]</a> ";
	}
	if (pageNo == pageSum) {
		pageInfo = pageInfo + "  <a>[&nbsp;&nbsp;下一页&nbsp;&nbsp;]</a>";
	} else {
		pageInfo = pageInfo
				+ "  <a href=javascript:void(0) onclick='goToPage(2," + pageNo
				+ ")'>[&nbsp;&nbsp;下一页&nbsp;&nbsp;]</a>";
	}
	pageInfo = pageInfo + "<a href=javascript:void(0) onclick='goToPage(3,"
			+ pageNo + ")'>[&nbsp;&nbsp;末页&nbsp;&nbsp;]</a>";
	$("#taskListpagebar").empty();
	$("#taskListpagebar").append(pageInfo);
}
/**
 * 分页跳转
 * 
 */
function goToPage(type, pageNo) {
	// 上一页
	if (type == 1) {
		if (pageNo > 1) {
			pageNo = pageNo - 1;
		}
	} else if (type == 2) {
		// 下一页
		if (pageNo < pageSum) {
			pageNo = pageNo + 1;
		}
	} else if (type == 0) {
		if (pageNo == 1) {
			// alert("已经是第一页!");
			return;
		}
		pageNo = 1;
	} else {
		if (pageNo == pageSum) {
			// alert("已经是最后一页！");
			return;
		}
		pageNo = pageSum;
	}
	$("#pageNo").val(pageNo);
	queryList();
}

function queryGoodUrl(index) {
	var ng = "#note_goodid" + index;
	var ngurl = "#note_goodurl" + index;
	var gb = "#goodbutton"+index;
	var note_goodid = $(ng).val();
	$(ngurl).val("");
	if (!note_goodid) {
		alert("请先输入商品ID");
		return false;
	}
	var values_goodidcheck = new Array();
	$("input[name='note_goodid']").each(function() {
		values_goodidcheck.push($(this).val());
	});
	values_goodidcheck.remove(note_goodid);
	var isRepeat  = false;
	for ( var int = 0; int < values_goodidcheck.length; int++) {
		  if(values_goodidcheck[int]==note_goodid){
			  isRepeat = true;
			  break;
		  }
	}
	if(isRepeat){
		alert("商品重复,请重新输入需要关联的商品ID");
		return;
	}
	$
			.post(
					path+"/note_queryGoodUrl.action",
					{
						"note_goodid" : note_goodid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有找到对应商品，请确认输入已存在的ID!");
							$(ng).val("");
							return;
						}
						var goodurl = data.GOODURL;
						$(ngurl).val(goodurl);
						var temp = index + 1;
						
						var objtemp = document.getElementById("note_goodid"
								+ temp);
						if (null == objtemp) {
						} else {
							return;
						}
						
						var tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' name='note_goodid' id='note_goodid"
								+ goodindex
								+ "' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='note_goodurl'id='note_goodurl"
								+ goodindex
								+ "' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' id='goodbutton"+goodindex+"'value='提交'onclick='queryGoodUrl("
								+ goodindex                                     
								+ ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+goodindex+",1);'><input type='button' value='删除' style='width: 100px' /></a>";
						$("#goodQuery").append(tableHTML);
						$(ng).attr("disabled",true);
						$(gb).attr("disabled",true);
					}, "json");
	goodindex++;
}

function queryGoodUrlToUpdate(index) {
	var ng = "#note_goodid" + index;
	var ngurl = "#note_goodurl" + index;
	var gb = "#goodbutton"+index;
	var note_goodid = $(ng).val();
	$(ngurl).val("");
	if (!note_goodid) {
		alert("请先输入商品ID");
		return false;
	}
	var values_goodidcheck = new Array();
	$("input[name='note_goodid']").each(function() {
		values_goodidcheck.push($(this).val());
	});
	values_goodidcheck.remove(note_goodid);
	var isRepeat  = false;
	for ( var int = 0; int < values_goodidcheck.length; int++) {
		  if(values_goodidcheck[int]==note_goodid){
			  isRepeat = true;
			  break;
		  }
	}
	if(isRepeat){
		alert("商品重复,请重新输入需要关联的商品ID");
		$(ng).val("");
		return;
	}
	$
			.post(
					path+"/note_queryGoodUrl.action",
					{
						"note_goodid" : note_goodid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有找到对应商品，请确认输入已存在的ID!");
							$(ng).val("");
							return;
						}
						var goodurl = data.GOODURL;
						$(ngurl).val(goodurl);
						var temp = index + 1;
						var objtemp = document.getElementById("note_goodid"
								+ temp);
						if (null == objtemp) {
							
						} else {
							return;
						}
						var tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' name='note_goodid' id='note_goodid"
								+ temp
								+ "' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='note_goodurl'id='note_goodurl"
								+ temp
								+ "' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' id='goodbutton"+temp+"' value='提交'onclick='queryGoodUrlToUpdate("
								+ temp
								+ ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+temp+");'><input type='button' value='删除' style='width: 100px' /></a>";
						$("#goodQuery").append(tableHTML);
						$(ng).attr("disabled",true);
						$(gb).attr("disabled",true);
					}, "json");
	trindx++;
}
function saveNote() {
	$("#button_save").attr("disabled",true);
	var note_name = $("#note_name").val();
	var note_auther = $("#note_auther").val();
	var headpic = $("#headpic").attr("src");
	var headpicsmall = $("#headpicsmall").attr("src");
	var detail_acontent = $("#detail_acontent").val();
	var virtualbrowse = $("#note_virtualbrowse").val();
	var values_goodid = [];
	var values_goodurl = [];
	$("input[name='note_goodid']").each(function() {
		values_goodid.push($(this).val());
	});
	$("input[name='note_goodurl']").each(function() {
		values_goodurl.push($(this).val());
	});
	var values_goodiddata = values_goodid.join("-");
	if (!note_name) {
		var tip = "<input type='text' name='note_name' id='note_name' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*名称不能为空</font>";
		$("#tipname").empty();
		$("#tipname").html(tip);
		return;
	}
	if (!note_auther) {
		var tip = "<input type='text' name='note_auther' id='note_auther' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*作者不能为空</font>";
		$("#tipauther").append(tip);
		return;
	}
	detail_acontent = escape(escape(detail_acontent));
	$.post(path+"/note_saveNote.action", {
		"note_name" : note_name,
		"note_auther" : note_auther,
		"headpic" : headpic,
		"headpicsmall" : headpicsmall,
		"detail_acontent" : detail_acontent,
		"virtualbrowse" : virtualbrowse,
		"values_goodiddata" : values_goodiddata
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			// alert("保存失败！");
			$("#addReturnTip").html("<B>保存失败！</B>");
			$("#addReturnTip").show();
			return;
		}
		var noteid = data.AUTOID;
		var content3 = "保存成功！保存的笔记ID为：["+noteid+"],  3秒后自动跳转到发布界面";
		TINY.box.show(content3,0,0,0,0,3);
		setTimeout(function(){
			window.location = path+"/page/admin/note/publishNote.jsp?noteid=" + noteid;}, 3500);
		
	}, "json");
}
function publishInitList(noteid,state) {
	var confirmdesc = "取消发布";
	if(0==state){
		confirmdesc = "发布";
	}
	if (confirm("确认要"+confirmdesc+"？")) {
        
     }else{
    	 return;
     }
	$.post(path+"/note_publishNote.action", {
		"savenoteid" : noteid
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("没有找到对应的笔记！");
			return;
		}
		var publishState = data.PUBLISHSTATE;
		var content3;
		if (0 == publishState) {
			$("#button_publish").val("发布");
			content3 = "取消发布成功！";
		} else if (1 == publishState) {
			$("#button_publish").val("取消发布");
			content3 = "发布成功！";
		}
		TINY.box.show(content3,0,0,0,0,1);
		$("#pageNo").val(pageNo);
		queryList();
	}, "json");
}

function publish(noteid) {
	// var savenoteid = $("#savenoteid").val();
	savenoteid = noteid;
	$.post(path+"/note_publishNote.action", {
		"savenoteid" : savenoteid
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("没有找到对应的笔记！");
			return;
		}
		var publishState = data.PUBLISHSTATE;
		if (0 == publishState) {
			var content3 = "取消发布成功！";
			TINY.box.show(content3,0,0,0,0,1);
			$("#button_publish").val("发布");
		} else if (1 == publishState) {
			var content3 = "发布成功！";
			TINY.box.show(content3,0,0,0,0,1);
			$("#button_publish").val("取消发布");
		}

	}, "json");
}

function initUpdate(noteid) {
	$("#savenoteid").val(noteid);
	$
			.post(
					path+"/note_initUpdate.action",
					{
						"noteid" : noteid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有加载到对应的笔记信息，请退出重新进入！");
							return;
						}
						var notedesc = data.NOTEDESC;
						var name = data.NAME;
						var notetype = data.NOTETYPE;
						var auther = data.AUTHER;
						var publishState = data.PUBLISHSTATE;
						var notefacepic = data.NOTEFACEPIC;
						var notefacepicsmall = data.NOTEFACEPICSMALL;
						var virtualbrowse = data.VIRTUALBROWSE;
						$("#note_name").val(name);
						$("#note_type").val(notetype);
						$("#note_auther").val(auther);
						$("#note_virtualbrowse").val(virtualbrowse);
						$("#headpic").attr("src", notefacepic);
						$("#headpicsmall").attr("src", notefacepicsmall);
						$("#detail_acontent").val(notedesc);
						note_name_hidden = name;
						note_auther_hidden = auther;
						headpic_hidden = notefacepic;
						headpicsmall_hidden = notefacepicsmall;
						detail_acontent_hidden = notedesc;
						note_realbrowse_hidden = virtualbrowse;
						KindEditor.html('#detail_acontent', notedesc);
						if (0 == publishState) {
							$("#button_publish").val("发布");
							$("#note_publishstate").val("未发布");
						} else if (1 == publishState) {
							$("#button_publish").val("取消发布");
							$("#note_publishstate").val("已发布");
						}
						var dataSize = data.DATASIZE;
						$("#goodQuery").empty();
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							// alert("没有找到相关联数据!");
							isGoodNull = true;
							var tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' name='note_goodid' id='note_goodid1' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='note_goodurl'id='note_goodurl1' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='提交'onclick='queryGoodUrl(1)' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this);'><input type='button'value='删除' style='width: 100px' />";
							$("#goodQuery").append(tableHTML);
							return;
						}

						var gooddata = data.DATALIST;
						if (typeof (gooddata) != "undefined") {
							var goodlistShow = eval("(" + gooddata + ")");
							$
									.each(
											goodlistShow,
											function(index, good) {
												tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' value='"
														+ good.GoodId
														+ "' name='note_goodid"+goodindex+"' id='note_goodid"
														+ goodindex
														+ "' class='inputcss'style='width:150px;background-color:#EEEEEE ' readonly='readonly' onchange='' onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' value='"
														+ good.GoodUrl
														+ "' name='note_goodurl'id='note_goodurl"
														+ goodindex
														+ "' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='提交' disabled='true' readonly='readonly' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+good.GoodId+",0);'><input type='button' value='删除' style='width: 100px' /></a>";
												goodindex++;
												$("#goodQuery").append(
														tableHTML);
											});
							tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' name='note_goodid' id='note_goodid"+goodindex+"' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='note_goodurl'id='note_goodurl"+goodindex+"' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' id='goodbutton"+goodindex+"' value='提交'onclick='queryGoodUrl("
								+ goodindex + ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+goodindex+",1);'><input type='button'value='删除' style='width: 100px' /></a>";
							$("#goodQuery").append(
									tableHTML);
						}

					}, "json");
}
function initPublish(noteid){

	$("#savenoteid").val(noteid);
	$
			.post(
					path+"/note_initUpdate.action",
					{
						"noteid" : noteid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有加载到对应的笔记信息，请退出重新进入！");
							return;
						}
						var notedesc = data.NOTEDESC;
						var name = data.NAME;
						var notetype = data.NOTETYPE;
						var auther = data.AUTHER;
						var publishState = data.PUBLISHSTATE;
						var notefacepic = data.NOTEFACEPIC;
						var notefacepicsmall = data.NOTEFACEPICSMALL;
						var virtualbrowse = data.VIRTUALBROWSE;
						$("#note_name").val(name);
						$("#note_type").val(notetype);
						$("#note_auther").val(auther);
						$("#note_virtualbrowse").val(virtualbrowse);
						$("#headpic").attr("src", notefacepic);
						$("#headpicsmall").attr("src", notefacepicsmall);
						$("#note_content").append(notedesc);
						setDisable();
						note_name_hidden = name;
						note_auther_hidden = auther;
						headpic_hidden = notefacepic;
						headpicsmall_hidden = notefacepicsmall;
						detail_acontent_hidden = notedesc;
						note_realbrowse_hidden = virtualbrowse;
						KindEditor.html('#detail_acontent', notedesc);
						if (0 == publishState) {
							$("#button_publish").val("发布");
							$("#note_publishstate").val("未发布");
						} else if (1 == publishState) {
							$("#button_publish").val("取消发布");
							$("#note_publishstate").val("已发布");
						}
						var dataSize = data.DATASIZE;
						$("#goodQuery").empty();
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							// alert("没有找到相关联数据!");
							isGoodNull = true;
							var tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' name='note_goodid' id='note_goodid1' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='note_goodurl'id='note_goodurl1' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;";
							$("#goodQuery").append(tableHTML);
							return;
						}

						var gooddata = data.DATALIST;
						if (typeof (gooddata) != "undefined") {
							var goodlistShow = eval("(" + gooddata + ")");
							$
							.each(
									goodlistShow,
									function(index, good) {
										var tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' value='"
												+ good.GoodId
												+ "' name='note_goodid' id='note_goodid' class='inputcss'style='width:150px;background-color:#EEEEEE ' readonly='readonly' onchange='' onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' value='"
												+ good.GoodUrl
												+ "' name='note_goodurl'id='note_goodurl' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;";
										$("#goodQuery").append(
												tableHTML);
									});
						}

					}, "json");

}
function setDisable(){
	$("#note_name").attr("disabled",true);
	$("#note_type").attr("disabled",true);
	$("#note_auther").attr("disabled",true);
	$("#note_virtualbrowse").attr("disabled",true);
	$("#note_acontent").attr("disabled",true);
}
function updateSaveNote() {
	note_id = $("#savenoteid").val();
	var note_name = $("#note_name").val();
	var note_type = $("#note_type").val();
	var note_auther = $("#note_auther").val();
	var headpic = $("#headpic").attr("src");
	var headpicsmall = $("#headpicsmall").attr("src");
	var detail_acontent = $("#detail_acontent").val();
	var note_realbrowse = $("#note_virtualbrowse").val();
	goodAddArray = new Array();
		$("input[name='note_goodid']").each(function() {
			goodAddArray.push($(this).val());
		});
	var values_goodidAdddata = goodAddArray.join("-");
	var values_goodidDeldata = goodDelArray.join("-");
	if(isGoodNull){
		values_goodidDeldata = null;
	}
	if (!note_name) {
		var tip = "<input type='text' name='note_name' id='note_name' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*名称不能为空</font>";
		$("#tipname").empty();
		$("#tipname").html(tip);
		return;
	}
	if (!note_auther) {
		var tip = "<input type='text' name='note_auther' id='note_auther' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*作者不能为空</font>";
		$("#tipauther").append(tip);
		return;
	}
	if (!note_realbrowse) {
		var tip = "<input type='text' name='note_realbrowse' id='note_realbrowse' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*浏览量不能为空</font>";
		$("#tiprealbrowse").empty();
		$("#tiprealbrowse").html(tip);
		return;
	}
	var note_name_state = 0;
	var note_auther_state = 0;
	var headpic_state = 0;
	var headpicsmall_state = 0;
	var detail_acontent_state = 0;
	var note_realbrowse_state = 0;

	if (!checkSameString(note_name_hidden, note_name)) {
		// alert("笔记名称改变");
		note_name_state = 1;
	}
	if (!checkSameString(note_auther_hidden, note_auther)) {
		// alert("笔记作者改变");
		note_auther_state = 1;
	}
	if (!checkSameString(headpic_hidden, headpic)) {
		// alert("封面图改变");
		headpic_state = 1;
	}
	if (!checkSameString(headpicsmall_hidden, headpicsmall)) {
		// alert("缩略图改变");
		headpicsmall_state = 1;
	}
	if (!checkSameString(note_realbrowse_hidden, note_realbrowse)) {
		// ("实际浏览量改变");
		note_realbrowse_state = 1;
	}
	if (!checkSameString(detail_acontent_hidden, detail_acontent)) {
		// alert("笔记内容改变");
		detail_acontent_state = 1;
	}
	detail_acontent = escape(escape(detail_acontent));
	var dataparm = "note_id = " + note_id;
	$.post(path+"/note_updateSaveNote.action", {
		"note_id" : note_id,
		"note_name" : note_name,
		"note_type" : note_type,
		"note_auther" : note_auther,
		"note_virtualbrowse" : note_realbrowse,
		"headpic" : headpic,
		"headpicsmall" : headpicsmall,
		"detail_acontent" : detail_acontent,
		"note_name_state" : note_name_state,
		"note_auther_state" : note_auther_state,
		"headpic_state" : headpic_state,
		"headpicsmall_state" : headpicsmall_state,
		"note_realbrowse_state" : note_realbrowse_state,
		"detail_acontent_state" : detail_acontent_state,
		"values_goodidAdddata" : values_goodidAdddata,
		"values_goodidDeldata" : values_goodidDeldata,
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("修改失败！");
			values_goodidAdddata="";
			values_goodidDeldata="";
			return;
		}
		var content3 = "修改成功！";
		TINY.box.show(content3,0,0,0,0,1);
		setTimeout(function(){
			window.location = path+"/page/admin/note/publishNote.jsp?noteid=" + noteid;}, 1300);
	}, "json");
}
function checkSameString(str1, str2) {
	if (str1 == str2) {
		return true;
	} else {
		return false;
	}
}
function deleteCurrentRow(obj,goodid,type) {
	var table = document.getElementById("goodQuery");
	var rows = table.rows.length;
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	if(rows<2){
		var tableHTML = "<tr><td class='goodleft'>商品ID：</td><td class='goodright'><input type='text' name='note_goodid' id='note_goodid1' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='note_goodurl'id='note_goodurl1' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='提交'onclick='queryGoodUrl(1)' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+goodindex+",1);'><input type='button'value='删除' style='width: 100px' />";
	$("#goodQuery").append(tableHTML);
	}
	if(0==type){
		goodDelArray.push(goodid);
	}
}
function getPublishstateDesc(publishstate){
	if(0==publishstate){
		return "未发布";
	}
	return "已发布";
}
function getNotetypeDesc(notetype){
	if(notetype == null || notetype == ""){
		return "未知类型";
	}
	if(notetype == 1){
		return "活动";
	}
	if(notetype == 2){
		return "专辑";
	}
	if(notetype == 3){
		return "笔记";
	}
	
}

function getShowDate(createDate){
	var str1 = createDate.substr(0,4);
	var str2 = createDate.substr(4,2);
	var str3 = createDate.substr(6,2);
	return str1+"-"+str2+"-"+str3;
}
function showPic(autoid){
	$.post(path+"/note_queryNotePicUrl.action", {
		"note_id" : autoid
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			 var content2 = "<img src='"+path+"/common/notecss/nopic.jpg' width='600' height='480' alt='' />";
		}else{
			 var content2 = "<img src='"+data.PICURL+"' width='600' height='480' alt='' />";
		}
		 TINY.box.show(content2,0,0,0,1);
	}, "json");
}
function doubleclick(){
}
function pageScroll() { 
	window.scroll(0,0); 
	scrolldelay = setTimeout('pageScroll()',100); 
	if(document.documentElement.scrollTop==0) clearTimeout(scrolldelay);
	} 

Array.prototype.indexOf = function(val) {              
    for (var i = 0; i < this.length; i++) {  
        if (this[i] == val) return i;  
    }  
    return -1;  
};  
Array.prototype.remove = function(val) {  
    var index = this.indexOf(val);  
    if (index > -1) {  
        this.splice(index, 1);  
    }  
};  