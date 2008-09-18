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
		if ($job_show)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$table=$tablepre.'teacher_job';
				$ids=$comma="";
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("UPDATE $table SET sign='1' WHERE id in ($ids)");
				update_cache('teacherjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=job&status='.$status,'1');
				exit;
			}
		}
		elseif ($job_hidden)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$table=$tablepre.'teacher_job';
				$ids=$comma="";
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("UPDATE $table SET sign='0' WHERE id in ($ids)");
				update_cache('teacherjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=job&status='.$status,'1');
				exit;
			}
		}
		elseif ($job_delete)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$table=$tablepre.'teacher_job';
				$ids=$comma="";
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("select id,htmlroot from $table where id in ($ids)");
				while ($row=$db->row($query))
				{
					$jobfile='../'.$htmlroot.$dirhtml_findteacher.'/'.$row[htmlroot].'/'.$row[id].'.html';
					if (file_exists($jobfile))
					{
						delete_file($jobfile);
					}
				}
				$db->query("DELETE FROM $table WHERE id IN ($ids)");
				update_cache('teacherjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=job&status='.$status,'1');
				exit;
			}
		}
		elseif ($submit_jobsearch)
		{
			$searchurl="teacher.php?action=job&status=search&puttime=".$puttime."&title=".urlencode($title)."&sex=".urlencode($sex)."&edu=".urlencode($edu)."&depart=".urlencode($depart)."&address=".urlencode($address);
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($searchurl,'1');
			exit;
		}
		elseif ($tojob_html)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$table=$tablepre.'teacher_job';
				$ids=$comma="";
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$sql=$db->query("SELECT * FROM $table WHERE id IN ($ids)");
				while ($row=$db->row($sql))
				{
					$sql_data=array(
						'INFOID'	=>	$row[id],
						'WEBTITLE'	=>	headtitle($row[title]),
						'TITLE'		=>	$row[title],
						'SEX'		=>	$row[sex],
						'EDU'		=>	$row[edu],
						'ADDRESS'	=>	$row[address],
						'DEPART'	=>	$row[depart],
						'CONTENT'	=>	wane_text($row[content]),
						'CONTEXT'	=>	wane_text($row[context]),
						'CONTACT'	=>	$row[contact_name],
						'PHONE'		=>	$row[contact_phone],
						'EMAIL'		=>	$row[email],
						'ADDTIME'	=>	date($time_putteacher,$row[puttime]),
						'LOSETIME'	=>	date($time_putteacher,$row[losetime]),
						'CLICK'		=>	$row[click],
					);
					$c_html->c_teacherjob($html_header,$html_center,$html_footer,$row[id],$dirhtml_findteacher,$row[htmlroot],$sql_data,'1');
				}
				update_cache('teacherjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=job&status='.$status,'1');
				exit;
			}
		}
		elseif ($find_show)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma="";
				foreach	($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("UPDATE {$tablepre}teacher_find SET sign='1' WHERE id IN ($ids)");
				update_cache('teacherfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=find&status='.$status,'1');
				exit;
			}
		}
		elseif ($find_hidden)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma="";
				foreach	($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$db->query("UPDATE {$tablepre}teacher_find SET sign='0' WHERE id IN ($ids)");
				update_cache('teacherfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=find&status='.$status,'1');
				exit;
			}
		}
		elseif ($find_delete)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma="";
				foreach	($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("select * from {$tablepre}teacher_find where id in ($ids)");
				while ($row=$db->row($query))
				{
					$findfile='../'.$htmlroot.$dirhtml_taketeacher.'/'.$row[htmlroot].'/'.$row[id].'.html';
					if (file_exists($findfile))
					{
						delete_file($findfile);
					}
				}
				$db->query("DELETE FROM {$tablepre}teacher_find WHERE id IN ($ids)");
				update_cache('teacherfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=find&status='.$status,'1');
				exit;
			}
		}
		elseif ($submit_findsearch)
		{
			$searchurl="teacher.php?action=find&status=search&puttime=".$puttime."&title=".urlencode($title)."&truename=".urlencode($truename)."&sex=".urlencode($sex)."&edu=".urlencode($edu)."&depart=".urlencode($depart);
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($searchurl,'1');
			exit;
		}
		elseif ($tofind_html)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$table=$tablepre.'teacher_find';
				$ids=$comma="";
				foreach ($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$sql=$db->query("SELECT * FROM $table WHERE id IN ($ids)");
				while ($row=$db->row($sql))
				{
					$sql_data=array(

							'INFOID'	=>	$row[id],
							'WEBTITLE'	=>	headtitle($row[title]),

							'TITLE'		=>	$row[title],
							'TRUENAME'	=>	$row[truename],
							'SEX'		=>	$row[sex],
							'EDU'		=>	$row[edu],

							'DEPART'	=>	$row[depart],
							'LIVING'	=>	$row[living],
							'WORK'		=>	wane_text($row[job]),
							'CONTEXT'	=>	wane_text($row[context]),

							'PHONE'		=>	$row[phone],
							'EMAIL'		=>	$row[email],

							'ADDTIME'	=>	date($time_putteacher,$row[puttime]),
							'LOSETIME'	=>	date($time_putteacher,$row[losetime]),
							'CLICK'		=>	$row[click],

					);
					$c_html->c_teacherfind($html_header,$html_center,$html_footer,$row[id],$dirhtml_taketeacher,$row[htmlroot],$sql_data,'1');
				}
				update_cache('teacherfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('teacher.php?action=find&status='.$status,'1');
				exit;
			}
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=job">招聘家教</a> | <a href="?action=job&status=on">已验证招聘</a> | <a href="?action=job&status=off">未验证招聘</a> | <a href="?action=job&status=close">过期招聘</a> | <a href="?action=jobsearch">查询招聘</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=find">求职家教</a> | <a href="?action=find&status=on">已验证求职</a> | <a href="?action=find&status=off">未验证求职</a> | <a href="?action=find&status=close">过期求职</a> | <a href="?action=findsearch">求职查询</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<?
			if ($action=='job')
			{
				$table=$tablepre.'teacher_job';
				if ($status=='on')
				{
					$str="sign='1'";
					$str2="action=job&status=on";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				elseif ($status=='off')
				{
					$str="sign='0'";
					$str2="action=job&status=off";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				elseif ($status=='close')
				{
					$str="losetime<'".time()."'";
					$str2="action=job&status=close";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				elseif ($status=='search')
				{
					$str="id!=''";
					if ($puttime=='0'){$str=$str;}else{$str=$str." and puttime > ".(time()-$puttime);}
					if ($title==''){$str=$str;}else{$str=$str." and title like '%".urldecode($title)."%'";}
					if ($sex=='0'){$str=$str;}else{$str=$str." and sex='".urldecode($sex)."'";}
					if ($edu=='0'){$str=$str;}else{$str=$str." and edu='".urldecode($edu)."'";}
					if ($depart=='0'){$str=$str;}else{$str=$str." and depart like '%".urldecode($depart)."%'";}
					if ($address==''){$str=$str;}else{$str=$str." and address like '%".urldecode($address)."%'";}
					$str2="action=job&status=search&puttime=".$puttime."&title=".$title."&sex=".$sex."&edu=".$edu."&depart=".$depart."&address=".$address;
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				else
				{
					$str="0";
					$str2="action=job";
					require 'page_count.php';
					$sql="select * from $table order by id desc limit $offset,$psize";
				}
				$query=$db->query($sql);
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			<form action="teacher.php" method="post">
			  <tr bgcolor="#E6E8EA">
				<td height="25" align="center">html</td>
				<td align="center">状态</td>
				<td height="25" align="center">标题</td>
				<td align="center">性别要求</td>
				<td align="center">学历要求</td>
				<td align="center">专业要求</td>
				<td align="center">发布时间;截至时间</td>
				<td align="center">操作</td>
				<td align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <?
			  	while ($row=$db->row($query))
				{
					$htmlfile='../'.$htmlroot.$dirhtml_findteacher.'/'.$row[htmlroot].'/'.$row[id].'.html';
					$htmlfilelink=file_exists($htmlfile)	?	$htmlfile	:	'../view.php?action=teacherjob&info='.$row[id];
				?>
				  <tr bgcolor="#F1F2F4">
					<td height="25" align="center"><? if ($html_job=='1')	{echo html_exists('../'.$htmlroot.$dirhtml_findteacher.'/'.$row['htmlroot'].'/'.$row['id'].'.html');}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
					<td height="25" align="center"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
					<td height="25" align="center"><a href="<?=$htmlfilelink?>" target="_blank"><?=$row[title]?></a></td>
					<td align="center"><?=$row[sex]?></td>
					<td align="center"><?=$row[edu]?></td>
					<td align="center"><?=$row[depart]?></td>
					<td align="center"><? echo date("m-d",$row['puttime']).' ; ';if ($row['losetime']<time()) {echo '<font color=\'#ff0000\'>'.date("Y-m-d",$row['losetime']).'</font>';} else {echo date("Y-m-d",$row['losetime']);}?>
				    <input name="status" type="hidden" id="status" value="<?=$status?>">				    </td>
					<td align="center"><a href="?action=jobedit&info=<?=$row[id]?>">编辑</a></td>
					<td align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
				  </tr>
				<?
					unset($htmlfile,$htmlfilelink);
				}
			  ?>
			  <tr bgcolor="#E6E8EA">
			    <td height="25" colspan="5" align="center"><? require 'page_show.php';?></td>
			    <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                        <?=$HTML_TPL->get_header()?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                        <?=$HTML_TPL->get_center($default_findteacher)?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
                        <?=$HTML_TPL->get_footer()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			    <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="center"><input name="job_hidden" type="submit" class="input" id="job_hidden" value="隐">
                      <input name="job_show" type="submit" class="input" id="job_show" value="显">
                      <input name="job_delete" type="submit" class="input" id="job_delete" value="删"></td>
                  </tr>
                  <tr>
                    <td height="30" align="center"><input name="tojob_html" type="submit" class="input" id="tojob_html" value=" H T M L "></td>
                  </tr>
                </table></td>
			    </tr>
			</form>
			</table>
			<? }
			elseif ($action=='jobsearch')
			{?>
			<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
			<form action="teacher.php" method="post">
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="30" colspan="2" bgcolor="#E6E8EA">家 教 职 位 查 询</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">发表时间</td>
			    <td height="25">&nbsp;
			      <select name="puttime" class="input" id="puttime">
                    <option value="0">不限</option>
                    <option value="3600">1 小时内</option>
                    <option value="43200">12 小时内</option>
                    <option value="86400">24 小时内</option>
                    <option value="604800">一星期</option>
                    <option value="1296000">15 天以内</option>
                    <option value="2678400">一个月 发内</option>
                    <option value="7905600">三个月</option>
                    <option value="15811200">半年</option>
                    <option value="31622400">一年</option>
                  </select></td>
			    </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">标&nbsp;&nbsp;&nbsp;&nbsp;题</td>
				<td height="25">&nbsp;
				  <input name="title" type="text" class="input" id="title" size="60"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">性别要求</td>
				<td height="25">&nbsp;				  <select name="sex" class="input" id="sex">
                  <option value="0">不限</option>
                  <option value="男">男</option>
                  <option value="女">女</option>
                </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">学&nbsp;&nbsp;&nbsp;&nbsp;历</td>
			    <td height="25">&nbsp;
			      <select name="edu" class="input" id="edu">
			        <option value="0">不限</option>
		          </select></td>
			    </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">专业要求</td>
				<td height="25">&nbsp;
				  <select name="depart" class="input" id="depart">
				    <option value="0">不限</option>
			      </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">家教地点</td>
				<td height="25">&nbsp;
				  <input name="address" type="text" class="input" id="address" size="45"></td>
			  </tr>
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="30" colspan="2" bgcolor="#E6E8EA"><input name="submit_jobsearch" type="submit" class="input" id="submit_jobsearch" value=" 家 教 职 位 查 询 "></td>
				</tr>
			</form>
			</table>
			<? }
			else if ($action=='find')
			{
				$table=$tablepre.'teacher_find';
				if ($status=='on')
				{
					$str="sign='1'";
					$str2="action=find&status=on";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				elseif ($status=='off')
				{
					$str="sign='0'";
					$str2="action=find&status=off";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				elseif ($status=='close')
				{
					$str="losetime<'".time()."'";
					$str2="action=find&status=close";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				elseif ($status=='search')
				{
					$str="id!=''";
					if ($puttime=='0'){$str=$str;}else{$str=$str." and puttime > '".(time()-$puttime)."'";}
					if ($title==''){$str=$str;}else{$str=$str." and title like '%".urldecode($title)."%'";}
					if ($truename==''){$str=$str;}else{$str=$str." and truename like '%".urldecode($truename)."%'";}
					if ($sex=='0'){$str=$str;}else{$str=$str." and sex='".urldecode($sex)."'";}
					if ($edu=='0'){$str=$str;}else{$str=$str." and edu = '".urldecode($edu)."'";}
					if ($depart==''){$str=$str;}else{$str=$str." and depart like '%".urldecode($depart)."%'";}
					$str2="action=find&status=search&puttime=$puttime&title=$title&truename=$truename&sex=$sex&edu=$edu&depart=$depart";
					require 'page_count.php';
					$sql="select * from $table where $str order by id desc limit $offset,$psize";
				}
				else
				{
					$str="0";
					$str2="action=find";
					require 'page_count.php';
					$sql="select * from $table order by id desc limit $offset,$psize";
				}
				$query=$db->query($sql);
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			<form action="teacher.php" method="post">
			  <tr bgcolor="#E6E8EA">
				<td height="25" align="center">html</td>
				<td align="center">状态</td>
				<td height="25" align="center">标题</td>
				<td align="center">姓名</td>
				<td align="center">性别要求</td>
				<td align="center">学历要求</td>
				<td align="center">专业要求</td>
				<td align="center">发布时间;截至时间</td>
				<td align="center">操作</td>
				<td align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <?
			  	while ($row=$db->row($query))
				{
					$htmlfile='../'.$htmlroot.$dirhtml_taketeacher.'/'.$row[htmlroot].'/'.$row[id].'.html';
					$htmlfilelink=file_exists($htmlfile)	?	$htmlfile	:	'../view.php?action=teacherfind&info='.$row[id];
				?>
				  <tr bgcolor="#F1F2F4">
					<td height="25" align="center"><? if ($html_job=='1')	{echo html_exists('../'.$htmlroot.$dirhtml_taketeacher.'/'.$row['htmlroot'].'/'.$row['id'].'.html');}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
					<td height="25" align="center"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
					<td height="25" align="center"><a href="<?=$htmlfilelink?>" target="_blank"><?=$row[title]?></a></td>
					<td height="25" align="center"><a href="<?=$htmlfilelink?>" target="_blank">
					  <?=$row[truename]?>
					</a></td>
					<td align="center"><?=$row[sex]?></td>
					<td align="center"><?=$row[edu]?></td>
					<td align="center"><?=$row[depart]?></td>
					<td align="center"><? echo date("m-d",$row['puttime']).' ; ';if ($row['losetime']<time()) {echo '<font color=\'#ff0000\'>'.date("Y-m-d",$row['losetime']).'</font>';} else {echo date("Y-m-d",$row['losetime']);}?>
				    <input name="status" type="hidden" id="status" value="<?=$status?>">				    </td>
					<td align="center"><a href="?action=findedit&info=<?=$row[id]?>">编辑</a></td>
					<td align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
				  </tr>
				<?
				unset($htmlfile,$htmlfilelink);
				}
			  ?>
			  <tr bgcolor="#E6E8EA">
			    <td height="25" colspan="6" align="center"><? require 'page_show.php';?></td>
			    <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                        <?=$HTML_TPL->get_header()?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                        <?=$HTML_TPL->get_center($default_taketeacher)?></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
                        <?=$HTML_TPL->get_footer()?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                </table></td>
			    <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="center"><input name="find_hidden" type="submit" class="input" id="find_hidden" value="隐">
                      <input name="find_show" type="submit" class="input" id="find_show" value="显">
                      <input name="find_delete" type="submit" class="input" id="find_delete" value="删"></td>
                  </tr>
                  <tr>
                    <td height="30" align="center"><input name="tofind_html" type="submit" class="input" id="tofind_html" value=" H T M L "></td>
                  </tr>
                </table></td>
			    </tr>
			</form>
			</table>
			<? }
			elseif ($action=='findsearch')
			{?>
			<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
              <form action="teacher.php" method="post">
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="30" colspan="2" bgcolor="#E6E8EA">家 教 人 才 查 询</td>
                </tr>
                <tr bgcolor="#F1F2F4">
                  <td height="25" align="center">发表时间</td>
                  <td height="25">&nbsp;
                    <select name="puttime" class="input" id="puttime">
                      <option value="0">不限</option>
                      <option value="3600">1 小时内</option>
                      <option value="43200">12 小时内</option>
                      <option value="86400">24 小时内</option>
                      <option value="604800">一星期</option>
                      <option value="1296000">15 天以内</option>
                      <option value="2678400">一个月 发内</option>
                      <option value="7905600">三个月</option>
                      <option value="15811200">半年</option>
                      <option value="31622400">一年</option>
                    </select></td>
                </tr>
                <tr bgcolor="#F1F2F4">
                  <td width="20%" height="25" align="center">标&nbsp;&nbsp;&nbsp;&nbsp;题</td>
                  <td height="25">&nbsp;
                  <input name="title" type="text" class="input" id="title" size="60"></td>
                </tr>
                <tr bgcolor="#F1F2F4">
                  <td width="20%" height="25" align="center">姓&nbsp;&nbsp;&nbsp;&nbsp;名</td>
                  <td height="25">&nbsp;
                  <input name="truename" type="text" class="input" id="truename"></td>
                </tr>
                <tr bgcolor="#F1F2F4">
                  <td width="20%" height="25" align="center">性&nbsp;&nbsp;&nbsp;&nbsp;别</td>
                  <td height="25">&nbsp;
                    <select name="sex" class="input" id="sex">
                      <option value="0">不限</option>
                      <option value="男">男</option>
                      <option value="女">女</option>
                        </select></td>
                </tr>
                <tr bgcolor="#F1F2F4">
                  <td height="25" align="center">学&nbsp;&nbsp;&nbsp;&nbsp;历</td>
                  <td height="25">&nbsp;
                    <select name="edu" class="input" id="edu">
                      <option value="0">不限</option>
                        </select></td>
                </tr>
                <tr bgcolor="#F1F2F4">
                  <td width="20%" height="25" align="center">专&nbsp;&nbsp;&nbsp;&nbsp;业</td>
                  <td height="25">&nbsp;
                  <input name="depart" type="text" class="input" id="depart" size="35"></td>
                </tr>
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="30" colspan="2" bgcolor="#E6E8EA"><input name="submit_findsearch" type="submit" class="input" id="submit_findsearch" value=" 家 教 人 才 查 询 "></td>
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
