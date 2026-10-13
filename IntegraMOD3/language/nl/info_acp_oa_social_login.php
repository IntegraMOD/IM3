<?php
/**
 * @package   	OneAll Social Login Mod
 * @copyright 	Copyright 2011-Present http://www.oneall.com - All rights reserved.
 * @license   	GNU/GPL 2 or later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */
if (!defined ('IN_PHPBB'))
{
	exit;
}

if (!isset ($lang) || !is_array ($lang))
{
	$lang = array ();
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
// in a URL you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge ($lang,
	array (
		'OASL_DO_AVATARS' => 'Uploaden van avatars uit sociaal netwerk inschakelen?',
		'OASL_DO_AVATARS_DESC' => 'Sta toe dat de avatar van de gebruiker uit zijn profiel op het sociale netwerk wordt opgehaald en in je phpBB-avatarmap wordt opgeslagen.',
		'OASL_DO_AVATARS_ENABLE_YES' => 'Ja, avatars van sociale netwerken gebruiken',
		'OASL_DO_AVATARS_ENABLE_NO' => 'Nee, geen avatars van sociale netwerken gebruiken',
		'OASL_PROFILE_TITLE' => 'Social Login',
		'OASL_PROFILE_DESC' => 'Koppel je account aan een sociaal netwerk',
		'OASL_WIDGET_TITLE' => 'Inloggen met een sociaal netwerk:',
		'OASL_SETTNGS_UPDATED' => 'Instellingen succesvol bijgewerkt.',
		'OASL_INTRO' => 'Sta je bezoekers toe in te loggen en te registreren met sociale netwerken zoals Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google en Yahoo, onder andere. Social Login <strong>verhoogt je registratiepercentage</strong> door het registratieproces te vereenvoudigen en levert op toestemming gebaseerde sociale <strong>gegevens die uit de profielen van de sociale netwerken worden opgehaald</strong>. Social Login integreert met je bestaande registratiesysteem, zodat jij en je gebruikers niet opnieuw hoeven te beginnen.',
		'OASL_TITLE' => 'OneAll Social Login',
		'OASL_TITLE_HELP' => 'Hulp, updates &amp; documentatie',
		'OASL_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Volg ons</a> op Twitter om op de hoogte te blijven van updates;',
		'OASL_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Lees</a> de online documentatie voor meer informatie over deze plugin;',
		'OASL_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Ontdek</a> onze kant-en-klare plugins voor Drupal, Joomla, WordPress;',
		'OASL_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Neem contact met ons op</a> als je feedback hebt of hulp nodig hebt!',
		'OASL_CREATE_ACCOUNT_FIRST' => 'Om Social Login te kunnen gebruiken, moet je eerst een gratis account aanmaken op <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> en een site instellen.',
		'OASL_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Mijn gratis account instellen</a>',
		'OASL_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Mijn API-gegevens aanmaken en bekijken</a>',
		'OASL_API_CONNECTION' => 'API-verbinding',
		'OASL_API_CONNECTION_HANDLER' => 'API-verbindingshandler:',
		'OASL_CURL' => 'PHP CURL',
		'OASL_CURL_DESC' => 'Het gebruik van CURL wordt aanbevolen, maar het kan op sommige servers uitgeschakeld zijn.',
		'OASL_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL-handleiding</a>',
		'OASL_FSOCKOPEN' => 'PHP FSOCKOPEN',
		'OASL_FSOCKOPEN_DESC' => 'Gebruik FSOCKOPEN alleen als je problemen ondervindt met CURL.',
		'OASL_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN-handleiding</a>',
		'OASL_API_PORT' => 'API-verbindingspoort:',
		'OASL_PORT_443' => 'Communicatie via HTTPS op poort 443',
		'OASL_PORT_443_DESC' => 'Het gebruik van poort 443 wordt aanbevolen, maar mogelijk moet je OpenSSL op je server installeren.',
		'OASL_PORT_80' => 'Communicatie via HTTP op poort 80',
		'OASL_PORT_80_DESC' => 'Poort 80 gebruiken is iets sneller en vereist geen OpenSSL, maar is minder veilig.',
		'OASL_API_AUTODETECT' => 'API-verbinding automatisch detecteren',
		'OASL_API_CREDENTIALS_TITLE' => 'API-gegevens - <a href="https://app.oneall.com/applications/" class="external">Klik hier om je API-gegevens aan te maken of te bekijken</a>',
		'OASL_API_SUBDOMAIN' => 'API-subdomein:',
		'OASL_API_PUBLIC_KEY' => 'Openbare API-sleutel:',
		'OASL_API_PRIVATE_KEY' => 'Privé API-sleutel:',
		'OASL_API_VERIFY' => 'API-instellingen verifiëren',
		'OASL_ENABLE_NETWORKS' => 'Schakel de sociale netwerken/identiteitsproviders van je keuze in',
		'OASL_DO_ENABLE' => 'Social Login inschakelen?',
		'OASL_DO_ENABLE_DESC' => 'Hiermee kun je Social Login tijdelijk uitschakelen zonder het te hoeven verwijderen.',
		'OASL_DO_ENABLE_YES' => 'Social Login inschakelen',
		'OASL_DO_ENABLE_NO' => 'Social Login uitschakelen',
		'OASL_DEFAULT' => 'Standaard',
		'OASL_DO_LINKING' => 'Koppeling van accounts van sociale netwerken inschakelen?',
		'OASL_DO_LINKING_ASK' => 'Accounts van sociale netwerken automatisch koppelen aan bestaande gebruikersaccounts?',
		'OASL_DO_LINKING_DESC' => 'Indien ingeschakeld worden accounts van sociale netwerken met een geverifieerd e-mailadres gekoppeld aan bestaande phpBB-gebruikersaccounts met hetzelfde e-mailadres.',
		'OASL_DO_LINKING_YES' => 'Accountkoppeling inschakelen',
		'OASL_DO_LINKING_NO' => 'Accountkoppeling uitschakelen',
		'OASL_DO_REDIRECT' => 'Omleiding instellen',
		'OASL_DO_REDIRECT_ASK' => 'Gebruikers naar deze pagina omleiden nadat ze verbinding hebben gemaakt met hun account van een sociaal netwerk:',
		'OASL_DO_REDIRECT_DESC' => 'Voer een volledige URL in naar een pagina van je phpBB. Indien leeg gelaten, blijft de gebruiker op dezelfde pagina.',
		'OASL_API_DETECT_CURL' => 'CURL gedetecteerd op poort %s - vergeet niet je wijzigingen op te slaan!',
		'OASL_API_DETECT_FSOCKOPEN' => 'FSOCKOPEN gedetecteerd op poort %s - vergeet niet je wijzigingen op te slaan!',
		'OASL_API_DETECT_NONE' => 'Verbinding mislukt! Je firewall moet uitgaande verzoeken toestaan op poort 80 of 443.',
		'OASL_API_CREDENTIALS_FILL_OUT' => 'Vul elk van de bovenstaande velden in.',
		'OASL_API_CREDENTIALS_USE_AUTO' => 'De verbindingshandler lijkt niet te werken. Gebruik de automatische detectie.',
		'OASL_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Het subdomein bestaat niet. Heb je het correct ingevuld?',
		'OASL_API_CREDENTIALS_KEYS_WRONG' => 'De API-gegevens zijn onjuist, controleer je openbare/privé-sleutel.',
		'OASL_API_CREDENTIALS_CHECK_COM' => 'Kon geen contact maken met de API. Is de API-verbinding correct ingesteld?',
		'OASL_API_CREDENTIALS_UNKNOW_ERROR' => 'Onbekend antwoord - zorg ervoor dat je bent ingelogd!',
		'OASL_API_CREDENTIALS_OK' => 'De instellingen zijn correct - vergeet niet je wijzigingen op te slaan!',
		'OASL_SETTINGS' => 'OneAll Social Login-instellingen',
		'OASL_ENABLE_SOCIAL_NETWORK' => 'Je moet ten minste één sociaal netwerk inschakelen',
		'OASL_ENTER_CREDENTIALS' => 'Je moet je API-gegevens instellen',
		'OASL_ACCOUNT_ALREADY_LINKED' => 'Dit account van een sociaal netwerk is al gekoppeld aan een andere forumgebruiker.',
		'OASL_ACCOUNT_INACTIVE_OTHER' => 'Het account is aangemaakt. De foruminstellingen vereisen echter accountactivering.<br />Er is een activeringssleutel naar je e-mailadres gestuurd.',
		'OASL_ACCOUNT_INACTIVE_ADMIN' => 'Het account is aangemaakt. De foruminstellingen vereisen echter accountactivering door een beheerder.<br />Er is een e-mail naar de beheerders gestuurd en je wordt per e-mail op de hoogte gebracht zodra je account is geactiveerd.'
	));
