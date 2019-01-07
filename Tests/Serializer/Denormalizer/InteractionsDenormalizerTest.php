<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Serializer\Denormalizer\InteractionsDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use PHPUnit\Framework\TestCase;

class InteractionsDenormalizerTest extends TestCase
{
    /**
     * @var InteractionsDenormalizer
     */
    private $denormalizer;

    private $propertyHandler;

    public function setUp()
    {
        $this->propertyHandler = $this->getMockBuilder(DenormalizerPropertyHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->denormalizer = new InteractionsDenormalizer();
        $this->denormalizer->addHandler($this->propertyHandler);
    }

    public function testDenormalize()
    {
        $interaction = new Interaction();
        $this->propertyHandler->method('canHandle')->willReturn(true);
        $this->propertyHandler->method('handle')->willReturn([$interaction]);
        $output = $this->denormalizer->denormalize([], Response::class, 'json');

        $this->assertEquals([$interaction], $output);
    }

    public function testDenormalizeEmpty()
    {
        $this->propertyHandler->method('canHandle')->willReturn(false);
        $output = $this->denormalizer->denormalize([], Response::class, 'json');

        $this->assertEquals([], $output);
    }

    public function testSupportsNormalization()
    {
        $data = [
            'call' => []
        ];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Interaction::class, 'json'));

        $data = [];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Interaction::class, 'json'));

        $data = 'sdqsdqsdff';
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Interaction::class, 'json'));
    }
}