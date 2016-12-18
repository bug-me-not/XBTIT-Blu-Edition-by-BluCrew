<?php
/**
 * MultiCache class class provides a convenient way to work with caches.
 * It can use local file system, memcache or other external storage.
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
 */
abstract class MultiCache {
    /**
     * Cache max size, bytes.
     * If maxSize == -1 use cache driver specific value for cache max size.
     *
     * @var integer
     */
    public $maxSize = 0;

    /**
     * Cache max items count.
     *
     * @var integer
     */
    public $maxItemsCount = 0;

    /**
     * Cleans cache frequency factor.
     *
     * Clean cache operation will start randomly with random factor N
     * if cache overflow.
     *
     * @var integer
     */
    public $cleanCacheFactor = 10;

    /**
     * Gets data.
     *
     * @param mixed $key     The key that will be associated with the item .
     * @param mixed $default Default value.
     *
     * @return mixed Stored data.
     */
    public abstract function get($key, $default = null);

    /**
     * Stores data.
     *
     * @param string  $key    The key that will be associated with the item.
     * @param mixed   $value  The variable to store.
     * @param integer $expire Expiration time of the item. Unix timestamp or
     *                        number of seconds.
     */
    public function set($key, $value, $expire = null) {
        // Check cache limits
        $err = null;

        if (($m = $this->getMaxItemsCount()) && $this->getItemsCount() >= $m) {
            $err = "Maximum items count attained!";
        }

        if (($m = $this->getMaxSize()) && $this->getSize() >= $m) {
            $err = "Maximum items count attained!";
        }

        // Check error
        if ($err != null) {
            // Check clean cache factor
            if ($this->cleanCacheFactor > 0 && mt_rand(0, $this->cleanCacheFactor - 1) == 0) {
                $this->clean();

                // Secondary check cache limits
                if ((!($m = $this->getMaxItemsCount()) || $this->getItemsCount() < $m) &&
                    (!($m = $this->getMaxSize()) || $this->getSize() < $m))
                {
                    return;
                }
            }
            throw new Exception($err);
        }
    }

    /**
     * Removes data from the cache.
     *
     * @param string $key The key that will be associated with the item.
     */
    public abstract function remove($key);

    /**
     * Removes all cached data.
     */
    public abstract function removeAll();

    /**
     * Cleans expired cached data.
     */
    public abstract function clean();

    /**
     * Gets items count.
     *
     * @return integer Items count
     */
    public abstract function getItemsCount();

    /**
     * Gets cached data size.
     *
     * @return integer Cache size, bytes.
     */
    public abstract function getSize();

    /**
     * Gets cache max size. If maxSize == -1 use cache driver specific value
     * of cache max size.
     *
     * @return integer Cache maximum size, bytes.
     */
    public function getMaxSize() {
        return $this->maxSize >= 0 ? $this->maxSize : $this->getTotalMaxSize();
    }

    /**
     * Gets total cache max size.
     *
     * @return integer Cache maximum size, bytes.
     */
    public function getTotalMaxSize() {
        return 0;
    }

    /**
     * Gets max items count.
     *
     * @return integer Maximum items count.
     */
    public function getMaxItemsCount() {
        return $this->maxItemsCount;
    }
}