var dataSize;
var magazieHTML = "";
var pageNo;
var pageSum = 0;
var pagecontent = "";
var trindx = 1;
var goodindex = 1;

var ifFirstSubmit = true;
var isGoodNull = false;

var magazie_name_hidden;
var magazie_auther_hidden;
var headpic_hidden;
var headpicsmall_hidden;
var goodDelArray = new Array();
var goodAddArray = new Array();

// ===============自动生成初始页面显示信息（加载笔记）-开始===================
function init() {
	pageNo = $("#pageNo").val();
	// alert("当前第 " + pageNo + "ye");
	var dataparm = "pageNo = " + pageNo;
	$
			.post(
					"../../../admin/magazie_queryInit.action",
					dataparm,
					function(data) {
						dataSize = data.DATASIZE;
						// alert(dataSize);
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							// alert("没有找到数据!");
							addTip();
							return;
						}
						// 生成图片列表
						var magaziedata = data.DATALIST;
						if (typeof (magaziedata) != "undefined") {
							var magazielistShow = eval("(" + magaziedata + ")");
							magazieHTML = "";
							magazieHTML += "<thead><tr><th style='border-left:none;font-size:14px; '>编号</th>"
									+ "<th  style='font-size:14px;'>期刊号</th>"
									+ "<th  style='font-size:14px;'>作者</th>"
									+ "<th  style='font-size:14px;'>上传日期</th>"
									+ "<th  style='font-size:14px;'>上传时间</th>"
									+ "<th  style='font-size:14px;'>发布状态</th>"
									+ "<th  style='font-size:14px;'>专辑封面</th>"
									+ "<th  style='font-size:14px;'>操作</th></tr></thead>";
							$
									.each(
											magazielistShow,
											function(index, magazie) {
												// alert("图片地址: " +
												// biology.Picture);
												magazieHTML += "<tr><td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Autoid
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Mdate
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Oprator
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Opdate
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Optime
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Lancherstate
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'><img src='"
														+ magazie.Facepic
														+ "' id='headpic' style='height: 25px;width: 50px' /> "
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'><input class='button' type='button' value='修改'  onclick='change("
														+ magazie.Autoid
														+ ")'/>"
														+ "</td></tr>";
											});
							$("#tasklist").empty();
							$("#tasklist").append(magazieHTML);
						}
						generatePageInfo(data);
					}, "json");
}
// ===============自动生成初始页面显示信息（加载笔记）-结束===================

function queryList() {
	$("#tasklist").empty();
	$("#taskListpagebar").empty();
	var magazie_id = $("#magazie_id").val();
	var magazie_name = $("#magazie_name").val();
	var magazie_starttime = $("#magazie_starttime").val();
	var magazie_endtime = $("#magazie_endtime").val();
	var magazie_auther = $("#magazie_auther").val();
	var magazie_state = $("#magazie_state").val();
	pageNo = $("#pageNo").val();
	$
			.post(
					"../../../admin/magazie_queryByCondition.action",
					{
						"magazie_id" : magazie_id,
						"magazie_name" : magazie_name,
						"magazie_starttime" : magazie_starttime,
						"magazie_endtime" : magazie_endtime,
						"magazie_auther" : magazie_auther,
						"magazie_state" : magazie_state,
						"pageNo" : pageNo
					},
					function dealResult(data) {
						dataSize = data.DATASIZE;
						// alert(dataSize);
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							// alert("没有找到数据!");
							addTip();
							return;
						}
						// 生成列表
						var magaziedata = data.DATALIST;
						if (typeof (magaziedata) != "undefined") {
							var magazielistShow = eval("(" + magaziedata + ")");
							magazieHTML = "";
							magazieHTML += "<thead><tr><th style='border-left:none;font-size:14px; '>编号</th>"
								+ "<th  style='font-size:14px;'>期刊号</th>"
								+ "<th  style='font-size:14px;'>作者</th>"
								+ "<th  style='font-size:14px;'>上传日期</th>"
								+ "<th  style='font-size:14px;'>上传时间</th>"
								+ "<th  style='font-size:14px;'>发布状态</th>"
								+ "<th  style='font-size:14px;'>专辑封面</th>"
								+ "<th  style='font-size:14px;'>操作</th></tr></thead>";
						$
									.each(
											magazielistShow,
											function(index, magazie) {
												magazieHTML += "<tr><td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Autoid
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Mdate
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Oprator
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Opdate
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Optime
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Lancherstate
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'><img src='"
													+ magazie.Facepic
													+ "' id='headpic' style='height: 25px;width: 50px' /> "
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'><input class='button' type='button' value='修改'  onclick='change("
													+ magazie.Autoid
													+ ")'/>"
													+ "</td></tr>";
										});
						    $("#tasklist").empty();
							$("#tasklist").append(magazieHTML);
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
			+ "<th  style='font-size:14px;'>期刊号</th>"
			+ "<th  style='font-size:14px;'>作者</th>"
			+ "<th  style='font-size:14px;'>上传日期</th>"
			+ "<th  style='font-size:14px;'>上传时间</th>"
			+ "<th  style='font-size:14px;'>发布状态</th>"
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
 * 杂志保存按钮*/
function saveMagazie() {
	var magazie_name = $("#magazie_name").val();
	var magazie_auther = $("#magazie_auther").val();
	var headpic = $("#headpic").attr("src");
	var headpicsmall = $("#headpicsmall").attr("src");
	var values_goodid = [];
	var values_goodurl = [];
	$("input[name='magazie_goodid']").each(function() {
		values_goodid.push($(this).val());
	});
	$("input[name='magazie_goodurl']").each(function() {
		values_goodurl.push($(this).val());
	});
	alert("nadao>>>" + values_goodid + "length>>>" + values_goodid.length);
	alert("nadao2>>>" + values_goodurl + "length>>>" + values_goodurl.length);
	var values_goodiddata = values_goodid.join("-");
	alert(values_goodiddata);
	if (!magazie_name) {
		var tip = "<input type='text' name='magazie_name' id='magazie_name' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*期刊号不能为空</font>";
		$("#tipname").empty();
		$("#tipname").html(tip);
		return;
	}
	if (!magazie_auther) {
		var tip = "<input type='text' name='magazie_auther' id='magazie_auther' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*作者不能为空</font>";
		$("#tipauther").empty();
		$("#tipauther").append(tip);
		return;
	}

	$.post("../../../admin/magazie_saveMagazie.action", {
		"magazie_name" : magazie_name,
		"magazie_auther" : magazie_auther,
		"headpic" : headpic,
		"headpicsmall" : headpicsmall,
		"values_goodiddata" : values_goodiddata
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("保存失败！");
			return;
		}
		var magazieid = data.AUTOID;
		alert("生成的杂志ID：" + magazieid);
		$("#savemagazieid").val(magazieid);
		$("#button_publish").attr("disabled", false);
		$("#button_save").attr("disabled", true);
	}, "json");
}


/**
 * 发布
 */
function publish() {
	var savemagazieid = $("#savemagazieid").val();
	alert(savemagazieid);
	$.post("../../../admin/magazie_publishMagazie.action", {
		"savemagazieid" : savemagazieid
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("没有找到对应的笔记！");
			return;
		}
		var lancherstate = data.Lancherstate;
		if (0 == lancherstate) {
			alert("取消发布成功！");
			$("#button_publish").val("发布");
		} else if (1 == lancherstate) {
			alert("发布成功");
			$("#button_publish").val("取消发布");
		}

	}, "json");
}

/**
 * 修改详细页面加载方法
 * */
function initUpdate(magazieid) {
	$("#savemagazieid").val(magazieid);
	$
			.post(
					"../../../admin/magazie_initUpdate.action",
					{
						"magazieid" : magazieid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有加载到对应的杂志信息，请退出重新进入！");
							return;
						}
						var name = data.Mdate;
						var auther = data.Oprator;
						var lancherState = data.Lancherstate;
						var magaziefacepic = data.Facepic;
						var magaziefacepicsmall = data.Soupic;
						$("#magazie_name").val(name);
						$("#magazie_auther").val(auther);
						$("#headpic").attr("src", magaziefacepic);
						$("#headpicsmall").attr("src", magaziefacepicsmall);
						magazie_name_hidden = name;
						magazie_auther_hidden = auther;
						headpic_hidden = magaziefacepic;
						headpicsmall_hidden = magaziefacepicsmall;
						if (0 == lancherState) {
							$("#button_publish").val("发布");
							$("#magazie_publishstate").val("未发布");
						} else if (1 == lancherState) {
							$("#button_publish").val("取消发布");
							$("#magazie_publishstate").val("已发布");
						}
						var dataSize = data.DATASIZE;
						$("#goodQuery").empty();
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							alert("没有找到相关联数据!");
							isGoodNull = true;
							var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='magazie_goodid' id='magazie_goodid1' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='magazie_goodurl'id='magazie_goodurl1' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='提交'onclick='queryGoodUrl("
									+ goodindex + ")' style='width: 100px' />";
							goodindex++;
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
												var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' value='"
														+ good.GoodId
														+ "' name='magazie_goodid' id='magazie_goodid"
														+ goodindex
														+ "' class='inputcss'style='width:150px;background-color:#EEEEEE ' readonly='readonly' onchange='' onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' value='"
														+ good.GoodUrl
														+ "' name='magazie_goodurl'id='magazie_goodurl"
														+ goodindex
														+ "' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='提交' disabled='true' readonly='readonly' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+good.GoodId+");'><input type='button' value='删除' style='width: 100px' /></a>";
												goodindex++;
												$("#goodQuery").append(
														tableHTML);
											});
							tableHTML += "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='magazie_goodid' id='magazie_goodid"+goodindex+"' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='magazie_goodurl'id='magazie_goodurl"+goodindex+"' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' id='goodbutton"+goodindex+"' value='提交'onclick='queryGoodUrlToUpdate("
								+ goodindex + ")' style='width: 100px' />";
							$("#goodQuery").append(
									tableHTML);
						}

					}, "json");
}


/**
 * 修改 杂志保存按钮*/
function updateSaveMagazie() {
	magazie_id = $("#savemagazieid").val();
	var magazie_name = $("#magazie_name").val();
	var magazie_auther = $("#magazie_auther").val();
	var headpic = $("#headpic").attr("src");
	var headpicsmall = $("#headpicsmall").attr("src");
	var values_goodidAdddata = goodAddArray.join("-");
	var values_goodidDeldata = goodDelArray.join("-");
	if(isGoodNull){
		values_goodidDeldata = null;
	}
	if (!magazie_name) {
		var tip = "<input type='text' name='magazie_name' id='magazie_name' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*名称不能为空</font>";
		$("#tipname").empty();
		$("#tipname").html(tip);
		return;
	}
	if (!magazie_auther) {
		var tip = "<input type='text' name='magazie_auther' id='magazie_auther' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*作者不能为空</font>";
		$("#tipauther").append(tip);
		return;
	}
	
	
	var magazie_name_state = 0;
	var magazie_auther_state = 0;
	var headpic_state = 0;
	var headpicsmall_state = 0;

	if (!checkSameString(magazie_name_hidden, magazie_name)) {
		alert("杂志期刊号改变");
		magazie_name_state = 1;
	}
	if (!checkSameString(magazie_auther_hidden, magazie_auther)) {
		alert("作者改变");
		magazie_auther_state = 1;
	}
	if (!checkSameString(headpic_hidden, headpic)) {
		alert("封面图改变");
		headpic_state = 1;
	}
	if (!checkSameString(headpicsmall_hidden, headpicsmall)) {
		alert("缩略图改变");
		headpicsmall_state = 1;
	}

	var dataparm = "magazie_id = " + magazie_id;
	alert(magazie_id);
	$.post("../../../admin/magazie_updateSaveMagazie.action", {
		"magazie_id" : magazie_id,
		"magazie_name" : magazie_name,
		"magazie_auther" : magazie_auther,
		"headpic" : headpic,
		"headpicsmall" : headpicsmall,
		"magazie_name_state" : magazie_name_state,
		"magazie_auther_state" : magazie_auther_state,
		"headpic_state" : headpic_state,
		"headpicsmall_state" : headpicsmall_state,
		"values_goodidAdddata" : values_goodidAdddata,
		"values_goodidDeldata" : values_goodidDeldata,
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("修改失败！");
			values_goodidAdddata="";
			values_goodidAdddata="";
			return;
		}
		alert("修改成功！");
		values_goodidAdddata="";
		values_goodidAdddata="";
		initUpdate(magazie_id);
	}, "json");
}
function checkSameString(str1, str2) {
	if (str1 == str2) {
		return true;
	} else {
		return false;
	}
}
/**
 * 新增杂志页面 笔记添加按钮*/
function queryGoodUrl(index) {
	var ng = "#magazie_goodid" + index;
	var ngurl = "#magazie_goodurl" + index;
	var magazie_goodid = $(ng).val();
	$(ngurl).val("");
	if (!magazie_goodid) {
		alert("请先输入笔记ID");
		return false;
	}
	// 判断是否已经存在fff
	var values_goodidcheck = new Array();
	$("input[name='magazie_goodid']").each(function() {
		values_goodidcheck.push($(this).val());
	});
	values_goodidcheck.remove(magazie_goodid);
	var isRepeat  = false;
	for ( var int = 0; int < values_goodidcheck.length; int++) {
		  if(values_goodidcheck[int]==magazie_goodid){
			  isRepeat = true;
			  break;
		  }
	}
	if(isRepeat){
		alert("笔记重复,请重新输入需要关联的笔记ID");
		return;
	}
	$
			.post(
					"../../../admin/magazie_queryGoodUrl.action",
					{
						"magazie_goodid" : magazie_goodid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有找到对应笔记，请确认输入已存在的ID!");
							$(ng).val("");
							return;
						}
						var goodurl = data.GOODURL;
						$(ngurl).val(goodurl);
						var temp = index + 1;

						var objtemp = document.getElementById("magazie_goodid"
								+ temp);
						if (null == objtemp) {
						} else {
							return;
						}
						var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='magazie_goodid' id='magazie_goodid"
								+ trindx
								+ "' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='magazie_goodurl'id='magazie_goodurl"
								+ trindx
								+ "' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='提交'onclick='queryGoodUrl("
								+ trindx
								+ ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+trindx+");'><input type='button' value='删除' style='width: 100px' /></a>";
						$("#goodQuery").append(tableHTML);
						$(ng).attr("disabled",true);
						goodAddArray.push(magazie_goodid);
					}, "json");
	trindx++;
}

function queryGoodUrlToUpdate(index) {
	var ng = "#magazie_goodid" + index;
	var ngurl = "#magazie_goodurl" + index;
	var gb = "#goodbutton"+index;
	var magazie_goodid = $(ng).val();
	$(ngurl).val("");
	if (!magazie_goodid) {
		alert("请先输入商品ID");
		return false;
	}
	// 判断是否已经存在fff
	var values_goodidcheck = new Array();
	$("input[name='magazie_goodid']").each(function() {
		values_goodidcheck.push($(this).val());
	});
	values_goodidcheck.remove(magazie_goodid);
	var isRepeat  = false;
	for ( var int = 0; int < values_goodidcheck.length; int++) {
		  if(values_goodidcheck[int]==magazie_goodid){
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
					"../../../admin/magazie_queryGoodUrl.action",
					{
						"magazie_goodid" : magazie_goodid
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

						var objtemp = document.getElementById("magazie_goodid"
								+ temp);
						if (null == objtemp) {
						} else {
							return;
						}
						var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='magazie_goodid' id='magazie_goodid"
								+ temp
								+ "' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='text' name='magazie_goodurl'id='magazie_goodurl"
								+ temp
								+ "' class='inputcss' value='' style='width:500px; background-color:#EEEEEE ' readonly='readonly' onkeydown='if(event.keyCode==13)event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' id='goodbutton"+temp+"' value='提交'onclick='queryGoodUrlToUpdate("
								+ temp
								+ ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+temp+");'><input type='button' value='删除' style='width: 100px' /></a>";
						$("#goodQuery").append(tableHTML);
						$(ng).attr("disabled",true);
						$(gb).attr("disabled",true);
						goodAddArray.push(magazie_goodid);
					}, "json");
	trindx++;
}
function changeCondition() {
	$("#pageNo").val("1");
}
/**
 * 生成分页信息
 * 
 */
function generatePageInfo(data) {
	pageSum = data.PAGESUM;
	$("#pageSum").val(pageSum);
	pageNo = $("#pageNo").val();
	// alert("总页数：" + pageSum + "分页查询类型 ：" + $("#pageClass").val());
	var pageInfo = "<span>总共[ " + pageSum + " ]页</span><span>当前第[ " + pageNo
			+ " ]页</span>";
	pageInfo = pageInfo + "<a href=javascript:void(0)  onclick='goToPage(0,"
			+ pageNo + ")'>[&nbsp;&nbsp;首页&nbsp;&nbsp;]</a>";
	// 如果当前页为首页时，上一页不可点击
	if (pageNo == 1) {
		pageInfo = pageInfo + "  <a >[&nbsp;&nbsp;上一页&nbsp;&nbsp;]</a> ";
	} else {
		pageInfo = pageInfo
				+ "  <a href=javascript:void(0) onclick='goToPage(1," + pageNo
				+ ")'>[&nbsp;&nbsp;上一页&nbsp;&nbsp;]</a> ";
	}
	// 如果当前页等于总页数，则下一页不可点击
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
	// alert("分页查询");
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

function deleteCurrentRow(obj,goodid) {
	alert("obj=="+obj);
	var table = document.getElementById("goodQuery");
	var rows = table.rows.length;
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	goodDelArray.push(goodid);
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