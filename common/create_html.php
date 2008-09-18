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
	|   > Last modify: 2004-12-31	06:45
	+-------------------------------------------
	*/

	if(!defined("IN_SIMHR"))
	{
		exit("Error : access denied for create_html.php");
	}

	class C_HTML
	{
		function c_dir($html_type,$root,$admin=0)
		{
			global $htmlroot;
			if ($admin)
			{
				$html_root='../'.$htmlroot;
				if (!is_dir($html_root))
				{
					if (!mkdir($html_root,0777))
					{
						exit('Sorry , There is no html data dir  <strong>'.$html_root.'</strong>  and Create faile .');
					}
				}
				elseif (!is_writable($html_root))
				{
					exit('Sorry , The Folder '.$html_root.' can not write');
				}
			}
			else
			{
				$html_root=$htmlroot;
				if (!is_dir($html_root))
				{
					if (!mkdir($html_root,0777))
					{
						exit('Sorry , There is no html data dir  <strong>'.$html_root.'</strong>  and Create faile .');
					}
				}
				elseif (!is_writable($html_root))
				{
					exit('Sorry , The Folder '.$html_root.' can not write');
				}
			}//+	end the first folder

			$html_dir=$html_root.$html_type;
			unset($html_root);
			if (!is_dir($html_dir))
			{
				if (!mkdir($html_dir,0777))
				{
					exit('Sorry , There is no html data dir'.$html_dir.' and Create faile .');
				}
			}
			elseif (!is_writable($html_dir))
			{
				exit('Sorry , The Folder '.$html_dir.' can not write');
			}//+	end the second folder

			$htmldata_dir=$html_dir.'/'.$root;
			unset($html_dir);
			if (!is_dir($htmldata_dir))
			{
				if (!mkdir($htmldata_dir,0777))
				{
					exit('Sorry , There is no html data dir'.$htmldata_dir.' and Create faile .');
				}
			}
			elseif (!is_writable($htmldata_dir))
			{
				exit('Sorry , The Folder '.$htmldata_dir.' can not write');
			}
			return $htmldata_dir;
		}

		//+-----------------------------
		//+	start create news html files
		//+-----------------------------
		function place_news($data,$input_data,$name)
		{//+	替换 html 模板中的变量
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{WEBTITLE}",headtitle($input_data['news_title']),$data);
			$data=str_replace("{HTML_TITLE}",html($input_data['news_title']),$data);
			$data=str_replace("{HTML_TEXT}",wane_text($input_data['news_text']),$data);
			$data=str_replace("{HTML_TIME}",$input_data['news_time'],$data);

			$data=str_replace("{HTML_CLICK}",$input_data['news_click'],$data);
			$data=str_replace("{HTML_ITFROM}",$input_data['news_from'],$data);

			$data=str_replace("{INFOID}",$name,$data);

			return $data;
		}
		function c_news($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{//+	生成 html 文件  function c_new('模板头','模板主体','模板脚','静态文件名','静态文件栏目','存储单位','提交数据','后台操作');
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_news($tpldata,$input_data,$name);

			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
		function d_news($news_dir,$news_name,$admin=0)
		{
			global $htmlroot,$dirhtml_news;
			if ($admin)
			{
				$html_root='../'.$htmlroot.$dirhtml_news.'/';
			}
			else
			{
				$html_root=$htmlroot.$dirhtml_news.'/';
			}
			$filename=$html_root.$news_dir.'/'.$news_name.'.html';
			delete_file($filename);
		}
		//+-----------------------------
		//+	end	 create news html files
		//+-----------------------------


		//+-------------------------------
		//+	start create jobway html files
		//+-------------------------------
		function place_jobway($data,$input_data,$name)
		{//+	替换 html 模板中的变量
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{WEBTITLE}",headtitle($input_data['news_title']),$data);
			$data=str_replace("{HTML_TITLE}",html($input_data['news_title']),$data);
			$data=str_replace("{HTML_TEXT}",wane_text($input_data['news_text']),$data);
			$data=str_replace("{HTML_TIME}",$input_data['news_time'],$data);

			$data=str_replace("{HTML_CLICK}",$input_data['news_click'],$data);
			$data=str_replace("{HTML_ITFROM}",$input_data['news_from'],$data);

			$data=str_replace("{INFOID}",$name,$data);

			return $data;
		}
		function c_jobway($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{//+	生成 html 文件
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_news($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
		function d_jobway($news_dir,$news_name,$admin=0)
		{
			global $htmlroot,$dirhtml_way;
			if ($admin)
			{
				$html_root='../'.$htmlroot.$dirhtml_way.'/';
			}
			else
			{
				$html_root=$htmlroot.$dirhtml_way.'/';
			}
			$filename=$html_root.$news_dir.'/'.$news_name.'.html';
			delete_file($filename);
		}
		//+-------------------------------
		//+	end	 create jobway html files
		//+-------------------------------














		//+-------------------------------
		//+	start create joblaw html files
		//+-------------------------------
		function place_joblaw($data,$input_data,$name)
		{//+	替换 html 模板中的变量
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{WEBTITLE}",headtitle($input_data['news_title']),$data);
			$data=str_replace("{HTML_TITLE}",html($input_data['news_title']),$data);
			$data=str_replace("{HTML_TEXT}",wane_text($input_data['news_text']),$data);
			$data=str_replace("{HTML_TIME}",$input_data['news_time'],$data);

			$data=str_replace("{HTML_CLICK}",$input_data['news_click'],$data);
			$data=str_replace("{HTML_ITFROM}",$input_data['news_from'],$data);

			$data=str_replace("{INFOID}",$name,$data);

			return $data;
		}
		function c_joblaw($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{//+	生成 html 文件
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_news($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
		function d_joblaw($news_dir,$news_name,$admin=0)
		{
			global $htmlroot,$dirhtml_law;
			if ($admin)
			{
				$html_root='../'.$htmlroot.$dirhtml_law.'/';
			}
			else
			{
				$html_root=$htmlroot.$dirhtml_law.'/';
			}
			$filename=$html_root.$news_dir.'/'.$news_name.'.html';
			delete_file($filename);
		}
		//+-------------------------------
		//+	end	 create jobway html files
		//+-------------------------------







		//+-----------------------------------
		//+	start create hunterinfo html files
		//+-----------------------------------
		function place_hunterinfo($data,$input_data,$name)
		{//+	替换 html 模板中的变量
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{WEBTITLE}",headtitle($input_data['news_title']),$data);
			$data=str_replace("{HTML_TITLE}",html($input_data['news_title']),$data);
			$data=str_replace("{HTML_TEXT}",wane_text($input_data['news_text']),$data);
			$data=str_replace("{HTML_TIME}",$input_data['news_time'],$data);

			$data=str_replace("{HTML_CLICK}",$input_data['news_click'],$data);
			$data=str_replace("{HTML_ITFROM}",$input_data['news_from'],$data);

			$data=str_replace("{INFOID}",$name,$data);

			return $data;
		}
		function c_hunterinfo($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{//+	生成 html 文件  function c_new('模板头','模板主体','模板脚','静态文件名','静态文件栏目','存储单位','提交数据','后台操作');
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_hunterinfo($tpldata,$input_data,$name);

			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}











		//+-------------------------------
		//+	start create joblaw html files
		//+-------------------------------
		function place_job($data,$input_data,$name)
		{//+	替换模板
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);

			$data=str_replace("{INFOTITLE}",$input_data['INFOTITLE'],$data);
			$data=str_replace("{JOB}",$input_data['JOB'],$data);
			$data=str_replace("{COMPANY}",$input_data['COMPANY'],$data);
			$data=str_replace("{LINK}",$input_data['LINK'],$data);
			$data=str_replace("{LINKCOM}",$input_data['LINKCOM'],$data);
			$data=str_replace("{JOBMAN}",$input_data['JOBMAN'],$data);
			$data=str_replace("{JOBPRO}",$input_data['JOBPRO'],$data);
			$data=str_replace("{JOBTIME}",$input_data['JOBTIME'],$data);
			$data=str_replace("{JOBAGE}",$input_data['JOBAGE'],$data);
			$data=str_replace("{JOBSEX}",$input_data['JOBSEX'],$data);
			$data=str_replace("{JOBHEIGHT}",$input_data['JOBHEIGHT'],$data);
			$data=str_replace("{JOBWEIGHT}",$input_data['JOBWEIGHT'],$data);
			$data=str_replace("{JOBSIGHT}",$input_data['JOBSIGHT'],$data);
			$data=str_replace("{JOBSOCIAL}",$input_data['JOBSOCIAL'],$data);
			$data=str_replace("{JOBSALARY}",$input_data['JOBSALARY'],$data);
			$data=str_replace("{JOBADDR}",$input_data['JOBADDR'],$data);
			$data=str_replace("{JOBEDU}",$input_data['JOBEDU'],$data);
			$data=str_replace("{JOBENG}",$input_data['JOBENG'],$data);
			$data=str_replace("{JOBDEPART}",$input_data['JOBDEPART'],$data);
			$data=str_replace("{JOBCONTEXT}",wane_text($input_data['JOBCONTEXT']),$data);
			if ($input_data['ADDTIME']!='-1')
			{
				$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			}
			if ($input_data['LOSETIME']!='-1')
			{
				$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			}
			if ($input_data['CLICK']!='-1')
			{
				$data=str_replace("{CLICK}",$input_data['CLICK'],$data);
			}
			return $data;
		}
		function c_job($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{//+	创建模板
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_job($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
		function d_job($news_dir,$news_name,$admin=0)
		{//+	 删除静态文件
			global $htmlroot,$dirhtml_job;
			if ($admin)
			{
				$html_root='../'.$htmlroot.$dirhtml_job.'/';
			}
			else
			{
				$html_root=$htmlroot.$dirhtml_job.'/';
			}
			$filename=$html_root.$news_dir.'/'.$news_name.'.html';
			delete_file($filename);
		}














		//+-------------------------------
		//+	start create joblaw html files
		//+-------------------------------
		function place_find($data,$input_data,$name)
		{//+	替换模板
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);

			$data=str_replace("{INFOTITLE}",$input_data['INFOTITLE'],$data);
			$data=str_replace("{JOB}",$input_data['JOB'],$data);
			$data=str_replace("{TRUENAME}",$input_data['TRUENAME'],$data);
			$data=str_replace("{JLLINK}",$input_data['JLLINK'],$data);
			$data=str_replace("{LINK}",$input_data['LINK'],$data);
			$data=str_replace("{WORK_ADDRESS}",$input_data['WORK_ADDRESS'],$data);
			$data=str_replace("{SEX}",$input_data['SEX'],$data);
			$data=str_replace("{BIRTH}",$input_data['BIRTH'],$data);
			$data=str_replace("{MINZU}",$input_data['MINZU'],$data);
			$data=str_replace("{EDU}",$input_data['EDU'],$data);
			$data=str_replace("{ENG_NENGLI}",$input_data['ENG_NENGLI'],$data);
			$data=str_replace("{ZHUANYE}",$input_data['ZHUANYE'],$data);
			$data=str_replace("{ZHUANYENAME}",$input_data['ZHUANYENAME'],$data);

			$data=str_replace("{PHONE}",$input_data['PHONE'],$data);
			$data=str_replace("{HANDPHONE}",$input_data['HANDPHONE'],$data);
			$data=str_replace("{EMAIL}",$input_data['EMAIL'],$data);
			$data=str_replace("{HOMEPAGE}",$input_data['HOMEPAGE'],$data);
			$data=str_replace("{JOBTEXT}",$input_data['JOBTEXT'],$data);

			$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);
			return $data;
		}
		function c_find($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_find($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
		function d_find($news_dir,$news_name,$admin=0)
		{//+	 删除静态文件
			global $htmlroot,$dirhtml_find;
			if ($admin)
			{
				$html_root='../'.$htmlroot.$dirhtml_find.'/';
			}
			else
			{
				$html_root=$htmlroot.$dirhtml_find.'/';
			}
			$filename=$html_root.$news_dir.'/'.$news_name.'.html';
			delete_file($filename);
		}





		//+----------------------------------------
		//+	start create personal hunter html files
		//+----------------------------------------
		function place_perhunter($data,$input_data,$name)
		{//+	替换模板
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);
			$data=str_replace("{TRUENAME}",$input_data['TRUENAME'],$data);
			$data=str_replace("{INDUSTRY}",$input_data['INDUSTRY'],$data);
			$data=str_replace("{YEARSALARY}",$input_data['YEARSALARY'],$data);
			$data=str_replace("{FOR_YEARSALARY}",$input_data['FOR_YEARSALARY'],$data);
			$data=str_replace("{POSITION}",$input_data['POSITION'],$data);
			$data=str_replace("{FOR_POSITION}",$input_data['FOR_POSITION'],$data);
			$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			$data=str_replace("{MOBILE}",$input_data['MOBILE'],$data);
			$data=str_replace("{HOMEPHONE}",$input_data['HOMEPHONE'],$data);
			$data=str_replace("{ADDRESS}",$input_data['ADDRESS'],$data);
			$data=str_replace("{ZIPCODE}",$input_data['ZIPCODE'],$data);
			$data=str_replace("{EMAIL}",$input_data['EMAIL'],$data);
			$data=str_replace("{LINKTIME}",$input_data['LINKTIME'],$data);
			$data=str_replace("{SEX}",$input_data['SEX'],$data);
			$data=str_replace("{BIRTH}",$input_data['BIRTH'],$data);
			$data=str_replace("{SID}",$input_data['SID'],$data);
			$data=str_replace("{MARRY}",$input_data['MARRY'],$data);
			$data=str_replace("{HUKOU}",$input_data['HUKOU'],$data);
			$data=str_replace("{LIVING}",$input_data['LIVING'],$data);
			$data=str_replace("{WORK_ADDR}",$input_data['WORK_ADDR'],$data);
			$data=str_replace("{EDU}",$input_data['EDU'],$data);
			$data=str_replace("{GRAEDU}",$input_data['GRAEDU'],$data);
			$data=str_replace("{DEPART}",$input_data['DEPART'],$data);
			$data=str_replace("{TRAIN}",$input_data['TRAIN'],$data);
			$data=str_replace("{WORKEXP}",$input_data['WORKEXP'],$data);
			$data=str_replace("{TECHANG}",$input_data['TECHANG'],$data);
			$data=str_replace("{CONTEXT}",$input_data['CONTEXT'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);
			$data=str_replace("{LINK}",$input_data['LINK'],$data);
			$data=str_replace("{INFOTITLE}",$input_data['INFOTITLE'],$data);
			return $data;
		}
		function c_perhunter($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_perhunter($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
		function d_perhunter($news_dir,$news_name,$admin=0)
		{//+	 删除静态文件
			global $htmlroot,$dirhtml_find;
			if ($admin)
			{
				$html_root='../'.$htmlroot.$dirhtml_find.'/';
			}
			else
			{
				$html_root=$htmlroot.$dirhtml_find.'/';
			}
			$filename=$html_root.$news_dir.'/'.$news_name.'.html';
			delete_file($filename);
		}








		//+	company hunter start
		function place_comhunter($data,$input_data,$name)
		{
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);

			$data=str_replace("{INFOTITLE}",$input_data['INFOTITLE'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);
			$data=str_replace("{JOB}",$input_data['JOB'],$data);
			$data=str_replace("{JOB_ADDRESS}",$input_data['JOB_ADDRESS'],$data);
			$data=str_replace("{JOB_TEXT}",$input_data['JOB_TEXT'],$data);
			$data=str_replace("{COMPANY}",$input_data['COMPANY'],$data);
			$data=str_replace("{LINKCOM}",$input_data['LINKCOM'],$data);
			$data=str_replace("{QYADDRESS}",$input_data['QYADDRESS'],$data);
			$data=str_replace("{QYPRO}",$input_data['QYPRO'],$data);
			$data=str_replace("{QYKIND}",$input_data['QYKIND'],$data);
			$data=str_replace("{QYSPACE}",$input_data['QYSPACE'],$data);
			$data=str_replace("{CONTACT}",$input_data['CONTACT'],$data);
			$data=str_replace("{QYPHONE}",$input_data['QYPHONE'],$data);
			$data=str_replace("{QYMAIL}",$input_data['QYMAIL'],$data);
			$data=str_replace("{QYWEB}",$input_data['QYWEB'],$data);
			$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			$data=str_replace("{LINK}",$input_data['LINK'],$data);
			return $data;
		}
		function c_comhunter($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_comhunter($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}





		function place_school($data,$input_data,$name)
		{
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);

			$data=str_replace("{LINK}",$input_data['LINK'],$data);
			$data=str_replace("{SNAME}",$input_data['SNAME'],$data);
			$data=str_replace("{CONTEXT}",wane_text($input_data['CONTEXT']),$data);
			$data=str_replace("{CONTENT}",wane_text($input_data['CONTENT']),$data);
			$data=str_replace("{SIGN_CONTENT}",wane_text($input_data['SIGN_CONTENT']),$data);
			$data=str_replace("{CONTACT}",$input_data['CONTACT'],$data);
			$data=str_replace("{PHONE}",$input_data['PHONE'],$data);
			$data=str_replace("{FAX}",$input_data['FAX'],$data);
			$data=str_replace("{ADDRESS}",$input_data['ADDRESS'],$data);
			$data=str_replace("{CODE}",$input_data['CODE'],$data);
			$data=str_replace("{EMAIL}",$input_data['EMAIL'],$data);
			$data=str_replace("{URL}",$input_data['URL'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);
			return $data;
		}
		function c_school($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_school($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}









		function place_lesson($data,$input_data,$name)
		{
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);

			$data=str_replace("{LINK}",$input_data['LINK'],$data);
			$data=str_replace("{SCHOOL_LINK}",$input_data['SCHOOL_LINK'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);
			$data=str_replace("{LESSON}",$input_data['LESSON'],$data);
			$data=str_replace("{LESSON_TYPE}",$input_data['LESSON_TYPE'],$data);
			$data=str_replace("{LESSON_SCHOOL}",$input_data['LESSON_SCHOOL'],$data);
			$data=str_replace("{LESSON_START}",$input_data['LESSON_START'],$data);
			$data=str_replace("{LESSON_BEGIN}",$input_data['LESSON_BEGIN'],$data);
			$data=str_replace("{LESSON_MONEY}",$input_data['LESSON_MONEY'],$data);
			$data=str_replace("{LESSON_CLASSES}",$input_data['LESSON_CLASSES'],$data);
			$data=str_replace("{LESSON_LEADER}",$input_data['LESSON_LEADER'],$data);
			$data=str_replace("{LESSON_ADDRESS}",$input_data['LESSON_ADDRESS'],$data);
			$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			$data=str_replace("{CONTACT}",$input_data['CONTACT'],$data);
			$data=str_replace("{PHONE}",$input_data['PHONE'],$data);
			$data=str_replace("{EMAIL}",$input_data['EMAIL'],$data);
			$data=str_replace("{FAX}",$input_data['FAX'],$data);
			$data=str_replace("{URL}",$input_data['URL'],$data);
			$data=str_replace("{DIREACTION}",$input_data['DIREACTION'],$data);
			$data=str_replace("{CONTENT}",$input_data['CONTENT'],$data);
			$data=str_replace("{CONTEXT}",$input_data['CONTEXT'],$data);
			return $data;
		}
		function c_lesson($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_lesson($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}




		function place_teacherjob($data,$input_data,$name)
		{
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{INFOID}",$input_data['INFOID'],$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);
			$data=str_replace("{TITLE}",$input_data['TITLE'],$data);
			$data=str_replace("{SEX}",$input_data['SEX'],$data);
			$data=str_replace("{EDU}",$input_data['EDU'],$data);
			$data=str_replace("{ADDRESS}",$input_data['ADDRESS'],$data);
			$data=str_replace("{DEPART}",$input_data['DEPART'],$data);
			$data=str_replace("{CONTENT}",$input_data['CONTENT'],$data);
			$data=str_replace("{CONTEXT}",$input_data['CONTEXT'],$data);
			$data=str_replace("{CONTACT}",$input_data['CONTACT'],$data);
			$data=str_replace("{PHONE}",$input_data['PHONE'],$data);
			$data=str_replace("{EMAIL}",$input_data['EMAIL'],$data);
			$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);

			return $data;
		}
		function c_teacherjob($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_teacherjob($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}







		function place_teacherfind($data,$input_data,$name)
		{
			global	$imgdir,$charset,$tablewidth,$adminemail;
			$backurl="http://".$GLOBALS['HTTP_SERVER_VARS']['HTTP_HOST'];
			$data=str_replace("{IMGDIR}",$imgdir,$data);
			$data=str_replace("{CHARSET}",$charset,$data);
			$data=str_replace("{TABLEWIDTH}",$tablewidth,$data);
			$data=str_replace("{ADMINEMAIL}",$adminemail,$data);
			$data=str_replace("{BACKURL}",$backurl,$data);

			$data=str_replace("{INFOID}",$input_data['INFOID'],$data);
			$data=str_replace("{WEBTITLE}",$input_data['WEBTITLE'],$data);
			$data=str_replace("{TITLE}",$input_data['TITLE'],$data);
			$data=str_replace("{TRUENAME}",$input_data['TRUENAME'],$data);
			$data=str_replace("{SEX}",$input_data['SEX'],$data);
			$data=str_replace("{EDU}",$input_data['EDU'],$data);
			$data=str_replace("{DEPART}",$input_data['DEPART'],$data);
			$data=str_replace("{LIVING}",$input_data['LIVING'],$data);
			$data=str_replace("{WORK}",$input_data['WORK'],$data);
			$data=str_replace("{CONTEXT}",$input_data['CONTEXT'],$data);
			$data=str_replace("{PHONE}",$input_data['PHONE'],$data);
			$data=str_replace("{EMAIL}",$input_data['EMAIL'],$data);
			$data=str_replace("{ADDTIME}",$input_data['ADDTIME'],$data);
			$data=str_replace("{LOSETIME}",$input_data['LOSETIME'],$data);
			$data=str_replace("{CLICK}",$input_data['CLICK'],$data);

			return $data;
		}
		function c_teacherfind($header,$center,$footer,$name,$html_type,$root,$input_data,$admin)
		{
			global $htmltpldir;
			$htmldata_dir=$this->c_dir($html_type,$root,$admin);
			if ($admin)
			{
				$htmltpl='../'.$htmltpldir;
			}
			else
			{
				$htmltpl=$htmltpldir;
			}
			$t_header=$htmltpl.'header/'.$header;
			$t_center=$htmltpl.'center/'.$center;
			$t_footer=$htmltpl.'footer/'.$footer;
			if (!file_exists($t_header) || !file_exists($t_center) || !file_exists($t_footer))	{exit('There is no enough Template files to Create html files.');}
			$tpldata="<!--\nPowered by SimPHP (c) Copyright 2004 . \nLast modify : ".date("Y-m-d H:i:s",time())."\nWebsite : http://www.php365.cn \n-->\n";

			$tpl_h=fopen($t_header,'r');
			$tpldata.=fread($tpl_h,filesize($t_header));
			fclose($tpl_h);

			$tpl_c=fopen($t_center,'r');
			$tpldata.=fread($tpl_c,filesize($t_center));
			fclose($tpl_c);

			$tpl_f=fopen($t_footer,'r');
			$tpldata.=fread($tpl_f,filesize($t_footer));
			fclose($tpl_f);

			$tpl_data=$this->place_teacherfind($tpldata,$input_data,$name);
			$fp=fopen($htmldata_dir.'/'.$name.'.html','w+');
			unset($htmldata_dir);
			fwrite($fp,$tpl_data);
			fclose($fp);
		}
	}
?>