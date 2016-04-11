<?php

    global $btit_settings, $language, $res_seo;

    $number = (int)$btit_settings["req_number"];

    $res = get_result("SELECT `u`.`downloaded`, `u`.`uploaded`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `u2`.`username` `f_username`, `r`.`filled`, `r`.`filledby`, `r`.`id`, `r`.`userid`, `r`.`request`, `r`.`added`, `r`.`hits`, `c`.`image` `catimg`, `c`.`name` `cat` FROM `{$TABLE_PREFIX}requests` `r` inner join `{$TABLE_PREFIX}categories` `c` on `r`.`cat` = `c`.`id` inner join `{$TABLE_PREFIX}users` `u` on `r`.`userid` = `u`.`id` INNER JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `r`.`filledby`=`u2`.`id` ORDER BY `r`.`hits` DESC, `r`.`id` DESC LIMIT $number",true,$btit_settings["cache_duration"]);

    print("<table border=0 width=100% align=center cellspacing=1 cellpadding=0>\n");
    print("<tr><td class=header align=center>".$language["TRAV_NAME"]."</td><td class=header align=center>".$language["TRAV_CAT"]."</td><td class=header align=center>".$language['DATE']."</td><td class=header align=center>".$language['BY']."</td><td class=header align=center>".$language["TRAV_FILLED"]."</td><td class=header align=center>".$language["TRAV_VOTES"]."</td>\n");

    foreach($res as $arr)
    {
        $privacylevel = $arr["privacy"];

        if ($arr["downloaded"] > 0)
        {
            $ratio = number_format($arr["uploaded"] / $arr["downloaded"], 2);
        }
        else
            $ratio = "&#8734;";

        if (is_null($arr["f_username"]))
            $filledby ="";
        else
            $filledby = $arr["f_username"];

        if (!$CURUSER || $CURUSER["delete_torrents"]=="no")
        {
            if (!$CURUSER || $CURUSER["view_users"]=="yes")
            {
                $addedby = "<td class=lista align=center><center><a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["userid"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["userid"])."' title='".$language["TRAV_REQBY2"].": ".$arr["username"]." (".$ratio.")'><b>".unesc($arr["prefixcolor"].$arr["username"].$arr["suffixcolor"])."</b></a></td>";
            }
            else
            {
                $addedby = "<td class=lista align=center><center><a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["userid"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["userid"])."' title='".$language["TRAV_REQBY2"].": ".$arr["username"]." (".$ratio.")'><b>".unesc($arr["prefixcolor"].$arr["username"].$arr["suffixcolor"])."</b></a></td>";
		    }
        }
        else
        {
            $addedby = "<td class=lista align=center><center><a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["userid"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["userid"])."' title='".$language["TRAV_REQBY2"].": ".$arr["username"]." (".$ratio.")'><b>".unesc($arr["prefixcolor"].$arr["username"].$arr["suffixcolor"])."</b></a></td>";
        }

        $filled = $arr[filled];
        if ($filled)
        {
            $filled = "<a href=$filled title=\"".$language["TRAV_FILLEDBY"].": ".$filledby."\"><span style='color:green'><b>".$language["YES"]."</b></span></a>";
        }
        else
        {
            $filled = "<a href=index.php?page=reqdetails&id=$arr[id] title=\"".$language["TRAV_REQDET"].":".$arr[request]."\"><span style='color:red'><b>".$language["NO"]."</b></span></a>";
        }

        $reqname = $arr[request];

        //Name of Request too Big Hack Start
        if (strlen($arr[request])>45)
        {
            $extension = "...";
            $arr[request] = substr($arr[request], 0, 45)."$extension";
        }
        //Name of Request too Big Hack Stop
        print("<tr><td class=lista align=left width=270><a href=index.php?page=reqdetails&id=$arr[id] title=\"".$language["TRAV_REQNAME"].": ".$reqname."\"><b>$arr[request]</b></a></td>");
        print("<td class=lista align=center><center>".image_or_link(($arr['catimg']==''?'':'style/xbtit_default/images/categories/'.$arr[catimg]),' title=\'".$language["TRAV_CATEG"]." : '.$arr[cat].'\'',$arr['cat'])."</td><td class=lista width=20% align=center><center><font title=\"".$language["TRAV_ADDED"].": ".$arr[added]."\">".$arr["added"]."</font></td>$addedby<td class=lista align=center><center>$filled</td><td class=lista align=center><center><a href=index.php?page=votesview&requestid=$arr[id] title=\"".$language["TRAV_VOTES"].": ".$arr[hits]."\"><b>$arr[hits]</b></a></td></tr>\n");
    }
    print("</table>\n");

?>