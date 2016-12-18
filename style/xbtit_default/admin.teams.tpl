<table class="header" width="100%" align="center">
  <tr>
    <td class="lista" colspan="4"><tag:pager_top /></td>
  </tr>
  <tr>
    <td class="header"><b><tag:language.USERNAME /></b></td>
    <td class="header"><b><tag:language.TEAM_NAME_H /></b></td>
    <td class="header"><b><tag:language.TEAM_LOGO_H /></b></td>
  </tr>
  <loop:teams>
  <tr>
    <td class="lista"><a href="index.php?page=userdetails&id=<tag:teams[].id />"><tag:teams[].username /></a></td>
    <td class="lista"><tag:teams[].teamname /></td>
    <td class="lista"><a href="<tag:teams[].teamimage />" rel="thumbnail"><img border="0" src="<tag:teams[].teamimage />" style="width: 100px;"></a></td>
    
  </tr>
  </loop:teams>
  <tr>
    <td class="lista" colspan="4"><tag:pager_bottom /></td>
  </tr>
</table>
