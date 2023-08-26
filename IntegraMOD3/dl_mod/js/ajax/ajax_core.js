//
// @mod package		Download MOD 6
// @file			ajax_core.js 1 2011/08/18 OXPUS
// @copyright		(c) 2011 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
// @license			http://opensource.org/licenses/gpl-license.php GNU Public License
//

//
// This is the only value you should change
// It defines the time in milliseconds that the script waits before automatically submitting the fields for usernames (New PM and username search)
//
var KEYUP_TIMEOUT = 500;

var request = null;
var error_handler = '';

// Don't want to use const, var works in JS 1.0 as well :)
var AJAX_OP_COMPLETED = 0;
var AJAX_ERROR = 1;
var AJAX_POLL_RESULT = 3;

//
// Determine whether AJAX is available
//
if (window.XMLHttpRequest)
{
	var tempvar = new XMLHttpRequest();
	ajax_core_defined = (tempvar == null) ? 0 : 1;
	delete(tempvar);
}
//Use the IE/Windows ActiveX version
else if (window.ActiveXObject)
{
	tempvar = new ActiveXObject("Msxml2.XMLHTTP");
	if (tempvar == null)
	{
		tempvar = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajax_core_defined = (tempvar == null) ? 0 : 1;
	delete(tempvar);
}
else
{
	ajax_core_defined = 0;
}

function loadXMLDoc(url, params, changehandler)
{
	if (window.XMLHttpRequest)
	{
		request = new XMLHttpRequest();
		var is_activex = false;
	}
	else if (window.ActiveXObject)
	{
		request = new ActiveXObject("Msxml2.XMLHTTP");
		if (request == null)
		{
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}

		request = new ActiveXObject("Microsoft.XMLHTTP");
		var is_activex = true;
	}

	if (!request)
	{
		return false;
	}

	eval('request.onreadystatechange = ' + changehandler);
	request.open('get', url + '?' + params, true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=' + ajax_page_charset);

	if (is_activex)
	{
		// This seems to be an issue in the ActiveX-Object: no parameter needed
		request.send();
	}
	else
	{
		// The native versions take null as a parameter
		request.send(null);
	}

	return true;
}

function getTagValues(tagname, haystack)
{
	var tag_array = haystack.getElementsByTagName(tagname);
	var result_array = Array();
	for (i = 0; i < tag_array.length; i++)
	{
		result_array[i] = (tag_array[i].firstChild && tag_array[i].firstChild.data) ? tag_array[i].firstChild.data : '';
	}
	return result_array;
}

function getFirstTagValue(tagname, haystack)
{
	var tag_array = haystack.getElementsByTagName(tagname);
	if ((tag_array.length > 0) && (tag_array[0].firstChild))
	{
		return (tag_array[0].firstChild.data) ? tag_array[0].firstChild.data : '';
	}
	return '';
}

//
// This function is used to parse any standard error file
//
function error_req_change()
{
	//Check if the request is completed, if not, just skip over
	if (request.readyState == 4)
	{
		var result_code = AJAX_OP_COMPLETED;
		var error_msg = '';
		//If the request wasn't successful, we just hide any information we have.

		if (request.status == 200)
		{
			response = request.responseXML.documentElement;

			if (response != null)
			{
				result_code = getFirstTagValue('result', response);
				error_msg = getFirstTagValue('error_msg', response);
			}
		}

		eval(error_handler+"(result_code, error_msg);");
		delete request;
	}
}

function getElementById(ElementId)
{
	if (document.documentElement)
	{
		return document.getElementById(ElementId);
	}
	else
	{
		return document.all[ElementId];
	}
}

function setClickEventHandler(obj, handler)
{
	if (obj.onclick)
	{
		eval('obj.onclick = function() { '+handler+' }');
	}
	else
	{
		obj.setAttribute('onclick', handler, 'false');
	}
}

function setInnerText(obj, newtext)
{
	if (newtext == '')
	{
		newtext = '&nbsp;';
	}

	if (obj.innerText)
	{
		obj.innerText = newtext;
	}
	else if (obj.firstChild)
	{
		obj.firstChild.nodeValue = newtext;
	}
	else
	{
		obj.innerHTML = newtext;
	}
}

// This function is a workaround for long posts being truncated in PITA browsers
function parseResult(response)
{
	var res = response.match(/\<response\>((.|\s)+?)\<\/response\>/gm);
	var fields = new Array();
	if (res != null)
	{
		contents = RegExp.$1;
		res = contents.match(/\<.+?\>((.|\s)+?)\<\/.+?\>/gm);
		if (res == null)
		{
			return fields;
		}

		for (var i = 0; i < res.length; i++)
		{
			var field = new Array();
			res[i].match(/^\<(.+?)\>/g);
			field[0] = RegExp.$1;
			res[i].match(/\<.+?\>((.|\s)+)\<\/.+?\>/gm);
			field[1] = unhtmlspecialchars(RegExp.$1);

			fields[i] = field;
		}
	}

	return fields;
}