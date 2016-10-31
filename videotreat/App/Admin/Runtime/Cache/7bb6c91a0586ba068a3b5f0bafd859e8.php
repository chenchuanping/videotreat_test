<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
    <link rel="stylesheet" type="text/css" href="__ROOT__/Public/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__ROOT__/Public/admin_css/login.css"/>
    <script src="__ROOT__/Public/js/jquery.js"></script>
    <script>
        function checkLogin() {
            if (document.frm.managerName.value == '') {
                alert('请输入用户名');
                document.frm.managerName.focus();
                return false;
            }
            if (document.frm.pwd.value == '') {
                alert('请输入密码');
                document.frm.pwd.focus();
                return false;
            }
            return true;
        }
        function login() {
            if (!checkLogin()) {
                return false;
            }
            document.frm.action = '__APP__/Login/checkLogin';
            document.frm.submit();
        }
    </script>
</head>
<body class="login_body">
<div class="login_div">
    <form name="frm" class="login" method="post">
        <div class="nav">
            <div class="nav login_nav">
                <div class="login_usernameInput">
                    <input type="text" name="managerName" id="managerName" placeholder="用户名"/>
                </div>
            </div>
            <div class="nav login_psdNav">
                <div>
                    <input type="password" name="pwd" id="pwd" placeholder="密码"/>
                </div>
            </div>
            <div class="login_btn_div">
                <img src="__ROOT__/Public/images/loginButton.png" onclick="login()">
            </div>
        </div>
    </form>
</div>
</body>
</html>