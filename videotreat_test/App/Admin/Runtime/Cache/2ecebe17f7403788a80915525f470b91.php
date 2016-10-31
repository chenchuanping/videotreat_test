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
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/icon.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/modify_manager.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>

</head>
<body>
<div id="content">

    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 管理员信息修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                </div></div>
            <span id="errorMsg"></span>
        <form  name="frm" action="__APP__/ModifyManager/modify" method="post">
            <table id="modifyManager" border="0" cellpadding="0" cellspacing="0" >
                <tr>
                    <td class="td_left">姓名</td>
                    <td colspan="2">
                        <input class="td_right" type="hidden" name="managerId" value="<?php echo ($managerInfo["managerId"]); ?>">
                        <input class="td_right" type="hidden" name="old_hospitalId" value="<?php echo ($managerInfo["hospitalId"]); ?>">
                        <input class="td_right" type="text" name="managerName" value="<?php echo ($managerInfo["managerName"]); ?>">
                    </td>
                </tr>
                <tr>
                    <td class="td_left">角色</td>
                    <td colspan="2"><input class="td_right" type="text" name="password" value="<?php echo ($managerInfo['roleName']); ?>" disabled></td>
                </tr>
                <tr>
                    <td class="td_left">管理的医院</td>
                    <td><input class="manager_hospital" type="text" name="checkPwd" value="<?php echo ($managerInfo["hospitalName"]); ?>" disabled></td>
                    <td>
                        <select class="manager_hospital" name="hospitalId">
                            <?php if(is_array($hospitalInfo)): foreach($hospitalInfo as $key=>$v): ?><option value="<?php echo ($v['hospitalId']); ?>"><?php echo ($v["hospitalName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button class="easyui-linkbutton"data-options="iconCls:'icon-add'" type="submit"  value="添加" >添加</button>
                        <button class="easyui-linkbutton" data-options="iconCls:'icon-reload'"  type="reset"  value="重置">重置</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>