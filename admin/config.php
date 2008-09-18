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
	|   > Last	modify	:	2004/12/24 23:24
	+-------------------------------------------
	*/

	require "admin_globals.php";
	require "admin_check.php";
	$bbsarray=array(
		'dz25'	=>	'Discuz!2.5',
		'dz40'	=>	'Discuz!4.0',
		'pw20'	=>	'phpwind2.0',
		'ip13'	=>	'IPB1.3',
		'pb208'	=>	'PHPBB2.0.8',
		'vbb23'	=>	'VBB2.3.4',
	);
	function checked($str1,$str2)
	{
		if ($str1==$str2)
		{
			$info = "checked";
		}
		else
		{
			$info = "";
		}
		return $info;
	}
	function namedir($str)
	{
		switch ($str)
		{
			case	'search'	:	$return='信息查询 模板组';break;
			case	'common'	:	$return='公用文件 模板组';break;
			case	'company'	:	$return='企业用户控制 模板组';break;
			case	'personal'	:	$return='个人用户控制 模板组';break;
			case	'html'		:	$return='生成html文件模板组 模板组';break;
			case	'view'		:	$return='信息详情 模板组';break;
			case	'header'	:	$return='静态文件 头体 模板组';break;
			case	'center'	:	$return='静态文件 主体 模板组';break;
			case	'footer'	:	$return='静态文件 脚体 模板组';break;
		}
		return $return;
	}
	function write_yes($filename)
	{
		$return=!file_exists($filename)	?	$filename.' <font color=\'#ff0000\'>不存在,请通过 FTP 上传此文件.</font>'	:	(!is_writable($filename)	?	$filename.' <font color=\'#ff0000\'>不可写,请通过 FTP 将此文件属性设成 0777 可写.</font>'	:	' <font color=\'#6699cc\'>成功</font>');
		return $return;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="index,follow">
<meta name="keywords" content="SimHR,A_Space,F_Space,J_Space,H_Space,article,PHP,MySQL,Template">
<meta name="generator" content="SimHR V4.5 with Templates">
<meta name="description" content="SimHR - Powered by SimPHP">
<meta name="MSSmartTagsPreventParsing" content="TRUE">
<meta http-equiv="MSThemeCompatible" content="Yes">
<title><?php echo $webtitle;?> - Power by wan-e.net inc !</title>
<link href="images/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18" height="16" align="right" valign="bottom"><img src="images/left_top.gif" width="18" height="16"></td>
    <td align="center" valign="bottom" background="images/row_top.gif"></td>
    <td width="14" align="left" valign="bottom"><img src="images/right_top.gif" width="14" height="16"></td>
  </tr>
  <tr>
    <td align="right" background="images/left_bg.gif">&nbsp;</td>
    <td align="center" valign="middle" background="images/main_bg.gif">
<?
if ($HTTP_POST_VARS['save_config'])
{
	if (!is_writeable('../config.inc.php'))	{echo clickback('config.inc.php 文件没有可写入的权限!');}
	else
	{
		$tablepre=addslashes($HTTP_POST_VARS['tablepre']);
		$bbstype = addslashes($HTTP_POST_VARS['bbstype']);
		$bbspre=addslashes($HTTP_POST_VARS['bbspre']);
		$adminemail=addslashes($HTTP_POST_VARS['adminemail']);
		$webtitle=addslashes($HTTP_POST_VARS['webtitle']);

		$cookpath=addslashes($HTTP_POST_VARS['cookpath']);
		$cookdomain=addslashes($HTTP_POST_VARS['cookdomain']);

        $fp = fopen('../config.inc.php', 'r');
        $configfile = fread($fp, filesize('../config.inc.php'));
        fclose($fp);

		$configfile = preg_replace("/[$]tablepre\s*\=\s*[\"'].*?[\"']/is", "\$tablepre = '$tablepre'", $configfile);
		$configfile = preg_replace("/[$]bbstype\s*\=\s*[\"'].*?[\"']/is", "\$bbstype = '$bbstype'", $configfile);
		$configfile = preg_replace("/[$]bbspre\s*\=\s*[\"'].*?[\"']/is", "\$bbspre = '$bbspre'", $configfile);
		$configfile = preg_replace("/[$]adminemail\s*\=\s*[\"'].*?[\"']/is", "\$adminemail = '$adminemail'", $configfile);
		$configfile = preg_replace("/[$]webtitle\s*\=\s*[\"'].*?[\"']/is", "\$webtitle = '$webtitle'", $configfile);

		$configfile = preg_replace("/[$]cookpath\s*\=\s*[\"'].*?[\"']/is", "\$cookpath = '$cookpath'", $configfile);
		$configfile = preg_replace("/[$]cookdomain\s*\=\s*[\"'].*?[\"']/is", "\$cookdomain = '$cookdomain'", $configfile);
		$fp = fopen('../config.inc.php', 'w');
        fwrite($fp, trim($configfile));
        fclose($fp);
		echo refreshback('操作成功');
		echo showmsg('config.php?action=config','2');
		echo endhtml();
		echo wwwwanenet();
		exit;
	}
}
else if ($HTTP_POST_VARS['save_env'])
{
	if (!is_writeable('../common/system.php'))	{echo clickback('../common/system.php  文件不可写');exit;}
	else
	{
		$tpldir = $HTTP_POST_VARS['tpldir'];
		$htmltpldir = $HTTP_POST_VARS['htmltpldir'];
		$imgdir = $HTTP_POST_VARS['imgdir'];
		$htmlroot = $HTTP_POST_VARS['htmlroot'];
		$charset = $HTTP_POST_VARS['charset'];
		$tablewidth = $HTTP_POST_VARS['tablewidth'];

		$shownewcom	=	$HTTP_POST_VARS['shownewcom'];
		$shownewper	=	$HTTP_POST_VARS['shownewper'];

		$ad_info = $HTTP_POST_VARS['ad_info'];
		$flinks_info = $HTTP_POST_VARS['flink_info'];
		$flinks_num_row = $HTTP_POST_VARS['flink_num_row'];
		$gzip_info = $HTTP_POST_VARS['gzip_info'];
		$process_info = $HTTP_POST_VARS['process_info'];
		$online_info = $HTTP_POST_VARS['online_info'];

		$onlinetime = $HTTP_POST_VARS['onlinetime'];
		$mailreg = $HTTP_POST_VARS['mailreg'];
		$cookieway = $HTTP_POST_VARS['cookieway'];
		$cookietime = $HTTP_POST_VARS['cookietime'];

		$sendjob_time = $HTTP_POST_VARS['sendjob_time'];
		$sendfind_time = $HTTP_POST_VARS['sendfind_time'];
		$sendhunterjob_time = $HTTP_POST_VARS['sendhunterjob_time'];
		$sendhunterfind_time = $HTTP_POST_VARS['sendhunterfind_time'];

        $fp = fopen('../common/system.php', 'r');
        $configfile = fread($fp, filesize('../common/system.php'));
        fclose($fp);

		$configfile = preg_replace("/[$]tpldir\s*\=\s*[\"'].*?[\"']/is", "\$tpldir = '$tpldir'", $configfile);
		$configfile = preg_replace("/[$]htmltpldir\s*\=\s*[\"'].*?[\"']/is", "\$htmltpldir = '$htmltpldir'", $configfile);
		$configfile = preg_replace("/[$]imgdir\s*\=\s*[\"'].*?[\"']/is", "\$imgdir = '$imgdir'", $configfile);
		$configfile = preg_replace("/[$]htmlroot\s*\=\s*[\"'].*?[\"']/is", "\$htmlroot = '$htmlroot'", $configfile);
		$configfile = preg_replace("/[$]charset\s*\=\s*[\"'].*?[\"']/is", "\$charset = '$charset'", $configfile);
		$configfile = preg_replace("/[$]tablewidth\s*\=\s*[\"'].*?[\"']/is", "\$tablewidth = '$tablewidth'", $configfile);

		$configfile = preg_replace("/[$]shownewcom\s*\=\s*[\"'].*?[\"']/is", "\$shownewcom = '$shownewcom'", $configfile);
		$configfile = preg_replace("/[$]shownewper\s*\=\s*[\"'].*?[\"']/is", "\$shownewper = '$shownewper'", $configfile);

		$configfile = preg_replace("/[$]ad_info\s*\=\s*[\"'].*?[\"']/is", "\$ad_info = '$ad_info'", $configfile);
		$configfile = preg_replace("/[$]flink_info\s*\=\s*[\"'].*?[\"']/is", "\$flink_info = '$flinks_info'", $configfile);
		$configfile = preg_replace("/[$]flink_num_row\s*\=\s*[\"'].*?[\"']/is", "\$flink_num_row = '$flinks_num_row'", $configfile);
		$configfile = preg_replace("/[$]gzip_info\s*\=\s*[\"'].*?[\"']/is", "\$gzip_info = '$gzip_info'", $configfile);
		$configfile = preg_replace("/[$]process_info\s*\=\s*[\"'].*?[\"']/is", "\$process_info = '$process_info'", $configfile);
		$configfile = preg_replace("/[$]online_info\s*\=\s*[\"'].*?[\"']/is", "\$online_info = '$online_info'", $configfile);

		$configfile = preg_replace("/[$]onlinetime\s*\=\s*[\"'].*?[\"']/is", "\$onlinetime = '$onlinetime'", $configfile);
		$configfile = preg_replace("/[$]mailreg\s*\=\s*[\"'].*?[\"']/is", "\$mailreg = '$mailreg'", $configfile);
		$configfile = preg_replace("/[$]cookieway\s*\=\s*[\"'].*?[\"']/is", "\$cookieway = '$cookieway'", $configfile);
		$configfile = preg_replace("/[$]cookietime\s*\=\s*[\"'].*?[\"']/is", "\$cookietime = '$cookietime'", $configfile);

		$configfile = preg_replace("/[$]sendjob_time\s*\=\s*[\"'].*?[\"']/is", "\$sendjob_time = '$sendjob_time'", $configfile);
		$configfile = preg_replace("/[$]sendfind_time\s*\=\s*[\"'].*?[\"']/is", "\$sendfind_time = '$sendfind_time'", $configfile);
		$configfile = preg_replace("/[$]sendhunterjob_time\s*\=\s*[\"'].*?[\"']/is", "\$sendhunterjob_time = '$sendhunterjob_time'", $configfile);
		$configfile = preg_replace("/[$]sendhunterfind_time\s*\=\s*[\"'].*?[\"']/is", "\$sendhunterfind_time = '$sendhunterfind_time'", $configfile);

		$fp = fopen('../common/system.php', 'w');
        fwrite($fp, trim($configfile));
        fclose($fp);
		echo refreshback('操作成功');
		echo showmsg('config.php?action=env','2');
		echo endhtml();
		echo wwwwanenet();
		exit;
	}
}
else if ($HTTP_POST_VARS['save_html'])
{
	if (!is_writeable('../common/system.php'))	{echo clickback('../common/system.php  文件不可写');exit;}
	else
	{
		$default_root = '../'.$htmltpldir.'/center/';
		$html_job = $HTTP_POST_VARS['html_job'];
		$default_job = $HTTP_POST_VARS['default_job'];
		if (!file_exists($default_root.$default_job) && $html_job=='1')	{echo clickback('招聘模板不存在');exit;}

		$html_find = $HTTP_POST_VARS['html_find'];
		$default_find = $HTTP_POST_VARS['default_find'];
		if (!file_exists($default_root.$default_find) && $html_find=='1')	{echo clickback('求职模板不存在');exit;}

		$html_perhunter = $HTTP_POST_VARS['html_perhunter'];
		$default_perhunter = $HTTP_POST_VARS['default_perhunter'];
		if (!file_exists($default_root.$default_perhunter) && $html_perhunter=='1')	{echo clickback('猎头人才模板不存在');exit;}

		$html_comhunter = $HTTP_POST_VARS['html_comhunter'];
		$default_comhunter = $HTTP_POST_VARS['default_comhunter'];
		if (!file_exists($default_root.$default_comhunter) && $html_comhunter=='1')	{echo clickback('猎头职位模板不存在');exit;}

		$html_findteacher = $HTTP_POST_VARS['html_findteacher'];
		$default_findteacher = $HTTP_POST_VARS['default_findteacher'];
		if (!file_exists($default_root.$default_findteacher) && $html_findteacher=='1')	{echo clickback('招聘家教模板不存在');exit;}

		$html_taketeacher = $HTTP_POST_VARS['html_taketeacher'];
		$default_taketeacher = $HTTP_POST_VARS['default_taketeacher'];
		if (!file_exists($default_root.$default_taketeacher) && $html_taketeacher=='1')	{echo clickback('求职家教模板不存在');exit;}

		$html_peixun = $HTTP_POST_VARS['html_peixun'];
		$default_peixun = $HTTP_POST_VARS['default_peixun'];
		if (!file_exists($default_root.$default_peixun) && $html_peixun=='1')	{echo clickback('培训模板不存在');exit;}

		$html_news = $HTTP_POST_VARS['html_news'];
		$default_news = $HTTP_POST_VARS['default_news'];
		if (!file_exists($default_root.$default_news) && $html_news=='1')	{echo clickback('新闻动态模板不存在');exit;}

		$html_law = $HTTP_POST_VARS['html_law'];
		$default_law = $HTTP_POST_VARS['default_law'];
		if (!file_exists($default_root.$default_law) && $html_law=='1')	{echo clickback('政策法规模板不存在');exit;}

		$html_way = $HTTP_POST_VARS['html_way'];
		$default_way = $HTTP_POST_VARS['default_way'];
		if (!file_exists($default_root.$default_way) && $html_way=='1')	{echo clickback('求职攻略模板不存在');exit;}

		$html_school = $HTTP_POST_VARS['html_school'];
		$default_school = $HTTP_POST_VARS['default_school'];
		if (!file_exists($default_root.$default_school) && $html_school=='1')	{echo clickback('培训学校模板不存在');exit;}

		$html_lesson = $HTTP_POST_VARS['html_lesson'];
		$default_lesson = $HTTP_POST_VARS['default_lesson'];
		if (!file_exists($default_root.$default_lesson) && $html_lesson=='1')	{echo clickback('培训课程模板不存在');exit;}

		$dirhtml_unit = $HTTP_POST_VARS['dirhtml_unit'];
		$dirhtml_job = $HTTP_POST_VARS['dirhtml_job'];
		$dirhtml_find = $HTTP_POST_VARS['dirhtml_find'];
		//$dirhtml_com = $HTTP_POST_VARS['dirhtml_com'];
		//$dirhtml_per = $HTTP_POST_VARS['dirhtml_per'];
		$dirhtml_comhunter = $HTTP_POST_VARS['dirhtml_comhunter'];
		$dirhtml_perhunter = $HTTP_POST_VARS['dirhtml_perhunter'];
		$dirhtml_findteacher = $HTTP_POST_VARS['dirhtml_findteacher'];
		$dirhtml_taketeacher = $HTTP_POST_VARS['dirhtml_taketeacher'];
		$dirhtml_peixun = $HTTP_POST_VARS['dirhtml_peixun'];
		$dirhtml_news = $HTTP_POST_VARS['dirhtml_news'];
		$dirhtml_law = $HTTP_POST_VARS['dirhtml_law'];
		$dirhtml_way = $HTTP_POST_VARS['dirhtml_way'];

		$dirhtml_school = $HTTP_POST_VARS['dirhtml_school'];
		$dirhtml_lesson = $HTTP_POST_VARS['dirhtml_lesson'];

        $fp = fopen('../common/system.php', 'r');
        $configfile = fread($fp, filesize('../common/system.php'));
        fclose($fp);

		$configfile = preg_replace("/[$]html_job\s*\=\s*[\"'].*?[\"']/is", "\$html_job = '$html_job'", $configfile);
		$configfile = preg_replace("/[$]default_job\s*\=\s*[\"'].*?[\"']/is", "\$default_job = '$default_job'", $configfile);
		$configfile = preg_replace("/[$]html_find\s*\=\s*[\"'].*?[\"']/is", "\$html_find = '$html_find'", $configfile);
		$configfile = preg_replace("/[$]default_find\s*\=\s*[\"'].*?[\"']/is", "\$default_find = '$default_find'", $configfile);
		$configfile = preg_replace("/[$]html_perhunter\s*\=\s*[\"'].*?[\"']/is", "\$html_perhunter = '$html_perhunter'", $configfile);
		$configfile = preg_replace("/[$]default_perhunter\s*\=\s*[\"'].*?[\"']/is", "\$default_perhunter = '$default_perhunter'", $configfile);
		$configfile = preg_replace("/[$]html_comhunter\s*\=\s*[\"'].*?[\"']/is", "\$html_comhunter = '$html_comhunter'", $configfile);
		$configfile = preg_replace("/[$]default_comhunter\s*\=\s*[\"'].*?[\"']/is", "\$default_comhunter = '$default_comhunter'", $configfile);
		$configfile = preg_replace("/[$]html_findteacher\s*\=\s*[\"'].*?[\"']/is", "\$html_findteacher = '$html_findteacher'", $configfile);
		$configfile = preg_replace("/[$]default_findteacher\s*\=\s*[\"'].*?[\"']/is", "\$default_findteacher = '$default_findteacher'", $configfile);
		$configfile = preg_replace("/[$]html_taketeacher\s*\=\s*[\"'].*?[\"']/is", "\$html_taketeacher = '$html_taketeacher'", $configfile);
		$configfile = preg_replace("/[$]default_taketeacher\s*\=\s*[\"'].*?[\"']/is", "\$default_taketeacher = '$default_taketeacher'", $configfile);
		$configfile = preg_replace("/[$]html_hunterinfo\s*\=\s*[\"'].*?[\"']/is", "\$html_hunterinfo = '$html_hunterinfo'", $configfile);
		$configfile = preg_replace("/[$]default_hunterinfo\s*\=\s*[\"'].*?[\"']/is", "\$default_hunterinfo = '$default_hunterinfo'", $configfile);
		$configfile = preg_replace("/[$]html_news\s*\=\s*[\"'].*?[\"']/is", "\$html_news = '$html_news'", $configfile);
		$configfile = preg_replace("/[$]default_news\s*\=\s*[\"'].*?[\"']/is", "\$default_news = '$default_news'", $configfile);
		$configfile = preg_replace("/[$]html_law\s*\=\s*[\"'].*?[\"']/is", "\$html_law = '$html_law'", $configfile);
		$configfile = preg_replace("/[$]default_law\s*\=\s*[\"'].*?[\"']/is", "\$default_law = '$default_law'", $configfile);
		$configfile = preg_replace("/[$]html_way\s*\=\s*[\"'].*?[\"']/is", "\$html_way = '$html_way'", $configfile);
		$configfile = preg_replace("/[$]default_way\s*\=\s*[\"'].*?[\"']/is", "\$default_way = '$default_way'", $configfile);


		$configfile = preg_replace("/[$]html_school\s*\=\s*[\"'].*?[\"']/is", "\$html_school = '$html_school'", $configfile);
		$configfile = preg_replace("/[$]default_school\s*\=\s*[\"'].*?[\"']/is", "\$default_school = '$default_school'", $configfile);
		$configfile = preg_replace("/[$]html_lesson\s*\=\s*[\"'].*?[\"']/is", "\$html_lesson = '$html_lesson'", $configfile);
		$configfile = preg_replace("/[$]default_lesson\s*\=\s*[\"'].*?[\"']/is", "\$default_lesson = '$default_lesson'", $configfile);

		$configfile = preg_replace("/[$]dirhtml_unit\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_unit = '$dirhtml_unit'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_job\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_job = '$dirhtml_job'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_find\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_find = '$dirhtml_find'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_comhunter\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_comhunter = '$dirhtml_comhunter'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_perhunter\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_perhunter = '$dirhtml_perhunter'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_findteacher\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_findteacher = '$dirhtml_findteacher'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_taketeacher\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_taketeacher = '$dirhtml_taketeacher'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_hunterinfo\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_hunterinfo = '$dirhtml_hunterinfo'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_news\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_news = '$dirhtml_news'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_law\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_law = '$dirhtml_law'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_way\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_way = '$dirhtml_way'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_school\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_school = '$dirhtml_school'", $configfile);
		$configfile = preg_replace("/[$]dirhtml_lesson\s*\=\s*[\"'].*?[\"']/is", "\$dirhtml_lesson = '$dirhtml_lesson'", $configfile);

		$fp = fopen('../common/system.php', 'w');
        fwrite($fp, trim($configfile));
        fclose($fp);
		echo refreshback('操作成功');
		echo showmsg('config.php?action=html','2');
		echo endhtml();
		echo wwwwanenet();
		exit;
	}
}
else if ($HTTP_POST_VARS['save_img'])
{
	if (!is_writeable('../common/system.php'))	{echo clickback('../common/system.php 文件没有可写入的权限!');}
	else
	{
			$phototype = $HTTP_POST_VARS['phototype'];
			$watermark = $HTTP_POST_VARS['watermark'];
			$watertype = $HTTP_POST_VARS['watertype'];
			$waterstring = $HTTP_POST_VARS['waterstring'];
			$waterimg = $HTTP_POST_VARS['waterimg'];
			$water_width = $HTTP_POST_VARS['water_width'];
			$water_height = $HTTP_POST_VARS['water_height'];
			$water_position = $HTTP_POST_VARS['water_position'];

			$fp = fopen('../common/system.php', 'r');
            $configfile = fread($fp, filesize('../common/system.php'));
            fclose($fp);

			$configfile = preg_replace("/[$]phototype\s*\=\s*[\"'].*?[\"']/is", "\$phototype = '$phototype'", $configfile);
			$configfile = preg_replace("/[$]watermark\s*\=\s*[\"'].*?[\"']/is", "\$watermark = '$watermark'", $configfile);
			$configfile = preg_replace("/[$]watertype\s*\=\s*[\"'].*?[\"']/is", "\$watertype = '$watertype'", $configfile);
			$configfile = preg_replace("/[$]waterstring\s*\=\s*[\"'].*?[\"']/is", "\$waterstring = '$waterstring'", $configfile);
			$configfile = preg_replace("/[$]waterimg\s*\=\s*[\"'].*?[\"']/is", "\$waterimg = '$waterimg'", $configfile);
			$configfile = preg_replace("/[$]water_width\s*\=\s*[\"'].*?[\"']/is", "\$water_width = '$water_width'", $configfile);
			$configfile = preg_replace("/[$]water_height\s*\=\s*[\"'].*?[\"']/is", "\$water_height = '$water_height'", $configfile);
			$configfile = preg_replace("/[$]water_position\s*\=\s*[\"'].*?[\"']/is", "\$water_position = '$water_position'", $configfile);

            $fp = fopen('../common/system.php', 'w');
            fwrite($fp, trim($configfile));
            fclose($fp);
			echo refreshback('操作成功');
			echo showmsg('config.php?action=uploadimg','2');
			echo endhtml();
			echo wwwwanenet();
			exit;
	}
}
elseif ($HTTP_POST_VARS['save_num'])
{
	if (!is_writeable('../common/system.php'))	{echo clickback('../common/system.php 文件没有可写入的权限!');}


	$string_job = $HTTP_POST_VARS['string_job'];				//	招聘
	$string_find = $HTTP_POST_VARS['string_find'];				//	求职
	$string_company = $HTTP_POST_VARS['string_company'];			//	企业名称
	$string_personal = $HTTP_POST_VARS['string_personal'];			//	个人姓名
	$string_hunterjob = $HTTP_POST_VARS['string_hunterjob'];			//	猎头职位
	$string_hunterfind = $HTTP_POST_VARS['string_hunterfind'];			//	猎头人才
	$string_hunterinfo = $HTTP_POST_VARS['string_hunterinfo'];			//	猎头资迅
	$string_school = $HTTP_POST_VARS['string_school'];				//	培训学校
	$string_lesson = $HTTP_POST_VARS['string_lesson'];				//	培训课程
	$string_teacherjob = $HTTP_POST_VARS['string_teacherjob'];			//	家教职位
	$string_teacherfind = $HTTP_POST_VARS['string_teacherfind'];				//	家教人才
	$string_news = $HTTP_POST_VARS['string_news'];					//	新闻
	$string_way  = $HTTP_POST_VARS['string_way'];				//	求职攻略
	$string_law  = $HTTP_POST_VARS['string_law'];				//	政策法规

	$num_job_list =	$HTTP_POST_VARS['num_job_list'];
	$num_find_list = $HTTP_POST_VARS['num_find_list'];
	$num_comhunter_list = $HTTP_POST_VARS['num_comhunter_list'];
	$num_perhunter_list = $HTTP_POST_VARS['num_perhunter_list'];
	$num_hunterinfo_list = $HTTP_POST_VARS['num_hunterinfo_list'];
	$num_school_list = $HTTP_POST_VARS['num_school_list'];
	$num_lesson_list = $HTTP_POST_VARS['num_lesson_list'];
	$num_putteach_list = $HTTP_POST_VARS['num_putteach_list'];
	$num_findteach_list = $HTTP_POST_VARS['num_findteach_list'];
	$num_jobnewphp_list = $HTTP_POST_VARS['num_jobnewphp_list'];
	$num_jobwayphp_list = $HTTP_POST_VARS['num_jobwayphp_list'];
	$num_joblawphp_list = $HTTP_POST_VARS['num_joblawphp_list'];
	$num_new_company = $HTTP_POST_VARS['num_new_company'];
	$num_new_personal = $HTTP_POST_VARS['num_new_personal'];
	$num_job = $HTTP_POST_VARS['num_job'];
	$num_find = $HTTP_POST_VARS['num_find'];
	$num_comhunter = $HTTP_POST_VARS['num_comhunter'];
	$num_perhunter = $HTTP_POST_VARS['num_perhunter'];
	$num_hunterinfo	= $HTTP_POST_VARS['num_hunterinfo'];
	$num_putteacher = $HTTP_POST_VARS['num_putteacher'];
	$num_findteacher = $HTTP_POST_VARS['num_findteacher'];
	$num_schools = $HTTP_POST_VARS['num_schools'];
	$num_lesson	= $HTTP_POST_VARS['num_lesson'];
	$num_news = $HTTP_POST_VARS['num_news'];
	$num_way = $HTTP_POST_VARS['num_way'];
	$num_law	= $HTTP_POST_VARS['num_law'];

	$time_job = $HTTP_POST_VARS['time_job'];
	$time_find = $HTTP_POST_VARS['time_find'];
	$time_hunterjob = $HTTP_POST_VARS['time_hunterjob'];
	$time_hunterfind = $HTTP_POST_VARS['time_hunterfind'];
	$time_hunterinfo = $HTTP_POST_VARS['time_hunterinfo'];
	$time_lesson = $HTTP_POST_VARS['time_lesson'];
	$time_putteacher = $HTTP_POST_VARS['time_putteacher'];
	$time_findteacher = $HTTP_POST_VARS['time_findteacher'];
	$time_news = $HTTP_POST_VARS['time_news'];
	$time_way = $HTTP_POST_VARS['time_way'];
	$time_law = $HTTP_POST_VARS['time_law'];

	$fp = fopen('../common/system.php', 'r');
    $configfile = fread($fp, filesize('../common/system.php'));
    fclose($fp);

	$configfile = preg_replace("/[$]string_job\s*\=\s*[\"'].*?[\"']/is", "\$string_job = '$string_job'", $configfile);
	$configfile = preg_replace("/[$]string_find\s*\=\s*[\"'].*?[\"']/is", "\$string_find = '$string_find'", $configfile);
	$configfile = preg_replace("/[$]string_company\s*\=\s*[\"'].*?[\"']/is", "\$string_company = '$string_company'", $configfile);
	$configfile = preg_replace("/[$]string_personal\s*\=\s*[\"'].*?[\"']/is", "\$string_personal = '$string_personal'", $configfile);
	$configfile = preg_replace("/[$]string_hunterjob\s*\=\s*[\"'].*?[\"']/is", "\$string_hunterjob = '$string_hunterjob'", $configfile);
	$configfile = preg_replace("/[$]string_hunterfind\s*\=\s*[\"'].*?[\"']/is", "\$string_hunterfind = '$string_hunterfind'", $configfile);
	$configfile = preg_replace("/[$]string_hunterinfo\s*\=\s*[\"'].*?[\"']/is", "\$string_hunterinfo = '$string_hunterinfo'", $configfile);
	$configfile = preg_replace("/[$]string_school\s*\=\s*[\"'].*?[\"']/is", "\$string_school = '$string_school'", $configfile);
	$configfile = preg_replace("/[$]string_lesson\s*\=\s*[\"'].*?[\"']/is", "\$string_lesson = '$string_lesson'", $configfile);
	$configfile = preg_replace("/[$]string_teacherjob\s*\=\s*[\"'].*?[\"']/is", "\$string_teacherjob = '$string_teacherjob'", $configfile);
	$configfile = preg_replace("/[$]string_teacherfind\s*\=\s*[\"'].*?[\"']/is", "\$string_teacherfind = '$string_teacherfind'", $configfile);
	$configfile = preg_replace("/[$]string_news\s*\=\s*[\"'].*?[\"']/is", "\$string_news = '$string_news'", $configfile);
	$configfile = preg_replace("/[$]string_way\s*\=\s*[\"'].*?[\"']/is", "\$string_way = '$string_way'", $configfile);
	$configfile = preg_replace("/[$]string_law\s*\=\s*[\"'].*?[\"']/is", "\$string_law = '$string_law'", $configfile);




	$configfile = preg_replace("/[$]num_job_list\s*\=\s*[\"'].*?[\"']/is", "\$num_job_list = '$num_job_list'", $configfile);
	$configfile = preg_replace("/[$]num_find_list\s*\=\s*[\"'].*?[\"']/is", "\$num_find_list = '$num_find_list'", $configfile);
	$configfile = preg_replace("/[$]num_comhunter_list\s*\=\s*[\"'].*?[\"']/is", "\$num_comhunter_list = '$num_comhunter_list'", $configfile);
	$configfile = preg_replace("/[$]num_perhunter_list\s*\=\s*[\"'].*?[\"']/is", "\$num_perhunter_list = '$num_perhunter_list'", $configfile);
	$configfile = preg_replace("/[$]num_hunterinfo_list\s*\=\s*[\"'].*?[\"']/is", "\$num_hunterinfo_list = '$num_hunterinfo_list'", $configfile);
	$configfile = preg_replace("/[$]num_school_list\s*\=\s*[\"'].*?[\"']/is", "\$num_school_list = '$num_school_list'", $configfile);
	$configfile = preg_replace("/[$]num_lesson_list\s*\=\s*[\"'].*?[\"']/is", "\$num_lesson_list = '$num_lesson_list'", $configfile);
	$configfile = preg_replace("/[$]num_putteach_list\s*\=\s*[\"'].*?[\"']/is", "\$num_putteach_list = '$num_putteach_list'", $configfile);
	$configfile = preg_replace("/[$]num_findteach_list\s*\=\s*[\"'].*?[\"']/is", "\$num_findteach_list = '$num_findteach_list'", $configfile);
	$configfile = preg_replace("/[$]num_jobnewphp_list\s*\=\s*[\"'].*?[\"']/is", "\$num_jobnewphp_list = '$num_jobnewphp_list'", $configfile);
	$configfile = preg_replace("/[$]num_jobwayphp_list\s*\=\s*[\"'].*?[\"']/is", "\$num_jobwayphp_list = '$num_jobwayphp_list'", $configfile);
	$configfile = preg_replace("/[$]num_joblawphp_list\s*\=\s*[\"'].*?[\"']/is", "\$num_joblawphp_list = '$num_joblawphp_list'", $configfile);

	$configfile = preg_replace("/[$]num_new_company\s*\=\s*[\"'].*?[\"']/is", "\$num_new_company = '$num_new_company'", $configfile);
	$configfile = preg_replace("/[$]num_new_personal\s*\=\s*[\"'].*?[\"']/is", "\$num_new_personal = '$num_new_personal'", $configfile);
	$configfile = preg_replace("/[$]num_job\s*\=\s*[\"'].*?[\"']/is", "\$num_job = '$num_job'", $configfile);
	$configfile = preg_replace("/[$]num_find\s*\=\s*[\"'].*?[\"']/is", "\$num_find = '$num_find'", $configfile);
	$configfile = preg_replace("/[$]num_comhunter\s*\=\s*[\"'].*?[\"']/is", "\$num_comhunter = '$num_comhunter'", $configfile);
	$configfile = preg_replace("/[$]num_perhunter\s*\=\s*[\"'].*?[\"']/is", "\$num_perhunter = '$num_perhunter'", $configfile);
	$configfile = preg_replace("/[$]num_hunterinfo\s*\=\s*[\"'].*?[\"']/is", "\$num_hunterinfo = '$num_hunterinfo'", $configfile);
	$configfile = preg_replace("/[$]num_putteacher\s*\=\s*[\"'].*?[\"']/is", "\$num_putteacher = '$num_putteacher'", $configfile);
	$configfile = preg_replace("/[$]num_findteacher\s*\=\s*[\"'].*?[\"']/is", "\$num_findteacher = '$num_findteacher'", $configfile);
	$configfile = preg_replace("/[$]num_schools\s*\=\s*[\"'].*?[\"']/is", "\$num_schools = '$num_schools'", $configfile);
	$configfile = preg_replace("/[$]num_lesson\s*\=\s*[\"'].*?[\"']/is", "\$num_lesson = '$num_lesson'", $configfile);

	$configfile = preg_replace("/[$]num_news\s*\=\s*[\"'].*?[\"']/is", "\$num_news = '$num_news'", $configfile);
	$configfile = preg_replace("/[$]num_way\s*\=\s*[\"'].*?[\"']/is", "\$num_way = '$num_way'", $configfile);
	$configfile = preg_replace("/[$]num_law\s*\=\s*[\"'].*?[\"']/is", "\$num_law = '$num_law'", $configfile);

	$configfile = preg_replace("/[$]time_job\s*\=\s*[\"'].*?[\"']/is", "\$time_job = '$time_job'", $configfile);
	$configfile = preg_replace("/[$]time_find\s*\=\s*[\"'].*?[\"']/is", "\$time_find = '$time_find'", $configfile);
	$configfile = preg_replace("/[$]time_hunterjob\s*\=\s*[\"'].*?[\"']/is", "\$time_hunterjob = '$time_hunterjob'", $configfile);
	$configfile = preg_replace("/[$]time_hunterfind\s*\=\s*[\"'].*?[\"']/is", "\$time_hunterfind = '$time_hunterfind'", $configfile);
	$configfile = preg_replace("/[$]time_hunterinfo\s*\=\s*[\"'].*?[\"']/is", "\$time_hunterinfo = '$time_hunterinfo'", $configfile);
	$configfile = preg_replace("/[$]time_lesson\s*\=\s*[\"'].*?[\"']/is", "\$time_lesson = '$time_lesson'", $configfile);
	$configfile = preg_replace("/[$]time_putteacher\s*\=\s*[\"'].*?[\"']/is", "\$time_putteacher = '$time_putteacher'", $configfile);
	$configfile = preg_replace("/[$]time_findteacher\s*\=\s*[\"'].*?[\"']/is", "\$time_findteacher = '$time_findteacher'", $configfile);
	$configfile = preg_replace("/[$]time_news\s*\=\s*[\"'].*?[\"']/is", "\$time_news = '$time_news'", $configfile);
	$configfile = preg_replace("/[$]time_way\s*\=\s*[\"'].*?[\"']/is", "\$time_way = '$time_way'", $configfile);
	$configfile = preg_replace("/[$]time_law\s*\=\s*[\"'].*?[\"']/is", "\$time_law = '$time_law'", $configfile);

	$fp = fopen('../common/system.php', 'w');
    fwrite($fp, trim($configfile));
    fclose($fp);
	echo refreshback('操作成功');
	echo showmsg('config.php?action=count','2');
	echo endhtml();
	echo wwwwanenet();
	exit;
}
else if ($HTTP_POST_VARS['save_template'])
{
	$tplfile=$HTTP_POST_VARS['tplfile'];
	$context=$HTTP_POST_VARS["context"];
	if (!is_writeable($tplfile))	{echo clickback(addslashes($tplfile).'模板 文件没有可写入的权限!');exit;}

	$fp = fopen($tplfile, 'w');
	flock($fp, 3);
	fwrite($fp, stripslashes(str_replace("\x0d\x0a", "\x0a", $context)));
	fclose($fp);
	echo refreshback('操作成功');
	echo showmsg('config.php?action=template&temdir=../'.$tpldir,'2');
	echo endhtml();
	echo wwwwanenet();
	exit;
}
$action=$HTTP_GET_VARS['action'];
?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=config">网站整体管理</a></td>
        <td align="center" background="images/admin_tablebar.gif"><a href="?action=env">系统环境设置</a></td>
        <td align="center" background="images/admin_tablebar.gif"><a href="?action=html">生成 html 页面</a> </td>
        <td align="center" background="images/admin_tablebar.gif"><a href="?action=uploadimg">上传图片水印</a></td>
        <td align="center" background="images/admin_tablebar.gif"><a href="?action=count">页面信息数量管理</a></td>
        <td align="center" background="images/admin_tablebar.gif"><a href="?action=template&temdir=../<?=$tpldir?>">模板管理</a></td>
        </tr>
      <tr>
        <td colspan="6" align="center" bgcolor="#CCCCCC">
		<!-- start config info -->
		<?
			if ($action=='config')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			  <form action="config.php" method="post">
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;<span class="style1">文件检测</span></td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;<?=write_yes('../config.inc.php')?></td>
			  </tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;数据库服务器</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <?=$dbhost?></td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;数据库用户名 \ 密码</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <?=$dbuser.' \ ******'?></td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;数据库名</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <?=$dbname?></td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;数据表前缀</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="tablepre" type="text" class="input" id="tablepre" onClick="alert('修改此项会导致系统无法运行        ')" value="<?=$tablepre?>" size="40">              </td>
				</tr>
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;整合论坛</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
			      <select name="bbstype" id="bbstype">
			        <option value="0" <? if ($bbstype=='0') {echo 'selected';}?>>不使用论坛</option>
					<?
						foreach ($bbsarray as $key=>$val)
						{
							$select_bbs.=($bbstype==$key)	?	"<option value=\"".$key."\" selected>".$val."</option>"	:	"<option value=\"".$key."\">".$val."</option>"	;
						}
						echo $select_bbs;
					?>
		          </select></td>
			    </tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;整合论坛数据表前缀</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="bbspre" type="text" class="input" id="bbspre" value="<?=$bbspre?>" size="40">              </td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;管理员信箱</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="adminemail" type="text" class="input" id="adminemail" value="<?=$adminemail?>" size="40">              </td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;网站名称</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="webtitle" type="text" class="input" id="webtitle" value="<?=$webtitle?>" size="40">              </td>
				</tr>
			  <tr align="center">
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;Cookie 路径 </td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="cookpath" type="text" class="input" id="cookpath" value="<?=$cookpath?>" size="40"></td>
			  </tr>
			  <tr align="center">
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;Cookie 作用域</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="cookdomain" type="text" class="input" id="cookdomain" value="<?=$cookdomain?>" size="40"></td>
			  </tr>
			  <tr align="center">
				<td height="25" colspan="2" bgcolor="#F1F2F4"><input name="save_config" type="submit" class="input" id="save_config" value=" 保 存 ">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="reset" type="button" class="input" id="reset" onClick="javascript:history.go(-1)" value=" 取 消 "></td>
				</tr>
			  </form>
			</table>
			<? }
			else if ($action=='env')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			  <form action="config.php" method="post">
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;<span class="style1">文件检测</span></td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;<?=write_yes('../common/system.php')?></td>
			  </tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;模板路径</td>
				<td align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <input name="tpldir" type="text" class="input" id="tpldir" value="<?=$tpldir?>">              </td>
				</tr>
			  <tr>
				<td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;静态文件模板</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="htmltpldir" type="text" class="input" id="htmltpldir" value="<?=$htmltpldir?>">
				  &nbsp;生成静态文件样式文件</td>
			  </tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;图片路径</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <input name="imgdir" type="text" class="input" id="imgdir" value="<?=$imgdir?>">
				  &nbsp; </td>
				</tr>
			  <tr>
				<td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;静态文件存放</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="htmlroot" type="text" class="input" id="htmlroot" value="<?=$htmlroot?>">
				  &nbsp;生成静态文件存在路径</td>
			  </tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;网站语言</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <input name="charset" type="text" class="input" id="charset" value="<?=$charset?>">              </td>
			  </tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;外表格宽度</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;              <input name="tablewidth" type="text" class="input" id="tablewidth" value="<?=$tablewidth?>">
				  &nbsp;(像素或百分比) </td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
				</tr>
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;最新企业排列</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="shownewcom" type="radio" value="0" <?=checked($shownewcom,'0')?>>
                  最后注册&nbsp;&nbsp;                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="shownewcom" type="radio" value="1" <?=checked($shownewcom,'1')?>>
                  最后更新简历</td>
			    </tr>
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;最新个人排列</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="shownewper" type="radio" value="0" <?=checked($shownewper,'0')?>>
					最后注册&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
					<input name="shownewper" type="radio" value="1" <?=checked($shownewper,'1')?>>
					最后更新简历</td>
			    </tr>
			  <tr>
			    <td colspan="2">&nbsp;</td>
			    </tr>
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;页面广告</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="ad_info" type="radio" value="1" <?=checked($ad_info,'1')?>>
是 &nbsp;&nbsp;&nbsp;&nbsp;
<input name="ad_info" type="radio" value="0" <?=checked($ad_info,'0')?>>
否 </td>
			    </tr>
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;友情链接</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="flink_info" type="radio" value="1" <?=checked($flink_info,'1')?>>
是 &nbsp;&nbsp;&nbsp;&nbsp;
<input name="flink_info" type="radio" value="0" <?=checked($flink_info,'0')?>>
否 </td>
			    </tr>
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;友情链接每行显示数量</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="flink_num_row" type="text" class="input" id="flink_num_row" value="<?=$flink_num_row?>" size="2" maxlength="2"></td>
			    </tr>
			  <tr>
				<td height="25" bgcolor="#F1F2F4">&nbsp; 允许页输出压缩 (Gzip) </td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp; <input name="gzip_info" type="radio" value="1" <?=checked($gzip_info,'1')?>>
	是 &nbsp;&nbsp;&nbsp;&nbsp;
	<input name="gzip_info" type="radio" value="0" <?=checked($gzip_info,'0')?>>
	否 </td>
			  </tr>
			  <tr>
				<td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;程序运行信息</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="process_info" type="radio" value="1" <?=checked($process_info,'1')?>>
	开 &nbsp;&nbsp;&nbsp;&nbsp;
	<input name="process_info" type="radio" value="0" <?=checked($process_info,'0')?>>
	关 </td>
			  </tr>
			  <tr>
				<td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;在线统计信息</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="online_info" type="radio" value="1" <?=checked($online_info,'1')?>>
	开 &nbsp;&nbsp;&nbsp;&nbsp;
	<input name="online_info" type="radio" value="0" <?=checked($online_info,'0')?>>
	关 </td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;在线时长</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="onlinetime" type="text" class="input" id="onlinetime" value="<?=$onlinetime?>" size="10">
				  &nbsp;(秒)&nbsp;&nbsp;<font color="#ff0000">此段时间内没有任何操作,系统认为丢线</font></td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;注册用户邮箱发送密码</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;    <input name="mailreg" type="radio" value="1" <?=checked($mailreg,'1')?>>
	是  &nbsp;&nbsp;&nbsp;&nbsp; <input name="mailreg" type="radio" value="0" <?=checked($mailreg,'0')?>>
	否 </td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;COOKIE 保留方式随浏览器</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="cookieway" type="radio" value="0" <?=checked($cookieway,'0')?>>
	是 &nbsp;&nbsp;&nbsp;&nbsp;
	<input name="cookieway" type="radio" value="1" <?=checked($cookieway,'1')?>>
	否 </td>
				</tr>
			  <tr>
				<td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;COOKIE 保留时长</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="cookietime" type="text" class="input" id="cookietime" value="<?=$cookietime?>" size="10">
	&nbsp;(秒) &nbsp;&nbsp;<font color="#ff0000">COOKIE 随浏览器关闭时有效 , 超过此时间,此用户需重新登陆</font></td>
				</tr>
			  <tr align="center">
			    <td colspan="2" align="left">&nbsp;</td>
			    </tr>
			  <tr align="center">
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;发送招聘时长</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="sendjob_time" type="text" class="input" id="sendjob_time" value="<?=$sendjob_time?>" size="2">
	&nbsp;(时) &nbsp;<font color="#ff0000">&nbsp;向同一人才发表招聘请求需时</font></td>
			  </tr>
			  <tr align="center">
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;发送求职时长</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="sendfind_time" type="text" class="input" id="sendfind_time" value="<?=$sendfind_time?>" size="2">
	&nbsp;(时) &nbsp;<font color="#ff0000">&nbsp;向同一职位发表求职请求需时</font></td>
			  </tr>
			  <tr align="center">
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;发送猎头职位时长</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="sendhunterjob_time" type="text" class="input" id="sendhunterjob_time" value="<?=$sendhunterjob_time?>" size="2">
	&nbsp;(时) &nbsp;<font color="#ff0000">&nbsp;向同一 猎头人才 发表招聘请求需时</font></td>
			  </tr>
			  <tr align="center">
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;发送猎头人才时长</td>
				<td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
				  <input name="sendhunterfind_time" type="text" class="input" id="sendhunterfind_time" value="<?=$sendhunterfind_time?>" size="2">
	&nbsp;(时) &nbsp;<font color="#ff0000">&nbsp;向同一 猎头职位 发表求职请求需时</font></td>
			  </tr>
			  <tr align="center">
				<td height="25" colspan="2" bgcolor="#F1F2F4"><input name="save_env" type="submit" class="input" id="save_config" value=" 保 存 ">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="reset" type="button" class="input" id="reset" onClick="javascript:history.go(-1)" value=" 取 消 "></td>
				</tr>
			  </form>
			</table>
			<? }
			else if ($action=='html')
			{?>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			<form action="config.php" method="post">
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;<span class="style1">文件检测</span></td>
			    <td height="25" align="left" bgcolor="#F1F2F4" colspan="3">&nbsp;&nbsp;<?=write_yes('../common/system.php')?></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;招聘信息</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_job" type="radio" value="1" <?php echo checked($html_job,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="html_job" type="radio" value="0" <?php echo checked($html_job,'0')?>>
					否</td>
			    <td width="20%">&nbsp;&nbsp;默认模板</td>
			    <td width="30%">&nbsp;&nbsp;
			      <input name="default_job" type="text" class="input" id="default_job" value="<?=$default_job?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;求职信息</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_find" type="radio" value="1" <?php echo checked($html_find,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="html_find" type="radio" value="0" <?php echo checked($html_find,'0')?>>
					否</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_find" type="text" class="input" id="default_job" value="<?=$default_find?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;猎头人才</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_perhunter" type="radio" value="1" <?php echo checked($html_perhunter,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="html_perhunter" type="radio" value="0" <?php echo checked($html_perhunter,'0')?>>
					否</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_perhunter" type="text" class="input" id="default_job" value="<?=$default_perhunter?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;猎头职位</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_comhunter" type="radio" value="1" <?php echo checked($html_comhunter,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="html_comhunter" type="radio" value="0" <?php echo checked($html_comhunter,'0')?>>
					否</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_comhunter" type="text" class="input" id="default_job" value="<?=$default_comhunter?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;招聘家教</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_findteacher" type="radio" value="1" <?php echo checked($html_findteacher,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="html_findteacher" type="radio" value="0" <?php echo checked($html_findteacher,'0')?>>
					否</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_findteacher" type="text" class="input" id="default_job" value="<?=$default_findteacher?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;求职家教</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_taketeacher" type="radio" value="1" <?php echo checked($html_taketeacher,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="html_taketeacher" type="radio" value="0" <?php echo checked($html_taketeacher,'0')?>>
					否</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_taketeacher" type="text" class="input" id="default_taketeacher" value="<?=$default_taketeacher?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;猎头资迅</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_hunterinfo" type="radio" value="1" <?php echo checked($html_hunterinfo,'1')?>>
					<font color="#FF0000">是</font></td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_hunterinfo" type="text" class="input" id="default_hunterinfo" value="<?=$default_hunterinfo?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;新闻动态</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_news" type="radio" value="1" <?php echo checked($html_news,'1')?>>
					<font color="#FF0000">是</font>&nbsp;</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_news" type="text" class="input" id="default_news" value="<?=$default_news?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;政策法规</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_law" type="radio" value="1" <?php echo checked($html_law,'1')?>>
					<font color="#FF0000">是</font>&nbsp;&nbsp;</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_law" type="text" class="input" id="default_law" value="<?=$default_law?>" size="30"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="20%" height="25">&nbsp;&nbsp;求职攻略</td>
				<td width="30%" height="25">&nbsp;&nbsp;
				  <input name="html_way" type="radio" value="1" <?php echo checked($html_way,'1')?>>
					<font color="#FF0000">是</font>&nbsp;</td>
			    <td width="20%" height="25">&nbsp;&nbsp;默认模板</td>
			    <td width="30%" height="25">&nbsp;&nbsp;
                  <input name="default_way" type="text" class="input" id="default_way" value="<?=$default_way?>" size="30"></td>
			  </tr>
			  <tr align="center">
			    <td colspan="4" align="left">&nbsp;</td>
			    </tr>
			  <tr align="center">
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;培训学校</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="html_school" type="radio" value="1" <?php echo checked($html_school,'1')?>>
                  <font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="html_school" type="radio" value="0" <?php echo checked($html_school,'0')?>>
否</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;默认模板</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="default_school" type="text" class="input" id="default_school" value="<?=$default_school?>" size="30"></td>
			  </tr>
			  <tr align="center">
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;培训课程</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="html_lesson" type="radio" value="1" <?php echo checked($html_lesson,'1')?>>
                  <font color="#FF0000">是</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="html_lesson" type="radio" value="0" <?php echo checked($html_lesson,'0')?>>
否</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;默认模板</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="default_lesson" type="text" class="input" id="default_lesson" value="<?=$default_lesson?>" size="30"></td>
			  </tr>
			  <tr align="center">
			    <td colspan="4" align="left">&nbsp;</td>
			    </tr>
			  <tr align="center">
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;静态文件存放单位</td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_unit" type="radio" value="Ym" <? if ($dirhtml_unit=='Ym') echo 'checked';?>>
                  <font color="#FF0000">月</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="dirhtml_unit" type="radio" value="Ymd" <? if ($dirhtml_unit=='Ymd') echo 'checked';?>>
                  天
</td>
			    <td height="25" colspan="2" align="left" bgcolor="#F1F2F4"> &nbsp;&nbsp;同一单位,同一栏目文件放置于同一文件夹</td>
			    </tr>
			  <tr align="center">
			    <td colspan="4" align="left">&nbsp;</td>
			    </tr>
			  <tr align="center" bgcolor="#E1E3E8">
			    <td height="25" colspan="4" align="left">&nbsp;&nbsp;各栏目文件放置路径&nbsp;&nbsp;(不同栏目,不可放于同一文件夹)</td>
			    </tr>
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;企业招聘</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
			      <input name="dirhtml_job" type="text" class="input" id="dirhtml_job" value="<?=$dirhtml_job?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;个人求职</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_find" type="text" class="input" id="dirhtml_find" value="<?=$dirhtml_find?>"></td>
			    </tr><!--
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;企业简历</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_com" type="text" class="input" id="dirhtml_com" value="<?=$dirhtml_com?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;个人简历</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_per" type="text" class="input" id="dirhtml_per" value="<?=$dirhtml_per?>"></td>
			  </tr>-->
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;猎头职位</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_comhunter" type="text" class="input" id="dirhtml_comhunter" value="<?=$dirhtml_comhunter?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;猎头人才</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_perhunter" type="text" class="input" id="dirhtml_perhunter" value="<?=$dirhtml_perhunter?>"></td>
			  </tr>
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;招聘家教</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_findteacher" type="text" class="input" id="dirhtml_findteacher" value="<?=$dirhtml_findteacher?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;求职家教</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_taketeacher" type="text" class="input" id="dirhtml_taketeacher" value="<?=$dirhtml_taketeacher?>"></td>
			  </tr>
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;培训学校</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_school" type="text" class="input" id="dirhtml_school" value="<?=$dirhtml_school?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;培训课程</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_lesson" type="text" class="input" id="dirhtml_lesson" value="<?=$dirhtml_lesson?>"></td>
			  </tr>
			  <tr align="left" bgcolor="#E1E3E8">
			    <td height="25" colspan="4">&nbsp;&nbsp;以下栏目,只能生成html</td>
			    </tr>
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;新闻动态</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_news" type="text" class="input" id="dirhtml_news" value="<?=$dirhtml_news?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;政策法规</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_law" type="text" class="input" id="dirhtml_law" value="<?=$dirhtml_law?>"></td>
			  </tr>
			  <tr align="left">
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;求职攻略</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_way" type="text" class="input" id="dirhtml_way" value="<?=$dirhtml_way?>"></td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;猎头资迅</td>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;
                  <input name="dirhtml_hunterinfo" type="text" class="input" id="dirhtml_hunterinfo" value="<?=$dirhtml_hunterinfo?>"></td>
			  </tr>
			  <tr align="center">
				<td height="25" colspan="4" bgcolor="#F1F2F4"><input name="save_html" type="submit" class="input" id="save_config" value=" 保 存 ">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="reset" type="button" class="input" id="reset" onClick="javascript:history.go(-1)" value=" 取 消 "></td>
				</tr>
			  </form>
			  <tr>
			    <td height="25" colspan="4" bgcolor="#F1F2F4"><br><ol><li><font color="#FF0000">红字体</font> : 表示推荐使用，打开些项可以提升系统的负载能力</li><li>是 => 此栏目内容生成 html 静态文件 , 否 => 以静态显示内容页</li><li>打开 生成 html 状态相对的栏目的用户访问权限控制将失效</li><li>默认模板所在路 <?='<font color=\'#ff0000\'>../'.$htmltpldir.'center/</font>'?></li></ol></td>
		      </tr>
			</table>
			<? }
			elseif ($action=='uploadimg')
			{?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
			<form action="config.php" method="post">
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;<span class="style1">文件检测</span></td>
			    <td height="25" align="left" bgcolor="#F1F2F4">&nbsp;&nbsp;<?=write_yes('../common/system.php')?></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;可上传图片类型</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				<input name="phototype" type="text" class="input" id="phototype" value="<?=$phototype?>" size="60"></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;上传图片是否水印</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				<input name="watermark" type="radio" value="1" <?php echo checked($watermark,'1')?>>是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="watermark" type="radio" value="0" <?php echo checked($watermark,'0')?>>否</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;上传图片水印方式</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				<input name="watertype" type="radio" value="1" <?php echo checked($watertype,'1')?>>图片&nbsp;&nbsp;<input name="watertype" type="radio" value="0" <?php echo checked($watertype,'0')?>>文字</td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;水印文字</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				  <input name="waterstring" type="text" class="input" id="waterstring" value="<?=$waterstring?>" size="60"></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;水印图片</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				  <input name="waterimg" type="text" class="input" id="waterimg" value="<?=$waterimg?>" size="60"></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;水印宽度</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				  <input name="water_width" type="text" class="input" id="water_width" value="<?=$water_width?>" size="12"></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td width="30%" height="25" align="left">&nbsp;&nbsp;水印高度</td>
				<td width="70%" align="left">&nbsp;&nbsp;
				  <input name="water_height" type="text" class="input" id="water_height" value="<?=$water_height?>" size="12"></td>
			  </tr>
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="25" align="left">&nbsp;&nbsp;水印位置</td>
				<td height="25" align="left">&nbsp;&nbsp;
				  <input name="water_position" type="radio" value="0" <?php echo checked($water_position,'0')?>>
				  左上角&nbsp;&nbsp;&nbsp;<input name="water_position" type="radio" value="1" <?php echo checked($water_position,'1')?>>
				  右上角&nbsp;&nbsp;&nbsp;<input name="water_position" type="radio" value="2" <?php echo checked($water_position,'2')?>>
				  中间&nbsp;&nbsp;	&nbsp;<input name="water_position" type="radio" value="3" <?php echo checked($water_position,'3')?>>
				  左下角&nbsp;&nbsp;&nbsp;<input name="water_position" type="radio" value="4" <?php echo checked($water_position,'4')?>>
				  右下角</td>
				</tr>
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="25" colspan="2"><input name="save_img" type="submit" class="input" id="save_config" value=" 保 存 ">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="reset" type="button" class="input" id="reset" onClick="javascript:history.go(-1)" value=" 取 消 "></td>
				</tr>
			</form>
			</table>
			<? }
			elseif ($action=='count')
			{?>
				<table width="100%"  border="0" cellspacing="1" cellpadding="0">
                  <form action="config.php" method="post">
			  <tr>
			    <td height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;<span class="style1">文件检测</span></td>
			    <td height="25" align="left" bgcolor="#F1F2F4" colspan="3">&nbsp;&nbsp;<?=write_yes('../common/system.php')?></td>
			  </tr>
                    <tr bgcolor="#E4E7EB">
                      <td width="30%" height="25">&nbsp;&nbsp;<strong>信 息 列 表</strong></td>
                      <td width="20%" align="center">取标题字长</td>
                      <td width="30%" align="center">时间显示样式</td>
                      <td width="20%" height="25" align="center">显示信息数</td>
                    </tr>
                    <tr>
                      <td width="30%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;招 聘 </td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_job" type="text" class="input" id="string_job" value="<?=$string_job?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_job">
                        <option value="m-d" <?=($time_job=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_job=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" align="center" bgcolor="#F1F2F4"><input name="num_job_list" type="text" class="input" id="num_job_list" value="<?=$num_job_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;求 职</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_find" type="text" class="input" id="string_find" value="<?=$string_find?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_find">
                        <option value="m-d" <?=($time_find=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_find=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_find_list" type="text" class="input" id="num_find_list" value="<?=$num_find_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;猎 头 职 位</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_hunterjob" type="text" class="input" id="string_hunterjob" value="<?=$string_hunterjob?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_hunterjob">
                        <option value="m-d" <?=($time_hunterjob=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_hunterjob=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_comhunter_list" type="text" class="input" id="num_comhunter_list" value="<?=$num_comhunter_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;猎 头 人 才 </td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_hunterfind" type="text" class="input" id="string_hunterfind" value="<?=$string_hunterfind?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_hunterfind">
                        <option value="m-d" <?=($time_hunterfind=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_hunterfind=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_perhunter_list" type="text" class="input" id="num_perhunter_list" value="<?=$num_perhunter_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;猎 头 资 迅</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_hunterinfo" type="text" class="input" id="string_hunterinfo" value="<?=$string_hunterinfo?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_hunterinfo">
                        <option value="m-d" <?=($time_hunterinfo=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_hunterinfo=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_hunterinfo_list" type="text" class="input" id="num_hunterinfo_list" value="<?=$num_hunterinfo_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;培 训 学 校</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_school" type="text" class="input" id="string_school" value="<?=$string_school?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_school_list" type="text" class="input" id="num_school_list" value="<?=$num_school_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;培 训 课 程</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_lesson" type="text" class="input" id="string_lesson" value="<?=$string_lesson?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_lesson">
                        <option value="m-d" <?=($time_lesson=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_lesson=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_lesson_list" type="text" class="input" id="num_lesson_list" value="<?=$num_lesson_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;招 聘 家 教</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_teacherjob" type="text" class="input" id="string_teacherjob" value="<?=$string_teacherjob?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_putteacher">
                        <option value="m-d" <?=($time_putteacher=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_putteacher=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_putteach_list" type="text" class="input" id="num_putteach_list" value="<?=$num_putteach_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;求 职 家 教</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_teacherfind" type="text" class="input" id="string_teacherfind" value="<?=$string_teacherfind?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_findteacher">
                        <option value="m-d" <?=($time_findteacher=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_findteacher=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_findteach_list" type="text" class="input" id="num_findteach_list" value="<?=$num_findteach_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;新 闻 动 态</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_news" type="text" class="input" id="string_news" value="<?=$string_news?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_news">
                        <option value="m-d" <?=($time_news=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_news=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_jobnewphp_list" type="text" class="input" id="num_jobnewphp_list" value="<?=$num_jobnewphp_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;求 职 功 略</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_way" type="text" class="input" id="string_way" value="<?=$string_way?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_way">
                        <option value="m-d" <?=($time_way=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_way=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_jobwayphp_list" type="text" class="input" id="num_jobwayphp_list" value="<?=$num_jobwayphp_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;政 策 法 规</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_law" type="text" class="input" id="string_law" value="<?=$string_law?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4"><select name="time_law">
                        <option value="m-d" <?=($time_law=='m-d')?'selected':''?>><?=date('m-d',time())?></option>
                        <option value="Y-n-j" <?=($time_law=='Y-n-j')?'selected':''?>><?=date('Y-n-j',time())?></option>
                      </select></td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_joblawphp_list" type="text" class="input" id="num_joblawphp_list" value="<?=$num_joblawphp_list?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr bgcolor="#E4E7EB">
                      <td height="25" colspan="4">&nbsp;&nbsp;<strong>最 新 信 息</strong></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 企 业 用 户</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_company" type="text" class="input" id="string_company" value="<?=$string_company?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_new_company" type="text" class="input" id="num_new_company" value="<?=$num_new_company?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="20%" height="25" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 个 人 用 户</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="string_personal" type="text" class="input" id="string_personal" value="<?=$string_personal?>" size="4" maxlength="2"></td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_new_personal" type="text" class="input" id="num_new_personal" value="<?=$num_new_personal?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 招 聘</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_job" type="text" class="input" id="num_job" value="<?=$num_job?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 求 职</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_find" type="text" class="input" id="num_find" value="<?=$num_find?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 猎 头 职 位</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_comhunter" type="text" class="input" id="num_comhunter" value="<?=$num_comhunter?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 猎 头 人 才</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_perhunter" type="text" class="input" id="num_perhunter" value="<?=$num_perhunter?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 猎 头 资 迅</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_hunterinfo" type="text" class="input" id="num_hunterinfo" value="<?=$num_hunterinfo?>" size="4" maxlength="2"></td>
                    </tr>

                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 招 聘 家 教</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_putteacher" type="text" class="input" id="num_putteacher" value="<?=$num_putteacher?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 求 职 家 教</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_findteacher" type="text" class="input" id="num_findteacher" value="<?=$num_findteacher?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最新培训学校</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_schools" type="text" class="input" id="num_schools" value="<?=$num_schools?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 课 程</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_lesson" type="text" class="input" id="num_lesson" value="<?=$num_lesson?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 动 态</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_news" type="text" class="input" id="num_news" value="<?=$num_news?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 攻 略</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_way" type="text" class="input" id="num_way" value="<?=$num_way?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" colspan="2" bgcolor="#F1F2F4">&nbsp;&nbsp;最 新 法 规</td>
                      <td width="30%" height="25" align="center" bgcolor="#F1F2F4">&nbsp;</td>
                      <td width="20%" height="25" align="center" bgcolor="#F1F2F4"><input name="num_law" type="text" class="input" id="num_law" value="<?=$num_law?>" size="4" maxlength="2"></td>
                    </tr>
                    <tr align="center">
                      <td height="25" colspan="4" bgcolor="#F1F2F4"><input name="save_num" type="submit" class="input" id="save_num" value=" 保 存 ">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="reset" type="button" class="input" id="reset" onClick="javascript:history.go(-1)" value=" 取 消 "></td>
                    </tr>
                  </form>
		    </table>
				<? }
			else if ($action=='template')
			{
				$urlinfo='../'.str_replace("./","",str_replace("../","",$HTTP_GET_VARS['temdir']));
				if (!is_file($urlinfo) && is_dir($urlinfo))
				{
					$info=$urlinfo.'/';
				?>
			<table width="100%"  border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#E4E7EB">
                <td width="60%" height="25">&nbsp;&nbsp;模板目录</td>
                <td width="20%" height="25" align="center">创建时间</td>
                <td width="10%" height="25" align="center">详情</td>
                <td width="10%" align="center">可写</td>
              </tr>
			  <tr bgcolor="#F1F2F4">
                <td height="25">&nbsp;&nbsp;样式表 ../css/style.css </td>
                <td align="center"><?=date("Y-m-d H:i",filectime('../css/style.css'));?></td>
                <td height="25" align="center">[<a href="config.php?action=template&temdir=../css/style.css">查看</a>]</td>
                <td height="25" align="center"><?=write('../css/style.css')?></td>
			  </tr>
			  <?
				$temdir=$info;
				$d = dir($temdir);
				while ($entry = $d->read())
				{
					if  ($entry!='.' && $entry!='..')
					{?>
					  <tr bgcolor="#F1F2F4">
						<td width="60%" height="25">&nbsp;&nbsp;<? if (is_dir($info.$entry))	{echo '<font color=ff0000><b>['.namedir($entry).']</b></font>';}	else {echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$entry;}?></td>
						<td width="20%" align="center"><? if ($entry!='.' && $entry!='..') echo date("Y-m-d H:i",filemtime($info.$entry));?></td>
						<td width="10%" height="25" align="center"><? if ($entry!='.' && $entry!='..') echo "[<a href=\"config.php?action=template&temdir=".$info.$entry."\">查看</a>]";?></td>
						<td width="10%" height="25" align="center"><? if (is_file($info.$entry)) {echo write($info.$entry);} else {echo '<font color=ff0000>目录</font>';}?></td>
					  </tr>
					<? }
				}
				$d->close();
			  ?>
              <tr bgcolor="#E4E7EB">
                <td width="60%" height="25" colspan="4" align="center"><a href="javascript:history.go(-1)">返 回 上 一 页 </a></td>
              </tr>
            </table>
				<? }
				else
				{
					$filename='../'.str_replace("./","",str_replace("../","",$HTTP_GET_VARS['temdir']));
					$fp = fopen($filename, 'r');
					$ftext = fread($fp, filesize($filename));
					fclose($fp);
				?>
				<table width="100%"  border="0" cellspacing="1" cellpadding="0">
					<form action="config.php" method="post">
					  <tr bgcolor="#F1F2F4">
						<td width="15%" height="25" align="center">模板文件</td>
						<td width="85%" height="25" align="center"><?=$filename?>
						  <input name="tplfile" type="hidden" id="ttplfile" value="<?=$filename?>"></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="15%" height="25" align="center">可写状态</td>
						<td width="85%" height="25" align="center"><?=write($filename);?></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td width="15%" height="25" align="center">模板详情</td>
						<td width="85%" height="25" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center"><textarea name="context" cols="110" rows="10" wrap="VIRTUAL" class="input"><?=htmlspecialchars($ftext);?></textarea></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						</table></td>
					  </tr>
					  <tr bgcolor="#F1F2F4">
						<td height="25" colspan="2" align="center"><input name="save_template" type="submit" class="input" id="submit_template" value=" 保 存 ">
						  &nbsp;&nbsp;&nbsp;&nbsp;
						  <input name="back" type="button" class="input" id="back" value=" 返 回 " onclick="javascript:history.go(-1)"></td>
					  </tr>
					</form>
			</table>
				<? }
			}
			else
			{
				?><?
			}
		?>
		<!-- end config info -->
		</td>
      </tr>
    </table>
  	</td>
    <td align="left" background="images/right_bg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top"><img src="images/left_down.gif" width="18" height="18"></td>
    <td align="center" valign="top" background="images/row_down.gif">&nbsp;</td>
    <td align="left" valign="top"><img src="images/right_down.gif" width="14" height="18"></td>
  </tr>
</table><? echo wwwwanenet();?>
</body>
</html>
