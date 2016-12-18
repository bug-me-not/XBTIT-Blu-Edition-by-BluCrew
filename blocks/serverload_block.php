<div class="panel panel-primary">
  <div class="panel-heading">
    <h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse24">Server Info</a>
</h4>
  </div>
  <div id="collapse24" class="panel-collapse collapse in">
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

if (!function_exists("getmicrotime"))
{
   function getmicrotime(){
       list($usec, $sec) = explode(" ",microtime());
       return ((float)$usec + (float)$sec);
       }
}

$percent = min(100, round(@exec('ps ax | grep -c apache') / 256 * 10 ),4);

// try other method
if ($percent == 0)
    {
    $time_start = getmicrotime();
    $time = round(getmicrotime() - $time_start,4);
    $percent = $time * 60;
    }


echo "<div align=\"center\">".$language["TRACKER_LOAD"].": ($percent %)</div><table class=\"blocklist\" align=\"center\" border=\"0\" width=\"400\"><tr><td style='padding: 0px; background-image: url(addons/serverload/loadbarbg.gif); background-repeat: repeat-x;'>";

//TRACKER LOAD
if ($percent <= 70) $pic = "addons/serverload/loadbargreen.gif";
elseif ($percent <= 90) $pic = "addons/serverload/loadbaryellow.gif";
else $pic = "addons/serverload/loadbarred.gif";
$width = $percent*4;
echo "<img height=\"15\" width=$width src=\"$pic\" alt=\"$percent%\" /></td></tr></table>";
echo "<center>" . trim(@exec('uptime')) . "</center><br />";

if (isset($load))
print("<tr><td class=\"blocklist\">10min load average (%)</td><td align=\"right\">$load</td></tr>\n");
print("<br />");
$percent = min(100, round(@exec('ps ax | grep -c apache') / 256 * 50),4);
// try other method
if ($percent == 0)
    {
    $time = round(getmicrotime() - $time_start,4);
    $percent = $time * 60;
    }

echo "<div align=\"center\">".$language["GLOBAL_SERVER_LOAD"].": ($percent %)</div><table class=\"blocklist\" align=\"center\" border=\"0\" width=\"400\"><tr><td style='padding: 0px; background-image: url(addons/serverload/loadbarbg.gif); background-repeat: repeat-x;'>";

 if ($percent <= 70) $pic = "addons/serverload/loadbargreen.gif";
  elseif ($percent <= 90) $pic = "addons/serverload/loadbaryellow.gif";
   else $pic = "addons/serverload/loadbarred.gif";
        $width = $percent * 4;
echo "<img height=\"15\" width=$width src=\"$pic\" alt=\"$percent%\" /></td></tr></table><br /><br />";
?>
</div>
<div class="panel-footer">
</div>
</div>