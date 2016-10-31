<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
    <link rel="stylesheet" type="text/css" href="__ROOT__/Public/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__ROOT__/Public/css/login.css"/>
    <script src="__ROOT__/Public/js/jquery.js"></script>
    <script src="__ROOT__/Public/js/jquery.validate-min.js"></script>
    <script src="__PUBLIC__/js/login.js"></script>
    <script type="text/javascript">
        $(function() {
            //提交验证
            $('.sub').click(function () {
                $('input[name=managerName]').trigger('blur');
                $('input[name=pwd]').trigger('blur');
                if (nameok && pwdok) {
                    document.frm.action = '__APP__/Login/checkLogin';
                } else {
                    return false;
                }
            })
        })
        /*        function checkLogin(){
         if(document.frm.dname.value==''){
         alert('请输入用户名');
         document.frm.dname.focus();
         return false;
         }
         if(document.frm.dpass.value==''){
         alert('请输入密码');
         document.frm.dpass.focus();
         return false;
         }
         }
         function login(){
         document.frm.action='__APP__/Login/checkLogin';
         document.frm.submit();
         }
         function register(){
         window.location.href='__APP__/Register/index';
         }*/
    </script>
</head>
<body class="login_body">
<div class="login_div">
    <form  name="frm"  class="login" method="post" >

        <div class="inputbg">
            <input type="text" name="managerName" id="tel" placeholder="用户名"  />
        </div>
        <div class="err_tip">
            <div class="dis_box"><em class="icon_error"></em><span></span></div>
        </div>
        <div class="inputbg">
            <input type="password" name="pwd" id="dpass"  placeholder="密码"  />
        </div>
        <div class="err_tip">
            <div class="dis_box"><em class="icon_error"></em><span></span></div>
        </div>
        <button value="登录" class="loginon sub" type="submit" >登录</button>
        <button value="重置"  class="loginon reset" type="reset" class="loginon" >重置</button>
    </form>
</div>
</body>
</html>