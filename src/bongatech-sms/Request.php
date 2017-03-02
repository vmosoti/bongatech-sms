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
    public function __construct($endpoint, array $headers = null, array $body = null)
    {
        $this->endpoint = $endpoint;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function send()
    {
        return UniRequest::post($this->endpoint, null, Body::Json($this->body));
    }

    public function getBalance()
    {

        return UniRequest::get($this->endpoint);
    }


}
