<?php
///////////////////////////////////////
//
//
//
//
//
///////////////////////////////////////

global $btit_settings, $CURUSER;

$action = (isSet($_GET['action']) && $_GET['action'] == "search") ? "search" : null;
$name = (isSet($_GET['name']) && $_GET['name'] != '') ? sql_esc($_GET['name']) : null;
$imdb = (isSet($_GET['imdb']) && preg_match("/^tt\d+$/i",$_GET['imdb']) == 1) ? sql_esc(str_replace('tt','',$_GET['imdb'])) : null;
$covers = (isSet($_GET['type']) && ($_GET['type'] == 'both' || $_GET['type'] == 'banners' || $_GET['type'] == 'posters') ) ? sql_esc($_GET['type']) : 'both';
$uploader = (isSet($_GET['uploader']) && ($_GET['uploader'] == 'both' || $_GET['uploader'] == 'system' || $_GET['uploader'] == 'user') ) ? sql_esc($_GET['uploader']) : 'both';

$gallerytpl = new bTemplate();

$where = '';

if($action == 'search')
{
	if(!empty($name))
		$where .= "";
	if(!empty($imdb))
		$where .= "";

	$where .= "";

}

$query = get_result("",true,$btit_settings['cache_duration']);

if(count($query) > 0)
{
	$gallerytpl->set("has_images",true,true);

	$img_count = 0;
	$images = array();

	foreach($query as $result) 
	{

		$images[$img_count]['count'] = $img_count;
		$images[$img_count]['name'] = "";
		$images[$img_count]['href'] = "";

		$img_count++;
	}
}
else
{
	$gallerytpl->set("has_images",false,true);
}

?>