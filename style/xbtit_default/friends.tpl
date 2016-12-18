<div class="panel panel-primary">
<div class="panel-heading">
<div align="center">
<tag:language.FL_FFF />&nbsp;:&nbsp;<tag:un />
</div>
</div>
<br>
<table class="table table-bordered">

  <tr>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FAVATAR /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUN /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FUL /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FFD /></td>
    <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FSTAT /></td>
    <if:mutual_enabled_1>
      <td class="header" style="text-align:center;font-weight:bold;"><tag:language.FL_FMF /></td>
    </if:mutual_enabled_1>
  </tr>

  <if:have_friends>
    <loop:friend>
    <tr>
      <td class="lista" style="text-align:center;"><img width="30" src="<tag:friend[].avatar />" /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].name /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].level /></td>
      <td class="lista" style="text-align:center;"><tag:friend[].acces /></td>
      <td class="lista" style="text-align:center;"><img src="<tag:friend[].online_img />" border="0" alt="<tag:friend[].online_alt />" title="<tag:friend[].online_alt />" /></td>
      <if:mutual_enabled_2>
        <td class="lista" style="text-align:center;"><tag:friend[].mutual /></td>
      </if:mutual_enabled_2>
    </tr>
    </loop:friend>
  <else:have_friends>
    <tr>
      <td class="lista" colspan="<if:mutual_enabled_3>6<else:mutual_enabled_3>5</if:mutual_enabled_3>" style="text-align:center;font-weight:bold;"><tag:language.FL_HASNOFRIENDS /></td>
    </tr>
  </if:have_friends>
</table>
</div>