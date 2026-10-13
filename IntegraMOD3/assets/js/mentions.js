(function () {
    'use strict';

    var configNode = document.querySelector('[data-mention-search]');
    if (!configNode) {
        return;
    }

    var endpoint = configNode.getAttribute('data-mention-search');
    var fields = document.querySelectorAll('textarea[data-mention-field]');
    var activeField = null;
    var activeRange = null;
    var items = [];
    var selected = -1;
    var timer = 0;
    var requestSerial = 0;
    var list = document.createElement('ul');

    list.className = 'mention-list';
    list.setAttribute('role', 'listbox');
    list.hidden = true;
    document.body.appendChild(list);

    function hideList() {
        list.hidden = true;
        list.innerHTML = '';
        items = [];
        selected = -1;
        activeRange = null;
    }

    function mentionAtCaret(field) {
        var text = field.value.slice(0, field.selectionStart);
        var match = text.match(/(^|\s)@([^\s@\[\]]{1,32})$/);
        if (!match) {
            return null;
        }
        return {
            start: text.length - match[2].length - 1,
            end: field.selectionStart,
            query: match[2]
        };
    }

    function caretPosition(field, offset) {
        var mirror = document.createElement('div');
        var style = window.getComputedStyle(field);
        var properties = ['boxSizing', 'width', 'paddingTop', 'paddingRight', 'paddingBottom', 'paddingLeft', 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth', 'borderLeftWidth', 'fontStyle', 'fontVariant', 'fontWeight', 'fontSize', 'fontFamily', 'lineHeight', 'letterSpacing', 'textTransform', 'textIndent', 'whiteSpace', 'wordSpacing'];
        var marker = document.createElement('span');
        var i;

        mirror.className = 'mention-caret-mirror';
        for (i = 0; i < properties.length; i++) {
            mirror.style[properties[i]] = style[properties[i]];
        }
        mirror.textContent = field.value.slice(0, offset);
        marker.textContent = field.value.slice(offset, offset + 1) || '.';
        mirror.appendChild(marker);
        document.body.appendChild(mirror);

        var fieldRect = field.getBoundingClientRect();
        var position = {
            left: fieldRect.left + marker.offsetLeft - field.scrollLeft + window.pageXOffset,
            top: fieldRect.top + marker.offsetTop - field.scrollTop + window.pageYOffset + 20
        };
        document.body.removeChild(mirror);
        return position;
    }

    function choose(index) {
        if (!activeField || !activeRange || !items[index]) {
            return;
        }
        var value = activeField.value;
        var insert = '[mention]' + items[index] + '[/mention] ';
        activeField.value = value.slice(0, activeRange.start) + insert + value.slice(activeRange.end);
        var caret = activeRange.start + insert.length;
        activeField.focus();
        activeField.setSelectionRange(caret, caret);
        hideList();
    }

    function render(results, field, range) {
        var position;
        var i;
        var item;

        list.innerHTML = '';
        items = results;
        selected = results.length ? 0 : -1;
        if (!results.length) {
            hideList();
            return;
        }

        for (i = 0; i < results.length; i++) {
            item = document.createElement('li');
            item.textContent = '@' + results[i];
            item.setAttribute('role', 'option');
            item.setAttribute('data-mention-index', String(i));
            if (i === selected) {
                item.className = 'is-active';
            }
            list.appendChild(item);
        }

        position = caretPosition(field, range.end);
        list.style.left = Math.max(8, position.left) + 'px';
        list.style.top = position.top + 'px';
        list.hidden = false;
        activeField = field;
        activeRange = range;
    }

    function search(field) {
        var range = mentionAtCaret(field);
        var serial;

        if (!range) {
            hideList();
            return;
        }

        serial = ++requestSerial;
        fetch(endpoint + '&q=' + encodeURIComponent(range.query), {
            credentials: 'same-origin',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (response) {
            return response.json();
        }).then(function (results) {
            if (serial !== requestSerial) {
                return;
            }
            render(Array.isArray(results) ? results.slice(0, 5) : [], field, range);
        }).catch(function () {
            hideList();
        });
    }

    function onInput(event) {
        var field = event.currentTarget;
        window.clearTimeout(timer);
        timer = window.setTimeout(function () {
            search(field);
        }, 180);
    }

    function onKeyDown(event) {
        if (list.hidden) {
            return;
        }
        if (event.key === 'ArrowDown') {
            selected = Math.min(items.length - 1, selected + 1);
        } else if (event.key === 'ArrowUp') {
            selected = Math.max(0, selected - 1);
        } else if (event.key === 'Enter') {
            event.preventDefault();
            choose(selected);
            return;
        } else if (event.key === 'Escape') {
            hideList();
            return;
        } else {
            return;
        }
        event.preventDefault();
        Array.prototype.forEach.call(list.children, function (child, index) {
            child.className = index === selected ? 'is-active' : '';
        });
    }

    function bindField(field) {
        if (!field || field.getAttribute('data-mention-bound') === '1') {
            return;
        }
        field.setAttribute('data-mention-field', '1');
        field.setAttribute('data-mention-bound', '1');
        field.addEventListener('input', onInput);
        field.addEventListener('keyup', onInput);
        field.addEventListener('keydown', onKeyDown);
        field.addEventListener('blur', function () {
            window.setTimeout(hideList, 150);
        });
    }

    function bindFields() {
        Array.prototype.forEach.call(document.querySelectorAll('textarea[name="message"], textarea[data-mention-field]'), bindField);
    }

    bindFields();
    document.addEventListener('DOMContentLoaded', bindFields);
    window.addEventListener('load', bindFields);

    list.addEventListener('mousedown', function (event) {
        var item = event.target.closest ? event.target.closest('[data-mention-index]') : null;
        if (!item) {
            return;
        }
        event.preventDefault();
        choose(parseInt(item.getAttribute('data-mention-index'), 10));
    });

    window.addEventListener('resize', hideList);
}());
