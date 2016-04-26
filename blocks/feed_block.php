<center>
<div class="fb-like-box" data-href="https://www.facebook.com/facedatabg" data-width="1000" data-height="250" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
</center>

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

block_begin("RSS-News");
?>
<table style="width: 100%; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-image: initial; border-collapse: collapse; " width="" align="center"><tbody><tr><td style="border-image: initial; width: 50%; text-align: center; border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid; border-top-color: black; border-top-width: 1px; border-top-style: solid; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid; letter-spacing: 0px; word-spacing: 0px; "><?php
 # ganbox.com: парсва RSS новини	в масив arrFeeds
        $url='http://traileraddict.com/rss'; # адрес на RSS хранилката
        $doc = new DOMDocument();
	$doc->load($url);
	$arrFeeds = array();
	foreach ($doc->getElementsByTagName('item') as $node) {
		$itemRSS = array (
			'title'=>$node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' =>$node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' =>$node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' =>$node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($arrFeeds, $itemRSS);
	}

        # ganbox.com: отпечатване на feedLimit на брой новини от масива arrFeeds
        $feedLimit=10; # ако feedLimit=0 се показват всичките
        $feedCount=0;
        foreach($arrFeeds as $oneItem){
            # foreach($oneItem as $key=>$value){$oneItem[$key]=iconv('utf-8','cp1251',$value);}
            $feedCount++;
            print '<div class="feedItem"><h3 class="feedTitle"><a href="'.$oneItem['link'].'
                class="feedLink">'.$oneItem['title'].'</a></h3>';
            print '<p class="feedDesc">'.$oneItem['desc'].'</p>';
            print '</div>';
            if($feedLimit>0 && $feedCount>=$feedLimit) break;
        }
?></td><td style="border-image: initial; width: 50%; text-align: center; border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid; border-top-color: black; border-top-width: 1px; border-top-style: solid; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid; letter-spacing: 0px; word-spacing: 0px; " rowspan="1"><?php
 # ganbox.com: парсва RSS новини	в масив arrFeeds
        $url='http://http://traileraddict.com/rss'; # адрес на RSS хранилката
        $doc = new DOMDocument();
	$doc->load($url);
	$arrFeeds = array();
	foreach ($doc->getElementsByTagName('item') as $node) {
		$itemRSS = array (
			'title'=>$node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' =>$node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' =>$node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' =>$node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($arrFeeds, $itemRSS);
	}

        # ganbox.com: отпечатване на feedLimit на брой новини от масива arrFeeds
        $feedLimit=10; # ако feedLimit=0 се показват всичките
        $feedCount=0;
        foreach($arrFeeds as $oneItem){
            # foreach($oneItem as $key=>$value){$oneItem[$key]=iconv('utf-8','cp1251',$value);}
            $feedCount++;
            print '<div class="feedItem"><h3 class="feedTitle"><a href="'.$oneItem['link'].'
                class="feedLink">'.$oneItem['title'].'</a></h3>';
            print '<p class="feedDesc">'.$oneItem['desc'].'</p>';
            print '</div>';
            if($feedLimit>0 && $feedCount>=$feedLimit) break;
        }
?></td></tr></tbody></table>
<?php
block_end();
?>