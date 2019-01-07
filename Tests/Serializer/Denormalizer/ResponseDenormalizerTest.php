<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Factory\Entity\Response\ResponseDataFactory;
use GolemAi\Core\Factory\Entity\Response\ResponseFactory;
use GolemAi\Core\Serializer\Denormalizer\InteractionsDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\ResponseDataDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\ResponseDenormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResponseDenormalizerTest extends TestCase
{
    /**
     * @var ResponseDenormalizer
     */
    private $denormalizer;

    /**
     * @var EntityFactoryInterface
     */
    private $factory;
    private $responseDataDenormalizer;

    public function setUp()
    {
        $this->factory = $this->getMockBuilder(EntityFactoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->denormalizer = new ResponseDenormalizer(
            $this->factory
        );
        $this->responseDataDenormalizer = $this->getMockBuilder(DenormalizerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->denormalizer->setDenormalizer($this->responseDataDenormalizer);
    }

    public function testDenormalize()
    {
        $object = new Response(200);
        $this->factory->method('create')->willReturn($object);
        $output = $this->denormalizer->denormalize([
            'status_code' => 200,
            'type' => ''
        ], Response::class, 'json');

        $this->assertEquals($object, $output);
    }

    public function testGetResponseData()
    {
        $responseData = new ResponseData();
        $this->responseDataDenormalizer->method('denormalize')
            ->willReturn($responseData);

        $reflectionClass = new \ReflectionClass($this->denormalizer);
        $reflectionMethod = $reflectionClass->getMethod('getResponseData');
        $reflectionMethod->setAccessible(true);

        $data = $reflectionMethod->invokeArgs($this->denormalizer, [[]]);
        $this->assertArrayHasKey('data', $data);
        $this->assertEquals($responseData, $data['data']);
    }

    public function testSupportsDenormalization()
    {
        $data = [
            'type' => Response::ANSWER_TYPE,
        ];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [
            'type' => Response::PONG_TYPE
        ];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [
            'type' => 'toto'
        ];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));
    }
}