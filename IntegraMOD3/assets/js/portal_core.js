/**
 * portal_core.js
 * Portal-only behavior for IntegraStyle.
 */

const runPortalInitializer = (initializer) => {
    try {
        initializer();
    } catch (e) {
        console.error('Error executing portal initializer:', e);
    }
};

const onPortalReady = (initializer) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => runPortalInitializer(initializer));
    } else {
        runPortalInitializer(initializer);
    }
};

const initializeLegacyPortalClock = () => {
    const clock = document.getElementById('clock');
    const hour = document.getElementById('hour');
    const minute = document.getElementById('minute');
    const second = document.getElementById('second');
    if (!document.getElementById('portal-clock-config') || !clock || !hour || !minute || !second) {
        return;
    }

    const adjustClockSize = () => {
        const containerWidth = clock.parentElement ? clock.parentElement.offsetWidth : clock.offsetWidth;
        let fontSize = Math.floor(containerWidth / 30) - 1;
        fontSize = Math.max(4, Math.min(fontSize, 16));
        clock.style.fontSize = fontSize + 'px';
    };

    const updateClockHands = () => {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const milliseconds = now.getMilliseconds();
        second.style.transform = 'rotate(' + (6 * seconds + 0.006 * milliseconds) + 'deg)';
        minute.style.transform = 'rotate(' + (6 * minutes + 0.1 * seconds + 1e-4 * milliseconds) + 'deg)';
        hour.style.transform = 'rotate(' + (30 * hours + 0.5 * minutes) + 'deg)';
        window.requestAnimationFrame(updateClockHands);
    };

    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame || function(callback) { setTimeout(callback, 1000 / 60); };
    }

    adjustClockSize();
    updateClockHands();
    window.addEventListener('resize', adjustClockSize);
};

onPortalReady(initializeLegacyPortalClock);

onPortalReady(() => {
    // Calendar block navigation wiring
    const calendarStateForm = document.getElementById('hidden');
    if (calendarStateForm && typeof populateTable === 'function') {
        document.querySelectorAll('[data-calendar-action]').forEach(button => {
            button.addEventListener('click', function() {
                populateTable('block_calendar:populate_table', 'hidden', this.getAttribute('data-calendar-action') || '');
            });
        });

        populateTable('block_calendar:populate_table', 'hidden', '');
    }

    // Portal column and block wiring
    if (typeof Get_Cookie === 'function' && typeof ShowHide === 'function') {
        document.querySelectorAll('[data-portal-column]').forEach(column => {
            const cookieName = column.getAttribute('data-portal-cookie');
            const columnName = column.getAttribute('data-portal-column');
            if (cookieName && Get_Cookie(cookieName) === '2') {
                ShowHide(columnName);
                ShowHide(columnName + '_blocks_col_hide');
                ShowHide(columnName + '_blocks_col_show');
            }
        });

        document.querySelectorAll('[data-portal-block-wrap]').forEach(block => {
            const blockId = block.getAttribute('data-portal-block-wrap');
            if (blockId && typeof GetCookie === 'function' && GetCookie('BLOCK_' + blockId) === '2') {
                ShowHide(blockId, '_' + blockId, 'BLOCK_' + blockId);
            }
        });

        document.querySelectorAll('.portal-toggle-link, .portal-block-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-portal-toggle');
                const showTarget = this.getAttribute('data-portal-toggle-show');
                const hideTarget = this.getAttribute('data-portal-toggle-hide');
                if (target) {
                    ShowHide(target, hideTarget, hideTarget);
                }
                if (showTarget) {
                    ShowHide(showTarget);
                }
            });
        });
    }

    if (typeof do_speed === 'function' && typeof set_defaults === 'function') {
        document.querySelectorAll('.scroll_outer').forEach(scroller => {
            const scrollHeight = scroller.getAttribute('data-scroll-height');
            if (scrollHeight) {
                scroller.style.height = scrollHeight + 'px';
            }
            scroller.addEventListener('mouseover', function(e) { do_speed(this, e); });
            scroller.addEventListener('mousemove', function(e) { do_speed(this, e); });
            scroller.addEventListener('mouseout', function(e) { set_defaults(this, e); });
        });
    }

    const portalArrangeState = document.getElementById('portal-arrange-state');
    if (portalArrangeState && typeof Sortable !== 'undefined' && typeof Set_Cookie === 'function') {
        const cookieName = portalArrangeState.getAttribute('data-cookie-name');
        const serializePortalColumns = function() {
            const left = $('leftdebug').innerHTML = Sortable.serialize('left');
            const center = $('centerdebug').innerHTML = Sortable.serialize('center');
            const right = $('rightdebug').innerHTML = Sortable.serialize('right');
            Set_Cookie(cookieName + '_sgp_left', left);
            Set_Cookie(cookieName + '_sgp_center', center);
            Set_Cookie(cookieName + '_sgp_right', right);
        };
        Set_Cookie(cookieName + '_sgp_block_cache', '0');
        ['left', 'center', 'right'].forEach(column => {
            if ($(column)) {
                Sortable.create(column, { tag: 'div', dropOnEmpty: true, handle: 'handle', containment: ['left', 'center', 'right'], constraint: false, onChange: serializePortalColumns });
            }
        });
    }

    const portalCacheState = document.getElementById('portal-cache-state');
    if (portalCacheState && typeof Set_Cookie === 'function') {
        Set_Cookie(portalCacheState.getAttribute('data-cookie-name') + '_sgp_block_cache', portalCacheState.getAttribute('data-cache-value') || '300');
    }

    const portalClearCacheState = document.getElementById('portal-clear-cache-state');
    if (portalClearCacheState && typeof Set_Cookie === 'function') {
        const cookieName = portalClearCacheState.getAttribute('data-cookie-name');
        Set_Cookie(cookieName + '_sgp_block_cache', '0');
        Set_Cookie(cookieName + '_sgp_left', '', 0);
        Set_Cookie(cookieName + '_sgp_center', '', 0);
        Set_Cookie(cookieName + '_sgp_right', '', 0);
    }

    const highslideConfig = document.getElementById('portal-highslide-config');
    if (highslideConfig && typeof hs !== 'undefined') {
        hs.graphicsDir = highslideConfig.getAttribute('data-graphics-dir');
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.outlineType = 'glossy-dark';
        hs.wrapperClassName = 'dark';
        hs.fadeInOut = true;
        if (hs.addSlideshow) {
            hs.addSlideshow({
                interval: 5000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: 0.6,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
        }
    }

    if (document.getElementById('portal-viewtopic-config') && typeof jQuery !== 'undefined') {
        jQuery.noConflict();
        jQuery('.fastreply').hide();
        jQuery('a.qreply-icon').on('click', function(e) {
            e.preventDefault();
            jQuery('.fastreply').toggle(400);
        });
    }

    if (document.getElementById('portal-interaction-config') && typeof jQuery !== 'undefined') {
        jQuery.noConflict();
        jQuery('.hidden_part').hide();
        jQuery('.bg1a').on('mousedown', function() {
            jQuery('#T' + this.id).delay(100).toggle(600);
        }).on('mouseleave', function() {
            jQuery('#T' + this.id).delay(600);
        });
        jQuery('a[rel="external"]').attr('target', '_blank');
        if (typeof jQuery.fn.imgbubbles === 'function') {
            jQuery('.ximg').imgbubbles({ factor: 5 });
        }
        jQuery('.vido').on('click', function() {
            jQuery('#vdo').hide('slide', {}, 1000);
        });
        jQuery('.accordion').on('click', function(e) {
            e.preventDefault();
            jQuery(this).next().toggle('slow');
        }).next().hide();
    }

    if (document.getElementById('portal-resize-config') && typeof jQuery !== 'undefined' && typeof jQuery.fn.slider === 'function') {
        let width = 100;
        const savedWidth = typeof Get_Cookie === 'function' ? Get_Cookie('stylewidth') : null;
        if (savedWidth) {
            width = savedWidth;
        }
        const refreshWidth = function() {
            width = jQuery('#slider').slider('value');
            jQuery('#page-width').css('width', width + '%');
        };
        jQuery('#slider').slider({
            orientation: 'horizontal',
            range: 'min',
            max: 100,
            value: 50,
            slide: refreshWidth,
            change: refreshWidth,
            stop: function() {
                if (typeof Set_Cookie === 'function') {
                    Set_Cookie('stylewidth', width);
                }
                jQuery('#slider').css('display', 'none');
            }
        });
        jQuery('#page-width').css('width', width + '%');
    }

});
