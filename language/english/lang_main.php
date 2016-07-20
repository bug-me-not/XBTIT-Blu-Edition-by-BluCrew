<?php
global $users, $torrents, $seeds, $leechers, $percent, $FORUMLINK, $BASEURL, $SITENAME;
// $language['rtl']='rtl'; // if your language is  right to left then uncomment this line
// $language['charset']='ISO-8859-1'; // uncomment this line with specific language charset if different than tracker's one
$language['ACCOUNT_CONFIRM']='Account confirmation at the '.$SITENAME.' site.';
$language['ACCOUNT_CONGRATULATIONS']='Congratulations your account is now valid!<br />Now you can <a href="index.php?page=login">login</a> on the site using your account.';
$language['ACCOUNT_CREATE']='Create account';
$language['ACCOUNT_DELETE']='Delete account';
$language['ACCOUNT_DETAILS']='account details';
$language['ACCOUNT_EDIT']='Edit account';
$language['ACCOUNT_MGMT']='Account Managment';
$language['ACCOUNT_MSG']='Hello,'."\n\n".'This email has been sent because someone has requested an account on our site with this email address.'."\n".'If you aren\'t the requester ignore this email, otherwise please confirm the account.'."\n\n".'Best regards from the staff.';
$language['ACTION']='Action';
$language['ACTIVATED']='Active';
$language['ACTIVE']='Status';
$language['ACTIVE_ONLY']='Active only';
$language['ADD']='Add';
$language['ADDED']='Added';
$language['ADMIN_CPANEL']='Admin Control Panel';
$language['ADMINCP_NOTES']='Here you can control all settings of your tracker...';
$language['ALL']='All';
$language['ALL_SHOUT']='All Shouts';
$language['ANNOUNCE_URL']='Tracker announce url:';
$language['ANONYMOUS']='Anonymous';
$language['ANSWER']='Answer';
$language['AUTHOR']='Author';
$language['AVATAR_URL']='Avatar (url): ';
$language['AVERAGE']='Average';
$language['BACK']='Back';
$language['BAD_ID']='Bad ID!';
$language['BCK_USERCP']='Back to User Panel';
$language['BLOCK']='Block';
$language['BODY']='Body';
$language['BOTTOM']='bottom';
$language['BY']='By';
$language["ACP_MENU_SUPPORT"]="Contact Us";
$language["SUPPORT"]="Contact Us";
$language['CANT_DELETE_ADMIN']='It&rsquo;s impossible to delete another admin!';
$language['CANT_DELETE_NEWS']='You&rsquo;re not authorized do delete news!';
$language['CANT_DELETE_TORRENT']='You&rsquo;re not authorized to delete this torrent!...';
$language['CANT_DELETE_USER']='You&rsquo;re not authorized to delete users!';
$language['CANT_DO_QUERY']='Can&rsquo;t do SQL query - ';
$language['CANT_EDIT_TORR']='You&rsquo;re not authorised to edit torrent!';
$language['CANT_FIND_TORRENT']='Can&rsquo;t find torrent file!';
$language['CANT_READ_LANGUAGE']='Can&rsquo;t read the language file!';
$language['CANT_SAVE_CONFIG']='Can&rsquo;t save the settings into config.php';
$language['CANT_SAVE_LANGUAGE']='Can&rsquo;t save the language file';
$language['CANT_WRITE_CONFIG']='Warning: couldn&rsquo;t write config.php!';
$language['CATCHUP']='Mark All as Read';
$language['CATEGORY']='Cat.';
$language['CATEGORY_FULL']='Category';
$language['CENTER']='center';
$language['CHANGE_PID']='Change PID';
$language['CHARACTERS']='characters';
$language['CHOOSE']='Choose';
$language['CHOOSE_ONE']='choose one';
$language['CLICK_HERE']='click here';
$language['CLOSE']='close';
$language['COMMENT']='Com.';
$language['COMMENT_1']='Comment';
$language['COMMENT_PREVIEW']='Comment&rsquo;s Preview';
$language['COMMENTS']='Comments';
$language['CONFIG_SAVED']='Congratulations, new configuration was saved';
$language['COUNTRY']='Country';
$language['CURRENT_DETAILS']='Current Details';
$language['DATABASE_ERROR']='Database error.';
$language['DATE']='Date';
$language['DB_ERROR_REQUEST']='Database error. Cannot complete request.';
$language['DB_SETTINGS']='Database&rsquo;s settings';
$language['DEAD_ONLY']='Dead only';
$language['DELETE']='Delete';
$language['DELETE_ALL_READED']='Delete all read';
$language['DELETE_CONFIRM']='Are you sure you want to delete/remove this?';
$language['DELETE_TORRENT']='Delete Torrent';
$language['DELFAILED']='Delete Failed';
$language['DESCRIPTION']='Description';
$language['DONT_NEED_CHANGE']='You don&rsquo;t need to change these settings!';
$language['DOWN']='Dl';
$language['DOWNLOAD']='Download';
$language['DOWNLOAD_TORRENT']='Download Torrent';
$language['DOWNLOADED']='Downloaded';
$language['DONATE']='Donate Today';
$language['EDIT']='Edit';
$language['EDIT_LANGUAGE']='Edit Language';
$language['EDIT_POST']='Edit Post';
$language['EDIT_TORRENT']='Edit Torrent';
$language['EMAIL']='Email';
$language['EMAIL_SENT']='An email as been sent to the indicated email address<br />click on the included link to confirm your account.';
$language['EMAIL_VERIFY']='email account update at '.$SITENAME;
$language['EMAIL_VERIFY_BLOCK']='Verification email sent';
$language['EMAIL_VERIFY_MSG']='Hello,'."\n\n".'This email has been sent because you have requested a change to the email address currently held on your record, please click the link below to complete the change.'."\n\n".'Best regards from the staff.';
$language['EMAIL_VERIFY_SENT1']='<br /><center>A verification email has been sent to:<br /><br /><strong><font color="red">';
$language['EMAIL_VERIFY_SENT2']='</font></strong><br /><br />You will need to click on the link contained within the email in order<br />to update your email address. The email should arrive within 10 minutes<br />(usually instantly) although some email providers may mark it as SPAM<br />so be sure to check your SPAM folder if you can&rsquo;t find it.<br /><br />';
$language['ERR_500']='HTTP/1.0 500 Unauthorized access!';
$language['ERR_AVATAR_EXT']='Sorry either the image doesn&rsquo;t exist or the file type is incorrect (only gif, jpg, bmp or png images allowed).';
$language['ERR_BAD_LAST_POST']='';
$language['ERR_BAD_NEWS_ID']='Bad news ID!';
$language['ERR_BODY_EMPTY']='Body cannot be empty!';
$language['ERR_CANT_CONNECT']='Can&rsquo;t connect to local MySQL server';
$language['ERR_CANT_OPEN_DB']='Can&rsquo;t open database';
$language['ERR_COMMENT_EMPTY']='Comment cannot be empty!';
$language['ERR_DB_ERR']='Database error. Please contact an administrator about this.';
$language['ERR_DELETE_POST']='Delete post. Sanity check: You are about to delete a post. Click';
$language['ERR_DELETE_TOPIC']='Delete topic. Sanity check: You are about to delete a topic. Click';
$language['ERR_EMAIL_ALREADY_EXISTS']='This Email is already in our database!';
$language['ERR_EMAIL_NOT_FOUND_1']='The email address';
$language['ERR_EMAIL_NOT_FOUND_2']='was not found in the database.';
$language['ERR_ENTER_NEW_TITLE']='You must enter a new title!';
$language['ERR_FORUM_NOT_FOUND']='Forum not found';
$language['ERR_FORUM_UNKW_ACT']='Forum Error: Unknown action';
$language['ERR_GUEST_EXISTS']='"Guest" is a restricted username. You cant register as "Guest"';
$language['ERR_IMAGE_CODE']='The security code does not match';
$language['ERR_INS_TITLE_NEWS']='You must insert both title AND news';
$language['ERR_INV_NUM_FIELD']='Invalid numerical field(s) from client';
$language['ERR_INVALID_CLIENT_EVENT']='Invalid event= from client.';
$language['ERR_INVALID_INFO_BT_CLIENT']='Invalid information received from BitTorrent client';
$language['ERR_INVALID_IP_NUMB']='Invalid IP address. Must be standard dotted decimal (hostnames not allowed)';
$language['ERR_LEVEL']='Sorry, your level ';
$language['ERR_LEVEL_CANT_POST']='You are not permitted to post in this forum.';
$language['ERR_LEVEL_CANT_VIEW']='You are not permitted to view this topic.';
$language['ERR_MISSING_DATA']='Missing data!';
$language['ERR_MUST_BE_LOGGED_SHOUT']='You must be logged in to shout...';
$language['ERR_NO_BODY']='No body text';
$language['ERR_NO_NEWS_ID']='New&rsquo;s ID not found!';
$language['ERR_NO_POST_WITH_ID']='No post with ID ';
$language['ERR_NO_SPACE']='Your username cannot contain a space, please replace with an underscore eg:<br /><br />';
$language['ERR_NO_TOPIC_ID']='No Topic ID returned';
$language['ERR_NO_TOPIC_POST_ID']='No topic associated with post ID';
$language['ERR_NOT_AUTH']='You&rsquo;re not authorized!';
$language['ERR_NOT_FOUND']='Not Found...';
$language['ERR_NOT_PERMITED']='Not Permited';
$language['ERR_PASS_LENGTH_1']='Your password must be a minimum of';
$language['ERR_PASS_LENGTH_2']='characters in length.';
$language['ERR_PASSWORD_INCORRECT']='Password Incorrect';
$language['ERR_PERM_DENIED']='Permission denied';
$language['ERR_PID_NOT_FOUND']='Please redownload the torrent. PID system is active and pid was not found in the torrent';
$language['ERR_RETR_DATA']='Error retreaving data!';
$language['ERR_SEND_EMAIL']='Unable to send mail. Please contact an administrator about this error.';
$language['ERR_SERVER_LOAD']='The server load is very high at the moment. Retrying, please wait...';
$language['ERR_SPECIAL_CHAR']='<font color="black">Your username can not contain special characters like:<br /><br /><font color="red"><strong>* &#63; &#60; &#62; &#64; &#36; &#38; &#37; etc.</strong></font></font><br />';
$language['ERR_SQL_ERR']='SQL Error';
$language['ERR_SUBJECT']='You must enter a subject.';
$language['ERR_TOPIC_ID_NA']='Topic ID is N/A';
$language['ERR_TOPIC_LOCKED']='Topic is Locked';
$language['ERR_TORRENT_IN_BROWSER']='This file is for BitTorrent clients.';
$language['ERR_UPDATE_USER']='Unable to update user data. Please contact an administrator about this error.';
$language['ERR_USER_ALREADY_EXISTS']='There&rsquo;s already an user with this nick!';
$language['ERR_USER_NOT_FOUND']='Sorry, User not Found';
$language['ERR_USER_NOT_USER']='You&rsquo;re not autorized to access another user&rsquo;s panel!';
$language['ERR_USERNAME_INCORRECT']='Username Incorrect';
$language['ERROR']='Error';
$language['ERROR_ID']='Error ID';
$language['FACOLTATIVE']='optional';
$language['FILE']='File';
$language['FILE_CONTENTS']='File Contents';
$language['FILE_NAME']='File Name';
$language['FIND_USER']='Find user';
$language['FINISHED']='Finished';
$language['FORUM']='Forum';
$language['FORUM_ERROR']='Forum Error';
$language['FORUM_INFO']='Forum Info';
$language['FORUM_MIN_CREATE']='Min Class Create';
$language['FORUM_MIN_READ']='Min Class Read';
$language['FORUM_SEARCH']='Forums Search';
$language['FORUM_N_TOPICS']='N. Topics';
$language['FORUM_N_POSTS']='N. Posts';
$language['FRM_DELETE']='Delete';
$language['FRM_LOGIN']='Login';
$language['FRM_PREVIEW']='Preview';
$language['FRM_REFRESH']='Refresh';
$language['FRM_RESET']='Reset';
$language['FRM_SEND']='Send';
$language['FRM_CONFIRM']='Confirm';
$language['FRM_CANCEL']='Cancel';
$language['FRM_CLEAN']='Clean';
$language['GLOBAL_SERVER_LOAD']='Global Server Load (All websites on current server)';
$language['GO']='Go';
$language['GROUP']='Group';
$language['GUEST']='Guest';
$language['GUESTS']='Guests';
$language['HERE']='here';
$language['HISTORY']='History (Client Sessions Totaled)';
$language['IF_YOU_ARE_SURE']='if you are sure.';
$language['IM_SURE']='I&rsquo;m Sure';
$language['IN']='in';
$language['INF_CHANGED']='Informations changed!';
$language['INFINITE']='Inf.';
$language['INFO_HASH']='Info Hash';
$language['INS_NEW_PWD']='Insert NEW password!';
$language['INS_OLD_PWD']='Insert OLD password!';
$language['INSERT_DATA']='Insert all the necessary data for the upload.';
$language['INSERT_NEW_FORUM']='Insert new forum';
$language['INVALID_ID']='It&rsquo;s not a valid ID. Sorry!';
$language['INVALID_INFO_HASH']='Invalid info hash value.';
$language['INVALID_PID']='Invalid PID';
$language['INVALID_TORRENT']='Tracker error: invalid torrent';
$language['KEYWORDS']='Keywords';
$language['LAST_EXTERNAL']='Last External Torrents Update was done on ';
$language['LAST_NEWS']='Latest News';
$language['LAST_POST_BY']='Last post by';
$language['LAST_SANITY']='Last Sanity Check was done on ';
$language['LAST_TORRENTS']='Latest Torrents';
$language['LAST_UPDATE']='Last Update';
$language['LASTPOST']='Last post';
$language['LEECHERS']='Leechers';
$language['LEFT']='left';
$language['LOGIN']='Login';
$language['LOGOUT']='Logout';
$language['MAILBOX']='Mailbox';
$language['MANAGE_NEWS']='Manage News';
$language['MEMBER']='User';
$language['MEMBERS']='Users';
$language['MEMBERS_LIST']='User List';
$language['MINIMUM_100_DOWN']='(with minimum 100 MB downloaded)';
$language['MINIMUM_5_LEECH']='with minimum 5 leechers, not included dead torrents';
$language['MINIMUM_5_SEED']='with minimum 5 seeders';
$language['MKTOR_INVALID_HASH']='makeTorrent: Received an invalid hash';
$language['MNU_ADMINCP']='Admin Panel';
$language['MNU_ANNOUNCEMENT']='Staff Announcements';
$language['MNU_FORUM']='Forum';
$language['MNU_HOME']='Home';
$language['MNU_MEMBERS']='Members';
$language['MNU_NEWS']='News';
$language['MNU_STATS']='Extra Stats';
$language['MNU_TORRENT']='Torrents';
$language['MNU_UCP_CHANGEPWD']='Change Password';
$language['MNU_UCP_HOME']='User&rsquo;s CP Home';
$language['MNU_UCP_IN']='Your PM inbox';
$language['MNU_UCP_INFO']='Change Profile';
$language['MNU_UCP_NEWPM']='New PM';
$language['MNU_UCP_OUT']='Your PM outbox';
$language['MNU_UCP_PM']='Your PM box';
$language['MNU_UPLOAD']='Upload';
$language['MORE_SMILES']='More Emoticons';
$language['MORE_THAN']='More than ';
$language['MORE_THAN_2']='items found, displaying first';
$language['NA']='N/A';
$language['NAME']='Name';
$language['NEED_COOKIES']='Note: You need cookies enabled to log in.';
$language['NEW_COMMENT']='Insert your comment...';
$language['NEW_COMMENT_T']='New Comment';
$language['NEWS']='the news';
$language['NEWS_DESCRIPTION']='News:';
$language['NEWS_INSERT']='Insert your news';
$language['NEWS_PANEL']='News Panel';
$language['NEWS_TITLE']='Title:';
$language['NEXT']='Next';
$language['NO']='No';
$language['NO_BANNED_IPS']='There are no banned IPs';
$language['NO_COMMENTS']='No comments...';
$language['NO_FORUMS']='No Forums found!';
$language['NO_MAIL']='you have no new mail.';
$language['NO_MESSAGES']='No PM found...';
$language['NO_NEWS']='no news';
$language['NO_PEERS']='No peers';
$language['NO_RECORDS']='Sorry, list is empty...';
$language['NO_TOPIC']='No topics found';
$language['NO_TORR_UP_USER']='No torrents uploaded by this user';
$language['NO_TORRENTS']='No torrents here...';
$language['NO_USERS_FOUND']='No users found!';
$language['NOBODY_ONLINE']='Nobody online';
$language['NONE']='None';
$language['NOT_ADMIN_CP_ACCESS']='You&rsquo;re not authorized to access the admin panel!';
$language['NOT_ALLOW_DOWN']='is not allowed to download from';
$language['NOT_AUTH_DOWNLOAD']='You&rsquo;re not authorized to download. Sorry...';
$language['NOT_AUTH_VIEW_NEWS']='You&rsquo;re not autorized to view the news!';
$language['NOT_AUTHORIZED']='You&rsquo;re not authorized to view the';
$language['NOT_AUTHORIZED_UPLOAD']='You&rsquo;re not authorized to upload!';
$language['NOT_AVAILABLE']='N/A';
$language['NOT_MAIL_IN_URL']='This is not the email address that was in this url';
$language['NOT_POSS_RESET_PID']='It&rsquo;s not possibile to reset your PID! <br />Contact an admin...';
$language['NOW_LOGIN']='Now you will be prompted for login';
$language['NUMBER_SHORT']='#';
$language['OLD_PWD']='Old Password';
$language['ONLY_REG_COMMENT']='Only registered users can insert comments!';
$language['OPT_DB_RES']='Optimizing database result';
$language['OPTION']='Option';
$language['PASS_RESET_CONF']='password reset confirmation';
$language['PEER_CLIENT']='Client';
$language['PEER_COUNTRY']='Country';
$language['PEER_ID']='Peer ID';
$language['PEER_LIST']='Peers List';
$language['PEER_PORT']='Port';
$language['PEER_PROGRESS']='Progress';
$language['PEER_STATUS']='Status';
$language['PEERS']='Peers';
$language['PEERS_DETAILS']='Click here to view peers details';
$language['PICTURE']='Picture';
$language['PID']='PID';
$language['PLEASE_WAIT']='Please Wait...';
$language['PM']='PM';
$language['POSITION']='Position';
$language['POST_REPLY']='Post Reply';
$language['POSTED_BY']='Posted by';
$language['POSTED_DATE']='Posted on';
$language['POSTS']='Posts';
$language['POSTS_PER_DAY']='%s posts per day';
$language['POSTS_PER_PAGE']='Posts per page';
$language['PREVIOUS']='Prev.';
$language['PRIVATE_MSG']='Private Message';
$language['PWD_CHANGED']='Password changed!';
$language['QUESTION']='Question';
$language['QUICK_JUMP']='Quick Jump';
$language['QUOTE']='Quote';
$language['RANK']='Rank';
$language['RATIO']='Ratio';
$language['REACHED_MAX_USERS']='Maximum number of users reached';
$language['READED']='Read';
$language['RECEIVER']='Receiver';
$language['RECOVER_DESC']='Use the form below to have your password reset and your account details mailed back to you.<br />(You will have to reply to a confirmation email.)';
$language['RECOVER_PWD']='Recover password';
$language['RECOVER_TITLE']='Recover lost username or password';
$language['REDIRECT']='if your browser doesn&rsquo;t have javascript enabled, click';
$language['REDIRECT2']='If your browser doesn&rsquo;t have javascript enabled, click <a href="%s">here</a>.';
$language['REDOWNLOAD_TORR_FROM']='Redownload torrent from';
$language['REGISTERED']='Registered';
$language['REGISTERED_EMAIL']='Registered email';
$language['REMOVE']='Remove';
$language['REPLIES']='Replies';
$language['REPLY']='Reply';
$language['RESULT']='Result';
$language['RETRY']='Retry';
$language['RETURN_TORRENTS']='Back to the torrent listing';
$language['REVERIFY_CONGRATS1']='<center><br />Congratulations, your email has been verified and successfully changed<br /><br /><strong>From: <font color="red">';
$language['REVERIFY_CONGRATS2']='</strong></font><br /><strong>To: <font color="red">';
$language['REVERIFY_CONGRATS3']='</strong></font><br /><br />';
$language['REVERIFY_FAILURE']='<center><br /><strong><font color="red"><u>Sorry but this url is not valid</u></strong></font><br /><br />A new random number is generated each time you attempt to change your email so<br />if you&rsquo;re seeing this message then you&rsquo;ve most likely tried to change your email<br />more than once and you are using an old url.<br /><br /><strong>Please wait until you&rsquo;re absolutely sure you haven&rsquo;t received the new<br />verification email before attempting to change your email again.</strong><br /><br />';
$language['REVERIFY_MSG']='If you attempt to change your email address you will be sent a verification link to the email address you wish to change it to.<br /><br /><font color="red"><strong>The email address on your record will not update until you verify the new address by clicking the link.</strong></font>';
$language['RIGHT']='right';
$language['SEARCH']='Search';
$language['SEEDERS']='Seeds';
$language['SEEN']='Seen';
$language['SELECT']='Select...';
$language['SENDER']='Sender';
$language['SENT_ERROR']='Sent Error';
$language['SHORT_C']='C'; //Shortname for Completed
$language['SHORT_L']='L'; //Shortname for Leechers
$language['SHORT_S']='S'; //Shortname for Seeders
$language['SHOUTBOX']='ShoutBox';
$language['SIZE']='Size';
$language['SORRY']='Sorry';
$language['SORTID']='Sortid';
$language['SPEED']='Speed';
$language['STICKY']='Sticky';
$language['SUB_CATEGORY']='Sub-Category';
$language['SUBJECT']='Subject';
$language['SUBJECT_MAX_CHAR']='Subject is limited to ';
$language['SUC_POST_SUC_EDIT']='Post was edited successfully.';
$language['SUC_SEND_EMAIL']='A confirmation email has been mailed to';
$language['SUC_SEND_EMAIL_2']='Please allow a few minutes for the mail to arrive.';
$language['SUCCESS']='Success';
$language['SUMADD_BUG']='Tracker bug calling summaryAdd';
$language['TABLE_NAME']='Table Name';
$language['TIMEZONE']='Timezone';
$language['TITLE']='Title';
$language['TOP']='top';
$language['TOP_10_ACTIVE']='10 Torrents Most active';
$language['TOP_10_BEST_SEED']='10 Torrents Best Seeders';
$language['TOP_10_BSPEED']='10 Torrents Best Speed';
$language['TOP_10_DOWNLOAD']='Top 10 Downloaders';
$language['TOP_10_SHARE']='Top 10 Best Sharers';
$language['TOP_10_UPLOAD']='Top 10 Uploaders';
$language['TOP_10_WORST']='Top 10 Worst Sharers';
$language['TOP_10_WORST_SEED']='10 Torrents Worst Seeders';
$language['TOP_10_WSPEED']='10 Torrents Worst Speed';
$language['TOP_TORRENTS']='Most Popular Torrents';
$language['TOPIC']='Topic';
$language['TOPICS']='Topics';
$language['TOPICS_PER_PAGE']='Topics per page';
$language['TORR_PEER_DETAILS']='Torrent peers details';
$language['TORRENT']='Torrent';
$language['TORRENT_ANONYMOUS']='Uploaded anonymously';
$language['TORRENT_CHECK']='Allow the tracker to retrieve and use information from the torrent file.';
$language['TORRENT_DETAIL']='Torrent&rsquo;s details';
$language['TORRENT_FILE']='Torrent File';
$language['TORRENT_SEARCH']='Search Torrents';
$language['TORRENT_STATUS']='Status';
$language['TORRENT_UPDATE']='Updating, please wait...';
$language['TORRENTS']='Torrents';
$language['TORRENTS_PER_PAGE']='Torrents per page';
$language['TRACK_DB_ERR']='Tracker/database error. The details are in the error log.';
$language['TRACKER_INFO']=$users.' users, tracking '.$torrents.' torrents ('.$seeds.' seeds, '.$leechers.' leechers, '.$percent.'%)';
$language['TRACKER_LOAD']='Tracker Load';
$language['TRACKER_SETTINGS']='Tracker&rsquo;s Settings';
$language['TRACKER_STATS']='Tracker Stats';
$language['TRACKING']='tracking';
$language['TRAFFIC']='Traffic';
$language['UCP_NOTE_1']='Here you can control your inbox, write PM to other users,';
$language['UCP_NOTE_2']='Control and modify your settings, etc...';
$language['UNAUTH_IP']='Unauthorized IP address.';
$language['UNKNOWN']='Unknown';
$language['UPDATE']='Update';
$language['UPFAILED']='Upload Failed';
$language['UPLOAD_IMAGE']='Upload Image';
$language['UPLOAD_LANGUAGE_FILE']='Upload Language File';
$language['UPLOADED']='Uploaded';
$language['UPLOADER']='Uploader';
$language['UPLOADS']='Uploads';
$language['URL']='URL';
$language['USER']='User';
$language['USER_CP']='My Panel';
$language['USER_CP_1']='User Control Panel';
$language['USER_DETAILS']='User Details';
$language['USER_EMAIL']='Valid email';
$language['USER_ID']='User ID';
$language['USER_JOINED']='Joined on';
$language['USER_LASTACCESS']='Last access';
$language['USER_LEVEL']='Rank';
$language['USER_LOCAL_TIME']='User&rsquo;s Local Time';
$language['USER_NAME']='User';
$language['USER_PASS_RECOVER']='Password/user recovery';
$language['USER_PWD']='Password';
$language['USERS_SEARCH']='Users Search';
$language['VIEW_DETAILS']='View details';
$language['VIEW_TOPIC']='View Topic';
$language['VIEW_UNREAD']='View Unread';
$language['VIEWS']='Views';
$language['VISITOR']='Visitor';
$language['VISITORS']='Visitors';
$language['WAIT_ADMIN_VALID']='You should wait for the administrator validation...';
$language['WARNING']='Warning!';
$language['WELCOME']='Welcome';
$language['WELCOME_ADMINCP']='Welcome to Admin Control Panel';
$language['WELCOME_BACK']='Welcome back';
$language['WELCOME_UCP']='Welcome to your User Control Panel';
$language['WORD_AND']='and';
$language['WORD_NEW']='New';
$language['WROTE']='wrote';
$language['WT']='WT';
$language['X_TIMES']='times';
$language['YES']='Yes';
$language['LAST_IP']='Last IP';
$language['FIRST_UNREAD']='Goto the first unread post';
$language['MODULE_UNACTIVE']='The module required is not active!';
$language['MODULE_NOT_PRESENT']='The module required do not exists!';
$language['MODULE_LOAD_ERROR']='The module required seems to be wrong!';

$language["CUSTOM_TITLE"]="Custom title";

// Seed Bonus -->
$language["BONUS_INFO1"]="Here you can exchange your Bonus Points (current ";
$language["BONUS_INFO2"]="(If the buttons are deactivated, you do not have enough to trade!)";
$language["BONUS_INFO3"]="What do I get points for?";
$language["BONUS_INFO3a"]="For every hour the system registers you as seeder";
$language["BONUS_INFO3b"]="<b>(uploading at";
$language["BONUS_INFO3c"]="KB/s or faster)</b>";
$language["BONUS_INFO3d"]="you will receive";
$language["BONUS_INFO3e"]="<b>(Up to a maximum of";
$language["BONUS_INFO3f"]="points per hour)</b>";
$language["BONUS_INFO4"]="points";
$language["BONUS_INFO4a"]="point";
$language["BONUS_INFO5"]="per torrent";
$language["BONUS_INFO6"]="You will receive";
$language["BONUS_INFO7"]="for each new torrent you upload. <b>(Subject to a";
$language["BONUS_INFO8"]="hour delay to give us time to check the torrent.)</b>";
$language["BONUS_INFO9"]="for each comment you make on a torrent.";
$language["BONUS_INFO10"]="for each post you make in the forum.";
$language["BONUS_INFO11"]="for each shout you make in the shoutbox.";
$language["BONUS_INFO12"]="for every hour you spend listening to our shoutcast radio stream.";
$language["WHAT_ABOUT"]="What is this about?";
$language["POINTS"]="Points";
$language["EXCHANGE"]="Exchange";
$language["GB_UPLOAD"]=" GB Upload";
$language["CHANGE_CUSTOM_TITLE"]="Change custom title (price - ";
$language["NO_CUSTOM_TITLE"]="none";
$language["UP_TO_VIP"]="Upgrade rank to VIP";
$language["FOR"]="for";
$language["NEED_MORE_POINTS"]="[need more points]";
$language["CHANGE_USERNAME"]="Change username (price - ";
$language["NEVER_EXPIRE"]="Never expire";
$language["SB_MAKE_A_GIFT"]="Make a points gift to another member";
$language["BAD_DATA"]="Bad post data!";
$language["GIFT_TOO_BIG"]="Your gift too big, the maximum individual gift is";
$language["GIFT_USER_NOT_FOUND"]="The user you want to send a gift to is not found in our database!";
$language["GIFT_NOT_ENOUGH"]="You don't have that many points!";
$language["GIFT_PM_SUBJ_1"]="You've received a gift!";
$language["GIFT_PM_SUBJ_2"]="You've sent a gift!";
$language["GIFT_PM_REC_1"]="has sent you a gift of";
$language["GIFT_PM_REC_2"]="bonus points. Please be sure to send a thank you."."\n\n".((substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")?"[img]".$BASEURL."/images/smilies/thumbsup.gif[/img]":":thumbsup:");
$language["GIFT_PM_SEND_1"]="This PM is to confirm you sent";
$language["GIFT_PM_SEND_2"]="a gift of";
$language["GIFT_PM_SEND_3"]="bonus points. These points have now been deducted from your total and transferred to";
$language["GIFT_PM_SEND_4"]="\n\n".((substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")?"[img]".$BASEURL."/images/smilies/thumbsup.gif[/img]":":thumbsup:");
$language["GIFT_PM_SYS"]="\n\n"."[b][color=red]This is a system PM so please don't respond![/color][/b]";
$language["BONUS_VIP_CONFIRM"]="Are you sure you want to exchange for";
// <-- Seed Bonus

// Donation History by DiemThuy -->
$language['DON_HISTORIE']='These Members Keep This Site Alive , Thank You Guys';
$language['NO_DON_HIST'] = 'No donation history available yet';
$language['DON_HIST'] = 'Donation History';
$language['DON_AMT'] = 'Donation Amount';
$language['DONATIONS'] = 'Donations';
$language['DON_CONFIRM'] = 'We got your donation, thank you!';
$language['DONATION'] = 'Donation';
$language['USERNAME'] = 'Username';
$language['AMOUNT'] = 'Amount';
// <-- Donation History by DiemThuy


$language['TR_TIMED_RANK_SET'] = 'Timed Rank Settings';
$language['TR_NEW_RANK'] = 'New Rank';
$language['TR_OLD_RANK'] = 'Old Rank';
$language['TR_TIME_TO_EXP'] = 'Time to expire';
$language['TR_WEEK'] = 'Week';
$language['TR_WEEKS'] = 'Weeks';
$language['TR_ONE_MONTH'] = 'One Month';
$language['TR_HALF_YEAR'] = 'Half Year';
$language['TR_ONE_YEAR'] = 'One Year';
$language['TR_TWO_YEARS'] = 'Two Years';
$language['TR_SUBJECT'] = 'Your rank has changed!';
$language['TR_MSG_PART_1'] = 'Your rank has changed to';
$language['TR_MSG_PART_2'] = 'this is a timed rank and it will expire';
$language['TR_MSG_PART_3'] = 'after that you will get your old rank';
$language['TR_MSG_PART_4'] = 'back';
$language['TR_MSG_PART_5'] = 'This is an automated system message so DO NOT reply!';
$language['TR_UNAUTH'] = 'Unauthorised access!';
$language['TR_ID_OR_LEV_INV'] = 'id or level invalid!';
$language['TR_NOT_OWN_RANK'] = "You can't change your own rank";
$language['TR_NOT_HIGHER'] = "You can't change a users rank to a level higher than your own.";
$language['TR_NOT_HIGHER_2'] = "You can't edit a member with a rank higher than or equal to your own.";
$language['TR_BOTH_THE_SAME'] = "You can't change the rank to the same thing it is currently.";
$language["TR_EXP_SUBJ"] = "Your timed rank has expired!";
$language["TR_EXP_MSG_1"] = "Your rank has changed back to";
$language["TR_EXP_MSG_2"] = "[color=red][b]This is an automated system message so DO NOT reply![/b][/color]";
$language['TR_MONTH'] = 'Month';
$language['TR_MONTHS'] = 'Months';
$language['TR_YEAR'] = 'Year';
$language['TR_YEARS'] = 'Years';
$language['TR_DAY'] = 'Day';
$language['TR_DAYS'] = 'Days';

//GOLD
$language["GOLD_TYPE"]="Torrent type";
$language["GOLD_PICTURE"]="Gold picture";
$language["SILVER_PICTURE"]="Silver picture";
$language["BRONZE_PICTURE"]="Bronze picture";
$language["GOLD_DESCRIPTION"]="Gold description";
$language["SILVER_DESCRIPTION"]="Silver description";
$language["BRONZE_DESCRIPTION"]="Bronze description";
$language["CLASSIC_DESCRIPTION"]="Classic description";
$language["GOLD_LEVEL"]="Who can add gold/silver torrents";
$language["IS_GOLD"]="Gold";
$language["IS_SILVER"]="Silver";
$language["IS_BRONZE"]="Bronze";
$language["IS_ALL"]="Free";
$language["GOLD_PERCENT"]="Gold download percentage";
$language["SILVER_PERCENT"]="Silver download percentage";
$language["BRONZE_PERCENT"]="Bronze download percentage";
$language["GOLD_FL"]="Free Leech";

$language['FL_TO'] = 'Until';
$language['FL_NOT_TODAY'] = 'Not Today';
$language['FL_FREE_LEECH'] = 'Free Leech';
$language['FL_START_TIME'] = 'Next Happy Hour Starts';
$language['FL_ITS_HH'] = 'It\'s Happy Hour';


$language["FILE_UPLOAD_TO_BIG"]="File size to big for upload!! Limit";
$language["IMAGE_WAS"]="Image size";
$language["MOVE_IMAGE_TO"]="Could not move image to";
$language["CHECK_FOLDERS_PERM"]="Please check the folder permissons and try again.";
$language["ILEGAL_UPLOAD"]="Ilegal upload!! This is not a image<br>Please press back and try again";
$language["IMAGE"]="Image";
$language["SCREEN"]="Screenshots";

$language["AFR_PM_1"] = "At some point in the past you downloaded";
$language["AFR_PM_2"] = "This torrent no longer has any seeds and";
$language["AFR_PM_3"] = "would like to download it, if you still have those files on your computer please can you join the torrent as a seed.".'\n\n'."Thank You".'\n\n'."[color=red][b]THIS IS AN AUTOMATED SYSTEM MESSAGE SO PLEASE DON'T REPLY[/b][/color]".'\n';
$language["AFR_PM_SUBJ"] = "Reseed Request";
$language["AFR_INFO_1"] = "Reseed requested";
$language["AFR_INFO_2"] = "A PM has been sent to all members who have completed this torrent.";
$language["AFR_ERR_1"] = "Reseed Error";
$language["AFR_ERR_2"] = "Someone has already done a reseed request on this torrent within the last 5 days.";
$language["AFR_RESEED"] = "Request a Reseed";

$language['AUTORANK_STATE']='Autorank State';
$language['AUTORANK_POSITION']='Autorank Position';
$language['AUTORANK_MIN_UPLOAD']='Autorank (Up/Down)load Trigger';
$language['AUTORANK_IN_BYTES']=' (in bytes)';
$language['AUTORANK_MIN_RATIO']='Autorank Ratio Trigger';
$language['AUTORANK_SMF_MIRROR']='SMF Forums Rank Mirror';
$language['AUTORANK_IPB_MIRROR']='IPB Forums Rank Mirror';
$language['AUTORANK_SMF_LIST']='<b><u>Current SMF Group List from the database</u></b><br />';
$language['AUTORANK_IPB_LIST']='<b><u>Current IPB Group List from the database</u></b><br />';

$language['AUTORANK_PM_DEMOTE_SUBJ']='You have been demoted';
$language['AUTORANK_PM_PROMOTE_SUBJ']='You have been promoted';

$language['AUTORANK_PM_GREET']='Hello';

$language['AUTORANK_PM_DEMOTE_1']='As a result of your tracker stats decreasing you have been automatically demoted from the rank of';
$language['AUTORANK_PM_DEMOTE_2']='to the rank of';
/* If you want to add some kind of "get your act together" type message, you can add it below. */
$language['AUTORANK_PM_DEMOTE_3']='';

$language['AUTORANK_PM_PROMOTE_1']='As a result of your tracker stats increasing you have been automatically promoted from the rank of';
$language['AUTORANK_PM_PROMOTE_2']='to the rank of';
/* If you want to add some kind of "congratulations, keep it up" type message, you can add it below. */
$language['AUTORANK_PM_PROMOTE_3']='';

// Report users & Torrents by DiemThuy -->
$language["REP_ALLUSERS"] = "Make a report";
$language["REP_ADMIN"]="Reported Users & Torrents Administration";
$language["REP_SUC_REP"] = "Successfully Reported";
$language["REP_STAFF_WILL_CHECK"] = "A member of staff will look into the problem as soon as possible";
$language["REP_ALR_REP"] = "You have already reported";
$language["REP_ERR"] = "Report Error";
$language["REP_INV_ID"] = "Invalid User ID";
$language["REP_NO_STAFF"] = "Staff can't be reported";
$language["REP_NOT_SELF"] = "you can't report yourself";
$language["REP_USER"] = "Report User";
$language["REP_TORR"] = "Report Torrent";
$language["REP_CONF_1"] = "Are you sure you would like to report";
$language["REP_CONF_2"] = "Please note, this is <b>not</b> to be used to report Hit & Runners, this is done by the tracker itself<br /><br /><b>Reason</b>";
$language["REP_CONF_3"] = "Reason";
$language["REP_INV_TORR"] = "Invalid Torrent ID";
$language["REP_NEED_REASON"] = "You must enter a reason for the report";
$language['REP_BY'] = 'Reported By';
$language['REP_REPORTING'] = 'Reporting';
$language['REP_TYPE'] = 'Type';
$language['REP_REASON'] = 'Reason';
$language['REP_DEALT_WITH'] = 'Dealt With';
$language['REP_MARK'] = 'Mark As Dealt With';
$language['REP_REPORTS'] = 'Reports';
// <-- Report users & Torrents by DiemThuy

$language['BOOT_EXP'] = 'Your Ban time has expired!';
$language['BOOT_EXP_MSG'] = 'You are no longer Banned , please be careful to not make the same mistake again!';
$language['BOOT_GIVE'] = 'You got Booted!';
$language['BOOT_GIVE_REA'] = 'The reason You got booted is:';
$language['BOOT_GIVE_WHO'] = 'By:';
$language['BOOT_GIVE_EXP'] = 'Expire Date';
$language['BOOT_RM_SUB'] = 'Your Ban is canceled!';
$language['BOOT_RM_MSG'] = 'Your Ban is now canceled!';
$language['BOOT_DISABLED'] = 'DISABLED USER!';
$language['BD'] = 'Ban Data';
$language['RFB'] = 'Reason for the Ban';
$language['ET'] = 'Expire Time';
$language['AB'] = 'added by';
$language["RB"] = "Remove Ban";
$language["BS"] = "Ban Settings";
$language["AM"] = "Admin Menu";
$language["BT"] = "Ban Time";
$language["BM"] = "Ban Motivation";


$language["IMDB_EDIT_FORM"] = "The numbers after tt in the url.";
$language["IMDB_UL_FORM"] = "&nbsp;<b>tt<b><input type='text' name='imdb' size='10' maxlength='200' />&nbsp;{$language['IMDB_EDIT_FORM']}";
$language["IMDB_NOT_ADDED"] = "No IMDB ID has been added..";
$language["IMDB_RESIZE_ERR"] = "Resizable window will not work without Javascript.<br />Please enable Javascript or view the Info in a new window";
$language["IMDB_EXTRA"] = "IMDB Extra";
$language["IMDB_MORE_INFO"] = "More Info";
$language["IMDB_COVER"] = "Cover";
$language["IMDB_NO_PHOTO"] = "No photo available";
$language["IMDB_LANGUAGES"] = "Languages";
$language["IMDB_GENRE"] = "Genre";
$language["IMDB_ALL_GENRES"] = "All Genres";
$language["IMDB_RATING"] = "Rating";
$language["IMDB_VOTES"] = "Votes";
$language["IMDB_TAGLINE"] = "Tagline";
$language["IMDB_PLOT_OUTLINE"] = "Plot Outline";
$language["IMDB_PLOT"] = "Plot";
$language["IMDB_TAGLINES"] = "Taglines";
$language["IMDB_YEAR"] = "Year";
$language["IMDB_RUNTIME"] = "Runtime";
$language["IMDB_MINUTES"] = "minutes";
$language["IMDB_CACHE_CON"] = "IMDB Cache Contents";
$language["IMDB_MOV_DET"] = "Movie Details";
$language["IMDB_PAGE"] = "IMDB page";
$language["IMDB_NO_PHOTO"] = "No photo available";
$language["IMDB_AKA"] = "Also known as";
$language["IMDB_SEASONS"] = "Seasons";
$language["IMDB_AGE_CLASS"] = "Age Classification";
$language["IMDB_COUNTRY"] = "Country";
$language["IMDB_COLORS"] = "Colors";
$language["IMDB_SOUND"] = "Sound";
$language["IMDB_DIRECTOR"] = "Director";
$language["IMDB_WRITING_BY"] = "Writing By";
$language["IMDB_WRITER"] = "Writer";
$language["IMDB_ROLE"] = "Role";
$language["IMDB_PRODUCED_BY"] = "Produced By";
$language["IMDB_PRODUCER"] = "Producer";
$language["IMDB_MUSIC"] = "Music";
$language["IMDB_MUSICIAN"] = "Musician";
$language["IMDB_ACTOR"] = "Actor";
$language["IMDB_CAST"] = "Cast";
$language["IMDB_PLOT_OUTLINE"] = "Plot Outline";
$language["IMDB_PLOT"] = "Plot";
$language["IMDB_EPISODE"] = "Episode";
$language["IMDB_EPISODES"] = "Episodes";
$language["IMDB_SEASON"] = "Season";
$language["IMDB_ORIG_AIR_DATE"] = "Original Air Date";
$language["IMDB_USER_COMMENTS"] = "User Comments";
$language["IMDB_MOVIE_QUOTES"] = "Movie Quotes";
$language["IMDB_TRAILERS"] = "Trailers";
$language["IMDB_CR_CRED"] = "Crazy Credits";
$language["IMDB_CR_CRED_1"] = "We know about";
$language["IMDB_CR_CRED_2"] = "One of them reads";
$language["IMDB_GOOFS"] = "Goofs";
$language["IMDB_GOOFS_1"] = "Here comes one of them";
$language["IMDB_TRIVIA"] = "Trivia";
$language["IMDB_TRIVIA_1"] = "There are";
$language["IMDB_TRIVIA_2"] = "entries in the trivia list - like these";
$language["IMDB_TRIVIA_3"] = "trivia records. Some examples";
$language["IMDB_SOUNDTRACKS"] = "Soundtracks";
$language["IMDB_SOUNDTRACK"] = "Soundtrack";
$language["IMDB_SOUNDTRACKS_1"] = "soundtracks listed - like these";
$language["IMDB_CREDIT"] = "Credit";
$language["IMDB_CAUSE"] = "Cause";
$language["IMDB_BIRTH_NAME"] = "Birth Name";
$language["IMDB_NICKNAMES"] = "Nickname(s)";
$language["IMDB_BODY_HEIGHT"] = "Body Height";
$language["IMDB_SPOUSES"] = "Spouse(s)";
$language["IMDB_SPOUSE"] = "Spouse";
$language["IMDB_PERIOD"] = "Period";
$language["IMDB_COMMENT"] = "Comment";
$language["IMDB_KIDS"] = "Kids";
$language["IMDB_MINI_BIO"] = "Mini Bio";
$language["IMDB_TM"] = "Trademarks";
$language["IMDB_SALARY"] = "Salary";
$language["IMDB_MOVIE"] = "Movie";
$language["IMDB_CHAR"] = "Character";
$language["IMDB_PUBL"] = "Publications";
$language["IMDB_AUTHOR"] = "Author";
$language["IMDB_TITLE"] = "Title";
$language["IMDB_ISBN"] = "ISBN";
$language["IMDB_BIO_MOVIES"] = "Biographical movies";
$language["IMDB_INTERVIEW"] = "Interview";
$language["IMDB_INTERVIEWS"] = "Interviews";
$language["IMDB_DETAILS"] = "Details";
$language["IMDB_PERF_SEARCH"] = "Performing IMDB search for";
$language["IMDB_NAME"] = "Name";
$language["IMDB_SCAN"] = "Scanning IMDB...";
$language["IMDB_SEARCH"] = "IMDb";
$language["IMDB_VIEW"]="View on IMDB";
$language["IMDB_GENRE"]="Genre";
$language['TVDB'] = "TVDB";
//RULES
$language["RULES_SORT"]="Rule num(sort)";
$language["RULES"]="Rules";
$language["RULE"]="Rule";
$language["RULE_ALL"]="All rules";
$language["MNU_RULES"]="Rules";
$language["RULES_ADD"]="Insert rule";


// Seedbox
$language["SB_HS_TORRENT"] = "high speed torrent";
$language["SB_SEEDBOX"] = "Seedbox";
$language["SB_SS_SETTINGS"] = "Show Seedbox Settings";
$language["SB_MITU"] = "Minimum rank to use";
// Seedbox

$language["ANN_NEW_USER"] = "A warm [color=red]WELCOME[/color] to our newest member:";
$language["ANN_NEW_TORR"] = "[color=red]NEW UPLOAD[/color]:";
$language["ANN_NEW_INT"] = "[color=red]NEW INTERNAL UPLOAD[/color]:";
$language["ANN_ADDED_BY"] = "[color=red]ADDED BY[/color]:";

$language["DOB"]="Date of Birth";
$language["STICKY_TORRENT"]="<b>Sticky</b>";
$language["STICKY_TORRENT_EXPLAIN"]="(Always on top of the torrent list)";


// Helpdesk
$language["HELPDESK"]="Help Desk";
$language["HD_WEEK"]="week";
$language["HD_WEEKS"]="weeks";
$language["HD_DAY"]="day";
$language["HD_DAYS"]="days";
$language["HD_HOUR"]="hour";
$language["HD_HOURS"]="hours";
$language["HD_MIN"]="min";
$language["HD_MINS"]="mins";
$language["HD_SORRY"]="Sorry";
$language["HD_NOT_AUTHORIZED"]="You are not authorized to view this.";
$language["HD_RTF"]="Read the FAQ";
$language["HD_RTF2"]="First read the [b]FAQ[/b] and then start asking questions!";
$language["HD_STF"]="Search forums";
$language["HD_STF2"]="Search the [b]FORUMS[/b] please.";
$language["HD_DN"]="Die n00b";
$language["HD_DN2"]="Die n00b! even my grandma knows how to do that!";
$language["HD_ON"]="on";
$language["HD_PROBLEM"]="Problem";
$language["HD_SOLVED"]="Solved";
$language["HD_ANSWER"]="Answer";
$language["HD_IGNORED"]="Ignored";
$language["HD_BB"]="<b>BB tags</b> are <b>allowed</b>";
$language["HD_IGNORE"]="IGNORE";
$language["HD_ADDED"]="Added";
$language["HD_ADDEDBY"]="Added by";
$language["HD_SOLVEDBY"]="Solved - by";
$language["HD_SOLVEDIN"]="Solved In";
$language["HD_DELPROB"]="Delete solved and/or ignored problems";
$language["HD_S_FAST"]="Solved Fast";
$language["HD_S_INTIME"]="Solved in Time";
$language["HD_S_LATE"]="Solved too late";
$language["HD_S_REPLIES"]="Standard Replies";
$language["HD_USE"]="Use";
$language["HD_MSG1"]="[color=red][b]From the $SITENAME HELPDESK [/b][/color]";
$language["HD_MSG2"]="regards";
$language["HD_MSG3"]="staff member";
$language["HD_HELP_DESK"]="Help desk";
$language["HD_MSG_SENT"]="Message sent! Please await your reply.";
$language["HD_WELCOME_1"]="welcome staff member";
$language["HD_WELCOME_2"]="there are";
$language["HD_WELCOME_3"]="unanswered questions waiting";
$language["HD_WELCOME_MSG"]="Here you can ask your questions and post your problems but before using the <b>Helpdesk</b> please check if your question has already been answered in the <a href=index.php?page=forum><b>Forum</b></a> first.";
$language["HD_HELPME"]="Help me!";
// Helpdesk

$language["NOT_USER_CLASS"]="<h2>Sorry</h2><p>You must be registered to be able to buy tickets.</p>";
$language["CANNOT_SELL_CLOSED"]="Sorry, I cannot sell you any tickets! The lottery is closed!";
$language["LOTTERY"]="Lottery";
$language["LOTT_LIMIT_PURCHASE"]="The max number of tickets you can purchase is";
$language["LOTT_LIMIT_BUY"]="The max number of tickets allowed to buy is";
$language["LOTTERY_PM_SUBJECT"]="You have won a prize in the lottery";
$language["LOTTERY_PM_MESSAGE"]="Congratulations you have won a prize on our Lottery. Your prize has been added to your account.";
$language['RESET_PID'] = 'Reset PID';

$language["SB_BANNED"] = "<br /><center><img src='images/denied.gif'><br />Sorry you are banned from using the Shout Box!<br />You will need to speak to a member of staff";


$language["LED_WELCOME"] = '** Welcome **';
$language["LED_TO"] = '++ To ++';
$language["LED_UPLOADED"] = 'you have uploaded';
$language["LED_ERR"] = 'If you were using a Java-enabled browser, you would see an animated scrolling text sign that looks like this:';
$language["LED_ACT_TOR"] = 'Active Torrents';
$language["LED_LAST_VISIT"] = 'Last Visit';
$language["LED_CURRTIME"] = 'The current time is';
$language["LED_TODAYIS"] = 'Today is';

$language["GRAB_YDT"] = "Your Downloaded Torrents";
$language["GRAB_AL_DOWN"] = "Already Downloaded!!";
$language["GRAB_STILL_ACTIVE"] = "still active";
$language["GRAB_NOT_ACTIVE"] = "not active";

$language['TORRENT_OPTIONS']='Search in';
$language['FIL']='Filename';
$language['FILDES']='File & Descr';
$language['DES']='Description';
$language['SUBC']='Sub Cat.';

# Language definitions added by TreetopClimber.
$language['EXTRA']='extra';
$language['DROPDOWN']='dropdown';
$language['ALTLOGIN']='altlogin';
$language["DJ_SETTINGS"]="Dj Settings";
$language['TORRENT_MENU']='Torrent Menu';
$language['USER_MENU']='User Menu';
$language['USER_LINKS']='User Links'; # New User Link, for all those other links.
$language['ADMIN_MENU']='FM Admin'; # New FM Admin Menu Link
$language['ADMIN_ACCESS']='Tracker Admin'; # changed name to tracker admin since we are using FM
$language['STAFF_ACCESS']='Staff';
$language['UPLOAD_LINK']='Torrent Upload';
$language['ADAREA']='ads';
# End

// Sport Betting - Start
$language["SB_BETTING"] = "Betting";
$language["SB_SITE_BETTING"] = "Site Betting";
$language["SB_NO_BETS_ATM"] = "No bets at the moment";
$language["SB_CURR_BETS"] = "Current Bets";
$language["SB_BET_ADMIN"] = "Bet Admin";
$language["SB_WAGERS"] = "Wagers";
$language["SB_TL"] = "Top list";
$language["SB_INFO"] = "Info";
$language["SB_BET"] = "Bet";
$language["SB_CHECK_LATER"] = "<i>Unfortunately, there are no active bets right now. Come back later! :)</i>";
$language["SB_TGCTNO"] = "This game closes to new bets:";
$language["SB_TIME_LEFT"] = "Time remaining";
$language["SB_MINUTES"] = "minutes";
$language["SB_ACC_DEN"] = "Access Denied!!";
$language["SB_SILLY_RABBIT"] = "Silly Rabbit";
$language["SB_NO_OPT"] = "Enter at least one option ya nugget!";
$language["SB_ADMIN"] = "Admin";
$language["SB_BET_INFO"] = "Bet Info";
$language["SB_END_BETS"] = "End Bets";
$language["SB_BET_TITLE"] = "Bet title";
$language["SB_BETTING_ON"] = "Betting On";
$language["SB_ENTER_WAGER"] = "Enter your wager here";
$language["SB_ENDTIME"] = "Endtime";
$language["SB_MINS"] = "mins";
$language["SB_HOUR"] = "hour";
$language["SB_HOURS"] = "hours";
$language["SB_DAY"] = "day";
$language["SB_DAYS"] = "days";
$language["SB_WEEK"] = "week";
$language["SB_WEEKS"] = "weeks";
$language["SB_ORDERING"] = "Ordering";
$language["SB_BY_ID"] = "By ID";
$language["SB_BY_ODDS"] = "By Odds";
$language["SB_SUBMIT"] = "Submit";
$language["SB_CREATOR"] = "Creator";
$language["SB_SET_ACTIVE"] = "Set Active";
$language["SB_ADD_OPTIONS"] = "Add options";
$language["SB_GAMES"] = "Games";
$language["SB_TOP_LIST"] = "Top List";
$language["SB_POINTS"] = "Points";
$language["SB_WINNER"] = "Winner";
$language["SB_LOSER"] = "Loser";
$language["SB_POSITION"] = "Position";
$language["SB_SORRY"] = "Sorry";
$language["SB_NO_ACCESS"] = "You are not permitted to view this page.";
$language["SB_NO_ACT_GAMES"] = "You have no active games.";
$language["SB_BET_OPT"] = "Bet Option";
$language["SB_ODDS"] = "Odds";
$language["SB_POY_PAY"] = "Potential payout";
$language["SB_AMOUNT_WAGERED"] = "Amount wagered";
$language["SB_CANT_DEL_1"] = "You can't delete a game that people have already placed bets on.";
$language["SB_CANT_DEL_2"] = "Click here";
$language["SB_CANT_DEL_3"] = "to delete the game and refund any bets that have already been placed.";
$language["SB_CANT_DEL_4"] = "You're trying to delete an option that people have already placed bets on. You'll need to";
$language["SB_CANT_DEL_5"] = "Once you've done this you can recreate the game with new options.";
$language["SB_ADD_BETS"] = "Add Bets";
$language["SB_WARNING"] = "! Warning !";
$language["SB_CLICK_TO_PAY"] = "Click on the winning option, to pay out the winners!";
$language["SB_BET_RES"] = "Betting results";
$language["SB_NO_POST"] = "No post found";
$language["SB_BET_WIN"] = "Bet win!";
$language["SB_BET_PROFIT"] = "Bet profit +";
$language["SB_PM_MESS_1"] = "You have just accrued";
$language["SB_PM_MESS_2"] = "Bonus Points on Bet!"."\n"."You played";
$language["SB_PM_MESS_3"] = "points on";
$language["SB_PM_MESS_4"] = "Option";
$language["SB_PM_MESS_5"] = "which gave";
$language["SB_PM_MESS_6"] = "times the bet!"."\n\n";
$language["SB_PM_MESS_7"] = "\n\n"."To see the full results of the Bet follow this link:"."\n\n";
$language["SB_FOR_MESS_1"] = "Number of bets wagered on the game";
$language["SB_FOR_MESS_2"] = "Total Bonus points in the turnover of the game";
$language["SB_FOR_MESS_3"] = "Winning option";
$language["SB_FOR_MESS_4"] = "The game was ended by";
$language["SB_FOR_MESS_5"] = "Options and odds";
$language["SB_FOR_MESS_6"] = "Top 20 Winners";
$language["SB_FOR_MESS_7"] = "Bonus Points";
$language["SB_FOR_MESS_8"] = "to";
$language["SB_FOR_MESS_9"] = "who invested";
$language["SB_FOR_MESS_10"] = "Top 20 Losers";
$language["SB_PM_MESS2_1"] = "Unfortunately it turned out that your investment in";
$language["SB_PM_MESS2_2"] = "did not yield any dividends!"."\n"."Better luck next time!"."\n\n";
$language["SB_BET_LOSS"] = "Bet loss!";
$language["SB_CREATE_BETS"] = "Create Bets";
$language["SB_BONUS"] = "Bonus";
$language["SB_BETINF"] = "Bet information!";
$language["SB_BETINF_MSG"] = "Site-Bet is an odds / betting system that is similar to other real betting sites on the web.<br />If you are not at home with betting systems it will still be easy to understand.<br /><br /><li>With Site-Bet you use your seed bonus points only.</li><li>When you bet points on a result, you'll get the points you bet multiplied by the odds of your choice.</li><li>Your efforts are binding and can not be undone.</li><li>The odds are variable.</li><li>The odds and the payment amount for profits can be increased or reduced by adding your wager.</li><br />It is the result after full time that counts, so what you waiting on? Start betting now!<br /><br /><b>Banks keep 3% of paying profits, only to control the inflation of bonus points.</b>";
$language["SB_BAD_ID"] = "No game with that ID.";
$language["SB_NO_BON_LOG"] = "No bonus log with similar message.";
$language["SB_OP_LOG_1"] = "Number of operations and bonus logs entered did not match.";
$language["SB_OP_LOG_2"] = "vs."; // Short for versus
$language["SB_OP_LOG_3"] = "Fuck it...";
$language["SB_OP_LOG_4"] = "Do it anyway";
$language["SB_RET_POINTS_1"] = "You have got back the";
$language["SB_RET_POINTS_2"] = "Points you bet on";
$language["SB_RET_POINTS_3"] = "It was reset because of errors or unfinished/unplayed matches.";
$language["SB_BET_REBATE"] = "Betting Rebate";
$language["SB_BBAS"] = "Bet-bonus at stake";
$language["SB_SOFTBET"] = "Softbet";
$language["SB_MY_GAMES"] = "My Games";
$language["SB_AMOUNT"] = "Amount";
$language["SB_CANT_UNDO"] = "Note that you cannot undo this";
$language["SB_NOT_ENOUGH_POINTS"] = "You don't have enough bonus points!";
$language["SB_BET_TOO_LOW"] = "You can't bet zero or under!";
$language["SB_MAX_BET_1"] = "The maximum bet is";
$language["SB_MAX_BET_2"] = "bonus points!";
$language["SB_ALREADY_BET"] = "You've already invested in this game!";
$language["SB_ADD_OPT_TO_BET"] = "Add options to your wager!";
$language["SB_OPT_TXT"] = "Option text";
$language["SB_ADD_TO_GAME"] = "Add to game";
$language["SB_ADD_1X2"] = "Add 1, X, 2";
$language["SB_SAVE_CHANGES"] = "Save Changes";
$language["SB_CLICK"] = "Click";
$language["SB_HERE"] = "Here";
$language["SB_DEL_GAME"] = "to delete the game.";
$language["SB_DEL_AND_REPAY"] = "to delete the game and repay everyone's points.";
$language["SB_SHOUT_1"] = "[color=red]New Bet[/color]";
$language["SB_SHOUT_2"] = " - Endtime: ";
$language["SB_SHOUT_3"] = "Go to Bet";
$language["SB_OPTIONS"] = "Options";
// Sport Betting - End

// Torrents Limit
$language["TORRENTS_LIMIT"] = "Torrents Limit";
$language["ENTER_NEG"] = "Enter a negative value eg <b><span style='color:#0000FF'>-1</span></b> to reset to the default for the rank";

// Enhanced Waiting Time
$language["WAITING_TIME"] = "Waiting Time (hours)";

// Auto Duplicate Torrent Checker
$language["TOP_MATCHES"] = "These are the top matches in our database based upon the torrent filename, please ensure you are not uploading a duplicate torrent before proceeding.";

// Whois
$language["WHOIS"] = "Whois";

// Ban Button
$language["ERR_REG_IP_BANNED"] = "I'm sorry but due to abuse, registrations from your IP address are currently banned!";
$language["DTBAN"]="IP Ban";

// Torrent Nuked/Requested
$language["TNR_REL_REQ"]="This release was requested.";
$language["TNR_REQUESTED"]="Requested";
$language["TNR_NUKED"]="Nuked";

// Torrent moderation
$language["TMOD_APR1"] = "your torrent";
$language["TMOD_APR2"] = "is approved!";
$language["TMOD_APR3"] = "\n\n"."[color=red][b]Do not reply, this is an automatic message.[/b][/color]";
$language["TMOD_SOR1"] = "Sorry";
$language["TMOD_SOR2"] = "but";
$language["TMOD_SOR3"] = "has been rejected for the following reason";
$language["TMOD_SOR4"] = "\n\n"."[color=red][b]Do not reply, this is an automatic message.[/b][/color]";
$language["TMOD_SEN1"] = "Your message has been sent.";
$language["TMOD_SEN2"] = "You have to give a reason.";
$language["TMOD_OK"] = "OK";
$language["TMOD_BAD"] = "Bad";
$language["TMOD_UM"] = "Unmoderated";
$language["TMOD_S_MOD"] = "Mod.";
$language["TMOD_S_CAT"] = "Cat.";
$language["TMOD_Dl"] = "Dl";
$language["TMOD_NOTORR"] = "No torrents unmodered.";
$language["ACP_ADD_WARN"]="Torrent moderation resaons";
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
$language["FRM_CONFIRM_VALIDATE"] = "Reset to unmoderated";
$language["MODERATE_PANEL"] = "Mod Torrent Panel";
$language["TMOD_EDIT_TO_RESEND"] = "<br/>(Edit to resend for validation)";
$language["TMOD_APPROVED_BY"] = "Approved by";
$language["TMOD_REJECTED_BY"] = "Rejected by";

// Uploader Medals
$language["UM_BRONZE"] = "Bronze Medal";
$language["UM_SILVER"] = "Silver Medal";
$language["UM_GOLD"] = "Gold Medal";
$language["UM_UPL_MED"] = "Upload Medal";
$language["UM_MED"] = "Med";
$language["UM_NICK"] = "Nickname";
$language["UM_TOR"] = "Tor";
$language["UM_UP_COUNT_1"] = "Upload count (last";
$language["UM_UP_COUNT_2"] = "days)";
$language["UM_NOTHING_TO_SEE"] = "nothing to see here!";

// NFO Hack
$language["NFO_NFO"] = "NFO";
$language["NFO_NOT_NFO"] = "Not an nfo file!";
$language["NFO_NOT_VALID"] = "Not a valid nfo or too small!";
$language["NFO_CANT_MOVE"] = "Error moving nfo file!";
$language["NFO_UNCHECK"] = "<b>Uncheck</b> to remove or upload a new nfo";
$language["NFO_OPTION"] = "Optionally choose to browse for an nfo file";
$language["NFO_SHOW_HIDE"] = "Show | Hide NFO";

// Teams Hack
$language["TEAMS_TEAM"]="Team";
$language["TEAM_ERROR"]="You don't seem to have permission to view this file";
$language['WS_WARNED_USER'] = 'WARNED USER!';
$language['WS_WARN_REMOVED_SUBJECT'] = 'Your Warning time has expired!!';
$language['WS_WARN_REMOVED_MESSAGE'] = 'You are no longer Warned, please be careful to not make the same mistake again!!';
$language['WS_WD'] = 'Warning Data';
$language['WS_RFW'] = 'Reason for increasing the Warning';
$language['WS_ET'] = 'Expire Time';
$language['WS_WT_PLURAL'] = 'Warned Times';
$language['WS_WAB'] = 'Warn added by';
$language['WS_AM'] = 'Admin Menu';
$language['WS_RW'] = 'Remove Warning';
$language['WS_WS'] = 'Warning Settings';
$language['WS_WT'] = 'Warn Time';
$language['WS_D'] = 'Day';
$language['WS_W'] = 'Week';
$language['WS_W_PLURAL'] = 'Weeks';
$language['WS_Y'] = 'Year';
$language['WS_WM'] = 'Warn Motivation';
$language['WS_WC_SUBJ'] = 'Warning level decreased';
$language['WS_WC_MSG'] = 'We have decreased your Warning level for the following reason';
$language['WS_WCF'] = 'Warning canceled for';
$language['WS_WR'] = 'Warning removed';
$language['WS_YHRAW'] = 'Warning level increased';
$language['WS_TRFW'] = 'We have increased your Warning level for the following reason';
$language['WS_EDFW'] = 'Expire date for the warning';
$language['WS_WU'] = 'Warned User';
$language['WS_R'] = 'Reason';
$language['WS_WARNED_USERS'] = 'Warned users';
$language['WS_WL'] = 'Warning Level';
$language['WS_WARN'] = 'Warn';

// More Warn system definitions
$language['WS_SEND_PM'] = "PM user";
$language['WS_CANT_WARN'] = "You can't warn yourself!";
$language["WS_UNK_TYPE"] = "Unknown Type!";
$language['WS_SUBMIT'] = "Submit";
$language['WS_MUST_GIVE_REASON'] = "You must give a reason for the warning!";
$language['WS_RFRW'] = 'Reason for decreasing the Warning';
$language["WS_CANT_DEC"] = "You cannot decrease the warning level any further!";
$language["WS_CANT_INC"] = "You cannot increase the warning level any further!";
$language["WS_WARN_EXP"] = "Warn Expiry (days)";
$language["WS_BLANK_4_INF"] = "(Leave Blank for a Permanant warning)";
$language["WS_AUTO_MSG"] = "[b][color=red]This is an automated message, please do not respond[/color][/b]";
$language["WS_YOUR_CUR_LEV"] = "Your current warn level is";
$language["WS_DEC_IN_DAYS_1"] = "As long as you don't receive any further warnings your warn level will decrease automatically in";
$language["WS_DEC_IN_DAYS_2"] = "days.";
$language["WS_WARNLOG"] = "Warn Log";
$language["WS_NEXT_AUTO_DOWNGRADE"] = "Next automatic downgrade";
$language["WS_WARNED_BY"] = "Warned By";
$language["WS_NOTES"] = "Notes";
$language["WS_NOTHING_2_C"] = "Nothing to see here!";
$language["WS_LOGS_4"] = "Saved warn logs for";
$language["WS_INC_WL"] = "Increased Warning Level";
$language["WS_DEC_WL"] = "Decreased Warning Level";
$language['WS_INC'] = "Increase warning level";
$language['WS_DEC'] = "Decrease warning Level";
$language["WS_AUTO_REASON"] = "Automatic Warn Level Decrease";
$language["WS_WARNED_ON"] = "Warned on";
$language["WS_REP_ON"] = "Reprieved on";
$language["WS_REP_BY"] = "Reprieved By";
$language["WS_WHY_BOOTED"] = "Automatic boot for reaching the maximum warn level";

// Circling Last Torrents
$language["CIRC_NEW_REL"] = "Newest Releases";
$language["CIRC_NO_TORR"] = "Currently no torrents...";
$language["CIRC_SEEDERS"] = "Seeders";
$language["CIRC_LEECHERS"] = "Leechers";

//Private Shouts
$language['SHOUTBOXP']='Private Shouts';

// Block Comments
$language["BC_AB_ERR"] = "Abuse Error";
$language["BC_U_R_BANNED"] = "You are banned from making comments due to abuse!! If you think this is a mistake please contact a member of staff.";
$language["BC_COM_LOCKED"] = "Comments are locked";
$language["BC_OVERALL_ABUSE"] = "Due to abuse, comment posting has been disabled on this torrent!";

// Account Parked
$language["PARK_PARKED"] = "(Parked)";
$language["PARK_ACC_PARKED"] = "Account Parked";
$language["PARK_ACC_PARKED_INFO_1"] = "Your account is currently parked. To unpark your account please";
$language["PARK_ACC_PARKED_INFO_2"] = "click here";
$language["PARK_PARK_ACC"] = "Park Account";

// Hit & Run
$language["HNR_BLOCK_SETTINGS"] = "Hit & Run Block Settings";
$language["HNR_EVENT_DATE"] = "Did a HIT & RUN on";
$language["USERNAME"] = "Username";
$language["SEEDING_TIME"] = "Seeding Time";
$language["NO_HR"] = "No Hit & Runners found";
$language["HNR_WARN_DEC"] = "Automatic Hit & Run decrease!";
$language["HNR_WARN_INC"] = "Automatic Hit & Run increase!";
$language["HNR_CANT_DOWN"] = "You are not permitted to download any new torrents due to your Hit & Run record, to unlock torrent downloads you will need to seed what you've already downloaded!";

// Low Ratio Warn & Ban System
$language["RAT_SUBJ"] = "Low Ratio Warning!";
$language["RAT_SUBJ_2"] = "Low Ratio Warning Two!";
$language["RAT_SUBJ_3"] = "Final Low Ratio Warning!";
$language["RAT_NOTHING_YET"] = "Nothing to see yet";
$language["RAT_WARN_X"] = "warn x";
$language["RAT_BANNED"] = "banned";

// Hide Online Status
$language["HOS_INV_2_OTHERS"] = "Invisible to other users";
$language["HOS_HIDDEN"] = "Hidden";

// Upload Multiplier
$language["UPM_UPL_MULT"] = "Upload Multiplier";
$language["UPM_RANK_INV"] = "Rank Invalid";

// Proxy / Blacklist
$language['CHANGE_CONFIRM']='Are you sure you want to change this users download rights?';
$language['CHANGED']='Change';

//Auto Images
$language["IMG_SUCCESS"]="<center><h4>Image Succesfully Processed!<br>Click the Image to insert into the Description.</h4></center>";
$language["IMG_INFO"]="<center>Images Searched against your File Name. Click to use.</center>";

// New Comment Layout
$language["NCL_COM_EDIT"] = "Comment Edit";

//FAQ
$language["MNU_FAQ"]="F.A.Q.";
$language["FAQ_NAME"]="Faq group name";
$language["FAQ_TEXT"]="Faq group description";
$language["FAQ_SORT_INDEX"]="Faq group sort index";
$language["FAQ_ADD"]="Insert Faq group";
$language["FAQ_QUESTION"]="Faq question";
$language["FAQ_ANSWER"]="Answer";
$language["FAQ_QUESTION_ADD"]="Insert Faq guestion/answer";
$language["FAQ_QUESTION_SEARCH_ALL"]="Search all...";
$language["FAQ_AGREE"]="I have read and agree to follow the terms set out in this FAQ.";

// Torrent Bookmarks
$language["TB_FAV"] = "Bookmarked Torrents";
$language["TB_BOOKMARK"] = "Bookmark This Torrent";
$language["BOOKMARK"]="Your Bookmarked Torrents";
$language["ADDB"]="Bookmark";
$language["TB_DOWN"] = "Down";
$language["TB_BOOKMARKED"] = "Bookmarked";
$language["TB_ALREADY_BOOK"] = "Torrent already bookmarked";
$language["TB_NO_TORR_EXISTS"] = "No torrent exists for the supplied info hash";
$language["TB_NOTHING_TO_SEE"] = "Nothing to see here yet";
$language["NEW_BOOKMARK"] = "Bookmark";

// Birthday hack
$language["DOB"]="Date of Birth";
$language["DOB_FORMAT"]="<b>Day (DD) / Month (MM) / Year (YYYY)</b>";
$language["USER_AGE"]="Age";
$language["HB_SUBJECT"]="Happy Birthday";
$language["HB_MESSAGE_1"]=":hbd:\n\nYour account has been credited with ";
$language["HB_MESSAGE_2"]=" of upload credit. (";
$language["HB_MESSAGE_3"]=" GB for every year of your life). The staff of $SITENAME wish you all the best for the future.\n\n:yay:";
$language["ERR_BORN_IN_FUTURE"]="Time Traveller huh? You can't be born in the future!";
$language["ERR_DOB_1"]="I don't believe you are ";
$language["ERR_DOB_2"]=" years old.";
$language["INVALID_DOB_1"]="Entered date of birth (";
$language["INVALID_DOB_2"]=") is invalid";

$language["CANT_VIEW_PAGE"] = "I'm sorry, you are not permitted to view this page!";

$language["UN_ADDED_BY"] = "Added By";
$language["UN_NOTE"] = "Note";
$language["UN_NOTES"] = "Notes";
$language["UN_ADD_NOTE"] = "Add Note";

$language['REALCOUNTRY']='IP Country';
//advanced torrent search extra
$language['UPLS']='Uploaders';

$language["UN_BONUS_GENERAL_1"]="has spent";
$language["UN_BONUS_GENERAL_2"]="bonus points on";
$language["UN_VIP_RANK"]=" a VIP rank.";
$language["UN_ONE_INV"]="one invite.";
$language["UN_THREE_INV"]="three invites.";
$language["UN_FIVE_INV"]="five invites.";
$language["UN_GIFT_SEND_1"]="has sent";
$language["UN_GIFT_SEND_2"]="a gift of";
$language["UN_GIFT_SEND_3"]="bonus points.";
$language["UN_GIFT_REC_1"]="has received a gift of";
$language["UN_GIFT_REC_2"]="bonus points from";
$language["UN_UL_CREDIT"]="of upload credit.";
$language["UN_UL_USERNAME"]="a username change to";
$language["UN_UL_TITLE"]="the custom title of";
$language["UN_DONATE_1"]="has made a donation of";
$language["UN_DONATE_2"]="and received";
$language["UN_DONATE_3"]="of upload credit";
$language["UN_DONATE_4"]="VIP rank until";
$language["UN_DONATE_5"]="days";
$language["UN_DONATE_6"]="VIP rank for a further";
$language["UN_DONATE_7"]="as this member is staff their rank was not affected.";
$language["UN_DONATE_8"]="Freeleech slots.";
$language["UN_WLEV_INC"]="Warn Level increased, refer to the Warn Log for more details";
$language["UN_WLEV_DEC"]="Warn Level decreased, refer to the Warn Log for more details";
$language["UN_AUTORANK_1"]="has had his/her rank automatically changed from";
$language["UN_AUTORANK_2"]="to";
$language["UN_AUTORANK_3"]="by Autorank";
$language["UN_AUTORANK_4"]="U";    // Short for Uploaded
$language["UN_AUTORANK_5"]="D";    // Short for Downloaded
$language["UN_AUTORANK_6"]="SR";   // Short for Share Ratio
$language["UN_AUTORANK_7"]="Inf."; // Short for Infinite
$language["UN_BOOTED"]="has been automatically booted for reaching the maximum warn level";
$language["UN_MAN_BOOTED_1"]="has been manually booted until";
$language["UN_MAN_BOOTED_2"]="for";
$language["UN_UNBOOTED"]="has been manually unbooted";
$language["UN_BAN_BUT_1"]="has been banned via the Ban Button for";

//end of month paypal setting diemthuy
$language["AADS_AUTO"] ="Auto set new month";
//for forced faq.
$language["SUBMIT"] ="Submit";

$language["STAFF_COMMENT"]="Staff comment";

$language["QUAR_PM_SUBJ"]="Suspected Hacking Attempt";
$language["QUAR_PM_MSG_1"]="tried to upload a file containing php code. This file was quarantined";
$language["QUAR_PM_MSG_2"]="It is however possible this is a false negative so please check this file with a hex editor or something before banning this user."."\n\n"."This attempt was made via";
$language["QUAR_OUTPUT"]="Your attempt to upload a file containing php code has been thwarted and you have been reported to the site Owner!";
$language["QUAR_ERR"]="Quarantine Error";

$language["QUAR_DIR_PROBLEM_1"]="Quarantine Directory";
$language["QUAR_DIR_PROBLEM_2"]="does not exist, please set a valid Quarantine Directory in [b]Admin Panel-->Security Suite Settings[/b]";
$language["QUAR_DIR_PROBLEM_3"]="is not writable, please CHMOD to 0777";
$language["QUAR_UNABLE"]="Unable to quarantine file due to unforseen error, please check your other PM's for details of how to resolve this issue";
$language["QUAR_NOT_SET"]="Directory not set";

$language["QUAR_TMP_FILE_MISS"]="Can't find the temp file!";


$language["UIMG"]="User Images & Titles";
$language["UIMG_NO_ICONS"]="You have no user icons yet";
$language["UIMG_TM_NO_ICONS"]="This member has no user icons yet";
$language["UIMG_MSG_1"]="Welcome";
$language["UIMG_MSG_2"]="here you can see all available user images/titles including your own (if you have any)";
$language["UIMG_MSG_3"]="Your User Images";
$language["UIMG_USR_ICONS"]="User Icons";
$language["UIMG_USR_IMGS"]="User Images";

//shoutbox clean
$language["SHOUT_CLEANED"]="[b]Shoutbox Just got cleaned![/b][IMG]".$BASEURL."/images/sweep.gif[/IMG]";

$language["ERR_PASS_TOO_WEAK_1"]="Your password is too weak.<br />For security reasons it must contain at least";
$language["ERR_PASS_TOO_WEAK_1A"]="The password is too weak.<br />For security reasons it must contain at least";
$language["ERR_PASS_TOO_WEAK_2"]="lower case letter";
$language["ERR_PASS_TOO_WEAK_2A"]="lower case letters";
$language["ERR_PASS_TOO_WEAK_3"]="upper case letter";
$language["ERR_PASS_TOO_WEAK_3A"]="upper case letters";
$language["ERR_PASS_TOO_WEAK_4"]="number";
$language["ERR_PASS_TOO_WEAK_4A"]="numbers";
$language["ERR_PASS_TOO_WEAK_5"]="symbol";
$language["ERR_PASS_TOO_WEAK_5A"]="symbols";
$language["ERR_PASS_TOO_WEAK_6"]="Here is a strong password you may want to use";
$language["SECSUI_ACC_PWD_1"]="Your password needs:";
$language["SECSUI_ACC_PWD_1A"]="The password needs:";
$language["SECSUI_ACC_PWD_2"]="To be at least";
$language["SECSUI_ACC_PWD_3"]="character in length";
$language["SECSUI_ACC_PWD_3A"]="characters in length";
$language["SECSUI_ACC_PWD_4"]="To have at least";
$language["SECSUI_ACC_PWD_5"]="lower case letter";
$language["SECSUI_ACC_PWD_5A"]="lower case letters";
$language["SECSUI_ACC_PWD_6"]="upper case letter";
$language["SECSUI_ACC_PWD_6A"]="upper case letters";
$language["SECSUI_ACC_PWD_7"]="number";
$language["SECSUI_ACC_PWD_7A"]="numbers";
$language["SECSUI_ACC_PWD_8"]="symbol";
$language["SECSUI_ACC_PWD_8A"]="symbols";

$language["DIRECT_LINK"]="Direct Download<br />(valid url)";
$language["DIRECT_DOWNLOAD"]="Direct Download";

$language["AM_ABOUT_ME"] = "About Me";

$language["MTS_ANNURL"] = "Announce URL";
$language["MTS_SEED"] = "Seeders";
$language["MTS_LEECH"] = "Leechers";
$language["MTS_DOWN"] = "Downloaded";

$language["LAST_LOCATION"]="Last location";
$language["WHEN_LOCATION"]="When";
$language["WATCH_LOG"]="Watch Log";

$language["PARTNERS"]="Our Partners";
$language["PAR_SURE_DEL"]="Are you sure you want to delete this partner?";
$language["PAR_BANNER"]="Banner";
$language["PAR_NAME"]="Name";
$language["PAR_LINK"]="Link";
$language["PAR_ADDEDBY"]="Added By";
$language["PAR_EDDEL"]="Edit/Delete";
$language["PAR_NO_PART"]="No partners so far...";
$language["PAR_NO_PART_2"]="No partner with that id";
$language["PAR_ADD_NEW"]="Add A New Partner";
$language["PAR_TITLE"]="Title";
$language["PAR_BAN_URL"]="Banner URL";
$language["PAR_LINK"]="Link";
$language["PAR_3RD_PARTY"]="Some sites disable hotlinking of images so it is recommended to host it on a third party site.";
$language["PAR_UPDATE"]="Update";
$language["PAR_ED_PART"]="Edit Partner";
$language["PAR_CUR_BAN"]="Current Banner";
$language["PAR_BACK"]="Back";

$language['details_similar_torrents'] = "Similar torrents";
$language['details_name'] = "Name";
$language['details_seeders'] = "Seeders";
$language['details_leechers'] = "Leechers";
$language['details_size'] = "Size";
$language['details_date'] = "Added";

$language["SHORT_EXTERNAL"]="EXT";
$language["LOGS_PHP"]="PHP Error Log";
$language["LOGS_LINE_AMT"]="<b>Line amount:</b>";
$language["LOGS_LINE_AMT_1"]="<b>How many lines to show of the log</b>";
$language["LOGS_COOLY_NAME"]="<b>Log Name:</b>&nbsp;The name you wish to call your logs. Think of something authentic.";
$language["LOGS_COOLY_NAMES"]="This will be the same name for each log apart from the date stamp.";
$language["LOGS_COOLY_PATH"]="<b>Log Path:</b>&nbsp;Above doc root would be a good choice \"if possible\" no forward slash<br /> and folder must be writable.If you have an open basedir restriction you are best to keep the current path.";
$language["LOGS_COOLY_PATHS"]="Recommended:";
$language["LOGS_COOLY_NOTE"]="<b>If u change path to another doc root dir be sure to copy the .htaccess to the new dir.</b>";
$language["LOGS_COOLY_LIST"]="The list of old logs in your folder.";
$language["LOGS_COOLY_FLUSH"]="Flush out</a> old logs";
$language['SSL'] = "Force SSL:";
$language['SSL_DESC'] = "&nbsp;Force a Secure Connection in Tracker.";
$language['ADDTHIS_SHARE']='Share';
$language['ADDTHIS_SHARE2']='Share with friends';

$language["REFRESH_PEERS"]="Refresh Peers";

$language["SB_GET_1_INV"]="Get 1 Invite";
$language["SB_GET_3_INV"]="Get 3 Invites";
$language["SB_GET_5_INV"]="Get 5 Invites";
$language["SB_SHORT_MAXIMUM"]="Max.";
$language["SB_DECREASE_HNR"]="Remove oldest Hit & Run";
$language["SB_OLDEST_HNR"]="Your oldest Hit & Run";
$language["SB_NO_HNR"]="No Hit & Runs found";

$language["HNR_NOT_ENOUGH"]="Not enough bonus points to purchase a Hit & Run removal";
$language["HNR_ABBREVIATION"]="H&Rs";

$language["SP_SHOW_PORN"] = "Show Porn?";

$language["PRIVATE"]="Private Profile";
$language["PP_PRIVATE"]="Private";
$language["PP_PUBLIC"]="Public";
$language["PP_PROFILE"]="Profile";

$language["LANGUAGE"]="Language";
$language["LANG_ENG"]="English";
$language["LANG_FRE"]="French";
$language["LANG_DUT"]="Dutch";
$language["LANG_GER"]="German";
$language["LANG_SPA"]="Spanish";
$language["LANG_ITA"]="Italian";
$language["LANG_FIN"]="Finnish";
$language["LANG_GRE"]="Greek";
$language["LANG_ICE"]="Icelandic";
$language["LANG_JAP"]="Japanese";
$language["LANG_KOR"]="Korean";
$language["LANG_LAT"]="Latin";
$language["LANG_NOR"]="Norwegian";
$language["LANG_PHI"]="Phillipino";
$language["LANG_POL"]="Polish";
$language["LANG_POR"]="Portuguese";
$language["LANG_SLO"]="Slovenian";
$language["LANG_RUS"]="Russian";
$language["LANG_CAS"]="Castillian";
$language["LANG_SWE"]="Swedish";
$language["LANG_TUR"]="Turkish";
$language["LANG_DAN"]="Danish";
$language["LANG_CZE"]="Czech";
$language["LANG_CHI"]="Chinese";
$language["LANG_BUL"]="Bulgarian";
$language["LANG_ARA"]="Arabic";
$language["LANG_VIE"]="Vietnamese";


$language['MPLAYER']='Media Clip';
$language['MPLAYERNON']='Media Clip Not Available';

$language["SIGNATURE"]="Forum Signature";

$language["TOT_MOST_ONLINE"]="Top 10 Online Times";
$language["TOT_TIME_IS"]="Your total online time is";
$language["TOT_ONLINE_TIME"]="Online Time";

$language["LDB_AGO_LEG"]="Ago Legend: d=day, w=week, m=min, h=hour, s=second.";
$language["LDB_AGO_NTSH"]="Nothing to see here";
$language["LDB_DB_EMPTY"]="The database is empty";

$language["IMGUP_DIM_TOO_BIG_1"]="Sorry, your image dimensions are too big.<br />The maximum dimensions are:";
$language["IMGUP_DIM_TOO_BIG_2"]="Pixels.<br /><br />Your image is:";
$language["IMGUP_DIM_TOO_BIG_3"]="Pixels.<br /><br />Please resize your image and try again.";

// Friends DT
$language["FL_FRIENDLIST"]="Friendlist";
$language["FL_UNFRIEND"]="Are you sure you want to unfriend this user?";
$language["FL_REFRIEND"]="Are you sure you want to be friends with this user?";
$language["FL_REJECT"]="Are you sure you want to reject this users offer of friendship?";
$language["FL_REMOVE"]="Are you sure you want to delete this pending friendship request?";
$language["FL_FPENDING"]="Pending Requests";
$language["FL_FFRIEND"]="Friend Requests";
$language["FL_FAVATAR"]="Avatar";
$language["FL_FUN"]="User Name";
$language["FL_FUL"]="User Level";
$language["FL_FRD"]="Request Date";
$language["FL_FFD"]="Friends Since";
$language["FL_FFF"]="Friends of";
$language["FL_FRDD"]="Reject Date";
$language["FL_FRU"]="Reject User";
$language["FL_FCONF"]="Confirmed Friends";
$language["FL_FREJ"]="Rejected Users";
$language["FL_FRR"]="Remove Request";
$language["FL_FSTAT"]="Status";
$language["FL_FRE"]="Re-Friend";
$language["FL_FUF"]="Un-Friend";
$language["FL_FATF"]="Add To Friends";
$language["FL_FMF"]="Mutual Friend";
$language["FL_W2BF"]="Want to be Friends";
$language["FL_FRREQ"]="Friendship Request!";
$language["FL_W2BF2"]="wants to be friends with you."."\n\n"."Please go to your friendlist to accept or reject this request";
$language["FL_AUTOMSG"]="\n\n"."[b][color=red]AUTOMATIC SYSTEM MESSAGE - PLEASE DON'T REPLY !![/color][/b]";
$language["FL_ALRFR"]="This member is already a friend of yours.";
$language["FL_SELFFR"]="You can't be friends with yourself, right?";
$language["FL_REQDEL"]="Friendship Request Deleted!";
$language["FL_DELREQ_1"]="has deleted the friendship request."."\n\n"."It's therefore a pretty good bet that";
$language["FL_DELREQ_2"]="doesn't want to be friends after all."."\n\n"."For that reason you will no longer see";
$language["FL_DELREQ_3"]="in your request list any more.";
$language["FL_FRACC_SUBJ"]="Friendship Accepted!";
$language["FL_FRACC_MSG"]="has accepted your friendship request.";
$language["FL_FRCOMMON"]="\n\n"."You can see in your friendlist that the status has changed.";
$language["FL_CHANGEDMIND"]="wants to be friends with you again"."\n\n"."Go to your friend list to accept or reject this request";
$language["FL_FRREJ_SUBJ"]="Friendship Rejected!";
$language["FL_FRREJ_MSG"]="has rejected your friendship."."\n\n"."You can see in your friendlist that the status has changed.";
$language["FL_NOPENFRO"]="You have no outgoing friend requests pending right now!";
$language["FL_NOPENFRI"]="You have no incoming friend requests pending right now!";
$language["FL_OFFLINE"]="Offline";
$language["FL_ONLINE"]="Online";
$language["FL_NOFRIENDS"]="You have no friends right now!";
$language["FL_NOREJECTS"]="You have no rejected or ex-friends right now!";
$language["FL_FRIENDS"]="Friends";
$language["FL_THISISU"]="This is you!";
$language["FL_HASNOFRIENDS"]="This user has no friends right now!";

$language["BUMP_THIS_TORR"]="Bump to the top";

$language["ARC_NEW"]="New";
$language["ARC_ARC"]="Archived";
$language["ARC_UPLOAD_TYPE"]="Upload type";
$language["ARC_ERR_NO_ARC"]="You don't have permission to view the details of Archived torrents!";
$language["ARC_ERR_NO_NEW"]="You don't have permission to view the details of New torrents!";
$language["ARC_ERR_NO_BOTH"]="You don't have permission to view the details of New or Archived torrents!";

$language["FLS_FREE_SLOTS"]="Freeleech Slots";
$language["FLS_DONATE_INFO_1"]="Get <span style='color:red;'>one</span> Freeleech slot for every";
$language["FLS_DONATE_INFO_2"]="you donate.<br />(These can be used to create Custom Free torrents of your own choosing)";
$language["FLS_LOCKED"]="Locked";
$language["FLS_UNLOCKED"]="Unlocked";
$language["FLS_CUSTOM_FL"]="Custom freeleech";
$language["FLS_ALREADY_HAVE"]="You already have this torrent selected as a custom freeleech torrent";
$language["FLS_NONE_REMAINING"]="You have no freeleech slots remaining";
$language["FLS_FREE_BY_OTHER"]="This torrent is already free by other means.";
$language["FLS_PLS_CONFIRM"]="Please confirm your action";
$language["FLS_R_U_SURE1"]="Are you sure you want to use a freeleech slot on this torrent?<br />You have";
$language["FLS_R_U_SURE2A"]="freeleech slot remaining.";
$language["FLS_R_U_SURE2B"]="freeleech slots remaining.";
$language["FLS_USED_SLOT1"]="Used freeleech slot on the";
$language["FLS_USED_SLOT2"]="torrent";
$language["FLS_USED_SLOT3"]="Return to torrents";
$language["TOW_NONE_ATM"]="<b>No torrent of the week at the moment!</b>";
$language["TOW_SEEDS"]="seeds";
$language["TOW_LEECH"]="leechers";
$language["TOW_EXPIRES"]="Expires:";
$language["CAPTCHA_ERROR"]="The reCAPTCHA wasn't entered correctly. Go back and try it again." ."(reCAPTCHA said:";
$language["TCOM_AUTOPM_1"]="has added a comment to your torrent";
$language["TCOM_AUTOPM_2"]="This is an automated system message."."\n"."If you wish to turn it off please edit your tracker profile.";
$language["TCOM_AUTOPM_SUBJ"]="Torrent Comment Added";
$language["TCOM_COMMENTPM"]="Comment Notification";
$language["ERR_NAME_BANNED"]="This username is banned";
$language["NO_POLLS"]="<b>No polls at the moment!</b>";
$language["TOTAL_VOTES"]="Total votes";
$language["DISCUSS_POLL"]="Discuss/vote in this Poll";
$language["BONUS_INFO13"]="You will receive an additional";
$language["BONUS_INFO14"]="per hour if you are seeding an archived torrent.";
$language["FLS_BONUS_GET"]="Get 1 Freeleech slot";
$language["FLS_NOT_ENOUGH"]="You don't have enough bonus points to get a Freeleech slot!";
$language["FLS_SLOTS"]="Freeleech slots";
$language["ERR_NEEDS_RECONFIG_1"]="The rank permissions for";
$language["ERR_NEEDS_RECONFIG_2"]="hack need reconfiguring.";
$language["ERR_NEEDS_RECONFIG_3"]="Please inform the site administrators of this error message.";
$language["AUTOTOPIC_CLICK_HERE"]="click here";
$language["TVDB_EP_NAME"]="Episode Name";
$language["TVDB_GUESTS"]="Guest Stars";
$language["TVDB_AIRED"]="Aired";
$language["TVDB_NETWORK"]="Network";
$language["TVDB_SHOW_AIRS"]="Show Airs";
$language["TVDB_AIRS_1"]="at";
$language["TVDB_AIRS_2"]="for";
$language["TVDB_AIRS_3"]="minutes";
$language["TVDB_NO_OVERVIEW"]="[No episode overview added]";
$language["TVDB_UL_TITLE"]="TheTVDB Series ID";
$language["TVDB_UL_1"]="&nbsp;&nbsp;&nbsp;";
$language["TVDB_UL_2"]="The number after <span style='color:lime;font-weight:bold;'>&id=</span>, for EXAMPLE <a href='http://thetvdb.com/?tab=series&id=79349' target='_blank'>Dexter</a> (http://thetvdb.com/?tab=series&id=<span style='color:lime;font-weight:bold;'>79349</span>).";
$language["SYSTEM_USER"]="System";

$language["PRUNE_WARN_SUBJ"]="Account prune warning";
$language["PRUNE_WARN_SUBJ2"]="Account pruned";
$language["PREUS_PKA"]="<span style='color:lime;'>Previously Known As:</span>";
$language["PREUS_PUN"]="Previous username?";
$language["IBD_NEED_TO_INTRODUCE_1"]="In order to download torrents from this tracker you must first";
$language["IBD_NEED_TO_INTRODUCE_2A"]="create a new";
$language["IBD_NEED_TO_INTRODUCE_2B"]="add to our";
$language["IBD_NEED_TO_INTRODUCE_3"]="introduction topic.<br /><br />You can do this";
$language["MAGNET_DOWN_USING"]="Download this torrent using magnet";
$language["PFET_NO_UPLOAD_1"]="Your rank (";
$language["PFET_NO_UPLOAD_2"]=") does not have permission to upload external torrents to this tracker.";
$language["ETH_START_DATE"]="Started";
$language["ETH_COMP_DATE"]="Completed";
$language["ETH_LAST_ACTION"]="Last Action";
$language["NOT_AUTH_REQ"]="You are not authorised to view this section.";

$language["MNU_FHOST"]="File Hosting";
$language["FHOST"]="File Hosting";

# Language expected/offer torrents start
$language['viewexpected']='View Expected/To Offer Torrents';
$language['EXPECTED_V']='Expected/To Offer Torrents';
$language['EXPECTED_VV']='Offer Votes View';
$language['EX_NAME']='Want This ?';
$language['EXPECTED_D']='Expected/To Offer Torrent Details';
$language['EXPECTED_E']='Edit Expected/To Offer Torrent';
$language['INC_DEAD']='Inc. dead';
$language['ADD_EXPECTED']='Add a new expected/to offer torrent';
$language['EXPECTED']='Expected';
$language['EXPECVOTE']='Expected/Vote';
$language['OFFER']='To Offer';
$language['VIEW_MY_EXPECTED']='View my expected/to offer torrents';
$language['VIEW_ONLY']='View Only';
$language['TYPE']='Type';
$language['FIND_EXPECT']='Find';
$language['GO']='Go';
$language['WRITE_CATEGORY']='Select Category!';
$language['NO_NAME']='No Name!';
$language['NO_DESCR']='Description Empty!';
$language['EXP_ADD_SUCCES']='was added to the Expected section';
$language['MUST_SEL_EXP']='You must select at least one expected torrent to delete.';
$language['DELETED']='Deleted';
$language['RETURN_EXPECT']='Go back to';
$language['DATE_EXPECTED']='Date expected';
$language['TORR_LINK']='Torrent Link';
$language['TORR_CLICK']='Click here to go to the torrent';
$language['FILL_INFO']='If you did upload the torrent , fill in the info below';
$language['VOTE_EXPECTED']='Vote for this ';
$language['OFFER_A']='Offer';
$language['OFFER_N']='Nothing Here Yet';
$language['OF_USER']='Username';
$language['TEXT_DTA']='<p>You have already voted for this offer, only 1 vote for each offer is allowed</p></b>';
$language['TEXT_DTB']='Successfully voted';
$language['TEXT_DTC']='Your vote is added to this offer';
$language['TEXT_DTD']='Only needed for expected torrents!';
# Language expected/offer torrents end

#Notepad Start
$language['NOTEPAD']=' Personal Notepad ';
$language['NOTEPAD1']='(';
$language['NOTEPAD2']=')';
$language['NOTEPAD3']=' notes';
$language['NOTE_ADD_NEW']='Add new personal note';
$language['NOTE_DATETIME']='Date/Time';
$language['NOTE_DEL_ERR']='You must select at least one note to delete.';
$language['NOTE_EDIT']='Edit';
$language['NOTE_EDIT_ERROR']="You shouldn't try to edit other people's notes !";
$language['NOTE_ID']='ID';
$language['NOTE_NOTE']='Note';
$language['NOTE_VIEW']='Read';
$language['NOTE_READ_ERROR']="You shouldn't try to read other people's notes !";
$language['NOTE_VIEW_MORE']='View more notes';
#Notepad End

#RG
$language["RG"]="Release Group";
$language["SiMPLE"]="SiMPLE-NoHaTE";
$language["BluRG"]="BluRG";
$language["Legion"]="LEGi0N";
#RG

$language['ULR']='Upload REQ';

#Bug Reports Start
$language['stderr_error']='Error';
$language['stderr_only_coder']='Only site-coders can do this! And you know it!';
$language['stderr_no_na']='You can\'t choose NA option!';
$language['stderr_invalid_id']='Invalid ID';
$language['stderr_only_staff_can_view']='Only staff can view bugs';
$language['stderr_missing']='You missing something?';
$language['stderr_problem_20']='We can\'t use a problem text there is less then 20 chars.';
$language['stderr_title_10']='We can\'t use a title there is less then 10 chars.';
$language['stderr_sucess']='Sucess';
$language['stderr_sucess_2']='Your bug has been sent to our coder.<br/>You have choosen priority: %s';
$language['stderr_something_is_wrong']='There was a error.. Please try again.';
$language['low']='Low';
$language['high']='High';
$language['veryhigh']='Very High';
$language['fixed']='Fixed';
$language['ignored']='Ignored';
$language['select_one']='Select one';
$language['fix_problem']='Fix this problem';
$language['ignore_problem']='Ignore this problem';
$language['title']='Title';
$language['added']='Added';
$language['by']='By';
$language['priority']='Priority';
$language['problem_bug']='Problem (Bug)';
$language['status']='Status';
$language['coder']='Coder';
$language['proper_title']='Please choose a proper title.';
$language['describe_problem']='Describe the problem as best as possible';
$language['only_veryhigh_when']='Choose only very high if the bug really is a problem for using the site.';
$language['submit_btn_fix']='Fix!';
$language['submit_btn_send']='Send this bug!';
$language['go_back']='Go back';
$language['h1_count_bugs']="There is <font color='#FF0000'>%s</font> new bug%s. Please check them";
$language['delete_when']='All solved bugs will be deleted after 2 weeks (from added date).';
$language['no_bugs']='There is no bugs =]. Good coder we have xD';
$language['MNU_BUGS']='Report a Bug';
#Bug Reports End

$language['DEL_REASON']="Reason: ";
$language['SEEDWANTED']='Seed Wanted';

#Fav Uploader
$language["FAV_UP"]="Favorite Uploader";
$language["FAV_UP_UP"]="Favorite Uploader Uploaded Torrent";
#Fav Uploader End

#Tracker Block
$language["MEMBERSNEWTODAY"]="Registered Today";
$language["MEMBERSNEWMONTH"]="New This Month";
$language["BANNED_IP"]="Banned IPs";
#Tracker Block

#Unvalidated
$language['ERR_NOT_VALIDATED_1'] = 'Your account is not yet validated so access to this site is blocked. If you wish to resend the validation email to the account listed on your record';
$language['ERR_NOT_VALIDATED_2'] = 'please click the button below.<br /><br />If you have already attempted this and are still having problems then you can change the email to another one by clicking ';
$language['RESEND_VALIDATION_MAIL'] = 'Resend Validation Mail';
$language['BLOCK_SEND_VALIDATION_MAIL'] = 'Send Validation Mail';
$language['RESENT_VALIDATION'] = 'resent their validation email';
$language['VALIDATION_SENT_TO_1'] = 'A validation email has been sent to:';
$language['VALIDATION_SENT_TO_2'] = 'You will need to click on the link contained within the email in order to validate your account. The email should arrive within 10 minutes (usually instantly) although some email providers may mark it as SPAM so be sure to check your SPAM folder if you can\'t find it.<br /><br />If you still don\'t receive the email after this point then you should change your email address on your profile by clicking ';
#Unvalidated

#IRC
$language['IRC'] = 'IRC';
#IRC

?>
