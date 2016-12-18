<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">User Groups</h4>
</div>
<if:add_new>
<form action="<tag:frm_action />" name="level" method="post">
  <table class="lista" width="100%" align="center" style='overflow:auto;'>
    <tr>
      <td class="header"><tag:language.GROUP_NAME /></td>
      <td class="lista"><input type="text" name="gname" value="" size="40" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.GROUP_BASE_LEVEL /></td>
      <td class="lista"><tag:groups_combo /></td>
    </tr>
    <tr>
      <td align="center" class="header"><input type="submit" class="btn btn-success" name="write" value="<tag:language.FRM_CONFIRM />" /></td>
      <td align="center" class="header"><input type="submit" class="btn btn-warning" name="write" value="<tag:language.FRM_CANCEL />" /></td>
    </tr>
  </table>
</form>
<else:add_new>
<if:list>
<div style="overflow:auto; max-width:1100px;"><table class="lista" width="auto" align="center">
  <tr>
    <td class="header" align="center"><tag:language.GROUP /></td>

    <if:lro_enabled_1>
      <td class="header" align="center"><tag:language.LGO_TITLE /></td>
    </if:lro_enabled_1>

    <td class="header" align="center"><tag:language.MNU_TORRENT /><br /><tag:language.VIEW_EDIT_DEL /></td>
    <td class="header" align="center"><tag:language.MEMBERS /><br /><tag:language.VIEW_EDIT_DEL /></td>
    <td class="header" align="center"><tag:language.MNU_NEWS /><br /><tag:language.VIEW_EDIT_DEL /></td>
    <td class="header" align="center"><tag:language.MNU_FORUM /><br /><tag:language.VIEW_EDIT_DEL /></td>

    <if:vedsc_enabled_1>
    <!-- #######################################################
    # view/edit/delete shout, comments -->
    <td class="header" align="center"><tag:language.SHOUTBOX /><br /><tag:language.VIEW_EDIT_DEL /></td>
    <td class="header" align="center"><tag:language.COMMENTS /><br /><tag:language.VIEW_EDIT_DEL /></td>
    <!--# End
    ####################################################### -->
    </if:vedsc_enabled_1>

    <if:torr_mod1_enabled>
    <td class="header" align="center"><tag:language.TRUSTED /></td>
    <td class="header" align="center"><tag:language.TRUSTED_MODERATION /></td>
    </if:torr_mod1_enabled>

    <td class="header" align="center"><tag:language.MNU_UPLOAD /></td>
    <td class="header" align="center"><tag:language.DOWNLOAD /></td>
    <td class="header" align="center"><tag:language.ADMIN_CPANEL /></td>
    <td class="header" align="center"><tag:language.WT /></td>

    <if:autorank>
      <td class="header" align="center"><tag:language.AUTORANK_STATE /></td>
      <td class="header" align="center"><tag:language.AUTORANK_POSITION /></td>
      <td class="header" align="center"><tag:language.AUTORANK_MIN_UPLOAD /></td>
      <td class="header" align="center"><tag:language.AUTORANK_MIN_RATIO /></td>
    </if:autorank>

    <if:smf_in_use_1>
      <td class="header" align="center"><tag:language.SMF_MIRROR /></td>
    </if:smf_in_use_1>

    <if:ipb_in_use_1>
      <td class="header" align="center"><tag:language.IPB_MIRROR /></td>
    </if:ipb_in_use_1>

    <if:dlratiocheck>
      <td class="header" align="center"><tag:language.BYPASS_DLCHECK /></td>
    </if:dlratiocheck>

    <if:torrlim_enabled>
      <td class="header" align="center"><tag:language.MAX_TORRENTS /></td>
    </if:torrlim_enabled>

    <if:teams_enabled>
      <td class="header" align="center"><tag:language.TEAMS_SEL_TEAM /></td>
      <td class="header" align="center"><tag:language.TEAMS_ALL_TEAMS /></td>
    </if:teams_enabled>

    <if:peers_enabled_1>
      <td class="header" align="center"><tag:language.PEERS_VIEW_PEERS /></td>
      <td class="header" align="center"><tag:language.PEERS_VIEW_HIST /></td>
      <td class="header" align="center"><tag:language.PEERS_VIEW_USERD /></td>
    </if:peers_enabled_1>

    <if:nfo_enabled_1>
      <td class="header" align="center"><tag:language.VIEW_NFO /></td>
    </if:nfo_enabled_1>

    <if:reenc_enabled_1>
      <td class="header" align="center"><tag:language.VIEW_REENC /></td>
    </if:reenc_enabled_1>

    <if:req_enabled_1>
      <td class="header" align="center"><tag:language.TRAV_ADD_REQ /></td>
    </if:req_enabled_1>

    <if:ddl_enabled_1>
      <td class="header" align="center"><tag:language.DDL_ADD_ED /></td>
      <td class="header" align="center"><tag:language.DDL_VIEW /></td>
    </if:ddl_enabled_1>

    <if:vipfl_enabled_1>
      <td class="header" align="center"><tag:language.VIPFL_FREELEECH /></td>
    </if:vipfl_enabled_1>

    <if:hos_enabled_1>
      <td class="header" align="center"><tag:language.HOS_CAN_HIDE /></td>
      <td class="header" align="center"><tag:language.HOS_SEE_HIDDEN /></td>
    </if:hos_enabled_1>

    <if:bump_enabled_1>
      <td class="header" align="center"><tag:language.BUMP_CANBUMP_SHORT /></td>
    </if:bump_enabled_1>

    <if:um_enabled_1>
      <td class="header" align="center"><tag:language.UPM_SET_MULTI_SHORT /></td>
      <td class="header" align="center"><tag:language.UPM_VIEW_MULTI_SHORT /></td>
    </if:um_enabled_1>

    <if:at_enabled_1>
      <td class="header" align="center"><tag:language.ARC_VIEW_NEW /></td>
      <td class="header" align="center"><tag:language.ARC_UP_NEW /></td>
      <td class="header" align="center"><tag:language.ARC_DOWN_NEW /></td>
      <td class="header" align="center"><tag:language.ARC_VIEW_ARC /></td>
      <td class="header" align="center"><tag:language.ARC_UP_ARC /></td>
      <td class="header" align="center"><tag:language.ARC_DOWN_ARC /></td>
    </if:at_enabled_1>

    <if:booted_enabled_1>
      <td class="header" align="center"><tag:language.CAN_BOOT_USERS /></td>
    </if:booted_enabled_1>

    <if:ibd_enabled_1>
      <td class="header" align="center"><tag:language.IBD_INTRO_NEEDED /></td>
    </if:ibd_enabled_1>

    <if:pfet_enabled_1>
      <td class="header" align="center"><tag:language.PFET_UPL_EXT /></td>
      <td class="header" align="center"><tag:language.PFET_REF_EXT /></td>
    </if:pfet_enabled_1>

    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:groups>
  <tr>
    <td class="lista" style="text-align:center;"><tag:groups[].user /></td>

    <if:lro_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].logical_rank_order /></td>
    </if:lro_enabled_2>

    <td class="lista" style="text-align:center;"><tag:groups[].torrent_aut /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].users_aut /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].news_aut /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].forum_aut /></td>

    <if:vedsc_enabled_2>
    <!-- #######################################################
    # view/edit/delete shout, comments -->
    <td class="lista" style="text-align:center;"><tag:groups[].shout_aut /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].comments_aut /></td>
    <!--# End
    ####################################################### -->
    </if:vedsc_enabled_2>

    <if:torr_mod2_enabled>
    <td class="lista" style="text-align:center;"><tag:groups[].trusted /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].moderate_trusted /></td>
    </if:torr_mod2_enabled>

    <td class="lista" style="text-align:center;"><tag:groups[].can_upload /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].can_download /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].admin_access /></td>
    <td class="lista" style="text-align:center;"><tag:groups[].WT /></td>

    <if:autorank2>
      <td class="lista" style="text-align:center;"><tag:groups[].arstate /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].arpos /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].arupdowntrig /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].arratiotrig /></td>
    </if:autorank2>

    <if:smf_in_use_2>
      <td class="lista" style="text-align:center;"><tag:groups[].smf_group_mirror /></td>
    </if:smf_in_use_2>

    <if:ipb_in_use_2>
      <td class="lista" style="text-align:center;"><tag:groups[].ipb_group_mirror /></td>
    </if:ipb_in_use_2>

    <if:dlratiocheck2>
      <td class="lista" style="text-align:center;"><tag:groups[].bypass_dlcheck /></td>
    </if:dlratiocheck2>

    <if:torrlim_enabled2>
      <td class="lista" style="text-align:center;"><tag:groups[].torrents_limit /></td>
    </if:torrlim_enabled2>

    <if:teams_enabled2>
      <td class="lista" style="text-align:center;"><tag:groups[].sel_team /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].all_teams /></td>
    </if:teams_enabled2>

    <if:peers_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].view_peers /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].view_history /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].view_userdetails_torrents /></td>
    </if:peers_enabled_2>

    <if:nfo_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].view_nfo /></td>
    </if:nfo_enabled_2>

    <if:reenc_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].view_reencode /></td>
    </if:reenc_enabled_2>

    <if:req_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].add_request /></td>
    </if:req_enabled_2>

    <if:ddl_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].add_ddl /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].view_ddl /></td>
    </if:ddl_enabled_2>

    <if:vipfl_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].freeleech /></td>
    </if:vipfl_enabled_2>

    <if:hos_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].can_hide /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].see_hidden /></td>
    </if:hos_enabled_2>

    <if:bump_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].bump_torrents /></td>
    </if:bump_enabled_2>

    <if:um_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].set_multi /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].view_multi /></td>
    </if:um_enabled_2>

    <if:at_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].view_new /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].up_new /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].down_new /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].view_arc /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].up_arc /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].down_arc /></td>
    </if:at_enabled_2>

    <if:booted_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].can_boot /></td>
    </if:booted_enabled_2>

    <if:ibd_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].down_req_intro /></td>
    </if:ibd_enabled_2>

    <if:pfet_enabled_2>
      <td class="lista" style="text-align:center;"><tag:groups[].external_upload /></td>
      <td class="lista" style="text-align:center;"><tag:groups[].external_refresh /></td>
    </if:pfet_enabled_2>

    <td class="lista" style="text-align:center;"><tag:groups[].delete /></td>
  </tr>
  </loop:groups>
</table></div>

<table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center" style="text-align:left;"><tag:group_add_new /></td>
  </tr>
</table>

<else:list>
<form action="<tag:frm_action />" name="level" method="post">
  <table class="lista" width="100%" style="text-align:center">
    <tr>
      <td class="header"><tag:language.GROUP_NAME /></td>
      <td class="lista"><input type="text" name="gname" value="<tag:group.level />" size="40" /></td>
    </tr>

    <if:lro_enabled_3>
    <tr>
      <td class="header"><tag:language.LRO_INFO /></td>
      <td class="lista"><input type="text" name="logical_rank_order" value="<tag:group.logical_rank_order />" size="3" maxlength="3" /></td>
    </tr>
    <if:lro_enabled_3>

    <tr>
      <td class="header"><tag:language.GROUP_PCOLOR />&lt;span style='color:red'&gt;):</td>
      <td class="lista"><input type="text" name="pcolor" value="<tag:group.prefixcolor />" size="40" maxlength="150" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.GROUP_SCOLOR />&lt;/span&gt;):</td>
      <td class="lista"><input type="text" name="scolor" value="<tag:group.suffixcolor />" size="40" maxlength="150" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.GROUP_WT />&nbsp;(hours):</td>
      <td class="lista"><input type="text" name="waiting" value="<tag:group.WT />" size="20" maxlength="10" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.MNU_TORRENT /></td>
      <td class="lista">
        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vtorrents" <tag:group.view_torrents /> />&nbsp;&nbsp;
        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="etorrents" <tag:group.edit_torrents /> />&nbsp;&nbsp;
        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dtorrents" <tag:group.delete_torrents /> />
      </td>
    </tr>
    <tr>
      <td class="header"><tag:language.MEMBERS /></td>
      <td class="lista">
        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vusers" <tag:group.view_users /> />&nbsp;&nbsp;
        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="eusers" <tag:group.edit_users /> />&nbsp;&nbsp;
        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dusers" <tag:group.delete_users /> />
      </td>
    </tr>
    <tr>
      <td class="header"><tag:language.MNU_NEWS /></td>
      <td class="lista">
        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vnews" <tag:group.view_news /> />&nbsp;&nbsp;
        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="enews" <tag:group.edit_news /> />&nbsp;&nbsp;
        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dnews" <tag:group.delete_news /> />
      </td>
    </tr>
    <tr>
      <td class="header"><tag:language.GROUP_VIEW_FORUM /></td>
      <td class="lista">
        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vforum" <tag:group.view_forum /> />&nbsp;&nbsp;
        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="eforum" <tag:group.edit_forum /> />&nbsp;&nbsp;
        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dforum" <tag:group.delete_forum /> />
      </td>
    </tr>

    <if:vedsc_enabled_3>
    <!-- #######################################################
    # view/edit/delete shout, comments -->
    <tr>
      <td class="header"><tag:language.SHOUTBOX /></td>
      <td class="lista">
        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vshout" <tag:group.view_shout /> />&nbsp;&nbsp;
        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="eshout" <tag:group.edit_shout /> />&nbsp;&nbsp;
        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dshout" <tag:group.delete_shout /> />
      </td>
    </tr>
    <tr>
      <td class="header"><tag:language.COMMENTS /></td>
      <td class="lista">
        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vcomments" <tag:group.view_comments /> />&nbsp;&nbsp;
        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="ecomments" <tag:group.edit_comments /> />&nbsp;&nbsp;
        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dcomments" <tag:group.delete_comments /> />
      </td>
    </tr>
    <!--# End
    ####################################################### -->
    </if:vedsc_enabled_3>

    <tr>
      <td class="header"><tag:language.GROUP_UPLOAD /></td>
      <td class="lista"><input type="checkbox" name="upload" <tag:group.can_upload /> /></td>
    </tr>

    <if:torr_mod3_enabled>
    <tr>
      <td class="header"><tag:language.TRUSTED /></td>
      <td class="lista"><input type="checkbox" name="trusted" <tag:group.trusted /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.TRUSTED_MODERATION /></td>
      <td class="lista"><input type="checkbox" name="moderate_trusted" <tag:group.moderate_trusted /> /></td>
    </tr>
    </if:torr_mod3_enabled>

    <tr>
      <td class="header"><tag:language.GROUP_DOWNLOAD /></td>
      <td class="lista"><input type="checkbox" name="down" <tag:group.can_download /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.GROUP_GO_CP /></td>
      <td class="lista"><input type="checkbox" name="admincp" <tag:group.admin_access /> /></td>

    <if:autorank3>
    </tr>
      <tr>
        <td class="header"><tag:language.AUTORANK_STATE /></td>
        <td class="lista"><select name='arstate'><tag:group.autorank_state />\n</select></td>
      </tr>
      <tr>
        <td class="header"><tag:language.AUTORANK_POSITION /></td>
        <td class="lista"><input type="text" name="arpos" value="<tag:group.autorank_position />" /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.AUTORANK_MIN_UPLOAD /><b><tag:language.AUTORANK_IN_BYTES /></b></td>
        <td class="lista"><input type="text" name="arminup" value="<tag:group.autorank_min_upload />" /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.AUTORANK_MIN_RATIO /></td>
        <td class="lista"><input type="text" name="arminratio" value="<tag:group.autorank_minratio />" /></td>
      </tr>
    </if:autorank3>

    <if:smf_in_use_3>
    <tr>
      <td class="header"><tag:language.GROUP_SMF_MIRROR /></td>
      <td class="lista"><tag:group.forumlist /><input type="text" name="smf_group_mirror" value="<tag:group.smf_group_mirror />" size="4" maxlength="4" /></td>
    </tr>
    </if:smf_in_use_3>

    <if:ipb_in_use_3>
    <tr>
      <td class="header"><tag:language.GROUP_IPB_MIRROR /></td>
      <td class="lista"><tag:group.forumlist /><input type="text" name="ipb_group_mirror" value="<tag:group.ipb_group_mirror />" size="4" maxlength="4" /></td>
    </tr>
    </if:ipb_in_use_3>

    <if:dlratiocheck3>
    <tr>
      <td class="header"><tag:language.BYPASS_DLCHECK /></td>
      <td class="lista"><input type="checkbox" name="bypass_dlcheck" <tag:group.bypass_dlcheck /></td>
    </if:dlratiocheck3>

    </tr>

    <if:torrlim_enabled3>
    <tr>
      <td class="header"><tag:language.MAX_TORRENTS /></td>
      <td class="lista"><input type="text" name="torrents_limit" value="<tag:group.torrents_limit />"</td>
    </tr>
    </if:torrlim_enabled3>

    <if:teams_enabled3>
    <tr>
      <td class="header"><tag:language.TEAMS_SEL_TEAM /></td>
      <td class="lista"><select name='sel_team'><tag:group.sel_team /></select></td>
  <!--    <td class="lista"><input type="text" name="sel_team" value='<tag:group.sel_team />' /></td> -->
    </tr>
    <tr>
      <td class="header"><tag:language.TEAMS_ALL_TEAMS /></td>
      <td class="lista"><input type="checkbox" name="all_teams" <tag:group.all_teams /> /></td>
    </tr>
    </if:teams_enabled3>

    <if:peers_enabled_3>
    <tr>
      <td class="header"><tag:language.PEERS_VIEW_PEERS /></td>
      <td class="lista"><input type="checkbox" name="view_peers" <tag:group.view_peers /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.PEERS_VIEW_HIST /></td>
      <td class="lista"><input type="checkbox" name="view_history" <tag:group.view_history /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.PEERS_VIEW_USERD /></td>
      <td class="lista"><input type="checkbox" name="view_userdetails_torrents" <tag:group.view_userdetails_torrents /> /></td>
    </tr>
    </if:peers_enabled_3>

    <if:nfo_enabled_3>
    <tr>
      <td class="header"><tag:language.VIEW_NFO /></td>
      <td class="lista"><input type="checkbox" name="view_nfo" <tag:group.view_nfo /> /></td>
    </tr>
    </if:nfo_enabled_3>

    <if:reenc_enabled_3>
    <tr>
      <td class="header"><tag:language.VIEW_REENC /></td>
      <td class="lista"><input type="checkbox" name="view_reencode" <tag:group.view_reencode /> /></td>
    </tr>
    </if:reenc_enabled_3>

    <if:req_enabled_3>
    <tr>
      <td class="header"><tag:language.TRAV_ADD_REQ /></td>
      <td class="lista"><input type="checkbox" name="add_request" <tag:group.add_request /> /></td>
    </tr>
    </if:req_enabled_3>

    <if:ddl_enabled_3>
    <tr>
      <td class="header"><tag:language.DDL_ADD_ED /></td>
      <td class="lista"><input type="checkbox" name="add_ddl" <tag:group.add_ddl /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.DDL_VIEW /></td>
      <td class="lista"><input type="checkbox" name="view_ddl" <tag:group.view_ddl /> /></td>
    </tr>
    </if:ddl_enabled_3>

    <if:vipfl_enabled_3>
    <tr>
      <td class="header"><tag:language.VIPFL_FREELEECH /></td>
      <td class="lista"><input type="checkbox" name="freeleech" <tag:group.freeleech /> /></td>
    </tr>
    </if:vipfl_enabled_3>

    <if:hos_enabled_3>
    <tr>
      <td class="header"><tag:language.HOS_CAN_HIDE /></td>
      <td class="lista"><input type="checkbox" name="can_hide" <tag:group.can_hide /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.HOS_SEE_HIDDEN /></td>
      <td class="lista"><input type="checkbox" name="see_hidden" <tag:group.see_hidden /> /></td>
    </tr>
    </if:hos_enabled_3>

    <if:bump_enabled_3>
    <tr>
      <td class="header"><tag:language.BUMP_CANBUMP /></td>
      <td class="lista"><input type="checkbox" name="bump_torrents" <tag:group.bump_torrents /> /></td>
    </tr>
    </if:bump_enabled_3>

    <if:um_enabled_3>
    <tr>
      <td class="header"><tag:language.UPM_SET_MULTI /></td>
      <td class="lista"><input type="checkbox" name="set_multi" <tag:group.set_multi /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.UPM_VIEW_MULTI /></td>
      <td class="lista"><input type="checkbox" name="view_multi" <tag:group.view_multi /> /></td>
    </tr>
    </if:um_enabled_3>

    <if:at_enabled_3>
    <tr>
      <td class="header"><tag:language.ARC_VIEW_NEW /></td>
      <td class="lista"><input type="checkbox" name="view_new" <tag:group.view_new /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.ARC_UP_NEW /></td>
      <td class="lista"><input type="checkbox" name="up_new" <tag:group.up_new /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.ARC_DOWN_NEW /></td>
      <td class="lista"><input type="checkbox" name="down_new" <tag:group.down_new /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.ARC_VIEW_ARC /></td>
      <td class="lista"><input type="checkbox" name="view_arc" <tag:group.view_arc /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.ARC_UP_ARC /></td>
      <td class="lista"><input type="checkbox" name="up_arc" <tag:group.up_arc /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.ARC_DOWN_ARC /></td>
      <td class="lista"><input type="checkbox" name="down_arc" <tag:group.down_arc /> /></td>
    </tr>
    </if:at_enabled_3>

    <if:booted_enabled_3>
    <tr>
      <td class="header"><tag:language.CAN_BOOT_USERS /></td>
      <td class="lista"><input type="checkbox" name="can_boot" <tag:group.can_boot /> /></td>
    </tr>
    </if:booted_enabled_3>

    <if:ibd_enabled_3>
    <tr>
      <td class="header"><tag:language.IBD_INTRO_NEEDED /></td>
      <td class="lista"><input type="checkbox" name="down_req_intro" <tag:group.down_req_intro /> /></td>
    </tr>
    </if:ibd_enabled_3>

    <if:pfet_enabled_3>
    <tr>
      <td class="header"><tag:language.PFET_UPL_EXT /></td>
      <td class="lista"><input type="checkbox" name="external_upload" <tag:group.external_upload /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.PFET_REF_EXT /></td>
      <td class="lista"><input type="checkbox" name="external_refresh" <tag:group.external_refresh /> /></td>
    </tr>
    </if:pfet_enabled_3>

    <tr>
      <td align="center" class="header"><input type="submit" class="btn btn-success" name="write" value="<tag:language.FRM_CONFIRM />" /></td>
      <td align="center" class="header"><input type="submit" class="btn btn-warning" name="write" value="<tag:language.FRM_CANCEL />" /></td>
    </tr>
  </table>
</form>
</if:list>
</if:add_new>
<div class="panel-footer">
</div>
</div>
