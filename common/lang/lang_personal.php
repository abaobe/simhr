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
	//+	sex start
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

	//+	minzu start
	for ($numminzu=0;$numminzu<count($lang_minzu);$numminzu++)
	{
		if ($perminzu==$lang_minzu[$numminzu])
		{
			$selectminzu.="<option value=\"".$lang_minzu[$numminzu]."\" selected>".$lang_minzu[$numminzu]."</option>";
		}
		else
		{
			$selectminzu.="<option value=\"".$lang_minzu[$numminzu]."\">".$lang_minzu[$numminzu]."</option>";
		}
	}
	$tpl->set_var("SELECT_MINZU",$selectminzu);
	unset($selectminzu);
	//+	minzu end

	//+	birth start
	for($numyear=1940;$numyear<(date("Y")-14);$numyear++)
	{
		if ($numyear==$peryear)
		{
			$selectyear.="<option value=\"".$numyear."\" selected>".$numyear."</option>";
		}
		else
		{
			$selectyear.="<option value=\"".$numyear."\">".$numyear."</option>";
		}
	}
	$tpl->set_var("SELECT_YEAR",$selectyear);
	unset($selectyear);
	for($nummonth=1;$nummonth<=12;$nummonth++)
	{
		if ($nummonth==$permonth)
		{
			$selectmonth.="<option value=\"".$nummonth."\" selected>".$nummonth."</option>";
		}
		else
		{
			$selectmonth.="<option value=\"".$nummonth."\">".$nummonth."</option>";
		}
	}
	$tpl->set_var("SELECT_MONTH",$selectmonth);
	unset($selectmonth);
	for($numday=1;$numday<=31;$numday++)
	{
		if ($numday==$perday)
		{
			$selectday.="<option value=\"".$numday."\" selected>".$numday."</option>";
		}
		else
		{
			$selectday.="<option value=\"".$numday."\">".$numday."</option>";
		}
	}
	$tpl->set_var("SELECT_DAY",$selectday);
	unset($selectday);
	//+	birth end

	//+	marry	start
	for ($nummarry=0;$nummarry<count($lang_marry);$nummarry++)
	{
		if ($permarry==$lang_marry[$nummarry])
		{
			$selectmarry.="<option value=\"".$lang_marry[$nummarry]."\" selected>".$lang_marry[$nummarry]."</option>";
		}
		else
		{
			$selectmarry.="<option value=\"".$lang_marry[$nummarry]."\">".$lang_marry[$nummarry]."</option>";
		}
	}
	$tpl->set_var('SELECT_MARRY',$selectmarry);
	unset($selectmarry);
	//+	marry	end

	//+	social start
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

	//+	hukou	start
	for ($numhukou=0;$numhukou<count($lang_province);$numhukou++)
	{
		if ($perhukou==$lang_province[$numhukou])
		{
			$selecthukou.="<option value=\"".$lang_province[$numhukou]."\" selected>".$lang_province[$numhukou]."</option>";
		}
		else
		{
			$selecthukou.="<option value=\"".$lang_province[$numhukou]."\">".$lang_province[$numhukou]."</option>";
		}
	}
	$tpl->set_var('SELECT_HUKOU',$selecthukou);
	unset($selecthukou);
	//+	hukou	end

	//+	juzhudi	start
	for ($numjzd=0;$numjzd<count($lang_province);$numjzd++)
	{
		if ($perjuzhudi==$lang_province[$numjzd])
		{
			$selectjzd.="<option value=\"".$lang_province[$numjzd]."\" selected>".$lang_province[$numjzd]."</option>";
		}
		else
		{
			$selectjzd.="<option value=\"".$lang_province[$numjzd]."\">".$lang_province[$numjzd]."</option>";
		}
	}
	$tpl->set_var('SELECT_JZD',$selectjzd);
	unset($selectjzd);
	//+	juzhudi	end


	//+	now juzhudi	start
	for ($numnowjzd=0;$numnowjzd<count($lang_province);$numnowjzd++)
	{
		if ($pernowjuzhudi==$lang_province[$numnowjzd])
		{
			$selectnowjzd.="<option value=\"".$lang_province[$numnowjzd]."\" selected>".$lang_province[$numnowjzd]."</option>";
		}
		else
		{
			$selectnowjzd.="<option value=\"".$lang_province[$numnowjzd]."\">".$lang_province[$numnowjzd]."</option>";
		}
	}
	$tpl->set_var('SELECT_NOWJZD',$selectnowjzd);
	unset($selectnowjzd);
	//+	now juzhudi	end


	//+	work address start
	for ($numworkadd=0;$numworkadd<count($lang_province);$numworkadd++)
	{
		if ($perworkadd==$lang_province[$numworkadd])
		{
			$selectworkadd.="<option value=\"".$lang_province[$numworkadd]."\" selected>".$lang_province[$numworkadd]."</option>";
		}
		else
		{
			$selectworkadd.="<option value=\"".$lang_province[$numworkadd]."\">".$lang_province[$numworkadd]."</option>";
		}
	}
	$tpl->set_var('SELECT_WORKADD',$selectworkadd);
	unset($selectworkadd);
	//+	work address end


	//+	edu	start
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

	//+	job kind start
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
	//+	job kind end

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

	//+	eng kind start
	for ($numeng=0;$numeng<count($lang_job_engkind);$numeng++)
	{
		if ($pereng==$lang_job_engkind[$numeng])
		{
			$selecteng.="<option value=\"".$lang_job_engkind[$numeng]."\" selected>".$lang_job_engkind[$numeng]."</option>";
		}
		else
		{
			$selecteng.="<option value=\"".$lang_job_engkind[$numeng]."\">".$lang_job_engkind[$numeng]."</option>";
		}
	}
	$tpl->set_var("SELECT_ENG",$selecteng);
	unset($selecteng);
	//+	eng kind end

	//+	eng ABLE start
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

	//+	BEGIN INDUSTRY
	for ($numcombelong=0;$numcombelong<count($lang_company_belong);$numcombelong++)
	{
		if ($perindustry==$lang_company_belong[$numcombelong])
		{
			$selectindustry.="<option value=\"".$lang_company_belong[$numcombelong]."\" selected>".$lang_company_belong[$numcombelong]."</option>";
		}
		else
		{
			$selectindustry.="<option value=\"".$lang_company_belong[$numcombelong]."\">".$lang_company_belong[$numcombelong]."</option>";
		}
	}
	$tpl->set_var("SELECT_INDUSTRY",$selectindustry);
	unset($selectindustry);
	//+	END INDUSTRY

	//+	YEAR SALARY
	for ($numyearsalary=0;$numyearsalary<count($lang_yearsalary);$numyearsalary++)
	{
		if ($peryearsalary==$lang_yearsalary[$numyearsalary])
		{
			$selectyearsalary.="<option value=\"".$lang_yearsalary[$numyearsalary]."\" selected>".$lang_yearsalary[$numyearsalary]."</option>";
		}
		else
		{
			$selectyearsalary.="<option value=\"".$lang_yearsalary[$numyearsalary]."\">".$lang_yearsalary[$numyearsalary]."</option>";
		}
	}
	$tpl->set_var("SELECT_YEARSALARY",$selectyearsalary);
	unset($selectyearsalary);
	//+	YEAR SALARY END


	//+	FOR YEAR SALARY
	for ($numforyearsalary=0;$numforyearsalary<count($lang_yearsalary);$numforyearsalary++)
	{
		if ($perforyearsalary==$lang_yearsalary[$numforyearsalary])
		{
			$selectforyearsalary.="<option value=\"".$lang_yearsalary[$numforyearsalary]."\" selected>".$lang_yearsalary[$numforyearsalary]."</option>";
		}
		else
		{
			$selectforyearsalary.="<option value=\"".$lang_yearsalary[$numforyearsalary]."\">".$lang_yearsalary[$numforyearsalary]."</option>";
		}
	}
	$tpl->set_var("SELECT_FORYEARSALARY",$selectforyearsalary);
	unset($selectforyearsalary);
	//+	FOR YEAR SALARY END









?>