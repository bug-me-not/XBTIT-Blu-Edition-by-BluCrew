<div align='center'>

<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Edit Bet</h4>
</div>
<br />

<form method='post' action='index.php?page=bettakeedit'>
<table cellpadding='5'>
  <tr>
    <td><input name='id' type='hidden' value='<tag:id />' /><tag:language.SB_BET_TITLE />: </td><td><input type='text' name='heading' size='50' value='<tag:heading />' /></td>
  </tr>
  <tr>
    <td><i><tag:language.SB_BETTING_ON />:</i></td><td><input type='text' name='undertext' size='50' value='<tag:undertext />' /></td>
  </tr>
  <tr>
    <td align='center' colspan='2'>Endtime 
<tag:selectbox />
    </td>
  </tr>
  <tr>
    <td><tag:language.SB_ORDERING />:</td> <td><input type='radio' name='sort' value='1' checked='checked' /> <tag:language.SB_BY_ID /> <input type='radio' name='sort' value='0' /> <tag:language.SB_BY_ODDS /></td>
  </tr>
</table>
<br />
<input type='submit' class='btn btn-md btn-primary' value='<tag:language.SB_SAVE_CHANGES />' />
</form>
<br />
<br />
<tag:language.SB_CLICK /> <a href='index.php?page=betdelgame&id=<tag:id2 />'><u><tag:language.SB_HERE /></u></a> <tag:language.SB_DEL_GAME />
<br /><br />
<tag:language.SB_CLICK /> <a href='index.php?page=betback&id=<tag:id2 />'><u><tag:language.SB_HERE /></u></a> <tag:language.SB_DEL_AND_REPAY />
<div class="panel-footer">
</div>
</div>
</div>