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
	<?
		if ($submit_mail)
		{
			switch ($reciver)
			{
				case	'per'		:	$search=" and kind='$kind_mem'";	break;
				case	'com'		:	$search=" and kind='$kind_com'";	break;
				default				:	$search="";	break;
			}
			$start_mail	=	(!is_numeric($start_mail) || $start_mail<0)	?	'0'		:	$start_mail;
			$end_mail	=	(!is_numeric($end_mail) || $end_mail<1)		?	'100'	:	$end_mail;
			$sql="select kind,email from {$tablepre}member where email!='' $search limit $start_mail,$end_mail";
			$query=$db->query($sql);
			if (!$db->num($query)){echo 'No selected.';exit;}
			$separate="";
			while ($row=$db->row($query))
			{
				if (strpos($row[email],'@'))
				{
					$to.="$separate$row[email]";
					$separate=",";
				}
			}
			require '../common/mail_config.php';
			require '../common/email.php';
			$mail	=	new WANE_MAIL;
			$mail	->	wane_mail_send($to,$subject,$message,$adminemail);
			echo '信息已经发送到以下 邮箱:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>'.str_replace(",","<br>",$to).'<BR><BR><a href=\'info.php?action=mail\'>返回</a>';
			echo endhtml();
			echo wwwwanenet();
			exit;
		}
		elseif ($submit_add)
		{
			$db->query("INSERT INTO {$tablepre}ad (aid,context) VALUES ('NULL','')");

			update_cache('ad','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('info.php?action=ad','1');
			exit;
		}
		elseif ($submit_edit)
		{
			$db->query("UPDATE {$tablepre}ad SET context='$context' where aid='$aid'");

			update_cache('ad','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('info.php?action=ad','1');
			exit;
		}
		elseif ($submit_delete)
		{
			if ($delete=='')	{echo clickback('无操作对象');exit;}
			else
			{
				$ids=$comma="";
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("DELETE FROM {$tablepre}ad WHERE aid in ($ids)");
				update_cache('ad','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('info.php?action=ad','1');
				exit;
			}
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="info.php?action=mail">E-mail列表</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="info.php?action=ad">页面广告位</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<?
			if ($action=='mail')
			{?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			<form action="info.php" method="post">
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">信息类型</td>
				<td height="25" align="left">&nbsp;&nbsp;&nbsp;E-mail</td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">收信人</td>
				<td width="80%" height="25" align="left">&nbsp;
				  <input name="reciver" type="radio" value="per">
				  个人用户&nbsp;&nbsp;&nbsp;&nbsp;                <input name="reciver" type="radio" value="com">
				  企业用户&nbsp;&nbsp;&nbsp;&nbsp;              <input name="reciver" type="radio" value="all" checked>
				  全部用户</td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">接收人数</td>
			    <td height="25" align="left">&nbsp;&nbsp;
			      <input name="start_mail" type="text" id="start_mail" size="4" maxlength="8">
			      &nbsp;&nbsp;&nbsp;到&nbsp;&nbsp;&nbsp;&nbsp;
			      <input name="end_mail" type="text" id="end_mail" size="4" maxlength="8"></td>
			    </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">信件标题</td>
				<td height="25" align="left">&nbsp;&nbsp;
				  <input name="subject" type="text" id="subject" size="50"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">信息内容</td>
				<td height="280" align="left">&nbsp;&nbsp;
				  <textarea name="message" cols="80" rows="18" wrap="VIRTUAL" id="message"></textarea></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" colspan="2" align="center"><input name="submit_mail" type="submit" id="submit_mail" value=" 发 送 ">
				&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Submit" value=" 重 设 "></td>
				</tr>
			</form>
			</table>
			<? }
			elseif ($action=='ad')
			{
				$count="5";
				$table=$tablepre.'ad';
				$str="0";
				$str2="action=ad";
				require 'page_count.php';
				$query=$db->query("select * from $table limit $offset,$psize");
			?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="info.php" method="post">
			  <tr bgcolor="#E1E3E8">
				<td width="10%" height="25" align="center">页面调用</td>
				<td height="25" align="center">广告内容</td>
			    <td width="10%" align="center">管理</td>
			    <td width="10%" align="center">删除</td>
			  </tr>
			  <?
			  	while ($row=$db->row($query))
				{?>
				  <tr bgcolor="#F1F2F4">
					<td width="10%" height="25" align="center">{AD<?=$row[aid]?>}</td>
					<td height="25" align="center"><?=$row[context]?></td>
					<td height="25" align="center"><a href="info.php?action=adedit&info=<?=$row[aid]?>">编辑</a></td>
				    <td height="25" align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row[aid]?>"></td>
				  </tr>
				<? }
			  ?>
			  <tr bgcolor="#F1F2F4">
			    <td height="30" colspan="2" align="center"><? require 'page_show.php';?></td>
		        <td height="30" align="center"><input name="submit_add" type="submit" id="submit_add" value="新加"></td>
		        <td height="30" align="center"><input name="submit_delete" type="submit" id="submit_delete" value="删除"></td>
			  </tr>
			</form>
			</table>
			<? }
			elseif ($action=='adedit')
			{
				if (!isset($info) || empty($info) || !is_numeric($info))
				{
					echo clickback('无效资源');exit;
				}
				else
				{
					$query=$db->query("select * from {$tablepre}ad where aid='$info'");
					if (!$db->num($query)){echo clickback('资源指定失败');exit;}
					else
					{
						$row=$db->row($query);
					}
				}
				?>
				<table width="100%"  border="0" cellspacing="1" cellpadding="0">
				<form action="info.php" method="post">
				  <tr bgcolor="#F1F2F4">
					<td width="15%" height="25" align="center">页面调用</td>
					<td height="25">&nbsp;&nbsp;{AD<?=$row[aid]?>}</td>
				  </tr>
				  <tr bgcolor="#F1F2F4">
					<td width="15%" height="25" align="center">广告内容</td>
					<td height="280">&nbsp;&nbsp;
				    <textarea name="context" cols="80" rows="18" wrap="VIRTUAL" id="context"><?=$row[context]?>
				    </textarea></td>
				  </tr>
				  <tr bgcolor="#F1F2F4">
				    <td height="30" align="center">说明</td>
			        <td height="30" align="center">支持 html 语法 , 仅舍用于 动态页面模板调用</td>
				  </tr>
				  <tr bgcolor="#F1F2F4">
					<td height="30" colspan="2" align="center"><input name="submit_edit" type="submit" id="submit_edit" value=" 保 存 ">
				    <input name="aid" type="hidden" id="aid" value="<?=$row[aid]?>">
				    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				    <input type="button" name="Submit" value=" 返 回 " onclick="javascript:history.go(-1)"></td>
				  </tr>
				</form>
				</table>
				<?
			}
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
