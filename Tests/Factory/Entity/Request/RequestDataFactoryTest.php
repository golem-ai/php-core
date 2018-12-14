<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\Request\RequestDataFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

class RequestDataFactoryTest extends TestCase
{
    /**
     * @var RequestDataFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new RequestDataFactory();
    }

    public function testCreateEmpty()
    {
        $this->setExpectedException(MissingOptionsException::class);
        $requestData = $this->factory->create([]);

        $requestData = $this->factory->create([
            'token' => 'toto',
            'text' => 'myText',
        ]);
        $this->assertInstanceOf(RequestData::class, $requestData);
        $this->assertEquals('toto', $requestData->getToken());
        $this->assertEquals('myText', $requestData->getText());
        $this->assertEquals('fr', $requestData->getLanguage());
        $this->assertEquals(RequestData::REQUEST_TYPE, $requestData->getType());
        $this->assertFalse($requestData->isLabelling());
        $this->assertTrue($requestData->isParametersDetail());
        $this->assertTrue($requestData->isDisableVerbose());
        $this->assertFalse($requestData->isMultipleInteractionSearch());
        $this->assertFalse($requestData->isConversationMode());
    }

    /**
     * @param string $token
     * @param string $text
     * @param string $language
     * @param string $type
     * @param bool $isLabelling
     * @param bool $hasParametersDetail
     * @param bool $isDisableVerbose
     * @param bool $isMultipleInteractionSearch
     *
     * @dataProvider requestDataProvider
     */
    public function testCreateWithParams(
        $token = '',
        $text = '',
        $language = 'fr',
        $type = 'request',
        $isLabelling = false,
        $hasParametersDetail = true,
        $isDisableVerbose = true,
        $isMultipleInteractionSearch = false,
        $isConversationMode = false
    )
    {
        $request = $this->factory->create([
            'token' => $token,
            'text' => $text,
            'language' => $language,
            'type' => $type,
            'labelling' => $isLabelling,
            'parameters_detail' => $hasParametersDetail,
            'disable_verbose' => $isDisableVerbose,
            'multiple_interaction_search' => $isMultipleInteractionSearch,
            'conversation_mode' => $isConversationMode,
        ]);

        $this->assertEquals($token, $request->getToken());
        $this->assertEquals($text, $request->getText());
        $this->assertEquals($language, $request->getLanguage());
        $this->assertEquals($type, $request->getType());
        $this->assertEquals($isLabelling, $request->isLabelling());
        $this->assertEquals($hasParametersDetail, $request->isParametersDetail());
        $this->assertEquals($isDisableVerbose, $request->isDisableVerbose());
        $this->assertEquals($isMultipleInteractionSearch, $request->isMultipleInteractionSearch());
        $this->assertEquals($isConversationMode, $request->isConversationMode());
    }

    public function testGetFieldsDefault()
    {
        $defaultValues = $this->factory->getFieldsDefault();

        $this->assertTrue(is_array($defaultValues));
        $this->assertArrayHasKey('language', $defaultValues);
        $this->assertArrayHasKey('type', $defaultValues);
        $this->assertArrayHasKey('labelling', $defaultValues);
        $this->assertArrayHasKey('parameters_detail', $defaultValues);
        $this->assertArrayHasKey('disable_verbose', $defaultValues);
        $this->assertArrayHasKey('multiple_interaction_search', $defaultValues);
        $this->assertArrayHasKey('conversation_mode', $defaultValues);
    }

    public function testGetDefinedFields()
    {
        $definedFields = $this->factory->getDefinedFields();

        $this->assertTrue(is_array($definedFields));
        $this->assertTrue(in_array('language', $definedFields));
        $this->assertTrue(in_array('type', $definedFields));
        $this->assertTrue(in_array('labelling', $definedFields));
        $this->assertTrue(in_array('parameters_detail', $definedFields));
        $this->assertTrue(in_array('disable_verbose', $definedFields));
        $this->assertTrue(in_array('multiple_interaction_search', $definedFields));
        $this->assertTrue(in_array('conversation_mode', $definedFields));
    }

    public function testGetRequiredFields()
    {
        $requiredFields = $this->factory->getRequiredFields();

        $this->assertTrue(in_array('token', $requiredFields));
        $this->assertTrue(in_array('text', $requiredFields));
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     */
    public function requestDataProvider()
    {
        return [
            [],
            [
                'token1',
                'text1',
                'language1',
                'anything',
                true,
                false,
                false,
                true,
                true,
            ]
        ];
    }
}