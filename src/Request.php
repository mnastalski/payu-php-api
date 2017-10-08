<?php

namespace Payu;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request
{
    private static $client;

    public $request;
    public $response;

    public function __construct($method, $url, $options = [])
    {
        $this->send($method, $url, $options);
    }

    private function send($method, $url, $options = [])
    {
        try {
            $request = Request::getClient()->request($method, $url, $options);
            $this->response = new Response($request);
        } catch (ClientException $e) {
            print $e->getMessage();
        }
    }


    private static function getClient()
    {
        if (!self::$client) {
            self::setClient();
        }

        return self::$client;
    }

    private static function setClient()
    {
        self::$client = new Client();
    }
}
