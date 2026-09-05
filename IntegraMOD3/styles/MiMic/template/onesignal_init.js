/**
 * OneSignal Web Push SDK v16 Integration for IntegraMOD 3.0.16
 *
 * This script initializes the OneSignal Web Push SDK (v16, current supported version)
 * for browser notifications.
 *
 * @package IntegraMOD
 * @version 2.0.0
 * @author HelterSkelter
 * @license GNU Public License v2
 */

(function() {
    'use strict';

    // Load OneSignal configuration from phpBB config (injected via template)
    if (typeof ONESIGNAL_APP_ID === 'undefined' || !ONESIGNAL_APP_ID) {
        console.warn('OneSignal: App ID not configured');
        return;
    }

    window.OneSignalDeferred = window.OneSignalDeferred || [];

    OneSignalDeferred.push(async function(OneSignal) {
        await OneSignal.init({
            appId: ONESIGNAL_APP_ID,
            allowLocalhostAsSecureOrigin: true
        });

        // Tie this browser subscription to the phpBB user ID when logged in.
        // trigger_user_push() targets this via include_external_user_ids (aliased in v16).
        if (typeof PHPBB_USER_ID !== 'undefined' && PHPBB_USER_ID > 0) {
            await OneSignal.login(String(PHPBB_USER_ID));
        }

        // Handle subscription state changes
        OneSignal.User.PushSubscription.addEventListener('change', function(event) {
            console.log('OneSignal subscription state changed:', event.current && event.current.optedIn);
        });
    });

    // Load OneSignal SDK v16 page script
    var script = document.createElement('script');
    script.src = 'https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js';
    script.defer = true;
    document.head.appendChild(script);

})();
