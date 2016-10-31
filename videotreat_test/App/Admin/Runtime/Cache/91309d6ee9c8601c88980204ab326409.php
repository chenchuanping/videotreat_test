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
    <link rel="stylesheet" href="__ROOT__/Public/admin_css/treat_history.css">
    <script>
        //点击了页码的超链接
        function setPage(currentPage) {
            document.frm.currentPage.value = currentPage;//设置页码
            document.frm.submit();//提交表单
        }
    </script>
</head>
<body>


<div id="content" style="overflow:auto;">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 就诊历史查询</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form name="frm" method="post" action="__APP__/TreatHistory/index">
                <input type="hidden" name="currentPage" value="1">
                <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">

                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>患者搜索：
                            <input id="searchHospital" type="text" name="keyword" size="20" value='<?php echo ($keyword); ?>'/>
                            <button class="easyui-linkbutton" data-options="iconCls:'icon-search'" type="submit"
                                    value="搜索">搜索
                            </button>
                        </label>
                    </div>
                </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
                   aria-describedby="DataTables_Table_1_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending"
                        aria-label="Rendering engine: activate to sort column descending">患者姓名
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">医师姓名
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">医院名称
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">科室
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:60px" aria-label="Platform(s): activate to sort column ascending">主诉
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:100px;" aria-label="Platform(s): activate to sort column ascending">现病史
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width:150px;" aria-label="Platform(s): activate to sort column ascending">既往史
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" aria-label="Platform(s): activate to sort column ascending">医生建议
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述卡内容
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述卡描述
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料1
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料2
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料3
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料4
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料5
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料6
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料7
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料8
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                        colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                        自述材料9
                    </th>
                </tr>
                </thead>
                <?php if($userTreatInfo != null): if(is_array($userTreatInfo)): foreach($userTreatInfo as $key=>$v): ?><tr>
                            <td>
                                <input type="text" value="<?php echo ($v["userName"]); ?>"></td>
                            <td>
                                <input type="text" value="<?php echo ($v["doctorName"]); ?>">
                            </td>
                            <td>
                                <input type="text" value="<?php echo ($v["hospitalName"]); ?>">
                            </td>
                            <td>
                                <input type="text" value="<?php echo ($v["departmentName"]); ?>">
                            </td>
                            <td>
                                <textarea><?php echo ($v["userComplaint"]); ?></textarea>
                            </td>
                            <td>
                                <textarea><?php echo ($v["userHPC"]); ?></textarea>
                            </td>
                            <td>
                                <textarea><?php echo ($v["userPMH"]); ?></textarea>
                            </td>
                            <td>
                                <textarea><?php echo ($v["doctorSuggest"]); ?></textarea>
                            </td>
                            <td>
                                <textarea><?php echo ($v["reportCardDescribe"]); ?></textarea>
                            </td>
                            <td>
                                <textarea><?php echo ($v["reportCardRemark"]); ?></textarea>
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_1"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_2"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_3"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_4"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_5"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_6"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_7"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_8"]); ?>" alt="无">
                            </td>
                            <td>
                                <img src="<?php echo ($v["image_9"]); ?>" alt="无">
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="19" id="pageSize">
                            <span style="float: left;font-size: 16px;">共有&nbsp;<?php echo ($totalRow); ?>&nbsp;条数据&nbsp;当前第&nbsp;<?php echo ($currentPage); ?>&nbsp;页/共&nbsp;<?php echo ($totalPage); ?>&nbsp;页</span>

                            <?php $__FOR_START_10647__=1;$__FOR_END_10647__=$totalPage+1;for($i=$__FOR_START_10647__;$i < $__FOR_END_10647__;$i+=1){ if($currentPage == $i): ?><span style="font-size: 16px;">[<?php echo ($i); ?>]</span>&nbsp;&nbsp;
                                    <?php else: ?>
                                    <a style="font-size: 14px;" href="#" onclick="setPage(<?php echo ($i); ?>)">[<?php echo ($i); ?>]</a>&nbsp;&nbsp;<?php endif; } ?>
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="19">暂无信息</td>
                    </tr><?php endif; ?>
            </table>
        </div>
        <script src="__ROOT__/Public/js/jquery.js"></script>
</body>
</html>