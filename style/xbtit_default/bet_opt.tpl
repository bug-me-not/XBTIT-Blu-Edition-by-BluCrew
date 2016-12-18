<div align='center'>


<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Bet Options</h4>
</div>
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

<table class="table table-bordered">
  <tr class='info'>
    <td colspan='2' class='header' align='center'><tag:language.SB_OPTIONS /></td>
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
<input type='submit' class='btn btn-sm btn-primary' value='<tag:language.SB_ADD_TO_GAME />' />
</form>
<div class="panel-footer">
</div>
</div>
</div>