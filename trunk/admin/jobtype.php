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
		if ($submit_add)
		{
			if (empty($title))	{echo clickback('分类标题不能为空');exit;}
			else
			{
				$db->query("INSERT INTO {$tablepre}job_type (title,orderid) values ('$title','$orderid')");

				update_cache('jobtype','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('jobtype.php','1');
				exit;
			}
		}
		elseif ($submit_edit)
		{
			if ($selects==''){echo clickback('无操作对象');exit;}
			else
			{
				foreach ($selects as $tid)
				{
					$title	=	${'title'.$tid};
					$orderid	=	${'orderid'.$tid};
					$db->query("UPDATE {$tablepre}job_type SET title='$title',orderid='$orderid' WHERE tid='$tid'");
				}
				update_cache('jobtype','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('jobtype.php','1');
				exit;
			}
		}
		elseif ($submit_delete)
		{
			if ($delete==''){echo clickback('请选择操作对象');exit;}
			else
			{
				$comma=$ids="";
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("DELETE FROM {$tablepre}job_type WHERE tid in ($ids)");
				update_cache('jobtype','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('jobtype.php','1');
				exit;
			}
		}
		else
		{
			$query=$db->query("select * from {$tablepre}job_type order by orderid");
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif">[ + 职位分类&nbsp;+ ]</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
        <form action="jobtype.php" method="post">
		  <tr bgcolor="#F1F2F4">
            <td width="15%" height="25" align="center">编号</td>
            <td width="65%" height="25" align="center">名称</td>
            <td width="10%" align="center">顺序</td>
            <td width="10%" align="center">删除</td>
		  </tr>
		  <?
		  	while ($row=$db->row($query))
			{?>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center"><?=$row[tid]?></td>
				<td height="25" align="center"><input name="title<?=$row[tid]?>" type="text" id="title<?=$row[tid]?>" value="<?=$row[title]?>">
				  <input name="selects[]" type="hidden" id="selects[]" value="<?=$row[tid]?>"></td>
				<td width="10%" align="center"><input name="orderid<?=$row[tid]?>" type="text" id="orderid<?=$row[tid]?>" value="<?=$row[orderid]?>" size="4" maxlength="4"></td>
			    <td width="10%" align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row[tid]?>"></td>
			  </tr>
			<? }
		  ?>
          <tr bgcolor="#F1F2F4">
            <td height="25" colspan="3" align="right">全选&nbsp;</td>
            <td height="25" align="center"><input name="chkall" type="checkbox" id="chkall" value="checkbox" onClick="checkall(this.form)"></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">新加分类</td>
            <td height="25" align="center"><input name="title" type="text" id="title"></td>
            <td colspan="2" align="center"><input name="orderid" type="text" id="orderid" value="0" size="4" maxlength="4"></td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" colspan="4" align="center"><input name="submit_add" type="submit" id="submit_add" value=" 新 加 ">
              &nbsp;&nbsp;
              <input name="submit_edit" type="submit" id="submit_edit" value=" 更新列表 ">&nbsp;&nbsp;<input name="submit_delete" type="submit" id="submit_delete" value=" 删 除 "></td>
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
