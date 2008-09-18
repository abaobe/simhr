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
	|   > Last	modify	:	2004/12/15 01:20
	+-------------------------------------------
	*/


	/*
	+---------------
	+	addtime
	+---------------
	*/
	$select_time="<option value=\"0\">".$lang_unset."</option>";
	foreach ($lang_stime as $time_key=>$time_val)
	{
		$select_time.="<option value=\"$time_key\">$time_val</option>";
	}
	unset($lang_stime,$time_key,$time_val);

	/*
	+---------------
	+	sex
	+---------------
	*/
	$select_sex="<option value=\"0\">".$lang_unset."</option>"."<option value=\"".$lang_ssex[0]."\">".$lang_ssex[0]."</option>"."<option value=\"".$lang_ssex[1]."\">".$lang_ssex[1]."</option>";
	unset($lang_ssex);

	/*
	+---------------
	+	edu
	+---------------
	*/
	$select_edu="<option value=\"0\">".$lang_unset."</option>";
	for($num_edu=0;$num_edu<count($lang_edu);$num_edu++)
	{
		$select_edu.="<option value=\"".$lang_edu[$num_edu]."\">".$lang_edu[$num_edu]."</option>";
	}

	/*
	+---------------
	+	industry
	+---------------
	*/
	$select_industry="<option value=\"0\">".$lang_unset."</option>";
	for ($num_industry=0;$num_industry<count($lang_company_belong);$num_industry++)
	{
		$select_industry.="<option value=\"$lang_company_belong[$num_industry]\">$lang_company_belong[$num_industry]</option>";
	}
	unset($num_industry,$lang_company_belong);




	/*
	+---------------
	+	template out
	+---------------
	*/
	$tpl->set_var(
		array(
			'SELECT_TIME'		=>	$select_time,
			'SELECT_SEX'		=>	$select_sex,
			'SELECT_EDU'		=>	$select_edu,
			'SELECT_INDUSTRY'	=>	$select_industry,
		)
	);

?>