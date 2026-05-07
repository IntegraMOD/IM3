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
	'AJAX_CHECK_USERNAME_FALSE'		=>	'Ce nom d\'utilisateur est déjà pris',
	'AJAX_CHECK_USERNAME_TRUE'		=>	'Ce nom d\'utilisateur est disponible',
	'AJAX_CHECKING'					=>	'Vérification via AJAX',
	'AJAX_CHECKING_USERNAME'		=>	'Vérification de la disponibilité du nom d\'utilisateur',
	'AJAX_CHECKING_PASSWORD'		=>	'Vérification que les mots de passe sont identiques',
	'AJAX_CHECKING_EMAIL'			=>	'Vérification que les adresses e-mail sont identiques',
	'AJAX_CHECK_PASSWORD_TRUE'		=>	'Vos mots de passe sont identiques',
	'AJAX_CHECK_PASSWORD_FALSE'		=>	'Vos mots de passe ne sont pas identiques',
	'AJAX_CHECK_PASSWORD_STRENGTH'	=>	'Solidité du mot de passe',
	'AJAX_CHECK_PASSWORD_STRENGTH_1'	=>	'Mot de passe très faible',
	'AJAX_CHECK_PASSWORD_STRENGTH_2'	=>	'Mot de passe faible',
	'AJAX_CHECK_PASSWORD_STRENGTH_3'	=>	'Mot de passe acceptable',
	'AJAX_CHECK_PASSWORD_STRENGTH_4'	=>	'Mot de passe fort',
	'AJAX_CHECK_EMAIL_TRUE'			=>	'Vos adresses e-mail sont identiques',
	'AJAX_CHECK_EMAIL_FALSE'		=>	'Vos adresses e-mail ne sont pas identiques',
	'AJAX_CHECK_EMAIL_FORMAT_FALSE'	=>	'Le format de votre adresse e-mail est incorrect',
));