<?php
	require "admin_globals.php";
	require "admin_check.php";
	if ($backup)
	{
		if ($delete=='')	{echo clickback('您没有选择任何数据表');exit;}
		else if ($submit_backup)
		{
			ob_end_clean();
			$comma=$table="";
			foreach($delete as $tabs)
			{
				$table.="$comma$tabs";
				$comma=",";
			}

			@ini_set('max_execution_time','0');
			$tables=explode(',',$table);
			header("Content-disposition: filename=wane_".date("YmdHis").".sql");
			header("Content-type: unknown/unknown");

			$datas="";
			foreach ($tables as $table)
			{
				backup_database($table);
			}
			exit;
		}
		elseif ($submit_optim)
		{
			echo '<table width=\'500\' align=\'center\'>';
			foreach ($delete as $table)
			{
				$query=$db->query("OPTIMIZE TABLE $table");
				if ($query){echo '<tr height=\'25\'><td>成功优化 '.$table.'</td></tr>';}
				else{echo '<tr height=\'25\'><td><font color=\'#ff0000\'>优化失败 '.$table.'</font></td></tr>';}
			}
			echo '</table>'.endhtml();
			exit;
		}
		elseif ($submit_repair)
		{
			echo '<table width=\'500\' align=\'center\'>';
			foreach ($delete as $table)
			{
				$query=$db->query("REPAIR TABLE $table");
				if ($query){echo '<tr height=\'25\'><td>成功修复 '.$table.'</td></tr>';}
				else{echo '<tr height=\'25\'><td><font color=\'#ff0000\'><b>修复失败 '.$table.'</b></font></td></tr>';}
			}
			echo '</table>'.endhtml();
			exit;
		}
		else
		{
			echo clickback('非法操作');exit;
		}
	}
?>
<html>
<head>
<link href="images/style.css" rel="stylesheet" type="text/css">
<script src="../css/check_all.js"></script>
</head>
<body>
<table width="778"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18" height="16" align="right" valign="bottom"><img src="images/left_top.gif" width="18" height="16"></td>
    <td align="center" valign="bottom" background="images/row_top.gif"></td>
    <td width="14" align="left" valign="bottom"><img src="images/right_top.gif" width="14" height="16"></td>
  </tr>
  <tr>
    <td align="right" background="images/left_bg.gif">&nbsp;</td>
    <td align="center" valign="middle" background="images/main_bg.gif">
	<?
		if ($submit_update)
		{
			$sql=trim($sql);
			echo '<table width=\'500\' align=\'center\'><tr><td>';
			echo install_database($sql);
			echo '</td></tr></table>';
			echo endhtml();
			exit;
		}
		elseif ($submit_delete)
		{
			if ($delete == '') {echo clickback('没有选择删除对象');exit;}
			else
			{
				foreach ($delete as $sqlfile)
				{
					delete_file('./'.str_replace("","../",str_replace("../","",$sqlfile)));
				}
			}
			echo refreshback('操作成功');
			echo endhtml();
			echo wwwwanenet();
			echo showmsg('database.php?action=recover','1');
			exit;
		}
		elseif ($action=='insert')
		{
			$source	=	'./'.str_replace("./","",str_replace("../","",$source));
			if (!file_exists($source))
			{
				echo clickback('备份文件不存在');exit;
			}
			else
			{
				$fp	=	fopen ($source,'r');
				$sql	=	fread($fp,filesize($source));
				fclose($fp);
				echo '<table width=\'500\' align=\'center\'><tr><td>';
				echo install_database($sql);
				echo '</td></tr></table>';
				echo endhtml();
				exit;
			}
		}
		elseif ($action=='backup')
		{?>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
		  <tr>
			<td height="22" align="center" background="images/admin_tablebar.gif"><a href="?action=backup">备份当前数据表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?action=backup&type=all">备份全部数据表</a></td>
		  </tr>
		  <tr>
			<td align="center" bgcolor="#CCCCCC">
			<?
				$show_tables=!$type	?	" LIKE '$tablepre%'"	:	"";
				$query=$db->query("SHOW TABLE STATUS $show_tables")
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Top_tdbgall">
			  <FORM action="database.php" method="post">
			  <tr bgcolor="#F1F2F4">
				<td align="left">&nbsp;&nbsp;数据表名称</td>
				<td width="100" align="center">尺寸</td>
				<td width="49" align="center">数据</td>
				<td width="50" align="center">碎片</td>
				<td width="100" align="center">备份表</td>
			  </tr>
			  <?
				while ($row=$db->row($query,MYSQL_BOTH))
				{
					$tables+=1;
					$data_space+=($row[Data_length] + $row[Index_length]);
					$data_rows+=$row[3];
					$data_frees+=$row[Data_free];
				?>
				  <tr bgcolor="#F1F2F4">
					<td>&nbsp;&nbsp;<?=$row[0]?></td>
					<td align="center"><?=data_size($row[Data_length] + $row[Index_length])?></td>
					<td align="center"><?=$row[3]?></td>
					<td align="center"><?=$row[Data_free]?></td>
					<td align="center"><input type="checkbox" name="delete[]" value="<?=$row[0]?>"></td>
				  </tr>
				<? }
			  ?>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="left">&nbsp;&nbsp;<b><font color='#ff0000'>共有数据表 <?=$tables?></font></b></td>
				<td height="25" align="center"><?='<b><font color=\'#ff0000\'>'.data_size($data_space).'</font></b>'?></td>
				<td height="25" align="center"><?='<b><font color=\'#ff0000\'>'.$data_rows.'</font></b>'?></td>
				<td height="25" align="center"><?='<b><font color=\'#ff0000\'>'.$data_frees.'</font></b>'?></td>
				<td align="center">全选<input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="left">&nbsp;&nbsp;
				  <input name="backup" type="hidden" id="backup" value="1"></td>
				<td height="25" align="center"><input name="submit_backup" type="submit" id="submit_backup" value="备份"></td>
				<td height="25" colspan="2" align="center"><input name="submit_repair" type="submit" id="submit_repair" value="修复"></td>
				<td align="center"><input name="submit_optim" type="submit" id="submit_optim" value="优化"></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="left" colspan="5">&nbsp;&nbsp;		      </td>
			  </tr>
			  </FORM>
			</table></td>
		  </tr>
		</table>
		<? }
		elseif ($action=='recover')
		{?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
          <tr>
            <td height="22" align="center" background="images/admin_tablebar.gif">数据恢复</td>
          </tr>
          <tr>
            <td align="center" bgcolor="#CCCCCC">

			<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
			<form action="database.php" method="post">
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="25" colspan="5" align="left">&nbsp;&nbsp;<font color="#ff0000">为安全起见,请通过 FTP 将备份文件传至 ./admin/backup/ 目录下! 恢复结束之后立即删除</font></td>
			  </tr>
			  <tr bgcolor="#F1F2F4">
				<td width="5%" height="25" align="center">编号</td>
			    <td height="25" align="center">文件名</td>
			    <td align="center">数据空间</td>
			    <td width="8%" height="25" align="center">操作</td>
			    <td width="8%" height="25" align="center">删除</td>
			  </tr>
			  <?
			  	$dirname	=	'./backup/';
			  	if (!is_dir($dirname))
				{
					echo clickback('./admin/backup/ 文件夹不存在');exit;
				}
				else
				{
					$dir = dir($dirname);
					$num	=	0;
					while($entry = $dir->read())
					{
						$entry = "./backup/$entry";
						if (is_file($entry) && strtolower(strrchr($entry, ".")) == ".sql")
						{
							$num+=1;
						?>
						  <tr bgcolor="#F1F2F4">
							<td height="25" align="center"><?=$num?></td>
							<td height="25" align="center"><?=$entry?></td>
							<td height="25" align="center"><?=data_size(filesize($entry))?></td>
							<td height="25" align="center"><a href="database.php?action=insert&source=<?=$entry?>">恢复</a></td>
							<td height="25" align="center"><input type="checkbox" name="delete[]" value="<?=$entry?>"></td>
						  </tr>
						<? }
					}
				}
			  ?>

			  <tr bgcolor="#F1F2F4">
			    <td height="25" align="center">&nbsp;</td>
			    <td height="25" colspan="2" align="center">&nbsp;</td>
			    <td height="25" align="center"><input name="submit_delete" type="submit" id="submit_delete" value="删除"></td>
			    <td height="25" align="center"><input name="chkall" type="checkbox" class="main_button" onclick="checkall(this.form)" value="del"></td>
			    </tr>
			</form>
			</table>

			</td>
          </tr>
        </table>
		<? }
		elseif ($action=='update')
		{?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="lrd">
          <tr>
            <td height="22" align="center" background="images/admin_tablebar.gif">数据表升级</td>
          </tr>
          <tr>
            <td align="center" bgcolor="#CCCCCC">

			<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
			<form action="database.php" method="post">
			  <tr align="center" bgcolor="#F1F2F4">
				<td height="280"><textarea name="sql" cols="80" rows="18" wrap="VIRTUAL" id="sql">  Please enter sql info ...</textarea></td>
				</tr>
			  <tr bgcolor="#F1F2F4">
				<td height="25" align="center"><input name="submit_update" type="submit" id="submit_update" value=" 立 即 升 级  "></td>
				</tr>
			</form>
			</table>

			</td>
          </tr>
        </table>
      <? }
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
</body>
</html>
