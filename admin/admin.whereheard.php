<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");

require_once("include/functions.php");
require_once("include/config.php");

dbconn();

$getbanned = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE whereheard!='' ORDER BY joined ASC") or die(mysql_error());
$row= @sql_num_rows($getbanned);

    $log=array();
    $i=0;

$admintpl->set("language",$language);

         if (sql_num_rows($getbanned)==0)
{
    $log[$i]["where"]=("<center><font color=green>nothing</font></center>");
    $log[$i]["date"]=("<center><font color=green>here</font></center>");
    $log[$i]["username"]=("<center><font color=green>yet</font></center>");
    $i++;
}
         else
             {
                 while ($arr=$getbanned->fetch_assoc());
                 {
$rest=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id_level= ".$arr[id_level]) or sqlerr();
$row3=$rest->fetch_array();
               
        $log[$i]["username"]="<a href=\"index.php?page=userdetails&id=".$arr[id]."\">".$row3[prefixcolor].$arr[username].$row3[suffixcolor]."</a>";
        $log[$i]["where"]=$arr['whereheard'];
        $log[$i]["date"]=$arr['joined'];
        $i++;

}
}

 $admintpl->set("heardlog",$log);

?>