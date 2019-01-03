<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\ErrorResponse;
use GolemAi\Core\Factory\Entity\Response\ErrorResponseFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

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
        $this->expectException(MissingOptionsException::class);
        $response = $this->factory->create([]);

        $this->assertInstanceOf(ErrorResponse::class, $response);

        $response = $this->factory->create([
            'error_code' => 0,
            'error_message' => '',
        ]);
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
        $errorMessage = '',
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

    public function testGetRequiredFields()
    {
        $requiredFields = $this->factory->getRequiredFields();

        $this->assertTrue(is_array($requiredFields));
        $this->assertTrue(in_array('error_code', $requiredFields));
        $this->assertTrue(in_array('error_message', $requiredFields));
    }

    public function testGetDefinedFields()
    {
        $definedFields = $this->factory->getDefinedFields();

        $this->assertTrue(is_array($definedFields));
        $this->assertTrue(in_array('error_detail', $definedFields));
    }

    public function testGetFieldsDefault()
    {
        $fieldDefaults = $this->factory->getFieldsDefault();

        $this->assertTrue(is_array($fieldDefaults));
        $this->assertArrayHasKey('error_detail', $fieldDefaults);
        $this->assertEquals('', $fieldDefaults['error_detail']);
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function responseDataProvider()
    {
        return [
            [
                \rand(0, 500),
                'toto',
                'Hello I\'m a text request',
            ]
        ];
    }
}