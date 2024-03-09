<?php
/**
*
* ucp [Dutch]
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

// Privacy policy and T&C
$lang = array_merge($lang, array(
	'TERMS_OF_USE_CONTENT'	=> 'Door het bezoeken/gebruiken van "%1$s" (in wat volgt wordt hiernaar verwezen als het gaat over "wij", "ons", "onze", "%1$s" of "%2$s"), ga je automatisch akkoord met de volgende voorwaarden. Als je niet akkoord gaat met één van de voorwaarden, bezoek/gebruik "%1$s" dan niet langer. We behouden ons het recht voor om deze voorwaarden op ieder moment te wijzigen en zullen je daar -waar mogelijk- van op de hoogte houden. Het is echter aan te bevelen om regelmatig zelf de voorwaarden te controleren op wijzigingen. Als je niet akkoord gaat met één van de wijzigingen, maak dan niet langer gebruik van "%1$s". Als je wel gebruik blijft maken van "%1$s", ga je automatisch akkoord met de wijzigingen.<br />
	<br />
	Dit forum werkt op basis van phpBB (in wat volgt wordt hiernaar verwezen als het gaat over "zij", "hen", "hun", "phpBB-software", "www.phpbb.com", "phpBB Groep", "phpBB Teams"). Dit is een forumpakket dat is vrijgegeven onder de "<a href="http://www.gnu.org/licenses/gpl.html">General Public License</a>" (of "GPL") en kan worden gedownload op <a href="https://www.phpbb.com/">www.phpbb.com</a>. De phpBB-software vergemakkelijkt alleen discussies via het internet en GPL verbiedt hen tussen te komen in wat wij toestaan en/of verbieden als toelaatbare inhoud en/of gedrag. Voor meer informatie omtrent phpBB, zie: <a href="https://www.phpbb.com/">https://www.phpbb.com/</a>.<br />
	<br />
	Verder verklaar je geen kwetsende, obscene, vulgaire, lasterlijke, haatdragende, bedreigende, racistische, seksueel-georiënteerde of andere inhoud te plaatsen, die in strijd is met internationale wetten, de wetten van je eigen land of het land waar "%1$s" gehost wordt. Als je dit toch doet, kan dit leiden tot een onmiddellijke permanente uitsluiting en waarschuwen we, als we dit nodig vinden, je internetprovider. Je IP-adres wordt bij registratie en iedere post opgeslagen, waardoor we het volgen van de voorwaarden kunnen afdwingen. Je gaat ook akkoord met het feit dat "%1$s" het recht heeft om op ieder moment een onderwerp te verwijderen, verplaatsen of sluiten. Als gebruiker sta je ook toe dat jouw opgegeven informatie in onze database wordt opgeslagen. Deze informatie wordt nooit zonder jouw toestemming aan derden doorgegeven, tenzij een rechter hierom vraagt. Noch "%1$s", noch phpBB zijn verantwoordelijk als je gegevens door een forumhack toch openbaar gemaakt zouden worden.
	',

	'PRIVACY_POLICY'		=> 'Deze beleidsverklaring legt uit hoe "%1$s" en bijhorende instanties (in wat volgt wordt hiernaar verwezen als het gaat over "wij", "ons", "onze", "%1$s", "%2$s") en phpBB (in wat volgt wordt hiernaar verwezen als het gaat over "zij", "hen", "hun", "phpBB-software", "www.phpbb.com", "phpBB Group", "phpBB Teams") omgaan met de informatie die tijdens je gebruikssessie verzameld wordt (dus "jouw informatie").<br />
	<br />
	Je informatie wordt op 2 manieren bijgehouden. Ten eerste door "%1$s" te bezoeken, worden er door de phpBB-software enkele cookies op je computer opgeslagen; dit zijn kleine tekstbestandjes die in de tijdelijke bestanden van je browser worden opgeslagen. De eerste 2 cookies bevatten gebruikersgegevens (de "user-id") en anonieme sessiegegevens (de "session-id"), deze worden automatisch toegewezen door de phpBB-software. Een derde cookie wordt opgeslagen zodra je onderwerpen opent op "%1$s". Deze cookie zegt welke onderwerpen je al gelezen hebt en verhoogt dus het gebruiksgemak.
	<br />
	Mogelijk worden er tijdens het surfen op "%1$s" ook cookies opgeslagen die niet door de phpBB-software aangemaakt werden. Deze vallen buiten dit document omdat ze geen betrekking hebben op de pagina’s die door phpBB gegenereerd worden. De tweede manier waarop we informatie verzamelen is via de gegevens die je naar ons verstuurt. Een paar voorbeelden hiervan zijn: Berichten plaatsen als een anonieme gebruiker (dus "anonieme berichten"), je registreren op "%1$s" (dus "je account") en de berichten die je plaatst nadat je geregistreerd en ingelogd bent (dus "jouw berichten").<br />
	<br />
	Je account bevat minimaal een unieke naam waarmee we je kunnen identificeren (dus "je gebruikersnaam"), een wachtwoord om op je account te kunnen inloggen (dus "je wachtwoord") en een geldig persoonlijk e-mailadres. (dus "je e-mail"). De informatie van je account op "%1$s" is beschermd door de wetten omtrent databescherming van het land waarin dit forum gehost wordt. Alle informatie die nog gevraagd wordt door "%1$s" tijdens het registratieproces, buiten je gebruikersnaam, wachtwoord, e-mailadres, zijn voor het forum niet verplicht, maar optioneel. In elk geval beschik jij over het recht te bepalen welke informatie publiekelijk wordt weergegeven en welke niet. Verder heb je ook de mogelijkheid om in te stellen of je de e-mails die automatisch door de phpBB-software gemaakt worden al dan niet wilt ontvangen.<br />
	<br />
	Je wachtwoord is versleuteld (en kan niet terug leesbaar gemaakt worden), waardoor het op een veilige manier is opgeslagen. Desondanks is het niet aan te raden dat je hetzelfde wachtwoord op een groot aantal websites gebruikt. Je wachtwoord is het middel waarmee je op je account op "%1$s" kunt inloggen; bewaar het dus veilig en link het op geen enkele manier aan "%1$s", phpBB of aan een andere derde partij. Als je het wachtwoord van je account bent vergeten, kun je de "wachtwoord vergeten" optie gebruiken die de phpBB-software voorziet. Dit proces vereist dat je je gebruikersnaam en e-mailadres opgeeft, waarna de phpBB-software een nieuw wachtwoord zal genereren om opnieuw in te loggen. Dit wachtwoord kun je na het inloggen uiteraard weer wijzigen in je profiel.<br />
	',
));

// Common language entries
$lang = array_merge($lang, array(
	'ACCOUNT_ACTIVE'				=> 'Je account is geactiveerd. Bedankt voor het registreren',
	'ACCOUNT_ACTIVE_ADMIN'			=> 'Het account is nu geactiveerd',
	'ACCOUNT_ACTIVE_PROFILE'		=> 'Je account is nu geactiveerd.',
	'ACCOUNT_ADDED'					=> 'Bedankt voor het registreren, je account is aangemaakt. Je kunt nu inloggen met je gebruikersnaam en wachtwoord',
	'ACCOUNT_COPPA'					=> 'Je account is aangemaakt maar moet nog geaccepteerd worden, bekijk je e-mail voor verdere details.',
	'ACCOUNT_EMAIL_CHANGED'			=> 'Je account is bijgewerkt. Je moet echter wel je account opnieuw activeren. Verdere instructies vind je in de e-mail die je zult ontvangen.',
	'ACCOUNT_EMAIL_CHANGED_ADMIN'	=> 'Je account is bijgewerkt, maar moet echter nog wel door een beheerder opnieuw worden geactiveerd. De beheerder is op de hoogte gesteld en je zal een e-mail ontvangen wanneer je account (weer) actief is.',
	'ACCOUNT_INACTIVE'				=> 'Je account is aangemaakt. Dit forum vereist echter accountactivatie, een activatiesleutel is naar het opgegeven e-mailadres gestuurd. Bekijk je e-mail voor verdere informatie',
	'ACCOUNT_INACTIVE_ADMIN'		=> 'Je account is aangemaakt. Dit forum vereist echter accountactivatie door een beheerder. De beheerder is op de hoogte gebracht en je zal een e-mail ontvangen zodra je account geactiveerd is',
	'ACTIVATION_EMAIL_SENT'			=> 'De activatie e-mail is verzonden naar je e-mailadres',
	'ACTIVATION_EMAIL_SENT_ADMIN'	=> 'De activatie e-mail is naar de beheerder(s) verzonden.',
	'ADD'							=> 'Toevoegen',
	'ADD_BCC'						=> '[BCC] toevoegen',
	'ADD_FOES'						=> 'Nieuwe vijanden toevoegen.',
	'ADD_FOES_EXPLAIN'				=> 'Je mag meerdere gebruikersnamen opgeven, 1 gebruiker per regel.',
	'ADD_FOLDER'					=> 'Map toevoegen',
	'ADD_FRIENDS'					=> 'Nieuwe vrienden toevoegen',
	'ADD_FRIENDS_EXPLAIN'			=> 'Je mag meerdere gebruikersnamen opgeven, 1 gebruiker per regel.',
	'ADD_NEW_RULE'					=> 'Nieuwe regel toevoegen.',
	'ADD_RULE'						=> 'Regel toevoegen',
	'ADD_TO'						=> '[Naar] toevoegen',
	'ADD_USERS_UCP_EXPLAIN'			=> 'Hier kun je nieuwe gebruikers aan de groep toevoegen. Je kunt aangeven of deze groep de nieuwe standaardgroep wordt voor de geselecteerde gebruikers. Plaats elke gebruikersnaam op een nieuwe regel.',
	'ADMIN_EMAIL'					=> 'Beheerders mogen mij per e-mail informeren.',
	'AGREE'							=> 'Ik ga akkoord met de voorwaarden.',
	'ALLOW_PM'						=> 'Gebruikers mogen mij privéberichten (PB) sturen',
	'ALLOW_PM_EXPLAIN'				=> 'Beheerders en moderators kunnen je echter altijd berichten sturen.',
	'ALREADY_ACTIVATED'				=> 'Je account is al geactiveerd.',
	'ATTACHMENTS_EXPLAIN'			=> 'Dit is een lijst van de bijlage(n) die je in dit forum hebt geplaatst.',
	'ATTACHMENTS_DELETED'			=> 'De bijlagen zijn verwijderd.',
	'ATTACHMENT_DELETED'			=> 'De bijlage is verwijderd.',
	'AVATAR_CATEGORY'				=> 'Categorie',
	'AVATAR_EXPLAIN'				=> 'Maximale afmetingen; breedte: %1$d pixels, hoogte: %2$d pixels, bestandsgrootte: %3$.2f KiB.',
	'AVATAR_FEATURES_DISABLED'		=> 'De avatarmogelijkheid is uitgeschakeld.',
	'AVATAR_GALLERY'				=> 'Lokale galerij',
	'AVATAR_GENERAL_UPLOAD_ERROR'	=> 'De avatar kon niet naar %s worden geüpload',
	'AVATAR_NOT_ALLOWED'			=> 'Je avatar kan niet worden getoond, omdat avatars momenteel niet zijn toegestaan.',
	'AVATAR_PAGE'					=> 'Pagina',
	'AVATAR_TYPE_NOT_ALLOWED'		=> 'Je huidige avatar kan niet worden weergegeven, omdat het type niet is toegestaan.',

	'BACK_TO_DRAFTS'			=> 'Terug naar opgeslagen concepten',
	'BACK_TO_LOGIN'				=> 'Terug naar loginscherm',
	'BIRTHDAY'					=> 'Verjaardag',
	'BIRTHDAY_EXPLAIN'			=> 'Door je geboortejaar op te geven, wordt je leeftijd weergegeven als je jarig bent.',
	'BOARD_DATE_FORMAT'			=> 'Mijn datumweergave',
	'BOARD_DATE_FORMAT_EXPLAIN'	=> 'Deze gebruikte syntax is identiek aan de PHP <a href="http://www.php.net/date">date()</a> functie',
	'BOARD_DST'					=> 'Zomertijd is in gebruik',
	'BOARD_LANGUAGE'			=> 'Mijn taal',
	'BOARD_STYLE'				=> 'Mijn forumstijl',
	'BOARD_TIMEZONE'			=> 'Mijn tijdzone',
	'BOOKMARKS'					=> 'Bladwijzers',
	'BOOKMARKS_EXPLAIN'			=> 'Je kunt onderwerpen aan je bladwijzers toevoegen om later naar te verwijzen. Vink de checkboxen aan bij de bladwijzers die je wilt verwijderen. Klik daarna op de <em>verwijder gemarkeerde bladwijzers</em> knop.',
	'BOOKMARKS_DISABLED'		=> 'Bladwijzers zijn uitgeschakeld.',
	'BOOKMARKS_REMOVED'			=> 'Bladwijzers verwijderd',

	'CANNOT_EDIT_MESSAGE_TIME'	=> 'Je kunt dit bericht niet meer bewerken of verwijderen.',
	'CANNOT_MOVE_TO_SAME_FOLDER'=> 'Berichten kunnen niet naar de map worden verplaatst die je wilt verwijderen.',
	'CANNOT_MOVE_FROM_SPECIAL'	=> 'Berichten in Postvak UIT kunnen niet worden verplaatst.',
	'CANNOT_RENAME_FOLDER'		=> 'De mapnaam kan niet worden gewijzigd.',
	'CANNOT_REMOVE_FOLDER'		=> 'De map kan niet worden verwijderd.',
	'CHANGE_DEFAULT_GROUP'		=> 'Wijzig standaardgroep',
	'CHANGE_PASSWORD'			=> 'Wachtwoord wijzigen',
	'CLICK_GOTO_FOLDER'			=> '%1$sGa naar je “%3$s” map%2$s',
	'CLICK_RETURN_FOLDER'		=> '%1$sGa terug naar jouw "%3$s" map%2$s',
	'CONFIRMATION'				=> 'Bevestiging van registratie',
	'CONFIRM_CHANGES'			=> 'Wijzigingen bevestigen',
	'CONFIRM_EMAIL'				=> 'Bevestig e-mailadres',
	'CONFIRM_EMAIL_EXPLAIN'		=> 'Alleen invullen als je je e-mailadres wilt wijzigen.',
	'CONFIRM_EXPLAIN'			=> 'Om automatische registraties tegen te gaan, vereist de beheerder dat je de bevestigingscode invult. De code wordt hieronder in een afbeelding weergegeven. Als je visuele problemen hebt, of om een andere reden de code niet kunt lezen en/of zien, contacteer dan de %sbeheerder%s.',
	'VC_REFRESH'				=> 'Bevestigingscode vernieuwen',
	'VC_REFRESH_EXPLAIN'		=> 'Indien je de code niet kunt lezen, kun je een nieuwe krijgen door op de knop te klikken.',

	'CONFIRM_PASSWORD'			=> 'Wachtwoord bevestigen',
	'CONFIRM_PASSWORD_EXPLAIN'	=> 'Je moet je wachtwoord alleen bevestigen indien je het gewijzigd hebt',
	'COPPA_BIRTHDAY'			=> 'Om verder te kunnen gaan met het registratieproces dien je je geboortedatum op te geven.',
	'COPPA_COMPLIANCE'			=> 'COPPA naleven',
	'COPPA_EXPLAIN'				=> 'Houd rekening met het feit dat als je op verzenden klikt, je account wel wordt aangemaakt, maar deze niet geactiveerd kan worden tot een ouder of voogd je registratie goedkeurt. Je ontvangt via e-mail een kopie van het benodigde formulier en details waar je het naar moet opsturen.',
	'CREATE_FOLDER'				=> 'Map toevoegen…',
	'CURRENT_IMAGE'				=> 'Huidige afbeelding',
	'CURRENT_PASSWORD'			=> 'Huidig wachtwoord',
	'CURRENT_PASSWORD_EXPLAIN'	=> 'Je moet je wachtwoord bevestigen als je je e-mailadres of gebruikersnaam wilt wijzigen.',
	'CURRENT_CHANGE_PASSWORD_EXPLAIN' => 'Om je wachtwoord, e-mailadres of gebruikersnaam te wijzigen moet je je huidige wachtwoord opgeven.',
	'CUR_PASSWORD_EMPTY'		=> 'Je hebt geen wachtwoord ingevuld.',
	'CUR_PASSWORD_ERROR'		=> 'Het opgegeven huidige wachtwoord is onjuist.',
	'CUSTOM_DATEFORMAT'			=> 'Standaard…',

	'DEFAULT_ACTION'			=> 'Standaardactie',
	'DEFAULT_ACTION_EXPLAIN'	=> 'Deze actie zal worden uitgevoerd als de anderen niet mogelijk zijn',
	'DEFAULT_ADD_SIG'			=> 'Voeg standaard mijn onderschrift toe',
	'DEFAULT_BBCODE'			=> 'Schakel BBCode in',
	'DEFAULT_NOTIFY'			=> 'Waarschuw mij bij antwoorden',
	'DEFAULT_SMILIES'			=> 'Schakel smilies in',
	'DEFINED_RULES'				=> 'Gedefinieerde regels',
	'DELETED_TOPIC'				=> 'Onderwerp is verwijderd',
	'DELETE_ATTACHMENT'			=> 'Verwijder bijlage',
	'DELETE_ATTACHMENTS'		=> 'Verwijder bijlagen',
	'DELETE_ATTACHMENT_CONFIRM'	=> 'Weet je zeker dat je de bijlage wilt verwijderen?',
	'DELETE_ATTACHMENTS_CONFIRM'=> 'Weet je zeker dat je de bijlagen wilt verwijderen?',
	'DELETE_AVATAR'				=> 'Afbeelding verwijderen',
	'DELETE_COOKIES_CONFIRM'	=> 'Weet je zeker dat je alle cookies van het forum wilt verwijderen?',
	'DELETE_MARKED_PM'			=> 'Verwijder gemarkeerde berichten',
	'DELETE_MARKED_PM_CONFIRM'	=> 'Weet je zeker dat je de gemarkeerde berichten wilt verwijderen?',
	'DELETE_OLDEST_MESSAGES'	=> 'Verwijder oudste berichten',
	'DELETE_MESSAGE'			=> 'Verwijder bericht',
	'DELETE_MESSAGE_CONFIRM'	=> 'Weet je zeker dat je dit privébericht wilt verwijderen?',
	'DELETE_MESSAGES_IN_FOLDER'	=> 'Verwijder alle berichten uit de verwijderde map',
	'DELETE_RULE'				=> 'Verwijder regel',
	'DELETE_RULE_CONFIRM'		=> 'Weet je zeker dat je deze regel wilt verwijderen?',
	'DEMOTE_SELECTED'			=> 'Degradeer geselecteerde(n)',
	'DISABLE_CENSORS'			=> 'Censuur inschakelen',
	'DISPLAY_GALLERY'			=> 'Galerij weergeven',
	'DOMAIN_NO_MX_RECORD_EMAIL'	=> 'Het ingevulde e-maildomein heeft geen geldig MX-record.',
	'DOWNLOADS'					=> 'Downloads',
	'DRAFTS_DELETED'			=> 'Alle geselecteerde concepten zijn succesvol verwijderd.',
	'DRAFTS_EXPLAIN'			=> 'Hier kun je concepten bekijken, bewerken en verwijderen.',
	'DRAFT_UPDATED'				=> 'Concept succesvol gewijzigd.',

	'EDIT_DRAFT_EXPLAIN'		=> 'Hier kun je je concept bewerken. Concepten bevatten geen bijlage(n) en/of poll informatie.',
	'EMAIL_BANNED_EMAIL'		=> 'Het opgegeven e-mailadres kan niet worden gebruikt.',
	'EMAIL_REMIND'				=> 'Dit moet het e-mailadres zijn dat je bij je account hebt opgegeven. Als je dit niet hebt veranderd in het gebruikerspaneel, dan is dit het e-mailadres dat je bij je registratie hebt gebruikt.',
	'EMAIL_TAKEN_EMAIL'			=> 'Het opgegeven e-mailadres is reeds in gebruik.',
	'EMPTY_DRAFT'				=> 'Je moet een bericht opgeven om je wijzigingen op te slaan',
	'EMPTY_DRAFT_TITLE'			=> 'Je moet een titel voor het concept opgeven',
	'EXPORT_AS_XML'				=> 'Exporteren als XML',
	'EXPORT_AS_CSV'				=> 'Exporteren als CSV',
	'EXPORT_AS_CSV_EXCEL'		=> 'Exporteren als CSV (Excel)',
	'EXPORT_AS_TXT'				=> 'Exporteren als TXT',
	'EXPORT_AS_MSG'				=> 'Exporteren als MSG',
	'EXPORT_FOLDER'				=> 'Exporteer deze weergave',

	'FIELD_REQUIRED'					=> 'Het veld "%s" moet ingevuld zijn',
	'FIELD_TOO_SHORT'					=> 'Het veld "%1$s" is te kort, er zijn minimaal %2$d tekens vereist.',
	'FIELD_TOO_LONG'					=> 'Het veld "%1$s" is te lang, er zijn maximaal %2$d tekens toegestaan.',
	'FIELD_TOO_SMALL'					=> 'De waarde van "%1$s" is te klein, een minimale waarde van %2$d is vereist.',
	'FIELD_TOO_LARGE'					=> 'De waarde van "%1$s" is te groot, een maximale waarde van %2$d is toegestaan.',
	'FIELD_INVALID_CHARS_NUMBERS_ONLY'	=> 'Het veld "%s" bevat ongeldige tekens, alleen cijfers zijn toegestaan.',
	'FIELD_INVALID_CHARS_ALPHA_ONLY'	=> 'Het veld "%s" bevat ongeldige tekens, alleen letters zijn cijfers zijn toegestaan.',
	'FIELD_INVALID_CHARS_SPACERS_ONLY'	=> 'Het veld "%s" bevat ongeldige tekens, alleen letters, cijfers, spaties en -+_[] zijn toegestaan.',
	'FIELD_INVALID_DATE'				=> 'Het veld "%s" bevat een ongeldige datum.',
	'FIELD_INVALID_VALUE'				=> 'Het veld “%s” bevat een ongeldige waarde.',

	'FOE_MESSAGE'				=> 'Bericht van vijand',
	'FOES_EXPLAIN'				=> 'Vijanden zijn gebruikers die je standaard negeert. Berichten van vijanden worden niet volledig getoond, privéberichten van vijanden komen echter wel aan. Let op: Het is niet mogelijk om moderators of beheerders te negeren.',
	'FOES_UPDATED'				=> 'Je vijandenlijst is bijgewerkt',
	'FOLDER_ADDED'				=> 'Map aangemaakt',
	'FOLDER_MESSAGE_STATUS'		=> '%1$d van de %2$d berichten opgeslagen',
	'FOLDER_NAME_EMPTY'			=> 'Je moet een naam voor deze map opgeven.',
	'FOLDER_NAME_EXIST'			=> 'De map <strong>%s</strong> bestaat reeds',
	'FOLDER_OPTIONS'			=> 'Mapinstellingen',
	'FOLDER_RENAMED'			=> 'De map is hernoemt',
	'FOLDER_REMOVED'			=> 'De map is verwijderd',
	'FOLDER_STATUS_MSG'			=> 'Map %1$d%% vol (%2$d van de %3$d berichten opgeslagen)',
	'FORWARD_PM'				=> 'PB doorsturen',
	'FORCE_PASSWORD_EXPLAIN'	=> 'Voordat je verder kunt gaan op het forum, moet je je wachtwoord wijzigen',
	'FRIEND_MESSAGE'			=> 'Bericht van vriend',
	'FRIENDS'					=> 'Vrienden',
	'FRIENDS_EXPLAIN'			=> 'Vrienden zijn gebruikers waar je vaak mee communiceert. Als je stijl het ondersteunt, worden berichten van vrienden gemarkeerd.',
	'FRIENDS_OFFLINE'			=> 'Offline',
	'FRIENDS_ONLINE'			=> 'Online',
	'FRIENDS_UPDATED'			=> 'Je vriendenlijst is bijgewerkt',
	'FULL_FOLDER_OPTION_CHANGED'=> 'De map-instellingen zijn gewijzigd',
	'FWD_ORIGINAL_MESSAGE'		=> '-------- Origineel bericht --------',
	'FWD_SUBJECT'				=> 'Onderwerp: %s',
	'FWD_DATE'					=> 'Datum: %s',
	'FWD_FROM'					=> 'Van: %s',
	'FWD_TO'					=> 'Naar: %s',

	'GLOBAL_ANNOUNCEMENT'		=> 'Globale mededeling',

	'HIDE_ONLINE'				=> 'Onzichtbaar als ik online ben',
	'HIDE_ONLINE_EXPLAIN'		=> 'De wijzing wordt actief zodra je opnieuw inlogt.',
	'HOLD_NEW_MESSAGES'			=> 'Accepteer geen nieuwe berichten (nieuwe berichten worden bewaard tot er voldoende ruimte beschikbaar is)',
	'HOLD_NEW_MESSAGES_SHORT'	=> 'Nieuwe berichten worden bewaard.',

	'IF_FOLDER_FULL'			=> 'Als de map vol is',
	'IMPORTANT_NEWS'			=> 'Belangrijke mededelingen',
	'INVALID_USER_BIRTHDAY'		=> 'De ingevoerde geboortedatum is geen geldige datum.',
	'INVALID_CHARS_USERNAME'	=> 'De gebruikersnaam bevat niet-toegestane karakters.',
	'INVALID_CHARS_NEW_PASSWORD'=> 'Het wachtwoord bevat niet de verplichte karakters.',
	'ITEMS_REQUIRED'			=> 'De velden gemarkeerd met een * zijn verplicht en moeten worden ingevuld',

	'JOIN_SELECTED'				=> 'Aansluiten bij geselecteerde(n)',

	'LANGUAGE'					=> 'Taal',
	'LINK_REMOTE_AVATAR'		=> 'Externe avatar',
	'LINK_REMOTE_AVATAR_EXPLAIN'=> 'Geef de URL op van de avatar die je wilt gebruiken.',
	'LINK_REMOTE_SIZE'			=> 'Avatar afmetingen',
	'LINK_REMOTE_SIZE_EXPLAIN'	=> 'Geef de breedte en hoogte van de afbeelding op, of laat deze leeg om ze automatisch vast te stellen.',
	'LOGIN_EXPLAIN_UCP'			=> 'Log in om naar het gebruikerspaneel te gaan',
	'LOGIN_REDIRECT'			=> 'Je bent nu ingelogd.',
	'LOGOUT_FAILED'				=> 'Het uitloggen is mislukt wegens een sessieprobleem.',
	'LOGOUT_REDIRECT'			=> 'Je bent nu uitgelogd.',

	'MARK_IMPORTANT'				=> 'Markeer als belangrijk',
	'MARKED_MESSAGE'				=> 'Gemarkeerde berichten',
	'MAX_FOLDER_REACHED'			=> 'Het maximaal aantal persoonlijke mappen is bereikt',
	'MESSAGE_BY_AUTHOR'				=> 'door',
	'MESSAGE_COLOURS'				=> 'Bericht kleuren',
	'MESSAGE_DELETED'				=> 'Bericht verwijderd',
	'MESSAGE_EDITED'				=> 'Bericht gewijzigd',
	'MESSAGE_HISTORY'				=> 'Berichtgeschiedenis',
	'MESSAGE_REMOVED_FROM_OUTBOX'	=> 'Dit bericht is door de auteur verwijderd.',
	'MESSAGE_SENT_ON'				=> 'op',
	'MESSAGE_STORED'				=> 'Je bericht is verzonden',
	'MESSAGE_TO'					=> 'Naar',
	'MESSAGES_DELETED'				=> 'Berichten verwijderd',
	'MOVE_DELETED_MESSAGES_TO'		=> 'Verplaats de berichten van de verwijderde map naar',
	'MOVE_DOWN'						=> 'Verplaats naar onderen',
	'MOVE_MARKED_TO_FOLDER'			=> 'Verplaats gemarkeerde(n) naar %s',
	'MOVE_PM_ERROR'					=> 'Er is een fout opgetreden tijdens het verplaatsen van de berichten, maar %1$d van de %2$d berichten zijn verplaatst.',
	'MOVE_TO_FOLDER'				=> 'Verplaats naar map',
	'MOVE_UP'						=> 'Verplaats naar boven',

	'NEW_EMAIL_CONFIRM_EMPTY'		=> 'Je hebt de bevestiging van het e-mailadres niet ingevuld.',
	'NEW_EMAIL_ERROR'				=> 'De opgegeven e-mailadressen komen niet overeen.',
	'NEW_FOLDER_NAME'				=> 'Nieuwe mapnaam',
	'NEW_PASSWORD'					=> 'Wachtwoord',
	'NEW_PASSWORD_CONFIRM_EMPTY'	=> 'Je hebt de bevestiging van het wachtwoord niet ingevuld.',
	'NEW_PASSWORD_ERROR'			=> 'De opgegeven wachtwoorden komen niet overeen.',
	'NOTIFY_METHOD'					=> 'Breng me op de hoogte via',
	'NOTIFY_METHOD_BOTH'			=> 'Beiden',
	'NOTIFY_METHOD_EMAIL'			=> 'Alleen e-mail',
	'NOTIFY_METHOD_EXPLAIN'			=> 'Methode om berichten via dit forum te versturen.',
	'NOTIFY_METHOD_IM'				=> 'Alleen Jabber',
	'NOTIFY_ON_PM'					=> 'Breng me op de hoogte van nieuwe privéberichten',
	'NOT_ADDED_FRIENDS_ANONYMOUS'	=> 'Je kunt de anonieme gebruiker niet aan je vriendenlijst toevoegen.',
	'NOT_ADDED_FRIENDS_BOTS'		=> 'Je kunt bots niet aan je vriendenlijst toevoegen.',
	'NOT_ADDED_FRIENDS_FOES'		=> 'Je kunt geen gebruikers uit je vijandenlijst aan je vriendenlijst toevoegen',
	'NOT_ADDED_FRIENDS_SELF'		=> 'Je kunt jezelf niet aan je vriendenlijst toevoegen',
	'NOT_ADDED_FOES_MOD_ADMIN'		=> 'Je kunt geen moderators of beheerders aan je vijandenlijst toevoegen.',
	'NOT_ADDED_FOES_ANONYMOUS'		=> 'Je kunt de anonieme gebruiker niet aan je vijandenlijst toevoegen.',
	'NOT_ADDED_FOES_BOTS'			=> 'Je kunt bots niet aan je vijandenlijst toevoegen.',
	'NOT_ADDED_FOES_FRIENDS'		=> 'Je kunt geen gebruikers uit je vriendenlijst aan je vijandenlijst toevoegen.',
	'NOT_ADDED_FOES_SELF'			=> 'Je kunt jezelf niet aan je vijandenlijst toevoegen.',
	'NOT_AGREE'						=> 'Ik ga niet akkoord met de voorwaarden.',
	'NOT_ENOUGH_SPACE_FOLDER'		=> 'De doelmap "%s" is vol. De gevraagde actie is daarom niet uitgevoerd.',
	'NOT_MOVED_MESSAGE'				=> 'Er wordt 1 privébericht achtergehouden omdat de map vol is.',
	'NOT_MOVED_MESSAGES'			=> 'Er worden %d privéberichten achtergehouden omdat de map vol is.',
	'NO_ACTION_MODE'				=> 'Er werd geen berichtactie opgegeven.',
	'NO_AUTHOR'						=> 'Er is geen auteur voor dit bericht opgegeven.',
	'NO_AVATAR_CATEGORY'			=> 'Geen',

	'NO_AUTH_DELETE_MESSAGE'		=> 'Je kunt geen privéberichten verwijderen.',
	'NO_AUTH_EDIT_MESSAGE'			=> 'Je mag privéberichten niet wijzigen.',
	'NO_AUTH_FORWARD_MESSAGE'		=> 'Je mag geen privéberichten doorsturen.',
	'NO_AUTH_GROUP_MESSAGE'			=> 'Je mag geen privéberichten naar groep(en) sturen.',
	'NO_AUTH_PASSWORD_REMINDER'		=> 'Je mag geen nieuw wachtwoord aanvragen.',
	'NO_AUTH_READ_HOLD_MESSAGE'		=> 'Je mag geen privéberichten lezen die in de wacht staan.',
	'NO_AUTH_READ_MESSAGE'			=> 'Je mag geen privéberichten lezen.',
	'NO_AUTH_READ_REMOVED_MESSAGE'	=> 'Je kunt het bericht niet lezen omdat het door de auteur is verwijderd.',
	'NO_AUTH_SEND_MESSAGE'			=> 'Je mag geen privéberichten versturen.',
	'NO_AUTH_SIGNATURE'				=> 'Je mag geen onderschrift instellen.',

	'NO_BCC_RECIPIENT'			=> 'Geen',
	'NO_BOOKMARKS'				=> 'Je hebt geen bladwijzers.',
	'NO_BOOKMARKS_SELECTED'		=> 'Je hebt geen bladwijzers geselecteerd.',
	'NO_EDIT_READ_MESSAGE'		=> 'Het privébericht kan niet worden gewijzigd omdat het al is gelezen.',
	'NO_EMAIL_USER'				=> 'De opgegeven e-mail/gebruikersnaam informatie kon niet worden gevonden.',
	'NO_FOES'					=> 'Er zijn geen vijanden',
	'NO_FRIENDS'				=> 'Er zijn geen vrienden',
	'NO_FRIENDS_OFFLINE'		=> 'Geen offline vrienden',
	'NO_FRIENDS_ONLINE'			=> 'Geen online vrienden',
	'NO_GROUP_SELECTED'			=> 'Er is geen groep opgegeven',
	'NO_IMPORTANT_NEWS'			=> 'Er zijn geen belangrijke mededelingen.',
	'NO_MESSAGE'				=> 'Het privébericht kon niet worden gevonden.',
	'NO_NEW_FOLDER_NAME'		=> 'Je moet een nieuwe mapnaam opgeven.',
	'NO_NEWER_PM'				=> 'Er zijn geen nieuwere berichten.',
	'NO_OLDER_PM'				=> 'Er zijn geen oudere berichten.',
	'NO_PASSWORD_SUPPLIED'		=> 'Je kunt niet inloggen zonder wachtwoord.',
	'NO_RECIPIENT'				=> 'Er zijn geen ontvangers opgegeven.',
	'NO_RULES_DEFINED'			=> 'Er zijn geen regels gedefinieerd.',
	'NO_SAVED_DRAFTS'			=> 'Er zijn geen opgeslagen concepten.',
	'NO_TO_RECIPIENT'			=> 'Geen',
	'NO_WATCHED_FORUMS'			=> 'Je hebt geen forum-abonnementen.',
	'NO_WATCHED_SELECTED'		=> 'Je hebt geen forum- of onderwerp-abonnementen geselecteerd.',
	'NO_WATCHED_TOPICS'			=> 'Je hebt geen onderwerp-abonnementen.',

	'PASS_TYPE_ALPHA_EXPLAIN'	=> 'Het wachtwoord moet tussen de %1$d en %2$d tekens lang zijn en moet zowel hoofdletters, kleine letters, als cijfers bevatten',
	'PASS_TYPE_ANY_EXPLAIN'		=> 'Moet tussen %1$d en %2$d tekens lang zijn.',
	'PASS_TYPE_CASE_EXPLAIN'	=> 'Het wachtwoord moet tussen %1$d en %2$d tekens lang zijn en moet zowel hoofdletters als kleine letters bevatten.',
	'PASS_TYPE_SYMBOL_EXPLAIN'	=> 'Het wachtwoord moet tussen %1$d en %2$d tekens lang zijn en moet zowel hoofdletters als kleine en symbolen bevatten.',
	'PASSWORD'					=> 'Wachtwoord',
	'PASSWORD_ACTIVATED'		=> 'Je nieuwe wachtwoord is geactiveerd.',
	'PASSWORD_UPDATED'			=> 'Er is een nieuw wachtwoord verzonden naar het e-mailadres dat je in je profiel hebt opgegeven.',
	'PERMISSIONS_RESTORED'		=> 'Permissies succesvol teruggezet.',
	'PERMISSIONS_TRANSFERRED'	=> 'Permissies succesvol overgezet naar <strong>%s</strong>. Je kunt nu met de permissies van deze gebruiker door het forum bladeren.<br />Vergeet niet dat de beheerderspermissies niet zijn meegegeven. Je kunt op elk moment terug keren naar je eigen permissies.',
	'PM_DISABLED'				=> 'Privéberichten zijn uitgeschakeld.',
	'PM_FROM'					=> 'Van',
	'PM_FROM_REMOVED_AUTHOR'	=> 'Dit bericht is verstuurd door een gebruiker die niet meer is geregistreerd.',
	'PM_ICON'					=> 'PB-icoon',
	'PM_INBOX'					=> 'Postvak IN',
	'PM_NO_USERS'				=> 'De toe te voegen gebruikers bestaan niet (meer).',
	'PM_OUTBOX'					=> 'Postvak UIT',
	'PM_SENTBOX'				=> 'Verzonden berichten',
	'PM_SUBJECT'				=> 'Onderwerp',
	'PM_TO'						=> 'Stuur naar',
	'PM_USERS_REMOVED_NO_PM'	=> 'Enkele gebruikers konden niet worden toegevoegd, omdat ze hun PB-functie hebben uitgeschakeld.',
	'POPUP_ON_PM'				=> 'Pop-upvenster bij een nieuw privébericht',
	'POST_EDIT_PM'				=> 'Wijzig bericht',
	'POST_FORWARD_PM'			=> 'Bericht doorsturen',
	'POST_NEW_PM'				=> 'Plaats bericht',
	'POST_PM_LOCKED'			=> 'Privéberichten zijn gesloten.',
	'POST_PM_POST'				=> 'Citeer bericht',
	'POST_QUOTE_PM'				=> 'Citeer bericht',
	'POST_REPLY_PM'				=> 'Reageer op bericht',
	'PRINT_PM'					=> 'Afdrukweergave',
	'PREFERENCES_UPDATED'		=> 'Je instellingen zijn bijgewerkt.',
	'PROFILE_INFO_NOTICE'		=> 'Vergeet niet dat deze informatie zichtbaar is voor de andere leden, dus wees voorzichtig met het invullen van je persoonlijke gegevens. Alle velden met een * moeten worden ingevuld.',
	'PROFILE_UPDATED'			=> 'Je profiel is bijgewerkt.',

	'RECIPIENT'							=> 'Ontvanger',
	'RECIPIENTS'						=> 'Ontvangers',
	'REGISTRATION'						=> 'Registratie',
	'RELEASE_MESSAGES'					=> '%sGeef alle ingehouden berichten vrij%s… Ze zullen in de opgegeven map worden gesorteerd zodra er voldoende ruimte beschikbaar is.',
	'REMOVE_ADDRESS'					=> 'Verwijder adres',
	'REMOVE_SELECTED_BOOKMARKS'			=> 'Verwijder geselecteerde bladwijzer',
	'REMOVE_SELECTED_BOOKMARKS_CONFIRM'	=> 'Weet je zeker dat je alle geselecteerde bladwijzers wilt verwijderen?',
	'REMOVE_BOOKMARK_MARKED'			=> 'Verwijder gemarkeerde bladwijzers.',
	'REMOVE_FOLDER'						=> 'Verwijder map',
	'REMOVE_FOLDER_CONFIRM'				=> 'Weet je zeker dat je deze map wilt verwijderen?',
	'RENAME'							=> 'Hernoem',
	'RENAME_FOLDER'						=> 'Hernoem map',
	'REPLIED_MESSAGE'					=> 'Gereageerd op bericht',
	'REPLY_TO_ALL'						=> 'Beantwoord de afzender en alle ontvangers.',
	'REPORT_PM'							=> 'Meld privébericht',
	'RESIGN_SELECTED'					=> 'Afmelden geselecteerd',
	'RETURN_FOLDER'						=> '%1$sKeer terug naar de vorige map%2$s',
	'RETURN_UCP'						=> '%sKeer terug naar het gebruikerspaneel%s',
	'RULE_ADDED'						=> 'Regel is toegevoegd',
	'RULE_ALREADY_DEFINED'				=> 'Deze regel is al opgegeven.',
	'RULE_DELETED'						=> 'Regel verwijderd',
	'RULE_NOT_DEFINED'					=> 'Regel niet goed opgegeven.',
	'RULE_LIMIT_REACHED'				=> 'Je hebt het maximaal aantal regels voor privéberichten bereikt. Je kan niet meer regels opgeven.',
	'RULE_REMOVED_MESSAGE'				=> 'Een privébericht is door de privéberichten-filters verwijderd.',
	'RULE_REMOVED_MESSAGES'				=> '%d privéberichten zijn door de privéberichten-filters verwijderd.',

	'SAME_PASSWORD_ERROR'		=> 'Het nieuwe wachtwoord mag niet hetzelfde zijn als je huidige wachtwoord.',
	'SEARCH_YOUR_POSTS'			=> 'Toon je berichten',
	'SEND_PASSWORD'				=> 'Stuur wachtwoord',
	'SENT_AT'					=> 'Verstuurd',			// Used before dates in private messages
	'SHOW_EMAIL'				=> 'Gebruikers mogen per e-mail contact met mij opnemen.',
	'SIGNATURE_EXPLAIN'			=> 'Een stukje tekst die je optioneel aan al je berichten kunt toevoegen. Er is een limiet van %d tekens.',
	'SIGNATURE_PREVIEW'			=> 'Je onderschrift zal op deze wijze onder je berichten worden toegevoegd.',
	'SIGNATURE_TOO_LONG'		=> 'Je onderschrift is te lang.',
	'SORT'						=> 'Sorteer',
	'SORT_COMMENT'				=> 'Bestandsreactie',
	'SORT_DOWNLOADS'			=> 'Downloads',
	'SORT_EXTENSION'			=> 'Extensie',
	'SORT_FILENAME'				=> 'Bestandsnaam',
	'SORT_POST_TIME'			=> 'Berichttijd',
	'SORT_SIZE'					=> 'Bestandsgrootte',

	'TIMEZONE'					=> 'Tijdszone',
	'TO'						=> 'Naar',
	'TOO_MANY_RECIPIENTS'		=> 'Teveel ontvangers',
	'TOO_MANY_REGISTERS'		=> 'Je hebt het maximaal aantal registratie-pogingen in deze sessie bereikt. Probeer het later nog eens.',

	'UCP'						=> 'Gebruikerspaneel',
	'UCP_ACTIVATE'				=> 'Account activeren',
	'UCP_ADMIN_ACTIVATE'		=> 'Je dient een geldig e-mailadres op te geven om je account te kunnen activeren. Het beheer zal je registratie controleren en bij goedkeuring krijg je een e-mail op het opgegeven adres.',
	'UCP_AIM'					=> 'AOL Instant Messenger',
	'UCP_ATTACHMENTS'			=> 'Bijlagen',
	'UCP_COPPA_BEFORE'			=> 'Voor %s',
	'UCP_COPPA_ON_AFTER'		=> 'Op of na %s',
	'UCP_EMAIL_ACTIVATE'		=> 'Je dient een geldig e-mailadres op te geven om je account te activeren. Je ontvangt op dat adres een e-mail met daarin een activatielink.',
	'UCP_ICQ'					=> 'ICQ-nummer',
	'UCP_JABBER'				=> 'Jabber-adres',

	'UCP_MAIN'					=> 'Overzicht',
	'UCP_MAIN_ATTACHMENTS'		=> 'Bijlagenbeheer',
	'UCP_MAIN_BOOKMARKS'		=> 'Bladwijzerbeheer',
	'UCP_MAIN_DRAFTS'			=> 'Conceptenbeheer',
	'UCP_MAIN_FRONT'			=> 'Hoofdpagina',
	'UCP_MAIN_SUBSCRIBED'		=> 'Abonnementenbeheer',

	'UCP_MSNM'					=> 'Windows Live Messenger',
	'UCP_NO_ATTACHMENTS'		=> 'Je hebt geen bestanden geplaatst.',

	'UCP_PREFS'					=> 'Foruminstellingen',
	'UCP_PREFS_PERSONAL'		=> 'Wijzig persoonlijke instellingen',
	'UCP_PREFS_POST'			=> 'Wijzig berichtstandaarden',
	'UCP_PREFS_VIEW'			=> 'Wijzig weergave-instellingen',

	'UCP_PM'					=> 'Privéberichten',
	'UCP_PM_COMPOSE'			=> 'Schrijf bericht',
	'UCP_PM_DRAFTS'				=> 'Concepten',
	'UCP_PM_OPTIONS'			=> 'Opties',
	'UCP_PM_POPUP'				=> 'Privéberichten',
	'UCP_PM_POPUP_TITLE'		=> 'Privéberichten pop-up',
	'UCP_PM_UNREAD'				=> 'Ongelezen',
	'UCP_PM_VIEW'				=> 'Toon berichten',

	'UCP_PROFILE'				=> 'Profiel',
	'UCP_PROFILE_AVATAR'		=> 'Wijzig avatar',
	'UCP_PROFILE_PROFILE_INFO'	=> 'Wijzig profiel',
	'UCP_PROFILE_REG_DETAILS'	=> 'Wijzig registratiedetails',
	'UCP_PROFILE_SIGNATURE'		=> 'Wijzig onderschrift',

	'UCP_USERGROUPS'			=> 'Gebruikersgroepen',
	'UCP_USERGROUPS_MEMBER'		=> 'Lidmaatschappen',
	'UCP_USERGROUPS_MANAGE'		=> 'Groepenbeheer',

	'UCP_REGISTER_DISABLE'			=> 'Het is momenteel niet mogelijk om een nieuw account aan te maken.',
	'UCP_REMIND'					=> 'Wachtwoord sturen',
	'UCP_RESEND'					=> 'Activatie e-mail sturen',
	'UCP_WELCOME'					=> 'Welkom in het gebruikerspaneel. Van hieruit kun je je persoonlijke instellingen en voorkeuren beheren, zoals het bekijken of wijzigen van je profiel en abonnementen op forums en onderwerpen. Je kunt ook berichten sturen naar andere gebruikers (mits toegestaan). Wees er zeker van dat je eerst alle mededelingen leest.',
	'UCP_YIM'						=> 'Yahoo Messenger',
	'UCP_ZEBRA'						=> 'Vrienden en vijanden',
	'UCP_ZEBRA_FOES'				=> 'Vijanden',
	'UCP_ZEBRA_FRIENDS'				=> 'Vrienden',
	'UNDISCLOSED_RECIPIENT'			=> 'Onbekende ontvanger',
	'UNKNOWN_FOLDER'				=> 'Onbekende map',
	'UNWATCH_MARKED'				=> 'Verwijder gemarkeerde abonnementen',
	'UPLOAD_AVATAR_FILE'			=> 'Upload van je computer',
	'UPLOAD_AVATAR_URL'				=> 'Upload van een webpagina',
	'UPLOAD_AVATAR_URL_EXPLAIN'		=> 'Geef de URL van de afbeelding op. De afbeelding zal naar je profiel worden gekopieerd.',
	'USERNAME_ALPHA_ONLY_EXPLAIN'	=> 'Gebruikersnaam moet tussen %1$d en %2$d tekens lang zijn. Gebruik hierbij alleen letters en cijfers.',
	'USERNAME_ALPHA_SPACERS_EXPLAIN'=> 'Gebruikersnaam moet tussen %1$d en %2$d tekens lang zijn. Gebruik hierbij alleen letters, cijfers, spaties of -+_[].',
	'USERNAME_ASCII_EXPLAIN'		=> 'Gebruikersnaam moet tussen %1$d en %2$d tekens lang zijn. Gebruik hierbij alleen ASCII-tekens, dus geen speciale symbolen.',
	'USERNAME_LETTER_NUM_EXPLAIN'	=> 'Gebruikersnaam moet tussen %1$d en %2$d tekens lang zijn. Gebruik hierbij alleen letters of cijfers.',
	'USERNAME_LETTER_NUM_SPACERS_EXPLAIN'=> 'Gebruikersnaam moet tussen %1$d en %2$d tekens lang zijn. Gebruik hierbij alleen letters, cijfers, spaties of -+_[].',
	'USERNAME_CHARS_ANY_EXPLAIN'	=> 'Gebruikersnaam moet tussen de %1$d en %2$d tekens zijn.',
	'USERNAME_TAKEN_USERNAME'		=> 'Deze gebruikersnaam is bezet, probeer een andere.',
	'USERNAME_DISALLOWED_USERNAME'	=> 'Deze gebruikersnaam is bezet en reeds verbannen.',
	'USER_NOT_FOUND_OR_INACTIVE'	=> 'De gebruiker die je opgaf werd niet gevonden of is niet geactiveerd.',

	'VIEW_AVATARS'				=> 'Toon avatars',
	'VIEW_EDIT'					=> 'Bekijk/Wijzig',
	'VIEW_FLASH'				=> 'Toon Flash-animaties',
	'VIEW_IMAGES'				=> 'Toon afbeeldingen binnen berichten',
	'VIEW_NEXT_HISTORY'			=> 'Volgende opgeslagen PB',
	'VIEW_NEXT_PM'				=> 'Volgende PB',
	'VIEW_PM'					=> 'Toon bericht',
	'VIEW_PM_INFO'				=> 'Berichtendetails',
	'VIEW_PM_MESSAGE'			=> '1 bericht',
	'VIEW_PM_MESSAGES'			=> '%d berichten',
	'VIEW_PREVIOUS_HISTORY'		=> 'Vorige opgeslagen PB',
	'VIEW_PREVIOUS_PM'			=> 'Vorige PB',
	'VIEW_SIGS'					=> 'Toon onderschriften',
	'VIEW_SMILIES'				=> 'Toon smilies als afbeeldingen',
	'VIEW_TOPICS_DAYS'			=> 'Toon onderwerpen van vorige dagen',
	'VIEW_TOPICS_DIR'			=> 'Toon onderwerpen sorteerrichting',
	'VIEW_TOPICS_KEY'			=> 'Toon onderwerpen gesorteerd op',
	'VIEW_POSTS_DAYS'			=> 'Toon berichten van vorige dagen',
	'VIEW_POSTS_DIR'			=> 'Toon berichten sorteerrichting',
	'VIEW_POSTS_KEY'			=> 'Geef berichten weer, gesorteerd op',

	'WATCHED_EXPLAIN'			=> 'Onderaan staat een lijst met forums en onderwerpen waarop je bent geabonneerd. Je krijgt ook een notificatie over nieuwe berichten. Om je abonnement op te zeggen, markeer het forum en onderwerpen en druk de <em>verwijder gemarkeerde abonnementen</em> knop.',
	'WATCHED_FORUMS'			=> 'Bekeken forums',
	'WATCHED_TOPICS'			=> 'Bekeken onderwerpen',
	'WRONG_ACTIVATION'			=> 'De opgegeven activatiesleutel komt niet overeen met die uit de database.',

	'YOUR_DETAILS'				=> 'Jouw activiteit',
	'YOUR_FOES'					=> 'Jouw vijanden',
	'YOUR_FOES_EXPLAIN'			=> 'Om gebruikersnamen te verwijderen, selecteer ze en klik op bevestigen.',
	'YOUR_FRIENDS'				=> 'Jouw vrienden',
	'YOUR_FRIENDS_EXPLAIN'		=> 'Om gebruikersnamen te verwijderen, selecteer ze en klik op bevestigen.',
	'YOUR_WARNINGS'				=> 'Jouw aantal waarschuwingen',

	'PM_ACTION' => array(
		'PLACE_INTO_FOLDER'	=> 'Geplaatst in map',
		'MARK_AS_READ'		=> 'Gemarkeerd als gelezen',
		'MARK_AS_IMPORTANT'	=> 'Gemarkeerd bericht',
		'DELETE_MESSAGE'	=> 'Verwijderde berichten'
	),
	'PM_CHECK' => array(
		'SUBJECT'	=> 'Onderwerp',
		'SENDER'	=> 'Afzender',
		'MESSAGE'	=> 'Bericht',
		'STATUS'	=> 'Berichtstatus',
		'TO'		=> 'Stuur naar'
	),
	'PM_RULE' => array(
		'IS_LIKE'		=> 'is als',
		'IS_NOT_LIKE'	=> 'is niet als',
		'IS'			=> 'is',
		'IS_NOT'		=> 'is niet',
		'BEGINS_WITH'	=> 'begint met',
		'ENDS_WITH'		=> 'eindigt met',
		'IS_FRIEND'		=> 'is vriend',
		'IS_FOE'		=> 'is vijand',
		'IS_USER'		=> 'is gebruiker',
		'IS_GROUP'		=> 'zit in de gebruikersgroep',
		'ANSWERED'		=> 'beantwoord',
		'FORWARDED'		=> 'doorgestuurd',
		'TO_GROUP'		=> 'naar mijn standaard gebruikersgroep',
		'TO_ME'			=> 'naar mij'
	),


	'GROUPS_EXPLAIN'	=> 'Gebruikersgroepen maken het werk van de beheerder een stuk eenvoudiger. Je wordt standaard in een groep geplaatst. Deze groep bepaalt hoe je voor anderen zichtbaar bent, bijvoorbeeld een kleur, avatar, rang, etc. Afhankelijk van de instellingen van de beheerder kun je al dan niet van groep veranderen. Je kunt ook aan groepen toegevoegd worden of jezelf eraan toevoegen. Sommige groepen geven je extra permissies, zo kun je meer inhoud zien en/of bepaalde acties uitvoeren.',
	'GROUP_LEADER'		=> 'Leiderschappen',
	'GROUP_MEMBER'		=> 'Lidmaatschappen',
	'GROUP_PENDING'		=> 'Wachtende lidmaatschappen',
	'GROUP_NONMEMBER'	=> 'Niet-lidmaatschappen',
	'GROUP_DETAILS'		=> 'Groepsdetails',

	'NO_LEADER'		=> 'Geen groepsleiders',
	'NO_MEMBER'		=> 'Geen groepslidmaatschap',
	'NO_PENDING'	=> 'Geen wachtende lidmaatschappen',
	'NO_NONMEMBER'	=> 'Geen niet-leden groepen',
));

// mChat MOD
$lang = array_merge($lang, array(
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'Preferences',
// ajaxlike
	'AJ_SHOW_LIKES'		=> 'Display last likes in profile',
//Begin : Show Password Strength
	'PS_VERY_WEAK'		=> 'Very Weak',
	'PS_WEAK'			=> 'Weak',
	'PS_GOOD'			=> 'Good',
	'PS_STRONG'			=> 'Strong',
	'PS_VERY_STRONG'	=> 'Very Strong',
));
