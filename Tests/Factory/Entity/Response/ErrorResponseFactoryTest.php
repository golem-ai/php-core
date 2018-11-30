<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\ErrorResponse;
use GolemAi\Core\Factory\Entity\Response\ErrorResponseFactory;
use PHPUnit\Framework\TestCase;

class ErrorResponseFactoryTest extends TestCase
{
    /**
     * @var ErrorResponseFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ErrorResponseFactory();
    }

    public function testCreateEmpty()
    {
        $response = $this->factory->create([]);

        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertEquals(0, $response->getErrorCode());
        $this->assertEquals('', $response->getErrorMessage());
        $this->assertEquals('', $response->getErrorDetail());
    }

    /**
     * @param string $errorCode
     * @param string $errorMessage
     * @param string $errorDetail
     *
     * @dataProvider responseDataProvider
     */
    public function testCreateWithParams(
        $errorCode = '',
        $errorMessage = 'fr',
        $errorDetail = ''
    )
    {
        $response = $this->factory->create([
            'error_code' => $errorCode,
            'error_message' => $errorMessage,
            'error_detail' => $errorDetail,
        ]);

        $this->assertEquals($errorCode, $response->getErrorCode());
        $this->assertEquals($errorMessage, $response->getErrorMessage());
        $this->assertEquals($errorDetail, $response->getErrorDetail());
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     *
     * @throws \Exception
     */
    public function responseDataProvider()
    {
        return [
            [
                \rand(0, 500),
                \rand(0, 500),
                'en',
                'Hello I\'m a text request',
            ]
        ];
    }
}