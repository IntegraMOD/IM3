#
# $Id$
#

# POSTGRES BEGIN #

# -- Config
INSERT INTO phpbb_config (config_name, config_value) VALUES ('active_sessions', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_attachments', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_autologin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_local', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_remote', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_upload', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_remote_upload', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_bbcode', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_birthdays', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_bookmarks', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_emailreuse', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_forum_notify', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_mass_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_name_chars', 'USERNAME_CHARS_ANY');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_namechange', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_nocensors', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_pm_attach', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_pm_report', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_post_flash', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_post_links', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_privmsg', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_quick_reply', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_bbcode', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_flash', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_img', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_links', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_smilies', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_smilies', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_topic_notify', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('attachment_quota', '52428800');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auth_bbcode_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auth_flash_pm', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auth_img_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auth_method', 'db');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auth_smilies_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_filesize', '6144');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_gallery_path', 'images/avatars/gallery');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_height', '90');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_width', '90');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_min_height', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_min_width', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_path', 'images/avatars/upload');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_salt', 'phpbb_avatar');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_contact', 'contact@yourdomain.tld');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_msg', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_dst', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email', 'address@yourdomain.tld');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_form', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_sig', '{L_CONFIG_BOARD_EMAIL_SIG}');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_hide_emails', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_timezone', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('browser_check', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bump_interval', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bump_type', 'd');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cache_gc', '7200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('captcha_plugin', 'phpbb_captcha_nogd');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('captcha_plugin', 'phpbb_captcha_qa');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('recaptcha_v2_pubkey', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('recaptcha_v2_privkey', '');

INSERT INTO phpbb_config (config_name, config_value) VALUES ('confirm_refresh', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('check_attachment_content', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('check_dnsbl', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('chg_passforce', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_domain', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_name', 'phpbb3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_path', '/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_secure', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_fax', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_mail', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('database_gc', '604800');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbms_version', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_dateformat', 'D M d, Y g:i a');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_style', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('display_last_edited', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('display_order', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('edit_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('delete_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_check_mx', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_function_name', 'mail');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_max_chunk_size', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_package_size', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('enable_confirm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('enable_pm_icons', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('enable_post_confirm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_http_auth', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_limit_post', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_limit_topic', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_overall_forums', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_overall', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_forum', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_topic', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_topics_new', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_topics_active', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('feed_item_statistics', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('flood_interval', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('force_server_vars', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('form_token_lifetime', '7200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('form_token_mintime', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('form_token_sid_guests', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('forward_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('forwarded_for_check', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('full_folder_action', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('fulltext_mysql_max_word_len', '254');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('fulltext_mysql_min_word_len', '4');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('fulltext_native_common_thres', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('fulltext_native_load_upd', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('fulltext_native_max_chars', '14');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('fulltext_native_min_chars', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gzip_compress', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hot_threshold', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('icons_path', 'images/icons');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_create_thumbnail', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_display_inlined', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_link_height', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_link_width', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_max_height', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_max_thumb_width', '400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_max_width', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('img_min_thumb_filesize', '12000');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ip_check', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ip_login_limit_max', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ip_login_limit_time', '21600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ip_login_limit_use_forwarded', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_allow_self_signed', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_host', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_password', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_package_size', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_port', '5222');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_use_ssl', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_username', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_verify_peer', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jab_verify_peer_name', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_base_dn', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_email', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_password', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_port', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_server', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_uid', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_user', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ldap_user_filter', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('limit_load', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('limit_search_load', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_anon_lastread', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_birthdays', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_cpf_memberlist', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_cpf_viewprofile', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_cpf_viewtopic', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_db_lastread', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_db_track', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_jumpbox', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_moderators', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_online', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_online_guests', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_online_time', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_onlinetrack', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_search', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_tplcompile', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_unreads_search', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('load_user_activity', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_attachments', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_attachments_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_autologin_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_filesize', '262144');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_filesize_pm', '262144');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_login_attempts', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_name_chars', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_num_search_keywords', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_pass_chars', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_poll_options', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_post_chars', '60000');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_post_font_size', '200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_post_img_height', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_post_img_width', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_post_smilies', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_post_urls', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_quote_depth', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_reg_attempts', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_chars', '255');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_font_size', '200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_img_height', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_img_width', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_smilies', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_urls', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_name_chars', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_pass_chars', '6');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_post_chars', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_search_author_chars', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mime_triggers', 'body|head|html|img|plaintext|a href|pre|script|table|title');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('new_member_post_limit', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('new_member_group_default', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_user_style', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pass_complex', 'PASS_TYPE_ANY');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pm_edit_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pm_max_boxes', '4');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pm_max_msgs', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pm_max_recipients', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('posts_per_page', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('print_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('queue_interval', '60');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ranks_path', 'images/ranks');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_activation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('referer_validation', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('script_path', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_block_size', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_gc', '7200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_interval', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_anonymous_interval', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_type', 'fulltext_native');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_store_results', '1800');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('secure_allow_deny', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('secure_allow_empty_referer', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('secure_downloads', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_name', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_port', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_protocol', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('session_gc', '3600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('session_length', '3600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_desc', '{L_CONFIG_SITE_DESC}');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sitename', '{L_CONFIG_SITENAME}');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_path', 'images/smilies');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_per_page', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_auth_method', 'PLAIN');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_delivery', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_host', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_password', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_port', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_username', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topics_per_page', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('tpl_allow_php', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('upload_icons_path', 'images/upload_icons');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('upload_path', 'files');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('version', '3.0.14');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('warnings_expire_days', '90');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('warnings_gc', '14400');

INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('cache_last_gc', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('cron_lock', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('database_last_gc', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('last_queue_run', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('newest_user_colour', 'AA0000', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('newest_user_id', '2', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('newest_username', '', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('num_files', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('num_posts', '1', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('num_topics', '1', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('num_users', '1', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('rand_seed', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('rand_seed_last_update', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('record_online_date', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('record_online_users', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('search_indexing_state', '', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('search_last_gc', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('session_last_gc', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('upload_dir_size', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('warnings_last_gc', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_kb', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_cal', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_gall', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_cht', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_ifs', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_faq', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('show_mem', '1', 0);
# -- Shoutbox
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_interval', ' 	3600', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_prune', '336', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_max_posts', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_flood_interval', '15', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_version', '1.1.1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_ie_nr', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_non_ie_nr', '20', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_on_index', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('as_override_user', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('last_as_run', '0', 1);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('im_show_shout_index', '1', 0);
# -- Anti Spam ACP
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_enable', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_reg_captcha', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_log', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_spam_words_enable', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_spam_words_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_spam_words_flag_limit', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_spam_words_posting_action', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_spam_words_pm_action', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_spam_words_profile_action', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_icq', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_icq_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_aim', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_aim_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_msn', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_msn_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_yim', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_yim_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_jabber', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_jabber_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_website', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_website_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_location', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_location_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_occupation', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_occupation_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_interests', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_interests_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_signature', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_signature_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_notify_new_flag', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_user_flag_enable', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_sfs_action', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_sfs_min_freq', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_sfs_key', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_username', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_move_to_group', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_delete_posts', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_delete_avatar', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_delete_signature', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_delete_profile_fields', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_profile_during_reg', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_version', '1.0.6', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_clear_outbox', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_deactivate', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_ocban_blog', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_akismet_enable', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_akismet_api_key', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_akismet_domain', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_akismet_post_limit', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_akismet_post_action', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('asacp_akismet_pm_action', '1', 0);
# -- Topic Calendar
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_override_user', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_allow_priv_events', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_show_week_nums', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_monday_first', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_show_events_list', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_show_birthdays_list', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_show_birthdays_main', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_max_events_list_days', '31', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_default_events_list_days', '31', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_max_bdays_list_days', '31', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_default_bdays_list_days', '31', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_version', '2.0.0b1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('calendar_allow_index_minical', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('im_show_cal_index', '1', 0);
# -- phpBB Gallery
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_album_columns', '3', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_album_display', '254', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_album_images', '2500', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_album_rows', '4', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_comments', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_gif', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_hotlinking', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_jpg', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_png', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_rates', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_resize', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_rotate', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_allow_zip', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_captcha_comment', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_captcha_upload', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_comment_length', '2000', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_comment_user_control', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_contests_ended', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_default_sort_dir', 'd', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_default_sort_key', 't', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_description_length', '2000', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_birthdays', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_exifdata', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_image_url', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_login', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_nextprev_thumbnail', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_statistic', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_total_images', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_disp_whoisonline', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_feed_enable', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_feed_enable_pegas', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_feed_limit', '10', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_gdlib_version', '2', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_hotlinking_domains', 'integramod.com', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_jpg_quality', '100', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_link_thumbnail', 'image_page', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_link_imagepage', 'image', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_link_image_name', 'image_page', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_link_image_icon', 'image_page', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_max_filesize', '512000', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_max_height', '1024', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_max_rating', '10', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_max_width', '1280', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_medium_cache', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_medium_height', '600', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_medium_width', '800', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_mini_thumbnail_disp', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_mini_thumbnail_size', '70', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_mvc_ignore', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_mvc_time', '1389997228', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_mvc_version', '1.1.6', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_newest_pega_user_id', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_newest_pega_username', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_newest_pega_user_colour', '', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_newest_pega_album_id', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_num_comments', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_num_images', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_num_pegas', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_num_uploads', '10', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_pegas_index_album', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_pegas_per_page', '15', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_profile_user_images', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_profile_pega', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_prune_orphan_time', '1389826182', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_columns', '4', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_comments', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_contests', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_crows', '5', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_display', '173', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_mode', '7', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_pegas', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_gindex_rows', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_profile_columns', '4', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_profile_display', '141', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_profile_mode', '3', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_profile_pegas', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_rrc_profile_rows', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_search_display', '45', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_shortnames', '25', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_thumbnail_cache', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_thumbnail_height', '160', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_thumbnail_infoline', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_thumbnail_quality', '50', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_thumbnail_width', '240', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_version', '1.1.6', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_viewtopic_icon', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_viewtopic_images', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_viewtopic_link', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_watermark_changed', '0', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_watermark_enabled', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_watermark_height', '50', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_watermark_position', '20', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_watermark_source', 'gallery/images/watermark.png', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('phpbb_gallery_watermark_width', '200', 0);
# -- KISS Portal
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('portal_enabled', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('portal_build', '311-020', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('blocks_enabled', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('blocks_width', '190', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('force_default_if_style_missing', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('portal_version', '1.0.20im', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('premod_version', '0.1.0', 0);
# -- IntegraMOD
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('imod_enabled', '1', 0);
INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('imod_version', '3.0.14', 0);
# -- Forum related auth options
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_announce', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_attach', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_bbcode', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_bump', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_delete', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_download', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_edit', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_email', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_flash', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_icons', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_ignoreflood', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_img', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_list', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_noapprove', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_poll', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_post', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_postcount', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_print', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_read', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_reply', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_report', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_search', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_sigs', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_smilies', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_sticky', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_subscribe', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_user_lock', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_vote', 1);
INSERT INTO phpbb_acl_options (auth_option, is_local) VALUES ('f_votechg', 1);

# -- Moderator related auth options
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_approve', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_chgposter', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_delete', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_edit', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_info', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_lock', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_merge', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_move', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_report', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_split', 1, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_asacp_ban', 1, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_asacp_user_flag', 1, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_asacp_ip_search', 1, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_asacp_spam_log', 1, 0);

# -- Global moderator auth option (not a local option)
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_ban', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_warn', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_edit_event', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_delete_event', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_ch_poster', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_del_kb', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_edit_kb', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_activate_kb', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_report_kb', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_log_kb_delete', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_log_kb', 0, 1);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global) VALUES ('m_restore_kb', 0, 1);
# -- Admin related auth options
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_aauth', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_attach', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_authgroups', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_authusers', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_backup', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_ban', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_bbcode', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_board', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_bots', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_clearlogs', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_email', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_fauth', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_forum', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_forumadd', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_forumdel', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_group', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_groupadd', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_groupdel', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_icons', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_jabber', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_language', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_mauth', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_modules', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_names', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_phpinfo', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_profile', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_prune', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_ranks', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_reasons', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_roles', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_search', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_server', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_styles', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_switchperm', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_uauth', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_user', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_userdel', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_viewauth', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_viewlogs', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_words', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_k_portal', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_k_tools', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_calendar_manage', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_edit_event', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_delete_event', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_publish_rss', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_as_manage', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_gallery_manage', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_gallery_albums', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_gallery_import', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_gallery_cleanup', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_asacp', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_asacp_profile_fields', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_asacp_spam_words', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_mods', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_config_kb', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_categorie_kb', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_types_kb', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('a_premissions_kb', 1);

# -- User related auth options
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_allow_index_minical', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_attach', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_chgavatar', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_chgcensors', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_chgemail', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_chggrp', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_chgname', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_chgpasswd', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_download', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_hideonline', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_ignoreflood', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_masspm', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_masspm_group', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_attach', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_bbcode', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_delete', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_download', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_edit', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_emailpm', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_flash', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_forward', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_img', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_printpm', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_pm_smilies', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_readpm', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_savedrafts', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_search', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_sendemail', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_sendim', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_sendpm', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_sig', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_viewonline', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_viewprofile', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_k_tools', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_view_event', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_new_event', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_edit_event', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_delete_event', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_post', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_view', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_info', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_delete', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_edit', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_smilies', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_bbcode', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_mod_edit', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_as_ignore_flood', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_rate_kb', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_cal', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_kb', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_gall', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_cht', 0);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_dls', 0);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_faq', 1);
INSERT INTO phpbb_acl_options (auth_option, is_global) VALUES ('u_mem', 1);

# -- Knowledge Base
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_print_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_view_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_download',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_report_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_rate_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_attache_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_edit_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_del_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_add_article',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_add_article_direct',1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_local, is_global, founder_only) VALUES ('kb_edit_all_article',1, 0, 0);

# -- standard auth roles
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_ADMIN_STANDARD', 'ROLE_DESCRIPTION_ADMIN_STANDARD', 'a_', 1);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_ADMIN_FORUM', 'ROLE_DESCRIPTION_ADMIN_FORUM', 'a_', 3);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_ADMIN_USERGROUP', 'ROLE_DESCRIPTION_ADMIN_USERGROUP', 'a_', 4);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_ADMIN_FULL', 'ROLE_DESCRIPTION_ADMIN_FULL', 'a_', 2);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_USER_FULL', 'ROLE_DESCRIPTION_USER_FULL', 'u_', 3);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_USER_STANDARD', 'ROLE_DESCRIPTION_USER_STANDARD', 'u_', 1);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_USER_LIMITED', 'ROLE_DESCRIPTION_USER_LIMITED', 'u_', 2);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_USER_NOPM', 'ROLE_DESCRIPTION_USER_NOPM', 'u_', 4);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_USER_NOAVATAR', 'ROLE_DESCRIPTION_USER_NOAVATAR', 'u_', 5);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_MOD_FULL', 'ROLE_DESCRIPTION_MOD_FULL', 'm_', 3);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_MOD_STANDARD', 'ROLE_DESCRIPTION_MOD_STANDARD', 'm_', 1);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_MOD_SIMPLE', 'ROLE_DESCRIPTION_MOD_SIMPLE', 'm_', 2);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_MOD_QUEUE', 'ROLE_DESCRIPTION_MOD_QUEUE', 'm_', 4);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_FULL', 'ROLE_DESCRIPTION_FORUM_FULL', 'f_', 7);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_STANDARD', 'ROLE_DESCRIPTION_FORUM_STANDARD', 'f_', 5);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_NOACCESS', 'ROLE_DESCRIPTION_FORUM_NOACCESS', 'f_', 1);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_READONLY', 'ROLE_DESCRIPTION_FORUM_READONLY', 'f_', 2);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_LIMITED', 'ROLE_DESCRIPTION_FORUM_LIMITED', 'f_', 3);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_BOT', 'ROLE_DESCRIPTION_FORUM_BOT', 'f_', 9);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_ONQUEUE', 'ROLE_DESCRIPTION_FORUM_ONQUEUE', 'f_', 8);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_POLLS', 'ROLE_DESCRIPTION_FORUM_POLLS', 'f_', 6);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_LIMITED_POLLS', 'ROLE_DESCRIPTION_FORUM_LIMITED_POLLS', 'f_', 4);

# 23
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_USER_NEW_MEMBER', 'ROLE_DESCRIPTION_USER_NEW_MEMBER', 'u_', 6);

# 24
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_FORUM_NEW_MEMBER', 'ROLE_DESCRIPTION_FORUM_NEW_MEMBER', 'f_', 10);

INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_KB_ADMIN', 'ROLE_DESCRIPTION_KB_ADMIN', 'kb_', 1);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_KB_MODERATOR', 'ROLE_DESCRIPTION_KB_MODERATOR', 'kb_', 2);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_KB_USER', 'ROLE_DESCRIPTION_KB_USER', 'kb_', 3);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_KB_SU_USER', 'ROLE_DESCRIPTION_KB_SU_USER', 'kb_', 4);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_KB_GUEST', 'ROLE_DESCRIPTION_KB_GUEST', 'kb_', 5);
INSERT INTO phpbb_acl_roles (role_name, role_description, role_type, role_order) VALUES ('ROLE_KB_BOT', 'ROLE_DESCRIPTION_KB_BOT', 'kb_', 6);

# -- phpbb_styles
INSERT INTO phpbb_styles (style_name, style_copyright, style_active, template_id, theme_id, imageset_id) VALUES ('prosilver', '&copy; phpBB Group', 1, 1, 1, 1);

# -- phpbb_styles_imageset
INSERT INTO phpbb_styles_imageset (imageset_name, imageset_copyright, imageset_path) VALUES ('prosilver', '&copy; phpBB Group', 'prosilver');

# -- phpbb_styles_imageset_data
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('site_logo', 'site_logo.gif', '', 52, 139, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_link', 'forum_link.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_read', 'forum_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_read_locked', 'forum_read_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_read_subforum', 'forum_read_subforum.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_unread', 'forum_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_unread_locked', 'forum_unread_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('forum_unread_subforum', 'forum_unread_subforum.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_moved', 'topic_moved.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_read', 'topic_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_read_mine', 'topic_read_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_read_hot', 'topic_read_hot.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_read_hot_mine', 'topic_read_hot_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_read_locked', 'topic_read_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_read_locked_mine', 'topic_read_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_unread', 'topic_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_unread_mine', 'topic_unread_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_unread_hot', 'topic_unread_hot.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_unread_hot_mine', 'topic_unread_hot_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_unread_locked', 'topic_unread_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('topic_unread_locked_mine', 'topic_unread_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_read', 'sticky_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_read_mine', 'sticky_read_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_read_locked', 'sticky_read_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_read_locked_mine', 'sticky_read_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_unread', 'sticky_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_unread_mine', 'sticky_unread_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_unread_locked', 'sticky_unread_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('sticky_unread_locked_mine', 'sticky_unread_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_read', 'announce_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_read_mine', 'announce_read_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_read_locked', 'announce_read_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_read_locked_mine', 'announce_read_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_unread', 'announce_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_unread_mine', 'announce_unread_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_unread_locked', 'announce_unread_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('announce_unread_locked_mine', 'announce_unread_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_read', 'announce_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_read_mine', 'announce_read_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_read_locked', 'announce_read_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_read_locked_mine', 'announce_read_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_unread', 'announce_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_unread_mine', 'announce_unread_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_unread_locked', 'announce_unread_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('global_unread_locked_mine', 'announce_unread_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('pm_read', 'topic_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('pm_unread', 'topic_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_back_top', 'icon_back_top.gif', '', 11, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_aim', 'icon_contact_aim.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_email', 'icon_contact_email.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_icq', 'icon_contact_icq.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_jabber', 'icon_contact_jabber.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_msnm', 'icon_contact_msnm.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_www', 'icon_contact_www.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_yahoo', 'icon_contact_yahoo.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_delete', 'icon_post_delete.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_info', 'icon_post_info.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_report', 'icon_post_report.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_target', 'icon_post_target.gif', '', 9, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_target_unread', 'icon_post_target_unread.gif', '', 9, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_topic_attach', 'icon_topic_attach.gif', '', 10, 7, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_topic_latest', 'icon_topic_latest.gif', '', 9, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_topic_newest', 'icon_topic_newest.gif', '', 9, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_topic_reported', 'icon_topic_reported.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_topic_unapproved', 'icon_topic_unapproved.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_user_warn', 'icon_user_warn.gif', '', 20, 20, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('subforum_read', 'subforum_read.gif', '', 9, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('subforum_unread', 'subforum_unread.gif', '', 9, 11, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_checking', 'icon_ajax_checking.gif', '', 16, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_true', 'icon_ajax_true.gif', '', 16, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_false', 'icon_ajax_false.gif', '', 16, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_password_strength_1', 'icon_ajax_password_strength_1.gif', '', 16, 44, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_password_strength_2', 'icon_ajax_password_strength_2.gif', '', 16, 44, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_password_strength_3', 'icon_ajax_password_strength_3.gif', '', 16, 44, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ajax_password_strength_4', 'icon_ajax_password_strength_4.gif', '', 16, 44, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_read', 'news_read.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_read_mine', 'news_read_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_read_locked', 'news_read_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_read_locked_mine', 'news_read_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_unread', 'news_unread.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_unread_mine', 'news_unread_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_unread_locked', 'news_unread_locked.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('news_unread_locked_mine', 'news_unread_locked_mine.gif', '', 27, 27, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_kb', 'icon_kb.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_cal', 'icon_mini_calendar.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_gall', 'icon_album.gif', '', 14, 18, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_cht', 'icon_chat.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_ifs', 'icon_dl.gif', '', 14, 14, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_faq', 'icon_faq.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_mem', 'icon_members.gif', '', 14, 16, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_contact_pm', 'icon_contact_pm.gif', 'en', 20, 28, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_edit', 'icon_post_edit.gif', 'en', 20, 42, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_post_quote', 'icon_post_quote.gif', 'en', 20, 54, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('icon_user_online', 'icon_user_online.gif', 'en', 58, 58, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_pm_forward', 'button_pm_forward.gif', 'en', 25, 96, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_pm_new', 'button_pm_new.gif', 'en', 25, 84, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_pm_reply', 'button_pm_reply.gif', 'en', 25, 96, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_topic_locked', 'button_topic_locked.gif', 'en', 25, 88, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_topic_new', 'button_topic_new.gif', 'en', 25, 96, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_topic_reply', 'button_topic_reply.gif', 'en', 25, 96, 1);
INSERT INTO phpbb_styles_imageset_data (image_name, image_filename, image_lang, image_height, image_width, imageset_id) VALUES ('button_upload_image', 'button_upload_image.gif', 'en', 25, 96, 1);

# -- phpbb_styles_template
INSERT INTO phpbb_styles_template (template_name, template_copyright, template_path, bbcode_bitfield, template_storedb) VALUES ('prosilver', '&copy; phpBB Group', 'prosilver', 'lNg=', 0);

# -- phpbb_styles_theme
INSERT INTO phpbb_styles_theme (theme_name, theme_copyright, theme_path, theme_storedb, theme_data) VALUES ('prosilver', '&copy; phpBB Group', 'prosilver', 1, '');

# -- Forums
INSERT INTO phpbb_forums (forum_name, forum_desc, left_id, right_id, parent_id, forum_type, forum_posts, forum_topics, forum_topics_real, forum_last_post_id, forum_last_poster_id, forum_last_poster_name, forum_last_poster_colour, forum_last_post_time, forum_link, forum_password, forum_image, forum_rules, forum_rules_link, forum_rules_uid, forum_desc_uid, prune_days, prune_viewed, forum_parents) VALUES ('{L_FORUMS_FIRST_CATEGORY}', '', 1, 4, 0, 0, 1, 1, 1, 1, 2, 'Admin', 'AA0000', 972086460, '', '', '', '', '', '', '', 0, 0, '');

INSERT INTO phpbb_forums (forum_name, forum_desc, left_id, right_id, parent_id, forum_type, forum_posts, forum_topics, forum_topics_real, forum_last_post_id, forum_last_poster_id, forum_last_poster_name, forum_last_poster_colour, forum_last_post_subject, forum_last_post_time, forum_link, forum_password, forum_image, forum_rules, forum_rules_link, forum_rules_uid, forum_desc_uid, prune_days, prune_viewed, forum_parents, forum_flags) VALUES ('{L_FORUMS_TEST_FORUM_TITLE}', '{L_FORUMS_TEST_FORUM_DESC}', 2, 3, 1, 1, 1, 1, 1, 1, 2, 'Admin', 'AA0000', '{L_TOPICS_TOPIC_TITLE}', 972086460, '', '', '', '', '', '', '', 0, 0, '', 48);

# -- Users / Anonymous user
INSERT INTO phpbb_users (user_type, group_id, username, username_clean, user_regdate, user_password, user_email, user_lang, user_style, user_rank, user_colour, user_posts, user_permissions, user_ip, user_birthday, user_lastpage, user_last_confirm_key, user_post_sortby_type, user_post_sortby_dir, user_topic_sortby_type, user_topic_sortby_dir, user_avatar, user_sig, user_sig_bbcode_uid, user_from, user_icq, user_aim, user_yim, user_msnm, user_jabber, user_website, user_occ, user_interests, user_actkey, user_newpasswd, user_allow_massemail) VALUES (2, 1, 'Anonymous', 'anonymous', 0, '', '', 'en', 1, 0, '', 0, '', '', '', '', '', 't', 'a', 't', 'd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0);

# -- username: Admin    password: admin (change this or remove it once everything is working!)
INSERT INTO phpbb_users (user_type, group_id, username, username_clean, user_regdate, user_password, user_email, user_lang, user_style, user_rank, user_colour, user_posts, user_permissions, user_ip, user_birthday, user_lastpage, user_last_confirm_key, user_post_sortby_type, user_post_sortby_dir, user_topic_sortby_type, user_topic_sortby_dir, user_avatar, user_sig, user_sig_bbcode_uid, user_from, user_icq, user_aim, user_yim, user_msnm, user_jabber, user_website, user_occ, user_interests, user_actkey, user_newpasswd) VALUES (3, 5, 'Admin', 'admin', 0, '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', 'en', 1, 1, 'AA0000', 1, '', '', '', '', '', 't', 'a', 't', 'd', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

# -- Groups
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('GUESTS', 3, 0, '', 0, '', '', '', 5);
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('REGISTERED', 3, 0, '', 0, '', '', '', 5);
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('REGISTERED_COPPA', 3, 0, '', 0, '', '', '', 5);
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('GLOBAL_MODERATORS', 3, 0, '00AA00', 1, '', '', '', 0);
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('ADMINISTRATORS', 3, 1, 'AA0000', 1, '', '', '', 0);
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('BOTS', 3, 0, '9E8DA7', 0, '', '', '', 5);
INSERT INTO phpbb_groups (group_name, group_type, group_founder_manage, group_colour, group_legend, group_avatar, group_desc, group_desc_uid, group_max_recipients) VALUES ('NEWLY_REGISTERED', 3, 0, '', 0, '', '', '', 5);

# -- User -> Group
INSERT INTO phpbb_user_group (group_id, user_id, user_pending, group_leader) VALUES (1, 1, 0, 0);
INSERT INTO phpbb_user_group (group_id, user_id, user_pending, group_leader) VALUES (2, 2, 0, 0);
INSERT INTO phpbb_user_group (group_id, user_id, user_pending, group_leader) VALUES (4, 2, 0, 0);
INSERT INTO phpbb_user_group (group_id, user_id, user_pending, group_leader) VALUES (5, 2, 0, 1);

# -- Ranks
INSERT INTO phpbb_ranks (rank_title, rank_min, rank_special, rank_image) VALUES ('{L_RANKS_SITE_ADMIN_TITLE}', 0, 1, '');

# -- Roles data

# Standard Admin (a_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 1, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'a_%' AND auth_option NOT IN ('a_switchperm', 'a_jabber', 'a_phpinfo', 'a_server', 'a_backup', 'a_styles', 'a_clearlogs', 'a_modules', 'a_language', 'a_email', 'a_bots', 'a_search', 'a_aauth', 'a_roles');

# Forum admin (a_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 2, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'a_%' AND auth_option IN ('a_', 'a_authgroups', 'a_authusers', 'a_fauth', 'a_forum', 'a_forumadd', 'a_forumdel', 'a_mauth', 'a_prune', 'a_uauth', 'a_viewauth', 'a_viewlogs');

# User and Groups Admin (a_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 3, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'a_%' AND auth_option IN ('a_', 'a_authgroups', 'a_authusers', 'a_ban', 'a_group', 'a_groupadd', 'a_groupdel', 'a_ranks', 'a_uauth', 'a_user', 'a_viewauth', 'a_viewlogs');

# Full Admin (a_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 4, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'a_%';

# All Features (u_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 5, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%';

# Standard Features (u_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 6, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option NOT IN ('u_viewonline', 'u_chggrp', 'u_chgname', 'u_ignoreflood', 'u_pm_flash', 'u_pm_forward');

# Limited Features (u_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 7, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option NOT IN ('u_attach', 'u_viewonline', 'u_chggrp', 'u_chgname', 'u_ignoreflood', 'u_pm_attach', 'u_pm_emailpm', 'u_pm_flash', 'u_savedrafts', 'u_search', 'u_sendemail', 'u_sendim', 'u_masspm', 'u_masspm_group');

# No Private Messages (u_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 8, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option IN ('u_', 'u_chgavatar', 'u_chgcensors', 'u_chgemail', 'u_chgpasswd', 'u_download', 'u_hideonline', 'u_sig', 'u_viewprofile');
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 8, auth_option_id, 0 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option IN ('u_readpm', 'u_sendpm', 'u_masspm', 'u_masspm_group');

# No Avatar (u_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 9, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option NOT IN ('u_attach', 'u_chgavatar', 'u_viewonline', 'u_chggrp', 'u_chgname', 'u_ignoreflood', 'u_pm_attach', 'u_pm_emailpm', 'u_pm_flash', 'u_savedrafts', 'u_search', 'u_sendemail', 'u_sendim', 'u_masspm', 'u_masspm_group');
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 9, auth_option_id, 0 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option IN ('u_chgavatar');

# Full Moderator (m_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 10, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'm_%';

# Standard Moderator (m_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 11, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'm_%' AND auth_option NOT IN ('m_ban', 'm_chgposter');

# Simple Moderator (m_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 12, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'm_%' AND auth_option IN ('m_', 'm_delete', 'm_edit', 'm_info', 'm_report');

# Queue Moderator (m_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 13, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'm_%' AND auth_option IN ('m_', 'm_approve', 'm_edit');

# Full Access (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 14, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%';

# Standard Access (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 15, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option NOT IN ('f_announce', 'f_flash', 'f_ignoreflood', 'f_poll', 'f_sticky', 'f_user_lock');

# No Access (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 16, auth_option_id, 0 FROM phpbb_acl_options WHERE auth_option = 'f_';

# Read Only Access (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 17, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option IN ('f_', 'f_download', 'f_list', 'f_read', 'f_search', 'f_subscribe', 'f_print');

# Limited Access (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 18, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option NOT IN ('f_announce', 'f_attach', 'f_bump', 'f_delete', 'f_flash', 'f_icons', 'f_ignoreflood', 'f_poll', 'f_sticky', 'f_user_lock', 'f_votechg');

# Bot Access (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 19, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option IN ('f_', 'f_download', 'f_list', 'f_read', 'f_print');

# On Moderation Queue (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 20, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option NOT IN ('f_announce', 'f_bump', 'f_delete', 'f_flash', 'f_icons', 'f_ignoreflood', 'f_poll', 'f_sticky', 'f_user_lock', 'f_votechg', 'f_noapprove');
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 20, auth_option_id, 0 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option IN ('f_noapprove');

# Standard Access + Polls (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 21, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option NOT IN ('f_announce', 'f_flash', 'f_ignoreflood', 'f_sticky', 'f_user_lock');

# Limited Access + Polls (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 22, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option NOT IN ('f_announce', 'f_attach', 'f_bump', 'f_delete', 'f_flash', 'f_icons', 'f_ignoreflood', 'f_sticky', 'f_user_lock', 'f_votechg');

# New Member (u_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 23, auth_option_id, 0 FROM phpbb_acl_options WHERE auth_option LIKE 'u_%' AND auth_option IN ('u_sendpm', 'u_masspm', 'u_masspm_group');

# New Member (f_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 24, auth_option_id, 0 FROM phpbb_acl_options WHERE auth_option LIKE 'f_%' AND auth_option IN ('f_noapprove');

# KB_ADMIN (kb_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 25, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'kb_%';

# KB_MODERATOR (kb_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 26, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'kb_%';

# KB_USER (kb_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 27, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'kb_%' AND auth_option NOT IN ('kb_edit_all_article', 'kb_add_article_direct');

# KB_SU_USER (kb_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 28, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'kb_%' AND auth_option NOT IN ('kb_edit_all_article');

# KB_GUEST (kb_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 29, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'kb_%' AND auth_option NOT IN ('kb_edit_all_article', 'kb_add_article_direct', 'kb_add_article', 'kb_del_article', 'kb_edit_article', 'kb_attache_article', 'kb_rate_article', 'kb_report_article', 'kb_download');

# KB_BOT kb_)
INSERT INTO phpbb_acl_roles_data (role_id, auth_option_id, auth_setting) SELECT 30, auth_option_id, 1 FROM phpbb_acl_options WHERE auth_option LIKE 'kb_%' AND auth_option NOT IN ('kb_edit_all_article', 'kb_add_article_direct', 'kb_add_article', 'kb_del_article', 'kb_edit_article', 'kb_attache_article', 'kb_rate_article', 'kb_report_article', 'kb_download', 'kb_print_article ');

# Permissions

# GUESTS - u_download and u_search ability
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting) SELECT 1, 0, auth_option_id, 0, 1 FROM phpbb_acl_options WHERE auth_option IN ('u_', 'u_download', 'u_search');

# Admin user - full user features
INSERT INTO phpbb_acl_users (user_id, forum_id, auth_option_id, auth_role_id, auth_setting) VALUES (2, 0, 0, 5, 0);

# ADMINISTRATOR Group - full user features
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (5, 0, 0, 5, 0, 1);

# ADMINISTRATOR Group - standard admin
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (5, 0, 0, 1, 0, 1);

# REGISTERED and REGISTERED_COPPA having standard user features
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (2, 0, 0, 6, 0, 0);
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (3, 0, 0, 6, 0, 0);

# GLOBAL_MODERATORS having full user features
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (4, 0, 0, 5, 0, 1);

# GLOBAL_MODERATORS having full global moderator access
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (4, 0, 0, 10, 0, 1);

# Giving all groups read only access to the first category
# since administrators and moderators are already within the registered users group we do not need to set them here
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (1, 1, 0, 17, 0, 0);
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (2, 1, 0, 17, 0, 0);
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (3, 1, 0, 17, 0, 0);
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (6, 1, 0, 17, 0, 0);

# Giving access to the first forum

# guests having read only access
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (1, 2, 0, 17, 0, 0);

# registered and registered_coppa having standard access
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (2, 2, 0, 15, 0, 0);
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (3, 2, 0, 15, 0, 0);

# global moderators having standard access + polls
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (4, 2, 0, 21, 0, 1);

# administrators having full forum and full moderator access
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (5, 2, 0, 14, 0, 1);
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (5, 2, 0, 10, 0, 1);

# Bots having bot access
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (6, 2, 0, 19, 0, 0);

# NEW MEMBERS aren't allowed to PM
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (7, 0, 0, 23, 0, 0);

# NEW MEMBERS on the queue
INSERT INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting, is_kb) VALUES (7, 2, 0, 24, 0, 0);


# -- Demo Topic
INSERT INTO phpbb_topics (topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_replies_real, forum_id, topic_status, topic_type, topic_first_post_id, topic_first_poster_name, topic_first_poster_colour, topic_last_post_id, topic_last_poster_id, topic_last_poster_name, topic_last_poster_colour, topic_last_post_subject, topic_last_post_time, topic_last_view_time, poll_title, invite_attendees, event_attendees, event_non_attendees) VALUES ('{L_TOPICS_TOPIC_TITLE}', 2, 972086460, 0, 0, 0, 2, 0, 0, 1, 'Admin', 'AA0000', 1, 2, 'Admin', 'AA0000', '{L_TOPICS_TOPIC_TITLE}', 972086460, 972086460, '', 0, '', '');

# -- Demo Post
INSERT INTO phpbb_posts (topic_id, forum_id, poster_id, icon_id, post_time, post_username, poster_ip, post_subject, post_text, post_checksum, bbcode_uid) VALUES (1, 2, 2, 0, 972086460, '', '127.0.0.1', '{L_TOPICS_TOPIC_TITLE}', '{L_DEFAULT_INSTALL_POST}', '5dd683b17f641daf84c040bfefc58ce9', '');

# -- Admin posted to the demo topic
INSERT INTO phpbb_topics_posted (user_id, topic_id, topic_posted) VALUES (2, 1, 1);

# -- Smilies
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':D', 'icon_e_biggrin.gif', '{L_SMILIES_VERY_HAPPY}', 15, 17, 1);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-D', 'icon_e_biggrin.gif', '{L_SMILIES_VERY_HAPPY}', 15, 17, 2);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':grin:', 'icon_e_biggrin.gif', '{L_SMILIES_VERY_HAPPY}', 15, 17, 3);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':)', 'icon_e_smile.gif', '{L_SMILIES_SMILE}', 15, 17, 4);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-)', 'icon_e_smile.gif', '{L_SMILIES_SMILE}', 15, 17, 5);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':smile:', 'icon_e_smile.gif', '{L_SMILIES_SMILE}', 15, 17, 6);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (';)', 'icon_e_wink.gif', '{L_SMILIES_WINK}', 15, 17, 7);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (';-)', 'icon_e_wink.gif', '{L_SMILIES_WINK}', 15, 17, 8);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':wink:', 'icon_e_wink.gif', '{L_SMILIES_WINK}', 15, 17, 9);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':(', 'icon_e_sad.gif', '{L_SMILIES_SAD}', 15, 17, 10);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-(', 'icon_e_sad.gif', '{L_SMILIES_SAD}', 15, 17, 11);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':sad:', 'icon_e_sad.gif', '{L_SMILIES_SAD}', 15, 17, 12);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':o', 'icon_e_surprised.gif', '{L_SMILIES_SURPRISED}', 15, 17, 13);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-o', 'icon_e_surprised.gif', '{L_SMILIES_SURPRISED}', 15, 17, 14);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':eek:', 'icon_e_surprised.gif', '{L_SMILIES_SURPRISED}', 15, 17, 15);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':shock:', 'icon_eek.gif', '{L_SMILIES_SHOCKED}', 15, 17, 16);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':?', 'icon_e_confused.gif', '{L_SMILIES_CONFUSED}', 15, 17, 17);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-?', 'icon_e_confused.gif', '{L_SMILIES_CONFUSED}', 15, 17, 18);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':???:', 'icon_e_confused.gif', '{L_SMILIES_CONFUSED}', 15, 17, 19);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES ('8-)', 'icon_cool.gif', '{L_SMILIES_COOL}', 15, 17, 20);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':cool:', 'icon_cool.gif', '{L_SMILIES_COOL}', 15, 17, 21);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':lol:', 'icon_lol.gif', '{L_SMILIES_LAUGHING}', 15, 17, 22);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':x', 'icon_mad.gif', '{L_SMILIES_MAD}', 15, 17, 23);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-x', 'icon_mad.gif', '{L_SMILIES_MAD}', 15, 17, 24);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':mad:', 'icon_mad.gif', '{L_SMILIES_MAD}', 15, 17, 25);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':P', 'icon_razz.gif', '{L_SMILIES_RAZZ}', 15, 17, 26);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-P', 'icon_razz.gif', '{L_SMILIES_RAZZ}', 15, 17, 27);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':razz:', 'icon_razz.gif', '{L_SMILIES_RAZZ}', 15, 17, 28);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':oops:', 'icon_redface.gif', '{L_SMILIES_EMARRASSED}', 15, 17, 29);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':cry:', 'icon_cry.gif', '{L_SMILIES_CRYING}', 15, 17, 30);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':evil:', 'icon_evil.gif', '{L_SMILIES_EVIL}', 15, 17, 31);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':twisted:', 'icon_twisted.gif', '{L_SMILIES_TWISTED_EVIL}', 15, 17, 32);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':roll:', 'icon_rolleyes.gif', '{L_SMILIES_ROLLING_EYES}', 15, 17, 33);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':!:', 'icon_exclaim.gif', '{L_SMILIES_EXCLAMATION}', 15, 17, 34);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':?:', 'icon_question.gif', '{L_SMILIES_QUESTION}', 15, 17, 35);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':idea:', 'icon_idea.gif', '{L_SMILIES_IDEA}', 15, 17, 36);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':arrow:', 'icon_arrow.gif', '{L_SMILIES_ARROW}', 15, 17, 37);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':|', 'icon_neutral.gif', '{L_SMILIES_NEUTRAL}', 15, 17, 38);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':-|', 'icon_neutral.gif', '{L_SMILIES_NEUTRAL}', 15, 17, 39);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':mrgreen:', 'icon_mrgreen.gif', '{L_SMILIES_MR_GREEN}', 15, 17, 40);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':geek:', 'icon_e_geek.gif', '{L_SMILIES_GEEK}', 17, 17, 41);
INSERT INTO phpbb_smilies (code, smiley_url, emotion, smiley_width, smiley_height, smiley_order) VALUES (':ugeek:', 'icon_e_ugeek.gif', '{L_SMILIES_UBER_GEEK}', 17, 18, 42);

# -- icons
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('misc/fire.gif', 16, 16, 1, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('smile/redface.gif', 16, 16, 9, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('smile/mrgreen.gif', 16, 16, 10, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('misc/heart.gif', 16, 16, 4, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('misc/star.gif', 16, 16, 2, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('misc/radioactive.gif', 16, 16, 3, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('misc/thinking.gif', 16, 16, 5, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('smile/info.gif', 16, 16, 8, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('smile/question.gif', 16, 16, 6, 1);
INSERT INTO phpbb_icons (icons_url, icons_width, icons_height, icons_order, display_on_posting) VALUES ('smile/alert.gif', 16, 16, 7, 1);

# -- k_blocks
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(1, 1, 'Site Navigator', 'L', 'B', 1, 'block_menus_nav.html', '', 'menu.png', 1, '0', '1,2,3,4,5,6,7,8,9,11,12', 0, 0, 0, 0, 0, 0, 0, 600);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(2, 2, 'Sub_Menu', 'L', 'B', 1, 'block_menus_sub.html', '', 'sub_menu.png', 1, '0', '1,2,3,4,5,6,7,8,9,11,12', 0, 0, 0, 0, 0, 0, 0, 600);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(3, 2, 'Links_Menu', 'L', 'B', 1, 'block_menus_links.html', '', 'sub_menu.png', 1, '0', '1,2,3,4,5,6,7,8,9,11,12', 0, 0, 0, 0, 0, 0, 0, 600);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(4, 4, 'Online Users', 'L', 'B', 1, 'block_online_users.html', '', 'online_users.png', 1, '0', '1,2,3,4,5,6,7,8,9,11,12', 0, 0, 0, 0, 0, 0, 0, 600);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(5, 5, 'Last Online', 'L', 'B', 1, 'block_last_online.html', 'k_last_online_vars.html', 'last_online.png', 1, '0', '2,3,4,5,6,7,8,9,11,12', 0, 0, 0, 1, 0, 0, 0, 300);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(6, 8, 'Search', 'L', 'B', 1, 'block_search.html', '', 'search.png', 0, '0,2,3,4,5,7', '1,2,3,4,5,6,7,9,11,12', 0, 0, 0, 0, 0, 0, 0, 600);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(7, 10, 'Categories', 'L', 'B', 1, 'block_forum_categories.html', '', 'categories.png', 1, '0', '2', 0, 0, 0, 0, 0, 0, 0, 667);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(8, 2, 'Welcome', 'C', 'H', 1, 'block_welcome.html', '', 'welcome.png', 1, '0', '2', 0, 0, 0, 1, 0, 0, 0, 999);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(9, 3, 'Announcements', 'C', 'H', 1, 'block_announcements.html', 'k_announce_vars.html', 'announce.png', 1, '0', '2', 0, 0, 0, 1, 0, 0, 0, 300);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(10, 4, 'Recent Topics', 'C', 'H', 1, 'block_recent_topics_wide.html', 'k_recent_topics_vars.html', 'recent_topics.png', 1, '0', '2', 0, 0, 200, 1, 0, 0, 0, 20);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(11, 5, 'News Report', 'C', 'H', 1, 'block_news.html', 'k_news_vars.html', 'news.png', 1, '0', '2', 0, 0, 0, 1, 0, 0, 0, 50);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(12, 2, 'User Information', 'R', 'H', 1, 'block_user_information.html', 'k_user_information_vars.html', 'user.png', 1, '0', '2,5,8,9', 0, 0, 0, 1, 0, 0, 0, 600);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(13, 3, 'The Team', 'R', 'H', 1, 'block_the_teams.html', 'k_the_teams_vars.html', 'team.png', 1, '0', '2,5,8,9', 0, 0, 0, 1, 0, 0, 0, 555);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(14, 4, 'Top Posters', 'R', 'H', 1, 'block_top_posters.html', 'k_top_posters_vars.html', 'rating.png', 1, '0', '2,5,8,9', 0, 0, 0, 1, 0, 0, 0, 200);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(15, 5, 'Most Active Topics', 'R', 'H', 1, 'block_top_topics.html', 'k_top_topics_vars.html', 'most_active_topics.png', 1, '0', '2', 0, 0, 0, 1, 0, 0, 0, 100);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(16, 7, 'Clock', 'R', 'B', 1, 'block_clock.html', '', 'clock.gif', 1, '0', '2', 0, 0, 0, 0, 0, 0, 0, 6009);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(17, 6, 'Links', 'R', 'H', 0, 'block_links.html', 'k_links_vars.html', 'www.gif', 1, '0', '2,5,8,9,12', 0, 1, 0, 1, 0, 0, 0, 668);
INSERT INTO phpbb_k_blocks (id, ndx, title, position, type, active, html_file_name, var_file_name, img_file_name, view_all, view_groups, view_pages, groups, scroll, block_height, has_vars, is_static, minimod_based, mod_block_id, block_cache_time) VALUES(18, 1, 'Calendar', 'R', 'H', 1, 'block_calendar.html', '', 'calendar.png', 1, '', '2', 0, 0, 0, 0, 0, 0, 0, 0);

# -- k_blocks_config
INSERT INTO phpbb_k_blocks_config VALUES (1, 0, 0, 2, 'Site');

# -- k_config_vars
INSERT INTO phpbb_k_config_vars VALUES ('k_announce_allow', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_allow_acronyms', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_bot_display_allow', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_footer_images_allow', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_news_allow', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_announce_type', '0', 1);
INSERT INTO phpbb_k_config_vars VALUES ('k_blocks_display_globally', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_smilies_show', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_links_scroll_amount', '0', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_links_scroll_direction', '0', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_announce_item_max_length', '400', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_news_item_max_length', '350', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_last_online_max', '10', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_news_type', '0', 1);
INSERT INTO phpbb_k_config_vars VALUES ('k_announce_to_display', '5', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_links_to_display', '5', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_links_forum_id', '', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_news_items_to_display', '5', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_recent_topics_to_display', '25', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_recent_topics_per_forum', '5', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_top_posters_to_display', '10', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_top_posters_show', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_recent_search_days', '7', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_allow_rotating_logos', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_post_types', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_top_topics_max', '5', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_adm_block', '16', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_quick_reply', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_recent_topics_search_exclude', '', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_top_topics_days', '7', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_block_cache_time_default', '600', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_block_cache_time_short', '10', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_teams', '', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_teams_display_this_many', '2', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_max_block_avatar_width', '80', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_max_block_avatar_height', '80', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_teampage_memberships', '0', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_tooltips_active', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_tooltips_which', '1', 0);
INSERT INTO phpbb_k_config_vars VALUES ('k_mod_folders', '', 0);

# -- k_menus
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(1, 1, 1, 'Main Menu', '', 0, 'default.png', 0, 0, 1, '', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(2, 2, 1, 'Portal', 'portal.php', 0, 'portal.png', 0, 0, 1, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(3, 3, 1, 'Forum', 'index.php', 0, 'home2.png', 0, 0, 1, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(4, 4, 1, 'Navigator', '', 0, 'default.png', 0, 0, 1, '', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(5, 5, 1, 'Album', 'gallery/index.php', 0, 'gallery.png', 1, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(6, 6, 1, 'Downloads', 'inprogress.php', 0, 'ff.png', 0, 0, 0, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(7, 7, 1, 'Links', 'inprogress.php', 0, 'link.gif', 0, 0, 0, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(8, 8, 1, 'Members', 'memberlist.php', 0, 'chat.png', 0, 0, 0, '4,5', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(9, 9, 1, 'Knowledge Base', 'knowledge/index.php', 0, 'information.png', 0, 0, 1, '0', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(10, 10, 1, 'Rules', 'basic_rules.php', 0, 'rules.png', 0, 0, 1, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(11, 11, 1, 'Staff', 'memberlist.php?mode=leaders', 0, 'staff.png', 0, 0, 1, '0', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(12, 12, 1, 'Statistics', 'inprogress.php', 0, 'pie.png', 0, 0, 0, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(13, 13, 1, 'Shout', 'portal.php?page=shout', 0, 'shout.png', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(14, 14, 1, 'Calendar', 'calendar.php?mode=main', 0, 'calendar.png', 0, 0, 1, '0', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(15, 15, 1, 'Search', '', 0, 'search2.png', 0, 0, 0, '2,3,4,5,7', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(16, 16, 1, 'Actve topics', 'search.php?search_id=active_topics', 0, 'search.png', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(17, 17, 1, 'New Posts', 'search.php?search_id=newposts', 0, 'search.png', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(18, 18, 1, 'Your posts', 'search.php?search_id=egosearch', 0, 'search.png', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(19, 19, 1, 'Unread Posts', 'search.php?search_id=unanswered', 0, 'search.png', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(20, 20, 1, 'User Menu', '', 0, 'acp.png', 0, 0, 0, '2,3,4,5,7', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(21, 21, 1, 'UCP', 'ucp.php', 0, 'links.gif', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(22, 22, 1, 'Bookmarks', 'ucp.php?i=main&amp;mode=bookmarks', 0, 'bookmark.png', 0, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(23, 23, 1, 'Personal Album', 'gallery/search.php?search_id=egosearch', 0, 'gallery.png', 1, 0, 0, '2,3,4,5,7', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(24, 24, 1, 'Admin Menu', '', 0, 'default.png', 0, 0, 0, '5', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(25, 25, 1, 'ACP', 'adm/index.php', 0, 'acp.png', 1, 0, 0, '5', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(26, 26, 1, 'Create Pages', 'portal.php?page=pages', 0, 'help.png', 0, 0, 0, '5', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(27, 1, 2, 'Mini Menu', '', 0, 'default.png', 0, 0, 1, '', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(28, 2, 2, 'Active Posts', 'search.php?search_id=active_topics', 0, 'links.png', 0, 0, 1, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(29, 1, 5, 'Lnks Menu', '', 0, 'default.png', 0, 0, 1, '', 0, 1);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(30, 2, 5, 'Kiss Portal', 'http://www.phpbbireland.com', 1, 'phpireland_globe.gif', 0, 0, 1, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(31, 3, 5, 'ForumImages', 'http://www.forumimages.us', 1, 'phpireland_globe.gif', 0, 0, 1, '', 0, 0);
INSERT INTO phpbb_k_menus (m_id, ndx, menu_type, name, link_to, extern, menu_icon, append_sid, append_uid, view_all, view_groups, soft_hr, sub_heading) VALUES(32, 4, 5, 'phpBB3', 'http://www.phpbb.com', 1, 'phpireland_globe.gif', 0, 0, 1, '', 0, 0);

# -- k_pages
INSERT INTO phpbb_k_pages VALUES (1, 'index');
INSERT INTO phpbb_k_pages VALUES (2, 'portal');
INSERT INTO phpbb_k_pages VALUES (3, 'viewforum');
INSERT INTO phpbb_k_pages VALUES (4, 'viewtopic');
INSERT INTO phpbb_k_pages VALUES (5, 'memberlist');
INSERT INTO phpbb_k_pages VALUES (6, 'mcp');
INSERT INTO phpbb_k_pages VALUES (7, 'ucp');
INSERT INTO phpbb_k_pages VALUES (8, 'search');
INSERT INTO phpbb_k_pages VALUES (9, 'faq');
INSERT INTO phpbb_k_pages VALUES (10, 'posting');
INSERT INTO phpbb_k_pages VALUES (11, 'portal&amp;page=pages');
INSERT INTO phpbb_k_pages VALUES (12, 'portal&amp;page=shout');
INSERT INTO phpbb_k_pages VALUES (13, 'gallery/index');
INSERT INTO phpbb_k_pages VALUES (14, 'gallery/album');
INSERT INTO phpbb_k_pages VALUES (15, 'gallery/image');
INSERT INTO phpbb_k_pages VALUES (16, 'gallery/image_page');
INSERT INTO phpbb_k_pages VALUES (17, 'gallery/posting');
INSERT INTO phpbb_k_pages VALUES (18, 'knowledge/index');
INSERT INTO phpbb_k_pages VALUES (19, 'knowledge/viewcategorie');
INSERT INTO phpbb_k_pages VALUES (20, 'knowledge/viewarticle');
INSERT INTO phpbb_k_pages VALUES (21, 'knowledge/kb-search');
INSERT INTO phpbb_k_pages VALUES (22, 'calendar');

# -- k_resources
INSERT INTO phpbb_k_resources VALUES (1, 'phpBB', 'R');
INSERT INTO phpbb_k_resources VALUES (2, '{PORTAL_VERSION}', 'V');
INSERT INTO phpbb_k_resources VALUES (3, '{PORTAL_BUILD}', 'V');
INSERT INTO phpbb_k_resources VALUES (4, '{VERSION}', 'V');
INSERT INTO phpbb_k_resources VALUES (5, '{SITENAME}', 'V');
INSERT INTO phpbb_k_resources VALUES (6, '{PREMOD_VERSION}', 'V');

# -- reasons
INSERT INTO phpbb_reports_reasons (reason_title, reason_description, reason_order) VALUES ('warez', '{L_REPORT_WAREZ}', 1);
INSERT INTO phpbb_reports_reasons (reason_title, reason_description, reason_order) VALUES ('spam', '{L_REPORT_SPAM}', 2);
INSERT INTO phpbb_reports_reasons (reason_title, reason_description, reason_order) VALUES ('off_topic', '{L_REPORT_OFF_TOPIC}', 3);
INSERT INTO phpbb_reports_reasons (reason_title, reason_description, reason_order) VALUES ('other', '{L_REPORT_OTHER}', 4);

# -- extension_groups
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('IMAGES', 1, 1, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('ARCHIVES', 0, 1, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('PLAIN_TEXT', 0, 0, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('DOCUMENTS', 0, 0, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('REAL_MEDIA', 3, 0, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('WINDOWS_MEDIA', 2, 0, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('FLASH_FILES', 5, 0, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('QUICKTIME_MEDIA', 6, 0, 1, '', 0, '');
INSERT INTO phpbb_extension_groups (group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, allowed_forums) VALUES ('DOWNLOADABLE_FILES', 0, 0, 1, '', 0, '');

# -- extensions
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'gif');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'png');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'jpeg');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'jpg');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'tif');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'tiff');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (1, 'tga');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'gtar');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'gz');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'tar');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'zip');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'rar');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'ace');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'torrent');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'tgz');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, 'bz2');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (2, '7z');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'txt');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'c');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'h');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'cpp');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'hpp');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'diz');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'csv');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'ini');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'log');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'js');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (3, 'xml');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'xls');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'xlsx');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'xlsm');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'xlsb');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'doc');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'docx');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'docm');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'dot');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'dotx');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'dotm');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'pdf');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'ai');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'ps');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'ppt');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'pptx');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'pptm');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'odg');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'odp');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'ods');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'odt');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (4, 'rtf');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (5, 'rm');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (5, 'ram');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (6, 'wma');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (6, 'wmv');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (7, 'swf');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, 'mov');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, 'm4v');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, 'm4a');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, 'mp4');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, '3gp');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, '3g2');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (8, 'qt');

INSERT INTO phpbb_extensions (group_id, extension) VALUES (9, 'mpeg');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (9, 'mpg');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (9, 'mp3');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (9, 'ogg');
INSERT INTO phpbb_extensions (group_id, extension) VALUES (9, 'ogm');

# -- phpbb_bbcodes
INSERT INTO phpbb_bbcodes (bbcode_id, bbcode_tag, bbcode_helpline, display_on_posting, bbcode_match, bbcode_tpl, first_pass_match, first_pass_replace, second_pass_match, second_pass_replace) VALUES (13, 'album', 'GALLERY_HELPLINE_ALBUM', 1, '[album]{NUMBER}[/album]', '<a href="gallery/image.php?image_id={NUMBER}"><img src="gallery/image.php?mode=thumbnail&amp;image_id={NUMBER}" alt="{NUMBER}" /></a>', '!\\[album\\]([0-9]+)\\[/album\\]!i', '[album:$uid]${1}[/album:$uid]', '!\\[album:$uid\\]([0-9]+)\\[/album:$uid\\]!s', '<a href="gallery/image.php?image_id=${1}"><img src="gallery/image.php?mode=thumbnail&amp;image_id=${1}" alt="${1}" /></a>');

# -- phpbb_kb_config
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('kb_title', '{L_KB_NAME}', 1);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('kb_description', '', 1);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('post_subject', '', 1);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('post_message', '', 1);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('index_topics', '3', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('topic_type', '0', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('post_user', '2', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('kb_mode', '1', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('cache_time', '3600', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('activ_types', '1', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('show_post_edit', '1', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('sort_order_dir', 'ASC', 1);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('sort_order', 'hits', 1);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('activ_similar', '0', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('activ_diff', '1', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('activ_post', '0', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('activ_rating', '1', 0);
INSERT INTO phpbb_kb_config (config_name, config_value, config_type) VALUES('update_post', '0', 0);
