<?php
/**
 *
 * install [French]
 *
 * @package language
 * @version $Id$
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
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
    'ADMIN_CONFIG' => 'Configuration de l’administrateur',
    'ADMIN_PASSWORD' => 'Mot de passe administrateur',
    'ADMIN_PASSWORD_CONFIRM' => 'Confirmer le mot de passe administrateur',
    'ADMIN_PASSWORD_EXPLAIN' => 'Veuillez entrer un mot de passe contenant entre 6 et 30 caractères.',
    'ADMIN_TEST' => 'Vérifier les paramètres administrateur',
    'ADMIN_USERNAME' => 'Nom d’utilisateur administrateur',
    'ADMIN_USERNAME_EXPLAIN' => 'Veuillez entrer un nom d’utilisateur contenant entre 3 et 20 caractères.',
    'APP_MAGICK' => 'Support Imagemagick [ Pièces jointes ]',
    'AUTHOR_NOTES' => 'Remarques de l’auteur<br />» %s',
    'AVAILABLE' => 'Disponible',
    'AVAILABLE_CONVERTORS' => 'Convertisseurs disponibles',

    'BEGIN_CONVERT' => 'Commencer la conversion',
    'BLANK_PREFIX_FOUND' => 'Une analyse de vos tables a montré une installation valide n’utilisant aucun préfixe de table.',
    'BOARD_NOT_INSTALLED' => 'Aucune installation trouvée',
    'BOARD_NOT_INSTALLED_EXPLAIN' => 'Le framework de conversion unifié phpBB requiert une installation par défaut de phpBB3 pour fonctionner, veuillez <a href="%s">procéder d’abord à l’installation de phpBB3</a>.',
    'BACKUP_NOTICE' => 'Veuillez sauvegarder votre forum avant la mise à jour au cas où des problèmes surviendraient pendant le processus.',

    'CATEGORY' => 'Catégorie',
    'CACHE_STORE' => 'Type de cache',
    'CACHE_STORE_EXPLAIN' => 'L’emplacement physique où les données sont mises en cache, le système de fichiers est recommandé.',
    'CAT_CONVERT' => 'Convertir',
    'CAT_INSTALL' => 'Installer',
    'CAT_OVERVIEW' => 'Aperçu',
    'CAT_UPDATE' => 'Mettre à jour',
    'CHANGE' => 'Modifier',
    'CHECK_TABLE_PREFIX' => 'Veuillez vérifier le préfixe des tables et réessayer.',
    'CLEAN_VERIFY' => 'Nettoyage et vérification de la structure finale',
    'CLEANING_USERNAMES' => 'Nettoyage des noms d’utilisateur',
    'COLLIDING_CLEAN_USERNAME' => '<strong>%s</strong> est le nom d’utilisateur nettoyé pour:',
    'COLLIDING_USERNAMES_FOUND' => 'Des noms d’utilisateur en collision ont été trouvés sur votre ancien forum. Pour compléter la conversion, veuillez supprimer ou renommer ces utilisateurs afin qu’il n’y ait qu’un seul utilisateur sur votre ancien forum pour chaque nom d’utilisateur nettoyé.',
    'COLLIDING_USER' => '» id utilisateur: <strong>%d</strong> nom d’utilisateur: <strong>%s</strong> (%d messages)',
    'CONFIG_CONVERT' => 'Conversion de la configuration',
    'CONFIG_FILE_UNABLE_WRITE' => 'Il n’a pas été possible d’écrire le fichier de configuration. Des méthodes alternatives pour créer ce fichier sont présentées ci-dessous.',
    'CONFIG_FILE_WRITTEN' => 'Le fichier de configuration a été écrit. Vous pouvez maintenant passer à l’étape suivante de l’installation.',
    'CONFIG_PHPBB_EMPTY' => 'La variable de configuration phpBB3 pour « %s » est vide.',
    'CONFIG_RETRY' => 'Réessayer',
    'CONTACT_EMAIL_CONFIRM' => 'Confirmer l’e-mail de contact',
    'CONTINUE_CONVERT' => 'Continuer la conversion',
    'CONTINUE_CONVERT_BODY' => 'Une tentative de conversion précédente a été détectée. Vous pouvez maintenant choisir entre démarrer une nouvelle conversion ou continuer la conversion.',
    'CONTINUE_LAST' => 'Continuer les dernières instructions',
    'CONTINUE_OLD_CONVERSION' => 'Continuer la conversion commencée précédemment',
    'CONVERT' => 'Convertir',
    'CONVERT_COMPLETE' => 'Conversion terminée',
    'CONVERT_COMPLETE_EXPLAIN' => 'Vous avez maintenant réussi à convertir votre forum vers phpBB 3.0. Vous pouvez maintenant vous connecter et <a href="../">accéder à votre forum</a>. Veuillez vous assurer que les paramètres ont été transférés correctement avant d’activer votre forum en supprimant le répertoire d’installation. N’oubliez pas que de l’aide sur l’utilisation de phpBB est disponible en ligne via la <a href="https://www.phpbb.com/support/documentation/3.0/">Documentation</a> et les <a href="https://www.phpbb.com/community/viewforum.php?f=46">forums de support</a>.',
    'CONVERT_INTRO' => 'Bienvenue dans le cadre de conversion unifié phpBB',
    'CONVERT_INTRO_BODY' => 'Depuis ici, vous pouvez importer des données à partir d’autres systèmes de forum (installés). La liste ci‑dessous montre tous les modules de conversion actuellement disponibles. Si aucun convertisseur n’apparaît pour le logiciel source que vous souhaitez convertir, consultez notre site web où d’autres modules peuvent être disponibles en téléchargement.',
    'CONVERT_NEW_CONVERSION' => 'Nouvelle conversion',
    'CONVERT_NOT_EXIST' => 'Le convertisseur spécifié n’existe pas.',
    'CONVERT_OPTIONS' => 'Options',
    'CONVERT_SETTINGS_VERIFIED' => 'Les informations que vous avez saisies ont été vérifiées. Pour démarrer la conversion, appuyez sur le bouton ci‑dessous.',
    'CONV_ERR_FATAL' => 'Erreur fatale de conversion',

    'CONV_ERROR_ATTACH_FTP_DIR' => 'Le téléversement FTP pour les pièces jointes est activé sur l’ancien forum. Veuillez désactiver l’option FTP et vous assurer qu’un répertoire de téléversement valide est spécifié, puis copiez tous les fichiers de pièces jointes dans ce nouveau répertoire accessible via le web. Une fois fait, redémarrez le convertisseur.',
    'CONV_ERROR_CONFIG_EMPTY' => 'Aucune information de configuration disponible pour la conversion.',
    'CONV_ERROR_FORUM_ACCESS' => 'Impossible d’obtenir les informations d’accès aux forums.',
    'CONV_ERROR_GET_CATEGORIES' => 'Impossible d’obtenir les catégories.',
    'CONV_ERROR_GET_CONFIG' => 'Impossible de récupérer la configuration de votre forum.',
    'CONV_ERROR_COULD_NOT_READ' => 'Impossible d’accéder/lecture de « %s ».',
    'CONV_ERROR_GROUP_ACCESS' => 'Impossible d’obtenir les informations d’authentification des groupes.',
    'CONV_ERROR_INCONSISTENT_GROUPS' => 'Incohérence détectée dans la table des groupes dans add_bots() - vous devez ajouter tous les groupes spéciaux si vous le faites manuellement.',
    'CONV_ERROR_INSERT_BOT' => 'Impossible d’insérer le robot dans la table users.',
    'CONV_ERROR_INSERT_BOTGROUP' => 'Impossible d’insérer le robot dans la table bots.',
    'CONV_ERROR_INSERT_USER_GROUP' => 'Impossible d’insérer l’utilisateur dans la table user_group.',
    'CONV_ERROR_MESSAGE_PARSER' => 'Erreur du parseur de message',
    'CONV_ERROR_NO_AVATAR_PATH' => 'Note pour le développeur : vous devez spécifier $convertor[\'avatar_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_FORUM_PATH' => 'Le chemin relatif vers le forum source n’a pas été spécifié.',
    'CONV_ERROR_NO_GALLERY_PATH' => 'Note pour le développeur : vous devez spécifier $convertor[\'avatar_gallery_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_GROUP' => 'Le groupe « %1$s » n’a pas pu être trouvé dans %2$s.',
    'CONV_ERROR_NO_RANKS_PATH' => 'Note pour le développeur : vous devez spécifier $convertor[\'ranks_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_SMILIES_PATH' => 'Note pour le développeur : vous devez spécifier $convertor[\'smilies_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_UPLOAD_DIR' => 'Note pour le développeur : vous devez spécifier $convertor[\'upload_path\'] pour utiliser %s.',
    'CONV_ERROR_PERM_SETTING' => 'Impossible d’insérer/metre à jour le paramètre de permission.',
    'CONV_ERROR_PM_COUNT' => 'Impossible de sélectionner le nombre de dossiers de messages privés.',
    'CONV_ERROR_REPLACE_CATEGORY' => 'Impossible d’insérer un nouveau forum en remplaçant une ancienne catégorie.',
    'CONV_ERROR_REPLACE_FORUM' => 'Impossible d’insérer un nouveau forum en remplaçant un ancien forum.',
    'CONV_ERROR_USER_ACCESS' => 'Impossible d’obtenir les informations d’authentification des utilisateurs.',
    'CONV_ERROR_WRONG_GROUP' => 'Mauvais groupe « %1$s » défini dans %2$s.',
    'CONV_OPTIONS_BODY' => 'Cette page recueille les données nécessaires pour accéder au forum source. Entrez les détails de la base de données de votre ancien forum ; le convertisseur ne changera rien dans la base de données indiquée ci‑dessous. Le forum source devrait être désactivé pour permettre une conversion cohérente.',
    'CONV_SAVED_MESSAGES' => 'Messages enregistrés',

    'COULD_NOT_COPY' => 'Impossible de copier le fichier <strong>%1$s</strong> vers <strong>%2$s</strong><br /><br />Veuillez vérifier que le répertoire cible existe et est accessible en écriture par le serveur web.',
    'COULD_NOT_FIND_PATH' => 'Impossible de trouver le chemin vers votre ancien forum. Veuillez vérifier vos paramètres et réessayer.<br />» %s a été spécifié comme chemin source.',

    'DBMS' => 'Type de base de données',
    'DB_CONFIG' => 'Configuration de la base de données',
    'DB_CONNECTION' => 'Connexion à la base de données',
    'DB_ERR_INSERT' => 'Erreur lors du traitement de la requête <code>INSERT</code>.',
    'DB_ERR_LAST' => 'Erreur lors du traitement de <var>query_last</var>.',
    'DB_ERR_QUERY_FIRST' => 'Erreur lors de l’exécution de <var>query_first</var>.',
    'DB_ERR_QUERY_FIRST_TABLE' => 'Erreur lors de l’exécution de <var>query_first</var>, %s (« %s »).',
    'DB_ERR_SELECT' => 'Erreur lors de l’exécution d’une requête <code>SELECT</code>.',
    'DB_HOST' => 'Nom d’hôte du serveur de base de données ou DSN',
    'DB_HOST_EXPLAIN' => 'DSN signifie Data Source Name et est pertinent uniquement pour les installations ODBC. Sur PostgreSQL, utilisez localhost pour vous connecter au serveur local via socket UNIX et 127.0.0.1 pour vous connecter via TCP. Pour SQLite, saisissez le chemin complet vers votre fichier de base de données.',
    'DB_NAME' => 'Nom de la base de données',
    'DB_PASSWORD' => 'Mot de passe de la base de données',
    'DB_PORT' => 'Port du serveur de base de données',
    'DB_PORT_EXPLAIN' => 'Laissez vide sauf si vous savez que le serveur fonctionne sur un port non standard.',
    'DB_UPDATE_NOT_SUPPORTED' => 'Nous sommes désolés, mais ce script ne prend pas en charge la mise à jour depuis des versions de phpBB antérieures à « %1$s ». La version actuellement installée est « %2$s ». Veuillez mettre à jour vers une version antérieure avant d’exécuter ce script. Une assistance est disponible sur le forum de support phpBB.com.',
    'DB_USERNAME' => 'Nom d’utilisateur de la base de données',
    'DB_TEST' => 'Tester la connexion',
    'DEFAULT_LANG' => 'Langue par défaut du forum',
    'DEFAULT_PREFIX_IS' => 'Le convertisseur n’a pas pu trouver de tables avec le préfixe spécifié. Veuillez vous assurer d’avoir saisi les détails corrects pour le forum que vous convertissez. Le préfixe de table par défaut pour %1$s est <strong>%2$s</strong>.',
    'DEV_NO_TEST_FILE' => 'Aucune valeur n’a été spécifiée pour la variable test_file dans le convertisseur. Si vous êtes un utilisateur de ce convertisseur, vous ne devriez pas voir cette erreur, veuillez signaler ce message à l’auteur du convertisseur. Si vous êtes un auteur de convertisseur, vous devez spécifier le nom d’un fichier qui existe dans le forum source pour permettre la vérification du chemin.',
    'DIRECTORIES_AND_FILES' => 'Configuration des répertoires et fichiers',
    'DISABLE_KEYS' => 'Désactivation des clés',
    'DLL_FIREBIRD' => 'Firebird',
    'DLL_FTP' => 'Support FTP distant [ Installation ]',
    'DLL_GD' => 'Support GD pour les images [ Vérification visuelle ]',
    'DLL_MBSTRING' => 'Support multioctet (mbstring)',
    'DLL_MSSQL' => 'MSSQL Server 2000+',
    'DLL_MSSQL_ODBC' => 'MSSQL Server 2000+ via ODBC',
    'DLL_MSSQLNATIVE' => 'MSSQL Server 2005+ [ Native ]',
    'DLL_MYSQL' => 'MySQL',
    'DLL_MYSQLI' => 'MySQL avec extension MySQLi',
    'DLL_ORACLE' => 'Oracle',
    'DLL_POSTGRES' => 'PostgreSQL',
    'DLL_SQLITE' => 'SQLite',
    'DLL_XML' => 'Support XML [ Jabber ]',
    'DLL_ZLIB' => 'Support zlib [ gz, .tar.gz, .zip ]',
    'DL_CONFIG' => 'Télécharger la configuration',
    'DL_CONFIG_EXPLAIN' => 'Vous pouvez télécharger le fichier complet config.php sur votre PC. Vous devrez ensuite téléverser le fichier manuellement en remplaçant tout config.php existant dans le répertoire racine de votre phpBB 3.0. Veuillez vous rappeler de téléverser le fichier en ASCII (voir la documentation de votre client FTP si vous ne savez pas comment). Une fois que vous avez téléversé le config.php, cliquez sur « Done » pour passer à l’étape suivante.',
    'DL_DOWNLOAD' => 'Télécharger',
    'DONE' => 'Terminé',

    'ENABLE_KEYS' => 'Réactivation des clés. Cela peut prendre du temps.',

    'FILES_OPTIONAL' => 'Fichiers et répertoires optionnels',
    'FILES_OPTIONAL_EXPLAIN' => '<strong>Optionnel</strong> - Ces fichiers, répertoires ou paramètres de permission ne sont pas requis. Le système d’installation tentera d’utiliser diverses techniques pour les créer s’ils n’existent pas ou ne sont pas inscriptibles. Cependant, leur présence accélérera l’installation.',
    'FILES_REQUIRED' => 'Fichiers et répertoires',
    'FILES_REQUIRED_EXPLAIN' => '<strong>Requis</strong> - Pour fonctionner correctement, phpBB doit pouvoir accéder ou écrire certains fichiers ou répertoires. Si vous voyez « Not Found », vous devez créer le fichier ou répertoire concerné. Si vous voyez « Unwritable », vous devez modifier les permissions pour permettre à phpBB d’écrire.',
    'FILLING_TABLE' => 'Remplissage de la table <strong>%s</strong>',
    'FILLING_TABLES' => 'Remplissage des tables',

    'FIREBIRD_DBMS_UPDATE_REQUIRED' => 'phpBB ne prend plus en charge Firebird/Interbase antérieur à la version 2.1. Veuillez mettre à jour votre installation Firebird au moins en 2.1.0 avant de continuer.',

    'FINAL_STEP' => 'Dernière étape du processus',
    'FORUM_ADDRESS' => 'Adresse du forum',
    'FORUM_ADDRESS_EXPLAIN' => 'Il s’agit de l’URL de votre ancien forum, par exemple <samp>http://www.example.com/phpBB2/</samp>. Si une adresse est saisie ici et non laissée vide, chaque occurrence de cette adresse sera remplacée par l’adresse de votre nouveau forum dans les messages, messages privés et signatures.',
    'FORUM_PATH' => 'Chemin du forum',
    'FORUM_PATH_EXPLAIN' => 'Il s’agit du chemin <strong>relatif</strong> sur disque vers votre ancien forum depuis la <strong>racine de cette installation phpBB3</strong>.',
    'FOUND' => 'Trouvé',
    'FTP_CONFIG' => 'Transférer la configuration par FTP',
    'FTP_CONFIG_EXPLAIN' => 'phpBB a détecté la présence du module FTP sur ce serveur. Vous pouvez tenter d’installer votre config.php via ce module si vous le souhaitez. Vous devrez fournir les informations ci‑dessous. Rappelez‑vous que votre nom d’utilisateur et mot de passe sont ceux de votre serveur ! (demandez à votre hébergeur si vous ne savez pas ce que c’est).',
    'FTP_PATH' => 'Chemin FTP',
    'FTP_PATH_EXPLAIN' => 'Ceci est le chemin depuis votre répertoire racine jusqu’à phpBB, par ex. <samp>htdocs/phpBB3/</samp>.',
    'FTP_UPLOAD' => 'Téléverser',

    'GPL' => 'Licence Publique Générale',

    'INITIAL_CONFIG' => 'Configuration de base',
    'INITIAL_CONFIG_EXPLAIN' => 'Maintenant que l’installation a déterminé que votre serveur peut exécuter phpBB, vous devez fournir quelques informations spécifiques. Si vous ne savez pas comment vous connecter à votre base de données, contactez votre hébergeur (en premier lieu) ou consultez les forums de support phpBB. Lors de la saisie, vérifiez bien les données avant de continuer.',
    'INSTALL_CONGRATS' => 'Félicitations !',
    'INSTALL_CONGRATS_EXPLAIN' => '
		Vous avez installé IntegraMOD %1$s avec succès. Veuillez continuer en choisissant une des options suivantes :</p>
		<h2>Convertir un forum existant vers IntegraMOD3</h2>
		<p>Le framework de conversion unifié phpBB prend en charge la conversion de phpBB 2.0.x et d’autres systèmes de forum vers IntegraMOD3. Si vous avez un forum existant que vous souhaitez convertir, veuillez <a href="%2$s">procéder au convertisseur</a>.</p>
		<h2>Mettre IntegraMOD3 en production !</h2>
		<p><strong>Veuillez supprimer, déplacer ou renommer le répertoire d’installation avant d’utiliser votre forum. Tant que ce répertoire existe, seul le panneau d’administration (ACP) sera accessible.</strong>',
    'INSTALL_INTRO' => 'Bienvenue dans l’installation',

    'INSTALL_INTRO_BODY' => 'Avec cette option, il est possible d’installer IntegraMOD sur votre serveur.</p><p>Pour continuer, vous aurez besoin de vos paramètres de base de données. Si vous ne les connaissez pas, contactez votre hébergeur. Vous ne pourrez pas continuer sans eux. Vous aurez besoin de :</p>

	<ul>
		<li>Le type de base de données - la base que vous utiliserez.</li>
		<li>Le nom d’hôte du serveur de base de données ou DSN - l’adresse du serveur de base de données.</li>
		<li>Le port du serveur de base de données - le port du serveur (la plupart du temps non nécessaire).</li>
		<li>Le nom de la base de données - le nom de la base sur le serveur.</li>
		<li>Le nom d’utilisateur et le mot de passe de la base de données - les identifiants pour accéder à la base.</li>
	</ul>

	<p><strong>Note :</strong> si vous installez en utilisant SQLite, entrez le chemin complet vers votre fichier de base de données dans le champ DSN et laissez les champs nom d’utilisateur et mot de passe vides. Pour des raisons de sécurité, assurez‑vous que le fichier de base de données n’est pas stocké dans un emplacement accessible depuis le web.</p>

	<p>IntegraMOD prend en charge les bases de données suivantes :</p>
	<ul>
		<li>MySQL 3.23 ou supérieur (MySQLi pris en charge)</li>
		<li>PostgreSQL 7.3+</li>
		<li>SQLite 2.8.2+</li>
		<li>Firebird 2.1+</li>
		<li>MS SQL Server 2000 ou supérieur (directement ou via ODBC)</li>
		<li>MS SQL Server 2005 ou supérieur (natif)</li>
		<li>Oracle</li>
	</ul>

	<p>Seules les bases de données supportées sur votre serveur seront affichées.',
    'INSTALL_INTRO_NEXT' => 'Pour commencer l’installation, appuyez sur le bouton ci‑dessous.',
    'INSTALL_LOGIN' => 'Connexion',
    'INSTALL_NEXT' => 'Étape suivante',
    'INSTALL_NEXT_FAIL' => 'Certains tests ont échoué et vous devez corriger ces problèmes avant de passer à l’étape suivante. Le non‑respect peut entraîner une installation incomplète.',
    'INSTALL_NEXT_PASS' => 'Tous les tests de base ont réussi et vous pouvez passer à l’étape suivante de l’installation. Si vous avez changé des permissions, modules, etc. et souhaitez retester, vous pouvez le faire.',
    'INSTALL_PANEL' => 'Panneau d’installation',
    'INSTALL_SEND_CONFIG' => 'Malheureusement, phpBB n’a pas pu écrire directement les informations de configuration dans votre config.php. Cela peut être dû au fait que le fichier n’existe pas ou n’est pas inscriptible. Plusieurs options seront listées ci‑dessous pour compléter l’installation de config.php.',
    'INSTALL_START' => 'Démarrer l’installation',
    'INSTALL_TEST' => 'Tester à nouveau',
    'INST_ERR' => 'Erreur d’installation',
    'INST_ERR_DB_CONNECT' => 'Impossible de se connecter à la base de données, voir le message d’erreur ci‑dessous.',
    'INST_ERR_DB_FORUM_PATH' => 'Le fichier de base de données spécifié se trouve dans l’arborescence de votre forum. Vous devriez placer ce fichier dans un emplacement non accessible depuis le web.',
    'INST_ERR_DB_INVALID_PREFIX' => 'Le préfixe que vous avez saisi est invalide. Il doit commencer par une lettre et ne contenir que des lettres, chiffres et underscores.',
    'INST_ERR_DB_NO_ERROR' => 'Aucun message d’erreur fourni.',
    'INST_ERR_DB_NO_MYSQLI' => 'La version de MySQL installée sur cette machine est incompatible avec l’option « MySQL with MySQLi Extension » que vous avez sélectionnée. Essayez l’option « MySQL » à la place.',
    'INST_ERR_DB_NO_SQLITE' => 'La version de l’extension SQLite installée est trop ancienne, elle doit être mise à niveau au minimum vers 2.8.2.',
    'INST_ERR_DB_NO_ORACLE' => 'La version d’Oracle installée sur cette machine requiert que le paramètre <var>NLS_CHARACTERSET</var> soit réglé sur <var>UTF8</var>. Soit mettez à jour votre installation vers 9.2+ soit changez ce paramètre.',
    'INST_ERR_DB_NO_FIREBIRD' => 'La version de Firebird installée sur cette machine est antérieure à 2.1, veuillez mettre à jour.',
    'INST_ERR_DB_NO_FIREBIRD_PS' => 'La base sélectionnée pour Firebird a une taille de page inférieure à 8192, elle doit être d’au moins 8192.',
    'INST_ERR_DB_NO_POSTGRES' => 'La base de données sélectionnée n’a pas été créée en <var>UNICODE</var> ou <var>UTF8</var>. Essayez d’installer avec une base en <var>UNICODE</var> ou <var>UTF8</var>.',
    'INST_ERR_DB_NO_NAME' => 'Aucun nom de base de données spécifié.',
    'INST_ERR_EMAIL_INVALID' => 'L’adresse e‑mail saisie est invalide.',
    'INST_ERR_EMAIL_MISMATCH' => 'Les e‑mails saisis ne correspondent pas.',
    'INST_ERR_FATAL' => 'Erreur fatale d’installation',
    'INST_ERR_FATAL_DB' => 'Une erreur fatale et irrécupérable de base de données est survenue. Cela peut être dû au fait que l’utilisateur spécifié n’a pas les permissions appropriées pour <code>CREATE TABLES</code> ou <code>INSERT</code>, etc. Des informations supplémentaires peuvent être données ci‑dessous. Contactez votre hébergeur ou les forums de support phpBB pour obtenir de l’aide.',
    'INST_ERR_FTP_PATH' => 'Impossible de changer vers le répertoire donné, veuillez vérifier le chemin.',
    'INST_ERR_FTP_LOGIN' => 'Impossible de se connecter au serveur FTP, vérifiez votre nom d’utilisateur et votre mot de passe.',
    'INST_ERR_MISSING_DATA' => 'Vous devez remplir tous les champs de ce bloc.',
    'INST_ERR_NO_DB' => 'Impossible de charger le module PHP pour le type de base de données sélectionné.',
    'INST_ERR_PASSWORD_MISMATCH' => 'Les mots de passe saisis ne correspondent pas.',
    'INST_ERR_PASSWORD_TOO_LONG' => 'Le mot de passe saisi est trop long. La longueur maximale est de 30 caractères.',
    'INST_ERR_PASSWORD_TOO_SHORT' => 'Le mot de passe saisi est trop court. La longueur minimale est de 6 caractères.',
    'INST_ERR_PREFIX' => 'Des tables avec le préfixe spécifié existent déjà, veuillez choisir un autre préfixe.',
    'INST_ERR_PREFIX_INVALID' => 'Le préfixe que vous avez spécifié est invalide pour votre base de données. Essayez un autre en retirant des caractères tels que le tiret.',
    'INST_ERR_PREFIX_TOO_LONG' => 'Le préfixe spécifié est trop long. La longueur maximale est de %d caractères.',
    'INST_ERR_USER_TOO_LONG' => 'Le nom d’utilisateur saisi est trop long. La longueur maximale est de 20 caractères.',
    'INST_ERR_USER_TOO_SHORT' => 'Le nom d’utilisateur saisi est trop court. La longueur minimale est de 3 caractères.',
    'INVALID_PRIMARY_KEY' => 'Clé primaire invalide : %s',

    'LONG_SCRIPT_EXECUTION' => 'Veuillez noter que cela peut prendre un certain temps... Ne stoppez pas le script.',

    // mbstring
    'MBSTRING_CHECK' => 'Vérification de l’extension <samp>mbstring</samp>',
    'MBSTRING_CHECK_EXPLAIN' => '<strong>Requis</strong> - <samp>mbstring</samp> est une extension PHP qui fournit des fonctions de chaînes multioctets. Certaines fonctionnalités de mbstring ne sont pas compatibles avec phpBB et doivent être désactivées.',
    'MBSTRING_FUNC_OVERLOAD' => 'Surcharge de fonctions',
    'MBSTRING_FUNC_OVERLOAD_EXPLAIN' => '<var>mbstring.func_overload</var> doit être réglé sur 0 ou 4.',
    'MBSTRING_ENCODING_TRANSLATION' => 'Traduction transparente d’encodage',
    'MBSTRING_ENCODING_TRANSLATION_EXPLAIN' => '<var>mbstring.encoding_translation</var> doit être réglé sur 0.',
    'MBSTRING_HTTP_INPUT' => 'Conversion d’encodage d’entrée HTTP',
    'MBSTRING_HTTP_INPUT_EXPLAIN' => '<var>mbstring.http_input</var> doit être réglé sur <samp>pass</samp>.',
    'MBSTRING_HTTP_OUTPUT' => 'Conversion d’encodage de sortie HTTP',
    'MBSTRING_HTTP_OUTPUT_EXPLAIN' => '<var>mbstring.http_output</var> doit être réglé sur <samp>pass</samp>.',

    'MAKE_FOLDER_WRITABLE' => 'Veuillez vous assurer que ce dossier existe et est inscriptible par le serveur web puis réessayez :<br />»<strong>%s</strong>.',
    'MAKE_FOLDERS_WRITABLE' => 'Veuillez vous assurer que ces dossiers existent et sont inscriptibles par le serveur web puis réessayez :<br />»<strong>%s</strong>.',

    'MYSQL_SCHEMA_UPDATE_REQUIRED' => 'Le schéma MySQL de votre base de données pour phpBB est obsolète. phpBB a détecté un schéma pour MySQL 3.x/4.x, mais le serveur utilise MySQL %2$s.<br /><strong>Avant de continuer la mise à jour, vous devez mettre à jour le schéma.</strong><br /><br />Veuillez vous référer à l’article de la base de connaissances sur la mise à jour du schéma MySQL. Si vous rencontrez des problèmes, utilisez nos forums de support.',

    'NAMING_CONFLICT' => 'Conflit de nommage : %s et %s sont tous deux des alias<br /><br />%s',
    'NEXT_STEP' => 'Passer à l’étape suivante',
    'NOT_FOUND' => 'Introuvable',
    'NOT_UNDERSTAND' => 'Impossible de comprendre %s #%d, table %s (« %s »)',
    'NO_CONVERTORS' => 'Aucun convertisseur disponible.',
    'NO_CONVERT_SPECIFIED' => 'Aucun convertisseur spécifié.',
    'NO_LOCATION' => 'Impossible de déterminer l’emplacement. Si vous savez qu’Imagemagick est installé, vous pouvez spécifier l’emplacement plus tard dans le panneau d’administration.',
    'NO_TABLES_FOUND' => 'Aucune table trouvée.',

    'OVERVIEW_BODY' => 'Bienvenue dans IntegraMOD3 !<br /><br />IntegraMOD3 est une distribution phpBB3.0.x entièrement intégrée basée sur phpBB3.0.15. Elle combine phpBB avec une grande collection de modifications soigneusement intégrées, des fonctionnalités de portail et des améliorations communautaires dans un seul paquet unifié. phpBB® est l’une des solutions de forum open source les plus utilisées au monde, reconnue pour sa stabilité, sa flexibilité et son large éventail de fonctionnalités.<br /><br />IntegraMOD3 inclut KISS Portal&copy;, le système de portail phpBB3 original et l’une des premières modifications majeures développées pendant les phases alpha et bêta de phpBB3. KISS Portal est en développement continu depuis 2005 et reste l’un des systèmes de portail les plus complets et intégrés disponibles pour phpBB3. Malgré ses capacités étendues, la plupart des fonctionnalités peuvent être configurées facilement via le panneau d’administration sans nécessiter de modifications du code.<br /><br />IntegraMOD3 inclut également de nombreuses fonctionnalités pré‑intégrées et améliorations conçues pour fournir une plateforme communautaire complète dès l’installation tout en restant compatible avec le framework phpBB3.0.x.<br /><br />Ce système d’installation vous guidera pour installer IntegraMOD3, mettre à jour depuis des versions précédentes ou convertir depuis un autre système de forum (y compris phpBB2). Pour plus d’informations, lisez <a href="../docs/INSTALL.html">le guide d’installation</a>.<br /><br />Pour lire la licence phpBB3 ou obtenir du support, sélectionnez les options correspondantes dans le menu latéral. Pour continuer, choisissez l’onglet approprié ci‑dessous.',

    'PCRE_UTF_SUPPORT' => 'Support PCRE UTF-8',
    'PCRE_UTF_SUPPORT_EXPLAIN' => 'phpBB <strong>ne</strong> fonctionnera pas si votre installation PHP n’a pas été compilée avec le support UTF-8 dans l’extension PCRE.',
    'PHP_GETIMAGESIZE_SUPPORT' => 'La fonction PHP getimagesize() est disponible',
    'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN' => '<strong>Requis</strong> - Pour que phpBB fonctionne correctement, la fonction getimagesize doit être disponible.',
    'PHP_OPTIONAL_MODULE' => 'Modules optionnels',
    'PHP_OPTIONAL_MODULE_EXPLAIN' => '<strong>Optionnel</strong> - Ces modules ou applications sont optionnels. Toutefois, s’ils sont disponibles, ils permettent des fonctionnalités supplémentaires.',
    'PHP_SUPPORTED_DB' => 'Bases de données supportées',
    'PHP_SUPPORTED_DB_EXPLAIN' => '<strong>Requis</strong> - Vous devez avoir le support d’au moins une base de données compatible dans PHP. Si aucun module de base de données n’est affiché, contactez votre hébergeur ou consultez la documentation d’installation PHP.',
    'PHP_REGISTER_GLOBALS' => 'Paramètre PHP <var>register_globals</var> désactivé',
    'PHP_REGISTER_GLOBALS_EXPLAIN' => 'phpBB fonctionnera si ce réglage est activé, mais il est recommandé de désactiver <var>register_globals</var> pour des raisons de sécurité si possible.',
    'PHP_SAFE_MODE' => 'Mode sécurisé',
    'PHP_SETTINGS' => 'Version et paramètres PHP',
    'PHP_SETTINGS_EXPLAIN' => '<strong>Requis</strong> - Vous devez exécuter au moins PHP 7.0 pour installer IntegraMOD. Si <var>safe mode</var> est affiché ci‑dessous, votre installation PHP fonctionne en mode sécurisé, ce qui impose des limitations sur l’administration distante et des fonctionnalités similaires.',
    'PHP_URL_FOPEN_SUPPORT' => 'Le paramètre PHP <var>allow_url_fopen</var> est activé',
    'PHP_URL_FOPEN_SUPPORT_EXPLAIN' => '<strong>Optionnel</strong> - Ce paramètre est optionnel, toutefois certaines fonctions phpBB comme les avatars hors site ne fonctionneront pas correctement sans lui.',
    'PHP_VERSION_REQD' => 'PHP version >= 7.0',
    'POST_ID' => 'ID du message',
    'PREFIX_FOUND' => 'Une analyse de vos tables a détecté une installation valide utilisant <strong>%s</strong> comme préfixe de table.',
    'PREPROCESS_STEP' => 'Exécution des fonctions/requêtes de pré‑traitement',
    'PRE_CONVERT_COMPLETE' => 'Toutes les étapes pré‑conversion ont été complétées avec succès. Vous pouvez maintenant commencer le processus de conversion proprement dit. Notez que vous devrez peut‑être effectuer et ajuster plusieurs choses manuellement. Après la conversion, vérifiez particulièrement les permissions assignées, reconstruisez votre index de recherche qui n’est pas converti et assurez‑vous que les fichiers ont été copiés correctement (avatars, émoticônes, etc.).',
    'PROCESS_LAST' => 'Traitement des dernières instructions',

    'REFRESH_PAGE' => 'Actualiser la page pour continuer la conversion',
    'REFRESH_PAGE_EXPLAIN' => 'Si réglé sur oui, le convertisseur actualisera la page pour continuer la conversion après chaque étape. Si c’est votre première conversion à des fins de test, nous suggérons de mettre ceci sur Non.',
    'REQUIREMENTS_TITLE' => 'Compatibilité d’installation',
    'REQUIREMENTS_EXPLAIN' => 'Avant de procéder à l’installation complète, IntegraMOD effectuera quelques tests sur la configuration de votre serveur et vos fichiers pour s’assurer que vous pouvez installer et exécuter IntegraMOD. Lisez attentivement les résultats et ne continuez pas tant que tous les tests requis ne sont pas passés. Si vous souhaitez utiliser des fonctionnalités dépendant des tests optionnels, assurez‑vous également qu’ils sont passés.',
    'RETRY_WRITE' => 'Réessayer l’écriture',
    'RETRY_WRITE_EXPLAIN' => 'Si vous le souhaitez, vous pouvez changer les permissions sur config.php pour permettre à phpBB d’y écrire. Si vous le faites, cliquez sur Réessayer pour retenter. N’oubliez pas de rétablir les permissions sur config.php après l’installation.',

    'SCRIPT_PATH' => 'Chemin du script',
    'SCRIPT_PATH_EXPLAIN' => 'Le chemin où phpBB est situé relatif au nom de domaine, par ex. <samp>/phpBB3</samp>.',
    'SELECT_LANG' => 'Sélectionner la langue',
    'SERVER_CONFIG' => 'Configuration du serveur',
    'SEARCH_INDEX_UNCONVERTED' => 'L’index de recherche n’a pas été converti',
    'SEARCH_INDEX_UNCONVERTED_EXPLAIN' => 'Votre ancien index de recherche n’a pas été converti. La recherche renverra toujours un résultat vide. Pour créer un nouvel index de recherche, allez dans le Panneau d’administration, sélectionnez Maintenance, puis Index de recherche.',
    'SOFTWARE' => 'Logiciel du forum',
    'SPECIFY_OPTIONS' => 'Spécifier les options de conversion',
    'STAGE_ADMINISTRATOR' => 'Détails de l’administrateur',
    'STAGE_ADVANCED' => 'Paramètres avancés',
    'STAGE_ADVANCED_EXPLAIN' => 'Les paramètres de cette page ne sont nécessaires que si vous savez avoir besoin de quelque chose de différent des valeurs par défaut. Si vous n’êtes pas sûr, passez à la page suivante ; ces paramètres peuvent être modifiés plus tard depuis le panneau d’administration.',
    'STAGE_CONFIG_FILE' => 'Fichier de configuration',
    'STAGE_CREATE_TABLE' => 'Créer les tables de la base de données',
    'STAGE_CREATE_TABLE_EXPLAIN' => 'Les tables utilisées par IntegraMOD3 ont été créées et peuplées avec des données initiales. Passez à l’écran suivant pour terminer l’installation.',
    'STAGE_DATABASE' => 'Paramètres de la base de données',
    'STAGE_SN_INSTALL' => 'Installer le réseau social',
    'STAGE_FINAL' => 'Étape finale',
    'STAGE_INTRO' => 'Introduction',
    'STAGE_IN_PROGRESS' => 'Conversion en cours',
    'STAGE_REQUIREMENTS' => 'Exigences',
    'STAGE_SETTINGS' => 'Paramètres',
    'STARTING_CONVERT' => 'Démarrage du processus de conversion',
    'STEP_PERCENT_COMPLETED' => 'Étape <strong>%d</strong> sur <strong>%d</strong>',
    'SUB_INTRO' => 'Introduction',
    'SUB_LICENSE' => 'Licence',
    'SUB_SUPPORT' => 'Support',
    'SUCCESSFUL_CONNECT' => 'Connexion réussie',
    'SUPPORT_BODY' => 'Un support complet sera fourni pour la version stable actuelle d’IntegraMOD3, gratuitement. Cela inclut :</p><ul><li>l’installation</li><li>la configuration</li><li>les questions techniques</li><li>les problèmes liés à d’éventuels bugs du logiciel</li><li>la mise à jour des versions Release Candidate (RC) vers la dernière version stable</li><li>la conversion de phpBB 2.0.x vers IntegraMOD3</li><li>la conversion d’autres logiciels de forum vers IntegraMOD3 (voir le <a href="https://www.phpbb.com/community/viewforum.php?f=65">forum des convertisseurs</a>)</li></ul><p>Nous encourageons les utilisateurs exécutant encore des versions bêta d’IntegraMOD3 à remplacer leur installation par une copie fraîche de la dernière version.</p><h2>MODs / Styles</h2><p>Pour les problèmes liés aux MODs, postez dans le <a href="https://integramod.com/forum/viewforum.php?f=84">forum des modifications</a>.<br />Pour les problèmes liés aux styles, templates et imagesets, postez dans le <a href="https://www.phpbb.com/community/viewforum.php?f=80">forum des styles</a>.<br /><br />Si votre question concerne un paquet spécifique, postez directement dans le sujet dédié au paquet.</p><h2>Obtenir du support</h2><p><a href="https://www.phpbb.com/community/viewtopic.php?f=14&amp;t=571070">Le paquet de bienvenue phpBB</a><br /><a href="https://www.phpbb.com/support/">Section Support</a><br /><a href="https://www.phpbb.com/support/documentation/3.0/quickstart/">Guide de démarrage rapide</a><br /><br />Pour rester à jour avec les dernières nouvelles et versions, pourquoi ne pas <a href="https://www.phpbb.com/support/">vous abonner à la liste de diffusion</a> ?<br /><br />',
    'SYNC_FORUMS' => 'Démarrage de la synchronisation des forums',
    'SYNC_POST_COUNT' => 'Synchronisation des compteurs de messages',
    'SYNC_POST_COUNT_ID' => 'Synchronisation des compteurs de messages de <var>entry</var> %1$s à %2$s.',
    'SYNC_TOPICS' => 'Démarrage de la synchronisation des sujets',
    'SYNC_TOPIC_ID' => 'Synchronisation des sujets de <var>topic_id</var> %1$s à %2$s.',

    'TABLES_MISSING' => 'Impossible de trouver ces tables<br />» <strong>%s</strong>.',
    'TABLE_PREFIX' => 'Préfixe des tables dans la base de données',
    'TABLE_PREFIX_EXPLAIN' => 'Le préfixe doit commencer par une lettre et ne contenir que des lettres, chiffres et underscores.',
    'TABLE_PREFIX_SAME' => 'Le préfixe des tables doit être celui utilisé par le logiciel dont vous effectuez la conversion.<br />» Le préfixe spécifié était %s.',
    'TESTS_PASSED' => 'Tests réussis',
    'TESTS_FAILED' => 'Tests échoués',

    'UNABLE_WRITE_LOCK' => 'Impossible d’écrire le fichier de verrouillage.',
    'UNAVAILABLE' => 'Indisponible',
    'UNWRITABLE' => 'Non inscriptible',
    'UPDATE_TOPICS_POSTED' => 'Génération des informations de sujets postés',
    'UPDATE_TOPICS_POSTED_ERR' => 'Une erreur est survenue lors de la génération des informations de sujets postés. Vous pouvez réessayer cette étape dans l’ACP après la conversion.',
    'VERIFY_OPTIONS' => 'Vérification des options de conversion',
    'VERSION' => 'Version',

    'WELCOME_INSTALL' => 'Bienvenue dans l’installation d’IntegraMOD',
    'WRITABLE' => 'Inscriptible',
));

// Updater
$lang = array_merge($lang, array(
    'ALL_FILES_UP_TO_DATE' => 'Tous les fichiers sont à jour avec la dernière version de phpBB. Vous devriez maintenant <a href="../ucp.php?mode=login">vous connecter à votre forum</a> et vérifier que tout fonctionne correctement. N’oubliez pas de supprimer, renommer ou déplacer votre répertoire d’installation ! Veuillez nous envoyer les informations mises à jour sur votre serveur et la configuration du forum depuis le module <a href="../ucp.php?mode=login&amp;redirect=adm/index.php%3Fi=send_statistics%26mode=send_statistics">Envoyer les statistiques</a> dans votre ACP.',
    'ARCHIVE_FILE' => 'Fichier source dans l’archive',

    'BACK' => 'Retour',
    'BINARY_FILE' => 'Fichier binaire',
    'BOT' => 'Robot / Spider',

    'CHANGE_CLEAN_NAMES' => 'La méthode utilisée pour s’assurer qu’un nom d’utilisateur n’est pas utilisé par plusieurs utilisateurs a changé. Certains utilisateurs ont le même nom selon la nouvelle méthode. Vous devez supprimer ou renommer ces utilisateurs pour vous assurer que chaque nom est utilisé par un seul utilisateur avant de continuer.',
    'CHECK_FILES' => 'Vérifier les fichiers',
    'CHECK_FILES_AGAIN' => 'Vérifier les fichiers à nouveau',
    'CHECK_FILES_EXPLAIN' => 'À l’étape suivante tous les fichiers seront vérifiés par rapport aux fichiers de mise à jour - cela peut prendre du temps si c’est la première vérification.',
    'CHECK_FILES_UP_TO_DATE' => 'D’après votre base de données, votre version est à jour. Vous pouvez procéder à la vérification des fichiers pour vous assurer que tous les fichiers sont réellement à jour.',
    'CHECK_UPDATE_DATABASE' => 'Continuer le processus de mise à jour',
    'COLLECTED_INFORMATION' => 'Informations sur les fichiers',
    'COLLECTED_INFORMATION_EXPLAIN' => 'La liste ci‑dessous montre les informations sur les fichiers nécessitant une mise à jour. Lisez les informations devant chaque bloc de statut pour savoir ce qu’elles signifient et ce que vous devez faire.',
    'COLLECTING_FILE_DIFFS' => 'Collecte des différences de fichiers',
    'COMPLETE_LOGIN_TO_BOARD' => 'Vous devriez maintenant <a href="../ucp.php?mode=login">vous connecter à votre forum</a> et vérifier que tout fonctionne. N’oubliez pas de supprimer, renommer ou déplacer votre répertoire d’installation !',
    'CONTINUE_UPDATE_NOW' => 'Continuer la mise à jour maintenant',
    'CONTINUE_UPDATE' => 'Continuer la mise à jour',
    'CURRENT_FILE' => 'Début du conflit - Code original du fichier avant mise à jour',
    'CURRENT_VERSION' => 'Version actuelle',

    'DATABASE_TYPE' => 'Type de base de données',
    'DATABASE_UPDATE_INFO_OLD' => 'Le fichier de mise à jour de la base de données dans le répertoire install est obsolète. Assurez‑vous d’avoir téléversé la bonne version du fichier.',
    'DELETE_USER_REMOVE' => 'Supprimer l’utilisateur et supprimer les messages',
    'DELETE_USER_RETAIN' => 'Supprimer l’utilisateur mais conserver les messages',
    'DESTINATION' => 'Fichier de destination',
    'DIFF_INLINE' => 'Inline',
    'DIFF_RAW' => 'Diff unifié brut',
    'DIFF_SEP_EXPLAIN' => 'Bloc de code utilisé dans le fichier mis à jour',
    'DIFF_SIDE_BY_SIDE' => 'Côte à côte',
    'DIFF_UNIFIED' => 'Diff unifié',
    'DO_NOT_UPDATE' => 'Ne pas mettre à jour ce fichier',
    'DONE' => 'Terminé',
    'DOWNLOAD' => 'Télécharger',
    'DOWNLOAD_AS' => 'Télécharger en tant que',
    'DOWNLOAD_UPDATE_METHOD_BUTTON' => 'Télécharger l’archive des fichiers modifiés (recommandé)',
    'DOWNLOAD_CONFLICTS' => 'Télécharger les conflits pour ce fichier',
    'DOWNLOAD_CONFLICTS_EXPLAIN' => 'Cherchez &lt;&lt;&lt; pour repérer les conflits',
    'DOWNLOAD_UPDATE_METHOD' => 'Télécharger l’archive des fichiers modifiés',
    'DOWNLOAD_UPDATE_METHOD_EXPLAIN' => 'Une fois téléchargée, décompressez l’archive. Vous trouverez les fichiers modifiés à téléverser dans votre répertoire racine phpBB. Téléversez-les ensuite aux emplacements appropriés. Après avoir téléversé tous les fichiers, vérifiez-les à nouveau avec le bouton ci‑dessous.',

    'ERROR' => 'Erreur',
    'EDIT_USERNAME' => 'Modifier le nom d’utilisateur',

    'FILE_ALREADY_UP_TO_DATE' => 'Le fichier est déjà à jour.',
    'FILE_DIFF_NOT_ALLOWED' => 'Fichier non autorisé au diff.',
    'FILE_USED' => 'Information utilisée depuis',			// Single file
    'FILES_CONFLICT' => 'Fichiers en conflit',
    'FILES_CONFLICT_EXPLAIN' => 'Les fichiers suivants sont modifiés et ne correspondent pas aux fichiers originaux de l’ancienne version. phpBB a déterminé que ces fichiers créent des conflits s’ils sont fusionnés. Veuillez investiguer et résoudre manuellement les conflits ou continuer la mise à jour en choisissant la méthode de fusion préférée. Si vous résolvez les conflits manuellement, vérifiez les fichiers après modification. Vous pouvez aussi choisir un mode de fusion pour chaque fichier. Le premier entraîne la perte des lignes conflictuelles de votre ancien fichier, le second entraîne la perte des modifications du fichier plus récent.',
    'FILES_MODIFIED' => 'Fichiers modifiés',
    'FILES_MODIFIED_EXPLAIN' => 'Les fichiers suivants sont modifiés et ne représentent pas les fichiers originaux de l’ancienne version. Le fichier mis à jour sera une fusion entre vos modifications et le nouveau fichier.',
    'FILES_NEW' => 'Nouveaux fichiers',
    'FILES_NEW_EXPLAIN' => 'Les fichiers suivants n’existent pas actuellement dans votre installation. Ils seront ajoutés.',
    'FILES_NEW_CONFLICT' => 'Nouveaux fichiers en conflit',
    'FILES_NEW_CONFLICT_EXPLAIN' => 'Les fichiers suivants sont nouveaux dans la dernière version mais il a été déterminé qu’un fichier portant le même nom existe déjà. Le fichier sera écrasé par le nouveau fichier.',
    'FILES_NOT_MODIFIED' => 'Fichiers non modifiés',
    'FILES_NOT_MODIFIED_EXPLAIN' => 'Les fichiers suivants ne sont pas modifiés et représentent les fichiers phpBB originaux de la version source.',
    'FILES_UP_TO_DATE' => 'Fichiers déjà mis à jour',
    'FILES_UP_TO_DATE_EXPLAIN' => 'Les fichiers suivants sont déjà à jour et n’ont pas besoin d’être mis à jour.',
    'FTP_SETTINGS' => 'Paramètres FTP',
    'FTP_UPDATE_METHOD' => 'Téléversement FTP',

    'INCOMPATIBLE_UPDATE_FILES' => 'Les fichiers de mise à jour trouvés sont incompatibles avec votre version installée. Votre version installée est %1$s et le fichier de mise à jour vise la mise à jour de phpBB %2$s vers %3$s.',
    'INCOMPLETE_UPDATE_FILES' => 'Les fichiers de mise à jour sont incomplets.',
    'INLINE_UPDATE_SUCCESSFUL' => 'La mise à jour de la base de données a réussi. Vous devez maintenant continuer le processus de mise à jour.',

    'KEEP_OLD_NAME' => 'Conserver le nom d’utilisateur',

    'LATEST_VERSION' => 'Dernière version',
    'LINE' => 'Ligne',
    'LINE_ADDED' => 'Ajoutée',
    'LINE_MODIFIED' => 'Modifiée',
    'LINE_REMOVED' => 'Supprimée',
    'LINE_UNMODIFIED' => 'Non modifiée',
    'LOGIN_UPDATE_EXPLAIN' => 'Pour mettre à jour votre installation, vous devez d’abord vous connecter.',

    'MAPPING_FILE_STRUCTURE' => 'Pour faciliter l’upload, voici les emplacements des fichiers mappant votre installation phpBB.',

    'MERGE_MODIFICATIONS_OPTION' => 'Fusionner les modifications',

    'MERGE_NO_MERGE_NEW_OPTION' => 'Ne pas fusionner - utiliser le nouveau fichier',
    'MERGE_NO_MERGE_MOD_OPTION' => 'Ne pas fusionner - utiliser le fichier installé actuellement',
    'MERGE_MOD_FILE_OPTION' => 'Fusionner les modifications (supprime le code phpBB récent dans le bloc conflictuel)',
    'MERGE_NEW_FILE_OPTION' => 'Fusionner les modifications (supprime le code modifié dans le bloc conflictuel)',
    'MERGE_SELECT_ERROR' => 'Les modes de fusion des fichiers en conflit ne sont pas correctement sélectionnés.',
    'MERGING_FILES' => 'Fusion des différences',
    'MERGING_FILES_EXPLAIN' => 'Collecte actuellement les modifications finales des fichiers.<br /><br />Veuillez patienter jusqu’à ce que phpBB ait terminé toutes les opérations sur les fichiers modifiés.',

    'NEW_FILE' => 'Fin du conflit',
    'NEW_USERNAME' => 'Nouveau nom d’utilisateur',
    'NO_AUTH_UPDATE' => 'Non autorisé à mettre à jour',
    'NO_ERRORS' => 'Aucune erreur',
    'NO_UPDATE_FILES' => 'Ne pas mettre à jour les fichiers suivants',
    'NO_UPDATE_FILES_EXPLAIN' => 'Les fichiers suivants sont nouveaux ou modifiés mais le répertoire où ils devraient se trouver est introuvable. Si cette liste contient des fichiers en dehors de language/ ou styles/, vous avez peut‑être modifié votre structure de répertoires et la mise à jour peut être incomplète.',
    'NO_UPDATE_FILES_OUTDATED' => 'Aucun répertoire de mise à jour valide n’a été trouvé, assurez‑vous d’avoir téléversé les fichiers pertinents.<br /><br />Votre installation ne semble <strong>pas</strong> être à jour. Des mises à jour sont disponibles pour votre version de phpBB %1$s, téléchargez le paquet approprié sur <a href="https://www.phpbb.com/downloads/" rel="external">https://www.phpbb.com/downloads/</a> pour mettre à jour de la version %2$s à %3$s.',
    'NO_UPDATE_FILES_UP_TO_DATE' => 'Votre version est à jour. Il n’est pas nécessaire d’exécuter l’outil de mise à jour. Si vous voulez faire une vérification d’intégrité, assurez‑vous d’avoir téléversé les bons fichiers.',
    'NO_UPDATE_INFO' => 'Informations de mise à jour introuvables.',
    'NO_UPDATES_REQUIRED' => 'Aucune mise à jour requise',
    'NO_VISIBLE_CHANGES' => 'Aucun changement visible',
    'NOTICE' => 'Remarque',
    'NUM_CONFLICTS' => 'Nombre de conflits',
    'NUMBER_OF_FILES_COLLECTED' => 'Actuellement les différences de %1$d sur %2$d fichiers ont été vérifiées.<br />Veuillez patienter jusqu’à la fin de la vérification.',

    'OLD_UPDATE_FILES' => 'Les fichiers de mise à jour sont obsolètes. Les fichiers trouvés visent la mise à jour de phpBB %1$s à phpBB %2$s mais la dernière version est %3$s.',

    'PACKAGE_UPDATES_TO' => 'Le paquet met à jour vers la version',
    'PERFORM_DATABASE_UPDATE' => 'Effectuer la mise à jour de la base de données',
    'PERFORM_DATABASE_UPDATE_EXPLAIN' => 'Ci‑dessous vous trouverez un bouton vers le script de mise à jour de la base de données. La mise à jour peut prendre du temps, ne l’interrompez pas. Après la mise à jour, suivez les instructions pour continuer le processus.',
    'PREVIOUS_VERSION' => 'Version précédente',
    'PROGRESS' => 'Progression',

    'RESULT' => 'Résultat',
    'RUN_DATABASE_SCRIPT' => 'Mettre à jour ma base de données maintenant',

    'SELECT_DIFF_MODE' => 'Sélectionner le mode de diff',
    'SELECT_DOWNLOAD_FORMAT' => 'Sélectionner le format d’archive à télécharger',
    'SELECT_FTP_SETTINGS' => 'Sélectionner les paramètres FTP',
    'SHOW_DIFF_CONFLICT' => 'Afficher différences/conflits',
    'SHOW_DIFF_FINAL' => 'Afficher le fichier résultant',
    'SHOW_DIFF_MODIFIED' => 'Afficher les différences fusionnées',
    'SHOW_DIFF_NEW' => 'Afficher le contenu du fichier',
    'SHOW_DIFF_NEW_CONFLICT' => 'Afficher les différences',
    'SHOW_DIFF_NOT_MODIFIED' => 'Afficher les différences',
    'SOME_QUERIES_FAILED' => 'Certaines requêtes ont échoué, les statements et erreurs sont listés ci‑dessous.',
    'SQL' => 'SQL',
    'SQL_FAILURE_EXPLAIN' => 'Ce n’est probablement pas grave, la mise à jour continuera. Si cela échoue, vous devrez demander de l’aide sur nos forums. Consultez <a href="../docs/README.html">README</a> pour savoir comment obtenir de l’aide.',
    'STAGE_FILE_CHECK' => 'Vérification des fichiers',
    'STAGE_UPDATE_DB' => 'Mise à jour de la base de données',
    'STAGE_UPDATE_FILES' => 'Mise à jour des fichiers',
    'STAGE_VERSION_CHECK' => 'Vérification de la version',
    'STATUS_CONFLICT' => 'Fichier modifié produisant des conflits',
    'STATUS_MODIFIED' => 'Fichier modifié',
    'STATUS_NEW' => 'Nouveau fichier',
    'STATUS_NEW_CONFLICT' => 'Nouveau fichier en conflit',
    'STATUS_NOT_MODIFIED' => 'Fichier non modifié',
    'STATUS_UP_TO_DATE' => 'Fichier déjà à jour',

    'TOGGLE_DISPLAY' => 'Afficher/Masquer la liste des fichiers',
    'TRY_DOWNLOAD_METHOD' => 'Vous pouvez essayer la méthode de téléchargement des fichiers modifiés.<br />Cette méthode fonctionne toujours et est recommandée.',
    'TRY_DOWNLOAD_METHOD_BUTTON' => 'Essayer cette méthode maintenant',

    'UPDATE_COMPLETED' => 'Mise à jour terminée',
    'UPDATE_DATABASE' => 'Mettre à jour la base de données',
    'UPDATE_DATABASE_EXPLAIN' => 'À l’étape suivante, la base de données sera mise à jour.',
    'UPDATE_DATABASE_SCHEMA' => 'Mise à jour du schéma de la base de données',
    'UPDATE_FILES' => 'Mettre à jour les fichiers',
    'UPDATE_FILES_NOTICE' => 'Assurez‑vous d’avoir mis à jour les fichiers de votre forum également, ce fichier met à jour uniquement la base de données.',
    'UPDATE_INSTALLATION' => 'Mettre à jour l’installation phpBB',
    'UPDATE_INSTALLATION_EXPLAIN' => 'Avec cette option, il est possible de mettre à jour votre installation phpBB vers la dernière version.<br /><br />Pendant le processus, tous vos fichiers seront vérifiés pour intégrité. Vous pouvez examiner toutes les différences et fichiers avant la mise à jour.<br /><br />La mise à jour des fichiers peut se faire de deux manières :</p><h2>Mise à jour manuelle</h2><p>Avec cette méthode, vous téléchargez votre ensemble personnel de fichiers modifiés pour vous assurer de ne pas perdre vos modifications. Après téléchargement, téléversez manuellement les fichiers aux emplacements corrects sous le répertoire racine phpBB. Ensuite, exécutez la vérification des fichiers à nouveau pour confirmer.</p><h2>Mise à jour automatique via FTP</h2><p>Cette méthode est similaire mais sans téléchargement manuel : les fichiers sont copiés pour vous. Pour utiliser cette méthode, vous devez connaître vos identifiants FTP. Une fois terminé, vous serez redirigé vers la vérification des fichiers pour confirmer que tout a été mis à jour correctement.<br /><br />',
    'UPDATE_INSTRUCTIONS' => '

		<h1>Annonce de la version</h1>

		<p>Veuillez lire <a href="%1$s" title="%1$s"><strong>l’annonce de la sortie</strong></a> avant de poursuivre la mise à jour, elle peut contenir des informations utiles. Elle contient également des liens de téléchargement ainsi que le journal des modifications.</p>

		<br />

		<h1>Comment mettre à jour votre installation avec le Paquet de Mise à Jour Automatique</h1>

		<p>La méthode recommandée d’énumération ici est valide uniquement pour le paquet de mise à jour automatique. Vous pouvez également mettre à jour votre installation en utilisant les méthodes énumérées dans le document INSTALL.html. Les étapes pour mettre à jour phpBB3 automatiquement sont :</p>

		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Allez sur la page de téléchargement <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">phpBB.com</a> et téléchargez l’archive "Paquet de Mise à Jour Automatique".<br /><br /></li>
			<li>Décompressez l’archive.<br /><br /></li>
			<li>Téléversez le dossier install complet et décompressé dans le répertoire racine de votre phpBB (là où se trouve config.php).<br /><br /></li>
		</ul>

		<p>Une fois téléversé, votre forum sera hors ligne pour les utilisateurs normaux à cause du répertoire install présent.<br /><br />
		<strong><a href="%2$s" title="%2$s">Démarrez maintenant le processus de mise à jour en pointant votre navigateur vers le dossier install</a>.</strong><br />
		<br />
		Vous serez ensuite guidé à travers le processus de mise à jour. Vous serez notifié une fois la mise à jour terminée.
		</p>
	',
    'UPDATE_INSTRUCTIONS_INCOMPLETE' => '

		<h1>Mise à jour incomplète détectée</h1>

		<p>phpBB a détecté une mise à jour automatique incomplète. Assurez‑vous d’avoir suivi toutes les étapes de l’outil de mise à jour automatique. Vous trouverez le lien ci‑dessous ou rendez‑vous directement dans votre répertoire install.</p>
	',
    'UPDATE_METHOD' => 'Méthode de mise à jour',
    'UPDATE_METHOD_EXPLAIN' => 'Vous pouvez choisir la méthode préférée. L’upload FTP vous demandera vos informations FTP. Avec cette méthode, les fichiers seront déplacés automatiquement et des sauvegardes seront créées en ajoutant .bak au nom. Si vous choisissez de télécharger les fichiers modifiés, vous pourrez les décompresser et téléverser manuellement plus tard.',
    'UPDATE_REQUIRES_FILE' => 'La mise à jour requiert que le fichier suivant soit présent : %s',
    'UPDATE_SUCCESS' => 'Mise à jour réussie',
    'UPDATE_SUCCESS_EXPLAIN' => 'Successfully updated all files. The next step involves checking all files again to make sure the files got updated correctly.',
    'UPDATE_VERSION_OPTIMIZE' => 'Mise à jour de la version et optimisation des tables',
    'UPDATING_DATA' => 'Mise à jour des données',
    'UPDATING_TO_LATEST_STABLE' => 'Mise à jour de la base de données vers la dernière version stable',
    'UPDATED_VERSION' => 'Version mise à jour',
    'UPGRADE_INSTRUCTIONS' => 'Une nouvelle version stable <strong>%1$s</strong> est disponible. Veuillez lire <a href="%2$s" title="%2$s"><strong>l’annonce de la sortie</strong></a> pour connaître les nouveautés et comment mettre à niveau.',
    'UPLOAD_METHOD' => 'Méthode d’upload',

    'UPDATE_DB_SUCCESS' => 'La mise à jour de la base de données a réussi.',
    'USER_ACTIVE' => 'Utilisateur actif',
    'USER_INACTIVE' => 'Utilisateur inactif',

    'VERSION_CHECK' => 'Vérification de version',
    'VERSION_CHECK_EXPLAIN' => 'Vérifie si votre installation phpBB est à jour.',
    'VERSION_NOT_UP_TO_DATE' => 'Votre installation phpBB n’est pas à jour. Poursuivez le processus de mise à jour.',
    'VERSION_NOT_UP_TO_DATE_ACP' => 'Votre installation phpBB n’est pas à jour.<br />Ci‑dessous un lien vers l’annonce de sortie contenant plus d’informations et les instructions de mise à jour.',
    'VERSION_NOT_UP_TO_DATE_TITLE' => 'Votre installation phpBB n’est pas à jour.',
    'VERSION_UP_TO_DATE' => 'Votre installation phpBB est à jour. Bien qu’il n’y ait pas de mises à jour disponibles pour le moment, vous pouvez continuer pour effectuer une vérification d’intégrité des fichiers.',
    'VERSION_UP_TO_DATE_ACP' => 'Votre installation phpBB est à jour. Aucune mise à jour n’est disponible actuellement.',
    'VIEWING_FILE_CONTENTS' => 'Affichage du contenu du fichier',
    'VIEWING_FILE_DIFF' => 'Affichage des différences de fichier',

    'WRONG_INFO_FILE_FORMAT' => 'Format du fichier info incorrect',
));

// Default database schema entries...
$lang = array_merge($lang, array(
    'CONFIG_BOARD_EMAIL_SIG' => 'Merci, La Direction',
    'CONFIG_SITE_DESC' => 'Un court texte pour décrire votre forum',
    'CONFIG_SITENAME' => 'votredomaine.com',

    'DEFAULT_INSTALL_POST' => 'Ceci est un message d’exemple dans votre installation IntegraMOD. Tout semble fonctionner. Vous pouvez supprimer ce message si vous le souhaitez et continuer la configuration de votre forum. Lors de l’installation, votre première catégorie et votre premier forum reçoivent des permissions appropriées pour les groupes prédéfinis administrateurs, bots, modérateurs globaux, invités, utilisateurs enregistrés et utilisateurs COPPA enregistrés. Si vous choisissez de supprimer votre première catégorie et votre premier forum, n’oubliez pas d’assigner les permissions pour tous ces groupes sur toutes les nouvelles catégories et forums que vous créez. Il est recommandé de renommer votre première catégorie et votre premier forum et de copier leurs permissions lors de la création de nouveaux éléments. Amusez‑vous bien !',

    'FORUMS_FIRST_CATEGORY' => 'Votre première catégorie',
    'FORUMS_TEST_FORUM_DESC' => 'Description de votre premier forum.',
    'FORUMS_TEST_FORUM_TITLE' => 'Votre premier forum',

    'RANKS_SITE_ADMIN_TITLE' => 'Administrateur du site',
    'REPORT_WAREZ' => 'Le message contient des liens vers des logiciels illégaux ou piratés.',
    'REPORT_SPAM' => 'Le message signalé a pour seul but de faire la publicité d’un site ou d’un produit.',
    'REPORT_OFF_TOPIC' => 'Le message signalé est hors sujet.',
    'REPORT_OTHER' => 'Le message signalé ne correspond à aucune autre catégorie, veuillez utiliser le champ d’information supplémentaire.',

    'SMILIES_ARROW' => 'Flèche',
    'SMILIES_CONFUSED' => 'Confus',
    'SMILIES_COOL' => 'Cool',
    'SMILIES_CRYING' => 'En pleurs ou très triste',
    'SMILIES_EMARRASSED' => 'Gêné',
    'SMILIES_EVIL' => 'Méchant ou très en colère',
    'SMILIES_EXCLAMATION' => 'Exclamation',
    'SMILIES_GEEK' => 'Geek',
    'SMILIES_IDEA' => 'Idée',
    'SMILIES_LAUGHING' => 'En train de rire',
    'SMILIES_MAD' => 'Furieux',
    'SMILIES_MR_GREEN' => 'M. Vert',
    'SMILIES_NEUTRAL' => 'Neutre',
    'SMILIES_QUESTION' => 'Question',
    'SMILIES_RAZZ' => 'Razz',
    'SMILIES_ROLLING_EYES' => 'Levant les yeux au ciel',
    'SMILIES_SAD' => 'Triste',
    'SMILIES_SHOCKED' => 'Choqué',
    'SMILIES_SMILE' => 'Sourire',
    'SMILIES_SURPRISED' => 'Surpris',
    'SMILIES_TWISTED_EVIL' => 'Méchant tordu',
    'SMILIES_UBER_GEEK' => 'Super Geek',
    'SMILIES_VERY_HAPPY' => 'Très heureux',
    'SMILIES_WINK' => 'Clin d’œil',

    'TOPICS_TOPIC_TITLE' => 'Bienvenue sur IntegraMOD',
));