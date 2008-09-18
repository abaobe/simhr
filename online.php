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

	$tpl->set_file(
					array(
						'top' => 'common/header.html',
						'main' => 'online.html',
						'down' => 'common/footer.html'
						)
				);
	$count='25';
	$table=SESSIONTABLE;
	$str='0';
	$str2='';
	require 'common/page_count.php';
	$sql=$db->query("select * from ".SESSIONTABLE." order by activetime desc limit $offset,$psize");
	$tpl->set_block('main','online','onlines');
	while($row=$db->row($sql))
	{
		$sessuser=$row['username'];
		if ($sessuser!='')	{$tpl->set_var('SESSUSER',$sessuser);}
		else	{$tpl->set_var('SESSUSER','游客');}
		$sessip=explode('.',$row['ipadd']);
		if (adminlogined()<='0')
		{$tpl->set_var('SESSIP',$sessip[0].'.'.$sessip[1].'.*.*');}
		else
		{$tpl->set_var('SESSIP',$row['ipadd']);}
		$sessurl=substr($row['linkurl'],0,20);
		switch ($sessurl)
		{
			//case 'index.php?'	:	$sessinfo='查看首页';break;
			case 'index.php'	:	$sessinfo='查看首页';break;
			//case 'online.php?'	:	$sessinfo='查看在线列表';break;
			case 'online.php'	:	$sessinfo='查看在线列表';break;
			//case 'job.php?'	:	$sessinfo='查看 最新招聘';break;
			case 'job.php'	:	$sessinfo='查看 最新招聘';break;
			//case 'find.php?'	:	$sessinfo='查看 最新求职';break;
			case 'find.php'	:	$sessinfo='查看 最新求职';break;
			//case 'personal.php?'	:	$sessinfo='个人控制面板';break;
			case 'personal.php'	:	$sessinfo='个人控制面板';break;
			//case 'company.php?'	:	$sessinfo='企业控制面板';break;
			case 'company.php'	:	$sessinfo='企业控制面板';break;
		}
		$tpl->set_var('SESSTAKE',$sessurl);
		$tpl->set_var('SESSTIME',date("H:i:s",$row['activetime']));
		$tpl->parse('onlines','online',true);
	}
	require 'common/page_show.php';
	//+---------------------
	//+	out put end
	//+---------------------
	$headtitle=headtitle($webtitle.'    '.$lang_online_list_info);
	require_once 'common/common.php';

	tpl_out();
	//+---------------------
	//+	out put end
	//+---------------------
?>