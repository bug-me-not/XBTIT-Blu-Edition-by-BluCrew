<?php

if ($CURUSER["moderate_trusted"]=="yes" || $CURUSER["edit_torrents"]=="yes")
    $check4=TRUE;

if (!defined("IN_BTIT"))
      die("non direct access!");


if ($CURUSER["moderate_trusted"] || $CURUSER["edit_torrents"]=="yes")
{
    $torrenttpl=new bTemplate();
    $full="SELECT `f`.`moder` `moder`, `f`.`filename`, `f`.`info_hash`, `f`.`uploader` `upname`, `u`.`username` `uploader`, `c`.`image`, `c`.`name` `cname`, `f`.`category` `catid`, `u2`.`username` `approved_by` FROM `{$TABLE_PREFIX}files` `f` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`id` = `f`.`uploader` LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `c`.`id` = `f`.`category` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by` = `u2`.`id`";
    if ($_GET["hash"])
    {
        $_GET["hash"]=strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["hash"]));

        $sql=$full." WHERE `f`.`info_hash`='".sql_esc($_GET["hash"])."'";
        $row = do_sqlquery($sql,true);

        if (sql_num_rows($row)==1) 
        {
            while ($data=$row->fetch_array())
            {
                $torrenttpl->set("filename",$data['filename']);
                $torrenttpl->set("uploader","<a href=\""."index.php?page=userdetails&id=".$data["upname"]."\">".$data["uploader"]."</a>");
                $torrenttpl->set("info_hash",$data['info_hash']);
                $link="index.php?page=moder&hash=".$data['info_hash']."";
                $torrenttpl->set("link",$link);

                if (!empty($_POST["msg"]))
                {
                    $torrent="[url=".$btit_settings['url']."/"."index.php?page=torrent-details&id=".$data["info_hash"]."]".$data['filename']."[/url]";
                    $msg=$language["TMOD_SOR1"]." ".$data["uploader"].", ".$language["TMOD_SOR2"]." $torrent ".$language["TMOD_SOR3"].":\n\n[b]".sqlesc(htmlspecialchars($_POST["msg"].$_POST['moderate_reasons']))."[/b]".$language["TMOD_SOR4"];

                    send_pm($CURUSER["uid"],$data['upname'],sqlesc($data['filename']), sqlesc($msg));

                    $sended=$language["TMOD_SEN1"];
                    $answer=TRUE;
                    $torrenttpl->set("message",$sended);
                }
                elseif ($_POST && empty($_POST["msg"]))
                {
                    $sended2=$language["TMOD_SEN2"];
                    $answer2=TRUE;
                    $torrenttpl->set("message2",$sended2);
                }
            }

            $sql = "SELECT * FROM {$TABLE_PREFIX}warn_reasons WHERE active='1'";
            $row = do_sqlquery($sql,true);
            $select_reasons ="<select name='moderate_reasons' onchange=\"var desc = document.getElementById('description'); desc.innerHTML = this[this.selectedIndex].value;\"><option value=''>Nothing...</option>";
            while ($data=$row->fetch_array())
            {
                $select_reasons .="<option value='".$data['text']."'>".$data['title']."</option>";
            }
            $select_reasons.="</select>";
            $torrenttpl->set("moderate_reasons",$select_reasons);
            $torrenttpl->set("SENDED",$answer,TRUE);
            $torrenttpl->set("NO_SENDED",$answer2,TRUE);
            $check=TRUE;
        }
        else
        {
            $check2=TRUE;
        }
        $torrenttpl->set("return","index.php?page=moder");
    }
    elseif ($_GET["edit"])
    {
        $_GET["edit"]=strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["edit"]));

        $check5=TRUE;
        $sql=$full." WHERE `f`.`info_hash`='".sql_esc($_GET["edit"])."'";
        $row = do_sqlquery($sql,true);
        if (sql_num_rows($row)==1)
        {
            while ($data=$row->fetch_array()) {
                $torrenttpl->set("filename2",$data['filename']);
                $torrenttpl->set("uploader2","<a href=\""."index.php?page=userdetails&id=".$data["upname"]."\">".$data["uploader"]."</a>");
                $torrenttpl->set("info_hash2",$data['info_hash']);
                switch ($data['moder'])
                {
                    case 'ok':
                      $checked1="SELECTED";
                      break;
                    case 'bad':
                      $checked2="SELECTED";
                      break;
                    case 'um':
                      $checked3="SELECTED";
                      break;
                }
                $link2="index.php?page=moder&edit=".$data['info_hash']."";
                $editing="<form method=\"post\" action=\"".$link2."\"><select name=\"moder\">
                          <option ".$checked1." value=\"ok\">".$language["TMOD_OK"]."</option>
                          <option ".$checked2." value=\"bad\">".$language["TMOD_BAD"]."</option>
                          <option ".$checked3." value=\"um\">".$language["TMOD_UM"]."</option>
                          </select>
                          <input type=\"hidden\" name=\"hash\" value=\"".$data['info_hash']."\" />
                          <input type=\"hidden\" name=\"ex_moder\" value=\"".$data['moder']."\" />
                          <input type=\"submit\" value=\"Moder\" /></form>";
                if (isset($_POST["moder"]))
                {
                    quickQuery("UPDATE {$TABLE_PREFIX}files SET moder='".sql_esc($_POST['moder'])."' WHERE info_hash='".$data['info_hash']."'",true);
                    $check6=TRUE;
                    if ($_POST["ex_moder"]!=$_POST["moder"] && $_POST["moder"]=="bad")
                    {
                        header ("Location: index.php?page=moder&hash=".$_POST["hash"]."");
                    }
                    $torrenttpl->set("return","index.php?page=moder");
                }
                else
                    $check8=TRUE;
                $torrenttpl->set("editing",$editing);
            }
        }
        else
        {
            $check2=TRUE;
        }
        $torrenttpl->set("return","index.php?page=moder");
    }
    else
    {
        $check3=TRUE;
        $sql=$full." WHERE `f`.`moder`!='ok'";
        $row = do_sqlquery($sql,true);
        if (sql_num_rows($row)>0)
        {
            $selecting="<table border=\"1\">";
            $selecting.="<tr><td align=\"center\"><b>".$language["TMOD_S_MOD"]."</b></td><td align=\"center\"><b>".$language["TMOD_S_CAT"]."</b></td><td align=\"center\"><b>".$language["NAME"]."<b></td><td align=\"center\"><b>".$language["TMOD_Dl"]."<b></td><td align=\"center\"><b>".$language["UPLOADED"]."</b></td></tr>";
            if(!isset($language["SYSTEM_USER"]))
                $language["SYSTEM_USER"]="System";
            while ($data=$row->fetch_array())
            {
                if ($CURUSER['edit_torrents']=="yes")
                {
                    $link="edit&info_hash";
                }
                else
                {
                    $link="moder&edit";
                }
                $selecting.="<tr>";
                $selecting.="<td align=\"center\"><a title=\"".$data["moder"].(($btit_settings["mod_app_sa"]=="yes" && $CURUSER["admin_access"]=="yes" && $data["username"]!=$language["SYSTEM_USER"] && $data["moder"]!="um")?(($data["moder"]=="ok")?" (".$language["TMOD_APPROVED_BY"]." ".$data["username"].")":" (".$language["TMOD_REJECTED_BY"]." ".$data["approved_by"].")"):"")."\" href=\"index.php?page=edit&info_hash=".$data["info_hash"]."\">".(($data["moder"]=="ok")?"<button class='btn btn-labeled btn-success' type='button'><span class='btn-label'><i class='fa fa-thumbs-up'></i></span>Approved</button>":"<button class='btn btn-labeled btn-danger' type='button'><span class='btn-label'><i class='fa fa-thumbs-down'></i></span>Denied</button>")."</a></td>";
                $selecting.="<td align=\"center\"><a href=\"index.php?page=torrents&category=".$data['catid']."\" title=\"".$data["cname"]."\">".image_or_link(($data["image"]==""?"":"$STYLEPATH/images/categories/".$data["image"]),"",$data["cname"])."</a></td>";
                $selecting.="<td align=\"center\"><a href='index.php?page=torrent-details&id=".$data["info_hash"]."' title='".$language["VIEW_DETAILS"]. ": ".$data["filename"].(($btit_settings["mod_app_sa"]=="yes" && $CURUSER["admin_access"]=="yes" && $data["approved_by"]!=$language["SYSTEM_USER"] && $data["moder"]=="bad")?" (".$language["TMOD_REJECTED_BY"]." ".$data["approved_by"].")":"")."'>".$data['filename']."</a></td>";
                $selecting.="<td align=\"center\"><a href=\"download.php?id=".$data["info_hash"]."&f=".urlencode($data["filename"]).".torrent\" title=\"".$data["filename"]."\">".image_or_link("images/download.gif","","torrent")."</a></td>";
                $selecting.="<td align=\"center\"><a href=\""."index.php?page=userdetails&id=".$data["upname"]."\">".$data["uploader"]."</a></td>";
                $selecting.="</tr>";
            }
            $selecting.="</table>";
        }
        else
            $selecting=$language["TMOD_NOTORR"]."<br>";

        $torrenttpl->set("selecting",$selecting);
        $torrenttpl->set("return","index.php?page=torrents");
    }
    $torrenttpl->set("CHECK",$check,TRUE);
    $torrenttpl->set("CHECK2",$check2,TRUE);
    $torrenttpl->set("CHECK3",$check3,TRUE);
    $torrenttpl->set("CHECK4",$check4,TRUE);
    $torrenttpl->set("CHECK5",$check5,TRUE);
    $torrenttpl->set("CHECK6",$check6,TRUE);
    $torrenttpl->set("CHECK8",$check8,TRUE);
}
else 
{
    stderr($language["ERROR"],$language["TR_UNAUTH"]);
}
?>