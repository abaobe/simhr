<?php
	require "admin_globals.php";
	require "admin_check.php";
	$count='15';
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
		if ($submit_classedit)
		{
			$table=$tablepre.'pxschool_kind';
			if ($title=='')	{echo clickback('名称不能为空');exit;}
			$query=$db->query("update $table set title='$title',orderid='$orderid' where id='$infoid'");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('school','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=type','1');
				exit;
			}
		}
		elseif ($submit_lessonclassedit)
		{
			$table=$tablepre.'job_peixunkind';
			if ($title=='')	{echo clickback('名称不能为空');exit;}
			$query=$db->query("update $table set title='$title' where id='$infoid'");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('lesson','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=lessontype','1');
				exit;
			}
		}
		else if ($submit_classadd)
		{
			$table=$tablepre.'pxschool_kind';
			if ($title=='')	{echo clickback('名称不能为空');exit;}
			$query=$db->query("insert into $table (title,orderid) values ('$title','$orderid')");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('school','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=type','1');
				exit;
			}
		}
		else if ($submit_lessonclassadd)
		{
			$table=$tablepre.'job_peixunkind';
			if ($title=='')	{echo clickback('名称不能为空');exit;}
			$query=$db->query("insert into $table (title) values ('$title')");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('lesson','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=lessontype','1');
				exit;
			}
		}
		else if ($submit_classdelete)
		{
			$table=$tablepre.'pxschool_kind';
			$query=$db->query("delete from $table where id='$infoid'");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('school','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=type','1');
				exit;
			}
		}
		else if ($submit_lessonclassdelete)
		{
			$table=$tablepre.'job_peixunkind';
			$query=$db->query("delete from $table where id='$infoid'");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('lesson','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=lessontype','1');
				exit;
			}
		}
		else if ($submit_classorder)
		{
			$table=$tablepre.'pxschool_kind';
			foreach ($order as $key=>$val)
			{
				$db->query("update $table set orderid='$val' where id='$key'");
			}
			update_cache('school','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('peixun.php?action=type','1');
			exit;
		}
		else if ($school_show)
		{
			$table=$tablepre.'pxschool';
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("UPDATE $table SET sign='1' WHERE id in ($ids)");
				update_cache('schools','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=school','1');
				exit;
			}
		}
		else if ($school_hidden)
		{
			$table=$tablepre.'pxschool';
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("UPDATE $table SET sign='0' WHERE id in ($ids)");
				update_cache('schools','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=school','1');
				exit;
			}
		}
		else if ($school_delete)
		{
			$table=$tablepre.'pxschool';
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$sql=$db->query("select id,username,htmlroot from $table where id in ($ids)");
				while ($row=$db->row($sql))
				{
					$delete_file='../'.$htmlroot.$dirhtml_school.'/'.$row['htmlroot'].'/'.md5($row['username']).'.html';
					if (file_exists($delete_file))	{delete_file($delete_file);}
				}
				$query=$db->query("DELETE FROM $table WHERE id in ($ids)");
				update_cache('schools','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=school','1');
				exit;
			}
		}
		else if ($toschool_html)
		{
			$table=$tablepre.'pxschool';
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("SELECT * FROM $table WHERE id in ($ids)");
				while ($row=$db->row($query))
				{
					$sql_data=array(
						'WEBTITLE'	=>	headtitle($row['sname']),
						'LINK'		=>	$row['id'],
						'SNAME'		=>	$row['sname'],
						'SCHKIND'	=>	$row['schkind'],
						'CONTEXT'	=>	$row['context'],
						'CONTENT'	=>	$row['content'],
						'SIGN_CONTENT'	=>	$row['sign_content'],
						'CONTACT'	=>	$row['contact_name'],
						'PHONE'		=>	$row['contact_phone'],
						'FAX'		=>	$row['fax'],
						'ADDRESS'	=>	$row['address'],
						'CODE'		=>	$row['code'],
						'EMAIL'		=>	$row['email'],
						'URL'		=>	$row['url'],
						'CLICK'		=>	$row['click']
					);
					$c_html->c_school($html_header,$html_center,$html_footer,md5($row['username']),$dirhtml_school,'',$sql_data,1);
				}
				update_cache('schools','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=school','1');
				exit;
			}
		}
		else if ($submit_editschool)
		{
			$table=$tablepre.'pxschool';
			$sql="update $table
					set
					   schkind='$schkind',
					   sname='$sname',
					   context='$context',
					   content='$content',
					   sign_content='$sign_content',
					   contact_name='$contact_name',
					   contact_phone='$contact_phone',
					   fax='$fax',
					   address='$address',
					   code='$code',
					   email='$email',
					   url='$url'
					where id='$schid'";
			$query=$db->query($sql);
			update_cache('schools','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('peixun.php?action=school','1');
			exit;
		}
		else if ($submit_schoolsearch)
		{
			$searchurl="peixun.php?action=school&type=search&sname=".urlencode($sname)."&schkind=".$schkind."&contact_name=".urlencode($contact_name)."&address=".urlencode($address);
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($searchurl,'1');
			exit;
		}
		else if ($lesson_show)
		{
			if ($delete=='')
			{
				echo clickback('请选择操作对象');exit;
			}
			else
			{
				$table=$tablepre.'job_peixun';
				$ids=$comma='';
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("update $table set sign='1' where id in ($ids)");
				update_cache('lessons','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=lesson','1');
				exit;
			}
		}
		else if ($lesson_hidden)
		{
			if ($delete=='')
			{
				echo clickback('请选择操作对象');exit;
			}
			else
			{
				$table=$tablepre.'job_peixun';
				$ids=$comma='';
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("update $table set sign='0' where id in ($ids)");
				update_cache('lessons','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=lesson','1');
				exit;
			}
		}
		else if ($lesson_delete)
		{
			if ($delete=='')
			{
				echo clickback('请选择操作对象');exit;
			}
			else
			{
				$table=$tablepre.'job_peixun';
				$ids=$comma='';
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$sql=$db->query("select id,htmlroot from $table where id in ($ids)");
				while ($row=$db->row($sql))
				{
					$lessonfile=$htmlroot.$dirhtml_lesson.'/'.$row[htmlroot].'/'.$row[id].'.html';
					if (file_exists($lessonfile))	{delete_file($lessonfile);}
				}
				$db->query("delete from $table where id in ($ids)");
				update_cache('lessons','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('peixun.php?action=lesson','1');
				exit;
			}
		}
		else if ($tolesson_html)
		{
			$s=$tablepre.'pxschool';
			$k=$tablepre.'job_peixunkind';
			$l=$tablepre.'job_peixun';
			$table=$s.','.$k.','.$l;
			$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
			$str="$l.leixing=$k.id and $l.username=$s.username";
			$sql="select $sstr from $table where $str";
			unset($s,$k,$table,$sstr,$str);
			$query=$db->query($sql);
			while ($row=$db->row($query))
			{
				$schoolfile=$htmlroot.$dirhtml_school.'//'.md5($row[username]).'.html';
				$school_link=file_exists('../'.$schoolfile)	?	$schoolfile	:	'view.php?action=school&info='.urlencode($row['username']);
				$sql_data=array(
					'LINK'	=>	$row[id],
					'SCHOOL_LINK'	=>	$school_link,
					'WEBTITLE'=>	headtitle($row[lesson]),
					'CLICK'	=>	$row[click],
					'LESSON'	=>	$row[lesson],
					'LESSON_TYPE'	=>	$row[title],
					'LESSON_SCHOOL'	=>	$row[sname],
					'LESSON_START'	=>	$row[start_time],
					'LESSON_BEGIN'	=>	$row[class_time],
					'LESSON_MONEY'	=>	$row[money],
					'LESSON_CLASSES'	=>	$row[classs],
					'LESSON_LEADER'	=>	$row[teacher],
					'LESSON_ADDRESS'	=>	$row[address],
					'ADDTIME'	=>	date("Y-n-j",$row[puttime]),
					'LOSETIME'	=>	($row[losetime]>time())?date("Y-n-j",$row[losetime]):'<font color=\'#ff0000\'>过期</font>',
					'CONTACT'	=>	$row[contact_name],
					'PHONE'	=>	$row[contact_phone],
					'EMAIL'	=>	$row[email],
					'FAX'	=>	$row[fax],
					'URL'	=>	$row[url],
					'DIREACTION'	=>	wane_text($row[direction]),
					'CONTENT'	=>	wane_text($row[content]),
					'CONTEXT'	=>	wane_text($row[context]),
				);
				$c_html->c_lesson($html_header,$html_center,$html_footer,$row['id'],$dirhtml_lesson,$row['htmlroot'],$sql_data,1);
			}
			update_cache('lessons','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('peixun.php?action=lesson','1');
			exit;
		}
		else if ($submit_lesson_search)
		{
			$searchurl="peixun.php?action=lesson&type=search&addtime=".$addtime."&lesson=".urlencode($lesson)."&leixing=".$leixing."&sname=".urlencode($sname);
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($searchurl,'1');
			exit;
		}
		else if ($submit_peixun_edit)
		{
			$classdate=$year1.'.'.$month1.'.'.$day1.'--'.$year2.'.'.$month2.'.'.$day2;
			$losetime=mktime(23,59,59,$month,$day,$year);
			$sql="update {$tablepre}job_peixun
					set
					   lesson='$lesson',
					   leixing='$leixing',
					   start_time='$classdate',
					   class_time='$class_time',
					   address='$address',
					   classs='$classs',
					   teacher='$teacher',
					   money='$money',
					   direction='$direction',
					   content='$content',
					   context='$context',
					   contact_name='$contact_name',
					   contact_phone='$contact_phone',
					   fax='$fax',
					   email='$email',
					   url='$url',
					   losetime='$losetime'
					where id='$lessonid'";
			$query=$db->query($sql);
			update_cache('lessons','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('peixun.php?action=lesson','1');
			exit;
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=type">培训学校分类</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=lessontype">培训课程分类</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=school">培训学校</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=school&type=on">已验证</a>&nbsp;&nbsp;&nbsp;<a href="?action=school&type=off">未验证</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=school_search">学校查询</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=lesson">培训课程</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=lesson&type=on">已验证</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=lesson&type=off">未验证</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=lesson&type=close">过期培训</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=lesson_search">课程查询</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
        <?
			if ($action=='type')
			{
				$table=$tablepre.'pxschool_kind';
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			  <tr bgcolor="#F1F2F4">
				<td width="50%" height="25" align="center" valign="top">
				<table width="100%"  border="0" cellspacing="1" cellpadding="0">
				<form action="peixun.php" method="post">
                  <tr>
                    <td width="50" height="25" align="center">编号</td>
                    <td height="25" align="center">分类名称</td>
                    <td width="50" height="25" align="center">顺序</td>
                  </tr>
				  <?
				  	$sql=$db->query("select * from $table order by orderid");
					while ($row=$db->row($sql))
					{?>
					  <tr bgcolor="#FFFFFF">
						<td width="50" height="25" align="center"><?=$row['id']?></td>
						<td height="25" align="center"><a href="peixun.php?action=type&edit=on&info=<?=$row['id']?>"><?=$row['title']?></a></td>
						<td width="50" height="25" align="center"><input name="order[<?=$row['id']?>]" type="text" class="input" id="orderid" size="2" maxlength="2" value="<?=$row['orderid']?>"></td>
					  </tr>
					<? }
				  ?>

                  <tr align="center">
                    <td height="35" colspan="3"><input name="submit_classorder" type="submit" class="input" id="submit_classorder" value="更新显示顺序"></td>
                  </tr>
                </form>
				</table></td>
				<td width="50%" height="25" align="center" valign="top">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="10"></td>
				  </tr>
				</table>
				<table width="95%"  border="0" cellpadding="0" cellspacing="1" class="input">
				  <?
				  	if ($edit=='on' && $info!='' && is_numeric($info) && $info>='1')
					{
						$edit=$db->row($db->query("select * from $table where id='$info'"));
					?>
					  <form action="peixun.php" method="post">
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center">编辑分类</td>
					  </tr>
					  <tr>
					    <td width="100" height="25" align="center">类别名称</td>
					    <td align="left"><input name="title" type="text" class="input" id="title" value="<?=$edit['title']?>"></td>
					  </tr>
					  <tr>
					    <td width="100" height="25" align="center">显示顺序</td>
					    <td height="25" align="left"><input name="orderid" type="text" class="input" id="orderid" value="<?=$edit['orderid']?>" size="2" maxlength="2">
				        <input name="infoid" type="hidden" id="infoid" value="<?=$edit['id']?>"></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
					    <td height="25" colspan="2" align="center"><input name="submit_classedit" type="submit" class="input" id="submit_classedit" value="编辑分类">
				        &nbsp;&nbsp;&nbsp;&nbsp;
				        <input name="Submit" type="button" class="input" value="取消编辑" onClick="javascript:history.go(-1)">
&nbsp;&nbsp;&nbsp;&nbsp;
<input name="submit_classdelete" type="submit" class="input" id="submit_classdelete" onClick="javascript:history.go(-1)" value="删除分类"></td>
					  </tr>
					  </form>
					<? }
					else
					{?>
					  <form action="peixun.php" method="post">
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center">增加新分类</td>
					  </tr>
					  <tr>
					    <td width="100" height="25" align="center">类别名称</td>
					    <td height="25" align="left"><input name="title" type="text" class="input" id="title"></td>
					  </tr>
					  <tr>
					    <td width="100" height="25" align="center">显示顺序</td>
					    <td height="25" align="left"><input name="orderid" type="text" class="input" id="orderid" size="2" maxlength="2"></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center"><input name="submit_classadd" type="submit" class="input" id="submit_classadd" value="增加新分类">
						  &nbsp;&nbsp;&nbsp;&nbsp;
						  <input name="Submit" type="reset" class="input" value="重置内容"></td>
					  </tr>
					  </form>
					<? }
				  ?>
                </table>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="10"></td>
				  </tr>
				</table>
				</td>
			  </tr>
			</table>
			<? }
			elseif ($action=='lessontype')
			{
				$table=$tablepre.'job_peixunkind';
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			  <tr bgcolor="#F1F2F4">
				<td width="50%" height="25" align="center" valign="top">
				<table width="100%"  border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="50" height="25" align="center">编号</td>
                    <td height="25" align="center">分类名称</td>
                    </tr>
				  <?
				  	$sql=$db->query("select * from $table order by id");
					while ($row=$db->row($sql))
					{?>
					  <tr bgcolor="#FFFFFF">
						<td width="50" height="25" align="center"><?=$row['id']?></td>
						<td height="25" align="center"><a href="peixun.php?action=lessontype&edit=on&info=<?=$row['id']?>"><?=$row['title']?></a></td>
					  </tr>
					<? }
				  ?>
				</table>
				</td>
				<td width="50%" height="25" align="center" valign="top">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="10"></td>
				  </tr>
				</table>
				<table width="95%"  border="0" cellpadding="0" cellspacing="1" class="input">
				  <?
				  	if ($edit=='on' && $info!='' && is_numeric($info) && $info>='1')
					{
						$edit=$db->row($db->query("select * from $table where id='$info'"));
					?>
					  <form action="peixun.php" method="post">
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center">编辑分类</td>
					  </tr>
					  <tr>
					    <td width="100" height="25" align="center">类别名称</td>
					    <td align="left"><input name="title" type="text" class="input" id="title" value="<?=$edit['title']?>"><input name="infoid" type="hidden" id="infoid" value="<?=$edit['id']?>"></td>
					  </tr>
					  </tr>
					  <tr bgcolor="#F1F2F4">
					    <td height="25" colspan="2" align="center"><input name="submit_lessonclassedit" type="submit" class="input" id="submit_classedit" value="编辑分类">
				        &nbsp;&nbsp;&nbsp;&nbsp;
				        <input name="Submit" type="button" class="input" value="取消编辑" onClick="javascript:history.go(-1)">
&nbsp;&nbsp;&nbsp;&nbsp;
<input name="submit_lessonclassdelete" type="submit" class="input" id="submit_classdelete" onClick="javascript:history.go(-1)" value="删除分类"></td>
					  </tr>
					  </form>
					<? }
					else
					{?>
					  <form action="peixun.php" method="post">
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center">增加新分类</td>
					  </tr>
					  <tr>
					    <td width="100" height="25" align="center">类别名称</td>
					    <td height="25" align="left"><input name="title" type="text" class="input" id="title"></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center"><input name="submit_lessonclassadd" type="submit" class="input" id="submit_classadd" value="增加新分类">
						  &nbsp;&nbsp;&nbsp;&nbsp;
						  <input name="Submit" type="reset" class="input" value="重置内容"></td>
					  </tr>
					  </form>
					<? }

				  ?>
                </table>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="10"></td>
				  </tr>
				</table>
				</td>
			  </tr>
			</table>
			<? }
			else if ($action=='school')
			{
				$table=$tablepre.'pxschool';
				if ($type=='search')
				{
					$sname=urldecode($sname);
					$contact_name=urldecode($contact_name);
					$address=urldecode($address);
					$str="id!=''";
					if ($sname!=''){$str.="and sname like '%".$sname."%'";}	else {$str=$str;}
					if ($schkind!='0'){$str.=" and schkind='$schkind'";} else {$str=$str;}
					if ($contact_name!=''){$str.=" and contact_name like '%".$contact_name."%'";} else {$str=$str;}
					if ($address!=''){$str.=" and address like '%".$address."%'";} else {$str=$str;}
					$str2="action=school&type=search&sname=".urlencode($sname)."&schkind=".$schkind."&contact_name=".urlencode($contact_name)."&address=".urlencode($address);
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				else if ($type=='on')
				{
					$str="sign='1'";
					$str2="action=school&type=on";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				else if ($type=='off')
				{
					$str="sign='0'";
					$str2="action=school&type=off";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				else
				{
					$str="0";
					$str2="action=school";
					require 'page_count.php';
					$sql="select * from $table order by id desc limit $offset,$psize";
				}
				$query=$db->query($sql);
				?>
				<script src="../css/check_all.js"></script>
				<table width="100%"  border="0" cellspacing="1" cellpadding="0">
				<form action="peixun.php" method="post">
				  <tr align="center" bgcolor="#E3E6EA">
					<td height="25">html</td>
					<td height="25">学校名称</td>
					<td>学校类别</td>
					<td height="25">状态</td>
					<td height="25">注册时间</td>
					<td height="25">联系人</td>
					<td height="25">操作</td>
					<td height="25"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
				  </tr>
				  <?
				  	while ($row=$db->row($query))
					{
						$htmlfile='../'.$htmlroot.$dirhtml_school.'/'.$row['htmlroot'].'/'.md5($row['username']).'.html';
						$htmllink=file_exists($htmlfile)?$htmlfile:'../view.php?action=school&info='.urlencode($row[username]);
					?>
					  <tr align="center" bgcolor="#F1F2F4">
						<td height="25"><? if ($html_school=='1')	{echo html_exists($htmlfile);}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
						<td height="25"><?='<a href=\''.$htmllink.'\' target=\'_blank\'>'.$row['sname'].'</a>'?></td>
						<td height="25"><?=$row['schkind']?></td>
						<td height="25"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
						<td height="25"><?=date("Y-n-j",$row['addtime'])?></td>
						<td height="25"><?=$row['contact_name']?></td>
						<td height="25"><a href="?action=edit_school&info=<?=$row['id']?>">编辑</a></td>
						<td height="25"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
					  </tr>
					<?
						unset($htmlfile,$htmllink);
					 }
				  ?>
				  <tr align="center" bgcolor="#E3E6EA">
					<td height="25" colspan="3"><? require 'page_show.php';?></td>
					<td height="25" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="5"></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_header()?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_center($default_school)?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_footer()?></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                      </tr>
                                        </table></td>
					<td height="25" colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30" align="center"><input name="school_show" type="submit" class="input" id="school_show" value="显示">
&nbsp;&nbsp;
      <input name="school_hidden" type="submit" class="input" id="school_hidden" value="隐藏">
&nbsp;&nbsp;
      <input name="school_delete" type="submit" class="input" id="school_delete" value="删除"></td>
                      </tr>
                      <tr>
                        <td height="30" align="center"><input name="toschool_html" type="submit" class="input" id="toschool_html" value="批量生成 html 文件"></td>
                      </tr>
                    </table></td>
				  </tr>
				</form>
				</table>
				<?
			}
			else if ($action=='edit_school')
			{
				$table=$tablepre.'pxschool';
				$query=$db->query("select * from $table where id='$info'");
				$num=$db->num($query);
				if ($num<='0')
				{
					echo refreshback('数据不存在');
					echo endhtml();
					echo wwwwanenet();
					echo showmsg('peixun.php?action=type','1');
					exit;
				}
				else
				{
					$row=$db->row($query);
				?>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="td_four">
                  <form action="peixun.php" method="post" name="input">
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">学校名称</td>
                      <td width="82%">&nbsp;
                        <input name="sname" type="text" class="input" id="sname" value="<?=$row[sname]?>" size="50" maxlength="50">
                          <input name="schid" type="hidden" id="schid" value="<?=$row[id]?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">学校类别</td>
                      <td width="82%">&nbsp;
                      <select name="schkind" id="schkind">
                          <?=select_school($row['schkind'],'1')?>
                      </select></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">学校简介</td>
                      <td>&nbsp;
                        <textarea name="context" cols="100" rows="8" wrap="VIRTUAL" class="input" id="context"><?=$row[context]?>
                        </textarea>
                      </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">课程说明</td>
                      <td height="119">&nbsp;
                      <textarea name="content" cols="100" rows="8" wrap="VIRTUAL" class="input" id="content"><?=$row[content]?>
                      </textarea></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">热点推荐</td>
                      <td>&nbsp;
                      <textarea name="sign_content" cols="100" rows="8" wrap="VIRTUAL" class="input" id="sign_content"><?=$row[sign_content]?>
                      </textarea></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">学校地址</td>
                      <td>&nbsp;
                      <input name="address" type="text" class="input" id="address" value="<?=$row[address]?>" size="60"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">邮政编码</td>
                      <td>&nbsp;
                      <input name="code" type="text" class="input" id="code" value="<?=$row[code]?>" size="12"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">联 系 人</td>
                      <td>&nbsp;
                      <input name="contact_name" type="text" class="input" id="contact_name" value="<?=$row[contact_name]?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">联系电话</td>
                      <td>&nbsp;
                      <input name="contact_phone" type="text" class="input" id="contact_phone" value="<?=$row[contact_phone]?>" size="45"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">传真号码</td>
                      <td>&nbsp;
                      <input name="fax" type="text" class="input" id="fax" value="<?=$row[fax]?>" size="50"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">E-mail</td>
                      <td>&nbsp;
                      <input name="email" type="text" class="input" id="email" value="<?=$row[email]?>" size="50"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="18%" height="30" align="center">学校网址</td>
                      <td>&nbsp;
                      <input name="url" type="text" class="input" id="url" value="<?=$row[url]?>" size="60"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td height="35" colspan="2" align="center"><input name="submit_editschool" type="submit" class="input" id="submit_registerschool" value="提交修改">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="reset" type="reset" class="input" id="reset" value=" 重  设 "></td>
                    </tr>
                  </form>
		    </table>
				<? }
			}
			else if ($action=='school_search')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="peixun.php" method="post">
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">学校名称</td>
				<td height="25">&nbsp;
				  <input name="sname" type="text" class="input" id="sname" size="38"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">学校类别</td>
				<td height="25">&nbsp;
				  <select name="schkind" id="schkind"><option value="0">不限</option><?=select_school('','1')?></select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">联 系 人</td>
				<td height="25">&nbsp;
				  <input name="contact_name" type="text" class="input" id="contact_name" size="20"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">学校地址</td>
				<td height="25">&nbsp;
				  <input name="address" type="text" class="input" id="address" size="60"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="35" colspan="2" align="center"><input name="submit_schoolsearch" type="submit" class="input" id="submit_schoolsearch" value=" 查 询 培 训 学 校 "></td>
				</tr>
			</form>
			</table>
			<? }
			else if ($action=='lesson')
			{
				$s=$tablepre.'pxschool';
				$k=$tablepre.'job_peixunkind';
				$l=$tablepre.'job_peixun';
				$table=$s.','.$k.','.$l;
				if ($type=='on')
				{
					$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
					$str="$l.sign='1' and $l.leixing=$k.id and $l.username=$s.username";
					$str2="action=lesson&type=on";
					require 'page_count.php';
					$sql="select $sstr from $table where $str order by $l.id desc limit $offset,$psize";
				}
				else if ($type=='off')
				{
					$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
					$str="$l.sign='0' and $l.leixing=$k.id and $l.username=$s.username";
					$str2="action=lesson&type=off";
					require 'page_count.php';
					$sql="select $sstr from $table where $str order by $l.id desc limit $offset,$psize";
				}
				else if ($type=='close')
				{
					$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
					$str="$l.losetime <= '".time()."' and $l.leixing=$k.id and $l.username=$s.username";
					$str2="action=lesson&type=close";
					require 'page_count.php';
					$sql="select $sstr from $table where $str order by $l.id desc limit $offset,$psize";
				}
				else if ($type=='search')
				{
					$puttime=($addtime=='0')?0:(time()-$addtime);
					$lesson=urldecode($lesson);
					$sname=urldecode($sname);
					$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
					$str="$l.id!=''";
					if ($puttime!='0')
					{
						$str.=" and $l.puttime >= '$puttime'";
					}
					else
					{
						$str=$str;
					}
					if ($leixing!='0')
					{
						$str.="and $l.leixing='$leixing'";
					}
					else
					{
						$str=$str;
					}
					if ($lesson!='')
					{
						$str.="and $l.lesson like '%".$lesson."%'";
					}
					else
					{
						$str=$str;
					}
					if ($sname!='')
					{
						$str.=" and $s.sname like '%".$sname."%'";
					}
					else
					{
						$str=$str;
					}
					$str.="and $l.leixing=$k.id and $l.username=$s.username";
					$str2="action=lesson&type=search&addtime=".$addtime."&lesson=".urlencode($lesson)."&leixing=".$leixing."&sname=".urlencode($sname);
					require 'page_count.php';
					$sql="select $sstr from $table where $str order by $l.id desc limit $offset,$psize";
				}
				else
				{
					$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
					$str="$l.leixing=$k.id and $l.username=$s.username";
					$str2="action=lesson";
					require 'page_count.php';
					$sql="select $sstr from $table where $str order by $l.id desc limit $offset,$psize";
				}
				$query=$db->query($sql);
			?>
			<script src="../css/check_all.js"></script>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="peixun.php" method="post">
			  <tr height="25" bgcolor="#E3E6EA" align="center">
				<td>html</td>
				<td>课程名称</td>
				<td>课程类别</td>
				<td>培训学校</td>
				<td>状态</td>
				<td>发布时间</td>
				<td>报名截至</td>
				<td>操作</td>
				<td><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <?
			  	while ($row=$db->row($query))
				{
					$htmlfile='../'.$htmlroot.$dirhtml_lesson.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
					$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'../view.php?action=lesson&info='.$row[id];
				?>
				  <tr height="25" bgcolor="#F1F2F4" align="center">
					<td><? if ($html_lesson=='1')	{echo html_exists($htmlfile);}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
					<td><?='<a href=\''.$htmllink.'\' target=\'_blank\'>'.$row[lesson].'</a>'?></td>
					<td><?=$row[title]?></td>
					<td><?=$row[sname]?></td>
					<td><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
					<td><?=date("Y-n-j",$row[puttime])?></td>
					<td><?=date("Y-n-j",$row[losetime])?></td>
					<td><a href="peixun.php?action=lesson_edit&info=<?=$row[id]?>">编辑</a></td>
					<td><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
				  </tr>
				<? }
			  ?>
			  <tr height="35" bgcolor="#E3E6EA" align="center">
				<td colspan="3"><? require 'page_show.php';?></td>
				<td colspan="3">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="5"></td>
				  </tr>
				  <tr>
					<td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
						<?=$HTML_TPL->get_header()?></td>
				  </tr>
				  <tr>
					<td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
						<?=$HTML_TPL->get_center($default_lesson)?></td>
				  </tr>
				  <tr>
					<td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
						<?=$HTML_TPL->get_footer()?></td>
				  </tr>
				  <tr>
					<td height="5"></td>
				  </tr>
                </table>
				</td>
				<td colspan="3">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="30" align="center"><input name="lesson_show" type="submit" class="input" id="lesson_show" value="显示">&nbsp;&nbsp;<input name="lesson_hidden" type="submit" class="input" id="lesson_hidden" value="隐藏">&nbsp;&nbsp; <input name="lesson_delete" type="submit" class="input" id="lesson_delete" value="删除"></td>
				  </tr>
				  <tr>
					<td height="30" align="center"><input name="tolesson_html" type="submit" class="input" id="tolesson_html" value="批量生成 html 文件"></td>
				  </tr>
				</table>
				</td>
			  </tr>
			</form>
			</table>
			<? }
			else if ($action=='lesson_edit')
			{
				$query=$db->query("select * from {$tablepre}job_peixun where id='$info'");
				if (!$db->num($query))		{echo clickback('资源指定无效');exit;}
				else
				{
					$row=$db->row($query);
					list($year0,$month0,$day0)=explode("-",date("Y-m-d",$row[losetime]));
				}
			?>
		  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" class="td_four">
            <form action="peixun.php" method="post">
              <tr bgcolor="f3f3f3">
                <td height="22" colspan="2" align="center" valign="middle">基 本 信 息</td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td width="23%" height="22" align="center" valign="middle">培训课程</td>
                <td width="77%" height="22">&nbsp;
                    <input name="lesson" type="text" class="input" id="lesson" value="<?=$row[lesson]?>" size="40">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">课程类型</td>
                <td height="22">&nbsp;
                    <select name="leixing" class="input" id="leixing"><?=select_lesson($row[leixing],'1')?></select>&nbsp;&nbsp;<font color="#FF0000">(*)
                    <input name="lessonid" type="hidden" id="lessonid" value="<?=$row[id]?>">
                    <input name="click" type="hidden" id="click" value="<?=$row[click]?>">
                    <input name="lesson_dir" type="hidden" id="lesson_dir" value="<?=$row[htmlroot]?>">
                    <input name="addtime" type="hidden" id="addtime" value="<?=$row[addtime]?>">
</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">开课日期</td>
                <td height="22">&nbsp;
                    <input name="year1" type="text" class="input" id="year1" value="<?=substr($row[start_time],'0','4')?>" size="4" maxlength="4">
        年
        <select name="month1" class="input" id="month1">
		  <option value="<?=substr($row[start_time],'5','2')?>"><?=substr($row[start_time],'5','2')?></option>
          <option value="01" {MONTH1_01}>1</option>
          <option value="02" {MONTH1_02}>2</option>
          <option value="03" {MONTH1_03}>3</option>
          <option value="04" {MONTH1_04}>4</option>
          <option value="05" {MONTH1_05}>5</option>
          <option value="06" {MONTH1_06}>6</option>
          <option value="07" {MONTH1_07}>7</option>
          <option value="08" {MONTH1_08}>8</option>
          <option value="09" {MONTH1_09}>9</option>
          <option value="10" {MONTH1_10}>10</option>
          <option value="11" {MONTH1_11}>11</option>
          <option value="12" {MONTH1_12}>12</option>
        </select>
        月
        <select name="day1" class="input" id="day1">
 			<option value="<?=substr($row[start_time],'8','2')?>"><?=substr($row[start_time],'8','2')?></option>
           <option value="01" {DAY1_01}>1</option>
          <option value="02" {DAY1_02}>2</option>
          <option value="03" {DAY1_03}>3</option>
          <option value="04" {DAY1_04}>4</option>
          <option value="05" {DAY1_05}>5</option>
          <option value="06" {DAY1_06}>6</option>
          <option value="07" {DAY1_07}>7</option>
          <option value="08" {DAY1_08}>8</option>
          <option value="09" {DAY1_08}>9</option>
          <option value="10" {DAY1_10}>10</option>
          <option value="11" {DAY1_11}>11</option>
          <option value="12" {DAY1_12}>12</option>
          <option value="13" {DAY1_13}>13</option>
          <option value="14" {DAY1_14}>14</option>
          <option value="15" {DAY1_15}>15</option>
          <option value="16" {DAY1_16}>16</option>
          <option value="17" {DAY1_17}>17</option>
          <option value="18" {DAY1_18}>18</option>
          <option value="19" {DAY1_19}>19</option>
          <option value="20" {DAY1_20}>20</option>
          <option value="21" {DAY1_21}>21</option>
          <option value="22" {DAY1_22}>22</option>
          <option value="23" {DAY1_23}>23</option>
          <option value="24" {DAY1_24}>24</option>
          <option value="25" {DAY1_25}>25</option>
          <option value="26" {DAY1_26}>26</option>
          <option value="27" {DAY1_27}>27</option>
          <option value="28" {DAY1_28}>28</option>
          <option value="29" {DAY1_29}>29</option>
          <option value="30" {DAY1_30}>30</option>
          <option value="31" {DAY1_31}>31</option>
        </select>
        日--
        <input name="year2" type="text" class="input" id="year2" value="<?=substr($row[start_time],'12','4')?>" size="4" maxlength="4">
        年
        <select name="month2" class="input" id="select3">
		 <option value="<?=substr($row[start_time],'17','2')?>"><?=substr($row[start_time],'17','2')?></option>
          <option value="01" {MONTH2_01}>1</option>
          <option value="02" {MONTH2_02}>2</option>
          <option value="03" {MONTH2_03}>3</option>
          <option value="04" {MONTH2_04}>4</option>
          <option value="05" {MONTH2_05}>5</option>
          <option value="06" {MONTH2_06}>6</option>
          <option value="07" {MONTH2_07}>7</option>
          <option value="08" {MONTH2_08}>8</option>
          <option value="09" {MONTH2_09}>9</option>
          <option value="10" {MONTH2_10}>10</option>
          <option value="11" {MONTH2_11}>11</option>
          <option value="12" {MONTH2_12}>12</option>
        </select>
        月
        <select name="day2" class="input" id="select2">
		 <option value="<?=substr($row[start_time],'20','2')?>"><?=substr($row[start_time],'20','2')?></option>
          <option value="01" {DAY2_01}>1</option>
          <option value="02" {DAY2_02}>2</option>
          <option value="03" {DAY2_03}>3</option>
          <option value="04" {DAY2_04}>4</option>
          <option value="05" {DAY2_05}>5</option>
          <option value="06" {DAY2_06}>6</option>
          <option value="07" {DAY2_07}>7</option>
          <option value="08" {DAY2_08}>8</option>
          <option value="09" {DAY2_08}>9</option>
          <option value="10" {DAY2_10}>10</option>
          <option value="11" {DAY2_11}>11</option>
          <option value="12" {DAY2_12}>12</option>
          <option value="13" {DAY2_13}>13</option>
          <option value="14" {DAY2_14}>14</option>
          <option value="15" {DAY2_15}>15</option>
          <option value="16" {DAY2_16}>16</option>
          <option value="17" {DAY2_17}>17</option>
          <option value="18" {DAY2_18}>18</option>
          <option value="19" {DAY2_19}>19</option>
          <option value="20" {DAY2_20}>20</option>
          <option value="21" {DAY2_21}>21</option>
          <option value="22" {DAY2_22}>22</option>
          <option value="23" {DAY2_23}>23</option>
          <option value="24" {DAY2_24}>24</option>
          <option value="25" {DAY2_25}>25</option>
          <option value="26" {DAY2_26}>26</option>
          <option value="27" {DAY2_27}>27</option>
          <option value="28" {DAY2_28}>28</option>
          <option value="29" {DAY2_29}>29</option>
          <option value="30" {DAY2_30}>30</option>
          <option value="31" {DAY2_31}>31</option>
        </select>
        日&nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">上课时间</td>
                <td height="22">&nbsp;
                    <input name="class_time" type="text" class="input" id="class_time" value="<?=$row[class_time]?>" size="40">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr bgcolor="#F1F2F4">
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">上课地址</td>
                <td height="22">&nbsp;
                    <input name="address" type="text" class="input" id="address" value="<?=$row[address]?>" size="50">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">培训费用</td>
                <td height="22">&nbsp;
                    <input name="money" type="text" class="input" id="money" value="<?=$row[money]?>" size="10">
        (元)&nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">学&nbsp;&nbsp;&nbsp;&nbsp;时</td>
                <td height="22">&nbsp;
                    <input name="classs" type="text" class="input" id="classs" value="<?=$row[classs]?>" size="20">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">培训讲师</td>
                <td height="22">&nbsp;
                    <input name="teacher" type="text" class="input" id="teacher" value="<?=$row[teacher]?>" size="20">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">报名截至</td>
                <td height="22" align="left" valign="middle">&nbsp;
                    <input name="year" type="text" class="input" id="year" value="<?=$year0?>" size="6" maxlength="4">
        年
        <select name="month" class="input" id="month">
		 <option value="<?=$month0?>"><?=$month0?></option>
          <option value="01" {MONTH_01}>1</option>
          <option value="02" {MONTH_02}>2</option>
          <option value="03" {MONTH_03}>3</option>
          <option value="04" {MONTH_04}>4</option>
          <option value="05" {MONTH_05}>5</option>
          <option value="06" {MONTH_06}>6</option>
          <option value="07" {MONTH_07}>7</option>
          <option value="08" {MONTH_08}>8</option>
          <option value="09" {MONTH_09}>9</option>
          <option value="10" {MONTH_10}>10</option>
          <option value="11" {MONTH_11}>11</option>
          <option value="12" {MONTH_12}>12</option>
        </select>
        月
        <select name="day" class="input" id="day">
		 <option value="<?=$day0?>"><?=$day0?></option>
          <option value="01" {DAY_01}>1</option>
          <option value="02" {DAY_02}>2</option>
          <option value="03" {DAY_03}>3</option>
          <option value="04" {DAY_04}>4</option>
          <option value="05" {DAY_05}>5</option>
          <option value="06" {DAY_06}>6</option>
          <option value="07" {DAY_07}>7</option>
          <option value="08" {DAY_08}>8</option>
          <option value="09" {DAY_08}>9</option>
          <option value="10" {DAY_10}>10</option>
          <option value="11" {DAY_11}>11</option>
          <option value="12" {DAY_12}>12</option>
          <option value="13" {DAY_13}>13</option>
          <option value="14" {DAY_14}>14</option>
          <option value="15" {DAY_15}>15</option>
          <option value="16" {DAY_16}>16</option>
          <option value="17" {DAY_17}>17</option>
          <option value="18" {DAY_18}>18</option>
          <option value="19" {DAY_19}>19</option>
          <option value="20" {DAY_20}>20</option>
          <option value="21" {DAY_21}>21</option>
          <option value="22" {DAY_22}>22</option>
          <option value="23" {DAY_23}>23</option>
          <option value="24" {DAY_24}>24</option>
          <option value="25" {DAY_25}>25</option>
          <option value="26" {DAY_26}>26</option>
          <option value="27" {DAY_27}>27</option>
          <option value="28" {DAY_28}>28</option>
          <option value="29" {DAY_29}>29</option>
          <option value="30" {DAY_30}>30</option>
          <option value="31" {DAY_31}>31</option>
        </select>
        日&nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td height="22" colspan="2" align="center" valign="middle">联 系 信 息</td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">联 系 人</td>
                <td height="22">&nbsp;
                    <input name="contact_name" type="text" class="input" id="contact_name" value="<?=$row[contact_name]?>" size="20">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">联系电话</td>
                <td height="22">&nbsp;
                    <input name="contact_phone" type="text" class="input" id="contact_phone" value="<?=$row[contact_phone]?>" size="25">
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">传&nbsp;&nbsp;&nbsp;&nbsp;真</td>
                <td height="22">&nbsp;
                    <input name="fax" type="text" class="input" id="fax" value="<?=$row[fax]?>" size="25"></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">E-mail</td>
                <td height="22">&nbsp;
                    <input name="email" type="text" class="input" id="email" value="<?=$row[email]?>" size="40"></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">学校网址</td>
                <td height="22">&nbsp;
                    <input name="url" type="text" class="input" id="url" value="<?=$row[url]?>" size="50"></td>
              </tr>
              <tr bgcolor="f3f3f3">
                <td height="22" colspan="2" align="center" valign="middle">备注信息</td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">培训目标</td>
                <td height="22">&nbsp;
                    <textarea name="direction" cols="90" rows="6" wrap="VIRTUAL" class="input" id="direction"><?=$row[direction]?></textarea></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">培训内容</td>
                <td height="22">&nbsp;
                    <textarea name="content" cols="90" rows="6" wrap="VIRTUAL" class="input" id="content"><?=$row[content]?></textarea>
                    &nbsp;&nbsp;<font color="#FF0000">(*)</font></td>
              </tr>
              <tr bgcolor="#F1F2F4">
                <td height="22" align="center" valign="middle">其它说明</td>
                <td height="22">&nbsp;
                    <textarea name="context" cols="90" rows="6" wrap="VIRTUAL" class="input" id="context"><?=$row[context]?></textarea></td>
              </tr>
              <tr bgcolor="f3f3f3">
                <td height="30" colspan="2" align="center" valign="middle"><input name="submit_peixun_edit" type="submit" class="input" id="submit_peixun_edit" value="编辑培训">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Submit2" type="reset" class="input" value="重置"></td>
              </tr>
            </form>
          </table>
			<? }
			else if ($action=='lesson_search')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="peixun.php" method="post">
			  <tr>
				<td align="center" align="center" height="25" bgcolor="#E3E6EA" colspan="2">培 训 查 询</td>
			  </tr>
			  <tr bgcolor="#F1F2F4" height="25">
				<td align="center">发表时间</td>
				<td>&nbsp;<select name="addtime" id="addtime">
                    <option value="0">不限</option>
                    <option value="3600">1 小时时内</option>
                    <option value="86400">24 小时以内</option>
                    <option value="604800">一星期以内</option>
                    <option value="1296000">15 天以内</option>
                    <option value="2392000">30 天以内</option>
                    <option value="7176000">90 天以内</option>
                    <option value="16243200">半年以内</option>
                    <option value="32486400">1 年以内</option>
                  </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4" height="25">
				<td align="center" width="25%">课程名称</td>
				<td>&nbsp;<input class="input" name="lesson" size="50"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4" height="25">
				<td align="center">课程类别</td>
				<td>&nbsp;<select name="leixing" class="input"><option value="0">所有分类</option><?=select_lesson('',1)?></select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4" height="25">
				<td align="center">培训学校</td>
				<td>&nbsp;<input class="input" name="sname" size="50"></td>
			  </tr>
			  <tr>
				<td align="center" align="center" height="25" bgcolor="#E3E6EA" colspan="2"><input class="input" type="submit" name="submit_lesson_search" value="培 训 课 程 查 询"></td>
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
