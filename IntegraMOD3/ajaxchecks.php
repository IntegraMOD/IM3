<?php
/*
+-----------------------------------------------------------------------+
|        _____                                                          |
|       /\  __`\                                                        |
|       \ \ \/\ \  __  __     __   ____    ____      __                 |
|        \ \ \ \ \/\ \/\ \  /'__`\/\_ ,`\ /\_ ,`\  /'__`\               |
|         \ \ \\'\\ \ \_\ \/\  __/\/_/  /_\/_/  /_/\ \L\.\_             |
|          \ \___\_\ \____/\ \____\ /\____\ /\____\ \__/.\_\            |
|           \/__//_/\/___/  \/____/ \/____/ \/____/\/__/\/_/            |
|                                                                       |
+-----------------------------------------------------------------------+
| Support Site  : www.Quezza.com                                        |
| Contact Email : LoonyLuke@gmail.com (NOT FOR SUPPORT)                 |
| Copyright     : (c) 2007 Luke Cousins (LoonyLuke) & Quezza Dev Team   |
| Portions (C)  : (c) 2007 phpBB Group                                  |
+-----------------------------------------------------------------------+
| Quezza is free software; you can redistribute it and/or               |
| modify it under the terms of the GNU General Public License           |
| as published by the Free Software Foundation; either version 2        |
| of the License, or (at your option) any later version.                |
|                                                                       |
| Quezza is distributed in the hope that it will be useful,             |
| but WITHOUT ANY WARRANTY; without even the implied warranty of        |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         |
| GNU General Public License for more details.                          |
|                                                                       |
| You should have received a copy of the GNU General Public License     |
| along with this program; if not, please visit: www.Quezza.com/GPL.php |
+-----------------------------------------------------------------------+
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);

// Include the language files
$user->setup('mods/ajaxchecks');
$user->add_lang('ucp');

// Check that the $_GET['mode'] variable has been set
if (!isset($_GET['mode']))
{
	die('');
}

// Set our variable
$mode = utf8_normalize_nfc(request_var('mode', '', true));

// Do the right thing to each mode
if ($mode == 'usernamecheck')
{
	//
	// Check that the username given has not already been used
	//
	
	// Set the variables
	$usernametocheck = utf8_normalize_nfc(request_var('username', '', true));
	
	// Why don't we use the phpBB function instead?
	$usernamecheckresult = validate_username($usernametocheck);
	
	// Check if it the username is ok (false means it is)
	if ($usernamecheckresult === false)
	{
		$return = 'usernamecheck|' . $user->img('icon_ajax_true', 'AJAX_CHECK_USERNAME_TRUE') . '&nbsp;<span style="color: #008000;">' . $user->lang['AJAX_CHECK_USERNAME_TRUE'] . '</span>';
	} else {
		$return = 'usernamecheck|' . $user->img('icon_ajax_false', 'AJAX_CHECK_USERNAME_FALSE') . '&nbsp;<span style="color: #FF0000;">' . $user->lang[$usernamecheckresult . '_USERNAME'] . '</span>';
	}
	
	// Stop execution and show the result
	die($return);
	
}
elseif ($mode == 'passwordcheck')
{
	//
	// Check that the two passwords given are the same
	//
	
	// Set the variables
	$password1 = utf8_normalize_nfc(request_var('password1', '', true));
	$password2 = utf8_normalize_nfc(request_var('password2', '', true));
	
	// Check the password doesn't contain any illegal chars, etc.
	$passwordcheckresult = validate_password($password1);
	
	// Check if it the password is ok (false means it is)
	if ($passwordcheckresult === false)
	{
		// Check the passwords are the same
		if ($password1 == $password2)
		{
			// Passwords are the same, show a correct message
			$return = 'passwordcheck|' . $user->img('icon_ajax_true', 'AJAX_CHECK_PASSWORD_TRUE') . '&nbsp;<span style="color: #008000;">' . $user->lang['AJAX_CHECK_PASSWORD_TRUE'] . '</span>';
			
			// Now, check the "strength" of the password and show an image accordingly
			function check_password_strength($password)
			{
			    
			    $strength = 0;
			    $patterns = array('#[a-z]#','#[A-Z]#','#[0-9]#','/[¬!"£$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/');
			    foreach($patterns as $pattern)
			    {
			        if(preg_match($pattern, $password, $matches))
			        {
			            $strength++;
			        }
			    }
			    
			    if (strlen($password) < 6 && $strength > 2)
			    {
			    	// If the length is less than 6 maximum can be rating can be 2
			    	$strength = 2;
			    }
			    elseif (strlen($password) >= 14 && $strength != 4)
			    {
			    	// If the length is 14 or more then give it one higher rating (unless 4 already)
			    	$strength++;
			    	
			    }
			    return $strength;
			}
			
			// Why not actually do the check now that we've got the function done :-)
			$passwordstrength = check_password_strength($password1);
			$return = $return . '<br /><br />' . $user->img('icon_ajax_password_strength_' . $passwordstrength, 'AJAX_CHECK_PASSWORD_STRENGTH') . '&nbsp;' . $user->lang['AJAX_CHECK_PASSWORD_STRENGTH_' . $passwordstrength];

		}
		else
		{
			// Passwords not the same, show the error
			$return = 'passwordcheck|' . $user->img('icon_ajax_false', 'AJAX_CHECK_PASSWORD_FALSE') . '&nbsp;<span style="color: #FF0000;">' . $user->lang['AJAX_CHECK_PASSWORD_FALSE'] . '</span>';
		}
	}
	else
	{
		// Failed the password validation
		$return = 'passwordcheck|' . $user->img('icon_ajax_false', 'AJAX_CHECK_PASSWORD_FALSE') . '&nbsp;<span style="color: #FF0000;">' . $user->lang[$passwordcheckresult . '_PASSWORD'] . '</span>';
	}
	
	// Stop execution and show the result
	die($return);
}
elseif (($mode == 'emailcheck'))
{
	//
	// Check that the two email addresses given are the same
	//
	
	// Set the variables
	$email1 = strtolower(utf8_normalize_nfc(request_var('email1', '', true)));
	$email2 = strtolower(utf8_normalize_nfc(request_var('email2', '', true)));
	
	// Check the email is not in use, has the correct format, is for a "real" domain, etc.
	$emailcheckresult = validate_email($email1);
	
	// Check if it the email is ok (false means it is)
	if ($emailcheckresult === false)
	{
		// Now check both are the same
		if ($email1 == $email2)
		{
			$return = 'emailcheck|' . $user->img('icon_ajax_true', 'AJAX_CHECK_EMAIL_TRUE') . '&nbsp;<span style="color: #008000;">' . $user->lang['AJAX_CHECK_EMAIL_TRUE'] . '</span>';
		}
		else
		{
			$return = 'emailcheck|' . $user->img('icon_ajax_false', 'AJAX_CHECK_EMAIL_FALSE') . '&nbsp;<span style="color: #FF0000;">' . $user->lang['AJAX_CHECK_EMAIL_FALSE'] . '</span>';
		}
	}
	else
	{
		// Failed the email validation
		$return = 'emailcheck|' . $user->img('icon_ajax_false', 'AJAX_CHECK_EMAIL_FALSE') . '&nbsp;<span style="color: #FF0000;">' . $user->lang[$emailcheckresult . '_EMAIL'] . '</span>';
	}
	
	// Stop execution and show the result
	die($return);
}
else
{
	// Dunno what we are doing so die
	die('');
}
?>