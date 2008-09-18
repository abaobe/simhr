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
	|   > Date started: 2004/11/14
	+--------------------------------------------------------------------------
	*/

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	define ('IN_SIMHR',true);
	set_magic_quotes_runtime(0);
	require_once "../config.inc.php";
	require_once "../common/system.php";
	require_once "../common/tables.php";
	require_once "../common/".$database."_class.php";
	require_once "../common/function.php";
	$install_file='../install/install.php';
	if (file_exists($install_file))
	{
		/*delete_file($install_file);
		if (file_exists($delete_file))
		{*/
			exit('Please delete install.php by FTP way .');
		/*}*/
	}
	require_once "../lang/lang_gb2312.php";
	$register_globals = ini_get('register_globals');
	$magic_quotes_gpc = get_magic_quotes_gpc();
	if(!$register_globals || !$magic_quotes_gpc)
	{
		@extract(slashes($HTTP_POST_VARS), EXTR_SKIP);
		@extract(slashes($HTTP_GET_VARS), EXTR_SKIP);
	}
	$wane_user=slashes($HTTP_COOKIE_VARS['wwwwanenet_user']);
	$wane_pass=slashes($HTTP_COOKIE_VARS['wwwwanenet_pass']);
	$db = new wanedb;
	$db->connect();
	$wane_user=slashes($HTTP_COOKIE_VARS['wwwwanenet_user']);
	$wane_pass=slashes($HTTP_COOKIE_VARS['wwwwanenet_pass']);
	if ($wane_user!='' && $wane_pass!='')
	{
		$sql_logined=$db->query("select * from ".USERTABLE." where username='$wane_user' and password='$wane_pass'");
		if ($db->num($sql_logined)<='0')
		{
			$userinfo=array();
			wane_set_cookie(1);
			$user_cfg=array(
				'logined'	=>	'0',
				'kind'		=>	'0',
				'logins'	=>	'0',
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
				'kind'		=>	$row_logined['kind'],
				'logins'	=>	$row_logined['logins']
			);
		}
	}
	else
	{
		$user_cfg=array(
			'logined'	=>	'0',
			'kind'		=>	'0',
			'logins'	=>	'0',
		);
	}
	if (basename($HTTP_SERVER_VARS['PHP_SELF'] ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_SERVER_VARS['SCRIPT_NAME'],'.php')!='database')
	{
		require '../common/create_html.php';
		$c_html=new C_HTML;
		$HTML_TPL = new HTMLTPL;
	}
?>