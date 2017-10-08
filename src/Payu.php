<?php

namespace Payu;

class Payu
{
    const OAUTH_URL = 'https://secure.payu.com/pl/standard/user/oauth/authorize';
    const OAUTH_URL_SANDBOX = 'https://secure.snd.payu.com/pl/standard/user/oauth/authorize';

    const API_URL = 'https://secure.payu.com/api/v2_1/';
    const API_URL_SANDBOX = 'https://secure.snd.payu.com/api/v2_1/';

    private $pos_id;
    private $client_id;
    private $client_secret;

    private $sandbox;
    private $response;

    public function __construct($client_id = null, $client_secret = null, $sandbox = false)
    {
        $this->setPosId($client_id);

        $this->setClientId($client_id);
        $this->setClientSecret($client_secret);

        $this->setSandbox($sandbox);
    }

    public function sendRequest($object)
    {
        $oauth_request = new Request(
            'post',
            $this->getOauthUrl(),
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->getClientId(),
                    'client_secret' => $this->getClientSecret()
                ]
            ]
        );
        $oauth_response = $oauth_request->response->getContent();

//        var_dump($oauth_response);

//        $json = [];
//        $json['merchantPosId'] = $this->getPosId();
//        $json += $object->getParameters();

        $json = array_merge(
            ['merchantPosId' => $this->getPosId()],
            $object->getParameters()
        );

        $request = new Request(
            $object::API_METHOD,
            $this->getApiUrl($object::API_ENDPOINT),
            [
                'headers' => [
                    'Authorization' => $oauth_response->token_type . ' ' . $oauth_response->access_token
                ],
                'allow_redirects' => false,
                'json' => $json
            ]
        );

        $this->setResponse($request->response);

//        return $this->getResponse();
        return $this;
    }

    public function getOauthUrl()
    {
        if ($this->sandbox === true) {
            return self::OAUTH_URL_SANDBOX;
        }

        return self::OAUTH_URL;
    }

    public function getApiUrl($endpoint = null)
    {
        if ($this->sandbox === true) {
            $url = self::API_URL_SANDBOX;
        } else {
            $url = self::API_URL;
        }

        return $url . $endpoint;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param int $client_id
     * @return Payu
     */
    public function setClientId($client_id)
    {
        $this->client_id = (int) $client_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     * @return Payu
     */
    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosId()
    {
        return $this->pos_id;
    }

    /**
     * @param int $pos_id
     * @return Payu
     */
    public function setPosId($pos_id)
    {
        $this->pos_id = (int) $pos_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSandbox()
    {
        return $this->sandbox;
    }

    /**
     * @param bool $sandbox
     * @return Payu
     */
    public function setSandbox($sandbox)
    {
        $this->sandbox = $sandbox;

        return $this;
    }


    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    private function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
