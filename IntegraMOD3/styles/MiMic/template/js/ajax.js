/* global phpbb */
 
(function($, window, document) {  // Avoid conflicts with other libraries
'use strict';
 
// Wrap all the code in a self-executing function to avoid polluting the global namespace
var phpbbAjax = (function() {
    // Private functions and variables go here
 
    // This callback will mark all forum icons read
    function markForumsRead(res) {
        var readTitle = res.NO_UNREAD_POSTS;
        var unreadTitle = res.UNREAD_POSTS;
        var iconsArray = {
            forum_unread: 'forum_read',
            forum_unread_subforum: 'forum_read_subforum',
            forum_unread_locked: 'forum_read_locked'
        };
 
        $('li.row').find('dl[class*="forum_unread"]').each(function() {
            var $this = $(this);
 
            $.each(iconsArray, function(unreadClass, readClass) {
                if ($this.hasClass(unreadClass)) {
                    $this.removeClass(unreadClass).addClass(readClass);
                }
            });
            $this.children('dt[title="' + unreadTitle + '"]').attr('title', readTitle);
        });
 
        // Mark subforums read
        $('a.subforum[class*="unread"]').removeClass('unread').addClass('read').children('.icon.icon-red').removeClass('icon-red').addClass('icon-blue');
 
        // Mark topics read if we are watching a category and showing active topics
        if ($('#active_topics').length) {
            markTopicsRead.call(this, res, false);
        }
 
        // Update mark forums read links
        $('[data-ajax="mark_forums_read"]').attr('href', res.U_MARK_FORUMS);
 
        phpbb.closeDarkenWrapper(3000);
    }
 
    /**
    * This callback will mark all topic icons read
    *
    * @param {Object} res - The response object
    * @param {boolean} [updateTopicLinks=true] Whether "Mark topics read" links
    *     should be updated. Defaults to true.
    */
    function markTopicsRead(res, updateTopicLinks) {
        var readTitle = res.NO_UNREAD_POSTS;
        var unreadTitle = res.UNREAD_POSTS;
        var iconsArray = {
            global_unread: 'global_read',
            announce_unread: 'announce_read',
            sticky_unread: 'sticky_read',
            topic_unread: 'topic_read'
        };
        var iconsState = ['', '_hot', '_hot_mine', '_locked', '_locked_mine', '_mine'];
        var unreadClassSelectors;
        var classMap = {};
        var classNames = [];
 
        if (typeof updateTopicLinks === 'undefined') {
            updateTopicLinks = true;
        }
 
        $.each(iconsArray, function(unreadClass, readClass) {
            $.each(iconsState, function(key, value) {
                // Only topics can be hot
                if ((value === '_hot' || value === '_hot_mine') && unreadClass !== 'topic_unread') {
                    return true;
                }
                classMap[unreadClass + value] = readClass + value;
                classNames.push(unreadClass + value);
            });
        });
 
        unreadClassSelectors = '.' + classNames.join(',.');
 
        $('li.row').find(unreadClassSelectors).each(function() {
            var $this = $(this);
            $.each(classMap, function(unreadClass, readClass) {
                if ($this.hasClass(unreadClass)) {
                    $this.removeClass(unreadClass).addClass(readClass);
                }
            });
            $this.children('dt[title="' + unreadTitle + '"]').attr('title', readTitle);
        });
 
        // Remove link to first unread post
        $('a.unread').has('.icon-red').remove();
 
        // Update mark topics read links
        if (updateTopicLinks) {
            $('[data-ajax="mark_topics_read"]').attr('href', res.U_MARK_TOPICS);
        }
 
        phpbb.closeDarkenWrapper(3000);
    }
 
    // More private functions...
 
    // Public API
    return {
        markForumsRead: markForumsRead,
        markTopicsRead: markTopicsRead,
        // Add other public functions here...
    };
})();
 
// Add the callbacks to phpbb.ajaxCallbacks
phpbb.addAjaxCallback('mark_forums_read', phpbbAjax.markForumsRead);
phpbb.addAjaxCallback('mark_topics_read', phpbbAjax.markTopicsRead);
 
// Add other callbacks...
 
// DOM-ready handler
$(function() {
    // Move the code from the bottom of the original script here
    $('[data-ajax]').each(function() {
        var $this = $(this);
        var ajax = $this.attr('data-ajax');
        var filter = $this.attr('data-filter');
 
        if (ajax !== 'false') {
            var fn = (ajax !== 'true') ? ajax : null;
            filter = (filter !== undefined) ? phpbb.getFunctionByName(filter) : null;
 
            phpbb.ajaxify({
                selector: this,
                refresh: $this.attr('data-refresh') !== undefined,
                filter: filter,
                callback: fn
            });
        }
    });
 
    // Other DOM-ready code...
});
 
})(jQuery, window, document);