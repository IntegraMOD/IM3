<?php
/**
*
* acp_common [Dutch]
*
* @package language
* @copyright (c) 2005 phpBB Group
* @copyright (c) 2007 phpBB.nl
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> 'Beheerders',
	'ACP_ADMIN_LOGS'			=> 'Beheerderslog',
	'ACP_ADMIN_ROLES'			=> 'Beheerdersrollen',
	'ACP_ATTACHMENTS'			=> 'Bijlagen',
	'ACP_ATTACHMENT_SETTINGS'	=> 'Bijlageninstellingen',
	'ACP_AUTH_SETTINGS'			=> 'Authenticatie',
	'ACP_AUTOMATION'			=> 'Automatisering',
	'ACP_AVATAR_SETTINGS'		=> 'Avatarinstellingen',

	'ACP_BACKUP'				=> 'Back-up',
	'ACP_BAN'					=> 'Bannen',
	'ACP_BAN_EMAILS'			=> 'Ban e-mailadres',
	'ACP_BAN_IPS'				=> 'Ban IP-adres',
	'ACP_BAN_USERNAMES'			=> 'Ban gebruikers',
	'ACP_BBCODES'				=> 'BBCodes',
	'ACP_BOARD_CONFIGURATION'	=> 'Forumconfiguratie',
	'ACP_BOARD_FEATURES'		=> 'Forumeigenschappen',
	'ACP_BOARD_MANAGEMENT'		=> 'Forumbeheer',
	'ACP_BOARD_SETTINGS'		=> 'Foruminstellingen',
	'ACP_BOTS'					=> 'Spiders/Robots',

	'ACP_CAPTCHA'				=> 'CAPTCHA',

	'ACP_CAT_DATABASE'			=> 'Database',
	'ACP_CAT_DOT_MODS'			=> '.Mods',
	'ACP_CAT_FILES'				=> 'Bestanden',	
	'ACP_CAT_FORUMS'			=> 'Forums',
	'ACP_CAT_GENERAL'			=> 'Algemeen',
	'ACP_CAT_MAINTENANCE'		=> 'Onderhoud',
	'ACP_CAT_PERMISSIONS'		=> 'Permissies',
	'ACP_CAT_POSTING'			=> 'Berichten',
	'ACP_CAT_STYLES'			=> 'Stijlen',
	'ACP_CAT_SYSTEM'			=> 'Systeem',
	'ACP_CAT_USERGROUP'			=> 'Gebruikers en groepen',
	'ACP_CAT_USERS'				=> 'Gebruikers',
	'ACP_CLIENT_COMMUNICATION'	=> 'Cliënt communicatie',
	'ACP_COOKIE_SETTINGS'		=> 'Cookie',
	'ACP_CRITICAL_LOGS'			=> 'Foutenlog',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> 'Aangepaste profielvelden',

	'ACP_DATABASE'				=> 'Databasebeheer',
	'ACP_DISALLOW'				=> 'Niet toegestaan',
	'ACP_DISALLOW_USERNAMES'	=> 'Weiger gebruikersnamen',

	'ACP_EMAIL_SETTINGS'		=> 'Instellingen e-mails',
	'ACP_EXTENSION_GROUPS'		=> 'Beheer extensiegroepen',

	'ACP_FORUM_BASED_PERMISSIONS'	=> 'Forum gebaseerde permissies',
	'ACP_FORUM_LOGS'				=> 'Forumlogs',
	'ACP_FORUM_MANAGEMENT'			=> 'Forumbeheer',
	'ACP_FORUM_MODERATORS'			=> 'Forum moderators',
	'ACP_FORUM_PERMISSIONS'			=> 'Forumpermissies',
	'ACP_FORUM_PERMISSIONS_COPY'	=> 'Kopieer forumpermissies',
	'ACP_FORUM_ROLES'				=> 'Forumrollen',

	'ACP_GENERAL_CONFIGURATION'		=> 'Algemene configuratie',
	'ACP_GENERAL_TASKS'				=> 'Algemene taken',
	'ACP_GLOBAL_MODERATORS'			=> 'Globale moderators',
	'ACP_GLOBAL_PERMISSIONS'		=> 'Algemene permissies',
	'ACP_GROUPS'					=> 'Groepen',
	'ACP_GROUPS_FORUM_PERMISSIONS'	=> 'Forumpermissies groepen',
	'ACP_GROUPS_MANAGE'				=> 'Groepsbeheer',
	'ACP_GROUPS_MANAGEMENT'			=> 'Groepsbeheer',
	'ACP_GROUPS_PERMISSIONS'		=> 'Permissies groepen',

	'ACP_ICONS'					=> 'Onderwerp iconen',
	'ACP_ICONS_SMILIES'			=> 'Onderwerp iconen/smilies',
	'ACP_IMAGESETS'				=> 'Afbeeldingsets',
	'ACP_INACTIVE_USERS'		=> 'Inactieve gebruikers',
	'ACP_INDEX'					=> 'Overzicht beheerderspaneel',

	'ACP_JABBER_SETTINGS'		=> 'Jabberinstellingen',

	'ACP_LANGUAGE'				=> 'Talenbeheer',
	'ACP_LANGUAGE_PACKS'		=> 'Taalpakketten',
	'ACP_LOAD_SETTINGS'			=> 'Instellingen serverprestatie',
	'ACP_LOGGING'				=> 'Loggen',

	'ACP_MAIN'					=> 'Overzicht beheerderspaneel',
	'ACP_MANAGE_EXTENSIONS'		=> 'Extensiebeheer',
	'ACP_MANAGE_FORUMS'			=> 'Forumbeheer',
	'ACP_MANAGE_RANKS'			=> 'Rangenbeheer',
	'ACP_MANAGE_REASONS'		=> 'Beheer meldingen/afkeur redenen',
	'ACP_MANAGE_USERS'			=> 'Gebruikersbeheer',
	'ACP_MASS_EMAIL'			=> 'Massa e-mail',
	'ACP_MESSAGES'				=> 'Berichten',
	'ACP_MESSAGE_SETTINGS'		=> 'Instellingen privéberichten',
	'ACP_MODULE_MANAGEMENT'		=> 'Modulebeheer',
	'ACP_MOD_LOGS'				=> 'Moderatorslog',
	'ACP_MOD_ROLES'				=> 'Moderators rollen',

	'ACP_NO_ITEMS'				=> 'Er zijn nog geen items.',

	'ACP_ORPHAN_ATTACHMENTS'	=> 'Berichtloze bijlagen',

	'ACP_PERMISSIONS'			=> 'Permissies',
	'ACP_PERMISSION_MASKS'		=> 'Permissiemasker',
	'ACP_PERMISSION_ROLES'		=> 'Permissierollen',
	'ACP_PERMISSION_TRACE'		=> 'Permissie traceren',
	'ACP_PHP_INFO'				=> 'PHP-informatie',
	'ACP_POST_SETTINGS'			=> 'Instellingen berichten',
	'ACP_PRUNE_FORUMS'			=> 'Forums automatisch opruimen',
	'ACP_PRUNE_USERS'			=> 'Gebruikers automatisch opruimen',
	'ACP_PRUNING'				=> 'Inkrimpen',

	'ACP_QUICK_ACCESS'			=> 'Meteen aan de slag',

	'ACP_RANKS'					=> 'Rangen',
	'ACP_REASONS'				=> 'Mededeling/weiger redenen',
	'ACP_REGISTER_SETTINGS'		=> 'Registratie instellingen',

	'ACP_RESTORE'				=> 'Herstel',

	'ACP_FEED'					=> 'Feedbeheer',
	'ACP_FEED_SETTINGS'			=> 'Feed-instellingen',

	'ACP_SEARCH'				=> 'Zoek configuratie',
	'ACP_SEARCH_INDEX'			=> 'Zoek index',
	'ACP_SEARCH_SETTINGS'		=> 'Zoek instellingen',

	'ACP_SECURITY_SETTINGS'		=> 'Beveiligingsinstellingen',
	'ACP_SEND_STATISTICS'		=> 'Stuur statistieken informatie',
	'ACP_SERVER_CONFIGURATION'	=> 'Serverconfiguratie',
	'ACP_SERVER_SETTINGS'		=> 'Serverinstellingen',
	'ACP_SIGNATURE_SETTINGS'	=> 'Onderschrift instellingen',
	'ACP_SMILIES'				=> 'Smilies',
	'ACP_STYLE_COMPONENTS'		=> 'Stijl onderdelen',
	'ACP_STYLE_MANAGEMENT'		=> 'Stijlenbeheer',
	'ACP_STYLES'				=> 'Stijlen',

	'ACP_SUBMIT_CHANGES'		=> 'Wijzigingen toepassen',
	'ACP_TEMPLATES'				=> 'Templates',
	'ACP_THEMES'				=> 'Thema’s',

	'ACP_UPDATE'					=> 'Bezig met updaten',
	'ACP_USERS_FORUM_PERMISSIONS'	=> 'Forumpermissies gebruikers',
	'ACP_USERS_LOGS'				=> 'Gebruikerslog',
	'ACP_USERS_PERMISSIONS'			=> 'Gebruikerspermissies',
	'ACP_USER_ATTACH'				=> 'Bijlagen',
	'ACP_USER_AVATAR'				=> 'Avatar',
	'ACP_USER_FEEDBACK'				=> 'Feedback',
	'ACP_USER_GROUPS'				=> 'Groepen',
	'ACP_USER_MANAGEMENT'			=> 'Gebruikersbeheer',
	'ACP_USER_OVERVIEW'				=> 'Overzicht',
	'ACP_USER_PERM'					=> 'Permissies',
	'ACP_USER_PREFS'				=> 'Foruminstellingen',
	'ACP_USER_PROFILE'				=> 'Profiel',
	'ACP_USER_RANK'					=> 'Rang',
	'ACP_USER_ROLES'				=> 'Gebruikersrollen',
	'ACP_USER_SECURITY'				=> 'Beveiliging gebruiker',
	'ACP_USER_SIG'					=> 'Onderschrift',
	'ACP_USER_WARNINGS'				=> 'Waarschuwingen',

	'ACP_VC_SETTINGS'					=> 'Spambotpreventie',
	'ACP_VC_CAPTCHA_DISPLAY'			=> 'CAPTCHA-afbeeldingvoorbeeld',
	'ACP_VERSION_CHECK'					=> 'Controleer op updates',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> 'Toon administratieve permissies',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS'	=> 'Toon forum moderatie permissies',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> 'Toon forumgebaseerde permissies',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS'	=> 'Toon globale moderator permissies',
	'ACP_VIEW_USER_PERMISSIONS'			=> 'Toon gebruikergebaseerde permissies',

	'ACP_WORDS'					=> 'Censuur',

	'ACTION'				=> 'Actie',
	'ACTIONS'				=> 'Acties',
	'ACTIVATE'				=> 'Activeren',
	'ADD'					=> 'Toevoegen',
	'ADMIN'					=> 'Beheer',
	'ADMIN_INDEX'			=> 'Beheerdersoverzicht',
	'ADMIN_PANEL'			=> 'Beheerderspaneel',

	'ADM_LOGOUT'			=> 'Beheerderspaneel&nbsp;uitloggen',
	'ADM_LOGGED_OUT'		=> 'Succesvol uitgelogd uit het beheerderspaneel',

	'BACK'					=> 'Terug',

	'COLOUR_SWATCH'			=> 'Webveilig kleurenpalet',
	'CONFIG_UPDATED'		=> 'Configuratie succesvol gewijzigd.',

	'DEACTIVATE'				=> 'Deactiveren',
	'DIRECTORY_DOES_NOT_EXIST'	=> 'Het opgegeven pad "%s" bestaat niet.',
	'DIRECTORY_NOT_DIR'			=> 'Het opgegeven pad "%s" is geen map.',
	'DIRECTORY_NOT_WRITABLE'	=> 'Het opgegeven pad "%s" is niet schrijfbaar.',
	'DISABLE'					=> 'Uitschakelen',
	'DOWNLOAD'					=> 'Download',
	'DOWNLOAD_AS'				=> 'Download als',
	'DOWNLOAD_STORE'			=> 'Download of sla bestand op',
	'DOWNLOAD_STORE_EXPLAIN'	=> 'Je kunt het bestand direct downloaden of opslaan in je <samp>opslagmap</samp>.',

	'EDIT'					=> 'Wijzig',
	'ENABLE'				=> 'Inschakelen',
	'EXPORT_DOWNLOAD'		=> 'Download',
	'EXPORT_STORE'			=> 'Opslaan',

	'GENERAL_OPTIONS'		=> 'Algemene instellingen',
	'GENERAL_SETTINGS'		=> 'Algemene instellingen',
	'GLOBAL_MASK'			=> 'Algemene permissiemaskers',

	'INSTALL'				=> 'Installeren',
	'IP'					=> 'Gebruikers-IP',
	'IP_HOSTNAME'			=> 'IP-adressen of hostnamen',

	'LOGGED_IN_AS'			=> 'Je bent ingelogd als:',
	'LOGIN_ADMIN'			=> 'Om dit forum te beheren moet je ingelogd zijn.',
	'LOGIN_ADMIN_CONFIRM'	=> 'Om dit forum te beheren dien je ter beveiliging nogmaals in te loggen.',
	'LOGIN_ADMIN_SUCCESS'	=> 'Je bent succesvol ingelogd en wordt nu naar het beheerderspaneel doorgestuurd.',
	'LOOK_UP_FORUM'			=> 'Selecteer een forum',
	'LOOK_UP_FORUMS_EXPLAIN'=> 'Je kunt meerdere forums selecteren.',

	'MANAGE'				=> 'Beheren',
	'MENU_TOGGLE'			=> 'Schakel kantmenu in of uit',
	'MORE'					=> 'Meer',			// Not used at the moment
	'MORE_INFORMATION'		=> 'Meer informatie »',
	'MOVE_DOWN'				=> 'Omlaag',
	'MOVE_UP'				=> 'Omhoog',

	'NOTIFY'				=> 'Mededeling',
	'NO_ADMIN'				=> 'Je bent niet gemachtigd om dit forum te beheren.',
	'NO_EMAILS_DEFINED'		=> 'Geen geldige e-mailadressen gevonden',
	'NO_PASSWORD_SUPPLIED'	=> 'Je moet het wachtwoord opgeven om toegang te krijgen tot het beheerderspaneel.',

	'OFF'					=> 'Uit',
	'ON'					=> 'Aan',

	'PARSE_BBCODE'						=> 'Vervang BBCode',
	'PARSE_SMILIES'						=> 'Vervang smilies',
	'PARSE_URLS'						=> 'Vervang links',
	'PERMISSIONS_TRANSFERRED'			=> 'Permissies gekopieerd',
	'PERMISSIONS_TRANSFERRED_EXPLAIN'	=> 'Momenteel heb je de permissies van %1$s. Je kunt de forums bekijken met de gebruikerspermissies, maar je hebt geen toegang tot het beheerderspaneel omdat de beheerderspermissies niet gekopieerd zijn. Je kunt je <a href="%2$s"><strong>permissie instellingen</strong></a> op ieder moment ongedaan maken.',
	'PROCEED_TO_ACP'					=> '%sGa door naar het beheerderspaneel%s',

	'REMIND'							=> 'Herinner',
	'RESYNC'							=> 'Synchroniseer',
	'RETURN_TO'							=> 'Terugkeren naar…',

	'SELECT_ANONYMOUS'		=> 'Selecteer anonieme gebruiker',
	'SELECT_OPTION'			=> 'Selecteer optie',

	'SETTING_TOO_LOW'		=> 'De opgegeven waarde voor deze instelling “%1$s” is te laag. De minimale acceptabele waarde is %2$d.',
	'SETTING_TOO_BIG'		=> 'De opgegeven waarde voor deze instelling “%1$s” is te hoog. De maximale acceptabele waarde is %2$d.',
	'SETTING_TOO_LONG'		=> 'De opgegeven waarde voor deze instelling “%1$s” is te lang. De maximale acceptabele lengte is %2$d.',
	'SETTING_TOO_SHORT'		=> 'De opgegeven waarde voor deze instelling “%1$s” is te kort. De minimale acceptabele lengte is %2$d.',

	'SHOW_ALL_OPERATIONS'	=> 'Toon alle werkingen',

	'UCP'					=> 'Gebruikerspaneel',
	'USERNAMES_EXPLAIN'		=> 'Plaats elke gebruikersnaam op een nieuwe lijn',
	'USER_CONTROL_PANEL'	=> 'Gebruikerspaneel',

	'WARNING'				=> 'Waarschuwing',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'	=> 'Deze pagina geeft informatie met betrekking tot de geïnstalleerde PHP-versie op deze server. Dit overzicht is inclusief gedetailleerde informatie omtrent de geladen modules, beschikbare waardes en de standaard opties. Deze informatie kan handig zijn bij het analyseren van problemen. Wees je ervan bewust dat sommige hostingbedrijven de hier weergegeven informatie beperken om beveiligingsredenen. Het is aangeraden om geen gegevens van deze pagina door te geven, tenzij dit gevraagd wordt door <a href="https://www.phpbb.com/about/team/">officiële team leden</a> op het supportforum.',

	'NO_PHPINFO_AVAILABLE'	=> 'De PHP-informatie kan niet bepaalt worden. phpinfo() is om beveiligingsredenen uitgeschakeld.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> 'Dit is een lijst van alle, door beheerders uitgevoerde acties. Je kunt sorteren op gebruikersnaam, datum, IP of actie. Indien je over de nodige permissies beschikt, kun je individuele acties of de hele lijst wissen.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> 'Dit is een lijst van alle acties die door het forum zelf uitgevoerd zijn. Deze logs bevatten de informatie die nodig is om specifieke problemen op te lossen, zoals bijvoorbeeld het niet afleveren van e-mails. Je kunt sorteren op gebruikersnaam, datum, IP of actie. Indien je over de nodige permissies beschikt, kun je individuele acties of de hele lijst wissen.',
	'ACP_MOD_LOGS_EXPLAIN'		=> 'Dit is een lijst van de acties die door de moderators uitgevoerd werden. Kies een forum uit de selectielijst. Je kunt sorteren op gebruikersnaam, datum, IP of actie. Indien je over de nodige permissies beschikt, kun je individuele acties of de hele lijst wissen.',
	'ACP_USERS_LOGS_EXPLAIN'	=> 'Dit is een lijst van alle acties uitgevoerd door, of op gebruikers.',
	'ALL_ENTRIES'				=> 'Alle logs',

	'DISPLAY_LOG'	=> 'Toon oudere logs',

	'NO_ENTRIES'	=> 'Er zijn geen logs voor deze periode',

	'SORT_IP'		=> 'IP-adressen',
	'SORT_DATE'		=> 'Datum',
	'SORT_ACTION'	=> 'Log actie',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> 'Bedankt dat je phpBB als jouw forumsoftware hebt gekozen! Dit scherm geeft een overzicht van allerlei statistieken van je forum. Aan de linkerkant vind je links die het mogelijk maken om alle instellingen van je forum te wijzigen. Iedere pagina bevat de nodige uitleg over hoe je de functies kunt gebruiken.',
	'ADMIN_LOG'					=> 'Gelogde beheerdersacties',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> 'Dit geeft een overzicht van de 5 laatste acties die door de beheerder(s) zijn uitgevoerd. Je kunt de volledige lijst bekijken door op het bijhorende menu-item of op de link hieronder te klikken.',
	'AVATAR_DIR_SIZE'			=> 'Grootte avatarmap',

	'BOARD_STARTED'		=> 'Forum gestart op',
	'BOARD_VERSION'		=> 'Forumversie',

	'DATABASE_SERVER_INFO'	=> 'Databaseserver',
	'DATABASE_SIZE'			=> 'Databasegrootte',

	// Enviroment configuration checks, mbstring related
	'ERROR_MBSTRING_FUNC_OVERLOAD'					=> 'De overbelasting functie is niet juist geconfigureerd',
	'ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN'			=> '<var>mbstring.func_overload</var> moet op 0 of 4 worden ingesteld. Je kunt de huidige waarde controleren op de <samp>PHP informatie</samp> pagina.',
	'ERROR_MBSTRING_ENCODING_TRANSLATION'			=> 'De transparante karakter encoding is niet juist geconfigureerd',
	'ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN'	=> '<var>mbstring.encoding_translation</var> must be set to 0 worden ingesteld. Je kunt de huidige waarde controleren op de <samp>PHP informatie</samp> pagina.',
	'ERROR_MBSTRING_HTTP_INPUT'						=> 'De HTTP input karakter conversie is niet juist geconfigureerd',
	'ERROR_MBSTRING_HTTP_INPUT_EXPLAIN'				=> '<var>mbstring.http_input</var> must be set to <samp>pass</samp> worden ingesteld. Je kunt de huidige waarde controleren op de <samp>PHP informatie</samp> pagina.',
	'ERROR_MBSTRING_HTTP_OUTPUT'					=> 'De HTTP output karakter conversie is niet juist geconfigureerd',
	'ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN'			=> '<var>mbstring.http_output</var> moet op <samp>pass</samp> worden ingesteld. Je kunt de huidige waarde controleren op de <samp>PHP informatie</samp> pagina.',

	'FILES_PER_DAY'		=> 'Bijlagen per dag',
	'FORUM_STATS'		=> 'Forumstatistieken',

	'GZIP_COMPRESSION'	=> 'GZip compressie',

	'NOT_AVAILABLE'		=> 'Niet beschikbaar',
	'NUMBER_FILES'		=> 'Aantal bijlagen',
	'NUMBER_POSTS'		=> 'Aantal berichten',
	'NUMBER_TOPICS'		=> 'Aantal onderwerpen',
	'NUMBER_USERS'		=> 'Aantal gebruikers',
	'NUMBER_ORPHAN'		=> 'Berichtloze bijlagen',

	'PHP_VERSION_OLD'	=> 'De versie van PHP op deze server zal in toekomstige versies van phpBB niet langer worden ondersteunt. %sDetails%s',

	'POSTS_PER_DAY'		=> 'Berichten per dag',

	'PURGE_CACHE'			=> 'Leeg de buffer',
	'PURGE_CACHE_CONFIRM'	=> 'Weet je zeker dat je de buffer wilt legen?',
	'PURGE_CACHE_EXPLAIN'	=> 'Verwijdert alle bestanden uit de buffer. Dit zijn onder andere alle templatebestanden en database queries.',

	'PURGE_SESSIONS'			=> 'Verwijder alle sessies',
	'PURGE_SESSIONS_CONFIRM'	=> 'Weet je zeker dat je alle sessies wilt verwijderen? Alle gebruikers zullen worden uitgelogd.',
	'PURGE_SESSIONS_EXPLAIN'	=> 'Hiermee wordt de sessie-tabel geleegd en zullen alle gebruikers worden uitgelogd.',

	'RESET_DATE'					=> 'Reset oprichtingsdatum van het forum',
	'RESET_DATE_CONFIRM'			=> 'Weet je zeker dat je de oprichtingsdatum van het forum wilt resetten?',
	'RESET_ONLINE'					=> 'Reset hoogst aantal online gebruikers',
	'RESET_ONLINE_CONFIRM'			=> 'Weet je zeker dat je de teller voor het hoogst aantal online gebruikers wilt resetten?',
	'RESYNC_POSTCOUNTS'				=> 'Synchroniseer berichtenteller',
	'RESYNC_POSTCOUNTS_EXPLAIN'		=> 'Alleen bestaande berichten zullen worden meegerekend. Verwijderde berichten worden niet meegeteld.',
	'RESYNC_POSTCOUNTS_CONFIRM'		=> 'Weet je zeker dat je de berichtteller wilt synchroniseren?',
	'RESYNC_POST_MARKING'			=> 'Synchroniseer gestipte onderwerpen',
	'RESYNC_POST_MARKING_CONFIRM'	=> 'Weet je zeker dat je de berichtteller voor gestipte berichten wilt synchroniseren?',
	'RESYNC_POST_MARKING_EXPLAIN'	=> 'Verwijdert eerst de markering van alle onderwerpen en duidt daarna alle onderwerpen aan die gedurende de laatste zes maanden activiteit hebben vertoond.',
	'RESYNC_STATS'					=> 'Synchroniseer statistieken',
	'RESYNC_STATS_CONFIRM'			=> 'Weet je zeker dat je de statistieken wilt synchroniseren?',
	'RESYNC_STATS_EXPLAIN'			=> 'Herberekent het aantal berichten, gebruikers en bestanden.',
	'RUN' 							=> 'Uitvoeren',

	'STATISTIC'					=> 'Statistieken',
	'STATISTIC_RESYNC_OPTIONS'	=> 'Synchroniseer of reset de statistieken.',

	'TOPICS_PER_DAY'	=> 'Onderwerpen per dag',

	'UPLOAD_DIR_SIZE'	=> 'Grootte van geplaatste bijlagen',
	'USERS_PER_DAY'		=> 'Gebruikers per dag',

	'VALUE'						=> 'Waarde',
	'VERSIONCHECK_FAIL'			=> 'Verkrijgen van laatste versie-informatie mislukt.',
	'VERSIONCHECK_FORCE_UPDATE'	=> 'Controleer versie opnieuw',
	'VIEW_ADMIN_LOG'			=> 'Toon beheerderslog',
	'VIEW_INACTIVE_USERS'		=> 'Toon inactieve gebruikers',

	'WELCOME_PHPBB'			=> 'Welkom bij phpBB',
	'WRITABLE_CONFIG'		=> 'Je configuratiebestand (config.php) is op dit moment beschrijfbaar. We raden je sterk aan de permissies te veranderen naar 640 of ten minste 644(bijvoorbeeld: <a href="http://en.wikipedia.org/wiki/Chmod" rel="external">chmod</a> 640 config.php).',
));

// Inactive Users
$lang = array_merge($lang, array(
	'INACTIVE_DATE'					=> 'Inactiviteitsdatum',
	'INACTIVE_REASON'				=> 'Reden',
	'INACTIVE_REASON_MANUAL'		=> 'Account gedeactiveerd door beheerder',
	'INACTIVE_REASON_PROFILE'		=> 'Profieldetails gewijzigd',
	'INACTIVE_REASON_REGISTER'		=> 'Nieuw account',
	'INACTIVE_REASON_REMIND'		=> 'Gebruiker verplicht om het account opnieuw te activeren',
	'INACTIVE_REASON_UNKNOWN'		=> 'Onbekend',
	'INACTIVE_USERS'				=> 'Inactieve gebruikers',
	'INACTIVE_USERS_EXPLAIN'		=> 'Dit is een lijst van gebruikers die zich geregistreerd hebben, maar waarvan het account inactief is. Je kunt deze gebruikers activeren, verwijderen of herinneren (via een e-mail) aan hun activatie.',
	'INACTIVE_USERS_EXPLAIN_INDEX'	=> 'Dit is een lijst van de laatste 10 geregistreerde gebruikers met een inactief account. Accounts zijn inactief omdat de functie "activeer account" in de gebruikersregistratie aanstaat en deze gebruikers nog niet zijn geactiveerd of deze zijn gedeactiveerd. De volledige lijst kan worden geraadpleegd door op de bijhorende optie in het menu of door op de link hieronder te klikken, waarna je de gebruikers kunt activeren, verwijderen of herinneren (via een e-mail) aan hun activatie.',

	'NO_INACTIVE_USERS'	=> 'Geen inactieve gebruikers',

	'SORT_INACTIVE'		=> 'Inactiviteitdatum',
	'SORT_LAST_VISIT'	=> 'Laatste bezoek',
	'SORT_REASON'		=> 'Reden',
	'SORT_REG_DATE'		=> 'Registratiedatum',
	'SORT_LAST_REMINDER'=> 'Laatst herinnerd',
	'SORT_REMINDER'		=> 'Herinnering verzonden',
	'SORT_EMAIL'		=> 'E-mail',
	
	'USER_IS_INACTIVE'		=> 'De gebruiker is inactief',
));

// Send statistics page
$lang = array_merge($lang, array(
	'EXPLAIN_SEND_STATISTICS'	=> 'Stuur informatie over jouw server en forum-configuraties naar phpBB voor statistische analyse. Alle informatie die jou of je website kan identificeren wordt hierbij <strong>niet</strong> meegestuurd. - De data is hierdoor volledig <strong>anoniem</strong>. Wij gebruiken deze gegevens voor toekomstige phpBB software op basis van deze informatie. De statistieken worden publiekelijk beschikbaar gemaakt. Ook delen we deze data met het PHP project, de programmeertaal waarmee phpBB is gemaakt.',
	'EXPLAIN_SHOW_STATISTICS'	=> 'Door gebruik te maken van onderstaande knop kun je alle variabelen bekijken die worden verzonden.',
	'DONT_SEND_STATISTICS'		=> 'Ga terug naar het beheerderspaneel als je geen statistische informatie naar phpBB wil verzenden.',
	'GO_ACP_MAIN'				=> 'Ga naar de hoofdpagina van het beheerderspaneel',
	'HIDE_STATISTICS'			=> 'Verberg details',
	'SEND_STATISTICS'			=> 'Stuur statistische informatie',
	'SHOW_STATISTICS'			=> 'Toon details',
	'THANKS_SEND_STATISTICS'	=> 'Bedankt voor het versturen van jouw informatie. Deze gegevens zullen anoniem worden gebruikt.',
));

// Log Entries
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'		=> '<strong>Gebruikerspermissies aan gebruiker toegevoegd en/of gewijzigd</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'		=> '<strong>Groepspermissies aan gebruiker toegevoegd en/of gewijzigd</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'		=> '<strong>Gebruikerspermissies aan globale moderator toegevoegd en/of gewijzigd</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'		=> '<strong>Groepspermissies aan globale moderator toegevoegd en/of gewijzigd</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'		=> '<strong>Gebruikerspermissies aan beheerder toegevoegd en/of gewijzigd</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'		=> '<strong>Groepspermissies aan beheerder toegevoegd en/of gewijzigd</strong><br />» %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'		=> '<strong>Beheerders toegevoegd en/of gewijzigd</strong><br />» %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'			=> '<strong>Globale moderators toegevoegd en/of gewijzigd</strong><br />» %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'			=> '<strong>Forum toegang gebruikers toegevoegd en/of gewijzigd</strong> van %1$s<br />» %2$s',
	'LOG_ACL_ADD_USER_LOCAL_M_'			=> '<strong>Forum moderator toegang gebruikers toegevoegd en/of gewijzigd</strong> van %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'		=> '<strong>Forum toegang groepen toegevoegd en/of gewijzigd</strong> van %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'		=> '<strong>Forum moderator toegang groepen toegevoegd en/of gewijzigd</strong> van %1$s<br />» %2$s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'			=> '<strong>Moderators toegevoegd en/of gewijzigd</strong> van %1$s<br />» %2$s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'		=> '<strong>Forumpermissies toegevoegd en/of gewijzigd</strong> van %1$s<br />» %2$s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'		=> '<strong>Beheerders verwijderd</strong><br />» %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'			=> '<strong>Globale moderators verwijderd</strong><br />» %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'			=> '<strong>Moderators verwijderd</strong> van %1$s<br />» %2$s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'		=> '<strong>Forumpermissies gebruiker/groep verwijderd</strong> van %1$s<br />» %2$s',

	'LOG_ACL_TRANSFER_PERMISSIONS'		=> '<strong>Permissies gekopieerd van</strong><br />» %s',
	'LOG_ACL_RESTORE_PERMISSIONS'		=> '<strong>Eigen permissies hersteld na het gebruiken van permissies van</strong><br />» %s',

	'LOG_ADMIN_AUTH_FAIL'		=> '<strong>Mislukte poging tot beheerders-login</strong>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<strong>Succesvolle beheerders-login</strong>',

	'LOG_ATTACHMENTS_DELETED'	=> '<strong>Verwijder gebruikersbijlages</strong><br />» %s',

	'LOG_ATTACH_EXT_ADD'		=> '<strong>Bijlage-extensie toegevoegd of gewijzigd</strong><br />» %s',
	'LOG_ATTACH_EXT_DEL'		=> '<strong>Bijlage-extensie verwijderd</strong><br />» %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<strong>Bijlage-extensie bijgewerkt</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<strong>Extensiegroep toegevoegd</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<strong>Extensiegroep toegevoegd</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<strong>Extensiegroep verwijderd</strong><br />» %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<strong>Berichtloos bestand naar bericht geüpload</strong><br />» ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<strong>Berichtloze bestanden verwijderd</strong><br />» %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<strong>Gebruiker uitgesloten van ban</strong> om de reden "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_EXCLUDE_IP'	=> '<strong>IP uitgesloten van ban</strong> om de reden "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_EXCLUDE_EMAIL'	=> '<strong>E-mail uitgesloten van ban</strong> om de reden "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_USER'			=> '<strong>Gebruiker verbannen</strong> om de reden "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_IP'			=> '<strong>IP verbannen</strong> om de reden "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_EMAIL'			=> '<strong>E-mail verbannen</strong> om de reden "<em>%1$s</em>"<br />» %2$s',
	'LOG_UNBAN_USER'		=> '<strong>Gebruiker niet langer verbannen</strong><br />» %s',
	'LOG_UNBAN_IP'			=> '<strong>IP niet langer verbannen</strong><br />» %s',
	'LOG_UNBAN_EMAIL'		=> '<strong>E-mail niet langer verbannen</strong><br />» %s',

	'LOG_BBCODE_ADD'		=> '<strong>Nieuwe BBCode toegevoegd</strong><br />» %s',
	'LOG_BBCODE_EDIT'		=> '<strong>BBCode gewijzigd</strong><br />» %s',
	'LOG_BBCODE_DELETE'		=> '<strong>BBCode verwijderd</strong><br />» %s',

	'LOG_BOT_ADDED'		=> '<strong>Nieuwe bot toegevoegd</strong><br />» %s',
	'LOG_BOT_DELETE'	=> '<strong>Bot verwijderd</strong><br />» %s',
	'LOG_BOT_UPDATED'	=> '<strong>Bestaande bot bijgewerkt</strong><br />» %s',

	'LOG_CLEAR_ADMIN'		=> '<strong>Beheerderslog geleegd</strong>',
	'LOG_CLEAR_CRITICAL'	=> '<strong>Foutenlog geleegd</strong>',
	'LOG_CLEAR_MOD'			=> '<strong>Moderatorslog geleegd</strong>',
	'LOG_CLEAR_USER'		=> '<strong>Gebruikerslog geleegd</strong><br />» %s',
	'LOG_CLEAR_USERS'		=> '<strong>Gebruikerslog geleegd</strong>',

	'LOG_CONFIG_ATTACH'			=> '<strong>Instellingen bijlagen aangepast</strong>',
	'LOG_CONFIG_AUTH'			=> '<strong>Instellingen verificatie aangepast</strong>',
	'LOG_CONFIG_AVATAR'			=> '<strong>Instellingen avatars aangepast</strong>',
	'LOG_CONFIG_COOKIE'			=> '<strong>Instellingen cookies aangepast</strong>',
	'LOG_CONFIG_EMAIL'			=> '<strong>Instellingen e-mails aangepast</strong>',
	'LOG_CONFIG_FEATURES'		=> '<strong>Forummogelijkheden aangepast</strong>',
	'LOG_CONFIG_LOAD'			=> '<strong>Instellingen serverprestatie aangepast</strong>',
	'LOG_CONFIG_MESSAGE'		=> '<strong>Instellingen privéberichten aangepast</strong>',
	'LOG_CONFIG_POST'			=> '<strong>Instellingen berichten aangepast</strong>',
	'LOG_CONFIG_REGISTRATION'	=> '<strong>Instellingen registratie aangepast</strong>',
	'LOG_CONFIG_FEED'			=> '<strong>Instellingen feed syndicaten aangepast</strong>',
	'LOG_CONFIG_SEARCH'			=> '<strong>Zoek-instellingen aangepast</strong>',
	'LOG_CONFIG_SECURITY'		=> '<strong>Instellingen beveiliging aangepast</strong>',
	'LOG_CONFIG_SERVER'			=> '<strong>Instellingen server aangepast</strong>',
	'LOG_CONFIG_SETTINGS'		=> '<strong>Instellingen forum aangepast</strong>',
	'LOG_CONFIG_SIGNATURE'		=> '<strong>Instellingen onderschrift aangepast</strong>',
	'LOG_CONFIG_VISUAL'			=> '<strong>Instellingen antibot aangepast</strong>',

	'LOG_APPROVE_TOPIC'			=> '<strong>Onderwerp goedgekeurd</strong><br />» %s',
	'LOG_BUMP_TOPIC'			=> '<strong>Gebruiker bumpte onderwerp</strong><br />» %s',
	'LOG_DELETE_POST'			=> '<strong>Bericht verwijderd “%1$s” geschreven door</strong><br />» %2$s',
	'LOG_DELETE_SHADOW_TOPIC'	=> '<strong>Schaduwonderwerp verwijderd</strong><br />» %s',
	'LOG_DELETE_TOPIC'			=> '<strong>Onderwerp verwijderd “%1$s” geschreven door</strong><br />» %2$s',
	'LOG_FORK'					=> '<strong>Onderwerp gekopieerd</strong><br />» van %s',
	'LOG_LOCK'					=> '<strong>Onderwerp gesloten</strong><br />» %s',
	'LOG_LOCK_POST'				=> '<strong>Bericht gesloten</strong><br />» %s',
	'LOG_MERGE'					=> '<strong>Berichten samengevoegd</strong> tot onderwerp<br />» %s',
	'LOG_MOVE'					=> '<strong>Onderwerp verplaatst</strong><br />» van %1$s naar %2$s',
	'LOG_PM_REPORT_CLOSED'		=> '<strong>PM melding gesloten</strong><br />» %s',
	'LOG_PM_REPORT_DELETED'		=> '<strong>PM melding verwijderd</strong><br />» %s',
	'LOG_POST_APPROVED'			=> '<strong>Bericht goedgekeurd</strong><br />» %s',
	'LOG_POST_DISAPPROVED'		=> '<strong>Bericht "%1$s" afgekeurd omwille van volgende reden</strong><br />» %2$s',
	'LOG_POST_EDITED'			=> '<strong>Bericht "%1$s" gewijzigd, geschreven door</strong><br />» %2$s',
	'LOG_REPORT_CLOSED'			=> '<strong>Melding gesloten</strong><br />» %s',
	'LOG_REPORT_DELETED'		=> '<strong>Melding verwijderd</strong><br />» %s',
	'LOG_SPLIT_DESTINATION'		=> '<strong>Gesplitste berichten verplaatst</strong><br />» naar %s',
	'LOG_SPLIT_SOURCE'			=> '<strong>Berichten gesplitst</strong><br />» van %s',

	'LOG_TOPIC_APPROVED'		=> '<strong>Onderwerp goedgekeurd</strong><br />» %s',
	'LOG_TOPIC_DISAPPROVED'		=> '<strong>Onderwerp "%1$s" afgekeurd omwille van volgende reden</strong><br />» %2$s',
	'LOG_TOPIC_RESYNC'			=> '<strong>Onderwerpenteller gesynchroniseerd</strong><br />» %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<strong>Onderwerptype gewijzigd</strong><br />» %s',
	'LOG_UNLOCK'				=> '<strong>Onderwerp geopend</strong><br />» %s',
	'LOG_UNLOCK_POST'			=> '<strong>Bericht geopend</strong><br />» %s',

	'LOG_DISALLOW_ADD'		=> '<strong>Niet-toegestane gebruikersnaam toegevoegd</strong><br />» %s',
	'LOG_DISALLOW_DELETE'	=> '<strong>Niet-toegestane gebruikersnaam verwijderd</strong>',

	'LOG_DB_BACKUP'			=> '<strong>Database back-up</strong>',
	'LOG_DB_DELETE'			=> '<strong>Database back-up verwijderd</strong>',
	'LOG_DB_RESTORE'		=> '<strong>Database hersteld</strong>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<strong>IP/hostnaam uitgesloten van downloadlijst</strong><br />» %s',
	'LOG_DOWNLOAD_IP'			=> '<strong>IP/hostnaam toegevoegd aan downloadlijst</strong><br />» %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<strong>IP/hostnaam verwijderd uit downloadlijst</strong><br />» %s',

	'LOG_ERROR_JABBER'		=> '<strong>Jabber-fout</strong><br />» %s',
	'LOG_ERROR_EMAIL'		=> '<strong>E-mail-fout</strong><br />» %s',

	'LOG_FORUM_ADD'							=> '<strong>Nieuw forum aangemaakt</strong><br />» %s',
	'LOG_FORUM_COPIED_PERMISSIONS'			=> '<strong>Forumpermissies gekopieerd</strong> van %1$s<br />» %2$s',
	'LOG_FORUM_DEL_FORUM'					=> '<strong>Forum verwijderd</strong><br />» %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<strong>Forum, inclusief subforums verwijderd</strong><br />» %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<strong>Forum verwijderd en subforums verplaatst</strong> naar %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<strong>Forum verwijderd en berichten verplaatst</strong> naar %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS'		=> '<strong>Forum, inclusief subforums verwijderd en berichten verplaatst</strong> naar %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<strong>Forum verwijderd en berichten verplaatst</strong> naar %1$s <strong>en subforums</strong> naar %2$s<br />» %3$s',
	'LOG_FORUM_DEL_POSTS'					=> '<strong>Forum, inclusief berichten verwijderd</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<strong>Forum, inclusief berichten en subforums verwijderd</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS'		=> '<strong>Forum, inclusief berichten verwijderd en subforums verplaatst</strong> naar %1$s<br />» %2$s',
	'LOG_FORUM_EDIT'						=> '<strong>Forumdetails gewijzigd</strong><br />» %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<strong>Forum</strong> %1$s <strong>verplaatst naar onder</strong> %2$s',
	'LOG_FORUM_MOVE_UP'						=> '<strong>Forum</strong> %1$s <strong>verplaatst naar boven</strong> %2$s',
	'LOG_FORUM_SYNC'						=> '<strong>Forum gesynchroniseerd</strong><br />» %s',

	'LOG_GENERAL_ERROR'	=> '<strong>Er is een algemene fout opgetreden</strong>: %1$s <br />» %2$s',

	'LOG_GROUP_CREATED'		=> '<strong>Nieuwe gebruikersgroep aangemaakt</strong><br />» %s',
	'LOG_GROUP_DEFAULTS'	=> '<strong>Groep “%1$s” als standaard voor gebruikers ingesteld</strong><br />» %2$s',
	'LOG_GROUP_DELETE'		=> '<strong>Gebruikersgroep verwijderd</strong><br />» %s',
	'LOG_GROUP_DEMOTED'		=> '<strong>Leiders toegewezen aan de groep</strong> %1$s<br />» %2$s',
	'LOG_GROUP_PROMOTED'	=> '<strong>Leden gepromoveerd naar leider in de gebruikersgroep</strong> %1$s<br />» %2$s',
	'LOG_GROUP_REMOVE'		=> '<strong>Leden verwijderd van de gebruikersgroep</strong> %1$s<br />» %2$s',
	'LOG_GROUP_UPDATED'		=> '<strong>Details gebruikersgroep bijgewerkt</strong><br />» %s',
	'LOG_MODS_ADDED'		=> '<strong>Nieuwe leiders aan gebruikersgroep toegevoegd</strong> %1$s<br />» %2$s',
	'LOG_USERS_ADDED'		=> '<strong>Nieuwe leden aan gebruikersgroep toegevoegd</strong> %1$s<br />» %2$s',
	'LOG_USERS_APPROVED'	=> '<strong>Gebruikers toegelaten tot gebruikersgroep</strong> %1$s<br />» %2$s',
	'LOG_USERS_PENDING'		=> '<strong>Gebruikers verzochten om lid te worden van groep “%1$s” en moeten worden goedgekeurd</strong><br />» %2$s',

	'LOG_IMAGE_GENERATION_ERROR'	=> '<strong>Fout bij het maken van een afbeelding</strong><br />» Fout in %1$s op regel %2$s: %3$s',

	'LOG_IMAGESET_ADD_DB'			=> '<strong>Nieuwe afbeeldingset aan de database toegevoegd</strong><br />» %s',
	'LOG_IMAGESET_ADD_FS'			=> '<strong>Nieuwe afbeeldingset aan het bestandssysteem toevoegen</strong><br />» %s',
	'LOG_IMAGESET_DELETE'			=> '<strong>Afbeeldingenset verwijderd</strong><br />» %s',
	'LOG_IMAGESET_EDIT_DETAILS'		=> '<strong>Details van de afbeeldingenset gewijzigd</strong><br />» %s',
	'LOG_IMAGESET_EDIT'				=> '<strong>Afbeeldingenset gewijzigd</strong><br />» %s',
	'LOG_IMAGESET_EXPORT'			=> '<strong>Afbeeldingenset geëxporteerd</strong><br />» %s',
	'LOG_IMAGESET_LANG_MISSING'		=> '<strong>Afbeeldingenset mist "%2$s" taalvariabelen</strong><br />» %1$s',
	'LOG_IMAGESET_LANG_REFRESHED'	=> '<strong>Vernieuwing van lokaal "%2$s" afbeeldingset</strong><br />» %1$s',
	'LOG_IMAGESET_REFRESHED'		=> '<strong>Afbeeldingsets vernieuwd</strong><br />» %s',

	'LOG_INACTIVE_ACTIVATE'	=> '<strong>Inactieve gebruiker(s) geactiveerd</strong><br />» %s',
	'LOG_INACTIVE_DELETE'	=> '<strong>Inactieve gebruiker(s) verwijderd</strong><br />» %s',
	'LOG_INACTIVE_REMIND'	=> '<strong>Herinnerings e-mails naar inactieve gebruiker(s) gestuurd</strong><br />» %s',
	'LOG_INSTALL_CONVERTED'	=> '<strong>Geconverteerd van %1$s naar phpBB %2$s</strong>',
	'LOG_INSTALL_INSTALLED'	=> '<strong>phpBB %s geïnstalleerd</strong>',

	'LOG_IP_BROWSER_FORWARDED_CHECK'	=> '<strong>Sessie IP/browser/X_FORWARDED_FOR controle mislukt</strong><br />»IP-gebruiker "<em>%1$s</em>" vergeleken met sessie-IP "<em>%2$s</em>", browser waarde gebruiker "<em>%3$s</em>" vergeleken met browser waarde sessie "<em>%4$s</em>" en X_FORWARDED_FOR waarde gebruiker "<em>%5$s</em>" vergeleken met X_FORWARDED_FOR waarde sessie "<em>%6$s</em>".',

	'LOG_JAB_CHANGED'			=> '<strong>Jabber-account gewijzigd</strong>',
	'LOG_JAB_PASSCHG'			=> '<strong>Jabber-wachtwoord gewijzigd</strong>',
	'LOG_JAB_REGISTER'			=> '<strong>Jabber-account geregistreerd</strong>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<strong>Instellingen Jabber gewijzigd</strong>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<strong>Taalpakket verwijderd</strong><br />» %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<strong>Taalpakket geïnstalleerd</strong><br />» %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<strong>Details taalpakket bijgewerkt</strong><br />» %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<strong>Taalbestand vervangen</strong><br />» %s',
	'LOG_LANGUAGE_FILE_SUBMITTED'	=> '<strong>Toegevoegd taalbestand en in de opslagmap geplaatst</strong><br />» %s',

	'LOG_MASS_EMAIL'		=> '<strong>Stuur massa e-mail</strong><br />» %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<strong>Auteur gewijzigd in onderwerp "%1$s"</strong><br />» van %2$s naar %3$s',

	'LOG_MODULE_DISABLE'	=> '<strong>Module uitgeschakeld</strong><br />» %s',
	'LOG_MODULE_ENABLE'		=> '<strong>Module ingeschakeld</strong><br />» %s',
	'LOG_MODULE_MOVE_DOWN'	=> '<strong>Module omlaag verplaatst</strong><br />» %1$s onder %2$s ',
	'LOG_MODULE_MOVE_UP'	=> '<strong>Module omhoog verplaatst</strong><br />» %1$s boven %2$s ',
	'LOG_MODULE_REMOVED'	=> '<strong>Module verwijderd</strong><br />» %s',
	'LOG_MODULE_ADD'		=> '<strong>Module toegevoegd</strong><br />» %s',
	'LOG_MODULE_EDIT'		=> '<strong>Module gewijzigd</strong><br />» %s',

	'LOG_A_ROLE_ADD'		=> '<strong>Beheerdersrol toegevoegd</strong><br />» %s',
	'LOG_A_ROLE_EDIT'		=> '<strong>Beheerdersrol gewijzigd</strong><br />» %s',
	'LOG_A_ROLE_REMOVED'	=> '<strong>Beheerdersrol verwijderd</strong><br />» %s',
	'LOG_F_ROLE_ADD'		=> '<strong>Forumrol toegevoegd</strong><br />» %s',
	'LOG_F_ROLE_EDIT'		=> '<strong>Forumrol gewijzigd</strong><br />» %s',
	'LOG_F_ROLE_REMOVED'	=> '<strong>Forumrol verwijderd</strong><br />» %s',
	'LOG_M_ROLE_ADD'		=> '<strong>Moderatorrol toegevoegd</strong><br />» %s',
	'LOG_M_ROLE_EDIT'		=> '<strong>Moderatorrol gewijzigd</strong><br />» %s',
	'LOG_M_ROLE_REMOVED'	=> '<strong>Moderatorrol verwijderd</strong><br />» %s',
	'LOG_U_ROLE_ADD'		=> '<strong>Gebruikersrol toegevoegd</strong><br />» %s',
	'LOG_U_ROLE_EDIT'		=> '<strong>Gebruikersrol gewijzigd</strong><br />» %s',
	'LOG_U_ROLE_REMOVED'	=> '<strong>Gebruikersrol verwijderd</strong><br />» %s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<strong>Profielveld geactiveerd</strong><br />» %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<strong>Profielveld toegevoegd</strong><br />» %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<strong>Profielveld gedeactiveerd</strong><br />» %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<strong>Profielveld gewijzigd</strong><br />» %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<strong>Profielveld verwijderd</strong><br />» %s',

	'LOG_PRUNE'					=> '<strong>Opruiming forums</strong><br />» %s',
	'LOG_AUTO_PRUNE'			=> '<strong>Automatische opruiming van forums</strong><br />» %s',
	'LOG_PRUNE_USER_DEAC'		=> '<strong>Gebruikers gedeactiveerd</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<strong>Gebruikers opgeruimd en berichten verwijderd</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<strong>Gebruikers opgeruimd en berichten bijgehouden</strong><br />» %s',

	'LOG_PURGE_CACHE'			=> '<strong>Buffer geleegd</strong>',
	'LOG_PURGE_SESSIONS'		=> '<strong>Sessies verwijderd</strong>',


	'LOG_RANK_ADDED'		=> '<strong>Nieuwe rang toegevoegd</strong><br />» %s',
	'LOG_RANK_REMOVED'		=> '<strong>Rang verwijderd</strong><br />» %s',
	'LOG_RANK_UPDATED'		=> '<strong>Rang bijgewerkt</strong><br />» %s',

	'LOG_REASON_ADDED'		=> '<strong>Melding/weiger reden toegevoegd</strong><br />» %s',
	'LOG_REASON_REMOVED'	=> '<strong>Melding/weiger reden verwijderd</strong><br />» %s',
	'LOG_REASON_UPDATED'	=> '<strong>Melding/weiger reden bijgewerkt</strong><br />» %s',

	'LOG_REFERER_INVALID'		=> '<strong>Verwijzingscontrole faalde</strong><br />»Verwijzing was “<em>%1$s</em>”. Het verzoek is afgewezen en de sessie is afgebroken.',
	'LOG_RESET_DATE'			=> '<strong>Opstartdatum forum gereset</strong>',
	'LOG_RESET_ONLINE'			=> '<strong>Meeste gebruikers online gereset</strong>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<strong>Gebruikers berichtenteller gesynchroniseerd</strong>',
	'LOG_RESYNC_POST_MARKING'	=> '<strong>Gestipte onderwerpen gesynchroniseerd</strong>',
	'LOG_RESYNC_STATS'			=> '<strong>Berichten-, onderwerpen- en gebruikersstatistieken gesynchroniseerd</strong>',

	'LOG_SEARCH_INDEX_CREATED'	=> '<strong>Zoekindex gemaakt voor</strong><br />» %s',
	'LOG_SEARCH_INDEX_REMOVED'	=> '<strong>Zoekindex verwijderd voor</strong><br />» %s',
	'LOG_STYLE_ADD'				=> '<strong>Nieuwe stijl toegevoegd</strong><br />» %s',
	'LOG_STYLE_DELETE'			=> '<strong>Stijl verwijderd</strong><br />» %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<strong>Stijl gewijzigd</strong><br />» %s',
	'LOG_STYLE_EXPORT'			=> '<strong>Stijl geëxporteerd</strong><br />» %s',

	'LOG_TEMPLATE_ADD_DB'			=> '<strong>Nieuwe templateset aan de database toegevoegd</strong><br />» %s',
	'LOG_TEMPLATE_ADD_FS'			=> '<strong>Nieuwe templateset aan het bestandssysteem toegevoegd</strong><br />» %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<strong>Gebufferde versies van templatebestanden uit de templateset <em>%1$s</em> verwijderd</strong><br />» %2$s',
	'LOG_TEMPLATE_DELETE'			=> '<strong>Templateset verwijderd</strong><br />» %s',
	'LOG_TEMPLATE_EDIT'				=> '<strong>Templateset <em>%1$s</em> gewijzigd</strong><br />» %2$s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<strong>Templatedetails gewijzigd</strong><br />» %s',
	'LOG_TEMPLATE_EXPORT'			=> '<strong>Templateset geëxporteerd</strong><br />» %s',
	'LOG_TEMPLATE_REFRESHED'		=> '<strong>Templateset vernieuwd</strong><br />» %s',

	'LOG_THEME_ADD_DB'			=> '<strong>Nieuw thema aan de database toegevoegd</strong><br />» %s',
	'LOG_THEME_ADD_FS'			=> '<strong>Nieuw thema aan het bestandssysteem toegevoegd</strong><br />» %s',
	'LOG_THEME_DELETE'			=> '<strong>Thema verwijderd</strong><br />» %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<strong>Thema details gewijzigd</strong><br />» %s',
	'LOG_THEME_EDIT'			=> '<strong>Thema <em>%1$s</em> gewijzigd</strong>',
	'LOG_THEME_EDIT_FILE'		=> '<strong>Thema <em>%1$s</em> gewijzigd</strong><br />» Bestand gewijzigd <em>%2$s</em>',
	'LOG_THEME_EXPORT'			=> '<strong>Thema geëxporteerd</strong><br />» %s',
	'LOG_THEME_REFRESHED'		=> '<strong>Thema vernieuwd</strong><br />» %s',

	'LOG_UPDATE_DATABASE'	=> '<strong>Databaseversie geüpdate van %1$s naar %2$s</strong>',
	'LOG_UPDATE_PHPBB'		=> '<strong>phpBB-versie geüpdate van %1$s naar %2$s</strong>',

	'LOG_USER_ACTIVE'		=> '<strong>Gebruiker geactiveerd</strong><br />» %s',
	'LOG_USER_BAN_USER'		=> '<strong>Gebruiker verbannen via gebruikersbeheer</strong>, wegens "<em>%1$s</em>"<br />» %2$s',
	'LOG_USER_BAN_IP'		=> '<strong>IP verbannen via gebruikersbeheer</strong>, wegens "<em>%1$s</em>"<br />» %2$s',
	'LOG_USER_BAN_EMAIL'	=> '<strong>E-mail verbannen via gebruikersbeheer</strong>, wegens "<em>%1$s</em>"<br />» %2$s',
	'LOG_USER_DELETED'		=> '<strong>Gebruiker verwijderd</strong><br />» %s',
	'LOG_USER_DEL_ATTACH'	=> '<strong>Alle bijlagen van de gebruiker verwijderd</strong><br />» %s',
	'LOG_USER_DEL_AVATAR'	=> '<strong>Avatar gebruiker verwijderd</strong><br />» %s',
	'LOG_USER_DEL_OUTBOX'	=> '<strong>Gebruikers `postvak uit´ geleegd</strong><br />» %s',
	'LOG_USER_DEL_POSTS'	=> '<strong>Alle berichten van de gebruiker verwijderd</strong><br />» %s',
	'LOG_USER_DEL_SIG'		=> '<strong>Onderschrift gebruiker verwijderd</strong><br />» %s',
	'LOG_USER_INACTIVE'		=> '<strong>Gebruiker gedeactiveerd</strong><br />» %s',
	'LOG_USER_MOVE_POSTS'	=> '<strong>Berichten gebruiker verplaatst</strong><br />» berichten door "%1$s" naar forum "%2$s"',
	'LOG_USER_NEW_PASSWORD'	=> '<strong>Wachtwoord gebruiker gewijzigd</strong><br />» %s',
	'LOG_USER_REACTIVATE'	=> '<strong>Gebruiker verplicht om het account opnieuw te activeren</strong><br />» %s',
	'LOG_USER_REMOVED_NR'	=> '<strong>Verwijder nieuw geregistreerde markering van gebruiker</strong><br />» %s',

	'LOG_USER_UPDATE_EMAIL'	=> '<strong>E-mail van de gebruiker "%1$s" gewijzigd</strong><br />» van "%2$s" naar "%3$s"',
	'LOG_USER_UPDATE_NAME'	=> '<strong>Gebruikersnaam gewijzigd</strong><br />» van "%1$s" naar "%2$s"',
	'LOG_USER_USER_UPDATE'	=> '<strong>Gebruikersdetails bijgewerkt</strong><br />» %s',

	'LOG_USER_ACTIVE_USER'		=> '<strong>Gebruikersaccount geactiveerd</strong>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<strong>Avatar gebruiker verwijderd</strong>',
	'LOG_USER_DEL_SIG_USER'		=> '<strong>Onderschrift gebruiker verwijderd</strong>',
	'LOG_USER_FEEDBACK'			=> '<strong>Feedback gebruiker toegevoegd</strong><br />» %s',
	'LOG_USER_GENERAL'			=> '<strong>Nieuw toegevoegd</strong><br />» %s',
	'LOG_USER_INACTIVE_USER'	=> '<strong>Gebruikersaccount gedeactiveerd</strong>',
	'LOG_USER_LOCK'				=> '<strong>Gebruiker sloot eigen onderwerp</strong><br />» %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<strong>Alle berichten naar het forum "%s" verplaatst</strong>',
	'LOG_USER_REACTIVATE_USER'	=> '<strong>Gebruiker verplicht om het account opnieuw te activeren</strong>',
	'LOG_USER_UNLOCK'			=> '<strong>Gebruiker opende eigen onderwerp</strong><br />» %s',
	'LOG_USER_WARNING'			=> '<strong>Gebruikers-waarschuwing toegevoegd</strong><br />» %s',
	'LOG_USER_WARNING_BODY'		=> '<strong>De volgende waarschuwing werd verstuurd naar de gebruiker</strong><br />» %s',

	'LOG_USER_GROUP_CHANGE'			=> '<strong>Gebruiker wijzigde standaardgroep</strong><br />» %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<strong>Gebruiker als leider van groep aangeduid</strong><br />» %s',
	'LOG_USER_GROUP_JOIN'			=> '<strong>Gebruiker bij groep aangesloten</strong><br />» %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<strong>Gebruiker aangesloten bij groep en wacht op goedkeuring</strong><br />» %s',
	'LOG_USER_GROUP_RESIGN'			=> '<strong>Gebruiker uit groep gestapt</strong><br />» %s',

	'LOG_WARNING_DELETED'		=> '<strong>Gebruikers-waarschuwing verwijderd</strong><br />» %s',
	'LOG_WARNINGS_DELETED'		=> '<strong>Verwijderde %2$s gebruikers-waarschuwing</strong><br />» %1$s', // Example: '<strong>Deleted 2 user warnings</strong><br />» username'
	'LOG_WARNINGS_DELETED_ALL'	=> '<strong>Verwijderde alle gebruikers-waarschuwingen</strong><br />» %s',

	'LOG_WORD_ADD'			=> '<strong>Censuur toegevoegd</strong><br />» %s',
	'LOG_WORD_DELETE'		=> '<strong>Censuur verwijderd</strong><br />» %s',
	'LOG_WORD_EDIT'			=> '<strong>Censuur gewijzigd</strong><br />» %s',

	// Missing variables
	'ACP_CALENDAR'									=> 'Kalender',
	'ACP_CALENDAR_MOD'								=> 'Kalender',
	'ACP_CALENDAR_SETTINGS'							=> 'Kalender Instellingen',
	'ACP_CALENDAR_USERS'							=> 'Kalender Gebruikersinstellingen',
	'ACP_CAT_DIGESTS'								=> 'Samenvattingen',
	'ACP_IMOD'										=> 'IntegraMOD',
	'ACP_CAT_KB'									=> 'Kennisbank',
	'ACP_FILE_BACKUP'								=> 'Bestandsback-up',
	'LOG_CONFIG_DIGEST_BAD_DATE_PARAM'				=> '<strong>Samenvatting uitzondering: Een ongeldige URL-datumparameter van "%s" is gevonden. Deze moet geformatteerd zijn als een ISO-8601 datum, d.w.z. in een JJJJ-MM-DD formaat.</strong>',
	'LOG_CONFIG_DIGEST_BAD_DIGEST_TYPE'				=> '<strong>Samenvatting uitzondering: Een ongeldig samenvattingstype van "%s" is gevonden</strong>',
	'LOG_CONFIG_DIGEST_BAD_HOUR_PARAM'				=> '<strong>Samenvatting uitzondering: Een ongeldige URL-uurparameter van "%s" is gevonden. Dit moet een heel getal tussen 0 en 23 zijn.</strong>',
	'LOG_CONFIG_DIGEST_BAD_KEY_VALUE'				=> '<strong>Bij het uitvoeren van mail_digests.php was de opgegeven parameter "key" ongeldig: "%s". Programma beëindigd.</strong>',
	'LOG_CONFIG_DIGEST_BOARD_DISABLED'				=> '<strong>Uitvoer van mail_digests.php werd geprobeerd, maar is gestopt omdat het forum is uitgeschakeld.</strong>',
	'LOG_CONFIG_DIGEST_EDIT_SUBSCRIBERS'			=> '<strong>Samenvatting abonnees gewijzigd</strong>',
	'LOG_CONFIG_DIGEST_GENERAL'						=> '<strong>Algemene instellingen samenvatting gewijzigd</strong>',
	'LOG_CONFIG_DIGEST_LOG'							=> '<strong>Loginstellingen samenvatting gewijzigd</strong>',
	'LOG_CONFIG_DIGEST_LOG_ENTRY_BAD'				=> '<strong>Kan samenvatting niet verzenden naar %s (%s)</strong>',
	'LOG_CONFIG_DIGEST_LOG_ENTRY_BAD_NO_EMAIL'		=> '<strong>Kan samenvatting niet verzenden naar %s</strong>',
	'LOG_CONFIG_DIGEST_LOG_ENTRY_GOOD'				=> '<strong>Er is een samenvatting %s verzonden naar %s (%s) met daarin %s berichten en %s privéberichten</strong>',
	'LOG_CONFIG_DIGEST_LOG_ENTRY_GOOD_NO_EMAIL'		=> '<strong>Er is een samenvatting %s verzonden naar %s met daarin %s berichten en %s privéberichten</strong>',
	'LOG_CONFIG_DIGEST_LOG_ENTRY_NONE'				=> '<strong>Er is GEEN samenvatting verzonden naar %s (%s) omdat filters en voorkeuren van de gebruiker aangaven dat er niets verzonden moest worden</strong>',
	'LOG_CONFIG_DIGEST_LOG_ENTRY_NONE_NO_EMAIL'		=> '<strong>Er is GEEN samenvatting verzonden naar %s omdat filters en voorkeuren van de gebruiker aangaven dat er niets verzonden moest worden</strong>',
	'LOG_CONFIG_DIGEST_LOG_EMAILED'					=> '<strong>Alle samenvattingen voor dit uur zijn gemaild</strong>',
	'LOG_CONFIG_DIGEST_LOG_START'					=> '<strong>Starten van mail_digests.php</strong>',
	'LOG_CONFIG_DIGEST_LOG_END'						=> '<strong>Beëindigen van mail_digests.php</strong>',
	'LOG_CONFIG_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE'	=> '<strong>Massa-abonneren of -afmelden voor samenvattingen uitgevoerd</strong>',
	'LOG_CONFIG_DIGEST_NEED_TWO_PARAMS'				=> '<strong>Samenvatting uitzondering: Er moeten zowel een datum als een uur worden gespecificeerd voor een onregelmatige run van mail_digests.php. Er is er slechts één verstrekt.</strong>',
	'LOG_CONFIG_DIGEST_NO_BOOKMARKS'				=> '<strong>Samenvatting uitzondering: Er is een samenvatting voor gebookmarkte onderwerpen aangevraagd door "%s", maar de gebruiker had geen gebookmarkte onderwerpen</strong>',
	'LOG_CONFIG_DIGEST_NO_ALLOWED_FORUMS'			=> '<strong>Samenvatting uitzondering: Gebruiker "%s" heeft geen toegang tot forums waardoor er geen samenvatting gemaakt kan worden</strong>',
	'LOG_CONFIG_DIGEST_NOT_ENABLED'					=> '<strong>Samenvattingen zijn momenteel niet ingeschakeld, waardoor er voor dit uur geen samenvattingen zijn verzonden.</strong>',
	'LOG_CONFIG_DIGEST_SEND_MASS_EMAIL_ERROR'		=> '<strong>Kan de massa e-mail voor aan-/afmelding samenvattingen niet naar %s sturen</strong>',
	'LOG_CONFIG_DIGEST_USER_DEFAULTS'				=> '<strong>Standaardinstellingen voor gebruiker samenvatting gewijzigd</strong>',
	'LOG_CONFIG_DIGEST_WRITE_LOG_ENTRY_ERROR'		=> '<strong>Samenvatting uitzondering: write_log_entry aangeroepen met een niet-afgehandled type "%s"</strong>',
	'LOG_FILE_BACKUP'								=> '<strong>Bestandsback-up</strong><br />',
	'ACP_DIGEST_SETTINGS'							=> 'Instellingen samenvatting',
	'ACP_DIGEST_GENERAL_SETTINGS'					=> 'Algemene instellingen',
	'ACP_DIGEST_GENERAL_SETTINGS_EXPLAIN'			=> 'Dit zijn de algemene instellingen voor samenvattingen.',
	'ACP_DIGEST_USER_DEFAULT_SETTINGS'				=> 'Standaardinstellingen gebruiker',
	'ACP_DIGEST_USER_DEFAULT_SETTINGS_EXPLAIN'		=> 'Hiermee kunnen beheerders de standaarden instellen die gebruikers zien wanneer ze zich aanmelden voor een samenvatting.',
	'ACP_DIGEST_EDIT_SUBSCRIBERS'					=> 'Bewerk abonnees',
	'ACP_DIGEST_EDIT_SUBSCRIBERS_EXPLAIN'			=> 'Deze interface laat je zien wie er wel of niet samenvattingen ontvangt. Je kunt selectief aanmeldingen toevoegen, selectief leden afmelden en de details voor elke sectie van een abonnee aanpassen. Je kunt je ook met de standaardinstellingen inschrijven of alle op deze pagina geselecteerde deelnemers afzetten.',
	'ACP_DIGEST_BALANCE_LOAD'						=> 'Balansbelasting',
	'ACP_DIGEST_BALANCE_LOAD_EXPLAIN'				=> 'Als er te veel digests zijn die tegelijkertijd af gaan en er daardoor prestatieproblemen optreden, zal deze de aanmeldingen in de digest verdelen, zodat er grofweg evenveel digests afgegeven worden, en wel voor elk uur. De tabel hieronder vertoont het huidig ​​aantal digest-aanmeldingen elk uur, na de digest-uur opgegeven in de algemene Digest instellingen. Deze functie actualiseert het tijdstip voor de uitzending tot een minimum. Aanpassingen gebeuren alleen in uren waarin het aantal aanmeldingen hoger is dan de gewone lading, ten opzichte van die uren.',
	'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE'			=> 'Massaal aan- of afmelden',
	'ACP_DIGEST_MASS_SUBSCRIBE_UNSUBSCRIBE_EXPLAIN'	=> 'Deze functie staat het toe dat admins alle forumgasten massaal abonneert of stopt voor digests in één blik. De standaard instellingen voor digests worden bij het instellen gehanteerd. Als er een gast al de configuratie van zijn/haar eigen digests gesteld is dan wordt die setting bewaard wanneer de admin alle deelnemers tegelijk wil configureren. Het is niet deugdelijk te markeren op wat voor forums de genoten erbij geabonneerd worden.',
	'LOG_DELETED_CALENDAR_EVENT'					=> '<strong>Kalenderevenement verwijderd</strong><br />» %s',
	'LOG_DELETED_TOPIC_EVENT'						=> '<strong>Onderwerp Evenement Verwijderd</strong><br />» %s',
	'LOG_DELETED_CALENDAR_EVENTS'					=> '<strong>Herhaalde Kalenderevenementen Verwijderd</strong><br />» %s',
	'LOG_DELETED_TOPIC_EVENTS'						=> '<strong>Herhaalde Onderwerp Evenementen Verwijderd</strong><br />» %s',
	'LOG_DELETED_CALENDAR_EVENT_INSTANCE'			=> '<strong>Terugkerend Geval van Kalenderevenementen Verwijderd</strong><br />» %s',
	'LOG_DELETED_TOPIC_EVENT_INSTANCE'				=> '<strong>Terugkerend Geval van Kalenderevenementen Verwijderd</strong><br />» %s',
	'LOG_EDITED_CALENDAR_EVENT'						=> '<strong>Kalenderevenement Gewijzigd</strong><br />» %s',
	'LOG_EDITED_CALENDAR_EVENTS'					=> '<strong>Herhaalde Kalenderevenementen Gewijzigd</strong><br />» %s',
	'LOG_EDITED_CALENDAR_EVENT_INSTANCE'			=> '<strong>Terugkerend Geval van Kalenderevenementen Gewijzigd</strong><br />» %s',
	'ACP_KB'										=> 'Kennisbank',
	'KB_NAME'										=> 'Kennisbank',
	'ACP_KB_PERMISSIONS'							=> 'Categorie Rechten',
	'ACP_KB_ROLES'									=> 'Kennisbank Rollen',
	'KB_CONFIG'										=> 'Configuratie',
	'TYPES'											=> 'Artikel Types',
	'CATEGORIES'									=> 'Categorieën',
	'ACP_MODS_DATABASE'								=> 'Mods Database',
	'LOG_MOD_DELETE'								=> '<strong>Mod(s) Verwijderd in Mods Database</strong>',
	'LOG_MOD_ADDED'									=> '<strong>Mod Toegevoegd in Mods Database</strong>',
	'LOG_MOD_UPDATED'								=> '<strong>Mod Bijgewerkt in Mods Database</strong>',
	'LOG_MCHAT_TABLE_PRUNED'						=> 'mChat Tabel werd opgeruimd',
	'ACP_USER_MCHAT'								=> 'mChat Instellingen',
	'LOG_DELETED_MCHAT'								=> '<strong>mChat bericht verwijderd</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'								=> '<strong>mChat bericht gewijzigd</strong><br />» %1$s',
));

?>
