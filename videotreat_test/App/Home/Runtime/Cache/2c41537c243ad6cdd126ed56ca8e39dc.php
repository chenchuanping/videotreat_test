<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>医生详情</title>
    <link href="__PUBLIC__/css/meeting.css?v=1.2.0" rel='stylesheet' type='text/css'/>
    <link href="__PUBLIC__/css/public.css" rel='stylesheet' type='text/css'/>
    <link href="__PUBLIC__/css/doctor.css" rel='stylesheet' type='text/css'/>
    <link href="__PUBLIC__/css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link href="__PUBLIC__/css/form_check.css" type="text/css" rel="stylesheet">
    <link href="__PUBLIC__/css/dropkick.css" type="text/css" rel="stylesheet">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="__PUBLIC__/js/jquery.dropkick-min.js"></script>
</head>
<body>
<!--js-->
<script>
    var doctorId = "<?php echo ($_SESSION['userMsg']['doctorId']); ?>";
    var app = "__APP__";
    var root = "__ROOT__";
    var vendorKey = '<?php echo ($vendorKey); ?>';
    var room = '<?php echo ($room); ?>';
    var resolution = '<?php echo ($resolution); ?>';
    var get_line_time = '<?php echo ($get_line_time); ?>';
    $(function () {
        $('#doctorState').dropkick();
        $('.get_user_line').trigger('click');
        $("#tabs").tabs();
        $('button').button();
        $('.radioset').buttonset();
        $("#dialog").dialog({
            autoOpen: false,
            width: 500,
            height: 420
        });
        $("#modify").click(function (event) {
            $("#dialog").dialog("open");
            event.preventDefault();
        });

    })
</script>

<div id="header" class="clear">
    <div id="header_left"></div>
    <div id="header_right">
        <ul id="header_list">
            <li style="width: 100px;"><span id="doctorName">欢迎您，<?php echo ($_SESSION['userMsg']['doctorName']); ?></span></li>
            <li>
                <select id="doctorState">
                    <?php if($_SESSION['userMsg']['stateId']== 1): ?><option value="1" selected="selected">在线</option>
                        <option value="2">忙碌</option>
                        <?php elseif($_SESSION['userMsg']['stateId']== 2): ?>
                        <option value="1">在线</option>
                        <option value="2" selected="selected">忙碌</option><?php endif; ?>
                </select>
            </li>
            <li><a href="javascript:;" onClick="logout()" class="header_link">安全退出</a></li>
            <li><a href="javascript:;" class="treatRecordHistory" id="treatRecordHistory">就诊历史</a></li>
            <li><a href="#" class="header_link" id="modify">修改密码</a></li>
            <div id="dialog" title="修改密码">
                <iframe name="adPageFrame" frameborder="0" scrolling="hidden" width="400px" height="300px"
                        src="<?php echo U('Password/index');?>?doctorId=<?php echo ($doctorId); ?>"></iframe>
            </div>
        </ul>
    </div>
</div>
<div id="content" class="clear">
    <div id="content_left">
        <div id="user_line">
            <span>待诊患者列表</span>
            <a class="get_user_line" href="#">刷新患者列表</a>
            <div id="linehtml"></div>
        </div>
    </div>
    <div id="content_right">
        <div id="tabs">
            <ul>
                <li id="userDetail-reportCard"><a href="#tabs-1"> 基本信息-自述单</a></li>
                <li id="treatRecord"><a href="#tabs-2">病历填写</a></li>
                <li id="treatHistory"><a href="#tabs-3">就诊记录</a></li>
                <input type="hidden" id="userIdUp" value=""/>
                <input type="hidden" id="doctorIdUp" value="<?php echo ($_SESSION['userMsg']['doctorId']); ?>"/>
                <input type="hidden" id="reportCardIdUp" value=""/>
            </ul>
            <!--个人信息详情-->
            <div id="tabs-1" class="userDetail">
                <!--自述卡详情-->
                <!--<div class="reportCardDetail"></div>-->
            </div>
            <!--自述卡详情-->
            <div class="reportCardDetail"></div>
            <!--个人就诊详情-->
            <div id="tabs-3" class="treatRecordDetail"></div>
            <!--医生就诊意见-->
            <div id="tabs-2" class="treatRecordAgree">
                <table id="treatRecordAgree">
                    <div class="radioset">吸烟史:
                        &nbsp;
                        <input type="radio" name="smokingHistory" id="radio1" class="noSmoking" value="0" checked/>
                        <label for="radio1">无</label>
                        <input type="radio" name="smokingHistory" id="radio2" value="1"/>
                        <label for="radio2">有</label>
                        &nbsp;&nbsp;&nbsp;</div>
                    <div class="radioset">
                        过敏史:
                        &nbsp;
                        <input type="radio" name="allergyHistory" id="radio3" class="noAllergy" value="0" checked/>
                        <label for="radio3">无</label>
                        <input type="radio" id="radio4" name="allergyHistory" value="1"/>
                        <label for="radio4">有</label>
                    </div>
                    <tr>
                        <td><label for="userComplaint">主诉：</label></td>
                    </tr>
                    <tr>
                        <td><textarea name="userComplaint" cols="65" rows="4" id="userComplaint"></textarea>
                            <div class="err_tip">
                                <div class="dis_box"><em class="icon_error"></em><span></span></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font_type"><label for="userHPC">现病史：</label></td>
                    </tr>
                    <tr>
                        <td><textarea name="userHPC" cols="65" rows="4" id="userHPC"></textarea>
                            <div class="err_tip">
                                <div class="dis_box"><em class="icon_error"></em><span></span></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font_type"><label for="doctorSuggest">医生建议：</label></td>
                    </tr>
                    <tr>
                        <td><textarea name="doctorSuggest" cols="65" rows="4" id="doctorSuggest"></textarea>
                            <div class="err_tip">
                                <div class="dis_box"><em class="icon_error"></em><span></span></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font_type"><label for="remark">备注：</label></td>
                    </tr>
                    <tr>
                        <td><textarea name="remark" cols="65" rows="4" id="remark" placeholder="选填"></textarea></td>
                    </tr>
                    <tr>
                        <td align="center">
                            <button onClick="upTreatRecord();">提交</button>
                            <button type="reset">重置</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div id="footer">
    <div class="copy">
        <p>Copyright 2016. name All rights reserved.</p>
    </div>
</div>
<script src="__ROOT__/Public/js/doctor.js"></script>
</body>
</html>