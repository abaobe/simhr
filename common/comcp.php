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
	|   > Date started: 2004/10/10
	+--------------------------------------------------------------------------
	*/

	if(!defined("IN_SIMHR")) { exit("You Make a mistake on page of <font color=\"#ff0000\"><i>".basename($HTTP_SERVER_VARS['PHP_SELF']).'</i></font><BR><BR>Please Visit : <a href=\'http://www.php365.cn\' target=\'_blank\'>http://www.php365.cn</a>');}
	$cookie_array=explode(",",$HTTP_COOKIE_VARS[wane_display]);
	$check_array=array('c1','c2','c3','c4');
	foreach ($check_array as $val)
	{
		in_array($val,$cookie_array)	?	${'checked_'.$val}=array('show_'.$val=>'none','hidden_'.$val=>'show')	:	${'checked_'.$val}=array('show_'.$val=>'show','hidden_'.$val=>'none');
	}

	$companycontrol="
<div style=\"display:".$checked_c1[hidden_c1]."\" id=\"fc_c1\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c1',0);\" title=\"显示详情\">".$lang_companycontrol[0]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>

<div style=\"display:".$checked_c1[show_c1]."\" id=\"ff_c1\">
<div class=\"maintitle\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c1',1);\" title=\"隐藏详情\">".$lang_companycontrol[0]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\">
	<table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=basicinfo\">".$lang_companycontrol[1]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=myphoto\">".$lang_companycontrol[2]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"view.php?action=company&info=".urlencode($HTTP_COOKIE_VARS['wwwwanenet_user'])."\" target=\"_blank\">".$lang_companycontrol[3]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=registerschool\">".$lang_companycontrol[4]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=manageschool\">".$lang_companycontrol[5]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"company.php?action=closeschool\">".$lang_companycontrol[6]."</a></td>
      </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>











<div style=\"display:".$checked_c2[hidden_c2]."\" id=\"fc_c2\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c2',0);\" title=\"显示详情\">".$lang_companycontrol[7]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>

<div style=\"display:".$checked_c2[show_c2]."\" id=\"ff_c2\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c2',1)\" title=\"隐藏详情\">".$lang_companycontrol[7]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=puthunter\">".$lang_companycontrol[8]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=managehunter\">".$lang_companycontrol[9]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=putpeixun\">".$lang_companycontrol[10]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=managepeixun\">".$lang_companycontrol[11]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=putjob\">".$lang_companycontrol[12]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=managejob\">".$lang_companycontrol[13]."</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>













<div style=\"display:".$checked_c3[hidden_c3]."\" id=\"fc_c3\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c3',0);\" title=\"显示详情\">".$lang_companycontrol[16]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>

<div style=\"display:".$checked_c3[show_c3]."\" id=\"ff_c3\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c3',1);\" title=\"隐藏详情\">".$lang_companycontrol[16]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=hunterreciver\">".$lang_companycontrol[17]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
		<tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=huntersend\">".$lang_companycontrol[24]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
		<tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=hunterfavourite\">".$lang_companycontrol[25]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=reciver\">".$lang_companycontrol[18]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=send\">".$lang_companycontrol[19]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=favourite\">".$lang_companycontrol[20]."</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>
















<div style=\"display:".$checked_c4[hidden_c4]."\" id=\"fc_c4\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c4',0);\" title=\"显示详情\">".$lang_companycontrol[21]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>

<div style=\"display:".$checked_c4[show_c4]."\" id=\"ff_c4\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('c4',1);\" title=\"隐藏详情\">".$lang_companycontrol[21]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td height=\"25\">&nbsp;&nbsp;☆&nbsp;&nbsp;<a href=\"?action=chpwd\">".$lang_companycontrol[22]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;☆&nbsp;&nbsp;<a href=\"login.php?action=loginout\">".$lang_companycontrol[23]."</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>";
$tpl->set_var('COMCP',$companycontrol);
unset($companycontrol);
?>