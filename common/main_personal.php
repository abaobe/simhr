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
	|   > Last	modify	:	2004/12/13 23:13
	+-------------------------------------------
	*/

	/*
	+-------------------------------------------
	+	count reciver
	+-------------------------------------------
	*/
	$query_reciver=$db->query("select * from {$tablepre}per_rec where per_id = '$wane_user'");
	$rec=0;$rec_new=0;
	while ($row_reciver=$db->row($query_reciver))
	{
		$rec+=1;
		!$row_reciver[isnew]	?	$rec_new+=1		:	'';
	}

	/*
	+-------------------------------------------
	+	count send
	+-------------------------------------------
	*/
	$query_send=$db->query("select * from {$tablepre}per_send where user_id = '$wane_user'");
	$send=0;$send_old=0;
	while ($row_send=$db->row($query_send))
	{
		$send+=1;
		$row_send[isnew]	?	$send_old+=1	:	''	;
	}

	/*
	+-------------------------------------------
	+	count send
	+-------------------------------------------
	*/
	$favourite=$db->num($db->query("select * from {$tablepre}job_fav where user_id='$wane_user'"));

	/*
	+-------------------------------------------
	+	count hunter reciver
	+-------------------------------------------
	*/
	$query_hrec=$db->query("select * from {$tablepre}send_hunter_per where rec='$wane_user'");
	$h_rec=0;$h_rec_new=0;
	while ($row_hrec=$db->row($query_hrec))
	{
		$h_rec+=1;
		!$row_hrec[isnew]	?	$h_rec_new+=1	:	'';
	}


	/*
	+-------------------------------------------
	+	count hunter send
	+-------------------------------------------
	*/
	$query_hsend=$db->query("select * from {$tablepre}send_hunter_com where send='$wane_user'");
	$h_send=0;$h_send_old=0;
	while ($row_h_send=$db->row($query_hsend))
	{
		$h_send+=1;
		$row_h_send[isnew]	?	$h_send_old+=1	:	''	;
	}

	/*
	+-------------------------------------------
	+	count hunter favourite
	+-------------------------------------------
	*/
	$h_favourite=$db->num($db->query("select * from {$tablepre}find_fav where user_id='$wane_user'"));






	/*
	+-------------------------------------------
	+	query jianli
	+-------------------------------------------
	*/
	$query_jianli=$db->query("select * from {$tablepre}jianli where username='$wane_user'");
	$row_jianli=$db->row($query_jianli,MYSQL_BOTH);
	$jls=0;
	for ($jl=2;$jl<=50;$jl++)
	{
		$row_jianli[$jl]!=''	?	$jls+=1		:	'';
	}
	$wane_img=($row_jianli[mem_img] && file_exists($row_jianli[mem_img]))		?	'<img src=\''.$row_jianli[mem_img].'\' width=\'85\' height=\'110\' class=\'td_four\'>'	:	'暂无图片'	;
	$wane_click=$row_jianli[clicked];
	$wane_update=$row_jianli[lastupdate]>1000000001	?	date("Y-n-j H:i",$row_jianli[lastupdate])	:	'Never';


	/*
	+-------------------------------------------
	+	template out
	+-------------------------------------------
	*/
	$tpl->set_var(
		array(
			'PERSONAL_USER'	=>	$wane_user,
			'WANE_WEBSITE'	=>	$webtitle,
			'WANE_LOGINS'	=>	$user_cfg[logins],

			'WANE_REC'		=>	$rec,
			'WANE_REC_NEW'	=>	$rec_new,

			'WANE_SEND'		=>	$send,
			'WANE_SEND_OLD'	=>	$send_old,

			'WANE_FAVOURITE'	=>	$favourite,

			'WANE_HREC'		=>	$h_rec,
			'WANE_HREC_NEW'	=>	$h_rec_new,

			'WANE_HSEND'		=>	$h_send,
			'WANE_HSEND_OLD'	=>	$h_send_old,

			'WANE_HFAVOURITE'	=>	$h_favourite,// hunter favourite

			'WANE_IMG'			=>	$wane_img,
			'WANE_CLICK'		=>	$wane_click,
			'WANE_UPDATE'		=>	$wane_update,
			'JIANLI_PERCENT'	=>	ceil(($jls/48)*100).'%',
		)
	);
?>