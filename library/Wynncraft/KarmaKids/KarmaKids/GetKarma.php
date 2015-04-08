<?php
/**
 * Wynncraft "KarmaKids"
 *
 * @copyright  Wynncraft 2013 - 2015
 * @author     Chris Ireland <ireland63@gmail.com>
 * @author     Alvin Dela Paz <himynameisaj@me.com>
 */

namespace wynncraft\KarmaKids;


class GetKarma
{
    const UUID_API = 'http://mcuuid.com/api/';

    /**
     * Convert a username to a uuid and get their karma
     *
     * @param $username
     * @return mixed
     */
    public static function go($username)
    {
        // Get UUID
        $uuid = CurlCache::cache(self::UUID_API . $username, 3600);
        $uuid = json_decode($uuid, true);
        $uuid = $uuid["uuid"];

        // Get karma
        $userKarama = FetchKarma::user($uuid);

        return $userKarama;

    }
}
