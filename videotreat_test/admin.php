<?php

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
//定义项目名称
define('APP_NAME','videotreat_test');
//定义应用目录
define('APP_PATH','App/Admin/');
//指定项目根目录
define('__ROOT__','/videotreat_test');
// 引入ThinkPHP入口文件
require 'library/ThinkPHP/ThinkPHP.php';
