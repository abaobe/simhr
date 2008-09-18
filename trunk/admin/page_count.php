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
	$psize=$count;
	if ($sstr!='' && $sstr!='0')
	{
		 $pagesql="select $sstr from $table where $str";
	}
	elseif ($str=="0")
	{
		 $pagesql="select * from $table";
	}
	else
	{
		 $pagesql="select * from $table where $str";
	}
	$pageresult=$db->query($pagesql);
	$pagenum=$db->num($pageresult);
	$pages=intval($pagenum/$psize);
	if($pagenum%$psize) $pages++;

	if($page=='' || $page<1)
	{
        $page=1;
        $offset=0;
	}
	elseif($page>=$pages)
	{
        $page=$pages;
        $offset=($pages-1)*$psize;
	}
	else
	{
		$offset=$page*$psize-$psize;
	}
?>