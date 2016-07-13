<?php 

namespace SparksCoding\MovieInformation;

/**
 * Movie Information Class
 *
 * A PHP wrapper for the OMDb API (http://www.omdbapi.com/)
 *
 * @version   1.0.1
 * @author    Matt Sparks <matt@sparkscoding.com>
 * @copyright 2015 Sparks Coding Company (http://sparkscoding.com)
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

class MovieInformation
{
	/**
	 * API URL
	 * @var string
	 */
	protected $apiUrl = 'https://www.omdbapi.com/';

	/**
	 * Movie Title or IMDB ID
	 * @var array
	 */
	protected $movieId;

	/**
	 * Class Options
	 * @var array
	 */
	protected $options;

	/**
	 * Unfiltered API results
	 * @var array
	 */
	private $unfilteredResults;

	/**
	 * Type of Entertainment
	 * @var string
	 */
	public $type;

	/**
	 * Movie Title
	 * @var string
	 */
	public $title;

	/**
	 * Movie Year
	 * @var string
	 */
	public $year;

	/**
	 * Movie Rating
	 * @var string
	 */
	public $rating;

	/**
	 * Movie Release Date
	 * @var string
	 */
	public $released;

	/**
	 * Movie Runtime
	 * @var string
	 */
	public $runtime;

	/**
	 * Movie Genre
	 * @var string
	 */
	public $genre;

	/**
	 * Movie Director(s)
	 * @var string
	 */
	public $director;

	/**
	 * Movie Writer(s)
	 * @var string
	 */
	public $writer;

	/**
	 * Movie Actors
	 * @var string
	 */
	public $actors;

	/**
	 * Movie Plot
	 * @var string
	 */
	public $plot;

	/**
	 * Movie Language
	 * @var string
	 */
	public $language;

	/**
	 * Movie Country
	 * @var string
	 */
	public $country;

	/**
	 * Movie Awards
	 * @var string
	 */
	public $awards;

	/**
	 * Movie Poster
	 * @var string
	 */
	public $poster;

	/**
	 * Movie Metascore
	 * @var string
	 */
	public $metascore;

	/**
	 * Movie IMDB Rating
	 * @var string
	 */
	public $imdbRating;

	/**
	 * Movie IMDB Votes
	 * @var string
	 */
	public $imdbVotes;

	/**
	 * Movie IMDB ID
	 * @var string
	 */
	public $imdbID;

	/**
	 * Rotten Tomates Meter
	 * @var string
	 */
	public $tomatoMeter;

	/**
	 * Rotten Tomates Image
	 * @var string
	 */	
	public $tomatoImage;

	/**
	 * Rotten Tomates Rating
	 * @var string
	 */	
	public $tomatoRating;

	/**
	 * Rotten Tomates Number of Reviews
	 * @var string
	 */	
	public $tomatoReviews;

	/**
	 * Rotten Tomates Number of Fresh Reviews
	 * @var string
	 */	
	public $tomatoFresh;

	/**
	 * Rotten Tomates Number of Rotten
	 * @var string
	 */	
	public $tomatoRotten;

	/**
	 * Rotten Tomates Consensus
	 * @var string
	 */	
	public $tomatoConsensus;

	/**
	 * Rotten Tomates User Meter
	 * @var string
	 */	
	public $tomatoUserMeter;

	/**
	 * Rotten Tomates User Rating
	 * @var string
	 */	
	public $tomatoUserRating;

	/**
	 * Rotten Tomates Number of User Reviews
	 * @var string
	 */	
	public $tomatoUserReviews;

	/**
	 * DVD Release Date
	 * @var string
	 */
	public $dvd;

	/**
	 * Box Office
	 * @var string
	 */
	public $boxOffice;

	/**
	 * Production Company
	 * @var string
	 */
	public $production;

	/**
	 * Movie Website
	 * @var string
	 */
	public $website;

	/**
	 * All returned data
	 * @var array
	 */
	public $all;

	/**
	 * Class Constructor
	 *
	 * Make API call, parse information
	 *
	 * @param string $movieID The title or IMDB id
	 * 
	 */
	public function __construct($movieId, $options = array())
	{
		// Set Movie ID
		$this->movieId = $movieId;

		// Set Options
		$this->options = $options;

		// Make API request
		$this->unfilteredResults = $this->makeRequest();

		// Parse Results
		$this->parseResults();
	}

	/**
	 * Return empty string for undefined properties.
	 * 
	 * @return string
	 */
	public function __get($name)
	{
		return isset($this->$name) ? $this->name : '';
	}

	/**
	 * Make the API URL
	 * @return string $url API url
	 */
	private function makeApiUrl()
	{
		$url     = $this->apiUrl . '?';
		$options = '';

		// Determine if we're using an IMDB ID or a movie title.
		if(preg_match('/^(tt)[A-Za-z0-9]+/', $this->movieId))
		{
			$type = 'i=';
		}
		else
		{
			$type = 't=';
		}

		// Sort through the options
		foreach($this->options as $option=>$value)
		{
			$options .= '&' . $option . '=' . urlencode($value);
		}

		// Build final URL
		$url = $url . $type . urlencode($this->movieId) . $options;

		return $url;
	}

	/**
	 * Make simple cURL request.
	 * 
	 * @return object $result The movie's information
	 */
	private function makeRequest()
	{		
		// cURL Resource
		$ch = curl_init();

		// cURL Options
		$curlOptions = [];

		// Parameters
		$params = [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $this->makeApiUrl(),
		];

		// Set Parameters
		$curlOptions = $params;

		// Set Options
		curl_setopt_array($ch, $curlOptions);

		// Execute Call
		$result = curl_exec($ch);
		
		// Close
		curl_close($ch);

		return json_decode($result);
	}

	/**
	 * Parse API Results
	 * @return
	 */
	private function parseResults()
	{
		// Array of keys to make entirely lowercase
		$makeLowercase = ['DVD'];

		foreach($this->unfilteredResults as $key=>$value)
		{
			if(in_array($key, $makeLowercase))
			{
				$key = strtolower($key);
			}
			else
			{
				// Make camel case
				$key = lcfirst($key);				
			}

			// Set class property
			$this->$key = $value;

			// Add to "all" array
			$this->all[$key] = $value;
		}
	}

	/**
	 * Get Value
	 * 
	 * @param  string  $key     Requested item
	 * @param  boolean $asArray Return the results as an array
	 * @return mixed            
	 */
	public function get($key, $asArray = false)
	{
		return $asArray ? explode(',', $this->$key) : $this->$key;
	}

	/**
	 * Get Multple Properties
	 * 
	 * @param  array  $keys properties
	 * @return array
	 */
	public function getMultiple($keys = array())
	{
		// If $keys isn't an array, return.
		if(!is_array($keys)) return;

		$properties = [];

		foreach($keys as $key)
		{
			if(property_exists($this, $key))
			{
				$properties[$key] = $this->$key;
			}
		}

		return $properties;
	}

	/**
	 * Get All Information
	 *
	 * @param  bool $asJson return data as JSON
	 * @return array
	 */
	public function getAll($asJson = false)
	{		
		return $asJson ? json_encode($this->all) : $this->all;
	}


}