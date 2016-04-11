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
// You can see there are plenty of extra spaces for more menu links,
// you will need to simply create a language setting for your links and then insert them into
// the menu, as I have below. (TreetopClimber)
//
////////////////////////////////////////////////////////////////////////////////////
global $CURUSER, $btit_settings, $language;
print ("<div id='menu'>\n<ul class='level1'>");

if($btit_settings["alt_news"] == "enabled")
{
print ("<li class='level1-li'><a href=\"javascript:logincollapse.toggle('news')\" />".$language["MNU_NEWS"]."</a></li>\n");
}
if($btit_settings["alt_rules"] == "enabled")
	if($btit_settings["altrulestype"] == "kcdon"){
   print ("<li class='level1-li'><a href=\"javascript:logincollapse.toggle('rules')\" />".$language["MNU_RULES"]."</a></li>\n"); 
}
else
{
	if($btit_settings["altrulestype"] == "kcdoff"){	
print ("<li class='level1-li'><a href=\"javascript:logincollapse.toggle('rules_custom')\" />".$language["MNU_RULES"]."</a></li>\n");
}
}
if($btit_settings["alt_faq"] == "enabled")
	if($btit_settings["altfaqtype"] == "kcdon"){	
print ("<li class='level1-li'><a href=\"javascript:logincollapse.toggle('faq')\" />".$language["MNU_FAQ"]."</a></li>\n");
}
else
{
	if($btit_settings["altfaqtype"] == "kcdoff"){	
print ("<li class='level1-li'><a href=\"javascript:logincollapse.toggle('faq_custom')\" />".$language["MNU_FAQ"]."</a></li>\n");
}
}

print ("</ul><!--[if lte IE 6]></td></tr></table></a><![endif]--></li>");
print ("</div>");

?>