<?php

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
       // do nothing
   }
else
   {
$res=mysql_query("SELECT * FROM {$TABLE_PREFIX}files WHERE image !='' ORDER BY data DESC LIMIT ".$GLOBALS["limit_im"]."");
if(@mysql_num_rows($res)>0)
{
    echo "<div align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'><tr><td><marquee direction='left' onmouseover='this.stop()' onmouseout='this.start()'>";
while($result=mysql_fetch_array($res))
   {
    echo "<A HREF=\"index.php?page=torrent-details&id=".$result["info_hash"]."\" title=\"".$language["TORRENT_DETAILS"].": ".$result["filename"]."\"><img src=\"thumbnail.php?size=150&path=torrentimg/".$result["image"]."\" height=\"150px\"></A>";
}
 echo "</marquee></td></tr></table></div>\n";
} }
block_end();
?>