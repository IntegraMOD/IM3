/**
 * minical.js
 * Calendar block wiring (index mini calendar and portal calendar block).
 */

(function() {
    const initializeMiniCalendar = () => {
        const calendarStateForm = document.getElementById('hidden');
        if (!calendarStateForm || typeof populateTable !== 'function') {
            return;
        }

        document.querySelectorAll('[data-calendar-action]').forEach(button => {
            button.addEventListener('click', function() {
                populateTable('block_calendar:populate_table', 'hidden', this.getAttribute('data-calendar-action') || '');
            });
        });

        populateTable('block_calendar:populate_table', 'hidden', '');
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeMiniCalendar);
    } else {
        initializeMiniCalendar();
    }
})();
