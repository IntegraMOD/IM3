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
    let initError = null;
    let loadTimer = null;
    let sdkBlocked = false;

    const SDK_URL = 'https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js';

    const DEFAULT_LABELS = {
        on: 'This browser is subscribed.',
        off: 'This browser is not subscribed.',
        loading: 'Loading desktop notifications...',
        blocked: 'The notification service (cdn.onesignal.com) was blocked by your browser or an extension such as DuckDuckGo Privacy Essentials, uBlock Origin, AdGuard, Brave Shields or Firefox strict tracking protection. Allow it for this site, then',
        retry: 'retry',
        denied: 'Notifications are blocked for this site in your browser settings.',
        unsupported: 'Desktop notifications are not supported in this browser.',
        'not-configured': 'Push notifications are not configured.',
        error: 'Desktop notifications failed to initialize: %s'
    };

    const getStatusEl = () => document.querySelector('[data-onesignal-status]');

    const label = (key) => {
        const status = getStatusEl();
        const value = status ? status.getAttribute('data-label-' + key) : '';
        return value || DEFAULT_LABELS[key] || '';
    };

    const setStatus = (text) => {
        const status = getStatusEl();
        if (status && text) {
            status.textContent = text;
        }
    };

    const setBlockedStatus = () => {
        const status = getStatusEl();
        if (!status) {
            return;
        }
        status.textContent = label('blocked') + ' ';
        const retry = document.createElement('a');
        retry.href = 'javascript:void(0)';
        retry.setAttribute('data-action', 'onesignal-retry');
        retry.textContent = label('retry');
        status.appendChild(retry);
        status.appendChild(document.createTextNode('.'));
    };

    const describeError = (err) => {
        const msg = (err && (err.message || err.reason || err.toString())) || 'unknown error';
        return label('error').replace('%s', msg);
    };

    const updateSubscribeStatus = (OneSignal) => {
        const status = getStatusEl();
        if (!status) {
            return;
        }

        const optedIn = !!(OneSignal && OneSignal.User && OneSignal.User.PushSubscription && OneSignal.User.PushSubscription.optedIn);
        status.textContent = optedIn ? label('on') : label('off');
    };

    const identifyIfSubscribed = async (OneSignal) => {
        if (phpbbUserId > 1 && OneSignal.User && OneSignal.User.PushSubscription && OneSignal.User.PushSubscription.optedIn) {
            await OneSignal.login(String(phpbbUserId));
        }
    };

    const subscribeBrowser = async (OneSignal) => {
        if (!OneSignal || !OneSignal.Notifications || typeof OneSignal.Notifications.isPushSupported !== 'function' || !OneSignal.Notifications.isPushSupported()) {
            setStatus(label('unsupported'));
            return false;
        }

        try {
            if (OneSignal.Notifications.permission === false && typeof Notification !== 'undefined' && Notification.permission === 'denied') {
                setStatus(label('denied'));
                return false;
            }

            if (OneSignal.Slidedown && typeof OneSignal.Slidedown.promptPush === 'function') {
                await OneSignal.Slidedown.promptPush({ force: true });
            } else if (typeof OneSignal.Notifications.requestPermission === 'function') {
                await OneSignal.Notifications.requestPermission();
            }

            if (OneSignal.User && OneSignal.User.PushSubscription && typeof OneSignal.User.PushSubscription.optIn === 'function') {
                await OneSignal.User.PushSubscription.optIn();
            }

            await identifyIfSubscribed(OneSignal);
        } catch (err) {
            console.error('OneSignal: subscribe failed', err);
            setStatus(describeError(err));
            return false;
        }

        updateSubscribeStatus(OneSignal);
        return !!(OneSignal.User && OneSignal.User.PushSubscription && OneSignal.User.PushSubscription.optedIn);
    };

    const handleSubscribeClick = function(e) {
        const retry = e.target.closest('[data-action="onesignal-retry"]');
        if (retry) {
            e.preventDefault();
            if (appId && sdkBlocked) {
                sdkBlocked = false;
                initError = null;
                pendingSubscribe = true;
                setStatus(label('loading'));
                loadSdk();
            }
            return;
        }

        const button = e.target.closest('[data-action="onesignal-subscribe"]');
        if (!button) {
            return;
        }

        e.preventDefault();

        if (!appId) {
            setStatus(label('not-configured'));
            return;
        }

        if (sdkBlocked) {
            setBlockedStatus();
            return;
        }

        if (initError) {
            setStatus(describeError(initError));
            return;
        }

        if (!oneSignalClient) {
            pendingSubscribe = true;
            setStatus(label('loading'));
            if (!loadTimer) {
                loadTimer = setTimeout(function() {
                    loadTimer = null;
                    if (!oneSignalClient && pendingSubscribe) {
                        sdkBlocked = true;
                        pendingSubscribe = false;
                        setBlockedStatus();
                    }
                }, 15000);
            }
            return;
        }

        subscribeBrowser(oneSignalClient);
    };

    document.addEventListener('click', handleSubscribeClick);
    window.integraOneSignalSubscribe = handleSubscribeClick;

    if (!appId) {
        setStatus(label('not-configured'));
        return;
    }

    const resolveWorkerConfig = () => {
        let src = '';
        if (document.currentScript && document.currentScript.src) {
            src = document.currentScript.src;
        } else {
            const scripts = document.querySelectorAll('script[src*="onesignal_init.js"]');
            src = scripts.length ? scripts[scripts.length - 1].src : '';
        }

        if (src) {
            try {
                const url = new URL(src, window.location.href);
                const boardPath = url.pathname.replace(/\/assets\/js\/onesignal_init\.js$/i, '/');
                const scope = boardPath.endsWith('/') ? boardPath : boardPath + '/';
                return { path: scope + 'OneSignalSDKWorker.js', scope: scope };
            } catch (e) {
                console.warn('OneSignal: could not resolve service worker path', e);
            }
        }

        return { path: '/OneSignalSDKWorker.js', scope: '/' };
    };

    const worker = resolveWorkerConfig();
    window.OneSignalDeferred = window.OneSignalDeferred || [];

    OneSignalDeferred.push(async function(OneSignal) {
        try {
            await OneSignal.init({
                appId: appId,
                allowLocalhostAsSecureOrigin: true,
                serviceWorkerOverrideForTypical: true,
                serviceWorkerPath: worker.path,
                serviceWorkerParam: { scope: worker.scope },
                notifyButton: {
                    enable: false
                }
            });
        } catch (err) {
            initError = err;
            pendingSubscribe = false;
            console.error('OneSignal: init failed', err);
            setStatus(describeError(err));
            return;
        }

        oneSignalClient = OneSignal;
        sdkBlocked = false;
        if (loadTimer) {
            clearTimeout(loadTimer);
            loadTimer = null;
        }

        if (OneSignal.User && OneSignal.User.PushSubscription && typeof OneSignal.User.PushSubscription.addEventListener === 'function') {
            OneSignal.User.PushSubscription.addEventListener('change', function() {
                identifyIfSubscribed(OneSignal).catch(function(err) {
                    console.warn('OneSignal: login failed', err);
                });
                updateSubscribeStatus(OneSignal);
            });
        }

        try {
            await identifyIfSubscribed(OneSignal);
        } catch (err) {
            console.warn('OneSignal: login failed', err);
        }

        if (pendingSubscribe) {
            pendingSubscribe = false;
            await subscribeBrowser(OneSignal);
        } else {
            updateSubscribeStatus(OneSignal);
        }
    });

    const loadSdk = () => {
        const stale = document.querySelector('script[src="' + SDK_URL + '"]');
        if (stale) {
            stale.parentNode.removeChild(stale);
        }

        var script = document.createElement('script');
        script.src = SDK_URL;
        script.defer = true;
        script.addEventListener('error', function() {
            sdkBlocked = true;
            pendingSubscribe = false;
            if (loadTimer) {
                clearTimeout(loadTimer);
                loadTimer = null;
            }
            console.error('OneSignal: SDK script blocked or unreachable', SDK_URL);
            setBlockedStatus();
        }, { once: true });
        document.head.appendChild(script);
    };

    loadSdk();

})();
