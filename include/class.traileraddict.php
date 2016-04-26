<?PHP
////////////////////////////////////////////////////////////
// PHP Class for Trailer Addict
//
// http://www.traileraddict.com/
//
// Exmaple
// require dirname(__file__)./'include/class.traileraddict.php';
// $taddict = new trailerAddict($imdb);
//
//
////////////////////////////////////////////////////////////

class trailerAddict
{
	private $imdb = '';
	private $url = '';
	private $data;
	public $error_code;
	public $error;

	function __construct($imdb)
	{
		$this->imdb = $imdb;
		$this->url = "http://api.traileraddict.com/?imdb={$imdb}&count=1&credit=no";

		$this->fetch();
	}

	function fetch()
	{
		$curl;
		$url = $this->url;

		$curl = curl_init();
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_URL,$url);
		$temp = curl_exec($curl);

		$this->error_code = curl_getinfo($curl,CURLINFO_HTTP_CODE);

		curl_close($curl);

		if($this->error_code != 200 || empty($temp))
		{
			$this->error = 'Unable to get information from TVDB';
			return FALSE;
		}
		else
		{
			$this->data = $temp;
			return TRUE;
		}
		return FALSE;
	}

	function getTrailer()
	{
		$temp_array = array();
		$data = $this->data;

		$temp = simplexml_load_string($data);

		foreach($temp->trailer as $x => $updates)
		{
			$temp_array[] = $updates->embed;
		}

		return $temp_array;
	}

	/*function setCache()
	{
		$data = $this->getTrailer();

		write_file(realpath(dirname(__FILE__)."/..")."/cache/addict{$this->imdb}.txt",$data);
	}

	function getCache()
	{
		$file = realpath(dirname(__FILE__)."/..")."/cache/addict{$this->imdb}.txt";

		if(file_exists($file))
		{
			return file_get_contents($file);
		}

		return FALSE;
	}*/
}

?>