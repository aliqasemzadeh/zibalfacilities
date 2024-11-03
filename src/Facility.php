<?php
namespace AliQasemzadeh\ZibalFacilities;

use GuzzleHttp\Psr7\Request;

class Facility {
    protected $token;
    protected $api_url;

    public function __construct(?string $token = null, ?string $api_url = null)
    {
        if($token) {
            $this->setToken($token);
        } else {
            $this->setToken(config('zibal.api_token'));
        }

        if($api_url) {
            $this->setApiUrl($api_url);
        } else {
            $this->setApiUrl(config('zibal.api_url'));
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

    public function call(string $method, array $params)
    {
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->token,
        ];
        $body = json_encode($params);
        try {
            $request = new Request('POST', $this->api_url . "/" . $method, $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return $res->getBody();
        } catch (\GuzzleHttp\Exception\ClientException $e) {

        }
    }

}
