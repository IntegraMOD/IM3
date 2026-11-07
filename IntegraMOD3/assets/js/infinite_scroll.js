(function () {
    'use strict';

    var TRIGGER = '[data-infinite-scroll]';
    var loading = false;

    function decodeUrl(value) {
        if (!value) {
            return '';
        }

        var textarea = document.createElement('textarea');
        textarea.innerHTML = value;
        return textarea.value;
    }

    function resolveUrl(value) {
        value = decodeUrl(value);
        if (!value) {
            return '';
        }

        try {
            return new URL(value, document.baseURI).href;
        } catch (error) {
            return value;
        }
    }

    function nextUrl(trigger) {
        if (!trigger) {
            return '';
        }

        var link = trigger.querySelector('a[rel="next"]');
        if (link) {
            return resolveUrl(link.getAttribute('href') || '');
        }

        return resolveUrl(trigger.getAttribute('data-next-url') || '');
    }

    function listRoot(trigger) {
        if (trigger.getAttribute('data-insert') === 'before-trigger') {
            return trigger.parentNode;
        }

        var selector = trigger.getAttribute('data-list-selector') || '';
        if (!selector) {
            return trigger.parentNode;
        }

        var nodes = document.querySelectorAll(selector);
        return nodes.length ? nodes[nodes.length - 1] : trigger.parentNode;
    }

    function rowSelector(trigger) {
        return trigger.getAttribute('data-row-selector') || '.topic-row, li.row, article.post, div.post';
    }

    function appendRows(trigger, html) {
        var parsed = new DOMParser().parseFromString(html, 'text/html');
        var incoming = parsed.querySelector(TRIGGER);
        var rows = parsed.querySelectorAll(rowSelector(trigger));
        var root = listRoot(trigger);
        var beforeTrigger = trigger.getAttribute('data-insert') === 'before-trigger';

        if (!root || !rows.length) {
            return { incoming: null, appended: false };
        }

        rows.forEach(function (row) {
            if (row.id && document.getElementById(row.id)) {
                return;
            }

            var node = document.importNode(row, true);
            if (beforeTrigger) {
                root.insertBefore(node, trigger);
            } else {
                root.appendChild(node);
            }
        });

        return { incoming: incoming, appended: true };
    }

    function loadNext(trigger) {
        var url = nextUrl(trigger);
        if (!url || loading || trigger.getAttribute('data-infinite-done') === '1') {
            return;
        }

        loading = true;
        trigger.setAttribute('data-infinite-loading', '1');

        fetch(url, {
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(function (response) {
            if (!response.ok) {
                throw new Error('infinite-scroll');
            }
            return response.text();
        }).then(function (html) {
            var result = appendRows(trigger, html);
            var incoming = result.incoming;
            var upcoming = incoming ? nextUrl(incoming) : '';

            if (upcoming) {
                var incomingLink = incoming.querySelector('a[rel="next"]');
                var rawNext = incomingLink ? (incomingLink.getAttribute('href') || '') : upcoming;
                trigger.setAttribute('data-next-url', rawNext);
                var link = trigger.querySelector('a[rel="next"]');
                if (link) {
                    link.setAttribute('href', rawNext);
                }
            } else {
                trigger.setAttribute('data-infinite-done', '1');
                trigger.setAttribute('data-next-url', '');
            }

            if (result.appended && window.history && window.history.pushState) {
                window.history.pushState({ infiniteScroll: true }, '', url);
            }
        }).catch(function () {
            trigger.setAttribute('data-infinite-done', '1');
        }).then(function () {
            loading = false;
            trigger.removeAttribute('data-infinite-loading');

            if (trigger.getAttribute('data-infinite-done') === '1' || !nextUrl(trigger)) {
                return;
            }

            var rect = trigger.getBoundingClientRect();
            if (rect.top < window.innerHeight + 240) {
                loadNext(trigger);
            }
        });
    }

    function boot() {
        var trigger = document.querySelector(TRIGGER);
        if (!trigger || !nextUrl(trigger) || !('IntersectionObserver' in window)) {
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    loadNext(trigger);
                }
            });
        }, {
            rootMargin: '240px 0px'
        });

        observer.observe(trigger);

        window.addEventListener('popstate', function () {
            window.location.reload();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
}());
