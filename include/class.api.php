<?php
////////////////////////////////////////////////////////////
// API Management Class
//
// Exmaple
//  
//
//
//
////////////////////////////////////////////////////////////
require_once dirname(__file__)."/class.tvdb.php";
require_once dirname(__FILE__)."/class.fanart.php";

class api
{

    private $imdb;

    private $tvdb;

    private $tvdb_api_key ="84198CDB1D6D23DE"; //Needs to be inserted from Admin CP

    private $fanart_api_key ="05e03e4887f762022f945ee1d27ca627"; //Needs to be inserted from Admin CP

    function __construct($imdb = 0, $tvdb = 0, $tvdb_api, $fanart_api)
    {
        /*
         * This speak to the API identifiers
         */
        $this->imdb = $imdb;
        $this->tvdb = $tvdb;

        /*
         * This places the API keys within the class
         */
         $this->tvdb_api_key = $tvdb_api;
         $this->fanart_api_key = $fanart_api;

    }

    function setImageData()
    {

        if(getPosterData($imdb, $tvdb) == $GLOBALS["uploaddir"]."nocover.jpg")
        {

        }

        if(getBannerData($imdb, $tvdb) == "images/default_fanart.png")
        {

        }

        if(!getDiscArt($imdb, $tvdb))
        {

        }
    }

    function getPosterData($imdb = 0 , $tvdb = 0, $infohash = '')
    {
        global $THIS_BASEPATH;

        $posters = array();
        $poster = $GLOBALS["uploaddir"]."nocover.jpg";

        if($imdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/posters"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/posters/*.*") as $postersFile)
                {
                    $posters[] = str_replace($THIS_BASEPATH."/", "", $postersFile);
                }
            }
        }

        if($tvdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/posters"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/posters/*.*") as $postersFile)
                {
                    $posters[] = str_replace($THIS_BASEPATH."/", "", $postersFile);
                }
            }
        }

        if(strlen($infohash) >= 40)
        {
            if(file_exists($THIS_BASEPATH."/".$GLOBALS['uploaddir'].$infohash))
            {
                $poster = $GLOBALS['uploaddir'].$infohash;
            }
        }

        if(count($posters) > 0 && $infohash == '')
        {
            $rkey = mt_rand(0, (count($posters) - 1));
            $poster = $posters[$rkey];
        }

        unset($rkey);
        unset($posters);

        return $poster;
    }

    function getBannerData($imdb = 0 , $tvdb = 0)
    {
        global $THIS_BASEPATH;

        $banners = array();
        $banner = "images/default_fanart.png";

        if($imdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/banners"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$imdb."/banners/*.*") as $bannersFile)
                {
                    $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
                }
            }
        }

        if($tvdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/banners"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/thetvdb/".$tvdb."/banners/*.*") as $bannersFile)
                {
                    $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
                }
            }

            if(file_exists($THIS_BASEPATH."/images/thetvdb/".$tvdb."/banners"))
            {
                foreach(glob($THIS_BASEPATH."/images/thetvdb/".$tvdb."/banners/*.*") as $bannersFile)
                {
                    $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
                }
            }
        }

        if(count($banners) > 0)
        {
            $rkey = mt_rand(0, (count($banners) - 1));
            $banner = $banners[$rkey];
        }

        unset($rkey);
        unset($banners);

        return $banner;
    }

    function getDiscArt($imdb = 0, $tvdb = 0)
    {
        $dArtS = array();
        $dArt = false;




        return $dArt;
    }

}

?>
