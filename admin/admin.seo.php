<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend Xbtit Seo panel
//
// Copyright (C) 2004 - 2011  Btiteam
//
//    This file is part of xbtit.
//
//    Advanced Url rewriting by Atmoner ( 2011 )
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
//
////////////////////////////////////////////////////////////////////////////////////
//
// Xbtit Seo panel for xbtit by atmoner 2011
// http://xbtit-seo.com
//
////////////////////////////////////////////////////////////////////////////////////

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");
global $language;
require_once("include/functions.php");
require_once("include/config.php");
require(load_language("lang_seo.php"));

dbconn();

//Here we will select the data from the table seo
$settings = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}seo WHERE id ='1'") or die(sql_error());
$seopanel=@$settings->fetch_assoc();


// test rewrite
if (in_array("mod_rewrite", apache_get_modules())) {
    $testrew = "<font color=\"green\"><img src=\"style/xbtit_default/images/success.gif\">mod_rewrite installed</font>";
} else {
    $testrew = "<font color=\"red\"><img src=\"images/smilies/thumbsdown.gif\"> &nbsp; mod_rewrite NOT installed</font>";
}
$admintpl->set("testrew", $testrew);
// End test rewrite

// Name of website
$admintpl->set("website",$btit_settings["url"]);

// Absolute path and remove folder "admin"
$pathserv = realpath(dirname(__FILE__));
$rpl = array("admin");
$pathserv__ = str_replace($rpl, "", "$pathserv");
$admintpl->set("pathserv","$pathserv__");

// Default Name of sitemap
$admintpl->set("name_sitemap",$seopanel["namemap"]);

// Count url in databse
$query_site = "SELECT COUNT(*) FROM {$TABLE_PREFIX}sitemap";
$result_site = do_sqlquery($query_site) or die('Sorry, we could not count the number of results: ' . sql_error());
$url_db = $result_site->fetch_row()[0];
$admintpl->set("url_db","$url_db");

// Test chmod and create if no existe sitemap.xml
if ($f=fopen($seopanel["namemap"], 'a')){
$chmod = "<font color=\"green\"><img src=\"style/xbtit_default/images/success.gif\" alt=\"success\">chmod OK</font>";
$admintpl->set("boutonmap","<input type=\"submit\" name=\"action\" value=\"Create sitemap\" />");
	} else {
$chmod = "<br /><font color=\"red\">No chmod</font>";
$admintpl->set("boutonmap","<font color=\"red\">Please check the chmod of ".$seopanel["namemap"]."</font><br /><br />");
}
$admintpl->set("chmod","$chmod");
fclose($f);


//***** start action *****//

$action = AddSlashes((isset($_GET["action"])?$_GET["action"]:false));
// update seo settings in the database
if($action == 'url')
    {
  	    $SEO1   =   $_POST["seo_user"];
        $SEO2   =   $_POST["seo"];
       	$SEO3	=   $_POST['str'];
       	$SEO4	=   $_POST['strto'];


    quickQuery("UPDATE `{$TABLE_PREFIX}seo` SET `activated`='".$SEO2."',`activated_user`='".$SEO1."',`str`='".$SEO3."',`strto`='".$SEO4."' WHERE `id`='1' ") or sqlerr();
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=seo#url");
	exit();
}

// update meta in the database
if($action == 'meta')
    {

          $META1   =   $_POST["metadesc"];
          $META2   =   $_POST["metakeyword"];
          $META3   =   $_POST["copyright"];
          $META4   =   $_POST["author"];
          $META5   =   $_POST["robots"];
          $META6   =   $_POST["revisitafter"];
	      $META7   =   $_POST["meta"];
          $META8   =   $_POST['cano'];


    quickQuery("UPDATE `{$TABLE_PREFIX}seo` SET `metadesc`='".$META1."',`metakeyword`='".$META2."',`copyright`='".$META3."',`author`='".$META4."',`robots`='".$META5."',`revisitafter`='".$META6."',`cano`='".$META8."',`use_meta`='".$META7."' WHERE `id`='1' ") or sqlerr();
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=seo#meta");
	exit();
}

// update seo google in the database
if($action == 'google')
    {

          $GOOGLE1   =   $_POST["analytic"];
          $GOOGLE2   =   $_POST["ggwebmaster"];
          $GOOGLE3   =   $_POST["analytic_active"];
          $GOOGLE4   =   $_POST["ggwebmaster_active"];


    quickQuery("UPDATE `{$TABLE_PREFIX}seo` SET `analytic`='".$GOOGLE1."',`ggwebmaster`='".$GOOGLE2."',`analytic_active`='".$GOOGLE3."',`ggwebmaster_active`='".$GOOGLE4."' WHERE `id`='1' ") or sqlerr();
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=seo#google");
	exit();
}
// update options sitemap in the database
if($action == 'optsitemap')
    {

          $SITEMAP1   =   $_POST["max_url"];
          $SITEMAP2   =   $_POST["name_sitemap"];
          $SITEMAP3   =   $_POST["active_map"];
          /*$SITEMAP4   =   $_POST["ggwebmaster_active"];*/


    quickQuery("UPDATE `{$TABLE_PREFIX}seo` SET `maxurl`='".$SITEMAP1."',`namemap`='".$SITEMAP2."',`active_map`='".$SITEMAP3."' WHERE `id`='1' ") or sqlerr();
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=seo#sitemap");
    exit();
}
// update seo sitemap in the database

if($action == 'sitemap')
    {

$fichier = $seopanel["namemap"]; // name of sitemap
$changefreq = $_POST['changefreq']; // changefreq
$priority = $_POST['priority']; // priority
$website = $btit_settings["url"]; // website

$mapcreated = "<a href=\"$website/$fichier\" target=\"_BLANK\">Look at your Sitemap : $fichier</a>";
$submit_goo = "<a href=\"http://google.com/ping?sitemap=$website/$fichier\" target=\"_BLANK\">Submit Sitemap to Google</a>";
$submit_ask = "<a target=\"_new\" rel=\"nofollow\" href=\"http://submissions.ask.com/ping?sitemap=$website/$fichier\" target=\"_BLANK\">Submit Sitemap to Ask</a>";




//$fp= fopen($path.$fichier,"w");
$fp= fopen($path.$fichier,"w");
$sitemap="<?xml version=\"1.0\" encoding=\"UTF-8\"?><?xml-stylesheet type=\"text/xsl\" href=\"$website/sitemap/sitemap.xsl\"?>\n";
$sitemap.="<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

$query = "SELECT COUNT(*) FROM {$TABLE_PREFIX}sitemap";
$result = do_sqlquery($query) or die('Sorry, we could not count the number of results: ' . sql_error());
$url_db = $result->fetch_row()[0];

	$liste= do_sqlquery("SELECT url,date FROM `{$TABLE_PREFIX}sitemap` order by id limit 0,".$seopanel["maxurl"].""); // LIMIT --> nombre d'url max
	while(list($a,$b) = $liste->fetch_array())
	{
	   $a = str_replace('&','&amp;',$a);
	  $sitemap.="\t<url>\n";
	      $sitemap.="\t\t<loc>$a</loc>\n";
	      $sitemap.="\t\t<lastmod>$b</lastmod>\n";
	      $sitemap.="\t\t<changefreq>$changefreq</changefreq>\n";

	      $sitemap.="\t\t<priority>$priority</priority>\n";
	   $sitemap.="\t</url>\n";
	}
	$sitemap.="</urlset>\n";
	fwrite($fp,$sitemap);
	fclose($fp);
  redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=seo#sitemap");
}
$mapcreated = "<a href=\"$website/".$seopanel["namemap"]."\" target=\"_BLANK\">Look at your Sitemap : $fichier</a>";
$submit_goo = "<a href=\"http://google.com/ping?sitemap=$website/".$seopanel["namemap"]."\" target=\"_BLANK\">Submit Sitemap to Google</a>";
$submit_ask = "<a target=\"_new\" rel=\"nofollow\" href=\"http://submissions.ask.com/ping?sitemap=$website/".$seopanel["namemap"]."\" target=\"_BLANK\">Submit Sitemap to Ask</a>";


$admintpl->set("mapcreated",$mapcreated);
$admintpl->set("submit_goo",$submit_goo);
$admintpl->set("submit_ask",$submit_ask);
// End of create sitemap

// On - Off

    $admintpl->set("language", $language);

	// canonical
        if ($seopanel["cano"] =='true')
    {
    $canoyes="checked";
    }
    else if  ($seopanel["cano"] =='false')
    {
    $canono="checked";
    }
	// activation rewite torrent
        if ($seopanel["activated"] =='true')
    {
    $seoyes="checked";
    }
    else if  ($seopanel["activated"] =='false')
    {
    $seono="checked";
    }
	// activation rewite users
        if ($seopanel["activated_user"] =='true')
    {
    $seo_useryes="checked";
    }
    else if  ($seopanel["activated_user"] =='false')
    {
    $seo_userno="checked";
    }
       //activation meta
        if ($seopanel["use_meta"] =='true')
    {
    $metayes="checked";
    }
    else if  ($seopanel["use_meta"] =='false')
    {
    $metano="checked";
    }
       // Activation google analytic
        if ($seopanel["analytic_active"] =='true')
    {
    $analyticyes="checked";
    }
    else if  ($seopanel["analytic_active"] =='false')
    {
    $analyticno="checked";
    }
       // Activation google webmaster
        if ($seopanel["ggwebmaster_active"] =='true')
    {
    $ggwebmasteryes="checked";
    }
    else if  ($seopanel["ggwebmaster_active"] =='false')
    {
    $ggwebmasterno="checked";
    }
       // Activation sitemap
        if ($seopanel["active_map"] =='true')
    {
    $active_mapyes="checked";
    }
    else if  ($seopanel["active_map"] =='false')
    {
    $active_mapno="checked";
    }

$admintpl->set("seo","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=seo value=true  ".$seoyes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=seo value=false ".$seono." /></td>");
$admintpl->set("seo_user","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=seo_user value=true  ".$seo_useryes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=seo_user value=false ".$seo_userno." /></td>");
$admintpl->set("cano","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=cano value=true  ".$canoyes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=cano value=false ".$canono." /></td>");
$admintpl->set("meta","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=meta value=true  ".$metayes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=meta value=false ".$metano." /></td>");
$admintpl->set("active_map","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=active_map value=true  ".$active_mapyes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=active_map value=false ".$active_mapno." /></td>");
$admintpl->set("str", $seopanel["str"]);
$admintpl->set("strto", $seopanel["strto"]);
$admintpl->set("metakeyword", $seopanel["metakeyword"]);
$admintpl->set("metadesc", $seopanel["metadesc"]);
$admintpl->set("copyright", $seopanel["copyright"]);
$admintpl->set("author", $seopanel["author"]);
$admintpl->set("robots", $seopanel["robots"]);
$admintpl->set("revisitafter", $seopanel["revisitafter"]);
// Google
$admintpl->set("analytic", $seopanel["analytic"]);
$admintpl->set("ggwebmaster", $seopanel["ggwebmaster"]);
$admintpl->set("analytic_active","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=analytic_active value=true  ".$analyticyes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=analytic_active value=false ".$analyticno." /></td>");
$admintpl->set("ggwebmaster_active","<td class=lista>&nbsp;&nbsp;Yes&nbsp;<input type=radio name=ggwebmaster_active value=true  ".$ggwebmasteryes." />&nbsp;&nbsp;No&nbsp;<input type=radio name=ggwebmaster_active value=false ".$ggwebmasterno." /></td>");
// Sitemap
$admintpl->set("maxurl", $seopanel["maxurl"]);


// Form
$admintpl->set("frm_action_rewrite", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seo&amp;action=url");
$admintpl->set("frm_action_meta", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seo&amp;action=meta");
$admintpl->set("frm_action_google", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seo&amp;action=google");
$admintpl->set("frm_action_sitemap", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seo&amp;action=sitemap");
$admintpl->set("frm_action_optsitemap", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seo&amp;action=optsitemap");


// Xbtit-seo by atmoner
////////////////////////////////////////////////////////////////////////////////////
//
// End file
// http://xbtit-seo.com
//
////////////////////////////////////////////////////////////////////////////////////
?>
