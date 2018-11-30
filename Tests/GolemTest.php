<?php

namespace GolemAi\Core\Tests;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\Request\RequestDataFactory;
use GolemAi\Core\Golem;
use GolemAi\Core\Serializer\Normalizer\RequestNormalizer;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class GolemTest extends TestCase
{
    public function testCall()
    {
        $response = $this->getMockBuilder(ResponseInterface::class)
            ->getMock()
        ;

        $request = $this->getMockBuilder(RequestInterface::class)
            ->getMock()
        ;

        $client = $this->getMockBuilder(HttpClient::class)
            ->setMethods( [
                'sendRequest'
            ])
            ->getMock()
        ;
        $client->method('sendRequest')->willReturn($response);

        $factory = $this->getMockBuilder(RequestFactory::class)
            ->disableOriginalConstructor()
            ->setMethods( [
                'createRequest'
            ])
            ->getMock()
        ;
        $factory->method('createRequest')->willReturn($request);

        $dataFactory = $this->getMockBuilder(RequestDataFactory::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $dataFactory->method('create')->willReturn(new RequestData());

        $serializer = new Serializer([new RequestNormalizer()], [new JsonEncoder()]);

        $golem = new Golem($client, $factory, $serializer, $dataFactory);
        $this->assertEquals($response, $golem->call('toto', []));
    }
}