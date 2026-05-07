<?php
/**
*
* common [English]
*
* @package language (Kiss Portal Engine)
* @version $Id:$
* @copyright (c) 2005 phpbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @note: Do not remove this copyright. Just append yours if you have modified it, this is part of the Kiss Portal Engine copyright
* @updated 09 May 2011
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

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
// ’ » “ ” …
//
// Portal Menu Names + add you menu language variables here! //

$lang = array_merge($lang, array(
	'SGP_BLOG'         => 'Blog intégré SGP',
	'LINKS_MENU'       => 'Menu des liens',
	'RATINGS_LATEST'   => 'Dernières évaluations',
	'REFRESH_ALL'      => 'Tout actualiser',
	'SITE_NAVIGATOR'   => 'Navigateur',
	'SITE_RULES'       => 'Règles du site',
	'SITE_STATISTICS'  => 'Statistiques du site',
	'STYLES_DEMO'      => 'Démo des styles',
	'STYLE_SELECT'     => 'Sélection du style',
	'UNRESOLVED/BUGS'  => 'Non résolus / Bugs',
	'UPLOAD_IMAGES'    => 'Téléverser des images',
	'USER_INFORMATION' => 'Informations utilisateur',

));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'         => 'Panneau d’administration',
	'BOARD_MINI_NAV'    => 'Sous-navigation',
	'BOARD_STYLE'       => 'Style du forum',
	'BOARD_NAV'         => 'Navigation du forum',
	'BOT_TRACKER'       => 'Suivi des bots',
	'BOT_TRACKER_SMALL' => 'Suivi des bots',
	'CLOUD9_LINKS'      => 'Liens Cloud9',
	'CLOUD9_SEARCHES'   => 'Recherches Cloud9',
	'FM_RADIO'          => 'Radio FM',
	'FORUM_CATEGORIES'  => 'Catégories du forum',
	'MAIN_MENU'         => 'Navigation du forum',
	'MP3_PLAYER'        => 'Lecteur MP3',
	'NEWS_REPORT'       => 'Rapport des actualités du site',
	'PORTAL_STATUS'     => 'État du portail',
	'RECENT_TOPICS'     => 'Sujets récents',
	'SELECT_STYLE'      => 'Sélectionner un nouveau style',
	'SITE_LINK_TXT'     => 'Lien vers notre site',
	'STATS'             => 'Statistiques',
	'STYLE_STATUS'      => 'État des styles',
	'SUB_MENU'          => 'Sous-menu',
	'TOP_10_PICS'       => 'Top 10 des images les mieux notées',
	'TOP_DOWNLOADS'     => 'Top téléchargements',
	'TOP_POSTERS'       => 'Top contributeurs',
	'TOP_TOPICS_DAYS'   => 'au cours des %d derniers jours',
	'WELCOME_SITE'      => 'Bienvenue sur<br /><strong>%s</strong>',
	'YOUR_PROFILE'      => 'Profil utilisateur',

));

// Block Names
$lang = array_merge($lang, array(
	'ADMIN_OPTIONS'           => 'Options d’administration',
	'BUG_TRACKER'             => 'Suivi des bugs',
	'TRANSLATE_SITE'          => '<strong>Choisir la langue</strong>',
	'TRANSLATE_RESET'         => '<strong>Réinitialiser à la langue d’origine</strong>',
	'ANNOUNCEMENTS_AND_NEWS'  => 'Actualités et annonces',
));

// Acronyms
$lang = array_merge($lang, array(
	'ALLOW_ACRONYMS'         => 'Traiter les acronymes locaux (intégrés) dans les messages',
	'ALLOW_ACRONYMS_EXPLAIN' => 'Autoriser les acronymes locaux dans les messages',
));

// IRC Channel(s)
$lang = array_merge($lang, array(
	'IRC_POPUP'    => 'Canal IRC en fenêtre popup',
	'SIGNED_OFF'   => 'Déconnecté',
	'NO_JAVA_SUP'  => 'Pas de prise en charge Java',
	'NO_JAVA_VER'  => 'Désolé, vous avez besoin d’un navigateur compatible Java 1.4.x pour utiliser PJIRC',
));

// Age ranges
$lang = array_merge($lang, array(
	'AGE_RANGE'        => 'Tranche d’âge',
	'AVERAGE_AGE'      => 'Âge moyen',
	'TOTAL_AGE'        => 'Âge total',
	'TOTAL_AGE_COUNTS' => 'Nombre total par âge',
));

// RSS Newsfeeds
$lang = array_merge($lang, array(
	'NO_CURL'               => 'curl non installé. Utilisez fopen à la place (modification dans l’ACP)',
	'NO_FOPEN'              => 'fopen non installé. Utilisez curl à la place (modification dans l’ACP)',
	'RSS_CACHE_ERROR'       => 'Désolé, aucun élément RSS trouvé dans le fichier cache.',
	'RSS_DISABLED'          => 'Les flux d’actualités sont actuellement désactivés',
	'RSS_FEED_ERROR'        => 'Ou bien il y a un problème avec le flux RSS.',
	'RSS_LIST_ERROR'        => 'Impossible d’obtenir la liste RSS.',
	'RSS_ERROR'             => 'Erreur RSS - Vérifiez le lien du flux (ci-dessus) pour confirmer.',
	'LOG_RSS_CACHE_CLEANED' => 'Cache RSS vidé',
));

// HTTP Referrals
$lang = array_merge($lang, array(
	'TOT_REF' => 'Total des référencements',
));

// Mini Mods
$lang = array_merge($lang, array(
	'CHECK_VERSION'  => 'Vérifier les mises à jour',
));


