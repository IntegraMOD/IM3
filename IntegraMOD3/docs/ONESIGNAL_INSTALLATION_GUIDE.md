# OneSignal Push Notifications - Installation Guide

## Quick Installation Checklist

- [ ] OneSignal account created and Web Push app configured
- [ ] Database migration executed
- [ ] ACP module registered
- [ ] UCP module registered  
- [ ] OneSignal SDK template included in `overall_header.html`
- [ ] API credentials configured in ACP
- [ ] Global notification toggles set
- [ ] Test notification sent successfully

---

## Detailed Step-by-Step Installation

### Step 1: Create OneSignal Account

1. Visit [https://onesignal.com](https://onesignal.com)
2. Sign up for a free account
3. Click **New App/Website**
4. Select **Web Push**
5. Configure your site settings:
   - **Site Name**: Your forum name
   - **Site URL**: `https://yourdomain.com` (must be HTTPS)
   - **Auto Resubscribe**: Enable (recommended)
6. Save and note your **App ID** and **REST API Key**

---

### Step 2: Execute Database Migration

#### Option A: Command Line (Recommended)

```bash
cd /path/to/your/forum
mysql -u your_username -p your_database < install/schemas/onesignal_push_notifications.sql
```

#### Option B: phpMyAdmin

1. Log in to phpMyAdmin
2. Select your forum database
3. Click **Import** tab
4. Choose file: `install/schemas/onesignal_push_notifications.sql`
5. Click **Go**

#### Option C: Manual Execution

Copy and paste the SQL from `install/schemas/onesignal_push_notifications.sql` into your database query tool.

**Verify Migration Success:**

```sql
-- Check config table
SELECT * FROM phpbb_config WHERE config_name LIKE 'onesignal%';
-- Should return 2 rows

-- Check user table columns
DESCRIBE phpbb_users;
-- Should show user_push_* columns
```

---

### Step 3: Register ACP Module

#### Option A: Via ACP Interface

1. Log in to ACP
2. Navigate to **System** → **Module Management** → **Admin Control Panel**
3. Click **Create Module**
4. Fill in:
   - **Parent**: General
   - **Module Class**: acp
   - **Module Basename**: acp_push
   - **Module Mode**: (leave blank)
   - **Language Key**: ACP_PUSH_NOTIFICATIONS
   - **Module Auth**: acl_a_board
5. Save

#### Option B: Via SQL

```sql
INSERT INTO phpbb_modules 
	(module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) 
VALUES 
	(1, 1, 'acp_push', 'acp', 0, 0, 0, 'ACP_PUSH_NOTIFICATIONS', '', 'acl_a_board');
```

**Note**: You may need to purge the cache after module registration:

ACP → General → Purge Cache

---

### Step 4: Register UCP Module

#### Option A: Via ACP Interface

1. Log in to ACP
2. Navigate to **System** → **Module Management** → **User Control Panel**
3. Click **Create Module**
4. Fill in:
   - **Parent**: Profile (or create a new category)
   - **Module Class**: ucp
   - **Module Basename**: ucp_push
   - **Module Mode**: settings
   - **Language Key**: UCP_PUSH_NOTIFICATIONS
   - **Module Auth**: (leave blank - all users)
5. Save

#### Option B: Via SQL

```sql
INSERT INTO phpbb_modules 
	(module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) 
VALUES 
	(1, 1, 'ucp_push', 'ucp', 0, 0, 0, 'UCP_PUSH_NOTIFICATIONS', 'settings', '');
```

---

### Step 5: Add OneSignal SDK to Templates

You need to modify your forum's `overall_header.html` template to load the OneSignal JavaScript SDK.

#### For ProSilver Style

**File**: `styles/prosilver/template/overall_header.html`

Add this line **before** `</head>`:

```html
<!-- INCLUDE onesignal_sdk.html -->
</head>
```

**Full context:**

```html
<meta name="keywords" content="" />

<!-- INCLUDE onesignal_sdk.html -->
</head>

<body id="phpbb" class="section-{SCRIPT_NAME} {S_CONTENT_DIRECTION}">
```

#### For IntegraMOD IM Style

**File**: `styles/IM/template/overall_header.html`

Add the same include before `</head>`.

#### For Other Custom Styles

Repeat the above process for any additional installed styles:

- `styles/UK/template/overall_header.html`
- `styles/MiMic/template/overall_header.html`
- etc.

**Purge Template Cache:**

After editing templates:

ACP → General → Purge Cache

---

### Step 6: Configure OneSignal API Credentials

1. Log in to ACP
2. Navigate to **General** → **Board Configuration** → **Push Notifications**
   - (Exact path depends on where the module was placed)
3. Enter your OneSignal credentials:
   - **App ID**: (from Step 1)
   - **REST API Key**: (from Step 1)
4. Configure global notification toggles:
   - Enable/disable each notification type as desired
   - Recommended to enable at least **Private Messages** and **News**
5. Click **Submit**
6. Verify success message appears

---

### Step 7: Test the Integration

#### A. Test User Subscription

1. Log in as a regular user (not admin)
2. Visit any forum page
3. Browser should prompt for push notification permission
4. **Allow** the notification request
5. Navigate to **UCP** → **Push Notifications**
6. Verify that enabled notification types appear
7. Toggle preferences and save

#### B. Test PM Notification

1. Log in as User A and enable PM notifications in UCP
2. Log in as User B from another browser/device
3. Send a PM to User A
4. User A should receive a browser push notification
5. Click the notification → should redirect to PM inbox

#### C. Test Admin Broadcast

1. Log in to ACP
2. Navigate to **Push Notifications** → **Send Broadcast**
3. Fill in:
   - **Event Type**: News
   - **Title**: Test Notification
   - **Message**: This is a test broadcast
   - **URL**: (optional)
4. Submit
5. All users who have enabled news notifications should receive it

---

## Post-Installation Configuration

### Fine-Tuning Global Toggles

Recommended settings for different forum types:

**High-Traffic Community Forum:**
```
PM: Enabled
Likes: Disabled (too frequent)
News: Enabled
Announcements: Enabled
Subscriptions: Disabled (use email instead)
```

**Small/Private Forum:**
```
All notification types: Enabled
Users control their own preferences
```

**Gaming Clan Forum:**
```
PM: Enabled
Activity: Enabled
News: Enabled
Friend Requests: Enabled
```

### OneSignal Dashboard Configuration

Log in to your OneSignal dashboard and configure:

1. **Delivery Settings**
   - Notification Icons
   - Badge Colors
   - Default Action URL

2. **Segments** (Optional)
   - Create user segments for targeted messaging
   - Example: "Active Users", "Moderators", etc.

3. **Analytics**
   - Monitor notification delivery rates
   - Track click-through rates

---

## Troubleshooting Installation Issues

### Database Migration Failed

**Error**: `Table 'phpbb_config' doesn't exist`

- **Solution**: Verify you're connected to the correct database and the phpBB table prefix is `phpbb_` (adjust if using custom prefix)

**Error**: `Duplicate column name 'user_push_pm'`

- **Solution**: Migration already executed. Safe to skip or run rollback first.

### Module Not Appearing in ACP

1. **Purge cache**: ACP → General → Purge Cache
2. **Check module table**:
   ```sql
   SELECT * FROM phpbb_modules WHERE module_basename = 'acp_push';
   ```
3. **Verify file permissions**: Ensure `includes/acp/acp_push.php` is readable

### Template Include Not Working

**Symptom**: SDK not loading, no browser prompt

1. **Verify template edit**: Check `overall_header.html` contains `<!-- INCLUDE onesignal_sdk.html -->`
2. **Purge template cache**: ACP → General → Purge Cache
3. **Check file exists**: `styles/prosilver/template/onesignal_sdk.html`
4. **Browser console**: Look for JavaScript errors (F12 → Console)

### SSL Certificate Issues

**Error**: OneSignal requires HTTPS

- **Solution**: Install an SSL certificate (Let's Encrypt is free)
- Redirect all HTTP traffic to HTTPS in `.htaccess`:

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### cURL Not Working

**Error**: `Call to undefined function curl_init()`

- **Solution**: Enable PHP cURL extension in `php.ini`:

```ini
extension=curl
```

Then restart your web server.

---

## Uninstallation

If you need to completely remove the OneSignal integration:

### 1. Remove Database Changes

```sql
-- Remove config
DELETE FROM phpbb_config WHERE config_name IN (
	'onesignal_app_id', 'onesignal_rest_key',
	'push_allow_friend_req', 'push_allow_friend_acc', 
	'push_allow_pm', 'push_allow_like', 'push_allow_activity',
	'push_allow_sub_post', 'push_allow_sub_topic',
	'push_allow_news', 'push_allow_announce'
);

-- Remove user columns
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

### 2. Unregister Modules

```sql
DELETE FROM phpbb_modules WHERE module_basename IN ('acp_push', 'ucp_push');
```

### 3. Remove Files

Delete:
- `includes/acp/acp_push.php`
- `includes/acp/info/acp_push.php`
- `includes/ucp/ucp_push.php`
- `includes/ucp/info/ucp_push.php`
- `adm/style/acp_push.html`
- `styles/prosilver/template/ucp_push_settings.html`
- `styles/prosilver/template/onesignal_sdk.html`
- `styles/prosilver/template/onesignal_init.js`
- `language/en/mods/acp_push.php`
- `language/en/mods/ucp_push.php`

### 4. Revert Core Edits

Remove from `common.php`:
```php
require($phpbb_root_path . 'includes/functions_push.' . $phpEx);
```

Remove from `includes/functions.php` (page_header function):
```php
// OneSignal Push Notifications
'ONESIGNAL_ENABLED'    => ...,
'ONESIGNAL_APP_ID'     => ...,
'USER_ID'              => ...,
```

Remove from `includes/functions_privmsgs.php` (pm_notification function):
```php
// OneSignal Push Notification Hook
if (function_exists('trigger_user_push')) { ... }
```

Remove from `includes/functions_posting.php` (submit_post function):
```php
// OneSignal Push Notification Hook for News and Announcements
if (function_exists('trigger_mass_push') && ...) { ... }
```

### 5. Remove Template Include

From all `overall_header.html` files:
```html
<!-- INCLUDE onesignal_sdk.html -->
```

### 6. Purge Cache

ACP → General → Purge Cache

---

## Upgrade Path

When upgrading IntegraMOD or phpBB:

1. **Backup** your database and files
2. **Note** any customizations you made to the push notification code
3. **Perform** the IntegraMOD/phpBB upgrade
4. **Re-apply** the push notification integration:
   - Core file edits in `common.php`, `functions.php`, `functions_privmsgs.php`, `functions_posting.php`
   - Template includes in `overall_header.html`
5. **Test** push notifications after upgrade

---

## Maintenance

### Regular Tasks

- **Monitor OneSignal Dashboard** for delivery metrics
- **Review** user notification preferences periodically
- **Optimize** global toggles based on user feedback

### Performance Optimization

For high-traffic forums (10,000+ users):

1. **Consider queuing** push notifications via cron jobs instead of real-time delivery
2. **Implement rate limiting** to prevent notification spam
3. **Monitor** OneSignal API rate limits and delivery quotas

---

## Support Resources

- **OneSignal Documentation**: [https://documentation.onesignal.com](https://documentation.onesignal.com)
- **IntegraMOD Forums**: [Your community forums]
- **phpBB Support**: [https://www.phpbb.com/support](https://www.phpbb.com/support)

---

## Next Steps

After successful installation:

1. Announce push notification feature to your users
2. Create a forum post explaining how to enable notifications
3. Monitor user adoption rates
4. Gather feedback and adjust toggle settings
5. Consider implementing additional event types (likes, friend requests, etc.)

---

**Installation complete!** 🎉

Your IntegraMOD forum now supports modern browser push notifications via OneSignal.
