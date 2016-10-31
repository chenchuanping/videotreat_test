<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" style="overflow-x: hidden">
<head>
    <meta charset="UTF-8">
    <title>云医视讯管理系统</title>
    <link rel="stylesheet" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" href="__PUBLIC__/admin_css/hospital_info.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/table.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/panels.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/form.css" media="screen">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="__PUBLIC__/js/easyui/themes/icon.css">
    <link rel="stylesheet" href="__PUBLIC__/admin_css/admin.css">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/easyui/easyui.js"></script>
    <script>
        $(function () {
            $('.mws-table tbody  tr').mouseover(function () {
                $(this).css('background', '#ccc')
                        .mouseout(function () {
                            $(this).css('background', 'none')
                        })
            })
            $('.search').linkbutton();
        })
        function modifyHospital(id) {
            window.location = "__APP__/ModifyHospital/index/hospitalId/" + id;
        }
        function deleteHospital(id) {
            if (confirm("是否删除该医院？")) {
                window.location = "__APP__/ModifyHospital/delete/hospitalId/" + id;
            }
        }
        function addHospital() {
            window.location = "__APP__/AddHospital/index";
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
            <form name="frm" method="post" action="__APP__/HospitalInfo/index">
                <input type="hidden" name="currentPage" value="1">
                <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>医院搜索：
                            <input id="searchHospital" type="text" name="keyword" size="20" value='<?php echo ($keyword); ?>'/>
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-search'" type="submit"
                                    value="搜索">搜索
                            </button>
                            <?php if($_SESSION['userMsg']['systemAdmin']== 1): ?><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'"
                                   onclick="addHospital()">添加</a><?php endif; ?>
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
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">医院名称
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">医院Logo
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">
                        医院图片
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:60px" aria-label="Platform(s): activate to sort column ascending">医师数量
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:100px;" aria-label="Platform(s): activate to sort column ascending">标签
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:150px;" aria-label="Platform(s): activate to sort column ascending">
                        医院地址
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" aria-label="Platform(s): activate to sort column ascending">简介
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">操作
                    </th>
                </tr>
                </thead>

                <?php if($hospitalInfo != null): if(is_array($hospitalInfo)): foreach($hospitalInfo as $key=>$v): ?><tr>
                            <td><?php echo ($v["hospitalId"]); ?></td>
                            <td class="hospitalName"><?php echo ($v["hospitalName"]); ?></td>
                            <td>
                                <img class="hospital_image" src="<?php echo ($v["hospitalLogo"]); ?>" alt="暂无图片"/>
                            </td>
                            <td>
                                <img class="hospital_image" src="<?php echo ($v["hospitalImage"]); ?>" alt="暂无图片"/>
                            </td>
                            <td><?php echo ($v["doctorNumber"]); ?></td>
                            <td><?php echo ($v["labelArray"]); ?></td>
                            <td><?php echo ($v["hospitalAddress"]); ?></td>
                            <td><?php echo ($v["hospitalIntroduction"]); ?></td>
                            <td>
                                <button class="easyui-linkbutton" data-options="iconCls:'icon-edit'"
                                        onclick="modifyHospital('<?php echo ($v["hospitalId"]); ?>')" value="修改">修改
                                </button>
                                <button class="easyui-linkbutton" data-options="iconCls:'icon-no'"
                                        onclick="deleteHospital('<?php echo ($v["hospitalId"]); ?>')" value="停用">停用
                                </button>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="9" id="pageSize">
                            <span style="float: left;font-size: 16px;">共有&nbsp;<?php echo ($totalRow); ?>&nbsp;条数据&nbsp;当前第&nbsp;<?php echo ($currentPage); ?>&nbsp;页/共&nbsp;<?php echo ($totalPage); ?>&nbsp;页</span>
                            <?php $__FOR_START_22202__=1;$__FOR_END_22202__=$totalPage+1;for($i=$__FOR_START_22202__;$i < $__FOR_END_22202__;$i+=1){ if($currentPage == $i): ?><span style="font-size: 16px;">[<?php echo ($i); ?>]</span>&nbsp;&nbsp;
                                    <?php else: ?>
                                    <a style="font-size: 14px;" href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="9">暂无信息</td>
                    </tr><?php endif; ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>