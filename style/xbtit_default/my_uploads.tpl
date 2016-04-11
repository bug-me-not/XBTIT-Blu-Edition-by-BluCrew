<tag:pagertop />
<table width="100%" class="lista">

  <tr>

    <td class="block" align="left" colspan="6"><b><tag:language.UPLOADED /> <tag:language.TORRENTS /></b></td>

  </tr>

  <tr>

    <td align="center" class="header"><tag:language.FILE /></td>

    <td align="center" class="header"><tag:language.ADDED /></td>

    <td align="center" class="header"><tag:language.SIZE /></td>

    <td align="center" class="header"><tag:language.SHORT_S /></td>

    <td align="center" class="header"><tag:language.SHORT_L /></td>

    <td align="center" class="header"><tag:language.SHORT_C /></td>

  </tr>

  <if:RESULTS>

  <loop:uptor>

  <tr>

    <td class="lista" align="center" style="padding-left:10px;"><tag:uptor[].filename /></td>

    <td class="lista" align="center" style="text-align: center;"><tag:uptor[].added /></td>

    <td class="lista" align="center" style="text-align: center;"><tag:uptor[].size /></td>

    <td class="<tag:uptor[].seedcolor />" align="center" style="text-align: center;"><tag:uptor[].seeds /></td>

    <td class="<tag:uptor[].leechcolor />" align="center" style="text-align: center;"><tag:uptor[].leechs /></td>

    <td class="lista" align="center" style="text-align: center;"><tag:uptor[].completed /></td>

  </tr>

  </loop:uptor>

  <else:RESULTS>

  <tr>

    <td class="lista" align="center" colspan="6"><tag:language.NO_TORR_UP_USER /></td>

  </tr>

  </if:RESULTS>

</table>
<tag:pagertop />

<center><tag:userdetail_back /></center>