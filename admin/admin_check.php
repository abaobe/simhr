<?php
	if (adminlogined()<='0')
	{
	?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="index,follow">
<meta name="keywords" content="SimHR,A_Space,F_Space,J_Space,H_Space,article,PHP,MySQL,Template">
<meta name="generator" content="SimHR V4.5 with Templates">
<meta name="description" content="SimHR - Powered by SimPHP">
<meta name="MSSmartTagsPreventParsing" content="TRUE">
<meta http-equiv="MSThemeCompatible" content="Yes">
<title><?php echo $webtitle;?> - Power by wan-e.net inc !</title>
<link href="images/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<table width="100%" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0" disabled>
      <tr>
        <td height="25" align="center">Prowered by <a href="http://www.php365.cn" target="_blank">wan-e.net</a> &copy; <a href="http://www.php365.cn" target="_blank">SimPHP</a> inc 2003-<?php echo date("Y");?></td>
      </tr>
    </table>
      <table width="500"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="18" height="16" align="right" valign="bottom"><img src="images/left_top.gif" width="18" height="16"></td>
        <td align="center" valign="bottom" background="images/row_top.gif"></td>
        <td width="14" align="left" valign="bottom"><img src="images/right_top.gif" width="14" height="16"></td>
      </tr>
      <tr>
        <td align="right" background="images/left_bg.gif">&nbsp;</td>
        <td align="center" valign="middle" background="images/main_bg.gif"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
            <tr>
              <td height="22" align="center" background="images/admin_tablebar.gif">[ + &nbsp;管理员登陆&nbsp;+ ]</td>
            </tr>
            <tr>
              <td align="center" bgcolor="#CCCCCC">
			  <table width="100%"  border="0" cellspacing="1" cellpadding="0">
			  <form action="../login.php" method="post">
                  <tr bgcolor="#F1F2F4">
                    <td width="20%" height="25" align="center">管理员用户</td>
                    <td height="25" align="center"><input name="username" type="text" class="input" id="username" size="50"></td>
                  </tr>
                  <tr bgcolor="#F1F2F4">
                    <td width="20%" height="25" align="center">管理员密码</td>
                    <td height="25" align="center"><input name="password" type="password" class="input" id="password" size="50"></td>
                  </tr>
                  <tr bgcolor="#F1F2F4">
                    <td height="30" colspan="2" align="center"><input name="goto" type="hidden" id="goto" value="<?php echo $backurl;?>">
                      <input name="submit_login" type="submit" class="input" id="submit_login" value=" 管 理 员 登 陆 "><input name="loginyes" type="hidden" id="loginyes" value="1"></td>
                    </tr>
				</form>
              </table></td>
            </tr>
          </table>
          </td>
        <td align="left" background="images/right_bg.gif">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top"><img src="images/left_down.gif" width="18" height="18"></td>
        <td align="center" valign="top" background="images/row_down.gif">&nbsp;</td>
        <td align="left" valign="top"><img src="images/right_down.gif" width="14" height="18"></td>
      </tr>
    </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0" disabled>
        <tr>
          <td height="25" align="center">联系 : QQ , 39053386 ; Tel,0553-2237136,(0)13966013721 ; </td>
        </tr>
        <tr>
          <td height="25" align="center">地址 : 芜湖南瑞新城沐春园47栋一单元402室 ; 邮编:241002</td>
        </tr>
        <tr>
          <td height="25" align="center">程序设计:付义兵.</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
	<?php
		exit;
	}
?>