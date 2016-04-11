<div align='center'>


<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<h1>Admin</h1>
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
  <tr>
    <td align='center' class='navigation'><a href='index.php?page=betadmin'><tag:language.SB_CREATE_BETS /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betgameinfo'><tag:language.SB_BET_INFO /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betgamefinish'><tag:language.SB_END_BETS /></a></td>
  </tr>
</table>
<br />

<h2><tag:language.SB_ADD_OPT_TO_BET /></h2>

<table cellpadding='5'>

  <loop:loop1>
    <tr>
      <td><tag:loop1[].heading /></td>
      <td><i><tag:loop1[].undertext /></i></td>
    </tr>
  </loop:loop1>

</table>
<br />

<table border='1' cellspacing='0' cellpadding='5'>
  <tr>
    <td colspan='2' class='header' align='left'><tag:language.SB_OPTIONS /></td>
  </tr>

  <loop:loop2>
    <tr>
      <td class='lista'><tag:loop2[].text /></td><td class='lista'><a href='index.php?page=betdelopt&id=<tag:loop2[].id1 />&amp;b=<tag:loop2[].id2 />'><tag:language.DELETE /></a></td>
    </tr>
  </loop:loop2>

</table>
<br />
<br />

<form action='index.php?page=betaddoption' method='post'>
<tag:language.SB_OPT_TXT />: <input type='text' size='10' name='opt' />
<input type='hidden' name='id' value='<tag:id />' />
<input type='submit' value='<tag:language.SB_ADD_TO_GAME />' />
</form>
<br /><br />
<form action='index.php?page=betaddonetwo' method='post'>
<input type='hidden' name='id' value='<tag:id />' />
<input type='submit' value='<tag:language.SB_ADD_1X2 />' />
</form>


</div>