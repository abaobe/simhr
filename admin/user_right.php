<?php
	require "admin_globals.php";
	require "admin_check.php";
	function file_check($filename)
	{
		$return = !file_exists($filename)	?	'<font color=\'#ff0000\'> '.$filename.' 不存在</font>'	:	(!is_writable($filename)	?	'<font color=\'#ff0000\'> '.$filename.' 不可写,请通过FTP将文件属性设成 0777 可写的!</font>'	:	'<font color=\'#6699cc\'>成功</font>')	;
		return $return;
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
    <td align="center" valign="middle" background="images/main_bg.gif" bgcolor="#CCCCCC">
<?
	if ($saveright)
	{
		$rightinfo="<?php
	/*
	+-------------------------------------------
	|   Technology of SimPHP
	|   ========================================
	|   Powered by PHP365.CN
	|   (c) 2007 php365.cn Power Services
	|   http://www.php365.cn
	|   ========================================
	|   Web: http://www.php365.cn
	|   Last modify: ".date("Y/n/d H:i:s",time())."
	+-------------------------------------------
	*/
	\$RIGHT=array(

		//	control	part

		'register_sign'		=>	'".$register_sign."',			//	put info right to new registers

		'job_rec'			=>	'".$job_rec."',			//	job
		'job_send'			=>	'".$job_send."',			//	job
		'job_fav'			=>	'".$job_fav."',			//	job

		'hunter_rec'		=>	'".$hunter_rec."',			//	hunter
		'hunter_send'		=>	'".$hunter_send."',			//	hunter
		'hunter_fav'		=>	'".$hunter_fav."',			//	hunter

		'mail_friend'		=>	'".$mail_friend."',			//	mail to friend

		'put_job'			=>	'".$put_job."',			//	job
		'put_find'			=>	'".$put_find."',			//	job

		'put_hunter_job'	=>	'".$put_hunter_job."',			//	hunter
		'put_hunter_find'	=>	'".$put_hunter_find."',			//	hunter

		'put_teacher_job'	=>	'".$put_teacher_job."',			//	teacher
		'put_teacher_find'	=>	'".$put_teacher_find."',			//	teacher

		'put_school'		=>	'".$put_school."',			//	school
		'put_lesson'		=>	'".$put_lesson."',			//	lesson


		//	contact info hidden

		'personal'			=>	'".$personal."',			//	persona contact info
		'sid_card'			=>	'".$sid_card."',

		'company'			=>	'".$company."',			//	company contact info

		//	info check
		'sign_job'			=>	'".$sign_job."',			//	put job chance
		'sign_find'			=>	'".$sign_find."',			//	put find chance

		'sign_hunterjob'	=>	'".$sign_hunterjob."',			//	put hunter job chance
		'sign_hunterfind'	=>	'".$sign_hunterfind."',			//	put hunter find chance

		'sign_lesson'		=>	'".$sign_lesson."',			//	put lesson info
		'sign_school'		=>	'".$sign_school."',			//	put school info

		'sign_teacherjob'	=>	'".$sign_teacherjob."',			//	put teacher job
		'sign_teacherfind'	=>	'".$sign_teacherfind."',			//	put teacher find

		//	view info pages

		'page_job'			=>	'".$page_job."',			//	job info
		'page_find'			=>	'".$page_find."',			//	find info

		'page_hunterjob'	=>	'".$page_hunterjob."',			//	hunter job info
		'page_hunterfind'	=>	'".$page_hunterfind."',			//	hunter find info

		'page_lesson'		=>	'".$page_lesson."',			//	lesson info
		'page_school'		=>	'".$page_school."',			//	school info

		'page_teacher_job'	=>	'".$page_teacher_job."',			//	teacher job
		'page_teacher_find'	=>	'".$page_teacher_find."',			//	teacher find


	);
?>";

		$fp=fopen($rightfile,'w+')	;
		fwrite($fp,$rightinfo);

		echo refreshback('操作成功');
		echo showmsg('user_right.php','2');
		echo endhtml();
		echo wwwwanenet();
		exit;
	}
?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?type=1">游客</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?type=2">个人用户</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?type=3">企业用户</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?type=4">个人VIP</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?type=5">企业VIP</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?type=6">管理员</a></td>
      </tr>
      <tr>
        <td align="center">
		<?
			if ($type)
			{
				$right_file='../common/right/right'.$type.'.php';
				if (!is_writable($right_file)){echo clickback('Can not write to file.');exit;}
				file_exists($right_file)	?	require $right_file		:	'';
				unset($right_file);
				?>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
				<form action="user_right.php?right=<?=$type?>" method="post">
				  <tr align="left" bgcolor="#CCCCCC">
				    <td height="25" colspan="2" valign="middle"><table width="100%" height="30"  border="0" cellpadding="0" cellspacing="1">
                      <tr>
                        <td bgcolor="#F1F2F4">&nbsp;<strong><font color="#FF0000">检测文件</font></strong>&nbsp;:&nbsp;
                        <?=file_check('../common/right/right'.$type.'.php')?>
                        <input name="rightfile" type="hidden" id="rightfile" value="<?='../common/right/right'.$type.'.php'?>">
                        <input name="saveright" type="hidden" id="saveright" value="1"></td>
                      </tr>
                    </table></td>
			      </tr>
				  <tr bgcolor="#F1F2F4">
					<td width="84%" align="center" valign="top" bgcolor="#CCCCCC"><table width="100%" height="801"  border="0" cellpadding="0" cellspacing="1">
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;未验证 注册用户 是否 允许发布信息&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;收信息是否可用&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;发信箱是否可用&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;收藏夹是否可用&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;猎头收信箱是否可用&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;猎头发信箱是否可用&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;猎头收藏夹是否可用&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#FFFFFF">&nbsp;推荐给好友&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布招聘&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布求职&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布 猎头招聘 &nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布 猎头求职&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布 家教招聘&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布 家教求职&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许注册培训学校&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;是否允许发布培训信息&nbsp;(&nbsp;0=&gt;不允许 1=&gt;允许 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;个人用户联系资料是否显示&nbsp;(&nbsp;0=&gt;隐藏 1=&gt;显示 ) </td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;个人用户身份证是否显示&nbsp;(&nbsp;0=&gt;隐藏 1=&gt;显示 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;企业用户联系资料是否显示&nbsp;(&nbsp;0=&gt;隐藏 1=&gt;显示 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布招聘是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布求职是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布猎头职位是否要求验证&nbsp;&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布猎头人才是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布培训信息是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;注册培训学校是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布家教招聘是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#F1F2F4">&nbsp;发布家教求职是否要求验证&nbsp;(&nbsp;0=&gt;要求验证 1=&gt;不要求验证 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览招聘信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览求职信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览猎头招聘信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览猎头求职信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览培训信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览培训学校,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览家教招聘信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#ffffff">&nbsp;可浏览家教求职信息,单位(页)&nbsp;&nbsp;(&nbsp;-1=&gt;不限制 )</td>
                      </tr>
                    </table></td>
					<td width="16%" align="center" valign="top" bgcolor="#CCCCCC"><table cellspacing="1" border="0" cellpadding="0" width="100%">
                      <?
							foreach ($RIGHT as $key=>$val)
							{?>
                      <tr>
                        <td height="24" align="center" bgcolor="#FFFFFF"><input name="<?=$key?>" type="text" class="input" id="<?=$form_name?>" value="<?=$val?>" size="4"></td>
                      </tr>
                      <? }
						?>
                    </table></td>
				  </tr>
				  <tr valign="middle" bgcolor="#F1F2F4">
				    <td height="30" colspan="2" align="center"><input name="Submit" type="submit" class="input" value=" 提 交 修 改 "></td>
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
