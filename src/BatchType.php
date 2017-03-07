<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @license https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

class BatchType
{
    const   NOT_BATCH = 0; // to a single recipient
    const   BATCH = 1; // one message to many recipients or each recipient receives own messages
}
