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
	require 'config.inc.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	define('IN_SIMHR',1);
	require 'common/mysql_class.php';
	$db=new wanedb;
	$db->connect();
	$info=addslashes($HTTP_GET_VARS['info']);
	$action=addslashes($HTTP_GET_VARS['action']);
	if ($action=='news')
	{//+	更新新闻访问量
		$db->query("UPDATE {$tablepre}index_news set click=click+'1' where id='$info'");
	}
	else if ($action=='jobway')
	{
		$db->query("UPDATE {$tablepre}job_way set click=click+'1' where id='$info'");
	}
	else if ($action=='joblaw')
	{
		$db->query("UPDATE {$tablepre}job_law set click=click+'1' where id='$info'");
	}
	else if ($action=='job')
	{
		$db->query("UPDATE {$tablepre}job_chance set click=click+'1' where id='$info'");
	}
	else if ($action=='find')
	{
		$db->query("UPDATE {$tablepre}findjob_chance set click=click+'1' where id='$info'");
	}
	else if ($action=='hunterfind')
	{
		$db->query("UPDATE {$tablepre}hunter_per set click=click+'1' where id='$info'");
	}
	else if ($action=='hunterjob')
	{
		$db->query("UPDATE {$tablepre}hunter_com set click=click+'1' where id='$info'");
	}
	elseif ($action=='hunterinfo')
	{
		$db->query("UPDATE {$tablepre}hunter_info set click=click+'1' where id='$info'");
	}
	else if ($action=='school')
	{
		$db->query("UPDATE {$tablepre}pxschool SET click=click+'1' where id='$info'");
	}
	else if ($action=='lesson')
	{
		$db->query("UPDATE {$tablepre}job_peixun SET click=click+'1' where id='$info'");
	}
	else if ($action=='teacherjob')
	{
		$db->query("UPDATE {$tablepre}teacher_job SET click=click+'1' where id='$info'");
	}
	else if ($action=='teacherfind')
	{
		$db->query("UPDATE {$tablepre}teacher_find SET click=click+'1' where id='$info'");
	}








?>