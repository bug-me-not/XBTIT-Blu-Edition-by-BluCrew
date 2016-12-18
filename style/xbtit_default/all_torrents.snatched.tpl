<table class="table table-striped">
  <!--<tr>
  <td class="block" align="center" colspan="<tag:colspan />" style="text-align:center;"><b><tag:language.HISTORY /></b></td>
  </tr>-->

  <tr>
    <td align="center" class="header"><if:hisort1><a href="<tag:udhisorturl1 />"></if:hisort1><tag:language.FILE /><if:hisort2></a></if:hisort2><if:hisort3><tag:uarrow3 /></if:hisort3></td>
    <td align="center" class="header"><if:hisort4><a href="<tag:udhisorturl2 />"></if:hisort4><tag:language.SIZE /><if:hisort5></a></if:hisort5><if:hisort6><tag:uarrow3 /></if:hisort6></td>
    <td align="center" class="header"><tag:language.PEER_CLIENT /></td>
    <td align="center" class="header"><if:hisort7><a href="<tag:udhisorturl3 />"></if:hisort7><tag:language.PEER_STATUS /><if:hisort8></a></if:hisort8><if:hisort9><tag:uarrow3 /></if:hisort9></td>
    <td align="center" class="header"><if:hisort10><a href="<tag:udhisorturl4 />"></if:hisort10><span style="color:red;">&#9660;</span><if:hisort11></a></if:hisort11><if:hisort12><tag:uarrow3 /></if:hisort12></td>
    <td align="center" class="header"><if:hisort13><a href="<tag:udhisorturl5 />"></if:hisort13><span style="color:green;">&#9650;</span><if:hisort14></a></if:hisort14><if:hisort15><tag:uarrow3 /></if:hisort15></td>
    <td align="center" class="header"><if:hisort16><a href="<tag:udhisorturl6 />"></if:hisort16><tag:language.RATIO /><if:hisort17></a></if:hisort17><if:hisort18><tag:uarrow3 /></if:hisort18></td>
    
    <if:ttimes_enabled_1>
    <td align="center" class="header"><if:hisort31><a href="<tag:udhisorturl11 />"></if:hisort31><tag:language.ETH_START_DATE /><if:hisort32></a></if:hisort32><if:hisort33><tag:uarrow3 /></if:hisort33></td>
    <td align="center" class="header"><if:hisort34><a href="<tag:udhisorturl12 />"></if:hisort34><tag:language.ETH_COMP_DATE /><if:hisort35></a></if:hisort35><if:hisort36><tag:uarrow3 /></if:hisort36></td>
    <td align="center" class="header"><if:hisort37><a href="<tag:udhisorturl13 />"></if:hisort37><tag:language.ETH_LAST_ACTION /><if:hisort38></a></if:hisort38><if:hisort39><tag:uarrow3 /></if:hisort39></td>
    </if:ttimes_enabled_1>

    <if:hnr_enabled>
    <td align="center" class="header"><if:hisort19><a href="<tag:udhisorturl7 />"></if:hisort19><tag:language.SEEDING_TIME /><if:hisort20></a></if:hisort20><if:hisort21><tag:uarrow3 /></if:hisort21></td>
    </if:hnr_enabled>

    <td align="center" class="header"><if:hisort22><a href="<tag:udhisorturl8 />"></if:hisort22><tag:language.SHORT_S /><if:hisort23></a></if:hisort23><if:hisort24><tag:uarrow3 /></if:hisort24></td>
    <td align="center" class="header"><if:hisort25><a href="<tag:udhisorturl9 />"></if:hisort25><tag:language.SHORT_L /><if:hisort26></a></if:hisort26><if:hisort27><tag:uarrow3 /></if:hisort27></td>
    <td align="center" class="header"><if:hisort28><a href="<tag:udhisorturl10 />"></if:hisort28><tag:language.SHORT_C /><if:hisort29></a></if:hisort29><if:hisort30><tag:uarrow3 /></if:hisort30></td>
  </tr>
  <if:RESULTS_2>
  <loop:torhistory>
  <tr>
    <td align="center" class="lista" style="padding-left:10px;"><tag:torhistory[].filename /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].size /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].agent /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].status /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].downloaded /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].uploaded /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].ratio /></td>

    <if:ttimes_enabled_2>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].started_time /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].completed_time /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].mtime /></td>
    </if:ttimes_enabled_2>

    <if:hnr_enabled2>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].SEEDING_TIME /></td>
    </if:hnr_enabled2>

    <td align="center" class="<tag:torhistory[].seedscolor />" style="text-align: center;"><tag:torhistory[].seeds /></td>
    <td align="center" class="<tag:torhistory[].leechcolor />" style="text-align: center;"><tag:torhistory[].leechs /></td>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].completed /></td>
  </tr>
  </loop:torhistory>
  <else:RESULTS_2>
  <tr>
    <td class="lista" align="center" colspan="<tag:colspan />" style="text-align:center;"><tag:language.NO_HISTORY /></td>
  </tr>
  </if:RESULTS_2>
</table>