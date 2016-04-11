<?php
// PHP Fast File Cache v0.1b
// Written by Åke Wallebom (ake at ake nu)
// Free to use for non-commercial purposes

	// Get all output data and save to cache file
	if ($cache_UpdateCache) {
		if ($cache_fp = fopen($cache_cacheFile . '.new', "wb")) {
			$cache_data = ob_get_contents();
			fwrite($cache_fp, $cache_data, strlen($cache_data));
			fclose($cache_fp);
			rename($cache_cacheFile . '.new', $cache_cacheFile);
		}
		
		// Close and remove the lock-file
		cache_fclose_exclusive($cache_fp_lock);
		$cache_er_old = error_reporting(0);
		unlink($cache_cacheFile . '.lock');
		error_reporting($cache_er_old);

		// The script can now be aborted by the user without any problems		
		ignore_user_abort(false);
	} 
	
	ob_end_flush();
?>
