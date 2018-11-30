<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer\PropertyHandler\Interaction;

use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
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
    }

    public function testCanHandle()
    {
        $data = [];
        $this->assertfalse($this->handler->canHandle($data));
        $data['call'] = 'hello';
        $this->assertfalse($this->handler->canHandle($data));
        $data['call'] = 1;
        $this->assertfalse($this->handler->canHandle($data));
        $data['call'] = [];
        $this->assertTrue($this->handler->canHandle($data));
    }

    public function testHandle()
    {
        $data = ['call' => []];

        $this->assertTrue(\is_array($this->handler->handle($data)));
    }
}