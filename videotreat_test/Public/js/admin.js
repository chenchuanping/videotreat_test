//回收站，初始化都不显示
function init_recycle(){
    $("#hospital_recycle").css("display","none");
    $("#doctor_recycle").css("display","none");
}
function display_hospital(){
    $("#hospital_recycle").css("display","block");
    $("#doctor_recycle").css("display","none");
    $.ajax({
        url : app+'/RecycleBin/restore',
        type : "post",
        dataType : "json",
        data : {type:'hospital'},
        success : function(data) {
            var inshtml = '<div><table class="recyle_table"><tr ><th>医院Id</th><th>医院名称</th><th>操作</th></tr>';
            if (typeof (data) != null) {
                $.each(data,function(key, val) {
                        inshtml += '<tr><td>'+val.hospitalId+'</td><td>'+val.hospitalName+'</td><td> ' +
                            '<input type="button" class="button orange bigrounded" onclick="restore_hospital('+val.hospitalId+')" value="恢复"></td></tr>';
                });
            }else{
                inshtml += "<tr><td colspan='3'>暂无数据</td></tr>"
            }
            inshtml += '</table></div>';
            $("#hospital_recycle").html(inshtml);
        }
    });
}
function display_doctor(){
    $("#doctor_recycle").css("display","block");
    $("#hospital_recycle").css("display","none");
    $.ajax({
        url : app+'/RecycleBin/restore',
        type : "post",
        dataType : "json",
        data : {type:'doctor'},
        success : function(data) {
            var inshtml = '<div><table class="recyle_table"><tr ><th>医生Id</th><th>医生姓名</th><th>操作</th></tr>';
            if (typeof (data) != null) {
                $.each(data,function(key, val) {
                    inshtml += '<tr><td>'+val.doctorId+'</td><td>'+val.doctorName+'</td><td> ' +
                        '<input type="button" class="button orange bigrounded" onclick="restore_doctor('+val.doctorId+')" value="恢复"></td></tr>';
                });
            }else{
                inshtml += "<tr><td colspan='3'>暂无数据</td></tr>"
            }
            inshtml += '</table></div>';
            $("#doctor_recycle").html(inshtml);
        }
    });
}
function restore_hospital(id){
    $.ajax({
        url : app+'/RecycleBin/restoreHospital',
        type : "post",
        dataType : "json",
        data : {hospitalId : id},
        success : function(data) {
            if (data==1) {
                alert('恢复成功');
            }else {
                alert('恢复失败');
            }
        }
    });
}
function restore_doctor(id){
    $.ajax({
        url : app+'/RecycleBin/restoreDoctor',
        type : "post",
        dataType : "json",
        data : {doctorId : id},
        success : function(data) {
            if (data==1) {
                alert('恢复成功');
            }else {
                alert('恢复失败');
            }
        }
    });
}
