	function sendPage()
	{
		fb.end();
		xajax_callUser('opsearch','FindLoads','opsearch',xajax.getFormValues('form1'))
		return false;
	}
