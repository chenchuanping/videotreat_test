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
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/modify_doctor.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>

</head>
<body>
<div id="content">

    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>&nbsp;医生信息修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                </div>
            </div>
            <form name="frm" action="__APP__/ModifyDoctor/modify/doctorId/<?php echo ($doctorId); ?>" method="post"
                  enctype="multipart/form-data">
                <table id="modifyDoctor" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="td_left">姓名</td>
                        <td colspan="2">
                            <input class="td_right" type="text" name="doctorName" value="<?php echo ($doctorInfo["doctorName"]); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">头像</td>
                        <td colspan="2">
                            <img src="<?php echo ($doctorInfo["headPic"]); ?>" alt="医生头像">
                            <input type="file" name="headPic">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">手机号</td>
                        <td colspan="2">
                            <input class="td_right" type="text" name="tel" value="<?php echo ($doctorInfo["tel"]); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">职称</td>
                        <td>
                            <input class="td_right" type="text" name="professName" value="<?php echo ($doctorInfo["professName"]); ?>">
                        </td>
                        <td>
                            <select class="manager_hospital" name="professId">
                                <?php if(is_array($professInfo)): foreach($professInfo as $key=>$v): ?><option value="<?php echo ($v['professId']); ?>"><?php echo ($v["professName"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">科室</td>
                        <td>
                            <input class="td_right" type="text" name="departmentName"
                                   value="<?php echo ($doctorInfo["departmentName"]); ?>">
                        </td>
                        <td>
                            <select class="manager_hospital" name="professId">
                                <?php if(is_array($departmentInfo)): foreach($departmentInfo as $key=>$v): ?><option value="<?php echo ($v['departmentId']); ?>"><?php echo ($v["departmentName"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">性别</td>
                        <td>
                            <input class="td_right" type="text" name="sex" value="<?php echo ($doctorInfo["sex"]); ?>">
                        </td>
                        <td>
                            <select name="sex" required  class="doctor_select" >
                                <option value="0">男</option>
                                <option value="1">女</option>
                                <option value="2">其他</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">年龄</td>
                        <td colspan="2">
                            <input class="td_right" type="text" name="age" value="<?php echo ($doctorInfo["age"]); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">特长</td>
                        <td colspan="2">
                            <textarea name="special"  cols="30" rows="10"><?php echo ($doctorInfo["special"]); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">简介</td>
                        <td colspan="2">
                            <textarea name="special"   cols="30" rows="10"><?php echo ($doctorInfo["profile"]); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left">所属医院</td>
                        <td><input class="manager_hospital" type="text" name="checkPwd"
                                   value="<?php echo ($doctorInfo["hospitalName"]); ?>" disabled>
                        </td>
                        <td>
                            <select class="manager_hospital" name="hospitalId">
                                <?php if(is_array($hospitalInfo)): foreach($hospitalInfo as $key=>$v): ?><option value="<?php echo ($v['hospitalId']); ?>"><?php echo ($v["hospitalName"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-add'" type="submit"
                                    value="添加">修改
                            </button>
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-reload'" type="reset"
                                    value="重置">重置
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>