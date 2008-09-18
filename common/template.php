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
	class Template
	{
		var $classname = "Template";
		var $debug     = false;
		var $file  = array();
		var $root   = "";
		var $varkeys = array();
		var $varvals = array();
		var $unknowns = "remove";
		var $halt_on_error  = "yes";
		var $last_error     = "";

		function Template($root = ".", $unknowns = "remove")
		{
			$this->set_root($root);
			$this->set_unknowns($unknowns);
		}

		function set_root($root)
		{
			if (!is_dir($root))
			{
				$this->halt(" Directory<font color=\"#ff0000\"><b> $root</b></font> is not true");
				return false;
			}
			$this->root = $root;
			return true;
		}

		function set_unknowns($unknowns = "keep")
		{
			$this->unknowns = $unknowns;
		}

		function set_file($handle, $filename = "")
		{
			if (!is_array($handle))
			{
				if ($filename == "")
				{
					$this->halt(" <font color=\"#ff0000\"><b>There is no file defined to handle</b></font> $handle");
					return false;
				}
				$this->file[$handle] = $this->filename($filename);
			}
			else
			{
				reset($handle);
				while(list($h, $f) = each($handle))
				{
					$this->file[$h] = $this->filename($f);
				}
			}
		}

		function set_block($parent, $handle, $name = "")
		{
			if (!$this->loadfile($parent))
			{
				$this->halt(" <font color=\"#ff0000\"><b>Unable to load defined block </b></font> $parent.");
				return false;
			}
			if ($name == "")
			$name = $handle;

			$str = $this->get_var($parent);
			$reg = "/<!--\s+BEGIN $handle\s+-->(.*)\n\s*<!--\s+END $handle\s+-->/sm";
			preg_match_all($reg, $str, $m);
			$str = preg_replace($reg, "{" . "$name}", $str);
			$this->set_var($handle, $m[1][0]);
			$this->set_var($parent, $str);
		}


		function set_var($varname, $value = "")
		{
			if (!is_array($varname))
			{
				if (!empty($varname))
				if ($this->debug) print " set *$varname* to *$value*<br>\n";
				$this->varkeys[$varname] = "/".$this->varname($varname)."/";
				$this->varvals[$varname] = $value;
			}
			else
			{
				reset($varname);
				while(list($k, $v) = each($varname))
				{
					if (!empty($k))
					if ($this->debug) print " set *$k* to *$v*<br>\n";
					$this->varkeys[$k] = "/".$this->varname($k)."/";
					$this->varvals[$k] = $v;
				}
			}
		}

		function subst($handle)
		{
			if (!$this->loadfile($handle))
			{
				$this->halt(" <font color=\"#ff0000\"><b>Unable to load $handle</b></font>");
				return false;
			}

			$str = $this->get_var($handle);
			$str = @preg_replace($this->varkeys, $this->varvals, $str);
			return $str;
		}

		function psubst($handle)
		{
			print $this->subst($handle);

			return false;
		}


		function parse($target, $handle, $append = false)
		{
			if (!is_array($handle))
			{
				$str = $this->subst($handle);
				if ($append)
				{
					$this->set_var($target, $this->get_var($target) . $str);
				}
				else
				{
					$this->set_var($target, $str);
				}
			}
			else
			{
				reset($handle);
				while(list($i, $h) = each($handle))
				{
					$str = $this->subst($h);
					$this->set_var($target, $str);
				}
			}

			return $str;
		}

		function pparse($target, $handle, $append = false)
		{
			print $this->parse($target, $handle, $append);
			return false;
		}


		function get_vars()
		{
			reset($this->varkeys);
			while(list($k, $v) = each($this->varkeys))
			{
				$result[$k] = $this->varvals[$k];
			}

			return $result;
		}


		function get_var($varname)
		{
			if (!is_array($varname))
			{
				return $this->varvals[$varname];
			}
			else
			{
				reset($varname);
				while(list($k, $v) = each($varname))
				{
					$result[$k] = $this->varvals[$k];
				}
				return $result;
			}
		}


		function get_undefined($handle)
		{
			if (!$this->loadfile($handle))
			{
				$this->halt(" <font color=\"#ff0000\"><b>Unable to load $handle</b></font>");
				return false;
			}

			preg_match_all("/\{([^}]+)\}/", $this->get_var($handle), $m);
			$m = $m[1];
			if (!is_array($m))
			return false;

			reset($m);
			while(list($k, $v) = each($m))
			{
				if (!isset($this->varkeys[$v]))
				$result[$v] = $v;
			}

			if (count($result))
				return $result;
			else
				return false;
		}


		function finish($str)
		{
			switch ($this->unknowns)
			{
				case "keep":break;
				case "remove":$str = preg_replace('/{[^ \t\r\n}]+}/', "", $str);break;
				case "comment":$str = preg_replace('/{([^ \t\r\n}]+)}/', "<!-- Template $handle: Variable \\1 undefined -->", $str);break;
			}
			return $str;
		}


		function p($varname)
		{
			print $this->finish($this->get_var($varname));
		}

		function get($varname)
		{
			return $this->finish($this->get_var($varname));
		}


		function filename($filename)
		{
			if (substr($filename, 0, 1) != "/")
			{
				$filename = $this->root."/".$filename;
			}

			if (!file_exists($filename))
			$this->halt(" File <font color=\"#ff0000\"><b>$filename</b></font> does not exist.");

			return $filename;
		}


		function varname($varname)
		{
			return preg_quote("{".$varname."}");
		}

		function loadfile($handle)
		{
			if (isset($this->varkeys[$handle]) and !empty($this->varvals[$handle]))
			return true;

			if (!isset($this->file[$handle]))
			{
				$this->halt(" <font color=\"#ff0000\"><b>$handle</b></font> is not a valid handle.");
				return false;
			}
			$filename = $this->file[$handle];

			@$str = implode("", file($filename));
			if (empty($str))
			{
				$this->halt(" While loading $handle, <font color=\"#ff0000\"><b>$filename does not exist or is empty</b></font>");
				return false;
			}

			$this->set_var($handle, $str);

			return true;
		}

		function halt($msg)
		{
			//$this->last_error = $msg;

			//if ($this->halt_on_error != "no")
			$this->haltmsg($msg);

			exit;
			//if ($this->halt_on_error == "yes") die ("<b>Halted.</b>");
			return false;
		}

		function haltmsg($msg)
		{
			$htmlmsg="<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<title>Wane Info  :  Template Error - Powered by SimPHP</title>
			<style type=\"text/css\">
			<!--
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			body,td,th {
				font-size: 12px;
				color: #999999;
			}
			.tdbg {
				border-top-width: 1px;
				border-right-width: 1px;
				border-bottom-width: 1px;
				border-left-width: 1px;
				border-top-style: solid;
				border-right-style: solid;
				border-bottom-style: solid;
				border-left-style: solid;
				border-top-color: #CCCCCC;
				border-right-color: #CCCCCC;
				border-bottom-color: #CCCCCC;
				border-left-color: #CCCCCC;
			}
			-->
			</style>
			</head>
			<body>
			<table width=\"100%\" height=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			  <tr>
				<td align=\"center\" valign=\"middle\">
				<table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tdbg\">
				  <tr>
					<td align=\"center\" bgcolor=\"#f8f8f8\"><table width=\"95%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>
						<td height=\"5\"></td>
					  </tr>
					  <tr>
						<td height=\"30\">WANE INFO &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;Template Error  </td>
					  </tr>
					  <tr>
						<td>".nl2br($msg)."</td>
					  </tr>
					  <tr>
						<td height=\"10\"></td>
					  </tr>
					</table></td>
				  </tr>
				</table>
				</td>
			  </tr>
			</table>
			</body>
			</html>";
			print($htmlmsg);
		}
	}
?>