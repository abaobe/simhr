<?php
	/*
	+-------------------------------------------
	|   Technology of SimPHP
	|   ========================================
	|   Powered by PHP365.CN
	|   (c) 2007 php365.cn Power Services
	|   http://www.php365.cn
	|   ========================================
	|   Web: http://www.php365.cn
	+-------------------------------------------
	|   > Last modify: 2004-12-31	06:49
	+-------------------------------------------
	*/

	$mail_kind = 1;				//		0	=>	禁用email功能
								//		1	=>	通过 PHP 函数及 UNIX sendmail 发送(推荐此方式)
								//		2	=>	通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)
								//		3	=>	通过 PHP 函数 SMTP 发送 Email(仅 win32 下有效, 不支持 ESMTP)
	if($mail_kind == 2)
	{
		$mailcfg['server'] = 'smtp.21cn.com';					// SMTP 服务器
		$mailcfg['port'] = '25';								// SMTP 端口, 默认不需修改
		$mailcfg['auth'] = 1;									// 是否需要 AUTH LOGIN 验证, 1=是, 0=否
		$mailcfg['from'] = 'wwwwanenet <youraccount@21cn.com>';	// 发信人地址 (如果需要验证,必须为本服务器地址)
		$mailcfg['auth_username'] = 'wwwwanenet_user';			// 验证用户名
		$mailcfg['auth_password'] = 'wwwwanenet_pass';			// 验证密码
	}
	elseif($mail_kind == 3)
	{
		$mailcfg['server'] = 'localhost';			// SMTP 服务器, 以下设置仅对 WIN32 系统有效
		$mailcfg['port'] = '25';					// SMTP 端口, 默认不需修改
	}
?>