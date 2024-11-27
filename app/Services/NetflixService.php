<?php

namespace App\Services;

use GuzzleHttp\Client;

class NetflixService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://netflix-unofficial.p.rapidapi.com/',
            'headers' => [
                'X-RapidAPI-Host' => 'netflix-unofficial.p.rapidapi.com',
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            ]
        ]);
        $this->apiKey = env('RAPIDAPI_KEY');
    }

    public function search($query)
    {
        $response = $this->client->request('GET', 'search', [
            'query' => ['query' => $query]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getDetails($id)
    {
        $response = $this->client->request('GET', 'title/details', [
            'query' => ['netflixid' => $id]
        ]);

        return json_decode($response->getBody(), true);
    }
}
