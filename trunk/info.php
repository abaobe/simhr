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

	require 'globals.php';
	if(!defined("IN_SIMHR"))
	{
		exit("Error : access denied for info.php");
	}
	if ($submit_mail)
	{//+ start send email
		require 'common/mail_config.php';
		require 'common/email.php';
		$mail = new WANE_MAIL;
		$subject=!isset($subject)	?	$webtitle." - 推荐信息"	:	$subject.'('.$webtitle.')';
		$mail_back='javascript:history.go(-2)';
		if (!$mail->wane_mail_send($to,$subject,$message,$fromer.'<'.$from.'>'))
		{
			$result_title='操作成功';
			$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功将此条信息推荐给了您的好友,系统将于 3 秒后自动返回<BR><BR><a href='.$mail_back.'>立即返回</a>';
		}
		else
		{
			$result_title='操作失败';
			$result_info='很抱歉  '.$wane_user.' ! <BR><BR>您在将此条信息发送给你的好友时出现错误,系统将于 3 秒后自动返回<BR><BR><a href='.$mail_back.'>立即返回</a>';
		}
		tpl_load('result');
		$tpl->set_var('RESULT_TITLE',$result_title);
		$tpl->set_var('RESULT_INFO',$result_info);
		echo showmsg($mail_back,'3');
	}
	else if ($submit_discuss)
	{//+ start insert into sql

	}
	elseif ($action=='mail')
	{// send to my friend
		if (!$RIGHT[mail_friend])	{echo clickback($lang_right[1]);exit;}
		switch ($type)
		{
			case	'job'			:	$table=array($tablepre.'job_chance',$dirhtml_job,'showjob');			break;
			case	'find'			:	$table=array($tablepre.'findjob_chance',$dirhtml_find,'showfind');		break;
			case	'hunterjob'		:	$table=array($tablepre.'hunter_com',$dirhtml_comhunter,'hunterjob');	break;
			case	'hunterfind'	:	$table=array($tablepre.'hunter_per',$dirhtml_perhunter,'hunterfind');	break;
			case	'hunterinfo'	:	$table=array($tablepre.'hunter_info',$dirhtml_hunterinfo,'');	break;
			case	'news'			:	$table=array($tablepre.'index_news',$dirhtml_news,'');			break;
			case	'way'			:	$table=array($tablepre.'job_way',$dirhtml_way,'');				break;
			case	'law'			:	$table=array($tablepre.'job_law',$dirhtml_law,'');				break;
		}
		$sql="select id,htmlroot from $table[0] where id='$info'";
		$query=$db->query($sql);
		if (!$db->num($query))
		{
			echo clickback('System Error!');exit;
		}
		else
		{
			$row=$db->row($query);
			$strallurl='http://'.($HTTP_SERVER_VARS['SERVER_NAME'] ? $HTTP_SERVER_VARS['SERVER_NAME'] : $HTTP_SERVER_VARS['HTTP_HOST']).($HTTP_SERVER_VARS['PHP_SELF'] ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_SERVER_VARS['SCRIPT_NAME']);
			$strurl=str_replace(basename($strallurl),'',$strallurl);
			$htmlfile=$htmlroot.$table[1].'/'.$row[htmlroot].'/'.$row[id].'.html';
			(file_exists($htmlfile) || $table[2]=='')	?	$sendurl=$strurl.$htmlfile	:	$sendurl=$strurl.'view.php?action='.$table[2].'&info='.$info;
		}
		$tpl->set_var('INFOURL',$sendurl);
		tpl_load('email');
	}
	else if ($action=='download')
	{//	download to local disk

	}
	else if ($action=='discuss')
	{//	send your idea to website

	}
	else if ($action=='test')
	{
		require 'common/mail_config.php';
		require 'common/email.php';
		$mail = new WANE_MAIL;
		$mail->mail_register('webmaster@ewannan.com','wane.net test','wan-e.net test content','webmaster@ah0553.com');
		if (!$mail)	{echo 'suss';}
		else	{echo 'faile';}
	}
	else
	{//	error operate
		$headtitle=headtitle('非法操作');
		$searchurl='javascript:window.close()';
		tpl_load('result');
		$result_title='非法操作,系统将自己关闭';
		$result_info='很抱歉  '.$wane_user.' ! <BR><BR>您提交的数据为非法操作,系统将于 3 秒后自动返关闭<BR><BR><a href=\''.$searchurl.'\'>立即关闭</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	require 'common/common.php';
	tpl_out();
?>
