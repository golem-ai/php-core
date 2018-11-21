<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\Response\ResponseFactory;
use PHPUnit\Framework\TestCase;

class ResponseFactoryTest extends TestCase
{
    /**
     * @var ResponseFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ResponseFactory();
    }

    public function testCreateEmpty()
    {
        $response = $this->factory->create([]);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(0, $response->getRequestId());
        $this->assertEquals('', $response->getType());
        $this->assertEquals('fr', $response->getRequestLanguage());
        $this->assertEquals('', $response->getRequestText());
        $this->assertEquals(0, $response->getTimeAi());
        $this->assertEquals(0, $response->getTimeTotal());
    }

    /**
     * @param int $requestId
     * @param string $type
     * @param string $requestLanguage
     * @param string $requestText
     * @param int $timeAi
     * @param int $timeTotal
     * @param array $calls
     *
     * @dataProvider responseDataProvider
     */
    public function testCreateWithParams(
        $requestId = 0,
        $type = '',
        $requestLanguage = 'fr',
        $requestText = '',
        $timeAi = 0,
        $timeTotal = 0,
        $calls = []
    )
    {
        $response = $this->factory->create([
            'id_request' => $requestId,
            'type' => $type,
            'request_language' => $requestLanguage,
            'request_text' => $requestText,
            'time_ai' => $timeAi,
            'time_total' => $timeTotal,
            'calls' => $calls
        ]);

        $this->assertEquals($requestId, $response->getRequestId());
        $this->assertEquals($type, $response->getType());
        $this->assertEquals($requestLanguage, $response->getRequestLanguage());
        $this->assertEquals($requestText, $response->getRequestText());
        $this->assertEquals($timeTotal, $response->getTimeTotal());
    }

    public function responseDataProvider()
    {
        return [
            [
                1,
                'answer_text',
                'en',
                'Hello I\'m a text request',
                random_int(0, 500),
                random_int(0, 500),
            ]
        ];
    }
}