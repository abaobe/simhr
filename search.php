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

	/*
	//+------------------
	//+	submit job chance
	//+------------------
	*/
	if ($submit_job)
	{
		$searchurl="job.php?action=search&addtime=$addtime&sex=".urlencode($sex)."&edu=".urlencode($edu)."&job=".urlencode($job)."&address=".urlencode($address);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+----------------------
	//+	submit findjob chance
	//+----------------------
	*/
	else if ($submit_find)
	{
		$searchurl="find.php?action=search&addtime=$addtime&sex=".urlencode($sex)."&edu=".urlencode($edu)."&job=".urlencode($job)."&zhuanyename=".urlencode($zhuanyename)."&graedu=".urlencode($graedu);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+------------------
	//+	submit hunter job
	//+------------------
	*/
	else if ($submit_hunterjob)
	{
		$searchurl="hunter.php?action=job&method=search&addtime=$addtime&industry=".urlencode($qykind)."&job=".urlencode($job)."&qyname=".urlencode($qyname)."&address=".urlencode($address);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+-------------------
	//+	submit hunter find
	//+-------------------
	*/
	else if ($submit_hunterfind)
	{
		$searchurl="hunter.php?action=find&method=search&addtime=$addtime&industry=".urlencode($industry)."&sex=".urlencode($sex)."&edu=".urlencode($edu)."&job=".urlencode($job)."&position=".urlencode($position);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}

	/*
	//+-------------------
	//+	submit hunter info
	//+-------------------
	*/
	else if ($submit_hunterinfo)
	{
		$searchurl="hunter.php?action=info&method=search&title=".urlencode($title)."&content=$content";
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+--------------
	//+	submit lesson
	//+--------------
	*/
	else if ($submit_lesson)
	{
		$searchurl='learn.php?action=lesson&method=search&addtime='.$addtime.'&lesson='.urlencode($lesson).'&leixing='.$leixing.'&address='.urlencode($address).'&money='.urlencode($money);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+--------------
	//+	submit school
	//+--------------
	*/
	else if ($submit_school)
	{
		$searchurl='learn.php?action=school&method=search&schkind='.$schkind.'&sname='.urlencode($sname);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+-------------------
	//+	submit teacher job
	//+-------------------
	*/
	else if ($submit_tjob)
	{
		$searchurl="teacher.php?action=job&method=search&addtime=$addtime&sex=".urlencode($sex)."&edu=".urlencode($edu)."&title=".urlencode($title)."&address=".urlencode($address);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}/*
	//+--------------------
	//+	submit teacher find
	//+--------------------
	*/
	else if ($submit_tfind)
	{
		$searchurl="teacher.php?action=find&method=search&addtime=$addtime&sex=".urlencode($sex)."&edu=".urlencode($edu)."&title=".urlencode($title)."&zhuanye=".urlencode($zhuanye)."&living=".urlencode($living);
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+------------
	//+	submit news
	//+------------
	*/
	else if ($submit_news)
	{
		$searchurl="news.php?action=search&title=".urlencode($title)."&content=$content";
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+-----------
	//+	submit law
	//+-----------
	*/
	else if ($submit_law)
	{
		$searchurl="joblaw.php?action=search&title=".urlencode($title)."&content=$content";
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+-----------
	//+	submit way
	//+-----------
	*/
	else if ($submit_way)
	{
		$searchurl="jobway.php?action=search&title=".urlencode($title)."&content=$content";
		$headtitle=headtitle('查询结束');
		tpl_load('result');
		$result_title='操作成功';
		$result_info='恭喜您  '.$wane_user.' ! <BR><BR>您已成功执行了您的操作,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
		$tpl->set_var(
			array(
				'RESULT_TITLE'	=>	$result_title,
				'RESULT_INFO'	=>	$result_info,
			)
		);
		echo showmsg($searchurl,'3');
		unset($searchurl,$result_title,$result_infos);
	}
	/*
	//+-----------
	//+	start form
	//+-----------
	*/
	else
	{
		$searchurl="javascript:history.go(-1)";
		$headtitle=headtitle('查询出错');
		tpl_load('result');
		$result_title='查询出错';
		$result_info='很抱歉  '.$wane_user.' ! <BR><BR>您提交的数据不合法,系统将于 3 秒后自动返回结果页面<BR><BR><a href=\''.$searchurl.'\'>立即返回结果页面</a>';
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


	if ($process_info=='1')
	{
		$process=$DEBUG->process();
		$queries=$db->querynum;
		$tpl->set_var(
			array(
				'PROCESS_INFOS'	=>	'Process in '.$process.' second(s) with '.$queries.' Queries '.$pagegzipinfo,
				'WANE_QUERY'	=>	$queries.' Queries',
			)
		);
	}
	tpl_out();
?>