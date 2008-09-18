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
	|   > Date started: 2004/12/6
	+--------------------------------------------------------------------------
	*/
	$tpl->set_var('SEX_MALE',$lang_ssex[0]);
	$tpl->set_var('SEX_FEMALE',$lang_ssex[1]);

	for ($num_province=0;$num_province<count($lang_province);$num_province++) //+ provinces list
	{
		$province_info.='<option value='.$lang_province[$num_province].'>'.$lang_province[$num_province].'</option>';
	}
	$tpl->set_var('PROVINCES',$province_info);
	unset($province_info);

	for ($num_minzu=0;$num_minzu<count($lang_minzu);$num_minzu++) //+ minzu list
	{
		$minzu_info.='<option value='.$lang_minzu[$num_minzu].'>'.$lang_minzu[$num_minzu].'</option>';
	}
	$tpl->set_var('MINZUS',$minzu_info);
	unset($minzu_info);

	for ($num_marry=0;$num_marry<count($lang_marry);$num_marry++) //+ marry list
	{
		$marry_info.='<option value='.$lang_marry[$num_marry].'>'.$lang_marry[$num_marry].'</option>';
	}
	$tpl->set_var('MARRYS',$marry_info);
	unset($marry_info);

	for ($num_social=0;$num_social<count($lang_social);$num_social++) //+ social list
	{
		$social_info.='<option value='.$lang_social[$num_social].'>'.$lang_social[$num_social].'</option>';
	}
	$tpl->set_var('SOCIALS',$social_info);
	unset($social_info);

	for ($num_com_kind=0;$num_com_kind<count($lang_company_kind);$num_com_kind++) //+ company kind list
	{
		$com_kind_info.='<option value='.$lang_company_kind[$num_com_kind].'>'.$lang_company_kind[$num_com_kind].'</option>';
	}
	$tpl->set_var('COM_KIND',$com_kind_info);
	unset($com_kind_info);

	for ($num_com_belong=0;$num_com_belong<count($lang_company_belong);$num_com_belong++) //+ company kind list
	{
		$com_belong_info.='<option value='.$lang_company_belong[$num_com_belong].'>'.$lang_company_belong[$num_com_belong].'</option>';
	}
	$tpl->set_var('COM_BELONG',$com_belong_info);
	unset($com_belong_info);

	for ($num_com_space=0;$num_com_space<count($lang_company_space);$num_com_space++) //+ company kind list
	{
		$com_space_info.='<option value='.$lang_company_space[$num_com_space].'>'.$lang_company_space[$num_com_space].'</option>';
	}
	$tpl->set_var('COM_SPACE',$com_space_info);
	unset($com_space_info);
?>