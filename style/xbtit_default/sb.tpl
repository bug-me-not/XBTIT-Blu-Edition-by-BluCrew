<if:logged_user>
  <br />
  <div class="panel panel-primary">
<div class="panel-heading">
  <div align="center">
    <h1>
      <tag:language.BONUS_INFO1 /><tag:cc />).<br /><tag:language.BONUS_INFO2 />
    </h1>
  </div>
  </div>
  </div>

  <div align="center">
  <table class="table table-bordered" width="474" align="center">
    <tr>
      <td class="head" align="center" width="26"><tag:language.OPTION /></td>
      <td class="head" align="center" width="319"><tag:language.WHAT_ABOUT /></td>
      <td class="head" align="center" width="41"><tag:language.POINTS /></td>
      <td class="head" align="center" width="62"><tag:language.EXCHANGE /> </td>
    </tr>

    <if:gb_enabled>
      <loop:gb_enable>
        <form action="seedbonus_exchange.php?id=<tag:gb_enable[].id />" method="post">
          <tr>
            <td class="lista" style="text-align:center;font-weight:bold;"><tag:gb_enable[].name /></td>
            <td class="lista" style="text-align:left;font-weight:bold;"><tag:gb_enable[].gb /><tag:language.GB_UPLOAD /></td>
            <td class="lista" style="text-align:center;"><tag:gb_enable[].points /></td>
            <td class="lista" style="text-align:center;"><input type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:gb_enable[].enabled />></td>
          </tr>
        </form>
      </loop:gb_enable>
    </if:gb_enabled>

    <if:vip_enabled>
      <form action="seedbonus_exchange.php?id=vip" method="post">
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;">4</td>
          <td class="lista" style="font-weight:bold;"><tag:language.UP_TO_VIP /><tag:vip_for /></td>
          <td class="lista" style="text-align:center;"><tag:price_vip /></td>
          <td class="lista"><input onclick="return confirm('<tag:language.BONUS_VIP_CONFIRM /> <tag:language.UP_TO_VIP />?')" type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:vip_anc />></td>
        </tr>
      </form>
    </if:vip_enabled>

    <if:inv_enabled>
      <form action="seedbonus_exchange.php?id=inv" method="post">
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;">5</td>
          <td class="lista" style="font-weight:bold;"><tag:language.SB_GET_1_INV /></td>
          <td class="lista" style="text-align:center;"><tag:price_inv1 /></td>
          <td class="lista"><input type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:inv1 />></td>
        </tr>
      </form>
      <form action="seedbonus_exchange.php?id=inv3" method="post">
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;">6</td>
          <td class="lista" style="font-weight:bold;"><tag:language.SB_GET_3_INV /></td>
          <td class="lista" style="text-align:center;"><tag:price_inv3 /></td>
          <td class="lista"><input type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:inv3 />></td>
        </tr>
      </form>
      <form action="seedbonus_exchange.php?id=inv5" method="post">
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;">7</td>
          <td class="lista" style="font-weight:bold;"><tag:language.SB_GET_5_INV /></td>
          <td class="lista" style="text-align:center;"><tag:price_inv5 /></td>
          <td class="lista"><input type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:inv5 />></td>
        </tr>
      </form>
    </if:inv_enabled>

    <if:flsl_enabled>
      <form action="seedbonus_exchange.php?id=flslot" method="post">
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;">8</td>
          <td class="lista" style="font-weight:bold;"><tag:language.FLS_BONUS_GET /></td>
          <td class="lista" style="text-align:center;"><tag:price_fls /></td>
          <td class="lista" style="text-align:center;"><input type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:fls />></td>
        </tr>
      </form>
    </if:flsl_enabled>


    <if:ct_enabled>
      <tr>
        <td class="head" align="center" colspan="5" style="font-weight:bold;"><tag:language.CHANGE_CUSTOM_TITLE /><tag:price_ct />)</td>
      </tr>
      <if:can_afford_ct>
        <tr>
          <td class="lista"><tag:language.CUSTOM_TITLE /></td>
          <td class="lista" colspan="5"><if:no_ct><i><tag:language.NO_CUSTOM_TITLE /></i><else:no_ct><tag:custom_title /></if:no_ct></td>
        </tr>
        <form action="title2.php?action=changetitle" method="post">
          <tr>
            <td class="lista" style="text-align:center;font-weight:bold;">9</td>
            <td class="lista" colspan="2"><input type="text" name="title" size="50" maxlength="50" value="<tag:custom_title />"></td>
            <td class="lista" style="text-align:center;"><input type="submit" name="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!"></td>
          </tr>
        </form>
      <else:can_afford_ct>
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;" colspan="5"><tag:language.NEED_MORE_POINTS /></td>
        </tr>
      </if:can_afford_ct>
    </if:ct_enabled>

    <if:un_enabled>
      <tr>
        <td class="head" style="text-align:center;font-weight:bold;" colspan="5"><tag:language.CHANGE_USERNAME /><tag:price_name />)</td>
      </tr>
      <if:can_afford_unc>
        <tr>
          <td class="lista"><tag:language.MEMBER /></td>
          <td class="lista" colspan="5"><tag:username /></td>
        </tr>
        <form method="post" action="username.php?action=changename">
          <tr>
            <td class="lista" style="text-align:center;font-weight:bold;">10</td>
            <td class="lista" colspan="2"><input type="text" name="name" size="50" maxlength="50" value="<tag:username />"></td>
            <td class="lista" style="text-align:center;"><input type="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!"></td>
          </tr>
        </form>
      <else:can_afford_unc>
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;" colspan="5"><tag:language.NEED_MORE_POINTS /></td>
        </tr>
      </if:can_afford_unc>
    </if:un_enabled>

    <if:gift_enabled>
      <tr>
        <td class="head" colspan="4" style="text-align:center;font-weight:bold;"><tag:language.SB_MAKE_A_GIFT /></td>
      </tr>
      <tr>
        <td class="lista" rowspan="2" style="text-align:center;font-weight:bold;">11</td>
        <td class="lista"><tag:language.USERNAME /></td>
        <td class="lista" colspan="2"><tag:language.POINTS /> (<tag:giftmax /> <tag:language.POINTS /> <tag:language.SB_SHORT_MAXIMUM />)</td>
      </tr>
      <form action="seedbonus_exchange.php?id=sb_gift" method="post">
        <tr>
          <td class="lista"><input type="text" name="gift_user" value="" size="43" maxlength="40" /></td>
          <td class="lista"><input type="text" name="gift_points" value="" size="3" maxlength="6" /></td>
          <td class="lista" style="text-align:center";><input type="hidden" name="approval_code" value="<tag:approval_code />" /><input type="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" /></td>
        </tr>
      </form>
    </if:gift_enabled>

    <if:bon_enabled>
      <tr>
         <td class='head' colspan='4' style="text-align:center;font-weight:bold;">BON Pool</td>
      </tr>
      <tr><form method='post' action='index.php?page=modules&amp;module=pool'>
         <td class="lista" style="text-align:center;font-weight:bold;">12</td>
         <td class='lista' colspan='2'>BON Pool: <tag:bon_figure /></td>
         <td class='lista' style="text-align:center";><input type='submit' class="btn btn-labeled btn-danger" value='<tag:language.EXCHANGE />!' /></td></form>
      </tr>
    </if:bon_enabled>

    <if:hnr_enabled>
      <tr>
        <td class="head" colspan="4" style="text-align:center;font-weight:bold;"><tag:language.SB_DECREASE_HNR /></td>
      </tr>
      <if:hnr_found>
        <tr>
          <td class="lista" rowspan="2" style="text-align:center;font-weight:bold;">12</td>
          <td class="head" style="text-align:center;"><tag:language.SB_OLDEST_HNR /></td>
          <td class="head" style="text-align:center;"><tag:language.POINTS /></td>
          <td class="head" style="text-align:center;"><tag:language.EXCHANGE /></td>
        </tr>
        <form action="seedbonus_exchange.php?id=hnr" method="post">
          <tr>
            <td class="lista"><a href="<if:seo><tag:seo_filename />-<tag:oldest_hnr_id />.html<else:seo>index.php?page=torrent-details&id=<tag:oldest_hnr_hash /></if:seo>"><tag:oldest_hnr_filename /></a><tag:oldest_hnr /></td>
            <td class="lista" style="text-align:center;"><tag:price_hnr /></td>
            <td class="lista" style="text-align:center;"><input type="submit" class="btn btn-labeled btn-danger" value="<tag:language.EXCHANGE />!" <tag:hnr />></td>
          </tr>
          <input type="hidden" name="info_hash" value="<tag:oldest_hnr_hash />" />
          <input type="hidden" name="filename" value="<tag:oldest_hnr_filename />" />
          <input type="hidden" name="seo_filename" value="<tag:seo_filename />" />
          <input type="hidden" name="id" value="<tag:oldest_hnr_id />" />
        </form>

      <else:hnr_found>
        <tr>
          <td class="lista" style="text-align:center;font-weight:bold;" colspan="5"><tag:language.SB_NO_HNR /></td>
        </tr>
      </if:hnr_found>
    </if:hnr_enabled>

    <tr>
      <td class="lista" colspan="5">
        <span style="text-align:center;"><h1><tag:language.BONUS_INFO3 /></h1></span>
        <li><tag:language.BONUS_INFO3a />
        <if:cond1><tag:language.BONUS_INFO3b /> <tag:bonus_min_uprate /> <tag:language.BONUS_INFO3c /></if:cond1> <tag:language.BONUS_INFO3d /> <span style="font-weight:bold;"><tag:bonus /> <if:cond2><tag:language.BONUS_INFO4a /><else:cond2><tag:language.BONUS_INFO4 /></if:cond2></span><if:cond3> <tag:language.BONUS_INFO5 /><if:cond4>. <tag:language.BONUS_INFO3e /> <tag:bonus_mph /> <tag:language.BONUS_INFO3f /></if:cond4></if:cond3></li>
        <if:cond15><li><tag:language.BONUS_INFO13 /> <b><tag:bonus_archive /> <if:cond16><tag:language.BONUS_INFO4a /><else:cond16><tag:language.BONUS_INFO4 /></if:cond16></b> <tag:language.BONUS_INFO14 /></li></if:cond15>
        <if:cond5><li><tag:language.BONUS_INFO6 /> <span style="font-weight:bold;"><tag:bonus_upl /> <if:cond6><tag:language.BONUS_INFO4a /><else:cond6><tag:language.BONUS_INFO4 /></if:cond6></span> <tag:language.BONUS_INFO7 /> <tag:bonus_upl_delay /> <tag:language.BONUS_INFO8 /></li></if:cond5>
        <if:cond7><li><tag:language.BONUS_INFO6 /> <span style="font-weight:bold;"><tag:bonus_comm /> <if:cond8><tag:language.BONUS_INFO4a /><else:cond8><tag:language.BONUS_INFO4 /></if:cond8></span> <tag:language.BONUS_INFO9 /></li></if:cond7>
        <if:cond9><li><tag:language.BONUS_INFO6 /> <span style="font-weight:bold;"><tag:bonus_forpost /> <if:cond10><tag:language.BONUS_INFO4a /><else:cond10><tag:language.BONUS_INFO4 /></if:cond10></span> <tag:language.BONUS_INFO10 /></li></if:cond9>
        <if:cond11><li><tag:language.BONUS_INFO6 /> <span style="font-weight:bold;"><tag:bonus_make_a_shout /> <if:cond12><tag:language.BONUS_INFO4a /><else:cond12><tag:language.BONUS_INFO4 /></if:cond12></span> <tag:language.BONUS_INFO11 /></li></if:cond11>
        <if:cond13><li><tag:language.BONUS_INFO6 /> <span style="font-weight:bold;"><tag:bonus_listen2radio /> <if:cond14><tag:language.BONUS_INFO4a /><else:cond14><tag:language.BONUS_INFO4 /></if:cond14></span> <tag:language.BONUS_INFO12 /></li></if:cond13>
      </td>
    </tr>
  </table>
  </div>
<else:logged_user>
  <br />
  <div align="center"><tag:language.ERR_PERM_DENIED /></div>
</if:logged_user>
