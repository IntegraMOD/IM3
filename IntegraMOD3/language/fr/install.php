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
    'ADMIN_CONFIG'				=> 'Configuration de l'administrateur',
    'ADMIN_PASSWORD'			=> 'Mot de passe administrateur',
    'ADMIN_PASSWORD_CONFIRM'	=> 'Confirmer le mot de passe administrateur',
    'ADMIN_PASSWORD_EXPLAIN'	=> 'Veuillez entrer un mot de passe contenant entre 6 et 30 caractères.',
    'ADMIN_TEST'				=> 'Vérifier les paramètres administrateur',
    'ADMIN_USERNAME'			=> 'Nom d'utilisateur administrateur',
    'ADMIN_USERNAME_EXPLAIN'	=> 'Veuillez entrer un nom d'utilisateur contenant entre 3 et 20 caractères.',
    'APP_MAGICK'				=> 'Support Imagemagick [ Pièces jointes ]',
    'AUTHOR_NOTES'				=> 'Remarques de l'auteur<br />» %s',
    'AVAILABLE'					=> 'Disponible',
    'AVAILABLE_CONVERTORS'		=> 'Convertisseurs disponibles',

    'BEGIN_CONVERT'					=> 'Commencer la conversion',
    'BLANK_PREFIX_FOUND'			=> 'Une analyse de vos tables a montré une installation valide n'utilisant aucun préfixe de table.',
    'BOARD_NOT_INSTALLED'			=> 'Aucune installation trouvée',
    'BOARD_NOT_INSTALLED_EXPLAIN'	=> 'Le framework de conversion unifié phpBB requiert une installation par défaut de phpBB3 pour fonctionner, veuillez <a href="%s">procéder d'abord à l'installation de phpBB3</a>.',
    'BACKUP_NOTICE'					=> 'Veuillez sauvegarder votre forum avant la mise à jour au cas où des problèmes surviendraient pendant le processus.',

    'CATEGORY'					=> 'Catégorie',
    'CACHE_STORE'				=> 'Type de cache',
    'CACHE_STORE_EXPLAIN'		=> 'L'emplacement physique où les données sont mises en cache. Le cache sur fichier est simple et fiable ; memcache/memcached et redis fournissent un cache en mémoire plus rapide, partagé entre processus/serveurs.',
    'CACHE_FILE'				=> 'Fichier (par défaut)',
    'CACHE_MEMCACHE'			=> 'Memcache (pecl)',
    'CACHE_MEMCACHED'			=> 'Memcached (pecl)',
    'CACHE_REDIS'				=> 'Redis',
    'CACHE_APC'					=> 'APC',
    'CACHE_WINCACHE'			=> 'WinCache',
    'CACHE_MEMORY'				=> 'Mémoire (processus uniquement)',
    'CACHE_NULL'				=> 'Aucun cache',
    'CACHE_FILE_EXPLAIN'		=> 'Le cache sur fichier enregistre les données mises en cache sur disque dans le répertoire store/. Simple et fiable, mais plus lent que les systèmes en mémoire.',
    'CACHE_MEMCACHE_EXPLAIN'	=> 'Memcache (extension PHP) fournit un cache en mémoire distribué rapide. Nécessite l'extension memcache et un serveur memcached.',
    'CACHE_MEMCACHED_EXPLAIN'	=> 'Memcached (extension PHP) offre un cache en mémoire distribué performant. Nécessite l'extension memcached et un serveur.',
    'CACHE_REDIS_EXPLAIN'		=> 'Redis est un magasin de données en mémoire avancé avec persistance. Nécessite l'extension redis et un serveur Redis.',
    'CACHE_APC_EXPLAIN'			=> 'APC/APCu fournit un cache en mémoire partagé localement dans les processus PHP. Utile pour les environnements mono-serveur.',
    'CACHE_WINCACHE_EXPLAIN'	=> 'WinCache est un cache d'opcode et de données disponible sur les hôtes Windows.',
    'CACHE_MEMORY_EXPLAIN'		=> 'Le cache en mémoire stocke les données uniquement dans le processus ; rapide mais non partagé entre processus/serveurs.',
    'CAT_CONVERT'				=> 'Convertir',
    'CAT_INSTALL'				=> 'Installer',
    'CAT_OVERVIEW'				=> 'Aperçu',
    'CAT_UPDATE'				=> 'Mettre à jour',
    'CHANGE'					=> 'Modifier',
    'CHECK_TABLE_PREFIX'		=> 'Veuillez vérifier le préfixe des tables et réessayer.',
    'CLEAN_VERIFY'				=> 'Nettoyage et vérification de la structure finale',
    'CLEANING_USERNAMES'		=> 'Nettoyage des noms d'utilisateur',
    'COLLIDING_CLEAN_USERNAME'	=> '<strong>%s</strong> est le nom d'utilisateur nettoyé pour:',
    'COLLIDING_USERNAMES_FOUND'	=> 'Des noms d'utilisateur en collision ont été trouvés sur votre ancien forum. Pour compléter la conversion, veuillez supprimer ou renommer ces utilisateurs afin qu'il n'y ait qu'un seul utilisateur sur votre ancien forum pour chaque nom d'utilisateur nettoyé.',
    'COLLIDING_USER'			=> '» id utilisateur: <strong>%d</strong> nom d'utilisateur: <strong>%s</strong> (%d messages)',
    'CONFIG_CONVERT'			=> 'Conversion de la configuration',
    'CONFIG_FILE_UNABLE_WRITE'	=> 'Il n'a pas été possible d'écrire le fichier de configuration. Des méthodes alternatives pour créer ce fichier sont présentées ci-dessous.',
    'CONFIG_FILE_WRITTEN'		=> 'Le fichier de configuration a été écrit. Vous pouvez maintenant passer à l'étape suivante de l'installation.',
    'CONFIG_PHPBB_EMPTY'		=> 'La variable de configuration phpBB3 pour « %s » est vide.',
    'CONFIG_RETRY'				=> 'Réessayer',
    'CONTACT_EMAIL_CONFIRM'		=> 'Confirmer l'e-mail de contact',
    'CONTINUE_CONVERT'			=> 'Continuer la conversion',
    'CONTINUE_CONVERT_BODY'		=> 'Une tentative de conversion précédente a été détectée. Vous pouvez maintenant choisir entre démarrer une nouvelle conversion ou continuer la conversion.',
    'CONTINUE_LAST'				=> 'Continuer les dernières instructions',
    'CONTINUE_OLD_CONVERSION'	=> 'Continuer la conversion commencée précédemment',
    'CONVERT'					=> 'Convertir',
    'CONVERT_COMPLETE'			=> 'Conversion terminée',
    'CONVERT_COMPLETE_EXPLAIN'	=> 'Vous avez maintenant réussi à convertir votre forum vers phpBB 3.0. Vous pouvez maintenant vous connecter et <a href="../">accéder à votre forum</a>. Veuillez vous assurer que les paramètres ont été transférés correctement avant d'activer votre forum en supprimant le répertoire d'installation. N'oubliez pas que de l'aide sur l'utilisation de phpBB est disponible en ligne via la <a href="https://www.phpbb.com/support/documentation/3.0/">Documentation</a> et les <a href="https://www.phpbb.com/community/viewforum.php?f=46">forums de support</a>.',
    'CONVERT_INTRO'				=> 'Bienvenue dans le cadre de conversion unifié phpBB',
    'CONVERT_INTRO_BODY'		=> 'Depuis ici, vous pouvez importer des données à partir d'autres systèmes de forum (installés). La liste ci-dessous montre tous les modules de conversion actuellement disponibles. Si aucun convertisseur n'apparaît pour le logiciel source que vous souhaitez convertir, consultez notre site web où d'autres modules peuvent être disponibles en téléchargement.',
    'CONVERT_NEW_CONVERSION'	=> 'Nouvelle conversion',
    'CONVERT_NOT_EXIST'			=> 'Le convertisseur spécifié n'existe pas.',
    'CONVERT_OPTIONS'			=> 'Options',
    'CONVERT_SETTINGS_VERIFIED'	=> 'Les informations que vous avez saisies ont été vérifiées. Pour démarrer la conversion, appuyez sur le bouton ci-dessous.',
    'CONV_ERR_FATAL'			=> 'Erreur fatale de conversion',

    'CONV_ERROR_ATTACH_FTP_DIR'			=> 'Le téléversement FTP pour les pièces jointes est activé sur l'ancien forum. Veuillez désactiver l'option FTP et vous assurer qu'un répertoire de téléversement valide est spécifié, puis copiez tous les fichiers de pièces jointes dans ce nouveau répertoire accessible via le web. Une fois fait, redémarrez le convertisseur.',
    'CONV_ERROR_CONFIG_EMPTY'			=> 'Aucune information de configuration disponible pour la conversion.',
    'CONV_ERROR_FORUM_ACCESS'			=> 'Impossible d'obtenir les informations d'accès aux forums.',
    'CONV_ERROR_GET_CATEGORIES'			=> 'Impossible d'obtenir les catégories.',
    'CONV_ERROR_GET_CONFIG'				=> 'Impossible de récupérer la configuration de votre forum.',
    'CONV_ERROR_COULD_NOT_READ'			=> 'Impossible d'accéder/lire « %s ».',
    'CONV_ERROR_GROUP_ACCESS'			=> 'Impossible d'obtenir les informations d'authentification du groupe.',
    'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Incohérence détectée dans la table des groupes dans add_bots() - vous devez ajouter tous les groupes spéciaux si vous le faites manuellement.',
    'CONV_ERROR_INSERT_BOT'				=> 'Impossible d'insérer le bot dans la table des utilisateurs.',
    'CONV_ERROR_INSERT_BOTGROUP'		=> 'Impossible d'insérer le bot dans la table des bots.',
    'CONV_ERROR_INSERT_USER_GROUP'		=> 'Impossible d'insérer l'utilisateur dans la table user_group.',
    'CONV_ERROR_MESSAGE_PARSER'			=> 'Erreur du analyseur de messages',
    'CONV_ERROR_NO_AVATAR_PATH'			=> 'Remarque pour le développeur: vous devez spécifier $convertor[\'avatar_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_FORUM_PATH'			=> 'Le chemin relatif vers le forum source n'a pas été spécifié.',
    'CONV_ERROR_NO_GALLERY_PATH'		=> 'Remarque pour le développeur: vous devez spécifier $convertor[\'avatar_gallery_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_GROUP'				=> 'Le groupe « %1$s » n'a pas pu être trouvé dans %2$s.',
    'CONV_ERROR_NO_RANKS_PATH'			=> 'Remarque pour le développeur: vous devez spécifier $convertor[\'ranks_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_SMILIES_PATH'		=> 'Remarque pour le développeur: vous devez spécifier $convertor[\'smilies_path\'] pour utiliser %s.',
    'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Remarque pour le développeur: vous devez spécifier $convertor[\'upload_path\'] pour utiliser %s.',
    'CONV_ERROR_PERM_SETTING'			=> 'Impossible d'insérer/mettre à jour le paramètre de permission.',
    'CONV_ERROR_PM_COUNT'				=> 'Impossible de sélectionner le nombre de MP du dossier.',
    'CONV_ERROR_REPLACE_CATEGORY'		=> 'Impossible d'insérer le nouveau forum en remplaçant l'ancienne catégorie.',
    'CONV_ERROR_REPLACE_FORUM'			=> 'Impossible d'insérer le nouveau forum en remplaçant l'ancien forum.',
    'CONV_ERROR_USER_ACCESS'			=> 'Impossible d'obtenir les informations d'authentification de l'utilisateur.',
    'CONV_ERROR_WRONG_GROUP'			=> 'Groupe incorrect « %1$s » défini dans %2$s.',
    'CONV_OPTIONS_BODY'					=> 'Cette page collecte les données nécessaires pour accéder au forum source. Entrez les détails de la base de données de votre ancien forum ; le convertisseur ne modifiera rien dans la base de données donnée ci-dessous. Le forum source doit être désactivé pour permettre une conversion cohérente.',
    'CONV_SAVED_MESSAGES'				=> 'Messages enregistrés',

    'COULD_NOT_COPY'			=> 'Impossible de copier le fichier <strong>%1$s</strong> vers <strong>%2$s</strong><br /><br />Veuillez vérifier que le répertoire cible existe et qu'il est inscriptible par le serveur web.',
    'COULD_NOT_FIND_PATH'		=> 'Impossible de trouver le chemin d'accès à votre ancien forum. Veuillez vérifier vos paramètres et réessayer.<br />» %s a été spécifié comme chemin source.',

    'DBMS'						=> 'Type de base de données',
    'DB_CONFIG'					=> 'Configuration de la base de données',
    'DB_CONNECTION'				=> 'Connexion à la base de données',
    'DB_ERR_INSERT'				=> 'Erreur lors du traitement de la requête <code>INSERT</code>.',
    'DB_ERR_LAST'				=> 'Erreur lors du traitement de <var>query_last</var>.',
    'DB_ERR_QUERY_FIRST'		=> 'Erreur lors de l'exécution de <var>query_first</var>.',
    'DB_ERR_QUERY_FIRST_TABLE'	=> 'Erreur lors de l'exécution de <var>query_first</var>, %s (« %s »).',
    'DB_ERR_SELECT'				=> 'Erreur lors de l'exécution de la requête <code>SELECT</code>.',
    'DB_HOST'					=> 'Nom d'hôte du serveur de base de données ou DSN',
    'DB_HOST_EXPLAIN'			=> 'DSN signifie Data Source Name et est uniquement pertinent pour les installations ODBC. Sur PostgreSQL, utilisez localhost pour vous connecter au serveur local via un socket de domaine UNIX et 127.0.0.1 pour vous connecter via TCP. Pour SQLite, entrez le chemin complet vers votre fichier de base de données.',
    'DB_NAME'					=> 'Nom de la base de données',
    'DB_PASSWORD'				=> 'Mot de passe de la base de données',
    'DB_PORT'					=> 'Port du serveur de base de données',
    'DB_PORT_EXPLAIN'			=> 'Laissez ce champ vide sauf si vous savez que le serveur fonctionne sur un port non standard.',
    'DB_UPDATE_NOT_SUPPORTED'	=> 'Nous sommes désolés, mais ce script ne supporte pas la mise à jour à partir de versions de phpBB antérieures à « %1$s ». La version actuellement installée est « %2$s ». Veuillez mettre à jour vers une version antérieure avant d'exécuter ce script. L'assistance est disponible sur le forum d'assistance sur phpBB.com.',
    'DB_USERNAME'				=> 'Nom d'utilisateur de la base de données',
    'DB_TEST'					=> 'Tester la connexion',
    'DEFAULT_LANG'				=> 'Langue du forum par défaut',
    'DEFAULT_PREFIX_IS'			=> 'Le convertisseur n'a pas pu trouver les tables avec le préfixe spécifié. Veuillez vous assurer que vous avez saisi les bonnes informations pour le forum que vous souhaitez convertir. Le préfixe de table par défaut pour %1$s est <strong>%2$s</strong>.',
    'DEV_NO_TEST_FILE'			=> 'Aucune valeur n'a été spécifiée pour la variable test_file du convertisseur. Si vous êtes un utilisateur de ce convertisseur, vous ne devriez pas voir cette erreur. Veuillez signaler ce message à l'auteur du convertisseur. Si vous êtes un auteur de convertisseur, vous devez spécifier le nom d'un fichier qui existe dans le forum source pour permettre la vérification du chemin d'accès.',
    'DIRECTORIES_AND_FILES'		=> 'Configuration des répertoires et fichiers',
    'DISABLE_KEYS'				=> 'Désactivation des clés',
    'DLL_FIREBIRD'				=> 'Firebird',
    'DLL_FTP'					=> 'Support FTP distant [ Installation ]',
    'DLL_GD'					=> 'Support des graphiques GD [ Confirmation visuelle ]',
    'DLL_MBSTRING'				=> 'Support des caractères multi-octets',
    'DLL_MSSQL'					=> 'MSSQL Server 2000+',
    'DLL_MSSQL_ODBC'			=> 'MSSQL Server 2000+ via ODBC',
    'DLL_MSSQLNATIVE'			=> 'MSSQL Server 2005+ [ Natif ]',
    'DLL_MYSQL'					=> 'MySQL',
    'DLL_MYSQLI'				=> 'MySQL avec extension MySQLi',
    'DLL_ORACLE'				=> 'Oracle',
    'DLL_POSTGRES'				=> 'PostgreSQL',
    'DLL_SQLITE'				=> 'SQLite',
    'DLL_XML'					=> 'Support XML [ Jabber ]',
    'DLL_ZLIB'					=> 'Support de la compression zlib [ gz, .tar.gz, .zip ]',
    'DL_CONFIG'					=> 'Télécharger la configuration',
    'DL_CONFIG_EXPLAIN'			=> 'Vous pouvez télécharger le fichier config.php complet sur votre propre PC. Vous devrez ensuite téléverser le fichier manuellement, en remplaçant tout config.php existant dans votre répertoire racine phpBB 3.0. N'oubliez pas de téléverser le fichier au format ASCII (consultez la documentation de votre application FTP si vous n'êtes pas sûr). Lorsque vous avez téléversé config.php, cliquez sur « Terminer » pour passer à l'étape suivante.',
    'DL_DOWNLOAD'				=> 'Télécharger',
    'DONE'						=> 'Terminer',

    'ENABLE_KEYS'				=> 'Réactivation des clés. Cela peut prendre un certain temps.',

    'FILES_OPTIONAL'			=> 'Fichiers et répertoires optionnels',
    'FILES_OPTIONAL_EXPLAIN'	=> '<strong>Optionnel</strong> - Ces fichiers, répertoires ou paramètres de permission ne sont pas requis. Le système d'installation tentera d'utiliser diverses techniques pour les créer s'ils n'existent pas ou ne sont pas inscriptibles. Cependant, leur présence accélèrera l'installation.',
    'FILES_REQUIRED'			=> 'Fichiers et répertoires',
    'FILES_REQUIRED_EXPLAIN'	=> '<strong>Requis</strong> - Pour que phpBB fonctionne correctement, il doit pouvoir accéder ou écrire dans certains fichiers ou répertoires. Si vous voyez « Non trouvé », vous devez créer le fichier ou le répertoire pertinent. Si vous voyez « Non inscriptible », vous devez modifier les permissions sur le fichier ou le répertoire pour permettre à phpBB d'y écrire.',
    'FILLING_TABLE'				=> 'Remplissage de la table <strong>%s</strong>',
    'FILLING_TABLES'			=> 'Remplissage des tables',

    'FIREBIRD_DBMS_UPDATE_REQUIRED'		=> 'phpBB ne supporte plus Firebird/Interbase antérieur à la version 2.1. Veuillez mettre à jour votre installation Firebird à au moins 2.1.0 avant de procéder à la mise à jour.',

    'FINAL_STEP'				=> 'Traiter l'étape finale',
    'FORUM_ADDRESS'				=> 'Adresse du forum',
    'FORUM_ADDRESS_EXPLAIN'		=> 'C'est l'URL de votre ancien forum, par exemple <samp>http://www.example.com/phpBB2/</samp>. Si une adresse est saisie ici et non laissée vide, chaque occurrence de cette adresse sera remplacée par l'adresse de votre nouveau forum dans les messages, les messages privés et les signatures.',
    'FORUM_PATH'				=> 'Chemin du forum',
    'FORUM_PATH_EXPLAIN'		=> 'C'est le chemin <strong>relatif</strong> sur disque vers votre ancien forum depuis <strong>la racine de cette installation phpBB3</strong>.',
    'FOUND'						=> 'Trouvé',
    'FTP_CONFIG'				=> 'Transférer la configuration par FTP',
    'FTP_CONFIG_EXPLAIN'		=> 'phpBB a détecté la présence du module FTP sur ce serveur. Vous pouvez essayer d'installer votre config.php via celui-ci si vous le souhaitez. Vous devrez fournir les informations énumérées ci-dessous. N'oubliez pas que votre nom d'utilisateur et votre mot de passe sont ceux de votre serveur ! (contactez votre hébergeur si vous n'êtes pas sûr).',
    'FTP_PATH'					=> 'Chemin FTP',
    'FTP_PATH_EXPLAIN'			=> 'C'est le chemin à partir de votre répertoire racine vers celui de phpBB, par exemple <samp>htdocs/phpBB3/</samp>.',
    'FTP_UPLOAD'				=> 'Téléverser',

    'GPL'						=> 'General Public License',

    'INITIAL_CONFIG'			=> 'Configuration de base',
    'INITIAL_CONFIG_EXPLAIN'	=> 'Maintenant que l'installation a déterminé que votre serveur peut exécuter phpBB, vous devez fournir des informations spécifiques. Si vous ne savez pas comment vous connecter à votre base de données, veuillez contacter votre hébergeur en premier lieu ou utiliser les forums d'assistance phpBB. Lors de la saisie des données, veuillez les vérifier attentivement avant de continuer.',
    'INSTALL_CONGRATS'			=> 'Félicitations !',
    'INSTALL_CONGRATS_EXPLAIN'	=> '
        Vous avez installé avec succès IntegraMOD %1$s. Veuillez continuer en choisissant l'une des options suivantes :</p>
        <h2>Convertir un forum existant vers IntegraMOD3</h2>
        <p>Le framework de conversion unifié phpBB supporte la conversion de phpBB 2.0.x et d'autres systèmes de forum vers IntegraMOD3. Si vous avez un forum existant que vous souhaitez convertir, <a href="%2$s">veuillez procéder au convertisseur</a>.</p>
        <h2>Mettez IntegraMOD3 en ligne !</h2>
        <p><strong>Veuillez supprimer, déplacer ou renommer le répertoire install avant d'utiliser votre forum. Tant que ce répertoire existe, seul le panneau de contrôle d'administration (ACP) sera accessible.</strong>',
    'INSTALL_INTRO'				=> 'Bienvenue à l'installation',

    'INSTALL_INTRO_BODY'		=> 'Avec cette option, il est possible d'installer IntegraMOD sur votre serveur.</p><p>Pour continuer, vous aurez besoin de vos paramètres de base de données. Si vous ne connaissez pas vos paramètres de base de données, veuillez contacter votre hébergeur et les demander. Vous ne pourrez pas continuer sans eux. Vous avez besoin de :</p>

    <ul>
        <li>Le type de base de données - la base de données que vous utiliserez.</li>
        <li>Le nom d'hôte du serveur de base de données ou DSN - l'adresse du serveur de base de données.</li>
        <li>Le port du serveur de base de données - le port du serveur de base de données (généralement non requis).</li>
        <li>Le nom de la base de données - le nom de la base de données sur le serveur.</li>
        <li>Le nom d'utilisateur et le mot de passe de la base de données - les données de connexion pour accéder à la base de données.</li>
    </ul>

    <p><strong>Remarque :</strong> si vous installez à l'aide de SQLite, vous devez entrer le chemin complet vers votre fichier de base de données dans le champ DSN et laisser les champs nom d'utilisateur et mot de passe vides. Pour des raisons de sécurité, vous devriez vous assurer que le fichier de base de données n'est pas stocké dans un endroit accessible à partir du web.</p>

    <p>IntegraMOD supporte les bases de données suivantes :</p>
    <ul>
        <li>MySQL 3.23 ou supérieur (MySQLi supporté)</li>
        <li>PostgreSQL 7.3+</li>
        <li>SQLite 2.8.2+</li>
        <li>Firebird 2.1+</li>
        <li>MS SQL Server 2000 ou supérieur (directement ou via ODBC)</li>
        <li>MS SQL Server 2005 ou supérieur (natif)</li>
        <li>Oracle</li>
    </ul>

    <p>Seules les bases de données supportées sur votre serveur seront affichées.',
    'INSTALL_INTRO_NEXT'		=> 'Pour commencer l'installation, veuillez appuyer sur le bouton ci-dessous.',
    'INSTALL_LOGIN'				=> 'Connexion',
    'INSTALL_NEXT'				=> 'Étape suivante',
    'INSTALL_NEXT_FAIL'			=> 'Certains tests ont échoué et vous devriez corriger ces problèmes avant de passer à l'étape suivante. Ne pas le faire peut entraîner une installation incomplète.',
    'INSTALL_NEXT_PASS'			=> 'Tous les tests de base ont réussi et vous pouvez procéder à l'étape suivante de l'installation. Si vous avez modifié des permissions, des modules, etc. et souhaitez re-tester, vous pouvez le faire si vous le souhaitez.',
    'INSTALL_PANEL'				=> 'Panneau d'installation',
    'INSTALL_SEND_CONFIG'		=> 'Malheureusement, phpBB n'a pas pu écrire les informations de configuration directement dans votre config.php. Cela peut être parce que le fichier n'existe pas ou n'est pas inscriptible. Un certain nombre d'options seront énumérées ci-dessous vous permettant de terminer l'installation de config.php.',
    'INSTALL_START'				=> 'Commencer l'installation',
    'INSTALL_TEST'				=> 'Tester à nouveau',
    'INST_ERR'					=> 'Erreur d'installation',
    'INST_ERR_DB_CONNECT'		=> 'Impossible de se connecter à la base de données, voir le message d'erreur ci-dessous.',
    'INST_ERR_DB_FORUM_PATH'	=> 'Le fichier de base de données spécifié se trouve dans votre arborescence de répertoires du forum. Vous devriez placer ce fichier dans un emplacement non accessible par le web.',
    'INST_ERR_DB_INVALID_PREFIX'=> 'Le préfixe saisi est invalide. Il doit commencer par une lettre et ne contenir que des lettres, des chiffres et des traits de soulignement.',
    'INST_ERR_DB_NO_ERROR'		=> 'Aucun message d'erreur donné.',
    'INST_ERR_DB_NO_MYSQLI'		=> 'La version de MySQL installée sur cette machine est incompatible avec l'option « MySQL avec extension MySQLi » que vous avez sélectionnée. Veuillez essayer l'option « MySQL » à la place.',
    'INST_ERR_DB_NO_SQLITE'		=> 'La version de l'extension SQLite que vous avez installée est trop ancienne et doit être mise à niveau vers au moins 2.8.2.',
    'INST_ERR_DB_NO_ORACLE'		=> 'La version d'Oracle installée sur cette machine vous oblige à définir le paramètre <var>NLS_CHARACTERSET</var> à <var>UTF8</var>. Mettez à niveau votre installation vers 9.2+ ou modifiez le paramètre.',
    'INST_ERR_DB_NO_FIREBIRD'	=> 'La version de Firebird installée sur cette machine est antérieure à 2.1. Veuillez mettre à niveau vers une version plus récente.',
    'INST_ERR_DB_NO_FIREBIRD_PS'=> 'La base de données que vous avez sélectionnée pour Firebird a une taille de page inférieure à 8192 et doit être d'au moins 8192.',
    'INST_ERR_DB_NO_POSTGRES'	=> 'La base de données que vous avez sélectionnée n'a pas été créée avec l'encodage <var>UNICODE</var> ou <var>UTF8</var>. Essayez d'installer avec une base de données avec l'encodage <var>UNICODE</var> ou <var>UTF8</var>.',
    'INST_ERR_DB_NO_NAME'		=> 'Aucun nom de base de données spécifié.',
    'INST_ERR_EMAIL_INVALID'	=> 'L'adresse e-mail que vous avez saisie est invalide.',
    'INST_ERR_EMAIL_MISMATCH'	=> 'Les e-mails que vous avez saisis ne correspondent pas.',
    'INST_ERR_FATAL'			=> 'Erreur d'installation fatale',
    'INST_ERR_FATAL_DB'			=> 'Une erreur de base de données fatale et irréparable s'est produite. Cela peut être parce que l'utilisateur spécifié n'a pas les permissions appropriées pour <code>CREATE TABLES</code> ou <code>INSERT</code> des données, etc. Des informations supplémentaires peuvent être données ci-dessous. Veuillez d'abord contacter votre hébergeur ou les forums d'assistance de phpBB pour obtenir de l'aide supplémentaire.',
    'INST_ERR_FTP_PATH'			=> 'Impossible de passer au répertoire spécifié. Veuillez vérifier le chemin.',
    'INST_ERR_FTP_LOGIN'		=> 'Impossible de se connecter au serveur FTP. Vérifiez votre nom d'utilisateur et votre mot de passe.',
    'INST_ERR_MISSING_DATA'		=> 'Vous devez remplir tous les champs de ce bloc.',
    'INST_ERR_NO_DB'			=> 'Impossible de charger le module PHP pour le type de base de données sélectionné.',
    'INST_ERR_PASSWORD_MISMATCH'	=> 'Les mots de passe que vous avez saisis ne correspondent pas.',
    'INST_ERR_PASSWORD_TOO_LONG'	=> 'Le mot de passe que vous avez saisi est trop long. La longueur maximale est de 30 caractères.',
    'INST_ERR_PASSWORD_TOO_SHORT'	=> 'Le mot de passe que vous avez saisi est trop court. La longueur minimale est de 6 caractères.',
    'INST_ERR_PREFIX'			=> 'Les tables avec le préfixe spécifié existent déjà. Veuillez choisir une alternative.',
    'INST_ERR_PREFIX_INVALID'	=> 'Le préfixe de table que vous avez spécifié est invalide pour votre base de données. Veuillez essayer un autre, en supprimant les caractères comme le tiret.',
    'INST_ERR_PREFIX_TOO_LONG'	=> 'Le préfixe de table que vous avez spécifié est trop long. La longueur maximale est de %d caractères.',
    'INST_ERR_USER_TOO_LONG'	=> 'Le nom d'utilisateur que vous avez saisi est trop long. La longueur maximale est de 20 caractères.',
    'INST_ERR_USER_TOO_SHORT'	=> 'Le nom d'utilisateur que vous avez saisi est trop court. La longueur minimale est de 3 caractères.',
    'INVALID_PRIMARY_KEY'		=> 'Clé primaire invalide : %s',

    'LONG_SCRIPT_EXECUTION'		=> 'Veuillez noter que cela peut prendre un certain temps... Veuillez ne pas arrêter le script.',

    // mbstring
    'MBSTRING_CHECK'						=> 'Vérification de l'extension <samp>mbstring</samp>',
    'MBSTRING_CHECK_EXPLAIN'				=> '<strong>Requis</strong> - <samp>mbstring</samp> est une extension PHP qui fournit des fonctions de chaînes multi-octets. Certaines fonctionnalités de mbstring ne sont pas compatibles avec phpBB et doivent être désactivées.',
    'MBSTRING_FUNC_OVERLOAD'				=> 'Surcharge de fonction',
    'MBSTRING_FUNC_OVERLOAD_EXPLAIN'		=> '<var>mbstring.func_overload</var> doit être défini sur 0 ou 4.',
    'MBSTRING_ENCODING_TRANSLATION'			=> 'Conversion transparente d'encodage de caractères',
    'MBSTRING_ENCODING_TRANSLATION_EXPLAIN'	=> '<var>mbstring.encoding_translation</var> doit être défini sur 0.',
    'MBSTRING_HTTP_INPUT'					=> 'Conversion de caractères d'entrée HTTP',
    'MBSTRING_HTTP_INPUT_EXPLAIN'			=> '<var>mbstring.http_input</var> doit être défini sur <samp>pass</samp>.',
    'MBSTRING_HTTP_OUTPUT'					=> 'Conversion de caractères de sortie HTTP',
    'MBSTRING_HTTP_OUTPUT_EXPLAIN'			=> '<var>mbstring.http_output</var> doit être défini sur <samp>pass</samp>.',

    'MAKE_FOLDER_WRITABLE'		=> 'Veuillez vous assurer que ce dossier existe et qu'il est inscriptible par le serveur web, puis réessayer:<br />»<strong>%s</strong>.',
    'MAKE_FOLDERS_WRITABLE'		=> 'Veuillez vous assurer que ces dossiers existent et qu'ils sont inscriptibles par le serveur web, puis réessayer:<br />»<strong>%s</strong>.',

    'MYSQL_SCHEMA_UPDATE_REQUIRED'	=> 'Votre schéma de base de données MySQL pour phpBB est obsolète. phpBB a détecté un schéma pour MySQL 3.x/4.x, mais le serveur fonctionne sur MySQL %2$s.<br /><strong>Avant de procéder à la mise à jour, vous devez mettre à niveau le schéma.</strong><br /><br />Veuillez vous reporter à l' <a href="https://www.phpbb.com/kb/article/doesnt-have-a-default-value-errors/">article de la base de connaissances sur la mise à niveau du schéma MySQL</a>. Si vous rencontrez des problèmes, veuillez utiliser <a href="https://www.phpbb.com/community/viewforum.php?f=46">nos forums d'assistance</a>.',

    'NAMING_CONFLICT'			=> 'Conflit de nom: %s et %s sont tous deux des alias<br /><br />%s',
    'NEXT_STEP'					=> 'Procéder à l'étape suivante',
    'NOT_FOUND'					=> 'Impossible de trouver',
    'NOT_UNDERSTAND'			=> 'Impossible de comprendre %s #%d, table %s (« %s »)',
    'NO_CONVERTORS'				=> 'Aucun convertisseur n'est disponible pour l'utilisation.',
    'NO_CONVERT_SPECIFIED'		=> 'Aucun convertisseur spécifié.',
    'NO_LOCATION'				=> 'Impossible de déterminer l'emplacement. Si vous savez qu'Imagemagick est installé, vous pouvez spécifier l'emplacement plus tard dans votre panneau de contrôle d'administration',
    'NO_TABLES_FOUND'			=> 'Aucune table trouvée.',

    'OVERVIEW_BODY' => 'Bienvenue sur IntegraMOD3!<br /><br />IntegraMOD3 est une distribution phpBB3.0.x entièrement intégrée construite sur phpBB3.0.15. Il combine phpBB avec une grande collection de modifications soigneusement intégrées, des fonctionnalités de portail et des améliorations communautaires dans un seul package unifié. phpBB® est l'une des solutions de tableau de bord les plus utilisées au monde, connue pour sa stabilité, sa flexibilité et son ensemble de fonctionnalités riche.<br /><br />IntegraMOD3 comprend KISS Portal©, le système de portail phpBB3 original et l'une des premières grandes modifications développées pendant les phases alpha et bêta de phpBB3. KISS Portal est en développement continu depuis 2005 et reste l'un des systèmes de portail les plus complets et les plus étroitement intégrés disponibles pour phpBB3. Malgré ses capacités étendues, la plupart des fonctionnalités peuvent être configurées facilement via le panneau de contrôle d'administration sans nécessiter de modifications de code.<br /><br />IntegraMOD3 comprend également de nombreuses fonctionnalités pré-intégrées et des améliorations conçues pour fournir une plateforme communautaire complète prête à l'emploi tout en maintenant la compatibilité avec le framework phpBB3.0.x.<br /><br />Ce système d'installation vous guidera dans l'installation d'IntegraMOD3, la mise à jour à partir de versions précédentes ou la conversion à partir d'un autre système de tableau de bord (y compris phpBB2). Pour plus d'informations, veuillez lire <a href="../docs/INSTALL.html">le guide d'installation</a>.<br /><br />Pour lire la licence phpBB3 ou en savoir plus sur l'obtention du support, veuillez sélectionner les options respectives dans le menu latéral. Pour continuer, veuillez sélectionner l'onglet approprié ci-dessus.',

    'PCRE_UTF_SUPPORT'				=> 'Support PCRE UTF-8',
    'PCRE_UTF_SUPPORT_EXPLAIN'		=> 'phpBB ne s'exécutera <strong>pas</strong> si votre installation PHP n'est pas compilée avec le support UTF-8 dans l'extension PCRE.',
    'PHP_GETIMAGESIZE_SUPPORT'			=> 'La fonction PHP getimagesize() est disponible',
    'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> '<strong>Requis</strong> - Pour que phpBB fonctionne correctement, la fonction getimagesize doit être disponible.',
    'PHP_OPTIONAL_MODULE'			=> 'Modules optionnels',
    'PHP_OPTIONAL_MODULE_EXPLAIN'	=> '<strong>Optionnel</strong> - Ces modules ou applications sont optionnels. Cependant, s'ils sont disponibles, ils activent des fonctionnalités supplémentaires.',
    'PHP_SUPPORTED_DB'				=> 'Bases de données supportées',
    'PHP_SUPPORTED_DB_EXPLAIN'		=> '<strong>Requis</strong> - Vous devez avoir le support pour au moins une base de données compatible dans PHP. Si aucun module de base de données n'est affiché comme disponible, vous devez contacter votre hébergeur ou consulter la documentation d'installation PHP pertinente pour obtenir des conseils.',
    'PHP_REGISTER_GLOBALS'			=> 'Le paramètre PHP <var>register_globals</var> est désactivé',
    'PHP_REGISTER_GLOBALS_EXPLAIN'	=> 'phpBB s'exécutera toujours si ce paramètre est activé, mais si possible, il est recommandé que register_globals soit désactivé dans votre installation PHP pour des raisons de sécurité.',
    'PHP_SAFE_MODE'					=> 'Mode sécurisé',
    'PHP_SETTINGS'					=> 'Version et paramètres PHP',
    'PHP_SETTINGS_EXPLAIN'			=> '<strong>Requis</strong> - Vous devez exécuter au moins la version 7.0 de PHP pour installer IntegraMOD. Si le <var>mode sécurisé</var> s'affiche ci-dessous, votre installation PHP s'exécute dans ce mode. Cela imposera des limitations à l'administration à distance et des fonctionnalités similaires.',
    'PHP_URL_FOPEN_SUPPORT'			=> 'Le paramètre PHP <var>allow_url_fopen</var> est activé',
    'PHP_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Optionnel</strong> - Ce paramètre est optionnel. Cependant, certaines fonctions phpBB comme les avatars hors site ne fonctionneront pas correctement sans lui.',
    'PHP_VERSION_REQD'				=> 'Version PHP >= 7.0',
    'POST_ID'						=> 'ID du message',
    'PREFIX_FOUND'					=> 'Une analyse de vos tables a montré une installation valide utilisant <strong>%s</strong> comme préfixe de table.',
    'PREPROCESS_STEP'				=> 'Exécution des fonctions/requêtes de pré-traitement',
    'PRE_CONVERT_COMPLETE'			=> 'Toutes les étapes de pré-conversion ont été complétées avec succès. Vous pouvez maintenant commencer le processus de conversion réel. Notez que vous devrez peut-être effectuer et ajuster manuellement plusieurs choses. Après la conversion, vérifiez particulièrement les permissions assignées, reconstruisez votre index de recherche qui n'est pas converti et assurez-vous que les fichiers ont été copiés correctement, par exemple les avatars et les smilies.',
    'PROCESS_LAST'					=> 'Traitement des dernières déclarations',

    'REFRESH_PAGE'				=> 'Actualisez la page pour continuer la conversion',
    'REFRESH_PAGE_EXPLAIN'		=> 'Si défini sur oui, le convertisseur actualisera la page pour continuer la conversion après avoir terminé une étape. Si c'est votre première conversion à titre d'essai et pour déterminer les erreurs à l'avance, nous vous suggérons de le définir sur Non.',
    'REQUIREMENTS_TITLE'		=> 'Compatibilité d'installation',
    'REQUIREMENTS_EXPLAIN'		=> 'Avant de procéder à l'installation complète, IntegraMOD effectuera certains tests sur la configuration et les fichiers de votre serveur pour s'assurer que vous pouvez installer et exécuter IntegraMOD. Veuillez vous assurer de lire attentivement les résultats et de ne pas continuer jusqu'à ce que tous les tests requis soient réussis. Si vous souhaitez utiliser l'une des fonctionnalités dépendantes des tests optionnels, vous devez vous assurer que ces tests sont également réussis.',
    'RETRY_WRITE'				=> 'Réessayer d'écrire la configuration',
    'RETRY_WRITE_EXPLAIN'		=> 'Si vous le souhaitez, vous pouvez modifier les permissions sur config.php pour permettre à phpBB d'y écrire. Si vous souhaitez faire cela, vous pouvez cliquer sur Réessayer ci-dessous pour essayer à nouveau. N'oubliez pas de restaurer les permissions sur config.php après la fin de l'installation de phpBB.',

    'SCRIPT_PATH'				=> 'Chemin du script',
    'SCRIPT_PATH_EXPLAIN'		=> 'Le chemin où phpBB est situé par rapport au nom de domaine, par exemple <samp>/phpBB3</samp>.',
    'SELECT_LANG'				=> 'Sélectionner la langue',
    'SERVER_CONFIG'				=> 'Configuration du serveur',
    'SEARCH_INDEX_UNCONVERTED'	=> 'L'index de recherche n'a pas été converti',
    'SEARCH_INDEX_UNCONVERTED_EXPLAIN'	=> 'Votre ancien index de recherche n'a pas été converti. La recherche donnera toujours un résultat vide. Pour créer un nouvel index de recherche, allez au panneau de contrôle d'administration, sélectionnez Maintenance, puis choisissez Index de recherche dans le sous-menu.',
    'SOFTWARE'					=> 'Logiciel de forum',
    'SPECIFY_OPTIONS'			=> 'Spécifier les options de conversion',
    'STAGE_ADMINISTRATOR'		=> 'Détails de l'administrateur',
    'STAGE_ADVANCED'			=> 'Paramètres avancés',
    'STAGE_ADVANCED_EXPLAIN'	=> 'Les paramètres de cette page ne sont nécessaires à définir que si vous savez que vous avez besoin de quelque chose de différent de la valeur par défaut. Si vous n'êtes pas sûr, passez simplement à la page suivante, car ces paramètres peuvent être modifiés à partir du panneau de contrôle d'administration ultérieurement.',
    'STAGE_CONFIG_FILE'			=> 'Fichier de configuration',
    'STAGE_CREATE_TABLE'		=> 'Créer des tables de base de données',
    'STAGE_CREATE_TABLE_EXPLAIN'	=> 'Les tables de base de données utilisées par integraMOD3 ont été créées et remplies avec quelques données initiales. Passez à l'écran suivant pour terminer l'installation de phpBB.',
    'STAGE_DATABASE'			=> 'Paramètres de la base de données',
    'STAGE_SN_INSTALL'          => 'Installer le réseau social',
    'STAGE_FINAL'				=> 'Étape finale',
    'STAGE_INTRO'				=> 'Introduction',
    'STAGE_IN_PROGRESS'			=> 'Conversion en cours',
    'STAGE_REQUIREMENTS'		=> 'Exigences',
    'STAGE_SETTINGS'			=> 'Paramètres',
    'STARTING_CONVERT'			=> 'Démarrage du processus de conversion',
    'STEP_PERCENT_COMPLETED'	=> 'Étape <strong>%d</strong> sur <strong>%d</strong>',
    'SUB_INTRO'					=> 'Introduction',
    'SUB_LICENSE'				=> 'Licence',
    'SUB_SUPPORT'				=> 'Support',
    'SUCCESSFUL_CONNECT'		=> 'Connexion réussie',
    'SUPPORT_BODY'				=> 'Une assistance complète sera fournie pour la version stable actuelle d'IntegraMOD3, gratuitement. Cela inclut :</p><ul><li>installation</li><li>configuration</li><li>questions techniques</li><li>problèmes liés à des bogues potentiels du logiciel</li><li>mise à jour des versions Release Candidate (RC) vers la dernière version stable</li><li>conversion de phpBB 2.0.x vers IntegraMOD3</li><li>conversion d'autres logiciels de tableau de bord vers IntegraMOD3 (veuillez consulter le <a href="https://www.phpbb.com/community/viewforum.php?f=65">Forum des convertisseurs</a>)</li></ul><p>Nous encourageons les utilisateurs exécutant toujours des versions bêta d'IntegraMOD3 à remplacer leur installation par une copie fraîche de la dernière version.</p><h2>MODs / Styles</h2><p>Pour les problèmes liés aux MODs, veuillez publier sur le <a href="https://integramod.com/forum/viewforum.php?f=84">forum des modifications</a> approprié.<br />Pour les problèmes liés aux styles, modèles et ensembles d'images, veuillez publier sur le <a href="https://www.phpbb.com/community/viewforum.php?f=80">forum des styles</a> approprié.<br /><br />Si votre question concerne un package spécifique, veuillez publier directement sur le sujet dédié au package.</p><h2>Obtenir du support</h2><p><a href="https://www.phpbb.com/community/viewtopic.php?f=14&amp;t=571070">Le package de bienvenue phpBB</a><br /><a href="https://www.phpbb.com/support/">Section de support</a><br /><a href="https://www.phpbb.com/support/documentation/3.0/quickstart/">Guide de démarrage rapide</a><br /><br />Pour rester à jour avec les dernières nouvelles et versions, pourquoi ne pas <a href="https://www.phpbb.com/support/">vous abonner à notre liste de diffusion</a>?<br /><br />',
    'SYNC_FORUMS'				=> 'Démarrage de la synchronisation des forums',
    'SYNC_POST_COUNT'			=> 'Synchronisation des compteurs de messages',
    'SYNC_POST_COUNT_ID'		=> 'Synchronisation des compteurs de messages de <var>l'entrée</var> %1$s à %2$s.',
    'SYNC_TOPICS'				=> 'Démarrage de la synchronisation des sujets',
    'SYNC_TOPIC_ID'				=> 'Synchronisation des sujets de <var>l'ID du sujet</var> %1$s à %2$s.',

    'TABLES_MISSING'			=> 'Impossible de trouver ces tables<br />» <strong>%s</strong>.',
    'TABLE_PREFIX'				=> 'Préfixe pour les tables de la base de données',
    'TABLE_PREFIX_EXPLAIN'		=> 'Le préfixe doit commencer par une lettre et ne contenir que des lettres, des chiffres et des traits de soulignement.',
    'TABLE_PREFIX_SAME'			=> 'Le préfixe de table doit être celui utilisé par le logiciel que vous convertissez.<br />» Le préfixe de table spécifié était %s.',
    'TESTS_PASSED'				=> 'Tests réussis',
    'TESTS_FAILED'				=> 'Tests échoués',

    'UNABLE_WRITE_LOCK'			=> 'Impossible d'écrire le fichier de verrouillage.',
    'UNAVAILABLE'				=> 'Non disponible',
    'UNWRITABLE'				=> 'Non inscriptible',
    'UPDATE_TOPICS_POSTED'		=> 'Génération des informations sur les sujets publiés',
    'UPDATE_TOPICS_POSTED_ERR'	=> 'Une erreur s'est produite lors de la génération des informations sur les sujets publiés. Vous pouvez réessayer cette étape dans l'ACP après la fin du processus de conversion.',
    'VERIFY_OPTIONS'			=> 'Vérification des options de conversion',
    'VERSION'					=> 'Version',

    'WELCOME_INSTALL'			=> 'Bienvenue à l'installation d'IntegraMOD',
    'WRITABLE'					=> 'Inscriptible',
));

// Updater
$lang = array_merge($lang, array(
    'ALL_FILES_UP_TO_DATE'		=> 'Tous les fichiers sont à jour avec la dernière version de phpBB. Vous devriez maintenant <a href="../ucp.php?mode=login">vous connecter à votre forum</a> et vérifier que tout fonctionne correctement. N'oubliez pas de supprimer, renommer ou déplacer votre répertoire d'installation ! Veuillez nous envoyer les informations mises à jour sur votre configuration de serveur et de forum à partir du module <a href="../ucp.php?mode=login&amp;redirect=adm/index.php%3Fi=send_statistics%26mode=send_statistics">Envoyer les statistiques</a> dans votre ACP.',
    'ARCHIVE_FILE'				=> 'Fichier source dans l'archive',

    'BACK'				=> 'Retour',
    'BINARY_FILE'		=> 'Fichier binaire',
    'BOT'				=> 'Araignée/Robot',

    'CHANGE_CLEAN_NAMES'			=> 'La méthode utilisée pour s'assurer qu'un nom d'utilisateur n'est pas utilisé par plusieurs utilisateurs a changé. Il y a certains utilisateurs qui ont le même nom lorsqu'ils sont comparés avec la nouvelle méthode. Vous devez supprimer ou renommer ces utilisateurs pour vous assurer que chaque nom n'est utilisé que par un seul utilisateur avant de pouvoir continuer.',
    'CHECK_FILES'					=> 'Vérifier les fichiers',
    'CHECK_FILES_AGAIN'				=> 'Vérifier les fichiers à nouveau',
    'CHECK_FILES_EXPLAIN'			=> 'Dans l'étape suivante, tous les fichiers seront vérifiés par rapport aux fichiers de mise à jour - cela peut prendre un certain temps s'il s'agit du premier contrôle de fichier.',
    'CHECK_FILES_UP_TO_DATE'		=> 'Selon votre base de données, votre version est à jour. Vous pouvez vouloir procéder à la vérification des fichiers pour vous assurer que tous les fichiers sont vraiment à jour avec la dernière version de phpBB.',
    'CHECK_UPDATE_DATABASE'			=> 'Continuer le processus de mise à jour',
    'COLLECTED_INFORMATION'			=> 'Informations sur les fichiers',
    'COLLECTED_INFORMATION_EXPLAIN'	=> 'La liste ci-dessous affiche des informations sur les fichiers qui doivent être mis à jour. Veuillez lire les informations devant chaque bloc de statut pour voir ce qu'elles signifient et ce que vous devrez peut-être faire pour effectuer une mise à jour réussie.',
    'COLLECTING_FILE_DIFFS'			=> 'Collecte des différences de fichiers',
    'COMPLETE_LOGIN_TO_BOARD'		=> 'Vous devriez maintenant <a href="../ucp.php?mode=login">vous connecter à votre forum</a> et vérifier que tout fonctionne correctement. N'oubliez pas de supprimer, renommer ou déplacer votre répertoire d'installation !',
    'CONTINUE_UPDATE_NOW'			=> 'Continuer le processus de mise à jour maintenant',
    'CONTINUE_UPDATE'				=> 'Continuer la mise à jour maintenant',
    'CURRENT_FILE'					=> 'Début du conflit - Code de fichier original avant la mise à jour',
    'CURRENT_VERSION'				=> 'Version actuelle',

    'DATABASE_TYPE'						=> 'Type de base de données',
    'DATABASE_UPDATE_INFO_OLD'			=> 'Le fichier de mise à jour de la base de données dans le répertoire d'installation est obsolète. Veuillez vous assurer que vous avez téléversé la version correcte du fichier.',
    'DELETE_USER_REMOVE'				=> 'Supprimer l'utilisateur et les messages',
    'DELETE_USER_RETAIN'				=> 'Supprimer l'utilisateur mais conserver les messages',
    'DESTINATION'						=> 'Fichier de destination',
    'DIFF_INLINE'						=> 'En ligne',
    'DIFF_RAW'							=> 'Diff unifié brut',
    'DIFF_SEP_EXPLAIN'					=> 'Bloc de code utilisé dans le fichier mis à jour/nouveau',
    'DIFF_SIDE_BY_SIDE'					=> 'Côte à côte',
    'DIFF_UNIFIED'						=> 'Diff unifié',
    'DO_NOT_UPDATE'						=> 'Ne pas mettre à jour ce fichier',
    'DONE'								=> 'Terminer',
    'DOWNLOAD'							=> 'Télécharger',
    'DOWNLOAD_AS'						=> 'Télécharger en tant que',
    'DOWNLOAD_UPDATE_METHOD_BUTTON'		=> 'Télécharger l'archive des fichiers modifiés (recommandé)',
    'DOWNLOAD_CONFLICTS'				=> 'Télécharger les conflits pour ce fichier',
    'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Recherchez &lt;&lt;&lt; pour repérer les conflits',
    'DOWNLOAD_UPDATE_METHOD'			=> 'Télécharger l'archive des fichiers modifiés',
    'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Une fois téléchargé, vous devez décompresser l'archive. Vous trouverez les fichiers modifiés que vous devez téléverser vers votre répertoire racine phpBB. Veuillez téléverser les fichiers à leurs emplacements respectifs. Après avoir téléversé tous les fichiers, veuillez vérifier les fichiers à nouveau avec l'autre bouton ci-dessous.',

    'ERROR'			=> 'Erreur',
    'EDIT_USERNAME'	=> 'Modifier le nom d'utilisateur',

    'FILE_ALREADY_UP_TO_DATE'		=> 'Le fichier est déjà à jour.',
    'FILE_DIFF_NOT_ALLOWED'			=> 'Fichier non autorisé à être comparé.',
    'FILE_USED'						=> 'Informations utilisées de',
    'FILES_CONFLICT'				=> 'Fichiers en conflit',
    'FILES_CONFLICT_EXPLAIN'		=> 'Les fichiers suivants sont modifiés et ne représentent pas les fichiers originaux de l'ancienne version. phpBB a déterminé que ces fichiers créent des conflits s'ils sont fusionnés. Veuillez enquêter sur les conflits et essayer de les résoudre manuellement ou continuer la mise à jour en choisissant la méthode de fusion préférée. Si vous résolvez les conflits manuellement, vérifiez les fichiers à nouveau après les avoir modifiés. Vous pouvez également choisir la méthode de fusion préférée pour chaque fichier. Le premier entraînera un fichier où les lignes conflictuelles de votre ancien fichier seront perdues. L'autre entraînera la perte des modifications du fichier plus récent.',
    'FILES_MODIFIED'				=> 'Fichiers modifiés',
    'FILES_MODIFIED_EXPLAIN'		=> 'Les fichiers suivants sont modifiés et ne représentent pas les fichiers originaux de l'ancienne version. Le fichier mis à jour sera une fusion entre vos modifications et le nouveau fichier.',
    'FILES_NEW'						=> 'Nouveaux fichiers',
    'FILES_NEW_EXPLAIN'				=> 'Les fichiers suivants n'existent pas actuellement dans votre installation. Ces fichiers seront ajoutés à votre installation.',
    'FILES_NEW_CONFLICT'			=> 'Nouveaux fichiers en conflit',
    'FILES_NEW_CONFLICT_EXPLAIN'	=> 'Les fichiers suivants sont nouveaux dans la dernière version, mais il a été déterminé qu'un fichier portant le même nom existe déjà au même endroit. Ce fichier sera écrasé par le nouveau fichier.',
    'FILES_NOT_MODIFIED'			=> 'Fichiers non modifiés',
    'FILES_NOT_MODIFIED_EXPLAIN'	=> 'Les fichiers suivants ne sont pas modifiés et représentent les fichiers phpBB originaux de la version à partir de laquelle vous souhaitez mettre à jour.',
    'FILES_UP_TO_DATE'				=> 'Fichiers déjà mis à jour',
    'FILES_UP_TO_DATE_EXPLAIN'		=> 'Les fichiers suivants sont déjà à jour et n'ont pas besoin d'être mis à jour.',
    'FTP_SETTINGS'					=> 'Paramètres FTP',
    'FTP_UPDATE_METHOD'				=> 'Téléversement FTP',

    'INCOMPATIBLE_UPDATE_FILES'		=> 'Les fichiers de mise à jour trouvés sont incompatibles avec votre version installée. Votre version installée est %1$s et le fichier de mise à jour est pour la mise à jour de phpBB %2$s vers %3$s.',
    'INCOMPLETE_UPDATE_FILES'		=> 'Les fichiers de mise à jour sont incomplets.',
    'INLINE_UPDATE_SUCCESSFUL'		=> 'La mise à jour de la base de données a réussi. Vous devez maintenant continuer le processus de mise à jour.',

    'KEEP_OLD_NAME'		=> 'Garder l'ancien nom d'utilisateur',

    'LATEST_VERSION'		=> 'Dernière version',
    'LINE'					=> 'Ligne',
    'LINE_ADDED'			=> 'Ajouté',
    'LINE_MODIFIED'			=> 'Modifié',
    'LINE_REMOVED'			=> 'Supprimé',
    'LINE_UNMODIFIED'		=> 'Non modifié',
    'LOGIN_UPDATE_EXPLAIN'	=> 'Pour mettre à jour votre installation, vous devez d'abord vous connecter.',

    'MAPPING_FILE_STRUCTURE'	=> 'Pour faciliter le téléversement, voici les emplacements de fichiers qui correspondent à votre installation phpBB.',

    'MERGE_MODIFICATIONS_OPTION'	=> 'Fusionner les modifications',

    'MERGE_NO_MERGE_NEW_OPTION'	=> 'Ne pas fusionner - utiliser le nouveau fichier',
    'MERGE_NO_MERGE_MOD_OPTION'	=> 'Ne pas fusionner - utiliser le fichier actuellement installé',
    'MERGE_MOD_FILE_OPTION'		=> 'Fusionner les modifications (supprime le nouveau code phpBB dans le bloc conflictuel)',
    'MERGE_NEW_FILE_OPTION'		=> 'Fusionner les modifications (supprime le code modifié dans le bloc conflictuel)',
    'MERGE_SELECT_ERROR'		=> 'Les modes de fusion de fichiers conflictuels ne sont pas correctement sélectionnés.',
    'MERGING_FILES'				=> 'Fusion des différences',
    'MERGING_FILES_EXPLAIN'		=> 'Collecte actuellement les modifications de fichiers finales.<br /><br />Veuillez patienter jusqu'à ce que phpBB ait terminé toutes les opérations sur les fichiers modifiés.',

    'NEW_FILE'						=> 'Fin du conflit',
    'NEW_USERNAME'					=> 'Nouveau nom d'utilisateur',
    'NO_AUTH_UPDATE'				=> 'Non autorisé à mettre à jour',
    'NO_ERRORS'						=> 'Pas d'erreurs',
    'NO_UPDATE_FILES'				=> 'Les fichiers suivants ne sont pas mis à jour',
    'NO_UPDATE_FILES_EXPLAIN'		=> 'Les fichiers suivants sont nouveaux ou modifiés, mais le répertoire où ils résident normalement n'a pas pu être trouvé dans votre installation. Si cette liste contient des fichiers vers d'autres répertoires que language/ ou styles/, vous avez peut-être modifié votre structure de répertoires et la mise à jour peut être incomplète.',
    'NO_UPDATE_FILES_OUTDATED'		=> 'Aucun répertoire de mise à jour valide n'a été trouvé. Veuillez vous assurer d'avoir téléversé les fichiers pertinents.<br /><br />Votre installation ne semble <strong>pas</strong> être à jour. Des mises à jour sont disponibles pour votre version de phpBB %1$s. Veuillez visiter <a href="https://www.phpbb.com/downloads/" rel="external">https://www.phpbb.com/downloads/</a> pour obtenir le bon package pour mettre à jour de la version %2$s à la version %3$s.',
    'NO_UPDATE_FILES_UP_TO_DATE'	=> 'Votre version est à jour. Il n'est pas nécessaire d'exécuter l'outil de mise à jour. Si vous souhaitez effectuer une vérification d'intégrité sur vos fichiers, assurez-vous d'avoir téléversé les fichiers de mise à jour corrects.',
    'NO_UPDATE_INFO'				=> 'Les informations du fichier de mise à jour n'ont pas pu être trouvées.',
    'NO_UPDATES_REQUIRED'			=> 'Aucune mise à jour requise',
    'NO_VISIBLE_CHANGES'			=> 'Aucun changement visible',
    'NOTICE'						=> 'Avis',
    'NUM_CONFLICTS'					=> 'Nombre de conflits',
    'NUMBER_OF_FILES_COLLECTED'		=> 'Actuellement les différences de %1$d de %2$d fichiers ont été vérifiées.<br />Veuillez patienter jusqu'à ce que tous les fichiers soient vérifiés.',

    'OLD_UPDATE_FILES'		=> 'Les fichiers de mise à jour sont obsolètes. Les fichiers de mise à jour trouvés sont pour la mise à jour de phpBB %1$s vers phpBB %2$s mais la dernière version de phpBB est %3$s.',

    'PACKAGE_UPDATES_TO'				=> 'Le package actuel est mis à jour vers la version',
    'PERFORM_DATABASE_UPDATE'			=> 'Effectuer la mise à jour de la base de données',
    'PERFORM_DATABASE_UPDATE_EXPLAIN'	=> 'Ci-dessous, vous trouverez un bouton pour le script de mise à jour de la base de données. La mise à jour de la base de données peut prendre un certain temps, veuillez donc ne pas arrêter l'exécution si elle semble se suspendre. Après la mise à jour de la base de données, suivez simplement les instructions pour continuer le processus de mise à jour.',
    'PREVIOUS_VERSION'					=> 'Version précédente',
    'PROGRESS'							=> 'Progrès',

    'RESULT'					=> 'Résultat',
    'RUN_DATABASE_SCRIPT'		=> 'Mettre à jour ma base de données maintenant',

    'SELECT_DIFF_MODE'			=> 'Sélectionner le mode diff',
    'SELECT_DOWNLOAD_FORMAT'	=> 'Sélectionner le format d'archive de téléchargement',
    'SELECT_FTP_SETTINGS'		=> 'Sélectionner les paramètres FTP',
    'SHOW_DIFF_CONFLICT'		=> 'Afficher les différences/conflits',
    'SHOW_DIFF_FINAL'			=> 'Afficher le fichier résultant',
    'SHOW_DIFF_MODIFIED'		=> 'Afficher les différences fusionnées',
    'SHOW_DIFF_NEW'				=> 'Afficher le contenu du fichier',
    'SHOW_DIFF_NEW_CONFLICT'	=> 'Afficher les différences',
    'SHOW_DIFF_NOT_MODIFIED'	=> 'Afficher les différences',
    'SOME_QUERIES_FAILED'		=> 'Certaines requêtes ont échoué. Les instructions et les erreurs sont énumérées ci-dessous.',
    'SQL'						=> 'SQL',
    'SQL_FAILURE_EXPLAIN'		=> 'Cela n'est probablement pas un problème auquel s'inquiéter. La mise à jour continuera. Si cela ne parvient pas à se terminer, vous devrez peut-être demander de l'aide sur nos forums d'assistance. Voir <a href="../docs/README.html">README</a> pour les détails sur la façon d'obtenir des conseils.',
    'STAGE_FILE_CHECK'			=> 'Vérifier les fichiers',
    'STAGE_UPDATE_DB'			=> 'Mettre à jour la base de données',
    'STAGE_UPDATE_FILES'		=> 'Mettre à jour les fichiers',
    'STAGE_VERSION_CHECK'		=> 'Vérification de la version',
    'STATUS_CONFLICT'			=> 'Fichier modifié produisant des conflits',
    'STATUS_MODIFIED'			=> 'Fichier modifié',
    'STATUS_NEW'				=> 'Nouveau fichier',
    'STATUS_NEW_CONFLICT'		=> 'Nouveau fichier en conflit',
    'STATUS_NOT_MODIFIED'		=> 'Fichier non modifié',
    'STATUS_UP_TO_DATE'			=> 'Fichier déjà mis à jour',

    'TOGGLE_DISPLAY'			=> 'Afficher/Masquer la liste des fichiers',
    'TRY_DOWNLOAD_METHOD'		=> 'Vous pouvez essayer la méthode de téléchargement des fichiers modifiés.<br />Cette méthode fonctionne toujours et est également le chemin de mise à jour recommandé.',
    'TRY_DOWNLOAD_METHOD_BUTTON'=> 'Essayez cette méthode maintenant',

    'UPDATE_COMPLETED'				=> 'Mise à jour terminée',
    'UPDATE_DATABASE'				=> 'Mettre à jour la base de données',
    'UPDATE_DATABASE_EXPLAIN'		=> 'À l'étape suivante, la base de données sera mise à jour.',
    'UPDATE_DATABASE_SCHEMA'		=> 'Mise à jour du schéma de base de données',
    'UPDATE_FILES'					=> 'Mettre à jour les fichiers',
    'UPDATE_FILES_NOTICE'			=> 'Veuillez vous assurer que vous avez également mis à jour vos fichiers de forum. Ce fichier met à jour uniquement votre base de données.',
    'UPDATE_INSTALLATION'			=> 'Mettre à jour l'installation phpBB',
    'UPDATE_INSTALLATION_EXPLAIN'	=> 'Avec cette option, il est possible de mettre à jour votre installation phpBB vers la dernière version.<br />Pendant le processus, tous vos fichiers seront vérifiés pour leur intégrité. Vous pouvez examiner toutes les différences et tous les fichiers avant la mise à jour.<br /><br />La mise à jour des fichiers elle-même peut être effectuée de deux manières différentes.</p><h2>Mise à jour manuelle</h2><p>Avec cette mise à jour, vous téléchargez uniquement votre ensemble personnel de fichiers modifiés pour vous assurer que vous ne perdez pas vos modifications de fichiers que vous avez peut-être effectuées. Après avoir téléchargé ce package, vous devez téléverser manuellement les fichiers à leur emplacement correct dans votre répertoire racine phpBB. Une fois fait, vous pouvez réexécuter l'étape de vérification des fichiers pour voir si vous avez déplacé les fichiers à leur emplacement correct.</p><h2>Mise à jour automatique avec FTP</h2><p>Cette méthode est similaire à la première, mais sans besoin de télécharger les fichiers modifiés et de les téléverser vous-même. Cela sera fait pour vous. Pour utiliser cette méthode, vous devez connaître vos identifiants FTP car vous serez invité à les fournir. Une fois terminé, vous serez redirigé vers la vérification des fichiers pour vous assurer que tout a été mis à jour correctement.<br /><br />',
    'UPDATE_INSTRUCTIONS'			=> '

        <h1>Annonce de publication</h1>

        <p>Veuillez lire <a href="%1$s" title="%1$s"><strong>l'annonce de la sortie pour la dernière version</strong></a> avant de poursuivre votre processus de mise à jour. Elle peut contenir des informations utiles. Elle contient également des liens de téléchargement complets ainsi que le journal des modifications.</p>

        <br />

        <h1>Comment mettre à jour votre installation avec le package de mise à jour automatique</h1>

        <p>La méthode recommandée de mise à jour de votre installation énumérée ici n'est valide que pour le package de mise à jour automatique. Vous pouvez également mettre à jour votre installation à l'aide des méthodes énumérées dans le document INSTALL.html. Les étapes pour mettre à jour phpBB3 automatiquement sont :</p>

        <ul style="margin-left: 20px; font-size: 1.1em;">
            <li>Allez à la <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">page des téléchargements phpBB.com</a> et téléchargez l'archive « Package de mise à jour automatique ».<br /><br /></li>
            <li>Décompressez l'archive.<br /><br /></li>
            <li>Téléversez le dossier install complet et décompressé dans votre répertoire racine phpBB (où se trouve votre fichier config.php).<br /><br /></li>
        </ul>

        <p>Une fois téléversé, votre forum sera hors ligne pour les utilisateurs normaux à cause du répertoire install présent.<br /><br />
        <strong><a href="%2$s" title="%2$s">Démarrez maintenant le processus de mise à jour en pointant votre navigateur vers le dossier install</a>.</strong><br />
        <br />
        Vous serez ensuite guidé à travers le processus de mise à jour. Vous serez notifié une fois la mise à jour terminée.
        </p>
    ',
    'UPDATE_INSTRUCTIONS_INCOMPLETE'	=> '

        <h1>Mise à jour incomplète détectée</h1>

        <p>phpBB a détecté une mise à jour automatique incomplète. Assurez-vous d'avoir suivi toutes les étapes de l'outil de mise à jour automatique. Vous trouverez le lien ci-dessous ou rendez-vous directement dans votre répertoire install.</p>
    ',
    'UPDATE_METHOD'					=> 'Méthode de mise à jour',
    'UPDATE_METHOD_EXPLAIN'			=> 'Vous pouvez maintenant choisir votre méthode de mise à jour préférée. L'utilisation de FTP vous présentera un formulaire dans lequel vous devez saisir les détails de votre compte FTP. Avec cette méthode, les fichiers seront automatiquement déplacés vers le nouvel emplacement et des sauvegardes des anciens fichiers seront créées en ajoutant .bak au nom du fichier. Si vous choisissez de télécharger les fichiers modifiés, vous pouvez les décompresser et les téléverser manuellement à leurs emplacements corrects ultérieurement.',
    'UPDATE_REQUIRES_FILE'			=> 'La mise à jour nécessite que le fichier suivant soit présent : %s',
    'UPDATE_SUCCESS'				=> 'Mise à jour réussie',
    'UPDATE_SUCCESS_EXPLAIN'		=> 'Tous les fichiers ont été mis à jour avec succès. L'étape suivante consiste à vérifier à nouveau tous les fichiers pour vous assurer qu'ils ont été mis à jour correctement.',
    'UPDATE_VERSION_OPTIMIZE'		=> 'Mise à jour de la version et optimisation des tables',
    'UPDATING_DATA'					=> 'Mise à jour des données',
    'UPDATING_TO_LATEST_STABLE'		=> 'Mise à jour de la base de données vers la dernière version stable',
    'UPDATED_VERSION'				=> 'Version mise à jour',
    'UPGRADE_INSTRUCTIONS'			=> 'Une nouvelle version de fonctionnalité <strong>%1$s</strong> est disponible. Veuillez lire <a href="%2$s" title="%2$s"><strong>l'annonce de la sortie</strong></a> pour connaître les nouveautés et comment mettre à niveau.',
    'UPLOAD_METHOD'					=> 'Méthode de téléversement',

    'UPDATE_DB_SUCCESS'				=> 'La mise à jour de la base de données a réussi.',
    'USER_ACTIVE'					=> 'Utilisateur actif',
    'USER_INACTIVE'					=> 'Utilisateur inactif',

    'VERSION_CHECK'					=> 'Vérification de version',
    'VERSION_CHECK_EXPLAIN'			=> 'Vérifie si votre installation phpBB est à jour.',
    'VERSION_NOT_UP_TO_DATE'		=> 'Votre installation phpBB n'est pas à jour. Poursuivez le processus de mise à jour.',
    'VERSION_NOT_UP_TO_DATE_ACP'	=> 'Votre installation phpBB n'est pas à jour.<br />Ci-dessous un lien vers l'annonce de sortie contenant plus d'informations et les instructions de mise à jour.',
    'VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Votre installation phpBB n'est pas à jour.',
    'VERSION_UP_TO_DATE'			=> 'Votre installation phpBB est à jour. Bien qu'il n'y ait pas de mises à jour disponibles pour le moment, vous pouvez continuer pour effectuer une vérification d'intégrité des fichiers.',
    'VERSION_UP_TO_DATE_ACP'		=> 'Votre installation phpBB est à jour. Aucune mise à jour n'est disponible actuellement.',
    'VIEWING_FILE_CONTENTS'			=> 'Affichage du contenu du fichier',
    'VIEWING_FILE_DIFF'				=> 'Affichage des différences de fichier',

    'WRONG_INFO_FILE_FORMAT'	=> 'Format du fichier info incorrect',
));

// Default database schema entries...
$lang = array_merge($lang, array(
    'CONFIG_BOARD_EMAIL_SIG'		=> 'Merci, La Direction',
    'CONFIG_SITE_DESC'				=> 'Un court texte pour décrire votre forum',
    'CONFIG_SITENAME'				=> 'votredomaine.com',

    'DEFAULT_INSTALL_POST'			=> 'Ceci est un message d'exemple dans votre installation IntegraMOD. Tout semble fonctionner. Vous pouvez supprimer ce message si vous le souhaitez et continuer la configuration de votre forum. Lors de l'installation, votre première catégorie et votre premier forum reçoivent des permissions appropriées pour les groupes prédéfinis administrateurs, bots, modérateurs globaux, invités, utilisateurs enregistrés et utilisateurs COPPA enregistrés. Si vous choisissez de supprimer votre première catégorie et votre premier forum, n'oubliez pas d'assigner les permissions pour tous ces groupes sur toutes les nouvelles catégories et forums que vous créez. Il est recommandé de renommer votre première catégorie et votre premier forum et de copier leurs permissions lors de la création de nouveaux éléments. Amusez-vous bien !',

    'FORUMS_FIRST_CATEGORY'			=> 'Votre première catégorie',
    'FORUMS_TEST_FORUM_DESC'		=> 'Description de votre premier forum.',
    'FORUMS_TEST_FORUM_TITLE'		=> 'Votre premier forum',

    'RANKS_SITE_ADMIN_TITLE'		=> 'Administrateur du site',
    'REPORT_WAREZ'					=> 'Le message contient des liens vers des logiciels illégaux ou piratés.',
    'REPORT_SPAM'					=> 'Le message signalé a pour seul but de faire la publicité d'un site ou d'un produit.',
    'REPORT_OFF_TOPIC'				=> 'Le message signalé est hors sujet.',
    'REPORT_OTHER'					=> 'Le message signalé ne correspond à aucune autre catégorie, veuillez utiliser le champ d'information supplémentaire.',

    'SMILIES_ARROW'					=> 'Flèche',
    'SMILIES_CONFUSED'				=> 'Confus',
    'SMILIES_COOL'					=> 'Cool',
    'SMILIES_CRYING'				=> 'En pleurs ou très triste',
    'SMILIES_EMARRASSED'			=> 'Gêné',
    'SMILIES_EVIL'					=> 'Méchant ou très en colère',
    'SMILIES_EXCLAMATION'			=> 'Exclamation',
    'SMILIES_GEEK'					=> 'Geek',
    'SMILIES_IDEA'					=> 'Idée',
    'SMILIES_LAUGHING'				=> 'En train de rire',
    'SMILIES_MAD'					=> 'Furieux',
    'SMILIES_MR_GREEN'				=> 'M. Vert',
    'SMILIES_NEUTRAL'				=> 'Neutre',
    'SMILIES_QUESTION'				=> 'Question',
    'SMILIES_RAZZ'					=> 'Razz',
    'SMILIES_ROLLING_EYES'			=> 'Levant les yeux au ciel',
    'SMILIES_SAD'					=> 'Triste',
    'SMILIES_SHOCKED'				=> 'Choqué',
    'SMILIES_SMILE'					=> 'Sourire',
    'SMILIES_SURPRISED'				=> 'Surpris',
    'SMILIES_TWISTED_EVIL'			=> 'Méchant tordu',
    'SMILIES_UBER_GEEK'				=> 'Super Geek',
    'SMILIES_VERY_HAPPY'			=> 'Très heureux',
    'SMILIES_WINK'					=> 'Clin d'œil',

    'TOPICS_TOPIC_TITLE'			=> 'Bienvenue sur IntegraMOD',

));

?>
