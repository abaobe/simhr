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
	|   > Date started: 2004/11/10
	+--------------------------------------------------------------------------
	*/

	if(!defined("IN_SIMHR")) { exit("You Make a mistake on page of <font color=\"#ff0000\"><i>".basename($HTTP_SERVER_VARS['PHP_SELF']).'</i></font><BR><BR>Please Visit : <a href=\'http://www.php365.cn\' target=\'_blank\'>http://www.php365.cn</a>');}
	class wanedb
	{
		var $querynum = 0;
		function connect()
		{
			global $dbserver,$dbuser,$dbpass,$dbname,$pconnect;
			if($pconnect)
			{
				if(!@mysql_pconnect($dbserver, $dbuser, $dbpass))
				{
					$this->sql_halt('Can not connect to MySQL server');
				}
			}
			else
			{
				if(!@mysql_connect($dbserver, $dbuser, $dbpass))
				{
					$this->sql_halt('Can not connect to MySQL server');
				}
			}
			if (!mysql_select_db($dbname))	{$this->sql_halt('Can not select Database');}
            $this->query("set names utf8");
		}

		function row($query, $result_type = MYSQL_ASSOC)
		{
			return mysql_fetch_array($query, $result_type);
		}
		function rows($query)
		{
			return mysql_fetch_row($query);
		}

		function query($sql, $silence = 0)
		{
			$query = mysql_query($sql);
			if(!$query && !$silence)
			{
				$this->sql_halt('MySQL Query Error', $sql);
			}
			$this->querynum++;
			return $query;
		}

		function affect_row()
		{
			return mysql_affected_rows();
		}

		function error()
		{
			return mysql_error();
		}

		function escape($string)
		{
			return mysql_escape_string($string);
		}

		function errno()
		{
			return mysql_errno();
		}

		function result($query, $row)
		{
			$query = mysql_result($query, $row);
			return $query;
		}

		function num($query)
		{
			$query = mysql_num_rows($query);
			return $query;
		}

		function num_fields($query)
		{
			return mysql_num_fields($query);
		}

		function free_result($query)
		{
			return mysql_free_result($query);
		}

		function query_id()
		{
			$id = mysql_insert_id();
			return $id;
		}

		function fetch_row($query)
		{
			$query = mysql_fetch_row($query);
			return $query;
		}

		function close()
		{
			return mysql_close();
		}

		function sql_halt($message = '', $sql = '')
		{
			$sqlfile = './common/mysql_class_error.php';
			if (file_exists($sqlfile))	{$sqlfile=$sqlfile;}
			else	{$sqlfile='../'.$sqlfile;}
			require $sqlfile;
		}
	}
?>