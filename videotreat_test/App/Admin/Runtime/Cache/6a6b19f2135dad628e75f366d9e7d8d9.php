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
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/add_manager.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>
</head>
<body onload="initialize()">

<div id="content">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 医院信息添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                </div></div>
        <form action="__APP__/AddManager/add" method="post" >
            <table table id="manager_list" border="0" cellspacing="0" cellpadding="0"  >
                <tr>
                    <td class="td_left">姓名</td>
                    <td><input class="td_right" type="text" name="managerName" required></td>
                </tr>
                <tr>
                    <td class="td_left">密码</td>
                    <td><input class="td_right" type="password" name="password" required></td>
                </tr>
                <tr>
                    <td class="td_left">角色</td>
                    <td class="td_right">
                        <select name="roleId"  class="hospital_select" id="manager_role">
                            <?php if(is_array($roleInfo)): foreach($roleInfo as $key=>$v): ?><option value="<?php echo ($v["roleId"]); ?>" ><?php echo ($v["roleName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">管理的医院</td>
                    <td class="td_right">
                        <select name="hospitalId"  class="hospital_select" id="manager_hospital" >
                            <?php if(is_array($hospitalInfo)): foreach($hospitalInfo as $key=>$v): ?><option value="<?php echo ($v["hospitalId"]); ?>" ><?php echo ($v["hospitalName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="easyui-linkbutton"data-options="iconCls:'icon-add'" type="submit"  value="添加" >添加</button>
                        <button class="easyui-linkbutton" data-options="iconCls:'icon-reload'"  type="reset"  value="重置">重置</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<script src="__ROOT__/Public/js/jquery.js"></script>
<script src="__ROOT__/Public/js/jquery.validate.js"></script>
<script>
   function initialize(){
       if($("#manager_role").val()==1){
           $("#manager_hospital").attr('disabled',true);
           $("#manager_hospital").css({"backgroundColor":"#009","color":"#fff"});
       }else{
           $("#manager_hospital").attr('disabled',false);
       }
       $(function(){
           $("#manager_role").change(function(){
               if($("#manager_role").val()==1){
                   $("#manager_hospital").attr('disabled',true);
               }else{
                   $("#manager_hospital").attr('disabled',false);
               }
           });
       });
    }
</script>
</body>
</html>