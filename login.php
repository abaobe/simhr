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
	if ($action=='loginout')
	{
		tpl_load('result');
		$headtitle=headtitle('退出登陆');
		require_once 'common/common.php';
		$result_title='注 销 成 功';
		$result_info='您好 <font color=ff0000>'.$wane_user.'</font>&nbsp;&nbsp;&nbsp;&nbsp;<a href=login.php>[重新登陆]</a><BR><BR>您已成功注销此次登陆 !  系统将于 3 秒后自动返回首页<BR><BR><a href=index.php>立即返回首页</a>';

		$userinfo=array();
		wane_set_cookie(1);
		//+
		require 'common/login_class.php';
		unset($login);
		$login	=	new	wane_login;
		$login	->	login_wane(1);
		//+

		$tpl->set_var('RESULT_TITLE',$result_title);
		$tpl->set_var('RESULT_INFO',$result_info);
		echo showmsg('index.php','3');
	}
	else if (userlogined()>='1')
	{
		tpl_load('result');
		$headtitle=headtitle('登陆出错');
		require_once 'common/common.php';
		$result_title='登陆出错';
		$result_info='您好 <font color=ff0000>'.$wane_user.'</font>&nbsp;&nbsp;&nbsp;&nbsp;<a href=login.php?action=loginout>[退出]</a> <BR><BR><font color=ff0000>您已经登陆系统,无法重复登陆 !  系统将于 3 秒后自动返回前页</font><BR><BR><a href=javascript:history.go(-1)>立即返回前页</a>';
		$tpl->set_var('RESULT_TITLE',$result_title);
		$tpl->set_var('RESULT_INFO',$result_info);
		echo showmsg('javascript:history.go(-1)','3');
	}
	else if ($submit_login)
	{
		if ($username=='' || $password=='')	{echo clickback($lang_login_form);exit;}
		else
		{
			$loginurl=substr($goto,-10,10);
			if ($loginurl=='login.php?' || $loginurl=='/login.php')	{$goback='index.php';}
			else {$goback=$goto;}
			$sql="select username,password,logins from ".USERTABLE." where username='".html($username)."' and password='".md5(html($password))."'";
			$query=$db->query($sql);
			if ($db->num($query))
			{
				@$db->query("UPDATE ".USERTABLE." SET logins=logins+'1' where username='$username'");

				tpl_load('result');
				$headtitle=headtitle('登陆成功');
				require_once 'common/common.php';
				$result_title='登陆成功';
				$result_info='您好 <font color=ff0000>'.html($username).'</font> <BR><BR>您已成功登陆 !  系统将于 3 秒后自动返回<BR><BR><a href='.$goback.'>立即返回</a>';


				$userinfo=array(
					"user"	=>	"$username",
					"pass"	=>	"".md5($password)."",
				);
				wane_set_cookie();

				//+
				require 'common/login_class.php';
				unset($login);
				$login	=	new	wane_login;
				$login	->	login_wane();
				//+

				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
				echo showmsg($goback,'3');
			}
			else
			{
				tpl_load('result');
				$headtitle=headtitle('登陆出错');
				$result_title='登 陆 失 败  <font color=ff0000>(用户名和密码不匹配)</font>';
				require_once 'common/common.php';
				$result_info=$loginform;
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
			}
		}
	}
	else
	{
		tpl_load('result');
		$headtitle=headtitle('用户登陆');
		$result_title='用户登陆';
		require_once 'common/common.php';
		$result_info=$loginform;

		$userinfo=array();
		wane_set_cookie(1);

		$tpl->set_var('RESULT_TITLE',$result_title);
		$tpl->set_var('RESULT_INFO',$result_info);
	}
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