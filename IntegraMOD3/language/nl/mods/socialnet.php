<?php
/**
 * - [Dutch]
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
	'SN_AP_WELCOME_TITLE'					 => 'Welkom op onze website!',
	'SN_AP_WELCOME_TEXT'					 => 'Registreer je gerust en maak gebruik van alle functies op onze website.<br /><br />Met vriendelijke groet,<br />de Beheerder',

	'SN_MODULE_IM_NAME'						 => 'Instant Messenger',
	'SN_MODULE_USERSTATUS_NAME'				 => 'Gebruikersstatus',
	'SN_MODULE_APPROVAL_NAME'				 => 'Vriendenbeheersysteem',

	'SN_IM_CHAT'							 => 'Chat',
	'SN_IM_NO_ONLINE_USER'					 => 'Er zijn geen gebruikers online',
	'SN_IM_YOU_ARE_OFFLINE'					 => 'Je bent offline',
	'SN_IM_SOUND'							 => 'Geluid',
	'SN_IM_SELECT_NAME'						 => 'Kies een geluid',
	'SN_IM_NEW_MESSAGE'						 => 'Nieuw bericht',
	'SN_IM_LOGIN'							 => 'Online',
	'SN_IM_LOGOUT'							 => 'Offline',
	'SN_IM_PRESS_TO_CLOSE'					 => 'Druk op %1$s om het chatvenster te sluiten',
	'SN_IM_PRESS_TO_SEND'					 => 'Druk op %1$s om het bericht te verzenden',

	'SN_US_SHARE_STATUS'					 => 'Delen',
	'SN_US_WHATS_ON_YOUR_MIND'				 => 'Wat ben je aan het doen?',
	'SN_US_EMPTY_STATUS'					 => 'Je kunt geen lege status plaatsen',
	'SN_US_COMMENT'							 => 'Reageren',
	'SN_US_EMPTY_COMMENT'					 => 'Je kunt geen lege reactie plaatsen',
	'SN_US_USER_STATUS_WALL'				 => 'Activiteit',
	'SN_US_WRITE_COMMENT'					 => 'Schrijf een reactie...',
	'SN_US_COMMENT_STATUS'					 => 'Reageren',
	'SN_US_HAS_NO_STATUS'					 => 'heeft geen status',
	'SN_US_HAS_DELETED_STATUS'				 => 'Deze status is verwijderd',
	'SN_STATUS_NOT_EXISTS'					 => 'Deze status bestaat niet',
	'SN_US_HAS_NO_ACTIVITY'					 => 'heeft geen activiteit',
	'SN_US_SHARED_STATUS'					 => 'Je hebt je status gedeeld',
	'SN_US_DELETE_STATUS'					 => 'Verwijderen',
	'SN_US_LOAD_MORE'						 => 'Oudere berichten',
	'SN_US_VIEW'						 	 => 'Bekijken',
	'SN_US_LOAD_MORE_COMMENT'				 => 'meer reactie',
	'SN_US_LOAD_MORE_COMMENTS'				 => 'meer reacties',
	'SN_US_CONFIRM'							 => 'Bevestigen',
	'SN_US_CLOSE'							 => 'Sluiten',
	'SN_US_CANCEL'							 => 'Annuleren',
	'SN_US_SHARED_A'						 => 'deelde een',
	'SN_US_LINK'							 => 'link',

	//
	// FETCH PAGE
	//
	'SN_US_FETCH_PAGE'						 => 'Pagina ophalen',
	'SN_US_FETCH_CLEAR'						 => 'Geladen pagina wissen',
	'SN_US_NO_VIDEO_THUMB'					 => 'Geen videovoorbeeld',
	'LOADER'								 => 'Lader',
	'NEXT_IMAGE'							 => 'Volgende afbeelding',
	'PREVIOUS_IMAGE'						 => 'Vorige afbeelding',
	'OF'									 => 'van',
	'SN_US_NO_IMG_THUMB'					 => 'Geen afbeeldingsvoorbeeld',
	'SN_US_CHOOSE_THUMB'					 => 'afbeeldingen',
	'SN_CB_FETCH_ERROR'						 => 'Er is een fout opgetreden bij het ophalen van de webpagina',

	'SN_AP_ACTIVITYPAGE'					 => 'Mijn netwerk',
	'SN_AP_AND'								 => 'en',
	'SN_AP_ARE_FRIENDS'						 => 'zijn nu vrienden',
	'SN_AP_ADD_AS_FRIEND'					 => 'Toevoegen als vriend',
	'SN_AP_PRIVATE_MESSAGE'					 => 'Berichten',
	'SN_AP_MANAGE_PROFILE'					 => 'Mijn profiel bewerken',
	'SN_AP_VIEW_FRIENDS'					 => 'Mijn vrienden bekijken',
	'SN_AP_VIEW_SUGGESTIONS'				 => 'Mensen die je misschien kent',
	'SN_AP_MANAGE_FRIENDS'					 => 'Vrienden beheren',
	'SN_AP_BOARD'							 => 'Forum',
	'SN_AP_VIEW_MEMBERLIST'					 => 'Ledenlijst bekijken',
	'SN_AP_LOG_OUT'							 => 'Uitloggen',
	'SN_AP_LAST_POSTS'						 => 'Recente discussies',
	'SN_AP_TOTAL_FRIEND'					 => 'Je hebt 1 vriend',
	'SN_AP_TOTAL_FRIENDS'					 => 'Je hebt %s vrienden',
	'SN_AP_FRIEND_SUGGESTIONS'				 => 'Mensen die je misschien kent',
	'SN_AP_REQUESTS_LIST'					 => 'Verzoeken',
	'SN_AP_ONLINE_FRIENDS'					 => 'Vrienden online',
	'SN_AP_NO_ONLINE_USER'					 => 'Geen gebruikers online',
	'SN_AP_NO_DISCUSSION'					 => 'Geen recente discussies',
	'SN_AP_NO_BIRTHDAY'					 	 => 'Er zijn binnenkort geen verjaardagen',
	'SN_AP_NO_ENTRY'						 => 'Hier is niets nieuws',
	'SN_AP_LOAD_NEWS'						 => 'Vernieuwen',
	'SN_AP_SEE_ALL'							 => 'Alles bekijken',
	'SN_AP_NO_FRIENDS'						 => 'Je hebt geen vrienden',
	'SN_AP_KEEP_LOGGEDIN'					 => 'Aangemeld blijven',
	'SN_AP_STATISTICS'						 => 'Statistieken',
	'SN_AP_TOTAL_USERS'						 => '<strong>%d</strong> leden',
	'SN_AP_TOTAL_POSTS'						 => '<strong>%d</strong> berichten',
	'SN_AP_TOTAL_TOPICS'					 => '<strong>%d</strong> onderwerpen',
	'SN_AP_TOPICS_PER_DAY'					 => '<strong>%d</strong> onderwerpen per dag',
	'SN_AP_POSTS_PER_DAY'					 => '<strong>%d</strong> berichten per dag',
	'SN_AP_USERS_PER_DAY'					 => '<strong>%d</strong> gebruikers per dag',
	'SN_AP_BIRTHDAY'						 => 'Verjaardag',
	'SN_AP_BIRTHDAY_1'						 => 'verjaardag <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_2'						 => 'verjaardag op <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_USERNAME'				 => 'van %1$s',
	'SN_AP_WELCOME'							 => 'Welkom',
	'SN_AP_VIEWING_ACTIVITYPAGE'			 => 'Bekijkt activiteitspagina',
	'SN_AP_NO_SUGGESTIONS'					 => 'Er zijn momenteel geen vriendschapssuggesties voor jou',
	'SN_AP_SEARCH'							 => 'Zoeken…',
	'SN_AP_CHANGED_PROFILE_HIS'				 => 'heeft zijn profiel bijgewerkt',
	'SN_AP_CHANGED_PROFILE_HER'				 => 'heeft haar profiel bijgewerkt',
	'SN_AP_CHANGED_PROFILE_THEIR'			 => 'heeft hun profiel bijgewerkt',
	'SN_UP_CHANGED_AVATAR_HIS'				 => 'heeft zijn avatar gewijzigd',
	'SN_UP_CHANGED_AVATAR_HER'				 => 'heeft haar avatar gewijzigd',
	'SN_UP_CHANGED_AVATAR_THEIR'			 => 'heeft hun avatar gewijzigd',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HIS'		 => 'heeft %1$s (%2$s) als nieuw familielid toegevoegd aan zijn profiel',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HER'		 => 'heeft %1$s (%2$s) als nieuw familielid toegevoegd aan haar profiel',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_THEIR'	 => 'heeft %1$s (%2$s) als nieuw familielid toegevoegd aan hun profiel',
	'SN_AP_CHANGED_RELATIONSHIP_HIS'		 => 'heeft een nieuwe relatie toegevoegd aan zijn profiel',
	'SN_AP_CHANGED_RELATIONSHIP_HER'		 => 'heeft een nieuwe relatie toegevoegd aan haar profiel',
	'SN_AP_CHANGED_RELATIONSHIP_THEIR'		 => 'heeft een nieuwe relatie toegevoegd aan hun profiel',
	'SN_UP_SEND_EMOTE'						 => 'heeft een emote gestuurd naar',

	'SN_PROFILE'							 => 'Profiel',
	'SN_MYPROFILE'							 => 'Mijn profiel',

	// User profile
	'SN_UP_PROFILE_UPDATED'					 => 'Je profiel is succesvol bijgewerkt.',
	'SN_UP_HOMETOWN'						 => 'Woonplaats',
	'SN_UP_SEX'								 => 'Geslacht',
	'SN_UP_INTERESTED_IN'					 => 'Ge&iuml;nteresseerd in',
	'SN_UP_PRIVACY_LEVEL'					 => 'Privacyniveau',
	'SN_UP_PRIVACY_PRIVATE'					 => 'Privé (alleen beheerders)',
	'SN_UP_PRIVACY_FRIENDS'					 => 'Alleen vrienden',
	'SN_UP_PRIVACY_DEFAULT'					 => 'Standaard (iedereen)',
	'SN_UP_ALLOW_FRIEND_REQUESTS'			 => 'Leden toestaan mij vriendschapsverzoeken te sturen',
	'SN_UP_PRIVACY_LOCKED'					 => 'De forumbeheerder staat leden niet toe hun privacybeleid te wijzigen.',
	'SN_UP_PRIVACY_DEFAULT_NOTICE'			 => 'Het standaard privacybeleid van het forum is: <strong>%s</strong>.',
	'SN_UP_LANGUAGES'						 => 'Talen',
	'SN_UP_ABOUT_ME'						 => 'Over mij',
	'SN_UP_EMPLOYER'						 => 'Werkgever',
	'SN_UP_UNIVERSITY'						 => 'Universiteit',
	'SN_UP_HIGH_SCHOOL'						 => 'Middelbare school',
	'SN_UP_OCCUPATION'						 => 'Beroep',
	'SN_UP_RELIGION'						 => 'Religie',
	'SN_UP_POLITICAL_VIEWS'					 => 'Politieke overtuiging',
	'SN_UP_QUOTATIONS'						 => 'Favoriete citaten',
	'SN_UP_INTERESTS'						 => 'Interesses',
	'SN_UP_MUSIC'							 => 'Muziek',
	'SN_UP_BOOKS'							 => 'Boeken',
	'SN_UP_MOVIES'							 => 'Films',
	'SN_UP_GAMES'							 => 'Spellen',
	'SN_UP_FOODS'							 => 'Eten',
	'SN_UP_SPORTS'							 => 'Sporten die je beoefent',
	'SN_UP_SPORT_TEAMS'						 => 'Favoriete sportteams',
	'SN_UP_ACTIVITIES'						 => 'Activiteiten',
	'SN_UP_SKYPE'							 => 'Skype',
	'SN_UP_FACEBOOK'						 => 'Facebook',
	'SN_UP_TWITTER'							 => 'Twitter',
	'SN_UP_YOUTUBE'							 => 'Youtube',
	'SN_UP_USER_ICQ'						 => 'ICQ-nummer',
	'SN_UP_USER_AIM'						 => 'AOL Instant Messenger',
	'SN_UP_USER_MSNM'						 => 'WL/MSN Messenger',
	'SN_UP_USER_YIM'						 => 'Yahoo Messenger',
	'SN_UP_USER_JABBER'						 => 'Jabber-adres',
	'SN_UP_USER_WEBSITE'					 => 'Website',
	'SN_UP_USER_FROM'						 => 'Locatie',
	'SN_UP_USER_INTERESTS'					 => 'Interesses',
	'SN_UP_BDAY_MONTH'						 => 'Geboortemaand',
	'SN_UP_BDAY_DAY'						 => 'Geboortedag',
	'SN_UP_BDAY_YEAR'						 => 'Geboortejaar',
	'SN_UP_USERNAME'						 => 'Gebruikersnaam',
	'SN_UP_USER_EMAIL'						 => 'E-mailadres',
	'SN_UP_USER_BIRTHDAY'					 => 'Verjaardag',
	'SN_UP_USER_OCC'						 => 'Beroep',
	'SN_UP_USER_SIG'						 => 'Onderschrift',
	'SN_UP_PROFILE_VIEWS'					 => 'Profielweergaven',
	'SN_UP_X_TIMES'							 => 'x',
	'SN_UP_PROFILE_VISITORS'				 => 'Profielbezoekers',
	'SN_UP_LAST_CHANGE'						 => 'Laatste profielwijziging',
	'SN_UP_MALE'							 => 'Man',
	'SN_UP_MALES'							 => 'Mannen',
	'SN_UP_FEMALE'							 => 'Vrouw',
	'SN_UP_FEMALES'							 => 'Vrouwen',
	'SN_UP_BOTH'							 => 'Beide',
	'SN_UP_RELATIONSHIP'					 => 'Relatiestatus',
	'SN_UP_SINGLE'							 => 'Vrijgezel',
	'SN_UP_IN_RELATIONSHIP'					 => 'Heeft een relatie',
	'SN_UP_ENGAGED'							 => 'Verloofd',
	'SN_UP_MARRIED'							 => 'Getrouwd',
	'SN_UP_ITS_COMPLICATED'					 => 'Het is ingewikkeld',
	'SN_UP_OPEN_RELATIONSHIP'				 => 'Heeft een open relatie',
	'SN_UP_WIDOWED'							 => 'Weduwe/Weduwnaar',
	'SN_UP_SEPARATED'						 => 'Gescheiden van tafel en bed',
	'SN_UP_DIVORCED'						 => 'Gescheiden',
	'SN_UP_TO'								 => 'met',
	'SN_UP_WITH'							 => 'met',
	'SN_UP_ANNIVERSARY'						 => 'Jubileum',
	'SN_UP_ANNIVERSARY_ON'					 => 'Jubileum op',
	'SN_UP_BIRTHDAY'						 => 'Geboortedatum',
	'SN_UP_SUNDAY'							 => 'Zondag',
	'SN_UP_MONDAY'							 => 'Maandag',
	'SN_UP_TUESDAY'							 => 'Dinsdag',
	'SN_UP_WEDNESDAY'						 => 'Woensdag',
	'SN_UP_THURSDAY'						 => 'Donderdag',
	'SN_UP_FRIDAY'							 => 'Vrijdag',
	'SN_UP_SATURDAY'						 => 'Zaterdag',
	'SN_UP_SUNDAY_MIN'						 => 'Zo',
	'SN_UP_MONDAY_MIN'						 => 'Ma',
	'SN_UP_TUESDAY_MIN'						 => 'Di',
	'SN_UP_WEDNESDAY_MIN'					 => 'Wo',
	'SN_UP_THURSDAY_MIN'					 => 'Do',
	'SN_UP_FRIDAY_MIN'						 => 'Vr',
	'SN_UP_SATURDAY_MIN'					 => 'Za',
	'SN_UP_JANUARY_MIN'						 => 'Jan',
	'SN_UP_FEBRUARY_MIN'					 => 'Feb',
	'SN_UP_MARCH_MIN'						 => 'Mrt',
	'SN_UP_APRIL_MIN'						 => 'Apr',
	'SN_UP_MAY_MIN'							 => 'Mei',
	'SN_UP_JUNE_MIN'						 => 'Jun',
	'SN_UP_JULY_MIN'						 => 'Jul',
	'SN_UP_AUGUST_MIN'						 => 'Aug',
	'SN_UP_SEPTEMBER_MIN'					 => 'Sep',
	'SN_UP_OCTOBER_MIN'						 => 'Okt',
	'SN_UP_NOVEMBER_MIN'					 => 'Nov',
	'SN_UP_DECEMBER_MIN'					 => 'Dec',
	'SN_UP_FAMILY'							 => 'Familie',
	'SN_UP_SELECT_RELATIONSHIP'				 => 'Relatie toevoegen',
	'SN_UP_SELECT_FAMILY_RELATION'			 => 'Familielid toevoegen',
	'SN_UP_SISTER'							 => 'Zus',
	'SN_UP_BROTHER'							 => 'Broer',
	'SN_UP_DAUGHTER'						 => 'Dochter',
	'SN_UP_SON'								 => 'Zoon',
	'SN_UP_MOTHER'							 => 'Moeder',
	'SN_UP_FATHER'							 => 'Vader',
	'SN_UP_AUNT'							 => 'Tante',
	'SN_UP_UNCLE'							 => 'Oom',
	'SN_UP_NIECE'							 => 'Nichtje',
	'SN_UP_NEPHEW'							 => 'Neefje',
	'SN_UP_COUSIN_FEMALE'					 => 'Nicht',
	'SN_UP_COUSIN_MALE'						 => 'Neef',
	'SN_UP_GRANDDAUGHTER'					 => 'Kleindochter',
	'SN_UP_GRANDSON'						 => 'Kleinzoon',
	'SN_UP_GRANDMOTHER'						 => 'Grootmoeder',
	'SN_UP_GRANDFATHER'						 => 'Grootvader',
	'SN_UP_SISTER_IN_LAW'					 => 'Schoonzus',
	'SN_UP_BROTHER_IN_LAW'					 => 'Zwager',
	'SN_UP_MOTHER_IN_LAW'					 => 'Schoonmoeder',
	'SN_UP_FATHER_IN_LAW'					 => 'Schoonvader',
	'SN_UP_DAUGHTER_IN_LAW'					 => 'Schoondochter',
	'SN_UP_SON_IN_LAW'						 => 'Schoonzoon',
	'SN_UP_ADD_FAMILY_MEMBER'				 => 'Familielid toevoegen',
	'SN_UP_ADD_FAMILY_ERR_MEMBER_EMPTY'		 => 'Lege familielidnaam',
	'SN_UP_APPROVE'							 => 'Goedkeuren',
	'SN_UP_IGNORE'							 => 'Negeren',
	'SN_UP_APPROVE_RELATION_SUBJECT'		 => '%1$s heeft een relatie met jou aangegeven',
	'SN_UP_APPROVE_RELATION_TEXT'			 => '%2$s heeft de volgende relatie met jou aangegeven: <strong>%3$s %2$s</strong>.<br /><br />%1$sJe kunt deze relatie hier goedkeuren%4$s',
	'SN_UP_APPROVE_RELATION_CONFIRM'		 => 'Weet je zeker dat je deze relatie wilt goedkeuren?',
	'SN_UP_REFUSE_RELATION_CONFIRM'			 => 'Weet je zeker dat je deze relatie wilt weigeren?',
	'SN_UP_APPROVE_RELATION_ERROR_CANCELED'	 => 'Deze relatie is geannuleerd',
	'SN_UP_APPROVE_RELATION_ERROR_MYSELF'	 => 'Je kunt geen relatie met jezelf aanmaken',
	'SN_UP_APPROVE_RELATION_ERROR_APPROVED'	 => 'Deze relatie is al goedgekeurd',
	'SN_UP_APPROVE_RELATION_ERROR_REFUSED'	 => 'Deze relatie is al geweigerd',
	'SN_UP_APPROVE_RELATION_VICE_VERSA'		 => 'Ik wil deze relatie ook toevoegen aan mijn profiel.',
	'SN_UP_DELETE_RELATIONSHIP_CONFIRM'		 => 'Weet je zeker dat je deze relatie wilt verwijderen?',
	'SN_UP_APPROVE_RELATION_NO_RELATIONSHIP' => 'Geen relatiestatus',
	'SN_UP_APPROVE_FAMILY_SUBJECT'			 => '%1$s heeft je toegevoegd als %2$s',
	'SN_UP_APPROVE_FAMILY_TEXT'				 => '%2$s heeft je toegevoegd als <strong>%3$s</strong>.<br /><br />%1$sJe kunt deze relatie hier goedkeuren%4$s',
	'SN_UP_APPROVE_FAMILY_CONFIRM'			 => 'Weet je zeker dat je deze familierelatie wilt goedkeuren?',
	'SN_UP_REFUSE_FAMILY_CONFIRM'			 => 'Weet je zeker dat je deze familierelatie wilt weigeren?',
	'SN_UP_APPROVE_FAMILY_ERROR_CANCELED'	 => 'Deze familierelatie is geannuleerd',
	'SN_UP_APPROVE_FAMILY_ERROR_MYSELF'		 => 'Je kunt jezelf niet toevoegen als familielid',
	'SN_UP_APPROVE_FAMILY_ERROR_APPROVED'	 => 'Deze familierelatie is al goedgekeurd.',
	'SN_UP_APPROVE_FAMILY_ERROR_REFUSED'	 => 'Deze familierelatie is al geweigerd.',
	'SN_UP_APPROVE_FAMILY_ERROR_EXIST'		 => '%1$s is al toegevoegd aan je familie',
	'SN_UP_APPROVE_FAMILY_VICE_VERSA'		 => 'Ik wil %1$s ook toevoegen aan mijn familieleden.',
	'SN_UP_APPROVE_FAMILY_USERNAME'			 => '%1$s is mijn',
	'SN_UP_APPROVE_NO_FAMILY_MEMBER'		 => 'Geen familielid',
	'SN_UP_DELETE_FAMILY_CONFIRM'			 => 'Weet je zeker dat je <strong>%1$s</strong> wilt verwijderen uit je familieleden?',
	'SN_UP_USERNAME_NOT_EXIST'				 => 'Deze ingevoerde gebruikersnaam bestaat niet',
	'SN_UP_NOT_APPROVED'					 => 'nog niet goedgekeurd',
	'SN_UP_RELATION_REFUSED'				 => 'geweigerd',
	'SN_UP_RELATION_REQUESTS'				 => 'Verzoeken',
	'SN_UP_APPROVE_REQUESTS'				 => 'Relatie goedkeuren',
	'WRONG_DATA_FACEBOOK'					 => 'Het Facebook-adres moet een geldige URL zijn, inclusief het http-protocol. Bijvoorbeeld http://www.facebook.com/<gebruikersnaam>/',
	'WRONG_DATA_TWITTER'					 => 'Het Twitter-adres moet een geldige URL zijn, inclusief het http-protocol. Bijvoorbeeld http://twitter.com/<gebruikersnaam>/',
	'WRONG_DATA_YOUTUBE'					 => 'Het Youtube-adres moet een geldige URL zijn, inclusief het http-protocol. Bijvoorbeeld http://www.youtube.com/user/<gebruikersnaam>/',
	'WRONG_DATA_FAMILY_USER'				 => 'Een van de ingevoerde familienamen bestaat niet',
	'WRONG_DATA_RELATION_USER'				 => 'De ingevoerde relatie-gebruikersnaam bestaat niet',
	'WRONG_DATA_ANNIVERSARY'				 => 'Het jubileum moet een geldige datum zijn in de vorm dd-mm-jjjj. Bijvoorbeeld 01-12-2011',
	'TOO_SHORT_FACEBOOK'					 => 'Het ingevoerde Facebook-adres is te kort, minimaal 12 tekens vereist.',
	'TOO_SHORT_TWITTER'						 => 'Het ingevoerde Twitter-adres is te kort, minimaal 12 tekens vereist.',
	'TOO_SHORT_YOUTUBE'						 => 'Het ingevoerde Youtube-adres is te kort, minimaal 12 tekens vereist.',
	'TOO_SHORT_ANNIVERSARY'					 => 'Het ingevoerde jubileum is te kort, minimaal 8 tekens vereist.',
	'TOO_SHORT_SKYPE'						 => 'De ingevoerde Skype-naam is te kort, minimaal 6 tekens vereist.',
	'SN_UP_WALL'							 => 'Activiteit',
	'SN_UP_INFO'							 => 'Info',
	'SN_UP_FRIENDS'							 => 'Vrienden',
	'SN_UP_STATS'							 => 'Statistieken',
	'SN_UP_BASIC_INFO'						 => 'Basisinfo',
	'SN_UP_EDU_WORK'						 => 'Opleiding en Werk',
	'SN_UP_PHILOSOPHY'						 => 'Levensvisie',
	'SN_UP_ENT_ACT'							 => 'Vermaak en Activiteiten',
	'SN_UP_CONTACT_INFO'					 => 'Contactgegevens',
	'SN_UP_OTHER_INFO'						 => 'Overige info',
	'SN_UP_LAST_VISITORS'					 => 'Laatste profielbezoekers',
	'SN_UP_PROFILE_VIEWED'					 => 'Profiel bekeken',
	'SN_UP_ADD_FRIEND'						 => 'Vriend toevoegen',
	'SN_UP_ADD_FRIEND_TO_GROUP'				 => 'Aan groep toevoegen',
	'SN_UP_EDIT_PROFILE'					 => 'Profiel bewerken',
	'SN_UP_EDIT_FRIENDS'					 => 'Vrienden beheren',
	'SN_UP_EDIT_RELATIONS'					 => 'Relaties beheren',
	'SN_UP_REPORT_PROFILE'					 => 'Gebruiker rapporteren',
	'SN_UP_EMPTY_REPORT'					 => 'Je moet een reden voor de rapportage kiezen',
	'SN_UP_REPORT_SUCCESS'					 => 'Gebruiker is succesvol gerapporteerd',
	'SN_UP_CAN_LEAVE_BLANK'					 => 'Dit kan leeg gelaten worden.',
	'SN_UP_MORE_INFO'						 => 'Meer informatie',
	'SN_UP_RETURN_TO_PROFILE'				 => '%1$sTerug naar profiel%2$s',
	'SN_UP_TABS_SPINNER'					 => '<em>Laden&#8230;<\/em>',
	'SN_UP_EMOTES'							 => 'Emote versturen',

	'SN_LIKED_POSTS'						 => 'Ontvangen likes',
	'SN_SEARCH_LIKED_POSTS'					 => 'Door de gebruiker gelikete berichten zoeken',
	'SN_LIKES_SENT'         				 => 'Verzonden likes',
	'SN_SEARCH_LIKES_SENT'  				 => 'Berichten zoeken die je leuk vond',
	'SN_UP_PROFILE_VALUE_DELETED'			 => '<em>Verwijderd</em>',

	'SN_NTF_EMOTE_CB_TITLE'					 => 'Emote verzonden',
	'SN_NTF_EMOTE_CB_TEXT'					 => 'Emote %2$s %3$s is succesvol verzonden naar %1$s',

	'SN_IN'									 => 'in',

	'AVATAR'								 => 'Avatar',

	'FOES'									 => 'Vijanden',
	'MUTUAL'								 => 'Gemeenschappelijke vrienden',
	'SUGGESTIONS'							 => 'Suggesties',

	// This patterns are used for various date labels.
	// Each language should have convention how to display dates,
	// this is where you specify it for each user browsing the labels in
	// this language.
	'SN_DAY_MONTH_YEAR_PATTERN'				 => 'j F Y',
	'SN_DAY_MONTH_PATTERN'						 => 'j F',
	'SN_MONTH_YEAR_PATTERN'					 => 'F Y',
	'SN_YEAR_PATTERN'							 => 'Y',

	/**
	 * CONFIRM BOXES
	 */
	'SN_CB_DELETE_STATUS_TITLE'				 => 'Status verwijderen',
	'SN_CB_DELETE_STATUS_TEXT'				 => 'Weet je zeker dat je deze status wilt verwijderen?',
	'SN_CB_DELETE_COMMENT_TITLE'			 => 'Reactie verwijderen',
	'SN_CB_DELETE_COMMENT_TEXT'				 => 'Weet je zeker dat je deze reactie wilt verwijderen?',
	'SN_CB_DELETE_ACTIVITY_TITLE'			 => 'Activiteit verwijderen',
	'SN_CB_DELETE_ACTIVITY_TEXT'			 => 'Weet je zeker dat je deze activiteit wilt verwijderen?',

	/**
	 * SOCIALNET TIME AGO
	 */
	'SN_TIME_AGO'							 => '%1$u %2$s geleden',
	'SN_TIME_FROM_NOW'						 => '%1$u %2$s vanaf nu',
	'SN_TIME_PERIODS'						 => array(
		'SECOND'	 => 'seconde',
		'SECONDS'	 => 'seconden',
		'MINUTE'	 => 'minuut',
		'MINUTES'	 => 'minuten',
		'HOUR'		 => 'uur',
		'HOURS'		 => 'uur',
		'DAY'		 => 'dag',
		'DAYS'		 => 'dagen',
		'WEEK'		 => 'week',
		'WEEKS'		 => 'weken',
		'MONTH'		 => 'maand',
		'MONTHS'	 => 'maanden',
		'YEAR'		 => 'jaar',
		'YEARS'		 => 'jaar',
		'DECADE'	 => 'decennium',
		'DECADES'	 => 'decennia',
	)
));

// UCP
$lang = array_merge($lang, array(
	// UCP
	'UCP_SOCIALNET'							 => 'Sociaal Netwerk',
	'UCP_SOCIALNET_SETTINGS'				 => 'Instellingen sociaal netwerk',
	'UCP_SN_IM'								 => 'Instellingen Instant Messenger',
	'UCP_SN_IM_SETTINGS'					 => 'Instellingen Instant Messenger',
	'UCP_SN_IM_HISTORY'						 => 'Geschiedenis Instant Messenger',
	'UCP_SN_APPROVAL_UFG'					 => 'Vriendengroepen',
	'UCP_SOCIALNET_IM_PURGE_MESSAGES'		 => 'Instant Messenger-berichten wissen',
	'UCP_SOCIALNET_USERSTATUS'				 => 'Instellingen gebruikersstatus',
	'UCP_SN_PROFILE'						 => 'Persoonlijke info bewerken',
	'UCP_SN_PROFILE_RELATIONS'				 => 'Relaties &amp; Familierelaties',

	// Instant Messenger
	'IM_ONLINE'								 => 'Ik ben Online',
	'IM_ONLINE_EXPLAIN'						 => 'Indien ingeschakeld, zien vrienden je in de onlinelijst en kunnen ze met je chatten.',
	'IM_ALLOW_SOUND'						 => 'Geluid afspelen bij ontvangst van een bericht',
	'IM_ALLOW_SOUND_EXPLAIN'				 => 'Deze optie schakelt geluid in/uit bij het ontvangen van een nieuw bericht',

	'IM_HISTORY_PURGED_AT'					 => 'Instant Messenger-geschiedenis is gewist door de beheerder op %1$s',
	'IM_NO_HISTORY'							 => 'Je hebt geen chatberichten',
	//'IM_HISTORY_WITH'						 => 'Geschiedenis met',
	'IM_MSG_TOTAL'							 => '1 bericht',
	'IM_MSGS_TOTAL'							 => '%1$s berichten',
	'IM_CONVERSATION_TOTAL'					 => '1 gesprek',
	'IM_CONVERSATIONS_TOTAL'				 => '%1$s gesprekken',
	'IM_SOUND_SELECT_NAME'					 => 'Geluid selecteren',
	'EXPORT_IM_HISTORY'						 => 'Gesprek met %s exporteren',
	//'IM_HISTORY_SELECT_USER'				 => 'Gebruiker selecteren',
	'IM_GROUP_UNDECIDED'					 => 'Geen categorie',

	// Friends approval
	'ADD_FRIEND'							 => 'Nieuwe vriend toevoegen',
	'ACCEPT_FRIEND'							 => 'Vriendschapsverzoek accepteren',

	'SN_APPROVAL_FRIENDS'					 => 'Vriendschap goedkeuren',
	'SN_APPROVALS_FRIENDS_EXPLAIN'			 => 'Hier kun je gebruikers goedkeuren die een verzoek hebben gestuurd om je vriend te worden.',

	'SN_APPROVE'							 => 'Accepteren',
	'SN_NO_APPROVE'							 => 'Weigeren',
	'SN_REFUSE'								 => 'Afwijzen',

	'SN_APPROVAL_REQUESTS'					 => 'Jouw verzoeken',
	'SN_APPROVAL_REQUESTS_EXPLAIN'			 => 'Hier kun je verzoeken annuleren die je hebt verzonden.',

	'SN_VIEW_PROFILE'						 => 'Profiel bekijken',

	'SN_CANCEL_REQUEST'						 => 'Verzoek annuleren',

	'SN_REMOVE_FRIEND'						 => 'Vriend verwijderen',
	'SN_REMOVE_FRIENDS'						 => 'Je vrienden',
	'SN_REMOVE_FRIENDS_EXPLAIN'				 => 'Hier kun je al je vrienden zien en hen uit je vriendenlijst verwijderen',

	'SN_USING_AVATARS_1_EXPLAIN'			 => 'Klik op gebruikers om ze te selecteren en bevestig vervolgens de bewerking',

	'FRIENDS_APPROVALS_SUCCESS'				 => ' is toegevoegd aan je vriendenlijst',
	'FRIENDS_APPROVALS_REQUEST_EXIST'		 => 'Je hebt al een verzoek gestuurd naar',
	'FRIENDS_APPROVALS_DENY'				 => 'Het vriendschapsverzoek is geannuleerd',
	'FRIENDS_APPROVALS_REMOVE'				 => 'De vriend is succesvol verwijderd',
	'FRIENDS_APPROVALS_ADDED'				 => 'Het vriendschapsverzoek is succesvol verzonden',

	'SN_FAS_FRIEND_LIST'					 => 'Vriendenlijst',
	'SN_FAS_COMMON_FRIEND_LIST'				 => 'Gemeenschappelijke vrienden',
	'SN_FAS_REMOVE'							 => 'Vriend verwijderd',

	'FAS_FRIEND_TOTAL'						 => 'E&eacute;n vriend',
	'FAS_FRIENDS_TOTAL'						 => '%1$s vrienden',
	'FAS_FRIEND_NO_TOTAL'					 => 'Geen vrienden',
	'FAS_FRIENDGROUP_TOTAL'					 => 'E&eacute;n vriend',
	'FAS_FRIENDGROUPS_TOTAL'				 => '%1$s vrienden',
	'FAS_FRIENDGROUP_NO_TOTAL'				 => 'Geen vrienden',
	'FAS_APPROVE_TOTAL'						 => 'E&eacute;n goedkeuring',
	'FAS_APPROVES_TOTAL'					 => '%1$s goedkeuringen',
	'FAS_APPROVE_NO_TOTAL'					 => 'Geen goedkeuringen',
	'FAS_CANCEL_TOTAL'						 => 'E&eacute;n verzoek',
	'FAS_CANCELS_TOTAL'						 => '%1$s verzoeken',
	'FAS_CANCEL_NO_TOTAL'					 => 'Geen verzoeken',
	'FAS_COMMON_TOTAL'						 => 'E&eacute;n gemeenschappelijke vriend',
	'FAS_COMMONS_TOTAL'						 => '%1$s gemeenschappelijke vrienden',
	'FAS_COMMON_NO_TOTAL'					 => 'Geen gemeenschappelijke vriend',
	'FAS_MUTUAL_NO_TOTAL'					 => 'Geen gemeenschappelijke vriend',
	'FAS_MUTUAL_TOTAL'						 => 'E&eacute;n gemeenschappelijke vriend',
	'FAS_MUTUALS_TOTAL'						 => '%1$s gemeenschappelijke vrienden',
	'FAS_SUGGESTION_NO_TOTAL'				 => 'Geen suggestie',
	'FAS_SUGGESTION_TOTAL'					 => 'E&eacute;n suggestie',
	'FAS_SUGGESTIONS_TOTAL'					 => '%1$s suggesties',

	'SN_FAS_NOT_ADDED_FRIENDS_IN_APPROVAL'	 => 'Gebruiker is al toegevoegd',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FOES'		 => 'Gebruiker is al een vijand',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FRIENDS'	 => 'Gebruiker is al een vriend',

	// Friends groups
	'UFG_CREATE'							 => 'Een nieuwe vriendengroep aanmaken',
	'UFG_NAME'								 => 'Naam van vriendengroep',
	'UFG_CREATE_EXPLAIN'					 => 'Hier kun je een vriendengroep aanmaken om je vrienden in groepen in te delen.',
	'UFG_MANAGE'							 => 'Vriendengroepen',
	'UFG_DRAG_FRIENDS_INTO_UFG'				 => 'Sleep gebruikers naar de vriendengroep',
	'SN_CREATE_NEW_GROUP'					 => 'Nieuwe groep aanmaken',
	//'CONFIRM_CREATE_UFG'					 => 'Weet je zeker dat je de vriendengroep <strong>%1$s</strong> wilt aanmaken?',
	'CONFIRM_DELETE_UFG'					 => 'Weet je zeker dat je de vriendengroep <strong>%1$s</strong> wilt verwijderen?',
	'FMS_DELETE_UFG'						 => 'Vriendengroep verwijderen',
	'FMS_DELETE_UFG_TEXT'					 => 'Weet je zeker dat je deze vriendengroep wilt verwijderen?',

	'ADD_FRIEND_TO_GROUP'					 => 'Vriend toevoegen aan vriendengroep',
	'ERROR_GROUP_EMPTY_NAME'				 => 'Lege groepsnaam',
	'ERROR_GROUP_ALREADY_EXISTS'			 => 'Je hebt deze groep al aangemaakt',
));

// NTF MESSAGE TITLES FOR PMs
$lang = array_merge($lang, array(
	'SN_NTF_FRIENDSHIP_REQUEST_PM_TITLE'		=> '%1$s heeft je een vriendschapsverzoek gestuurd',
	'SN_NTF_FRIENDSHIP_CANCEL_PM_TITLE'			=> '%1$s heeft je vriendschapsverzoek geannuleerd',
	'SN_NTF_FRIENDSHIP_DENY_PM_TITLE'				=> '%1$s heeft je vriendschapsverzoek geweigerd',
	'SN_NTF_FRIENDSHIP_ACCEPT_PM_TITLE'			=> '%1$s heeft je vriendschapsverzoek geaccepteerd',

	'SN_NTF_STATUS_FRIEND_WALL_PM_TITLE'	 	=> '%1$s heeft een bericht achtergelaten op je profiel',
	'SN_NTF_STATUS_USER_COMMENT_PM_TITLE'	 	=> '%1$s heeft gereageerd op de status van %2$s',
	'SN_NTF_STATUS_AUTHOR_COMMENT_PM_TITLE'	=> '%1$s heeft gereageerd op jouw status',

	'SN_NTF_APPROVE_FAMILY_PM_TITLE'				=> '%1$s heeft je toegevoegd als %2$s',
	'SN_NTF_APPROVE_RELATIONSHIP_PM_TITLE'	=> '%1$s heeft een relatie met jou aangegeven',

	'SN_NTF_EMOTE_PM_TITLE'					 				=> '%1$s heeft je een emote gestuurd',

	'SN_NTF_RELATIONSHIP_APPROVED_PM_TITLE'	=> '%1$s heeft een relatie met jou bevestigd',
	'SN_NTF_FAMILY_APPROVED_PM_TITLE'		 		=> '%1$s heeft een familierelatie met jou bevestigd',

	'SN_NTF_RELATIONSHIP_REFUSED_PM_TITLE'	=> '%1$s heeft een relatie met jou geweigerd',
	'SN_NTF_FAMILY_REFUSED_PM_TITLE'				=> '%1$s heeft een familierelatie met jou geweigerd',

	'SN_NTF_STATUS_FRIEND_MENTION_PM_TITLE' => '%1$s heeft je genoemd in zijn status',
));

// MCP
$lang = array_merge($lang, array(
	'MCP_SOCIALNET'					 => 'Sociaal Netwerk',
	'MCP_SN_REPORTUSER'				 => 'Gerapporteerde gebruikers',

	'POSTS_IN_QUEUE'				 => 'Berichten in wachtrij',

	'SN_UP_REPORTED_USER'			 => 'Gerapporteerde gebruiker',
	'SN_UP_REPORT_TEXT'				 => 'Details',
	'SN_UP_REASON'					 => 'Reden',
	'SN_UP_VIEW_REPORTS'			 => 'Rapporten bekijken',
	'SN_UP_CLOSE_REPORT_CONFIRM'	 => 'Weet je zeker dat je dit rapport wilt sluiten?',
	'SN_UP_CLOSE_REPORTS_CONFIRM'	 => 'Weet je zeker dat je deze rapporten wilt sluiten?',
	'SN_UP_CLOSE_REPORT_SUCCESS'	 => 'Rapport is succesvol gesloten.',
	'SN_UP_CLOSE_REPORTS_SUCCESS'	 => 'Rapporten zijn succesvol gesloten.',
	'SN_UP_DELETE_REPORT_CONFIRM'	 => 'Weet je zeker dat je dit rapport wilt verwijderen?',
	'SN_UP_DELETE_REPORTS_CONFIRM'	 => 'Weet je zeker dat je deze rapporten wilt verwijderen?',
	'SN_UP_DELETE_REPORT_SUCCESS'	 => 'Rapport is succesvol verwijderd.',
	'SN_UP_DELETE_REPORTS_SUCCESS'	 => 'Rapporten zijn succesvol verwijderd.',
));

// NOTIFY
$lang = array_merge($lang, array(
	'SN_AP_NOTIFY'					 => 'Meldingen',
	'SN_NO_NOTIFY'					 => 'Je hebt geen meldingen',
	'SN_NTF_FRIENDSHIP_ACCEPT'		 => '%1$s heeft je <a href="%2$s">vriendschapsverzoek</a> geaccepteerd',
	'SN_NTF_FRIENDSHIP_DENY'		 => '%1$s heeft je <a href="%2$s">vriendschapsverzoek</a> geweigerd',
	'SN_NTF_FRIENDSHIP_REQUEST'		 => '%1$s heeft je een <a href="%2$s">vriendschapsverzoek</a> gestuurd',
	'SN_NTF_FRIENDSHIP_CANCEL'		 => '%1$s heeft het <a href="%2$s">vriendschapsverzoek</a> geannuleerd',

	'SN_NTF_STATUS_AUTHOR_COMMENT'	 => '%1$s heeft gereageerd op <a href="%2$s">jouw status</a>',
	'SN_NTF_STATUS_USER_COMMENT'		 => '%1$s heeft gereageerd op de status van <a href="%3$s">%2$s</a>',
	'SN_NTF_STATUS_FRIEND_WALL'		 	=> '%1$s heeft een bericht achtergelaten op <a href="%2$s">jouw profiel</a>',

	'SN_NTF_APPROVE_FAMILY'			 => '%1$s heeft je toegevoegd als %2$s. Je kunt <a href="%3$s">deze relatie hier goedkeuren</a>',
	'SN_NTF_APPROVE_RELATIONSHIP'	 => '%1$s heeft een relatie met jou aangegeven. Je kunt <a href="%2$s">deze relatie hier goedkeuren</a>',

	'SN_NTF_EMOTE'					 => '%1$s heeft je een emote gestuurd: %2$s %3$s',

	'SN_NTF_RELATIONSHIP_APPROVED'	 => '%1$s heeft de <a href="%2$s">relatie</a> met jou bevestigd',
	'SN_NTF_FAMILY_APPROVED'		 => '%1$s heeft de <a href="%2$s">familierelatie</a> met jou bevestigd',

	'SN_NTF_RELATIONSHIP_VICEVERSA'	 => '%1$s heeft de <a href="%2$s">relatie</a> met jou bevestigd en deze ook aan het eigen profiel toegevoegd',
	'SN_NTF_FAMILY_VICEVERSA'		 => '%1$s heeft de <a href="%2$s">familierelatie</a> met jou bevestigd en deze ook aan het eigen profiel toegevoegd',

	'SN_NTF_RELATIONSHIP_REFUSED'	 => '%1$s heeft de <a href="%2$s">relatie</a> met jou geweigerd',
	'SN_NTF_FAMILY_REFUSED'			 => '%1$s heeft de <a href="%2$s">familierelatie</a> met jou geweigerd',

	'SN_NTF_STATUS_FRIEND_MENTION' => '%1$s heeft je genoemd in <a href="%2$s">zijn status</a>',
));

// EMOTES
$lang = array_merge($lang, array(
	'SN_UP_EMOTES_USER'	 => 'Emotes',
));

// EXPANDER
$lang = array_merge($lang, array(
	'SN_EXPANDER_READ_MORE'	 => 'Meer weergeven',
	'SN_EXPANDER_READ_LESS'	 => 'Sluiten',
));

// OUTDATED BROWSER
$lang = array_merge($lang, array(
	'BROWSER_OUTDATED_TITLE'	 => 'Je browser is verouderd',
	'BROWSER_OUTDATED'	 => 'Sommige functies werken mogelijk niet in je browser. We raden je sterk aan deze bij te werken.',

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

?>