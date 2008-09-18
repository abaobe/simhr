<?php
	require "admin_globals.php";
	require "admin_check.php";
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
		switch ($action)
		{
			case	'jobtype'		:	update_cache('jobtype','1');break;
			case	'job'			:	update_cache('job','1');break;
			case	'find'			:	update_cache('find','1');break;

			case	'hunterjob'		:	update_cache('hunterjob','1');break;
			case	'hunterfind'	:	update_cache('hunterfind','1');break;
			case	'hunterinfo'	:	update_cache('hunterinfo','1');break;

			case	'school'		:	update_cache('school','1');break;
			case	'schools'		:	update_cache('schools','1');break;
			case	'lesson'		:	update_cache('lesson','1');break;
			case	'lessons'		:	update_cache('lessons','1');break;

			case	'teacherjob'	:	update_cache('teacherjob','1');break;
			case	'teacherfind'	:	update_cache('teacherfind','1');break;

			case	'companys'		:	update_cache('companys','1');break;
			case	'personals'		:	update_cache('personals','1');break;

			case	'news'			:	update_cache('news','1');break;
			case	'way'			:	update_cache('way','1');break;
			case	'law'			:	update_cache('law','1');break;

			case	'freelink'		:	update_cache('freelink','1');break;
			case	'ad'			:	update_cache('ad','1');break;
			case	'count'			:	update_cache('count','1');break;

			case	'cache_all'		:	update_cache('cache_all','1');break;
		}
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
      <tr>
        <td height="22" align="center" background="images/admin_tablebar.gif">系 统 缓 存 管 理</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">

          <tr bgcolor="#E9EAED">
            <td width="20%" height="25" align="center">缓存类型</td>
            <td width="40%" height="25" align="center">最后更新</td>
            <td width="40%" align="center">操作</td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">职位分类</td>
            <td height="25" align="center"><?=cache_time('cache_jobtype.php','1')?></td>
            <td align="center"><a href="?action=jobtype">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">最新招聘</td>
            <td height="25" align="center"><?=cache_time('cache_job.php','1')?></td>
            <td align="center"><a href="?action=job">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">最新求职</td>
            <td height="25" align="center"><?=cache_time('cache_find.php','1')?></td>
            <td align="center"><a href="?action=find">更新缓存</a></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td colspan="3" align="center">&nbsp;</td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">猎头职位</td>
            <td height="25" align="center"><?=cache_time('cache_hunterjob.php','1')?></td>
            <td align="center"><a href="?action=hunterjob">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">猎头人才</td>
            <td height="25" align="center"><?=cache_time('cache_hunterfind.php','1')?></td>
            <td align="center"><a href="?action=hunterfind">更新缓存</a></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">猎头资迅</td>
            <td height="25" align="center"><?=cache_time('cache_hunterinfo.php','1')?></td>
            <td height="25" align="center"><a href="?action=hunterinfo">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td colspan="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">培训学校分类</td>
            <td height="25" align="center"><?=cache_time('cache_school.php','1')?></td>
            <td align="center"><a href="?action=school">更新缓存</a></td>
          </tr>

          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">培训学校</td>
            <td height="25" align="center"><?=cache_time('cache_schools.php','1')?></td>
            <td align="center"><a href="?action=schools">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">培训课程分类</td>
            <td height="25" align="center"><?=cache_time('cache_lesson.php','1')?></td>
            <td align="center"><a href="?action=lesson">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">培训课程</td>
            <td height="25" align="center"><?=cache_time('cache_lessons.php','1')?></td>
            <td align="center"><a href="?action=lessons">更新缓存</a></td>
          </tr>



          <tr bgcolor="#FFFFFF">
            <td colspan="3" align="center" height="10"></td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">最新招聘家教</td>
            <td height="25" align="center"><?=cache_time('cache_teacherjob.php','1')?></td>
            <td align="center"><a href="?action=teacherjob">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">最新求职家教</td>
            <td height="25" align="center"><?=cache_time('cache_teacherfind.php','1')?></td>
            <td align="center"><a href="?action=teacherfind">更新缓存</a></td>
          </tr>



          <tr bgcolor="#FFFFFF">
            <td colspan="3" align="center" height="10"></td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">最新企业</td>
            <td height="25" align="center"><?=cache_time('cache_companys.php','1')?></td>
            <td align="center"><a href="?action=companys">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">最新个人</td>
            <td height="25" align="center"><?=cache_time('cache_personals.php','1')?></td>
            <td align="center"><a href="?action=personals">更新缓存</a></td>
          </tr>



          <tr bgcolor="#F1F2F4">
            <td colspan="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">新闻动态</td>
            <td height="25" align="center"><?=cache_time('cache_news.php','1')?></td>
            <td align="center"><a href="?action=news">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">求职攻略</td>
            <td height="25" align="center"><?=cache_time('cache_way.php','1')?></td>
            <td align="center"><a href="?action=way">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">政策法规</td>
            <td height="25" align="center"><?=cache_time('cache_law.php','1')?></td>
            <td align="center"><a href="?action=law">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">猎头迅信</td>
            <td height="25" align="center"><?=cache_time('cache_hunterinfo.php','1')?></td>
            <td align="center"><a href="?action=hunterinfo">更新缓存</a></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td colspan="3" align="center" height="10"></td>
            </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">信息统计</td>
            <td height="25" align="center"><?=cache_time('cache_count.php','1')?></td>
            <td align="center"><a href="?action=count">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">友情链接</td>
            <td height="25" align="center"><?=cache_time('cache_freelink.php','1')?></td>
            <td align="center"><a href="?action=freelink">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="25" align="center">广告位</td>
            <td height="25" align="center"><?=cache_time('cache_ad.php','1')?></td>
            <td align="center"><a href="?action=ad">更新缓存</a></td>
          </tr>
          <tr bgcolor="#F1F2F4">
            <td height="35" colspan="3" align="center" bgcolor="#FFFFFF"><a href="?action=cache_all">更新全部缓存</a></td>
            </tr>


        </table></td>
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
</table>
</body>
</html>
