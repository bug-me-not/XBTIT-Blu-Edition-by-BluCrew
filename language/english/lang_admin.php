<?php

global $CURUSER, $XBTT_USE;

$language["WHERE_HEARD"] = 'Signup Referrals';

//KIS
$language['ACP_KHEZ']='Hack Settings';
$language['ACP_KOCS']='KOCS Tools';
$language['ACP_KIS']='KIS Tools';
//KIS

//Featured Torrent
$language['ACP_FEATURED']='Featured Torrent';
//Featured Torrent

//Start Medi SeedBox IP's Tool
$language['SEEDBOX_LOG']='SeedBox IPs';
$language["ACP_MENU_SUPPORT"]="Contact Us";
$language["SUPPORT"]="Contact Us";
//End Medi SeedBox IP's Tool

$language['ACP_BAN_IP']='Ban IPs';
$language['ACP_FORUM']='Forum&rsquo;s Settings';
$language['ACP_USER_GROUP']='Users Group Settings';
$language['ACP_STYLES']='Styles Settings';
$language['ACP_LANGUAGES']='Languages Settings';
$language['ACP_CATEGORIES']='Categories Settings';
$language['ACP_TRACKER_SETTINGS']='Tracker&rsquo;s Settings';
$language['ACP_OPTIMIZE_DB']='Optimize your Database';
$language['ACP_CENSORED']='Censored words Settings';
$language['ACP_DBUTILS']='Database Utilities';
$language['ACP_HACKS']='Hacks';
$language['ACP_HACKS_CONFIG']='Hacks Settings';
$language['ACP_MODULES']='Modules';
$language['ACP_MODULES_CONFIG']='Modules Settings';
$language['ACP_MASSPM']='Mass Private Mail';
$language['ACP_PRUNE_TORRENTS']='Prune Torrents';
$language['ACP_PRUNE_USERS']='Prune Users';
$language['ACP_SITE_LOG']='View Site Log';
$language['ACP_FLUSH']='Global Flush';
//Invalid Login Attemps AdminCP
$language['ACP_LOGLOG']='Invalid Login Attemps';
$language["LOGLOG_IP"]="IP";
$language["LOGLOG_FAIL"]="Failed";
$language["LOGLOG_REM"]="Remaining";
$language["LOGLOG_UNIK"]="Username if known";
$language["LOGLOG_NOTH"]="Nothing";
$language["LOGLOG_HERE"]="Here";
$language["LOGLOG_YET"]="Yet";
//End Invalid Login Attemps AdminCP
$language['ACP_SEARCH_DIFF']='Search Diff.';
$language['ACP_BLOCKS']='Block Settings';
$language['ACP_POLLS']='Poll Settings';
$language['ACP_MENU']='Admin Menu';
$language['ACP_FRONTEND']='Content Settings';
$language['ACP_USERS_TOOLS']='User&rsquo;s Tools';
$language['ACP_TORRENTS_TOOLS']='Torrent&rsquo;s Tools';
$language['ACP_OTHER_TOOLS']='Other Tools';
$language['ACP_MYSQL_STATS']='MySql Statistics';
$language['ACP_FHOST']='File Hosting';
$language['ACP_ANNOUNCEMENT']='Staff Announcements';
$language['XBTT_BACKEND']='xbtt Option';
$language['XBTT_USE']='Use <a href="http://xbtt.sourceforge.net/tracker/" target="_blank">xbtt</a> as backend?';
$language['XBTT_URL']='xbtt base url e.g. http://localhost:2710';
$language['GENERAL_SETTINGS']='General settings';
$language['TRACKER_NAME']='Site&rsquo;s Name';
$language['TRACKER_BASEURL']='Base Tracker&rsquo;s URL (without last /)';
$language['TRACKER_ANNOUNCE']='Tracker&rsquo;s Announce URLS (one url per row)'.($XBTT_USE?'<br />'."\n".'<span style="color:#FF0000; font-weight: bold;">Check your announce urls twice, you&rsquo;ve enable xbtt backend...</span>':'');
$language['TRACKER_EMAIL']='Tracker&rsquo;s/owner&rsquo;s email';
$language['TORRENT_FOLDER']='Torrent folder';
$language['ALLOW_EXTERNAL']='Allow External torrents';
$language['ALLOW_GZIP']='enabled GZIP';
$language['ALLOW_DEBUG']='Show Debug infos on page&rsquo;s bottom';
$language['ALLOW_DHT']='Disable DHT (private flag in torrent)<br />'."\n".'will be set only on  new uploaded torrents';
$language['ALLOW_LIVESTATS']='Enable Live Stats (warning to high server load!)';
$language['ALLOW_SITELOG']='Enable Basic Site Log (log change on torrents/users)';
$language['ALLOW_HISTORY']='Enable Basic History (torrents/users)';
$language['ALLOW_PRIVATE_ANNOUNCE']='Private Announce';
$language['ALLOW_PRIVATE_SCRAPE']='Private Scrape';
$language['SHOW_UPLOADER']='Show Uploader&rsquo;s nick';
$language['USE_POPUP']='Use Popup for Torrents details/peers';
$language['DEFAULT_LANGUAGE']='Default Language';
$language['DEFAULT_CHARSET']='Default Charset Encoding<br />'."\n".'(if your language don&rsquo;t display correctly, try UTF-8)';
$language['DEFAULT_STYLE']='Default Style';
$language['MAX_USERS']='Max Users (numeric, 0 = no limits)';
$language['MAX_TORRENTS_PER_PAGE']='Torrents per page';
$language['SPECIFIC_SETTINGS']='Tracker&rsquo;s specific settings';
$language['SETTING_INTERVAL_SANITY']='Sanity interval (numeric seconds, 0 = disabled)<br />Good value, if enabled, is 1800 (30 minutes)';
$language['SETTING_INTERVAL_EXTERNAL']='Update External interval (numeric seconds, 0 = disabled)<br />Depending of how many external torrents';
$language['SETTING_INTERVAL_MAX_REANNOUNCE']='Maximum reannounce interval (numeric seconds)';
$language['SETTING_INTERVAL_MIN_REANNOUNCE']='Minimum reannounce interval (numeric seconds)';
$language['SETTING_MAX_PEERS']='Max N. of peers for request (numeric)';
$language['SETTING_DYNAMIC']='Allow Dynamic Torrents (not recommended)';
$language['SETTING_NAT_CHECK']='NAT checking';
$language['SETTING_PERSISTENT_DB']='Persistent connections (Database, not recommended)';
$language['SETTING_OVERRIDE_IP']='Allow users to override detected ip';
$language['SETTING_CALCULATE_SPEED']='Calculate Speed and Downloaded bytes';
$language['SETTING_PEER_CACHING']='Table caches (should decrease a little load)';
$language['SETTING_SEEDS_PID']='Max num. of seeds with same PID';
$language['SETTING_LEECHERS_PID']='Max num. of leechers with same PID';
$language['SETTING_VALIDATION']='Validation Mode';
$language['SETTING_CAPTCHA']='Secure Registration (use ImageCode, GD+Freetype libraries needed)';
$language['SETTING_FORUM']='Forum link, can be:<br /><li><font color="#FF0000">internal</font> or empty (no value) for internal forum</li><li><font color="#FF0000">smf</font> for integrated <a target="_new" href="http://www.simplemachines.org">Simple Machines Forum</a> (1.x.x)</li><li><font color="#FF0000">smf2</font> for integrated <a target="_new" href="http://www.simplemachines.org">Simple Machines Forum</a> (2.x)</li><li><font color="#FF0000">ipb</font> for integrated <a target="_new" href="http://www.invisionpower.com">Invision Power Board</a> (3.x.x)</li><li>Your own forum solution (Specify url in the box)</li>';
$language['BLOCKS_SETTING']='Index/Blocks page settings';
$language['SETTING_CLOCK']='Clock type';
$language['SETTING_FORUMBLOCK']='Forum Block Type';
$language['SETTING_NUM_NEWS']='Limit for Latest News block (numeric)';
$language['SETTING_NUM_POSTS']='Limit for Forum block (numeric)';
$language['SETTING_NUM_LASTTORRENTS']='Limit for Latest Torrents block (numeric)';
$language['SETTING_NUM_TOPTORRENTS']='Limit for Most Popular Torrents block (numeric)';
$language['CLOCK_ANALOG']='Analog';
$language['CLOCK_DIGITAL']='Digital';
$language['FORUMBLOCK_POSTS']='Last Posts';
$language['FORUMBLOCK_TOPICS']='Last Active Topics';
$language['CONFIG_SAVED']='The configuration has been saved correctly!';
$language['CACHE_SITE']='Cache interval (numeric seconds, 0 = disabled)';
$language['ALL_FIELDS_REQUIRED']='All fields are required!';
$language['SETTING_CUT_LONG_NAME']='Cut long torrent&rsquo;s name after x chars (0 = don&rsquo;t cut)';
$language['MAILER_SETTINGS']='Mailer';
$language['SETTING_MAIL_TYPE']='Mail Type';
$language['SETTING_SMTP_SERVER']='SMTP Server';
$language['SETTING_SMTP_PORT']='SMTP Port';
$language['SETTING_SMTP_USERNAME']='SMTP Username';
$language['SETTING_SMTP_PASSWORD']='SMTP Password';
$language['SETTING_SMTP_PASSWORD_REPEAT']='SMTP Password (Repeat)';
$language['XBTT_TABLES_ERROR']='You should have to import xbtt tables (look at xbtt installation instructions) into your database before activate xbtt backend!';
$language['XBTT_URL_ERROR']='xbtt base url is mandatory!';
// BAN FORM
$language['BAN_NOTE']='In this part of the admin panel, you can see the banned IPs and ban new IPs from accessing the tracker.<br />'."\n".'You must insert a range from (first IP) to (last IP).';
$language['BAN_NOIP']='There are no banned IPs';
$language['BAN_FIRSTIP']='First IP';
$language['BAN_LASTIP']='Last IP';
$language['BAN_COMMENTS']='Comments';
$language['BAN_REMOVE']='Remove';
$language['BAN_BY']='By';
$language['BAN_ADDED']='Date';
$language['BAN_INSERT']='Insert New Banned IP Range';
$language['BAN_IP_ERROR']='Bad IP address.';
$language['BAN_NO_IP_WRITE']='You haven&rsquo;t wrote an IP address. Sorry!';
$language['BAN_DELETED']='The IP range has been deleted from database.<br />'."\n".'<br />'."\n".'<a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=banip&amp;action=read">Go back to Ban IP</a>';
// LANGUAGES
$language['LANGUAGE_SETTINGS']='Language Settings';
$language['LANGUAGE']='Language';
$language['LANGUAGE_ADD']='Insert new Language';
$language['LANGUAGE_SAVED']='Congratulations, language has been modified';
// STYLES
$language['STYLE_SETTINGS']='Style/Themes Settings';
$language['STYLE_EDIT']='Edit Style';
$language['STYLE_ADD']='Insert new Style';
$language['STYLE_NAME']='Style Name';
$language['STYLE_URL']='Style URL';
$language['STYLE_FOLDER']='Style&rsquo;s folder ';
$language['STYLE_NOTE']='In this section you can manage your style settings, but you must upload files by ftp or sftp.';
// CATEGORIES
$language['CATEGORY_SETTINGS']='Categories Settings';
$language['CATEGORY_IMAGE']='Category Image';
$language['CATEGORY_ADD']='Insert new Category';
$language['CATEGORY_SORT_INDEX']='Sort Index';
$language['CATEGORY_FULL']='Category';
$language['CATEGORY_EDIT']='Edit Category';
$language['CATEGORY_SUB']='Sub-Category';
$language['CATEGORY_NAME']='Category';
// CENSORED
$language['CENSORED_NOTE']='Write <b>one word per line</b> to ban it (will be changed into *censored*)';
$language['CENSORED_EDIT']='Edit Censored Words';
// BLOCKS
$language['BLOCKS_SETTINGS']='Block Configuration';
$language['ENABLED']='Enabled';
$language['ORDER']='Order';
$language['BLOCK_NAME']='Block&rsquo;s name';
$language['BLOCK_POSITION']='Position';
$language['BLOCK_TITLE']='Language title (will be used to display the translated title)';
$language['BLOCK_USE_CACHE']='Cache this block?';
$language['ERR_BLOCK_NAME']='You must select one of the enabled file in the name&rsquo;s dropdown!';
$language['BLOCK_ADD_NEW']='Add a New Block';
// POLLS (more in lang_polls.php)
$language['POLLS_SETTINGS']='Poll Configuration';
$language['POLLID']='Pollid';
$language['INSERT_NEW_POLL']='Add new Poll';
$language['CANT_FIND_POLL']='Can&rsquo;t find poll';
$language['ADD_NEW_POLL']='Add Poll';
// GROUPS
$language['USER_GROUPS']='Users Group Settings (click on group&rsquo;s name to edit)';
$language['VIEW_EDIT_DEL']='View/Edit/Del';
$language['CANT_DELETE_GROUP']='This Level/Group can&rsquo;t be canceled!';
$language['GROUP_NAME']='Group&rsquo;s name';
$language['GROUP_VIEW_NEWS']='View News';
$language['GROUP_VIEW_FORUM']='View Forum';
$language['GROUP_EDIT_FORUM']='Edit Forum';
$language['GROUP_BASE_LEVEL']='Choose base level';
$language['GROUP_ERR_BASE_SEL']='Error on base level select!';
$language['GROUP_DELETE_NEWS']='Delete News';
$language['GROUP_PCOLOR']='Prefix Color (like ';
$language['GROUP_SCOLOR']='Suffix Color (like ';
$language['GROUP_VIEW_TORR']='View Torrents';
$language['GROUP_EDIT_TORR']='Edit Torrents';
$language['GROUP_VIEW_USERS']='View Users';
$language['GROUP_DELETE_TORR']='Delete Torrents';
$language['GROUP_EDIT_USERS']='Edit Users';
$language['GROUP_DOWNLOAD']='Can Download';
$language['GROUP_DELETE_USERS']='Delete Users';
$language['GROUP_DELETE_FORUM']='Delete Forum';
$language['GROUP_GO_CP']='Can access Admin CP';
$language['GROUP_EDIT_NEWS']='Edit News';
$language['GROUP_ADD_NEW']='Add New Group';
$language['GROUP_UPLOAD']='Can Upload';
$language['GROUP_WT']='Waitingtime if Ratio <1';
$language['GROUP_EDIT_GROUP']='Edit Group';
$language['GROUP_VIEW']='View';
$language['GROUP_EDIT']='Edit';
$language['GROUP_DELETE']='Delete';
$language['INSERT_USER_GROUP']='Insert new User Group';
$language['ERR_CANT_FIND_GROUP']='Can&rsquo;t find this group!';
$language['GROUP_DELETED']='The group has been deleted!';
// MASS PM
$language['USERS_FOUND']='users found';
$language['USERS_PMED']='users PMed';
$language['WHO_PM']='Who will the pm be sent to?';
$language['MASS_SENT']='Mass PM sent!!!';
$language['MASS_PM']='Mass PM';
$language['MASS_PM_ERROR']='It maybe a good idea to actually write something before submitting it!!!!';
$language['RATIO_ONLY']='this ratio only';
$language['RATIO_GREAT']='greater then this ratio';
$language['RATIO_LOW']='lower then this ratio';
$language['RATIO_FROM']='From';
$language['RATIO_TO']='To';
$language['MASSPM_INFO']='Info';
// PRUNE USERS
$language['PRUNE_USERS_PRUNED']='Pruned users';
$language['PRUNE_USERS']='Prune users';
$language['PRUNE_USERS_INFO']='Input the number of days which the users are to be considered as "dead" (not connected from x days OR has signed from x days and still validating)';
// SEARCH DIFF
$language['SEARCH_DIFF']='Search Diff.';
$language['SEARCH_DIFF_MESSAGE']='Message';
$language['DIFFERENCE']='Difference';
$language['SEARCH_DIFF_CHANGE_GROUP']='Change User Group';
// PRUNE TORRENTS
$language['PRUNE_TORRENTS_PRUNED']='Pruned torrents';
$language['PRUNE_TORRENTS']='Prune torrents';
$language['PRUNE_TORRENTS_INFO']='Input the number of days which the torrents are to be considered as "dead"';
$language['LEECHERS']='leecher(s)';
$language['SEEDS']='seed(s)';
// DBUTILS
$language['DBUTILS_TABLENAME']='Table Name';
$language['DBUTILS_RECORDS']='Records';
$language['DBUTILS_DATALENGTH']='Data Length';
$language['DBUTILS_OVERHEAD']='Overhead';
$language['DBUTILS_REPAIR']='Repair';
$language['DBUTILS_OPTIMIZE']='Optimize';
$language['DBUTILS_ANALYSE']='Analyze';
$language['DBUTILS_CHECK']='Check';
$language['DBUTILS_DELETE']='Delete';
$language['DBUTILS_OPERATION']='Operation';
$language['DBUTILS_INFO']='Info';
$language['DBUTILS_STATUS']='Status';
$language['DBUTILS_TABLES']='Tables';
// MYSQL STATUS
$language['MYSQL_STATUS']='MySQL Status';
// SITE LOG
$language['SITE_LOG']='Site Log';
// FORUMS
$language['FORUM_MIN_CREATE']='Min Class Create';
$language['FORUM_MIN_WRITE']='Min Class Write';
$language['FORUM_MIN_READ']='Min Class Read';
$language['FORUM_SETTINGS']='Forum&rsquo;s Settings';
$language['FORUM_EDIT']='Edit Forum';
$language['FORUM_ADD_NEW']='Add New Forum';
$language['FORUM_PARENT']='Parent&rsquo;s Forum';
$language['FORUM_SORRY_PARENT']='(Sorry, I can&rsquo;t have parent, because I&rsquo;m myself a parent forum)';
$language['FORUM_PRUNE_1']='There are topics and/or posts in this forum!<br />You will lose all data...<br />';
$language['FORUM_PRUNE_2']='If you&rsquo;re sure to cancel this forum';
$language['FORUM_PRUNE_3']='else go back.';
$language['FORUM_ERR_CANNOT_DELETE_PARENT']='You cannot delete a forum which have childs, move child to other forum and try again';
// MODULES
$language['ADD_NEW_MODULE']='Add New Module';
$language['TYPE']='Type';
$language['DATE_CHANGED']='Date Changed';
$language['DATE_CREATED']='Date Created';
$language['ACTIVE_MODULES']='Active Modules: ';
$language['NOT_ACTIVE_MODULES']='Non-Active Modules: ';
$language['TOTAL_MODULES']='Total Modules: ';
$language['DEACTIVATE']='Deactivate';
$language['ACTIVATE']='Activate';
$language['STAFF']='Staff';
$language['MISC']='Miscellaneous';
$language['TORRENT']='Torrent';
$language['STYLE']='Style';
$language['ID_MODULE']='ID';
// HACKS
$language['HACK_TITLE']='Title';
$language['HACK_VERSION']='Version';
$language['HACK_AUTHOR']='Author';
$language['HACK_ADDED']='Added';
$language['HACK_NONE']='There are no hacks installed';
$language['HACK_ADD_NEW']='Add new hack';
$language['HACK_SELECT']='Select';
$language['HACK_STATUS']='Status';
$language['HACK_INSTALL']='Install';
$language['HACK_UNINSTALL']='UnInstall';
$language['HACK_INSTALLED_OK']='Hack has been installed with success!<br />'."\n".'To see which hacks are installed go back to <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">adminCP (Hacks)</a>';
$language['HACK_BAD_ID']='Error getting hack&rsquo;s info with this ID.';
$language['HACK_UNINSTALLED_OK']='Hack has been UnInstalled with success!<br />'."\n".'To see which hacks are installed go back to <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">adminCP (Hacks)</a>';
$language['HACK_OPERATION']='Operation';
$language['HACK_SOLUTION']='Solution';
// added rev 520
$language['HACK_WHY_FTP']='Some of the files the hack&rsquo;s installer needs to modify are not writable. <br />'."\n".'This needs to be changed by logging into FTP and using it to chmod or create the files and folders. <br />'."\n".'Your FTP information may be temporarily cached for proper operation of the hack&rsquo;s installer.';
$language['HACK_FTP_SERVER']='FTP Server';
$language['HACK_FTP_PORT']='FTP Port';
$language['HACK_FTP_USERNAME']='FTP Username';
$language['HACK_FTP_PASSWORD']='FTP Password';
$language['HACK_FTP_BASEDIR']='Local path for xbtit (path from the root when you login using FTP)';
// USERS TOOLS
$language['USER_NOT_DELETE']='You cannot delete Guest user or yourself!';
$language['USER_NOT_EDIT']='You cannot edit Guest user or yourself!';
$language['USER_NOT_DELETE_HIGHER']='You cannot delete users higher ranked than yourself.';
$language['USER_NOT_EDIT_HIGHER']='You cannot edit users higher ranked than yourself.';
$language['USER_NO_CHANGE']='No change was made.';


//INVITATION SYSTEM
$language['ACP_INVITATION_SYSTEM']='Invitation System';
$language['ACTIVE_INVITATIONS']='Activate Invitation System:';
$language['PRIVATE_TRACKER']='Private Tracker';
$language['PRIVATE_TRACKER_INFO']='For improved security, when setting the tracker to "Private",<br />"Max users" will also be changed to "1".';
$language['ACP_INVITATIONS']='Invitations';
$language['VALID_INV_MODE']='Inviter Confirmation Required';
$language['INVITE_TIMEOUT']='Dead time for invitations<br />( on days )';
$language['INVITED_BY']='Invited by';
$language['SENT_TO']='Sent to';
$language['DATE_SENT']='Date Sent';
$language['INV_WELCOME']='Welcome to Invitation System Panel.<br />Activating this option will prevent users from<br />signing up without an invitation code.';
$language['HASH']='Hash';
$language['VALID_INV_MODE']='Confirmation needed';
$language['VALID_INV_EXPL']='<i>Inviter will have to confirm invited user account</i>';
$language['INVITE_TIMEOUT']='Dead time for invitations<br />( on days )';
$language['GIVE_INVITES_TO']='Give Invitations';
$language['NUM_INVITES']='Number of Invitations';
$language['INVITES_SETTINGS']='Settings';
$language['INVITES_LIST']='Invitation List';
$language['SENDINV_CONFIRM']='Are you sure you want to send this invitation?';
$language['ERR_SENDINVS']='Please, choose username or user level.';
$language['SENDINV_EXPL']='If username is not inserted, rank will be chosen instead.';
$language['RECYCLE_DATE']='Recycle period';
$language['RECYCLE_EXPL']='<i>Period in <u>days</u> after which invitations will be recycled</i>';
$language["ACP_FM_HACK_CONFIG"]='FM Hacks Config';
$language["ACP_NO_HACKS_ENABLED"]='No Hacks Enabled';
$language['HACK_INFO']='Switch Hacks on and off in here.<br /><br /><b>Please note you cannot disable a prerequisite hack if the parent hack is still enabled.</b> Please hover your mouse over the <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i> images below to find out what the parent hack is.';
global $BASEURL;
$language['HACK_ENABLED']='Enabled';
$language['HACK_DISABLED']='Disabled';
$language['SUBMIT'] = 'Submit';
$language['PRE_OF'] = 'Prerequisite of';

// Seed bonus -->
$language["ACP_SEEDBONUS"]="SeedBonus Settings";
$language["BONUS"]="Points awarded per hour seeding";
$language["PRICE_VIP"]="Price for rank VIP";
$language["PRICE_CT"]="Price for CustomTitle";
$language["PRICE_NAME"]="Price for change username";
$language["PRICE_GB"]="Price for GB";
$language["POINTS"]="Points";
$language["SEEDBONUS_UPDATED"]="SeedBonus settings updated";
$language["ENABLE"] = "Enable";
$language["AWARD_FOR"] = "Award points for";
$language["ALL_TORR"] = "All torrents seeded";
$language["ONE_TORR"] = "Single seeded torrent only";
$language["BON_FOR_UPLOAD"] = "Points awarded for uploading a new torrent";
$language["PRICE_FOR_INVITES"] = "Price for Invites";
$language["SB_INVITE"] = "Invite";
$language["SB_INVITES"] = "Invites";
$language["SB_DELAY"] = "Award delay (hours)";
$language["BON_FOR_COMMENT"] = "Points awarded for commenting on a torrent";
$language["BON_FOR_FORUM_POST"] = "Points awarded for forum post";
$language["SB_PNT_4_UPL"] = "Points awarded only if actually uploading data";
$language["SB_MIN_UL_RATE"] = "Minimum Upload rate in KB/s";
$language["SB_MAX_PER_HOUR"] = "Maximum points that can be earned by seeding per hour";
$language["SB_PNTS_4_SHOUT"] = "Points awarded for making a shout";
$language["SB_PNTS_4_RADIO"] = "Points awarded per hour for listening to the radio";
$language["SB_ALLOW_GIFT"] = "Allow users to make a gift of points to other members";
$language["SB_GIFTMAX"] = "Maximum individual gift";
// <-- Seed Bonus

// Donation History by DiemThuy -->
$language['ACP_DON_HIST']='Donation History';
$language['ACP_DON_HIST_SET']='Donation History Settings';
$language['ACP_UNITS'] = 'Units';
$language['ACP_USE_AUTO_PM'] = 'Use Auto PM';
$language['ACP_THANK_PM_TEXT'] = 'Thankyou PM Text';
$language['ACP_DONATION'] = 'Donation';
$language['ACP_AMOUNT'] = 'Amount';
$language['ACP_USERNAME'] = 'Username';
$language['ACP_EDIT_DON'] = 'Edit Donations';
$language['ACP_NONE_YET'] = 'none yet';
$language['ACP_SHORT_DON'] = 'Don';
// <-- Donation History by DiemThuy


// Advanced Auto Donation System by DiemThuy -->
$language['ACP_DONATE']='VIP & Donate Settings';
$language['AADS_NOTHING'] = 'nothing';
$language['AADS_HERE'] = 'here';
$language['AADS_YET'] = 'yet';
$language['AADS_YES'] = 'yes';
$language['AADS_NO_TIMED_RANK'] = 'no timed rank';
$language['AADS_NO_OLD_RANK'] = 'no old rank';
$language['AADS_NO_UPLOAD'] = 'no upload';
$language['AADS_NO'] = 'no';
$language['AADS_DEM_PRO'] = 'demote protection';
$language['AADS_PP_INFO'] = 'Paypal Settings : you need a PayPal Premier account and IPN or PDT enabled in your PayPal Profile !!';
$language['AADS_AP_INFO'] = 'Payza Settings : you need a Payza Personal Pro account and IPN enabled in your Payza Profile !!';
$language['AADS_OO_INFO'] = 'Overall Settings';
$language['AADS_USEPP'] = 'Use PayPal';
$language['AADS_USEAP'] = 'Use Payza';
$language['AADS_SYS'] = 'System';
$language['AADS_TEST'] = 'Test Mode';
$language['AADS_AP_MAIL'] = 'Payza Email';
$language['AADS_AP_SEC'] = 'Security Code';
$language['AADS_MODE'] = 'Test or Real';
$language['AADS_UNITS'] = 'Units';
$language['AADS_VIP_TRACKER'] = 'VIP Rank';
$language['AADS_VIP_SMF'] = 'VIP Rank (SMF/IPB)';
$language['AADS_PP_SAND_MAIL'] = 'Sandbox Email';
$language['AADS_PP_MAIL'] = 'PayPal Email';
$language['AADS_VIP_DAYS'] = '1 Euro/Dollar = .. Vip Days';
$language['AADS_GB_AMT'] = '1 Euro/Dollar = .. GB';
$language['AADS_NEEDED'] = 'Needed';
$language['AADS_RECEIVED'] = 'Received';
$language['AADS_NUM_NO_POINTS'] = '(Numeric) No points';
$language['AADS_DUE_DATE'] = 'Due Date';
$language['AADS_DUE_DATE_VALUE'] = 'DD/MM/YY';
$language['AADS_NUM_DON'] = 'Number of Donators in Block';
$language['AADS_SC_BL_TEXT'] = 'Scrolling Block Text';
$language['AADS_EN_SC_LINE'] = 'Enable Scroll Line';
$language['AADS_DON_HIST_BR'] = 'Donation History Bridge';
$language['AADS_SIM_DON_DISP_BR'] = 'Simple Donor Display Bridge';
$language['AADS_VIP'] = 'VIP';
$language['AADS_LNAME'] = 'Last Name';
$language['AADS_DDATE'] = 'Donate Date';
$language['AADS_VIP_BET'] = 'VIP between';
$language['AADS_VIP_DAYS'] = 'VIP days per unit';
$language['AADS_GB_BET'] = 'GB between';
$language['AADS_GB_PER_UNIT'] = 'GB per unit';
$language['AADS_AND_UP'] = 'and up is';
$language['AADS_UNITS_IS'] = 'units is';
$language["AADS_POSS_DON_WRONG"] = "Possible Donation Amounts are invalid, please enter numerical values separated by commas";
$language["AADS_IPN_OR_PDT"] = "IPN or Payment Data Transfer";
$language["AADS_ID_TOK"] = "PDT Identity Token";
$language["AADS_PAY_ONLY"] = "PayPal Only";
$language["AADS_PZA_ONLY"] = "Payza Only";
$language["AADS_BC_ONLY"] = "Bitcoin Only";
$language["AADS_PAYPAL"] = "PayPal";
$language["AADS_PAYZA"] = "Payza";
$language["AADS_BITCOIN"] = "Bitcoin";
$language["AADS_BC_SETTINGS"] = "Bitcoin Settings";
$language["AADS_BC_ADDRESS"] = "Bitcoin Address";
$language["AADS_USE_BITCOIN"] = "Use Bitcoin";
$language["AADS_DISABLE"] = "disable";
$language["AADS_ENABLE"] = "enable";
$language["AADS_FREELEECH"] ="Freeleech Slots";
$language["AADS_NO_FLS"]= "no freeleech slots";
// <-- Advanced Auto Donation System by DiemThuy

//GOLD
$language["ACP_GOLD"]="Gold torrents settings";
$language["GOLD_CHOOSE_PIC"] = "Choose new picture (max size 100px x 100px)";
$language["GOLD_NO_FILE"] = "File not uploaded!";
$language["GOLD_TOO_BIG"] = "Picture size is limited to 100px X 100px!";
$language["GOLD_NOT_UPPED"] = "File not uploaded!";
$language["GOLD_TOO_SMALL"] = "Picture size is too small!";
$language["GOLD_ONLY_BASE"] = "(Member levels based upon the defaults will automatically inherit these permissions)";


$language['ACP_FREECTRL']='Free Leech Control';
$language['FL_INFO'] = 'Free Leech, if enabled all torrents (including new uploads) will be free Leech, no download stats will be recorded. (Only upload)';
$language['FL_DTE'] = 'Date to expire';
$language['FL_DATE_FORMAT'] = '<b>YYYY-MM-DD</b> - For example <b>2013-03-30</b>';
$language['FL_TTE'] = 'Time to expire';
$language['FL_HOUR_FORMAT'] = '<b>HH</b> - (24 hour) For example <b>05</b> (5am) or <b>13</b> (1pm)';
$language['FL_ENABLE'] = 'Enable';
$language['FL_HAPPY_HOUR'] = 'Happy Hour, if enabled Free Leech will be set randomly for 1 hour a day';
$language['FL_EN_HAPPY_HOUR'] = 'Enable Happy Hour';


$language["IMAGE_SETTING"]="Image Settings";
$language["ALLOW_IMAGE_UPLOAD"]="Allow image upload";
$language["ALLOW_SCREEN_UPLOAD"]="Allow screens upload";
$language["IMAGE_UPLOAD_DIR"]="Image upload dir";
$language["FILE_SIZELIMIT"]="Image size limit";


$language["ACP_HITRUN"]="Hit & Run Settings";
$language["HNR_BLOCK_SETTINGS"] = "Hit & Run Block Settings";
$language["HNR_SCROLLING_TEXT"] = "Scrolling Text";
$language["HNR_COUNT"] = "Number of Hit & Runners to show";
$language["HNR_ERR_1"] = "You cannot add 2 rules for one group!";
$language["HNR_ACTIVE"] = "Active";
$language["HNR_SEEDTIME"] = "Seeding Time";
$language["HNR_BANUSER"] = "Ban User";
$language["HNR_ID_LEVEL"] = "id_level of the group you want to apply these rules to:";
$language["HNR_DOWN_TRIG"] = "Minimum download (MB) required to trigger potential punishemnt:";
$language["HNR_RATIO_TRIG"] = "Minimum ratio required to trigger punishment/reward:";
$language["HNR_MIN_SEED"] = "Minimum seeding time (hours) required to avoid punishment:";
$language["HNR_TOLERANCE"] = "Tolerance in days (number of days allowed to pass before they are eligible for punishment):";
$language["HNR_UL_PUNISH"] = "Amount of Upload Credit (MB) to take from the member for Hitting & Running:";
$language["HNR_REW_SYS"] = "Reward system - return taken upload credit for meeting the seeding requirements afterwards:";
$language["HNR_WARN_BRIDGE"] = "Make use of the warning hack to make Hit & Runners visable for others:";
$language["HNR_DAYS"] = "days";
$language["HNR_FOR"] = "for";
$language["HNR_AFTER"] = "after";
$language["HNR_WARNINGS"] = "warnings";
$language["HNR_BOOT_BRIDGE"] = "Make use of the booted users hack to kick out Hit & Runners:";
$language["HNR_BOOT_USER"] = "if enabled user gets booted:";
$language["HNR_NEW_GROUP"] = "Add New Group";
$language["HNR_ID_LEVEL"] = "ID Level";
$language["HNR_USERGROUP"] = "User Group";
$language["HNR_MIN_DOWN"] = "Minimum Download";
$language["HNR_MIN_RAT"] = "Minimum Ratio";
$language["HNR_MIN_ST"] = "Minimum Seeding Time";
$language["HNR_TOL_DAYS"] = "Tolerance Days";
$language["HNR_UL_PUN"] = "Upload Punishment";
$language["HNR_REW"] = "Reward";
$language["HNR_WS"] = "Warn Symbol";
$language["HNR_FD"] = "For Days";
$language["HNR_WIB"] = "Warn is Boot";
$language["HNR_WT"] = "Warn Times";
$language["HNR_BU"] = "Boot Users";

$language["ACP_AUTORANK"] = "Autorank Administration";
$language["AUTORANK_INVALID"] = "Invalid Input, please enter a number between 1 and 23";
$language["AUTORANK_MAIN_1"] = "To save on excessive load only users who are connected to torrents will be scanned for rank changes regularly. The entire memberbase will be scanned once every 24 hours and you should set the time for this scan below.<br /><br /><b>Please Note:</b> You should set this overall scan time to something off-peak but it also needs to be a time when there are still users likely to be browsing your site otherwise it will probably not get triggered.<br /><br />Valid values are 0-23 (0 = midnight, 1 = 1:00am, 5=5:00am, 14=2:00pm etc.)";
$language["AUTORANK_MAIN_2"] = "Full Scan Time";
$language["AUTORANK_MAIN_3"] = "You can set all the other values from";
$language["AUTORANK_MAIN_4"] = "here";
$language["AUTORANK_SEND_PM"] = "Send PM to inform member of rank change?";


$language["ACP_BOOTED"]="Booted Users";
			$language["ACP_BOOTED_NM"]="Username";
$language["ACP_BOOTED_EXP"]="Expire Time";
$language["ACP_BOOTED_REA"]="Ban Reason";
$language["ACP_BOOTED_WHO"]="Ban Added By";

// --------> modpanel
$language['ACP_MODPANEL']='Staff Panel Settings';
$language['MODCP_SECTION']='Section (the section you want to allow your mod/admin, it\'s the do=xxxx part in the link):';
$language['MODCP_DESC']='Description (if you use a language definition, then language string will be used, else the string you wrote. eg: you put "ACP_BAN_IP" it\'ll display "'.$language['ACP_BAN_IP'].'" ):';
$language['MODCP_URL']='URL (the url to access the resource, {uid} will be replaced by user\'s id and {ucode} eg: link for banip is index.php?page=admin&user={uid}&code={ucode}&do=category&action=read):';
$language['MODCP_NEWSECTION']='Add a new section';
$language['NO_SECTION_ACCESS']='You can\'t access this section.';
// --------> modpanel



//RULES
$language["ACP_RULES_GROUP"]="Rules groups";
$language["ACP_RULES"]="Rules";


//Sticky
$language["ACP_STICKY_TORRENTS"]="Sticky settings";
$language["STICKY_SETTINGS"]="Sticky settings";
$language["COLOR"]="Color";
$language["LEVEL_STICKY"]="Who can add sticky torrents? (default: Uploader)";


// Torrent Request
$language["TRAV_REQ_SET"] = "Request Settings";
$language["TRAV_REQ_HO"] = "Request hack online";
$language["TRAV_REQ_IB"] = "Requests in block";
$language["TRAV_DUFRAP"] = "Days until filled requests are pruned";
$language["TRAV_REQ_PP"] = "Requests per page";
$language["TRAV_MILTPR"] = "min ID level to post requests";
$language["TRAV_ARIS"] = "Announce request in shoutbox";
$language["TRAV_MRU"] = "Max requests use";
$language["TRAV_MNOR"] = "Max number of requests";
$language["TRAV_RRFFAR"] = "Request Reward ( for fulfilling a request ) Settings";
$language["TRAV_RRS"] = "Request reward system";
$language["TRAV_RIUOS"] = "Reward in upload or seedbonus";
$language["TRAV_AIB"] = "Amount in bytes";
$language["TRAV_SBP"] = "Seedbonus points";
$language['TRAV_MBON'] = "Initial Seedbonus";
$language['TRAV_TAX'] = "Percentage Tax on Bounty";
$language["TRAV_ADD_REQ"] = "Add request";
// Torrent Request

$language['XTD_ACP']='XTD Settings';

$language["ACP_LOTTERY"]="Lottery";
$language["LOTT_SETTINGS"]="Lottery Settings";
$language["EXPIRE_DATE"]="Expire date";
$language["EXPIRE_TIME"]="Expire time";
$language["EXPIRE_DATE_VIEW"]="(0000-00-00 must be this format)";
$language["EXPIRE_TIME_VIEW"]="in whole hours";
$language["IS_SET"]="is current date and time)";
$language["NUM_WINNERS"]="Number of winners";
$language["TICKET_COST"]="Amount to pay (per ticket)";
$language["MIN_WIN"]="Min Amount to win";
$language["LOTTERY_STATUS"]="Lottery enabled";
$language["VIEW_SELLED"]="View Sold Tickets";
$language["ACP_SELLED_TICKETS"]="Sold Tickets";
$language["NO_TICKET_SOLD"]="No tickets sold";
$language["TICKETS"]="tickets";
$language["PURCHASE"]="Purchase";
$language["SOLD_TICKETS"]="Tickets Sold";
$language["LOTTERY"]="Lottery";
$language["MAX_BUY"]="Maximum amount user can buy";
$language["LOTT_ID"] = "Id";
$language["LOTT_USERNAME"] = "Username";
$language["LOTT_NUMBER_OF_TICKETS"] = "Number of tickets";
$language["BACK_TO_LOTTERY"]="Back to Lottery";
$language["LOTT_SENDER_ID"]="Sender ID for PM";
$language["ADMIN_SB_BANNED"] = "Shoutbox banned";

$language['tmsg1']="Ticker Message 1";
$language['tmsg2']="Ticker Message 2";
$language['tmsg3']="Ticker Message 3";
$language['tmsg4']="Ticker Message 4";

// Site Offline
$language["ACP_OFFLINE"]="Offline Settings";
$language["OFFLINE_SETTING"]="Site is Offline?";
$language["OFFLINE_MESSAGE"]="Offline message to users (max 200 chars, only admin could access offline site)";

// Download Ratio Check
$language["SETTING_MIN_DLRATIO"]="Minimum ratio to download torrents";
$language["SETTING_CUSTOM_SETTINGS"]="Download Check Settings";
$language["BYPASS_DLCHECK"]="Bypass Download check";

// Radio
$language["RAD_SETTINGS"]="Radio Settings";
$language['djhead']="Dj List";

// Message Spy
$language["ACP_ISPY"]="Message Spy";
$language["DATE_SENT"]="Date Sent";
$language["MESSAGE"]="Message";

// Sport Betting - Start
$language["SB_SETTINGS"] = "Sport Betting Settings";
$language["SB_MIN_IDL_2_BET"] = "Minimum rank To Bet";
$language["SB_FOR_ID"] = "Forum number to post in";
$language["SB_FOR_USER_ID"] = "Forum member ID to post with";
$language["SB_MAX_BON"] = "Maximum Bonus Points";
// Sport Betting - End

// NEW USER DONATE UPLOAD
$language["SETTINGS_UPLOAD"]="Donations of items for new members.";
$language["VALUE_UPLOAD"]="Enter a value and choose a unit.";
$language["KB"]="Kb";
$language["MB"]="Mb";
$language["GB"]="Gb";
$language["TB"]="Tb";

// Add new Users in AdminCP
$language["ACP_ADD_USER"]='Add New User';
$language["NEW_USER_EMAIL"]='Send an email to new user with password';
$language["NEW_USER_EMAIL_TEXT"]='
Hi %s,

You\'ve just be added at %s,
username: %s
password: %s
site url: %s

Hope you\'ll enjoy staying with us
Greetings
The Staff';

// Torrents Limit
$language["MAX_TORRENTS"] = "Maximum Torrents";

// Client ban
$language['BAN_CLIENT']='Ban BitTorrent Client';
$language['REMOVE_CLIENTBAN']='Remove BitTorrent Client Ban';
$language['CLIENT_REMOVED']='This client has been removed from the banned list.<br /><br />';
$language['RETURN']='Return';
$language['UNBAN_MAIN']='By visiting this page you are indicating that you wish to remove the ban on the following client:';
$language['CONFIRM_ACTION']='Are you sure you want to do this? (you will receive no further confirmation).';
$language['CLIENT_ALREADY_BANNED']='This client is already banned!';
$language['ALL_VERSIONS']='All versions';
$language['CLIENT_ADDED']='This client has been added to the banned list<br /><br />';
$language['NEED_A_REASON']='You must enter a reason!';
$language['BAN_MAIN']='By visiting this page you are indicating that you want to ban the following client:';
$language['BAN_ALL_VERSIONS']='Ban all versions?';
$language['REASON']='Reason';

// Ban Button
$language["ACP_BB"]="Ban Button - IP Range";
$language["ACP_BB_USER"]="Ban Button - User";
$language["BB_SETTINGS"] = "Ban Button Settings";
$language["BB_LEVEL"] = "Min Ban Level";
$language["BB_DAYS"] = "Ban Days";
$language["BB_NONE_YET_1"] = "There";
$language["BB_NONE_YET_2"] = "are";
$language["BB_NONE_YET_3"] = "no";
$language["BB_NONE_YET_4"] = "banned";
$language["BB_NONE_YET_5"] = "IP's";
$language["BB_NONE_YET_6"] = "here";
$language["BB_NONE_YET_7"] = "yet";
$language["BB_USERS"] = "users";
$language["BB_NOT_ANYMORE"] = "Not anymore";
$language["BB_TEXT_1"] = "The users in this list are banned by the Ban Button, it is a temporary IP range and announce ban for";
$language["BB_TEXT_2"] = "days, it is temporary because of the risk of banning other users in that range too, the banned user will probably give up after trying for a while.";
$language["BB_TEXT_3"] = "The users in this list are banned by the Ban Button, it will last until you unban the user, these users are also banned from the Announce.";
$language["BB_FIRST_IP"] = "First IP";
$language["BB_LAST_IP"] = "Last IP";
$language["BB_BAN_ADDED"] = "Ban Added";
$language["BB_BAN_EXPIRE"] = "Ban Expire";
$language["BB_ADDED_BY"] = "Added By";
$language["BB_USER_COMM"] = "User & Comment";
$language["BB_DEL"] = "Del";
$language["BB_COMM"] = "Comment";
$language["BB_IP_BANNED"] = "IP Range Banned";

// Ratio Editor
$language["ACP_RATIO_EDITOR"] = "Ratio Editor";
$language["RATIO_USERNAME"] = "Username";
$language["RATIO_UPLOADED"] = "Uploaded";
$language["RATIO_DOWNLOADED"] = "Downloaded";
$language["RATIO_INPUT_MEASURE"] = "Select input measure:";
$language["RATIO_BYTES"] = "Bytes";
$language["RATIO_K_BYTES"] = "KBytes";
$language["RATIO_M_BYTES"] = "MBytes";
$language["RATIO_G_BYTES"] = "GBytes";
$language["RATIO_T_BYTES"] = "TBytes";
$language["RATIO_ACTION"] = "Action:";
$language["RATIO_ADD"] = "Add";
$language["RATIO_REMOVE"] = "Remove";
$language["RATIO_REPLACE"] = "Replace";
$language["RATIO_HEADER"] = "Update users ratio";
$language["RATIO_SUCCES"] = "Success";
$language["RATIO_UPDATE_SUCCES"] = "You succesfully updated this users ratio";

// Duplicate Accounts
$language["DUPLICATES"]="Duplicates";
$language["ERR_USERS_NOT_FOUND"]="No users found!";

// Report High Upload Speed
$language["RHUS_HIGH_UL_SUP"] = "High UL Speed Report Settings";
$language["RHUS_EN_SYS"] = "Enable System";
$language["RHUS_DIS"] = "disabled";
$language["RHUS_REP_FROM"] = "Report Speed From (KB/s)";
$language["RHUS_REP_TU"] = "Report Times / User";
$language["RHUS_ONLY_ONCE"] = "only once";
$language["RHUS_NO_LIM"] = "no limits";

// Twitter Update
$language["TWIT_REG"] = "Authorise Twitter Posting";
$language["TWIT_AUTH_1"] = "In order to authorise your site to make Tweets to your Twitter Account you should";
$language["TWIT_AUTH_2"] = "click here";
$language["TWIT_AUTH_3"] = "and log in to your Twitter account. You will then see something like this";
$language["TWIT_AUTH_4"] = "You should now enter the PIN number you receive into the box below and click the \"Submit\" button";
$language["TWIT_SUBMIT"] = "Submit";
$language["TWIT_BAD_PIN"] = "Bad Pin Number, the entered value should be numerical and 7 characters in length. Please double check and try again.";
$language["TWIT_REG_MISS_1"] = "Authorisation codes missing, please";
$language["TWIT_REG_MISS_2"] = "to restart this process";
$language["TWIT_SUCCESS"] = "Twitter authorisation applied, your new torrents should now be announced to your Twitter account automatically.";
$language["TWIT_CURL_REQ"] = "<span style='color:red'><b>(cURL extension required to enable)</b></span>";

// Torrent Moderation
$language["ACP_ADD_WARN"]="Torrent Moderation Reasons";
$language["ACP_TMOD_SET"]="Torrent Moderation Settings";
$language["WARN_TITLE"]="Title of reason";
$language["WARN_TEXT"]="Explain reason";
$language["WARN_ADD_REASON"]="Add new reason";
$language["TRUSTED"]="Trusted";
$language["TRUSTED_MODERATION"]="Trusted moderation";
$language["TORRENT_STATUS"]="Torrent status";
$language["TORRENT_MODERATION"]="Moderation";
$language["MODERATE_TORRENT"] = "Moderate";
$language["MODERATE_STATUS_OK"] = "Ok";
$language["MODERATE_STATUS_BAD"] = "Bad";
$language["MODERATE_STATUS_UN"] = "Unmoderated";
$language["FRM_CONFIRM_VALIDATE"] = "Confirm revalidation";
$language["MODERATE_PANEL"] = "Mod Torrent Panel";
$language["TMOD_SEND_PM"] = "Send PM upon torrent approval?";
$language["TMOD_SHOW_APPROVER"] = "Show who approved the torrent?";

// Uploader Medals
$language["UM_UPLOADER_MED"] = "Uploader Medal Settings";
$language["UM_HOW_MANY"] = "Check torrents uploaded in the last X days";
$language["UM_BRONZE_COUNT"] = "Minimum number of uploads for Bronze";
$language["UM_SILVER_COUNT"] = "Minimum number of uploads for Silver";
$language["UM_GOLD_COUNT"] = "Minimum number of uploads for Gold";
$language["UM_SHOWALL"] = "Show All or only Uploaders";
$language["UM_ALLRANKS"] = "All Ranks";
$language["UM_UPONLY"] = "Uploaders Only";
$language["UM_BLOCK_LIMIT"] = "Block Limit";

// IMG In SB After X Shouts
$language["IMGSB_SETTINGS"] = "Images In Shoutbox Settings";
$language["IMGSB_AFTER"] = "After X Shouts";
$language["IMGSB_TYPE"] = "Type";
$language["IMGSB_IMAGES"] = "Images";
$language["IMGSB_TEXT"] = "Text";
$language["IMGSB_BOTH"] = "Both";

$language["ACP_FM_HACK_SUBMENU"]='Sub Menu';

// style bridge
$language["STYLE_BRIDGE"] = "Xbtit->Smf Style Bridge";
$language["EDIT_STYLE_BRIDGE"] = "Edit->Xbtit->Smf";
$language["EDITXB_STYLE_BRIDGE"] = "Xbtit style:";
$language["EDITSM_STYLE_BRIDGE"] = "Smf style:";
$language["EDITBTN_STYLE_BRIDGE"] = "Go";
$language["HEADXB_STYLE_BRIDGE"] = "Xbtit";
$language["HEADSM_STYLE_BRIDGE"] = "Smf";
$language["HEADSTYLE_STYLE_BRIDGE"] = "Style";
$language["HEADID_STYLE_BRIDGE"] = "Id";
$language["HEADCURR_STYLE_BRIDGE"] = "Current Settings";
$language["EDDEL_STYLE_BRIDGE"] = "edit/del";
$language["INSERT_STYLE_BRIDGE"] = "Insert->Xbtit->Smf";
$language["SMF_IS_REQ"] = "<span style='color:red'><b>(SMF mode required to enable)</b></span>";

// Block Comments
$language["BC_BLOCK_COMMENT"] = "Block Comment";

$language["TICKER_CONF"]='LED Ticker Config';
$language["SIGNUP_BONUS"]="Signup Bonus";

$language["WS_WARN_SETTINGS"]="Warning Settings";
$language["WS_MAX_WL"] = "Maximum Warn Level";
$language["WS_AUTO_DOWN"] = "Auto-downgrade";
$language["WS_AUTO_DOWN_INT"] = "Auto-downgrade interval (days)";
$language["WS_BOOT_AT_MAX"] = "Boot user at maximum warn level";
$language["WS_BAN_BUTTON_AT_MAX"] = "Ban Button user at maximum warn level";
$language["WS_BAN_BUTTON_AT_MAX"] = "Ban Button user at maximum warn level";
$language["WS_TAKE_NO_ACTION_AT_MAX"] = "Take no action at maximum warn level";

$language["HACK_EN_DIS_ALL"] = "Enable/Disable All Hacks";
$language["HACK_SET_ABOVE"] = "Use Settings Above";
$language["HACK_EN_ALL"] = "Enable All";
$language["HACK_DIS_ALL"] = "Disable All";


$language["HNR_TS_ONLY"] = "Time Seeded Only";
$language["HNR_RATIO_ONLY"] = "Ratio Only";
$language["HNR_TS_OR_RATIO"] = "Time Seeded OR Ratio";
$language["HNR_TS_OR_RATIO_1"] = "Time Seeded <span style='color:blue;'><b>OR</b></span> Ratio";
$language["HNR_TS_AND_RATIO"] = "Time Seeded AND Ratio";
$language["HNR_TS_AND_RATIO_1"] = "Time Seeded <span style='color:green;'><b>AND</b></span> Ratio";
$language["HNR_METHOD"] = "Method";
$language["HNR_MIN_ST"] = "Minimum Seeding Time";
$language["HNR_HOURS"] = "Hour(s)";
$language["HNR_DAYS"] = "Day(s)";
$language["HNR_MIN_RATIO"] = "Minimum Ratio";
$language["HNR_TOLERANCE"] = "Tolerance";
$language["HNR_DL_TRIGGER"] = "Download Trigger";
$language["HNR_BYTES"] = "Byte(s)";
$language["HNR_KB"] = "Kilobyte(s)";
$language["HNR_MB"] = "Megabyte(s)";
$language["HNR_GB"] = "Gigabyte(s)";
$language["HNR_TB"] = "Terabyte(s)";
$language["HNR_BLSO"] = "Block Leeching (Seed Only)";
$language["HNR_CFP"] = "Create Forum Post";
$language["HNR_YMSAR"] = "You must select a rank!";
$language["HNR_YMSAM"] = "You must select a method!";
$language["HNR_YMSAMST"] = "You must select a minimum seeding time!";
$language["HNR_YMSAMR"] = "You must select a minimum ratio!";
$language["HNR_YMSAMSTAAMR"] = "You must select a minimum seeding time and a minimum ratio!";
$language["HNR_YMSAT"] = "You must set a tolerance!";
$language["HNR_YMSADT"] = "You must set a download trigger!";
$language["HNR_YMSAVFBL"] = "You must set a value for Block Leeching!";
$language["HNR_BFID"] = "Bad Forum ID!";
$language["HNR_MINSEED"] = "Min. S.T.";
$language["HNR_MINRAT"] = "Min. Ratio";
$language["HNR_TOL"] = "Tol.";
$language["HNR_DLTRIG"] = "D. Trig.";
$language["HNR_BLOLEECH"] = "Block Leech";
$language["HNR_FORPOST"] = "Forum Post";
$language["HNR_HRS"] = "Hours";
$language["HNR_DYS"] = "Days";
$language["HNR_SET_FOR"] = "H&R settings for";
$language["HNR_CONFIRM_DEL"] = "Confirm Deleton";
$language["HNR_R_U_SURE"] = "Are you sure you want to delete this?";

// Low ratio Warn & Ban System
$language['ACP_LRB']='Low Ratio Warn & Ban';

$language["RAT_OV_SET"] = "Low Ratio Warning & Ban System - Overall Settings";
$language["RAT_EN_SYS"] = "Enable system";
$language["RAT_1ST_WAR"] = "First Warning PM";
$language["RAT_2ND_WAR"] = "Second Warning PM";
$language["RAT_LAST_WAR"] = "Final Warning PM";
$language["RAT_US_SET"] = "Low Ratio Warning & Ban System - User Group Settings";
$language["RAT_RANK_ID"] = "Rank ID";
$language["RAT_MIN_DOWN"] = "Min Download To Trigger";
$language["RAT_1ST_RAT"] = "First Warning Ratio";
$language["RAT_2ND_RAT"] = "Second Warning Ratio";
$language["RAT_3RD_RAT"] = "Third Warning Ratio";
$language["RAT_FIN_RAT"] = "Final Ban Ratio";
$language["RAT_NEXT_WARN"] = "Days Until Next Warning";
$language["RAT_DBFWAB"] = "Days Between Final Warning And Ban";
$language["RAT_SWS"] = "Show Warn Symbol";
$language["RAT_NEW_GROUP"] = "Add New Group";
$language["RAT_ID_LEVEL"] = "ID Level";
$language["RAT_USERG"] = "Usergroup";
$language["RAT_MIN_DOWN_A"] = "Min download";
$language["RAT_1ST_RAT_A"] = "1st warn ratio";
$language["RAT_2ND_RAT_A"] = "2nd warn ratio";
$language["RAT_3RD_RAT_A"] = "3rd warn ratio";
$language["RAT_FIN_RAT_A"] = "Ban ratio";
$language["RAT_DTSW"] = "Days to 2nd warning";
$language["RAT_DTTW"] = "Days to 3rd warning";
$language["RAT_DTB"] = "Days to ban";
$language["RAT_WS"] = "Warn Symbol";
$language["RAT_WABH"] = "Warn & Ban History";
$language["RAT_USER"] = "User";
$language["RAT_WARN_TIM"] = "Warned times";
$language["RAT_WS_BANNED"] = "Banned";
$language["RAT_UNWARN"] = "Unwarn";
$language["RAT_UNBAN"] = "Unban";
$language["RAT_GROUP_RULES"] = "Group Rules";
$language["RAT_NO_2ND_RULE"] = "You can't add 2 rules for one group!";

// Allow Upload / Download
$language["AUAD_DOWN"] = "Download";
$language["AUAD_UP"] = "Upload";

// Proxy / Blacklist
$language["ACP_PROXY"] = "Users Behind Proxy";
$language["ACP_BLACKLIST"] = "Blacklist";
$language["PROX_ADD_TO_LIST"] = "Add Proxy IP's to the Blacklist here, look for Proxy IP's at";
$language["PROX_PIP"] = "Proxy IP";
$language["PROX_IP"] = "IP";
$language["PROX_DA"] = "Date Added";
$language["PROX_REM"] = "Remove";
$language["PROX_NONE_YET"] = "No Blacklisted IP's Yet";
$language["PROX_SUBJ_1"] = "Proxy Detected!";
$language["PROX_MSG_1"] = "Please explain why you are using a proxy, for the time being your download rights have been revoked.";
$language["PROX_SUBJ_2"] = "Proxy Reason accepted";
$language["PROX_MSG_2"] = "We accept the reason you are using a proxy, your download rights have been restored.";
$language["PROX_NOTHING_1"] = "Nothing";
$language["PROX_NOTHING_2"] = "to";
$language["PROX_NOTHING_3"] = "see";
$language["PROX_NOTHING_4"] = "here";
$language["PROX_NOTHING_5"] = "yet";
$language["PROX_ALL_DL"] = "Allow DL";
$language["PROX_PUNISH"] = "Punish";

//FAQ
$language["ACP_FAQ_GROUP"]="Faq groups";
$language["ACP_FAQ"]="Faq";
$language["ACP_FAQ_QUESTION"]="Faq questions";

// Gifts
$language["ACP_GIFTS"] = "Gifts";
$language["GIFTS_SELECT"] = "Select Receiver";
$language["GIFTS_NAME"] = "User";
$language["GIFTS_RANK"] = "Rank";
$language["GIFTS_ALL"] = "All";
$language["GIFTS_INV"] = "Invites";
$language["GIFTS_SB"] = "Seedbonus";
$language["GIFTS_SBP"] = "Seedbonus points";
$language["GIFTS_ACTION"] = "Select Type";
$language["GIFTS_USER_NAME"] = "If Username";
$language["GIFTS_IF_RANK"] = "If Rank";
$language["GIFTS_WHO"] = "Who Should Get The Gift";
$language["GIFTS_WHAT"] = "Gift";
$language["GIFTS_NUMBER"] = "How Much";
$language["GIFTS_SUCCES"] = "Succes";
$language["GIFTS_UPDATE_SUCCES"] = "The chosen user(s) have received their gift";
$language["No_GO_INV"] = "You can not give invites as the invite system is disabled!";
$language["No_GO_SB"] = "You can not give seedbonus points as seedbonus system is disabled!";
$language["GIFT_SUBJECT"] = "You have received a gift";
$language["GIFT_MES_A"] = "You have received";
$language["GIFT_MES_B"] = "This is a automatic system message, please do not reply";
$language["GIFT_ERROR_MSG"] = "Something went wrong ?!";
$language["GIFT_CUSTOM"] = "Gift Reason Text (PM)";
$language["GIFT_TEXT"] = "Text";

// staff control
$language['ACP_STAFF_CONTROL'] = "Staff Control";
$language['MO']= 'Are you sure you want to set this user\'s old rank back?';
$language['MA']= 'Undo';
$language['AUSER']= 'User';
$language['OL']= 'Old Rank';
$language['NE']= 'New Rank';
$language['BY']= 'Action By';
$language['DA']= 'When';
$language['SC']= 'Staff Control';
$language['UNDONE']= 'Undone';

// Birthday hack
$language["ACP_BIRTHDAY"]="Birthday Hack Settings";
$language["BIRTHDAY_LOWER_LIMIT"]="Minimum User Age";
$language["BIRTHDAY_UPPER_LIMIT"]="Maximum User Age";
$language["BIRTHDAY_BONUS"]="Birthday Bonus per year";
$language["BIRTHDAY_FORMAT_GB"]="GB";
$language["BIRTHDAY_FORMAT_MB"]="MB";
$language["BIRTHDAY_UPDATED"]="Thank you, your Birthday Hack settings have now been updated";
$language["BACK"]="Back";

// PM Banned
$language["PMB_BANNED"] = "PM banned";

$language["FORUM_DISPLAY_TYPE"] = "Display integrated forum in:";
$language["FORUM_OPTION_1"] = "an iframe (default)";
$language["FORUM_OPTION_2"] = "the same window";
$language["FORUM_OPTION_3"] = "a new window";

$language["PEERS_VIEW_PEERS"] = "View Peers";
$language["PEERS_VIEW_HIST"] = "View History";
$language["PEERS_VIEW_USERD"] = "View Userdetails Torrents";

$language["ACP_DPS_SETTINGS"]="Dwnld Prefix/Suffix Setup"; # shortened download to dwnld & changed settings to setup for proper menu display
$language["DPS_PREFIX"]="Torrent Filename Prefix";
$language["DPS_SUFFIX"]="Torrent Filename Suffix";
$language["DPS_EXAMPLE"]="Example";
$language["DPS_EXAMPLE_TORR"]="Some.Movie.2011.DVDRip.XviD-SomeTeam.torrent";
$language["DPS_BEFORE"]="Before";
$language["DPS_AFTER"]="After";

$language["ACP_UPL_RIGHTS"]="Uploader Rights Settings";
$language["UPRI_EDIT"]="Allow uploader to edit their own torrent";
$language["UPRI_DELETE"]="Allow uploader to delete their own torrent";

$language["ACP_PG_SETT"]="Pager Type Settings";
$language["PG_TYPE"]="Select Pager Type";
$language["PG_OLD"]="Old Style";
$language["PG_NEW"]="New Style";

$language["BAN_CHEAPMAIL"]="Ban Cheapmail Domains";
$language["ERR_WILDCARD_1"]="The wildcard ";
$language["ERR_WILDCARD_2"]=" is already on the list of Cheapmail Domains so there is no need to add ";
$language["ERR_WILDCARD_3"]=" to the list.";
$language["CHEAP_CONFIRM_1"]="Are you sure you want to delete ";
$language["CHEAP_CONFIRM_2"]="You will receive no further confirmations";
$language["CHEAP_DELETED_1"]=" has been deleted";
$language["CHEAP_DELETED_2"]="Click Here";
$language["CHEAP_DELETED_3"]=" to return";
$language["ERR_CHEAP_SUBMIT"]="You must enter a value in the Text Box!!";
$language["CHEAP_ADDED"]=" was added to the list of Cheapmail Domains";
$language["ERR_CHEAP_DUPE"]=" is already on the list of Cheapmail Domains";
$language["CHEAP_CURRENT"]="Current Cheapmail domains";
$language["ADDED_BY"]="Added by";
$language["CHEAP_COUNT_1"]="Found ";
$language["CHEAP_COUNT_2"]=" Cheapmail Domains";
$language["CHEAP_ADD"]="Add Cheapmail Domain:";

$language["UP_CONTROL"]="Uploader Control";
$language["UP_RANK_UPL"]="Rank - Uploader";
$language["UP_RANK_OTH"]="Rank - Other";
$language["UP_LAST_ONLINE"]="Last Online";
$language["UP_LAST_UPLOAD"]="Last Upload";
$language["UP_DAYS_AGO"]="Days Ago";
$language["UP_ACT_UPL"]="Active Uploads";

$language["IP2C_DB_IMP1"]="IP2country database successfully imported, you may now enable the hack";
$language["IP2C_DB_IMP2"]="here";
$language["IP2C_DB_REQ1"]="<span style='color:red'><b>(Database import (6.5MB) required to enable, ";
$language["IP2C_DB_REQ2"]="click here";
$language["IP2C_DB_REQ3"]="to import.</b></span>";

$language["AVATAR_UPLOAD"] = "Avatar Upload";
$language["MAX_FILE_SIZE"] = "Max. size of the file! (in kb)";
$language["MAX_IMAGE_SIZE"] = "Max. size of the image!";
$language["IMAGE_WIDTH"] = "Width";
$language["IMAGE_HEIGHT"] = "Height";
$language["AVATAR_UPLOAD_SET"] = "Avatar Upload Settings";

$language["UN_SETTINGS"] = "User Notes Settings";
$language["UN_NOTEMOD"] = "Modify/Delete notes";
$language["UN_ENABLED"] = "Enabled";
$language["UN_DISABLED"] = "Disabled";
$language["UN_AUTONOTE"] = "Automatic Note on the user record for";
$language["UN_INVITE"] = "Invite Event";
$language["UN_BONUS"] = "Bonus Point Event";
$language["UN_DONATE"] = "Donation Event";
$language["UN_WARN"] = "Warn Event";
$language["UN_HNR"] = "Hit & Run Event";
$language["UN_AUTORANK"] = "Autorank Event";
$language["UN_BOOTED"] = "Booted Event";
$language["UN_SBBAN"] = "Shoutbox Ban Event";
$language["UN_BANBUT"] = "Ban Button Event";
$language["UN_PARKED"] = "Parked Event";
$language["UN_LRBE"] = "Low Ratio Ban Event";
$language["UN_BIRTHDAY"] = "Birthday Event";
$language["UN_SBOX_REM"]="is no longer banned from the Shoutbox";
$language["UN_SBOX_ADD"]="has been banned from using the Shoutbox";
$language["UN_BAN_BUT_2"]="is no longer banned via the Ban Button";
$language["UN_NOTESPERPAGE"]="Notes per page";

$language["VIEW_NFO"]="View NFO";

$language["RREG_SETTINGS"]="Random Registration Settings";
$language["RREG_OPEN_FOR"]="Registration open for";
$language["RREG_AT_A_TIME"]="at a time";
$language["RREG_RANDOM_WINDOW"]="Minimum/Maximum window";
$language["RREG_MINUTES"]="minute(s)";
$language["RREG_AF_CLOSE"]="after last registration closure";

// FORUM AUTO-TOPIC
$language['ACP_CATFORUM_CONFIG']='Forum Auto-Topic Configuration';
$language['ACP_CATFORUM_SELECT']='Forum Auto-Topic';
$language['AUTOTOPIC_MESS1']='<br />Here you may activate auto-topic upon torrent upload in your forum.<br>You can choose Internal, SMF or IPB Forum in Tracker\'s Settings in order to use this functionality.';
$language['AUTOTOPIC_MESS2']='<br>Select which forum goes to which category.<br>Modifications will apply imediatelly. You may choose only one forum per torrent category.<br>Only torrents uploaded after activation will have automatic forum topic.<br />';
$language['AUTOTOPIC_ACTIVE']='Activate Auto-Topic';
$language['AUTOTOPIC_PREFIX']='Topic Name Prefix<br />Choose a prefix to post before topic\'s name, e.g. "[New Torrent] ".';

$language["VIEW_REENC"]="View Re-encoded";
$language["ACP_REENC_SET"]="Re-Encode Settings";
$language["ACP_SHOUTANN_SET"]="Shoutbox Announce Settings";
$language["SHOUTANN_SHOW_UP"]="Show uploader name on new torrent announce";


$language["ACP_STCOMM_SET"]="Staff Comment Settings";
$language["SCOMM_MIN_SET"]="Minimum base rank to add comment";
$language["SCOMM_MIN_ADD"]="Minimum base rank to view comments";
$language["SCOMM_MIN_SET_LRO"]="Minimum rank to add comment";
$language["SCOMM_MIN_ADD_LRO"]="Minimum rank to view comments";

$language["ACP_RECOMMEND_SET"]="Recommend Torrent Settings";
$language["RTORR_MAX_TO_DISP"]="Maximum Recommended Torrents";

$language["ACP_UIMG_SET"]="User Images Settings";
$language["ACP_UIMG_START"]="User Images - Start";
$language["ACP_UIMG_END"]="User Images - End";

$language["ACP_SECSUI_SET"]="Security Suite Settings";
$language["SECSUI_QUAR_SETTING"]="Uploaded Files Quarantine Settings";
$language["SECSUI_QUAR_TERMS_1"]="Quarantine Search Terms (one per line)";
$language["SECSUI_QUAR_TERMS_2"]="Please add words that will trigger file quarantine below:";
$language["SECSUI_QUAR_TERMS_3"]="NOTE: It is not advisable to add <b><&#63;</b> or <b>&#63;></b> as these may occur naturally in the file, instead you should set the value of <b>short_open_tag</b> to <b>Off</b> in php.ini, this will prevent your site from executing php code which starts with <b><&#63;</b> and will force potential hackers to use the long php open tag (<b><&#63;php</b>) instead.<br /><br />The current value is:<br />";
$language["SECSUI_QUAR_DIR_1"]="Quarantine Directory";
$language["SECSUI_QUAR_DIR_2"]="This folder should ideally be impossible to access via the internet and be at least one level above your tracker root folder for example:";
$language["SECSUI_QUAR_DIR_3"]="Please ensure that you CHOWN/CHMOD this directory appropriately so that the server can write files to it.";
$language["SECSUI_QUAR_PM"]="Tracker ID to PM when files are quarantined";
$language["SECSUI_QUAR_INV_USR"]="Invalid User";
$language["SECSUI_PASS_SETTINGS"]="Password Settings";
$language["SECSUI_PASS_TYPE"]="Password Hashing Method";
$language["SECSUI_PASS_INFO"]="Here you can select the password hashing algorithm you'd like xbtitFM to use when it stores the password in the database:";
$language["SECSUI_NO_MEMBER"]="No member exists with that tracker id";
$language["SECSUI_GAZ_TITLE"]="Gazelle Site Salt";
$language["SECSUI_GAZ_DESC"]="You should set a random value here, once set you should not change it whilst this hashing method in use otherwise everyone will have to recover their passwords.";
$language["SECSUI_COOKIE_SETTINGS"]="Cookie Settings";
$language["SECSUI_COOKIE_PRIMARY"]="Main Cookie Settings";
$language["SECSUI_COOKIE_TYPE"]="Cookie Type";
$language["SECSUI_COOKIE_EXPIRE"]="Cookie will expire in";
$language["SECSUI_COOKIE_T1"]="Classic xbtit";
$language["SECSUI_COOKIE_T2"]="New xbtitFM (Regular)";
$language["SECSUI_COOKIE_T3"]="New xbtitFM (Session)";
$language["SECSUI_COOKIE_NAME"]="Cookie Name";
$language["SECSUI_COOKIE_ITEMS"]="Cookie Items";
$language["SECSUI_COOKIE_PATH"]="Cookie Path";
$language["SECSUI_COOKIE_DOMAIN"]="Cookie Domain";
$language["SECSUI_COOKIE_MIN"]="Minute";
$language["SECSUI_COOKIE_MINS"]="Minutes";
$language["SECSUI_COOKIE_HOUR"]="Hour";
$language["SECSUI_COOKIE_HOURS"]="Hours";
$language["SECSUI_COOKIE_DAY"]="Day";
$language["SECSUI_COOKIE_DAYS"]="Days";
$language["SECSUI_COOKIE_WEEK"]="Week";
$language["SECSUI_COOKIE_WEEKS"]="Weeks";
$language["SECSUI_COOKIE_MONTH"]="Month";
$language["SECSUI_COOKIE_MONTHS"]="Months";
$language["SECSUI_COOKIE_YEAR"]="Year";
$language["SECSUI_COOKIE_YEARS"]="Years";
$language["SECSUI_COOKIE_TOO_FAR"]="I'm sorry, that would put the expire date past the current limit of Tue, 19 Jan 2038 03:14:07 GMT, please adjust your expire date accordingly!";
$language["SECSUI_COOKIE_PSALT"]="Password Salt";
$language["SECSUI_COOKIE_UAGENT"]="User Agent";
$language["SECSUI_COOKIE_ALANG"]="Accept Language";
$language["SECSUI_COOKIE_IP"]="IP Address";
$language["SECSUI_COOKIE_DEF"]="NOTE: All cookie types will include the following by default:<br /><br /><li>Tracker ID</li><li>Password Hash</li><li>Random Number</li>";
$language["SECSUI_COOKIE_PD"]="NOTE: If you're not sure what to put for \"Cookie Path\" or \"Cookie Domain\", you should just leave them blank and the defaults will be used";
$language["SECSUI_COOKIE_IP_TYPE_1"] = "1st octet only (Y.N.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_2"] = "2nd octet only (N.Y.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_3"] = "3rd octet only (N.N.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_4"] = "4th octet only (N.N.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_5"] = "1st & 2nd octets (Y.Y.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_6"] = "2nd & 3rd octets (N.Y.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_7"] = "3rd & 4th octets (N.N.Y.Y)";
$language["SECSUI_COOKIE_IP_TYPE_8"] = "1st & 3rd octets (Y.N.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_9"] = "1st & 4th octets (Y.N.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_10"] = "2nd & 4th octets (N.Y.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_11"] = "1st, 2nd & 3rd octets (Y.Y.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_12"] = "2nd, 3rd & 4th octets (N.Y.Y.Y)";
$language["SECSUI_COOKIE_IP_TYPE_13"] = "Entire IP address (Y.Y.Y.Y)";
$language["SECSUI_PASSHASH_TYPE_1"] = "Classic xbtit";
$language["SECSUI_PASSHASH_TYPE_2"] = "TBDev";
$language["SECSUI_PASSHASH_TYPE_3"] = "TorrentStrike";
$language["SECSUI_PASSHASH_TYPE_4"] = "Gazelle";
$language["SECSUI_PASSHASH_TYPE_5"] = "Simple Machines Forum";
$language["SECSUI_PASSHASH_TYPE_6"] = "New xbtit";
$language["SECSUI_PASSHASH_TYPE_7"] = "New xbtitFM";
$language["SECSUI_PASS_MUST"] = "Password must";
$language["SECSUI_PASS_BE_AT_LEAST"] = "Be at least";
$language["SECSUI_PASS_HAVE_AT_LEAST"] = "Have at least";
$language["SECSUI_PASS_CHAR_IN_LEN"] = "character in length";
$language["SECSUI_PASS_CHAR_IN_LEN_A"] = "characters in length";
$language["SECSUI_PASS_LC_LET"] = "lower case letter";
$language["SECSUI_PASS_LC_LET_A"] = "lower case letters";
$language["SECSUI_PASS_UC_LET"] = "upper case letter";
$language["SECSUI_PASS_UC_LET_A"] = "upper case letters";
$language["SECSUI_PASS_NUM"] = "number";
$language["SECSUI_PASS_NUM_A"] = "numbers";
$language["SECSUI_PASS_SYM"] = "symbol";
$language["SECSUI_PASS_SYM_A"] = "symbols";
$language["SECSUI_PASS_ERR_1"] = "You cannot have a higher value for Upper Case + Lower Case + Numbers + Symbols";
$language["SECSUI_PASS_ERR_2"] = "than you have for the minimum number of characters needed in the password";

$language["SMF_MIRROR"] = "SMF Mirror";
$language["GROUP_SMF_MIRROR"] = "Mirroring rank on the SMF forum for rank changes etc.";
$language["SMF_LIST"] = "<b><u>Current SMF Group List from the database</u></b><br />";
$language["IPB_AUTO_ID"] = "IPB Autopost ID";
$language["IPB_MIRROR"] = "IPB Mirror";
$language["GROUP_IPB_MIRROR"] = "Mirroring rank on the IPB forum for rank changes etc.";
$language["IPB_LIST"] = "<b><u>Current IPB Group List from the database</u></b><br />";

$language["ACP_CBT"]="Cooly's Backup Tools";
$language["ACP_BUFILES"]="File Backup";
$language["ACP_BUDB"]="MYSQL Backup";
$language["ACP_BUINFO"]="Generate New";
$language["ACP_BUINFO_C"]="Config";
$language["ACP_BUINFO_S"]="Export";
$language["ACP_BUINFO_EX"]="Export to SFTP";
$language["ACP_BUINFO_EXI"]="Export a backup to your SFTP server";
$language["ACP_BUINFO_AB"]="Available Backups";
$language["ACP_BUINFO_BP"]="Backup Path:";
$language["ACP_BUINFO_EF"]="(exact name)";
$language["ACP_BUINFO_FS"]="forward slash required.";
$language["ACP_BUINFO_SUCCESS"]="File was transfered!";
$language["ACP_BUINFO2"]="Warning do not navigate away from this page while a backup is in progress.";


$language['Watchu']= 'Watched users';
$language['WatchL']= 'Watched List';

$language["DDL_ADD_ED"] = "Add/Edit Direct Download";
$language["DDL_VIEW"] = "View Direct Download";

$language["ACP_BALL_SET"] = "Balloons/Mouseover Setup"; # changed settings to setup and shotened the menu discription for proper menu display
$language["BALL_DEFAULT"] = "Image Priority";
$language["BALL_IMGUP"] = "Image Upload";
$language["BALL_IMDB"] = "IMDB Poster";

$language["ACP_ONLINE_SET"] = "Online Block Settings";
$language["ONLINE_TIMEOUT"] = "Online Block timeout (minutes)";

$language["PRICE_FOR_HNR"] = "Price for Hit & Run level decrease";

$language["ACP_SHOWPORN_SET"]="Show/Hide Porn Settings";
$language["SP_PORN_CAT"]="Your Porn category";
$language["SP_PORN_CATS"]="Your Porn categories";
$language["SP_MULTI_CAT"]= "If you have multiple Porn categories then you may enter them as a comma-separated list, for example <span style='font-weight:bold;'>1,2,3</span>";
$language["SHOUT_PAGER_LIMIT"]="Shouts Per Page (Shoutbox History)";

$language["STYLE_TYPE"]="Style Type";
$language["CLA_STYLE"]="xbtit classic style system";
$language["ATM_STYLE"]="atmoner's style system";
$language["PET_STYLE"]="Petr1fied's style system";

$language["IMGUP_MAXW"]="Maximum width";
$language["IMGUP_MAXH"]="Maximum height";

$language["VIPFL_FREELEECH"] = "VIP Freeleech";

$language["HOS_CAN_HIDE"] = "Can Hide";
$language["HOS_SEE_HIDDEN"] = "See Hidden Members";
$language["FLOW_LIM"]="Imageflow Limit";
$language["FLOW_CATS"]="Imageflow Cats";
$language["FLOW_SET"]="Imageflow Settings";

$language["IMGFL_PRIORITY"]="Imageflow Priority";
$language["IMGFL_IU"]="Image Upload";
$language["IMGFL_IMDB"]="IMDB Poster";

// Upload Multiplier
$language["UPM_SET_MULTI"] = "Set multiplier on torrents";
$language["UPM_VIEW_MULTI"] = "View torrents with multiplier";
$language["UPM_SET_MULTI_SHORT"] = "Set multi";
$language["UPM_VIEW_MULTI_SHORT"] = "View multi";

$language["BUMP_CANBUMP"] = "Bump torrents to the top of the torrent listing";
$language["BUMP_CANBUMP_SHORT"] = "Bump torrents";

$language["ACP_ARCHIVE_SET"] = "Archive System Settings";
$language["ARC_OLDER_THAN"] = "Archive torrents older than";
$language["ARC_HOURS"] = "hour(s)";
$language["ARC_DAYS"] = "day(s)";
$language["ARC_WEEKS"] = "week(s)";
$language["ARC_BONUS"] = "Additional bonus per hour for seeding archived torrents";

$language["ARC_VIEW_NEW"]="View New Torrents";
$language["ARC_UP_NEW"]="Upload New Torrents";
$language["ARC_DOWN_NEW"]="Download New Torrents";
$language["ARC_VIEW_ARC"]="View Archived Torrents";
$language["ARC_UP_ARC"]="Upload Archived Torrents";
$language["ARC_DOWN_ARC"]="Download Archived Torrents";

$language["ADS_PRE"]="Preview Your AD";
$language["ADS_AREA"]="Area";
$language["ADS_CON"]="Content";
$language["ADS_EDT"]="Edit";
$language["ADS_EN"]="Enabled";
$language["ADS_H"]="Header";
$language["ADS_LT"]="Left Top";
$language["ADS_LB"]="Left Bottom";
$language["ADS_RT"]="Right Top";
$language["ADS_RB"]="Right Bottom";
$language["ADS_AC"]="Above Comments";
$language["ADS_F"]="Footer";
$language["ADS_PREV"]="Preview";
$language["ADS_VIEW"]="Which Groups View";
$language["ADS_CONF"]="ADS Config";
$language["SETUP_MSG"]="Setup";
$language["SETUP_MSG2"]="Welcome PM Setup";
$language["PREVIEW_MSG"]="Preview";
$language['HACK_ENABLE_ALL_WARN']="Warning: Just because this option is here, it is not necessarily a\\ngood idea to use it.\\n\\nEnabling all hacks in one fell swoop will have the adverse effect\\nof disabling many features that are available by default and you\\'ll\\nmost likely end up looking for a needle in a haystack when it\\ncomes to trying to configure the hacks afterwards.\\n\\nInstead we advise you to only enable the hacks that you actually\\nneed and also build up your list of enabled hacks gradually. This\\nway you can configure the settings for each hack as you go along.\\n\\nYou can of course ignore this warning and continue to use this\\noption anyway but you have been warned!";
$language["LGO_TITLE"]="Logical Order";
$language["LRO_INFO"]="Logical rank order (Allows better range selection)";
$language["LRO_ERR_BLOCK"]="You have not configured the logical rank orders correctly. Please ensure all ranks have a unique value and they are in order of priority/importance from lowest (1) eg Guest to highest eg Owner. (You can have gaps between numbers).<br /><br />You can configure the logical rank orders";
$language["FLS_ENABLE"]="Enable Freeleech Slots?";
$language["FLS_COST"]="Cost per Freeleech Slot";
$language["FLS_PRICE_FOR_FLS"]="Price for Freeleech slot";
$language["FLS_ACP_ADMIN"] = "Freeleech Slot Admin";
$language["FLS_AFFECT"] = "What to affect";
$language["FLS_INDIV"] = "Individual User";
$language["FLS_GROUP"] = "Range of ranks";
$language["FLS_NEED_RO"] = "This admin page also requires the <b>Logical Rank Ordering</b> hack to be enabled.<br /><br />You may enable it";
$language["FLS_RANK_RANGE"]="Rank range:";
$language["FLS_OPTIONS"]="Task to carry out:";
$language["FLS_SET_SLOTS_TO"]="Set Freeleech slots to this value:";
$language["FLS_ZERO_AND_CANCEL"]="Zero slots and cancel Freeleech torrents";
$language["FLS_INCREMENT_SLOTS"]="Increment Freeleech slots by:";
$language["FLS_NO_USER"]="No Username entered!";
$language["FLS_USER_INVALID"]="User does not exist!";
$language["FLS_INC_BY_ZERO"]="You can't increment by zero, nothing would change!";
$language["FLS_JOB_DONE"]="Successfully carried out the requested operation.";
$language["FLS_RANGE_ERROR"]="Rank range must be in order of lowest to highest.";
$language["ACP_TOW_SETTINGS"]="Torrent Of The Week Settings";
$language["TOW_TORRENT_SEARCH"]="Torrent filename to search for";
$language["TOW_SEL_TORR"]="Selected torrent";
$language["TOW_SUCCESS_1"]="Your modification has been successfully applied.";
$language["TOW_SUCCESS_2"]="to return to the index.";
$language["TOW_CLICK"]="Click here";
$language["TOW_CHOOSE"]="Choose one";
$language["TOW_CHOOSE_SET"]="Choose settings";
$language["TOW_SEL_FOR"]="Select for";
$language["TOW_THIS_WEEK"]="This week";
$language["TOW_NEXT_WEEK"]="Next week";
$language["TOW_IMUP"]="Image upload";
$language["TOW_IMPRI"]="Image priority";
$language["TOW_MOVE_ALONG"]="Nothing to set here";
$language["TOW_SET_MULTI"]="Set multiplier";
$language["TOW_REV_AFTER"]="Revert after expiry";
$language["TOW_SET_GOLD"]="Set gold";
$language["TOW_NO_TORR"]="No matching torrents found!";
$language["CAPTCHA_CONFIG"]="Captcha Config";
$language["CAPTCHA_PUB"]="Public Key";
$language["CAPTCHA_PRIV"]="Private Key";
$language["CAPTCHA_DESC"]="Sign up <a target=\"_new\" href=\"http://www.google.com/recaptcha\">Here</a> add your domain and obtain your keys.";
$language["SANITY_DOITNOW"]="Do it now!";
$language["ACP_PROTUSER_SETTINGS"]="Protected Username Settings";
$language["PROTUSER_ADD_NAMES"]="Protected usernames (one per line)";
$language["HTML_PARSE"]="Upload Filename Parser Type";
$language["HTML_SPECIAL"]="<a href='javascript:poppeer(\"http://php.net/manual/en/function.htmlspecialchars.php\");'>htmlspecialchars</a>";
$language["HTML_ENT"]="<a href='javascript:poppeer(\"http://php.net/manual/en/function.htmlentities.php\");'>htmlentities</a>";
$language["ACP_INTFORUMPOLL_SETTINGS"]="Integrated Forum Poll Settings";
$language["INTFPOLL_MON"]="Forum to monitor for Polls";
$language["ACP_TAC_SETTINGS"]="Torrent Activity Color Setup"; # edited spelling of colour to color and changed settings to setup for proper menu display
$language["TAC_SNATCHED_PREFIX"]="Snatched torrents prefix colour (eg <span style='color:blue;'>&lt;span style=&#39;color:blue;&#39;&gt;)</span>";
$language["TAC_SNATCHED_SUFFIX"]="Snatched torrents suffix colour (eg <span style='color:blue;'>&lt;&#47;span&gt;</span>)";
$language["TAC_LEECHING_PREFIX"]="Leeching torrents prefix colour (eg <span style='color:red;'>&lt;span style=&#39;color:red;&#39;&gt;</span>)";
$language["TAC_LEECHING_SUFFIX"]="Leeching torrents suffix colour (eg <span style='color:red;'>&lt;&#47;span&gt;</span>)";
$language["TAC_SEEDING_PREFIX"]="Seeding torrents prefix colour (eg <span style='color:green;'>&lt;span style=&#39;color:green;&#39;&gt;</span>)";
$language["TAC_SEEDING_SUFFIX"]="Seeding torrents suffix colour (eg <span style='color:green;'>&lt;&#47;span&gt;</span>)";
$language["TAC_HIDE_DOWN_IMG"]="Hide Downloaded torrents icon";

$language["ACP_TVDB_SETTINGS"]="TheTVDB Settings";
$language["TVDB_CATS"]="Select your TV categories";
$language["TVDB_MIN_RATING"]="Minimum image user voted rating";
$language["TVDB_MIN_VOTERS"]="Minimum number of users to vote on an image";
$language["IMGFL_TVDB"]="Random TVDB Poster";
$language["TVDB_PRIORITY_1"]="First priority";
$language["TVDB_PRIORITY_2"]="Second priority";
$language["TVDB_PRIORITY_3"]="Third priority";
$language["TVDB_PRIORITY_ERR1"]="Bad data from form!";
$language["TVDB_PRIORITY_ERR2"]="The priority boxes must contain different selections!";
$language["TVDB_ADD_AWK"]="Add an awkward title";
$language["TVDB_AWK_EXPLAIN"]="Sometimes, despite best efforts we cannot correctly grab the TV series info from TheTVDB. You can add an exception here to override the automated name parsing so that future uploads should work correctly.";
$language["TVDB_REL_NAME"]="Release name, eg for<br /><span style='color:green;'>Beauty.and.the.Beast.2012.S01E16.720p.HDTV.x264-IMMERSE</span><br />Only <span style='color:green;'>Beauty.and.the.Beast.2012</span> would be added.";
$language["TVDB_DELIM"]="What is used to break up the words in the release name above?<br />(Usually <span style='color:green;'>.</span> or <span style='color:green;'>_</span> or occasionally a space character)";
$language["TVDB_CURR_AWK"]="Current Awkward Titles";
$language["TVDB_REL_NAME_SHORT"]="Release name";
$language["TVDB_DELIM_SHORT"]="Delimiter";
$language["TVDB_AWK_ERR"]="If adding an awkward title you must add:<br /><ul><li>The Release name.</li><li>The delimiter type used.</li><li>The TVDB Series ID.</li></ul><span style='color:red;font-weight:bold;'>All 3 items are needed!</span>";
$language["TVDB_HIDE_IMDB"]="Hide IMDB on Torrent Details if there is already info from TheTVDB?";

$language["ADV_PRUNE_MAX_VAL"]="Prune unvalidated accounts after";
$language["ADV_PRUNE_MAX_TOR"]="Automatically prune torrents after";
$language["ADV_DAYS"]="Days";
$language["ADV_PRUNE_FIRST_WARN"]="First Prune warning after";
$language["ADV_PRUNE_FIRST_WARN_MSG"]="First warning message";
$language["ADV_PRUNE_SECOND_WARN"]="Second Prune warning after";
$language["ADV_PRUNE_SECOND_WARN_MSG"]="Second warning message";
$language["ADV_DEL_AFTER"]="Delete member after a further";
$language["ADV_EXEMPT_RANKS"]="Ranks exempt from being pruned";
$language["ADV_KEY"]="Message replacement key";
$language["ADV_USERNAME1"]="Tracker username";
$language["ADV_USERNAME2"]="in your case";
$language["ADV_SEE_BELOW"]="See below";
$language["ADV_PRUNE_CURRENTLY"]="currently";
$language["ADV_PRUNE_FINAL_MSG"]="Final message";
$language["SEO_MODRW_REQ"]="<span style='color:red;font-weight:bold;'>Apache \"mod_rewrite\" module is required in order to enable this hack.</span>";
$language["CAN_BOOT_USERS"]="Boot users";
$language["ACP_RESEED_SETTINGS"]="Reseed Settings";
$language["RESEED_MIN_SEE"]="Minimum seeds";
$language["RESEED_MIN_FIN"]="Minimum finished";
$language["RESEED_MIN_LEE"]="Minimum leechers";
$language["RESEED_MIN_TOR"]="Minimum age of torrent (days)";
$language["RESEED_MIN_REQ"]="Minimum days since last reseed request";
$language["IBD_SETTINGS"]="Intro Before Download Settings";
$language["IBD_SELECT_FORUM"]="Select introduction forum";
$language["IBD_SUCCESS_MSG"]="Forum has been set. Now please configure which ranks will need to make an introduction thread before downloading torrents.<br /><br />You can do this";
$language["IBD_INTRO_NEEDED"]="Download requires introduction";
$language["IBD_SELECT_TOPIC"]="Specific topic id. (Optional<br />\"0\" = new topic required)";
$language["IBD_NEED_BOTH"]="Please set both the forum and topic id!";
$language["IBD_TOPICID_NOT_FOUND"]="Topic id not found in the specified forum, please check and resubmit.";
$language["OASED_SETTINGS"]="Specified Email Domains Settings";
$language["OASED_DOMAINS"]="Allowed email domains eg <span style='color:green'>gmail.com</span><br />(One domain per line)";
$language["NOCOL_SETTINGS"]="No Columns Display Settings";
$language["NOCOL_ADD_EXCEPTIONS"]="Pages to continue to display blocks on. Enter the part after <span style='color:green'>index.php?page=</span> in the url.<br />With <span style='color:green'>index.php?page=userdetails&id=123</span> you would add just <span style='color:green'>userdetails</span> on it's own<br />(You can also add <span style='color:green'>index</span>)";
$language["MAGNET_NO_ENABLE"]="<span style='color:red;font-weight:bold;'>Your tracker must be public and allow DHT to use this hack.</span>";
$language["MAGNET_LINK_ONLY"]="Only show magnet link where possible<br />(hide torrent download links)";
$language["CSIGN_SETTINGS"]="Country Signup Settings";
$language["CSIGN_SELECT_COUNTRY"]="Select country to block. (The country<br />will be added below automatically)";
$language["CSIGN_COUNT_TO_BLOCK"]="Countries to block (one per line)";
$language["PFET_UPL_EXT"]="Upload External Torrents";
$language["PFET_REF_EXT"]="Refresh External Torrents";
$language["PFET_NO_ENABLE"]="<span style='color:red;font-weight:bold;'>Your tracker must allow External torrents to use this hack.</span>";
$language["SPY_TRUNCATE"]="TRUNCATE";
$language["SPY_INFO"]="Wait";
$language["SPY_INFO_MSG"]="Are you sure you want to empty all messages?<br />Be sure to let your Members know before hand.<br /><a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy&amp;action=flush'>Yes</a>&nbsp;&nbsp;<a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy'>No</a>";
$language["SPY_ERR_MSG"]="Delete Failed!";
$language["SPY_SUCCESS"]="Deletion Process Complete!<br /><a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy'>{$language["BACK"]}</a>";
$language["GALLERY"]="Gallery";
$language["GALLERY_SET"]="Gallery Settings";
$language["GALLERY_MFS"]="Max File Size (Bytes):";
$language["GALLERY_PTH"]="Images Path:";
$language["GALLERY_GRP"]="Group Selection:";
$language["GALLERY_SEL"]="Selected";
$language["GALLERY_NOL"]="Not selected";
$language["SMILE_MENU"]="Smiley Settings";
$language["TAG"]="Tag";
$language["SMILE_UPD"]="Updated!";
$language["SMILE_DLD"]="Deleted!";
$language["SMILE_IMGER"]="Either the image doesn't exist or you have not filled in the tag.";
$language["SMILE_IMGER2"]="only image uploads are allowed!";
$language["SMILE_MISS"]="Missing fields!";
$language["SMILE_IMPORT"]="Click <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=smilies&action=import'>here</a> to import your current smiley set.";
$language["SMILE_CURR"]="Current Smilies";
$language["INTEGRITY_INDEXED"]="File Indexing completed!";
$language["INTEGRITY_COMP"]="Test completed You will be notified by email of the results!";
$language["INTEGRITY_REP"]="Integrity Monitor Report";
$language["INTEGRITY_OK"]="File structure is intact.";
$language["INTEGRITY_BAD"]="The following discrepancies were found:";
$language["INTEGRITY_LAST"]="Last tested";
$language["INTEGRITY_NOINDEX"]="<span style='color:red;'>You have no index yet!</span>. Click <a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&do=integrity&action=index_now'>here</a> to index your file base!";
$language["INTEGRITY_ALINDEX"]="You have previously indexed your files. This time it will check them for any changes and email you the results!.<br /> Click <a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&do=integrity&action=check'>here</a> to continue";
$language["INTEGRITY_MSG"]="This will catalogue your filebase so then you can check at a later time if any files have been modified<br />and will alert you if any changes have been made. This is to help incase any files get modified without your<br />knowledge and you can track them down very easily.<br />Current Status:<br />";
$language["INTEGRITY_MENU"]="File Integrity check";
$language["INTEGRITY_SETUP"]="File Integrity Setup";
?>
