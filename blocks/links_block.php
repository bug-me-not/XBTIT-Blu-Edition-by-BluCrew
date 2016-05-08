<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Affiliates</h4>
</div>
<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//  Partners page by DiemThuy - Jan 2010
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

global $CURUSER, $btit_settings, $TABLE_PREFIX;

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
{
    // do nothing
}
else
{
    $res=get_result("SELECT `link`, `banner` FROM `{$TABLE_PREFIX}partner`", true, $btit_settings["cache_duration"]);

    if(count($res)>0)
    {
        echo "<div align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'><tr><td><marquee direction='left' onmouseover='this.stop()' onmouseout='this.start()'>";
        foreach($res as $result)
        {
            echo "<a href='".$result["link"]."' target='_blank'><img src='".$result["banner"]."' height='54'></a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        echo "</marquee></td></tr></table></div>\n";
    }
}

?>
<div class="panel-footer">
</div>
</div>