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
$poller = sql_num_rows(do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}blocks WHERE content='poller' AND status=1 LIMIT 1"));
$morescript='<!--[if lt IE 7.]>
<script defer type="text/javascript" src="jscript/pngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="jscript/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="jscript/jquery-migrate-1.2.1.min.js"></script>
<!-- these next 3 scripts are for the new animated collapse -->
<script type="text/javascript" src="jscript/animatedcollapse.js"></script>
<!-- // -->
<script type="text/javascript" src="jscript/xbtit.js"></script>
<script type="text/javascript" src="jscript/TorrentName.js"></script>';

($pageID=="torrent-details")?$morescript.="<script type='text/javascript' src='ajaxstarrater/js/behavior.js'></script>\n<script type='text/javascript' src='ajaxstarrater/js/rating.js'></script>":$morescript.="";
($pageID=='users' || $pageID=='torrents')?$morescript.="\n<script type='text/javascript' src='jscript/suggest.js'></script>":$morescript.="";
($btit_settings["fmhack_shoutcast_stats_and_DJ_application"]=="enabled" && htmlentities($_GET["page"])=='')?$morescript.="\n<script src='radiostats/ajaxradio.js' language='JavaScript' type='text/javascript'></script>":$morescript.="";
($poller==1)?$morescript.="\n<script type='text/javascript' src='jscript/ajax.js'></script>\n<script type='text/javascript' src='jscript/ajax-poller.js'></script>":$morescript.="";
($pageID=='faq')?$morescript.="\n<script src='jscript/faq.js' type='text/javascript'></script>":$morescript.='';
unset($poller);

$morecss="";
($pageID=="torrent-details")?$morecss.="\n<link rel='stylesheet' href='ajaxstarrater/css/rating.css' type='text/css' />":$morecss.="";
($pageID=='faq')?$morecss.="\n<link rel='stylesheet' href='css/faq.css'   type='text/css' />":$morecss.="";
($pageID=='rules')?$morecss.="\n<link rel='stylesheet' href='css/rules.css' type='text/css' />":$morecss.="";

/*head
************
<!-- Christmas Snowstorm 
<script src="jscript/snowstorm.js" type="text/javascript"></script>
<script>snowStorm.excludeMobile = false;</script>
Christmas Snowstorm End-->

<!-- Christmas Header
<link rel="stylesheet" href="css/xmasheader.css">
<script type="text/javascript" src="jscript/newyear.js"></script>
Christmas Header End -->
************

<!-- Christmas Snowstorm 
<script src="jscript/snowstorm.js" type="text/javascript"></script>
<script>snowStorm.excludeMobile = false;</script>
Christmas Snowstorm End-->

body
************
<!-- Christmas Header 
<div class="b-page_newyear">
  <div class="b-page__content">
   новогодняя мотня newyear.html

  <i class="b-head-decor">
  <i class="b-head-decor__inner b-head-decor__inner_n1">
  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>

  <i class="b-head-decor__inner b-head-decor__inner_n2">
  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>
  <i class="b-head-decor__inner b-head-decor__inner_n3">

  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>
  <i class="b-head-decor__inner b-head-decor__inner_n4">
  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>
  <i class="b-head-decor__inner b-head-decor__inner_n5">
  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>
  <i class="b-head-decor__inner b-head-decor__inner_n6">
  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>
  <i class="b-head-decor__inner b-head-decor__inner_n7">
  <div class="b-ball b-ball_n1 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n2 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n3 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n4 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_n5 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n6 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n7 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n8 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_n9 b-ball_bounce"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>

  <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
  </i>
  </i>

</div>
</div>
Christmas Header End -->
************
*/

?>
