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
	|   > Date started: 2004/11/10
	+--------------------------------------------------------------------------
	*/

	if(!defined("IN_SIMHR")) { exit("You Make a mistake on page of <font color=\"#ff0000\"><i>".basename($HTTP_SERVER_VARS['PHP_SELF']).'</i></font><BR><BR>Please Visit : <a href=\'http://www.php365.cn\' target=\'_blank\'>http://www.php365.cn</a>');}
	$errmsg = '';
	$dberror = $this->error();
	$dberrno = $this->errno();
	if($dberrno == 1114)
	{
	?>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Wane Info  :  mySQL Error - Powered by SimPHP</title>
		<style type="text/css">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}
		body,td,th {
			font-size: 12px;
			color: #999999;
		}
		.tdbg {
			border-top-width: 1px;
			border-right-width: 1px;
			border-bottom-width: 1px;
			border-left-width: 1px;
			border-top-style: solid;
			border-right-style: solid;
			border-bottom-style: solid;
			border-left-style: solid;
			border-top-color: #CCCCCC;
			border-right-color: #CCCCCC;
			border-bottom-color: #CCCCCC;
			border-left-color: #CCCCCC;
		}
		-->
		</style>
		</head>
		<body>
		<table width="100%" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="center" valign="middle">
			<table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tdbg">
			  <tr>
				<td align="center" bgcolor="#f8f8f8"><table width="95%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="15"></td>
				  </tr>
				  <tr>
					<td><BR>Users onlines reached the upper limit</b><br><br><br>Sorry, the number of online users has reached the upper limit.<br>Please wait for a moment.<br><br></td>
				  </tr>
				  <tr>
					<td height="15"></td>
				  </tr>
				</table></td>
			  </tr>
			</table>
			</td>
		  </tr>
		</table>
		</body>
		</html>
	<?
		exit;
	}
	else
	{
		$wwwwanenet_user = $GLOBALS[HTTP_COOKIE_VARS][wwwwanenet_user];
		if($message)
		{
			$errmsg = "<b>Wane info</b>: $message\n\n";
		}
		if($wwwwanenet_user)
		{
			$errmsg .= "<b>User</b>: $wwwwanenet_user\n";
		}
		$errmsg .= "<b>Time</b>: ".date("Y-m-d H:i",time())."\n";
		$errmsg .= "<b>Script</b>: http://".$GLOBALS[HTTP_SERVER_VARS][HTTP_HOST].$GLOBALS[HTTP_SERVER_VARS][PHP_SELF]."\n\n";
		if($sql)
		{
			$errmsg .= "<b>SQL</b>: ".htmlspecialchars($sql)."\n";
		}
		$errmsg .= "<b>Error</b>:  $dberror\n";
		$errmsg .= "<b>Errno</b>:  $dberrno";
	?>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Wane Info  :  mySQL Query Error - Powered by SimPHP</title>
		<style type="text/css">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}
		body,td,th {
			font-size: 12px;
			color: #666666;
		}
		.tdbg {
			border-top-width: 1px;
			border-right-width: 1px;
			border-bottom-width: 1px;
			border-left-width: 1px;
			border-top-style: solid;
			border-right-style: solid;
			border-bottom-style: solid;
			border-left-style: solid;
			border-top-color: #CCCCCC;
			border-right-color: #CCCCCC;
			border-bottom-color: #CCCCCC;
			border-left-color: #CCCCCC;
		}
		-->
		</style>
		</head>
		<body>
		<table width="100%" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="center" valign="middle">
			<table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tdbg">
			  <tr>
				<td align="center" bgcolor="#f9f9f9"><table width="95%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="15"></td>
				  </tr>
				  <tr>
					<td><?=nl2br($errmsg)?></td>
				  </tr>
				  <tr>
					<td height="15"></td>
				  </tr>
				</table></td>
			  </tr>
			</table>
			</td>
		  </tr>
		</table>
		</body>
		</html>
	<?
		exit;
	}
?>