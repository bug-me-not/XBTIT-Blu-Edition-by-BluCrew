<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2010  Btiteam
//
// Bots Visit Hack by DiemThuy - Dec 2010
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



require_once ("include/functions.php");

echo "<TABLE width=100% border=0 cellspacing=1 cellpadding=1 class=forumline>
<TR>
<TD class=lista>BOT Name :</TD>
<TD class=lists>Last Visit :</TD>
</TR>";

$r2 = mysql_query("SELECT * FROM {$TABLE_PREFIX}bots ORDER BY visit DESC LIMIT 10") or die(mysql_error());

while ($arr=mysql_fetch_assoc($r2))
{
$post=date("l_jS_F_Y_\a\\t_g:i_a",strtotime($arr["visit"]));
echo "<tr align=left><td><b><span title=".$post.">".$arr["name"]."</span></b></td><td> ".date('d/m/Y',strtotime($arr["visit"]))."</td></tr>";
}

echo"</table>";
?>
