<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
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
global $CURUSER,$btit_settings,$BASEURL;

$THIS_BASEPATH=dirname(__FILE__);
$USERLANG = $THIS_BASEPATH."/language/english";

require_once('include/functions.php');
if(!$CURUSER || $CURUSER['uid']==1)
{
   redirect($BASEURL);
}
require_once('btemplate/bTemplate.php');
dbconn(true);
include($THIS_BASEPATH.'/index.begin.php');
require($USERLANG."/gallery_lang.php");

if(gallery_in())
{
	$gallery_readmetpl = new bTemplate();

	$gallery_readmetpl->set("sitename",$SITENAME);
	$gallery_readmetpl->set("language",$language);
	$gallery_readmetpl->set("charset",$charset);

	echo $gallery_readmetpl->fetch(load_template("gallery_readme.tpl"));
}
else
{
	ext_err_msg($language["OOPS"],$language["GRP"]);
}

include($THIS_BASEPATH.'/index.end.php');
?>
