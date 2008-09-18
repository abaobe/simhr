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
	//+	company	propertion	start
	for ($numcompro=0;$numcompro<count($lang_company_kind);$numcompro++)
	{
		if ($compropertion==$lang_company_kind[$numcompro])
		{
			$selectcompro.="<option value=\"".$lang_company_kind[$numcompro]."\" selected>".$lang_company_kind[$numcompro]."</option>";
		}
		else
		{
			$selectcompro.="<option value=\"".$lang_company_kind[$numcompro]."\">".$lang_company_kind[$numcompro]."</option>";
		}
	}
	$tpl->set_var("SELECT_COMPRO",$selectcompro);
	unset($selectcompro);
	//+	company propertion	end

	//+	company	belong	start
	for ($numcombelong=0;$numcombelong<count($lang_company_belong);$numcombelong++)
	{
		if ($combelong==$lang_company_belong[$numcombelong])
		{
			$selectcombelong.="<option value=\"".$lang_company_belong[$numcombelong]."\" selected>".$lang_company_belong[$numcombelong]."</option>";
		}
		else
		{
			$selectcombelong.="<option value=\"".$lang_company_belong[$numcombelong]."\">".$lang_company_belong[$numcombelong]."</option>";
		}
	}
	$tpl->set_var("SELECT_COMBELONG",$selectcombelong);
	unset($selectcombelong);
	//+	company belong	end

	//+	company	space	start
	for ($numcomspace=0;$numcomspace<count($lang_company_space);$numcomspace++)
	{
		if ($comspace==$lang_company_space[$numcomspace])
		{
			$selectcomspace.="<option value=\"".$lang_company_space[$numcomspace]."\" selected>".$lang_company_space[$numcomspace]."</option>";
		}
		else
		{
			$selectcomspace.="<option value=\"".$lang_company_space[$numcomspace]."\">".$lang_company_space[$numcomspace]."</option>";
		}
	}
	$tpl->set_var("SELECT_COMSPACE",$selectcomspace);
	unset($selectcomspace);
	//+	company space	end

	//+	social start
	$selectsocial="<option value=\"".$lang_unset."\">".$lang_unset."</option>";
	for ($numsocial=0;$numsocial<count($lang_social);$numsocial++)
	{
		if ($persocial==$lang_social[$numsocial])
		{
			$selectsocial.="<option value=\"".$lang_social[$numsocial]."\" selected>".$lang_social[$numsocial]."</option>";
		}
		else
		{
			$selectsocial.="<option value=\"".$lang_social[$numsocial]."\">".$lang_social[$numsocial]."</option>";
		}
	}
	$tpl->set_var('SELECT_SOCIAL',$selectsocial);
	unset($selectsocial);
	//+	social end

	//+	edu	start
	$selectedu="<option value=\"".$lang_unset."\">".$lang_unset."</option>";
	for($numedu=0;$numedu<count($lang_edu);$numedu++)
	{
		if ($peredu==$lang_edu[$numedu])
		{
			$selectedu.="<option value=\"".$lang_edu[$numedu]."\" selected>".$lang_edu[$numedu]."</option>";
		}
		else
		{
			$selectedu.="<option value=\"".$lang_edu[$numedu]."\">".$lang_edu[$numedu]."</option>";
		}
	}
	$tpl->set_var('SELECT_EDU',$selectedu);
	unset($selectedu);
	//+	edu	end

	$selectjobpro="<option value=\"".$lang_unset."\">".$lang_unset."</option>";
	for ($numjobpro=0;$numjobpro<count($lang_job_kind);$numjobpro++)
	{
		if ($perjobpro==$lang_job_kind[$numjobpro])
		{
			$selectjobpro.="<option value=\"".$lang_job_kind[$numjobpro]."\" selected>".$lang_job_kind[$numjobpro]."</option>";
		}
		else
		{
			$selectjobpro.="<option value=\"".$lang_job_kind[$numjobpro]."\">".$lang_job_kind[$numjobpro]."</option>";
		}
	}
	$tpl->set_var('SELECT_JOBPRO',$selectjobpro);
	unset($selectjobpro);

	//+	job price start
	for ($numjobprice=0;$numjobprice<count($lang_job_price);$numjobprice++)
	{
		if ($perprice==$lang_job_price[$numjobprice])
		{
			$selectprice.="<option value=\"".$lang_job_price[$numjobprice]."\" selected>".$lang_job_price[$numjobprice]."</option>";
		}
		else
		{
			$selectprice.="<option value=\"".$lang_job_price[$numjobprice]."\">".$lang_job_price[$numjobprice]."</option>";
		}
	}
	$tpl->set_var("SELECT_JOBPRICE",$selectprice);
	unset($selectprice);
	//+	job price end

	//+	eng ABLE start
	$selectengable="<option value=\"".$lang_unset."\">".$lang_unset."</option>";
	for ($numengable=0;$numengable<count($lang_job_engable);$numengable++)
	{
		if ($perengable==$lang_job_engable[$numengable])
		{
			$selectengable.="<option value=\"".$lang_job_engable[$numengable]."\" selected>".$lang_job_engable[$numengable]."</option>";
		}
		else
		{
			$selectengable.="<option value=\"".$lang_job_engable[$numengable]."\">".$lang_job_engable[$numengable]."</option>";
		}
	}
	$tpl->set_var("SELECT_ENGABLE",$selectengable);
	unset($selectengable);
	//+	eng ABLE end

	//+	sex start
	$selectsex="<option value=\"".$lang_unset."\">".$lang_unset."</option>";
	for ($numsex='0';$numsex<count($lang_ssex);$numsex++)
	{
		if ($persex==$lang_ssex[$numsex])
		{
			$selectsex.="<option value=\"".$lang_ssex[$numsex]."\" selected>".$lang_ssex[$numsex]."</option>";
		}
		else
		{
			$selectsex.="<option value=\"".$lang_ssex[$numsex]."\">".$lang_ssex[$numsex]."</option>";
		}
	}
	$tpl->set_var("SELECT_SEX",$selectsex);
	unset($selectsex);
	//+	sex	end

	//+	job age start
	$selectjobage="<option value=\"".$lang_unset."\">".$lang_unset."</option>";
	for ($numjobage=0;$numjobage<count($lang_job_age);$numjobage++)
	{
		if ($perjobage==$lang_job_age[$numjobage])
		{
			$selectjobage.="<option value=\"".$lang_job_age[$numjobage]."\" selected>".$lang_job_age[$numjobage]."</option>";
		}
		else
		{
			$selectjobage.="<option value=\"".$lang_job_age[$numjobage]."\">".$lang_job_age[$numjobage]."</option>";
		}
	}
	$tpl->set_var("SELECT_JOBAGE",$selectjobage);
	unset($selectjobage);
	//+	job age end

?>