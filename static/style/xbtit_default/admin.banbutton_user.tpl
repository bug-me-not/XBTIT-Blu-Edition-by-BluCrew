<table class="header" width="100%" align="center"><br>

<tr>
  <td class="lista"><b><center><tag:language.BB_TEXT_3 /></center><b><td>
</tr>

  
</table><br><br><table class="header" width="100%" align="center">
  
  <tr>
    <td class="header"><center><b><tag:language.USERNAME /></center></b></td>
    <td class="header"><center><b><tag:language.BB_BAN_ADDED /></center></b></td>
    <td class="header"><center><b><tag:language.BB_ADDED_BY /></center></b></td>
    <td class="header"><center><b><tag:language.BB_COMM /></center></b></td>
    <td class="header"><center><b><tag:language.BB_IP_BANNED /></center></b></td>
    <td class="header"><center><b><tag:language.BB_DEL /></center></b></td>
  </tr>

  <loop:banbutton_user>
  <tr>
    <td class="lista"><center><tag:banbutton_user[].username /></center></td>
    <td class="lista"><center><tag:banbutton_user[].added /></center></td>
    <td class="lista"><center><tag:banbutton_user[].by /></center></td>
    <td class="lista"><center><tag:banbutton_user[].comment /></center></td>
    <td class="lista"><center><tag:banbutton_user[].range /></center></td>
    <td class="lista"><center><tag:banbutton_user[].remove /></center></td>
  </tr>
  </loop:banbutton_user>

</table>


