//控制长度 同时在文本框中添加
//onpropertychange="checkLength(this,200);"
//oninput="checkLength(this,200);"
function checkLength(obj, maxlength) {
	if (obj.value.length > maxlength) {
		obj.value = obj.value.substring(0, maxlength);
	}
}

// 删除座位
function deleteSeat(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("seatplanAction_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "success") {
						alert("删除成功！");
						selectPage();
					} else {
						alert("删除失败！");
					}
				});

	}
}

// 删除分房
function deleteCar(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("carplanAction_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "success") {
						alert("删除成功！");
						selectPage();
					} else {
						alert("删除失败！");
					}
				});

	}
}
// 删除分房
function deleteHourse(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("hourseplanAction_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "success") {
						alert("删除成功！");
						selectPage();
					} else {
						alert("删除失败！");
					}
				});

	}
}
// 删除用车
function deleteMeal(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("mealplanAction_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "success") {
						alert("删除成功！");
						selectPage();
					} else {
						alert("删除失败！");
					}
				});

	}
}
// 删除人员
function deletePel(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("peoplemanagement_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "success") {
						alert("删除成功！");
						queryAcountData();
					}
				});

	}
}
// 删除应用
function deleteAcc(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("vendorappmanagement_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "success") {
						alert("删除成功！");
						queryAcountData();
					}
				});

	}
}
function addSign() {
	document.getElementById("accNo_div").value = "";
	document.getElementById("orgId_div").value = "";
	document.getElementById("accName_div").value = "";
	document.getElementById("adress_div").value = "";
	document.getElementById("zip_div").value = "";
	document.getElementById("linkMan_div").value = "";
	document.getElementById("phone_div").value = "";
	document.getElementById("sealNo_div").value = "";
	document.getElementById("contract_div").value = "";
	document.getElementById("accNo_div").readOnly = false;
	document.getElementById("orgId_div").readOnly = false;
	document.getElementById("accName_div").readOnly = false;
	showSon();
}
/**
 * 应用程序维护-修改功能
 * 
 */
function modifyPel(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$.getJSON("peoplemanagement_getAppShowListByIndex.action", "index="
			+ row.rowIndex, function(UserPCInfo) {
		if (UserPCInfo == null) {
			alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");

		} else {
			document.getElementById("appid").value = UserPCInfo.uname;
			document.getElementById("apptype").value = UserPCInfo.upasswd;
			document.getElementById("isvalue").value = UserPCInfo.uemail;
			document.getElementById("showlevel").value = UserPCInfo.ufirm;
			document.getElementById("freshlevel").value = UserPCInfo.teleno;
			document.getElementById("memo").value = UserPCInfo.linkname;
			showSon();
		}
	});
}
/**
 * 应用程序维护-修改功能
 * 
 */
function modifyAcc(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$.getJSON("appmanagement_getAppShowListByIndex.action", "index="
			+ row.rowIndex, function(AppShowList) {
		if (AppShowList == null) {
			alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");

		} else {
			document.getElementById("appid").value = AppShowList.name;
			document.getElementById("apptype").value = AppShowList.userid;
			document.getElementById("isvalue").value = AppShowList.pwd;
			document.getElementById("showlevel").value = AppShowList.linkman;
			document.getElementById("freshlevel").value = AppShowList.linktel;
			document.getElementById("memo").value = AppShowList.address;
			document.getElementById("memo").value = AppShowList.opendate;
			document.getElementById("memo").value = AppShowList.memo;
			showSon();
		}
	});
}
/**
 * 新增应用维护-修改功能
 * 
 */
function changeApp(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"vendorappmanagement_getAppSetListByIndex.action",
					"index=" + row.rowIndex,
					function(AppSet) {
						if (AppSet == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");

						} else {
							document.getElementById("appname_div").value = AppSet.appname;
							document.getElementById("appresume_div").value = AppSet.appresume;
							document.getElementById("appdesc_div").value = AppSet.appdesc;
							document.getElementById("publisher_div").value = AppSet.publisher;
							document.getElementById("upuserid_div").value = AppSet.upuserid;
							document.getElementById("uploaddate_div").value = AppSet.uploaddate;
							document.getElementById("appversion_div").value = AppSet.uploaddate;
							document.getElementById("attach_div").value = AppSet.attach;
							showSon();
						}
					});
}
/**
 * 账务录入
 * 
 */
function financeInput(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"financeinput_getAppFinanceByIndex.action",
					"index=" + row.rowIndex,
					function(finance) {
						if (finance == null) {
							alert("未从后台缓存中获取到对应的账号的相关信息,请尝试刷新界面");

						} else {
							document.getElementById("organization_div").innerHTML = finance.name;
							document.getElementById("userid_div").innerHTML = finance.userid;
							showSon();
						}
					});
}
/**
 * 账务修改
 * 
 */
function financeChange(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"financechange_getAppFinanceByIndex.action",
					"index=" + row.rowIndex,
					function(finance) {
						if (finance == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
						} else {
							document.getElementById("organization_div").innerHTML = finance.company.name;
							document.getElementById("userid_div").innerHTML = finance.company.userid;
							var chargePackge = finance.chargePackge;
							var smspackge = finance.smspackge;
							if (chargePackge != "") {
								document.getElementById("pack_div"
										+ chargePackge).checked = true;
							}
							if (smspackge != "") {
								// 短信包的值
								document
										.getElementById("radio_div" + smspackge).checked = true;
							}
							showSon();
						}
					});
}
/**
 * 账务审核
 * 
 */
function financeReview(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"financereview_getAppFinanceByIndex.action",
					"index=" + row.rowIndex,
					function(finance) {
						if (finance == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
						} else {
							document.getElementById("organization_div").innerHTML = finance.company.name;
							document.getElementById("userid_div").innerHTML = finance.company.userid;
							var chargePackge = finance.chargePackge;
							var smspackge = finance.smspackge;
							if (chargePackge != "") {
								document.getElementById("pack_div"
										+ chargePackge).checked = true;
							}
							if (smspackge != "") {
								// 短信包的值
								document
										.getElementById("radio_div" + smspackge).checked = true;
							}

							showSon();
						}
					});
}
/**
 * 账务查看
 * 
 */
function financeSee(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"financesee_getAppFinanceByIndex.action",
					"index=" + row.rowIndex,
					function(finance) {
						if (finance == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");

						} else {
							document.getElementById("organization_div").innerHTML = finance.company.name;
							document.getElementById("userid_div").innerHTML = finance.company.userid;
							var chargePackge = finance.chargePackge;
							var smspackge = finance.smspackge;
							if (chargePackge != "") {
								document.getElementById("pack_div"
										+ chargePackge).checked = true;
							}
							if (smspackge != "") {
								// 短信包的值
								document
										.getElementById("radio_div" + smspackge).checked = true;
							}
							showSon();
						}
					});
}

/**
 * 历史会议管理-查看功能
 * 
 */
function lookUpHisMeet(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"cmHIsMeetMsgAction_queryDetail.action",
					"index=" + row.rowIndex,
					function(meet) {
						if (meet == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
						} else {
							document.getElementById("meetTitle_div").innerHTML = meet.meetTitle;
							document.getElementById("salutatory_div").innerHTML = meet.salutatory;
							document.getElementById("organization_div").innerHTML = meet.organization;
							document.getElementById("startTime_div").innerHTML = meet.startTime;
							document.getElementById("endTime_div").innerHTML = meet.endTime;
							document.getElementById("meetType_div").innerHTML = meet.meetType;
							document.getElementById("address_div").innerHTML = meet.address;
							document.getElementById("meetState_div").innerHTML = meet.meetState;
							document.getElementById("peopleNum_div").innerHTML = meet.peopleNum;
							document.getElementById("meetagenda_div").innerHTML = meet.meetagenda;
							document.getElementById("mealplan_div").innerHTML = meet.mealplan;
							document.getElementById("meetgroup_div").innerHTML = meet.meetgroup;
							document.getElementById("meetcargroup_div").innerHTML = meet.meetcargroup;
							showSon_HisMeet();
						}
					});
}
/**
 * 企业信息-修改功能
 * 
 */
function changeCompanyInfo(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"companyinfomanagement_getCompanyByIndex.action",
					"index=" + row.rowIndex,
					function(companyinfo) {
						if (companyinfo == null) {
							alert("未从后台缓存中获取到对应的信息,请尝试刷新界面");

						} else {
							document.getElementById("name_div").value = companyinfo.name;
							document.getElementById("userid_div").value = companyinfo.userid;
							document.getElementById("pwd_div").value = companyinfo.pwd;
							document.getElementById("linkman_div").value = companyinfo.linkman;
							document.getElementById("linktel_div").value = companyinfo.linktel;
							document.getElementById("address_div").value = companyinfo.address;
							document.getElementById("opendate_div").value = companyinfo.opendate;
							document.getElementById("memo_div").value = companyinfo.memo;
							showSon();
						}
					});
}
/**
 * 关闭子窗口
 */
function closesSon() {
	$(".sson_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".sson_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 新建会议-座位修改
 * 
 */
function editSeat(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"seatplanAction_getMealByIndex.action",
					"index=" + row.rowIndex,
					function(meal) {
						if (meal == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
						} else {
							document.getElementById("tableno_div").value = meal.tableno;
							document.getElementById("seatno_div").value = meal.seatno;
							showSeat();
						}
					});
}
/**
 * 新建会议-用餐修改
 * 
 */
function editHourse(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$
			.getJSON(
					"hourseplanAction_getMealByIndex.action",
					"index=" + row.rowIndex,
					function(meal) {
						if (meal == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
						} else {
							// document.getElementById("detail_div").value =
							// meal.detail; 详细信息未显示
							document.getElementById("mealname_div1").value = meal.address;
							document.getElementById("mealaddress_div1").value = meal.hoseno;
							showEditSon();
						}
					});
}
/**
 * 签约
 * 
 * @param data
 */
function sign(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	document.getElementById("accNo_div").readOnly = true;
	document.getElementById("orgId_div").readOnly = true;
	document.getElementById("accName_div").readOnly = true;
	document.getElementById("tableIndex").value = row.rowIndex; // 当前行下标
	startProcess("正在从后台获取账号信息...");
	$
			.getJSON(
					"accSignAction_getBasicInfoByIndex.action",
					"index=" + row.rowIndex + "&accNo="
							+ row.cells[1].innerText,
					function(basicInfo) {

						if (basicInfo == null) {
							alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
							stopProcess();
						} else {
							stopProcess();
							document.getElementById("accNo_div").value = basicInfo.accNo;
							document.getElementById("orgId_div").value = basicInfo.idBank;
							document.getElementById("accName_div").value = basicInfo.accName;
							document.getElementById("adress_div").value = basicInfo.address;
							document.getElementById("zip_div").value = basicInfo.zip;
							document.getElementById("linkMan_div").value = basicInfo.linkMan;
							document.getElementById("phone_div").value = basicInfo.phone;
							document.getElementById("sealNo_div").value = basicInfo.sealAccNo;
							document.getElementById("contract_div").value = basicInfo.signContractNo;
							var sealModes = document
									.getElementById("sealMode_div");// 屏蔽掉验印模式
							sealModes.options[0].selected = true;
							for ( var i = 0; i < sealModes.length; i++) {

								if (sealModes.options[i].value == basicInfo.sealMode) {
									sealModes.options[i].selected = true;
									break;
								}
							}
							var accCycles = document
									.getElementById("accCycle_div");
							accCycles.options[0].selected = true;
							for ( var i = 0; i < accCycles.length; i++) {

								if (accCycles.options[i].value == basicInfo.accCycle) {
									accCycles.options[i].selected = true;
									break;
								}
							}
							var sendTypes = document
									.getElementById("sendType_div");
							sendTypes.options[0].selected = true;
							for ( var i = 0; i < sendTypes.length; i++) {
								if (sendTypes.options[i].value == basicInfo.sendMode) {
									sendTypes.options[i].selected = true;
									break;
								}
							}

							showSon();
						}
					});
}
/**
 * 提交修改
 */
function submitModifyPel() {
	var tableIndex = document.getElementById("tableIndex").value;
	var param = "index=" + tableIndex;
	param = param + "&modappid=" + document.getElementById("appid").value;
	param = param + "&modapptype=" + document.getElementById("apptype").value;
	param = param + "&modisvalue=" + document.getElementById("isvalue").value;
	param = param + "&modshowlevel="
			+ document.getElementById("showlevel").value;
	param = param + "&modfreshlevel="
			+ document.getElementById("freshlevel").value;
	param = param + "&modmemo=" + document.getElementById("memo").value;

	if (confirm("确认提交修改吗?")) {
		$.post("peoplemanagement_modify.action", param, function(result) {
			if (result == "success") {
				alert("信息修改完毕");
				closeSon();
				queryAcountData();
			}
		});
	}
}
/**
 * 提交修改
 */
function submitModify() {
	var tableIndex = document.getElementById("tableIndex").value;
	var param = "index=" + tableIndex;
	param = param + "&modappid=" + document.getElementById("appid").value;
	param = param + "&modapptype=" + document.getElementById("apptype").value;
	param = param + "&modisvalue=" + document.getElementById("isvalue").value;
	param = param + "&modshowlevel="
			+ document.getElementById("showlevel").value;
	param = param + "&modfreshlevel="
			+ document.getElementById("freshlevel").value;
	param = param + "&modmemo=" + document.getElementById("memo").value;

	if (confirm("确认提交修改吗?")) {
		$.post("appmanagement_modify.action", param, function(result) {
			if (result == "success") {
				alert("信息修改完毕");
				closeSon();
				queryAcountData();
			}
		});
	}
}

/**
 * 提交签约信息
 */
function submitSign() {
	var tableIndex = document.getElementById("tableIndex").value;
	// var index=document.getElementById("dataIndex").value;
	if (document.getElementById("accNo_div").readOnly == false) {
		tableIndex = "1";// 新增签约时其实这个字段是没有用的，但是没值的话后续逻辑会认为是输入不完全，所以设置为1
	}
	var param = "index=" + tableIndex;
	param = param + "&accNo=" + document.getElementById("accNo_div").value;
	param = param + "&accName=" + document.getElementById("accName_div").value;
	param = param + "&orgId=" + document.getElementById("orgId_div").value;
	param = param + "&address=" + document.getElementById("adress_div").value;
	param = param + "&zip=" + document.getElementById("zip_div").value;
	param = param + "&linkMan=" + document.getElementById("linkMan_div").value;
	param = param + "&phone=" + document.getElementById("phone_div").value;
	param = param + "&sealNo=" + document.getElementById("sealNo_div").value;
	param = param + "&sendType="
			+ document.getElementById("sendType_div").value;
	param = param + "&sealMode="
			+ document.getElementById("sealMode_div").value;
	param = param + "&accCycle="
			+ document.getElementById("accCycle_div").value;
	param = param + "&contractNo="
			+ document.getElementById("contract_div").value;
	if (param.indexOf("=&", 0) > -1) {
		alert("信息输入不完整");
		return;
	}
	if (document.getElementById("sendType_div").value == "0"
			|| document.getElementById("sealMode_div").value == "0") {
		alert("验印模式和发送方式必须指定！");
		return;
	}
	if (document.getElementById("accNo_div").readOnly == true) {
		if (confirm("确认提交修改吗?")) {
			startProcess("正在修改...");
			$.post("accSignAction_modify.action", param, function(result) {
				dealResult_sign(result, tableIndex);
			});
		}
	} else {
		if (confirm("确认新增吗?")) {
			startProcess("正在新增...");
			$.post("accSignAction_add.action", param, function(result) {
				dealResult_add(result);
			});
		}
	}
}

function dealResult_delete(result, row) {
	if (result != null && result.length > 0) {
		stopProcess();
		alert(result);
	} else {
		// var index=row.rowIndex;
		// row.parentNode.deleteRow(index-1);
		// stopProcess();
		queryAcountData();
	}
}

function dealResult_modify(result, tableIndex) {
	if (result != null && result.length > 0) {
		stopProcess();
		alert(result);
	} else {
		// var row =document.getElementById("basicInfoTable").rows[tableIndex];
		// row.cells[4].innerText=document.getElementById("adress_div").value;
		// row.cells[5].innerText=document.getElementById("zip_div").value;
		// row.cells[6].innerText=document.getElementById("linkMan_div").value;
		// row.cells[7].innerText=document.getElementById("phone_div").value;
		// row.cells[8].innerText=document.getElementById("sealNo_div").value;
		// var sendType=document.getElementById("sendType_div");
		// var faceType=document.getElementById("faceType_div");
		// row.cells[11].innerText=sendType.options[sendType.selectedIndex].text;
		// row.cells[12].innerText=faceType.options[faceType.selectedIndex].text;
		queryAcountData();
		// stopProcess();
		// closeSon();
	}
}

function dealResult_sign(result, tableIndex) {
	if (result != null && result.length > 0) {
		stopProcess();
		alert(result);
	} else {
		// var row =document.getElementById("basicInfoTable").rows[tableIndex];
		// row.cells[4].innerText=document.getElementById("adress_div").value;
		// row.cells[5].innerText=document.getElementById("zip_div").value;
		// row.cells[6].innerText=document.getElementById("linkMan_div").value;
		// row.cells[7].innerText=document.getElementById("phone_div").value;
		// row.cells[9].innerText=document.getElementById("sealNo_div").value;
		// row.cells[10].innerText="已签约";
		// // var sendType=document.getElementById("sendType_div");
		// // var faceType=document.getElementById("faceType_div");
		// var sealMode=document.getElementById("sealMode_div");
		// var accCycle=document.getElementById("accCycle_div");
		// var contractId=document.getElementById("contractId").value;
		// row.cells[11].innerText=sealMode.options[sealMode.selectedIndex].text;
		// row.cells[12].innerText=accCycle.options[accCycle.selectedIndex].text;
		// row.cells[13].innerText=contractId;
		// row.cells[14].innerHTML="<a onclick='sign(this)'
		// style='color:#FF0000'>修改 </a>";
		// stopProcess();
		// closeSon();
		queryAcountData();
	}
}

function dealResult_add(result) {
	stopProcess();
	if (result != null && result.length > 0) {
		alert(result);
		return;
	} else {
		closeSon();
	}
	queryAcountData();
}

function editContact(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	$.getJSON(
				"contactsAction_getContactByIndex.action",
				"index=" + row.rowIndex,
				function(mydata) {
					if (mydata == null) {
						alert("未从后台缓存中获取到对应的账号信息,请尝试刷新界面");
					} else {
						document.getElementById("name_div").value = mydata.name;
						document.getElementById("position_div").value = mydata.position;
						document.getElementById("tel_div").value = mydata.tel;
						document.getElementById("email_div").value = mydata.email;
						if (mydata.iscanlook == 1) {
							document.getElementById("iscanlook1_div").checked = "checked";
						}
						if (mydata.iscanlook == 2) {
							document.getElementById("iscanlook2_div").checked = "checked";
						}
						showContact();
					}
				});
}

//删除人员
function deleteContact(data) {
	var cell = data.parentNode;
	var row = cell.parentNode;
	if (confirm("确认删除吗?")) {
		$.post("contactsAction_delete.action", "&index=" + row.rowIndex,
				function(result) {
					if (result == "1"){
						alert("您不能删除已开启会议的与会人员");
					} else if (result == "success") {
						alert("删除成功！");
						selectPage();
					} else if (result == "fail") {
						alert("删除失败！");
					}
					
				});

	}
}
