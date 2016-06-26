<?php
//////////////////////////////////////////////////////
// BON Pool for xbtit by Gaart
// Index Page
// Database entries:
// 	pool: id, uid, date, amount, poolid
// 	pool_settings: id, start, end, pot, complete
// CSS: pwrapper, pheader, prow, pcell, pspan
//////////////////////////////////////////////////////
ob_start();

if (!defined("IN_BTIT"))
      die("non direct access!");

if ($CURUSER['id_level'] <= 1)
{
	stderr('Error','You do not have permission to access BON pool');
	die();
}

//fmhack_bon_pool
if($btit_settings['fmhack_bon_pool']=='enabled'){

//Functions
function pinfo($resource,$col,$key)
{
	$result = 0;

	$res = $resource;
	$selector = $col;

	if($key == true) // Retrieving Figures from DB
	{
		if(sql_num_rows($res) > 0)
		{
			$resu = $res->fetch_array() or sqlerr();
			$result = $resu[$selector];

			if(is_numeric($result))
			{
				$result = ($result + 0);
			}

		}
		else
		{
			$result = "The requested figures are currently not available.";
		}
	}
	elseif($key == false) // Retrieving text from DB
	{
		if(sql_num_rows($res) > 0)
		{
			$rows = array();

			while($row = $res->fetch_array())
			{
				$rows[] = $row;
			}

			$result = utable($rows);
		}
		else
		{
			$result = "<div align='center'>No donations have been made towards this pool.</div>";
		}
	}

	return $result; //Returns a value, preferable int
}



//div's for pool tables
//#pwrapper{
//	width: 550px;
//	margin: 0 auto;
//}
//
//.pheader {
//	text-decoration: underline;
//	font-weight: bold;
//}
//
//.prow {
//}
//
//.pcell {
//	width: 125px;
//	float: left;
//	border: 1px solid;
//	padding: 5px;
//}
//Div for main index
//#pspan{
//	font-size: 22px;
//	color: red;
//}

function utable($ures)
{
	$out = "";
	$num = 0;

	$out.= "<div id='pwrapper'>";
		$out.= "<div class='pheader'>";
			$out.= "<div class='pcell'>Rank</div>";
			$out.= "<div class='pcell'>User</div>";
			$out.= "<div class='pcell'>Amount</div>";
			$out.= "<div class='pcell'>Last Donated</div>";
		$out.= "</div>";
		$out.= "<div class='clear'></div>";

	foreach($ures as $id=>$f)
	{
		$num++;

		$rlink = "<a href=\"index.php?page=userdetails&amp;id=" . $f["uid"] . "\"><b>".stripslashes($f["prefixcolor"]) . $f["username"] .stripslashes($f["suffixcolor"])."</b></a>";

		$out.= "<div class='prow'>";
			$out.= "<div class='pcell'>".$num."</div>";
			$out.= "<div class='pcell'>".$rlink."</div>";
			$out.= "<div class='pcell'>". number_format($f['total']) ."</div>";
			$out.= "<div class='pcell'>".$f['datt']."</div>";
		$out.= "</div>";
		$out.= "<div class='clear'></div>";
	}

	$out.= "</div>";

	return $out;
}

function scheck($var)
{
	if(is_numeric($var))
	{
		if(preg_match('/^\d+\.?\d{1,}$/',$var))
		{
			return true;
		}
		else
		{
			stderr('Error','Kindly enter numbers only.');
			die();
		}
	}
	else
	{
		stderr('Error','Kindly enter numeric values only.');
		die();
	}
}


//Get and Post checks
if($_GET["opt"] == "send")
{
	$value = $_POST["amount"];
	$usid = $CURUSER['uid'];
	$vbonus = $CURUSER["seedbonus"];

	$plstat = do_sqlquery("SELECT `id` FROM {$TABLE_PREFIX}pool_settings WHERE complete=false LIMIT 1");

	$plid = pinfo($plstat,"id",true);

	$bcheck = scheck($value);

	$value = round($value,2);
	$vbonus = round($vbonus,2);

	if($bcheck && ($vbonus >= $value))
	{
		quickQuery("INSERT INTO {$TABLE_PREFIX}pool (`uid`,`date`,`amount`,`poolid`) VALUES ($usid,NOW(),$value,$plid)");

		if(sql_affected_rows() > 0)
		{
			quickQuery("UPDATE {$TABLE_PREFIX}users SET Seedbonus = Seedbonus - $value WHERE id = $usid");

			if(sql_affected_rows() > 0)
			{
				$vcomplete = do_sqlquery("SELECT SUM(l.amount) as figure, s.pot FROM {$TABLE_PREFIX}pool l LEFT JOIN {$TABLE_PREFIX}pool_settings s ON l.poolid=s.id WHERE s.complete = false AND s.id = $plid");
				$vfigure = pinfo($vcomplete,"figure",true);

				$vcomplete1 = do_sqlquery("SELECT SUM(l.amount) as figure, s.pot FROM {$TABLE_PREFIX}pool l LEFT JOIN {$TABLE_PREFIX}pool_settings s ON l.poolid=s.id WHERE s.complete = false AND s.id = $plid");
				$vpot = pinfo($vcomplete1,"pot",true);

				//Add to shout
				$usern = $CURUSER['username'];

				system_shout("A contribution has been made towards the Freeleech pool to the value of {$value} BON by [url=$BASEURL/index.php?page=userdetails&id=$usid][b]{$usern}[/b][/url]. To view click [url=$BASEURL/index.php?page=modules&module=pool]HERE[/url]");
				if($vfigure >= $vpot)
				{
					//Finishing Sequence.
					quickQuery("UPDATE {$TABLE_PREFIX}pool_settings SET complete = 1, end = NOW() WHERE id = $plid");
					quickQuery("INSERT INTO {$TABLE_PREFIX}pool_settings (`start`,`pot`,`complete`) VALUES (NOW(),5000000,0)");

					//Enable freeleech for 36hrs
					require_once("$THIS_BASEPATH/include/sanity.php");
					$DT1 = date("Y-m-d H:i:s",time()+129600);
					quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `free_expire_date`='".$DT1."',`free`='yes',`happy_hour`='no' WHERE `external`='no'", true);
					do_sqlquery("ALTER TABLE `{$TABLE_PREFIX}files` CHANGE `free` `free` ENUM( 'yes', 'no' ) NULL DEFAULT 'yes'") or sqlerr();

					$now1 = time();
					$res = do_sqlquery("SELECT last_time FROM {$TABLE_PREFIX}tasks WHERE task='sanity'");
					$row = $res->fetch_row();
					if (!$row)
						quickQuery("INSERT INTO {$TABLE_PREFIX}tasks (task, last_time) VALUES ('sanity',$now1)");
					else
					{
						$ts = $row[0];
						quickQuery("UPDATE {$TABLE_PREFIX}tasks SET last_time=$now1 WHERE task='sanity' AND last_time = $ts");
					}
					do_sanity($ts);
					//End freeleech

					//Checking difference and crediting user the difference above pot.
					$vdifference = $vfigure-$vpot;

					if($vdifference > 0 )
					{
						quickQuery("UPDATE {$TABLE_PREFIX}users SET Seedbonus = Seedbonus + $vdifference WHERE id = $usid");
						if(sql_affected_rows() > 0)
						{
							redirect("index.php?page=modules&module=pool");
						}
						else
						{
							stderr("Error","There seems to be an issue re-allocating your Seedbonus, Kindly contact staff.");
							die();
						}
					}
				}
				else
				{
					redirect("index.php?page=modules&module=pool");
				}
			}
			else
			{
				stderr("Error","There seems to be an issue allocating your Seedbonus, Kindly contact staff.");
				die();
			}
		}
		else
		{
			stderr("Error","There seems to be an issue allocating your Seedbonus, Kindly contact staff.");
			die();
		}
	}
	else
	{
		stderr('Error',"It seems you do not have enough BON, donate less or return later when you have more to share");
		die();
	}
}
elseif($_GET["opt"] == "admin")
{
	$pastatid = do_sqlquery("SELECT `id` FROM {$TABLE_PREFIX}pool_settings WHERE complete = false");
	$pastatstart = do_sqlquery("SELECT `start` FROM {$TABLE_PREFIX}pool_settings WHERE complete = false");
	$pastatpot = do_sqlquery("SELECT `pot` FROM {$TABLE_PREFIX}pool_settings WHERE complete = false");

	$paid = pinfo($pastatid,"id",true);
	$pastart = pinfo($pastatstart,"start",true);
	$papot = pinfo($pastatpot,"pot",true);

	print "<div align='center'>Current Pool id: " . $paid . "</div></br>
	<div align='center'>This pool started: " . $pastart . "</div></br>
	<div align='center'>Pot is set at: " . number_format($papot) . "</div>";

	print "<br/><br/><br/>";

	print "<div class='paform'><form action=\"index.php?page=modules&module=pool&opt=change\" method=\"post\">
		Enter new amount for BON pot: &nbsp;&nbsp;&nbsp;
		<input type = \"text\" name = \"npot\" > &nbsp;&nbsp;&nbsp;
		<input type = \"submit\">
		</form></div>";

	print "<br/><br/><br/>";
	print "<div class='paback'><a href=\"index.php?page=modules&module=pool\">Back</a></div>";
}
elseif($_GET["opt"] == "change")
{
	$npot = $_POST["npot"];

	$pastat = do_sqlquery("SELECT id FROM {$TABLE_PREFIX}pool_settings WHERE complete = false");

	$paid = pinfo($pastat,"id",true);
	$pcheck = scheck($npot);

	if($pcheck)
	{
		quickQuery("UPDATE {$TABLE_PREFIX}pool_settings SET pot = $npot WHERE id = $paid") or stderr("Error",sql_error());

		redirect("index.php?page=modules&module=pool");
	}
	else
	{
		redirect("index.php?page=modules&module=pool");
	}
}
else
{
//Setting user and pool Variables

$udonated = 0; //Amount the user donated in total
$usdonated = 0; //Amount the user donated to current pot
$tdonated = 0; //Amount collected in total towards this current pot
$pot = 0; //Total amount to be collected for current pot
$free = null; //Whether freeleach is active or not
$show = false; //Trigger, to determine whether free leech is active or not && whether to display table or not

//Retrieving data
$udstat = do_sqlquery("SELECT SUM(`amount`) as `totals` FROM {$TABLE_PREFIX}pool WHERE uid=". $CURUSER['uid'] ." LIMIT 1");
$udonated = pinfo($udstat,"totals",true);

$usstat = do_sqlquery("SELECT SUM(`amount`) as `total` FROM {$TABLE_PREFIX}pool l LEFT JOIN {$TABLE_PREFIX}pool_settings s ON l.poolid=s.id WHERE s.complete=false AND l.uid=" . $CURUSER['uid'] . " LIMIT 1");
$usdonated = pinfo($usstat,"total",true);

$tdstat = do_sqlquery("SELECT SUM(`amount`) as `total` FROM `{$TABLE_PREFIX}pool` `l` LEFT JOIN `{$TABLE_PREFIX}pool_settings` `s` ON `l`.`poolid`=`s`.`id` WHERE `s`.`complete`=false LIMIT 1");
$tdonated = pinfo($tdstat,"total",true);

$pstat = do_sqlquery("SELECT `pot` FROM {$TABLE_PREFIX}pool_settings WHERE complete=false");
$pot = pinfo($pstat,"pot",true);

$freestat = do_sqlquery("SELECT free FROM {$TABLE_PREFIX}files WHERE external='no'");
$free = pinfo($freestat,"free",true);

//Display user and pool figures

if($CURUSER["id_level"] >= 6)
{
	print "<br/><br/><br/>";
	print "<div class='padmin' align='center'><a href=\"index.php?page=modules&module=pool&opt=admin\">Pool Admin</a></div>";
}

print "<br/><br/><br/>
<div align='center'>You have donated ". number_format($udonated) ." in total.</div><br/>";

if($free == "no")
{
	print "<br/><div align='center'>You have donated " . number_format($usdonated). " towards the current pot.</div><br/>
		<div align='center'>The current pool stands at ". number_format($tdonated) ." out of ". number_format($pot) .".</div>";
}

print "<br/><br/><br/>";
//Donation form
if($CURUSER["seedbonus"] > 0)
{
	if($free == "no")
	{
		$show = true;

		print "<center><form action=\"index.php?page=modules&module=pool&opt=send\" method=\"post\">
			<input type = \"text\" name = \"amount\"> &nbsp;&nbsp;&nbsp;
			<input type = \"submit\" value='Contribute!'>
			</form></center>";
	}
	else
	{
	print "<div class='alert alert-dismissable alert-bg-white alert-danger'>
	<button data-dismiss='alert' class='close' type='button'>×</button>
	<div class='icon'><i class='fa fa-star'></i></div>
	<strong>Free leech is currently in place, please come back once it expires.</strong>
	</div>
	</div>";
	}
}
else
{
	print "<span id='pspan'><b>It would seem you have insufficient funds in your account, Kindly recharge and return again soon.</b></span>";
}

print "<br/><br/><br/>";

//Display table ranking user contribution to current pot
if($show)
{
	print "<div align='center' class='pheader'>Top 5 User Donations to current pot</div>
		<br/>";
	$topstat = do_sqlquery("SELECT l.uid, SUM(l.amount) as total, MAX(l.date) as datt, u.username,
	(SELECT e.suffixcolor FROM {$TABLE_PREFIX}users_level e WHERE u.id_level = e.id LIMIT 1) as suffixcolor,
	(SELECT e.prefixcolor FROM {$TABLE_PREFIX}users_level e WHERE u.id_level = e.id LIMIT 1) as prefixcolor
	FROM {$TABLE_PREFIX}pool l
	LEFT JOIN {$TABLE_PREFIX}pool_settings s ON l.poolid = s.id
	LEFT JOIN {$TABLE_PREFIX}users u ON l.uid = u.id
	WHERE s.complete=false
	GROUP BY l.uid
	ORDER BY total DESC
	LIMIT 5");

	print pinfo($topstat,"",false);
}

print "<br/><br/>";

//Display table ranking total contribution per user
print "<div align='center' class='pheader'>Top 10 Contributions to Pool</div>
	<br/>";
$contstat = do_sqlquery("SELECT l.uid, SUM(l.amount) as total, MAX(l.date) as datt, u.username,
(SELECT e.suffixcolor FROM {$TABLE_PREFIX}users_level e WHERE u.id_level = e.id LIMIT 1) as suffixcolor,
(SELECT e.prefixcolor FROM {$TABLE_PREFIX}users_level e WHERE u.id_level = e.id LIMIT 1) as prefixcolor
FROM {$TABLE_PREFIX}pool l
LEFT JOIN {$TABLE_PREFIX}pool_settings s ON l.poolid = s.id
LEFT JOIN {$TABLE_PREFIX}users u ON l.uid = u.id
GROUP BY l.uid
ORDER BY total DESC
LIMIT 10");
print pinfo($contstat,"",false);
}

//Footer
print "<br/><br/><br/>
	<div align='center'>Designed exclusively for Blu-torrents</div>";
}else{
   stderr('Error','BON Pool is currently disabled.');
   die();
}
global $module_out;
$module_out=ob_get_contents();
ob_end_clean();
?>
