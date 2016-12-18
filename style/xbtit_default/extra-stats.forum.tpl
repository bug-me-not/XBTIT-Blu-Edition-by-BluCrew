<table width="98%" class="lista" align="center">
    <tr>
      <td class="header" align="center"><tag:language.RANK /></td>
      <td class="header" align="center"><tag:language.USER_NAME /></td>
      <td class="header" align="center">Posts</td>
      <td class="header" align="center">Joined</td>

    </tr>
    <loop:forum>
    <tr>
      <td class="lista" align="center" width="5%"><tag:forum[].rank /></td>
      <td class="lista" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" style="padding-left:10px;overflow:auto;"><tag:forum[].user /></td>
      <td class="lista" align="center" width="5%"><tag:forum[].posts /></td>
      <td class="lista" align="center" valign="middle" width="10%"><tag:forum[].joined /></td>
    </tr>
    </loop:forum>
  </table>


