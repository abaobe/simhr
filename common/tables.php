<?php

	/*
	+--------------------------------------------------------------------------
	|   Technology of SimPHP
	|   ========================================
	|   Powered by PHP365.CN
	|   (c) 2007 php365.cn Power Services
	|   http://www.php365.cn
	|   ========================================
	|   Web: http://www.php365.cn
	|   Email: webmaster@ewannan.com
	|   Phone: 0553-2237136 , (0)13966013721
	|	QQ:	39053386
	|	MSN: fuyibing1@hotmail.com
	+--------------------------------------------------------------------------
	|   > Date started: 2004/10/10
	+--------------------------------------------------------------------------
	*/

	if(!defined("IN_SIMHR")) { exit("You Make a mistake on page of <font color=\"#ff0000\"><i>".basename($HTTP_SERVER_VARS['PHP_SELF']).'</i></font><BR><BR>Please Visit : <a href=\'http://www.php365.cn\' target=\'_blank\'>http://www.php365.cn</a>');}
	define('USERTABLE',$tablepre.'member'); // 用户注册表
	define('SESSIONTABLE',$tablepre.'session'); // 在线 记录表

	define('JIANLITABLE',$tablepre.'jianli'); // 个人简历表
	define('QYJIANLITABLE',$tablepre.'jianliqy'); // 企业简历表

	define('JOBTABLE',$tablepre.'job_chance'); // 招聘信息表
	define('FINDJOBTABLE',$tablepre.'findjob_chance'); // 求职信息表
	define('HUNTERJOB',$tablepre.'hunter_com');	// 猎头职位
	define('HUNTERFIND',$tablepre.'hunter_per'); // 猎头人才
	define('HUNTERINFO',$tablepre.'hunter_info');

	define('PERSENDTABLE',$tablepre.'per_send'); // 个人发表求职信息
	define('REPERSENDTABLE',$tablepre.'re_send'); // 个人发表求职信息回复
	define('PERRECTABLE',$tablepre.'per_rec'); // 企业发表招聘信息
	define('REPERRECTABLE',$tablepre.'re_rec'); // 企业发表招聘信息回复

	define('FAVTABLE',$tablepre.'job_fav'); // 企业，个人用户收藏夹
	define('FAVHUNTER',$tablepre.'find_fav'); // 企业，个人用户收藏夹


	define('NEWSTABLE',$tablepre.'index_news');
	define('WAYTABLE',$tablepre.'job_way');
	define('LAWTABLE',$tablepre.'job_law');
?>