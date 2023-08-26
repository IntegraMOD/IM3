<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dlmod.php 61 2012/03/18 OXPUS
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

class dl_mod
{
	/*
	* init phpBB variables
	*/
	private $phpbb_root_path;
	private $php_ext;
	private $path;

	public function __construct($phpbb_root_path, $php_ext = 'php')
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = '.' . $php_ext;
		$this->path = $this->phpbb_root_path . 'dl_mod/classes/class_';
	}

	public function register()
	{
		spl_autoload_register(array($this, 'dl_class'));
	}

	public function unregister()
	{
		spl_autoload_unregister(array($this, 'dl_class'));
	}

	public function dl_class($class)
	{
		if (!class_exists($class))
		{
			$path = file_exists($this->path . $class . $this->php_ext);
	
			if ($path)
			{
				require ($this->path . $class . $this->php_ext);
			}
		}
	}
}

?>