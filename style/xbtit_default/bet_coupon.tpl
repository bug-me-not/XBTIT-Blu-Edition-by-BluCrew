<div align='center'>

<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<table class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br>
<tr>
<td align='center' class='navigation'><a href='index.php?page=bet'><tag:language.SB_CURR_BETS /></a></td>
<td align='center' class='navigation'><a href='index.php?page=betcoupon'><tag:language.SB_WAGERS /></a></td>
<td align='center' class='navigation'><a href='index.php?page=betbonustop'><tag:language.SB_TOP_LIST /></a></td>
<td align='center' class='navigation'><a href='index.php?page=betinfo'><tag:language.SB_BET_INFO /></a></td>
</tr>
</table>
<br />

<if:result>
  <loop:loop1>
    <table cellpadding='5'>
      <tr>
        <td class='header' width='200'><tag:language.SB_BET /></td>
        <td class='header' width='100'><tag:language.SB_BET_OPT /></td>
        <td class='header'><tag:language.SB_ODDS /></td>
      </tr>

      <tr>
        <td class='lista'><tag:loop1[].heading /></td>
        <td class='lista'><tag:loop1[].text /></td>
        <td class='lista'><tag:loop1[].odds /></td>
      </tr>
      <tr>
        <td class='header'><tag:language.SB_AMOUNT_WAGERED /></td><td class='lista' align='right'  colspan='2'><tag:loop1[].bonus /> <tag:language.SB_POINTS /></td>
      </tr>
      <tr>
        <td class='header'><tag:language.SB_POY_PAY /></td><td class='lista' align='right' colspan='2'><b><tag:loop1[].potential /> <tag:language.SB_POINTS /></b></td>
      </tr>
    </table>
    <br />
  </loop:loop1>

<else:result>
  <i><tag:language.SB_NO_ACT_GAMES /></i>
</if:result>

</div>