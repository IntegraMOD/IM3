<?php
/**
* @version $Id$
*
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @version 3.0.15 HelterSkelter
*/
if (!defined('IN_PHPBB')) {
    exit;
}

// Constant Defines for actions
// define('AFTER',		1);
// define('BEFORE',	2);

/**
 * Editor Class
 * Runs through file sequential, ie new finds must come after previous finds
 * Handles placing the files after being edited.
 *
 * @todo: implement some string checkin, way too much can go wild here
 */
class editor
{
/**
 * Holds contents of file.
 */
public $file_contents = '';
 
/**
 * Holds the filename of the currently open file.
 */
public $open_filename = '';
 
/**
 * Full action array with complete finds.
 */
public $mod_actions = [];
 
/**
 * One of the three constants defined in functions_mods.php.
 */
public $write_method = 0;
 
/**
 * Keeps finds sequential, plus loop optimization.
 */
public $start_index = 0;
 
/*
* Keeps inline find sequential
*/
public $last_string_offset = 0;
 
/*
* Only apply string offset to the line to which it belongs
*/
public $last_inline_ary_offset = 0;
 
/**
 * Time when MOD was installed.
 */
public $install_time = 0;
 
/**
 * Only used when board has templates stored in the database.
 */
public $template_id = 0;
 
/**
 * Store the  current action & most recent action to aid the uninstall building process.
 */
public $last_action = [];
public $curr_action = [];
 
/**
 * Constructor method
 * This is not called directly in AutoMOD.
 */
public function __construct()
{
}
 
/**
 * Make all line endings the same - UNIX.
 */
public function normalize($string)
{
    $string = str_replace(["\r\n", "\r"], "\n", $string);
 
    return $string;
}
 
/**
 * Open a file with IO, for processing.
 *
 * @param string $filename - relative path from phpBB Root to the file to open
 *                         e.g. viewtopic.php, styles/prosilver/templates/index_body.html
 */
public function open_file($filename, $backup_path = '')
{
    global $phpbb_root_path, $db, $user;
 
    $this->file_contents = @file($phpbb_root_path . $filename);
 
    if ($this->file_contents === false) {
        return $user->lang['FILE_EMPTY'];
    }
 
    $this->file_contents = $this->normalize(implode('', $this->file_contents));
 
    // Check for file contents in the database if this is a template file
    // this will overwrite the @file call if it exists in the DB.
    if (strpos($filename, 'template/') !== false) {
        // grab template name and filename
        preg_match('#styles/([a-z0-9_]+)/template/([a-z0-9_]+.[a-z]+)#i', $filename, $match);
 
        $sql = 'SELECT d.template_data, d.template_id
            FROM ' . STYLES_TEMPLATE_DATA_TABLE . ' d, ' . STYLES_TEMPLATE_TABLE . " t
            WHERE d.template_filename = '" . $db->sql_escape($match[2]) . "'
                AND t.template_id = d.template_id
                AND t.template_storedb = 1
                AND t.template_name = '" . $db->sql_escape($match[1]) . "'";
        $result = $db->sql_query($sql);
 
        if ($row = $db->sql_fetchrow($result)) {
            $this->file_contents = explode("\n", $this->normalize($row['template_data']));
 
            // emulate the behavior of file()
            $lines = count($this->file_contents);
            for ($i = 0; $i < $lines; ++$i) {
                $this->file_contents[$i] .= "\n";
            }
 
            $this->template_id = $row['template_id'];
        } else {
            $this->template_id = 0;
        }
    }
 
    /*
    * If the file does not exist, or is empty, die.
    * Non existant files cannot be edited, and empty files will have no
    * finds
    */
	if (!empty($this->file_contents)) {
	    global $user;
	    trigger_error(sprintf($user->lang['MOD_OPEN_FILE_FAIL'], "$phpbb_root_path$filename"), E_USER_WARNING);
	}
 
    $this->start_index = 0;
    $this->open_filename = $filename;
 
    // Should we backup this file?
    if ($backup_path) {
        $this->backup_file($backup_path);
    }
}
 
/**
 * Checks if a find is present
 * Keep in mind partial finds and multi-line finds.
 *
 * @param string $find - string to find
 *
 * @return mixed : array with position information if $find is found; false otherwise
 */
public function find($find)
{
    if ($find === '') {
        // Can't find a empty string,
        return false;
    }
 
    $find_success = 0;
 
    $find = $this->normalize($find);
    $find_ary = explode("\n", rtrim($find, "\n"));
 
    $total_lines = count($this->file_contents);
    $find_lines = count($find_ary);
 
    $mode = ['', 'trim'];
 
    foreach ($mode as $function) {
        // we process the file sequentially ... so we keep track of indices
        for ($i = $this->start_index; $i < $total_lines; ++$i) {
            for ($j = 0; $j < $find_lines; ++$j) {
                if ($function) {
                    $find_ary[$j] = $function($find_ary[$j]);
                }
 
                // if we've reached the EOF, the find failed.
                if (!isset($this->file_contents[$i + $j])) {
                    return false;
                }
 
                if (!trim($find_ary[$j])) {
                    // line is blank.  Assume we can find a blank line, and continue on
                    ++$find_success;
                }
                // using $this->file_contents[$i + $j] to keep the array pointer where I want it
                // if the first line of the find (index 0) is being looked at, $i + $j = $i.
                // if $j is > 0, we look at the next line of the file being inspected
                // hopefully, this is a decent performer.
                elseif (strpos($this->file_contents[$i + $j], $find_ary[$j]) !== false) {
                    // we found this part of the find
                    ++$find_success;
                }
                // we might have an increment operator, which requires a regular expression match
                elseif (strpos($find_ary[$j], '{%:') !== false) {
                    $regex = preg_replace('#{%:(\d+)}#', '(\d+)', $find_ary[$j]);
 
                    if (preg_match('#' . $regex . '#is', $this->file_contents[$i + $j])) {
                        ++$find_success;
                    } else {
                        $find_success = 0;
                    }
                } else {
                    // the find failed.  Reset $find_success
                    $find_success = 0;
 
                    // skip to next iteration of outer loop, that is, skip to the next line
                    break;
                }
 
                if ($find_success == $find_lines) {
                    // we found the proper number of lines
                    $this->start_index = $i;
 
                    // return our array offsets
                    return [
                        'start' => $i,
                        'end' => $i + $j,
                    ];
                }
            }
        }
    }
 
    // if return has not been previously invoked, the find failed.
    return false;
}
 
/**
 * This function is used to determine when an edit has ended, so we know that
 * the current line will not be looked at again.  This fixes some former bugs.
 */
public function close_edit()
{
    ++$this->start_index;
    $this->last_action = [];
    $this->last_string_offset = 0;
}
 
/*
* In-line analog to close_edit(), above.
* Advance the pointer one character
*/
public function close_inline_edit()
{
    ++$this->last_string_offset;
}
 
/**
 * Find a string within a given line.
 *
 * @param string $find         Complete find - narrows the scope of the inline search
 * @param string $inline_find  - the substring to find
 * @param int    $start_offset - the line number where $find starts
 * @param int    $end_offset   - the line number where $find ends
 *
 * @return mixed array on success or false on failure of find
 */
public function inline_find($find, $inline_find, $start_offset = false, $end_offset = false)
{
    if ($inline_find === '') {
        // Can't find a empty string,
        return false;
    }
 
    $find = $this->normalize($find);
 
    if ($start_offset === false || $end_offset === false) {
        $offsets = $this->find($find);
 
        if (!$offsets) {
            // the find failed, so no further action can occur.
            return false;
        }
 
        $start_offset = $offsets['start'];
        $end_offset = $offsets['end'];
 
        unset($offsets);
    }
 
    // cast is required in case someone tries to find a number
    // Often done in colspan="7" type inline operations
    $inline_find = (string) $inline_find;
 
    // similar method to find().  Just much more limited scope
    for ($i = $start_offset; $i <= $end_offset; ++$i) {
        if ($this->last_string_offset > 0 && ($this->last_inline_ary_offset == 0 || $this->last_inline_ary_offset == $i)) {
            $string_offset = strpos(substr($this->file_contents[$i], $this->last_string_offset), $inline_find);
 
            if ($string_offset !== false) {
                $string_offset += $this->last_string_offset;
            }
        } else {
            $string_offset = strpos($this->file_contents[$i], $inline_find);
        }
 
        if ($string_offset !== false) {
            $this->last_string_offset = $string_offset;
            $this->last_inline_ary_offset = $i;
 
            // if we find something, return the line number, string offset, and find length
            return [
                'array_offset' => $i,
                'string_offset' => $string_offset,
                'find_length' => strlen($inline_find),
            ];
        }
    }
 
    // if the previous failed, trim() the find and try again
    for ($i = $start_offset; $i <= $end_offset; ++$i) {
        $inline_find = trim($inline_find);
        if ($this->last_string_offset > 0 && ($this->last_inline_ary_offset == 0 || $this->last_inline_ary_offset == $i)) {
            $string_offset = strpos(substr($this->file_contents[$i], $this->last_string_offset), $inline_find);
 
            if ($string_offset !== false) {
                $string_offset += $this->last_string_offset;
            }
        } else {
            $string_offset = strpos($this->file_contents[$i], $inline_find);
        }
 
        if ($string_offset !== false) {
            $this->last_string_offset = $string_offset;
 
            // if we find something, return the line number, string offset, and find length
            return [
                'array_offset' => $i,
                'string_offset' => $string_offset,
                'find_length' => strlen($inline_find),
            ];
        }
    }
 
    return false;
}

/**
     * Add a string to the file, BEFORE/AFTER the given find string.
     *
     * @param string $find         - Complete find - narrows the scope of the inline search
     * @param string $add          - The string to be added before or after $find
     * @param string $pos          - BEFORE or AFTER
     * @param int    $start_offset - First line in the FIND
     * @param int    $end_offset   - Last line in the FIND
     *
     * @return bool success or failure of add
     */
    public function add_string($find, $add, $pos, $start_offset = false, $end_offset = false)
    {
        // this seems pretty simple...throughly test
        $add = $this->normalize($add);
 
        if (false === $start_offset || false === $end_offset) {
            $offsets = $this->find($find);
 
            if (!$offsets) {
                // the find failed, so the add cannot occur.
                return false;
            }
 
            $start_offset = $offsets['start'];
            $end_offset = $offsets['end'];
 
            unset($offsets);
        }
 
        $full_find = [];
        for ($i = $start_offset; $i <= $end_offset; ++$i) {
            $full_find[] = $this->file_contents[$i];
        }
 
        $full_find[0] = ltrim($full_find[0], "\n");
        $full_find[count($full_find) - 1] = rtrim($full_find[count($full_find) - 1], "\n");
 
        // make sure our new lines are correct
        $add = "\n".trim($add, "\n")."\n";
 
        if ('AFTER' === $pos) {
            $this->file_contents[$end_offset] = rtrim($this->file_contents[$end_offset], "\n").$add;
        }
 
        if ('BEFORE' === $pos) {
            $this->file_contents[$start_offset] = $add.ltrim($this->file_contents[$start_offset], "\n");
        }
 
        $this->curr_action = func_get_args();
        $this->build_uninstall(implode('', $full_find), null, strtolower($pos).' add', $add);
 
        return true;
    }
 
    /**
     * Increment (or perform other mathematical operation) on the given wildcard
     * Support multiple wildcards {%:1}, {%:2} etc...
     * This method is a variation on the inline find and replace methods.
     *
     * @param string $find         - Complete find - contains $inline_find
     * @param string $inline_find  - contains tokens to be replaced
     * @param string $operation    - tokens to do some math
     * @param int    $start_offset - First line in the FIND
     * @param int    $end_offset   - Last line in the FIND
     *
     * @return bool
     */
    public function inc_string($find, $inline_find, $operation, $start_offset = false, $end_offset = false)
    {
        if (false === $start_offset || false === $end_offset) {
            $offsets = $this->find($find);
 
            if (!$offsets) {
                // the find failed, so the add cannot occur.
                return false;
            }
 
            $start_offset = $offsets['start'];
            $end_offset = $offsets['end'];
 
            unset($offsets);
        }
 
        // $inline_find is optional
        if (!$inline_find) {
            $inline_find = $find;
        }
 
        // parse the MODX operator
        // let's explain this regex a bit:
        // - literal %: followed by a number.  optional space
        // - plus or minus operator. optional space
        // - number to increment by.  optional
        preg_match('#{%:(\d+)} ?([+-]) ?(\d*)#', $operation, $action);
        // make sure there is actually a number here
        $action[2] = $action[2] ?? '+';
        $action[3] = $action[3] ?? 1;
 
        $matches = 0;
        // $start_offset _should_ equal $end_offset, but we allow other cases
        for ($i = $start_offset; $i <= $end_offset; ++$i) {
            // This is intended.  We turn the MODX token into something PCRE can
            // understand.
            $inline_find = preg_replace('#{%:(\d+)}#', '(\d+)', $inline_find);
 
            if (preg_match('#'.$inline_find.'#is', $this->file_contents[$i], $find_contents)) {
                // now we can do some math
                // $find_contents[1] is the original number, $action[2] is the operator
                $new_number = eval('return '.((int) $find_contents[1]).$action[2].((int) $action[3]).';');
 
                // now we replace
                $new_contents = str_replace($find_contents[1], $new_number, $find_contents[0]);
 
                $this->file_contents[$i] = str_replace($find_contents[0], $new_contents, $this->file_contents[$i]);
 
                ++$matches;
            }
        }
 
        if (!$matches) {
            return false;
        }
 
        return true;
    }
 
    /**
     * Replace a string - replaces the entirety of $find with $replace.
     *
     * @param string $find         - Complete find - contains $inline_find
     * @param string $replace      - Will replace $find
     * @param int    $start_offset - First line in the FIND
     * @param int    $end_offset   - Last line in the FIND
     *
     * @return bool
     */
    public function replace_string($find, $replace, $start_offset = false, $end_offset = false)
    {
        $replace = $this->normalize($replace);
 
        if (false === $start_offset || false === $end_offset) {
            $offsets = $this->find($find);
 
            if (!$offsets) {
                return false;
            }
 
            $start_offset = $offsets['start'];
            $end_offset = $offsets['end'];
            unset($offsets);
        }
 
        // remove each line from the file, but add it to $full_find
        $full_find = [];
        for ($i = $start_offset; $i <= $end_offset; ++$i) {
            $full_find[] = $this->file_contents[$i];
            $this->file_contents[$i] = '';
        }
 
        $this->file_contents[$start_offset] = rtrim($replace)."\n";
 
        $this->curr_action = func_get_args();
        $this->build_uninstall(implode('', $full_find), null, 'replace-with', $replace);
 
        return true;
    }
 
    /*
    * Replace $inline_find with $inline_replace
    * Arguments are very similar to inline_add, below
    */
    public function inline_replace($find, $inline_find, $inline_replace, $array_offset = false, $string_offset = false, $length = false)
    {
        if (false === $string_offset || false === $length) {
            // look for the inline find
            $inline_offsets = $this->inline_find($find, $inline_find);
 
            if (!$inline_offsets) {
                return false;
            }
 
            $array_offset = $inline_offsets['array_offset'];
            $string_offset = $inline_offsets['string_offset'];
            $length = $inline_offsets['find_length'];
            unset($inline_offsets);
        }
 
        $this->file_contents[$array_offset] = substr_replace($this->file_contents[$array_offset], $inline_replace, $string_offset, $length);
 
        $this->last_string_offset += strlen($inline_replace) - 1;
 
        $this->curr_action = func_get_args();
 
        // This isn't a full find, but it is the closest we can get
        $this->build_uninstall($this->file_contents[$array_offset], $inline_find, 'in-line-replace', $inline_replace);
 
        return true;
    }
 
    /**
     * Adds a string inline before or after a given find.
     *
     * @param string $find          Complete find - narrows the scope of the inline search
     * @param string $inline_find   - the string to add before or after
     * @param string $inline_add    - added before or after $inline_find
     * @param string $pos           - 'BEFORE' or 'AFTER'
     * @param int    $array_offset  - line number where $inline_find may be found (optional)
     * @param int    $string_offset - location within the line where $inline_find begins (optional)
     * @param int    $length        - essentially strlen($inline_find) (optional)
     *
     * @return bool success or failure of action
     */
    public function inline_add($find, $inline_find, $inline_add, $pos, $array_offset = false, $string_offset = false, $length = false)
    {
        if (false === $string_offset || false === $length) {
            // look for the inline find
            $inline_offsets = $this->inline_find($find, $inline_find);
 
            if (!$inline_offsets) {
                return false;
            }
 
            $array_offset = $inline_offsets['array_offset'];
            $string_offset = $inline_offsets['string_offset'];
            $length = $inline_offsets['find_length'];
            unset($inline_offsets);
        }
 
        if ($string_offset + $length > strlen($this->file_contents[$array_offset])) {
            // we have an invalid string offset.  rats.
            return false;
        }
 
        if ('AFTER' === $pos) {
            $this->file_contents[$array_offset] = substr_replace($this->file_contents[$array_offset], $inline_add, $string_offset + $length, 0);
            $this->last_string_offset += strlen($inline_add) + $length - 1;
        } elseif ('BEFORE' === $pos) {
            $this->file_contents[$array_offset] = substr_replace($this->file_contents[$array_offset], $inline_add, $string_offset, 0);
            $this->last_string_offset += (strlen($inline_add) - 1);
        }
 
        $this->curr_action = func_get_args();
 
        $this->build_uninstall($this->file_contents[$array_offset], $inline_find, 'in-line-'.strtolower($pos).'-add', $inline_add);
 
        return true;
    }
 
    /**
     * Function to build full edits such that uninstall will work more often.
     *
     * @param $find - The largest find we can put together -- sometimes this
     *         comes from the file itself, other times from the MODX file
     * @param $inline_find - Subset of $find or NULL
     * @param $action_type - Name of the MODX action being taken
     * @param $action - The code which is being inserted into the file
     *
     * @return void
     */
    public function build_uninstall($find, $inline_find, $action_type, $action)
    {
        $find = trim($find, "\n");
        $inline_find = trim($inline_find, "\n");
        $action = trim($action, "\n");
 
        /*
        * This if statement finds out if we are in the special case where
        * a MOD specifies a before action and an after action on the same
        * find.  If this is the case, the uninstaller must see a replace
        * rather than an add
        */
        if (!empty($this->last_action) && $this->last_action[0] == $this->curr_action[0] &&
            (('AFTER' === $this->last_action[2] && 'BEFORE' === $this->curr_action[2])
            || ('BEFORE' === $this->last_action[2] && 'AFTER' === $this->curr_action[2]))) {
            array_pop($this->mod_actions[$this->open_filename]);
 
            $action_type = 'REPLACE';
 
            // Remove the add from the find -- this is an effect of the way the
            // add method works, putting the new lines in the same array element
            // as the find
            $find = str_replace(trim($this->last_action[1]), '', $find);
 
            if ('AFTER' === $this->last_action[2]) {
                $action = $this->curr_action[1]."\n".$this->curr_action[0]."\n".$this->last_action[1];
            } else { // implicit if ($this->last_action[2] == 'BEFORE')
                $action = $this->last_action[1]."\n".$this->curr_action[0]."\n".$this->curr_action[1];
            }
        }
 
        // Build another complex array of MOD Actions
        // This approach is rather memory-intensive ... it might behoove us
        // to think of something else
        if (!$inline_find) {
            $this->mod_actions[$this->open_filename][] = [
                $find => [
                    $action_type => $action,
                ],
            ];
        } else {
            // Do we have preceding in-line-edit(s) on the same complete find or line?
            if (!empty($this->last_action) && $this->last_action[0] == $this->curr_action[0]) {
                $prev_inline_edits = array_pop($this->mod_actions[$this->open_filename]);
                $prev_find = key($prev_inline_edits);
 
                // Add our current in-line-edit
                $prev_inline_edits[$prev_find]['in-line-edit'][] = [
                    $inline_find => [
                        $action_type => [$action],
                    ],
                ];
 
                // Add the new set of in-line-edit's to our MOD Actions array, w/ the updated $find
                $this->mod_actions[$this->open_filename][] = [
                    $find => $prev_inline_edits[$prev_find],
                ];
            } else {
                $this->mod_actions[$this->open_filename][] = [
                    $find => [
                        'in-line-edit' => [
                            [
                                $inline_find => [
                                    $action_type => [$action],
                                ],
                            ],
                        ],
                    ],
                ];
            }
        }
 
        $this->last_action = $this->curr_action;
    }
 
    public function clear_actions()
    {
        // free some memory
        $this->mod_actions = [];
    }
}

class editor_direct extends editor
{
    public function __construct()
    {
        $this->write_method = WRITE_DIRECT;
        $this->install_time = time();
    }
 
    /**
     * Copies files or complete directories.
     *
     * @param $from string Can be a file or a directory. Will copy either the file or all files within the directory
     * @param $to string Where to copy the file(s) to. If not specified then will get copied to the phpbb root directory
     *
     * @return mixed: Bool true on success, error string on failure, NULL if no action was taken
     *
     * NOTE: function should preferably not return in case of failure on only one file.
     *     The current method makes error handling difficult
     */
    public function copy_content($from, $to = '')
    {
        global $phpbb_root_path, $user, $config;
 
        if (0 !== strpos($from, (string) $phpbb_root_path)) {
            $from = $phpbb_root_path.$from;
        }
 
        if (0 !== strpos($to, (string) $phpbb_root_path)) {
            $to = $phpbb_root_path.$to;
        }
 
        $files = [];
        if (is_dir($from)) {
            $files = find_files($from, '.*');
            $dirname_check = $to;
            $to_is_dir = true;
        } elseif (is_file($from)) {
            $files = [$from];
            $dirname_check = dirname($to);
            $to_is_dir = false;
        }
 
        if (empty($files)) {
            return false;
        } elseif (!is_dir($dirname_check) && false === $this->recursive_mkdir($dirname_check)) {
            return sprintf($user->lang['MODS_MKDIR_FAILED'], $dirname_check);
        }
 
        foreach ($files as $file) {
            if ($to_is_dir) {
                $dest = str_replace($from, $to, $file);
 
                $dest_parent_dir = dirname($dest);
                if (!file_exists($dest_parent_dir)) {
                    $this->recursive_mkdir($dest_parent_dir);
                }
            } else {
                $dest = $to;
            }
 
            if (!@copy($file, $dest)) {
                return sprintf($user->lang['MODS_COPY_FAILURE'], $dest);
            }
            @chmod($dest, octdec($config['am_file_perms']));
        }
 
        return true;
    }
 
    public function close_file($new_filename)
    {
        global $phpbb_root_path, $config, $mod_installed, $mod_uninstalled, $force_install;
        global $db, $user;
 
        if (!is_dir($new_filename) && !file_exists(dirname($new_filename))) {
            if (false === $this->recursive_mkdir(dirname($new_filename))) {
                return sprintf($user->lang['MODS_MKDIR_FAILED'], dirname($new_filename));
            }
        }
 
        $file_contents = implode('', $this->file_contents);
 
        if (file_exists($new_filename) && !is_writable($new_filename)) {
            return sprintf($user->lang['WRITE_DIRECT_FAIL'], $new_filename);
        }
 
        if ($this->template_id && ($mod_installed || $mod_uninstalled || $force_install)) {
            update_database_template($new_filename, $this->template_id, $file_contents, $this->install_time);
        }
 
        // If we are not looking at a file stored in the database, use local file functions
        $fr = @fopen($new_filename, 'wb');
        $length_written = @fwrite($fr, $file_contents);
        @chmod($new_filename, octdec($config['am_file_perms']));
 
        // This appears to be correct even with multibyte encodings.  strlen and
        // fwrite both return the number of bytes written, not the number of chars
        if ($length_written < strlen($file_contents)) {
            return sprintf($user->lang['WRITE_DIRECT_TOO_SHORT'], $new_filename);
        }
 
        if (!@fclose($fr)) {
            return sprintf($user->lang['WRITE_DIRECT_FAIL'], $new_filename);
        }
 
        return true;
    }
 
    /**
     * Creates a backup of the currently open file before AutoMOD makes any changes.
     */
    public function backup_file($backup_dir)
    {
        return $this->close_file($backup_dir.$this->open_filename);
    }
 
    /**
     * @author Michal Nazarewicz (from the php manual)
     * Creates all non-existant directories in a path
     *
     * @param $path - path to create
     * @param $mode - CHMOD the new dir to these permissions
     *
     * @return bool
     */
    public function recursive_mkdir($path, $mode = false)
    {
        if (!$mode) {
            global $config;
            $mode = octdec($config['am_dir_perms']);
        }
 
        $dirs = explode('/', $path);
        $count = count($dirs);
        $path = '.';
        for ($i = 0; $i < $count; ++$i) {
            $path .= '/'.$dirs[$i];
 
            if (!is_dir($path)) {
                @mkdir($path, $mode);
                @chmod($path, $mode);
 
                if (!is_dir($path)) {
                    return false;
                }
            }
        }
 
        return true;
    }
 
    public function commit_changes($source, $destination)
    {
        return $this->copy_content($source, $destination);
    }
 
    public function commit_changes_final($source, $destination)
    {
        return null;
    }
 
    public function create_edited_root($dir)
    {
        return $this->recursive_mkdir($dir);
    }
 
    /**
     * Removes a file or a directory (optionally recursively).
     *
     * @param    $path      string (required)   - Filename/Directory path to remove
     * @param    $recursive bool (optional)     - Recursively delete directories
     *
     * @author jasmineaura
     */
    public function remove($path, $recursive = false)
    {
        global $phpbb_root_path, $user;
 
        if (0 !== strpos($path, (string) $phpbb_root_path)) {
            $path = $phpbb_root_path.$path;
        }
 
        if (is_dir($path)) {
            if ($recursive) {
                // recursively delete (in functions_mod.php)
                return recursive_unlink($path);
            } else {
                if (check_empty_dir($path)) {
                    // No error message.
                    // If the directory is not empty it is probably not an error.
 
                    if (!rmdir($path)) {
                        return sprintf($user->lang['MODS_RMDIR_FAILURE'], $path);
                    }
                }
            }
        } else {
            if (!unlink($path)) {
                return sprintf($user->lang['MODS_RMFILE_FAILURE'], $path);
            }
        }
 
        return true;
    }
}

class editor_ftp extends editor
{
    public $transfer;
 
    public function __construct()
    {
        global $config, $user;
 
        $this->write_method = WRITE_FTP;
        $this->install_time = time();
 
        if (!class_exists('transfer')) {
            global $phpbb_root_path, $phpEx;
            include $phpbb_root_path . 'includes/functions_transfer.' . $phpEx;
        }
 
        $this->transfer = new $config['ftp_method']($config['ftp_host'], $config['ftp_username'], request_var('password', ''), $config['ftp_root_path'], $config['ftp_port'], $config['ftp_timeout']);
        $error = $this->transfer->open_session();
 
        // Use the permissions settings specified in the AutoMOD configuration
        $this->transfer->dir_perms = octdec($config['am_dir_perms']);
        $this->transfer->file_perms = octdec($config['am_file_perms']);
 
        if (is_string($error)) {
            // FTP login failed
            trigger_error(sprintf($user->lang['MODS_FTP_CONNECT_FAILURE'], $user->lang[$error]), E_USER_ERROR);
        }
    }
 
    /**
     * Copies files or complete directories.
     *
     * @param $from string Can be a file or a directory. Will copy either the file or all files within the directory
     * @param $to string Where to copy the file(s) to. If not specified then will get copied to the phpbb root directory
     *
     * @return mixed: Bool true on success, error string on failure, NULL if no action was taken
     *
     * NOTE: function should preferably not return in case of failure on only one file.
     *     The current method makes error handling difficult
     */
    public function copy_content($from, $to = '')
    {
        global $phpbb_root_path, $user;
 
        // Prefix $from with $phpbb_root_path
        if (strpos($from, (string) $phpbb_root_path) !== 0) {
            $from = $phpbb_root_path . $from;
        }
 
        if (strpos($to, (string) $phpbb_root_path) !== 0) {
            $to = $phpbb_root_path . $to;
        }
 
        $files = [];
        if (is_dir($from)) {
            $files = find_files($from, '.*');
            $dirname_check = $to;
            $to_is_dir = true;
        } elseif (is_file($from)) {
            $files = [$from];
            $dirname_check = dirname($to);
            $to_is_dir = false;
        }
 
        if (empty($files)) {
            return false;
        } elseif (!is_dir($dirname_check) && $this->recursive_mkdir($dirname_check) === false) {
            return sprintf($user->lang['MODS_MKDIR_FAILED'], $dirname_check);
        }
 
        foreach ($files as $file) {
            if ($to_is_dir) {
                $dest = str_replace($from, $to, $file);
 
                $dest_parent_dir = dirname($dest);
                if (!file_exists($dest_parent_dir)) {
                    $this->recursive_mkdir($dest_parent_dir);
                }
            } else {
                $dest = $to;
            }
 
            // Per functions_transfer.php, overwrite_file() (which we'll use here) is the only
            // transfer method that doesn't strip out phpbb_root_path, because it is called
            // by other methods (write_file, copy_file) that already do so before calling it.
            // The ftp class prepends the real (ftp) $root_path !
            $dest = str_replace($phpbb_root_path, '', $dest);
 
            if (!$this->transfer->overwrite_file($file, $dest)) {
                return sprintf($user->lang['MODS_FTP_FAILURE'], $dest);
            }
        }
 
        return true;
    }
 
    /**
     * Write & close file.
     */
    public function close_file($new_filename)
    {
        global $phpbb_root_path, $edited_root, $mod_installed, $mod_uninstalled, $force_install;
        global $db, $user;
 
        if (!is_dir($new_filename) && !file_exists(dirname($new_filename))) {
            if ($this->recursive_mkdir(dirname($new_filename)) === false) {
                return sprintf($user->lang['MODS_MKDIR_FAILED'], dirname($new_filename));
            }
        }
 
        $file_contents = implode('', $this->file_contents);
 
        if ($this->template_id && ($mod_installed || $mod_uninstalled || $force_install)) {
            update_database_template($new_filename, $this->template_id, $file_contents, $this->install_time);
        }
 
        if (!$this->transfer->write_file($new_filename, $file_contents)) {
            return sprintf($user->lang['MODS_FTP_FAILURE'], $new_filename);
        }
 
        return true;
    }
 
    /**
     * Creates a backup of the currently open file before AutoMOD makes any changes.
     */
    public function backup_file($backup_dir)
    {
        return $this->close_file($backup_dir . $this->open_filename);
    }
 
    /**
     * @ignore
     */
    public function recursive_mkdir($path, $mode = false)
    {
        if ($mode) {
            $this->transfer->dir_perms = $mode;
        }
 
        return $this->transfer->make_dir($path);
    }
 
    public function commit_changes($source, $destination)
    {
        // Move edited files back
        return $this->copy_content($source, $destination);
    }
 
    public function commit_changes_final($source, $destination)
    {
        return null;
    }
 
    public function create_edited_root($dir)
    {
        return $this->recursive_mkdir($dir);
    }
 
    /**
     * Removes a file or a directory (optionally recursively).
     *
     * @param    $path      string (required)   - Filename/Directory path to remove
     * @param    $recursive bool (optional)     - Recursively delete directories
     *
     * @author jasmineaura
     */
    public function remove($path, $recursive = false)
    {
        global $phpbb_root_path, $phpEx, $user;
 
        // No need to strip phpbb_root_path afterwards, as the transfer class
        // functions - remove_dir() and delete_file() - already do that for us
        if (strpos($path, (string) $phpbb_root_path) !== 0) {
            $path = $phpbb_root_path . $path;
        }
 
        if (is_dir($path)) {
            // Recursive delete:
            // remove_dir() in functions_transfer.php still says "todo remove child directories?"
            // It's really easy to recursively delete in ftp, but unfortunately what exposes access to
            // ftp_nlist() (or NLST); "_ls", is private to the transfer class, so we can't use it yet
            if ($recursive) {
                // Insurance - this should never really happen
                if ($path == $phpbb_root_path || is_file("$path/common.$phpEx")) {
                    return false;
                }
 
                // Get all of the files in the source directory
                $files = find_files($path, '.*');
                // Get all of the sub-directories in the source directory
                $subdirs = find_files($path, '.*', 20, true);
 
                // Delete all the files
                foreach ($files as $file) {
                    if (!$this->transfer->delete_file($file)) {
                        return sprintf($user->lang['MODS_RMFILE_FAILURE'], $file);
                    }
                }
 
                // Delete all the sub-directories, in _reverse_ order (array_pop)
                for ($i = 0, $cnt = count($subdirs); $i < $cnt; ++$i) {
                    $subdir = array_pop($subdirs);
                    if (!$this->transfer->remove_dir($subdir)) {
                        return sprintf($user->lang['MODS_RMDIR_FAILURE'], $subdir);
                    }
                }
 
                // Finally, delete the directory itself
                if (!$this->transfer->remove_dir($path)) {
                    return sprintf($user->lang['MODS_RMDIR_FAILURE'], $path);
                }
            } elseif (!$this->transfer->remove_dir($path)) {
                return sprintf($user->lang['MODS_RMDIR_FAILURE'], $path);
            }
        } elseif (!$this->transfer->delete_file($path)) {
            return sprintf($user->lang['MODS_RMFILE_FAILURE'], $path);
        }
 
        return true;
    }
}

class editor_manual extends editor
{
    public function __construct()
    {
        global $config, $phpbb_root_path;
 
        $this->write_method = WRITE_MANUAL;
        $this->install_time = time();
 
        if (!class_exists('compress')) {
            global $phpEx;
            include $phpbb_root_path . 'includes/functions_compress.' . $phpEx;
        }
 
        // Ugly regular expression to extract "tar" from "tar.gz" or "tar.bz2"
        // Made ugly because it does nothing with "zip"
        preg_match('#\.(\w{3})\.?.*#', $config['compress_method'], $match);
        $class = 'compress_' . $match[1];
 
        $this->compress = new $class('w', $phpbb_root_path . 'store/mod_' . $this->install_time . $config['compress_method'], $config['compress_method']);
    }
 
    public function copy_content($from, $to = '')
    {
        global $phpbb_root_path, $user;
 
        if (strpos($from, (string) $phpbb_root_path) !== 0) {
            $from = $phpbb_root_path . $from;
        }
 
        if (strpos($to, (string) $phpbb_root_path) !== 0) {
            $to = $phpbb_root_path . $to;
        }
 
        // Note: phpBB's compression class does support adding a whole directory at a time.
        // However, I chose not to use that function because it would not allow AutoMOD's
        // error handling to work the same as for FTP & Direct methods.
        $files = [];
        if (is_dir($from)) {
            $files = find_files($from, '.*');
            $to_is_dir = true;
        } elseif (is_file($from)) {
            $files = [$from];
            $to_is_dir = false;
        }
 
        if (empty($files)) {
            return false;
        }
 
        foreach ($files as $file) {
            if ($to_is_dir) {
                $dest = str_replace($from, $to, $file);
            } else {
                $dest = $to;
            }
 
            // Replace root path with the "files/" directory that goes in the zip
            $dest = str_replace($phpbb_root_path, 'files/', $dest);
 
            if (!$this->compress->add_custom_file($file, $dest)) {
                return sprintf($user->lang['WRITE_MANUAL_FAIL'], $dest);
            }
        }
 
        // return true since we are now taking an action - NULL implies no action
        return true;
    }
 
    /**
     * Write & close file.
     */
    public function close_file($new_filename)
    {
        global $phpbb_root_path, $edited_root, $mod_installed, $mod_uninstalled, $force_install;
        global $db, $user;
 
        $file_contents = implode('', $this->file_contents);
 
        if ($this->template_id && ($mod_installed || $mod_uninstalled || $force_install)) {
            update_database_template($new_filename, $this->template_id, $file_contents, $this->install_time);
        }
 
        // don't include extra dirs in zip file
        $strip_position = strpos($new_filename, '_edited') + 8; // want the end of the string
 
        $new_filename = 'files/' . substr($new_filename, $strip_position);
 
        if (!$this->compress->add_data($file_contents, $new_filename)) {
            return sprintf($user->lang['WRITE_MANUAL_FAIL'], $new_filename);
        }
 
        return true;
    }
 
    /**
     * Backup is undefined when creating a compressed file.
     */
    public function backup_file($backup_dir)
    {
        return null;
    }
 
    public function recursive_mkdir($path, $mode = 0777)
    {
        return null;
    }
 
    public function commit_changes($source, $destination)
    {
        global $template, $user, $phpbb_admin_path;
 
        $download_url = append_sid("{$phpbb_admin_path}index.php", 'i=mods&mode=frontend&action=download&time=' . $this->install_time);
 
        $template->assign_vars([
            'S_MANUAL_INSTRUCTIONS' => true,
            'L_AM_MANUAL_INSTRUCTIONS' => sprintf($user->lang['AM_MANUAL_INSTRUCTIONS'], '<a href="' . $download_url . '">', '</a>'),
        ]);
 
        meta_refresh(3, $download_url);
 
        $this->compress->close();
 
        return true;
    }
 
    public function commit_changes_final($source, $destination)
    {
        return null;
    }
 
    public function create_edited_root($dir)
    {
        return null;
    }
 
    public function remove($file, $recursive = false)
    {
        return null;
    }
}