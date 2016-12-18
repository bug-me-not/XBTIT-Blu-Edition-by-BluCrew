<if:edit_page>
<div align='center'>

<form name='smolf3d1' method='get' action='index.php'>
<input type='hidden' name='edited' value='1'></div>
<input type='hidden' name='page' value='admin'>
<input type='hidden' name='user' value='<tag:user />'>
<input type='hidden' name='code' value='<tag:code />'>
<input type='hidden' name='do' value='teams'>
<input type='hidden' name='id' value='<tag:editid />'>

<table align='center' cellspacing='0' cellpadding='5' width='50%'>
  <tr>
    <td class=header colspan=2 align=center><tag:language.TEAM_EDIT /></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_NAME /></td>
    <td align='right' class=lista><input type='text' size=50 maxlength=255 name='team_name' value='<tag:name />'></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_LOGO /></td>
    <td align='right' class=lista><input type='text' size=50 maxlength=255 name='team_image' value='<tag:image />'></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_OWNER /></td>
    <td align='right' class=lista><input type='text' size=50 maxlength=40 name='team_owner' value='<tag:owner />'><tag:language.TEAM_ONE /></td>
  </tr>
  <tr>
    <td valign=top class=header><tag:language.TEAM_DESC /></td>
    <td align='right' class=lista><tag:edity /></td>
  </tr>
  <tr>
    <td class=header colspan=2><div align='center'><input type='Submit' value='<tag:language.UPDATE />'></div></td>
  </tr>
</table>
</form><br />
</div>
</if:edit_page>

<if:add>

<div align='center'>
<tag:success />
<br />
<tag:language.TEAM_HEADER />

<form name="team_mode" method="post" action="index.php?page=admin&user=<tag:user />&code=<tag:code />&do=teams">
  <table width="50%" cellspacing='0' cellpadding='5'>
    <tr>
      <td class="header" align="center"><b><tag:language.TEAMS_DISP_MODE /></b></td>
    </tr>
      <td class="lista" style="text-align:center;"><input type="radio" name="team_state" value="private"<if:private_mode> checked="checked"</if:private_mode>>&nbsp;<tag:language.TEAMS_PRIV />&nbsp;&nbsp;&nbsp;<input type="radio" name="team_state" value="public"<if:public_mode> checked="checked"</if:public_mode>>&nbsp;<tag:language.TEAMS_PUB /></td>
    </tr>
    <tr>
    <td class="header" align="center"><input type="submit" name="submit" value="Submit"></td>
    </tr>
  </table>
</form>
<br />

<form name='smolf3d' method='get' action='index.php'>
<input type='hidden' name='page' value='admin'>
<input type='hidden' name='user' value='<tag:user />'>
<input type='hidden' name='code' value='<tag:code />'>
<input type='hidden' name='do' value='teams'>


<table cellspacing='0' cellpadding='5' width='50%'>
  <tr>
    <td class=header colspan=2 align=center><tag:language.TEAM_ADD /></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_NAME /></td><td align='left' class=lista><input type='text' size=50 name='team_name'></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_OWNER /></td><td align='left' class=lista><input type='text' size=50 name='team_owner'><tag:language.TEAM_ONE /></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_DESC /></td><td class=lista align=center valign=top><center><tag:desc /></center></td>
  </tr>
  <tr>
    <td class=header><tag:language.TEAM_LOGO /></td><td align='left' class=lista><input type='text' size=50 name='team_image'><input type='hidden' name='add' value='true'></td>
  </tr>
  <tr>
    <td class=header colspan=2><div align='center'><input class=btn value='<tag:language.TEAMS_ADD_TEAM />' type='Submit'></div></td>
  </tr>
</table>

<br />
</form>
</div>
</if:add>

<if:display>

<div align='center'>
<tag:pagertop />
<table class='main' cellspacing='0' cellpadding='3' width='50%'>
  <tr>
    <td class='header' align='center' colspan='6'><tag:language.TEAM_CURR /></td>
  </tr>
  <tr>
    <td class='header' style='text-align:center'><tag:language.TEAM_ID_H /></td>
    <td class='header' style='text-align:center'><tag:language.TEAM_LOGO_H /></td>
    <td class='header' style='text-align:center'><tag:language.TEAM_NAME_H /></td>
    <td class='header' style='text-align:center'><tag:language.TEAM_OWNER_H /></td>
    <td class='header' style='text-align:center'><tag:language.TEAM_DESC_H /></td>
    <td class='header' style='text-align:center'><tag:language.TEAM_EDIT_H /></td>
  </tr>

  <loop:teams>
  <tr>
    <td class='lista' style='text-align:center'><b><tag:teams[].id /></b></td>
    <td class='lista' align='center' style='text-align:center'><a href="<tag:teams[].image />" rel="thumbnail"><img src='<tag:teams[].image />' border='0' style="width: 100px;"></td>
    <td class='lista' style='text-align:center'><b><tag:teams[].name /></b></td>
    <td class='lista' style='text-align:center'><a href='index.php?page=userdetails&id=<tag:teams[].owner />'><tag:teams[].OWNERNAME /></a></td>
    <td class='lista' style='text-align:center'><tag:teams[].info /></td>
    <td class='lista' style='text-align:center'><tag:teams[].edb />&nbsp;<tag:teams[].delb /></td>
  </tr>
  </loop:teams>
</table>
<tag:pagerbottom />
<br />
</div>
</if:display>
