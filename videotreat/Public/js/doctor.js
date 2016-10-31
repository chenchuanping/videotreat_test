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
    $('#userIdUp').val('');               //基本信息-自述单中的隐藏字段设置为空
    $("#reportCardIdUp").val('');        //基本信息-自述单中的隐藏字段设置为空
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
    })
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

        }
    });
});


//修改密码
function modifyPassword() {
    if (confirm('您确定要修改密码吗？')) {
        window.location.href = app + '/Password/index/doctorId/' + doctorId;
    }
}

//此次接诊的用户和当前医生的就诊记录
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
                        '<table  id="treatHistorys" cellspacing="0" cellpadding="0" >' +
                        '<tr><th>序号</th><th>姓名</th><th>主诉</th><th>现病史</th><th>既往史</th><th>医生建议</th><th class="treatTime">就诊时间</th><th>操作</th></tr>';
                    $.each(data.userTreatInfo, function (key, val) {
                        inse += '<tr><td class="">' + (key + 1) + '</td>' +
                            '<td class="">' + val.userName + '</td>' +
                            '<td class="">' + val.userComplaint + '</td>' +
                            '<td class="">' + val.userHPC + '</td>' +
                            '<td class="">' + val.userPMH + '</td>' +
                            '<td class="">' + val.doctorSuggest + '</td>' +
                            '<td class="">' + val.treatTime + '</td>' +
                            ' <td><a href="javascript:;" class="treatRecordDetail_a" onclick="detailTreatRecord(' + val.userId + ',' + val.doctorId + ')">查看详情</a></td></tr>';
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
                var inse = '<div id="user_detail_treat_record_parent">' +
                    '<table  id="get_user_detail_treat_record" cellpadding="0" cellspacing="0">' +
                    '<tr ><th colspan="2" >个人就诊记录</th></tr>' +
                    '<tr><td >姓名</td><td >' + data.userName + '</td></tr>' +
                    '<tr><td >主诉</td><td >' + data.userComplaint + '</td></tr>' +
                    '<tr><td >现病史</td><td >' + data.userHPC + '</td></tr>' +
                    '<tr><td >医生建议</td><td >' + data.doctorSuggest + '</td></tr>' +
                    '<tr><td >就诊时间</td><td >' + data.treatTime + '</td></tr></table></div>';
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
                    if (key == 0) {  //只显示列表中第一个患者可以被接诊
                        inshtml += '<tr><td>'
                            + (key + 1)
                            + '</td><td>'
                            + (val.userName ? val.userName : "")
                            + '</td><td class="user_tel">'
                            + (val.sex == 0 ? "男" : (val.sex == 1 ? "女" : "未知"))
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
                            + (val.sex == 0 ? "男" : (val.sex == 1 ? "女" : "未知"))
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
    //推送成功后，隐藏接诊图片
    $("#get_user_line").find('#jiezhen_button').css({'display': 'none'});
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
                    userhtml += '<table class="user_detail" cellspacing="0" cellpadding="0">' +
                        '<tr ><td colspan="6"  class="title">用户基本信息</td></tr>' +
                        '<tr><td>姓名:</td><td>'
                        + data.userInfo.userName
                        + '</td><td>年龄:</td><td>'
                        + data.userInfo.birthday
                        + '</td><td>性别:</td><td>'
                        + (data.userInfo.sex == 0 ? "男" : (data.userInfo.sex == 1 ? "女" : "未知"))
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
                    userhtml += '<table><tr ><td colspan="6"  class="report_card_info title">自述卡信息</td></tr>' +
                        '<tr><td>自述卡名称：</td><td colspan="5">' + data.reportCardInfo.reportCardName + '</td></tr>' +
                        '<tr><td>自述卡描述：</td><td id="reportCardDescribe" colspan="5"><div>' + data.reportCardInfo.reportCardDescribe + '</div></td></tr>' +
                        '<tr><td colspan="6" class="title">自述卡图片：</td></tr>';
                    for (key in data.reportCardInfo['reportCardImages']) {
                        userhtml += '<tr id="imglist"><td  colspan="2" class="limit_reportCardImage"><a href="#" class="img_a">' +
                            '<img  width="180" height="200"  src="' + data.reportCardInfo['reportCardImages'][key] + '" alt="暂无"/></a></td></tr>';
                    }
                    userhtml += '</table>';
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
                            + (data.userInfo.sex == 0 ? "男" : (data.userInfo.sex == 1 ? "女" : "未知"))
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
    getUserDetail();
    $("#userDetail-reportCard").click(function () {
        getUserDetail();
    })

})

//病历填写
function upTreatRecord() {
    var userId = $("#userIdUp").val();
    var userComplaint = $("#userComplaint").val();
    var userHPC = $("#userHPC").val();
    var doctorSuggest = $("#doctorSuggest").val();
    var remark = $("#remark").val();
    var reportCardId = $("#reportCardIdUp").val();
    $('#userComplaint').trigger('blur');
    $('#userHPC').trigger('blur');
    $('#doctorSuggest').trigger('blur');
    if (!zsok || !xbsok || !ysjyok) {
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
        alert(userId)
        alert(reportCardId)
        $.ajax({
            url: app + '/TreatRecordPut/index',
            type: "post",
            data: {
                userId: userId,
                userComplaint: userComplaint,
                userHPC: userHPC,
                doctorSuggest: doctorSuggest,
                smokingHistory: smokingHistory,
                allergyHistory: allergyHistory,
                remark: remark,
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

//结束视频
function disconnect() {
    var uid = document.getElementById("userIdUp").value;
    if (confirm("确定结束视频吗？")) {
        $.ajax({
            url: app + '/Treat/disconnect',
            type: "post",
            data: {
                uid: uid,
                did: did
            },
            dataType: "json",
            success: function (data) {
                if (data.RespResult == 0) {
                    //alert("ddddddddd");
                    document.getElementById("guaduan").style.display = "none";//隐藏
                    session.disconnect();
                    // document.getElementById("publisherContainer1").innerHTML = '';
                    // publisher.destroy();
                    uid2 = 0;
                    get_user_line();
                    //  myHistory();
                    //myHistory22();
                    document.getElementById('nob').style.background = "url(" + root + "/Public/images/nob.png)";
                    connectionCount = 0;
                } else {
                    alert("结束视频失败！");
                    //location.href='my_login.html?url='+window.location.href;
                }
            },
            error: function (data) {
                alert(data);
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

var ShowImage = function () {
    xOffset = 10;
    yOffset = 30;
    $("#imglist").find("img").hover(function (e) {
        $("<img id='imgshow' src='" + this.src + "' />").appendTo("body");
        //下面是两种样式赋值方法
        //$("#imgshow").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px").fadeIn("slow");
        $("#imgshow").css({"top": (e.pageY - xOffset) + "px", "left": (e.pageX + yOffset) + "px"}).fadeIn("slow");
    }, function () {
        $("#imgshow").remove();
    });
};


jQuery(document).ready(function () {
    ShowImage();
});