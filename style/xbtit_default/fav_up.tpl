<table class="header" width="100%" align="center">

  <tr>
    <td class="header"><b>Avatar</b></td>
    <td class="header"><b>User Name</b></td>
    <td class="header"><b>User Level</b></td>
    <td class="header"><b>Users Last Acces</b></td>
    <td class="header"><b>Status</b></td>
    <td class="header"><b>Delete User</b></td>
  </tr>
  <loop:fav_up>
  <tr>
    <td class="lista"><tag:fav_up[].avatar /></td>
    <td class="lista"><tag:fav_up[].name /></td>
    <td class="lista"><tag:fav_up[].level /></td>
    <td class="lista"><tag:fav_up[].acces /></td>
    <td class="lista"><tag:fav_up[].status /></td>
    <td class="lista"><tag:fav_up[].delete /></td>
  </tr>
  </loop:fav_up>

</table>


