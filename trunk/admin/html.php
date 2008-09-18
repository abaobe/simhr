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
<script src="../css/check_all.js"></script>
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
	<?
		if ($action=='deletehtmlfolder')
		{
			$dfolder	=	'../'.$htmlroot.str_replace("./","",str_replace("../","",$folder));
			if (!is_dir($dfolder))
			{
				$result="无法删除";
			}
			elseif (!@rmdir($dfolder))
			{
				$result="删除失败";
			}
			else
			{
				$result="删除成功";
			}
			echo refreshback($result);
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('html.php','1');
			exit;
		}
		elseif ($managehtml)
		{
			if ($delete=='')
			{
				echo clickback('无操作对象');exit;
			}
			else
			{
				foreach ($delete as $dfile)
				{
					$delfile	=	'../'.$htmlroot.str_replace("../","",str_replace("../","",$dfile));
					delete_file($delfile);
				}
			}
			echo refreshback('操作结束');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('html.php','1');
			exit;
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif">静态 html 文件管理</td>
      </tr>
      <tr>
        <td align="center" valign="top" bgcolor="#CCCCCC">

		  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="lrd">
		  <tr >
			<td align="center" >
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="html.php" method="post" name="wane_post">
				<tr align="center" bgcolor="#F1F2F4">
				  <td align="left">&nbsp;文件名</td>
				  <td width="10%">可写</td>
				  <td width="20%">类型</td>
				  <td width="15%" height="25">删除</td>
				</tr>
				<?php

					$dirhtmls	=	empty($folder)	?	''	:	$folder.'/';
					$dirhtml	=	'../'.$htmlroot.str_replace("./","",str_replace("../","",$dirhtmls));
					$d = dir($dirhtml);
					while (false !== ($entry = $d->read()))
					{
						if  ($entry!='.' && $entry!='..')
						{?>
						<tr align="center" bgcolor="#F1F2F4">
						  <td height="25" align="left">&nbsp;<?=$dirhtml.$entry?></td>
						  <td height="25"><?=is_writable($dirhtml.$entry)	?	'<font color=\'#6699cc\'>ON</font>'	:	'<font color=\'#ff0000\'>OFF</font>'?></td>
						  <td height="25"><?=is_dir($dirhtml.$entry)	?	'<a href=\'html.php?folder='.$dirhtmls.$entry.'\'><font color=\'#ff0000\'>查看目录</font></a> | <a href=\'html.php?action=deletehtmlfolder&folder='.$dirhtmls.$entry.'\'><font color=\'#ff0000\'>删除目录</font></a>'	:	'文件'?></td>
						  <td width="15%" height="25"><?=is_dir($dirhtml.$entry)	?	''	:	'<input name="delete[]" type="checkbox" value="'.$dirhtmls.$entry.'">'?></td>
						</tr>
						<?
						}
					}
					$d->close();
				?>
				<tr bgcolor="#F1F2F4">
				  <td height="25" align="center"><input type="submit" name="Submit" value=" 删除 ">
			      <input name="managehtml" type="hidden" id="managehtml" value="1"></td>
				  <td height="25" align="center"><a href="javascript:history.go(-1)">返回</a></td>
				  <td height="25" align="center">全选</td>
				  <td height="25" align="center"><input name="chkall" type="checkbox" id="select" value="file" onclick="checkall(this.form)"></td>
				</tr>
			</form>
			</table>
			</td>
		  </tr>
		</table>

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
