
<!-- Trailers -->
<script type="text/javascript">
jQuery(function($) {
$(document).ready(function () {
  $('#get-data').click(function () {
    var showData = $('#show-data');
        $.getJSON('https://api.themoviedb.org/3/movie/tt1386697/videos?api_key=aa8b43b8cbce9d1689bef3d0c3087e4d&language=en-US', function (data) {
      console.log(data);

      var items = data.results.map(function (item) {
/*        return item.key + ': ' + item.value;  */
            return item.name +'<br><div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="http://www.youtube.com/embed/'+ item.key +'?html5=1" frameborder="0"></iframe></div>';
      });

      showData.empty();

      if (items.length) {
        var content = '<li class="list-unstyled">' + items.join('</li><li class="list-unstyled">') + '</li>';
        var list = $('<ul />').html(content);
        showData.append(list);
      }
    });

    showData.text('Loading the JSON file.');
  });
});
});
</script>
<!-- Trailers END -->

<script type="text/javascript">
   function ShowHide(id,id1) 
   {
      obj = document.getElementsByTagName("div");
      if (obj[id].style.display == 'block')
      {
         obj[id].style.display = 'none';
         obj[id1].style.display = 'block';
      }
      else 
      {
         obj[id].style.display = 'block';
         obj[id1].style.display = 'none';
      }
   }

   function windowunder(link)
   {
      window.opener.document.location=link;
      window.close();
   }

   function refresh_peers(myvar)
   {
      var xhReq = new XMLHttpRequest();
      xhReq.open("GET", "refresh_peers.php?id="+myvar, false);
      xhReq.send(null);
      var serverResponse = xhReq.responseText;
      var new_peers=serverResponse.split('[*]');
      document.getElementById("peer_counts").innerHTML = "<tag:language.SEEDERS />: <a href='index.php?page=peers&amp;id=<tag:torrent.info_hash />'>"+new_peers[0]+"</a>, <tag:language.LEECHERS />:  <a href='index.php?page=peers&amp;id=<tag:torrent.info_hash />'>"+new_peers[1]+"</a> = <a href='index.php?page=peers&amp;id=<tag:torrent.info_hash />'>"+new_peers[2]+"</a> <tag:language.PEERS />&nbsp;&nbsp;&nbsp;<i class='fa fa-refresh fa-spin' border='0' onclick='refresh_peers(\"<tag:torrent.info_hash />\")' title='<tag:language.REFRESH_PEERS />' />";
   }

   function disable_button(state)
   {
      document.getElementById('ty').disabled=(state=='1'?true:false);
   }

   at=new sack();

   function ShowUpdate()
   {
      var mytext=at.response + '';
      var myout=mytext.split('|');
      document.getElementById('thanks_div').style.display='block';
      document.getElementById('loading').style.display='none';
   document.getElementById('thanks_div').innerHTML = myout[0]; //at.response;
   disable_button(myout[1]);
}

function thank_you(ia)
{
   disable_button('1');
   at.resetData();
   at.onLoading=show_wait;
   at.requestFile='thanks.php';
   at.setVar('infohash',"'"+ia+"'");
   at.setVar('thanks',1);
   at.onCompletion = ShowUpdate;
   at.runAJAX();
}

function ShowThank(ia)
{
   at.resetData();
   at.onLoading=show_wait;
   at.requestFile='thanks.php';
   at.setVar('infohash',"'"+ia+"'");
   at.onCompletion = ShowUpdate;
   at.runAJAX();
}

function show_wait()
{
   document.getElementById('thanks_div').style.display='none';
   document.getElementById('loading').style.display='block';
}

function dt_disable_button(state)
{
   document.getElementById('tys').disabled=(state=='1'?true:false);
}

tat=new sack();

function dt_ShowUpdate()
{
   var mytexta=tat.response + '';
   var myouta=mytexta.split('|');
   document.getElementById('reencode_div').style.display='block';
   document.getElementById('loadinga').style.display='none';
   document.getElementById('reencode_div').innerHTML = myouta[0]; //at.response;
   dt_disable_button(myouta[1]);
}

function dt_thank_you(ia)
{
   dt_disable_button('1');
   tat.resetData();
   tat.onLoading=dt_show_wait;
   tat.requestFile='reencode.php';
   tat.setVar('infohash',"'"+ia+"'");
   tat.setVar('reencode',1);
   tat.onCompletion = dt_ShowUpdate;
   tat.runAJAX();
}

function dt_ShowThank(ia)
{
   tat.resetData();
   tat.onLoading=dt_show_wait;
   tat.requestFile='reencode.php';
   tat.setVar('infohash',"'"+ia+"'");
   tat.onCompletion = dt_ShowUpdate;
   tat.runAJAX();
}

function dt_show_wait()
{
   document.getElementById('reencode_div').style.display='none';
   document.getElementById('loadinga').style.display='block';
}

function dt_disable_buttonb(state)
{
   document.getElementById('tyt').disabled=(state=='1'?true:false);
}

fat=new sack();

function dt_ShowUpdateb()
{
   var mytextb=fat.response + '';
   var myoutb=mytextb.split('|');
   document.getElementById('reencodeb_div').style.display='block';
   document.getElementById('loadingb').style.display='none';
   document.getElementById('reencodeb_div').innerHTML = myoutb[0]; //at.response;
   dt_disable_buttonb(myoutb[1]);
}

function dt_thank_youb(ia)
{
   dt_disable_buttonb('1');
   fat.resetData();
   fat.onLoading=dt_show_waitb;
   fat.requestFile='reencodeb.php';
   fat.setVar('infohashb',"'"+ia+"'");
   fat.setVar('reencodeb',1);
   fat.onCompletion = dt_ShowUpdateb;
   fat.runAJAX();
}

function dt_ShowThankb(ia)
{
   fat.resetData();
   fat.onLoading=dt_show_waitb;
   fat.requestFile='reencodeb.php';
   fat.setVar('infohashb',"'"+ia+"'");
   fat.onCompletion = dt_ShowUpdateb;
   fat.runAJAX();
}

function dt_show_waitb()
{
   document.getElementById('reencodeb_div').style.display='none';
   document.getElementById('loadingb').style.display='block';
}

</script>

<if:internal_clock>
<div align="center" class="panel">
   <script type="text/javascript" src="jscript/countdown.js"></script>
   <link href="css/countdown.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript">
      var $clock=jQuery.noConflict();
      $clock(document).ready(function(){
         $clock(".internal-clock").buildCounter({
            now_timestamp      : "<tag:timenow />", /* Current time. Fill if you are using server side unix timestamp like PHP strtotime("now"); */
            stardate_timestamp : "<tag:timeup />", /* Start date. Fill if you are using server side unix timestamp like PHP strtotime("25 May 2013 11:00:00"); */
            enddate_timestamp  : "<tag:timedone />", /* End date. Fill if you are using server side unix timestamp like PHP strtotime("25 May 2013 00:00:00"); */

            startdate        : "1 November 2013 00:00:00 GMT", /* Client-Side time. Start Date. This is overwrited if unix timestamp exists. */
            enddate          : "1 April 2017 00:00:00 GMT", /* Client-Side time. End Date. This is overwrited if unix timestamp exists. */
            color1           : "", /* Days Circle Color */
            color2           : "#37a3ff", /* Hours Circle Color */
            color3           : "#e05fdb", /* Minutes Circle Color */
            color4           : "#ff7891", /* Seconds Circle Color */
            backgroundcolor1 : "",    /* Days Circle Background Color */
            backgroundcolor2 : "#e3dfdf",    /* Hours Circle Background Color */
            backgroundcolor3 : "#e3dfdf",    /* Minutes Circle Background Color */
            backgroundcolor4 : "#e3dfdf",    /* Seconds Circle Background Color */
            glow1            : "", /* Days Circle Color Glow */
            glow2            : "", /* Hours Circle Color Glow */
            glow3            : "", /* Minutes Circle Color Glow */
            glow4            : "", /* Seconds Circle Color Glow */
            glowwidth1       : "",       /* Days Circle Glow Width */
            glowwidth2       : "0",       /* Hours Circle Glow Width */
            glowwidth3       : "0",       /* Minutes Circle Glow Width */
            glowwidth4       : "0",       /* Seconds Circle Glow Width */
            backgroundwidth1 : "",      /* Days Circle Background Width */
            backgroundwidth2 : "25",      /* Hours Circle Background Width */
            backgroundwidth3 : "25",      /* Minutes Circle Background Width */
            backgroundwidth4 : "25",      /* Seconds Circle Background Width */
            frontwidth1      : "",      /* Days Circle Width */
            frontwidth2      : "15",      /* Hours Circle Width */
            frontwidth3      : "15",      /* Minutes Circle Width */
            frontwidth4      : "15",      /* Seconds Circle Width */
            size1            : "",     /* Days Clock Size */
            size2            : "130",     /* Hours Clock Size */
            size3            : "130",     /* Minutes Clock Size */
            size4            : "130",     /* Seconds Clock Size */
            textsize1        : "",      /* Days Font Size */
            textsize2        : "12",      /* Hours Font Size */
            textsize3        : "12",      /* Minutes Font Size */
            textsize4        : "12",      /* Seconds Font Size */
            countsize1       : "",      /* Days Count Font Size */
            countsize2       : "18",      /* Hours Count Font Size */
            countsize3       : "18",      /* Minutes Count Font Size */
            countsize4       : "18",      /* Seconds Count Font Size */
            textcolor1       : "", /* Days Font Color */
            textcolor2       : "#FF0000", /* Hours Font Color */
            textcolor3       : "#FF0000", /* Minutes Font Color */
            textcolor4       : "#FF0000", /* Seconds Font Color */
            countcolor1      : "", /* Days Count Font Color */
            countcolor2      : "#FF0000", /* Hours Count Font Color */
            countcolor3      : "#FF0000", /* Minutes Count Font Color */
            countcolor4      : "#FF0000", /* Seconds Count Font Color */
            layout           : "hms",    /* Clock layouts: dhms, hms, ms, s */
            callback         : function(){
               /*alert("Countdown is complete!"); */
            }
         });});
      </script>

      <div style="line-height: 15px;height:45px;width:100%;background: repeating-linear-gradient( 45deg,#D13A3A,#D13A3A 10px,#DF4B4B 10px,#DF4B4B 20px);border:solid 1px #B22929;border-radius:3px;-webkit-box-shadow: 0px 0px 6px #B22929;margin-bottom:-0px;margin-top:0px;font-family:Verdana;font-size:large;text-align:center;color:white"><br>Please remember to say <b>thanks</b> and <b>seed</b> for as long as you can.</div>
      <div class="internal-clock-text" style="font-size: 22px; text-align: center; text-decoration: underline;">This is an internal release so please wait until 24hr countdown timer is complete to share elsewhere</div>
      <div class="internal-clock" style="padding-left: 35%; padding-top:20px; padding-bottom:200px;"></div></div>
   </if:internal_clock>
   <div align="center">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
     <li class="active"><a href="#main" data-toggle="tab">Main</a></li>
     <li class=""><a href="#details" data-toggle="tab">Details</a></li>
     <li class=""><a href="#gift" data-toggle="tab">Gift</a></li>
     <li class=""><a href="#BluMovieDB" data-toggle="tab">BluMovieDB</a></li>
     <li class=""><a href="#DiscArt" data-toggle="tab">Disk Art</a></li>
     <li class=""><a href="#trailer" data-toggle="tab">Trailer</a></li>
     <li class=""><a href="#comment" data-toggle="tab">Comments</a></li>
  </ul>

  <div id="myTabContent" class="tab-content"><!-- Main Content Tab Start -->
    <div role="tabpanel" class="tab-pane fade in active" id="main"><!-- Tab Start -->

      <table class="table table-bordered">
         <tr>
            <td class="lista" style="text-align:center;" colspan="2"><img class="banner" src="<tag:banner />" /></td>
         </tr>

      <br>

      <tr>
         <td class="lista" style="text-align:center;" colspan="2"><h1><tag:torrent.filename2 /></h1><p class= "text-danger"><tag:language.INFO_HASH />:&nbsp;&nbsp;<tag:torrent.info_hash /></p><if:MOD><tag:mod_task /></if:MOD></td>
      </tr>

      <if:fls_enabled>
      <tr>
         <td align="right" class="header"><tag:language.FLS_CUSTOM_FL /></td>
         <td class="lista" style="text-align:left;" valign="middle"><if:hash_found><button class='btn btn-labeled btn-success' type='button'><span class='btn-label'><i class='fa fa-unlock'></i></span>FL Slot Active</button><else:hash_found><if:have_slots1><a href="index.php?page=fls&amp;id=<tag:torrent.info_hash />"></if:have_slots1><button class='btn btn-labeled btn-danger' type='button'><span class='btn-label'><i class='fa fa-lock'></i></span>FL Slot Inactive</button><if:have_slots2></a></if:have_slots2></if:hash_found></td>
      </tr>
   </if:fls_enabled>
   <if:tmod1_enabled>
   <if:MODER>
   <tr>
      <td align="right" class="header"><tag:language.TORRENT_MODERATION /></td>
      <td class="lista" align="left"><tag:torrent.moderation /></td>
   </tr>
</if:MODER>
</if:tmod1_enabled>

<if:download_locked>
<if:need_intro>
<tr>
   <td align="right" class="header"><tag:language.TORRENT /></td>
   <td class="lista"><span style="font-weight:bold;"><tag:language.IBD_NEED_TO_INTRODUCE_1 /> <if:newThread><tag:language.IBD_NEED_TO_INTRODUCE_2A /><else:newThread><tag:language.IBD_NEED_TO_INTRODUCE_2B /></if:newThread> <tag:language.IBD_NEED_TO_INTRODUCE_3 /> <tag:introForumLink /><tag:language.HERE /></a></span>.</td>
</tr>
</if:need_intro>
<else:download_locked>
<tr>
   <td align="right" class="header"><tag:language.TORRENT /></td>
   <if:dlratiocheck>
   <td class="lista" align="left" style="text-align:left;" valign="top"><a href="index.php?page=downloadcheck&amp;id=<tag:torrent.info_hash />" role="button" class="btn btn-labeled btn-primary"><span class='btn-label'><i class='fa fa-download'></i></span>Download</a></td>
   <else:dlratiocheck>
   <td class="lista" align="left" style="text-align:left;" valign="top"><a href="download.php?id=<tag:torrent.info_hash />&amp;f=<tag:down_filename />.torrent" role="button" class="btn btn-labeled btn-primary"><span class='btn-label'><i class='fa fa-download'></i></span>Download</a></td>
</if:dlratiocheck>
</tr>
</if:download_locked>

<if:ddl_enabled>
<if:has_direct_link>
<tr>
   <td align="right" class="header"><tag:language.DIRECT_DOWNLOAD /></td>
   <td class="lista" align="left" style="text-align:left;" valign="top"><a href="<tag:direct_link />" target="_blank"><img src="<tag:BASEURL />/images/ddl.png" border="0" alt="<tag:language.DIRECT_DOWNLOAD />" title="<tag:language.DIRECT_DOWNLOAD />" /></a></td>
</tr>
</if:has_direct_link>
</if:ddl_enabled>

<if:mult_enabled>
<tr>
   <td align='right' class='header'><tag:language.UPM_UPL_MULT /></td>
   <td align='left' class='lista' colspan='2'><tag:mult /></td>
</tr>
</if:mult_enabled>

<if:auto_topic_enabled>
<if:FORUM_LNK>
<tr>
   <td align="right" class="header"><tag:language.FORUM /></td>
   <td class="lista" align="center"><tag:torrent.topicid /></td>
</tr>
</if:FORUM_LNK>
</if:auto_topic_enabled>

<if:reenc_enabled>
<tr>
   <td align="right" class="header" valign="top"><tag:language.REENCODE /></td>
   <td class="lista" align="center">
      <form action="reencode.php" method="post" onsubmit="return false">
         <div id="reencode_div" name="reencode_div" style="display:block;"></div>
         <div id="loadinga" name="loadinga" style="display:none;"><img src="images/ajax-loader.gif" alt="" title="ajax-loader" /></div>
         <input type="button" id="tys" disabled="disabled" value="<tag:language.REENCODER />" onclick="dt_thank_you('<tag:torrent.info_hash />')" />
      </form>
      <script type="text/javascript">dt_ShowThank('<tag:torrent.info_hash />');</script>

      <form action="reencodeb.php" method="post" onsubmit="return false">
         <div id="reencodeb_div" name="reencodeb_div" style="display:block;"></div>
         <div id="loadingb" name="loadingb" style="display:none;"><img src="images/ajax-loader.gif" alt="" title="ajax-loader" /></div>
         <input type="button" id="tyt" disabled="disabled" value="<tag:language.REENCODERB />" onclick="dt_thank_youb('<tag:torrent.info_hash />')" />
      </form>
      <script type="text/javascript">dt_ShowThankb('<tag:torrent.info_hash />');</script>
   </td>
</tr>
</if:reenc_enabled> 

<if:teams_enabled>
<tag:teamview />
</if:teams_enabled>

<if:thanks_enabled>
<tr>
   <td align="right" class="header" valign="top"><tag:language.THANKS_USERS /></td>
   <td class="lista" align="left">
      <form action="thanks.php" method="post" onsubmit="return false">
         <div id="thanks_div" name="thanks_div" style="display:block;"></div>
         <div id="loading" name="loading" style="display:none;"><img src="images/ajax-loader.gif" alt="" title="ajax-loader" /></div>
         <input type="button" id="ty" disabled="disabled" class="btn btn-primary btn-sm" value="<tag:language.THANKS_YOU />" onclick="thank_you('<tag:torrent.info_hash />')" />
      </form>
      <script type="text/javascript">ShowThank('<tag:torrent.info_hash />');</script>
   </td>
</tr>
</if:thanks_enabled>

<if:st_comm_enabled>
<if:LEVEL_SC>
<tr>
   <td align="right" class="header" ><tag:language.STAFF_COMMENT /></td>
   <td class="lista" align="center"><tag:torrent_staff_comment /></td>
</tr>
</if:LEVEL_SC>
</if:st_comm_enabled>

<if:SHOW_UPLOADER>
<tr>
   <td align="right" class="header"><tag:language.UPLOADER /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.uploader /></td>
</tr>
</if:SHOW_UPLOADER>

<tr>
   <td align="right" class="header"><tag:language.CATEGORY_FULL /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.cat_name /></td>
</tr>

<if:torlang>
<tr>
   <td align="right" class="header"><tag:language.LANGUAGE /></td>
   <td class="lista" align="left"><tag:language /></td>
</tr>
</if:torlang>

<tr>
   <td align="right" class="header"><tag:language.SIZE /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.size /></td>
</tr>

<if:sub_enabled>
<if:HAVE_SUBTITLE>
<tr>
   <td align="right" class="header">External Subtitles</td>
   <td class="lista" align="left">
      <table>
         <loop:subs>
         <tr>
            <td align="left"><tag:subs[].flag /></td>
            <td align="left"><tag:subs[].name /></td>
         </tr>
      </loop:subs>
   </table>
</td>
</tr>
</if:HAVE_SUBTITLE>
</if:sub_enabled>

<if:DISPLAY_FILES>
<tr>
   <td align="right" class="header" valign="top"><a name="expand" href="#expand" onclick="javascript:ShowHide('files','msgfile');"><tag:language.SHOW_HIDE /></a></td>
   <td align="left" class="lista">
      <div style="display:none" id="files">
         <table class="lista">
            <tr>
               <td align="center" class="header"><tag:language.FILE /></td>
               <td align="center" class="header" style="text-align:left;" valign="top"><tag:language.SIZE /></td>
            </tr>
            <loop:files>
            <tr>
               <td align="center" class="lista" style="text-align:left;" valign="top"><tag:files[].filename /></td>
               <td align="center" class="lista" style="text-align:left;" valign="top"><tag:files[].size /></td>
            </tr>
         </loop:files>
      </table>
   </div>
   <div style="display:block" id="msgfile" align="left"><tag:torrent.numfiles /></div>
</td>
</tr>
</if:DISPLAY_FILES>

<tr>
   <td align="right" class="header"><tag:language.ADDED /></td>
   <td class="lista" style="text-align:left;" valign="top"><tag:torrent.date /></td>
</tr>

<if:NOT_XBTT>
<tr>
   <td align="right" class="header"><tag:language.SPEED /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.speed /></td>
</tr>
</if:NOT_XBTT>

<if:viewcount_enabled>
<tr>
   <td align="right" class="header"><tag:language.TORRENT_VIEWS /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.viewcount /></td>
</tr>
</if:viewcount_enabled>

<tr>
   <td align="right" class="header"><tag:language.DOWNLOADED /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.downloaded /></td>
</tr>

<tr>
   <td align="right" class="header"><tag:language.PEERS /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><div id="peer_counts"><tag:torrent.seeds />, <tag:torrent.leechers /> = <tag:torrent.peers /><if:refresh_peers_enabled>&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh fa-spin" border="0" onclick="refresh_peers('<tag:torrent.info_hash />')" title="<tag:language.REFRESH_PEERS />" /></if:refresh_peers_enabled></div></td>
</tr>

<tr>
   <td align="right" class="header"><tag:language.RATING /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.rating /></td>
</tr>

<if:bookmark_enabled>
<tr>
   <td align="right" class="header"><tag:language.ADDB /></td>
   <td class="lista" align="left"><a href="index.php?page=bookmark&amp;do=add&amp;torrent_id=<tag:id />"><button class='btn btn-labeled btn-success' type='button'><span class='btn-label'><i class='fa fa-bookmark'></i></span>Bookmark This Upload</button></span></a></td>
</tr>
</if:bookmark_enabled>

<if:AFR>
<if:reseed_possible>
<tr>
   <td align="right" class="header"><tag:language.AFR_RESEED /></td>
   <td class="lista" align="center" style="text-align:left;"><tag:reseed /></td>
</tr>
</if:reseed_possible>
</if:AFR>

<!-- Report users & Torrents by DiemThuy - Start -->
<if:ruat>
<tr>
   <td align="right" class="header"><tag:language.REP_TORR /></td>
   <td align="center" class="lista" style="text-align:left;"><tag:rep /></td>
</tr>
</if:ruat>
<!-- Report users & Torrents by DiemThuy - End -->


<if:similar_enabled>
<tr>
   <td align="right" class="header"><tag:language.details_similar_torrents /></td>
   <td class="lista">
      <button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#similar">Show Similar Uploads</button>
      <div id="similar" class="collapse">
         <table width="100%" class="main" border="1" cellspacing="0" cellpadding="1" style="text-align:center;">
            <tr>
               <td class="header" style="text-align:center;"><tag:language.details_name /></td>
               <td class="header" style="text-align:center;"><tag:language.details_date /></td>
               <td class="header" style="text-align:center;"><tag:language.details_size /></td>
               <td class="header" style="text-align:center;"><tag:language.details_seeders /></td>
               <td class="header" style="text-align:center;"><tag:language.details_leechers /></td>
            </tr>
            <loop:similar_torrents>
            <tr>
               <td class="lista" style="text-align:center;"><a href="index.php?page=torrent-details&amp;id=<tag:similar_torrents[].info_hash />&amp;hit=1"><b><tag:similar_torrents[].name /></b></a></td>
               <td class="lista" style="text-align:center;"><tag:similar_torrents[].date /></td>
               <td class="lista" style="text-align:center;"><tag:similar_torrents[].size /></td>
               <td class="lista" style="text-align:center;"><span style="color:<tag:similar_torrents[].sc />"><tag:similar_torrents[].seeds /></span></td>
               <td class="lista" style="text-align:center;"><span style="color:<tag:similar_torrents[].lc />"><tag:similar_torrents[].leechers /></span></td>
            </tr>
         </loop:similar_torrents>
      </table>
   </div>
</td>
</tr>
</if:similar_enabled>

<if:EXTERNAL>
<tr>
   <td valign="middle" align="right" class="header"><tag:torrent.update_url /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.announce_url /></td>
</tr>
<tr>
   <td valign="middle" align="right" class="header"><tag:language.LAST_UPDATE /></td>
   <td class="lista" align="center" style="text-align:left;" valign="top"><tag:torrent.lastupdate /> (<tag:torrent.lastsuccess />)</td>
</tr>
</if:EXTERNAL>
</table>
</div> <!-- Tab End -->

<div role="tabpanel" class="tab-pane fade" id="details"><!-- Tab Start -->
   <if:nfo_enabled>
   <if:view_nfo>
   <if:nfo_exists>
   <div align=right><a href='#nfo' onclick='javascript:ShowHide("slidenfo","");'><tag:language.NFO_SHOW_HIDE /></a></div>
   <div align='center' style='display:none' id='slidenfo'>
      <img src='nfo/nfogen.php?nfo=rep/<tag:torrent.info_hash />.nfo&amp;colour=1'>
   </div>
</if:nfo_exists>
</if:view_nfo>
</if:nfo_enabled>
<tag:torrent.description />
</div> <!-- Tab End -->

<div role="tabpanel" class="tab-pane fade" id="gift"><!-- Tab Start -->
   <p class= "text-info"><h3><tag:language.SEND_POINTS /></h3></p>
   <div class="row">
      <div class="col-md-12">
         <tag:coin />
      </div>
   </div>
</div> <!-- Tab End -->

<!-- Tab Start -->
<div role="tabpanel" class="tab-pane fade" id="BluMovieDB"> 
<if:has_bmdb>
  <div class="row">
   <div class="col-md-12">
   <h1><a href='https://www.imdb.com/title/<tag:blu_imdb />/' target='_blank'><p class="text-success"><tag:blu_title />&nbsp;&nbsp;(<tag:blu_year />)</p></a><small>Rating: <tag:blu_rating /></small></h1>
   <b>Runtime:</b> <tag:blu_runtime /><br>
   <b>Genre:</b> <tag:blu_genre /><br>
   <b>Langauge:</b> <tag:blu_lang /><br>
   <b>Country:</b> <tag:blu_country /><br>
   <b>Production:</b> <tag:blu_pro /><br>
   <b>Released:</b> <tag:blu_released /><br><br>


   <p class='lead'>
      <b>Director:</b> <tag:blu_director /><br>
      <b>Actors:</b> <tag:blu_actors /><br>
   </p>

   <p>Plot: <tag:blu_plot /></p><br>
   <p>Awards: <tag:blu_awards /></p>
   <br>

   <h1 style="color:red;">Rotten Tomatoes</h1>
   <b>Tomato Meter:</b> <tag:blu_tmeter /><br>
   <b>Tomato Rating:</b> <tag:blu_trating /><br><br>
   <b>Tomato Reviews:</b> <tag:blu_treview /><br>
   <b>Tomato Fresh (+):</b> <tag:blu_tfresh /><br>
   <b>Tomato Rotten (-):</b> <tag:blu_trotten /><br>
   <br>
   <b>Tomato User Meter:</b> <tag:blu_tumeter /><br>
   <b>Tomato User Rating:</b> <tag:blu_turating /><br>
   <b>Tomato User Review:</b> <tag:blu_tureviews /><br>
   <br>

   <h1 style="color:red;">Extra</h1>
   <b>DVD Release Date:</b> <tag:blu_dvd /><br>
   <b>Box Office:</b> <tag:blu_office /><br>
   <b>Website:</b> <tag:blu_site /><br>
</div> 
</div>
<else:has_bmdb>
<p class='text-warning'>No data available</p>
</if:has_bmdb>
<br><p class="text-warning">Powered By FanArt, OMDB, TVDB, API's and The BluRG Community</p>
</div>
<!-- Tab End -->

<!-- Tab Start -->
<div role="tabpanel" class="tab-pane fade" id="DiscArt"> 
<p><h1>COMING SOON!</h1></p>
   <br>
   <br>
   <br>
   <p class="text-warning">Powered By FanArt API</p>
</div>
<!-- Tab End -->

<div role="tabpanel" class="tab-pane fade" id="trailer"><!-- Tab Start -->
<div id="get-data" class="btn btn-info">Load Trailer</div>
<div class="container">
   <div id="show-data"></div> 
</div>
   <br>
   <br>
   <br>
   <p class="text-warning">Powered By TMDB API</p>
</div> <!-- Tab End -->

<div role="tabpanel" class="tab-pane fade" id="comment"><!-- Tab Start -->
   <if:vedsc_enabled_1>
   <!-- #######################################################
   # view/edit/delete shout, comments -->

   <if:VIEW_COMMENTS>

   <script type="text/javascript">
      <!--
      function SetAllCheckBoxes(FormName, FieldName, CheckValue) {
         if(!document.forms[FormName])
            return;
         var objCheckBoxes = document.forms[FormName].elements[FieldName];
         if(!objCheckBoxes)
            return;
         var countCheckBoxes = objCheckBoxes.length;
         if(!countCheckBoxes)
            objCheckBoxes.checked = CheckValue;
         else
      // set the check value for all check boxes
   for(var i = 0; i < countCheckBoxes; i++)
      objCheckBoxes[i].checked = CheckValue;
   document.forms[FormName].elements['all_down'].checked = CheckValue;
}
-->
</script>

<form name="deleteallcomments" method="post" action="index.php?page=torrent-details&amp;id=<tag:torrent.info_hash />">

   <!-- # End
   ####################################################### -->
   <br/>
</if:vedsc_enabled_1>
<if:comments_above_en>
<tag:comments_above />
</if:comments_above_en>
<a name="comments" /></a> <!---otherwise leaks-->
<br />
<br />
<table width="100%" class="lista">
   <if:INSERT_COMMENT>
   <tr>
      <td align="center" colspan="3">
         <a href="index.php?page=comment&amp;id=<tag:torrent.info_hash />&amp;usern=<tag:current_username />"><button class="btn btn-labeled btn-info btn-lg" type="button">
         <span class="btn-label"><i class="fa fa-comment"></i></span>Insert Comment Here</button></a>
      </td>

   </tr>
</if:INSERT_COMMENT>

<if:pager_1>
<tr><td class='blocklist' colspan='3' align='center'><tag:p_top /></td></tr>
</if:pager1>

<if:lock_comments_enabled>
<tr><td align="center" colspan="3"><tag:lock /></td></tr>
</if:lock_comments_enabled>

<if:NO_COMMENTS>
<tr>
   <td colspan="3" class="lista" align="center"><button class="btn btn-labeled btn-warning btn-lg" type="button">
      <span class="btn-label"><i class="fa fa-exclamation-circle"></i></span>No Comments Yet</button></td>
   </tr>
   <else:NO_COMMENTS>

   <if:com_lay_1>
   <loop:comments>
   <tr>
      <td align="left" class="header" colspan="2">
         <table class="table table-striped"><tr>
            <td align="right">Vote for this comment [<tag:comments[].vote_tot /> votes]<tag:comments[].voteu /><tag:comments[].voted />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tag:comments[].quote /><tag:comments[].edit.delete />
            </tr></table>
         </td>
      </tr>
      <tr>
         <td class="header" align="left" valign="top">
            <table class="table table-bordered">
               <tr>
                  <td>
                     <tag:comments[].user />
                     <br />
                     <tag:comments[].date />
                     <br />
                     <tag:comments[].elapsed />
                     <br />
                     <tag:comments[].avatar />
                     <br />
                     <tag:comments[].ratio />
                     <br />
                     <tag:comments[].uploaded />
                     <br />
                     <tag:comments[].downloaded />
                  </td>
               </tr>
            </table>
         </td>
         <td class="lista" width="100%" valign="top" style="padding:10px">
            <tag:comments[].comment /><if:avatar_signature_sync_enabled_1><br><br><br><br><center><tag:comments[].comm_sig /></center></if:avatar_signature_sync_enabled_1></td>
         </tr>
      </loop:comments>
      <else:com_lay_1>
      <loop:comments>
      <tr>
         <td class="header"><tag:comments[].user /></td>
         <td class="header"><tag:comments[].date /></td>
         <td class="header" align="right"><if:vedsc_enabled_2><tag:comments[].edit.delete /><else:vedsc_enabled_2><tag:comments[].delete /></if:vedsc_enabled_2></td>
      </tr>
      <tr>
         <td colspan="3" class="lista" align="center" style="text-align:left;" valign="top"><tag:comments[].comment /><if:avatar_signature_sync_enabled><br><center><tag:comments[].comm_sig /></center></if:avatar_signature_sync_enabled></td>
      </tr>
   </loop:comments>
</if:com_lay_1>
</if:NO_COMMENTS>

<if:vedsc_enabled_3>
   <!-- #######################################################
   # view/edit/delete shout, comments -->
   <if:MASSDEL_COMMENTS>
   <br /><div align="right" style="margin-right:8px;">
   <input type="submit" class="btn btn-danger" value="<tag:language.FRM_DELETE />" onclick="return confirm('If you are really sure you want to delete selected comments click OK, othervise Cancel!')" />
   <input type="checkbox" class="btn" name="all_down" onclick="SetAllCheckBoxes('deleteallcomments','delcomment[]',this.checked)" />
</div>
</if:MASSDEL_COMMENTS>

</form>
</if:VIEW_COMMENTS>


   <!-- # End
   ####################################################### -->
</if:vedsc_enabled_3>

<if:pager2>
<tr><td class='blocklist' colspan='3' align='center'><tag:p_bottom /></td></tr>
</if:pager2>

<if:VIEW_COMMENTS_2>
</table>
</if:VIEW_COMMENTS_2>
<br />
<br />
<div align="center">
   <tag:torrent_footer />
</div>
</div> <!-- Tab End -->
</div> <!-- Main Tab Content End -->



