<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">SeedBonus (BON) Settings</h4>
</div>
<if:firstview>
<form method="post" action="index.php?page=admin&amp;user=<tag:uid />&amp;code=<tag:random />&amp;do=seedbonus">
<table class="table table-bordered table-hover">
  <tr>
    <td class="header"><tag:language.AWARD_FOR />:</td>
    <td class="lista" colspan="3"><input type="radio" name="sb_type" value="all"<if:all> checked</if:all>><tag:language.ALL_TORR /><input type="radio" name="sb_type" value="one"<if:one> checked</if:one>><tag:language.ONE_TORR /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BONUS />:</td>
    <td class="lista" colspan="0" style="text-align:center;"><input type="text" size="10" name="bonus" maxlength="5" value="<tag:bonus />"/></td>
  </tr>
  <if:arc_enabled>
  <tr>
    <td class="header"><tag:language.ARC_BONUS />:</td>
    <td class="lista"><input type="checkbox" name="archive_enable"<if:archive_enable> checked="yes"</if:archive_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="3" name="bonus_archive" maxlength="5" value="<tag:bonus_archive />"/></td>
  </tr>
  </if:arc_enabled>
  <tr>
    <td class="header"><tag:language.SB_MAX_PER_HOUR />:</td>
    <td class="lista"><input type="checkbox" name="sb_max_ph_enable"<if:sb_max_ph_enable> checked="yes"</if:sb_max_ph_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="7" name="bonus_max_per_hour" maxlength="10" value="<tag:bonus_max_per_hour />" /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.SB_PNT_4_UPL />:</td>
    <td class="lista"><input type="checkbox" name="sb_speed_enable"<if:sb_speed_enable> checked="yes"</if:sb_speed_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><tag:language.SB_MIN_UL_RATE />: <input type="text" size="4" name="bonus_min_uprate" maxlength="3" value="<tag:bonus_min_uprate />" /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.SB_ALLOW_GIFT />:</td>
    <td class="lista"><input type="checkbox" name="sb_gift_enable"<if:sb_gift_enable> checked="yes"</if:sb_gift_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><tag:language.SB_GIFTMAX />: <input type="text" name="bonus_giftmax" value="<tag:bonus_giftmax />" size="10" maxlength="10" /></td>
  <tr>

  <tr>
    <td class="header"><tag:language.SB_PNTS_4_SHOUT />:</td>
    <td class="lista"><input type="checkbox" name="sb_shout_enable"<if:sb_shout_enable> checked="yes"</if:sb_shout_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="4" name="bonus_make_a_shout" maxlength="4" value="<tag:bonus_make_a_shout />" /></td>
  </tr>
  <if:radio_enabled>
    <tr>
    <td class="header"><tag:language.SB_PNTS_4_RADIO />:</td>
    <td class="lista"><input type="checkbox" name="sb_radio_enable"<if:sb_radio_enable> checked="yes"</if:sb_radio_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="4" name="bonus_listen2radio" maxlength="4" value="<tag:bonus_listen2radio />" /></td>
  </tr>
  </if:radio_enabled>
  <tr>
    <td class="header"><tag:language.BON_FOR_UPLOAD />:</td>
    <td class="lista"><input type="checkbox" name="upl_enable"<if:upl_enable> checked="yes"</if:upl_enable>><tag:language.ENABLE />?</td>
    <td class="lista" style="text-align:center;"><tag:language.POINTS />: <input type="text" size="7" name="bonus_upl" maxlength="7" value="<tag:bonus_upl />"/></td>
    <td class="lista" style="text-align:center;"><tag:language.SB_DELAY />: <input type="text" size="4" name="bonus_upl_delay" maxlength="2" value="<tag:bonus_upl_delay />"/></td>
  </tr>

  <tr>
    <td class="header"><tag:language.BON_FOR_COMMENT />:</td>
    <td class="lista"><input type="checkbox" name="comm_enable"<if:comm_enable> checked="yes"</if:comm_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="7" name="bonus_comm" maxlength="6" value="<tag:bonus_comm />"/></td>
  </tr>

  <tr>
    <td class="header"><tag:language.BON_FOR_FORUM_POST />:</td>
    <td class="lista"><input type="checkbox" name="forpost_enable"<if:forpost_enable> checked="yes"</if:forpost_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="7" name="bonus_forpost" maxlength="6" value="<tag:bonus_forpost />"/></td>
  </tr>

  <tr>
  <td class="header" rowspan="4"><tag:language.PRICE_GB />:</td>
  <td class=lista rowspan=4><input type="checkbox" name="gb_enable"<if:gb_enable> checked="yes"</if:gb_enable>><tag:language.ENABLE />?</td>
  <loop:traf>
         <tr>
         <td class="lista" style="text-align:center;">GB: <input type="text" size="5" name="gb<tag:traf[].name />" maxlength="5" value="<tag:traf[].traffic />"/></td>
         <td class="lista" style="text-align:center;"><tag:language.POINTS />: <input type="text" size="10" name="pts<tag:traf[].name />" maxlength="10" value="<tag:traf[].points />"/></td>
         </tr>
  </loop:traf>
  </tr>
  <tr>
    <td class="header"><tag:language.PRICE_VIP />:</td>
    <td class=lista><input type="checkbox" name="vip_enable"<if:vip_enable> checked="yes"</if:vip_enable>><tag:language.ENABLE />?</td>
    <td class="lista"<if:timed_ranks_enabled_1> <else:timed_ranks_enabled_1>colspan="2"</if:timed_ranks_enabled_1> style="text-align:center;"><input type="text" size="7" name="price_vip" maxlength="7" value="<tag:price_vip />"/></td>
    <if:timed_ranks_enabled_2>
    <td class="lista"><tag:language.TR_TIME_TO_EXP />:
      <select name="vip_timeframe">
        <option value="0"<if:opt1> selected="yes"</if:opt1>><tag:language.NEVER_EXPIRE /></option>
        <option value="7"<if:opt2> selected="yes"</if:opt2>>1 <tag:language.TR_WEEK /></option>
        <option value="14"<if:opt3> selected="yes"</if:opt3>>2 <tag:language.TR_WEEKS /></option>
        <option value="21"<if:opt4> selected="yes"</if:opt4>>3 <tag:language.TR_WEEKS /></option>
        <option value="30"<if:opt5> selected="yes"</if:opt5>>1 <tag:language.TR_MONTH /></option>
        <option value="61"<if:opt6> selected="yes"</if:opt6>>2 <tag:language.TR_MONTHS /></option>
        <option value="91"<if:opt7> selected="yes"</if:opt7>>3 <tag:language.TR_MONTHS /></option>
        <option value="182"<if:opt8> selected="yes"</if:opt8>>6 <tag:language.TR_MONTHS /></option>
        <option value="365"<if:opt9> selected="yes"</if:opt9>>1 <tag:language.TR_YEAR /></option>
      </select>
    </td>
    </if:timed_ranks_enabled_2>
  </tr>
  <tr>
    <td class="header"><tag:language.PRICE_CT />:</td>
    <td class="lista"><input type="checkbox" name="ct_enable"<if:ct_enable> checked="yes"</if:ct_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="10" name="price_ct" maxlength="10" value="<tag:price_ct />"/></td>
  </tr>
  <tr>
    <td class="header"><tag:language.PRICE_NAME />:</td>
    <td class="lista"><input type="checkbox" name="uname_enable"<if:uname_enable> checked="yes"</if:uname_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" size="4" name="price_name" maxlength="6" value="<tag:price_name />"/></td>
  </tr>

  <if:show_inv>
  <tr>
  <td class="header" rowspan="4"><tag:language.PRICE_FOR_INVITES />:</td>
  <td class="lista" rowspan="4"><input type="checkbox" name="inv_enable"<if:inv_enable> checked="yes"</if:inv_enable>><tag:language.ENABLE />?</td>
    <tr>
      <td class="lista" colspan="2">1 <tag:language.SB_INVITE />:&nbsp;&nbsp;<input type="text" size="10" name="inv1" maxlength="10" value="<tag:price_inv />"/></td>
    </tr>
    <tr>
      <td class="lista" colspan="2">3 <tag:language.SB_INVITES />:&nbsp;<input type="text" size="10" name="inv3" maxlength="10" value="<tag:price_inv3 />"/></td>
    </tr>
    <tr>
      <td class="lista" colspan="2">5 <tag:language.SB_INVITES />:&nbsp;<input type="text" size="10" name="inv5" maxlength="10" value="<tag:price_inv5 />"/></td>
    </tr>
  </tr>
  </if:show_inv>
  <if:show_hnr>
  <tr>
    <td class="header"><tag:language.PRICE_FOR_HNR />:</td>
    <td class="lista"><input type="checkbox" name="hnr_enable"<if:hnr_enable> checked="yes"</if:hnr_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" name="price_hnr" value="<tag:price_hnr />" size="7" /></td>
  </tr>
  </if:show_hnr>
  <if:show_fls>
  <tr>
    <td class="header"><tag:language.FLS_PRICE_FOR_FLS />:</td>
    <td class="lista"><input type="checkbox" name="flshot_enable"<if:flshot_enable> checked="yes"</if:flshot_enable>><tag:language.ENABLE />?</td>
    <td class="lista" colspan="2" style="text-align:center;"><input type="text" name="bonus_flslot" value="<tag:bonus_flslot />" size="8" /></td>
  </tr>
  </if:show_fls>
  <tr>
    <td class="header" colspan="4" align="center"><input type="submit" class="btn btn-md btn-primary" value="<tag:language.UPDATE />" name="action"></td>
  </tr>
</table>
</form>
<else:firstview>
<tag:language.SEEDBONUS_UPDATED />
</if:firstview>
<div class="panel-footer">
</div>
</div>
