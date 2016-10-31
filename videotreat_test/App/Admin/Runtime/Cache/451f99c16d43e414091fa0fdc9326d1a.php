<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/table.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/panels.css" media="screen">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/icon.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/add_manager.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/modify_myself.css">
    <script>
        function validate(){
            $("#errorMsg").html("");
            if(document.frm.managerName.value == "") {
                $("#errorMsg").html("请输入用户名！");
                document.frm.managerName.focus();
                return false;
            } else if(document.frm.password.value == "") {
                $("#errorMsg").html("请输入密码！");
                document.frm.password.focus();
                return false;
            } else if(document.frm.checkPwd.value != document.frm.password.value) {
                $("#errorMsg").html("两次输入的密码不一致！");
                document.frm.checkPwd.focus();
                return false;
            }
        }
    </script>
</head>
<body>

<div id="content">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 修改个人信息</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                </div></div>
        <span id="errorMsg"></span>
        <form  name="frm" action="__APP__/ModifyMyself/modify" method="post">
            <table id="modifyManager" border="1" >
                <tr>
                    <td class="td_left">姓名</td>
                    <td><input class="td_right" type="text" name="managerName" value="<?php echo ($managerName); ?>"></td>
                </tr>
                <tr>
                    <td  class="td_left">密码</td>
                    <td><input class="td_right" type="text" name="password"></td>
                </tr>
                <tr>
                    <td  class="td_left">确认密码</td>
                    <td><input class="td_right" type="text" name="checkPwd"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="easyui-linkbutton"data-options="iconCls:'icon-edit'" type="submit"   onclick="return validate()" value="修改" >修改</button>
                        <button class="easyui-linkbutton" data-options="iconCls:'icon-reload'"  type="reset"  value="重置">重置</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

<script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>