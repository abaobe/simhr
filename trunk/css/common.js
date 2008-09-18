/*
+-------------------------------------------
|   Technology of SimPHP
|   ========================================
|   Powered by SimPHP 
|   (c) 2004 wane.net Power Services
|   http://www.php365.cn
|   ========================================
|   Web: http://www.php365.cn
+-------------------------------------------
|   > Date started: 2004/12/24
+-------------------------------------------
*/	

var uagent    = navigator.userAgent.toLowerCase();
var is_safari = ( (uagent.indexOf('safari') != -1) || (navigator.vendor == "Apple Computer, Inc.") );
var is_ie     = ( (uagent.indexOf('msie') != -1) && (!is_opera) && (!is_safari) && (!is_webtv) );
var is_ie4    = ( (is_ie) && (uagent.indexOf("msie 4.") != -1) );
var is_moz    = (navigator.product == 'Gecko');
var is_ns     = ( (uagent.indexOf('compatible') == -1) && (uagent.indexOf('mozilla') != -1) && (!is_opera) && (!is_webtv) && (!is_safari) );
var is_ns4    = ( (is_ns) && (parseInt(navigator.appVersion) == 4) );
var is_opera  = (uagent.indexOf('opera') != -1);
var is_kon    = (uagent.indexOf('konqueror') != -1);
var is_webtv  = (uagent.indexOf('webtv') != -1);
var is_win    =  ( (uagent.indexOf("win") != -1) || (uagent.indexOf("16bit") !=- 1) );
var is_mac    = ( (uagent.indexOf("mac") != -1) || (navigator.vendor == "Apple Computer, Inc.") );
var ua_vers   = parseInt(navigator.appVersion);
var wane_cookie_id = "";
var wane_cookie_domain = "";
var wane_cookie_path   = "/";

function we_getcookie( name )
{
	cname = wane_cookie_id + name + '=';
	cpos  = document.cookie.indexOf( cname );
	
	if ( cpos != -1 )
	{
		cstart = cpos + cname.length;
		cend   = document.cookie.indexOf(";", cstart);
		
		if (cend == -1)
		{
			cend = document.cookie.length;
		}
		
		return unescape( document.cookie.substring(cstart, cend) );
	}
	
	return null;
}

function we_setcookie( name, value, sticky )
{
	expire = "";
	domain = "";
	path   = "/";
	
	if ( sticky )
	{
		expire = "; expires=Thu, 31 Dec 2015 23:59:59 GMT";
	}
	
	if ( wane_cookie_domain != "" )
	{
		domain = '; domain=' + wane_cookie_domain;
	}
	
	if ( wane_cookie_path != "" )
	{
		path = wane_cookie_path;
	}
	
	document.cookie = wane_cookie_id + name + "=" + value + "; path=" + path + expire + domain + ';';
}

function ShowHide(id1, id2)
{
	if (id1 != '') show_hidden_menu(id1);
	if (id2 != '') show_hidden_menu(id2);
}
	
function we_getbyid(id)
{
	itm = null;
	
	if (document.getElementById)
	{
		itm = document.getElementById(id);
	}
	else if (document.all)
	{
		itm = document.all[id];
	}
	else if (document.layers)
	{
		itm = document.layers[id];
	}
	
	return itm;
}

function show_hidden_menu(id)
{
	if ( ! id ) return;
	
	if ( itm = we_getbyid(id) )
	{
		if (itm.style.display == "none")
		{
			we_show_div(itm);
		}
		else
		{
			we_hidden_div(itm);
		}
	}
}

function we_hidden_div(itm)
{
	if ( ! itm ) return;
	
	itm.style.display = "none";
}

function we_show_div(itm)
{
	if ( ! itm ) return;
	
	itm.style.display = "";
}

function hidden_show( fid, add )
{
	saved = new Array();
	clean = new Array();
	if ( tmp = we_getcookie('wane_display') )
	{
		saved = tmp.split(",");
	}
	for( i = 0 ; i < saved.length; i++ )
	{
		if ( saved[i] != fid && saved[i] != "" )
		{
			clean[clean.length] = saved[i];
		}
	}
	if ( add )
	{
		clean[ clean.length ] = fid;
		we_show_div( we_getbyid( 'fc_'+fid  ) );
		we_hidden_div( we_getbyid( 'ff_'+fid  ) );
	}
	else
	{
		we_show_div( we_getbyid( 'ff_'+fid  ) );
		we_hidden_div( we_getbyid( 'fc_'+fid  ) );
	}
	we_setcookie( 'wane_display', clean.join(','), 1 );
}
