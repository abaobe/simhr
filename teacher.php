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
	if ($action=='job')
	{
		tpl_load('teacher_actionjob');
		$headtitle=headtitle($webtitle.' - 招聘家教');
		$count=$num_putteach_list;
		$table=$tablepre.'teacher_job';
		$str="losetime > '".time()."' and sign = '1'";
		if ($method=='search')
		{
			if ($addtime=='' || $addtime=='0' || !isset($addtime)){$str=$str;}else{$str.=" and puttime > '".(time()-$addtime)."'";}
			if ($sex=='' || $sex=='0' || !isset($sex)){$str=$str;}else{$str.=" and sex='".urldecode($sex)."'";}
			if ($edu=='' || $edu=='0' || !isset($edu)){$str=$str;}else{$str.=" and edu ='".urldecode($edu)."'";}
			if ($title=='' || !isset($title)){$str=$str;}else{$str.=" and title like '%".urldecode($title)."%'";}
			if ($address=='' || !isset($address)){$str=$str;}else{$str.=" and address like '%".urldecode($address)."%'";}
			$str2="action=job&method=search&addtime=$addtime&sex=".urlencode(urldecode($sex))."&edu=".urlencode(urldecode($edu))."&title=".urlencode(urldecode($title))."&address=".urlencode(urldecode($address));
		}
		else
		{
			$str2="action=job";
		}
		require "common/page_count.php";

		if ($RIGHT[page_teacher_job]!='-1' && $page > $RIGHT[page_teacher_job])	{echo clickback($lang_right[3]);exit;}

		$query=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
		$tpl->set_block('main','joblist','joblists');
		while ($job=$db->row($query))
		{
			$htmljobfile=$htmlroot.$dirhtml_findteacher.'/'.$job[htmlroot].'/'.$job[id].'.html';
			$job_link=file_exists($htmljobfile)	?	$htmljobfile	:	'view.php?action=teacherjob&info='.$job[id]	;
			$tpl->set_var(
				array(
					'JOB_LINK'		=>	$job_link,
					'JOB_TITLE'		=>	$job[title],
					'JOB_SEX'		=>	$job[sex],
					'JOB_EDU'		=>	$job[edu],
					'JOB_CONTACT'	=>	$job[contact_name],
					'JOB_TIME'		=>	date($time_putteacher,$job[puttime]),
				)
			);
			//unset($htmljobfile,$job_link);
			$tpl->parse('joblists','joblist',true);
		}
		require 'common/page_show.php';
	}
	else if ($action=='find')
	{
		tpl_load('teacher_actionfind');
		$headtitle=headtitle($webtitle.' - 求职家教');
		$count=$num_findteach_list;
		$str="losetime > '".time()."' and sign = '1'";
		if ($method=='search')
		{
			if ($addtime=='' || $addtime=='0' || !isset($addtime)){$str=$str;}else{$str.=" and puttime > '".(time()-$addtime)."'";}
			if ($sex=='' || $sex=='0' || !isset($sex)){$str=$str;}else{$str.=" and sex='".urldecode($sex)."'";}
			if ($edu=='' || $edu=='0' || !isset($edu)){$str=$str;}else{$str.=" and edu ='".urldecode($edu)."'";}
			if ($title=='' || !isset($title)){$str=$str;}else{$str.=" and title like '%".urldecode($title)."%'";}
			if ($zhuanye=='' || !isset($zhuanye)){$str=$str;}else{$str.=" and depart like '%".urldecode($zhuanye)."%'";}
			if ($living=='' || !isset($living)){$str=$str;}else{$str.=" and living like '%".urldecode($living)."%'";}
			$str2="action=job&method=search&addtime=$addtime&sex=".urlencode(urldecode($sex))."&edu=".urlencode(urldecode($edu))."&title=".urlencode(urldecode($title))."&zhuanye=".urlencode(urldecode($zhuanye))."&living=".urlencode(urldecode($living));
		}
		else
		{
			$str2="action=find";
		}
		$table=$tablepre.'teacher_find';
		require 'common/page_count.php';

		if ($RIGHT[page_teacher_find]!='-1' && $page > $RIGHT[page_teacher_find])	{echo clickback($lang_right[3]);exit;}

		$query=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
		$tpl->set_block('main','findlist','findlists');
		while ($find=$db->row($query))
		{
			$htmlfindfile=$htmlroot.$dirhtml_taketeacher.'/'.$find[htmlroot].'/'.$find[id].'.html';
			$find_link=file_exists($htmlfindfile)	?	$htmlfindfile	:	'view.php?action=teacherfind&info='.$find[id]	;
			$tpl->set_var(
				array(
					'FIND_LINK'		=>	$find_link,
					'FIND_TITLE'	=>	$find[title],
					'FIND_SEX'		=>	$find[sex],
					'FIND_EDU'		=>	$find[edu],
					'FIND_NAME'		=>	$find[truename],
					'FIND_TIME'		=>	date($time_findteacher,$find[puttime]),
				)
			);
			unset($htmlfindfile,$find_link);
			$tpl->parse('findlists','findlist',true);
		}
		require 'common/page_show.php';

	}
	else
	{
		tpl_load('teacher');
		$headtitle=headtitle($webtitle.' - 家教专区');
		//+	start teacher job
		$job_file='common/cache/cache_teacherjob.php';
		if (!file_exists($job_file))
		{
			unset($job_file);
			$tpl->set_var(
				array(
					'JOB_LINK'		=>	'#',
					'JOB_TITLE'		=>	'<font color=\'#ff0000\'>Error:</font>',
					'JOB_SEX'		=>	'错误原因:',
					'JOB_EDU'		=>	'缓存文件不存在',
					'JOB_CONTACT'	=>	'或',
					'JOB_TIME'		=>	'缓存文件载入失败',
				)
			);
		}
		else
		{
			require $job_file;
			unset($job_file);
			$tpl->set_block('main','joblist','joblists');
			foreach ($cache_teacherjob as $job)
			{
				$htmljobfile=$htmlroot.$dirhtml_findteacher.'/'.$job[htmlroot].'/'.$job[id].'.html';
				$job_link=file_exists($htmljobfile)	?	$htmljobfile	:	'view.php?action=teacherjob&info='.$job[id]	;
				$tpl->set_var(
					array(
						'JOB_LINK'		=>	$job_link,
						'JOB_TITLE'		=>	$job[title],
						'JOB_SEX'		=>	$job[sex],
						'JOB_EDU'		=>	$job[edu],
						'JOB_CONTACT'	=>	$job[contact],
						'JOB_TIME'		=>	$job[addtime],
					)
				);
				unset($htmljobfile,$job_link);
				$tpl->parse('joblists','joblist',true);
			}
		}
		//+	end teacher job

		$findfile='common/cache/cache_teacherfind.php';
		if (!file_exists($findfile))
		{
			unset($findfile);
			$tpl->set_var(
				array(
					'FIND_LINK'		=>	'#',
					'FIND_TITLE'		=>	'<font color=\'#ff0000\'>Error:</font>',
					'FIND_SEX'		=>	'错误原因:',
					'FIND_EDU'		=>	'缓存文件不存在',
					'FIND_CONTACT'	=>	'或',
					'FIND_TIME'		=>	'缓存文件载入失败',
				)
			);
		}
		else
		{
			require $findfile;
			unset($findfile);
			$tpl->set_block('main','findlist','findlists');
			foreach ($cache_teacherfind as $find)
			{
				$htmlfindfile=$htmlroot.$dirhtml_taketeacher.'/'.$find[htmlroot].'/'.$find[id].'.html';
				$find_link=file_exists($htmlfindfile)	?	$htmlfindfile	:	'view.php?action=teacherfind&info='.$find[id]	;
				$tpl->set_var(
					array(
						'FIND_LINK'		=>	$find_link,
						'FIND_TITLE'	=>	$find[title],
						'FIND_SEX'		=>	$find[sex],
						'FIND_EDU'		=>	$find[edu],
						'FIND_NAME'		=>	$find[contact],
						'FIND_TIME'		=>	$find[addtime],
					)
				);
				unset($htmlfindfile,$find_link);
				$tpl->parse('findlists','findlist',true);
			}
		}
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
	require 'common/lang/search/search_teacher.php';
	//+---------------------
	//+	out put start
	//+---------------------
	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
?>