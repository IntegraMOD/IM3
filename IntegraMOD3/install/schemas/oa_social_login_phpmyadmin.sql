-- ============================================================================
-- OneAll Social Login (v3.11.0) - Standalone SQL for phpMyAdmin
-- ============================================================================
--
-- Use this on a site where you are NOT running the IM3 installer / UMIL.
-- Paste the whole file into phpMyAdmin > (your DB) > SQL tab > Go.
--
-- IMPORTANT - TABLE PREFIX:
--   This script assumes the default phpBB prefix "phpbb_".
--   If your board uses a different prefix (check config.php -> $table_prefix),
--   do a Find & Replace of "phpbb_" with your prefix (e.g. "im3_") BEFORE running.
--
-- SAFE TO RE-RUN:
--   * Tables use CREATE TABLE IF NOT EXISTS.
--   * Config rows are guarded so duplicates are skipped.
--   * The ACP module insert is guarded so it is not added twice.
-- ============================================================================

-- ----------------------------------------------------------------------------
-- 1) Tables
-- ----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS phpbb_oasl_user (
	oasl_user_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED NOT NULL DEFAULT '0',
	user_token VARCHAR(255) NOT NULL DEFAULT '',
	date_added INT(10) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (oasl_user_id),
	KEY user_id (user_id),
	KEY user_token (user_token)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;

CREATE TABLE IF NOT EXISTS phpbb_oasl_identity (
	oasl_identity_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	oasl_user_id INT(10) UNSIGNED NOT NULL DEFAULT '0',
	identity_token VARCHAR(255) NOT NULL DEFAULT '',
	identity_provider VARCHAR(255) NOT NULL DEFAULT '',
	num_logins INT(10) UNSIGNED NOT NULL DEFAULT '0',
	date_added INT(10) UNSIGNED NOT NULL DEFAULT '0',
	date_updated INT(10) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (oasl_identity_id),
	KEY oasl_user_id (oasl_user_id),
	KEY identity_token (identity_token)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;

CREATE TABLE IF NOT EXISTS phpbb_oasl_login_token (
	oasl_login_token_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	login_token VARCHAR(255) NOT NULL DEFAULT '',
	user_id INT(10) UNSIGNED NOT NULL DEFAULT '0',
	date_creation INT(10) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (oasl_login_token_id),
	KEY user_id (user_id),
	KEY login_token (login_token)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;

-- ----------------------------------------------------------------------------
-- 2) Config (insert only if not already present)
-- ----------------------------------------------------------------------------

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_version' AS a, '3.11.0' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_version');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_disable' AS a, '0' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_disable');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_disable_linking' AS a, '0' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_disable_linking');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_avatars_enable' AS a, '0' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_avatars_enable');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_api_connection_handler' AS a, 'curl' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_api_connection_handler');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_api_connection_port' AS a, '443' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_api_connection_port');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_api_subdomain' AS a, '' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_api_subdomain');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_api_key' AS a, '' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_api_key');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_api_secret' AS a, '' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_api_secret');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_providers' AS a, '' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_providers');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic)
SELECT * FROM (SELECT 'oa_social_login_redirect' AS a, '' AS b, 0 AS c) tmp
WHERE NOT EXISTS (SELECT 1 FROM phpbb_config WHERE config_name = 'oa_social_login_redirect');

-- ----------------------------------------------------------------------------
-- 3) ACP Module (OneAll Social Login under "Client Communication")
-- ----------------------------------------------------------------------------
-- Nested-set-safe: opens a 2-wide gap at the right edge of the parent
-- category, then inserts the leaf. Guarded against duplicate insertion.

SET @parent_id = (
	SELECT module_id FROM phpbb_modules
	WHERE module_class = 'acp' AND module_langname = 'ACP_CLIENT_COMMUNICATION'
	LIMIT 1
);
SET @parent_right = (SELECT right_id FROM phpbb_modules WHERE module_id = @parent_id);
SET @already = (
	SELECT COUNT(*) FROM phpbb_modules
	WHERE module_class = 'acp' AND module_basename = 'oa_social_login'
);

UPDATE phpbb_modules SET right_id = right_id + 2
	WHERE module_class = 'acp' AND right_id >= @parent_right AND @already = 0;
UPDATE phpbb_modules SET left_id = left_id + 2
	WHERE module_class = 'acp' AND left_id > @parent_right AND @already = 0;

INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth)
SELECT 1, 1, 'oa_social_login', 'acp', @parent_id, @parent_right, @parent_right + 1, 'ACP_OA_SOCIAL_LOGIN', 'index', 'acl_a_server'
FROM DUAL
WHERE @already = 0;

-- ============================================================================
-- Done. Now go to ACP > Client Communication > OneAll Social Login to enter
-- your API subdomain/public key/private key and enable social networks.
-- ============================================================================
