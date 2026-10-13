<?php
/**
*
* Knowledge Base article catalog [Dutch]
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
    'RANDOM_TITLE'       => 'Voorbeeld van een gelokaliseerde titel',
    'RANDOM_DESCRIPTION' => 'Voorbeeld van een gelokaliseerde beschrijving',
    'RANDOM_ARTICLE'     => 'Dit is een voorbeeld van de tekst van een gelokaliseerd Kennisbank-artikel. U kunt hier BBCode gebruiken.',

// ===== END ARTICLE: RANDOM =====


// ===== START ARTICLE: SAVE_FORUM_APP =====
    'SAVE_FORUM_APP'			=> 'Het forum als app opslaan',
    'SAVE_FORUM_APP_DESC'		=> 'Zet het forum op het bureaublad, startscherm of Dock, zodat het opent als een app.',
    'SAVE_FORUM_APP_ARTICLE'	=> '[anchor=app_top][/anchor][b]IntegraMOD als app[/b]

Het forum op je bureaublad of startscherm zetten is maar een snelkoppeling, maar wel een handige. Je opent het in een eigen venster in plaats van te zoeken in een stapel tabs. Op de telefoon staat het naast je andere apps en start het vol scherm. Eén tik op de taakbalk, het Dock of het startscherm en je zit erin.

Internet heb je nog steeds nodig, en je blijft ingelogd zoals in de browser waarmee je het hebt toegevoegd. Er wordt niets uit een store gedownload.

Kies de browser die je echt gebruikt en spring naar de stappen.

[b]Desktopbrowsers[/b]
[list]
[*][anchor=toc_chrome goto=chrome]Google Chrome[/anchor]
[*][anchor=toc_edge goto=edge]Microsoft Edge[/anchor]
[*][anchor=toc_safari_mac goto=safari_mac]Safari (Mac)[/anchor]
[*][anchor=toc_firefox_desk goto=firefox_desk]Firefox[/anchor]
[/list]

[b]Mobiele browsers[/b]
[list]
[*][anchor=toc_safari_ios goto=safari_ios]Safari (iPhone / iPad)[/anchor]
[*][anchor=toc_chrome_and goto=chrome_and]Chrome (Android)[/anchor]
[*][anchor=toc_firefox_and goto=firefox_and]Firefox (Android)[/anchor]
[/list]

[b]Daarna[/b]
[list]
[*][anchor=toc_push_top goto=push]Pushmeldingen inschakelen[/anchor]
[/list]

[anchor=chrome][b]Google Chrome (desktop)[/b][/anchor]

Werkt op Windows, macOS en Linux.

[list=1]
[*]Open het forum in Chrome.
[*]In de adresbalk zit vaak een klein installatiepictogram. Meestal een computer met een pijl omlaag, of een plus op een scherm.
[*]Geen pictogram? Open het menu met drie puntjes en kies [b]App installeren[/b] of [b]Deze site als app installeren[/b].
[*]Houd of wijzig de naam en klik op [b]Installeren[/b].
[/list]

Chrome zet het in het Startmenu of de map Programma’s. Pin het aan de taakbalk of het Dock als je het met één klik wilt. Het opent in een kaal venster zonder de gewone tabbalk.

Om het later weg te doen open je de app, het menu, en kies je Verwijderen.

[anchor=back_chrome goto=app_top]Terug naar boven[/anchor]

[anchor=edge][b]Microsoft Edge (desktop)[/b][/anchor]

Hetzelfde idee als Chrome, en de tekst is bijna identiek.

[list=1]
[*]Open het forum in Edge.
[*]Klik op het installatiepictogram in de adresbalk als je het ziet.
[*]Anders het menu met drie puntjes en [b]Apps → Deze site als app installeren[/b].
[*]Bevestig de naam en klik op [b]Installeren[/b].
[/list]

Daarna kun je het vastzetten op de taakbalk of Start. Verwijderen via het app-menu, of de snelkoppeling wissen.

[anchor=back_edge goto=app_top]Terug naar boven[/anchor]

[anchor=safari_mac][b]Safari (Mac)[/b][/anchor]

[list=1]
[*]Open het forum in Safari.
[*]Kies [b]Archief → Voeg toe aan Dock[/b]. Sommige versies stoppen het onder Deel.
[*]Bevestig de naam en voeg het toe.
[/list]

Safari legt een pictogram in het Dock. Een klik opent het forum in een eigen venster.

[anchor=back_safari_mac goto=app_top]Terug naar boven[/anchor]

[anchor=firefox_desk][b]Firefox (desktop)[/b][/anchor]

Firefox installeert web-apps niet zoals Chrome of Edge. Dichtbij houden kan nog steeds:

[list]
[*]bookmark het forum, of
[*]sleep het slot-/sitepictogram uit de adresbalk naar het bureaublad.
[/list]

Die snelkoppeling opent nog steeds een gewoon Firefox-venster, maar scheelt het zoeken in bladwijzers.

[anchor=back_firefox_desk goto=app_top]Terug naar boven[/anchor]

[anchor=safari_ios][b]Safari (iPhone / iPad)[/b][/anchor]

Gebruik Safari. Chrome op de iPhone kan niet op dezelfde manier een echte beginscherm-app toevoegen.

[list=1]
[*]Open het forum in Safari.
[*]Tik op [b]Deel[/b] (het vierkant met de pijl omhoog).
[*]Scroll het deelblad en tik op [b]Zet op beginscherm[/b].
[*]Pas de naam desgewenst aan en tik op [b]Voeg toe[/b].
[/list]

Het pictogram landt op het beginscherm en opent het forum vol scherm.

Zie je Zet op beginscherm niet, tik in het deelblad op Wijzig acties of Meer en zet het aan.

[anchor=back_safari_ios goto=app_top]Terug naar boven[/anchor]

[anchor=chrome_and][b]Chrome (Android)[/b][/anchor]

[list=1]
[*]Open het forum in Chrome.
[*]Tik op het menu met drie puntjes.
[*]Tik op [b]App installeren[/b] of [b]Toevoegen aan startscherm[/b].
[*]Bevestig [b]Installeren[/b] of [b]Toevoegen[/b].
[/list]

Soms toont Android onderaan ook een Installeren-banner. Die werkt ook.

Het pictogram verschijnt op het startscherm of in de app-lade en opent in een eigen venster.

[anchor=back_chrome_and goto=app_top]Terug naar boven[/anchor]

[anchor=firefox_and][b]Firefox (Android)[/b][/anchor]

[list=1]
[*]Open het forum in Firefox.
[*]Open het browsermenu.
[*]Tik op [b]Installeren[/b] of [b]Toevoegen aan startscherm[/b] als je telefoon dat aanbiedt.
[/list]

Ontbreekt die optie, voeg dan een bladwijzer toe. Minder netjes dan een app-pictogram, maar nog steeds één tik verwijderd.

[anchor=back_firefox_and goto=app_top]Terug naar boven[/anchor]

[b]Als het erop staat[/b]
[list]
[*][anchor=toc_push goto=push]Pushmeldingen inschakelen[/anchor]
[/list]

[anchor=push][b]Pushmeldingen inschakelen[/b][/anchor]

Het pictogram zet meldingen niet aan. Het is alleen een venster van dezelfde browser waarmee je het hebt toegevoegd. Push hoort bij die browser en start pas nadat je het toestaat terwijl je bent ingelogd.

Open het forum via het nieuwe pictogram, niet via een oude tab. Log daar in. Ga daarna in je profiel naar [b]Gebruikerspaneel[/b] → [b]Foruminstellingen[/b] → [b]Pushmeldingen[/b].

Die pagina schrijft [i]deze[/i] browser of dit appvenster in. Klik op [b]Browsermeldingen inschakelen[/b]. De browser vraagt om toestemming; kies [b]Toestaan[/b]. Als het gelukt is, staat er [b]Deze browser is geabonneerd.[/b]

Die toestemming laat het forum alleen versturen. Daaronder vink je [b]Web Push[/b] aan bij de gebeurtenissen die je wilt (privéberichten, likes, geabonneerde onderwerpen, enzovoort) en klik je op [b]Bevestig[/b].

Herhaal dit op elke telefoon, tablet of computer waarop je het forum hebt gezet. Inschakelen op één apparaat zet het niet aan op de andere. Doet [b]Browsermeldingen inschakelen[/b] niets, dan blokkeert de browser of een extensie meldingen voor deze site. Sta ze toe voor het forum en klik opnieuw.

[b]Nog een paar punten[/b]
[list]
[*]Open het nieuwe pictogram eenmaal en log in. Die login blijft bij de browser waarmee je het hebt toegevoegd.
[*]Opent het pictogram een lege pagina, verwijder het dan en voeg het opnieuw toe vanaf het actuele HTTPS-adres, niet vanaf een oude bladwijzer.
[*]Forumupdates dwingen je niet het pictogram opnieuw te maken.
[/list]

[anchor=back_push goto=app_top]Terug naar boven[/anchor]',

// ===== END ARTICLE: SAVE_FORUM_APP =====


// ===== START ARTICLE: PUSH_NOTIFICATIONS =====
	'PUSH_NOTIFICATIONS'			=> 'Pushmeldingen',
	'PUSH_NOTIFICATIONS_DESC'		=> 'Zet browsermeldingen aan voor privéberichten, likes en andere forumgebeurtenissen.',
	'PUSH_NOTIFICATIONS_ARTICLE'	=> '[anchor=push_top][/anchor][b]Pushmeldingen[/b]

Push is een korte melding van het forum als er iets gebeurt terwijl je niet kijkt. Een privébericht, een like, een reactie in een onderwerp dat je volgt. Het verschijnt in de browser of op de telefoon, net als bij andere sites.

Het forum kan versturen. Je browser moet het toestaan. Dat doe je één keer per apparaat, terwijl je bent ingelogd.

[b]Spring naar[/b]
[list]
[*][anchor=toc_before goto=before]Voor je begint[/anchor]
[*][anchor=toc_enable goto=enable]Inschakelen[/anchor]
[*][anchor=toc_events goto=events]Gebeurtenissen kiezen[/anchor]
[*][anchor=toc_devices goto=devices]Meer dan één apparaat[/anchor]
[*][anchor=toc_sms goto=sms]SMS (optioneel)[/anchor]
[*][anchor=toc_admin goto=admin]Instellen door de beheerder[/anchor]
[*][anchor=toc_fix goto=fix]Als het niet werkt[/anchor]
[/list]

[anchor=before][b]Voor je begint[/b][/anchor]

[list]
[*]Gebruik HTTPS. Push werkt niet op een gewoon http-adres.
[*]Log in. Gasten kunnen zich niet abonneren.
[*]Open het forum in de browser (of het appvenster) waarin je meldingen wilt. Toestemming hoort bij die browser, niet bij je hele account.
[/list]

Heb je het forum als app toegevoegd, open het dan via dat pictogram, niet via een oude tab. Volg daarna de stappen in dat venster.

[anchor=back_before goto=push_top]Terug naar boven[/anchor]

[anchor=enable][b]Inschakelen[/b][/anchor]

[list=1]
[*]Open [b]Gebruikerspaneel[/b] → [b]Foruminstellingen[/b] → [b]Pushmeldingen[/b].
[*]Klik op [b]Browsermeldingen inschakelen[/b] (soms staat er [b]Bureaubladmeldingen inschakelen[/b]).
[*]Als de browser vraagt, kies [b]Toestaan[/b].
[*]Daarna moet er staan [b]Deze browser is geabonneerd.[/b]
[/list]

Die toestemming laat het forum alleen versturen. De gebeurtenissen kies je daarna.

[anchor=back_enable goto=push_top]Terug naar boven[/anchor]

[anchor=events][b]Gebeurtenissen kiezen[/b][/anchor]

Onder de abonnementsstatus vink je [b]Web Push[/b] aan bij de gebeurtenissen die je wilt, en klik je op [b]Bevestig[/b].

Typische gebeurtenissen (alleen wat de beheerder heeft aangezet, is zichtbaar):
[list]
[*]Privéberichten
[*]Likes
[*]Vriendschapsverzoeken en acceptaties
[*]Reacties op berichten die je volgt
[*]Updates in onderwerpen die je volgt
[*]Nieuws en aankondigingen
[*]Vermeldingen, wanneer iemand @uwnaam schrijft in een toegestaan forum
[*]Nieuwe registraties en nieuwe berichten, voor het team of de groepen die de beheerder koos
[/list]

Laat een vak leeg als je die melding niet wilt.

[anchor=back_events goto=push_top]Terug naar boven[/anchor]

[anchor=devices][b]Meer dan één apparaat[/b][/anchor]

Inschakelen op één telefoon, tablet of computer zet het niet aan op de andere. Herhaal de stappen in elk browservenster of appvenster dat je hebt geïnstalleerd.

[anchor=back_devices goto=push_top]Terug naar boven[/anchor]

[anchor=sms][b]SMS (optioneel)[/b][/anchor]

Als de beheerder SMS heeft aangezet, kan dezelfde pagina een landcode en mobiel nummer vragen. Dat nummer wordt versleuteld bewaard. Vink [b]SMS Push[/b] alleen aan bij de gebeurtenissen die je als sms wilt.

[anchor=back_sms goto=push_top]Terug naar boven[/anchor]

[anchor=admin][b]Instellen door de beheerder[/b][/anchor]

Open [b]ACP → Algemeen → Pushmeldingen → Instellingen[/b]. Browsermeldingen gebruiken OneSignal. SMS kan OneSignal of Twilio gebruiken.

[b]OneSignal[/b]
[list]
[*]Maak een app bij OneSignal en plak de [b]App ID[/b] en [b]REST API key[/b] in de bijbehorende velden.
[*]De site moet HTTPS gebruiken. Het domein moet ook toegestaan zijn in de OneSignal-app.
[*]Zonder App ID kan niemand zich abonneren op browsermeldingen.
[/list]

[b]Twilio[/b]
[list]
[*]Zet [b]SMS gateway[/b] op [b]Twilio[/b]. Laat OneSignal staan als SMS via OneSignal moet gaan.
[*][b]Twilio SID[/b] is de Account SID uit de Twilio-console.
[*][b]Twilio Token[/b] is de Auth Token van dat account.
[*][b]Twilio From Number[/b] is het Twilio-verzendnummer met landcode, bijvoorbeeld +15551234567.
[*]De Twilio-velden worden genegeerd zolang de gateway op OneSignal staat.
[/list]

[b]Gebeurtenisopties[/b]

De tabel zet elke gebeurtenis aan of uit voor [b]Web Push[/b] en [b]SMS Push[/b]. Een gebruiker kan een gebeurtenis pas kiezen nadat die hier is ingeschakeld.

[list]
[*][b]Nieuwe registratie[/b] gaat alleen naar oprichters en beheerders. Vink [b]Include moderators[/b] aan als moderators die ook moeten ontvangen.
[*][b]Nieuw bericht[/b] gaat naar hetzelfde publiek. Gebruik [b]New-post groups[/b] om andere groepen toe te voegen. Houd Ctrl ingedrukt om meerdere groepen te kiezen.
[*][b]Vermelding[/b] waarschuwt een gebruiker bij een geldige @gebruikersnaam. De gebruiker moet die ook inschakelen in het gebruikerspaneel.
[/list]

[b]Vermeldingen[/b]

Vermeldingen hebben twee instellingen, en beide moeten aan staan:
[list]
[*][b]ACP → Plaatsen → Berichten → Berichtinstellingen → Vermeldingen toestaan[/b] geldt voor het hele forum. De eerste keer inschakelen zet vermeldingen aan voor bestaande forums.
[*][b]ACP → Forums → Forum maken of bewerken → Vermeldingen toestaan[/b] geldt voor één forum. Nieuwe forums beginnen ingeschakeld. Vink het uit voor een forum zonder vermeldingen.
[/list]

Een gebruiker typt @naam in de editor of snelle reactie en kiest een naam uit de lijst. Het bericht bewaart dit als vermeldingstag. Staat een instelling uit, dan verschijnt de lijst niet en wordt er geen melding verstuurd.

[anchor=back_admin goto=push_top]Terug naar boven[/anchor]

[anchor=fix][b]Als het niet werkt[/b][/anchor]

[list]
[*]De knop doet niets, of de pagina zegt nergens dat de browser is geabonneerd: meldingen voor deze site zijn geblokkeerd. Sta ze toe in de browserinstellingen en klik opnieuw.
[*]Een extensie zoals uBlock, AdGuard, Brave Shields, DuckDuckGo of de strikte trackingbescherming van Firefox kan de meldingsdienst blokkeren. Sta die toe voor dit forum.
[*]Je bent niet ingelogd, of je opende een oude HTTP-bladwijzer.
[*]Je hebt het in de ene browser toegestaan en wacht in een andere. Abonneer elke browser apart.
[/list]

Beheerders stellen de dienst in onder [b]ACP → Algemeen → Pushmeldingen → Instellingen[/b]. Zonder OneSignal App ID kan niemand zich abonneren. Voor SMS moet de gekozen gateway, OneSignal of Twilio, ook ingevuld zijn. Een vermelding waarschuwt alleen als de site, het forum en de gebruikersvoorkeur allemaal aan staan.

[anchor=back_fix goto=push_top]Terug naar boven[/anchor]',

// ===== END ARTICLE: PUSH_NOTIFICATIONS =====


// ===== START ARTICLE: KB_SETUP =====
	'KB_SETUP'			=> 'De Kennisbank instellen',
	'KB_SETUP_DESC'		=> 'Maak categorieën, types en permissies, en publiceer daarna artikelen.',
	'KB_SETUP_ARTICLE'	=> '[anchor=kb_top][/anchor][b]De Kennisbank instellen[/b]

De Kennisbank is een aparte artikelenbibliotheek, geen forum. Staf schrijft artikelen; lezers bladeren door categorieën. De instellingen staan allemaal in het Beheerderspaneel.

[b]Spring naar[/b]
[list]
[*][anchor=toc_config goto=config]Configuratie[/anchor]
[*][anchor=toc_cats goto=cats]Categorieën[/anchor]
[*][anchor=toc_types goto=types]Artikeltypes[/anchor]
[*][anchor=toc_perms goto=perms]Permissies[/anchor]
[*][anchor=toc_write goto=write]Een artikel toevoegen[/anchor]
[*][anchor=toc_lang goto=lang]Een artikel vertalen[/anchor]
[/list]

[anchor=config][b]Configuratie[/b][/anchor]

ACP → [b]Kennisbank[/b] → [b]Configuratie[/b].

Zet de naam en beschrijving die lezers op de KB-index zien. Daarna:
[list]
[*]Hoeveel artikelen op die index
[*]Indeling van de index: Modern of Klassiek
[*]Cachetijd voor categorieën en types
[*]Of artikelen een type, een beoordeling, een geschiedenis van oude versies en “vergelijkbare artikelen” mogen hebben
[*]Of een nieuw artikel ook een onderwerp in een forum plaatst (forum-ID [b]0[/b] zet dat uit)
[/list]

Sla op als je klaar bent.

[anchor=back_config goto=kb_top]Terug naar boven[/anchor]

[anchor=cats][b]Categorieën[/b][/anchor]

ACP → [b]Kennisbank[/b] → [b]Categorieën[/b].

Maak eerst een hoofdcategorie, daarna subcategorieën eronder. Artikelen horen in de subcategorieën; de index zelf kan ze niet bevatten.

Geef elke categorie een naam, optionele beschrijving en optionele afbeeldings-URL. Gebruik [b]Tonen in hoofdcategorie[/b] als de categorie op de KB-startpagina moet staan.

[anchor=back_cats goto=kb_top]Terug naar boven[/anchor]

[anchor=types][b]Artikeltypes[/b][/anchor]

ACP → [b]Kennisbank[/b] → [b]Artikeltypes[/b].

Types zijn labels zoals Handleiding, FAQ of Beleid. Ze zijn optioneel. Zet “Artikeltypes gebruiken” aan in Configuratie als je het veld op het artikel-formulier wilt.

[anchor=back_types goto=kb_top]Terug naar boven[/anchor]

[anchor=perms][b]Permissies[/b][/anchor]

ACP → [b]Kennisbank[/b] → categoriepermissies.

Stel in wie artikelen in elke categorie mag bekijken, toevoegen, bewerken en goedkeuren. Gebruikers zonder [b]kb_view_article[/b] zien die categorie nooit. Direct publiceren zonder moderator vraagt [b]kb_add_article_direct[/b] (of het moderatorrecht [b]m_activate_kb[/b]).

[anchor=back_perms goto=kb_top]Terug naar boven[/anchor]

[anchor=write][b]Een artikel toevoegen[/b][/anchor]

Kies in de Kennisbank een categorie en [b]Een artikel toevoegen[/b]. Vul titel, beschrijving en tekst in. BBCode mag.

Tenzij de auteur direct mag publiceren, wacht het artikel tot een moderator of beheerder het activeert. Daarna is het openbaar.

[anchor=back_write goto=kb_top]Terug naar boven[/anchor]

[anchor=lang][b]Een artikel vertalen[/b][/anchor]

Je kunt één artikel in de Kennisbank houden en toch per forumtaal een andere titel, beschrijving en tekst tonen.

[b]1. Kies een korte naam[/b]

Gebruik hoofdletters en underscores. Voorbeeld: [b]PUSH_NOTIFICATIONS[/b].

Lezers zien die naam nooit. Hij koppelt het artikel alleen aan de vertalingen.

[b]2. Zet op het artikel-formulier alleen de placeholder[/b]

Elk veld moet de placeholder zijn en niets anders. Meng hem niet met andere tekst.

[list]
[*]Titel: [b]{L_PUSH_NOTIFICATIONS}[/b]
[*]Beschrijving: [b]{L_PUSH_NOTIFICATIONS_DESC}[/b]
[*]Artikeltekst: [b]{L_PUSH_NOTIFICATIONS_ARTICLE}[/b]
[/list]

[b]3. Zet de echte tekst in de taalbestanden[/b]

Open [b]language/en/kb/articles.php[/b] en voeg drie regels toe:

[code]PUSH_NOTIFICATIONS         => Push notifications
PUSH_NOTIFICATIONS_DESC    => Turn on browser alerts.
PUSH_NOTIFICATIONS_ARTICLE => The full article text goes here.[/code]

Kopieer dezelfde drie namen naar [b]language/nl/kb/articles.php[/b], [b]language/de/kb/articles.php[/b] en elke andere taalmap die je gebruikt, met de vertaalde tekst.

Engels is verplicht. Ontbreekt een regel in een taal, dan wordt de Engelse tekst getoond.

[b]4. Hoe je het bestand opslaat[/b]

Sla op als UTF-8 zonder BOM. Notepad++ kan dat. Kladblok van Windows vaak niet, en dat kan het forum breken.

Dat is alles. Na het legen van de cache ziet elke lezer het artikel in de eigen taal.

[anchor=back_lang goto=kb_top]Terug naar boven[/anchor]',

// ===== END ARTICLE: KB_SETUP =====


// ===== START ARTICLE: K_LINKS_BANNER_UPLOAD =====
	'K_LINKS_BANNER_UPLOAD'			=> 'Site Banner Exchange',
	'K_LINKS_BANNER_UPLOAD_DESC'	=> 'Stel het Banner Exchange-forum, de rechten, uploadmappen en goedkeuringsstroom voor sitebannerinzendingen in.',
	'K_LINKS_BANNER_UPLOAD_ARTICLE'	=> '[anchor=klinks_top][/anchor][b]Site Banner Exchange[/b]

Site Banner Exchange kan een forum gebruiken voor banner exchange-inzendingen en vertrouwde gebruikers een banner laten uploaden bij het bericht. De functie is standaard geïnstalleerd. Beheerders hoeven alleen het forum te kiezen, rechten in te stellen en te controleren dat de uploadmappen beschrijfbaar zijn.

[b]Ga naar[/b]
[list]
[*][anchor=toc_forum goto=forum]Banner Exchange-forum maken[/anchor]
[*][anchor=toc_portal goto=portal]Koppelen aan het Site Banner Exchange-blok[/anchor]
[*][anchor=toc_permission goto=permission]Banneruploadrecht[/anchor]
[*][anchor=toc_folders goto=folders]Uploadmappen[/anchor]
[*][anchor=toc_banner goto=banner]Bannerafbeelding maken[/anchor]
[*][anchor=toc_submit goto=submit]Een Banner Exchange-inzending plaatsen[/anchor]
[*][anchor=toc_approve goto=approve]Goedkeuring is vereist[/anchor]
[*][anchor=toc_fix goto=fix]Als iets niet werkt[/anchor]
[/list]

[anchor=forum][b]Banner Exchange-forum maken[/b][/anchor]

Maak een normaal forum voor Banner Exchange-inzendingen. Noteer na het opslaan de forum-ID. Die ID is later nodig bij het instellen van het Site Banner Exchange-blok.

Stel de normale phpBB-forumrechten in voor de groepen of gebruikers die toegang moeten hebben. Geef alleen de forumrechten die ze nodig hebben, zoals bekijken, lezen en plaatsen. Dit regelt de toegang tot het forum zelf.

Het banneruploadrecht staat los daarvan. Een gebruiker kan toegang tot het forum hebben, maar toch geen banner kunnen uploaden zonder ook [b]Kan portal-linkbanners uploaden[/b].

[anchor=back_forum goto=klinks_top]Terug naar boven[/anchor]

[anchor=portal][b]Koppelen aan het Site Banner Exchange-blok[/b][/anchor]

Ga naar de portalblokinstellingen voor de variabelen van het Site Banner Exchange-blok ([b]k_links_vars[/b]). Zet [b]Link forum ID[/b] op de forum-ID die je eerder hebt genoteerd.

Het tabblad voor bannerupload geldt alleen in dat ingestelde forum. Als de forum-ID fout is, kunnen gebruikers misschien wel in een forum plaatsen, maar zien ze daar niet de verwachte bannerstroom.

[anchor=back_portal goto=klinks_top]Terug naar boven[/anchor]

[anchor=permission][b]Banneruploadrecht[/b][/anchor]

Het recht is [b]u_k_links_upload[/b]. In het ACP staat het bij gebruikers- of groepsrechten, onder Geavanceerde rechten → Berichten, als [b]Kan portal-linkbanners uploaden[/b].

Standaard hebben beheerders en globale moderators dit recht. Het is ook opgenomen in de gebruikersrol [b]All Features[/b]. Wijs het voor andere groepen of gebruikers alleen handmatig toe als zij vertrouwd genoeg zijn om banners in te zenden.

Dit is een globaal gebruikers-/groepsrecht. Het vervangt geen forumrechten. De gebruiker heeft nog steeds toegang nodig tot het ingestelde Banner Exchange-forum.

[anchor=back_permission goto=klinks_top]Terug naar boven[/anchor]

[anchor=folders][b]Uploadmappen[/b][/anchor]

Het forum gebruikt twee mappen:

[list]
[*][b]images/links/tmp/[/b] — wachtende banneruploads staan hier.
[*][b]images/links/[/b] — goedgekeurde banners worden hierheen verplaatst.
[/list]

Beide mappen moeten beschrijfbaar zijn voor de webserver. Als [b]images/links/tmp/[/b] niet bestaat, kan de uploadcode proberen die te maken, maar het is veiliger om de map tijdens de setup zelf te maken en de rechten te controleren.

[anchor=back_folders goto=klinks_top]Terug naar boven[/anchor]

[anchor=banner][b]Bannerafbeelding maken[/b][/anchor]

Maak een bannerafbeelding van maximaal [b]200px breed en 50px hoog[/b]. Toegestane bestandstypen zijn [b]JPG[/b], [b]JPEG[/b], [b]GIF[/b] en [b]PNG[/b].

Geef de afbeelding een naam op basis van het uiteindelijke webadres dat hij moet openen. Omdat een bestandsnaam geen [b]/[/b] kan bevatten, vervang je elke schuine streep in het URL-pad door [b]+[/b]. Gebruik geen [b]https://[/b] of [b]http://[/b] in de bestandsnaam.

Voorbeeld: voor [b]https://integramod.com/forum/[/b] noem je de afbeelding [b]integramod.com+forum.jpg[/b]. Je kunt dezelfde naam gebruiken met een andere toegestane extensie, zoals [b]integramod.com+forum.jpeg[/b], [b]integramod.com+forum.gif[/b] of [b]integramod.com+forum.png[/b].

Wanneer het Site Banner Exchange-blok de goedgekeurde banner toont, bouwt het de URL opnieuw op uit de bestandsnaam door [b]+[/b] te vervangen door [b]/[/b].

[anchor=back_banner goto=klinks_top]Terug naar boven[/anchor]

[anchor=submit][b]Een Banner Exchange-inzending plaatsen[/b][/anchor]

Een gebruiker met rechten opent het forum dat als Banner Exchange-forum is ingesteld en start een bericht. Het plaatsingsformulier toont een uploadtabblad [b]Site Banner Exchange[/b].

Upload de voorbereide JPG-, JPEG-, GIF- of PNG-banner. Het bestand wordt niet direct gepubliceerd. Het wordt klaargezet in [b]images/links/tmp/[/b] terwijl het bericht op goedkeuring wacht.

[anchor=back_submit goto=klinks_top]Terug naar boven[/anchor]

[anchor=approve][b]Goedkeuring is vereist[/b][/anchor]

Alle Banner Exchange-inzendingen moeten door een beheerder of moderator worden goedgekeurd voordat de inzending compleet is. Het bericht moet via de normale moderatiewachtrij worden goedgekeurd.

Wanneer een beheerder of moderator het bericht goedkeurt, wordt de klaargezette banner verplaatst van [b]images/links/tmp/[/b] naar [b]images/links/[/b]. Het wachtrijrecord wordt gemarkeerd als goedgekeurd met de goedkeurder en goedkeuringstijd.

Tot die goedkeuring is gebeurd, is de banner alleen in behandeling. Behandel hem nog niet als een live Site Banner Exchange-banner.

[anchor=back_approve goto=klinks_top]Terug naar boven[/anchor]

[anchor=fix][b]Als iets niet werkt[/b][/anchor]

[list]
[*][b]Het tabblad ontbreekt[/b] — controleer of het Site Banner Exchange-blok de juiste Link forum ID heeft, of de gebruiker toegang heeft tot dat forum en of de gebruiker [b]Kan portal-linkbanners uploaden[/b] heeft.
[*][b]Upload mislukt[/b] — controleer of het bestand JPG, JPEG, GIF of PNG is, maximaal 200px × 50px is, naar de doel-URL is genoemd en of [b]images/links/[/b] en [b]images/links/tmp/[/b] beschrijfbaar zijn.
[*][b]De banner wordt niet verplaatst[/b] — controleer of het bericht via de moderatiewachtrij is goedgekeurd en of het tijdelijke bestand nog bestaat.
[*][b]Rechtenwijzigingen verschijnen niet[/b] — leeg de phpBB-cache en herlaad de ACP-rechtenpagina.
[/list]

[anchor=back_fix goto=klinks_top]Terug naar boven[/anchor]',

// ===== END ARTICLE: K_LINKS_BANNER_UPLOAD =====


// ===== START ARTICLE: STYLE_INSTALL =====
	'STYLE_INSTALL'			=> 'Een stijl installeren',
	'STYLE_INSTALL_DESC'	=> 'Upload een stijlmap en installeer die via het Beheerderspaneel.',
	'STYLE_INSTALL_ARTICLE'	=> '[anchor=style_top][/anchor][b]Een stijl installeren[/b]

Een stijl is het complete uiterlijk van het forum: template, thema (CSS/afbeeldingen) en afbeeldingenset. core en Alpha zijn volledige stijlen. Sommige andere erven van _portal_common en overschrijven alleen wat ze nodig hebben.

[b]Spring naar[/b]
[list]
[*][anchor=toc_parent goto=parent]Stijlen die eerst prosilver nodig hebben[/anchor]
[*][anchor=toc_upload goto=upload]Bestanden op de server zetten[/anchor]
[*][anchor=toc_acp goto=acp]Installeren in het ACP[/anchor]
[*][anchor=toc_default goto=default]Als forumstandaard instellen[/anchor]
[*][anchor=toc_users goto=users]Gebruikers nog op de oude stijl[/anchor]
[*][anchor=toc_notes goto=notes]Overerving en cache[/anchor]
[/list]

[anchor=parent][b]Stijlen die eerst prosilver nodig hebben[/b][/anchor]

[b]fiproice[/b], [b]IM_prosilver[/b] en [b]MiMic[/b] erven ontbrekende bestanden van [b]prosilver[/b]. Installeer en behoud prosilver [i]voordat[/i] je die drie installeert. Zonder prosilver breken pagina’s of zien ze er half gestyled uit.

core en Alpha hebben prosilver niet nodig. Dat zijn volledige stijlen.

[anchor=back_parent goto=style_top]Terug naar boven[/anchor]

[anchor=upload][b]Bestanden op de server zetten[/b][/anchor]

[list=1]
[*]Download het stijlpakket en pak het uit op je computer.
[*]Je moet een map hebben met [b]style.cfg[/b] erin (en meestal [b]template/[/b], [b]theme/[/b], [b]imageset/[/b]).
[*]Upload die map naar [b]styles/[/b] op het forum. Het pad moet [b]styles/StyleName/style.cfg[/b] zijn, niet nog een niveau dieper.
[*]Houd de mapnaam exact zoals geleverd. Hernoem core of Alpha niet, tenzij je ook [b]style.cfg[/b] aanpast.
[/list]

FTP of de bestandsbeheerder van de host werken allebei. De webserver moet de bestanden kunnen lezen.

[anchor=back_upload goto=style_top]Terug naar boven[/anchor]

[anchor=acp][b]Installeren in het ACP[/b][/anchor]

[list=1]
[*]Log in als beheerder.
[*]Ga naar [b]ACP → Stijlen → Stijlen[/b].
[*]Als je fiproice, IM_prosilver of MiMic installeert, controleer eerst of [b]prosilver[/b] al in de geïnstalleerde lijst staat. Installeer die eerst als dat niet zo is.
[*]Onder niet-geïnstalleerde stijlen zoek je de nieuwe naam en klik je op [b]Stijl installeren[/b].
[*]Bevestig. Als de stijl een bovenliggende template, thema of afbeeldingenset nodig heeft die nog niet is geïnstalleerd, zegt het ACP dat. Installeer die eerst.
[/list]

Geïnstalleerde stijlen staan in de lijst met een gebruikersaantal. De huidige standaard heeft een asterisk (*).

[anchor=back_acp goto=style_top]Terug naar boven[/anchor]

[anchor=default][b]Als forumstandaard instellen[/b][/anchor]

Op dezelfde pagina zet je de stijl als forumstandaard als iedereen die moet krijgen. Je kunt hem geïnstalleerd laten zonder standaard, als gebruikers hem zelf mogen kiezen.

Deactiveer een stijl in plaats van te verwijderen als je hem alleen uit de gebruikerslijst wilt. Verwijder prosilver niet zolang fiproice, IM_prosilver of MiMic nog in gebruik zijn.

[anchor=back_default goto=style_top]Terug naar boven[/anchor]

[anchor=users][b]Gebruikers nog op de oude stijl[/b][/anchor]

De opgeslagen stijl van een gebruiker verandert niet altijd als je de forumstandaard wisselt. Staat “gebruikersstijl overschrijven” uit, dan houden ze hun oude keuze tot ze de nieuwe in het Gebruikerspaneel kiezen.

Om de nieuwe look af te dwingen: ACP → [b]Foruminstellingen[/b] (of Gebruikersinstellingen) en zet gebruikersstijl overschrijven aan, of bewerk gebruikers onder [b]Gebruikers en groepen[/b].

[anchor=back_users goto=style_top]Terug naar boven[/anchor]

[anchor=notes][b]Overerving en cache[/b][/anchor]

[list]
[*]Stijlen die van prosilver erven, hebben alleen de bestanden nodig die ze overschrijven. Ontbrekende templates vallen terug op de ouder.
[*]Na installeren of bewerken van templates de forumcache legen: ACP → [b]Algemeen[/b] → [b]Cache legen[/b]. Verwijder ook bestanden in [b]cache/[/b] als een wijziging niet verschijnt.
[*]Meng geen bestanden van twee stijlen in één map. Upload een compleet stijlpakket.
[*]Alpha is dezelfde moderne core-code in een retro-forumuiterlijk, geen oudere voorganger.
[/list]

[anchor=back_notes goto=style_top]Terug naar boven[/anchor]',

// ===== END ARTICLE: STYLE_INSTALL =====


// ===== START ARTICLE: IM_INSTALL =====
	'IM_INSTALL'			=> 'IntegraMOD 3 installeren',
	'IM_INSTALL_DESC'		=> 'Upload het pakket, kies een cache, draai de installer en sluit het forum daarna af.',
	'IM_INSTALL_ARTICLE'	=> '[anchor=im_top][/anchor][b]IntegraMOD 3 installeren[/b]

IntegraMOD 3 is een volledig forumpakket. Je uploadt de bestanden, draait de installer één keer en verwijdert daarna mappen die niet op een live site horen. Je hebt een webhost met PHP en een database nodig. Ken je de databasegegevens niet, vraag ze dan eerst aan de host.

[b]Spring naar[/b]
[list]
[*][anchor=toc_need goto=need]Wat je nodig hebt[/anchor]
[*][anchor=toc_files goto=files]Bestanden op de server zetten[/anchor]
[*][anchor=toc_perm goto=perm]Maprechten[/anchor]
[*][anchor=toc_cache goto=cache]Cachekeuzes[/anchor]
[*][anchor=toc_run goto=run]De installer draaien[/anchor]
[*][anchor=toc_after goto=after]Daarna — deze mappen wissen[/anchor]
[*][anchor=toc_config goto=config]config.php afsluiten[/anchor]
[*][anchor=toc_stuck goto=stuck]Als iets misgaat[/anchor]
[/list]

[anchor=need][b]Wat je nodig hebt[/b][/anchor]

[list]
[*]PHP 7.4 of nieuwer (tot PHP 8.5)
[*]Een database: MySQL / MariaDB is gebruikelijk. PostgreSQL, SQLite, Firebird, MS SQL en Oracle kunnen ook, als de host ze aanbiedt
[*]FTP of een bestandsbeheerder om te uploaden
[*]Databasenaam, gebruiker, wachtwoord en serverhostnaam van de host
[/list]

[anchor=back_need goto=im_top]Terug naar boven[/anchor]

[anchor=files][b]Bestanden op de server zetten[/b][/anchor]

[list=1]
[*]Pak het IntegraMOD-pakket uit op je computer.
[*]Upload [b]alles[/b] naar een webmap, met dezelfde mappen en namen. Forceer namen niet naar kleine letters.
[*]Een typisch pad is [b]https://example.com/forum/[/b] of de siteroot.
[/list]

Met SSH kun je de zip uploaden en op de server uitpakken in plaats van duizenden bestanden via FTP.

[anchor=back_files goto=im_top]Terug naar boven[/anchor]

[anchor=perm][b]Maprechten[/b][/anchor]

De installer moet een paar paden kunnen schrijven:

[list]
[*][b]config.php[/b] — alleen tijdens installatie schrijfbaar (vaak 666). Daarna wijzigen; zie [anchor=toc_config_jump goto=config]config.php afsluiten[/anchor]
[*][b]store/[/b], [b]cache/[/b], [b]files/[/b], [b]images/avatars/upload/[/b] — schrijfbaar (vaak 777 op shared hosting)
[/list]

Je FTP-programma of de bestandsbeheerder van de host kan dat zetten.

[anchor=back_perm goto=im_top]Terug naar boven[/anchor]

[anchor=cache][b]Cachekeuzes[/b][/anchor]

De installer vraagt waar het forum cachegegevens moet bewaren. Kies wat de host écht heeft.

[list]
[*][b]File (standaard)[/b] — schrijft cachebestanden onder [b]store/[/b]. Eenvoudig en betrouwbaar. Gebruik dit op de meeste shared hosting.
[*][b]Memcache[/b] of [b]Memcached[/b] — snelle geheugencache. Vereist de PHP-extensie en een memcached-server.
[*][b]Redis[/b] — snel geheugen met extra functies. Vereist de Redis-extensie en een Redis-server.
[*][b]APC / APCu[/b] — geheugencache in PHP op één server.
[*][b]WinCache[/b] — alleen Windows-hosts.
[*][b]XCache[/b] / [b]eAccelerator[/b] — oudere opcode-caches; alleen als de host ze nog heeft.
[*][b]Memory (alleen proces)[/b] — snel, maar elk PHP-proces heeft eigen cache. Niet gedeeld.
[*][b]Geen cache[/b] — alleen om te debuggen. Niet op een live forum.
[/list]

Weet je het niet, laat [b]File[/b] staan. Later kun je het in het ACP wijzigen als de host Memcached of Redis toevoegt.

[anchor=back_cache goto=im_top]Terug naar boven[/anchor]

[anchor=run][b]De installer draaien[/b][/anchor]

Open [b]https://jouw-site/forum/install/[/b] (voeg [b]install/[/b] toe aan waar je de bestanden hebt gezet).

[list=1]
[*]Lees de intro en open het tabblad [b]INSTALL[/b].
[*]De vereistenpagina controleert PHP en de mappen. Herstel alles wat verplicht is voordat je doorgaat.
[*]Vul databasetype, hostnaam, naam, gebruiker en wachtwoord in. Poort leeg laten tenzij de host er een gaf. Houd het tabelvoorvoegsel, tenzij je al een ander forum in dezelfde database hebt.
[*]Kies het cachetype (zie hierboven).
[*]Maak het eerste beheerdersaccount (jouw login).
[*]Laat [b]config.php[/b] schrijven. Lukt dat niet, dan toont hij de inhoud om handmatig te plakken.
[/list]

Als er gefeliciteerd staat, is het forum geïnstalleerd.

[anchor=back_run goto=im_top]Terug naar boven[/anchor]

[anchor=after][b]Daarna — deze mappen wissen[/b][/anchor]

Deze paden horen niet op een openbare site. Verwijder ze uit de webroot (of haal ze van de server). Laten staan is een beveiligingslek.

[list]
[*][b]install/[/b] — [b]moet[/b] weg. Zolang die map bestaat, werkt alleen het Beheerderspaneel, en wie hem opent kan het forum slopen.
[*][b]develop/[/b] — [b]deze vooral wissen.[/b] Ontwikkeltools en testcode. Nooit op een live forum laten.
[*][b]stk/[/b] — Support Toolkit. Handig bij een kapot forum; gevaarlijk als vreemden hem kunnen openen. Weghalen als je klaar bent.
[*][b]docs/[/b] — installatienotities. Mag weg nadat je ze hebt gelezen.
[/list]

Optioneel: converteer een oud phpBB 2-forum via de convertorlink op de succespagina [i]voordat[/i] je [b]install/[/b] wist.

Log daarna in met het beheerdersaccount dat je hebt aangemaakt.

[anchor=back_after goto=im_top]Terug naar boven[/anchor]

[anchor=config][b]config.php afsluiten[/b][/anchor]

[b]config.php[/b] bevat het databasewachtwoord. Tijdens installatie staat hij vaak op [b]666[/b] (voor iedereen schrijfbaar) zodat de installer kan schrijven. Dat mag niet zo blijven.

Na installatie:

[list]
[*]Zet [b]config.php[/b] op [b]644[/b] (of [b]640[/b] als de host dat toestaat). De webserver moet hem nog [i]kunnen lezen[/i].
[*]Laat hem [b]niet[/b] op [b]666[/b]. Wie dat bestand kan schrijven, bezit de database.
[/list]

[anchor=back_config goto=im_top]Terug naar boven[/anchor]

[anchor=stuck][b]Als iets misgaat[/b][/anchor]

[list]
[*][b]Could not connect to the database[/b] — hostnaam, naam, gebruiker of wachtwoord klopt niet. Vraag de host.
[*]Een map is niet schrijfbaar — rechten opnieuw zetten en op de vereistenpagina opnieuw testen.
[*]Lege pagina na installatie — [b]install/[/b] staat er nog, of [b]cache/[/b] is niet schrijfbaar.
[*]PHP te oud — de host moet op PHP 7.4 of nieuwer.
[/list]

Meer details staan in [b]docs/INSTALL.html[/b] in het pakket (lees dat vóór je [b]docs/[/b] wist).

[anchor=back_stuck goto=im_top]Terug naar boven[/anchor]',
));

// ===== END ARTICLE: IM_INSTALL =====
