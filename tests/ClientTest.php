<?php

namespace Kami\IcoBench\Tests;

use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kami\IcoBench\Client;
use Kami\IcoBench\Exception\IcoBenchException;
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
        $this->assertEquals(['some_data'=>'data'], $client->getIcos()->wait());
    }

    public function testGetIcosWithErrorsInResponse()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['error'=>'test'])));
        $this->expectException(IcoBenchException::class);
        $client->getIcos()->wait();
    }

    public function testGetIcosWithMessageInResponse()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['message'=>'test'])));
        $this->assertEquals('test', $client->getIcos()->wait());
    }

    public function testGetIcosWithNotSuccessResponse()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(503));
        $this->expectException(ServerException::class);
        $client->getIcos()->wait();
    }

    public function testGetPeople()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(['some_data'=>'data'], $client->getPeople()->wait());
    }


    public function testGetIco()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(['some_data'=>'data'], $client->getIco(1)->wait());
    }

    public function testGetOther()
    {
        $client = $this->createClientWithHttpClientMocked(new Response(200, [], json_encode(['some_data'=>'data'])));
        $this->assertEquals(['some_data'=>'data'], $client->getOther('any')->wait());
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
