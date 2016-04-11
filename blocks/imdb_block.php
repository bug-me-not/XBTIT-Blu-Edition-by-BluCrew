<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2015  Btiteam 
//
//    This file is part of xbtit DT (DC) FM - 05/2014 DiemThuy.
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
?>
<link type="text/css" href="jscript/jquery-ui-1.9.2.css" rel="stylesheet" />
<script type="text/javascript" src="jscript/jquery.min1.9.js"></script>
<script type="text/javascript" src="jscript/jquery-ui-1.9.2.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();
$j (function(){
    $j ("#search").focus(); //Focus on search field
    $j ("#search").autocomplete({
        minLength: 0,
        delay:5,
        source: "suggest.php",
focus: function( event, ui ) {
$j (this).val( ui.item.label );
return false;
},
select: function( event, ui ) {
window.location = "index.php?page=torrents&search=" + ui.item.label + "&category=0&active=0";
return false;
}
    }).data("uiAutocomplete")._renderItem = function( ul, item ) {
        return $j("<li></li>")
            .data( "item.autocomplete", item )
            .append( "<a>" + (item.img?"<img class='imdbImage' src='imdbImage.php?url=" + item.img + "' />":"") + "<span class='imdbTitle'>" + item.label + "</span>" + (item.cast?"<br /><span class='imdbCast'>" + item.cast + "</span>":"") + "<div class='clear'></div></a>" )
            .appendTo( ul );
    };
});
</script>
<style type="text/css">
.ui-menu-item .imdbTitle{
 
    font-size: 0.9em;
    font-weight: bold;
    
}
.ui-menu-item .imdbCast{
    font-size: 0.7em;
    font-style: italic;
    line-height: 110%;
    color: #666;
}
.ui-menu-item .imdbImage{
    float: left;
    margin-right: 5px;
}
.ui-menu-item .clear{
    clear: both;
}
</style>
<center>
<div align="center" style="background-image:url(images/im.jpg);padding:23px;width:410px;height:22px;border:1px solid black;">

        <form id="form" name="torrent_search" method="get" action="index.php" style="text-align:center; margin-bottom:20px;margin-left: 200px;">
        
        <input type="hidden" name="page" value="torrents" />
        <input name="search" id="search" type="text" size="20" />
        <input name="category" value="0" type="hidden" />
        <input name="active" value="0" type="hidden" />
        <input name="s" value="all" type="hidden" />
        <input name="submit" type="submit" value="go" />
        </form>
</div>
</center>        