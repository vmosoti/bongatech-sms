<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @licence https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

/**
 * Class Response.
 */
class Response
{
    /**
     * the response.
     *
     * @var array
     */
    protected $response;

    /**
     * Response constructor.
     *
     * @param array response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return (!empty($this->response->ResponseCode) ? $this->response->ResponseCode : '');
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return (!empty($this->response->Balance ? $this->response->Balance : ''));
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return (!empty($this->response->ResponseDescription) ? $this->response->ResponseDescription : '');
    }

    /**
     * @return mixed
     */
    public function getMSISDN()
    {
        return (!empty($this->response->MSISDN) ? $this->response->MSISDN : '');
    }


    /**
     * @return mixed
     */
    public function getCorrelator()
    {
        return (!empty($this->response->Correlator) ? $this->response->Correlator : '');
    }

    /**
     * @return mixed
     */
    public function getMessageID()
    {
        return (!empty($this->response->MessageID) ? $this->response->MessageID : '');
    }

    /**
     * @return mixed
     */
    public function getSourceID()
    {
        return (!empty($this->response->SourceID) ? $this->response->SourceID : '');
    }
}
