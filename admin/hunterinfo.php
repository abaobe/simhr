<?php
	require "admin_globals.php";
	require "admin_check.php";
	$table=$tablepre.'hunter_info';
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
<title><?php echo $webtitle;?> - Powered by SimPHP !</title>
<script src="../css/check_all.js"></script>
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
	if ($submit_hunterinfo)
	{
		if ($title==''	||	$context=='')	{echo clickback('资迅标题、资迅内容不能为空');exit;}
		else if ($html_header=='' || $html_center=='' || $html_footer=='')	{echo clickback('请选定模板');exit;}
		else
		{
			$fileroot=date($dirhtml_unit,time());
			$sql="INSERT INTO $table (title,context,addtime,htmlroot,itfrom) VALUES ('".html($title)."','".html($context)."','".time()."','$fileroot','".html($itfrom)."')";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('录入资迅失败');exit;}
			else
			{
				$html_name=$db->query_id();
				$sql_data=array(
					'news_title'=>$title,
					'news_text'=>$context,
					'news_time'=>date("Y-n-j H:i",time()),
					'news_from'=>$itfrom,
					'news_click'=>'0'
				);
				$c_html->c_hunterinfo($html_header,$html_center,$html_footer,$html_name,$dirhtml_hunterinfo,$fileroot,$sql_data,1);
				update_cache('hunterinfo','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('hunterinfo.php','1');
				exit;
			}
		}
	}
	else if ($edit_hunterinfo)
	{
		if ($title==''	||	$context=='')	{echo clickback('资迅标题、资迅内容不能为空');exit;}
		else if ($html_header=='' || $html_center=='' || $html_footer=='')	{echo clickback('请选定模板');exit;}
		else
		{
			$fileroot=	$editroot	?	$editroot	:	date($dirhtml_unit,time());
			$sql="UPDATE $table SET title='".html($title)."',context='".html($context)."',itfrom='$itfrom' WHERE id='$nid'";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('编辑资迅失败');exit;}
			else
			{
				$html_name=$nid;
				$sql_data=array(
					'news_title'=>$title,
					'news_text'=>$context,
					'news_time'=>date("Y-n-j H:i",$addtime),
					'news_from'=>$itfrom,
					'news_click'=>$clicked
				);
				$c_html->c_hunterinfo($html_header,$html_center,$html_footer,$html_name,$dirhtml_hunterinfo,$fileroot,$sql_data,1);
				update_cache('hunterinfo','1');
				echo refreshback('编辑成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('hunterinfo.php','1');
				exit;
			}
		}
	}
	else if ($delete_hunterinfo)
	{
		if ($delete=='')	{echo clickback('没有选定操作对象');exit;}
		else
		{
			$comma=$ids='';
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=',';
			}
			$sql=$db->query("select * from $table where id in ($ids)");
			$delete_htmlfile="Delete html files result ";
			while ($row=$db->row($sql))
			{
				delete_file('../'.$htmlroot.'/'.$dirhtml_hunterinfo.'/'.$row['htmlroot'].'/'.$row['id'].'.html');
			}
			$query_sql=$db->query("delete from $table where id in ($ids)");
			if (!$query_sql)	{$delete_htmlfile.="SQL Delete 		<font color=\"#ff0000\">Faile</font>";}
			else
			{
				$delete_htmlfile.="SQL Delete 		<font color=\"#ff0000\">Successful</font>";
			}
			update_cache('hunterinfo','1');
			echo refreshback($delete_htmlfile);
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('hunterinfo.php','1');
			exit;
		}
	}
	else if ($tohtml_hunterinfo)
	{
		if ($delete=='')	{echo clickback('没有选定操作对象');exit;}
		else
		{
			$comma=$ids='';
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=',';
			}
			$sql=$db->query("select * from $table where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$sql_data=array(
					'news_title'=>$row['title'],
					'news_text'=>$row['context'],
					'news_time'=>date("Y-n-j H:i",$row['addtime']),
					'news_from'=>$row['itfrom'],
					'news_click'=>$row['click']
				);
				$c_html->c_hunterinfo($html_header,$html_center,$html_footer,$row['id'],$dirhtml_hunterinfo,$row['htmlroot'],$sql_data,1);
			}
			update_cache('hunterinfo','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('hunterinfo.php','1');
			exit;
		}
	}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif">[ + <a href="hunterinfo.php">猎 头 资 迅 管 理</a> + ]&nbsp;&nbsp;&nbsp;[ + <a href="hunterinfo.php?action=add">添 加 猎 头 资 迅</a> + ]</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<?
			if ($action=='edit')
			{
				$sql=$db->query("select * from $table where id='$info'");
				$row=$db->row($sql);
			?>
			<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
			<form action="hunterinfo.php" method="post" name="input">
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">资迅标题</td>
				<td height="25">&nbsp;&nbsp;<input name="title" type="text" class="input" id="title" value="<?=$row['title']?>" size="50" maxlength="100">
				  <input name="nid" type="hidden" id="nid" value="<?=$row['id']?>">
				  <input name="editroot" type="hidden" id="editroot" value="<?=$row['htmlroot']?>">
				  <input name="addtime" type="hidden" id="addtime" value="<?=$row['addtime']?>">
				  <input name="clicked" type="hidden" id="clicked" value="<?=$row['click']?>"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">资迅内容</td>
				<td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;<?=input_style()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;<textarea name="context" cols="100" rows="18" class="input" id="context"><?=$row['context']?>
                    </textarea></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">信息来源</td>
			    <td height="25">&nbsp;
			      <input name="itfrom" type="text" class="input" id="itfrom" value="<?=$row['itfrom']?>" size="30"></td>
			    </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">选择模板</td>
				<td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;<?=$HTML_TPL->get_header()?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;<?=$HTML_TPL->get_center($default_hunterinfo)?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;<?=$HTML_TPL->get_footer()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="30" colspan="2" align="center"><input name="edit_hunterinfo" type="submit" class="input" id="edit_hunterinfo" value="编辑资迅">
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <input name="Submit" type="reset" class="input" value="重置资迅内容"></td>
				</tr>
			</form>
			</table>
			<? }
			elseif ($action=='add')
			{?>
			<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
			<form action="hunterinfo.php" method="post" name="input">
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">资迅标题</td>
				<td height="25">&nbsp;&nbsp;<input name="title" type="text" class="input" id="title" size="50" maxlength="100"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">资迅内容</td>
				<td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;<?=input_style()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;<textarea name="context" cols="100" rows="18" class="input" id="context"></textarea></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">信息来源</td>
			    <td height="25">&nbsp;
			      <input name="itfrom" type="text" class="input" id="itfrom" size="30"></td>
			    </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">选择模板</td>
				<td height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;<?=$HTML_TPL->get_header()?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;<?=$HTML_TPL->get_center($default_hunterinfo)?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;<?=$HTML_TPL->get_footer()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="30" colspan="2" align="center"><input name="submit_hunterinfo" type="submit" class="input" id="submit_hunterinfo" value="提交资迅">
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <input name="Submit" type="reset" class="input" value="重置资迅内容"></td>
				</tr>
			</form>
			</table>
			<? }
			else
			{
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			<FORM action="hunterinfo.php" method="post" name="input">
			  <tr bgcolor="#E1E3E8">
				<td height="25" align="center">html</td>
				<td height="25" align="center">资迅标题</td>
				<td align="center">发布时间</td>
				<td align="center">操作</td>
				<td align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <?
					$count='15';
					$str='0';
					$str2='';
					require 'page_count.php';
			  		$sql=$db->query("select * from $table order by id desc limit $offset,$psize");
					while ($row=$db->row($sql))
					{
						$htmlfile='../'.$htmlroot.$dirhtml_hunterinfo.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
					?>
					  <tr bgcolor="#F1F2F4">
						<td height="25" align="center"><?=html_exists($htmlfile)?></td>
						<td height="25" align="center">&nbsp;<?='<a href=\''.$htmlfile.'\' target=\'_blank\'>'.$row['title'].'</a>'?></td>
						<td align="center"><?=date("Y-m-d H:i",$row['addtime'])?></td>
						<td align="center"><a href="hunterinfo.php?action=edit&info=<?=$row['id']?>">编辑</a></td>
						<td align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
					  </tr>
				  <? }
			  ?>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" colspan="2" align="center" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25" align="center"><? require 'page_show.php';?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			    <td align="left"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">选择模板样式</td>
                  </tr>
                  <tr>
                    <td height="22">头体&nbsp;:&nbsp;                      <?=$HTML_TPL->get_header()?></td>
                  </tr>
                  <tr>
                    <td height="22">主体&nbsp;:&nbsp;                      <?=$HTML_TPL->get_center($default_hunterinfo)?></td>
                  </tr>
                  <tr>
                    <td height="22">脚体&nbsp;:&nbsp;                      <?=$HTML_TPL->get_footer()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			    <td colspan="2" align="center"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="30" align="center"><input name="delete_hunterinfo" type="submit" class="input" id="delete_hunterinfo" value=" 删 除 猎 头 资 迅 "></td>
                  </tr>
                  <tr>
                    <td height="30" align="center"><input name="tohtml_hunterinfo" type="submit" class="input" id="tohtml_hunterinfo" value="批量生成 html"></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			    </tr>
			</FORM>
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
