var dataSize;
var magazieHTML = "";
var pageNo;
var pageSum = 0;
var pagecontent = "";
var trindx = 1;
var goodindex = 1;
var tabrow =1;
var noteorder=1;
var ifFirstSubmit = true;
var isGoodNull = false;

var magazie_name_hidden;
var magazie_auther_hidden;
var headpic_hidden;
var headpicsmall_hidden;
var goodDelArray = new Array();
var goodAddArray = new Array();
var addNoteList = new Array();

// ===============自动生成初始页面显示信息（加载笔记）-开始===================
function initmagazie() {
	pageNo = $("#pageNo").val();
	// alert("当前第 " + pageNo + "ye");
	var dataparm = "pageNo = " + pageNo;
	$
			.post(
					path+"/magazie_queryInit.action",
					dataparm,
					function(data) {
						dataSize = data.DATASIZE;
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
									+ "<th  style='font-size:14px;'>杂志类型</th>"
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
														+ getShowDate(magazie.Opdate)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ magazie.Optime
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getPublishstateDesc(magazie.Lancherstate)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'>"
														+ getMagtypeDesc(magazie.Magtype)
														+ "</td>"
														+ "<td style='font-size:13px; font-family: 宋体;'><img onclick='showPic("+magazie.Autoid+")' src='"
														+ magazie.Facepic
														+ "' id='headpic' style='height: 25px;width: 50px' /> "
														+ "</td>";
												    if(0==magazie.Lancherstate){
													 magazieHTML+= "<td style='font-size:13px; font-family: 宋体;width: 260px;'><input class='buttonvideotreat' type='button' value='查看'  onclick='Detail("+magazie.Autoid+")'/><input class='buttonvideotreat' type='button' value='修改'  onclick='change("+ magazie.Autoid+ ")'/><input class='buttonvideotreat' type='button' value='发布'  onclick='publishInitList("+ magazie.Autoid+ ")'/></td></tr>";
											        }else{
											        	magazieHTML+= "<td style='font-size:13px; font-family: 宋体;width: 260px;'><input class='buttonvideotreat' type='button' value='查看'  onclick='Detail("+magazie.Autoid+")'/><input class='buttonvideotreat2' type='button' value='取消发布' onclick='publishInitList("
														+ magazie.Autoid
														+ ")'/>"
														+ "</td></tr>";
											        }
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
	var magazie_type = $("#magazie_type").val();
	var magazie_starttime = $("#magazie_starttime").val();
	var magazie_endtime = $("#magazie_endtime").val();
	var magazie_auther = $("#magazie_auther").val();
	var magazie_state = $("#magazie_state").val();
	pageNo = $("#pageNo").val();
	$
			.post(
					path+"/magazie_queryByCondition.action",
					{
						"magazie_id" : magazie_id,
						"magazie_name" : magazie_name,
						"magazie_type" : magazie_type,
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
								+ "<th  style='font-size:14px;'>编辑人</th>"
								+ "<th  style='font-size:14px;'>上传日期</th>"
								+ "<th  style='font-size:14px;'>上传时间</th>"
								+ "<th  style='font-size:14px;'>发布状态</th>"
								+ "<th  style='font-size:14px;'>杂志类型</th>"
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
													+ getShowDate(magazie.Opdate)
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ magazie.Optime
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ getPublishstateDesc(magazie.Lancherstate)
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ getMagtypeDesc(magazie.Magtype)
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'><img onclick='showPic("+magazie.Autoid+")'  src='"
													+ magazie.Facepic
													+ "' id='headpic' style='height: 25px;width: 50px' /> "
													+ "</td>";
													 if(0==magazie.Lancherstate){
														 magazieHTML+= "<td style='font-size:13px; font-family: 宋体;width: 260px;'><input class='buttonvideotreat' type='button' value='查看'  onclick='Detail("+magazie.Autoid+")'/><input class='buttonvideotreat' type='button' value='修改'  onclick='change("+ magazie.Autoid+ ")'/><input class='buttonvideotreat' type='button' value='发布'  onclick='publishInitList("+ magazie.Autoid+ ")'/></td></tr>";
												        }else{
												        	magazieHTML+= "<td style='font-size:13px; font-family: 宋体;width: 260px;'><input class='buttonvideotreat' type='button' value='查看'  onclick='Detail("+magazie.Autoid+")'/><input class='buttonvideotreat2' type='button' value='取消发布' onclick='publishInitList("
															+ magazie.Autoid
															+ ")'/>"
															+ "</td></tr>";
												        }
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
			+ "<th  style='font-size:14px;'>编辑人</th>"
			+ "<th  style='font-size:14px;'>上传日期</th>"
			+ "<th  style='font-size:14px;'>上传时间</th>"
			+ "<th  style='font-size:14px;'>发布状态</th>"
			+ "<th  style='font-size:14px;'>杂志类型</th>"
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
 * 杂志保存按钮
 */
function saveMagazie() {
	var magazie_name = $("#magazie_name").val();
	var magazie_type = $("#magazie_type").val();
	var magazie_auther = $("#magazie_auther").val();
	var headpic = $("#headpic").attr("src");
	var headpicsmall = $("#headpicsmall").attr("src");
	var values_goodid = [];
	$("input[name='note_id']").each(function() {
		values_goodid.push($(this).val());
	});
	var values_goodiddata = values_goodid.join("-");
	var addNoteListdata = addNoteList.join("-");
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

	$.post(path+"/magazie_saveMagazie.action", {
		"magazie_name" : magazie_name,
		"magazie_type" : magazie_type,
		"magazie_auther" : magazie_auther,
		"headpic" : headpic,
		"headpicsmall" : headpicsmall,
		"values_goodiddata" : values_goodiddata,
		"addNoteListdata":addNoteListdata
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("保存失败！");
			return;
		}
		var magazieid = data.AUTOID;
		alert("生成的杂志ID：" + magazieid);
		var content3 = "保存成功！保存的杂志ID为：["+magazieid+"],  3秒后自动跳转到发布界面";
		TINY.box.show(content3,0,0,0,0,3);
		setTimeout(function(){
			window.location = path+"/page/admin/magzine/magazieDetail.jsp?magazieid=" + magazieid;}, 3500);
	}, "json");
}


/**
 * 发布
 */
function publishMagazie() {
	var savemagazieid = $("#savemagazieid").val();
	$.post(path+"/magazie_publishMagazie.action", {
		"savemagazieid" : savemagazieid
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("没有找到对应的杂志！");
			return;
		}
		var lancherstate = data.Lancherstate;
		if (0 == lancherstate) {
			var content3 = "取消发布成功！";
			TINY.box.show(content3,0,0,0,0,1);
			$("#button_publish").val("发布");
			$("#magazie_publishstate").val("未发布");
		} else if (1 == lancherstate) {
			var content3 = "发布成功！";
			TINY.box.show(content3,0,0,0,0,1);
			$("#button_publish").val("取消发布");
			$("#magazie_publishstate").val("已发布");
		}

	}, "json");
}

/**
 * 列表发布
 */
function publishInitList(savemagazieid) {
	$.post(path+"/magazie_publishMagazie.action", {
		"savemagazieid" : savemagazieid
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("没有找到对应的笔记！");
			return;
		}
		var lancherstate = data.Lancherstate;
		var content3;
		if (0 == lancherstate) {
			content3 = "取消发布成功！";
		} else if (1 == lancherstate) {
			content3 = "发布成功！";
		}
		TINY.box.show(content3,0,0,0,0,1);
		$("#pageNo").val(pageNo);
		queryList();

	}, "json");
}
/**
 * 修改详细页面加载方法
 */
function initUpdateMagazie(magazieid) {
	$("#savemagazieid").val(magazieid);
	$
			.post(
					path+"/magazie_initUpdate.action",
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
						var type = data.Magtype
						var auther = data.Oprator;
						var lancherState = data.Lancherstate;
						var magaziefacepic = data.Facepic;
						var magaziefacepicsmall = data.Soupic;
						$("#magazie_name").val(name);
						$("#magazie_type").val(type);
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
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							return;
						}

						var gooddata = data.DATALIST;
						var noteListHtml="";
						if (typeof (gooddata) != "undefined") {
							var goodlistShow = eval("(" + gooddata + ")");
							$
									.each(
											goodlistShow,
											function(index, good) {
												noteListHtml+= "<tr><td style='font-size:13px; font-family: 宋体;'>"
													+ good.ID
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ good.AUTHOR
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ good.NAME
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'><img onclick='showNotePic("+good.ID+")' src='"
													+ good.FACEPIC
													+ "' id='headpic' style='height: 25px;width: 50px' /> "
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ noteorder
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'><a href=javascript:void(0) onclick='Up(this,"+good.ID+");'>上移</a>&nbsp;&nbsp;&nbsp;<a href=javascript:void(0) onclick='Down(this,"+good.ID+");'>下移</a>&nbsp;&nbsp;&nbsp;<a href=javascript:void(0) onclick='Del(this,"+good.ID+");'>删除</a></td></tr>";
											    	noteorder++;
											});
						}
						$("#notelist").append(noteListHtml);
						$("#note_id").val("");
					}, "json");
}


/**
 * 修改 杂志保存按钮
 */
function updateSaveMagazie() {
	magazie_id = $("#savemagazieid").val();
	var magazie_name = $("#magazie_name").val();
	var magazie_type = $("#magazie_type").val();
	var magazie_auther = $("#magazie_auther").val();
	var headpic = $("#headpic").attr("src");
	var headpicsmall = $("#headpicsmall").attr("src");
	var values_note = getAllNote();
	var valuse_notedata = values_note.join("-");
	// var values_goodidAdddata = goodAddArray.join("-");// feiqi
	// var values_goodidDeldata = goodDelArray.join("-");
// if(isGoodNull){
// values_goodidDeldata = null;
// }
	if (!magazie_name) {
		var tip = "<input type='text' name='magazie_name' id='magazie_name' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*名称不能为空</font>";
		$("#tipname").empty();
		$("#tipname").html(tip);
		return;
	}
	if(magazie_name.length>10){
		var tip = "<input type='text' name='magazie_name' id='magazie_name' class='inputcss' style='width:150px;' onkeydown='if(event.keyCode==13) event.keyCode=9;' />&nbsp;&nbsp;<font color='red'>*不能超过10位</font>";
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
		// alert("杂志期刊号改变");
		magazie_name_state = 1;
	}
	if (!checkSameString(magazie_auther_hidden, magazie_auther)) {
		// alert("作者改变");
		magazie_auther_state = 1;
	}
	if (!checkSameString(headpic_hidden, headpic)) {
		// alert("封面图改变");
		headpic_state = 1;
	}
	if (!checkSameString(headpicsmall_hidden, headpicsmall)) {
		// alert("缩略图改变");
		headpicsmall_state = 1;
	}

	var dataparm = "magazie_id = " + magazie_id;
	$.post(path+"/magazie_updateSaveMagazie.action", {
		"magazie_id" : magazie_id,
		"magazie_name" : magazie_name,
		"magazie_type" : magazie_type,
		"magazie_auther" : magazie_auther,
		"headpic" : headpic,
		"headpicsmall" : headpicsmall,
		"magazie_name_state" : magazie_name_state,
		"magazie_auther_state" : magazie_auther_state,
		"headpic_state" : headpic_state,
		"headpicsmall_state" : headpicsmall_state,
// "values_goodidAdddata" : values_goodidAdddata,
// "values_goodidDeldata" : values_goodidDeldata,
		"valuse_notedata" :valuse_notedata
	}, function dealResult(data) {
		var isSuccess = data.ISSUCCESS;
		if (isSuccess == "FAIL" || typeof (isSuccess) == "undefined"
				|| isSuccess == null) {
			alert("修改失败！");
			values_goodidAdddata="";
			values_goodidAdddata="";
			return;
		}
		values_goodidAdddata="";
		values_goodidAdddata="";
		var content3 = "修改成功！";
		TINY.box.show(content3,0,0,0,0,1);
		setTimeout(function(){
			window.location = path+"/page/admin/magzine/magazieDetail.jsp?magazieid=" + magazie_id;}, 1300);
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
 * 新增杂志页面 笔记添加按钮
 */
function queryNote(index) {
	var ng = "#note_id" + index;
	var note_id = $(ng).val();
	if (!note_id) {
		alert("请先输入笔记ID");
		return false;
	}
	// 判断是否已经存在fff
	var values_noteidcheck = new Array();
	$("input[name='note_id']").each(function() {
		values_noteidcheck.push($(this).val());
	});
	values_noteidcheck.remove(note_id);
	var isRepeat  = false;
	for ( var int = 0; int < values_noteidcheck.length; int++) {
		  if(values_noteidcheck[int]==note_id){
			  isRepeat = true;
			  break;
		  }
	}
	if(isRepeat){
		alert("笔记重复,请重新输入需要关联的笔记ID");
		$(ng).val("");
		return;
	}
	$
			.post(
					path+"/magazie_queryGoodUrl.action",
					{
						"magazie_goodid" : note_id
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
						var temp = index + 1;

						var objtemp = document.getElementById("magazie_goodid"
								+ temp);
						if (null == objtemp) {
						} else {
							return;
						}
						var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='note_id' id='note_id"
								+ trindx
								+ "' class='inputcss'style='width:150px;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='添加笔记'onclick='queryNote("
								+ trindx
								+ ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+trindx+",1);'><input type='button' value='删除' style='width: 100px' /></a>";
						$("#goodQuery").append(tableHTML);
						// alert("bukeyong"+ng);
						$(ng).attr("disabled",true);
						goodAddArray.push(note_id);
					}, "json");
	trindx++;
}

function queryGoodUrlToUpdate(index) {
	var ng = "#note_id" + index;
	var gb = "#goodbutton"+index;
	var note_id = $(ng).val();
	if (!note_id) {
		alert("请先输入商品ID");
		return false;
	}
	var values_goodidcheck = new Array();
	$("input[name='note_id']").each(function() {
		values_goodidcheck.push($(this).val());
	});
	values_goodidcheck.remove(note_id);
	var isRepeat  = false;
	for ( var int = 0; int < values_goodidcheck.length; int++) {
		  if(values_goodidcheck[int]==note_id){
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
					path+"/magazie_queryGoodUrl.action",
					{
						"magazie_goodid" : note_id
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
						var temp = index + 1;

						var objtemp = document.getElementById("magazie_goodid"
								+ temp);
						if (null == objtemp) {
						} else {
							return;
						}
						var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='note_id' id='note_id"
								+ temp
								+ "' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' id='goodbutton"+temp+"' value='添加笔记'onclick='queryGoodUrlToUpdate("
								+ temp
								+ ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+temp+",1);'><input type='button' value='删除' style='width: 100px' /></a>";
						$("#goodQuery").append(tableHTML);
						$(ng).attr("disabled",true);
						$(gb).attr("disabled",true);
						goodAddArray.push(note_id);
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

function initDetail(magazieid){
	$("#savemagazieid").val(magazieid);
	alert(magazieid);
	$
			.post(
					path+"/magazie_initUpdate.action",
					{
						"magazieid" : magazieid
					},
					function dealResult(data) {
						var isSuccess = data.ISSUCCESS;
						alert(isSuccess);
						if (isSuccess == "FAIL"
								|| typeof (isSuccess) == "undefined"
								|| isSuccess == null) {
							alert("没有加载到对应的杂志信息，请退出重新进入！");
							return;
						}
						var name = data.Mdate;
						var type = data.Magtype;
						var auther = data.Oprator;
						var lancherState = data.Lancherstate;
						var magaziefacepic = data.Facepic;
						var magaziefacepicsmall = data.Soupic;
						$("#magazie_name").val(name);
						$("#magazie_type").val(type);
						$("#magazie_auther").val(auther);
						$("#headpic").attr("src", magaziefacepic);
						$("#headpicsmall").attr("src", magaziefacepicsmall);
						$("#magazie_name").attr("disabled",true);
						$("#magazie_type").attr("disabled",true);
						$("#magazie_auther").attr("disabled",true);
						$("#headpic").attr("disabled",true);
						$("#headpicsmall").attr("disabled",true);
						if (0 == lancherState) {
							$("#button_publish").val("发布");
							$("#magazie_publishstate").val("未发布");
						} else if (1 == lancherState) {
							$("#button_publish").val("取消发布");
							$("#magazie_publishstate").val("已发布");
						}
						var dataSize = data.DATASIZE;
						if (dataSize < 1 || typeof (dataSize) == "undefined"
								|| dataSize == null) {
							return;
						}
						var gooddata = data.DATALIST;
						if (typeof (gooddata) != "undefined") {
							var goodlistShow = eval("(" + gooddata + ")");
							var tableHTML ="";
							$
									.each(
											goodlistShow,
											function(index, good) {
												tableHTML+= "<tr><td style='font-size:13px; font-family: 宋体;'>"
													+ good.ID
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ good.AUTHOR
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ good.NAME
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'><img onclick='showNotePic("+good.ID+")' src='"
													+ good.FACEPIC
													+ "' id='headpic' style='height: 25px;width: 50px' /> "
													+ "</td>"
													+ "<td style='font-size:13px; font-family: 宋体;'>"
													+ (index+1)
													+ "</td></tr>";
											});
							$("#notelist").append(
									tableHTML);
						}

					}, "json");
}
function Detail(magazineid){
	window.location = path+"/page/admin/magzine/magazieDetail.jsp?magazieid=" + magazineid;
}
function deleteCurrentRow(obj,goodid,deltype) {
	var table = document.getElementById("goodQuery");
	var rows = table.rows.length;
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	if(rows<2){
		var valuetemp = document.getElementsByName("note_id");
		if(null==valuetemp[0].value ||""==valuetemp[0].value){
			return;
		}
		var tableHTML = "<tr><td class='goodleft'>笔记ID：</td><td class='goodright'><input type='text' name='note_id' id='note_id1' class='inputcss'style='width:150px;'onkeydown='if(event.keyCode==13) event.keyCode=9;'/>&nbsp;&nbsp;&nbsp;<input type='button' value='添加笔记'onclick='queryNote("
			+ goodindex + ")' style='width: 100px' />&nbsp;&nbsp;&nbsp;<a onclick='deleteCurrentRow(this,"+goodindex+",1);'><input type='button'value='删除' style='width: 100px' />";
		$("#goodQuery").append(tableHTML);
	}
	tbody.removeChild(tr);
	if(0==deltype){
		goodDelArray.push(goodid);
	}
}
/**
 * 增加杂志笔记
 */
function addNoteComm(){
  var note_id = $("#note_id").val();
  if (!note_id) {
		alert("请先输入笔记ID！");
		$("#note_id").val("");
		return false;
	}
  var noteidtemparray =  getAllNote();
  for ( var int = 0; int < noteidtemparray.length; int++) {
	  if(noteidtemparray[int]==note_id){
		  alert("该笔记已经添加！");
		  return ;
	  }
}
	$
			.post(
					path+"/magazie_queryGoodUrl.action",
					{
						"magazie_goodid" : note_id
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
						var id = data.ID;
						var author = data.AUTHOR;
						var name = data.NAME;
						var noteHtml = "";
						noteHtml+= "<tr><td style='font-size:13px; font-family: 宋体;'>"
								+ id
								+ "</td>"
								+ "<td style='font-size:13px; font-family: 宋体;'>"
								+ author
								+ "</td>"
								+ "<td style='font-size:13px; font-family: 宋体;'>"
								+ name
								+ "</td>"
								+ "<td style='font-size:13px; font-family: 宋体;'><img onclick='showNotePic("+id+")' src='"
								+ data.FACEPIC
								+ "' id='headpic' style='height: 25px;width: 50px' /> "
								+ "<td style='font-size:13px; font-family: 宋体;'>"
								+ noteorder
								+ "</td>"
								+ "<td style='font-size:13px; font-family: 宋体;'><a href=javascript:void(0) onclick='Up(this,"+id+");'>上移</a>&nbsp;&nbsp;&nbsp;<a href=javascript:void(0) onclick='Down(this,"+id+");'>下移</a>&nbsp;&nbsp;&nbsp;<a href=javascript:void(0) onclick='Del(this,"+id+");'>删除</a></td></tr>";
						$("#notelist").append(noteHtml);
						$("#note_id").val("");
						addNoteList.push(id);
						noteorder++;
					}, "json");
}
function getAllNote(){
	var table =document.getElementById("notelist");
	var noteidtemparray = new Array();
	   var rows = table.rows.length;
	   for ( var int = 1; int < rows; int++) {
		  var noteidtemp =  table.rows[int].cells[0].innerHTML;
		  noteidtemparray.push(noteidtemp);
	}
	   return noteidtemparray;
}

function showNotePic(autoid){
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

function showPic(magaid){
	$.post(path+"/magazie_queryNotePicUrl.action", {
		"magaid" : magaid
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

function Up(obj,id){
	var tr = $(obj).closest("tr");
	var tr2= obj.parentNode.parentNode;
	var cells = tr2.cells;
	tempOrder=0;
	tempOrder2=0;
	tr.after(tr.prev());
	
	var table =document.getElementById("notelist");
	   var rows = table.rows.length;
	   for ( var int = 1; int < rows; int++) {
		   table.rows[int].cells[4].innerText = int;
	}
}
function Down(obj,id){
	var tr = $(obj).closest("tr");
	var tr2= obj.parentNode.parentNode;
	var cells = tr2.cells;
	tempOrder=0;
	tempOrder2=0;
	tr.before(tr.next());
	var table =document.getElementById("notelist");
	   var rows = table.rows.length;
	   for ( var int = 1; int < rows; int++) {
		   table.rows[int].cells[4].innerText = int;
	}
}
function Del(obj,id){
	var tr = $(obj).closest("tr");
	var tr2= obj.parentNode.parentNode;
	var tbody = tr2.parentNode;
	tbody.removeChild(tr2);
	var table =document.getElementById("notelist");
	   var rows = table.rows.length;
	   for ( var int = 1; int < rows; int++) {
		   table.rows[int].cells[4].innerText = int;
	}
}

function getPublishstateDesc(publishstate){
	if(0==publishstate){
		return "未发布";
	}
	return "已发布";
}

function getMagtypeDesc(magtype){
	if(magtype == null || magtype == ""){
		return "未知类型";
	}
	if(magtype == 1){
		return "杂志";
	}
	if(magtype == 2){
		return "styler达人";
	}
	
}

function getShowDate(createDate){
	var str1 = createDate.substr(0,4);
	var str2 = createDate.substr(4,2);
	var str3 = createDate.substr(6,2);
	return str1+"-"+str2+"-"+str3;
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