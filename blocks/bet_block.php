<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Betting</h4>
</div>
<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//   SPORT BETTING HACK , orginal TBDEV 2009 by Soft & Bigjoos 
//   XBTIT conversion by DiemThuy , April 2010
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

global $TABLE_PREFIX, $language;

echo "<TABLE width=100% border=0 cellspacing=1 cellpadding=1 class=forumline>
<tr><td align=center><a href=index.php?page=bet><img src=images/bet.png border=0></a></td></tr>";

$bet = get_result("SELECT `undertext`, `endtime` FROM `{$TABLE_PREFIX}betgames` WHERE `active`=1 ORDER BY `endtime` ASC LIMIT 5", true, $btit_settings["cache_duration"]);

if(count($bet)==0)
    $bb=$language["SB_NO_BETS_ATM"];
else
    $bb=$language["SB_CURR_BETS"];	

echo"<TR><TD class = header align = center>$bb</TD></TR>";

foreach($bet as $fetch)
{
    $a=$fetch['undertext'];
    echo"<TR ><TD align=center>$a</TD></TR>";
    echo"<TR><TD class = lista align = center><font color = red>Ends: </font>".date('jS F \a\\t g:ia',$fetch['endtime'])."</TD></TR>";
}
print("</table>");

?>
<div class="panel-footer">
</div>
</div>