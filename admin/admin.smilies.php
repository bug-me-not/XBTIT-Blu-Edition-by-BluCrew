<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");
      
      
$action=isset($_GET["action"])?htmlentities($_GET["action"],ENT_QUOTES,"UTF-8"):$action='';
switch($action)
{
case'import':
require_once("include/smilies.php");
if(count($smilies)>0)
{
    $query_output="INSERT INTO `{$TABLE_PREFIX}smilies` (`key`, `value`) VALUES ";
    foreach($smilies as $key => $value)
    {
        $query_output.="('".sql_esc($key)."', '".sql_esc($value)."'), ";
    }
    // Remove the comma at the end. Add a semi-colon instead
    $query_output=trim($query_output, ", ").";";

    if($query_output!="INSERT INTO `{$TABLE_PREFIX}smilies` (`key`, `value`) VALUES ")
        do_sqlquery($query_output, true);
}
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=smilies");
break;
case'save_edit':
$old=isset($_POST["old_id"])?sqlesc(htmlentities($_POST["old_id"],ENT_QUOTES,"UTF-8")):$old='';
$tag=isset($_POST["tag"])?sqlesc(htmlentities($_POST["tag"],ENT_QUOTES,"UTF-8")):$tag='';
$file=isset($_POST["file"])?sqlesc(htmlentities($_POST["file"],ENT_QUOTES,"UTF-8")):$file='';
if(file_exists("images/smilies/".$file."") && $_SERVER["REQUEST_METHOD"]=="POST" && !empty($tag) && !empty($old))
{
quickQuery("UPDATE {$TABLE_PREFIX}smilies SET `key`='".$tag."',`value`='".$file."' WHERE `value`='".$old."'",true);
success_msg($language["SUCCESS"],$language["SMILE_UPD"]."<br /><a href='javascript:history.back()'>".$language["BACK"]."</a>");
}
else
{
stderr($language["ERROR"],$language["SMILE_IMGER"]);
}
break;
case'edit':
$id=isset($_GET["id"])?htmlentities($_GET["id"],ENT_QUOTES,"UTF-8"):$id='';
if($id!='')
{
$edit=get_result("SELECT `key`,`value` FROM {$TABLE_PREFIX}smilies WHERE `value`='".$id."' LIMIT 1",true);
$admintpl->set("tag",$edit[0]["key"]);
$admintpl->set("img",$edit[0]["value"]);
$admintpl->set("old_id",$id);
$admintpl->set("edt_frm","index.php?page=admin&user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smilies&amp;action=save_edit");
}
else
{
stderr($language["ERROR"],$language["BAD_ID"]);
}
break;
case'delete':
$id=isset($_GET["id"])?htmlentities($_GET["id"],ENT_QUOTES,"UTF-8"):$id='';
if($id!='')
{
quickQuery("DELETE FROM {$TABLE_PREFIX}smilies WHERE `value`='$id'",true);
@unlink("images/smilies/$id");
success_msg($language["SUCCESS"],$language["SMILE_DLD"]."<br /><a href='javascript:history.back()'>".$language["BACK"]."</a>");
}
else
{
stderr($language["ERROR"],$language["BAD_ID"]);
}
break;
case'upload_new':
if($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_POST["tag"]) && !empty($_FILES))
{
$tag=isset($_POST["tag"])?sqlesc(htmlentities($_POST["tag"],ENT_QUOTES,"UTF-8")):$tag='';
$imgpath = "images/smilies/";
$file = $_FILES['file']['name'];
$file_type = $_FILES["file"]["type"];
$hash= md5(uniqid(rand(), true));
$image_types = Array ("image/gif", "image/png");
switch($_FILES["file"]["type"])
{
case 'image/gif':
$file = $hash.".gif";
break;
case 'image/png':
$file = $hash.".png";
break;
}
@getimagesize($_FILES['file']['tmp_name'])
or
die($language["SMILE_IMGER2"]);

           if((isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) && (isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])))
            {
                $check_img = check_upload($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
                switch($check_img)
                {
                    case 1:
                    case 2:
                        $check_img_err = $language["ERR_MISSING_DATA"];
                        if(file_exists($_FILES["file"]["tmp_name"]))
                            @unlink($_FILES["file"]["tmp_name"]);
                        break;
                    case 3:
                        $check_img_err = $language["QUAR_TMP_FILE_MISS"];
                        break;
                    case 4:
                        $check_img_err = $language["QUAR_OUTPUT"];
                        break;
                    case 5:
                    default:
                        $check_img_err = "";
                        break;
                }
                if($check_img_err != "")
                    stderr($language["ERROR"], $check_img_err);
            }


$path = $imgpath.$file;

if (in_array (strtolower ($file_type), $image_types, TRUE))
{
move_uploaded_file($_FILES['file']['tmp_name'], "$path");
}
quickQuery("INSERT INTO {$TABLE_PREFIX}smilies (`key`,`value`) VALUES ('$tag','$file')",true);
success_msg($language["SUCCESS"],"".$language["ADDED"]."! <br /><a href='javascript:history.back()'>".$language["BACK"]."</a>");
}else
{
stderr($language["ERROR"],$language["SMILE_MISS"]);
}
break;
case'':
default;     
$count=get_result("SELECT COUNT(*) AS LIST FROM {$TABLE_PREFIX}smilies",true);
   $countnum=$count[0]["LIST"];
    $perpage=(max(0,$CURUSER["postsperpage"])>0?$CURUSER["postsperpage"]:20);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $countnum, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smilies&amp;");
    
    
    $admintpl->set("pager_top",$pagertop);
    $admintpl->set("pager_bottom",$pagerbottom);
    
    $smiles=get_result("SELECT `key`,`value` FROM {$TABLE_PREFIX}smilies ORDER BY `key` DESC $limit",true);
    $smilies=array();
    $i=0;
    if ($smiles[0]>0)
    {
    foreach ($smiles as $key=>$value)
    {
    $smilies[$i]['code']=$value['key'];
    $smilies[$i]['url']=$value['value'];
    $i++;
    }
    }
$admintpl->set("import",(($countnum==0)?true:false), true);
$admintpl->set("smile",$smilies);
$admintpl->set("frm","index.php?page=admin&user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smilies&amp;action=upload_new");
$admintpl->set("del","index.php?page=admin&user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smilies&amp;action=delete");
$admintpl->set("edt","index.php?page=admin&user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smilies&amp;action=edit");
break;
}
$admintpl->set("language",$language);
$admintpl->set("in_edit", (($action=="edit")?true:false), true);
?>