<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

class africa
{

private $apiKey = 'xxxxxxxxxxxxxxxxxxxxxx';
public function __construct()
{
    $this->apiKey;
    $this->apiKey2;
}

    public function service_one($number, $message)
    {
        //first service
        $username = 'xxxxxxxx';
        $AT   = new AfricasTalking($username, $this->apiKey);
        $sms      = $AT->sms();
        $result = $sms->send([
            'to' => $number,
            'message' => $message
        ]);

        return print_r($result);

    }


}
