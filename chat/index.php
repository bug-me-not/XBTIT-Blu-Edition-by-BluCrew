<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// Suppress errors.
error_reporting(0);

// Path to the chat directory:
define('AJAX_CHAT_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');

// Include custom libraries and initialization code:
require(AJAX_CHAT_PATH.'lib/custom.php');

if(!$CURUSER || $CURUSER['uid']==1)
{
   redirect($BASEURL);
}

if($btit_settings["fmhack_booted"]=="enabled")
{
    if ($CURUSER["uid"]>1 && $CURUSER["booted"] == "yes")
        redirect("logout.php");
}

if($btit_settings['fmhack_ajax_chat']=='enabled'){

// Include Class libraries:
require(AJAX_CHAT_PATH.'lib/classes.php');

// Initialize the chat:
$ajaxChat = new CustomAJAXChat();

}else{
   redirect($BASEURL);
}
?>
