<div align='center'>

<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">End Bets</h4>
</div>
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
<tr>
<p>
<button class="btn btn-md btn-primary"><a href='index.php?page=betadmin'><tag:language.SB_ADD_BETS /></a></button>
<button class="btn btn-md btn-primary"><a href='index.php?page=betgameinfo'><tag:language.SB_BET_INFO /></a></button>
<button class="btn btn-md btn-primary"><a href='index.php?page=betgamefinish'><tag:language.SB_END_BETS /></a></button>
</p>
</tr>
</table>
<br />

<div class="alert alert-dismissable alert-bg-white alert-danger">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <div class="icon"><i class="fa fa-exclamation"></i></div>
 <strong><tag:language.SB_WARNING /></strong><br><tag:language.SB_CLICK_TO_PAY />
</div>

<if:result>
  <loop:loop1>
    <br /><br /><tag:language.SB_GAMES />: <b><u><tag:loop1[].heading /></u></b>
    <loop:loop1[].extra>
      <br /><a href='index.php?page=betfinishtwo&id=<tag:loop1[].extra[].id />'><tag:loop1[].extra[].text /></a> (<tag:loop1[].extra[].odds />)
    </loop:loop1[].extra>
  </loop:loop1>
</if:result>

</div>