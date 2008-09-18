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
	tpl_load('learn');

	if ($action=='school')
	{//+	school list
		tpl_load('learn_school');
		$headtitle=headtitle($webtitle.' - 培训学校');
		$count=$num_school_list;
		$t=$tablepre.'pxschool_kind';
		$s=$tablepre.'pxschool';
		if ($method=='search')
		{
			$sstr="$t.*,$s.*";
			(is_numeric($schkind) && $schkind!='0')	?	$str="$s.schkind='$schkind' and $s.sign='1' and $t.id=$s.schkind"	:	$str="$s.sign='1' and $t.id=$s.schkind"	;
			if (empty($sname)){$str=$str;}else{$str.=" and $s.sname like '%".urldecode($sname)."%'";}
			$str2="action=school&method=search&schkind=&schkind&sname=".urlencode(urldecode($sname));
		}
		else
		{
			$sstr="$t.*,$s.*";
			is_numeric($type)	?	$str="$s.schkind='$type' and $s.sign='1' and $t.id=$s.schkind"	:	$str="$s.sign='1' and $t.id=$s.schkind"	;
			$str2="action=school&type=".$type;
		}
		$table=$t.','.$s;
		require 'common/page_count.php';

		if ($RIGHT[page_school]!='-1' && $page > $RIGHT[page_school])	{echo clickback($lang_right[3]);exit;}

		$query=$db->query("select $sstr from $table where $str order by $s.id desc limit $offset,$psize");
		$tpl->set_block('main','school_list','school_lists');
		while ($row=$db->row($query))
		{
			$htmlschool=$htmlroot.$dirhtml_school.'//'.md5($row['username']).'.html';
			$schoollink=file_exists($htmlschool)	?	$htmlschool		:	'view.php?action=school&info='.urlencode($row['username'])	;
			$tpl->set_var(
				array(
					'SCHOOL_LINK'	=>	$schoollink,
					'SCHOOL_NAME'	=>	$row[sname],
					'SCHOOL_TYPE'	=>	$row[title],
					'ADDTIME'		=>	date("Y-n-j",$row[addtime]),
				)
			);
			unset($htmlschool,$schoollink);
			$tpl->parse('school_lists','school_list',true);
		}
		require 'common/page_show.php';
		$cache_file='common/cache/cache_school.php';
		if (!file_exists($cache_file))
		{
			unset($cache_file);
			$tpl->set_var(
				'JUMP_SCHOOL'	,	"<option value=\"learn.php?action=school&type=".$type."\" selected>读取缓存失败</option>"
			);
		}
		else
		{
			require $cache_file;
			foreach ($cache_school as $sch)
			{
				if ($sch['id']==$type)
				{
					$jump_school.="<option value=\"learn.php?action=school&type=".$sch[id]."\" selected>".$sch[title]."</option>";
				}
				else
				{
					$jump_school.="<option value=\"learn.php?action=school&type=".$sch[id]."\">".$sch[title]."</option>";
				}
			}
			$tpl->set_var(
				'JUMP_SCHOOL'	,	$jump_school
			);
			unset($cache_file,$cache_school,$sch,$jump_school);
		}
	}
	else if ($action=='lesson')
	{//+	lesson list
		tpl_load('learn_lesson');
		$headtitle=headtitle($webtitle.' - 培训课程');
		$count=$num_lesson_list;
		if ($method=='search')
		{
			$str="sign='1' and losetime>'".time()."'";
			if ($addtime=='0' || $addtime=='' || !isset($addtime)){$str=$str;}else{$str.=" and puttime > '".(time()-$addtime)."'";}
			if ($lesson=='' || !isset($lesson)){$str=$str;}else{$str.=" and lesson like '%".urldecode($lesson)."%'";}
			if ($leixing=='0' || $leixing=='' || !isset($leixing)){$str=$str;}else{$str.=" and leixing='$leixing'";}
			if ($address=='' || !isset($address)){$str=$str;}else{$str.=" and address like '%".urldecode($address)."%'";}
			if ($money=='' || !isset($money)){$str=$str;}else{$str.=" and money like '%".urldecode($money)."%'";}
			$str2="action=lesson&method=search&addtime=$addtime&lesson=".urlencode(urldecode($lesson))."&leixing=$leixing&address=".urlencode(urldecode($address))."&money=".urlencode(urldecode($money));
		}
		else
		{
			$str="sign='1' and losetime>'".time()."'";
			$str2="action=lesson";
		}
		$table=$tablepre.'job_peixun';
		require 'common/page_count.php';

		if ($RIGHT[page_lesson]!='-1' && $page > $RIGHT[page_lesson])	{echo clickback($lang_right[3]);exit;}

		$query=$db->query("select * from {$tablepre}job_peixun where $str order by id desc limit $offset ,$psize");
		$tpl->set_block('main','lesson_list','lesson_lists');
		while ($row=$db->row($query))
		{
			$lessonfile=$htmlroot.$dirhtml_lesson.'/'.$row[htmlroot].'/'.$row[id].'.html';
			$htmllink=(file_exists($lessonfile))?$lessonfile:'view.php?action=lesson&info='.$row['id'];
			$tpl->set_var(
				array(
					'LESSON_LINK'	=>	$htmllink,
					'LESSON_NAME'	=>	$row[lesson],
					'LESSON_TIME'	=>	$row[start_time],
					'LESSON_MONEY'	=>	$row[money],
				)
			);
			unset($lessonfile,$htmllink);
			$tpl->parse('lesson_lists','lesson_list',true);
		}
		require 'common/page_show.php';
	}
	else
	{//+ begin learn index
		$headtitle=headtitle($webtitle.' - 培训专区');
		//+	begin lesson
		$cache_lesson='common/cache/cache_lessons.php';
		if (!file_exists($cache_lesson))
		{
			$tpl->set_var(
				array(
					'LESSON_NAME'	=>	'载入缓存文件出错',
					'LESSON_TIME'	=>	'<font color=\'#ff0000\'> '.$cache_lesson.' </font>',
					'LESSON_MONEY'	=>	'不存在',
				)
			);
			unset($cache_lesson);
		}
		else
		{
			require $cache_lesson;
			$tpl->set_block('main','lesson_list','lesson_lists');
			foreach($cache_lessons as $lesson)
			{
				unset($cache_lesson,$cache_lessons);
				$lessonfile=$htmlroot.$dirhtml_lesson.'/'.$lesson[htmlroot].'/'.$lesson[id].'.html';
				$htmllink=(file_exists($lessonfile))?$lessonfile:'view.php?action=lesson&info='.$lesson['id'];
				unset($lessonfile);
				$tpl->set_var(
					array(
						'LESSON_LINK'	=>	$htmllink,
						'LESSON_NAME'	=>	stripslashes($lesson[lesson]),
						'LESSON_TIME'	=>	stripslashes($lesson[starttime]),
						'LESSON_MONEY'	=>	stripslashes($lesson[money]),
					)
				);
				unset($lesson);
				$tpl->parse('lesson_lists','lesson_list',true);
			}
		}
		//+	end lesson

		//+	begin school
		$cache_schools='common/cache/cache_schools.php';
		if (!file_exists($cache_schools))
		{
			$tpl->set_var(
				array(
					'SCHOOL_TYPE'	=>	'载入缓存文件出错',
					'SCHOOL_NAME'	=>	'<font color=\'#ff0000\'>缓存文件 '.$cachefile.' 不存在</font>',
				)
			);
			unset($cache_schools);
		}
		else
		{
			require $cache_schools;
			$st_nums=count($cache_schools);
			$tpl->set_block('main','school_type','t');
			$tpl->set_block('school_type','school_list','n');
			$st_num=0;
			foreach ($cache_schools as $school => $schools)
			{
				$tpl->set_var('n');
				foreach ($schools as $sch)
				{
					$htmlschool=$htmlroot.$dirhtml_school.'//'.md5($sch['username']).'.html';
					$schoollink=file_exists($htmlschool)	?	$htmlschool		:	'view.php?action=school&info='.urlencode($sch['username'])	;
					$tpl->set_var(
						array(
							'SCHOOL_NAME'	=>	'<a href=\''.$schoollink.'\' target=\'_blank\'>'.stripslashes($sch[sname]).'</a>',
							'SCHOOL_ID'		=>	$sch[id],
						)
					);
					unset($htmlschool,$schoollink,$schools,$sch);
					$tpl->parse('n','school_list',true);
				}

				$st_num++;
				$st_numss=$st_num;
				($st_numss%2=='0' && $st_numss!=$st_nums)	?	$tpl->set_var('SCHOOL_TR','</tr><tr>')	:	$tpl->set_var('SCHOOL_TR','');
				$tpl->set_var('SCHOOL_TYPE',stripslashes($school));
				$tpl->parse('t','school_type',true);
				unset($school,$cache_schools);
			}
			unset($st_nums,$st_num,$st_numss);
		}
		//+	end school
	}//+ end learn school
	require_once 'common/common.php';
	if ($process_info=='1')
	{
		$process=$DEBUG->process();
		$queries=$db->querynum;
		$tpl->set_var(PROCESS_INFOS,"Process in $process second(s) with $queries Queries $pagegzipinfo .");
		$tpl->set_var('WANE_PROCESS',$process);
		$tpl->set_var('WANE_QUERY',$db->querynum.' Queries');
	}
	require 'common/lang/search/search_learn.php';
	tpl_out();
?>