<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

trait GAMTrait
{
    public static $KEY_CACHE_CREATE_WEBSITE = "CREATE_WEBSITE";
    public static $KEY_CACHE_CREATE_ZONE = "CREATE_ZONE";
    public static $KEY_CACHE_UPDATE_STATUS_ZONE = "UPDATE_STATUS_ZONE";

    private $urlApi;
    private $secretKey;

    public function init()
    {
        $this->urlApi = config('_my_config.url_max_gam');
        $this->secretKey = config('_my_config.max_gam_secret_key');
    }

    public function calculateChecksumGam($data) {
        $data = sort($data);
        return hash_hmac('sha256', $data, $this->secretKey);
    }

    public function callPostHTTP($url, $raw = [])
    {
        $this->init();

        $headers = [];
        $headers['X-Checksum'] = $this->calculateChecksumGam($raw);
        $headers['Accept'] = "application/json";

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->post($this->urlApi . $url, $raw);

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

        $headers = [];
        $headers['X-Checksum'] = $this->calculateChecksumGam($raw);
        $headers['Accept'] = "application/json";

        $response = Http::withHeaders($headers)->timeout(config('_my_config.timeout_request_api'))
            ->put($this->urlApi . $url, $raw);

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
