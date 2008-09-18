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
	|   > Last modify: 2004-12-31        06:33
	+-------------------------------------------
	*/

	if(!defined("IN_SIMHR"))
	{
		exit("Error : access denied");
	}
	class DEBUG
	{
		function starttime()
		{
			$mtime = microtime ();
			$mtime = explode (' ', $mtime);
			$mtime = $mtime[1] + $mtime[0];
			$starttime = $mtime;
			return $starttime;
		}
		function process()
		{
			global $starter;
			$mtime = microtime ();
			$mtime = explode (' ', $mtime);
			$mtime = $mtime[1] + $mtime[0];
			$ender = $mtime;
			$totaltime = (round (($ender - $starter)/4, 5));
			return $totaltime;
		}
	}
	class HTMLTPL
	{
		function get_header()
		{
			global $htmltpldir;
			$html_root='../'.$htmltpldir.'/header/';
			if (!is_dir($html_root))
			{
				return 'No Template files found. In dir of '.$html_root;
			}
			else
			{
				$info="<select name=\"html_header\">";
				$d = dir($html_root);
				while ($f_name = $d->read())
				{
					if  ($f_name!='.' && $f_name!='..')
					{
						$info.="<option value=\"".$f_name."\">".$f_name."</option>";
					}
				}
				$d->close();
				$info.="</select>";
				return $info;
			}
		}
		function get_center($default_html)
		{
			global $htmltpldir;
			$html_root='../'.$htmltpldir.'/center/';
			if (!is_dir($html_root))
			{
				return 'No Template files found. In dir of '.$html_root;
			}
			else
			{
				$info="<select name=\"html_center\">";
				$d = dir($html_root);
				while ($f_name = $d->read())
				{
					if  ($f_name!='.' && $f_name!='..')
					{
						if ($default_html==$f_name)
						{
							$info.="<option value=\"".$f_name."\" selected>".$f_name."</option>";
						}
						else
						{
							$info.="<option value=\"".$f_name."\">".$f_name."</option>";
						}
					}
				}
				$d->close();
				$info.="</select>";
				return $info;
			}
		}
		function get_footer()
		{
			global $htmltpldir;
			$html_root='../'.$htmltpldir.'/footer/';
			if (!is_dir($html_root))
			{
				return 'No Template files found. In dir of '.$html_root;
			}
			else
			{
				$info="<select name=\"html_footer\">";
				$d = dir($html_root);
				while ($f_name = $d->read())
				{
					if  ($f_name!='.' && $f_name!='..')
					{
						$info.="<option value=\"".$f_name."\">".$f_name."</option>";
					}
				}
				$d->close();
				$info.="</select>";
				return $info;
			}
		}
	}

	function tpl_load($mainfile)
	{
		global $tpl;
		switch ($mainfile)
		{
			case        'index'                                                :        $main='index.html';                                        break;
			case        'job'                                                :        $main='job.html';                                        break;
			case        'find'                                                :        $main='find.html';                                        break;

			case        'hunter'                                        :        $main='hunter.html';                                break;
			case        'hunter_job'                                :        $main='hunter_job.html';                        break;
			case        'hunter_find'                                :        $main='hunter_find.html';                        break;
			case        'hunter_info'                                :        $main='hunter_info.html';                        break;

			case        'learn'                                                :        $main='learn.html';                                        break;
			case        'learn_lesson'                                :        $main='learn_lesson.html';                        break;
			case        'learn_school'                                :        $main='learn_school.html';                        break;

			case        'teacher'                                        :        $main='teacher.html';                                break;

			case        'teacher_actionjob'                        :        $main='teacher_job.html';                        break;
			case        'teacher_actionfind'                :        $main='teacher_find.html';                        break;

			case        'email'                                                :        $main='email.html';                                        break;


			case        'teacher_job'                                :        $main='common/teacher_job.html';        break;
			case        'teacher_find'                                :        $main='common/teacher_find.html';        break;

			case        'news'                                                :        $main='news.html';                                        break;
			case        'jobway'                                        :        $main='jobway.html';                                break;
			case        'joblaw'                                        :        $main='joblaw.html';                                break;

			//+ load common file
			case        'result'                                        :        $main='common/result.html';                        break;
			case        'register'                                        :        $main='common/register.html';                                break;
			case        'register_per'                                :        $main='common/register_per_basic.html';                break;
			case        'register_com'                                :        $main='common/register_com_basic.html';                break;
			case        'lose_pwd'                                        :        $main='common/lose_pwd.html';                                break;

			//+        load company control
			case        'company'                                        :        $main='company/company.html';                                break;
			case        'company_basicinfo'                        :        $main='company/company_basicinfo.html';                break;
			case        'company_myphoto'                        :        $main='company/company_myphoto.html';break;

			case        'company_puthunter'                        :        $main='company/company_puthunter.html';break;
			case        'company_puthunter_edit'        :        $main='company/company_puthunter_edit.html';break;
			case         'company_managehunter'                :        $main='company/company_managehunter.html';break;

			case        'company_putjob'                        :        $main='company/company_putjob.html';break;
			case        'company_putjob_edit'                :        $main='company/company_putjob_edit.html';break;
			case        'company_managejob'                        :        $main='company/company_managejob.html';break;

			case        'company_hreciver'                        :        $main='company/company_hreciver.html';break;
			case        'company_hsend'                                :        $main='company/company_hsend.html';break;
			case        'company_hfavourite'                        :        $main='company/company_hfavourite.html';break;

			case        'company_reciver'                        :        $main='company/company_reciver.html';break;
			case        'company_send'                                :        $main='company/company_send.html';break;
			case        'company_favourite'                        :        $main='company/company_favourite.html';break;


			case        'company_chpwd'                                :        $main='company/company_chpwd.html';break;

			case        'company_registerschool'        :        $main='company/company_registerschool.html';break;
			case        'company_manageschool'                :        $main='company/company_manageschool.html';break;

			case        'company_putpeixun'                        :        $main='company/company_putpeixun.html';break;
			case        'company_managepeixun'                :        $main='company/company_managepeixun.html';break;
			case        'company_editpeixun'                :        $main='company/company_managepeixun_edit.html';break;

			//+        load personal control
			case        'personal'                                        :        $main='personal/personal.html';break;
			case        'personal_basicinfo'                :        $main='personal/personal_basicinfo.html';break;
			case        'personal_perinfo'                        :        $main='personal/personal_perinfo.html';break;
			case        'personal_contactinfo'                :        $main='personal/personal_contactinfo.html';break;
			case        'personal_forjob'                        :        $main='personal/personal_forjob.html';break;
			case        'personal_otherinfo'                :        $main='personal/personal_otherinfo.html';break;
			case        'personal_myphoto'                        :        $main='personal/personal_myphoto.html';break;

			case        'personal_putfind'                        :        $main='personal/personal_putfind.html';break;
			case        'personal_putfind_edit'                :        $main='personal/personal_putfind_edit.html';break;
			case        'personal_managefind'                :        $main='personal/personal_managefind.html';break;

			case        'personal_puthunter'                :        $main='personal/personal_puthunter.html';break;
			case        'personal_puthunter_edit'        :        $main='personal/personal_puthunter_edit.html';break;
			case        'personal_managehunter'                :        $main='personal/personal_managehunter.html';break;

			case        'personal_reciver'                        :        $main='personal/personal_reciver.html';break;
			case        'personal_send'                                :        $main='personal/personal_send.html';break;
			case        'personal_favourite'                :        $main='personal/personal_favourite.html';break;

			case        'personal_hreciver'                        :        $main='personal/personal_hreciver.html';break;
			case        'personal_hsend'                        :        $main='personal/personal_hsend.html';break;
			case        'personal_hfavourite'                :        $main='personal/personal_hfavourite.html';break;

			case        'personal_chpwd'                        :        $main='personal/personal_chpwd.html';break;

			//+        load show info
			case        'showjob'                                        :        $main='view/view_showjob.html';break;
			case        'showfind'                                        :        $main='view/view_showfind.html';break;
			case        'company_jianli'                        :        $main='view/company_jianli.html';break;
			case        'personal_jianli'                        :        $main='view/personal_jianli.html';break;
			case        'view_sendjob'                                :        $main='view/view_sendjob.html';break;
			case        'view_sendfind'                                :        $main='view/view_sendfind.html';break;
			case        'view_mail'                                        :        $main='view/view_mail.html';break;
			case        'view_reciverinfo'                        :        $main='view/view_reciverinfo.html';break;
			case        'view_sendinfo'                                :        $main='view/view_sendinfo.html';break;
			case        'view_hunterjob'                        :        $main='view/view_hunterjob.html';break;
			case        'view_hunterfind'                        :        $main='view/view_hunterfind.html';break;
			case        'view_school'                                :        $main='view/view_school.html';break;
			case        'view_lesson'                                :        $main='view/view_lesson.html';break;

			case        'view_teacherjob'                        :        $main='view/view_teacherjob.html';break;
			case        'view_teacherfind'                        :        $main='view/view_teacherfind.html';break;

			case        'view_discuss'                                :        $main='view/view_discuss.html';break;

			//+        load search
			case        'search'                                        :        $main='search/search.html';break;
			case        'search_job'                                :        $main='search/search.html';break;
			case        'search_find'                                :        $main='search/search_find.html';break;
			case        'search_hunterjob'                        :        $main='search/search_hunterjob.html';break;
			case        'search_hunterfind'                        :        $main='search/search_hunterfind.html';break;
			case        'search_hunterinfo'                        :        $main='search/search_hunterinfo.html';break;
			case        'search_lesson'                                :        $main='search/search_lesson.html';break;
			case        'search_school'                                :        $main='search/search_school.html';break;
			case        'search_news'                                :        $main='search/search_news.html';break;
			case        'search_way'                                :        $main='search/search_way.html';break;
			case        'search_law'                                :        $main='search/search_law.html';break;

		}
		$info=$tpl->set_file(
			array(
				'top' => 'common/header.html',
				'main' => $main,
				'down' => 'common/footer.html'
			)
		);
		return $info;
	}
	function tpl_out()
	{
		global $tpl;
		$tpl->parse('out','top');
		$tpl->p('out');
		$tpl->parse('out','main');
		$tpl->p('out');
		$tpl->parse('out','down');
		$tpl->p('out');
	}
	function slashes($string, $force = 0)
	{
		if(!$GLOBALS['magic_quotes_gpc'] || $force)
		{
			if(is_array($string))
			{
				foreach($string as $key => $val)
				{
					$string[$key] = slashes($val, $force);
				}
			}
			else
			{
				$string = addslashes($string);
			}
		}
		return $string;
	}
	function html($string)
	{
		if(is_array($string))
		{
			foreach($string as $key => $val)
			{
					$string[$key] = shtml($val);
			}
		}
		else
		{
			$string = str_replace('&', '&amp;', $string);
			$string = str_replace('"', '&quot;', $string);
			$string = str_replace('<', '&lt;', $string);
			$string = str_replace('>', '&gt;', $string);
			$string = preg_replace('/&amp;(#\d{3,5};)/', '&\\1', $string);
		}
		return $string;
	}

	function input_style($administrator=0)
	{
		global $lang_input_style;
		if ($administrator)
		{
				$backto="../";
		}
		else
		{
				$backto="";
		}
		$info="<script src=\"../css/input_style.js\"></script><a href=\"javascript:image()\">".$lang_input_style[0]."</a>&nbsp;|&nbsp;<a href=\"javascript:hyperlink()\">".$lang_input_style[1]."</a>&nbsp;|&nbsp;<a href=\"javascript:bold()\">".$lang_input_style[2]."</a>&nbsp;|&nbsp;<a href=\"javascript:italicize()\">".$lang_input_style[3]."</a>&nbsp;|&nbsp;<a href=\"javascript:underline()\">".$lang_input_style[4]."</a>&nbsp;|&nbsp;<a href=\"javascript:center()\">".$lang_input_style[5]."</a>";
		return $info;
	}

	/*
	+---------------------------
	+        manage html exists
	+---------------------------
	*/
	function html_exists($file)
	{//+        判断html文件是否存在，如果存在显示链接
		if (file_exists($file))
		{
				return '<a href=\''.$file.'\' target=\'_blank\'> VIEW </a>';
		}
		else
		{
				return '<font color=\'#ff0000\'>No File</font>';
		}
	}

	/*
	+---------------------------
	+        html file check
	+---------------------------
	*/
	function linkurl($table,$info,$infotype)
	{
		global $db,$htmlroot;
		global $dirhtml_job,$dirhtml_find,$dirhtml_perhunter,$dirhtml_comhunter;
		$sql="select id,htmlroot from $table where id='$info'";
		$query=$db->query($sql);
		$row=$db->row($query);
		switch($infotype)
		{
			case        'job'                        :        $htmlfile=$htmlroot.$dirhtml_job.'/'.$row['htmlroot'].'/'.$row['id'].'.html';$phpfile='view.php?action=showjob&info='.$info;break;
			case        'hunter_job'        :        $htmlfile=$htmlroot.$dirhtml_comhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';$phpfile='view.php?action=hunterjob&info='.$info;break;
			case        'find'                        :        $htmlfile=$htmlroot.$dirhtml_find.'/'.$row['htmlroot'].'/'.$row['id'].'.html';$phpfile='view.php?action=showfind&info='.$info;break;
			case        'hunter_find'        :        $htmlfile=$htmlroot.$dirhtml_perhunter.'/'.$row['htmlroot'].'/'.$row['id'].'.html';$phpfile='view.php?action=hunterfind&info='.$info;break;
		}
		if (file_exists($htmlfile))
		{
			return $htmlfile;
		}
		else
		{
			return $phpfile;
		}
	}

	/*
	+---------------------------
	+        check html file exists
	+---------------------------
	*/
	function infourl($htmltype,$htmlfolder,$htmlname)
	{
		global $htmlroot;
		$htmlfile=$htmlroot.$htmltype.'/'.$htmlfolder.'/'.$htmlname.'.html';
		if (file_exists($htmlfile))
		{
			return $htmlfile;
		}
		else
		{
			return '0';
		}
	}

	/*
	+---------------------------
	+        update cache
	+---------------------------
	*/
	function update_cache($name,$admin)
	{
		($admin=='1')?($cache_file='../common/cache.php'):($cache_file='./common/cache.php');
		require $cache_file;
		$c_cache=new C_CACHE;
		if (is_array($name))
		{
			foreach($name as $cachefunction)
			{
				$cache_function='c_'.$cachefunction;
				$c_cache->$cache_function($cachefunction,$admin);
			}
		}
		elseif ($name=='cache_all')
		{
			$newname=array('ad','job','jobtype','find','hunterjob','hunterfind','school','schools','lesson','lessons','teacherjob','teacherfind','companys','personals','news','way','law','hunterinfo','freelink','count');
			foreach($newname as $cachefunction)
			{
				$cache_function='c_'.$cachefunction;
				$c_cache->$cache_function($cachefunction,$admin);
			}
		}
		else
		{
			$cfunc='c_'.$name;
			$c_cache->$cfunc($name,$admin);
		}
	}

	/*
	+---------------------------
	+        read cache create time
	+---------------------------
	*/
	function cache_time($filename,$admin)
	{
		$admin?$cachedir='../common/cache/':$cachedir='./common/cache/';
		file_exists($cachedir.$filename)?$return=date("Y-n-j H:i:s",filemtime($cachedir.$filename)):$return="<font color=\"#ff0000\"><B>No cache file</b></font>";
		return $return;
	}

	/*
	+---------------------------
	+        select menu
	+---------------------------
	*/
	function select_school($schoolid=0,$admin=0)
	{
		$cachedir='common/cache/cache_school.php';
		if ($admin)
		{
			$filename='../'.$cachedir;
		}
		else
		{
			$filename=$cachedir;
		}
		unset($cachedir);
		if (file_exists($filename))
		{
			include $filename;
			unset($filename);
			foreach($cache_school as $school)
			{
				if ($schoolid==$school['id'])
				{
					$select.="<option value=\"".$school['id']."\" selected>".stripslashes($school['title'])."</option>";
				}
				else
				{
					$select.="<option value=\"".$school['id']."\">".stripslashes($school['title'])."</option>";
				}
				unset($cache_school,$school);
			}
			return $select;
		}
		else
		{
			return "<option value=\"0\">No Selected School Type</option>";
		}
	}

	function select_lesson($lessonid=0,$admin=0)
	{
		$cachedir='common/cache/cache_lesson.php';
		if ($admin)
		{
			$filename='../'.$cachedir;
		}
		else
		{
			$filename=$cachedir;
		}
		unset($cachedir);
		if (file_exists($filename))
		{
			include $filename;
			unset($filename);
			foreach($cache_lesson as $lesson)
			{
				if ($lessonid==$lesson['id'])
				{
					$select.="<option value=\"".$lesson['id']."\" selected>".stripslashes($lesson['title'])."</option>";
				}
				else
				{
					$select.="<option value=\"".$lesson['id']."\">".stripslashes($lesson['title'])."</option>";
				}
				unset($cache_lesson,$lesson);
			}
			return $select;
		}
		else
		{
			return "<option value=\"0\">No Selected lesson Type</option>";
		}
	}


	/*
	+---------------------------
	+        load right file
	+---------------------------
	*/
	function right_source()
	{
		global $user_cfg,$kind_mem,$kind_com,$kind_admin;

		if ($user_cfg[guest])
		{
			return '1';
		}
		else if ($user_cfg[kind]==$kind_mem && !$user_cfg[vip])
		{
			return '2';
		}
		else if ($user_cfg[kind]==$kind_com && !$user_cfg[vip])
		{
			return '3';
		}
		elseif ($user_cfg[kind]==$kind_mem && $user_cfg[vip])
		{
			return '4';
		}
		else if ($user_cfg[kind]==$kind_com && $user_cfg[vip])
		{
			return '5';
		}
		elseif ($user_cfg[kind]==$kind_admin)
		{
			return '6';
		}
		else
		{
			return '1';
		}
	}

	/*
	+---------------------------
	+     job type select menu
	+---------------------------
	*/
	function select_jobtype($tid)
	{
		global $cache_jobtype;
		foreach ($cache_jobtype as $jtype)
		{
			if ($tid==$jtype[tid])
			{
				$return	.=	"<option value=\"".$jtype[tid]."\" selected>".$jtype[title]."</option>";
			}
			else
			{
				$return	.=	"<option value=\"".$jtype[tid]."\">".$jtype[title]."</option>";
			}
		}
		return $return;
	}

	/*
	+---------------------------
	+     show job type name
	+---------------------------
	*/
	function show_jobtype($tid)
	{
		global $cache_name_jobtype;
		return $cache_name_jobtype['tid_'.$tid];
	}
	/*
	+-------------------------------------
	+        install        sql
	+-------------------------------------
	*/
	function install_database($sql)
	{
		global $tablepre, $db;
		$sql = str_replace("\r", "\n", str_replace('wane_',$tablepre,$sql));
		$sql_array = array();

		$num = 0;
		foreach(explode(";\n", trim($sql)) as $query)
		{
			$queries = explode("\n", trim($query));
			foreach($queries as $query)
			{
				$sql_array[$num] .= $query[0] == '#' ? NULL : $query;
			}
			$num++;
		}
		unset($sql);
		foreach($sql_array as $query)
		{
			$query = trim($query);
			if($query)
			{
				if(substr($query, 0, 12) == 'CREATE TABLE')
				{
				  $name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);
				  echo '<li>INSTALL TABLE [ '.$name.' ]</li>';
				}
				elseif(substr($query, 0, 5) == 'ALTER')
				{
				  $name = preg_replace("/ALTER TABLE ([a-z0-9_]+) .*/is", "\\1", $query);
				  echo '<li>UPDATE TABLE [ '.$name.' ]</li>';
				}
				$db->query($query);
			}
		}
	}

	/*
	+----------------------------------
	+	setcookie and delete cookie
	+----------------------------------
	*/
	function wane_set_cookie($loginout=0)
	{
		global $userinfo,$cookieway,$cookietime,$cookpath,$cookdomain;

		$intime		=	!$cookieway	?	'0'	:	time()+$cookietime;
		$outtime	=	!$cookieway	?	'0'	:	time()-$cookietime;
		if (!$loginout)
		{
			setcookie('wwwwanenet_user',$userinfo[user],$intime,$cookpath,$cookdomain);
			setcookie('wwwwanenet_pass',$userinfo[pass],$intime,$cookpath,$cookdomain);
		}
		else
		{
			setcookie('wwwwanenet_user','',$outtime,$cookpath,$cookdomain);
			setcookie('wwwwanenet_pass','',$outtime,$cookpath,$cookdomain);
		}
	}




	/*
	+---------------------------
	+        count size
	+---------------------------
	*/
	function data_size($filesize)
	{
		if($filesize >= 1073741824)
		{
			$filesize = round($filesize / 1073741824 * 100) / 100 . ' G';
		}
		elseif($filesize >= 1048576)
		{
			$filesize = round($filesize / 1048576 * 100) / 100 . ' M';
		}
		elseif($filesize >= 1024)
		{
			$filesize = round($filesize / 1024 * 100) / 100 . ' K';
		}
		else
		{
			$filesize = $filesize . ' bytes';
		}
		return $filesize;
	}

	/*
	+---------------------------
	+        sql backup
	+---------------------------
	*/
	function backup_database($table, $toserver=0)
	{
		global $db,$filename;
		if ($toserver)
		{
			$fp=@fopen($filename,'w');
			@flock($fp, 3);
		}

		$tabledump        =        "\nDROP TABLE IF EXISTS $table;\n";
		/*
		+--------------------
		+        get        sql struct
		+--------------------
		*/
		$tabledump        .=        "CREATE TABLE $table (\n";

		$firstfield        =        1;

		// get columns and spec
		$fields        =        $db->query("SHOW FIELDS FROM $table");

		while ($field        =        $db->row($fields))
		{
			if        (!$firstfield)
			{
				$tabledump .= ",\n";
			}
			else
			{
				$firstfield=0;
			}
			$tabledump        .=        "$field[Field]        $field[Type]        ";
			if        (!empty($field["Default"]))
			{
				// get default value
				$tabledump        .=        "DEFAULT        '$field[Default]'        ";
			}
			if ($field['Null']        !=        "YES")
			{
				// can field be null
				$tabledump        .=        "NOT NULL        ";
			}
			if ($field['Extra']        !=        "")
			{
				// any extra info?
				$tabledump        .=        "$field[Extra]        ";
			}
		}

	  $db->free_result($fields);

	// get keys list

	$keys        =        $db->query("SHOW KEYS FROM $table");
	while        ($key        =        $db->row($keys))
	{
		$kname        =        $key['Key_name'];
		if ($kname != "PRIMARY" && $key['Non_unique'] == 0)
		{
			$kname="UNIQUE|$kname";
		}
		if(!is_array($index[$kname]))
		{
		  $index[$kname] = array();
		}
		$index[$kname][] = $key['Column_name'];
	  }
	  $db->free_result($keys);

	  // get each key info

	while(list($kname, $columns) = @each($index))
	{
		$tabledump        .=        ",\n";
		$colnames        =        implode($columns,",");

		if($kname == "PRIMARY")
		{
			  // do primary key
			  $tabledump        .=        "PRIMARY KEY ($colnames)";
		}
		else
		{
			// do standard key
		  if (substr($kname,0,6) == "UNIQUE")
			{
				// key is unique
				$kname=substr($kname,7);
		  }
		  $tabledump .= "   KEY $kname ($colnames)";
		}
	  }

	  $tabledump .= "\n);\n\n";
		if ($toserver)
		{
				fwrite($fp, $sqldump);
		}
		else
		{
				echo $tabledump;
		}

		/*
		+--------------------
		+        get sql data
		+--------------------
		*/
		$data_rows = $db->query("SELECT * FROM $table");
		$num_fields = $db->num_fields($data_rows);
		$numrows = $db->num($data_rows);
		while ($inforow = $db->rows($data_rows))
		{
			$comma = "";
			$tabledump = "INSERT INTO $table VALUES(";
			for($i = 0; $i < $num_fields; $i++)
			{
				$tabledump .= $comma."'".$db->escape($inforow[$i])."'";
				$comma = ",";
			}
			$tabledump .= ");\n";
			if ($toserver)
			{
				fwrite($fp, $sqldump);
			}
			else
			{
				echo $tabledump;
			}
		}
		$db->free_result($data_rows);
		if ($toserver)
		{
			fclose($fp);
		}
		return $tabledump;
	}

	/*
	+---------------------------
	+        result info
	+---------------------------
	*/
	function clickback($str)
	{
		global $webtitle;
		$str=$webtitle." 提示 :\\r\\n\\r\\n".$str;
		$str="<script language=javascript>alert('".$str."            ');history.go(-1);</script>";
		return $str;
	}
	function refreshback($str)
	{
		$str="<BR><BR><BR>".$str."<BR><BR><BR>";
		return $str;
	}
	function showmsg($url,$time)
	{
		$str="<meta http-equiv='refresh' content='".$time.";URL=".$url."'>";
		return $str;
	}

	/*
	+---------------------------
	+        delete file
	+---------------------------
	*/
	function delete_file($file)
	{
		if (file_exists($file))
		{
			$delete = chmod ($file, 0777);
			$delete = unlink($file);
			if(file_exists($file))
			{
				$filesys = eregi_replace("/","\\",$file);
				$delete = system("del $filesys");
				clearstatcache();
				if(file_exists($file))
				{
					$delete = chmod ($file, 0777);
					$delete = unlink($file);
					$delete = system("del $filesys");
				}
			}
			clearstatcache();
			if(file_exists($file))
			{
				return 'Delete Faile         :        <font color=\'#ff0000\'>'.$file.'</font><br>';
			}
			else
			{
				return 'Delete Successs        :        <font color=\'#6699cc\'>'.$file.'</font><br>';
			}
		}
		else
		{
			return 'Delete Successs        :        <font color=\'#6699cc\'>'.$file.'</font><br>';
		}
	}

	/*
	+---------------------------
	+        get string login
	+---------------------------
	*/
	function wane_str($string,$start=0,$end)
	{
		if((strlen($string)-$start) > $end)
		{
			for($i = $start; $i < $end - 3; $i++)
			{
				if(ord($string[$i]) > 127)
				{
					$return .= $string[$i].$string[$i + 1];
					$i++;
				}
				else
				{
					$return .= $string[$i];
				}
			}
			return $return.'...';
		}
		return $string;
	}

	/*
	+---------------------------
	+        text style
	+---------------------------
	*/
	function wane_text($guest)
	{
		//$guest = html($guest);
		$guest = str_replace("<BR>","\r\n",$guest);
		$guest = nl2br($guest);
		$guest = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp; ', $guest);
		$guest = str_replace('   ', '&nbsp;&nbsp;', $guest);
		$guest = str_replace('  ', '&nbsp;&nbsp;', $guest);


		$guest = str_replace('[b]', '<b>', $guest);
		$guest = str_replace('[/b]', '</b>', $guest);
		$guest = str_replace('[i]', '<i>', $guest);
		$guest = str_replace('[/i]', '</i>', $guest);
		$guest = str_replace('[u]', '<u>', $guest);
		$guest = str_replace('[/u]', '</u>', $guest);
		$guest = str_replace('[center]', '<center>', $guest);
		$guest = str_replace('[/center]', '</center>', $guest);

		// replace picture!
		$guest=str_replace("[IMG]","<img border=\"0\" src=",$guest);
		$guest=str_replace("[img]","<img border=\"0\" src=",$guest);
		$guest=str_replace("[/img]",">",$guest);
		$guest=str_replace("[/IMG]",">",$guest);
		// replace url
		$guest=str_replace("[url=","<a target=\"blank\" href=",$guest);
		$guest=str_replace("[URL=","<a target=\"blank\" href=",$guest);
		$guest=str_replace("[/url]","</a>",$guest);
		$guest=str_replace("[/URL]","</a>",$guest);
		$guest=str_replace("]",">",$guest);
		//$guest = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $guest);
		return($guest);
	}

	/*
	+---------------------------
	+        user cpanel
	+---------------------------
	*/
	function getukind($usertablekind)
	{
		global $kind_mem,$kind_com,$kind_admin,$lang_cpanel;
		switch ($usertablekind)
		{
			case $kind_mem                :        $ukind='<a href=\'personal.php\'><font color=\'#ff0000\'>'.$lang_cpanel[0].'</font></a>';break;
			case $kind_com                :        $ukind='<a href=company.php><font color=\'#ff0000\'>'.$lang_cpanel[1].'</font></a>';break;
			case $kind_admin        :        $ukind='<a href=admin/index.php><font color=\'#ff0000\'>'.$lang_cpanel[2].'</font></a>';break;
		}
		return $ukind;
	}

	/*
	+---------------------------
	+        logins part
	+---------------------------
	*/
	function showlogins()
	{
		global $tablepre,$wane_user,$db;
		$sql=$db->query("select username,logins from {$tablepre}member where username='$wane_user'");
		$row=$db->row($sql);
		return $row['logins'];
	}

	/*
	+---------------------------
	+        logined part
	+---------------------------
	*/
	function userlogined()
	{
		global $user_cfg;
		if ($user_cfg['logined']=='0' || $user_cfg['logined']=='')
		{
			return '0';
		}
		else
		{
			return '1';
		}
	}
	function comlogined()
	{
		global $kind_com,$user_cfg;
		if ($user_cfg['kind']==$kind_com && $user_cfg['logined']=='1')
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}
	function perlogined()
	{
		global $user_cfg,$kind_mem;
		if ($user_cfg['logined']=='1' && $user_cfg['kind']==$kind_mem)
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}
	function adminlogined()
	{
		global $kind_admin,$user_cfg;
		if ($user_cfg['logined']=='1' && $user_cfg['kind']==$kind_admin)
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}

	/*
	+---------------------------
	+        code part
	+---------------------------
	*/
	function str_encode($str)
	{
		$str=base64_encode($str);
		return $str;
	}
	function str_decode($str)
	{
		$str=base64_decode($str);
		return $str;
	}
	function wwwwanenet()
	{
		$str=base64_encode('<center><a href="http://www.php365.cn/">Powered By SimPHP</a></center>');
		return str_decode($str);
	}

	function upload_img($name,$tmp_name,$addr)
	{
		global $phototype,$watermark,$watertype,$waterposition,$waterstring,$waterimg,$water_width,$water_height,$water_position;
		if (!is_writable($addr))
		{
			echo clickback('Can not upload image! Because,Folder can not write.');exit;
		}
		if (is_uploaded_file($tmp_name))
		{
			$phototypearray=explode(',',$phototype);
			@$size=getimagesize($tmp_name);
			$cut=substr($name,-3,3);
			if (!in_array($cut,$phototypearray))  {echo clickback('上传图片格式: '.$phototype);exit;} else {$up=$cut;}
			$upfile=$addr."/".date("YmdHis",time()).rand('10000001','99999999').".".$up;
			if (file_exists($upfile))        {echo clickback('图片已存在');exit;}
			$query=move_uploaded_file($tmp_name, $upfile);

			if($watermark==1)
			{
				$iinfo=getimagesize($upfile,$iinfo);
				$nimage=imagecreatetruecolor($iinfo[0],$iinfo[1]);
				$white=imagecolorallocate($nimage,255,255,255);
				$black=imagecolorallocate($nimage,0,0,0);
				$red=imagecolorallocate($nimage,255,0,0);
				imagefill($nimage,0,0,$white);
				switch ($iinfo[2])
				{
					case 1:$simage =imagecreatefromgif($upfile);break;
					case 2:$simage =imagecreatefromjpeg($upfile);break;
					case 3:$simage =imagecreatefrompng($upfile);break;
					case 6:$simage =imagecreatefromwbmp($upfile);break;
					default:die("不支持的文件类型");exit;
				}

				imagecopy($nimage,$simage,0,0,0,0,$iinfo[0],$iinfo[1]);
				if ($watertype=='0')
				{
					switch($water_position)
					{
						case        0        :        @imagestring($nimage,5,10,5,$waterstring,$white);        break;
						case        1        :        @imagestring($nimage,5,($iinfo[0]-($water_width+5)),5,$waterstring,$white);        break;
						case        2        :        @imagestring($nimage,5,(intval($iinfo[0]/2) - intval($water_width/2)),(intval($iinfo[1]/2) - intval($water_height/2)),$waterstring,$white);        break;
						case        3        :        @imagestring($nimage,5,10,($iinfo[1] - ($water_height-5)),$waterstring,$white);        break;
						case        4        :        @imagestring($nimage,5,($iinfo[0] - ($water_width+5)),($iinfo[1] - ($water_height-5)),$waterstring,$white);        break;
					}
				}
				else
				{
					switch($water_position)
					{
						case        0        :        @$simage1 =imagecreatefromgif($waterimg);@imagecopy($nimage,$simage1,0,0,0,0,$water_width,$water_height);@imagedestroy($simage1);        break;
						case        1        :        @$simage1 =imagecreatefromgif($waterimg);@imagecopy($nimage,$simage1,($iinfo[0]-$water_width),0,0,0,$water_width,$water_height);@imagedestroy($simage1);        break;
						case        2        :        @$simage1 =imagecreatefromgif($waterimg);@imagecopy($nimage,$simage1,(intval($iinfo[0]/2)-intval($water_width/2)),(intval($iinfo[1]/2)-intval($water_height/2)),0,0,$water_width,$water_height);@imagedestroy($simage1);        break;
						case        3        :        @$simage1 =imagecreatefromgif($waterimg);@imagecopy($nimage,$simage1,0,($iinfo[1]-$water_height),0,0,$water_width,$water_height);@imagedestroy($simage1);        break;
						case        4        :        @$simage1 =imagecreatefromgif($waterimg);@imagecopy($nimage,$simage1,($iinfo[0]-$water_width),($iinfo[1]-$water_height),0,0,$water_width,$water_height);@imagedestroy($simage1);        break;
					}
				}

				switch ($iinfo[2])
				{
					case 1:
					imagejpeg($nimage, $upfile);
					break;
					case 2:
					imagejpeg($nimage, $upfile);
					break;
					case 3:
					imagepng($nimage, $upfile);
					break;
					case 6:
					imagewbmp($nimage, $upfile);
					break;
				}
				imagedestroy($nimage);
				imagedestroy($simage);
			}
			if ($query)
			{
				return $upfile;
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo clickback("无法上传文件");
		}
	}

	function headtitle($title)
	{
		return $title;
	}
	function wane_mail($to,$title,$content)
	{
		global $adminemail;
		$header="From: ".$adminemail."\r\n"."Reply-To: ".$adminemail."\r\n"."X-Mailer: PHP/" . phpversion();
		$query=mail($to,$title,$content,$header);
		if ($query)        {return true;}        else {return false;}
	}
	function endhtml()
	{
		$endhtml="</td>
		<td align=\"left\" background=\"images/right_bg.gif\">&nbsp;</td>
		</tr>
		<tr>
		<td align=\"right\" valign=\"top\"><img src=\"images/left_down.gif\" width=\"18\" height=\"18\"></td>
		<td align=\"center\" valign=\"top\" background=\"images/row_down.gif\">&nbsp;</td>
		<td align=\"left\" valign=\"top\"><img src=\"images/right_down.gif\" width=\"14\" height=\"18\"></td>
		</tr>
		</table>
		</body>
		</html>";
		return $endhtml;
	}
	function write($str)
	{
		if (!file_exists($str))
		{
			$info='<font color=ff0000>文件不存在</font>';
		}
		else if (!is_writeable($str))
		{
			$info='<font color=ff0000>文件不可写</font>';
		}
		else
		{
			$info='<font color=6699cc>ON</font>';
		}
		return $info;
	}
?>