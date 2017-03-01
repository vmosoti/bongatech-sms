<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @license https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

use Unirest\Request\Body;
use Unirest\Request as UniRequest;

class Request
{
    /**
     * the request url.
     *
     * @var string
     */
    public $endpoint;
    /**
     * request headers.
     *
     * @var array
     */
    public $headers;

    /**
     * request body.
     *
     * @var array
     */
    public $body;

    /**
     * the response is in form of a string.
     *
     * @var array
     */
    public $response;

    /**
     * Request constructor.
     *
     * @param  $endpoint
     * @param array $headers
     * @param array $body
     */
    public function __construct($endpoint, array $headers, array $body)
    {
        $this->endpoint = $endpoint;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function send()
    {
        return UniRequest::post($this->endpoint, $this->headers, Body::Json($this->body));
    }


}
