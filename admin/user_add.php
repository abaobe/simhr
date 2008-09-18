<?php
	require "admin_globals.php";
	require "admin_check.php";
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
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18" height="16" align="right" valign="bottom"><img src="images/left_top.gif" width="18" height="16"></td>
    <td align="center" valign="bottom" background="images/row_top.gif"></td>
    <td width="14" align="left" valign="bottom"><img src="images/right_top.gif" width="14" height="16"></td>
  </tr>
  <tr>
    <td align="right" background="images/left_bg.gif">&nbsp;</td>
    <td align="center" valign="middle" background="images/main_bg.gif" bgcolor="#CCCCCC">
	<?
		if ($submit_personal)
		{
			if (empty($username) || empty($password))
			{
				echo clickback('用户密码 和密码不能空');exit;
			}
			elseif ($db->num($db->query("select username from {$tablepre}member where username='$username'")))
			{
				echo clickback('此用户已存在');exit;
			}
			else
			{
				$losetime	=	$vip	?	mktime(0,0,0,$month,$day,$year)	:	'0';
				$db->query("INSERT INTO {$tablepre}member (username,password,email,kind,vip,info_sign,question,answer,regtime,losetime,logins) VALUES ('$username','".md5($password)."','$email','$kind_mem','$vip','$info_sign','$question','$answer','".time()."','$losetime','0')");
				$db->query("INSERT INTO {$tablepre}jianli (username,truename,sex) VALUES ('$username','$truename','$sex')");
				echo refreshback('添加用户 <b>'.$username.'</b> 成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('user_add.php?action=personal','1');
				exit;
			}
		}
		elseif ($submit_company)
		{
			if (empty($username) || empty($password))
			{
				echo clickback('用户密码 和密码不能空');exit;
			}
			elseif ($db->num($db->query("select username from {$tablepre}member where username='$username'")))
			{
				echo clickback('此用户已存在');exit;
			}
			else
			{
				$losetime	=	$vip	?	mktime(0,0,0,$month,$day,$year)	:	'0';
				$db->query("INSERT INTO {$tablepre}member (username,password,email,kind,vip,info_sign,question,answer,regtime,losetime,logins) VALUES ('$username','".md5($password)."','$email','$kind_com','$vip','$info_sign','$question','$answer','".time()."','$losetime','0')");
				$db->query("INSERT INTO {$tablepre}jianliqy (qyuser,qyname) VALUES ('$username','$qyname')");
				echo refreshback('添加用户 <b>'.$username.'</b> 成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('user_add.php?action=company','1');
				exit;
			}
		}
	?>

	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=personal">添加个人用户</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=company">添加企业用户</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#C3C3C3">


		<?
			if ($action=='personal')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="user_add.php" method="post">
			  <tr align="left" bgcolor="#E3E6EA">
				<td height="25" colspan="2"><strong>&nbsp;&nbsp;&nbsp;&nbsp;个 人 用 户 基 本 资 料</strong></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用 户 名</td>
				<td width="73%" height="25">&nbsp;&nbsp;
				  <input name="username" type="text" id="username"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V I P</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="vip" type="radio" value="1">
					是&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="vip" type="radio" value="0" checked>
					否</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V I P 截 至</td>
				<td height="25">&nbsp;&nbsp;
				  <select name="year" id="year">
				  <?
					for ($i=date("Y");$i<(date("Y")+9);$i++)
					{
						echo "<option value='$i'>$i</option>";
					}
				  ?>
					</select>
				  年<select name="month" id="month">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					</select>
				  月
				  <select name="day" id="day">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="18">18</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					</select>
				  日</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登陆密码</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="password" type="text" id="password"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="email" type="text" id="email"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码保护问题</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="question" type="text" id="question"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;问题回答</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="answer" type="text" id="answer"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" colspan="2" bgcolor="#E3E6EA"><strong>&nbsp;&nbsp;&nbsp;&nbsp;个 人 用 户 简 历 资 料</strong></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认证资料</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="info_sign" type="radio" value="1" checked>
				  是&nbsp;&nbsp;&nbsp;&nbsp;		      <input name="info_sign" type="radio" value="0">
				  否</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真实姓名</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="truename" type="text" id="truename"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性&nbsp;&nbsp;&nbsp;&nbsp;别</td>
				<td height="25">&nbsp;&nbsp;			  <select name="sex" id="sex">
				  <option value="男">男</option>
				  <option value="女">女</option>
				  </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其它资料</td>
				<td height="25">&nbsp;&nbsp;... 通过前台控制面板编辑</td>
			  </tr>
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="30" colspan="2"><input name="submit_personal" type="submit" id="submit_personal" value=" 提 交 "></td>
				</tr>
			</form>
			</table>
			<? }
			elseif ($action=='company')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="user_add.php" method="post">
			  <tr align="left" bgcolor="#E3E6EA">
				<td height="25" colspan="2"><strong>&nbsp;&nbsp;&nbsp;&nbsp; 企 业 用 户 基 本 资 料</strong></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用 户 名</td>
				<td width="73%" height="25">&nbsp;&nbsp;
				  <input name="username" type="text" id="username"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V I P</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="vip" type="radio" value="1">
					是&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="vip" type="radio" value="0" checked>
					否</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V I P 截 至</td>
				<td height="25">&nbsp;&nbsp;
				  <select name="year" id="year">
				  <?
					for ($i=date("Y");$i<(date("Y")+9);$i++)
					{
						echo "<option value='$i'>$i</option>";
					}
				  ?>
					</select>
				  年<select name="month" id="month">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					</select>
				  月
				  <select name="day" id="day">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="18">18</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					</select>
				  日</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登陆密码</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="password" type="text" id="password"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="email" type="text" id="email"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码保护问题</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="question" type="text" id="question"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;问题回答</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="answer" type="text" id="answer"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" colspan="2" bgcolor="#E3E6EA"><strong>&nbsp;&nbsp;&nbsp;&nbsp;企 业 用 户 简 历 资 料</strong></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认证资料</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="info_sign" type="radio" value="1" checked>
				  是&nbsp;&nbsp;&nbsp;&nbsp;		      <input name="info_sign" type="radio" value="0">
				  否</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;企业名称</td>
				<td height="25">&nbsp;&nbsp;
				  <input name="qyname" type="text" id="qyname"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="27%" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其它资料</td>
				<td height="25">&nbsp;&nbsp;... 通过前台控制面板编辑</td>
			  </tr>
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="30" colspan="2"><input name="submit_company" type="submit" id="submit_company" value=" 提 交 "></td>
				</tr>
			</form>
			</table>
			<? }
		?>



























		</td>
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
</body>
</html>
