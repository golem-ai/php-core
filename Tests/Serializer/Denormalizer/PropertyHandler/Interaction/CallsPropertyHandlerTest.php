<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer\PropertyHandler\Interaction;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Serializer\Denormalizer\ParameterDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use PHPUnit\Framework\TestCase;

class CallsPropertyHandlerTest extends TestCase
{
    /** @var CallsPropertyHandler */
    private $handler;
    /** @var EntityFactoryInterface */
    private $factory;

    public function setUp()
    {
        $denormalizer = new ParameterDenormalizer();
        $this->factory = new InteractionFactory();
        $this->handler = new CallsPropertyHandler($this->factory);
        $this->handler->setDenormalizer($denormalizer);
    }

    public function testCanHandle()
    {
        $data = [];
        $this->assertfalse($this->handler->canHandle($data));
        $data['calls'] = 'hello';
        $this->assertfalse($this->handler->canHandle($data));
        $data['calls'] = 1;
        $this->assertfalse($this->handler->canHandle($data));
        $data['calls'] = [];
        $this->assertTrue($this->handler->canHandle($data));
    }

    public function testHandle()
    {
        $data = ['calls' => [
            [
                'parameters' => [
                    'arrival_town' => ['Rouen'],
                ]
            ]
        ]];

        $interactions = $this->handler->handle($data);
        $this->assertTrue(\is_array($interactions));
        $this->assertInstanceOf(Interaction::class, $interactions[0]);
        $this->assertTrue(\is_array($interactions[0]->getParameters()));
        foreach ($interactions[0]->getParameters() as $parameter) {
            $this->assertInstanceOf(Parameter::class, $parameter);
        }
    }

    public function testGetFieldName()
    {
        $this->assertEquals(CallsPropertyHandler::PROPERTY, $this->handler->getFieldName());
    }
}