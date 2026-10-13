# OneSignal Push Notifications for IntegraMOD 3.0.16

## Overview

This module integrates OneSignal push notifications into IntegraMOD 3.0.16 (phpBB 3.0.15), providing real-time browser notifications for forum events including private messages, likes, friend requests, subscribed topics, and news/announcements.

---

## Features

### 📊 **Admin Control Panel (ACP)**
- Configure OneSignal API credentials (App ID and REST API Key)
- Global toggles for each notification type:
  - Friend Requests
  - Friend Accepts
  - Private Messages
  - Likes
  - Activity Notifications
  - Subscribed Post Replies
  - Subscribed Topic Updates
  - News Broadcasts
  - Announcement Broadcasts
- Manual broadcast notifications to all users

### 👥 **User Control Panel (UCP)**
- Per-user notification preferences
- Only displays notification types enabled by admins
- Granular control over which events trigger push notifications

### 🔔 **Supported Events**
- **Private Messages**: Real-time PM notifications
- **News & Announcements**: Mass broadcast support
- **Friend Requests/Accepts** (ready for integration)
- **Likes** (ready for integration)
- **Activity Updates** (ready for integration)
- **Topic/Post Subscriptions** (ready for integration)

---

## Installation

### Prerequisites

1. **OneSignal Account**
   - Sign up at [https://onesignal.com](https://onesignal.com)
   - Create a new Web Push app
   - Note your `App ID` and `REST API Key`

2. **SSL Certificate**
   - Your forum must be served over HTTPS for web push to work

### Step 1: Database Migration

Run the SQL schema migration to add required config values and user preference columns:

```bash
mysql -u [username] -p [database_name] < install/schemas/onesignal_push_notifications.sql
```

Or manually execute via phpMyAdmin.

### Step 2: Configure OneSignal in ACP

1. Log in to the ACP
2. Navigate to **General** → **Board Configuration** → **Push Notifications** (or wherever the module is registered)
3. Enter your OneSignal **App ID** and **REST API Key**
4. Enable/disable global notification types as desired
5. Save settings

### Step 3: Add OneSignal SDK to Templates

Add the following line to your forum's `overall_header.html` template (before `</head>`):

```html
<!-- INCLUDE onesignal_sdk.html -->
```

**File locations:**
- ProSilver: `styles/prosilver/template/overall_header.html`
- IM3 Custom: `styles/IM/template/overall_header.html`
- Other styles: Adjust path accordingly

### Step 4: Register ACP & UCP Modules

#### ACP Module

Via SQL:

```sql
INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) 
VALUES (1, 1, 'acp_push', 'acp', 0, 0, 0, 'ACP_PUSH_NOTIFICATIONS', '', 'acl_a_board');
```

Or via ACP → System → Module Management → Add Module.

#### UCP Module

Via SQL:

```sql
INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) 
VALUES (1, 1, 'ucp_push', 'ucp', 0, 0, 0, 'UCP_PUSH_NOTIFICATIONS', 'settings', '');
```

Or via ACP → System → Module Management → Add Module.

### Step 5: Verify Installation

1. Visit UCP → Push Notifications
2. Enable desired notification types
3. Accept browser push notification permissions when prompted
4. Test by sending yourself a PM from another account

---

## Architecture

### Core Components

#### 1. **Database Schema** (`install/schemas/onesignal_push_notifications.sql`)
- 11 global config keys in `phpbb_config`
- 9 user preference columns in `phpbb_users`

#### 2. **Dispatcher Functions** (`includes/functions_push.php`)
- `trigger_user_push($target_user_id, $event_type, $title, $message, $url = '')`
  - Sends push to a single user
  - Checks global ACP toggle and user preference
  - Uses OneSignal `include_external_user_ids`

- `trigger_mass_push($event_type, $title, $message, $url = '')`
  - Sends push to all users who have enabled the event type
  - Chunks recipients into batches of 2000 (OneSignal limit)

- `onesignal_send_request($payload, $rest_key)`
  - Internal helper for cURL requests to OneSignal API
  - PHP 5.6+ compatible (uses `CURLOPT_SSL_VERIFYPEER = false`)

#### 3. **Admin Control** (`includes/acp/acp_push.php`)
- ACP module with two modes:
  - **Settings**: Configure API credentials and global toggles
  - **Send**: Manual broadcast form for admins

#### 4. **User Preferences** (`includes/ucp/ucp_push.php`)
- UCP module allowing users to customize their notification preferences
- Dynamically hides options disabled by admins

#### 5. **Core Integration Hooks**
- **PM Notifications**: `includes/functions_privmsgs.php` → `pm_notification()`
- **Post Notifications**: `includes/functions_posting.php` → `submit_post()`

#### 6. **Front-End SDK** (`styles/prosilver/template/onesignal_init.js`)
- Initializes OneSignal Web Push SDK
- Maps phpBB user ID to OneSignal external user ID
- Handles subscription state changes

---

## Configuration Reference

### Global ACP Toggles

| Config Key | Description |
|------------|-------------|
| `onesignal_app_id` | OneSignal Application ID |
| `onesignal_rest_key` | OneSignal REST API Key |
| `push_allow_friend_req` | Enable friend request notifications |
| `push_allow_friend_acc` | Enable friend accept notifications |
| `push_allow_pm` | Enable private message notifications |
| `push_allow_like` | Enable like notifications |
| `push_allow_activity` | Enable activity notifications |
| `push_allow_sub_post` | Enable subscribed post notifications |
| `push_allow_sub_topic` | Enable subscribed topic notifications |
| `push_allow_news` | Enable news broadcast notifications |
| `push_allow_announce` | Enable announcement broadcast notifications |

### User Preference Columns

| Column Name | Description |
|-------------|-------------|
| `user_push_friend_req` | User preference for friend request notifications |
| `user_push_friend_acc` | User preference for friend accept notifications |
| `user_push_pm` | User preference for private message notifications |
| `user_push_like` | User preference for like notifications |
| `user_push_activity` | User preference for activity notifications |
| `user_push_sub_post` | User preference for subscribed post notifications |
| `user_push_sub_topic` | User preference for subscribed topic notifications |
| `user_push_news` | User preference for news notifications |
| `user_push_announce` | User preference for announcement notifications |

All default to `1` (enabled) upon user account creation.

---

## Usage Examples

### 1. Sending a Push to a Single User (Code)

```php
if (!function_exists('trigger_user_push'))
{
	include($phpbb_root_path . 'includes/functions_push.' . $phpEx);
}

trigger_user_push(
	42,                                 // Target user ID
	'pm',                               // Event type
	'New Message from Admin',           // Notification title
	'You have received a new PM!',      // Notification body
	'https://yoursite.com/ucp.php?i=pm' // Click destination URL
);
```

### 2. Sending a Mass Broadcast (ACP Interface)

1. ACP → Push Notifications → Send Broadcast
2. Select event type: News or Announcement
3. Enter title and message
4. Optionally provide a URL
5. Submit

---

## Troubleshooting

### Push Notifications Not Received

1. **Check API Keys**
   - ACP → Push Settings → Verify App ID and REST API Key

2. **Verify Global Toggles**
   - Ensure the event type is enabled in ACP

3. **User Preferences**
   - User must have enabled the notification type in UCP

4. **Browser Permissions**
   - User must have granted push notification permission

5. **HTTPS Required**
   - OneSignal requires SSL for web push

6. **Check Browser Console**
   - Open Developer Tools → Console for JavaScript errors

### Database Errors

If you see errors about missing columns:

```bash
# Re-run migration
mysql -u [user] -p [db] < install/schemas/onesignal_push_notifications.sql
```

### cURL Errors

If push requests fail:

- Ensure `curl` PHP extension is enabled
- Check `allow_url_fopen` is enabled in `php.ini`
- Verify server can reach `https://onesignal.com`

---

## Compatibility

| Component | Requirement |
|-----------|-------------|
| **phpBB Version** | 3.0.15 (IntegraMOD 3.0.16) |
| **PHP Version** | 5.6 – 8.5 |
| **Database** | MySQL 5.x+, MariaDB 10.x+ |
| **Web Server** | Apache, Nginx, IIS |
| **SSL** | Required for Web Push |
| **Browsers** | Chrome, Firefox, Safari, Edge (modern versions) |

---

## Security Considerations

1. **API Key Protection**
   - REST API Key is stored in `phpbb_config`
   - Only accessible to board administrators
   - Never exposed to front-end code

2. **User ID Mapping**
   - OneSignal uses phpBB `user_id` as external user ID
   - No sensitive data sent to OneSignal

3. **Permission Gating**
   - Push delivery respects both global ACP toggles and user preferences
   - Users cannot receive notifications they have disabled

4. **cURL SSL**
   - Legacy compatibility mode uses `CURLOPT_SSL_VERIFYPEER = false`
   - For production, consider updating to modern cURL with proper SSL verification

---

## Extending the Integration

### Adding New Event Types

1. **Update Database Schema**
   ```sql
   INSERT INTO phpbb_config (config_name, config_value, is_dynamic) 
   VALUES ('push_allow_custom_event', '1', 0);

   ALTER TABLE phpbb_users 
   ADD COLUMN user_push_custom_event TINYINT(1) NOT NULL DEFAULT '1';
   ```

2. **Update ACP Template** (`adm/style/acp_push.html`)
   ```html
   <dl>
	   <dt><label for="push_allow_custom_event">{L_PUSH_ALLOW_CUSTOM_EVENT}:</label></dt>
	   <dd>
		   <input type="radio" name="push_allow_custom_event" value="1" {PUSH_ALLOW_CUSTOM_EVENT} /> {L_YES}
		   <input type="radio" name="push_allow_custom_event" value="0" {!PUSH_ALLOW_CUSTOM_EVENT} /> {L_NO}
	   </dd>
   </dl>
   ```

3. **Update Language Files** (`language/en/mods/acp_push.php`)
   ```php
   'PUSH_ALLOW_CUSTOM_EVENT' => 'Allow Custom Event Notifications',
   ```

4. **Trigger Push in Code**
   ```php
   trigger_user_push($user_id, 'custom_event', 'Title', 'Message', 'URL');
   ```

---

## Performance Notes

- **Mass Broadcasts**: Automatically chunked to 2000 users per API call
- **Database Queries**: Minimal impact; only queries users with enabled preferences
- **Async Recommended**: For high-traffic sites, consider queuing push requests (e.g., via cron)

---

## Rollback

To completely remove the integration:

```sql
-- Remove config keys
DELETE FROM phpbb_config WHERE config_name IN (
	'onesignal_app_id', 'onesignal_rest_key',
	'push_allow_friend_req', 'push_allow_friend_acc', 
	'push_allow_pm', 'push_allow_like', 'push_allow_activity',
	'push_allow_sub_post', 'push_allow_sub_topic',
	'push_allow_news', 'push_allow_announce'
);

-- Remove user preference columns
ALTER TABLE phpbb_users 
DROP COLUMN user_push_friend_req,
DROP COLUMN user_push_friend_acc,
DROP COLUMN user_push_pm,
DROP COLUMN user_push_like,
DROP COLUMN user_push_activity,
DROP COLUMN user_push_sub_post,
DROP COLUMN user_push_sub_topic,
DROP COLUMN user_push_news,
DROP COLUMN user_push_announce;
```

Then manually delete the added files and remove the template include.

---

## Credits

- **Author**: HelterSkelter
- **Version**: 1.0.0
- **License**: GNU General Public License v2
- **Platform**: IntegraMOD 3.0.16 (phpBB 3.0.15)
- **Year**: 2024

---

## Support

For issues, feature requests, or contributions:

- IntegraMOD Community Forums
- GitHub Repository (if applicable)

---

## Changelog

### v1.0.0 (2024)
- Initial release
- OneSignal Web Push SDK integration
- ACP settings and broadcast interface
- UCP user preferences
- PM and news/announcement push triggers
- PHP 5.6–8.5 compatibility
- Database schema migration
