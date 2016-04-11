<?php
////////////////////////////////////////////////////////////
// PHP Class for TVDB
//
// Exmaple
// require dirname(__file__)./'include/class.tvdb.php';
// $tvdb = new tvdb($id,$api_key);
//
//
////////////////////////////////////////////////////////////


class tvdb
{
   private $api_key="";
   private $data;
   private $banners;
   private $url_data;
   private $url_banners;
   public $id;
   public $error='';
   public $error_code;
   public $lang='en.xml';

   function __construct($id,$api_key)
   {
      $this->id=$id;
      $this->api_key=$api_key;
      $this->url_data="http://www.thetvdb.com/api/{$this->api_key}/series/{$this->id}";
      $this->url_banners=$this->url_data."/banners.xml";
   }

   function fetch($banners=FALSE)
   {
      $info_curl;
      $url;

      if($banners)
      $url=$this->url_banners;
      else
      $url=$this->url_data;


      $info_curl=curl_init();
      curl_setopt($info_curl,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($info_curl,CURLOPT_URL,$url);
      $temp=curl_exec($info_curl);

      $this->error_code=curl_getinfo($info_curl,CURLINFO_HTTP_CODE);

      curl_close($info_curl);

      if($this->error_code!=200 || empty($temp))
      {
         $this->error='Unable to get information from TVDB';
         return FALSE;
      }
      else
      {
         if($banners)
         $this->banners=$temp;
         else
         $this->data=$temp;

         return TRUE;
      }
      return FALSE;
   }

   function decode_xml($temp)
   {
      if(!empty($temp))
      return json_decode(json_encode(simplexml_load_string($temp)),true);
      else
      return false;
   }

   public function getimdb()
   {
      $temp=$this->decode_xml($this->data);
      return str_replace("tt","",$temp['Series']['IMDB_ID']);
   }

   public function getseriesid()
   {
      $temp=$this->decode_xml($this->data);
      return $temp['Series']['id'];
   }

   public function getseriesname()
   {
      $temp=$this->decode_xml($this->data);
      return $temp['Series']['SeriesName'];
   }

   public function getfbanner()
   {
      $temp=$this->decode_xml($this->data);
      return ("http://thetvdb.com/banners/{$temp['Series']['banner']}");
   }

   public function get5banners()
   {
      $bann=$this->getallbanners();
      $temp=array();

      $count=((count($bann)>2)?2:count($bann));

      for($i=0;$i<$count;$i++)
      {
         $temp[]=$bann[$i];
      }

      return $temp;
   }

   public function getallbanners()
   {
      $temp=$this->decode_xml($this->banners)['Banner'];
      $bann=array();

      if(is_array($temp))
      {
         foreach($temp as $test)
         {
            if($test['BannerType']=="graphical" || $test["BannerType2"]=="graphical")
            {
               $bann[]=("http://thetvdb.com/banners/".$test['BannerPath']."");
            }
         }
      }

      return $bann;
   }

   public function getposter()
   {
      $temp=$this->decode_xml($this->data);
      return ("http://thetvdb.com/banners/{$temp['Series']['poster']}");
   }
}
?>
