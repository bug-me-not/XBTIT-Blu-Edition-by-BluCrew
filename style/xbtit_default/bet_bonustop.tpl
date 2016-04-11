<div align='center'>
<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<table class='main' width='50%' cellspacing='0' cellpadding='5' border='0'><br>
  <tr>
    <td align='center' class='navigation'><a href='index.php?page=bet'><tag:language.SB_GAMES /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betcoupon'><tag:language.SB_WAGERS /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betbonustop'><tag:language.SB_TOP_LIST /></span></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betinfo'><tag:language.SB_BET_INFO /></a></td>
  </tr>
</table>
<br />

<if:result1>
  <loop:loop1>
    <table border='1' cellspacing='0' cellpadding='5'>
      <tr>
        <td class='header' align='left'><tag:language.USERNAME /></td><td class='header' align='left'><tag:language.SB_POINTS /> +/-</td>
      </tr>
      <tr>
        <td class='lista'><a href='index.php?page=userdetails&id=<tag:id />'><tag:user /></a></td><td class='lista' align='right'><b><tag:loop1[].bonus /> <tag:language.SB_POINTS /></b></td>
      </tr>
    </table>
  </loop:loop1>
</if:result1>


<h1><tag:language.SB_TOP_LIST /></h1>

<if:desc>
    <h2><tag:language.SB_WINNER /> - <a href='index.php?page=betbonustop&a=1'><tag:language.SB_LOSER /></a></h2>
<else:desc>
    <h2><a href='index.php?page=betbonustop&a=2'><tag:language.SB_WINNER /></a> - <tag:language.SB_LOSER /></span></h2>
</if:desc>

<table border='1' cellspacing='0' cellpadding='5'>
  <tr>
    <td class='header' align='left'><tag:language.SB_POSITION /></td><td class='header' align='left'><tag:language.USERNAME /></td><td class='header' align='left'><tag:language.SB_POINTS /> +/-</td>
  </tr>

  <if:result2>
    <loop:loop2>
      <tr>
        <td class='lista'>&#35;<tag:loop2[].number /></td><td class='lista'><a href='index.php?page=userdetails&id=<tag:loop2[].userid />'><tag:loop2[].username /></a></td><td  class='lista' align='right'><b><tag:loop2[].bonus /> <tag:language.POINTS /></b></td>
      </tr>
    </loop:loop2>
  </if:result2>

</table>
<br />
</div>