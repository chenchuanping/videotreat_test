<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/admin.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/table.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/panels.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/form.css" media="screen">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/icon.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>

    <link rel="stylesheet" href="__ROOT__/Public/admin_css/recyle_bin.css">
    <script>
        var app="__APP__";
        $(function(){
            $('#hsz').tabs({
                onSelect : function (title,index) {
                    if(index==0){
                        display_hospital();
                    }else if(index==1){
                        display_doctor();
                    }
                }
            });
            display_hospital();
        })

    </script>
</head>
<body>

<div id="content">
    <!--<input type="button" value="医院回收站" onclick="display_hospital()" class="button orange bigrounded">-->
    <!--<input type="button" value="医生回收站" onclick="display_doctor()" class="button orange bigrounded">-->

    <div id="hsz" >
        <div id="hospital_recycle" title="医院回收站" >
        </div>
        <div id="doctor_recycle" title="医生回收站">
        </div>

        <script src="__PUBLIC__/js/admin.js"></script>
    </div>
    </div>
</body>
</html>