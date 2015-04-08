<?php
/**
 * Wynncraft "KarmaKids"
 *
 * @copyright  Wynncraft 2015
 * @author     Chris Ireland <ireland63@gmail.com>
 */

namespace wynncraft\KarmaKids;


class CurlCache
{
    /*
        simpleCachedCurl V1.1
        Dirk Ginader
        http://ginader.com
        Copyright (c) 2013 Dirk Ginader
        Dual licensed under the MIT and GPL licenses:
        http://www.opensource.org/licenses/mit-license.php
        http://www.gnu.org/licenses/gpl.html
        code: http://github.com/ginader
        easy to use cURL wrapper with added file cache
        usage: created a folder named "cache" in the same folder as this file and chmod it 777
        call this function with 3 parameters:
            $url (string) the URL of the data that you would like to load
            $expires (integer) the amound of seconds the cache should stay valid
            $debug (boolean, optional) write debug information for troubleshooting

        returns either the raw cURL data or false if request fails and no cache is available
        */
    public static function cache($url, $expires)
    {

        $hash = md5($url);
        $filename = __DIR__ .  '/cache/' . $hash . '.cache';
        $changed = file_exists($filename) ? filemtime($filename) : 0;
        $now = time();
        $diff = $now - $changed;

        if (!$changed || ($diff > $expires)) {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $rawData = curl_exec($ch);
            curl_close($ch);
            if (!$rawData) {

                if ($changed) {
                    $cache = unserialize(file_get_contents($filename));
                    return $cache;
                } else {

                    return false;
                }
            }

            $cache = fopen($filename, 'wb');
            $write = fwrite($cache, serialize($rawData));

            fclose($cache);
            return $rawData;
        }

        $cache = unserialize(file_get_contents($filename));
        return $cache;
    }
}
