<div class='container'>
     <if:has_torrents>
     <div class="panel panel-default">
     <div class="panel-heading">
     <h4 class="text-center"></h4>
     </div>
     <div id='pager'>
          <tag:pagertop />
     </div>
     </div>
     <div class="panel panel-primary">
     <div class="panel-heading">
     <h4 class="text-center">High Speed Seedbox Torrents</h4>
     </div>
     <table class="table table-bordered">
          <thead>
               <tr>
                    <td><tag:language.DOWN /></td>
                    <td><tag:language.TORRENT_FILE /></td>
                    <td><tag:language.CATEGORY /></td>
                    <if:wait_time>
                    <td><tag:language.WT /></td>
               </if:wait_time>
               <td><tag:language.ADDED /></td>
               <td><tag:language.UPLOADER /></td>
               <td><tag:language.SIZE /></td>
               <td><tag:language.SHORT_S /></td>
               <td><tag:language.SHORT_L /></td>
               <td><tag:language.SHORT_C /></td>
          </tr>
     </thead>
     <tbody>
          <loop:seedbox>
          <tr>
               <if:dcheck>
               <td><a href='index.php?page=downloadcheck&amp;id=<tag:seedbox[].hash />'><button class='btn btn-labeled btn-primary' type='button'>
      <span class='btn-label'><i class='fa fa-download'></i></span>Download</button></a></td>
               <else:dcheck>
               <td><a href='download.php?id=<tag:seedbox[].hash />&amp;f=<tag:seedbox[].dfile />.torrent'><button class='btn btn-labeled btn-primary' type='button'></td>
          </if:dcheck>
          <if:popup>
          <td><a href="javascript:popdetails('index.php?page=torrent-details&amp;id=<tag:seedbox[].hash />" title="<tag:language.VIEW_DETAILS /> : <tag:seedbox[].filename />"><tag:seedbox[].filename /></a></td>      <span class='btn-label'><i class='fa fa-download'></i></span>Download</button>
          <else:popup>
          <td><a href="index.php?page=torrent-details&amp;id=<tag:seedbox[].hash />" title="<tag:language.VIEW_DETAILS /> : <tag:seedbox[].filename />"><tag:seedbox[].filename /></a></td>
     </if:popup>
     <td><a href='index.php?page=torrents&amp;category=<tag:seedbox[].catid />'><img src='<tag:spath />/images/categories/<tag:seedbox[].catimage />' title='<tag:seedbox[].catname />'></a></td>
     <if:wait_time1>
     <td><tag:seedbox[].wait /></td>
</if:wait_time1>
<td><tag:seedbox[].datetime /></td>
<td><a href='index.php?page=userdetails&amp;id=<tag:seedbox[].uploaderid />' title='<tag:seedbox[].uploader />'><tag:seedbox[].uploader /></a></td>
<td><tag:seedbox[].size /></td>
<if:popup1>
<td class='<tag:seedbox[].lseeds />'><a href="javascript:poppeer('index.php?page=peers&amp;id=<tag:seedbox[].hash />" title='<tag:language.PEERS_DETAILS />'><tag:seedbox[].seeds /></a></td>
<td class='<tag:seedbox[].lleechers />'><a href="javascript:poppeer('index.php?page=peers&amp;id=<tag:seedbox[].hash />" title='<tag:language.PEERS_DETAILS />'><tag:seedbox[].leechers /></a></td>
<td class='<tag:seedbox[].lfinished />'><a href="javascript:poppeer('index.php?page=torrent_history&amp;id=<tag:seedbox[].hash />" title="History -  <tag:seedbox[].filename />"><tag:seedbox[].finished /></a></td>
<else:popup1>
<td class='<tag:seedbox[].lseeds />'><a href='index.php?page=peers&amp;id=<tag:seedbox[].hash />' title='<tag:language.PEERS_DETAILS />'><tag:seedbox[].seeds /></a></td>
<td class='<tag:seedbox[].lleechers />'><a href='index.php?page=peers&amp;id=<tag:seedbox[].hash />' title='<tag:language.PEERS_DETAILS />'><tag:seedbox[].leechers /></a></td>
<td class='<tag:seedbox[].lfinished />'><a href='index.php?page=torrent_history&amp;id=<tag:seedbox[].hash />' title="History - <tag:seedbox[].filename />"><tag:seedbox[].finished /></a></td>
</if:popup1>
</tr>
</loop:seedbox>
</tbody>
</table>
</div>
<br>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="text-center"></h4>
</div>
<div id='pager'>
     <tag:pagerbottom />
</div>
</div>
<else:has_torrents>
<div class="alert alert-danger" role="alert" ng-show="error">
   <strong>Ooops!</strong><tag:language.NO_TORRENTS />
   </div>
</if:has_torrents>
</div>