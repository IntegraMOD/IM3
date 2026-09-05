function usesThemeSelectorMode() {
  return !!document.querySelector('.theme-choice');
}

function setThemeColor(color) {
  var selectedColor = color === 'orange' ? 'orange' : 'blue';
  document.documentElement.setAttribute('data-style-color', selectedColor);

  if (document.body) {
    document.body.setAttribute('data-style-color', selectedColor);
  }
}

function applyIntegraTheme(color, mode) {
  setThemeColor(color);
  setThemeMode(mode);
}

function setActiveStyleSheet(title) {
  if (usesThemeSelectorMode()) {
    setThemeMode(title);
    return;
  }

  var i, a, main;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
      a.disabled = true;
      if(a.getAttribute("title") == title) a.disabled = false;
    }
  }

  setThemeMode(title);
}

function setThemeMode(title) {
  var theme = title === 'dark' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-bs-theme', theme);

  if (document.body) {
    document.body.setAttribute('data-bs-theme', theme);
  }

  var toggle = document.getElementById('style-mode-toggle');
  if (toggle) {
    var isDark = theme === 'dark';
    toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
    toggle.setAttribute('title', isDark ? 'Switch to light mode' : 'Switch to dark mode');
    toggle.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
    toggle.innerHTML = isDark ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
  }
}

function syncStyleSelector(title) {
  var themeChoices = document.querySelectorAll('.theme-choice');
  if (!themeChoices.length) {
    return;
  }

  var activeMode = document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light';
  themeChoices.forEach(function(choice) {
    var isActive = choice.getAttribute('data-style-color') === title && choice.getAttribute('data-theme-mode') === activeMode;
    choice.classList.toggle('is-active', isActive);
    choice.setAttribute('aria-pressed', isActive ? 'true' : 'false');
  });
}

function getIntegraThemeMode() {
  var storedMode = readCookie('style_mode');
  return storedMode === 'dark' ? 'dark' : 'light';
}

function getIntegraThemeColor() {
  var storedColor = readCookie('style_color');
  return storedColor === 'orange' ? 'orange' : 'blue';
}

function getCurrentIntegraThemeColor() {
  var currentColor = document.documentElement.getAttribute('data-style-color');
  return currentColor === 'orange' ? 'orange' : 'blue';
}

function getActiveStyleSheet() {
  var i, a;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title") && !a.disabled) return a.getAttribute("title");
  }
  return null;
}

function getPreferredStyleSheet() {
  if (usesThemeSelectorMode()) {
    return 'light';
  }

  var i, a;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1
       && a.getAttribute("rel").indexOf("alt") == -1
       && a.getAttribute("title")
       && a.getAttribute("media") !== 'print'
       && a.getAttribute("title") !== 'printonly'
       ) return a.getAttribute("title");
  }
  return null;
}

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function initializeStyleSwitcher() {
  if (usesThemeSelectorMode()) {
    var color = getIntegraThemeColor();
    var mode = getIntegraThemeMode();

    applyIntegraTheme(color, mode);
    syncStyleSelector(color);

    var themeChoices = document.querySelectorAll('.theme-choice');
    themeChoices.forEach(function(choice) {
      if (!choice.hasAttribute('data-style-switcher-bound')) {
        choice.setAttribute('data-style-switcher-bound', 'true');
        choice.addEventListener('click', function(e) {
          e.preventDefault();
          var selectedColor = this.getAttribute('data-style-color') === 'orange' ? 'orange' : 'blue';
          var selectedMode = this.getAttribute('data-theme-mode') === 'dark' ? 'dark' : 'light';
          applyIntegraTheme(selectedColor, selectedMode);
          createCookie('style_color', selectedColor, 365);
          createCookie('style_mode', selectedMode, 365);
          syncStyleSelector(selectedColor);
        });
      }
    });

    return;
  }

  var cookie = readCookie("style");
  var title = cookie ? cookie : (getPreferredStyleSheet() || 'light');
  setActiveStyleSheet(title);
  syncStyleSelector(title);

  var selector = document.getElementById('style-color-selector');
  if (selector && !selector.hasAttribute('data-style-switcher-bound')) {
    selector.setAttribute('data-style-switcher-bound', 'true');
    selector.addEventListener('change', function() {
      setActiveStyleSheet(this.value);
      createCookie("style", this.value, 365);
      syncStyleSelector(this.value);
    });
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeStyleSwitcher);
} else {
  initializeStyleSwitcher();
}
