<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");



switch ($action)
 {
   case 'save':
        if ($_POST["confirm"]==$language["FRM_CONFIRM"])
          {
          if (strlen($_POST["offline_msg"])>200)
             $_POST["offline_msg"]=substr($_POST["offline_msg"],0,200);
          quickQuery("DELETE FROM {$TABLE_PREFIX}settings WHERE `key`='site_offline' OR `key`='offline_msg'",true);
          quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`)
                       VALUES ('site_offline',".(isset($_POST["offline"])?"'true'":"'false'")."),
                       ('offline_msg',".sqlesc($_POST["offline_msg"]).");",true);

        }
        $btit_settings["site_offline"]=(isset($_POST["offline"])?true:false);
        $btit_settings["offline_msg"]=$_POST["offline_msg"];
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=offline&rc=1");
        die;
   break;

   case '':
   default:
        $btit_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings");
        $admintpl->set("language",$language);
        $admintpl->set("form_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=offline&amp;action=save");
        $admintpl->set("offline_checked",$btit_settings["site_offline"]?"checked=\"checked\"":"");
        $admintpl->set("offline_message",$btit_settings["offline_msg"]);
   break;
}


?>