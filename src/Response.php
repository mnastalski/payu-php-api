<?php

namespace Payu;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    private $response;

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
    }

    public function getContent()
    {
        return json_decode($this->response->getBody(), false);
    }

    public function getStatusCode()
    {
        return strtolower($this->getContent()->status->statusCode);
    }

    public function getOrderId()
    {
        return $this->getContent()->orderId;
    }

    public function getRedirectUri()
    {
        return $this->getContent()->redirectUri;
    }

    public function doRedirect()
    {
        header('Location: ' . $this->getRedirectUri());
        exit;
    }
}
