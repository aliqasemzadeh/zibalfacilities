<?php

class Facility {
    private $token;
    public $api_url;

    public function call(string $name, array $params)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $this->api_url . '/' . $name, [
                'json' => $params,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type' => 'application/json',
                ],
            ]);
            return $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {

        }
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }
}
