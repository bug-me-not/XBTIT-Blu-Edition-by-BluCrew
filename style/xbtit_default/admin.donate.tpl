<form name="donate" action="<tag:frm_action />" method="post">
<table class="header" width="100%" align="center">
   <tr>
     <td class="header" align="center" colspan="10"><tag:language.CHOOSE_DONATE_PAGE /></td>
      </tr>
      <td class="header"><tag:language.DONATE_MODE /></td>
      <td class="lista" align="left" colspan="7">&nbsp;<input type="radio" name="donate_mode" value="classic"<if:classic> checked="checked"</if:classic> /><tag:language.DONATE_CLASSIC />&nbsp;&nbsp;<input type="radio" name="donate_mode" value="custom"<if:custom> checked="checked"</if:custom> /><tag:language.DONATE_CUSTOM /></td>
      </tr>
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.AADS_PP_INFO /></b></center></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_USEPP /></td>
      <tag:pppp />
      <td class="header"><tag:language.AADS_MODE /></td>
      <tag:test />
      </tr>

      <tr>
      <td class="header"><tag:language.AADS_PP_SAND_MAIL /></td>
      <td class="lista"><input type="text" name="pp_email_sand" value="<tag:pp_email_sand />" size="30" /></td>
      <td class="header"><tag:language.AADS_PP_MAIL /></td>
      <td class="lista"><input type="text" name="pp_email" value="<tag:pp_email />" size="30" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_IPN_OR_PDT /></td>
      <tag:Itest />
      <td class="header"><tag:language.AADS_ID_TOK />:</td>
      <td class="lista"><input type="text" name="identity_token" value="<tag:pp_token />" size="30" /></td>
      </tr>

      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.AADS_AP_INFO /></b></center></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_USEAP /></td>
      <tag:ppap />
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_AP_MAIL /></td>
      <td class="lista"><input type="text" name="ap_email" value="<tag:ap_email />" size="30" /></td>
      <td class="header"><tag:language.AADS_AP_SEC /></td>
      <td class="lista"><input type="text" name="ap_sec" value="<tag:ap_sec />" size="30" /></td>
      </tr>

      <tr>
      <td class="header" align="center" colspan="4"><tag:language.AADS_BC_SETTINGS /></td>
      </tr>
      <tr>
      <td class="header" align="center"><tag:language.AADS_USE_BITCOIN /></td>
      <td class="lista">&nbsp;&nbsp;<tag:language.AADS_ENABLE />&nbsp;<input type="radio" name="bitcoin_enabled" value="true" <if:bc_enabled>checked="checked" </if:bc_enabled>/>&nbsp;&nbsp;<tag:language.AADS_DISABLE />&nbsp;<input type="radio" name="bitcoin_enabled" value="false" <if:bc_disabled>checked="checked"</if:bc_disabled>/></td>
      <td class="header" align="center"><tag:language.AADS_BC_ADDRESS /></td>
      <td class="lista"><input type="text" name="bitcoin_address" size="35" value="<tag:bitcoin_address />" /></td>
      </tr>

      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.AADS_OO_INFO /></b></center></td>
      </tr>
      <tr>
        <td class="header" align="center"><tag:language.FLS_ENABLE /></td>
        <td class="lista"><tag:language.YES />&nbsp;<input type="radio" name="fl_slot" value="true" <if:fl_slot_true>checked="checked"</if:fl_slot_true> />&nbsp;&nbsp;&nbsp;<tag:language.NO />&nbsp;<input type="radio" name="fl_slot" value="false" <if:fl_slot_false>checked="checked"</if:fl_slot_false> /></td>
        <td class="header" align="center"><tag:language.FLS_COST /></td>
        <td class="lista"><input type="text" name="fl_slot_cost" value="<tag:fl_slot_cost />" size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_VIP_TRACKER /></td>
      <td class="lista"<if:integratedForumInUse1> <else:integratedForumInUse1> colspan="3"</if:integratedForumInUse1>><tag:pp_rank /></td>
      <if:integratedForumInUse2>
      <td class="header"><tag:language.AADS_VIP_SMF /></td>
      <td class="lista"><tag:pp_smf /></td>
      </if:integratedForumInUse2>
      </tr>


      <tr>
      <td class="header"><tag:language.AADS_VIP_BET /></td>
      <td class="lista">1 <tag:language.WORD_AND /> <input type="text" name="pp_today" value="<tag:pp_today />" size="3" />&nbsp; <tag:language.AADS_UNITS_IS />&nbsp;<input type="text" name="pp_day" value="<tag:pp_day />" size="3" />&nbsp;<tag:language.AADS_VIP_DAYS /></td>
      <td class="header"><tag:language.AADS_GB_BET /></td>
      <td class="lista">1 <tag:language.WORD_AND /> <input type="text" name="pp_togb" value="<tag:pp_togb />" size="3" />&nbsp; <tag:language.AADS_UNITS_IS />&nbsp;<input type="text" name="pp_gb" value="<tag:pp_gb />" size="3" />&nbsp;<tag:language.AADS_GB_PER_UNIT /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_VIP_BET /></td>
      <td class="lista"><tag:pp_count /> <tag:language.WORD_AND /> <input type="text" name="pp_todayb" value="<tag:pp_todayb />" size="3" />&nbsp; <tag:language.AADS_UNITS_IS />&nbsp;<input type="text" name="pp_dayb" value="<tag:pp_dayb />" size="3" />&nbsp;<tag:language.AADS_VIP_DAYS /></td>
      <td class="header"><tag:language.AADS_GB_BET /></td>
      <td class="lista"><tag:pp_counta /> <tag:language.WORD_AND /> <input type="text" name="pp_togbb" value="<tag:pp_togbb />" size="3" />&nbsp; <tag:language.AADS_UNITS_IS />&nbsp;<input type="text" name="pp_gbb" value="<tag:pp_gbb />" size="3" />&nbsp;<tag:language.AADS_GB_PER_UNIT /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_VIP_BET /></td>
      <td class="lista"><tag:pp_countb /> <tag:language.AADS_AND_UP />&nbsp;<input type="text" name="pp_dayc" value="<tag:pp_dayc />" size="3" />&nbsp;<tag:language.AADS_VIP_DAYS /></td>
      <td class="header"><tag:language.AADS_GB_BET /></td>
      <td class="lista"><tag:pp_countc /> <tag:language.AADS_AND_UP />&nbsp;<input type="text" name="pp_gbc" value="<tag:pp_gbc />" size="3" />&nbsp;<tag:language.AADS_GB_PER_UNIT /></td>
     </tr>
      <tr>
      <td class="header"><tag:language.AADS_NEEDED /><br><font color=red><tag:language.AADS_NUM_NO_POINTS /></font></td>
      <td class="lista"><input type="text" name="pp_needed" value="<tag:pp_needed />" size="10" /></td>
      <td class="header"><tag:language.AADS_RECEIVED /><br><font color=red><tag:language.AADS_NUM_NO_POINTS /></font></td>
      <td class="lista"><input type="text" name="pp_received" value="<tag:pp_received />" size="10" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_DUE_DATE /><br><font color=red><tag:language.AADS_DUE_DATE_VALUE /></font></td>
      <td class="lista" width=100%><input type="text" name="pp_due_date" value="<tag:pp_due_date />" size="10" /></td>
      <td class="header"><tag:language.AADS_NUM_DON /></td>
      <td class="lista"><input type="text" name="pp_block" value="<tag:pp_block />" size="10" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_SC_BL_TEXT /></td>
      <td class="lista" ><textarea name="pp_scrol_tekst" rows="3" cols="40"><tag:pp_scrol_tekst /></textarea></td>
      <td class="header"><tag:language.AADS_EN_SC_LINE /></td>
      <tag:testtt />
      </tr>
      <tr>
      <td class="header"><tag:language.AADS_DON_HIST_BR /></td>
      <tag:testttt />
      <td class="header"><tag:language.AADS_SIM_DON_DISP_BR /></td>
      <tag:testtttt />
      </tr>
      <tr> 
        <td class="header"><tag:language.AADS_AUTO /></td> 
        <tag:ppauto /> 
      </tr> 
            <tr>
      <td class="header"><tag:language.AADS_POSS_DON_AMNT /></td><td class="lista"><input type="text" name="poss_don_amnt" size="50" value="<tag:poss_don_amnt />"> (<tag:language.AADS_SEP_BY_COMMA />)</td>
      <td class="header"><tag:language.AADS_UNITS /></td>
      <tag:testt />
      </tr>
      <tr>
     <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.AADS_UPD_SETT />" /></td>
     </tr></table></form>
      
<table class="header" width="100%" align="center">
<tr>

    <td class="header"><center><b><tag:language.AADS_SYS /></b></center></td>
    <td class="header"><center><b><tag:language.AADS_TEST /></b></center></td>
    <td class="header"><center><b><tag:language.ACP_USERNAME /></b></center></td>
    <td class="header"><center><b><tag:language.ANONYMOUS /></b></center></td>
    <td class="header"><center><b><tag:language.AADS_LNAME /></b></center></td>
    <td class="header"><center><b><tag:language.EMAIL /></b></center></td>
    <td class="header"><center><b><tag:language.AADS_DDATE /></b></center></td>
    <td class="header"><center><b><tag:language.AMOUNT /></b></center></td>
    <td class="header"><center><b><tag:language.MNU_UPLOAD /></b></center></td>
    <td class="header"><center><b><tag:language.AADS_VIP /></b></center></td>
    <td class="header"><center><b><tag:language.TR_OLD_RANK /></b></center></td>
    <td class="header"><center><b><tag:language.AADS_FREELEECH /></b></center></td>

  </tr>
  <loop:don>
  <tr>
    <td class="lista"><center><tag:don[].System /></center></td>
    <td class="lista"><center><tag:don[].Test /></center></td>
    <td class="lista"><center><tag:don[].Username /></center></td>
    <td class="lista"><center><tag:don[].Anonymous /></center></td>
    <td class="lista"><center><tag:don[].Last_name /></center></td>
    <td class="lista"><center><tag:don[].Email /></center></td>
    <td class="lista"><center><tag:don[].Date /></center></td>
    <td class="lista"><center><tag:don[].Amount /></center></td>
    <td class="lista"><center><tag:don[].Upload /></center></td>
    <td class="lista"><center><tag:don[].Vip /></center></td>
    <td class="lista"><center><tag:don[].Rank /></center></td>
    <td class="lista"><center><tag:don[].fls /></center></td>


  </tr>
  </loop:don>
  <if:pager_in_use>
    <tr>
      <td colspan=9 class='blocklist' style='text-align:center'><tag:pager /></td>
    </tr>
  </if:pager_in_use>
</table>
