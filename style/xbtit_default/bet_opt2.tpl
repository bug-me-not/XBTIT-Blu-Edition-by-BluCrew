<div align='center'>

<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<h1><tag:language.SB_ADMIN /></h1>
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
  <tr>
    <td align='center' class='navigation'><a href='index.php?page=betadmin'><tag:language.SB_CREATE_BET /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betgameinfo'><tag:language.SB_BET_INFO /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betgamefinish'><tag:language.SB_END_BET /></a></td>
  </tr>
</table>
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
<input type='submit' value='<tag:language.SB_SAVE_CHANGES />' />
</form>
<br />
<br />
<tag:language.SB_CLICK /> <a href='index.php?page=betdelgame&id=<tag:id2 />'><u><tag:language.SB_HERE /></u></a> <tag:language.SB_DEL_GAME />
<br /><br />
<tag:language.SB_CLICK /> <a href='index.php?page=betback&id=<tag:id2 />'><u><tag:language.SB_HERE /></u></a> <tag:language.SB_DEL_AND_REPAY />

</div>