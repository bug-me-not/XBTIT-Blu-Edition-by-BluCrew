<?php

error_reporting(0);

if (!defined("IN_BTIT"))
    die("non direct access!");


global $btit_settings, $BASEURL;

$listennowtpl=new bTemplate();

require(load_language("lang_userdetails.php"));
include("./radiostats/shoutcast.class.php");

$listen = new ShoutCast();
$listen->host = $btit_settings["radio_ip"];
$listen->port = $btit_settings["radio_port"];
$listen->passwd = $btit_settings["radio_pass"];

if ($listen->openstats())
{
    // We got the XML, gogogo!..
    if ($listen->GetStreamStatus())
    {
        require(load_language("lang_shoutcast.php"));

        $hostname=$listen->GetListeners();

        $j=0;
        $list=array();

        if (is_array($hostname))
        {
            for ($i=0;$i<sizeof($hostname);$i++)
            {
                $ip=$hostname[$i]["hostname"];
                $client=$hostname[$i]["useragent"];
                $damn=do_sqlquery ("SELECT `u`.`id`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`cip`='".$ip."' ORDER BY `u`.`lastconnect` DESC LIMIT 1",true);

                if(@sql_num_rows($damn)>0)
                    $gimme=$damn->fetch_array();
                else
                {
                    $gimme["id"]=1;
                    $gimme["username"]="Guest";
                    $gimme["prefixcolor"]="";
                    $gimme["suffixcolor"]="";
                }
                if(strtolower(substr($client, 0, 8))=="nsplayer")
                    $client="<img src='".$BASEURL."/radiostats/images/mp.png' width='32' height='32' border='0' alt='Windows Media Player' title='Windows Media Player'>";
                elseif(strtolower(substr($client, 0, 9))=="quicktime")
                    $client="<img src='".$BASEURL."/radiostats/images/qt.png' width='32' height='32' border='0' alt='QuickTime' title='QuickTime'>";
                elseif(strtolower(substr($client, 0, 3))=="rma")
                   $client="<img src='".$BASEURL."/radiostats/images/rp.png' width='32' height='32' border='0' alt='RealPlayer' title='RealPlayer'>";
                elseif(strtolower(substr($client, 0, 6))=="winamp")
                    $client="<img src='".$BASEURL."/radiostats/images/winamp.png' width='32' height='32' border='0' alt='Winamp' title='Winamp'>";
                elseif(strtolower(substr($client, 0, 3))=="vlc")
                    $client="<img src='".$BASEURL."/radiostats/images/vlc.png' width='32' height='32' border='0' alt='VLC Media Player' title='VLC Media Player'>";
                elseif(strtolower(substr($client, 0, 6))=="itunes")
                    $client="<img src='".$BASEURL."/radiostats/images/itunes.gif' width='32' height='32' border='0' alt='iTunes' title='iTunes'>";
                elseif(strtolower(substr($client, 0, 6))=="xmplay")
                    $client="<img src='".$BASEURL."/radiostats/images/xmplay.png' width='32' height='32' border='0' alt='XMPlay' title='XMPlay'>";
                elseif(strtolower(substr($client, 0, 8))=="bsplayer")
                    $client="<img src='".$BASEURL."/radiostats/images/bsplayer.png' width='32' height='32' border='0' alt='BSPlayer' title='BSPlayer'>";
                elseif(strtolower(substr($client, 0, 8))=="kmplayer")
                    $client="<img src='".$BASEURL."/radiostats/images/kmplayer.png' width='32' height='32' border='0' alt='KMPlayer' title='KMPlayer'>";
                elseif(strtolower(substr($client, 0, 8))=="screamer")
                    $client="<img src='".$BASEURL."/radiostats/images/screamer.png' width='32' height='32' border='0' alt='Screamer Radio' title='Screamer Radio'>";

                $hanger=true;
                $list[$j]["id"]=sqlesc((int)$gimme["id"]);
                $list[$j]["username"]=unesc($gimme["prefixcolor"].$gimme["username"].$gimme["suffixcolor"]);
                $list[$j]["client"]=unesc($client);
                $j++;
            }
        }
        else
        {
            $hanger=false;
            $nothing=stderr($language["ERROR"],$language["NOPLAYER"]);
            $listennowtpl->set("nothing",$nothing);
        }
    }
    else
    {
        $hanger=false;
        $ohdamn=stderr($language["ERROR"],$language["NOSHOUTCAST"]);
        $listennowtpl->set("ohdamn",$ohdamn);
    }
}
else
{
    $hanger=false;
    $ohbeep=stderr($language["ERROR"],"<center>".$language["NOSHOUTCASTCONN"]."<br/>".$listen->geterror()."</center>");
    $listennowtpl->set("ohbeep",$ohbeep);
}
$listennowtpl-> set("hanger", (($hanger)?TRUE:FALSE), TRUE);
$listennowtpl->set("list",$list);
$listennowtpl->set("language",$language);

?>
