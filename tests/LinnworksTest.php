<?php

namespace Onfuro\Linnworks\Tests;

use Onfuro\Linnworks\Exceptions\LinnworksAuthenticationException;
use Onfuro\Linnworks\Exceptions\LinnworksResponseCouldNotBeParsed;
use Onfuro\Linnworks\Linnworks;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\TestCase;

class LinnworksTest extends TestCase
{
    /** @var Client  */
    protected $client;

    /** @var MockHandler  */
    protected $mock;

    /** @var array  */
    protected $config;

    public function setUp(): void
    {
        parent::setUp();

        // These are invalid credentials, for testing with mock client only
        $this->config = [
            'applicationId' => '80003999e8-b1cc-4d62-axj5-jd883cccb481',
            'applicationSecret' => '87hhhbd72-d51a-4eed-8eab-98jjdb02c1b08',
            'token' => 'g89605ef47af205819b9ccc96a98c8bcf',
        ];

        $this->mock = new MockHandler([]);

        $this->mock->append(new Response(200, [],
            file_get_contents(__DIR__.'/stubs/AuthorizeByApplication.json')));

        $handlerStack = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $handlerStack]);
    }

    /** @test */
    public function it_can_connect_to_linnworks()
    {
        $this->mock->append(new Response(200, [], json_encode(['hello' => 'world'])));

        $linnworks = Linnworks::make($this->config, $this->client);

        $orders = $linnworks->orders()->getOpenOrders('abc');

        $this->assertSame(['hello' => 'world'], $orders);
    }

    /** @test */
    public function it_will_throw_an_exception_with_invalid_json()
    {
        $this->expectException(LinnworksResponseCouldNotBeParsed::class);

        $this->mock->append(new Response(200, [], 'abc'));

        $linnworks = Linnworks::make($this->config, $this->client);

        $linnworks->orders()->getOpenOrders('abc');
    }

    /** @test */
    public function it_will_throw_an_exception_when_not_logged_in()
    {
        $this->expectException(LinnworksAuthenticationException::class);

        $this->mock->reset();

        $this->mock->append(new Response(200, [], json_encode(['noToken' => 'abc'])));

        $linnworks = Linnworks::make($this->config, $this->client);

        $linnworks->orders()->getOpenOrders('abc');
    }


}