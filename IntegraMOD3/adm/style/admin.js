/**
* phpBB3 ACP functions
*/

/**
* Parse document block
*/
function parse_document(container) 
{
	var test = document.createElement('div'),
		oldBrowser = (typeof test.style.borderRadius == 'undefined');

	delete test;

	/**
	* Navigation
	*/
	container.find('#menu').each(function() {
		var menu = $(this),
			blocks = menu.children('.menu-block');

		if (!blocks.length) {
			return;
		}

		// Set onclick event
		blocks.children('a.header').click(function() {
			var shell = document.getElementById('wrap');
			if (shell && shell.getAttribute('data-sidebar-state') === 'collapsed' && window.acpShell && typeof window.acpShell.toggleSidebar === 'function') {
				window.acpShell.toggleSidebar();
			}
			var parent = $(this).parent();
			if (!parent.hasClass('active')) {
				parent.siblings().removeClass('active');
			}
			parent.toggleClass('active');
		});

		// Set active menu
		menu.find('#activemenu').parents('.menu-block').addClass('active');

		// Check if there is active menu
		if (!blocks.filter('.active').length) {
			blocks.filter(':first').addClass('active');
		}
	});

	/**
	* Responsive tables
	*/
	container.find('table').not('.not-responsive').each(function() {
		var $this = $(this),
			th = $this.find('thead > tr > th'),
			columns = th.length,
			headers = [],
			totalHeaders = 0,
			i, headersLength;

		// Find columns
		$this.find('colgroup:first').children().each(function(i) {
			var column = $(this);
			$this.find('td:nth-child(' + (i + 1) + ')').addClass(column.prop('className'));
		});

		// Styles table
		if ($this.hasClass('styles')) {
			$this.find('td:first-child[style]').each(function() {
				var style = $(this).attr('style');
				if (style.length) {
					$(this).parent('tr').attr('style', style.toLowerCase().replace('padding', 'margin')).addClass('responsive-style-row');
				}
			});
		}

		// Find each header
		if (!$this.data('no-responsive-header'))
		{
			th.each(function(column) {
				var cell = $(this),
					colspan = parseInt(cell.attr('colspan')),
					dfn = cell.attr('data-dfn'),
					text = dfn ? dfn : $.trim(cell.text());

				if (text == '&nbsp;') text = '';
				colspan = isNaN(colspan) || colspan < 1 ? 1 : colspan;

				for (i=0; i<colspan; i++) {
					headers.push(text);
				}
				totalHeaders ++;

				if (dfn && !column) {
					$this.addClass('show-header');
				}
			});
		}
		
		headersLength = headers.length;

		// Add header text to each cell as <dfn>
		$this.addClass('responsive');

		if (totalHeaders < 2) {
			$this.addClass('show-header');
			return;
		}

		$this.find('tbody > tr').each(function() {
			var row = $(this),
				cells = row.children('td'),
				column = 0;

			if (cells.length == 1) {
				row.addClass('big-column');
				return;
			}

			cells.each(function() {
				var cell = $(this),
					colspan = parseInt(cell.attr('colspan')),
					text = $.trim(cell.text());

				if (headersLength <= column) {
					return;
				}

				if ((text.length && text !== '-') || cell.children().length) {
					if (headers[column] != '') {
						cell.prepend('<dfn style="display: none;">' + headers[column] + '</dfn>');
					}
				}
				else {
					cell.addClass('empty');
				}

				colspan = isNaN(colspan) || colspan < 1 ? 1 : colspan;
				column += colspan;
			});
		});

		// Remove <dfn> in disabled extensions list
		$this.find('tr.ext_disabled > .empty:nth-child(2) + .empty').siblings(':first-child').children('dfn').remove();
	});

	/**
	* Hide empty responsive tables
	*/
	container.find('table.responsive > tbody').each(function() {
		var items = $(this).children('tr');
		if (items.length == 0)
		{
			$(this).parent('table:first').addClass('responsive-hide');
		}
	});

	/**
	* Fieldsets with empty <span>
	*/
	container.find('fieldset dt > span:last-child').each(function() {
		var $this = $(this);
		if ($this.html() == '&nbsp;') {
			$this.addClass('responsive-hide');
		}
		
	});

	/**
	* Responsive tabs
	*/
	container.find('#tabs').not('[data-skip-responsive]').each(function() {
		var $this = $(this),
			$body = $('body'),
			ul = $this.children(),
			tabs = ul.children().not('[data-skip-responsive]'),
			links = tabs.children('a'),
			item = ul.append('<li class="tab responsive-tab" style="display:none;"><a href="javascript:void(0);" class="responsive-tab-link">&nbsp;</a><div class="dropdown tab-dropdown" style="display: none;"><div class="pointer"><div class="pointer-inner"></div></div><ul class="dropdown-contents" /></div></li>').find('li.responsive-tab'),
			menu = item.find('.dropdown-contents'),
			maxHeight = 0,
			lastWidth = false,
			responsive = false;

		links.each(function() {
			var link = $(this);
			maxHeight = Math.max(maxHeight, Math.max(link.outerHeight(true), link.parent().outerHeight(true)));
		})

		function check() {
			var width = $body.width(),
				height = $this.height();

			if (arguments.length == 0 && (!responsive || width <= lastWidth) && height <= maxHeight) {
				return;
			}

			tabs.show();
			item.hide();

			lastWidth = width;
			height = $this.height();
			if (height <= maxHeight) {
				responsive = false;
				if (item.hasClass('dropdown-visible')) {
					phpbb.toggleDropdown.call(item.find('a.responsive-tab-link').get(0));
				}
				return;
			}

			responsive = true;
			item.show();
			menu.html('');

			var availableTabs = tabs.filter(':not(.activetab, .responsive-tab)'),
				total = availableTabs.length,
				i, tab;

			for (i = total - 1; i >= 0; i --) {
				tab = availableTabs.eq(i);
				menu.prepend(tab.clone(true).removeClass('tab'));
				tab.hide();
				if ($this.height() <= maxHeight) {
					menu.find('a').click(function() { check(true); });
					return;
				}
			}
			menu.find('a').click(function() { check(true); });
		}

		phpbb.registerDropdown(item.find('a.responsive-tab-link'), item.find('.dropdown'), {visibleClass: 'activetab', verticalDirection: 'down'});

		check(true);
		$(window).resize(check);
	});
}

/**
* Run onload functions
*/
(function($) {
	$(document).ready(function() {
		// Swap .nojs and .hasjs
		$('body.nojs').toggleClass('nojs hasjs');

		// Focus forms
		$('form[data-focus]:first').each(function() {
			$('#' + this.getAttribute('data-focus')).focus();
		});

		parse_document($('body'));

		$('#questionnaire-form').css('display', 'none');
		var $triggerConfiglist = $('#trigger-configlist');

		$triggerConfiglist.on('click', function () {
			var $configlist = $('#configlist');
			$configlist.closest('.send-stats-data-row').toggleClass('send-stats-data-hidden');
			$configlist.closest('.send-stats-row').find('.send-stats-data-row:first-child').toggleClass('send-stats-data-only-row');
			$(this).find('i').toggleClass('fa-angle-down fa-angle-up');
		});

		$('#configlist').closest('.send-stats-data-row').addClass('send-stats-data-hidden');

		// Do not underline actions icons on hover (could not be done via CSS)
		$('.actions a:has(i.acp-icon)').mouseover(function () {
			$(this).css("text-decoration", "none");
		});

		initAcpShell();
	});
})(jQuery);

/**
* Dashboard shell: sidebar, mobile drawer, and layout options.
* Module pages are not involved; they still render inside #main.
*/
function initAcpShell()
{
	var shell = document.getElementById('wrap');
	if (!shell || !shell.classList || !shell.classList.contains('acp-shell') || shell.classList.contains('acp-shell-notice'))
	{
		return;
	}

	var cookieName = 'im3_acp_shell';
	var desktopWidth = 992;
	var saved = readAcpShellCookie(cookieName);
	var desktopMode = (saved.sidebar === 'collapsed') ? 'collapsed' : 'expanded';
	var mobileOpen = false;
	var prefs = {
		fixedSidebar: saved.fixedSidebar === '1' ? '1' : '0',
		fixedTop: saved.fixedTop === '0' ? '0' : '1',
		theme: saved.theme === 'dark' ? 'dark' : 'light'
	};

	function isNarrow()
	{
		return window.innerWidth < desktopWidth;
	}

	function visualState()
	{
		if (isNarrow())
		{
			return mobileOpen ? 'overlay' : 'closed';
		}
		return desktopMode;
	}

	function persist()
	{
		var value = 'sidebar=' + desktopMode + '&fixedSidebar=' + prefs.fixedSidebar + '&fixedTop=' + prefs.fixedTop + '&theme=' + prefs.theme;
		document.cookie = cookieName + '=' + encodeURIComponent(value) + '; path=/; max-age=31536000; samesite=lax';
	}

	function apply()
	{
		var state = visualState();
		shell.setAttribute('data-sidebar-state', state);
		shell.setAttribute('data-fixed-sidebar', prefs.fixedSidebar);
		shell.setAttribute('data-fixed-top', prefs.fixedTop);
		shell.setAttribute('data-theme', prefs.theme);
		var themeToggle = shell.querySelector('[data-acp-theme-toggle]');
		if (themeToggle)
		{
			themeToggle.setAttribute('aria-pressed', prefs.theme === 'dark' ? 'true' : 'false');
		}
		if (typeof menu_state !== 'undefined')
		{
			menu_state = (state === 'expanded' || state === 'overlay') ? 'shown' : 'hidden';
		}

		var backdrop = shell.querySelector('[data-acp-backdrop]');
		if (backdrop)
		{
			if (state === 'overlay')
			{
				backdrop.removeAttribute('hidden');
			}
			else
			{
				backdrop.setAttribute('hidden', 'hidden');
			}
		}
	}

	window.acpShell = window.acpShell || {};
	window.acpShell.toggleSidebar = function()
	{
		if (isNarrow())
		{
			mobileOpen = !mobileOpen;
		}
		else
		{
			desktopMode = (desktopMode === 'collapsed') ? 'expanded' : 'collapsed';
			persist();
		}
		apply();
	};

	var toggle = shell.querySelector('[data-acp-sidebar-toggle]');
	if (toggle)
	{
		toggle.addEventListener('click', function(event)
		{
			event.preventDefault();
			window.acpShell.toggleSidebar();
		});
	}

	var backdrop = shell.querySelector('[data-acp-backdrop]');
	if (backdrop)
	{
		backdrop.addEventListener('click', function()
		{
			mobileOpen = false;
			apply();
		});
	}

	function closeMenus(except)
	{
		var menus = shell.querySelectorAll('[data-acp-menu]');
		for (var i = 0; i < menus.length; i++)
		{
			if (except && menus[i] === except)
			{
				continue;
			}
			menus[i].setAttribute('hidden', 'hidden');
			var owner = shell.querySelector('[aria-controls="' + menus[i].id + '"]');
			if (owner)
			{
				owner.setAttribute('aria-expanded', 'false');
			}
		}
	}

	var menuToggles = shell.querySelectorAll('[data-acp-menu-toggle]');
	for (var m = 0; m < menuToggles.length; m++)
	{
		menuToggles[m].addEventListener('click', function(event)
		{
			event.preventDefault();
			event.stopPropagation();
			var panel = document.getElementById(this.getAttribute('aria-controls'));
			if (!panel)
			{
				return;
			}
			var open = panel.hasAttribute('hidden');
			closeMenus(open ? panel : null);
			if (open)
			{
				panel.removeAttribute('hidden');
				this.setAttribute('aria-expanded', 'true');
			}
			else
			{
				panel.setAttribute('hidden', 'hidden');
				this.setAttribute('aria-expanded', 'false');
			}
		});
	}

	document.addEventListener('click', function(event)
	{
		if (event.target.closest && event.target.closest('.acp-menu-wrap'))
		{
			return;
		}
		closeMenus(null);
	});

	var themeToggle = shell.querySelector('[data-acp-theme-toggle]');
	if (themeToggle)
	{
		themeToggle.addEventListener('click', function(event)
		{
			event.preventDefault();
			prefs.theme = (prefs.theme === 'dark') ? 'light' : 'dark';
			persist();
			apply();
		});
	}

	var optionInputs = shell.querySelectorAll('[data-acp-option]');
	for (var i = 0; i < optionInputs.length; i++)
	{
		(function(input)
		{
			var name = input.getAttribute('data-acp-option');
			if (name === 'fixed-sidebar')
			{
				input.checked = prefs.fixedSidebar === '1';
			}
			if (name === 'fixed-top')
			{
				input.checked = prefs.fixedTop === '1';
			}
			input.addEventListener('change', function()
			{
				if (name === 'fixed-sidebar')
				{
					prefs.fixedSidebar = input.checked ? '1' : '0';
				}
				if (name === 'fixed-top')
				{
					prefs.fixedTop = input.checked ? '1' : '0';
				}
				persist();
				apply();
			});
		})(optionInputs[i]);
	}

	window.addEventListener('resize', function()
	{
		if (!isNarrow())
		{
			mobileOpen = false;
		}
		apply();
	});

	apply();
}

function readAcpShellCookie(name)
{
	var parts = ('; ' + document.cookie).split('; ' + name + '=');
	var out = {};
	if (parts.length < 2)
	{
		return out;
	}
	var raw = decodeURIComponent(parts.pop().split(';').shift() || '');
	var pairs = raw.split('&');
	for (var i = 0; i < pairs.length; i++)
	{
		var bits = pairs[i].split('=');
		if (bits[0])
		{
			out[bits[0]] = bits[1] || '';
		}
	}
	return out;
}
