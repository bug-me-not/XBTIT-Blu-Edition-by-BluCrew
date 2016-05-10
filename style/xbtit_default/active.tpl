<tag:pagertopact />
<table class="table table-bordered">

  <tr>

    <td class="block" align="left" colspan="13"><b><tag:language.ACTIVE_TORRENT /></b></td>

  </tr>

  <tr>

    <td align="center" class="header"><tag:language.FILE /></td>

    <td align="center" class="header"><tag:language.SIZE /></td>

    <td align="center" class="header"><tag:language.PEER_STATUS /></td>

    <td align="center" class="header"><tag:language.DOWNLOADED /></td>

    <td align="center" class="header"><tag:language.UPLOADED /></td>

    <!--<td align="center" class="header"><tag:language.RATIO /></td>-->
    
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

  <if:RESULTS_1>

  <loop:tortpl>

  <tr>

    <td align="center" class="lista" style="padding-left:10px;"><tag:tortpl[].filename /></td>

    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].size /></td>

    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].status /></td>

    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].downloaded /></td>

    <td align="center" class="lista" style="text-align: center;"><tag:tortpl[].uploaded /></td>

    <!--<td align="center" class="lista" style="text-align: center;"><tag:tortpl[].peerratio /></td>-->
    
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

    <td class="lista" align="center" colspan="9"><tag:language.NO_ACTIVE_TORR /></td>

  </tr>


  </if:RESULTS_1>

</table>


<tag:pagertopact />

<center><tag:userdetail_back /></center>