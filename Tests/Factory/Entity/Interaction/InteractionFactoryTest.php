<?php

namespace GolemAi\Core\Tests\Factory\Entity\Interaction;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use PHPUnit\Framework\TestCase;

class InteractionFactoryTest extends TestCase
{
    /**
     * @var InteractionFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new InteractionFactory();
    }

    public function testCreateEmpty()
    {
        $interaction = $this->factory->create([]);

        $this->assertInstanceOf(Interaction::class, $interaction);
    }

    /**
     * @param $interactionId
     * @param $contextId
     * @param $parameters
     * @param $incomplete
     *
     * @dataProvider responseDataProvider
     */
    public function testCreateWithParams(
        $interactionId,
        $contextId,
        $parameters,
        $incomplete
    )
    {
        $interaction = $this->factory->create([
            'id_interaction' => $interactionId,
            'id_context' => $contextId,
            'parameters' => $parameters,
            'incomplete' => $incomplete,
        ]);

        $this->assertEquals($interactionId, $interaction->getInteractionId());
        $this->assertEquals($contextId, $interaction->getContextId());
        $this->assertEquals($parameters, $interaction->getParameters());
        $this->assertEquals($incomplete, $interaction->isIncomplete());
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     */
    public function responseDataProvider()
    {
        return [
            [
                'BOUH',
                'YAAA',
                [],
                true,
            ]
        ];
    }
}