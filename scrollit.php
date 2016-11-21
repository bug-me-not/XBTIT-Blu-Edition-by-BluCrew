<?php

/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2009  Btiteam
//
//    This file is part of xbtit.
//
// Torrent Request & Vote by miskotes  - converted to XBTIT-2 by DiemThuy - March 2009
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

require_once('include/functions.php'); //collect some required functions

dbconn(true); // get an sql connection

global $BASEURL, $TABLE_PREFIX, $btit_settings; //collect some global settings


$THIS_BASEPATH=dirname(__FILE__); // make sure were in the correct directory


 // get user's style
$resheet=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]."");
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
}
else
    {
        $resstyle=mysql_fetch_array($resheet);
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
}

//automatic or manual scrolling?
if($btit_settings["infinite_auto"]=="true"){
    // THIS IS NEW CODE FOR THE AUTOMATIC INFINITE CAROUSEL
    $auto="var autoscrolling = true;";
	$auto2="// THIS IS NEW CODE FOR THE AUTOMATIC INFINITE CAROUSEL
            $(this).bind('next', function () {
                gotoPage(currentPage + 1);
            });";
    }else{
	$auto="var autoscrolling = false;";
	$auto2="";
	}
	
	if($btit_settings["infinite_ext"]=="true"){
    // external torrents?
    $ext="";
	
    }else{
	$ext="AND external='no'";
	
	}

	//some extra headers and css make sure it looks ok since its not defined...
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Infinite Carousel</title>
<link rel="stylesheet" type="text/css" href="<?php echo $STYLEURL;?>/main.css" />
<style type="text/css" media="screen">
<!--
body { font: 1em "Trebuchet MS", verdana, arial, sans-serif; font-size: 100%; }
input, textarea { font-family: Arial; font-size: 125%; padding: 7px; }
label { display: block; } 

a:link {color: transparent; text-decoration: underline; border:0; }
a:active {color: transparent; text-decoration: underline; border:0; }
a:visited {color: transparent; text-decoration: underline; border:0; }
a:hover {color: transparent; text-decoration: none; border:0; }

.infiniteCarousel {
 height:120px;
	/*margin:0 auto;*/
	width:830px;
	overflow:hidden;
}


.infiniteCarousel .wrapper {
  width: 90%; /* .infiniteCarousel width - (.wrapper margin-left + .wrapper margin-right) */
  overflow:hidden;
  min-height: 10em;
  margin: 0 40px;
  position: absolute;
  top: 0;
}

.infiniteCarousel ul a img {
  border: 3px solid #000;
  -moz-border-radius: 5px;
  -webkit-border-radius: 0px;
}

.infiniteCarousel .wrapper ul {
  width: 9999px;
  list-style-image:none;
  list-style-position:outside;
  list-style-type:none;
  margin:0;
  padding:0;
  position: absolute;
  top: 0;
}

.infiniteCarousel ul li {
  display:block;
  float:left;
  padding: 10px;
  height: 85px;
  width: 85px;
}

.infiniteCarousel ul li a img {
  display:block;
}



.infiniteCarousel .arrow {
  
  height: 36px;
  width: 37px;
  background: url(<?php echo $BASEURL;?>/static/images/arrow.png) no-repeat 0 0;
  text-indent: -999px;
  position: absolute;
  top: 37px;
  cursor: pointer;
}

.infiniteCarousel .forward {
  background-position: 0 0;
  right: 0;
 

}

.infiniteCarousel .back {
  background-position: 0 -72px;
  left: 0;
   
}

.infiniteCarousel .forward:hover {
  background-position: 0 -36px;
}

.infiniteCarousel .back:hover {
  background-position: 0 -108px;
}

-->
</style>

<script src="static/js/scroll.js"></script>





</head>
<body style="background:inherit;">
<?php


//No Guests allowed and can they view torrents?
if($CURUSER["uid"]>1 && $CURUSER["view_torrents"]=="yes")
{
    //collect the results of torrents with an image and we dont really want externals...
    $query="SELECT info_hash, filename, image FROM {$TABLE_PREFIX}files WHERE image <> '' ".$ext." ORDER BY data DESC limit 30";
    $result=@mysql_query($query);// execute the query
    $num = @mysql_num_rows($result);// get the amount
    {
   ?>
     
       
     
     <div class="infiniteCarousel">
	 
      <div class="wrapper">
	  
        <ul>
        
        
        <?php
		


    if ($num>0)//if the amount is over 0


    {
            while($row = mysql_fetch_assoc($result))// fetch the result.
      {
       $t_name  = substr(htmlspecialchars($row[filename]), 0, 30)."...";// shorten the filename to 30 characters
       
       $name=$row["filename"];
       $image=$row["image"];
      
  ?>

          <li> <a href="index.php?page=torrent-details&id=<?php echo $row["info_hash"]; ?>" target="_top" title="<?php echo $name;?>"><img src="torrentimg/<?php echo $image;?>" width='85' height='110'></a></li>
          <?php
     }} else{//if no torrents num is below 0


         echo "<li><b></b></li><li><b></b></li><li><b></b></li><li><b></b></li><li><img src='images/nothing.jpg' width='85' height='110'></li>";


     }
  ?>
         </ul> 
		 
        </div>  
     
 </div>  
    
 <?php
     }
    }
	//build the jquery script so it all runs like it should...
   ?>
   <script>
(function () {
    $.fn.infiniteCarousel = function () {
        function repeat(str, n) {
            return new Array( n + 1 ).join(str);
        }
        
        return this.each(function () {
            // magic!
            var $wrapper = $('> div', this).css('overflow', 'hidden'),
                $slider = $wrapper.find('> ul').width(9999),
                $items = $slider.find('> li'),
                $single = $items.filter(':first')
                
                singleWidth = $single.outerWidth(),
                visible = Math.ceil($wrapper.innerWidth() / singleWidth),
                currentPage = 1,
                pages = Math.ceil($items.length / visible);
                
            /* TASKS */
            
            // 1. pad the pages with empty element if required
            if ($items.length % visible != 0) {
                // pad
                $slider.append(repeat('<li class="empty" />', visible - ($items.length % visible)));
                $items = $slider.find('> li');
            }
            
            // 2. create the carousel padding on left and right (cloned)
            $items.filter(':first').before($items.slice(-visible).clone().addClass('cloned'));
            $items.filter(':last').after($items.slice(0, visible).clone().addClass('cloned'));
            $items = $slider.find('> li');
            
            // 3. reset scroll
            $wrapper.scrollLeft(singleWidth * visible);
            
            // 4. paging function
            function gotoPage(page) {
                var dir = page < currentPage ? -1 : 1,
                    n = Math.abs(currentPage - page),
                    left = singleWidth * dir * visible * n;
                
                $wrapper.filter(':not(:animated)').animate({
                    scrollLeft : '+=' + left
                }, 500, function () {
                    // if page == last page - then reset position
                    if (page > pages) {
                        $wrapper.scrollLeft(singleWidth * visible);
                        page = 1;
                    } else if (page == 0) {
                        page = pages;
                        $wrapper.scrollLeft(singleWidth * visible * pages);
                    }
                    
                    currentPage = page;
                });
            }
            
            // 5. insert the back and forward link
           $wrapper.after('<a class="arrow back">&lt;</a><a class="arrow forward">&gt;</a>');
            
            // 6. bind the back and forward links
            $('a.back', this).click(function () {
                gotoPage(currentPage - 1);
                return false;
            });
            
            $('a.forward', this).click(function () {
                gotoPage(currentPage + 1);
                return false;
            });
            
            $(this).bind('goto', function (event, page) {
                gotoPage(page);
            });
            
            //auto?
			<?php echo $auto2;?>
        });
    };
})(jQuery);



$(document).ready(function () {
<?php //automatic or not?   
echo $auto;?>
    $('.infiniteCarousel').infiniteCarousel().mouseover(function () {
        autoscrolling = false;
    }).mouseout(function () {
        autoscrolling = true;
    });
    
    setInterval(function () {
        if (autoscrolling) {
            $('.infiniteCarousel').trigger('next');
        }
    }, 30000);
});

</script>
</body>
</html>
<?php
// EOF
?>