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
    <link rel="stylesheet" href="__PUBLIC__/admin_css/admin.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/doctor_info.css">
    <script>
        function deleteDoctor(id) {
            if (confirm("是否删除该医生？")) {
                window.location = "__APP__/ModifyDoctor/delete/doctorId/" + id;
            }
        }
        function addDoctor() {
            window.location = "__APP__/AddDoctor/index";
        }
        function modifyDoctor(id) {
            window.location = "__APP__/ModifyDoctor/index/doctorId/" + id;
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
            <span><i class="icon-table"></i> 医院信息管理</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form name="frm" method="post" action="__APP__/DoctorInfo/index">
                <input type="hidden" name="currentPage" value="1">
                <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">

                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>医生搜索：
                            <input id="searchHospital" type="text" name="keyword" size="20" value='<?php echo ($keyword); ?>'/>
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-search'" type="submit"
                                    value="搜索">搜索
                            </button>
                            <?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'"
                                   onclick="addDoctor()">添加</a><?php endif; ?>
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
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">医师姓名
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 120px;" aria-label="Browser: activate to sort column ascending">医师图片
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">职称
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:60px" aria-label="Platform(s): activate to sort column ascending">科室
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:100px;" aria-label="Platform(s): activate to sort column ascending">标签
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:80px;" aria-label="Platform(s): activate to sort column ascending">特长
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" aria-label="Platform(s): activate to sort column ascending">简介
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">
                        所属医院
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">操作
                    </th>
                </tr>
                </thead>
                <?php if($doctorInfo != null): if(is_array($doctorInfo)): foreach($doctorInfo as $key=>$v): ?><tr>
                            <td><?php echo ($v["doctorId"]); ?></td>
                            <td><?php echo ($v["doctorName"]); ?></td>
                            <td>
                                <img class="headPic" src="<?php echo ($v["headPic"]); ?>" alt="暂无图片"/>
                            </td>
                            <td><?php echo ($v["professName"]); ?></td>
                            <td><?php echo ($v["departmentName"]); ?></td>
                            <td class="labelArray"><?php echo ($v["labelArray"]); ?></td>
                            <td><?php echo ($v["special"]); ?></td>
                            <td class="profile"><?php echo ($v["profile"]); ?></td>
                            <td><?php echo ($v["hospitalName"]); ?></td>
                            <td>
                                <a class="easyui-linkbutton" data-options="iconCls:'icon-no'"
                                   onclick="modifyDoctor('<?php echo ($v["doctorId"]); ?>')">修改</a>
                                <a class="easyui-linkbutton" data-options="iconCls:'icon-no'"
                                   onclick="deleteDoctor('<?php echo ($v["doctorId"]); ?>')">停用</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="10" id="pageSize">
                            <span style="float: left;font-size: 16px;">共有&nbsp;<?php echo ($totalRow); ?>&nbsp;条数据&nbsp;当前第&nbsp;<?php echo ($currentPage); ?>&nbsp;页/共&nbsp;<?php echo ($totalPage); ?>&nbsp;页</span>

                            <?php $__FOR_START_25860__=1;$__FOR_END_25860__=$totalPage+1;for($i=$__FOR_START_25860__;$i < $__FOR_END_25860__;$i+=1){ if($currentPage == $i): ?><span style="font-size: 16px;">[<?php echo ($i); ?>]</span>&nbsp;&nbsp;
                                    <?php else: ?>
                                    <a style="font-size: 14px;" href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="10">暂无信息</td>
                    </tr><?php endif; ?>
            </table>
        </div>

        <script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>