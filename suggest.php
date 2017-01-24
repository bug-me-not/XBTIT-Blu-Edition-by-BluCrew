<?php
/////////////////////////////////////////////////////////
//
//	Auto Suggest On Torrent and User Search
//
//	Created for xbtitFM v1.1 by BluCrew
//
///////////////////////////////////////////////////////// 
require_once('include/functions.php');
dbconn(false);
global $TABLE_PREFIX, $CURUSER;

if(!$CURUSER || $CURUSER['uid']==1)
{
 redirect("index.php");
}

$type = $_GET["a"];
if (strlen($_GET['q']) > 3) 
{
	$q = str_replace(" ",".",sqlesc("%".$_GET['q']."%"));
	$q2 = str_replace("."," ",sqlesc("%".$_GET['q']."%"));
	if ($type == "user")
	{
		$result = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE username LIKE {$q} OR username LIKE {$q2} ORDER BY username ASC LIMIT 0,30;");
		$search = "username";
	}
	elseif ($type == "torrent")
	{
		$result = do_sqlquery("SELECT filename FROM {$TABLE_PREFIX}files WHERE filename LIKE {$q} OR filename LIKE {$q2} ORDER BY filename ASC LIMIT 0,30;");
		$search = "filename";
	}
	if (!empty($result))
	{
		if (sql_num_rows($result) > 0) 
		{
			/*for ($i = 0; $i < sql_num_rows($result); $i++) 
			{
				$name_res = $result->fetch_assoc();
				$name = $name_res[$i][$username];
				$name = trim(str_replace("\t","",$name));
				print("".$name."");
				if ($i != sql_num_rows($result)-1) {
					print "\r\n";
				}
			}*/
			while($name_res=$result->fetch_assoc())
			{
				$name = $name_res[$search];
				$name = trim(str_replace("\t","",$name));
				print("".$name."\r\n");
			}
		}
	}
}
?>