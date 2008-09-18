
var link_help = "插入超级链接\n\n插入一个超级连接。\n例如：\n[url]http://www.mydomain.com[/url]\n[url=http://www.mydomain.com]我的网站[/url]";
var link_normal = "请输入链接显示的文字，如果留空则直接显示链接。";
var link_normal_input = "请输入 URL。";
var image_help = "插入图像\n\n在文本中插入一幅图像。\n例如：[img]http://www.domain.com/images/logo.gif[/img]";
var image_normal = "请输入图像的 URL。";
function AddText(NewCode) 
{
	if(document.all)
	{
		insertAtCaret(document.input.context, NewCode);
        setfocus();
    } 
	else
	{
    	document.input.context.value += NewCode;
        setfocus();
	}
}
function storeCaret (textEl)
{
	if(textEl.createTextRange)
	{
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}
function insertAtCaret (textEl, text)
{
	if (textEl.createTextRange && textEl.caretPos)
	{
    	var caretPos = textEl.caretPos;
        caretPos.text += caretPos.text.charAt(caretPos.text.length - 2) == ' ' ? text + ' ' : text;
	} 
	else if(textEl) 
	{
		textEl.value += text;
    } 
	else 
	{
		textEl.value = text;
    }
}
function hyperlink() 
{
	txt2=prompt(link_normal,""); 
    if (txt2!=null) 
	{
    	txt=prompt(link_normal_input,"http://");      
        if (txt!=null) 
		{
        	if (txt2=="") 
			{
            	AddTxt="[url]"+txt;
                AddText(AddTxt);
                AddText("[/url]");
            } 
			else 
			{
            	AddTxt="[url="+txt+"]"+txt2;
                AddText(AddTxt);
                AddText("[/url]");
           }         
       	} 
	}
}
function image() 
{
	txt=prompt(image_normal,"http://");    
    if(txt!=null) 
	{            
    	AddTxt="\r[img]"+txt;
        AddText(AddTxt);
        AddText("[/img]");
    }       
}
function bold() 
{
	if (document.selection && document.selection.type == "Text") 
	{
		var range = document.selection.createRange();
		range.text = "[b]" + range.text + "[/b]";
    }
	else 
	{  
        txt=prompt(bold_normal,text_input);     
		if (txt!=null) 
		{           
			AddTxt="[b]"+txt;
            AddText(AddTxt);
            AddText("[/b]");
        }       
    }
}
function italicize() 
{
	if (document.selection && document.selection.type == "Text") 
	{
		var range = document.selection.createRange();
		range.text = "[i]" + range.text + "[/i]";
	} 
	else 
	{   
		txt=prompt(italicize_normal,text_input);     
        if (txt!=null) 
		{           
        	AddTxt="[i]"+txt;
            AddText(AddTxt);
            AddText("[/i]");
        }               
	}
}
function underline() 
{
	if (document.selection && document.selection.type == "Text") 
	{
		var range = document.selection.createRange();
		range.text = "[u]" + range.text + "[/u]";
	}
	else 
	{  
		txt=prompt(underline_normal,text_input);
        if (txt!=null) 
		{           
        	AddTxt="[u]"+txt;
            AddText(AddTxt);
            AddText("[/u]");
        }               
	}
}
function center() 
{
	if (document.selection && document.selection.type == "Text") 
	{
		var range = document.selection.createRange();
		range.text = "[center]" + range.text + "[/center]";
	}
	else 
	{  
		txt=prompt(center_normal,text_input);     
		if (txt!=null) 
		{          
			AddTxt="\r[align=center]"+txt;
			AddText(AddTxt);
            AddText("[/align]");
		}              
	}
}
function setfocus() 
{
        document.input.context.focus();
}