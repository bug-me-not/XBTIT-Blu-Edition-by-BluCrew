<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><b><tag:language.UPLOADED /> <tag:language.TORRENTS /></b></h4>
</div>

<table class="table table-bordered table-hover">

  <tr class="info">

    <td align="center" class="header"><tag:language.FILE /></td>

    <td align="center" class="header"><tag:language.ADDED /></td>

    <td align="center" class="header"><tag:language.SIZE /></td>

    <td align="center" class="header"><tag:language.SHORT_S /></td>

    <td align="center" class="header"><tag:language.SHORT_L /></td>

    <td align="center" class="header"><tag:language.SHORT_C /></td>

  </tr>

  <if:RESULTS>

  <loop:uptor>

  <tr>

    <td class="lista" align="center" style="padding-left:10px;"><tag:uptor[].filename /></td>

    <td class="lista" align="center" style="text-align: center;"><tag:uptor[].added /></td>

    <td class="lista" align="center" style="text-align: center;"><tag:uptor[].size /></td>

    <td class="<tag:uptor[].seedcolor />" align="center" style="text-align: center;"><tag:uptor[].seeds /></td>

    <td class="<tag:uptor[].leechcolor />" align="center" style="text-align: center;"><tag:uptor[].leechs /></td>

    <td class="lista" align="center" style="text-align: center;"><tag:uptor[].completed /></td>

  </tr>

  </loop:uptor>

  <else:RESULTS>

  <tr>

    <td class="lista" align="center" colspan="6"><tag:language.NO_TORR_UP_USER /></td>

  </tr>

  </if:RESULTS>

</table>
<div class="panel-footer">
</div>
</div>

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"></h4>
</div>
<tag:pagertop />
<div class="panel-footer">
</div>
</div>

<center><tag:userdetail_back /></center>