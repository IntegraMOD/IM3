/**
 *
 * @package mChat JavaScript Code mini
 * @version 1.4.4 of 2013-11-03
 * @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
 * @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 **/
 
var $jQ = jQuery.noConflict(true);
 
$jQ(function() {
    if (!mChatArchiveMode) {
        var scrH = $jQ('#mChatmain')[0].scrollHeight;
        $jQ('#mChatmain').animate({
            scrollTop: scrH
        }, 1000, 'swing');
 
        if (mChatPause) {
            $jQ('#mChatMessage').bind('keypress', function() {
                clearInterval(interval);
                $jQ('#mChatLoadIMG,#mChatOkIMG,#mChatErrorIMG').hide();
                $jQ('#mChatRefreshText').html(mChatRefreshNo).addClass('mchat-alert');
                $jQ('#mChatPauseIMG').show();
            });
        }
 
        $jQ.fn.autoGrowInput = function(o) {
            var width = $jQ('.mChatPanel').width();
            o = $jQ.extend({
                maxWidth: width - 20,
                minWidth: 0,
                comfortZone: 20
            }, o);
 
            this.filter('input:text').each(function() {
                var minWidth = o.minWidth || $jQ(this).width(),
                    val = '',
                    input = $jQ(this),
                    testSubject = $jQ('<div/>').css({
                        position: 'absolute',
                        top: -9999,
                        left: -9999,
                        width: 'auto',
                        fontSize: input.css('fontSize'),
                        fontFamily: input.css('fontFamily'),
                        fontWeight: input.css('fontWeight'),
                        letterSpacing: input.css('letterSpacing'),
                        whiteSpace: 'nowrap'
                    }),
                    check = function() {
                        if (val === (val = input.val())) {
                            return;
                        }
                        var escaped = val.replace(/&/g, '&amp;').replace(/\s/g, ' ').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        testSubject.html(escaped);
                        var testerWidth = testSubject.width(),
                            newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
                            currentWidth = input.width(),
                            isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth) || (newWidth > minWidth && newWidth < o.maxWidth);
                        if (isValidWidthChange) {
                            input.width(newWidth);
                        }
                    };
 
                testSubject.insertAfter(input);
                $jQ(this).bind('keypress blur change submit focus', check);
            });
            return this;
        };
 
        $jQ('input.mChatText').autoGrowInput();
 
        if (mChatSound && $jQ.cookie('mChatNoSound') != 'yes') {
            $jQ.cookie('mChatNoSound', null);
            $jQ('#mChatUseSound').attr('checked', 'checked');
        } else {
            $jQ.cookie('mChatNoSound', 'yes');
            $jQ('#mChatUseSound').removeAttr('checked');
        }
 
        if ($jQ('#mChatUserList').length && ($jQ.cookie('mChatShowUserList') == 'yes' || mChatCustomPage)) {
            $jQ('#mChatUserList').show();
        }
    }
 
    $jQ.browser = {};
    $jQ.browser.msie = false;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./) || navigator.userAgent.match(/Trident\/7.0; rv 11.0/)) {
        $jQ.browser.msie = true;
    }
});
 
var mChat = {
    countDown: function() {
        if ($jQ('#mChatSessMess').hasClass('mchat-alert')) {
            $jQ('#mChatSessMess').removeClass('mchat-alert');
        }
        session_time = session_time - 1;
        var sec = Math.floor(session_time);
        var min = Math.floor(sec / 60);
        var hrs = Math.floor(min / 60);
        sec = (sec % 60);
        if (sec <= 9) {
            sec = "0" + sec;
        }
        min = (min % 60);
        if (min <= 9) {
            min = "0" + min;
        }
        hrs = (hrs % 60);
        if (hrs <= 9) {
            hrs = "0" + hrs;
        }
        var time_left = hrs + ":" + min + ":" + sec;
        $jQ('#mChatSessMess').html(mChatSessEnds + ' ' + time_left);
        if (session_time <= 0) {
            clearInterval(counter);
            $jQ('#mChatSessMess').html(mChatSessOut).addClass('mchat-alert');
        }
    },
 
    clear: function() {
        if ($jQ('#mChatMessage').val() == '') {
            return false;
        }
        var answer = confirm(mChatReset);
        if (answer) {
            if ($jQ('#mChatRefreshText').hasClass('mchat-alert')) {
                $jQ('#mChatRefreshText').removeClass('mchat-alert');
            }
            if (mChatPause) {
                interval = setInterval(function() {
                    mChat.refresh();
                }, mChatRefresh);
            }
            $jQ('#mChatOkIMG').show();
            $jQ('#mChatLoadIMG, #mChatErrorIMG, #mChatPauseIMG').hide();
            $jQ('#mChatRefreshText').html(mChatRefreshYes);
            $jQ('#mChatMessage').val('').focus();
        } else {
            $jQ('#mChatMessage').focus();
        }
    },
 
    sound: function(file) {
        if ($jQ.cookie('mChatNoSound') == 'yes') {
            return;
        }
        if ($jQ.browser.msie) {
            $jQ('#mChatSound').html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" height="0" width="0" type="application/x-shockwave-flash"><param name="movie" value="' + file + '"></object>');
        } else {
            $jQ('#mChatSound').html('<embed src="' + file + '" width="0" height="0" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>');
        }
    },
 
    toggle: function(id) {
        $jQ('#mChat' + id).slideToggle('normal', function() {
            if ($jQ('#mChat' + id).is(':visible')) {
                $jQ.cookie('mChatShow' + id, 'yes');
            }
            if ($jQ('#mChat' + id).is(':hidden')) {
                $jQ.cookie('mChatShow' + id, null);
            }
        });
    },
 
    add: function() {
        if ($jQ('#mChatMessage').val() == '') {
            return false;
        }
        var mChatMessChars = $jQ('#mChatMessage').val().replace(/ /g, '');
        if (mChatMessChars.length > mChatMssgLngth && mChatMssgLngth) {
            alert(mChatMssgLngthLong);
            return;
        }
        $jQ.ajax({
            url: mChatFile,
            timeout: 10000,
            type: 'POST',
            data: $jQ('#postform').serialize(),
            async: false,
            dataType: 'text',
            beforeSend: function() {
                $jQ('#submit_button').attr('disabled', 'disabled');
                if (mChatUserTimeout) {
                    clearInterval(activeinterval);
                    clearInterval(counter);
                }
                clearInterval(interval);
            },
            success: function() {
                mChat.refresh();
            },
            error: function(XMLHttpRequest) {
                if (XMLHttpRequest.status == 400) {
                    alert(mChatFlood);
                } else if (XMLHttpRequest.status == 403) {
                    alert(mChatNoAccess);
                } else if (XMLHttpRequest.status == 501) {
                    alert(mChatNoMessageInput);
                }
            },
            complete: function() {
                if ($jQ('#mChatData').children('#mChatNoMessage :last')) {
                    $jQ('#mChatNoMessage').remove();
                }
                $jQ('#submit_button').removeAttr('disabled');
                interval = setInterval(function() {
                    mChat.refresh();
                }, mChatRefresh);
                if (mChatUserTimeout) {
                    session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
                    counter = setInterval(function() {
                        mChat.countDown();
                    }, 1000);
                    activeinterval = setInterval(function() {
                        mChat.active();
                    }, mChatUserTimeout);
                }
                $jQ('#mChatMessage').val('').focus();
            }
        });
    },
 
    edit: function(id) {
        var message = $jQ('#edit' + id).val();
        var data = prompt(mChatEditInfo, message);
        if (data) {
            $jQ.ajax({
                url: mChatFile,
                timeout: 10000,
                type: 'POST',
                data: {
                    mode: 'edit',
                    message_id: id,
                    message: data
                },
                dataType: 'text',
                beforeSend: function() {
                    clearInterval(interval);
                    if (mChatUserTimeout) {
                        clearInterval(activeinterval);
                        clearInterval(counter);
                        $jQ('#mChatSessTimer').html(mChatRefreshing);
                    }
                },
                success: function(html) {
                    $jQ('#mess' + id).fadeOut('slow', function() {
                        $jQ(this).replaceWith(html);
                        $jQ('#mess' + id).css('display', 'none').fadeIn('slow');
                    });
                },
                error: function(XMLHttpRequest) {
                    if (XMLHttpRequest.status == 403) {
                        alert(mChatNoAccess);
                    } else if (XMLHttpRequest.status == 501) {
                        alert(mChatNoMessageInput);
                    }
                },
                complete: function() {
                    interval = setInterval(function() {
                        mChat.refresh();
                    }, mChatRefresh);
                    if (mChatUserTimeout) {
                        session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
                        counter = setInterval(function() {
                            mChat.countDown();
                        }, 1000);
                        activeinterval = setInterval(function() {
                            mChat.active();
                        }, mChatUserTimeout);
                    }
                    if (!mChatArchiveMode) {
                        scrH = $jQ('#mChatmain')[0].scrollHeight;
                        window.setTimeout(function() {
                            $jQ('#mChatmain').animate({
                                scrollTop: scrH
                            }, 1000, 'swing');
                        }, 1500);
                    }
                }
            });
        }
    },
 
    del: function(id) {
        if (confirm(mChatDelConfirm)) {
            $jQ.ajax({
                url: mChatFile,
                timeout: 10000,
                type: 'POST',
                data: {
                    mode: 'delete',
                    message_id: id
                },
                beforeSend: function() {
                    clearInterval(interval);
                    if (mChatUserTimeout) {
                        clearInterval(activeinterval);
                        clearInterval(counter);
                        $jQ('#mChatSessTimer').html(mChatRefreshing);
                    }
                },
                success: function() {
                    $jQ('#mess' + id).fadeOut('slow', function() {
                        $jQ(this).remove();
                    });
                    mChat.sound(mChatForumRoot + 'mchat/del.swf');
                },
                error: function() {
                    alert(mChatNoAccess);
                },
                complete: function() {
                    interval = setInterval(function() {
                        mChat.refresh();
                    }, mChatRefresh);
                    if (mChatUserTimeout) {
                        session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
                        counter = setInterval(function() {
                            mChat.countDown();
                        }, 1000);
                        activeinterval = setInterval(function() {
                            mChat.active();
                        }, mChatUserTimeout);
                    }
                }
            });
        }
    },
 
    refresh: function() {
        if (mChatArchiveMode) {
            return;
        }
        var mess_id = 0;
        if ($jQ('#mChatData').children().not('#mChatNoMessage').length) {
            if ($jQ('#mChatNoMessage')) {
                $jQ('#mChatNoMessage').remove();
            }
            mess_id = $jQ('#mChatData').children(':last-child').attr('id').replace('mess', '');
        }
        var oldScrH = $jQ('#mChatmain')[0].scrollHeight;
        $jQ.ajax({
            url: mChatFile,
            timeout: 10000,
            type: 'POST',
            data: {
                mode: 'read',
                message_last_id: mess_id
            },
            dataType: 'html',
            beforeSend: function() {
                $jQ('#mChatOkIMG,#mChatErrorIMG,#mChatPauseIMG').hide();
                $jQ('#mChatLoadIMG').show();
            },
            success: function(html) {
                if (html != '' && html != 0) {
                    if ($jQ('#mChatRefreshText').hasClass('mchat-alert')) {
                        $jQ('#mChatRefreshText').removeClass('mchat-alert');
                    }
                    $jQ('#mChatData').append(html).children(':last').not('#mChatNoMessage');
                    var newInner = $jQ('#mChatData').children().not('#mChatNoMessage').innerHeight();
                    var newH = oldScrH + newInner;
                    $jQ('#mChatmain').animate({
                        scrollTop: newH
                    }, 'slow');
                    mChat.sound(mChatForumRoot + 'mchat/add.swf');
                }
                setTimeout(function() {
                    $jQ('#mChatLoadIMG,#mChatErrorIMG,#mChatPauseIMG').hide();
                    $jQ('#mChatOkIMG').show();
                    $jQ('#mChatRefreshText').html(mChatRefreshYes);
                }, 500);
            },
            error: function() {
                $jQ('#mChatLoadIMG,#mChatOkIMG,#mChatPauseIMG,#mChatRefreshTextNo,#mChatPauseIMG,').hide();
                $jQ('#mChatErrorIMG').show();
                mChat.sound(mChatForumRoot + 'mchat/error.swf');
            },
            complete: function() {
                if (!$jQ('#mChatData').children(':last').length) {
                    $jQ('#mChatData').append('<div id="mChatNoMessage">' + mChatNoMessage + '</div>').show('slow');
                }
            }
        });
    },
 
    stats: function() {
        if (!mChatWhois) {
            return;
        }
        $jQ.ajax({
            url: mChatFile,
            timeout: 10000,
            type: 'POST',
            data: {
                mode: 'stats'
            },
            dataType: 'html',
            beforeSend: function() {
                if (mChatCustomPage) {
                    $jQ('#mChatRefreshN').show();
                    $jQ('#mChatRefresh').hide();
                }
            },
            success: function(stats) {
                $jQ('#mChatStats').replaceWith(stats);
                if (mChatCustomPage) {
                    setTimeout(function() {
                        $jQ('#mChatRefreshN').hide();
                        $jQ('#mChatRefresh').show();
                    }, 500);
                }
            },
            error: function() {
                mChat.sound(mChatForumRoot + 'mchat/error.swf');
            },
            complete: function() {
                if ($jQ('#mChatUserList').length && ($jQ.cookie('mChatShowUserList') == 'yes' || mChatCustomPage)) {
                    $jQ('#mChatUserList').css('display', 'block');
                }
            }
        });
    },
 
    active: function() {
        if (mChatArchiveMode || !mChatUserTimeout) {
            return;
        }
        clearInterval(interval);
        $jQ('#mChatLoadIMG,#mChatOkIMG,#mChatErrorIMG').hide();
        $jQ('#mChatPauseIMG').show();
        $jQ('#mChatRefreshText').html(mChatRefreshNo).addClass('mchat-alert');
        $jQ('#mChatSessMess').html(mChatSessOut).addClass('mchat-alert');
    }
};
 
var interval = setInterval(function() {
    mChat.refresh();
}, mChatRefresh);
 
var statsinterval = setInterval(function() {
    mChat.stats();
}, mChatWhoisRefresh);
 
var activeinterval = setInterval(function() {
    mChat.active();
}, mChatUserTimeout);
 
var session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
 
if (mChatUserTimeout) {
    var counter = setInterval(function() {
        mChat.countDown();
    }, 1000);
}
 
if ($jQ.cookie('mChatShowSmiles') == 'yes' && $jQ('#mChatSmiles').css('display', 'none')) {
    $jQ('#mChatSmiles').slideToggle('slow');
}
 
if ($jQ.cookie('mChatShowBBCodes') == 'yes' && $jQ('#mChatBBCodes').css('display', 'none')) {
    $jQ('#mChatBBCodes').slideToggle('slow');
}
 
if ($jQ.cookie('mChatShowUserList') == 'yes' && $jQ('#mChatUserList').length) {
    $jQ('#mChatUserList').slideToggle('slow');
}
 
if ($jQ.cookie('mChatShowColour') == 'yes' && $jQ('#mChatColour').css('display', 'none')) {
    $jQ('#mChatColour').slideToggle('slow');
}
 
$jQ('#mChatUseSound').change(function() {
    if ($jQ(this).is(':checked')) {
        $jQ.cookie('mChatNoSound', null);
    } else {
        $jQ.cookie('mChatNoSound', 'yes');
    }
});