<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\Response\ResponseFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

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

    public function testCreateEmptyWithMissingCode()
    {
        $this->setExpectedException(MissingOptionsException::class);
        $this->factory->create([]);
    }

    /**
     * @param int $statusCode
     * @param string $type
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

    public function testGetRequiredFields()
    {
        $requiredFields = $this->factory->getRequiredFields();

        $this->assertTrue(is_array($requiredFields));
        $this->assertEquals('status_code', $requiredFields[0]);
    }

    public function testGetFieldsDefault()
    {
        $defaultValues = $this->factory->getFieldsDefault();

        $this->assertTrue(is_array($defaultValues));
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
                \rand(200, 400),
                'answer_text',
            ]
        ];
    }
}