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
		'OASL_DO_AVATARS' => 'Hochladen von Avataren aus sozialen Netzwerken aktivieren?',
		'OASL_DO_AVATARS_DESC' => 'Erlaubt das Abrufen des Avatars aus dem Profil des Benutzers im sozialen Netzwerk und das Speichern im phpBB-Avatar-Ordner.',
		'OASL_DO_AVATARS_ENABLE_YES' => 'Ja, Avatare aus sozialen Netzwerken verwenden',
		'OASL_DO_AVATARS_ENABLE_NO' => 'Nein, keine Avatare aus sozialen Netzwerken verwenden',
		'OASL_PROFILE_TITLE' => 'Social Login',
		'OASL_PROFILE_DESC' => 'Verknüpfe dein Konto mit einem sozialen Netzwerk',
		'OASL_WIDGET_TITLE' => 'Mit einem sozialen Netzwerk anmelden:',
		'OASL_SETTNGS_UPDATED' => 'Einstellungen erfolgreich aktualisiert.',
		'OASL_INTRO' => 'Erlaube deinen Besuchern, sich mit sozialen Netzwerken wie Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google und Yahoo anzumelden und zu registrieren. Social Login <strong>erhöht deine Registrierungsrate</strong>, indem der Registrierungsvorgang vereinfacht wird, und liefert berechtigungsbasierte soziale <strong>Daten aus den Profilen der sozialen Netzwerke</strong>. Social Login lässt sich in dein bestehendes Registrierungssystem integrieren, sodass du und deine Benutzer nicht bei null anfangen müsst.',
		'OASL_TITLE' => 'OneAll Social Login',
		'OASL_TITLE_HELP' => 'Hilfe, Updates &amp; Dokumentation',
		'OASL_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Folge uns</a> auf Twitter, um über Updates informiert zu bleiben;',
		'OASL_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Lies</a> die Online-Dokumentation für weitere Informationen zu diesem Plugin;',
		'OASL_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Entdecke</a> unsere schlüsselfertigen Plugins für Drupal, Joomla, WordPress;',
		'OASL_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Kontaktiere uns</a>, wenn du Feedback hast oder Unterstützung benötigst!',
		'OASL_CREATE_ACCOUNT_FIRST' => 'Um Social Login nutzen zu können, musst du zunächst ein kostenloses Konto bei <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> erstellen und eine Site einrichten.',
		'OASL_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Mein kostenloses Konto einrichten</a>',
		'OASL_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Meine API-Zugangsdaten erstellen und anzeigen</a>',
		'OASL_API_CONNECTION' => 'API-Verbindung',
		'OASL_API_CONNECTION_HANDLER' => 'API-Verbindungs-Handler:',
		'OASL_CURL' => 'PHP CURL',
		'OASL_CURL_DESC' => 'Die Verwendung von CURL wird empfohlen, kann aber auf manchen Servern deaktiviert sein.',
		'OASL_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL-Handbuch</a>',
		'OASL_FSOCKOPEN' => 'PHP FSOCKOPEN',
		'OASL_FSOCKOPEN_DESC' => 'Verwende FSOCKOPEN nur, wenn du Probleme mit CURL hast.',
		'OASL_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN-Handbuch</a>',
		'OASL_API_PORT' => 'API-Verbindungsport:',
		'OASL_PORT_443' => 'Kommunikation über HTTPS auf Port 443',
		'OASL_PORT_443_DESC' => 'Die Verwendung von Port 443 wird empfohlen, möglicherweise musst du jedoch OpenSSL auf deinem Server installieren.',
		'OASL_PORT_80' => 'Kommunikation über HTTP auf Port 80',
		'OASL_PORT_80_DESC' => 'Die Verwendung von Port 80 ist etwas schneller und benötigt kein OpenSSL, ist aber weniger sicher.',
		'OASL_API_AUTODETECT' => 'API-Verbindung automatisch erkennen',
		'OASL_API_CREDENTIALS_TITLE' => 'API-Zugangsdaten - <a href="https://app.oneall.com/applications/" class="external">Klicke hier, um deine API-Zugangsdaten zu erstellen oder anzuzeigen</a>',
		'OASL_API_SUBDOMAIN' => 'API-Subdomain:',
		'OASL_API_PUBLIC_KEY' => 'Öffentlicher API-Schlüssel:',
		'OASL_API_PRIVATE_KEY' => 'Privater API-Schlüssel:',
		'OASL_API_VERIFY' => 'API-Einstellungen überprüfen',
		'OASL_ENABLE_NETWORKS' => 'Aktiviere die sozialen Netzwerke/Identitätsanbieter deiner Wahl',
		'OASL_DO_ENABLE' => 'Social Login aktivieren?',
		'OASL_DO_ENABLE_DESC' => 'Ermöglicht es dir, Social Login vorübergehend zu deaktivieren, ohne es entfernen zu müssen.',
		'OASL_DO_ENABLE_YES' => 'Social Login aktivieren',
		'OASL_DO_ENABLE_NO' => 'Social Login deaktivieren',
		'OASL_DEFAULT' => 'Standard',
		'OASL_DO_LINKING' => 'Verknüpfung von Konten sozialer Netzwerke aktivieren?',
		'OASL_DO_LINKING_ASK' => 'Konten sozialer Netzwerke automatisch mit bestehenden Benutzerkonten verknüpfen?',
		'OASL_DO_LINKING_DESC' => 'Wenn aktiviert, werden Konten sozialer Netzwerke mit einer verifizierten E-Mail-Adresse mit bestehenden phpBB-Benutzerkonten verknüpft, die dieselbe E-Mail-Adresse haben.',
		'OASL_DO_LINKING_YES' => 'Kontoverknüpfung aktivieren',
		'OASL_DO_LINKING_NO' => 'Kontoverknüpfung deaktivieren',
		'OASL_DO_REDIRECT' => 'Weiterleitung einrichten',
		'OASL_DO_REDIRECT_ASK' => 'Benutzer nach der Verbindung mit ihrem Konto eines sozialen Netzwerks auf diese Seite weiterleiten:',
		'OASL_DO_REDIRECT_DESC' => 'Gib eine vollständige URL zu einer Seite deines phpBB ein. Wenn leer, bleibt der Benutzer auf derselben Seite.',
		'OASL_API_DETECT_CURL' => 'CURL auf Port %s erkannt - vergiss nicht, deine Änderungen zu speichern!',
		'OASL_API_DETECT_FSOCKOPEN' => 'FSOCKOPEN auf Port %s erkannt - vergiss nicht, deine Änderungen zu speichern!',
		'OASL_API_DETECT_NONE' => 'Verbindung fehlgeschlagen! Deine Firewall muss ausgehende Anfragen entweder über Port 80 oder 443 zulassen.',
		'OASL_API_CREDENTIALS_FILL_OUT' => 'Bitte fülle jedes der oben stehenden Felder aus.',
		'OASL_API_CREDENTIALS_USE_AUTO' => 'Der Verbindungs-Handler scheint nicht zu funktionieren. Bitte verwende die automatische Erkennung.',
		'OASL_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Die Subdomain existiert nicht. Hast du sie korrekt ausgefüllt?',
		'OASL_API_CREDENTIALS_KEYS_WRONG' => 'Die API-Zugangsdaten sind falsch, bitte überprüfe deinen öffentlichen/privaten Schlüssel.',
		'OASL_API_CREDENTIALS_CHECK_COM' => 'API konnte nicht erreicht werden. Ist die API-Verbindung korrekt eingerichtet?',
		'OASL_API_CREDENTIALS_UNKNOW_ERROR' => 'Unbekannte Antwort - bitte stelle sicher, dass du angemeldet bist!',
		'OASL_API_CREDENTIALS_OK' => 'Die Einstellungen sind korrekt - vergiss nicht, deine Änderungen zu speichern!',
		'OASL_SETTINGS' => 'OneAll Social Login Einstellungen',
		'OASL_ENABLE_SOCIAL_NETWORK' => 'Du musst mindestens ein soziales Netzwerk aktivieren',
		'OASL_ENTER_CREDENTIALS' => 'Du musst deine API-Zugangsdaten einrichten',
		'OASL_ACCOUNT_ALREADY_LINKED' => 'Dieses Konto eines sozialen Netzwerks ist bereits mit einem anderen Forenbenutzer verknüpft.',
		'OASL_ACCOUNT_INACTIVE_OTHER' => 'Das Konto wurde erstellt. Die Foreneinstellungen erfordern jedoch eine Kontoaktivierung.<br />Ein Aktivierungsschlüssel wurde an deine E-Mail-Adresse gesendet.',
		'OASL_ACCOUNT_INACTIVE_ADMIN' => 'Das Konto wurde erstellt. Die Foreneinstellungen erfordern jedoch eine Kontoaktivierung durch einen Administrator.<br />Eine E-Mail wurde an die Administratoren gesendet und du wirst per E-Mail benachrichtigt, sobald dein Konto aktiviert wurde.'
	));
