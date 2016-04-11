<table class="table table-striped">
  <!--<tr>
	<td class="block" align="center" colspan="<tag:userdetailarr.colspan2 />" style="text-align:center;"><b><tag:language.UPLOADED /> <tag:language.TORRENTS /></b></td>
  </tr>-->

  <tr>
    <if:tmod1_enabled>
    <td align="center" class="header"><tag:language.TORRENT_STATUS /></td>
    </if:tmod1_enabled>

    <td align="center" class="header"><if:upsort1><a href="<tag:udupsorturl1 />"></if:upsort1><tag:language.FILE /><if:upsort2></a></if:upsort2><if:upsort3><tag:uarrow /></if:upsort3></td>
    <td align="center" class="header"><if:upsort4><a href="<tag:udupsorturl2 />"></if:upsort4><tag:language.ADDED /><if:upsort5></a></if:upsort5><if:upsort6><tag:uarrow /></if:upsort6></td>
    <td align="center" class="header"><if:upsort7><a href="<tag:udupsorturl3 />"></if:upsort7><tag:language.SIZE /><if:upsort8></a></if:upsort8><if:upsort9><tag:uarrow /></if:upsort9></td>
    <td align="center" class="header"><if:upsort10><a href="<tag:udupsorturl4 />"></if:upsort10><tag:language.SHORT_S /><if:upsort11></a></if:upsort11><if:upsort12><tag:uarrow /></if:upsort12></td>
    <td align="center" class="header"><if:upsort13><a href="<tag:udupsorturl5 />"></if:upsort13><tag:language.SHORT_L /><if:upsort14></a></if:upsort14><if:upsort15><tag:uarrow /></if:upsort15></td>
    <td align="center" class="header"><if:upsort16><a href="<tag:udupsorturl6 />"></if:upsort16><tag:language.SHORT_C /><if:upsort17></a></if:upsort17><if:upsort18><tag:uarrow /></if:upsort18></td>
  </tr>
  <if:RESULTS>
  <loop:uptor>
  <tr>
    <if:tmod2_enabled>
    <td class="lista" align="center" style="text-align: left;"><tag:uptor[].moder /></td>
    </if:tmod2_enabled>

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
    <td class="lista" align="center" colspan="<tag:userdetailarr.colspan2 />" style="text-align:center;"><tag:language.NO_TORR_UP_USER /></td>
  </tr>
  </if:RESULTS>
</table>