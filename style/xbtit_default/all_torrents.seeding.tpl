<table class="table table-striped">
  <tr>
  <td class="block" align="center" colspan="<tag:userdetailarr.colspan3 />" style="text-align:center;"><b><tag:language.ACTIVE_TORRENT /></b></td>
  </tr>

  <tr>
  <td align="center" colspan="12"><tag:userdetailarr.pagertopact /></td>
  </tr>

  <tr>
    <td align="center" class="header"><if:acsort1><a href="<tag:userdetailarr.udacsorturl1 />"></if:acsort1><tag:language.FILE /><if:acsort2></a></if:acsort2><if:acsort3><tag:userdetailarr.uarrow2 /></if:acsort3></td>
    <td align="center" class="header"><if:acsort4><a href="<tag:userdetailarr.udacsorturl2 />"></if:acsort4><tag:language.SIZE /><if:acsort5></a></if:acsort5><if:acsort6><tag:userdetailarr.uarrow2 /></if:acsort6></td>
    <td align="center" class="header"><if:acsort7><a href="<tag:userdetailarr.udacsorturl3 />"></if:acsort7><tag:language.PEER_STATUS /><if:acsort8></a></if:acsort8><if:acsort9><tag:userdetailarr.uarrow2 /></if:acsort9></td>
    <td align="center" class="header"><if:acsort10><a href="<tag:userdetailarr.udacsorturl4 />"></if:acsort10><span style="color:red;">&#9660;</span><if:acsort11></a></if:acsort11><if:acsort12><tag:userdetailarr.uarrow2 /></if:acsort12></td>
    <td align="center" class="header"><if:acsort13><a href="<tag:userdetailarr.udacsorturl5 />"></if:acsort13><span style="color:green;">&#9650;</span><if:acsort14></a></if:acsort14><if:acsort15><tag:userdetailarr.uarrow2 /></if:acsort15></td>
    <td align="center" class="header"><if:acsort16><a href="<tag:userdetailarr.udacsorturl6 />"></if:acsort16><tag:language.RATIO /><if:acsort17></a></if:acsort17><if:acsort18><tag:userdetailarr.uarrow2 /></if:acsort18></td> 
    
    <if:ttimes_enabled_1>
    <td align="center" class="header"><if:acsort31><a href="<tag:userdetailarr.udacsorturl11 />"></if:acsort31><tag:language.ETH_START_DATE /><if:acsort32></a></if:acsort32><if:acsort33><tag:userdetailarr.uarrow2 /></if:acsort33></td>
    <td align="center" class="header"><if:acsort34><a href="<tag:userdetailarr.udacsorturl12 />"></if:acsort34><tag:language.ETH_COMP_DATE /><if:acsort35></a></if:acsort35><if:acsort36><tag:userdetailarr.uarrow2 /></if:acsort36></td>
    <td align="center" class="header"><if:acsort37><a href="<tag:userdetailarr.udacsorturl13 />"></if:acsort37><tag:language.ETH_LAST_ACTION /><if:acsort38></a></if:acsort38><if:acsort39><tag:userdetailarr.uarrow2 /></if:acsort39></td>
    </if:ttimes_enabled_1>

    <if:hnr_enabled3>
    <td align="center" class="header"><if:acsort28><a href="<tag:userdetailarr.udacsorturl10 />"></if:acsort28><tag:language.SEEDING_TIME /><if:acsort29></a></if:acsort29><if:acsort30><tag:userdetailarr.uarrow2 /></if:acsort30></td> 
    </if:hnr_enabled3>

    <td align="center" class="header"><if:acsort19><a href="<tag:userdetailarr.udacsorturl7 />"></if:acsort19><tag:language.SHORT_S /><if:acsort20></a></if:acsort20><if:acsort21><tag:userdetailarr.uarrow2 /></if:acsort21></td>
    <td align="center" class="header"><if:acsort22><a href="<tag:userdetailarr.udacsorturl8 />"></if:acsort22><tag:language.SHORT_L /><if:acsort23></a></if:acsort23><if:acsort24><tag:userdetailarr.uarrow2 /></if:acsort24></td>
    <td align="center" class="header"><if:acsort25><a href="<tag:userdetailarr.udacsorturl9 />"></if:acsort25><tag:language.SHORT_C /><if:acsort26></a></if:acsort26><if:acsort27><tag:userdetailarr.uarrow2 /></if:acsort27></td>
  </tr>

  <if:RESULTS_1>
  <loop:tortpl>
  <tr>
    <td align="center" class="lista" style="padding-left:10px;"><tag:tortpl[].filename /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].size /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].status /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].downloaded /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].uploaded /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].peerratio /></td> 

    <if:ttimes_enabled_2>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].started_time /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].completed_time /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].mtime /></td>
    </if:ttimes_enabled_2>

    <if:hnr_enabled4>
     <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].seeding_time /></td> 
    </if:hnr_enabled4>

    <td align="center" class="<tag:tortpl[].seedscolor />" style="text-align: center;"><tag:tortpl[].seeds /></td>
    <td align="center" class="<tag:tortpl[].leechcolor />" style="text-align: center;"><tag:tortpl[].leechs /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].completed /></td>
  </tr>
  </loop:tortpl>
  <else:RESULTS_1>
  <tr>
    <td class="lista" align="center" colspan="<tag:userdetailarr.colspan3 />" style="text-align:center;"><tag:language.NO_ACTIVE_TORR /></td>
  </tr>
  </if:RESULTS_1>
</table>