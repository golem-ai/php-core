<?php

namespace GolemAi\Core;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\Request\RequestDataFactory;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use Symfony\Component\Serializer\Serializer;

class Golem
{
    private $httpClient;
    private $requestFactory;
    private $serializer;
    private $dataFactory;

    /**
     * Golem constructor.
     *
     * @param HttpClient $httpClient
     * @param RequestFactory $requestFactory
     * @param Serializer $serializer
     * @param RequestDataFactory $dataFactory
     */
    public function __construct(HttpClient $httpClient, RequestFactory $requestFactory, Serializer $serializer, RequestDataFactory $dataFactory)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->requestFactory = $requestFactory;
        $this->dataFactory = $dataFactory;
    }

    /**
     * @param string $uri
     * @param array|RequestData $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     */
    public function call($uri, $data)
    {
        if (is_array($data)) {
            $data = $this->dataFactory->create($data);
        }

        $dataString = $this->serializer->serialize(
            $data,
            'json'
        );

        return $this->httpClient->sendRequest(
            $this->requestFactory->createRequest('POST', $uri, ['Content-type' => 'application/json'], $dataString)
        );
    }
}