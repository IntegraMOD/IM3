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
	'RANDOM_TITLE'		 => 'Example localized title',
	'RANDOM_DESCRIPTION' => 'Example localized description',
	'RANDOM_ARTICLE'	 => 'This is an example localized Knowledge Base article body. You may use BBCode here.',

// ===== END ARTICLE: RANDOM =====


// ===== START ARTICLE: SAVE_FORUM_APP =====
	'SAVE_FORUM_APP'			=> 'Save the forum as an app',
	'SAVE_FORUM_APP_DESC'		=> 'Add the forum to your desktop, home screen, or Dock so it opens like an app.',
	'SAVE_FORUM_APP_ARTICLE'	=> '[anchor=app_top][/anchor][b]IntegraMOD as an app[/b]

Putting the forum on your desktop or home screen is just a shortcut, but it is a useful one. You open it in its own window instead of hunting through a pile of tabs. On a phone it sits next to your other apps and opens full screen. One click from the taskbar, Dock, or home screen and you are in.

You still need the internet, and you stay logged in the same way you already do in that browser. Nothing is downloaded from an app store.

Pick the browser you actually use, then jump to the steps for it.

[b]Desktop Browsers[/b]
[list]
[*][anchor=toc_chrome goto=chrome]Google Chrome[/anchor]
[*][anchor=toc_edge goto=edge]Microsoft Edge[/anchor]
[*][anchor=toc_safari_mac goto=safari_mac]Safari (Mac)[/anchor]
[*][anchor=toc_firefox_desk goto=firefox_desk]Firefox[/anchor]
[/list]

[b]Mobile Browsers[/b]
[list]
[*][anchor=toc_safari_ios goto=safari_ios]Safari (iPhone / iPad)[/anchor]
[*][anchor=toc_chrome_and goto=chrome_and]Chrome (Android)[/anchor]
[*][anchor=toc_firefox_and goto=firefox_and]Firefox (Android)[/anchor]
[/list]

[b]After setup[/b]
[list]
[*][anchor=toc_push_top goto=push]Enable push notifications[/anchor]
[/list]

[anchor=chrome][b]Google Chrome (desktop)[/b][/anchor]

Works on Windows, macOS, and Linux.

[list=1]
[*]Open the forum in Chrome.
[*]Look in the address bar for a small install icon. It usually looks like a computer with a down arrow, or a plus on a screen.
[*]No icon? Open the three-dot menu and choose [b]Install app[/b] or [b]Install this site as an app[/b].
[*]Keep or change the name, then click [b]Install[/b].
[/list]

Chrome puts it in the Start menu or Applications folder. Pin it to the taskbar or Dock if you want it one click away. It opens in a plain window without the usual tab strip.

To drop it later, open the app, use its menu, and choose Uninstall.

[anchor=back_chrome goto=app_top]Back to top[/anchor]

[anchor=edge][b]Microsoft Edge (desktop)[/b][/anchor]

Same idea as Chrome, and the wording is almost identical.

[list=1]
[*]Open the forum in Edge.
[*]Click the install icon in the address bar if you see it.
[*]Otherwise open the three-dot menu and choose [b]Apps → Install this site as an app[/b].
[*]Confirm the name and click [b]Install[/b].
[/list]

You can pin it to the taskbar or Start. Uninstall from the app menu, or delete the shortcut.

[anchor=back_edge goto=app_top]Back to top[/anchor]

[anchor=safari_mac][b]Safari (Mac)[/b][/anchor]

[list=1]
[*]Open the forum in Safari.
[*]Choose [b]File → Add to Dock[/b]. Some versions hide it under Share instead.
[*]Confirm the name and add it.
[/list]

Safari drops an icon in the Dock. Click it and the forum opens in its own window.

[anchor=back_safari_mac goto=app_top]Back to top[/anchor]

[anchor=firefox_desk][b]Firefox (desktop)[/b][/anchor]

Firefox does not install web apps the way Chrome and Edge do. You can still keep it close:

[list]
[*]Bookmark the forum, or
[*]Drag the padlock / site icon from the address bar onto the desktop to make a shortcut.
[/list]

That shortcut still opens in a normal Firefox window, but it beats digging through bookmarks every time.

[anchor=back_firefox_desk goto=app_top]Back to top[/anchor]

[anchor=safari_ios][b]Safari (iPhone / iPad)[/b][/anchor]

Use Safari for this. Chrome on iPhone cannot add a proper home-screen app the same way.

[list=1]
[*]Open the forum in Safari.
[*]Tap [b]Share[/b] (the square with the arrow pointing up).
[*]Scroll the share sheet and tap [b]Add to Home Screen[/b].
[*]Change the name if you want, then tap [b]Add[/b].
[/list]

The icon lands on the home screen and opens the forum full screen.

If you do not see Add to Home Screen, tap Edit Actions or More in the share sheet and turn it on.

[anchor=back_safari_ios goto=app_top]Back to top[/anchor]

[anchor=chrome_and][b]Chrome (Android)[/b][/anchor]

[list=1]
[*]Open the forum in Chrome.
[*]Tap the three-dot menu.
[*]Tap [b]Install app[/b] or [b]Add to Home screen[/b].
[*]Confirm [b]Install[/b] or [b]Add[/b].
[/list]

Sometimes Android also shows an Install banner at the bottom of the page. That works too.

The icon shows up on the home screen or in the app drawer and opens in its own window.

[anchor=back_chrome_and goto=app_top]Back to top[/anchor]

[anchor=firefox_and][b]Firefox (Android)[/b][/anchor]

[list=1]
[*]Open the forum in Firefox.
[*]Open the browser menu.
[*]Tap [b]Install[/b] or [b]Add to Home screen[/b] if your phone offers it.
[/list]

If that option is missing, add a bookmark instead. It is not as tidy as an app icon, but it still gets you there in one tap.

[anchor=back_firefox_and goto=app_top]Back to top[/anchor]

[b]After it is installed[/b]
[list]
[*][anchor=toc_push goto=push]Enable push notifications[/anchor]
[/list]

[anchor=push][b]Enable push notifications[/b][/anchor]

The icon does not turn notifications on. It is only a window into the same browser you used to add it. Push belongs to that browser, and it only starts after you allow it while you are logged in.

Open the forum from the new icon, not from an old tab. Log in there. Then open your profile and go to [b]User Control Panel[/b] → [b]Board preferences[/b] → [b]Push Notifications[/b].

That page subscribes [i]this[/i] browser or app window. Click [b]Enable browser notifications[/b]. The browser will ask for permission; choose [b]Allow[/b]. When it worked, the page says [b]This browser is subscribed.[/b]

That permission only lets the board send. Under it, tick [b]Web Push[/b] for the events you actually want (private messages, likes, subscribed topics, and so on), then click [b]Submit[/b].

Do this again on every phone, tablet, or computer you installed. Enabling it on one device does not turn it on for the others. If [b]Enable browser notifications[/b] does nothing, this site is blocked for notifications in the browser or an extension. Allow it for the forum and click the button again.

[b]A couple of extra notes[/b]
[list]
[*]Open the new icon once and log in. That login stays with the browser you used to add it.
[*]If the icon opens a blank page, delete it and add it again from the live HTTPS address, not from an old bookmark.
[*]Forum updates do not make you add the icon again.
[/list]

[anchor=back_push goto=app_top]Back to top[/anchor]',

// ===== END ARTICLE: SAVE_FORUM_APP =====


// ===== START ARTICLE: PUSH_NOTIFICATIONS =====
	'PUSH_NOTIFICATIONS'			=> 'Push notifications',
	'PUSH_NOTIFICATIONS_DESC'		=> 'Turn on browser alerts for private messages, likes, and other board events.',
	'PUSH_NOTIFICATIONS_ARTICLE'	=> '[anchor=push_top][/anchor][b]Push notifications[/b]

Push is a short alert from the forum when something happens while you are not looking. A private message, a like, a reply in a topic you watch. It shows in the browser or on the phone the same way other sites do.

The board can send. Your browser has to allow it. You do that once per device, while you are logged in.

[b]Jump to[/b]
[list]
[*][anchor=toc_before goto=before]Before you start[/anchor]
[*][anchor=toc_enable goto=enable]Turn it on[/anchor]
[*][anchor=toc_events goto=events]Choose events[/anchor]
[*][anchor=toc_devices goto=devices]More than one device[/anchor]
[*][anchor=toc_sms goto=sms]SMS (optional)[/anchor]
[*][anchor=toc_admin goto=admin]Administrator setup[/anchor]
[*][anchor=toc_fix goto=fix]If it does not work[/anchor]
[/list]

[anchor=before][b]Before you start[/b][/anchor]

[list]
[*]Use HTTPS. Push does not work on a plain http address.
[*]Log in. Guests cannot subscribe.
[*]Open the forum in the browser (or app window) you want alerts in. Permission belongs to that browser, not to your account as a whole.
[/list]

If you added the forum as an app, open it from that icon, not from an old tab. Then follow the steps below in that window.

[anchor=back_before goto=push_top]Back to top[/anchor]

[anchor=enable][b]Turn it on[/b][/anchor]

[list=1]
[*]Open [b]User Control Panel[/b] → [b]Board preferences[/b] → [b]Push Notifications[/b].
[*]Click [b]Enable browser notifications[/b] (wording may say [b]Enable desktop notifications[/b]).
[*]When the browser asks, choose [b]Allow[/b].
[*]The page should then say [b]This browser is subscribed.[/b]
[/list]

That permission only lets the board send. It does not pick the events. Do that next.

[anchor=back_enable goto=push_top]Back to top[/anchor]

[anchor=events][b]Choose events[/b][/anchor]

Under the subscription status, tick [b]Web Push[/b] for the events you actually want, then click [b]Submit[/b].

Typical events (only those the administrator has enabled will show):
[list]
[*]Private messages
[*]Likes
[*]Friend requests and accepts
[*]Replies in posts you watch
[*]Updates in topics you watch
[*]News and announcements
[*]Mentions, when someone writes @yourname in an allowed forum
[*]New registrations and new posts, for the staff or groups the administrator selected
[/list]

Leave a box empty if you do not want that alert.

[anchor=back_events goto=push_top]Back to top[/anchor]

[anchor=devices][b]More than one device[/b][/anchor]

Enabling push on one phone, tablet, or computer does not turn it on for the others. Repeat the steps in each browser or app window you installed.

[anchor=back_devices goto=push_top]Back to top[/anchor]

[anchor=sms][b]SMS (optional)[/b][/anchor]

If the administrator turned SMS on, the same page can take a country code and mobile number. That number is stored encrypted. Tick [b]SMS Push[/b] only for the events you want as a text message.

[anchor=back_sms goto=push_top]Back to top[/anchor]

[anchor=admin][b]Administrator setup[/b][/anchor]

Open [b]ACP → General → Push Notifications → Settings[/b]. Browser push uses OneSignal. SMS can use either OneSignal or Twilio.

[b]OneSignal[/b]
[list]
[*]Create an app at OneSignal and copy its [b]App ID[/b] and [b]REST API key[/b] into the matching fields.
[*]The site must use HTTPS. OneSignal also needs the site domain allowed in the OneSignal app.
[*]Without an App ID, nobody can subscribe to browser notifications.
[/list]

[b]Twilio[/b]
[list]
[*]Set [b]SMS gateway[/b] to [b]Twilio[/b]. Leave it on OneSignal if SMS should go through OneSignal instead.
[*][b]Twilio SID[/b] is the Account SID from the Twilio console.
[*][b]Twilio Token[/b] is the Auth Token for that account.
[*][b]Twilio From Number[/b] is the Twilio number that sends the text, including the country code, such as +15551234567.
[*]Twilio fields are ignored while the gateway remains OneSignal.
[/list]

[b]Event options[/b]

The table turns each event on or off for [b]Web Push[/b] and [b]SMS Push[/b]. A user can only choose an event after it is enabled here.

[list]
[*][b]New registration[/b] goes only to founders and administrators. Tick [b]Include moderators[/b] if moderators should receive it too.
[*][b]New post[/b] goes to that same staff audience. Use [b]New-post groups[/b] to add other groups. Hold Ctrl while selecting more than one group.
[*][b]Mention[/b] is an extra web or SMS alert when a valid @username mention is posted. The user still has to enable that push type in the User Control Panel. A mention also sends a private message, or an e-mail if the user chose e-mail under Board preferences.
[/list]

[b]Mentions[/b]

Mentions also have two posting controls, and both must be on:
[list]
[*][b]ACP → Posting → Messages → Post settings → Allow mentions[/b] controls the whole board. Turning it on the first time enables mentions for existing forums.
[*][b]ACP → Forums → Create or edit forum → Enable mentions[/b] controls one forum. New forums start enabled. Uncheck it for a forum that should not allow mentions.
[/list]

A user writes @name in the posting or quick-reply editor and chooses a name from the list. The post stores it as a mention tag. If either setting is off, the list does not appear and no mention notification is sent.

[anchor=back_admin goto=push_top]Back to top[/anchor]

[anchor=fix][b]If it does not work[/b][/anchor]

[list]
[*]The button does nothing, or the page never says the browser is subscribed: this site is blocked for notifications. Allow it in the browser settings, then click the button again.
[*]An extension such as uBlock, AdGuard, Brave Shields, DuckDuckGo, or Firefox strict tracking protection can block the notification service. Allow it for this forum.
[*]You are not logged in, or you opened an old HTTP bookmark.
[*]You allowed it in one browser and are waiting in another. Subscribe each one.
[/list]

A mention sends a private message by default. The user can choose e-mail instead under [b]User Control Panel → Board preferences → Edit global settings → Mention notification[/b]. Push is separate: a mention push is sent only when board mentions, the forum mention setting, and the user’s mention push preference are all enabled.

[anchor=back_fix goto=push_top]Back to top[/anchor]',

// ===== END ARTICLE: PUSH_NOTIFICATIONS =====


// ===== START ARTICLE: KB_SETUP =====
	'KB_SETUP'			=> 'Set up the Knowledge Base',
	'KB_SETUP_DESC'		=> 'Create categories, types, and permissions, then publish articles.',
	'KB_SETUP_ARTICLE'	=> '[anchor=kb_top][/anchor][b]Set up the Knowledge Base[/b]

The Knowledge Base is a separate article library, not a forum. Staff write articles; readers browse categories. Setup is all in the Administration Control Panel.

[b]Jump to[/b]
[list]
[*][anchor=toc_config goto=config]Configuration[/anchor]
[*][anchor=toc_cats goto=cats]Categories[/anchor]
[*][anchor=toc_types goto=types]Article types[/anchor]
[*][anchor=toc_perms goto=perms]Permissions[/anchor]
[*][anchor=toc_write goto=write]Add an article[/anchor]
[*][anchor=toc_lang goto=lang]Translate an article[/anchor]
[/list]

[anchor=config][b]Configuration[/b][/anchor]

ACP → [b]Knowledge Base[/b] → [b]Configuration[/b].

Set the name and description readers see on the KB index. Then:
[list]
[*]How many articles to show on that index
[*]Index layout: Modern or Classic
[*]Cache time for categories and types
[*]Whether articles can have a type, a rating, a history of old versions, and “similar articles”
[*]Whether a new article also posts a topic in a forum (forum ID [b]0[/b] turns that off)
[/list]

Save when you are done.

[anchor=back_config goto=kb_top]Back to top[/anchor]

[anchor=cats][b]Categories[/b][/anchor]

ACP → [b]Knowledge Base[/b] → [b]Categories[/b].

Make a main category first, then sub-categories under it. Articles live in the sub-categories; the index itself cannot hold them.

Give each category a name, optional description, and optional image URL. Use [b]Show in main category[/b] when the category should appear on the KB home page.

[anchor=back_cats goto=kb_top]Back to top[/anchor]

[anchor=types][b]Article types[/b][/anchor]

ACP → [b]Knowledge Base[/b] → [b]Article types[/b].

Types are labels such as How-to, FAQ, or Policy. They are optional. Turn “Use article types” on in Configuration if you want the field on the article form.

[anchor=back_types goto=kb_top]Back to top[/anchor]

[anchor=perms][b]Permissions[/b][/anchor]

ACP → [b]Knowledge Base[/b] → category permissions.

Set who can view, add, edit, and approve articles in each category. Users without [b]kb_view_article[/b] never see that category. Direct publish without a moderator needs [b]kb_add_article_direct[/b] (or the moderator [b]m_activate_kb[/b] right).

[anchor=back_perms goto=kb_top]Back to top[/anchor]

[anchor=write][b]Add an article[/b][/anchor]

From the Knowledge Base, choose a category and [b]Add an article[/b]. Fill in title, description, and body. You can use BBCode.

Unless the author may publish directly, the article waits for a moderator or administrator to activate it. After that it is public.

[anchor=back_write goto=kb_top]Back to top[/anchor]

[anchor=lang][b]Translate an article[/b][/anchor]

You can keep one article in the Knowledge Base and still show a different title, description, and text for each board language.

[b]1. Pick a short name[/b]

Use capital letters and underscores. Example: [b]PUSH_NOTIFICATIONS[/b].

Readers never see that name. It only links the article to the translations.

[b]2. On the article form, put only the placeholder[/b]

Each field must be the placeholder and nothing else. Do not mix it with other text.

[list]
[*]Title: [b]{L_PUSH_NOTIFICATIONS}[/b]
[*]Description: [b]{L_PUSH_NOTIFICATIONS_DESC}[/b]
[*]Article text: [b]{L_PUSH_NOTIFICATIONS_ARTICLE}[/b]
[/list]

[b]3. Put the real wording in the language files[/b]

Open [b]language/en/kb/articles.php[/b] and add three lines:

[code]PUSH_NOTIFICATIONS         => Push notifications
PUSH_NOTIFICATIONS_DESC    => Turn on browser alerts.
PUSH_NOTIFICATIONS_ARTICLE => The full article text goes here.[/code]

Copy the same three names into [b]language/nl/kb/articles.php[/b], [b]language/de/kb/articles.php[/b], and every other language folder you use, with the translated text.

English is required. If a language is missing a line, the English text is shown.

[b]4. How to save the file[/b]

Save as UTF-8 without BOM. Notepad++ can do that. Windows Notepad often cannot, and that can break the board.

That is all. After the cache is purged, each reader sees the article in their own language.

[anchor=back_lang goto=kb_top]Back to top[/anchor]',

// ===== END ARTICLE: KB_SETUP =====


// ===== START ARTICLE: K_LINKS_BANNER_UPLOAD =====
	'K_LINKS_BANNER_UPLOAD'			=> 'Site Banner Exchange',
	'K_LINKS_BANNER_UPLOAD_DESC'	=> 'Configure the Banner Exchange forum, permissions, upload folders, and approval flow for site banner submissions.',
	'K_LINKS_BANNER_UPLOAD_ARTICLE'	=> '[anchor=klinks_top][/anchor][b]Site Banner Exchange[/b]

The Site Banner Exchange can use a forum for submitted banner exchange entries and let trusted users upload a banner with the post. The feature is installed by default. Administrators only need to choose the forum, set permissions, and make sure the upload folders are writable.

[b]Jump to[/b]
[list]
[*][anchor=toc_forum goto=forum]Create the Banner Exchange forum[/anchor]
[*][anchor=toc_portal goto=portal]Connect it to the Site Banner Exchange block[/anchor]
[*][anchor=toc_permission goto=permission]Banner upload permission[/anchor]
[*][anchor=toc_folders goto=folders]Upload folders[/anchor]
[*][anchor=toc_banner goto=banner]Create the banner image[/anchor]
[*][anchor=toc_submit goto=submit]Submit a banner exchange entry[/anchor]
[*][anchor=toc_approve goto=approve]Approval is required[/anchor]
[*][anchor=toc_fix goto=fix]If something does not work[/anchor]
[/list]

[anchor=forum][b]Create the Banner Exchange forum[/b][/anchor]

Create a normal forum for banner exchange submissions. After saving it, note the forum ID. You will need that ID when configuring the Site Banner Exchange block.

Set the normal phpBB forum permissions for the groups or users that should have access. Give them only the forum rights they need, such as viewing, reading, and posting. This controls access to the forum itself.

The banner upload permission is separate. A user can have access to the forum but still be unable to upload a banner unless they also have [b]Can upload portal link banners[/b].

[anchor=back_forum goto=klinks_top]Back to top[/anchor]

[anchor=portal][b]Connect it to the Site Banner Exchange block[/b][/anchor]

Go to the portal block settings for the Site Banner Exchange block variables ([b]k_links_vars[/b]). Set [b]Link forum ID[/b] to the forum ID you noted earlier.

The banner upload tab only applies in that configured forum. If the forum ID is wrong, users may be able to post in a forum but they will not see the expected banner workflow there.

[anchor=back_portal goto=klinks_top]Back to top[/anchor]

[anchor=permission][b]Banner upload permission[/b][/anchor]

The permission is [b]u_k_links_upload[/b]. In the ACP it appears under user or group permissions, in Advanced permissions → Post, as [b]Can upload portal link banners[/b].

By default, administrators and global moderators have this permission. It is also included in the [b]All Features[/b] user role. For any other group or user, assign it manually only if they should be trusted to submit banners.

This is a global user/group permission. It does not replace forum permissions. The user still needs access to the configured Banner Exchange forum.

[anchor=back_permission goto=klinks_top]Back to top[/anchor]

[anchor=folders][b]Upload folders[/b][/anchor]

The board uses two folders:

[list]
[*][b]images/links/tmp/[/b] — pending banner uploads wait here.
[*][b]images/links/[/b] — approved banners are moved here.
[/list]

Both folders must be writable by the web server. If [b]images/links/tmp/[/b] does not exist, the upload code may try to create it, but it is safer to create it and confirm permissions during setup.

[anchor=back_folders goto=klinks_top]Back to top[/anchor]

[anchor=banner][b]Create the banner image[/b][/anchor]

Create a banner image no larger than [b]200px wide by 50px high[/b]. Accepted file types are [b]JPG[/b], [b]JPEG[/b], [b]GIF[/b], and [b]PNG[/b].

Name the image from the final web address it should open. Because a file name cannot contain [b]/[/b], replace each slash in the URL path with [b]+[/b]. Do not include [b]https://[/b] or [b]http://[/b] in the file name.

Example: for [b]https://integramod.com/forum/[/b], name the image [b]integramod.com+forum.jpg[/b]. You can use the same name with another allowed extension, such as [b]integramod.com+forum.jpeg[/b], [b]integramod.com+forum.gif[/b], or [b]integramod.com+forum.png[/b].

When the Site Banner Exchange block displays the approved banner, it rebuilds the URL from the file name by replacing [b]+[/b] with [b]/[/b].

[anchor=back_banner goto=klinks_top]Back to top[/anchor]

[anchor=submit][b]Submit a banner exchange entry[/b][/anchor]

A permitted user opens the forum configured as the Banner Exchange forum and starts a post. The posting form shows a [b]Site Banner Exchange[/b] upload tab.

Upload the prepared JPG, JPEG, GIF, or PNG banner. The file is not published immediately. It is staged in [b]images/links/tmp/[/b] while the post waits for approval.

[anchor=back_submit goto=klinks_top]Back to top[/anchor]

[anchor=approve][b]Approval is required[/b][/anchor]

All banner exchange submissions require administrator or moderator approval before the submission is complete. The post must be approved through the normal moderation queue.

When an administrator or moderator approves the post, the staged banner is moved from [b]images/links/tmp/[/b] to [b]images/links/[/b]. The queue record is marked approved with the approver and approval time.

Until that approval happens, the banner is only pending. It should not be treated as a live Site Banner Exchange banner.

[anchor=back_approve goto=klinks_top]Back to top[/anchor]

[anchor=fix][b]If something does not work[/b][/anchor]

[list]
[*][b]The tab is missing[/b] — confirm the Site Banner Exchange block has the correct Link forum ID, the user can access that forum, and the user has [b]Can upload portal link banners[/b].
[*][b]Upload fails[/b] — confirm the file is JPG, JPEG, GIF, or PNG, no larger than 200px × 50px, named from the target URL, and that [b]images/links/[/b] and [b]images/links/tmp/[/b] are writable.
[*][b]The banner does not move[/b] — confirm the post was approved through the moderation queue and that the temporary file still exists.
[*][b]Permission changes do not appear[/b] — purge the phpBB cache and reload the ACP permissions page.
[/list]

[anchor=back_fix goto=klinks_top]Back to top[/anchor]',

// ===== END ARTICLE: K_LINKS_BANNER_UPLOAD =====


// ===== START ARTICLE: STYLE_INSTALL =====
	'STYLE_INSTALL'			=> 'Install a style',
	'STYLE_INSTALL_DESC'	=> 'Upload a style folder and install it from the Administration Control Panel.',
	'STYLE_INSTALL_ARTICLE'	=> '[anchor=style_top][/anchor][b]Install a style[/b]

A style is a complete look for the board: template, theme (CSS/images), and imageset. IntegraStyle and Alpha are full styles. Some others inherit from prosilver and only override what they need.

[b]Jump to[/b]
[list]
[*][anchor=toc_parent goto=parent]Styles that need prosilver first[/anchor]
[*][anchor=toc_upload goto=upload]Put the files on the server[/anchor]
[*][anchor=toc_acp goto=acp]Install in the ACP[/anchor]
[*][anchor=toc_default goto=default]Make it the board default[/anchor]
[*][anchor=toc_users goto=users]Users still on the old style[/anchor]
[*][anchor=toc_notes goto=notes]Inheritance and cache[/anchor]
[/list]

[anchor=parent][b]Styles that need prosilver first[/b][/anchor]

[b]fiproice[/b], [b]IM_prosilver[/b], and [b]MiMic[/b] inherit missing files from [b]prosilver[/b]. Install and keep prosilver [i]before[/i] you install those three. If prosilver is missing, pages break or look half-styled.

IntegraStyle and Alpha do not need prosilver. They are complete styles.

[anchor=back_parent goto=style_top]Back to top[/anchor]

[anchor=upload][b]Put the files on the server[/b][/anchor]

[list=1]
[*]Download the style package and unzip it on your computer.
[*]You should have a folder with [b]style.cfg[/b] inside it (and usually [b]template/[/b], [b]theme/[/b], [b]imageset/[/b]).
[*]Upload that folder into [b]styles/[/b] on the board. The path must be [b]styles/StyleName/style.cfg[/b], not nested an extra level.
[*]Keep the folder name exactly as shipped. Do not rename IntegraStyle or Alpha unless you also edit [b]style.cfg[/b].
[/list]

FTP or the host file manager both work. The web server must be able to read the files.

[anchor=back_upload goto=style_top]Back to top[/anchor]

[anchor=acp][b]Install in the ACP[/b][/anchor]

[list=1]
[*]Log in as an administrator.
[*]Go to [b]ACP → Styles → Styles[/b].
[*]If you are installing fiproice, IM_prosilver, or MiMic, confirm [b]prosilver[/b] is already in the installed list. Install it first if it is not.
[*]Under uninstalled styles, find the new name and click [b]Install style[/b].
[*]Confirm. If the style needs a parent template, theme, or imageset that is not installed yet, the ACP will say so. Install those first.
[/list]

Installed styles appear in the list with a user count. The current default has an asterisk (*).

[anchor=back_acp goto=style_top]Back to top[/anchor]

[anchor=default][b]Make it the board default[/b][/anchor]

On the same page, set the style as the board default if everyone should get it. You can leave it installed but not default if users may choose it themselves.

Deactivate a style instead of deleting it when you only want it hidden from the user list. Do not uninstall prosilver while fiproice, IM_prosilver, or MiMic are still in use.

[anchor=back_default goto=style_top]Back to top[/anchor]

[anchor=users][b]Users still on the old style[/b][/anchor]

A user’s stored style is not always changed when you switch the board default. If override user style is off, they keep their old choice until they pick the new one in the User Control Panel.

To force the new look: ACP → [b]Board settings[/b] (or User settings) and enable override user style, or edit users in [b]Users and Groups[/b].

[anchor=back_users goto=style_top]Back to top[/anchor]

[anchor=notes][b]Inheritance and cache[/b][/anchor]

[list]
[*]Styles that inherit from prosilver only need the files they override. Missing templates fall back to the parent.
[*]After installing or editing templates, purge the board cache: ACP → [b]General[/b] → [b]Purge cache[/b]. Also delete [b]cache/[/b] files if a change does not show.
[*]Do not mix files from two styles in one folder. Upload a complete style package.
[*]Alpha is the same modern IntegraStyle codebase in a retro forum look, not an older predecessor.
[/list]

[anchor=back_notes goto=style_top]Back to top[/anchor]',

// ===== END ARTICLE: STYLE_INSTALL =====


// ===== START ARTICLE: IM_INSTALL =====
	'IM_INSTALL'			=> 'Install IntegraMOD 3',
	'IM_INSTALL_DESC'		=> 'Upload the package, pick a cache, run the installer, then lock down the board.',
	'IM_INSTALL_ARTICLE'	=> '[anchor=im_top][/anchor][b]Install IntegraMOD 3[/b]

IntegraMOD 3 is a full forum package. You upload the files, run the installer once, then remove the leftover folders that should not stay on a live site. You need a web host with PHP and a database. If you do not know the database details, ask the host before you start.

[b]Jump to[/b]
[list]
[*][anchor=toc_need goto=need]What you need[/anchor]
[*][anchor=toc_files goto=files]Put the files on the server[/anchor]
[*][anchor=toc_perm goto=perm]Folder permissions[/anchor]
[*][anchor=toc_cache goto=cache]Cache choices[/anchor]
[*][anchor=toc_run goto=run]Run the installer[/anchor]
[*][anchor=toc_after goto=after]After it finishes — delete these folders[/anchor]
[*][anchor=toc_config goto=config]Lock down config.php[/anchor]
[*][anchor=toc_stuck goto=stuck]If something fails[/anchor]
[/list]

[anchor=need][b]What you need[/b][/anchor]

[list]
[*]PHP 7.4 or newer (through PHP 8.5)
[*]A database: MySQL / MariaDB is the usual choice. PostgreSQL, SQLite, Firebird, MS SQL, and Oracle also work if the host offers them
[*]FTP or a file manager to upload files
[*]The database name, user, password, and server hostname from the host
[/list]

[anchor=back_need goto=im_top]Back to top[/anchor]

[anchor=files][b]Put the files on the server[/b][/anchor]

[list=1]
[*]Unzip the IntegraMOD package on your computer.
[*]Upload [b]everything[/b] in it to a web folder, keeping the same folders and names. Do not force names to lower case.
[*]A typical path is [b]https://example.com/forum/[/b] or the site root.
[/list]

If you have SSH, you can upload the zip and unzip it on the server instead of sending thousands of files by FTP.

[anchor=back_files goto=im_top]Back to top[/anchor]

[anchor=perm][b]Folder permissions[/b][/anchor]

The installer must be able to write a few paths:

[list]
[*][b]config.php[/b] — writable only while you install (often 666). Change it afterward; see [anchor=toc_config_jump goto=config]Lock down config.php[/anchor]
[*][b]store/[/b], [b]cache/[/b], [b]files/[/b], [b]images/avatars/upload/[/b] — writable (often 777 on shared hosting)
[/list]

Your FTP program or the host file manager can set those.

[anchor=back_perm goto=im_top]Back to top[/anchor]

[anchor=cache][b]Cache choices[/b][/anchor]

The installer asks where the board should store cached data. Pick what the host actually has.

[list]
[*][b]File (default)[/b] — writes cache files under [b]store/[/b]. Simple and reliable. Use this on most shared hosting.
[*][b]Memcache[/b] or [b]Memcached[/b] — fast memory cache. Needs the PHP extension and a memcached server.
[*][b]Redis[/b] — fast memory store with extra features. Needs the Redis extension and a Redis server.
[*][b]APC / APCu[/b] — memory cache inside PHP on one server.
[*][b]WinCache[/b] — Windows hosts only.
[*][b]XCache[/b] / [b]eAccelerator[/b] — older opcode caches; only if the host still has them.
[*][b]Memory (process only)[/b] — fast, but each PHP process has its own cache. Not shared.
[*][b]No cache[/b] — for debugging only. Do not use this on a live board.
[/list]

If you are not sure, leave [b]File[/b]. You can change it later in the ACP if the host adds Memcached or Redis.

[anchor=back_cache goto=im_top]Back to top[/anchor]

[anchor=run][b]Run the installer[/b][/anchor]

Open [b]https://your-site/forum/install/[/b] (add [b]install/[/b] to wherever you uploaded the files).

[list=1]
[*]Read the intro, then open the [b]INSTALL[/b] tab.
[*]The requirements page checks PHP and the folders. Fix anything marked required before you continue.
[*]Enter the database type, hostname, name, user, and password. Leave the port blank unless the host gave you one. Keep the table prefix unless you already have another board in the same database.
[*]Choose the cache type (see above).
[*]Create the first administrator account (your login).
[*]Let it write [b]config.php[/b]. If it cannot write the file, it will show the contents for you to paste in by hand.
[/list]

When it says congratulations, the board is installed.

[anchor=back_run goto=im_top]Back to top[/anchor]

[anchor=after][b]After it finishes — delete these folders[/b][/anchor]

These paths do not belong on a public site. Delete them from the web root (or move them off the server). Leaving them is a security hole.

[list]
[*][b]install/[/b] — [b]must[/b] go. While it exists, only the Administration Control Panel works, and anyone who can open it can wreck the board.
[*][b]develop/[/b] — [b]delete this especially.[/b] Development tools and test code. Never leave it on a live forum.
[*][b]stk/[/b] — Support Toolkit. Useful while you repair a broken board; dangerous if strangers can open it. Remove it when you are done.
[*][b]docs/[/b] — install notes. Safe to delete after you have read them.
[/list]

Optional: convert an old phpBB 2 board from the convertor link on the success page [i]before[/i] you delete [b]install/[/b].

Then log in with the admin account you created.

[anchor=back_after goto=im_top]Back to top[/anchor]

[anchor=config][b]Lock down config.php[/b][/anchor]

[b]config.php[/b] holds the database password. During install it is often set to [b]666[/b] (world writable) so the installer can write it. That must not stay.

After install:

[list]
[*]Set [b]config.php[/b] to [b]644[/b] (or [b]640[/b] if the host allows it). The web server still needs to [i]read[/i] it.
[*]Do [b]not[/b] leave it at [b]666[/b]. Anyone who can write that file owns the database.
[/list]

[anchor=back_config goto=im_top]Back to top[/anchor]

[anchor=stuck][b]If something fails[/b][/anchor]

[list]
[*][b]Could not connect to the database[/b] — hostname, name, user, or password is wrong. Ask the host.
[*]A folder is not writable — set permissions again, then click Test again on the requirements page.
[*]Blank page after install — [b]install/[/b] is still there, or [b]cache/[/b] is not writable.
[*]PHP version too old — the host must be on PHP 7.4 or newer.
[/list]

More detail is in [b]docs/INSTALL.html[/b] inside the package (read it before you delete [b]docs/[/b]).

[anchor=back_stuck goto=im_top]Back to top[/anchor]',
));

// ===== END ARTICLE: IM_INSTALL =====
