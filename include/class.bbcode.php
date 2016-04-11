<?php
/* * * * * * * * * * * * * * * * * * * *
* BB Code parser by James Wilson
* Copyright (c) 2007, James Wilson, drakewilson@gmail.com
* Released under GPL, http://www.gnu.org/copyleft/gpl.html
* Site: http://nothingoutoftheordinary.com/scripts/bbcode/
* Example: http://examples.nothingoutoftherordinary.com/bbcode/
* 
* Usage:
* In the files you want to use this, place this code:
* include("bbcode.php");
* Assuming this file is in the same directory
* 
* To parse content, call the function bbcode, like
* bbcode($post)
* Or in an echo statement
* echo bbcode($post);
* 
* Simple as that.
* 
* Valid codes:
* [url=uri]text[/url]
* [url]uri[/url]
* http://site -> link
* [img]imageuri[/img]
* [email]emailaddress[/email]
* [b]text[/b]
* [i]text[/i]
* [u]text[/u]
* [quote]text[/quote]
* [quote=author]text[/quote]
* [color=color]text[/color]
* [color=######]text[/color]
* [size=#]text[/size]
* [list][*]1[*]2[*]3[/list]
* [list=1|a]*]1[*]2[*]3[/list]
* 
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
  return '<span style="font-size: '.(50*$matches[1]).'%">'.$matches[2].'</span>';
}

function noparsed($matches) {
  return str_replace(array('[',']','://'), array('&#91;','&#93;','&#58;&#47;&#47;'),$matches[1]);
}

function formatlist($matches) {
  if ($matches[2]=='') {
    $end='</ul>';
    $content.='<ul>';
  } elseif(is_numeric($matches[2])) {
    $end='</ol>';
    $content.='<ol type="1">';
  } else {
    $end='</ol>';
    $content.='<ol type="a">';
  }

  return $content.str_replace('[*]',"\n".'<li>',$matches[3]).$end;
}

function parseimage($matches) {
  global $img_count;

  $img_count++;
  return "\n<div id=\"img{$img_count}\" style=\"font-size:x-small; display:inline;\">\n<img name=\"img{$img_count}\" onload='resize(this);' src='$matches[1]' border='0' alt='' /></div>";
}

function bbcode($content) {
  // Fix & to be &amp; unless it's already &amp; or a special character like  &#9600;  or some regualr ones like <,>,",(c), . More can be found here: http://www.utexas.edu/learn/html/spchar.html  But they can use the decimal verisons if the want those
  $content=preg_replace('/&(?!(amp|[#0-9]+|lt|gt|quot|copy|nbsp);)/ix','&amp;',$content);

  // But some special chars are bad, at least according to vB, so strip them. Most are just blank characters used to bypass filters, except for &#8238; which is just awesome!
  $content=str_replace(array('&#160;','&#173;','&#8205;','&#8204;','&#8237;','&#8238;'),'',$content);

  // Change new lines to <br />. nl2br function probably would work also. It's probably the same as this though. And gets rid of htmlchars. htmlentities screws up the &amp; stuff.
  $content=str_replace(array('<','>','\'','"',"\r\n","\r","\n"),array('&lt;','&gt;','&#39;','&quot;','<br />','<br />','<br />'),$content);

  // No parse. Just replace [, ], and :// to their HTML equivalents
  $content=preg_replace_callback('/\[noparse\](.+?)\[\/noparse\]/i','noparsed',$content);

  // [url=uri]text[/url]
  $content=preg_replace('(\[(URL|url)\=((http|ftp|https):\/\/[a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\](.+?)\[\/(URL|url)\])', '<a href="$2">$4</a>', $content);
  // For people too lazy to put http:// on the uri. /Shouldn't/ be XSSable
  $content=preg_replace('(\[(URL|url)\=([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\](.+?)\[\/(URL|url)\])', '<a href="http://$2">$3</a>', $content);

  // [url]uri[/url]
  $content=preg_replace('(\[url\]((http|ftp|https):\/\/([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*))\[\/url\])','<a href="$2&#58;&#47;&#47;$3">$2&#58;&#47;&#47;$3</a>',$content);
  // lazy http:// people...
  $content=preg_replace('(\[url\]([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*)\[\/url\])','<a href="http&#58;&#47;&#47;$1">http&#58;&#47;&#47;$1</a>',$content);

  // Images. They have to have http://. src attributes are XSSable in IE 6.0, Netscape, and Opera. http://ha.ckers.org/xss.html. Even though it's hard to do without () or \, best not to mess around with it.

  $content=preg_replace_callback('/\[img\]((http|ftp|https):\/\/([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*))\[\/img\]/i','parseimage',$content);
  $content=preg_replace_callback('/\[img=((http|ftp|https):\/\/([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]*))\]/i','parseimage',$content);

  // http://www.google.com -> <a href="http://www.google.com">http://www.google.com</a>
  $content=preg_replace('/(?<![href|src]=)(["|\']http|ftp|https):\/\/([^(|\s|=|\]|\[|\<|\>)]*["|\'])/i','<a href="$1://$2">$1://$2</a>',$content);

  // Email. Do people even use this?
  $content=preg_replace('(\[email\]([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]+)@([a-zA-Z0-9\/\-\+\?\&\.\=\_\~\#\'\%\;]+)\[\/email\])','<a href="mailto:$1@$2">$1@$2</a>',$content);

  // bold, italics, underline
  while (preg_match('/\[b\](.+?)\[\/b\]/i',$content))
    $content=preg_replace('/\[b\](.+?)\[\/b\]/i','<b>$1</b>',$content);
  while (preg_match('/\[i\](.+?)\[\/i\]/i',$content))
    $content=preg_replace('/\[i\](.+?)\[\/i\]/i','<i>$1</i>',$content);
  while (preg_match('/\[u\](.+?)\[\/u\]/i',$content))
    $content=preg_replace('/\[u\](.+?)\[\/u\]/i','<font style="text-decoration: underline;">$1</font>',$content);
  while (preg_match('/\[br\]/i',$content))
    $content=preg_replace('/\[br\]/i','<br>',$content);

  // font color. Word type, like [color=red]RED[/color]
  while (preg_match('/\[color=([a-z]+)\](.+?)\[\/color\]/i',$content))
    $content=preg_replace('/\[color=([a-z]+)\](.+?)\[\/color\]/i','<font color="$1">$2</font>',$content);
  // Number type, like [color=696969]GREY[/color]
  while (preg_match('/\[color=([0-9]{3,6})\](.+?)\[\/color\]/i',$content))
    $content=preg_replace('/\[color=([0-9]{3,6})\](.+?)\[\/color\]/i','<span style="color: #$1;">$2</span>',$content);

  // code
  while (preg_match('/\[code\](.+?)\[\/code\]/i',$content))
    $content=preg_replace('/\[code\](.+?)\[\/code\]/i','<br /><b>Code</b><br /><table width="100%" border="1" cellspacing="0" cellpadding="10" class="code"><tr><td>\\1</td></tr></table><br />',$content);

  // Quotes!
  global $language;
  while (preg_match('/\[quote\](.+?)\[\/quote\]/i',$content))
    $content = preg_replace('/\[quote\](.+?)\[\/quote\]/i','<br /><b>'.$language['QUOTE'].':</b><br /><table width="100%" border="1" cellspacing="0" cellpadding="10" class="quote"><tr><td >\\1</td></tr></table><br />',$content);
  while (preg_match('/\[quote=(.+?)\](.+?)\[\/quote\]/i',$content))
    $content = preg_replace('/\[quote=(.+?)\](.+?)\[\/quote\]/i','<br /><b>\\1 '.$language['WROTE'].':</b><br /><table width="100%" border="1" cellspacing="0" cellpadding="10" class="quote"><tr><td>\\2</td></tr></table><br />',$content);
  // .userquoteinfo { font-size:85%; font-weight: bold; font-style: italic; }

  // Size. 1,2,3,4 = 75, 125, 175, 225.  Algo: 25 + 50 * size
  while (preg_match('/\[size=([1-7])\](.+?)\[\/size\]/i',$content))
    $content = preg_replace_callback('/\[size=([1-7])\](.+?)\[\/size\]/i','dosize',$content);

  //Lists
  while (preg_match('/\[list(=(a|1))?\](.+?)\[\/list\]/i',$content))
    $content=preg_replace_callback('/\[list(=(a|1))?\](.+?)\[\/list\]/i','formatlist',$content);

  return $content;
}

function dehtml($content) {
  $content=preg_replace('/&(?!(amp|[#0-9]+|lt|gt|quot|copy|nbsp);)/ix','&amp;',$content);
  $content=str_replace(array('&#160;','&#173;','&#8205;','&#8204;','&#8237;','&#8238;'),'',$content);
  return str_replace(array('<','>','\'','"'),array('&lt;','&gt;','&#39;','&quot;'),$content);
}
?>