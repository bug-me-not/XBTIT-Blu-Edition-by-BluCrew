<?php

global $CURUSER, $btit_settings;

if($btit_settings["fmhack_LED_ticker"]=="enabled")
{
    if(!$CURUSER || !$CURUSER[uid]>1)
    {
    }
    else
    {
        block_begin();

        echo'<center><applet codebase="./LED" code="LED.class" width=500 height=48 align=center>
          <param name="script" value="LED/data.php">
          <param name="border" value="2">
          <param name="bordercolor" value="0,0,0">
          <param name="spacewidth" value="3">
          <param name="wth" value="122">
          <param name="ht" value="9">
          <param name="font" value="LED/default.font">
          <param name="ledsize" value="3">
          <hr>
          '.$language["LED_ERR"].'
          <BR>
          <IMG SRC="LED/LEDSign.gif">
          <hr>
          </applet></center>';

        block_end();
    }
}
?>