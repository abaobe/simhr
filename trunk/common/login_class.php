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
	class wane_login
	{
		var	$cookieuser		=	''	;
		var	$cookiepass		=	''	;
		var	$cookietime		=	''	;
		var	$cookiepath		=	''	;
		var	$cookiedomain	=	''	;

		var	$loginout		=	0	;
		var	$sessid			=	''	;

		/*
		+------------------------------------
		+	login discuz 2.5
		+------------------------------------
		*/
		function login_dz25($out)
		{
			global $db,$userinfo,$cookpath,$cookdomain,$cookieway,$cookietime,$bbspre;

			$this->cookieuser		=	$userinfo[user]	;
			$this->cookiepass		=	$userinfo[pass]	;
			$this->cookiepath		=	$cookpath		;
			$this->cookiedomain		=	$cookdomain		;
			$this->loginout			=	$out			;

			$this->cookietime		=	!$cookieway	?	'0'		:	($this->loginout	?	time()-$cookietime	:	time()+$cookietime)		;

			if (!$GLOBALS[HTTP_COOKIE_VARS][sid])
			{
				$this->sessid	=	substr(md5(rand('100001','999999')),0,6);
				setcookie('sid',$this->sessid,$this->cookietime,$this->cookiepath,$this->cookiedomain);
			}
			else
			{
				$this->sessid	=	$GLOBALS[HTTP_COOKIE_VARS][sid]	;
			}
			if ($this->loginout)
			{
				setcookie('_discuz_uid','',$this->cookietime,$this->cookiepath,$this->cookiedomain);
				setcookie('_discuz_pw','',$this->cookietime,$this->cookiepath,$this->cookiedomain);
				$db->query("UPDATE {$bbspre}sessions SET  uid='',username='', groupid='' WHERE sid='$this->sessid'");
			}
			else
			{
				$row=$db->row($db->query("select * from {$bbspre}members where username='$this->cookieuser' and password='$this->cookiepass'"));
				$db->query("DELETE FROM {$bbspre}sessions WHERE sid='$this->sessid'");
				$db->query("INSERT INTO {$bbspre}sessions (sid,uid,username,groupid,lastactivity) VALUES ('$this->sessid','$row[uid]','$this->cookieuser','$row[groupid]','".time()."')");
				setcookie('_discuz_uid'	,	$row[uid]	,$this->cookietime,$this->cookiepath,$this->cookiedomain);
				setcookie('_discuz_pw'	,	$this->cookiepass	,$this->cookietime,$this->cookiepath,$this->cookiedomain);
			}
		}

		/*
		+------------------------------------
		+	start login with other software
		+------------------------------------
		*/
		function login_wane($out=0)
		{
			global $bbstype;
			if ($bbstype)
			{
				$logined	=	'login_'.$bbstype;
				$this->$logined($out);
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