<?php
# Tabs
$language['KIS_TAB_AWARD']='Award';
$language['KIS_TAB_USERS']='Users';
$language['KIS_TAB_INVITES']='Invites';
# ACP
$language['KIS_EXPIRE']='Time after which invites expire';
$language['KIS_PERPAGE']='Invites Per Page In UCP/ACP';
$language['KIS_REG_AWARD']='Inviter award on succesful reg';
$language['KIS_AWARD_RANK']='Give invites to rank';
$language['KIS_MASS_RESPONSE']='Succesfully added %d invites to %d users.';
$language['KIS_AWARD']='Award Invites';
$language['KIS_STS_GEN']='Stats';
$language['KIS_INV_PEN']='Pending Invites';
$language['KIS_INV_REC']='Registered Invites';
$language['KIS_INV_RATIO']='Invited/Users';
$language['KIS_UNUSED']='Unused Invites';
$language['KIS_NO_INV']='Users with 0 invites';
$language['KIS_RNKINV']='Invalid rank or number of invites';
$language['KIS_INVITES']='Invites';
$language['KIS_FROM']='From';
$language['KIS_USERS']='User Invites';
$language['KIS_SYSTEM']='Use System Account';
$language['KIS_SEARCH']='Search User';
$language['KIS_INVALID_TYPE']='Invalid Search Type';
$language['KIS_ORGANIC']='Self Registered';
$language['KIS_RESULTS']='Showing results for user';
$language['KIS_INVITED_BY']='Invited By';
$language['KIS_JOINED']='Joined';
$language['KIS_NOUSER']='No Users Found.';
$language['KIS_EDIT']='You have successfully edited the invites.';
$language['KIS_NOEDIT']='There was an error with the edit, please try again.';
# Messages
$language['KIS_SANITY_TITLE']='Pruned Invites';
$language['KIS_SANITY_BODY']='You had one or more invites that were too old. Deleted invites have returned to your invite pool.';
$language['KIS_REG_TITLE']='Invited User';
$language['KIS_REG_BODY']='The invite to %s has been used. The new user is [url=%s/index.php?page=userdetails&id=%s]%s[/url].'; # email, url, id, name
$language['KIS_REG_NOTE']="\n".'You have been awarded %s for your contribution to the tracker.'; # 5 GB
# Emails
$language['KIS_MAIL_SUBJECT']='Invite to %s'; # tracker name
$language['KIS_MAIL_BODY']='You have been invited to join %s by %s. <br /> Your invite token is: %s .<br />Proceed to <a href="%s">registering</a>.'; # tracker, user names, token, url
# Registering
$language['KIS_TITLE']='Invite';
$language['KIS_SIGNUP_USE']='<br />But if you have an invite add it here:<form action="index.php" method="get"><input type="hidden" name="page" value="signup" /><table><tr><td><input type="text" name="token" value="" /></td><td><input type="submit" class="btn" name="submit" value="GO" /></td></tr></table></form>';
$language['KIS_SIGNUP_NONE']='<br />And sorry. Invite registration is closed too.';
$language['KIS_TOKEN']='Invite Token (optional - unless full tracker)';
# UCP
$language['KIS_UCP_INVITE']='New Invite';
$language['KIS_UCP_VIEW']='View Invites';
$language['KIS_DISABLED']='Invite system is currently disabled.';
$language['KIS_NONE']='You are out of invites.';
$language['KIS_EMPTY']='You no issued invites (pending or registered).';
$language['KIS_REMAINING']='Invites left';
$language['KIS_EMAIL']='Invite Email(s)';
$language['KIS_PENDING']='Pending';
$language['KIS_REGISTERED']='Registered';
$language['KIS_TIME']='Sent On';
$language['KIS_TOKEN']='Invite Token';
$language['KIS_ACCOUNT']='Account';
$language['KIS_OVERKILL']='You have issued more invites than you currently have.';
$language['KIS_BAD_MAIL']='One or more of the emails you have inputed are invalid.';
$language['KIS_BAD_SENT']='One or more of the emails you have inputed have already received an invite.';
$language['KIS_BAD_EXISTENT']='One or more of the emails you have inputed are already registered with the tracker.';
# OTHER
$language['KIS_INVALID_DEL']='An error occured. Please click <a href="%s">here</a> to get the updated list of sent invites.';
$language['KIS_SUCCESS']='You have succesfully sent an invite to the following emails: %s';
# USERBAR
$language['KIS_BAR']='Invites: %s';
?>