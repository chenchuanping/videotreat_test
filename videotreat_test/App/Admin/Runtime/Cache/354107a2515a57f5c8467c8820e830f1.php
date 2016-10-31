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
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/modify_hospital.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>
</head>
<body>

<div id="content">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 医院信息修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                </div>
            </div>
            <form action="__APP__/ModifyHospital/modify/hospitalId/<?php echo ($hospitalId); ?>" method="post"
                  enctype="multipart/form-data">
                <table id="hospital_list" border="1">
                    <tr>
                        <td class="td_left">医院名称</td>
                        <td colspan="2"><input class="td_right" type="text" name="hospitalName"
                                               value="<?php echo ($hospitalInfo["hospitalName"]); ?>"></td>
                    </tr>
                    <tr>
                        <td class="td_left">医院Logo</td>
                        <td colspan="2">
                            <img src="<?php echo ($hospitalInfo["hospitalLogo"]); ?>" alt="医院Logo">
                            <input type="file" name="hospitalLogo">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">医院图片</td>
                        <td colspan="2">
                            <img src="<?php echo ($hospitalInfo["hospitalImage"]); ?>" alt="医院图片">
                            <input type="file" name="hospitalImage">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">医师数量</td>
                        <td colspan="2"><input class="td_right" type="text" name="doctorNumber"
                                               value="<?php echo ($hospitalInfo["doctorNumber"]); ?>"></td>
                    </tr>
                    <tr>
                        <td class="td_left">医院地址</td>
                        <td colspan="2"><input class="td_right" type="text" name="hospitalAddress"
                                               value="<?php echo ($hospitalInfo["hospitalAddress"]); ?>"></td>
                    </tr>
                    <tr>
                        <td class="td_left">标签</td>
                        <td><input class="td_right" type="text" value="<?php echo ($hospitalInfo["labelArray"]); ?>" disabled="disabled">
                        </td>
                        <td class="labelList">
                            <?php if(is_array($labelInfo)): foreach($labelInfo as $key=>$v): ?><input type="checkbox" name="labelArray[]" value="<?php echo ($v["labelId"]); ?>"><?php echo ($v["labelName"]); endforeach; endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">简介</td>
                        <td colspan="2">
                            <textarea name="hospitalIntroduction"><?php echo ($hospitalInfo["hospitalIntroduction"]); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-edit'" type="submit"
                                    value="修改">修改
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