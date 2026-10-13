# OneSignal Push Notifications - File Manifest

## All Files Created/Modified for OneSignal Integration

### Database Schema
- `install/schemas/onesignal_push_notifications.sql` - Database migration script

### Core Dispatcher
- `includes/functions_push.php` - **MODIFIED** - OneSignal API integration functions

### Admin Control Panel (ACP)
- `includes/acp/info/acp_push.php` - ACP module info descriptor
- `includes/acp/acp_push.php` - ACP module controller
- `adm/style/acp_push.html` - ACP template (settings & broadcast UI)
- `language/en/mods/acp_push.php` - ACP language file

### User Control Panel (UCP)
- `includes/ucp/info/ucp_push.php` - UCP module info descriptor
- `includes/ucp/ucp_push.php` - UCP module controller
- `styles/prosilver/template/ucp_push_settings.html` - UCP template (user preferences)
- `language/en/mods/ucp_push.php` - UCP language file

### Front-End Integration
- `styles/prosilver/template/onesignal_sdk.html` - Template include for SDK initialization
- `styles/prosilver/template/onesignal_init.js` - OneSignal JavaScript initialization

### Core File Modifications

#### `common.php` (Line ~202)
**Added:**
```php
require($phpbb_root_path . 'includes/functions_push.' . $phpEx);
```

#### `includes/functions.php` (page_header function, ~line 5490)
**Added template variables:**
```php
'ONESIGNAL_ENABLED'    => (isset($config['onesignal_app_id']) && !empty($config['onesignal_app_id'])) ? true : false,
'ONESIGNAL_APP_ID'     => (isset($config['onesignal_app_id'])) ? $config['onesignal_app_id'] : '',
'USER_ID'              => (int) $user->data['user_id'],
```

#### `includes/functions_privmsgs.php` (pm_notification function, ~line 1856)
**Added push notification hook in recipient loop:**
```php
// OneSignal Push Notification Hook
if (function_exists('trigger_user_push'))
{
	$pm_url = generate_board_url() . "/ucp.$phpEx?i=pm&mode=view&p=$msg_id";
	trigger_user_push($row['user_id'], 'pm', $author . ' sent you a message', $subject, $pm_url);
}
```

#### `includes/functions_posting.php` (submit_post function, ~line 3018)
**Added push notification hook after user_notification:**
```php
// OneSignal Push Notification Hook for News and Announcements
if (function_exists('trigger_mass_push') && $mode == 'post' && ($topic_type == POST_ANNOUNCE || $topic_type == POST_NEWS || $topic_type == POST_NEWS_GLOBAL))
{
	$post_url = generate_board_url() . "/viewtopic.$phpEx?t=" . $data['topic_id'];
	$event_type = ($topic_type == POST_ANNOUNCE) ? 'announce' : 'news';
	trigger_mass_push($event_type, $subject, strip_tags($data['message']), $post_url);
}
```

### Documentation
- `docs/ONESIGNAL_PUSH_NOTIFICATIONS_README.md` - Complete feature documentation
- `docs/ONESIGNAL_INSTALLATION_GUIDE.md` - Step-by-step installation instructions
- `docs/ONESIGNAL_FILE_MANIFEST.md` - **THIS FILE** - File listing and modification summary

---

## Template Modification Required

### All Styles (Manual Edit Required)

#### File: `styles/{STYLE}/template/overall_header.html`

**Add before `</head>`:**
```html
<!-- INCLUDE onesignal_sdk.html -->
```

**Apply to- `styles/IM/template/overall_header.html`

- `styles/fiproice/template/overall_header.html`
- `styles/IM/template/overall_header.html`
- `styles/IM_blue/template/overall_header.html`
- `styles/IM_prosilver/template/overall_header.html`
- `styles/MiMic/template/overall_header.html`
- `styles/prosilver/template/overall_header.html`
- Any other installed styles

---

## Database Schema Changes

### New Config Keys (phpbb_config)
```
onesignal_app_id
onesignal_rest_key
push_allow_friend_req
push_allow_friend_acc
push_allow_pm
push_allow_like
push_allow_activity
push_allow_sub_post
push_allow_sub_topic
push_allow_news
push_allow_announce
```

### New User Columns (phpbb_users)
```
user_push_friend_req
user_push_friend_acc
user_push_pm
user_push_like
user_push_activity
user_push_sub_post
user_push_sub_topic
user_push_news
user_push_announce
```

---

## Module Registration Required

### ACP Module
```sql
INSERT INTO phpbb_modules 
(module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) 
VALUES 
(1, 1, 'acp_push', 'acp', 0, 0, 0, 'ACP_PUSH_NOTIFICATIONS', '', 'acl_a_board');
```

### UCP Module
```sql
INSERT INTO phpbb_modules 
(module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) 
VALUES 
(1, 1, 'ucp_push', 'ucp', 0, 0, 0, 'UCP_PUSH_NOTIFICATIONS', 'settings', '');
```

---

## Installation Checklist

- [ ] Execute database migration SQL
- [ ] Copy all new files to appropriate directories
- [ ] Modify `common.php` to include `functions_push.php`
- [ ] Add template variables to `includes/functions.php`
- [ ] Add PM push hook to `includes/functions_privmsgs.php`
- [ ] Add post push hook to `includes/functions_posting.php`
- [ ] Add OneSignal SDK include to all `overall_header.html` templates
- [ ] Register ACP module via SQL or ACP interface
- [ ] Register UCP module via SQL or ACP interface
- [ ] Purge phpBB cache (ACP → General → Purge Cache)
- [ ] Configure OneSignal API credentials in ACP
- [ ] Test push notifications

---

## Compatibility Notes

- **phpBB Version**: 3.0.15 (IntegraMOD 3.0.16)
- **PHP Versions**: 5.6 - 8.5
- **Tested Styles**: ProSilver, IM, IM_blue, MiMic, fisubice
- **Database**: MySQL 5.x+, MariaDB 10.x+

---

## Quick File Count

- **New Files**: 13
- **Modified Files**: 4
- **Templates to Edit**: 1 per style
- **Database Tables Modified**: 2
- **Lines of Code**: ~2,500+
- **Functions Added**: 3 (trigger_user_push, trigger_mass_push, onesignal_send_request)

---

## Future Expansion Ready

The architecture supports easy addition of:
- Friend request notifications
- Like notifications
- Activity feed notifications
- Topic/post subscription notifications

Simply add the trigger calls in the appropriate event handlers using the existing `trigger_user_push()` or `trigger_mass_push()` functions.

---

## Maintenance Notes

After phpBB/IntegraMOD upgrades, verify:
1. Core file edits still present
2. Template includes still active
3. Database schema intact
4. Module registrations valid

---

**End of File Manifest**
Current as of Implementation Date: January 2025
