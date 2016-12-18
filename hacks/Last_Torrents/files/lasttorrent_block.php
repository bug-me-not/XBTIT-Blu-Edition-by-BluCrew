<?php

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
       // do nothing
   }
else
   {
if ($GLOBALS["image_cat"]!='0')
$res=mysql_query("SELECT * FROM {$TABLE_PREFIX}files WHERE image !='' AND category=".$GLOBALS["image_cat"]." ORDER BY data DESC LIMIT 1");
else
$res=mysql_query("SELECT * FROM {$TABLE_PREFIX}files WHERE image !='' ORDER BY data DESC LIMIT 1");
if(@mysql_num_rows($res)>0)
{
while($result=mysql_fetch_array($res))
   {
    if (strlen($result["filename"])>20)
        {
        echo "<div align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'><tr><td class='blocklist' align='center'><A HREF=\"index.php?page=torrent-details&id=".$result["info_hash"]."\" title=\"".$language["TORRENT_DETAILS"].": ".$result["filename"]."\">".substr($result["filename"],0,20)."...</A></td></tr><tr><td class='blocklist' align='center'>";
        }
    else
        {
        echo "<div align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'><tr><td class='blocklist' align='center'><A HREF=\"index.php?page=torrent-details&id=".$result["info_hash"]."\" title=\"".$language["TORRENT_DETAILS"].": ".$result["filename"]."\">".$result["filename"]."</A></td></tr><tr><td class='blocklist' align='center'>";
        }
    echo "<A HREF=\"index.php?page=torrent-details&id=".$result["info_hash"]."\" title=\"".$language["TORRENT_DETAILS"].": ".$result["filename"]."\"><img src=\"thumbnail.php?size=150&path=torrentimg/".$result["image"]."\" width=\"150px\"></A>";
    echo "</td></tr></table></div>\n";
}
}
}
block_end();
?>