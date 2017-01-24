<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Donation Historie by DiemThuy ( Juni 2009 )
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

if (!defined("IN_BTIT"))
      die("non direct access!");

if($CURUSER["uid"]<=1)
die();
$don_historietpl= new bTemplate();
$don_historietpl->set("language",$language);

$r2=get_result("SELECT d.* , ul.prefixcolor, ul.suffixcolor , username , u.id FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}don_historie d  ON u.id = d.don_id INNER JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id ORDER BY username",true,$btit_settings["cache_duration"]);
$donation=array();
$i=0;

     if ($r2)
        {
        foreach ($r2 as $arr)
            {

        $namee=unesc($arr["prefixcolor"] . $arr["username"] . $arr["suffixcolor"]);
        $yearnr = substr($arr['donate_date'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date'], 0,4)."</span>";
        }
        $don = "<span style='color:green'>".substr($arr['donate_date'], 8, -9)."-".substr($arr['donate_date'], 5, -12).$year;
        if  ($arr['donate_date_1']=='0000-00-00 00:00:00')
        {
        $don1= '-';
        }
        else
         {
        $yearnr = substr($arr['donate_date_1'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_1'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_1'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_1'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_1'], 0,4)."</span>";
        }

        $don1 = "<span style='color:green'>".substr($arr['donate_date_1'], 8, -9)."-".substr($arr['donate_date_1'], 5, -12).$year;
        }
        if  ($arr['donate_date_2']=='0000-00-00 00:00:00')
        {
        $don2= '-';
        }
        else
        {
                $yearnr = substr($arr['donate_date_2'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_2'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_2'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_2'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_2'], 0,4)."</span>";
        }
        $don2 = "<span style='color:green'>".substr($arr['donate_date_2'], 8, -9)."-".substr($arr['donate_date_2'], 5, -12).$year;
        }
        if  ($arr['donate_date_3']=='0000-00-00 00:00:00')
        {
        $don3= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_3'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_3'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_3'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_3'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_3'], 0,4)."</span>";
        }
        $don3 = "<span style='color:green'>".substr($arr['donate_date_3'], 8, -9)."-".substr($arr['donate_date_3'], 5, -12).$year;
        }
        if  ($arr['donate_date_4']=='0000-00-00 00:00:00')
        {
        $don4= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_4'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_4'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_4'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_4'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_4'], 0,4)."</span>";
        }
        $don4 = "<span style='color:green'>".substr($arr['donate_date_4'], 8, -9)."-".substr($arr['donate_date_4'], 5, -12).$year;
        }
        if  ($arr['donate_date_5']=='0000-00-00 00:00:00')
        {
        $don5= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_5'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_5'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_5'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_5'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_5'], 0,4)."</span>";
        }
        $don5 = "<span style='color:green'>".substr($arr['donate_date_5'], 8, -9)."-".substr($arr['donate_date_5'], 5, -12).$year;
        }
        if  ($arr['donate_date_6']=='0000-00-00 00:00:00')
        {
        $don6= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_6'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_6'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_6'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_6'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_6'], 0,4)."</span>";
        }
        $don6 = "<span style='color:green'>".substr($arr['donate_date_6'], 8, -9)."-".substr($arr['donate_date_6'], 5, -12).$year;
        }
        if  ($arr['donate_date_7']=='0000-00-00 00:00:00')
        {
        $don7= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_7'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_7'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_7'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_7'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_7'], 0,4)."</span>";
        }
        $don7 = "<span style='color:green'>".substr($arr['donate_date_7'], 8, -9)."-".substr($arr['donate_date_7'], 5, -12).$year;
        }
        if  ($arr['donate_date_8']=='0000-00-00 00:00:00')
        {
        $don8= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_8'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_8'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_8'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_8'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_8'], 0,4)."</span>";
        }
        $don8 = "<span style='color:green'>".substr($arr['donate_date_8'], 8, -9)."-".substr($arr['donate_date_8'], 5, -12).$year;
        }
        if  ($arr['donate_date_9']=='0000-00-00 00:00:00')
        {
        $don9= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_9'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_9'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_9'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_9'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_9'], 0,4)."</span>";
        }
        $don9 = "<span style='color:green'>".substr($arr['donate_date_9'], 8, -9)."-".substr($arr['donate_date_9'], 5, -12).$year;
        }
        if  ($arr['donate_date_10']=='0000-00-00 00:00:00')
        {
        $don10= '-';
        }
        else
        {
        $yearnr = substr($arr['donate_date_1'], 0,4);
        if ($yearnr=='2007')
        {
        $year =  "<br><span style='color:orange'>".substr($arr['donate_date_10'], 0,4)."</span>";
        }
        if ($yearnr=='2008')
        {
        $year =  "<br><span style='color:steelblue'>".substr($arr['donate_date_10'], 0,4)."</span>";
        }
        if ($yearnr=='2009')
        {
        $year =  "<br><span style='color:purple'>".substr($arr['donate_date_10'], 0,4)."</span>";
        }
        if ($yearnr=='2010')
        {
        $year =  "<br><span style='color:blue'>".substr($arr['donate_date_10'], 0,4)."</span>";
        }
        $don10 = "<span style='color:green'>".substr($arr['donate_date_10'], 8, -9)."-".substr($arr['donate_date_10'], 5, -12).$year;
        }
        $donation[$i]["Username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["id"]."_".strtr($namee, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["id"])."'>".$namee."</a>";
        $donation[$i]["a"]=$don;
        $donation[$i]["b"]=$don1;
        $donation[$i]["c"]=$don2;
        $donation[$i]["d"]=$don3;
        $donation[$i]["e"]=$don4;
        $donation[$i]["f"]=$don5;
        $donation[$i]["g"]=$don6;
        $donation[$i]["h"]=$don7;
        $donation[$i]["i"]=$don8;
        $donation[$i]["j"]=$don9;

        $i++;
}
$don_historietpl->set("donation",$donation);
}

?>