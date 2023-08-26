<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_physical.php 2 2014/05/01 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class dl_physical extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function read_exist_files()
	{
		global $db;

		$dl_files = dl_files::all_files(0, '', '', '', 0, 1, 'real_file');

		$exist_files = array();

		for ($i = 0; $i < sizeof($dl_files); $i++)
		{
			$exist_files[] = $dl_files[$i]['real_file'];
		}

		$sql = 'SELECT ver_real_file FROM ' . DL_VERSIONS_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$exist_files[] = $row['ver_real_file'];
		}

		$db->sql_freeresult($result);

		return $exist_files;
	}

	public static function read_dl_dirs($download_dir, $path = '')
	{
		global $user, $cur, $unas_files;

		$folders = '';

		$dl_dir = substr($download_dir, 0, strlen($download_dir)-1);

		@$dir = opendir($download_dir . $path);

		while (false !== ($file=@readdir($dir)))
		{
			if ($file{0} != ".")
			{
				if(is_dir($download_dir . $path . '/' . $file))
				{
					$temp_dir = $dl_dir . $path . '/' . $file;
					$temp_dir = str_replace(dl_init::phpbb_root_path(), '', $temp_dir);
					$folders .= ('/'.$cur != $path . '/' . $file) ? '<option value="' . $dl_dir . $path . '/' . $file . '/">'.$user->lang['DL_MOVE'].' » ' . $temp_dir . '/</option>' : '';
					$folders .= self::read_dl_dirs($download_dir, $path . '/' . $file);
				}
			}
		}

		closedir($dir);

		return $folders;
	}

	public static function read_dl_files($download_dir, $path = '', $unas_files = array())
	{
		$files = '';

		$dl_dir = ($path) ? $download_dir : substr($download_dir, 0, strlen($download_dir)-1);

		@$dir = opendir($dl_dir . $path);

		while (false !== ($file=@readdir($dir)))
		{
			if ($file{0} != ".")
			{
				$files .= (in_array($file, $unas_files)) ? $path . '/' . $file . '|' : '';
				$files .= self::read_dl_files($download_dir, $path . '/' . $file, $unas_files);
			}
		}

		@closedir($dir);

		return $files;
	}

	public static function read_dl_sizes($download_dir)
	{
		$file_size = 0;

		if (@function_exists('scandir'))
		{
			$dirs = array_diff(scandir($download_dir), array(".", ".."));
			$dir_array = array();

			foreach($dirs as $d)
			{
				if (is_dir($download_dir . '/' . $d))
				{
					$file_size += self::read_dl_sizes($download_dir . '/' . $d);
				}
				else
				{
					$file_size += sprintf("%u", @filesize($download_dir . '/' . $d));
				}
			}
		}
		else
		{
			$file_size = self::_old_read_dl_sizes($download_dir);
		}

		return $file_size;
	}

	// Internal function for PHP 4 compliant
	private static function _old_read_dl_sizes($download_dir, $path = '')
	{
		$file_size = 0;

		$dl_dir = substr($download_dir, 0, strlen($download_dir)-1);

		@$dir = opendir($dl_dir . $path);

		while (false !== ($file=@readdir($dir)))
		{
			if ($file{0} != ".")
			{
				$file_size += sprintf("%u", @filesize($dl_dir . $path . '/' . $file));
				$file_size += self::_old_read_dl_sizes($download_dir, $path . '/' . $file);
			}
		}

		@closedir($dir);

		return $file_size;
	}

	// Added by suggestion from Neverbirth. Thx to him!!!
	public static function readfile_chunked($filename, $retbytes = true)
	{
		$chunksize = 1048576;
		$buffer = '';
		$cnt =0;
		$handle = fopen($filename, 'rb');

		if ($handle === false)
		{
			return false;
		}

		while (!feof($handle))
		{
			$buffer = fread($handle, $chunksize);
			echo $buffer;
			if ($retbytes)
			{
				$cnt += strlen($buffer);
			}
	         ob_flush();
	         flush();
		}

		$status = fclose($handle);

		if ($retbytes && $status)
		{
			return $cnt;
		}

		return $status;
	}

	public static function dl_max_upload_size()
	{
		$post_max	= ini_get('post_max_size');
		$upload_max	= ini_get('upload_max_filesize');

		$post_max_unit		= substr($post_max, -1, 1);
		$upload_max_unit	= substr($upload_max, -1, 1);

		$post_max_value		= intval(substr($post_max, 0, strlen($post_max) - 1));
		$upload_max_value	= intval(substr($upload_max, 0, strlen($upload_max) - 1));

		$unit_factor = array('K' => 1024, 'M' => 1024*1024, 'G' => 1024*1024*1024);

		$post_max_size		= $post_max_value * $unit_factor[$post_max_unit];
		$upload_max_size	= $upload_max_value * $unit_factor[$upload_max_unit];
		
		$max_upload_size = min($post_max_size, $upload_max_size);

		return dl_format::dl_size($max_upload_size, 0, 'combine');
	}
}

?>