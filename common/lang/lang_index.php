<?php
	/*
	+--------------------------------------------------------------------------
	|   Technology of SimPHP
	|   ========================================
	|   Powered by PHP365.CN
	|   (c) 2007 php365.cn Power Services
	|   http://www.php365.cn
	|   ========================================
	|   Web: http://www.php365.cn
	|   Email: webmaster@ewannan.com
	|   Phone: 0553-2237136 , (0)13966013721
	|	QQ:	39053386
	|	MSN: fuyibing1@hotmail.com
	+--------------------------------------------------------------------------
	|   > Date started: 2004/12/6
	+--------------------------------------------------------------------------
	*/
	/*
	for ($num_sjob=0;$num_sjob<count($lang_sjob);$num_sjob++)
	{
		$tpl->set_var('SJ'.$num_sjob,$lang_sjob[$num_sjob]);
	}*/
	$search_jobtime='<option value=\'0\'>'.$lang_unset.'</option>';
	foreach($lang_stime as $key=>$val)
	{
		$search_jobtime.='<option value=\''.$key.'\'>'.$val.'</option>';
	}

	$tpl->set_var('LANG STIME',$search_jobtime);
	unset($search_jobtime);

	/*
	for ($num_sfind=0;$num_sfind<count($lang_sfind);$num_sfind++)
	{
		$tpl->set_var('SF'.$num_sfind,$lang_sfind[$num_sfind]);
	}*/
	$search_sex='<option value=\'0\'>'.$lang_unset.'</option><option value=\''.$lang_ssex[0].'\'>'.$lang_ssex[0].'</option><option value=\''.$lang_ssex[1].'\'>'.$lang_ssex[1].'</option>';
	$tpl->set_var('SEARCH_SSEX',$search_sex);
	unset($seach_sex);

	$search_edu='<option value=\'0\'>'.$lang_unset.'</option>';
	for ($num_edu=0;$num_edu<count($lang_edu);$num_edu++)
	{
		$search_edu.='<option value=\''.$lang_edu[$num_edu].'\'>'.$lang_edu[$num_edu].'</option>';
	}
	$tpl->set_var('SEARCH_SEDU',$search_edu);
	unset($search_edu);

?>