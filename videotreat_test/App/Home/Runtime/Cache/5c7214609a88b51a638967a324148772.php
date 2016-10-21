<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
    <link href="__PUBLIC__/css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="__ROOT__/Public/css/mod_pass_style.css"/>
    <script src="__ROOT__/Public/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/jquery-ui-1.10.3.custom.js"></script>
    <script>
        $(function(){
            $('button').button();
        })
        function modifyPassword(){
            if(document.frm.old_password.value==''){
                alert('请输入旧密码');
                document.frm.dname.focus();
                return false;
            }
            if(document.frm.new_password.value==''){
                alert('请输入新密码');
                document.frm.new_password.focus();
                return false;
            }
            if(document.frm.new_password_confirmation.value==''){
                alert('请输入确认密码');
                document.frm.new_password.focus();
                return false;
            }
            if(document.frm.new_password.value.length<6||document.frm.new_password.value.length>18){
                alert('密码长度不符合6-18位之间，请重新输入！');
                document.frm.new_password.focus();
                document.frm.new_password.value='';
                document.frm.new_password_confirmation.value='';
                return false;
            }
            if(document.frm.new_password_confirmation.value!=document.frm.new_password.value){
                alert('两次密码不一致，请重新输入！');
                document.frm.new_password_confirmation.focus();
                document.frm.new_password_confirmation.value='';
                return false;
            }
            document.frm.action='__APP__/Password/modifyPassword/doctorId/'+<?php echo ($_SESSION['userMsg']['doctorId']); ?>;
            document.frm.submit();
        }

    </script>
<!--</head>-->
<!--<body class="modify_body" >-->
<div class="modify_div">
    <form  name="frm"  class="modify" method="post" >
        <table   cellpadding="5px" cellspacing="5px">
            <tr style="text-align: center; margin: 20px;">
                <td colspan="2" style="font-size:18px;color:#FF0000"><?php echo ($doctorName); ?>,您好,请修改密码</td>
            </tr>
            <tr>
                <th style="width:100px;" >旧密码：
                </th>
                <td style="width:300px;" >
                    <input type="password" name="old_password"  id="old_password"  style="width:200px;height: 25px;">
                </td>
            </tr>
            <tr>
                <th >
                    新密码：
                </th>
                <td>
                    <input type="password" name="new_password" id="new_password" placeholder="  密码长度在6-18位之间" style="width:200px;height: 25px;" />
                </td>
            </tr>
            <tr>
                <th style="width:250px;" >
                    确认新密码：
                </th>
                <td >
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"  style="width:200px;height: 25px;"/>
                </td>
            </tr>
            <tr align="left">
                <td ></td><td>
                    <button class="modify_btn" onClick="modifyPassword();">提交</button>
                    <button class="modify_btn" type="reset">重置</button>

                </td>
                <td style="padding-left:20%;" >
                    <!--<a href="__APP__/Doctor/index/doctorId/<?php echo ($doctorId); ?>" target="_self">放弃修改</a>-->
                </td>
            </tr>
        </table>
    </form>
</div>


<!--</body>-->
<!--</html>-->