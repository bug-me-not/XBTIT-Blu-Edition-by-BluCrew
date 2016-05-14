<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

require(dirname(__FILE__).'/settings.php');

// cache interval for cfg read again (it's mysql based now, we don't want overload only for cfg read!)
$reload_cfg_interval=60;

function get_khez_config($qrystr, $cachetime=-1)
{
    $cache_file=realpath(dirname(__FILE__).'/..').'/cache/'.md5($qrystr).'.txt';

    if ($cachetime>0)
    {
        if (file_exists($cache_file) && (time()-$cachetime) < filemtime($cache_file))
            return unserialize(file_get_contents($cache_file));
    }

    $mr=do_sqlquery($qrystr) or die(sql_error());
    while ($mz=$mr->fetch_assoc()) 
    {
        if ($mz['value']=='true')
            $return[$mz['key']] = true;
        elseif ($mz['value']=='false')
            $return[$mz['key']] = false;
        elseif (is_numeric($mz["value"]))
            $return[$mz['key']] = max(0,$mz['value']);
        else
            $return[$mz['key']] = StripSlashes($mz['value']);
    }
    unset($mz);
    $mr->free();

    if ($cachetime>-1)
    {
        $fp=fopen($cache_file,'w');
        fputs($fp,serialize($return));
        fclose($fp);
    }
    return $return;
}


function get_cached_config($qrystr, $cachetime=0) 
{
  global $dbhost, $dbuser, $dbpass, $database, $num_queries, $cached_querys, $mySecret;
  $cache_file=realpath(dirname(__FILE__).'/..').'/cache/'.md5($qrystr." -- ".$mySecret).'.txt';
  $num_queries++;
  if ($cachetime>0)
    if (file_exists($cache_file) && (time()-$cachetime) < filemtime($cache_file)) 
    {
      $cached_querys++;
      return unserialize(file_get_contents($cache_file));
  }

  $configDB = new mysqli($dbhost, $dbuser, $dbpass,$database) or die($configDB->connect_error);

  $mr=$configDB->query($qrystr." -- ".$mySecret) or die($configDB->error);
  while ($mz=$mr->fetch_assoc()) {
    if ($mz['value']=='true')
      $return[$mz['key']]= true;
  elseif ($mz['value']=='false')
      $return[$mz['key']]= false;
  elseif (is_numeric($mz['value']))
      $return[$mz['key']]= max(0,$mz['value']);
  else
      $return[$mz['key']]= StripSlashes($mz['value']);
}

unset($mz);
$mr->free();
$configDB->close();

if ($cachetime>0) {
    $fp=fopen($cache_file,'w');
    fputs($fp,serialize($return));
    fclose($fp);
}
return $return;
}


// default settings
function apply_default_settings() 
{
    global $btit_settings;
    if (!array_key_exists('max_announce',$btit_settings)) $btit_settings['max_announce']=1800;
    if (!array_key_exists('min_announce',$btit_settings)) $btit_settings['min_announce']=300;
    if (!array_key_exists('max_peers_per_announce',$btit_settings)) $btit_settings['max_peers_per_announce']=50;
    if (!array_key_exists('dynamic',$btit_settings)) $btit_settings['dynamic']=false;
    if (!array_key_exists('nat',$btit_settings)) $btit_settings['nat']=false;
    if (!array_key_exists('persist',$btit_settings)) $btit_settings['persist']=false;
    if (!array_key_exists('allow_override_ip',$btit_settings)) $btit_settings['allow_override_ip']=false;
    if (!array_key_exists('countbyte',$btit_settings)) $btit_settings['countbyte']=true;
    if (!array_key_exists('peercaching',$btit_settings)) $btit_settings['peercaching']=true;
    if (!array_key_exists('maxpid_seeds',$btit_settings)) $btit_settings['maxpid_seeds']=3;
    if (!array_key_exists('maxpid_leech',$btit_settings)) $btit_settings['maxpid_leech']=2;
    if (!array_key_exists('name',$btit_settings)) $btit_settings['name']='BtiTracker Test Site';
    if (!array_key_exists('url',$btit_settings)) $btit_settings['url']='http://localhost';
    if (!array_key_exists('announce',$btit_settings)) $btit_settings['announce']=serialize(array('http://localhost/announce.php'));
    if (!array_key_exists('email',$btit_settings)) $btit_settings['email']='tracker@localhost';
    if (!array_key_exists('torrentdir',$btit_settings)) $btit_settings['torrentdir']='torrents';
    if (!array_key_exists('validation',$btit_settings)) $btit_settings['validation']='user';

    if (!array_key_exists('imagecode',$btit_settings)) $btit_settings['imagecode']=true;
    if (!array_key_exists('sanity_update',$btit_settings)) $btit_settings['sanity_update']=300;
    if (!array_key_exists('external_update',$btit_settings)) $btit_settings['external_update']=0;
    if (!array_key_exists('forum',$btit_settings)) $btit_settings['forum']='';
    if (!array_key_exists('external',$btit_settings)) $btit_settings['external']=true;
    if (!array_key_exists('gzip',$btit_settings)) $btit_settings['gzip']=true;
    if (!array_key_exists('debug',$btit_settings)) $btit_settings['debug']=true;
    if (!array_key_exists('disable_dht',$btit_settings)) $btit_settings['disable_dht']=false;
    if (!array_key_exists('livestat',$btit_settings)) $btit_settings['livestat']=true;
    if (!array_key_exists('logactive',$btit_settings)) $btit_settings['logactive']=true;
    if (!array_key_exists('loghistory',$btit_settings)) $btit_settings['loghistory']=false;

    if (!array_key_exists('default_language',$btit_settings)) $btit_settings['default_language']=1;
    if (!array_key_exists('default_charset',$btit_settings)) $btit_settings['default_charset']='ISO-8859-1';
    if (!array_key_exists('default_style',$btit_settings)) $btit_settings['default_style']=1;
    if (!array_key_exists('max_users',$btit_settings)) $btit_settings['max_users']=0;
    if (!array_key_exists('max_torrents_per_page',$btit_settings)) $btit_settings['max_torrents_per_page']=15;
    if (!array_key_exists('p_announce',$btit_settings)) $btit_settings['p_announce']=true;
    if (!array_key_exists('p_scrape',$btit_settings)) $btit_settings['p_scrape']=false;
    if (!array_key_exists('show_uploader',$btit_settings)) $btit_settings['show_uploader']=true;
    if (!array_key_exists('newslimit',$btit_settings)) $btit_settings['newslimit']=3;
    if (!array_key_exists('forumlimit',$btit_settings)) $btit_settings['forumlimit']=5;
    if (!array_key_exists('last10limit',$btit_settings)) $btit_settings['last10limit']=5;
    if (!array_key_exists('mostpoplimit',$btit_settings)) $btit_settings['mostpoplimit']=5;
    if (!array_key_exists('clocktype',$btit_settings)) $btit_settings['clocktype']=true;
    if (!array_key_exists('usepopup',$btit_settings)) $btit_settings['usepopup']=false;
    if (!array_key_exists('xbtt_use',$btit_settings)) $btit_settings['xbtt_use']=false;
    if (!array_key_exists('xbtt_url',$btit_settings)) $btit_settings['xbtt_url']='';
    if (!array_key_exists('cache_duration',$btit_settings)) $btit_settings['cache_duration']=0;
    if (!array_key_exists('mail_type',$btit_settings)) $btit_settings['mail_type']='php';
    if (!array_key_exists('ajax_poller',$btit_settings)) $btit_settings['ajax_poller']=true;

    if($btit_settings["fmhack_invitation_system"]=="enabled")
    {
        if (!array_key_exists('invitation_only',$btit_settings)) $btit_settings['invitation_only']=false;
        if (!array_key_exists('invitation_reqvalid',$btit_settings)) $btit_settings['invitation_reqvalid']=false;
    }
    if($btit_settings["fmhack_download_ratio_checker"]=="enabled")
    {
        if (!array_key_exists('mindlratio',$btit_settings)) $btit_settings['mindlratio']=0.5;
    }

}

$btit_settings=get_cached_config('SELECT `key`,`value` FROM '.$TABLE_PREFIX.'settings',$reload_cfg_interval);

if (!is_array($btit_settings))
  $btit_settings=array();

apply_default_settings();

/* Tracker Configuration
 *
 *  This file provides configuration informatino for
 *  the tracker. The user-editable variables are at the top. It is
 *  recommended that you do not change the database settings
 *  unless you know what you are doing.
 */

//Maximum reannounce interval.
$GLOBALS['report_interval'] = $btit_settings['max_announce'];
//Minimum reannounce interval. Optional.
$GLOBALS['min_interval'] = $btit_settings['min_announce'];
//Number of peers to send in one request.
$GLOBALS['maxpeers'] = $btit_settings['max_peers_per_announce'];
//If set to true, then the tracker will accept any and all
//torrents given to it. Not recommended, but available if you need it.
$GLOBALS['dynamic_torrents'] = $btit_settings['dynamic'];
// If set to true, NAT checking will be performed.
// This may cause trouble with some providers, so it's
// off by default.
$GLOBALS['NAT'] = $btit_settings['nat'];
// Persistent connections: true or false.
// Check with your webmaster to see if you're allowed to use these.
// not recommended, only if you get very higher loads, but use at you own risk.
$GLOBALS['persist'] = $btit_settings['persist'];
// Allow users to override ip= ?
// Enable this if you know people have a legit reason to use
// this function. Leave disabled otherwise.
$GLOBALS['ip_override'] = $btit_settings['allow_override_ip'];
// For heavily loaded trackers, set this to false. It will stop count the number
// of downloaded bytes and the speed of the torrent, but will significantly reduce
// the load.
$GLOBALS['countbytes'] = $btit_settings['countbyte'];
// Table caches!
// Lowers the load on all systems, but takes up more disk space.
// You win some, you lose some. But since the load is the big problem,
// grab this.
//
// Warning! Enable this BEFORE making torrents, or else run makecache.php
// immediately, or else you'll be in deep trouble. The tables will lose
// sync and the database will be in a somewhat 'stale' state.
$GLOBALS['peercaching'] = $btit_settings['peercaching'];
//Max num. of seeders with same PID.
$GLOBALS['maxseeds'] = $btit_settings['maxpid_seeds'];
//Max num. of leechers with same PID.
$GLOBALS['maxleech'] = $btit_settings['maxpid_leech'];
//file host start
$FILE_HOSTINGPATH = "file_hosting";
$GLOBALS["fhost_page_limit"] = $btit_settings['fhost_page_limit'];
$GLOBALS["fhost_file_limit"] = $btit_settings['fhost_file_limit'];
//file host  end
/////////// End of User Configuration ///////////
//Tracker's name
$SITENAME=$btit_settings['name'];
//Tracker's Base URL
$BASEURL=$btit_settings['url'];
// tracker's announce urls, can be more than one
$TRACKER_ANNOUNCE_URL=array();
$TRACKER_ANNOUNCEURLS=array();
$TRACKER_ANNOUNCE_URL=unserialize($btit_settings['announce']);
for($i=0,$count=count($TRACKER_ANNOUNCE_URL); $i<$count; $i++)
{
  if (trim($TRACKER_ANNOUNCE_URL[$i])!='')
     $TRACKER_ANNOUNCEURLS[]=trim($TRACKER_ANNOUNCE_URL[$i]);
}
//Tracker's email (owner email)
$SITEEMAIL=$btit_settings['email'];
//Torrent's DIR
$TORRENTSDIR=$btit_settings['torrentdir'];
$CAPTCHA_FOLDER='access_code';
//validation type (must be none, user or admin
//none=validate immediatly, user=validate by email, admin=manually validate
$VALIDATION=$btit_settings['validation'];
//Use or not the image code for new users' registration
$USE_IMAGECODE=$btit_settings['imagecode'];
// interval for sanity check (good = 10 minutes)
$clean_interval=$btit_settings['sanity_update'];

if($btit_settings["fmhack_shoutcast_stats_and_DJ_application"]=="enabled")
{
    // interval for radio announcement in shout
    $radio_interval=$btit_settings['radio_interval'];
    include(dirname(__FILE__)."/radio_shout.php");
}

// interval for updating external torrents (depending of how many external torrents)
$update_interval=$btit_settings['external_update'];
// forum link or internal (empty = internal) or none
$FORUMLINK=$btit_settings['forum'];
// If you want to allow users to upload external torrents values true/false
$EXTERNAL_TORRENTS=$btit_settings['external'];
// Enable/disable GZIP compression, can save a lot of bandwidth
$GZIP_ENABLED=$btit_settings['gzip'];
// Show/Hide bottom page information on script's generation time and gzip
$PRINT_DEBUG=$btit_settings['debug'];
// Enable/disable DHT network, add private flag to 'info' in torrent
$DHT_PRIVATE=$btit_settings['disable_dht'];
// Enable/disable Live Stats (up/down updated every announce) WARNING CAN DO HIGH SERVER LOAD!
$LIVESTATS=$btit_settings['livestat'];
// Enable/disable Site log
$LOG_ACTIVE=$btit_settings['logactive'];
//Enable Basic History (torrents/users)
$LOG_HISTORY=$btit_settings['loghistory'];
// Default language (used for guest)
$DEFAULT_LANGUAGE=$btit_settings['default_language'];
// Default charset (used for guest)
$GLOBALS['charset']=$btit_settings['default_charset'];
// Default style  (used for guest)
$DEFAULT_STYLE=$btit_settings['default_style'];
// Maximum number of users (0 = no limits)
$MAX_USERS=$btit_settings['max_users'];
//torrents per page
$ntorrents=$btit_settings['max_torrents_per_page'];
//private announce (true/false), if set to true don't allow non register user to download
$PRIVATE_ANNOUNCE=$btit_settings['p_announce'];
//private scrape (true/false), if set to true don't allow non register user to scrape (for stats)
$PRIVATE_SCRAPE=$btit_settings['p_scrape'];
//Show uploaders nick on torrent listing
$SHOW_UPLOADER=$btit_settings['show_uploader'];
$GLOBALS['block_newslimit'] = $btit_settings['newslimit'];
$GLOBALS['block_forumlimit'] = $btit_settings['forumlimit'];
$GLOBALS['block_last10limit'] = $btit_settings['last10limit'];
$GLOBALS['block_mostpoplimit'] =$btit_settings['mostpoplimit'];
$GLOBALS['clocktype'] = $btit_settings['clocktype'];
$GLOBALS['usepopup'] = $btit_settings['usepopup'];
// Is xbtt used as backend?
$XBTT_USE=$btit_settings['xbtt_use'];
// If used as backend, then we should have the 'xbt url'
$XBTT_URL=$btit_settings['xbtt_url'];
// this is the interval between which the cache must be updated (if 0 cache is disable)
$CACHE_DURATION=$btit_settings['cache_duration'];

//ajax polling system hack
//if set to false then the default btit polling system will be used
$GLOBALS['ajax_poller']=true;
//if set to true the script will perform an IP check to see if the IP has already voted
$GLOBALS['ipcheck_poller']=false;
//number of votes per page listed in admincp
$votesppage=25;

// inits
$cached_querys=0;
$num_querys=0;

//begin invitation system by dodge
if($btit_settings["fmhack_invitation_system"]=="enabled")
{
    $INVITATIONSON=$btit_settings['invitation_only'];
    $VALID_INV=$btit_settings['invitation_reqvalid'];
    $INV_EXPIRES=$btit_settings['invitation_expires'];
}
//end invitation system

if($btit_settings["fmhack_bonus_system"]=="enabled")
{
    $GLOBALS["bonus"] = $btit_settings["bonus"];
    $GLOBALS["price_vip"] = $btit_settings["price_vip"];
    $GLOBALS["price_ct"] = $btit_settings["price_ct"];
    $GLOBALS["price_name"] = $btit_settings["price_name"];
    $GLOBALS["price_inv"] = $btit_settings["price_inv"];
    $GLOBALS["price_inv3"] = $btit_settings["price_inv3"];
    $GLOBALS["price_inv5"] = $btit_settings["price_inv5"];
    $GLOBALS["bonus_type"] = $btit_settings["bonus_type"];
    $GLOBALS["upl_enable"] = $btit_settings["upl_enable"];
    $GLOBALS["bonus_upl"] = $btit_settings["bonus_upl"];
    $GLOBALS["bonus_upl_delay"] = $btit_settings["bonus_upl_delay"];
    $GLOBALS["comm_enable"] = $btit_settings["comm_enable"];
    $GLOBALS["bonus_comm"] = $btit_settings["bonus_comm"];
    $GLOBALS["vip_timeframe"] = $btit_settings["vip_timeframe"];
    $GLOBALS["forpost_enable"] = $btit_settings["forpost_enable"];
    $GLOBALS["bonus_forpost"] = $btit_settings["bonus_forpost"];
}

// Image Upload -->
if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
{
    $GLOBALS["imageon"] = $btit_settings["imageon"];
    $GLOBALS["screenon"] = $btit_settings["screenon"];
    $GLOBALS["uploaddir"] = $btit_settings["uploaddir"];
    $GLOBALS["file_limit"] = $btit_settings["file_limit"];
}
// <-- Image Upload

?>
