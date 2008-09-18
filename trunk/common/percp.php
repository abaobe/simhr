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
	$check_array=array('p1','p2','p3','p4');
	foreach ($check_array as $val)
	{
		in_array($val,$cookie_array)	?	${'checked_'.$val}=array('show_'.$val=>'none','hidden_'.$val=>'show')	:	${'checked_'.$val}=array('show_'.$val=>'show','hidden_'.$val=>'none');
	}


	$personalcontrol=
"
<div style=\"display:".$checked_p1[hidden_p1]."\" id=\"fc_p1\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p1',0);\" title=\"显示详情\">".$lang_personalcontrol[0]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>

<div style=\"display:".$checked_p1[show_p1]."\" id=\"ff_p1\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p1',1);\" title=\"隐藏详情\">".$lang_personalcontrol[0]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=basicinfo\">".$lang_personalcontrol[1]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=perinfo\">".$lang_personalcontrol[2]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=contactinfo\">".$lang_personalcontrol[3]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=forjob\">".$lang_personalcontrol[4]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=otherinfo\">".$lang_personalcontrol[5]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"?action=myphoto\">".$lang_personalcontrol[6]."</a></td>
      </tr>
      <tr>
        <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
      </tr>
	  <tr>
        <td height=\"25\">&nbsp;&nbsp;◎&nbsp;&nbsp;<a href=\"view.php?action=personal&info=".urlencode($HTTP_COOKIE_VARS['wwwwanenet_user'])."\" target=\"_blank\">".$lang_personalcontrol[7]."</a></td>
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















<div style=\"display:".$checked_p2[hidden_p2]."\" id=\"fc_p2\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p2',0);\" title=\"显示详情\">".$lang_personalcontrol[8]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>


<div style=\"display:".$checked_p2[show_p2]."\" id=\"ff_p2\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p2',1);\" title=\"隐藏详情\">".$lang_personalcontrol[8]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=putfind\">".$lang_personalcontrol[9]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=managefind\">".$lang_personalcontrol[10]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=puthunter\">".$lang_personalcontrol[11]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=managehunter\">".$lang_personalcontrol[12]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=teacher\">".$lang_personalcontrol[13]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;◇&nbsp;&nbsp;<a href=\"?action=findteacher\">".$lang_personalcontrol[14]."</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>













<div style=\"display:".$checked_p3[hidden_p3]."\" id=\"fc_p3\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p3',0);\" title=\"显示详情\">".$lang_personalcontrol[15]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>





<div style=\"display:".$checked_p3[show_p3]."\" id=\"ff_p3\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p3',1);\" title=\"隐藏详情\">".$lang_personalcontrol[15]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=hunterreciver\">".$lang_personalcontrol[16]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
		<tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=huntersend\">".$lang_personalcontrol[23]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
		<tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=hunterfavourite\">".$lang_personalcontrol[24]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=reciver\">".$lang_personalcontrol[17]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=send\">".$lang_personalcontrol[18]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;□&nbsp;&nbsp;<a href=\"?action=favourite\">".$lang_personalcontrol[19]."</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>








<div style=\"display:".$checked_p4[hidden_p4]."\" id=\"fc_p4\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p4',0);\" title=\"显示详情\">".$lang_personalcontrol[20]."</a></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>
</div>
</div>


<div style=\"display:".$checked_p4[show_p4]."\" id=\"ff_p4\">
<div class=\"maintitlecollapse\">
<table width=\"188\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"188\" height=\"37\" align=\"center\" background=\"".$imgdir."small_top.gif\"><a href=\"javascript:hidden_show('p4',1);\" title=\"隐藏详情\">".$lang_personalcontrol[20]."</a></td>
  </tr>
  <tr>
    <td background=\"".$imgdir."small_bg.gif\"><table width=\"130\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td height=\"25\">&nbsp;&nbsp;☆&nbsp;&nbsp;<a href=\"?action=chpwd\">".$lang_personalcontrol[21]."</a></td>
        </tr>
        <tr>
          <td height=\"1\" background=\"".$imgdir."row.gif\"></td>
        </tr>
        <tr>
          <td height=\"25\">&nbsp;&nbsp;☆&nbsp;&nbsp;<a href=\"login.php?action=loginout\">".$lang_personalcontrol[22]."</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src=\"".$imgdir."small_down.gif\" width=\"188\" height=\"11\"></td>
  </tr>
</table>";
$tpl->set_var('PERCP',$personalcontrol);
unset($personalcontrol);
?>