<?php
include("shoutcast.class.php");
require("../include/functions.php");
dbconn(true);

global $btit_settings, $BASEURL, $TABLE_PREFIX;

$active_seo = get_result("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
$res_seo=$active_seo[0];

// get user's style
$resheet=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]."");
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
}
else
    {
        $resstyle=$resheet->fetch_array();
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
}

$style_css=load_css("main.css");


function ConvertSeconds($seconds) {
	$tmpseconds = substr("00".$seconds % 60, -2);
	if ($seconds > 59) {
		if ($seconds > 3599) {
			$tmphours = substr("0".intval($seconds / 3600), -2);
			$tmpminutes = substr("0".intval($seconds / 60 - (60 * $tmphours)), -2);
			
			return ($tmphours.":".$tmpminutes.":".$tmpseconds);
		} else {
			return ("00:".substr("0".intval($seconds / 60), -2).":".$tmpseconds);
		}
	} else {
		return ("00:00:".$tmpseconds);
	}
}



$shoutcast = new ShoutCast();
$shoutcast->host = $btit_settings["radio_ip"];
$shoutcast->port = $btit_settings["radio_port"];
$shoutcast->passwd = $btit_settings["radio_pass"];


if ($shoutcast->openstats()) {
	// We got the XML, gogogo!..
	if ($shoutcast->GetStreamStatus()) {
	
require("../".load_language("lang_shoutcast.php"));


echo"<link rel=\"stylesheet\" type=\"text/css\" href=".$STYLEURL."/main.css\" />";





	
		echo"<table width=100% cellpadding=3 cellspacing=0><tr><td class=blocklist>";
		
        echo "<br><center><img src='radiostats/images/radio-online.png'></center><br><br>";
		echo "<table border=0 cellpadding=0 cellspacing=0 align=center class=main>";
		$todayis = date ('D');
		$timenow = date ('G:i');
      $Query = do_sqlquery ('SELECT u.id as realid, sc.uid, sc.activedays, sc.activetime, sc.genre, u.username, g.prefixcolor, g.suffixcolor FROM '.$TABLE_PREFIX.'shoutcastdj sc LEFT JOIN '.$TABLE_PREFIX.'users u ON sc.uid=u.id LEFT JOIN '.$TABLE_PREFIX.'users_level g ON u.id_level=g.id WHERE sc.active = \'1\' ORDER by activetime') OR die ();
      if (sql_num_rows($Query)>0)
      {
          $found=0;
          while($List=$Query->fetch_assoc())
          {
              if (preg_match ('@' . $todayis . '@Ui', $List['activedays']))
              {
                  $timeslot=explode("-",$List["activetime"]);
                  $start_time=explode(":",$timeslot[0]);
                  $end_time=explode(":",$timeslot[1]);

                  $start_timestamp=mktime($start_time[0],$start_time[1],0);
                  $end_timestamp=mktime((int)$end_time[0],(int)$end_time[1],0);
                  if(time()>=$start_timestamp && time()<=$end_timestamp)
                  {
                      $found=1;
                      echo "<tr><td class=header><b>".$language['BL_DJ'].":</b></td><td class=lista>&nbsp;<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$List["realid"]."_".strtr($List["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$List["realid"])."'><b>".unesc($List["prefixcolor"]).$List["username"].unesc($List["suffixcolor"])."</b></a></td></tr>";
                  }
		      }
		  }
		  if($found==0)
		  {
              $djname=sqlesc($shoutcast->GetServerTitle());

              $petr1=do_sqlquery("SELECT `u`.`id`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`username`='".$djname."'");
              if(@sql_num_rows($petr1)>0)
              {
                  $fied=$petr1->fetch_assoc();
                  $djname="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$fied["id"]."_".strtr($djname, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$fied["id"])."'>".unesc($fied["prefixcolor"] . $djname . $fied["suffixcolor"])."</a>";
              }
              else
                  $djname=unesc($djname);
		 
              echo "<tr><td class=header><b>".$language['BL_DJ'].":</b></td><td class=lista>&nbsp;<b>".$djname."</b></td></tr>";
          }
      }
      else
      {
          $djname=sqlesc($shoutcast->GetServerTitle());

          $petr1=do_sqlquery("SELECT `u`.`id`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`username`='".$djname."'");
          if(@sql_num_rows($petr1)>0)
          {
              $fied=$petr1->fetch_assoc();
              $djname="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$fied["id"]."_".strtr($djname, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$fied["id"])."'>".unesc($fied["prefixcolor"] . $djname . $fied["suffixcolor"])."</a>";
          }
          else
              $djname=unesc($djname);
		 
          echo "<tr><td class=header><b>".$language['BL_DJ'].":</b></td><td class=lista>&nbsp;<b>".$djname."</b></td></tr>";
      }
		
		echo "<tr><td class=header><b>".$language['BL_LISTEN'].":</b></td><td class=lista>&nbsp;<br><b><a href='index.php?page=listeners'> (".$shoutcast->GetCurrentListenersCount()." of ".$shoutcast->GetMaxListenersCount()." listeners, peak: ".$shoutcast->GetPeakListenersCount().")</a><p></b></td></tr>";
		echo "<tr><td class=header><b>".$language['BL_SONG'].":</b></td><td class=lista>&nbsp;<b>".cut_string($shoutcast->GetCurrentSongTitle(),intval(50))."</b></td></tr>\n";
		
echo "<tr><td class=header><br><b>".$language['BL_BRATE'].": </b></td><td class=lista><br><b>".$shoutcast->GetBitRate()." kbps&nbsp;<iframe src=\"".$BASEURL."/radioon.php\" width=\"0\" height=\"0\"></iframe></b></td></tr><tr><td colspan=2>&nbsp;</td></tr>";


		
		

		echo "</table><br><table border=0 cellpadding=0 cellspacing=0 align=center class=main><tr><td class=header>";
		
		echo "<center><b>".$language['BL_HIST'].":</b></center>\n";
		$history = $shoutcast->GetSongHistory();
		echo"<textarea rows=3 cols=40 class=frm>";
		if (is_array($history)) {
			for ($i=0;$i<sizeof($history);$i++) {
			    
				echo "[".get_date_time($history[$i]["playedat"])."] - ".$history[$i]["title"]."\n";
				
				
			}
			echo"</textarea></td></tr></table><br />";

echo'<center><a href="http://'.$btit_settings["radio_ip"].':'.$btit_settings["radio_port"].'/listen.pls" target="_new"><img src='.$BASEURL.'/radiostats/images/winamp.png width="48" height="48" title="Winamp" border="0"></a>&nbsp;<a href="javascript:PopRadio(\'mp\');"><img src='.$BASEURL.'/radiostats/images/mp.png width="48" height="48" title="WMP" border="0"></a>&nbsp;<a href="javascript:PopRadio(\'rp\');"><img src='.$BASEURL.'/radiostats/images/rp.png width="48" height="48" title="RealPlayer" border="0"></a>&nbsp;<a href="javascript:PopRadio(\'qt\');"><img src='.$BASEURL.'/radiostats/images/qt.png width="48" height="48" title="QuickTime" border="0"></a></center>';
echo'</td></tr></table>';           

		} else {
		require("../".load_language("lang_shoutcast.php"));
			echo $language['BL_HIST_NO'];
		}
		//echo "<p>";
		
		
	} else {
	require("../".load_language("lang_shoutcast.php"));
		echo "<table width=100% cellpadding=3 cellspacing=0><tr><td class=blocklist><center><br><img src=".$BASEURL."/radiostats/images/radio-offline.png><br><br><br><font size=3><b>".$language['BL_NOSOURC']."<iframe src=\"".$BASEURL."/radiooff.php\" width=\"0\" height=\"0\"></iframe>&nbsp;<a href=index.php?page=dj&do=request>".$language['BL_APP']."</a></b></font><br><br>
		</td></tr></table>";
	}
} else {
	// Ohhh, damnit..
	echo $shoutcast->geterror();
}
?>