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

if (!isset($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	/**
	 * Edit these two lines write your own Welcome text for unregistered guests on Activity page.
	 */
	 
	'SN_AP_WELCOME_TITLE'					 => 'Bienvenue sur notre site web !',
	'SN_AP_WELCOME_TEXT'					 => 'N’hésitez pas à vous inscrire et à utiliser toutes les fonctionnalités de notre site web.<br /><br />Cordialement,<br />l’Administrateur',

	'SN_MODULE_IM_NAME'						 => 'Messagerie instantanée',
	'SN_MODULE_USERSTATUS_NAME'				 => 'Statut de l’utilisateur',
	'SN_MODULE_APPROVAL_NAME'				 => 'Système de gestion des amis',

	'SN_IM_CHAT'							 => 'Chat',
	'SN_IM_NO_ONLINE_USER'					 => 'Aucun utilisateur n’est en ligne',
	'SN_IM_YOU_ARE_OFFLINE'					 => 'Vous êtes hors ligne',
	'SN_IM_SOUND'							 => 'Son',
	'SN_IM_SELECT_NAME'						 => 'Choisissez un son',
	'SN_IM_NEW_MESSAGE'						 => 'Nouveau message',
	'SN_IM_LOGIN'							 => 'En ligne',
	'SN_IM_LOGOUT'							 => 'Hors ligne',
	'SN_IM_PRESS_TO_CLOSE'					 => 'Appuyez sur %1$s pour fermer la boîte de chat',
	'SN_IM_PRESS_TO_SEND'					 => 'Appuyez sur %1$s pour envoyer le message',

	'SN_US_SHARE_STATUS'					 => 'Partager',
	'SN_US_WHATS_ON_YOUR_MIND'				 => 'À quoi pensez-vous ?',
	'SN_US_EMPTY_STATUS'					 => 'Vous ne pouvez pas soumettre un statut vide',
	'SN_US_COMMENT'							 => 'Commentaire',
	'SN_US_EMPTY_COMMENT'					 => 'Vous ne pouvez pas soumettre un commentaire vide',
	'SN_US_USER_STATUS_WALL'				 => 'Activité',
	'SN_US_WRITE_COMMENT'					 => 'Écrire un commentaire...',
	'SN_US_COMMENT_STATUS'					 => 'Commentaire',
	'SN_US_HAS_NO_STATUS'					 => 'n’a aucun statut',
	'SN_US_HAS_DELETED_STATUS'				 => 'Ce statut a été supprimé',
	'SN_STATUS_NOT_EXISTS'					 => 'Ce statut n’existe pas',
	'SN_US_HAS_NO_ACTIVITY'					 => 'n’a aucune activité',
	'SN_US_SHARED_STATUS'					 => 'Vous avez partagé votre statut',
	'SN_US_DELETE_STATUS'					 => 'Supprimer',
	'SN_US_LOAD_MORE'						 => 'Anciens messages',
	'SN_US_VIEW'						 	 => 'Voir',
	'SN_US_LOAD_MORE_COMMENT'				 => 'plus de commentaire',
	'SN_US_LOAD_MORE_COMMENTS'				 => 'plus de commentaires',
	'SN_US_CONFIRM'							 => 'Confirmer',
	'SN_US_CLOSE'							 => 'Fermer',
	'SN_US_CANCEL'							 => 'Annuler',
	'SN_US_SHARED_A'						 => 'a partagé un',
	'SN_US_LINK'							 => 'lien',

	//
	// FETCH PAGE
	//
	'SN_US_FETCH_PAGE'						 => 'Récupérer la page',
	'SN_US_FETCH_CLEAR'						 => 'Effacer la page chargée',
	'SN_US_NO_VIDEO_THUMB'					 => 'Aucun aperçu vidéo',
	'LOADER'								 => 'Chargeur',
	'NEXT_IMAGE'							 => 'Image suivante',
	'PREVIOUS_IMAGE'						 => 'Image précédente',
	'OF'									 => 'de',
	'SN_US_NO_IMG_THUMB'					 => 'Aucun aperçu d’image',
	'SN_US_CHOOSE_THUMB'					 => 'images',
	'SN_CB_FETCH_ERROR'						 => 'Une erreur s’est produite lors du chargement de la page web',

	'SN_AP_ACTIVITYPAGE'					 => 'Quoi de neuf ?',
	'SN_AP_AND'								 => 'et',
	'SN_AP_ARE_FRIENDS'						 => 'sont maintenant amis',
	'SN_AP_ADD_AS_FRIEND'					 => 'Ajouter comme ami',
	'SN_AP_PRIVATE_MESSAGE'					 => 'Messages',
	'SN_AP_MANAGE_PROFILE'					 => 'Modifier mon profil',
	'SN_AP_VIEW_FRIENDS'					 => 'Voir mes amis',
	'SN_AP_VIEW_SUGGESTIONS'				 => 'Personnes que vous pourriez connaître',
	'SN_AP_MANAGE_FRIENDS'					 => 'Gérer les amis',
	'SN_AP_BOARD'							 => 'Forum de discussion',
	'SN_AP_VIEW_MEMBERLIST'					 => 'Voir les membres',
	'SN_AP_LOG_OUT'							 => 'Déconnexion',
	'SN_AP_LAST_POSTS'						 => 'Discussions récentes',
	'SN_AP_TOTAL_FRIEND'					 => 'Vous avez 1 ami',
	'SN_AP_TOTAL_FRIENDS'					 => 'Vous avez %s amis',
	'SN_AP_FRIEND_SUGGESTIONS'				 => 'Personnes que vous pourriez connaître',
	'SN_AP_REQUESTS_LIST'					 => 'Demandes',
	'SN_AP_ONLINE_FRIENDS'					 => 'Amis en ligne',
	'SN_AP_NO_ONLINE_USER'					 => 'Aucun utilisateur en ligne',
	'SN_AP_NO_DISCUSSION'					 => 'Aucune discussion récente',
	'SN_AP_NO_BIRTHDAY'					 	 => 'Aucun anniversaire à venir',
	'SN_AP_NO_ENTRY'						 => 'Rien de nouveau ici',
	'SN_AP_LOAD_NEWS'						 => 'Actualiser',
	'SN_AP_SEE_ALL'							 => 'Voir tout',
	'SN_AP_NO_FRIENDS'						 => 'Vous n’avez aucun ami',
	'SN_AP_KEEP_LOGGEDIN'					 => 'Rester connecté',
	'SN_AP_STATISTICS'						 => 'Statistiques',
	'SN_AP_TOTAL_USERS'						 => '<strong>%d</strong> membres',
	'SN_AP_TOTAL_POSTS'						 => '<strong>%d</strong> messages',
	'SN_AP_TOTAL_TOPICS'					 => '<strong>%d</strong> sujets',
	'SN_AP_TOPICS_PER_DAY'					 => '<strong>%d</strong> sujets par jour',
	'SN_AP_POSTS_PER_DAY'					 => '<strong>%d</strong> messages par jour',
	'SN_AP_USERS_PER_DAY'					 => '<strong>%d</strong> utilisateurs par jour',
	'SN_AP_BIRTHDAY'						 => 'Anniversaire',
	'SN_AP_BIRTHDAY_1'						 => 'anniversaire <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_2'						 => 'anniversaire le <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_USERNAME'				 => 'de %1$s',
	'SN_AP_WELCOME'							 => 'Bienvenue',
	'SN_AP_VIEWING_ACTIVITYPAGE'			 => 'Affichage de la page d’activité',
	'SN_AP_NO_SUGGESTIONS'					 => 'Actuellement, aucune suggestion d’ami pour vous',
	'SN_AP_SEARCH'							 => 'Rechercher…',
	'SN_AP_CHANGED_PROFILE_HIS'				 => 'a mis à jour son profil',
	'SN_AP_CHANGED_PROFILE_HER'				 => 'a mis à jour son profil',
	'SN_AP_CHANGED_PROFILE_THEIR'			 => 'a mis à jour son profil',
	'SN_UP_CHANGED_AVATAR_HIS'				 => 'a changé sa photo de profil',
	'SN_UP_CHANGED_AVATAR_HER'				 => 'a changé sa photo de profil',
	'SN_UP_CHANGED_AVATAR_THEIR'			 => 'a changé sa photo de profil',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HIS'		 => 'a ajouté %1$s (%2$s) comme nouveau membre de sa famille à son profil',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HER'		 => 'a ajouté %1$s (%2$s) comme nouveau membre de sa famille à son profil',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_THEIR'	 => 'a ajouté %1$s (%2$s) comme nouveau membre de sa famille à leur profil',
	'SN_AP_CHANGED_RELATIONSHIP_HIS'		 => 'a ajouté une nouvelle relation à son profil',
	'SN_AP_CHANGED_RELATIONSHIP_HER'		 => 'a ajouté une nouvelle relation à son profil',
	'SN_AP_CHANGED_RELATIONSHIP_THEIR'		 => 'a ajouté une nouvelle relation à leur profil',
	'SN_UP_SEND_EMOTE'						 => 'a envoyé une émoticône à',

	'SN_PROFILE'							 => 'Profil',
	'SN_MYPROFILE'							 => 'Mon profil',

	// User profile
	'SN_UP_PROFILE_UPDATED'					 => 'Votre profil a été mis à jour avec succès.',
	'SN_UP_HOMETOWN'						 => 'Ville d’origine',
	'SN_UP_SEX'								 => 'Sexe',
	'SN_UP_INTERESTED_IN'					 => 'Intéressé par',
	'SN_UP_LANGUAGES'						 => 'Langues',
	'SN_UP_ABOUT_ME'						 => 'À propos de moi',
	'SN_UP_EMPLOYER'						 => 'Employeur',
	'SN_UP_UNIVERSITY'						 => 'Université',
	'SN_UP_HIGH_SCHOOL'						 => 'Lycée',
	'SN_UP_OCCUPATION'						 => 'Profession',
	'SN_UP_RELIGION'						 => 'Religion',
	'SN_UP_POLITICAL_VIEWS'					 => 'Opinions politiques',
	'SN_UP_QUOTATIONS'						 => 'Citations préférées',
	'SN_UP_INTERESTS'						 => 'Centres d’intérêt',
	'SN_UP_MUSIC'							 => 'Musique',
	'SN_UP_BOOKS'							 => 'Livres',
	'SN_UP_MOVIES'							 => 'Films',
	'SN_UP_GAMES'							 => 'Jeux',
	'SN_UP_FOODS'							 => 'Aliments',
	'SN_UP_SPORTS'							 => 'Sports que vous pratiquez',
	'SN_UP_SPORT_TEAMS'						 => 'Équipes sportives préférées',
	'SN_UP_ACTIVITIES'						 => 'Activités',
	'SN_UP_SKYPE'							 => 'Skype',
	'SN_UP_FACEBOOK'						 => 'Facebook',
	'SN_UP_TWITTER'							 => 'Twitter',
	'SN_UP_YOUTUBE'							 => 'Youtube',
	'SN_UP_USER_FB'							=> 'Facebook',
	'SN_UP_USER_IG'							=> 'Instagram',
	'SN_UP_USER_PT'							=> 'Pinterest',
	'SN_UP_USER_TWR'						=> 'Twitter',
	'SN_UP_USER_SKP'						=> 'Skype',
	'SN_UP_USER_TG'							=> 'Telegram',
	'SN_UP_USER_LI'							=> 'LinkedIn',
	'SN_UP_USER_TT'							=> 'TikTok',
	'SN_UP_USER_DC'							=> 'Discord',
	'SN_UP_USER_ICQ'						 => 'Numéro ICQ',
	'SN_UP_USER_AIM'						 => 'AOL Instant Messenger',
	'SN_UP_USER_MSNM'						 => 'WL/MSN Messenger',
	'SN_UP_USER_YIM'						 => 'Yahoo Messenger',
	'SN_UP_USER_JABBER'						 => 'Adresse Jabber',
	'SN_UP_USER_WEBSITE'					 => 'Site web',
	'SN_UP_USER_FROM'						 => 'Lieu',
	'SN_UP_USER_INTERESTS'					 => 'Centres d’intérêt',
	'SN_UP_BDAY_MONTH'						 => 'Mois de naissance',
	'SN_UP_BDAY_DAY'						 => 'Jour de naissance',
	'SN_UP_BDAY_YEAR'						 => 'Année de naissance',
	'SN_UP_USERNAME'						 => 'Nom d’utilisateur',
	'SN_UP_USER_EMAIL'						 => 'E-mail',
	'SN_UP_USER_BIRTHDAY'					 => 'Anniversaire',
	'SN_UP_USER_OCC'						 => 'Profession',
	'SN_UP_USER_SIG'						 => 'Signature',
	'SN_UP_PROFILE_VIEWS'					 => 'Vues du profil',
	'SN_UP_X_TIMES'							 => 'x',
	'SN_UP_PROFILE_VISITORS'				 => 'Visiteurs du profil',
	'SN_UP_LAST_CHANGE'						 => 'Dernière mise à jour du profil',
	'SN_UP_MALE'							 => 'Homme',
	'SN_UP_MALES'							 => 'Hommes',
	'SN_UP_FEMALE'							 => 'Femme',
	'SN_UP_FEMALES'							 => 'Femmes',
	'SN_UP_BOTH'							 => 'Les deux',
	'SN_UP_RELATIONSHIP'					 => 'Relation',
	'SN_UP_SINGLE'							 => 'Célibataire',
	'SN_UP_IN_RELATIONSHIP'					 => 'En couple',
	'SN_UP_ENGAGED'							 => 'Fiancé',
	'SN_UP_MARRIED'							 => 'Marié',
	'SN_UP_ITS_COMPLICATED'					 => 'C\'est compliqué',
	'SN_UP_OPEN_RELATIONSHIP'				 => 'En relation libre',
	'SN_UP_WIDOWED'							 => 'Veuf / Veuve',
	'SN_UP_SEPARATED'						 => 'Séparé',
	'SN_UP_DIVORCED'						 => 'Divorcé',
	'SN_UP_TO'								 => 'à',
	'SN_UP_WITH'							 => 'avec',
	'SN_UP_ANNIVERSARY'						 => 'Anniversaire',
	'SN_UP_ANNIVERSARY_ON'					 => 'Anniversaire le',
	'SN_UP_BIRTHDAY'						 => 'Date de naissance',
	'SN_UP_SUNDAY'							 => 'Dimanche',
	'SN_UP_MONDAY'							 => 'Lundi',
	'SN_UP_TUESDAY'							 => 'Mardi',
	'SN_UP_WEDNESDAY'						 => 'Mercredi',
	'SN_UP_THURSDAY'						 => 'Jeudi',
	'SN_UP_FRIDAY'							 => 'Vendredi',
	'SN_UP_SATURDAY'						 => 'Samedi',
	'SN_UP_SUNDAY_MIN'						 => 'Di',
	'SN_UP_MONDAY_MIN'						 => 'Lu',
	'SN_UP_TUESDAY_MIN'						 => 'Ma',
	'SN_UP_WEDNESDAY_MIN'					 => 'Me',
	'SN_UP_THURSDAY_MIN'					 => 'Je',
	'SN_UP_FRIDAY_MIN'						 => 'Ve',
	'SN_UP_SATURDAY_MIN'					 => 'Sa',
	'SN_UP_JANUARY_MIN'						 => 'Jan',
	'SN_UP_FEBRUARY_MIN'					 => 'Fév',
	'SN_UP_MARCH_MIN'						 => 'Mar',
	'SN_UP_APRIL_MIN'						 => 'Avr',
	'SN_UP_MAY_MIN'							 => 'Mai',
	'SN_UP_JUNE_MIN'						 => 'Jun',
	'SN_UP_JULY_MIN'						 => 'Jul',
	'SN_UP_AUGUST_MIN'						 => 'Aoû',
	'SN_UP_SEPTEMBER_MIN'					 => 'Sep',
	'SN_UP_OCTOBER_MIN'						 => 'Oct',
	'SN_UP_NOVEMBER_MIN'					 => 'Nov',
	'SN_UP_DECEMBER_MIN'					 => 'Déc',
	'SN_UP_FAMILY'							 => 'Famille',
	'SN_UP_SELECT_RELATIONSHIP'				 => 'Ajouter une relation',
	'SN_UP_SELECT_FAMILY_RELATION'			 => 'Ajouter un membre de la famille',
	'SN_UP_SISTER'							 => 'Sœur',
	'SN_UP_BROTHER'							 => 'Frère',
	'SN_UP_DAUGHTER'						 => 'Fille',
	'SN_UP_SON'								 => 'Fils',
	'SN_UP_MOTHER'							 => 'Mère',
	'SN_UP_FATHER'							 => 'Père',
	'SN_UP_AUNT'							 => 'Tante',
	'SN_UP_UNCLE'							 => 'Oncle',
	'SN_UP_NIECE'							 => 'Nièce',
	'SN_UP_NEPHEW'							 => 'Neveu',
	'SN_UP_COUSIN_FEMALE'					 => 'Cousine',
	'SN_UP_COUSIN_MALE'						 => 'Cousin',
	'SN_UP_GRANDDAUGHTER'					 => 'Petite-fille',
	'SN_UP_GRANDSON'						 => 'Petit-fils',
	'SN_UP_GRANDMOTHER'						 => 'Grand-mère',
	'SN_UP_GRANDFATHER'						 => 'Grand-père',
	'SN_UP_SISTER_IN_LAW'					 => 'Belle-sœur',
	'SN_UP_BROTHER_IN_LAW'					 => 'Beau-frère',
	'SN_UP_MOTHER_IN_LAW'					 => 'Belle-mère',
	'SN_UP_FATHER_IN_LAW'					 => 'Beau-père',
	'SN_UP_DAUGHTER_IN_LAW'					 => 'Belle-fille',
	'SN_UP_SON_IN_LAW'						 => 'Gendre',
	'SN_UP_ADD_FAMILY_MEMBER'				 => 'Ajouter un membre de la famille',
	'SN_UP_ADD_FAMILY_ERR_MEMBER_EMPTY'		 => 'Nom du membre de la famille vide',
	'SN_UP_APPROVE'							 => 'Approuver',
	'SN_UP_IGNORE'							 => 'Ignorer',
	'SN_UP_APPROVE_RELATION_SUBJECT'		 => '%1$s a créé une relation avec vous',
	'SN_UP_APPROVE_RELATION_TEXT'			 => '%2$s a créé la relation suivante avec vous : <strong>%3$s %2$s</strong>.<br /><br />%1$sVous pouvez approuver cette relation ici%4$s',
	'SN_UP_APPROVE_RELATION_CONFIRM'		 => 'Êtes-vous sûr de vouloir approuver cette relation ?',
	'SN_UP_REFUSE_RELATION_CONFIRM'			 => 'Êtes-vous sûr de vouloir refuser cette relation ?',
	'SN_UP_APPROVE_RELATION_ERROR_CANCELED'	 => 'Cette relation a été annulée',
	'SN_UP_APPROVE_RELATION_ERROR_MYSELF'	 => 'Vous ne pouvez pas créer une relation avec vous-même',
	'SN_UP_APPROVE_RELATION_ERROR_APPROVED'	 => 'Cette relation a déjà été approuvée',
	'SN_UP_APPROVE_RELATION_ERROR_REFUSED'	 => 'Cette relation a déjà été refusée',
	'SN_UP_APPROVE_RELATION_VICE_VERSA'		 => 'Je souhaite également ajouter cette relation à mon profil.',
	'SN_UP_DELETE_RELATIONSHIP_CONFIRM'		 => 'Êtes-vous sûr de vouloir supprimer cette relation ?',
	'SN_UP_APPROVE_RELATION_NO_RELATIONSHIP' => 'Aucun statut de relation',
	'SN_UP_APPROVE_FAMILY_SUBJECT'			 => '%1$s vous a ajouté comme %2$s',
	'SN_UP_APPROVE_FAMILY_TEXT'				 => '%2$s vous a ajouté comme <strong>%3$s</strong>.<br /><br />%1$sVous pouvez approuver cette relation ici%4$s',
	'SN_UP_APPROVE_FAMILY_CONFIRM'			 => 'Êtes-vous sûr de vouloir approuver cette relation ?',
	'SN_UP_REFUSE_FAMILY_CONFIRM'			 => 'Êtes-vous sûr de vouloir refuser cette relation ?',
	'SN_UP_APPROVE_FAMILY_ERROR_CANCELED'	 => 'Cette relation a été annulée',
	'SN_UP_APPROVE_FAMILY_ERROR_MYSELF'		 => 'Vous ne pouvez pas vous ajouter comme membre de votre propre famille',
	'SN_UP_APPROVE_FAMILY_ERROR_APPROVED'	 => 'Cette relation a déjà été approuvée.',
	'SN_UP_APPROVE_FAMILY_ERROR_REFUSED'	 => 'Cette relation a déjà été refusée.',
	'SN_UP_APPROVE_FAMILY_ERROR_EXIST'		 => '%1$s a déjà été ajouté à votre famille',
	'SN_UP_APPROVE_FAMILY_VICE_VERSA'		 => 'Je souhaite également ajouter %1$s à ma famille.',
	'SN_UP_APPROVE_FAMILY_USERNAME'			 => '%1$s est mon',
	'SN_UP_APPROVE_NO_FAMILY_MEMBER'		 => 'Aucun membre de la famille',
	'SN_UP_DELETE_FAMILY_CONFIRM'			 => 'Êtes-vous sûr de vouloir supprimer <strong>%1$s</strong> de votre famille ?',
	'SN_UP_USERNAME_NOT_EXIST'				 => 'Le nom d’utilisateur saisi n’existe pas',
	'SN_UP_NOT_APPROVED'					 => 'pas encore approuvé',
	'SN_UP_RELATION_REFUSED'				 => 'refusé',
	'SN_UP_RELATION_REQUESTS'				 => 'Demandes',
	'SN_UP_APPROVE_REQUESTS'				 => 'Approuver la relation',
	'WRONG_DATA_FACEBOOK'					 => 'L’adresse Facebook doit être une URL valide, incluant le protocole http. Par exemple : http://www.facebook.com/<nickname>/',
	'WRONG_DATA_TWITTER'					 => 'L’adresse Twitter doit être une URL valide, incluant le protocole http. Par exemple : http://twitter.com/<nickname>/',
	'WRONG_DATA_YOUTUBE'					 => 'L’adresse YouTube doit être une URL valide, incluant le protocole http. Par exemple : http://www.youtube.com/user/<nickname>/',
	'WRONG_DATA_FAMILY_USER'				 => 'L’un des noms d’utilisateur de la famille que vous avez saisis n’existe pas',
	'WRONG_DATA_RELATION_USER'				 => 'Le nom d’utilisateur de la relation que vous avez saisi n’existe pas',
	'WRONG_DATA_ANNIVERSARY'				 => 'La date d’anniversaire doit être une date valide au format jj-mm-aaaa. Par exemple : 01-12-2011',
	'TOO_SHORT_FACEBOOK'					 => 'L’adresse Facebook que vous avez saisie est trop courte, un minimum de 12 caractères est requis.',
	'TOO_SHORT_TWITTER'						 => 'L’adresse Twitter que vous avez saisie est trop courte, un minimum de 12 caractères est requis.',
	'TOO_SHORT_YOUTUBE'						 => 'L’adresse YouTube que vous avez saisie est trop courte, un minimum de 12 caractères est requis.',
	'TOO_SHORT_ANNIVERSARY'					 => 'La date d’anniversaire que vous avez saisie est trop courte, un minimum de 8 caractères est requis.',
	'TOO_SHORT_SKYPE'						 => 'Le nom Skype que vous avez saisi est trop court, un minimum de 6 caractères est requis.',
	'SN_UP_WALL'							 => 'Activité',
	'SN_UP_INFO'							 => 'Infos',
	'SN_UP_FRIENDS'							 => 'Amis',
	'SN_UP_STATS'							 => 'Statistiques',
	'SN_UP_BASIC_INFO'						 => 'Informations de base',
	'SN_UP_EDU_WORK'						 => 'Études et travail',
	'SN_UP_PHILOSOPHY'						 => 'Philosophie',
	'SN_UP_ENT_ACT'							 => 'Divertissements et activités',
	'SN_UP_CONTACT_INFO'					 => 'Coordonnées',
	'SN_UP_OTHER_INFO'						 => 'Autres informations',
	'SN_UP_LAST_VISITORS'					 => 'Derniers visiteurs du profil',
	'SN_UP_PROFILE_VIEWED'					 => 'Profil consulté',
	'SN_UP_ADD_FRIEND'						 => 'Ajouter un ami',
	'SN_UP_ADD_FRIEND_TO_GROUP'				 => 'Ajouter au groupe',
	'SN_UP_EDIT_PROFILE'					 => 'Modifier le profil',
	'SN_UP_EDIT_FRIENDS'					 => 'Gérer les amis',
	'SN_UP_EDIT_RELATIONS'					 => 'Gérer les relations',
	'SN_UP_REPORT_PROFILE'					 => 'Signaler l’utilisateur',
	'SN_UP_EMPTY_REPORT'					 => 'Vous devez choisir la raison du signalement',
	'SN_UP_REPORT_SUCCESS'					 => 'L’utilisateur a été signalé avec succès',
	'SN_UP_CAN_LEAVE_BLANK'					 => 'Ce champ peut être laissé vide.',
	'SN_UP_MORE_INFO'						 => 'Informations supplémentaires',
	'SN_UP_RETURN_TO_PROFILE'				 => '%1$sRetour au profil%2$s',
	'SN_UP_TABS_SPINNER'					 => '<em>Chargement&#8230;<\/em>',
	'SN_UP_EMOTES'							 => 'Envoyer une émoticône',

	'SN_UP_PROFILE_VALUE_DELETED'			 => '<em>Supprimé</em>',

	'SN_NTF_EMOTE_CB_TITLE'					 => 'Émoticône envoyée',
	'SN_NTF_EMOTE_CB_TEXT'					 => 'L’émoticône %2$s %3$s a été envoyée avec succès à %1$s',

	'SN_IN'									 => 'dans',

	'AVATAR'								 => 'Avatar',

	'FOES'									 => 'Ignorés',
	'MUTUAL'								 => 'Amis en commun',
	'SUGGESTIONS'							 => 'Suggestions',

	// Ces modèles sont utilisés pour différents formats de date.
	// Chaque langue doit définir sa convention d’affichage des dates.
	'SN_DAY_MONTH_YEAR_PATTERN'				 => 'j F Y',
	'SN_DAY_MONTH_PATTERN'					 => 'j F',
	'SN_MONTH_YEAR_PATTERN'					 => 'F Y',
	'SN_YEAR_PATTERN'						 => 'Y',

	/**
	 * BOÎTES DE CONFIRMATION
	 */
	'SN_CB_DELETE_STATUS_TITLE'				 => 'Supprimer le statut',
	'SN_CB_DELETE_STATUS_TEXT'				 => 'Êtes-vous sûr de vouloir supprimer ce statut ?',
	'SN_CB_DELETE_COMMENT_TITLE'			 => 'Supprimer le commentaire',
	'SN_CB_DELETE_COMMENT_TEXT'				 => 'Êtes-vous sûr de vouloir supprimer ce commentaire ?',
	'SN_CB_DELETE_ACTIVITY_TITLE'			 => 'Supprimer l’activité',
	'SN_CB_DELETE_ACTIVITY_TEXT'			 => 'Êtes-vous sûr de vouloir supprimer cette activité ?',

	/**
	 * SOCIALNET TIME AGO
	 */
	'SN_TIME_AGO'							 => 'il y a %1$u %2$s',
	'SN_TIME_FROM_NOW'						 => 'dans %1$u %2$s',
	'SN_TIME_PERIODS'						 => array(
		'SECOND'	 => 'seconde',
		'SECONDS'	 => 'secondes',
		'MINUTE'	 => 'minute',
		'MINUTES'	 => 'minutes',
		'HOUR'		 => 'heure',
		'HOURS'		 => 'heures',
		'DAY'		 => 'jour',
		'DAYS'		 => 'jours',
		'WEEK'		 => 'semaine',
		'WEEKS'		 => 'semaines',
		'MONTH'		 => 'mois',
		'MONTHS'	 => 'mois',
		'YEAR'		 => 'an',
		'YEARS'		 => 'ans',
		'DECADE'	 => 'décennie',
		'DECADES'	 => 'décennies',
	)
));

// UCP
$lang = array_merge($lang, array(
	// UCP
	'UCP_SOCIALNET'							 => 'Réseau social',
	'UCP_SOCIALNET_SETTINGS'				 => 'Paramètres du réseau social',
	'UCP_SN_IM'								 => 'Paramètres de la messagerie instantanée',
	'UCP_SN_IM_SETTINGS'					 => 'Paramètres de la messagerie instantanée',
	'UCP_SN_IM_HISTORY'						 => 'Historique de la messagerie instantanée',
	'UCP_SN_APPROVAL_UFG'					 => 'Groupes d’amis',
	'UCP_SOCIALNET_IM_PURGE_MESSAGES'		 => 'Purge des messages de la messagerie instantanée',
	'UCP_SOCIALNET_USERSTATUS'				 => 'Paramètres du statut utilisateur',
	'UCP_SN_PROFILE'						 => 'Modifier les informations personnelles',
	'UCP_SN_PROFILE_RELATIONS'				 => 'Relations &amp; liens familiaux',

	// Instant Messenger
	'IM_ONLINE'								 => 'Je suis en ligne',
	'IM_ONLINE_EXPLAIN'						 => 'Si oui, vos amis vous verront dans la liste en ligne et pourront discuter avec vous.',
	'IM_ALLOW_SOUND'						 => 'Jouer un son lors de la réception d’un message',
	'IM_ALLOW_SOUND_EXPLAIN'				 => 'Cette option active/désactive le son lors de la réception d’un nouveau message',

	'IM_HISTORY_PURGED_AT'					 => 'L’historique de la messagerie instantanée a été supprimé par l’administrateur le %1$s',
	'IM_NO_HISTORY'							 => 'Vous n’avez aucun message instantané',
	//'IM_HISTORY_WITH'						 => 'Historique avec',
	'IM_MSG_TOTAL'							 => '1 message',
	'IM_MSGS_TOTAL'							 => '%1$s messages',
	'IM_CONVERSATION_TOTAL'					 => '1 conversation',
	'IM_CONVERSATIONS_TOTAL'				 => '%1$s conversations',
	'IM_SOUND_SELECT_NAME'					 => 'Sélectionner un son',
	'EXPORT_IM_HISTORY'						 => 'Exporter la conversation avec %s',
	//'IM_HISTORY_SELECT_USER'				 => 'Sélectionner un utilisateur',
	'IM_GROUP_UNDECIDED'					 => 'Aucune catégorie',

	// Friends approval
	'ADD_FRIEND'							 => 'Ajouter un nouvel ami',
	'ACCEPT_FRIEND'							 => 'Accepter la demande d’ami',

	'SN_APPROVAL_FRIENDS'					 => 'Approuver l’amitié',
	'SN_APPROVALS_FRIENDS_EXPLAIN'			 => 'Ici, vous pouvez approuver les utilisateurs qui ont demandé à devenir votre ami.',

	'SN_APPROVE'							 => 'Accepter',
	'SN_NO_APPROVE'							 => 'Refuser',
	'SN_REFUSE'								 => 'Refuser',

	'SN_APPROVAL_REQUESTS'					 => 'Vos demandes',
	'SN_APPROVAL_REQUESTS_EXPLAIN'			 => 'Ici, vous pouvez annuler les demandes que vous avez envoyées.',

	'SN_VIEW_PROFILE'						 => 'Voir le profil',

	'SN_CANCEL_REQUEST'						 => 'Annuler la demande',

	'SN_REMOVE_FRIEND'						 => 'Supprimer l’ami',
	'SN_REMOVE_FRIENDS'						 => 'Vos amis',
	'SN_REMOVE_FRIENDS_EXPLAIN'				 => 'Ici, vous pouvez voir tous vos amis et les supprimer de votre liste d’amis',

	'SN_USING_AVATARS_1_EXPLAIN'			 => 'Cliquez sur les utilisateurs pour les sélectionner, puis confirmez l’opération',

	'FRIENDS_APPROVALS_SUCCESS'				 => ' a été ajouté à votre liste d’amis',
	'FRIENDS_APPROVALS_REQUEST_EXIST'		 => 'Vous avez déjà envoyé une demande à',
	'FRIENDS_APPROVALS_DENY'				 => 'La demande d’ami a été annulée',
	'FRIENDS_APPROVALS_REMOVE'				 => 'L’ami a été supprimé avec succès',
	'FRIENDS_APPROVALS_ADDED'				 => 'La demande d’ami a été envoyée avec succès',

	'SN_FAS_FRIEND_LIST'					 => 'Liste d’amis',
	'SN_FAS_COMMON_FRIEND_LIST'				 => 'Amis en commun',
	'SN_FAS_REMOVE'							 => 'Ami supprimé',

	'FAS_FRIEND_TOTAL'						 => 'Un ami',
	'FAS_FRIENDS_TOTAL'						 => '%1$s amis',
	'FAS_FRIEND_NO_TOTAL'					 => 'Aucun ami',
	'FAS_FRIENDGROUP_TOTAL'					 => 'Un ami',
	'FAS_FRIENDGROUPS_TOTAL'				 => '%1$s amis',
	'FAS_FRIENDGROUP_NO_TOTAL'				 => 'Aucun ami',
	'FAS_APPROVE_TOTAL'						 => 'Une approbation',
	'FAS_APPROVES_TOTAL'					 => '%1$s approbations',
	'FAS_APPROVE_NO_TOTAL'					 => 'Aucune approbation',
	'FAS_CANCEL_TOTAL'						 => 'Une demande',
	'FAS_CANCELS_TOTAL'						 => '%1$s demandes',
	'FAS_CANCEL_NO_TOTAL'					 => 'Aucune demande',
	'FAS_COMMON_TOTAL'						 => 'Un ami en commun',
	'FAS_COMMONS_TOTAL'						 => '%1$s amis en commun',
	'FAS_COMMON_NO_TOTAL'					 => 'Aucun ami en commun',
	'FAS_MUTUAL_NO_TOTAL'					 => 'Aucun ami en commun',
	'FAS_MUTUAL_TOTAL'						 => 'Un ami en commun',
	'FAS_MUTUALS_TOTAL'						 => '%1$s amis en commun',
	'FAS_SUGGESTION_NO_TOTAL'				 => 'Aucune suggestion',
	'FAS_SUGGESTION_TOTAL'					 => 'Une suggestion',
	'FAS_SUGGESTIONS_TOTAL'					 => '%1$s suggestions',

	'SN_FAS_NOT_ADDED_FRIENDS_IN_APPROVAL'	 => 'L’utilisateur a déjà été ajouté',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FOES'		 => 'L’utilisateur est déjà ignoré',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FRIENDS'	 => 'L’utilisateur est déjà un ami',

	// Friends groups
	'UFG_CREATE'							 => 'Créer un nouveau groupe d’amis',
	'UFG_NAME'								 => 'Nom du groupe d’amis',
	'UFG_CREATE_EXPLAIN'					 => 'Vous pouvez créer ici un groupe d’amis afin de répartir vos amis en groupes.',
	'UFG_MANAGE'							 => 'Groupes d’amis',
	'UFG_DRAG_FRIENDS_INTO_UFG'				 => 'Glissez-déposez les utilisateurs dans le groupe d’amis',
	'SN_CREATE_NEW_GROUP'					 => 'Créer un nouveau groupe',
	//'CONFIRM_CREATE_UFG'					 => 'Êtes-vous sûr de vouloir créer le groupe d’amis <strong>%1$s</strong> ?',
	'CONFIRM_DELETE_UFG'					 => 'Êtes-vous sûr de vouloir supprimer le groupe d’amis <strong>%1$s</strong> ?',
	'FMS_DELETE_UFG'						 => 'Supprimer le groupe d’amis',
	'FMS_DELETE_UFG_TEXT'					 => 'Êtes-vous sûr de vouloir supprimer ce groupe d’amis ?',

	'ADD_FRIEND_TO_GROUP'					 => 'Ajouter un ami au groupe d’amis',
	'ERROR_GROUP_EMPTY_NAME'				 => 'Nom du groupe vide',
	'ERROR_GROUP_ALREADY_EXISTS'			 => 'Vous avez déjà créé ce groupe',
));

// TITRES DES MESSAGES DE NOTIFICATION POUR LES MP
$lang = array_merge($lang, array(
	'SN_NTF_FRIENDSHIP_REQUEST_PM_TITLE'		=> '%1$s vous a envoyé une demande d’amitié',
	'SN_NTF_FRIENDSHIP_CANCEL_PM_TITLE'		=> '%1$s a annulé votre demande d’amitié',
	'SN_NTF_FRIENDSHIP_DENY_PM_TITLE'		=> '%1$s a refusé votre demande d’amitié',
	'SN_NTF_FRIENDSHIP_ACCEPT_PM_TITLE'		=> '%1$s a accepté votre demande d’amitié',

	'SN_NTF_STATUS_FRIEND_WALL_PM_TITLE'	=> '%1$s a laissé un message sur votre page de profil',
	'SN_NTF_STATUS_USER_COMMENT_PM_TITLE'	=> '%1$s a commenté le statut de %2$s',
	'SN_NTF_STATUS_AUTHOR_COMMENT_PM_TITLE'	=> '%1$s a commenté votre statut',

	'SN_NTF_APPROVE_FAMILY_PM_TITLE'		=> '%1$s vous a ajouté en tant que %2$s',
	'SN_NTF_APPROVE_RELATIONSHIP_PM_TITLE'	=> '%1$s a créé une relation avec vous',

	'SN_NTF_EMOTE_PM_TITLE'				=> '%1$s vous a envoyé une émoticône',

	'SN_NTF_RELATIONSHIP_APPROVED_PM_TITLE'	=> '%1$s a confirmé une relation avec vous',
	'SN_NTF_FAMILY_APPROVED_PM_TITLE'		=> '%1$s a confirmé un lien familial avec vous',

	'SN_NTF_RELATIONSHIP_REFUSED_PM_TITLE'	=> '%1$s a refusé une relation avec vous',
	'SN_NTF_FAMILY_REFUSED_PM_TITLE'		=> '%1$s a refusé un lien familial avec vous',

	'SN_NTF_STATUS_FRIEND_MENTION_PM_TITLE' => '%1$s vous a mentionné dans son statut',
));

// MCP
$lang = array_merge($lang, array(
	'MCP_SOCIALNET'				 => 'Réseau social',
	'MCP_SN_REPORTUSER'			 => 'Utilisateurs signalés',

	'POSTS_IN_QUEUE'			 => 'Messages en attente',

	'SN_UP_REPORTED_USER'		 => 'Utilisateur signalé',
	'SN_UP_REPORT_TEXT'		 => 'Détails',
	'SN_UP_REASON'			 => 'Raison',
	'SN_UP_VIEW_REPORTS'		 => 'Voir les signalements',
	'SN_UP_CLOSE_REPORT_CONFIRM'	 => 'Êtes-vous sûr de vouloir fermer ce signalement ?',
	'SN_UP_CLOSE_REPORTS_CONFIRM'	 => 'Êtes-vous sûr de vouloir fermer ces signalements ?',
	'SN_UP_CLOSE_REPORT_SUCCESS'	 => 'Le signalement a été fermé avec succès.',
	'SN_UP_CLOSE_REPORTS_SUCCESS'	 => 'Les signalements ont été fermés avec succès.',
	'SN_UP_DELETE_REPORT_CONFIRM'	 => 'Êtes-vous sûr de vouloir supprimer ce signalement ?',
	'SN_UP_DELETE_REPORTS_CONFIRM'	 => 'Êtes-vous sûr de vouloir supprimer ces signalements ?',
	'SN_UP_DELETE_REPORT_SUCCESS'	 => 'Le signalement a été supprimé avec succès.',
	'SN_UP_DELETE_REPORTS_SUCCESS'	 => 'Les signalements ont été supprimés avec succès.',
));

// NOTIFICATIONS
$lang = array_merge($lang, array(
	'SN_AP_NOTIFY'				 => 'Notifications',
	'SN_NO_NOTIFY'			 => 'Vous n’avez aucune notification',
	'SN_NTF_FRIENDSHIP_ACCEPT'	 => '%1$s a accepté votre <a href="%2$s">demande d’amitié</a>',
	'SN_NTF_FRIENDSHIP_DENY'	 => '%1$s a refusé votre <a href="%2$s">demande d’amitié</a>',
	'SN_NTF_FRIENDSHIP_REQUEST'	 => '%1$s vous a envoyé une <a href="%2$s">demande d’amitié</a>',
	'SN_NTF_FRIENDSHIP_CANCEL'	 => '%1$s a annulé votre <a href="%2$s">demande d’amitié</a>',

	'SN_NTF_STATUS_AUTHOR_COMMENT'	 => '%1$s a commenté <a href="%2$s">votre statut</a>',
	'SN_NTF_STATUS_USER_COMMENT'	 => '%1$s a commenté <a href="%3$s">le statut de %2$s</a>',
	'SN_NTF_STATUS_FRIEND_WALL'	 => '%1$s a laissé un message sur <a href="%2$s">votre page de profil</a>',

	'SN_NTF_APPROVE_FAMILY'		 => '%1$s vous a ajouté en tant que %2$s. Vous pouvez <a href="%3$s">approuver cette relation ici</a>',
	'SN_NTF_APPROVE_RELATIONSHIP'	 => '%1$s a créé une relation avec vous. Vous pouvez <a href="%2$s">approuver cette relation ici</a>',

	'SN_NTF_EMOTE'			 => '%1$s vous a envoyé une émoticône : %2$s %3$s',

	'SN_NTF_RELATIONSHIP_APPROVED'	 => '%1$s a confirmé une <a href="%2$s">relation</a> avec vous',
	'SN_NTF_FAMILY_APPROVED'	 => '%1$s a confirmé un <a href="%2$s">lien familial</a> avec vous',

	'SN_NTF_RELATIONSHIP_VICEVERSA'	 => '%1$s a confirmé une <a href="%2$s">relation</a> avec vous et l’a également ajoutée à son profil',
	'SN_NTF_FAMILY_VICEVERSA'	 => '%1$s a confirmé un <a href="%2$s">lien familial</a> avec vous et l’a également ajouté à son profil',

	'SN_NTF_RELATIONSHIP_REFUSED'	 => '%1$s a refusé une <a href="%2$s">relation</a> avec vous',
	'SN_NTF_FAMILY_REFUSED'		 => '%1$s a refusé un <a href="%2$s">lien familial</a> avec vous',

	'SN_NTF_STATUS_FRIEND_MENTION' => '%1$s vous a mentionné dans <a href="%2$s">son statut</a>',
));

// ÉMOTICÔNES
$lang = array_merge($lang, array(
	'SN_UP_EMOTES_USER'	 => 'Émoticônes',
));

// EXTENSEUR
$lang = array_merge($lang, array(
	'SN_EXPANDER_READ_MORE'	 => 'Voir plus',
	'SN_EXPANDER_READ_LESS'	 => 'Fermer',
));

// NAVIGATEUR OBSOLÈTE
$lang = array_merge($lang, array(
	'BROWSER_OUTDATED_TITLE'	 => 'Votre navigateur est obsolète',
	'BROWSER_OUTDATED'		 => 'Certaines fonctionnalités ne fonctionneront pas avec votre navigateur. Nous vous recommandons vivement de le mettre à jour.',
));

