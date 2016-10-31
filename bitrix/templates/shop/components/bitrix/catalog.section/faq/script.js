function clearFaq(id)
{
	var element = document.getElementById(id);
	if (!element) return;
	
	var sfEls = element.getElementsByTagName("li");

	for (var i=0; i < sfEls.length; i++) 
	{
		if (sfEls[i].className == "sel") sfEls[i].className = '';
	}
}