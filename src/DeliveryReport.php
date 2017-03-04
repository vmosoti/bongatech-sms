<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @licence https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

class DeliveryReport
{
    /**
     * @return Response
     */
    public static function get()
    {
        $report = json_decode(file_get_contents('php://input'));

        return new Response($report[0]);

    }

}