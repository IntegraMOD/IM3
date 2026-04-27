<?php
/**
 * GeSHi - Generic Syntax Highlighter
 *
 * The GeSHi class for Generic Syntax Highlighting. Please refer to the
 * documentation at http://qbnz.com/highlighter/documentation.php for more
 * information about how to use this class.
 *
 * For changes, release notes, TODOs etc, see the relevant files in the docs/
 * directory.
 *
 *   This file is part of GeSHi.
 *
 *  GeSHi is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  GeSHi is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with GeSHi; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @package    geshi
 * @subpackage core
 * @author     Nigel McNie <nigel@geshi.org>
 * @copyright  (C) 2004 - 2007 Nigel McNie
 * @license    http://gnu.org/copyleft/gpl.html GNU GPL
 *
 */

//
// GeSHi Constants
// You should use these constant names in your programs instead of
// their values - you never know when a value may change in a future
// version
//

/** The version of this GeSHi file */
if (!defined('GESHI_VERSION')) {
	define('GESHI_VERSION', '1.0.7.20');
}

// Define the root directory for the GeSHi code tree
if (!defined('GESHI_ROOT')) {
	/** The root directory for GeSHi */
	define('GESHI_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

/** The language file directory for GeSHi
    @access private */
if (!defined('GESHI_LANG_ROOT')) {
	define('GESHI_LANG_ROOT', GESHI_ROOT . 'geshi' . DIRECTORY_SEPARATOR);
}


// Line numbers - use with enable_line_numbers()
/** Use no line numbers when building the result */
if (!defined('GESHI_NO_LINE_NUMBERS')) {
	define('GESHI_NO_LINE_NUMBERS', 0);
}
/** Use normal line numbers when building the result */
if (!defined('GESHI_NORMAL_LINE_NUMBERS')) {
	define('GESHI_NORMAL_LINE_NUMBERS', 1);
}
/** Use fancy line numbers when building the result */
if (!defined('GESHI_FANCY_LINE_NUMBERS')) {
	define('GESHI_FANCY_LINE_NUMBERS', 2);
}

// Container HTML type
/** Use nothing to surround the source */
if (!defined('GESHI_HEADER_NONE')) {
	define('GESHI_HEADER_NONE', 0);
}
/** Use a "div" to surround the source */
if (!defined('GESHI_HEADER_DIV')) {
	define('GESHI_HEADER_DIV', 1);
}
/** Use a "pre" to surround the source */
if (!defined('GESHI_HEADER_PRE')) {
	define('GESHI_HEADER_PRE', 2);
}

// Capitalisation constants
/** Lowercase keywords found */
if (!defined('GESHI_CAPS_NO_CHANGE')) {
	define('GESHI_CAPS_NO_CHANGE', 0);
}
/** Uppercase keywords found */
if (!defined('GESHI_CAPS_UPPER')) {
	define('GESHI_CAPS_UPPER', 1);
}
/** Leave keywords found as the case that they are */
if (!defined('GESHI_CAPS_LOWER')) {
	define('GESHI_CAPS_LOWER', 2);
}

// Link style constants
/** Links in the source in the :link state */
if (!defined('GESHI_LINK')) {
	define('GESHI_LINK', 0);
}
/** Links in the source in the :hover state */
if (!defined('GESHI_HOVER')) {
	define('GESHI_HOVER', 1);
}
/** Links in the source in the :active state */
if (!defined('GESHI_ACTIVE')) {
	define('GESHI_ACTIVE', 2);
}
/** Links in the source in the :visited state */
if (!defined('GESHI_VISITED')) {
	define('GESHI_VISITED', 3);
}

// Important string starter/finisher
// Note that if you change these, they should be as-is: i.e., don't
// write them as if they had been run through htmlentities()
/** The starter for important parts of the source */
if (!defined('GESHI_START_IMPORTANT')) {
	define('GESHI_START_IMPORTANT', '<BEGIN GeSHi>');
}
/** The ender for important parts of the source */
if (!defined('GESHI_END_IMPORTANT')) {
	define('GESHI_END_IMPORTANT', '<END GeSHi>');
}

/**#@+
 *  @access private
 */
// When strict mode applies for a language
/** Strict mode never applies (this is the most common) */
if (!defined('GESHI_NEVER')) {
	define('GESHI_NEVER', 0);
}
/** Strict mode *might* apply */
if (!defined('GESHI_MAYBE')) {
	define('GESHI_MAYBE', 1);
}
/** Strict mode always applies */
if (!defined('GESHI_ALWAYS')) {
	define('GESHI_ALWAYS', 2);
}

// Advanced regexp handling constants, used in language files
/** The key of the regex array defining what to search for */
if (!defined('GESHI_SEARCH')) {
	define('GESHI_SEARCH', 0);
}
/** The key defining what bracket group to replace */
if (!defined('GESHI_REPLACE')) {
	define('GESHI_REPLACE', 1);
}
/** The key defining regex modifiers */
if (!defined('GESHI_MODIFIERS')) {
	define('GESHI_MODIFIERS', 2);
}
/** The key defining what to put before replacement */
if (!defined('GESHI_BEFORE')) {
	define('GESHI_BEFORE', 3);
}
/** The key defining what to put after replacement */
if (!defined('GESHI_AFTER')) {
	define('GESHI_AFTER', 4);
}
/** The key defining custom keyword class */
if (!defined('GESHI_CLASS')) {
	define('GESHI_CLASS', 5);
}

/** Used in language files to mark comments */
if (!defined('GESHI_COMMENTS')) {
	define('GESHI_COMMENTS', 0);
}

// Error detection - use these to analyse faults
/** No sourcecode to highlight was specified */
if (!defined('GESHI_ERROR_NO_INPUT')) {
	define('GESHI_ERROR_NO_INPUT', 1);
}
/** The language specified does not exist */
if (!defined('GESHI_ERROR_NO_SUCH_LANG')) {
	define('GESHI_ERROR_NO_SUCH_LANG', 2);
}
/** Language file not readable */
if (!defined('GESHI_ERROR_FILE_NOT_READABLE')) {
	define('GESHI_ERROR_FILE_NOT_READABLE', 3);
}
/** Invalid header type */
if (!defined('GESHI_ERROR_INVALID_HEADER_TYPE')) {
	define('GESHI_ERROR_INVALID_HEADER_TYPE', 4);
}
/** Invalid line number type */
if (!defined('GESHI_ERROR_INVALID_LINE_NUMBER_TYPE')) {
	define('GESHI_ERROR_INVALID_LINE_NUMBER_TYPE', 5);
}
/**#@-*/

/**
 * The GeSHi Class.
 *
 * Please refer to the documentation for GeSHi 1.0.X that is available
 * at http://qbnz.com/highlighter/documentation.php for more information
 * about how to use this class.
 *
 * @package   geshi
 * @author    Nigel McNie <nigel@geshi.org>
 * @copyright (C) 2004 - 2007 Nigel McNie
 */
class GeSHi {
    /**#@+
     * @access private
     */
    /**
     /**
     * The source code to highlight
     * @var string
     */
    public $source = '';

    /**
     * The language to use when highlighting
     * @var string
     */
    public $language = '';

    /**
     * The data for the language used
     * @var array
     */
    public $language_data = array();

    /**
     * The path to the language files
     * @var string
     */
    public $language_path = GESHI_LANG_ROOT;

    /**
     * The error message associated with an error
     * @var string
     */
    public $error = false;

    /**
     * Possible error messages
     * @var array
     */
    public $error_messages = array(
        GESHI_ERROR_NO_SUCH_LANG => 'GeSHi could not find the language {LANGUAGE} (using path {PATH})',
        GESHI_ERROR_FILE_NOT_READABLE => 'The file specified for load_from_file was not readable',
        GESHI_ERROR_INVALID_HEADER_TYPE => 'The header type specified is invalid',
        GESHI_ERROR_INVALID_LINE_NUMBER_TYPE => 'The line number type specified is invalid'
    );

    /**
     * Whether highlighting is strict or not
     * @var boolean
     */
    public $strict_mode = false;

    /**
     * Whether to use CSS classes in output
     * @var boolean
     */
    public $use_classes = false;

    /**
     * The type of header to use
     * @var int
     */
    public $header_type = GESHI_HEADER_PRE;

    /**
     * Array of permissions for which lexics should be highlighted
     * @var array
     */
    public $lexic_permissions = array(
        'KEYWORDS'   => array(),
        'COMMENTS'   => array('MULTI' => true),
        'REGEXPS'    => array(),
        'ESCAPE_CHAR'=> true,
        'BRACKETS'   => true,
        'SYMBOLS'    => true,
        'STRINGS'    => true,
        'NUMBERS'    => true,
        'METHODS'    => true,
        'SCRIPT'     => true
    );

    /**
     * The time it took to parse the code
     * @var double
     */
    public $time = 0;

    /**
     * The content of the header block
     * @var string
     */
    public $header_content = '';

    /**
     * The content of the footer block
     * @var string
     */
    public $footer_content = '';

    /**
     * The style of the header block
     * @var string
     */
    public $header_content_style = '';

    /**
     * The style of the footer block
     * @var string
     */
    public $footer_content_style = '';

    /**
     * Force block around highlighted source
     * @var boolean
     */
    public $force_code_block = false;

    /**
     * The styles for hyperlinks in the code
     * @var array
     */
    public $link_styles = array();

    /**
     * Whether important blocks should be recognised or not
     * @var boolean
     * @deprecated
     * @todo REMOVE THIS FUNCTIONALITY!
     */
    public $enable_important_blocks = false;

    /**
     * Styles for important parts of the code
     * @var string
     * @deprecated
     * @todo As above - rethink the whole idea of important blocks as it is buggy and
     * will be hard to implement in 1.2
     */
    public $important_styles = 'font-weight: bold; color: red;'; // Styles for important parts of the code

    /**
     * Whether CSS IDs should be added to the code
     * @var boolean
     */
    public $add_ids = false;

    /**
     * Lines that should be highlighted extra
     * @var array
     */
    public $highlight_extra_lines = array();

    /**
     * Styles of extra-highlighted lines
     * @var string
     */
    public $highlight_extra_lines_style = 'color: #cc0; background-color: #ffc;';

	/**
	 * The line ending
	 * If null, nl2br() will be used on the result string.
	 * Otherwise, all instances of \n will be replaced with $line_ending
	 * @var string
	 */
	public $line_ending = null;

    /**
     * Number at which line numbers should start at
     * @var int
     */
    public $line_numbers_start = 1;

    /**
     * The overall style for this code block
     * @var string
     */
    public $overall_style = '';

    /**
     * The style for the actual code
     * @var string
     */
    public $code_style = 'font-family: \'Courier New\', Courier, monospace; font-weight: normal;';

    /**
     * The overall class for this code block
     * @var string
     */
    public $overall_class = '';

    /**
     * The overall ID for this code block
     * @var string
     */
    public $overall_id = '';

    /**
     * Line number styles
     * @var string
     */
//    public $line_style1 = 'font-family: \'Courier New\', Courier, monospace; color: black; font-weight: normal; font-style: normal;';
    public $line_style1 = '';

    /**
     * Line number styles for fancy lines
     * @var string
     */
//    public $line_style2 = 'font-weight: bold;';
    public $line_style2 = '';

    /**
     * Flag for how line numbers are displayed
     * @var boolean
     */
    public $line_numbers = GESHI_NO_LINE_NUMBERS;

    /**
     * The "nth" value for fancy line highlighting
     * @var int
     */
    public $line_nth_row = 0;

    /**
     * The size of tab stops
     * @var int
     */
    public $tab_width = 8;

	/**
	 * Should we use language-defined tab stop widths?
	 * @var boolean
	 */
	public $use_language_tab_width = false;

    /**
     * Default target for keyword links
     * @var string
     */
    public $link_target = '';

    /**
     * The encoding to use for entity encoding
     * NOTE: no longer used
     * @var string
     */
    public $encoding = 'ISO-8859-1';

    /**
     * Should keywords be linked?
     * @var boolean
     */
    public $keyword_links = true;

    /**#@-*/

    /**
     * Creates a new GeSHi object, with source and language
     *
     * @param string $source
     * @param string $language
     * @param string $path
     * @since 1.0.0
     */
    public function __construct($source, $language, $path = '')
    {
        $this->set_source($source);
        $this->set_language_path($path);
        $this->set_language($language);
    }

    /**
     * Returns an error message associated with the last GeSHi operation
     *
     * @return string|false
     * @since 1.0.0
     */
    public function error()
    {
        if ($this->error)
        {
            $msg = $this->error_messages[$this->error];
            $debug_tpl_vars = array(
                '{LANGUAGE}' => $this->language,
                '{PATH}' => $this->language_path
            );

            foreach ($debug_tpl_vars as $tpl => $var)
            {
                $msg = str_replace($tpl, $var, $msg);
            }

            return "<br /><strong>GeSHi Error:</strong> $msg (code $this->error)<br />";
        }

        return false;
    }

    /**
     * Gets a human-readable language name
     *
     * @return string
     * @since 1.0.2
     */
    public function get_language_name()
    {
        if (GESHI_ERROR_NO_SUCH_LANG == $this->error)
        {
            return $this->language_data['LANG_NAME'] . ' (Unknown Language)';
        }

        return $this->language_data['LANG_NAME'];
    }

    /**
     * Sets the source code for this object
     *
     * @param string $source
     * @since 1.0.0
     */
    public function set_source($source)
    {
        $this->source = $source;
        $this->highlight_extra_lines = array();
    }

    /**
     * Sets the language for this object
     *
     * @param string $language
     * @since 1.0.0
     */
    public function set_language($language)
    {
        $this->error = false;
        $this->strict_mode = GESHI_NEVER;

        $language = preg_replace('#[^a-zA-Z0-9\-_]#', '', $language);
        $this->language = strtolower($language);

        $file_name = $this->language_path . $this->language . '.php';

        if (!is_readable($file_name))
        {
            $this->error = GESHI_ERROR_NO_SUCH_LANG;
            return;
        }

        // Load the language for parsing
        $this->load_language($file_name);
    }

    /**
     * Sets the path to the directory containing the language files
     *
     * @param string $path
     * @since 1.0.0
     */
    public function set_language_path($path)
    {
        if ($path)
        {
            $this->language_path = ('/' == substr($path, strlen($path) - 1, 1))
                ? $path
                : $path . '/';

            // otherwise set_language_path has no effect
            $this->set_language($this->language);
        }
    }

    /**
     * Sets the type of header to be used
     *
     * @param int $type
     * @since 1.0.0
     */
    public function set_header_type($type)
    {
        if (
            GESHI_HEADER_DIV != $type
            && GESHI_HEADER_PRE != $type
            && GESHI_HEADER_NONE != $type
        )
        {
            $this->error = GESHI_ERROR_INVALID_HEADER_TYPE;
            return;
        }

        $this->header_type = $type;

        // Set a default overall style if the header is a <div>
        if (GESHI_HEADER_DIV == $type && !$this->overall_style)
        {
            $this->overall_style = 'font-family: monospace;';
        }
    }

    /**
     * Sets the styles for the code that will be outputted
     * when this object is parsed.
     *
     * @param string  $style
     * @param boolean $preserve_defaults
     * @since 1.0.0
     */
    public function set_overall_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->overall_style = $style;
        }
        else
        {
            $this->overall_style .= $style;
        }
    }

    /**
     * Sets the overall classname for this block of code
     *
     * @param string $class
     * @since 1.0.0
     */
    public function set_overall_class($class)
    {
        $this->overall_class = $class;
    }

    /**
     * Sets the overall id for this block of code
     *
     * @param string $id
     * @since 1.0.0
     */
    public function set_overall_id($id)
    {
        $this->overall_id = $id;
    }

    /**
     * Sets whether CSS classes should be used
     *
     * @param boolean $flag
     * @since 1.0.0
     */
    public function enable_classes($flag = true)
    {
        $this->use_classes = ($flag) ? true : false;
    }

    /**
     * Sets the style for the actual code
     *
     * @param string  $style
     * @param boolean $preserve_defaults
     */
    public function set_code_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->code_style = $style;
        }
        else
        {
            $this->code_style .= $style;
        }
    }

    /**
     * Sets the styles for the line numbers
     *
     * @param string         $style1
     * @param string|boolean $style2
     * @param boolean        $preserve_defaults
     * @since 1.0.2
     */
    public function set_line_style($style1, $style2 = '', $preserve_defaults = false)
    {
        if (is_bool($style2))
        {
            $preserve_defaults = $style2;
            $style2 = '';
        }

        if (!$preserve_defaults)
        {
            $this->line_style1 = $style1;
            $this->line_style2 = $style2;
        }
        else
        {
            $this->line_style1 .= $style1;
            $this->line_style2 .= $style2;
        }
    }

    /**
     * Sets whether line numbers should be displayed
     *
     * @param int $flag
     * @param int $nth_row
     * @since 1.0.0
     */
    public function enable_line_numbers($flag, $nth_row = 5)
    {
        if (
            GESHI_NO_LINE_NUMBERS != $flag
            && GESHI_NORMAL_LINE_NUMBERS != $flag
            && GESHI_FANCY_LINE_NUMBERS != $flag
        )
        {
            $this->error = GESHI_ERROR_INVALID_LINE_NUMBER_TYPE;
        }

        $this->line_numbers = $flag;
        $this->line_nth_row = $nth_row;
    }

    /**
     * Sets the style for a keyword group
     *
     * @param int     $key
     * @param string  $style
     * @param boolean $preserve_defaults
     * @since 1.0.0
     */
    public function set_keyword_group_style($key, $style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['KEYWORDS'][$key] = $style;
        }
        else
        {
            $this->language_data['STYLES']['KEYWORDS'][$key] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for a keyword group
     *
     * @param int     $key
     * @param boolean $flag
     * @since 1.0.0
     */
    public function set_keyword_group_highlighting($key, $flag = true)
    {
        $this->lexic_permissions['KEYWORDS'][$key] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for comment groups
     *
     * @param int     $key
     * @param string  $style
     * @param boolean $preserve_defaults
     * @since 1.0.0
     */
    public function set_comments_style($key, $style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['COMMENTS'][$key] = $style;
        }
        else
        {
            $this->language_data['STYLES']['COMMENTS'][$key] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for comment groups
     *
     * @param int     $key
     * @param boolean $flag
     * @since 1.0.0
     */
    public function set_comments_highlighting($key, $flag = true)
    {
        $this->lexic_permissions['COMMENTS'][$key] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for escaped characters
     *
     * @param string  $style
     * @param boolean $preserve_defaults
     * @since 1.0.0
     */
    public function set_escape_characters_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['ESCAPE_CHAR'][0] = $style;
        }
        else
        {
            $this->language_data['STYLES']['ESCAPE_CHAR'][0] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for escaped characters
     *
     * @param boolean $flag
     * @since 1.0.0
     */
    public function set_escape_characters_highlighting($flag = true)
    {
        $this->lexic_permissions['ESCAPE_CHAR'] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for brackets
     *
     * @param string  $style
     * @param boolean $preserve_defaults
     * @since 1.0.0
     * @deprecated In favour of set_symbols_style
     */
    public function set_brackets_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['BRACKETS'][0] = $style;
        }
        else
        {
            $this->language_data['STYLES']['BRACKETS'][0] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for brackets
     *
     * @deprecated In favour of set_symbols_highlighting
     */
    public function set_brackets_highlighting($flag)
    {
        $this->lexic_permissions['BRACKETS'] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for symbols
     *
     * @since 1.0.1
     */
    public function set_symbols_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['SYMBOLS'][0] = $style;
        }
        else
        {
            $this->language_data['STYLES']['SYMBOLS'][0] .= $style;
        }

        // For backward compatibility
        $this->set_brackets_style($style, $preserve_defaults);
    }

    /**
     * Turns highlighting on/off for symbols
     *
     * @since 1.0.0
     */
    public function set_symbols_highlighting($flag)
    {
        $this->lexic_permissions['SYMBOLS'] = ($flag) ? true : false;

        // For backward compatibility
        $this->set_brackets_highlighting($flag);
    }

    /**
     * Sets the styles for strings
     *
     * @since 1.0.0
     */
    public function set_strings_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['STRINGS'][0] = $style;
        }
        else
        {
            $this->language_data['STYLES']['STRINGS'][0] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for strings
     *
     * @since 1.0.0
     */
    public function set_strings_highlighting($flag)
    {
        $this->lexic_permissions['STRINGS'] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for numbers
     *
     * @since 1.0.0
     */
    public function set_numbers_style($style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['NUMBERS'][0] = $style;
        }
        else
        {
            $this->language_data['STYLES']['NUMBERS'][0] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for numbers
     *
     * @since 1.0.0
     */
    public function set_numbers_highlighting($flag)
    {
        $this->lexic_permissions['NUMBERS'] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for methods
     *
     * @since 1.0.0
     */
    public function set_methods_style($key, $style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['METHODS'][$key] = $style;
        }
        else
        {
            $this->language_data['STYLES']['METHODS'][$key] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for methods
     *
     * @since 1.0.0
     */
    public function set_methods_highlighting($flag)
    {
        $this->lexic_permissions['METHODS'] = ($flag) ? true : false;
    }

    /**
     * Sets the styles for regexps
     *
     * @since 1.0.0
     */
    public function set_regexps_style($key, $style, $preserve_defaults = false)
    {
        if (!$preserve_defaults)
        {
            $this->language_data['STYLES']['REGEXPS'][$key] = $style;
        }
        else
        {
            $this->language_data['STYLES']['REGEXPS'][$key] .= $style;
        }
    }

    /**
     * Turns highlighting on/off for regexps
     *
     * @param int     The key of the regular expression group to turn on or off
     * @param boolean Whether to turn highlighting for the regular expression group on or off
     * @since 1.0.0
     */
    function set_regexps_highlighting($key, $flag) {
        $this->lexic_permissions['REGEXPS'][$key] = ($flag) ? true : false;
    }

    /**
     * Sets whether a set of keywords are checked for in a case sensitive manner
     *
     * @param int The key of the keyword group to change the case sensitivity of
     * @param boolean Whether to check in a case sensitive manner or not
     * @since 1.0.0
     */
    function set_case_sensitivity($key, $case) {
        $this->language_data['CASE_SENSITIVE'][$key] = ($case) ? true : false;
    }

    /**
     * Sets the case that keywords should use when found. Use the constants:
     *
     *  - GESHI_CAPS_NO_CHANGE: leave keywords as-is
     *  - GESHI_CAPS_UPPER: convert all keywords to uppercase where found
     *  - GESHI_CAPS_LOWER: convert all keywords to lowercase where found
     *
     * @param int A constant specifying what to do with matched keywords
     * @since 1.0.1
     * @todo  Error check the passed value
     */
    function set_case_keywords($case) {
        $this->language_data['CASE_KEYWORDS'] = $case;
    }

    /**
     * Sets how many spaces a tab is substituted for
     *
     * Widths below zero are ignored
     *
     * @param int The tab width
     * @since 1.0.0
     */
    function set_tab_width($width) {
        $this->tab_width = intval($width);
        //Check if it fit's the constraints:
        if ($this->tab_width < 1) {
            //Return it to the default
            $this->tab_width = 8;
        }
    }

	/**
	 * Sets whether or not to use tab-stop width specifed by language
	 *
	 * @param boolean Whether to use language-specific tab-stop widths
	 */
	function set_use_language_tab_width($use) {
		$this->use_language_tab_width = (bool) $use;
	}

	/**
	 * Returns the tab width to use, based on the current language and user
	 * preference
	 *
	 * @return int Tab width
	 */
	function get_real_tab_width() {
		if (!$this->use_language_tab_width || !isset($this->language_data['TAB_WIDTH'])) {
			return $this->tab_width;
		} else {
			return $this->language_data['TAB_WIDTH'];
		}
	}

    /**
     * Enables/disables strict highlighting. Default is off, calling this
     * method without parameters will turn it on. See documentation
     * for more details on strict mode and where to use it.
     *
     * @param boolean Whether to enable strict mode or not
     * @since 1.0.0
     */
    function enable_strict_mode($mode = true) {
        if (GESHI_MAYBE == $this->language_data['STRICT_MODE_APPLIES']) {
            $this->strict_mode = ($mode) ? true : false;
        }
    }

    /**
     * Disables all highlighting
     *
     * @since 1.0.0
     * @todo Rewrite with an array traversal
     */
    function disable_highlighting() {
        foreach ($this->lexic_permissions as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $this->lexic_permissions[$key][$k] = false;
                }
            }
            else {
                $this->lexic_permissions[$key] = false;
            }
        }
        // Context blocks
        $this->enable_important_blocks = false;
    }

    /**
     * Enables all highlighting
     *
     * @since 1.0.0
     * @todo  Rewrite with an array traversal
     */
    function enable_highlighting() {
        foreach ($this->lexic_permissions as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $this->lexic_permissions[$key][$k] = true;
                }
            }
            else {
                $this->lexic_permissions[$key] = true;
            }
        }
        // Context blocks
        $this->enable_important_blocks = true;
    }

    /**
     * Given a file extension, this method returns either a valid geshi language
     * name, or the empty string if it couldn't be found
     *
     * @param string The extension to get a language name for
     * @param array  A lookup array to use instead of the default
     * @since 1.0.5
     * @todo Re-think about how this method works (maybe make it private and/or make it
     *       a extension->lang lookup?)
     * @todo static?
     */
    function get_language_name_from_extension($extension, $lookup = array()) {
        if (!$lookup) {
            $lookup = array(
                'actionscript' => array('as'),
                'ada' => array('a', 'ada', 'adb', 'ads'),
                'apache' => array('conf'),
                'asm' => array('ash', 'asm'),
                'asp' => array('asp'),
                'bash' => array('sh'),
                'c' => array('c', 'h'),
                'c_mac' => array('c', 'h'),
                'caddcl' => array(),
                'cadlisp' => array(),
                'cdfg' => array('cdfg'),
                'cpp' => array('cpp', 'h', 'hpp'),
                'csharp' => array(),
                'css' => array('css'),
                'delphi' => array('dpk', 'dpr'),
                'html' => array('html', 'htm'),
                'java' => array('java'),
                'js' => array('js'),
                'lisp' => array('lisp'),
                'lua' => array('lua'),
                'mpasm' => array(),
                'nsis' => array(),
                'objc' => array(),
                'oobas' => array(),
                'oracle8' => array(),
                'pascal' => array('pas'),
                'perl' => array('pl', 'pm'),
                'php' => array('php', 'php5', 'phtml', 'phps'),
                'python' => array('py'),
                'qbasic' => array('bi'),
                'sas' => array('sas'),
                'smarty' => array(),
                'vb' => array('bas'),
                'vbnet' => array(),
                'visualfoxpro' => array(),
                'xml' => array('xml'),
				'xsl' => array('xsl', 'xslt'),
            );
        }

        foreach ($lookup as $lang => $extensions) {
            foreach ($extensions as $ext) {
                if ($ext === $extension) {
                    return $lang;
                }
            }
        }

        return '';
    }

    /**
     * Given a file name, this method loads its contents in, and attempts
     * to set the language automatically. An optional lookup table can be
     * passed for looking up the language name. If not specified a default
     * table is used
     *
     * The language table is in the form
     * <pre>array(
     *   'lang_name' => array('extension', 'extension', ...),
     *   'lang_name' ...
     * );</pre>
     *
     * @todo Complete rethink of this and above method
     * @since 1.0.5
     */
    function load_from_file($file_name, $lookup = array()) {
        if (is_readable($file_name)) {
            $contents = file_get_contents($file_name);

            if ($contents === false) {
                $this->error = GESHI_ERROR_FILE_NOT_READABLE;
                return;
            }

            $this->set_source($contents);

            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $this->set_language(
                $this->get_language_name_from_extension($extension, $lookup)
            );
        }
        else {
            $this->error = GESHI_ERROR_FILE_NOT_READABLE;
        }
    }

    /**
     * Adds a keyword to a keyword group for highlighting
     *
     * @param int    The key of the keyword group to add the keyword to
     * @param string The word to add to the keyword group
     * @since 1.0.0
     */
    function add_keyword($key, $word) {
        $this->language_data['KEYWORDS'][$key][] = $word;
    }

    /**
     * Removes a keyword from a keyword group
     *
     * @param int    The key of the keyword group to remove the keyword from
     * @param string The word to remove from the keyword group
     * @since 1.0.0
     */
    function remove_keyword($key, $word) {
        $this->language_data['KEYWORDS'][$key] =
            array_diff($this->language_data['KEYWORDS'][$key], array($word));
    }

    /**
     * Creates a new keyword group
     *
     * @param int    The key of the keyword group to create
     * @param string The styles for the keyword group
     * @param boolean Whether the keyword group is case sensitive ornot
     * @param array  The words to use for the keyword group
     * @since 1.0.0
     */
    function add_keyword_group($key, $styles, $case_sensitive = true, $words = array()) {
        $words = (array) $words;
        $this->language_data['KEYWORDS'][$key] = $words;
        $this->lexic_permissions['KEYWORDS'][$key] = true;
        $this->language_data['CASE_SENSITIVE'][$key] = $case_sensitive;
        $this->language_data['STYLES']['KEYWORDS'][$key] = $styles;
    }

    /**
     * Removes a keyword group
     *
     * @param int    The key of the keyword group to remove
     * @since 1.0.0
     */
    function remove_keyword_group($key) {
        unset($this->language_data['KEYWORDS'][$key]);
        unset($this->lexic_permissions['KEYWORDS'][$key]);
        unset($this->language_data['CASE_SENSITIVE'][$key]);
        unset($this->language_data['STYLES']['KEYWORDS'][$key]);
    }

    /**
     * Sets the content of the header block
     *
     * @param string The content of the header block
     * @since 1.0.2
     */
    function set_header_content($content) {
        $this->header_content = $content;
    }

    /**
     * Sets the content of the footer block
     *
     * @param string The content of the footer block
     * @since 1.0.2
     */
    function set_footer_content($content) {
        $this->footer_content = $content;
    }

    /**
     * Sets the style for the header content
     *
     * @param string The style for the header content
     * @since 1.0.2
     */
    function set_header_content_style($style) {
        $this->header_content_style = $style;
    }

    /**
     * Sets the style for the footer content
     *
     * @param string The style for the footer content
     * @since 1.0.2
     */
    function set_footer_content_style($style) {
        $this->footer_content_style = $style;
    }

    /**
     * Sets whether to force a surrounding block around
     * the highlighted code or not
     *
     * @param boolean Tells whether to enable or disable this feature
     * @since 1.0.7.20
     */
    function enable_inner_code_block($flag) {
        $this->force_code_block = (bool) $flag;
    }

    /**
     * Sets the base URL to be used for keywords
     *
     * @param int The key of the keyword group to set the URL for
     * @param string The URL to set for the group. If {FNAME} is in
     *               the url somewhere, it is replaced by the keyword
     *               that the URL is being made for
     * @since 1.0.2
     */
    function set_url_for_keyword_group($group, $url) {
        $this->language_data['URLS'][$group] = $url;
    }

    /**
     * Sets styles for links in code
     *
     * @param int A constant that specifies what state the style is being
     *            set for - e.g. :hover or :visited
     * @param string The styles to use for that state
     * @since 1.0.2
     */
    function set_link_styles($type, $styles) {
        $this->link_styles[$type] = $styles;
    }

    /**
     * Sets the target for links in code
     *
     * @param string The target for links in the code, e.g. _blank
     * @since 1.0.3
     */
    function set_link_target($target) {
        if (!$target) {
            $this->link_target = '';
        }
        else {
            $this->link_target = ' target="' . $target . '" ';
        }
    }

    /**
     * Sets styles for important parts of the code
     *
     * @param string The styles to use on important parts of the code
     * @since 1.0.2
     */
    function set_important_styles($styles) {
        $this->important_styles = $styles;
    }

    /**
     * Sets whether context-important blocks are highlighted
     *
     * @todo REMOVE THIS SHIZ FROM GESHI!
     * @deprecated
     */
    function enable_important_blocks($flag) {
        $this->enable_important_blocks = ($flag) ? true : false;
    }

    /**
     * Whether CSS IDs should be added to each line
     *
     * @param boolean If true, IDs will be added to each line.
     * @since 1.0.2
     */
    function enable_ids($flag = true) {
        $this->add_ids = ($flag) ? true : false;
    }

    /**
     * Specifies which lines to highlight extra
     *
     * @param mixed An array of line numbers to highlight, or just a line
     *              number on its own.
     * @since 1.0.2
     * @todo  Some data replication here that could be cut down on
     */
    function highlight_lines_extra($lines) {
        if (is_array($lines)) {
            foreach ($lines as $line) {
                $this->highlight_extra_lines[(int) $line] = (int) $line;
            }
        } else {
            $this->highlight_extra_lines[(int) $lines] = (int) $lines;
        }
    }

    /**
     * Sets the style for extra-highlighted lines
     *
     * @param string The style for extra-highlighted lines
     * @since 1.0.2
     */
    function set_highlight_lines_extra_style($styles) {
        $this->highlight_extra_lines_style = $styles;
    }

    /**
     * Sets the line-ending
     *
     * @param string The new line-ending
     */
    function set_line_ending($line_ending) {
        $this->line_ending = (string) $line_ending;
    }

    /**
     * Sets what number line numbers should start at.
     *
     * @param int The number to start line numbers at
     * @since 1.0.2
     */
    function start_line_numbers_at($number) {
        $this->line_numbers_start = abs((int) $number);
    }

    /**
     * Sets the encoding used for htmlspecialchars()
     *
     * @param string The encoding to use for the source
     * @since 1.0.3
     */
    function set_encoding($encoding) {
        if ($encoding) {
            $this->encoding = $encoding;
        }
    }

    /**
     * Turns linking of keywords on or off.
     *
     * @param boolean If true, links will be added to keywords
     */
    function enable_keyword_links($enable = true) {
        $this->keyword_links = ($enable) ? true : false;
    }

    /**
     * Returns the code in $this->source, highlighted and surrounded by the
     * necessary HTML.
     *
     * @since 1.0.0
     */
    function parse_code() {
        // Start the timer
        $start_time = microtime(true);

        // If there is an error, we won't highlight
        if ($this->error) {
            $result = GeSHi::hsc($this->source);
            $this->set_time($start_time, $start_time);
            return $this->finalise($result);
        }

        // Normalize line endings
        $code = str_replace("\r\n", "\n", $this->source);
        $code = str_replace("\r", "\n", $code);

        // Add padding for regex matching and line numbering
        $code = "\n" . $code . "\n";

        // Initialise parser state
        $length = strlen($code);
        $STRING_OPEN = '';
        $CLOSE_STRING = false;
        $ESCAPE_CHAR_OPEN = false;
        $COMMENT_MATCHED = false;
        $HIGHLIGHTING_ON = (!$this->strict_mode) ? true : '';
        $HIGHLIGHT_INSIDE_STRICT = false;
        $HARDQUOTE_OPEN = false;
        $STRICTATTRS = '';
        $stuff_to_parse = '';
        $result = '';

        // Important blocks
        if ($this->enable_important_blocks) {
            if (!isset($this->language_data['COMMENT_MULTI'])) {
                $this->language_data['COMMENT_MULTI'] = array();
            }

            $this->language_data['COMMENT_MULTI'][GESHI_START_IMPORTANT] = GESHI_END_IMPORTANT;
        }

        if ($this->strict_mode) {
            $parts = array(
                0 => array(
                    0 => '',
                    1 => ''
                )
            );

            $k = 0;

            for ($i = 0; $i < $length; $i++) {
                $char = substr($code, $i, 1);

                if (!$HIGHLIGHTING_ON) {
                    if (!empty($this->language_data['SCRIPT_DELIMITERS'])) {
                        foreach ($this->language_data['SCRIPT_DELIMITERS'] as $key => $delimiters) {
                            foreach ($delimiters as $open => $close) {
                                $check = substr($code, $i, strlen($open));

                                if ($check === $open) {
                                    $HIGHLIGHTING_ON = $open;
                                    $i += strlen($open) - 1;
                                    $char = $open;

                                    $parts[++$k][0] = $char;
                                    $parts[$k][1] = '';

                                    break 2;
                                }
                            }
                        }
                    }
                } else {
                    $close = '';

                    if (!empty($this->language_data['SCRIPT_DELIMITERS'])) {
                        foreach ($this->language_data['SCRIPT_DELIMITERS'] as $key => $delimiters) {
                            foreach ($delimiters as $open => $close_delim) {
                                if ($open === $HIGHLIGHTING_ON) {
                                    $close = $close_delim;
                                    break 2;
                                }
                            }
                        }
                    }

                    if ($close !== '') {
                        $check = substr(
                            $code,
                            $i - strlen($close) + 1,
                            strlen($close)
                        );

                        if ($check === $close) {
                            $HIGHLIGHTING_ON = '';

                            $parts[$k][1] .= $char;

                            $parts[++$k] = array(
                                0 => '',
                                1 => ''
                            );

                            $char = '';
                        }
                    }
                }

                if (!isset($parts[$k][1])) {
                    $parts[$k][1] = '';
                }

                $parts[$k][1] .= $char;
            }

            $HIGHLIGHTING_ON = '';
        } else {
            $parts = array(
                1 => array(
                    0 => '',
                    1 => $code
                )
            );
        }

        // Now we go through each part. We know that even-indexed parts are
        // code that shouldn't be highlighted, and odd-indexed parts should
        // be highlighted
        foreach ($parts as $key => $data) {
            $part = isset($data[1]) ? $data[1] : '';

            // If this block should be highlighted...
            if ($key % 2) {

                $script_key = null;

                if ($this->strict_mode) {
                    // Find the class key for this block of code
                    if (!empty($this->language_data['SCRIPT_DELIMITERS'])) {
                        foreach ($this->language_data['SCRIPT_DELIMITERS'] as $tmp_script_key => $script_data) {
                            foreach ($script_data as $open => $close) {
                                if ($data[0] == $open) {
                                    $script_key = $tmp_script_key;
                                    break 2;
                                }
                            }
                        }
                    }

                    if ($script_key !== null
                        && isset($this->language_data['STYLES']['SCRIPT'][$script_key])
                        && $this->language_data['STYLES']['SCRIPT'][$script_key] != ''
                        && !empty($this->lexic_permissions['SCRIPT'])) {

                        if (!$this->use_classes) {
                            $attributes = ' style="' . $this->language_data['STYLES']['SCRIPT'][$script_key] . '"';
                        } else {
                            $attributes = ' class="sc' . $script_key . '"';
                        }

                        $result .= "<span$attributes>";
                        $STRICTATTRS = $attributes;
                    }
                }

                if (
                    !$this->strict_mode
                    || (
                        $script_key !== null
                        && !empty($this->language_data['HIGHLIGHT_STRICT_BLOCK'][$script_key])
                    )
                ) {
                    $length = strlen($part);

                    for ($i = 0; $i < $length; $i++) {
                        $char = substr($part, $i, 1);

                        $hq = isset($this->language_data['HARDQUOTE'])
                            ? $this->language_data['HARDQUOTE'][0]
                            : false;

                        if (
                            ($this->line_numbers != GESHI_NO_LINE_NUMBERS
                            || count($this->highlight_extra_lines) > 0)
                            && $char == "\n"
                        ) {
                            if ($STRING_OPEN) {
                                if (!$this->use_classes) {
                                    $attributes = ' style="' . $this->language_data['STYLES']['STRINGS'][0] . '"';
                                } else {
                                    $attributes = ' class="st0"';
                                }

                                $char = '</span>' . $char . "<span$attributes>";
                            }
                        }
                        else if ($char == $STRING_OPEN) {
                            if (
                                (!empty($this->lexic_permissions['ESCAPE_CHAR']) && $ESCAPE_CHAR_OPEN)
                                || (!empty($this->lexic_permissions['STRINGS']) && !$ESCAPE_CHAR_OPEN)
                            ) {
                                $char = GeSHi::hsc($char) . '</span>';
                            }

                            $escape_me = false;

                            if ($HARDQUOTE_OPEN) {
                                if ($ESCAPE_CHAR_OPEN) {
                                    $escape_me = true;
                                }
                                else if (!empty($this->language_data['HARDESCAPE'])) {
                                    foreach ($this->language_data['HARDESCAPE'] as $hardesc) {
                                        if (substr($part, $i, strlen($hardesc)) == $hardesc) {
                                            $escape_me = true;
                                            break;
                                        }
                                    }
                                }
                            }

                            if (!$ESCAPE_CHAR_OPEN) {
                                $STRING_OPEN = '';
                                $CLOSE_STRING = true;
                            }

                            if (!$escape_me) {
                                $HARDQUOTE_OPEN = false;
                            }

                            $ESCAPE_CHAR_OPEN = false;
                        }
                        else if (
                            !empty($this->language_data['QUOTEMARKS'])
                            && in_array($char, $this->language_data['QUOTEMARKS'])
                            && $STRING_OPEN == ''
                            && !empty($this->lexic_permissions['STRINGS'])
                        ) {
                            $STRING_OPEN = $char;

                            if (!$this->use_classes) {
                                $attributes = ' style="' . $this->language_data['STYLES']['STRINGS'][0] . '"';
                            } else {
                                $attributes = ' class="st0"';
                            }

                            $char = "<span$attributes>" . GeSHi::hsc($char);

                            $result .= $this->parse_non_string_part($stuff_to_parse);
                            $stuff_to_parse = '';
                        }
                        else if (
                            $hq
                            && substr($part, $i, strlen($hq)) == $hq
                            && $STRING_OPEN == ''
                            && !empty($this->lexic_permissions['STRINGS'])
                        ) {
                            $STRING_OPEN = $this->language_data['HARDQUOTE'][1];

                            if (!$this->use_classes) {
                                $attributes = ' style="' . $this->language_data['STYLES']['STRINGS'][0] . '"';
                            } else {
                                $attributes = ' class="st0"';
                            }

                            $char = "<span$attributes>" . $hq;
                            $i += strlen($hq) - 1;
                            $HARDQUOTE_OPEN = true;

                            $result .= $this->parse_non_string_part($stuff_to_parse);
                            $stuff_to_parse = '';
                        }
                        else if (
                            isset($this->language_data['ESCAPE_CHAR'])
                            && $char == $this->language_data['ESCAPE_CHAR']
                            && $STRING_OPEN != ''
                        ) {
                            if (!$ESCAPE_CHAR_OPEN) {
                                $ESCAPE_CHAR_OPEN = !$HARDQUOTE_OPEN;

                                if ($HARDQUOTE_OPEN && !empty($this->language_data['HARDESCAPE'])) {
                                    foreach ($this->language_data['HARDESCAPE'] as $hard) {
                                        if (substr($part, $i, strlen($hard)) == $hard) {
                                            $ESCAPE_CHAR_OPEN = true;
                                            break;
                                        }
                                    }
                                }

                                if ($ESCAPE_CHAR_OPEN && !empty($this->lexic_permissions['ESCAPE_CHAR'])) {
                                    if (!$this->use_classes) {
                                        $attributes = ' style="' . $this->language_data['STYLES']['ESCAPE_CHAR'][0] . '"';
                                    } else {
                                        $attributes = ' class="es0"';
                                    }

                                    $char = "<span$attributes>" . $char;

                                    // FIXED: use $part not $code
                                    if (substr($part, $i + 1, 1) == "\n") {
                                        $char .= '</span>';
                                        $ESCAPE_CHAR_OPEN = false;
                                    }
                                }
                            } else {
                                $ESCAPE_CHAR_OPEN = false;

                                if (!empty($this->lexic_permissions['ESCAPE_CHAR'])) {
                                    $char .= '</span>';
                                }
                            }
                        }
                        else if ($ESCAPE_CHAR_OPEN) {
                            if (!empty($this->lexic_permissions['ESCAPE_CHAR'])) {
                                $char .= '</span>';
                            }

                            $ESCAPE_CHAR_OPEN = false;
                            $test_str = $char;
                        }
                        else if ($STRING_OPEN == '') {
                            if (!empty($this->language_data['COMMENT_MULTI'])) {
                                foreach ($this->language_data['COMMENT_MULTI'] as $open => $close) {
                                    $com_len = strlen($open);
                                    $test_str = substr($part, $i, $com_len);
                                    $test_str_match = $test_str;

                                    if ($open == $test_str) {
                                        $COMMENT_MATCHED = true;

                                        if (
                                            !empty($this->lexic_permissions['COMMENTS']['MULTI'])
                                            || $test_str == GESHI_START_IMPORTANT
                                        ) {
                                            if ($test_str != GESHI_START_IMPORTANT) {
                                                if (!$this->use_classes) {
                                                    $attributes = ' style="' . $this->language_data['STYLES']['COMMENTS']['MULTI'] . '"';
                                                } else {
                                                    $attributes = ' class="coMULTI"';
                                                }

                                                $test_str = "<span$attributes>" . GeSHi::hsc($test_str);
                                            } else {
                                                if (!$this->use_classes) {
                                                    $attributes = ' style="' . $this->important_styles . '"';
                                                } else {
                                                    $attributes = ' class="imp"';
                                                }

                                                $test_str = "<span$attributes>";
                                            }
                                        }
                                        else {
                                            $test_str = GeSHi::hsc($test_str);
                                        }

                                        $close_pos = strpos($part, $close, $i + strlen($close));

                                        $oops = false;

                                        if ($close_pos === false) {
                                            $close_pos = strlen($part);
                                            $oops = true;
                                        } else {
                                            $close_pos -= ($com_len - strlen($close));
                                        }

                                        $rest_of_comment = GeSHi::hsc(
                                            substr($part, $i + $com_len, $close_pos - $i)
                                        );

                                        $test_str .= $rest_of_comment;

                                        if (
                                            !empty($this->lexic_permissions['COMMENTS']['MULTI'])
                                            || $test_str_match == GESHI_START_IMPORTANT
                                        ) {
                                            $test_str .= '</span>';

                                            if ($oops) {
                                                $test_str .= "\n";
                                            }
                                        }

                                        $i = $close_pos + $com_len - 1;

                                        $result .= $this->parse_non_string_part($stuff_to_parse);
                                        $stuff_to_parse = '';

                                        break;
                                    }
                                }
                            }
                        }

                        if (!$COMMENT_MATCHED) {
                            if ($STRING_OPEN == '' && !$CLOSE_STRING) {
                                $stuff_to_parse .= $char;
                            } else {
                                $result .= $char;
                                $CLOSE_STRING = false;
                            }
                        } else {
                            $result .= $test_str;
                            $COMMENT_MATCHED = false;
                        }
                    }

                    $result .= $this->parse_non_string_part($stuff_to_parse);
                    $stuff_to_parse = '';
                }
                else {
                    if ($STRICTATTRS != '') {
                        $part = str_replace(
                            "\n",
                            "</span>\n<span$STRICTATTRS>",
                            GeSHi::hsc($part)
                        );

                        $STRICTATTRS = '';
                    }

                    $result .= $part;
                }

                if (
                    $this->strict_mode
                    && $script_key !== null
                    && isset($this->language_data['STYLES']['SCRIPT'][$script_key])
                    && $this->language_data['STYLES']['SCRIPT'][$script_key] != ''
                    && !empty($this->lexic_permissions['SCRIPT'])
                ) {
                    $result .= '</span>';
                }
            }
            else {
                $result .= GeSHi::hsc($part);
            }
        }

        // Parse the last stuff (redundant?)
        $result .= $this->parse_non_string_part($stuff_to_parse);

        // Lop off the very first and last spaces
        $result = substr($result, 1, -1);

        // Are we still in a string?
        if ($STRING_OPEN) {
            $result .= '</span>';
        }

        // We're finished: stop timing
        $this->set_time($start_time, microtime(true));

        return $this->finalise($result);
    }

    /**
     * Swaps out spaces and tabs for HTML indentation. Not needed if
     * the code is in a pre block...
     *
     * @param  string The source to indent
     * @return string The source with HTML indenting applied
     * @since  1.0.0
     * @access private
     */
	function indent($result) {
		// Replace tabs with the correct number of spaces
		if (false !== strpos($result, "\t")) {
			$lines = explode("\n", $result);
			$tab_width = $this->get_real_tab_width();

			foreach ($lines as $key => $line) {
				if (false === strpos($line, "\t")) {
					$lines[$key] = $line;
					continue;
				}

				$pos = 0;
				$length = strlen($line);
				$result_line = '';

				$IN_TAG = false;

				for ($i = 0; $i < $length; $i++) {
					$char = $line[$i];

					// Detect HTML tags
					if ($IN_TAG && $char === '>') {
						$IN_TAG = false;
						$result_line .= '>';
						++$pos;
					}
					elseif (!$IN_TAG && $char === '<') {
						$IN_TAG = true;
						$result_line .= '<';
						++$pos;
					}
					elseif (!$IN_TAG && $char === '&') {
						$substr = substr($line, $i + 3, 4);
						$posi = strpos($substr, ';');

						if ($posi !== false) {
							$pos += $posi + 3;
						}

						$result_line .= '&';
					}
					elseif (!$IN_TAG && $char === "\t") {
						$str = '';
						$strs = array(0 => '&nbsp;', 1 => ' ');

						$spaces = $tab_width - (($i - $pos) % $tab_width);

						for ($k = 0; $k < $spaces; $k++) {
							$str .= $strs[$k % 2];
						}

						$result_line .= $str;
						$pos += (($i - $pos) % $tab_width) + 1;

						if (strpos($line, "\t", $i + 1) === false) {
							$result_line .= substr($line, $i + 1);
							break;
						}
					}
					elseif ($IN_TAG) {
						++$pos;
						$result_line .= $char;
					}
					else {
						$result_line .= $char;
					}
				}

				$lines[$key] = $result_line;
			}

			$result = implode("\n", $lines);
		}

		// Other whitespace
		$result = str_replace("\n ", "\n&nbsp;", $result);
		$result = str_replace('  ', ' &nbsp;', $result);

		if ($this->line_numbers == GESHI_NO_LINE_NUMBERS) {
			if ($this->line_ending === null) {
				$result = nl2br($result);
			} else {
				$result = str_replace("\n", $this->line_ending, $result);
			}
		}

		return $result;
	}

     /**
     * Changes the case of a keyword for those languages where a change is asked for
     *
     * @param  string The keyword to change the case of
     * @return string The keyword with its case changed
     * @since  1.0.0
     * @access private
     */
    function change_case($instr) {
        if ($this->language_data['CASE_KEYWORDS'] == GESHI_CAPS_UPPER) {
            return strtoupper($instr);
        }
        else if ($this->language_data['CASE_KEYWORDS'] == GESHI_CAPS_LOWER) {
            return strtolower($instr);
        }
        return $instr;
    }

    /**
     * Adds a url to a keyword where needed.
     *
     * @param  string The keyword to add the URL HTML to
     * @param  int What group the keyword is from
     * @param  boolean Whether to get the HTML for the start or end
     * @return The HTML for either the start or end of the HTML &lt;a&gt; tag
     * @since  1.0.2
     * @access private
     * @todo   Get rid of ender
     */
    function add_url_to_keyword($keyword, $group, $start_or_end) {
        if (!$this->keyword_links) {
            // Keyword links have been disabled
            return;
        }

        if (isset($this->language_data['URLS'][$group]) &&
            $this->language_data['URLS'][$group] != '' &&
            substr($keyword, 0, 5) != '&lt;/') {
            // There is a base group for this keyword
            if ($start_or_end == 'BEGIN') {
                // HTML workaround... not good form (tm) but should work for 1.0.X
                if ($keyword != '') {
                    foreach ($this->language_data['KEYWORDS'][$group] as $word) {
                        if (strtolower($word) == strtolower($keyword)) {
                            break;
                        }
                    }
                    $word = (substr($word, 0, 4) == '&lt;') ? substr($word, 4) : $word;
                    $word = (substr($word, -4) == '&gt;') ? substr($word, 0, strlen($word) - 4) : $word;
                    if (!$word) {
                        return '';
                    }

                    return '<|UR1|"' .
                        str_replace(
                            array('{FNAME}', '.'),
                            array(GeSHi::hsc($word), '<DOT>'),
                            $this->language_data['URLS'][$group]
                        ) . '">';
                }
                return '';
            }
            else if (!($this->language == 'html' && ('&gt;' == $keyword || '&lt;' == $keyword))) {
                return '</a>';
            }
        }
    }

    /**
     * Takes a string that has no strings or comments in it, and highlights
     * stuff like keywords, numbers and methods.
     *
     * @param string The string to parse for keyword, numbers etc.
     * @since 1.0.0
     * @access private
     * @todo BUGGY! Why? Why not build string and return?
     */
    function parse_non_string_part(&$stuff_to_parse) {
        $stuff_to_parse = ' ' . GeSHi::hsc($stuff_to_parse);
        $stuff_to_parse_pregquote = preg_quote($stuff_to_parse, '/');

        //
        // Regular expressions
        //
        foreach ($this->language_data['REGEXPS'] as $key => $regexp) {
            if ($this->lexic_permissions['REGEXPS'][$key]) {
                if (is_array($regexp)) {
                    $stuff_to_parse = preg_replace(
                        "/" .
                        str_replace('/', '\/', $regexp[GESHI_SEARCH]) .
                        "/{$regexp[GESHI_MODIFIERS]}",
                        "{$regexp[GESHI_BEFORE]}<|!REG3XP$key!>{$regexp[GESHI_REPLACE]}|>{$regexp[GESHI_AFTER]}",
                        $stuff_to_parse
                    );
                }
                else {
                    $stuff_to_parse = preg_replace(
                        "/(" . str_replace('/', '\/', $regexp) . ")/",
                        "<|!REG3XP$key!>\\1|>",
                        $stuff_to_parse
                    );
                }
            }
        }

        //
        // Highlight numbers
        //
        if ($this->lexic_permissions['NUMBERS'] && preg_match('#[0-9]#', $stuff_to_parse)) {
            $stuff_to_parse = preg_replace(
                '/([-+]?\\b(?:[0-9]*\\.)?[0-9]+\\b)/',
                '<|/NUM!/>\\1|>',
                $stuff_to_parse
            );
        }

        // Highlight keywords
        if (preg_match('#[a-zA-Z]{2,}#', $stuff_to_parse)) {
            foreach ($this->language_data['KEYWORDS'] as $k => $keywordset) {
                if ($this->lexic_permissions['KEYWORDS'][$k]) {
                    foreach ($keywordset as $keyword) {
                        $quoted_keyword = preg_quote($keyword, '/');

                        if (false !== stristr($stuff_to_parse_pregquote, $quoted_keyword)) {
                            $stuff_to_parse .= ' ';
                            $styles = "/$k/";
                            $self = $this;

                            if ($this->language_data['CASE_SENSITIVE'][$k]) {
                                $stuff_to_parse = preg_replace_callback(
                                    "/([^a-zA-Z0-9\$_\|\#;>|^])($quoted_keyword)(?=[^a-zA-Z0-9_<\|%\-&])/",
                                    function ($matches) use ($self, $k, $styles) {
                                        return $matches[1]
                                            . $self->add_url_to_keyword($matches[2], $k, 'BEGIN')
                                            . '<|' . $styles . '>'
                                            . $self->change_case($matches[2])
                                            . '|>'
                                            . $self->add_url_to_keyword($matches[2], $k, 'END');
                                    },
                                    $stuff_to_parse
                                );
                            }
                            else {
                                $hackage = ('smarty' == $this->language) ? '\/' : '';

                                $stuff_to_parse = preg_replace_callback(
                                    "/([^a-zA-Z0-9\$_\|\#;>$hackage|^])($quoted_keyword)(?=[^a-zA-Z0-9_<\|%\-&])/i",
                                    function ($matches) use ($self, $k, $styles) {
                                        return $matches[1]
                                            . $self->add_url_to_keyword($matches[2], $k, 'BEGIN')
                                            . '<|' . $styles . '>'
                                            . $self->change_case($matches[2])
                                            . '|>'
                                            . $self->add_url_to_keyword($matches[2], $k, 'END');
                                    },
                                    $stuff_to_parse
                                );
                            }

                            $stuff_to_parse = substr($stuff_to_parse, 0, strlen($stuff_to_parse) - 1);
                        }
                    }
                }
            }
        }



        //
        // Now that's all done, replace /[number]/ with the correct styles
        //
        foreach ($this->language_data['KEYWORDS'] as $k => $kws) {
            if (!$this->use_classes) {
                $attributes = ' style="' . $this->language_data['STYLES']['KEYWORDS'][$k] . '"';
            }
            else {
                $attributes = ' class="kw' . $k . '"';
            }
            $stuff_to_parse = str_replace("/$k/", $attributes, $stuff_to_parse);
        }

        // Put number styles in
        if (!$this->use_classes && $this->lexic_permissions['NUMBERS']) {
            $attributes = ' style="' . $this->language_data['STYLES']['NUMBERS'][0] . '"';
        }
        else {
            $attributes = ' class="nu0"';
        }
        $stuff_to_parse = str_replace('/NUM!/', $attributes, $stuff_to_parse);

        //
        // Highlight methods and fields in objects
        //
        if ($this->lexic_permissions['METHODS'] && $this->language_data['OOLANG']) {
            foreach ($this->language_data['OBJECT_SPLITTERS'] as $key => $splitter) {
                if (false !== stristr($stuff_to_parse, $splitter)) {
                    if (!$this->use_classes) {
                        $attributes = ' style="' . $this->language_data['STYLES']['METHODS'][$key] . '"';
                    }
                    else {
                        $attributes = ' class="me' . $key . '"';
                    }

                    // PHP 5.6–8.3 safe fix:
                    // changed preg_quote second arg from 1 to '/'
                    $stuff_to_parse = preg_replace(
                        "/(" . preg_quote($this->language_data['OBJECT_SPLITTERS'][$key], '/') . "[\s]*)([a-zA-Z\*\(][a-zA-Z0-9_\*]*)/",
                        "\\1<|$attributes>\\2|>",
                        $stuff_to_parse
                    );
                }
            }
        }

        //
        // Highlight brackets. Yes, I've tried adding a semi-colon to this list.
        // You try it, and see what happens ;)
        // TODO: Fix lexic permissions not converting entities if shouldn't
        // be highlighting regardless
        //
        if ($this->lexic_permissions['BRACKETS']) {
            $code_entities_match = array('[', ']', '(', ')', '{', '}');

            if (!$this->use_classes) {
                $code_entities_replace = array(
                    '<| style="' . $this->language_data['STYLES']['BRACKETS'][0] . '">&#91;|>',
                    '<| style="' . $this->language_data['STYLES']['BRACKETS'][0] . '">&#93;|>',
                    '<| style="' . $this->language_data['STYLES']['BRACKETS'][0] . '">&#40;|>',
                    '<| style="' . $this->language_data['STYLES']['BRACKETS'][0] . '">&#41;|>',
                    '<| style="' . $this->language_data['STYLES']['BRACKETS'][0] . '">&#123;|>',
                    '<| style="' . $this->language_data['STYLES']['BRACKETS'][0] . '">&#125;|>',
                );
            }
            else {
                $code_entities_replace = array(
                    '<| class="br0">&#91;|>',
                    '<| class="br0">&#93;|>',
                    '<| class="br0">&#40;|>',
                    '<| class="br0">&#41;|>',
                    '<| class="br0">&#123;|>',
                    '<| class="br0">&#125;|>',
                );
            }

            $stuff_to_parse = str_replace(
                $code_entities_match,
                $code_entities_replace,
                $stuff_to_parse
            );
        }

        //
        // Add class/style for regexps
        //
        foreach ($this->language_data['REGEXPS'] as $key => $regexp) {
            if ($this->lexic_permissions['REGEXPS'][$key]) {
                if (!$this->use_classes) {
                    $attributes = ' style="' . $this->language_data['STYLES']['REGEXPS'][$key] . '"';
                }
                else {
                    if (
                        is_array($this->language_data['REGEXPS'][$key]) &&
                        array_key_exists(GESHI_CLASS, $this->language_data['REGEXPS'][$key])
                    ) {
                        $attributes = ' class="'
                            . $this->language_data['REGEXPS'][$key][GESHI_CLASS] . '"';
                    }
                    else {
                        $attributes = ' class="re' . $key . '"';
                    }
                }

                $stuff_to_parse = str_replace(
                    "!REG3XP$key!",
                    $attributes,
                    $stuff_to_parse
                );
            }
        }

        // Replace <DOT> with . for urls
        $stuff_to_parse = str_replace('<DOT>', '.', $stuff_to_parse);

        // Replace <|UR1| with <a href= for urls also
        if (isset($this->link_styles[GESHI_LINK])) {
            if ($this->use_classes) {
                $stuff_to_parse = str_replace(
                    '<|UR1|',
                    '<a' . $this->link_target . ' href=',
                    $stuff_to_parse
                );
            }
            else {
                $stuff_to_parse = str_replace(
                    '<|UR1|',
                    '<a' . $this->link_target . ' style="' . $this->link_styles[GESHI_LINK] . '" href=',
                    $stuff_to_parse
                );
            }
        }
        else {
            $stuff_to_parse = str_replace(
                '<|UR1|',
                '<a' . $this->link_target . ' href=',
                $stuff_to_parse
            );
        }

        //
        // NOW we add the span thingy ;)
        //
        $stuff_to_parse = str_replace('<|', '<span', $stuff_to_parse);
        $stuff_to_parse = str_replace('|>', '</span>', $stuff_to_parse);

        return substr($stuff_to_parse, 1);
    }

    /**
     * Sets the time taken to parse the code
     *
     * @param microtime The time when parsing started
     * @param microtime The time when parsing ended
     * @since 1.0.2
     * @access private
     */
    function set_time($start_time, $end_time) {
        $start = is_string($start_time) ? explode(' ', $start_time) : array(0, $start_time);
        $end = is_string($end_time) ? explode(' ', $end_time) : array(0, $end_time);

        $start_sec = isset($start[1]) ? (float) $start[1] : (float) $start[0];
        $start_usec = isset($start[1]) ? (float) $start[0] : 0;

        $end_sec = isset($end[1]) ? (float) $end[1] : (float) $end[0];
        $end_usec = isset($end[1]) ? (float) $end[0] : 0;

        $this->time = ($end_sec + $end_usec) - ($start_sec + $start_usec);
    }

    /**
     * Gets the time taken to parse the code
     *
     * @return double The time taken to parse the code
     * @since 1.0.2
     */
    function get_time() {
        return $this->time;
    }

    /**
     * Gets language information and stores it for later use
     *
     * @access private
     * @todo Needs to load keys for lexic permissions for keywords, regexps etc
     */
    function load_language($file_name) {
        $this->enable_highlighting();
        $language_data = array();
        require $file_name;

        // Perhaps some checking might be added here later to check that
        // $language data is a valid thing but maybe not
        $this->language_data = $language_data;

        // Set strict mode if should be set
        if ($this->language_data['STRICT_MODE_APPLIES'] == GESHI_ALWAYS) {
            $this->strict_mode = true;
        }

        // Set permissions for all lexics to true
        // so they'll be highlighted by default
        foreach ($this->language_data['KEYWORDS'] as $key => $words) {
            $this->lexic_permissions['KEYWORDS'][$key] = true;
        }

        foreach ($this->language_data['COMMENT_SINGLE'] as $key => $comment) {
            $this->lexic_permissions['COMMENTS'][$key] = true;
        }

        foreach ($this->language_data['REGEXPS'] as $key => $regexp) {
            $this->lexic_permissions['REGEXPS'][$key] = true;
        }

        // Set default class for CSS
        $this->overall_class = $this->language;
    }

    /**
     * Takes the parsed code and various options, and creates the HTML
     * surrounding it to make it look nice.
     *
     * @param  string The code already parsed
     * @return string The code nicely finalised
     * @since  1.0.0
     * @access private
     */
    function finalise($parsed_code) {
        // Remove end parts of important declarations
        // This is BUGGY!! My fault for bad code: fix coming in 1.2
        // @todo Remove this crap
        if ($this->enable_important_blocks &&
            (strpos($parsed_code, GeSHi::hsc(GESHI_START_IMPORTANT)) === false)) {
            $parsed_code = str_replace(GeSHi::hsc(GESHI_END_IMPORTANT), '', $parsed_code);
        }

        // Add HTML whitespace stuff if we're using the <div> header
        if ($this->header_type != GESHI_HEADER_PRE) {
            $parsed_code = $this->indent($parsed_code);
        }

        // purge some unnecessary stuff
        $parsed_code = preg_replace('#<span[^>]+>(\s*)</span>#', '\\1', $parsed_code);
        $parsed_code = preg_replace('#<div[^>]+>(\s*)</div>#', '\\1', $parsed_code);

        // If we are using IDs for line numbers, there needs to be an overall
        // ID set to prevent collisions.
        if ($this->add_ids && !$this->overall_id) {
            $this->overall_id = 'geshi-' . substr(md5(microtime(true)), 0, 4);
        }

        // If we're using line numbers, we insert <li>s and appropriate
        // markup to style them (otherwise we don't need to do anything)
        if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
            // If we're using the <pre> header, we shouldn't add newlines because
            // the <pre> will line-break them (and the <li>s already do this for us)
            $ls = ($this->header_type != GESHI_HEADER_PRE) ? "\n" : '';
            // Get code into lines
            $code = explode("\n", $parsed_code);
            // Set vars to defaults for following loop
            $parsed_code = '';
            $i = 0;
            $attrs = array();

            // Prevent division by zero in PHP 8+
            $line_nth_row = ($this->line_nth_row > 0) ? $this->line_nth_row : 1;

            // Foreach line...
            foreach ($code as $line) {
                // Make lines have at least one space in them if they're empty
                // BenBE: Checking emptiness using trim instead of relying on blanks
                if ('' == trim($line)) {
                    $line = '&nbsp;';
                }
                // If this is a "special line"...
                if ($this->line_numbers == GESHI_FANCY_LINE_NUMBERS &&
                    $i % $line_nth_row == ($line_nth_row - 1)) {
                    // Set the attributes to style the line
                    if ($this->use_classes) {
                        //$attr = ' class="li2"';
                        $attrs['class'][] = 'li2';
                        $def_attr = ' class="de2"';
                    }
                    else {
                        //$attr = ' style="' . $this->line_style2 . '"';
                        $attrs['style'][] = $this->line_style2;
                        $attrs['class'][] = 'li2';
						// This style "covers up" the special styles set for special lines
                        // so that styles applied to special lines don't apply to the actual
                        // code on that line
                        $def_attr = ' style="' . $this->code_style . '"';
                    }
                    // Span or div?
//                    $start = "<div$def_attr>";
					$start = '';
//                    $end = '</div>';
					$end = '';
                }
                else {
                    if ($this->use_classes) {
                        //$attr = ' class="li1"';
                        $attrs['class'][] = 'li1';
                        $def_attr = ' class="de1"';
                    }
                    else {
                        //$attr = ' style="' . $this->line_style1 . '"';
                        $attrs['style'][] = $this->line_style1;
                        $attrs['class'][] = 'li1';
						$def_attr = ' style="' . $this->code_style . '"';
                    }
//                    $start = "<div$def_attr>";
					$start = '';
//                    $end = '</div>';
					$end = '';
                }

                ++$i;
                // Are we supposed to use ids? If so, add them
                if ($this->add_ids) {
                    $attrs['id'][] = "$this->overall_id-$i";
                }
                if ($this->use_classes && in_array($i, (array) $this->highlight_extra_lines, true)) {
                    $attrs['class'][] = 'ln-xtra';
                }
                if (!$this->use_classes && in_array($i, (array) $this->highlight_extra_lines, true)) {
                    $attrs['style'][] = $this->highlight_extra_lines_style;
                }

                // Add in the line surrounded by appropriate list HTML
                $attr_string = ' ';
                foreach ($attrs as $key => $attr) {
                    $attr_string .= $key . '="' . implode(' ', $attr) . '" ';
                }
                $attr_string = substr($attr_string, 0, -1);
//                $parsed_code .= "<li$attr_string>$start$line$end</li>$ls";
                $parsed_code .= "<li$attr_string>$start$line$end</li>";
                $attrs = array();
            }
        }
        else {
            // No line numbers, but still need to handle highlighting lines extra.
            // Have to use divs so the full width of the code is highlighted
            $code = explode("\n", $parsed_code);
            $parsed_code = '';
            $i = 0;
            foreach ($code as $line) {
                // Make lines have at least one space in them if they're empty
                // BenBE: Checking emptiness using trim instead of relying on blanks
                if ('' == trim($line)) {
                    $line = '&nbsp;';
                }
                if (in_array(++$i, (array) $this->highlight_extra_lines, true)) {
                    if ($this->use_classes) {
                        $parsed_code .= '<div class="ln-xtra">';
                    }
                    else {
                        $parsed_code .= "<div style=\"{$this->highlight_extra_lines_style}\">";
                    }
                    // Remove \n because it stuffs up <pre> header
                    $parsed_code .= $line . "</div>";
                }
                else {
//                    $parsed_code .= $line . "\n";
					$parsed_code .= $line;
                }
            }
        }

        if ($this->header_type == GESHI_HEADER_PRE) {
            // enforce line numbers when using pre
            $parsed_code = str_replace('<li></li>', '<li>&nbsp;</li>', $parsed_code);
        }

        return $this->header() . chop($parsed_code) . $this->footer();
    }

    /**
     * Creates the header for the code block (with correct attributes)
     *
     * @return string The header for the code block
     * @since  1.0.0
     * @access private
     */
    function header() {
        // Get attributes needed
        $attributes = $this->get_attributes();

        $ol_attributes = '';

        if ((int) $this->line_numbers_start != 1) {
            $ol_attributes .= ' start="' . (int) $this->line_numbers_start . '"';
        }

        // Get the header HTML
        $header = $this->format_header_content();

        if (GESHI_HEADER_NONE == $this->header_type) {
            if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
                return "$header<ol$ol_attributes>";
            }
            return $header .
                ($this->force_code_block ? '<div>' : '');
        }

        // Work out what to return and do it
        if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
            if ($this->header_type == GESHI_HEADER_PRE) {
                return "<pre$attributes>$header<ol$ol_attributes>";
            }
            else if ($this->header_type == GESHI_HEADER_DIV) {
                return "<div$attributes>$header<ol$ol_attributes>";
            }
        }
        else {
            if ($this->header_type == GESHI_HEADER_PRE) {
                return "<pre$attributes>$header"  .
                    ($this->force_code_block ? '<div>' : '');
            }
            else if ($this->header_type == GESHI_HEADER_DIV) {
                return "<div$attributes>$header" .
                    ($this->force_code_block ? '<div>' : '');
            }
        }

        return $header;
    }

    /**
     * Returns the header content, formatted for output
     *
     * @return string The header content, formatted for output
     * @since  1.0.2
     * @access private
     */
    function format_header_content() {
        $header = $this->header_content;
        if ($header) {
            if ($this->header_type == GESHI_HEADER_PRE) {
                $header = str_replace("\n", '', $header);
            }
            $header = $this->replace_keywords($header);

            if ($this->use_classes) {
                $attr = ' class="head"';
            }
            else {
                $attr = " style=\"{$this->header_content_style}\"";
            }
            return "<div$attr>$header</div>";
        }

        return '';
    }

    /**
     * Returns the footer for the code block.
     *
     * @return string The footer for the code block
     * @since  1.0.0
     * @access private
     */
    function footer() {
        $footer_content = $this->format_footer_content();

        if (GESHI_HEADER_NONE == $this->header_type) {
            return ($this->line_numbers != GESHI_NO_LINE_NUMBERS) ? '</ol>' . $footer_content
                : $footer_content;
        }

        if ($this->header_type == GESHI_HEADER_DIV) {
            if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
                return "</ol>$footer_content</div>";
            }
            return ($this->force_code_block ? '</div>' : '') .
                "$footer_content</div>";
        }
        else {
            if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
                return "</ol>$footer_content</pre>";
            }
            return ($this->force_code_block ? '</div>' : '') .
                "$footer_content</pre>";
        }
    }

    /**
     * Returns the footer content, formatted for output
     *
     * @return string The footer content, formatted for output
     * @since  1.0.2
     * @access private
     */
    function format_footer_content() {
        $footer = $this->footer_content;
        if ($footer) {
            if ($this->header_type == GESHI_HEADER_PRE) {
                $footer = str_replace("\n", '', $footer);
            }
            $footer = $this->replace_keywords($footer);

            if ($this->use_classes) {
                $attr = ' class="foot"';
            }
            else {
                $attr = " style=\"{$this->footer_content_style}\"";
            }
            return "<div$attr>$footer</div>";
        }

        return '';
    }

    /**
     * Replaces certain keywords in the header and footer with
     * certain configuration values
     *
     * @param  string The header or footer content to do replacement on
     * @return string The header or footer with replaced keywords
     * @since  1.0.2
     * @access private
     */
    function replace_keywords($instr) {
        $keywords = $replacements = array();

        $keywords[] = '<TIME>';
        $keywords[] = '{TIME}';
        $replacements[] = $replacements[] = number_format((float) $this->get_time(), 3);

        $keywords[] = '<LANGUAGE>';
        $keywords[] = '{LANGUAGE}';
        $replacements[] = $replacements[] = $this->language;

        $keywords[] = '<VERSION>';
        $keywords[] = '{VERSION}';
        $replacements[] = $replacements[] = GESHI_VERSION;

        return str_replace($keywords, $replacements, (string) $instr);
    }

    /**
     * Gets the CSS attributes for this code
     *
     * @return The CSS attributes for this code
     * @since  1.0.0
     * @access private
     * @todo   Document behaviour change - class is outputted regardless of whether we're using classes or not.
     *         Same with style
     */
    function get_attributes() {
        $attributes = '';

        if ($this->overall_class != '') {
            $attributes .= " class=\"{$this->overall_class}\"";
        }
        if ($this->overall_id != '') {
            $attributes .= " id=\"{$this->overall_id}\"";
        }
        if ($this->overall_style != '') {
            $attributes .= ' style="' . $this->overall_style . '"';
        }
        return $attributes;
    }

    /**
     * Secure replacement for PHP built-in function htmlspecialchars().
     *
     * See ticket #427 (http://wush.net/trac/wikka/ticket/427) for the rationale
     * for this replacement function.
     *
     * The INTERFACE for this function is almost the same as that for
     * htmlspecialchars(), with the same default for quote style; however, there
     * is no 'charset' parameter. The reason for this is as follows:
     *
     * The PHP docs say:
     *      "The third argument charset defines character set used in conversion."
     *
     * I suspect PHP's htmlspecialchars() is working at the byte-value level and
     * thus _needs_ to know (or asssume) a character set because the special
     * characters to be replaced could exist at different code points in
     * different character sets. (If indeed htmlspecialchars() works at
     * byte-value level that goes some  way towards explaining why the
     * vulnerability would exist in this function, too, and not only in
     * htmlentities() which certainly is working at byte-value level.)
     *
     * This replacement function however works at character level and should
     * therefore be "immune" to character set differences - so no charset
     * parameter is needed or provided. If a third parameter is passed, it will
     * be silently ignored.
     *
     * In the OUTPUT there is a minor difference in that we use '&#39;' instead
     * of PHP's '&#039;' for a single quote: this provides compatibility with
     *      get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES)
     * (see comment by mikiwoz at yahoo dot co dot uk on
     * http://php.net/htmlspecialchars); it also matches the entity definition
     * for XML 1.0
     * (http://www.w3.org/TR/xhtml1/dtds.html#a_dtd_Special_characters).
     * Like PHP we use a numeric character reference instead of '&apos;' for the
     * single quote. For the other special characters we use the named entity
     * references, as PHP is doing.
     *
     * @author      {@link http://wikkawiki.org/JavaWoman Marjolein Katsma}
     *
     * @license     http://www.gnu.org/copyleft/lgpl.html
     *              GNU Lesser General Public License
     * @copyright   Copyright 2007, {@link http://wikkawiki.org/CreditsPage
     *              Wikka Development Team}
     *
     * @access      public
     * @param       string  $string string to be converted
     * @param       integer $quote_style
     *                      - ENT_COMPAT:   escapes &, <, > and double quote (default)
     *                      - ENT_NOQUOTES: escapes only &, < and >
     *                      - ENT_QUOTES:   escapes &, <, >, double and single quotes
     * @return      string  converted string
     */

    function hsc($string, $quote_style = ENT_COMPAT) {
        // init
        $aTransSpecchar = array(
            '&' => '&amp;',
            '"' => '&quot;',
            '<' => '&lt;',
            '>' => '&gt;'
        ); // ENT_COMPAT set

        if (ENT_NOQUOTES == $quote_style) {
            unset($aTransSpecchar['"']);
        }
        elseif (ENT_QUOTES == $quote_style) {
            $aTransSpecchar["'"] = '&#39;';
        }

        return strtr($string, $aTransSpecchar);
    }

    /**
     * Returns a stylesheet for the highlighted code.
     *
     * @param  boolean Whether to use economy mode or not
     * @return string A stylesheet built on the data for the current language
     * @since  1.0.0
     */
    function get_stylesheet($economy_mode = true) {
        if ($this->error) {
            return '';
        }

        $selector = ($this->overall_id != '') ? "#{$this->overall_id} " : '';
        $selector = ($selector == '' && $this->overall_class != '') ? ".{$this->overall_class} " : $selector;

        if (!$economy_mode) {
            $stylesheet = "/**\n * GeSHi Dynamically Generated Stylesheet\n * --------------------------------------\n * Dynamically generated stylesheet for {$this->language}\n * CSS class: {$this->overall_class}, CSS id: {$this->overall_id}\n * GeSHi (C) 2004 - 2007 Nigel McNie (http://qbnz.com/highlighter)\n */\n";
        } else {
            $stylesheet = '/* GeSHi (C) 2004 - 2007 Nigel McNie (http://qbnz.com/highlighter) */' . "\n";
        }

        if (!$economy_mode || $this->line_numbers != GESHI_NO_LINE_NUMBERS) {
            $stylesheet .= "$selector.de1, $selector.de2 {{$this->code_style}}\n";
        }

        if (!$economy_mode || $this->overall_style != '') {
            $stylesheet .= "$selector {{$this->overall_style}}\n";
        }

        foreach ((array) $this->link_styles as $key => $style) {
            if (!$economy_mode || ($key == GESHI_LINK && $style != '')) {
                $stylesheet .= "{$selector}a:link {{$style}}\n";
            }
            if (!$economy_mode || ($key == GESHI_HOVER && $style != '')) {
                $stylesheet .= "{$selector}a:hover {{$style}}\n";
            }
            if (!$economy_mode || ($key == GESHI_ACTIVE && $style != '')) {
                $stylesheet .= "{$selector}a:active {{$style}}\n";
            }
            if (!$economy_mode || ($key == GESHI_VISITED && $style != '')) {
                $stylesheet .= "{$selector}a:visited {{$style}}\n";
            }
        }

        if (!$economy_mode || $this->header_content_style != '') {
            $stylesheet .= "$selector.head {{$this->header_content_style}}\n";
        }
        if (!$economy_mode || $this->footer_content_style != '') {
            $stylesheet .= "$selector.foot {{$this->footer_content_style}}\n";
        }

        if (!$economy_mode || $this->important_styles != '') {
            $stylesheet .= "$selector.imp {{$this->important_styles}}\n";
        }

        if (!$economy_mode || count((array) $this->highlight_extra_lines)) {
            $stylesheet .= "$selector.ln-xtra {{$this->highlight_extra_lines_style}}\n";
        }

        if (!$economy_mode || ($this->line_numbers != GESHI_NO_LINE_NUMBERS && $this->line_style1 != '')) {
            $stylesheet .= "{$selector}li {{$this->line_style1}}\n";
        }

        if (!$economy_mode || ($this->line_numbers == GESHI_FANCY_LINE_NUMBERS && $this->line_style2 != '')) {
            $stylesheet .= "{$selector}li.li2 {{$this->line_style2}}\n";
        }

        foreach ((array) ($this->language_data['STYLES']['KEYWORDS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || (!( $this->lexic_permissions['KEYWORDS'][$group] ?? false ) || $styles == '') === false) {
                $stylesheet .= "$selector.kw$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['COMMENTS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && ($this->lexic_permissions['COMMENTS'][$group] ?? false))) {
                $stylesheet .= "$selector.co$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['ESCAPE_CHAR'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && !empty($this->lexic_permissions['ESCAPE_CHAR']))) {
                $stylesheet .= "$selector.es$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['SYMBOLS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && !empty($this->lexic_permissions['BRACKETS']))) {
                $stylesheet .= "$selector.br$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['STRINGS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && !empty($this->lexic_permissions['STRINGS']))) {
                $stylesheet .= "$selector.st$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['NUMBERS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && !empty($this->lexic_permissions['NUMBERS']))) {
                $stylesheet .= "$selector.nu$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['METHODS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && !empty($this->lexic_permissions['METHODS']))) {
                $stylesheet .= "$selector.me$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['SCRIPT'] ?? array()) as $group => $styles) {
            if (!$economy_mode || $styles != '') {
                $stylesheet .= "$selector.sc$group {{$styles}}\n";
            }
        }

        foreach ((array) ($this->language_data['STYLES']['REGEXPS'] ?? array()) as $group => $styles) {
            if (!$economy_mode || ($styles != '' && ($this->lexic_permissions['REGEXPS'][$group] ?? false))) {
                if (is_array($this->language_data['REGEXPS'][$group]) &&
                    array_key_exists(GESHI_CLASS, $this->language_data['REGEXPS'][$group])) {
                    $stylesheet .= "$selector.";
                    $stylesheet .= $this->language_data['REGEXPS'][$group][GESHI_CLASS];
                    $stylesheet .= " {{$styles}}\n";
                }
                else {
                    $stylesheet .= "$selector.re$group {{$styles}}\n";
                }
            }
        }

        return $stylesheet;
    }

} // End Class GeSHi


if (!function_exists('geshi_highlight')) {
    /**
     * Easy way to highlight stuff.
     *
     * @param string The code to highlight
     * @param string The language to highlight the code in
     * @param string The path to the language files
     * @param boolean Whether to return the result or to echo
     * @return string|boolean
     * @since 1.0.2
     */
    function geshi_highlight($string, $language, $path = null, $return = false) {
        $geshi = new GeSHi($string, $language, $path);
        $geshi->set_header_type(GESHI_HEADER_NONE);

        if ($return) {
            return '<code>' . $geshi->parse_code() . '</code>';
        }

        echo '<code>' . $geshi->parse_code() . '</code>';

        if ($geshi->error()) {
            return false;
        }

        return true;
    }
}
