<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
//    Vote for comments by DiemThuy ( July 2010 )
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


if (!defined("IN_BTIT"))
      die("non direct access!");

require_once $THIS_BASEPATH.'/include/functions.php';

dbconn();

global $CURUSER;

$cid=$CURUSER["uid"];
$id=(int)$_GET['id'];
$hash=$_GET['hash'];
$count=$_GET['count'];

$returnto="index.php?page=torrent-details&id=".$hash;
$points=1;

// can not give points to yourself
$self = do_sqlquery("SELECT cid,user FROM {$TABLE_PREFIX}comments WHERE id ='$id'");
$check = $self->fetch_assoc();

if ($CURUSER['username']==$check['user'])
{
stderr("Nice Try","You can not vote for your own comment !!");
stdfoot();
exit;
}
if ($CURUSER['uid']==$check['cid'])
{
stderr("Sorry","But you have already voted on this comment !!");
stdfoot();
exit;
}

if ($count=="up")
@quickQuery("UPDATE {$TABLE_PREFIX}comments SET  cid='$cid', points = points + '$points' WHERE  id='$id'");

if ($count=="down")
@quickQuery("UPDATE {$TABLE_PREFIX}comments SET cid='$cid', points = points - '$points' WHERE  id='$id'");

header('Location: '.$returnto);
die();
?>
