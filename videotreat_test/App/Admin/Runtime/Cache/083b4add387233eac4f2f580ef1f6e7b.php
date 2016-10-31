<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__ROOT__/Public/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/table.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/panels.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/form.css" media="screen">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/icon.css">
    <link rel="stylesheet" href="__PUBLIC__/admin_css/admin.css">
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/manager_info.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>

    <!--js-->
    <script>
        function modifyManager(managerId, hospitalId) {
            window.location = "__APP__/ModifyManager/index/managerId/" + managerId + "/hospitalId/" + hospitalId;
        }
        function deleteManager(managerId, hospitalId) {
            if (confirm("是否删除该医院？")) {
                window.location = "__APP__/ModifyManager/delete/managerId/" + managerId + "/hospitalId/" + hospitalId;
            }
        }
        function addManager() {
            window.location = "__APP__/AddManager/index";
        }
        //点击了页码的超链接
        function setPage(currentPage) {
            document.frm.currentPage.value = currentPage;//设置页码
            document.frm.submit();//提交表单
        }
    </script>
</head>
<body>

<div id="content">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 管理员信息管理</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form name="frm" method="post" action="__APP__/ManagerInfo/index">
                <input type="hidden" name="currentPage" value="1">
                <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">

                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>管理员搜索：
                            <input id="searchHospital" type="text" name="keyword" size="20" value='<?php echo ($keyword); ?>'/>
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-search'" type="submit"
                                    value="搜索">搜索
                            </button>
                            <?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'"
                                   onclick="addManager()">添加</a><?php endif; ?>
                        </label>
                    </div>
                </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
                   aria-describedby="DataTables_Table_1_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 60px;" aria-sort="ascending"
                        aria-label="Rendering engine: activate to sort column descending">编号
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">姓名
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">角色
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">
                        管理的医院
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">操作
                    </th>
                </tr>
                </thead>

                <?php if($managerInfo != null): if(is_array($managerInfo)): foreach($managerInfo as $k=>$v): ?><tr>
                            <td><?php echo ($k+1); ?></td>
                            <td><?php echo ($v["managerName"]); ?></td>
                            <td><?php echo ($v["roleName"]); ?></td>
                            <td><?php echo ($v["hospitalName"]); ?></td>
                            <td>
                                <?php if($v["hospitalId"] != all): ?><a class="easyui-linkbutton" data-options="iconCls:'icon-edit'"
                                       onclick="modifyManager('<?php echo ($v["managerId"]); ?>','<?php echo ($v["hospitalId"]); ?>')">修改</a><?php endif; ?>
                                <a class="easyui-linkbutton" data-options="iconCls:'icon-no'"
                                   onclick="deleteManager('<?php echo ($v["managerId"]); ?>','<?php echo ($v["hospitalId"]); ?>')">停用</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="5" id="pageSize">
                            <span style="float: left;font-size: 16px;">共有&nbsp;<?php echo ($totalRow); ?>&nbsp;条数据&nbsp;当前第&nbsp;<?php echo ($currentPage); ?>&nbsp;页/共&nbsp;<?php echo ($totalPage); ?>&nbsp;页</span>
                            <?php $__FOR_START_7141__=1;$__FOR_END_7141__=$totalPage+1;for($i=$__FOR_START_7141__;$i < $__FOR_END_7141__;$i+=1){ if($currentPage == $i): ?><span style="font-size: 16px;">[<?php echo ($i); ?>]</span>&nbsp;&nbsp;
                                    <?php else: ?>
                                    <a style="font-size: 14px;" href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="5">暂无信息</td>
                    </tr><?php endif; ?>
            </table>
        </div>
        <script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>