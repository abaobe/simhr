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
	|   > Last modify: 2004-12-31	06:38
	+-------------------------------------------
	*/

	if(!defined("IN_SIMHR"))
	{
		exit("Error : access denied for cache.php");
	}

	class C_CACHE
	{
		function writetocache($cachefile,$data,$admin)
		{
			if ($admin=='1')
			{
				$cache_file='../common/cache/cache_'.$cachefile.'.php';
			}
			else
			{
				$cache_file='./common/cache/cache_'.$cachefile.'.php';
			}
			$data="<?php\n	/*\n	+------------------------------------\n	+	J_Space V2.0.x cache file\n	+	Powered by SimPHP\n	+	website	:	http://www.php365.cn\n	+	filename	:	cache_".$cachefile.".php\n	+	last modify	:	".date("Y-n-j H:i:s",time())."\n	+------------------------------------\n	*/".$data."\n?>";

			$fp=fopen($cache_file,'w+');
			fwrite($fp,$data);
			fclose($fp);
			unset($data,$cache_file);
		}
		function c_job($name,$admin)
		{
			global $tablepre,$num_job,$time_job,$db;
			//$j=$tablepre.'job_chance';
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select
					j.id, j.job,j.username,j.man,j.edu,j.puttime,j.losetime,j.sign,j.htmlroot,c.qyuser,c.qyname
				from
				  	{$tablepre}job_chance j ,{$tablepre}jianliqy c
				where
					j.username=c.qyuser and j.sign='1' and j.losetime > '".time()."'
				order by j.id desc limit 0,$num_job";
			$query=$db->query($sql);
			//$query=mysql_query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n\n			'id'		=>	'".$row[id]."',\n			'username'	=>	'".$row[username]."',\n			'qyname'	=>	'".$row[qyname]."',\n			'job'		=>	'".addslashes($row[job])."',\n			'edu'		=>	'".$row[edu]."',\n			'man'		=>	'".addslashes($row[man])."',\n			'addtime'	=>	'".date($time_job,$row[puttime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_find($name,$admin)
		{//+	读取缓存内容
			global $tablepre,$num_find,$time_find,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select f.id,f.username,f.job,f.puttime,f.sign,f.losetime,f.htmlroot,p.username,p.truename,p.sex,p.birth,p.edu
				from
					{$tablepre}findjob_chance f , {$tablepre}jianli p
				where
					f.sign='1' and f.losetime>'".time()."'	and f.username=p.username
				order by f.id desc limit 0,$num_find";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n\n			'id'		=>	'".$row[id]."',\n			'username'	=>	'".$row[username]."',\n			'job'		=>	'".$row[job]."',\n			'truename'	=>	'".addslashes($row[truename])."',\n			'sex'		=>	'".$row['sex']."',\n			'birth'		=>	'".$row[birth]."',\n			'edu'		=>	'".$row[edu]."',\n			'addtime'	=>	'".date($time_find,$row[puttime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_hunterjob($name,$admin)
		{//+ 猎头职位
			global $tablepre,$num_comhunter,$time_hunterjob,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$jt=$tablepre.'hunter_com';
			$ct=$tablepre.'jianliqy';
			$sql="select $jt.id,$jt.username,$jt.job,$jt.addtime,$jt.losetime,$jt.htmlroot,$jt.sign,$ct.qyuser,$ct.qyname from $jt,$ct where $jt.username=$ct.qyuser and $jt.sign='1' order by $jt.id desc limit 0,$num_comhunter";
			unset($jt,$ct);
			$query=$db->query($sql)	;
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n			'id'	=>	'".$row[id]."',\n			'username'	=>	'".addslashes($row[username])."',\n			'job'	=>	'".addslashes($row[job])."',\n			'qyname'	=>	'".addslashes($row[qyname])."',\n			'addtime'	=>	'".date($time_hunterjob,$row[addtime])."',\n			'losetime'	=>	'".date($time_hunterjob,$row[losetime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}
		function c_hunterfind($name,$admin)
		{//+ 猎头职位
			global $tablepre,$num_perhunter,$time_hunterfind,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}hunter_per where sign='1' order by id desc limit 0,$num_perhunter";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row['id']."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'industry'	=>	'".addslashes($row[industry])."',\n			'truename'	=>	'".addslashes($row[truename])."',\n			'addtime'	=>	'".date($time_hunterfind,$row['addtime'])."',\n			'losetime'	=>	'".date($time_hunterfind,$row[losetime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n			),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}

		function c_hunterinfo($name,$admin)
		{
			global $tablepre,$num_hunterinfo,$time_hunterinfo,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}hunter_info  order by id desc limit 0,$num_hunterinfo";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row['id']."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'title'	=>	'".addslashes($row[title])."',\n			'addtime'	=>	'".date($time_hunterinfo,$row['addtime'])."',\n				'htmlroot'	=>	'".$row['htmlroot']."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}
		function c_school($name,$admin)
		{//+ 学校分类
			global $tablepre,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}pxschool_kind order by orderid asc";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'title'		=>	'".addslashes($row[title])."',\n			'orderid'	=>	'".$row[orderid]."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}
		function c_schools($name,$admin)
		{//+ 推荐学校
			global $tablepre,$num_schools,$db,$num_schools;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select  * from {$tablepre}pxschool_kind order by orderid";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'<a href=\'learn.php?action=school&type=".$row['id']."\'>".addslashes($row[title])."</a>'	=>	array(\n";
				$sql_=$db->query("select * from {$tablepre}pxschool where schkind='".$row['id']."' and sign='1' order by id desc limit 0,$num_schools");
				while ($row_=$db->row($sql_))
				{
					$data.="\n			'".$row_[id]."'	=>	array(\n				'id'		=>	'".$row_[id]."',\n				'username'	=>	'".addslashes($row_[username])."',\n				'sname'		=>	'".addslashes($row_[sname])."',\n				'htmlroot'	=>	'".$row_[htmlroot]."',\n				),\n";
				}
				unset($sql_,$row_);
				$data.="\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_lesson($name,$admin)
		{//+ 培训课程分类
			global $tablepre,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}job_peixunkind order by id";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'title'		=>	'".addslashes($row[title])."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}
		function c_lessons($name,$admin)
		{//+ 培训课程
			global $tablepre,$num_lesson,$time_lesson,$db;
			$table=$tablepre.'job_peixun';
			$data="\n	\$cache_".$name."=array(\n";
			$query=$db->query("select * from $table where losetime > '".time()."' and sign='1' order by id desc limit 0,$num_lesson");
			while ($row=$db->row($query))
			{
				$data.="\n		'".addslashes($row[id])."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'lesson'	=>	'".addslashes($row[lesson])."',\n			'starttime'		=>	'".addslashes($row[start_time])."',\n			'money'		=>	'".addslashes($row[money])."',\n			'addtime'		=>	'".date($time_lesson,$row[puttime])."',\n			'htmlroot'		=>	'".$row[htmlroot]."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}


		function c_teacherjob($name,$admin)
		{
			global $tablepre,$num_putteacher,$time_putteacher,$db;
			$table=$tablepre.'teacher_job';
			$data="\n	\$cache_".$name."=array(\n";
			$query=$db->query("select * from $table where losetime > '".time()."' and sign='1' order by id desc limit 0,$num_putteacher");
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'title'	=>	'".addslashes($row[title])."',\n			'sex'		=>	'".$row[sex]."',\n			'edu'		=>	'".$row[edu]."',\n			'contact'		=>	'".$row[contact_name]."',\n			'addtime'		=>	'".date($time_putteacher,$row[puttime])."',\n			'htmlroot'		=>	'".$row[htmlroot]."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}
		function c_teacherfind($name,$admin)
		{
			global $tablepre,$num_findteacher,$time_findteacher,$db;
			$table=$tablepre.'teacher_find';
			$data="\n	\$cache_".$name."=array(\n";
			$query=$db->query("select * from $table where losetime > '".time()."' and sign='1' order by id desc limit 0,$num_findteacher");
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'title'	=>	'".addslashes($row[title])."',\n			'sex'		=>	'".$row[sex]."',\n			'edu'		=>	'".$row[edu]."',\n			'contact'		=>	'".$row[truename]."',\n			'addtime'		=>	'".date($time_findteacher,$row[puttime])."',\n			'htmlroot'		=>	'".$row[htmlroot]."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);\n";
			$this->writetocache($name,$data,$admin);
		}

		function c_companys($name,$admin)
		{//+ 最新企业
			global $tablepre,$num_new_company,$db,$shownewcom;
			$ordername	=	$shownewcom	?	'lastupdate'	:	'qyid'	;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}jianliqy where qyuser!='' and qyname!='' order by $ordername desc limit 0,$num_new_company";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[qyid]."'	=>	array(\n\n			'id'		=>	'".$row[qyid]."',\n			'username'	=>	'".$row[qyuser]."',\n			'qyname'	=>	'".addslashes($row[qyname])."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_personals($name,$admin)
		{//+ 最新个人
			global $tablepre,$num_new_personal,$db,$shownewper;
			$ordername	=	$shownewper	?	'lastupdate'	:	'id'	;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}jianli where username!='' and truename!='' and sex!='' order by $ordername desc limit 0,$num_new_personal";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n\n			'id'	=>	'".$row[id]."',\n			'username'	=>	'".$row[username]."',\n			'truename'	=>	'".$row[truename]."',\n			'sex'	=>	'".$row[sex]."',\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_news($name,$admin)
		{//+ 新闻动态
			global $tablepre,$num_news,$time_news,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}index_news order by id desc limit 0,$num_news";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n\n			'id'		=>	'".$row[id]."',\n			'title'		=>	'".addslashes($row[title])."',\n			'addtime'	=>	'".date($time_news,$row[addtime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_way($name,$admin)
		{//+ 求职攻略
			global $tablepre,$num_way,$time_way,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}job_way order by id desc limit 0,$num_way";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n\n			'id'		=>	'".$row[id]."',\n			'title'		=>	'".addslashes($row[title])."',\n			'addtime'	=>	'".date($time_way,$row[addtime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_law($name,$admin)
		{//+ 政策法规
			global $tablepre,$num_law,$time_law,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$sql="select * from {$tablepre}job_law order by id desc limit 0,$num_law";
			$query=$db->query($sql);
			unset($sql);
			while ($row=$db->row($query))
			{
				$data.="\n		'".$row[id]."'	=>	array(\n\n			'id'		=>	'".$row[id]."',\n			'title'		=>	'".addslashes($row[title])."',\n			'addtime'	=>	'".date($time_law,$row[addtime])."',\n			'htmlroot'	=>	'".$row[htmlroot]."',\n\n		),\n";
			}
			unset($query,$row);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}
		function c_count($name,$admin)
		{
			global $tablepre,$db;
			$members=$db->num($db->query("select id from {$tablepre}member"));
			$member_com=$db->num($db->query("select qyuser,qyname from {$tablepre}jianliqy where qyuser!='' and qyname!=''"));
			$member_per=$members-$member_com;
			$jobs=$db->num($db->query("select id from {$tablepre}job_chance"));
			$finds=$db->num($db->query("select id from {$tablepre}findjob_chance"));
			$data="\n	\$cache_".$name."=array(\n";
			$data.="\n		'members'	=>	'".$members."',\n		'member_com'	=>	'".$member_com."',\n		'member_per'	=>	'".$member_per."',\n		'jobs'	=>	'".$jobs."',\n		'finds'	=>	'".$finds."',\n";
			unset($members,$member_com,$member_per,$jobs,$finds);
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}

		function c_jobtype($name,$admin)
		{
			global $tablepre,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$data_pos="\n	\$cache_name_".$name."=array(\n";
			$query=$db->query("select * from {$tablepre}job_type order by orderid");
			while ($row=$db->row($query))
			{
				$data_pos.="\n		'tid_".$row[tid]."'	=>	'".addslashes($row[title])."',\n";
				$data.="\n		'$row[tid]'	=>	array(\n			'tid'		=>	'".$row[tid]."',\n			'title'		=>	'".addslashes($row[title])."',\n			'orderid'	=>	'".$row[orderid]."',\n		),\n";
			}
			$data.="\n	);\n\n";
			$data_pos.="\n	);";
			$this->writetocache($name,$data.$data_pos,$admin);
		}


		function c_freelink($name,$admin)
		{//+ 友情链接
			global $tablepre,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$query=$db->query("select * from {$tablepre}links order by orderid");
			while ($row=$db->row($query))
			{
				$data.="\n		'$row[id]'	=>	array(\n			'id'		=>	'".$row[id]."',\n			'title'		=>	'".addslashes($row[title])."',\n			'img'		=>	'".addslashes($row[img])."',\n			'url'		=>	'".addslashes($row[url])."',\n			'context'	=>	'".addslashes($row[context])."',\n			'orderid'	=>	'".$row[orderid]."',\n		),\n";
			}
			$data.="\n	);";
			$this->writetocache($name,$data,$admin);
		}

		function c_ad($name,$admin)
		{
			global $tablepre,$db;
			$data="\n	\$cache_".$name."=array(\n";
			$query=$db->query("select * from {$tablepre}ad");
			while ($row=$db->row($query))
			{
				$data.="\n\n		'AD$row[aid]'	=>	'".addslashes($row[context])."',\n\n";
			}
			$data.="\n	);\n\n";
			$data.="\n\n	foreach (\$cache_ad as \$ad_key=>\$ad_val)\n	{\n		\$tpl->set_var(\$ad_key,stripslashes(\$ad_val));\n	}\n\n";
			$this->writetocache($name,$data,$admin);
		}

	}
?>