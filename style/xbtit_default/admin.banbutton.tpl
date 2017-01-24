<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Banned IP Ranges Via Ban Button</h4>
</div>
<table class="header" width="100%" align="center"><br>
<tr>
  <td class="lista"><p class="text-danger"><center><tag:language.BB_TEXT_1 /> <tag:bandays /> <tag:language.BB_TEXT_2 /></center></p><td>
</tr>
</table>
<div class="panel-footer">
</div>
</div>

<table class="table table-bordered" width="100%" align="center">
  
  <tr>
    <td class="head"><center><b><tag:language.BB_FIRST_IP /></center></b></td>
    <td class="head"><center><b><tag:language.BB_LAST_IP /></center></b></td>
    <td class="head"><center><b><tag:language.BB_BAN_ADDED /></center></b></td>
    <td class="head"><center><b><tag:language.BB_BAN_EXPIRE /></center></b></td>
    <td class="head"><center><b><tag:language.BB_ADDED_BY /></center></b></td>
    <td class="head"><center><b><tag:language.BB_USER_COMM /></center></b></td>
    <td class="head"><center><b><tag:language.BB_DEL /></center></b></td>
  </tr>

  <loop:banbutton>
  <tr>
    <td class="lista"><center><tag:banbutton[].FIP /></center></td>
    <td class="lista"><center><tag:banbutton[].LIP /></center></td>
    <td class="lista"><center><tag:banbutton[].added /></center></td>
    <td class="lista"><center><tag:banbutton[].to /></center></td>
    <td class="lista"><center><tag:banbutton[].by /></center></td>
    <td class="lista"><center><tag:banbutton[].com /></center></td>
    <td class="lista"><center><tag:banbutton[].remove /></center></td>
  </tr>
  </loop:banbutton>

</table>


