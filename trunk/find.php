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
	|   > Last	modify	:	2004/11/14 20:28
	+-------------------------------------------
	*/

	require_once "globals.php";
	tpl_load('find');
	$headtitle=headtitle($webtitle.' - 最新求职');
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
			$jobtype_list.="$separate<a href=\"find.php?tid=$jtype[tid]\">$jtype[title]</a>";
			$separate	=	" | ";
		}
		$tpl->set_var('JOBTYPE_LIST',$jobtype_list);
	}

	// start find
	$ft=FINDJOBTABLE;
	$pj=JIANLITABLE;
	$count=$num_find_list;
	$table = $ft.','.$pj;
	if ($action=='search')
	{
		$searchurl="find.php?action=search&addtime=$addtime&sex=".urlencode($sex)."&edu=".urlencode($edu)."&zhuanyename=".urlencode($zhuanyename)."&graedu=".urlencode($graedu);

		$sstr = "$ft.id,$ft.username,$ft.job,$ft.puttime,$ft.sign,$ft.htmlroot,$pj.username,$pj.truename,$pj.sex,$pj.birth,$pj.edu,$pj.zhuanye,$pj.graedu";
		$str = "$ft.username=$pj.username and $ft.sign='1' and $ft.losetime > '".time()."'";

		//+	addtime
		if ($addtime=='0' || empty($addtime) || !is_numeric($addtime) || !isset($addtime)){$str=$str;}else{$str.=" and $ft.puttime > '".(time()-$addtime)."'";}
		//+	sex
		if ($sex=='0' || empty($sex) || !isset($sex)){$str=$str;}else{$str.=" and $pj.sex='".urldecode($sex)."'";}
		//+	edu
		if ($edu=='0' || empty($edu) || !isset($edu)){$str=$str;}else{$str.=" and $pj.edu = '".urldecode($edu)."'";}
		//+	job
		if ($job==''  || empty($job) || !isset($job)){$str=$str;}else{$str.=" and $ft.job like '%".urldecode($job)."%'";}
		//+	zhuanye
		if ($zhuanyename==''  || empty($zhuanyename) || !isset($zhuanyename)){$str=$str;}else{$str.=" and $pj.zhuanye like '%".urldecode($zhuanyename)."%'";}
		//+	graedu
		if ($graedu==''  || empty($graedu) || !isset($graedu)){$str=$str;}else{$str.=" and $pj.graedu like '%".urldecode($graedu)."%'";}
		$str2 = "action=search&addtime=$addtime&sex=".urlencode(urldecode($sex))."&edu=".urlencode(urldecode($edu))."&job=".urlencode(urldecode($job))."&zhuanyename=".urlencode(urldecode($zhuanyename))."&graedu=".urlencode(urldecode($graedu));
	}
	elseif (!empty($tid) && isset($tid))
	{
		$sstr = "$ft.id,$ft.tid,$ft.username,$ft.job,$ft.puttime,$ft.sign,$ft.htmlroot,$pj.username,$pj.truename,$pj.sex,$pj.birth,$pj.edu";
		$str = "$ft.tid='$tid' and $ft.username=$pj.username and $ft.sign='1' and $ft.losetime > '".time()."'";
		$str2 = "tid=$tid";
	}
	else
	{
		$sstr = "$ft.id,$ft.username,$ft.job,$ft.puttime,$ft.sign,$ft.htmlroot,$pj.username,$pj.truename,$pj.sex,$pj.birth,$pj.edu";
		$str = "$ft.username=$pj.username and $ft.sign='1' and $ft.losetime > '".time()."'";
		$str2 = "";
	}
	require "common/page_count.php";

	if ($RIGHT[page_find]!='-1' && $page > $RIGHT[page_find])	{echo clickback($lang_right[3]);exit;}

	$sql_find="select $sstr from $table where $str order by $ft.puttime desc limit $offset,$psize";
	$query_find=$db->query($sql_find);
	$tpl->set_block('main','findlist','findlists');
	while ($row_find=$db->row($query_find))
	{
		$tpl->set_var('LINK',$row_find['id']);
		$tpl->set_var('LINKPER',urlencode($row_find['username']));
		if ($html_find=='1')
		{
			$infourllink=infourl($dirhtml_find,$row_find['htmlroot'],$row_find['id']);
			$infourl=($infourllink!='0')?$infourllink:'view.php?action=showfind&info='.$row_find['id'];
			$tpl->set_var('JOB','<a href=\''.$infourl.'\' target=\'_blank\'>'.wane_str($row_find['job'],0,30).'</a>');
		}
		else
		{
			$tpl->set_var('JOB','<a href=\'view.php?action=showfind&info='.$row_find['id'].'\' target=\'_blank\'>'.wane_str($row_find['job'],0,30).'</a>');
		}
		$tpl->set_var('TRUENAME',$row_find['truename']);
		$tpl->set_var('SEX',$row_find['sex']);
		$tpl->set_var('BIRTH',$row_find['birth']);
		$tpl->set_var('EDU',$row_find['edu']);
		$jobman=$row_find['man'];
		if (is_numeric($jobman) && $jobman > '0')
		{
			$tpl->set_var('MAN',$row_find['man']);
		}
		else
		{
			$tpl->set_var('MAN','不限');
		}
		$tpl->set_var('ADDTIME',date("Y-m-d",$row_find['puttime']));
		$tpl->parse('findlists','findlist',true);
	}
	require_once 'common/page_show.php';
	// end find

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