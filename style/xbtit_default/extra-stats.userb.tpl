<table width="98%" class="lista" align="center">
    <tr>
      <td class="header" align="center"><tag:language.RANK /></td>
      <td class="header" align="center"><tag:language.USER_NAME /></td>
      <td class="header" align="center"><tag:language.TOT_ONLINE_TIME /></td>

    </tr>
    <loop:user>
    <tr>
      <td class="lista" style="text-align:center;" width="15%"><tag:user[].rank /></td>
      <td class="lista" style="text-align:center;" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" style="padding-left:10px;overflow:auto;"><tag:user[].username /></td>
      <td class="lista" style="text-align:center;" width="45%"><tag:user[].online /></td>

    </tr>
    </loop:user>
  </table>


