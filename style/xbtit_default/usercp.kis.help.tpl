<a name="menu"></a>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Invite Tools</h4>
</div>
<if:usetabs>
	<loop:tabs>
	<a href="<tag:script /><tag:tabs[].0 />&amp;key=<tag:key />"><button class='btn btn-sm btn-primary' type='button'><tag:tabs[].1 /></button></a>
	</loop:tabs>
</if:usetabs>
</div>
<br>
<table class="table table-bordered"> 
<tr>
	<td class="head"><a name="new" class="kHelpHeader">New Invites</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The New Invite tab allows you to invite friends or family to the tracker. You can invite one email or multiple emails separated by a <b>,</b> (comma) symbol.<br /><br />
	If any of the emails isn't valid, for whatever the reason, the entire invite process will be stopped and none of the emails will receive an invite.<br /><br />
	Be careful who you invite as the tracker owner or admins might hold you responsible for his actions.<br />
	</div></td>
</tr>
<tr>
	<td class="head"><a name="view" class="kHelpHeader">View Invites</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The View Invites tab allws you to view your pending or registered invites.<br /><br />
	If an invite is pending, the invite token will be visible. Sometimes mail servers can block emails, take a long time to get the email or simply don't issue emails because of faulty settings. If such an error occurs you can give someone the invite token and that user can still become a member of the tracker even if the email has not been received. Also, if for some reason or another you want to delete the pending invite, you can do so here via the action column and the invite will return to your invite pool.<br /><br />
	If the invite is registered, the username registered with that invite will be viewable in the email tab and the delete action will be replaced with a view account action. Sometimes users invited by you will get pruned, deleted, banned, etc. If such a thing will happen the username will be replaced with <b>DELETED USER</b>, in such a case you should consider notifying the tracker owner or admins and maybe get the invite back.<br />
	</div></td>
</tr>
</table>