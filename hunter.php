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
		tpl_load('hunter_job');
		$headtitle=headtitle($webtitle.' - 猎头职位');
		$count=$num_comhunter_list;
		$j=$tablepre.'hunter_com';
		$c=$tablepre.'jianliqy';
		if ($method=='search')
		{
			$sstr="$c.qyuser,$c.qyname,$c.qykind,$j.*";
			$str="$c.qyuser=$j.username and $j.sign='1' and $j.losetime > '".time()."'";
			if ($addtime=='' || $addtime=='0' || empty($addtime)){$str=$str;}else{$str.=" and $j.addtime > '".(time()-$addtime)."'";}
			if ($industry=='' || !isset($industry)){$str=$str;}else{$str.=" and $c.qykind='".urldecode($industry)."'";}
			if ($qyname==''	|| !isset($qyname)){$str=$str;}else{$str.=" and $c.qyname like '".urldecode($qyname)."'";}
			if ($job=='' || !isset($job)){$str=$str;}else{$str.=" and job like '%".urldecode($job)."%'";}
			if ($address=='' || !isset($address)){$str=$str;}else{$str.=" and job_address like '%".urldecode($address)."%'";}
			$str2="action=job&method=search&addtime=$addtime&industry=".urlencode(urldecode($industry))."&job=".urlencode(urldecode($job))."&qyname=".urlencode(urldecode($job))."&address=".urlencode(urldecode($address));
		}
		else
		{
			$sstr="$c.qyuser,$c.qyname,$j.*";
			$str="$c.qyuser=$j.username and $j.sign='1' and $j.losetime > '".time()."'";
			$str2="action=job";
		}
		$table=$j.','.$c;
		require 'common/page_count.php';

		if ($RIGHT[page_hunterjob]!='-1' && $page > $RIGHT[page_hunterjob])	{echo clickback($lang_right[3]);exit;}

		$query=$db->query("select $sstr from $table where $str order by $j.id desc limit $offset,$psize");
		unset($j,$c,$sstr);
		$tpl->set_block('main','comlist','comlists');
		while ($row=$db->row($query))
		{
			$comfile=$htmlroot.$dirhtml_comhunter.'/'.$row[htmlroot].'/'.$row['id'].'.html';
			$comlink=(file_exists($comfile))?$comfile:'view.php?action=hunterjob&info='.$row['id'];
			$tpl->set_var(
				array(
					'COMJOB'	=>	$row['job'],
					'COMPANY'	=>	$row['qyname'],
					'COMPUT'	=>	date("Y-n-j",$row['addtime']),
					'COMLOSE'	=>	date("Y-n-j",$row['losetime']),
					'COMLINK'	=>	$comlink
				)
			);
			unset($comfile,$comlink);
			$tpl->parse('comlists','comlist',true);
		}
		unset($str,$query,$row);
		require 'common/page_show.php';
		unset($str2);
	}
	else if ($action=='find')
	{
		tpl_load('hunter_find');
		$headtitle=headtitle($webtitle.' - 猎头人才');
		$count=$num_perhunter_list;
		if ($method=='search')
		{
			$str="sign='1' and losetime >'".time()."'";
			if ($addtime=='' || $addtime=='0' || !isset($addtime)){$str=$str;}else{$str.=" and addtime > '".(time()-$addtime)."'";}
			if ($industry=='' || $industry=='0' || !isset($industry)){$str=$str;}else{$str.=" and industry='".urldecode($industry)."'";}
			if ($sex=='' || $sex=='0' || !isset($sex)){$str=$str;}else{$str.=" and sex='".urldecode($sex)."'";}
			if ($edu=='' || $edu=='0' || !isset($edu)){$str=$str;}else{$str.=" and edu='".urldecode($edu)."'";}
			if ($job=='' || !isset($job)){$str=$str;}else{$str.=" and job like '".urldecode($job)."'";}
			if ($position=='' || !isset($position)){$str=$str;}else{$str.=" and position like '".urldecode($position)."'";}
			$str2="action=find&method=search&addtime=$addtime&industry=".urlencode(urldecode($industry))."&sex=".urlencode(urldecode($sex))."&edu=".urlencode(urldecode($edu))."&job=".urlencode(urldecode($job))."&position=".urlencode(urldecode($position));
		}
		else
		{
			$str="sign='1' and losetime >'".time()."'";
			$str2="action=find";
		}
		$table=$tablepre.'hunter_per';
		require 'common/page_count.php';

		if ($RIGHT[page_hunterfind]!='-1' && $page > $RIGHT[page_hunterfind])	{echo clickback($lang_right[3]);exit;}

		$query=$db->query("select * from $table where $str order by id desc limit $offset,$psize");
		$tpl->set_block('main','perlist','perlists');
		while ($row=$db->row($query))
		{
			$hunterfile=$htmlroot.$dirhtml_perhunter.'/'.$row[htmlroot].'/'.$row[id].'.html';
			$hunterlink=file_exists($hunterfile)	?	$hunterfile	:	'view.php?action=hunterfind&info='.$row[id]	;
			$tpl->set_var(
				array(
					'TRUENAME'		=>		$row['truename'],
					'PERINDUSTRY'	=>		$row['industry'],
					'PREPUT'		=>		date("Y-n-j",$row['addtime']),
					'PERLOSE'		=>		date("Y-n-j",$row['losetime']),
					'PERLINK'		=>		$hunterlink
				)
			);
			unset($hunterfile,$hunterlink);
			$tpl->parse('perlists','perlist',true);
		}
		unset($str,$table,$query,$row);
		require 'common/page_show.php';
		unset($str2);
	}
	else if ($action=='info')
	{
		tpl_load('hunter_info');
		$headtitle=headtitle($webtitle.' - 猎头资迅');
		$count=$num_hunterinfo_list;
		$table=$tablepre.'hunter_info';
		if ($method!='search')
		{
			$str='0';
			$str2="action=info";
			require "common/page_count.php";
			$sql="select * from $table order by id desc limit $offset,$psize";
		}
		else
		{
			$str="title like '%".urldecode($title)."%'";
			if ($content=='1'){$str.=" and context like '%".urldecode($title)."%'";}else{$str=$str;}
			require "common/page_count.php";
			$str2="action=info&method=search&title=".urlencode(urldecode($title))."&content=$content";
			$sql="select * from $table where $str order by id desc limit $offset,$psize";
		}
		$query=$db->query($sql);
		$tpl->set_block('main','infolist','infolists');
		while ($info=$db->row($query))
		{
			$htmlinfo=$htmlroot.$dirhtml_hunterinfo.'/'.$info[htmlroot].'/'.$info[id].'.html';
			$tpl->set_var(
				array(
					'INFO_TIME'		=>	date($time_hunterinfo,$info[addtime]),
					'INFO_TITLE'	=>	$info[title],
					'INFO_LINK'		=>	$htmlinfo,
					'DISCUSS'		=>	$info[replies],
				)
			);
			$tpl->parse('infolists','infolist',true);
		}
		require 'common/page_show.php';
	}
	else
	{
		tpl_load('hunter');
		$headtitle=headtitle($webtitle.' - 猎头专区');
		//+	hunter	info  start
		$cache_info='common/cache/cache_hunterinfo.php';
		if (!file_exists($cache_info))
		{
			unset($cache_info);
			$tpl->set_var(
				array(
					'INFO_TIME'		=>	'<font color=\'#ff0000\'>Error:</font>',
					'INFO_TITLE'	=>	'缓存文件不存在 或 载入失败',
					'INFO_LINK'		=>	'#',
				)
			);
		}
		else
		{
			require $cache_info;
			unset($cache_info);
			$tpl->set_block('main','infolist','infolists');
			foreach ($cache_hunterinfo as $info)
			{
				$htmlinfo=$htmlroot.$dirhtml_hunterinfo.'/'.$info[htmlroot].'/'.$info[id].'.html';
				$tpl->set_var(
					array(
						'INFO_TIME'		=>	$info[addtime],
						'INFO_TITLE'	=>	wane_str($info[title],0,$string_hunterinfo),
						'INFO_LINK'		=>	$htmlinfo,
					)
				);
				$tpl->parse('infolists','infolist',true);
			}
		}
		//+	hunter	info  end

		//+	hunter job start
		$cache_com='common/cache/cache_hunterjob.php';
		if (!file_exists($cache_com))
		{
			$tpl->set_var(
				array(
					'COMJOB'=>'载入缓存出错',
					'COMPANY'=>'<font color=\'#ff0000\'>'.$cache_com.'</font>',
					'COMPUT'=>'不存在',
				)
			);
			unset($cache_com);
		}
		else
		{
			require $cache_com;
			$tpl->set_block('main','comlist','comlists');
			foreach($cache_hunterjob as $job)
			{
				$comfile=$htmlroot.$dirhtml_comhunter.'/'.$job[htmlroot].'/'.$job['id'].'.html';
				$comlink=(file_exists($comfile))?$comfile:'view.php?action=hunterjob&info='.$job['id'];
				$tpl->set_var(
					array(
						'COMJOB'=>$job['job'],
						'COMPANY'=>$job['qyname'],
						'COMPUT'=>$job['addtime'],
						'COMLOSE'=>$job['losetime'],
						'COMLINK'=>$comlink
					)
				);
				unset($cache_com,$cache_hunterjob,$job,$comfile,$comlink);
				$tpl->parse('comlists','comlist',true);
			}
		}
		//+	hunter job end

		//+	hunter find start
		$cache_per='common/cache/cache_hunterfind.php';
		if (!file_exists($cache_per))
		{
			$tpl->set_var(
				array(
					'PERINDUSTRY'	=>	'载入缓存出错',
					'TRUENAME'	=>	'<font color=\'#ff0000\'>'.$cache_per.'</font>',
					'PREPUT'	=>	'不存在'
				)
			);
			unset($cache_per);
		}
		else
		{
			require $cache_per;
			$tpl->set_block('main','perlist','perlists');
			foreach ($cache_hunterfind as $find)
			{
				$perfile=$htmlroot.$dirhtml_perhunter.'/'.$find[htmlroot].'/'.$find[id].'.html';
				$perlink=(file_exists($perfile))?$perfile:'view.php?action=hunterfind&info='.$find['id'];
				$tpl->set_var(
					array(
						'TRUENAME'		=>		$find['truename'],
						'PERINDUSTRY'	=>		$find['industry'],
						'PREPUT'		=>		$find['addtime'],
						'PERLOSE'		=>		$find['losetime'],
						'PERLINK'		=>		$perlink
					)
				);
				unset($cache_per,$cache_hunterfind,$find,$perfile,$perlink);
				$tpl->parse('perlists','perlist',true);
			}
		}
		//+	hunter find end
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
	require 'common/lang/search/search_hunter.php';
	//+---------------------
	//+	out put start
	//+---------------------
	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
?>