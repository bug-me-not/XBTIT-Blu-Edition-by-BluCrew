<table width="98%" class="lista" align="center">
    <tr>
      <td class="header" align="center"><tag:language.RANK /></td>
      <td class="header"><tag:language.FILE_NAME /></td>
      <td class="header" align="center"><tag:language.FINISHED /></td>
      <td class="header" align="center"><tag:language.SEEDERS /></td>
      <td class="header" align="center"><tag:language.LEECHERS /></td>
      <td class="header" align="center"><tag:language.PEERS /></td>
      <if:DISPLAY_SPEED>
      <td class="header" align="center"><tag:language.SPEED /></td>
      </if:DISPLAY_SPEED>
      <td class="header" align="center">Date<td/>
    </tr>
    <loop:torrent>
    <tr>
      <td class="lista" align="center" width="5%"><tag:torrent[].rank /></td>
      <td class="lista" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" style="padding-left:10px;overflow:auto;"><tag:torrent[].filename /></td>
      <td class="lista" align="center" width="5%"><tag:torrent[].complete /></td>
      <td class="lista" align="center" width="5%"><tag:torrent[].seeds /></td>
      <td class="lista" align="center" width="5%"><tag:torrent[].leechers /></td>
      <td class="lista" align="center" width="5%"><tag:torrent[].peers /></td>
      <if:DISPLAY_SPEED1>
      <td class="lista" align="center"><tag:torrent[].speed /></td>
      </if:DISPLAY_SPEED1>
      <td class="lista" align="center" width="10%"><tag:torrent[].data /></td>
    </tr>
    </loop:torrent>
  </table>

