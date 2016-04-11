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

   global $CURUSER, $btit_settings, $FORUMLINK, $language;


print("<table cellpadding=\"2\" cellspacing=\"1\" width=\"100%\" border=\"0\" align=\"center\"><tr>\n");



if (!$CURUSER)
   {

       // anonymous=guest
   print("<td class=\"header\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME"]." ".$language["GUEST"]."\n");
   print("<a class=\"mainmenu\" href=\"login.php\">(".$language["LOGIN"].")</a></td>");
  }
elseif ($CURUSER["uid"]==1)
       // anonymous=guest
    {
   print("<td class=\"header\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME"]." " . $CURUSER["username"] ." \n");
   print("<a class=\"mainmenu\" href=\"index.php?page=login\">(".$language["LOGIN"].")</a></td>\n");
    }
else
    {
		
		 print("<td class=\"header\" align=\"center\" style=\"text-align:center;\"><a class=\"mainmenu\" href=\"logout.php\">(".$language["LOGOUT"].")</a></td>\n");
    }

    print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php\">".$language["MNU_HOME"]."</a></td>\n");

if ($CURUSER["view_torrents"]=="yes")
{
    print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=torrents\">".$language["MNU_TORRENT"]."</a></td>\n");
    print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=extra-stats\">".$language["MNU_STATS"]."</a></td>\n");

}
if ($CURUSER["can_upload"]=="yes")
   print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=upload\">".$language["MNU_UPLOAD"]."</a></td>\n");
if($btit_settings["fmhack_file_hosting"] == "enabled" && $CURUSER["uid"] > 1)
    {
    print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=file_hosting\">".$language["MNU_FHOST"]."</a></td>\n");	
    }
if ($CURUSER["view_users"]=="yes")
   print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=users\">".$language["MNU_MEMBERS"]."</a></td>\n");

if ($CURUSER["view_forum"]=="yes")
   {
   if ($FORUMLINK=="" || $FORUMLINK=="internal" || substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
   {
       if($btit_settings["fmhack_integrated_forum_display"]=="enabled" && (substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb"))
       {
           if($btit_settings["forum_viewtype"]!="iframe")
               $href="class=\"mainmenu\"  href='".((substr($FORUMLINK,0,3)=="smf")?"smf":$FORUMLINK)."' target='".$btit_settings["forum_viewtype"]."'";
           else
               $href="class=\"mainmenu\" href='index.php?page=forum'";
       }
       else
           $href="class=\"mainmenu\" href='index.php?page=forum'";

       print("<td class=\"header\" align=\"center\"><a ".$href.">".$language["MNU_FORUM"]."</a></td>\n");
   }
   else
       print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"".((substr($FORUMLINK,0,3)=="smf")?"smf":$FORUMLINK)."\">".$language["MNU_FORUM"]."</a></td>\n");
    }

  //print("</tr></table><table cellpadding=\"2\" cellspacing=\"1\" width=\"100%\" border=\"0\" align=\"center\"><tr>\n");

if ($CURUSER["view_users"]=="yes")
 {
  
    if($btit_settings["fmhack_torrent_request_and_vote"]=="enabled")
    {    
        //request hack
        print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=viewrequests\">".$language["VR"]."</a></td>\n");
        //request hack
    }
    /*Mod by losmi -  rules mod */
    if($btit_settings["fmhack_rules_with_groups"]=="enabled")
        print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=rules\">".$language["MNU_RULES"]."</a></td>\n");
    /*End mod by losmi -  rules mod*/
    /*Mod by losmi - faq mod */
    if($btit_settings["fmhack_faq_with_groups"]=="enabled")
        print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=faq\">".$language["MNU_FAQ"]."</a></td>\n");
    /*End mod by losmi - faq mod*/

    if($btit_settings["fmhack_subtitles"]=="enabled")
    {
        require(load_language("lang_subs.php"));
        print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=subtitles\">".$language["SUB_T_H"]."</a></td>\n");
    }	 
 
if($btit_settings["fmhack_sport_betting"]=="enabled")
{
    if ($CURUSER["view_torrents"]=="yes")
        print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\" href=\"index.php?page=bet\">".$language["SB_BETTING"]."</a></td>\n");
}
}
?>
  </tr>
   </table>
<?php

?>