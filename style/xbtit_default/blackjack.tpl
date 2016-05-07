<if:START>
<table width="100%" bgcolor="#006633" height="300" cellpadding=0 cellspacing=0>
  <tr>
    <td align="center"><tag:bjimg /><tag:language.BJ_WELCOME_1 /><tag:language.BJ_WELCOME_2 /></td>
  </tr>
<if:INSUFFICIENT_CREDIT>
<tr>
<td align="center"><tag:language.INSUFFICIENT_UPLOAD_CREDIT /><br /><br /></td>
</tr>

<else:INSUFFICIENT_CREDIT>
</if:INSUFFICIENT_CREDIT>
  <tr>
    <td class="header" align="center"><form method="post" action="<tag:self />"><input type="submit" value="<tag:language.CONTINUE />" name="DEAL" <if:continue_disabled>disabled<else:continue_disabled></if:continue_disabled>></form></td> 
  </tr>
</table>
<else:START>
<table width="100%" bgcolor="#006633" height="300" cellpadding=0 cellspacing=0>
  <form name="blackjack" method="post" action="<tag:self />">
  <tr>
    <td align="center"><tag:dealer.img /></td>
  </tr>
  <tr>
    <td align="center"><tag:language.DEALER_HAND /><tag:dealer.score />)</b></font></td>
  </tr>
  <tr>
    <td align="center"><br /></td>
  </tr>
<if:WINNER>
  <tr>
    <td align="center"><tag:winneris /></td>
  </tr>
  <tr>
    <td align="center"><br /></td>
  </tr>
<else:WINNER>
</if:WINNER>
  <tr>
    <td align="center"><tag:player.img /></td>
  </tr>
  <tr>
    <td align="center"><tag:language.YOUR_HAND /><tag:player.score />)</b></font></td>
  </tr>

<if:GAMEOVER>  <tr>
    <td align="center"><br /><a href="<tag:self />"><b><tag:language.PLAY_AGAIN /></b></a><br /><br /></font></td>
  </tr>
<else:GAMEOVER>
</if:GAMEOVER>


  <tr>
    <td class="header" align="center"><input type="submit" value="<tag:language.HIT />" name="hit" <if:HIT_DISABLE>disabled<else:HIT_DISABLE></if:HIT_DISABLE>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="<tag:language.STAND />" name="stand"<if:STAND_DISABLE>disabled<else:STAND_DISABLE></if:STAND_DISABLE>><input type="hidden" id="gameid" name="gameid" value="<tag:gameid />" /></td>
  </tr>
  </form>
</table>
</if:START>

