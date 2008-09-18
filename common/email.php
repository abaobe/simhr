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
	|   > Last modify: 2004-12-31	06:47
	+-------------------------------------------
	*/

	if(!defined("IN_SIMHR"))
	{
		exit("Error : access denied for email.php");
	}
	class	WANE_MAIL
	{
		var	$to			=	"";
		var	$from		=	"";
		var	$subject	=	"";
		var	$copyright	=	"\n\n\n\n/*\n+------------------------------------------------------------\n+	Powered by php365.cn inc (c) 2007-2008 SimPHP . \n+	Website	:	http://www.php365.cn \n+------------------------------------------------------------\n*/\n";

		function mail_send_1($to,$subject,$message,$from)
		{
			mail($to, $subject, $message, "From: $from\r\nBcc: $to");
		}
		function mail_send_2($to,$subject,$message,$from)
		{
			exit('Access Denied');
		}
		function mail_send_3($to,$subject,$message,$from)
		{
			exit('Access Denied');
		}
		function wane_mail_send($to,$subject,$message,$sendfrom='')
		{
			global $mail_kind,$adminemail,$webtitle;

			$this->to=$to;
			$this->from=!$sendfrom	?	$webtitle	:	$sendfrom;
			$this->subject = str_replace("\r", '', str_replace("\n", '', $subject));
			$message.=$this->copyright;
			error_reporting(0);
			$mailfunciton='mail_send_'.$mail_kind;
			$this->$mailfunciton($this->to,$this->subject,$message,$this->from);
		}
	}
?>