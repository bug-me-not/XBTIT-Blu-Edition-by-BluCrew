<tag:poll_script />
<form action="<tag:frm_action />" method="post">
  <if:show_poller>
  <table border="0" width="100%">
    <tr>
      <td class="lista" align="center" colspan="4"><br /><tag:poll_pager_top /></td>
    </tr>
    <tr>
      <td class="header" align="center"><tag:language.POLL_OPTION /></td>
      <td class="header" align="center"><tag:language.POLL_IP_ADDRESS /></td>
      <td class="header" align="center"><tag:language.POLL_DATE /></td>
      <td class="header" align="center"><tag:language.POLL_USER /></td>
    </tr>
    <loop:polls>
    <tr>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />"><tag:polls[].option_text /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />"><tag:polls[].ip_address /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />"><tag:polls[].vote_date /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />"><tag:polls[].user /></td>
    </tr>
    </loop:polls>
    <tr>
      <td class="lista" align="center" colspan="4"><br /><tag:poll_pager_bottom /></td>
    </tr>
    <tr>
      <td class="header" align="center" colspan="4"><input type="submit" class="btn" name="cancel" value="<tag:language.POLL_BACK />" class="formButton" /></td>
    </tr>
  </table>
  <else:show_poller>
  <if:new_poll>
  <input type="hidden" name="ID" value="<tag:poll_id />" />
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
    <td class="header" align="center" style="white-space:nowrap;">
      <label for="pollerTitle"><tag:language.POLL_TITLE /></label>
      <input type="hidden" name="userid" value="<tag:poll_user_id />" />
    </td>
    <td class="lista" align="center" style="white-space:nowrap;">
      <input type="text" size="60" maxlength="55" id="pollerTitle" name="pollerTitle" value="<tag:poll_title />" />&nbsp;&nbsp;
      <label for="active_yes"><tag:language.POLL_ACTIVE_TRUE /><input type="radio" name="active" value="yes" id="active_yes" <tag:checked_active_yes /> /></label>&nbsp;&nbsp;
      <label for="active_no"><tag:language.POLL_ACTIVE_FALSE /><input type="radio" name="active" id="active_no" value="no" <tag:checked_active_no /> /></label>
    </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td class="header" align="center"><tag:language.POLL_OPTION /></td>
      <td class="header" align="center"><tag:language.POLL_VOTES /></td>
      <td class="header" align="center"><tag:language.POLL_MOVE /></td>
    </tr>
    <loop:polls>
    <tr id="option<tag:polls[].key />">
      <td class="lista" align="center"><input type="text" maxlength="255" size="50" name="existing_pollOption<tag:polls[].key />" value="<tag:polls[].option_0 />" /></td>
      <td class="lista" align="center"><tag:polls[].votes /><input type="hidden" id="existing_pollOrder<tag:polls[].key />" name="existing_pollOrder<tag:polls[].key />" value="<tag:polls[].option_1 />" /></td>
      <td class="lista" align="center"><a href="#down" onclick="moveDown('<tag:polls[].key />');return false"><tag:language.POLL_MOVE /></a></td>
    </tr>
    </loop:polls>
    <tr>
      <td colspan="3" class="header" align="center"><tag:language.POLL_NEW_OPTIONS /></td>
    </tr>
    <loop:new_polls>
    <tr>
      <td colspan="3" class="lista" align="center"><input type="text" maxlength="255" size="50" name="pollOption[<tag:new_polls[].no />]" /></td>
    </tr>
    </loop:new_polls>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="header" align="center"><input type="submit" class="btn" name="save" value="<tag:language.POLL_SAVE />" class="formButton" /></td>
      <td class="header" align="center"><input type="submit" class="btn" name="cancel" value="<tag:language.POLL_CANCEL />" class="formButton" /></td>
      <if:poll_delete>
      <td class="header" align="center"><input type="submit" class="btn" name="delete" value="<tag:language.POLL_DELETE />" onclick="return confirm('<tag:language.POLL_DEL_CONFIRM />')" class="formButton" /></td>
      </if:poll_delete>
    </tr>
  </table>
  <else:new_poll>
  <table width="100%" border="0" cellspacing="2" cellpadding="5">
    <tr>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_ID /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_STARTED /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_ENDED /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_LASTED /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_TITLE /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_BY /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_ACTIVE /></td>
      <td class="header" align="center" style="white-space: nowrap;"><tag:language.POLL_VOTES /></td>
    </tr>
    <loop:polls>
    <tr>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].id /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].startdate /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].enddate /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].duration /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].pollertitle /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].starter /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].active /></td>
      <td class="lista" align="center" style="font-weight:<tag:polls[].bold />; white-space: nowrap;"><tag:polls[].vote /></td>
    </tr>
    </loop:polls>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td class="header" align="center"><input type="submit" class="btn" name="new" value="<tag:language.POLL_NEW />" class="formButton" /></td>
    </tr>
  </table>
  </if:new_poll>
  </if:show_poller>
</form>