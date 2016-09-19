<?php

namespace Neo\NasaBundle\Utils;

use DateInterval;
use DateTime;
use Exception;
use GuzzleHttp\Client;

class NeoDataFetcher
{
    /**
     *
     * @var GuzzleHttp\Client
     */
    private $client;
    private $startDate;
    private $endDate;
    private $nasaPage;
    private $nasaApiKey;

    public function __construct(Client $client, $nasaPage, $nasaApiKey, $startInterval = "P3D", $endDate = "now")
    {
        $this->client = $client;
        $this->nasaPage = $nasaPage;
        $this->nasaApiKey = $nasaApiKey;

        $dateTime = new DateTime($endDate);
        $this->startDate = $dateTime->format("Y-m-d");

        $dateTime->sub(new DateInterval($startInterval));
        $this->endDate = $dateTime->format("Y-m-d");
    }

    public function fetchData()
    {
        $response = $this->client->get("{$this->nasaPage}?start_date={$this->startDate}&end_date={$this->endDate}&api_key={$this->nasaApiKey}");

        if (!$response) {
            throw new Exception("Missing data from NASA page!");
        }

        return $response->getBody();
    }
}
