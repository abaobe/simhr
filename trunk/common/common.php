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
	$tpl->set_var(
		array(
			'WEBTITLE'		=>	$headtitle,
			'ADMINEMAIL'	=>	$adminemail,
			'CHARSET'		=>	$charset,
			'TABLEWIDTH'	=>	$tablewidth,
			'TABLEWIDTH_2'	=>	$tablewidth_2,
			'IMGDIR'		=>	$imgdir,
			'TRBG'			=>	$trbg,
			'TRIMG'			=>	$trimg,
			'TRFONT'		=>	$trfont,
			'KIND_MEM'		=>	$kind_mem,
			'KIND_COM'		=>	$kind_com,
			'BACKURL'		=>	$backurl,
		)
	);


	if ($user_cfg['logined']!='0' && $user_cfg['logined']!='' &&  $user_cfg['kind']!='')
	{
		$loginedform="<table width=\"150\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
					  <tr>
						<td height=\"25\" align=\"right\">用户</td>
						<td height=\"25\" align=\"center\">".$wane_user."</td>
					  </tr>
					  <tr>
						<td height=\"25\" align=\"right\">类型</td>
						<td height=\"25\" align=\"center\">".getukind($user_cfg['kind'])."</td>
					  </tr>
					  <tr>
						<td height=\"25\" align=\"right\">积分</td>
						<td height=\"25\" align=\"center\">".$user_cfg['logins']."&nbsp;<a href=login.php?action=loginout>[退出]</a></td>
					  </tr>
					  <tr>
						<td height=\"25\" align=\"right\">I P</td>
						<td height=\"25\" align=\"center\">".getenv("REMOTE_ADDR")."</td>
					  </tr>
					</table>";
	}
	else
	{
		$loginedform="<table width=\"150\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
					<form action=\"login.php\" method=\"post\">
					  <tr>
						<td height=\"25\" align=\"right\">&nbsp;&nbsp;用户</td>
						<td height=\"25\" align=\"center\"><input name=\"username\" type=\"text\" class=\"input\" id=\"username\" size=\"12\"></td>
					  </tr>
					  <tr>
						<td height=\"25\" align=\"right\">&nbsp;&nbsp;密码</td>
						<td height=\"25\" align=\"center\"><input name=\"password\" type=\"password\" class=\"input\" id=\"password\" size=\"12\"></td>
					  </tr>
					  <tr align=\"center\">
						<td height=\"25\" colspan=\"2\"><input name=\"submit_login\" type=\"submit\" class=\"input\" id=\"submit_login\" value=\" 登 陆 \">&nbsp;<input type=\"hidden\" name=\"goto\" value=\"".$backurl."\">&nbsp;<input name=\"submit_reset\" type=\"reset\" class=\"input\" id=\"submit_reset\" value=\" 重 设 \"></td>
					  </tr>
					</form>
					  <tr align=\"center\">
						<td height=\"25\" colspan=\"2\"><a href=\"register.php\">用户注册</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"lose_pwd.php\">忘记密码</a></td>
					  </tr>
					</table>";
	}
	$tpl->set_var('USERINFO',$loginedform);
	unset($loginedform);
	$loginform="<table width=\"150\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
					<form action=\"login.php\" method=\"post\">
					  <tr>
						<td height=\"25\" align=\"right\">&nbsp;&nbsp;用户</td>
						<td height=\"25\" align=\"center\"><input name=\"username\" type=\"text\" class=\"input\" id=\"username\" size=\"12\"></td>
					  </tr>
					  <tr>
						<td height=\"25\" align=\"right\">&nbsp;&nbsp;密码</td>
						<td height=\"25\" align=\"center\"><input name=\"password\" type=\"password\" class=\"input\" id=\"password\" size=\"12\"></td>
					  </tr>
					  <tr align=\"center\">
						<td height=\"25\" colspan=\"2\"><input name=\"submit_login\" type=\"submit\" class=\"input\" id=\"submit_login\" value=\" 登 陆 \">&nbsp;<input type=\"hidden\" name=\"goto\" value=\"".($goto?$goto:$backurl)."\">&nbsp;<input name=\"submit_reset\" type=\"reset\" class=\"input\" id=\"submit_reset\" value=\" 重 设 \"></td>
					  </tr>
					</form>
					  <tr align=\"center\">
						<td height=\"25\" colspan=\"2\"><a href=\"register.php\">用户注册</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"lose_pwd.php\">忘记密码</a></td>
					  </tr>
					</table>";

?>