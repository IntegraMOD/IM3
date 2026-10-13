-- OneAll Social Login Integration (v3.11.0)
-- Database Schema for IntegraMOD 3.0.16 (phpBB 3.0.x)
-- Compatible with MySQL 5.x - 8.x / MariaDB
--
-- This replaces the UMIL installer (install_oa_social_login.php).
-- Run this file during the IM3 install step (it uses the default phpbb_ prefix).
-- If your board uses a different table prefix, replace every "phpbb_" below.
--
-- Creates:
--   * 3 tables  : phpbb_oasl_user, phpbb_oasl_identity, phpbb_oasl_login_token
--   * 11 config : oa_social_login_* settings (empty API credentials by default)
--   * 1 ACP mod : OneAll Social Login, under Client Communication

-- =============================================================================
-- Tables
-- =============================================================================

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

-- =============================================================================
-- Config
-- =============================================================================

INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_version', '3.11.0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_disable', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_disable_linking', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_avatars_enable', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_api_connection_handler', 'curl', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_api_connection_port', '443', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_api_subdomain', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_api_key', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_api_secret', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_providers', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('oa_social_login_redirect', '', 0);

-- =============================================================================
-- ACP Module (OneAll Social Login, nested under "Client Communication")
-- =============================================================================
--
-- Nested-set-safe insert: opens a gap at the right edge of the parent
-- category and drops the new leaf module into it. Works on a stock tree.

SET @parent_id = (
	SELECT module_id FROM phpbb_modules
	WHERE module_class = 'acp' AND module_langname = 'ACP_CLIENT_COMMUNICATION'
	LIMIT 1
);
SET @parent_right = (SELECT right_id FROM phpbb_modules WHERE module_id = @parent_id);

UPDATE phpbb_modules SET right_id = right_id + 2 WHERE module_class = 'acp' AND right_id >= @parent_right;
UPDATE phpbb_modules SET left_id = left_id + 2 WHERE module_class = 'acp' AND left_id > @parent_right;

INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth)
VALUES (1, 1, 'oa_social_login', 'acp', @parent_id, @parent_right, @parent_right + 1, 'ACP_OA_SOCIAL_LOGIN', 'index', 'acl_a_server');
