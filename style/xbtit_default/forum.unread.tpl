<table width="100%">
  <tr>
    <td align="left" valign="middle">
      <tag:forum_pager />
    </td>
  </tr>
</table>
<table class="lista" border="1" width="100%" cellspacing="0" cellpadding="5" style="border-color=#FFFFFF;">
  <tr>
    <td class="header" align="center" width="2%">&nbsp;</td>
    <td class="header" align="center"><tag:language.TOPIC /></td>
    <td class="header" align="center" width="10%" ><tag:language.REPLIES /></td>
    <td class="header" align="center" width="10%" ><tag:language.AUTHOR /></td>
    <td class="header" align="center" width="10%" ><tag:language.VIEWS /></td>
    <td class="header" align="center" width="15%" ><tag:language.LASTPOST /></td>
  </tr>
  <if:NO_TOPICS>
  <tr>
    <td class="lista" colspan="6" align="center"><tag:language.NO_TOPICS /></td>
  </tr>
  <else:NO_TOPICS>
  <loop:topics>
  <tr>
    <td class="lista"><tag:topics[].status /></td>
    <td class="lista"><tag:topics[].topic /></td>
    <td class="lista" align="center"><tag:topics[].replies /></td>
    <td class="lista" align="center"><tag:topics[].starter /></td>
    <td class="lista" align="center"><tag:topics[].view /></td>
    <td class="lista" align="center"><tag:topics[].lastpost /></td>
  </tr>
  </loop:topics>
  </if:NO_TOPICS>
</table>
<div align="center">
<a href="index.php?page=forum&amp;action=search"><b><tag:language.SEARCH /></b></a> | <a href="index.php?page=forum&amp;action=catchup"><b><tag:language.CATCHUP /></b></a>
</div>
<br />

