<?php
/////////////////////////////////////////////////////////////////////////////////////
//
//  BluCrew Nav
//
////////////////////////////////////////////////////////////////////////////////////
global $CURUSER, $btit_settings, $language;

//HOME
  print("<li><a href='index.php'>".$language["MNU_INDEX"]."</a></li>\n");
         

//TORRENTS
if ($CURUSER["view_torrents"]=="yes"){
print("<li><a href='index.php?page=torrents&search=&category=0&uploader=0&options=0&active=0&gold=0'>".$language["MNU_TORRENT"]."</a>\n");
}

//BLUFLIX 2.0
if ($btit_settings["fmhack_bluflix"] == 'enabled'){
print("<li><a href=http://stream.blurg.xyz>BluFLIX</a></li>\n");
}

//UPLOAD
if ($CURUSER["can_upload"]=="yes"){            
print("<li><a href='index.php?page=upload'>".$language["MNU_UPLOAD"]."</a></li>\n");
}	

//REQUESTS
if ($CURUSER["view_torrents"]=="yes" && $CURUSER["id_level"] > 2)
{
print("<li><a href='index.php?page=requests'>Requests</a></li>\n");
}

//EXPECTED
if($CURUSER["view_users"]=="yes" && $CURUSER["view_torrents"]=="yes" && $CURUSER["view_forum"]=="yes")
{
print("<li><a href='index.php?page=viewexpected'>Upcoming</a></li>\n");
}

//SEEDHELP
$seedque = do_sqlquery("SELECT `f`.`info_hash`, `f`.`filename`, `f`.`size`,`u`.`username`,`h`.`seed`, `f`.`seeds`, `f`.`leechers`, `h`.`uploaded` FROM {$TABLE_PREFIX}files `f` LEFT JOIN {$TABLE_PREFIX}users `u` ON `u`.`id`=`f`.`uploader` LEFT JOIN {$TABLE_PREFIX}history `h` ON `h`.`infohash`=`f`.`info_hash` WHERE (`f`.`uploader`={$CURUSER['uid']} OR `h`.`uid`={$CURUSER['uid']}) AND `f`.`seeds`=0 AND `f`.`leechers`>=1 AND `h`.`completed`='yes' AND `h`.`active`='no' GROUP BY `f`.`info_hash`");
$seedcount = sql_num_rows($seedque);
print("<li><a href='index.php?page=modules&module=seedhelp'>Seedhelp [{$seedcount}]</a></li>\n");
               

//FORUMS
if ($CURUSER["view_forum"]=="yes")
    {
        if ($GLOBALS["FORUMLINK"]=="" || $GLOBALS["FORUMLINK"]=="internal" || substr($GLOBALS["FORUMLINK"],0,3)=="smf" || $GLOBALS["FORUMLINK"]=="ipb")
            print("<li><a href='index.php?page=forum'>Forums</a></li>\n");
        else
            print("<li><a href='".$GLOBALS["FORUMLINK"]."'>Fourms</a></li>\n");
    }

//GAMES
if ($CURUSER["id_level"]>=3 && $btit_settings['fmhack_games']=='enabled')
{
  print("<li><a href='index.php?page=games'>Games</a></li>\n");
}

//THEMES
 print("<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Color<b class='caret'></b></a>\n");
        print("<ul class='dropdown-menu'>\n");
        print("<li><a href='#' data-theme='Dark' class='theme-link'>Dark (Default)</a></li>\n");
        print("<li><a href='#' data-theme='Light' class='theme-link'>Light</a></li>\n");
        print("<li><a href='#' data-theme='Light V2' class='theme-link'>Light V2</a></li>\n");
        print("</ul></li>");

//STAFF
if ($CURUSER["admin_access"]=="yes") {
        require_once(load_language("lang_admin.php"));
        print("<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>STAFF<b class='caret'></b></a>\n");
        print("<ul class='dropdown-menu'>\n");
        print("<li><a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."'>Staff Panel</a></li>\n");
        print("<li><a href='index.php?page=moder&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."'>Moderation Panel</a></li>\n");
        print("<li><a href='#'>Staff Checks</a></li>\n");
        print("<li class='divider'></li>");
        print("<li><a href='BluCrewPanel/index.html'>BluCrew Panel</a></li>\n");
        print("</ul></li>");
        
    }
?>

