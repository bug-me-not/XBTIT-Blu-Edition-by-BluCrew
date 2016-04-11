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

# establishes a connection to a mySQL Database accroding to the details specified in settings.php
function getDBConnection () {

    $dir=explode("/",str_replace("\\", "/", dirname(__FILE__)));
    unset($dir[(count($dir)-1)]);
    $INC_PATH=implode("/",$dir)."/include";

    include($INC_PATH."/settings.php"); # contains the given DB setup $database, $dbhost, $dbuser, $dbpass
    //include($INC_PATH."/config.php");
    
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if (!$conn) {
            echo "Connection to DB was not possible!";
            end;
        }
        if (!mysql_select_db($database, $conn)) {
            echo "No DB with that name seems to exist on the server!";
            end;
        }
        
        if($GLOBALS["charset"]=="UTF-8")
            mysql_query("SET NAMES utf8");
        
        return $conn;
}

# establishes a connection to a mySQL Database accroding to the details specified in settings.php
function his_getDBConnection () {

    $dir=explode("/",str_replace("\\", "/", dirname(__FILE__)));
    unset($dir[(count($dir)-1)]);
    $INC_PATH=implode("/",$dir)."/include";

    include($INC_PATH."/settings.php"); # contains the given DB setup $database, $dbhost, $dbuser, $dbpass
    //include($INC_PATH."/config.php");
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if (!$conn) {
            echo "Connection to DB was not possible!";
            end;
        }
        if (!mysql_select_db($database, $conn)) {
            echo "No DB with that name seems to exist at the server!";
            end;
        }
        if($GLOBALS["charset"]=="UTF-8")
            mysql_query("SET NAMES utf8");
            
        return $conn;
}
?>