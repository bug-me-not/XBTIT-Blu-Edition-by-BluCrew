<div align='center'>

<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<h1><tag:language.ADMIN /></h1>
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
<tr>
<td align='center' class='navigation'><a href='index.php?page=betadmin'><tag:language.SB_ADD_BETS /></a></td>
<td align='center' class='navigation'><a href='index.php?page=betgameinfo'><tag:language.SB_BET_INFO /></a></td>
<td align='center' class='navigation'><a href='index.php?page=betgamefinish'><tag:language.SB_END_BETS /></a></td>
</tr>
</table>
<br />

<h1><span style='color:#FF0000'><tag:language.SB_WARNING /></span><br /> <tag:language.SB_CLICK_TO_PAY /><br /><span style='color:#FF0000'><tag:language.SB_WARNING /></span></h1>

<if:result>
  <loop:loop1>
    <br /><br /><tag:language.SB_GAMES />: <b><u><tag:loop1[].heading /></u></b>
    <loop:loop1[].extra>
      <br /><a href='index.php?page=betfinishtwo&id=<tag:loop1[].extra[].id />'><tag:loop1[].extra[].text /></a> (<tag:loop1[].extra[].odds />)
    </loop:loop1[].extra>
  </loop:loop1>
</if:result>

</div>