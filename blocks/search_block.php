

 <?php
/////////////////////////////////////////////////////////////////////////////////////
// 
//
//
////////////////////////////////////////////////////////////////////////////////////
?>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Search</h4>
</div>
 
  <table border="0" align="center" class="blocklist">
<form action="index.php" method="get" name="torrent_search">
  <input type="hidden" name="page" value="torrents" />

      <td><input
      onfocus="if (this.value == 'Torrents') this.value='';"
   onblur="if(this.value == '') this.value='Torrents';"
      type="text" name="search" class="search" size="30" maxlength="50" value="Torrents" /></td>
</form>

  <form action="index.php?" method="get" name="smf_forum_search">
  <input type="hidden" name="page" value="forum" />
  <input type="hidden" name="action" value="search2" />
  <td><input
   onfocus="if (this.value == 'Forums') this.value='';"
   onblur="if(this.value == '') this.value='Forums';"
  type="text" name="search" class="search" size="30" maxlength="50" value="Forums" /></td>
  </form>


</table>
<div class="panel-footer">
</div>
</div>