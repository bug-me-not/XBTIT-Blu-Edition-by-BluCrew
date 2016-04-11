<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



(isset($_GET["stage"]) && is_numeric($_GET["stage"]) && $_GET["stage"]>=1) ? $stage=(int)0+$_GET["stage"] : $stage=1;

$newstage=$stage+1;

$replaces = array("{fmprefix}" => $TABLE_PREFIX);

$sqlfile=$THIS_BASEPATH."/sql/ip2country_{$stage}.sql";

if($stage==1)
    do_sqlquery("TRUNCATE {$TABLE_PREFIX}ip2country", true);

if(file_exists($sqlfile))
{
    $handle = fopen($sqlfile, "r");
    $contents = "";
    while (!feof($handle))
    {
        $contents .= str_replace(array("\r", "\n"), array("", ""), fread($handle, 8192));
    }
    fclose($handle);

    $queries=explode(";", $contents);
    foreach($queries as $v)
    {
        if(substr($v,0,6)=="INSERT")
            do_sqlquery(str_replace("{fm_prefix}", $TABLE_PREFIX, $v), true);
    }
    if($newstage<=7)
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ip2c_import&stage=".$newstage);
    else
        success_msg($language["SUCCESS"],$language["IP2C_DB_IMP1"]. " <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hacks&action=read'>".$language["IP2C_DB_IMP2"]."</a>");
}

?>