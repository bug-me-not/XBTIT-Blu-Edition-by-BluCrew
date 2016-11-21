<a name="menu"></a>
<if:usetabs>
<div class="ktabs">
	<loop:tabs>
	<span class="ktab"><a href="<tag:script /><tag:tabs[].0 />&amp;key=<tag:key />"><span class="kbutton"><tag:tabs[].1 /></span></a></span>
	</loop:tabs>
</div>
</if:usetabs>
<div align="left"><ol class="kHelpContents">
	<li><a href="#general">Hack Info</a></li>
	<li><a href="#config">Config Tab</a></li>
	<li><a href="#award">Award Tab</a></li>
	<li><a href="#users">Users Tab</a></li>
	<li><a href="#invites">Invites Tab</a></li>
	<li><a href="#stats">Stats Tab</a></li>
	<li><a href="#dev">Developers</a></li>
	<li><a href="#changelog">Changelog</a></li>
	<li><a href="#todo">ToDo</a></li>
</ol></div>
<table class="kHelpBox">
<tr>
	<td class="header"><a name="general" class="kHelpHeader">Hack Info</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">Finally it is done. The Invite System is done. I'd like to thank all the users on xbtit who have quietly waited for this realease. You're the best. I also hope this initial realease will provide all the things you have waited for and I urge each of you to make more demands on what this system should contain or not contain.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="config" class="kHelpHeader">Config Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The Config Tab offers the usual two options, one for enabling or disabling the entire hack and one for keeping logs on various actions done by tha hack. As usual I urge that logs always be turned on. <br /><br />
	Old invites are pruned after the specified time in config. Putting 0 as the time ammount, will completely disable prunning. The default value is 2 weeks, but you should experiment and find the ideal value for your tracker and users.<br /><br />
	Users who invite other users to the tracker can be awarded in upload. By default they are awarded 1 GB, but again you can experiment and find a value that better suits your tracker.<br /><br />
	You can also specify the number of invites that can be viewed per page in UCP->View Invites and ACP->Invites. I recommend not putting the value too high or too low. A high value can increase the load on the SQL server, on the other hand a low value can irritate users.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="award" class="kHelpHeader">Award Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The Award Tab can be used to give a set number of invites to a specified rank. The invite award is acompanied by a PM that is also set here. <br /><br />
	For the moment the only option is the a checkbox in the corner that can be ticked to send the message as the System account. In a future release the award tab will have more options.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="users" class="kHelpHeader">Users Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The Users Tab allows you to search for users via their user id or their name.<br /><br />
	If a succesfull search is made, a new form will appear. This will contain the username, the inviter, the number of invites the user has and the number of users that joined via the users invites. If the user wasn't invited to the tracker he will appear as <b>Self Registered</b>. The number of joined users can be clicked to go to a page showing invites issued by the user, both pending and registered.<br /><br />
	Last but not least the number of invites of the user can be edited here, the user is not notified of the change.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="invites" class="kHelpHeader">Invites Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The Invites Tab can be used to keep track of all the invites the tracker users have issued.<br /><br />
	The list of invites will be either pending or registered. Pending invites can be deleted, with no notification to the user and registered invites lead to the new user on the tracker.<br /><br />
	Also, this tab is used when viewing invites issued by a specific user.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="stats" class="kHelpHeader">Stats Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The Stats Tab provides 6 statistics in the initial release.<br /><br />
	The current statistics include registered invites, total users, the invited/users ratio, pending invites, unused invites and users with 0 invites.<br /><br />
	Also there's a "Force" button. This can be used to get accurate real time stats. I took the precaution to cache certain sql queries to take some of the load off the mysql server.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="dev" class="kHelpHeader">Developers</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem"><b>Note:</b> All functions and systems are provided without any waranties, meaning all content is subject to change. If such a thing happens it is your duty as a developer to update your hack !<br /><br />
	Because the invite system has seen many and I do many requests on xbtit, I have tried to make it as extendable as possible. The invite system comes with 3 functions that can be loaded into any file with <b>require 'include/kis.php';</b>.<br /><br />
	The 3 functions include:<br />
	<b>getInviteInfo($uid)</b> - returns an array with remaining invites and the number of users joined by the user that has the uid $uid.
	<b>kisMod($uid, $by, $exact=false)</b> - returns false on invalid arguments and true on valid. The function modifies the number of invites a user $uid has. If the value of $exact is left empty, it will default to false, meaning the number of invites the user has is ADDED/SUBSTRACTED to the number of invites the user currently has. If exact is true, the number of invites is SET to the value of $by.<br />
	<b>Note:</b> The function doesn't return true on succesful update of database values!<br />
	<b>kisJoined($newuid, $token, $uid)</b> - This function is only used to update invite tokens to the new user registered and increment the total numbers of joins for the user that issued the invite.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="changelog" class="kHelpHeader">Changelog</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem"><pre>0.4 - 2008.04.20 - Initial Release
FEATURE - Sorting of view invites
FEATURE - Multi email invite in one go
FEATURE - Can give a invites to a certain userclass with one click of a button
FEATURE - View pending and registered invites
FEATURE - View various Statistics in admin
FEATURE - View inviter and joins of users
FEATURE - Award upload to inviter upon successful registration
FEATURE - Auto prune old invites
ADDED   - 1 New Menu Item in MyPanel
ADDED   - 2 new tables in mysql
OPTIM   - Uses Config, Tab and Message Systems

0.1 - 0.3 - Development Stage</pre>
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="todo" class="kHelpHeader">ToDo</a></td>
</tr>
<tr>
	<td class="lista" align="left"><ol class="kTodoBox">
		<li class="kTodoNow">Complete Invite Trees</li>
		<li class="kTodoMaybe">More Statistics</li>
		<li class="kTodoLast">Award invites on sanity based on different statistics</li>
	</ol>
	<a href="#menu">Menu</a></div></td>
</tr>
</table>