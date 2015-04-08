<?php
/**
 * Wynncraft "KarmaKids"
 *
 * @copyright  Wynncraft 2015
 * @author     Chris Ireland <ireland63@gmail.com>
 */

namespace wynncraft\KarmaKids;

use Symfony\Component\Yaml\Yaml;

class FetchKarma
{
    const KARMA_YML = 'ENTERURLHERE';

    /**
     * Fetch the karma data from our database
     *
     * @return array|bool|mixed|resource
     */
    public static function fetch()
    {
        // Fetch using curl cacher
        $karmaData = CurlCache::cache(self::KARMA_YML, 3600);

        // Parse from Yaml to an array
        $karmaData = Yaml::parse($karmaData);

        return $karmaData;
    }

    /**
     * Select a user's karma based on their uuid
     *
     * @param $uuid
     * @return mixed
     */
    public static function user($uuid)
    {
        $karmaData = self::fetch();

        // Get a single user's amount
        $uuidKarma = 0;
        
        if(isset($karmaData[$uuid]['amount'])) {
            $uuidKarma = $karmaData[$uuid]['amount'];
        }

        return $uuidKarma;
    }
} 
