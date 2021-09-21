<?php

namespace App\Service\ApiClient;

use App\Handler\ExchangeRatesHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

class NbpApiClient
{
    private Client $client;
    private string $apiUrl;
    private ExchangeRatesHandler $exchangeRatesHandler;

    /**
     * @param string $apiUrl
     * @param ExchangeRatesHandler $exchangeRatesHandler
     */
    public function __construct(string $apiUrl, ExchangeRatesHandler $exchangeRatesHandler)
    {
        $this->client = new Client();
        $this->apiUrl = $apiUrl;
        $this->exchangeRatesHandler = $exchangeRatesHandler;
    }

    /**
     * @return array|string[]
     * @throws GuzzleException
     */
    public function get(): array
    {
        try {
            $response = $this->client->get($this->apiUrl);
            $tmp = json_decode($response->getBody()->getContents(), true);
            $this->exchangeRatesHandler->handle($tmp);
        } catch (BadResponseException $exception) {
            return ['error', $exception->getMessage()];
        }

        return ['success', 'Data has been successfully updated!'];
    }
}