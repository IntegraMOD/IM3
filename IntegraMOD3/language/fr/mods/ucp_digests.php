<?php
/** 
*
* ucp_digests.php [French]
*
* @package language
* @version $Id: v3_modules.xml 52 2007-12-09 19:45:45Z jelly_doughnut $
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
		
global $config;
				
$lang = array_merge($lang, array(
	'DIGEST_ALL_FORUMS'					=> 'Tout',
	'DIGEST_AUTHOR'						=> 'Auteur',
	'DIGEST_BAD_EOL'					=> 'La fin de revet la valeur de %s est nul.', 
	'DIGEST_BOARD_LIMIT'				=> '%s (Limite du forum)',
	'DIGEST_BY'							=> 'Par',
	'DIGEST_CONNECT_SOCKET_ERROR'		=> 'Incapable d’ouvrir la connexion au site phpBB de Smartfeed, l’erreur transmise est:<br />%s',
	'DIGEST_COUNT_LIMIT'				=> 'Nombre maximum de message dans le rapport',
	'DIGEST_COUNT_LIMIT_EXPLAIN'		=> 'Entrez un nombre plus grand que zéro si vous voulez limiter le nombre de message dans le rapport.',
	'DIGEST_CURRENT_VERSION_INFO'		=> 'Vous utilisez la version <strong>%s</strong>.',
	'DIGEST_DAILY'						=> 'Quotidien',
	'DIGEST_DATE'						=> 'Date',
	'DIGEST_DISABLED_MESSAGE'			=> 'Pour valider le champ, sélectionnez Basic et choisissez un type de rapport',
	'DIGEST_DISCLAIMER'					=> 'Ce rapport est transmis aux membres inscrits de <a href="%s">%s</a>. Vous pouvez modifier ou supprimer votre abonnement via le <a href="%sucp.%s"> Tableau de commande de l’utilisateur</a>. Si vous avez des questions sur le format de ce rapport, contactez le webmaster du site <a href="mailto:%s">%s </a>.',
	'DIGEST_EXPLANATION'				=> 'Les rapports contiennent les messages du forum, ils sont transmis quotidienement, hebdomadairement ou mensuellement a l’heure souhaitée et pour les forums selectionnés.',
	'DIGEST_FILTER_ERROR'				=> "mail_digests.$phpEx invalide user_digest_filter_type = %s",
	'DIGEST_FILTER_FOES'				=> 'Supprimer les messages des utilisateurs ignorés dans mes rapports',
	'DIGEST_FILTER_TYPE'				=> 'Type de messages dans le rapport',
	'DIGEST_FORMAT_ERROR'				=> "mail_digests.$phpEx invalide user_digest_format of %s",
	'DIGEST_FORMAT_FOOTER' 				=> 'Format du rapport:',
	'DIGEST_FORMAT_HTML'				=> 'HTML',
	'DIGEST_FORMAT_HTML_EXPLAIN'		=> 'LE HTML fournira la mise en forme, le BBCode et les signatures (si permis). Les feuilles de stype sont appliquées si votre programme d’e-mail le permet.',
	'DIGEST_FORMAT_HTML_CLASSIC'		=> 'HTML classique',
	'DIGEST_FORMAT_HTML_CLASSIC_EXPLAIN'	=> 'Similaire au HTML, sauf les messages de sujet contenus dans des tables',
	'DIGEST_FORMAT_PLAIN'				=> 'HTML simple',
	'DIGEST_FORMAT_PLAIN_EXPLAIN'		=> 'LE HTML simple n’applique pas de style ou de couleurs',
	'DIGEST_FORMAT_PLAIN_CLASSIC'		=> 'HTML classique simple',
	'DIGEST_FORMAT_PLAIN_CLASSIC_EXPLAIN'	=> 'Similaire au HTML Simple sauf les messages de sujet repris dans les tables',
	'DIGEST_FORMAT_STYLING'				=> 'Type de rapport',
	'DIGEST_FORMAT_STYLING_EXPLAIN'		=> 'Le style du rapport dépend des capacités de votre programme d’e-mail. Déplacer votre curseur sur le type de style pour plus d’informations.',
	'DIGEST_FORMAT_TEXT'				=> 'Texte',
	'DIGEST_FORMAT_TEXT_EXPLAIN'		=> 'Aucun HTML n´apparaîtra dans le rapport.',
	'DIGEST_FREQUENCY'					=> 'Type de rapport',
	'DIGEST_FREQUENCY_EXPLAIN'			=> "Les rapports hebdomadaires sont transmis le %s. Les rapports mensuels sont transmis le premier du mois, l´heure UTC est utilisée pour les rapports journaliers",
	'DIGEST_INTRODUCTION' 				=> 'Voici le dernier rapport des messages de %s.',
	'DIGEST_LASTVISIT_RESET'			=> 'Réinitialiser ma dernière date de visite lorsque j’envoie un rapport.',
	'DIGEST_LATEST_VERSION_INFO'		=> 'La dernière version disponible est <strong>%s</strong>.',
	'DIGEST_LINK'						=> 'Lien',
	'DIGEST_LOG_WRITE_ERROR'			=> 'Incapable d’écrire pour noter le chemin = %s. Ceci est fréquemment causé par le manque de public écrit des permissions sur ce dossier.',
	'DIGEST_MAIL_FREQUENCY' 			=> 'Fréquence des envois',
	'DIGEST_MARK_READ'					=> 'Marquer les messages comme lus lorsqu´ils apparaissent dans mon rapport',
	'DIGEST_MAX_SIZE'					=> 'Taille maximum des mots dans un message.',
	'DIGEST_MAX_SIZE_EXPLAIN'			=> 'Notice: To ensure consistent rendering, if a post must be truncated, the HTML will be removed from the post. Leave blank to allow the full post text to appear. If the "Show no post text at all" option is checked, this field is ignored. Laissez vide pour permettre au texte intégral post à comparaître. Si l\'option «Afficher aucun texte à tous les post option" est cochée, ce champ est ignoré.',
	'DIGEST_MAX_WORDS_NOTIFIER'			=> '... ',
	'DIGEST_MIN_SIZE'					=> 'Taille minimum des mots apparaissant dans un rapport',
	'DIGEST_MIN_SIZE_EXPLAIN'			=> 'Si vous laissez ce champ vide ou sur 0, le nombre de mots dans les messages ne sera pas filtré.',
	'DIGEST_MONTHLY'					=> 'Mensuellement',
	'DIGEST_NEW'						=> 'Nouveau',
	'DIGEST_NEW_POSTS_ONLY'				=> 'Afficher les nouveaux messages uniquement',
	'DIGEST_NEW_POSTS_ONLY_EXPLAIN'		=> 'Cette option permet de supprimer des rapports les messages publiés AVANT votre dernière visite. Attention, les messages non lus avant votre dernière visite ne seront pas affiché dans les rapports.',
	'DIGEST_NO_CONSTRAINT'				=> 'Aucune contrainte',
	'DIGEST_NO_FORUMS_CHECKED' 			=> 'Sélectionnez au minimum un forum.',
	'DIGEST_NO_LIMIT'					=> 'Aucune limite',
	'DIGEST_NO_POSTS'					=> 'Il n’y a pas de nouveaux messages.',
	'DIGEST_NO_POST_TEXT'				=> 'Afficher aucun texte post à tous les',
	'DIGEST_NO_PRIVATE_MESSAGES'		=> 'Il n’y a pas de nouveaux messages privés.',
	'DIGEST_NONE'						=> 'Aucun (se désabonner)',
	'DIGEST_ON'							=> 'sur',
	'DIGEST_POST_TEXT'					=> 'Texte du message', 
	'DIGEST_POST_TIME'					=> 'Heure du message', 
	'DIGEST_POST_SIGNATURE_DELIMITER'	=> '<br />____________________<br />', // Place here whatever code (make sure it is valid XHTML) you want to use to distinguish the end of a post from the beginning of the signature line
	'DIGEST_POSTS_TYPE_ANY'				=> 'Tous les messages',
	'DIGEST_POSTS_TYPE_FIRST'			=> 'Les premiers sujets des messages seulement',
	'DIGEST_POWERED_BY'					=> 'Powered by',
	'DIGEST_PRIVATE_MESSAGES_IN_DIGEST'	=> 'Ajouter mes messages privés non lus dans mes rapports',
	'DIGEST_PUBLISH_DATE'				=> 'Date du rapport %s',
	'DIGEST_REMOVE_YOURS'				=> 'Supprimer mes messages des rapports',
	'DIGEST_ROBOT'						=> 'Robot',
	'DIGEST_SALUTATION' 				=> 'Bonjour',
	'DIGEST_SELECT_FORUMS'				=> 'Inclure les messages des forums sélectionnés',
	'DIGEST_SELECT_FORUMS_EXPLAIN'		=> 'Les catégories et les forums affichés sont ceux que vous avez autorisé en lecture. La sélection des forums est désactivée lorsque vous sélectionnez Mes sujets favoris seulement.',
	'DIGEST_SEND_HOUR' 					=> 'Heure d’envoi',
	'DIGEST_SEND_HOUR_EXPLAIN'			=> 'L’heure d’envoi est basée sur l’heure UTC affichée dans vos paramètres personnels',
	'DIGEST_SEND_IF_NO_NEW_MESSAGES'	=> 'Envoyer un rapport s’il n’y a pas de nouveau message:',
	'DIGEST_SEND_ON_NO_POSTS'	 		=> 'Envoyer un rapport s’il n’y a pas de nouveau message',
	'DIGEST_SHOW_MY_MESSAGES' 			=> 'Afficher mes messages dans ce rapport:',
	'DIGEST_SHOW_NEW_POSTS_ONLY' 		=> 'Afficher uniquement les nouveaux messages',
	'DIGEST_SHOW_PMS' 					=> 'Afficher mes messages privés',
	'DIGEST_SIZE_ERROR'					=> "Champ obligatoire. Vous devez entrer un nombre entier positif, égal ou supérieur au maximum permis par l’administrateur de ce Forum. Le maximum permis est %s. Si cette valeur est zéro, il n'y a pas de limite.",
	'DIGEST_SIZE_ERROR_MIN'				=> 'Vous devez entrer une valeur positive ou laisser le champ vide, si la valeur est zéro, il n´y a pas de limite',
	'DIGEST_SOCKET_FUNCTIONS_DISABLED'	=> 'Socket functions are currently disabled',
	'DIGEST_SORT_BY'					=> 'Ordre de tri',
	'DIGEST_SORT_BY_ERROR'				=> "mail_digests.$phpEx a été appelé avec un invalide user_digest_sortby = %s",
	'DIGEST_SORT_BY_EXPLAIN'			=> 'Tous les rapports sont triés par catégorie, puis par forum comme ils apparaissent dans le forum principal. Les options de tri s’appliquent à la manière dont les messages sont triés dans les sujets. Par défaut les messages sont triés selon l’heure du message (ascendante)',
	'DIGEST_SORT_FORUM_TOPIC'			=> 'Par défaut',
	'DIGEST_SORT_FORUM_TOPIC_DESC'		=> 'Par défaut, Dernier messages en premier',
	'DIGEST_SORT_POST_DATE'				=> 'Du plus vieux au plus nouveau',
	'DIGEST_SORT_POST_DATE_DESC'		=> 'Du plus nouveau au plus vieux',
	'DIGEST_SORT_USER_ORDER'			=> 'Utiliser mes préferénces du forum',
	'DIGEST_SQL_PMS'					=> 'SQL a utilisé pour les messages privés pour %s: %s',
	'DIGEST_SQL_PMS_NONE'				=> 'Aucun SQL émis pour les messages privés pour %s car l’utilisateur a choisi de ne pas montrer de messages privés dans le rapport.',
	'DIGEST_SQL_POSTS_USERS'			=> 'SQL a utilisé pour les messages pour %s: %s',
	'DIGEST_SQL_USERS'					=> 'SQL a rapporté des utilisateurs obtenant des rapports: %s',
	'DIGEST_SUBJECT_LABEL'				=> 'Sujet',
	'DIGEST_SUBJECT_TITLE'				=> '%s  Rapport %s',
	'DIGEST_TIME_ERROR'					=> "mail_digests.$phpEx calculated a bad digest send hour of %s",
	'DIGEST_TOTAL_POSTS'				=> 'Nombre de message(s) dans ce rapport:',
	'DIGEST_TOTAL_UNREAD_PRIVATE_MESSAGES'	=> 'Nombre de message(s) prives, non lus:',
	'DIGEST_UNREAD'						=> 'Non lu',
	'DIGEST_UPDATED'					=> 'Vos réglages de rapports sont enregistrés.',
	'DIGEST_USE_BOOKMARKS'				=> 'Mes sujets favoris seulement',
	'DIGEST_VERSION_NOT_UP_TO_DATE'		=> 'Administrateur attention : cette version de rapport de phpBB n’est pas la dernière. Les mises à jour sont disponibles sur le site Internet de Digest <a href="%s"></a>.',
	'DIGEST_VERSION_UP_TO_DATE'			=> 'Cette version de rapport de Digest phpBB est à jour, aucune mise à jour n´est disponible.',
	'DIGEST_WEEKDAY' => array(
		0	=> 'Dimanche',
		1 	=> 'Lundi',
		2	=> 'Mardi',
		3	=> 'Mercredi',
		4	=> 'Jeudi',
		5	=> 'Vendredi',
		6	=> 'Samedi'),
	'DIGEST_WEEKLY'						=> 'Hebdomadaire',
	'DIGEST_YOU_HAVE_PRIVATE_MESSAGES' 	=> 'Vous avez des messages privés',
	'DIGEST_YOUR_DIGEST_OPTIONS' 		=> 'Vos options de rapport:',
	'S_DIGEST_TITLE'					=> (isset($config['digests_digests_title'])) ? $config['digests_digests_title'] : 'phpBB Digests',
	'UCP_DIGESTS_MODE_ERROR'			=> 'Les rapports ont été appelé avec un mode nul de %s',
				
));
			
?>