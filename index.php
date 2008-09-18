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
	tpl_load('index');
	$headtitle=headtitle($webtitle);
	require_once 'common/common.php';
	/*
	//+-----------
	//+	start news
	//+-----------
	*/
	$news_file = 'common/cache/cache_news.php';
	if (!file_exists($news_file))
	{
		unset($news_file);
		$tpl->set_var(
			array(
				'NEWS_TIME'		=>	'<FONT COLOR=\'#FF0000\'>Error:</FONT>',
				'NEWS_TITLE'	=>	'缓存文件无法载入',
				'NEWS_LINK'		=>	'#',
			)
		);
	}
	else
	{
		require $news_file;
		$tpl->set_block('main','news','newss');
		foreach($cache_news as $news)
		{
			$tpl->set_var(
				array(
					'NEWS_TIME'		=>	$news[addtime],
					'NEWS_TITLE'	=>	wane_str($news[title],0,$string_news),
					'NEWS_LINK'		=>	$htmlroot.$dirhtml_news.'/'.$news[htmlroot].'/'.$news[id].'.html',
				)
			);
			unset($news_file,$cache_news,$news);
			$tpl->parse('newss','news',true);
		}
	}
	/*
	//+-------------
	//+	start lesson
	//+-------------
	*/
	$lesson_file='common/cache/cache_lessons.php';
	if (!file_exists($lesson_file))
	{
		unset($lesson_file);
		$tpl->set_var(
			array(
				'LESSON_TIME'	=>	'<font color=\'#ff0000\'>Error:</font>',
				'LESSON_NAME'	=>	'缓存文件无法载入',
				'LESSON_LINK'	=>	'#',
			)
		);
	}
	else
	{
		require $lesson_file;
		$tpl->set_block('main','lesson','lessons');
		foreach($cache_lessons as $lesson)
		{
			$lesson_htmlfile=$htmlroot.$dirhtml_lesson.'/'.$lesson[htmlroot].'/'.$lesson[id].'.html';
			$lesson_link=file_exists($lesson_htmlfile)	?	$lesson_htmlfile	:	'view.php?action=lesson&info='.$lesson[id];
			$tpl->set_var(
				array(
					'LESSON_TIME'	=>	$lesson[addtime],
					'LESSON_NAME'	=>	wane_str($lesson[lesson],0,$string_lesson),
					'LESSON_LINK'	=>	$lesson_link,
				)
			);
			unset($lesson_file,$cache_lessons,$lesson);
			$tpl->parse('lessons','lesson',true);
		}

	}
	/*
	//+------------
	//+	start count
	//+------------
	*/
	$count_file='common/cache/cache_count.php';
	if (!file_exists($count_file))
	{
		unset($count_file);
		$tpl->set_var(
			array(
				'MEMBERS'		=>	'<font color=\'#ff0000\'>缓存文件无法载入</font>',
				'MEMBER_COM'	=>	'<font color=\'#ff0000\'>缓存文件无法载入</font>',
				'MEMBER_PER'	=>	'<font color=\'#ff0000\'>缓存文件无法载入</font>',
				'JOBS'			=>	'<font color=\'#ff0000\'>缓存文件无法载入</font>',
				'FINDS'			=>	'<font color=\'#ff0000\'>缓存文件无法载入</font>',
			)
		);
	}
	else
	{
		require $count_file;
		$tpl->set_var(
			array(
				'MEMBERS'		=>	$cache_count[members],
				'MEMBER_COM'	=>	$cache_count[member_com],
				'MEMBER_PER'	=>	$cache_count[member_per],
				'JOBS'			=>	$cache_count[jobs],
				'FINDS'			=>	$cache_count[finds],
			)
		);
		unset($count_file);
	}
	/*
	//+----------
	//+	start job
	//+----------
	*/
	$job_file='common/cache/cache_job.php';
	if (!file_exists($job_file))
	{
		unset($job_file);
		$tpl->set_var(
			array(
				'JOB_NAME'	=>	'<font color=\'#ff0000\'>Error:</font>',
				'COMPANY'	=>	'缓存文件',
				'JOB_EDU'	=>	'cache_job.php',
				'JOB_MAN'	=>	'无法载入',
				'JOB_TIME'	=>	'或缓存文件不存在',
				'JOB_LINK'	=>	'#',
				'COM_LINK'	=>	'#',
			)
		);
	}
	else
	{
		require $job_file;
		$tpl->set_block('main','job','jobs');
		foreach($cache_job as $job)
		{
			$job_htmlfile=$htmlroot.$dirhtml_job.'/'.$job[htmlroot].'/'.$job[id].'.html';
			$joblink=file_exists($job_htmlfile)	?	$job_htmlfile	:	'view.php?action=showjob&info='.$job[id];
			$tpl->set_var(
				array(
					'JOB_NAME'	=>	wane_str($job[job],0,$string_job),
					'COMPANY'	=>	wane_str($job[qyname],0,$string_company),
					'JOB_EDU'	=>	$job[edu],
					'JOB_MAN'	=>	$job[man],
					'JOB_TIME'	=>	$job[addtime],
					'JOB_LINK'	=>	$joblink,
					'COM_LINK'	=>	'view.php?action=company&info='.urlencode($job[username]),
				)
			);
			unset($job_file,$job_htmlfile,$cache_job,$job);
			$tpl->parse('jobs','job',true);
		}
	}

	/*
	//+-----------
	//+	start find
	//+-----------
	*/
	$find_file='common/cache/cache_find.php';
	if (!file_exists($find_file))
	{
		unset($find_file);
		$tpl->set_var(
			array(
				'FIND_NAME'	=>	'<font color=\'#ff0000\'>Error:</font>',
				'TRUENAME'	=>	'缓存文件',
				'FIND_SEX'	=>	'cache_find.php',
				'FIND_BIRTH'	=>	'无法载入',
				'FIND_EDU'	=>	'或',
				'FIND_TIME'	=>	'缓存文件不存在',
				'FIND_LINK'	=>	'#',
				'PER_LINK'	=>	'#',
			)
		);
	}
	else
	{
		require $find_file;
		$tpl->set_block('main','find','finds');
		foreach($cache_find as $find)
		{
			$find_htmlfile=$htmlroot.$dirhtml_find.'/'.$find[htmlroot].'/'.$find[id].'.html';
			$link_find=file_exists($find_htmlfile)	?	$find_htmlfile	:	'view.php?action=showfind&info='.$info[id];
			$tpl->set_var(
				array(
					'FIND_NAME'	=>	wane_str($find[job],0,$string_find),
					'TRUENAME'	=>	wane_str($find[truename],0,$string_personal),
					'FIND_SEX'	=>	$find[sex],
					'FIND_BIRTH'=>	$find[birth],
					'FIND_EDU'	=>	$find[edu],
					'FIND_TIME'	=>	$find[addtime],
					'FIND_LINK'	=>	$link_find,
					'PER_LINK'	=>	'view.php?action=personal&info='.urlencode($find[username]),
				)
			);
			unset($find_file,$cache_find,$find,$find_htmlfile,$linkfind);
			$tpl->parse('finds','find',true);
		}
	}
	/*
	//+--------------
	//+	start company
	//+--------------
	*/
	$company_file='common/cache/cache_companys.php';
	if (!file_exists($company_file))
	{
		unset($company_file);
		$tpl->set_var(
			'NEW_COMPANY'	,	'<FONT COLOR=\'#FF0000\'>载入缓存失败</FONT>'
		);
	}
	else
	{
		require $company_file;
		$tpl->set_block('main','company','companys');
		foreach($cache_companys as $company)
		{
			$tpl->set_var(
				'NEW_COMPANY'	,	'<a href=\'view.php?action=company&info='.urlencode($company[username]).'\' target=\'_blank\'>'.wane_str($company[qyname],0,$string_company).'</a>'
			);
			//unset($company_file,$cache_companys,$company);
			$tpl->parse('companys','company',true);
		}
	}
	/*
	//+---------------
	//+	start personal
	//+---------------
	*/
	$personal_file='common/cache/cache_personals.php';
	if (!file_exists($personal_file))
	{
		unset($personal_file);
		$tpl->set_var(
			array(
				'PERSONAL'	=>	'<FONT COLOR=\'#FF0000\'>载入缓存失败</FONT>',
				'SEX'		=>	'#',
			)
		);
	}
	else
	{
		require $personal_file;
		$tpl->set_block('main','personal','personals');
		foreach($cache_personals as $personal)
		{
			$tpl->set_var(
				array(
					'PERSONAL'	=>	wane_str($personal[truename],0,$string_personal),
					'PERSONAL_LINK'	=>	'view.php?action=personal&info='.urlencode($personal[username]),
					'SEX'		=>	$personal[sex],
				)
			);
			$tpl->parse('personals','personal',true);
		}
	}


	if ($flink_info)
	{
		$linksfile	=	'common/cache/cache_freelink.php';
		if (file_exists($linksfile))
		{
			require $linksfile;
			$tpl->set_block('main','freelink','freelinks');
			$li=1;
			foreach ($cache_freelink as $links)
			{
				$lis=$li++;
				$linktr	=	$lis%$flink_num_row=='0'	?	'</tr><tr>'	:	'';
				$freelink	=	$links[img]	?	"<a href=\"".$links[url]."\" title=\"".$links[title]."\r\n".$links[context]."\" target=\"_blank\"><img src=\"".$links[img]."\" width=\"88\" height=\"31\" border=\"0\"></a>"	:	"<a href=\"".$links[url]."\" title=\"".$links[context]."\" target=\"_blank\">".$links[title]."</a>";
				$tpl->set_var(
					array(
						'LINKTR'	=>	$linktr,
						'FREELINK'	=>	$freelink,
					)
				);
				$tpl->parse('freelinks','freelink',true);
			}
		}
		unset($linksfile);
	}

	if ($process_info=='1')
	{
		$process=$DEBUG->process();
		$queries=$db->querynum;
		$tpl->set_var(PROCESS_INFOS,"Process in $process second(s) with $queries Queries $pagegzipinfo .");
		$tpl->set_var('WANE_PROCESS',$process);
		$tpl->set_var('WANE_QUERY',$db->querynum.' Queries');
	}
	require 'common/lang/search/search_job.php';
	//+---------------------
	//+	out put start
	//+---------------------
	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
?>