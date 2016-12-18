<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Advanced Auto Donation System by DiemThuy ( sept 2009 )
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

    global $btit_settings, $language, $res_seo;
    require_once (load_language("lang_aads.php"));
    if($btit_settings["fmhack_advanced_auto_donation_system"]=="enabled")
    {
        $zap_usr = get_result("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'",true,$btit_settings["cache_duration"]);
        $settings = $zap_usr[0];

        if ($settings["donation_block"] == "true" )
        {
            echo  "<marquee onmouseover=this.stop() onmouseout=this.start()  scrollAmount=2 direction=left >";
            echo "<span style='color:red;font-size:120%'><b> " . $settings["scrol_tekst"] . "</b></span>";
            echo "</marquee>";
        }

        $date_time = $settings["due_date"];
        $funds_so_far = $settings["received"];
        $totalneeded = $settings["needed"];
        $funds_difference = $totalneeded - $funds_so_far;
        $Progress_so_far = $funds_so_far / $totalneeded * 100;

        if($Progress_so_far >= 100)
            $funds_img = "./images/progress-5.gif";
        elseif($Progress_so_far >= 76)
            $funds_img = "./images/progress-4.gif";
        elseif($Progress_so_far >= 51)
            $funds_img = "./images/progress-3.gif";
        elseif($Progress_so_far >= 26)
            $funds_img = "./images/progress-2.gif";
        elseif($Progress_so_far >= 1)
            $funds_img = "./images/progress-1.gif";
        else
            $funds_img = "./images/progress-0.gif";

        if($totalneeded >= $funds_so_far)
            $monthly_goal = "[ ".round($Progress_so_far)."% ]";
        else
            $monthly_goal = "[ Monthly goal met! ]";

        $currency=$settings["units"];
        if($currency=="AUD" || $currency=="CAD" || $currency=="HKD" || $currency=="NZD" || $currency=="SGD" || $currency=="USD")
        {
            $sign = "&#36;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="CZK")
        {
            $sign = "K&#269;";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="DKK" || $currency=="NOK"  || $currency=="SEK")
        {
            $sign = "kr";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="EUR")
        {
            $sign = "&#8364;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="HUF")
        {
            $sign = "Ft";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="ILS")
        {
            $sign = "&#8362;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="JPY")
        {
            $sign = "&#165;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="MXN")
        {
            $sign = "&#36;";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="PLN")
        {
            $sign = "z&#322;";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="GBP")
        {
            $sign = "&#163;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="CHF")
        {
            $sign = "CHF";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="BRL")
        {
            $sign = "R&#36;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="MYR")
        {
            $sign = "RM";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="PHP")
        {
            $sign = "&#8369;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="TWD")
        {
            $sign = "NT&#36;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="THB")
        {
            $sign = "&#3647;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="BGN")
        {
            $sign = "&#1083;&#1074;";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="INR")
        {
            $sign = "&#8377;";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        elseif($currency=="LTL")
        {
            $sign = "Lt";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="MKD")
        {
            $sign = "&#1076;&#1077;&#1085;";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="RON")
        {
            $sign = "lei";
            $sign_left = FALSE;
            $sign_right = TRUE;
        }
        elseif($currency=="ZAR")
        {
            $sign = "R";
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        $systema="";
        $systemb="";
        if ($settings["pp"]=="true")
        {
            $systema="<a href=index.php?page=donate><img src=images/paypal.png border=0></a>&nbsp;";
        }
        if($settings["ap"]=="true")
        {
            $systemb="<a href=index.php?page=donatepz><img src=images/payza.png border=0></a>";
        }
        if($settings["bc"]=="true")
        {
            $systemb="<a href=index.php?page=donatebc><img src=images/bitcoin.gif border=0></a>";
        }

        echo "<table><tr><td align=center><img src=images/donate.gif border=0></TD></TR>";
        echo"<tr><td align=center>".$systema.$systemb."</td></tr><tr><td align=center>".$language['AADS_DTM'].": <span style='color:steelblue'><b> ".round($Progress_so_far)."%</b></td></tr><tr><td width=198 hight=15><center><img title=\"".round($Progress_so_far)."% (".(($sign_left===TRUE)?$sign:"").number_format($funds_so_far,0,".",",").(($sign_right===TRUE)?" ".$sign:"")." of ".(($sign_left===TRUE)?$sign:"").number_format($totalneeded,0,".",",").(($sign_right===TRUE)?" ".$sign:"").")\" src=$funds_img align=center valign=middle><br>".$language['AADS_GOAL'].": <span style='color:blue'><b>".(($sign_left===TRUE)?$sign:"").number_format($totalneeded,0,".",",").(($sign_right===TRUE)?" ".$sign:"")."</span></b><br>".$language['AADS_DUE'].": <span style='color:red'><b>$date_time</span></b></center></td></tr> <TR><TD align=center class=header>".$language['AADS_LD']."</TD></TR></table>";

        echo "<TABLE width=100% border=0 cellspacing=1 cellpadding=1 class=forumline>
          <TR>
          <TD class=lista>".$language["AADS_DON"].":</TD>
          <TD class=lista>".$language["DATE"].":</TD>
          </TR>";
        $pp=(int)0+$settings["num_block"];
        $donor = get_result("SELECT `d`.`userid` `donor_id`, `ul`.`prefixcolor` `donor_prefixcolor`, `d`.`first_name` `donor_name`, `ul`.`suffixcolor` `donor_suffixcolor`, UNIX_TIMESTAMP(`d`.`date`) `donation_date` FROM `{$TABLE_PREFIX}donors` `d` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `d`.`userid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ORDER BY `d`.`date` DESC LIMIT $pp",true,$btit_settings["cache_duration"]);

        foreach ($donor as $fetch)
        {
            if ($fetch["donor_id"]  == "0")
            {
	    	}
            else
            {
                if ($fetch["donor_name"] == "anonymous")
                {
                    $un=$language["ANONYMOUS"];
                    $link="";
                }
                else
                {
                    $un=unesc($fetch["donor_prefixcolor"].$fetch["donor_name"].$fetch["donor_suffixcolor"]);
                    $link="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$fetch["donor_id"]."_".strtr($fetch["donor_name"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$fetch["donor_id"])."'>";
                }
                echo"<TR align=left><TD>".$link."".$un."</a></TD><TD>".date('d/m/Y',$fetch["donation_date"])."</TD></TR>";
            }
	    }
        print("</td></tr></table>");
    }
    else
    {
        ?>
        <table width="100%" align="center" border="0" cellspacing="1" cellpadding="4">
          <tr>
            <td align="center" valign="top">
              <img src="images/makedonation.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
            </td>
          </tr>
        </table>
        <?php
    }

?>