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
        if (!empty($this->response->ResponseCode)) {
            return $this->response->ResponseCode;
        }
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        if (!empty($this->response->Balance)) {
            return $this->response->Balance;
        }
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        if (!empty($this->response->ResponseDescription)) {
            return $this->response->ResponseDescription;
        }
    }

    /**
     * @return mixed
     */
    public function getMSISDN()
    {
        if (!empty($this->response->MSISDN)) {
            return $this->response->MSISDN;
        }
    }


    /**
     * @return mixed
     */
    public function getCorrelator()
    {
        if (!empty($this->response->Correlator)) {
            return $this->response->Correlator;
        }
    }

    /**
     * @return mixed
     */
    public function getMessageID()
    {
        if (!empty($this->response->MessageID)) {
            return $this->response->MessageID;
        }
    }

    /**
     * @return mixed
     */
    public function getSourceID()
    {
        return $this->response['MessageID'];
    }
}
