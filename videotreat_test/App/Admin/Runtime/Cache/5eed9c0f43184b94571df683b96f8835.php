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
    <link rel="stylesheet" href="__PUBLIC__/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/add_doctor.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>
</head>
<body>
<div id="content">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 医师信息添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                </div></div>
        <form action="__APP__/AddDoctor/add" method="post" enctype="multipart/form-data">
            <table id="doctor_list" border="1" >
                <tr>
                    <td class="td_left">姓名</td>
                    <td class="td_right"><input class="td_right" type="text" name="doctorName" required></td>
                </tr>
                <tr>
                    <td class="td_left">密码</td>
                    <td><input class="td_right" type="password" name="password" required></td>
                </tr>
                <tr>
                    <td class="td_left">手机号</td>
                    <td><input   class="td_right" type="text" name="tel" required ></td>
                </tr>
                <tr>
                    <td class="td_left">性别</td>
                    <td>
                        <select name="sex" required  class="doctor_select">
                            <option value="0">男</option>
                            <option value="1">女</option>
                            <option value="2">其他</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">年龄</td>
                    <td>
                        <input   class="td_right" type="text" name="age" required >
                    </td>
                </tr>
                <tr>
                    <td class="td_left">职称</td>
                    <td>
                        <select name="profess" required  class="doctor_select">
                            <?php if(is_array($professInfo)): foreach($professInfo as $key=>$v): ?><option value="<?php echo ($v["professId"]); ?>"><?php echo ($v["professName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">科室</td>
                    <td>
                        <select name="department" required  class="doctor_select">
                            <?php if(is_array($departmentInfo)): foreach($departmentInfo as $key=>$v): ?><option value="<?php echo ($v["departmentId"]); ?>"><?php echo ($v["departmentName"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">医生头像</td>
                    <td>
                        <input  type="file" name="headPic" >
                    </td>
                </tr>
                <tr>
                    <td class="td_left">标签</td>
                    <td class="labelList">
                        <?php if(is_array($labelInfo)): foreach($labelInfo as $key=>$v): ?><input  type="checkbox" name="labelArray[]" value="<?php echo ($v["labelId"]); ?>" ><?php echo ($v["labelName"]); endforeach; endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">特长</td>
                    <td>
                        <textarea name="special" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">简介</td>
                    <td>
                        <textarea name="profile" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">所属医院</td>
                    <td>
                        <select name="hospitalId"  class="doctor_select" >
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

<script src="__ROOT__/Public/js/jquery.validate.js"></script>
<script>
    $(function(){
        $('#frm').validate();
    });
</script>
</body>
</html>