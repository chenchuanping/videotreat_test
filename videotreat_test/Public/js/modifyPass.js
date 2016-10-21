
function modifyPassword(){
    if(document.frm.old_password.value==''){
        alert('请输入旧密码');
        document.frm.dname.focus();
        return false;
    }
    if(document.frm.new_password.value==''){
        alert('请输入新密码');
        document.frm.new_password.focus();
        return false;
    }
    if(document.frm.new_password_confirmation.value==''){
        alert('请输入确认密码');
        document.frm.new_password.focus();
        return false;
    }
    if(document.frm.new_password.value.length<6||document.frm.new_password.value.length>18){
        alert('密码长度不符合6-18位之间，请重新输入！');
        document.frm.new_password.focus();
        document.frm.new_password.value='';
        document.frm.new_password_confirmation.value='';
        return false;
    }
    if(document.frm.new_password_confirmation.value!=document.frm.new_password.value){
        alert('两次密码不一致，请重新输入！');
        document.frm.new_password_confirmation.focus();
        document.frm.new_password_confirmation.value='';
        return false;
    }

    document.frm.submit();
}
