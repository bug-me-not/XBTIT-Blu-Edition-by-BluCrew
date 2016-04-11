<script type="text/javascript" src="jscript/btit_functions.js"></script>
<form action="<tag:frm_action />" name="config" method="post" onsubmit="return test_smtp_password()">
<table class="lista" width="100%" align="center">
<if:config_saved>
<tr>
<td class="lista" align="center" colspan="4" style="color:red"><tag:language.CONFIG_SAVED /></td>
</tr>
</if:config_saved>
<tr>
<td class="header" align="center" colspan="4"><tag:language.XBTT_BACKEND /></td>
</tr>
<if:xbtt_error>
<tr>
<td class="lista" align="center" colspan="4" style="color:red; font-weight:bold;"><tag:language.XBTT_TABLES_ERROR /></td>
</tr>
</if:xbtt_error>
<tr>
<td class="header"><tag:language.XBTT_USE /></td>
<td class="lista"><input type="checkbox" name="xbtt_use" value="xbtt_use" <tag:config.xbtt_use /> /></td>
<td class="header"><tag:language.XBTT_URL /></td>
<td class="lista"><input type="text" name="xbtt_url" value="<tag:config.xbtt_url />" size="30" /></td>
</tr>
<tr>
<td class="header" align="center" colspan="4"><tag:language.GENERAL_SETTINGS /></td>
</tr>
<tr>
<td class="header" colspan="1"><tag:language.TRACKER_NAME /></td>
<td class="lista" colspan="3"><input type="text" name="trackername" value="<tag:config.name />" size="60" /></td>
</tr>
<tr>
<td class="header" colspan="1"><tag:language.TRACKER_BASEURL /></td>
<td class="lista" colspan="3"><input type="text" name="trackerurl" value="<tag:config.url />" size="60" /></td>
</tr>
<tr>
<td class="header" valign="top" colspan="1"><tag:language.TRACKER_ANNOUNCE /></td>
<td class="lista" colspan="3"><textarea name="tracker_announceurl" rows="5" cols="60"><tag:config.announce /></textarea></td>
</tr>
<tr>
<td class="header"><tag:language.TRACKER_EMAIL /></td>
<td class="lista"><input type="text" name="trackeremail" value="<tag:config.email />" size="20" /></td>
<td class="header"><tag:language.TORRENT_FOLDER /></td>
<td class="lista"><input type="text" name="torrentdir" value="<tag:config.torrentdir />" size="20" /></td>
</tr>
<tr>
<td class="header"><tag:language.ALLOW_EXTERNAL /></td>
<td class="lista"><input type="checkbox" name="exttorrents" value="exttorrents" <tag:config.external /> /></td>
<td class="header"><tag:language.ALLOW_GZIP /></td>
<td class="lista"><input type="checkbox" name="gzip_enabled" value="gzip_enabled"  <tag:config.gzip /> /></td>
</tr>
<tr>
<td class="header"><tag:language.ALLOW_DEBUG /></td>
<td class="lista"><input type="checkbox" name="show_debug" value="show_debug" <tag:config.debug /> /></td>
<td class="header"><tag:language.ALLOW_DHT /></td>
<td class="lista"><input type="checkbox" name="dht" value="dht" <tag:config.disable_dht /> /></td>
</tr>
<tr>
<td class="header"><tag:language.ALLOW_LIVESTATS /></td>
<td class="lista"><input type="checkbox" name="livestat" value="livestat" <tag:config.livestat /> /></td>
<td class="header"><tag:language.ALLOW_SITELOG /></td>
<td class="lista"><input type="checkbox" name="logactive" value="logactive" <tag:config.logactive /> /></td>
</tr>
<tr>
<td class="header"><tag:language.ALLOW_HISTORY /></td>
<td class="lista"><input type="checkbox" name="loghistory" value="loghistory" <tag:config.loghistory /> /></td>
<td class="header"><tag:language.ALLOW_PRIVATE_ANNOUNCE /></td>
<td class="lista"><input type="checkbox" name="p_announce" value="p_announce" <tag:config.p_announce /> /></td>
</tr>
<tr>
<td class="header"><tag:language.ALLOW_PRIVATE_SCRAPE /></td>
<td class="lista"><input type="checkbox" name="p_scrape" value="p_scrape" <tag:config.p_scrape /> /></td>
<td class="header"><tag:language.SHOW_UPLOADER /></td>
<td class="lista"><input type="checkbox" name="show_uploader" value="show_uploader" <tag:config.show_uploader /> /></td>
</tr>
<tr>
<td class="header"><tag:language.USE_POPUP /></td>
<td class="lista"><input type="checkbox" name="usepopup" value="usepopup" <tag:config.usepopup /> /></td>
<td class="header"><tag:language.DEFAULT_LANGUAGE /></td>
<td class="lista"><tag:config.language_combo /></td>
</tr>
<tr>
<td class="header"><tag:language.DEFAULT_CHARSET /></td>
<td class="lista"><tag:config.charset_combo /></td>
<td class="header"><tag:language.DEFAULT_STYLE /></td>
<td class="lista"><tag:config.style_combo /></td>
</tr>
<tr>
<td class="header"><tag:language.MAX_USERS /></td>
<td class="lista"><input type="text" name="maxusers" value="<tag:config.max_users />" size="10" /></td>
<td class="header"><tag:language.MAX_TORRENTS_PER_PAGE /></td>
<td class="lista"><input type="text" name="ntorrents" value="<tag:config.max_torrents_per_page />" size="10" /></td>
</tr>
<tr>
<td class="header" align="center" colspan="4"><tag:language.MAILER_SETTINGS /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_MAIL_TYPE /></td>
<td class="lista"><select id="mail_type" name="mail_type" size="1"><tag:config.mail_type_combo /></select></td>
<td class="header"><tag:language.SETTING_SMTP_SERVER /></td>
<td class="lista"><input type="text" id="smtp_server" name="smtp_server" value="<tag:config.smtp_server />" size="20" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_SMTP_PORT /></td>
<td class="lista"><input type="text" name="smtp_port" value="<tag:config.smtp_port />" size="10" /></td>
<td class="header"><tag:language.SETTING_SMTP_USERNAME /></td>
<td class="lista"><input type="text" id="smtp_username" name="smtp_username" value="<tag:config.smtp_username />" size="20" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_SMTP_PASSWORD /></td>
<td class="lista"><input type="password" id="smtp_password" name="smtp_password" value="<tag:config.smtp_password />" size="20" /></td>
<td class="header"><tag:language.SETTING_SMTP_PASSWORD_REPEAT /></td>
<td class="lista"><input type="password" id="smtp_pwd_repeat" name="smtp_pwd_repeat" value="<tag:config.smtp_password />" size="20" /></td>
</tr>
<tr>
<td class="header" align="center" colspan="4"><tag:language.SPECIFIC_SETTINGS /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_INTERVAL_SANITY /></td>
<td class="lista"><input type="text" name="sinterval" value="<tag:config.sanity_update />" size="10" /></td>
<td class="header"><tag:language.SETTING_INTERVAL_EXTERNAL /></td>
<td class="lista"><input type="text" name="uinterval" value="<tag:config.external_update />" size="10" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_INTERVAL_MAX_REANNOUNCE /></td>
<td class="lista"><input type="text" name="rinterval" value="<tag:config.max_announce />" size="10" /></td>
<td class="header"><tag:language.SETTING_INTERVAL_MIN_REANNOUNCE /></td>
<td class="lista"><input type="text" name="mininterval" value="<tag:config.min_announce />" size="10" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_MAX_PEERS /></td>
<td class="lista"><input type="text" name="maxpeers" value="<tag:config.max_peers_per_announce />" size="10" /></td>
<td class="header"><tag:language.CACHE_SITE /></td>
<td class="lista"><input type="text" name="cache_duration" value="<tag:config.cache_duration />" size="10" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_NAT_CHECK /></td>
<td class="lista"><input type="checkbox" name="nat" value="nat"  <tag:config.nat />/></td>
<td class="header"><tag:language.SETTING_PERSISTENT_DB /></td>
<td class="lista"><input type="checkbox" name="persist" value="persist"  <tag:config.persist />/></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_OVERRIDE_IP /></td>
<td class="lista"><input type="checkbox" name="override" value="override"  <tag:config.allow_override_ip />/></td>
<td class="header"><tag:language.SETTING_CALCULATE_SPEED /></td>
<td class="lista"><input type="checkbox" name="countbyte" value="countbyte"  <tag:config.countbyte />/></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_VALIDATION /></td>
<td class="lista"><tag:config.validation_combo /></td>
<td class="header"><tag:language.SETTING_CAPTCHA /></td>
<td class="lista"><input type="checkbox" name="imagecode" value="imagecode"  <tag:config.imagecode />/></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_SEEDS_PID /></td>
<td class="lista"><input type="text" name="maxseeds" value="<tag:config.maxpid_seeds />" size="10" /></td>
<td class="header"><tag:language.SETTING_LEECHERS_PID /></td>
<td class="lista"><input type="text" name="maxleech" value="<tag:config.maxpid_leech />" size="10" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_CUT_LONG_NAME /></td>
<td class="lista" colspan="3"><input type="text" name="cut_name" value="<tag:config.cut_name />" size="10" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_FORUM /></td>
<td class="lista"<tag:forum_colspan />><input type="text" name="f_link" value="<tag:config.forum />" size="<tag:forum_size />" />

<if:ipb_in_use>
<br /><br /><table align="center"><tr><td class="header" align="center">IPB Autopost ID</td></tr><tr><td class="lista" style="text-align:center;"><input type="text" name="ipb_autoposter" value="<tag:config.ipb_autoposter />" size="5" /></td></tr></table>
</if:ipb_in_use>


</td>
<if:forum_en_enabled>
<td class="header"><tag:language.FORUM_DISPLAY_TYPE /></td>
<td class="lista"><tag:forum_display_select /></td>
</if:forum_en_enabled>
</tr>

<tr>
<td class="header" align="center" colspan="4"><tag:language.BLOCKS_SETTING /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_CLOCK /></td>
<td class="lista">&nbsp;<tag:language.CLOCK_ANALOG />&nbsp;<input type="radio" name="clocktype" value="true"<tag:config.clockanalog /> />&nbsp;<tag:language.CLOCK_DIGITAL />&nbsp;<input type="radio" name="clocktype" value="false"<tag:config.clockdigital /> /></td>
<td class="header"><tag:language.SETTING_FORUMBLOCK /></td>
<td class="lista">&nbsp;<tag:language.FORUMBLOCK_POSTS />&nbsp;<input type="radio" name="forumblocktype" value="true"<tag:config.forumblockposts /> />&nbsp;<tag:language.FORUMBLOCK_TOPICS />&nbsp;<input type="radio" name="forumblocktype" value="false"<tag:config.forumblocktopics /> /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_NUM_NEWS /></td>
<td class="lista"><input type="text" name="newslimit" value="<tag:config.newslimit />" size="3" maxlength="3" /></td>
<td class="header"><tag:language.SETTING_NUM_POSTS /></td>
<td class="lista"><input type="text" name="forumlimit" value="<tag:config.forumlimit />" size="3" maxlength="3" /></td>
</tr>
<tr>
<td class="header"><tag:language.SETTING_NUM_LASTTORRENTS /></td>
<td class="lista"><input type="text" name="last10limit" value="<tag:config.last10limit />" size="3" maxlength="3" /></td>
<td class="header"><tag:language.SETTING_NUM_TOPTORRENTS /></td>
<td class="lista"><input type="text" name="mostpoplimit" value="<tag:config.mostpoplimit />" size="3" maxlength="3" /></td>
</tr>
<tr>
<td class="header"><tag:language.SHOUT_PAGER_LIMIT /></td>
<td class="lista"><input type="text" name="shout_history_pp" value="<tag:config.shout_history_pp />" size="5" maxlength="5" /></td>
<td class="header"><tag:language.HTML_PARSE /></td>
<td class="lista">&nbsp;<tag:language.HTML_SPECIAL />&nbsp;<input type="radio" name="parsetype" value="true"<tag:config.HTML_SPECIAL /> />&nbsp;<tag:language.HTML_ENT />&nbsp;<input type="radio" name="parsetype" value="false"<tag:config.HTML_ENT /> /></td>
</tr>
<tr>
<td class="header" align="center" colspan="4">Upload Request PM Settings</td>
</tr>
<tr>
<td class="header">Staff ID to send PM to</td>
<td class="lista"><input type="text" name="up_id" value="<tag:config.up_id />" size="4" /></td>
<td class="header">Send to all staff</td>
<td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="up_all" value="true"<tag:config.up_allyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="up_all" value="false"<tag:config.up_allno /> /></td>
</tr>
<tr>
<td class="header" align="center" colspan="4">Last Upload Slider Block Settings</td>
</tr>
<tr>
<td class="header">Image Width</td>
<td class="lista"><input type="text" name="scrolw" value="<tag:config.scrolw />" size="5" /></td>
<td class="header">Footer Navigation</td>
<td class="lista">&nbsp;&nbsp;Enable&nbsp;<input type="radio" name="nav" value="true"<tag:config.navyes /> />&nbsp;&nbsp;Disable&nbsp;<input type="radio" name="nav" value="false"<tag:config.navno /> /></td>
</tr>
<tr>
<td align="center" class="header" colspan="2"><input type="submit" name="write" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
<td align="center" class="header" colspan="2"><input type="submit" name="cancel" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
</tr>
</table>
</form>
