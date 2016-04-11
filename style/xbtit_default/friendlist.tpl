<table class="header" width="100%" align="center">
<td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FPENDING /></td>
</table>
<br>
<table class="header" width="100%" align="center">

  <tr>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FAVATAR /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUN /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUL /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FRD /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FSTAT /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.PM /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FRR /></td>
  </tr>
  <if:have_pending>
    <loop:pending>
    <tr>
      <td class="lista" style="text-align:center;"><img width="30" src="<tag:pending[].avatar />" /></td>
      <td class="lista" style="text-align:center;"><tag:pending[].name /></td>
      <td class="lista" style="text-align:center;"><tag:pending[].level /></td>
      <td class="lista" style="text-align:center;"><tag:pending[].acces /></td>
      <td class="lista" style="text-align:center;"><img src="<tag:pending[].online_img />" border="0" alt="<tag:pending[].online_alt />" title="<tag:pending[].online_alt />" /></td>
      <td class="lista" style="text-align:center;"><tag:pending[].pm /></td>
      <td class="lista" style="text-align:center;"><tag:pending[].delete /></td>
    </tr>
    </loop:pending>
  <else:have_pending>
    <tr>
      <td class="lista" colspan="7" style="text-align:center;font-weight:bold;"><tag:language.FL_NOPENFRO /></td>
    </tr>
  </if:have_pending>

</table>
<br><br>
<table class="header" width="100%" align="center">
<td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FFRIEND /></td>
</table>
<br>
<table class="header" width="100%" align="center">

  <tr>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FAVATAR /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUN /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUL /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FRD /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FSTAT /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.PM /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FATF /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FRU /></td>
  </tr>
  <if:have_requests>
    <loop:friend>
    <tr>
      <td class="lista" style="text-align:center;"><img width="30" src="<tag:friend[].avatar />" /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].name /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].level /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].acces /></td>
      <td class="lista" style="text-align:center;"><img src="<tag:friend[].online_img />" border="0" alt="<tag:friend[].online_alt />" title="<tag:friend[].online_alt />" /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].pm /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].add /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].delete /></td>
    </tr>
    </loop:friend>
  <else:have_requests>
    <tr>
      <td class="lista" colspan="8" style="text-align:center;font-weight:bold;"><tag:language.FL_NOPENFRI /></td>
    </tr>
  </if:have_requests>  

</table>
<br><br>
<table class="header" width="100%" align="center">
<td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FCONF /></td>
</table>
<br>
<table class="header" width="100%" align="center">

  <tr>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FAVATAR /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUN /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUL /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FFD /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FSTAT /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.PM /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUF /></td>
  </tr>
  <if:have_confirmed>
    <loop:friends>
    <tr>
      <td class="lista" style="text-align:center;"><img width="30" src="<tag:friends[].avatar />" /></td>
      <td class="lista" style="text-align:center;"><tag:friends[].name /></td>
      <td class="lista" style="text-align:center;"><tag:friends[].level /></td>
      <td class="lista" style="text-align:center;"><tag:friends[].acces /></td>
      <td class="lista" style="text-align:center;"><img src="<tag:friends[].online_img />" border="0" alt="<tag:friends[].online_alt />" title="<tag:friends[].online_alt />" /></td>
      <td class="lista" style="text-align:center;"><tag:friends[].pm /></td>
      <td class="lista" style="text-align:center;"><tag:friends[].delete /></td>
    </tr>
    </loop:friends>
  <else:have_confirmed>
    <tr>
      <td class="lista" colspan="7" style="text-align:center;font-weight:bold;"><tag:language.FL_NOFRIENDS /></td>
    </tr>
  </if:have_confirmed>
</table>

<br><br>
<table class="header" width="100%" align="center">
<td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FREJ /></td>
</table>
<br>
<table class="header" width="100%" align="center">

  <tr>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FAVATAR /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUN /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUL /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FRDD /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FSTAT /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.PM /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FRE /></td>
  </tr>
  <if:have_rejected>
    <loop:unfriends>
    <tr>
      <td class="lista" style="text-align:center;"><img width="30" src="<tag:unfriends[].avatar />" /></td>
      <td class="lista" style="text-align:center;"><tag:unfriends[].name /></td>
      <td class="lista" style="text-align:center;"><tag:unfriends[].level /></td>
      <td class="lista" style="text-align:center;"><tag:unfriends[].acces /></td>
      <td class="lista" style="text-align:center;"><img src="<tag:unfriends[].online_img />" border="0" alt="<tag:unfriends[].online_alt />" title="<tag:unfriends[].online_alt />" /></td>
      <td class="lista" style="text-align:center;"><tag:unfriends[].pm /></td>
      <td class="lista" style="text-align:center;"><tag:unfriends[].delete /></td>
    </tr>
    </loop:unfriends>
  <else:have_rejected>
    <tr>
      <td class="lista" colspan="7" style="text-align:center;font-weight:bold;"><tag:language.FL_NOREJECTS /></td>
    </tr>
  </if:have_rejected>
</table>
