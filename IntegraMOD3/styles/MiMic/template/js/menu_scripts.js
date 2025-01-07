(function(window, document) {
    'use strict';
 
    // Function to load jQuery
    function loadJQuery(callback) {
        var script = document.createElement('script');
        script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js';
        script.onload = callback;
        document.head.appendChild(script);
    }
 
    // Function to load hoverIntent plugin
    function loadHoverIntent(callback) {
        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.10.2/jquery.hoverIntent.min.js';
        script.onload = callback;
        document.head.appendChild(script);
    }
 
    // Function to initialize our code
    function initialize(jQuery) {
        // Original code starts here
        (function($) {
            // Wait for the DOM to be fully loaded
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
                if ($.fn.hoverIntent) {
                    $phpbbMenu.children('li').hoverIntent({
                        over: function() {
                            // Show
                            if (!(phpbb.isTouch && $(window).width() < 900)) {
                                $('> .sub-menu', this).show();
                                $('a', this).addClass('hovering');
                            }
                        },
                        out: function() {
                            // Hide
                            if (!(phpbb.isTouch && $(window).width() < 900)) {
                                $('> .sub-menu', this).hide();
                                $('a', this).removeClass('hovering');
                            }
                        },
                        timeout: 200
                    });
                } else {
                    console.warn('hoverIntent plugin not loaded. Fallback to normal hover behavior.');
                    $phpbbMenu.children('li').hover(
                        function() {
                            if (!(phpbb.isTouch && $(window).width() < 900)) {
                                $('> .sub-menu', this).show();
                                $('a', this).addClass('hovering');
                            }
                        },
                        function() {
                            if (!(phpbb.isTouch && $(window).width() < 900)) {
                                $('> .sub-menu', this).hide();
                                $('a', this).removeClass('hovering');
                            }
                        }
                    );
                }
            });
            // Custom plugin
            $.fn.toggleFadeSlide = function(duration, easing, callback) {
                return this.animate({
                    opacity: 'toggle',
                    height: 'toggle'
                }, duration, easing, callback);
            };
        })(jQuery);
    }
 
    // Check if jQuery is already loaded
    if (window.jQuery) {
        loadHoverIntent(function() {
            initialize(window.jQuery);
        });
    } else {
        loadJQuery(function() {
            loadHoverIntent(function() {
                initialize(window.jQuery);
            });
        });
    }
 
})(window, document);