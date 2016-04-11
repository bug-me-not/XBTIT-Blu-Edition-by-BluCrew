<?php
$language['DELETE_READED']='Delete';
$language['USER_LANGUE']='Language';
$language['USER_STYLE']='Style';
$language['CURRENTLY_PEER']='You&rsquo;re currently seeding or leeching some torrent.';
$language['STOP_PEER']='You must stop your client.';
$language['USER_PWD_AGAIN']='Repeat password';
$language['EMAIL_FAILED']='Sending email has failed!';
$language['NO_SUBJECT']='No subject';
$language['MUST_ENTER_PASSWORD']='<br /><font color="#FF0000"><strong>You must enter your password to change the settings above.</strong></font>';
$language['ERR_PASS_WRONG']='Password empty or incorrect, cannot update profile.';
$language['MSG_DEL_ALL_PM']='If you select PMs which are not read, they will not be deleted';
$language['ERR_PM_GUEST']='Sorry you can&rsquo;t send PM to guest or to yourself!';


//INVITATION SYSTEM
global $SITENAME, $BASEURL, $SITEEMAIL, $btit_settings;

$language['ACCOUNT_CONFIRMED']='Account Confirmed';
$language['CONFIRMED']='Confirmed';
$language['DATE_SENT']='Date Sent';
$language['ERR_EMAIL_ALREADY_EXISTS']='This e-mail address already exists in our database.';
$language['ERR_INVITATIONS_OFF']='Sorry, invitation system is deactivated.';
$language['MISSING_DATA']='Missing information!<br />Please, fill in all necessary fields.';
$language['INSERT_EMAIL']='Empty e-mail address field!';
$language['INSERT_MESSAGE']='Empty personal message field!';
$language['INVIT_CONFIRM']='Invitation Confirmed';
$language['INVIT_MSG']='Hello,'."\n\n".'You have been invited to join the '.$SITENAME.' community by';
$language['INVIT_MSG1']="\n\n".'If you want to accept this invitation, you\'ll need to click this link:'."\n\n".'';
$language['INVIT_MSG2']="\n\n".'You\'ll need to accept the invitation within '.$btit_settings['invitation_expires'].' days or else the link will become inactive.'."\n\n".'We at '.$SITENAME.' hope that you\'ll accept the invitation and join our great community!'."\n\n".'Personal message from';
$language['INVIT_MSG3']="\n\n".'----------------'."\n\n".'If you do not know the person who has invited you, please forward this email to '.$SITEEMAIL;
$language['INVIT_MSGCONFIRM']='Hello,'."\n".'Your account has been confirmed. You can now visit'."\n\n".$BASEURL.'/index.php?page=login'."\n\n".'and use your login information to log in. We hope you\'ll read the FAQ\'s and Rules before you start sharing files.'."\n\n".'Good luck and have fun on '.$SITENAME.'!'."\n\n\n".'----------------'."\n\n".'If you did not register for '.$SITENAME.', please forward this email to '.$SITEEMAIL;
$language['INVITATIONS']='Invitations';
$language['INVITE_SOMEONE_TO']='Send Invitation';
$language['MEMBERS_INVITED_BY']='Members Invited By You';
$language['MESSAGE']='Message';
$language['MNU_UCP_INVITATIONS']='Invitations';
$language["MNU_UCP_TOOLS"]='Tools';
$language['NO_INV']='No invitations left.';
$language['NO_INVITATIONS_OUT']='No invitations sent.';
$language['NO_NEED_CONFIRM_YET']='No invitations to confirm.';
$language['PENDING']='Pending';
$language['REMAINING']='Remaining';
$language['SENT_INVITATIONS']='Sent Invitations';
$language['STATUS']='Status';
$language['WELCOME_UCP_INVITE']='Welcome to your Invitation Panel.<br />Here you may send invitations so your friends can register at '.$SITENAME.'.<br />';

$language["HOS_HIDE_STATUS"] = "Hide online status";

$language["TORRENTBAR"]="Torrent Bar";

$language["PM_BANNED"] = "You are banned from the pm system!";
//sig sync
$language['SYNC_SIG']='Syncronize Signature in forum?';
$language['SYNC_AV']='Syncronize Avatar in forum?';
$language['SIG']='Signature ([img]http://imageurl[/img])';
$language['SIG_PREV']='Signature Preview';
$language['SIG_CP']='Signature';
$language['SIG_EX']='More User Settings'; # changed to take care of the other links in the menu which are friendlist, invitations & avatar upload so they are the same as in the dropdown menu # TT #

$language["MNU_UCP_AVATAR"] = "Avatar Upload";
$language["AVATAR_SUCCESS"] = "The avatar has successfully been uploaded!";
$language["AVATAR_FAILURE1"] = "Failure. The image size was to big! The measurements are";
$language["AVATAR_FAILURE2"] = "Failure. The file size was to big! The limit is";
$language["AVATAR_FAILURE3"] = "Failure. An unknown reason has accured!";
$language["AV_FEW_HEAD"] = "Avatar upload rules";
$language["AV_FILE_SIZE"] = "Do not upload images larger than";
$language["AV_IMAGE_SIZE"] = "Do not upload images that are bigger than";
$language["AV_FORBIDDEN"] = "Do not upload any offensive material";
$language["AV_NO_HEADER"] = "You have already uploaded an image. You can no longer upload any images.";
$language["AV_NO_1"] = "You recently uploaded";
$language["AV_NO_2"] = "Delete this file";
$language["AV_NO_3"] = "Link to file";

$language["UN_INV_SENT"] = "Invitation sent to";
$language["UN_INV_CONF"] = "has confirmed the registration of";

$language["PR_SHOW"] = "Show";
$language["PR_HIDE"] = "Hide";
$language["PROFILEVIEW"] = "Show/Hide Profile";

$language["ADVRSS_CATLIST"]="Custom RSS Categories";
$language["ADVRSS_LIMIT"]="Custom RSS limit per category";
$language["ADVRSS_YOUR_FEED"]="Your custom RSS feed";
$language["DEF_CATS"]="Default Categories:";
$language["MAR"]="Mark as Read";
?>