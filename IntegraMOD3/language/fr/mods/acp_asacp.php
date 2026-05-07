<?php
/**
*
* @package Anti-Spam ACP
* @copyright (c) 2008 EXreaction
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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

$lang = array_merge($lang, array(
	'ADD_WORD'									=> 'Ajouter un mot',
	'ALLOW_FIELD'								=> 'Autoriser',
	'ASACP_AKISMET'								=> 'Akismet',
	'ASACP_AKISMET_DOMAIN'						=> 'URL de la page d\'accueil',
	'ASACP_AKISMET_DOMAIN_EXPLAIN'				=> 'La page d\'accueil ou l\'URL principale de ce site. Remarque : doit être une URI complète, incluant http://.',
	'ASACP_AKISMET_ENABLE'						=> 'Activer l\'intégration Akismet',
	'ASACP_AKISMET_INVALID_KEY'					=> 'Votre clé API Akismet semble invalide. Assurez-vous d\'utiliser la clé obtenue sur <a href="http://akismet.com/">http://akismet.com/</a> et d\'avoir renseigné une URL de page d\'accueil valide.',
	'ASACP_AKISMET_KEY'							=> 'Clé API Akismet',
	'ASACP_AKISMET_KEY_EXPLAIN'					=> 'Une clé API Akismet est requise pour utiliser le service. Vous pouvez en obtenir une sur <a href="http://akismet.com/">http://akismet.com/</a>',
	'ASACP_AKISMET_POST_LIMIT'			   		=> 'Nombre de messages',
	'ASACP_AKISMET_POST_LIMIT_EXPLAIN'			=> 'Si l\'utilisateur a un nombre de messages supérieur à la valeur saisie, la vérification Akismet ne sera pas utilisée pour cet utilisateur.<br /><strong>Si 0 est saisi, la vérification Akismet s\'exécutera toujours.</strong>',
	'ASACP_BAN_CLEAR_OUTBOX'					=> 'Vider la boîte d\'envoi des messages privés de l\'utilisateur',
	'ASACP_BAN_CLEAR_OUTBOX_EXPLAIN'			=> 'Supprime tous les messages privés de la boîte d\'envoi de l\'utilisateur',
	'ASACP_BAN_DEACTIVATE_USER'					=> 'Désactiver le compte',
	'ASACP_BAN_DEACTIVATE_USER_EXPLAIN'			=> 'Désactiver le compte de l\'utilisateur',
	'ASACP_BAN_DELETE_AVATAR'					=> 'Supprimer l\'avatar',
	'ASACP_BAN_DELETE_AVATAR_EXPLAIN'			=> 'Supprimer l\'avatar de l\'utilisateur lorsqu\'une action de bannissement en un clic est effectuée',
	'ASACP_BAN_DELETE_BLOG'						=> 'Supprimer le blog',
	'ASACP_BAN_DELETE_BLOG_EXPLAIN'				=> 'Supprimer les entrées du blog de l\'utilisateur (depuis le User Blog Mod)',
	'ASACP_BAN_DELETE_POSTS'					=> 'Supprimer les messages',
	'ASACP_BAN_DELETE_POSTS_EXPLAIN'			=> 'Supprimer les messages de l\'utilisateur lorsqu\'une action de bannissement en un clic est effectuée',
	'ASACP_BAN_DELETE_PROFILE_FIELDS'			=> 'Supprimer les champs de profil',
	'ASACP_BAN_DELETE_PROFILE_FIELDS_EXPLAIN'	=> 'Supprimer les informations de profil de l\'utilisateur lorsqu\'une action de bannissement en un clic est effectuée',
	'ASACP_BAN_DELETE_SIGNATURE'				=> 'Supprimer la signature',
	'ASACP_BAN_DELETE_SIGNATURE_EXPLAIN'		=> 'Supprimer la signature de l\'utilisateur lorsqu\'une action de bannissement en un clic est effectuée',
	'ASACP_BAN_MOVE_TO_GROUP'					=> 'Déplacer vers un groupe',
	'ASACP_BAN_MOVE_TO_GROUP_EXPLAIN'			=> 'Déplacer l\'utilisateur dans le groupe suivant lorsqu\'une action de bannissement en un clic est effectuée',
	'ASACP_BAN_SETTINGS'						=> 'Paramètres de bannissement en un clic',
	'ASACP_BAN_USERNAME'						=> 'Bannir le nom d\'utilisateur',
	'ASACP_BAN_USERNAME_EXPLAIN'				=> 'Bannir le nom d\'utilisateur lorsqu\'une action de bannissement en un clic est effectuée',
	'ASACP_ENABLE'								=> 'Activer Anti-Spam ACP',
	'ASACP_ENABLE_EXPLAIN'						=> 'Mettre sur non pour désactiver le système Anti-Spam ACP (cela ne désactivera pas certaines fonctionnalités comme le bannissement en un clic).',
	'ASACP_FLAG_LIST_EXPLAIN'					=> 'Une liste de tous les utilisateurs actuellement signalés.',
	'ASACP_IP_SEARCH_BOT_CHECK'					=> 'Vérification Bot',
	'ASACP_IP_SEARCH_EXPLAIN'					=> 'Rechercher dans l\'ensemble du forum les actions effectuées depuis une certaine adresse IP.',
	'ASACP_IP_SEARCH_FLAG_LOG'					=> 'Journal des signalements',
	'ASACP_IP_SEARCH_LOGS'						=> 'Journal des actions',
	'ASACP_IP_SEARCH_POLL_VOTES'				=> 'Votes de sondage',
	'ASACP_IP_SEARCH_POSTS'						=> 'Messages',
	'ASACP_IP_SEARCH_PRIVMSGS'					=> 'Messages privés',
	'ASACP_IP_SEARCH_SPAM_LOG'					=> 'Journal du spam',
	'ASACP_IP_SEARCH_USERS'						=> 'Utilisateurs',
	'ASACP_LOG'									=> 'Activer le journal du spam',
	'ASACP_LOG_EXPLAIN'							=> 'Si désactivé, les nouveaux éléments ne seront pas ajoutés au journal du spam.',
	'ASACP_NOTIFY_NEW_FLAG'						=> 'Notifier lors d\'une nouvelle entrée dans le journal des signalements',
	'ASACP_NOTIFY_NEW_FLAG_EXPLAIN'				=> 'Notifier les utilisateurs autorisés lorsqu\'un nouvel élément est ajouté au journal des signalements.',
	'ASACP_PROFILE_DURING_REG'					=> 'Afficher les champs de profil autorisés lors de l\'inscription',
	'ASACP_PROFILE_DURING_REG_EXPLAIN'			=> 'Si activé, tous les champs marqués comme autorisés dans les paramètres des champs de profil seront affichés lors de l\'inscription (à l\'exception du champ Signature).',
	'ASACP_PROFILE_FIELDS'						=> 'Champs de profil',
	'ASACP_PROFILE_FIELDS_EXPLAIN'				=> 'Permet de définir des limites sur le moment où les champs de profil peuvent être remplis par les utilisateurs.<br /><br /><strong>Après soumission, tous les champs seront resynchronisés pour tous les utilisateurs afin de supprimer tout champ qu\'ils ne sont pas autorisés à renseigner selon les nouvelles règles.</strong>',
	'ASACP_REGISTER_SETTINGS'					=> 'Paramètres d\'inscription',
	'ASACP_REG_CAPTCHA'							=> 'Captcha pré-inscription',
	'ASACP_REG_CAPTCHA_EXPLAIN'					=> 'Contrôle l\'affichage du captcha initial affiché avant le début du processus d\'inscription.<br />S\'il est activé, pensez à désactiver "Enable visual confirmation for registrations" dans Général->Configuration du forum->Paramètres d\'inscription des utilisateurs afin que l\'utilisateur n\'ait pas à remplir deux captchas pour s\'inscrire.',
	'ASACP_SETTINGS_UPDATED'					=> 'Les paramètres Anti-Spam ACP ont été mis à jour avec succès.',
	'ASACP_SFS_ACTION'							=> 'Action Stop Forum Spam',
	'ASACP_SFS_ACTION_EXPLAIN'					=> 'L\'action à effectuer lorsqu\'un compte est enregistré et que les informations de profil correspondent à des informations stockées sur <a href="http://www.stopforumspam.com/">Stop Forum Spam</a>',
	'ASACP_SFS_KEY'								=> 'Clé Stop Forum Spam',
	'ASACP_SFS_KEY_EXPLAIN'						=> 'Si vous souhaitez soumettre des informations à <a href="http://www.stopforumspam.com/">Stop Forum Spam</a>, inscrivez-vous pour obtenir une clé API <a href="http://www.stopforumspam.com/signup">ici</a> et saisissez-la dans ce champ.',
	'ASACP_SFS_MIN_FREQ'						=> 'Fréquence minimale',
	'ASACP_SFS_MIN_FREQ_EXPLAIN'				=> 'Fréquence minimale (nombre de fois où le compte a été signalé par d\'autres) avant d\'effectuer toute action pour le compte basée sur les informations retournées par <a href="http://www.stopforumspam.com/">Stop Forum Spam</a>',
	'ASACP_SFS_SETTINGS'						=> 'Paramètres Stop Forum Spam',
	'ASACP_SPAM_WORDS_ENABLE'					=> 'Activer les mots de spam',
	'ASACP_SPAM_WORDS_ENABLE_EXPLAIN'			=> 'Mettre sur non pour désactiver l\'ensemble du système de mots de spam.',
	'ASACP_SPAM_WORDS_EXPLAIN'					=> 'Saisir et gérer les mots déclencheurs pour le système de mots de spam.',
	'ASACP_SPAM_WORDS_FLAG_LIMIT'				=> 'Nombre de mots de spam avant marquage comme spam',
	'ASACP_SPAM_WORDS_FLAG_LIMIT_EXPLAIN'		=> 'Si les messages sont marqués comme spam ce nombre de fois ou plus, le message sera soit refusé soit soumis à approbation.',
	'ASACP_SPAM_WORDS_PM_ACTION'				=> 'Action pour les messages privés identifiés comme spam',
	'ASACP_SPAM_WORDS_PM_ACTION_EXPLAIN'		=> 'Sélectionnez l\'action à effectuer lorsqu\'un message privé est signalé comme spam.',
	'ASACP_SPAM_WORDS_POSTING_ACTION'			=> 'Action pour les messages identifiés comme spam',
	'ASACP_SPAM_WORDS_POSTING_ACTION_EXPLAIN'	=> 'Sélectionnez l\'action à effectuer lorsqu\'un message est signalé comme spam.',
	'ASACP_SPAM_WORDS_POST_LIMIT'				=> 'Nombre de messages',
	'ASACP_SPAM_WORDS_POST_LIMIT_EXPLAIN'		=> 'Si l\'utilisateur a un nombre de messages supérieur à la valeur saisie, la vérification des mots de spam ne sera pas utilisée pour cet utilisateur.<br /><strong>Si 0 est saisi, la vérification des mots de spam s\'exécutera toujours.</strong>',
	'ASACP_SPAM_WORDS_PROFILE_ACTION'			=> 'Action pour les informations de profil identifiées comme spam',
	'ASACP_SPAM_WORDS_PROFILE_ACTION_EXPLAIN'	=> 'Sélectionnez l\'action à effectuer lorsqu\'une information saisie dans le profil d\'un utilisateur est signalée comme spam.',
	'ASACP_USER_FLAG_ENABLE'					=> 'Activer le système de signalement d\'utilisateurs',
	'ASACP_USER_FLAG_ENABLE_EXPLAIN'			=> 'Si non est sélectionné, les utilisateurs ne pourront pas être signalés et les utilisateurs précédemment signalés n\'auront plus d\'éléments enregistrés dans le journal des signalements lorsqu\'ils effectueront une action.',
	'ASACP_VERSION'								=> 'Informations sur la version',

	'CLICK_CHECK_NEW_VERSION'					=> 'Cliquez %sici%s pour vérifier s\'il existe une nouvelle version.',
	'CLICK_GET_NEW_VERSION'						=> 'Cliquez %sici%s pour obtenir la nouvelle version.',

	'DELETE_SPAM_WORD'							=> 'Supprimer le mot de spam',
	'DELETE_SPAM_WORD_CONFIRM'					=> 'Êtes-vous sûr de vouloir supprimer ce mot de spam ?',
	'DENY_FIELD'								=> 'Refuser',
	'DENY_SUBMISSION'							=> 'Refuser la soumission',

	'FLAG_USER'									=> 'Signaler l\'utilisateur',

	'INSTALLED_VERSION'							=> 'Version installée',
	'INTERESTS_POST_COUNT'						=> 'Nombre de messages pour Centres d\'intérêt',
	'INTERESTS_POST_COUNT_EXPLAIN'				=> 'Si Centres d\'intérêt est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',

	'LOCATION_POST_COUNT'						=> 'Nombre de messages pour Localisation',
	'LOCATION_POST_COUNT_EXPLAIN'				=> 'Si Localisation est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'LOG_VIEW_POST'								=> '%sVoir le message%s',
	'LOG_VIEW_PROFILE'							=> '%sVoir le profil%s',

	'NOTHING'									=> 'Rien',
	'NOT_AVAILABLE'								=> 'Non disponible',
	'NO_ITEMS'									=> 'Aucun résultat pour l\'adresse IP donnée.',
	'NO_SPAM_WORD'								=> 'Le mot sélectionné n\'existe pas.',
	'NO_SPAM_WORDS'								=> 'Aucun mot de spam dans la base de données.',

	'OCCUPATION_POST_COUNT'						=> 'Nombre de messages pour Profession',
	'OCCUPATION_POST_COUNT_EXPLAIN'				=> 'Si Profession est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',

	'POST_COUNT'								=> 'Nombre de messages',

	'REGEX'										=> 'Expression régulière',
	'REGEX_AUTO'								=> 'Expression régulière automatique',
	'REGEX_AUTO_EXPLAIN'						=> 'Sélectionnez Oui pour que le système crée automatiquement une expression régulière à partir du texte du mot de spam fourni.',
	'REGEX_EXPLAIN'								=> 'Sélectionnez Oui pour utiliser une expression régulière basée sur le texte du mot de spam fourni.',
	'REQUIRE_ADMIN_ACTIVATION'					=> 'Exiger l\'activation par l\'administrateur',
	'REQUIRE_APPROVAL'							=> 'Exiger l\'approbation d\'un modérateur',
	'REQUIRE_FIELD'								=> 'Exiger',
	'REQUIRE_USER_ACTIVATION'					=> 'Exiger l\'activation par l\'utilisateur',

	'SIGNATURE_POST_COUNT'						=> 'Nombre de messages pour la signature',
	'SIGNATURE_POST_COUNT_EXPLAIN'				=> 'Si Signature est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.<br /><br />Les paramètres requis pour la signature ne sont pas les mêmes que pour les autres champs. Les signatures ne peuvent pas être exigées lors de l\'inscription.',
	'SPAM_WORD_ADD_SUCCESS'						=> 'Mot de spam ajouté avec succès.',
	'SPAM_WORD_DELETE_SUCCESS'					=> 'Mot de spam supprimé avec succès.',
	'SPAM_WORD_EDIT_SUCCESS'					=> 'Mot de spam modifié avec succès.',
	'SPAM_WORD_TEXT'							=> 'Texte du mot de spam',
	'SPAM_WORD_TEXT_EXPLAIN'					=> 'Si vous utilisez une expression régulière, assurez-vous de la formater correctement pour <a href="http://us2.php.net/manual/en/function.preg-match.php">preg_match</a> (y compris le délimiteur de motif)',

	'UCP_FB_POST_COUNT'							=> 'Nombre de messages pour contact Facebook',
	'UCP_FB_POST_COUNT_EXPLAIN'					=> 'Si le contact Facebook est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_IG_POST_COUNT'							=> 'Nombre de messages pour contact Instagram',
	'UCP_IG_POST_COUNT_EXPLAIN'					=> 'Si le contact Instagram est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_PT_POST_COUNT'							=> 'Nombre de messages pour contact Pinterest',
	'UCP_PT_POST_COUNT_EXPLAIN'					=> 'Si le contact Pinterest est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_TWR_POST_COUNT'						=> 'Nombre de messages pour contact Twitter',
	'UCP_TWR_POST_COUNT_EXPLAIN'				=> 'Si le contact Twitter est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_SKP_POST_COUNT'						=> 'Nombre de messages pour contact Skype',
	'UCP_SKP_POST_COUNT_EXPLAIN'				=> 'Si le contact Skype est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_TG_POST_COUNT'							=> 'Nombre de messages pour contact Telegram',
	'UCP_TG_POST_COUNT_EXPLAIN'					=> 'Si le contact Telegram est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_LI_POST_COUNT'							=> 'Nombre de messages pour contact LinkedIn',
	'UCP_LI_POST_COUNT_EXPLAIN'					=> 'Si le contact LinkedIn est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_TT_POST_COUNT'							=> 'Nombre de messages pour contact TikTok',
	'UCP_TT_POST_COUNT_EXPLAIN'					=> 'Si le contact TikTok est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_DC_POST_COUNT'							=> 'Nombre de messages pour contact Discord',
	'UCP_DC_POST_COUNT_EXPLAIN'					=> 'Si le contact Discord est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	
	'UCP_AIM_POST_COUNT'						=> 'Nombre de messages pour AOL Instant Messenger',
	'UCP_AIM_POST_COUNT_EXPLAIN'				=> 'Si AOL Instant Messenger est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_ICQ_POST_COUNT'						=> 'Nombre de messages pour numéro ICQ',
	'UCP_ICQ_POST_COUNT_EXPLAIN'				=> 'Si le numéro ICQ est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_JABBER_POST_COUNT'						=> 'Nombre de messages pour adresse Jabber',
	'UCP_JABBER_POST_COUNT_EXPLAIN'				=> 'Si l\'adresse Jabber est réglée sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_MSNM_POST_COUNT'						=> 'Nombre de messages pour MSN Messenger',
	'UCP_MSNM_POST_COUNT_EXPLAIN'				=> 'Si MSN Messenger est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
	'UCP_YIM_POST_COUNT'						=> 'Nombre de messages pour Yahoo Messenger',
	'UCP_YIM_POST_COUNT_EXPLAIN'				=> 'Si Yahoo Messenger est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',

	'VERSION'									=> 'Version',

	'WEBSITE_POST_COUNT'						=> 'Nombre de messages pour le site Web',
	'WEBSITE_POST_COUNT_EXPLAIN'				=> 'Si Site Web est réglé sur Nombre de messages, l\'utilisateur pourra remplir ce champ après avoir atteint ce nombre de messages.',
));