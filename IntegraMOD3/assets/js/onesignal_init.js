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

    const appId = (typeof ONESIGNAL_APP_ID !== 'undefined') ? String(ONESIGNAL_APP_ID).replace(/^\s+|\s+$/g, '') : '';
    const phpbbUserId = (typeof PHPBB_USER_ID !== 'undefined') ? parseInt(PHPBB_USER_ID, 10) : 0;
    let oneSignalClient = null;
    let pendingSubscribe = false;

    const getStatusEl = () => document.querySelector('[data-onesignal-status]');

    const setStatus = (text) => {
        const status = getStatusEl();
        if (status && text) {
            status.textContent = text;
        }
    };

    const updateSubscribeStatus = (OneSignal) => {
        const status = getStatusEl();
        if (!status) {
            return;
        }

        const optedIn = !!(OneSignal && OneSignal.User && OneSignal.User.PushSubscription && OneSignal.User.PushSubscription.optedIn);
        const onLabel = status.getAttribute('data-label-on') || 'This browser is subscribed.';
        const offLabel = status.getAttribute('data-label-off') || 'This browser is not subscribed.';
        status.textContent = optedIn ? onLabel : offLabel;
    };

    const identifyIfSubscribed = async (OneSignal) => {
        if (phpbbUserId > 1 && OneSignal.User && OneSignal.User.PushSubscription && OneSignal.User.PushSubscription.optedIn) {
            await OneSignal.login(String(phpbbUserId));
        }
    };

    const subscribeBrowser = async (OneSignal) => {
        if (!OneSignal || !OneSignal.Notifications || typeof OneSignal.Notifications.isPushSupported !== 'function' || !OneSignal.Notifications.isPushSupported()) {
            setStatus('Desktop notifications are not supported in this browser.');
            return false;
        }

        if (OneSignal.Slidedown && typeof OneSignal.Slidedown.promptPush === 'function') {
            await OneSignal.Slidedown.promptPush();
        } else if (typeof OneSignal.Notifications.requestPermission === 'function') {
            await OneSignal.Notifications.requestPermission();
        }

        if (OneSignal.User && OneSignal.User.PushSubscription && typeof OneSignal.User.PushSubscription.optIn === 'function') {
            await OneSignal.User.PushSubscription.optIn();
        }

        await identifyIfSubscribed(OneSignal);
        updateSubscribeStatus(OneSignal);
        return !!(OneSignal.User && OneSignal.User.PushSubscription && OneSignal.User.PushSubscription.optedIn);
    };

    const handleSubscribeClick = function(e) {
        const button = e.target.closest('[data-action="onesignal-subscribe"]');
        if (!button) {
            return;
        }

        e.preventDefault();

        if (!appId) {
            setStatus('Push notifications are not configured.');
            return;
        }

        if (!oneSignalClient) {
            pendingSubscribe = true;
            setStatus('Loading desktop notifications...');
            return;
        }

        subscribeBrowser(oneSignalClient);
    };

    document.addEventListener('click', handleSubscribeClick);
    window.integraOneSignalSubscribe = handleSubscribeClick;

    if (!appId) {
        setStatus('Push notifications are not configured.');
        return;
    }

    const resolveWorkerConfig = () => {
        const scripts = document.querySelectorAll('script[src*="onesignal_init.js"]');
        const src = scripts.length ? scripts[scripts.length - 1].src : '';
        if (src) {
            try {
                const url = new URL(src, window.location.origin);
                const boardPath = url.pathname.replace(/\/assets\/js\/onesignal_init\.js$/i, '/');
                const scope = boardPath.endsWith('/') ? boardPath : boardPath + '/';
                const path = (scope + 'OneSignalSDKWorker.js').replace(/^\//, '');
                return { path: path, scope: scope };
            } catch (e) {
                console.warn('OneSignal: could not resolve service worker path', e);
            }
        }

        return { path: 'OneSignalSDKWorker.js', scope: '/' };
    };

    const worker = resolveWorkerConfig();
    window.OneSignalDeferred = window.OneSignalDeferred || [];

    OneSignalDeferred.push(async function(OneSignal) {
        oneSignalClient = OneSignal;

        await OneSignal.init({
            appId: appId,
            allowLocalhostAsSecureOrigin: true,
            serviceWorkerPath: worker.path,
            serviceWorkerParam: { scope: worker.scope },
            notifyButton: {
                enable: false
            }
        });

        if (OneSignal.User && OneSignal.User.PushSubscription && typeof OneSignal.User.PushSubscription.addEventListener === 'function') {
            OneSignal.User.PushSubscription.addEventListener('change', function() {
                identifyIfSubscribed(OneSignal);
                updateSubscribeStatus(OneSignal);
            });
        }

        await identifyIfSubscribed(OneSignal);
        updateSubscribeStatus(OneSignal);

        if (pendingSubscribe) {
            pendingSubscribe = false;
            await subscribeBrowser(OneSignal);
        }
    });

    var script = document.createElement('script');
    script.src = 'https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js';
    script.defer = true;
    document.head.appendChild(script);

})();
