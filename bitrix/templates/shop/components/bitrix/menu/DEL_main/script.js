var jshover = function()
{
	setup("td");
	setup("li");
}

function setup(tagName)
{
	var menuDiv = document.getElementById("horizontal-multilevel-menu")
	if (!menuDiv)
		return;
		
	var sfEls = menuDiv.getElementsByTagName(tagName);

	for (var i=0; i<sfEls.length; i++) 
	{
		sfEls[i].onmouseover=function()
		{
			this.className += " jshover";
		}
		sfEls[i].onmouseout=function() 
		{
			this.className = this.className.replace(new RegExp(" jshover\\b"), "");
		}
	}
}