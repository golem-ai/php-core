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
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\ResponseDataDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\ResponseDenormalizer;
use PHPUnit\Framework\TestCase;

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

    public function setUp()
    {
        $this->factory = new ResponseFactory();
        $this->denormalizer = new ResponseDenormalizer(
            $this->factory
        );

        $interactionFactory = new InteractionFactory();
        $interactionDenormalizer = new InteractionsDenormalizer();
        $interactionDenormalizer->addHandler(new CallPropertyHandler($interactionFactory));
        $interactionDenormalizer->addHandler(new CallsPropertyHandler($interactionFactory));

        $responseDataFactory = new ResponseDataFactory();
        $responseDataDenormalizer = new ResponseDataDenormalizer($responseDataFactory);
        $responseDataDenormalizer->setDenormalizer($interactionDenormalizer);

        $this->denormalizer->setDenormalizer($responseDataDenormalizer);
    }

    public function testDenormalize()
    {
        $output = $this->denormalizer->denormalize([
            'status_code' => 200,
            'type' => ''
        ], Response::class, 'json');
        $entity = $this->factory->create([
            'status_code' => 200
        ]);

        $this->assertInstanceOf(get_class($entity), $output);

        $interactionId = \rand(0, 500);
        $output = $this->denormalizer->denormalize([
            'status_code' => 200,
            'type' => 'answer_text',
            'call' => [
                'id_interaction' => $interactionId
            ]
        ], Response::class, 'json');

        $this->assertEquals(200, $output->getStatusCode());
        $this->assertEquals('answer_text', $output->getType());
        $this->assertInstanceOf(ResponseData::class, $output->getData());
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