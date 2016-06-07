<div align='center'>

<br /><img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Game Statistics</h4>
</div>
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
<tr>
<p>
<button class="btn btn-md btn-primary"><a href='index.php?page=betadmin'><tag:language.SB_CREATE_BETS /></a></button>
<button class="btn btn-md btn-primary"><a href='index.php?page=betgameinfo'>Game Stats</a></button>
<button class="btn btn-md btn-primary"><a href='index.php?page=betfinish'><tag:language.SB_END_BETS /></a></button>
</p>
</tr>
</table>
<div class="panel-footer">
</div>
</div>
<br />


<loop:out1>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Game</h4>
</div>
  <table cellpadding='2'>
    <tr>
      <td class='header'><a href='index.php?page=betgameinfo&showgames=<tag:out1[].id />'><tag:out1[].heading /></a></td>
    </tr>
  </table>
  <div class="panel-footer">
</div>
  </div>
  <br />
</loop:out1>

<if:showgames>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Stats</h4>
</div>
  <table class="table table-bordered">
    <tr class='info'>
      <td class='header'><tag:language.DATE /></td>
      <td class='header'><tag:language.USER /></td>
      <td class='header'><tag:language.OPTION /></td>
      <td class='header'><tag:language.SB_BONUS /></td>
    </tr>

    <loop:out2>
      <tr>
        <td class='lista'><tag:out2[].date /></td>
        <td class='lista'><a href='index.php?page=userdetails&id=<tag:out2[].userid />'><tag:out2[].username /></a></td>
        <td class='lista'><tag:out2[].optionid /></td>
        <td class='lista'><tag:out2[].bonus /></td>
      </tr>
    </loop:out2>

</table>
<br />
</if:showgames>
</div>
</div>