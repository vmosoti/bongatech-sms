<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @license https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

class Config
{
    public static function get()
    {
        return [
            'user_id'          => env('BONGATECH_USER_ID'),
            'password'         => env('BONGATECH_PASSWORD'),
            'sender_id'        => env('BONGATECH_SENDER_ID'),
            'callback_url'     => env('BONGATECH_CALL_BACK_URL'),
        ];
    }
}
