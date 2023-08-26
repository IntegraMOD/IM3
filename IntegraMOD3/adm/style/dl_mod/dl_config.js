/**
* Show/hide option panels
* value = suffix for ID to show
* adv = we are opening advanced permissions
* view = called from view permissions
*/
function swap_options(cat)
{
	active_option = active_cat;

	var	old_tab = document.getElementById('tab' + active_option);
	var new_tab = document.getElementById('tab' + cat);

	init_traffic();

	// no need to set anything if we are clicking on the same tab again
	if (new_tab == old_tab)
	{
		return;
	}

	// set active tab
	old_tab.className = old_tab.className.replace(/\ activetab/g, '');
	new_tab.className = new_tab.className + ' activetab';

	if (cat == active_option)
	{
		return;
	}

	document.getElementById('options' + active_option).style.display = 'none';
	document.getElementById('options' + cat).style.display = '';

	active_cat = cat;
}

function init_traffic()
{
	var tm = document.getElementById('tm_onoff');
	var onoff = document.getElementById('dl_traffic_block');
	var tab4 = document.getElementById('tab4');

	if (tm === null)
	{
		return;
	}

	if (tm.checked == 1)
	{
		onoff.style.display = 'none';
		tab4.className = 'permissions-preset-no';
	}
	else
	{
		onoff.style.display = '';
		tab4.className = 'permissions-preset-yes';
	}

	if (active_cat == 4)
	{
		tab4.className = tab4.className + ' activetab';
	}
}