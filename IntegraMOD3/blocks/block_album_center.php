<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.stargate-portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_center_album.php 336 2009-01-23 02:09:37U HelterSkelter $
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
    include_once($phpbb_root_path . 'gallery/includes/functions_recent.' . $phpEx);

    $ints = array(
       'rows'      => 2,
       'columns'   => 4,
    );

recent_gallery_images($ints, 117, 2, false, false, 'album');

?>