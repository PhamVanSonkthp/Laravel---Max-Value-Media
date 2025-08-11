<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait AdScoreTrait
{

    public static $KEY_CACHE_REFRESH_TRAFFIC = "REFRESH_TRAFFIC";

    private $token;
    private $accountID;
    private $urlApi;

    public function init()
    {
        $setting = Setting::first();
        $this->token = optional($setting)->token_api_adscore;
        $this->accountID = optional($setting)->account_id_adscore;
        $this->urlApi = config('_my_config.url_adscore');
    }

    public function callPostHTTP($url, $raw = [])
    {
        $this->init();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $this->token,
        ];

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->send('POST', $this->urlApi . "account/" . $this->accountID . "/"  . $url, [
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
            'Authorization' => 'Basic ' . $this->token,
        ];

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->get($this->urlApi . "account/" . $this->accountID . "/" . $url, $params);

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
