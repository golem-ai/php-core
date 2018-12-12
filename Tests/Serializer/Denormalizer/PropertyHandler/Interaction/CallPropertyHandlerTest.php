<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer\PropertyHandler\Interaction;

use GolemAi\Core\Extractor\ArrayParameterExtractor;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Serializer\Denormalizer\ParameterDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use PHPUnit\Framework\TestCase;

class CallPropertyHandlerTest extends TestCase
{

    /** @var CallPropertyHandler */
    private $handler;
    /** @var EntityFactoryInterface */
    private $factory;

    public function setUp()
    {
        $this->factory = new InteractionFactory();
        $this->handler = new CallPropertyHandler($this->factory);

        $extractor = new ArrayParameterExtractor();
        $denormalizer = new ParameterDenormalizer();
        $denormalizer->addExtractor($extractor);
        $this->handler->setDenormalizer($denormalizer);
    }

    public function testCanHandle()
    {
        $data = [];
        $this->assertFalse($this->handler->canHandle($data));
        $data['call'] = 'hello';
        $this->assertFalse($this->handler->canHandle($data));
        $data['call'] = 1;
        $this->assertFalse($this->handler->canHandle($data));
        $data['call'] = [];
        $this->assertTrue($this->handler->canHandle($data));
    }

    public function testHandle()
    {
        $data = ['call' => [
            'parameters' => [
                'arrival_town' => ['Rouen'],
            ],
        ]];

        $interactions = $this->handler->handle($data);
        $this->assertTrue(\is_array($interactions));
        $this->assertTrue(\is_array($interactions[0]->getParameters()));
        $this->assertNotEmpty($interactions[0]->getParameters());
    }

    public function testGetFieldName()
    {
        $this->assertEquals(CallPropertyHandler::PROPERTY, $this->handler->getFieldName());
    }
}