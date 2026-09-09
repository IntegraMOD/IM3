/**
 * integra_core.js
 */

const initFunctions = {
    onload: globalThis.onload_functions || [],
    onunload: globalThis.onunload_functions || []
};

globalThis.onload_functions = initFunctions.onload;
globalThis.onunload_functions = initFunctions.onunload;

const readMetaContent = (name, fallback = '') => {
    const element = document.querySelector(`meta[name="${name}"]`);
    return element ? element.getAttribute('content') || fallback : fallback;
};

globalThis.jump_page = globalThis.jump_page || readMetaContent('integra-jump-page');
globalThis.on_page = globalThis.on_page || readMetaContent('integra-on-page');
globalThis.per_page = globalThis.per_page || readMetaContent('integra-per-page');
globalThis.base_url = globalThis.base_url || readMetaContent('integra-base-url');
globalThis.style_cookie = globalThis.style_cookie || readMetaContent('integra-style-cookie', 'phpBBstyle');
globalThis.style_cookie_settings = globalThis.style_cookie_settings || readMetaContent('integra-style-cookie-settings');

const executeFunctions = (functions) => {
    functions.forEach(func => {
        try {
            if (typeof func === 'function') {
                func();
            } else if (typeof func === 'string') {
                eval(func);
            }
        } catch (e) {
            console.error('Error executing init function:', e);
        }
    });
};

let mchatScriptsLoaded = false;
let pageActionsInitialized = false;

window.initCalendarPage = function() {
    const calendarPage = document.querySelector('[data-calendar-page]');
    if (!calendarPage || calendarPage.getAttribute('data-calendar-ready') === '1') {
        return;
    }
    calendarPage.setAttribute('data-calendar-ready', '1');

    const calendarPanels = ['calendar-panel', 'event-panel', 'bday-panel', 'notes-panel', 'settings-panel', 'submit-panel', 'options-panel'];
    const tabPanels = ['calendar-panel', 'event-panel', 'settings-panel'];

    const setDisplay = (id, show) => {
        const el = document.getElementById(id);
        if (el) {
            el.style.display = show ? 'block' : 'none';
        }
    };

    window.showCalendarPanel = function(panel) {
        const showUpcoming = calendarPage.getAttribute('data-show-upcoming') === '1';
        const mondayFirst = calendarPage.getAttribute('data-monday-first') === '1';
        const overrideUser = calendarPage.getAttribute('data-override-user') === '1';

        tabPanels.forEach(id => {
            const tab = document.getElementById(id + '-tab');
            if (tab) {
                tab.className = (id === panel) ? 'activetab' : '';
            }
        });

        calendarPanels.forEach(id => setDisplay(id, false));

        if (panel === 'event-panel') {
            setDisplay('event-panel', true);
            setDisplay('submit-panel', true);
            setDisplay('options-panel', true);
        } else if (panel === 'settings-panel') {
            setDisplay('settings-panel', true);
            setDisplay('notes-panel', !mondayFirst);
        } else {
            setDisplay('calendar-panel', true);
            setDisplay('bday-panel', showUpcoming);
            setDisplay('notes-panel', !mondayFirst);
            if (overrideUser) {
                setDisplay('settings-panel', false);
            }
        }
    };

    const requested = calendarPage.getAttribute('data-active-tab') || 'calendar-panel';
    window.showCalendarPanel(requested);
};

document.addEventListener('click', function(e) {
    const tabLink = e.target.closest('[data-action="calendar-subpanel"]');
    if (!tabLink) {
        return;
    }
    e.preventDefault();
    if (typeof window.initCalendarPage === 'function') {
        window.initCalendarPage();
    }
    if (typeof window.showCalendarPanel === 'function') {
        window.showCalendarPanel(tabLink.getAttribute('data-panel'));
    }
});

const loadScriptOnce = (src) => {
    return new Promise((resolve, reject) => {
        const existing = document.querySelector(`script[src="${src}"]`);
        if (existing) {
            if (existing.dataset.loaded === 'true') {
                resolve();
                return;
            }

            existing.addEventListener('load', () => resolve(), { once: true });
            existing.addEventListener('error', () => reject(new Error(`Failed to load script: ${src}`)), { once: true });
            return;
        }

        const script = document.createElement('script');
        script.src = src;
        script.async = false;
        script.addEventListener('load', () => {
            script.dataset.loaded = 'true';
            resolve();
        }, { once: true });
        script.addEventListener('error', () => reject(new Error(`Failed to load script: ${src}`)), { once: true });
        document.head.appendChild(script);
    });
};

const normalizeMchatBoolean = (value) => value === '1' || value === 'true' || value === 'yes';

const initializeMchatConfig = () => {
    const config = document.getElementById('mchat-config');
    if (!config) {
        return null;
    }

    globalThis.mChatNoMessage = config.dataset.noMessageMode || '';
    globalThis.mChatFile = config.dataset.fileName || '';
    globalThis.mChatForumRoot = config.dataset.forumRoot || '';
    globalThis.mChatCustomPage = config.dataset.customPage || '';
    globalThis.mChatPause = normalizeMchatBoolean(config.dataset.pause);
    globalThis.mChatRefresh = config.dataset.refresh && config.dataset.refresh !== '0' ? config.dataset.refresh : false;
    globalThis.mChatUserTimeout = config.dataset.userTimeout && config.dataset.userTimeout !== '0' ? config.dataset.userTimeout : false;
    globalThis.mChatNoMessageInput = config.dataset.noMessageInput || '';
    globalThis.mChatNoMessage = config.dataset.noMessageText || '';
    globalThis.mChatEditInfo = config.dataset.editInfo || '';
    globalThis.mChatNoAccess = config.dataset.noAccess || '';
    globalThis.mChatFlood = config.dataset.flood || '';
    globalThis.mChatDelConfirm = config.dataset.deleteConfirm || '';
    globalThis.mChatReset = config.dataset.resetQuestion || '';
    globalThis.mChatRefreshing = config.dataset.refreshing || '';
    globalThis.mChatSessOut = config.dataset.sessionOut || '';
    globalThis.mChatSessEnds = config.dataset.sessionEnds || '';
    globalThis.mChatRefreshYes = config.dataset.refreshYes || '';
    globalThis.mChatRefreshNo = config.dataset.refreshNo || '';
    globalThis.mChatMssgLngthLong = config.dataset.messageLong || '';
    globalThis.mChatMssgLngth = config.dataset.messageLength && config.dataset.messageLength !== '0' ? config.dataset.messageLength : false;
    globalThis.mChatSound = normalizeMchatBoolean(config.dataset.sound);
    globalThis.mChatWhois = normalizeMchatBoolean(config.dataset.whois);
    globalThis.mChatWhoisRefresh = config.dataset.whoisRefresh && config.dataset.whoisRefresh !== '0' ? config.dataset.whoisRefresh : false;
    globalThis.mChatArchiveMode = normalizeMchatBoolean(config.dataset.archiveMode);
    globalThis.form_name = 'postform';
    globalThis.text_name = 'message';
    globalThis.mChatFocusFix = !globalThis.mChatArchiveMode;

    return {
        forumRoot: globalThis.mChatForumRoot,
        hasEditor: normalizeMchatBoolean(config.dataset.hasEditor)
    };
};

const initializePageActions = () => {
    if (pageActionsInitialized) {
        return;
    }
    pageActionsInitialized = true;

    const bbcodeConfig = document.getElementById('mchat-bbcode-config');
    if (bbcodeConfig) {
        globalThis.form_name = 'postform';
        globalThis.text_name = 'message';
        globalThis.bbcode = [];
        globalThis.bbtags = (bbcodeConfig.dataset.tags || '').split('|');
        globalThis.help_line = {
            b: bbcodeConfig.dataset.helpB || '',
            i: bbcodeConfig.dataset.helpI || '',
            u: bbcodeConfig.dataset.helpU || '',
            q: bbcodeConfig.dataset.helpQ || '',
            c: bbcodeConfig.dataset.helpC || '',
            l: bbcodeConfig.dataset.helpL || '',
            o: bbcodeConfig.dataset.helpO || '',
            p: bbcodeConfig.dataset.helpP || '',
            w: bbcodeConfig.dataset.helpW || '',
            a: bbcodeConfig.dataset.helpA || '',
            s: bbcodeConfig.dataset.helpS || '',
            f: bbcodeConfig.dataset.helpF || '',
            e: bbcodeConfig.dataset.helpE || '',
            d: bbcodeConfig.dataset.helpD || '',
            tip: bbcodeConfig.dataset.helpTip || ''
        };

        Object.keys(bbcodeConfig.dataset).forEach(key => {
            if (key.startsWith('helpCb')) {
                const id = key.substring(6);
                globalThis.help_line[`cb_${id}`] = bbcodeConfig.dataset[key];
            }
        });
    }

    document.querySelectorAll('[data-mchat-toggle]').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (globalThis.mChat && typeof globalThis.mChat.toggle === 'function') {
                globalThis.mChat.toggle(this.getAttribute('data-mchat-toggle'));
            }
        });
    });

    document.querySelectorAll('[data-mchat-action="add"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (globalThis.mChat && typeof globalThis.mChat.add === 'function') {
                globalThis.mChat.add();
            }
        });
    });

    document.querySelectorAll('[data-mchat-action="clear"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (globalThis.mChat && typeof globalThis.mChat.clear === 'function') {
                globalThis.mChat.clear();
            }
        });
    });

    document.querySelectorAll('[data-nav-url]').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-nav-url');
            if (url) {
                window.location.href = url;
            }
        });
    });

    document.querySelectorAll('[data-style-select]').forEach(select => {
        select.addEventListener('change', function() {
            let url = this.options[this.selectedIndex] ? this.options[this.selectedIndex].value : '';
            if (!url) {
                return;
            }

            const permanentToggle = this.closest('form') ? this.closest('form').querySelector('input[name="y"]') : null;
            if (permanentToggle) {
                url += '&y=' + permanentToggle.checked;
            }

            document.location.href = url;
        });
    });

    document.querySelectorAll('[data-gallery-moderation-toggle]').forEach(button => {
        button.addEventListener('click', function() {
            const target = document.getElementById(this.getAttribute('data-gallery-moderation-toggle'));
            if (target) {
                target.hidden = !target.hidden;
            }
        });
    });

    document.querySelectorAll('[data-search-block]').forEach(form => {
        form.addEventListener('submit', function(e) {
            const engine = this.elements.search_engine ? this.elements.search_engine.value : 'site';
            const keywords = this.elements.keywords ? encodeURIComponent(this.elements.keywords.value) : '';

            if (engine === 'advanced') {
                e.preventDefault();
                window.open(this.getAttribute('data-advanced-search-url') || this.action, '_self', '');
            } else if (engine === 'google') {
                e.preventDefault();
                window.open('https://www.google.com/search?q=' + keywords, '_google', '');
            } else if (engine === 'yahoo') {
                e.preventDefault();
                window.open('https://search.yahoo.com/search?p=' + keywords, '_yahoo', '');
            } else if (engine === 'lycos') {
                e.preventDefault();
                window.open('https://search.lycos.com/?query=' + keywords, '_lycos', '');
            }
        });
    });

    document.querySelectorAll('[data-placeholder-value]').forEach(input => {
        const placeholder = input.getAttribute('data-placeholder-value');
        input.addEventListener('focus', function() {
            if (this.value === placeholder) {
                this.value = '';
            }
        });
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.value = placeholder;
            }
        });
    });

    document.querySelectorAll('[data-ajaxlike-list]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const callback = this.getAttribute('data-ajaxlike-callback');
            if (callback && typeof ajaxlike_liked_listbox === 'function') {
                ajaxlike_liked_listbox(callback);
            }
        });
    });

    document.querySelectorAll('[data-popup-url]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-popup-url');
            const width = parseInt(this.getAttribute('data-popup-width') || '450', 10);
            const height = parseInt(this.getAttribute('data-popup-height') || '275', 10);
            const target = this.getAttribute('data-popup-target') || '_popup';
            if (url && typeof popup === 'function') {
                popup(url, width, height, target);
            }
        });
    });

    document.querySelectorAll('.mchat-insert-text').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const text = this.getAttribute('data-mchat-text');
            const focus = this.getAttribute('data-mchat-focus') !== '0';
            if (text && typeof insert_text === 'function') {
                insert_text(text, focus);
            }
        });
    });

    // Member search popup (replaces prosilver's inline insert_user/insert_marked/insert_single)
    const memberSearchConfig = document.getElementById('member-search-config');
    if (memberSearchConfig) {
        const searchFormName = memberSearchConfig.getAttribute('data-form-name') || '';
        const searchFieldName = memberSearchConfig.getAttribute('data-field-name') || '';

        const insertUser = (user) => {
            if (!opener || !opener.document.forms[searchFormName]) {
                return;
            }
            const field = opener.document.forms[searchFormName][searchFieldName];
            if (!field) {
                return;
            }
            field.value = (field.value.length && field.type === 'textarea') ? field.value + '\n' + user : user;
        };

        const insertMarked = (users) => {
            if (typeof users.length === 'undefined') {
                if (users.checked) {
                    insertUser(users.value);
                }
            } else if (users.length > 0) {
                for (let i = 0; i < users.length; i++) {
                    if (users[i].checked) {
                        insertUser(users[i].value);
                    }
                }
            }
            self.close();
        };

        document.querySelectorAll('[data-member-results-form]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                insertMarked(this.user);
            });
        });

        document.querySelectorAll('[data-action="member-insert-single"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                insertUser(this.getAttribute('data-username'));
                self.close();
            });
        });
    }

    // Message editor wiring (replaces prosilver's inline editor config and handlers)
    const messageEditorConfig = document.getElementById('message-editor-config');
    if (messageEditorConfig) {
        globalThis.form_name = messageEditorConfig.getAttribute('data-form-name') || 'postform';
        globalThis.text_name = messageEditorConfig.getAttribute('data-text-name') || 'message';

        const editorSrc = messageEditorConfig.getAttribute('data-editor-src');
        if (editorSrc) {
            loadScriptOnce(editorSrc).catch(() => {});
        }

        document.querySelectorAll('[data-editor-textarea]').forEach(textarea => {
            const storeCaretHandler = () => {
                if (typeof storeCaret === 'function') {
                    storeCaret(textarea);
                }
            };
            textarea.addEventListener('select', storeCaretHandler);
            textarea.addEventListener('click', storeCaretHandler);
            textarea.addEventListener('keyup', storeCaretHandler);
            textarea.addEventListener('focus', () => {
                if (typeof initInsertions === 'function') {
                    initInsertions();
                }
            });
        });

        document.querySelectorAll('[data-smiley-code]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (typeof insert_text === 'function') {
                    insert_text(this.getAttribute('data-smiley-code'), true);
                }
            });
        });

        document.querySelectorAll('[data-more-smilies-url]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.open(this.getAttribute('data-more-smilies-url'), '_phpbbsmilies', 'HEIGHT=350,resizable=yes,scrollbars=yes,WIDTH=300');
            });
        });
    }

    document.querySelectorAll('[data-mchat-message-action]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            if (!globalThis.mChat) {
                return;
            }

            const id = this.getAttribute('data-mchat-message-id');
            const action = this.getAttribute('data-mchat-message-action');
            if (action === 'edit' && typeof globalThis.mChat.edit === 'function') {
                globalThis.mChat.edit(id);
            } else if (action === 'delete' && typeof globalThis.mChat.del === 'function') {
                globalThis.mChat.del(id);
            }
        });
    });

    document.querySelectorAll('[data-bbstyle]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (typeof bbstyle === 'function') {
                bbstyle(parseInt(this.getAttribute('data-bbstyle'), 10));
            }
        });
    });

    document.querySelectorAll('[data-bbfont-size]').forEach(select => {
        select.addEventListener('change', function() {
            if (typeof bbfontstyle === 'function') {
                bbfontstyle(`[size=${this.options[this.selectedIndex].value}]`, '[/size]');
                this.selectedIndex = 2;
            }
        });
    });

    document.querySelectorAll('[data-bbstyle-select]').forEach(select => {
        select.addEventListener('change', function() {
            if (typeof bbstyle === 'function' && this.options[this.selectedIndex].value !== '#') {
                bbstyle(parseInt(this.options[this.selectedIndex].value, 10));
                this.selectedIndex = 0;
            }
        });
    });

    const colorPaletteTarget = document.getElementById('mChatColorPaletteTarget');
    if (colorPaletteTarget && !colorPaletteTarget.dataset.initialized) {
        const colors = (colorPaletteTarget.getAttribute('data-mchat-colors') || '').split(',').filter(Boolean);
        colors.forEach(color => {
            const swatch = document.createElement('button');
            swatch.type = 'button';
            swatch.className = 'mChatSwatch';
            swatch.style.backgroundColor = color;
            swatch.title = color;
            swatch.addEventListener('click', function() {
                const textarea = document.getElementById('mChatMessage');
                if (textarea) {
                    const start = textarea.value.substring(0, textarea.selectionStart);
                    const end = textarea.value.substring(textarea.selectionEnd);
                    textarea.value = `${start}[color=${color}][/color]${end}`;
                    textarea.focus();
                }
            });
            colorPaletteTarget.appendChild(swatch);
        });
        colorPaletteTarget.dataset.initialized = 'true';
    }

    const postForm = document.getElementById('postform');
    if (postForm && postForm.querySelector('#mChatMessage')) {
        postForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (globalThis.mChat && typeof globalThis.mChat.add === 'function') {
                globalThis.mChat.add();
            }
        });
    }

    const mchatMessage = document.getElementById('mChatMessage');
    if (mchatMessage) {
        mchatMessage.addEventListener('keypress', function(e) {
            if (globalThis.mChat && typeof globalThis.mChat.key === 'function') {
                globalThis.mChat.key(e);
            }
        });
    }
};

const initializeMchat = async () => {
    if (mchatScriptsLoaded) {
        return;
    }

    const mchatConfig = initializeMchatConfig();
    if (!mchatConfig) {
        return;
    }
    try {
        if (mchatConfig.hasEditor) {
            await loadScriptOnce(`${mchatConfig.forumRoot}assets/js/editor.js`);
        }

        await loadScriptOnce(`${mchatConfig.forumRoot}mchat/mchat_ajax_mini.js?v=${Date.now()}`);
        mchatScriptsLoaded = true;
    } catch (e) {
        console.error('Error initializing mChat:', e);
    }
};

const initializePasswordStrength = async () => {
    const config = document.getElementById('password-strength-config');
    if (!config) {
        return;
    }

    globalThis.ps_text1 = config.dataset.textVeryWeak || '';
    globalThis.ps_text2 = config.dataset.textWeak || '';
    globalThis.ps_text3 = config.dataset.textGood || '';
    globalThis.ps_text4 = config.dataset.textStrong || '';
    globalThis.ps_text5 = config.dataset.textVeryStrong || '';
    globalThis.ps_color1 = config.dataset.colorVeryWeak || '#f5a9a9';
    globalThis.ps_color2 = config.dataset.colorWeak || '#f5d0a9';
    globalThis.ps_color3 = config.dataset.colorGood || '#f3f781';
    globalThis.ps_color4 = config.dataset.colorStrong || '#a9f5a9';
    globalThis.ps_color5 = config.dataset.colorVeryStrong || '#00ff00';

    if (!globalThis.jQuery) {
        await loadScriptOnce(`${config.dataset.rootPath || ''}password_strength/jquery.js`);
    }

    await loadScriptOnce(`${config.dataset.rootPath || ''}password_strength/password_strength_min.js`);
};

const initializeSortablesCaptcha = () => {
    const root = document.getElementById('sortables-captcha');
    if (!root || root.getAttribute('data-ready') === '1') {
        return;
    }
    if (typeof jQuery === 'undefined' || !jQuery.fn || typeof jQuery.fn.sortable !== 'function') {
        return;
    }

    const start = () => {
        if (root.getAttribute('data-ready') === '1') {
            return;
        }

        const $ = jQuery;
        const createSortableData = (listItems, column) => {
            const data = document.getElementById(column);
            if (!data) {
                return;
            }
            while (data.firstChild) {
                data.removeChild(data.firstChild);
            }
            listItems.each(function() {
                const answer = String(this.id || '').replace(/^answer_/, '');
                if (!answer) {
                    return;
                }
                const inputbox = document.createElement('input');
                inputbox.type = 'hidden';
                inputbox.name = column + '[]';
                inputbox.value = answer;
                data.appendChild(inputbox);
            });
        };

        const syncColumns = () => {
            createSortableData($('#sortable1').children('li'), 'sortables_options_left');
            createSortableData($('#sortable2').children('li'), 'sortables_options_right');
        };

        root.classList.add('sortables-captcha-ready');

        const enableJs = document.getElementById('enable_js');
        if (enableJs) {
            enableJs.removeAttribute('hidden');
            enableJs.classList.add('sortables-captcha-ready');
            enableJs.style.display = '';
        }

        const $lists = $('#sortable1, #sortable2');
        if (!$lists.length) {
            return;
        }

        $lists.sortable({
            connectWith: '.connectedSortable',
            items: 'li',
            forcePlaceholderSize: true,
            placeholder: 'sortables-captcha-placeholder',
            update: syncColumns
        });

        if (typeof $lists.disableSelection === 'function') {
            $lists.disableSelection();
        }

        $lists.on('sortreceive sortupdate', syncColumns);
        syncColumns();
        root.setAttribute('data-ready', '1');
    };

    const punchSrc = root.getAttribute('data-touch-punch');
    if (punchSrc) {
        loadScriptOnce(punchSrc).then(start).catch(start);
        return;
    }

    start();
};

document.addEventListener('DOMContentLoaded', initializeSortablesCaptcha);

window.addEventListener('load', () => {
    checkCookieConsent();

    executeFunctions(initFunctions.onload);
    initializePageActions();

    // PM Popup
    const body = document.getElementById('phpbb');
    if (body) {
        const pmPopup = body.getAttribute('data-user-pm-popup');
        if (pmPopup && pmPopup.trim() !== '') {
            window.open(pmPopup.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes, width=400');
        }

        const newDownloadPopup = body.getAttribute('data-new-download-popup');
        if (newDownloadPopup && newDownloadPopup.trim() !== '') {
            window.open(newDownloadPopup.replace(/&amp;/g, '&'), '_blank', 'height=225,resizable=yes,width=400');
        }
    }
    
    // Search toggle
    const searchToggleBtn = document.querySelector('.search-toggle-btn');
    const searchForm = document.getElementById('search');
    if (searchToggleBtn && searchForm) {
        searchToggleBtn.addEventListener('click', () => {
            searchForm.classList.toggle('search-form-hidden');
            searchForm.classList.toggle('search-form-visible');
        });
    }

    // reCAPTCHA v1 RTL adjustment (replaces prosilver's inline script)
    if (document.querySelector('[data-recaptcha-rtl]')) {
        const recaptchaTable = document.getElementById('recaptcha_table');
        if (recaptchaTable) {
            recaptchaTable.style.direction = 'ltr';
        }
    }

    initializeSortablesCaptcha();

    document.querySelectorAll('[data-rmstream-init]').forEach(el => {
        const attachId = el.getAttribute('data-rmstream-init');
        const stream = document['rmstream_' + attachId];
        const ctrls = document['ctrls_' + attachId];
        if (stream && stream.GetClipWidth) {
            while (!stream.GetClipWidth()) { /* wait for clip metadata */ }
            const width = stream.GetClipWidth();
            const height = stream.GetClipHeight();
            stream.width = width;
            stream.height = height;
            if (ctrls) {
                ctrls.width = width;
            }
        }
    });

    // Calendar event editor (replaces prosilver's inline event handlers/scripts)
    const calendarEditor = document.getElementById('event-panel');
    if (calendarEditor) {
        const revalidateRepeatDates = () => {
            if (typeof validateForm === 'function') {
                validateForm('postform', 'calendar:get_repeat_dates', 'repeat_dates');
            }
        };

        document.querySelectorAll('[data-action="calendar-date-show"]').forEach(input => {
            const show = (e) => {
                if (e && e.type === 'click' && typeof e.cancelBubble !== 'undefined') {
                    e.cancelBubble = true;
                }
                if (typeof date_show === 'function') {
                    date_show(input);
                }
            };
            input.addEventListener('focus', show);
            input.addEventListener('click', show);
        });

        document.querySelectorAll('[data-action="calendar-time-show"]').forEach(input => {
            const show = (e) => {
                if (e && e.type === 'click' && typeof e.cancelBubble !== 'undefined') {
                    e.cancelBubble = true;
                }
                if (typeof time_show === 'function') {
                    time_show(input);
                }
            };
            input.addEventListener('focus', show);
            input.addEventListener('click', show);
        });

        document.querySelectorAll('[data-action="calendar-repeat-toggle"]').forEach(radio => {
            radio.addEventListener('click', function() {
                const repeatOptions = document.getElementById('repeat_options');
                if (repeatOptions) {
                    repeatOptions.style.display = (this.value === '1') ? 'block' : 'none';
                }
                if (this.value === '1') {
                    revalidateRepeatDates();
                }
            });
        });

        const repeatWhen = document.getElementById('event_repeat_when');
        if (repeatWhen) {
            repeatWhen.addEventListener('change', function() {
                if (typeof showHideRepeatOptions === 'function') {
                    showHideRepeatOptions(this);
                }
                revalidateRepeatDates();
            });
        }

        document.querySelectorAll('[data-action="calendar-revalidate"]').forEach(select => {
            select.addEventListener('change', revalidateRepeatDates);
        });

        document.querySelectorAll('[data-action="calendar-group-toggle"]').forEach(radio => {
            radio.addEventListener('click', function() {
                if (typeof showHideGroups === 'function') {
                    showHideGroups(document.postform.group_select);
                }
            });
        });

        const findUsername = calendarEditor.querySelector('[data-action="calendar-find-username"]');
        if (findUsername) {
            findUsername.addEventListener('click', function(e) {
                e.preventDefault();
                if (typeof find_username === 'function') {
                    find_username(this.href);
                }
            });
        }

        // Initialise displays the way prosilver's trailing inline scripts did
        if (document.postform && document.postform.group_select && typeof showHideGroups === 'function') {
            showHideGroups(document.postform.group_select);
        }
        if (repeatWhen && typeof showHideRepeatOptions === 'function') {
            showHideRepeatOptions(repeatWhen);
        }
        try {
            revalidateRepeatDates();
        } catch (calendarValidateError) {
            console.error('Calendar repeat validation failed:', calendarValidateError);
        }
    }

    // Calendar datetime picker controls (replaces prosilver's inline onchange/onclick)
    const pickerHrs = document.getElementById('hrs');
    if (pickerHrs) {
        pickerHrs.addEventListener('change', function() { if (typeof setH === 'function') { setH(this); } });
    }
    const pickerMins = document.getElementById('mins');
    if (pickerMins) {
        pickerMins.addEventListener('change', function() { if (typeof setM === 'function') { setM(this); } });
    }
    const pickerAmpm = document.getElementById('ampm');
    if (pickerAmpm) {
        pickerAmpm.addEventListener('change', function() { if (typeof setAP === 'function') { setAP(this); } });
    }
    document.querySelectorAll('[data-action="calendar-time-close"]').forEach(el => {
        el.addEventListener('click', function() { if (typeof time_close === 'function') { time_close(); } });
    });
    document.querySelectorAll('[data-action="calendar-prev-month"]').forEach(el => {
        el.addEventListener('click', function() { if (typeof prev_month === 'function') { prev_month(); } });
    });
    document.querySelectorAll('[data-action="calendar-next-month"]').forEach(el => {
        el.addEventListener('click', function() { if (typeof next_month === 'function') { next_month(); } });
    });

    if (typeof window.initCalendarPage === 'function') {
        window.initCalendarPage();
    }

    document.querySelectorAll('[data-action="calendar-check-max"]').forEach(input => {
        input.addEventListener('keyup', function() {
            const max = parseInt(input.getAttribute('data-max') || '0', 10);
            const value = parseInt(input.value, 10);
            if (!isNaN(value) && !isNaN(max) && value > max) {
                input.value = max;
            }
        });
    });

    document.querySelectorAll('[data-jumpbox-form]').forEach(form => {
        const select = form.querySelector('[data-jumpbox-select]');
        if (!select) {
            return;
        }

        form.addEventListener('submit', function(e) {
            if (select.value === '-1') {
                e.preventDefault();
            }
        });

        select.addEventListener('change', function() {
            if (this.value !== '-1') {
                form.submit();
            }
        });
    });

    const quickReplyEditor = document.querySelector('[data-quick-reply-editor]');
    if (quickReplyEditor) {
        quickReplyEditor.style.display = 'none';

        document.querySelectorAll('[data-quick-reply-toggle]').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const isHidden = quickReplyEditor.style.display === 'none';
                quickReplyEditor.style.display = isHidden ? '' : 'none';

                if (isHidden) {
                    const message = quickReplyEditor.querySelector('textarea[name="message"]');
                    if (message) {
                        message.focus();
                    }
                }
            });
        });
    }

    document.querySelectorAll('[data-style-width]').forEach(button => {
        button.addEventListener('click', function() {
            const widthMode = this.getAttribute('data-style-width') === 'alt' ? 'alt' : 'default';
            const pageWidth = document.getElementById('page-width');
            document.cookie = `mystyle=${widthMode}; path=/`;
            if (pageWidth) {
                pageWidth.classList.toggle('stylewidth-alt', widthMode === 'alt');
            }
        });
    });

    // Off-canvas navigation toggle
    const offCanvasToggle = document.querySelector('.off-canvas-toggle');
    const offCanvasClose = document.querySelector('.off-canvas-close');
    const offCanvasMenu = document.querySelector('.off-canvas-menu');
    let offCanvasOverlay = document.querySelector('.off-canvas-overlay');
    const closeOffCanvas = function () {
        if (!offCanvasMenu) {
            return;
        }
        offCanvasMenu.classList.remove('is-open');
        document.body.classList.remove('off-canvas-open');
    };
    const openOffCanvas = function () {
        if (!offCanvasMenu) {
            return;
        }
        if (!offCanvasOverlay) {
            offCanvasOverlay = document.createElement('div');
            offCanvasOverlay.className = 'off-canvas-overlay';
            document.body.appendChild(offCanvasOverlay);
            offCanvasOverlay.addEventListener('click', closeOffCanvas);
        }
        offCanvasMenu.classList.add('is-open');
        document.body.classList.add('off-canvas-open');
    };
    if (offCanvasToggle && offCanvasMenu) {
        offCanvasToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            if (offCanvasMenu.classList.contains('is-open')) {
                closeOffCanvas();
            } else {
                openOffCanvas();
            }
        });
    }
    if (offCanvasClose && offCanvasMenu) {
        offCanvasClose.addEventListener('click', (e) => {
            e.stopPropagation();
            closeOffCanvas();
        });
    }
    if (offCanvasOverlay) {
        offCanvasOverlay.addEventListener('click', closeOffCanvas);
    }
    document.addEventListener('click', (e) => {
        if (!offCanvasMenu || !offCanvasMenu.classList.contains('is-open')) {
            return;
        }
        if (e.target.closest('.off-canvas-menu') || e.target.closest('.off-canvas-toggle')) {
            return;
        }
        closeOffCanvas();
    });

    // Nav Dropdowns
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parentLi = this.parentElement;
            const expanded = this.getAttribute('aria-expanded') === 'true';
            
            // Close other dropdowns
            dropdownToggles.forEach(t => {
                if (t !== this) {
                    t.setAttribute('aria-expanded', 'false');
                    t.parentElement.classList.remove('dropdown-open');
                }
            });
            
            this.setAttribute('aria-expanded', !expanded);
            if (!expanded) {
                parentLi.classList.add('dropdown-open');
            } else {
                parentLi.classList.remove('dropdown-open');
            }
        });
    });

    // Close dropdowns if click outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.has-dropdown')) {
             dropdownToggles.forEach(t => {
                 t.setAttribute('aria-expanded', 'false');
                 t.parentElement.classList.remove('dropdown-open');
             });
        }
    });

    // Category Collapser
    const collapseToggles = document.querySelectorAll('.category-toggle');
    collapseToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetList = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (targetList) {
                const isCollapsed = targetList.style.display === 'none';
                if (isCollapsed) {
                    targetList.style.display = '';
                    if(icon) {
                        icon.classList.remove('fa-plus');
                        icon.classList.add('fa-minus');
                    }
                } else {
                    targetList.style.display = 'none';
                    if(icon) {
                        icon.classList.remove('fa-minus');
                        icon.classList.add('fa-plus');
                    }
                }
                
                // If S_AJAX_COLLAPSE_ACTION is available globally, we could trigger ajax
                if (typeof myurl !== 'undefined' && myurl) {
                    const toggleId = targetId.replace('flist', '');
                    fetch(myurl + '&c=' + toggleId).catch(err => console.error('Error saving collapse state:', err));
                }
            }
        });
    });

    // Initialize ajaxlike notification if data element exists
    const ajaxlikeNotifyData = document.getElementById('ajaxlike-notify-data');
    if (ajaxlikeNotifyData) {
        const interval = ajaxlikeNotifyData.getAttribute('data-interval');
        const callback = ajaxlikeNotifyData.getAttribute('data-callback');
        if (typeof ajaxlike_init_notify === 'function' && interval && callback) {
            ajaxlike_init_notify(interval, callback);
        }
    }

    // Initialize ajaxlike tooltips (replaces prosilver's inline load_tips script)
    if (typeof load_tips === 'function' && document.querySelector('.ajaxlike_tooltip')) {
        load_tips('.ajaxlike_tooltip');
    }

    // UCP semantic action wiring
    document.addEventListener('click', function(e) {
        const actionEl = e.target.closest('[data-action]');
        if (!actionEl) {
            return;
        }

        const action = actionEl.getAttribute('data-action');

        if (action === 'onesignal-subscribe') {
            // Handled by assets/js/onesignal_init.js (own document click listener)
            return;
        }

        if (action === 'jumpto') {
            e.preventDefault();
            if (typeof jumpto === 'function') {
                jumpto();
            }
            return;
        }

        if (action === 'toggle-id') {
            e.preventDefault();
            const ids = (actionEl.getAttribute('data-toggle-ids') || actionEl.getAttribute('data-toggle-id') || '').split(',');
            ids.forEach((id) => {
                const trimmed = id.trim();
                if (trimmed && typeof window.toggleDiv === 'function') {
                    window.toggleDiv(trimmed);
                }
            });
            return;
        }

        if (action === 'subpanel') {
            e.preventDefault();
            if (typeof subPanels === 'function') {
                subPanels(actionEl.getAttribute('data-panel'));
            }
            return;
        }

        if (action === 'blog-archive-toggle') {
            e.preventDefault();
            const month = actionEl.getAttribute('data-month');
            const monthEl = document.getElementById('month_' + month);
            const icon = actionEl.querySelector('.blog-archive-icon');
            if (!monthEl) {
                return;
            }
            const hidden = monthEl.classList.toggle('blog-hidden');
            if (icon) {
                icon.textContent = hidden ? '+' : '-';
            }
            return;
        }

        if (action === 'blog-friends-page') {
            e.preventDefault();
            const field = actionEl.getAttribute('data-field');
            const direction = actionEl.getAttribute('data-direction');
            if (direction === 'next' && typeof window.next_list === 'function') {
                window.next_list(field);
            } else if (direction === 'previous' && typeof window.previous_list === 'function') {
                window.previous_list(field);
            }
            return;
        }

        if (action === 'dl-subpanel') {
            e.preventDefault();
            const panel = actionEl.getAttribute('data-panel');
            document.querySelectorAll('[data-dl-subpanel]').forEach((el) => {
                el.classList.toggle('is-active', el.getAttribute('data-dl-subpanel') === panel);
                el.style.display = el.getAttribute('data-dl-subpanel') === panel ? '' : 'none';
            });
            document.querySelectorAll('[data-action="dl-subpanel"]').forEach((el) => {
                el.classList.toggle('is-active', el.getAttribute('data-panel') === panel);
            });
            return;
        }

        if (action === 'insert-smiley') {
            e.preventDefault();
            if (typeof insert_text === 'function') {
                insert_text(actionEl.getAttribute('data-smiley-code') || '', true);
            }
            return;
        }

        if (action === 'attach-inline') {
            e.preventDefault();
            if (typeof attach_inline === 'function') {
                attach_inline(actionEl.getAttribute('data-attach-index'), actionEl.getAttribute('data-attach-name'));
            }
            return;
        }

        if (action === 'post-preview') {
            const form = actionEl.form || document.getElementById('postform');
            if (form && form.action.indexOf('#preview') === -1) {
                form.action += '#preview';
            }
        }

        if (action === 'blog-style-demo') {
            return;
        }

        if (action === 'close-window') {
            e.preventDefault();
            window.close();
            return;
        }

        if (action === 'msn-add-contact' || action === 'msn-send-message') {
            e.preventDefault();
            const app = document.getElementById('objMessengerApp');
            const address = actionEl.getAttribute('data-im-contact') || '';
            const connectMsg = actionEl.getAttribute('data-msn-connect') || '';
            const browserMsg = actionEl.getAttribute('data-msn-browser') || '';
            if (!app || !app.MyStatus) {
                if (browserMsg) {
                    alert(browserMsg);
                }
                return;
            }
            if (app.MyStatus == 1) {
                if (connectMsg) {
                    alert(connectMsg);
                }
                return;
            }
            try {
                if (action === 'msn-add-contact') {
                    app.AddContact(0, address);
                } else {
                    app.InstantMessage(address);
                }
            } catch (err) {
                return;
            }
            return;
        }

        if (action === 'popup') {
            e.preventDefault();
            const width = parseInt(actionEl.getAttribute('data-popup-width') || '760', 10);
            const height = parseInt(actionEl.getAttribute('data-popup-height') || '570', 10);
            const target = actionEl.getAttribute('data-popup-target') || '_blank';
            if (typeof popup === 'function') {
                popup(actionEl.href, width, height, target);
            }
            return;
        }

        if (action === 'toggle-display') {
            e.preventDefault();
            const targetId = actionEl.getAttribute('data-toggle-id') || '';
            const target = targetId ? document.getElementById(targetId) : null;
            if (!target) {
                return;
            }
            if (target.hasAttribute('hidden')) {
                target.removeAttribute('hidden');
                target.style.display = '';
            } else if (target.style.display === 'none') {
                target.style.display = '';
            } else {
                target.setAttribute('hidden', 'hidden');
                target.style.display = 'none';
            }
            return;
        }

        if (action === 'gallery-insert-image') {
            e.preventDefault();
            const imageId = actionEl.getAttribute('data-image-id') || '';
            const insertId = actionEl.getAttribute('data-insert-id') || '';
            try {
                if (window.opener && window.opener.document && window.opener.document.forms && window.opener.document.forms.postform) {
                    window.opener.document.forms.postform.message.value += '[album]' + imageId + '[/album]';
                }
            } catch (err) {
                return;
            }
            const inserted = insertId ? document.getElementById('inserted_' + insertId) : null;
            if (inserted) {
                inserted.removeAttribute('hidden');
                inserted.style.display = '';
            }
            return;
        }

        if (action === 'donate-paypal-submit') {
            const contact = document.getElementById('contactpaypal');
            const processing = document.getElementById('processingpaypal');
            if (contact) {
                contact.setAttribute('hidden', 'hidden');
                contact.style.display = 'none';
            }
            if (processing) {
                processing.removeAttribute('hidden');
                processing.style.display = '';
            }
            return;
        }

        if (action === 'clear-date') {
            e.preventDefault();
            const fieldId = actionEl.getAttribute('data-date-field') || '';
            const field = fieldId ? document.getElementById(fieldId) : null;
            if (field) {
                field.value = '';
            }
            return;
        }

        if (action === 'gallery-add-field') {
            e.preventDefault();
            if (typeof window.galleryAddField === 'function') {
                window.galleryAddField();
            }
            return;
        }

        if (action === 'gallery-same-name') {
            if (typeof window.change_read_write === 'function') {
                window.change_read_write();
            }
            return;
        }

        if (action === 'gallery-update-all') {
            const field = actionEl.getAttribute('data-update-field');
            if (typeof window.update_all === 'function') {
                if (field) {
                    window.update_all(field);
                } else {
                    window.update_all('image_name');
                    window.update_all('message');
                }
            }
            return;
        }

        if (action === 'gallery-set-text') {
            const index = parseInt(actionEl.getAttribute('data-image-index') || '0', 10);
            if (typeof window.set_text_field === 'function') {
                window.set_text_field(index);
            }
            const field = actionEl.getAttribute('data-update-field');
            if (field && typeof window.update_all === 'function') {
                window.update_all(field);
            }
            return;
        }

        if (action === 'gallery-popup') {
            e.preventDefault();
            const width = parseInt(actionEl.getAttribute('data-popup-width') || '300', 10);
            const height = parseInt(actionEl.getAttribute('data-popup-height') || '350', 10);
            const target = actionEl.getAttribute('data-popup-target') || '_popup';
            if (typeof window.gallery_popup === 'function') {
                window.gallery_popup(actionEl.href, width, height, target);
            } else if (typeof popup === 'function') {
                popup(actionEl.href, width, height, target);
            }
            return;
        }

        if (action === 'help-popup') {
            e.preventDefault();
            const url = actionEl.getAttribute('data-help-url') || actionEl.href;
            if (url) {
                window.open(url, '_blank', 'height=400,resizable=yes,width=550');
            }
            return;
        }

        if (action === 'marklist') {
            e.preventDefault();
            const formId = actionEl.getAttribute('data-mark-form') || '';
            const markName = actionEl.getAttribute('data-mark-name') || '';
            const markState = actionEl.getAttribute('data-mark-state') === 'true';
            if (typeof marklist === 'function') {
                marklist(formId, markName, markState);
            }
            return;
        }

        if (action === 'marklist-multi') {
            e.preventDefault();
            const marklistValue = actionEl.getAttribute('data-marklist') || '';
            if (typeof marklist === 'function' && marklistValue) {
                marklistValue.split('|').forEach(entry => {
                    const parts = entry.split(':');
                    if (parts.length === 3) {
                        marklist(parts[0], parts[1], parts[2] === 'true');
                    }
                });
            }
            return;
        }

        if (action === 'open-new-window') {
            e.preventDefault();
            window.open(actionEl.href, '_blank');
            return;
        }

        if (action === 'attach-view-image') {
            e.preventDefault();
            if (typeof viewableArea === 'function') {
                viewableArea(actionEl.querySelector('img') || actionEl);
            }
            return;
        }

        if (action === 'play-quicktime') {
            e.preventDefault();
            const streamId = actionEl.getAttribute('data-stream-id');
            const stream = streamId ? document[streamId] : null;
            if (stream && typeof play_qt_file === 'function') {
                play_qt_file(stream);
            }
            return;
        }

        if (action === 'code-linenumbers') {
            e.preventDefault();
            if (typeof linenumberOnOff === 'function') {
                linenumberOnOff(actionEl.getAttribute('data-code-id'));
            }
            return;
        }

        if (action === 'code-expand') {
            e.preventDefault();
            if (typeof expandCode === 'function') {
                expandCode(actionEl.getAttribute('data-code-id'));
            }
            return;
        }

        if (action === 'code-select') {
            e.preventDefault();
            if (typeof selectCode === 'function') {
                selectCode(e);
            }
            return;
        }

        if (action === 'abbc3-spoiler') {
            e.preventDefault();
            if (typeof abbc3_spoiler === 'function') {
                abbc3_spoiler(actionEl, actionEl.getAttribute('data-spoiler-hide'), actionEl.getAttribute('data-spoiler-show'));
            }
            return;
        }

        if (action === 'insert-text') {
            e.preventDefault();
            if (typeof insert_text === 'function') {
                insert_text(actionEl.getAttribute('data-insert-text') || '', true);
            }
            return;
        }

        if (action === 'mcp-subpanel') {
            e.preventDefault();
            if (typeof window.showMcpPanel === 'function') {
                window.showMcpPanel(actionEl.getAttribute('data-panel'));
            }
            return;
        }

        if (action === 'toggle-history-view') {
            e.preventDefault();
            const targetId = actionEl.getAttribute('data-target') || 'topicreview';
            const topicReview = document.getElementById(targetId);
            if (topicReview && typeof viewableArea === 'function') {
                viewableArea(topicReview, true);
            }

            const expandLabel = actionEl.getAttribute('data-label-expand') || '';
            const collapseLabel = actionEl.getAttribute('data-label-collapse') || '';
            const currentText = (actionEl.textContent || '').trim();
            if (currentText === expandLabel) {
                actionEl.textContent = collapseLabel;
            } else if (currentText === collapseLabel) {
                actionEl.textContent = expandLabel;
            }
            return;
        }

        if (action === 'addquote') {
            e.preventDefault();
            if (typeof addquote === 'function') {
                addquote(
                    actionEl.getAttribute('data-quote-msg-id'),
                    actionEl.getAttribute('data-quote-author') || '',
                    actionEl.getAttribute('data-quote-wrote') || ''
                );
            }
        }
    });

    const resolveDataValue = (element, source, fallback) => {
        if (!source || source === 'self') {
            return fallback;
        }

        if (source.startsWith('#')) {
            const sourceElement = document.querySelector(source);
            if (sourceElement) {
                return sourceElement.value;
            }
        }

        return source;
    };

    const setDigestCustomDateVisibility = (select) => {
        const customDateRow = document.getElementById('custom_date');
        const dateFormatInput = document.getElementById('dateformat');
        if (!customDateRow || !dateFormatInput || !select) {
            return;
        }

        if (select.value === 'custom') {
            dE('custom_date', 1);
            const defaultDateFormat = select.getAttribute('data-default-dateformat');
            if (defaultDateFormat) {
                dateFormatInput.value = defaultDateFormat;
            }
        } else {
            dE('custom_date', -1);
            dateFormatInput.value = select.value;
        }
    };

    const initializeDateOptions = () => {
        const dateOptions = document.getElementById('dateoptions');
        if (!dateOptions) {
            return;
        }

        const dateFormat = dateOptions.getAttribute('data-date-format');
        const fallbackIndex = dateOptions.options.length - 1;
        dateOptions.selectedIndex = fallbackIndex;

        for (let i = 0; i < dateOptions.options.length; i++) {
            if (dateOptions.options[i].value === dateFormat) {
                dateOptions.selectedIndex = i;
                break;
            }
        }

        if (dateOptions.selectedIndex === fallbackIndex) {
            dE('custom_date', 1);
        } else {
            dE('custom_date', -1);
        }
    };

    const runAjaxCheck = (actionEl) => {
        const form = actionEl.form;
        if (!form) {
            return;
        }

        const checksFile = form.getAttribute('data-ajax-checks-file');
        if (!checksFile) {
            return;
        }

        const mode = actionEl.getAttribute('data-check-mode') || '';
        const name1 = actionEl.getAttribute('data-check-name1') || '';
        const value1 = resolveDataValue(actionEl, actionEl.getAttribute('data-check-value1-source'), actionEl.value);
        const name2 = actionEl.getAttribute('data-check-name2') || '';
        const value2 = resolveDataValue(actionEl, actionEl.getAttribute('data-check-value2-source'), '');

        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('new_password');
        const passwordConfirmField = document.getElementById('password_confirm');
        const emailField = document.getElementById('email');
        const emailConfirmField = document.getElementById('email_confirm');

        if (mode === 'usernamecheck') {
            if (!usernameField || usernameField.value === '') {
                return;
            }
            const checkTarget = document.getElementById('usernamecheck');
            if (checkTarget) {
                checkTarget.innerHTML = `${form.getAttribute('data-ajax-checking-img') || ''}&nbsp;${form.getAttribute('data-ajax-checking-username') || ''}`;
            }
        } else if (mode === 'passwordcheck') {
            if (!passwordField || !passwordConfirmField || passwordField.value === '' || passwordConfirmField.value === '') {
                return;
            }
            const checkTarget = document.getElementById('passwordcheck');
            if (checkTarget) {
                checkTarget.innerHTML = `${form.getAttribute('data-ajax-checking-img') || ''}&nbsp;${form.getAttribute('data-ajax-checking-password') || ''}`;
            }
        } else if (mode === 'emailcheck') {
            if (!emailField || !emailConfirmField || emailField.value === '' || emailConfirmField.value === '') {
                return;
            }
            const checkTarget = document.getElementById('emailcheck');
            if (checkTarget) {
                checkTarget.innerHTML = `${form.getAttribute('data-ajax-checking-img') || ''}&nbsp;${form.getAttribute('data-ajax-checking-email') || ''}`;
            }
        } else {
            return;
        }

        const requestUrl = `${checksFile}?mode=${encodeURIComponent(mode)}&${encodeURIComponent(name1)}=${encodeURIComponent(value1)}&${encodeURIComponent(name2)}=${encodeURIComponent(value2)}`;
        fetch(requestUrl)
            .then(response => response.text())
            .then(text => {
                const splitIndex = text.indexOf('|');
                if (splitIndex === -1) {
                    return;
                }
                const targetId = text.substring(0, splitIndex);
                const html = text.substring(splitIndex + 1);
                const target = document.getElementById(targetId);
                if (target) {
                    target.innerHTML = html;
                }
            })
            .catch(() => {});
    };

    const validateDigestWordSize = (field, useMinimumRule) => {
        if (!field || field.value === '') {
            return true;
        }

        const form = field.form;
        if (!form) {
            return true;
        }

        const minError = form.getAttribute('data-digest-size-error-min') || 'Invalid value';
        const sizeError = form.getAttribute('data-digest-size-error') || 'Invalid value';

        const value = parseInt(field.value, 10);
        if (Number.isNaN(value) || value < 0) {
            alert(useMinimumRule ? minError : sizeError);
            field.focus();
            return false;
        }

        if (useMinimumRule) {
            field.value = value;
            return true;
        }

        if (value <= 0) {
            alert(sizeError);
            field.focus();
            return false;
        }

        if (field.defaultValue !== '' && field.defaultValue !== '0') {
            const maxItems = parseInt(field.defaultValue, 10);
            if (!Number.isNaN(maxItems) && value > maxItems) {
                alert(sizeError);
                field.focus();
                return false;
            }
        }

        return true;
    };

    const disableDigestForums = (disabledState) => {
        const isDisabled = disabledState === '1';
        const container = document.getElementById('div_0');
        if (container) {
            container.querySelectorAll('input[id^="elt_"]').forEach(input => {
                input.disabled = isDisabled;
            });
        }

        const allForums = document.getElementById('all_forums');
        if (allForums) {
            allForums.disabled = isDisabled;
        }
    };

    const syncDigestSubscribedForums = (checkbox) => {
        const container = document.getElementById('div_0');
        if (!container) {
            return;
        }

        container.querySelectorAll('input[id^="elt_"]').forEach(input => {
            input.checked = checkbox.checked;
        });
    };

    const syncDigestAllForums = () => {
        const container = document.getElementById('div_0');
        const allForums = document.getElementById('all_forums');
        if (!container || !allForums) {
            return;
        }

        const inputs = Array.from(container.querySelectorAll('input[id^="elt_"]'));
        allForums.checked = inputs.every(input => input.checked);
    };

    const validateDigestSubmission = (form) => {
        const allForums = form.querySelector('#all_forums');
        if (!allForums || allForums.checked) {
            return true;
        }

        const selectedForum = form.querySelector('#div_0 input[id^="elt_"]:checked');
        if (!selectedForum) {
            alert(form.getAttribute('data-digest-no-forums-checked') || 'Select at least one forum.');
            return false;
        }

        return true;
    };

    const wireFormSubmitChecks = () => {
        document.querySelectorAll('form[data-submit-check="show-warning"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!validateDigestSubmission(form)) {
                    e.preventDefault();
                }
            });
        });
    };

    const applyOnKeyPressHandlers = () => {
        document.querySelectorAll('form[data-apply-onkeypress="1"]').forEach(() => {
            if (typeof apply_onkeypress_event === 'function') {
                apply_onkeypress_event();
            }
        });
    };

    document.addEventListener('change', function(e) {
        const actionEl = e.target.closest('[data-action]');
        if (!actionEl) {
            return;
        }

        const action = actionEl.getAttribute('data-action');

        if (action === 'change-language') {
            const form = actionEl.form || document.getElementById('register');
            if (!form) {
                return;
            }

            const changeLangInput = form.querySelector('input[name="change_lang"]');
            if (changeLangInput) {
                changeLangInput.value = actionEl.value;
            }

            const submitButton = form.querySelector('input[type="submit"], button[type="submit"]');
            if (submitButton && typeof submitButton.click === 'function') {
                submitButton.click();
            } else if (typeof form.submit === 'function') {
                form.submit();
            }
            return;
        }

        if (action === 'dateoptions-change') {
            setDigestCustomDateVisibility(actionEl);
            return;
        }

        if (action === 'disable-forums') {
            disableDigestForums(actionEl.getAttribute('data-disabled-state'));
            return;
        }

        if (action === 'uncheck-subscribed-forums') {
            syncDigestSubscribedForums(actionEl);
            return;
        }

        if (action === 'uncheck-all-forums') {
            syncDigestAllForums();
            return;
        }

        if (action === 'check-uncheck') {
            const targetId = actionEl.getAttribute('data-check-target');
            const target = targetId ? document.getElementById(targetId) : null;
            if (target) {
                target.disabled = actionEl.id !== 'pms1' || !actionEl.checked;
            }
        }
    });

    document.addEventListener('blur', function(e) {
        const actionEl = e.target.closest('[data-action]');
        if (!actionEl) {
            return;
        }

        const action = actionEl.getAttribute('data-action');
        if (action === 'ajax-check') {
            runAjaxCheck(actionEl);
            return;
        }

        if (action === 'check-word-size') {
            validateDigestWordSize(actionEl, false);
            return;
        }

        if (action === 'check-word-size-min') {
            validateDigestWordSize(actionEl, true);
        }
    }, true);

    applyOnKeyPressHandlers();
    initializeDateOptions();
    wireFormSubmitChecks();

    document.querySelectorAll('[data-store-caret]').forEach((el) => {
        ['select', 'click', 'keyup'].forEach((evt) => {
            el.addEventListener(evt, () => {
                if (typeof storeCaret === 'function') {
                    storeCaret(el);
                }
            });
        });
        el.addEventListener('focus', () => {
            if (typeof initInsertions === 'function') {
                initInsertions();
            }
        });
    });

    document.querySelectorAll('[data-action="blog-style-demo"]').forEach((select) => {
        select.addEventListener('change', function() {
            const demo = document.getElementById('style_demo');
            const selected = this.options[this.selectedIndex];
            if (demo && selected) {
                demo.src = selected.id;
            }
        });
    });

    // Initialize posting sub-panels (Options / Attach / Poll / Event tabs)
    if (typeof window.initCalendarPage === 'function' && document.querySelector('[data-calendar-page]')) {
        window.initCalendarPage();
    } else if (typeof subPanels === 'function' && typeof show_panel !== 'undefined') {
        subPanels(show_panel);
    }

    const blogPosting = document.querySelector('[data-blog-panels]');
    if (blogPosting && typeof subPanels === 'function') {
        const panelList = blogPosting.getAttribute('data-blog-panels') || '';
        window.panels = panelList.split(',').map((name) => name.replace(/['"\s]/g, '')).filter(Boolean);
        const firstPanel = window.panels[0] || (typeof show_panel !== 'undefined' ? show_panel : 'options-panel');
        subPanels(firstPanel);
    }

    const kbPanels = document.querySelector('[data-kb-panels]');
    if (kbPanels && typeof subPanels === 'function') {
        const panelList = kbPanels.getAttribute('data-kb-panels') || '';
        window.panels = panelList.split(',').map((name) => name.replace(/['"\s]/g, '')).filter(Boolean);
        const hash = (window.location.hash || '').replace('#', '');
        const hashPanel = hash ? hash + '-panel' : '';
        const firstPanel = (hashPanel && window.panels.indexOf(hashPanel) !== -1)
            ? hashPanel
            : (window.panels[0] || 'article-panel');
        subPanels(firstPanel);
    }

    if (typeof window.DropDate !== 'function') {
        window.DropDate = function(field) {
            const el = document.getElementById(field);
            if (el) {
                el.value = '';
            }
        };
    }

    if (typeof window.openguestpopup !== 'function') {
        window.openguestpopup = function(meeting, user) {
            const source = document.querySelector('[data-meeting-guest-popup]');
            const base = source ? source.getAttribute('data-meeting-guest-popup') : '';
            if (!base) {
                return;
            }
            window.open(base + '&m_id=' + meeting + '&u=' + user, '_blank', 'height=600,resizable=yes,width=400');
        };
    }

    const seoForm = document.querySelector('[data-kb-seo="1"]');
    const seoSource = seoForm ? seoForm.querySelector('[data-kb-seo-source]') : null;
    if (seoSource) {
        seoSource.addEventListener('keyup', function() {
            const target = document.getElementById('page_uri');
            if (!target) {
                return;
            }
            let title = this.value || '';
            title = title.split(' ').join('-').toLowerCase();
            title = title.split('ä').join('ae');
            title = title.split('ö').join('oe');
            title = title.split('ü').join('ur');
            title = title.split('ß').join('ss');
            title = title.split('?').join('');
            title = title.split('!').join('');
            target.value = escape(title);
        });
    }

    const meetingEditor = document.querySelector('[data-meeting-editor]');
    if (meetingEditor) {
        window.form_name = 'edit_meeting';
        window.text_name = 'message';
    }

    document.addEventListener('change', function(e) {
        const styleDemo = e.target.closest('[data-action="blog-style-demo"]');
        if (styleDemo && styleDemo.options) {
            const selected = styleDemo.options[styleDemo.selectedIndex];
            const demo = document.getElementById('style_demo');
            if (demo && selected && selected.id) {
                demo.src = selected.id;
            }
            return;
        }

        const submitFormEl = e.target.closest('[data-action="submit-form"]');
        if (submitFormEl) {
            const form = submitFormEl.form || submitFormEl.closest('form');
            if (form) {
                form.submit();
            }
        }
    });

    document.querySelectorAll('[data-store-caret]').forEach((field) => {
        const store = function() {
            if (typeof storeCaret === 'function') {
                storeCaret(field);
            }
        };
        field.addEventListener('select', store);
        field.addEventListener('click', store);
        field.addEventListener('keyup', store);
        field.addEventListener('focus', function() {
            if (typeof initInsertions === 'function') {
                initInsertions();
            }
        });
    });

    const dlAjaxConfig = document.getElementById('dl-ajax-config');
    if (dlAjaxConfig) {
        window.phpEx = dlAjaxConfig.getAttribute('data-phpex') || '';
        window.S_SID = dlAjaxConfig.getAttribute('data-sid') || '';
        window.ajax_page_charset = dlAjaxConfig.getAttribute('data-charset') || '';
    }

    const dlHelpConfig = document.getElementById('dl-help-config');
    window.help_popup = function(helpKey) {
        const base = dlHelpConfig ? (dlHelpConfig.getAttribute('data-help-url') || '') : '';
        if (base && helpKey) {
            window.open(base + helpKey, '_blank', 'height=400,resizable=yes,width=550');
        }
    };

    window.hide_dl_button = function() {
        const button = document.getElementById('dl_mod_button');
        if (button) {
            button.style.display = 'none';
        }
    };

    document.querySelectorAll('form[data-hide-dl-button]').forEach((form) => {
        form.addEventListener('submit', function() {
            window.hide_dl_button();
        });
    });

    const galleryUploadConfig = document.getElementById('gallery-upload-config');
    if (galleryUploadConfig) {
        let numDisplayedFields = 1;
        const limitFields = parseInt(galleryUploadConfig.getAttribute('data-limit') || '1', 10);
        const hideField = (id) => {
            const el = document.getElementById(id);
            if (el) {
                el.setAttribute('hidden', 'hidden');
                el.style.display = 'none';
            }
        };
        const showField = (id) => {
            const el = document.getElementById(id);
            if (el) {
                el.removeAttribute('hidden');
                el.style.display = '';
            }
        };
        window.galleryAddField = function() {
            if (numDisplayedFields < limitFields) {
                showField('upload_field_' + numDisplayedFields);
                numDisplayedFields += 1;
                if (numDisplayedFields === limitFields) {
                    hideField('add_field_link');
                }
            }
        };
        for (let i = 1; i < limitFields; i += 1) {
            hideField('upload_field_' + i);
        }
        if (limitFields > 1) {
            showField('add_field_link');
        }
    }

    const galleryEditorConfig = document.getElementById('gallery-editor-config');
    if (galleryEditorConfig) {
        window.form_name = galleryEditorConfig.getAttribute('data-form-name') || 'postform';
        window.text_name = galleryEditorConfig.getAttribute('data-text-name') || 'message_0';
        if (typeof window.set_text_field === 'function') {
            window.set_text_field(0);
        }
    }

    const highslideMeta = document.querySelector('meta[name="integra-gallery-highslide-graphics-dir"]');
    if (highslideMeta && window.hs) {
        window.hs.graphicsDir = highslideMeta.getAttribute('content') || '';
    }

    document.querySelectorAll('[data-action="select-on-focus"]').forEach((el) => {
        el.addEventListener('focus', function() {
            this.select();
        });
    });

    document.querySelectorAll('[data-action="placeholder-toggle"]').forEach((el) => {
        const placeholder = el.getAttribute('data-placeholder') || '';
        el.addEventListener('focus', function() {
            if (this.value === placeholder) {
                this.value = '';
            }
        });
        el.addEventListener('blur', function() {
            if (this.value === '') {
                this.value = placeholder;
            }
        });
    });

    document.querySelectorAll('form[data-action="jumpbox-guard"]').forEach((form) => {
        form.addEventListener('submit', function(e) {
            const fieldName = form.getAttribute('data-jump-name') || 'album_id';
            const field = form.elements[fieldName];
            if (field && String(field.value) === '-1') {
                e.preventDefault();
            }
        });
    });

    const dlEditorConfig = document.getElementById('dl-editor-config');
    if (dlEditorConfig) {
        window.form_name = dlEditorConfig.getAttribute('data-form-name') || 'postform';
        window.text_name = dlEditorConfig.getAttribute('data-text-name') || 'message';
        window.LANG_TOO_FEW_CHARS = dlEditorConfig.getAttribute('data-too-few-chars') || '';
        window.LANG_L_NO_TEXT_SELECTED = dlEditorConfig.getAttribute('data-no-text-selected') || '';
    }

    const dlThumbs = document.getElementById('dl_thumbs');
    if (dlThumbs && dlThumbs.getAttribute('data-carousel') === '1' && window.jQuery && typeof window.jQuery.fn.jcarousel === 'function') {
        window.jQuery(dlThumbs).jcarousel({
            visible: parseInt(dlThumbs.getAttribute('data-visible') || '1', 10),
            scroll: parseInt(dlThumbs.getAttribute('data-scroll') || '1', 10)
        });
    }

    const blogConfig = document.getElementById('blog-config');
    if (blogConfig) {
        const greyStar = blogConfig.getAttribute('data-grey-star') || '';
        const greenStar = blogConfig.getAttribute('data-green-star') || '';
        const redStar = blogConfig.getAttribute('data-red-star') || '';
        const orangeStar = blogConfig.getAttribute('data-orange-star') || '';
        const maxRating = parseInt(blogConfig.getAttribute('data-max-rating'), 10) || 0;
        const minRating = parseInt(blogConfig.getAttribute('data-min-rating'), 10) || 0;

        window.ratingHover = function(id, name) {
            for (let i = minRating; i <= maxRating; i += 1) {
                const star = document.getElementById(name + i);
                if (star) {
                    star.src = i <= id ? redStar : greyStar;
                }
            }
        };

        window.ratingUnHover = function(id, name) {
            for (let i = minRating; i <= maxRating; i += 1) {
                const star = document.getElementById(name + i);
                if (star) {
                    star.src = i <= id ? orangeStar : greyStar;
                }
            }
        };

        window.ratingDown = function(id, name) {
            for (let i = minRating; i <= maxRating; i += 1) {
                const star = document.getElementById(name + i);
                if (star) {
                    star.src = i <= id ? greenStar : greyStar;
                }
            }
        };
    }

    const friendsConfig = document.getElementById('blog-friends-config');
    if (friendsConfig) {
        const limit = parseInt(friendsConfig.getAttribute('data-limit'), 10) || 5;
        let currentOnlineId = limit;
        let currentOfflineId = limit;
        let currentUserFriendsId = limit;
        let onlineEnd = 0;
        let offlineEnd = 0;
        let userFriendsEnd = 0;

        const setCurrent = (field, value, end) => {
            if (field === 'online') {
                currentOnlineId = value;
                onlineEnd = end;
            } else if (field === 'offline') {
                currentOfflineId = value;
                offlineEnd = end;
            } else {
                currentUserFriendsId = value;
                userFriendsEnd = end;
            }
        };

        window.next_list = function(field) {
            let currentId = field === 'online' ? currentOnlineId - limit : (field === 'offline' ? currentOfflineId - limit : currentUserFriendsId - limit);
            let end = field === 'online' ? onlineEnd : (field === 'offline' ? offlineEnd : userFriendsEnd);

            for (let i = 0; i < (limit * 2); i += 1) {
                const next = document.getElementById(field + '_friends_' + currentId);
                if (next) {
                    next.classList.toggle('blog-hidden', i < limit);
                    currentId += 1;
                } else {
                    end += 1;
                }
            }

            const previous = document.getElementById('previous_' + field);
            if (previous) {
                previous.classList.remove('blog-hidden');
            }

            const following = document.getElementById(field + '_friends_' + currentId);
            if (end > 0 || !following) {
                const nextBtn = document.getElementById('next_' + field);
                if (nextBtn) {
                    nextBtn.classList.add('blog-hidden');
                }
            }

            setCurrent(field, currentId, end);
        };

        window.previous_list = function(field) {
            let currentId = field === 'online' ? currentOnlineId - 1 : (field === 'offline' ? currentOfflineId - 1 : currentUserFriendsId - 1);
            let end = field === 'online' ? onlineEnd : (field === 'offline' ? offlineEnd : userFriendsEnd);

            for (let i = 0; i < ((limit * 2) - end); i += 1) {
                const next = document.getElementById(field + '_friends_' + currentId);
                if (next) {
                    next.classList.toggle('blog-hidden', i < (limit - end));
                    currentId -= 1;
                }
            }

            currentId = currentId + limit + 1;
            const nextBtn = document.getElementById('next_' + field);
            if (nextBtn) {
                nextBtn.classList.remove('blog-hidden');
            }
            end = 0;

            if (currentId === limit) {
                const previous = document.getElementById('previous_' + field);
                if (previous) {
                    previous.classList.add('blog-hidden');
                }
            }

            setCurrent(field, currentId, end);
        };
    }

    // Fast reply toggle
    const fastReplyPanels = document.querySelectorAll('.fastreply');
    if (fastReplyPanels.length) {
        fastReplyPanels.forEach(panel => {
            panel.style.display = 'none';
        });

        document.querySelectorAll('a.fast-reply').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                fastReplyPanels.forEach(panel => {
                    panel.style.display = panel.style.display === 'none' ? '' : 'none';
                });
            });
        });
    }

    document.querySelectorAll('[data-find-username]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            find_username(this.href);
        });
    });

    // Cookie consent actions
    const cookieConsentModal = document.getElementById('cookie-consent-modal');
    if (cookieConsentModal) {
        const acceptBtn = cookieConsentModal.querySelector('.cookie-accept-btn');
        const declineBtn = cookieConsentModal.querySelector('.cookie-decline-btn');

        if (acceptBtn) {
            acceptBtn.addEventListener('click', function(e) {
                e.preventDefault();
                globalThis.acceptCookies();
            });
        }

        if (declineBtn) {
            declineBtn.addEventListener('click', function(e) {
                e.preventDefault();
                globalThis.declineCookies();
            });
        }
    }

    checkCookieConsent();

    initializeMchat();
    initializePasswordStrength();
});

let onunloadExecuted = false;
const runOnUnloadFunctions = () => {
    if (onunloadExecuted) {
        return;
    }

    onunloadExecuted = true;
    executeFunctions(initFunctions.onunload);
};

window.addEventListener('pagehide', runOnUnloadFunctions);
window.addEventListener('beforeunload', runOnUnloadFunctions);

function find_username(url) {
    popup(url, 760, 570, '_usersearch');
    return false;
}

function notes(url) {
    const popupUrl = url || document.getElementById('phpbb')?.getAttribute('data-personal-notes-popup');
    if (popupUrl && popupUrl.trim() !== '') {
        window.open(popupUrl.replace(/&amp;/g, '&'), '_blank', 'width=800,height=600,scrollbars=yes,resizable=no');
    }
}

// Cookie Consent Functions
function setCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

function getCookie(name) {
    var nameEQ = name + '=';
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

globalThis.acceptCookies = function() {
    setCookie('cookie_consent', 'accepted', 365);
    hideCookieConsent();
};

globalThis.declineCookies = function() {
    setCookie('cookie_consent', 'declined', 365);
    hideCookieConsent();
};

function showCookieConsent() {
    var modal = document.getElementById('cookie-consent-modal');
    if (modal) modal.style.display = 'block';
}

window.toggleDiv = function(divName) {
    const thisDiv = document.getElementById(divName);
    if (!thisDiv) {
        return;
    }
    const isHidden = thisDiv.style.display === 'none' || thisDiv.classList.contains('blog-hidden');
    thisDiv.style.display = isHidden ? '' : 'none';
    thisDiv.classList.toggle('blog-hidden', !isHidden);
};

function hideCookieConsent() {
    var modal = document.getElementById('cookie-consent-modal');
    if (modal) modal.style.display = 'none';
}

function checkCookieConsent() {
    if (!getCookie('cookie_consent')) {
        showCookieConsent();
    }
}

document.addEventListener('click', function(e) {
    const acceptBtn = e.target.closest('.cookie-accept-btn');
    if (acceptBtn) {
        e.preventDefault();
        globalThis.acceptCookies();
        return;
    }

    const declineBtn = e.target.closest('.cookie-decline-btn');
    if (declineBtn) {
        e.preventDefault();
        globalThis.declineCookies();
    }
});
