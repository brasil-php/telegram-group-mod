<?php

namespace Telegram\Sdk;

use GuzzleHttp\Client;

class Api
{
    private $token;
    private $client;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->client = new Client;
    }

    public function request(string $endpoint, array $form_params = [])
    {
        $url = 'https://api.telegram.org/bot%s/%s';
        $url = sprintf($url, $this->token, $endpoint);
        $data = [
            'form_params' => $form_params
        ];
        return $this->client->request('POST', $url, $data)
            ->getBody();
    }

    public function __call($endpoint, $params)
    {
        array_unshift($params, $endpoint);
        return call_user_func_array([$this, 'request'], $params);
    }
}