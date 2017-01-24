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


function format_shout($text)
{
    global $smilies, $BASEURL;

    $s = $text;

    $s = strip_tags($s);

    $s = unesc($s);

    $f=@fopen("badwords.txt","r");
    if ($f && filesize ("badwords.txt")!=0)
       {
       $bw=fread($f,filesize("badwords.txt"));
       $badwords=explode("\n",$bw);
       for ($i=0;$i<count($badwords);++$i)
           $badwords[$i]=trim($badwords[$i]);
       $s = str_replace($badwords,"*censured*",$s);
       }
    @fclose($f);

    // [b]Bold[/b]
    $s = preg_replace("/\[b\]((\s|.)+?)\[\/b\]/", "<b>\\1</b>", $s);

    // [i]Italic[/i]
    $s = preg_replace("/\[i\]((\s|.)+?)\[\/i\]/", "<i>\\1</i>", $s);

    // [u]Underline[/u]
    $s = preg_replace("/\[u\]((\s|.)+?)\[\/u\]/", "<u>\\1</u>", $s);

    // [u]Underline[/u]
    $s = preg_replace("/\[u\]((\s|.)+?)\[\/u\]/i", "<u>\\1</u>", $s);

    // [color=blue]Text[/color]
    $s = preg_replace(
        "/\[color=([a-zA-Z]+)\]((\s|.)+?)\[\/color\]/i",
        "<font color=\\1>\\2</font>", $s);

    // [color=#ffcc99]Text[/color]
    $s = preg_replace(
        "/\[color=(#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])\]((\s|.)+?)\[\/color\]/i",
        "<font color=\\1>\\2</font>", $s);

    // [url=http://www.example.com]Text[/url]
    $s = preg_replace(
        "/\[url=((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
        "<a href=\\1 target=_blank>\\3</a>", $s);

    // [url]http://www.example.com[/url]
    $s = preg_replace(
        "/\[url\]((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\[\/url\]/i",
        "<a href=\\1 target=_blank>\\1</a>", $s);

    // [url]www.example.com[/url]
    $s = preg_replace(
        "/\[url\](www\.[^<>\s]+?)\[\/url\]/i",
        "<a href='http://\\1' target='_blank'>\\1</a>", $s);
        
    // [url=www.example.com]Text[/url]
    $s = preg_replace(
        "/\[url=(www\.[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
        "<a href='http://\\1' target='_blank'>\\2</a>", $s);


    // [size=4]Text[/size]
    $s = preg_replace(
        "/\[size=([1-7])\]((\s|.)+?)\[\/size\]/i",
        "<font size=\\1>\\2</font>", $s);

    // [font=Arial]Text[/font]
    $s = preg_replace(
        "/\[font=([a-zA-Z ,]+)\]((\s|.)+?)\[\/font\]/i",
        "<font face=\"\\1\">\\2</font>", $s);

    // Linebreaks
    $s = nl2br($s);

    // Maintain spacing
    $s = str_replace("  ", " &nbsp;", $s);

    reset($smilies);
    while (list($code, $url) = each($smilies))
        $s = str_replace($code, "<img border=\"0\" src=\"$BASEURL/images/smilies/$url\" alt=\"$url\" />", $s);

    return $s;
}

$msg = array();

include(dirname(__FILE__)."/chat.php");

while (count($msg) >= 100)
      array_shift($msg);

$msg2 = array_reverse($msg);
include("include/offset.php");
for ($i=0;$i<count($msg2);++$i)
{
  $shout[$i]["date"]=date("d/m/y H:i:s",$msg2[$i]['date']-$offset);
  $shout[$i]["user"]=$msg2[$i]['pseudo'];
  $shout[$i]["shout"]=format_shout($msg2[$i]['texte']);
}
unset($msg);
unset($msg2);
$tpl_shout=new bTemplate;
$tpl_shout->set("chat",$shout);
$tpl_shout->set("script","<a href=\"javascript: window.close()\">".$language["CLOSE"]."</a>");

?>