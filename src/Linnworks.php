<?php

namespace Onfuro\Linnworks;

use Onfuro\Linnworks\Api\Auth;
use Onfuro\Linnworks\Api\Locations;
use Onfuro\Linnworks\Api\Orders;
use Onfuro\Linnworks\Api\PostalServices;
use Onfuro\Linnworks\Api\ReturnsRefunds;
use Onfuro\Linnworks\Api\Stock;
use Onfuro\Linnworks\Api\PrintService;
use Onfuro\Linnworks\Api\PrintZone;
use Onfuro\Linnworks\Exceptions\LinnworksAuthenticationException;
use GuzzleHttp\Client as GuzzleClient;

class Linnworks
{
    const BASE_URI = 'https://api.linnworks.net';

    /** @var GuzzleClient */
    protected $client;

    /** @var array */
    protected $config;

    /** @var string */
    protected $bearer;

    /** @var string */
    protected $server;

    public function __construct(array $config, GuzzleClient $client = null)
    {
        $this->client = $client ?: $this->makeClient();
        $this->config = $config;

        if(! $this->bearer){
            $this->refreshToken();
        }
    }

    public static function make(array $config, GuzzleClient $client = null): self
    {
        return new static ($config, $client);
    }

    private function makeClient(): GuzzleClient
    {
        return new GuzzleClient([
            'timeout' => $this->config['timeout'] ?? 15
        ]);
    }

    private function refreshToken() : void
    {
        $parameters = [
            "ApplicationId" => $this->config['applicationId'],
            "ApplicationSecret" => $this->config['applicationSecret'],
            "Token" => $this->config['token']
        ];

        $response = (new Auth($this->client, self::BASE_URI.'/api/', null))
            ->AuthorizeByApplication($parameters);

        if(! ($response['Token'] ?? null)){
            throw new LinnworksAuthenticationException($response['message'] ?? '');
        }

        $this->bearer = $response['Token'];

        $this->server = $response['Server'] .'/api/';
    }

    public function orders(): Orders
    {
        return new Orders($this->client, $this->server, $this->bearer);
    }

    public function locations(): Locations
    {
        return new Locations($this->client, $this->server, $this->bearer);
    }

    public function postalServices(): PostalServices
    {
        return new PostalServices($this->client, $this->server, $this->bearer);
    }

    public function returnsRefunds(): ReturnsRefunds
    {
        return new ReturnsRefunds($this->client, $this->server, $this->bearer);
    }

    public function stock(): Stock
    {
        return new Stock($this->client, $this->server, $this->bearer);
    }

    public function printService(): PrintService
    {
        return new PrintService($this->client, $this->server, $this->bearer);
    }

    public function printZone(): PrintZone
    {
        return new PrintZone($this->client, $this->server, $this->bearer);
    }

}