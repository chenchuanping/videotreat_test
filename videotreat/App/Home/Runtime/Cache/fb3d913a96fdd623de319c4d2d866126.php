<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>就诊历史</title>
    <link href="__PUBLIC__/css/public.css" rel='stylesheet' type='text/css'/>
    <link href="__PUBLIC__/css/treatHistory.css" rel='stylesheet' type='text/css'/>
    <link href="__PUBLIC__/css/dropkick.css" type="text/css" rel="stylesheet">
    <link href="__PUBLIC__/css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/table.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/panels.css" media="screen">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/form.css" media="screen">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="__PUBLIC__/js/jquery.dropkick-min.js"></script>
    <script src="__PUBLIC__/js/doctor.js"></script>
</head>
<body>
<!--js-->
<script>
    var doctorId = "<?php echo ($_SESSION['userMsg']['doctorId']); ?>";
    var app = "__APP__";
    var root = "__ROOT__";
    $(function () {
        $('#doctorState').dropkick();
        $('.get_user_line').trigger('click');
        $("#tabs").tabs();
        $('button').button();
        $('.radioset').buttonset();
        $('#treatRecordDetail').dialog(
                {
                    autoOpen: false,
                    width: 500,
                    height: 500
                });
        $(".treatRecordDetail_a").click(function (event) {
            $("#treatRecordDetail").dialog("open");
            event.preventDefault();
        });
        $("#dialog").dialog({
            autoOpen: false,
            width: 500,
            height: 420
        });
        $("#modify").click(function (event) {
            $("#dialog").dialog("open");
            event.preventDefault();
        });
        $('#content').css('width','1000px');
    })

</script>

<div id="header" class="clear">
    <div id="header_left"></div>
    <div id="header_right">
        <ul id="header_list">
            <li style="width: 100px;"><span id="doctorName"><?php echo ($_SESSION['userMsg']['doctorName']); ?> 医师</span></li>
            <li><a href="javascript:;" onClick="logout()" class="header_link">安全退出</a></li>
            <li><a href="#" class="treatRecordHistory" id="treatRecordHistory">接诊历史</a></li>
            <li><a href="#" class="header_link" id="modify">修改密码</a></li>
            <li><a href="#" class="header_link" id="goback_headPage">返回首页</a></li>
            <div id="dialog" title="修改密码">
                <iframe name="adPageFrame" frameborder="0" scrolling="hidden" width="400px" height="300px"
                        src="<?php echo U('Password/index');?>?doctorId=<?php echo ($doctorId); ?>"></iframe>
            </div>
        </ul>
    </div>
</div>
<div id="content" class="clear" >

    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 就诊历史</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form action="<?php echo U('TreatRecordHistory/index');?>" method="get">
                <div role="id" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">

                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>搜索:
                            <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="<?php echo ($keywords); ?>">
            			<span class="btn-group">
                            <button class="btn" type="submit"><span class="ui-icon ui-icon-search"></span></button>
                        </span>
                        </label>
                    </div>
                    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10%;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">编号
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10%;" aria-label="Browser: activate to sort column ascending">姓名
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10%;" aria-label="Browser: activate to sort column ascending">手机号
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10%;" aria-label="Platform(s): activate to sort column ascending">性别
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10%;" aria-label="Platform(s): activate to sort column ascending">年龄
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width:30%;" aria-label="Platform(s): activate to sort column ascending">时间
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10%;" aria-label="CSS grade: activate to sort column ascending">操作
                            </th>
                        </tr>
                        </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all"  style="text-align:center;width:100%">
                        <?php if(is_array($treatRecordHistory)): foreach($treatRecordHistory as $k=>$v): ?><tr class="odd">
                                <td class="sorting_1"><?php echo ($k+1); ?></td>
                                <td class=" "><?php echo ($v["userName"]); ?></td>
                                <td class=" "><?php echo ($v["tel"]); ?></td>
                                <td class=" "><?php echo ($v["sex"]); ?></td>
                                <td class=" "><?php echo ($v["birthday"]); ?></td>
                                <td class=" "><?php echo ($v["treatTime"]); ?></td>

                                <td class=" ">
                                    <span class="btn-group">
                                       <a href="javascript:;" class="treatRecordDetail_a" onclick="detailTreatRecord(<?php echo ($v["userId"]); ?>,<?php echo ($v["treatRecordId"]); ?>)">查看详情</a>
                                    </span>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    <div class="dataTables_info" id="DataTables_Table_1_info">显示 <?php echo ($start); ?> 到 <?php echo ($end); ?> &nbsp;&nbsp;总共<?php echo ($count); ?>条数据</div>
                    <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                        <div id="pages">
                            <?php echo ($page); ?>
                        </div>
                    </div>
                </div>
            </form></div>
    </div>





    <!--显示单次的就诊详情-->
    <div id="treatRecordDetail"></div>
</div>
<div id="footer">
    <div class="copy">
        <p>Copyright 2016. name All rights reserved.</p>
    </div>
</div>
</body>
</html>