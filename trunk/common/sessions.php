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
	|   > Date started: 2004/12/13
	+--------------------------------------------------------------------------
	*/

	if(!defined("IN_SIMHR"))
	{
		exit("You have take a mistake!");
	}

	/*
	+---------------------------
	+	delete old sessons
	+---------------------------
	*/
	$online=time()-86400;
	is_int(date("i",time())/($onlinetime/60))	?	$db->query("DELETE FROM ".SESSIONTABLE." WHERE activetime <= '$online'")	:	'';

	/*
	+---------------------------
	+	sesson url
	+---------------------------
	*/
	$linkurl=$HTTP_SERVER_VARS['PHP_SELF'] ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_SERVER_VARS['SCRIPT_NAME'];
	$sessurl=basename($linkurl,'.php');

	/*
	+---------------------------
	+	session exists
	+---------------------------
	*/
	if ($wane_hash=='')
	{
		$sessid=md5(microtime().getenv('REMOTE_ADDR').rand('1000000001','9999999999'));
		setcookie('jspace_hash',$sessid,'0',$cookdomain,$cookpath);
		$db->query("INSERT INTO ".SESSIONTABLE." (sessid,username,activetime,linkurl,ipadd) VALUES ('$sessid','$wane_user','".time()."','$sessurl','".getenv('REMOTE_ADDR')."')");
	}
	else
	{
		$db->query("UPDATE ".SESSIONTABLE." SET username='$wane_user',activetime='".time()."',linkurl='$sessurl',ipadd='".getenv('REMOTE_ADDR')."' where sessid='$wane_hash' or username='$wane_user'");
	}

?>
