<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Ban Client Settings</h4>
</div>
<p align='center'><tag:language.BAN_MAIN /></p>
<form method='post' name='action'>
<table class="table table-bordered table-hover">
  <tr>
    <td class='header' align='center'><tag:language.PEER_CLIENT /></td>
    <td class='header' align='center'><tag:language.USER_AGENT /></td>
    <td class='header' align='center'><tag:language.PEER_ID /></td>
    <td class='header' align='center'><tag:language.PEER_ID_ASCII /></td>
  </tr>
  <tr>
    <td class='lista'><center><tag:client /></center></td>
    <td class='lista'><center><tag:agent /></center></td>
    <td class='lista'><center><tag:peer_id /></center></td>
    <td class='lista'><center><tag:peer_id_ascii /></center></td>
  </tr>
  <tr>
    <td class='lista'><center><tag:language.REASON /></center></td>
    <td class='lista' colspan='3'><input type='text' name='reason' value='' size='70' maxlength='255'>
    &nbsp;&nbsp;&nbsp;<tag:language.BAN_ALL_VERSIONS /><input type='checkbox' name='banall'></td>
  </tr>
</table>
<p align='center'><tag:language.CONFIRM_ACTION /></p>
<center>
<input type='submit' class='btn btn-md btn-primary' name='confirm' value='<tag:language.YES />'>&nbsp;<input type='submit' class='btn btn-md btn-warning' name='confirm' value='<tag:language.NO />'>
<center></form><br />
<div class="panel-footer">
</div>
</div>
<br />
<center><tag:clearban /><button class="btn btn-md btn-danger">Click Here To Unban Clients</button></a></center>


