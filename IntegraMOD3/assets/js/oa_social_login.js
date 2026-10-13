/**
 * OneAll Social Login - IM3 core / Alpha / Integrastyle integration.
 *
 * Reads all configuration from data-* attributes rendered by the
 * oa_social_login_widget.html / oa_social_login_profile.html templates,
 * so that no inline JavaScript is required inside the template files.
 *
 * @package OneAll Social Login Mod
 * @license GNU/GPL 2 or later
 */
(function () {
    'use strict';

    var _oneall = window._oneall = window._oneall || [];
    var libraryLoaded = false;

    function loadLibrary(src) {
        if (libraryLoaded || !src) {
            return;
        }
        libraryLoaded = true;
        var oa = document.createElement('script');
        oa.type = 'text/javascript';
        oa.async = true;
        oa.src = src;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(oa, s);
    }

    function parseProviders(raw) {
        if (!raw) {
            return [];
        }
        // PHP imploded the providers with "','" as glue.
        return raw.split("','");
    }

    function initElement(el) {
        var mode = el.getAttribute('data-oasl-mode');
        var container = el.getAttribute('data-oasl-container');
        var providers = parseProviders(el.getAttribute('data-oasl-providers'));

        loadLibrary(el.getAttribute('data-oasl-library'));

        _oneall.push([mode, 'set_providers', providers]);

        if (mode === 'social_login') {
            _oneall.push([mode, 'set_callback_uri', window.location.href]);
            var css = el.getAttribute('data-oasl-css');
            if (css) {
                _oneall.push([mode, 'set_custom_css_uri', css]);
            }
        } else if (mode === 'social_link') {
            _oneall.push([mode, 'set_user_token', el.getAttribute('data-oasl-user-token')]);
            _oneall.push([mode, 'set_callback_uri', el.getAttribute('data-oasl-callback-uri')]);
        }

        _oneall.push([mode, 'do_render_ui', container]);
    }

    function init() {
        var nodes = document.querySelectorAll('[data-oasl-mode]');
        for (var i = 0; i < nodes.length; i++) {
            initElement(nodes[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
