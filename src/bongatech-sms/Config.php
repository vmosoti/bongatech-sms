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

    static public function get()
    {
        return collect([
            'user_id' => env('BONGATECH_USER_ID'),
            'password' => env('BONGATECH_PASSWORD'),
            'sender_id' => env('BONGATECH_SENDER_ID'),
            'callback_url' => env('BONGATECH_CALL_BACK_URL'),
            'base_url' => env('BONGATECH_BASE_URL'),
            'sms_endpoint' => env('BONGATECH_SEND_SMS_END_POINT'),
            'balance_endpoint' => env('BONGATECH_GET_BALANCE_END_POINT')
        ]);
    }
}
