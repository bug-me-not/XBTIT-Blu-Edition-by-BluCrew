<div align="center">
<tag:pagertop />

<br />
<br />
<table class="main" cellspacing="0" cellpadding="3" width="80%">
  <tr>
    <td class=header style="text-align:center"><tag:language.TEAM_LOGO_H /></td>
    <td class=header style="text-align:center"><tag:language.TEAM_NAME_H /></td>
    <td class=header style="text-align:center"><tag:language.TEAM_HEAD_TOR /></td>
    <td class=header style="text-align:center"><tag:language.TEAM_OWNER_H /></td>
  </tr>

  <if:found_rows>
  <loop:teams>
  <tr>
  <td class=lista style="text-align:center"><img src="<tag:teams[].image />" border='0' title='<tag:teams[].name />' style='width:25px;'></td>
    <td class=lista style="text-align:center"><b><a href="index.php?page=teaminfo&team=<tag:teams[].id />&action=view"><tag:teams[].name /></a></b></td>
    </td><td class=lista style="text-align:center"><tag:teams[].info /></td>
    <td class=lista style="text-align:center"><a href="<tag:teams[].username_link />"><tag:teams[].OWNERNAME /></a></td>
  </tr>
  </loop:teams>
  <else:found_rows>
  <tr>
    <td class="lista" colspan="4" style="text-align:center;"><tag:language.TEAMS_NOTHING_2C /></td>
  </tr>
  </if:found_rows>

</table>
<br />

<tag:pagerbottom />
</div>