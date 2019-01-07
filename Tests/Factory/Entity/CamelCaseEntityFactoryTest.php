<?php

namespace GolemAi\Core\Tests\Factory\Entity;

use GolemAi\Core\Converter\SnakeToCamelConverter;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\SnakeToCamelCaseEntityFactory;
use GolemAi\Core\Factory\Exception\MissingClassNameException;
use PHPUnit\Framework\TestCase;

class SnakeToCamelCaseEntityFactoryTest extends TestCase
{
    /**
     * @var SnakeToCamelCaseEntityFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new SnakeToCamelCaseEntityFactory(
            new SnakeToCamelConverter()
        );
    }

    public function testCreateThrowsException()
    {
        $this->expectException(MissingClassNameException::class);
        $this->factory->create();
    }

    public function testCreate()
    {
        $this->assertInstanceOf(\stdClass::class, $this->factory->create(
            ['class' => \stdClass::class])
        );
    }

    public function testCreateWithParams()
    {
        $responseData = new ResponseData();
        $object = $this->factory->create(array(
            'status_code' => 200,
            'class' => Response::class,
            'type' => 'toto',
            'data' => $responseData,
        ));

        $this->assertInstanceOf(Response::class, $object);
        $this->assertEquals(200, $object->getStatusCode());
        $this->assertEquals('toto', $object->getType());
        $this->assertEquals($responseData, $object->getData());

        $object = $this->factory->create(array(
            'status_code' => 200,
            'class' => Response::class,
            'data' => $responseData
        ));

        $this->assertInstanceOf(Response::class, $object);
        $this->assertEquals(200, $object->getStatusCode());
        $this->assertEquals($responseData, $object->getData());
    }
}