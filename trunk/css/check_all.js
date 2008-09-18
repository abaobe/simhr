function checkall(form) 
{
	for(var i = 0;i < form.elements.length; i++) 
	{
                  if (form.elements[i].name == 'delete[]')
                    {
                     form.elements[i].checked = form.chkall.checked;
                     }


	}
}