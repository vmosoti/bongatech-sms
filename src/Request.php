<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @license https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

use Unirest\Request as UniRequest;
use Unirest\Request\Body;

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
    public $headers = null;

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
     * @param array $body
     */
    public function __construct($endpoint, array $body = null)
    {
        $this->endpoint = $endpoint;
        $this->body = $body;
        $this->headers = $headers = [
            'Accept' => 'application/json',
        ];
    }

    public function sendSMS()
    {
        return UniRequest::post($this->endpoint, $this->headers, Body::Json($this->body));
    }

    public function getBalance()
    {
        return UniRequest::get($this->endpoint);
    }
}
