<div align='center'>

<br />
<img src='images/betting.png' alt='<tag:language.SB_SOFTBET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
  <tr>
    <td align='center' class='navigation'><a href='/index.php?page=bet'><tag:language.SB_CURRENT_BETS /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betcoupon'><tag:language.SB_WAGERS /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betinfo'><tag:language.SB_BET_INFO /></a></td>
  </tr>
</table>

<form method='post' action='index.php?page=betoddstwo'>
<table cellpadding='5'>
  <tr>
    <td class='header' width='100'><tag:language.SB_GAMES /></td>
    <td class='header' width='100'><tag:language.SB_MY_GAMES /></td>
    <td class='header'><tag:language.SB_ODDS /></td>
    <td class='header'><tag:language.SB_AMOUNT /></td>
    <td class='header'>&nbsp;</td>
  </tr>
  <tr>
    <td class='lista'><tag:heading /></td>
    <td class='lista'><tag:text /></td>
    <td class='lista'><tag:odds /></td>
    <td class='lista'>
      <input type='text' name='bonus' size='2' maxlength='4' /> <b><tag:language.SB_POINTS /></b>
      <input type='hidden' name='id' value='<tag:id />' />
    </td>
    <td class='lista'><input type='submit' value='<tag:language.SB_BET />' /><br />(<tag:language.SB_CANT_UNDO />)</td>
  </tr>
</table>
</form>

</div>