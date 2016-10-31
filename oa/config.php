<?php
// +----------------------------------------------------------------------
// | ThinkPHP                                                             
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.      
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>                                  
// +----------------------------------------------------------------------
// $Id$

return array(
    'DB_TYPE' => 'mysql',  //数据库类型
    'DB_HOST' => 'localhost',//主机名
    'DB_NAME' => 'oa',//数据库名
    'DB_USER' => 'root',//用户名
    'DB_PWD' => '',//密码
    'DB_PORT' => '3306',//数据库端口
    'DB_PREFIX' => '',//是否有表前缀
    'WEB_LOG_RECORD' => true,//是否记录Log
    'DEBUG_MODE' => false,
    'ROUTER_ON' => true,
    'URL_MODEL' => 1,
    'APP_DOMAIN_DEPLOY' => true,
    'URL_CASE_INSENSITIVE' => false, // URL是否不区分大小写
    'CHECK_FILE_CASE' => true, // 是否检查文件的大小写 对Windows平台有效
    'DB_CASE_LOWER' => false, //隐式参数，ORACLE返回数据集，键名大小写，默认强制为true小写，以适应TP Model类如count方法等
    'APP_DOMAIN_DEPLOY' => false,     // 是否使用独立域名部署项目
    'DEFAULT_MODULE' => 'Public', // 默认模块名称
    'DEFAULT_ACTION' => 'login',
    'TABLE_NAME_IDENTIFY' => false // 模型对应数据表名称智能识别 UserType => user_type
);

?>
