<?php

namespace Kami\IcoBench\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kami\IcoBench\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCanBeConstructed()
    {
        $client = new Client('test', 'test');
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGetIcosSuccessResponse()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(200, $client->getIcos()->wait()->getStatusCode());
    }

    public function testGetIcosWithMessageInResponse()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['message'=>'test'])));
        $this->assertEquals(200, $client->getIcos()->wait()->getStatusCode());
    }

    public function testGetPeople()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(200, $client->getPeople()->wait()->getStatusCode());
    }

    public function testGetIco()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(200, $client->getIco(1)->wait()->getStatusCode());
    }

    public function testGetOther()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(200, $client->getOther('any')->wait()->getStatusCode());
    }

    /**
     * @param Response $expectedResponse
     * @return Client
     */
    protected function createClientWithHttpClientMocked($expectedResponse)
    {
        $mock = new MockHandler([$expectedResponse]);
        $client = new Client('test', 'test', ['handler' => HandlerStack::create($mock)]);

        return $client;
    }


}
