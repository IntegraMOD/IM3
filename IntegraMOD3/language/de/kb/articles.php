<?php
/**
*
* Knowledge Base article catalog [German]
*
* Use whole-field tokens such as {L_RANDOM_NAME} in the article title,
* description, or body when creating a Knowledge Base article.
* Do not merge this file into $user->lang.
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

//
// ARTICLE INDEX
// Search for "START ARTICLE: NAME" to jump directly to an article.
// Each article contains its title, description, and body keys.
//
// 1. RANDOM
// 2. SAVE_FORUM_APP
// 3. PUSH_NOTIFICATIONS
// 4. KB_SETUP
// 5. K_LINKS_BANNER_UPLOAD
// 6. STYLE_INSTALL
// 7. IM_INSTALL
//
$lang = array_merge($lang, array(

// ===== START ARTICLE: RANDOM =====
    'RANDOM_TITLE'       => 'Beispiel für einen lokalisierten Titel',
    'RANDOM_DESCRIPTION' => 'Beispiel für eine lokalisierte Beschreibung',
    'RANDOM_ARTICLE'     => 'Dies ist ein Beispiel für den Text eines lokalisierten Wissensdatenbank-Artikels. Sie können hier BBCode verwenden.',

// ===== END ARTICLE: RANDOM =====


// ===== START ARTICLE: SAVE_FORUM_APP =====
    'SAVE_FORUM_APP'			=> 'Das Forum als App speichern',
    'SAVE_FORUM_APP_DESC'		=> 'Forum auf den Desktop, den Startbildschirm oder ins Dock legen, damit es sich wie eine App öffnet.',
    'SAVE_FORUM_APP_ARTICLE'	=> '[anchor=app_top][/anchor][b]IntegraMOD als App[/b]

Ein Symbol auf dem Desktop oder Startbildschirm ist nur eine Verknüpfung, aber eine praktische. Das Forum öffnet sich in einem eigenen Fenster, statt irgendwo in einem Haufen Tabs zu liegen. Am Handy sitzt es neben den anderen Apps und startet im Vollbild. Ein Klick in der Taskleiste, im Dock oder auf dem Startbildschirm, und Sie sind drin.

Internet brauchen Sie weiter, und Sie bleiben so angemeldet wie in dem Browser, den Sie zum Hinzufügen genutzt haben. Aus einem Store wird nichts heruntergeladen.

Wählen Sie den Browser, den Sie wirklich nutzen, und springen Sie zu den Schritten.

[b]Desktop-Browser[/b]
[list]
[*][anchor=toc_chrome goto=chrome]Google Chrome[/anchor]
[*][anchor=toc_edge goto=edge]Microsoft Edge[/anchor]
[*][anchor=toc_safari_mac goto=safari_mac]Safari (Mac)[/anchor]
[*][anchor=toc_firefox_desk goto=firefox_desk]Firefox[/anchor]
[/list]

[b]Mobile Browser[/b]
[list]
[*][anchor=toc_safari_ios goto=safari_ios]Safari (iPhone / iPad)[/anchor]
[*][anchor=toc_chrome_and goto=chrome_and]Chrome (Android)[/anchor]
[*][anchor=toc_firefox_and goto=firefox_and]Firefox (Android)[/anchor]
[/list]

[b]Danach[/b]
[list]
[*][anchor=toc_push_top goto=push]Push-Benachrichtigungen einschalten[/anchor]
[/list]

[anchor=chrome][b]Google Chrome (Desktop)[/b][/anchor]

Geht unter Windows, macOS und Linux.

[list=1]
[*]Öffnen Sie das Forum in Chrome.
[*]In der Adressleiste sitzt oft ein kleines Installieren-Symbol. Meist ein Rechner mit Pfeil nach unten oder ein Plus auf einem Bildschirm.
[*]Kein Symbol? Drei-Punkte-Menü öffnen und [b]App installieren[/b] oder [b]Diese Website als App installieren[/b] wählen.
[*]Namen behalten oder ändern, dann auf [b]Installieren[/b] klicken.
[/list]

Chrome legt es ins Startmenü oder in den Ordner Programme. An Taskleiste oder Dock anheften, wenn Sie es mit einem Klick wollen. Es öffnet sich in einem schlichten Fenster ohne die übliche Tab-Leiste.

Zum Entfernen die App öffnen, das Menü nehmen und Deinstallieren wählen.

[anchor=back_chrome goto=app_top]Nach oben[/anchor]

[anchor=edge][b]Microsoft Edge (Desktop)[/b][/anchor]

Dasselbe Prinzip wie bei Chrome, die Texte sind fast identisch.

[list=1]
[*]Forum in Edge öffnen.
[*]Installieren-Symbol in der Adressleiste anklicken, falls es da ist.
[*]Sonst Drei-Punkte-Menü und [b]Apps → Diese Website als App installieren[/b].
[*]Namen bestätigen und [b]Installieren[/b] klicken.
[/list]

An Taskleiste oder Start anheften geht danach. Deinstallieren über das App-Menü oder die Verknüpfung löschen.

[anchor=back_edge goto=app_top]Nach oben[/anchor]

[anchor=safari_mac][b]Safari (Mac)[/b][/anchor]

[list=1]
[*]Forum in Safari öffnen.
[*][b]Ablage → Zum Dock hinzufügen[/b] wählen. Manche Versionen verstecken das unter Teilen.
[*]Namen bestätigen und hinzufügen.
[/list]

Safari legt ein Symbol ins Dock. Ein Klick öffnet das Forum in einem eigenen Fenster.

[anchor=back_safari_mac goto=app_top]Nach oben[/anchor]

[anchor=firefox_desk][b]Firefox (Desktop)[/b][/anchor]

Firefox installiert Web-Apps nicht wie Chrome oder Edge. Nah dran halten geht trotzdem:

[list]
[*]Forum als Lesezeichen speichern, oder
[*]das Schloss- bzw. Seitensymbol aus der Adressleiste auf den Desktop ziehen.
[/list]

Die Verknüpfung öffnet weiter ein normales Firefox-Fenster, spart aber die Suche in den Lesezeichen.

[anchor=back_firefox_desk goto=app_top]Nach oben[/anchor]

[anchor=safari_ios][b]Safari (iPhone / iPad)[/b][/anchor]

Dafür Safari nehmen. Chrome auf dem iPhone kann keine richtige Home-Screen-App auf demselben Weg anlegen.

[list=1]
[*]Forum in Safari öffnen.
[*]Auf [b]Teilen[/b] tippen (Quadrat mit Pfeil nach oben).
[*]Teilen-Blatt durchscrollen und [b]Zum Home-Bildschirm[/b] tippen.
[*]Namen bei Bedarf ändern, dann [b]Hinzufügen[/b].
[/list]

Das Symbol landet auf dem Home-Bildschirm und öffnet das Forum im Vollbild.

Fehlt Zum Home-Bildschirm, im Teilen-Blatt Aktionen bearbeiten oder Mehr tippen und einschalten.

[anchor=back_safari_ios goto=app_top]Nach oben[/anchor]

[anchor=chrome_and][b]Chrome (Android)[/b][/anchor]

[list=1]
[*]Forum in Chrome öffnen.
[*]Drei-Punkte-Menü tippen.
[*][b]App installieren[/b] oder [b]Zum Startbildschirm hinzufügen[/b] wählen.
[*][b]Installieren[/b] oder [b]Hinzufügen[/b] bestätigen.
[/list]

Manchmal zeigt Android unten ein Installieren-Banner. Das tut es auch.

Das Symbol erscheint auf dem Startbildschirm oder im App-Drawer und öffnet sich in einem eigenen Fenster.

[anchor=back_chrome_and goto=app_top]Nach oben[/anchor]

[anchor=firefox_and][b]Firefox (Android)[/b][/anchor]

[list=1]
[*]Forum in Firefox öffnen.
[*]Browsermenü öffnen.
[*][b]Installieren[/b] oder [b]Zum Startbildschirm hinzufügen[/b] tippen, falls das Telefon das anbietet.
[/list]

Fehlt die Option, einfach ein Lesezeichen anlegen. Nicht so aufgeräumt wie ein App-Symbol, aber trotzdem ein Tipp entfernt.

[anchor=back_firefox_and goto=app_top]Nach oben[/anchor]

[b]Wenn es installiert ist[/b]
[list]
[*][anchor=toc_push goto=push]Push-Benachrichtigungen einschalten[/anchor]
[/list]

[anchor=push][b]Push-Benachrichtigungen einschalten[/b][/anchor]

Das Symbol schaltet keine Benachrichtigungen ein. Es ist nur ein Fenster in denselben Browser, mit dem Sie es angelegt haben. Push hängt an diesem Browser und startet erst, wenn Sie es im angemeldeten Zustand erlauben.

Öffnen Sie das Forum über das neue Symbol, nicht über einen alten Tab. Dort anmelden. Dann im Profil: [b]Persönlicher Bereich[/b] → [b]Einstellungen[/b] → [b]Push-Benachrichtigungen[/b].

Diese Seite abonniert [i]dieses[/i] Browser- oder App-Fenster. Klicken Sie auf [b]Browser-Benachrichtigungen aktivieren[/b]. Der Browser fragt nach der Erlaubnis; [b]Zulassen[/b] wählen. Wenn es geklappt hat, steht dort [b]Dieser Browser ist abonniert.[/b]

Die Erlaubnis allein schickt noch nichts. Darunter [b]Web-Push[/b] bei den Ereignissen ankreuzen, die Sie wollen (private Nachrichten, Likes, abonnierte Themen usw.), dann [b]Absenden[/b].

Das auf jedem Telefon, Tablet oder Rechner wiederholen, auf dem Sie das Forum installiert haben. Einschalten auf einem Gerät gilt nicht für die anderen. Tut [b]Browser-Benachrichtigungen aktivieren[/b] nichts, blockiert der Browser oder eine Erweiterung Benachrichtigungen für diese Seite. Fürs Forum erlauben und den Knopf noch einmal klicken.

[b]Noch ein paar Hinweise[/b]
[list]
[*]Neues Symbol einmal öffnen und anmelden. Die Anmeldung bleibt bei dem Browser, mit dem Sie es hinzugefügt haben.
[*]Öffnet das Symbol eine leere Seite, löschen und neu von der aktuellen HTTPS-Adresse hinzufügen, nicht von einem alten Lesezeichen.
[*]Forum-Updates zwingen Sie nicht, das Symbol neu anzulegen.
[/list]

[anchor=back_push goto=app_top]Nach oben[/anchor]',

// ===== END ARTICLE: SAVE_FORUM_APP =====


// ===== START ARTICLE: PUSH_NOTIFICATIONS =====
	'PUSH_NOTIFICATIONS'			=> 'Push-Benachrichtigungen',
	'PUSH_NOTIFICATIONS_DESC'		=> 'Browserhinweise für private Nachrichten, Likes und andere Forenereignisse einschalten.',
	'PUSH_NOTIFICATIONS_ARTICLE'	=> '[anchor=push_top][/anchor][b]Push-Benachrichtigungen[/b]

Push ist ein kurzer Hinweis vom Forum, wenn etwas passiert, während Sie nicht hinschauen. Eine private Nachricht, ein Like, eine Antwort in einem beobachteten Thema. Es erscheint im Browser oder auf dem Telefon wie bei anderen Seiten.

Das Forum kann senden. Der Browser muss es erlauben. Das machen Sie einmal pro Gerät, während Sie angemeldet sind.

[b]Sprungmarken[/b]
[list]
[*][anchor=toc_before goto=before]Bevor Sie beginnen[/anchor]
[*][anchor=toc_enable goto=enable]Einschalten[/anchor]
[*][anchor=toc_events goto=events]Ereignisse wählen[/anchor]
[*][anchor=toc_devices goto=devices]Mehr als ein Gerät[/anchor]
[*][anchor=toc_sms goto=sms]SMS (optional)[/anchor]
[*][anchor=toc_admin goto=admin]Einrichtung für Administratoren[/anchor]
[*][anchor=toc_fix goto=fix]Wenn es nicht klappt[/anchor]
[/list]

[anchor=before][b]Bevor Sie beginnen[/b][/anchor]

[list]
[*]HTTPS verwenden. Push funktioniert nicht unter einer reinen http-Adresse.
[*]Anmelden. Gäste können sich nicht abonnieren.
[*]Das Forum in dem Browser (oder App-Fenster) öffnen, in dem Sie Hinweise wollen. Die Erlaubnis gehört zu diesem Browser, nicht zum ganzen Konto.
[/list]

Haben Sie das Forum als App hinzugefügt, öffnen Sie es über dieses Symbol, nicht über einen alten Tab. Danach die Schritte in diesem Fenster.

[anchor=back_before goto=push_top]Nach oben[/anchor]

[anchor=enable][b]Einschalten[/b][/anchor]

[list=1]
[*]Öffnen Sie [b]Benutzerkontrollzentrum[/b] → [b]Foreneinstellungen[/b] → [b]Push-Benachrichtigungen[/b].
[*]Klicken Sie auf [b]Browser-Benachrichtigungen aktivieren[/b] (manchmal [b]Desktop-Benachrichtigungen aktivieren[/b]).
[*]Wenn der Browser fragt, [b]Zulassen[/b] wählen.
[*]Danach sollte stehen: [b]Dieser Browser ist abonniert.[/b]
[/list]

Diese Erlaubnis lässt das Forum nur senden. Die Ereignisse wählen Sie danach.

[anchor=back_enable goto=push_top]Nach oben[/anchor]

[anchor=events][b]Ereignisse wählen[/b][/anchor]

Unter dem Abostatus [b]Web Push[/b] bei den gewünschten Ereignissen ankreuzen und [b]Absenden[/b] klicken.

Typische Ereignisse (nur was der Administrator eingeschaltet hat, erscheint):
[list]
[*]Private Nachrichten
[*]Likes
[*]Freundschaftsanfragen und Annahmen
[*]Antworten in beobachteten Beiträgen
[*]Updates in beobachteten Themen
[*]News und Ankündigungen
[*]Erwähnungen, wenn jemand @IhrName in einem erlaubten Forum schreibt
[*]Neue Registrierungen und neue Beiträge für die vom Administrator gewählten Mitarbeiter oder Gruppen
[/list]

Ein Kästchen leer lassen, wenn Sie diesen Hinweis nicht wollen.

[anchor=back_events goto=push_top]Nach oben[/anchor]

[anchor=devices][b]Mehr als ein Gerät[/b][/anchor]

Einschalten auf einem Telefon, Tablet oder Rechner gilt nicht für die anderen. Die Schritte in jedem Browser- oder App-Fenster wiederholen, das Sie installiert haben.

[anchor=back_devices goto=push_top]Nach oben[/anchor]

[anchor=sms][b]SMS (optional)[/b][/anchor]

Hat der Administrator SMS eingeschaltet, kann dieselbe Seite eine Landesvorwahl und Handynummer aufnehmen. Die Nummer wird verschlüsselt gespeichert. [b]SMS Push[/b] nur bei Ereignissen ankreuzen, die als Textnachricht kommen sollen.

[anchor=back_sms goto=push_top]Nach oben[/anchor]

[anchor=admin][b]Einrichtung für Administratoren[/b][/anchor]

Öffnen Sie [b]ACP → Allgemein → Push-Benachrichtigungen → Einstellungen[/b]. Browser-Push nutzt OneSignal. SMS kann OneSignal oder Twilio nutzen.

[b]OneSignal[/b]
[list]
[*]Erstellen Sie eine App bei OneSignal und tragen Sie [b]App ID[/b] und [b]REST API key[/b] in die gleichnamigen Felder ein.
[*]Die Seite muss HTTPS verwenden. Die Domain muss außerdem in der OneSignal-App erlaubt sein.
[*]Ohne App ID kann sich niemand für Browser-Benachrichtigungen anmelden.
[/list]

[b]Twilio[/b]
[list]
[*]Setzen Sie [b]SMS gateway[/b] auf [b]Twilio[/b]. Lassen Sie OneSignal gewählt, wenn SMS über OneSignal laufen sollen.
[*][b]Twilio SID[/b] ist die Account SID aus der Twilio-Konsole.
[*][b]Twilio Token[/b] ist das Auth Token dieses Kontos.
[*][b]Twilio From Number[/b] ist die Twilio-Absendernummer mit Landesvorwahl, zum Beispiel +15551234567.
[*]Die Twilio-Felder werden ignoriert, solange der Gateway auf OneSignal steht.
[/list]

[b]Ereignisoptionen[/b]

Die Tabelle schaltet jedes Ereignis für [b]Web Push[/b] und [b]SMS Push[/b] ein oder aus. Benutzer können ein Ereignis erst wählen, nachdem es hier aktiviert wurde.

[list]
[*][b]Neue Registrierung[/b] geht nur an Gründer und Administratoren. Aktivieren Sie [b]Include moderators[/b], wenn Moderatoren sie ebenfalls erhalten sollen.
[*][b]Neuer Beitrag[/b] geht an dieselbe Zielgruppe. Mit [b]New-post groups[/b] fügen Sie weitere Gruppen hinzu. Halten Sie Strg gedrückt, um mehrere Gruppen zu wählen.
[*][b]Erwähnung[/b] benachrichtigt einen Benutzer bei einer gültigen @Benutzername-Erwähnung. Der Benutzer muss sie zusätzlich im Benutzerkontrollzentrum aktivieren.
[/list]

[b]Erwähnungen[/b]

Erwähnungen haben zwei Einstellungen, und beide müssen aktiv sein:
[list]
[*][b]ACP → Beiträge → Nachrichten → Beitrags-Einstellungen → Erwähnungen erlauben[/b] gilt für das ganze Board. Beim ersten Einschalten werden Erwähnungen für vorhandene Foren aktiviert.
[*][b]ACP → Foren → Forum erstellen oder bearbeiten → Erwähnungen erlauben[/b] gilt für ein Forum. Neue Foren sind standardmäßig aktiviert. Entfernen Sie das Häkchen für ein Forum ohne Erwähnungen.
[/list]

Ein Benutzer schreibt @Name im Editor oder in der Schnellantwort und wählt einen Namen aus der Liste. Der Beitrag speichert dies als Erwähnungs-Tag. Ist eine Einstellung aus, erscheint die Liste nicht und es wird keine Benachrichtigung gesendet.

[anchor=back_admin goto=push_top]Nach oben[/anchor]

[anchor=fix][b]Wenn es nicht klappt[/b][/anchor]

[list]
[*]Der Knopf tut nichts, oder die Seite sagt nie, der Browser sei abonniert: Benachrichtigungen für diese Seite sind blockiert. In den Browsereinstellungen erlauben und den Knopf erneut klicken.
[*]Eine Erweiterung wie uBlock, AdGuard, Brave Shields, DuckDuckGo oder der strikte Tracking-Schutz von Firefox kann den Dienst blockieren. Für dieses Forum erlauben.
[*]Sie sind nicht angemeldet oder haben ein altes HTTP-Lesezeichen geöffnet.
[*]Sie haben es in einem Browser erlaubt und warten in einem anderen. Jeden einzeln abonnieren.
[/list]

Administratoren stellen den Dienst unter [b]ACP → Allgemein → Push-Benachrichtigungen → Einstellungen[/b] ein. Steht dort keine OneSignal App-ID, kann sich niemand abonnieren. Für SMS muss außerdem der gewählte Gateway, OneSignal oder Twilio, ausgefüllt sein. Eine Erwähnung benachrichtigt nur, wenn Board, Forum und Benutzereinstellung aktiviert sind.

[anchor=back_fix goto=push_top]Nach oben[/anchor]',

// ===== END ARTICLE: PUSH_NOTIFICATIONS =====


// ===== START ARTICLE: KB_SETUP =====
	'KB_SETUP'			=> 'Die Wissensdatenbank einrichten',
	'KB_SETUP_DESC'		=> 'Kategorien, Typen und Berechtigungen anlegen und danach Artikel veröffentlichen.',
	'KB_SETUP_ARTICLE'	=> '[anchor=kb_top][/anchor][b]Die Wissensdatenbank einrichten[/b]

Die Wissensdatenbank ist eine eigene Artikelbibliothek, kein Forum. Das Team schreibt Artikel; Leser blättern durch Kategorien. Die Einrichtung liegt komplett im Administrationsbereich.

[b]Sprungmarken[/b]
[list]
[*][anchor=toc_config goto=config]Konfiguration[/anchor]
[*][anchor=toc_cats goto=cats]Kategorien[/anchor]
[*][anchor=toc_types goto=types]Artikeltypen[/anchor]
[*][anchor=toc_perms goto=perms]Berechtigungen[/anchor]
[*][anchor=toc_write goto=write]Einen Artikel anlegen[/anchor]
[*][anchor=toc_lang goto=lang]Einen Artikel übersetzen[/anchor]
[/list]

[anchor=config][b]Konfiguration[/b][/anchor]

ACP → [b]Wissensdatenbank[/b] → [b]Konfiguration[/b].

Name und Beschreibung setzen, die Leser auf dem KB-Index sehen. Dann:
[list]
[*]Wie viele Artikel auf diesem Index
[*]Index-Layout: Modern oder Klassisch
[*]Cache-Zeit für Kategorien und Typen
[*]Ob Artikel einen Typ, eine Bewertung, eine Versionshistorie und „ähnliche Artikel“ haben dürfen
[*]Ob ein neuer Artikel auch ein Thema in einem Forum anlegt (Foren-ID [b]0[/b] schaltet das aus)
[/list]

Danach speichern.

[anchor=back_config goto=kb_top]Nach oben[/anchor]

[anchor=cats][b]Kategorien[/b][/anchor]

ACP → [b]Wissensdatenbank[/b] → [b]Kategorien[/b].

Zuerst eine Hauptkategorie, darunter Unterkategorien. Artikel gehören in die Unterkategorien; der Index selbst kann sie nicht aufnehmen.

Jeder Kategorie einen Namen geben, optional Beschreibung und Bild-URL. [b]In der Hauptkategorie anzeigen[/b], wenn sie auf der KB-Startseite erscheinen soll.

[anchor=back_cats goto=kb_top]Nach oben[/anchor]

[anchor=types][b]Artikeltypen[/b][/anchor]

ACP → [b]Wissensdatenbank[/b] → [b]Artikeltypen[/b].

Typen sind Labels wie Anleitung, FAQ oder Richtlinie. Sie sind optional. „Artikeltypen verwenden“ in der Konfiguration einschalten, wenn das Feld im Formular erscheinen soll.

[anchor=back_types goto=kb_top]Nach oben[/anchor]

[anchor=perms][b]Berechtigungen[/b][/anchor]

ACP → [b]Wissensdatenbank[/b] → Kategorieberechtigungen.

Festlegen, wer in jeder Kategorie Artikel sehen, anlegen, bearbeiten und freigeben darf. Ohne [b]kb_view_article[/b] sieht niemand diese Kategorie. Direktes Veröffentlichen ohne Moderator braucht [b]kb_add_article_direct[/b] (oder das Moderatorrecht [b]m_activate_kb[/b]).

[anchor=back_perms goto=kb_top]Nach oben[/anchor]

[anchor=write][b]Einen Artikel anlegen[/b][/anchor]

In der Wissensdatenbank eine Kategorie wählen und [b]Artikel hinzufügen[/b]. Titel, Beschreibung und Text ausfüllen. BBCode ist erlaubt.

Darf der Autor nicht direkt veröffentlichen, wartet der Artikel auf Freigabe durch Moderator oder Administrator. Danach ist er öffentlich.

[anchor=back_write goto=kb_top]Nach oben[/anchor]

[anchor=lang][b]Einen Artikel übersetzen[/b][/anchor]

Sie können einen Artikel in der Wissensdatenbank behalten und trotzdem je Forumsprache einen anderen Titel, eine andere Beschreibung und einen anderen Text zeigen.

[b]1. Einen kurzen Namen wählen[/b]

Großbuchstaben und Unterstriche. Beispiel: [b]PUSH_NOTIFICATIONS[/b].

Leser sehen diesen Namen nie. Er verknüpft den Artikel nur mit den Übersetzungen.

[b]2. Im Artikelformular nur den Platzhalter eintragen[/b]

Jedes Feld muss der Platzhalter sein und sonst nichts. Nicht mit anderem Text mischen.

[list]
[*]Titel: [b]{L_PUSH_NOTIFICATIONS}[/b]
[*]Beschreibung: [b]{L_PUSH_NOTIFICATIONS_DESC}[/b]
[*]Artikeltext: [b]{L_PUSH_NOTIFICATIONS_ARTICLE}[/b]
[/list]

[b]3. Den echten Text in die Sprachdateien schreiben[/b]

[b]language/en/kb/articles.php[/b] öffnen und drei Zeilen einfügen:

[code]PUSH_NOTIFICATIONS         => Push notifications
PUSH_NOTIFICATIONS_DESC    => Turn on browser alerts.
PUSH_NOTIFICATIONS_ARTICLE => The full article text goes here.[/code]

Dieselben drei Namen nach [b]language/nl/kb/articles.php[/b], [b]language/de/kb/articles.php[/b] und jeden anderen Sprachordner kopieren, mit dem übersetzten Text.

Englisch ist Pflicht. Fehlt eine Zeile in einer Sprache, wird der englische Text gezeigt.

[b]4. Datei speichern[/b]

Als UTF-8 ohne BOM speichern. Notepad++ kann das. Der Windows-Editor oft nicht, und das kann das Forum kaputtmachen.

Das ist alles. Nach dem Leeren des Caches sieht jeder Leser den Artikel in seiner Sprache.

[anchor=back_lang goto=kb_top]Nach oben[/anchor]',

// ===== END ARTICLE: KB_SETUP =====


// ===== START ARTICLE: K_LINKS_BANNER_UPLOAD =====
	'K_LINKS_BANNER_UPLOAD'			=> 'Site Banner Exchange',
	'K_LINKS_BANNER_UPLOAD_DESC'	=> 'Banner-Exchange-Forum, Berechtigungen, Upload-Ordner und Freigabeablauf für Site-Banner-Einreichungen einrichten.',
	'K_LINKS_BANNER_UPLOAD_ARTICLE'	=> '[anchor=klinks_top][/anchor][b]Site Banner Exchange[/b]

Der Site Banner Exchange kann ein Forum für Banner-Exchange-Einreichungen verwenden und vertrauenswürdigen Benutzern erlauben, zusammen mit dem Beitrag ein Banner hochzuladen. Die Funktion ist standardmäßig installiert. Administratoren müssen nur das Forum auswählen, Berechtigungen setzen und sicherstellen, dass die Upload-Ordner beschreibbar sind.

[b]Springe zu[/b]
[list]
[*][anchor=toc_forum goto=forum]Banner-Exchange-Forum erstellen[/anchor]
[*][anchor=toc_portal goto=portal]Mit dem Site-Banner-Exchange-Block verbinden[/anchor]
[*][anchor=toc_permission goto=permission]Banner-Upload-Berechtigung[/anchor]
[*][anchor=toc_folders goto=folders]Upload-Ordner[/anchor]
[*][anchor=toc_banner goto=banner]Banner-Bild erstellen[/anchor]
[*][anchor=toc_submit goto=submit]Banner-Exchange-Eintrag einreichen[/anchor]
[*][anchor=toc_approve goto=approve]Freigabe ist erforderlich[/anchor]
[*][anchor=toc_fix goto=fix]Wenn etwas nicht funktioniert[/anchor]
[/list]

[anchor=forum][b]Banner-Exchange-Forum erstellen[/b][/anchor]

Erstelle ein normales Forum für Banner-Exchange-Einreichungen. Notiere nach dem Speichern die Forum-ID. Diese ID wird später in den Einstellungen des Site-Banner-Exchange-Blocks benötigt.

Setze die normalen phpBB-Forenberechtigungen für die Gruppen oder Benutzer, die Zugriff haben sollen. Gib ihnen nur die Forenrechte, die sie brauchen, zum Beispiel Anzeigen, Lesen und Schreiben. Das steuert den Zugriff auf das Forum selbst.

Die Banner-Upload-Berechtigung ist getrennt. Ein Benutzer kann Zugriff auf das Forum haben, aber trotzdem kein Banner hochladen, wenn er nicht auch [b]Kann Portal-Link-Banner hochladen[/b] hat.

[anchor=back_forum goto=klinks_top]Nach oben[/anchor]

[anchor=portal][b]Mit dem Site-Banner-Exchange-Block verbinden[/b][/anchor]

Gehe zu den Portal-Block-Einstellungen für die Site-Banner-Exchange-Block-Variablen ([b]k_links_vars[/b]). Setze [b]Link forum ID[/b] auf die vorher notierte Forum-ID.

Der Banner-Upload-Tab gilt nur in diesem konfigurierten Forum. Wenn die Forum-ID falsch ist, können Benutzer eventuell in einem Forum schreiben, sehen dort aber nicht den erwarteten Banner-Ablauf.

[anchor=back_portal goto=klinks_top]Nach oben[/anchor]

[anchor=permission][b]Banner-Upload-Berechtigung[/b][/anchor]

Die Berechtigung heißt [b]u_k_links_upload[/b]. Im ACP erscheint sie unter Benutzer- oder Gruppenberechtigungen, in Erweiterte Berechtigungen → Beiträge, als [b]Kann Portal-Link-Banner hochladen[/b].

Standardmäßig haben Administratoren und globale Moderatoren diese Berechtigung. Sie ist außerdem in der Benutzerrolle [b]All Features[/b] enthalten. Weise sie für jede andere Gruppe oder jeden anderen Benutzer nur manuell zu, wenn sie Banner einreichen dürfen sollen.

Dies ist eine globale Benutzer-/Gruppenberechtigung. Sie ersetzt keine Forenberechtigungen. Der Benutzer braucht weiterhin Zugriff auf das konfigurierte Banner-Exchange-Forum.

[anchor=back_permission goto=klinks_top]Nach oben[/anchor]

[anchor=folders][b]Upload-Ordner[/b][/anchor]

Das Board verwendet zwei Ordner:

[list]
[*][b]images/links/tmp/[/b] — wartende Banner-Uploads liegen hier.
[*][b]images/links/[/b] — freigegebene Banner werden hierher verschoben.
[/list]

Beide Ordner müssen für den Webserver beschreibbar sein. Wenn [b]images/links/tmp/[/b] nicht existiert, kann der Upload-Code versuchen, ihn anzulegen. Sicherer ist es, den Ordner bei der Einrichtung zu erstellen und die Rechte zu prüfen.

[anchor=back_folders goto=klinks_top]Nach oben[/anchor]

[anchor=banner][b]Banner-Bild erstellen[/b][/anchor]

Erstelle ein Banner-Bild mit höchstens [b]200px Breite und 50px Höhe[/b]. Erlaubte Dateitypen sind [b]JPG[/b], [b]JPEG[/b], [b]GIF[/b] und [b]PNG[/b].

Benenne das Bild nach der endgültigen Webadresse, die es öffnen soll. Da ein Dateiname kein [b]/[/b] enthalten kann, ersetze jeden Schrägstrich im URL-Pfad durch [b]+[/b]. Verwende im Dateinamen kein [b]https://[/b] oder [b]http://[/b].

Beispiel: Für [b]https://integramod.com/forum/[/b] heißt das Bild [b]integramod.com+forum.jpg[/b]. Du kannst denselben Namen auch mit einer anderen erlaubten Erweiterung verwenden, zum Beispiel [b]integramod.com+forum.jpeg[/b], [b]integramod.com+forum.gif[/b] oder [b]integramod.com+forum.png[/b].

Wenn der Site-Banner-Exchange-Block das freigegebene Banner anzeigt, baut er die URL aus dem Dateinamen wieder auf, indem [b]+[/b] durch [b]/[/b] ersetzt wird.

[anchor=back_banner goto=klinks_top]Nach oben[/anchor]

[anchor=submit][b]Banner-Exchange-Eintrag einreichen[/b][/anchor]

Ein berechtigter Benutzer öffnet das als Banner-Exchange-Forum konfigurierte Forum und startet einen Beitrag. Das Beitragsformular zeigt den Upload-Tab [b]Site Banner Exchange[/b].

Lade das vorbereitete JPG-, JPEG-, GIF- oder PNG-Banner hoch. Die Datei wird nicht sofort veröffentlicht. Sie wird in [b]images/links/tmp/[/b] zwischengespeichert, während der Beitrag auf Freigabe wartet.

[anchor=back_submit goto=klinks_top]Nach oben[/anchor]

[anchor=approve][b]Freigabe ist erforderlich[/b][/anchor]

Alle Banner-Exchange-Einreichungen benötigen die Freigabe durch einen Administrator oder Moderator, bevor die Einreichung abgeschlossen ist. Der Beitrag muss über die normale Moderationswarteschlange freigegeben werden.

Wenn ein Administrator oder Moderator den Beitrag freigibt, wird das zwischengespeicherte Banner aus [b]images/links/tmp/[/b] nach [b]images/links/[/b] verschoben. Der Warteschlangeneintrag wird mit Freigeber und Freigabezeit markiert.

Bis diese Freigabe erfolgt, ist das Banner nur wartend. Es sollte nicht als aktives Site-Banner-Exchange-Banner behandelt werden.

[anchor=back_approve goto=klinks_top]Nach oben[/anchor]

[anchor=fix][b]Wenn etwas nicht funktioniert[/b][/anchor]

[list]
[*][b]Der Tab fehlt[/b] — prüfe die richtige Link forum ID im Site-Banner-Exchange-Block, den Forenzugriff des Benutzers und die Berechtigung [b]Kann Portal-Link-Banner hochladen[/b].
[*][b]Upload schlägt fehl[/b] — prüfe, dass die Datei JPG, JPEG, GIF oder PNG ist, höchstens 200px × 50px groß ist, nach der Ziel-URL benannt wurde und [b]images/links/[/b] sowie [b]images/links/tmp/[/b] beschreibbar sind.
[*][b]Das Banner wird nicht verschoben[/b] — prüfe, dass der Beitrag über die Moderationswarteschlange freigegeben wurde und die temporäre Datei noch existiert.
[*][b]Berechtigungsänderungen erscheinen nicht[/b] — leere den phpBB-Cache und lade die ACP-Berechtigungsseite neu.
[/list]

[anchor=back_fix goto=klinks_top]Nach oben[/anchor]',

// ===== END ARTICLE: K_LINKS_BANNER_UPLOAD =====


// ===== START ARTICLE: STYLE_INSTALL =====
	'STYLE_INSTALL'			=> 'Einen Style installieren',
	'STYLE_INSTALL_DESC'	=> 'Einen Style-Ordner hochladen und im Administrationsbereich installieren.',
	'STYLE_INSTALL_ARTICLE'	=> '[anchor=style_top][/anchor][b]Einen Style installieren[/b]

Ein Style ist das komplette Aussehen des Forums: Template, Theme (CSS/Bilder) und Imageset. core und Alpha sind vollständige Styles. Andere erben von _portal_common und überschreiben nur, was sie brauchen.

[b]Sprungmarken[/b]
[list]
[*][anchor=toc_parent goto=parent]Styles, die zuerst prosilver brauchen[/anchor]
[*][anchor=toc_upload goto=upload]Dateien auf den Server legen[/anchor]
[*][anchor=toc_acp goto=acp]Im ACP installieren[/anchor]
[*][anchor=toc_default goto=default]Als Forumstandard setzen[/anchor]
[*][anchor=toc_users goto=users]Benutzer noch auf dem alten Style[/anchor]
[*][anchor=toc_notes goto=notes]Vererbung und Cache[/anchor]
[/list]

[anchor=parent][b]Styles, die zuerst prosilver brauchen[/b][/anchor]

[b]fiproice[/b], [b]IM_prosilver[/b] und [b]MiMic[/b] erben fehlende Dateien von [b]prosilver[/b]. Installieren und behalten Sie prosilver [i]bevor[/i] Sie diese drei installieren. Fehlt prosilver, brechen Seiten oder wirken halb gestylt.

core und Alpha brauchen prosilver nicht. Das sind vollständige Styles.

[anchor=back_parent goto=style_top]Nach oben[/anchor]

[anchor=upload][b]Dateien auf den Server legen[/b][/anchor]

[list=1]
[*]Das Style-Paket herunterladen und auf dem Rechner entpacken.
[*]Es muss ein Ordner mit [b]style.cfg[/b] darin sein (meist auch [b]template/[/b], [b]theme/[/b], [b]imageset/[/b]).
[*]Diesen Ordner nach [b]styles/[/b] auf dem Forum hochladen. Der Pfad muss [b]styles/StyleName/style.cfg[/b] sein, nicht eine Ebene tiefer.
[*]Den Ordnernamen genau so lassen wie geliefert. core oder Alpha nicht umbenennen, außer Sie ändern auch [b]style.cfg[/b].
[/list]

FTP oder der Dateimanager des Hosts funktionieren beide. Der Webserver muss die Dateien lesen können.

[anchor=back_upload goto=style_top]Nach oben[/anchor]

[anchor=acp][b]Im ACP installieren[/b][/anchor]

[list=1]
[*]Als Administrator anmelden.
[*]Zu [b]ACP → Styles → Styles[/b] gehen.
[*]Wenn Sie fiproice, IM_prosilver oder MiMic installieren, zuerst prüfen, ob [b]prosilver[/b] schon in der installierten Liste steht. Falls nicht, zuerst installieren.
[*]Unter nicht installierten Styles den neuen Namen finden und auf [b]Style installieren[/b] klicken.
[*]Bestätigen. Braucht der Style ein übergeordnetes Template, Theme oder Imageset, das noch fehlt, sagt das ACP das. Die zuerst installieren.
[/list]

Installierte Styles stehen in der Liste mit einer Benutzerzahl. Der aktuelle Standard hat ein Sternchen (*).

[anchor=back_acp goto=style_top]Nach oben[/anchor]

[anchor=default][b]Als Forumstandard setzen[/b][/anchor]

Auf derselben Seite den Style als Forumstandard setzen, wenn alle ihn bekommen sollen. Er kann installiert, aber nicht Standard sein, wenn Benutzer selbst wählen dürfen.

Einen Style deaktivieren statt löschen, wenn er nur aus der Benutzerliste soll. Prosilver nicht deinstallieren, solange fiproice, IM_prosilver oder MiMic noch genutzt werden.

[anchor=back_default goto=style_top]Nach oben[/anchor]

[anchor=users][b]Benutzer noch auf dem alten Style[/b][/anchor]

Der gespeicherte Style eines Benutzers ändert sich nicht immer, wenn Sie den Forumstandard wechseln. Ist „Benutzerstyle überschreiben“ aus, behalten sie die alte Wahl, bis sie im Benutzerkontrollzentrum den neuen wählen.

Um das neue Aussehen zu erzwingen: ACP → [b]Board-Einstellungen[/b] (oder Benutzereinstellungen) und Benutzerstyle überschreiben einschalten, oder Benutzer unter [b]Benutzer und Gruppen[/b] bearbeiten.

[anchor=back_users goto=style_top]Nach oben[/anchor]

[anchor=notes][b]Vererbung und Cache[/b][/anchor]

[list]
[*]Styles, die von prosilver erben, brauchen nur die Dateien, die sie überschreiben. Fehlende Templates fallen auf den Elternstyle zurück.
[*]Nach Installieren oder Bearbeiten von Templates den Forum-Cache leeren: ACP → [b]Allgemein[/b] → [b]Cache leeren[/b]. Auch Dateien in [b]cache/[/b] löschen, wenn eine Änderung nicht erscheint.
[*]Keine Dateien zweier Styles in einem Ordner mischen. Ein komplettes Style-Paket hochladen.
[*]Alpha ist dieselbe moderne core-Codebasis im Retro-Forumlook, kein älterer Vorgänger.
[/list]

[anchor=back_notes goto=style_top]Nach oben[/anchor]',

// ===== END ARTICLE: STYLE_INSTALL =====


// ===== START ARTICLE: IM_INSTALL =====
	'IM_INSTALL'			=> 'IntegraMOD 3 installieren',
	'IM_INSTALL_DESC'		=> 'Paket hochladen, Cache wählen, Installer ausführen, danach das Forum absichern.',
	'IM_INSTALL_ARTICLE'	=> '[anchor=im_top][/anchor][b]IntegraMOD 3 installieren[/b]

IntegraMOD 3 ist ein komplettes Forenpaket. Dateien hochladen, den Installer einmal ausführen, dann Ordner entfernen, die auf einer Live-Seite nichts zu suchen haben. Sie brauchen einen Webhost mit PHP und einer Datenbank. Kennen Sie die Datenbankdaten nicht, fragen Sie den Host vorher.

[b]Sprungmarken[/b]
[list]
[*][anchor=toc_need goto=need]Was Sie brauchen[/anchor]
[*][anchor=toc_files goto=files]Dateien auf den Server legen[/anchor]
[*][anchor=toc_perm goto=perm]Ordnerrechte[/anchor]
[*][anchor=toc_cache goto=cache]Cache-Auswahl[/anchor]
[*][anchor=toc_run goto=run]Installer ausführen[/anchor]
[*][anchor=toc_after goto=after]Danach — diese Ordner löschen[/anchor]
[*][anchor=toc_config goto=config]config.php absichern[/anchor]
[*][anchor=toc_stuck goto=stuck]Wenn etwas scheitert[/anchor]
[/list]

[anchor=need][b]Was Sie brauchen[/b][/anchor]

[list]
[*]PHP 7.4 oder neuer (bis PHP 8.5)
[*]Eine Datenbank: MySQL / MariaDB ist üblich. PostgreSQL, SQLite, Firebird, MS SQL und Oracle gehen auch, wenn der Host sie anbietet
[*]FTP oder einen Dateimanager zum Hochladen
[*]Datenbankname, Benutzer, Passwort und Server-Hostname vom Host
[/list]

[anchor=back_need goto=im_top]Nach oben[/anchor]

[anchor=files][b]Dateien auf den Server legen[/b][/anchor]

[list=1]
[*]Das IntegraMOD-Paket auf dem Rechner entpacken.
[*][b]Alles[/b] in einen Webordner hochladen, mit denselben Ordnern und Namen. Namen nicht in Kleinbuchstaben zwingen.
[*]Ein typischer Pfad ist [b]https://example.com/forum/[/b] oder die Site-Wurzel.
[/list]

Mit SSH können Sie das Zip hochladen und auf dem Server entpacken statt Tausende Dateien per FTP.

[anchor=back_files goto=im_top]Nach oben[/anchor]

[anchor=perm][b]Ordnerrechte[/b][/anchor]

Der Installer muss ein paar Pfade schreiben können:

[list]
[*][b]config.php[/b] — nur während der Installation beschreibbar (oft 666). Danach ändern; siehe [anchor=toc_config_jump goto=config]config.php absichern[/anchor]
[*][b]store/[/b], [b]cache/[/b], [b]files/[/b], [b]images/avatars/upload/[/b] — beschreibbar (oft 777 auf Shared Hosting)
[/list]

FTP-Programm oder Dateimanager des Hosts können das setzen.

[anchor=back_perm goto=im_top]Nach oben[/anchor]

[anchor=cache][b]Cache-Auswahl[/b][/anchor]

Der Installer fragt, wo das Forum Cache-Daten speichern soll. Wählen Sie, was der Host wirklich hat.

[list]
[*][b]File (Standard)[/b] — schreibt Cachedateien unter [b]store/[/b]. Einfach und zuverlässig. Auf den meisten Shared Hosts nehmen.
[*][b]Memcache[/b] oder [b]Memcached[/b] — schneller Speicher-Cache. Braucht die PHP-Erweiterung und einen memcached-Server.
[*][b]Redis[/b] — schneller Speicher mit Extrafunktionen. Braucht die Redis-Erweiterung und einen Redis-Server.
[*][b]APC / APCu[/b] — Speicher-Cache in PHP auf einem Server.
[*][b]WinCache[/b] — nur Windows-Hosts.
[*][b]XCache[/b] / [b]eAccelerator[/b] — ältere Opcode-Caches; nur wenn der Host sie noch hat.
[*][b]Memory (nur Prozess)[/b] — schnell, aber jeder PHP-Prozess hat eigenen Cache. Nicht geteilt.
[*][b]Kein Cache[/b] — nur zum Debuggen. Nicht auf einem Live-Forum.
[/list]

Unsicher? [b]File[/b] lassen. Später im ACP ändern, wenn der Host Memcached oder Redis nachrüstet.

[anchor=back_cache goto=im_top]Nach oben[/anchor]

[anchor=run][b]Installer ausführen[/b][/anchor]

Öffnen Sie [b]https://ihre-seite/forum/install/[/b] ([b]install/[/b] an den Upload-Pfad anhängen).

[list=1]
[*]Intro lesen, dann den Reiter [b]INSTALL[/b] öffnen.
[*]Die Anforderungsseite prüft PHP und Ordner. Pflichtpunkte beheben, bevor Sie weitergehen.
[*]Datenbanktyp, Hostname, Name, Benutzer und Passwort eintragen. Port leer lassen, außer der Host hat einen genannt. Tabellenpräfix behalten, außer Sie haben schon ein anderes Forum in derselben Datenbank.
[*]Cache-Typ wählen (siehe oben).
[*]Das erste Administratorkonto anlegen (Ihr Login).
[*][b]config.php[/b] schreiben lassen. Geht das nicht, zeigt er den Inhalt zum Einfügen von Hand.
[/list]

Steht dort Glückwunsch, ist das Forum installiert.

[anchor=back_run goto=im_top]Nach oben[/anchor]

[anchor=after][b]Danach — diese Ordner löschen[/b][/anchor]

Diese Pfade gehören nicht auf eine öffentliche Seite. Aus der Webwurzel löschen (oder vom Server nehmen). Liegenlassen ist ein Sicherheitsloch.

[list]
[*][b]install/[/b] — [b]muss[/b] weg. Solange der Ordner da ist, funktioniert nur das Administrations-Control-Panel, und wer ihn öffnet, kann das Forum zerstören.
[*][b]develop/[/b] — [b]diesen besonders löschen.[/b] Entwicklungswerkzeuge und Testcode. Nie auf einem Live-Forum lassen.
[*][b]stk/[/b] — Support Toolkit. Nützlich bei einem kaputten Forum; gefährlich, wenn Fremde ihn öffnen können. Entfernen, wenn Sie fertig sind.
[*][b]docs/[/b] — Installationshinweise. Nach dem Lesen löschen.
[/list]

Optional: ein altes phpBB-2-Forum über den Konverter-Link auf der Erfolgsseite umstellen, [i]bevor[/i] Sie [b]install/[/b] löschen.

Dann mit dem angelegten Administratorkonto anmelden.

[anchor=back_after goto=im_top]Nach oben[/anchor]

[anchor=config][b]config.php absichern[/b][/anchor]

[b]config.php[/b] enthält das Datenbankpasswort. Während der Installation oft [b]666[/b] (für alle beschreibbar), damit der Installer schreiben kann. Das darf nicht so bleiben.

Nach der Installation:

[list]
[*][b]config.php[/b] auf [b]644[/b] setzen (oder [b]640[/b], wenn der Host das erlaubt). Der Webserver muss sie noch [i]lesen[/i] können.
[*]Nicht bei [b]666[/b] lassen. Wer diese Datei schreiben kann, besitzt die Datenbank.
[/list]

[anchor=back_config goto=im_top]Nach oben[/anchor]

[anchor=stuck][b]Wenn etwas scheitert[/b][/anchor]

[list]
[*][b]Could not connect to the database[/b] — Hostname, Name, Benutzer oder Passwort falsch. Host fragen.
[*]Ein Ordner ist nicht beschreibbar — Rechte neu setzen, dann auf der Anforderungsseite erneut testen.
[*]Leere Seite nach der Installation — [b]install/[/b] ist noch da, oder [b]cache/[/b] ist nicht beschreibbar.
[*]PHP zu alt — der Host muss PHP 7.4 oder neuer haben.
[/list]

Mehr steht in [b]docs/INSTALL.html[/b] im Paket (lesen, bevor Sie [b]docs/[/b] löschen).

[anchor=back_stuck goto=im_top]Nach oben[/anchor]',
));

// ===== END ARTICLE: IM_INSTALL =====
