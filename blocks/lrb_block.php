<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse17">Low Ratio</a>
</h4>
</div>
<div id="collapse17" class="panel-collapse collapse in">
<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
// Low Ratio and Ban System hack by DiemThuy - Juni 2010
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

global $TABLE_PREFIX, $language, $btit_settings, $res_seo;

$r2 = get_result("SELECT `u`.id, `u`.`username`, `u`.`rat_warn_level`, `u`.`bandt`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`rat_warn_level`!=0 OR `u`.`bandt`='yes' ORDER BY `u`.`rat_warn_time` DESC LIMIT 10",true,$btit_settings["cache_duaration"]);

echo "<table class=lista border=0 align=center width=100%>";

if(count($r2)>0)
{
    foreach ($r2 as $arr)
    {
        $name = "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["id"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["id"])."'>".unesc($arr["prefixcolor"].$arr["username"].$arr["sufixcolor"])."</a>";
        $wt=$arr["rat_warn_level"];

        if ($arr["bandt"]=='no')
        {
            echo "<tr><td class='lista' style='text-align:center;'><span style='color:orange;'><b>".$language["RAT_WARN_X"].$wt.":</b></span> ".$name."</td></tr>";
        }
        else
        {
            echo "<tr><td class='lista' style='text-align:center;'><span style='color:red;'><b>".$language["RAT_BANNED"].":</b></span> ".$name."</td></tr>";	
        }
    }
}
else
{
    echo "<tr><td class='lista' style='text-align:center;'><b>".$language["RAT_NOTHING_YET"]."</b></td></tr>";
}

echo"</table>";

?>
</div>
<div class="panel-footer">
</div>
</div>