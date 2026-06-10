<?php

namespace App\Services\Delivry;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class TorodService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUrl = env('TOROD_API_URL');
        $this->clientId = env('TOROD_CLIENT_ID');
        $this->clientSecret = env('TOROD_CLIENT_SECRET');

        // Log the URLs and credentials to ensure they are being set correctly
        Log::debug('Torod API Base URL: ' . $this->baseUrl);
        Log::debug('Torod Client ID: ' . $this->clientId);
        Log::debug('Torod Client Secret: ' . $this->clientSecret);
    }

    /**
     * Get the Bearer Token from Torod API.
     *
     * @return string
     * @throws \Exception
     */
    public function getToken()
    {
        if (!$this->baseUrl || !$this->clientId || !$this->clientSecret) {
            throw new Exception('Base URL, Client ID, or Client Secret is not set.');
        }

        // Log the request to ensure it is being sent correctly
        Log::debug('Requesting token with Client ID: ' . $this->clientId);

        $response = Http::asForm()->post($this->baseUrl . '/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        // Log the response for debugging
        Log::debug('Token request response: ' . $response->body());

        if ($response->successful()) {
            $data = $response->json();

            if ($data['status'] && isset($data['data']['bearer_token'])) {
                $token = $data['data']['bearer_token'];

                // Log the token for debugging purposes (should be adjusted for production)
                Log::debug('Received Torod API Token: ' . $token);

                // Cache the token for 24 hours
                Cache::put('torod_bearer_token', $token, now()->addHours(24));

                return $token;
            }

            throw new Exception('Failed to retrieve token: ' . ($data['message'] ?? 'Unknown error'));
        }

        throw new Exception('Token request failed: ' . $response->body());
    }

    /**
     * Get the Bearer Token from the cache or retrieve a new one.
     *
     * @return string
     */
    public function getTokenFromCache()
    {
        return Cache::remember('torod_bearer_token', 24 * 60 * 60, function () {
            return $this->getToken();
        });
    }

    /**
     * Make a request to the Torod API.
     *
     * @param string $endpoint
     * @param string $method
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function apiRequest($endpoint, $method = 'GET', $data = [])
    {
        $token = $this->getTokenFromCache();
        Log::debug('Torod API Token: ' . $token);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->asForm()->$method($this->baseUrl . '/' . $endpoint, $data);

        if ($response->successful()) {
            $responseData = $response->json();
            Log::debug('Torod API Response: ', $responseData);
            return $responseData;
        }

        throw new Exception('API request failed: ' . $response->body());
    }

    /**
     * Create an order on the Torod API.
     *
     * @param array $orderData
     * @return array
     * @throws \Exception
     */
    public function createOrder($orderData)
    {
        return $this->apiRequest('order/create', 'POST', $orderData);
    }
}
