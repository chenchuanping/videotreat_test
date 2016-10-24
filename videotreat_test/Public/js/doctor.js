//计算页面内容块宽度
$(function () {
    var winWidth = $(window).width();
    var conWidth = (winWidth - 140) / 3;
    $('#header').css('width', winWidth);
    $('#content').css('width', winWidth);
    $('#content_left').css('width', conWidth);
    $('#content_right').css('width', conWidth * 2);
    $('.dk_toggle').css('color', '#000');
    $('button').button();
    /*刷新页面时，初始化时*/
    //$('#userIdUp').val('');               //基本信息-自述单中的隐藏字段设置为空
    //$("#reportCardIdUp").val('');        //基本信息-自述单中的隐藏字段设置为空
    //主诉光标丢失验证
    $('#userComplaint').blur(function () {
        var v = $(this).val();
        var n = $(this).next();
        var t = $(this);
        if (v == '') {
            n.css('display', 'block').find('span').html('主诉内容不能为空');
            zsok = false;
        }
        else {
            n.css('display', 'none');
            zsok = true;
        }
    });
    //现病史光标丢失验证
    $('#userHPC').blur(function () {
        var v = $(this).val();
        var n = $(this).next();
        var t = $(this);
        if (v == '') {
            n.css('display', 'block').find('span').html('现病史不能为空');
            xbsok = false;
        } else {
            n.css('display', 'none');
            xbsok = true;
        }
    });
    //既往史光标丢失验证
    $('#userPMH').blur(function () {
        var v = $(this).val();
        var n = $(this).next();
        var t = $(this);
        if (v == '') {
            n.css('display', 'block').find('span').html('既往史不能为空');
            jwsok = false;
        } else {
            n.css('display', 'none');
            jwsok = true;
        }
    });
    //医生建议光标丢失验证
    $('#doctorSuggest').blur(function () {
        var v = $(this).val();
        var n = $(this).next();
        var t = $(this);
        if (v == '') {
            n.css('display', 'block').find('span').html('医生建议不能为空');
            ysjysok = false;
        } else {
            n.css('display', 'none');
            ysjyok = true;
        }
    })

});

//安全退出
function logout() {
    if (confirm('您确定要离开吗？请先确认患者列表中有没有排队！')) {
        $.ajax({
            url: app + '/LineInfo/index',
            type: "post",
            dataType: "json",
            data: "startRow=0&pageSize=50",
            success: function (data) {
                if (data != null) {             //有排队
                    alert('当前还有患者在排队，请接诊完再退出！');
                    return false;
                } else {
                    window.location.href = app + '/Login/loginOut/doctorId/' + doctorId;
                }
            }
        });
    }
}

//修改医生状态
$("#doctorState").change(function () {
    var objS = document.getElementById("doctorState");
    var grade = objS.options[objS.selectedIndex].value;
    $.ajax({
        url: app + '/Doctor/changeState',
        type: "post",
        data: {
            stateId: grade
        },
        dataType: "json",
        success: function (data) {
            if (data.res == 1) {
                alert('修改状态成功')
            } else {
                alert('修改状态失败')
            }

        }
    });
});


//修改密码
function modifyPassword() {
    if (confirm('您确定要修改密码吗？')) {
        window.location.href = app + '/Password/index/doctorId/' + doctorId;
    }
}

//此次接诊的用户的就诊记录
$(function () {
    $("#treatHistory").click(function () {
        var userId = $("#userIdUp").val();
        $.ajax({
            url: app + '/TreatHistory/index',
            type: "post",
            dataType: "json",
            data: {userId: userId},
            success: function (data) {
                var inse = '<div id="user_detail_treat_record_parent"><table  id="get_user_detail_treat_record">';
                if (data.userTreatInfo != '') {
                    var inse = '<div id="treat_record_parent">' +
                        '<table  id="treatHistorys" cellspacing="0" cellpadding="0"  width="100%">' +
                        '<tr><th style="width: 50px">序号</th><th  width="50">用户姓名</th><th  width="50">接诊医院</th><th  width="50">接诊医师</th><th width="150px">接诊时间</th><th>主诉</th><th  width="50">操作</th></tr>';
                    $.each(data.userTreatInfo, function (key, val) {
                        inse += '<tr><td style="width: 50px">' + (key + 1) + '</td>' +
                            '<td  style="width: 80px">' + val.userName + '</td>' +
                            '<td  style="width: 120px">' + val.hospitalName + '</td>' +
                            '<td  style="width: 80px">' + val.doctorName + '</td>' +
                            '<td  style="width: 150px;">' + val.treatTime + '</td>' +
                            '<td class="indent">' + val.userComplaint + '</td>' +
                            ' <td  style="width: 80px"><a href="javascript:;" class="treatRecordDetail_a" onclick="detailTreatRecord(' + val.userId + ',' + val.treatRecordId + ')">查看详情</a></td></tr>';
                    });
                    inse += '</table></div>';
                    $(".treatRecordDetail").html(inse);
                } else {
                    var nul = '若有就诊信息，接诊后方可显示';
                    $(".treatRecordDetail").html(nul);
                }
            }
        });
    });
});

/*显示个人单次就诊详情*/
function detailTreatRecord(userId, treatRecordId) {
    $("#treatRecordDetail").css("display", "block");
    $.ajax({
        url: app + '/DetailTreatRecord/index',
        type: "post",
        dataType: "json",
        data: {userId: userId, treatRecordId: treatRecordId},
        success: function (data) {
            if (typeof (data) != "undefined") {
                var key;
                var inse = '<div id="user_detail_treat_record_parent">' +
                    '<table  id="get_user_detail_treat_record" cellpadding="0" cellspacing="0">' +
                    '<tr ><th colspan="2" >个人就诊记录</th></tr>' +
                    '<tr><td width="80">用户姓名</td><td >' + data.userTreatInfo.userName + '</td></tr>' +
                    '<tr><td width="80">接诊医院</td><td >' + data.userTreatInfo.hospitalName + '</td></tr>' +
                    '<tr><td width="80">接诊医师</td><td >' + data.userTreatInfo.doctorName + '</td></tr>' +
                    '<tr><td >主诉</td><td >' + data.userTreatInfo.userComplaint + '</td></tr>' +
                    '<tr><td >现病史</td><td >' + data.userTreatInfo.userHPC + '</td></tr>' +
                    '<tr><td >既往史</td><td >' + data.userTreatInfo.userPMH + '</td></tr>' +
                    '<tr><td >医生建议</td><td >' + data.userTreatInfo.doctorSuggest + '</td></tr>' +
                    '<tr><td >就诊时间</td><td >' + data.userTreatInfo.treatTime + '</td></tr>';
                if (data.userTreatInfo['reportCardDescribe']) {
                    inse += '<tr><td >自述卡描述</td><td >' + data.userTreatInfo.reportCardDescribe + '</td></tr>';
                }
                inse += '<tr id="imglist"><td  colspan="6" class="limit_reportCardImage">';
                if (data.userTreatInfo['reportCardImages']) {
                    for (key in data.userTreatInfo['reportCardImages']) {
                        inse += '<a href="#" class="img_a">' +
                            '<img  width="200" height="220"  src="' + data.userTreatInfo['reportCardImages'][key] + '" alt="暂无"/></a>';
                    }
                }
                /* if (data.userTreatInfo['reportCardImageInfo']) {
                 for (key in data.userTreatInfo['reportCardImageInfo']) {
                 inse += '<a href="#" class="img_a">' +
                 '<img  width="200" height="220"  src="' + data.userTreatInfo['reportCardImageInfo'][key]['image'] + '" alt="暂无"/></a>';
                 }
                 }*/
                inse += '</td></tr></table></div>';
                $("#treatRecordDetail").html(inse);
            } else {
                var nul = '';
                $("#treatRecordDetail").html(nul);
            }
        }
    });
}


//获取当前排队列表
function get_user_line() {
    $.ajax({
        url: app + '/LineInfo/index',
        type: "post",
        dataType: "json",
        data: "startRow=0&pageSize=50",
        success: function (data) {
            if (typeof (data) != "undefined" && data != null) {
                var inshtml = '<div>' +
                    '<table id="get_user_line"><tr >' +
                    '<th>序号</th><th>姓名</th><th>性别</th><th>年龄</th><th>操作</th></tr>';
                $.each(data, function (key, val) {
                    if (key == 0 && val['behaviourName'] != '进入视频') {  //只显示列表中第一个患者可以被接诊
                        inshtml += '<tr><td>'
                            + (key + 1)
                            + '</td><td>'
                            + (val.userName ? val.userName : "")
                            + '</td><td class="user_tel">'
                            + (val.sex_value)
                            + '</td><td>'
                            + (val.birthday ? val.birthday : "")
                            + '</td><td id="jz"><button  id = "jiezhen_button"  class="ui-button ui-widget ui-state-default ui-corner-all"  onclick="jiezhen(' + val.userId + ',' + val.reportCardId + ',' + val.doctorId + ')">接诊</button>' +
                            '</td></tr>';
                    } else {
                        inshtml += '<tr><td>'
                            + (key + 1)
                            + '</td><td>'
                            + (val.userName ? val.userName : "")
                            + '</td><td class="user_tel">'
                            + (val.sex_value)
                            + '</td><td>'
                            + (val.birthday ? val.birthday : "")
                            + '</td><td></td></tr>';
                    }
                });
                inshtml += '</table></div>';
                $("#linehtml").html(inshtml);
            } else {
                var nul = '<div>' +
                    '<table><tr ><td>暂无排队</td></tr></table></div>';
                $("#linehtml").html(nul);
            }
        }
    });
}

//定时刷新排队列表

$(".get_user_line").click(function () {
    get_user_line();
    setInterval("get_user_line()", get_line_time);
});


//接诊按钮
function jiezhen(userId, reportCardId, doctorId) {
    /*先清除隐藏表单内容*/
    $('#userIdUp').val('');
    $('#reportCardIdUp').val('');
    /*做推送用的*/
    $.ajax({
        url: app + '/Jpush/index',
        type: 'post',
        data: {userId: userId},
        dataType: 'json',
        success: function (data) {
            if (data != null) {
                window.open(app + '/Meeting/index?room=' + userId + '&vendorKey=' + data['vendorKey'] + '&resolution=' + data['resolution'], "_blank", "width=" + document.body.clientWidth + ",height=" + document.body.clientHeight + ",top=0,left=" + document.body.clientWidth);
                $('#userIdUp').val(userId);
                if (reportCardId != null) {
                    $('#reportCardIdUp').val(reportCardId);
                }
                getUserDetail();
            }
        }
    });
}

//获取用户基本信息-自述单
function getUserDetail() {
    var userId = $("#userIdUp").val();
    var reportCardId = $("#reportCardIdUp").val();
    if (reportCardId != '') {
        $.ajax({
            url: app + '/UserDetail/index',
            type: "post",
            dataType: "json",
            data: {userId: userId, reportCardId: reportCardId},
            success: function (data) {
                var userhtml = '';
                var nul = '';
                if (data.userInfo) {
                    userhtml += '<table class="user_detail " cellspacing="0" cellpadding="0">' +
                        '<tr ><td colspan="6"  class="title">用户基本信息</td></tr>' +
                        '<tr><td>姓名:</td><td>'
                        + data.userInfo.userName
                        + '</td><td>年龄:</td><td>'
                        + data.userInfo.birthday
                        + '</td><td>性别:</td><td>'
                        + data.userInfo.sex_value
                        + '</td></tr>'
                        + '<tr><td>电话:</td><td>'
                        + data.userInfo.tel
                        + '</td><td>身高:</td><td>'
                        + data.userInfo.stature + ' cm'
                        + '</td><td>体重:</td><td>'
                        + data.userInfo.weight + ' kg'
                        + '</td></tr>'
                        + '<tr><td>地址:</td><td colspan="5">'
                        + data.userInfo.address
                        + '</td></tr>';
                    //显示个人基本信息
                    $(".userDetail").html(userhtml);
                } else {
                    nul += '<table class="user_detail" border="1"><tr><td>暂无信息</td></tr></table>';
                    $(".userDetail").html(nul);
                }
                var key;
                if (data.reportCardInfo) {
                    userhtml += '<tr ><td colspan="6"  class="report_card_info title">自述卡信息</td></tr>' +
                        '<tr><td>自述卡名称：</td><td colspan="5">' + data.reportCardInfo.reportCardName + '</td></tr>' +
                        '<tr><td>自述卡描述：</td><td id="reportCardDescribe" colspan="5"><div>' + data.reportCardInfo.reportCardDescribe + '</div></td></tr>' +
                        '<tr><td colspan="6" class="title">自述卡图片：</td></tr><tr class="imglist"><td  class="limit_reportCardImage" colspan="6" >';
                    for (key in data.reportCardInfo['reportCardImageInfo']) {
                        userhtml += '<a href="#" class="img_a">' +
                            '<img  width="200" height="220"  src="' + data.reportCardInfo['reportCardImageInfo'][key]['image'] + '" alt="暂无"/></a>';
                    }
                    userhtml += '</td></tr></table>';
                    //显示就诊卡信息
                    $(".userDetail").html(userhtml);
                } else {
                    nul += '<div class="user_report_info_parent"><table class="user_report_info">' +
                        '<tr ><td colspan="3"  class="report_card_info">自述卡信息：</td></tr>' +
                        '<tr><td>自述卡名称：</td><td colspan="2">暂无</td></tr>' +
                        '<tr><td>自述卡描述：</td><td colspan="2">暂无</td></tr>' +
                        '<tr><td>自述卡图片：</td><td colspan="2">暂无</td></tr></table></div>';
                    $(".userDetail").html(nul);
                }
            }
        });
    } else if (reportCardId == '') {
        $.ajax({
            url: app + '/UserDetail/index',
            type: "post",
            dataType: "json",
            data: {userId: userId},
            success: function (data) {
                if (typeof (data) != "undefined") {
                    if (data.userInfo != '') {
                        var userhtml = '';
                        userhtml += '<div class="user_detail_parent"><table class="user_detail">' +
                            '<tr ><td colspan="6"  class="">用户基本信息</td></tr>' +
                            '<tr><td>姓名:</td><td>'
                            + data.userInfo.userName
                            + '</td><td>年龄:</td><td>'
                            + data.userInfo.birthday
                            + '</td><td>性别:</td><td>'
                            + data.userInfo.sex_value
                            + '</td></tr>'
                            + '<tr><td>电话:</td><td>'
                            + data.userInfo.tel
                            + '</td><td>身高:</td><td>'
                            + data.userInfo.stature + ' cm'
                            + '</td><td>体重:</td><td>'
                            + data.userInfo.weight + ' kg'
                            + '</td></tr>'
                            + '<tr><td>地址:</td><td colspan="5">'
                            + data.userInfo.address
                            + '</td></tr></table></div>';
                        //显示个人基本信息
                        $(".userDetail").html(userhtml);
                    } else {
                        var nul = '<table class="user_detail" border="1"><tr><td>暂无信息</td></tr></table>';
                        $(".userDetail").html(nul);
                    }
                }
            }
        });
    }
}
$(function () {
    //getUserDetail();
    $("#userDetail-reportCard").click(function () {
        getUserDetail();
    })

})

//病历填写
function upTreatRecord() {
    var userId = $("#userIdUp").val();
    var userComplaint = $("#userComplaint").val();
    var userHPC = $("#userHPC").val();
    var userPMH = $("#userPMH").val();
    var doctorSuggest = $("#doctorSuggest").val();
    var remarkId = $("#remark").val();
    var reportCardId = $("#reportCardIdUp").val();
    $('#userComplaint').trigger('blur');
    $('#userHPC').trigger('blur');
    $('#userPMH').trigger('blur');
    $('#doctorSuggest').trigger('blur');
    if (!zsok || !xbsok || !jwsok || !ysjyok) {
        return false;
    }
    /*吸烟史*/
    var radio = document.getElementsByName("smokingHistory");
    var smokingHistory = null;
    for (var i = 0; i < radio.length; i++) {
        if (radio[i].checked == true) {
            smokingHistory = radio[i].value;
            break;
        }
    }
    /*过敏史*/
    var radio2 = document.getElementsByName("allergyHistory");
    var allergyHistory = null;
    for (var i = 0; i < radio2.length; i++) {
        if (radio2[i].checked == true) {
            allergyHistory = radio2[i].value;
            break;
        }
    }

    if (confirm("提交病历，当前用户的排队将会被删除，个人信息和就诊记录将会被清空，确认提交吗？")) {
        $.ajax({
            url: app + '/TreatRecordPut/index',
            type: "post",
            data: {
                userId: userId,
                userComplaint: userComplaint,
                userHPC: userHPC,
                userPMH: userPMH,
                doctorSuggest: doctorSuggest,
                smokingHistory: smokingHistory,
                allergyHistory: allergyHistory,
                remarkId: remarkId,
                reportCardId: reportCardId
            },
            dataType: "json",
            success: function (data) {
                if (data.res == 1) {
                    alert("病历填写成功");
                    //提交完就诊记录后清空就诊记录填写
                    $('#userComplaint').val('');
                    $('#userHPC').val('');
                    $('#doctorSuggest').val('');
                    $('#remark').val('');
                    $('#userIdUp').val('');               //基本信息-自述单中的隐藏字段设置为空
                    $("#reportCardIdUp").val('');        //基本信息-自述单中的隐藏字段设置为空
                } else {
                    alert("病历填写失败");
                    return false;
                }
            }
        });
    } else {
        return;
    }
}


//返回首页    //当前医生的所有就诊记录
$(function () {
    //返回首页
    $("#goback_headPage").click(function () {
        window.location.href = app + "/Doctor/index";
    });
    //当前医生的所有就诊记录
    $("#treatRecordHistory").click(function () {
        window.location.href = app + "/TreatRecordHistory/index";
    });
});
//自述单图片放大浏览
$("#imgshow").dialog({
    autoOpen: false,
    width: 1000,
    height: 600,
    modal: true,
    position: 'center top',
    closeText: '关闭',
});
$(document).on("click", '.img_a', function (event) {
    $("#imgshow").dialog("open");
    event.preventDefault();
//            $('.ui-widget-header').css('background','none').css('border','0');
//            $('.ui-widget-content').css('background','none').css('border','0');
    var imgsrc = $(this).find('img').attr('src');
    $('#imgshow').find('img').attr('src', imgsrc);
});
