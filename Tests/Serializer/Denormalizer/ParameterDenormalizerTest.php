<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Extractor\ParametersDataExtractorInterface;
use GolemAi\Core\Serializer\Denormalizer\ParameterDenormalizer;
use PHPUnit\Framework\TestCase;

class ParameterDenormalizerTest extends TestCase
{
    /**
     * @var ParameterDenormalizer
     */
    private $denormalizer;
    private $extractor;

    protected function setUp()
    {
        $this->extractor = $this->getMockBuilder(ParametersDataExtractorInterface::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->denormalizer = new ParameterDenormalizer();
        $this->denormalizer->addExtractor($this->extractor);
    }

    /**
     * @param $parameterName
     * @param $value
     *
     * @dataProvider extractorDataProvider
     */
    public function testDeserialize($value)
    {
        $parameters = $this->denormalizer->denormalize([], Parameter::class);
        $this->assertTrue(\is_array($parameters));

        $parameterName = random_bytes(10);
        $data = [
            $parameterName => $value,
        ];

        $this->extractor->method('supports')->willReturn(true);
        $this->extractor->method('extractValue')->willReturn($value);
        $parameters = $this->denormalizer->denormalize($data, Parameter::class);
        $this->assertEquals($parameterName, $parameters[0]->getName());
        $this->assertEquals($value, $parameters[0]->getValue());
    }

    public function extractorDataProvider()
    {
        return [
            ['Rouen'],
            ['Paris'],
            [[
                'day' => 1,
                'month' => 12,
                'year' => 2018,
            ]],
        ];
    }

    /**
     * @param $value
     * @throws \ReflectionException
     *
     * @dataProvider extractorDataProvider
     */
    public function testExtractValue($value)
    {
        $this->extractor->method('supports')->willReturn(true);
        $this->extractor->method('extractValue')->willReturn($value);

        $reflection = new \ReflectionClass($this->denormalizer);
        $methodReflection = $reflection->getMethod('extractValue');
        $methodReflection->setAccessible(true);

        $this->assertEquals($value, $methodReflection->invokeArgs($this->denormalizer, [$value]));
    }

    /**
     * @param $value
     * @throws \ReflectionException
     *
     * @dataProvider extractorDataProvider
     */
    public function testExtractValueWithoutExtractor($value)
    {
        $this->extractor->method('supports')->willReturn(false);

        $reflection = new \ReflectionClass($this->denormalizer);
        $methodReflection = $reflection->getMethod('extractValue');
        $methodReflection->setAccessible(true);

        $this->assertEquals(null, $methodReflection->invokeArgs($this->denormalizer, [$value]));
    }


    public function testSupportsDenormalization()
    {
        $this->assertTrue($this->denormalizer->supportsDenormalization([], Parameter::class));
        $this->assertFalse($this->denormalizer->supportsDenormalization('', Parameter::class));
        $this->assertFalse($this->denormalizer->supportsDenormalization([], 'hola'));
    }
}