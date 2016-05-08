<if:HAS_SUBFORUMS>
<br />
<table class="table table-bordered">
  <tr>
    <td class="header" align="center" colspan="7"><tag:sub_forum_name /></td>
  </tr>
  <tr>
    <td class="header" align="center" width="2%">&nbsp;</td>
    <td class="header" align="center"><tag:language.FORUM /></td>
    <td class="header" align="center" style="text-align:center;" width="30" ><tag:language.TOPICS /></td>
    <td class="header" align="center" style="text-align:center;" width="30" ><tag:language.POSTS /></td>
    <td class="header" align="center" width="20%" ><tag:language.LASTPOST /></td>
  </tr>
  <loop:forums>
  <tr>
    <td class="lista"><tag:forums[].status /></td>
    <td class="lista" valign="middle" style="padding-left:10px;overflow:auto;"><tag:forums[].name /><tag:forums[].description /></td>
    <td class="lista" style="text-align:center;" align="center"><tag:forums[].topics /></td>
    <td class="lista" style="text-align:center;" align="center"><tag:forums[].posts /></td>
    <td class="lista" align="center"><tag:forums[].lastpost /></td>
  </tr>
  </loop:forums>
</table>
<br />
</if:HAS_SUBFORUMS>
<table width="100%">
  <tr>
    <td align="left" valign="middle">
      <tag:forum_pager />
    </td>
    <if:can_create>
    <td align="right" valign="middle">
      <span class="pager"><a href="<tag:forum_action />"><tag:language.NEW_TOPIC /></a></span>
    </td>
    </if:can_create>
  </tr>
</table>
<table class="table table-bordered">
  <tr>
    <td class="header" align="center" colspan="7"><tag:forum_name /></td>
  </tr>
  <tr>
    <td class="header" align="center" width="2%">&nbsp;</td>
    <td class="header" align="center"><tag:language.TOPIC /></td>
    <td class="header" align="center" style="text-align:center;" width="30" ><tag:language.REPLIES /></td>
    <td class="header" align="center" width="15%" ><tag:language.AUTHOR /></td>
    <td class="header" align="center" style="text-align:center;" width="30" ><tag:language.VIEWS /></td>
    <td class="header" align="center" width="20%" ><tag:language.LASTPOST /></td>
  </tr>
  <if:NO_TOPICS>
  <tr>
    <td class="lista" colspan="7" align="center"><tag:language.NO_TOPICS /></td>
  </tr>
  <else:NO_TOPICS>
  <loop:topics>
  <tr>
    <td class="lista"><tag:topics[].status /></td>
    <td class="lista" valign="middle" style="padding-left:10px;overflow:auto;"><tag:topics[].topic /></td>
    <td class="lista" style="text-align:center;" align="center"><tag:topics[].replies /></td>
    <td class="lista" align="center"><tag:topics[].starter /></td>
    <td class="lista" style="text-align:center;" align="center"><tag:topics[].view /></td>
    <td class="lista" align="center"><tag:topics[].lastpost /></td>
  </tr>

  </loop:topics>
  </if:NO_TOPICS>
  <tr>
  <td valign='middle' align='left' colspan='7'>
  <tag:forum_pager_bottom />
  </td>
  </tr>
</table>
<br />
<div align="center">
  <table class="lista" cellpadding="5" width="100%">
    <tr valign="middle">
      <td class="lista">
      <tag:locked_legend />
      <br />
      <tag:locked_new_legend />
      </td>
      <td class="lista">
      <tag:unlocked_legend />
      <br />
      <tag:unlocked_new_legend />
      </td>
      <td class="lista" align="right">
      <tag:quick_jump_combo />
      </td>
    </tr>
  </table>
</div>
<br />

