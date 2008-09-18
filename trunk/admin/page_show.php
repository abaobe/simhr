<?php
	$p=$page-1;
	$pp=$page+1;
	$showpage="<table border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#bfbebe\" align=\"center\">
			<tr class=\"pagekind\" align=\"center\" height=\"18\">
				<td align=\"center\" bgcolor=\"#6699cc\">&nbsp;<font color=\"#ffffff\"><strong>Pages:</strong></font>&nbsp;</td>
				<td align=\"center\" bgcolor=\"#f8f8f8\">&nbsp;<font color=\"#666666\">".$pagenum."</font>&nbsp;</td>
				<td align=\"center\" bgcolor=\"#6699cc\">&nbsp;<font color=\"#ffffff\">".$page."/".$pages."</font>&nbsp;</td>";
	if ($p>"5")
	{
		$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=1&".$str2."><<</a>&nbsp;</td>";
	}

	if ($p>"1")
	{
		$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$p."&".$str2."><</a>&nbsp;</td>";
	}

	if ($pages<='10')
	{
		for ($i=1;$i<=$pages;$i++)
		{
			if ($i<>$page)
			{
				$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$i."&".$str2.">$i</a>&nbsp;</td>";
			}
			else
			{
				$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<font color=#ff0000>".$i."</font>&nbsp;</td>";
			}
		}
	}
	else
	{
		if ($page<='5')
		{
			for ($i=1;$i<=10;$i++)
			{
				if ($i<>$page)
				{
					$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$i."&".$str2.">$i</a>&nbsp;</td>";
				}
				else
				{
					$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<font color=#ff0000>".$i."</font>&nbsp;</td>";
				}
			}
		}
		else
		{
			if (($page+4)<=$pages)
			{
				for ($i=($page-5);$i<=($page+4);$i++)
				{
					if ($i<>$page)
					{
						$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$i."&".$str2.">".$i."</a>&nbsp;</td>";
					}
					else
					{
						$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<font color=#ff0000>".$i."</font>&nbsp;</td>";
					}
				}
			}
			else
			{
				for ($i=($pages-10);$i<=$pages;$i++)
				{
					if ($i<>$page)
					{
						$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$i."&".$str2.">".$i."</a>&nbsp;</td>";
					}
					else
					{
						$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<font color=#ff0000>".$i."</font>&nbsp;</td>";
					}
				}
			}
		}
	}

	$ppnext=$pages-$pp;
	if ($ppnext>4)
	{
		$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$pp."&".$str2.">></a>&nbsp;</td>";
	}

	if ($ppnext>3)
	{
		$showpage.="<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;<a href=?page=".$pages."&".$str2.">>></a>&nbsp;</td>";
	}
	$showpage.="</tr></table>";
	echo $showpage;
?>