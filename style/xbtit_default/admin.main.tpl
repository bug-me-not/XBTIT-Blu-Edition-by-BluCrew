
<script language="javascript" type="text/javascript">
<!--
function update_cat(newimage)
{
  if (newimage!="")
     document.cat_image.src = "images/categories/" + newimage;
  else
     document.cat_image.src = "";
}



var anb=new sack();

function show_wait()
{
  document.getElementById('news_div').style.display='none';
  document.getElementById('loading').style.display='block';
}

function ShowUpdate()
{
  var mytext=anb.response + '';
  document.getElementById('news_div').style.display='block';
  document.getElementById('loading').style.display='none';
  document.getElementById('news_div').innerHTML = mytext;
}

function Show_News()
{

  anb.resetData();
  anb.onLoading=show_wait;
  anb.requestFile='admin/admin.get_support_info.php';
  anb.setVar('in_xbtit',"'1'");
  anb.setVar('in_admin',"'1'");
  anb.onCompletion = ShowUpdate;
  anb.runAJAX();
}

//-->
</script>
<b><tag:language.ADMINCP_NOTES /></b>
<table border="0" class="lista" align="center" width="100%">
<tr>
  <td valign="top">
     <table border="0" class="lista" align="center" width="100%">
      <tr>
       <td valign="top">
           <div id="loading" style="display:none;">
           Please wait while Trying to fetch latest news/version from <a href="http://www.btiteam.org">Btiteam</a>
           <br />
           <img src="images/ajax-loader.gif" alt="" title="ajax-loader" />
           </div>
           <div id="news_div" style="text-align: left;"></div>
       </td>
       </tr>
     </table>
  </td>
  <td valign="top" width="250"><br />
    <table border="0" class="lista" align="center" width="100%">
           <tr><td class="block" align="center"><b>Some statistic/system info:</b></td></tr>
           <tr><td class="lista"><tag:admin.lastsanity /></td></tr>
           <tr><td class="lista"><tag:admin.lastscrape /></td></tr>
           <tr><td class="block"></td></tr>
           <tr><td class="list"><tag:admin.xbtt_ok /></td></tr>
           <tr><td class="lista"><tag:admin.torrent_ok /></td></tr>
           <tr><td class="lista"><tag:admin.cache_ok /></td></tr>
           <tr><td class="lista"><tag:admin.badwords_ok /></td></tr>
           <tr><td class="blocklist"><tag:admin.infos /></td></tr>
    </table>
  </td>
  </tr>
</table>
<script type="text/javascript">Show_News();</script>