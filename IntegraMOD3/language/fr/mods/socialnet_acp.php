<?php
/**
 *
 * @package phpBB Social Network
 * @version 1.0.0
 * @copyright (c) phpBB Social Network Team 2010-2012 http://phpbbsocialnetwork.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_CAT_SOCIALNET'						 => 'Réseau social',
	'ACP_CAT_SOCIALNET_EXPLAIN'				 => '',
	'ACP_SN_WELCOME_TEXT'					 => 'phpBB Social Network est une modification pour les forums phpBB, qui transforme votre forum en un véritable logiciel de réseau social. Notre objectif est de vous fournir une solution communautaire avec les fonctionnalités favorites des principaux sites de réseaux sociaux. phpBB Social Network est une application modulaire, ce qui signifie que vous pouvez activer/désactiver chaque module et qu’il est facile de créer vos propres nouveaux modules. Si un module ou une fonctionnalité vous manque, vous pouvez consulter le bas de cette page et choisir le module que vous souhaitez télécharger. N’hésitez pas à visiter <a href="http://phpbbsocialnetwork.com">phpbbsocialnetwork.com</a> pour demander de l’aide ou nous demander de créer un nouveau module ',
	'ACP_SN_LIKE_US_FB'						 => 'Aimez phpBB Social Network sur Facebook',
	'ACP_SN_LIKE_US_FB_EXPLAIN'				 => 'Si vous souhaitez connaître toutes les nouveautés, voir de nouvelles captures d’écran et être informé sur phpBB Social Network, aimez-nous simplement sur Facebook.',
	'ACP_SN_CONTRIBUTE'						 => 'Contribuer à phpBB Social Network',
	'ACP_SN_CONTRIBUTE_EXPLAIN'				 => 'Aimez-vous phpBB Social Network ? Le moyen le plus simple de nous aider est de faire un don, quel qu’en soit le montant. Vous pouvez faire un don via PayPal ou par virement bancaire (<a href="http://phpbbsocialnetwork.com/support_us.php" style="font-weight: bold;">contactez-nous</a> pour les détails du virement).<br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 15px 0;"><p><input type="hidden" name="cmd" value="_donations" /><input type="hidden" name="business" value="G4NHS46RS8HTC" /><input type="hidden" name="lc" value="CZ" /><input type="hidden" name="item_name" value="phpBB Social Network" /><input type="hidden" name="currency_code" value="EUR" /><input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted" /><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" style="border: 0; width: 147px; height: 47px;background: none; cursor: pointer;" name="submit" alt="PayPal" /><img style="border: 0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" alt="" /></p></form>Il existe également d’autres moyens de nous aider à développer phpBB Social Network <a href="http://phpbbsocialnetwork.com/support_us.php" style="font-weight: bold;">ici</a>.',
	'SN_GLOBAL_ENABLE'						 => 'Activer le réseau social',
	'SN_GLOBAL_ENABLE_EXPLAIN'				 => 'Activer ou désactiver le MOD Réseau social',
	'SN_SHOW_BROWSER_OUTDATED'				 => 'Afficher la boîte de dialogue pour les navigateurs obsolètes',
	'SN_SHOW_BROWSER_OUTDATED_EXPLAIN'		 => 'lorsque le navigateur est obsolète pour SN, une boîte de dialogue avec le message apparaîtra',
	'ACP_SN_MAIN'							 => 'Principal',
	'ACP_SN_CONFIGURATION'					 => 'Configuration du réseau social',
	'ACP_SN_GLOBAL_SETTINGS'				 => 'Paramètres du réseau social',
	'ACP_SN_AVAILABLE_MODULES'				 => 'Activer les modules',
	'ACP_SN_AVAILABLE_MODULES_EXPLAIN'		 => 'Via ce panneau, vous pouvez activer / désactiver les modules du réseau social',
	'MODULES'								 => 'Modules',
	'SN_AVAILABLE_MODULES'					 => 'Liste des modules phpBB Social Network',
	'VERSION_AVAILABLE'						 => 'Dernière version',
	'VERSION_INSTALLED'						 => 'Version actuelle',
	'DOWNLOAD_LATEST'						 => 'Télécharger la dernière version',
	'NOT_INSTALLED'							 => 'non installé',
	'UPDATE_TO_LATEST'						 => 'Mettre à jour vers la dernière version',
	'BUY_HERE'								 => 'Acheter ici',
	'ACP_SN_VERSION_UP_TO_DATE'				 => 'Votre installation de %1$s est à jour. Aucune mise à jour n’est disponible pour le moment.',
	'ACP_SN_VERSION_NOT_UP_TO_DATE'			 => 'Votre installation de %1$s n’est pas à jour. Vous pouvez télécharger la dernière version <a href="%2$s">ici</a>.',
	'SN_VERSION_CHECK_EXPLAIN'				 => 'Vérifie si votre installation phpBB Social Network est à jour.',

	// PARAMÈTRES DES MODULES
	'ACP_SN_MODULES_CONFIGURATION'			 => 'Configuration des modules',
	'SN_ACP_MODULE_NOT_ACCESSIBLE'			 => 'Le panneau d’administration pour <strong>%1$s</strong> n’existe pas <em>(%2$s)</em>',
	'SN_MODULE_NOT_ACCESSIBLE'				 => 'Le module <strong>%1$s</strong> n’existe pas <em>(%2$s)</em>',
	'SN_MODULE_DISABLED'					 => 'Ce module est désactivé',
	'ACP_PANEL_NOT_ACCESSIBLE'				 => 'Le panneau ACP du module n’existe pas',
	'SN_MODULE_NOT_EXISTS'					 => 'La classe du module (socialnet_%1$s) n’existe pas dans le fichier %2$s',
	'SN_FILE_NOT_EXISTS'					 => 'Le fichier du module %1$s n’existe pas',
	'SN_MODULE_EXPLAIN'						 => 'Autoriser l’utilisation de %1$s',
	'SN_MODULE_IM'							 => 'Messagerie instantanée',
	'SN_MODULE_USERSTATUS'					 => 'Statut utilisateur',
	'SN_MODULE_APPROVAL'					 => 'Système de gestion des amis',
	'SN_MODULE_ACTIVITYPAGE'				 => 'Page d’activité',
	'SN_MODULE_NOTIFY'						 => 'Notifications',
	'SN_MODULE_PROFILE'						 => 'Profil utilisateur',
	'SN_MODULE_INITIALIZING'				 => 'Initialisation, veuillez patienter ...<br /><br />',
	'SN_MODULE_INITIALIZING_FMS'			 => 'Initialisation du système de gestion des amis, veuillez patienter - ',

	'SN_MODULE_NOTIFY_DETAIL'				 => 'Si ce module est désactivé, toutes les notifications sont envoyées via les messages privés',

	'ACP_SN_IM_SETTINGS'					 => 'Paramètres de la messagerie instantanée',
	'ACP_SN_USERSTATUS_SETTINGS'			 => 'Paramètres du statut utilisateur',
	'ACP_SN_APPROVAL_SETTINGS'				 => 'Paramètres du système de gestion des amis',
	'ACP_SN_ACTIVITYPAGE_SETTINGS'			 => 'Paramètres de la page d’activité',
	'ACP_SN_NOTIFY_SETTINGS'				 => 'Paramètres des notifications',
	'ACP_SN_PROFILE_SETTINGS'				 => 'Paramètres du profil utilisateur',
	'SN_NTF_THEME'							 => 'Couleur de la bulle de notification',
	'SN_NTF_LIFE'							 => 'Temps d’affichage',
	'SN_NTF_LIFE_EXPLAIN'					 => 'Durée d’affichage de la notification sur la page',
	'SN_NTF_CHECKTIME'						 => 'Intervalle de vérification',
	'SN_NTF_CHECKTIME_EXPLAIN'				 => 'Fréquence de vérification des notifications',
	'ACP_SN_MODULE_SETTINGS_EXPLAIN'		 => 'Panneau de configuration pour %1$s',
	'OVERRIDE_USER_SETTINGS'				 => 'Remplacer les paramètres utilisateur',
	'OVERRIDE_USER_SETTINGS_EXPLAIN'		 => 'Remplacer les paramètres utilisateur de ce MOD par les valeurs par défaut',
	'SN_COLOUR_NAME'						 => 'Nom d’utilisateur coloré',
	'SN_COLOUR_NAME_EXPLAIN'				 => 'Utiliser les noms de couleur phpBB',

	// PARAMÈTRES DES BOÎTES DE CONFIRMATION
	'ACP_SN_CONFIRMBOX_SETTINGS'			 => 'Paramètres de la boîte de confirmation',
	'ACP_SN_CONFIRMBOX_SETTINGS_EXPLAIN'	 => 'Vous pouvez configurer la boîte de confirmation via ce panneau',
	'SN_CB_ENABLE'							 => 'Activer la boîte de confirmation',
	'SN_CB_ENABLE_EXPLAIN'					 => 'Activer l’affichage des boîtes de confirmation',
	'SN_CB_RESIZABLE'						 => 'Activer le redimensionnement de la boîte de confirmation',
	'SN_CB_RESIZABLE_EXPLAIN'				 => 'Rendre les boîtes de confirmation redimensionnables',
	'SN_CB_DRAGGABLE'						 => 'Activer le déplacement de la boîte de confirmation',
	'SN_CB_DRAGGABLE_EXPLAIN'				 => 'Rendre les boîtes de confirmation déplaçables',
	'SN_CB_MODAL'							 => 'Activer la boîte de confirmation modale',
	'SN_CB_MODAL_EXPLAIN'					 => 'Rendre les boîtes de confirmation modales',
	'SN_CB_WIDTH'							 => 'Définir la largeur de la boîte de confirmation',
	'SN_CB_WIDTH_EXPLAIN'					 => 'Définir la largeur de la boîte de confirmation<br />Vous pouvez utiliser par ex. 400 ou 40%',

	// PARAMÈTRES DES BLOCS
	'ACP_SN_BLOCKS_ENABLE'					 => 'Activer les blocs',
	'ACP_SN_BLOCKS_ENABLE_EXPLAIN'			 => 'Ce panneau de contrôle vous permet d’activer/désactiver les blocs existants.<br />
	Permet d’utiliser ces blocs sur n’importe quelle page du forum où phpBB Social Network est chargé.<br />
	Les paramètres spécifiques des blocs se trouvent dans le panneau <strong>%1$s</strong>.',
	'SN_BLOCK_ENABLE_EXPLAIN'				 => 'Afficher %1$s',
	'SN_BLOCK_MYPROFILE'					 => 'Bloc Mon profil',
	'SN_BLOCK_MENU'							 => 'Bloc Menu',
	'SN_BLOCK_SEARCH'						 => 'Bloc Recherche',
	'SN_BLOCK_FRIENDS_SUGGESTIONS'			 => 'Bloc Suggestions d’amis',
	'SN_BLOCK_FRIEND_REQUESTS'				 => 'Bloc Demandes d’amis',
	'SN_BLOCK_BIRTHDAY'						 => 'Bloc Anniversaire',
	'SN_BLOCK_RECENT_DISCUSSIONS'			 => 'Bloc Discussions récentes',
	'SN_BLOCK_STATISTICS'					 => 'Bloc Statistiques',
	'SN_BLOCK_ONLINE_USERS'					 => 'Bloc Utilisateurs en ligne',
	'ACP_SN_BLOCKS_CONFIGURATION'			 => 'Configuration des blocs',
	'ACP_SN_BLOCKS_CONFIGURATION_EXPLAIN'	 => 'À droite, vous pouvez sélectionner le bloc que vous souhaitez configurer',
	'ACP_SN_BLOCK_MENU_SETTINGS'			 => 'Paramètres du menu',
	'ACP_SN_BLOCK_ONLINE_USERS_SETTINGS'	 => 'Paramètres des utilisateurs en ligne',
	'ACP_SN_BLOCK_SETTINGS_EXPLAIN'			 => 'Paramètres de %1$s',
	'SN_BLOCK_NOT_EXISTS'					 => 'La classe du module (acp_socialnet_block_%1$s) n’existe pas dans le fichier %2$s',
	'SELECT_BLOCK'							 => 'Select block',
	// PARAMÈTRES DES UTILISATEURS EN LIGNE (BLOC)
	'BLOCK_UO_SHOW_ALL'						 => 'Afficher tous les amis',
	'BLOCK_UO_SHOW_ALL_EXPLAIN'				 => 'Afficher tous les amis qui sont en ligne',
	'BLOCK_UO_CHECK_EVERY'					 => 'Vérifier les amis en ligne toutes les',
	'BLOCK_UO_CHECK_EVERY_EXPLAIN'			 => 'Vérifier les amis en ligne toutes les X secondes.<br />0 seconde désactive la vérification.',

	// PARAMÈTRES DU MENU DES BOUTONS (BLOC)
	'BLOCK_MENU_BUTTONS_MANAGE'				 => 'Gestion des boutons',
	'BLOCK_MENU_CREATE_BUTTON_EXPLAIN'		 => 'Ici, vous pouvez créer ou gérer les boutons. Il existe 2 types de boutons : les boutons parents et les sous-boutons.',
	'BLOCK_MENU_NAV'						 => 'Menu',
	'BLOCK_MENU_EDIT_BUTTON'				 => 'Modifier le bouton',
	'BLOCK_MENU_BUTTON_NAME'				 => 'Nom du bouton',
	'BLOCK_MENU_BUTTON_URL'					 => 'Lien',
	'BLOCK_MENU_BUTTON_URL_EXPLAIN'			 => 'L’adresse URL doit inclure http://',
	'BLOCK_MENU_BUTTON_PARENT'				 => 'Bouton parent',
	'BLOCK_MENU_BUTTON_PARENT_EXPLAIN'		 => 'Sélectionnez le bouton parent si vous souhaitez avoir un menu déroulant',
	'BLOCK_MENU_BUTTON_ONLY_REGISTERED'		 => 'Afficher uniquement aux utilisateurs enregistrés',
	'BLOCK_MENU_BUTTON_ONLY_GUEST'			 => 'Afficher uniquement aux invités',
	'BLOCK_MENU_BUTTON_DISPLAY'				 => 'Afficher le bouton',
	'BLOCK_MENU_BUTTON_EXTERNAL'			 => 'Le lien sera ouvert dans une nouvelle fenêtre',
	'BLOCK_MENU_DELETE_BUTTON_CONFIRM'		 => 'Êtes-vous sûr de vouloir supprimer ce bouton ?',
	'BLOCK_MENU_DELETE_SUBBUTTONS_CONFIRM'	 => 'Êtes-vous sûr de vouloir supprimer ce bouton et tous ses sous-boutons ?',
	'BLOCK_MENU_BUTTON_ADDED'				 => 'Un nouveau bouton a été ajouté avec succès',
	'BLOCK_MENU_BUTTON_EDITED'				 => 'Le bouton a été modifié avec succès',
	'BLOCK_MENU_MOVE_BUTTON_WITH_SUBS'		 => 'Ce bouton ne peut pas devenir un sous-bouton car il possède déjà des sous-boutons.',
	'BLOCK_MENU_NO_BUTTONS'					 => 'Il n’y a aucun bouton à gérer',
	'BLOCK_MENU_NO_SUBBUTTONS'				 => 'Il n’y a aucun sous-bouton à gérer',
	'BLOCK_MENU_CREATE_BUTTON'				 => 'Créer un nouveau bouton',
));


// ACP MESSAGERIE INSTANTANÉE
$lang = array_merge($lang, array(
	'IM_ONLY_FRIENDS'						 => 'Autoriser le chat uniquement avec les amis',
	'IM_ONLY_FRIENDS_EXPLAIN'				 => 'Cette option permet d’activer ou de désactiver le chat uniquement avec les amis',
	'IM_URL_IN_NEW_WINDOW'					 => 'Ouvrir les liens dans une nouvelle fenêtre',
	'IM_URL_IN_NEW_WINDOW_EXPLAIN'			 => 'Cette option active/désactive l’ouverture des liens dans une nouvelle fenêtre',
	'IM_AUTOMATIC_PURGING_MESSAGES'			 => 'Âge d’auto-purge des messages',
	'IM_AUTOMATIC_PURGING_MESSAGES_EXPLAIN'	 => 'Les messages délivrés sont automatiquement supprimés lorsqu’ils sont plus anciens que X jours.<br /><em>Entrez 0 pour désactiver la suppression automatique des anciens messages</em>',
	'PURGE'									 => 'Purge',
	'IM_PURGE_ALL_MSG'						 => 'Supprimer les anciens messages délivrés',
	'IM_PURGE_ALL_MSG_EXPLAIN'				 => 'Tous les messages délivrés datant de plus de X jours seront supprimés<br /><em>La valeur minimale est de 1 jour</em>',
	'IM_PURGE_ALL_MSG_SUCCESS'				 => 'Tous les anciens messages délivrés ont été supprimés',
	'IM_PURGE_ALL_CHATBOX'					 => 'Fermer toutes les fenêtres de chat ouvertes',
	'IM_PURGE_ALL_CHATBOX_EXPLAIN'			 => 'Toutes les fenêtres de chat ouvertes datant de plus de X jours seront fermées<br /><em>La valeur minimale est de 1 jour</em>',
	'IM_PURGE_ALL_CHATBOX_SUCCESS'			 => 'Les fenêtres de chat ont été fermées',
	'SN_IM_CHECKTIMES'						 => 'Temps de vérification de la messagerie instantanée',
	'IM_CHECK_TIME_MIN'						 => 'Minimum',
	'IM_CHECK_TIME_MAX'						 => 'Maximum',
	'IM_CHECK_TIME_MIN_EXPLAIN'				 => 'Temps minimum pour vérifier les nouveaux messages<br /><em>Valeur entre 2 et 30</em>',
	'IM_CHECK_TIME_MAX_EXPLAIN'				 => 'Temps maximum pour vérifier les nouveaux messages<br /><em>La valeur minimale est de 60</em>',
	'SN_IM_MANAGE_SMILIES'					 => 'Gérer les smileys affichés',
));


// ACP GESTION DES EXTENSIONS
$lang = array_merge($lang, array(
	'ACP_SN_ADDONS_HOOK_CONFIGURATION'			 => 'Gestion du système de hooks des extensions',
	'ACP_SN_ADDONS_HOOK_CONFIGURATION_EXPLAIN'	 => 'Les hooks d’extension vous permettent d’ajouter votre propre code à SN qui s’exécute lorsqu’une page spécifique est chargée dans le système.',

	'SN_ADDONS_ADDONS_MANAGEMENT'				 => 'Gestion des extensions',
	'SN_ADDONS_PLACEHOLDER_MANAGEMENT'			 => 'Gestion des espaces réservés',
	'SN_ADDONS_EDITHOLDER'						 => 'Modifier l’espace réservé',
	'SN_ADDONS_ADDHOLDER'						 => 'Ajouter un espace réservé',
	'SN_ADDONS_PLACEHOLDER_EMPTY_FIELD'			 => 'Les deux champs sont obligatoires',
	'SN_ADDONS_PLACEHOLDER_ADDED'				 => 'Le nouvel espace réservé a été ajouté avec succès',
	'SN_ADDONS_PLACEHOLDER_EDITED'				 => 'L’espace réservé a été modifié avec succès',
	'SN_ADDONS_PLACEHOLDER_DELETE_CONFIRM'		 => 'Êtes-vous sûr de vouloir supprimer l’espace réservé <strong>%1$s::%2$s</strong> ?',
	'SN_ADDONS_PLACEHOLDER_DELETED'				 => 'L’espace réservé a été supprimé avec succès',
	'SN_ADDONS_PLACEHOLDER_DUPLICATE'			 => 'Le nouvel espace réservé n’a pas pu être ajouté, il existe déjà',
	'SN_ADDONS_PLACEHOLDER_ERREDIT'				 => 'Un problème est survenu avec l’espace réservé',
	'SN_ADDONS_PLACEHOLDER'						 => 'Espace réservé',
	'SN_ADDONS_PLACEHOLDER_PAGE'				 => 'Nom du script',
	'SN_ADDONS_PLACEHOLDER_BLOCK'				 => 'Bloc sur la page',
	'SN_ADDONS_PLACEHOLDER_STRING'				 => 'Variable de template',
	'SN_ADDONS_PLACEHOLDER_SCRIPT_NAME'			 => 'Nom du script',
	'SN_ADDONS_PLACEHOLDER_BLOCK'				 => 'Bloc',
	'SN_ADDONS_PLACEHOLDER_SCRIPT_NAME_EXPLAIN'	 => 'Nom du script pour l’espace réservé. Le nom du script est exactement le nom de la page affichée sur le forum.<br />
		Si vous ne connaissez pas exactement le nom du script de la page actuelle, vous pouvez généralement le trouver dans le code source dans la balise HTML BODY.<br />
		<em>(ex. &lt;body id="phpbb" class="section-<strong>{nom du script}</strong> ..."&gt;)</em>',
	'SN_ADDONS_PLACEHOLDER_BLOCK_EXPLAIN'		 => 'Nom du bloc. Comme vous pouvez créer plus d’un espace réservé pour un script, le nom du bloc doit être spécifié.<br />
		<em>(ex. "header", "leftcolumn", "rightcolumn")</em>',
	'SN_ADDONS_NO_PLACEHOLDER_TO_ADD_ADDON'		 => 'Il n’y a aucun espace réservé pour ajouter une extension. Vous devez d’abord créer un espace réservé.',
	'SN_ADDONS_ADDON'							 => 'Extension',
	'SN_ADDONS_ADDADDON'						 => 'Ajouter une extension',
	'SN_ADDONS_EDITADDON'						 => 'Modifier l’extension',

	'SN_ADDONS_TEMPLATE'						 => 'Template de l’extension',
	'SN_ADDONS_ADDON_ADDED'						 => 'L’extension a été ajoutée avec succès.',
	'SN_ADDONS_ADDON_ADDED_ERROR'				 => 'Cette extension est déjà ajoutée à cet espace réservé',
	'SN_ADDONS_ADDON_EDITED'					 => 'L’extension a été modifiée avec succès.',
	'SN_ADDONS_ADDON_EDITED_ERROR'				 => 'L’extension n’a pas pu être modifiée dans le gestionnaire d’extensions. Veuillez réessayer.',
	'SN_ADDONS_ADDON_DELETE_CONFIRM'			 => 'Êtes-vous sûr de vouloir supprimer l’extension <strong>%1$s</strong> de l’espace réservé <strong>%2$s::%3$s</strong> ?',
	'SN_ADDONS_ADDON_DELETED'					 => 'L’extension <strong>%1$s</strong> de l’espace réservé <strong>%2$s::%3$s</strong> a été supprimée avec succès.',
	'SN_ADDON_NO_ADDON_IN_PLACEHOLDER'			 => 'Aucune extension assignée à cet espace réservé',

	'SN_ADDON_TEMPLATE_FOLDER_NOT_EXIST'		 => 'Le dossier de template de l’extension pour le style <strong>%1$s</strong> n’existe pas. Le dossier de template <strong>prosilver</strong> sera utilisé à la place.',
	'SN_ADDONS_ADDON_TEMPLATE_EXIST'			 => 'Existe',
	'SN_ADDONS_ADDON_TEMPLATE_NOT_EXIST'		 => 'N’existe pas',
));


// ACP STATUT UTILISATEUR
$lang = array_merge($lang, array(
	'US_COMMENTS'									 => 'Autoriser les autres utilisateurs à commenter le statut',
	'US_COMMENTS_EXPLAIN'							 => 'Cette option permet à tous les utilisateurs de publier des commentaires sur le statut',
	'US_LOAD_LAST_USERSTATUS_COMMENTS'				 => 'Charger les 3 derniers commentaires',
	'US_LOAD_LAST_USERSTATUS_COMMENTS_EXPLAIN'		 => 'Si vous souhaitez charger d’abord les 3 premiers commentaires puis les autres, choisissez Non',
	'SN_US_DELETE_ALL_USER_STATUSES'				 => 'Supprimer tous les statuts',
	'SN_US_DELETE_ALL_USER_COMMENTS'				 => 'Supprimer tous les commentaires',
	'SN_USER_DELETE_STATUS_COMMENTS_DELETED_USERS'	 => 'Purger les statuts et commentaires écrits par des utilisateurs supprimés',
	'SN_NO_USER_STATUS_TO_DELETE'					 => 'Aucun statut trouvé',
));

// MODULE APPROVAL / FRIEND MANAGEMENT SYSTEM
$lang = array_merge($lang, array(
	'SN_FAS_FRIENDS_PER_PAGE'				 => 'Nombre d’amis par page sur le profil utilisateur',
	'SN_FAS_FRIENDS_PER_PAGE_EXPLAIN'		 => 'Combien d’amis par page seront affichés',
	'SN_FMS_PURGE_ALL_FRIENDS_DELETED_USERS' => 'Purger tous les amis et groupes d’amis des utilisateurs supprimés',
));

// PAGE D’ACTIVITÉ ACP
$lang = array_merge($lang, array(
	'AP_NUM_LAST_POSTS'								 => 'Limiter l’affichage des derniers messages',
	'AP_NUM_LAST_POSTS_EXPLAIN'						 => 'Limite le nombre de derniers messages chargés pour les discussions récentes',
	'AP_SHOW_NEW_FRIENDSHIPS'						 => 'Afficher les notifications des nouvelles amitiés',
	'AP_SHOW_NEW_FRIENDSHIPS_EXPLAIN'				 => 'Afficher une notification lorsqu’un de vos amis ajoute un nouvel ami sur la page d’activité',
	'AP_SHOW_PROFILE_UPDATED'						 => 'Afficher les notifications de mise à jour du profil',
	'AP_SHOW_PROFILE_UPDATED_EXPLAIN'				 => 'Afficher une notification lorsqu’un de vos amis met à jour son profil sur la page d’activité',
	'AP_SHOW_NEW_FAMILY'							 => 'Afficher les notifications des nouveaux membres de la famille',
	'AP_SHOW_NEW_FAMILY_EXPLAIN'					 => 'Afficher une notification lorsqu’un de vos amis ajoute un membre de la famille sur la page d’activité',
	'AP_SHOW_NEW_RELATIONSHIP'						 => 'Afficher les notifications des nouvelles relations',
	'AP_SHOW_NEW_RELATIONSHIP_EXPLAIN'				 => 'Afficher une notification lorsqu’un de vos amis ajoute une nouvelle relation sur la page d’activité',
	'AP_DISPLAY_WELCOME'							 => 'Afficher le bloc de bienvenue sur la page d’activité',
	'AP_DISPLAY_WELCOME_EXPLAIN'					 => 'Afficher le bloc de bienvenue pour les utilisateurs non enregistrés sur la page d’activité. Vous pouvez le modifier en suivant les instructions ci-dessous.',
	'AP_HIDE_FOR_GUEST'								 => 'Masquer la page d’activité pour les invités',
	'AP_HIDE_FOR_GUEST_EXPLAIN'						 => 'Le module de la page d’activité sera redirigé vers la page d’index lorsqu’il est consulté par un invité',
	'ACP_SN_ACTIVITYPAGE_IS_MAIN'					 => 'Définir la page d’activité comme page d’accueil',
	'ACP_SN_ACTIVITYPAGE_IS_MAIN_EXPLAIN'			 => 'Si vous souhaitez utiliser la page d’activité comme première page de votre site au lieu de index.php, veuillez suivre ces instructions.',
	'ACP_SN_ACTIVITYPAGE_IS_MAIN_OPEN_FIND'			 => 'Ouvrez le fichier .htaccess (situé à la racine de votre site) et recherchez :',
	'ACP_SN_ACTIVITYPAGE_IS_MAIN_AFTER_ADD'			 => 'Après, ajoutez :',
	'ACP_SN_ACTIVITYPAGE_IS_MAIN_SAVE'				 => 'Enregistrez le fichier et téléversez-le sur votre site.',
	'ACP_SN_ACTIVITYPAGE_IS_MAIN_NO_DIRECTORY_INDEX' => 'Si vous ne trouvez pas DirectoryIndex dans votre fichier .htaccess, allez en bas du fichier et ajoutez cette ligne',
	'ACP_SN_ACTIVITYPAGE_NOT_MAIN'					 => 'Retirer la page d’activité comme page d’accueil',
	'ACP_SN_ACTIVITYPAGE_NOT_MAIN_EXPLAIN'			 => 'Si vous ne souhaitez plus utiliser la page d’activité comme première page de votre site à la place de index.php, veuillez suivre ces instructions.',
	'ACP_SN_ACTIVITYPAGE_NOT_MAIN_OPEN_FIND'		 => 'Ouvrez le fichier .htaccess (situé à la racine de votre site) et recherchez :',
	'ACP_SN_ACTIVITYPAGE_NOT_MAIN_DELETE'			 => 'Supprimez-la, enregistrez le fichier et téléversez-le sur votre site.',
	'ACP_SN_ACTIVITYPAGE_WELCOME'					 => 'Modifier le texte de bienvenue sur la page d’activité',
	'ACP_SN_ACTIVITYPAGE_WELCOME_EXPLAIN'			 => 'Si vous souhaitez afficher le texte de bienvenue pour les invités sur la page d’activité, vous pouvez suivre ces instructions.',
	'ACP_SN_ACTIVITYPAGE_WELCOME_INSTRUCTIONS'		 => 'Ouvrez le fichier language/en/mods/socialnet.php avec un <a href="http://www.pspad.com/">éditeur de texte</a> et recherchez :',
	'ACP_SN_ACTIVITYPAGE_WELCOME_EDIT'				 => 'Vous y verrez deux lignes contenant le titre et le texte du bloc de bienvenue. N’hésitez pas à les modifier et à les mettre en forme avec du <a href="http://www.w3.org/wiki/HTML">HTML</a> et du CSS.',
));

// ACP PROFIL UTILISATEUR
$lang = array_merge($lang, array(
	'SN_ENABLE_REPORT'						 => 'Activer le signalement des utilisateurs',
	'SN_ENABLE_REPORT_EXPLAIN'				 => 'Les utilisateurs pourront signaler d’autres utilisateurs',
	'SN_MAX_PROFILE_VALUE'					 => 'Longueur maximale de la valeur affichée sur la page d’activité',
	'SN_MAX_PROFILE_VALUE_EXPLAIN'			 => 'Définir le nombre maximal de caractères des valeurs affichées sur la page d’activité après une mise à jour du profil.',
	'SN_PROFILE_NO_REASON'					 => 'Vous devez créer au moins une raison de signalement',
	'SN_PROFILE_REPORT_REASONS'				 => 'Raisons du signalement utilisateur',
	'SN_PROFILE_REPORT_REASONS_EXPLAIN'		 => 'Ici, vous pouvez gérer les raisons de signalement des utilisateurs',
	'SN_PROFILE_ADD_REASON'					 => 'Ajouter une raison',
	'SN_PROFILE_DELETE_REASON_CONFIRM'		 => 'Êtes-vous sûr de vouloir supprimer cette raison ?',
	'SN_PROFILE_REASON_ADDED'				 => 'La raison du signalement a été ajoutée avec succès',
	'SN_PROFILE_REASON_DELETED'				 => 'La raison du signalement a été supprimée avec succès',
	'SN_PROFILE_MANAGE_EMOTES'				 => 'Gestion des émoticônes',
	'SN_PROFILE_MANAGE_EMOTES_EXPLAIN'		 => 'Vous pouvez gérer les émoticônes via ce panneau',
	'SN_PROFILE_EMOTE_IMAGE'				 => 'Émoticône',
	'SN_PROFILE_EMOTE_NAME'					 => 'Émote',
	'SN_PROFILE_ADD_EMOTE'					 => 'Ajouter une nouvelle émote',
	'SN_PROFILE_EDIT_EMOTE'					 => 'Modifier l’émote',
	'SN_PROFILE_MANAGE_EMOTES_EMPTY_NAME'	 => 'Vous devez donner un nom à l’émote',
	'SN_PROFILE_EMOTE_EDITED'				 => 'L’émote a été modifiée avec succès',
	'SN_PROFILE_EMOTE_ADDED'				 => 'L’émote a été ajoutée avec succès',
	'SN_PROFILE_EMOTE_DELETED'				 => 'L’émote a été supprimée avec succès',
));

// CONFIGURATION DES LOGS PHPBB
$lang_log_main = '<strong>Réseau social &raquo</strong> ';

$lang = array_merge($lang, array(
	'LOG_CONFIG_SN_MAIN'									 => $lang_log_main . 'Paramètres globaux modifiés',
	'LOG_CONFIG_SN_MODULES'									 => $lang_log_main . 'Modules disponibles modifiés',
	'LOG_CONFIG_SN_CB'										 => $lang_log_main . 'Paramètres des boîtes de confirmation modifiés',
	'LOG_CONFIG_SN_BLOCKS'									 => $lang_log_main . 'Blocs disponibles modifiés',
	'LOG_CONFIG_SN_BLOCK_USERONLINE'						 => $lang_log_main . 'Paramètres du bloc utilisateurs en ligne modifiés',
	'LOG_CONFIG_SN_BLOCK_MENU_ADD_BUTTON'					 => $lang_log_main . 'Élément du bloc menu <strong>%1$s</strong> ajouté',
	'LOG_CONFIG_SN_BLOCK_MENU_EDIT_BUTTON'					 => $lang_log_main . 'Élément du bloc menu <strong>%1$s</strong> modifié',
	'LOG_CONFIG_SN_BLOCK_MENU_DELETE'						 => $lang_log_main . 'Élément du bloc menu <strong>%1$s</strong> supprimé',
	'LOG_CONFIG_SN_BLOCK_MENU_MOVE_UP'						 => $lang_log_main . 'Élément du bloc menu <strong>%1$s</strong> déplacé au-dessus de <strong>%2$s</strong>',
	'LOG_CONFIG_SN_BLOCK_MENU_MOVE_DOWN'					 => $lang_log_main . 'Élément du bloc menu <strong>%1$s</strong> déplacé en dessous de <strong>%2$s</strong>',
	'LOG_CONFIG_SN_ADDONS_ADD_ADDON'						 => $lang_log_main . 'Extension <strong>%1$s</strong> ajoutée',
	'LOG_CONFIG_SN_ADDONS_EDIT_ADDON'						 => $lang_log_main . 'Extension <strong>%1$s</strong> modifiée',
	'LOG_CONFIG_SN_ADDONS_DELETE'							 => $lang_log_main . 'Extension <strong>%1$s</strong> supprimée',
	'LOG_CONFIG_SN_ADDONS_MOVE_UP'							 => $lang_log_main . 'Élément de l’extension <strong>%1$s</strong> déplacé au-dessus de <strong>%2$s</strong>',
	'LOG_CONFIG_SN_ADDONS_MOVE_DOWN'						 => $lang_log_main . 'Élément de l’extension <strong>%1$s</strong> déplacé en dessous de <strong>%2$s</strong>',
	'LOG_CONFIG_SN_ADDONS_ENABLE_ADDON'						 => $lang_log_main . 'Extension <strong>%1$s</strong> activée',
	'LOG_CONFIG_SN_ADDONS_DISABLE_ADDON'					 => $lang_log_main . 'Extension <strong>%1$s</strong> désactivée',
	'LOG_CONFIG_SN_IM'										 => $lang_log_main . 'Paramètres du module messagerie instantanée modifiés',
	'LOG_CONFIG_SN_IM_MSG_PURGED'							 => $lang_log_main . 'Messages de la messagerie instantanée purgés',
	'LOG_CONFIG_SN_IM_CHATBOXES_CLOSED'						 => $lang_log_main . 'Fenêtres de chat de la messagerie instantanée fermées',
	'LOG_CONFIG_SN_USERSTATUS'								 => $lang_log_main . 'Paramètres du module statut utilisateur modifiés',
	'LOG_CONFIG_SN_USERSTATUS_BASICTOOLS_DELETE_STATUSES'	 => $lang_log_main . 'Statuts utilisateur supprimés pour l’utilisateur %1$s',
	'LOG_CONFIG_SN_USERSTATUS_BASICTOOLS_DELETE_COMMENTS'	 => $lang_log_main . 'Commentaires de statut supprimés pour l’utilisateur %1$s',
	'LOG_CONFIG_SN_USERSTATUS_BASICTOOLS_USER_DELETED'		 => $lang_log_main . 'Statuts et commentaires de statuts supprimés pour les utilisateurs supprimés',
	'LOG_CONFIG_SN_FMS'										 => $lang_log_main . 'Paramètres du module de gestion des amis modifiés',
	'LOG_CONFIG_SN_FMS_BASICTOOLS_DELETED_USER'				 => $lang_log_main . 'Tous les amis et groupes d’amis des utilisateurs supprimés ont été purgés',
	'LOG_CONFIG_SN_AP'										 => $lang_log_main . 'Paramètres du module de la page principale modifiés',
	'LOG_CONFIG_SN_NTF'										 => $lang_log_main . 'Paramètres du module de notifications modifiés',
	'LOG_CONFIG_SN_UP'										 => $lang_log_main . 'Paramètres du module profil modifiés',
));


