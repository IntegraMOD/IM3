/**
*
* @package mChat JavaScript Code mini
* @version 1.4.4 of 2013-11-03
* @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
* @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

var $j = jQuery.noConflict();
$j(function() {
    if (!mChatArchiveMode) {
        var scrH = $j('#mChatmain')[0].scrollHeight;
        $j('#mChatmain').animate({
            scrollTop: scrH
        }, 1000, 'swing');
        if (mChatPause) {
            $j('#mChatMessage').bind('keypress', function() {
                clearInterval(interval);
                $j('#mChatLoadIMG,#mChatOkIMG,#mChatErrorIMG').hide();
                $j('#mChatRefreshText').html(mChatRefreshNo).addClass('mchat-alert');
                $j('#mChatPauseIMG').show()
            })
        }
        $j.fn.autoGrowInput = function(o) {
            var width = $j('.mChatPanel').width();
            o = $j.extend({
                maxWidth: width - 20,
                minWidth: 0,
                comfortZone: 20
            }, o);
            this.filter('input:text').each(function() {
                var minWidth = o.minWidth || $j(this).width(),
                    val = '',
                    input = $j(this),
                    testSubject = $j('<div/>').css({
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
                            return
                        }
                        var escaped = val.replace(/&/g, '&amp;').replace(/\s/g, ' ').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        testSubject.html(escaped);
                        var testerWidth = testSubject.width(),
                            newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
                            currentWidth = input.width(),
                            isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth) || (newWidth > minWidth && newWidth < o.maxWidth);
                        if (isValidWidthChange) {
                            input.width(newWidth)
                        }
                    };
                testSubject.insertAfter(input);
                $j(this).bind('keypress blur change submit focus', check)
            });
            return this
        };
        $j('input.mChatText').autoGrowInput();
        if (mChatSound && $j.cookie('mChatNoSound') != 'yes') {
            $j.cookie('mChatNoSound', null);
            $j('#mChatUseSound').attr('checked', 'checked')
        } else {
            $j.cookie('mChatNoSound', 'yes');
            $j('#mChatUseSound').removeAttr('checked')
        }
        if ($j('#mChatUserList').length && ($j.cookie('mChatShowUserList') == 'yes' || mChatCustomPage)) {
            $j('#mChatUserList').show()
        }
    }
    $j.browser = {};
    $j.browser.msie = false;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./) || navigator.userAgent.match(/Trident\/7.0; rv 11.0/)) {
        $j.browser.msie = true;
    }
});
var mChat = {
    countDown: function() {
        if ($j('#mChatSessMess').hasClass('mchat-alert')) {
            $j('#mChatSessMess').removeClass('mchat-alert')
        }
        session_time = session_time - 1;
        var sec = Math.floor(session_time);
        var min = Math.floor(sec / 60);
        var hrs = Math.floor(min / 60);
        sec = (sec % 60);
        if (sec <= 9) {
            sec = "0" + sec
        }
        min = (min % 60);
        if (min <= 9) {
            min = "0" + min
        }
        hrs = (hrs % 60);
        if (hrs <= 9) {
            hrs = "0" + hrs
        }
        var time_left = hrs + ":" + min + ":" + sec;
        $j('#mChatSessMess').html(mChatSessEnds + ' ' + time_left);
        if (session_time <= 0) {
            clearInterval(counter);
            $j('#mChatSessMess').html(mChatSessOut).addClass('mchat-alert')
        }
    },
    clear: function() {
        if ($j('#mChatMessage').val() == '') {
            return false
        }
        var answer = confirm(mChatReset);
        if (answer) {
            if ($j('#mChatRefreshText').hasClass('mchat-alert')) {
                $j('#mChatRefreshText').removeClass('mchat-alert')
            }
            if (mChatPause) {
                interval = setInterval(function() {
                    mChat.refresh()
                }, mChatRefresh)
            }
            $j('#mChatOkIMG').show();
            $j('#mChatLoadIMG, #mChatErrorIMG, #mChatPauseIMG').hide();
            $j('#mChatRefreshText').html(mChatRefreshYes);
            $j('#mChatMessage').val('').focus()
        } else {
            $j('#mChatMessage').focus()
        }
    },
    sound: function(file) {
        if ($j.cookie('mChatNoSound') == 'yes') {
            return
        }
        if ($j.browser.msie) {
            $j('#mChatSound').html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" height="0" width="0" type="application/x-shockwave-flash"><param name="movie" value="' + file + '"></object>')
        } else {
            $j('#mChatSound').html('<embed src="' + file + '" width="0" height="0" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>')
        }
    },
    toggle: function(id) {
        $j('#mChat' + id).slideToggle('normal', function() {
            if ($j('#mChat' + id).is(':visible')) {
                $j.cookie('mChatShow' + id, 'yes')
            }
            if ($j('#mChat' + id).is(':hidden')) {
                $j.cookie('mChatShow' + id, null)
            }
        })
    },
    add: function() {
        if ($j('#mChatMessage').val() == '') {
            return false
        }
        var mChatMessChars = $j('#mChatMessage').val().replace(/ /g, '');
        if (mChatMessChars.length > mChatMssgLngth && mChatMssgLngth) {
            alert(mChatMssgLngthLong);
            return
        }
        $j.ajax({
            url: mChatFile,
            timeout: 10000,
            type: 'POST',
            data: $j('#postform').serialize(),
            async: false,
            dataType: 'text',
            beforeSend: function() {
                $j('#submit_button').attr('disabled', 'disabled');
                if (mChatUserTimeout) {
                    clearInterval(activeinterval);
                    clearInterval(counter)
                }
                clearInterval(interval)
            },
            success: function() {
                mChat.refresh()
            },
            error: function(XMLHttpRequest) {
                if (XMLHttpRequest.status == 400) {
                    alert(mChatFlood)
                } else if (XMLHttpRequest.status == 403) {
                    alert(mChatNoAccess)
                } else if (XMLHttpRequest.status == 501) {
                    alert(mChatNoMessageInput)
                }
            },
            complete: function() {
                if ($j('#mChatData').children('#mChatNoMessage :last')) {
                    $j('#mChatNoMessage').remove()
                }
                $j('#submit_button').removeAttr('disabled');
                interval = setInterval(function() {
                    mChat.refresh()
                }, mChatRefresh);
                if (mChatUserTimeout) {
                    session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
                    counter = setInterval(function() {
                        mChat.countDown()
                    }, 1000);
                    activeinterval = setInterval(function() {
                        mChat.active()
                    }, mChatUserTimeout)
                }
                $j('#mChatMessage').val('').focus()
            }
        })
    },
    edit: function(id) {
        var message = $j('#edit' + id).val();
        var data = prompt(mChatEditInfo, message);
        if (data) {
            $j.ajax({
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
                        $j('#mChatSessTimer').html(mChatRefreshing)
                    }
                },
                success: function(html) {
                    $j('#mess' + id).fadeOut('slow', function() {
                        $j(this).replaceWith(html);
                        $j('#mess' + id).css('display', 'none').fadeIn('slow')
                    })
                },
                error: function(XMLHttpRequest) {
                    if (XMLHttpRequest.status == 403) {
                        alert(mChatNoAccess)
                    } else if (XMLHttpRequest.status == 501) {
                        alert(mChatNoMessageInput)
                    }
                },
                complete: function() {
                    interval = setInterval(function() {
                        mChat.refresh()
                    }, mChatRefresh);
                    if (mChatUserTimeout) {
                        session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
                        counter = setInterval(function() {
                            mChat.countDown()
                        }, 1000);
                        activeinterval = setInterval(function() {
                            mChat.active()
                        }, mChatUserTimeout)
                    }
                    if (!mChatArchiveMode) {
                        scrH = $j('#mChatmain')[0].scrollHeight;
                        window.setTimeout(function() {
                            $j('#mChatmain').animate({
                                scrollTop: scrH
                            }, 1000, 'swing')
                        }, 1500)
                    }
                }
            })
        }
    },
    del: function(id) {
        if (confirm(mChatDelConfirm)) {
            $j.ajax({
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
                        $j('#mChatSessTimer').html(mChatRefreshing)
                    }
                },
                success: function() {
                    $j('#mess' + id).fadeOut('slow', function() {
                        $j(this).remove()
                    });
                    mChat.sound(mChatForumRoot + 'mchat/del.swf')
                },
                error: function() {
                    alert(mChatNoAccess)
                },
                complete: function() {
                    interval = setInterval(function() {
                        mChat.refresh()
                    }, mChatRefresh);
                    if (mChatUserTimeout) {
                        session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
                        counter = setInterval(function() {
                            mChat.countDown()
                        }, 1000);
                        activeinterval = setInterval(function() {
                            mChat.active()
                        }, mChatUserTimeout)
                    }
                }
            })
        }
    },
    refresh: function() {
        if (mChatArchiveMode) {
            return
        }
        var mess_id = 0;
        if ($j('#mChatData').children().not('#mChatNoMessage').length) {
            if ($j('#mChatNoMessage')) {
                $j('#mChatNoMessage').remove()
            }
            mess_id = $j('#mChatData').children(':last-child').attr('id').replace('mess', '')
        }
        var oldScrH = $j('#mChatmain')[0].scrollHeight;
        $j.ajax({
            url: mChatFile,
            timeout: 10000,
            type: 'POST',
            data: {
                mode: 'read',
                message_last_id: mess_id
            },
            dataType: 'html',
            beforeSend: function() {
                $j('#mChatOkIMG,#mChatErrorIMG,#mChatPauseIMG').hide();
                $j('#mChatLoadIMG').show()
            },
            success: function(html) {
                if (html != '' && html != 0) {
                    if ($j('#mChatRefreshText').hasClass('mchat-alert')) {
                        $j('#mChatRefreshText').removeClass('mchat-alert')
                    }
                    $j('#mChatData').append(html).children(':last').not('#mChatNoMessage');
                    var newInner = $j('#mChatData').children().not('#mChatNoMessage').innerHeight();
                    var newH = oldScrH + newInner;
                    $j('#mChatmain').animate({
                        scrollTop: newH
                    }, 'slow');
                    mChat.sound(mChatForumRoot + 'mchat/add.swf')
                }
                setTimeout(function() {
                    $j('#mChatLoadIMG,#mChatErrorIMG,#mChatPauseIMG').hide();
                    $j('#mChatOkIMG').show();
                    $j('#mChatRefreshText').html(mChatRefreshYes)
                }, 500)
            },
            error: function() {
                $j('#mChatLoadIMG,#mChatOkIMG,#mChatPauseIMG,#mChatRefreshTextNo,#mChatPauseIMG,').hide();
                $j('#mChatErrorIMG').show();
                mChat.sound(mChatForumRoot + 'mchat/error.swf')
            },
            complete: function() {
                if (!$j('#mChatData').children(':last').length) {
                    $j('#mChatData').append('<div id="mChatNoMessage">' + mChatNoMessage + '</div>').show('slow')
                }
            }
        })
    },
    stats: function() {
        if (!mChatWhois) {
            return
        }
        $j.ajax({
            url: mChatFile,
            timeout: 10000,
            type: 'POST',
            data: {
                mode: 'stats'
            },
            dataType: 'html',
            beforeSend: function() {
                if (mChatCustomPage) {
                    $j('#mChatRefreshN').show();
                    $j('#mChatRefresh').hide()
                }
            },
            success: function(stats) {
                $j('#mChatStats').replaceWith(stats);
                if (mChatCustomPage) {
                    setTimeout(function() {
                        $j('#mChatRefreshN').hide();
                        $j('#mChatRefresh').show()
                    }, 500)
                }
            },
            error: function() {
                mChat.sound(mChatForumRoot + 'mchat/error.swf')
            },
            complete: function() {
                if ($j('#mChatUserList').length && ($j.cookie('mChatShowUserList') == 'yes' || mChatCustomPage)) {
                    $j('#mChatUserList').css('display', 'block')
                }
            }
        })
    },
    active: function() {
        if (mChatArchiveMode || !mChatUserTimeout) {
            return
        }
        clearInterval(interval);
        $j('#mChatLoadIMG,#mChatOkIMG,#mChatErrorIMG').hide();
        $j('#mChatPauseIMG').show();
        $j('#mChatRefreshText').html(mChatRefreshNo).addClass('mchat-alert');
        $j('#mChatSessMess').html(mChatSessOut).addClass('mchat-alert')
    }
};
var interval = setInterval(function() {
    mChat.refresh()
}, mChatRefresh);
var statsinterval = setInterval(function() {
    mChat.stats()
}, mChatWhoisRefresh);
var activeinterval = setInterval(function() {
    mChat.active()
}, mChatUserTimeout);
var session_time = mChatUserTimeout ? mChatUserTimeout / 1000 : false;
if (mChatUserTimeout) {
    var counter = setInterval(function() {
        mChat.countDown()
    }, 1000)
}
if ($j.cookie('mChatShowSmiles') == 'yes' && $j('#mChatSmiles').css('display', 'none')) {
    $j('#mChatSmiles').slideToggle('slow')
}
if ($j.cookie('mChatShowBBCodes') == 'yes' && $j('#mChatBBCodes').css('display', 'none')) {
    $j('#mChatBBCodes').slideToggle('slow')
}
if ($j.cookie('mChatShowUserList') == 'yes' && $j('#mChatUserList').length) {
    $j('#mChatUserList').slideToggle('slow')
}
if ($j.cookie('mChatShowColour') == 'yes' && $j('#mChatColour').css('display', 'none')) {
    $j('#mChatColour').slideToggle('slow')
}
$j('#mChatUseSound').change(function() {
    if ($j(this).is(':checked')) {
        $j.cookie('mChatNoSound', null)
    } else {
        $j.cookie('mChatNoSound', 'yes')
    }
});