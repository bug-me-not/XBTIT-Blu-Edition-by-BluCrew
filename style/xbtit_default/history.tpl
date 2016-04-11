<tag:pagertophist />
<table class="table table-striped">

  <tr>

    <td class="block" align="left" colspan="14"><b><tag:language.HISTORY /></b></td>

  </tr>

  <tr>

    <td align="center" class="header"><tag:language.FILE /></td>

    <td align="center" class="header"><tag:language.SIZE /></td>
    
    <td align="center" class="header"><tag:language.PEER_CLIENT /></td>

    <td align="center" class="header"><tag:language.PEER_STATUS /></td>

    <td align="center" class="header"><tag:language.DOWNLOADED /></td>

    <td align="center" class="header"><tag:language.UPLOADED /></td>

    <td align="center" class="header"><tag:language.RATIO /></td>
    
    <if:ttimes_enabled_1>
    <td align="center" class="header"><tag:language.ETH_START_DATE /></td>

    <td align="center" class="header"><tag:language.ETH_COMP_DATE /></td>

    <td align="center" class="header"><tag:language.ETH_LAST_ACTION /></td>
    </if:ttimes_enabled_1>

    <if:hnr_enabled3>
    <td align="center" class="header"><tag:language.SEEDING_TIME /></td>
    </if:hnr_enabled3>

    <td align="center" class="header"><tag:language.SHORT_S /></td>

    <td align="center" class="header"><tag:language.SHORT_L /></td>

    <td align="center" class="header"><tag:language.SHORT_C /></td>

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

    <if:ttimes_enabled_4>
    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].started_time /></td>

    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].completed_time /></td>

    <td align="center" class="lista" style="text-align: center;"><tag:torhistory[].mtime /></td>
    </if:ttimes_enabled_4>

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

    <td class="lista" align="center" colspan="<tag:userdetailarr.colspan />" style="text-align:center;"><tag:language.NO_HISTORY /></td>

  </tr>

  </if:RESULTS_2>

</table>



<tag:pagertophist />

<center><tag:userdetail_back /></center>