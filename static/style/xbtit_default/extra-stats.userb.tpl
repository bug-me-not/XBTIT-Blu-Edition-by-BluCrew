<table width="98%" class="lista" align="center">
    <tr>
      <td class="header" align="center"><tag:language.RANK /></td>
      <td class="header" align="center"><tag:language.USER_NAME /></td>
      <td class="header" align="center">Online Time</td>

    </tr>
    <loop:userb>
    <tr>
      <td class="lista" align="center" width="15%"><tag:userb[].rank /></td>
      <td class="lista" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" style="padding-left:10px;overflow:auto;"><tag:userb[].username /></td>
      <td class="lista" align="center" width="45%"><tag:userb[].online /></td>

    </tr>
    </loop:userb>
  </table>


