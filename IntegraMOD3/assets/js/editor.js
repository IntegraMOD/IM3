	/**
* bbCode control by subBlue design [ www.subBlue.com ]
* Includes unixsafe colour palette selector by SHS`
*/
 
// Startup variables
var imageTag = false;
var theSelection = false;
 
var bbcodeEnabled = true;
// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version
 
var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));
var baseHeight;
 
/**
* Shows the help messages in the helpline window
*/
function helpline(help)
{
	document.forms[form_name].helpbox.value = help_line[help];
}
 
/**
* Fix a bug involving the TextRange object. From
* http://www.frostjedi.com/terra/scripts/demo/caretBug.html
*/
function initInsertions()
{
	var doc;
 
	if (document.forms[form_name])
	{
		doc = document;
	}
	else
	{
		doc = opener.document;
	}
 
	var textarea = doc.forms[form_name].elements[text_name];
 
	if (is_ie && typeof(baseHeight) != 'number')
	{
		textarea.focus();
		baseHeight = textarea.value.substring(0, textarea.selectionStart).split("\n").length * 16;
 
		if (!document.forms[form_name])
		{
			document.body.focus();
		}
	}
}
 
/**
* bbstyle
*/
function bbstyle(bbnumber)
{	
	if (bbnumber != -1)
	{
		bbfontstyle(bbtags[bbnumber], bbtags[bbnumber+1]);
	} 
	else 
	{
		insert_text('[*]');
		document.forms[form_name].elements[text_name].focus();
	}
}
 
/**
* Apply bbcodes
*/
function bbfontstyle(bbopen, bbclose)
{
	theSelection = false;
 
	var textarea = document.forms[form_name].elements[text_name];
 
	textarea.focus();
 
	if ((clientVer >= 4) && is_ie && is_win)
	{
		// Get text selection
		var startPos = textarea.selectionStart;
		var endPos = textarea.selectionEnd;
 
		if (startPos !== endPos)
		{
			// Add tags around selection
			var selectedText = textarea.value.substring(startPos, endPos);
			var newText = bbopen + selectedText + bbclose;
			textarea.value = textarea.value.substring(0, startPos) + newText + textarea.value.substring(endPos);
			textarea.focus();
			textarea.setSelectionRange(startPos, startPos + newText.length);
		}
		else
		{
			// No selection, insert tags at caret position
			insert_text(bbopen + bbclose);
		}
	}
}