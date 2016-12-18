<?php
/* * * * * * * * * * * * * * * * * * * *
* BB Code parser by James Wilson
* Copyright (c) 2007, James Wilson, drakewilson@gmail.com
* Released under GPL, http://www.gnu.org/copyleft/gpl.html
* Old Site: http://nothingoutoftheordinary.com/scripts/bbcode/
* Example: http://examples.nothingoutoftheordinary.com/bbcode/
* New Site: http://ja.meswilson.com/bbcode/
* extensive modifications by WormFood, Aug-Sep 2009
*
* the $count feature used in preg_replace, was introduced with php 5.1.0
* if using lower versions of php, then those lines would have to be modified.
*
* Usage:
* In the files you want to use this, place this code:
* include("bbcode.php");
* Assuming this file is in the same directory
*
* To parse content, call the function bbcode, like
* bbcode($post);
* Or in an echo statement
* echo bbcode($post);
*
* Simple as that.
*
* Syntax Notes:
* all tags, that use an equal sign (=), can have their contents enclosed in single
* or double quotes.
* Example: [url="http://somesite.com/"] works the same as [url=http://somesite.com/]
*
* All tags can use an optonal single digit after their name. This is so you
* can have control over nested tags, and maybe help you keep track of which
* tag ends where to make editing easier. This feature is required, if you
* want to have unordered lists and ordered lists mixed together, but I
* can't think of any other cases where this feature is required.
* Example: [center4]centered text[/center4].
*
* The foreground color tags can use an optional fg or fg- before the color name.
* Example: [fg-red], [fgred], [red] and [color='red'] are all equal in function.
* The background color tag, must use bg or bg- before the color name when used as tag
* Example: [bg-blue], [bgblue], and [bg-color=blue] are all equal in function.
*
* Valid codes:
*
* bbcode handling
* [noparse]{text}[/noparse] = {text} is not parsed for bbcodes.
*
* Blocks/sections/areas
* [code]{code text}[/code] = contents are "tt" (teletype) text and are not parsed
* [quote]{text}[/quote] = Enclose {text} in a 'quote' block.
* [quote={author}]{text}[/quote] = Enclose {text} in a 'quote' block, with {author} as the writer.
*
* URL functions
* [img]{imageuri}[/img] = embed image into page
* [img={imageuri}] = embed image into page
* [url={uri}]{text}[/url] = make {text} a link to {uri}
* [url]{uri}[/url] = make {uri} a linl
* http://site -> link = translate bare URL (not in a url tag) into a link
* [email]{emailaddress}[/email]
*
* Text formatting and layout
* [none]{text}[/none] = normal text (cancels existing text processing, normally used within another block)
* [b]{text}[/b] = bold text
* [strong]{text}[/strong] = strong text - usually bold, but can be set with style sheets
* [i]{text}[/i] = italics text
* [em]{text}[/em] = Emphasised text - usually italics, but can be set with style sheets
* [u]{text}[/u] = underline text
* [underline]{text}[/underline] = underline text
* [overline]{text}[/overline] = overline text
* [s]{text}[/s] = strike through text
* [strike]{text}[/strike] = strike through text
* [line-through]{text}[/line-through] = line through text (same as [strike] and [s])
* [sub]{text}[/sub] = Subscript text
* [sup]{text}[/sup] = Superscript text
* [tt]{text}[/tt] = teletype text
*
* Text Size
* [big]{text}[/big] = enclose {text} in html <big> tags. This is different from below.
* [size={#}]{text}[/size] = set text size, where # is a digit from 1 to 8, for 50% to 400% size.
* [size={xx-small|x-small|small|normal|large|x-large|xx-large|smaller|larger}]{text}[/size] = Change {text} to given size. "larger" and "smaller" are relative.
* [xx-small]{text}[/xx-small] = xx-small text
* [x-small]{text}[/x-small] = x-small text
* [small]{text}[/small] = small text
* [normal]{text}[/normal] = normal text
* [large]{text}[/large] = large text
* [x-large]{text}[/x-large] = x-large text
* [xx-large]{text}[/xx-large] = xx-large text
* [smaller]{text}[/smaller] = smaller text
* [larger]{text}[/larger] = larger text
*
* Text alignment
* [left]{text}[/left] = left justified text
* [right]{text}[/right] = right justified text
* [center]{text}[/center] = center justified text
* [justify]{text}[/justify] = right and left justified text
* [pre]{text}[/pre] = pre-formatted text
*
* Colored text handling - 'color' can also be spelled 'colour', and the dash is optional (fgcolor==fg-color)
* [color={######}]{text}[/color] = set text color, where {######} is a 6 digit hex color code
* [color={color}]{text}[/color] = set text color, where {color} is any word between 3 and 25 characters long
*   black, silver, gray, white, maroon, red, purple, fuchsia, green, lime, olive, yellow, navy, blue, teal, aqua.
* [{color}]{text}[/{color}] = set color where {color} is one of the 16 colors defined by w3c
* [fg-{color}]{text}[/fg{color}] = set text color, where {color} is one of the 16 supported w3c colors.
* [bg-color={######}]{text}[/color] = set background color, where {######} is a 6 digit hex color code
* [bg-{color}]{text}[/bg{color}] = set background color, where {color} is one of the 16 supported w3c colors.
*
* Ordered and unordered list
* [list][*]{1}[*]{2}[*]{3}...[/list] = unordered list, using filled in circle bullets
* [list=circle][*]{1}[*]{2}[*]{3}...[/list] = unordered list, using hollow circle bullets
* [list=disc][*]{1}[*]{2}[*]{3}...[/list] = unordered list, using filled in circle bullets
* [list=square][*]{1}[*]{2}[*]{3}...[/list] = unordered list, using filled in square bullets
* [list=1][*]{1}[*]{2}[*]{3}...[/list] = ordered list, using normal numbers
* [list=a][*]{1}[*]{2}[*]{3}...[/list] = Ordered list, using lower case letters
* [list=A][*]{1}[*]{2}[*]{3}...[/list] = Ordered list, using upper case letters
* [list=i][*]{1}[*]{2}[*]{3}...[/list] = Ordered list, using lower case roman numbers
* [list=I][*]{1}[*]{2}[*]{3}...[/list] = Ordered list, using upper case roman numbers
*
* Also included, function dehtml which allows nonparsed content to be outputted out to page safely
* Just call:
* dehtml($post)
* Used for things like textareas:
* echo "<textarea>".dehtml($post)."</textarea>";
* * * * * * * * * * * * * * * * * * * */



$img_count=0;
// 3 functions for the bbcode. Have to be declared outside the function to be able to call bbcode more than once.
function dosize($matches) {
   return '<span style="font-size: '.(50*$matches[3]).'%">'.$matches[4].'</span>';
}

function noparsed($matches) { // any character that is parsed, must be here
   static $replace=array(
      '://' => '&#58;&#47;&#47;',
      '('   => '&#40;',
      ')'   => '&#41;',
      '-'   => '&#45;',
      '/'   => '&#47;',
      ':'   => '&#58;',
      '['   => '&#91;',
      ']'   => '&#93;',
      '_'   => '&#95;',);
      return str_replace( array_keys($replace), array_values($replace) ,$matches[2]);
   }

   function formatlist($matches) {
      if ($matches[3]=='') {
         $content.='<ul>';
         $end='</ul>';
      } elseif(strtolower($matches[3])=="a" || strtolower($matches[3])=="i") {
         $content.="<ol type=\"{$matches[3]}\">";
         $end='</ol>';
      } else {
         $content.="<ul type=\"{$matches[3]}\">";
         $end='</ul>';
      }

      return $content.$matches[4].$end;
   }

   function parseimage($matches) {
      global $img_count;

      $img_count++;
      return "<div id=\"img{$img_count}\" style=\"font-size:'1'; display:inline;\"><img name=\"img{$img_count}\" onload='resize(this);' src='$matches[3]&#58;&#47;&#47;$matches[4]' border='0' alt='' /></div>";
   }

   function bbcode($content) {
      global $language;
      // Fix & to be &amp; unless it's already &amp; or a special character like  &#9600;  or some regualr ones like <,>,",(c), . More can be found here: http://www.utexas.edu/learn/html/spchar.html  But they can use the decimal verisons if the want those
      $content=preg_replace('/&(?!(amp|[#0-9]+|lt|gt|quot|copy|nbsp);)/ix','&amp;',$content);

      // But some special chars are bad, at least according to vB, so strip them. Most are just blank characters used to bypass filters, except for &#8238; which is just awesome!
      $content=str_replace(array('&#160;','&#173;','&#8205;','&#8204;','&#8237;','&#8238;'),'',$content);

      // Change new lines to <br />. nl2br function probably would work also. It's probably the same as this though. And gets rid of htmlchars. htmlentities screws up the &amp; stuff.
      $content=str_replace(array('<','>','\'','"',"\r\n","\r","\n"),array('&lt;','&gt;','&#39;','&quot;','<br />','<br />','<br />'),$content);

      do{ // No parse. Just replace anything that is parsed, into their HTML equivalents
         $content=preg_replace_callback('/\[(noparse(?:\d|))\](.+?)\[\/\1\]/i','noparsed',$content, -1, $count);
      }while($count);

      do{ // code tags must be parsed first, because their contents are not parsed.
         $content=preg_replace('/\[(code(?:\d|))\](.+?)\[\/\1\]/i','<br /><b>Code</b><br /><table width="100%" border="1" cellspacing="0" cellpadding="10" class="code"><tr><td>[tt][noparse9]$2[/noparse9][/tt]</td></tr></table><br />',$content, -1, $count);
      }while($count);
      //[align=(center|left|right|justify)]text[/align]
      $content = preg_replace("/\[align=([a-zA-Z]+)\](.+?)\[\/align\]/is","<div style=\"text-align:\\1\">\\2</div>", $content);

      // Video tag [video=url]
      // YouTube Vids
      $content = preg_replace("/\[video=[^\s'\"<>]*youtube.com.*v=([^\s'\"<>]+)\]/ims", "<object width=\"500\" height=\"410\"><param name=\"movie\" value=\"https://www.youtube.com/v/\\1\"></param><embed src=\"https://www.youtube.com/v/\\1\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"410\"></embed></object>", $content);
      $content = preg_replace("/\[video=[^\s'\"<>]*youtu.be.*\/([^\s'\"<>]+)\]/ims", "<object width=\"500\" height=\"410\"><param name=\"movie\" value=\"https://www.youtube.com/v/\\1\"></param><embed src=\"https://www.youtube.com/v/\\1\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"410\"></embed></object>", $content);
      // Google Vids
      $content = preg_replace("/\[video=[^\s'\"<>]*video.google.com.*docid=(-?[0-9]+).*\]/ims", "<embed style=\"width:500px; height:410px;\" id=\"VideoPlayback\" align=\"middle\" type=\"application/x-shockwave-flash\" src=\"https://video.google.com/googleplayer.swf?docId=\\1\" allowScriptAccess=\"sameDomain\" quality=\"best\" bgcolor=\"#ffffff\" scale=\"noScale\" wmode=\"window\" salign=\"TL\"  FlashVars=\"playerMode=embedded\"> </embed>", $content);

      //[video=http://somesite.com/test.mp4]
      $content = preg_replace("/\[video=((www.|http:\/\/|https:\/\/)[^\s]+(\.mp4))\]/i",
      "<video width=475 height=350 controls><source src='\\1' type='video/mp4'>Your browser does not support the video tag.</video>", $content);

      //[video=http://somesite.com/test.webm]
      $content = preg_replace("/\[video=((www.|http:\/\/|https:\/\/)[^\s]+(\.webm))\]/i",
      "<video width=475 height=350 controls><source src='\\1' type='video/webm'>Your browser does not support the video tag.</video>", $content);

      do{ // code blocks insert the noparse tag. Can't parse the code block first, or you can't use noparse on it.
         $content=preg_replace_callback('/\[(noparse(?:\d|))\](.+?)\[\/\1\]/i','noparsed',$content, -1, $count);
      }while($count);

      // Quotes!
      do{
         $content = preg_replace('/\[(quote(?:\d|))\](.+?)\[\/\1\]/i','<br /><b>'.$language['QUOTE'].':</b><br /><table width="100%" border="1" cellspacing="0" cellpadding="10" class="quote"><tr><td >$2</td></tr></table><br />',$content, -1, $count);
      }while($count);
      do{
         $content = preg_replace('/\[(quote(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)(.+?)\2\](.+?)\[\/\1\]/i','<br /><b>$3 '.$language['WROTE'].':</b><br /><table width="100%" border="1" cellspacing="0" cellpadding="10" class="quote"><tr><td>$4</td></tr></table><br />',$content, -1, $count);
      }while($count);
      // .userquoteinfo { font-size:85%; font-weight: bold; font-style: italic; }

      // Images. They have to have http://. src attributes are XSSable in IE 6.0, Netscape, and Opera. http://ha.ckers.org/xss.html. Even though it's hard to do without () or \, best not to mess around with it.
      $content=preg_replace_callback('/\[(img(?:\d|))\](&quot;|&#(?:0|)39;|"|\'|)(http|https|ftp|ftps):\/\/([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\2\[\/\1\]/i','parseimage',$content);
      $content=preg_replace_callback('/\[(img(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)(http|https|ftp|ftps):\/\/([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\2\]/i','parseimage',$content);

      // [url=uri]text[/url]
      $content=preg_replace('/\[(url(?:\d|))\=(&quot;|&#(?:0|)39;|"|\'|)(http|https|ftp|ftps|ed2k|irc):\/\/([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\2\](.+?)\[\/\1\]/i', '<a href="$3&#58;&#47;&#47;$4" target="_blank">$5</a>', $content);
      // For people too lazy to put http:// on the uri. /Shouldn't/ be XSSable
      $content=preg_replace('/\[(url(?:\d|))\=(&quot;|&#(?:0|)39;|"|\'|)([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\2\](.+?)\[\/\1\]/i', '<a href="http&#58;&#47;&#47;$3" target="_blank">$4</a>', $content);

      // [url]uri[/url]
      $content=preg_replace('/\[(url(?:\d|))\](http|https|ftp|ftps|ed2k|irc):\/\/([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\[\/\1\]/i','<a href="$2&#58;&#47;&#47;$3" target="_blank">$2&#58;&#47;&#47;$3</a>',$content);
      // lazy http:// people...
      $content=preg_replace('/\[(url(?:\d|))\]([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\[\/\1\]/i','<a href="http&#58;&#47;&#47;$2" target="_blank">http&#58;&#47;&#47;$2</a>',$content);

      // http://www.google.com -> <a href="http://www.google.com">http://www.google.com</a>
      $content=preg_replace('/(?<![href|src]=[&quot;|&#(?:0|)39;|"|\'])(http|https|ftp|ftps|ed2k|irc):\/\/([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)/i','<a href="$1://$2" target="_blank">$1://$2</a>',$content);

      // Email. Do people even use this? Yes, so they can get revenge on someone by posting their email address.
      $content=preg_replace('/\[(email(?:\d|))\]([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]+)@([a-z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]+)\[\/\1\]/i','<a href="mailto:$2@$3">$2@$3</a>',$content);

      //[Spoiler]TEXT[/Spoiler]
      $content=preg_replace("/\[Spoiler\]((\s|.)+?)\[\/Spoiler\]/", "<div style=\"padding: 3px;  border: 1px solid #d8d8d8; font-size: 1em;\"><div style=\"text-transform: uppercase; border-bottom: 1px solid #CCCCCC; margin-bottom: 3px; font-size: 0.8em; font-weight: bold; display: block;\"><span onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerHTML = '<b>Spoiler: </b><a href=\'#\' onClick=\'return false;\'>hide</a>'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerHTML = '<b>Spoiler: </b><a href=\'#\' onClick=\'return false;\'>show</a>'; }\" /><b>Spoiler:</b><a href=\"#\" onClick=\"return false;\">show</a></span></div><div class=\"quotecontent\"><div style=\"display: none;\">\\1</div></div></div>",$content);

      // [marquee]Marquee[/marquee]
      $content=preg_replace("/\[scroll=([a-zA-Z ,]+)\]((\s|.)+?)\[\/scroll\]/i","<marquee class=\"tableb\" direction=\"\\1\" scrollamount=\"3\" scrolldelay=\"2\" onmouseover=\"this.stop();\" onmouseout=\"this.start();\">\\2</marquee>",$content);

      do{ // bold, big, italics, strike through, tt, underline, em, strong, subscript, superscript, overline, pre
         $content=preg_replace('/\[((b|big|i|s|strike|tt|u|em|strong|sub|sup|pre)(?:\d|))\](.+?)\[\/\1\]/i','<$2>$3</$2>',$content, -1, $count);
      }while($count);

      do{ // [left], [center], [right] and [justify] tags
         $content=preg_replace('/\[((left|right|center|justify)(?:\d|))\](.+?)\[\/\1\]/i', '<div align="$2">$3</div>',$content, -1, $count);
      }while($count);

      do{ // the color is the tag itself, like [fgyellow]yellow text[/fgyellow], or [fg-blue]blue text[/fg-blue]
         // If the color is the tag itself, like [green], then it must ALWAYS be a whitelist of accepted colors.
         $content=preg_replace('/\[((?:fg|fg-|)(black|silver|gray|white|maroon|red|purple|fuchsia|green|lime|olive|yellow|navy|blue|teal|aqua)(?:\d|))\](.+?)\[\/\1\]/i','<font color="$2">$3</font>',$content, -1, $count);
      }while($count);
      do{ // font color. Word type, like [color=red]RED[/color] not limited in name, for backwards compatability.
         $content=preg_replace('/\[((?:fg|fg-|)colo(?:u|)r(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)([a-z]{3,25})\2\](.+?)\[\/\1\]/i','<font color="$3">$4</font>',$content, -1, $count);
      }while($count);
      do{ // Color specified in RGB triplet, like [color=696969]GREY[/color]
         $content=preg_replace('/\[((?:fg|fg-|)colo(?:u|)r(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)([\dA-F]{3,6})\2\](.+?)\[\/\1\]/i','<span style="color: #$3;">$4</span>',$content, -1, $count);
      }while($count);

      // background colors
      do{ // but since the bgcolor tag is new, I will limit the colors, for maximum web compatability. Of course you can set any color you like with the RGB background tag. Maybe remove color whitelist, dependong on user feedback.
         $content=preg_replace('/\[((?:bg|bg-)colo(?:u|)r(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)(black|silver|gray|white|maroon|red|purple|fuchsia|green|lime|olive|yellow|navy|blue|teal|aqua)\2\](.+?)\[\/\1\]/i','<span style="background: $3;">$4</span>',$content, -1, $count);
      }while($count);
      do{ // This background tag uses the following syntax, for a red background: [bgred] or [bg-red]
         $content=preg_replace('/\[((?:bg|bg-)(black|silver|gray|white|maroon|red|purple|fuchsia|green|lime|olive|yellow|navy|blue|teal|aqua)(?:\d|))\](.+?)\[\/\1\]/i','<span style="background: $2;">$3</span>',$content, -1, $count);
      }while($count);
      do{ // background color specified in RGB triplet, like [bg-color=ff0000]red background[/bg-color]
         $content=preg_replace('/\[((?:bg|bg-)colo(?:u|)r(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)([0-9A-F]{3,6})\2\](.+?)\[\/\1\]/i','<span style="background: #$3;">$4</span>',$content, -1, $count);
      }while($count);


      do{ // Size. 1,2,3,4...8 = 50%, 100%, 150%, 200%...400%  Algo: 50 * size
         $content = preg_replace_callback('/\[(size(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)([1-8])\2\](.+?)\[\/\1\]/i','dosize',$content, -1, $count);
      }while($count);
      do{ // [size=xx-small] style tag
         $content = preg_replace('/\[(size(?:\d|))=(&quot;|&#(?:0|)39;|"|\'|)((xx-small|x-small|small|medium|large|x-large|xx-large|larger|smaller)(?:\d|))\2\](.+?)\[\/\1\]/i','<font style="font-size: $4;">$5</font>',$content, -1, $count);
      }while($count);
      do{ // [xx-large] style tag
         $content = preg_replace('/\[((xx-small|x-small|small|medium|large|x-large|xx-large|larger|smaller)(?:\d|))\](.+?)\[\/\1\]/i','<font style="font-size: $2;">$3</font>',$content, -1, $count);
      }while($count);

      //Lists
      do{ // [list] or [list=a] or [list=circle] etc
         $content=preg_replace_callback('/\[(list(?:\d|))(?:=(&quot;|&#(?:0|)39;|"|\'|)(a|i|1|disc|square|circle)\2|)\](.+?)\[\/\1\]/i','formatlist',$content, -1, $count);
      }while($count);

      // just some little things I thought might be nice to have.
      static $replace=array(
         "  "   => " &nbsp;",
         "[*]"  => "<li>",
         "[hr]" => "<hr>",
         "[br]" => "<br />",
         "(c)"  => "&copy;",
         "[c]"  => "&copy;",
         "(p)"  => "&#8471;",
         "[p]"  => "&#8471;",
         "(r)"  => "&reg;",
         "[r]"  => "&reg;",
         "(tm)" => "&trade;",
         "[tm]" => "&trade;",
         "1/2"  => "&frac12;",
         "1/3"  => "&#8531;",
         "2/3"  => "&#8532;",
         "1/4"  => "&frac14",
         "3/4"  => "&frac34;",
         "1/5"  => "&#8533;",
         "2/5"  => "&#8534;",
         "3/5"  => "&#8535;",
         "4/5"  => "&#8536;",
         "1/6"  => "&#8537;",
         "5/6"  => "&#8538;",
         "1/8"  => "&#8539;",
         "3/8"  => "&#8540;",
         "5/8"  => "&#8541;",
         "7/8"  => "&#8542;"
      );
      $content=str_ireplace(array_keys($replace), array_values($replace) ,$content);



      return $content;
   }

   function dehtml($content) {
      $content=preg_replace('/&(?!(amp|[#0-9]+|lt|gt|quot|copy|nbsp);)/ix','&amp;',$content);
      $content=str_replace(array('&#160;','&#173;','&#8205;','&#8204;','&#8237;','&#8238;'),'',$content);
      return str_replace(array('<','>','\'','"'),array('&lt;','&gt;','&#39;','&quot;'),$content);
   }
   ?>
