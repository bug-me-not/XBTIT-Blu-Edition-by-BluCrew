<?php 
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2011  Btiteam
//
//    This file is part of xbtit.
//
//    Advanced SEO panel by Atmoner ( 2011 )
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
// Xbtit Seo panel for xbtit by atmoner 2011
// http://xbtit-seo.com 
//
////////////////////////////////////////////////////////////////////////////////////

if (!defined("IN_BTIT"))
      die("non direct access!");
require_once (load_language("lang_seo.php"));

$active_seo = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}seo WHERE id ='1'") or die(sql_error());
$res_seo=@$active_seo->fetch_assoc();	

if ($res_seo["use_meta"] == "true"){
	if( $pageID == 'torrent-details')  {
		$torrent_id = AddSlashes((isset($_GET["torrent_id"])?$_GET["torrent_id"]:false)); 
		$res = do_sqlquery("SELECT filename, comment FROM {$TABLE_PREFIX}files WHERE id ='".$torrent_id."'") or die(sql_error());
		$row = $res->fetch_array();

		// Amelioration bbcode meta description. Thanks petr1 :)
		 function stripBBCode($text_to_search) {
		 $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
		 $replace = '';
		 return preg_replace($pattern, $replace, $text_to_search);
		}

		// Saut de ligne meta description
		$comment=stripBBCode($row["comment"]);
		$find=array('/\n/','/<br>/','/\r/');
		$replace=array('','','');
		$comment=preg_replace($find,$replace,$comment); 

		// Max caractere meta description detail torrent
		// à editer selon l'envie :)
		$max = "150";    
		$comment = substr($comment, 0, $max);

		$split_filename=explode(" ", str_replace(".", " ", strtolower($row["filename"])));
		
		$common_words=array("the", "and", "a", "if", "is", "of"); // retire les mots basique des meta keywords

		$list="";
		foreach($split_filename as $v)
		{
		    if(!in_array($v,$common_words))
			$list.=$v.",";
		}
		$list=trim($list,",");
				  // meta's for torrents details
				  $meta = '<meta name="description" content="'.$comment.'">
				  <meta name="keywords" content="'.$list.'">
				  <meta name="Copyright" content="'.$res_seo["copyright"].'">
				  <meta name="Author" content="'.$res_seo["author"].'">
				  <meta name="Robots" content="'.$res_seo["robots"].'">
				  <meta name="Revisit-After" content="'.$res_seo["revisitafter"].'">';
						} else {

				  //meta for all page
				  $meta = '<meta name="description" content="'.$res_seo["metadesc"].'">
				  <meta name="keywords" content="'.$res_seo["metakeyword"].'">
				  <meta name="Copyright" content="'.$res_seo["copyright"].'">
				  <meta name="Author" content="'.$res_seo["author"].'">
				  <meta name="Robots" content="'.$res_seo["robots"].'">
				  <meta name="Revisit-After" content="'.$res_seo["revisitafter"].'">';
 
		}
 
} 
// Url canonical
if ( $res_seo["cano"] == "true"){ 
$cano = '<link rel="canonical" href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />';
} 
// Google-analytics
if ($res_seo["analytic_active"] == "true"){ 
$analytic = '<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \''.$res_seo["analytic"].'\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>';
} 
// Google-site-verification
if ($res_seo["ggwebmaster_active"] == "true"){ 
$ggwebmaster = '<meta name="google-site-verification" content="'.$res_seo["ggwebmaster"].'" />';
} else {
$cano = '';
$meta = '';
$analytic = '';
$ggwebmaster = '';
}

$tpl->set("cano",$cano);
$tpl->set("meta",$meta);
$tpl->set("analytic",$analytic);
$tpl->set("ggwebmaster",$ggwebmaster);

// Debut de la reecriture des url de la page torrents
$pageSEO=(isset($_GET["page"])?$_GET["page"]:"");

if ($pageSEO == "torrent-details") {
	// Reecriture des torrents (torrent-details.php)
	if ($res_seo["activated"] == "true"){
		if (isset($_GET["id"])){
		$torrent_id = AddSlashes((isset($_GET["id"])?$_GET["id"]:false));
		$resid = do_sqlquery("SELECT filename, id FROM {$TABLE_PREFIX}files WHERE info_hash='$torrent_id'") or die(sql_error());
		$reres_hash=@$resid->fetch_assoc();
 
		// reecriture du titre pour l'url
		$str = $res_seo["str"];
		$strto = $res_seo["strto"];
		$subject = $reres_hash["filename"];
		$url_title = strtr($subject, "$str ", "$strto"); 
		// redirection de la reecriture sans htaccess
		header('Location: '.$url_title.'-'.$reres_hash["id"].'.html');
		exit();
			} else {
		$torrent_id = AddSlashes((isset($_GET["torrent_id"])?$_GET["torrent_id"]:false));
		$torrent_id = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}files WHERE id=$torrent_id") or die(sql_error());
		$reres_hash=@$torrent_id->fetch_assoc();
		$id = $reres_hash["info_hash"]; 
				}
	}else{
		if (isset($_GET["torrent_id"])){
		$torrent_id = AddSlashes((isset($_GET["torrent_id"])?$_GET["torrent_id"]:false));
		$torrent_id = do_sqlquery("SELECT info_hash FROM {$TABLE_PREFIX}files WHERE id=$torrent_id") or die(sql_error());
		$res_hash=@$torrent_id->fetch_assoc();
		$id_url = $res_hash["info_hash"];	
		header('Location: index.php?page=torrent-details&id='.$id_url.'');	
		} else {
		$id = AddSlashes((isset($_GET["id"])?$_GET["id"]:false));
		}
	}
	
	// Sitemap par atmoner	 
	if ($res_seo["active_map"] == "true") {
	$url_ = "http://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
	 
	  $q = "SELECT * FROM {$TABLE_PREFIX}sitemap where url='$url_'";
	  $r = do_sqlquery($q);
	  $quant_r = sql_num_rows($r);
	  if($quant_r >= 1) {
		  $q_1 = "UPDATE {$TABLE_PREFIX}sitemap set nb=nb+1 where url='$url_'";
		  } else {
		    $date_=date("Y-m-d",time());
		    $q_1 = "INSERT INTO `{$TABLE_PREFIX}sitemap` ( `id` , `url` , `date` , `nb` ) VALUES ('', '$url_', '$date_', '1' )";
		  } $r_1 = do_sqlquery($q_1);
	 	}  
 }
	// Fin du Sitemap
	
// Xbtit-seo by atmoner
////////////////////////////////////////////////////////////////////////////////////
//
// End file
// http://xbtit-seo.com 
//
////////////////////////////////////////////////////////////////////////////////////
?>