<table class="lista" border="0" width="100%" cellspacing="1" cellpadding="4">
  <tr>
    <td class="header" align="center" width="2%">&nbsp;</td>
    <td class="header" align="center"><tag:language.FORUM /></td>
    <td class="header" align="center" style="text-align:center;" width="30" ><tag:language.TOPICS /></td>
    <td class="header" align="center" style="text-align:center;" width="30" ><tag:language.POSTS /></td>
    <td class="header" align="center" width="20%" ><tag:language.LASTPOST /></td>
  </tr>
  <if:NO_FORUMS>
  <tr>
    <td class="lista" colspan="7" align="center"><tag:language.NO_FORUMS /></td>
  </tr>
  <else:NO_FORUMS>
  <loop:forums>
  <tr>
    <tag:forums[].header />
    <td class="lista"><tag:forums[].status /></td>
    <td class="lista" valign="middle" style="padding-left:10px;overflow:auto;"><tag:forums[].name /><tag:forums[].description /><tag:forums[].subforums /></td>
    <td class="lista" style="text-align:center;" align="center"><tag:forums[].topics /></td>
    <td class="lista" style="text-align:center;" align="center"><tag:forums[].posts /></td>
    <td class="lista" align="center"><tag:forums[].lastpost /></td>
  </tr>

  </loop:forums>
  </if:NO_FORUMS>
</table>
<div align="center">
<a href="index.php?page=forum&amp;action=search"><b><tag:language.SEARCH /></b></a> | <a href="index.php?page=forum&amp;action=viewunread"><b><tag:language.VIEW_UNREAD /></b></a> | <a href="index.php?page=forum&amp;action=catchup"><b><tag:language.CATCHUP /></b></a>
</div>
<br />

