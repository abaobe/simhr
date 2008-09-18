<?php
	require "admin_globals.php";
	require "admin_check.php";
	$action=$HTTP_GET_VARS['action'];
	$count='15';
	$jt=JOBTABLE;
	$ft=FINDJOBTABLE;
	$cj=QYJIANLITABLE;
	$pj=JIANLITABLE;
	$jobtypefile	=	'../common/cache/cache_jobtype.php';
	if (!file_exists($jobtypefile))
	{
		update_cache('jobtype','1');
		exit('Create cache . <BR>Please refreesh.');
	}
	else
	{
		require $jobtypefile;
	}
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
<!-- take start -->
<?
	if ($show_job)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$ids = $comma = '';
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma = ',';
			}
			$sql="UPDATE $jt SET sign='1' where id in ($ids)";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('job','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($hidden_job)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$ids = $comma = '';
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma = ',';

			}
			$sql="UPDATE $jt SET sign='0' where id in ($ids)";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('job','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($delete_job)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$ids = $comma = '';
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma = ',';
			}
			$sql=$db->query("select id,htmlroot from $jt where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$c_html->d_job($row['htmlroot'],$row['id'],1);
			}
			unset($sql);
			$sql="DELETE FROM $jt where id in ($ids)";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('job','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($tohtml_job)
	{
		if ($html_job!='1')		{echo clickback('生成 html 静态文件选项 关闭');exit;}
		else if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids='';
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$sql="select $jt.*,$cj.qyuser,$cj.qyname from $jt,$cj where $jt.username=$cj.qyuser and $jt.id in ($ids)";
			$query=$db->query($sql);
			while ($row=$db->row($query))
			{
				$sql_data=array(
					'WEBTITLE'=>$row['qyname'].' 招聘 '.$row['job'],
					'INFOTITLE'=>'[<a href=../../../view.php?action=company&info='.urlencode($row['qyuser']).' target=\'_blank\'>'.$row['qyname'].'</a>] 招聘 '.$row['job'],
					'JOB'=>$row['job'],
					'COMPANY'=>$row['qyname'],
					'LINK'=>$row['id'],
					'LINKCOM'=>urlencode($row['username']),
					'JOBMAN'=>$row['man'],
					'JOBPRO'=>$row['job_pro'],
					'JOBTIME'=>$row['job_time'],
					'JOBAGE'=>$row['age'],
					'JOBSEX'=>$row['sex'],
					'JOBHEIGHT'=>$row['height'],
					'JOBWEIGHT'=>$row['weight'],
					'JOBSIGHT'=>$row['sight'],
					'JOBSOCIAL'=>$row['social'],
					'JOBSALARY'=>$row['money'],
					'JOBADDR'=>$row['address'],
					'JOBEDU'=>$row['edu'],
					'JOBENG'=>$row['eng'],
					'JOBDEPART'=>$row['department'],
					'JOBCONTEXT'=>wane_text($row['worktext']),
					'ADDTIME'=>date("Y-m-d",$row['puttime']),
					'LOSETIME'=>date("Y-m-d",$row['losetime']),
					'CLICK'=>$row['click'],
				);
				$c_html->c_job($html_header,$html_center,$html_footer,$row['id'],$dirhtml_job,$row['htmlroot'],$sql_data,1);
			}
			update_cache('job','1');
		}
	}//+	end job part
	elseif ($show_find)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$ids = $comma = '';
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma = ',';
			}
			$sql="UPDATE $ft SET sign='1' where id in ($ids)";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('find','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($hidden_find)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$ids = $comma = '';
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma = ',';
			}
			$sql="UPDATE $ft SET sign='0' where id in ($ids)";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('find','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($delete_find)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$ids = $comma = '';
			foreach ($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma = ',';
			}
			$sql=$db->query("select id,htmlroot from $ft where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$c_html->d_find($row['htmlroot'],$row['id'],1);
			}
			unset($sql);
			$sql="DELETE FROM $ft where id in ($ids)";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('find','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($tohtml_find)
	{
		if ($html_find!='1')	{echo clickback('生成 html 静态文件选项 关闭');exit;}
		else if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids='';
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$sql="select $ft.*,$pj.username,$pj.truename,$pj.sex,$pj.birth,$pj.mingzu,$pj.edu,$pj.engname,$pj.engnengli,$pj.zhuanye,$pj.zhuanyename,$pj.phone,$pj.handphone,$pj.email,$pj.homepage from $ft,$pj where $ft.username=$pj.username and $ft.id in ($ids)";
			$query=$db->query($sql);
			while ($row=$db->row($query))
			{
				$sql_data=array(
					'WEBTITLE'=>headtitle($row['truename'].' 求职位 '.$row['job']),
					'INFOTITLE'=>'[<a href=../../../view.php?action=personal&info='.urlencode($row['username']).' target=\'_blank\'>'.$row['truename'].'</a>] 求职位 '.$row['job'],
					'JOB'=>$row['job'],
					'TRUENAME'=>$row['truename'],
					'JLLINK'=>urlencode($row['username']),
					'LINK'=>$row['id'],

					'WORK_ADDRESS'=>$row['work_address'],
					'SEX'=>$row['sex'],
					'BIRTH'=>$row['birth'],
					'MINZU'=>$row['mingzu'],
					'EDU'=>$row['edu'],
					'ENG_NENGLI'=>$row['engname'].' &nbsp;&nbsp; '.$row['engnengli'],
					'ZHUANYE'=>$row['zhuanye'],
					'ZHUANYENAME'=>$row['zhuanyename'],

					'PHONE'=>$row['phone'],
					'HANDPHONE'=>$row['handphone'],
					'EMAIL'=>$row['email'],
					'HOMEPAGE'=>$row['homepage'],
					'JOBTEXT'=>wane_text($row['jobtext']),

					'ADDTIME'=>date("Y-m-d",$row['puttime']),
					'LOSETIME'=>date("Y-m-d",$losetime),
					'CLICK'=>$row['click'],
				);
				$c_html->c_find($html_header,$html_center,$html_footer,$row['id'],$dirhtml_find,$row['htmlroot'],$sql_data,1);
			}
			update_cache('find','1');
		}
	}
	else if ($search_job)
	{
		$puttime=$HTTP_POST_VARS['puttime'];
		$job=urlencode($HTTP_POST_VARS['job']);
		$qyname=urlencode($HTTP_POST_VARS['qyname']);
		$man=$HTTP_POST_VARS['man'];
		$url="job.php?action=job&info=search&puttime=".$puttime."&job=".$job."&qyname=".$qyname."&man=".$man;
		echo refreshback('查询结束');
		echo endhtml();
		echo wwwwanenet();
		echo showmsg($url,'1');
		exit;
	}
	else if ($search_find)
	{
		$puttime=$HTTP_POST_VARS['puttime'];
		$job=urlencode($HTTP_POST_VARS['job']);
		$truename=urlencode($HTTP_POST_VARS['truename']);
		$sex=urlencode($HTTP_POST_VARS['sex']);
		$url="job.php?action=find&info=search&puttime=".$puttime."&job=".$job."&truename=".$truename."&sex=".$sex;
		echo refreshback('查询结束');
		echo endhtml();
		echo wwwwanenet();
		echo showmsg($url,'1');
		exit;
	}
	else if ($save_jobedit)
	{
		$losetime=mktime(23,59,59,$HTTP_POST_VARS['month'],$HTTP_POST_VARS['day'],$HTTP_POST_VARS['year']);
        $sql="update $jt
                    set
					   tid='$tid',
                       job='".addslashes($HTTP_POST_VARS['job'])."',
                       man='".addslashes($HTTP_POST_VARS['man'])."',
                       address='".addslashes($HTTP_POST_VARS['address'])."',
                       job_pro='".$HTTP_POST_VARS['job_pro']."',
                       job_time='".$HTTP_POST_VARS['job_time']."',
                       age='".$HTTP_POST_VARS['age']."',
                       sex='".$HTTP_POST_VARS['sex']."',
                       height='".addslashes($HTTP_POST_VARS['height'])."',
                       weight='".addslashes($HTTP_POST_VARS['weight'])."',
                       sight='".addslashes($HTTP_POST_VARS['sight'])."',
                       social='".$HTTP_POST_VARS['social']."',
                       edu='".$HTTP_POST_VARS['edu']."',
                       eng='".$HTTP_POST_VARS['eng']."',
                       depart='".$HTTP_POST_VARS['smajortype']."',
                       department='".$HTTP_POST_VARS['smajorname']."',
					   losetime='$losetime',
                       worktext='".addslashes($HTTP_POST_VARS['worktext'])."',
                       money='".$HTTP_POST_VARS['money']."',
                       sign='".$HTTP_POST_VARS['sign']."'
                    where id='".$HTTP_POST_VARS['infoid']."'";
		$query=$db->query($sql);
		if (!$query)	{echo clickback('操作失败');exit;}
		else
		{
			update_cache('job','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($HTTP_POST_VARS['goto'],'1');
			exit;
		}
	}
	else if ($save_findedit)
	{
		$losetime=mktime(23,59,59,$HTTP_POST_VARS['month'],$HTTP_POST_VARS['day'],$HTTP_POST_VARS['year']);
        $sql="update $ft
                    set
					   tid='$tid',
                       job='".addslashes($HTTP_POST_VARS['job'])."',
					   losetime='$losetime',
                       jobtext='".addslashes($HTTP_POST_VARS['jobtext'])."',
                       work_address='".addslashes($HTTP_POST_VARS['work_address'])."',
                       sign='".$HTTP_POST_VARS['sign']."'
                    where id='".$HTTP_POST_VARS['infoid']."'";
		$query=$db->query($sql);
		if (!$query)	{echo clickback('操作失败');exit;}
		else
		{
			update_cache('find','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($HTTP_POST_VARS['goto'],'1');
			exit;
		}
	}
?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=job&info=all">最新招聘</a>&nbsp;|&nbsp;<a href="?action=job&info=no">未验证招聘</a>&nbsp;|&nbsp;<a href="?action=job&info=yes">已验证</a>&nbsp;|&nbsp;&nbsp;<a href="?action=job_search">查询招聘</a>&nbsp;|&nbsp;<a href="?action=job&info=experite">过期招聘</a>&nbsp;|&nbsp;<a href="?action=find&info=all">最新求职</a>&nbsp;|&nbsp;<a href="?action=find&info=no">未验证求职</a>&nbsp;|&nbsp;<a href="?action=find&info=yes">已验证</a>&nbsp;|&nbsp;<a href="?action=find_search">查询求职</a>&nbsp;|&nbsp;<a href="?action=find&info=experite">过期求职</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<!-- unit info start -->
		<?
			if ($action=='job')
			{
				$table=$jt.','.$cj;
				$sstr="$jt.*,$cj.qyuser,$cj.qyname";
				$info=$HTTP_GET_VARS['info'];
				if ($info=='yes')
				{
					$str="$jt.username=$cj.qyuser and $jt.sign='1'";
					$str2="action=job&info=$info";
				}
				else if ($info=='no')
				{
					$str="$jt.username=$cj.qyuser and $jt.sign='0'";
					$str2="action=job&info=$info";
				}
				else if ($info=='experite')
				{
					$str="$jt.username=$cj.qyuser and $jt.losetime<='".time()."'";
					$str2="action=job&info=$info";
				}
				else if ($info=='search')
				{
					$puttime=$HTTP_GET_VARS['puttime'];
					$job=urldecode($HTTP_GET_VARS['job']);
					$qyname=urldecode($HTTP_GET_VARS['qyname']);
					$man=$HTTP_GET_VARS['man'];
					$str="$jt.username=$cj.qyuser";
					if ($job=='')	{$str=$str;}	else	{$str=$str." and $jt.job like '%$job%'";}
					if ($man=='' || $man=='0')	{$str=$str;}	else	{$str=$str." and $jt.man='$man'";}
					if ($puttime=='0')	{$str=$str;}	else	{$str=$str." and $jt.puttime>'".(time()-$puttime)."'";}
					if ($qyname=='')	{$str=$str;}	else	{$str=$str." and $cj.qyname like '%$qyname%'";}
					$str2="action=job&info=search&puttime=".$puttime."&job=".urlencode($job)."&qyname=".urlencode($qyname)."&man=".$man;
				}
				else
				{
					$str="$jt.username=$cj.qyuser";
					$str2="action=job&info=$info";
				}
				require 'page_count.php';
				$sql="SELECT $sstr from $table where $str order by puttime desc limit $offset,$psize";
				$query=$db->query($sql);
				?>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
					  <form action="job.php" method="post">
					  <tr bgcolor="#E7E7F1">
						<td align="center">html</td>
						<td height="25" align="center">职位名称
						<input name="goto" type="hidden" id="goto" value="<?=$backurl?>"> </td>
						<td align="center">职位类别</td>
						<td height="25" align="center">招聘企业</td>
						<td align="center">招聘人数</td>
						<td align="center">状态</td>
						<td align="center">发布;截至时间</td>
						<td align="center">操作</td>
						<td align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
					  </tr>
					  <?
						while ($row=$db->row($query))
						{
							$htmlfile='../'.$htmlroot.$dirhtml_job.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
							$htmllink=file_exists($htmlfile)?$htmlfile:'../view.php?action=showjob&info='.$row[id];
						?>
					  	<tr bgcolor="#F1F2F4">
					  		<td height="25" align="center"><? if ($html_job=='1')	{echo html_exists($htmlfile);}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
							<td height="25" align="center"><?='<a href=\''.$htmllink.'\' target=\'_blank\'>'.$row['job'].'</a>'?></td>
							<td height="25" align="center"><?=show_jobtype($row[tid])?></td>
							<td height="25" align="center"><?='<a href=\'../view.php?action=company&info='.urlencode($row['username']).'\' target=\'_blank\'>'.$row['qyname'].'</a>'?></td>
							<td align="center"><? $man=$row['man']; if ($man=='0' || $man=='')	{echo '-';} else {echo $man;}?></td>
							<td align="center"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
							<td align="center"><? echo date("m-d",$row['puttime']).' ; ';if ($row['losetime']<time()) {echo '<font color=\'#ff0000\'>'.date("Y-m-d",$row['losetime']).'</font>';} else {echo date("Y-m-d",$row['losetime']);}?></td>
							<td align="center"><a href="job.php?action=job_edit&info=<?=$row['id']?>">编辑</a></td>
							<td align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
					  </tr>
					  <? }
					  ?>
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="4" rowspan="2" align="center"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center"><? require 'page_show.php';?></td>
                          </tr>
                        </table></td>
						<td height="25" colspan="3" rowspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="5"></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                                <?=$HTML_TPL->get_header()?></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                                <?=$HTML_TPL->get_center($default_job)?></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
                                <?=$HTML_TPL->get_footer()?></td>
                          </tr>
                          <tr>
                            <td height="5"></td>
                          </tr>
                                                </table></td>
						<td colspan="2" align="center"><input name="show_job" type="submit" class="input" id="show_job" value="显示">
&nbsp;&nbsp;
<input name="hidden_job" type="submit" class="input" id="hidden_job" value="隐藏">
&nbsp;&nbsp;
<input name="delete_job" type="submit" class="input" id="delete_job" value="删除"></td>
						</tr>
					  <tr bgcolor="#F1F2F4">
					    <td colspan="2" align="center"><input name="tohtml_job" type="submit" class="input" id="tohtml_job" value="批量生成 html"></td>
					    </tr>
					  </form>
					</table>
					<?
				}
				else if ($action=='job_search')
				{?>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
					  <form action="job.php" method="post">
					  <tr bgcolor="#E7E7F1">
						<td height="25" colspan="2" align="center"><strong>查 询 职 位</strong></td>
						</tr>
					  <tr bgcolor="#F1F2F4">
						<td height="25" align="center">发布时间</td>
						<td height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
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
						<td width="20%" height="25" align="center">职 位 名</td>
						<td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
						<input name="job" type="text" class="input" id="job" size="60"></td>
						</tr>
					  <tr bgcolor="#F1F2F4">
						<td width="20%" height="25" align="center">单 位 名</td>
						<td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
						<input name="qyname" type="text" class="input" id="qyname" size="40"></td>
						</tr>
					  <tr bgcolor="#F1F2F4">
						<td width="20%" height="25" align="center">招聘人数</td>
						<td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
						<input name="man" type="text" class="input" id="man" size="6"></td>
						</tr>

					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center"><input name="search_job" type="submit" class="input" id="search_job" value=" 查 询 招 聘 "></td>
						</tr>
					  </form>
					</table>
				<?
			}
			elseif ($action=='job_add')
			{
				exit('add');
			}
			else if ($action=='job_edit')
			{
				$info=$HTTP_GET_VARS['info'];
				$table=$jt.','.$cj;
				$sstr="$jt.*,$cj.qyuser,$cj.qyname,$cj.qyaddress,$cj.qypro,$cj.qykind,$cj.contact_name,$cj.qyphone,$cj.qyemail,$cj.qyyoubian,$cj.qyweb";
				$str="$jt.username=$cj.qyuser and $jt.id='$info'";
				$sql="select $sstr from $table where $str";
				$query=$db->query($sql);
				$row=$db->row($query);
				require '../lang/lang_'.$charset.'.php';
				$select_job_kind="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_kind=0;$num_job_kind<count($lang_job_kind);$num_job_kind++)
				{
					if ($lang_job_kind[$num_job_kind]==$row['job_pro'])
					{$select_job_kind.="<option value='".$lang_job_kind[$num_job_kind]."' selected>".$lang_job_kind[$num_job_kind]."</option>";}
					else {$select_job_kind.="<option value='".$lang_job_kind[$num_job_kind]."'>".$lang_job_kind[$num_job_kind]."</option>";}
				}

				$select_job_price="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_price=0;$num_job_price<count($lang_job_price);$num_job_price++)
				{
					if ($lang_job_price[$num_job_price]==$row['money'])
					{$select_job_price.="<option value='".$lang_job_price[$num_job_price]."' selected>".$lang_job_price[$num_job_price]."</option>";}
					else {$select_job_price.="<option value='".$lang_job_price[$num_job_price]."'>".$lang_job_price[$num_job_price]."</option>";}
				}

				$select_job_sex="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_sex=0;$num_job_sex<count($lang_ssex);$num_job_sex++)
				{
					if ($lang_ssex[$num_job_sex]==$row['sex'])
					{$select_job_sex.="<option value='".$lang_ssex[$num_job_sex]."' selected>".$lang_ssex[$num_job_sex]."</option>";}
					else {$select_job_sex.="<option value='".$lang_ssex[$num_job_sex]."'>".$lang_ssex[$num_job_sex]."</option>";}
				}

				$select_job_age="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_age=0;$num_job_age<count($lang_job_age);$num_job_age++)
				{
					if ($lang_job_age[$num_job_age]==$row['age'])
					{$select_job_age.="<option value='".$lang_job_age[$num_job_age]."' selected>".$lang_job_age[$num_job_age]."</option>";}
					else {$select_job_age.="<option value='".$lang_job_age[$num_job_age]."'>".$lang_job_age[$num_job_age]."</option>";}
				}

				$select_job_social="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_social=0;$num_job_social<count($lang_social);$num_job_social++)
				{
					if ($lang_social[$num_job_social]==$row['social'])
					{$select_job_social.="<option value='".$lang_social[$num_job_social]."' selected>".$lang_social[$num_job_social]."</option>";}
					else {$select_job_social.="<option value='".$lang_social[$num_job_social]."'>".$lang_social[$num_job_social]."</option>";}
				}

				$select_job_edu="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_edu=0;$num_job_edu<count($lang_edu);$num_job_edu++)
				{
					if ($lang_edu[$num_job_edu]==$row['edu'])
					{$select_job_edu.="<option value='".$lang_edu[$num_job_edu]."' selected>".$lang_edu[$num_job_edu]."</option>";}
					else {$select_job_edu.="<option value='".$lang_edu[$num_job_edu]."'>".$lang_edu[$num_job_edu]."</option>";}
				}

				$select_job_eng="<option value='".$lang_unset."'>".$lang_unset."</option>";
				for ($num_job_eng=0;$num_job_eng<count($lang_job_engable);$num_job_eng++)
				{
					if ($lang_job_engable[$num_job_eng]==$row['eng'])
					{$select_job_eng.="<option value='".$lang_job_engable[$num_job_eng]."' selected>".$lang_job_engable[$num_job_eng]."</option>";}
					else {$select_job_eng.="<option value='".$lang_job_engable[$num_job_eng]."'>".$lang_job_engable[$num_job_eng]."</option>";}
				}
				$ltime=explode('-',date("Y-n-j",$row['losetime']));
				$lyear=$ltime[0];
				$lmonth=$ltime[1];
				$lday=$ltime[2];
				?>
					<script src="../css/zhuanye.js"></script>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="td_four">
					<form action="job.php" method="post" name="waneinfo" onsubmit="return checkform(this)">
					  <tr>
						<td height="25" colspan="4" align="center" bgcolor="#E7E7F1">编 辑 招 聘</td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">职位名称</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <input name="job" type="text" class="input" id="job" value="<?=$row['job']?>" size="50" maxlength="50">                  </td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td height="30" align="center">职位类别</td>
						<td colspan="3">&nbsp;&nbsp;
						<select name="tid" id="tid">
							<?=select_jobtype($row[tid])?>
					    </select></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">工作地点</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <input name="address" type="text" class="input" id="address" value="<?=$row['address']?>" size="50" maxlength="100">                  </td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">工作性质</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="job_pro" class="input" id="job_pro"><?=$select_job_kind?></select></td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">招聘人数</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <input name="man" type="text" class="input" id="man" value="<?=$row['man']?>" size="5" maxlength="5">
					    &nbsp;(人)</td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">工作年限</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <input name="job_time" type="text" class="input" id="job_time" value="<?=$row['job_time']?>" size="5" maxlength="5">
					    &nbsp;(年)</td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">工资水平</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="money" class="input" id="money"><?=$select_job_price?></select></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">性别要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="sex" class="input" id="sex"><?=$select_job_sex?></select></td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">年龄要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="age" class="input" id="age"><?=$select_job_age?></select></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">身高要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <input name="height" type="text" class="input" id="height" value="<?=$row['height']?>" size="5" maxlength="5">
					    &nbsp;(cm)</td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">体重要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <input name="weight" type="text" class="input" id="weight" value="<?=$row['weight']?>" size="5" maxlength="5">
		&nbsp;(kg)</td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">视力要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <input name="sight" type="text" class="input" id="sight" value="<?=$row['sight']?>" size="5" maxlength="5"></td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">政治面貌</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="social" class="input" id="select3"><?=$select_job_social?></select></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">专业要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="smajortype" class="input" onChange="m_change(this,this.form.smajorname)">
						</select></td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">学历要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">                  &nbsp;&nbsp;
						  <select name="edu" class="input" id="select4"><?=$select_job_edu?></select></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">专业名称</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="smajorname" class="input">
						</select>
						  <script language=javascript>m_inits(document.waneinfo.smajortype,document.waneinfo.smajorname,"<?=$row['depart']?>","<?=$row['department']?>")</script></td>
						<td width="25%" height="25" align="center" bgcolor="#F1F2F4">外语要求</td>
						<td width="25%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <select name="eng" class="input" id="select5"><?=$select_job_eng?></select></td>
					  </tr>
					  <tr>
					    <td height="25" align="center" bgcolor="#F1F2F4">发布时间</td>
					    <td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
                          <?=date("Y-n-j H:i",$row['puttime'])?>
                        <input name="goto" type="hidden" id="goto" value="<?=$backurl?>">
                        <input name="infoid" type="hidden" id="infoid" value="<?=$info?>"></td>
				      </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">截至日期</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;						  <input name="year" type="text" id="year" value="<?=$lyear?>" size="4" maxlength="4">
						  年
					      <input name="month" type="text" id="month" value="<?=$lmonth?>" size="2" maxlength="2">
					      月
					      <input name="day" type="text" id="day" value="<?=$lday?>" size="2" maxlength="2">
					      日</td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">工作说明</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
						  <textarea name="worktext" cols="80" rows="8" wrap="VIRTUAL" class="input" id="worktext"><?=$row['worktext']?>
						  </textarea></td>
					  </tr>
					  <tr>
					    <td height="25" align="center" bgcolor="#F1F2F4">招聘状态</td>
					    <td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
				        <input name="sign" type="radio" value="1" <? if ($row['sign']=='1')	echo 'checked';?>>
				        <font color="#6699cc">显示</font>
				        <input name="sign" type="radio" value="0" <? if ($row['sign']=='0')	echo 'checked';?>>
				        <font color="#ff0000">隐藏</font></td>
				      </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">招聘单位</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4"> &nbsp;&nbsp;
						<?=$row['qyname']?></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">联&nbsp;系&nbsp;人</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <?=$row['contact_name']?></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">联系方式</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <?='电话:'.$row['qyname'].' ; 邮箱:'.$row['qyemail'].' ; 网址:'.$row['qyweb'];?></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">企业类型</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <?=$row['qypro']?></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">企业地址</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <?=$row['qyaddress']?></td>
					  </tr>
					  <tr>
						<td width="20%" height="25" align="center" bgcolor="#F1F2F4">邮政编码</td>
						<td height="25" colspan="3" bgcolor="#F1F2F4">&nbsp;&nbsp;
					    <?=$row['qyyoubian']?></td>
					  </tr>
					  <tr>
						<td height="25" colspan="4" align="center" bgcolor="#F1F2F4"><input name="save_jobedit" type="submit" class="input" id="{PUTJOB_NAME}" value=" 编 辑 ">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="reset" type="reset" class="input" id="reset" value=" 重  设 "></td>
					  </tr>
					</form>
				  </table>
				<?
			}
			else if ($action=='find')
			{
				$table=$ft.','.$pj;
				$sstr="$ft.*,$pj.username,$pj.truename,$pj.sex";
				$info=$HTTP_GET_VARS['info'];
				if ($info=='yes')
				{
					$str="$ft.username=$pj.username and $ft.sign='1'";
					$str2="action=find&info=$info";
				}
				else if ($info=='no')
				{
					$str="$ft.username=$pj.username and $ft.sign='0'";
					$str2="action=find&info=$info";
				}
				else if ($info=='experite')
				{
					$str="$ft.username=$pj.username and $ft.losetime<='".time()."'";
					$str2="action=find&info=$info";
				}
				else if ($info=='search')
				{
					$puttime=$HTTP_GET_VARS['puttime'];
					$job=urldecode($HTTP_GET_VARS['job']);
					$truename=urldecode($HTTP_GET_VARS['truename']);
					$sex=urldecode($HTTP_GET_VARS['sex']);
					$str="$ft.username=$pj.username";
					if ($job=='')	{$str=$str;}	else	{$str=$str." and $ft.job like '%$job%'";}
					if ($sex=='0')	{$str=$str;}	else	{$str=$str." and $pj.sex='$sex'";}
					if ($puttime=='0')	{$str=$str;}	else	{$str=$str." and $ft.puttime>'".(time()-$puttime)."'";}
					if ($truename=='')	{$str=$str;}	else	{$str=$str." and $pj.truename like '%$truename%'";}
					$str2="action=find&info=search&puttime=".$puttime."&job=".urlencode($job)."&truename=".urlencode($truename)."&sex=".urlencode($sex);
				}
				else
				{
					$str="$ft.username=$pj.username";
					$str2="action=find&info=$info";
				}
				require 'page_count.php';
				$sql="SELECT $sstr from $table where $str order by puttime desc limit $offset,$psize";
				$query=$db->query($sql);
				?>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
				  <form action="job.php" method="post">
				  <tr bgcolor="#E7E7F1">
					<td height="25" align="center">html</td>
					<td align="center">职位名称
                      <input name="goto" type="hidden" id="goto" value="<?=$backurl?>"></td>
					<td align="center">职位类别</td>
					<td height="25" align="center">求职人</td>
					<td align="center">性别</td>
					<td align="center">状态</td>
					<td align="center">发布;截至时间</td>
					<td align="center">操作</td>
					<td align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
				  </tr>
				  <?
				  	while ($row=$db->row($query))
					{
						$htmlfile='../'.$htmlroot.$dirhtml_find.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
						$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'../view.php?action=showfind&info='.$row[id];
					?>
				  <tr bgcolor="#F1F2F4">
					<td height="25" align="center"><? if ($html_find=='1')	{echo html_exists($htmlfile);}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
					<td height="25" align="center"><?='<a href=\''.$htmllink.'\' target=\'_blank\'>'.$row['job'].'</a>'?></td>
					<td height="25" align="center"><?=show_jobtype($row[tid])?></td>
					<td height="25" align="center"><?='<a href=\'../view.php?action=personal&info='.urlencode($row['username']).'\' target=\'_blank\'>'.$row['truename'].'</a>'?></td>
					<td align="center"><?=$row['sex']?></td>
					<td align="center"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
					<td align="center"><? echo date("m-d",$row['puttime']).' ; ';if ($row['losetime']<time()) {echo '<font color=\'#ff0000\'>'.date("Y-m-d",$row['losetime']).'</font>';} else {echo date("Y-m-d",$row['losetime']);}?></td>
					<td align="center"><a href="job.php?action=find_edit&info=<?=$row['id']?>">编辑</a></td>
					<td align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
				  </tr>
				  <? }
				  ?>
				  <tr bgcolor="#F1F2F4">
					<td height="25" colspan="4" rowspan="2" align="center"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center"><? require 'page_show.php';?></td>
                      </tr>
                    </table></td>
					<td height="25" colspan="3" rowspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="5"></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_header()?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_center($default_find)?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_footer()?></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                      </tr>
                    </table></td>
					<td colspan="2" align="center"><input name="show_find" type="submit" class="input" id="show_find" value="显示">
&nbsp;&nbsp;
<input name="hidden_find" type="submit" class="input" id="hidden_find" value="隐藏">
&nbsp;&nbsp;
<input name="delete_find" type="submit" class="input" id="delete_find" value="删除"></td>
					</tr>
				  <tr bgcolor="#F1F2F4">
				    <td colspan="2" align="center"><input name="tohtml_find" type="submit" class="input" id="tohtml_find" value="批量生成 html"></td>
				    </tr>
				  </form>
				</table>
				<?
			}
			else if ($action=='find_search')
			{?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
				  <form action="job.php" method="post">
				  <tr bgcolor="#E7E7F1">
					<td height="25" colspan="2" align="center"><strong>查 询 求 职</strong></td>
					</tr>
				  <tr bgcolor="#F1F2F4">
				    <td width="20%" height="25" align="center">发布时间</td>
				    <td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
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
				    <td width="20%" height="25" align="center">职位名称</td>
				    <td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
			        <input name="job" type="text" class="input" id="job" size="60"></td>
				    </tr>
				  <tr bgcolor="#F1F2F4">
				    <td width="20%" height="25" align="center">求&nbsp;职&nbsp;人</td>
				    <td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
			        <input name="truename" type="text" class="input" id="truename" size="40"></td>
				    </tr>
				  <tr bgcolor="#F1F2F4">
				    <td width="20%" height="25" align="center">性&nbsp;&nbsp;&nbsp;&nbsp;别</td>
				    <td width="80%" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
			        <input name="sex" type="radio" value="0" checked>
			        不限
			        <input name="sex" type="radio" value="男">
			        男
			        <input name="sex" type="radio" value="女">
			        女</td>
				    </tr>

				  <tr bgcolor="#F1F2F4">
					<td height="25" colspan="2" align="center"><input name="search_find" type="submit" class="input" id="search_find" value=" 查 询 人 才  "></td>
					</tr>
				  </form>
			</table>
			<? }
			else if ($action=='find_add')
			{
				exit('add find');
			}
			else if ($action=='find_edit')
			{
				$info=$HTTP_GET_VARS['info'];
				$table=$ft.','.$pj;
				$sstr="$ft.*,$pj.username,$pj.truename,$pj.sex,$pj.edu,$pj.birth,$pj.zhuanye,$pj.zhuanyename";
				$str="$ft.username=$pj.username and $ft.id='$info'";
				$sql="select $sstr from $table where $str";
				$query=$db->query($sql);
				$row=$db->row($query);
				$ltime=explode('-',date("Y-n-j",$row['losetime']));
				$lyear=$ltime[0];
				$lmonth=$ltime[1];
				$lday=$ltime[2];
				?>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="td_four">
					<form action="job.php" method="post">
					  <tr bgcolor="#F1F2F4">
					    <td height="30" colspan="2" align="center" bgcolor="#E7E7F1"><strong>编 辑 求 职</strong></td>
				      </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">职位名称</td>
						<td>&nbsp;&nbsp;
					    <input name="job" type="text" class="input" id="job" value="<?=$row['job']?>" size="50" maxlength="50">                  </td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">职位类别</td>
						<td>&nbsp;&nbsp;
						<select name="tid" id="tid">
							<?=select_jobtype($row[tid])?>
					    </select></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">工作地点</td>
						<td>&nbsp;&nbsp;
					    <input name="work_address" type="text" class="input" id="work_address" value="<?=$row['work_address']?>" size="50" maxlength="100">                  </td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">工作说明</td>
						<td>&nbsp;&nbsp;
					    <textarea name="jobtext" cols="80" rows="10" wrap="VIRTUAL" class="input" id="jobtext"><?=$row['jobtext']?>
					    </textarea></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
					    <td height="30" align="center">求职状态</td>
					    <td>&nbsp;&nbsp;
                          <input name="sign" type="radio" value="1" <? if ($row['sign']=='1')	echo 'checked';?>>
                          <font color="#6699cc">显示</font>
                          <input name="sign" type="radio" value="0" <? if ($row['sign']=='0')	echo 'checked';?>>
                          <font color="#ff0000">隐藏</font></td>
				      </tr>
					  <tr bgcolor="#F1F2F4">
					    <td height="30" align="center">发布时间</td>
					    <td>&nbsp;&nbsp;
                          <?=date("Y-n-j H:i",$row['puttime'])?>
                          <input name="goto" type="hidden" id="goto" value="<?=$backurl?>">
                          <input name="infoid" type="hidden" id="infoid" value="<?=$info?>"></td>
				      </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">截至日期</td>
						<td>&nbsp;&nbsp;
                          <input name="year" type="text" id="year" value="<?=$lyear?>" size="4" maxlength="4">
年
<input name="month" type="text" id="month" value="<?=$lmonth?>" size="2" maxlength="2">
月
<input name="day" type="text" id="day" value="<?=$lday?>" size="2" maxlength="2">
日</td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">联 系 人</td>
						<td>&nbsp;&nbsp;						  <?=$row['truename']?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">性&nbsp;&nbsp;&nbsp;&nbsp;别</td>
						<td>&nbsp;&nbsp;
                          <?=$row['sex']?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">学&nbsp;&nbsp;&nbsp;&nbsp;历</td>
						<td>&nbsp;&nbsp;
                          <?=$row['edu']?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">出生年月</td>
						<td>&nbsp;&nbsp;
                          <?=$row['birth']?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">专业类别</td>
						<td>&nbsp;&nbsp;
                          <?=$row['zhuanye']?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="25%" height="30" align="center">专业名称</td>
						<td>&nbsp;&nbsp;
                          <?=$row['zhuanyename']?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td height="35" colspan="2" align="center"><input name="save_findedit" type="submit" class="input" id="save_findedit" value=" 编 辑 ">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="reset" type="reset" class="input" id="reset" value=" 重  设 "></td>
					  </tr>
					</form>
		    </table>
				<?
			}
		?>
		<!-- unit info end -->
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
<?=wwwwanenet()?>
</body>
</html>
