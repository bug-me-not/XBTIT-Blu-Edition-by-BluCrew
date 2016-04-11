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
require_once("../include/functions.php");

//anonymous links by cooly
function anon_1($string)
{
    // [url=http://www.example.com]Text[/url]
    if(preg_match('|^http(s)?://'.$_SERVER['HTTP_HOST'].'?(/.*)?$|i',$string[1]))
    {
        $string[1]="<a href=\"$string[1]\" target=\"_blank\">$string[3]</a>";
    }
    else
    {
        $string[1]="<a href=\"http://anonym.to/?$string[1]\" target=\"_blank\">$string[3]</a>";
    }
    return $string[1];
}
function anon_2($string)
{
    // [url]http://www.example.com[/url]
    if(preg_match('|^http(s)?://'.$_SERVER['HTTP_HOST'].'?(/.*)?$|i',$string[1]))
    {
        $string[1]="<a href=\"$string[1]\" target=\"_blank\">$string[1]</a>";
    }
    else
    {
        $string[1]="<a href=\"http://anonym.to/?$string[1]\" target=\"_blank\">$string[1]</a>";
    }
    return $string[1];
}
function anon_3($string)
{
    // [url]www.example.com[/url]
    if(preg_match('|^http(s)?://'.$_SERVER['HTTP_HOST'].'?(/.*)?$|i',$string[1]))
    {
        $string[1]="<a href=\"http://".$string[1]."\" target=\"_blank\">$string[1]</a>";
    }
    else
    {
        $string[1]="<a href=\"http://anonym.to/?http://".$string[1]."\" target=\"_blank\">$string[1]</a>";
    }
    return $string[1];
}
function anon_4($string)
{
    // [url=www.example.com]Text[/url]
    if(preg_match('|^http(s)?://'.$_SERVER['HTTP_HOST'].'?(/.*)?$|i',$string[1]))
    {
        $string[1]="<a href=\"http://".$string[1]."\" target=\"_blank\">$string[2]</a>";
    }
    else
    {
        $string[1]="<a href=\"http://anonym.to/?http://".$string[1]."\" target=\"_blank\">$string[2]</a>";
    }
    return $string[1];
}
// end anonymous links by cooly

function format_shout($text, $strip_html = true) {

    global $smilies, $BASEURL, $privatesmilies, $SITENAME, $btit_settings, $radio_msg, $CURUSER;

    $s = $text;
    //$s = strip_tags($s);

  if ($strip_html)
    $s = htmlspecialchars($s);

    $s = unesc($s);

    # for main shout window
    $f = @fopen("../badwords.txt","r");

    if ($f && filesize("../badwords.txt") != 0) {

       $bw = fread($f, filesize("../badwords.txt"));
       $badwords = explode("\n",$bw);

       for ($i=0; $i<count($badwords); ++$i)
           $badwords[$i] = trim($badwords[$i]);
       $s = str_replace($badwords, "<img src='images/censored.png' border='0' alt='' />", $s);
    }
    @fclose($f);

    # for shout history window
    $f = @fopen("badwords.txt","r");

    if ($f && filesize("badwords.txt") != 0) {

       $bw = fread($f, filesize("badwords.txt"));
       $badwords = explode("\n",$bw);

       for ($i=0; $i<count($badwords); ++$i)
           $badwords[$i] = trim($badwords[$i]);
       $s = str_replace($badwords, "<img src='images/censored.png' border='0' alt='' />", $s);
    }
    @fclose($f);

    // [img]http://www/image.gif[/img]
    $s = preg_replace("/\[img\]((http)+(s)?:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\[\/img\]/", "<img border=0 src=\"\\1\">", $s);
    $s = preg_replace("/\[IMG\]((http)+(s)?:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\[\/IMG\]/", "<img border=0 src=\"\\1\">", $s);

    // [b]Bold[/b]
    $s = preg_replace("/\[b\]((\s|.)+?)\[\/b\]/", "<b>\\1</b>", $s);

  	$s = preg_replace("/\[radio\]\s*/i", "".$radio_msg."", $s);

    // [i]Italic[/i]
    $s = preg_replace("/\[i\]((\s|.)+?)\[\/i\]/", "<i>\\1</i>", $s);

    // [u]Underline[/u]
    $s = preg_replace("/\[u\]((\s|.)+?)\[\/u\]/", "<u>\\1</u>", $s);

    // [color=blue]Text[/color]
    $s = preg_replace(
        "/\[color=([a-zA-Z]+)\]((\s|.)+?)\[\/color\]/i",
        "<font color=\\1>\\2</font>", $s);

    // [color=#ffcc99]Text[/color]
    $s = preg_replace(
        "/\[color=(#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])\]((\s|.)+?)\[\/color\]/i",
        "<font color=\\1>\\2</font>", $s);

    if($btit_settings["fmhack_anonymous_links"]=="enabled")
    {
        // [url=http://www.example.com]Text[/url]
        $s = preg_replace_callback(
            "/\[url=((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
            "anon_1", $s);

        // [url]http://www.example.com[/url]
        $s = preg_replace_callback(
            "/\[url\]((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\[\/url\]/i",
            "anon_2", $s);

        // [url]www.example.com[/url]
        $s = preg_replace_callback(
            "/\[url\](www\.[^<>\s]+?)\[\/url\]/i",
            "anon_3", $s);

        // [url=www.example.com]Text[/url]
        $s = preg_replace_callback(
            "/\[url=(www\.[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
            "anon_4", $s);
    }
    else
    {
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
    }

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

     if($btit_settings["fmhack_custom_smileys"]=="enabled")
    {
    global $TABLE_PREFIX;
    $list=get_result("SELECT `key`,`value` FROM {$TABLE_PREFIX}smilies",true);

    foreach($list as $code=>$url)

        $s = str_replace($url['key'], "<img border='0' src='$BASEURL/images/smilies/".$url['value']."' alt='".$url['key']."' />", $s);
    }
    else{
	reset($smilies);
    while (list($code, $url) = each($smilies))
    $s = str_replace($code, "<img border='0' src='$BASEURL/images/smilies/$url' alt='$code' />", $s);
	}

    reset($privatesmilies);
    while (list($code, $url) = each($privatesmilies))
        $s = str_replace($code, "<img border='0' src='$BASEURL/images/smilies/$url' alt='$code' />", $s);

	if($btit_settings["fmhack_shoutbox_clean"]=="enabled")
    {
    $is_mod=$CURUSER["edit_users"]=="yes";
    if ((preg_match_all ('' . '#^/clean(.*)$#', $s, $Matches, PREG_SET_ORDER) AND $is_mod))
  {
    return execcommand_clean ($Matches);
  }elseif ((preg_match_all ('' . '#^/clean(.*)$#', $s, $Matches, PREG_SET_ORDER) AND !$is_mod))
  {return execcommand_noclean($Matches);}
    }


    return $s;
}
?>
