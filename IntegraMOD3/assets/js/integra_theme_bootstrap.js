(function() {
    function readCookie(name) {
        var nameEQ = name + '=';
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }

    var color = readCookie('style_color') === 'orange' ? 'orange' : 'blue';
    var mode = readCookie('style_mode') === 'dark' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-style-color', color);
    document.documentElement.setAttribute('data-bs-theme', mode);
})();
