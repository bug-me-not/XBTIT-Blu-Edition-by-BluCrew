<?php
////////////////////////////////////////
//
// Upcoming system
// For use only with XBTIT Blu Edition
//
// By MrG04
//
////////////////////////////////////////

if(!defined("IN_BTIT"))
redirect("index.php");

require load_language("lang_upcoming.php"); // Needs creation
require dirname(__FILE__)."/include/offset.php";

if($CURUSER['view_torrents'] == 'no') // Or needs to check if the feature is disabled.
{
    stderr($language["UPC_ACC_HEAD"], $language["UPC_ACC_DENIED"]);
    die();
}
else
{
    if($btit_settings['upcoming_onoff'] == 'true')
    {
        $upcomingtpl = new bTemplate();
		$act = (isset($_GET['action']) && $_GET['action'] != '')?$_GET['action']:'';

        if($act == 'viewupcoming')
        {
            $upcomingtpl->set("view_upcoming",false,true);
        }
        else
        {
            $upcomingtpl->set("view_upcoming",true,true);


        }
    }
    else
    {
        stderr($language['UPC_OFF_HEAD'], $language['UPC_OFF_MSG']);
        die();
    }
}
?>
