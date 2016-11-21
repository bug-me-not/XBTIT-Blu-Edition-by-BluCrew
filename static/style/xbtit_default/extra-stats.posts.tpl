<table width="98%" class="lista" align="center">
    <tr>
      <td class="header" align="center"><tag:language.RANK /></td>
      <td class="header" align="center">Subject</td>
      <td class="header" align="center">Replies</td>

    </tr>
    <loop:forum>
    <tr>
      <td class="lista" align="center" width="5%"><tag:forum[].rank /></td>
      <td class="lista" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" style="padding-left:10px;overflow:auto;"><tag:forum[].subject /></td>
      <td class="lista" align="center" width="5%"><tag:forum[].reply /></td>
    </tr>
    </loop:forum>
  </table>


