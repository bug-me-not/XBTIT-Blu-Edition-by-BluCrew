<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Report torrent/user hack by DiemThuy - march 2009
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
require_once("include/functions.php");

if (!defined("IN_BTIT"))
die("non direct access!");


if ($CURUSER["admin_access"]=="no")
{
   stderr("ERROR,","NO ADMIN CP ACCESS");
   stdfoot();
   exit;
}
if (isset($_POST[markreport])){
   $res = do_sqlquery ("SELECT id FROM {$TABLE_PREFIX}reports WHERE dealtwith=0 AND id IN (" . implode(", ", $_POST[markreport]) . ")");
   while ($arr = $res->fetch_assoc())
   quickQuery("UPDATE {$TABLE_PREFIX}reports SET dealtwith=1, dealtby = $CURUSER[uid] WHERE id = $arr[id]") or sqlerr();
}
if (isset($_POST[delreport])){
   $res = do_sqlquery ("DELETE FROM {$TABLE_PREFIX}reports WHERE id IN (" . implode(", ", $_POST[delreport]) . ")");
}
header("Location: index.php?page=reports");
?>
