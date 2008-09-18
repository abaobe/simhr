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
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="14"></td>
  </tr>
</table>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="1" class="td_lr">
  <tr>
    <td height="1" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + 系 统 信 息 + ] </td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="config.php" target="main">系统设置</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#E1E1E1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="main.php" target="main">简略信息</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#E1E1E1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="phpinfo.inc.php" target="main">详细信息</a></td>
  </tr>
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + 会 员 管 理 + ] </td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_manage.php" target="main">管理用户</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_right.php" target="main">用户权限管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_add.php" target="main">添加用户</a></td>
  </tr>
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + 分类管理 + ] </td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="jobtype.php" target="main">职位分类</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="peixun.php?action=type" target="main">培训学校分类</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="peixun.php?action=lessontype" target="main">培训课程分类</a></td>
  </tr>
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + 站 内 信 息 + ] </td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="job.php" target="main">求职/招聘</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="hunter.php" target="main">猎头人才/职位</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="hunterinfo.php" target="main">猎头资迅</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="peixun.php" target="main">培训管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="teacher.php" target="main">家教管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="news.php" target="main">新闻管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="job_way.php" target="main">求职攻略</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="job_law.php" target="main">政策法规</a></td>
  </tr>
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + 其 它 管 理 + ] </td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="html.php" target="main">HTML 静态文件管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="cache.php" target="main">缓存管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="links.php" target="main">友情链接管理</a></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="info.php" target="main">广告管理</a></td>
  </tr>
  <!--
  <tr>
    <td height="1" bgcolor="e1e1e1"></td>
  </tr>
  <tr>
    <td height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="links.php" target="main">友情链接</a></td>
  </tr>
  -->
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + 数 据 管 理 + ] </td>
  </tr>
  <tr>
        <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="database.php?action=backup" target="main">数据备份</a></td>
      </tr>
<tr>
    <td height="1" bgcolor="#E1E1E1"></td>
  </tr>
        <tr>
        <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="database.php?action=recover" target="main">数据恢复</a></td>
      </tr>
<tr>
    <td height="1" bgcolor="#E1E1E1"></td>
  </tr>
      <tr>
        <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="database.php?action=update" target="main">数据库升级</a></td>
      </tr>
  <tr>
    <td height="22" align="center" background="images/admin_tablebar.gif">[ + <a href="../login.php?action=loginout&goto=../index.php?" target="_top">退 出 系 统</a> + ]</td>
  </tr>
</table>
</body>
</html>
