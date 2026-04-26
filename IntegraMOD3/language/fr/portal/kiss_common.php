<?php
/**
*
* @author Original Author Michael O'Toole
* @www.stargate-portal.com
*
* @package Kiss Portal Engine
* @version $Id:$ 1.0.19
*
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
* @copyright (c) 2005 phpbbireland
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
//- stargate aka kiss portal engine lang definitions -//

$lang = array_merge($lang, array(

	'ACP_FILE_BACKUP'		=> 'Sauvegarde des fichiers',
	'ACP_MINI'				=> 'Admin',
	'ACP_SMALL'				=> 'ACP',
	'ACRO_1'				=> 'Stargate Portal (alias Kiss Portal), le portail phpBB3 original &copy; Michael O’Toole 2005-2011',
	'ACRO_2'				=> 'Moteur Kiss Portal (Stargate Portal sans fioritures)... &copy; Michael O’Toole 2011',
	'ACRO_3'				=> 'Probablement le meilleur logiciel de forum jamais créé...',
	'ADD_SMILIES'			=> 'Ajouter des smileys',

	'ALL_COMMON'			=> 'Toutes les variables communes sont désormais disponibles pour tout le code des blocs',
	'ARRANGE_ON'			=> 'Organiser les blocs',
	'ARRANGE_OFF'			=> 'Enregistrer la disposition des blocs',
	'ATTACH_SIG'			=> 'Joindre votre signature',

	'AUTO_LOGIN'			=> 'Connexion automatique',
	'AUTOPLAY_OFF'			=> 'Lecture automatique désactivée...',
	'AUTOPLAY_ON'			=> 'Lecture automatique activée...',

	'BASIC_RULES'			=> "Bien que les administrateurs et modérateurs de ce forum s’efforcent de supprimer ou de modifier aussi rapidement que possible tout contenu généralement répréhensible, il est impossible de vérifier chaque message. Vous reconnaissez donc que tous les messages publiés sur ces forums expriment les opinions et points de vue de leur auteur et non ceux des administrateurs, modérateurs ou du webmaster (sauf pour les messages publiés par ces personnes) et qu’ils ne pourront donc pas être tenus responsables.<br /><br />
	Vous acceptez de ne pas publier de contenu abusif, obscène, vulgaire, diffamatoire, haineux, menaçant, à caractère sexuel ou tout autre contenu pouvant enfreindre les lois applicables. Le non-respect de cette règle peut entraîner votre bannissement immédiat et permanent (ainsi que l’information de votre fournisseur de services). L’adresse IP de tous les messages est enregistrée afin d’aider à faire respecter ces conditions. Vous acceptez que le webmaster, l’administrateur et les modérateurs de ce forum aient le droit de supprimer, modifier, déplacer ou fermer tout sujet à tout moment s’ils le jugent nécessaire. En tant qu’utilisateur, vous acceptez que toutes les informations saisies ci-dessus soient stockées dans une base de données. Bien que ces informations ne soient divulguées à aucun tiers sans votre consentement, le webmaster, l’administrateur et les modérateurs ne pourront être tenus responsables de toute tentative de piratage pouvant compromettre ces données.<br /><br />
	Ce forum utilise des cookies pour stocker des informations sur votre ordinateur local. Ces cookies ne contiennent aucune des informations saisies ci-dessus ; ils servent uniquement à améliorer votre confort de navigation. L’adresse e-mail est utilisée pour confirmer les détails de votre inscription et votre mot de passe, ou pour vous envoyer un nouveau mot de passe si vous oubliez l’actuel. Votre adresse e-mail peut également être utilisée pour envoyer des notifications de mise à jour des messages si vous le souhaitez.<br /><br />
	<strong>Mentions de copyright dans les pieds de page :</strong><br />
	Si le copyright de Kiss Portal Engine, phpBB ou des auteurs du style est supprimé, aucune assistance ne sera fournie...<br />
	Si vous avez supprimé ces mentions de copyright intentionnellement ou accidentellement, veuillez les rétablir avant de demander de l’aide...<br />
	Si vous avez l’autorisation concernant le copyright d’un auteur, veuillez l’indiquer dans votre demande d’assistance...<br />
	Nous avons passé de nombreuses années à développer ce logiciel, le minimum que vous puissiez faire est de respecter le copyright...<br /><br />
	Si vous avez l’autorisation de supprimer ou modifier le copyright de phpBB, de l’auteur du style ou du porteur du style, veuillez l’indiquer dans toute demande d’assistance<br /><br />
	Les règles peuvent changer de temps à autre. Veuillez les consulter régulièrement. L’administration",

	'BASIC_RULES_HEADER'	=> 'Règles du site.',
	'BBCODE_ST_HELP'		=> 'Texte barré : [strike]texte[/strike]', // More BBCodes
	'BB_CODE_LINK'			=> '<img scr="./images/bbcode/link.png" />',

	'BLOCK_BOT_TRACKER'		=> 'Kiss Portal Suivi des bots',
	'BLOCK_CALENDAR'		=> 'Kiss Portal Calendrier',
	'BLOCK_CATEGORIES'		=> 'Kiss Portal Catégories',
	'BLOCK_CACHE_TIME_HEAD'	=> 'Temps de cache des blocs',
	'BLOCK_CACHE_TIME'		=> 'Temps de cache par défaut des blocs.',
	'BLOCK_CACHE_TIME_EXPLAIN'	=> 'Utilisé si le temps de cache n’est pas défini (normalement 600).',
	'BLOCK_CLOCK'			=> 'Kiss Portal Horloge',
	'BLOCK_CLOUD'			=> 'Kiss Portal Cloud 9',
	'BLOCK_CURRENTLY_DISABLED'	=> 'Bloc désactivé !',
	'BLOCK_DEV_STATUS'		=> 'État du développement Kiss Portal',
	'BLOCK_IRC'				=> 'Kiss Portal IRC',
	'BLOCK_LAYOUT_RESET'	=> 'Toutes les dispositions des blocs utilisateur ont été effacées...',
	'BLOCK_MP3'				=> 'Kiss Portal MP3',
	'BLOCK_PORTAL_STATUS'	=> 'État de Kiss Portal',
	'BLOCK_RECENT_TOPICS'	=> 'Kiss Portal Sujets récents',
	'BLOCK_RSS_FEED'		=> 'Kiss Portal Flux RSS',
	'BLOCK_STATS'			=> 'Kiss Portal Statistiques',
	'BLOCK_TOP_POSTERS'		=> 'Kiss Portal Meilleurs posteurs',
	'BLOCK_TOP_TOPICS'		=> 'Kiss Portal Meilleurs sujets',
	'BLOCK_WEB_PAGES'		=> 'Kiss Portal Pages web',
	'BLOCK_WEB_TEAM'		=> 'Kiss Portal Équipe web',

	'BOARD_DEFAULT_STYLE'   => 'Style par défaut',
	'CHAT_LINK'				=> 'Chat en ligne',
	'CLICK_TO_ENLARGE'		=> 'Cliquer pour agrandir',
	'CLICK_TO_EXPAND'		=> 'Cliquer pour développer/réduire',
	'CLOSE_VIDEO'			=> 'Fermer la vidéo',

	'COLOR_DARK_RED' 		=> 'Rouge foncé',
	'COLOR_RED' 			=> 'Rouge',
	'COLOR_ORANGE' 			=> 'Orange',
	'COLOR_BROWN' 			=> 'Marron',
	'COLOR_YELLOW' 			=> 'Jaune',
	'COLOR_GREEN' 			=> 'Vert',
	'COLOR_OLIVE' 			=> 'Olive',
	'COLOR_CYAN' 			=> 'Cyan',
	'COLOR_BLUE' 			=> 'Bleu',
	'COLOR_DARK_BLUE' 		=> 'Bleu foncé',
	'COLOR_INDIGO' 			=> 'Indigo',
	'COLOR_VIOLET' 			=> 'Violet',
	'COLOR_WHITE' 			=> 'Blanc',
	'COLOR_BLACK' 			=> 'Noir',

	'COPY_RIGHT_BOTTOM'				=> 'Site de support & affiliés',
	'COULD_NOT_ADD_BLOCK'			=> 'Erreur ! Impossible d’ajouter le bloc !',
	'COULD_NOT_EDIT_BLOCK'			=> 'Erreur ! Impossible de modifier le bloc',
	'COULD_NOT_RETRIEVE_BLOCK'		=> 'Erreur ! Impossible de récupérer les données du bloc',
	'COULD_NOT_REINDEX_BLOCKS'		=> 'Erreur ! Impossible de réindexer les blocs',
	'COULD_NOT_REINDEX_MENUS'		=> 'Erreur ! Impossible de réindexer les menus',
	'COULD_NOT_QUERY_K_MODULES'		=> 'Erreur ! Impossible d’interroger la table portal k_modules',
	'COULD_NOT_UPDATE_K_MODULES'	=> 'Erreur ! Impossible de mettre à jour la table k_modules',
	'COULD_NOT_RESET_BLOCKS'        => 'Erreur ! Impossible de réinitialiser les positions des blocs',
	'CURRENT_STYLE'			=> 'Informations sur le style actuel',
	'CURRENTLY_DISABLED'	=> 'Le code est actuellement désactivé en attente des mises à jour',

	'DISABLE_BBCODE'		=> 'Désactiver le BBCode',
	'DISABLE_MAGIC_URL'		=> 'Ne pas analyser automatiquement les URL',
	'DISABLE_SMILIES'		=> 'Désactiver les smileys',
	'DONT_HAVE_ACCOUNT' 	=> 'Nous sommes une communauté<br />gratuite et ouverte, tous sont les bienvenus.<br />',

	'ERROR_PORTAL_MODULE'			=> 'Erreur ! Impossible d’interroger les informations des modules du portail : ',
	'ERROR_PORTAL_ANNOUNCE'			=> 'Erreur ! Impossible d’interroger les informations des annonces',
	'ERROR_PORTAL_BLOCKS'			=> 'Erreur ! Impossible de récupérer les données du bloc',
	'ERROR_PORTAL_CLOUD'			=> 'Erreur ! Impossible de récupérer les données du nuage',
	'ERROR_PORTAL_CONFIG'			=> 'Erreur ! Impossible de récupérer les données de configuration du portail',
	'ERROR_PORTAL_FORUMS'			=> 'Erreur ! Impossible d’interroger les informations des forums',
	'ERROR_PORTAL_HTTP'				=> 'Erreur ! Impossible de récupérer les données des référents HTTP',
	'ERROR_PORTAL_HTTP_DELETE'		=> 'Erreur ! Impossible de supprimer les référents HTTP',
	'ERROR_PORTAL_HTTP_QUERY'		=> 'Erreur ! Impossible d’interroger les référents HTTP',
	'ERROR_FORUM_INFO'				=> 'Erreur ! Impossible d’interroger les informations du forum',
	'ERROR_PORTAL_MENUS'			=> 'Erreur ! Impossible d’interroger les informations des menus du portail ',
	'ERROR_PORTAL_MODULE'			=> 'Erreur ! Impossible d’interroger les informations des modules du portail : ',
	'ERROR_PORTAL_NEWS'				=> 'Erreur ! Impossible d’interroger les données des actualités',
	'ERROR_PORTAL_QUOTES'			=> 'Erreur ! Impossible d’interroger les citations du portail',
	'ERROR_PORTAL_RECENT_TOPICS'	=> 'Erreur ! Impossible d’interroger les données des sujets récents',
	'ERROR_PORTAL_STATUS'			=> 'Erreur ! Erreur de la table de statut du portail.',
	'ERROR_PORTAL_STYLE_SELECT'		=> 'Erreur ! Sélection du style',
	'ERROR_PORTAL_STYLE_STATUS'		=> 'Erreur ! Impossible d’interroger les informations d’état des styles',
	'ERROR_PORTAL_VIDEO'			=> 'Erreur ! Table vidéo YouTube du portail',
	'ERROR_PORTAL_SUB_MENU'			=> 'Erreur ! Impossible d’interroger les informations des sous-menus du portail',
	'ERROR_PORTAL_LINKS_MENU'		=> 'Erreur ! Impossible d’interroger les informations des menus de liens du portail',
	'ERROR_PORTAL_WEB_TABLE'		=> 'Erreur ! Table Web du portail',
	'ERROR_PORTAL_WELCOME'			=> 'Erreur ! Impossible d’interroger les messages (Bienvenue, etc...)',
	'ERROR_PORTAL_WORDS'			=> 'Erreur ! Table des mots...',
	'ERROR_SMILIES_DATA'			=> 'Erreur ! Impossible de récupérer les données des smileys',
	'ERROR_USER_TABLE'				=> 'Erreur ! Impossible de récupérer les données de la table utilisateur',
	'EXAMPLE_CODE'					=> 'Exemple de code ici',

	'FLASH_IS_OFF'			=> '[flash] est <em>DÉSACTIVÉ</em>',
	'FLASH_IS_ON'			=> '[flash] est <em>ACTIVÉ</em>',
	'FLOOD_ERROR'			=> 'Vous ne pouvez pas publier un autre message si peu de temps après le précédent.',
	'FORUM_INDEX'			=> 'Forum',
	'FORUM_IMAGES_EXPLAIN'	=> 'Icônes du forum',
	'FM_RADIO'				=> 'Radio FM popup',
	'FONT_COLOR'			=> 'Couleur de police',
	'FONT_HUGE'				=> 'Très grande',
	'FONT_LARGE'			=> 'Grande',
	'FONT_NORMAL'			=> 'Normale',
	'FONT_SIZE'				=> 'Taille de police',
	'FONT_SMALL'			=> 'Petite',
	'FONT_TINY'				=> 'Très petite',

	'FORUM_PORTAL'			=> 'Portail',
	'FORUM_RULES'			=> 'Règles du forum',
	'FULL_SEARCH'			=> 'Recherche complète : ',

	'GOTO_BOTTOM_IMG' 	=> 'Aller en bas',
	'GOTO_DEV_SITE'		=> 'Aller au site de développement',
	'GOTO_TOP_IMG' 		=> 'Aller en haut',

	'HIDE_BLOCKS'	=> 'Masquer les blocs*',
	'HTTP_HOST'		=> 'Hôte',

	'ICON_ANNOUNCEMENT'			=> 'Annonce',
	'ICONS_EXPLAIN'         	=> 'Explication des icônes',
	'ICON_ANNOUNCEMENT_UNREAD'	=> 'Annonce non lue',
	'IN_HOUSE_DESIGNS'			=> 'Designs internes',

	'INDEX_OF_FORUMS'		=> 'Index des forums',

	'IRC_TITLE'				=> 'Popup IRC Stargate Portal',

	'K_QUICK_REPLY'			=> 'Réponse rapide simple Kiss',
	'K_RECENT_SEARCH_DAYS'	=> 'Jours de recherche : ',
	'LOCAL_TIME'			=> 'Heure locale',

	'LINKS_FORUM'			=> 'Soumettre un lien',
	'LINKS_FORUM_REQU'		=> 'Publiez votre demande ici... approbation requise... vous devez créer un forum pour le téléversement des liens !',
	'LOG_ME_IN_SHORT'   	=> 'Mémoriser la connexion',
	'LOGOUT_REDIRECT_P'		=> 'Vous avez été déconnecté... retour au portail',

	'MAKE_PERMANENT'			=> 'Si coché, le style choisi sera défini comme votre style par défaut !',

	'MEMBER_INFO'				=> 'Informations des membres',
	'MERITS'					=> 'Mérites',
	'MESSAGE_BODY_EXPLAIN'		=> 'Tapez votre message ici...',
	'MINI_SAMPLE_1'				=> 'Ce bloc a été écrit en utilisant le module MiniMod... Aucune entrée de base de données ni requête SQL n’a été requise. Seuls les styles installés seront affichés ici... Le bloc est réservé à stargatestyles uniquement... Toute personne souhaitant utiliser ce code devra demander à Mitch.',
	'MISSING_BLOCK_DATA'		=> 'Vous n’avez pas saisi toutes les données requises !',
	'MISSING_FILES'				=> ' erreur :<br /><br />Le fichier %1$s ou <br />le fichier %2$s n’existe pas ou est vide.',
	'MISSING_FILE_OR_FOLDER'	=> 'Fichier/dossier manquant : %s',
	'MORE_SMILIES'				=> 'Voir plus de smileys',

	'MP3_POPUP'			=> 'Lecteur popup',
	'MP3_PLAYER'		=> 'Lecteur MP3 SGP',


	'NEWS_BREAKING'		=> 'Dernières nouvelles... ',
	'NEWS_FLASH_GLOBAL'	=> 'Flash infos global... ',
	'NEWS_FLASH_LOCAL'	=> 'Flash infos local... ',
	'NO_ADMINS'			=> 'Aucun administrateur assigné.',
	'NO_ANNOUNCEMENTS'	=> 'Aucune annonce actuelle',
	'NO_BLOCK_ID'		=> 'ID manquant ?',
	'NO_BOT_DATA'		=> 'Aucune donnée bot à afficher',
	'NO_COMMENTS'		=> 'Aucun commentaire à afficher.',
	'NO_ID_GIVEN'		=> 'Aucun identifiant fourni<br />',
	'NO_LANG_VALUE'		=> 'Valeur de langue manquante',
	'NO_MODS'			=> 'Aucun mod assigné.',
	'NO_MENU'			=> 'Aucun élément de menu défini',
	'NO_NEWS'           => 'Aucune actualité aujourd’hui',
	'NO_TEAMS'			=> 'Aucune équipe sélectionnée !<br />Peut être ajoutée dans<br /> ACP > PORTAIL > BLOCS (variables du bloc équipe)',
	'NO_TOP_TOPICS'		=> 'Aucun sujet actif',
	'NO_POLL'			=> 'Aucun sondage sélectionné',
	'NO_RECENT_TOPICS'	=> ' Aucun sujet récent à afficher',
	'NO_SEARCH'			=> 'Désolé, vous n’êtes pas autorisé à utiliser le système de recherche.',
	'NO_SEARCHS'		=> 'Aucun mot trouvé.',
	'NO_UNRESOLVED'		=> 'Aucun bug à signaler...',
	'NO_VIEW_USERS_R'	=> 'Vous n’êtes pas autorisé à voir la liste des utilisateurs en ligne.',
	'NO_VIEW_USERS_A'	=> 'Pour voir la liste en ligne, vous devez être inscrit et connecté.',

	'NOT_PROCESSED_FOR_PAGE'	=> 'Non traité pour cette page',
	'NUMBER_OF_FORUMS'			=> 'Nombre de forums',

	'OF_TYPE'				=> ' de type : ',

	'ONLINE_USERS'			=> 'Utilisateurs en ligne',
	'ONLINE_USERS_SHOW'		=> '[ Voir la liste en ligne ]',


	'PERFORMED_BY'			=> 'Effectué par',
	'PLURAL'				=> 'S',
	'POSTED_BY'				=> 'Publié par',
	'POST_COMMENTS'			=> 'Publier un commentaire',
	'POSTERS_COMMENT'		=> 'Commentaires de %1$s : %2$s.',
	'PORTAL_DEVELOPMENT'	=> 'Développement du portail',
	'PHP_SUPPORT_SITES' 	=> 'Sites de support php',

	'POST_BY_AUTHOR'		=> 'Auteur :',
	'POST_NEWS_UNREAD'		=> 'Actualité non lue',
	'POSTED_MINE'			=> 'Mes publications',
	'POST_BY_POSTER'		=> 'par',
	'PORTED_BY'				=> 'Porté par',
	'PORTAL_DEBUG_QUERIES'	=> 'Q = %d, C = %d, T = %d',
	'PORTAL_DEBUG_RUNTOT'	=> 'Exécution : %d',

	'POST_IMG'				=> 'Publier',
	'POST_NEWS'				=> 'Actualité',
	'POST_NEWS_GLOBAL'		=> 'Actualité globale',
	'POST_NEW_IMG'			=> 'Nouveau message',
	'POST_NEW_HOT_IMG'		=> 'Nouveau message populaire',
	'POST_LOCKED_IMG'		=> 'Message verrouillé',
	'PRINT_IT'				=> 'Imprimer',
	'PROFILE_SMALL'			=> 'UCP',
	'POST_ANNOUNCEMENT_NEW'	=> 'Nouvelle annonce',
	'POST_ANNOUNCEMENT'		=> 'Annonce',
	'POSTED_BY'				=> 'Publié par',
	'PORTED_STYLES'			=> 'Styles portés',
	'POST_IMAGES_EXPLAIN'	=> 'Icônes des messages',
	'POLL_BLOCK'			=> 'Bloc sondage',
	'PROFILE_SMALL'			=> 'UCP',

	'QUICK_STATISTICS'		=> 'Statistiques du site',
	'QUICK_REPLY'			=> 'Réponse rapide',
	'QUICK_REPLY_NO'		=> 'Masquer la réponse rapide',

	'UCF_MOD'					=> 'Un emplacement valide est requis pour ce Mod',
	'UCP_SMALL'					=> 'UCP',

	'UPDATING'					=> 'Traitement en cours...',
	'UNDER_CONSTRUCTION'		=> 'En construction...',

	'UPLOAD_LINK'				=> 'Publier un lien',

	'USED_BY'					=> '%d utilisateur%s, utilise%s ce style',
	'USERS_CURRENT_STYLE'		=> 'Votre style actuel est',
	'USER_COUNTRY_FLAG'			=> 'Drapeau du pays',
	'USER_COUNTRY_FLAG_EXPLAIN'	=> 'Le mod complet nécessite les données de <strong>localisation</strong> ci-dessus (Google Map).',
	'USER_REAL_NAME'			=> 'Nom réel',
	'USER_REAL_NAME_EXPLAIN'	=> 'Prénom de l’utilisateur',
	'USERS_STYLE'				=> 'Style actuel',
	'RAND_BANNER'			=> 'Bannière aléatoire du portail',

	'READ_ARTICLE'			=> 'Lire l’article complet',
	'READ_FULL'				=> 'Lire le message complet',
	'RECENT_TOPICS'			=> 'Sujets récents',
	'RECENT_REPLY'			=> 'Voir la dernière réponse...',
	'REGISTRATION'       	=> '<b>Cliquez ici pour vous inscrire</b>',
	'RE-INDEXING BLOCKS'	=> 'Avis ! Veuillez réindexer les blocs (il s’agit d’un processus de maintenance normal lorsque les blocs sont hors séquence)',
	'RETURN_INDEX'			=> '%s Retour à la page du portail%s',
	'RETURN_PORTAL'			=> '%s Retour à la page du portail%s',
	'SEARCH_OPTION'					=> 'Option de recherche',
	'SEARCH_ACTIVE_TOPICS_SMALL'	=> 'Sujets actifs !',
	'SEARCH_DAYS'					=> 'Jours de recherche : ',
	'SEARCH_NEW_SMALL'				=> 'Nouveaux messages !',
	'SEARCH_SELF_SMALL'				=> 'Vos messages !',
	'SEARCH_UNANSWERED_SMALL'		=> 'Messages sans réponse !',
	'SCROLLING_BLOCKS_DISABLED'	=> 'Les blocs défilants sont désactivés pendant le processus d’agencement des blocs',
	'SELECT_STYLE_EXPLAINED'	=> '<br /><strong>Légende du menu déroulant</strong><br /><span class="green"><strong>Publié</strong></span><br /><span class="orange"><strong>Style RC</strong></span><br /><span class="gray"><strong>Style bêta</strong></span><br /><span class="red"><strong>Style alpha</strong></span><hr />',
	'SGP_IN_DEVELOPMENT'		=> 'Pages web YouTube de Stargate-Portal (en développement)',
	'SGP_IRC_POPUP'				=> 'Popup IRC Stargate Portal',
	'SGP_REFRESH_ALL'			=> 'SGP Refresh All - version',
	'SGP_TOOLS'					=> 'Outils Stargate',
	'SGP_STYLE_ERROR_10'		=> 'L’option de style n’est actuellement pas utilisée dans les pages web... Veuillez la supprimer de la barre d’adresse et appuyer sur Entrée pour continuer...',
	'SGP_SUPPORTING'			=> 'Stargate Portal &bull; Soutenir les communautés dans le monde entier',
	'SHOW_BLOCKS'				=> 'Afficher les blocs*',
	'SHOWHIDE'					=> 'Afficher / Masquer',
	'SHOW_ALL'					=> 'Afficher toutes les annonces',
	'SHOWHIDE_BABEL'			=> 'Afficher/Masquer les traductions Babel Fish',
	'SHOWHIDE_GOOGLE'			=> 'Afficher/Masquer les traductions Google',
	'SHOWHIDE_LIVE'				=> 'Afficher/Masquer les traductions Windows Live',
	'SITE_LINK_TXT_EXPLAIN'		=> 'Le code HTML ci-dessous contient tout le code nécessaire pour créer un lien vers <strong>%s</strong>, n’hésitez pas à l’ajouter à votre site.<br /><br />',
	'SITE_LINK_TXT_EXPLAIN2' 	=> 'Ce code produit :',
	'SITE_NAME'					=> 'phpbbireland',
	'SITE_SURVEY'				=> 'Sondage du site',
	'SOMETHING_WENT_WRONG'		=> 'Une erreur s’est produite, cela ne devrait pas arriver... Veuillez vérifier le code à la ligne indiquée : ',
	'STYLE_USERS'				=> 'Style utilisé par %d utilisateur%s',
	'STYLE_SELECT_ALLOW'		=> 'Autoriser le changement de style',
	'STYLE_SELECT_DISABLED'		=> 'Le changement de style est désactivé',
	'STYLEREG'					=> 'Vous devez être connecté pour utiliser le changeur de styles',
	'SUBMITTED_BY'				=> 'Soumis par',
	'SUBMIT_LINK'				=> 'Soumettre un lien',
	'SUBMITTED_BY'				=> 'Soumis par',
	'SWPYVL'					=> 'Pages web Stargate : liens vidéo YouTube',

	'TEAM_MAX_COUNT'			=> '(limité à : %s par équipe)',
	'TEMPORARILY_HIDE_BLOCKS'	=> 'Masquer temporairement les blocs',
	'THEME_INFO'				=> 'Informations du thème',
	'THEME_NEWS_UPDATES'		=> 'Actualités et mises à jour du thème',
	'THE_COLLECTIVE'			=> 'Le collectif',
	'THIS_MEANS_YOU'			=> 'vous ;-)',
	'TIME_BEING'				=> 'Utilisez l’actualisation dans l’ACP pour le moment...',
	'TIMEX'						=> 'Heure %s',

	'TITLE_LEGEND'				=> 'Légende du titre',
	'T_LIMITS'					=> 'Limite : ',
	'TO_DAY'					=> 'Date : %s',
	'TOOLS_ON'					=> 'Outils du portail',
	'TOOLS_OFF'					=> 'Enregistrer les modifications',
	'TOPICS_PER_FORUM_DISPLAY'	=> ' sujets par forum &bull; Affichage : ',
	'TOTAL_STYLES'				=> 'Nombre total de styles disponibles',

	'UNDER_CONSTRUCTION'	=> "<strong>La page demandée est actuellement en construction...</strong><br /><br />Veuillez utiliser le bouton 'Retour' pour revenir à la page précédente.",

	'VIDEO_COMMENTS'		=> 'Commentaires',
	'VIDEO_POSTER'			=> 'Publié par',
	'VIDEO_WHO'				=> 'Artiste',
	'VIEW_COMMENTS'			=> 'Voir les commentaires',
	'VIEW_FULL_ARTICLE'		=> 'Lire l’article complet',
	'VIEW_NEXT_MONTH'		=> 'Voir le mois suivant',
	'VIEW_PREVIOUS_MONTH'	=> 'Voir le mois précédent',
	'VIEW_POSTS'			=> 'Voir les messages',
	'VIEW_TOPIC_NEWS'		=> 'Actualité : ',

	'WARNINGIMG_COPYRIGHT'			=> 'Aucune information de copyright',
	'WARNING_LOGIN_STYLE_SELECT'	=> 'Veuillez vous connecter pour utiliser le bloc de sélection de style',
	'WARNINGIMG_DIR'				=> 'Vérifiez si vous avez ajouté le répertoire des images !',
	'WEB_PAGE'						=> 'Page web',
	'WEB_PAGE_EXAMPLES_1'			=> 'Exemples de pages web :',
	'WEB_PAGE_EXAMPLES_2'			=> 'Ces pages sont présentées uniquement à titre d’exemple, tous les liens ne sont pas valides...<br />',

	'WIDE2'					=> 'Largeur du style (100%)',
	'WIDE_VERSION'			=> 'Version large',

	// Use this version to display debug info //
	//'WELCOME_MESSAGE'	=> "Welcome back [you]...<br /><br /><strong>{SITENAME} </strong> is powered by <strong>phpBB</strong> {VERSION} and <strong> the Kiss Portal Engine </strong>{PORTAL_VERSION}."

	// Translators don’t edit "[you]" in next line, it's code... //
	'WELCOME_MESSAGE'	=> "Bon retour [you]...<br /><br /><strong>{SITENAME} </strong> est propulsé par <strong>phpBB3</strong> et <strong> le Kiss Portal Engine </strong>.",
	'WELCOME_TO_MOD'	=> 'Bienvenue dans',

	'YOUTUBE'				=> 'Youtube',
	'YOUTUBE_PAGE'			=> 'Page Youtube',
	'YOUTUBE_LINK_LIMIT'	=> 'Nombre de vidéos à afficher (0 = aucune limite)',
	'YOUTUBE_LIMIT'			=> 'limité à %d vidéos',

));
//- stargate aka Kiss portal engine lang definitions -//

// optional style width
$lang = array_merge($lang, array(
	'ALT_WIDTH'				=> 'Largeur alternative',
	'DEFAULT_WIDTH'			=> 'Largeur par défaut',
	'UCP_K_INFO_WIDTH_NO'	=> 'Veuillez noter que cette option n’est pas disponible dans tous les styles...',
));

// one word and common short terms //
$lang = array_merge($lang, array(
	'ACP'              => 'Panneau d’administration',
	'ACRONYMS'         => 'Acronymes',
	'ADVANCED_SEARCH'  => 'Recherche avancée',
	'ALBUM'            => 'Album',
	'ANNOUNCEMENTS'    => 'Annonces',
	'AUTHOR'           => 'Auteur',
	'BEGIN'            => 'DÉBUT',
	'BIRTHDAY'         => 'Anniversaire',
	'BOOKS'            => 'Livres',
	'BOOKMARKS'        => 'Signets',
	'BLOCK'            => 'Bloc',
	'BLOCK_DISABLE'    => '<b>Bloc activé</b>',
	'BLOCK_ENABLE'     => '<b>Bloc désactivé</b>',
	'BLOG'             => 'Blog',
	'BOOKMARK_OFF'     => 'Retirer le signet',
	'BOOKMARK_ON'      => 'Mettre le message en signet',
	'BOOKMARKS'        => 'Signets',
	'BOTTOM'           => 'Bas',
	'BY'               => 'Par',
	'CALENDAR'         => 'Calendrier',
	'CATEGORIES'       => 'Catégories',
	'CATEGORY'         => 'Catégorie',
	'CHAT'             => 'Chat',
	'CLOCK'            => 'Horloge',
	'COMMENT'          => 'Commentaire',
	'COMMENTS'         => 'Commentaires',
	'COUNT'            => 'Nombre',
	'CURRENT_VERSION'  => 'Version actuelle',
	'DESIGNED_BY'      => 'Conçu par',
	'DEV_VERSION'      => 'Version (RC)',
	'DISABLE'          => 'Désactiver',
	'DISABLED'         => 'Désactivé',
	'DOWNLOADS'        => 'Téléchargements',
	'EDITED'           => 'Modifié*',
	'END'              => 'FIN',
	'ENABLE'           => 'Activer',
	'FEED'             => 'Flux',
	'FIRST_VISIT'      => 'Première visite',
	'FLAG'             => 'Drapeau',
	'FORUM'            => 'Forum',
	'FOUND'            => 'Trouvé : ',
	'GALLERY'          => 'Galerie',
	'HIDE'             => 'Masquer',
	'HITS'             => 'Vues',
	'HOME'             => 'Accueil',
	'HOST'             => 'Hôte',
	'INFO'             => 'Info',
	'IN_PROGRESS'      => 'En cours',
	'INTRODUCTION'     => 'Introduction',
	'IRC'              => 'IRC',
	'KB'               => 'Base de connaissances',
	'LATEST_VERSION'   => 'Dernière version',
	'LEFT'             => 'Gauche',
	'LIMITS'           => 'Limites',
	'LINE'             => 'ligne ',
	'LINKS'            => 'Liens',
	'MEMBERS'          => 'Membres',
	'MOVE'             => 'Déplacer',
	'NAME'             => 'Nom',
	'NARROW'           => 'Étroit',
	'NEWS'             => 'Actualités',
	'NONE_FOUND'       => 'Aucun trouvé.',
	'NORMAL'           => 'Normal',
	'NOT_INSTALLED'    => 'Non installé',
	'NOT_SET'          => 'Non défini',
	'ON'               => 'sur',
	'OPTION'           => 'Option',
	'ORDER'            => 'Ordre',
	'PLEASE_CONFIRM'   => 'Veuillez confirmer.',
	'PERMANENT'        => 'Enregistrer mon choix :',
	'PICTURES'         => 'Images',
	'PORTAL'           => 'Portail',
	'PERCENT'          => 'Pourcentage',
	'POSTER'           => 'Auteur du message',
	'PROGRESS'         => 'Progression',
	'PROGRESS_BAR'     => 'barre de progression',
	'RATING'           => 'Évaluation',
	'REPORT_INSTALLED' => 'Le mod est déjà installé',
	'RESET_FEED'       => 'Réinitialiser',
	'REVERT'           => 'Revenir par défaut',
	'RIGHT'            => 'Droite',
	'ROWS'             => 'lignes',
	'RSS'              => 'RSS',
	'SECONDS'          => 'secondes',
	'SELECT_MOD'       => 'Mod sélectionné',
	'SELECT_LANG'      => 'Sélectionner la langue',
	'SHOW'             => 'Afficher',
	'SHOWN'            => 'affiché.',
	'SMILIES'          => 'Smilies',
	'SORT'             => 'Trier',
	'SORT_ASCENDING'   => 'Croissant',
	'SORT_DESCENDING'  => 'Décroissant',
	'STAFF'            => 'Équipe',
	'STATISTICS'       => 'Statistiques',
	'STATUS'           => 'Statut',
	'STICKY'           => 'Épinglé',
	'STYLE'            => 'Style',
	'SUPPORT'          => 'Support',
	'TEAM'             => 'Équipe',
	'THE_TEAM'         => 'L’équipe',
	'TITLE'            => 'Titre',
	'TRANSLATE'        => 'Traduire',
	'UCP'              => 'Panneau utilisateur',
	'UNRESOLVED'       => 'Non résolu',
	'URL'              => 'URL',
	'UPLOAD'           => 'Téléverser',
	'UPDATED'          => 'Mis à jour ',
	'USER_INFO'        => 'Informations utilisateur',
	'VERSION'          => 'Version',
	'VIEW'             => 'Voir',
	'WELCOME'          => 'Bienvenue',
	'WIDE'             => 'Large',
	'WIDTH'            => 'Largeur',
	'YEARS'            => 'ans.',


	// for version checking //
	'VERSION_CHECK'          => 'Vérification de version',
	'VERSION_CHECK_EXPLAIN'  => 'Vérifie si la version du mod que vous utilisez actuellement est à jour.',
	'VERSION_OUT_OF_DATE'    => 'Votre version du mod n’est pas à jour. Veuillez poursuivre le processus de mise à jour.',
	'VERSION_CANT_RETRIEVE'  => 'Impossible de récupérer les informations de version...',


));

