// Routine to flip display of DIV and call ajax update
function flipf(btn, thiscat)
{
	rnd = Math.random().toString().substring(2);
    myurl1 = myurl + "&rnd=" + rnd;
	if (btn.className=="ccclose")
	{
		btn.className="ccopen";
		document.getElementById('flist'+thiscat).style.display="none";
		myurl1 = myurl1 + "&cset=" + thiscat;
	}
	else
	{
		btn.className="ccclose";
		document.getElementById('flist'+thiscat).style.display="block";
		myurl1 = myurl1 + "&cunset=" + thiscat;
	}
//	alert (myurl);
	var myajax=ajaxobject();
	myajax.open('GET',myurl1,true);
	myajax.onreadystatechange = function()
		{
			if (myajax.readyState == 4)
			{
				if (myoutput = myajax.responseXML)
					{
						// Discard
						return;
					}
			}		
		}
	myajax.send(null);
}
// Ajax object
function ajaxobject()
{
	try
	{
		var http_request = false;
		if (window.XMLHttpRequest)
		{ // Mozilla, Safari,...
			http_request = new XMLHttpRequest();
			if (http_request.overrideMimeType)
			{
				http_request.overrideMimeType('text/xml');
			}
		}
		else if (window.ActiveXObject)
		{ // IE
			try
			{
				http_request = new ActiveXObject('Msxml2.XMLHTTP');
			}
			catch (e)
			{
				try
				{
					http_request = new ActiveXObject('Microsoft.XMLHTTP');
				}
				catch (e)
				{
				}
			}
		}

		if (!http_request)
		{
			 return false;
		}
		else
		{
			return http_request;
	}	
	}
	catch (e)
	{
		handle(e);
		return false;
	}
}
