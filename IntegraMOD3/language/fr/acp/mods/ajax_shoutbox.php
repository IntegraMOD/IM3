<?php
/**
*
* Module info ajax shoutbox [English]
*
* @package language
* @version $Id: ajax_shoutbox.php 253 2008-02-16 13:50:55Z paul $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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

$lang = array_merge($lang, array(
	'ACP_SHOUTBOX_SETTINGS'				=> 'Paramètres de la shoutbox Ajax',
	'ACP_SHOUTBOX_SETTINGS_EXPLAIN'     => 'Vous trouverez ici quelques paramètres de base de la shoutbox Ajax.',
	'ACP_SHOUTBOX_OVERVIEW'             => 'Aperçu de la shoutbox Ajax',

	// Overview
	'AS_OVERVIEW'			=> 'Aperçu du MOD',
	'AS_OVERVIEW_EXPLAIN'	=> 'Vous trouverez ci-dessous quelques statistiques sur la shoutbox Ajax.<br />
	Si vous trouvez un bug ou souhaitez proposer une fonctionnalité, veuillez visiter notre <a href="http://www.paulsohier.nl/ajax">trac</a>.<br />
	Avant de soumettre, veuillez vérifier si le bug ou la fonctionnalité n’a pas déjà été signalé(e). <br />
	Beaucoup d’informations sur la shoutbox, son état de développement et plus encore sont également disponibles sur notre trac.<br />
	Les permissions de la shoutbox se trouvent dans l’onglet permissions en haut, puis dans les permissions utilisateur ou groupe.',

	
	'AS_STATS'      => 'Statistiques de la shoutbox',
	'NUMBER_SHOUTS' => 'Nombre total de messages',
	'AS_VERSION'    => 'Version de la shoutbox',
	'AS_OPTIONS'    => 'Options de la shoutbox',
	'PURGE_AS'      => 'Supprimer tous les messages',
	
	'UNABLE_CONNECT'    => 'Impossible de se connecter au serveur de vérification de version, erreur : %s',
	'NEW_VERSION'       => 'Votre version de la shoutbox Ajax n’est pas à jour. Votre version est %1$s, la version la plus récente est %2$s. Lisez <a href="%3$s">ceci</a> pour plus d’informations',
	
	
	// Configuration
	'AS_PRUNE_TIME'				=> 'Temps de purge',
	'AS_PRUNE_TIME_EXPLAIN'		=> 'Temps après lequel les messages sont automatiquement supprimés. Si le paramètre du nombre maximum de messages est activé, il remplacera ce paramètre. Définissez cette valeur à 0 pour désactiver',
	'AS_MAX_POSTS'				=> 'Nombre maximum de messages',
	'AS_MAX_POSTS_EXPLAIN'		=> 'Nombre maximum de messages. Définissez 0 pour désactiver. Si ce paramètre est activé, il <strong>remplacera</strong> le paramètre de purge !',
	
	'AS_FLOOD_INTERVAL'         => 'Intervalle anti-flood',
	'AS_FLOOD_INTERVAL_EXPLAIN' => 'Temps minimum entre deux messages pour les utilisateurs. Définissez 0 pour désactiver.',
	
	'AS_IE_NR'				=> 'Nombre de messages',
	'AS_IE_NR_EXPLAIN'		=> 'Nombre de messages dans Internet Explorer. En raison de certains bugs d’IE, vous devez éviter de définir une valeur trop élevée.',
	'AS_NON_IE_NR'			=> 'Nombre de messages',
	'AS_NON_IE_NR_EXPLAIN'	=> 'Nombre de messages dans les autres navigateurs que IE.',
));

