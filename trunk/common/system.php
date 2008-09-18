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

	if(!defined("IN_SIMHR"))
	{
		exit("You Make a mistake on page of <font color=\"#ff0000\"><i>".basename($HTTP_SERVER_VARS['PHP_SELF']).'</i></font><BR><BR>Please Visit : <a href=\'http://www.php365.cn\' target=\'_blank\'>http://www.php365.cn</a>');
	}

	/*
	//+--------------------------
	//+	config system environment
	//+--------------------------
	*/
	$tpldir = 'template/default';
	$htmltpldir = 'template/default/html/';
	$imgdir = 'images/default/';
	$htmlroot = 'htmldata/';
	$charset = 'gb2312';
	$tablewidth = '778';

	$shownewcom = '1';
	$shownewper = '1';


	$ad_info = '1';
	$flink_info = '1';
	$flink_num_row = '8';
	$gzip_info = '1';
	$process_info = '1';
	$online_info = '0';
	$onlinetime = '900';
	$mailreg = '0';
	$cookieway = '1';
	$cookietime = '3600';

	$sendjob_time = '1';// company
	$sendfind_time = '2';
	$sendhunterjob_time = '3';// company
	$sendhunterfind_time = '4';

	/*
	//+---------------------------------
	//+	config html file for user submit
	//+---------------------------------
	*/
	$html_job = '1';										//	招聘
	$default_job = 'default_job.html';						//	招聘
	$html_find = '1';										//	求职
	$default_find = 'default_find.html';					//	求职
	$html_perhunter = '1';									//	猎头人才
	$default_perhunter = 'default_perhunter.html';			//	猎头人才
	$html_comhunter = '1';									//	猎头职位
	$default_comhunter = 'default_comhunter.html';			//	猎头职位
	$html_findteacher = '1';								//	招聘家教
	$default_findteacher = 'default_teacherjob.html';		//	招聘家教
	$html_taketeacher = '1';								//	求职家教
	$default_taketeacher = 'default_teacherfind.html';		//	求职家教
	$html_hunterinfo = '1';									//	猎头资迅
	$default_hunterinfo = 'default_hunterinfo.html';		//	猎头资迅
	$html_news = '1';										//	新闻动态
	$default_news = 'default_news.html';					//	新闻动态
	$html_law = '1';										//	政策法规
	$default_law = 'default_law.html';						//	政策法规
	$html_way = '1';										//	求职攻略
	$default_way = 'default_way.html';						//	求职攻略

	$html_school = '1';										//	培训学校
	$default_school = 'default_school.html';				//	培训学校
	$html_lesson = '1';										//	培训课程
	$default_lesson = 'default_lesson.html';				//	培训课程

	$dirhtml_unit = 'Ym';
	$dirhtml_job = 'job';					//	招聘
	$dirhtml_find = 'find';					//	求职
	$dirhtml_com = 'com';					//	企业简历
	$dirhtml_per = 'per';					//	个人简历
	$dirhtml_comhunter = 'comhunter';		//	猎头职位
	$dirhtml_perhunter = 'perhunter';		//	猎头人才
	$dirhtml_findteacher = 'teacherjob';	//	招聘家教
	$dirhtml_taketeacher = 'teacherfind';	//	求职家教
	$dirhtml_hunterinfo = 'hunterinfo';		//	猎头资迅
	$dirhtml_news = 'news';					//	新闻动态
	$dirhtml_law = 'law';					//	政策法规
	$dirhtml_way = 'way';					//	求职攻略

	$dirhtml_school = 'school';				//	培训学校
	$dirhtml_lesson = 'lesson';				//	培训课程

	/*
	//+----------------------------------
	//+	config string long of index.php
	//+----------------------------------
	*/
	$string_job = '30';						//	招聘
	$string_find = '30';					//	求职

	$string_company = '20';					//	企业名称
	$string_personal = '8';					//	个人姓名

	$string_hunterjob = '24';				//	猎头职位
	$string_hunterfind = '24';				//	猎头人才
	$string_hunterinfo = '18';				//	猎头资迅

	$string_school = '40';					//	培训学校
	$string_lesson = '26';					//	培训课程

	$string_teacherjob = '30';				//	家教职位
	$string_teacherfind = '40';				//	家教人才

	$string_news = '34';					//	新闻
	$string_way = '98';					//	求职攻略
	$string_law = '98';					//	政策法规



	/*
	//+----------------------------------
	//+	config water mark for user submit
	//+----------------------------------
	*/
	$phototype = 'jpg,gif,png,bmp,swf';			//	图片格式
	$watermark = '0';							//	是否水印	(0->否		1->是)
	$watertype = '1';							//	水印类型	(0->文字	1->图片)
	$waterstring = 'http://www.php365.cn';		//	水印文字
	$waterimg = 'images/water.gif';				//	水印图片
	$water_width = '143';						//	水印图片宽度	(px)
	$water_height = '30';						//	水印图片高度	(px)
	$water_position = '1';						//	水印位置	(0->4)


	/*
	//+----------------------
	//+	config show info nums
	//+----------------------
	*/
	$num_job_list = '20';			// 每页显示	job.php
	$num_find_list = '20';			// 每页显示	find.php

	$num_comhunter_list = '20';		// 每页显示	hunter.php?action=job
	$num_perhunter_list = '20';		// 每页显示	hunter.php?action=find
	$num_hunterinfo_list = '20';	// 每页显示	hunter.php?action=info

	$num_school_list = '20';		// 每页显示	learn.php?action=school
	$num_lesson_list = '20';		// 每页显示	learn.php?action=lesson

	$num_putteach_list = '20'; 		// 每页显示	teacher.php?action=job
	$num_findteach_list = '20'; 	// 每页显示	teacher.php?action=find

	$num_jobnewphp_list = '20';		// 每页显示	news.php
	$num_jobwayphp_list = '20';		// 每页显示	jobway.php
	$num_joblawphp_list = '20';		// 每页显示	joblaw.php

	//+	cache num

	$num_new_company = '12'; 		//+ 最新企业	(缓存数量)
	$num_new_personal = '12'; 		//+ 最新个人	(缓存数量)

	$num_job = '5';					//+	最新招聘	(缓存数量)
	$num_find = '5';				//+	最新求职	(缓存数量)

	$num_comhunter = '10';			//+	最新猎头职位	(缓存数量)
	$num_perhunter = '10';			//+ 最新猎头人才	(缓存数量)
	$num_hunterinfo = '5';			//+	最新猎头咨询	(缓存数量)

	$num_putteacher = '10';			//+	最新家教求职	(缓存数量)
	$num_findteacher = '10';		//+	最新家教招聘	(缓存数量)

	$num_schools = '5'; 			//+	每一学校分类显示最新学校	(缓存数量)
	$num_lesson = '6';				//+	最新培训课程	(缓存数量)

	$num_news = '6';				//+	最新动态	(缓存数量)
	$num_way = '5';					//+	最新攻略	(缓存数量)
	$num_law = '5';					//+	最新法规	(缓存数量)

	/*
	//+---------------------------
	//+	config user kind of system
	//+---------------------------
	*/
	$time_job = 'Y-n-j';
	$time_find = 'Y-n-j';
	$time_hunterjob = 'Y-n-j';
	$time_hunterfind = 'Y-n-j';
	$time_hunterinfo = 'm-d';
	$time_lesson = 'Y-n-j';
	$time_putteacher = 'Y-n-j';
	$time_findteacher = 'Y-n-j';
	$time_news = 'm-d';
	$time_way = 'm-d';
	$time_law = 'm-d';

	/*
	//+---------------------------
	//+	config user kind of system
	//+---------------------------
	*/
	$kind_mem 	= 	'0';		// 个人用户
	$kind_mem_1 = 	'1';		// 验证用户
	$kind_com 	= 	'2';		// 企业用户
	$kind_vip_0 = 	'0';		// VIP 用户
	$kind_vip_1 = 	'1';		// VIP 用户
	$kind_admin	=	'-1';		// 管理员

	/*
	//+--------------------------------
	//+	check user url fro submit ahead
	//+--------------------------------
	*/
	$qstr=$HTTP_SERVER_VARS['QUERY_STRING'];
	$backurl='http://'.($HTTP_SERVER_VARS['SERVER_NAME'] ? $HTTP_SERVER_VARS['SERVER_NAME'] : $HTTP_SERVER_VARS['HTTP_HOST']).($HTTP_SERVER_VARS['PHP_SELF'] ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_SERVER_VARS['SCRIPT_NAME']).'?'.$qstr;
?>