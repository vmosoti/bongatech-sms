<?php
/**
 * BongaTech SMS Client Library for PHP.
 *
 * @copyright Copyright (c) 2017
 * @author   Vincent Mosoti <vincent@vmosoti.com>
 * @license https://github.com/VMosoti/bongatech-sms/blob/master/LICENSE
 */

namespace VMosoti\BongaTech;

use VMosoti\BongaTech\Exceptions\BongaTechException;

/**
 * Class SMS.
 */
class SMS
{
    /**
     * Version number of the SMS API.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * token is generated by md5(password).
     *
     * @var string
     */
    protected $token;

    /**
     * timestamp is the current datetime.
     *
     * @var string
     */
    protected $timestamp;

    /**
     * type of SMS to sent.
     *
     * @var int message
     */
    protected $message_type;

    /**
     * batch type of the SMS being sent.
     *
     * @var int batch
     */
    protected $batch_type;

    /**
     * sms configurations.
     *
     * @array config
     */
    protected $config;

    /**
     * end point url.
     *
     * @string endpoint
     */
    protected $endpoint;

    /**
     * the message(s) being sent (array of messages in case message is different for each user.
     *
     * @var array.
     */
    protected $message;

    /**
     * the recipients .
     *
     * @var array.
     */
    protected $recipients;

    /**
     * SMS constructor.
     */
    public function __construct()
    {
        $this->config = Config::get();
        $this->setTimestamp();
        $this->setToken();
    }

    /**
     * set the timestamp.
     */
    private function setTimestamp()
    {
        $this->timestamp = date('YmdHis');
    }

    /**
     * set the token.
     */
    private function setToken()
    {
        $this->token = md5($this->config['password']);
    }

    /**
     * invoke if SMS being sent is of type subscribable.
     *
     * @return $this
     */
    public function messageTypeSubscribable()
    {
        $this->message_type = MessageType::SUBSCIBABLE;

        return $this;
    }

    /**
     * invoke if SMS being sent is of type on demand.
     *
     * @return $this
     */
    public function messageTypeOnDemand()
    {
        $this->message_type = MessageType::ON_DEMAND;

        return $this;
    }

    /**
     * invoke if SMS being sent is of type bulk SMS. This will be the common one.
     *
     * @return $this
     */
    public function messageTypeBulk()
    {
        $this->message_type = MessageType::BULK;

        return $this;
    }

    /**
     * invoke if SMS is being sent to a single recipient.
     *
     * @return $this
     */
    public function batchTypeNoBatch()
    {
        $this->batch_type = BatchType::NOT_BATCH;

        return $this;
    }

    /**
     * invoke if SMS is being sent to a different recipients.
     *
     * @return $this
     */
    public function batchTypeSameMessage()
    {
        $this->batch_type = BatchType::SAME_MESSAGE;

        return $this;
    }

    /**
     * invoke if each recipient will receive a different message.
     *
     * @return $this
     */
    public function batchTypeDifferentMessages()
    {
        $this->batch_type = BatchType::DIFFERENT_MESSAGE;

        return $this;
    }

    /**
     * @param $recipients
     * @param  $message
     *
     * @throws BongaTechException
     *
     * @return mixed
     */
    public function send($recipients, $message)
    {
        $this->recipients = $recipients;
        $this->message = $message;
        $this->endpoint = $this->config['base_url'] . $this->config['sms_endpoint'];

        if ($this->batch_type === BatchType::NOT_BATCH) {

            if (is_array($this->message) && array_depth($this->message) == 2 && count($this->message) == 1) {

                if (is_array($this->recipients) && array_depth($this->recipients) == 2 && count($this->recipients) == 1) {

                    $response = $this->sendForNonBatch($this->buildSendObject($this->recipients, $this->message));

                } else {

                    throw new BongaTechException('The recipient MUST be an array of depth 2 and count should not be more than 1');
                }

            } else {

                throw new BongaTechException('Message should be provided as an array whose depth is 2 and count should equal 1');
            }


        } elseif ($this->batch_type === BatchType::SAME_MESSAGE) {

            if (is_array($this->message) && array_depth($this->message) == 2 && count($this->message) == 1) {

                if (is_array($this->recipients) && array_depth($this->recipients) == 2 && count($this->recipients) > 1) {

                    $response = $this->sendForBatch($this->buildSendObject($this->recipients, $this->message));

                } else {

                    throw new BongaTechException('The recipients MUST be an array of depth 2 and count should be more than 1');
                }


            } else {

                throw new BongaTechException('Message should be provided as an array whose depth and count should equal 1');
            }

        } elseif ($this->batch_type === BatchType::DIFFERENT_MESSAGE) {

            if (count($this->recipients) == count($this->message)) {

                if (is_array($this->message) && array_depth($this->message) == 2) {

                    if (is_array($this->recipients) && array_depth($this->recipients) == 2) {

                        $response = $this->sendForBatch($this->buildSendObject($this->recipients, $this->message));

                    } else {

                        throw new BongaTechException('The recipients MUST be an array of depth 2');
                    }

                } else {

                    throw new BongaTechException('Message MUST be an array of depth 2');
                }
            } else {

                throw new BongaTechException('No. of Messages MUST be equal to number of Recipients.');
            }

        } else {

            throw new BongaTechException('Message Batch Type has not been set.');
        }

        return $response;

    }

    /**
     * build the send object.
     *
     * @param  recipients
     * @param $messages
     *
     * @return array
     */
    private function buildSendObject($recipients, $messages)
    {

        $body = [
            'AuthDetails' => [
                [
                    'UserID' => $this->config['user_id'],
                    'Token' => $this->token,
                    'Timestamp' => $this->timestamp

                ]
            ],
            'MessageType' => [
                (string)$this->message_type
            ],
            'BatchType' => [
                (string)$this->batch_type
            ],
            'SourceAddr' => [
                (string)$this->config['sender_id']
            ],
            'MessagePayload' => $messages,
            'DestinationAddr' => $recipients,
            'DeliveryRequest' => [
                [
                    'EndPoint' => $this->config['callback_url'],
                    'Correlator' => mt_rand()
                ]
            ]
        ];

        return $body;


    }

    /**
     * send a message to a single recipient.
     *
     * @param $body
     *
     * @return Response
     */
    private function sendForNonBatch($body)
    {

        $request = new Request($this->endpoint, $body);
        $response = $request->sendSMS();

        return new Response($response->body[0]);

    }

    /**
     * send batch. 1) same message to many recipients 2) different messages to many recipients.
     *
     * @param $body
     *
     * @return Response
     */
    private function sendForBatch($body)
    {

        $request = new Request($this->endpoint, $body);
        $response = $request->sendSMS();

        //return $response->body;

        $responses = [];

        for ($i = 0; $i < count($response->body); $i++) {

            $res = new Response($response->body[$i]);
            $responses = $res;

        }

        return $responses;

    }

    public static function getBalance()
    {
        $config = Config::get();

        $endpoint = $config['base_url'] . $config['balance_endpoint'] . '?UserID=' . $config['user_id'] . '&Token=' . md5($config['password']);

        $request = new Request($endpoint);
        $response = $request->getBalance();

        return new Response($response->body);
    }
}