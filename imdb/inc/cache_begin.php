<?php
// PHP Fast File Cache v0.1b
// Written by Åke Wallebom (ake at ake nu)
// Free to use for non-commercial purposes

	$cache_cacheDirectory = './imdb/cache/';
	
	if (!isset($cache_refreshTime)) {
		$cache_refreshTime = 30; // seconds to keep a cached copy
	}

	/////
	// No configuration beyond this line
	/////

	function cache_fopen_exclusive($id) {
		if ($fp = fopen($id, "ab+")) {
			if (flock($fp, LOCK_EX | LOCK_NB)) {
				return $fp;
			} else {
				fclose($fp);
			}
		}
		
		return false;
	}
	
	function cache_fclose_exclusive($fp) {
		flock($fp, LOCK_UN);
		fclose($fp);
	}

	// Create cache file name

		
		$cache_id = md5($_SERVER['SCRIPT_FILENAME']) . '_imdb_' . md5($movieid);
	
	$cache_cacheFile = $cache_cacheDirectory . $cache_id . '.cache.html';

	$cache_FileExists = file_exists($cache_cacheFile);
	$cache_FileIsFresh = $cache_FileExists && (time() - filemtime($cache_cacheFile) < $cache_refreshTime);

	// Check if cache file is usable or not
	if ($cache_FileIsFresh) {
		$cache_UseCache = true;
	} else {
		$cache_UseCache = false;
		if ($cache_fp_lock = cache_fopen_exclusive($cache_cacheFile . '.lock')) {
			// We got the lock, create new cache
			$cache_UpdateCache = true;
		} else {
			// We didn't get the lock, use old file or regenerate
			$cache_UseCache = $cache_FileExists;
			$cache_UpdateCache = false;
		}
	}	

	// Output cached content
	if ($cache_UseCache) {
		// Display the cached file
		readfile($cache_cacheFile);
		exit;
	}
	
	// We will update the cache file and should not abort if the user cancels the request
	if ($cache_UpdateCache) {
		ignore_user_abort(true);
	}
	
	// We need to regenerate the page...
	ob_start();
?>