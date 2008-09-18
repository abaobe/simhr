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
	// SEARCH FORM START
	$search_jobtime='<option value=\'0\'>'.$lang_unset.'</option><option value=\'86400\'>'.$lang_stime[0].'</option><option value=\'604800\'>'.$lang_stime[1].'</option><option value=\'2592000\'>'.$lang_stime[2].'</option><option value=\'15811200\'>'.$lang_stime[3].'</option>';
	$tpl->set_var('LANG STIME',$search_jobtime);
	unset($search_jobtime);

	$search_sex='<option value=\'0\'>'.$lang_unset.'</option><option value=\''.$lang_ssex[0].'\'>'.$lang_ssex[0].'</option><option value=\''.$lang_ssex[1].'\'>'.$lang_ssex[1].'</option>';
	$tpl->set_var('SEARCH_SSEX',$search_sex);
	unset($search_sex);

	$search_edu='<option value=\'0\'>'.$lang_unset.'</option>';
	for ($num_edu=0;$num_edu<count($lang_edu);$num_edu++)
	{
		$search_edu=$search_edu.'<option value=\''.$lang_edu[$num_edu].'\'>'.$lang_edu[$num_edu].'</option>';
	}
	$tpl->set_var('SEARCH_SEDU',$search_edu);
	unset($search_edu);
	// SEARCH FORM END
?>