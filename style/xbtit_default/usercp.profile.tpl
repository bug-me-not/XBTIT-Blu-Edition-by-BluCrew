<form name="utente" method="post" action="<tag:profile.frm_action />">
  <table width="100%" border="0" class="lista">
    <tr>
      <td align="left" class="header"><tag:language.USER_NAME />:</td>
      <td align="left" class="lista"><tag:profile.username /></td>
  <if:AVATAR>
      <td class="lista" align="center" valign="top" rowspan="3"><tag:profile.avatar /></td>
  </if:AVATAR>
    </tr>

  <if:birthdays_enabled>
    <tr>
      <td align="left" class="header"><tag:language.DOB />:</td>
  <if:DOBEDIT> 
     <td align="left" class="lista"><input type="text" size="2" name="dobday" maxlength="2" value="<tag:profile.dobday />"/>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="2" name="dobmonth" maxlength="2" value="<tag:profile.dobmonth />"/>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="4" name="dobyear" maxlength="4" value="<tag:profile.dobyear />"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tag:language.DOB_FORMAT /></td>
  <else:DOBEDIT>
     <td align="left" class="lista"><input type="text" size="2" name="dobday" maxlength="2" value="<tag:profile.dobday />" readonly />&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="2" name="dobmonth" maxlength="2" value="<tag:profile.dobmonth />" readonly />&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="4" name="dobyear" maxlength="4" value="<tag:profile.dobyear />" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tag:language.DOB_FORMAT /></td>
  </if:DOBEDIT> 
   </tr>
  </if:birthdays_enabled>

    <tr>
      <td align="left" class="header"><tag:language.AVATAR_URL /></td>
      <td align="left" class="lista"><input type="text" size="40" name="avatar" maxlength="100" value="<tag:profile.avatar_field />"/></td>
    </tr>
    <tr>
      <td align="left" class="header"><tag:language.USER_EMAIL />:</td>
      <td align="left" class="lista"><input type="text" size="30" name="email" maxlength="50" value="<tag:profile.email />"/></td>
    </tr>
  <if:USER_VALIDATION>
    <tr>
      <td align="left" class="header"></td>
      <td align="left" class="lista" colspan="2"><tag:language.REVERIFY_MSG /></td>
    </tr>
  </if:USER_VALIDATION>

    <if:privprof_enabled>
    <tr>
      <td align="left" class="header"><tag:language.PROFILEVIEW />:</td>
      <td align="left" class="lista"><tag:language.PR_SHOW />: <input name="profileview" id="profileview" type="radio" value="0"<if:show_profile> checked="checked"</if:show_profile>/>
<tag:language.PR_HIDE />: <input name="profileview" id="profileview" type="radio" value="1"<if:hide_profile> checked="checked"</if:hide_profile>/></td>
    </tr>
    </if:privprof_enabled>

    <if:usercp_language_enabled>
    <tr>
      <td align="left" class="header"><tag:language.USER_LANGUE />:</td>
      <td align="left" class="lista" colspan="2"><select name="language"><tag:lang.language_combo /></select></td>
    </tr>
    </if:usercp_language_enabled>

    <if:usercp_style_enabled>
    <tr>
      <td align="left" class="header"><tag:language.USER_STYLE />:</td>
      <td align="left" class="lista" colspan="2"><select name="style"><tag:style.style_combo /></select></td>
    </tr>
    </if:usercp_style_enabled>

    <tr>
      <td align="left" class="header"><tag:language.PEER_COUNTRY />:</td>
      <td align="left" class="lista" colspan="2"><select name="flag"><option value="0">--</option><tag:flag.flag_combo /></select></td>
    </tr>

    <if:hos_enabled>
    <tr>
      <td align="left" class="header"><tag:language.HOS_HIDE_STATUS />:</td>
      <td class="lista"><input type="checkbox" name="invisible" <tag:invisible_checked />/></td>
    </tr>
    </if:hos_enabled>
    <if:showporn_enabled>
    <tr>
      <td align="left" class="header"><tag:language.SP_SHOW_PORN /></td>
      <td class="lista"><input type="checkbox" name="showporn" <tag:showporn_checked />/></td>
    </tr>
    </if:showporn_enabled>
    <if:ssl_enabled>
     <tr>
      <td align="left" class="header"><tag:language.SSL /></td>
      <td class="lista"><input type="checkbox" name="force" <tag:ssl_checked />/><tag:language.SSL_DESC /></td>
    </tr>
	</if:ssl_enabled>
    <tr>
      <td align="left" class="header"><tag:language.TIMEZONE />:</td>
      <td align="left" class="lista" colspan="2"><select name="timezone"><tag:tz.tz_combo /></select></td>
    </tr>
  <if:INTERNAL_FORUM>
    <tr>
      <td align="left" class="header"><tag:language.TOPICS_PER_PAGE />:</td>
      <td align="left" class="lista" colspan="2"><input type="text" size="3" name="topicsperpage" maxlength="3" value="<tag:profile.topicsperpage />"/></td>
    </tr>
    <tr>
      <td align="left" class="header"><tag:language.POSTS_PER_PAGE />:</td>
      <td align="left" class="lista" colspan="2"><input type="text" size="3" name="postsperpage" maxlength="3" value="<tag:profile.postsperpage />"/></td>
    </tr>
    <if:signature_enabled>
    <tr>
      <td align="left" class="header"><tag:language.SIGNATURE />:</td>
      <td align="left" class="lista" colspan="2"><textarea cols="38" rows="6" name="signature"><tag:profile.signature /></textarea></td>
    </tr>
    </if:signature_enabled>
  </if:INTERNAL_FORUM>
    <tr>
      <td align="left" class="header"><tag:language.TORRENTS_PER_PAGE />:</td>
      <td align="left" class="lista" colspan="2"><input type="text" size="3" name="torrentsperpage" maxlength="3" value="<tag:profile.torrentsperpage />"/></td>
    </tr>

    <if:torrcomm_enabled>
    <tr>
      <td align="left" class="header"><tag:language.TCOM_COMMENTPM />:</td>
      <td align="left" class="lista" colspan="2"><input type="checkbox" name="commentpm" value="commentpm" <tag:profile.commentpm /> /></td>
    </tr>
    </if:torrcomm_enabled>

    <if:parked_enabled>
    <tr>
      <td align="left" class="header"><tag:language.PARK_PARK_ACC />:</td>
      <td align="left" class="lista" colspan="2"><input type="checkbox" name="parkme" <if:park_checked>checked="checked"</if:park_checked> /></td>
    </tr>
    </if:parked_enabled>

    <if:about_me_enabled>
    <tr>
      <td align="left" class="header"><tag:language.AM_ABOUT_ME />:</td>
      <td align="left" class="lista" colspan="2"><tag:frm_about_me /></td>
    </tr>
    </if:about_me_enabled>

  <if:advanced_rss_enabled>
    <tr>
      <td align="left" class="header"><tag:language.ADVRSS_CATLIST />:</td>
     <td align="left" class="lista"><tag:rss_output /></td>
   </tr>
    <tr>
      <td align="left" class="header"><tag:language.ADVRSS_LIMIT />:</td>
     <td align="left" class="lista"><input type="text" size="2" name="rss_limit" maxlength="2" value="<tag:rss_limit />"/></td>
   </tr>
  </if:advanced_rss_enabled>

  <if:default_cats_enabled>
  <tr>
    <td align="left" class="header"><tag:language.DEF_CATS /></td>
    <td align="left" class="lista" colspan="2"><tag:catlist /></td>
  </tr>
  </if:default_cats_enabled>

    <!-- Password confirmation required to update user record -->
    <tr>
        <td align="left" class="header"><tag:language.USER_PWD />: </td>
        <td align="left" class="lista" colspan="2"><input type="password" size="40" name="passconf" value=""/><tag:language.MUST_ENTER_PASSWORD /></td>
    </tr>
    <!-- Password confirmation required to update user record -->
    <tr>
      <td align="center" class="header" colspan="3">
    <table align="center" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><input type="submit" class="btn" name="confirm" value="<tag:language.FRM_CONFIRM />" /></td>
        <td align="center"><input type="button" class="btn" name="confirm" onclick="javascript:window.open('<tag:profile.frm_cancel />','_self');" value="<tag:language.FRM_CANCEL />" /></td>
      </tr>
    </table>
      </td>
    </tr>
  </table>
</form>