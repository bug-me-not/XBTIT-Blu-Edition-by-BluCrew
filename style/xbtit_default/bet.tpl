<div align='center'>

<br /><img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />

<table class='main' width='40%' cellspacing='0' cellpadding='5' border='0'><br />
  <tr>
    <td align='center' class='navigation'><a href='index.php?page=bet'><tag:language.SB_CURR_BETS /></a></td>
    <if:ADMIN_ACCESS>
      <td align='center' class='navigation'><a href='index.php?page=betadmin'><tag:language.SB_BET_ADMIN /></a></td>
    </if:ADMIN_ACCESS>

    <td align='center' class='navigation'><a href='index.php?page=betcoupon'><tag:language.SB_WAGERS /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betbonustop'><tag:language.SB_TL /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betinfo'><tag:language.SB_INFO /></a></td>
  </tr>
</table>
<br />

<if:NOTHING_TO_SEE>
<tag:language.SB_CHECK_LATER />
<else:NOTHING_TO_SEE>
<loop:loop1>
  <table width='40%' cellpadding='5'>
    <tr>
      <td colspan='3' class='colhead'><tag:loop1[].heading /><br /><i><tag:loop1[].undertext /></i></td>
    </tr>
    <loop:loop1[].extra>
    <tr>
      <td class='header' width='40%'><tag:loop1[].extra[].text /></td>
      <td class='lista'><a href='index.php?page=betodds&id=<tag:loop1[].extra[].id />'><tag:loop1[].extra[].odds /></a></td>
    </tr>
    </loop:loop1[].extra>
    <tr>
      <td class='lista' colspan='2' width='40%'><font size='1'><center><tag:language.SB_TGCTNO /> <b><tag:loop1[].date /></b><br /><tag:language.SB_TIME_LEFT />: <b><tag:loop1[].endsin /></center></b></font></td>
    </tr>
  </table>
</loop:loop1>
</if:NOTHING_TO_SEE>
</div>