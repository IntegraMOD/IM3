/**
 * Mech2 ticker helper.
 *
 * Replaces the legacy jquery.Scroller-1.0.min.js driven
 * .horizontal_scroller / .horizontal_date_scroller marquee with a plain
 * CSS animation (see mech2_effects.css), sizing the animation duration to
 * the actual rendered text width so the scroll speed stays consistent
 * regardless of content length. Speed is configurable per ticker via the
 * data-ticker-speed attribute (pixels per second).
 */
(function () {
    'use strict';

    function initTicker(ticker) {
        var track = ticker.querySelector('.mech2-ticker-track');
        if (!track) {
            return;
        }

        var speed = parseFloat(ticker.getAttribute('data-ticker-speed')) || 60;

        function setDuration() {
            var width = track.scrollWidth;
            var duration = Math.max(width / speed, 8);
            track.style.setProperty('--mech2-ticker-duration', duration + 's');
        }

        setDuration();
        window.addEventListener('resize', setDuration);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var tickers = document.querySelectorAll('.mech2-ticker');
        for (var i = 0; i < tickers.length; i++) {
            initTicker(tickers[i]);
        }
    });
})();
