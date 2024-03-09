<?php
/**
*
* abbcode [English]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. "Message %d" is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., "Click %sHERE%s" is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// Help page
	'ABBC3_HELP_TITLE'			=> 'Advanced BBCode Box 3 :: Help Page',
	'ABBC3_HELP_DESC'			=> 'Description',
	'ABBC3_HELP_WRITE'			=> 'BBCode usage format',
	'ABBC3_HELP_VIEW'			=> 'Result',
	'ABBC3_HELP_ABOUT'			=> 'Advanced BBCode Box 3 by <a href="http://www.phpbb.com/customise/db/mod/advanced_bbcode_box_3/" onclick="window.open(this.href);return false;">mssti</a>',
//	'ABBC3_HELP_ALT'			=> 'Advanced BBCode Box 3 (aka ABBC3)',

// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'Click to view the full image.',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'Zoom in (real dimensions: %1$s x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'Close',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'Zoom out',
	'ABBC3_RESIZE_FILESIZE'		=> 'This image has been resized. The original image is %1$s x %2$s and weights %3$sKB.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'This image has been resized. The original image is %1$s x %2$s.',
	'ABBC3_RESIZE_FULLSIZE'		=> 'Image resized to %1$s% of its original size [%2$s x %3$s]',
	'ABBC3_RESIZE_NUMBER'		=> 'Image %1$s of %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'Play slideshow',
	'ABBC3_RESIZE_PAUSE'		=> 'Pause slideshow',
	'ABBC3_RESIZE_IMAGE'		=> 'Image',
	'ABBC3_RESIZE_OF'			=> 'of',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'Loading...',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'Click to cancel',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'Click to bring to front',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'Expand to actual size',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'Full size',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Powered by <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'Go to the Highslide JS homepage',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'Previous',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'Previous (arrow left)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'Next',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'Next (arrow right)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'Move',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'Move',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'Close',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'Close (esc)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'Resize',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'Play',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'Play slideshow (spacebar)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'Pause',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'Pause slideshow (spacebar)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'Image %1 of %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'Click to close image. Click and drag to move. Use arrow keys for next and previous.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'Tip: Styles can be applied quickly to selected text.',

	'ABBC3_ERROR'				=> 'Error : ',
	'ABBC3_ERROR_TAG'			=> 'Unexpected error using tag : ',
	'ABBC3_NO_EXAMPLE'			=> 'No data example',

	'ABBC3_ID'					=> 'Enter identifier :',
	'ABBC3_NOID'				=> 'You did not write the identifier',
	'ABBC3_LINK'				=> 'Enter a link for ',
	'ABBC3_DESC'				=> 'Enter a description for ',
	'ABBC3_NAME'				=> 'Description',
	'ABBC3_NOLINK'				=> 'You did not enter a link for ',
	'ABBC3_NODESC'				=> 'You did not enter a description for ',
	'ABBC3_WIDTH'				=> 'Enter the width',
	'ABBC3_WIDTH_NOTE'			=> 'Note: The value can be expressed as a percentage',
	'ABBC3_NOWIDTH'				=> 'You did not enter the width',
	'ABBC3_HEIGHT'				=> 'Enter the height',
	'ABBC3_HEIGHT_NOTE'			=> 'Note: The value can be expressed as a percentage',
	'ABBC3_NOHEIGHT'			=> 'You did not enter the height',

	'ABBC3_NOTE'				=> 'Note',
	'ABBC3_EXAMPLE'				=> 'Example',
	'ABBC3_EXAMPLES'			=> 'Examples',
	'ABBC3_SHORT'				=> 'Select BBCode',
	'ABBC3_DEPRECATED'			=> '<div class="error">The <em>%1$s</em> BBCode has been deprecated as of ABBC3 version <em>%2$s</em></div>',
	'ABBC3_UNAUTHORISED'		=> 'You cannot use certain words : <br /><strong> %s </strong>',
	'ABBC3_NOSCRIPT'			=> 'Your browser has disabled scripts or does not support client-side scripting. <em>( JavaScript! )</em>',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'The page you are viewing requires the use of JavaScript for best performance.<br />If you have intentionally disabled JavaScript, please enable it.',
	'ABBC3_FUNCTION_DISABLED'	=> 'This function is not available on this board.',
	'ABBC3_AJAX_DISABLED'		=> 'Your browser does not support AJAX (XMLHttpRequest) and was unable to process this request.',
	'ABBC3_SUBMIT'				=> 'Insert into message',
	'ABBC3_SUBMIT_SIG'			=> 'Insert into signature',
	'SAMPLE_TEXT'				=> 'The quick brown fox jumps over the lazy dog',
	'DEPRECATED_BBCODE'			=> '<strong class="error">Note:</strong> this BBCode is obsolete and has been replaced by BBvideo.',
));

/**
* TRANSLATORS PLEASE NOTE 
*	Several lines have an special note like "##	For translator: " followed by "yes" and "no"
*	These are lines with mixed code and language. For these lines you can translate anything 
*	under a "yes" but do not change any text under a "no"
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'Font type',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]text[/font]',
	'ABBC3_FONT_NOTE'			=> 'Note: You can define additional font-families',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'Safe list',
	'ABBC3_FONT_WIN'			=> 'Win default',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'Giant',
	'ABBC3_SIZE_MOVER'			=> 'Font size',
	'ABBC3_SIZE_TIP'			=> '[size=150]large text[/size]',
	'ABBC3_SIZE_NOTE'			=> 'Note: The value will be interpreted as a percentage',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'Highlight text',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]text[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'Tip: You can also use highlight=#FFFF00',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'Font colour',
	'ABBC3_COLOR_TIP'			=> '[color=red]text[/color]',
	'ABBC3_COLOR_NOTE'			=> 'Tip: You can also use color=#FF0000',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_TIGRA'		=> 'Tigra Color Picker',
	'ABBC3_COLOUR_SAFE'			=> 'Web Safe Palette',
	'ABBC3_COLOUR_WIN'			=> 'Windows System Palette',
	'ABBC3_COLOUR_GREY'			=> 'Grey Scale Palette',
	'ABBC3_COLOUR_MAC'			=> 'Mac OS Palette',
	'ABBC3_SAMPLE'				=> 'sample',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'Remove selected text',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'Copy selected text',
	// Paste previously copy text
	'ABBC3_PASTE_MOVER'			=> 'Paste copied text',
	'ABBC3_PASTE_ERROR'			=> 'You must first copy a selection of text, then paste it',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'Remove all BBCodes from the selected text',
	'ABBC3_NOSELECT_ERROR'		=> 'No text was seleted.',

	// Code
	'ABBC3_CODE_MOVER'			=> 'Code display',
	'ABBC3_CODE_TIP'			=> '[code]code[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code] or [code=php]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'Quote text',
	'ABBC3_QUOTE_TIP'			=> '[quote]text[/quote] or [quote=“member”]text[/quote]',
##	For translator:                                                            yes              yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] or [quote=&quot;member&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'Spoiler text',
	'ABBC3_SPOIL_TIP'			=> '[spoil]text[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'Show Spoiler',
	'SPOILER_HIDE'				=> 'Hide Spoiler',

	// Hidden
	'ABBC3_HIDDEN_MOVER'		=> 'Hide content from unregistered guests',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]text[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'Hidden Content (for members only)',
	'HIDDEN_ON'					=> 'Hidden Content',
	'HIDDEN_EXPLAIN'			=> 'This board requires you to be registered and logged-in to view hidden content.',

	// Moderator
	'ABBC3_MOD_MOVER'			=> 'Moderator message',
	'ABBC3_MOD_TIP'				=> '[mod=“name”]text[/mod]',
##	For translator:                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=&quot;Moderator_name&quot;]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off Topic
	'OFFTOPIC'					=> 'Off Topic',
	'ABBC3_OFFTOPIC_MOVER'		=> 'Insert Off Topic text',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]text[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'Scrippet',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]Screenplay text[/scrippet]',
##	For translator:                 don't change the "<br />" and don't join the lines into one!
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]EXT. ANCIENT ROME - DAY<br />' . "\n" . 'ANTONIUS and IPSUM are walking down a tiny, crowded street.<br />' . "\n" . 'ANTONIUS<br />' . "\n" . 'Do you think in a thousand years, anyone will remember our names?<br />' . "\n" . 'IPSUM<br />' . "\n" . 'Not yours. But they’ll know mine. Because I intend to write something so profound that it will be remembered for the ages. Designers in the 20th Century call for Lorem Ipsum whenever they need to fill text blocks.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'Tabs',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:Title]this tab text[tabs:Another]this tab text[/tabs]',
##	For translator:                              yes             yes                                                                                                                              yes               Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:Tab Title]&nbsp;All the content below this tag will be displayed inside this tab, until another tab is declared with: &#91;tabs:XXX&#93;.[tabs:Another Tab]&nbsp;And so on...until the end of the page or optionally you can use &#91;/tabs&#93; to end the last tab and display normal text outside the tabs.[/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'NFO text',
	'ABBC3_NFO_MOVER'			=> 'NFO text',
	'ABBC3_NFO_TIP'				=> '[nfo]NFO text[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]         /\_/\
    ____/ o o \
  /~____  =ø= /
 (______)__m_m)
[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'Justify align text',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]text[/align]',
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'Right align text',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]text[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'Center align text',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]text[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'Left align text',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]text[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'Preformatted text',
	'ABBC3_PRE_TIP'				=> '[pre]text[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'Indent text',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'Enter a number that will be the margin measured in pixels.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'Superscript text',
	'ABBC3_SUP_TIP'				=> '[sup]text[/sup]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUP_VIEW'			=> 'This is normal text [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] this is normal text',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'Subscript text',
	'ABBC3_SUB_TIP'				=> '[sub]text[/sub]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUB_VIEW'			=> 'This is normal text [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] this is normal text',

	// Bold
	'ABBC3_B_MOVER'				=> 'Bold text',
	'ABBC3_B_TIP'				=> '[b]text[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'Italic text',
	'ABBC3_I_TIP'				=> '[i]text[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'Underline text',
	'ABBC3_U_TIP'				=> '[u]text[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'Strikethrough text',
	'ABBC3_S_TIP'				=> '[s]text[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'Text fadein / fadeout',
	'ABBC3_FADE_TIP'			=> '[fade]text[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'Gradient text',
	'ABBC3_GRAD_TIP'			=> 'Select some text first',
	'ABBC3_GRAD_VIEW'			=> '[color=#40FF00]I[/color] [color=#B6FF00]a[/color][color=#F0FF00]m[/color] [color=#DD9845]a[/color] [color=#BF4A94]r[/color][color=#BF5EBB]a[/color][color=#BF71E2]i[/color][color=#B57BFF]n[/color][color=#8E67FF]b[/color][color=#6754FF]o[/color][color=#4040FF]w[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'No text was seleted.',
	'ABBC3_GRAD_MAX_ERROR'		=> 'Only text selections less than 120 characters allowed.',
	'ABBC3_GRAD_COLORS'			=> 'Pre Selected Colors',
	'ABBC3_GRAD_ERROR'			=> 'Error: ColorCode constructor failed',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'Glow text',
	'ABBC3_GLOW_TIP'			=> '[glow=color]text[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'Shadow text',
	'ABBC3_SHADOW_TIP'			=> '[shadow=color]text[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'Dropshadow text',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=color]text[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'Blur text',
	'ABBC3_BLUR_TIP'			=> '[blur=color]text[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'Wave text (Only for Internet Explorer)',
	'ABBC3_WAVE_TIP'			=> '[wave=color]text[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'List',
	'ABBC3_LISTB_TIP'			=> '[list]text[/list]',
	'ABBC3_LISTB_NOTE'			=> 'Note: Use [*] for each list item',
##	For translator:                          yes      yes      yes           yes         yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]Item 1[*]Item 2[*]Item 3[/list] or [list][*]Item 1[list][*]sub-item 1[list][*]sub-sub-item1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'Ordered list',
	'ABBC3_LISTO_TIP'			=> '[list=1|a|A|i|I]text[/list]',
	'ABBC3_LISTO_NOTE'			=> 'Note: Use [*] for each list item',
##	For translator:                            yes      yes     yes          yes           yes      yes      yes           yes           yes      yes      yes           yes           yes      yes       yes             yes           yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]Item 1[*]Item2[*]Item3[/list] or [list=a][*]Item a[*]Item b[*]Item c[/list] or [list=A][*]Item A[*]Item B[*]Item C[/list] or [list=i][*]Item i[*]Item ii[*]Item iii[/list] or [list=I][*]Item I[*]Item II[*]Item III[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'List item',
	'ABBC3_LISTITEM_TIP'		=> '[*]text',
	//'ABBC3_LISTITEM_NOTE'		=> 'Note: Creates bulleted or numbered items inside list',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'Horizontal line',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'Note: Creates a horizontal line to seperate text',
	'ABBC3_HR_VIEW'				=> $lang['SAMPLE_TEXT'] . '[hr]' . $lang['SAMPLE_TEXT'],

	// Message Box text direction right to Left
	'ABBC3_DIRRTL_MOVER'		=> 'Text direction for reading right-to-left',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]text[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction Left to right
	'ABBC3_DIRLTR_MOVER'		=> 'Text direction for reading left-to-right',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]text[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'Scroll text down',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]text[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'Scroll text upwards',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]text[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'Scroll text to the right',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]text[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'Scroll text to the left',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]text[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'Insert a table',
	'ABBC3_TABLE_TIP'			=> '[table=(CSS style)][tr=(CSS style)][td=(CSS style)]text[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'Enter the table style',
	'ABBC3_TABLE_EXAMPLE'		=> 'width:50%;border:1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'Enter number of table rows',
	'ABBC3_ROW_ERROR'			=> 'You did not enter the number of rows',
	'ABBC3_ROW_STYLE'			=> 'Enter the row style',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align:center;',

	'ABBC3_CELL_NUMBER'			=> 'Enter number of cells',
	'ABBC3_CELL_ERROR'			=> 'You did not enter the number of cells',
	'ABBC3_CELL_STYLE'			=> 'Enter the cell style',
	'ABBC3_CELL_EXAMPLE'		=> 'border:1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'Insert anchor',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(this anchor name) goto=(target anchor name)]text[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]Go to anchor a2[/anchor]',
##	For translator:                                            yes                         Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=help_0 goto=help_1]Go to link 1[/anchor]<br /> or  [anchor=help_1]this is link 1[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'page',
	'ABBC3_URL_MOVER'			=> 'Insert URL',	
	'ABBC3_URL_TIP'				=> '[url]http://url[/url] or [url=http://url]URL text[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.phpbb.com]Visit phpBB![/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'email',
	'ABBC3_EMAIL_MOVER'			=> 'Insert Email',
	'ABBC3_EMAIL_TIP'			=> '[email]user@server.ext[/email] or [email=user@server.ext]My email[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'ed2k',
	'ABBC3_ED2K_MOVER'			=> 'Link eD2K',
	'ABBC3_ED2K_TIP'			=> '[url]link ed2k[/url] or [url=link ed2k]Name ed2k[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'Add selected links to your ed2k client',
	'ABBC3_ED2K_FRIEND'			=> 'ed2k friend',
	'ABBC3_ED2K_SERVER'			=> 'ed2k server',
	'ABBC3_ED2K_SERVERLIST'		=> 'ed2k serverlist',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'web',
	'ABBC3_WEB_MOVER'			=> 'Insert a website in your post',
	'ABBC3_WEB_TIP'				=> '[web width=99% height=400]http://url[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=400]http://www.phpbb.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">Note:</strong> allowing other websites to be inserted in posts can pose a security risk. Use at your own risk, or assign to trusted groups.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'Align image',
##	For translator:							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'Default',
											'left'			=> 'Left',
											'center'		=> 'Center',
											'right'			=> 'Right',
											'float-left'	=> 'Float-Left',
											'float-right'	=> 'Float-Right'),

	// Image
	'ABBC3_IMG_TAG'				=> 'image',
	'ABBC3_IMG_MOVER'			=> 'Insert image',
	'ABBC3_IMG_TIP'				=> '[img]http://image_url[/img] or [img=left|center|right|float-left|float-right]http://image_url[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'thumbnail',
	'ABBC3_THUMBNAIL_MOVER'		=> 'Insert thumbnail',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail]http://image_url[/thumbnail] or [thumbnail=left|center|right|float-left|float-right]http://image_url[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'Insert image from an image hosting service',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img]http://image_url[/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_RAPIDSHARE_TAG'		=> 'rapidshare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'Insert a file from rapidshare',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/...[/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'File found on server!',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'File not found!',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>Error : </strong> Sorry but it appears that CURL is not loaded. Please install it to use this function.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'This board requires you to be registered and logged-in to view links.',
	'ABBC3_TESTLINK_TAG'		=> 'link checker',
	'ABBC3_TESTLINK_MOVER'		=> 'Insert a file stored on public server',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/...[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'Valid servers: rapidshare, depositfiles, megashares',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'File found on server!',
	'ABBC3_TESTLINK_WRONG'		=> 'File not found!',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'click',
	'ABBC3_CLICK_MOVER'			=> 'Insert URL with click counter',
	'ABBC3_CLICK_TIP'			=> '[click]http://url[/click] or [click=http://url]Name Web[/click] or [click][img]http://url[/img][/click]',
	'ABBC3_CLICK_EXAMPLE' 		=> 'http://www.google.com' . ' | ' . 'http://www.google.com/intl/en_com/images/logo_plain.png',
##	For translator:                                                               yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.google.com] Google [/click] or [click][img]http://www.google.com/intl/en_com/images/logo_plain.png[/img][/click]',
	'ABBC3_CLICK_TIME'			=> '( Clicked %d time )',
	'ABBC3_CLICK_TIMES'			=> '( Clicked %d times )',
	'ABBC3_CLICK_ERROR'			=> '<strong>ERROR:</strong> Please enter a VALID click ID in URL',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'Insert search word',
	'ABBC3_SEARCH_TIP'			=> '[search]text[/search] or [search=bing|yahoo|google|altavista|lycos|wikipedia]text[/search]',
##	For translator:                                                              yes                                                 yes                                                   yes                                                    yes                                                       yes                                                   yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Advanced BBCode Box 3[/search]<br /> or [search=bing]Advanced BBCode Box 3[/search]<br /> or [search=yahoo]Advanced BBCode Box 3[/search]<br /> or [search=google]Advanced BBCode Box 3[/search]<br /> or [search=altavista]Advanced BBCode Box 3[/search]<br /> or [search=lycos]Advanced BBCode Box 3[/search]<br /> or [search=wikipedia]Advanced BBCode Box 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'Insert web video',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo width,height]Video URL[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 560,340]http://www.youtube.com/watch?v=sP4NMoJcFd4[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'BBvideo sites and files',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'There are no embedded video links currently allowed. Please notify the %sBoard Administrator%s about this problem.<br />In the meantime, you may post your video links using the standard URL BBCode.',
	'ABBC3_BBVIDEO_FILE'		=> 'File format',
	'ABBC3_BBVIDEO_VIDEO'		=> 'Allowed sites',
	'ABBC3_BBVIDEO_WATCH'		=> 'Watch on',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'flash',
	'ABBC3_FLASH_MOVER'			=> 'Insert Flash file (swf)',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]URL flash[/flash] or [flash width,height]URL flash[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'flash',
	'ABBC3_FLV_MOVER'			=> 'Insert Flash video (flv)',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]URL flash video[/flv] or [flv width,height]URL flash video[/flv]',
	'ABBC3_FLV_EXAMPLE'			=> 'http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv[/flv]',
	'ABBC3_FLV_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'video',
	'ABBC3_VIDEO_MOVER'			=> 'Insert video',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]URL video[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv[/video]',
	'ABBC3_VIDEO_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'sound',
	'ABBC3_STREAM_MOVER'		=> 'Insert sound',
	'ABBC3_STREAM_TIP'			=> '[stream]URL stream[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://www.robtowns.com/music/first_noel.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://www.robtowns.com/music/first_noel.mp3[/stream]',
	'ABBC3_STREAM_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Quicktime
	'ABBC3_QUICKTIME_TAG'		=> 'Quicktime',
	'ABBC3_QUICKTIME_MOVER'		=> 'Insert Quicktime',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]URL Quicktime[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt[/quicktime]',
	'ABBC3_QUICKTIME_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'Insert Real Media',
	'ABBC3_RAM_TIP'				=> '[ram]URL Real Media[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram',
	'ABBC3_RAM_VIEW'			=> '[ram width=250 height=200]http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram[/ram]',
	'ABBC3_RAM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'Youtube Video',
	'ABBC3_YOUTUBE_MOVER'		=> 'Insert video from Youtube',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]URL video[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=sP4NMoJcFd4[/youtube]',
	'ABBC3_YOUTUBE_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'Insert video from Veoh',
	'ABBC3_VEOH_TIP'			=> '[veoh]URL video[/veoh]',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/watch/v27458670er62wkCt',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/watch/v27458670er62wkCt[/veoh]',
	'ABBC3_VEOH_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Collegehumor video
	'ABBC3_COLLEGEHUMOR_TAG'	=> 'Collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'Insert video from Collegehumor',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]collegehumor video URL[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXPLAIN'=> $lang['DEPRECATED_BBCODE'],

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'Insert video from dailymotion',
	'ABBC3_DM_TIP'				=> '[dm]Dailymotion ID[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport[/dm]',
	'ABBC3_DM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'Insert video from Gamespot',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]Gamespot video URL[gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8[/gamespot]',
	'ABBC3_GAMESPOT_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'Insert video from IGN',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]IGN video URL[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html[/ignvideo]',
	'ABBC3_IGNVIDEO_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'Insert video from Liveleak',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]Liveleak video URL[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=166_1194290849',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=166_1194290849[/liveleak]',
	'ABBC3_LIVELEAK_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

// Custom BBCodes

));

?>