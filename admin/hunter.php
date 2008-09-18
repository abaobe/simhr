<?php
	require "admin_globals.php";
	require "admin_check.php";
	$action=$HTTP_GET_VARS['action'];
	$count='15';
	$jt=$tablepre.'hunter_com';
	$ft=$tablepre.'hunter_per';
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
	if ($tojob_html)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$sql=$db->query("select * from $jt where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$query_com=$db->query("select * from {$tablepre}jianliqy where qyuser='".$row['username']."'");
				$row_com=$db->row($query_com);
				$sql_data=array(
					'WEBTITLE'=>headtitle($row_com['qyname'].' 招聘猎头人才 '.$row['job']),
					'INFOTITLE'=>$row_com['qyname'].' 招聘猎头人才 '.$row['job'],
					'CLICK'=>$row['click'],
					'JOB'=>$row['job'],
					'JOB_ADDRESS'=>$row['job_address'],
					'JOB_TEXT'=>wane_text($row['job_text']),
					'COMPANY'=>$row_com['qyname'],
					'LINKCOM'	=>	urlencode($row_com[qyuser]),
					'QYADDRESS'=>$row_com['qyaddress'],
					'QYPRO'=>$row_com['qypro'],
					'QYKIND'=>$row_com['qykind'],
					'QYSPACE'=>$row_com['qyman'],
					'CONTACT'=>$row_com['contact_name'],
					'QYPHONE'=>$row_com['qyphone'],
					'QYMAIL'=>$row_com['qyemail'],
					'QYWEB'=>$row_com['qyweb'],
					'ADDTIME'=>date("Y-n-j",$row['addtime']),
					'LOSETIME'=>date("Y-n-j",$row['losetime']),
					'LINK'=>$row['id']
				);
				$c_html->c_comhunter($html_header,$html_center,$html_footer,$row['id'],$dirhtml_comhunter,$row['htmlroot'],$sql_data,1);
			}
			update_cache('hunterjob','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($goto,'1');
			exit;
		}
	}
	else if ($job_show)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$query=$db->query("UPDATE $jt SET sign='1' WHERE id in ($ids)");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('hunterjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($job_hidden)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$query=$db->query("UPDATE $jt SET sign='0' WHERE id in ($ids)");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('hunterjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($job_delete)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$sql=$db->query("select * from $jt where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$hunterfile='../'.$htmlroot.$dirhtml_comhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
				if (file_exists($hunterfile))	{delete_file($hunterfile);}
			}
			$query=$db->query("DELETE FROM $jt WHERE id in ($ids)");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('hunterjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($submit_job_edit)
	{
		if ($job=='')	{echo clickback('职位名称不能为空');exit;}
		else
		{
			$losetime=mktime(23,59,59,$month,$day,$year);
			$query=$db->query("update $jt set job='$job',job_text='$job_text',job_address='$job_address',losetime='$losetime' where id='$jobid'");
			if (!$query) {echo clickback('编辑失败');exit;}
			else
			{
				update_cache('hunterjob','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg('hunter.php?action=joblist','1');
				exit;
			}
		}
	}
	else if ($submit_search_job)
	{
		$search_url="hunter.php?action=joblist&status=search&addtime=$addtime&job=".urlencode($job)."&work_address=".urlencode($work_address)."&qyname=".urlencode($qyname);
		echo refreshback('操作成功');
		echo endhtml();
		echo wwwwanenet();
		echo showmsg($search_url,'1');
		exit;
	}
	elseif ($tofind_html)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$sql=$db->query("select * from $ft where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$sql_data=array(
					'TRUENAME'=>$row['truename'],
					'INDUSTRY'=>$row['industry'],
					'YEARSALARY'=>$row['year_pay'],
					'FOR_YEARSALARY'=>$row['year_pay_for'],
					'POSITION'=>$row['position'],
					'FOR_POSITION'=>$row['for_position'],
					'ADDTIME'=>date("Y-n-j",$row['addtime']),
					'LOSETIME'=>date("Y-n-j",$row['losetime']),
					'MOBILE'=>$row['mobile'],
					'HOMEPHONE'=>$row['phone'],
					'ADDRESS'=>$row['address'],
					'ZIPCODE'=>$row['code'],
					'EMAIL'=>$row['email'],
					'LINKTIME'=>$row['linktime'],
					'SEX'=>$row['sex'],
					'BIRTH'=>$row['birth'],
					'SID'=>$row['sidcard'],
					'MARRY'=>$row['marry'],
					'HUKOU'=>$row['hukou'],
					'LIVING'=>$row['living'],
					'WORK_ADDR'=>$row['forliving'],
					'EDU'=>$row['edu'],
					'GRAEDU'=>$row['graedu'],
					'DEPART'=>$row['depart'],
					'TRAIN'=>wane_text($row['train']),
					'WORKEXP'=>wane_text($row['workexp']),
					'TECHANG'=>wane_text($row['enable']),
					'CONTEXT'=>wane_text($row['context']),
					'CLICK'=>$row['click'],
					'LINK'=>$row['id'],
					'INFOTITLE'=>'猎头人才 '.$row['truename'],
					'WEBTITLE'=>headtitle('猎头人才 '.$row['truename'])
				);
				$c_html->c_perhunter($html_header,$html_center,$html_footer,$row['id'],$dirhtml_perhunter,$row['htmlroot'],$sql_data,1);
			}
				update_cache('hunterfind','1');
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg($goto,'1');
			exit;
		}
	}
	else if ($find_show)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$query=$db->query("UPDATE $ft SET sign='1' WHERE id in ($ids)");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('hunterfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($find_hidden)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$query=$db->query("UPDATE $ft SET sign='0' WHERE id in ($ids)");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('hunterfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($find_delete)
	{
		if ($delete=='')	{echo clickback('请选择操作对象');exit;}
		else
		{
			$comma=$ids="";
			foreach($delete as $id)
			{
				$ids.="$comma'$id'";
				$comma=",";
			}
			$sql=$db->query("select * from $ft where id in ($ids)");
			while ($row=$db->row($sql))
			{
				$hunterfile='../'.$htmlroot.$dirhtml_perhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
				if (file_exists($hunterfile))	{delete_file($hunterfile);}
			}
			$query=$db->query("delete from $ft where id in ($ids)");
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				update_cache('hunterfind','1');
				echo refreshback('操作成功');
				echo endhtml();
				echo wwwwanenet();
				echo showmsg($goto,'1');
				exit;
			}
		}
	}
	else if ($submit_find_edit)
	{
		$depart=$smajortype.'-'.$smajorname;
		$losetime=mktime(23,59,59,$lmonth,$lday,$lyear);
		$birth=$year.'-'.$month.'-'.$day;
		$living=$living_1.'-'.$living_2;
		$forliving=$forliving_1.'-'.$forliving_2;
		$sql="update ".$ft."
				set
				   truename='$truename',
				   year_pay='$year_pay',
				   industry='$industry',
				   year_pay_for='$year_pay_for',
				   position='$position',
				   for_position='$for_position',
				   mobile='$mobile',
				   address='$address',
				   phone='$phone',
				   code='$code',
				   email='$email',
				   linktime='$linktime',
				   sex='$sex',
				   birth='$birth',
				   sidcard='$sidcard',
				   marry='$marry',
				   hukou='$hukou',
				   living='$living',
				   forliving='$forliving',
				   edu='$edu',
				   graedu='$graedu',
				   depart='$depart',
				   train='$train',
				   workexp='$workexp',
				   enable='$enable',
				   context='$context',
				   losetime='$losetime',
				   sign='$sign'
				where id='$hunterid'";
		$query=$db->query($sql);
		if (!$query)	{echo clickback('操作失败');exit;}
		else
		{
			update_cache('hunterfind','1');
				echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('hunter.php?action=find_list','1');
			exit;
		}
	}
	else if ($submit_search_find)
	{
		$search_url="hunter.php?action=findlist&status=search&addtime=$addtime&truename=".urlencode($truename)."&sex=".urlencode($sex)."&edu=".urlencode($edu)."&zy=".urlencode($smajortype)."&zyn=".urlencode($smajorname)."&graedu=".urlencode($graedu)."&industry=".urlencode($industry)."&position=".urlencode($position)."&workaddr=".urlencode($forliving)."&ages=".urlencode($age_s)."&agee=".urlencode($age_e);
		echo refreshback('操作成功');
		echo endhtml();
		echo wwwwanenet();
		echo showmsg($search_url,'1');
		exit;
	}
?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=joblist">猎头职位</a>&nbsp;|&nbsp;<a href="?action=joblist&status=off">未验证职位</a>&nbsp;|&nbsp;<a href="?action=joblist&status=on">已验证职位</a>&nbsp;|&nbsp;<a href="?action=joblist&status=close">过期职位</a>&nbsp;|&nbsp;<a href="?action=search_job">查询职位</a>&nbsp;&lt;=&gt;&nbsp;&nbsp;<a href="?action=findlist">猎头人才</a>&nbsp;|&nbsp;<a href="?action=findlist&status=off">未验证人才</a>&nbsp;|&nbsp;<a href="?action=findlist&status=on">已验证人才</a>&nbsp;|&nbsp;<a href="?action=findlist&status=close">过期人才</a>&nbsp;|&nbsp;<a href="?action=search_find">人才查询</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<!--job start-->
		<?
			if ($action=='joblist')
			{?>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			<form action="hunter.php" method="post">
			  <tr align="center" bgcolor="#E7E7F1">
				<td height="25">html</td>
				<td height="25">职位名称</td>
				<td height="25">状态</td>
				<td height="25">发布;截至时间
				  <input name="goto" type="hidden" id="goto" value="<?=$backurl?>"></td>
				<td height="25">操作</td>
				<td height="25"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			<?
				$table=$jt;
				if ($status=='off')
				{
					$str="sign='0'";
					$str2="action=joblist&status=off";
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else if ($status=='on')
				{
					$str="sign='1'";
					$str2="action=joblist&status=on";
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else if ($status=='close')
				{
					$str="losetime<='".time()."'";
					$str2="action=joblist&status=close";
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else if ($status=='search')
				{
					$job=urldecode($job);
					$work_address=urldecode($work_address);
					$qyname=urldecode($qyname);

					$str="id!='0'";
					$forlong=($addtime=='0')?0:(time()-$addtime);
					if ($job!='')	{$str.=" and job like '%".$job."%'";}	else	{$str=$str;}
					if ($work_address!='')	{$str.=" and work_address like '%".$work_address."%'";}	else	{$str=$str;}
					if ($forlong!='0')	{$str.=" and addtime >= '".$forlong."'";}	else	{$str=$str;}
					$str2="action=findlist&status=search&addtime=".$addtime."&job=".urlencode($job)."&work_address=".urlencode($work_address)."&qyname=".urlencode($qyname);
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else
				{
					$str="0";
					$str2="action=joblist";
					require 'page_count.php';
					$sql=$db->query("select * from $table order by id desc limit $offset,$psize");
				}
				while ($row=$db->row($sql))
				{
					$htmlfile='../'.$htmlroot.$dirhtml_comhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
					$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'../view.php?action=hunterjob&info='.$row[id];
				?>
				  <tr align="center" bgcolor="#F1F2F4">
					<td height="25"><? if ($html_comhunter=='1')	{echo html_exists($htmlfile);}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
					<td height="25"><a href="<?=$htmllink?>" target="_blank"><?=$row['job']?></a></td>
					<td height="25"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
					<td height="25"><? echo date("m-d",$row['addtime']).' ; ';if ($row['losetime']<time()) {echo '<font color=\'#ff0000\'>'.date("Y-m-d",$row['losetime']).'</font>';} else {echo date("Y-m-d",$row['losetime']);}?></td>
					<td height="25"><a href="hunter.php?action=job_edit&info=<?=$row['id']?>">编辑</a></td>
					<td height="25"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
				  </tr>
				<?
					unset($htmlfile,$htmllink);
				}
				?>
				  <tr align="center" bgcolor="#F1F2F4">
					<td height="25" colspan="2"><? require 'page_show.php';?></td>
					<td height="25" colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="5"></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_header()?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_center($default_comhunter)?></td>
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
                        <td height="30" align="center"><input name="job_show" type="submit" class="input" id="job_show" value="显示">
                        &nbsp;&nbsp;<input name="job_hidden" type="submit" class="input" id="job_hidden" value="隐藏">
                        &nbsp;&nbsp;<input name="job_delete" type="submit" class="input" id="job_delete" value="删除"></td>
                      </tr>
                      <tr>
                        <td height="30" align="center"><input name="tojob_html" type="submit" class="input" id="tojob_html" value="批量生成 html 文件"></td>
                      </tr>
                    </table></td>
				  </tr>
			  </form>
			</table>
				<?
			}
			else if ($action=='job_edit')
			{
				$qy=$tablepre.'jianliqy';
				$sql=$db->query("select $qy.qyuser,$qy.qyname,$jt.* from $qy,$jt where $jt.id='$info' and $qy.qyuser=$jt.username");
				$row=$db->row($sql);
				list($ye,$mo,$da)=explode('-',date("Y-n-j",$row['losetime']));
			?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="hunter.php" method="post">
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">职位名称</td>
				<td>&nbsp;&nbsp;
				  <input name="job" type="text" class="input" id="job" value="<?=$row['job']?>"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">招聘企业</td>
				<td>&nbsp;&nbsp;
				<?=$row['qyname']?>
				<input name="jobid" type="hidden" id="jobid" value="<?=$row['id']?>">
				<input name="addtime" type="hidden" id="addtime" value="<?=$row['addtime']?>">
				<input name="comhunter_folder" type="hidden" id="comhunter_folder" value="<?=$row['htmlroot']?>">
				<input name="postqy_user" type="hidden" id="postqy_user" value="<?=$row['username']?>"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">工作地点</td>
				<td>&nbsp;&nbsp;
				  <input name="job_address" type="text" class="input" id="job_address" value="<?=$row['job_address']?>"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">工作说明</td>
				<td>&nbsp;&nbsp;
				  <textarea name="job_text" cols="60" rows="10" wrap="VIRTUAL" class="input" id="job_text"><?=$row['job_text']?>
				  </textarea></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">发布时间</td>
				<td>&nbsp;&nbsp;
				<?=date("Y-n-j",$row['addtime'])?></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">截至时间</td>
				<td>&nbsp;&nbsp;
				  <input name="year" type="text" class="input" id="year" value="<?=$ye?>" size="4" maxlength="4">
				  年
				  <input name="month" type="text" class="input" id="month" value="<?=$mo?>" size="2" maxlength="2">
				  月
				  <input name="day" type="text" class="input" id="day" value="<?=$da?>" size="2" maxlength="2">
				  日</td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="30" colspan="2" align="center"><input name="submit_job_edit" type="submit" class="input" id="submit_job_edit" value=" 编 辑 ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value=" 取 消 编 辑 " onclick="javascript:history.go(-1)" class="input"></td>
				</tr>
			</form>
			</table>
			<? }
			else if ($action=='search_job')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="hunter.php" method="post">
			  <tr bgcolor="#E7E7F1">
				<td height="25" colspan="2" align="center">猎 头 职 位 查 询</td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">发布时间</td>
			    <td height="25">&nbsp;
			      <select name="addtime" id="addtime">
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
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">职位名称</td>
				<td height="25">&nbsp;
				  <input name="job" type="text" class="input" id="job" size="40"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">工作地址</td>
				<td height="25">&nbsp;
				  <input name="work_address" type="text" class="input" id="work_address" size="60"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">招聘企业</td>
				<td height="25">&nbsp;
				  <input name="qyname" type="text" class="input" id="qyname" size="40"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="35" colspan="2" align="center"><input name="submit_search_job" type="submit" id="submit_search_job" value="Submit"></td>
			  </tr>
			</form>
			</table>
			<? }
			else if ($action=='findlist')
			{
				?>
				  <table width="100%"  border="0" cellspacing="1" cellpadding="0">
				  <form action="hunter.php" method="post">
				  <tr align="center" bgcolor="#E7E7F1">
					<td height="25">html</td>
					<td height="25">姓名</td>
					<td height="25">性别</td>
					<td height="25">行业</td>
					<td height="25">状态</td>
					<td height="25">发布;截至时间
				      <input name="goto" type="hidden" id="goto" value="<?=$backurl?>"></td>
					<td height="25">操作</td>
					<td height="25"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
				  </tr>
				<?
				$table=$ft;
				if ($status=='off')
				{
					$str="sign='0'";
					$str2="action=findlist&status=off";
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else if ($status=='on')
				{
					$str="sign='1'";
					$str2="action=findlist&status=on";
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else if ($status=='close')
				{
					$str="losetime<='".time()."'";
					$str2="action=findlist&status=close";
					require 'page_count.php';
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else if ($status=='search')
				{
					$truename=urldecode($truename);
					$sex=urldecode($sex);
					$edu=urldecode($edu);
					$zy=urldecode($zy);
					$zyn=urldecode($zyn);
					$graedu=urldecode($graedu);
					$industry=urldecode($industry);
					$position=urldecode($position);
					$workaddr=urldecode($workaddr);
					$ages=urldecode($ages);
					$agee=urldecode($agee);

					$forlong=($addtime=='0')?0:(time()-$addtime);
					$str="id>'0'";
					if ($truename!='')	{$str.=" and truename like '%".$truename."%'";}	else	{$str=$str;}
					if ($sex!='0')	{$str.=" and sex='$sex'";}	else	{$str=$str;}
					if ($edu!='0')	{$str.=" and edu='$edu'";}	else	{$str=$str;}
					if ($zy!='不限')	{$str.=" and depart like '%".$zy."%'";}	else	{$str=$str;}
					//if ($zyn!='不限')	{$str.=" and depart like '%".$zyn."%'";}	else	{$str=$str;}
					if ($graedu!='')	{$str.=" and graedu like '%".$graedu."%'";}	else	{$str=$str;}
					if ($industry!='0')	{$str.=" and industry like '%".$industry."%'";}	else	{$str=$str;}
					if ($workaddr!='')	{$str.=" and forliving like '%".$workaddr."%'";}	else	{$str=$str;}
					if ($forlong!='0')	{$str.=" and addtime >= '$forlong'";}	else	{$str=$str;}
					$str2="action=findlist&status=search&addtime=$addtime&truename=".urlencode($truename)."&sex=".urlencode($sex)."&edu=".urlencode($edu)."&zy=".urlencode($zy)."&zyn=".urlencode($zyn)."&graedu=".urlencode($graedu)."&industry=".urlencode($industry)."&position=".urlencode($position)."&workaddr=".urlencode($workaddr)."&ages=".urlencode($ages)."&agee=".urlencode($agee);
					require "page_count.php";
					$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
				}
				else
				{
					$str="0";
					$str2="action=findlist";
					require 'page_count.php';
					$sql=$db->query("select * from $table order by id desc limit $offset,$psize");
				}
				while ($row=$db->row($sql))
				{
					$htmlfile='../'.$htmlroot.$dirhtml_perhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
					$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'../view.php?action=hunterfind&info='.$row[id];
				?>
				  <tr align="center" bgcolor="#F1F2F4">
					<td height="20"><? if ($html_perhunter=='1')	{echo html_exists($htmlfile);}	else	{echo '<font color=\'#ff0000\'>关闭</font>';}?></td>
					<td height="20"><a href="<?=$htmllink?>" target="_blank"><?=$row['truename']?></a></td>
					<td height="20"><?=$row['sex']?></td>
					<td height="20"><?=$row['industry']?></td>
					<td height="20"><? $sign=$row['sign']; if ($sign!='1') {echo '<font color=\'#ff0000\'>隐藏</font>';} else {echo '<font color=\'#6699cc\'>显示</font>';}?></td>
					<td height="20"><? echo date("m-d",$row['addtime']).' ; ';if ($row['losetime']<time()) {echo '<font color=\'#ff0000\'>'.date("Y-m-d",$row['losetime']).'</font>';} else {echo date("Y-m-d",$row['losetime']);}?></td>
					<td height="20"><a href="?action=find_edit&info=<?=$row['id']?>">编辑</a></td>
					<td height="20"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row['id']?>"></td>
				  </tr>
				<? }
				?>
				  <tr bgcolor="#F1F2F4">
					<td height="20" colspan="4" align="center" bgcolor="#F1F2F4"><? require 'page_show.php';?></td>
					<td height="20" colspan="2" bgcolor="#F1F2F4"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="5"></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板头体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_header()?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板主体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_center($default_perhunter)?></td>
                      </tr>
                      <tr>
                        <td height="25">&nbsp;&nbsp;模板脚体&nbsp;:&nbsp;
                            <?=$HTML_TPL->get_footer()?></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                      </tr>
                    </table></td>
					<td height="20" colspan="2" bgcolor="#F1F2F4"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30" align="center"><input name="find_show" type="submit" class="input" id="find_show" value="显示">
                        &nbsp;&nbsp;<input name="find_hidden" type="submit" class="input" id="find_hidden" value="隐藏">
                        &nbsp;&nbsp;<input name="find_delete" type="submit" class="input" id="find_delete" value="删除"></td>
                      </tr>
                      <tr>
                        <td height="30" align="center"><input name="tofind_html" type="submit" class="input" id="tofind_html" value="批量生成 html 文件"></td>
                      </tr>
                    </table></td>
				  </tr>
				  </form>
				  </table>
				<?
			}
			else if ($action=='search_find')
			{
				for ($num_sex=0;$num_sex<count($lang_ssex);$num_sex++)
				{
					$select_sex.="<option value=\"".$lang_ssex[$num_sex]."\">".$lang_ssex[$num_sex]."</option>";
				}
				for($num_edu=0;$num_edu<count($lang_edu);$num_edu++)
				{
					$select_edu.="<option value=\"".$lang_edu[$num_edu]."\">".$lang_edu[$num_edu]."</option>";
				}
				for ($num_industry=0;$num_industry<count($lang_company_belong);$num_industry++)
				{
					$select_industry.="<option value=\"".$lang_company_belong[$num_industry]."\">".$lang_company_belong[$num_industry]."</option>";
				}
			?>
			<script src="../css/zhuanye.js"></script>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="hunter.php" method="post" name="waneinfo" onsubmit="return checkform(this)">
			  <tr bgcolor="#E7E7F1">
				<td height="25" colspan="2" align="center">猎 头 人 才 查 询</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">发布时间</td>
			    <td height="25">&nbsp;
			      <select name="addtime" id="addtime">
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
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">真实姓名</td>
				<td height="25">&nbsp;
				  <input name="truename" type="text" class="input" id="truename"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">性&nbsp;&nbsp;&nbsp;&nbsp;别</td>
				<td height="25">&nbsp;
				  <select name="sex" class="input" id="sex">
				    <option value="0">不限</option><?=$select_sex?>
			      </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">最高学历</td>
				<td height="25">&nbsp;
                  <select name="edu" class="input" id="edu">
                    <option value="0">不限</option><?=$select_edu?>
                  </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">专&nbsp;&nbsp;&nbsp;&nbsp;业</td>
				<td height="25">&nbsp;
                  <select name="smajortype" class="input" onchange="m_change(this,this.form.smajorname)"></select>
                  <select name="smajorname" class="input"></select><script language=javascript>m_inits(document.waneinfo.smajortype,document.waneinfo.smajorname,"不限","不限")</script></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">毕业学校</td>
				<td height="25">&nbsp;
				  <input name="graedu" type="text" class="input" id="graedu" size="60"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">所在行业</td>
				<td height="25">&nbsp;
                  <select name="industry" class="input" id="industry">
                    <option value="0">不限</option><?=$select_industry?>
                  </select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">目前职位</td>
				<td height="25">&nbsp;
				  <input name="position" type="text" class="input" id="position"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">工作所在地</td>
				<td height="25">&nbsp;
				  <input name="forliving" type="text" class="input" id="forliving"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">年龄范围</td>
				<td height="25">&nbsp;
				  <input name="age_s" type="text" class="input" id="age_s" size="2">
				  ~
				  <input name="age_e" type="text" class="input" id="age_e" size="2">
				  岁</td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" colspan="2" align="center"><input name="submit_search_find" type="submit" class="input" id="submit_search_find" value=" 查 询 人 才 "></td>
			  </tr>
			</form>
			</table>
			<? }
			else if ($action=='find_edit')
			{
				$sql="select * from $ft where id='$info'";
				$query=$db->query($sql);
				$row=$db->row($query);

				for ($num_industry=0;$num_industry<count($lang_company_belong);$num_industry++)
				{
					if ($row['industry']==$lang_company_belong[$num_industry])
					{
						$select_industry.="<option value=\"".$lang_company_belong[$num_industry]."\" selected>".$lang_company_belong[$num_industry]."</option>";
					}
					else
					{
						$select_industry.="<option value=\"".$lang_company_belong[$num_industry]."\">".$lang_company_belong[$num_industry]."</option>";
					}
				}

				for ($num_pay=0;$num_pay<count($lang_yearsalary);$num_pay++)
				{
					if ($row['year_pay']==$lang_yearsalary[$num_pay])
					{
						$select_year_pay.="<option value=\"".$lang_yearsalary[$num_pay]."\" selected>".$lang_yearsalary[$num_pay]."</option>";
					}
					else
					{
						$select_year_pay.="<option value=\"".$lang_yearsalary[$num_pay]."\">".$lang_yearsalary[$num_pay]."</option>";
					}
				}

				for ($num_pay_for=0;$num_pay_for<count($lang_yearsalary);$num_pay_for++)
				{
					if ($row['year_pay_for']==$lang_yearsalary[$num_pay_for])
					{
						$select_year_pay_for.="<option value=\"".$lang_yearsalary[$num_pay_for]."\" selected>".$lang_yearsalary[$num_pay_for]."</option>";
					}
					else
					{
						$select_year_pay_for.="<option value=\"".$lang_yearsalary[$num_pay_for]."\">".$lang_yearsalary[$num_pay_for]."</option>";
					}
				}

				list($toyear,$tomonth,$today)=explode('-',date("Y-n-j",$row['losetime']));

				for ($num_sex=0;$num_sex<count($lang_ssex);$num_sex++)
				{
					if ($row['sex']==$lang_ssex[$num_sex])
					{
						$select_sex.="<option value=\"".$lang_ssex[$num_sex]."\" selected>".$lang_ssex[$num_sex]."</option>";
					}
					else
					{
						$select_sex.="<option value=\"".$lang_ssex[$num_sex]."\">".$lang_ssex[$num_sex]."</option>";
					}
				}

				list($byear,$bmonth,$bday)=explode('-',$row['birth']);
				for ($num_y=1940;$num_y<(date("Y")-14);$num_y++)
				{
					if ($num_y==$byear)
					{
						$select_year.="<option value=\"".$num_y."\" selected>".$num_y."</option>";
					}
					else
					{
						$select_year.="<option value=\"".$num_y."\">".$num_y."</option>";
					}
				}
				for ($num_m=1;$num_m<=12;$num_m++)
				{
					if ($num_m==$bmonth)
					{
						$select_month.="<option value=\"".$num_m."\" selected>".$num_m."</option>";
					}
					else
					{
						$select_month.="<option value=\"".$num_m."\">".$num_m."</option>";
					}
				}
				for ($num_d=1;$num_d<=31;$num_d++)
				{
					if ($num_d==$bday)
					{
						$select_day.="<option value=\"".$num_d."\" selected>".$num_d."</option>";
					}
					else
					{
						$select_day.="<option value=\"".$num_d."\">".$num_d."</option>";
					}
				}

				for ($num_marry=0;$num_marry<count($lang_marry);$num_marry++)
				{
					if ($row['marry']==$lang_marry[$num_marry])
					{
						$select_marry.="<option value=\"".$lang_marry[$num_marry]."\" selected>".$lang_marry[$num_marry]."</option>";
					}
					else
					{
						$select_marry.="<option value=\"".$lang_marry[$num_marry]."\">".$lang_marry[$num_marry]."</option>";
					}
				}

				for($num_hk=0;$num_hk<count($lang_province);$num_hk++)
				{
					if ($row['hukou']==$lang_province[$num_hk])
					{
						$select_hk.="<option value=\"".$lang_province[$num_hk]."\" selected>".$lang_province[$num_hk]."</option>";
					}
					else
					{
						$select_hk.="<option value=\"".$lang_province[$num_hk]."\">".$lang_province[$num_hk]."</option>";
					}
				}

				list($live1,$live2)=explode('-',$row['living']);
				for($num_live=0;$num_live<count($lang_province);$num_live++)
				{
					if ($live1==$lang_province[$num_live])
					{
						$select_live.="<option value=\"".$lang_province[$num_live]."\" selected>".$lang_province[$num_live]."</option>";
					}
					else
					{
						$select_live.="<option value=\"".$lang_province[$num_live]."\">".$lang_province[$num_live]."</option>";
					}
				}

				list($work_addr1,$work_addr2)=explode('-',$row['forliving']);
				for($num_work=0;$num_work<count($lang_province);$num_work++)
				{
					if ($work_addr1==$lang_province[$num_work])
					{
						$select_address.="<option value=\"".$lang_province[$num_work]."\" selected>".$lang_province[$num_work]."</option>";
					}
					else
					{
						$select_address.="<option value=\"".$lang_province[$num_work]."\">".$lang_province[$num_work]."</option>";
					}
				}

				for($num_edu=0;$num_edu<count($lang_edu);$num_edu++)
				{
					if ($row['edu']==$lang_edu[$num_edu])
					{
						$select_edu.="<option value=\"".$lang_edu[$num_edu]."\" selected>".$lang_edu[$num_edu]."</option>";
					}
					else
					{
						$select_edu.="<option value=\"".$lang_edu[$num_edu]."\">".$lang_edu[$num_edu]."</option>";
					}
				}

				list($depart1,$depart2)=explode('-',$row['depart']);

				?>
				<script src="../css/zhuanye.js"></script>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="td_four">
                  <form action="hunter.php" method="post" name="waneinfo" onsubmit="return checkform(this)">
                    <tr align="left" bgcolor="#E7E7F1">
                      <td height="25" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600">〖 基 本 资 料 〗</font> </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">真实姓名</td>
                      <td width="35%" align="left">&nbsp;<input name="truename" type="text" class="input" id="truename" value="<?=$row['truename']?>" maxlength="6"></td>
                      <td width="15%" align="center">目前行业</td>
                      <td width="35%" height="25" align="left">&nbsp;<select name="industry" class="input" id="industry"><?=$select_industry?></select></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">目前年薪</td>
                      <td width="35%" align="left">&nbsp;<select name="year_pay" class="input" id="year_pay"><?=$select_year_pay?></select></td>
                      <td width="15%" align="center">期待年薪</td>
                      <td width="35%" height="25" align="left">&nbsp;<select name="year_pay_for" class="input" id="year_pay_for"><?=$select_year_pay_for?></select></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">目前职位</td>
                      <td width="35%" align="left">&nbsp;<input name="position" type="text" class="input" id="position" value="<?=$row['position']?>"></td>
                      <td width="15%" align="center">期待职位</td>
                      <td width="35%" height="25" align="left">&nbsp;<input name="for_position" type="text" class="input" id="for_position" value="<?=$row['for_position']?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">有效期至</td>
                      <td height="25" align="left">&nbsp;
                        <input name="lyear" type="text" class="input" id="lyear" value="<?=$toyear?>" size="4" maxlength="4">
                        年
                        <input name="lmonth" type="text" class="input" id="lmonth" value="<?=$tomonth?>" size="2" maxlength="2">
                        月
                        <input name="lday" type="text" class="input" id="day" value="<?=$today?>" size="2" maxlength="2">
                        日<input name="hunterid" type="hidden" id="hunterid" value="<?=$row['id']?>">
                      </td>
                      <td height="25" align="center">显示状态</td>
                      <td height="25" align="left">&nbsp;
                      <input name="sign" type="radio" value="1" <? if ($row['sign']=='1') echo "checked";?>>
                      显示&nbsp;&nbsp;&nbsp;                      <input name="sign" type="radio" value="0" <? if ($row['sign']=='0') echo "checked";?>>
                      隐藏</td>
                    </tr>
                    <tr align="left" bgcolor="#E7E7F1">
                      <td height="25" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600">〖 联 系 资 料 〗</font> </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">手&nbsp;&nbsp;&nbsp;&nbsp;机</td>
                      <td width="35%" align="left">&nbsp;<input name="mobile" type="text" class="input" id="mobile" value="<?=$row['mobile']?>" maxlength="12"></td>
                      <td width="15%" align="center">住宅电话</td>
                      <td width="35%" height="25" align="left">&nbsp;<input name="phone" type="text" class="input" id="phone" value="<?=$row['phone']?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">联系地址</td>
                      <td width="35%" align="left">&nbsp;<input name="address" type="text" class="input" id="address" value="<?=$row['address']?>" size="45"></td>
                      <td width="15%" align="center">邮政编码</td>
                      <td width="35%" height="25" align="left">&nbsp;<input name="code" type="text" class="input" id="code" value="<?=$row['code']?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">E - mail </td>
                      <td width="35%" align="left">&nbsp;<input name="email" type="text" class="input" id="email" value="<?=$row['email']?>" size="35"></td>
                      <td width="15%" align="center">方便联系时间</td>
                      <td width="35%" height="25" align="left">&nbsp;<input name="linktime" type="text" class="input" id="linktime" value="<?=$row['linktime']?>"></td>
                    </tr>
                    <tr align="left" bgcolor="#E7E7F1">
                      <td height="25" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600">〖 个 人 概 况 〗</font> </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">性别</td>
                      <td width="35%" align="left">&nbsp;<select name="sex" class="input" id="sex"><?=$select_sex?></select></td>
                      <td width="15%" align="center">出生年月</td>
                      <td width="35%" height="25" align="left">&nbsp;<select name="year" class="input" id="year"><?=$select_year?></select>年<select name="month" class="input" id="month"><?=$select_month?></select>月<select name="day" class="input" id="day"><?=$select_day?></select>日</td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">身份证</td>
                      <td width="35%" align="left">&nbsp;<input name="sidcard" type="text" class="input" id="sidcard" value="<?=$row['sidcard']?>" size="25" maxlength="18"></td>
                      <td width="15%" align="center">婚姻状况</td>
                      <td width="35%" height="25" align="left">&nbsp;<select name="marry" class="input" id="marry"><?=$select_marry?></select></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">户口所在地</td>
                      <td height="25" colspan="3" align="left">&nbsp;<select name="hukou" class="input" id="hukou"><?=$select_hk?></select>
                      </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">目前所在地</td>
                      <td height="25" colspan="3" align="left">&nbsp;<select name="living_1" class="input" id="living_1"><?=$select_live?></select>
                          <input name="living_2" type="text" class="input" id="living_2" value="<?=$live2?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">工作所在地</td>
                      <td height="25" colspan="3" align="left">&nbsp;<select name="forliving_1" class="input" id="forliving_1">
                          <option value="不限">不限</option><?=$select_address?></select>
						<input name="forliving_2" type="text" class="input" id="forliving_2" value="<?=$work_addr2?>"></td>
                    </tr>
                    <tr align="left" bgcolor="#E7E7F1">
                      <td height="25" colspan="4" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600">〖 教 育 资 料 〗</font> </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">最高学历</td>
                      <td width="35%" align="left">&nbsp;<select name="edu" class="input" id="edu"><?=$select_edu?></select></td>
                      <td width="15%" align="center">毕业学校</td>
                      <td width="35%" height="25" align="left">&nbsp;<input name="graedu" type="text" class="input" id="graedu" value="<?=$row['graedu']?>"></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">专业类别</td>
                      <td width="35%" align="left">&nbsp;<select name="smajortype" class="input" onchange="m_change(this,this.form.smajorname)">
                      </select></td>
                      <td width="15%" align="center">专业名称</td>
                      <td width="35%" height="25" align="left">&nbsp;<select name="smajorname" class="input">
                        </select>
                          <script language=javascript>m_inits(document.waneinfo.smajortype,document.waneinfo.smajorname,"<?=$depart1?>","<?=$depart2?>")</script></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="90" align="center">培训信息</td>
                      <td colspan="3" align="left">&nbsp;<textarea name="train" cols="100" rows="5" wrap="VIRTUAL" class="input" id="train"><?=$row['train']?>
                      </textarea></td>
                    </tr>
                    <tr align="left" bgcolor="#E7E7F1">
                      <td height="25" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600">〖 工 作 说 明 〗</font> </td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">工作经历</td>
                      <td height="90" colspan="3" align="left">&nbsp;<textarea name="workexp" cols="100" rows="5" wrap="VIRTUAL" class="input" id="workexp"><?=$row['workexp']?>
                      </textarea></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">专业特长</td>
                      <td height="90" colspan="3" align="left">&nbsp;<textarea name="enable" cols="100" rows="5" wrap="VIRTUAL" class="input" id="enable"><?=$row['enable']?>
                      </textarea></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td width="15%" height="25" align="center">个人综述</td>
                      <td height="90" colspan="3" align="left">&nbsp;<textarea name="context" cols="100" rows="5" wrap="VIRTUAL" class="input" id="context"><?=$row['context']?>
                      </textarea></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td height="30" colspan="4" align="center">&nbsp;<input name="submit_find_edit" type="submit" class="input" id="submit_hunter" value=" 提 交 ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Submit" type="reset" class="input" value=" 重 设 ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Submit" type="reset" class="input" value=" 返 回 " onclick="javascript:history.go(-1)"></td>
                    </tr>
                  </form>
		    </table>
				<?
			}
		?>
		<!--job end-->
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
