<if:speedstats_enabled>
<div class="panel panel-primary">
<div class="panel-heading">
<div align="center">
<tag:peers.filename />&nbsp;&nbsp;&nbsp;&nbsp;<tag:peers.size />
</div>
</div>
</div>
</if:speedstats_enabled>

<if:NOPEERS>
<div class="panel panel-danger">
<div class="panel-heading">
<div align="center">
<tag:language.NO_PEERS />
</div>
</div>
</div>
<else:NOPEERS>

<script type="text/javascript">
function windowunder(link)
{
  window.opener.document.location=link;
  window.close();
}
</script>

<table class="table table-bordered">
       <tr>
         <td align="center" class="header" colspan="2"><tag:language.USER_NAME /></td>
         <if:peers_flag_1>
         <td align="center" class="header"><tag:language.PEER_COUNTRY /></td>
         </if:peers_flag_1>
         <td align="center" class="header"><tag:language.PEER_PORT /></td>
         <td align="center" class="header"><tag:language.PEER_PROGRESS /></td>
         <td align="center" class="header"><tag:language.PEER_STATUS /></td>
         <td align="center" class="header"><tag:language.PEER_CLIENT /></td>
         <if:warn_edit_allowed_1>
         <td align="center" class="header"><tag:language.PEER_IP /></td>
         </if:warn_edit_allowed_1>
         <td align="center" class="header"><span style="color:red;">&#9660;</span></td>

         <if:speedstats_enabled2>
         <td align="center" class="header"><tag:language.SPEED /> <span style="color:red">&#9660</span></td>
         </if:speedstats_enabled2>
         <td align="center" class="header"><span style="color:green;">&#9650;</span></td>
         <if:speedstats_enabled3>
         <td align="center" class="header"><tag:language.SPEED /> <span style="color:green">&#9650</span></td>
         </if:speedstats_enabled3>

         <td align="center" class="header"><tag:language.RATIO /></td>

         <if:ttimes_enabled_1>
         <td align="center" class="header"><tag:language.ETH_START_DATE /></td>
         <td align="center" class="header"><tag:language.ETH_COMP_DATE /></td>
         <td align="center" class="header"><tag:language.ETH_LAST_ACTION /></td>
         </if:ttimes_enabled_1>

         <if:hnr_enabled>
         <td align="center" class="header"><tag:language.SEEDING_TIME /></td>
         </if:hnr_enabled>

         <td align="center" class="header"><tag:language.SEEN /></td></tr>
         <!-- peers' listing -->
         <loop:peers>
         <tr>
         <td align="center" class="lista"><tag:peers[].USERNAME /></td>
         <td align="center" class="lista"><tag:peers[].PM /></td>
         <if:peers_flag_2>
         <td align="center" class="lista"><tag:peers[].FLAG /></td>
         </if:peers_flag_2>
         <td align="center" class="lista"><tag:peers[].PORT /></td>
         <td valign="center" align="center" class="lista"><tag:peers[].PROGRESS /></td>
         <td align="center" class="lista"><tag:peers[].STATUS /></td>
         <td align="center" class="lista"><tag:peers[].CLIENT /></td>
         <if:warn_edit_allowed_2>
         <td align="center" class="lista"><tag:peers[].IPA /></td>
         </if:warn_edit_allowed_2>
         <td align="center" class="lista"><tag:peers[].DOWNLOADED /></td>
       
         <if:speedstats_enabled4>
         <td align="center" class="lista"><tag:peers[].DLSPEED /></td>
         </if:speedstats_enabled4>
         <td align="center" class="lista"><tag:peers[].UPLOADED /></td>
         <if:speedstats_enabled5>
         <td align="center" class="lista"><tag:peers[].UPSPEED /></td>
         </if:speedstats_enabled5>

         <td align="center" class="lista"><tag:peers[].RATIO /></td>

         <if:ttimes_enabled_2>
         <td align="center" class="lista"><tag:peers[].started_time /></td>
         <td align="center" class="lista"><tag:peers[].completed_time /></td>
         <td align="center" class="lista"><tag:peers[].mtime /></td>
         </if:ttimes_enabled_2>

         <if:hnr_enabled2>
         <td align="center" class="lista"><tag:peers[].SEEDING_TIME /></td>
         </if:hnr_enabled2>

         <td align="center" class="lista"><tag:peers[].SEEN /></td>
       </tr>
</loop:peers>
</table>

<if:ban_clients_enabled>
<if:ADMIN_ACCESS>
    <br />
    <table class="table table-bordered">
      <tr>
        <td class='block' align='center' colspan='6'><tag:language.BAN_CLIENTS /></td>
      </tr>
      <tr>
        <td align='center' class='header'><tag:language.PEER_CLIENT /></td>
        <td align='center' class='header'><tag:language.USER_AGENT /></td>
        <td align='center' class='header'><tag:language.PEER_ID /></td>
        <td align='center' class='header'><tag:language.PEER_ID_ASCII /></td>
        <td align='center' class='header'><tag:language.TIMES_SEEN /></td>
        <td align='center' class='header'><tag:language.BAN_CLIENT /></td>
      </tr>

      <loop:clients>
      <tr>
        <td class='lista'><center><tag:clients[].client /></center></td>
        <td class='lista'><center><tag:clients[].user_agent /></center></td>
        <td class='lista'><center><tag:clients[].peer_id /></center></td>
        <td class='lista'><center><tag:clients[].peer_id_ascii /></center></td>
        <td class='lista'><center><tag:clients[].times_seen /></center></td>
        <td class='lista'><center><a title='<tag:language.BAN /> <tag:clients[].client />' href='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=banclient&agent=<tag:clients[].encode1 />&peer_id=<tag:clients[].encode2 />&returnto=<tag:clients[].encode3 />'><img src='images/smilies/thumbsdown.gif' border='0' alt='<tag:language.BAN />' <tag:clients[].client />'></a></center></td>
      </tr>
      </loop:clients>
    </table>
    <br />

<if:banned_clients>
    <br />
    <table class="table table-bordered">
      <tr>
        <td class='block' align='center' colspan='6'><tag:language.REMOVE_BANNED_CLIENTS /></td>
      </tr>
      <tr>
        <td align='center' class='header'><tag:language.CLIENT /></td>
        <td align='center' class='header'><tag:language.USER_AGENT /></td>
        <td align='center' class='header'><tag:language.PEER_ID /></td>
        <td align='center' class='header'><tag:language.PEER_ID_ASCII /></td>
        <td align='center' class='header'><tag:language.BAN_REASON /></td>
        <td align='center' class='header'><tag:language.REMOVE_BAN /></td>
      </tr>

      <loop:banned>
      <tr>
        <td class='lista'><center><tag:banned[].client_name /></center></td>
        <td class='lista'><center><tag:banned[].user_agent /></center></td>
        <td class='lista'><center><tag:banned[].peer_id /></center></td>
        <td class='lista'><center><tag:banned[].peer_id_ascii /></center></td>
        <td class='lista'><center><tag:banned[].reason /></center></td>
        <td class='lista'><center><a title='<tag:language.REMOVE_BAN_ON /> <tag:banned[].client_name />' href='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=clearclientban&id=<tag:banned[].id />&returnto=<tag:banned[].encode />'><img border='0' src='images/smilies/thumbsup.gif' alt='<tag:language.REMOVE_BAN_ON /> <tag:banned[].client_name />'></a></center></td>
      </tr>
      </loop:banned>
    </table>
</if:banned_clients>
</if:ADMIN_ACCESS>
</if:ban_clients_enabled>
</if:NOPEERS>
<tag:BACK2 />
