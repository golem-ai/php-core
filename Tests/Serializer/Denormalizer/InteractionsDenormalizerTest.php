<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Serializer\Denormalizer\InteractionsDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use PHPUnit\Framework\TestCase;

class InteractionsDenormalizerTest extends TestCase
{
    /**
     * @var InteractionsDenormalizer
     */
    private $denormalizer;

    /**
     * @var EntityFactoryInterface
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new InteractionFactory();
        $this->denormalizer = new InteractionsDenormalizer();
        $this->denormalizer->addHandler(new CallPropertyHandler($this->factory));
        $this->denormalizer->addHandler(new CallsPropertyHandler($this->factory));
    }

    public function testDenormalize()
    {
        $interactionId = \rand(0, 500);
        $output = $this->denormalizer->denormalize([
            'call' => [
                'id_interaction' => $interactionId
            ]
        ], Response::class, 'json');
        $this->assertTrue(is_array($output));
        $this->assertCount(1, $output);
        $this->assertInstanceOf(Interaction::class, $output[0]);
        $this->assertEquals($interactionId, $output[0]->getInteractionId());
        $this->assertTrue(\is_array($output[0]->getParameters()));

        $output = $this->denormalizer->denormalize([
            'calls' => [
                ['id_interaction' => 1],
                ['id_interaction' => 2],
            ]
        ], Response::class, 'json');
        $this->assertTrue(is_array($output));
        $this->assertInstanceOf(Interaction::class, $output[0]);
        $this->assertInstanceOf(Interaction::class, $output[1]);
        $this->assertEquals(1, $output[0]->getInteractionId());
        $this->assertEquals(2, $output[1]->getInteractionId());
    }

    public function testSupportsNormalization()
    {
        $data = [
            'call' => []
        ];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Interaction::class, 'json'));

        $data = [];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Interaction::class, 'json'));

        $data = 'sdqsdqsdff';
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Interaction::class, 'json'));
    }
}