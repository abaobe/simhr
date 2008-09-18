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
	|   > Last	modify	:	2004/12/14 15:39
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
	$select_tedu="<option value=\"0\">".$lang_unset."</option>";
	for($num_tedu=0;$num_tedu<count($lang_tedu);$num_tedu++)
	{
		$select_tedu.="<option value=\"".$lang_tedu[$num_tedu]."\">".$lang_tedu[$num_tedu]."</option>";
	}
	unset($lang_tedu);

	/*
	+---------------
	+	template out
	+---------------
	*/
	$tpl->set_var(
		array(
			'SELECT_TIME'	=>	$select_time,
			'SELECT_SEX'	=>	$select_sex,
			'SELECT_TEDU'	=>	$select_tedu,
		)
	);


?>