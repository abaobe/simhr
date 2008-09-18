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
		if ($submit_addlink)
		{
			if (empty($title) || empty($url))	{echo clickback('名称,链接不能为空');exit;}
			$db->query("INSERT INTO {$tablepre}links (title,img,url,context,orderid) VALUES ('$title','$img','$url','$context','$orderid')");
			update_cache('freelink','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('links.php','1');
			exit;
		}
		elseif ($submit_delete)
		{
			if (empty($delete))	{echo clickback('请选择操作对象');exit;}
			$comma=$ids="";
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$db->query("delete from {$tablepre}links where id in ($ids)");
			update_cache('freelink','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('links.php','1');
			exit;
		}
		elseif($submit_list)
		{
			if (empty($delete))	{echo clickback('请选择操作对象');exit;}
			foreach ($delete as $id)
			{
				$title=${'title'.$id};
				$img=${'img'.$id};
				$url=${'url'.$id};
				$context=${'context'.$id};
				$orderid=${'orderid'.$id};
				$sql="UPDATE {$tablepre}links SET title='$title',img='$img',url='$url',context='$context',orderid='$orderid' where id='$id'";
				$db->query($sql);
			}
			update_cache('freelink','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('links.php','1');
			exit;
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif">友 情 链 接 管 理</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
        <form action="links.php" method="post">
		  <tr bgcolor="#E3E6EA">
            <td height="25" align="center">链接名称</td>
            <td align="center">LOGO</td>
            <td align="center">URL</td>
            <td align="center">说明</td>
            <td height="25" align="center">显示序号</td>
            <td align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
		  </tr>
          <?
		  	$query=$db->query("select * from {$tablepre}links order by orderid");
			while ($row=$db->row($query))
			{?>
			  <tr bgcolor="#F1F2F4">
				<td height="30" align="center"><input name="title<?=$row[id]?>" type="text" id="title" size="16" value="<?=$row['title']?>"></td>
				<td height="30" align="center"><input name="img<?=$row[id]?>" type="text" id="img" size="16" value="<?=$row['img']?>"></td>
				<td height="30" align="center"><input name="url<?=$row[id]?>" type="text" id="url" size="16" value="<?=$row['url']?>"></td>
				<td height="30" align="center"><input name="context<?=$row[id]?>" type="text" id="context" size="16" value="<?=$row['context']?>"></td>
				<td height="30" align="center"><input name="orderid<?=$row[id]?>" type="text" id="orderid" value="<?=$row[orderid]?>" size="2" maxlength="2"></td>
			    <td height="25" align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
			  </tr>
			<? }
		  ?>
            <tr bgcolor="#E3E6EA">
              <td height="30" colspan="6" align="center"><input name="submit_list" type="submit" id="submit_list" value="更新列表">
&nbsp;&nbsp;&nbsp;&nbsp;
<input name="submit_delete" type="submit" id="submit_delete" value="删除链接"></td>
              </tr>
            <tr bgcolor="#F1F2F4">
              <td height="25" colspan="6" align="center">&nbsp;</td>
              </tr>
            <tr bgcolor="#E3E6EA">
              <td height="25" colspan="6" align="center">新 加 链 接</td>
              </tr>
            <tr bgcolor="#F1F2F4">
            <td height="30" align="center"><input name="title" type="text" id="title" size="16"></td>
            <td height="25" align="center"><input name="img" type="text" id="img" size="16"></td>
            <td height="25" align="center"><input name="url" type="text" id="url" size="16"></td>
            <td height="25" align="center"><input name="context" type="text" id="context" size="16"></td>
            <td height="25" align="center"><input name="orderid" type="text" id="orderid" value="0" size="2" maxlength="2"></td>
            <td height="25" align="center"><input name="submit_addlink" type="submit" id="submit_addlink" value="增加"></td>
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
</body>
</html>
