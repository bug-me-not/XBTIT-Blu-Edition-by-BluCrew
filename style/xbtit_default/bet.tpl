<div align='center'>

<br /><img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<table class="table table-bordered"><br />
  <tr>
  <p>
     <button class="btn btn-md btn-primary"><a href='index.php?page=bet'><tag:language.SB_CURR_BETS /></a></button>
    <if:ADMIN_ACCESS>
      <button class="btn btn-md btn-primary"><a href='index.php?page=betadmin'><tag:language.SB_BET_ADMIN /></a></button>
    </if:ADMIN_ACCESS>

    <button class="btn btn-md btn-primary"><a href='index.php?page=betcoupon'><tag:language.SB_WAGERS /></a></button>
    <button class="btn btn-md btn-primary"><a href='index.php?page=betbonustop'><tag:language.SB_TL /></a></button>
    <button class="btn btn-md btn-primary"><a href='index.php?page=betinfo'>Rules</a></button>
    </p>
  </tr>
</table>
<br />

<if:NOTHING_TO_SEE>
<p class="text-danger"><tag:language.SB_CHECK_LATER /></p>
<else:NOTHING_TO_SEE>
<loop:loop1>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:loop1[].heading /><br /><i><tag:loop1[].undertext /></i></h4>
</div>
<table class="table table-bordered">
<loop:loop1[].extra>
    <tr>
      <td class='header' width='40%'><tag:loop1[].extra[].text /></td>
      <td class='lista'><a href='index.php?page=betodds&id=<tag:loop1[].extra[].id />'><tag:loop1[].extra[].odds /><p class="text-warning">Click To Bet</p></a></td>
    </tr>
    </loop:loop1[].extra>
    <tr>
     <td class='lista' colspan='2' width='40%'>
<div class="alert alert-dismissable alert-bg-white alert-danger">
   <div class="icon"><i class="fa fa-times"></i></div>
   <tag:language.SB_TGCTNO /> <b><tag:loop1[].date /></b><br /><tag:language.SB_TIME_LEFT />: <b><tag:loop1[].endsin /></b>
</div>
</td>
</tr>
</table>
<div class="panel-footer">
</div>
</div>
</loop:loop1>
</if:NOTHING_TO_SEE>
</div>