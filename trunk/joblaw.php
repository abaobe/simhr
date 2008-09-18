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
	tpl_load('joblaw');
	$headtitle=headtitle($webtitle.' 政策法规');
	require_once 'common/common.php';
	$count=$num_joblawphp_list;
	$table=LAWTABLE;
	if ($action=='search')
	{
		$str="title like '%".urldecode($title)."%'";
		if ($content=='1'){$str.=" or context like '%".urldecode($title)."%'";}
		$str2="action=search&title=".urlencode(urldecode($title))."&content=$content";
		require 'common/page_count.php';
		$sql="select * from $table where $str order by id desc limit $offset,$psize";
	}
	else
	{
		$str='0';
		$str2='';
		require 'common/page_count.php';
		$sql="select * from $table order by id desc limit $offset,$psize";
	}
	$query=$db->query($sql);
	$tpl->set_block('main','law','laws');
	while ($new=$db->row($query))
	{
		$tpl->set_var(
			array(
					'NEWS_TITLE'	=>	$new['title'],
					'NEWS_DATE'		=>	date('Y-n-j',$new['addtime']),
					'NEWS_LINK'		=>	$htmlroot.$dirhtml_law.'/'.$new['htmlroot'].'/'.$new['id'].'.html',
					'DISCUSS'		=>	$new[replies],
			)
		);
		$tpl->parse('laws','law',true);
	}
	require 'common/page_show.php';
	if ($process_info=='1')
	{
		$process=$DEBUG->process();
		$queries=$db->querynum;
		$tpl->set_var(PROCESS_INFOS,"Process in $process second(s) with $queries Queries $pagegzipinfo .");
		$tpl->set_var('WANE_PROCESS',$process);
		$tpl->set_var('WANE_QUERY',$db->querynum.' Queries');
	}
	//+---------------------
	//+	out put start
	//+---------------------
	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
?>