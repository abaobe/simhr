<html>
<head>
<title>论坛用户 转人才</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	color: #999999;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a {
	font-size: 12px;
	color: #999999;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #999999;
}
a:hover {
	text-decoration: none;
	color: #999999;
}
a:active {
	text-decoration: none;
	color: #999999;
}
input,select,textarea	{ font-family: Tahoma, Verdana; font-size: 9pt; color: #000000; font-weight: normal; background-color: #F8F8F8 }
-->
</style>
<script language="javascript">
function checkformdata()
{
	document.wane_post.Submit.disabled = true;
	return true;
}
</script>
</head>
<body>
<?
	if ($HTTP_GET_VARS['action']=='submit' && $HTTP_POST_VARS['usersubmit'])
	{
		$username	=	addslashes($HTTP_POST_VARS['username']);
		$password	=	md5(addslashes($HTTP_POST_VARS['password']));
		if (empty($username) || empty($password))
		{
			exit('Username or Password is empty');
		}
		else
		{
			define('IN_SIMHR',TRUE);
			require 'config.inc.php';
			require 'common/mysql_class.php';
			$db	=	new wanedb;
			$db->connect();
			if ($db->num($db->query("SELECT username,password FROM {$tablepre}member WHERE username='$username'")))
			{
				exit('The User has been exists.');
			}
			else
			{
				$query=$db->query("select name,password,email from {$bbspre}members where name='$username' and password='$password' limit 1");
				if (!$db->num($query))
				{
					exit('Username and Password is not matched.');
				}
				else
				{
					$row=$db->row($query);
					$db->query("INSERT INTO {$tablepre}member (username,password,email,kind,regtime) VALUES ('$row[name]','$row[password]','$row[email]','0','".time()."')");
					exit('Operate Success.<br><br><a href=\'javascript:window.close()\'>Close Window.</a>');
				}
			}
			$query	=	$db->query("SELECT * FROM ");
			echo 'Username = '.$username.' ; Password = '.$password;
		}

	}
	else
	{?>
	<table width="100%" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td align="center">
		<table width="300" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td bgcolor="#CCCCCC">

			<table width="100%" border="0" cellpadding="0" cellspacing="1">
			<form action="ipb.php?action=submit" method="post" name="wane_post" onsubmit="return checkformdata()">
			  <tr align="center" bgcolor="#FFFFFF">
				<td height="35" colspan="2">请填写您在论坛中的注册ID及登陆认证</td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td width="30%" height="30" align="center">用 户 名</td>
				<td height="30" align="center"><input name="username" type="text" id="username"></td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td height="30" align="center">登陆密码</td>
				<td height="30" align="center"><input name="password" type="password" id="password"></td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td height="30" colspan="2" align="center"><input type="submit" name="Submit" value="立即转换用户">
				  <input name="usersubmit" type="hidden" id="usersubmit" value="1"></td>
			  </tr>
			</form>
			</table>

			</td>
		  </tr>
		</table>
		</td>
	  </tr>
	</table>
	<? }
?>
</body>
</html>