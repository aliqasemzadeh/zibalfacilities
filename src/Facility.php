<?php
namespace AliQasemzadeh\ZibalFacilities;

class Facility {
    private $token;
    public $api_url;

    public function __construct(string $token = null, ?string $api_url = null)
    {
        if($token) {
            $this->setToken($token);
        } else {
            $this->setToken(config('zibal.api_token'));
        }

        if($api_url) {
            $this->setApiUrl($api_url);
        } else {
            $this->setToken(config('zibal.api_url'));
        }

    }

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

    public function setApiUrl(string $url)
    {
        $this->api_url = $url;
    }
}
