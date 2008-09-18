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
	require_once "globals.php";
	if (perlogined()<='0')
	{
		$unlogined_info='个人用户登陆';
		$headtitle=headtitle($webtitle.' -> 个人用户控制面板');
		require 'common/unlogined.php';
	}
	elseif (!$db->num($db->query("select m.username,p.username from {$tablepre}member m,{$tablepre}jianli p where m.username=p.username and m.username='$wane_user'")))
	{
		$db->query("INSERT INTO {$tablepre}jianli (username,lastupdate) values ('$wane_user','".time()."')");
		echo showmsg('personal.php','0');exit;
	}
	//+-------------------------------------------
	//+	start set personal jianli
	//+-------------------------------------------
	else if ($action=='basicinfo')
	{
		$headtitle=headtitle('个人用户控制面板 -> 基本资料设置');
		if ($save)
		{
			if ($truename=='')	{echo clickback('真实姓名不能为空');exit;}
			else
			{
				$birth=html($year).'-'.$month.'-'.$day;
				$juzhudi=$juzhu_1.'-'.html($juzhu_2);
				$sql="UPDATE ".JIANLITABLE."
						SET
							truename='".html($truename)."',
							sex='".$sex."',
							mingzu='".$mingzu."',
							birth='$birth',
							hukou='".$hukou."',
							juzhudi='$juzhudi',
							shengfengzhen='".html($shengfengzhen)."',
							marry='".$marry."',
							social='".$social."',
							lastupdate='".time()."'
						WHERE
							username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('简历更新失败');exit;}
				else
				{
					if ($shownewper)
					{
						update_cache('personals','0');
					}
					tpl_load('result');
					$result_title='简历更新成功';
					$result_info='恭喜您  '.$wane_user.' <BR><BR>您已成功更新了您的个人简历,系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=basicinfo>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=basicinfo','3');
				}
			}
		}
		else
		{
			tpl_load('personal_basicinfo');
			$sql="select * from ".JIANLITABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$persex=$row['sex'];
			$perminzu=$row['mingzu'];
			list($peryear,$permonth,$perday)=split('-',$row['birth']);
			$permarry=$row['marry'];
			$perhukou=$row['hukou'];
			$juzhudi=explode('-',$row['juzhudi']);
			$perjuzhudi=$juzhudi[0];
			$jzd2=$juzhudi[1];
			$persocial=$row['social'];
			$tpl->set_var(
				array(
					'TRUENAME'	=>	$row['truename'],
					'SFZ'		=>	$row['shengfengzhen'],
					'JUZHU_2'	=>	$jzd2
				)
			);
		}
	}
	else if ($action=='perinfo')
	{
		$headtitle=headtitle('控制面板 -> 个人概况');
		if ($save)
		{
			$sql="UPDATE ".JIANLITABLE."
					SET
						height='".html($height)."',
						weight='".html($weight)."',
						ear='".html($sight)."',
						jobtoknow='".html($jobtoknow)."',
						money='".html($salary)."',
						graedu='".html($graedu)."',
						edu='$edu',
						graedutime='".html($graedutime)."',
						zhuanye='$smajortype',
						zhuanyename='$smajorname',
							lastupdate='".time()."'
					WHERE
						username='$wane_user'";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('更新简历失败');exit;}
			else
			{
				if ($shownewper)
				{
					update_cache('personals','0');
				}
				tpl_load('result');
				$result_title='更新简历成功';
				$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功更新了您的个人简历 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=perinfo>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=perinfo','3');
			}
		}
		else
		{
			tpl_load('personal_perinfo');
			$tpl->set_var('SELECTJS','<script src=\'css/zhuanye.js\'></script>');
			$sql="select * from ".JIANLITABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$peredu=$row['edu'];
			$zytype=$row['zhuanye'];
			$zyname=$row['zhuanyename'];
			$tpl->set_var(
				array(
					'HEIGHT'		=>	$row['height'],
					'WEIGHT'		=>	$row['weight'],
					'SIGHT'			=>	$row['ear'],
					'JOBTOKNOW'		=>	$row['jobtoknow'],
					'SALARY'		=>	$row['money'],
					'GRAEDU'		=>	$row['graedu'],
					'GRAEDUTIME'	=>	$row['graedutime'],
					'ZYTYPE'		=>	($zytype!='')	?	$zytype	:	'不限',
					'ZYNAME'		=>	($zyname!='')	?	$zyname	:	'不限'
				)
			);
			unset($zytype,$zyname);
		}
	}
	else if ($action=='contactinfo')
	{
		$headtitle=headtitle('控制面板  -> 个人联系资料');
		 if ($save)
		{
			$sql="UPDATE ".JIANLITABLE."
					SET
						phone='".html($phone)."',
						handphone='".html($handphone)."',
						comphone='".html($comphone)."',
						email='".html($email)."',
						qq='".html($qq)."',
						address='".html($address)."',
						youbian='".html($youbian)."',
						homepage='".html($homepage)."',
							lastupdate='".time()."'
					WHERE
						username='$wane_user'";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('更新简历失败');exit;}
			else
			{
				if ($shownewper)
				{
					update_cache('personals','0');
				}
				tpl_load('result');
				$result_title='更新简历成功';
				$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功更新了您的个人简历 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=contactinfo>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=contactinfo','3');
			}
		}
		else
		{
			tpl_load('personal_contactinfo');
			$sql="select * from ".JIANLITABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$tpl->set_var(
				array(
					'PHONE'	=>	$row['phone'],
					'HANDPHONE'	=>	$row['handphone'],
					'COMPHONE'	=>	$row['comphone'],
					'EMAIL'		=>	$row['email'],
					'QQ'		=>	$row['qq'],
					'ADDRESS'	=>	$row['address'],
					'YOUBIAN'	=>	$row['youbian'],
					'HOMEPAGE'	=>	$row['homepage'],
				)
			);
		}
	}
	else if ($action=='forjob')
	{
		$headtitle=headtitle('控制面板  -> 求职意向');
		if ($save)
		{
			if ($compro!='')
			{
				$ids = $comma = '';
				foreach($compro as $id)
				{
					$ids .= $comma.$id;
					$comma = ',';
				}
				$compro=$ids;
			}
			else
			{
				$compro='';
			}
			$sql="UPDATE ".JIANLITABLE."
					SET
						jobpro='$jobpro',
						formoney='$formoney',
						forjob='".html($forjob)."',
						jobkind='".html($jobkind)."',
						compro='$compro',
						jobaddress='".html($jobaddress)."',
						forhouse='".html($forhouse)."',
						leavejobtime='".html($leavejobtime)."',
						workjingli='".html($workjingli)."',
							lastupdate='".time()."'
					WHERE
						username='$wane_user'";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('更新简历失败');exit;}
			else
			{
				if ($shownewper)
				{
					update_cache('personals','0');
				}
				tpl_load('result');$result_title='更新简历成功';
				$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功更新了您的个人简历 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=forjob>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=forjob','3');
			}
		}
		else
		{
			tpl_load('personal_forjob');
			$sql="select * from ".JIANLITABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$perjobpro=$row['jobpro'];
			$perprice=$row['formoney'];
			$compro=explode(',',$row['compro']);
			$numspro=count($lang_company_kind);
			for ($numpro=0;$numpro<$numspro;$numpro++)
			{
				if (($numpro+1)%4==0 && $numpro!=($numspro-1))	{$probr='<BR>';}	else	{$probr='';}
				if (in_array($lang_company_kind[$numpro],$compro))
				{
					$select_compro.="<input type=\"checkbox\" name=\"compro[]\" value=\"".$lang_company_kind[$numpro]."\" checked>".$lang_company_kind[$numpro]."&nbsp;&nbsp;".$probr;
				}
				else
				{
					$select_compro.="<input type=\"checkbox\" name=\"compro[]\" value=\"".$lang_company_kind[$numpro]."\">".$lang_company_kind[$numpro]."&nbsp;&nbsp;".$probr;
				}
			}
			$tpl->set_var(
				array(
					'FORJOB'		=>	$row['forjob'],
					'JOBKIND'		=>	$row['jobkind'],
					"SELECT_COMPRO"	=>	$select_compro,
					'JOBADDRESS'	=>	$row['jobaddress'],
					'FORHOUSE'		=>	$row['forhouse'],
					'LEAVEJOBTIME'	=>	$row['leavejobtime'],
					'WORKJINGLI'	=>	$row['workjingli'],
				)
			);
			unset($select_compro);
		}
	}
	else if ($action=='otherinfo')
	{
		$headtitle=headtitle('控制面板  -> 附加信息');
		if ($save)
		{
			$sql="UPDATE ".JIANLITABLE."
					SET
						engname='$engname',
						engnengli='$engnengli',
						edujingli='".html($edujingli)."',
						zhengshu='".html($zhengshu)."',
						itable='".html($itable)."',
						jiangli='".html($jiangli)."',
						shijiankind='".html($shijiankind)."',
						shijianname='".html($shijianname)."',
						shijianjianjie='".html($shijianjianjie)."',
						techang='".html($techang)."',
						pingjia='".html($pingjia)."',
							lastupdate='".time()."'
					WHERE
						username='$wane_user'";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('更新简历失败');exit;}
			else
			{
				if ($shownewper)
				{
					update_cache('personals','0');
				}
				tpl_load('result');$result_title='更新简历成功';
				$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功更新了您的个人简历 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=otherinfo>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=otherinfo','3');
			}
		}
		else
		{
			tpl_load('personal_otherinfo');
			$sql="select * from ".JIANLITABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$pereng=$row['engname'];
			$perengable=$row['engnengli'];
			$tpl->set_var(
				array(
					'EDUJINGLI'		=>	$row['edujingli'],
					'ZHENGSHU'		=>	$row['zhengshu'],
					'ITABLE'		=>	$row['itable'],
					'JIANGLI'		=>	$row['jiangli'],
					'EDUSHIJIAN'	=>	$row['edushijian'],
					'SHIJIANKIND'	=>	$row['shijiankind'],
					'SHIJIANNAME'	=>	$row['shijianname'],
					'SHIJIANJIANJIE'=>	$row['shijianjianjie'],
					'TECHANG'		=>	$row['techang'],
					'PINGJIA'		=>	$row['pingjia'],
				)
			);
		}
	}
	else if ($action=='myphoto')
	{
		$headtitle=headtitle('控制面板  -> '.$lang_personalcontrol[6]);
		 if ($delete_img)
		{// delete photo

		}
		else if ($save)
		{
			$imgurl=upload_img($HTTP_POST_FILES['userfile']['name'],$HTTP_POST_FILES['userfile']['tmp_name'],'./mem_img');
			if ($imgurl!='0')
			{
				$sql="UPDATE ".JIANLITABLE." set mem_img='$imgurl',lastupdate='".time()."' where username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)
				{
					@delete_file($imgurl);
					echo clickback('更新简历失败');exit;
				}
				else
				{
					if ($shownewper)
					{
						update_cache('personals','0');
					}
					if (file_exists($delimg))	{@delete_file($delimg);}
					tpl_load('result');$result_title='更新简历成功';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功更新了您的个人简历 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=myphoto>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=myphoto','3');
				}
			}
			else
			{
				echo clickback('更新简历失败');exit;
			}
		}
		else
		{
			tpl_load('personal_myphoto');
			$sql="select username,mem_img from ".JIANLITABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);

			$uploaded_img=$row['mem_img'];
			$tpl->set_var('DELIMG',$uploaded_img);
			if ($uploaded_img!='' && file_exists($uploaded_img))
			{
				$imgsize=getimagesize($uploaded_img);
				if ($imgsize[0]>='500')
				{
					$size="width='500' height='400'";
				}
				else
				{
					$size='';
				}
				$tpl->set_var('UPLOADED_IMG','<a href='.$uploaded_img.' target=\'_blank\'><IMG SRC='.$uploaded_img.' '.$size.' border=\'0\' class=\'input\'></a>');
			}
			else
			{
				$tpl->set_var('UPLOADED_IMG','NO PHOTO');
			}
		}
	}
	//+---------------------------------------------
	//+	start put find job info
	//+---------------------------------------------
	else if ($action=='putfind')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_find])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 发布求职');
		if ($exit_putfind)
		{
			echo showmsg('personal.php?action=basicinfo','0');exit;
		}
		else if ($save_putfind)
		{
			if ($job=='' || $work_address=='' || $jobtext=='')	{echo clickback('职位名称,工作地点,工作说明不能为空');exit;}
			else
			{
				$losetime=time()+86400*$days;
				$findhtmldir_root=date($dirhtml_unit,time());
				$sql="INSERT INTO ".FINDJOBTABLE."
					(tid,username,job,puttime,losetime,jobtext,work_address,sign,htmlroot)
					values
					('$tid','$wane_user','".html($job)."','".time()."','$losetime','".html($jobtext)."','".html($work_address)."','".$RIGHT[sign_find]."','$findhtmldir_root')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback($lang_putfind[1]);exit;}
				else
				{
					if ($html_find=='1' && $RIGHT[sign_find]=='1')
					{
						$findid=$db->query_id();
						$sql_jl=$db->query("select * from ".JIANLITABLE." where username='$wane_user'");
						$row_jl=$db->row($sql_jl);
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$sql_data=array(
							'WEBTITLE'			=>	headtitle($row_jl['truename'].' 求职位 '.html($job)),
							'INFOTITLE'			=>	'[<a href=../../../view.php?action=personal&info='.urlencode($row_jl['username']).' target=\'_blank\'>'.$row_jl['truename'].'</a>] 求职位 '.html($job),
							'JOB'				=>	html($job),
							'TRUENAME'			=>	$row_jl['truename'],
							'JLLINK'			=>	urlencode($row_jl['username']),
							'LINK'				=>	$findid,

							'WORK_ADDRESS'		=>	$work_address,
							'SEX'				=>	$row_jl['sex'],
							'BIRTH'				=>	$row_jl['birth'],
							'MINZU'				=>	$row_jl['mingzu'],
							'EDU'				=>	$row_jl['edu'],
							'ENG_NENGLI'		=>	$row_jl['engname'].' &nbsp;&nbsp; '.$row_jl['engnengli'],
							'ZHUANYE'			=>	$row_jl['zhuanye'],
							'ZHUANYENAME'		=>	$row_jl['zhuanyename'],

							'PHONE'				=>	$row_jl['phone'],
							'HANDPHONE'			=>	$row_jl['handphone'],
							'EMAIL'				=>	$row_jl['email'],
							'HOMEPAGE'			=>	$row_jl['homepage'],
							'JOBTEXT'			=>	wane_text($jobtext),

							'ADDTIME'			=>	date("Y-n-j",time()),
							'LOSETIME'			=>	date("Y-n-j",time()+$days*86400),
							'CLICK'				=>	'0',
						);
						$c_html->c_find('header.html',$default_find,'footer.html',$findid,$dirhtml_find,$findhtmldir_root,$sql_data,0);
						update_cache('find','0');
					}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=managefind>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=managefind','3');
				}
			}
		}
		else
		{
			tpl_load('personal_putfind');
			$jobtypefile	=	'common/cache/cache_jobtype.php';
			if (!file_exists($jobtypefile))
			{
				update_cache('jobtype','0');
				exit('Create cache.<br>Please reresh.');
			}
			else
			{
				require $jobtypefile;
			}
			unset($jobtypefile);

			$sql=$db->query("select username,truename,sex,mingzu,birth,birth,edu,zhuanye,zhuanyename,phone,handphone,comphone,email,qq from ".JIANLITABLE." where username='$wane_user'");
			$row=$db->row($sql);
			$rowtruename=$row['truename'];
			$tpl->set_var('JOBTYPE',select_jobtype(0));
			if ($rowtruename!='')
			{
				$tpl->set_var('TRUENAME',$rowtruename);
				$sign_truename='1';
			}
			else
			{
				$tpl->set_var('TRUENAME','<font color=\'#ff0000\'>无信息</font>');
				$sign_truename='0';
			}

			$rowsex=$row['sex'];
			if ($rowsex!='')
			{
				$tpl->set_var('SEX',$rowsex);
				$sign_sex='1';
			}
			else
			{
				$tpl->set_var('SEX','<font color=\'#ff0000\'>无信息</font>');
				$sign_sex='0';
			}

			$rowbirth=$row['birth'];
			if ($rowbirth!='')
			{
				$tpl->set_var('BIRTH',$rowbirth);
				$sign_birth='1';
			}
			else
			{
				$tpl->set_var('BIRTH','<font color=\'#ff0000\'>无信息</font>');
				$sign_birth='0';
			}

			$rowedu=$row['edu'];
			if ($rowedu!='')
			{
				$tpl->set_var('EDU',$rowedu);
				$sign_edu='1';
			}
			else
			{
				$tpl->set_var('EDU','<font color=\'#ff0000\'>无信息</font>');
				$sign_edu='0';
			}

			$rowzhuanye=$row['zhuanye'];
			if ($rowzhuanye!='')
			{
				$tpl->set_var('ZHUANYE',$rowzhuanye);
				$sign_zhuanye='1';
			}
			else
			{
				$tpl->set_var('ZHUANYE','<font color=\'#ff0000\'>无信息</font>');
				$sign_zhuanye='0';
			}

			$rowzhuanyename=$row['zhuanyename'];
			if ($rowzhuanye!='')
			{
				$tpl->set_var('ZHUANYENAME',$rowzhuanye);
				$sign_zhuanyename='1';
			}
			else
			{
				$tpl->set_var('ZHUANYENAME','<font color=\'#ff0000\'>无信息</font>');
				$sign_zhuanyename='0';
			}

			$phone=$row['phone'];
			$handphone=$row['handphone'];
			$comphone=$row['comphone'];
			$email=$row['email'];
			$qq=$row['qq'];
			if ($phone=='' && $handphone=='' && $comphone=='' && $email=='' && $qq=='')
			{
				$tpl->set_var('CONTACT','<font color=\'#ff0000\'>无信息</font>');
				$sign_contact='0';
			}
			else
			{
				$tpl->set_var('CONTACT','PHONE :'.$phone.','.$handphone.','.$comphone.'; <BR>E-mail:'.$email.';<BR>QQ:'.$qq);
				$sign_contact='1';
			}
			if ($sing_contact=='0' || $sign_zhuanyename=='0' || $sign_zhuanye=='0' || $sign_edu=='0' || $sign_birth=='0' || $sign_truename=='0' || $sign_sex=='0')
			{
				$tpl->set_var('PUTFIND_NAME','exit_putfind');
				$tpl->set_var('PUTFIND_VALUE','您的资料不完整');
			}
			else
			{
				$tpl->set_var('PUTFIND_NAME','save_putfind');
				$tpl->set_var('PUTFIND_VALUE',' 提 交 ');
			}
		}
	}
	//+----------------------------------------
	//+	start manage find job infos
	//+----------------------------------------
	else if ($action=='managefind')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_find])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 管理求职');
		$editinfo=$info;
		if ($delete_find)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids = $comma = '';
				foreach($delete as $id)
				{
					$ids .= "$comma'$id'";
					$comma = ',';
				}
				if ($html_find=='1')
				{
					$sql_d=$db->query("select * from ".FINDJOBTABLE." where id in ($ids)");
					while ($row_d=$db->row($sql_d))
					{
						$findfile=$htmlroot.$dirhtml_find.'/'.$row_d['htmlroot'].'/'.$row_d['id'].'.html';
						delete_file($findfile);
					}
				}
				$query=$db->query("delete from ".FINDJOBTABLE." where id in ($ids) and username='$wane_user'");
				if (!$query)	{echo clickback('删除失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除成功';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功执行了您选定的操作,系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=managefind&page='.$delpage.'>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=managefind&page='.$delpage,'3');
				}
			}
		}
		else if ($save_editfind)
		{
			if ($job=='' || $work_address=='' || $jobtext=='')	{echo clickback('职位名称,工作地点,工作说明不能为空');exit;}
			else
			{
				$losetime=$puttime+86400*$days;
				$sql="UPDATE ".FINDJOBTABLE." SET tid='$tid',job='".html($job)."',losetime='$losetime',jobtext='".html($jobtext)."',work_address='".html($work_address)."' WHERE id='".$findid."' and username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('操作失败');exit;}
				else
				{
					if ($html_find=='1' && $RIGHT[sign_find]=='1')
					{
						unset($ft,$pt);
						$ft=FINDJOBTABLE;
						$pt=JIANLITABLE;
						$sql_jl=$db->query("select $ft.*,$pt.username,$pt.truename,$pt.sex,$pt.mingzu,$pt.birth,$pt.edu,$pt.zhuanye,$pt.zhuanyename,$pt.phone,$pt.handphone,$pt.email,$pt.homepage,$pt.engname,$pt.engnengli from $ft,$pt where $ft.id='$findid' and $ft.username='$wane_user' and $pt.username='$wane_user'");
						$row_jl=$db->row($sql_jl);
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$sql_data=array(
							'WEBTITLE'		=>	headtitle($row_jl['truename'].' 求职位 '.html($job)),
							'INFOTITLE'		=>	'[<a href=../../../view.php?action=personal&info='.urlencode($row_jl['username']).' target=\'_blank\'>'.$row_jl['truename'].'</a>] 求职位 '.html($job),
							'JOB'			=>	html($job),
							'TRUENAME'		=>	$row_jl['truename'],
							'JLLINK'		=>	urlencode($row_jl['username']),
							'LINK'			=>	$findid,

							'WORK_ADDRESS'	=>	html($work_address),
							'SEX'			=>	$row_jl['sex'],
							'BIRTH'			=>	$row_jl['birth'],
							'MINZU'			=>	$row_jl['mingzu'],
							'EDU'			=>	$row_jl['edu'],
							'ENG_NENGLI'	=>	$row_jl['engname'].' &nbsp;&nbsp; '.$row_jl['engnengli'],
							'ZHUANYE'		=>	$row_jl['zhuanye'],
							'ZHUANYENAME'	=>	$row_jl['zhuanyename'],

							'PHONE'			=>	$row_jl['phone'],
							'HANDPHONE'		=>	$row_jl['handphone'],
							'EMAIL'			=>	$row_jl['email'],
							'HOMEPAGE'		=>	$row_jl['homepage'],
							'JOBTEXT'		=>	wane_text($jobtext),

							'ADDTIME'		=>	date("Y-n-j",$puttime),
							'LOSETIME'		=>	date("Y-n-j",$puttime+$days*86400),
							'CLICK'			=>	$row_jl['click'],
						);
						$c_html->c_find('header.html',$default_find,'footer.html',$findid,$dirhtml_find,$find_dir,$sql_data,0);
						update_cache('find','0');
					}
					tpl_load('result');
					$result_title='操作结束';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您忆成功执行了您的操作<BR><BR><a href=personal.php?action=managefind>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=managefind','3');
				}
			}
		}
		else if ($exit_editfind)
		{
			echo showmsg('personal.php?action=basicinfo','0');exit;
		}
		else if ($editinfo!='')
		{
			$query=$db->query("select * from ".FINDJOBTABLE." where id='$editinfo' and username='$wane_user'");
			$num=$db->num($query);
			if ($num<='0')	{echo clickback('您无编辑权限');exit;}
			else
			{
				tpl_load('personal_putfind_edit');
				$jobtypefile	=	'common/cache/cache_jobtype.php';
				if (!file_exists($jobtypefile))
				{
					update_cache('jobtype','0');
					exit('Create cache.<br>Please reresh.');
				}
				else
				{
					require $jobtypefile;
				}
				unset($jobtypefile);
				$rowedit=$db->row($query);
				$tpl->set_var(
					array(
						'JOB'			=>	$rowedit['job'],
						'JOBTYPE'		=>	select_jobtype($rowedit[tid]),
						'FIND_DIR'		=>	$rowedit[htmlroot],
						'WORK_ADDRESS'	=>	$rowedit['work_address'],
						'JOBTEXT'		=>	$rowedit['jobtext'],
						'FINDID'		=>	$rowedit['id'],
						'ADDTIME'		=>	$rowedit['puttime'],
						'LOSETIME'		=>	date("Y-m-d H:i",$rowedit['losetime']),
					)
				);

				$sql=$db->query("select username,truename,sex,mingzu,birth,birth,edu,zhuanye,zhuanyename,phone,handphone,comphone,email,qq from ".JIANLITABLE." where username='$wane_user'");
				$row=$db->row($sql);
				$rowtruename=$row['truename'];
				if ($rowtruename!='')
				{
					$tpl->set_var('TRUENAME',$rowtruename);
					$sign_truename='1';
				}
				else
				{
					$tpl->set_var('TRUENAME','<font color=\'#ff0000\'>无信息</font>');
					$sign_truename='0';
				}

				$rowsex=$row['sex'];
				if ($rowsex!='')
				{
					$tpl->set_var('SEX',$rowsex);
					$sign_sex='1';
				}
				else
				{
					$tpl->set_var('SEX','<font color=\'#ff0000\'>无信息</font>');
					$sign_sex='0';
				}

				$rowbirth=$row['birth'];
				if ($rowbirth!='')
				{
					$tpl->set_var('BIRTH',$rowbirth);
					$sign_birth='1';
				}
				else
				{
					$tpl->set_var('BIRTH','<font color=\'#ff0000\'>无信息</font>');
					$sign_birth='0';
				}

				$rowedu=$row['edu'];
				if ($rowedu!='')
				{
					$tpl->set_var('EDU',$rowedu);
					$sign_edu='1';
				}
				else
				{
					$tpl->set_var('EDU','<font color=\'#ff0000\'>无信息</font>');
					$sign_edu='0';
				}

				$rowzhuanye=$row['zhuanye'];
				if ($rowzhuanye!='')
				{
					$tpl->set_var('ZHUANYE',$rowzhuanye);
					$sign_zhuanye='1';
				}
				else
				{
					$tpl->set_var('ZHUANYE','<font color=\'#ff0000\'>无信息</font>');
					$sign_zhuanye='0';
				}

				$rowzhuanyename=$row['zhuanyename'];
				if ($rowzhuanye!='')
				{
					$tpl->set_var('ZHUANYENAME',$rowzhuanye);
					$sign_zhuanyename='1';
				}
				else
				{
					$tpl->set_var('ZHUANYENAME','<font color=\'#ff0000\'>无</font>');
					$sign_zhuanyename='0';
				}

				$phone=$row['phone'];
				$handphone=$row['handphone'];
				$comphone=$row['comphone'];
				$email=$row['email'];
				$qq=$row['qq'];
				if ($phone=='' && $handphone=='' && $comphone=='' && $email=='' && $qq=='')
				{
					$tpl->set_var('CONTACT','<font color=\'#ff0000\'>无信息</font>');
					$sign_contact='0';
				}
				else
				{
					$tpl->set_var('CONTACT','PHONE :'.$phone.','.$handphone.','.$comphone.'; <BR>E-mail:'.$email.';<BR>QQ:'.$qq);
					$sign_contact='1';
				}
				if ($sing_contact=='0' || $sign_zhuanyename=='0' || $sign_zhuanye=='0' || $sign_edu=='0' || $sign_birth=='0' || $sign_truename=='0' || $sign_sex=='0')
				{
					$tpl->set_var('PUTFIND_NAME','exit_editfind');
					$tpl->set_var('PUTFIND_VALUE','资料不完整');
				}
				else
				{
					$tpl->set_var('PUTFIND_NAME','save_editfind');
					$tpl->set_var('PUTFIND_VALUE',' 提交信息 ');
				}
			}
		}
		else
		{
			tpl_load('personal_managefind');
				$jobtypefile	=	'common/cache/cache_jobtype.php';
				if (!file_exists($jobtypefile))
				{
					update_cache('jobtype','0');
					exit('Create cache.<br>Please reresh.');
				}
				else
				{
					require $jobtypefile;
				}
				unset($jobtypefile);
			$tpl->set_var('SELECTJS','<script src=\'css/check_all.js\'></script>');
			$tpl->set_var('DELPAGE',$HTTP_GET_VARS['page']);
			$count='20';
			$table=FINDJOBTABLE;
			$str="username='$wane_user'";
			$str2="action=managefind";
			require 'common/page_count.php';
			$sql="select * from ".FINDJOBTABLE." where username='$wane_user' order by losetime desc limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($query))
			{
				$htmlfile=$htmlroot.$dirhtml_find.'/'.$row[htmlroot].'/'.$row[id].'.html';
				$findlink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=showfind&info='.$row[id];
				$tpl->set_var(
					array(
						'FIND_LINK'	=>	$findlink,
						'JOB'		=>	$row['job'],
						'JOBTYPE'	=>	show_jobtype($row[tid]),
						'FINDID'	=>	$row['id'],
						'ADDTIME'	=>	date("Y-n-j",$row['puttime']),
						'LOSETIME'	=>	($row[losetime]>time())	?	date("Y-n-j",$row[losetime])	:	'<font color=\'#ff0000\'>过期</font>',
						'STATUS'	=>	($row[sign]=='1')	?	'<FONT COLOR=\'#6699CC\'>显示</FONT>'	:	'<font color=\'#ff0000\'>隐藏</font>',
						'CLICK'		=>	$row['click'],

					)
				);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
		}
	}
	//+----------------------------------------
	//+	start set personal hunter info
	//+	---------------------------------------
	else if ($action=='puthunter')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_hunter_find])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 发布猎头人才');
		if ($submit_hunter)
		{
			/*
			判断提供表单的信息是否为空值
			*/
			$birth=$year.'-'.$month.'-'.$day;
			$living=$living_1.'-'.html($living_2);
			$forliving=$forliving_1.'-'.html($forliving_2);
			$depart=$smajortype.'-'.$smajorname;
			$perhunter_htmlroot=date($dirhtml_unit,time());
			$sql="insert into ".HUNTERFIND."
                 (username,truename,year_pay,industry,year_pay_for,position,for_position,mobile,address,phone,code,email,linktime,sex,birth,sidcard,marry,hukou,living,forliving,edu,graedu,depart,train,workexp,enable,context,addtime,losetime,sign,htmlroot)
                 Values
                 ('$wane_user','".html($truename)."','$year_pay','".html($industry)."','$year_pay_for','$position','".html($for_position)."','".html($mobile)."','".html($address)."','".html($phone)."','".html($code)."','".html($email)."','".html($linktime)."','$sex','$birth','".html($sidcard)."','$marry','$hukou','$living','$forliving','$edu','".html($graedu)."','$depart','".html($train)."','".html($workexp)."','".html($enable)."','".html($context)."','".time()."','".(time()+$days*86400)."','".$RIGHT[sign_hunterfind]."','$perhunter_htmlroot')";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('猎头人才发表失败');exit;}
			else
			{
				if ($html_perhunter=='1' && $RIGHT[sign_hunterfind]=='1')
				{
					$perhunter_name=$db->query_id();
					$sql_data=array(
						'TRUENAME'=>html($truename),
						'INDUSTRY'=>$industry,
						'YEARSALARY'=>$year_pay,
						'FOR_YEARSALARY'=>$year_pay_for,
						'POSITION'=>html($position),
						'FOR_POSITION'=>html($for_position),
						'ADDTIME'=>date("Y-n-j",time()),
						'LOSETIME'=>date("Y-n-j",time()+$days*86400),
						'MOBILE'=>html($mobile),
						'HOMEPHONE'=>html($phone),
						'ADDRESS'=>html($address),
						'ZIPCODE'=>html($code),
						'EMAIL'=>html($email),
						'LINKTIME'=>html($linktime),
						'SEX'=>$sex,
						'BIRTH'=>$birth,
						'SID'=>html($sidcard),
						'MARRY'=>$marry,
						'HUKOU'=>$hukou,
						'LIVING'=>$living,
						'WORK_ADDR'=>$forliving,
						'EDU'=>$edu,
						'GRAEDU'=>html($graedu),
						'DEPART'=>$depart,
						'TRAIN'=>wane_text($train),
						'WORKEXP'=>wane_text($workexp),
						'TECHANG'=>wane_text($enable),
						'CONTEXT'=>wane_text($context),
						'CLICK'=>'0',
						'LINK'=>$perhunter_name,
						'INFOTITLE'=>'猎头人才 '.html($truename),
						'WEBTITLE'=>headtitle('猎头人才 '.html($truename))
					);
					require 'common/create_html.php';
					$c_html=new C_HTML;
					$c_html->c_perhunter('header.html',$default_perhunter,'footer.html',$perhunter_name,$dirhtml_perhunter,$perhunter_htmlroot,$sql_data,0);
					update_cache('hunterfind','0');
				}
				tpl_load('result');$result_title='猎头人才发表成功';
				$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功发表了你的猎头人才信息 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=managehunter>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=managehunter','3');
			}
		}
		else
		{
			tpl_load('personal_puthunter');
			$tpl->set_var('SELECTJS','<script src=\'css/zhuanye.js\'></script>');
			$sql=$db->query("select * from ".JIANLITABLE." where username='$wane_user'");
			$row=$db->row($sql);
			$tpl->set_var(
				array(
					'TRUENAME'=>$row['truename'],
					'SIDCARD'=>$row['shengfengzhen'],
					'ZHUANYE'=>$row['zhuanye'],
					'ZHUANYENAME'=>$row['zhuanyename'],
					'MOBILE'=>$row['handphone'],
					'PHONE'=>$row['phone'],
					'ADDRESS'=>$row['address'],
					'CODE'=>$row['youbian'],
					'EMAIL'=>$row['email'],
					'WORK_EXP'=>$row['workjingli'],
					'ENABLE'=>$row['techang'],
					'CONTEXT'=>$row['pingjia']
				)
			);
			$persex=$row['sex'];
			list($peryear,$permonth,$persay)=explode('-',$row['birth']);
			$permarry=$row['marry'];
			$peredu=$row['edu'];
			$perhukou=$row['hukou'];
			list($perjuzhudi,$perjuzhudi_2)=explode('-',$row['juzhudi']);
			$tpl->set_var('SELECT_JZD2',$perjuzhudi_2);
		}
	}
	// END put hunter
	else if ($action=='managehunter')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_hunter_find])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 管理猎头人才');
		if (is_numeric($info) && $info>='1')
		{
			$query=$db->query("select * from {$tablepre}hunter_per where id='$info' and username='$wane_user'");
			$num=$db->num($query);
			if ($num<='0')
			{
				tpl_load('result');
				$result_title='您无编辑权限';
				$result_info='很抱歉   '.$wane_user.' <BR><BR>您无权限编辑此条信息 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=managehunter>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=managehunter','3');
			}
			else
			{
				$tpl->set_var('SELECTJS','<script src=\'css/zhuanye.js\'></script>');
				tpl_load('personal_puthunter_edit');
				$row=$db->row($query);
				list($zy1,$zy2)=explode('-',$row['depart']);
				$tpl->set_var(
					array(
						'HUNTERID'=>$row['id'],
						'HUNTER_ROOT'=>$row['htmlroot'],
						'TRUENAME'=>$row['truename'],
						'POSITION'=>$row['position'],
						'FOR_POSITION'=>$row['for_position'],
						'MOBILE'=>$row['mobile'],
						'PHONE'=>$row['phone'],
						'ADDRESS'=>$row['address'],
						'CODE'=>$row['code'],
						'EMAIL'=>$row['email'],
						'LINKTIME'=>$row['linktime'],
						'SIDCARD'=>$row['sidcard'],
						'GRAEDU'=>$row['graedu'],
						'TRAIN'=>$row['train'],
						'WORK_EXP'=>$row['workexp'],
						'ENABLE'=>$row['enable'],
						'CONTEXT'=>$row['context'],
						'ADDTIME'=>$row['addtime'],
						'CLICK'=>$row['click'],
						'ZHUANYE'=>$zy1,
						'ZHUANYENAME'=>$zy2,
					)
				);
				unset($zy1,$zy2);
				$persex=$row['sex'];
				list($peryear,$permonth,$persay)=explode('-',$row['birth']);
				$permarry=$row['marry'];
				$peredu=$row['edu'];
				$perhukou=$row['hukou'];
				list($pernowjuzhudi,$perjuzhudi_2)=explode('-',$row['living']);
				$tpl->set_var('SELECT_JZD2',$perjuzhudi_2);
				unset($perjuzhudi,$perjuzhudi_2);
				$peryearsalary=$row['year_pay'];
				$perforyearsalary=$row['year_pay_for'];
				$perindustry=$row['industry'];
				list($perworkadd,$perworkadd2)=explode('-',$row['forliving']);
				$tpl->set_var('WORK_ADD',$perworkadd2);
				unset($perworkadd2);
			}
		}
		else if ($submit_hunter)
		{
			/*
			判断提供表单的信息是否为空值
			*/
			$birth=$year.'-'.$month.'-'.$day;
			$living=$living_1.'-'.$living_2;
			$forliving=$forliving_1.'-'.$forliving_2;
			$depart=$smajortype.'-'.$smajorname;
            $sql="update {$tablepre}hunter_per
                    set
                       truename='".html($truename)."',
                       year_pay='$year_pay',
                       industry='$industry',
                       year_pay_for='$year_pay_for',
                       position='".html($position)."',
                       for_position='".html($for_position)."',
                       mobile='".html($mobile)."',
                       address='".html($address)."',
                       phone='".html($phone)."',
                       code='".html($code)."',
                       email='".html($email)."',
                       linktime='".html($linktime)."',
                       sex='$sex',
                       birth='$birth',
                       sidcard='".html($sidcard)."',
                       marry='$marry',
                       hukou='$hukou',
                       living='$living',
                       forliving='$forliving',
                       edu='$edu',
                       graedu='".html($graedu)."',
                       depart='$depart',
                       train='$train',
                       workexp='".html($workexp)."',
                       enable='".html($enable)."',
                       context='".html($context)."',
                       losetime='".($addtime+$days*86400)."'
                    where id='$hunterid' and username='$wane_user'";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('猎头人才编辑失败');exit;}
			else
			{
				if ($html_perhunter=='1' && $RIGHT[sign_hunterfind]=='1')
				{
					$perhunter_name=$hunterid;
					$sql_data=array(
						'TRUENAME'=>html($truename),
						'INDUSTRY'=>$industry,
						'YEARSALARY'=>$year_pay,
						'FOR_YEARSALARY'=>$year_pay_for,
						'POSITION'=>html($position),
						'FOR_POSITION'=>html($for_position),
						'ADDTIME'=>date("Y-n-j",$addtime),
						'LOSETIME'=>date("Y-n-j",$addtime+$days*86400),
						'MOBILE'=>html($mobile),
						'HOMEPHONE'=>html($phone),
						'ADDRESS'=>html($address),
						'ZIPCODE'=>html($code),
						'EMAIL'=>html($email),
						'LINKTIME'=>html($linktime),
						'SEX'=>$sex,
						'BIRTH'=>$birth,
						'SID'=>html($sidcard),
						'MARRY'=>$marry,
						'HUKOU'=>$hukou,
						'LIVING'=>$living,
						'WORK_ADDR'=>$forliving,
						'EDU'=>$edu,
						'GRAEDU'=>html($graedu),
						'DEPART'=>$depart,
						'TRAIN'=>wane_text($train),
						'WORKEXP'=>wane_text($workexp),
						'TECHANG'=>wane_text($enable),
						'CONTEXT'=>wane_text($context),
						'CLICK'=>$click,
						'LINK'=>$perhunter_name,
						'INFOTITLE'=>'猎头人才 '.html($truename),
						'WEBTITLE'=>headtitle('猎头人才 '.html($truename))
					);
					require 'common/create_html.php';
					$c_html=new C_HTML;
					$c_html->c_perhunter('header.html',$default_perhunter,'footer.html',$perhunter_name,$dirhtml_perhunter,$perhunter_htmlroot,$sql_data,0);
					update_cache('hunterfind','0');
				}
				tpl_load('result');$result_title='猎头人才编辑成功';
				$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功编辑了你的猎头人才信息 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=managehunter>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('personal.php?action=managehunter','3');
			}
		}
		else if ($delete_hunter)
		{
			if ($delete=='')
			{
				echo clickback('请选择操作对象');exit;
			}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$sql=$db->query("select id,username,htmlroot from {$tablepre}hunter_per where id in ($ids) and username='$wane_user'");
				while ($row=$db->row($sql))
				{
					$hunter_file=$htmlroot.$dirhtml_perhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
					if (file_exists($hunter_file))	{delete_file($hunter_file);}
				}
				$query=$db->query("delete from {$tablepre}hunter_per where id in ($ids) and username='$wane_user'");
				if (!$query)	{echo clickback('删除失败');exit;}
				else
				{
					tpl_load('result');$result_title='猎头人才删除成功';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已成功删除了您选定的猎头人才信息 , 系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=managehunter>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					update_cache('hunterfind','0');
					echo showmsg('personal.php?action=managehunter','3');
				}
			}
		}
		else
		{//	personal hunter list
			$tpl->set_var('SELECTJS','<script src=\'css/check_all.js\'></script>');
			tpl_load('personal_managehunter');
			$str="username='$wane_user'";
			$str2="action=managehunter";
			$table=$tablepre.'hunter_per';
			$count='20';
			require 'common/page_count.php';
			$sql=$db->query("select * from $table where $str order by addtime desc limit $offset,$psize");
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($sql))
			{
				if ($row['sign']=='1')	{$status='<font color=\'#6699cc\'>显示</font>';}	else	{$status='<font color=\'#ff0000\'>隐藏</font>';}
				$tpl->set_var(
					array(
						'FINDID'=>$row['id'],
						'INDUSTRY'=>$row['for_position'],
						'CLICK'=>$row['click'],
						'STATUS'=>$status,
						'ADDTIME'=>date("Y-n-j",$row['addtime']),
						'LOSETIME'=>date("Y-n-j",$row['losetime']),
					)
				);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
		}
	}
	// END managehunter
	else if ($action=='teacher')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_teacher_job])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('个人用户控制面板 -> '.$lang_companycontrol[14]);
		if (perlogined()<='0')
		{
			$unlogined_info='个人用户登陆';
			require 'common/unlogined.php';
		}
		else if ($submit_teacherjob)
		{
            if (empty($title))	{echo clickback('标题不能为空');exit;}
			else if (empty($content))	{echo clickback('家教内容不能为空');exit;}
			else if (empty($address))	{echo clickback('家教地址不能为空');exit;}
			else if (empty($contact_name))	{echo clickback('联系人不能为空');exit;}
			else if (empty($contact_phone) && empty($email))	{echo clickback('联系方式不能为空');exit;}
			else
			{
				$addtime=time();
				$losetime=time()+$day*86400;
				$html_teacherjobdir=date($dirhtml_unit,time());
				$sql="insert into {$tablepre}teacher_job
					 (username,title,sex,edu,depart,content,context,address,contact_name,contact_phone,email,puttime,losetime,sign,htmlroot)
					 Values
					 ('$wane_user','".html($title)."','$sex','$edu','".html($depart)."','".html($content)."','".html($context)."','".html($address)."','".html($contact_name)."','".html($contact_phone)."','".html($email)."','$addtime','$losetime','".$RIGHT[sign_teacherjob]."','$html_teacherjobdir')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('发表失败');exit;}
				else
				{
					if ($html_findteacher=='1' && $RIGHT[sign_teacherjob]=='1')
					{
						$jobname=$db->query_id();
						require 'common/create_html.php';
						$c_html	=	new C_HTML;
						$sql_data=array(
							'INFOID'	=>	$jobname,
							'WEBTITLE'	=>	headtitle($title),
							'TITLE'		=>	$title,
							'SEX'		=>	$sex,
							'EDU'		=>	$edu,
							'ADDRESS'	=>	$address,
							'DEPART'	=>	$depart,
							'CONTENT'	=>	wane_text($content),
							'CONTEXT'	=>	wane_text($context),
							'CONTACT'	=>	$contact_name,
							'PHONE'		=>	$contact_phone,
							'EMAIL'		=>	$email,
							'ADDTIME'	=>	date($time_putteacher,$addtime),
							'LOSETIME'	=>	date($time_putteacher,$losetime),
							'CLICK'		=>	'0',
						);
						$c_html->c_teacherjob('header.html',$default_findteacher,'footer.html',$jobname,$dirhtml_findteacher,$html_teacherjobdir,$sql_data,'0');
						update_cache('teacherjob','0');
					}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您的操作已成功执行,系统将于 3 秒后自动返回<BR><BR><a href=personal.php>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php','3');
				}
			}
		}
		else
		{
			tpl_load('teacher_job');
		}
	}

	// END teacher
	else if ($action=='findteacher')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_teacher_find])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('个人用户控制面板 -> 家教求职');
		if (perlogined()<='0')
		{
			$unlogined_info='个人用户登陆';
			require 'common/unlogined.php';
		}
		else if ($submit_teacherfind)
		{
            if (empty($title))	{echo clickback('标题不能为空');exit;}
			else if (empty($truename)	||	empty($sex)	||	empty($edu)	||	empty($depart))	{echo clickback('简历不完整,请更新简历');exit;}
			else if (empty($phone) && empty($email))	{echo clickback('联系方式不能为空');exit;}
			else
			{
				$addtime=time();
				$losetime=time()+$day*86400;
				$html_teacherfinddir=date($dirhtml_unit,time());
				$sql="insert into {$tablepre}teacher_find
					 (username,title,truename,sex,edu,depart,living,job,context,phone,email,puttime,losetime,sign,htmlroot)
					 Values
					 ('$wane_user','".html($title)."','".html($truename)."','$sex','$edu','".html($depart)."','".html($living)."','".html($job)."','".html($context)."','".html($phone)."','".html($email)."','$addtime','$losetime','".$RIGHT[sign_teacherfind]."','$html_teacherfinddir')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('发表失败');exit;}
				else
				{
					if ($html_taketeacher=='1' && $RIGHT[sign_teacherfind]=='1')
					{
						$findname=$db->query_id();
						require 'common/create_html.php';
						$c_html	=	new C_HTML;
						$sql_data=array(

							'INFOID'	=>	$findname,
							'WEBTITLE'	=>	headtitle($title),

							'TITLE'		=>	$title,
							'TRUENAME'	=>	$truename,
							'SEX'		=>	$sex,
							'EDU'		=>	$edu,

							'DEPART'	=>	$depart,
							'LIVING'	=>	$living,
							'WORK'		=>	wane_text($job),
							'CONTEXT'	=>	wane_text($context),

							'PHONE'		=>	$phone,
							'EMAIL'		=>	$email,

							'ADDTIME'	=>	date($time_putteacher,$addtime),
							'LOSETIME'	=>	date($time_putteacher,$losetime),
							'CLICK'		=>	'0',

						);
						$c_html->c_teacherfind('header.html',$default_taketeacher,'footer.html',$findname,$dirhtml_taketeacher,$html_teacherfinddir,$sql_data,'0');
						update_cache('teacherfind','0');
					}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您的操作已成功执行,系统将于 3 秒后自动返回<BR><BR><a href=personal.php>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php','3');
				}
			}
		}
		else
		{
			$query=$db->query("select username,truename,sex,edu,zhuanye from {$tablepre}jianli where username='$wane_user'");
			if (!$db->num($query))	{echo clickback('您的简历不完整,请更新您的简历');exit;}
			else
			{
				$row=$db->row($query);
				$tpl->set_var(
					array(
						'TRUENAME'	=>	$row[truename],
						'SEX'		=>	$row[sex],
						'EDU'		=>	$row[edu],
						'ZHUANYE'	=>	$row[zhuanye],
					)
				);
			}
			tpl_load('teacher_find');
		}
	}
	// END findteacher
	else if ($action=='hunterreciver')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[hunter_rec])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 猎头收信箱');
		if ($delete_hrec)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("delete from {$tablepre}send_hunter_per where (id in ($ids) or info_id in ($ids))and rec='$wane_user'");
				if (!$query)	{echo clickback('删除收信箱失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除收信失败';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已经成功删除了你的收件箱信息！系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=hunterreciver>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=hunterreciver','3');
				}
			}
		}
		else
		{
			tpl_load('personal_hreciver');
			$tpl->set_var('SELECTJS','<script src=css/check_all.js></script>');
			$count='20';
			$c=$tablepre.'jianliqy';
			$r=$tablepre.'send_hunter_per';
			$h=$tablepre.'hunter_per';

			$sstr="$h.id,$h.for_position,$h.htmlroot,$c.qyuser,$c.qyname,$r.*";
			$str="$h.id=$r.find_id and $r.send=$c.qyuser and $r.rec='$wane_user'";
			$str2="action=hunterreciver";

			$table=$c.','.$h.','.$r;
			require 'common/page_count.php';
			$sql="select $sstr from $table where $str order by $r.id desc limit $offset,$psize";
			unset($c,$r,$sstr,$str,$table);
			$query=$db->query($sql);
			unset($sql);
			$tpl->set_block('main','reclist','reclists');
			while ($row=$db->row($query))
			{
				$htmlfile=$htmlroot.$dirhtml_perhunter.'/'.$row[htmlroot].'/'.$row[find_id].'.html';
				$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=hunterfind&info='.$row[find_id];
				$tpl->set_var(
					array(
						'NEW'		=>	!$row[isnew]	?	'NEW '	:	'',
						'JOBNAME'	=>	$row[for_position],
						'JOBLINK'	=>	$htmllink,
						'SENDLINK'	=>	urlencode($row[qyuser]),
						'REPLIES'	=>	$row[replies],
						'JOBSEND'	=>	$row[qyname],
						'ADDTIME'	=>	date("Y-n-j",$row[addtime]),
						'MAILID'	=>	$row[id]
					)
				);
				unset($row,$htmlfile,$htmllink);
				$tpl->parse('reclists','reclist',true);
			}
			$db->free_result($query);
			require 'common/page_show.php';
		}
	}
	// END hunter reciver
	elseif ($action=='huntersend')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[hunter_send])	{echo clickback($lang_right[1]);exit;}
		tpl_load('personal_hsend');
		$count='20';
		$s=$tablepre.'send_hunter_com';
		$c=$tablepre.'jianliqy';
		$j=$tablepre.'hunter_com';
		$sstr="$c.qyuser,$c.qyname,$j.id,$j.job,$j.htmlroot,$s.*";
		$str="$s.rec=$c.qyuser and $j.id=$s.job_id and $s.send='$wane_user'";
		$str2="action=huntersend";
		$table=$j.','.$c.','.$s;
		require 'common/page_count.php';
		$sql="select $sstr from $table where $str order by $s.id desc limit $offset,$psize";
		unset($s,$p,$sstr,$str,$table);
		$query=$db->query($sql);
		unset($sql);
		$tpl->set_block('main','sendlist','sendlists');
		while ($row=$db->row($query))
		{
			$htmlfile=$htmlroot.$dirhtml_comhunter.'/'.$row[htmlroot].'/'.$row[job_id].'.html';
			$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=hunterjob&info='.$row[job_id];
			$tpl->set_var(
				array(
					'MAILID'	=>	$row[id],
					'JOBLINK'	=>	$htmllink,
					'READ'		=>	!$row[isnew]	?	'<font color=\'#6699cc\'>否</font>'	:	'<font color=\'#ff0000\'>是</font>'	,
					'JOBNAME'	=>	$row[job],
					'COMPANY'	=>	$row[qyname],
					'SENDLINK'	=>	urlencode($row[qyuser]),
					'ADDTIME'	=>	date("Y-n-j",$row[addtime]),
					'REPLIES'	=>	$row[replies],
				)
			);
			unset($row,$htmlfile,$htmllink);
			$tpl->parse('sendlists','sendlist',true);
		}
		$db->free_result($query);
		require 'common/page_show.php';
	}
	//end hunter send
	elseif ($action=='hunterfavourite')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[hunter_fav])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 猎头收藏夹');
		if ($delete_hfav)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=",";
				}
				$query=$db->query("delete from {$tablepre}find_fav where id in ($ids) and user_id='$wane_user'");
				if (!$query)	{echo clickback('删除收藏夹失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除收藏夹失败';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已经成功删除了你的收藏夹信息！系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=hunterfavourite>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=hunterfavourite','3');
				}
			}
		}
		else
		{
			tpl_load('personal_hfavourite');
			$tpl->set_var('SELECTJS','<script src=css/check_all.js></script>');
			$count='20';
			$j=$tablepre.'hunter_com';
			$f=$tablepre.'find_fav';
			$c=$tablepre.'jianliqy';
			$table=$j.','.$c.','.$f;
			$sstr="$j.id,$j.username,$j.job,$j.htmlroot,$c.qyuser,$c.qyname,$f.id,$f.user_id,$f.find_id,$f.addtime";
			$str="$j.id=$f.find_id and $j.username=$c.qyuser and $f.user_id='$wane_user'";
			$str2="action=hunterfavourite";
			require 'common/page_count.php';
			$sql="select $sstr from $table where $str order by $f.id desc limit $offset,$psize";
			unset($j,$c,$f,$table,$sstr,$str);
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($query))
			{
				$htmlfile=$htmlroot.$dirhtml_comhunter.'/'.$row[htmlroot].'/'.$row[find_id].'.html';
				$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=hunterjob&info='.$row[find_id]	;
				$tpl->set_var(
					array(
						'INFOLINK'	=>	$htmllink,
						'JOBNAME'	=>	$row[job],
						'QYJIANLI'	=>	urlencode($row[qyuser]),
						'COMPANY'	=>	$row[qyname],
						'ADDTIME'	=>	date("Y-n-j H:i",$row[addtime]),
						'FAVID'		=>	$row[id]
					)
				);
				unset($htmlfile,$htmllink);
				$tpl->parse('lists','list',true);
			}
			$db->free_result($query);
			require 'common/page_show.php';
		}

	}
	// end favourite
	else if ($action=='reciver')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[job_rec])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 收信箱');
		if ($delete_reciver)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids = $comma = '';
				foreach($delete as $id)
				{
					$ids .= "$comma'$id'";
					$comma = ',';
				}
				$query=$db->query("delete from ".PERRECTABLE." where (id in ($ids) or info_id in ($ids)) and per_id='$wane_user'");
				if (!$query)	{echo clickback('删除收信失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除收信失败';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已经成功删除了你的收件箱信息！系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=reciver&page='.$HTTP_POST_VARS['delpage'].'>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=reciver&page='.$delpage,'3');
				}
			}
		}
		else
		{
			tpl_load('personal_reciver');
			$tpl->set_var('SELECTJS','<script src=css/check_all.js></script>');
			$count='20';
			$r=PERRECTABLE;
			$j=$tablepre.'findjob_chance';
			$c=$tablepre.'jianliqy';
			$table=$r.','.$j.','.$c;
			$sstr="$j.id,$j.username,$j.job,$j.htmlroot,$c.qyuser,$c.qyname,$r.id,$r.user_id,$r.per_id,$r.find_id,$r.addtime,$r.replies,$r.isnew";
			$str="$r.per_id='$wane_user' and $r.find_id=$j.id and $r.user_id=$c.qyuser";
			$str2='action=reciver';
			require 'common/page_count.php';
			$sql=$db->query("select $sstr from $table where $str order by $r.id desc limit $offset,$psize");
			$tpl->set_block('main','reclist','reclists');
			while ($row=$db->row($sql))
			{
				$infourlink=infourl($dirhtml_find,$row['htmlroot'],$row['find_id']);
				$tpl->set_var(
					array(
						'CURPAGE'	=>	$page,
						'NEW'		=>	!$row[isnew]	?	'NEW '	:	''	,
						'MAILID'	=>	$row['id'],
						'INFOURL'	=>	($infourlink!='0')?$infourlink:'view.php?action=showfind&info='.$row['find_id'],
						'JOBNAME'	=>	$new.$row['job'],
						'JOBSEND'	=>	$row['qyname'],
						'SENDLINK'	=>	urlencode($row['user_id']),
						'RERECNUM'	=>	$row[replies],
						'ADDTIME'	=>	date('Y-m-d H:i',$row['addtime']),
					)
				);
				$tpl->parse('reclists','reclist',true);
			}
			require 'common/page_show.php';
		}
	}
	// END reciver
	else if ($action=='send')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[job_send])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 发信箱');
		tpl_load('personal_send');
		$count='20';
		$s=PERSENDTABLE;
		$j=$tablepre.'job_chance';
		$c=$tablepre.'jianliqy';
		$table=$s.','.$j.','.$c;
		$sstr="$j.id,$j.job,$j.username,$j.htmlroot,$c.qyuser,$c.qyname,$s.id,$s.user_id,$s.job_id,$s.addtime,$s.replies,$s.isnew";
		$str="$s.user_id='$wane_user' and $s.job_id=$j.id and $j.username=$c.qyuser";
		$str2="action=send";
		require 'common/page_count.php';
		$sql=$db->query("select $sstr from $table where $str order by $s.id desc limit $offset,$psize");
		unset($s,$j,$c,$table,$sstr,$str);
		$tpl->set_block('main','sendlist','sendlists');
		while ($row=$db->row($sql))
		{
			$infourllink=infourl($dirhtml_job,$row['htmlroot'],$row['job_id']);
			$tpl->set_var(
				array(
					'ADDTIME'	=>	date('Y-n-j',$row['addtime']),
					'MAILID'	=>	$row['id'],
					'INFOURL'	=>	($infourllink!='0')?$infourllink:'view.php?action=showjob&info='.$row['job_id'],
					'SENDLINK'	=>	urlencode($row['com_id']),
					'RESENDNUM'	=>	$row[replies],
					'JOBNAME'	=>	$row['job'],
					'COMPANY'	=>	$row['qyname'],
					'READ'		=>	!$row[isnew]	?	'<font color=\'#6699cc\'>否</font>'	:	'<font color=\'#ff0000\'>是</font>',
				)
			);
			unset($infourllink);
			$tpl->parse('sendlists','sendlist',true);
		}
		unset($sql,$row);
		require 'common/page_show.php';
	}
	// END send
	else if ($action=='favourite')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[job_fav])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('控制面板  -> 收藏夹');
		if ($delete_fav)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids = $comma = '';
				foreach($delete as $id)
				{
					$ids .= "$comma'$id'";
					$comma = ',';
				}
				$query=$db->query("delete from ".FAVTABLE." where id in ($ids)");
				if (!$query)	{echo clickback('删除收藏夹失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除收藏夹成功';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您已经成功删除了你的收藏信息！系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=favourite&page='.$delpage.'>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php?action=favourite&page='.$delpage,'3');
				}
			}
		}
		else
		{
			tpl_load('personal_favourite');
			$tpl->set_var('SELECTJS','<script src=\'css/check_all.js\'></script>');
			$f=FAVTABLE;
			$j=$tablepre.'job_chance';
			$c=$tablepre.'jianliqy';
			$count='20';
			$sstr="$j.id,$j.job,$j.htmlroot,$f.id,$f.user_id,$f.job_id,$f.addtime,$c.qyuser,$c.qyname";
			$str="$f.user_id='$wane_user' and $j.id=$f.job_id and $j.username=$c.qyuser";
			$str2="action=favourite";
			$table=$f.','.$j.','.$c;
			require 'common/page_count.php';
			$sql=$db->query("select $sstr from $table where $str order by $f.addtime desc limit $offset,$psize");
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($sql))
			{
				$jobfile=$htmlroot.$dirhtml_job.'/'.$row[htmlroot].'/'.$row[job_id].'.html';
				$job_link=(file_exists($jobfile))	?	$jobfile	:	'view.php?action=showjob&info='.$row['job_id'];
				$tpl->set_var(
					array(
						'JOBNAME'	=>	$row['job'],
						'COMPANY'	=>	$row['qyname'],
						'QYJIANLI'	=>	urlencode($row['qyuser']),
						'INFOLINK'	=>	$job_link,
						'ADDTIME'	=>	date("Y-n-j",$row['addtime']),
						'FAVID'		=>	$row['id'],
						'CURPAGE'	=>	$page,
					)
				);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
		}
	}
	// END favourite
	else if ($action=='chpwd')
	{
		$headtitle=headtitle('控制面板  -> 修改密码');
		if ($save_pwd)
		{
			if ($oripass=='')	{echo clickback('原始密码不能空');exit;}
			else if (md5($oripass)!=$wane_pass)	{echo clickback('原始密码不正确');exit;}
			else
			{
				if (($pass!='' || $repass!='') && $pass!=$repass)	{echo clickback('验证密码不正确');exit;}
				else if ($pass=='' && $repass=='') {$passdata='';}
				else	{$passdata=" password='".md5(html($pass))."' ,";}
				if ($answer!='')	{$answerdate=",answer='".html($answer)."'";}	else {$answerdate='';}
				$sql="UPDATE ".USERTABLE." SET ".$passdata." email='".html($email)."',question='".html($question)."' $answerdate where username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('修改密码失败');exit;}
				else
				{
					if (!empty($passdata))
					{
						require 'common/password_class.php';
						$chpass	=	new	wane_password;
						$chpass	->	password_wane($wane_user,md5(html($pass)));
					}
					tpl_load('result');
					$result_title='资料修改成功';
					$result_info='恭喜您   '.$wane_user.' <BR><BR>您成功修改了你的资料,系统将于 3 秒后自动返回<BR><BR><a href=personal.php?action=chpwd>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('personal.php','3');
				}
			}
		}
		else
		{
			tpl_load('personal_chpwd');
			$sql="select * from ".USERTABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$tpl->set_var(
				array(
					'LOGINUSERNAME'		=>	$row['username'],
					'EMAIL'				=>	$row['email'],
					'QUESTION'			=>	$row['question'],
					'LOGINS'			=>	$row['logins'],
					'REGTIME'			=>	date("Y-n-j",$row['regtime']),
				)
			);
		}
	}
	// END
	else
	{
		tpl_load('personal');
		$headtitle=headtitle($webtitle.' -> 控制面板');
		require 'common/main_personal.php';
	}
	//+---------------------
	//+	out put end
	//+---------------------
	require_once 'common/common.php';
	require_once 'common/percp.php';
	require 'common/lang/lang_personal.php';
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