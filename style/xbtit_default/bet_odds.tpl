<div align='center'>

<br />
<img src='images/betting.png' alt='<tag:language.SB_SOFTBET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Place Bet</h4>
</div>
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
  <tr>
  <p>
    <button class="btn btn-md btn-primary"><a href='/index.php?page=bet'>Bets</a></button>
    <button class="btn btn-md btn-primary"><a href='index.php?page=betcoupon'><tag:language.SB_WAGERS /></a></button>
    <button class="btn btn-md btn-primary"><a href='index.php?page=betinfo'><tag:language.SB_BET_INFO /></a></button>
    </p>
  </tr>
</table>

<form method='post' action='index.php?page=betoddstwo'>
<table class="table table-bordered">
  <tr class='info'>
    <td class='header' width='100'>Game</td>
    <td class='header' width='100'>My Choice</td>
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
    <td class='lista'><input type='submit' class='btn btn-sm btn-primary' value='Place Bet' />&nbsp;(<tag:language.SB_CANT_UNDO />)</td>
  </tr>
</table>
</form>
<div class="panel-footer">
</div>
</div>
</div>