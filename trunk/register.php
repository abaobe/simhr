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
	$method=$HTTP_SERVER_VARS['REQUEST_METHOD'];
	if (userlogined()>='1' && $method!='POST')
	{
		tpl_load('result');
		require_once 'common/common.php';
		$headtitle=headtitle('提 示  [ 注 册 出 错 ]');
		$result_title='提 示  [ 注 册 出 错 ]';
		$result_info='您好 <font color=ff0000>'.$wane_user.'</font> <BR><BR><font color=ff0000>您已经是本站正式注册会员,您不能再次注册 !  系统将于 3 秒后自动返回首页</font><BR><BR><a href=index.php>立即返回首页</a>';
		$tpl->set_var('RESULT_TITLE',$result_title);
		$tpl->set_var('RESULT_INFO',$result_info);
		echo showmsg('index.php','3');
	}
	else if ($method!='POST')
	{
		tpl_load('register');
		require_once 'common/common.php';
		$headtitle=headtitle(' 会 员 注 册 ');
	}
	else if ($submit_register)
	{
		if ($username=='')	{echo clickback('用户名不能为空');exit;}
		else if (htmlspecialchars($username) != $username || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $username) ) {echo clickback('用户名含非法字符，不能注册');exit;}
		else if (strlen($username) > '50')	{echo clickback($lang_register_commonjsinfo[2]);exit;}
		else if ($db->num($db->query("select username from ".USERTABLE." where username='$username'"))>='1')	{echo clickback('此用户已存在');exit;}
		else if ($password=='' || $repassword=='')	{echo clickback('登陆密码不能为空');exit;}
		else if (strlen($password) < '6')	{echo clickback('密码长度不能小于 6 位');exit;}
		else if ($password!=$repassword)	{echo clickback('验证密码不正确');exit;}
		else if ($email=='' || (!strstr($email, '@') || $email != addslashes($email) || $email != htmlspecialchars($email))) {echo clickback('邮箱地址不合法');exit;}
		else
		{
			$password	=	md5($password);
			$sql="insert into {$tablepre}member
                 (username,password,email,kind,question,answer,regtime)
                 Values
                 ('$username','$password','$email','$userkind','".html($question)."','".html($answer)."','".time()."')";
			$query=$db->query($sql);
			if (!$query)	 {echo clickback($lang_register_commonjsinfo[8]);exit;}
			else
			{
				update_cache('count','0');
				//+
				/*
				$registerinfo	=	array(
					'user'	=>	$username,
					'pass'	=>	$password,
					'email'	=>	$email,
				);
				require 'common/register_class.php';
				unset($register);
				$register	=	new	wane_register;
				$register	->	register_wane();
				*/
				$userinfo=array(
					"user"	=>	"$username",
					"pass"	=>	"$password",
				);
				wane_set_cookie();


				//+
				/*
				require 'common/login_class.php';
				unset($login);
				$login	=	new	wane_login;
				$login	->	login_wane();
				*/
				//+

				switch ($userkind)
				{
					case $kind_mem :	$toreghtml='register_per';	$headtitle=headtitle('填写个人简历资料');	break;
					case $kind_com :	$toreghtml='register_com';	$headtitle=headtitle('填写企业简历资料');	break;
				}
				tpl_load($toreghtml);

				require_once 'common/common.php';
				for ($i='1945';$i<=(date("Y")-14);$i++)
				{
					$years.='<option value='.$i.'>'.$i.'</option>';
				}
				$tpl->set_var('SELECT_YEARS',$years);
				$tpl->set_var('JSPACE_USER',html($username));
			}
		}
	}
	else if ($submit_per_basic)
	{
		if ($truename=='')	{echo clickback('真实姓名不能为空');exit;}
		else if ($db->num($db->query("select username from ".JIANLITABLE." where username='$wane_user' limit 1")))
		{
			echo clickback('您的资料已经提交,请不要重复操作');exit;
		}
		else
		{
			$birth=$year.'-'.$month.'-'.$day;
			$juzhudi=$juzhu_1.'-'.html($juzhu_2);
			$sql="insert into  ".JIANLITABLE." (username,truename,sex,mingzu,birth,hukou,juzhudi,shengfengzhen,marry,social) Values ('$wane_user','".html($truename)."','".html($sex)."','".html($mingzu)."','$birth','".html($hukou)."','$juzhudi','".html($shengfengzhen)."','".html($marry)."','".html($social)."')";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('填写简历资料失败');exit;}
			else
			{
				//update_cache('count','0');
				update_cache('personals','0');
				tpl_load('result');
				require_once 'common/common.php';
				$handtitle=headtitle('注册完成');
				$result_title='完 成 注 册 (更多详细信息填写请转入 控制面板)';
				$result_info='恭喜您 <font color=ff0000>'.$wane_user.'</font> 您已经完成基本资料的填写,更多详细信息填写请转入控制面板<BR><BR><a href=personal.php>转入控制面板</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php>返回首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=job.php>查看招聘信息</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
			}
		}
	}
	else if ($submit_com_basic)
	{
		if ($qyname=='')	{echo clickback('企业名称不能为空');exit;}
		else if ($db->num($db->query("select qyuser from ".QYJIANLITABLE." where qyuser='$wane_user'"))>='1')	{echo clickback('您的资料已经存在,请不要重复提交');exit;}
		else
		{
			$sql="insert into  ".QYJIANLITABLE." (qyuser,qyname,qyaddress,qypro,qykind,qyman,contact_name,qyphone,qyemail,qyyoubian,qyweb) Values ('$wane_user','".html($qyname)."','".html($qyaddress)."','".$qypro."','$qykind','$qyman','".html($contact_name)."','".html($qyphone)."','".html($qyemail)."','".html($qyyoubian)."','".html($qyweb)."')";
			$query=$db->query($sql);
			if (!$query)	{echo clickback('填写简历资料失败');exit;}
			else
			{
				update_cache('companys','0');
				tpl_load('result');
				require_once 'common/common.php';
				$handtitle=headtitle('注册完成');
				$result_title='完 成 注 册 (更多详细信息填写请转入 控制面板)';
				$result_info='恭喜您 <font color=ff0000>'.$wane_user.'</font> 您已经完成企业基本资料的填写,更多详细信息填写请转入控制面板<BR><BR><a href=company.php>转入控制面板</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php>返回首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=findjob.php>查看个人求职信息</a>';
				$tpl->set_var('RESULT_TITLE',$result_title);
				$tpl->set_var('RESULT_INFO',$result_info);
			}
		}
	}
	require_once 'common/lang/lang_register.php';
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