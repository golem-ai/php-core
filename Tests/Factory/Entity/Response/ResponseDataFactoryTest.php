<?php


namespace GolemAi\Core\Tests\Factory\Entity\Response;


use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\Response\ResponseDataFactory;
use PHPUnit\Framework\TestCase;

class ResponseDataFactoryTest extends TestCase
{
    /**
     * @var ResponseDataFactory
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ResponseDataFactory();
    }

    public function testCreate()
    {
        $responseData = $this->factory->create([]);

        $this->assertInstanceOf(ResponseData::class, $responseData);
    }

    /**
     * @param int $requestId
     * @param string $requestLanguage
     * @param string $requestText
     * @param int $timeAi
     * @param int $timeTotal
     * @param array $interactions
     *
     * @dataProvider responseDataProvider
     */
    public function testCreateWithParams(
        $requestId = 0,
        $requestLanguage = 'fr',
        $requestText = '',
        $timeAi = 0,
        $timeTotal = 0,
        $interactions = []
    )
    {
        $responseData = $this->factory->create([
            'id_request' => $requestId,
            'request_language' => $requestLanguage,
            'request_text' => $requestText,
            'time_ai' => $timeAi,
            'time_total' => $timeTotal,
            'interactions' => $interactions
        ]);

        $this->assertEquals($requestId, $responseData->getRequestId());
        $this->assertEquals($requestLanguage, $responseData->getRequestLanguage());
        $this->assertEquals($requestText, $responseData->getRequestText());
        $this->assertEquals($timeAi, $responseData->getTimeAi());
        $this->assertEquals($timeTotal, $responseData->getTimeTotal());
        $this->assertEquals($interactions, $responseData->getInteractions());
    }

    public function testGetFieldsDefault()
    {
        $defaultValues = $this->factory->getFieldsDefault();

        $this->assertArrayHasKey('id_request', $defaultValues);
        $this->assertArrayHasKey('request_language', $defaultValues);
        $this->assertArrayHasKey('request_text', $defaultValues);
        $this->assertArrayHasKey('time_ai', $defaultValues);
        $this->assertArrayHasKey('time_total', $defaultValues);
        $this->assertArrayHasKey('interactions', $defaultValues);

        $this->assertEquals(0, $defaultValues['id_request']);
        $this->assertEquals('fr', $defaultValues['request_language']);
        $this->assertEquals('', $defaultValues['request_text']);
        $this->assertEquals(0.0, $defaultValues['time_ai']);
        $this->assertEquals(0.0, $defaultValues['time_total']);
        $this->assertEquals(array(), $defaultValues['interactions']);
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     *
     * @throws \Exception
     */
    public function responseDataProvider()
    {
        return [
            [
                1,
                'en',
                'Hello I\'m a text request',
                \rand(0, 500),
                \rand(0, 500),
            ]
        ];
    }
}