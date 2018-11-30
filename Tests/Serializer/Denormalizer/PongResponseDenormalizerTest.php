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
use GolemAi\Core\Serializer\Denormalizer\PongResponseDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\ResponseDataDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\ResponseDenormalizer;
use PHPUnit\Framework\TestCase;

class PongResponseDenormalizerTest extends TestCase
{
    /**
     * @var ResponseDenormalizer
     */
    private $denormalizer;

    /**
     * @var EntityFactoryInterface
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ResponseFactory();
        $this->denormalizer = new PongResponseDenormalizer(
            $this->factory
        );
    }

    public function testDenormalize()
    {
        $data = [
            'status_code' => \rand(200, 400),
            'type' => Response::PONG_TYPE
        ];

        $response = $this->denormalizer->denormalize($data, Response::class);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($data['status_code'], $response->getStatusCode());
        $this->assertEquals($data['type'], $response->getType());
    }

    public function testSupportsDenormalization()
    {
        $data = [
            'type' => Response::PONG_TYPE,
        ];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [
            'type' => Response::ANSWER_TYPE
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