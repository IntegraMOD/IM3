<?php
/**
*
* common [English]
*
* @package language
* @version $Id: calendar.php,v ALPHA 3.5 2007/10/02 12:00:00 jcc264 Exp $
* @copyright (c) 2007 M and J Media
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
   $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// â€™ Â» â€œ â€ â€¦
//
// Board Settings
$lang = array_merge($lang, array(
	'ACP_CALENDAR_SETTINGS'					=> 'Paramètres du calendrier',
	'ACP_CALENDAR_SETTINGS_EXPLAIN'			=> 'Vous pouvez définir ici les paramètres généraux du calendrier.<br />Certaines de ces options seront également disponibles pour les utilisateurs, individuellement. Cependant, vous avez la possibilité de remplacer les paramètres des utilisateurs',
	'ACP_CALENDAR_USER_SETTINGS'			=> 'Paramètres utilisateur du calendrier',
	'ACP_CALENDAR_USER_SETTINGS_EXPLAIN'	=> 'Vous pouvez gérer ici les paramètres des utilisateurs pour le calendrier',
	'OVERRIDE_USER'							=> 'Remplacer les paramètres des utilisateurs',
	'OVERRIDE_USER_EXPLAIN'					=> 'Vous pouvez décider d’utiliser vos paramètres pour tous les utilisateurs, ou de leur permettre de personnaliser les paramètres',
	'ALLOW_PRIV_EVENTS'						=> 'Autoriser les événements privés',
	'ALLOW_PRIV_EVENTS_EXPLAIN'				=> 'Les événements privés ne peuvent être vus que par les utilisateurs spécifiés par l’auteur de l’événement',
	'ALLOW_INDEX_MINICAL'					=> 'Autoriser le mini calendrier sur l’index',
	'SHOW_WEEK_NUMS'						=> 'Afficher les numéros de semaine',
	'SHOW_WEEK_NUMS_EXPLAIN'				=> 'Vous pouvez afficher en option les numéros de semaine ISO-8601 dans la vue principale du calendrier',
	'MONDAY_FIRST'							=> 'Jour de début du calendrier',
	'MONDAY_FIRST_EXPLAIN'					=> 'Afficher les semaines du calendrier à partir du dimanche ou du lundi',
	'SHOW_EVENTS_LIST'						=> 'Afficher la liste des événements',
	'SHOW_EVENTS_LIST_EXPLAIN'				=> 'Afficher en option une liste des événements à venir sous la vue principale du calendrier. Vous pouvez définir le nombre de jours à l’avance pour lesquels les événements doivent être affichés',
	'SHOW_BIRTHDAYS_LIST'					=> 'Afficher la liste des anniversaires',
	'SHOW_BIRTHDAYS_LIST_EXPLAIN'			=> 'Afficher en option une liste des anniversaires à venir sous la vue principale du calendrier. Vous pouvez définir le nombre de jours à l’avance pour lesquels les anniversaires doivent être affichés',
	'SHOW_BIRTHDAYS_MAIN'					=> 'Afficher les anniversaires dans le calendrier',
	'SHOW_BIRTHDAYS_MAIN_EXPLAIN'			=> 'Afficher en option les anniversaires dans la vue principale du calendrier',
	'MAX_EVENTS_LIST_DAYS'					=> 'Nombre maximum de jours pour la liste des événements',
	'MAX_EVENTS_LIST_DAYS_EXPLAIN'			=> 'Définir le nombre maximum de jours qu’un utilisateur peut spécifier pour afficher les événements à venir dans la liste des événements sous la vue principale du calendrier',
	'DEFAULT_EVENTS_LIST_DAYS'				=> 'Nombre de jours par défaut pour la liste des événements',
	'DEFAULT_EVENTS_LIST_DAYS_EXPLAIN'		=> 'Définir la valeur par défaut du nombre de jours d’événements à venir à afficher dans la liste des événements sous la vue principale du calendrier',
	'MAX_BDAYS_LIST_DAYS'					=> 'Nombre maximum de jours pour la liste des anniversaires',
	'MAX_BDAYS_LIST_DAYS_EXPLAIN'			=> 'Définir le nombre maximum de jours qu’un utilisateur peut spécifier pour afficher les anniversaires à venir dans la liste des anniversaires sous la vue principale du calendrier',
	'DEFAULT_BDAYS_LIST_DAYS'				=> 'Nombre de jours par défaut pour la liste des anniversaires',
	'DEFAULT_BDAYS_LIST_DAYS_EXPLAIN'		=> 'Définir la valeur par défaut du nombre de jours d’anniversaires à venir à afficher dans la liste des anniversaires sous la vue principale du calendrier',
	'CALENDAR_VERSION'						=> 'Version du calendrier',
	'CALENDAR_VERSION_EXPLAIN'				=> 'Version actuellement installée du module calendrier.<br />Pour le support, visitez : www.stargate-portal.com',
	'SUNDAY'								=> 'Dimanche',
	'MONDAY'								=> 'Lundi',
));

