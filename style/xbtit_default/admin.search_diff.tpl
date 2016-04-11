<if:final_result>
<tag:show_tasks />
<else:final_result>
<form method="post" action="<tag:frm_action />" name="test">
  <table class="lista" align="center">
    <tr>
      <td align="center" class="header"><tag:language.SEARCH_DIFF /></td>
    </tr>
    <tr>
      <td align="center" class="blocklist"><input type="text" name="diff" value="<tag:search_value />" size="13" maxlength="16" />&nbsp;<tag:search_combo_kb /></td>
    </tr>
    <tr>
      <td align="center" class="blocklist"><tag:language.RANK />&nbsp;<tag:search_combo_groups /></td>
    </tr>
    <tr>
      <td align="center" class="lista"><input type="submit" class="btn" name="readyto" value="Go" /></td>
    </tr>
  </table>
</form>
<if:display_result>
<table width="100%" class="lista" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" height="20px" class="block" style="font-weight:bold;"><tag:search_diff_title /></td>
  </tr>
</table>
<form method="post" action="<tag:frm_action />" name="act">
  <table width="80%" class="lista">
    <tr>
      <td colspan="12"><tag:language.SEARCH_DIFF_MESSAGE />&nbsp;<input name="mesajat" type="checkbox" value="evet" />
        &nbsp;&nbsp;<input name="baslik" type="text" id="baslik" value="Write subject here" size="40" maxlength="40" />
        <br />
        <table align="center">
          <tr>
            <td>
              <tag:pm_bbcode />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="12">
      <input name="grupdegis" type="checkbox" value="evet" />
      <tag:language.SEARCH_DIFF_CHANGE_GROUP />&nbsp;
      <tag:search_combo_newgroups />&nbsp;
      <input type="submit" class="btn" name="changeug" value="Work" /></td>
    </tr>
    <tr>
      <td align="center" class="header"><tag:language.USER_ID /></td>
      <td align="center" class="header"><tag:language.MEMBER /></td>
      <td align="center" class="header"><tag:language.DOWNLOADED /></td>
      <td align="center" class="header"><tag:language.UPLOADED /></td>
      <td align="center" class="header"><tag:language.RATIO /></td>
      <td align="center" class="header"><tag:language.RANK /></td>
      <td align="center" class="header"><tag:language.DIFFERENCE /></td>
      <td align="center" class="header"><tag:language.USER_JOINED /></td>
      <td align="center" class="header"><tag:language.USER_LASTACCESS /></td>
      <td align="center" class="header"><tag:language.EDIT /></td>
      <td align="center" class="header"><tag:language.DELETE /></td>
      <td align="center" class="header">&nbsp;</td>
    </tr>
    <loop:users>
    <tr>
      <td class="lista" align="center" style="color:blue"><tag:users[].id /></td>
      <td class="lista" align="center" style="color:lavender"><tag:users[].username /></td>
      <td class="lista" align="center" style="color:Red"> &#8595&nbsp;<tag:users[].down /></td>
      <td class="lista" align="center" style="color:green"> &#8593&nbsp;<tag:users[].up /></td>
      <td class="lista" align="center"><tag:users[].ratio /></td>
      <td class="lista" align="center"><tag:users[].rank /></td>
      <td class="lista" align="center"><tag:users[].diff /></td>
      <td class="lista" align="center"><tag:users[].first /></td>
      <td class="lista" align="center"><tag:users[].last /></td>
      <td class="lista" align="center"><tag:users[].edit /></td>
      <td class="lista" align="center"><tag:users[].delete /></td>
      <td class="lista" align="center"><input type="checkbox" name="uyedegis[]" value="<tag:users[].id />" /></td>
    </tr>
    </loop:users>
  </table>
</form>
<tag:users_founds />
</if:display_result>
</if:final_result>

