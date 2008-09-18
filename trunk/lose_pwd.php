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
	$method=$HTTP_SERVER_VARS['REQUEST_METHOD'];
	if ($method!='POST' && userlogined()>='1')
	{
		tpl_load('result');
		$result_title='找 回 密 码 出 错';
		$result_info='您好 <font color=ff0000>'.$HTTP_COOKIE_VARS['wwwwanenet_user'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=login.php?action=loginout>[退出系统]</a><BR><BR>您已登陆系统， 不能进行找回密码操作系统将于 3 秒后自动返回首页<BR><BR><a href=index.php>立即返回首页</a>';
		$tpl->set_var('RESULT_TITLE',$result_title);
		$tpl->set_var('RESULT_INFO',$result_info);
		echo showmsg('index.php','3');
	}
	elseif ($HTTP_POST_VARS['submit_question'])
	{
		if ($HTTP_POST_VARS['username']==''	||	$HTTP_POST_VARS['question']=='' ||	$HTTP_POST_VARS['answer']=='')	{echo clickback('安全问题方式找回密码必须填写 用户名，密码保护问题，问题回答');exit;}
		else
		{
			$sql=$db->query("select username,question,answer from ".USERTABLE." where username='".$HTTP_POST_VARS['username']."' and question='".$HTTP_POST_VARS['question']."' and answer='".$HTTP_POST_VARS['answer']."'");
			$num=$db->num($sql);
			if ($num<='0')	{echo clickback('安全问题、回答问题不匹配');exit;}
			else
			{
				$newpass=rand('10000001','99999999');
				$query=$db->query("update ".USERTABLE." set password='".md5($newpass)."' where username='".$HTTP_POST_VARS['username']."'");
				if (!$query)	{echo clickback('密码重置失败');exit;}
				else
				{

					tpl_load('result');
					$result_title='密 码 重 置 成 功';
					$result_info='恭喜您 <font color=ff0000>'.$HTTP_POST_VARS['username'].'</font>&nbsp;&nbsp;&nbsp;&nbsp;<a href=login.php>[登陆]</a><BR><BR>您已经成功重设置了您的新密码,您的新密码是 <font color=ff0000><B>'.$newpass.'</B></font><BR><BR>请以此密码登陆控制面板修改您的密码';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
				}
			}
		}
	}
	else if ($HTTP_POST_VARS['submit_email'])
	{
		if ($HTTP_POST_VARS['username']==''	||	$HTTP_POST_VARS['email']=='')	{echo clickback('E-mail 方式找回密码必须填写 用户名，注册email ');exit;}
		else
		{
			$sql=$db->query("select username,email from ".USERTABLE." where username='".$HTTP_POST_VARS['username']."' and email='".$HTTP_POST_VARS['email']."'");
			$num=$db->num($sql);
			if ($num>='1')
			{
				$newpass=rand('10000001','99999999');
				$touser=$HTTP_POST_VARS['email'];
				$title=$webtitle.' 重设置密码';
				$content="
					\n		您好
					\n		$username
					\n	您在 $webtitle 的新密码已经重置

					\n	用 户 名：	$username
					\n	登陆密码：	$newpass

					\n	$webtitle 提示您登陆控制面板，修改您的密码\n\n
					\n	访问地址 : ".str_replace("lose_pwd","login",$backurl)."\n\n";
				require 'common/mail_config.php';
				require 'common/email.php';
				$wanemail=new WANE_MAIL;
				$query=!$wanemail->wane_mail_send($touser,$title,$content,$webtitle.'<'.$adminemail.'>');
				if (!$query)	{echo clickback('E-mail 重置密码失败');exit;}
				else
				{
					$db->query("update ".USERTABLE." set password='".md5($newpass)."' where username='".$HTTP_POST_VARS['username']."'");

					tpl_load('result');
					$result_title='密 码 找 回 成 功';
					$result_info='恭喜您 <font color=ff0000>'.$HTTP_POST_VARS['username'].'</font>&nbsp;&nbsp;&nbsp;&nbsp;<a href=login.php>[登陆]</a><BR><BR>您的新密码已经发送到您的邮箱 '.$HTTP_POST_VARS['email'].' 请注意查收，并及时登陆控制面板修改你的新密码<BR><BR>系统将与 3 秒后自动返回首页&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php>立即返回首页</a>';
					$tpl->set_var('RESULT_TITLE',$result_title);
					$tpl->set_var('RESULT_INFO',$result_info);
					echo showmsg('index.php','3');
				}
			}
			else
			{
				echo clickback('用户、注册email 不匹配');exit;
			}
		}
	}
	else
	{
		tpl_load('lose_pwd');
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