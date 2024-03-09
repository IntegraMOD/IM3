<?php
/*
+-----------------------------------------------------------------------+
|        _____                                                          |
|       /\  __`\                                                        |
|       \ \ \/\ \  __  __     __   ____    ____      __                 |
|        \ \ \ \ \/\ \/\ \  /'__`\/\_ ,`\ /\_ ,`\  /'__`\               |
|         \ \ \\'\\ \ \_\ \/\  __/\/_/  /_\/_/  /_/\ \L\.\_             |
|          \ \___\_\ \____/\ \____\ /\____\ /\____\ \__/.\_\            |
|           \/__//_/\/___/  \/____/ \/____/ \/____/\/__/\/_/            |
|                                                                       |
+-----------------------------------------------------------------------+
| Support Site  : www.Quezza.com                                        |
| Contact Email : LoonyLuke@gmail.com (NOT FOR SUPPORT)                 |
| Copyright     : (c) 2007 Luke Cousins (LoonyLuke) & Quezza Dev Team   |
| Portions (C)  : (c) 2007 phpBB Group                                  |
+-----------------------------------------------------------------------+
| Quezza is free software; you can redistribute it and/or               |
| modify it under the terms of the GNU General Public License           |
| as published by the Free Software Foundation; either version 2        |
| of the License, or (at your option) any later version.                |
|                                                                       |
| Quezza is distributed in the hope that it will be useful,             |
| but WITHOUT ANY WARRANTY; without even the implied warranty of        |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         |
| GNU General Public License for more details.                          |
|                                                                       |
| You should have received a copy of the GNU General Public License     |
| along with this program; if not, please visit: www.Quezza.com/GPL.php |
+-----------------------------------------------------------------------+
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// AJAX Checks stuff
$lang = array_merge($lang, array(
	'AJAX_CHECK_USERNAME_FALSE'		=>	'This username has already been taken',
	'AJAX_CHECK_USERNAME_TRUE'		=>	'This username is still available',
	'AJAX_CHECKING'					=>	'Checking using AJAX',
	'AJAX_CHECKING_USERNAME'		=>	'Checking that your username is still available',
	'AJAX_CHECKING_PASSWORD'		=>	'Checking that your password are the same',
	'AJAX_CHECKING_EMAIL'			=>	'Checking that your email addresses are the same',
	'AJAX_CHECK_PASSWORD_TRUE'		=>	'Your passwords are the same',
	'AJAX_CHECK_PASSWORD_FALSE'		=>	'Your passwords are not the same',
	'AJAX_CHECK_PASSWORD_STRENGTH'	=>	'Your password strength',
	'AJAX_CHECK_PASSWORD_STRENGTH_1'	=>	'Very Weak password',
	'AJAX_CHECK_PASSWORD_STRENGTH_2'	=>	'Weak password',
	'AJAX_CHECK_PASSWORD_STRENGTH_3'	=>	'Acceptable password',
	'AJAX_CHECK_PASSWORD_STRENGTH_4'	=>	'Strong password',
	'AJAX_CHECK_EMAIL_TRUE'			=>	'Your email addresses are the same',
	'AJAX_CHECK_EMAIL_FALSE'		=>	'Your email addresses are not the same',
	'AJAX_CHECK_EMAIL_FORMAT_FALSE'	=>	'Your email address format is incorrect',
));

?>