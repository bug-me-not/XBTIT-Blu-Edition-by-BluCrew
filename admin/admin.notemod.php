<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



(isset($_GET["action"]) && !empty($_GET["action"]) && ($_GET["action"]=="edit" || $_GET["action"]=="delete" || $_GET["action"]=="edit_submit")) ? $action=$_GET["action"] : $action="false";
(isset($_GET["returnto"]) && !empty($_GET["returnto"]) && substr(base64_decode(urldecode($_GET["returnto"])),0,9)=="index.php") ? $returnto=base64_decode(urldecode($_GET["returnto"])) : $returnto="index.php";
(isset($_GET["eduser"]) && !empty($_GET["eduser"]) && is_numeric($_GET["eduser"]) && $_GET["eduser"]>0) ? $id=(int)0+$_GET["eduser"] : $id=0;
$noteid=(int)0+$_GET["noteid"];
(isset($_POST["edit"]) && !empty($_POST["edit"])) ? $edit=$_POST["edit"] : $edit=false;

$admintpl->set("is_edit", false, true);
$admintpl->set("language", $language);

switch($action)
{
    case 'edit':
        if($id>0)
        {
            // Grab the notes field from the DB
            $res=get_result("SELECT `user_notes` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);
            if(count($res)>0)
            {
                $row=$res[0];
                if(!empty($row["user_notes"]))
                {
                    // Unserialize the data
                    $notes=unserialize($row["user_notes"]);
                    $decoded=base64_decode($notes[$noteid]);
                    $exploded=explode("<+>", $decoded);
                    $admintpl->set("editnote", textbbcode("notemod", "edit", $exploded[0]));
                    $admintpl->set("is_edit", true, true);
                    $admintpl->set("noteid", $noteid);
                    $admintpl->set("eduser", $id);
                    $admintpl->set("returnto", urlencode(base64_encode($returnto)));
                    $admintpl->set("uid", $CURUSER["uid"]);
                    $admintpl->set("random", $CURUSER["random"]);
                }
            }
        }
        break;


    case 'edit_submit':
        if($id>0 && $edit!==false)
        {
            // Grab the notes field from the DB
            $res=get_result("SELECT `user_notes` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);
            if(count($res)>0)
            {
                $row=$res[0];
                if(!empty($row["user_notes"]))
                {
                    // Unserialize the data
                    $notes=unserialize($row["user_notes"]);
                    $decoded=base64_decode($notes[$noteid]);
                    $exploded=explode("<+>", $decoded);

                    if($edit!=$exploded[0])
                    {
                        $exploded[0]=$edit;
                        $exploded[4]=$CURUSER["uid"];
                        $exploded[5]=unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]);
                        $exploded[6]=time();
                    }
                    $imploded=implode("<+>", $exploded);
                    $encoded=base64_encode($imploded);
                    $notes[$noteid]=$encoded;
                    $output_notes=serialize($notes);

                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($output_notes)."' WHERE `id`=".$id, true);
                    redirect($returnto);
                }
            }
        }
        break;


    case 'delete':
        if($id>0)
        {
            // Grab the notes field from the DB
            $res=get_result("SELECT `user_notes` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);
            if(count($res)>0)
            {
                $row=$res[0];
                if(!empty($row["user_notes"]))
                {
                    // Unserialize the data
                    $notes=unserialize($row["user_notes"]);
                    // Delete the relevent note
                    unset($notes[$noteid]);
                    if(count($notes)>0)
                    {
                        // Rebuild the array
                        $i=0;
                        $new_notes=array();
                        foreach($notes as $v)
                        {
                            $new_notes[$i]=$v;
                            $i++;
                        }
                        // Re-serialize the rebuilt array
                        $output_notes=serialize($new_notes);
                    }
                    else
                    {
                        // Nothing left
                        $output_notes="";
                    }
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($output_notes)."' WHERE `id`=".$id, true);
                    redirect($returnto);
                }
            }
        }
        else
            redirect($returnto);
        break;

    default:
        redirect("index.php");
        break;
}

?>