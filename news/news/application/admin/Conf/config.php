<?php
return array(
	/* 显示页面的trace信息 */
	'SHOW_PAGE_TRACE'  =>true,
	
	/* 默认设定 */
    'DEFAULT_MODULE'        => 'Admin', // 默认模块名称
    'DEFAULT_ACTION'        => 'index', // 默认操作名称
    
    /* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'news',          // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => '',          // 密码
    'DB_PORT'               => '',        // 端口 计算机软件与互联网进行交互的通道
    'DB_PREFIX'             => '',    // 数据库表前缀
	'DB_FIELDTYPE_CHECK'    => true,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       => false,        // 启用字段缓存
    
	/* 错误设置 */
	'ERROR_MESSAGE'         => '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
	'ERROR_PAGE'            => '',	// 错误定向页面
	'SHOW_ERROR_MSG'        => true,    // 显示错误信息
	'TRACE_EXCEPTION'       => true,   // TRACE错误信息是否抛异常 针对trace方法
	
	/* 日志设置 */
	'LOG_RECORD'            => false,   // 默认不记录日志
	'LOG_TYPE'              => 3, // 日志记录类型 0 系统 1 邮件 3 文件 4 SAPI 默认为文件方式
	'LOG_DEST'              => '', // 日志记录目标
	'LOG_EXTRA'             => '', // 日志记录额外信息
	'LOG_LEVEL'             => 'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
	'LOG_FILE_SIZE'         => 2097152,	// 日志文件大小限制
	'LOG_EXCEPTION_RECORD'  => true,    // 是否记录异常信息日志
		
		
    /* SESSION设置 */
    'SESSION_AUTO_START'    => true,    // 是否自动开启Session
    
	/* 模板引擎设置 */
	'TMPL_CONTENT_TYPE'     => 'text/html', // 默认模板输出类型
	'TMPL_ACTION_ERROR'     => 'Public:success', // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'   => 'Public:success', // 默认成功跳转对应的模板文件
	'TMPL_EXCEPTION_FILE'   => THINK_PATH.'Tpl/think_exception.tpl',// 异常页面的模板文件
	'TMPL_DETECT_THEME'     => false,       // 自动侦测模板主题
	'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀
	'TMPL_FILE_DEPR'        =>  '/', //模板文件MODULE_NAME与ACTION_NAME之间的分割符
		
	/* URL设置 */
	'URL_CASE_INSENSITIVE'  => false,   // 默认false 表示URL区分大小写 true则表示不区分大小写
	'URL_MODEL'             => 1,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
		// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
	'URL_PATHINFO_DEPR'     => '/',	// PATHINFO模式下，各参数之间的分割符号
	'URL_PATHINFO_FETCH'    =>   'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
	'URL_HTML_SUFFIX'       => 'html',  // URL伪静态后缀设置
	'URL_DENY_SUFFIX'       =>  'ico|png|gif|jpg', // URL禁止访问的后缀设置
	'URL_PARAMS_BIND'       =>  true, // URL变量绑定到Action方法参数
	'URL_404_REDIRECT'      =>  '', // 404 跳转页面 部署模式有效
		
);
?>