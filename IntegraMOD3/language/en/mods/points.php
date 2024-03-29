<?php
/**
*
* points [English]
*
* version $Id: points.php 573 2009-10-09 12:21:42Z femu $
* copyright (c) 2009 wuerzi & femu
* license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if ( empty($lang) || !is_array($lang) )
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » „ “ — …
//

$lang = array_merge($lang, array(
	'ACP_POINTS'						=> 'Ultimate Points',
	'ACP_POINTS_BANK_TITLE'				=> 'Bank Settings',
	'ACP_POINTS_FORUM_TITLE'			=> 'Forum Points Settings',
	'ACP_POINTS_INDEX_TITLE'			=> 'Point Settings',
	'ACP_POINTS_LOTTERY_TITLE'			=> 'Lottery Settings',
	'ACP_POINTS_ROBBERY_TITLE'			=> 'Robbery Settings',
	'ACP_POINTS_USERGUIDE_TITLE'		=> 'User Guide',

	'BANK_ACCOUNT_OPENING'				=> 'Open an account',
	'BANK_ACTIONS'						=> 'Actions',
	'BANK_BACK_TO_BANK'					=> 'Click %shere%s to return to the bank',
	'BANK_BACK_TO_INDEX'				=> 'Click %shere%s to return to the index',
	'BANK_BALANCE'						=> 'Balance',
	'BANK_BUTTON_DEPOSIT'				=> 'Deposit',
	'BANK_BUTTON_WITHDRAW'				=> 'Withdraw',
	'BANK_COST'							=> 'Account costs per period',
	'BANK_DEPOSIT_SMALL_AMOUNT'			=> 'The smallest amount you can deposit is %s %s.',
	'BANK_DEPOSIT_WITHDRAW'				=> 'Deposit & Withdraw',
	'BANK_DESCRIPTION'					=> 'Your are here in our bank. We only count low costs for a payout, but we also pay money with a defined interest rate. If you open an account, you can save your money from being robbed. So it\'s worth to think about it.<br /><br />',
	'BANK_DISABLED'						=> 'Bank is disabled',
	'BANK_ERROR_DEPOSIT'				=> 'You have specified an incorrect or an invalid deposit amount',
	'BANK_ERROR_NOT_ENOUGH_DEPOSIT'		=> 'You do not own enough %1$s to deposit this amount',
	'BANK_ERROR_NOT_ENOUGH_WITHDRAW'	=> 'Your account does not show enough %1$s to withdraw this amount',
	'BANK_ERROR_PAYOUTTIME_SHORT'		=> 'You must specify a higher payout time than Zero in the bank configuration',
	'BANK_ERROR_WITHDRAW'				=> 'You have specified an incorrect or an invalid withdrawal amount',
	'BANK_FROM_ACCOUNT'					=> 'from your bank account',
	'BANK_HAVE_DEPOSIT'					=> 'You have deposited',
	'BANK_HAVE_WITHDRAW'				=> 'You have withdrawn',
	'BANK_HOLDING'						=> 'Total Holdings',
	'BANK_INFO'							=> 'Bank Information',
	'BANK_INTEREST_PERIOD'				=> 'Period for payout of interests',
	'BANK_INTEREST_RATE'				=> 'Interest Rate',
	'BANK_LEAVE_WITH'					=> 'Leaving you with',
	'BANK_MAX_HOLD'						=> 'Max. value for interests',
	'BANK_MIN_DEPO'						=> 'Minimum deposit',
	'BANK_MIN_WITH'						=> 'Minimum withdrawal',
	'BANK_NEW_BALANCE'					=> 'Your new balance is',
	'BANK_NOW_HAVE'						=> 'You now have',
	'BANK_NO_ACCOUNT'					=> 'User doesn\'t have an account at %1$s',
	'BANK_ON_HAND'						=> 'on hand',
	'BANK_OPEN_ACCOUNT'					=> 'Click %shere%s to open an account',
	'BANK_RICHEST_USER'					=> 'The most rich banker',
	'BANK_START_BALANCE'				=> 'Your starting balance is 0.',
	'BANK_TITLE_MAIN'					=> 'Bank',
	'BANK_TOTAL_ACCOUNTS'				=> 'Total opened accounts',
	'BANK_TO_ACCOUNT'					=> 'into your bank account',
	'BANK_USER_NO_ACCOUNT'				=> 'You don\'t have an account with the %1$s yet.',
	'BANK_WELCOME_BANK'					=> 'Welcome to the',
	'BANK_WITHDRAW_RATE'				=> 'Withdrawal Rate',
	'BANK_WITHDRAW_SMALL_AMOUNT'		=> 'The smallest amount you can withdraw, is %s %s.',
	'BANK_YOUR_ACCOUNT'					=> 'You can now deposit and withdraw to and from your account',

	'EDIT_BANK_MODIFY'					=> 'Bank administration',
	'EDIT_NO_ID_SPECIFIED'				=> 'You have not specified a username',
	'EDIT_POINTS_ADMIN'					=> 'Points Admin',
	'EDIT_POINTS_MODIFY'				=> '%s Administration',
	'EDIT_POINTS_SET'					=> 'The user\'s %1$s have been updated.<br /><br />',
	'EDIT_P_BANK_TITLE'					=> 'Here you can modify a user\'s bank %s.',
	'EDIT_P_POINTS_TITLE'				=> 'Here you can modify a user\'s %s.',
	'EDIT_P_RETURN_INDEX'				=> 'Click %1$shere%2$s to return to the index.',
	'EDIT_P_RETURN_POST'				=> 'Click %1$shere%2$s to return to the post you, where you were coming from.',
	'EDIT_SET_AMOUNT'					=> 'New Amount',
	'EDIT_USER_NOT_EXIST'				=> 'This user doesn\'t exist.',

	'INFO_GENERAL_INFORMATIONS'			=> 'General Information',
	'INFO_ATTACH'						=> 'Points per attachment in a new post',
	'INFO_ADD_ATTACH'					=> 'Points for each new attachment',
	'INFO_NO_COST'						=> 'Currently you don\'t have to pay any %1$s for this',
	'INFO_NO_POINTS'					=> 'Currently you won\'t receive any %1$s for this',
	'INFO_POLL'							=> 'Points for new polls',
	'INFO_POLL_OPTION'					=> 'Points per option in a new poll',
	'INFO_TOPIC_WORD'					=> 'Points per word in a new topic',
	'INFO_TOPIC_CHARACTER'				=> 'Points per character in a new topic',
	'INFO_POST_WORD'					=> 'Points per word in a new post',
	'INFO_POST_CHARACTER'				=> 'Points per character in a new post',
	'INFO_COST_DL_ATTACH'				=> 'Costs per download of an attachment',
	'INFO_COST_WARNING'					=> 'Costs per warning',
	'INFO_REG_BONUS'					=> 'Points bonus with registration',

	'LOGS_COMMENT'						=> 'Comment',
	'LOGS_DATE'							=> 'Date',
	'LOGS_DESCRIPTION'					=> 'Here you will see your logs.<br />You will see a list of all transfers you have sent or which you received.<br />If you are looking for a certain transfer, just use the sort option.<br /><br />',
	'LOGS_REASON_NOLOGS'				=> 'There are no logs available.',
	'LOGS_RECV'							=> 'Received',
	'LOGS_SENT'							=> 'Sent',
	'LOGS_SORT_COMMENT'					=> 'Comment',
	'LOGS_SORT_DATE'					=> 'Date',
	'LOGS_SORT_FROMNAME'				=> 'From',
	'LOGS_SORT_TONAME'					=> 'Sent to',
	'LOGS_SORT_TYPE'					=> 'Type',
	'LOGS_TITLE'						=> '%1$s Logs',
	'LOGS_TO'							=> 'To',
	'LOGS_TYPE'							=> 'Type',
	'LOGS_WHO'							=> 'Who',
	'LOTTERY_ACTIONS'					=> 'Actions',
	'LOTTERY_BACK'						=> 'Back to main lottery page',
	'LOTTERY_DATE'						=> 'Date',
	'LOTTERY_DESCRIPTION'				=> 'The value of your bought tickets will go into the Jackpot. The Jackpot already holds %1$s %2$s per round. The more players the round will have, the higher the Jackpot will be of course. After the draw period, a winner (or even none) is selected by random. If no one wins, the Jackpot will grow even more. So good luck!<br /><br />',
	'LOTTERY_DISABLED'					=> 'The lottery is disabled.',
	'LOTTERY_HISTORY'					=> 'History',
	'LOTTERY_INFO'						=> 'Lottery Information',
	'LOTTERY_INVALID_INPUT'				=> 'You need to enter a valid number in order to buy tickets.',
	'LOTTERY_JACKPOT'					=> 'Jackpot',
	'LOTTERY_LACK_FUNDS'				=> 'You lack of funds to make that purchase!',
	'LOTTERY_LAST_WINNER'				=> 'The last winner was',
	'LOTTERY_MAX_TICKETS'				=> 'Max. number of tickets per round and player',
	'LOTTERY_MAX_TICKETS_LEFT'			=> 'You only have left <strong>%1$s</strong> tickets, which can buy in this round!',
	'LOTTERY_MAX_TICKETS_REACH'			=> 'You are not allowed to buy more than <strong>%1$s</strong> tickets per round!',
	'LOTTERY_NEGATIVE_TICKETS'			=> 'You can\'t buy negtive or 0 tickets!<br />So you need to buy at least 1 ticket!',
	'LOTTERY_NEVER_WON'					=> 'You have never won the lottery!',
	'LOTTERY_NEXT_DRAWING'				=> 'Next draw will be on',
	'LOTTERY_NO_WINNER'					=> 'No winner this time',
	'LOTTERY_NO_WINNERS'				=> 'Noone has won a lottery yet.',
	'LOTTERY_PLAYERS'					=> 'Number of players up to now',
	'LOTTERY_PM_BODY'					=> 'Congratulations! You have won %1$s in our Lottery! %2$s',
	'LOTTERY_PM_CASH_ENABLED'			=> 'Your winnings have been deposited into your account, enjoy it!<br /><br /><i>The Lottery Management</i>',
	'LOTTERY_PM_COMMISION'				=> 'The Lottery Management',
	'LOTTERY_PM_SUBJECT'				=> 'You won the lottery!',
	'LOTTERY_PURCHASE_TICKET'			=> 'Buy Ticket',
	'LOTTERY_PURCHASE_TICKETS'			=> 'Buy Tickets',
	'LOTTERY_TICKETS'					=> 'Sold tickets up to now',
	'LOTTERY_TICKET_COST'				=> 'Ticket Costs',
	'LOTTERY_TICKET_PURCHASED'			=> 'Your ticket purchase is completed!',
	'LOTTERY_TITLE_DESCRIPTION'			=> 'What are the rules to play?',
	'LOTTERY_TITLE_MAIN'				=> 'Lottery',
	'LOTTERY_TOTAL_WINNERS'				=> 'Total Winners',
	'LOTTERY_VIEWER_TICKETS'			=> 'Tickets you own',
	'LOTTERY_VIEW_HISTORY'				=> 'View past winners',
	'LOTTERY_VIEW_SELF_HISTORY'			=> 'View your winning history',
	'LOTTERY_WINNINGS'					=> 'Amount Won',

	'MAIN_BANK_HAVE'					=> 'On your bank account you additionally have %1$s %2$s.',
	'MAIN_HELLO_USERNAME'				=> 'Hello %1$s !',
	'MAIN_LOTTERY_TICKETS'				=> 'You currently own %1$s tickets.',
	'MAIN_ON_HAND'						=> 'You currently have %1$s %2$s on hand.',
	'MAIN_USERNAME_LOCKED'				=> 'This user is locked and cannot use the points system.',

	'POINTS'							=> 'Points',
	'POINTS_ATTACHMENT_MINI_POSTS'		=> 'You need more %1$s in order to download this attachment!',
	'POINTS_BANK'						=> 'Bank',
	'POINTS_BPOINTS_TOTAL'				=> 'Totals in Bank: %1$s %2$s',
	'POINTS_BOT_GUEST'					=> '<strong>If you would have registered with us, you would be able to use this function!</strong>',
	'POINTS_BUPOINTS_TOTAL'				=> 'Bank Accounts : %1$s',
	'POINTS_CASH_ON_HAND'				=> 'Cash on hand',
	'POINTS_COPYRIGHT'					=> 'Ultimate Points by <a href="http://die-muellers.org" onclick="window.open(this.href); return false">femu</a> &amp; <a href="http://www.spieleresidenz.de" onclick="window.open(this.href); return false">Wuerzi</a> v',
	'POINTS_DESCRIPTION'				=> 'Description',
	'POINTS_DISABLED'					=> 'Ultimate Points is currently disabled.',
	'POINTS_DONATE'						=> '[Donate]',
	'POINTS_EXPLAIN'					=> 'Ultimate Points',
	'POINTS_INFO'						=> 'Information',
	'POINTS_INFO_DESCRIPTION'			=> 'Here you will find additional information for our %1$s policy.<br /><br />In addition to these values, you might receive additional %1$s in certain topics.<br /><br />Please be aware, that the forum owner has the ability to disable complete forums from getting %1$s!',
	'POINTS_LOCKED'						=> 'Locked',
	'POINTS_LOGS'						=> 'Logs',
	'POINTS_LOG_MULTI'					=> '%d entries',
	'POINTS_LOG_SINGLE'					=> '1 entry',
	'POINTS_LOG_TOTAL'					=> 'Total',
	'POINTS_LOTTERY'					=> 'Lottery',
	'POINTS_LOTTERY_TIME'				=> 'Next draw: %1$s',
	'POINTS_MODIFY'						=> '[Modify]',
	'POINTS_MOST_RICH_CASH_USERS'		=> 'Users with most cash',
	'POINTS_MOST_RICH_USERS'			=> 'Most rich user',
	'POINTS_MOST_RICH_USERS_DISABLED'	=> 'The display is disabled by the Admin',
	'POINTS_NO_USER'					=> 'This username is invalid',
	'POINTS_NUMBER_FORMAT_EXPLAIN'		=> 'Hint: Always enter values without the thousands separator and decimals with a point, i.e. 1000.50',
	'POINTS_OPTIONS'					=> 'Options',
	'POINTS_OVERVIEW'					=> 'Overview',
	'POINTS_RECEIVED_EDIT_MESSAGE'		=> 'You received <strong>%1$s %2$s</strong> for the edit of the post',
	'POINTS_RECEIVED_POST_MESSAGE'		=> 'You received <strong>%1$s %2$s</strong> for your new topic',
	'POINTS_RECEIVED_REPLY_MESSAGE'		=> 'You received <strong>%1$s %2$s</strong> for your post',
	'POINTS_RETURN_INDEX'				=> 'Click here to return to the index',
	'POINTS_ROBBERY'					=> 'Robbery',
	'POINTS_SEPARATOR_DECIMAL'			=> '.',
	'POINTS_SEPARATOR_THOUSANDS'		=> ',',
	'POINTS_STATISTICS'					=> 'Points Statistics',
	'POINTS_TITLE_MAIN'					=> '%1$s Control Panel',
	'POINTS_TOTAL'						=> 'Total Cash on Hand: %1$s %2$s',
	'POINTS_TRANSFER'					=> 'Transfer',
	'POINTS_VIEWING'					=> 'Browsing points console',

	'ROBBERY_AMOUNTLOSE'				=> 'If you are not successful, you will loose additionally <strong> %s percent</strong> of the value you wanted to rob!<br /><br />',
	'ROBBERY_BAD'						=> 'Sorry ... your robbery has failed!',
	'ROBBERY_CHANCE'					=> 'Here you can try to rob another user. But you only can try to rob <strong>%1$s percent</strong> of the user\'s current cash amount!<br /><br />Like in real life, crime isn\'t really successful. Your chance to be successful with your robbery is <strong> %2$s percent</strong>.',
	'ROBBERY_DISABLED'					=> 'The robbery system is disabled',
	'ROBBERY_MAX_ROB'					=> 'You cannot rob more than <strong>%1$s percent</strong> of the users cash amount at once!',
	'ROBBERY_NO_ID_SPECIFIED'			=> 'You have not specified a username',
	'ROBBERY_PM_BAD_BODY'				=> ' %1$s has tried to rob %2$s %3$s from you!',
	'ROBBERY_PM_BAD_SUBJECT'			=> 'Somebody tried to rob you',
	'ROBBERY_PM_SUCCESFUL_BODY'			=> 'You have lost %2$s %3$s ... </br> %1$s has robbed you! I am really sorry!',
	'ROBBERY_PM_SENDER'					=> 'Robbery Information',
	'ROBBERY_PM_SUCCESFUL_SUBJECT'		=> 'You have lost some %1$s!!!',
	'ROBBERY_SELF'						=> 'You can\'t rob yourself.',
	'ROBBERY_SET_AMOUNTR'				=> 'The amount you like to rob',
	'ROBBERY_SET_USERNAMER'				=> 'Name of the user you like to rob',
	'ROBBERY_START'						=> 'Start Robbery',
	'ROBBERY_SUCCESFUL'					=> 'You have successfully made a great robbery!',
	'ROBBERY_TOO_SMALL_AMOUNT'			=> 'You need to rob a little more!<br />The entered value is too small ...',
	'ROBBERY_TO_MUCH'					=> 'You are trying to rob too many points, if you fail you will not be able to pay the damage ...',
	'ROBBERY_TO_MUCH_FROM_USER'			=> 'You are trying to rob more, than the user has.',

	'TIME_DAY'							=> 'day',
	'TIME_DAYS'							=> 'days',
	'TIME_HOUR'							=> 'hour',
	'TIME_HOURS'						=> 'hours',
	'TIME_MINUTE'						=> 'min',
	'TIME_MINUTES'						=> 'mins',
	'TIME_MONTH'						=> 'month',
	'TIME_MONTHS'						=> 'months',
	'TIME_SECOND'						=> 'sec',
	'TIME_SECONDS'						=> 'secs',
	'TIME_WEEK'							=> 'week',
	'TIME_WEEKS'						=> 'weeks',
	'TIME_YEAR'							=> 'year',
	'TIME_YEARS'						=> 'years',
	'TRANSFER_AMOUNT'					=> 'Amount to transfer',
	'TRANSFER_COMMENT'					=> 'Comment',
	'TRANSFER_DESCRIPTION'				=> 'Here you can transfer a few %1$s. Simply add the name and the amount of points of the user you like to donate and click send. The transfer will be logged in your log files.',
	'TRANSFER_NO_USER_RETURN'			=> '<strong>The selected username is invalid!</strong>',
	'TRANSFER_PM_BODY'					=> 'You received a donation of %1$s %2$s with following comment: <br /><i>%3$s</i>',
	'TRANSFER_PM_SUBJECT'				=> 'You have receive a donation!',
	'TRANSFER_REASON_MINPOINTS'			=> 'You do not have enough %1$s to transfer.',
	'TRANSFER_REASON_TRANSFER'			=> 'The Admin has disabled transferring',
	'TRANSFER_REASON_TRANSUCC'			=> 'You successfully transferred <strong>%1$s %2$s</strong> to <strong>%3$s</strong>!',
	'TRANSFER_REASON_UNDERZERO'			=> 'You cannot transfer under 0.00 %1$s.',
	'TRANSFER_REASON_YOURSELF'			=> 'You cannot transfer %1$s to yourself!',
	'TRANSFER_SET_USERNAME'				=> '<b>Name of the user you want to make a donation:</b>',
	'TRANSFER_TITLE'					=> '%1$s Transfer',
	'TRANSFER_TO_NAME'					=> 'You want to transfer some <strong>%2$s</strong> to <strong>%1$s</strong>',

	'UP_INSERT_FIRST_FILL'				=> 'The tables were filled successfully with some basic datas.',
	'UP_REMOVE_CONFIG_ENTRIES'			=> 'The entries in the config table were removed successfully',
	'UP_REMOVE_FORUM_ENTRIES'			=> 'The entries in the forums table were removed successfully',
	'UP_ULTIMATE_POINTS_NAME'			=> 'Ultimate Points',
	'UP_ULTIMATE_POINTS_NAME_EXPLAIN'	=> 'With this mod you will give your users the possibility to collect and spend points. Click on the below actions to perform, what you like to do. Enabling <strong>Display Full Results</strong> is recommended.<br /><br />Have fun!',
	'UP_UPDATE_SUCCESFUL'				=> 'The tables were updated successfully',
));

