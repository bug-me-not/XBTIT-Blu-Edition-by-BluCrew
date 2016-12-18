<?php
/**
 * MultiCache class class provides a convenient way to work with caches.
 * MultiCacheMemcache is a class for work with memcache storage.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Lesser General Public License for more details.
 *
 * @author    Vadym Timofeyev <tvad@mail333.com> http://weblancer.net/users/tvv/
 * @copyright 2007-2010 Vadym Timofeyev
 * @license   http://www.gnu.org/licenses/lgpl-3.0.txt
 * @version   1.01
 * @since     PHP 5.0
 * @example   examples/memcache/example.php
 */
class MultiCacheMemcache extends MultiCache {
    /**
     * Memcache handler.
     *
     * @var class Memcache
     */
    private $memcache = null;

    /**
     * @var array Memcache statistics
     */
    private $stats = null;

    /**
     * Memcache host.
     *
     * @var string
     */
    public $host = 'localhost';

    /**
     * Memcache port.
     *
     * @var integer
     */
    public $port = 11211;

    /**
     * Is memcached connection persistent or no.
     *
     * @var boolean
     */
    public $isPersistent = true;

    /**
     * Class constructor. Setup primary parameters.
     *
     * @param array $config MultiCacheMemcache config.
     */
    public function __construct($config = array()) {
        $this->memcache = new Memcache();

        if ($this->isPersistent) {
            if (!@$this->memcache->pconnect($this->host, $this->port)) {
                throw new Exception("Don't open memcached server persistent connection!");
            }
        } else {
            if (!@$this->memcache->connect($this->host, $this->port)) {
                throw new Exception("Don't open memcached server connection!");
            }
        }
    }

    /**
     * Class destructor. Closes opened handlers.
     */
    public function __destruct() {
        if ($this->memcache != null && !$this->isPersistent) {
            $this->memcache->close();
        }
    }

    /**
     * Gets data.
     *
     * @param mixed $key The key that will be associated with the item.
     * @param mixed $default Default value.
     *
     * @return mixed Stored data.
     */
    public function get($key, $default = null) {
        $result = $this->memcache->get($key);

        return $result !== false ? $result : $default;
    }

    /**
     * Stores data.
     *
     * @param string  $key    The key that will be associated with the item.
     * @param mixed   $value  The variable to store.
     * @param integer $expire Expiration time of the item. Unix timestamp
     *                        or number of seconds.
     */
    public function set($key, $value, $expire = 0) {
        parent::set($key, $value, $expire);

        $this->memcache->set($key, $value, false, $expire);
    }

    /**
     * Removes data from the cache.
     *
     * @param string $key The key that will be associated with the item.
     */
    public function remove($key) {
        if ($this->memcache->delete($key) &&
            $this->stats && $this->stats['curr_items'] > 0) {
            $this->stats['curr_items']--;
        }
    }

    /**
     * Removes all cached data.
     */
    public function removeAll() {
        if (!$items = $this->getStats('items')) {
            return;
        }

        foreach ($items['items'] as $key => $item) {
            $dump = $this->memcache->getStats(
                        'cachedump',
                        $key,
                        $item['number'] * 2
                    );

            foreach (array_keys($dump) as $ckey) {
                $this->memcache->delete($ckey);
            }
        }

        $this->stats = null;
    }

    /**
     * Cleans expired cached data.
     */
    public function clean() {
        if (!$items = $this->getStats('items')) {
            return;
        }

        foreach ($items['items'] as $key => $item) {
            $dump = $this->memcache->getStats(
                        'cachedump',
                        $key,
                        $item['number'] * 2
                    );

            foreach (array_keys($dump) as $ckey) {
                $this->memcache->get($ckey);
            }
        }

        $this->stats = null;
    }

    /**
     * Gets items count.
     *
     * @return integer Items count.
     */
    public function getItemsCount() {
        return $this->getStats('curr_items');
    }

    /**
     * Gets cached data size.
     *
     * @return integer Cache size, bytes.
     */
    public function getSize() {
        return $this->getStats('bytes');
    }

    /**
     * Gets total cache max size.
     *
     * @return integer Cache maximum size, bytes.
     */
    public function getTotalMaxSize() {
        return $this->getStats('limit_maxbytes');
    }

    /**
     * Gets memcache statistics.
     *
     * @param string $param Statistics paramater.
     *
     * @return array Memcache statistics.
     */
    private function getStats($param = null) {
        if ($this->stats != null) {
            $this->stats = $this->memcache->getStats();
        }

        return $param ? $this->stats[$param] : $this->stats;
    }

    /**
     * Checks CURL extension, etc.
     */
    public static function checkEnvironment() {
        if (!extension_loaded('memcache')) {
            throw new Exception('Memcache extension not loaded');
        }
    }
}