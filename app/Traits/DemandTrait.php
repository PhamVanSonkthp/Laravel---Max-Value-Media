<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait DemandTrait
{
    private $token;
    private $urlApi;

    public function init()
    {
        $this->urlApi = config('_my_config.url_demand');

        $params = [
            'user_name' => config('_my_config.user_name'),
            'password' => config('_my_config.password'),
        ];
        $response = $this->callPostHTTP("api/public/auth/sign-in", $params, false);

        $this->token = $response['data']['token'];
    }

    public function callPostHTTP($url, $raw = [], $is_init = true)
    {
        if ($is_init){
            $this->init();
        }

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->send('POST', $this->urlApi . $url, [
                'body' => json_encode($raw)
            ]);

        if ($response->successful()) {
            return [
                'is_success' => true,
                'status' => $response->status(),
                'data' => $response->json()
            ];
        } else {
            return [
                'is_success' => false,
                'status' => $response->status(),
                'data' => $response->body()
            ];
        }
    }

    public function callPutHTTP($url, $raw = [])
    {
        $this->init();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->send('PUT', $this->urlApi . $url, [
                'body' => json_encode($raw)
            ]);

        if ($response->successful()) {
            return [
                'is_success' => true,
                'status' => $response->status(),
                'data' => $response->json()
            ];
        } else {
            return [
                'is_success' => false,
                'status' => $response->status(),
                'data' => $response->body()
            ];
        }
    }

    public function callGetHTTP($url, $params = [])
    {
        $this->init();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->get($this->urlApi . $url, $params);

        if ($response->successful()) {
            return [
                'is_success' => true,
                'status' => $response->status(),
                'data' => $response->json()
            ];
        } else {
            return [
                'is_success' => false,
                'status' => $response->status(),
                'data' => $response->body()
            ];
        }
    }


}
