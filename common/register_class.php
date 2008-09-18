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
	|   > Last	modify	2004-12-21	02:44
	+-------------------------------------------
	*/
	class wane_register
	{
		/*
		+------------------------------------
		+	'dz25'	=>	'Discuz!2.5',
		+	'dz40'	=>	'Discuz!4.0.x',
		+
		+	'pw20'	=>	'phpwind2.0',
		+	'pw21'	=>	'phpwind2.1',
		+
		+	'ip13'	=>	'IPB1.3',
		+	'ip20'	=>	'IPB2.0',
		+
		+	'pb208'	=>	'PHPBB2.0.8',
		+	'pb210'	=>	'PHPBB2.1.0',
		+
		+	'vbb23'	=>	'VBB2.3.4',
		+	'vbb30'	=>	'VBB3.0',
		+
		+	......
		+------------------------------------
		*/
		var	$username	=	'';
		var	$userkind	=	0;
		var	$password	=	'';
		var	$email		=	'';
		var	$question	=	'';
		var	$answer		=	'';

		/*
		+------------------------------------
		+	start register discuz! 2.5
		+------------------------------------
		*/
		function register_dz25()
		{
			global $db,$bbspre,$registerinfo;
			$this->username		=	$registerinfo[user]		;
			$this->password		=	$registerinfo[pass]		;

			$this->userkind		=	'10'					;	//	CHANGE BY YOUR BBS CONFIG

			$this->email		=	$registerinfo[email]	;

			if (!$db->num($db->query("select username from {$bbspre}members where username='".$this->username."'")))
			{
				$db->query("INSERT INTO {$bbspre}members
					(username,password,adminid, groupid, regip, regdate, lastvisit, lastactivity,email,timeoffset)
					VALUES
					('".$this->username."','".$this->password."','0', '".$this->userkind."', '".getenv("REMOTE_ADDR")."', '".time()."', '".time()."', '".time()."','".$this->email."','8')");

			}
			else
			{
				return false;
			}
		}

		/*
		+------------------------------------
		+	start register discuz! 4.0
		+------------------------------------
		*/
		function register_dz40()
		{
			global $db,$bbspre,$registerinfo;
			$this->username		=	$registerinfo[user]	;
			$this->password		=	$registerinfo[pass]	;

			$this->userkind		=	'10'				;	//	CHANGE BY YOUR BBS CONFIG

			$this->email		=	$email				;

			if (!$db->num($db->query("select username from {$bbspre}members where username='".$this->username."'")))
			{
				$db->query("INSERT INTO {$bbspre}members
					(username,password,groupid,regip,regdate,email,timeoffset)
					VALUES
					('".$this->username."','".$this->password."','10','".getenv("REMOTE_ADDR")."','".time()."','".$this->email."','8')");
				$uid = $db->query_id();
				$db->query("INSERT INTO {$bbspre}memberfields (uid, site, icq) VALUES ('$uid', '$site', '$icq')");
			}
		}

		/*
		+------------------------------------
		+	start register wane software
		+------------------------------------
		*/
		function register_wane()
		{
			global $bbstype;
			if ($bbstype)
			{
				$regisered	=	'register_'.$bbstype;
				$this->$regisered();
			}
			else
			{
				return true;
			}
		}
		/*
		+------------------------------------
		+	end register with other software
		+------------------------------------
		*/
	}
?>