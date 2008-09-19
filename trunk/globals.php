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
	|   > Last modify: 2004-12-31
	+-------------------------------------------
	*/

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	set_magic_quotes_runtime(0);
	define ('IN_SIMHR',true);
    header('Content-Type: text/html; charset=utf-8');

	/*
	+----------------------------------
	+	load config file
	+----------------------------------
	*/
	require_once "config.inc.php";
	require_once "common/system.php";
	if ($gzip_info=='1')
	{
		ob_start('ob_gzhandler');
		$pagegzipinfo="and Gzip enable";
	}
	else
	{
		$pagegzipinfo="and Gzip disabled";
	}

	/*
	+----------------------------------
	+	load source file
	+----------------------------------
	*/
	require_once "lang/lang_".$charset.".php";		//	lang file
	require_once "common/tables.php";				//	tables file
	require_once "common/".$database."_class.php";	//	sql class file
	require_once "common/function.php";				//	global functions file

	/*
	+----------------------------------
	+	global function reset
	+----------------------------------
	*/
	$register_globals = @ini_get('register_globals');
	$magic_quotes_gpc = get_magic_quotes_gpc();
	if(!$register_globals || !$magic_quotes_gpc)
	{
		@extract(slashes($HTTP_POST_VARS), EXTR_SKIP);
		@extract(slashes($HTTP_GET_VARS), EXTR_SKIP);
	}

	/*
	+----------------------------------
	+	connect to sql server
	+----------------------------------
	*/
	$db = new wanedb;
	$db->connect();

	/*
	+----------------------------------
	+	check user is logined
	+----------------------------------
	*/
	$wane_user=slashes($HTTP_COOKIE_VARS['wwwwanenet_user']);
	$wane_pass=slashes($HTTP_COOKIE_VARS['wwwwanenet_pass']);
	$wane_hash=slashes($HTTP_COOKIE_VARS['jspace_hash']);
	if ($wane_user!='' || $wane_pass!='')
	{
		$sql_logined=$db->query("select * from ".USERTABLE." where username='$wane_user' and password='$wane_pass'");
		if ($db->num($sql_logined)<='0')
		{
			$userinfo=array();
			wane_set_cookie(1);
			unset($userinfo);
			$user_cfg=array(
				'logined'	=>	'0',
				'kind'		=>	'0',
				'logins'	=>	'0',
				'vip'		=>	'0',
				'info'		=>	'0',
				'guest'		=>	'1',
			);
		}
		else
		{
			$row_logined=$db->row($sql_logined);
			$user_cfg['logined']='1';
			$user_cfg['kind']=$row_logined['kind'];
			$user_cfg['logins']=$row_logined['logins'];
			$user_cfg=array(
				'logined'	=>	'1',
				'kind'		=>	$row_logined[kind],
				'logins'	=>	$row_logined[logins],
				'vip'		=>	$row_logined[vip],
				'info'		=>	$row_logined[info_sign],
				'guest'		=>	'0',
			);
		}
	}
	else
	{
		$user_cfg=array(
			'logined'	=>	'0',
			'kind'		=>	'0',
			'logins'	=>	'0',
			'vip'		=>	'0',
			'info'		=>	'0',
			'guest'		=>	'1',
		);
	}

	/*
	+----------------------------------
	+	load right source
	+----------------------------------
	*/
	$right_source='common/right/right'.right_source().'.php';
	!file_exists($right_source)	?	exit('Access denied.')	:	'';
	require $right_source;
	unset($right_source);

	/*
	+----------------------------------
	+	load template file
	+----------------------------------
	*/
	require_once "common/template.php";
	$tpl = new Template($tpldir);

	/*
	+----------------------------------
	+	load advertisement file
	+----------------------------------
	*/
	$ad_file	=	'common/cache/cache_ad.php';
	if ($ad_info && file_exists($ad_file))
	{
		require $ad_file;
	}
	unset($ad_file);
	/*
	+----------------------------------
	+	count online info
	+----------------------------------
	*/
	if ($online_info)
	{
		require_once "common/sessions.php";
		$query_sess=$db->query("select sessid,username,activetime from ".SESSIONTABLE." where activetime > '".(time()-$onlinetime)."'");
		$totalsesss=$db->num($query_sess);
		$membersesss=0;
		while ($row_sess=$db->row($query_sess))
		{
			$row_sess[username]	?	$membersesss+=1	:	'';
		}
		$tpl->set_var("ONLINE_INFOS","当前在线 ".$totalsesss." , 会员 ".$membersesss);
	}
	$DEBUG = new DEBUG;
	$starter = $DEBUG->starttime();
?>