<?php
	require "admin_globals.php";
	require "admin_check.php";
	$m	=	$tablepre.'member';
	$c	=	$tablepre.'jianliqy';
	$p	=	$tablepre.'jianli';
	$submit_method=$HTTP_SERVER_VARS[REQUEST_METHOD];
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
<script src="../css/zhuanye.js"></script>
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
		if ($user_manage)
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
			}
			if ($com_checked)
			{
				$db->query("UPDATE $m SET info_sign='1' where username in ($ids)");
			}
			elseif ($com_uncheck)
			{
				$db->query("UPDATE $m SET info_sign='0' where username in ($ids)");
			}
			elseif ($com_delete)
			{
				$db->query("DELETE FROM $m where username in ($ids)");
				$db->query("DELETE FROM $c where qyuser in ($ids)");

				$db->query("DELETE FROM {$tablepre}find_fav where user_id in ($ids)");
				$db->query("DELETE FROM {$tablepre}job_fav where user_id in ($ids)");

				$db->query("DELETE FROM {$tablepre}hunter_com where username in ($ids)");
				$db->query("DELETE FROM {$tablepre}job_chance where username in ($ids)");

				$db->query("DELETE FROM {$tablepre}job_peixun where username in ($ids)");

				$db->query("DELETE FROM {$tablepre}per_rec where author in ($ids)");
				$db->query("DELETE FROM {$tablepre}per_send where author in ($ids)");
				$db->query("DELETE FROM {$tablepre}send_hunter_com where author in ($ids)");
				$db->query("DELETE FROM {$tablepre}send_hunter_per where author in ($ids)");

				$db->query("DELETE FROM {$tablepre}pxschool where username in ($ids)");

				update_cache('cache_all','1');
			}
			elseif($com_up)
			{
				$viptime=mktime(0,0,0,$month,$day,$year);
				$db->query("UPDATE $m SET vip='1' where username in ($ids)");
				$db->query("UPDATE $m SET losetime='$viptime' where username in ($ids)");
			}
			elseif($com_down)
			{
				$db->query("UPDATE $m SET vip='0' where username in ($ids)");
				$db->query("UPDATE $m SET losetime='0' where username in ($ids)");
			}
			elseif ($per_checked)
			{
				$db->query("UPDATE $m SET info_sign='1' where username in ($ids)");
			}
			elseif ($per_uncheck)
			{
				$db->query("UPDATE $m SET info_sign='0' where username in ($ids)");
			}
			elseif ($per_delete)
			{
				$db->query("DELETE FROM $m where username in ($ids)");
				$db->query("DELETE FROM $p where username in ($ids)");

				$db->query("DELETE FROM {$tablepre}find_fav where user_id in ($ids)");
				$db->query("DELETE FROM {$tablepre}job_fav where user_id in ($ids)");

				$db->query("DELETE FROM {$tablepre}per_rec where author in ($ids)");
				$db->query("DELETE FROM {$tablepre}per_send where author in ($ids)");
				$db->query("DELETE FROM {$tablepre}send_hunter_com where author in ($ids)");
				$db->query("DELETE FROM {$tablepre}send_hunter_per where author in ($ids)");

				$db->query("DELETE FROM {$tablepre}hunter_per where username in ($ids)");
				$db->query("DELETE FROM {$tablepre}findjob_chance where username in ($ids)");

				$db->query("DELETE FROM {$tablepre}teacher_job where username in ($ids)");

				$db->query("DELETE FROM {$tablepre}teacher_find where username in ($ids)");

				update_cache('cache_all','1');
			}
			elseif($per_up)
			{
				$viptime=mktime(0,0,0,$month,$day,$year);
				$db->query("UPDATE $m SET vip='1' where username in ($ids)");
				$db->query("UPDATE $m SET losetime='$viptime' where username in ($ids)");
			}
			elseif($per_down)
			{
				$db->query("UPDATE $m SET vip='0' where username in ($ids)");
				$db->query("UPDATE $m SET losetime='0' where username in ($ids)");
			}
			else
			{
				echo clickback('非法操作');exit;
			}
			echo refreshback('操作成功');
			echo showmsg('user_manage.php?action='.$action.'&type='.$type,'2');
			echo endhtml();
			echo wwwwanenet();
			exit;
		}
		elseif ($submit_editcom)
		{
			$update_pass=($password!='' && strlen($password)>5)	?	"password='".md5($password)."',"	:	"";
			$update_losetime=($vip=='1')	?	"losetime='".mktime(0,0,0,$month,$day,$year)."',"	:	"";
			if ($HTTP_POST_FILES[userfile][name]!='')
			{
				$imgurl=upload_img($HTTP_POST_FILES['userfile']['name'],$HTTP_POST_FILES['userfile']['tmp_name'],'../qy_img');
				if ($oriimg!='' and file_exists($oriimg))
				{
					delete_file($oriimg);
				}
				$update_img="qy_img='".str_replace("../","./",$imgurl)."',";
			}
			$sql_basic="UPDATE
							{$tablepre}member
						SET
							$update_pass
							email='$email',
							vip='$vip',
							info_sign='$info_sign',
							question='$question',
							answer='$answer',
							$update_losetime
							logins='$logins'
						WHERE
							username = '$edituid'";
			$sql_jianli="UPDATE
							{$tablepre}jianliqy
						SET
							qyname='$qyname',
							qyaddress='$qyaddress',
							qypro='$qypro',
							qykind='$qykind',
							qyman='$qyman',
							contact_name='$contact_name',
							qyphone='$qyphone',
							qyemail='$qyemail',
							qyyoubian='$qyyoubian',
							qyweb='$qyweb',
							qyjianjie='$qyjianjie',
							$update_img
							clicked='$clicked',
							lastupdate='".time()."'
						WHERE
							qyuser='$edituid'";
			$db->query($sql_basic);
			$db->query($sql_jianli);
			echo refreshback('操作成功');
			echo showmsg('user_manage.php?action=com','2');
			echo endhtml();
			echo wwwwanenet();
			exit;
		}
		elseif($submit_editper)
		{
			$update_pass=($password!='' && strlen($password)>5)	?	"password='".md5($password)."',"	:	"";
			$update_losetime=($vip=='1')	?	"losetime='".mktime(0,0,0,$month,$day,$year)."',"	:	"";
			$sql_basic="UPDATE
							{$tablepre}member
						SET
							$update_pass
							email='$email',
							vip='$vip',
							info_sign='$info_sign',
							question='$question',
							answer='$answer',
							$update_losetime
							logins='$logins'
						WHERE
							username = '$edituid'";

			$sql_jianli="UPDATE
							{$tablepre}jianli
						SET
							truename='$truename',
							sex='$sex',
							mingzu='$mingzu',
							birth='$birth',
							juzhudi='$juzhudi',
							shengfengzhen='$shengfengzhen',
							marry='$marry',
							social='$social',
							graedu='$graedu',
							edu='$edu',
							graedutime='$graedutime',
							zhuanyename='$zhuanyename',
							phone='$phone',
							handphone='$handphone',
							comphone='$comphone',
							email='$email',
							qq='$qq',
							clicked='$clicked',
							lastupdate='".time()."'
						WHERE
							username='$edituid'";
			$db->query($sql_basic);
			$db->query($sql_jianli);
			echo refreshback('操作成功');
			echo showmsg('user_manage.php?action=per','2');
			echo endhtml();
			echo wwwwanenet();
			exit;
		}
		elseif($submit_search)
		{
			if ($search_object)
			{
				$sch_url="user_manage.php?action=com&type=search&username=".urlencode($username)."&vip=".$vip."&info_sign=".$info_sign."&qyname=".urlencode($qyname)."&qyaddress=".urlencode($qyaddress)."&qypro=".urlencode($qypro)."&qykind=".urlencode($qykind)."&qyman=".urlencode($qyman);
			}
			else
			{
				$sch_url="user_manage.php?action=per&type=search&username=".urlencode($username)."&vip=".$vip."&info_sign=".$info_sign."&truename=".urlencode($truename)."&sex=".urlencode($sex)."&edu=".urlencode($edu)."&mingzu=".urlencode($mingzu)."&zhuanyename=".urlencode($smajortype);
			}
			echo refreshback('查询结束');
			echo showmsg($sch_url,'2');
			echo endhtml();
			echo wwwwanenet();
			exit;
		}
		elseif ($submit_addadmin)
		{
			if (empty($username) || empty($password)){echo clickback('用户名和密码不能为空');exit;}
			$query=$db->query("select username from $m where username='$username'");
			if ($db->num($query))
			{
				echo clickback('此用户已经存在');exit;
			}
			else
			{
				$db->query("INSERT INTO $m (username,password,email,kind,vip,info_sign,question,answer,regtime) VALUES ('$username','".md5($password)."','$email','$kind_admin','1','1','$question','$answer','".time()."')");
				echo refreshback('操作成功');
				echo showmsg('user_manage.php?action=admin','2');
				echo endhtml();
				echo wwwwanenet();
				exit;
			}
		}
		elseif($submit_editadmin)
		{
			$update_pass=($password!='' && strlen($password)>5)	?	"password='".md5($password)."',"	:	""	;
			$db->query("UPDATE $m SET  $update_pass email='$email',question='$question',answer='$answer'  WHERE username='$edituid'");
			echo refreshback('操作成功');
			echo showmsg('user_manage.php?action=admin','2');
			echo endhtml();
			echo wwwwanenet();
			exit;
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=admin">管理员</a> &nbsp;| <a href="?action=com">企业用户</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=com&type=vip">企业 VIP</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=com&type=checked">已认证</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=com&type=uncheck">未认证</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=per">个人用户</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=per&type=vip">个人 VIP</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=per&type=checked">已认证</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=per&type=uncheck">未认证</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=search">用户查询</a></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">
		<?
			if ($action=='search')
			{//	search
			?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="user_manage.php" method="post"  name="waneinfo" onsubmit="return checkform(this)">
			  <tr align="center">
				<td height="25" colspan="2" bgcolor="#E6E8EC"><strong>会 员 查 询</strong></td>
			  </tr>
			  <tr>
			    <td height="25" align="center" bgcolor="#F1F2F4">登陆用户名</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;
			      <input name="username" type="text" id="username"></td>
			    </tr>
			  <tr>
				<td width="20%" height="25" align="center" bgcolor="#F1F2F4">会员类型</td>
				<td height="25" bgcolor="#F1F2F4">&nbsp;
				  <input name="search_object" type="radio" value="1" checked>
				  企业用户&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;
				  <input name="search_object" type="radio" value="0">
				  个人用户</td>
			  </tr>
			  <tr>
			    <td height="25" align="center" bgcolor="#F1F2F4">认证用户</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;
                  <input name="info_sign" type="radio" value="1">
是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
<input name="info_sign" type="radio" value="0">
否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
<input name="info_sign" type="radio" value="-1" checked>
不限</td>
			    </tr>
			  <tr>
				<td height="25" align="center" bgcolor="#F1F2F4">VIP用户</td>
				<td height="25" bgcolor="#F1F2F4">&nbsp;
                  <input name="vip" type="radio" value="1">
是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
<input name="vip" type="radio" value="0">
否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
<input name="vip" type="radio" value="-1" checked>
不限</td>
			  </tr>
			  <tr>
				<td height="25" colspan="2" align="center" bgcolor="#E6E8EC">企业用户</td>
				</tr>
			  <tr>
				<td height="25" align="center" bgcolor="#F1F2F4">企业名称</td>
				<td height="25" bgcolor="#F1F2F4">&nbsp;
				  <input name="qyname" type="text" id="qyname"></td>
			  </tr>
			  <tr>
				<td height="25" align="center" bgcolor="#F1F2F4">企业地址</td>
				<td height="25" bgcolor="#F1F2F4">&nbsp;
				  <input name="qyaddress" type="text" id="qyaddress" size="45"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25" align="center">企业性质</td>
				<td>&nbsp;
				<select name="qypro" id="qypro">
				<option value="0"><?=$lang_unset?></option>
				<?
					for ($num_pro=0;$num_pro<count($lang_company_kind);$num_pro++)
					{
						$select_pro.=$row[qypro]==$lang_company_kind[$num_pro]	?	"<option value=\"".$lang_company_kind[$num_pro]."\" selected>".$lang_company_kind[$num_pro]."</option>"	:	"<option value=\"".$lang_company_kind[$num_pro]."\">".$lang_company_kind[$num_pro]."</option>"	;
					}
					echo $select_pro;
					unset($select_pro);
				?>
				</select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">所属行业</td>
				<td>&nbsp;
				  <select name="qykind" id="qykind"><option value="0"><?=$lang_unset?></option>
				  <?
					for ($num_kind=0;$num_kind<count($lang_company_belong);$num_kind++)
					{
						$select_kind.=$row[qykind]==$lang_company_belong[$num_kind]	?	"<option value=\"".$lang_company_belong[$num_kind]."\" selected>".$lang_company_belong[$num_kind]."</option>"	:	"<option value=\"".$lang_company_belong[$num_kind]."\">".$lang_company_belong[$num_kind]."</option>"	;
					}
					echo $select_kind;
					unset($select_kind);
				?>
				</select></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center">企业规模</td>
				<td>&nbsp;
				  <select name="qyman" id="qyman">
				  <option value="0"><?=$lang_unset?></option>
				  <?
					for ($num_space=0;$num_space<count($lang_company_space);$num_space++)
					{
						$select_space.=$row[qyman]==$lang_company_space[$num_space]	?	"<option value=\"".$lang_company_space[$num_space]."\" selected>".$lang_company_space[$num_space]."</option>"	:	"<option value=\"".$lang_company_space[$num_space]."\">".$lang_company_space[$num_space]."</option>"	;
					}
					echo $select_space;
					unset($select_space);
				?>
				</select></td>
			  </tr>
			  <tr bgcolor="#E6E8EC">
				<td height="25" colspan="2" align="center">个人用户</td>
				</tr>
			  <tr>
				<td height="25" align="center" bgcolor="#F1F2F4">真实姓名</td>
				<td height="25" bgcolor="#F1F2F4">&nbsp;	<input name="truename" type="text" id="truename" size="13" maxlength="13"></td>
			  </tr>
			  <tr>
				<td height="25" align="center" bgcolor="#F1F2F4">性别</td>
				<td height="25" bgcolor="#F1F2F4">&nbsp;
				  <select name="sex">
				  	<option value="0"><?=$lang_unset?></option>
					<option value="<?=$lang_ssex[0]?>"><?=$lang_ssex[0]?></option>
					<option value="<?=$lang_ssex[1]?>"><?=$lang_ssex[1]?></option>
                </select></td>
			  </tr>
			  <tr>
			    <td height="25" align="center" bgcolor="#F1F2F4">学历</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;
                  <select name="edu">
				  	<option value="0"><?=$lang_unset?></option>
					<?
						for ($num_edu=0;$num_edu<count($lang_edu);$num_edu++)
						{
							echo "<option value=\"".$lang_edu[$num_edu]."\">".$lang_edu[$num_edu]."</option>";
						}
					?>
                  </select></td>
			    </tr>
			  <tr>
			    <td height="25" align="center" bgcolor="#F1F2F4">民族</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;
                  <select name="mingzu">
				  	<option value="0"><?=$lang_unset?></option>
					<?
						for ($num_mz=0;$num_mz<count($lang_minzu);$num_mz++)
						{
							echo "<option value=\"".$lang_minzu[$num_mz]."\">".$lang_minzu[$num_mz]."</option>";
						}
					?>
                  </select></td>
			    </tr>
			  <tr>
			    <td height="25" align="center" bgcolor="#F1F2F4">专业类别</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;
                  <select name="smajortype" class="input" onchange="m_change(this,this.form.smajorname)"></select></td>
			    </tr>
			  <tr>
			    <td height="25" align="center" bgcolor="#F1F2F4">专业名称</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;
                  <select name="smajorname" class="input"></select><script language=javascript>m_inits(document.waneinfo.smajortype,document.waneinfo.smajorname,"不限","不限")</script></td>
			    </tr>
			  <tr bgcolor="#E6E8EC">
			    <td height="30" colspan="2" align="center"><input name="submit_search" type="submit" id="submit_search" value="提交查询"></td>
			    </tr>
			</form>
			</table>
			<? }
			elseif ($action=='edit_admin')
			{
				$query=$db->query("select * from $m where username='".urldecode($info)."' and kind='$kind_admin'");
				if (!$db->num($query)){echo clickback('资源定位出错');exit;}
				else
				{$row=$db->row($query);}
			?>
            <table width="100%"  border="0" cellspacing="1" cellpadding="0">
              <tr align="left" bgcolor="#F1F2F4">
                <td height="25" colspan="4" bgcolor="#ECEDF0">&nbsp;&nbsp;&gt;&gt; 编辑管理员</td>
              </tr>
              <form action="user_manage.php" method="post">
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="25">用户名</td>
                  <td height="25" colspan="3" align="left">&nbsp;
                      <input name="username" type="text" id="username" value="<?=$row[username]?>">
                  <input name="edituid" type="hidden" id="edituid" value="<?=$row[username]?>"></td>
                </tr>
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="25">登陆密码</td>
                  <td height="25" colspan="3" align="left">&nbsp;
                      <input name="password" type="text" id="password">
				  &nbsp;(大于 6 位 , 否则系统认为密码不做修改)</td>
                </tr>
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="25">E-MAIL</td>
                  <td height="25" colspan="3" align="left">&nbsp;
                      <input name="email" type="text" id="email" value="<?=$row[email]?>" size="40"></td>
                </tr>
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="25">密码问题</td>
                  <td height="25" colspan="3" align="left">&nbsp;
                      <input name="question" type="text" id="question" value="<?=$row[question]?>" size="55"></td>
                </tr>
                <tr align="center" bgcolor="#F1F2F4">
                  <td height="25">问题回答</td>
                  <td height="25" colspan="3" align="left">&nbsp;
                      <input name="answer" type="text" id="answer" value="<?=$row[answer]?>" size="55"></td>
                </tr>
                <tr align="center" bgcolor="#ECEDF0">
                  <td height="30" colspan="4"><input name="submit_editadmin" type="submit" id="submit_addadmin" value="编辑管理员"></td>
                </tr>
              </form>
            </table>
            <?
				$db->free_result($query);
			}
			elseif ($action=='edit_com')
			{//	edit company
				$sql="select * from $m,$c where $m.username=$c.qyuser and $m.username='".urldecode($info)."'";
				$query=$db->query($sql);
				$row=$db->row($query);
				?>
				<table width="100%" border="0" cellspacing="1" cellpadding="0">
				<form action="user_manage.php" method="post" enctype="multipart/form-data">
				  <tr bgcolor="#F1F2F4">
					<td height="25" colspan="2" align="center"><strong>注 册 资 料</strong></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">用 户 名</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<?=$row[username]?>
					<input name="edituid" type="hidden" id="edituid" value="<?=$info?>"></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">用户类型</td>
					<td bgcolor="#FFFFFF">&nbsp;
					企业用户</td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">VIP</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="vip" type="radio" value="1" <?=$row[vip]?'checked':''?>>
					  是&nbsp;&nbsp;
					  <input name="vip" type="radio" value="0" <?=!$row[vip]?'checked':''?>>
					否</td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">VIP 截至</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="year" type="text" value="<?=date("Y")+1?>" size="4" maxlength="4"> 年 <input name="month" type="text" value="<?=date("n")?>" size="2" maxlength="2"> 月 <input name="day" type="text" value="<?=date("j")?>" size="2" maxlength="2"> 日</td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">登陆密码</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="password" type="text" id="password" size="16">
					&nbsp;(大于 6 位 , 否则系统认为密码不做修改)</td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">注册邮箱</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="email" type="text" id="email" value="<?=$row[email]?>" size="35"></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">密码保护问题</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="question" type="text" id="question" value="<?=$row[question]?>" size="50"></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">问题回答</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="answer" type="text" id="answer" value="<?=$row[answer]?>" size="50"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">注册时间</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<?=date("Y-n-j H:i:s",$row[regtime])?></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">登陆次数</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="logins" type="text" id="logins" value="<?=$row[logins]?>" size="5"></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">注册信息认证</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="info_sign" type="radio" value="1" <?=$row[info_sign]?'checked':''?>>
					  是&nbsp;&nbsp;
					  <input name="info_sign" type="radio" value="0" <?=!$row[info_sign]?'checked':''?>>
					否</td>
				  </tr>
				  <tr bgcolor="#F1F2F4">
					<td height="25" colspan="2" align="center"><strong>简 历 资 料</strong></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">企业名称</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="qyname" type="text" id="qyname" value="<?=$row[qyname]?>" size="40"></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">企业地址</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="qyaddress" type="text" id="qyaddress" value="<?=$row[qyaddress]?>" size="60"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">邮政编码</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<input name="qyyoubian" type="text" id="qyyoubian" value="<?=$row[qyyoubian]?>" size="6" maxlength="6"></td>
				  </tr>
				  <tr>
					<td width="20%" height="25" align="center" bgcolor="#FFFFFF">企业性质</td>
					<td bgcolor="#FFFFFF">&nbsp;
					<select name="qypro" id="qypro">
					<?
						for ($num_pro=0;$num_pro<count($lang_company_kind);$num_pro++)
						{
							$select_pro.=$row[qypro]==$lang_company_kind[$num_pro]	?	"<option value=\"".$lang_company_kind[$num_pro]."\" selected>".$lang_company_kind[$num_pro]."</option>"	:	"<option value=\"".$lang_company_kind[$num_pro]."\">".$lang_company_kind[$num_pro]."</option>"	;
						}
						echo $select_pro;
						unset($select_pro);
					?>
					</select></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">所属行业</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <select name="qykind" id="qykind">
					  <?
						for ($num_kind=0;$num_kind<count($lang_company_belong);$num_kind++)
						{
							$select_kind.=$row[qykind]==$lang_company_belong[$num_kind]	?	"<option value=\"".$lang_company_belong[$num_kind]."\" selected>".$lang_company_belong[$num_kind]."</option>"	:	"<option value=\"".$lang_company_belong[$num_kind]."\">".$lang_company_belong[$num_kind]."</option>"	;
						}
						echo $select_kind;
						unset($select_kind);
					?>
					</select></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">企业规模</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <select name="qyman" id="qyman">
					  <?
						for ($num_space=0;$num_space<count($lang_company_space);$num_space++)
						{
							$select_space.=$row[qyman]==$lang_company_space[$num_space]	?	"<option value=\"".$lang_company_space[$num_space]."\" selected>".$lang_company_space[$num_space]."</option>"	:	"<option value=\"".$lang_company_space[$num_space]."\">".$lang_company_space[$num_space]."</option>"	;
						}
						echo $select_space;
						unset($select_space);
					?>
					</select></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">企业负责人</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <input name="contact_name" type="text" id="contact_name" value="<?=$row[contact_name]?>"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">联系电话</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <input name="qyphone" type="text" id="qyphone" value="<?=$row[qyphone]?>"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">企业邮箱</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <input name="qyemail" type="text" id="qyemail" value="<?=$row[qyemail]?>" size="45"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">企业网址</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <input name="qyweb" type="text" id="qyweb" value="<?=$row[qyweb]?>" size="40"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">企业标志</td>
					<td bgcolor="#FFFFFF">&nbsp;
						<?=($row[qy_img]!='' && file_exists(str_replace("./","../",$row[qy_img])))	?	'<a href=\''.str_replace("./","../",$row[qy_img]).'\' target=\'_blank\'>查看标志</a>'	:	'<font color=\'#ff0000\'>无</font>'?>
						&nbsp;&nbsp;
						<input name="oriimg" type="hidden" id="oriimg" value="<?=($row[qy_img]!='' && file_exists(str_replace("./","../",$row[qy_img])))	?	str_replace("./","../",$row[qy_img])	:	"0"?>">
						&nbsp;&nbsp;
					<input type="file" name="userfile" size="45"></td>
				  </tr>
				  <tr>
					<td height="160" align="center" bgcolor="#FFFFFF">企业简介</td>
					<td height="160" bgcolor="#FFFFFF">&nbsp;
					  <textarea name="qyjianjie" cols="70" rows="10" wrap="VIRTUAL" id="qyjianjie"><?=$row[qyjianjie]?>
					  </textarea></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">查询次数</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <input name="clicked" type="text" id="clicked" value="<?=$row[clicked]?>" size="6" maxlength="12"></td>
				  </tr>
				  <tr>
					<td height="25" align="center" bgcolor="#FFFFFF">最后更新</td>
					<td bgcolor="#FFFFFF">&nbsp;
					  <?=$row[lastupdate]>0	?	date("Y-n-j H:i:s",$row[lastupdate])	:	'Never'?></td>
				  </tr>
				  <tr bgcolor="#F1F2F4">
					<td height="35" colspan="2" align="center"><input name="submit_editcom" type="submit" id="submit_editcom" value=" 保 存 修 改 "></td>
				  </tr>
				</form>
				</table>
				<?
				$db->free_result($query);
			}
			if ($action=='edit_per')
			{//	edit personal
				$sql="select * from $m,$p where $m.username=$p.username and $m.username='".urldecode($info)."'";
				$query=$db->query($sql);
				$row=$db->row($query);
				?>
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <form action="user_manage.php" method="post" enctype="multipart/form-data">
                    <tr bgcolor="#F1F2F4">
                      <td height="25" colspan="2" align="center"><strong>注 册 资 料</strong></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">用 户 名</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <?=$row[username]?>
                          <input name="edituid" type="hidden" id="edituid" value="<?=$info?>"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">用户类型</td>
                      <td bgcolor="#FFFFFF">&nbsp; 个人用户</td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">VIP</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="vip" type="radio" value="1" <?=$row[vip]?'checked':''?>>
        是&nbsp;&nbsp;
        <input name="vip" type="radio" value="0" <?=!$row[vip]?'checked':''?>>
        否</td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">VIP 截至</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="year" type="text" value="<?=date("Y")+1?>" size="4" maxlength="4">
        年
        <input name="month" type="text" value="<?=date("n")?>" size="2" maxlength="2">
        月
        <input name="day" type="text" value="<?=date("j")?>" size="2" maxlength="2">
        日</td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">登陆密码</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="password" type="text" id="password" size="16">
&nbsp;(大于 6 位 , 否则系统认为密码不做修改)</td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">注册邮箱</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="email" type="text" id="email" value="<?=$row[email]?>" size="35"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">密码保护问题</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="question" type="text" id="question" value="<?=$row[question]?>" size="50"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">问题回答</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="answer" type="text" id="answer" value="<?=$row[answer]?>" size="50"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">注册时间</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <?=date("Y-n-j H:i:s",$row[regtime])?></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">登陆次数</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="logins" type="text" id="logins" value="<?=$row[logins]?>" size="5"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">注册信息认证</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="info_sign" type="radio" value="1" <?=$row[info_sign]?'checked':''?>>
        是&nbsp;&nbsp;
        <input name="info_sign" type="radio" value="0" <?=!$row[info_sign]?'checked':''?>>
        否</td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td height="25" colspan="2" align="center"><strong>简 历 资 料</strong></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">真实姓名</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="truename" type="text" id="truename" value="<?=$row[truename]?>" size="12" maxlength="12"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">性别</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="sex" type="text" id="sex" value="<?=$row[sex]?>" size="4" maxlength="4"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">民族</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="mingzu" type="text" id="mingzu" value="<?=$row[mingzu]?>" size="12" maxlength="30"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" align="center" bgcolor="#FFFFFF">生日</td>
                      <td bgcolor="#FFFFFF">&nbsp;                          <input name="birth" type="text" id="birth" value="<?=$row[birth]?>" size="12" maxlength="10">
                        &nbsp;(如:1981-7-25)</td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">居住地</td>
                      <td bgcolor="#FFFFFF">&nbsp;                          <input name="juzhudi" type="text" id="juzhudi" value="<?=$row[juzhudi]?>" size="55">
                        &nbsp;(省份-详细地址)</td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">身份证</td>
                      <td bgcolor="#FFFFFF">&nbsp;                          <input name="shengfengzhen" type="text" id="shengfengzhen" value="<?=$row[shengfengzhen]?>" size="18" maxlength="18"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">婚姻</td>
                      <td bgcolor="#FFFFFF">&nbsp; <input name="marry" type="text" id="marry" value="<?=$row[marry]?>" size="12" maxlength="12"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">政治面貌</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="social" type="text" id="social" value="<?=$row[social]?>" size="6" maxlength="12"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">毕业学校</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="graedu" type="text" id="graedu" value="<?=$row[graedu]?>" size="45"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">毕业年份</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                        <input name="graedutime" type="text" id="graedutime" value="<?=$row[graedutime]?>" size="4" maxlength="4">
                      &nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">学历</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="edu" type="text" id="edu" value="<?=$row[edu]?>" size="12" maxlength="30"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">专业</td>
                      <td bgcolor="#FFFFFF">&nbsp;                          <input name="zhuanyename" type="text" id="zhuanyename" value="<?=$row[zhuanyename]?>" size="30" maxlength="30"></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2" align="center" bgcolor="#F1F2F4"><strong>联 系 资 料</strong>&nbsp;                          </td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">联系电话</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                        <input name="phone" type="text" id="phone" value="<?=$row[phone]?>"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">手机</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                        <input name="handphone" type="text" id="handphone" value="<?=$row[handphone]?>"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">公司电话</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                        <input name="comphone" type="text" id="comphone" value="<?=$row[comphone]?>"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">电子邮箱</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                        <input name="email" type="text" id="email" value="<?=$row[email]?>"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">QQ</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                        <input name="qq" type="text" id="qq" value="<?=$row[qq]?>"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">查询次数</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <input name="clicked" type="text" id="clicked" value="<?=$row[clicked]?>" size="6" maxlength="12"></td>
                    </tr>
                    <tr>
                      <td height="25" align="center" bgcolor="#FFFFFF">最后更新</td>
                      <td bgcolor="#FFFFFF">&nbsp;
                          <?=$row[lastupdate]>0	?	date("Y-n-j H:i:s",$row[lastupdate])	:	'Never'?></td>
                    </tr>
                    <tr bgcolor="#F1F2F4">
                      <td height="35" colspan="2" align="center"><input name="submit_editper" type="submit" id="submit_editper" value=" 保 存 修 改 "></td>
                    </tr>
                  </form>
                </table>
            <?
				$db->free_result($query);
			}
			elseif ($action=='admin')
			{
				if ($type=='delete' && $info!='')
				{
					$db->query("DELETE FROM $m WHERE username='$info' and kind='$kind_admin'");
					echo refreshback('操作成功');
					echo showmsg('user_manage.php?action=admin','2');
					//echo endhtml();
					echo wwwwanenet();
					exit;
				}
				else
				{
						$query=$db->query("select * from $m where kind='$kind_admin'");
					?>
					<table width="100%"  border="0" cellspacing="1" cellpadding="0">
					  <tr align="center" bgcolor="#ECEDF0">
						<td height="25">用户名</td>
						<td height="25">注册时间</td>
						<td height="25">登陆次数</td>
						<td height="25">操作</td>
					  </tr>
					  <?
						while ($row=$db->row($query))
						{?>
						  <tr align="center" bgcolor="#F1F2F4">
							<td height="25"><?=$row[username]?></td>
							<td height="25"><?=date("Y-n-j",$row[regtime])?></td>
							<td height="25"><?=$row[logins]?></td>
							<td height="25"><a href="user_manage.php?action=edit_admin&info=<?=urlencode($row[username])?>">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=admin&type=delete&info=<?=$row[username]?>">删除</a></td>
						  </tr>
						<? }
					  ?>
					  <tr align="left" bgcolor="#F1F2F4">
						<td height="25" colspan="4" bgcolor="#ECEDF0">&nbsp;&nbsp;&gt;&gt; 新建管理员</td>
					  </tr>
					  <form action="user_manage.php" method="post">
					  <tr align="center" bgcolor="#F1F2F4">
						<td height="25">用户名</td>
						<td height="25" colspan="3" align="left">&nbsp;
						  <input name="username" type="text" id="username"></td>
						</tr>
					  <tr align="center" bgcolor="#F1F2F4">
						<td height="25">登陆密码</td>
						<td height="25" colspan="3" align="left">&nbsp;
						  <input name="password" type="text" id="password"></td>
						</tr>
					  <tr align="center" bgcolor="#F1F2F4">
						<td height="25">E-MAIL</td>
						<td height="25" colspan="3" align="left">&nbsp;
						  <input name="email" type="text" id="email" size="40"></td>
						</tr>
					  <tr align="center" bgcolor="#F1F2F4">
						<td height="25">密码问题</td>
						<td height="25" colspan="3" align="left">&nbsp;
						  <input name="question" type="text" id="question" size="55"></td>
						</tr>
					  <tr align="center" bgcolor="#F1F2F4">
						<td height="25">问题回答</td>
						<td height="25" colspan="3" align="left">&nbsp;
						  <input name="answer" type="text" id="answer" size="55"></td>
						</tr>
					  <tr align="center" bgcolor="#ECEDF0">
						<td height="30" colspan="4"><input name="submit_addadmin" type="submit" id="submit_addadmin" value="建立管理员"></td>
					  </tr>
					  </form>
					</table>
					<?
				}
			}
			elseif ($action=='com')
			{//	company users list
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			<form action="user_manage.php" method="post">
			  <tr bgcolor="#ECEDF0">
				<td height="25" align="center">用户名</td>
				<td align="center">企业名称</td>
				<td align="center">认证</td>
				<td align="center">注册时间</td>
				<td align="center">VIP时限</td>
				<td align="center">登陆次数</td>
				<td align="center">操作</td>
				<td height="25" align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <?
			  	$count="15";
			  	$str="$m.kind='$kind_com'";
				if ($type=='vip')
				{
					$str.=" and $m.vip='1'";
					$str2="action=com&type=vip";
				}
				elseif ($type=='checked')
				{
					$str.=" and $m.info_sign='1'";
					$str2="action=com&type=checked";
				}
				elseif ($type=='uncheck')
				{
					$str.=" and $m.info_sign='0'";
					$str2="action=com&type=uncheck";
				}
				elseif ($type=='search')
				{
					if ($username!=''){$str.="and $m.username like '".urldecode($username)."'";}else{$str=$str;}
					if ($vip!='-1'){$str.=" and $m.vip='$vip'";}else{$str=$str;}
					if ($info_sign!='-1'){$str.=" and $m.info_sign='$info_sign'";}else{$str=$str;}
					if ($qyname!=''){$str.=" and $c.qyname like '%".urldecode($qyname)."%'";}else{$str=$str;}
					if ($qyaddress!=''){$str.=" and $c.qyaddress like '%".urldecode($qyaddress)."%'";}
					if ($qypro!='0'){$str.=" and $c.qypro like '%".urldecode($qypro)."%'";}else{$str=$str;}
					if ($qykind!='0'){$str.=" and $c.qykind = '".urldecode($qykind)."'";}else{$str=$str;}
					if ($qyman!='0'){$str.=" and $c.qyman = '".urldecode($qyman)."'";}else{$str=$str;}

					$str2="action=com&type=search&username=".urlencode(urldecode($username))."&vip=$vip&info_sign=$info_sign&qyname=".urlencode(urldecode($qyname))."&qyaddress=".urlencode(urldecode($qyaddress))."&qypro=".urlencode($qypro)."&qykind=".urlencode($qykind)."&qyman=".urlencode(urldecode($qyman));
				}
				else
				{
					$str=$str;
					$str2="action=com";
				}
				$str.=" and $m.username=$c.qyuser";
				$table="$m,$c";
				require 'page_count.php';
				$sql="select * from $table where $str order by id desc limit $offset,$psize";
				$query=$db->query($sql);
				while ($row=$db->row($query))
				{
					$user_vip=$row[vip]=='1'	?	'&nbsp;&nbsp;<font color=\'#ff0000\'>(VIP)</font>'	:	'';
				?>
				  <tr bgcolor="#F1F2F4">
					<td height="25" align="center"><?=$row[username].$user_kind.$user_vip?></td>
					<td align="center"><?='<a href=\'../view.php?action=company&info='.urlencode($row[qyuser]).'\' target=\'_blank\'>'.$row[qyname].'</a>'?></td>
					<td align="center"><?=$row[info_sign]	?	'<font color=\'#6699cc\'>是</font>'	:	'<font color=\'#FF0000\'>否</font>'?></td>
					<td align="center"><?=date("Y-n-j",$row[regtime])?></td>
					<td align="center"><?=!$row[losetime]	?	'-'	:	($row[losetime]>time()	?	date("Y-n-j",$row[losetime])	:	'<font color=\'#ff0000\'>过期</font>')?></td>
					<td align="center"><?=$row[logins]?></td>
					<td align="center"><a href="user_manage.php?action=edit_com&info=<?=urlencode($row[username])?>">编辑</a></td>
					<td height="25" align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row[username]?>"></td>
				  </tr>
				<? }
			  ?>
			  <tr bgcolor="#ECEDF0">
				<td height="35" colspan="4" align="center" bgcolor="#ECEDF0"><? require "page_show.php";?></td>
				<td height="35" colspan="4" align="center" bgcolor="#CCCCCC"><table width="100%"  border="0" cellspacing="1" cellpadding="0">
                    <tr align="center" bgcolor="#FFFFFF">
                      <td height="30"><input name="com_checked" type="submit" class="input" id="com_checked" value="认证"></td>
                      <td colspan="2"><input name="com_uncheck" type="submit" class="input" id="com_uncheck" value="取消认证"></td>
                      <td height="30"><input name="com_delete" type="submit" class="input" id="com_delete" value="删除"></td>
                      </tr>
                    <tr align="center" bgcolor="#FFFFFF">
                      <td height="30" colspan="4">VIP 时限 &nbsp;:&nbsp;                        <input name="year" type="text" id="year" value="<?=date("Y")+1?>" size="4" maxlength="4">
                        年
                        <input name="month" type="text" id="month" value="<?=date("n")?>" size="2" maxlength="2">
                        月
                        <input name="day" type="text" id="day" value="<?=date("j")?>" size="2" maxlength="2">
                        日
                        <input name="type" type="hidden" id="type" value="<?=$type?>"> <input name="action" type="hidden" id="action" value="<?=$action?>">
                        <input name="user_manage" type="hidden" id="user_manage" value="1"></td>
                      </tr>
                    <tr align="center" bgcolor="#FFFFFF">
                      <td height="30" colspan="2"><input name="com_up" type="submit" class="input" id="com_up" value="升级 VIP "></td>
                      <td height="30" colspan="2"><input name="com_down" type="submit" class="input" id="com_down" value="降级 普通"></td>
                      </tr>
                                </table></td>
				</tr>
			</form>
			</table>
			<? }
			else if ($action=='per')
			{//	personal users list
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			<form action="user_manage.php" method="post">
			  <tr bgcolor="#ECEDF0">
				<td height="25" align="center">用户名</td>
				<td align="center">姓名</td>
				<td align="center">性别</td>
				<td align="center">生日</td>
				<td align="center">认证</td>
				<td align="center">VIP期限</td>
				<td align="center">登陆次数</td>
				<td align="center">注册时间</td>
				<td align="center">操作</td>
				<td height="25" align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <?
			  	$count="15";
			  	$str="$m.kind='$kind_mem'";
				if ($type=='vip')
				{
					$str.=" and $m.vip='1'";
					$str2="action=com&type=vip";
				}
				elseif ($type=='checked')
				{
					$str.=" and $m.info_sign='1'";
					$str2="action=com&type=checked";
				}
				elseif ($type=='uncheck')
				{
					$str.=" and $m.info_sign='0'";
					$str2="action=com&type=uncheck";
				}
				elseif ($type=='search')
				{
					if ($username!=''){$str.=" and $m.username like '".urldecode($username)."'";}else{$str=$str;}
					if ($vip!='-1'){$str.=" and $m.vip = '$vip'";}else{$str=$str;}
					if ($info_sign!='-1'){$str.=" and $m.info_sign = '$info_sign'";}else{$str=$str;}
					if ($truename!=''){$str.=" and $p.truename like '".urldecode($truename)."'";}else{$str=$str;}
					if ($sex!='0'){$str.=" and $p.sex = '".urldecode($sex)."'";}else{$str=$str;}
					if ($edu!='0'){$str.=" and $p.edu = '".urldecode($edu)."'";}else{$str=$str;}
					if ($mingzu!='0'){$str.=" and $p.mingzu = '".urldecode($mingzu)."'";}else{$str=$str;}
					if ($zhuanyename!='不限'){$str.=" and $p.zhuanyename like '".urldecode($zhuanyename)."'";}else{$str=$str;}
					$str2="action=per&type=search&username=".urlencode(urldecode($username))."&vip=$vip&info_sign=$info_sign&truename=".urlencode(urldecode($truename))."&sex=".urlencode(urldecode($sex))."&edu=".urlencode(urldecode($edu))."&mingzu=".urlencode(urldecode($mingzu))."&zhuanyename=".urlencode(urldecode($zhuanyename));
				}
				else
				{
					$str2="action=per";
				}
				$str.=" and $m.username=$p.username";
				$table="$m,$p";
				require 'page_count.php';
				$sql="select * from $table where $str order by $m.id desc limit $offset,$psize";
				$query=$db->query($sql);
				while ($row=$db->row($query))
				{
					$user_vip=$row[vip]=='1'	?	'&nbsp;&nbsp;<font color=\'#ff0000\'>(VIP)</font>'	:	'';
				?>
				  <tr bgcolor="#F1F2F4">
					<td height="25" align="center"><?=$row[username]?>
				    <?=$user_kind.$user_vip?></td>
					<td align="center"><?=$row[truename]?></td>
					<td align="center"><?=$row[sex]?></td>
					<td align="center"><?=$row[birth]?></td>
					<td align="center"><?=$row[info_sign]	?	'<font color=\'#6699cc\'>是</font>'	:	'<font color=\'#FF0000\'>否</font>'?></td>
					<td align="center"><?=!$row[losetime]	?	'-'	:	($row[losetime]>time()	?	date("Y-n-j",$row[losetime])	:	'<font color=\'#ff0000\'>过期</font>')?>					  </td>
					<td align="center"><?=$row[logins]?></td>
					<td align="center"><?=date("Y-n-j",$row[regtime])?></td>
					<td align="center"><a href="user_manage.php?action=edit_per&info=<?=urlencode($row[username])?>">编辑</a></td>
					<td height="25" align="center"><input name="delete[]" type="checkbox" id="delete[]" value="<?=$row[username]?>"></td>
				  </tr>
				<? }
			  ?>
			  <tr bgcolor="#ECEDF0">
				<td height="35" colspan="5" align="center"><? require "page_show.php";?></td>
				<td height="35" colspan="5" align="center"><table width="100%"  border="0" cellspacing="1" cellpadding="0">
                    <tr align="center" bgcolor="#FFFFFF">
                      <td height="30"><input name="per_checked" type="submit" class="input" id="per_checked" value="认证"></td>
                      <td colspan="2"><input name="per_uncheck" type="submit" class="input" id="per_uncheck" value="取消认证"></td>
                      <td height="30"><input name="per_delete" type="submit" class="input" id="per_delete" value="删除"></td>
                    </tr>
                    <tr align="center" bgcolor="#FFFFFF">
                      <td height="30" colspan="4">VIP 时限 &nbsp;:&nbsp;
                          <input name="year" type="text" id="year" value="<?=date("Y")+1?>" size="4" maxlength="4">
        年
        <input name="month" type="text" id="month" value="<?=date("n")?>" size="2" maxlength="2">
        月
        <input name="day" type="text" id="day" value="<?=date("j")?>" size="2" maxlength="2">
        日
        <input name="type" type="hidden" id="type" value="<?=$type?>">
        <input name="action" type="hidden" id="action" value="<?=$action?>">
        <input name="user_manage" type="hidden" id="user_manage" value="1"></td>
                    </tr>
                    <tr align="center" bgcolor="#FFFFFF">
                      <td height="30" colspan="2"><input name="per_up" type="submit" class="input" id="per_up" value="升级 VIP "></td>
                      <td height="30" colspan="2"><input name="per_down" type="submit" class="input" id="per_down" value="降级 普通"></td>
                    </tr>
                                </table></td>
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
