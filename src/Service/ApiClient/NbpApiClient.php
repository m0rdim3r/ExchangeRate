<?php

namespace App\Service\ApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

class NbpApiClient
{
    private Client $client;
    private string $apiUrl;

    /**
     * @param string $apiUrl
     */
    public function __construct(string $apiUrl)
    {
        $this->client = new Client();
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function get()
    {
        try {
            $response = $this->client->get($this->apiUrl);

            return json_decode($response->getBody()->getContents(), true);
        } catch (BadResponseException $exception) {
            return $exception->getMessage();
        }
    }
}