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
	<li><a href="#backup">Backup Tab</a></li>
	<li><a href="#restore">Restore Tab</a></li>
	<li><a href="#config">Config Tab</a></li>
	<li><a href="#dev">Developers</a></li>
	<li><a href="#readme">Readme</a></li>
	<li><a href="#changelog">Changelog</a></li>
	<li><a href="#todo">ToDo</a></li>
	<li><a href="#author">Author Notes</a></li>
</ol></div>
<table class="kHelpBox">
<tr>
	<td class="header"><a name="general" class="kHelpHeader">Hack Info</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">I'd like to start of by thanking you for downloading and installing this hack and also urge you to change the pass for it. If you don't know how to or why you should do that, please click <a href="#config">here</a>.<br /><br />
	If there's anything you feel is missing from this hack, please point that out, even if it's in the todo list! The more people need something the more I'd consider releasing that feature faster.<br /><br />
	Now, the reason this help file exists is because some of my testers seem to have had issues with some of the terminology used, hence I will offer some explaining here.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="backup" class="kHelpHeader">Backup Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The backup tab offers a set of options regarding the type of Database Backup you can do. By default the settings are set to offer a complete backup for the prefixes used by xbtit (if none is used it will actually make a backup of the entire database).<br /><br />
	You can use <b>|</b> to backup multiple prefixes. (see note)<br /><br />
	Backup Type specifies what should be collected from the database. Structure refers to the table definitions and Data is the actual information contained in them. A backup of "Data Only" can very well become invalid if certain hacks modify table information, but uninstalling them doesn't revert. Such backups will give errors when restoring if the previous backups are never reinstalled.<br /><br />
	If you like to skim through backups or consider it easier for other people to do so, you can tick "Comments" and the backup will have embedded information on what action is being done followed by the specified action.<br /><br />
	Some servers will have certain PHP extensions that allow compression. By far GZIP is standard now. And I suggest you use it whenever possible, my local tracker has a backup 60% smaller if using GZIP. Although I suggest you try GZIP and see if it's PMA Compatible. (see note)<br /><br />
	Data Extras and Structure Extras should not be touched unless you know specifically you want something else.<br /><br />
	As of v3.0 there's a notice with the last backup done. This notice will always exist, even if you turn of logging.<br /><br />
	<b>Note:</b> Testing with PHPMyAdmin 2.11.5 showed that both GZIP and no compression are compatible. It's important they are compatible in case SQL errors makes the tracker show the White Screen of Death, becoming necessary to restore through PMA.<br />
	<b>Note:</b> XBTIT will not allow a backup of xbt_, if xbt_ is found in any request the entire process is blocked, for this reason I'd recommend you open up <b>include/crk_protection.php</b> and remove <b>xbt_</b> from the $ban2 array. Local tests have found no concerning exploits if this removal is made.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="restore" class="kHelpHeader">Restore Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">The restore tab offers one file input. Just select the file you with to restore from. The next page will offer information on the restore action, the number of lines, comments and queries the file had.<br /><br />
	The number of erroneous queries will also be shown as well as the database response associated with each of them. This output is not at all pretty and I know that.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="config" class="kHelpHeader">Config Tab</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">Probably the least used tab, the config system should be the first tab to go to.<br /><br />
	Keeping logs is important for the well being of your tracker. We all trust certain individuals and give them access to different places. But it's also important to see what they do with that trust. I strongly advise you never turn off logging. People who have access to the backup tab can download your entire database ! That can be a HUGE security issue, especially if you have other stuff in that database that's not xbtit related. Again, I urge you to never deactivate logs.<br /><br />
	As Logs should never be deactivated, so should key checks always be kept on. Why? To put it simply, being an admin of a tracker shouldn't give you access to anything other than the admin menu. By giving people access to the backup system your entire database is obtainable. I cannot stress this enough: <b>Keep logs and keychecks always turned on.</b>
	Since making this big talk about the "Key", it would be virtually pointless if every tracker had the same default pass. I normally consider a good password something that's at least 7 letters, has at least one number and one symbol, change it asap and be creative!<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="dev" class="kHelpHeader">Developers</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem"><b>Note:</b> All functions and systems are provided without any warranties, meaning all content is subject to change. If such a thing happens it is your duty as a developer to update your hack !<br /><br />As of v3.0 the config system, isn't really just a config system. It provides also backup, restore, tab and message system. Beyond these system certain cross-hack language vars and functions are also made available.<br /><br />
	I highly doubt anyone will want to change anything in the backup-restore system, hence I won't discuss anything related to them. I will on the other hand talk about the other systems.<br /><br />
	<b>The Message System</b> comes with 5 message types Success, Notice, Warning, Error, DBError and they serve the same purpose. Apart from the last 2 types, each is unique and I hope all are self explanatory.<br /><br />
	To use the message system you have to follow these 4 easy steps:<br /><br />
	1. Initialize the $_MSG var: <b>$_MSG=array();</b><br />
	2. Issue each message: <b>$_MSG[]=array(TYPE, TEXT);</b> where TYPE is one of the 5 message types and TEXT is the actual message.<br />
	3. Update template with messages: <b>$template->set('msgs',$_MSG);</b> and <b>$template->set('usemsg',!empty($_MSG),true);</b> where $template is your btemplate name.<br />
	4. Add the message loop to the template file:<br />
<pre>
&lt;if:usemsg&gt;
&lt;span class="kMessage"&gt;
	&lt;loop:msgs&gt;
	&lt;div class="k&lt;tag:msgs[].0 /&gt;"&gt;&lt;tag:msgs[].1 /&gt;&lt;/div&gt;
	&lt;/loop:msgs&gt;
&lt;/span&gt;
&lt;/if:usemsg&gt;
</pre>
	<b>Note:</b> If for some reason you need to remove all messages, you can rewrite the $_MSG var by doing: <b>$_MSG=array();</b> effectively wiping the $_MSG system clean.<br /><br />
	<b>The Tab System</b> is a very simple to use system that can be used to achieve nicer and pages with less code. To use the system you only need to follow these 5 steps:<br /><br />
	1. Initialize the $_TABS var: <b>$_TABS=array();</b><br />
	2. Add each tab: <b>$_TABS[]=array($script.'&amp;ktab=NAME', TEXT);</b> where NAME is the tab, TEXT is the displayed text and $script is the current $script url (see NOTE).<br />
	3. Update template with tabs: <b>$template->set('tabs',$_TABS);</b> and <b>$template->set('usetabs',!empty($_TABS),true);</b> where $template is your btemplate name.<br />
	4. Test the current tab <b>$_GET['ktab']</b> and provide the correct content (see NOTE).<br />
	5. Add the tab loop to the template file:<br />
<pre>
&lt;if:usetabs&gt;
&lt;div class="ktabs"&gt;
	&lt;loop:tabs&gt;
	&lt;span class="ktab"&gt;&lt;a href="&lt;tag:tabs[].0 /&gt;"&gt;
		&lt;span class="kbutton"&gt;&lt;tag:tabs[].1 /&gt;&lt;/span&gt;
	&lt;/a&gt;&lt;/span&gt;
	&lt;/loop:tabs&gt;
&lt;/div&gt;
&lt;/if:usetabs&gt;
</pre>
	<b>NOTE:</b> If for some reason you want to disable tabs for the current page you can achieve it by doing: <b>$_TABS=array();</b>, this can also be used to "clean" tabs and create specific tabs for the current page. I strongly urge any developers to not use TO many tabs as there is an issue when the tabs exceed the width of the page. Also I'd like to point out the $script var can be created and passed to the template to be used in other sections as well (form action, links, etc). I also urge every developer using the tab system to look at this hacks source code and understand this tab system is mean to provide more compact hacks, tightly packed with less repeated code!<br /><br />
	<b>The Config System</b>, the reason all of this exists, provides the means to save and load config vars in an easy, but more importantly, optimized manner. In order to save config vars I do 2 things, but you can very well do it another way:<br /><br />
	1. Delete all the previous config vars with <b>quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "KEY%" LIMIT X;');</b> where KEY is your hack key (I make acronyms for all my hacks for this hack, kocs_ is the KEY) and X is the number of config variables.<br />
	2. Insert all new config vars with <b>quickQuery('INSERT INTO `'.$TABLE_PREFIX.'khez_configs` VALUES ("VAR_NAME", "VAR_VALUE"), ("VAR_NAME", "VAR_VALUE") [...];</b><br /><br />
	In order to load the config vars, you need one function: <b>get_khez_config($qrystr, $cachetime=-1)</b>. $qrystr is the query you use to get the vars <b>'SELECT `key`,`value` FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "KEY%" LIMIT X;'</b> where KEY and X are the ones explained above. $cachetime is by default -1, meaning there's no reading of cache and no writing, 0 would force a database retrieval and writing of cache any other value will check how "old" the cache is.<br /><br />
	<b>Note:</b> I use a cachetime of 0 whenever I'm in admin, always get fresh config and force a rewrite. Then I use $reload_cfg_interval in any other place. Why not put it at a higher value? because there's still the chance someone changes the database through other means like a restore or phpmyadmin. There's much to say about this but I'd let you look in the sourcecode and find your own way of using the system. Also, please offer an uninstall button for your hacks with which you restore database changes. Thank you.<br /><br />
	<b>Cross Hack Functions</b>, 15 of them too! There's quite a lot to talk here, but... I won't. Maybe in a future hack release I'd say more about these.<br /><br />
	<b>Cross Hack Language Vars</b>, not much to say. If you need them, use them.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="readme" class="kHelpHeader">Readme</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">Because of the newly added backup/restore options in the config system, I have taken it as a precaution not to allow every moderator or admin,
to backup/restore at will. <br /><br />
	The precaution is an admin set-able password for the backup/restore,
As a default value the password is: btiteamkhez<br /><br />
	Please change it in ACP => Khez Tools => Config<br /><br />
	<b>Note:</b> When uninstalling a previous version of KOCS, you MUST first uninstall ALL dependent hacks, normally you wouldn't be allowed to uninstall because of the way xbtit's hack system works, in case for some reason you are able to uninstall, you might get a white screen and will become UNABLE to do anything via the tracker interface! If this seems too annoying please mail/pm me or reply in the hack topic and I will consider making the entire update process a little easier. Also, until that point I might help you with the install.<br />
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="changelog" class="kHelpHeader">Changelog</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem"><pre>3.3 - 2008.07.28 - Updates Part III
ADDED - A cross-hack template for disabled hacks
ADDED - Multi prefix support
ADDED - A language var
ADDED - 3 functions

3.2 - 2008.07.23 - Updates Part II
ADDED - Help&Info Tab
ADDED - CSS for Help Page
ADDED - More Language Vars
FIXED - Potential whitescreen on multi hack require of khez.php

3.1 - 2008.07.15 - Updates Part I
FIXED - Config is now changeable (Thanks to: DiemThuy@xbtit.com)
FIXED - Backup issue with various options (Thanks to: DiemThuy@xbtit.com)
FIXED - Tabs are loaded using the $ADMIN_PATH variable
FIXED - A syntax issue when giving a bad pass
OPTIM - Various backup options, if bogus selections are made, it now fallbacks to default 
OPTIM - Header code by integrating certain inits in the option tests
OPTIM - Removed a redundant $sql init
OPTIM - Added labels in templates
ADDED - Language vars for tabs
ADDED - Number of restore errors now logged
ADDED - One more lang var
ADDED - One more function
CUTIE - Formated various lines in the backup to be more understandable by human eyes

3.0 - 2008.07.07 - Revamps
ADDED - a new file for cross hack tab and msg system support
ADDED - a new file for cross hack functions, 11 in total
ADDED - 5 new language vars
ADDED - Backup System with data/structure options and gzip/text compression
ADDED - Notice in backup tab: Last Backup On and By
ADDED - Restore System from backed up files
ADDED - Notice in restore tab: Last Backup On, By and With x errors.
ADDED - Khez Tools Password, defaulted to "btiteamkhez"
ADDED - Message System via the $_MSG "super global"
ADDED - Tab System via the $_TABS "super global"
ADDED - admin option to delete khez_config table
OPTIM - get_khez_config to use less memory
FIXED - getting erroneous "fresh" configs if server clock is change to a time in the past
NOTE  - globals 3 vars in sanity.php and adds a comment for use in future hacks
NOTE  - creates a new header in ACP for use in future hacks
NOTE  - creates a new header in UCP for use in future hacks

2.0 - 2008.12.05 - Initial Release
ADDED - get_khez_config, optimized function for config save/load
ADDED - lang_khez, file for shared hack language vars

0.1 - 1.9 - Development Stage - Big thanks to cuds@cartoonchaos.org for letting me test this.</pre>
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="todo" class="kHelpHeader">ToDo</a></td>
</tr>
<tr>
	<td class="lista" align="left"><ol class="kTodoBox">
		<li class="kTodoNext">Support for bzip and zip</li>
		<li class="kTodoNext">Complete backup-restore information</li>
		<li class="kTodoMaybe">Backup option to save on server</li>
		<li class="kTodoMaybe">Restore option to load from server</li>
		<li class="kTodoLast">Auto backups</li>
		<li class="kTodoNever">File backups</li>
		<li class="kTodoNow">Fix links in messages</li>
	</ol>
	<a href="#menu">Menu</a></div></td>
</tr>
<tr>
	<td class="header"><a name="author" class="kHelpHeader">Author Notes</a></td>
</tr>
<tr>
	<td class="lista"><div class="kHelpItem">Again, thank you for installing and sorry this Info page is only in english. Hope this hack serves it's purpose and doesn't give you any issues or annoy you (too much) when you try to uninstall it. I'd also like to thank the greatest testers out there cuds@cartoonchaos.org, diemthuy@diemthuy.glx.nl, donbean@reggaetraders.net and last but not least lupin@xbtit.com for not hassling me, too much, when I'm late with my hacks ;).<br />Khez<br />
	<a href="#menu">Menu</a></div></td>
</tr>
</table>