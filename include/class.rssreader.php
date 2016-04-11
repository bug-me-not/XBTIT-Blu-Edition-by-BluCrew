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

class rss_reader {
    function rss_reader() {
        // constructor
    }

    // private
    // find the content in $text between <$tag> and </$tag>
    function get_tag_value($text, $tag) {
        $StartPos = strpos($text, '<'.$tag)+strlen($tag)+2;
        $EndPos   = strpos($text, '</'.$tag);
        $text=($EndPos > $StartPos)?substr($text, $StartPos, ($EndPos - $StartPos)):'';

        return str_replace(array('<![CDATA[',']]>'), '', $text);
    }

    // input the full rss stream
    // output rss as array
    // array(channel =>
    //      (title,link,description,item=>
    //             array(title,link,description,category,comments,pubDate,guid)))
    function rss_to_array($rss_flux) {
        $fullrss=explode('<channel>',$rss_flux);
        array_shift($fullrss);
        $rss=array();
        $i=0;
        foreach($fullrss as $r) {
            $rss[$i]['title']=$this->get_tag_value($r,'title');
            $rss[$i]['link']=$this->get_tag_value($r,'link');
            $rss[$i]['description']=$this->get_tag_value($r,'description');
            $rss[$i]['copyright']=$this->get_tag_value($r,'copyright');
            $rss[$i]['language']=$this->get_tag_value($r,'language');
            $rss[$i]['lastBuildDate']=$this->get_tag_value($r,'lastBuildDate');
            $items=explode('<item>',$r);
            array_shift($items);
            $j=0;
            foreach($items as $item) {
                $rss[$i]['item'][$j]['title']=$this->get_tag_value($item,'title');
                $rss[$i]['item'][$j]['link']=$this->get_tag_value($item,'link');
                $rss[$i]['item'][$j]['description']=$this->get_tag_value($item,'description');
                $rss[$i]['item'][$j]['category']=$this->get_tag_value($item,'category');
                $rss[$i]['item'][$j]['comments']=$this->get_tag_value($item,'comments');
                $rss[$i]['item'][$j]['pubDate']=$this->get_tag_value($item,'pubDate');
                $rss[$i]['item'][$j]['guid']=$this->get_tag_value($item,'guid');
                $j++;
            }
            $i++;
        }
        return $rss;
    }
}
?>