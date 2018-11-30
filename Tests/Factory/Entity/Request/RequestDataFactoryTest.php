<?php

namespace GolemAi\Core\Tests\Factory\Entity\Response;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\Request\RequestDataFactory;
use PHPUnit\Framework\TestCase;

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
        $requestData = $this->factory->create([]);

        $this->assertInstanceOf(RequestData::class, $requestData);
        $this->assertEquals('', $requestData->getToken());
        $this->assertEquals('', $requestData->getText());
        $this->assertEquals('fr', $requestData->getLanguage());
        $this->assertEquals(RequestData::REQUEST_TYPE, $requestData->getType());
        $this->assertFalse($requestData->isLabelling());
        $this->assertTrue($requestData->isParametersDetail());
        $this->assertTrue($requestData->isDisableVerbose());
        $this->assertFalse($requestData->isMultipleInteractionSearch());
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
        $isMultipleInteractionSearch = false
    )
    {
        $request = $this->factory->create([
            'token' => $token,
            'text' => $text,
            'language' => $language,
            'type' => $type,
            'labelling' => $isLabelling,
            'parametersDetail' => $hasParametersDetail,
            'disableVerbose' => $isDisableVerbose,
            'multipleInteractionSearch' => $isMultipleInteractionSearch,
        ]);

        $this->assertEquals($token, $request->getToken());
        $this->assertEquals($text, $request->getText());
        $this->assertEquals($language, $request->getLanguage());
        $this->assertEquals($type, $request->getType());
        $this->assertEquals($isLabelling, $request->isLabelling());
        $this->assertEquals($hasParametersDetail, $request->isParametersDetail());
        $this->assertEquals($isDisableVerbose, $request->isDisableVerbose());
        $this->assertEquals($isMultipleInteractionSearch, $request->isMultipleInteractionSearch());
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
            ]
        ];
    }
}