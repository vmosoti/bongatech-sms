<?php
/*
 * BongaTech SMS Client Library for PHP
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @license https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

use VMosoti\BongaTech\SMS;

if (!function_exists('sms')) {
    /**
     * Create a new instance of the SMS class.
     *
     * @return SMS
     */
    function sms()
    {
        return new SMS();
    }
}

if (!function_exists('get_balance')) {
    /**
     * gets the sms units balance.
     *
     * @return \VMosoti\BongaTech\Response
     */
    function get_balance()
    {
        return SMS::getBalance();
    }
}

if (!function_exists('array_depth')) {
    /**
     * returns depth of an array.see http://stackoverflow.com/a/262944.
     *
     * @param  $array
     *
     * @return int
     */
    function array_depth(array $array)
    {
        $max_depth = 1;

        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        return $max_depth;
    }
}
