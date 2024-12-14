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

/**
 * MOD Parser class
 * Basic wrapper to run individual parser functions
 * Also contains some parsing functions that are global (i.e. needed for all parsers).
 */
class parser
{
    public $parser;
 
    /**
     * constructor, sets type of parser.
     */
    public function __construct($ext)
    {
        switch ($ext) {
            case 'xml':
                // fix ticket 62689 only enter parser if it is xml
                // http://www.phpbb.com/bugs/modteamtools/62689
                $this->parser = new parser_xml();
            break;
            default:
        }
    }
 
    public function set_file($file)
    {
        $this->parser->set_file($file);
    }
 
    public function get_details()
    {
        return $this->parser->get_details();
    }
 
    public function get_actions()
    {
        return $this->parser->get_actions();
    }
 
    public function get_modx_version()
    {
        if (!$this->parser->modx_version) {
            $this->get_details();
        }
 
        return $this->parser->modx_version;
    }
 
    /**
     * Returns the needed sql query to reverse the actions taken by the given query.
     *
     * @todo: Add more
     */
    public function reverse_query($orig_query)
    {
        if (preg_match('#ALTER TABLE\s([a-z_]+)\sADD(?:\sCOLUMN)?\s([a-z_]+)#i', $orig_query, $matches)) {
            return "ALTER TABLE {$matches[1]} DROP COLUMN {$matches[2]};";
        } elseif (preg_match('#CREATE TABLE\s([a-z_]+)#i', $orig_query, $matches)) {
            return "DROP TABLE {$matches[1]};";
        }
 
        return false;
    }
 
    /**
     * Parse sql.
     *
     * @param array $sql_query
     */
    public function parse_sql(&$sql_query)
    {
        global $dbms, $table_prefix;
 
        if (!function_exists('get_available_dbms')) {
            global $phpbb_root_path, $phpEx;
 
            include $phpbb_root_path.'includes/functions_install.'.$phpEx;
        }
 
        static $available_dbms;
 
        if (!isset($available_dbms)) {
            $available_dbms = get_available_dbms($dbms);
        }
 
        $remove_remarks = $available_dbms[$dbms]['COMMENTS'];
        $delimiter = $available_dbms[$dbms]['DELIM'];
 
        if (count($sql_query) == 1) {
            // do some splitting here
            $sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
            $remove_remarks($sql_query[0]);
            $sql_query = $this->split_sql_file($sql_query[0], $delimiter);
        } else {
            $query_count = count($sql_query);
            for ($i = 0; $i < $query_count; ++$i) {
                $sql_query[$i] = preg_replace('#phpbb_#i', $table_prefix, $sql_query[$i]);
                $remove_remarks($sql_query[$i]);
            }
        }
 
        // return $sql_query;
    }
 
    /**
     * Returns the edits array, but now filled with edits to reverse the given array.
     *
     * @todo: Add more
     */
    public function reverse_edits($actions)
    {
        $reverse_edits = [];
 
        if (!empty($actions['EDITS'])) {
            foreach ($actions['EDITS'] as $file => $edit_ary) {
                foreach ($edit_ary as $edit_id => $edit) {
                    foreach ($edit as $find => $action_ary) {
                        foreach ($action_ary as $type => $command) {
                            // it is possible for a single edit in the install process
                            // to become more than one in the uninstall process
                            while (isset($reverse_edits['EDITS'][$file][$edit_id])) {
                                ++$edit_id;
                            }
 
                            switch (strtoupper($type)) {
                                // for before and after adds, we use the find as a tool for more precise finds
                                // this isn't perfect, but it seems better than having
                                // finds of only a couple characters, like "/*"
                                case 'AFTER ADD':
                                    $total_find = rtrim($find, "\n")."\n".trim($command, "\n");
 
                                    $reverse_edits['EDITS'][$file][$edit_id][$total_find]['replace with'] = $find;
                                break;
 
                                case 'BEFORE ADD':
                                    $total_find = rtrim($command, "\n")."\n".trim($find, "\n");
 
                                    // replace with the find
                                    $reverse_edits['EDITS'][$file][$edit_id][$total_find]['replace with'] = $find;
                                break;
 
                                case 'REPLACE WITH':
                                case 'REPLACE, WITH':
                                case 'REPLACE-WITH':
                                case 'REPLACE':
                                    // replace $command (new code) with $find (original code)
                                    $reverse_edits['EDITS'][$file][$edit_id][$command]['replace with'] = $find;
                                break;
 
                                case 'IN-LINE-EDIT':
                                    // build the reverse just like the normal action
                                    foreach ($command as $action_id => $inline_edit) {
                                        foreach ($inline_edit as $inline_find => $inline_action_ary) {
                                            foreach ($inline_action_ary as $inline_action => $inline_command) {
                                                $inline_command = $inline_command[0];
 
                                                switch (strtoupper($inline_action)) {
                                                    case 'IN-LINE-AFTER-ADD':
                                                    case 'IN-LINE-BEFORE-ADD':
                                                        // Replace with a blank string
                                                        $reverse_edits['EDITS'][$file][$edit_id][$find]['in-line-edit'][$action_id][$inline_command]['in-line-replace'][] = '';
                                                    break;
 
                                                    case 'IN-LINE-REPLACE':
                                                        // replace with the inline find
                                                        $reverse_edits['EDITS'][$file][$edit_id][$find]['in-line-edit'][$action_id][$inline_command][$inline_action][] = $inline_find;
                                                    break;
 
                                                    default:
                                                        // For the moment, we do nothing.  What about increment?
                                                    break;
                                                }
 
                                                ++$action_id;
                                            }
                                        }
                                    }
                                break;
 
                                default:
                                    // again, increment
                                break;
                            }
                        }
                    }
                }
            }
        }
 
        if (!empty($actions['NEW_FILES'])) {
            foreach ($actions['NEW_FILES'] as $source => $target) {
                $reverse_edits['DELETE_FILES'][$source] = $target;
            }
        }
 
        if (empty($actions['SQL'])) {
            return $reverse_edits;
        }
 
        if (count($actions['SQL']) == 1) {
            $actions['SQL'] = explode("\n", $actions['SQL'][0]);
        }
 
        foreach ($actions['SQL'] as $query) {
            $reverse_edits['SQL'][] = self::reverse_query($query);
        }
 
        return $reverse_edits;
    }
 
    /**
     * Split SQL file into individual queries.
     *
     * @param string $sql
     * @param string $delimiter
     * @return array
     */
    private function split_sql_file($sql, $delimiter)
    {
        $sql = str_replace("\r" , '', $sql);
        $data = preg_split('/' . preg_quote($delimiter, '/') . '$/m', $sql);
        $data = array_map('trim', $data);
        // The empty case
        return array_filter($data);
    }
}

/**
 * XML parser.
 */
class parser_xml
{
    public $data;
    public $file;
    public $modx_version;

    /**
     * set data to read from.
     */
    public function set_file($file)
    {
        // Shouldn't ever happen since the master class reads file names from
        // the file system and lists them
        if (!file_exists($file)) {
            trigger_error('Cannot locate File: '.$file);
        }

        $this->file = $file;
        $this->data = trim(file_get_contents($file));
        $this->data = str_replace(["\r\n", "\r"], "\n", $this->data);

        $XML = new xml_array();
        $this->data = $XML->parse($this->file, $this->data);

        return;
    }

    /**
     * return array of the basic MOD details.
     */
    public function get_details()
    {
        global $user;

        if (empty($this->data)) {
            $this->set_file($this->file);
        }

        $header = [
            'MOD-VERSION' => [0 => ['children' => []]],
            'INSTALLATION' => [0 => ['children' => ['TARGET-VERSION' => [0 => ['data' => '']]]]],
            'AUTHOR-GROUP' => [0 => ['children' => ['AUTHOR' => []]]],
            'HISTORY' => [0 => ['children' => ['ENTRY' => []]]],
        ];

        $version = $phpbb_version = '';

        $header = $this->data[0]['children']['HEADER'][0]['children'];

        // get MOD version information
        // This is also our first opportunity to differentiate MODX 1.0.x from
        // MODX 1.2.0.
        if (isset($header['MOD-VERSION'][0]['children'])) {
            $this->modx_version = 1.0;

            $version_info = $header['MOD-VERSION'][0]['children'];
            $version = (isset($version_info['MAJOR'][0]['data'])) ? trim($version_info['MAJOR'][0]['data']) : 0;
            $version .= '.'.((isset($version_info['MINOR'][0]['data'])) ? trim($version_info['MINOR'][0]['data']) : 0);
            $version .= '.'.((isset($version_info['REVISION'][0]['data'])) ? trim($version_info['REVISION'][0]['data']) : 0);
            $version .= (isset($version_info['RELEASE'][0]['data'])) ? trim($version_info['RELEASE'][0]['data']) : '';
        } else {
            $this->modx_version = 1.2;

            $version = trim($header['MOD-VERSION'][0]['data']);
        }

        // get phpBB version recommendation
        switch ($this->modx_version) {
            case 1.0:
                if (isset($header['INSTALLATION'][0]['children']['TARGET-VERSION'][0]['children'])) {
                    $version_info = $header['INSTALLATION'][0]['children']['TARGET-VERSION'][0]['children'];

                    $phpbb_version = (isset($version_info['MAJOR'][0]['data'])) ? trim($version_info['MAJOR'][0]['data']) : 0;
                    $phpbb_version .= '.'.((isset($version_info['MINOR'][0]['data'])) ? trim($version_info['MINOR'][0]['data']) : 0);
                    $phpbb_version .= '.'.((isset($version_info['REVISION'][0]['data'])) ? trim($version_info['REVISION'][0]['data']) : 0);
                    $phpbb_version .= (isset($version_info['RELEASE'][0]['data'])) ? trim($version_info['RELEASE'][0]['data']) : '';
                }
            break;

            case 1.2:
            default:
                $phpbb_version = $header['INSTALLATION'][0]['children']['TARGET-VERSION'][0]['data'] ?? 0;
            break;
        }

        $author_info = $header['AUTHOR-GROUP'][0]['children']['AUTHOR'];

        $author_details = [];
        for ($i = 0; $i < count($author_info); ++$i) {
            $author_details[] = [
                'AUTHOR_NAME' => isset($author_info[$i]['children']['USERNAME'][0]['data']) ? trim($author_info[$i]['children']['USERNAME'][0]['data']) : '',
                'AUTHOR_EMAIL' => isset($author_info[$i]['children']['EMAIL'][0]['data']) ? trim($author_info[$i]['children']['EMAIL'][0]['data']) : '',
                'AUTHOR_REALNAME' => isset($author_info[$i]['children']['REALNAME'][0]['data']) ? trim($author_info[$i]['children']['REALNAME'][0]['data']) : '',
                'AUTHOR_WEBSITE' => isset($author_info[$i]['children']['HOMEPAGE'][0]['data']) ? trim($author_info[$i]['children']['HOMEPAGE'][0]['data']) : '',
            ];
        }

        // history
        $history_info = (!empty($header['HISTORY'][0]['children']['ENTRY'])) ? $header['HISTORY'][0]['children']['ENTRY'] : [];
        $history_size = count($history_info);

        $mod_history = [];
        for ($i = 0; $i < $history_size; ++$i) {
            $changes = [];
            $entry = $history_info[$i]['children'];
            $changelog = $entry['CHANGELOG'] ?? [];
            $changelog_size = count($changelog);
            $changelog_id = 0;

            for ($j = 0; $j < $changelog_size; ++$j) {
                // Ignore changelogs in foreign languages except in the case that there is no
                // match for the current user's language
                // TODO: Look at modifying localise_tags() for use here.
                if (match_language($user->data['user_lang'], $changelog[$j]['attrs']['LANG'])) {
                    $changelog_id = $j;
                }
            }

            $change_count = isset($changelog[$changelog_id]['children']['CHANGE']) ? count($changelog[$changelog_id]['children']['CHANGE']) : 0;
            for ($j = 0; $j < $change_count; ++$j) {
                $changes[] = $changelog[$changelog_id]['children']['CHANGE'][$j]['data'];
            }

            switch ($this->modx_version) {
                case 1.0:
                    $changelog_version_ary = $entry['REV-VERSION'][0]['children'] ?? [];

                    $changelog_version = (isset($changelog_version_ary['MAJOR'][0]['data'])) ? trim($changelog_version_ary['MAJOR'][0]['data']) : 0;
                    $changelog_version .= '.'.((isset($changelog_version_ary['MINOR'][0]['data'])) ? trim($changelog_version_ary['MINOR'][0]['data']) : 0);
                    $changelog_version .= '.'.((isset($changelog_version_ary['REVISION'][0]['data'])) ? trim($changelog_version_ary['REVISION'][0]['data']) : 0);
                    $changelog_version .= (isset($changelog_version_ary['RELEASE'][0]['data'])) ? trim($changelog_version_ary['RELEASE'][0]['data']) : '';
                break;

                case 1.2:
                default:
                    $changelog_version = $entry['REV-VERSION'][0]['data'] ?? '0.0.0';
                break;
            }

            $mod_history[] = [
                'DATE' => $entry['DATE'][0]['data'],
                'VERSION' => $changelog_version,
                'CHANGES' => $changes,
            ];
        }

        $children = [];

        // Parse links
        if (1.2 == $this->modx_version) {
            $link_group = $header['LINK-GROUP'][0]['children'] ?? [];

            if (isset($link_group['LINK'])) {
                for ($i = 0, $size = count($link_group['LINK']); $i < $size; ++$i) {
                    // do some stuff with attrs
                    // commented out due to a possible PHP bug.  When using this,
                    // sizeof($link_group) changed each time ...
                    // $attrs = &$link_group[$i]['attrs'];

                    if (!isset($link_group['LINK'][$i])) {
                        continue;
                    }

                    if ('text' == $link_group['LINK'][$i]['attrs']['TYPE']) {
                        continue;
                    }

                    $children[$link_group['LINK'][$i]['attrs']['TYPE']][] = [
                        'href' => $link_group['LINK'][$i]['attrs']['HREF'],
                        'realname' => $link_group['LINK'][$i]['attrs']['REALNAME'] ?? core_basename($link_group['LINK'][$i]['attrs']['HREF']),
                        'title' => localise_tags($link_group, 'LINK', $i),
                        'lang' => $link_group['LINK'][$i]['attrs']['LANG'],
                    ];
                }
            }
        }

        // try not to hardcode schema?
        $details = [
            'MOD_PATH' => $this->file,
            'MOD_NAME' => get_title($header),
//'MOD_NAME'=> localise_tags($header, 'TITLE'),
            'MOD_DESCRIPTION' => nl2br(localise_tags($header, 'DESCRIPTION')),
            'MOD_VERSION' => htmlspecialchars(trim($version)),
//'MOD_DEPENDENCIES'=> (isset($header['TITLE'][0]['data'])) ? htmlspecialchars(trim($header['TITLE'][0]['data'])) : '',

            'AUTHOR_DETAILS' => $author_details,
            'AUTHOR_NOTES' => nl2br(localise_tags($header, 'AUTHOR-NOTES')),
            'MOD_HISTORY' => $mod_history,
            'PHPBB_VERSION' => $phpbb_version,
            'CHILDREN' => $children,
        ];

        return $details;
    }

    /**
     * returns complex array containing all mod actions.
     */
    public function get_actions()
    {
        global $db, $user;

        $actions = [];

        $xml_actions = $this->data[0]['children']['ACTION-GROUP'][0]['children'];

        // sql
        $actions['SQL'] = [];
        $sql_info = (!empty($xml_actions['SQL'])) ? $xml_actions['SQL'] : [];

        $match_dbms = [];
        switch ($db->sql_layer) {
            case 'firebird':
            case 'oracle':
            case 'postgres':
            case 'sqlite':
            case 'mssql':
            case 'db2':
                $match_dbms = [$db->sql_layer];
            break;

            case 'mssql_odbc':
                $match_dbms = ['mssql'];
            break;

            // and now for the MySQL fun
            // This will generate an array of things we can probably use, but
            // will not have any priority
            case 'mysqli':
                $match_dbms = ['mysql_41', 'mysqli', 'mysql'];
            break;

            case 'mysql4':
            case 'mysql':
                if (version_compare($db->sql_server_info(true), '4.1.3', '>=')) {
                    $match_dbms = ['mysql_41', 'mysql4', 'mysql', 'mysqli'];
                } elseif (version_compare($db->sql_server_info(true), '4.0.0', '>=')) {
                    $match_dbms = ['mysql_40', 'mysql4', 'mysql', 'mysqli'];
                } else {
                    $match_dbms = ['mysql'];
                }
            break;

            // Should never happen
            default:
            break;
        }

        for ($i = 0; $i < count($sql_info); ++$i) {
            if (1.0 == $this->modx_version) {
                $actions['SQL'][] = (!empty($sql_info[$i]['data'])) ? trim($sql_info[$i]['data']) : '';
            } elseif (1.2 == $this->modx_version) {
                // Make a slightly shorter name.
                $xml_dbms = &$sql_info[$i]['attrs']['DBMS'];

                if (!isset($sql_info[$i]['attrs']['DBMS']) || in_array($xml_dbms, $match_dbms)) {
                    $actions['SQL'][] = (!empty($sql_info[$i]['data'])) ? trim($sql_info[$i]['data']) : '';
                } else {
                    // NOTE: skipped SQL is not currently useful
                    $sql_skipped = true;
                }
            }
        }

        // new files
        $new_files_info = (!empty($xml_actions['COPY'])) ? $xml_actions['COPY'] : [];
        for ($i = 0; $i < count($new_files_info); ++$i) {
            $new_files = $new_files_info[$i]['children']['FILE'];
            for ($j = 0; $j < count($new_files); ++$j) {
                $from = str_replace('\\', '/', $new_files[$j]['attrs']['FROM']);
                $to = str_replace('\\', '/', $new_files[$j]['attrs']['TO']);
                $actions['NEW_FILES'][$from] = $to;
            }
        }

        $delete_files_info = (!empty($xml_actions['DELETE'])) ? $xml_actions['DELETE'] : [];
        for ($i = 0; $i < count($delete_files_info); ++$i) {
            $delete_files = $delete_files_info[$i]['children']['FILE'];
            for ($j = 0; $j < count($delete_files); ++$j) {
                $name = str_replace('\\', '/', $delete_files[$j]['attrs']['NAME']);
                $actions['DELETE_FILES'][] = $name;
            }
        }

        // open
        $open_info = (!empty($xml_actions['OPEN'])) ? $xml_actions['OPEN'] : [];
        for ($i = 0; $i < count($open_info); ++$i) {
            $current_file = str_replace('\\', '/', trim($open_info[$i]['attrs']['SRC']));
            $actions['EDITS'][$current_file] = [];

            $edit_info = (!empty($open_info[$i]['children']['EDIT'])) ? $open_info[$i]['children']['EDIT'] : [];
            // find, after add, before add, replace with
            for ($j = 0; $j < count($edit_info); ++$j) {
                $action_info = (!empty($edit_info[$j]['children'])) ? $edit_info[$j]['children'] : [];

                // store some array information to help decide what kind of operation we're doing
                $action_count = $total_action_count = $remove_count = $find_count = 0;
                if (isset($action_info['ACTION'])) {
                    $action_count += count($action_info['ACTION']);
                }

                if (isset($action_info['INLINE-EDIT'])) {
                    $total_action_count += count($action_info['INLINE-EDIT']);
                }

                if (isset($action_info['REMOVE'])) {
                    $remove_count = count($action_info['REMOVE']); // should be an integer bounded between zero and one
                }

                if (isset($action_info['FIND'])) {
                    $find_count = count($action_info['FIND']);
                }

                // the basic idea is to transform a "remove" tag into a replace-with action
                if ($remove_count && !$find_count) {
                    // but we still support it if $remove_count is > 1
                    for ($k = 0; $k < $remove_count; ++$k) {
                        // if there is no find tag associated, handle it directly
                        $actions['EDITS'][$current_file][$j][trim($action_info['REMOVE'][$k]['data'], "\n\r")]['replace with'] = '';
                    }
                } elseif ($remove_count && $find_count) {
                    // if there is a find and a remove, transform into a replace-with
                    // action, and let the logic below sort out the relationships.
                    for ($k = 0; $k < $remove_count; ++$k) {
                        $insert_index = (isset($action_info['ACTION'])) ? count($action_info['ACTION']) : 0;

                        $action_info['ACTION'][$insert_index] = [
                            'data' => '',
                            'attrs' => ['TYPE' => 'replace with'],
                        ];
                    }
                } elseif (!$find_count) {
                    trigger_error(sprintf($user->lang['INVALID_MOD_NO_FIND'], htmlspecialchars($action_info['ACTION'][0]['data'])), E_USER_WARNING);
                }

                // first we try all the possibilities for a FIND/ACTION combo, then look at inline possibilities.

                if (isset($action_info['ACTION'])) {
                    for ($k = 0; $k < $find_count; ++$k) {
                        // is this anything but the last iteration of the loop?
                        if ($k < ($find_count - 1)) {
                            // NULL has special meaning for an action ... no action to be taken; advance pointer
                            $actions['EDITS'][$current_file][$j][$action_info['FIND'][$k]['data']] = null;
                        } else {
                            // this is the last iteration, assign the action tags

                            for ($l = 0; $l < $action_count; ++$l) {
                                $type = str_replace('-', ' ', $action_info['ACTION'][$l]['attrs']['TYPE']);
                                $actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$k]['data'], "\n\r")][$type] = (isset($action_info['ACTION'][$l]['data'])) ? preg_replace("#^(\s)+\n#", '', rtrim(trim($action_info['ACTION'][$l]['data'], "\n"))) : '';
                            }
                        }
                    }
                } else {
                    if (!$remove_count && !$total_action_count) {
                        trigger_error(sprintf($user->lang['INVALID_MOD_NO_ACTION'], htmlspecialchars($action_info['FIND'][0]['data'])), E_USER_WARNING);
                    }
                }

                // add comment to the actions array
                $actions['EDITS'][$current_file][$j]['comment'] = localise_tags($action_info, 'COMMENT');

                // inline
                if (isset($action_info['INLINE-EDIT'])) {
                    $inline_info = (!empty($action_info['INLINE-EDIT'])) ? $action_info['INLINE-EDIT'] : [];

                    if (isset($inline_info[0]['children']['INLINE-REMOVE']) && count($inline_info[0]['children']['INLINE-REMOVE'])) {
                        // overwrite the existing array with the new one
                        $inline_info[0]['children'] = [
                            'INLINE-FIND' => $inline_info[0]['children']['INLINE-REMOVE'],
                            'INLINE-ACTION' => [
                                0 => [
                                    'attrs' => ['TYPE' => 'replace-with'],
                                    'data' => '',
                                ],
                            ],
                        ];
                    }
                    if ($find_count > $total_action_count) {
                        // Yeah, $k is used more than once for different information
                        for ($k = 0; $k < $find_count; ++$k) {
                            // is this anything but the last iteration of the loop?
                            if ($k < ($find_count - 1)) {
                                // NULL has special meaning for an action ... no action to be taken; advance pointer
                                $actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$k]['data'], "\r\n")] = null;
                            }
                        }
                    }

                    /*
                    * This loop attaches the in-line information to the _last
                    * find_ in the <edit> tag.  This is the intended behavior
                    * Any additional finds ought to be in a different edit tag
                    */
                    for ($k = 0; $k < count($inline_info); ++$k) {
                        $inline_data = (!empty($inline_info[$k]['children'])) ? $inline_info[$k]['children'] : [];

                        $inline_find_count = (isset($inline_data['INLINE-FIND'])) ? count($inline_data['INLINE-FIND']) : 0;

                        $inline_comment = localise_tags($inline_data, 'INLINE-COMMENT');
                        $actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$find_count - 1]['data'], "\r\n")]['in-line-edit']['inline-comment'] = $inline_comment;

                        $inline_actions = (!empty($inline_data['INLINE-ACTION'])) ? $inline_data['INLINE-ACTION'] : [];

                        if (empty($inline_actions)) {
                            trigger_error(sprintf($user->lang['INVALID_MOD_NO_ACTION'], htmlspecialchars($inline_data['INLINE-FIND'][0]['data'])), E_USER_WARNING);
                        }
                        if (empty($inline_find_count)) {
                            trigger_error(sprintf($user->lang['INVALID_MOD_NO_FIND'], htmlspecialchars($inline_actions[0]['data'])), E_USER_WARNING);
                        }

                        for ($l = 0; $l < $inline_find_count; ++$l) {
                            $inline_find = $inline_data['INLINE-FIND'][$l]['data'];

                            // trying to reduce the levels of arrays without impairing features.
                            // need to keep the "full" edit intact.
                            //
                            // inline actions must be trimmed in case the MOD author
                            // inserts a new line by mistake
                            if ($l < ($inline_find_count - 1)) {
                                $actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$find_count - 1]['data'], "\r\n")]['in-line-edit'][$k][$inline_find]['in-line-'][] = null;
                            } else {
                                for ($m = 0; $m < count($inline_actions); ++$m) {
                                    $type = str_replace(',', '-', str_replace(' ', '', $inline_actions[$m]['attrs']['TYPE']));
                                    if (!empty($inline_actions[$m]['data'])) {
                                        $actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$find_count - 1]['data'], "\r\n")]['in-line-edit'][$k][$inline_find]['in-line-'.$type][] = trim($inline_actions[$m]['data'], "\n");
                                    } else {
                                        $actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$find_count - 1]['data'], "\r\n")]['in-line-edit'][$k][$inline_find]['in-line-'.$type][] = '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (!empty($xml_actions['PHP-INSTALLER'])) {
            $actions['PHP_INSTALLER'] = $xml_actions['PHP-INSTALLER'][0]['data'];
        }

        if (!empty($xml_actions['DIY-INSTRUCTIONS'])) {
            $actions['DIY_INSTRUCTIONS'] = localise_tags($xml_actions, 'DIY-INSTRUCTIONS');
        }

        return $actions;
    }
}

/**
 * XML processing.
 */
class xml_array
{
    public $output = [];
    public $parser;
    public $XML;
 
    public function parse($file, $XML)
    {
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, 'tag_open', 'tag_closed');
        xml_set_character_data_handler($this->parser, 'tag_data');
 
        $this->XML = xml_parse($this->parser, $XML);
        if (!$this->XML) {
            throw new Exception(sprintf('XML error: %s at line %d. View the file %s in a web browser for a more detailed error message.',
                xml_error_string(xml_get_error_code($this->parser)),
                xml_get_current_line_number($this->parser),
                $file
            ));
        }
 
        xml_parser_free($this->parser);
 
        return $this->output;
    }
 
    public function tag_open($parser, $name, $attrs)
    {
        $tag = ['name' => $name, 'attrs' => $attrs];
        array_push($this->output, $tag);
    }
 
    public function tag_data($parser, $tag_data)
    {
        // Should be a string but let's make sure.
        $tag_data = (string) $tag_data;
 
        if ('' !== $tag_data) {
            $lastIndex = count($this->output) - 1;
            if (isset($this->output[$lastIndex]['data'])) {
                $this->output[$lastIndex]['data'] .= $tag_data;
            } else {
                $this->output[$lastIndex]['data'] = $tag_data;
            }
        }
    }
 
    public function tag_closed($parser, $name)
    {
        $lastIndex = count($this->output) - 1;
        $parentIndex = $lastIndex - 1;
        if (!isset($this->output[$parentIndex]['children'][$name])) {
            $this->output[$parentIndex]['children'][$name] = [];
        }
        $this->output[$parentIndex]['children'][$name][] = $this->output[$lastIndex];
        array_pop($this->output);
    }
}