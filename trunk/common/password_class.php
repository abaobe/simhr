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
	class wane_password
	{
		var	$cookieuser		=	''	;
		var	$cookiepass		=	''	;


		function password_dz25($user,$pass)
		{
			global $db,$bbspre;
			$this->cookieuser	=	$user	;
			$this->cookiepass	=	$pass	;
			$db->query("UPDATE {$bbspre}members SET password='$this->cookiepass' where username='$this->cookieuser'");
		}
		function password_dz40($user,$pass)
		{
			global $db,$bbspre;
			$this->cookieuser	=	$user	;
			$this->cookiepass	=	$pass	;
			$db->query("UPDATE {$bbspre}members SET password='$this->cookiepass' where username='$this->cookieuser'");
		}
		/*
		+------------------------------------
		+	start pass with other software
		+------------------------------------
		*/
		function password_wane($user,$pass)
		{
			global $bbstype;
			if ($bbstype)
			{
				$passed	=	'password_'.$bbstype;
				$this->$passed($user,$pass);
			}
			else
			{
				return ture;
			}
		}
		/*
		+------------------------------------
		+	end login with other software
		+------------------------------------
		*/
	}
?>