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
<title><?=$webtitle;?> - Power by wan-e.net inc !</title>
<script src="../css/check_all.js"></script>
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
<?php
function sizecount($filesize)
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

function sqldumptable($table, $startfrom = 0, $currsize = 0)
{
        $offset = 64;
    if(!$startfrom)
        {
            $tabledump = "DROP TABLE IF EXISTS $table;\n";
                $createtable = mysql_query("SHOW CREATE TABLE $table");
        $create = mysql_fetch_row($createtable);
                $tabledump .= $create[1].";\n\n";
        }
        $tabledumped = 0;
        $numrows = $offset;
    while(($multivol && $currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) || (!$multivol && !$tabledumped))
        {
                $tabledumped = 1;
        if($multivol)
                {
                $limitadd = "LIMIT $startfrom, $offset";
            $startfrom += $offset;
        }
                $rows = mysql_query("SELECT * FROM $table $limitadd");
        $numfields = mysql_num_fields($rows);
        $numrows = mysql_num_rows($rows);
        while ($row = mysql_fetch_row($rows))
                {
                $comma = "";
            $tabledump .= "INSERT INTO $table VALUES(";
            for($i = 0; $i < $numfields; $i++)
                        {
                    $tabledump .= $comma."'".mysql_escape_string($row[$i])."'";
                $comma = ",";
            }
            $tabledump .= ");\n";
        }
    }
    $startrow = $startfrom;
    $tabledump .= "\n";
    return $tabledump;
}

function splitsql($sql)
{
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
    unset($sql);
    foreach($queriesarray as $query)
        {
            $queries = explode("\n", trim($query));
        foreach($queries as $query)
                {
                $ret[$num] .= $query[0] == "#" ? NULL : $query;
        }
        $num++;
    }
    return($ret);
}

function cpheader()
{
    echo "<html><head>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html\"; charset=\"gb2312\">";
}
//+----------	method start

//+----------	method end !











$method=$HTTP_GET_VARS["action"];
if ($method=='backup')
{?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_ldr">
<form name="backup" method="post" action="database.php?action=wwwwanenet">
	<tr align="center">
    	<td height="22" colspan="2" background="images/admin_tablebar.gif"><span class="main_ArticleSubheading">数&nbsp;据&nbsp;备&nbsp;份</span></td>
    </tr>
<?php
        $query=mysql_query("SHOW TABLE STATUS LIKE '$tablepre%'");
        while ($row=mysql_fetch_array($query)        )
        { ?>
    <tr class="header">
    	<td height="25" colspan="2">&nbsp;&nbsp;<?php echo $row["0"];?></td>
        </tr>
    <tr bgcolor="#F1F2F4" >
        <td height="1" colspan="2"  bgcolor="#cccccc"></td>
    </tr>
<?php }
?>
    <tr align="center">
    	<td height="22" colspan="2"  background="images/admin_tablebar.gif">选择目标位置</td>
    </tr>
    <tr bgcolor="#F1F2F4">
   	<td width="50%" height="25">&nbsp;
                  <input type="radio" value="local" name="saveto" onclick="this.form.filename.disabled=this.checked;if(this.form.multivol.checked) {alert('注意：\n\n备份到本地无法使用分卷备份功能。');this.form.multivol.checked=false;this.form.sizelimit.disabled=true;}"> 备份到本地
            <input type="hidden" value="all" name="type">
            </td>
    <td width="50%" height="25"><input type="radio" value="server" checked name="saveto" onClick="this.form.filename.disabled=!this.checked">
备份到服务器 </td>
    </tr>
    <tr bgcolor="#F1F2F4">
                  <td height="1" colspan="2" background="images/row.gif"></td>
    </tr>
    <tr bgcolor="#F1F2F4"><td height="25" colspan="2">&nbsp; &nbsp;
            <input name="filename" type="text" class="input" onClick="alert('注意：\n\n数据文件保存在服务器的可见目录下，其他人有    \n可能下载得到这些文件，这是不安全的。因此请    \n在使用随机文件名的同时，及时删除备份文件。');" value="<?php echo "./backup/wane_".date("Y_m_d_H_i_s",time());?>.sql" size="80"></td>
		</tr>
    <tr align="center" bgcolor="#F1F2F4">
          <td height="30" colspan="2"><input name="submit_backup" type="submit" class="input" id="submit_backup" value=" 备 份 数 据 "></td>
    </tr>
</form>
</table>
<?php }
else if ($method=='recover')
{?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="td_ldr">
<form name="restore" method="post" action="database.php?action=upload" enctype="multipart/form-data">
        <tr align="center" bgcolor="#FFFFFF">
                <td height="22" colspan="3" background="images/admin_tablebar.gif">上 传 备 份 文 件</td>
        </tr>

        <tr bgcolor="#F1F2F4">
            <td width="100" height="25" align="center">上传文件 :</td>
            <td align="center"><input type="file" name="userfile" size="80" class="input"></td>
            <td width="100" height="25" align="center"><input name="submit_upload" type="submit" class="input" id="submit_upload" value=" 上 传 "></td>
        </tr>
        <tr bgcolor="#F1F2F4">
          <td height="1" colspan="3" background="images/row.gif"></td>
    </tr>
</form>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="td_ldr">
<form method="post" action="database.php?action=wwwwanenet">
	<tr align="center" class="header">
    	<td height="22" colspan="4" background="images/admin_tablebar.gif">数 据 备 份 记 录</td>
    </tr>
    <tr align="center" bgcolor="#EEEEEE" class="header">
    	<td width="9%" height="25">删除</td>
        <td height="25">文件名</td>
        <td height="25">尺寸</td>
        <td width="11%" height="25">操作</td>
	</tr>
    <tr align="center">
    	<td height="1" colspan="4" bgcolor="#cccccc"></td>
	</tr>
<?php
	if (is_dir("./backup"))
	{
		$dir = dir('./backup');
        while($entry = $dir->read())
		{
        	$entry = "./backup/$entry";
            if (is_file($entry) && strtolower(strrchr($entry, ".")) == ".sql")
            {?>
	<tr align="center" bgcolor="#F1F2F4" class="header">
    	<td width="9%" height="25"><input name="delete[]" type="checkbox" id="delete[]" value="<?php echo $entry;?>"></td>
        <td height="25"><?php echo "<a href=".$entry.">".$entry."</a>";?></td>
        <td height="25"><?php echo (filesize($entry)/1000)." K";?></td>
        <td width="11%" height="25"><a href="database.php?action=import&from=server&datafile_server=<?php echo $entry ;?>&importsubmit=yes">导入</a></td>
	</tr>
    <tr align="center">
    	<td height="1" colspan="4" bgcolor="#cccccc"></td>
	</tr>
			<?php }
		}
	}
?>
	<tr align="center" bgcolor="#EEEEEE">
		<td height="30"><input name="chkall" type="checkbox" class="main_button" onClick="checkall(this.form)" value="del"></td>
	    <td height="30" colspan="3"><input name="submit_delete" type="submit" class="input" id="submit_delete" value="删除选定备份"></td>
	    </tr>
</form>
</table>
<?php }
else if ($method=='option')
{?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_ldr">
<form name="optimize" method="post" action="database.php?action=wwwwanenet">
	<tr align="center">
		<td colspan="7" align=center height="22" background="images/admin_tablebar.gif">数 据 优 化</td>
    </tr>
	<tr align="center" bgcolor="#F1F2F4">
        <td width="0" height="25">数据表名</td>
        <td width="0">类型</td>
        <td width="0">记录数</td>
        <td width="0">数据</td>
        <td width="0">索引</td>
	    <td width="0">碎片</td>
	    <td width="0">尺寸</td>
	</tr>
	<tr>
		<td colspan="7" align=center height="1" bgcolor="#cccccc"></td>
    </tr>
<?php
    mysql_unbuffered_query("DELETE FROM $table_subscriptions");
    $query = mysql_query("SHOW TABLE STATUS LIKE '$tablepre%'");
    while($table = mysql_fetch_array($query))
    {		?>
	<tr align="center" bgcolor="#F1F2F4">
        <td width="0" height="25"><?php echo $table["Name"];?></td>
        <td width="0"><?php echo $table["Type"] ;?></td>
        <td width="0"><?php echo '<font color=\'#ff0000\'><b>'.$table["Rows"].'</b></font>';?></td>
        <td width="0"><?php echo $table["Data_length"] ;?></td>
        <td width="0"><?php echo $table["Index_length"] ;?></td>
	    <td width="0"><?php echo $table["Data_free"];?></td>
	    <td width="0"><?php echo sizecount($table[Data_length] + $table[Index_length]) ;?></td>
	</tr>
	<tr>
		<td colspan="7" align=center height="1" bgcolor="#cccccc"></td>
    </tr>
		<?php
	        $totalsize += $table[Data_length] + $table[Index_length];
    }
	?>
    <tr bgcolor="#F1F2F4"><td colspan="7" align="right" height="25">共占用数据库：<?php echo sizecount($totalsize);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
		<td colspan="7" align=center height="1" bgcolor="#cccccc"></td>
    </tr>
    <tr align="center" bgcolor="#F1F2F4">
      <td colspan="7" height="25"><input name="submit_option" type="submit" class="input" id="submit_option" value=" 数 据 表 优 化 "></td>
    </tr>
</form>
</table>
<?php }
else if ($method=='update')
{?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_ldr">
<form method="post" action="database.php?action=wwwwanenet">
	<tr>
		<td height="22" colspan=2 align="center" background="images/admin_tablebar.gif"> 数 据 库 升 级</td>
	</tr>
    <tr bgcolor="#ffffff" align="center">
        <td height="25" valign="middle" bgcolor="#F1F2F4">请将数据库升级语句粘贴在下面：</td>
    </tr>
    <tr bgcolor="#ffffff" align="center">
		<td valign="top" bgcolor="#F1F2F4"><textarea cols="88" rows="18" name="queries"></textarea></td>
    </tr>
    <tr bgcolor="#ffffff" align="center">
    	<td height="25" valign="middle" bgcolor="#F1F2F4">注意：为确保升级成功，请不要修改 SQL 语句的任何部分。</td>
    </tr>
    <tr bgcolor="#ffffff" align="center">
    	<td height="35" valign="middle" bgcolor="#F1F2F4"><input name="submit_update" type="submit" class="input" id="submit_update" value="数据库升级"></td>
    </tr>
</form>
</table>
<?php }
else if ($HTTP_GET_VARS["action"]=='wwwwanenet')
{
	//+--------	START DELETE --------------+//
	if ($HTTP_POST_VARS["submit_delete"])
	{
		if(is_array($HTTP_POST_VARS["delete"]))
		{
			foreach($HTTP_POST_VARS["delete"] as $filename)
			{
				$query=unlink($filename);
				if ($query)	{echo "<font color=6699cc>指定备份文件 ".$filename." 成功删除!</font><br>";}
				else {echo "<font color=ff0000>指定备份文件 ".$filename." 删除失败!</font><br>";}
			}
		}
		else
		{
			echo "您没有选择要删除的备份文件，请返回。";
		}
	}
	//+-------------- start backup databases -----------------+//
	if ($HTTP_POST_VARS["submit_backup"])
	{
		$filename=$HTTP_POST_VARS["filename"];
		mysql_query("SET SQL_QUOTE_SHOW_CREATE = 0");
		$sqldump = "";
		$time=date("Y-m-d H:i:s",time());
		$tables = array(
						find_fav,
                        findjob_chance,
                        hunter_com,
                        hunter_info,
						hunter_info_re,
                        hunter_per,
                        index_news,
                        index_news_re,
                        jianli,
                        jianliqy,
                        job_chance,
                        job_fav,
                        job_law,
                        job_law_re,
                        job_peixun,
                        job_peixunkind,
                        job_way,
                        job_way_re,
                        links,
                        member,
                        per_rec,
                        per_send,
                        pxschool,
                        pxschool_kind,
                        send_hunter_com,
                        send_hunter_per,
                        session,
                        teacher_find,
                        teacher_job
                   );
		foreach($tables as $table)
		{
			$sqldump .= sqldumptable($tablepre.$table);
		}
	   $dumpfile = substr($filename, 0, strrpos($filename, "."))."-%s".strrchr($filename, ".");
	   if(trim($sqldump))
	   {
			$dumpversion = strip_tags($version);
			$sqldump = "# Author : SimPHP\n".
                        "#\n".
                        "# wan-e.net Data Dump\n".
                        "# Version: SimHR V2.0 with template\n".
                        "# Time: ".date("Y-m-d H:i:s",time())."\n".
                        "# Tablepre: $tablepre\n".
                        "#\n".
                        "# Copyright &copy; 2004 SimPHP: http://www.php365.cn\n".
                        "# Please visit our website for newest infomation about Space Software!\n".
                        "# 程序设计:付义兵,QQ:39053386,Tel:0553-2237136,E-mail:webmaster@ah0553.com\n".
                        "# ------------------------------------------------------------------------\n\n\n".
                        $sqldump;

			 if($HTTP_POST_VARS["saveto"] == "local")
			 {
				ob_end_clean();
				@header("Content-disposition: filename=wane_".date("Y_m_d_H_i_s").".sql");
				@header("Content-type: unknown/unknown");
				echo $sqldump;
				exit;
			 }
			 elseif($HTTP_POST_VARS["saveto"] == "server")
			 {
				cpheader();
				if($filename != "")
				{
					@$fp = fopen(($multivol ? sprintf($dumpfile, $volume) : $filename), "w");
					@flock($fp, 3);
					if(@!fwrite($fp, $sqldump))
					{
						@fclose($fp);
						echo clickback("数据文件无法保存到服务器，请检查目录属性。");
					}
					elseif($multivol)
					{
						 echo showmsg("database.php?action=export&type=$type&saveto=server&filename=$filename&multivol=1&sizelimit=$sizelimit&volume=$volume&tableid=$tableid&startfrom=$startrow&exportsubmit=yes",'1');exit('分卷备份：数据文件 #$volume 成功创建，程序将自动继续。');
					}
					else
					{
						 echo "数据成功备份至服务器 <a href=\"$filename\">$filename</a> 中。";
					}
				}
				else
				{
					echo clickback("您没有输入备份文件名，请返回修改。");
				}
			}
	   }
	   else
	   {
             cpheader();
             echo clickback("备份出错，数据表没有内容。");
	   }
	}
	//+-------------- start optimize tables -----------------+//
	if ($HTTP_POST_VARS["submit_option"])
	{
		mysql_unbuffered_query("DELETE FROM $table_subscriptions");
		$query = mysql_query("SHOW TABLE STATUS LIKE '$tablepre%'");
		while($table = mysql_fetch_array($query))
        {
			$tablename = ${$table[Name]};
			$query_option=mysql_query("OPTIMIZE TABLE $table[Name]");
			if ($query_option)
			{
				$result=$result."<BR>&nbsp;&nbsp;&nbsp;&nbsp;优化数据表 [ ".$table["Name"]." ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=#6699cc>成功</font><BR>";
			}
			else
			{
				$result=$result."<BR>&nbsp;&nbsp;&nbsp;&nbsp;优化数据表 [ ".$table["Name"]." ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=#ff0000>失败</font><BR>";
			}
		}
		echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='td_ldr'><tr><td height=22  background='images/admin_tablebar.gif' align='center'>数 据 表 优 化 结 果</td></tr><tr><td>".$result."<BR></td></tr></table>";
	}
	//+-------------- start updata tables --------------//
	if ($HTTP_POST_VARS["submit_update"])
	{
		$sqlquery = splitsql(str_replace(" cdb_", " $tablepre", $HTTP_POST_VARS["queries"]));
		foreach($sqlquery as $sql)
		{
			if(trim($sql) != "")
			{
				$query=mysql_query(stripslashes($sql));
				if ($query)
				{
					echo "<font color=6699cc>升级成功!</font>";
				}
				else
				{
					echo "<font color=ff0000>升级失败</font>";
				}
			}
		}
	}
}
	//+------------- start database recover ---------------//
else if ($HTTP_GET_VARS["action"]=='import')
{
	$readerror = 0;
    $datafile = $HTTP_GET_VARS["datafile_server"];
    $datafile_size = @filesize($HTTP_GET_VARS["datafile_server"]);
    $fp = fopen($datafile, "r");
    @flock($fp, 3);
    $sqldump = @fread($fp, $datafile_size);
   	fclose($fp);

    $identify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", substr($sqldump,0, 256))));
    $dumpinfo = array('multivol' => $identify[3], 'volume' => intval($identify[4]));
    $sqlquery = splitsql($sqldump);
    unset($sqldump);
    foreach($sqlquery as $sql)
    {
    	if(trim($sql) != '')
        {
        	$query=mysql_query($sql);
        }
	}
	if ($query)	{$result='数据恢复&nbsp;&nbsp;&nbsp;&nbsp;<font color=6699cc>成功</font>!';}
	else {$result='数据恢复&nbsp;&nbsp;&nbsp;&nbsp;<font color=ff0000>失败</font>';}
	echo $result;
}
else if ($HTTP_GET_VARS["action"]=='upload')
{
	$result=upload_file($HTTP_POST_FILES['userfile']['name'],$HTTP_POST_FILES['userfile']['tmp_name'],'./backup');
	echo $result;
}
else
{
	echo "Access Denied";exit;
}
?>
	</td>
	<td align="left" background="images/right_bg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top"><img src="images/left_down.gif" width="18" height="18"></td>
    <td align="center" valign="top" background="images/row_down.gif">&nbsp;</td>
    <td align="left" valign="top"><img src="images/right_down.gif" width="14" height="18"></td>
  </tr>
</table>
</html>
<?php echo wwwwanenet();?>