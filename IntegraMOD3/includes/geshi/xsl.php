<?php
/*************************************************************************************
 * xsl.php
 * -------
 * Author: Darren J (darren@phpportalen.net)
 * Copyright: (c) 2007 Darren (http://ww.phpportalen.net)
 * Release Version: 0.9.0.0
 * Date Started: 2007/06/16
 *
 * XSL language file for GeSHi 1.0.7.20
 *
 * HISTORY
 * -------
 * 2007/07/11 (0.9.0.0)
 *   -  First public release
 *
 *
 *************************************************************************************/

$language_data = array (
	'LANG_NAME' => 'XSL',
	'COMMENT_SINGLE' => array(),
	'COMMENT_MULTI' => array('<!--' => '-->'),
	'CASE_KEYWORDS' => GESHI_CAPS_NO_CHANGE,
	'QUOTEMARKS' => array("'", '"'),
	'ESCAPE_CHAR' => '',
	'KEYWORDS' => array(
		),
	'SYMBOLS' => array(
		),
	'CASE_SENSITIVE' => array(
		GESHI_COMMENTS => false,
		),
	'STYLES' => array(
		'KEYWORDS' => array(
			),
		'COMMENTS' => array(
			'MULTI' => 'color: #808080; font-style: italic;'
			),
		'ESCAPE_CHAR' => array(
			0 => 'color: #000099;'
			),
		'BRACKETS' => array(
			0 => 'color: #000099;'
			),
		'STRINGS' => array(
			0 => 'color: brown;'
			),
		'NUMBERS' => array(
			0 => 'color: #cc66cc;'
			),
		'METHODS' => array(
			),
		'SYMBOLS' => array(
			0 => 'color: #000099;'
			),
		'SCRIPT' => array(
			0 => 'color: #00bbdd;',
			1 => 'color: #ddbb00;',
			2 => 'color: #339933; font-stylel: bold;',
			3 => 'color: #000099; font-style: bold;'
			),
		'REGEXPS' => array(
			0 => 'color: #000066;',
			1 => 'color: #ff0000;',
			2 => 'color: blue;',
			3 => 'color: blue;',
			)
		),
	'URLS' => array(
		),
	'OOLANG' => false,
	'OBJECT_SPLITTERS' => array(
		),
	'REGEXPS' => array(
		0 => array(
			GESHI_SEARCH => '([a-z\-:]+)(=)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 'i',
			GESHI_BEFORE => '',
			GESHI_AFTER => '\\2'
			),
		1 => array(
			GESHI_SEARCH => '((xsl:|fo:)[a-z\-]+)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 'i',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
		2 => array(
			GESHI_SEARCH => '(&lt;[/?|(\?xml)]?[a-z0-9_\-:]*(\??&gt;)?)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 'i',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
		3 => array(
			GESHI_SEARCH => '(([/|\?])?&gt;)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 'i',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
		),
//	'STRICT_MODE_APPLIES' => GESHI_MAYBE,
	'STRICT_MODE_APPLIES' => GESHI_ALWAYS,
	'SCRIPT_DELIMITERS' => array(
		0 => array(
			'<!DOCTYPE' => '>'
			),
		1 => array(
			'&' => ';'
			),
		2 => array(
			'<![CDATA[' => ']]>'
			),
		3 => array(
			'<' => '>',
			),
	),
	'HIGHLIGHT_STRICT_BLOCK' => array(
		0 => false,
		1 => false,
		2 => false,
		3 => true
		),
	'TAB_WIDTH' => 4
);

?>
