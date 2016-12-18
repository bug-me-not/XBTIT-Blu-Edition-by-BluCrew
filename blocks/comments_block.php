<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse7">Torrent Comments</a>
</h4>
</div>
<div id="collapse7" class="panel-collapse collapse in">
<?php
/////////////////////////////////////////////////////////////////////////////////////
//
//  Latest Comments Block
//
////////////////////////////////////////////////////////////////////////////////////


        global $CURUSER;
        if (!$CURUSER || $CURUSER["view_torrents"]=="no")
{
        // hacking ?
}
        else
{

        if(!isset($_COOKIE['lasttorrentcomment']))
{
        $data =  time();
        $expire = time() + 3600 * 24 * 7; // 7 jours
        setcookie('lasttorrentcomment', $data, $expire);
        $LastTorrentComment = 0;
}
        else
{
        $LastTorrentComment = abs(intval($_COOKIE['lasttorrentcomment']));
}

        $mq = do_sqlquery("SELECT comments.id, text, info_hash, added , user, users.id_level, users.id as uid FROM {$TABLE_PREFIX}comments comments LEFT JOIN {$TABLE_PREFIX}users users ON comments.user=users.username ORDER BY added DESC LIMIT 5");
        print("<table class=\"lista\" width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"4\">");
        while ($rq=$mq->fetch_assoc())
{

        if ($LastTorrentComment <= strtotime($rq["added"]))
{
        $is_new = '<img alt="" src="./images/new.png" />';
}
        else
{
        $is_new='';
}
        print("<tr><td class=\"lista\">");
        if (empty($rq["text"]))
{
        print("No comments yet");
}
        else
{
        $chaine=stripslashes($rq["text"]);
        $max=60;
        if (strlen($chaine)>=$max)
{
        $chaine=substr($chaine,0,$max) . '...';
}
{
        $res2 = do_sqlquery("SELECT filename FROM {$TABLE_PREFIX}files WHERE info_hash='".$rq["info_hash"] ."'") or sqlerr();
        $arr2 = $res2->fetch_assoc();
        
        $res3 = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id='".$rq["id_level"] ."'") or sqlerr();
        $arr3 = $res3->fetch_assoc();
        $post['username']=$arr3['prefixcolor'].$rq['user'].$arr3['suffixcolor'];
}
        print("<p class=\"text-info\"><a href=index.php?page=torrent-details&amp;id=" . $rq["info_hash"]. ">" . $arr2["filename"] . "</a>&nbsp;".$is_new."<br><br>". format_comment(unesc($chaine))."</p>");
        print("<span style=\"font-style: italic;\">By <a href=index.php?page=userdetails&amp;id=".$rq["uid"].">".  $post['username'] . "</a>, on ".date("m/d/Y H:i:s", strtotime($rq["added"]))."</span></td>");
        print("<tr><b><td align=\"center\">" . $file["filename"]. "</td></b></tr>\n");
}
}
        print("</tr></table>");

}
?>
</div>
<div class="panel-footer">
</div>
</div>