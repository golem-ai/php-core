<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Factory\Entity\Response\ResponseFactory;
use GolemAi\Core\Serializer\Denormalizer\InteractionsDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\ResponseDenormalizer;
use PHPUnit\Framework\TestCase;

class InteractionDenormalizerTest extends TestCase
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

        $this->denormalizer->setDenormalizer($interactionDenormalizer);
    }

    public function testDenormalize()
    {
        $output = $this->denormalizer->denormalize([], Response::class, 'json');
        $entity = $this->factory->create([]);

        $this->assertInstanceOf(get_class($entity), $output);
        $this->assertEmpty($output->getInteractions());

        $interactionId = random_int(0, 500);
        $output = $this->denormalizer->denormalize([
            'call' => [
                'id_interaction' => $interactionId
            ]
        ], Response::class, 'json');
        $this->assertTrue(is_array($output->getInteractions()));
        $this->assertInstanceOf(Interaction::class, $output->getInteractions()[0]);
        $this->assertEquals($interactionId, $output->getInteractions()[0]->getInteractionId());
    }

    public function testSupportsDenormalization()
    {
        $data = [];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));
    }
}