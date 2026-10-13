/**
 * Google Cloud Fraud Defense (reCAPTCHA Enterprise)
 * Config is passed only through data-* attributes.
 */
(function () {
    'use strict';

    function closestForm(node) {
        if (node.closest) {
            return node.closest('form');
        }

        var parent = node.parentNode;
        while (parent && parent.tagName !== 'FORM') {
            parent = parent.parentNode;
        }
        return parent;
    }

    function executeToken(siteKey, action, tokenInput, form) {
        var run = function () {
            grecaptcha.enterprise.execute(siteKey, { action: action }).then(function (token) {
                tokenInput.value = token;
                form.setAttribute('data-gcloud-fd-ok', '1');
                if (typeof form.requestSubmit === 'function') {
                    form.requestSubmit();
                } else {
                    HTMLFormElement.prototype.submit.call(form);
                }
            }).catch(function () {
                tokenInput.value = '';
                if (typeof form.requestSubmit === 'function') {
                    form.requestSubmit();
                } else {
                    HTMLFormElement.prototype.submit.call(form);
                }
            });
        };

        if (window.grecaptcha && grecaptcha.enterprise) {
            if (typeof grecaptcha.enterprise.ready === 'function') {
                grecaptcha.enterprise.ready(run);
            } else {
                run();
            }
            return;
        }

        HTMLFormElement.prototype.submit.call(form);
    }

    function bindWidget(root) {
        if (root.getAttribute('data-gcloud-fd-preview') === '1') {
            return;
        }

        var siteKey = root.getAttribute('data-sitekey');
        var action = root.getAttribute('data-action') || 'signup';
        var tokenInput = root.querySelector('input[name="gcloud_fd_token"]');
        var form = closestForm(root);

        if (!form || !siteKey || !tokenInput) {
            return;
        }

        if (form.getAttribute('data-gcloud-fd-bound') === '1') {
            return;
        }
        form.setAttribute('data-gcloud-fd-bound', '1');

        form.addEventListener('submit', function (event) {
            if (form.getAttribute('data-gcloud-fd-ok') === '1') {
                return;
            }

            event.preventDefault();
            executeToken(siteKey, action, tokenInput, form);
        });
    }

    function init() {
        var nodes = document.querySelectorAll('[data-gcloud-fd]');
        var i;
        for (i = 0; i < nodes.length; i++) {
            bindWidget(nodes[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
