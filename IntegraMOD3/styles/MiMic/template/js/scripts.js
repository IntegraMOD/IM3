(function($) {
    'use strict';
 
    $(function() {
        // Swap .nojs and .hasjs
        var phpbb = window.phpbb || {};
        phpbb.isTouch = (window && typeof window.ontouchstart !== 'undefined');
        $('#phpbb.nojs').toggleClass('nojs hasjs');
        $('#phpbb').toggleClass('hastouch', phpbb.isTouch);
        $('#phpbb.hastouch').removeClass('notouch');
 
        function isIE() {
            return navigator.userAgent.match(/MSIE \d\.\d+/);
        }
 
        var $phpbbNavbar = $('#phpbb-navbar');
        var $phpbbMenu = $('#phpbb-menu');
        var $phpbbSidebar;
        var $phpbbSidebarToggle;
 
        // Setup the drop downs for mouse-hover
        $phpbbMenu.children('li').hoverIntent({
            over: function() {
                // Show
                if (!(phpbb.isTouch && $(window).width() < 900)) {
                    $('> .sub-menu', this).toggle();
                    $('a', this).addClass('hovering');
                }
            },
            out: function() {
                // Hide
                if (!(phpbb.isTouch && $(window).width() < 900)) {
                    $('> .sub-menu', this).toggle();
                    $('a', this).removeClass('hovering');
                }
            }
        });
 
        // IE fun
        if (isIE()) {
            $phpbbMenu.find('li li').hover(function() {
                $(this).addClass('hover_ie');
            }, function() {
                $(this).removeClass('hover_ie');
            });
 
            // For each div with class menu (i.e., the thing we want to be on top)
            $('.sub-menu').parents().each(function() {
                var $p = $(this),
                    pos = $p.css('position');
 
                // If it's positioned,
                if (pos === 'relative' || pos === 'absolute' || pos === 'fixed') {
                    $p.hover(function() {
                        $(this).addClass('on-top');
                    }, function() {
                        $(this).removeClass('on-top');
                    });
                }
            });
        }
 
        // Responsive navbar menu
        $phpbbNavbar.find('#phpbb-menu-toggle').on('click', function(e) {
            $phpbbMenu.toggleClass('show');
            $phpbbNavbar.toggleClass('menu-open');
 
            e.preventDefault();
        });
 
        // Add fly-out toggle buttons for responsive submenus
        if (phpbb.isTouch) {
            $phpbbMenu.find('.nav-button').each(function() {
                if ($(this).children('.sub-menu').length) {
                    $(this).prepend('<a href="#" class="submenu-toggle"></a>');
                }
                $(this).children('.submenu-toggle').on('click', function(e) {
                    var $itemMenu = $(this).siblings('.sub-menu');
                    $itemMenu.toggle();
 
                    // close all other sub-menus
                    $phpbbMenu.find('.sub-menu').not($itemMenu).each(function() {
                        $(this).toggle(false);
                    });
 
                    e.preventDefault();
                });
            });
        }
 
        // Responsive side-bar menu
        var $extras = $('#extras');
 
        if ($extras.length) {
            $extras.wrap('<div id="phpbb-sidebar" class="sidebar"></div>').before('<a href="#" id="phpbb-sidebar-toggle" class="sidebar-toggle" title="Toggle sidebar"></a>');
            $('#main').addClass('has-sidebar');
            $phpbbSidebar = $('#phpbb-sidebar');
            $phpbbSidebarToggle = $('#phpbb-sidebar-toggle');
 
            $phpbbSidebarToggle.on('click', function(e) {
                $phpbbSidebar.toggleClass('show');
 
                e.preventDefault();
            });
        }
 
        // Hide active dropdowns/menus when click event happens outside
        $(document).on('click', function(e) {
            var $target = $(e.target);
            if (!$target.closest($phpbbNavbar).length) {
                $phpbbMenu.removeClass('show');
                $phpbbNavbar.removeClass('menu-open');
            }
            if (typeof $phpbbSidebar !== 'undefined' && !$target.closest($phpbbSidebar).length) {
                $phpbbSidebar.removeClass('show');
            }
        });
 
        // Generate side-bar "sections" mini-panel content by parsing headings
        var $sectionsPanel = $('.mini-panel.js-sections'),
            sectionsHTML = '';
 
        if ($sectionsPanel.length) {
            var hasH2 = false,
                indent;
 
            $('#main').find('h2, h3').not('.imgrep').each(function() {
                var $this = $(this),
                    id = $this.attr('id');
 
                if (!id) {
                    id = $this.parent('li').attr('id');
                }
 
                if ($this.is('h2')) {
                    hasH2 = true;
                    indent = '';
                } else if (hasH2) {
                    indent = '- ';
                } else {
                    indent = '';
                }
 
                if (id) {
                    sectionsHTML += '<li>' + indent + '<a href="#' + id + '">' + $this.text() + '</a></li>';
                }
            });
 
            if (sectionsHTML) {
                sectionsHTML = '<div class="inner"><h3>Page Sections</h3><ul class="menu">' + sectionsHTML + '</ul></div>';
                $sectionsPanel.html(sectionsHTML).toggle(true);
            }
        }
 
        // Side-bar "sections" mini-panel will scroll with content
        var $scrollPanel = $('.mini-panel.js-scroll'),
            $pageFooter = $('#page-footer');
 
        if ($scrollPanel.length && $pageFooter.length) {
            var extra = 5,
                footerSpacing = 20,
                top = $scrollPanel.offset().top - extra,
                height = $scrollPanel.height(),
                maxTop = $pageFooter.offset().top - height - footerSpacing,
                fixed = false,
                scrollPanelActive = !$scrollPanel.is(':empty');
 
            function scrollSidePanel() {
                if (scrollPanelActive) {
                    var windowTop = $(window).scrollTop();
                    if (windowTop <= top || windowTop >= maxTop) {
                        if (fixed) {
                            $scrollPanel.css('top', 'auto').removeClass('fixed');
                        }
                        fixed = false;
                        return;
                    }
                    if (!fixed) {
                        fixed = true;
                        $scrollPanel.css('top', extra).addClass('fixed');
                    }
                }
            }
 
            $(window).on('scroll', scrollSidePanel);
            scrollSidePanel();
        }
 
        // Autofocus cookies debugger thing
        $('form[action="cookies.php"] [name="url"]').focus();
 
        // Showcase click tracker
        $('.showcase').on('click', 'a[href*="http"]', function(e) {
            e.preventDefault();
            var href = this.href,
                location = window.location.href;
 
            $.ajax({
                url: location,
                method: 'GET',
                data: { urlClicked: href },
                timeout: 200
            }).always(function() {
                window.location.href = href;
            });
        });
 
        // Teams page
        $('dd.detailed-definition').hide();
        $('dt.name-term a').click(function(e) {
            e.preventDefault();
            $(this).parents('dt').siblings('dd').toggle();
        });
 
        $('#tabs.stats').find('.tab').click(function(evt) {
            evt.preventDefault();
            var showPanel = $(this).attr('data-show-panel');
            $('#tabs.stats .panel').hide();
            $('#' + showPanel).show();
            $('.tab').removeClass('activetab');
            $(this).addClass('activetab');
        });
 
        $('#tabs.stats').find('.activetab').click();
 
        $('dl.codebox > dt > a').click(function(e) {
            e.preventDefault();
            var code = $(this).parent().parent().find('code')[0];
            if (document.body.createTextRange) {
                var range = document.body.createTextRange();
                range.moveToElementText(code);
                range.select();
            } else if (window.getSelection) {
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(code);
                selection.removeAllRanges();
                selection.addRange(range);
            }
        });
    });
 
    // Custom jQuery plugin
    $.fn.toggleFadeSlide = function(duration, easing, callback) {
        return this.animate({
            opacity: 'toggle',
            height: 'toggle'
        }, duration, easing, callback);
    };
 
})(jQuery);