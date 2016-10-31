<?php
header("content-type:text/html;charset=utf-8");
define("APP_NAME", "news");
define("APP_PATH", "application/admin/");//后台
define("APP_DEBUG", true);
define("__ROOT__", "/news");
include_once 'library/ThinkPHP/ThinkPHP.php';