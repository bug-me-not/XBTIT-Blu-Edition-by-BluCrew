<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">My Info</h4>
</div>
<div class="panel-body">
<table class="table table-bordered">
  <tr>
    <td width="20%" class="header"><tag:language.USERNAME /></td>
    <td width="80%" class="lista"><tag:userdetailarr.userdetail_username /><tag:userdetailarr.userdetail_send_pm /><tag:userdetailarr.userdetail_edit /><tag:userdetailarr.userdetail_delete /><if:watch_1>&nbsp;<a href="index.php?page=watch&do=on&wid=<tag:userdetailarr.watchid />"><button class="btn btn-xs btn-primary" type="button">Watch</button></a>&nbsp;<a href="index.php?page=watch&do=off&wid=<tag:userdetailarr.watchid />"><button class="btn btn-xs btn-primary" type="button">Unwatch</button></a></if:watch_1><if:ban_button_enabled><tag:userdetailarr.userdetail_banbutton /></if:ban_button_enabled></td>

    <if:userdetail_has_avatar>
      <td class="lista" align="center" valign="middle" rowspan="4" style="padding:20px 20px 20px 20px;"><tag:userdetailarr.userdetail_avatar /></td>
    <else:userdetail_has_avatar>
    </if:userdetail_has_avatar>

    <tr>
    <td class="header"><tag:language.PUN /></td>
    <if:pka_enabled>
    <td class="lista"><tag:language.PREUS_PKA /> <tag:userdetailarr.userdetail_aliases /></td>
    </if:pka_enabled>
    </tr>

    <if:user_img_enabled>
    <tr>
    <td class="header"><tag:language.UIMG_USR_ICONS /></td>
    <td class="lista"><tag:userdetailarr.img_list /></td>
    </tr>
    </if:user_img_enabled>

  <if:warn_enabled>
  <tr>
      <td class="header"><tag:language.WS_WL /></td>
      <td class="lista"><if:warn_edit_allowed_1><if:warn_dec_allowed_1><a href="index.php?page=warn&id=<tag:userdetailarr.id />&type=dec" title="<tag:language.WS_DEC />"></if:warn_dec_allowed_1><img src="images/minus.png" alt="<tag:language.WS_DEC />"/><if:warn_dec_allowed_2></a></if:warn_dec_allowed_2></if:warn_edit_allowed_1>

      <if:warn_log_allowed_1><a href='index.php?page=warnlog&id=<tag:userdetailarr.id />'></if:warn_log_allowed_1>
      <tag:userdetailarr.w_level />
      <if:warn_log_allowed_2></a></if:warn_log_allowed_2>
      <if:warn_edit_allowed_2><if:warn_inc_allowed_1><a href=index.php?page=warn&id=<tag:userdetailarr.id />&type=inc title="<tag:language.WS_INC />"></if:warn_inc_allowed_1><img src="images/plus.png" /><if:warn_inc_allowed_2></a></if:warn_inc_allowed_2></if:warn_edit_allowed_2></td>
  </tr>
  </if:warn_enabled>

  <if:userdetail_edit_admin>
  <tr>
    <td class="header"><tag:language.EMAIL /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_1 />><tag:userdetailarr.userdetail_email /></td>
  </tr>

   <tr>
    <td class="header"><tag:language.LAST_IP /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_2 />><tag:userdetailarr.userdetail_last_ip /></td>
   </tr>

   <tr>
      <td class="header">Last Browser</td>
      <td class="lista"><tag:browser_colspan_1/></td>
    </tr>

    <if:ip2c_view>
    <tr>
      <td class="header"><tag:language.IP2C /></td>
      <td class="lista"<tag:userdetailarr.avatar_colspan_3 />><tag:userdetailarr.IP_country /></td>
    </tr>
    </if:ip2c_view>

  <if:whois_enabled>
  <tr>
    <td class="header"><tag:language.WHOIS /></td>
    <td class="lista" style="overflow:auto; max-width: 650px; max-height: 24em; display:inline-block; display:block;"<tag:userdetailarr.avatar_colspan_4 />><tag:userdetailarr.userdetail_whois /></td>
  </tr>
  </if:whois_enabled>

     <if:timed_ranks_enabled>
     <if:edit_allowed>
     <form method="post" action="index.php?page=timedrank&amp;id=<tag:userdetailarr.id />">
     <input type="hidden" name="returnto" value="index.php?page=userdetails&amp;id=<tag:userdetailarr.id />">
     <tr>
     <td class="head"<tag:userdetailarr.avatar_colspan_5 /> align="center"><b><tag:language.TR_TIMED_RANK_SET /></b></td>
     </tr>

          <tr>
     <td class="header"><tag:language.TR_NEW_RANK /></td>
     <td class="lista"<tag:userdetailarr.avatar_colspan_6 />><tag:userdetailarr.rank_combo /></td>
     </tr>

               <tr>
     <td class="header"><tag:language.TR_OLD_RANK /></td>
     <td class="lista"<tag:userdetailarr.avatar_colspan_7 />><tag:userdetailarr.old_rank /></td>
     </tr>

     <tr>
       <td class="header"><tag:language.TR_TIME_TO_EXP /></td>
       <td class="lista"<tag:userdetailarr.avatar_colspan_8 />>
         <table width="100%" cellspacing=0 border=0>
           <tr>
             <td class="lista" width="65%">
               <select name="t_days">
               <option value="7">1 <tag:language.TR_WEEK /></option>
               <option value="35">5 <tag:language.TR_WEEKS /></option>
               <option value="70">10 <tag:language.TR_WEEKS /></option>
               <option value="140">20 <tag:language.TR_WEEKS /></option>
               <option value="210">30 <tag:language.TR_WEEKS /></option>
               <option value="280">40 <tag:language.TR_WEEKS /></option>
               <option value="350">50 <tag:language.TR_WEEKS /></option>
               <option value="31"><tag:language.TR_ONE_MONTH /></option>
               <option value="182"><tag:language.TR_HALF_YEAR /></option>
               <option value="365"><tag:language.TR_ONE_YEAR /></option>
               <option value="730"><tag:language.TR_TWO_YEARS /></option>
               </select>
             </td>
             <td class="lista"  width="35%" valign="middle">
               <center><input type="submit" class="btn btn-primary btn-sm" value="<tag:language.UPDATE />"></center>
             </td>
           </tr>
         </table>
       </td>
     </tr>
     </form>
     </if:edit_allowed>
     </if:timed_ranks_enabled>


     <!-- Donation History by DiemThuy - Start -->
     <if:donation_history_enabled>
     <form method="post" action="index.php?page=don_hist&amp;id=<tag:userdetailarr.id />">
     <input type="hidden" name="returnto" value="index.php?page=userdetails&amp;id=<tag:userdetailarr.id />">
     <tr>
     <td class="head"<tag:userdetailarr.avatar_colspan_9 /> align="center"><b><tag:language.DON_HIST /></b></td>
     </tr>
     <tr>
     <td class="header"><tag:language.DON_HIST /></td>
     <td class="lista"<tag:userdetailarr.avatar_colspan_10 />><tag:userdetailarr.donations /></td>
     </tr>
     <tr>
     <td class="header"><tag:language.DON_AMT /></td>
     <td class="lista"<tag:userdetailarr.avatar_colspan_11 />>
    <table width="100%" cellspacing=0 border=0>
      <tr>
        <td class="lista" width="65%"><input type="text" name="don_amount" size="4" /></td>
        <td class="lista"  width="35%" valign="middle"><center><input type="submit" class="btn btn-primary btn-sm" value="<tag:language.UPDATE />"></center></td>
      </tr>
    </table>
    </td></tr>
     <tr>
     <td class="header"<tag:userdetailarr.avatar_colspan_12 />></td>
     </tr>
     </form>
     </if:donation_history_enabled>
     <!-- Donation History by DiemThuy - End -->

  <tr>
    <td class="header"><tag:language.USER_LEVEL /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_13 />><tag:userdetailarr.userdetail_level_admin /></td>
  </tr>
  <else:userdetail_edit_admin>

  <tr>
    <td class="header"><tag:language.USER_LEVEL /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_13 />><tag:userdetailarr.userdetail_level /></td>
  </tr>
  </if:userdetail_edit_admin>

    <if:aads_enabled>
    <tag:userdetailarr.timed_rank_header />
    <tag:userdetailarr.timed_rank_title />
    </if:aads_enabled>


  <if:custom_title_enabled>
    <tr>
      <td class="header"><tag:language.CUSTOM_TITLE /></td>
      <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.custom_title /></td>
    </tr>
  </if:custom_title_enabled>

  <if:invite_enabled>
  <tr>
    <td class="header"><tag:language.USER_INVITATIONS /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_invs /></td>
  </tr>

  <if:was_invited>
  <tr>
    <td class="header"><tag:language.USER_INVITED_BY /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_invby /></td>
  </tr>
  </if:was_invited>
  </if:invite_enabled>
  
  <tr>

    <td class="header">Users Invited</td>

    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><a href="index.php?page=modules&module=invite&amp;id=<tag:id />">Show</a></td>

  </tr>


  <tr>
    <td class="header"><tag:language.USER_JOINED /></td>
    <td class="lista" <tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_joined /></td>
  </tr>

  <tr>
    <td class="header"><tag:language.USER_LASTACCESS /></td>
    <td class="lista" <tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_lastaccess /></td>
  </tr>

  <tr>
    <td class="header"><tag:language.PEER_COUNTRY /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_country /></td>
  </tr>

  <if:hos_enabled>
  <tr>
    <td class="header"><tag:language.HOS_INV_2_OTHERS />:</td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_invisible /></td>
  </tr>
  </if:hos_enabled>

  <tr>
    <td class="header"><tag:language.USER_LOCAL_TIME /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_local_time /></td>
  </tr>

   <tr>
    <td class="header">Upload Count</td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_uploads /></td>
  </tr>
  
  <tr>
    <td class="header">Seeding</td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_seeding /></td>
  </tr>
  
  <tr>
    <td class="header">Leeching</td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_leeching /></td>
  </tr>
  
  <tr>
    <td class="header">Snatched</td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_completed /></td>
  </tr>

  <tr>
    <td class="header"><tag:language.DOWNLOADED /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_downloaded /></td>
  </tr>

  <tr>
    <td class="header"><tag:language.UPLOADED /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_uploaded /></td>
  </tr>

  <tr>
    <td class="header"><tag:language.RATIO /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_ratio /></td>
  </tr>

  <if:hnr_enabled7>
  <tr>
    <td class="header"><tag:language.HNR_ABBREVIATION /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_hnr /></td>
  </tr>
  </if:hnr_enabled7>

  <if:fls_enabled>
  <tr>
    <td class="header"><tag:language.FLS_SLOTS /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.fls /></td>
  </tr>
  </if:fls_enabled>

    <if:bonus_system_enabled>
    <tr>
    <td class="header"><tag:language.POINTS /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_bonus /></td>
    </tr>
    </if:bonus_system_enabled>

  <if:avatar_signature_sync_enabled>
  <tr>
    <td class="header"><tag:language.SIG_UD /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_sig /></td>
  </tr>
  </if:avatar_signature_sync_enabled>

  <if:userdetail_forum_internal>
  <tr>
    <td class="header"><tag:language.FORUM />&nbsp;<tag:language.POSTS /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.userdetail_forum_posts /></td>
  </tr>

   <if:signature_enabled>
   <tr>
    <td class="header"><tag:language.SIGNATURE /></td>
    <td class="lista" colspan="2"><tag:userdetailarr.userdetail_signature /></td>
   </tr>
  </if:signature_enabled>
  <else:userdetail_forum_internal>
  </if:userdetail_forum_internal>

  <if:watch>
  <tr>
    <td class="header"><tag:language.WATCH_LOG /><div style="float:right;"><img id="all" src="images/plus.gif" title="list">&nbsp;<img id="none" src="images/minus.gif" title="close list"></div></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><div id="watchlist"></div></td>
  </tr>
  </if:watch>

<if:torrlim_enabled>
<if:tlimit_access>
<form name='torrents_limit' method='post' action='index.php?page=userdetails&amp;id=<tag:userdetailarr.id />'>
  <tr>
    <td class="header"><tag:language.TORRENTS_LIMIT /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><input type='text' name='tlimit' size='4' maxlength='4' value='<tag:userdetailarr.torrents_limit />'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='submit' class='btn btn-warning btn-sm' value='<tag:language.UPDATE />'>&nbsp;&nbsp;&nbsp;<tag:language.ENTER_NEG /></td>
  </tr>
</form>

</if:tlimit_access>
</if:torrlim_enabled>

<if:waittime_enabled>
<if:waittime_access>

<form name='waiting_time' method='post' action='index.php?page=userdetails&amp;id=<tag:userdetailarr.id />'>
  <tr>
    <td class="header"><tag:language.WAITING_TIME /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><input type='text' name='WT' size='4' maxlength='4' value='<tag:userdetailarr.wait_time />'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='submit' value='<tag:language.UPDATE />'>&nbsp;&nbsp;&nbsp;<tag:language.ENTER_NEG /></td>
  </tr>
</form>

</if:waittime_access>
</if:waittime_enabled>

      <!-- Report users & Torrents by DiemThuy - Start -->
      <if:ruat>
      <tr>
        <td class="header"><tag:language.REP_USER /></td>
        <td class="lista"<tag:userdetailarr.avatar_colspan_14 />><tag:userdetailarr.rep /></td>
      </tr>
      </if:ruat>
      <!-- Report users & Torrents by DiemThuy - End -->

<if:show_notes>
  <tr>
    <td class="header"><tag:language.UN_NOTES /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_14 />>
      <div><tag:userdetailarr.note_pager /></div> <br>
  <table border="1" class="lista" width:"100%">
        <tr>
          <td class="head" align="center"><b><tag:language.UN_NOTE /></b></td>
          <td class="head" align="center"><b><tag:language.UN_ADDED_BY /></b></td>
          <td class="head" align="center" width="125px"><b><tag:language.ADDED /></b></td>
          <if:note_admin_1>
          <td class="head" align="center"><b><tag:language.EDIT /></b></td>
          <td class="head" align="center"><b><tag:language.DELETE /></b></td>
          </if:note_admin_1>
        </tr>

        <loop:user_notes>
          <tr>
            <td class="lista" style="text-align:left;"><tag:user_notes[].note /><tag:user_notes[].edited /></td>
            <td class="lista" style="text-align:center;"><a href="<tag:user_notes[].addedby_link />"><tag:user_notes[].username /></a></td>
            <td class="lista" width="125px" style="text-align:center;"><tag:user_notes[].date /></td>
            <if:note_admin_2>
            <td class="lista" style="text-align:center;"><a href='index.php?page=admin&amp;user=<tag:userdetailarr.cuid />&amp;code=<tag:userdetailarr.crand />&amp;do=notemod&amp;action=edit&amp;noteid=<tag:user_notes[].noteid />&amp;eduser=<tag:userdetailarr.un_id />&amp;returnto=<tag:userdetailarr.un_returnto />'><button class="btn btn-primary btn-circle" type="button"><i class="fa fa-pencil-square-o"></i></button></a></td>
            <td class="lista" style="text-align:center;"><a onclick="return confirm('<tag:language.DELETE_CONFIRM />')" href='index.php?page=admin&amp;user=<tag:userdetailarr.cuid />&amp;code=<tag:userdetailarr.crand />&amp;do=notemod&amp;action=delete&amp;noteid=<tag:user_notes[].noteid />&amp;eduser=<tag:userdetailarr.un_id />&amp;returnto=<tag:userdetailarr.un_returnto />'><button class="btn btn-danger btn-circle" type="button"><i class="fa fa-times"></i></button></a></td>
            </if:note_admin_2>
          </tr>
        </loop:user_notes>
      </table>
    </td>
  </tr>
</if:show_notes>

<if:about_me_enabled>
  <tr>
    <td class="header"><tag:language.AM_ABOUT_ME /></td>
    <td class="lista"<tag:userdetailarr.avatar_colspan_15 />><tag:userdetailarr.about_me /></td>
  </tr>
</if:about_me_enabled>

<if:userdetail_clientinfo>
<tr>
  <td class="header">Client/Port Info</td>
  <td class="lista" colspan="2"><tag:client_history_text /></td>
</tr>
</if:userdetail_clientinfo>
</table>

<if:booted_enabled>
<if:booted_access>
<table class="table table-bordered">
   <tr>
    <td class="head" align="center" colspan="2"><b><tag:language.BD /></b></td>
  </tr>
    <tr>
    <td class="header"><tag:language.RFB /></td>
    <td class="lista"><tag:userdetailarr.whybooted /></td>
  </tr>
      <tr>
    <td class="header"><tag:language.ET /></td>
    <td class="lista"><tag:userdetailarr.addbooted /></td>
  </tr>

  <tr>
    <td class="header"><tag:language.AB /></td>
    <td class="lista"><tag:userdetailarr.whobooted /></td>
  </tr>
</table>
<else:booted_access>
</if:booted_access>
<if:adminrebooted_access>
<if:rebooted_access>

<table class="table table-bordered">
   <tr>
    <td class="head" align="center" colspan="2"><b><tag:language.AM /></b></td>
  </tr>
      <tr>
  <form method="post" action="index.php?page=rebooted&amp;id=<tag:userdetailarr.id />">
  <input type="hidden" name="returnto" value="index.php?page=userdetails&amp;id=<tag:userdetailarr.id />">
  <tr>
    <td class="lista" valign="middle"><center><input type="submit" class="btn btn-danger btn-sm" value="<tag:language.RB />"></center></td>
  </tr>
  </form>
  </tr>
</table>
<else:rebooted_access>
</if:rebooted_access>
<else:adminrebooted_access>
</if:adminrebooted_access>
    <!-- Begin Admin Control Panel -->
    <if:booted0_access>
<if:nobooted_access>
<table class="table table-bordered">
  <tr>
    <td class="head" align=center colspan=3><b><tag:language.BS /></b></td>
        <tr>

  </tr>
  </tr>
    <!-- Begin Booted -->
  <form method="post" action="index.php?page=booted&amp;id=<tag:userdetailarr.id />">
  <input type="hidden" name="returnto" value="index.php?page=userdetails&amp;id=<tag:userdetailarr.id />">
  <tr>
    <td class="header"><tag:language.BT /></td>
      <td class="lista"><select name="days">
      <option value="1">1 <tag:language.WS_D /></option>
      <option value="7">1 <tag:language.WS_W /></option>
      <option value="14">2 <tag:language.WS_W_PLURAL /></option>
      <option value="21">3 <tag:language.WS_W_PLURAL /></option>
      <option value="28">4 <tag:language.WS_W_PLURAL /></option>
      <option value="91">13 <tag:language.WS_W_PLURAL /></option>
      <option value="182">26 <tag:language.WS_W_PLURAL /></option>
      <option value="365">1 <tag:language.WS_Y /></option></select></td><td class="lista" colspan=2></td></tr>
      <tr>
      <td class="header"><tag:language.BM /></td>
    <td class="lista"><textarea cols="50" rows="1" name="whybooted"><tag:userdetailarr.whybooted /></textarea></td>
    <td class="lista" valign="middle"><center><input type="submit" class="btn btn-danger btn-sm" value="<tag:language.UPDATE />"></center></td>
  </tr>
  </form>
  <!-- end Booted -->

<else:nobooted_access>
</if:nobooted_access>
<else:booted0_access>
</if:booted0_access>
<!-- End Admin Control Panel -->
</if:booted_enabled>
</div>
</div>
</div>
</table>
<br />

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">My Uploads</h4>
</div>
<table class="table table-bordered">
<tr><td class="block" align="center" colspan="<tag:userdetailarr.colspan2 />" style="text-align:center;"><b><tag:language.UPLOADED /> <tag:language.TORRENTS /></b></td></tr>


<!--panel content goes here-->

<div class="panel-body">
 
  <tr><td align="center" colspan="12"><tag:userdetailarr.pagertop /></td></tr>

  <tr>

    <if:tmod1_enabled>
    <td align="center" class="header"><tag:language.TORRENT_STATUS /></td>
    </if:tmod1_enabled>

    <td align="center" class="header"><if:upsort1><a href="<tag:userdetailarr.udupsorturl1 />"></if:upsort1><tag:language.FILE /><if:upsort2></a></if:upsort2><if:upsort3><tag:userdetailarr.uarrow /></if:upsort3></td>

    <td align="center" class="header"><if:upsort4><a href="<tag:userdetailarr.udupsorturl2 />"></if:upsort4><tag:language.ADDED /><if:upsort5></a></if:upsort5><if:upsort6><tag:userdetailarr.uarrow /></if:upsort6></td>

    <td align="center" class="header"><if:upsort7><a href="<tag:userdetailarr.udupsorturl3 />"></if:upsort7><tag:language.SIZE /><if:upsort8></a></if:upsort8><if:upsort9><tag:userdetailarr.uarrow /></if:upsort9></td>

    <td align="center" class="header"><if:upsort10><a href="<tag:userdetailarr.udupsorturl4 />"></if:upsort10><tag:language.SHORT_S /><if:upsort11></a></if:upsort11><if:upsort12><tag:userdetailarr.uarrow /></if:upsort12></td>

    <td align="center" class="header"><if:upsort13><a href="<tag:userdetailarr.udupsorturl5 />"></if:upsort13><tag:language.SHORT_L /><if:upsort14></a></if:upsort14><if:upsort15><tag:userdetailarr.uarrow /></if:upsort15></td>

    <td align="center" class="header"><if:upsort16><a href="<tag:userdetailarr.udupsorturl6 />"></if:upsort16><tag:language.SHORT_C /><if:upsort17></a></if:upsort17><if:upsort18><tag:userdetailarr.uarrow /></if:upsort18></td>

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
  
  <tr><td align="center" colspan="12"><tag:userdetailarr.pagertop /></td></tr>

  <else:RESULTS>

  <tr>

    <td class="lista" align="center" colspan="<tag:userdetailarr.colspan2 />" style="text-align:center;"><tag:language.NO_TORR_UP_USER /></td>

  </tr>

  </if:RESULTS>

</table>
<div class="panel-footer">
</div>
</div>
</div>
<br />

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Active</h4>
</div>
<div class="panel-body">
<table class="table table-bordered">

  <tr>
  <td class="block" align="center" colspan="<tag:userdetailarr.colspan3 />" style="text-align:center;"><b><tag:language.ACTIVE_TORRENT /></b></td></tr>
  <tr><td align="center" colspan="12"><tag:userdetailarr.pagertopact /></td>
  </tr>

  <tr>

    <td align="center" class="header"><if:acsort1><a href="<tag:userdetailarr.udacsorturl1 />"></if:acsort1><tag:language.FILE /><if:acsort2></a></if:acsort2><if:acsort3><tag:userdetailarr.uarrow2 /></if:acsort3></td>

    <td align="center" class="header"><if:acsort4><a href="<tag:userdetailarr.udacsorturl2 />"></if:acsort4><tag:language.SIZE /><if:acsort5></a></if:acsort5><if:acsort6><tag:userdetailarr.uarrow2 /></if:acsort6></td>

    <td align="center" class="header"><if:acsort7><a href="<tag:userdetailarr.udacsorturl3 />"></if:acsort7><tag:language.PEER_STATUS /><if:acsort8></a></if:acsort8><if:acsort9><tag:userdetailarr.uarrow2 /></if:acsort9></td>

    <td align="center" class="header"><if:acsort10><a href="<tag:userdetailarr.udacsorturl4 />"></if:acsort10><span style="color:red;">&#9660;</span><if:acsort11></a></if:acsort11><if:acsort12><tag:userdetailarr.uarrow2 /></if:acsort12></td>

    <td align="center" class="header"><if:acsort13><a href="<tag:userdetailarr.udacsorturl5 />"></if:acsort13><span style="color:green;">&#9650;</span><if:acsort14></a></if:acsort14><if:acsort15><tag:userdetailarr.uarrow2 /></if:acsort15></td>

    <!--<td align="center" class="header"><if:acsort16><a href="<tag:userdetailarr.udacsorturl6 />"></if:acsort16><tag:language.RATIO /><if:acsort17></a></if:acsort17><if:acsort18><tag:userdetailarr.uarrow2 /></if:acsort18></td>-->

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

    <td class="lista" align="center" colspan="<tag:userdetailarr.colspan3 />" style="text-align:center;"><tag:language.NO_ACTIVE_TORR /></td>

  </tr>


  </if:RESULTS_1>

</table>
<div class="panel-footer">
</div>
</div>
</div>

<br />

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">History</h4>
</div>

<div class="panel-body">
<table class="table table-bordered">

  <tr>
  <td class="block" align="center" colspan="<tag:userdetailarr.colspan />" style="text-align:center;"><b><tag:language.HISTORY /></b></td></tr>
  <tr><td align="center" colspan="12"><tag:userdetailarr.pagertophist /></td>
  </tr>

  <tr>

    <td align="center" class="header"><if:hisort1><a href="<tag:userdetailarr.udhisorturl1 />"></if:hisort1><tag:language.FILE /><if:hisort2></a></if:hisort2><if:hisort3><tag:userdetailarr.uarrow3 /></if:hisort3></td>

    <td align="center" class="header"><if:hisort4><a href="<tag:userdetailarr.udhisorturl2 />"></if:hisort4><tag:language.SIZE /><if:hisort5></a></if:hisort5><if:hisort6><tag:userdetailarr.uarrow3 /></if:hisort6></td>

    <td align="center" class="header"><tag:language.PEER_CLIENT /></td>

    <td align="center" class="header"><if:hisort7><a href="<tag:userdetailarr.udhisorturl3 />"></if:hisort7><tag:language.PEER_STATUS /><if:hisort8></a></if:hisort8><if:hisort9><tag:userdetailarr.uarrow3 /></if:hisort9></td>

    <td align="center" class="header"><if:hisort10><a href="<tag:userdetailarr.udhisorturl4 />"></if:hisort10><span style="color:red;">&#9660;</span><if:hisort11></a></if:hisort11><if:hisort12><tag:userdetailarr.uarrow3 /></if:hisort12></td>

    <td align="center" class="header"><if:hisort13><a href="<tag:userdetailarr.udhisorturl5 />"></if:hisort13><span style="color:green;">&#9650;</span><if:hisort14></a></if:hisort14><if:hisort15><tag:userdetailarr.uarrow3 /></if:hisort15></td>

    <!--<td align="center" class="header"><if:hisort16><a href="<tag:userdetailarr.udhisorturl6 />"></if:hisort16><tag:language.RATIO /><if:hisort17></a></if:hisort17><if:hisort18><tag:userdetailarr.uarrow3 /></if:hisort18></td>-->

    <if:ttimes_enabled_3>
    <td align="center" class="header"><if:hisort31><a href="<tag:userdetailarr.udhisorturl11 />"></if:hisort31><tag:language.ETH_START_DATE /><if:hisort32></a></if:hisort32><if:hisort33><tag:userdetailarr.uarrow3 /></if:hisort33></td>

    <td align="center" class="header"><if:hisort34><a href="<tag:userdetailarr.udhisorturl12 />"></if:hisort34><tag:language.ETH_COMP_DATE /><if:hisort35></a></if:hisort35><if:hisort36><tag:userdetailarr.uarrow3 /></if:hisort36></td>

    <td align="center" class="header"><if:hisort37><a href="<tag:userdetailarr.udhisorturl13 />"></if:hisort37><tag:language.ETH_LAST_ACTION /><if:hisort38></a></if:hisort38><if:hisort39><tag:userdetailarr.uarrow3 /></if:hisort39></td>
    </if:ttimes_enabled_3>

    <if:hnr_enabled>
    <td align="center" class="header"><if:hisort19><a href="<tag:userdetailarr.udhisorturl7 />"></if:hisort19><tag:language.SEEDING_TIME /><if:hisort20></a></if:hisort20><if:hisort21><tag:userdetailarr.uarrow3 /></if:hisort21></td>
    </if:hnr_enabled>

    <td align="center" class="header"><if:hisort22><a href="<tag:userdetailarr.udhisorturl8 />"></if:hisort22><tag:language.SHORT_S /><if:hisort23></a></if:hisort23><if:hisort24><tag:userdetailarr.uarrow3 /></if:hisort24></td>

    <td align="center" class="header"><if:hisort25><a href="<tag:userdetailarr.udhisorturl9 />"></if:hisort25><tag:language.SHORT_L /><if:hisort26></a></if:hisort26><if:hisort27><tag:userdetailarr.uarrow3 /></if:hisort27></td>

    <td align="center" class="header"><if:hisort28><a href="<tag:userdetailarr.udhisorturl10 />"></if:hisort28><tag:language.SHORT_C /><if:hisort29></a></if:hisort29><if:hisort30><tag:userdetailarr.uarrow3 /></if:hisort30></td>

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

    <!--<td align="center" class="lista" style="text-align: center;"><tag:torhistory[].ratio /></td>-->

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

<br />

<br />

<center><tag:userdetailarr.userdetail_back /></center>

<br />

<if:watched_enabled>
	<script type="text/javascript" src="jscript/jquery-1.11.3.min.js"></script>

    <script type="text/javascript">
    var $w = jQuery.noConflict();
       $w("#all").click(function(){
		$w("#watchlist").empty().html('<br /><br /><br /><center><img src="images/loading.gif"></center>');
        $w("#watchlist").load("watcher.php?id=<tag:userdetailarr.id />").css({'height':'300px','overflow':'auto'}).show();
        $w("#none").click(function(){
		$w("#watchlist").hide();
		return false;
	});
    });
    </script>
</if:watched_enabled>
<div class="panel-footer">
</div>
</div>
</div>
