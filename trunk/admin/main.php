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
    <td align="center" valign="middle" background="images/main_bg.gif">

	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif">[ + 系 统 配 置&nbsp;+ ]</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">服务器名</td>
            <td width="80%" height="25" align="center"><?php echo  getenv("SERVER_NAME");?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">服务器 IP:端口</td>
            <td width="80%" height="25" align="center"><?php echo  getenv("SERVER_ADDR").":".getenv("SERVER_PORT");?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">服务器语言</td>
            <td width="80%" height="25" align="center"><?php echo getenv("HTTP_ACCEPT_LANGUAGE");?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">操作系统</td>
            <td width="80%" height="25" align="center"><?=getenv("SERVER_SOFTWARE");?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">MySQL 版本</td>
            <td width="80%" height="25" align="center">MySQL
                <?php $query = mysql_query("SELECT VERSION()"); echo mysql_result($query, 0);?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">服务器文件路径</td>
            <td width="80%" height="25" align="center"><?php echo getenv("PATH_TRANSLATED");?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">附件上传</td>
            <td width="80%" height="25" align="center">允许上传最大附件 <?php echo ini_get(upload_max_filesize);?></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td width="20%" height="25" align="center">磁盘空间</td>
            <td width="80%" height="25" align="center"><?php echo intval(diskfreespace('.') / (1024 * 1024)).'M';?></td>
          </tr>


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
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18" height="16" align="right" valign="bottom"><img src="images/left_top.gif" width="18" height="16"></td>
    <td align="center" valign="bottom" background="images/row_top.gif"></td>
    <td width="14" align="left" valign="bottom"><img src="images/right_top.gif" width="14" height="16"></td>
  </tr>
  <tr>
    <td align="right" background="images/left_bg.gif">&nbsp;</td>
    <td align="center" valign="middle" background="images/main_bg.gif"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
          <tr>
            <td height="22" align="center" background="images/admin_tablebar.gif">[ + &nbsp;系 统 版 权 &nbsp;+ ]</td>
          </tr>
          <tr>
            <td align="center" bgcolor="#CCCCCC"><table width="100%"  border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#F1F2F4">
                <td width="20%" height="25" align="center">版权所属</td>
                <td height="25" align="center"><a href="http://www.php365.cn/" target="_blank">SimPHP</a></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td width="20%" height="25" align="center">系统版本</td>
                <td height="25" align="center">SimHR V4.5 COML </td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td width="20%" height="25" align="center">系统构建</td>
                <td height="25" align="center">PHP+MYSQL+PHPLIB</td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td width="20%" height="25" align="center">官方演示</td>
                <td height="25" align="center"><a href="http://www.php365.cn/jspace205/index.php" target="_blank">http://www.php365.cn/jspace205/index.php</a></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td width="20%" height="25" align="center">官方地址</td>
                <td height="25" align="center"><a href="http://www.php365.cn" target="_blank">http://www.php365.cn</a></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="25" align="center">程序设计</td>
                <td height="25" align="center">付义兵</td>
              </tr>
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
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18" height="16" align="right" valign="bottom"><img src="images/left_top.gif" width="18" height="16"></td>
    <td align="center" valign="bottom" background="images/row_top.gif"></td>
    <td width="14" align="left" valign="bottom"><img src="images/right_top.gif" width="14" height="16"></td>
  </tr>
  <tr>
    <td align="right" background="images/left_bg.gif">&nbsp;</td>
    <td align="center" valign="middle" background="images/main_bg.gif"><a href="../online.php" target="_blank">当前在线用户</a>: <?=$db->num($db->query("select sessid from ".SESSIONTABLE))?> 人 , 会员 <?=$db->num($db->query("select sessid,username from ".SESSIONTABLE." where username != ''"))?> 人 . </td>
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
