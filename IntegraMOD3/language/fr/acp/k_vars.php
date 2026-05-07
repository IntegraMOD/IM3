<?php
/**
*
* @package Kiss Portal Engine (acp_k_vars) (English)
*
* @package language
* @version $Id:$ 1.0.19
* @copyright (c) 2005-2011 Michael O'Toole (mike@phpbbireland.com)
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'TITLE_MAIN'   => 'Variable générale du portail',
	'TITLE_BLOCK'  => 'Variable de bloc du portail',
	'TITLE_EXPLAIN_MAIN'  => 'Paramètres des variables utilisées par les blocs généraux du portail...',
	'TITLE_EXPLAIN_BLOCK' => '&bull; Les blocs peuvent contenir des variables (généralement stockées dans la table K_BLOCKS_CONFIG_VAR_TABLE).
	<br />&bull; Chaque bloc peut avoir un fichier HTML associé (pour définir les variables), ceux-ci sont situés dans le dossier adm/style/k_block_vars.<br />&bull; Si vous ajoutez vos propres variables de bloc, vous devez inclure le fichier HTML pour afficher et modifier ces variables.',

	'NEWS_SETTINGS'       => 'Paramètres des actualités',
	'K_NEWS_TYPE'         => 'Type d’actualités',
	'K_NEWS_TYPE_EXPLAIN' => 'Local, global ou les deux.',
	'LOCAL_ANNOUNCE'      => 'Annonce locale ',
	'GLOBAL_ANNOUNCE'     => 'Annonce globale',
	'LOCAL_NEWS'          => 'Actualité locale',
	'GLOBAL_NEWS'         => 'Actualité globale',
	'BOTH'                => 'Les deux types',

	'RECENT_TOPICS_SETTINGS'             => 'Paramètres des sujets récents',
	'K_RECENT_TOPICS_TO_DISPLAY'         => 'Nombre de sujets récents à afficher si les données du bloc sont statiques',
	'K_RECENT_TOPICS_TO_DISPLAY_EXPLAIN' => 'Remarque : si vous autorisez le défilement, tous les messages récents seront affichés.',

	'K_RECENT_SEARCH_DAYS'               => 'Sur combien de jours effectuer la recherche ?',
	'K_RECENT_SEARCH_DAYS_EXPLAIN'       => 'Limiter le nombre de jours pour réduire la charge de la base de données.',

	'POSTS_TYPES'                        => 'Inclure tous les types de messages',
	'POSTS_TYPES_EXPLAIN'                => 'Oui pour afficher tous les types de messages, Non pour afficher uniquement les messages normaux et épinglés...',

	'K_NEWS_ITEMS_TO_DISPLAY'            => 'Nombre d’actualités à afficher',
	'K_NEWS_ITEMS_TO_DISPLAY_EXPLAIN'    => 'Nombre d’actualités affichées sur la page du portail.',

	'K_RECENT_TOPICS_PER_FORUM'          => 'Nombre de sujets par forum',
	'K_RECENT_TOPICS_PER_FORUM_EXPLAIN'  => 'Nombre maximum de sujets retournés par forum.',

	'K_NEWS_ITEM_MAX_LENGTH'             => 'Longueur des actualités',
	'K_NEWS_ITEM_MAX_LENGTH_EXPLAIN'     => 'Longueur maximale à afficher pour chaque actualité, 0 pour afficher l’article complet.',
	'K_NEWS_ALLOW'                       => 'Autoriser l’affichage des actualités',
	'K_NEWS_ALLOW_EXPLAIN'               => 'Autoriser l’affichage des actualités sur la page du portail.',

	'ANNOUNCE_SETTINGS'                  => 'Paramètres des annonces',
	'ANNOUNCE_FORUM_ID'                  => 'ID du forum des annonces',
	'ANNOUNCE_FORUM_ID_EXPLAIN'          => 'ID du forum des annonces.',
	'K_ANNOUNCE_TO_DISPLAY'              => 'Nombre d’annonces à afficher',
	'K_ANNOUNCE_TO_DISPLAY_EXPLAIN'      => 'Nombre d’annonces affichées sur la page du portail.',
	'K_ANNOUNCE_ITEM_MAX_LENGTH'         => 'Longueur des annonces',
	'K_ANNOUNCE_ITEM_MAX_LENGTH_EXPLAIN' => 'Longueur maximale de chaque annonce à afficher, 0 pour afficher l’article complet.',
	'K_ANNOUNCE_ALLOW'                   => 'Autoriser les annonces',
	'K_ANNOUNCE_ALLOW_EXPLAIN'           => 'Autoriser l’affichage des annonces sur le portail.',

	'BOT_SETTINGS'                       => 'Paramètres des bots',
	'K_BOT_DISPLAY_ALLOW'                => 'Autoriser le rapport des bots',
	'K_BOT_DISPLAY_ALLOW_EXPLAIN'        => 'Activer/désactiver le rapport des bots.',
	'K_BOTS_TO_DISPLAY'                  => 'Nombre de bots à afficher',
	'K_BOTS_TO_DISPLAY_EXPLAIN'          => 'Vous pouvez définir le nombre de bots à afficher.',

	'LINKS_SETTINGS'                     => 'Paramètres du bloc de liens',
	'K_LINKS_TO_DISPLAY'                 => 'Nombre de liens à afficher dans le bloc de liens',
	'K_LINKS_TO_DISPLAY_EXPLAIN'         => '0 (zéro) pour faire défiler tous les liens...',
	'K_LINKS_SCROLL_AMOUNT'              => 'Quantité/vitesse de défilement',
	'K_LINKS_SCROLL_AMOUNT_EXPLAIN'      => 'Définir 1 pour lent... 5 pour rapide...',
	'LINK_TO_US'                         => 'Nom de l’image du lien',
	'LINK_TO_US_EXPLAIN'                 => 'L’image doit exister dans le dossier : ./images (taille : 88x31px)',
	'K_LINK_FORUM_ID'                    => 'ID du forum utilisé pour le téléchargement des images de liens',
	'K_LINK_FORUM_ID_EXPLAIN'            => 'Ajoute un lien en bas du bloc de liens pour diriger les membres vers un forum dédié au téléchargement des liens, s’il existe.',
	'K_LINKS_SCROLL_DIRECTION'           => 'Direction du défilement',
	'K_LINKS_SCROLL_DIRECTION_EXPLAIN'   => 'Défilement 0 = haut ou 1 = bas',
	'FOOTER_IMAGES'                      => 'Images du pied de page du portail',
	'K_FOOTER_IMAGES_ALLOW'              => 'Afficher les images du pied de page du portail',
	'K_FOOTER_IMAGES_ALLOW_EXPLAIN'      => 'Activer/désactiver les images de liens dans le pied de page du portail...',
	'K_SMILIES_SHOW'                     => 'Afficher les smileys dans la réponse rapide',
	'K_SMILIES_SHOW_EXPLAIN'             => 'Certains mods peuvent nécessiter de ne pas afficher les smileys dans la réponse rapide',

	'SHOW_BLOCKS_ON_INDEX_PORTAL' => 'Options d’affichage des blocs.',
	'SHOW_BLOCKS_ON_INDEX_L'      => 'Afficher les blocs de gauche sur la page index',
	'SHOW_BLOCKS_ON_INDEX_R'      => 'Afficher les blocs de droite sur la page index',
	'SHOW_BLOCKS_ON_PORTAL_L'     => 'Afficher les blocs de gauche sur la page portail',
	'SHOW_BLOCKS_ON_PORTAL_R'     => 'Afficher les blocs de droite sur la page portail',
	'SHOW_BLOCKS_ON_SEARCH_L'     => 'Afficher les blocs de gauche sur la page de recherche',
	'SHOW_BLOCKS_ON_SEARCH_R'     => 'Afficher les blocs de droite sur la page de recherche',
	'SHOW_BLOCKS_ON_MCP_L'        => 'Afficher les blocs de gauche sur la page MCP',
	'SHOW_BLOCKS_ON_MCP_R'        => 'Afficher les blocs de droite sur la page MCP',
	'SHOW_BLOCKS_ON_UCP_L'        => 'Afficher les blocs de gauche sur la page UCP',
	'SHOW_BLOCKS_ON_UCP_R'        => 'Afficher les blocs de droite sur la page UCP',
	'SHOW_BLOCKS_ON_MEM_L'        => 'Afficher les blocs de gauche sur la page membres',
	'SHOW_BLOCKS_ON_MEM_R'        => 'Afficher les blocs de droite sur la page membres',

	'SHOW_BLOCKS_ON_VT_L' => 'Afficher les blocs de gauche sur la page Viewtopic',
	'SHOW_BLOCKS_ON_VT_R' => 'Afficher les blocs de droite sur la page Viewtopic',
	'SHOW_BLOCKS_ON_VF_L' => 'Afficher les blocs de gauche sur la page Viewforum',
	'SHOW_BLOCKS_ON_VF_R' => 'Afficher les blocs de droite sur la page Viewforum',
	'SHOW_BLOCKS_ON_VO_L' => 'Afficher les blocs de gauche sur la page Viewonline',
	'SHOW_BLOCKS_ON_VO_R' => 'Afficher les blocs de droite sur la page Viewonline',

	'BLOCKS_GLOBAL'                     => 'Options d’affichage des blocs',
	'K_BLOCKS_DISPLAY_GLOBALLY'         => 'Activer les blocs pour toutes les pages',
	'K_BLOCKS_DISPLAY_GLOBALLY_EXPLAIN' => 'Si défini sur <strong>Non</strong>, tous les blocs seront désactivés sur toutes les pages. Cela remplacera tous les autres paramètres de blocs.',

	'K_ANNOUNCE_TYPE'           => 'Type d’annonce',
	'K_ANNOUNCE_TYPE_EXPLAIN'   => 'Quel type d’annonces souhaitez-vous afficher ?',

	'HEADER_BANNER'             => 'Bannière d’en-tête',
	'FOOTER_BANNER'             => 'Bannière de pied de page',
	'BOTH_BANNERS'              => 'En-tête et pied de page',
	'HEADER_IMAGE'              => 'Afficher une image d’en-tête aléatoire dans le portail',
	'HEADER_IMAGE_SW'           => 'Afficher une image d’en-tête aléatoire sur toutes les pages (site entier)',
	'NO_BANNERS'                => 'Aucune bannière',
	'NO_HEADER'                 => 'Aucune image d’en-tête',
	'RAND_BANNER'               => 'Bannière aléatoire du portail',
	'RAND_HEADER'               => 'Image d’en-tête aléatoire du portail',
	'ALLOW_RAND_BANNER'         => 'Afficher une bannière dans l’en-tête et/ou le pied de page',
	'ALLOW_RAND_BANNER_EXPLAIN' => 'Vous pouvez ajouter une bannière aléatoire dans l’en-tête et/ou le pied de page...<br />Les images doivent être placées dans le dossier images/rand_banner.<br /><b>Remarque</b> : pour une bannière fixe, placez simplement une seule image dans le dossier.',
	'ALLOW_RAND_HEADER'         => 'Afficher une image d’en-tête aléatoire en haut du portail et de la page index',
	'ALLOW_RAND_HEADER_EXPLAIN' => 'La largeur/hauteur des images peut être définie dans un fichier CSS du style, la classe étant random_header_image.<br />Les images d’en-tête aléatoires doivent être placées dans le dossier images/rand_header.<br />',

	'BLOCK_COOKIES'             => 'Cookies des blocs',
	'USE_COOKIES'               => 'Utiliser des cookies pour stocker les informations des blocs',
	'USE_COOKIES_EXPLAIN'       => 'Utiliser des cookies pour stocker l’emplacement et la visibilité des blocs',
	'PORTAL_LOGOS'              => 'Logo du site',
	'RAND_LOGOS'                => 'Logo du site aléatoire',
	'RAND_LOGOS_EXPLAIN'        => 'Le portail utilisera des logos aléatoires s’ils existent. <br />Ajoutez simplement plusieurs images dans votre style (répertoire theme/images/logos).',

	'K_TOP_POSTERS_TO_DISPLAY'                   => 'Nombre de meilleurs contributeurs à afficher',
	'K_TOP_POSTERS_TO_DISPLAY_EXPLAIN'           => 'Définir le nombre de meilleurs contributeurs à afficher dans le bloc Top Posters',
	'NUMBER_OF_TOP_REFERRALS_TO_DISPLAY'         => 'Nombre de meilleurs référents à afficher',
	'NUMBER_OF_TOP_REFERRALS_TO_DISPLAY_EXPLAIN' => 'Définir le nombre de meilleurs référents à afficher dans le bloc Top Referrals',
	'K_TEAMS_DISPLAY_THIS_MANY'                  => 'Nombre de membres d’équipe à afficher',
	'K_TEAMS_DISPLAY_THIS_MANY_EXPLAIN'          => 'Vous pouvez limiter le nombre par équipe (0 pour aucune limite).',
	'EXCLUDE'                                    => 'Exclure des forums de la recherche',
	'EXCLUDE_EXPLAIN'                            => 'ID des forums à exclure de la recherche (séparés par des virgules).',

	'K_BLOCK_CACHE_TIME_SHORT'         => 'Temps de cache court',
	'K_BLOCK_CACHE_TIME_SHORT_EXPLAIN' => 'À utiliser lorsqu’une courte durée est préférable (10)',

	'SWITCH_VARS'                 => 'Basculer variables principales/blocs',
	'NO_VARS_FOUND'               => 'Aucune variable trouvée',

	'K_LINKS_FORUM_ID'            => 'ID du forum des liens',
	'K_LINKS_FORUM_ID_EXPLAIN'    => 'Forum dédié au téléchargement des images de liens (optionnel)',
	'K_LINKS_TO_DISPLAY'          => 'Nombre d’images de liens à afficher',
	'K_LINKS_TO_DISPLAY_EXPLAIN'  => 'Vous pouvez limiter le nombre d’images défilantes dans le bloc de liens',

	// Tooltips
	'ALLOW_TOOLTIPS'                     => 'Autoriser les info-bulles',
	'TOOLTIPS'                           => 'Info-bulles',
	'K_TOOLTIPS_WHICH'                   => 'Afficher le premier/dernier message dans les info-bulles',
	'FIRST'                              => 'Premier',
	'LAST'                               => 'Dernier',

));

// Portal Menu Names + add you menu language variables here! //
$lang = array_merge($lang, array(
	'ACP'              => 'Panneau d’administration',
	'ALBUM'            => 'Album',
	'BOOKMARKS'        => 'Favoris',
	'CATEGORIES'       => 'Catégories',
	'SGP_Blog'         => 'Blog intégré SGP',
	'DOWNLOADS'        => 'Téléchargements',
	'FORUM'            => 'Forum',
	'KB'               => 'Base de connaissances',
	'LINKS'            => 'Liens',
	'MEMBERS'          => 'Membres',
	'PORTAL'           => 'Portail',
	'RATINGS'          => 'Dernières évaluations',
	'RULES'            => 'Règlement du site',
	'SITE_NAVIGATOR'   => 'Navigateur',
	'STATISTICS'       => 'Statistiques',
	'SITE_RULES'       => 'Règlement du site',
	'SITE_STATISTICS'  => 'Statistiques du site',
	'STAFF'            => 'Équipe',
	'STYLES_DEMO'      => 'Démo des styles',
	'SELECT_LANG'      => 'Choisir la langue',
	'STYLE_SELECT'     => 'Sélection du style',
	'UCP'              => 'Panneau utilisateur',
	'UNRESOLVED/BUGS'  => 'Non résolus/Bugs',
	'UPLOAD'           => 'Téléverser des images',
	'USER_INFORMATION' => 'Informations utilisateur',
	'WELCOME'          => 'Bienvenue',
));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'                => 'Admin CP',
	'ANNOUNCEMENTS'            => 'Annonces',
	'BIRTHDAY'                 => 'Anniversaire',
	'BLOCK_CACHE_TIME_RECENT'  => 'Temps de cache des sujets récents',
	'BLOCK_CACHE_TIME_SHORT'   => 'Temps de cache court',
	'BLOCK_CACHE_TIME_LONG'    => 'Temps de cache long',
	'BLOCK_CACHE_TIME_MEDIUM'  => 'Temps de cache moyen',
	'BLOG'                     => 'Blog intégré SGP',
	'BOARD_MINI_NAV'           => 'Sous-navigation',
	'BOARD_STYLE'              => 'Style du forum',
	'BOARD_NAV'                => 'Navigation du forum',
	'BOT_TRACKER'              => 'Suivi des bots',
	'BOT_TRACKER_SMALL'        => 'Suivi des bots',
	'BOOKS'                    => 'Livres',
	'CALENDAR'                 => 'Calendrier',
	'CHAT'                     => 'Chat',
	'CLOCK'                    => 'Horloge',
	'DOWNLOADS'                => 'Téléchargements',
	'FM_RADIO'                 => 'Radio FM',
	'FORUM_CATEGORIES'         => 'Catégories du forum',
	'GALLERY'                  => 'Galerie',
	'IRC_CHAT'                 => 'Chat IRC',

	'K_LAST_ONLINE_MAX'               => 'Afficher ce nombre de membres dans la liste.',
	'K_LAST_ONLINE_MAX_EXPLAIN'       => 'Nombre maximum de membres à afficher dans la liste des connectés.',
	'K_MAX_BLOCK_AVATAR_WIDTH'        => 'Largeur maximale de l’avatar',
	'K_MAX_BLOCK_AVATAR_HEIGHT'       => 'Hauteur maximale de l’avatar',
	'K_MAX_BLOCK_AVATAR_EXPLAIN'      => 'Mettre à 0 pour utiliser la valeur par défaut phpBB',
	'K_TOP_TOPICS_MAX'                => 'Nombre de sujets à afficher.',
	'K_TOP_TOPICS_MAX_EXPLAIN'        => 'Nombre maximum de sujets les plus actifs à afficher.',
	'K_TOP_TOPICS_DAYS'               => 'Nombre de jours à analyser pour les sujets populaires.',
	'K_TOP_TOPICS_DAYS_EXPLAIN'       => 'Nombre de jours passés utilisés pour la recherche.',

	'LAST_ONLINE'              => 'Liste des membres récemment en ligne.',
	'LINKS'                    => 'Liens',
	'MAIN_MENU'                => 'Navigation du forum',
	'MEMBERS'                  => 'Membres',
	'MP3_PLAYER'               => 'Lecteur MP3',
	'NEWS'                     => 'Actualités',
	'NEWS_REPORT'              => 'Rapport des actualités du site',
	'NO_CONFIG_FILE_FOUND'     => 'Aucune configuration requise ou fichier indisponible pour ce module.',
	'PORTAL'                   => 'Portail',
	'PORTAL_STATUS'            => 'Statut du portail',
	'RECENT_TOPICS'            => 'Sujets récents',
	'REQUIRED_DATA_MISSING'    => 'Données requises manquantes...<br />',
	'SAVING'                   => 'Base de données mise à jour...',
	'SAVED'                    => 'Base de données mise à jour...',
	'SELECT_STYLE'             => 'Sélectionner un nouveau style',
	'SITE_LINK_TXT'            => 'Lien vers notre site',
	'STAFF'                    => 'Équipe',
	'STATISTICS'               => 'Statistiques',
	'STATS'                    => 'Statistiques',
	'STYLE_STATUS'             => 'Statut des styles',
	'SUB_MENU'                 => 'Menu secondaire',
	'SWITCHING'                => 'Passage à la configuration SGP',
	'TOP_10_PICS'              => 'Top 10 des images les mieux notées',
	'TOP_TOPICS'               => 'Sujets les plus actifs.',
	'TOPICSPERFORUM'           => 'Nombre de sujets par forum.',
	'TOPICSPERFORUM_EXPLAIN'   => 'Limite le nombre de sujets retournés pour chaque forum.',
	'TOP_DOWNLOADS'            => 'Top téléchargements',
	'TOP_POSTERS'              => 'Top posteurs',
	'TOP_REFERRALS'            => 'Top référents',
	'UCP'                      => 'Panneau utilisateur',
	'UNRESOLVED'               => 'Non résolus',
	'USER_INFO'                => 'Informations utilisateur',
	'YOUR_PROFILE'             => 'Profil utilisateur',
	'YOUTUBE_LINK'             => 'Lien YouTube réel (URL)',
	'YOUTUBE_LINK_EXPLAIN'     => 'Au cas où YouTube changerait, fournir une alternative',
	'UNKNOWN_ERROR'            => 'Erreur lors du traitement des données enregistrées<br />',
	'USER_MAX_AVATAR_SETTINGS' => 'Limiter la taille de l’avatar dans le bloc informations utilisateur.',
	'WELCOME_SITE'             => 'Bienvenue sur<br /><strong>%s</strong>',
));

// Block Names
$lang = array_merge($lang, array(
	'ADMIN_OPTIONS'           => 'Options d’administration',
	'BABEL_FISH'              => 'Babel Fish',
	'BUG_TRACKER'             => 'Suivi des bugs',
	'TRANSLATE_SITE'          => '<strong>Choisir la langue</strong>',
	'TRANSLATE_RESET'         => '<strong>Réinitialiser à la langue d’origine</strong>',
	'ANNOUNCEMENTS_AND_NEWS'  => 'Annonces et actualités',
	'TOP_POSTERS_SETTINGS'    => 'Paramètres du bloc Top posteurs',
	'TOP_REFERRALS_SETTINGS'  => 'Paramètres du bloc Top référents',
	'THE_TEAM_SETTINGS'       => 'Paramètres du bloc Équipe',
));

// Acronyms
$lang = array_merge($lang, array(
	'ACP_ACRONYMS'           => 'Gérer les acronymes',
	'ACP_ACRONYMS_EXPLAIN'   => 'Ajouter et gérer les acronymes dans les messages... <br /><strong>Note :</strong> Lorsque les acronymes sont composés de deux mots ou plus, ils ne doivent pas contenir d’autres acronymes existants dans leur signification... <br />Par exemple, dans le cas de l’acronyme : phpBB3 apparaissant dans Stargate Portal, nous remplaçons <strong>phpBB3</strong> par <strong>phpBB version 3</strong> pour éviter les problèmes... En général, les acronymes ne doivent pas contenir d’espaces...',
	'ACRONYM'                => 'Acronyme',
	'ACRONYM_EXPLAIN'        => 'Depuis ce panneau, vous pouvez ajouter, modifier et supprimer des acronymes automatiquement appliqués aux messages.',
	'ACRONYMS'               => 'Acronymes',
	'ADD_ACRONYM'            => 'Ajouter un acronyme',
	'ACRONYM_MEANING'        => 'Entrer la signification complète',
	'ADD_NEW_WORD'           => 'Ajouter un mot',
	'ALLOW_ACRONYMS'         => 'Traiter les acronymes locaux dans les messages',
	'ALLOW_ACRONYMS_EXPLAIN' => 'Les acronymes locaux ne seront pas traités si désactivé ici...',
	'CONFIG_ACRONYMS'        => 'Configurer',
	'DELETE'                 => 'Pour supprimer des mots, retirez-les simplement',
	'DELETE_CURRENT'         => 'Supprimer',
	'EDIT_ACRONYM'           => 'Modifier l’acronyme',
	'EDIT_ACRONYM_EXPLAIN'   => 'Modifier la signification de l’acronyme :',
	'RESERVED'               => 'Mots réservés.',
	'RESERVED_EXPLAIN'       => 'Ces mots ne peuvent pas être utilisés comme acronymes, ils sont réservés...',
	'RESERVED_WORD_LIST'     => 'Gérer les mots réservés',
	'NEW_WORD'               => 'Ajouter un nouveau mot réservé.',
));

// IRC Channel
$lang = array_merge($lang, array(
	'IRC_CHANNEL'              => 'Canal IRC',
	'IRC_CHANNEL_NAME'         => 'Nom de votre canal IRC',
	'IRC_CHANNEL_EXPLAIN'      => 'Nom du canal IRC utilisé sur votre forum.',
	'OPT_IRC_CHANNELS'         => 'Canaux IRC optionnels',
	'OPT_IRC_CHANNELS_EXPLAIN' => 'Ajouter des canaux IRC optionnels. Commencer par # et séparer par des virgules sans espaces.',
));

// Age Ranges
$lang = array_merge($lang, array(
	'AGE_RANGES'           => 'Tranches d’âge',
	'AGE_INTERVAL'         => 'Intervalle d’âge',
	'AGE_INTERVAL_EXPLAIN' => 'Intervalle utilisé pour les groupes d’âge.',
	'AGE_START'            => 'Âge de départ',
	'AGE_START_EXPLAIN'    => 'Âge de début du premier groupe.',
	'AGE_LIMIT'            => 'Limite d’âge supérieure',
	'AGE_LIMIT_EXPLAIN'    => 'Limite maximale affichée. Exemple : pour afficher jusqu’à 100, entrer 101.',
));

