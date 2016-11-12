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

require_once(dirname(__FILE__).'/config.php');


if (!function_exists('bcsub')) {
   function bcsub($first_num, $second_num) {
      return ((int)$first_num)-((int)$second_num);
   }
}

function send_pm($sender,$recepient,$subject,$msg) {
   global $FORUMLINK, $TABLE_PREFIX, $db_prefix, $CACHE_DURATION, $ipb_prefix, $THIS_BASEPATH, $language;
   if(!isset($language["SYSTEM_USER"]))
      $language["SYSTEM_USER"]="System";

   if($FORUMLINK=="ipb")
   {
      ipb_send_pm($sender,$recepient,$subject,$msg);
   }
   elseif (substr($FORUMLINK,0,3)=='smf') {
      # smf forum
      # get smf_fid of recepient
      $recepient=get_result('SELECT smf_fid FROM '.$TABLE_PREFIX.'users WHERE id='.$recepient.' LIMIT 1;', true, $CACHE_DURATION);
      if (!isset($recepient[0]))
         return false;
      # valid user
      $recepient=$recepient[0]['smf_fid'];
      if ($recepient==0)
         return false;
      # valid smf_fid
      # get smf_fid of sender
      # if sender id is invalid or 0, use System
      $sender=($sender==0)?0:get_result('SELECT smf_fid, username FROM '.$TABLE_PREFIX.'users WHERE id='.$sender.' LIMIT 1;', true, $CACHE_DURATION);
      if (!isset($sender[0])) {
         $sender=array();
         $sender['smf_fid']=0;
         $sender['username']=$language["SYSTEM_USER"];
      } else $sender=$sender[0];
      # insert message
      quickQuery("INSERT INTO `{$db_prefix}personal_messages` (".(($FORUMLINK=="smf")?"`ID_MEMBER_FROM`, `fromName`":"`id_member_from`, `from_name`").", `msgtime`, `subject`, `body`) VALUES (".$sender['smf_fid'].", ".sqlesc($sender['username']).", UNIX_TIMESTAMP(), ".$subject.", ".$msg.")");
      # get id of message
      $pm_id=sql_insert_id();
      # insert recepient for message
      quickQuery("INSERT INTO `{$db_prefix}pm_recipients` (".(($FORUMLINK=="smf")?"`ID_PM`, `ID_MEMBER`":"`id_pm`, `id_member`").") VALUES (".$pm_id.", ".$recepient.")");
      # notify recepient
      if($FORUMLINK=="smf")
         quickQuery("UPDATE `{$db_prefix}members` SET `instantMessages`=`instantMessages`+1, `unreadMessages`=`unreadMessages`+1 WHERE `ID_MEMBER`=".$recepient." LIMIT 1");
      else
         quickQuery("UPDATE `{$db_prefix}members` SET `instant_messages`=`instant_messages`+1, `unread_messages`=`unread_messages`+1 WHERE `id_member`=".$recepient." LIMIT 1");
      return true;
   }
   else {
      # internal PM system
      # insert pm
      quickQuery('INSERT INTO '.$TABLE_PREFIX.'messages (sender, receiver, added, subject, msg) VALUES ('.$sender.', '.$recepient.', UNIX_TIMESTAMP(), '.$subject.', '.$msg.')');
      return true;
   }
   return false;
}

function write_file($file, $content) {
   if ($fp=@fopen($file,'w')) {
      @fputs($fp,$content);
      @fclose($fp);
      return true;
   }
   return false;
}

function send_mail($rec_email,$subject,$message, $IsHtml=false, $cc=array(), $bcc=array()) {
   global $THIS_BASEPATH, $btit_settings;

   //if (!method_exists('PHPMailer','IsMail'))
   include_once($THIS_BASEPATH.'/phpmailer/class.phpmailer.php');
   $mail=new PHPMailer();

   if ($btit_settings['mail_type']=='php') {
      $mail->IsMail();                                   # send via mail
      if (!empty($cc))
         $mail->AddCustomHeader('Cc: '.implode(',',$cc));
      if (!empty($bcc))
         $mail->AddCustomHeader('Bcc: '.implode(',',$bcc));
   } else {
      $mail->IsSMTP();                                   # send via SMTP
      $mail->Host     = $btit_settings['smtp_server'];   # SMTP servers
      $mail->Port     = (int)$btit_settings['smtp_port'];     # SMTP port
      $mail->SMTPAuth = true;                            # turn on SMTP authentication
      $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
      $mail->Username = $btit_settings['smtp_username']; # SMTP username
      $mail->Password = $btit_settings['smtp_password']; # SMTP password
      if (!empty($cc))
         foreach($cc as $carbon_copy)
            $mail->AddCC($carbon_copy[0],$carbon_copy[0]);

         if (!empty($bcc))
            foreach($bcc as $blind_carbon_copy)
               $mail->AddBCC($blind_carbon_copy[0],$blind_carbon_copy[0]);
         }

         $mail->From     = $btit_settings['email'];
         $mail->FromName = $btit_settings['name'];
         $mail->CharSet  = $btit_settings['default_charset'];
         $mail->IsHTML($IsHtml);
         $mail->AddAddress($rec_email);
         $mail->AddReplyTo($btit_settings['email'],$btit_settings['name']);
         $mail->Subject  =  $subject;
         $mail->Body     =  $message;

         return ($mail->Send())?true:$mail->ErrorInfo;
      }

      function get_remote_file($http_url,$mode='r',$timeout=60) {
   # for first thing we will try with cURL
         if (function_exists('curl_init')) {
            $fp=curl_init();
            curl_setopt($fp, CURLOPT_URL, $http_url);
            curl_setopt($fp, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($fp, CURLOPT_TIMEOUT, $timeout);
            $stream=curl_exec($fp);
            curl_close($fp);
            if (substr($stream,9,3)!='404')
               return $stream;
         }

   # then with fsockopen
         $purl=parse_url($http_url);
         $port=isset($purl['port'])?$purl['port']:'80';
         $path=isset($purl['path'])?$purl['path']:'/scrape.php';
         $an=($purl['scheme']!='http'?$purl['scheme'].'://':'').$purl['host'];
         $query=isset($purl['query'])?'?'.$purl['query']:'';
         $fp=@fsockopen($an,$port,$errno,$errstr,$timeout);

         if ($fp) {
            fputs($fp,"GET $path"."$query HTTP/1.0\r\nHost: www.google.com\r\nConnection: close\r\n\r\n");
            $stream='';
            while (!feof($fp))
               $stream.=fgets($fp, 4096);
            @fclose($fp);

            if (substr($stream,9,3)=='404') {
               $stream='';
         # last chance we try slowest fopen
               $fp=@fopen($http_url,$mode);
               if (!$fp)
                  return false;

               while (!feof($fp))
                  $stream.=fread($fp,4096);
               @fclose($fp);
         #if (substr($stream,9,3)=="404")
         #return false;
            }
            return $stream;
         }
         return false;
      }

      function get_fresh_config($qrystr) {
         global $mySecret;
         $cache_file=realpath(dirname(__FILE__).'/..').'/cache/'.md5($qrystr." -- ".$mySecret).'.txt';

         $mr=do_sqlquery($qrystr." -- ".$mySecret,true);
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

   # write new cache
         write_file($cache_file, serialize($return));
         return $return;
      }

      function do_sqlquery($qrystr,$display_error=false) {
         global $num_queries, $signon, $CURUSER;
         $num_queries++;
         $ret=$signon->query($qrystr);
         if ($display_error && $signon->errno!=0)
            stderr('MySQL query error!',"<br />\nError: ".$signon->error."<br />\nQuery: $qrystr<br />\n");

         return $ret;
      }
# Runs a query with no regard for the result
      function quickQuery($query) {
         $results = do_sqlquery($query);
         if (!is_bool($results))
            $results->free();
         else
            return $results;
         return true;
      }
#show number of rows
      function sql_num_rows($query){
         return $query->num_rows;
      }
#show sql errno
      function sql_errno(){
         global $signon;
         return $signon->errno;
      }
#Show sql Error
      function sql_error(){
         global $signon;
         return "(".$signon->errno.") ".$signon->error;
      }
#return mysql stat
      function sql_stat()
      {
         global $signon;
         return $signon->stat();
      }
#return affected rows
      function sql_affected_rows(){
         global $signon;
         return $signon->affected_rows;
      }
#sql escape_string
      function sqlesc($x) {
         global $signon;
         return '\''.$signon->real_escape_string($x).'\'';
      }
#sql escape string without escaping
      function sql_esc($x){
         global $signon;
         return $signon->real_escape_string($x);
      }

#sql insert id
      function sql_insert_id(){
         global $signon;
         return $signon->insert_id;
      }

#Get result
      function get_result($qrystr,$display_error=false,$cachetime=0) {
         global $num_queries, $cached_querys;

         $cache_file=realpath(dirname(__FILE__).'/..').'/cache/'.md5($qrystr).'.txt';

         if ($cachetime>0)
            if (file_exists($cache_file) && (time()-$cachetime) < filemtime($cache_file)) {
               $num_queries++;
               $cached_querys++;
               return unserialize(file_get_contents($cache_file));
            }

            $return=array();
            $mr=do_sqlquery($qrystr,$display_error);
            while ($mz=$mr->fetch_assoc())
               $return[]=$mz;

            unset($mz);
            $mr->free();

            if ($cachetime>0)
               write_file($cache_file, serialize($return));

            return $return;
         }

         function write_cached_version($page, $content='') {
            global $CACHE_DURATION;

            if ($CACHE_DURATION==0)
               return false;

            $cache_file=realpath(dirname(__FILE__).'/..').'/cache/'.md5($page).'.txt';
            if ($content=='')
               $content=ob_get_contents();

   # write cache file
            write_file($cache_file, $content);
            ob_end_flush();
         }

         function get_cached_version($page) {
            global $CACHE_DURATION;

            if ($CACHE_DURATION==0)
               return false;

            $cache_file=realpath(dirname(__FILE__).'/..').'/cache/'.md5($page).'.txt';

            if (file_exists($cache_file) && (time()-$CACHE_DURATION) < filemtime($cache_file))
               return file_get_contents($cache_file);

            ob_start();
            return false;
         }

# Reports an error to the client in $message.
# Any other output will confuse the client, so please don't do that.
         function show_error($message, $log=false) {
            if ($log)
               error_log("BtiTracker: ERROR ($message)");

            echo 'd14:failure reason'.strlen($message).":$message".'e';
            die();
         }


         function verifyHash($input) {
            if (strlen($input)==40&&preg_match('/^[0-9a-fA-F]+$/', $input)){
               return true;}
               return false;
            }

# validip/getip courtesy of manolete <manolete@myway.com>
# IP Validation
            function validip($ip) {
               if (!empty($ip) && $ip==long2ip(ip2long($ip))) {
      # reserved IANA IPv4 addresses
      # http://www.iana.org/assignments/ipv4-address-space
                  $reserved_ips = array (
                     array('0.0.0.0','2.255.255.255'),
                     array('10.0.0.0','10.255.255.255'),
                     array('127.0.0.0','127.255.255.255'),
                     array('169.254.0.0','169.254.255.255'),
                     array('172.16.0.0','172.31.255.255'),
                     array('192.0.2.0','192.0.2.255'),
                     array('192.168.0.0','192.168.255.255'),
                     array('255.255.255.0','255.255.255.255')
                     );

                  foreach ($reserved_ips as $r)
                     if ((ip2long($ip) >= ip2long($r[0])) && (ip2long($ip) <= ip2long($r[1])))
                        return false;
                     return true;
                  }
                  return false;
               }

               /* Patched function to detect REAL IP address if it's valid */
               function getip() {
                  if (getenv('HTTP_CLIENT_IP') && long2ip(ip2long(getenv('HTTP_CLIENT_IP')))==getenv('HTTP_CLIENT_IP') && validip(getenv('HTTP_CLIENT_IP')))
                     return getenv('HTTP_CLIENT_IP');

                  if (getenv('HTTP_X_FORWARDED_FOR') && long2ip(ip2long(getenv('HTTP_X_FORWARDED_FOR')))==getenv('HTTP_X_FORWARDED_FOR') && validip(getenv('HTTP_X_FORWARDED_FOR')))
                     return getenv('HTTP_X_FORWARDED_FOR');

                  if (getenv('HTTP_X_FORWARDED') && long2ip(ip2long(getenv('HTTP_X_FORWARDED')))==getenv('HTTP_X_FORWARDED') && validip(getenv('HTTP_X_FORWARDED')))
                     return getenv('HTTP_X_FORWARDED');

                  if (getenv('HTTP_FORWARDED_FOR') && long2ip(ip2long(getenv('HTTP_FORWARDED_FOR')))==getenv('HTTP_FORWARDED_FOR') && validip(getenv('HTTP_FORWARDED_FOR')))
                     return getenv('HTTP_FORWARDED_FOR');

                  if (getenv('HTTP_FORWARDED') && long2ip(ip2long(getenv('HTTP_FORWARDED')))==getenv('HTTP_FORWARDED') && validip(getenv('HTTP_FORWARDED')))
                     return getenv('HTTP_FORWARDED');

                  $ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
                  /* Added support for IPv6 connections. otherwise ip returns null */
                  if (strpos($ip, '::') === 0)
                  {
                     $ip = substr($ip, strrpos($ip, ':')+1);
                  }

                  return long2ip(ip2long($ip));

               }

               if(!function_exists("hex2bin"))
               {
                  function hex2bin ($input, $assume_safe=true)
                  {
                     if ($assume_safe !== true && ! ((strlen($input)%2) == 0 || preg_match ('/^[0-9a-f]+$/i', $input)))
                        return '';
                     return pack('H*', $input);
                  }
               }

#========================================
# getAgent function by deliopoulos
#========================================
               function StdDecodePeerId($id_data, $id_name) {
                  $version_str='';
                  for ($i=0; $i<=strlen($id_data); $i++){
                     $c = $id_data[$i];
                     if ($id_name=='BitTornado' || $id_name=='ABC') {
                        if ($c!='-' && ctype_digit($c))
                           $version_str.=$c.'.';
                        elseif ($c!='-' && ctype_alpha($c))
                           $version_str.=(ord($c)-55).'.';
                        else
                           break;
                     } elseif($id_name=='BitComet'||$id_name=='BitBuddy'||$id_name=='Lphant'||$id_name=='BitPump'||$id_name=='BitTorrent Plus! v2') {
                        if ($c!='-' && ctype_alnum($c)) {
                           $version_str .= $c;
                           if($i==0)
                              $version_str = (int)$version_str.'.';
                        } else{
                           $version_str .= '.';
                           break;
                        }
                     } else {
                        if ($c!='-' && ctype_alnum($c))
                           $version_str .= $c.'.';
                        else
                           break;
                     }
                  }
                  $version_str=substr($version_str,0,strlen($version_str)-1);
                  return $id_name.' '.$version_str;
               }

               function MainlineDecodePeerId($id_data, $id_name) {
                  $version_str='';
                  for ($i=0,$len=strlen($id_data); $i<=$len; $i++) {
                     $c=$id_data[$i];
                     if ($c!='-' && ctype_alnum($c))
                        $version_str.=$c.'.';
                  }
                  $version_str=substr($version_str,0,strlen($version_str)-1);
                  return $id_name.' '.$version_str;
               }

               function DecodeVersionString ($ver_data, $id_name) {
                  $version_str='';
                  $version_str.=intval(ord($ver_data[0]) + 0).'.';
                  $version_str.=intval(ord($ver_data[1])/10 + 0);
                  $version_str.=intval(ord($ver_data[1])%10 + 0);
                  return $id_name.' '.$version_str;
               }

               function getagent($httpagent, $peer_id='') {
                  if($peer_id!='')
                     $peer_id=hex2bin($peer_id);
                  if(substr($peer_id,0,3)=='-AX')
   return StdDecodePeerId(substr($peer_id,4,4),'BitPump'); # AnalogX BitPump
if(substr($peer_id,0,3)=='-BB')
   return StdDecodePeerId(substr($peer_id,3,5),'BitBuddy'); # BitBuddy
if(substr($peer_id,0,3)=='-BC')
   return StdDecodePeerId(substr($peer_id,4,4),'BitComet'); # BitComet
if(substr($peer_id,0,3)=='-BS')
   return StdDecodePeerId(substr($peer_id,3,7),'BTSlave'); # BTSlave
if(substr($peer_id,0,3)=='-BX')
   return StdDecodePeerId(substr($peer_id,3,7),'BittorrentX'); # BittorrentX
if(substr($peer_id,0,3)=='-CT')
   return "Ctorrent $peer_id[3].$peer_id[4].$peer_id[6]"; # CTorrent
if(substr($peer_id,0,3)=='-KT')
   return StdDecodePeerId(substr($peer_id,3,7),'KTorrent'); # KTorrent
if(substr($peer_id,0,3)=='-LT')
   return StdDecodePeerId(substr($peer_id,3,7),'libtorrent'); # libtorrent
if(substr($peer_id,0,3)=='-LP')
   return StdDecodePeerId(substr($peer_id,4,4),'Lphant'); # Lphant
if(substr($peer_id,0,3)=='-MP')
   return StdDecodePeerId(substr($peer_id,3,7),'MooPolice'); # MooPolice
if(substr($peer_id,0,3)=='-MT')
   return StdDecodePeerId(substr($peer_id,3,7),'Moonlight'); # MoonlightTorrent
if(substr($peer_id,0,3)=='-PO')
   return StdDecodePeerId(substr($peer_id,3,7),'PO Client'); # PO Client
if(substr($peer_id,0,3)=='-QT')
   return StdDecodePeerId(substr($peer_id,3,7),'Qt 4 Torrent'); # Qt 4 Torrent
if(substr($peer_id,0,3)=='-RT')
   return StdDecodePeerId(substr($peer_id,3,7),'Retriever'); # Retriever
if(substr($peer_id,0,3)=='-S2')
   return StdDecodePeerId(substr($peer_id,3,7),'S2 Client'); # S2 Client
if(substr($peer_id,0,3)=='-SB')
   return StdDecodePeerId(substr($peer_id,3,7),'Swiftbit'); # Swiftbit
if(substr($peer_id,0,3)=='-SN')
   return StdDecodePeerId(substr($peer_id,3,7),'ShareNet'); # ShareNet
if(substr($peer_id,0,3)=='-SS')
   return StdDecodePeerId(substr($peer_id,3,7),'SwarmScope'); # SwarmScope
if(substr($peer_id,0,3)=='-SZ')
   return StdDecodePeerId(substr($peer_id,3,7),'Shareaza'); # Shareaza
if(preg_match('/^RAZA ([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/', $httpagent, $matches))
   return "Shareaza $matches[1]";
if(substr($peer_id,0,3)=='-TN')
   return StdDecodePeerId(substr($peer_id,3,7),'Torrent.NET'); # Torrent.NET
if(substr($peer_id,0,3)=='-TR')
   return StdDecodePeerId(substr($peer_id,3,7),'Transmission'); # Transmission
if(substr($peer_id,0,3)=='-TS')
   return StdDecodePeerId(substr($peer_id,3,7),'TorrentStorm'); # Torrentstorm
if(substr($peer_id,0,3)=='-UR')
   return StdDecodePeerId(substr($peer_id,3,7),'UR Client'); # unidentified clients with versions
if(substr($peer_id,0,3)=='-UT')
   return StdDecodePeerId(substr($peer_id,3,7),'uTorrent'); # uTorrent
if(substr($peer_id,0,3)=='-XT')
   return StdDecodePeerId(substr($peer_id,3,7),'XanTorrent'); # XanTorrent
if(substr($peer_id,0,3)=='-ZT')
   return StdDecodePeerId(substr($peer_id,3,7),'ZipTorrent'); # ZipTorrent
if(substr($peer_id,0,3)=='-bk')
   return StdDecodePeerId(substr($peer_id,3,7),'BitKitten'); # BitKitten
if(substr($peer_id,0,3)=='-lt')
   return StdDecodePeerId(substr($peer_id,3,7),'libTorrent'); # libTorrent
if(substr($peer_id,0,3)=='-pX')
   return StdDecodePeerId(substr($peer_id,3,7),'pHoeniX'); # pHoeniX
if(substr($peer_id,0,2)=='BG')
   return StdDecodePeerId(substr($peer_id,2,4),'BTGetit'); # BTGetit
if(substr($peer_id,2,2)=='BM')
   return DecodeVersionString(substr($peer_id,0,2),'BitMagnet'); # BitMagnet
if(substr($peer_id,0,2)=='OP')
   return StdDecodePeerId(substr($peer_id,2,4),'Opera'); # Opera
if(substr($peer_id,0,4)=='270-')
   return 'GreedBT 2.7.0'; # GreedBT
if(substr($peer_id,0,4)=='271-')
   return 'GreedBT 2.7.1'; # GreedBT 2.7.1
if(substr($peer_id,0,4)=='346-')
   return 'TorrentTopia'; # TorrentTopia
if(substr($peer_id,0,3)=='-AR')
   return 'Arctic Torrent'; # Arctic (no way to know the version)
if(substr($peer_id,0,3)=='-G3')
   return 'G3 Torrent'; # G3 Torrent
if(substr($peer_id,0,6)=='BTDWV-')
   return 'Deadman Walking'; # Deadman Walking
if(substr($peer_id,5,7)=='Azureus')
   return 'Azureus 2.0.3.2'; # Azureus 2.0.3.2
if(substr($peer_id,0,8)=='PRC.P---')
   return 'BitTorrent Plus! II'; # BitTorrent Plus! II
if(substr($peer_id,0,8)=='P87.P---')
   return 'BitTorrent Plus!'; # BitTorrent Plus!
if(substr($peer_id,0,4)=='Plus')
   return StdDecodePeerId(substr($peer_id,4,5),'BitTorrent Plus! v2'); # BitTorrent Plus! v2 (not 100% sure on this one)
if(substr($peer_id,0,8)=='S587Plus')
   return 'BitTorrent Plus!'; # BitTorrent Plus!
if(substr($peer_id,0,7)=='martini')
   return 'Martini Man'; # Martini Man
if(substr($peer_id,4,6)=='btfans')
   return 'SimpleBT'; # SimpleBT
if(substr($peer_id,3,9)=='SimpleBT?')
   return 'SimpleBT'; # SimpleBT
if(preg_match('/^MFC_Tear_Sample/', $httpagent))
   return 'SimpleBT';
if(substr($peer_id,0,5)=='btuga')
   return 'BTugaXP'; # BTugaXP
if(substr($peer_id,0,5)=='BTuga')
   return 'BTuga'; # BTugaXP
if(substr($peer_id,0,5)=='oernu')
   return 'BTugaXP'; # BTugaXP
if(substr($peer_id,0,10)=='DansClient')
   return 'XanTorrent'; # XanTorrent
if(substr($peer_id,0,16)=='Deadman Walking-')
   return 'Deadman'; # Deadman client
if(substr($peer_id,0,8)=='XTORR302')
   return 'TorrenTres 0.0.2'; # TorrenTres
if(substr($peer_id,0,7)=='turbobt')
   return 'TurboBT '.(substr($peer_id,7,5)); # TurboBT
if(substr($peer_id,0,7)=='a00---0')
   return 'Swarmy'; # Swarmy
if(substr($peer_id,0,7)=='a02---0')
   return 'Swarmy'; # Swarmy
if(substr($peer_id,0,7)=='T00---0')
   return 'Teeweety'; # Teeweety
if(substr($peer_id,0,7)=='rubytor')
   return 'Ruby Torrent v'.ord($peer_id[7]); # Ruby Torrent
if(substr($peer_id,0,5)=='Mbrst')
   return MainlineDecodePeerId(substr($peer_id,5,5),'burst!'); # burst!
if(substr($peer_id,0,4)=='btpd')
   return 'BT Protocol Daemon '.(substr($peer_id,5,3)); # BT Protocol Daemon
if(substr($peer_id,0,8)=='XBT022--')
   return 'BitTorrent Lite'; # BitTorrent Lite based on XBT code
if(substr($peer_id,0,3)=='XBT')
   return StdDecodePeerId(substr($peer_id,3,3), 'XBT'); # XBT Client
if(substr($peer_id,0,4)=='-BOW')
   return StdDecodePeerId(substr($peer_id,4,5),'Bits on Wheels'); # Bits on Wheels
if(substr($peer_id,1,2)=='ML')
   return MainlineDecodePeerId(substr($peer_id,3,5),'MLDonkey'); # MLDonkey
if($peer_id[0]=='A')
{
   if(substr($peer_id,0,8)=="AZ2500BT")
      return "BitTyrant";
      return StdDecodePeerId(substr($peer_id,1,9),'ABC'); # ABC
   }
   if($peer_id[0]=='R')
   return StdDecodePeerId(substr($peer_id,1,5),'Tribler'); # Tribler
if($peer_id[0]=='M') {
   if(preg_match('/^Python/', $httpagent, $matches))
      return 'Spoofing BT Client'; # Spoofing BT Client
      return MainlineDecodePeerId(substr($peer_id,1,7),'Mainline'); # Mainline BitTorrent with version
   }
   if($peer_id[0]=='O')
   return StdDecodePeerId(substr($peer_id,1,9),'Osprey Permaseed'); # Osprey Permaseed
if($peer_id[0]=='S'){
   if(preg_match('/^BitTorrent\/3.4.2/', $httpagent, $matches))
      return 'Spoofing BT Client'; # Spoofing BT Client
      return StdDecodePeerId(substr($peer_id,1,9),'Shad0w'); # Shadow's client
   }
   if($peer_id[0]=='T'){
      if(preg_match('/^Python/', $httpagent, $matches))
      return 'Spoofing BT Client'; # Spoofing BT Client
      return StdDecodePeerId(substr($peer_id,1,9),'BitTornado'); # BitTornado
   }
   if($peer_id[0]=='U')
   return StdDecodePeerId(substr($peer_id,1,9),'UPnP'); # UPnP NAT Bit Torrent
   # Azureus / Localhost
if(substr($peer_id,0,3)=='-AZ') {
   if(preg_match('/^Localhost ([0-9]+\.[0-9]+\.[0-9]+)/', $httpagent, $matches))
      return "Localhost $matches[1]";
   if(preg_match('/^BitTorrent\/3.4.2/', $httpagent, $matches))
      return 'Spoofing BT Client'; # Spoofing BT Client
   if(preg_match('/^Python/', $httpagent, $matches))
      return 'Spoofing BT Client'; # Spoofing BT Client
   return StdDecodePeerId(substr($peer_id,3,7),((substr($peer_id, 3, 2)>=31)?'Vuze':'Azureus'));
}
if(preg_match('/^Azureus/', $peer_id))
   return 'Azureus 2.0.3.2';
   # BitComet/BitLord/BitVampire/Modded FUTB BitComet
if(substr($peer_id,0,4)=='exbc' || substr($peer_id,1,3)=='UTB'){
   if(substr($peer_id,0,4)=='FUTB')
      return DecodeVersionString(substr($peer_id,4,2),'BitComet Mod1');
   if(substr($peer_id,0,4)=='xUTB')
      return DecodeVersionString(substr($peer_id,4,2),'BitComet Mod2');
   if(substr($peer_id,6,4)=='LORD')
      return DecodeVersionString(substr($peer_id,4,2),'BitLord');
   if(substr($peer_id,6,3)=='---' && DecodeVersionString(substr($peer_id,4,2),'BitComet')=='BitComet 0.54')
      return 'BitVampire';
   return DecodeVersionString(substr($peer_id,4,2),'BitComet');
}
   # Rufus
if(substr($peer_id,2,2)=='RS'){
   for ($i=0; $i<=strlen(substr($peer_id,4,9)); $i++){
      $c = $peer_id[$i+4];
      if (ctype_alnum($c) || $c == chr(0))
         $rufus_chk = true;
      else break;
   }
   if (isset($rufus_chk))
      return DecodeVersionString(substr($peer_id,0,2),'Rufus');
}
   # BitSpirit
if(substr($peer_id,14,6)=='HTTPBT' || substr($peer_id,16,4)=='UDP0') {
   if(substr($peer_id,2,2)=='BS') {
      if($peer_id[1]==chr(0))
         return 'BitSpirit v1';
      if($peer_id[1]== chr(2))
         return 'BitSpirit v2';
   }
   return 'BitSpirit';
}
   #BitSpirit
if(substr($peer_id,2,2)=='BS') {
   if($peer_id[1]==chr(0))
      return 'BitSpirit v1';
   if($peer_id[1]==chr(2))
      return 'BitSpirit v2';
   return 'BitSpirit';
}
if(substr($peer_id,1,2)=="SP")
   return StdDecodePeerId(substr($peer_id,3,4),"BitSpirit");

   # eXeem beta
if(substr($peer_id,0,3)=='-eX') {
   $version_str = '';
   $version_str .= intval($peer_id[3],16).'.';
   $version_str .= intval($peer_id[4],16);
   return "eXeem $version_str";
}
if(substr($peer_id,0,2)=='eX')
   return 'eXeem'; # eXeem beta .21
if(substr($peer_id,0,12)==(chr(0)*12) && $peer_id[12]==chr(97) && $peer_id[13]==chr(97))
   return 'Experimental 3.2.1b2'; # Experimental 3.2.1b2
if(substr($peer_id,0,12)==(chr(0)*12) && $peer_id[12]==chr(0) && $peer_id[13]==chr(0))
   return 'Experimental 3.1'; # Experimental 3.1

if(substr($peer_id,1,2)=="UM")
   return StdDecodePeerId(substr($peer_id,3,4),"uTorrent for Mac");
if(substr($peer_id,1,2)=="SD")
   return "Thunder";
if(substr($peer_id,1,2)=="XL")
   return "XunLei";
if(substr($peer_id,1,2)=="CD")
   return "Enhanced CTorrent " . substr($peer_id,4,1) . "." . substr($peer_id,6,1);
if(substr($peer_id,1,2)=="qB")
   return StdDecodePeerId(substr($peer_id,3,4),"qBittorrent");
if(substr($peer_id,1,2)=="AG")
   return StdDecodePeerId(substr($peer_id,3,4),"Ares");
if(substr($peer_id, 1, 2) == "BF")
{
   if(substr($peer_id, 3, 4) == "6110")
      $ver="0.10";
   elseif(substr($peer_id, 3, 4) == "6C05")
      $ver="0.20";
   elseif(substr($peer_id, 3, 4) == "6C0F")
      $ver="0.21";
   elseif(substr($peer_id, 3, 4) == "7114")
      $ver="0.22";
   elseif(substr($peer_id, 3, 4) == "7127")
      $ver="0.30";
   elseif(substr($peer_id, 3, 4) == "7128")
      $ver="0.31";
   elseif(substr($peer_id, 3, 4) == "7224")
      $ver="0.32";
   else $ver="";

   return "BitFlu ".$ver;
}
if(substr($peer_id,1,2)=="DE")
   return StdDecodePeerId(substr($peer_id,3,3),"Deluge");
if(substr($peer_id,1,2)=="HL")
   return StdDecodePeerId(substr($peer_id,3,4),"Halite");
if(substr($peer_id,1,2)=="TT")
   return StdDecodePeerId(substr($peer_id,3,3),"TuoTu");
if(substr($peer_id,1,2)=="BE")
   return StdDecodePeerId(substr($peer_id,3,2),"BitTorrent SDK");
if(substr($peer_id,1,2)=="LH")
   return StdDecodePeerId(substr($peer_id,3,4),"LH-ABC");
if(substr($peer_id,1,2)=="FC")
   return StdDecodePeerId(substr($peer_id,3,2),"File Croc");
if(substr($peer_id,1,2)=="OS")
   return StdDecodePeerId(substr($peer_id,3,3),"OneSwarm");

   // Unknown Client - If HTTP Agent is empty
   // (mainly for the benefit of the customised version of the XBT backend so that it displays useful information to update missing clients)
if($httpagent=="")
   return "Unknown Client (".substr($peer_id,0,8).")";

   // Unknown Client - If HTTP Agent is NOT empty
return $httpagent;
}
#========================================
#getAgent function by deliopoulos
#========================================

if(!function_exists('stripos'))
{
   function stripos($haystack,$needle,$offset = 0)
   {
      return(strpos(strtolower($haystack),strtolower($needle),$offset));
   }
}

function cut_string($ori_string,$cut_after) {
   $rchars=array('_','.','-');
   $ori_string=str_replace($rchars,' ',$ori_string);
   if (strlen($ori_string)>$cut_after && $cut_after>0)
      return substr($ori_string,0,$cut_after).'...';
   return $ori_string;
}

function test_my_cookie()
{
   global $btit_settings, $TABLE_PREFIX;

   if($btit_settings["secsui_cookie_type"]==1)
   {
      $cookie_id=(isset($_COOKIE["uid"])?(int)0+$_COOKIE["uid"]:1);
      $cookie_hash=(isset($_COOKIE["pass"])?$_COOKIE["pass"]:"");
   }
   elseif($btit_settings["secsui_cookie_type"]==2)
   {
      $cookie_name=((isset($btit_settings["secsui_cookie_name"]) && !empty($btit_settings["secsui_cookie_name"]))?$btit_settings["secsui_cookie_name"]:"BluRG Login");
      $cookie_array=unserialize($_COOKIE[$cookie_name]);
      $cookie_id=(isset($cookie_array["id"])?(int)0+$cookie_array["id"]:1);
      $cookie_hash=(isset($cookie_array["hash"])?$cookie_array["hash"]:"");
      unset($cookie_array);
   }
   elseif($btit_settings["secsui_cookie_type"]==3)
   {
      session_name("BluRG");
      session_start();
      $cookie_array=unserialize($_SESSION["login_cookie"]);
      $cookie_id=(isset($cookie_array["id"])?(int)0+$cookie_array["id"]:1);
      $cookie_hash=(isset($cookie_array["hash"])?$cookie_array["hash"]:"");
      unset($cookie_array);
   }
   if($cookie_id<=1)
      return array("is_valid" => false, "id" => 1);
   else
   {
      $res=get_result("SELECT `username`, `password`, `random`, `salt` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$cookie_id);
      if(count($res)==1)
         $row=$res[0];
      else
         return array("is_valid" => false, "id" => 1);

      if($btit_settings["secsui_cookie_type"]==1)
      {
         $user_hash=sha1($row["random"].$row["password"].$row["random"]);
      }
      elseif($btit_settings["secsui_cookie_type"]==2  || $btit_settings["secsui_cookie_type"]==3)
      {
         $cookie_items=explode(",", $btit_settings["secsui_cookie_items"]);
         $cookie_string="";

         foreach($cookie_items as $ci_value)
         {
            $ci_exp=explode("-",$ci_value);
            if($ci_exp[0]==8)
            {
               $ci_exp2=explode("[+]", $ci_exp[1]);
               if($ci_exp2[0]==1)
               {
                  $ip_parts=explode(".", getip());

                  if($ci_exp2[1]==1)
                     $cookie_string.=$ip_parts[0]."-";
                  if($ci_exp2[1]==2)
                     $cookie_string.=$ip_parts[1]."-";
                  if($ci_exp2[1]==3)
                     $cookie_string.=$ip_parts[2]."-";
                  if($ci_exp2[1]==4)
                     $cookie_string.=$ip_parts[3]."-";
                  if($ci_exp2[1]==5)
                     $cookie_string.=$ip_parts[0].".".$ip_parts[1]."-";
                  if($ci_exp2[1]==6)
                     $cookie_string.=$ip_parts[1].".".$ip_parts[2]."-";
                  if($ci_exp2[1]==7)
                     $cookie_string.=$ip_parts[2].".".$ip_parts[3]."-";
                  if($ci_exp2[1]==8)
                     $cookie_string.=$ip_parts[0].".".$ip_parts[2]."-";
                  if($ci_exp2[1]==9)
                     $cookie_string.=$ip_parts[0].".".$ip_parts[3]."-";
                  if($ci_exp2[1]==10)
                     $cookie_string.=$ip_parts[1].".".$ip_parts[3]."-";
                  if($ci_exp2[1]==11)
                     $cookie_string.=$ip_parts[0].".".$ip_parts[1].".".$ip_parts[2]."-";
                  if($ci_exp2[1]==12)
                     $cookie_string.=$ip_parts[1].".".$ip_parts[2].".".$ip_parts[3]."-";
                  if($ci_exp2[1]==13)
                     $cookie_string.=$ip_parts[0].".".$ip_parts[1].".".$ip_parts[2].".".$ip_parts[3]."-";

                  unset($ci_exp2);
               }
            }
            else
            {
               if($ci_exp[0]==1 && $ci_exp[1]==1)
               {
                  $cookie_string.=$cookie_id."-";
               }
               if($ci_exp[0]==2 && $ci_exp[1]==1)
               {
                  $cookie_string.=$row["password"]."-";
               }
               if($ci_exp[0]==3 && $ci_exp[1]==1)
               {
                  $cookie_string.=$row["random"]."-";
               }
               if($ci_exp[0]==4 && $ci_exp[1]==1)
               {
                  $cookie_string.=strtolower($row["username"])."-";
               }
               if($ci_exp[0]==5 && $ci_exp[1]==1)
               {
                  $cookie_string.=$row["salt"]."-";
               }
               if($ci_exp[0]==6 && $ci_exp[1]==1)
               {
                  $cookie_string.=$_SERVER["HTTP_USER_AGENT"]."-";
               }
               if($ci_exp[0]==7 && $ci_exp[1]==1)
               {
                  $cookie_string.=$_SERVER["HTTP_ACCEPT_LANGUAGE"]."-";
               }
            }
            unset($ci_exp);
         }
         $user_hash=sha1(trim($cookie_string, "-"));
      }
      if($user_hash==$cookie_hash)
         return array("is_valid" => true, "id" => $cookie_id);
      else
         return array("is_valid" => false, "id" => 1);
   }
}

function html_parse($data) {
   global $btit_settings;
   $types=array("ISO-8859-1","ISO-8859-5","ISO-8859-15","UTF-8","cp866","cp1251","cp1252","KOI8-R","BIG5","GB2312","BIG5-HKSCS","Shift_JIS","EUC-JP","MacRoman");
   $hlang=(in_array($btit_settings["default_charset"],$types)?$btit_settings["default_charset"]:"UTF-8");
   if($btit_settings["html_entities"]=="enabled")
      return htmlentities($data,ENT_QUOTES,$hlang);
   else
      return htmlspecialchars($data,ENT_QUOTES,$hlang);
}

function get_content($file)
{
   global $STYLEPATH, $TABLE_PREFIX, $language;
   ob_start();
   include ($file);
   $content = ob_get_contents();
   ob_end_clean();
   return $content;
}
function set_block($block_title, $alignement, $block_content, $width100 = true)
{
   global $STYLEPATH, $TABLE_PREFIX, $language;
   $blocktpl = new bTemplate();
   $blocktpl->set('block_width', ($width100?'width="100%"':''));
   $blocktpl->set('block_title', $block_title);
   $blocktpl->set('block_align', $alignement);
   $blocktpl->set('block_content', $block_content);
   return $blocktpl->fetch(load_template('block.tpl'));
}
function get_block($block_title, $alignement, $block, $use_cache = true, $width100 = true)
{
   global $STYLEPATH, $TABLE_PREFIX, $language, $CACHE_DURATION, $CURUSER;
   $blocktpl = new bTemplate();
   $blocktpl->set('block_width', ($width100?'width="100%"':''));
   $blocktpl->set('block_title', $block_title);
   $blocktpl->set('block_align', $alignement);
   $cache_file = realpath(dirname(__file__).'/..').'/cache/'.md5($block.$CURUSER['id_level']).'.txt';
   $use_cache = ($use_cache)?$CACHE_DURATION > 0:false;
   if($use_cache)
   {
      // read cache
      if(file_exists($cache_file) && (time() - $CACHE_DURATION) < filemtime($cache_file))
      {
         $blocktpl->set('block_content', file_get_contents($cache_file));
         return $blocktpl->fetch(load_template('block.tpl'));
      }
   }
   ob_start();
   include (realpath(dirname(__file__).'/..').'/blocks/'.$block.'_block.php');
   $block_content = ob_get_contents();
   ob_end_clean();
   if($use_cache)
   {
      // write cache file
      $fp = fopen($cache_file, 'w');
      fputs($fp, $block_content);
      fclose($fp);
   }
   $blocktpl->set('block_content', $block_content);
   return $blocktpl->fetch(load_template('block.tpl'));
}

//announcements
function announcement ($uid) {
   global $CURUSER, $TABLE_PREFIX;
   if ($CURUSER && $uid == "no") {
      $res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}announcements WHERE minclassread <= {$CURUSER['id_level']} ORDER by added DESC LIMIT 1");
      $ret = $res->fetch_array();
   }
   return $ret;
}

function login_redirect($name, $value)
{
  echo "<html><head></head>
  <body>
     <form name='dir' action='/login_new.php' method='post'>
       <input type=hidden name='{$name}' value='{$value}' />
       <input type=hidden name='submitter' value='true' />
       <input type=hidden name='cmd' value='test' />
    </form>
    <script>
       document.dir.submit();
    </script>
 </body></html>";
}

function setImageData($imdb = 0 , $tvdb = 0)
{
   require_once dirname(__file__)."/class.tvdb.php";
   $tvdb_api_key="84198CDB1D6D23DE"; //Needs to be inserted from Admin CP
   require_once dirname(__FILE__)."/class.fanart.php";
   $fanart_api_key="05e03e4887f762022f945ee1d27ca627"; //Needs to be inserted from Admin CP

   if(getPosterData($imdb, $tvdb) == $GLOBALS["uploaddir"]."nocover.jpg")
   {

   }

   if(getBannerData($imdb, $tvdb) == "images/default_fanart.png")
   {

   }

   if(!getDiscArt($imdb, $tvdb))
   {

   }
}

function getPosterData($imdb = 0 , $tvdb = 0, $infohash = '')
{
   global $THIS_BASEPATH;

   $posters = array();
   $poster = $GLOBALS["uploaddir"]."nocover.jpg";

   if($imdb > 0)
   {
      if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/posters"))
      {
         foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/posters/*.*") as $postersFile)
         {
            $posters[] = str_replace($THIS_BASEPATH."/", "", $postersFile);
         }
      }
   }

   if($tvdb > 0)
   {
      if(file_exists($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/posters"))
      {
         foreach(glob($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/posters/*.*") as $postersFile)
         {
            $posters[] = str_replace($THIS_BASEPATH."/", "", $postersFile);
         }
      }
   }

   if(strlen($infohash) >= 40)
   {
      if(file_exists($THIS_BASEPATH."/".$GLOBALS['uploaddir'].$infohash))
      {
         $poster = $GLOBALS['uploaddir'].$infohash;
      }
   }

   if(count($posters) > 0 && $infohash == '')
   {
      $rkey = mt_rand(0, (count($posters) - 1));
      $poster = $posters[$rkey];
   }

   unset($rkey);
   unset($posters);

   return $poster;
}

function getBannerData($imdb = 0 , $tvdb = 0)
{
   global $THIS_BASEPATH;

   $banners = array();
   $banner = "images/default_fanart.png";

   if($imdb > 0)
   {
      if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/banners"))
      {
         foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/banners/*.*") as $bannersFile)
         {
            $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
         }
      }
   }

   if($tvdb > 0)
   {
      if(file_exists($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/banners"))
      {
         foreach(glob($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/banners/*.*") as $bannersFile)
         {
            $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
         }
      }

      if(file_exists($THIS_BASEPATH."/images/thetvdb/".$tvdb."/banners"))
      {
         foreach(glob($THIS_BASEPATH."/images/thetvdb/".$tvdb."/banners/*.*") as $bannersFile)
         {
            $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
         }
      }
   }

   if(count($banners) > 0)
   {
      $rkey = mt_rand(0, (count($banners) - 1));
      $banner = $banners[$rkey];
   }

   unset($rkey);
   unset($banners);

   return $banner;
}

function getDiscArt($imdb = 0, $tvdb = 0)
{
   $dArtS = array();
   $dArt = false;




   return $dArt;
}

function getOMDBData($imdb) //Needs a caching system
{
   $cache_file = realpath(dirname(__FILE__)."/../cache/omdb/tt".$imdb.".txt");

   if(file_exists($cache_file))
   {
      return unserialize($cache_file);
   }

   require_once dirname(__FILE__)."/class.omdb.php";

   $movie = new SparksCoding\MovieInformation\MovieInformation('tt'.$imdb, array('plot'=>'full', 'tomatoes'=>'true'));

   $contents = serialize($movie);
   $file = fopen($cache_file,"w");
   fputs($file,$contents);
   fclose($file);

   return $movie;
}

?>
