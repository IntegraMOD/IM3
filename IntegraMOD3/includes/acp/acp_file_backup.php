<?php
/**
*
* @package acp
* @version $Id: acp_file_backup.php,v 1.00 2008/22/02 livewirestu Exp $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

//include($phpbb_root_path . 'zipper.' . $phpEx);

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_file_backup
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $table_prefix;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		
		$user->add_lang('mods/file_backup');

		$this->tpl_name = 'acp_file_backup';
		$this->page_title = 'ACP_FILE_BACKUP';

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$template->assign_vars(array(
			'MODE'	=> $mode
		));

		switch ($mode)
		{
			case 'backup':

				$this->page_title = 'ACP_FILE_BACKUP';

				switch ($action)
				{
					case 'download':
						$type	= request_var('type', '');
						$file_list	= request_var('table', array(''));
						$format	= request_var('method', '');
						$where	= request_var('where', '');

						if (!sizeof($file_list))
						{
							trigger_error($user->lang['FILE_SELECT_ERROR'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$store = $download = $structure = false;

						if ($where == 'store_and_download' || $where == 'store')
						{
							$store = true;
						}

						if ($where == 'store_and_download' || $where == 'download')
						{
							$download = true;
						}

						@set_time_limit(1200);

						$time = time();

						$file_name = 'file_backup_' . $time . '_' . unique_id();
                        $file_store_path = $phpbb_root_path . "file_store/";
                        $dest_file = $file_store_path . $file_name;
                        
                        if(zip_files($file_list, $dest_file) != true)
                        {
                            trigger_error($user->lang['FILE_BACKUP_FAILURE'] . adm_back_link($this->u_action), E_USER_WARNING);
                            break;
                        }
                        
	                    if ($download == true)
                        {
                            $file = $dest_file . '.zip';
                            if(!file_exists($file))
                            {
                                trigger_error($user->lang['FILE_BACKUP_FAILURE'] . adm_back_link($this->u_action), E_USER_WARNING);
                            }
                            header("Content-type: application/force-download");
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-length: ".filesize($file));
                            header("Content-disposition: attachment; filename=\"".basename($file)."\"");
                            readfile("$file");
                        }
                        
                        if($store != true)
                        {
                            @unlink($file);
                        }                        
    					
                        add_log('admin', 'LOG_FILE_BACKUP');
						trigger_error($user->lang['FILE_BACKUP_SUCCESS'] . adm_back_link($this->u_action));
					break;

					default:
						include($phpbb_root_path . 'includes/functions_install.' . $phpEx);
						$files = array();
                        $files = get_files($files);
						foreach ($files as $file_name)
						{
							$template->assign_block_vars('files', array(
								'FILE'	=> $file_name
							));
						}
						unset($files);

						$template->assign_vars(array(
							'U_ACTION'	=> $this->u_action . '&amp;action=download'
						));
						
						$available_methods = array('gzip' => 'zlib', 'bzip2' => 'bz2');

						foreach ($available_methods as $type => $module)
						{
							if (!@extension_loaded($module))
							{
								continue;
							}

							$template->assign_block_vars('methods', array(
								'TYPE'	=> $type
							));
						}

						$template->assign_block_vars('methods', array(
							'TYPE'	=> 'text'
						));
					break;
				}
			break;
            default:
            break;
            
		}
	}
}

function get_files($files)
{
global $phpbb_root_path;

$exclude = array('..', '.', 'config.php', 'file_store');
  
$dh = opendir($phpbb_root_path);
while (false !== ($file = readdir($dh))) 
{
    // Get directories first
    if (is_dir("$phpbb_root_path/$file")) 
    {       
        if(!in_array($file, $exclude)) // Exclude files
        {
            $files[] = $file;           
        }
    }
}
closedir($dh);

$dh = opendir($phpbb_root_path);
while (false !== ($file = readdir($dh))) 
{
    // Now get files
    if (!is_dir("$phpbb_root_path/$file")) 
    {       
        if(!in_array($file, $exclude)) // Exclude files
        {
            $files[] = $file;           
        }
    }
}
closedir($dh);
    
    return $files;
}

function zip_files($file_list, $destination_file)
{
    global $phpbb_root_path, $phpEx;
  
    include($phpbb_root_path . 'includes/pclzip.lib.' . $phpEx);
    
    $file_string = '';
    foreach($file_list as $file)
    {
        $file_string .= $phpbb_root_path . $file . ',';
    }
    $file_string = substr($file_string, 0, -1);   // Strip final comma
    
    $archive = new PclZip($destination_file . '.zip');
    $v_list = $archive->create($file_string, PCLZIP_OPT_REMOVE_PATH, "../");
    if ($v_list == 0)
    {
        return false;
    }
    return true;
}

?>