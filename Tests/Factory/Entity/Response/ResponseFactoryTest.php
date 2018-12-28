<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\ErrorResponse;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
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
        $response = $this->factory->create([
            'status_code' => 200
        ]);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('', $response->getType());
    }

    /**
     * @param int $statusCode
     * @param string $type
     * @param null $responseData
     * @param null $responseError
     *
     * @dataProvider responseDataProvider
     */
    public function testCreateWithParams(
        $statusCode = 200,
        $type = '',
        $responseData = null
    )
    {
        $response = $this->factory->create([
            'status_code' => $statusCode,
            'type' => $type,
            'response_data' => $responseData,
        ]);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals($type, $response->getType());
        $this->assertEquals($responseData, $response->getData());
    }

    public function testGetFieldsDefault()
    {
        $defaultValues = $this->factory->getFieldsDefault();

        $this->assertTrue(is_array($defaultValues));
        $this->assertArrayHasKey('status_code', $defaultValues);
        $this->assertArrayHasKey('type', $defaultValues);
        $this->assertArrayHasKey('response_data', $defaultValues);
    }

    public function testGetFieldsType()
    {
        $fieldsType = $this->factory->getFieldsType();

        $this->assertTrue(is_array($fieldsType));
        $this->assertArrayHasKey('response_data', $fieldsType);
        $this->assertTrue(in_array(ResponseData::class, $fieldsType['response_data']));
        $this->assertTrue(in_array('null', $fieldsType['response_data']));
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
                \rand(200, 400),
                'answer_text',
                new ResponseData(),
            ]
        ];
    }
}