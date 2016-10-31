<?php
session_start();
include "VCode.class.php";
//实例化验证码类
$width = 80;
$height = 30;
$num = 4;

$code = new VCode($width,$height,$num);

//给$_SESSION['vcode']赋值 系统中产生的验证码
$_SESSION['vcode'] = $code->getCode();
//输出验证码
$code->showImg();
?>
