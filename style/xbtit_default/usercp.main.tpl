<script type="text/javascript">
var newwindow;

function popusers(url)
{
  newwindow=window.open(url,'popusers','height=100,width=450');
  if (window.focus) {newwindow.focus()}
}
</script>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">User CP</h4>
</div>
<div class="panel-body">
<table class="table table-striped">
  <tr>
    <td align="center" class="lista" colspan="3"><br /><tag:language.UCP_NOTE_1 /><br /><tag:language.UCP_NOTE_2 /><br /><br /></td>
  </tr>
  <tr>
    <td width="20%" class="header" align="left"><tag:language.USER_NAME />:</td>
    <td width="80%" class="lista" align="left"><tag:ucp.username /></td>
  <if:AVATAR>
    <td class="lista" align="center" valign="middle" rowspan="4" style="padding:20px 20px 20px 20px;"><tag:ucp.avatar /></td>
  </if:AVATAR>
  </tr>

  <if:birthdays_enabled>
  <tr>
    <td class="header" align="left"><tag:language.USER_AGE />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.age /></td>
  </tr>
  </if:birthdays_enabled>

<if:CAN_EDIT>
  <tr>
    <td class="header" align="left"><tag:language.EMAIL />:</td>
    <td class="lista" align="left"><tag:ucp.email /></td>
  </tr>
  <tr>
    <td class="header" align="left"><tag:language.LAST_IP />:</td>
    <td class="lista" align="left"><tag:ucp.lastip /></td>
  </tr>
</if:CAN_EDIT>
  <tr>
    <td class="header" align="left"><tag:language.USER_LEVEL />:</td>
    <td class="lista" align="left"><tag:ucp.userlevel /></td>
  </tr>

  <tr>
    <td class="header" align="left"><tag:language.USER_JOINED />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.userjoin /></td>
  </tr>
  <tr>
    <td class="header" align="left"><tag:language.USER_LASTACCESS />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.lastaccess /></td>
  </tr>
  <tr>
    <td class="header" align="left"><tag:language.PEER_COUNTRY />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.country /></td>
  </tr>
  <if:hos_enabled>
  <tr>
    <td class="header" align="left"><tag:language.HOS_INV_2_OTHERS />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.invisible /></td>
  </tr>
  </if:hos_enabled>
  <if:showporn_enabled>
  <tr>
    <td class="header" align="left"><tag:language.SP_SHOW_PORN /></td>
    <td class="lista" colspan="2" align="left"><tag:ucp.showporn /></td>
  </tr>
  </if:showporn_enabled>
  <tr>
    <td class="header" align="left"><tag:language.DOWNLOADED />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.download /></td>
  </tr>
  <tr>
    <td class="header" align="left"><tag:language.UPLOADED />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.upload /></td>
  </tr>
  <tr>
    <td class="header" align="left"><tag:language.RATIO />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.ratio /></td>
  </tr>
  <if:fls_enabled>
  <tr>
    <td class="header" align="left"><tag:language.FLS_SLOTS /></td>
    <td class="lista" colspan="2" align="left"><tag:ucp.fls /></td>
  </tr>
  </if:fls_enabled>
  <if:avatar_signature_sync_enabled>
  <tr>
    <td class="header" align="left"><tag:language.SIG_CP /></td>
    <td class="lista" colspan="2" align="left"><tag:usercp_sig /></td>
  </tr>
  </if:avatar_signature_sync_enabled>
  <if:torrentbar_enabled>
  <tr>
    <td class="header" align="left"><tag:language.TORRENTBAR />:</td>
    <td class="lista" colspan="2" align="left"><img src="<tag:ucp.baseurl />/torrentbar.php?<tag:ucp.uid />.png" /><br /><input type="text" style="border-color: #000000; border-style: solid; border-width: 1px; width: 346px; height: 15px;" value="[img]<tag:ucp.baseurl />/torrentbar.php?<tag:ucp.uid />.png[/img]" readonly /></td>
  </tr>
  </if:torrentbar_enabled>

<if:INTERNAL_FORUM>
  <tr>
    <td class="header" align="left"><tag:language.FORUM /> <tag:language.POSTS />:</td>
    <td class="lista" colspan="2" align="left"><tag:posts /></td>
  </tr>
  <if:signature_enabled>
  <tr>
    <td class="header" align="left"><tag:language.SIGNATURE />:</td>
    <td class="lista" colspan="2" align="left"><tag:ucp.signature /></td>
  </tr>
  </if:signature_enabled>
</if:INTERNAL_FORUM>

<if:about_me_enabled>
  <tr>
    <td class="header"><tag:language.AM_ABOUT_ME /></td>
    <td class="lista" colspan="2"><tag:about_me /></td>
  </tr>
</if:about_me_enabled>

<if:rss_feed_enabled>
  <tr>
    <td class="header"><tag:language.ADVRSS_YOUR_FEED /></td>
    <td class="lista" colspan="2"><textarea cols="75"><tag:custom_rss_feed /></textarea></td>
  </tr>
</if:rss_feed_enabled>
</table>
</div>
</div>

