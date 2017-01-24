<?php
if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");

$_JOB=isset($_GET["area"])?htmlspecialchars($_GET["area"]):$_JOB='';

switch($_JOB)
{
case'update':
if(isset($_POST) && !empty($_POST) && $_SERVER["REQUEST_METHOD"]=="POST")
{
$adid=isset($_GET["editid"]) && is_numeric($_GET["editid"])?intval(0+$_GET["editid"]):$adid='';
$newdata=isset($_POST["content"])?$_POST["content"]:$newdata='';
switch($adid)
{
case '1':
$content="header";
break;
case '2':
$content="left_top";
break;
case '3':
$content="left_bottom";
break;
case '4':
$content="right_top";
break;
case '5':
$content="right_bottom";
break;
case '6':
$content="footer";
break;
case '7':
$content="above_comments";
break;
case '':
stderr($language["ERROR"],$language["BAD_ID"]);
break;
}
if(!empty($newdata) && !empty($content))
$newdata=sqlesc($newdata);
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$newdata}' WHERE `key`='{$content}'",true);
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
$admintpl->set("content2", "Updated with Success!");
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ads_setup");
}
break;
case'status':
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$header_enabled=(isset($_POST["header_enabled"]) && $_POST["header_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$header_enabled}' WHERE `key`='header_enabled'",true);
$left_top_enabled=(isset($_POST["left_top_enabled"]) && $_POST["left_top_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$left_top_enabled}' WHERE `key`='left_top_enabled'",true);
$left_bottom_enabled=(isset($_POST["left_bottom_enabled"]) && $_POST["left_bottom_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$left_bottom_enabled}' WHERE `key`='left_bottom_enabled'",true);
$right_bottom_enabled=(isset($_POST["right_bottom_enabled"]) && $_POST["right_bottom_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$right_bottom_enabled}' WHERE `key`='right_bottom_enabled'",true);
$right_top_enabled=(isset($_POST["right_top_enabled"]) && $_POST["right_top_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$right_top_enabled}' WHERE `key`='right_top_enabled'",true);
$footer_enabled=(isset($_POST["footer_enabled"]) && $_POST["footer_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$footer_enabled}' WHERE `key`='footer_enabled'",true);
$footer_enabled=(isset($_POST["footer_enabled"]) && $_POST["footer_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$footer_enabled}' WHERE `key`='footer_enabled'",true);
$above_comments_enabled=(isset($_POST["above_comments_enabled"]) && $_POST["above_comments_enabled"]=="on"?"enabled":"disabled");
quickQuery("UPDATE `{$TABLE_PREFIX}ads` SET `value`='{$above_comments_enabled}' WHERE `key`='above_comments_enabled'",true);
$settings["ad_groups"]=implode(",",$_POST["lev_groups"]);

	foreach($settings as $key=>$value)
          {
              if (is_bool($value))
               $value==true ? $value='true' : $value='false';

            $values[]="(".sqlesc($key).",".sqlesc($value).")";
        }
		$Match = "ad_groups";
        quickQuery("DELETE FROM {$TABLE_PREFIX}settings WHERE `key` LIKE '%".$Match."%'",true);
        quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";",true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ads_setup");
}
break;
case'preview':
$ad_list=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}ads");
switch($_REQUEST["input"])
{
case '1':
$content=$ad_list["header"];
break;
case '2':
$content=$ad_list["left_top"];
break;
case '3':
$content=$ad_list["left_bottom"];
break;
case '4':
$content=$ad_list["right_top"];
break;
case '5':
$content=$ad_list["right_bottom"];
break;
case '6':
$content=$ad_list["footer"];
break;
case '7':
$content=$ad_list["above_comments"];
break;
case '':
default;
stderr($language["ERROR"],$language["BAD_ID"]);
break;
}
$admintpl->set("content", $content);
break;
case'edit':
$ad_list=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}ads");
switch($_REQUEST["editid"])
{
case '1':
$content=$ad_list["header"];
break;
case '2':
$content=$ad_list["left_top"];
break;
case '3':
$content=$ad_list["left_bottom"];
break;
case '4':
$content=$ad_list["right_top"];
break;
case '5':
$content=$ad_list["right_bottom"];
break;
case '6':
$content=$ad_list["footer"];
break;
case '7':
$content=$ad_list["above_comments"];
break;
}
$admintpl->set("content", $content);
break;
case '':
default;
$ad_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}ads");
$admintpl->set("config", $ad_settings);
$admintpl->set("comments_above_en",($ad_settings["above_comments_enabled"]=="enabled"?"checked=checked":""));
$admintpl->set("footer_en",($ad_settings["footer_enabled"]=="enabled"?"checked=checked":""));
$admintpl->set("right_bottom_en",($ad_settings["right_bottom_enabled"]=="enabled"?"checked=checked":""));
$admintpl->set("right_top_en",($ad_settings["right_top_enabled"]=="enabled"?"checked=checked":""));
$admintpl->set("left_top_en",($ad_settings["left_top_enabled"]=="enabled"?"checked=checked":""));
$admintpl->set("left_bottom_en",($ad_settings["left_bottom_enabled"]=="enabled"?"checked=checked":""));
$admintpl->set("header_en",($ad_settings["header_enabled"]=="enabled"?"checked=checked":""));


$lev=get_result('SELECT * FROM '.$TABLE_PREFIX.'users_level ORDER BY id', true, $CACHE_DURATION);
$lev_checks='';
if (count($lev))
{

  $bl=0;
  $lev_checks.='<table><tr>';
  foreach($lev as $id => $levid)
    {

$list = explode(",", $btit_settings['ad_groups']);
$bl++;
    $lev_checks.='<td><input type="checkbox" name="lev_groups[]" '.(in_array($levid['id'],$list,true)?'checked="checked"':'').'value="'.$levid['id'].'" />&nbsp;'.$levid['level']."</td>\n";
    if ($bl % 8 == 0)
       $lev_checks.='</tr><tr>';
  }
  while ($bl % 8 !=0 )
  {
   $lev_checks.='<td>&nbsp;</td>';
   $bl++;
  }
  $lev_checks.='</tr></table><br />';
}
$admintpl->set("levlist", $lev_checks);
break;
}
$admintpl->set("lang", $language);
$admintpl->set("link", "index.php?page=admin&user={$CURUSER["uid"]}&code={$CURUSER["random"]}&do=ads_setup");
$admintpl->set("link2", "index.php?page=admin&user={$CURUSER["uid"]}&code={$CURUSER["random"]}&do=ads_setup");
$admintpl->set("you",$CURUSER["uid"]);
$admintpl->set("youcode",$CURUSER["random"]);
$admintpl->set("pre", (($_REQUEST["input"]>0)?TRUE:FALSE),TRUE);
$admintpl->set("whatid?",intval(0+$_REQUEST["editid"]));
$admintpl->set("pre2", (($_REQUEST["input"]==0)?TRUE:FALSE),TRUE);
$admintpl->set("pre3", (($_REQUEST["area"]=='edit')?TRUE:FALSE),TRUE);
$admintpl->set("pre4", (($_REQUEST["area"]!='edit')?TRUE:FALSE),TRUE);
$admintpl->set("pre5", (($_REQUEST["area"]=='update')?TRUE:FALSE),TRUE);
$admintpl->set("pre6", (($_REQUEST["area"]!='update')?TRUE:FALSE),TRUE);
?>