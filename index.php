<?php
	header('content-type:text/html;charset=utf-8');
		//define('APP_NAME','getsql');//项目名称
		define('APP_DEBUG',true);//开启调试模式
		define('APP_PATH','./application/');//应用程序目录
		define('COMMON_PATH','./Common/');
		
		// 绑定入口文件到Admin模块访问
		//define('BIND_MODULE','Admin');
		require '../ThinkPHP/ThinkPHP.php';
?>