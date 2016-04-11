<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

global $CURUSER, $btit_settings, $language, $FORUMLINK;

   print("<table width=\"100%\" cellspacing=\"5\" cellpadding=\"3\">\n<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php\">&bull;&nbsp;&nbsp;".$language["MNU_HOME"]."</a></td></tr>\n");

   if ($CURUSER["view_torrents"]=="yes")
      {
      print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=torrents\">&bull;&nbsp;&nbsp;".$language["MNU_TORRENT"]."</a></td></tr>\n");
      print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=extra-stats\">&bull;&nbsp;&nbsp;".$language["MNU_STATS"]."</a></td></tr>\n");
      if($btit_settings["fmhack_lottery"]=="enabled")
          print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=lottery_tickets\">&bull;&nbsp;&nbsp;".$language["LOTTERY"]."</a></td></tr>\n");
      }
   if ($CURUSER["can_upload"]=="yes")
      print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=upload\">&bull;&nbsp;&nbsp;".$language["MNU_UPLOAD"]."</a></td></tr>\n");
   if ($CURUSER["view_users"]=="yes")
      print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=users\">&bull;&nbsp;&nbsp;".$language["MNU_MEMBERS"]."</a></td></tr>\n");
      if($btit_settings["fmhack_helpdesk"]=="enabled")
          print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=modules&amp;module=helpdesk\">&bull;&nbsp;&nbsp;".$language["HELPDESK"]."</a></td>\n");
   if($btit_settings["fmhack_file_hosting"] == "enabled" && $CURUSER["uid"] > 1)
    {
    print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=file_hosting\">&bull;&nbsp;&nbsp;".$language["MNU_FHOST"]."</a></td></tr>\n");	
    }

   if ($CURUSER["view_news"]=="yes")
      print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=viewnews\">&bull;&nbsp;&nbsp;".$language["MNU_NEWS"]."</a></td></tr>\n");
   if ($CURUSER["view_forum"]=="yes")
      {

        if ($FORUMLINK=="" || $FORUMLINK=="internal" || substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
        {
            if($btit_settings["fmhack_integrated_forum_display"]=="enabled" && (substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb"))
            {
                if($btit_settings["forum_viewtype"]!="iframe")
                    $href="href='".((substr($FORUMLINK,0,3)=="smf")?"smf":$FORUMLINK)."' target='".$btit_settings["forum_viewtype"]."'";
                else
                    $href="href='index.php?page=forum'";
            }
            else
                $href="href='index.php?page=forum'";

            print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" ".$href.">&bull;&nbsp;&nbsp;".$language["MNU_FORUM"]."</a></td></tr>\n");
        }
        else
            print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"".((substr($FORUMLINK,0,3)=="smf")?"smf":$FORUMLINK)."\">&bull;&nbsp;&nbsp;".$language["MNU_FORUM"]."</a></td></tr>\n");
      }
   if ($CURUSER["uid"]==1 || !$CURUSER)
      print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"index.php?page=login\">&bull;&nbsp;&nbsp;".$language["LOGIN"]."</a></td></tr>\n</table>\n");
   else
       print("<tr><td class=\"blocklist\" style=\"text-align:left; padding-left: 45px;\" align=\"center\"><a class=\"menu\" href=\"logout.php\">&bull;&nbsp;&nbsp;".$language["LOGOUT"]."</a></td></tr>\n</table>\n");

?>