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
	tpl_load('job');
	$headtitle=headtitle($webtitle.' - 最新招聘');
	require_once 'common/common.php';

	$jobtypefile	=	'common/cache/cache_jobtype.php';
	if (!file_exists($jobtypefile))
	{
		unset($jobtypefile);
		update_cache('jobtype','0');
		exit('Create cache.<br>Please refresh.');
	}
	else
	{
		require $jobtypefile;
		unset($jobtypefile);
		$separate	=	"";
		foreach ($cache_jobtype as $jtype)
		{
			$jobtype_list.="$separate<a href=\"job.php?tid=$jtype[tid]\">$jtype[title]</a>";
			$separate	=	" | ";
		}
		$tpl->set_var('JOBTYPE_LIST',$jobtype_list);
	}




	// start job
	$jt=JOBTABLE;
	$qj=QYJIANLITABLE;
	$count=$num_job_list;
	$table = $jt.','.$qj;
	if ($action=='search')
	{
		$sstr = "$jt.id,$jt.username,$jt.job,$jt.man,$jt.sex,$jt.edu,$jt.puttime,$jt.sign,$jt.edu,$jt.htmlroot,$qj.qyuser,$qj.qyname";
		$str="$jt.username=$qj.qyuser and $jt.sign='1' and $jt.losetime > '".time()."'";
		//+	addtime
		if ($addtime=='0' || empty($addtime) || !is_numeric($addtime) || !isset($addtime)){$str=$str;}else{$str.=" and $jt.puttime > '".(time()-$addtime)."'";}
		//+	sex
		if ($sex=='0' || empty($sex) || !isset($sex)){$str=$str;}else{$str.=" and $jt.sex='".urldecode($sex)."'";}
		//+	edu
		if ($edu=='0' || empty($edu) || !isset($edu)){$str=$str;}else{$str.=" and $jt.edu = '".urldecode($edu)."'";}
		//+	job
		if ($job==''  || empty($job) || !isset($job)){$str=$str;}else{$str.=" and $jt.job like '%".urldecode($job)."%'";}
		//+	address
		if ($address==''  || empty($address) || !isset($address)){$str=$str;}else{$str.=" and $jt.address like '%".urldecode($address)."%'";}
		$str2="action=search&addtime=$addtime&sex=".urlencode(urldecode($sex))."&edu=".urlencode(urldecode($edu))."&job=".urlencode(urldecode($job))."&address=".urlencode(urldecode($address));
	}
	elseif (!empty($tid) && isset($tid))
	{
		$sstr = "$jt.id,$jt.tid,$jt.username,$jt.job,$jt.man,$jt.puttime,$jt.sign,$jt.edu,$jt.htmlroot,$qj.qyuser,$qj.qyname";
		$str = "$jt.tid='$tid' and $jt.username=$qj.qyuser and $jt.sign='1' and $jt.losetime > '".time()."'";
		$str2 = "";
	}
	else
	{
		$sstr = "$jt.id,$jt.username,$jt.job,$jt.man,$jt.puttime,$jt.sign,$jt.edu,$jt.htmlroot,$qj.qyuser,$qj.qyname";
		$str = "$jt.username=$qj.qyuser and $jt.sign='1' and $jt.losetime > '".time()."'";
		$str2 = "";
	}

	require "common/page_count.php";

	if ($RIGHT[page_job]!='-1' && $page > $RIGHT[page_job])	{echo clickback($lang_right[3]);exit;}

	$sql_job="select $sstr from $table where $str order by $jt.puttime desc limit $offset,$psize";
	$query_job=$db->query($sql_job);
	$tpl->set_block('main','joblist','joblists');
	while ($row_job=$db->row($query_job))
	{
		$tpl->set_var('LINK',$row_job['id']);
		$tpl->set_var('LINKCOM',urlencode($row_job['username']));
		if ($html_job=='1')
		{
			$infourllink=infourl($dirhtml_job,$row_job['htmlroot'],$row_job['id']);
			$infourl=($infourllink!='0')?$infourllink:'view.php?action=showjob&info='.$row_job['id'];
			$tpl->set_var('JOB','<a href=\''.$infourl.'\' target=\'_blank\'>'.$row_job['job'].'</a>');
		}
		else
		{
			$tpl->set_var('JOB','<a href=\'view.php?action=showjob&info='.$row_job['id'].'\' target=\'_blank\'>'.$row_job['job'].'</a>');
		}
		$tpl->set_var('COMPANY',$row_job['qyname']);
		$tpl->set_var('EDU',$row_job['edu']);
		$jobman=$row_job['man'];
		if (is_numeric($jobman) && $jobman > '0')
		{
			$tpl->set_var('MAN',$row_job['man']);
		}
		else
		{
			$tpl->set_var('MAN','不限');
		}
		$tpl->set_var('ADDTIME',date("Y-m-d",$row_job['puttime']));
		$tpl->parse('joblists','joblist',true);
	}
	require_once 'common/page_show.php';
	// end job


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


	//+---------------------
	//+	out put start
	//+---------------------
	if ($process_info=='1')
	{
		$process=$DEBUG->process();
		$queries=$db->querynum;
		$tpl->set_var(PROCESS_INFOS,"Process in $process second(s) with $queries Queries $pagegzipinfo .");
		$tpl->set_var('WANE_PROCESS',$process);
		$tpl->set_var('WANE_QUERY',$db->querynum.' Queries');
	}
	require 'common/lang/search/search_job.php';
	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
	?>