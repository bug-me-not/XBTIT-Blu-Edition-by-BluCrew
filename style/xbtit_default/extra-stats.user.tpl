<table width="98%" class="lista" align="center">
    <tr>
      <td class="header" align="center"><tag:language.RANK /></td>
      <td class="header" align="center"><tag:language.USER_NAME /></td>
      <td class="header" align="center"><tag:language.UPLOADED /></td>
      <td class="header" align="center"><tag:language.DOWNLOADED /></td>
      <td class="header" align="center"><tag:language.RATIO /></td>
      <td class="header" align="center">Uploads</td>
      <td class="header" align="center">Joined</td>
    </tr>
    <loop:user>
    <tr>
      <td class="lista" align="center" width="5%"><tag:user[].rank /></td>
      <td class="lista" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" width="30%" style="padding-left:10px;overflow:auto;"><tag:user[].username /></td>
      <td class="lista" align="center" ><tag:user[].uploaded /></td>
      <td class="lista" align="center" ><tag:user[].downloaded /></td>
      <td class="lista" align="center" ><tag:user[].ratio /></td>
      <td class="lista" align="center" ><tag:user[].uploads /></td>
      <td class="lista" align="center" width="10%"><tag:user[].joined /></td>
    </tr>
    </loop:user>
  </table>


