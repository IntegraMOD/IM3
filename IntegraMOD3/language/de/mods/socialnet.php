<?php
/**
 * - [Deutsch — Du]
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
	'SN_AP_WELCOME_TITLE'					 => 'Willkommen auf unserer Website!',
	'SN_AP_WELCOME_TEXT'					 => 'Registriere dich gerne und nutze alle Funktionen unserer Website.<br /><br />Viele Gr&uuml;&szlig;e,<br />die Administration',

	'SN_MODULE_IM_NAME'						 => 'Instant Messenger',
	'SN_MODULE_USERSTATUS_NAME'				 => 'Benutzerstatus',
	'SN_MODULE_APPROVAL_NAME'				 => 'Freundeverwaltung',

	'SN_IM_CHAT'							 => 'Chat',
	'SN_IM_NO_ONLINE_USER'					 => 'Kein Benutzer online',
	'SN_IM_YOU_ARE_OFFLINE'					 => 'Du bist offline',
	'SN_IM_SOUND'							 => 'Ton',
	'SN_IM_SELECT_NAME'						 => 'W&auml;hle einen Ton',
	'SN_IM_NEW_MESSAGE'						 => 'Neue Nachricht',
	'SN_IM_LOGIN'							 => 'Online',
	'SN_IM_LOGOUT'							 => 'Offline',
	'SN_IM_PRESS_TO_CLOSE'					 => 'Dr&uuml;cke %1$s, um das Chatfenster zu schlie&szlig;en',
	'SN_IM_PRESS_TO_SEND'					 => 'Dr&uuml;cke %1$s, um die Nachricht zu senden',

	'SN_US_SHARE_STATUS'					 => 'Teilen',
	'SN_US_WHATS_ON_YOUR_MIND'				 => 'Was machst du gerade?',
	'SN_US_EMPTY_STATUS'					 => 'Du kannst keinen leeren Status senden',
	'SN_US_COMMENT'							 => 'Kommentieren',
	'SN_US_EMPTY_COMMENT'					 => 'Du kannst keinen leeren Kommentar senden',
	'SN_US_USER_STATUS_WALL'				 => 'Aktivit&auml;t',
	'SN_US_WRITE_COMMENT'					 => 'Schreibe einen Kommentar...',
	'SN_US_COMMENT_STATUS'					 => 'Kommentieren',
	'SN_US_HAS_NO_STATUS'					 => 'hat keinen Status',
	'SN_US_HAS_DELETED_STATUS'				 => 'Dieser Status wurde gel&ouml;scht',
	'SN_STATUS_NOT_EXISTS'					 => 'Dieser Status existiert nicht',
	'SN_US_HAS_NO_ACTIVITY'					 => 'hat keine Aktivit&auml;ten',
	'SN_US_SHARED_STATUS'					 => 'Du hast deinen Status geteilt',
	'SN_US_DELETE_STATUS'					 => 'L&ouml;schen',
	'SN_US_LOAD_MORE'						 => '&Auml;ltere Beitr&auml;ge',
	'SN_US_VIEW'						 	 => 'Ansehen',
	'SN_US_LOAD_MORE_COMMENT'				 => 'weiterer Kommentar',
	'SN_US_LOAD_MORE_COMMENTS'				 => 'weitere Kommentare',
	'SN_US_CONFIRM'							 => 'Best&auml;tigen',
	'SN_US_CLOSE'							 => 'Schlie&szlig;en',
	'SN_US_CANCEL'							 => 'Abbrechen',
	'SN_US_SHARED_A'						 => 'teilte einen',
	'SN_US_LINK'							 => 'Link',

	//
	// FETCH PAGE
	//
	'SN_US_FETCH_PAGE'						 => 'Seite abrufen',
	'SN_US_FETCH_CLEAR'						 => 'Geladene Seite leeren',
	'SN_US_NO_VIDEO_THUMB'					 => 'Keine Videovorschau',
	'LOADER'								 => 'L&auml;dt',
	'NEXT_IMAGE'							 => 'N&auml;chstes Bild',
	'PREVIOUS_IMAGE'						 => 'Vorheriges Bild',
	'OF'									 => 'von',
	'SN_US_NO_IMG_THUMB'					 => 'Keine Bildvorschau',
	'SN_US_CHOOSE_THUMB'					 => 'Bilder',
	'SN_CB_FETCH_ERROR'						 => 'Beim Abrufen der Webseite ist ein Fehler aufgetreten',

	'SN_AP_ACTIVITYPAGE'					 => 'Mein Netzwerk',
	'SN_AP_AND'								 => 'und',
	'SN_AP_ARE_FRIENDS'						 => 'sind jetzt Freunde',
	'SN_AP_ADD_AS_FRIEND'					 => 'Als Freund hinzuf&uuml;gen',
	'SN_AP_PRIVATE_MESSAGE'					 => 'Nachrichten',
	'SN_AP_MANAGE_PROFILE'					 => 'Mein Profil bearbeiten',
	'SN_AP_VIEW_FRIENDS'					 => 'Meine Freunde ansehen',
	'SN_AP_VIEW_SUGGESTIONS'				 => 'Personen, die du vielleicht kennst',
	'SN_AP_MANAGE_FRIENDS'					 => 'Freunde verwalten',
	'SN_AP_BOARD'							 => 'Forum',
	'SN_AP_VIEW_MEMBERLIST'					 => 'Mitglieder anzeigen',
	'SN_AP_LOG_OUT'							 => 'Abmelden',
	'SN_AP_LAST_POSTS'						 => 'Letzte Diskussionen',
	'SN_AP_TOTAL_FRIEND'					 => 'Du hast 1 Freund',
	'SN_AP_TOTAL_FRIENDS'					 => 'Du hast %s Freunde',
	'SN_AP_FRIEND_SUGGESTIONS'				 => 'Personen, die du vielleicht kennst',
	'SN_AP_REQUESTS_LIST'					 => 'Anfragen',
	'SN_AP_ONLINE_FRIENDS'					 => 'Freunde online',
	'SN_AP_NO_ONLINE_USER'					 => 'Keine Benutzer online',
	'SN_AP_NO_DISCUSSION'					 => 'Keine aktuellen Diskussionen',
	'SN_AP_NO_BIRTHDAY'					 	 => 'In n&auml;chster Zeit stehen keine Geburtstage an',
	'SN_AP_NO_ENTRY'						 => 'Hier gibt es nichts Neues',
	'SN_AP_LOAD_NEWS'						 => 'Aktualisieren',
	'SN_AP_SEE_ALL'							 => 'Alle anzeigen',
	'SN_AP_NO_FRIENDS'						 => 'Du hast keine Freunde',
	'SN_AP_KEEP_LOGGEDIN'					 => 'Angemeldet bleiben',
	'SN_AP_STATISTICS'						 => 'Statistiken',
	'SN_AP_TOTAL_USERS'						 => '<strong>%d</strong> Mitglieder',
	'SN_AP_TOTAL_POSTS'						 => '<strong>%d</strong> Beitr&auml;ge',
	'SN_AP_TOTAL_TOPICS'					 => '<strong>%d</strong> Themen',
	'SN_AP_TOPICS_PER_DAY'					 => '<strong>%d</strong> Themen pro Tag',
	'SN_AP_POSTS_PER_DAY'					 => '<strong>%d</strong> Beitr&auml;ge pro Tag',
	'SN_AP_USERS_PER_DAY'					 => '<strong>%d</strong> Benutzer pro Tag',
	'SN_AP_BIRTHDAY'						 => 'Geburtstag',
	'SN_AP_BIRTHDAY_1'						 => 'Geburtstag <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_2'						 => 'Geburtstag am <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_USERNAME'				 => 'von %1$s',
	'SN_AP_WELCOME'							 => 'Willkommen',
	'SN_AP_VIEWING_ACTIVITYPAGE'			 => 'Betrachtet Aktivit&auml;t-Seite',
	'SN_AP_NO_SUGGESTIONS'					 => 'Derzeit gibt es keine Freundesvorschl&auml;ge f&uuml;r dich',
	'SN_AP_SEARCH'							 => 'Suche…',
	'SN_AP_CHANGED_PROFILE_HIS'				 => 'hat sein Profil aktualisiert',
	'SN_AP_CHANGED_PROFILE_HER'				 => 'hat ihr Profil aktualisiert',
	'SN_AP_CHANGED_PROFILE_THEIR'			 => 'hat das Profil aktualisiert',
	'SN_UP_CHANGED_AVATAR_HIS'				 => 'hat seinen Avatar ge&auml;ndert',
	'SN_UP_CHANGED_AVATAR_HER'				 => 'hat ihren Avatar ge&auml;ndert',
	'SN_UP_CHANGED_AVATAR_THEIR'			 => 'hat den Avatar ge&auml;ndert',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HIS'		 => 'hat %1$s (%2$s) als neues Familienmitglied zu seinem Profil hinzugef&uuml;gt',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HER'		 => 'hat %1$s (%2$s) als neues Familienmitglied zu ihrem Profil hinzugef&uuml;gt',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_THEIR'	 => 'hat %1$s (%2$s) als neues Familienmitglied zum Profil hinzugef&uuml;gt',
	'SN_AP_CHANGED_RELATIONSHIP_HIS'		 => 'hat eine neue Beziehung zu seinem Profil hinzugef&uuml;gt',
	'SN_AP_CHANGED_RELATIONSHIP_HER'		 => 'hat eine neue Beziehung zu ihrem Profil hinzugef&uuml;gt',
	'SN_AP_CHANGED_RELATIONSHIP_THEIR'		 => 'hat eine neue Beziehung zum Profil hinzugef&uuml;gt',
	'SN_UP_SEND_EMOTE'						 => 'hat ein Emote gesendet an',

	'SN_PROFILE'							 => 'Profil',
	'SN_MYPROFILE'							 => 'Mein Profil',

	// User profile
	'SN_UP_PROFILE_UPDATED'					 => 'Dein Profil wurde erfolgreich aktualisiert.',
	'SN_UP_HOMETOWN'						 => 'Heimatstadt',
	'SN_UP_SEX'								 => 'Geschlecht',
	'SN_UP_INTERESTED_IN'					 => 'Interessiert an',
	'SN_UP_PRIVACY_LEVEL'					 => 'Datenschutzstufe',
	'SN_UP_PRIVACY_PRIVATE'					 => 'Privat (nur Administratoren)',
	'SN_UP_PRIVACY_FRIENDS'					 => 'Nur Freunde',
	'SN_UP_PRIVACY_DEFAULT'					 => 'Standard (Jeder)',
	'SN_UP_ALLOW_FRIEND_REQUESTS'			 => 'Mitgliedern erlauben, mir Freundschaftsanfragen zu senden',
	'SN_UP_PRIVACY_LOCKED'					 => 'Der Board-Administrator erlaubt es Mitgliedern nicht, ihre Datenschutzeinstellungen zu ändern.',
	'SN_UP_PRIVACY_DEFAULT_NOTICE'			 => 'Die Standard-Datenschutzrichtlinie des Boards ist: <strong>%s</strong>.',
	'SN_UP_LANGUAGES'						 => 'Sprachen',
	'SN_UP_ABOUT_ME'						 => '&Uuml;ber mich',
	'SN_UP_EMPLOYER'						 => 'Arbeitgeber',
	'SN_UP_UNIVERSITY'						 => 'Universit&auml;t',
	'SN_UP_HIGH_SCHOOL'						 => 'Schule',
	'SN_UP_OCCUPATION'						 => 'Beruf',
	'SN_UP_RELIGION'						 => 'Religion',
	'SN_UP_POLITICAL_VIEWS'					 => 'Politische Ansichten',
	'SN_UP_QUOTATIONS'						 => 'Lieblingszitate',
	'SN_UP_INTERESTS'						 => 'Interessen',
	'SN_UP_MUSIC'							 => 'Musik',
	'SN_UP_BOOKS'							 => 'B&uuml;cher',
	'SN_UP_MOVIES'							 => 'Filme',
	'SN_UP_GAMES'							 => 'Spiele',
	'SN_UP_FOODS'							 => 'Lieblingsessen',
	'SN_UP_SPORTS'							 => 'Sportarten',
	'SN_UP_SPORT_TEAMS'						 => 'Lieblingssportteams',
	'SN_UP_ACTIVITIES'						 => 'Aktivit&auml;ten',
	'SN_UP_SKYPE'							 => 'Skype',
	'SN_UP_FACEBOOK'						 => 'Facebook',
	'SN_UP_TWITTER'							 => 'Twitter',
	'SN_UP_YOUTUBE'							 => 'Youtube',
	'SN_UP_USER_ICQ'						 => 'ICQ-Nummer',
	'SN_UP_USER_AIM'						 => 'AOL Instant Messenger',
	'SN_UP_USER_MSNM'						 => 'WL/MSN Messenger',
	'SN_UP_USER_YIM'						 => 'Yahoo Messenger',
	'SN_UP_USER_JABBER'						 => 'Jabber-Adresse',
	'SN_UP_USER_WEBSITE'					 => 'Website',
	'SN_UP_USER_FROM'						 => 'Wohnort',
	'SN_UP_USER_INTERESTS'					 => 'Interessen',
	'SN_UP_BDAY_MONTH'						 => 'Geburtsmonat',
	'SN_UP_BDAY_DAY'						 => 'Geburtstag',
	'SN_UP_BDAY_YEAR'						 => 'Geburtsjahr',
	'SN_UP_USERNAME'						 => 'Benutzername',
	'SN_UP_USER_EMAIL'						 => 'E-Mail',
	'SN_UP_USER_BIRTHDAY'					 => 'Geburtstag',
	'SN_UP_USER_OCC'						 => 'Beruf',
	'SN_UP_USER_SIG'						 => 'Signatur',
	'SN_UP_PROFILE_VIEWS'					 => 'Profilaufrufe',
	'SN_UP_X_TIMES'							 => 'x',
	'SN_UP_PROFILE_VISITORS'				 => 'Profilbesucher',
	'SN_UP_LAST_CHANGE'						 => 'Letzte Profilaktualisierung',
	'SN_UP_MALE'							 => 'M&auml;nnlich',
	'SN_UP_MALES'							 => 'M&auml;nner',
	'SN_UP_FEMALE'							 => 'Weiblich',
	'SN_UP_FEMALES'							 => 'Frauen',
	'SN_UP_BOTH'							 => 'Beide',
	'SN_UP_RELATIONSHIP'					 => 'Beziehungsstatus',
	'SN_UP_SINGLE'							 => 'Single',
	'SN_UP_IN_RELATIONSHIP'					 => 'In einer Beziehung',
	'SN_UP_ENGAGED'							 => 'Verlobt',
	'SN_UP_MARRIED'							 => 'Verheiratet',
	'SN_UP_ITS_COMPLICATED'					 => 'Es ist kompliziert',
	'SN_UP_OPEN_RELATIONSHIP'				 => 'In einer offenen Beziehung',
	'SN_UP_WIDOWED'							 => 'Verwitwet',
	'SN_UP_SEPARATED'						 => 'Getrennt',
	'SN_UP_DIVORCED'						 => 'Geschieden',
	'SN_UP_TO'								 => 'mit',
	'SN_UP_WITH'							 => 'mit',
	'SN_UP_ANNIVERSARY'						 => 'Jahrestag',
	'SN_UP_ANNIVERSARY_ON'					 => 'Jahrestag am',
	'SN_UP_BIRTHDAY'						 => 'Geburtsdatum',
	'SN_UP_SUNDAY'							 => 'Sonntag',
	'SN_UP_MONDAY'							 => 'Montag',
	'SN_UP_TUESDAY'							 => 'Dienstag',
	'SN_UP_WEDNESDAY'						 => 'Mittwoch',
	'SN_UP_THURSDAY'						 => 'Donnerstag',
	'SN_UP_FRIDAY'							 => 'Freitag',
	'SN_UP_SATURDAY'						 => 'Samstag',
	'SN_UP_SUNDAY_MIN'						 => 'So',
	'SN_UP_MONDAY_MIN'						 => 'Mo',
	'SN_UP_TUESDAY_MIN'						 => 'Di',
	'SN_UP_WEDNESDAY_MIN'					 => 'Mi',
	'SN_UP_THURSDAY_MIN'					 => 'Do',
	'SN_UP_FRIDAY_MIN'						 => 'Fr',
	'SN_UP_SATURDAY_MIN'					 => 'Sa',
	'SN_UP_JANUARY_MIN'						 => 'Jan',
	'SN_UP_FEBRUARY_MIN'					 => 'Feb',
	'SN_UP_MARCH_MIN'						 => 'M&auml;r',
	'SN_UP_APRIL_MIN'						 => 'Apr',
	'SN_UP_MAY_MIN'							 => 'Mai',
	'SN_UP_JUNE_MIN'						 => 'Jun',
	'SN_UP_JULY_MIN'						 => 'Jul',
	'SN_UP_AUGUST_MIN'						 => 'Aug',
	'SN_UP_SEPTEMBER_MIN'					 => 'Sep',
	'SN_UP_OCTOBER_MIN'						 => 'Okt',
	'SN_UP_NOVEMBER_MIN'					 => 'Nov',
	'SN_UP_DECEMBER_MIN'					 => 'Dez',
	'SN_UP_FAMILY'							 => 'Familie',
	'SN_UP_SELECT_RELATIONSHIP'				 => 'Beziehung hinzuf&uuml;gen',
	'SN_UP_SELECT_FAMILY_RELATION'			 => 'Familienmitglied hinzuf&uuml;gen',
	'SN_UP_SISTER'							 => 'Schwester',
	'SN_UP_BROTHER'							 => 'Bruder',
	'SN_UP_DAUGHTER'						 => 'Tochter',
	'SN_UP_SON'								 => 'Sohn',
	'SN_UP_MOTHER'							 => 'Mutter',
	'SN_UP_FATHER'							 => 'Vater',
	'SN_UP_AUNT'							 => 'Tante',
	'SN_UP_UNCLE'							 => 'Onkel',
	'SN_UP_NIECE'							 => 'Nichte',
	'SN_UP_NEPHEW'							 => 'Neffe',
	'SN_UP_COUSIN_FEMALE'					 => 'Cousine',
	'SN_UP_COUSIN_MALE'						 => 'Cousin',
	'SN_UP_GRANDDAUGHTER'					 => 'Enkelin',
	'SN_UP_GRANDSON'						 => 'Enkel',
	'SN_UP_GRANDMOTHER'						 => 'Gro&szlig;mutter',
	'SN_UP_GRANDFATHER'						 => 'Gro&szlig;vater',
	'SN_UP_SISTER_IN_LAW'					 => 'Schw&auml;gerin',
	'SN_UP_BROTHER_IN_LAW'					 => 'Schwager',
	'SN_UP_MOTHER_IN_LAW'					 => 'Schwiegermutter',
	'SN_UP_FATHER_IN_LAW'					 => 'Schwiegervater',
	'SN_UP_DAUGHTER_IN_LAW'					 => 'Schwiegertochter',
	'SN_UP_SON_IN_LAW'						 => 'Schwiegersohn',
	'SN_UP_ADD_FAMILY_MEMBER'				 => 'Familienmitglied hinzuf&uuml;gen',
	'SN_UP_ADD_FAMILY_ERR_MEMBER_EMPTY'		 => 'Kein Name f&uuml;r das Familienmitglied angegeben',
	'SN_UP_APPROVE'							 => 'Best&auml;tigen',
	'SN_UP_IGNORE'							 => 'Ignorieren',
	'SN_UP_APPROVE_RELATION_SUBJECT'		 => '%1$s hat eine Beziehung mit dir angegeben',
	'SN_UP_APPROVE_RELATION_TEXT'			 => '%2$s hat eine Beziehung mit dir angegeben: <strong>%3$s %2$s</strong>.<br /><br />%1$sDu kannst diese Beziehung hier best&auml;tigen%4$s',
	'SN_UP_APPROVE_RELATION_CONFIRM'		 => 'M&ouml;chtest du diese Beziehung wirklich best&auml;tigen?',
	'SN_UP_REFUSE_RELATION_CONFIRM'			 => 'M&ouml;chtest du diese Beziehung wirklich ablehnen?',
	'SN_UP_APPROVE_RELATION_ERROR_CANCELED'	 => 'Diese Beziehung wurde abgebrochen',
	'SN_UP_APPROVE_RELATION_ERROR_MYSELF'	 => 'Du kannst keine Beziehung mit dir selbst eingehen',
	'SN_UP_APPROVE_RELATION_ERROR_APPROVED'	 => 'Diese Beziehung wurde bereits best&auml;tigt',
	'SN_UP_APPROVE_RELATION_ERROR_REFUSED'	 => 'Diese Beziehung wurde bereits abgelehnt',
	'SN_UP_APPROVE_RELATION_VICE_VERSA'		 => 'Ich m&ouml;chte diese Beziehung auch zu meinem Profil hinzuf&uuml;gen.',
	'SN_UP_DELETE_RELATIONSHIP_CONFIRM'		 => 'M&ouml;chtest du diese Beziehung wirklich l&ouml;schen?',
	'SN_UP_APPROVE_RELATION_NO_RELATIONSHIP' => 'Kein Beziehungsstatus',
	'SN_UP_APPROVE_FAMILY_SUBJECT'			 => '%1$s hat dich als %2$s hinzugef&uuml;gt',
	'SN_UP_APPROVE_FAMILY_TEXT'				 => '%2$s hat dich als <strong>%3$s</strong> hinzugef&uuml;gt.<br /><br />%1$sDu kannst dieses Verh&auml;ltnis hier best&auml;tigen%4$s',
	'SN_UP_APPROVE_FAMILY_CONFIRM'			 => 'M&ouml;chtest du dieses Familienverh&auml;ltnis wirklich best&auml;tigen?',
	'SN_UP_REFUSE_FAMILY_CONFIRM'			 => 'M&ouml;chtest du dieses Familienverh&auml;ltnis wirklich ablehnen?',
	'SN_UP_APPROVE_FAMILY_ERROR_CANCELED'	 => 'Dieses Familienverh&auml;ltnis wurde abgebrochen',
	'SN_UP_APPROVE_FAMILY_ERROR_MYSELF'		 => 'Du kannst dich nicht selbst als Familienmitglied hinzuf&uuml;gen',
	'SN_UP_APPROVE_FAMILY_ERROR_APPROVED'	 => 'Dieses Familienverh&auml;ltnis wurde bereits best&auml;tigt.',
	'SN_UP_APPROVE_FAMILY_ERROR_REFUSED'	 => 'Dieses Familienverh&auml;ltnis wurde bereits abgelehnt.',
	'SN_UP_APPROVE_FAMILY_ERROR_EXIST'		 => '%1$s wurde bereits zu deiner Familie hinzugef&uuml;gt',
	'SN_UP_APPROVE_FAMILY_VICE_VERSA'		 => 'Ich m&ouml;chte %1$s auch zu meinen Familienmitgliedern hinzuf&uuml;gen.',
	'SN_UP_APPROVE_FAMILY_USERNAME'			 => '%1$s ist mein(e)',
	'SN_UP_APPROVE_NO_FAMILY_MEMBER'		 => 'Kein Familienmitglied',
	'SN_UP_DELETE_FAMILY_CONFIRM'			 => 'M&ouml;chtest du <strong>%1$s</strong> wirklich aus deinen Familienmitgliedern l&ouml;schen?',
	'SN_UP_USERNAME_NOT_EXIST'				 => 'Der eingegebene Benutzername existiert nicht',
	'SN_UP_NOT_APPROVED'					 => 'noch nicht best&auml;tigt',
	'SN_UP_RELATION_REFUSED'				 => 'abgelehnt',
	'SN_UP_RELATION_REQUESTS'				 => 'Anfragen',
	'SN_UP_APPROVE_REQUESTS'				 => 'Beziehung best&auml;tigen',
	'WRONG_DATA_FACEBOOK'					 => 'Die Facebook-Adresse muss eine g&uuml;ltige URL inklusive http-Protokoll sein. Zum Beispiel http://www.facebook.com/<benutzername>/',
	'WRONG_DATA_TWITTER'					 => 'Die Twitter-Adresse muss eine g&uuml;ltige URL inklusive http-Protokoll sein. Zum Beispiel http://twitter.com/<benutzername>/',
	'WRONG_DATA_YOUTUBE'					 => 'Die Youtube-Adresse muss eine g&uuml;ltige URL inklusive http-Protokoll sein. Zum Beispiel http://www.youtube.com/user/<benutzername>/',
	'WRONG_DATA_FAMILY_USER'				 => 'Einer der eingegebenen Familienmitglieder-Benutzernamen existiert nicht',
	'WRONG_DATA_RELATION_USER'				 => 'Der f&uuml;r die Beziehung eingegebene Benutzername existiert nicht',
	'WRONG_DATA_ANNIVERSARY'				 => 'Der Jahrestag muss ein g&uuml;ltiges Datum im Format TT-MM-JJJJ sein. Zum Beispiel 01-12-2011',
	'TOO_SHORT_FACEBOOK'					 => 'Die eingegebene Facebook-Adresse ist zu kurz (mindestens 12 Zeichen erforderlich).',
	'TOO_SHORT_TWITTER'						 => 'Die eingegebene Twitter-Adresse ist zu kurz (mindestens 12 Zeichen erforderlich).',
	'TOO_SHORT_YOUTUBE'						 => 'Die eingegebene Youtube-Adresse ist zu kurz (mindestens 12 Zeichen erforderlich).',
	'TOO_SHORT_ANNIVERSARY'					 => 'Das eingegebene Datum ist zu kurz (mindestens 8 Zeichen erforderlich).',
	'TOO_SHORT_SKYPE'						 => 'Der eingegebene Skype-Name ist zu kurz (mindestens 6 Zeichen erforderlich).',
	'SN_UP_WALL'							 => 'Aktivit&auml;t',
	'SN_UP_INFO'							 => 'Info',
	'SN_UP_FRIENDS'							 => 'Freunde',
	'SN_UP_STATS'							 => 'Statistiken',
	'SN_UP_BASIC_INFO'						 => 'Basis-Info',
	'SN_UP_EDU_WORK'						 => 'Ausbildung und Beruf',
	'SN_UP_PHILOSOPHY'						 => 'Lebenseinstellung',
	'SN_UP_ENT_ACT'							 => 'Unterhaltung und Aktivit&auml;ten',
	'SN_UP_CONTACT_INFO'					 => 'Kontaktinformationen',
	'SN_UP_OTHER_INFO'						 => 'Weitere Angaben',
	'SN_UP_LAST_VISITORS'					 => 'Letzte Profilbesucher',
	'SN_UP_PROFILE_VIEWED'					 => 'Profil aufgerufen',
	'SN_UP_ADD_FRIEND'						 => 'Freund hinzuf&uuml;gen',
	'SN_UP_ADD_FRIEND_TO_GROUP'				 => 'Zu Gruppe hinzuf&uuml;gen',
	'SN_UP_EDIT_PROFILE'					 => 'Profil bearbeiten',
	'SN_UP_EDIT_FRIENDS'					 => 'Freunde verwalten',
	'SN_UP_EDIT_RELATIONS'					 => 'Beziehungen verwalten',
	'SN_UP_REPORT_PROFILE'					 => 'Benutzer melden',
	'SN_UP_EMPTY_REPORT'					 => 'Du musst einen Grund f&uuml;r die Meldung ausw&auml;hlen',
	'SN_UP_REPORT_SUCCESS'					 => 'Benutzer wurde erfolgreich gemeldet',
	'SN_UP_CAN_LEAVE_BLANK'					 => 'Kann leer gelassen werden.',
	'SN_UP_MORE_INFO'						 => 'Weitere Informationen',
	'SN_UP_RETURN_TO_PROFILE'				 => '%1$sZur&uuml;ck zum Profil%2$s',
	'SN_UP_TABS_SPINNER'					 => '<em>Laden&#8230;<\/em>',
	'SN_UP_EMOTES'							 => 'Emote senden',

	'SN_LIKED_POSTS'						 => 'Erhaltene Likes',
	'SN_SEARCH_LIKED_POSTS'					 => 'Beiträge mit „Gefällt mir“ suchen',
	'SN_LIKES_SENT'         				 => 'Vergebene Likes',
	'SN_SEARCH_LIKES_SENT'  				 => 'Beiträge suchen, die du mit „Gefällt mir“ markiert hast',

	'SN_UP_PROFILE_VALUE_DELETED'			 => '<em>Entfernt</em>',

	'SN_NTF_EMOTE_CB_TITLE'					 => 'Emote gesendet',
	'SN_NTF_EMOTE_CB_TEXT'					 => 'Emote %2$s %3$s wurde erfolgreich an %1$s gesendet',

	'SN_IN'									 => 'in',

	'AVATAR'								 => 'Avatar',

	'FOES'									 => 'Ignorierte Mitglieder',
	'MUTUAL'								 => 'Gemeinsame Freunde',
	'SUGGESTIONS'							 => 'Vorschl&auml;ge',

	// This patterns are used for various date labels.
	// Each language should have convention how to display dates,
	// this is where you specify it for each user browsing the labels in
	// this language.
	'SN_DAY_MONTH_YEAR_PATTERN'				 => 'j. F Y',
	'SN_DAY_MONTH_PATTERN'						 => 'j. F',
	'SN_MONTH_YEAR_PATTERN'					 => 'F Y',
	'SN_YEAR_PATTERN'							 => 'Y',

	/**
	 * CONFIRM BOXES
	 */
	'SN_CB_DELETE_STATUS_TITLE'				 => 'Status l&ouml;schen',
	'SN_CB_DELETE_STATUS_TEXT'				 => 'M&ouml;chtest du diesen Status wirklich l&ouml;schen?',
	'SN_CB_DELETE_COMMENT_TITLE'			 => 'Kommentar l&ouml;schen',
	'SN_CB_DELETE_COMMENT_TEXT'				 => 'M&ouml;chtest du diesen Kommentar wirklich l&ouml;schen?',
	'SN_CB_DELETE_ACTIVITY_TITLE'			 => 'Aktivit&auml;t l&ouml;schen',
	'SN_CB_DELETE_ACTIVITY_TEXT'			 => 'M&ouml;chtest du diese Aktivit&auml;t wirklich l&ouml;schen?',

	/**
	 * SOCIALNET TIME AGO
	 */
	'SN_TIME_AGO'							 => 'vor %1$u %2$s',
	'SN_TIME_FROM_NOW'						 => 'in %1$u %2$s',
	'SN_TIME_PERIODS'						 => array(
		'SECOND'	 => 'Sekunde',
		'SECONDS'	 => 'Sekunden',
		'MINUTE'	 => 'Minute',
		'MINUTES'	 => 'Minuten',
		'HOUR'		 => 'Stunde',
		'HOURS'		 => 'Stunden',
		'DAY'		 => 'Tag',
		'DAYS'		 => 'Tagen',
		'WEEK'		 => 'Woche',
		'WEEKS'		 => 'Wochen',
		'MONTH'		 => 'Monat',
		'MONTHS'	 => 'Monaten',
		'YEAR'		 => 'Jahr',
		'YEARS'		 => 'Jahren',
		'DECADE'	 => 'Jahrzehnt',
		'DECADES'	 => 'Jahrzehnten',
	)
));

// UCP
$lang = array_merge($lang, array(
	// UCP
	'UCP_SOCIALNET'							 => 'Social Network',
	'UCP_SOCIALNET_SETTINGS'				 => 'Social-Network-Einstellungen',
	'UCP_SN_IM'								 => 'Instant-Messenger-Einstellungen',
	'UCP_SN_IM_SETTINGS'					 => 'Instant-Messenger-Einstellungen',
	'UCP_SN_IM_HISTORY'						 => 'Instant-Messenger-Verlauf',
	'UCP_SN_APPROVAL_UFG'					 => 'Freundesgruppen',
	'UCP_SOCIALNET_IM_PURGE_MESSAGES'		 => 'Instant-Messenger-Nachrichten l&ouml;schen',
	'UCP_SOCIALNET_USERSTATUS'				 => 'Benutzerstatus-Einstellungen',
	'UCP_SN_PROFILE'						 => 'Pers&ouml;nliche Daten &auml;ndern',
	'UCP_SN_PROFILE_RELATIONS'				 => 'Beziehungen &amp; Familienmitglieder',

	// Instant Messenger
	'IM_ONLINE'								 => 'Ich bin online',
	'IM_ONLINE_EXPLAIN'						 => 'Wenn aktiviert, sehen dich deine Freunde in der Online-Liste und k&ouml;nnen mit dir chatten.',
	'IM_ALLOW_SOUND'						 => 'Ton abspielen, wenn eine Nachricht empfangen wird',
	'IM_ALLOW_SOUND_EXPLAIN'				 => 'Diese Option aktiviert/deaktiviert den Ton beim Empfang einer neuen Nachricht.',

	'IM_HISTORY_PURGED_AT'					 => 'Der Instant-Messenger-Verlauf wurde am %1$s durch die Administration gel&ouml;scht',
	'IM_NO_HISTORY'							 => 'Du hast keine Instant-Messenger-Nachrichten',
	//'IM_HISTORY_WITH'						 => 'Verlauf mit',
	'IM_MSG_TOTAL'							 => '1 Nachricht',
	'IM_MSGS_TOTAL'							 => '%1$s Nachrichten',
	'IM_CONVERSATION_TOTAL'					 => '1 Konversation',
	'IM_CONVERSATIONS_TOTAL'				 => '%1$s Konversationen',
	'IM_SOUND_SELECT_NAME'					 => 'Ton ausw&auml;hlen',
	'EXPORT_IM_HISTORY'						 => 'Konversation mit %s exportieren',
	//'IM_HISTORY_SELECT_USER'				 => 'Benutzer ausw&auml;hlen',
	'IM_GROUP_UNDECIDED'					 => 'Keine Kategorie',

	// Friends approval
	'ADD_FRIEND'							 => 'Neuen Freund hinzuf&uuml;gen',
	'ACCEPT_FRIEND'							 => 'Freundschaftsanfrage akzeptieren',

	'SN_APPROVAL_FRIENDS'					 => 'Freundschaft best&auml;tigen',
	'SN_APPROVALS_FRIENDS_EXPLAIN'			 => 'Hier kannst du Freundschaftsanfragen von Benutzern best&auml;tigen.',

	'SN_APPROVE'							 => 'Annehmen',
	'SN_NO_APPROVE'							 => 'Ablehnen',
	'SN_REFUSE'								 => 'Abweisen',

	'SN_APPROVAL_REQUESTS'					 => 'Deine Anfragen',
	'SN_APPROVAL_REQUESTS_EXPLAIN'			 => 'Hier kannst du von dir gesendete Anfragen zur&uuml;ckziehen.',

	'SN_VIEW_PROFILE'						 => 'Profil anzeigen',

	'SN_CANCEL_REQUEST'						 => 'Anfrage abbrechen',

	'SN_REMOVE_FRIEND'						 => 'Freund entfernen',
	'SN_REMOVE_FRIENDS'						 => 'Deine Freunde',
	'SN_REMOVE_FRIENDS_EXPLAIN'				 => 'Hier siehst du alle deine Freunde und kannst sie von deiner Freundesliste entfernen.',

	'SN_USING_AVATARS_1_EXPLAIN'			 => 'Klicke auf Benutzer, um sie auszuw&auml;hlen, und best&auml;tige den Vorgang.',

	'FRIENDS_APPROVALS_SUCCESS'				 => ' wurde zu deiner Freundesliste hinzugef&uuml;gt',
	'FRIENDS_APPROVALS_REQUEST_EXIST'		 => 'Du hast bereits eine Anfrage gesendet an',
	'FRIENDS_APPROVALS_DENY'				 => 'Die Freundschaftsanfrage wurde abgebrochen',
	'FRIENDS_APPROVALS_REMOVE'				 => 'Der Freund wurde erfolgreich entfernt',
	'FRIENDS_APPROVALS_ADDED'				 => 'Die Freundschaftsanfrage wurde erfolgreich gesendet',

	'SN_FAS_FRIEND_LIST'					 => 'Freundesliste',
	'SN_FAS_COMMON_FRIEND_LIST'				 => 'Gemeinsame Freunde',
	'SN_FAS_REMOVE'							 => 'Freund entfernt',

	'FAS_FRIEND_TOTAL'						 => 'Ein Freund',
	'FAS_FRIENDS_TOTAL'						 => '%1$s Freunde',
	'FAS_FRIEND_NO_TOTAL'					 => 'Keine Freunde',
	'FAS_FRIENDGROUP_TOTAL'					 => 'Ein Freund',
	'FAS_FRIENDGROUPS_TOTAL'				 => '%1$s Freunde',
	'FAS_FRIENDGROUP_NO_TOTAL'				 => 'Keine Freunde',
	'FAS_APPROVE_TOTAL'						 => 'Eine Best&auml;tigung',
	'FAS_APPROVES_TOTAL'					 => '%1$s Best&auml;tigungen',
	'FAS_APPROVE_NO_TOTAL'					 => 'Keine Best&auml;tigungen',
	'FAS_CANCEL_TOTAL'						 => 'Eine Anfrage',
	'FAS_CANCELS_TOTAL'						 => '%1$s Anfragen',
	'FAS_CANCEL_NO_TOTAL'					 => 'Keine Anfragen',
	'FAS_COMMON_TOTAL'						 => 'Ein gemeinsamer Freund',
	'FAS_COMMONS_TOTAL'						 => '%1$s gemeinsame Freunde',
	'FAS_COMMON_NO_TOTAL'					 => 'Keine gemeinsamen Freunde',
	'FAS_MUTUAL_NO_TOTAL'					 => 'Keine gemeinsamen Freunde',
	'FAS_MUTUAL_TOTAL'						 => 'Ein gemeinsamer Freund',
	'FAS_MUTUALS_TOTAL'						 => '%1$s gemeinsame Freunde',
	'FAS_SUGGESTION_NO_TOTAL'				 => 'Keine Vorschl&auml;ge',
	'FAS_SUGGESTION_TOTAL'					 => 'Ein Vorschlag',
	'FAS_SUGGESTIONS_TOTAL'					 => '%1$s Vorschl&auml;ge',

	'SN_FAS_NOT_ADDED_FRIENDS_IN_APPROVAL'	 => 'Benutzer wurde bereits hinzugef&uuml;gt',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FOES'		 => 'Benutzer ist bereits auf der Ignorierliste',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FRIENDS'	 => 'Benutzer ist bereits dein Freund',

	// Friends groups
	'UFG_CREATE'							 => 'Neue Freundesgruppe erstellen',
	'UFG_NAME'								 => 'Name der Freundesgruppe',
	'UFG_CREATE_EXPLAIN'					 => 'Hier kannst du Freundesgruppen erstellen, um deine Freunde zu organisieren.',
	'UFG_MANAGE'							 => 'Freundesgruppen',
	'UFG_DRAG_FRIENDS_INTO_UFG'				 => 'Ziehe Benutzer per Drag &amp; Drop in die Freundesgruppe',
	'SN_CREATE_NEW_GROUP'					 => 'Neue Gruppe erstellen',
	//'CONFIRM_CREATE_UFG'					 => 'M&ouml;chtest du die Freundesgruppe <strong>%1$s</strong> wirklich erstellen?',
	'CONFIRM_DELETE_UFG'					 => 'M&ouml;chtest du die Freundesgruppe <strong>%1$s</strong> wirklich l&ouml;schen?',
	'FMS_DELETE_UFG'						 => 'Freundesgruppe l&ouml;schen',
	'FMS_DELETE_UFG_TEXT'					 => 'M&ouml;chtest du diese Freundesgruppe wirklich l&ouml;schen?',

	'ADD_FRIEND_TO_GROUP'					 => 'Freund zur Freundesgruppe hinzuf&uuml;gen',
	'ERROR_GROUP_EMPTY_NAME'				 => 'Gruppenname ist leer',
	'ERROR_GROUP_ALREADY_EXISTS'			 => 'Du hast diese Gruppe bereits erstellt',
));

// NTF MESSAGE TITLES FOR PMs
$lang = array_merge($lang, array(
	'SN_NTF_FRIENDSHIP_REQUEST_PM_TITLE'		=> '%1$s hat dir eine Freundschaftsanfrage gesendet',
	'SN_NTF_FRIENDSHIP_CANCEL_PM_TITLE'			=> '%1$s hat die Freundschaftsanfrage zur&uuml;ckgezogen',
	'SN_NTF_FRIENDSHIP_DENY_PM_TITLE'				=> '%1$s hat deine Freundschaftsanfrage abgelehnt',
	'SN_NTF_FRIENDSHIP_ACCEPT_PM_TITLE'			=> '%1$s hat deine Freundschaftsanfrage akzeptiert',

	'SN_NTF_STATUS_FRIEND_WALL_PM_TITLE'	 	=> '%1$s hat eine Nachricht auf deiner Profilseite hinterlassen',
	'SN_NTF_STATUS_USER_COMMENT_PM_TITLE'	 	=> '%1$s hat den Status von %2$s kommentiert',
	'SN_NTF_STATUS_AUTHOR_COMMENT_PM_TITLE'	=> '%1$s hat deinen Status kommentiert',

	'SN_NTF_APPROVE_FAMILY_PM_TITLE'				=> '%1$s hat dich als %2$s hinzugef&uuml;gt',
	'SN_NTF_APPROVE_RELATIONSHIP_PM_TITLE'	=> '%1$s hat eine Beziehung mit dir angegeben',

	'SN_NTF_EMOTE_PM_TITLE'					 				=> '%1$s hat dir ein Emote gesendet',

	'SN_NTF_RELATIONSHIP_APPROVED_PM_TITLE'	=> '%1$s hat die Beziehung mit dir best&auml;tigt',
	'SN_NTF_FAMILY_APPROVED_PM_TITLE'		 		=> '%1$s hat das Familienverh&auml;ltnis mit dir best&auml;tigt',

	'SN_NTF_RELATIONSHIP_REFUSED_PM_TITLE'	=> '%1$s hat die Beziehung mit dir abgelehnt',
	'SN_NTF_FAMILY_REFUSED_PM_TITLE'				=> '%1$s hat das Familienverh&auml;ltnis mit dir abgelehnt',

	'SN_NTF_STATUS_FRIEND_MENTION_PM_TITLE' => '%1$s hat dich im Status erw&auml;hnt',
));

// MCP
$lang = array_merge($lang, array(
	'MCP_SOCIALNET'					 => 'Social Network',
	'MCP_SN_REPORTUSER'				 => 'Gemeldete Benutzer',

	'POSTS_IN_QUEUE'				 => 'Wartende Beitr&auml;ge',

	'SN_UP_REPORTED_USER'			 => 'Gemeldeter Benutzer',
	'SN_UP_REPORT_TEXT'				 => 'Details',
	'SN_UP_REASON'					 => 'Grund',
	'SN_UP_VIEW_REPORTS'			 => 'Meldungen anzeigen',
	'SN_UP_CLOSE_REPORT_CONFIRM'	 => 'M&ouml;chtest du diese Meldung wirklich schlie&szlig;en?',
	'SN_UP_CLOSE_REPORTS_CONFIRM'	 => 'M&ouml;chtest du diese Meldungen wirklich schlie&szlig;en?',
	'SN_UP_CLOSE_REPORT_SUCCESS'	 => 'Meldung wurde erfolgreich geschlossen.',
	'SN_UP_CLOSE_REPORTS_SUCCESS'	 => 'Meldungen wurden erfolgreich geschlossen.',
	'SN_UP_DELETE_REPORT_CONFIRM'	 => 'M&ouml;chtest du diese Meldung wirklich l&ouml;schen?',
	'SN_UP_DELETE_REPORTS_CONFIRM'	 => 'M&ouml;chtest du diese Meldungen wirklich l&ouml;schen?',
	'SN_UP_DELETE_REPORT_SUCCESS'	 => 'Meldung wurde erfolgreich gel&ouml;scht.',
	'SN_UP_DELETE_REPORTS_SUCCESS'	 => 'Meldungen wurden erfolgreich gel&ouml;scht.',
));

// NOTIFY
$lang = array_merge($lang, array(
	'SN_AP_NOTIFY'					 => 'Benachrichtigungen',
	'SN_NO_NOTIFY'					 => 'Du hast keine Benachrichtigungen',
	'SN_NTF_FRIENDSHIP_ACCEPT'		 => '%1$s hat deine <a href="%2$s">Freundschaftsanfrage</a> akzeptiert',
	'SN_NTF_FRIENDSHIP_DENY'		 => '%1$s hat deine <a href="%2$s">Freundschaftsanfrage</a> abgelehnt',
	'SN_NTF_FRIENDSHIP_REQUEST'		 => '%1$s hat dir eine <a href="%2$s">Freundschaftsanfrage</a> gesendet',
	'SN_NTF_FRIENDSHIP_CANCEL'		 => '%1$s hat die <a href="%2$s">Freundschaftsanfrage</a> zur&uuml;ckgezogen',

	'SN_NTF_STATUS_AUTHOR_COMMENT'	 => '%1$s hat <a href="%2$s">deinen Status</a> kommentiert',
	'SN_NTF_STATUS_USER_COMMENT'		 => '%1$s hat den Status von <a href="%3$s">%2$s</a> kommentiert',
	'SN_NTF_STATUS_FRIEND_WALL'		 	=> '%1$s hat eine Nachricht auf <a href="%2$s">deiner Profilseite</a> hinterlassen',

	'SN_NTF_APPROVE_FAMILY'			 => '%1$s hat dich als %2$s hinzugef&uuml;gt. Du kannst <a href="%3$s">dieses Familienverh&auml;ltnis hier best&auml;tigen</a>',
	'SN_NTF_APPROVE_RELATIONSHIP'	 => '%1$s hat eine Beziehung mit dir angegeben. Du kannst <a href="%2$s">diese Beziehung hier best&auml;tigen</a>',

	'SN_NTF_EMOTE'					 => '%1$s hat dir ein Emote gesendet: %2$s %3$s',

	'SN_NTF_RELATIONSHIP_APPROVED'	 => '%1$s hat die <a href="%2$s">Beziehung</a> mit dir best&auml;tigt',
	'SN_NTF_FAMILY_APPROVED'		 => '%1$s hat das <a href="%2$s">Familienverh&auml;ltnis</a> mit dir best&auml;tigt',

	'SN_NTF_RELATIONSHIP_VICEVERSA'	 => '%1$s hat die <a href="%2$s">Beziehung</a> mit dir best&auml;tigt und zum eigenen Profil hinzugef&uuml;gt',
	'SN_NTF_FAMILY_VICEVERSA'		 => '%1$s hat das <a href="%2$s">Familienverh&auml;ltnis</a> mit dir best&auml;tigt und zum eigenen Profil hinzugef&uuml;gt',

	'SN_NTF_RELATIONSHIP_REFUSED'	 => '%1$s hat die <a href="%2$s">Beziehung</a> mit dir abgelehnt',
	'SN_NTF_FAMILY_REFUSED'			 => '%1$s hat das <a href="%2$s">Familienverh&auml;ltnis</a> mit dir abgelehnt',

	'SN_NTF_STATUS_FRIEND_MENTION' => '%1$s hat dich in <a href="%2$s">seinem Status</a> erw&auml;hnt',
));

// EMOTES
$lang = array_merge($lang, array(
	'SN_UP_EMOTES_USER'	 => 'Emotes',
));

// EXPANDER
$lang = array_merge($lang, array(
	'SN_EXPANDER_READ_MORE'	 => 'Mehr anzeigen',
	'SN_EXPANDER_READ_LESS'	 => 'Schlie&szlig;en',
));

// OUTDATED BROWSER
$lang = array_merge($lang, array(
	'BROWSER_OUTDATED_TITLE'	 => 'Dein Browser ist veraltet',
	'BROWSER_OUTDATED'	 => 'Einige Funktionen werden in deinem Browser nicht funktionieren. Wir empfehlen dringend, ihn zu aktualisieren.',

	// Missing variables
	'SN_UP_USER_FB'		=> 'Facebook',
	'SN_UP_USER_IG'		=> 'Instagram',
	'SN_UP_USER_PT'		=> 'Pinterest',
	'SN_UP_USER_TWR'	=> 'Twitter',
	'SN_UP_USER_SKP'	=> 'Skype',
	'SN_UP_USER_TG'		=> 'Telegram',
	'SN_UP_USER_LI'		=> 'LinkedIn',
	'SN_UP_USER_TT'		=> 'TikTok',
	'SN_UP_USER_DC'		=> 'Discord',
));
