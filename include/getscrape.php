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

$BASEDIR=dirname(__FILE__);

require_once($BASEDIR."/functions.php");

function scrape($url,$infohash='')
{
    global $TABLE_PREFIX, $BASEDIR;

    if (isset($url))
    {
        $url_c=parse_url($url);

        if(!isset($url_c["port"]) || empty($url_c["port"]))
            $url_c["port"]=80;

        require_once($BASEDIR."/phpscraper/".$url_c["scheme"]."tscraper.php");
        try
        {
            $timeout = 5;
            if($url_c["scheme"]=="udp")
                $scraper = new udptscraper($timeout);
            else
                $scraper = new httptscraper($timeout);

            $ret = $scraper->scrape($url_c["scheme"]."://".$url_c["host"].":".$url_c["port"].(($url_c["scheme"]=="udp")?"":"/announce"),array($infohash));
            quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `lastupdate`=NOW(), `lastsuccess`=NOW(), `seeds`=".((isset($ret[$infohash]["seeders"]) && !empty($ret[$infohash]["seeders"]))?$ret[$infohash]["seeders"]:0).", `leechers`=".((isset($ret[$infohash]["leechers"]) && !empty($ret[$infohash]["leechers"]))?$ret[$infohash]["leechers"]:0).", `finished`=".((isset($ret[$infohash]["completed"]) && !empty($ret[$infohash]["completed"]))?$ret[$infohash]["completed"]:0)." WHERE `announce_url` = '".$url."'".($infohash==""?"":" AND `info_hash`='".$infohash."'"), true);
            if (sql_affected_rows()==1)
                write_log('SUCCESS update external torrent from '.$url.' tracker (infohash: '.$infohash.')','');
        }
        catch(ScraperException $e)
        {
            write_log("FAILED update external torrent ".($infohash==""?"":"(infohash: ".$infohash.")")." from ".$url." tracker (".$e->getMessage()."))","");
        }
        return;
    }
    return;
}

?>
