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
	if (comlogined()<='0')
	{
		$headtitle=headtitle($webtitle.' -> 企业用户控制面板');
		$unlogined_info='企业用户登陆';
		require 'common/unlogined.php';
	}
	elseif (!$db->num($db->query("select m.username,c.qyuser from {$tablepre}member m,{$tablepre}jianliqy c where m.username=c.qyuser and m.username='$wane_user'")))
	{
		$db->query("INSERT INTO {$tablepre}jianliqy (qyuser,lastupdate) values ('$wane_user','".time()."')");
		echo showmsg('company.php','0');exit;
	}
	else if ($action=='basicinfo')
	{
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[1]);
		if ($save)
		{
			if ($qyname=='')	{echo clickback('企业名称不能为空');exit;}
			else
			{
				$sql="UPDATE ".QYJIANLITABLE."
						SET
							qyname='".html($qyname)."',
							qyaddress='".html($qyaddress)."',
							qypro='$qypro',
							qykind='$qykind',
							qyman='$qyman',
							contact_name='".html($contact_name)."',
							qyphone='".html($qyphone)."',
							qyemail='".html($qyemail)."',
							qyyoubian='".html($qyyoubian)."',
							qyweb='".html($qyweb)."',
							qyjianjie='".html($context)."',
							lastupdate='".time()."'
						WHERE
							qyuser='$wane_user'";

				$query=$db->query($sql);
				if (!$query)	{echo clickback('操作失败');exit;}
				else
				{
					tpl_load('result');
					if ($shownewcom)
					{
						update_cache('companys','0');
					}
					$result_title='操作成功';
					$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=basicinfo>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
				}
			}
		}
		else
		{
			tpl_load('company_basicinfo');
			$sql=$db->query("select * from ".QYJIANLITABLE." where qyuser='$wane_user'");
			$row=$db->row($sql);
			$compropertion=$row['qypro'];
			$combelong=$row['qykind'];
			$comspace=$row['qyman'];
			$tpl->set_var(
				array(
					'QYNAME'		=>	$row['qyname'],
					'QYADDRESS'		=>	$row['qyaddress'],
					'CONTACT_NAME'	=>	$row['contact_name'],
					'QYPHONE'		=>	$row['qyphone'],
					'QYEMAIL'		=>	$row['qyemail'],
					'QYYOUBIAN'		=>	$row['qyyoubian'],
					'QYWEB'			=>	$row['qyweb'],
					'CONTEXT'		=>	$row['qyjianjie'],
				)
			);
		}
	}
	//+END QY JIANLI
	else if ($action=='myphoto')
	{
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[2]);
		if ($save)
		{
			$imgurl=upload_img($HTTP_POST_FILES['userfile']['name'],$HTTP_POST_FILES['userfile']['tmp_name'],'./qy_img');
			if ($imgurl!='0')
			{
				$sql="UPDATE ".QYJIANLITABLE." set qy_img='$imgurl',lastupdate='".time()."' where qyuser='$wane_user'";
				$query=$db->query($sql);
				if (!$query)
				{
					@delete_file($imgurl);
					echo clickback('操作失败');exit;
				}
				else
				{
					if ($shownewcom)
					{
						update_cache('companys','0');
					}
					if (file_exists(delimg))	{@delete_file($delimg);}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了你的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=myphoto>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=myphoto','3');
				}
			}
			else
			{
				echo clickback('图片上传失败');exit;
			}
		}
		else
		{
			tpl_load('company_myphoto');
			$sql=$db->query("select qyuser,qy_img from ".QYJIANLITABLE." where qyuser='$wane_user'");
			$row=$db->row($sql);
			$qyimg=$row['qy_img'];
			if ($qyimg!='' && file_exists($qyimg))
			{
				$tpl->set_var('DELIMG',$qyimg);
				$imgsize=getimagesize($qyimg);
				if ($imgsize[0]>='500')
				{
					$size="width='500' height='400'";
				}
				else
				{
					$size='';
				}
				$tpl->set_var('UPLOADED_IMG','<a href='.$qyimg.' target=\'_blank\'><IMG SRC='.$qyimg.' '.$size.' border=\'0\' class=\'input\'></a>');
			}
			else
			{
				$tpl->set_var('DELIMG','');
				$tpl->set_var('UPLOADED_IMG','NO PHOTO');
			}
			}
	}
	// END QY PHOTO
	else if ($action=='registerschool')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_school])	{echo clickback($lang_right[1]);exit;}

		$table=$tablepre.'pxschool';
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[4]);
		if ($db->num($db->query("select username from $table where username='$wane_user'"))>='1')
		{
			tpl_load('result');
			$result_title='注册出错';
			$result_info='很抱歉  '.$wane_user.' ! <BR><BR>您已注册过培训学校,不能重复注册,系统将于 3 秒后转入管理页面<BR><BR><a href=company.php?action=manageschool>立即转到管理页面</a>';
			$tpl->set_var('RESULT_TITLE',$result_title);
			$tpl->set_var('RESULT_INFO',$result_info);
			echo showmsg('company.php?action=manageschool','3');
		}
		else if ($submit_registerschool)
		{
			if ($sname=='')	{echo clickback('学校名称不能为空');exit;}
			else if ($schkind=='0')	{echo clickback('请选择学校类别');exit;}
			else if ($address=='')	{echo clickback('学校地址不能为空');exit;}
			else if ($code=='' && !is_numeric($code) && strlen($code)!='6')	{echo clickback('邮政编码必须是 6 位数阿拉伯数字');}
			else if ($contact_name=='')	{echo clickback('联系人不能为空');exit;}
			else if ($contact_phone=='')	{echo clickback('联系人不能为空');exit;}
			else
			{
				$sql="insert into $table
					 (username,schkind,sname,context,content,sign_content,contact_name,contact_phone,fax,address,code,email,url,addtime,sign)
					 Values
					 ('$wane_user','$schkind','".html($sname)."','".html($context)."','".html($content)."','".html($sign_content)."','".html($contact_name)."','".html($contact_phone)."','".html($fax)."','".html($address)."','".html($code)."','".html($email)."','".html($url)."','".time()."','".$RIGHT[sign_school]."')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('注册培训学校失败');exit;}
				else
				{
					if ($html_school=='1' && $RIGHT[sign_school]=='1')
					{
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$sql_data=array(
							'WEBTITLE'	=>	headtitle($sname),
							'LINK'		=>	$db->query_id(),
							'SNAME'		=>	$sname,
							'CONTEXT'	=>	wane_text(html($context)),
							'CONTENT'	=>	wane_text(html($content)),
							'SIGN_CONTENT'	=>	wane_text(html($sign_content)),
							'CONTACT'	=>	html($contact_name),
							'PHONE'		=>	html($contact_phone),
							'FAX'		=>	html($fax),
							'ADDRESS'	=>	html($address),
							'CODE'		=>	html($code),
							'EMAIL'		=>	html($email),
							'URL'		=>	html($url),
							'CLICK'		=>	'0'
						);
						$c_html->c_school('header.html',$default_school,'footer.html',md5($wane_user),$dirhtml_school,'',$sql_data,0);
						update_cache('schools','0');
					}
					tpl_load('result');
					$result_title='注册培训学校成功';
					$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功注册了培训学校,系统将于 3 秒后转入管理页面<BR><BR><a href=company.php?action=manageschool>立即转到管理页面</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=manageschool','3');
				}
			}
		}
		else
		{
			tpl_load('company_registerschool');
			$tpl->set_var('SELECT_SCHOOL',select_school());
		}
	}
	//END REGISTER SCHOOL
	else if ($action=='manageschool')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_school])	{echo clickback($lang_right[1]);exit;}
		$table=$tablepre.'pxschool';
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[5]);
		$query_check=$db->query("select * from $table where username='$wane_user'");
		if ($db->num($query_check)<='0')
		{
			tpl_load('result');
			$result_title='管理出错';
			$result_info='很抱歉  '.$wane_user.' ! <BR><BR>您尚未注册过培训学校,请先注册培训学校,系统将于 3 秒后转入注册页面<BR><BR><a href=company.php?action=registerschool>立即转到注册页面</a>';
			$tpl->set_var('RESULT_TITLE',$result_title);
			$tpl->set_var('RESULT_INFO',$result_info);
			echo showmsg('company.php?action=registerschool','3');
		}
		else if ($submit_manageschool)
		{
			if ($sname=='')	{echo clickback('学校名称不能为空');exit;}
			else if ($schkind=='0')	{echo clickback('请选择学校类别');exit;}
			else if ($address=='')	{echo clickback('学校地址不能为空');exit;}
			else if ($code=='' && !is_numeric($code) && strlen($code)!='6')	{echo clickback('邮政编码必须是 6 位数阿拉伯数字');}
			else if ($contact_name=='')	{echo clickback('联系人不能为空');exit;}
			else if ($contact_phone=='')	{echo clickback('联系人不能为空');exit;}
			else
			{
				$sql="update $table
						set
						   schkind='$schkind',
						   sname='".html($sname)."',
						   context='".html($context)."',
						   content='".html($content)."',
						   sign_content='".html($sign_content)."',
						   contact_name='".html($contact_name)."',
						   contact_phone='".html($contact_phone)."',
						   fax='".html($fax)."',
						   address='".html($address)."',
						   code='".html($code)."',
						   email='".html($email)."',
						   url='".html($url)."'
						where id='$schid' and username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('编辑培训学校失败');exit;}
				else
				{
					if ($html_school=='1' && $RIGHT[sign_school]=='1')
					{
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$sql_data=array(
							'WEBTITLE'	=>	headtitle(html($sname)),
							'LINK'		=>	$schid,
							'SNAME'		=>	html($sname),
							'CONTEXT'	=>	wane_text($context),
							'CONTENT'	=>	wane_text($content),
							'SIGN_CONTENT'	=>	wane_text($sign_content),
							'CONTACT'	=>	html($contact_name),
							'PHONE'		=>	html($contact_phone),
							'FAX'		=>	html($fax),
							'ADDRESS'	=>	html($address),
							'CODE'		=>	html($code),
							'EMAIL'		=>	html($email),
							'URL'		=>	html($url),
							'CLICK'		=>	html($click)
						);
						$c_html->c_school('header.html',$default_school,'footer.html',md5($wane_user),$dirhtml_school,'',$sql_data,0);
						update_cache('schools','0');
					}
					tpl_load('result');
					$result_title='编辑培训学校成功';
					$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功编辑了培训学校,系统将于 3 秒后转入管理页面<BR><BR><a href=company.php?action=manageschool>立即转到管理页面</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=manageschool','3');
				}
			}
		}
		else
		{
			tpl_load('company_manageschool');
			$row=$db->row($query_check);
			$tpl->set_var(
				array(
					'SCHID'			=>	$row['id'],
					'SELECT_SCHOOL'	=>	select_school($row['schkind']),
					'SNAME'			=>	$row['sname'],
					'CONTEXT'		=>	$row['context'],
					'CONTENT'		=>	$row['content'],
					'SIGN_CONTENT'	=>	$row['sign_content'],
					'CONTACT_NAME'	=>	$row['contact_name'],
					'CONTACT_PHONE'	=>	$row['contact_phone'],
					'FAX'			=>	$row['fax'],
					'ADDRESS'		=>	$row['address'],
					'CODE'			=>	$row['code'],
					'EMAIL'			=>	$row['email'],
					'URL'			=>	$row['url'],
					'CLICK'			=>	$row[click]
				)
			);
		}
	}
	//END MANAGE SCHOOL
	else if ($action=='closeschool')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_school])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[6]);
		if ($close=='on')
		{
			$select=$db->query("select * from {$tablepre}job_peixun where username='$wane_user'");
			while ($row_px=$db->row($select))
			{
				$deletefile=$htmlroot.$dirhtml_lesson.'/'.$row_px['htmlroot'].'/'.$row_px['id'].'.html';
				if (file_exists($deletefile))
				{
					delete_file($deletefile);
				}
			}
			$delete_lesson=$db->query("delete from {$tablepre}job_peixun where username='$wane_user'");
			if (!$delete_lesson)
			{
				tpl_load('result');
				$result_title='注销培训学校失败';
				$result_info='很抱歉  '.$wane_user.' ! <BR><BR>注销培训学校失败,请稍后再试,系统将于 3 秒后自动返回<BR><BR><a href=\'javascript:history.go(-1)\'>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('javascript:history.go(-1)','3');
			}
			else
			{
				$query=$db->query("select * from {$tablepre}pxschool where username='$wane_user'");
				$row=$db->row($query);
				$schoolfile=$htmlroot.$dirhtml_school.'/'.$row['htmlroot'].'/'.md5($wane_user).'.html';
				$delete_school=$db->query("delete from {$tablepre}pxschool where username='$wane_user'");
				if (!$delete_school)
				{
					tpl_load('result');
					$result_title='注销培训学校失败';
					$result_info='您好  '.$wane_user.' ! <BR><BR>您已成功删除了所有发表过的培训信息,培训学校学校删除失败,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=closeschool>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=closeschool','3');
				}
				else
				{
					if (file_exists($schoolfile))	{delete_file($schoolfile);}
					tpl_load('result');
					$result_title='注销培训学校成功';
					$result_info='您好  '.$wane_user.' ! <BR><BR>您已成功删除你已注册的培训学校和所有发表过的培训信息,系统将于 3 秒后自动返回<BR><BR><a href=company.php>立即返回</a>';
					update_cache('schools','0');
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
				}
			}
		}
		else
		{
			tpl_load('result');
			$result_title='注销培训学校';
			$result_info='您好  '.$wane_user.' ! <BR><BR><font color=\'#ff0000\'>此步操作将删除你已注册的培训学校和所有发表过的培训信息</font><BR><BR><a href=company.php?action=closeschool&close=on>确定注销</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\'javascript:history.go(-1)\'>放弃操作</a>';
			$tpl->set_var('RESULT_TITLE',$result_title);
			$tpl->set_var('RESULT_INFO',$result_info);
		}
	}
	//END CLOSE SCHOOL
	else if ($action=='puthunter')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_hunter_job])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[8]);
		if ($submit_puthunter)
		{
			if ($job=='' || $job_address=='' || $job_text=='')	{echo clickback($lang_putcomhunter[0]);exit;}
			$losetime=time()+86400*$days;
			$comhunter_folder=date($dirhtml_unit,time());
			$sql="INSERT INTO ".HUNTERJOB." (username,job,job_text,job_address,addtime,losetime,sign,htmlroot) VALUES ('$wane_user','".html($job)."','".html($job_text)."','".html($job_address)."','".time()."','$losetime','".$RIGHT[sign_hunterjob]."','$comhunter_folder')";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('操作失败');exit;}
			else
			{
				if ($html_comhunter=='1' && $RIGHT[sign_hunterjob]=='1')
				{
					$query_com=$db->query("select * from {$tablepre}jianliqy where qyuser='$wane_user'");
					$row_com=$db->row($query_com);
					$comhunter_name=$db->query_id();
					require 'common/create_html.php';
					$c_html = new C_HTML;
					$sql_data=array(
						'WEBTITLE'=>headtitle($row_com['qyname'].' 招聘猎头人才 '.html($job)),
						'INFOTITLE'=>$row_com['qyname'].' 招聘猎头人才 '.html($job),
						'CLICK'=>'0',
						'JOB'=>html($job),
						'JOB_ADDRESS'=>html($job_address),
						'JOB_TEXT'=>wane_text($job_text),
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
						'ADDTIME'=>date("Y-n-j",time()),
						'LOSETIME'=>date("Y-n-j",(time()+$days*86400)),
						'LINK'=>$comhunter_name
					);
					$c_html->c_comhunter('header.html',$default_comhunter,'footer.html',$comhunter_name,$dirhtml_comhunter,$comhunter_folder,$sql_data,0);
					update_cache('hunterjob','0');
				}
				tpl_load('result');
				$result_title='操作成功';
				$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managehunter>立即返回</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('company.php?action=managehunter','3');
			}
		}
		else if ($submit_exithunter)
		{
			echo showmsg('company.php?action=basicinfo','0');
			exit;
		}
		else
		{
			tpl_load('company_puthunter');
			$sql=$db->query("select * from ".QYJIANLITABLE." where qyuser='$wane_user'");
			$row=$db->row($sql);
			$qyname=$row['qyname'];
			$contact_name=$row['contact_name'];
			$qyphone=$row['qyphone'];
			$qyemail=$row['qyemail'];
			$qyaddress=$row['qyaddress'];
			$qyyoubian=$row['qyyoubian'];
			$qypro=$row['qypro'];

			if ($qyaddress!='')	{$tpl->set_var('QY_ADDRESS',$qyaddress);$sign_qyaddress='1';}
			else	{$tpl->set_var('QY_ADDRESS','<font color=\'#ff0000\'>无资料</font>');$sign_qyaddress='0';}

			if ($qyyoubian!='')	{$tpl->set_var('QY_ZIPCODE',$qyyoubian);$sign_qyyoubian='1';}
			else	{$tpl->set_var('QY_ZIPCODE','<font color=\'#ff0000\'>无资料</font>');$sign_qyyoubian='0';}

			if ($qypro!='')	{$tpl->set_var('QY_KIND',$qypro);$sign_qypro='1';}
			else	{$tpl->set_var('QY_KIND','<font color=\'#ff0000\'>无资料</font>');$sign_qypro='0';}

			if ($qyname!='')
			{$tpl->set_var('COMPANY',$qyname);$sign_qyname='1';}
			else
			{$tpl->set_var('COMPANY','<font color=\'#ff0000\'>无资料</font>');$sign_qyname='0';}

			if ($contact_name!='')	{$tpl->set_var('CONTACT_NAME',$contact_name);$sign_contact_name='1';}
			else	{$tpl->set_var('CONTACT_NAME','<font color=\'#ff0000\'>无资料</font>');$sign_contact_name='0';}

			if ($qyphone!='' && $qyemail!='')
			{$tpl->set_var('CONTACT','PHONE :'.$qyphone.'<BR>E - mail:'.$qyemail);$sign_contact='1';}
			else {$tpl->set_var('CONTACT','<font color=\'#ff0000\'>无资料</font>');$sign_contact='0';}

			if ($sign_qyaddress=='0' ||  $sign_qyyoubian=='0' ||  $sign_qypro=='0' ||  $sign_qyname=='0' ||  $sign_contact_name=='0' ||  $sign_contact=='0')
			{
				$tpl->set_var('PUTJOB_NAME','submit_exithunter');$tpl->set_var('PUTJOB_VALUE','资料不完整');
			}
			else
			{
				$tpl->set_var('PUTJOB_NAME','submit_puthunter');$tpl->set_var('PUTJOB_VALUE', '提 交' );
			}
		}
	}
	//END PUT HUNTER
	else if ($action=='managehunter')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_hunter_job])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[9]);
		if ($delete_hunter)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$comma=$ids='';
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=',';
				}
				$sql=$db->query("select * from {$tablepre}hunter_com where id in ($ids) and username='$wane_user'");
				while ($row=$db->row($sql))
				{
					$hunter_file=$htmlroot.$dirhtml_comhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';
					if (file_exists($hunter_file))	{delete_file($hunter_file);}
				}
				$query=$db->query("delete from {$tablepre}hunter_com where id in ($ids) and username='$wane_user'");
				if (!$query)	{echo clickback('删除失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您删除了选定的信息,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managehunter>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=managehunter','3');
				}
			}
		}
		else if ($submit_edithunter)
		{
			if ($job=='' || $job_address=='' || $job_text=='')	{echo clickback($lang_putcomhunter[0]);exit;}
			else
			{
				$losetime=$job_add+86400*$days;
				$sql="UPDATE ".HUNTERJOB." SET job='".html($job)."',job_text='".html($job_text)."',job_address='".html($job_address)."',losetime='$losetime' WHERE id='$job_id' and username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback($lang_putcomhunter[4]);exit;}
				else
				{
					if ($html_comhunter=='1' && $RIGHT[sign_hunterjob]=='1')
					{
						$query_com=$db->query("select * from {$tablepre}jianliqy where qyuser='$wane_user'");
						$row_com=$db->row($query_com);
						$comhunter_name=$job_id;
						require 'common/create_html.php';
						$c_html = new C_HTML;
						$sql_data=array(
							'WEBTITLE'=>headtitle($row_com['qyname'].' 招聘猎头职位 '.html($job)),
							'INFOTITLE'=>$row_com['qyname'].' 招聘猎头职位 '.html($job),
							'CLICK'=>$click,
							'JOB'=>html($job),
							'JOB_ADDRESS'=>html($job_address),
							'JOB_TEXT'=>wane_text($job_text),
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
							'ADDTIME'=>date("Y-n-j",$job_add),
							'LOSETIME'=>date("Y-n-j",$losetime),
							'LINK'=>$comhunter_name
						);
						$c_html->c_comhunter('header.html',$default_comhunter,'footer.html',$comhunter_name,$dirhtml_comhunter,$comhunter_folder,$sql_data,0);
						update_cache('hunterjob','0');
					}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managehunter>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=managehunter','3');
				}
			}
		}
		else if (is_numeric($info))
		{
			$sql="select * from ".HUNTERJOB." where id='$info' and username='$wane_user'";
			$query=$db->query($sql);
			$num=$db->num($query);
			if ($num<='0')	{echo clickback('你无编辑权限');exit;}
			else
			{
				tpl_load('company_puthunter_edit');
				$row=$db->row($query);
				$tpl->set_var(
					array(
						'JOB_ID'			=>	$row['id'],
						'JOB'				=>	$row['job'],
						'JOB_ADDRESS'		=>	$row['job_address'],
						'JOB_TEXT'			=>	$row['job_text'],
						'JOB_ADD'			=>	$row['addtime'],
						'JOB_LOSE'			=>	date('Y-n-j',$row['losetime']),
						'CLICK'				=>	$row['click'],
						'COMHUNTER_FOLDER'=>$row['htmlroot']
					)
				);
			}
		}
		else
		{
			tpl_load('company_managehunter');
			$tpl->set_var("SELECTJS","<script src='css/check_all.js'></script>");
			$count='20';
			$str="username='$wane_user'";
			$str2="action=managehunter";
			$table=HUNTERJOB;
			require 'common/page_count.php';
			$sql="select * from $table where $str order by id desc limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($query))
			{
				$linkfile=$htmlroot.$dirhtml_comhunter.'/'.$row[htmlroot].'/'.$row[id].'.html';
				$joblink=file_exists($linkfile)	?	$linkfile	:	'view.php?action=hunterjob&info='.$row[id];
				$tpl->set_var(
					array(
						'JOB_LINK'	=>	$joblink,
						'INFOID'	=>	$row['id'],
						'JOB'		=>	$row['job'],
						'CLICK'		=>	$row['click'],
						'STATUS'	=>	($row['sign'] ? '<font color=\'#6699cc\'>显示</font>' : '<font color=\'#ff0000\'>隐藏</font>'),
						'ADDTIME'	=>	date('Y-n-j',$row['addtime']),
						'LOSETIME'	=>	($row['losetime']>time() ? date('Y-n-j',$row['losetime']) : '<font color=\'#ff0000\'>过期</font>')
					)
				);
				unset($linkfile,$joblink);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
		}
	}
	//END MANAGE HUNTER
	else if ($action=='putpeixun')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_lesson])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[10]);
		if (!$db->num($db->query("select username from {$tablepre}pxschool where username='$wane_user'")))
		{
			tpl_load('result');
			$result_title='发表培训出错';
			$result_info='很抱歉 '.$wane_user.' <BR><BR>您尚未注册培训学校,不能发表培训信息;系统将于 3 秒后转向注册学校页面<BR><BR><a href=company.php?action=registerschool>立即转入注册培训学校页面</a>';
			$tpl->set_var('RESULT_TITLE',$result_title);
			$tpl->set_var('RESULT_INFO',$result_info);
			echo showmsg('company.php?action=registerschool','3');
		}
		else if ($submit_peixun && $HTTP_SERVER_VARS['REQUEST_METHOD']=='POST')
		{
			if (empty($lesson))	{echo clickback('课程名称名称不能空');exit;}
			else if ($leixing=='0')	{echo clickback('请选择课程类型');exit;}
			else if (empty($year1)	|| empty($year2) || !is_numeric($year1) || !is_numeric($year2) || $year1<date("Y") || $year2<date("Y"))	{echo clickback('开课日期不合法');exit;}
			else if (empty($class_time))	{echo clickback('上课时间不能空');exit;}
			else if (empty($address))	{echo clickback('上课地点不能为空');exit;}
			else if (empty($money))	{echo clickback('培训费用不能空');exit;}
			else if (empty($classs))	{echo clickback('学时不能为空');exit;}
			else if (empty($teacher))	{echo clickback('培训讲师不能为空');exit;}
			else if (empty($year) || !is_numeric($year) || $year<date("Y"))	{echo clickback('报名截至时间不合法');}
			else if (empty($contact_name))	{echo clickback('联系人不能为空');exit;}
			else if (empty($contact_phone))	{echo clickback('联系电话不能为空');exit;}
			else if (empty($content))	{echo clickback('培训内容不能为空');exit;}
			else
			{
				$classdate=$year1.'.'.$month1.'.'.$day1.'--'.$year2.'.'.$month2.'.'.$day2;
				$losetime=mktime(23,59,59,$month,$day,$year);
				$peixunhtmlroot=date($dirhtml_unit,time());
				$sql="insert into {$tablepre}job_peixun
					 (username,lesson,leixing,start_time,class_time,address,classs,teacher,money,direction,content,context,contact_name,contact_phone,fax,email,url,puttime,losetime,sign,htmlroot)
					 Values
					 ('$wane_user','".html($lesson)."','$leixing','$classdate','".html($class_time)."','".html($address)."','".html($classs)."','".html($teacher)."','".html($money)."','".html($direction)."','".html($content)."','".html($context)."','".html($contact_name)."','".html($contact_phone)."','".html($fax)."','".html($email)."','".html($url)."','".time()."','$losetime','".$RIGHT[sign_lesson]."','$peixunhtmlroot')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('发表培训失败');exit;}
				else
				{
					if ($html_lesson=='1' && $RIGHT[sign_lesson]=='1')
					{
						$schoolfile=$htmlroot.$dirhtml_school.'//'.md5($wane_user).'.html';
						$school_link=(file_exists($schoolfile))	?	$schoolfile	:	'view.php?action=school&info='.urlencode($wane_user);
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$pxhtml_name=$db->query_id();
						$lesson_type=$db->row($db->query("select id,title from {$tablepre}job_peixunkind where id='$leixing'"));
						$school_name=$db->row($db->query("select username,sname from {$tablepre}pxschool where username='$wane_user'"));
						$sql_data=array(
							'LINK'	=>	$pxhtml_name,
							'SCHOOL_LINK'	=>	$school_link,
							'WEBTITLE'=>	headtitle(html($lesson)),
							'CLICK'	=>	'0',
							'LESSON'	=>	html($lesson),
							'LESSON_TYPE'	=>	$lesson_type[title],
							'LESSON_SCHOOL'	=>	$school_name[sname],
							'LESSON_START'	=>	$classdate,
							'LESSON_BEGIN'	=>	html($class_time),
							'LESSON_MONEY'	=>	html($money),
							'LESSON_CLASSES'	=>	html($classs),
							'LESSON_LEADER'	=>	html($teacher),
							'LESSON_ADDRESS'	=>	html($address),
							'ADDTIME'	=>	date("Y-n-j",time()),
							'LOSETIME'	=>	($losetime>time())	?	date("Y-n-j",$losetime):'<font color=\'#ff0000\'>过期</font>',
							'CONTACT'	=>	html($contact_name),
							'PHONE'	=>	html($contact_phone),
							'EMAIL'	=>	html($email),
							'FAX'	=>	html($fax),
							'URL'	=>	html($url),
							'DIREACTION'	=>	wane_text($direction),
							'CONTENT'	=>	wane_text($content),
							'CONTEXT'	=>	wane_text($context),
						);
						$c_html->c_lesson('header.html',$default_lesson,'footer.html',$pxhtml_name,$dirhtml_lesson,$peixunhtmlroot,$sql_data,0);
						update_cache('lessons','0');
					}
					tpl_load('result');
					$result_title='发表培训课程成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功发表了培训信息;系统将于 3 秒后转向管理培训页面<BR><BR><a href=company.php?action=managepeixun>立即转入管理培训页面</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=managepeixun','3');
				}
			}
		}
		else
		{
			tpl_load('company_putpeixun');
			$tpl->set_var('LESSON_KIND'	,select_lesson('',0));
		}
	}
	//END PUT PEIXUN
	else if ($action=='managepeixun')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_lesson])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[11]);
		if (comlogined()<='0')
		{
			$unlogined_info='企业用户登陆';
			require 'common/unlogined.php';
		}
		else if ($delete_peixun)
		{
			if ($delete=='')	{echo clickback('请选择操作对象');exit;}
			else
			{
				$ids=$comma="";
				foreach($delete as $id)
				{
					$ids.="$comma'$id'";
					$comma=',';
				}
			}
			$table=$tablepre.'job_peixun';
			$sql=$db->query("select id,htmlroot from $table where id in ($ids) and username='$wane_user'");
			while ($row=$db->row($sql))
			{
				$lessonfile=$htmlroot.$dirhtml_lesson.'/'.$row[htmlroot].'/'.$row[id].'.html';
				if (file_exists($lessonfile))
				{
					delete_file($lessonfile);
				}
			}
			$query=$db->query("delete from $table where id in ($ids) and username='$wane_user'");
			if (!$query)	{echo clickback('删除失败');exit;}
			else
			{
				tpl_load('result');
				$result_title='删除培训信息成功';
				$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功删除了选定的培训信息;系统将于 3 秒后转向培训管理页面<BR><BR><a href=company.php?action=managepeixun>立即转入培训管理页面</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				update_cache('lessons','0');
				echo showmsg('company.php?action=managepeixun','3');
			}
		}
		else if ($submit_peixun_edit)
		{
			if (empty($lesson))	{echo clickback('课程名称名称不能空');exit;}
			else if ($leixing=='0')	{echo clickback('请选择课程类型');exit;}
			else if (empty($year1)	|| empty($year2) || !is_numeric($year1) || !is_numeric($year2) || $year1<date("Y") || $year2<date("Y"))	{echo clickback('开课日期不合法');exit;}
			else if (empty($class_time))	{echo clickback('上课时间不能空');exit;}
			else if (empty($address))	{echo clickback('上课地点不能为空');exit;}
			else if (empty($money))	{echo clickback('培训费用不能空');exit;}
			else if (empty($classs))	{echo clickback('学时不能为空');exit;}
			else if (empty($teacher))	{echo clickback('培训讲师不能为空');exit;}
			else if (empty($year) || !is_numeric($year) || $year<date("Y"))	{echo clickback('报名截至时间不合法');}
			else if (empty($contact_name))	{echo clickback('联系人不能为空');exit;}
			else if (empty($contact_phone))	{echo clickback('联系电话不能为空');exit;}
			else if (empty($content))	{echo clickback('培训内容不能为空');exit;}
			else
			{
				$classdate=$year1.'.'.$month1.'.'.$day1.'--'.$year2.'.'.$month2.'.'.$day2;
				$losetime=mktime(23,59,59,$month,$day,$year);
				$sql="update {$tablepre}job_peixun
						set
						   lesson='".html($lesson)."',
						   leixing='$leixing',
						   start_time='$classdate',
						   class_time='".html($class_time)."',
						   address='".html($address)."',
						   classs='".html($classs)."',
						   teacher='".html($teacher)."',
						   money='".html($money)."',
						   direction='".wane_text($direction)."',
						   content='".wane_text($content)."',
						   context='".wane_text($context)."',
						   contact_name='".html($contact_name)."',
						   contact_phone='".html($contact_phone)."',
						   fax='".html($fax)."',
						   email='".html($email)."',
						   url='".html($url)."',
						   losetime='$losetime'
						where id='$lessonid' and username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback('编辑培训失败');exit;}
				else
				{
					if ($html_lesson=='1' && $RIGHT[sign_lesson]=='1')
					{
						$schoolfile=$htmlroot.$dirhtml_school.'//'.md5($wane_user).'.html';
						$school_link=(file_exists($schoolfile))	?	$schoolfile	:	'view.php?action=school&info='.urlencode($wane_user);
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$pxhtml_name=$db->query_id();
						$lesson_type=$db->row($db->query("select id,title from {$tablepre}job_peixunkind where id='$leixing'"));
						$school_name=$db->row($db->query("select username,sname from {$tablepre}pxschool where username='$wane_user'"));
						$sql_data=array(
							'LINK'	=>	$lessonid,
							'SCHOOL_LINK'	=>	$school_link,
							'WEBTITLE'=>	headtitle(html($lesson)),
							'CLICK'	=>	$click,
							'LESSON'	=>	html($lesson),
							'LESSON_TYPE'	=>	$lesson_type[title],
							'LESSON_SCHOOL'	=>	$school_name[sname],
							'LESSON_START'	=>	$classdate,
							'LESSON_BEGIN'	=>	html($class_time),
							'LESSON_MONEY'	=>	html($money),
							'LESSON_CLASSES'	=>	html($classs),
							'LESSON_LEADER'	=>	html($teacher),
							'LESSON_ADDRESS'	=>	html($address),
							'ADDTIME'	=>	date("Y-n-j",time()),
							'LOSETIME'	=>	($losetime>time())?date("Y-n-j",$losetime):'<font color=\'#ff0000\'>过期</font>',
							'CONTACT'	=>	html($contact_name),
							'PHONE'	=>	html($contact_phone),
							'EMAIL'	=>	html($email),
							'FAX'	=>	html($fax),
							'URL'	=>	html($url),
							'DIREACTION'	=>	wane_text($direction),
							'CONTENT'	=>	wane_text($content),
							'CONTEXT'	=>	wane_text($context),
						);
						$c_html->c_lesson('header.html',$default_lesson,'footer.html',$lessonid,$dirhtml_lesson,$lesson_dir,$sql_data,0);
						update_cache('lessons','0');
					}
					tpl_load('result');
					$result_title='编辑培训课程成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功编辑了培训信息;系统将于 3 秒后转向管理培训页面<BR><BR><a href=company.php?action=managepeixun>立即转入管理培训页面</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=managepeixun','3');
				}
			}
		}
		else if (!empty($info) && is_numeric($info))
		{
			$table=$tablepre.'job_peixun';
			$sql=$db->query("select * from $table where id='$info' and username='$wane_user'");
			if (!$db->num($sql))
			{
				tpl_load('result');
				$result_title='操作出错';
				$result_info='很抱歉 '.$wane_user.' <BR><BR>您无权限编辑此条培训信息;系统将于 3 秒后转向培训管理页面<BR><BR><a href=company.php?action=managepeixun>立即转入培训管理页面</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg('company.php?action=managepeixun','3');
			}
			else
			{
				tpl_load('company_editpeixun');
				$row=$db->row($sql);
				$classdate=$row[start_time];
				$year1=substr($classdate,'0','4');
				$month1='MONTH1_'.substr($classdate,'5','2');
				$day1='DAY1_'.substr($classdate,'8','2');
				$year2=substr($classdate,'12','4');
				$month2='MONTH2_'.substr($classdate,'17','2');
				$day2='DAY2_'.substr($classdate,'20','2');
				list($year,$month0,$day0)=explode("-",date("Y-m-d",$row[losetime]));
				$month='MONTH_'.$month0;
				$day='DAY_'.$day0;
				$tpl->set_var(
					array(
						'YEAR'		=>	$year,
						$month	=>	'selected',
						$day	=>	'selected',
						'YEAR1'	=>	$year1,
						$month1	=>	'selected',
						$day1	=>	'selected',
						'YEAR2'	=>	$year2,
						$month2	=>	'selected',
						$day2	=>	'selected',
						'LESSONID'	=>	$row[id],
						'CLICK'	=>	$row[click],
						'LESSON'	=>	$row[lesson],
						'LESSON_KIND'	=>	select_lesson($row['leixing'],'0'),
						'START_TIME'	=>	$row[start_time],
						'CLASS_TIME'	=>	$row[class_time],
						'MONEY'	=>	$row[money],
						'CLASSS'	=>	$row[classs],
						'TEACHER'	=>	$row[teacher],
						'ADDRESS'	=>	$row[address],
						'ADDTIME'	=>	$row[puttime],
						'CONTACT_NAME'	=>	$row[contact_name],
						'CONTACT_PHONE'	=>	$row[contact_phone],
						'EMAIL'	=>	$row[email],
						'FAX'	=>	$row[fax],
						'URL'	=>	$row[url],
						'DIRECTION'	=>	$row[direction],
						'CONTENT'	=>	$row[content],
						'CONTEXT'	=>	$row[context],
						'LESSON_DIR'	=>	$row[htmlroot],
					)
				);
				unset($classdate,$year,$month0,$day0,$year1,$month1,$day1,$year2,$month2,$day2);
			}
		}
		else
		{
			tpl_load('company_managepeixun');
			$tpl->set_var('SELECTJS','<script src=\'css/check_all.js\'></script>');
			$count='25';
			$str="username='$wane_user'";
			$str2="action=managepeixun";
			$table=$tablepre.'job_peixun';
			require 'common/page_count.php';
			$sql=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($sql))
			{
				$lessonfile=$htmlroot.$dirhtml_lesson.'/'.$row[htmlroot].'/'.$row[id].'.html';
				$lessonlink=(file_exists($lessonfile))?$lessonfile:'view.php?action=lesson&info='.$row[id];
				$tpl->set_var(
					array(
						'INFOID'	=>	$row[id],
						'LESSON'	=>	$row[lesson],
						'STATUS'	=>	($row[sign]=='1')?'<font color=\'#6699cc\'>显示</font>':'<font color=\'#ff0000\'>隐藏</font>',
						'CLICK'		=>	$row[click],
						'ADDTIME'	=>	date("Y-n-j",$row[puttime]),
						'LOSETIME'	=>	($row[losetime]>time())	?	date("Y-n-j",$row[losetime])	:	'<font color=\'#ff0000\'>过期</font>',
						'LESSON_LINK'	=>	$lessonlink,
					)
				);
				unset($lessonfile,$lessonlink);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
		}
	}
	//END MANAGE PEIXUN
	else if ($action=='putjob')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_job])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[12]);
		if (comlogined()<='0')
		{
			$unlogined_info='企业用户登陆';
			require 'common/unlogined.php';
		}
		else if ($exit_putjob)
		{
			echo showmsg('company.php?action=basicinfo','0');
			exit;
		}
		else if ($save_putjob)
		{
			if ($job=='' || $address=='' || $worktext=='')	{echo clickback($lang_putjob[0]);exit;}
			else
			{
				$losetime=time()+86400*$days;
				$sql="insert into ".JOBTABLE."
                 (tid,username,job,man,address,job_pro,job_time,age,sex,height,weight,sight,social,edu,eng,depart,department,puttime,losetime,worktext,money,sign,htmlroot)
                 Values
                 ('$tid','$wane_user','".html($job)."','".html($man)."','".html($address)."','$job_pro','$job_time','$age','$sex','".html($height)."','".html($weight)."','".html($sight)."','$social','$edu','$eng','$smajortype','$smajorname','".time()."','$losetime','".html($worktext)."','".html($money)."','".$RIGHT[sign_job]."','".date($dirhtml_unit,time())."')";
				$query=$db->query($sql);
				if (!$query)	{echo clickback($lang_putjob[1]);exit;}
				else
				{
					if ($RIGHT[sign_job]=='1' && $html_job=='1')
					{
						unset($jt,$ct);
						$jt=JOBTABLE;
						$ct=QYJIANLITABLE;
						$jobid=$db->query_id();
						$sql_ins=$db->query("select qyname,qyuser from $ct where qyuser='$wane_user'");
						$row_ins=$db->row($sql_ins);
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$sql_data=array(
							'WEBTITLE'=>$row_ins['qyname'].' 招聘 '.html($job),
							'INFOTITLE'=>'[<a href=../../../view.php?action=company&info='.urlencode($wane_user).' target=\'_blank\'>'.$row_ins['qyname'].'</a>] 招聘 '.html($job),
							'JOB'=>html($job),
							'COMPANY'=>$row_ins['qyname'],
							'LINK'=>$jobid,
							'LINKCOM'=>urlencode($wane_user),
							'JOBMAN'=>html($man),
							'JOBPRO'=>$job_pro,
							'JOBTIME'=>html($job_time),
							'JOBAGE'=>$age,
							'JOBSEX'=>$sex,
							'JOBHEIGHT'=>$height,
							'JOBWEIGHT'=>$weight,
							'JOBSIGHT'=>$sight,
							'JOBSOCIAL'=>$social,
							'JOBSALARY'=>$money,
							'JOBADDR'=>html($address),
							'JOBEDU'=>$edu,
							'JOBENG'=>$eng,
							'JOBDEPART'=>$smajortype,
							'JOBCONTEXT'=>wane_text($worktext),
							'ADDTIME'=>date("Y-n-j",time()),
							'LOSETIME'=>date("Y-n-j",time()+$day*86400),
							'CLICK'=>'0',
						);
						$c_html->c_job('header.html',$default_job,'footer.html',$jobid,$dirhtml_job,date($dirhtml_unit,time()),$sql_data,0);
						update_cache('job','0');
					}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managejob>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=managejob','3');
				}
			}
		}
		else
		{
			tpl_load('company_putjob');
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
			$tpl->set_var('SELECTJS','<script src=\'css/zhuanye.js\'></script>');
			$sql=$db->query("select * from ".QYJIANLITABLE." where qyuser='$wane_user'");
			$row=$db->row($sql);
			$qyname=$row['qyname'];
			$contact_name=$row['contact_name'];
			$qyphone=$row['qyphone'];
			$qyemail=$row['qyemail'];
			$qyaddress=$row['qyaddress'];
			$qyyoubian=$row['qyyoubian'];
			$qypro=$row['qypro'];
			$jobtype	=	select_jobtype(0);

			$tpl->set_var('JOBTYPE',$jobtype);
			if ($qyaddress!='')	{$tpl->set_var('QY_ADDRESS',$qyaddress);$sign_qyaddress='1';}
			else	{$tpl->set_var('QY_ADDRESS','<font color=\'#ff0000\'>无资料</font>');$sign_qyaddress='0';}

			if ($qyyoubian!='')	{$tpl->set_var('QY_ZIPCODE',$qyyoubian);$sign_qyyoubian='1';}
			else	{$tpl->set_var('QY_ZIPCODE','<font color=\'#ff0000\'>无资料</font>');$sign_qyyoubian='0';}

			if ($qypro!='')	{$tpl->set_var('QY_KIND',$qypro);$sign_qypro='1';}
			else	{$tpl->set_var('QY_KIND','<font color=\'#ff0000\'>无资料</font>');$sign_qypro='0';}

			if ($qyname!='')
			{$tpl->set_var('COMPANY',$qyname);$sign_qyname='1';}
			else
			{$tpl->set_var('COMPANY','<font color=\'#ff0000\'>无资料</font>');$sign_qyname='0';}

			if ($contact_name!='')	{$tpl->set_var('CONTACT_NAME',$contact_name);$sign_contact_name='1';}
			else	{$tpl->set_var('CONTACT_NAME','<font color=\'#ff0000\'>无资料</font>');$sign_contact_name='0';}

			if ($qyphone!='' && $qyemail!='')
			{$tpl->set_var('CONTACT','PHONE :'.$qyphone.'<BR>E - mail:'.$qyemail);$sign_contact='1';}
			else {$tpl->set_var('CONTACT','<font color=\'#ff0000\'>无资料</font>');$sign_contact='0';}

			if ($sign_qyaddress=='0' ||  $sign_qyyoubian=='0' ||  $sign_qypro=='0' ||  $sign_qyname=='0' ||  $sign_contact_name=='0' ||  $sign_contact=='0')
			{
				$tpl->set_var('PUTJOB_NAME','exit_putjob');$tpl->set_var('PUTJOB_VALUE','资料不完整');
			}
			else
			{
				$tpl->set_var('PUTJOB_NAME','save_putjob');$tpl->set_var('PUTJOB_VALUE', '提 交' );
			}
		}
	}
	//END PUT JOB
	else if ($action=='managejob')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[put_job])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[13]);
		$editinfo=$info;
		if ($exit_editjob)
		{
			echo showmsg('company.php?action=basicinfo','0');
			exit;
		}
		else if ($save_editjob)
		{
			if ($job=='' || $address=='' || $worktext=='')	{echo clickback($lang_putjob[0]);exit;}
			else
			{
				$losetime=$puttime+86400*$days;
				$sql="UPDATE ".JOBTABLE."
						SET
							tid='$tid',
							job='".html($job)."',
							man='".html($man)."',
							address='".html($address)."',
							job_pro='$job_pro',
							job_time='$job_time',
							age='$age',
							sex='$sex',
							height='".html($height)."',
							weight='".html($weight)."',
							sight='".html($sight)."',
							social='$social',
							edu='$edu',
							eng='$eng',
							depart='$smajortype',
							department='$smajorname',
							losetime='$losetime',
							worktext='".html($worktext)."',
							money='$money'
						WHERE
							id='".$jobid."' and username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback($lang_putjob[4]);exit;}
				else
				{
					if ($RIGHT[sign_job]=='1' && $html_job=='1')
					{
						unset($jt,$ct);
						$jt=JOBTABLE;
						$ct=QYJIANLITABLE;
						$sql_edit=$db->query("select $jt.*,$ct.qyname,$ct.qyuser from $jt,$ct where $jt.id='$jobid' and $jt.username='$wane_user' and $ct.qyuser='$wane_user'");
						$row_edit=$db->row($sql_edit);
						require 'common/create_html.php';
						$c_html=new C_HTML;
						$sql_data=array(
							'WEBTITLE'=>$row_edit['qyname'].' 招聘 '.html($job),
							'INFOTITLE'=>'[<a href=../../../view.php?action=company&info='.urlencode($wane_user).' target=\'_blank\'>'.$row_edit['qyname'].'</a>] 招聘 '.html($job),
							'JOB'=>html($job),
							'COMPANY'=>$row_edit['qyname'],
							'LINK'=>$jobid,
							'LINKCOM'=>urlencode($wane_user),
							'JOBMAN'=>html($man),
							'JOBPRO'=>$job_pro,
							'JOBTIME'=>html($job_time),
							'JOBAGE'=>$age,
							'JOBSEX'=>$sex,
							'JOBHEIGHT'=>$height,
							'JOBWEIGHT'=>$weight,
							'JOBSIGHT'=>$sight,
							'JOBSOCIAL'=>$social,
							'JOBSALARY'=>$money,
							'JOBADDR'=>html($address),
							'JOBEDU'=>$edu,
							'JOBENG'=>$eng,
							'JOBDEPART'=>$smajortype,
							'JOBCONTEXT'=>wane_text($worktext),
							'ADDTIME'=>date("Y-n-j",$row_edit['puttime']),
							'LOSETIME'=>date("Y-n-j",$row_edit['losetime']),
							'CLICK'=>$row_edit['click'],
						);
						$c_html->c_job('header.html',$default_job,'footer.html',$jobid,$dirhtml_job,$row_edit['htmlroot'],$sql_data,0);
						update_cache('job','0');
					}
					tpl_load('result');
					$result_title='操作成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managejob>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=managejob','3');
				}
			}
		}
		else if ($delete_job)
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
				if ($html_job=='1')
				{
					$sql_d=$db->query("select id,htmlroot from ".JOBTABLE." where id in ($ids)");
					while ($row_d=$db->row($sql_d))
					{
						$jobfile=$htmlroot.$dirhtml_job.'/'.$row_d['htmlroot'].'/'.$row_d['id'].'.html';
						if (file_exists($jobfile))
						{
							@delete_file($jobfile);
						}
					}
					$query=$db->query("delete from ".JOBTABLE." where id in ($ids) and username='$wane_user'");
					if (!$query)	{echo clickback('操作失败');exit;}
					else
					{
						tpl_load('result');
						$result_title='操作成功';
						$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managejob&page='.$delpage.'>立即返回</a>';
						$tpl->set_var('RESULT_TITLE',$result_title);
						$tpl->set_var('RESULT_INFO',$result_info);
						update_cache('job','0');
						echo showmsg('company.php?action=managejob&page='.$delpage,'3');
					}
				}
				else
				{
					$query=$db->query("delete from ".JOBTABLE." where id in ($ids) and username='$wane_user'");
					if (!$query)	{echo clickback('操作失败');exit;}
					else
					{
						tpl_load('result');
						$result_title='操作成功';
						$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=managejob&page='.$delpage.'>立即返回</a>';
						$tpl->set_var('RESULT_TITLE',$result_title);
						$tpl->set_var('RESULT_INFO',$result_info);
						echo showmsg('company.php?action=managejob&page='.$delpage,'3');
					}
				}
			}
		}
		else if ($editinfo!='')
		{
			$query=$db->query("select * from ".JOBTABLE." where id='$editinfo' and username='$wane_user'");
			$num=$db->num($query);
			if ($num<='0')	{echo clickback('您无编辑权限');exit;}
			else
			{
				$rowinfo=$db->row($query);
				tpl_load('company_putjob_edit');

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

			$jobtype	=	select_jobtype($rowinfo[tid]);

			$tpl->set_var('JOBTYPE',$jobtype);
				$tpl->set_var('SELECTJS','<script src=\'css/zhuanye.js\'></script>');
				$tpl->set_var('JOBID',$editinfo);
				$tpl->set_var('JOB',$rowinfo['job']);
				$tpl->set_var('ADDRESS',$rowinfo['address']);
				$tpl->set_var('MAN',$rowinfo['man']);
				$perjobpro=$rowinfo['job_pro'];
				$tpl->set_var('JOB_TIME',$rowinfo['job_time']);
				$perjobage=$rowinfo['age'];
				$persex=$rowinfo['sex'];
				$tpl->set_var('HEIGHT',$rowinfo['height']);
				$tpl->set_var('WEIGHT',$rowinfo['weight']);
				$tpl->set_var('SIGHT',$rowinfo['sight']);
				$persocial=$rowinfo['social'];
				$peredu=$rowinfo['edu'];
				$perengable=$rowinfo['eng'];
				$tpl->set_var('ZY',$rowinfo['depart']);
				$tpl->set_var('ZYNAME',$rowinfo['department']);
				$tpl->set_var('PUTTIME',$rowinfo['puttime']);
				$perprice=$rowinfo['money'];
				$tpl->set_var('WORKTEXT',$rowinfo['worktext']);

				$sql=$db->query("select * from ".QYJIANLITABLE." where qyuser='$wane_user'");
				$row=$db->row($sql);
				$qyname=$row['qyname'];
				$contact_name=$row['contact_name'];
				$qyphone=$row['qyphone'];
				$qyemail=$row['qyemail'];
				$qyaddress=$row['qyaddress'];
				$qyyoubian=$row['qyyoubian'];
				$qypro=$row['qypro'];

				if ($qyaddress!='')	{$tpl->set_var('QY_ADDRESS',$qyaddress);$sign_qyaddress='1';}
				else	{$tpl->set_var('QY_ADDRESS','<font color=\'#ff0000\'>无资料</font>');$sign_qyaddress='0';}

				if ($qyyoubian!='')	{$tpl->set_var('QY_ZIPCODE',$qyyoubian);$sign_qyyoubian='1';}
				else	{$tpl->set_var('QY_ZIPCODE','<font color=\'#ff0000\'>无资料</font>');$sign_qyyoubian='0';}

				if ($qypro!='')	{$tpl->set_var('QY_KIND',$qypro);$sign_qypro='1';}
				else	{$tpl->set_var('QY_KIND','<font color=\'#ff0000\'>无资料</font>');$sign_qypro='0';}

				if ($qyname!='')
				{$tpl->set_var('COMPANY',$qyname);$sign_qyname='1';}
				else
				{$tpl->set_var('COMPANY','<font color=\'#ff0000\'>无资料</font>');$sign_qyname='0';}

				if ($contact_name!='')	{$tpl->set_var('CONTACT_NAME',$contact_name);$sign_contact_name='1';}
				else	{$tpl->set_var('CONTACT_NAME','<font color=\'#ff0000\'>无资料</font>');$sign_contact_name='0';}

				if ($qyphone!='' && $qyemail!='')
				{$tpl->set_var('CONTACT','PHONE :'.$qyphone.'<BR>E - mail:'.$qyemail);$sign_contact='1';}
				else {$tpl->set_var('CONTACT','<font color=\'#ff0000\'>无</font>');$sign_contact='0';}

				if ($sign_qyaddress=='0' ||  $sign_qyyoubian=='0' ||  $sign_qypro=='0' ||  $sign_qyname=='0' ||  $sign_contact_name=='0' ||  $sign_contact=='0')
				{
					$tpl->set_var('PUTJOB_NAME','exit_editjob');$tpl->set_var('PUTJOB_VALUE','资料不完整');
				}
				else
				{
					$tpl->set_var('PUTJOB_NAME','save_editjob');$tpl->set_var('PUTJOB_VALUE', '提 交' );
				}
			}
		}
		else
		{
			tpl_load('company_managejob');

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
			$tpl->set_var('DELPAGE',$page);
			$count='20';
			$table=JOBTABLE;
			$str="username='$wane_user'";
			$str2="action=managejob";
			require 'common/page_count.php';
			$sql="select * from ".JOBTABLE." where username='$wane_user' order by losetime desc limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($query))
			{
				$jobfile=$htmlroot.$dirhtml_job.'/'.$row[htmlroot].'/'.$row[id].'.html';
				$joblink=(file_exists($jobfile))	?	$jobfile	:	'view.php?action=showjob&info='.$row[id];
				$tpl->set_var(
					array(
						'JOB_LINK'	=>	$joblink,
						'JOB'		=>	$row[job],
						'JOBTYPE'	=>	show_jobtype($row[tid]),
						'FINDID'	=>	$row[id],
						'ADDTIME'	=>	date("Y-n-j",$row[puttime]),
						'LOSETIME'	=>	($row[losetime]<time())	?	'<font color=\'#ff0000\'>过期</font>'	:	date("Y-n-j",$row['losetime']),
						'STATUS'	=>	($row[sign]=='1')	?	'<FONT COLOR=\'#6699CC\'>显示</FONT>'	:	'<font color=\'#ff0000\'>隐藏</font>',
						'CLICK'		=>	$row[click],
					)
				);
				unset($jobfile,$joblink);
				$tpl->parse('lists','list',true);
			}
			require 'common/page_show.php';
		}
	}
	//END MANAGE JOB
	else if ($action=='hunterreciver')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[hunter_rec])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[17]);
		if ($delete_hrec)
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
				$query=$db->query("delete from {$tablepre}send_hunter_com where (id in ($ids) or info_id in ($ids)) and rec='$wane_user'");
				if (!$query)	{echo clickback('删除失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功删除了选定的信息,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=hunterreciver>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=hunterreciver','3');
				}
			}
		}
		else
		{
			tpl_load('company_hreciver');
			$tpl->set_var('SELECTJS','<script src=css/check_all.js></script>');
			$count='20';
			$s=$tablepre.'send_hunter_com';
			$c=$tablepre.'jianli';
			$j=$tablepre.'hunter_com';
			$sstr="$c.username,$c.truename as jianliname ,$j.id,$j.job,$j.htmlroot,$s.*";
			$str="$s.send=$c.username and $j.id=$s.job_id and $s.rec='$wane_user'";
			$str2="action=hunterreciver";
			$table=$j.','.$c.','.$s;
			require 'common/page_count.php';
			$sql="select $sstr from $table where $str order by $s.id desc limit $offset,$psize";
			unset($s,$p,$sstr,$str,$table);
			$query=$db->query($sql);
			unset($sql);
			$tpl->set_block('main','reclist','reclists');
			while ($row=$db->row($query))
			{
				$htmlfile=$htmlroot.$dirhtml_comhunter.'/'.$row[htmlroot].'/'.$row[job_id].'.html';
				$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=hunterjob&info='.$row[job_id];
				$tpl->set_var(
					array(
						'MAILID'	=>	$row[id],
						'JOBLINK'	=>	$htmllink,
						'NEW'		=>	!$row[isnew]	?	'NEW '	:	''	,
						'JOBNAME'	=>	$row[job],
						'JOBSEND'	=>	$row[jianliname],
						'SENDLINK'	=>	urlencode($row[send]),
						'ADDTIME'	=>	date("Y-n-j",$row[addtime]),
						'REPLIES'	=>	$row[replies],
					)
				);
				unset($row,$htmlfile,$htmllink);
				$tpl->parse('reclists','reclist',true);
			}
			$db->free_result($query);
			require 'common/page_show.php';
		}
	}
	//END HUNTER RECIVER
	elseif ($action=='huntersend')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[hunter_send])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[24]);
		tpl_load('company_hsend');
		$count='20';
		$c=$tablepre.'jianli';
		$r=$tablepre.'send_hunter_per';
		$h=$tablepre.'hunter_per';

		$sstr="$h.id,$h.for_position,$h.htmlroot,$c.username,$c.truename,$r.*";
		$str="$h.id=$r.find_id and $r.rec=$c.username and $r.send='$wane_user'";
		$str2="action=huntersend";

		$table=$c.','.$h.','.$r;
		require 'common/page_count.php';
		$sql="select $sstr from $table where $str order by $r.id desc limit $offset,$psize";
		unset($c,$r,$sstr,$str,$table);
		$query=$db->query($sql);
		unset($sql);
		$tpl->set_block('main','sendlist','sendlists');
		while ($row=$db->row($query))
		{
			$htmlfile=$htmlroot.$dirhtml_perhunter.'/'.$row[htmlroot].'/'.$row[find_id].'.html';
			$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=hunterfind&info='.$row[find_id];
			$tpl->set_var(
				array(
					'READ'		=>	!$row[isnew]	?	'<font color=\'#6699cc\'>否</font>'	:	'<font color=\'#ff0000\'>是</font>',
					'JOBNAME'	=>	$row[for_position],
					'JOBLINK'	=>	$htmllink,
					'SENDLINK'	=>	urlencode($row[username]),
					'REPLIES'	=>	$row[replies],
					'JOBSEND'	=>	$row[truename],
					'ADDTIME'	=>	date("Y-n-j",$row[addtime]),
					'MAILID'	=>	$row[id]
				)
			);
			unset($row,$htmlfile,$htmllink);
			$tpl->parse('sendlists','sendlist',true);
		}
		$db->free_result($query);
		require 'common/page_show.php';
	}
	elseif ($action=='hunterfavourite')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[hunter_fav])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[25]);
		if ($delete_hfav)
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
				$query=$db->query("delete from {$tablepre}find_fav where id in ($ids) and user_id='$wane_user'");
				if (!$query)	{echo clickback('删除失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功删除了选定的信息,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=hunterfavourite>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=hunterfavourite','3');
				}
			}
		}
		else
		{
			tpl_load('company_hfavourite');
			$tpl->set_var('SELECTJS','<script src=css/check_all.js></script>');
			$count="20";
			$h=$tablepre.'hunter_per';
			$f=$tablepre.'find_fav';
			$table=$h.','.$f;
			$sstr="$h.id,$h.truename,$h.industry,$h.position,$h.htmlroot,$f.id,$f.user_id,$f.find_id,$f.addtime";
			$str="$h.id=$f.find_id and $f.user_id='$wane_user'";
			$str2="action=hunterfavourite";
			require 'common/page_count.php';
			$sql="select $sstr from $table where $str order by $f.id desc limit $offset,$psize";
			$query=$db->query($sql);
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($query))
			{
				$htmlfile=$htmlroot.$dirhtml_perhunter.'/'.$row[htmlroot].'/'.$row[find_id].'.html';
				$htmllink=file_exists($htmlfile)	?	$htmlfile	:	'view.php?action=hunterfind&info='.$row[find_id];
				$tpl->set_var(
					array(
						'FAVID'	=>	$row[id],
						'HLINK'	=>	$htmllink,
						'INDUSTRY'	=>	$row[industry],
						'POSITION'	=>	$row[position],
						'TRUENAME'	=>	$row[truename],
						'ADDTIME'	=>	date("Y-n-j H:i",time()),
					)
				);
				unset($htmlfile,$htmllink);
				$tpl->parse('lists','list',true);
			}
			$db->free_result($query);
			unset($f,$h,$table,$sstr,$str,$sql,$row);
			require 'common/page_show.php';
		}
	}
	//+	end hunter favourite
	else if ($action=='reciver')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[job_rec])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[18]);
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
				$query=$db->query("delete from ".PERSENDTABLE." where (id in ($ids) or info_id in ($ids)) and com_id='$wane_user'");
				if (!$query)	{echo clickback('删除失败');exit;}
				else
				{
					tpl_load('result');
					$result_title='删除成功';
					$result_info='恭喜您 '.$wane_user.' <BR><BR>您已成功删除了选定的信息,系统将于 3 秒后自动返回<BR><BR><a href=company.php?action=reciver&page='.$delpage.'>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=reciver&page='.$delpage,'3');
				}
			}
		}
		else
		{
			tpl_load('company_reciver');
			$tpl->set_var('SELECTJS','<script src=css/check_all.js></script>');
			$count='20';
			$r=PERSENDTABLE;
			$j=$tablepre.'job_chance';
			$p=$tablepre.'jianli';
			$table=$r.','.$j.','.$p;
			$sstr="$j.id,$j.job,$j.htmlroot,$r.id,$r.user_id,$r.com_id,$r.job_id,$r.addtime,$r.replies,$r.isnew,$p.username,$p.truename";
			$str="$r.com_id='$wane_user' and $j.id=$r.job_id and $r.user_id=$p.username";
			$str2='action=reciver';
			require 'common/page_count.php';
			$sql=$db->query("select $sstr from $table where $str order by $r.id desc limit $offset,$psize");
			unset($r,$j,$p,$table,$sstr,$str);
			$tpl->set_block('main','reclist','reclists');
			while ($row=$db->row($sql))
			{
				$infourllink=infourl($dirhtml_job,$row['htmlroot'],$row['job_id']);
				$tpl->set_var(
					array(
						'CURPAGE'	=>	$page,
						'NEW'		=>	!$row[isnew]	?	'NEW&nbsp;'	:	'',
						'MAILID'	=>	$row['id'],
						'INFOURL'	=>	($infourllink!='0')?$infourllink:'view.php?action=showjob&info='.$row['job_id'],
						'JOBNAME'	=>	$new.$row['job'],
						'JOBSEND'	=>	$row['truename'],
						'SENDLINK'	=>	urlencode($row['user_id']),
						'RERECNUM'	=>	$row[replies],
						'ADDTIME'	=>	date('Y-m-d',$row['addtime']),
					)
				);
				unset($row,$infourllink);
				$tpl->parse('reclists','reclist',true);
			}
			$db->free_result($sql);
			require 'common/page_show.php';
		}
	}
	//END RECIVER
	else if ($action=='send')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[job_send])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[19]);
		if (comlogined()<='0')
		{
			$unlogined_info='企业用户登陆';require 'common/unlogined.php';
		}
		else
		{
			tpl_load('company_send');
			$r=PERRECTABLE;
			$j=FINDJOBTABLE;
			$p=JIANLITABLE;
			$table=$r.','.$j.','.$p;
			$count='20';
			$sstr="$p.username,$p.truename,$j.id,$j.job,$j.htmlroot,$r.id,$r.user_id,$r.per_id,$r.find_id,$r.addtime,$r.isnew,$r.replies";
			$str="$r.user_id='$wane_user' and $r.per_id=$p.username and $j.id=$r.find_id";
			$str2="action=send";
			require 'common/page_count.php';
			$sql=$db->query("select $sstr from $table where $str order by $r.id desc limit $offset,$psize");
			unset($sstr,$str,$r,$j,$p,$table);
			$tpl->set_block('main','sendlist','sendlists');
			while ($row=$db->row($sql))
			{
				$infourllink=infourl($dirhtml_find,$row['htmlroot'],$row['find_id']);
				$tpl->set_var(
					array(
						'ADDTIME'	=>	date('Y-m-d H:i',$row['addtime']),
						'MAILID'	=>	$row['id'],
						'INFOURL'	=>	($infourllink!='0')?$infourllink:'view.php?action=showfind&info='.$row['find_id'],
						'SENDLINK'	=>	urlencode($row['per_id']),
						'RESENDNUM'	=>	$row[replies],
						'JOBNAME'	=>	$row['job'],
						'JOBSEND'	=>	$row['truename'],
						'READ'		=>	!$row[isnew]	?	'<font color=\'#6699cc\'>否</font>'	:	'<font color=\'#ff0000\'>是</font>',
					)
				);
				unset($row,$infourllink);
				$tpl->parse('sendlists','sendlist',true);
			}
			$db->free_result($sql);
			require 'common/page_show.php';
		}
	}//END SEND
	else if ($action=='favourite')
	{
		if (!$RIGHT[register_sign] && !$user_cfg[info])	{echo clickback($lang_right[0]);exit;}
		if (!$RIGHT[job_fav])	{echo clickback($lang_right[1]);exit;}
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[20]);
		if (comlogined()<='0')
		{
			$unlogined_info='企业用户登陆';require 'common/unlogined.php';
		}
		else if ($delete_fav)
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
				if (!$query)	{echo clickback($lang_favourite[0]);exit;}
				else
				{
					tpl_load('result');
					$result_title=$lang_favourite[1];
					$result_info='恭喜您 '.$wane_user.' <BR><BR>'.$lang_favourite[2].'<BR><BR><a href=company.php?action=favourite&page='.$delpage.'>'.'恭喜您</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php?action=favourite&page='.$delpage,'3');
				}
			}
		}
		else
		{
			tpl_load('company_favourite');
			$tpl->set_var('SELECTJS','<script src=\'css/check_all.js\'></script>');

			$f=FAVTABLE;
			$p=$tablepre.'jianli';
			$j=$tablepre.'findjob_chance';
			$table=$f.','.$p.','.$j;
			$count='20';
			$sstr="$p.username,$p.truename,$j.id,$j.job,$j.htmlroot,$f.id,$f.user_id,$f.job_id,$f.addtime";
			$str="$f.user_id='$wane_user' and $f.job_id=$j.id and $j.username=$p.username";
			$str2="action=favourite";
			require 'common/page_count.php';
			$sql=$db->query("select $sstr from $table where $str order by $f.addtime desc limit $offset,$psize");
			unset($f,$p,$j,$table,$sstr,$str);
			$tpl->set_block('main','list','lists');
			while ($row=$db->row($sql))
			{
				$fildfile=$htmlroot.$dirhtml_find.'/'.$row['htmlroot'].'/'.$row['job_id'].'.html';
				$linkurl=file_exists($fildfile)?$fildfile:'view.php?action=showfind&info='.$row['job_id'];
				$tpl->set_var(
					array(
						'LINKURL'	=>	$linkurl,
						'JOBNAME'	=>	$row['job'],
						'SENDNAME'	=>	$row['truename'],
						'FAVJIANLI'	=>	urlencode($row['username']),
						'INFOLINK'	=>	$row['id'],
						'ADDTIME'	=>	date("Y-m-d H:i",$row['addtime']),
						'FAVID'		=>	$row['id'],
						'CURPAGE'	=>	$page,
					)
				);
				unset($fildfile,$linkurl);
				$tpl->parse('lists','list',true);
			}
			unset($sql,$row);
			require 'common/page_show.php';
		}
	}
	// END FAV
	else if ($action=='chpwd')
	{
		$headtitle=headtitle('企业用户控制面板 -> '.$lang_companycontrol[22]);
		if (comlogined()<='0')
		{
			$unlogined_info='企业用户登陆';require 'common/unlogined.php';
		}
		else if ($save_pwd)
		{
			if ($oripass=='')	{echo clickback($lang_chpwd[0]);exit;}
			else if (md5($oripass)!=$HTTP_COOKIE_VARS['wwwwanenet_pass'])	{echo clickback($lang_chpwd[1]);exit;}
			else
			{
				if (($pass!='' || $repass!='') && $pass!=$repass)	{echo clickback($lang_chpwd[2]);exit;}
				else
				if ($pass=='' && $repass=='')
				{$passdata='';} else	{$passdata=" password='".md5(html($pass))."' ,";}
				if ($answer!='')	{$answerdate=",answer='".html($answer)."'";}	else {$answerdate='';}
				$sql="UPDATE ".USERTABLE." SET ".$passdata." email='".html($email)."',question='".html($question)."' $answerdate where username='$wane_user'";
				$query=$db->query($sql);
				if (!$query)	{echo clickback($lang_chpwd[3]);exit;}
				else
				{
					if (!empty($passdata))
					{
						require 'common/password_class.php';
						$chpass	=	new	wane_password;
						$chpass	->	password_wane($wane_user,md5(html($pass)));
					}
					tpl_load('result');
					$result_title=$lang_chpwd[4];
					$result_info='恭喜您 '.$wane_user.' <BR><BR>'.$lang_chpwd[5].'<BR><BR><a href=company.php>立即返回</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('company.php','3');
				}
			}
		}
		else
		{

			tpl_load('company_chpwd');
			$sql="select * from ".USERTABLE." where username='$wane_user'";
			$query=$db->query($sql);
			$row=$db->row($query);
			$tpl->set_var('LOGINUSERNAME',$row['username']);
			$tpl->set_var('EMAIL',$row['email']);
			$tpl->set_var('QUESTION',$row['question']);
			$tpl->set_var('LOGINS',$row['logins']);
			$tpl->set_var('REGTIME',date("Y-m-d H:i",$row['regtime']));
		}
	}
	//END CHANGE PASSWORD ！
	else
	{
		$headtitle=headtitle($webtitle.' -> 企业用户控制面板');
		tpl_load('company');
		require 'common/main_company.php';
	}
	//+---------------------
	//+	out put end
	//+---------------------
	require_once 'common/common.php';
	require_once 'common/comcp.php';
	require 'common/lang/lang_common.php';
	require 'common/lang/lang_company.php';
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