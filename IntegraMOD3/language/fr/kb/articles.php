<?php
/**
*
* Knowledge Base article catalog [English]
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
    'RANDOM_TITLE'       => 'Exemple de titre localisé',
    'RANDOM_DESCRIPTION' => 'Exemple de description localisée',
    'RANDOM_ARTICLE'     => 'Ceci est un exemple de corps d\'article de base de connaissances localisé. Vous pouvez utiliser du BBCode ici.',

// ===== END ARTICLE: RANDOM =====


// ===== START ARTICLE: SAVE_FORUM_APP =====
    'SAVE_FORUM_APP'			=> 'Enregistrer le forum comme une application',
    'SAVE_FORUM_APP_DESC'		=> 'Ajoutez le forum au bureau, à l’écran d’accueil ou au Dock pour l’ouvrir comme une application.',
    'SAVE_FORUM_APP_ARTICLE'	=> '[anchor=app_top][/anchor][b]IntegraMOD comme application[/b]

Mettre le forum sur le bureau ou l’écran d’accueil, ce n’est qu’un raccourci, mais un raccourci pratique. Il s’ouvre dans sa propre fenêtre au lieu de se perdre dans une pile d’onglets. Sur téléphone, il se range avec les autres applis et démarre en plein écran. Un clic dans la barre des tâches, le Dock ou l’écran d’accueil, et vous y êtes.

Il faut toujours internet, et vous restez connecté comme dans le navigateur utilisé pour l’ajouter. Rien n’est téléchargé depuis une boutique.

Choisissez le navigateur que vous utilisez vraiment, puis sautez aux étapes.

[b]Navigateurs de bureau[/b]
[list]
[*][anchor=toc_chrome goto=chrome]Google Chrome[/anchor]
[*][anchor=toc_edge goto=edge]Microsoft Edge[/anchor]
[*][anchor=toc_safari_mac goto=safari_mac]Safari (Mac)[/anchor]
[*][anchor=toc_firefox_desk goto=firefox_desk]Firefox[/anchor]
[/list]

[b]Navigateurs mobiles[/b]
[list]
[*][anchor=toc_safari_ios goto=safari_ios]Safari (iPhone / iPad)[/anchor]
[*][anchor=toc_chrome_and goto=chrome_and]Chrome (Android)[/anchor]
[*][anchor=toc_firefox_and goto=firefox_and]Firefox (Android)[/anchor]
[/list]

[b]Ensuite[/b]
[list]
[*][anchor=toc_push_top goto=push]Activer les notifications push[/anchor]
[/list]

[anchor=chrome][b]Google Chrome (bureau)[/b][/anchor]

Fonctionne sous Windows, macOS et Linux.

[list=1]
[*]Ouvrez le forum dans Chrome.
[*]Dans la barre d’adresse, il y a souvent une petite icône d’installation. En général un ordinateur avec une flèche vers le bas, ou un plus sur un écran.
[*]Pas d’icône ? Ouvrez le menu à trois points et choisissez [b]Installer l’application[/b] ou [b]Installer ce site en tant qu’application[/b].
[*]Gardez ou changez le nom, puis cliquez sur [b]Installer[/b].
[/list]

Chrome le met dans le menu Démarrer ou le dossier Applications. Épinglez-le à la barre des tâches ou au Dock si vous le voulez en un clic. Il s’ouvre dans une fenêtre simple, sans la bande d’onglets.

Pour le retirer plus tard, ouvrez l’appli, son menu, puis Désinstaller.

[anchor=back_chrome goto=app_top]Haut de page[/anchor]

[anchor=edge][b]Microsoft Edge (bureau)[/b][/anchor]

Même principe que Chrome, et le libellé est presque identique.

[list=1]
[*]Ouvrez le forum dans Edge.
[*]Cliquez sur l’icône d’installation dans la barre d’adresse si elle est là.
[*]Sinon ouvrez le menu à trois points et choisissez [b]Applications → Installer ce site en tant qu’application[/b].
[*]Confirmez le nom et cliquez sur [b]Installer[/b].
[/list]

Vous pouvez ensuite l’épingler à la barre des tâches ou à Démarrer. Désinstallez depuis le menu de l’appli, ou supprimez le raccourci.

[anchor=back_edge goto=app_top]Haut de page[/anchor]

[anchor=safari_mac][b]Safari (Mac)[/b][/anchor]

[list=1]
[*]Ouvrez le forum dans Safari.
[*]Choisissez [b]Fichier → Ajouter au Dock[/b]. Certaines versions le rangent sous Partager.
[*]Confirmez le nom et ajoutez-le.
[/list]

Safari pose une icône dans le Dock. Un clic ouvre le forum dans sa propre fenêtre.

[anchor=back_safari_mac goto=app_top]Haut de page[/anchor]

[anchor=firefox_desk][b]Firefox (bureau)[/b][/anchor]

Firefox n’installe pas les applications web comme Chrome ou Edge. Vous pouvez quand même le garder sous la main :

[list]
[*]ajoutez un signet, ou
[*]glissez l’icône cadenas / site de la barre d’adresse vers le bureau.
[/list]

Ce raccourci ouvre encore une fenêtre Firefox normale, mais ça évite de fouiller les signets.

[anchor=back_firefox_desk goto=app_top]Haut de page[/anchor]

[anchor=safari_ios][b]Safari (iPhone / iPad)[/b][/anchor]

Utilisez Safari. Chrome sur iPhone ne peut pas ajouter une vraie appli à l’écran d’accueil de la même façon.

[list=1]
[*]Ouvrez le forum dans Safari.
[*]Appuyez sur [b]Partager[/b] (le carré avec la flèche vers le haut).
[*]Faites défiler la feuille de partage et appuyez sur [b]Sur l’écran d’accueil[/b].
[*]Changez le nom si vous voulez, puis appuyez sur [b]Ajouter[/b].
[/list]

L’icône arrive sur l’écran d’accueil et ouvre le forum en plein écran.

Si Sur l’écran d’accueil n’apparaît pas, appuyez sur Modifier les actions ou Plus dans la feuille de partage et activez-le.

[anchor=back_safari_ios goto=app_top]Haut de page[/anchor]

[anchor=chrome_and][b]Chrome (Android)[/b][/anchor]

[list=1]
[*]Ouvrez le forum dans Chrome.
[*]Appuyez sur le menu à trois points.
[*]Appuyez sur [b]Installer l’application[/b] ou [b]Ajouter à l’écran d’accueil[/b].
[*]Confirmez [b]Installer[/b] ou [b]Ajouter[/b].
[/list]

Android affiche parfois une bannière Installer en bas de page. Elle marche aussi.

L’icône apparaît sur l’écran d’accueil ou dans le tiroir d’applis et s’ouvre dans sa propre fenêtre.

[anchor=back_chrome_and goto=app_top]Haut de page[/anchor]

[anchor=firefox_and][b]Firefox (Android)[/b][/anchor]

[list=1]
[*]Ouvrez le forum dans Firefox.
[*]Ouvrez le menu du navigateur.
[*]Appuyez sur [b]Installer[/b] ou [b]Ajouter à l’écran d’accueil[/b] si le téléphone le propose.
[/list]

Si l’option n’est pas là, ajoutez un signet. Moins propre qu’une icône d’appli, mais ça reste à un appui.

[anchor=back_firefox_and goto=app_top]Haut de page[/anchor]

[b]Une fois installé[/b]
[list]
[*][anchor=toc_push goto=push]Activer les notifications push[/anchor]
[/list]

[anchor=push][b]Activer les notifications push[/b][/anchor]

L’icône n’active pas les notifications. Ce n’est qu’une fenêtre du même navigateur que vous avez utilisé pour l’ajouter. Le push appartient à ce navigateur, et il ne démarre qu’après l’avoir autorisé une fois connecté.

Ouvrez le forum depuis la nouvelle icône, pas depuis un vieil onglet. Connectez-vous là. Puis, dans votre profil : [b]Panneau de contrôle de l’utilisateur[/b] → [b]Préférences du forum[/b] → [b]Notifications Push[/b].

Cette page abonne [i]ce[/i] navigateur ou cette fenêtre d’appli. Cliquez sur [b]Activer les notifications du navigateur[/b]. Le navigateur demande l’autorisation ; choisissez [b]Autoriser[/b]. Si ça a marché, la page affiche [b]Ce navigateur est abonné.[/b]

Cette autorisation permet seulement d’envoyer. En dessous, cochez [b]Web Push[/b] pour les événements voulus (messages privés, j’aime, sujets suivis, etc.), puis cliquez sur [b]Envoyer[/b].

Refaites-le sur chaque téléphone, tablette ou ordinateur où vous avez installé le forum. L’activer sur un appareil ne l’active pas sur les autres. Si [b]Activer les notifications du navigateur[/b] ne fait rien, le navigateur ou une extension bloque les notifications pour ce site. Autorisez-les pour le forum et recliquez sur le bouton.

[b]Encore deux ou trois précisions[/b]
[list]
[*]Ouvrez la nouvelle icône une fois et connectez-vous. Cette connexion reste liée au navigateur utilisé pour l’ajouter.
[*]Si l’icône ouvre une page blanche, supprimez-la et ajoutez-la de nouveau depuis l’adresse HTTPS actuelle, pas depuis un vieux signet.
[*]Mettre à jour le forum n’oblige pas à recréer l’icône.
[/list]

[anchor=back_push goto=app_top]Haut de page[/anchor]',

// ===== END ARTICLE: SAVE_FORUM_APP =====


// ===== START ARTICLE: PUSH_NOTIFICATIONS =====
	'PUSH_NOTIFICATIONS'			=> 'Notifications push',
	'PUSH_NOTIFICATIONS_DESC'		=> 'Activez les alertes du navigateur pour les messages privés, les « j’aime » et d’autres événements du forum.',
	'PUSH_NOTIFICATIONS_ARTICLE'	=> '[anchor=push_top][/anchor][b]Notifications push[/b]

Le push est une alerte courte du forum quand quelque chose se passe pendant que vous ne regardez pas. Un message privé, un « j’aime », une réponse dans un sujet suivi. Cela apparaît dans le navigateur ou sur le téléphone, comme sur d’autres sites.

Le forum peut envoyer. Le navigateur doit l’autoriser. Vous le faites une fois par appareil, en étant connecté.

[b]Aller à[/b]
[list]
[*][anchor=toc_before goto=before]Avant de commencer[/anchor]
[*][anchor=toc_enable goto=enable]L’activer[/anchor]
[*][anchor=toc_events goto=events]Choisir les événements[/anchor]
[*][anchor=toc_devices goto=devices]Plus d’un appareil[/anchor]
[*][anchor=toc_sms goto=sms]SMS (facultatif)[/anchor]
[*][anchor=toc_admin goto=admin]Configuration administrateur[/anchor]
[*][anchor=toc_fix goto=fix]Si ça ne marche pas[/anchor]
[/list]

[anchor=before][b]Avant de commencer[/b][/anchor]

[list]
[*]Utilisez HTTPS. Le push ne fonctionne pas sur une adresse http simple.
[*]Connectez-vous. Les invités ne peuvent pas s’abonner.
[*]Ouvrez le forum dans le navigateur (ou la fenêtre d’application) où vous voulez les alertes. L’autorisation appartient à ce navigateur, pas à tout le compte.
[/list]

Si vous avez ajouté le forum comme application, ouvrez-le depuis cette icône, pas depuis un vieil onglet. Puis suivez les étapes dans cette fenêtre.

[anchor=back_before goto=push_top]Haut de page[/anchor]

[anchor=enable][b]L’activer[/b][/anchor]

[list=1]
[*]Ouvrez [b]Panneau de contrôle de l’utilisateur[/b] → [b]Préférences du forum[/b] → [b]Notifications Push[/b].
[*]Cliquez sur [b]Activer les notifications du navigateur[/b] (parfois [b]Activer les notifications de bureau[/b]).
[*]Quand le navigateur demande, choisissez [b]Autoriser[/b].
[*]La page doit alors indiquer [b]Ce navigateur est abonné.[/b]
[/list]

Cette autorisation ne fait qu’autoriser l’envoi. Les événements se choisissent ensuite.

[anchor=back_enable goto=push_top]Haut de page[/anchor]

[anchor=events][b]Choisir les événements[/b][/anchor]

Sous l’état de l’abonnement, cochez [b]Web Push[/b] pour les événements voulus, puis cliquez sur [b]Envoyer[/b].

Événements typiques (seuls ceux activés par l’administrateur apparaissent) :
[list]
[*]Messages privés
[*]« J’aime »
[*]Demandes d’ami et acceptations
[*]Réponses aux messages suivis
[*]Mises à jour des sujets suivis
[*]Actualités et annonces
[*]Mentions, quand quelqu’un écrit @votrenom dans un forum autorisé
[*]Nouvelles inscriptions et nouveaux messages, pour l’équipe ou les groupes choisis par l’administrateur
[/list]

Laissez une case vide si vous ne voulez pas cette alerte.

[anchor=back_events goto=push_top]Haut de page[/anchor]

[anchor=devices][b]Plus d’un appareil[/b][/anchor]

L’activer sur un téléphone, une tablette ou un ordinateur ne l’active pas sur les autres. Répétez les étapes dans chaque navigateur ou fenêtre d’application installée.

[anchor=back_devices goto=push_top]Haut de page[/anchor]

[anchor=sms][b]SMS (facultatif)[/b][/anchor]

Si l’administrateur a activé les SMS, la même page peut prendre un indicatif pays et un numéro mobile. Ce numéro est stocké chiffré. Cochez [b]SMS Push[/b] seulement pour les événements voulus en texto.

[anchor=back_sms goto=push_top]Haut de page[/anchor]

[anchor=admin][b]Configuration administrateur[/b][/anchor]

Ouvrez [b]ACP → Général → Notifications Push → Paramètres[/b]. Les notifications du navigateur utilisent OneSignal. Les SMS peuvent utiliser OneSignal ou Twilio.

[b]OneSignal[/b]
[list]
[*]Créez une application chez OneSignal et copiez son [b]App ID[/b] et sa [b]REST API key[/b] dans les champs correspondants.
[*]Le site doit utiliser HTTPS. Le domaine doit aussi être autorisé dans l’application OneSignal.
[*]Sans App ID, personne ne peut s’abonner aux notifications du navigateur.
[/list]

[b]Twilio[/b]
[list]
[*]Réglez [b]SMS gateway[/b] sur [b]Twilio[/b]. Laissez OneSignal si les SMS doivent passer par OneSignal.
[*][b]Twilio SID[/b] est l’Account SID de la console Twilio.
[*][b]Twilio Token[/b] est l’Auth Token de ce compte.
[*][b]Twilio From Number[/b] est le numéro Twilio expéditeur, avec l’indicatif pays, par exemple +15551234567.
[*]Les champs Twilio sont ignorés tant que la passerelle reste sur OneSignal.
[/list]

[b]Options d’événements[/b]

Le tableau active ou désactive chaque événement pour [b]Web Push[/b] et [b]SMS Push[/b]. Un utilisateur ne peut choisir un événement qu’après son activation ici.

[list]
[*][b]Nouvelle inscription[/b] va seulement aux fondateurs et administrateurs. Cochez [b]Include moderators[/b] si les modérateurs doivent aussi la recevoir.
[*][b]Nouveau message[/b] va au même public. Utilisez [b]New-post groups[/b] pour ajouter d’autres groupes. Maintenez Ctrl pour en choisir plusieurs.
[*][b]Mention[/b] prévient un utilisateur lorsqu’une mention valide @nom est publiée. L’utilisateur doit aussi l’activer dans son panneau.
[/list]

[b]Mentions[/b]

Les mentions ont deux réglages, et les deux doivent être actifs :
[list]
[*][b]ACP → Publication → Messages → Paramètres des messages → Autoriser les mentions[/b] concerne tout le forum. La première activation active les mentions des forums existants.
[*][b]ACP → Forums → Créer ou modifier un forum → Autoriser les mentions[/b] concerne un forum. Les nouveaux forums commencent activés. Décochez-le pour un forum sans mentions.
[/list]

L’utilisateur écrit @nom dans l’éditeur ou la réponse rapide et choisit un nom dans la liste. Le message l’enregistre comme balise de mention. Si l’un des réglages est désactivé, la liste n’apparaît pas et aucune notification n’est envoyée.

[anchor=back_admin goto=push_top]Haut de page[/anchor]

[anchor=fix][b]Si ça ne marche pas[/b][/anchor]

[list]
[*]Le bouton ne fait rien, ou la page ne dit jamais que le navigateur est abonné : les notifications de ce site sont bloquées. Autorisez-les dans les réglages du navigateur, puis recliquez.
[*]Une extension comme uBlock, AdGuard, Brave Shields, DuckDuckGo ou la protection stricte contre le pistage de Firefox peut bloquer le service. Autorisez-le pour ce forum.
[*]Vous n’êtes pas connecté, ou vous avez ouvert un vieux signet HTTP.
[*]Vous l’avez autorisé dans un navigateur et vous attendez dans un autre. Abonnez chaque navigateur.
[/list]

Les administrateurs configurent le service sous [b]ACP → Général → Notifications Push → Paramètres[/b]. Sans OneSignal App ID, personne ne peut s’abonner. Les SMS exigent aussi que la passerelle choisie, OneSignal ou Twilio, soit renseignée. Une mention ne prévient que si les mentions du site, du forum et la préférence de l’utilisateur sont toutes activées.

[anchor=back_fix goto=push_top]Haut de page[/anchor]',

// ===== END ARTICLE: PUSH_NOTIFICATIONS =====


// ===== START ARTICLE: KB_SETUP =====
	'KB_SETUP'			=> 'Configurer la Base de connaissances',
	'KB_SETUP_DESC'		=> 'Créez les catégories, types et permissions, puis publiez des articles.',
	'KB_SETUP_ARTICLE'	=> '[anchor=kb_top][/anchor][b]Configurer la Base de connaissances[/b]

La Base de connaissances est une bibliothèque d’articles à part, pas un forum. L’équipe rédige ; les lecteurs parcourent les catégories. Toute la configuration est dans le panneau d’administration.

[b]Aller à[/b]
[list]
[*][anchor=toc_config goto=config]Configuration[/anchor]
[*][anchor=toc_cats goto=cats]Catégories[/anchor]
[*][anchor=toc_types goto=types]Types d’article[/anchor]
[*][anchor=toc_perms goto=perms]Permissions[/anchor]
[*][anchor=toc_write goto=write]Ajouter un article[/anchor]
[*][anchor=toc_lang goto=lang]Traduire un article[/anchor]
[/list]

[anchor=config][b]Configuration[/b][/anchor]

ACP → [b]Base de connaissances[/b] → [b]Configuration[/b].

Définissez le nom et la description visibles sur l’index. Ensuite :
[list]
[*]Combien d’articles afficher sur cet index
[*]Présentation de l’index : Moderne ou Classique
[*]Durée de cache des catégories et types
[*]Si les articles peuvent avoir un type, une note, un historique des anciennes versions et des « articles similaires »
[*]Si un nouvel article crée aussi un sujet dans un forum (l’ID de forum [b]0[/b] désactive cela)
[/list]

Enregistrez ensuite.

[anchor=back_config goto=kb_top]Haut de page[/anchor]

[anchor=cats][b]Catégories[/b][/anchor]

ACP → [b]Base de connaissances[/b] → [b]Catégories[/b].

Créez d’abord une catégorie principale, puis des sous-catégories. Les articles vont dans les sous-catégories ; l’index ne peut pas les contenir.

Donnez à chaque catégorie un nom, une description facultative et une URL d’image facultative. Utilisez [b]Afficher dans la catégorie principale[/b] si elle doit apparaître sur l’accueil de la KB.

[anchor=back_cats goto=kb_top]Haut de page[/anchor]

[anchor=types][b]Types d’article[/b][/anchor]

ACP → [b]Base de connaissances[/b] → [b]Types d’article[/b].

Les types sont des étiquettes comme Guide, FAQ ou Politique. Ils sont facultatifs. Activez « Utiliser les types d’article » dans Configuration si vous voulez le champ sur le formulaire.

[anchor=back_types goto=kb_top]Haut de page[/anchor]

[anchor=perms][b]Permissions[/b][/anchor]

ACP → [b]Base de connaissances[/b] → permissions de catégorie.

Définissez qui peut voir, ajouter, modifier et approuver les articles dans chaque catégorie. Sans [b]kb_view_article[/b], la catégorie n’apparaît pas. Publier sans modérateur demande [b]kb_add_article_direct[/b] (ou le droit modérateur [b]m_activate_kb[/b]).

[anchor=back_perms goto=kb_top]Haut de page[/anchor]

[anchor=write][b]Ajouter un article[/b][/anchor]

Dans la Base de connaissances, choisissez une catégorie et [b]Ajouter un article[/b]. Remplissez titre, description et texte. Le BBCode est autorisé.

Si l’auteur ne peut pas publier directement, l’article attend l’activation d’un modérateur ou d’un administrateur. Ensuite il est public.

[anchor=back_write goto=kb_top]Haut de page[/anchor]

[anchor=lang][b]Traduire un article[/b][/anchor]

Vous pouvez garder un seul article dans la Base de connaissances et quand même afficher un titre, une description et un texte différents selon la langue du forum.

[b]1. Choisissez un nom court[/b]

Utilisez des majuscules et des underscores. Exemple : [b]PUSH_NOTIFICATIONS[/b].

Les lecteurs ne voient jamais ce nom. Il relie seulement l’article aux traductions.

[b]2. Sur le formulaire de l’article, mettez uniquement l’espace réservé[/b]

Chaque champ doit être l’espace réservé et rien d’autre. Ne le mélangez pas avec d’autre texte.

[list]
[*]Titre : [b]{L_PUSH_NOTIFICATIONS}[/b]
[*]Description : [b]{L_PUSH_NOTIFICATIONS_DESC}[/b]
[*]Texte de l’article : [b]{L_PUSH_NOTIFICATIONS_ARTICLE}[/b]
[/list]

[b]3. Mettez le vrai texte dans les fichiers de langue[/b]

Ouvrez [b]language/en/kb/articles.php[/b] et ajoutez trois lignes :

[code]PUSH_NOTIFICATIONS         => Push notifications
PUSH_NOTIFICATIONS_DESC    => Turn on browser alerts.
PUSH_NOTIFICATIONS_ARTICLE => The full article text goes here.[/code]

Copiez les mêmes trois noms dans [b]language/nl/kb/articles.php[/b], [b]language/de/kb/articles.php[/b] et chaque autre dossier de langue utilisé, avec le texte traduit.

L’anglais est obligatoire. Si une ligne manque dans une langue, le texte anglais s’affiche.

[b]4. Comment enregistrer le fichier[/b]

Enregistrez en UTF-8 sans BOM. Notepad++ peut le faire. Le Bloc-notes Windows souvent non, et cela peut casser le forum.

C’est tout. Après vidage du cache, chaque lecteur voit l’article dans sa langue.

[anchor=back_lang goto=kb_top]Haut de page[/anchor]',

// ===== END ARTICLE: KB_SETUP =====


// ===== START ARTICLE: K_LINKS_BANNER_UPLOAD =====
	'K_LINKS_BANNER_UPLOAD'			=> 'Site Banner Exchange',
	'K_LINKS_BANNER_UPLOAD_DESC'	=> 'Configurer le forum Banner Exchange, les permissions, les dossiers de téléversement et le circuit d’approbation des soumissions de bannières du site.',
	'K_LINKS_BANNER_UPLOAD_ARTICLE'	=> '[anchor=klinks_top][/anchor][b]Site Banner Exchange[/b]

Site Banner Exchange peut utiliser un forum pour les soumissions d’échange de bannières et permettre aux utilisateurs de confiance de téléverser une bannière avec le message. La fonction est installée par défaut. Les administrateurs doivent seulement choisir le forum, régler les permissions et vérifier que les dossiers de téléversement sont accessibles en écriture.

[b]Aller à[/b]
[list]
[*][anchor=toc_forum goto=forum]Créer le forum Banner Exchange[/anchor]
[*][anchor=toc_portal goto=portal]Le relier au bloc Site Banner Exchange[/anchor]
[*][anchor=toc_permission goto=permission]Permission de téléversement des bannières[/anchor]
[*][anchor=toc_folders goto=folders]Dossiers de téléversement[/anchor]
[*][anchor=toc_banner goto=banner]Créer l’image de bannière[/anchor]
[*][anchor=toc_submit goto=submit]Soumettre une entrée Banner Exchange[/anchor]
[*][anchor=toc_approve goto=approve]L’approbation est obligatoire[/anchor]
[*][anchor=toc_fix goto=fix]Si quelque chose ne fonctionne pas[/anchor]
[/list]

[anchor=forum][b]Créer le forum Banner Exchange[/b][/anchor]

Créez un forum normal pour les soumissions Banner Exchange. Après l’enregistrement, notez l’ID du forum. Cet ID sera nécessaire lors de la configuration du bloc Site Banner Exchange.

Réglez les permissions phpBB normales du forum pour les groupes ou utilisateurs qui doivent y accéder. Donnez-leur seulement les droits de forum nécessaires, comme voir, lire et publier. Cela contrôle l’accès au forum lui-même.

La permission de téléversement des bannières est séparée. Un utilisateur peut avoir accès au forum sans pouvoir téléverser une bannière s’il n’a pas aussi [b]Peut téléverser des bannières de liens du portail[/b].

[anchor=back_forum goto=klinks_top]Haut de page[/anchor]

[anchor=portal][b]Le relier au bloc Site Banner Exchange[/b][/anchor]

Allez dans les réglages du bloc du portail pour les variables du bloc Site Banner Exchange ([b]k_links_vars[/b]). Définissez [b]Link forum ID[/b] avec l’ID de forum noté auparavant.

L’onglet de téléversement de bannière ne s’applique que dans ce forum configuré. Si l’ID du forum est incorrect, les utilisateurs peuvent peut-être publier dans un forum, mais ils n’y verront pas le circuit de bannière attendu.

[anchor=back_portal goto=klinks_top]Haut de page[/anchor]

[anchor=permission][b]Permission de téléversement des bannières[/b][/anchor]

La permission est [b]u_k_links_upload[/b]. Dans l’ACP, elle apparaît dans les permissions d’utilisateur ou de groupe, sous Permissions avancées → Messages, sous le nom [b]Peut téléverser des bannières de liens du portail[/b].

Par défaut, les administrateurs et les modérateurs globaux ont cette permission. Elle est aussi incluse dans le rôle utilisateur [b]All Features[/b]. Pour tout autre groupe ou utilisateur, attribuez-la manuellement seulement s’ils doivent être autorisés à soumettre des bannières.

C’est une permission globale d’utilisateur/groupe. Elle ne remplace pas les permissions du forum. L’utilisateur doit toujours avoir accès au forum Banner Exchange configuré.

[anchor=back_permission goto=klinks_top]Haut de page[/anchor]

[anchor=folders][b]Dossiers de téléversement[/b][/anchor]

Le forum utilise deux dossiers :

[list]
[*][b]images/links/tmp/[/b] — les bannières en attente y restent.
[*][b]images/links/[/b] — les bannières approuvées y sont déplacées.
[/list]

Les deux dossiers doivent être accessibles en écriture par le serveur web. Si [b]images/links/tmp/[/b] n’existe pas, le code de téléversement peut essayer de le créer, mais il est plus sûr de le créer et de vérifier les permissions pendant la configuration.

[anchor=back_folders goto=klinks_top]Haut de page[/anchor]

[anchor=banner][b]Créer l’image de bannière[/b][/anchor]

Créez une image de bannière de [b]200px de large par 50px de haut[/b] au maximum. Les types de fichiers acceptés sont [b]JPG[/b], [b]JPEG[/b], [b]GIF[/b] et [b]PNG[/b].

Nommez l’image à partir de l’adresse web finale qu’elle doit ouvrir. Comme un nom de fichier ne peut pas contenir [b]/[/b], remplacez chaque barre oblique du chemin de l’URL par [b]+[/b]. N’incluez pas [b]https://[/b] ni [b]http://[/b] dans le nom du fichier.

Exemple : pour [b]https://integramod.com/forum/[/b], nommez l’image [b]integramod.com+forum.jpg[/b]. Vous pouvez utiliser le même nom avec une autre extension autorisée, comme [b]integramod.com+forum.jpeg[/b], [b]integramod.com+forum.gif[/b] ou [b]integramod.com+forum.png[/b].

Quand le bloc Site Banner Exchange affiche la bannière approuvée, il reconstruit l’URL depuis le nom du fichier en remplaçant [b]+[/b] par [b]/[/b].

[anchor=back_banner goto=klinks_top]Haut de page[/anchor]

[anchor=submit][b]Soumettre une entrée Banner Exchange[/b][/anchor]

Un utilisateur autorisé ouvre le forum configuré comme forum Banner Exchange et commence un message. Le formulaire de publication affiche un onglet de téléversement [b]Site Banner Exchange[/b].

Téléversez la bannière JPG, JPEG, GIF ou PNG préparée. Le fichier n’est pas publié immédiatement. Il est placé dans [b]images/links/tmp/[/b] pendant que le message attend l’approbation.

[anchor=back_submit goto=klinks_top]Haut de page[/anchor]

[anchor=approve][b]L’approbation est obligatoire[/b][/anchor]

Toutes les soumissions Banner Exchange nécessitent l’approbation d’un administrateur ou d’un modérateur avant d’être complètes. Le message doit être approuvé par la file de modération normale.

Quand un administrateur ou un modérateur approuve le message, la bannière en attente est déplacée de [b]images/links/tmp/[/b] vers [b]images/links/[/b]. L’entrée de file est marquée comme approuvée avec l’approbateur et l’heure d’approbation.

Tant que cette approbation n’a pas eu lieu, la bannière est seulement en attente. Elle ne doit pas être considérée comme une bannière Site Banner Exchange active.

[anchor=back_approve goto=klinks_top]Haut de page[/anchor]

[anchor=fix][b]Si quelque chose ne fonctionne pas[/b][/anchor]

[list]
[*][b]L’onglet manque[/b] — vérifiez que le bloc Site Banner Exchange a le bon Link forum ID, que l’utilisateur peut accéder à ce forum et qu’il possède [b]Peut téléverser des bannières de liens du portail[/b].
[*][b]Le téléversement échoue[/b] — vérifiez que le fichier est au format JPG, JPEG, GIF ou PNG, qu’il ne dépasse pas 200px × 50px, qu’il est nommé d’après l’URL cible et que [b]images/links/[/b] et [b]images/links/tmp/[/b] sont accessibles en écriture.
[*][b]La bannière n’est pas déplacée[/b] — vérifiez que le message a été approuvé dans la file de modération et que le fichier temporaire existe encore.
[*][b]Les changements de permissions n’apparaissent pas[/b] — videz le cache phpBB et rechargez la page des permissions dans l’ACP.
[/list]

[anchor=back_fix goto=klinks_top]Haut de page[/anchor]',

// ===== END ARTICLE: K_LINKS_BANNER_UPLOAD =====


// ===== START ARTICLE: STYLE_INSTALL =====
	'STYLE_INSTALL'			=> 'Installer un style',
	'STYLE_INSTALL_DESC'	=> 'Téléversez un dossier de style et installez-le depuis le panneau d’administration.',
	'STYLE_INSTALL_ARTICLE'	=> '[anchor=style_top][/anchor][b]Installer un style[/b]

Un style est l’apparence complète du forum : template, thème (CSS/images) et jeu d’images. core et Alpha sont des styles complets. D’autres héritent de _portal_common et ne remplacent que ce dont ils ont besoin.

[b]Aller à[/b]
[list]
[*][anchor=toc_parent goto=parent]Styles qui ont besoin de prosilver d’abord[/anchor]
[*][anchor=toc_upload goto=upload]Mettre les fichiers sur le serveur[/anchor]
[*][anchor=toc_acp goto=acp]Installer dans l’ACP[/anchor]
[*][anchor=toc_default goto=default]En faire le style par défaut[/anchor]
[*][anchor=toc_users goto=users]Utilisateurs encore sur l’ancien style[/anchor]
[*][anchor=toc_notes goto=notes]Héritage et cache[/anchor]
[/list]

[anchor=parent][b]Styles qui ont besoin de prosilver d’abord[/b][/anchor]

[b]fiproice[/b], [b]IM_prosilver[/b] et [b]MiMic[/b] héritent des fichiers manquants de [b]prosilver[/b]. Installez et gardez prosilver [i]avant[/i] d’installer ces trois-là. Sans prosilver, les pages cassent ou restent à moitié stylées.

core et Alpha n’ont pas besoin de prosilver. Ce sont des styles complets.

[anchor=back_parent goto=style_top]Haut de page[/anchor]

[anchor=upload][b]Mettre les fichiers sur le serveur[/b][/anchor]

[list=1]
[*]Téléchargez le paquet du style et décompressez-le sur l’ordinateur.
[*]Vous devez avoir un dossier contenant [b]style.cfg[/b] (et en général [b]template/[/b], [b]theme/[/b], [b]imageset/[/b]).
[*]Téléversez ce dossier dans [b]styles/[/b] sur le forum. Le chemin doit être [b]styles/StyleName/style.cfg[/b], pas un niveau de trop.
[*]Gardez le nom de dossier tel quel. Ne renommez pas core ou Alpha sauf si vous modifiez aussi [b]style.cfg[/b].
[/list]

FTP ou le gestionnaire de fichiers de l’hébergeur conviennent. Le serveur web doit pouvoir lire les fichiers.

[anchor=back_upload goto=style_top]Haut de page[/anchor]

[anchor=acp][b]Installer dans l’ACP[/b][/anchor]

[list=1]
[*]Connectez-vous en administrateur.
[*]Allez à [b]ACP → Styles → Styles[/b].
[*]Si vous installez fiproice, IM_prosilver ou MiMic, vérifiez d’abord que [b]prosilver[/b] est déjà dans la liste des styles installés. Installez-le d’abord sinon.
[*]Sous les styles non installés, trouvez le nouveau nom et cliquez sur [b]Installer un style[/b].
[*]Confirmez. Si le style a besoin d’un template, thème ou jeu d’images parent pas encore installé, l’ACP le dira. Installez-les d’abord.
[/list]

Les styles installés apparaissent dans la liste avec un nombre d’utilisateurs. Le style par défaut actuel a un astérisque (*).

[anchor=back_acp goto=style_top]Haut de page[/anchor]

[anchor=default][b]En faire le style par défaut[/b][/anchor]

Sur la même page, définissez-le comme style par défaut du forum si tout le monde doit l’avoir. Vous pouvez le laisser installé sans en faire le défaut si les utilisateurs peuvent le choisir.

Désactivez un style plutôt que de le supprimer si vous voulez seulement le cacher de la liste utilisateur. Ne désinstallez pas prosilver tant que fiproice, IM_prosilver ou MiMic sont encore utilisés.

[anchor=back_default goto=style_top]Haut de page[/anchor]

[anchor=users][b]Utilisateurs encore sur l’ancien style[/b][/anchor]

Le style enregistré d’un utilisateur ne change pas toujours quand vous changez le défaut du forum. Si « forcer le style utilisateur » est désactivé, ils gardent l’ancien choix jusqu’à ce qu’ils prennent le nouveau dans le panneau utilisateur.

Pour imposer le nouvel aspect : ACP → [b]Paramètres du forum[/b] (ou Paramètres utilisateur) et activez le forçage du style, ou modifiez les utilisateurs sous [b]Utilisateurs et groupes[/b].

[anchor=back_users goto=style_top]Haut de page[/anchor]

[anchor=notes][b]Héritage et cache[/b][/anchor]

[list]
[*]Les styles qui héritent de prosilver n’ont besoin que des fichiers qu’ils remplacent. Les templates manquants retombent sur le parent.
[*]Après installation ou modification de templates, videz le cache : ACP → [b]Général[/b] → [b]Vider le cache[/b]. Supprimez aussi des fichiers dans [b]cache/[/b] si un changement n’apparaît pas.
[*]Ne mélangez pas les fichiers de deux styles dans un dossier. Téléversez un paquet de style complet.
[*]Alpha est le même code moderne core dans un look forum rétro, pas un prédécesseur plus ancien.
[/list]

[anchor=back_notes goto=style_top]Haut de page[/anchor]',

// ===== END ARTICLE: STYLE_INSTALL =====


// ===== START ARTICLE: IM_INSTALL =====
	'IM_INSTALL'			=> 'Installer IntegraMOD 3',
	'IM_INSTALL_DESC'		=> 'Téléversez le paquet, choisissez un cache, lancez l’installateur, puis sécurisez le forum.',
	'IM_INSTALL_ARTICLE'	=> '[anchor=im_top][/anchor][b]Installer IntegraMOD 3[/b]

IntegraMOD 3 est un paquet forum complet. Vous téléversez les fichiers, lancez l’installateur une fois, puis retirez les dossiers qui n’ont rien à faire sur un site en production. Il faut un hébergeur avec PHP et une base de données. Si vous n’avez pas les identifiants de la base, demandez-les à l’hébergeur avant de commencer.

[b]Aller à[/b]
[list]
[*][anchor=toc_need goto=need]Ce qu’il vous faut[/anchor]
[*][anchor=toc_files goto=files]Mettre les fichiers sur le serveur[/anchor]
[*][anchor=toc_perm goto=perm]Droits des dossiers[/anchor]
[*][anchor=toc_cache goto=cache]Choix du cache[/anchor]
[*][anchor=toc_run goto=run]Lancer l’installateur[/anchor]
[*][anchor=toc_after goto=after]Ensuite — supprimer ces dossiers[/anchor]
[*][anchor=toc_config goto=config]Verrouiller config.php[/anchor]
[*][anchor=toc_stuck goto=stuck]Si ça échoue[/anchor]
[/list]

[anchor=need][b]Ce qu’il vous faut[/b][/anchor]

[list]
[*]PHP 7.4 ou plus récent (jusqu’à PHP 8.5)
[*]Une base de données : MySQL / MariaDB est le plus courant. PostgreSQL, SQLite, Firebird, MS SQL et Oracle conviennent aussi si l’hébergeur les propose
[*]FTP ou un gestionnaire de fichiers pour téléverser
[*]Nom de la base, utilisateur, mot de passe et nom d’hôte du serveur, fournis par l’hébergeur
[/list]

[anchor=back_need goto=im_top]Haut de page[/anchor]

[anchor=files][b]Mettre les fichiers sur le serveur[/b][/anchor]

[list=1]
[*]Décompressez le paquet IntegraMOD sur l’ordinateur.
[*]Téléversez [b]tout[/b] dans un dossier web, en gardant les mêmes dossiers et noms. Ne forcez pas les noms en minuscules.
[*]Un chemin typique est [b]https://example.com/forum/[/b] ou la racine du site.
[/list]

Avec SSH, vous pouvez téléverser le zip et le décompresser sur le serveur au lieu d’envoyer des milliers de fichiers par FTP.

[anchor=back_files goto=im_top]Haut de page[/anchor]

[anchor=perm][b]Droits des dossiers[/b][/anchor]

L’installateur doit pouvoir écrire dans quelques chemins :

[list]
[*][b]config.php[/b] — inscriptible seulement pendant l’installation (souvent 666). Changez-le ensuite ; voir [anchor=toc_config_jump goto=config]Verrouiller config.php[/anchor]
[*][b]store/[/b], [b]cache/[/b], [b]files/[/b], [b]images/avatars/upload/[/b] — inscriptibles (souvent 777 en hébergement mutualisé)
[/list]

Le logiciel FTP ou le gestionnaire de fichiers de l’hébergeur peuvent le faire.

[anchor=back_perm goto=im_top]Haut de page[/anchor]

[anchor=cache][b]Choix du cache[/b][/anchor]

L’installateur demande où stocker les données en cache. Choisissez ce que l’hébergeur a vraiment.

[list]
[*][b]File (par défaut)[/b] — écrit les fichiers de cache sous [b]store/[/b]. Simple et fiable. À prendre sur la plupart des hébergements mutualisés.
[*][b]Memcache[/b] ou [b]Memcached[/b] — cache mémoire rapide. Il faut l’extension PHP et un serveur memcached.
[*][b]Redis[/b] — magasin mémoire rapide avec des extras. Il faut l’extension Redis et un serveur Redis.
[*][b]APC / APCu[/b] — cache mémoire dans PHP sur un seul serveur.
[*][b]WinCache[/b] — hôtes Windows uniquement.
[*][b]XCache[/b] / [b]eAccelerator[/b] — anciens caches d’opcode ; seulement si l’hébergeur les a encore.
[*][b]Memory (processus seulement)[/b] — rapide, mais chaque processus PHP a son propre cache. Pas partagé.
[*][b]Pas de cache[/b] — uniquement pour déboguer. Pas sur un forum en production.
[/list]

En cas de doute, laissez [b]File[/b]. Vous pourrez changer plus tard dans l’ACP si l’hébergeur ajoute Memcached ou Redis.

[anchor=back_cache goto=im_top]Haut de page[/anchor]

[anchor=run][b]Lancer l’installateur[/b][/anchor]

Ouvrez [b]https://votre-site/forum/install/[/b] (ajoutez [b]install/[/b] à l’endroit où vous avez téléversé les fichiers).

[list=1]
[*]Lisez l’intro, puis ouvrez l’onglet [b]INSTALL[/b].
[*]La page des prérequis vérifie PHP et les dossiers. Corrigez tout ce qui est obligatoire avant de continuer.
[*]Saisissez le type de base, le nom d’hôte, le nom, l’utilisateur et le mot de passe. Laissez le port vide sauf si l’hébergeur vous en a donné un. Gardez le préfixe de tables sauf si vous avez déjà un autre forum dans la même base.
[*]Choisissez le type de cache (voir plus haut).
[*]Créez le premier compte administrateur (votre identifiant).
[*]Laissez-le écrire [b]config.php[/b]. S’il ne peut pas, il affichera le contenu à coller à la main.
[/list]

Quand il affiche félicitations, le forum est installé.

[anchor=back_run goto=im_top]Haut de page[/anchor]

[anchor=after][b]Ensuite — supprimer ces dossiers[/b][/anchor]

Ces chemins n’ont rien à faire sur un site public. Supprimez-les de la racine web (ou retirez-les du serveur). Les laisser est une faille de sécurité.

[list]
[*][b]install/[/b] — [b]doit[/b] disparaître. Tant qu’il est là, seul le panneau d’administration fonctionne, et quiconque l’ouvre peut détruire le forum.
[*][b]develop/[/b] — [b]supprimez-le en priorité.[/b] Outils de développement et code de test. Ne le laissez jamais sur un forum en production.
[*][b]stk/[/b] — Support Toolkit. Utile pour réparer un forum cassé ; dangereux si des inconnus peuvent l’ouvrir. Retirez-le quand vous avez fini.
[*][b]docs/[/b] — notes d’installation. Vous pouvez les supprimer après lecture.
[/list]

Facultatif : convertissez un ancien forum phpBB 2 via le lien convertisseur de la page de succès [i]avant[/i] de supprimer [b]install/[/b].

Puis connectez-vous avec le compte administrateur créé.

[anchor=back_after goto=im_top]Haut de page[/anchor]

[anchor=config][b]Verrouiller config.php[/b][/anchor]

[b]config.php[/b] contient le mot de passe de la base. Pendant l’installation, il est souvent en [b]666[/b] (inscriptible par tout le monde) pour que l’installateur puisse écrire. Ça ne doit pas rester ainsi.

Après l’installation :

[list]
[*]Mettez [b]config.php[/b] en [b]644[/b] (ou [b]640[/b] si l’hébergeur le permet). Le serveur web doit encore pouvoir le [i]lire[/i].
[*]Ne le laissez [b]pas[/b] en [b]666[/b]. Quiconque peut écrire ce fichier possède la base.
[/list]

[anchor=back_config goto=im_top]Haut de page[/anchor]

[anchor=stuck][b]Si ça échoue[/b][/anchor]

[list]
[*][b]Could not connect to the database[/b] — nom d’hôte, nom, utilisateur ou mot de passe incorrect. Demandez à l’hébergeur.
[*]Un dossier n’est pas inscriptible — remettez les droits, puis cliquez sur Tester à nouveau sur la page des prérequis.
[*]Page blanche après installation — [b]install/[/b] est encore là, ou [b]cache/[/b] n’est pas inscriptible.
[*]PHP trop ancien — l’hébergeur doit être en PHP 7.4 ou plus récent.
[/list]

Plus de détail dans [b]docs/INSTALL.html[/b] du paquet (lisez-le avant de supprimer [b]docs/[/b]).

[anchor=back_stuck goto=im_top]Haut de page[/anchor]',
));

// ===== END ARTICLE: IM_INSTALL =====
