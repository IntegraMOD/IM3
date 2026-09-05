(() => {
    globalThis.socialNetwork = globalThis.socialNetwork || {};

    if (globalThis.jQuery && !globalThis.jQuery.browser) {
        const ua = navigator.userAgent.toLowerCase();
        const match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
            /(webkit)[ \/]([\w.]+)/.exec(ua) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
            /(msie) ([\w.]+)/.exec(ua) ||
            (ua.indexOf('compatible') < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua)) || [];

        const browser = {};
        if (match[1]) {
            browser[match[1]] = true;
            browser.version = match[2] || '0';
        }

        if (browser.chrome) {
            browser.webkit = true;
        } else if (browser.webkit) {
            browser.safari = true;
        }

        globalThis.jQuery.browser = browser;
    }

    const installLegacyTabsShim = () => {
        if (!globalThis.jQuery || !jQuery.fn.tabs || jQuery.fn.tabs.__integraLegacyShim) {
            return;
        }

        const originalTabs = jQuery.fn.tabs;

        const getTabs = ($root) => $root.find('.ui-tabs-nav > li');
        const getPanels = ($root) => $root.children('.ui-tabs-panel');
        const getIndexFromTarget = ($root, target) => {
            if (typeof target === 'number') {
                return target;
            }

            if (typeof target === 'string') {
                const hash = target.charAt(0) === '#' ? target : `#${target}`;
                const $anchor = $root.find(`.ui-tabs-nav a[href$="${hash}"]`).first();
                if ($anchor.length) {
                    return $anchor.parent().index();
                }

                const $byHref = $root.find(`.ui-tabs-nav a[href="${target}"]`).first();
                if ($byHref.length) {
                    return $byHref.parent().index();
                }
            }

            return -1;
        };

        const activateTab = ($root, target) => {
            const index = getIndexFromTarget($root, target);
            if (index < 0) {
                return false;
            }

            const instance = $root.data('ui-tabs');
            if (instance && typeof instance.option === 'function') {
                instance.option('active', index);
                return true;
            }

            return false;
        };

        jQuery.fn.tabs = function(method, ...args) {
            if (typeof method === 'string') {
                switch (method) {
                    case 'select':
                        return activateTab(this, args[0]) ? this : this;
                    case 'length':
                        return getTabs(this).length;
                    case 'abort':
                        return this;
                    case 'remove': {
                        const index = getIndexFromTarget(this, args[0]);
                        if (index >= 0) {
                            const $tabs = getTabs(this);
                            const $tab = $tabs.eq(index);
                            const href = $tab.find('a').attr('href') || '';
                            const hash = href.indexOf('#') !== -1 ? href.substring(href.indexOf('#')) : '';
                            $tab.remove();
                            if (hash) {
                                this.children(hash).remove();
                            }
                            originalTabs.call(this, 'refresh');
                        }
                        return this;
                    }
                    case 'add': {
                        const selector = args[0] || '';
                        const title = args[1] || '';
                        const panelId = selector.charAt(0) === '#' ? selector.substring(1) : selector;
                        const $nav = this.children('.ui-tabs-nav').first();
                        const $li = jQuery('<li class="ui-state-default ui-corner-top"></li>');
                        const $anchor = jQuery('<a class="ui-tabs-anchor"></a>').attr('href', selector).append(jQuery('<span></span>').text(title));
                        $li.append($anchor);
                        $nav.append($li);
                        if (panelId && !this.children(`#${panelId}`).length) {
                            this.append(jQuery('<div></div>').attr('id', panelId).addClass('ui-tabs-panel'));
                        }
                        originalTabs.call(this, 'refresh');
                        return this;
                    }
                    case 'url': {
                        const index = args[0];
                        const url = args[1] || '';
                        const $tab = getTabs(this).eq(index);
                        if ($tab.length) {
                            $tab.find('a').attr('href', url);
                        }
                        return this;
                    }
                    case 'load': {
                        const index = args[0];
                        const $tab = getTabs(this).eq(index);
                        if (!$tab.length) {
                            return this;
                        }

                        const href = $tab.find('a').attr('href') || '';
                        const hashIndex = href.indexOf('#');
                        const remoteUrl = hashIndex !== -1 ? href.substring(0, hashIndex) : href;
                        const panelId = hashIndex !== -1 ? href.substring(hashIndex) : '';
                        const $panel = panelId ? this.children(panelId) : jQuery();

                        if (remoteUrl && $panel.length) {
                            jQuery.ajax({
                                url: remoteUrl,
                                dataType: 'html',
                                cache: false,
                                data: {
                                    fullPage: false
                                }
                            }).done((html) => {
                                $panel.html(html);
                            });
                        }

                        return this;
                    }
                    case 'option': {
                        if (args[0] === 'selected') {
                            const instance = this.data('ui-tabs');
                            if (!instance || typeof instance.option !== 'function') {
                                return 0;
                            }
                            return instance.option('active');
                        }
                        if (args[0] === 'active') {
                            const instance = this.data('ui-tabs');
                            if (!instance || typeof instance.option !== 'function') {
                                return this;
                            }
                            if (args.length > 1) {
                                instance.option('active', args[1]);
                                return this;
                            }
                            return instance.option('active');
                        }
                        return originalTabs.call(this, method, ...args);
                    }
                    default:
                        return originalTabs.call(this, method, ...args);
                }
            }

            const options = method && typeof method === 'object' ? { ...method } : method;
            if (options && typeof options === 'object') {
                if (typeof options.select === 'function' && typeof options.beforeActivate !== 'function') {
                    const legacySelect = options.select;
                    options.beforeActivate = function(event, ui) {
                        return legacySelect.call(this, event, {
                            tab: ui.newTab && ui.newTab.length ? ui.newTab.get(0) : ui.newTab,
                            panel: ui.newPanel && ui.newPanel.length ? ui.newPanel.get(0) : ui.newPanel
                        });
                    };
                }

                if (typeof options.load === 'function' && typeof options.activate !== 'function') {
                    const legacyLoad = options.load;
                    options.activate = function(event, ui) {
                        return legacyLoad.call(this, event, {
                            tab: ui.newTab && ui.newTab.length ? ui.newTab.get(0) : ui.newTab,
                            panel: ui.newPanel && ui.newPanel.length ? ui.newPanel.get(0) : ui.newPanel
                        });
                    };
                }
            }

            return originalTabs.call(this, options);
        };

        jQuery.fn.tabs.__integraLegacyShim = true;
    };

    const initializeSocialNetwork = () => {
        // phpBB 3.0 SocialNet initializes each module via inline socialNetwork.*.init()
        // calls in overall_header_hook_js.html. This bootstrapper only installs the
        // legacy jQuery UI tabs compatibility shim so those inline calls (written for
        // jQuery UI 1.9) keep working under jQuery UI 1.14.
        installLegacyTabsShim();
    };

    if (globalThis.jQuery) {
        globalThis.jQuery(initializeSocialNetwork);
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeSocialNetwork);
    } else {
        initializeSocialNetwork();
    }
})();
