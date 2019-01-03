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
        $incomplete,
        $idMissingParameter = [],
        $verboseInteraction = '',
        $verboseMissingParameters = [],
        $helperMessage = ''
    )
    {
        $interaction = $this->factory->create([
            'id_interaction' => $interactionId,
            'id_context' => $contextId,
            'parameters' => $parameters,
            'parameters_detail' => $parametersDetail,
            'incomplete' => $incomplete,
            'id_missing_parameters' => $idMissingParameter,
            'verbose_interaction' => $verboseInteraction,
            'verbose_missing_parameters' => $verboseMissingParameters,
            'helper_message' => $helperMessage,
        ]);

        $this->assertEquals($interactionId, $interaction->getInteractionId());
        $this->assertEquals($contextId, $interaction->getContextId());
        $this->assertEquals($parameters, $interaction->getParameters());
        $this->assertEquals($parametersDetail, $interaction->getParametersDetail());
        $this->assertEquals($incomplete, $interaction->isIncomplete());
        $this->assertEquals($idMissingParameter, $interaction->getIdMissingParameter());
        $this->assertEquals($verboseInteraction, $interaction->getVerboseInteraction());
        $this->assertEquals($verboseMissingParameters, $interaction->getVerboseMissingParameters());
        $this->assertEquals($helperMessage, $interaction->getHelperMessage());
    }

    public function testGetFieldsDefault()
    {
        $defaultValues = $this->factory->getFieldsDefault();

        $this->assertArrayHasKey('id_interaction', $defaultValues);
        $this->assertArrayHasKey('id_context', $defaultValues);
        $this->assertArrayHasKey('parameters', $defaultValues);
        $this->assertArrayHasKey('parameters_detail', $defaultValues);
        $this->assertArrayHasKey('incomplete', $defaultValues);
        $this->assertArrayHasKey('id_missing_parameters', $defaultValues);
        $this->assertArrayHasKey('verbose_interaction', $defaultValues);
        $this->assertArrayHasKey('verbose_missing_parameters', $defaultValues);
        $this->assertArrayHasKey('helper_message', $defaultValues);

        $this->assertTrue(is_numeric($defaultValues['id_interaction']));
        $this->assertEquals(0, $defaultValues['id_interaction']);
        $this->assertTrue(is_string($defaultValues['id_context']));
        $this->assertTrue(is_array($defaultValues['parameters']));
        $this->assertTrue(is_array($defaultValues['parameters_detail']));
        $this->assertTrue(is_bool($defaultValues['incomplete']));
        $this->assertFalse($defaultValues['incomplete']);
        $this->assertTrue(is_array($defaultValues['id_missing_parameters']));
        $this->assertTrue(is_string($defaultValues['verbose_interaction']));
        $this->assertTrue(is_array($defaultValues['verbose_missing_parameters']));
        $this->assertTrue(is_string($defaultValues['helper_message']));
    }

    /**
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
                ['missing'],
                'id',
                ['je', 'ne', 'sais plus ce qu', 'il y a'],
                'message'
            ]
        ];
    }
}