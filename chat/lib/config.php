<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// Define AJAX Chat user roles:
define('AJAX_CHAT_GUEST',		0);
define('AJAX_CHAT_USER',		1);
define('AJAX_CHAT_SUPERLEECH',2);
define('AJAX_CHAT_LEECHER',	3);
define('AJAX_CHAT_RECRUIT',	4);
define('AJAX_CHAT_BLUUSER',	5);
define('AJAX_CHAT_BLUWARRIOR',6);
define('AJAX_CHAT_BLUMASTER',	7);
define('AJAX_CHAT_BLUADDICT',	8);
define('AJAX_CHAT_BLUJUNKIE',	9);
define('AJAX_CHAT_BLUGOD',		10);
define('AJAX_CHAT_UPLOADER',	11);
define('AJAX_CHAT_VIP',			12);
define('AJAX_CHAT_TRUSTEE',	13);
define('AJAX_CHAT_BLURG',		14);
define('AJAX_CHAT_MODERATOR',	15);
define('AJAX_CHAT_ADMIN',		16);
define('AJAX_CHAT_CHATBOT',	17);

// AJAX Chat config parameters:
$config = array();

//Database settings
require (dirname(__FILE__).'/../../include/settings.php');

// Database connection values:
$config['dbConnection'] = array();
// Database hostname:
$config['dbConnection']['host'] = $dbhost;
// Database username:
$config['dbConnection']['user'] = $dbuser;
// Database password:
$config['dbConnection']['pass'] = $dbpass;
// Database name:
$config['dbConnection']['name'] = $database;
// Database type:
$config['dbConnection']['type'] = 'mysqli';
// Database link:
$config['dbConnection']['link'] = null;

// Database table names:
$config['dbTableNames'] = array();
$config['dbTableNames']['online']		= 'ajax_chat_online';
$config['dbTableNames']['messages']		= 'ajax_chat_messages';
$config['dbTableNames']['bans']			= 'ajax_chat_bans';
$config['dbTableNames']['invitations']	= 'ajax_chat_invitations';

// Available languages:
$config['langAvailable'] = array(
	'ar','bg','ca','cy','cz','da','de','el','en','es','et','fa','fi','fr','gl','he','hr','hu','in','it','ja','ka','kr','mk','nl','nl-be','no','pl','pt-br','pt-pt','ro','ru','sk','sl','sr','sv','th','tr','uk','zh','zh-tw'
);
// Default language:
$config['langDefault'] = 'en';
// Language names (each languge code in available languages must have a display name assigned here):
$config['langNames'] = array(
	'ar'=>'عربي', 'bg'=>'Български', 'ca'=>'Català', 'cy'=>'Cymraeg', 'cz'=>'Česky', 'da'=>'Dansk', 'de'=>'Deutsch', 'el'=>'Ελληνικα', 'en'=>'English',
	'es'=>'Español', 'et'=>'Eesti', 'fa'=>'فارسی', 'fi'=>'Suomi', 'fr'=>'Français', 'gl'=>'Galego', 'he'=>'עברית', 'hr' => 'Hrvatski', 'hu' => 'Magyar', 'in'=>'Bahasa Indonesia', 'it'=>'Italiano',
	'ja'=>'日本語','ka'=>'ქართული','kr'=>'한 글','mk'=>'Македонски', 'nl'=>'Nederlands', 'nl-be'=>'Nederlands (België)', 'no'=>'Norsk', 'pl'=> 'Polski', 'pt-br'=>'Português (Brasil)', 'pt-pt'=>'Português (Portugal)',
	'ro'=>'România', 'ru'=>'Русский', 'sk'=> 'Slovenčina', 'sl'=>'Slovensko', 'sr'=>'Srpski', 'sv'=> 'Svenska', 'th'=>'&#x0e20;&#x0e32;&#x0e29;&#x0e32;&#x0e44;&#x0e17;&#x0e22;',
	'tr'=>'Türkçe', 'uk'=>'Українська', 'zh'=>'中文 (简体)', 'zh-tw'=>'中文 (繁體)'
);

// Available styles:
$config['styleAvailable'] = array('beige','black','grey','Oxygen','Lithium','Sulfur','Cobalt','Mercury','Uranium','Plum','prosilver','subblack2','subSilver','Core','MyBB','vBulletin');
// Default style:
$config['styleDefault'] = 'prosilver';

// The encoding used for the XHTML content:
$config['contentEncoding'] = 'UTF-8';
// The encoding of the data source, like userNames and channelNames:
$config['sourceEncoding'] = 'UTF-8';
// The content-type of the XHTML page (e.g. "text/html", will be set dependent on browser capabilities if set to null):
$config['contentType'] = null;

// Session name used to identify the session cookie:
$config['sessionName'] = 'blu_ajax_chat';
// Prefix added to every session key:
$config['sessionKeyPrefix'] = 'bluajaxChat';
// The lifetime of the language, style and setting cookies in days:
$config['sessionCookieLifeTime'] = 30;
// The path of the cookies, '/' allows to read the cookies from all directories:
$config['sessionCookiePath'] = '/';
// The domain of the cookies, defaults to the hostname of the server if set to null:
$config['sessionCookieDomain'] = null;
// If enabled, cookies must be sent over secure (SSL/TLS encrypted) connections:
$config['sessionCookieSecure'] = null;

// Default channelName used together with the defaultChannelID if no channel with this ID exists:
$config['defaultChannelName'] = 'Blu-torrents';
// ChannelID used when no channel is given:
$config['defaultChannelID'] = 1;
// Defines an array of channelIDs (e.g. array(0, 1)) to limit the number of available channels, will be ignored if set to null:
$config['limitChannelList'] = null;

// UserID plus this value are private channels (this is also the max userID and max channelID):
$config['privateChannelDiff'] = 500000000;
// UserID plus this value are used for private messages:
$config['privateMessageDiff'] = 1000000000;

// Enable/Disable private Channels:
$config['allowPrivateChannels'] = true;
// Enable/Disable private Messages:
$config['allowPrivateMessages'] = true;

// Private channels should be distinguished by either a prefix or a suffix or both (no whitespace):
$config['privateChannelPrefix'] = '[';
// Private channels should be distinguished by either a prefix or a suffix or both (no whitespace):
$config['privateChannelSuffix'] = ']';

// If enabled, users will be logged in automatically as guest users (if allowed), if not authenticated:
$config['forceAutoLogin'] = true;

// Defines if login/logout and channel enter/leave are displayed:
$config['showChannelMessages'] = false;

// If enabled, the chat will only be accessible for the admin:
$config['chatClosed'] = false;
// Defines the timezone offset in seconds (-12*60*60 to 12*60*60) - if null, the server timezone is used:
$config['timeZoneOffset'] = null;
// Defines the hour of the day the chat is opened (0 - closingHour):
$config['openingHour'] = 0;
// Defines the hour of the day the chat is closed (openingHour - 24):
$config['closingHour'] = 24;
// Defines the weekdays the chat is opened (0=Sunday to 6=Saturday):
$config['openingWeekDays'] = array(0,1,2,3,4,5,6);

// Enable/Disable guest logins:
$config['allowGuestLogins'] = false;
// Enable/Disable write access for guest users - if disabled, guest users may not write messages:
$config['allowGuestWrite'] = false;
// Allow/Disallow guest users to choose their own userName:
$config['allowGuestUserName'] = false;
// Guest users should be distinguished by either a prefix or a suffix or both (no whitespace):
$config['guestUserPrefix'] = '(';
// Guest users should be distinguished by either a prefix or a suffix or both (no whitespace):
$config['guestUserSuffix'] = ')';
// Guest userIDs may not be lower than this value (and not higher than privateChannelDiff):
$config['minGuestUserID'] = 400000000;

// Allow/Disallow users to change their userName (Nickname):
$config['allowNickChange'] = false;
// Changed userNames should be distinguished by either a prefix or a suffix or both (no whitespace):
$config['changedNickPrefix'] = '(';
// Changed userNames should be distinguished by either a prefix or a suffix or both (no whitespace):
$config['changedNickSuffix'] = ')';

// Allow/Disallow registered users to delete their own messages:
$config['allowUserMessageDelete'] = true;

// The userID used for ChatBot messages:
$config['chatBotID'] = 2147483647;
// The userName used for ChatBot messages
$config['chatBotName'] = 'Blu_Bot';

// Minutes until a user is declared inactive (last status update) - the minimum is 2 minutes:
$config['inactiveTimeout'] = 10;
// Interval in minutes to check for inactive users:
$config['inactiveCheckInterval'] = 2;

// Defines if messages are shown which have been sent before the user entered the channel:
$config['requestMessagesPriorChannelEnter'] = true;
// Defines an array of channelIDs (e.g. array(0, 1)) for which the previous setting is always true (will be ignored if set to null):
$config['requestMessagesPriorChannelEnterList'] = null;
// Max time difference in hours for messages to display on each request:
$config['requestMessagesTimeDiff'] = 72;
// Max number of messages to display on each request:
$config['requestMessagesLimit'] = 250;

// Max users in chat (does not affect moderators or admins):
$config['maxUsersLoggedIn'] = 250;
// Max userName length:
$config['userNameMaxLength'] = 40;
// Max messageText length:
$config['messageTextMaxLength'] = 1040;
// Defines the max number of messages a user may send per minute:
$config['maxMessageRate'] = 20;

// Defines the default time in minutes a user gets banned if kicked from a moderator without ban minutes parameter:
$config['defaultBanTime'] = 1440;

// Argument that is given to the handleLogout JavaScript method:
$config['logoutData'] = './?logout=true';

// If true, checks if the user IP is the same when logged in:
$config['ipCheck'] = true;

// Defines the max time difference in hours for logs when no period or search condition is given:
$config['logsRequestMessagesTimeDiff'] = 1;
// Defines how many logs are returned on each logs request:
$config['logsRequestMessagesLimit'] = 10;

// Defines the earliest year used for the logs selection:
$config['logsFirstYear'] = 2010;

// Defines if old messages are purged from the database:
$config['logsPurgeLogs'] = true;
// Max time difference in days for old messages before they are purged from the database:
$config['logsPurgeTimeDiff'] = 14;

// Defines if registered users (including moderators) have access to the logs (admins are always granted access):
$config['logsUserAccess'] = false;
// Defines a list of channels (e.g. array(0, 1)) to limit the logs access for registered users, includes all channels the user has access to if set to null:
$config['logsUserAccessChannelList'] = null;

// Defines if the socket server is enabled:
$config['socketServerEnabled'] = false;
// Defines the hostname of the socket server used to connect from client side (the server hostname is used if set to null):
$config['socketServerHost'] = null;
// Defines the IP of the socket server used to connect from server side to broadcast update messages:
$config['socketServerIP'] = '127.0.0.1';
// Defines the port of the socket server:
$config['socketServerPort'] = 1935;
// This ID can be used to distinguish between different chat installations using the same socket server:
$config['socketServerChatID'] = 0;
?>
