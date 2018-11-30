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
        $parametersDetail,
        $incomplete
    )
    {
        $interaction = $this->factory->create([
            'id_interaction' => $interactionId,
            'id_context' => $contextId,
            'parameters' => $parameters,
            'parameters_detail' => $parametersDetail,
            'incomplete' => $incomplete,
        ]);

        $this->assertEquals($interactionId, $interaction->getInteractionId());
        $this->assertEquals($contextId, $interaction->getContextId());
        $this->assertEquals($parameters, $interaction->getParameters());
        $this->assertEquals($parametersDetail, $interaction->getParametersDetail());
        $this->assertEquals($incomplete, $interaction->isIncomplete());
    }

    public function testGetFieldsDefault()
    {
        $defaultValues = $this->factory->getFieldsDefault();

        $this->assertArrayHasKey('id_interaction', $defaultValues);
        $this->assertArrayHasKey('id_context', $defaultValues);
        $this->assertArrayHasKey('parameters', $defaultValues);
        $this->assertArrayHasKey('parameters_detail', $defaultValues);
        $this->assertArrayHasKey('incomplete', $defaultValues);

        $this->assertEquals(0, $defaultValues['id_interaction']);
        $this->assertEquals('', $defaultValues['id_context']);
        $this->assertEquals(array(), $defaultValues['parameters']);
        $this->assertEquals(array(), $defaultValues['parameters_detail']);
        $this->assertEquals(false, $defaultValues['incomplete']);
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
                ['test'],
                ['hello'],
                true,
            ]
        ];
    }
}