<?php
namespace AliQasemzadeh\ZibalFacilities;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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
        try {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ];
            $body = json_encode($params);
            $request = new Request('POST', $this->api_url .'/'.$method, $headers, $body);
            $result = $client->sendAsync($request)->wait();
            if($result->result != 1) {
                throw new \Exception($result->message);
            }
            return $result->body;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error($e->getMessage());
        }
    }

}
