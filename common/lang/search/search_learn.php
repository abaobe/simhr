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
	|   > Last	modify	:	2004/12/14 16:18
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
	+	lesson type
	+---------------
	*/
	$lesson_file="common/cache/cache_lesson.php";
	$select_lesson="<option value=\"0\">$lang_unset</option>";
	if (file_exists($lesson_file))
	{
		require $lesson_file;
		foreach ($cache_lesson as $lesson)
		{
			$select_lesson.="<option value=\"$lesson[id]\">$lesson[title]</option>";
		}
	}
	unset($lesson_file,$cache_lesson,$lesson);
	/*
	+---------------
	+	lesson type
	+---------------
	*/

	$school_file='common/cache/cache_school.php';
	$select_school="<option value=\"0\">$lang_unset</option>";
	if (file_exists($school_file))
	{
		require $school_file;
		foreach ($cache_school as $school)
		{
			$select_school.="<option value=\"$school[id]\">$school[title]</option>";
		}
	}
	unset($school_file,$cache_school,$school);

	/*
	+---------------
	+	template out
	+---------------
	*/
	$tpl->set_var(
		array(
			'SELECT_TIME'	=>	$select_time,
			'SELECT_LESSON'	=>	$select_lesson,
			'SELECT_SCHOOL'	=>	$select_school,
		)
	);

?>