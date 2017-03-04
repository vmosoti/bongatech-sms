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
        return !empty($this->response->ResponseCode) ? $this->response->ResponseCode : '';
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return !empty($this->response->Balance ? $this->response->Balance : '');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return !empty($this->response->ResponseDescription) ? $this->response->ResponseDescription : '';
    }

    /**
     * @return mixed
     */
    public function getMSISDN()
    {
        return !empty($this->response->MSISDN) ? $this->response->MSISDN : '';
    }


    /**
     * there are some inconsistencies in the names of objects returned.
     *
     * @return mixed
     */
    public function getCorrelator()
    {
        $correlator = '';

        if (!empty($this->response->Correlator)) {

            $correlator = $this->response->Correlator;

        } elseif (!empty($this->response->correlator)) {

            $correlator = $this->response->correlator;

        }
        return $correlator;


    }

    /**
     * there are some inconsistencies in the names of objects returned.
     *
     * @return mixed
     */
    public function getMessageID()
    {
        $msgid = '';

        if (!empty($this->response->MessageID)) {

            $msgid = $this->response->MessageID;

        } elseif (!empty($this->response->msg_id)) {

            $msgid = $this->response->msg_id;

        }
        return $msgid;
    }

    /**
     * @return mixed
     */
    public function getSourceID()
    {
        return !empty($this->response->source_id) ? $this->response->source_id : '';
    }

    /**
     * @return mixed
     */
    public function getReport()
    {
        return !empty($this->response->dlr_report) ? $this->response->dlr_report : '';
    }


}
