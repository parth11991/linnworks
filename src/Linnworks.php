<?php

namespace Onfuro\Linnworks;

use Onfuro\Linnworks\Api\Auth;
use Onfuro\Linnworks\Api\Locations;
use Onfuro\Linnworks\Api\OpenOrders;
use Onfuro\Linnworks\Api\Orders;
use Onfuro\Linnworks\Api\PostalServices;
use Onfuro\Linnworks\Api\ReturnsRefunds;
use Onfuro\Linnworks\Api\Stock;
use Onfuro\Linnworks\Api\PrintService;
use Onfuro\Linnworks\Api\PrintZone;
use Onfuro\Linnworks\Api\Picking;
use Onfuro\Linnworks\Api\ShippingService;
use Onfuro\Linnworks\Api\Permissions;
use Onfuro\Linnworks\Api\Inventory;
use Onfuro\Linnworks\Api\Listings;
use Onfuro\Linnworks\Api\Dashboards;
use Onfuro\Linnworks\Exceptions\LinnworksAuthenticationException;
use GuzzleHttp\Client as GuzzleClient;
//use Onfuro\Linnworks\Api\OrdersV2;

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

    /** @var string */
    //protected $serverV2;

    /** @var string */
    protected $response;

    public function __construct(array $config, GuzzleClient $client = null)
    {
        $this->client = $client ?: $this->makeClient();
        $this->config = $config;

        if (! $this->bearer) {
            $this->refreshToken();
        }
    }

    public static function make(array $config, GuzzleClient $client = null): self
    {
        return new static($config, $client);
    }

    private function makeClient(): GuzzleClient
    {
        return new GuzzleClient([
            'timeout' => $this->config['timeout'] ?? 0
        ]);
    }

    private function refreshToken(): void
    {
        $parameters = [
            "ApplicationId" => $this->config['applicationId'],
            "ApplicationSecret" => $this->config['applicationSecret'],
            "Token" => $this->config['token']
        ];

        $response = (new Auth($this->client, self::BASE_URI . '/api/', null))
            ->AuthorizeByApplication($parameters);

        if (! ($response['Token'] ?? null)) {
            throw new LinnworksAuthenticationException($response['message'] ?? '');
        }

        $this->bearer = $response['Token'];

        $this->server = $response['Server'] . '/api/';

        //$this->serverV2 = $response['ServerVersion2'];

        $this->response = $response;
    }

    public function response()
    {
        return $this->response;
    }

    public function auth(): Auth
    {
        return new Auth($this->client, $this->server, $this->bearer);
    }

    public function openOrders(): OpenOrders
    {
        return new OpenOrders($this->client, $this->server, $this->bearer);
    }

    public function orders(): Orders
    {
        return new Orders($this->client, $this->server, $this->bearer);
    }

    // public function ordersV2(): OrdersV2
    // {
    //     return new OrdersV2($this->client, $this->serverV2, $this->bearer);
    // }

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

    public function picking(): Picking
    {
        return new Picking($this->client, $this->server, $this->bearer);
    }

    public function shippingService(): ShippingService
    {
        return new ShippingService($this->client, $this->server, $this->bearer);
    }

    public function permissions(): Permissions
    {
        return new Permissions($this->client, $this->server, $this->bearer);
    }

    public function inventory(): Inventory
    {
        return new Inventory($this->client, $this->server, $this->bearer);
    }

    public function Listings(): Listings
    {
        return new Listings($this->client, $this->server, $this->bearer);
    }

    public function Dashboards(): Dashboards
    {
        return new Dashboards($this->client, $this->server, $this->bearer);
    }
}
