<?php
	/*
	+-------------------------------------------
	|   Technology of SimPHP
	|   ========================================
	|   Powered by PHP365.CN
	|   (c) 2007 php365.cn Power Services
	|   http://www.php365.cn
	|   ========================================
	|   Web: http://www.php365.cn
	+-------------------------------------------
	|   > Last modify: 2004-12-31
	+-------------------------------------------
	*/
	require_once 'globals.php';
	if ($action=='showjob')
	{
		$info=$HTTP_GET_VARS['info'];
		$jt=JOBTABLE;
		$qj=QYJIANLITABLE;
		$table=$jt.','.$qj;
		if (adminlogined()<='0')	{$searchsign="and $jt.sign='1' and losetime >='".time()."'";}	else	{$searchsign='';}
		$sql="select $jt.*,$qj.qyuser,$qj.qyname from $table where $jt.id='$info' and $jt.username=$qj.qyuser $searchsign";
		$query=$db->query($sql);
		$num=$db->num($query);
		if ($num<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$headtitle=headtitle('数据查询失败');
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			tpl_load('showjob');
			$row=$db->row($query);
			if (adminlogined()<='0')
			{
				$db->query("update $jt set click=click+'1' where id='$info'");
			}
			$headtitle=headtitle($row['qyname'].' 招聘 '.$row['job']);
			$tpl->set_var(
				array(
					'INFOTITLE'		=>	'[<a href=view.php?action=company&info='.urlencode($row['qyuser']).' target=\'_blank\'>'.$row['qyname'].'</a>] 聘 '.$row['job'],
					'JOB'			=>	$row['job'],
					'COMPANY'		=>	$row['qyname'],
					'LINK'			=>	$info,
					'LINKCOM'		=>	urlencode($row['username']),
					'JOBMAN'		=>	(is_numeric($row[man]) && $row[man]>='1')	?	$row[man]		:	'不限',
					'JOBPRO'		=>	$row['job_pro'],
					'JOBTIME'		=>	$row['job_time'],
					'JOBAGE'		=>	$row['age'],
					'JOBSEX'		=>	$row['sex'],
					'JOBHEIGHT'		=>	$row['height'],
					'JOBWEIGHT'		=>	$row['weight'],
					'JOBSIGHT'		=>	$row['sight'],
					'JOBSOCIAL'		=>	$row['social'],
					'JOBSALARY'		=>	$row['money'],
					'JOBADDR'		=>	$row['address'],
					'JOBEDU'		=>	$row['edu'],
					'JOBENG'		=>	$row['eng'],
					'JOBDEPART'		=>	$row['department'],
					'JOBCONTEXT'	=>	wane_text($row['worktext']),
					'ADDTIME'		=>	date("Y-n-j",$row['puttime']),
					'LOSETIME'		=>	$row[losetime]>time()	?	date("Y-n-j",$row[losetime])	:	'<font color=\'#ff0000\'>过期</font>',
					'CLICK'			=>	$row['click'],
				)
			);
		}
	}
	//END JOB
	else if ($action=='showfind')
	{
		$info=$HTTP_GET_VARS['info'];
		$ft=FINDJOBTABLE;
		$pj=JIANLITABLE;
		$table=$ft.','.$pj;
		if (adminlogined()<='0')	{$searchsign="and $ft.sign='1' and losetime >='".time()."'";}	else	{$searchsign='';}
		$sql="select $ft.*,$pj.username,$pj.truename,$pj.sex,$pj.birth,$pj.mingzu,$pj.edu,$pj.engname,$pj.engnengli,$pj.zhuanye,$pj.zhuanyename,$pj.phone,$pj.handphone,$pj.email,$pj.homepage from $table where $ft.id='$info' and $ft.username=$pj.username $searchsign";
		$query=$db->query($sql);
		$num=$db->num($query);
		if ($num<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$headtitle=headtitle('数据查询失败');
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			tpl_load('showfind');
			$row=$db->row($query);
			if (adminlogined()<='0')
			{
				$db->query("update $ft set click=click+'1' where id='$info'");
			}
			$headtitle=headtitle($row['truename'].' 求 '.$row['job']);
			$tpl->set_var(
				array(
					'INFOTITLE'		=>	'[<a href=view.php?action=personal&info='.urlencode($row['username']).' target=\'_blank\'>'.$row['truename'].'</a>] 求 '.$row['job'],
					'JOB'			=>	$row['job'],
					'TRUENAME'		=>	$row['truename'],
					'JLLINK'		=>	urlencode($row['username']),
					'LINK'			=>	$info,
					'WORK_ADDRESS'	=>	$row['work_address'],
					'SEX'			=>	$row['sex'],
					'BIRTH'			=>	$row['birth'],
					'MINZU'			=>	$row['mingzu'],
					'EDU'			=>	$row['edu'],
					'ENG_NENGLI'	=>	$row['engname'].' &nbsp;&nbsp; '.$row['engnengli'],
					'ZHUANYE'		=>	$row['zhuanye'],
					'ZHUANYENAME'	=>	$row['zhuanyename'],
					'PHONE'			=>	$RIGHT[personal]	?	$row['phone']	:	$lang_right[2],
					'HANDPHONE'		=>	$RIGHT[personal]	?	$row['handphone']	:	$lang_right[2],
					'EMAIL'			=>	$RIGHT[personal]	?	$row['email']	:	$lang_right[2],
					'HOMEPAGE'		=>	$RIGHT[personal]	?	$row['homepage']	:	$lang_right[2],
					'JOBTEXT'		=>	wane_text($row['jobtext']),
					'ADDTIME'		=>	date("Y-n-j",$row['puttime']),
					'LOSETIME'		=>	$row[losetime]>time()	?	date("Y-n-j",$row[losetime])	:	'<font color=\'#ff0000\'>过期</font>',
					'CLICK'			=>	$row['click'],
				)
			);
		}
	}
	else if ($action=='school')
	{
		if ($user_cfg['kind']==$kind_admin)
		{
			$sqlcut=" and sign='1'";
		}
		else
		{
			$sqlcut="";
		}
		$sql="select * from {$tablepre}pxschool where username='".urldecode($info)."'";
		$query=$db->query($sql);
		$num=$db->num($query);
		if ($num<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$headtitle=headtitle('数据查询失败');
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			tpl_load('view_school');
			$row=$db->row($query);
			$headtitle=headtitle($row[sname]);
			if ($wane_user!=$row['username'])
			{
				$db->query("UPDATE {$tablepre}pxschool SET click=click+'1' where id='$info'");
			}
			$tpl->set_var(
				array(
					'WEBTITLE'	=>	headtitle($row['sname']),
					'SNAME'		=>	$row['sname'],
					'SCHKIND'	=>	$row['schkind'],
					'CONTEXT'	=>	wane_text($row['context']),
					'CONTENT'	=>	wane_text($row['content']),
					'SIGN_CONTENT'	=>	wane_text($row['sign_content']),
					'CONTACT'	=>	$RIGHT[company]	?	$row['contact_name']	:	$lang_right[2],
					'PHONE'		=>	$RIGHT[company]	?	$row['contact_phone']	:	$lang_right[2],
					'FAX'		=>	$RIGHT[company]	?	$row['fax']	:	$lang_right[2],
					'ADDRESS'	=>	$RIGHT[company]	?	$row['address']	:	$lang_right[2],
					'CODE'		=>	$RIGHT[company]	?	$row['code']	:	$lang_right[2],
					'EMAIL'		=>	$RIGHT[company]	?	$row['email']	:	$lang_right[2],
					'URL'		=>	$RIGHT[company]	?	$row['url']	:	$lang_right[2],
					'CLICK'		=>	$row['click']
				)
			);
		}
	}
	else if ($action=='lesson')
	{
		if (empty($info) || !is_numeric($info))
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$headtitle=headtitle('数据查询失败');
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			$s=$tablepre.'pxschool';
			$k=$tablepre.'job_peixunkind';
			$l=$tablepre.'job_peixun';
			$table=$s.','.$k.','.$l;
			$sstr="$s.sname,$s.username,$k.id ,$k.title,$l.*";
			$str=($user_cfg[kind]==$kind_admin)?"":"$l.sign='1' and $l.losetime >= '".time()."' and ";
			$str.="$l.leixing=$k.id and $l.username=$s.username and $l.id='$info'";
			$sql="select $sstr from $table where $str";
			unset($s,$k,$table,$sstr,$str);
			$query=$db->query($sql);
			unset($sql);
			if (!$db->num($query))
			{
				tpl_load('result');
				$result_title='数据查询失败';
				$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
				$headtitle=headtitle('数据查询失败');
				$tpl->set_var(
					array(
						'RESULT_TITLE'	=>	$result_title,
						'RESULT_INFO'	=>	$result_info,
					)
				);
				echo showmsg('javascript:window.close()','3');
			}
			else
			{
				tpl_load('view_lesson');
				$db->query("UPDATE $l set click=click+'1' where id='$info'");
				unset($l,$info);
				$row=$db->row($query);
				//$lessonfile=$htmlroot.$dirhtml_lesson.'/'.$row[htmlroot].'/'.md5($row[username]).'.html';
				$headtitle=headtitle($row[lesson]);
				$tpl->set_var(
					array(
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
						'CONTACT'	=>	$RIGHT[company]	?	$row[contact_name]	:	$lang_right[2],
						'PHONE'	=>	$RIGHT[company]	?	$row[contact_phone]	:	$lang_right[2],
						'EMAIL'	=>	$RIGHT[company]	?	$row[email]	:	$lang_right[2],
						'FAX'	=>	$RIGHT[company]	?	$row[fax]	:	$lang_right[2],
						'URL'	=>	$RIGHT[company]	?	$row[url]	:	$lang_right[2],
						'DIREACTION'	=>	wane_text($row[direction]),
						'CONTENT'	=>	wane_text($row[content]),
						'CONTEXT'	=>	wane_text($row[context]),
						//'SCHOOLLINK'	=>	(!file_exists($lessonfile))	?	'../../../'.$lessonfile	:	'../../../view.php?action=school&info='.md5($row['username'])
					)
				);
			}
		}
	}
	else if ($action=='teacherjob')
	{
		if ($user_cfg[kind]==$kind_admin)
		{
			$sql_cut="id='$info'";
		}
		else
		{
			$sql_cut="id='$info' and losetime >='".time()."' and sign='1'";
		}
		$sql="select * from {$tablepre}teacher_job where $sql_cut";
		$query=$db->query($sql);
		if ($db->num($query)<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$headtitle=headtitle('数据查询失败');
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			$row=$db->row($query);
			if ($row[username]!=$wane_user  || $user_cfg[kind]!=$kind_admin)	{$db->query("UPDATE {$tablepre}teacher_job SET click=click+'1' WHERE id='$info'");}
			tpl_load('view_teacherjob');
			$headtitle=headtitle($row['title']);
			$tpl->set_var(
				array(
					'TITLE'		=>	$row[title],
					'SEX'		=>	$row[sex],
					'EDU'		=>	$row[edu],
					'ADDRESS'	=>	$row[address],
					'DEPART'	=>	$row[depart],
					'CONTENT'	=>	wane_text($row[content]),
					'CONTEXT'	=>	wane_text($row[context]),
					'CONTACT'	=>	$RIGHT[personal]	?	$row[contact_name]	:	$lang_right[2],
					'PHONE'		=>	$RIGHT[personal]	?	$row[contact_phone]	:	$lang_right[2],
					'EMAIL'		=>	$RIGHT[personal]	?	$row[email]	:	$lang_right[2],
					'ADDTIME'	=>	date($time_putteacher,$row[puttime]),
					'LOSETIME'	=>	date($time_putteacher,$row[losetime]),
					'CLICK'		=>	$row[click],
				)
			);
		}
	}
	else if ($action=='teacherfind')
	{
		if ($user_cfg[kind]==$kind_admin)
		{
			$sql_cut="id='$info'";
		}
		else
		{
			$sql_cut="id='$info' and losetime >='".time()."' and sign='1'";
		}
		$sql="select * from {$tablepre}teacher_find where $sql_cut";
		$query=$db->query($sql);
		if ($db->num($query)<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$headtitle=headtitle('数据查询失败');
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			$row=$db->row($query);
			if ($row[username]!=$wane_user  || $user_cfg[kind]!=$kind_admin)	{$db->query("UPDATE {$tablepre}teacher_find SET click=click+'1' WHERE id='$info'");}
			tpl_load('view_teacherfind');
			$headtitle=headtitle($row['title']);
			$tpl->set_var(
				array(
					'TITLE'		=>	$row[title],
					'TRUENAME'		=>	$row[truename],
					'SEX'		=>	$row[sex],
					'EDU'		=>	$row[edu],
					'DEPART'	=>	$row[depart],
					'LIVING'	=>	$row[living],
					'WORK'	=>	wane_text($row[job]),
					'CONTEXT'	=>	wane_text($row[context]),

					'PHONE'		=>	$RIGHT[personal]	?	$row[phone]	:	$lang_right[2],
					'EMAIL'		=>	$RIGHT[personal]	?	$row[email]	:	$lang_right[2],

					'ADDTIME'	=>	date($time_putteacher,$row[puttime]),
					'LOSETIME'	=>	date($time_putteacher,$row[losetime]),
					'CLICK'		=>	$row[click],
				)
			);
		}
	}
	//+---------------------------------------
	//+	begin show jianli (personal & company)	------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
	//+---------------------------------------
	else if ($action=='company')
	{
		$info=$HTTP_GET_VARS['info'];
		$sql=$db->query("select * from ".QYJIANLITABLE." where qyuser='$info'");
		$num=$db->num($sql);
		if ($num<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$headtitle=headtitle('数据查询失败');
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			$row=$db->row($sql);
			tpl_load('company_jianli');
			$headtitle=headtitle('['.$row['qyname'].']   企业简历');
			if ($wane_user!=$info)
			{
				$db->query("UPDATE ".QYJIANLITABLE." SET clicked=clicked+'1' where qyuser='$info'");
			}
			$tpl->set_var(
				array(
					'CLICK'			=>	$row['clicked'],
					'CONTENT_TITLE'	=>	'[ <font color=ff0000>'.$row['qyname'].'</font> ]  企业简历',
					'QYNAME'		=>	$row['qyname'],
					'QYADDR'		=>	$row['qyaddress'],
					'QYPRO'			=>	$row['qypro'],
					'QYKIND'		=>	$row['qykind'],
					'QYGM'			=>	$row['qyman'],
					'QYLEADER'		=>	$RIGHT[company]	?	$row['contact_name']	:	$lang_right[2],
					'QYPHONE'		=>	$RIGHT[company]	?	$row['qyphone']	:	$lang_right[2],
					'QYMAIL'		=>	$RIGHT[company]	?	$row['qyemail']	:	$lang_right[2],
					'QYYOUBIAN'		=>	$RIGHT[company]	?	$row['qyyoubian']	:	$lang_right[2],
					'QYURL'			=>	$RIGHT[company]	?	$row['qyweb']	:	$lang_right[2],
					'QYTEXT'		=>	wane_text($row['qyjianjie']),
				)
			);
			$uploaded_img=$row['qy_img'];
			if ($uploaded_img!='' && file_exists($uploaded_img))
			{$tpl->set_var('UPLOADED_IMG','<a href='.$uploaded_img.' target=\'_blank\'><img src='.$uploaded_img.' width=\'200\' height=\'100\' border=\'0\' class=\'input\'></a>');}
			else
			{$tpl->set_var('UPLOADED_IMG','<font color=ff0000>尚未上传企业标志</font>');}
		}
	}//+	end company jianil
	else if ($action=='personal')
	{
		$info=$HTTP_GET_VARS['info'];
		$sql=$db->query("select * from ".JIANLITABLE." where username='$info'");
		$num=$db->num($sql);
		if ($num<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$headtitle=headtitle('数据查询失败');
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
		}
		else
		{
			$row=$db->row($sql);
			tpl_load('personal_jianli');
			$headtitle=headtitle('['.$row['truename'].']  个人简历');
			if ($wane_user!=$info)
			{
				$db->query("UPDATE ".JIANLITABLE." SET clicked=clicked+'1' where username='$info'");
			}
			$sfz=$row['shengfengzhen'];
			$tpl->set_var(
				array(
					'CLICK'			=>	$row['clicked'],
					'CONTENT_TITLE'	=>	'[ <font color=ff0000>'.$row['truename'].'</font> ]  个人简历',
					'TRUENAME'		=>	$row['truename'],
					'SEX'			=>	$row['sex'],
					'MINZU'			=>	$row['mingzu'],
					'BIRTH'			=>	$row['birth'],
					'HUKOU'			=>	$row['hukou'],
					'JUZHUDI'		=>	$row['juzhudi'],
					'SHENGFENGZHEN'	=>	!$RIGHT[sid_card]	?	$lang_right[2]	:((strlen($sfz)=='15')	?	wane_str($sfz,0,14)	:	((strlen($sfz)=='18')	?	wane_str($sfz,0,17)	:	'不正确')),

					'MARRY'			=>	$row['marry'],
					'SOCIAL'		=>	$row['social'],

					'HEIGHT'		=>	$row['height'],
					'WEIGHT'		=>	$row['weight'],
					'SIGHT'			=>	$row['ear'],
					'JOBTONOW'		=>	$row['jobtoknow'],
					'SALARY'		=>	$row['money'],
					'EDU'			=>	$row['edu'],
					'GRAEDU'		=>	$row['graedu'],
					'GRAEDUTIME'	=>	$row['graedutime'],
					'ZHUANYE'		=>	$row['zhuanye'],
					'ZHUANYENAME'	=>	$row['zhuanyename'],

					'PHONE'			=>	$RIGHT[personal]	?	$row['phone']	:	$lang_right[2],
					'COMPHONE'		=>	$RIGHT[personal]	?	$row['comphone']	:	$lang_right[2],
					'HANDPHONE'		=>	$RIGHT[personal]	?	$row['handphone']	:	$lang_right[2],
					'EMAIL'			=>	$RIGHT[personal]	?	$row['email']	:	$lang_right[2],
					'QQ'			=>	$RIGHT[personal]	?	$row['qq']	:	$lang_right[2],
					'HOMEPAGE'		=>	$RIGHT[personal]	?	$row['homepage']	:	$lang_right[2],
					'ADDRESS'		=>	$RIGHT[personal]	?	$row['address']	:	$lang_right[2],
					'YOUBIAN'		=>	$RIGHT[personal]	?	$row['youbian']	:	$lang_right[2],

					'JOBPRO'		=>	$row['jobpro'],
					'FORMONEY'		=>	$row['formoney'],
					'FORHY'			=>	$row['forjob'],
					'FORPOS'		=>	$row['jobkind'],
					'COMPRO'		=>	$row['compro'],
					'WORKADDR'		=>	$row['jobaddress'],
					'FORHOUSE'		=>	$row['forhouse'],
					'LEAVEJOB'		=>	$row['leavejobtime'],

					'ENGNAME'		=>	$row['engname'],
					'ENGNENGLI'		=>	$row['engnengli'],
					'WORKJINGLI'	=>	wane_text($row['workjingli']),
					'EDUJINGLI'		=>	wane_text($row['edujingli']),
					'ZHENSHU'		=>	wane_text($row['zhengshu']),
					'ITABLE'		=>	wane_text($row['itable']),
					'TECHANG'		=>	wane_text($row['techang']),
					'PINGJIA'		=>	wane_text($row['pingjia']),
					'JIANGLI'		=>	wane_text($row['jiangli']),
					'SHIJIANNAME'	=>	$row['shijianname'],
					'SHIJIANTIME'	=>	$row['shijiankind'],
					'SHIJIANTEXT'	=>	wane_text($row['shijianjianjie']),
				)
			);
			$uploaded_img=$row['mem_img'];
			if ($uploaded_img!='' && file_exists($uploaded_img))
			{$tpl->set_var('UPLOADED_IMG','<a href='.$uploaded_img.' target=\'_blank\'><img src='.$uploaded_img.' width=\'250\' height=\'200\' border=\'0\' class=\'input\'></a>');}
			else
			{$tpl->set_var('UPLOADED_IMG','<font color=ff0000>尚未上传个人照片</font>');}

		}
	}//+	end personal jianli
	//+-----------------------------------------------------------
	//+	begin sendinfo (personal to company & company to personal)	----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
	//+-----------------------------------------------------------
	else if ($action=='sendjob')
	{// personal send job info to company
		if (perlogined()<='0')
		{
			$headtitle=headtitle('个人用户登陆');
			$unlogined_info='个人用户登陆';
			require 'common/unlogined.php';
		}
		else if ($save_sendjob)
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[job_send])	{echo clickback($lang_right[1]);exit;}
			if ($title=='' || $context=='')	{echo clickback('标题和内容不能为空');exit;}
			else
			{
				$sql="INSERT INTO ".PERSENDTABLE." (user_id,com_id,job_id,title,context,addtime) values ('$wane_user','$recer','$jobid','".html($title)."','".html($context)."','".time()."')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('操作失败');exit;}
				else
				{
					$htmllink=linkurl($tablepre.'job_chance',$jobid,'job');
					tpl_load('result');
					$result_title='操作成功';
					$headtitle=headtitle('操作成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
			}
		}
		else
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[job_send])	{echo clickback($lang_right[1]);exit;}
			$sendjob_time=time()-$sendfind_time*3600;
			$jt=JOBTABLE;
			$qj=QYJIANLITABLE;
			$info=$HTTP_GET_VARS['info'];
			$sql="SELECT $jt.id,$jt.username,$jt.job,$qj.qyuser,$qj.qyname from $jt,$qj where $jt.username=$qj.qyuser and $jt.id='$info'";
			$row=$db->row($db->query($sql));
			if ($db->num($db->query("select user_id,com_id,job_id,addtime from ".PERSENDTABLE." where user_id='$wane_user' and com_id='".$row['qyuser']."' and job_id='$info' and addtime>='$sendjob_time' "))<='0')
			{
				tpl_load('view_sendjob');
				$headtitle=headtitle('发表求职请求');
				$tpl->set_var(
					array(
						'JOB'		=>	$row['job'],
						'COMPANY'	=>	$row['qyname'],
						'COMLINK'	=>	urlencode($row['qyuser']),
						'JOBID'		=>	$info,
						'RECER'		=>	$row['qyuser'],
						'ACTIONINFO'=>	'action=sendjob',
					)
				);
			}
			else
			{
					$htmllink=linkurl($tablepre.'job_chance',$info,'job');
					tpl_load('result');
					$result_title='发表求职请求';
					$headtitle=headtitle('发表求职请求');
					$result_info='很抱歉 '.$wane_user.' ! <BR><BR>在 <font color=\'#ff0000\'><b>'.$sendfind_time.'</b></font> 小时以内请不要重复发送求职请求,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
			}
		}
	}
	else if ($action=='sendfind')
	{//+ company send find info to personal
		if (comlogined()<='0')
		{
			$headtitle=headtitle('企业用户登陆');
			$unlogined_info='企业用户登陆';
			require 'common/unlogined.php';
		}
		else if ($sendfind)
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[job_send])	{echo clickback($lang_right[1]);exit;}
			if ($title=='' || $context=='')	{echo clickback('标题和内容不能为空');exit;}
			else
			{
				$sql="INSERT INTO ".PERRECTABLE." (user_id,per_id,find_id,title,context,addtime) values ('$wane_user','$recer','$findid','".html($title)."','".html($context)."','".time()."')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('操作失败');exit;}
				else
				{
					$htmllink=linkurl($tablepre.'findjob_chance',$findid,'find');
					tpl_load('result');
					$result_title='操作成功';
					$headtitle=headtitle('操作成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>你成功执行了你的操作,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
			}
		}
		else
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[job_send])	{echo clickback($lang_right[1]);exit;}
			$sendfind_time=time()-$sendjob_time*3600;
			$ft=FINDJOBTABLE;
			$pj=JIANLITABLE;
			$info=$HTTP_GET_VARS['info'];
			$sql="SELECT $ft.id,$ft.username,$ft.job,$pj.username,$pj.truename from $ft,$pj where $ft.username=$pj.username and $ft.id='$info'";
			$row=$db->row($db->query($sql));
			if ($db->num($db->query("select user_id,per_id,find_id,addtime from ".PERRECTABLE." where user_id='$wane_user' and per_id='".$row['username']."' and find_id='$info' and addtime>='$sendfind_time' "))<='0')
			{
				tpl_load('view_sendfind');
				$headtitle=headtitle('发表招聘请求');
				$tpl->set_var(
					array(
						'JOB'		=>	$row['job'],
						'PERSONAL'	=>	$row['truename'],
						'PERLINK'	=>	urlencode($row['username']),
						'FINDID'	=>	$info,
						'RECER'		=>	$row['username'],
						'ACTIONINFO'=>	'action=sendfind',
					)
				);
			}
			else
			{
				//+ 判断是否为静态文件或静态文件是否存在
				$htmllink=linkurl($tablepre.'findjob_chance',$info,'find');
				//+ 判断是否为静态文件或静态文件是否存在
				tpl_load('result');
				$result_title='发表招聘请示';
				$headtitle=headtitle('发表招聘请示');
				$result_info='很抱歉 '.$wane_user.' ! <BR><BR>在 <font color=\'#ff0000\'><b>'.$sendjob_time.'</b></font> 小时内请不要重复发送招聘请求,系统将 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
				$tpl->set_var(
					array(
						'RESULT_TITLE'	=>	$result_title,
						'RESULT_INFO'	=>	$result_info,
					)
				);
				echo showmsg($htmllink,'3');
			}
		}
	}
	else if ($action=='send_hunterjob')
	{//+	personal send info to company
		if (perlogined()<='0')
		{
			$headtitle=headtitle('个人用户登陆');
			$unlogined_info='个 人 用 户 登 陆';
			require 'common/unlogined.php';
		}
		else if ($save_sendjob)
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[hunter_send])	{echo clickback($lang_right[1]);exit;}
			if ($title=='' || $context=='')	{echo clickback('标题和内容不能为空');exit;}
			else
			{
				$table=$tablepre.'send_hunter_com';
				$sql="INSERT INTO $table (job_id,rec,send,author,title,context,addtime) values ('$jobid','$recer','$wane_user','$wane_user','".html($title)."','".html($context)."','".time()."')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('操作失败');exit;}
				else
				{
					$htmllink='javascript:history.go(-2)';
					tpl_load('result');
					$result_title='操作成功';
					$headtitle=headtitle('操作成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
			}
		}
		else
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[hunter_send])	{echo clickback($lang_right[1]);exit;}
			$sendhunterjob_time=time()-$sendhunterfind_time*3600;
			$jt=$tablepre.'hunter_com';
			$qj=QYJIANLITABLE;
			$sql="SELECT $jt.id,$jt.username,$jt.job,$qj.qyuser,$qj.qyname from $jt,$qj where $jt.username=$qj.qyuser and $jt.id='$info'";
			$row=$db->row($db->query($sql));
			if ($db->num($db->query("select rec,send,job_id,addtime from {$tablepre}send_hunter_com where rec='$row[qyuser]' and send='$wane_user' and job_id='$info' and addtime>='$sendhunterjob_time' "))<='0')
			{
				tpl_load('view_sendjob');
				$headtitle=headtitle('发表求职请求');
				$tpl->set_var(
					array(
						'JOB'		=>	$row['job'],
						'COMPANY'	=>	$row['qyname'],
						'COMLINK'	=>	urlencode($row['qyuser']),
						'JOBID'		=>	$info,
						'RECER'		=>	$row['qyuser'],
						'ACTIONINFO'=>	'action=send_hunterjob',
					)
				);
			}
			else
			{
					$htmllink='javascript:history.go(-1)';
					tpl_load('result');
					$result_title='发表求职请求';
					$headtitle=headtitle('发表求职请求');
					$result_info='很抱歉 '.$wane_user.' ! <BR><BR>在 <font color=\'#ff0000\'><b>'.$sendhunterfind_time.'</b></font> 小时以内请不要重复发送求职请求,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
			}
		}
	}
	else if ($action=='send_hunterfind')
	{//+	company send info to personal
		if (comlogined()<='0')
		{
			$headtitle=headtitle('企业用户登陆');
			$unlogined_info='企 业 用 户 登 陆';
			require 'common/unlogined.php';
		}
		else if ($sendfind)
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[hunter_send])	{echo clickback($lang_right[1]);exit;}
			if ($title=='' || $context=='')	{echo clickback('标题和内容不能为空');exit;}
			else
			{
				$table=$tablepre.'send_hunter_per';
				$sql="INSERT INTO $table (find_id,rec,send,author,title,context,addtime) values ('$findid','$recer','$wane_user','$wane_user','".html($title)."','".html($context)."','".time()."')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('操作失败');exit;}
				else
				{
					$htmllink='javascript:history.go(-2)';
					tpl_load('result');
					$result_title='操作成功';
					$headtitle=headtitle('操作成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>你成功执行了你的操作,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
			}
		}
		else
		{
			if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
			if (!$RIGHT[hunter_send])	{echo clickback($lang_right[1]);exit;}
			$sendhunterfind_time=time()-$sendhunterjob_time*3600;
			$ft=$tablepre.'hunter_per';
			$pj=JIANLITABLE;
			$info=$HTTP_GET_VARS['info'];
			$sql="SELECT $ft.id,$ft.username,$ft.for_position,$pj.username,$pj.truename from $ft,$pj where $ft.username=$pj.username and $ft.id='$info'";
			$row=$db->row($db->query($sql));
			if ($db->num($db->query("select rec,send,find_id,addtime from {$tablepre}send_hunter_per where rec='$row[username]' and send='$wane_user' and find_id='$info' and addtime>='$sendhunterfind_time' "))<='0')
			{
				tpl_load('view_sendfind');
				$headtitle=headtitle('发表招聘请求');
				$tpl->set_var(
					array(
						'JOB'		=>	$row['for_position'],
						'PERSONAL'	=>	$row['truename'],
						'PERLINK'	=>	urlencode($row['username']),
						'FINDID'	=>	$info,
						'RECER'		=>	$row['username'],
						'ACTIONINFO'=>	'action=send_hunterfind',
					)
				);
			}
			else
			{
				//+ 判断是否为静态文件或静态文件是否存在
				$htmllink='javascript:history.go(-1)';
				//+ 判断是否为静态文件或静态文件是否存在
				tpl_load('result');
				$result_title='发表招聘请示';
				$headtitle=headtitle('发表招聘请示');
				$result_info='很抱歉 '.$wane_user.' ! <BR><BR>在 <font color=\'#ff0000\'><b>'.$sendhunterjob_time.'</b></font> 小时内请不要重复发送招聘请求,系统将 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
				$tpl->set_var(
					array(
						'RESULT_TITLE'	=>	$result_title,
						'RESULT_INFO'	=>	$result_info,
					)
				);
				echo showmsg($htmllink,'3');
			}
		}
	}
	//+-----------------------------------
	//+	begin show reciver box or send box	----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
	//+-----------------------------------
	else if ($action=='prec_csend')
	{//	personal->reciver & company->send
		if (userlogined()<='0')
		{
			$headtitle=headtitle('会员登陆');
			$unlogined_info='会员登陆';
			require 'common/unlogined.php';
		}
		elseif ($save_remail)
		{
			if ($remailinfo=='')	{echo clickback('资源指定无效');exit;}
			else if ($title=='' || $context=='')	{echo clickback('回复标题不能为空');exit;}
			else
			{
				$table=$tablepre.'send_hunter_per';
				$query=$db->query("insert into $table (info_id,author,title,context,addtime) values ('$remailinfo','$wane_user','".html($title)."','".html($context)."','".time()."')");
				if (!$query)	{echo clickback('回复失败');exit;}
				else
				{
					tpl_load('result');
					$db->query("UPDATE $table SET replies=replies+'1' where id='$remailinfo'");
					$result_title='回 复 成 功';
					$headtitle=headtitle('回复成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功回复了本条信息,系统将于 3 秒后自动返回<BR><BR><a href=view.php?action=prec_csend&info='.$remailinfo.'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg('view.php?action=prec_csend&info='.$remailinfo,'3');
				}
			}
		}
		else
		{
			if ($info=='')	{echo clickback('资源定位不正确');exit;}
			$headtitle=headtitle('信件详情');
			tpl_load('view_sendinfo');
			$table=$tablepre.'send_hunter_per';
			$count='8';
			$str="id='$info' or info_id='$info'";
			$str2='action=prec_csend&info='.$info;
			require 'common/page_count.php';
			$sql="select * from $table where $str order by id limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			$inid='0';
			while ($row=$db->row($query))
			{
				if ($row[id]==$info && $row[rec]!=$wane_user && $row[send]!=$wane_user){echo clickback('您无权限查看');exit;}
				if (!$row[isnew] && $row[rec]==$wane_user && $row[id]==$info)	{$db->query("UPDATE $table set isnew='1' where id='$row[id]'");}
				$inid=++$inid;
				$iid=$inid;
				$tbgcolor=$iid%2	?	'#f8f8f8'	:	''	;
				$tpl->set_var(
					array(
						'TABLECOLOR'	=>	$tbgcolor,
						'AUTHOR'		=>	$row[author],
						'TITLE'			=>	$row[title],
						'CONTEXT'		=>	wane_text($row['context']),
						'ADDTIME'		=>	date("Y-m-d H:i",$row['addtime']),
					)
				);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
			$tpl->set_var(
				array(
					'REMAILINFO'	=>	$info,
					'ACTIONINFO'	=>	$str2,
				)
			);
		}
	}
	else if ($action=='psend_crec')
	{//	personal->send & company->reciver
		if (userlogined()<='0')
		{
			$headtitle=headtitle('会员登陆');
			$unlogined_info='会员登陆';
			require 'common/unlogined.php';
		}
		else if ($save_remail)
		{
			if ($remailinfo=='')	{echo clickback('资源指定无效');exit;}
			else if ($title=='' || $context=='')	{echo clickback('回复标题不能为空');exit;}
			else
			{
				$table=$tablepre.'send_hunter_com';
				$query=$db->query("insert into $table (info_id,author,title,context,addtime) values ('$remailinfo','$wane_user','".html($title)."','".html($context)."','".time()."')");
				if (!$query)	{echo clickback('回复失败');exit;}
				else
				{
					tpl_load('result');
					$db->query("update $table set replies=replies+'1' where id='$remailinfo'");
					$result_title='回 复 成 功';
					$headtitle=headtitle('回复成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功回复了本条求职信息,系统将于 3 秒后自动返回<BR><BR><a href=view.php?action=psend_crec&info='.$remailinfo.'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg('view.php?action=psend_crec&info='.$remailinfo,'3');
				}
			}
		}
		else
		{
			tpl_load('view_reciverinfo');
			$headtitle=headtitle('信件详细信息');
			$count='8';
			$table=$tablepre.'send_hunter_com';
			$str="id='$info' or info_id='$info'";
			$str2='action=psend_crec&info='.$info;
			require 'common/page_count.php';
			$sql="select * from $table where $str order by id limit $offset,$psize";
			$query=$db->query($sql);
			unset($count,$str,$sql);
			$tpl->set_block('main','list','lists');
			$inid='0';
			while ($row=$db->row($query))
			{
				if ($row[id]==$info && $row[rec]!=$wane_user && $row[send]!=$wane_user )	{echo clickback('您无权限查看此页');exit;}
				if (!$row[isnew] && $row[rec]==$wane_user && $row[id]==$info)	{$db->query("UPDATE $table set isnew='1' where id='$row[id]'");}
				$inid=++$inid;
				$iid=$inid;
				$tbgcolor=$iid%2=='0'	?	''	:	'#f8f8f8';
				$tpl->set_var(
					array(
						'TABLECOLOR'	=>	$tbgcolor,
						'AUTHOR'		=>	$row[author],
						'ADDTIME'		=>	date("Y-m-d H:i",$row['addtime']),
						'TITLE'			=>	$row['title'],
						'CONTEXT'		=>	wane_text($row['context']),
					)
				);
				unset($row,$tbgcolor);
				$tpl->parse('lists','list',true);
			}
			$tpl->set_var(
				array(
					'REMAILINFO'	=>	$info,
					'ACTIONINFO'	=>	$str2,
				)
			);
			unset($table);
			$db->free_result($query);
			require 'common/page_show.php';
		}
	}
	// company reciver or personal send

	else if ($action=='reciverinfo')// company reciver or personal send
	{
		if (userlogined()<='0')
		{
			$headtitle=headtitle('会员登陆');
			$unlogined_info='会员登陆';
			require 'common/unlogined.php';
		}
		else if ($save_remail)
		{
			if ($remailinfo=='')	{echo clickback('资源指定无效');exit;}
			else if ($title=='' || $context=='')	{echo clickback('回复标题不能为空');exit;}
			else
			{
				$query=$db->query("insert into {$tablepre}per_send (info_id,author,title,context,addtime) values ('$remailinfo','$wane_user','".html($title)."','".html($context)."','".time()."')");
				if (!$query)	{echo clickback('回复失败');exit;}
				else
				{
					tpl_load('result');
					$db->query("update {$tablepre}per_send set replies=replies+'1' where id='$remailinfo'");
					$result_title='回 复 成 功';
					$headtitle=headtitle('回复成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功回复了本条求职信息,系统将于 3 秒后自动返回<BR><BR><a href=view.php?action=reciverinfo&info='.$remailinfo.'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg('view.php?action=reciverinfo&info='.$remailinfo,'3');
				}
			}
		}
		else
		{
			tpl_load('view_reciverinfo');
			$headtitle=headtitle('信件详细信息');
			$count='8';
			$table=$tablepre.'per_send';
			$str="id='$info' or info_id='$info'";
			$str2='action=reciverinfo&info='.$info;
			require 'common/page_count.php';
			$sql="select * from $table where $str order by id limit $offset,$psize";
			$query=$db->query($sql);
			unset($count,$str,$sql);
			$tpl->set_block('main','list','lists');
			$inid='0';
			while ($row=$db->row($query))
			{
				if ($row[id]==$info && $row[user_id]!=$wane_user && $row[com_id]!=$wane_user )	{echo clickback('您无权限查看此页');exit;}
				if (!$row[isnew] && $row[com_id]==$wane_user && $row[id]==$info)	{$db->query("UPDATE $table set isnew='1' where id='$row[id]'");}
				$inid=++$inid;
				$iid=$inid;
				$tbgcolor=$iid%2=='0'	?	''	:	'#f8f8f8';
				$tpl->set_var(
					array(
						'TABLECOLOR'	=>	$tbgcolor,
						'AUTHOR'		=>	$row[author],
						'ADDTIME'		=>	date("Y-m-d H:i",$row['addtime']),
						'TITLE'			=>	$row['title'],
						'CONTEXT'		=>	wane_text($row['context']),
					)
				);
				unset($row,$tbgcolor);
				$tpl->parse('lists','list',true);
			}
			$tpl->set_var(
				array(
					'REMAILINFO'	=>	$info,
					'ACTIONINFO'	=>	$str2,
				)
			);
			unset($table);
			$db->free_result($query);
			require 'common/page_show.php';
		}
	}
	//END SHOW RECIVER
	else if ($action=='sendinfo')
	{
		if (userlogined()<='0')
		{
			$headtitle=headtitle('会员登陆');
			$unlogined_info='会员登陆';
			require 'common/unlogined.php';
		}
		elseif ($save_remail)
		{
			if ($remailinfo=='')	{echo clickback('资源指定无效');exit;}
			else if ($title=='' || $context=='')	{echo clickback('回复标题不能为空');exit;}
			else
			{
				$query=$db->query("insert into {$tablepre}per_rec (info_id,author,title,context,addtime) values ('$remailinfo','$wane_user','".html($title)."','".html($context)."','".time()."')");
				if (!$query)	{echo clickback('回复失败');exit;}
				else
				{
					tpl_load('result');
					$db->query("UPDATE {$tablepre}per_rec SET replies=replies+'1' where id='$remailinfo'");
					$result_title='回 复 成 功';
					$headtitle=headtitle('回复成功');
					$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功回复了本条求职信息,系统将于 3 秒后自动返回<BR><BR><a href=view.php?action=sendinfo&info='.$remailinfo.'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg('view.php?action=sendinfo&info='.$remailinfo,'3');
				}
			}
		}
		else
		{
			if ($info=='')	{echo clickback('资源定位不正确');exit;}
			$headtitle=headtitle('信件详情');
			tpl_load('view_sendinfo');
			$table=$tablepre.'per_rec';
			$count='8';
			$str="id='$info' or info_id='$info'";
			$str2='action=sendinfo&info='.$info;
			require 'common/page_count.php';
			$sql="select * from $table where $str order by id limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			$inid='0';
			while ($row=$db->row($query))
			{
				if ($row[id]==$info && $row[user_id]!=$wane_user && $row[per_id]!=$wane_user){echo clickback('您无权限查看');exit;}
				if (!$row[isnew] && $row[per_id]==$wane_user && $row[id]==$info)	{$db->query("UPDATE $table set isnew='1' where id='$row[id]'");}
				$inid=++$inid;
				$iid=$inid;
				$tbgcolor=$iid%2	?	'#f8f8f8'	:	''	;
				$tpl->set_var(
					array(
						'TABLECOLOR'	=>	$tbgcolor,
						'AUTHOR'		=>	$row[author],
						'TITLE'			=>	$row[title],
						'CONTEXT'		=>	wane_text($row['context']),
						'ADDTIME'		=>	date("Y-m-d H:i",$row['addtime']),
					)
				);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
			$tpl->set_var(
				array(
					'REMAILINFO'	=>	$info,
					'ACTIONINFO'	=>	$str2,
				)
			);
		}
	}// END SEND INFO

	//+	start show hunter job
	else if ($action=='hunterjob')
	{
		$ht=HUNTERJOB;
		$qj=QYJIANLITABLE;
		$table=$ht.','.$qj;
		$sql="select $qj.qyuser,$qj.qyname,$qj.qyaddress,$qj.qypro,$qj.qykind,$qj.qyman,$qj.contact_name,$qj.qyphone,$qj.qyemail,$qj.qyweb,$ht.id,$ht.username,$ht.job,$ht.job_text,$ht.job_address,$ht.click,$ht.addtime,$ht.losetime,$ht.sign from $table where $ht.id='$info' and $ht.sign='1' and $ht.username=$qj.qyuser";
		$query=$db->query($sql);
		$num=$db->num($query);
		if ($num<='0')
		{
			tpl_load('result');
			$result_title='数据查询失败';
			$headtitle=headtitle('数据查询失败');
			$result_info='很抱歉 '.$wane_user.' ! <BR><BR>您查询的数据不存在，系统将于 3 秒后自动关闭<BR><BR><a href=javascript:window.close()>立即关闭</a>';
			$tpl->set_var(
				array(
					'RESULT_TITLE'	=>	$result_title,
					'RESULT_INFO'	=>	$result_info,
				)
			);
			echo showmsg('javascript:window.close()','3');
		}
		else
		{
			tpl_load('view_hunterjob');
			$row=$db->row($query);
			$headtitle=headtitle($row['qyname'].' 招 '.$row['job']);
			$tpl->set_var(
				array(
					'INFOTITLE'	=>	($row['qyname'].' 招 '.$row['job']),
					'INFOID'	=>	$row['id'],
					'LINKCOM'	=>	urlencode($row['qyuser']),
					'JOB'		=>	$row['job'],
					'COMPANY'	=>	$row['qyname'],
					'JOB_ADDRESS'=>	$row['job_address'],
					'JOB_TEXT'	=>	wane_text($row['job_text']),
					'CLICK'		=>	$row['click'],
					'ADDTIME'	=>	date('Y-n-j',$row['addtime']),
					'LOSETIME'	=>	(($row['losetime']>time())?date('Y-n-j',$row['losetime']):'<font color=\'#ff0000\'>过期</font>'),
					'QYADDRESS'	=>	$row['qyaddress'],
					'QYPRO'		=>	$row['qypro'],
					'QYKIND'	=>	$row['qykind'],
					'QYSPACE'	=>	$row['qyman'],
					'CONTACT'	=>	$RIGHT[company]	?	$row['contact_name']	:	$lang_right[2],
					'QYPHONE'	=>	$RIGHT[company]	?	$row['qyphone']	:	$lang_right[2],
					'QYMAIL'	=>	$RIGHT[company]	?	$row['qyemail']	:	$lang_right[2],
					'QYWEB'		=>	$RIGHT[company]	?	$row['qyweb']	:	$lang_right[2],
				)
			);
		}
	}
	//+	end show hunter job
	else if ($action=='hunterfind')
	{
		if (!is_numeric($info) || $info<='0')
		{
			exit('资源指定失败');
		}
		else
		{
			if ($user_cfg['kind']==$kind_admin)
			{
				$sql_cut="";
			}
			else
			{
				$sql_cut="and losetime>'".time()."' and sign='1'";
			}
			$sql="select * from {$tablepre}hunter_per where id='$info' $sql_cut";
			$query=$db->query($sql);
			$num=$db->num($query);
			if ($num<='0')	{exit('此信息不存在 或 过期 或 已被隐藏');}
			else
			{
				tpl_load('view_hunterfind');
				$row=$db->row($query);
				$tpl->set_var(
					array(
						'TRUENAME'		=>$row['truename'],
						'INDUSTRY'		=>$row['industry'],
						'YEARSALARY'	=>$row['year_pay'],
						'FOR_YEARSALARY'=>$row['year_pay_for'],
						'POSITION'		=>$row['position'],
						'FOR_POSITION'	=>$row['for_position'],
						'ADDTIME'		=>date("Y-n-j",$row['addtime']),
						'LOSETIME'		=>date("Y-n-j",$row['losetime']),

						'MOBILE'		=>	$RIGHT[personal]	?	$row['mobile']	:	$lang_right[2],
						'HOMEPHONE'		=>	$RIGHT[personal]	?	$row['phone']		:	$lang_right[2],
						'ADDRESS'		=>	$RIGHT[personal]	?	$row['address']	:	$lang_right[2],
						'ZIPCODE'		=>	$RIGHT[personal]	?	$row['code']		:	$lang_right[2],
						'EMAIL'			=>	$RIGHT[personal]	?	$row['email']		:	$lang_right[2],
						'LINKTIME'		=>	$RIGHT[personal]	?	$row['linktime']	:	$lang_right[2],

						'SEX'=>$row['sex'],
						'BIRTH'=>$row['birth'],
						'SID'			=>	!$RIGHT[sid_card]	?	$lang_right[2]	:((strlen($row[sidcard])=='15')	?	wane_str($row[sidcard],0,14)	:	((strlen($row[sidcard])=='18')	?	wane_str($row[sidcard],0,17)	:	'不正确')),
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
					)
				);
			}
		}
	}
	//+-----------------------------------
	//+	mmeber manage web info tools start	--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
	//+-----------------------------------
	else if ($action=='favourite')
	{//+	start favourite
		if ($type=='find')
		{
			if (comlogined()<='0')
			{
				$headtitle=headtitle('企业用户登陆');
				$unlogined_info='企业用户登陆';
				require 'common/unlogined.php';
			}
			else
			{
				if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
				if (!$RIGHT[job_fav])	{echo clickback($lang_right[1]);exit;}
				$num=$db->num($db->query("select user_id,job_id from ".FAVTABLE." where user_id='$wane_user' and job_id='$info'"));
				if ($num<='0')
				{
					$query=$db->query("insert into ".FAVTABLE." (user_id,job_id,addtime) values ('$wane_user','$info','".time()."')");
					if (!$query)
					{
						$headtitle=headtitle('操作失败');
						echo clickback('操作失败');
						exit;
					}
					else
					{
						$htmllink=linkurl($tablepre.'findjob_chance',$info,'find');
						tpl_load('result');
						$result_title='操作成功';
						$headtitle=headtitle('操作成功');
						$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
						$tpl->set_var(
							array(
								'RESULT_TITLE'	=>	$result_title,
								'RESULT_INFO'	=>	$result_info,
							)
						);
						echo showmsg($htmllink,'3');
					}
				}
				else
				{
					$htmllink=linkurl($tablepre.'findjob_chance',$info,'find');
					tpl_load('result');
					$result_title='重复操作';
					$headtitle=headtitle('重复操作');
					$result_info='很抱歉 '.$wane_user.' ! <BR><BR>请不要重复收藏,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
			}
		}
		else if ($type=='job')
		{
			if (perlogined()<='0')
			{
				$headtitle=headtitle('个人用户登陆');
				$unlogined_info='个人用户登陆';
				require 'common/unlogined.php';
			}
			else
			{
				if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
				if (!$RIGHT[job_fav])	{echo clickback($lang_right[1]);exit;}
				$num=$db->num($db->query("select user_id,job_id from ".FAVTABLE." where user_id='$wane_user' and job_id='$info'"));
				if ($num<='0')
				{
					$query=$db->query("insert into ".FAVTABLE." (user_id,job_id,addtime) values ('$wane_user','$info','".time()."')");
					if (!$query)
					{
						$headtitle=headtitle('操作失败');
						echo clickback('操作失败');
						exit;
					}
					else
					{
						$htmllink=linkurl($tablepre.'job_chance',$info,'job');
						tpl_load('result');
						$result_title='操作成功';
						$headtitle=headtitle('操作成功');
						$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
						$tpl->set_var(
							array(
								'RESULT_TITLE'	=>	$result_title,
								'RESULT_INFO'	=>	$result_info,
							)
						);
						echo showmsg($htmllink,'3');
					}
				}
				else
				{
					$htmllink=linkurl($tablepre.'job_chance',$info,'job');
					tpl_load('result');
					$result_title='重复操作';
					$headtitle=headtitle('重复操作');
					$result_info='很抱歉 '.$wane_user.' ! <BR><BR>请不要重复收藏,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
			}
		}
		else if ($type=='hunterfind')
		{
			$table=FAVHUNTER;
			if (comlogined()<='0')
			{
				$headtitle=headtitle('企业用户登陆');
				$unlogined_info='企业用户登陆';
				require 'common/unlogined.php';
			}
			else
			{
				if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
				if (!$RIGHT[hunter_fav])	{echo clickback($lang_right[1]);exit;}

				$htmllink=linkurl($tablepre.'hunter_per',$info,'hunter_find');
				$num=$db->num($db->query("select user_id,find_id from $table where user_id='$wane_user' and find_id='$info'"));
				if ($num>='1')
				{
					tpl_load('result');
					$result_title='重复收藏';
					$headtitle=headtitle('重复收藏');
					$result_info='很抱歉 '.$wane_user.' ! <BR><BR>请不要重复收藏,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
				else
				{
					$query=$db->query("INSERT INTO $table (user_id,find_id,addtime) VALUES ('$wane_user','$info','".time()."')");
					if (!$query)	{echo clickback('收藏失败');exit;}
					else
					{
						tpl_load('result');
						$result_title='收藏成功';
						$headtitle=headtitle('收藏成功');
						$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功收藏了此条信息,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
						$tpl->set_var(
							array(
								'RESULT_TITLE'	=>	$result_title,
								'RESULT_INFO'	=>	$result_info,
							)
						);
						echo showmsg($htmllink,'3');
					}
				}
			}
		}
		else if ($type=='hunterjob')
		{
			$table=FAVHUNTER;
			if (perlogined()<='0')
			{
				$headtitle=headtitle('个人用户登陆');
				$unlogined_info='个 人 用 户 登 陆';
				require 'common/unlogined.php';
			}
			else
			{
				if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
				if (!$RIGHT[hunter_fav])	{echo clickback($lang_right[1]);exit;}
				$htmllink=linkurl($tablepre.'hunter_com',$info,'hunter_job');
				$num=$db->num($db->query("select user_id,find_id from $table where user_id='$wane_user' and find_id='$info'"));
				if ($num>='1')
				{
					tpl_load('result');
					$result_title='重复收藏';
					$headtitle=headtitle('重复收藏');
					$result_info='很抱歉 '.$wane_user.' ! <BR><BR>请不要重复收藏,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
					$tpl->set_var(
						array(
							'RESULT_TITLE'	=>	$result_title,
							'RESULT_INFO'	=>	$result_info,
						)
					);
					echo showmsg($htmllink,'3');
				}
				else
				{
					$query=$db->query("INSERT INTO $table (user_id,find_id,addtime) VALUES ('$wane_user','$info','".time()."')");
					if (!$query)	{echo clickback('收藏失败');exit;}
					else
					{
						tpl_load('result');
						$result_title='收藏成功';
						$headtitle=headtitle('收藏成功');
						$result_info='恭喜您 '.$wane_user.' ! <BR><BR>请已成功收藏了此条信息,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
						$tpl->set_var(
							array(
								'RESULT_TITLE'	=>	$result_title,
								'RESULT_INFO'	=>	$result_info,
							)
						);
						echo showmsg($htmllink,'3');
					}
				}
			}
		}
	}//+	end favourite










































	else if ($action=='discuss')
	{
		if ($submit_disscuss)
		{
			if (userlogined()<='0')
			{
				$headtitle=headtitle('会员登陆');
				$unlogined_info='会员登陆';
				require 'common/unlogined.php';
			}
			elseif (empty($infoid) || $infoid=='0' || !isset($infoid) || !isset($infokey))
			{
				echo clickback('定位失败');exit;
			}
			elseif(empty($context))
			{
				echo clickback('评论内容不能为空');exit;
			}
			else
			{
				$sql="INSERT INTO $infotable ($infokey,context,addtime) VALUES ('$infoid','".html($context)."','".time()."')";
				$query=$db->query($sql);
				switch ($infotable)
				{
					case	$tablepre.'index_news_re'	:	$db->query("UPDATE {$tablepre}index_news SET replies=replies+'1' WHERE id='$infoid'");break;
					case	$tablepre.'hunter_info_re'	:	$db->query("UPDATE {$tablepre}hunter_info SET replies=replies+'1' WHERE id='$infoid'");break;
					case	$tablepre.'job_law_re'		:	$db->query("UPDATE {$tablepre}job_law SET replies=replies+'1' WHERE id='$infoid'");break;
					case	$tablepre.'job_way_re'		:	$db->query("UPDATE {$tablepre}job_way SET replies=replies+'1' WHERE id='$infoid'");break;
					default		:	$update='empty';break;
				}
				switch ($infokey)
				{
					case	'news_id'	:	$htmllink='view.php?action=discuss&type=news&info='.$infoid;	break;
					case	'way_id'	:	$htmllink='view.php?action=discuss&type=way&info='.$infoid;	break;
					case	'law_id'	:	$htmllink='view.php?action=discuss&type=law&info='.$infoid;	break;
					case	'info_id'	:	$htmllink='view.php?action=discuss&type=hunterinfo&info='.$infoid;	break;
				}
				tpl_load('result');
				$result_title='评论成功';
				$headtitle=headtitle('论坛成功');
				$result_info='恭喜您 '.$wane_user.' ! <BR><BR>您已成功发表了您的评论,系统将于 3 秒后自动返回<BR><BR><a href=\''.$htmllink.'\'>立即返回</a>';
				$tpl->set_var(
					array(
						'RESULT_TITLE'	=>	$result_title,
						'RESULT_INFO'	=>	$result_info,
					)
				);
				echo showmsg($htmllink,'3');
			}
		}
		else
		{
			tpl_load('view_discuss');
			$count='10';
			switch ($type)
			{
				case	'news'	:	$sqltable=array($tablepre.'index_news_re','news_id');	break;
				case	'law'	:	$sqltable=array($tablepre.'job_law_re','law_id');		break;
				case	'way'	:	$sqltable=array($tablepre.'job_way_re','way_id');		break;
				case	'hunterinfo'	:	$sqltable=array($tablepre.'hunter_info_re','info_id');	break;
			}
			$tpl->set_var(
				array(
					'INFOID'	=>	$info,
					'INFOTABLE'	=>	$sqltable[0],
					'INFOKEY'	=>	$sqltable[1],
				)
			);
			$table=$sqltable[0];
			$str="$sqltable[1]='$info'";
			$str2="action=discuss&type=$type&info=$info";
			require 'common/page_count.php';
			$sql="select * from $table where $str order by id asc limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','discuss','discusss');
			while ($row=$db->row($query))
			{
				//$tpl->set_var('discusss');
				$tpl->set_var(
					array(
						'CONTEXT'	=>	wane_text($row[context]),
						'ADDTIME'	=>	date("Y-n-j H:i",$row[addtime]),
					)
				);
				$tpl->parse('discusss','discuss',true);
			}
			require 'common/page_show.php';
		}
	}
	else
	{
		exit('Access Denied.');
	}
	require_once 'common/common.php';
	if ($process_info=='1')
	{
		$process=$DEBUG->process();
		$queries=$db->querynum;
		$tpl->set_var(PROCESS_INFOS,"Process in $process second(s) with $queries Queries $pagegzipinfo .");
		$tpl->set_var('WANE_PROCESS',$process);
		$tpl->set_var('WANE_QUERY',$db->querynum.' Queries');
	}
	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
?>