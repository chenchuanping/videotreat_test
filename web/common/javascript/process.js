/**
 * 启动进度条
 */
function startProcess(notice) {
	var processNotice = document.getElementById("processNotice");
	processNotice.innerHTML = notice;
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".showbox").css({
		'display' : 'block'
	});
	$(".showbox").stop(false).animate({
		'margin-top' : '300px',
		'opacity' : '0.8'
	}, 200);
};

/**
 * 关闭进度条
 */
function stopProcess() {
	$(".showbox").css({
		'display' : 'none'
	});
	$(".showbox").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
};

/**
 * 打开理由列表
 * 
 * @param reasons
 *            后台传过来的包含理由信息的数组
 * @param actionPath
 *            任务需要提交的地址
 * @param nextTaskPath
 *            下一笔任务的地址
 */
function openUntreadReason(reasons, actionPath, nextTaskPath, params) {
	var reasonTable = document.getElementById("reasonTable");
	var index = 0;
	var content;
	var row = null;
	var cell;
	while (index < reasons.length) {
		content = "";
		if (index % 2 == 0) {
			row = reasonTable.insertRow(-1);
		}
		cell = row.insertCell(-1);
		content = content
				+ "<td>&nbsp&nbsp"
				+ "<input type='checkbox'  name='reason' onClick='showData();'  id='checkboxId"
				+ index + "' value='" + reasons[index]
				+ "'/>&nbsp<label for='checkboxId" + index + "'>"
				+ reasons[index] + "</label></td>";
		if (index == reasons.length - 1) {
			content = content
					+ "<input type='hidden' id='actionPath' name='actionPath' value='"
					+ actionPath + "'/>";
			content = content
					+ "<input type='hidden' id='nextTaskPath' name='nextTaskPath' value='"
					+ nextTaskPath + "'/>";
			content = content
					+ "<input type='hidden' id='params' name='params' value='"
					+ params + "'/>";
		}
		cell.innerHTML = content;
		index = index + 1;
	}
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".untreadReason").stop(false).animate({
		'opacity' : '1'
	}, 200);
	$(".untreadReason").css({
		'display' : 'block',
		'opacity' : '0'
	});
	document.getElementById("untreadReasonInput").style.color = "#AAAAAA";
};

function closeUntreadReason() {
	var reasonTable = document.getElementById("reasonTable");
	var input = document.getElementById("untreadReasonInput");
	input.value = "请选择或输入理由信息";
	// $(".untreadReason").stop(false).animate({
	// 'opacity' : '0'
	// },200);
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".untreadReason").css({
		'display' : 'none',
		'opacity' : '0'
	});
	while (reasonTable.rows.length != 0) {
		reasonTable.deleteRow(0);
	}
};

function initUi(path) {
	var content = "<div class='overlay'></div>";
	content = content + "<div id='AjaxLoading' class='showbox'>";
	content = content + "<div class='loadingWord'>";
	content = content + "<img src='" + path
			+ "/ebs/common/images/waiting.gif'></img>";
	content = content + "<p id='processNotice'></p>";
	content = content + "</div>";
	content = content + "</div>";
	content = content + "<div class='untreadReason' id='untreadReason'>";
	content = content + "<div class='reasons'>";
	content = content + "</div>";
	content = content + "</div>";
	document.write(content);
}

/**
 * 显示子窗口
 */
function showSon() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".son_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".son_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 显示子窗口
 */
function showSonzl() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".son_divzl").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".son_divzl").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 显示子窗口
 */
function showSon_meetinfo() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".son_div_meetinfo").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".son_div_meetinfo").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 显示子窗口
 */
function hisSon_meetinfo() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".his_div_meetinfo").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".his_div_meetinfo").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 显示子窗口
 */
function showSon_Pages() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".page_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".page_div").stop(false).animate({
		'margin-top' : '200px',
		'margin-left' : '15%',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}

/**
 * 显示子窗口
 */
function showSon_HisMeet() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".son_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".son_div").stop(false).animate({
		'margin-top' : '200px',
		'margin-left' : '15%',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 显示子窗口
 */
function showSeat() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".seat_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".seat_div").stop(false).animate({
		'margin-top' : '130px',
		'margin-left' : '15%',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeSeat() {
	$(".seat_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".seat_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 显示子窗口
 */
function showMealSon() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".addmeal_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".addmeal_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}

/**
 * 显示子窗口
 */
function showCarSon() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".add_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".add_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 显示子窗口
 */
function showEditSon() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".edit_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".edit_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}

/**
 * 显示子窗口
 */
function showEditMealSon() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".editMeal_div").css({
		'display' : 'block'
	});
	$(".sonpageEditMeal").css({
		'display' : 'block'
	});
	$(".editMeal_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageEditMeal").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeEditMealSon() {
	$(".editMeal_div").css({
		'display' : 'none'
	});
	$(".sonpageEditMeal").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".editMeal_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageEditMeal").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeESon() {
	$(".edit_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".edit_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 显示子窗口
 */
function showSon_telbook() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".son_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".son_div").stop(false).animate({
		'margin-top' : '150px',
		'margin-left' : '10%',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeMSon() {
	$(".addmeal_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".addmeal_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeCarSon() {
	$(".add_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".add_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

function showSon2() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".son2_div").css({
		'display' : 'block'
	});
	$(".sonpage2").css({
		'display' : 'block'
	});
	$(".son2_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage2").stop(false).animate({
		'opacity' : '1'
	}, 200);
}

/**
 * 关闭子窗口
 */
function closeSon() {
	$(".son_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".son_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeSonzl() {
	$(".son_divzl").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".son_divzl").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closePageSon() {
	$(".page_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".page_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

function closeSon2() {
	$(".son2_div").css({
		'display' : 'none'
	});
	$(".sonpage2").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".son2_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage2").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * TODO 关闭子窗口his_div_meetinfo
 */
function closeHis() {
	$(".his_div_meetinfo").css({
		'display' : 'none'
	});
	$(".sonpage_his").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".his_div_meetinfo").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage_his").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
// TODO 关闭会议管理详细
function closeSon_meetinfo() {
	$(".son_div_meetinfo").css({
		'display' : 'none'
	});
	$(".sonpage_meetinfo").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".son_div_meetinfo").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage_meetinfo").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
function onFoucs(o) {
	// document.getElementById("untreadReasonInput").style.color="#FF0000";
	document.getElementById("untreadReasonInput").style.color = "#333333";
	if (o.value == "请选择或输入理由信息") {
		o.value = "";
	}
}

function onBlur(o) {
	if (o.value == "") {
		document.getElementById("untreadReasonInput").style.color = "#AAAAAA";
		o.value = "请选择或输入理由信息";
	}
}
function IsDate(sm) {
	var strDate = sm.value;

	var result = strDate
			.match(/((^((1[8-9]\d{2})|([2-9]\d{3}))(-)(10|12|0?[13578])(-)(3[01]|[12][0-9]|0?[1-9])$)|(^((1[8-9]\d{2})|([2-9]\d{3}))(-)(11|0?[469])(-)(30|[12][0-9]|0?[1-9])$)|(^((1[8-9]\d{2})|([2-9]\d{3}))(-)(0?2)(-)(2[0-8]|1[0-9]|0?[1-9])$)|(^([2468][048]00)(-)(0?2)(-)(29)$)|(^([3579][26]00)(-)(0?2)(-)(29)$)|(^([1][89][0][48])(-)(0?2)(-)(29)$)|(^([2-9][0-9][0][48])(-)(0?2)(-)(29)$)|(^([1][89][2468][048])(-)(0?2)(-)(29)$)|(^([2-9][0-9][2468][048])(-)(0?2)(-)(29)$)|(^([1][89][13579][26])(-)(0?2)(-)(29)$)|(^([2-9][0-9][13579][26])(-)(0?2)(-)(29)$))/);
	if (strDate == "") {
		return true;
	} else {
		if (null == result) {
			alert("请保证" + sm.title + "中输入的日期格式为yyyy-mm-dd或正确的日期!");
			docdate.focus();
			return false;
		} else {
			return true;
		}
	}

}

/**
 * 显示子窗口
 */
function showStaticPageSon() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".editStatic_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".editStatic_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}

/**
 * 关闭子窗口
 */
function closeStaticPageSon() {
	$(".editStatic_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".editStatic_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}


/**
 * 显示子窗口
 */
function showCompany() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".company_div").css({
		'display' : 'block'
	});
	$(".sonpageCompany").css({
		'display' : 'block'
	});
	$(".company_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageCompany").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeCompany() {
	$(".company_div").css({
		'display' : 'none'
	});
	$(".sonpageCompany").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".company_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageCompany").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

/**
 * 显示子窗口
 */
function showAgenda() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".agenda_div").css({
		'display' : 'block'
	});
	$(".sonpageagenda").css({
		'display' : 'block'
	});
	$(".agenda_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageagenda").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeAgenda() {
	$(".agenda_div").css({
		'display' : 'none'
	});
	$(".sonpageagenda").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".agenda_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageagenda").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 显示子窗口
 */
function showAgendaEdit() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".agendaEdit_div").css({
		'display' : 'block'
	});
	$(".sonpageagendaEdit").css({
		'display' : 'block'
	});
	$(".agendaEdit_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageagendaEdit").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeAgendaEdit() {
	$(".agendaEdit_div").css({
		'display' : 'none'
	});
	$(".sonpageagendaEdit").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".agendaEdit_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageagendaEdit").stop(false).animate({
		'opacity' : '0'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeMeetGroupEdit() {
	$(".meetGroupEdit_div").css({
		'display' : 'none'
	});
	$(".sonpageMeetGroupEdit").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".meetGroupEdit_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageMeetGroupEdit").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

/**
 * 显示子窗口
 */
function showChangeImage() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".changeImage_div").css({
		'display' : 'block'
	});
	$(".sonpageChangeImage").css({
		'display' : 'block'
	});
	$(".changeImage_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageChangeImage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeChangeImage() {
	$(".changeImage_div").css({
		'display' : 'none'
	});
	$(".sonpageChangeImage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".changeImage_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageChangeImage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

/**
 * 显示子窗口
 */
function showMeetGroupAdd() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".meetGroupAdd_div").css({
		'display' : 'block'
	});
	$(".sonpageMeetGroupAdd").css({
		'display' : 'block'
	});
	$(".meetGroupAdd_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageMeetGroupAdd").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeMeetGroupAdd() {
	$(".meetGroupAdd_div").css({
		'display' : 'none'
	});
	$(".sonpageMeetGroupAdd").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".meetGroupAdd_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageMeetGroupAdd").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

/**
 * 显示子窗口
 */
function showMeetGroupEdit() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".meetGroupEdit_div").css({
		'display' : 'block'
	});
	$(".sonpageMeetGroupEdit").css({
		'display' : 'block'
	});
	$(".meetGroupEdit_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpageMeetGroupEdit").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeMeetGroupEdit() {
	$(".meetGroupEdit_div").css({
		'display' : 'none'
	});
	$(".sonpageMeetGroupEdit").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".meetGroupEdit_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpageMeetGroupEdit").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

function showContact() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".contactsEdit_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".contactsEdit_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeContact() {
	$(".contactsEdit_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".contactsEdit_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}

function showAddContact() {
	$(".overlay").css({
		'display' : 'block',
		'opacity' : '0.8'
	});
	$(".contacts_div").css({
		'display' : 'block'
	});
	$(".sonpage").css({
		'display' : 'block'
	});
	$(".contacts_div").stop(false).animate({
		'margin-top' : '200px',
		'opacity' : '1'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '1'
	}, 200);
}
/**
 * 关闭子窗口
 */
function closeAddContact() {
	$(".contacts_div").css({
		'display' : 'none'
	});
	$(".sonpage").css({
		'display' : 'none'
	});
	$(".overlay").css({
		'display' : 'none',
		'opacity' : '0'
	});
	$(".contacts_div").stop(false).animate({
		'margin-top' : '250px',
		'opacity' : '0'
	}, 200);
	$(".sonpage").stop(false).animate({
		'opacity' : '0'
	}, 200);
}