<?php
/**
 * Wynncraft "KarmaKids"
 *
 * @copyright  Wynncraft 2015
 * @author     Chris Ireland <ireland63@gmail.com>
 */

class Wynncraft_KarmaKids_index
{

    public static function render()
    {
        // Grab composer's autoloader to init our system
        require 'vendor/autoload.php';

        // Get a user's karma, this has further logic - trust me ;)
        $userkarma = \wynncraft\KarmaKids\GetKarma::go(func_get_arg(1));
        
        echo $userkarma;
    }
}
