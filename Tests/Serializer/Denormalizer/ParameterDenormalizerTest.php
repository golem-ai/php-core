<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Extractor\ArrayParameterExtractor;
use GolemAi\Core\Extractor\NullParameterExtractor;
use GolemAi\Core\Extractor\ScalarParameterExtractor;
use GolemAi\Core\Serializer\Denormalizer\ParameterDenormalizer;
use PHPUnit\Framework\TestCase;

class ParameterDenormalizerTest extends TestCase
{
    /**
     * @var ParameterDenormalizer
     */
    private $denormalizer;

    protected function setUp()
    {
        $extractor = new ArrayParameterExtractor();
        $this->denormalizer = new ParameterDenormalizer();
        $this->denormalizer->addExtractor($extractor);
        $extractor = new NullParameterExtractor();
        $this->denormalizer->addExtractor($extractor);
        $extractor = new ScalarParameterExtractor();
        $this->denormalizer->addExtractor($extractor);
    }

    public function testDeserialize()
    {
        $parameters = $this->denormalizer->denormalize([], Parameter::class);

        $this->assertTrue(\is_array($parameters));

        $dateArray = [
            'day' => 1,
            'month' => 12,
            'year' => 2018,
        ];
        $data = [
            'arrival_town' => ['Rouen'],
            'departure_town' => ['Paris'],
            'departure_date' => $dateArray,
        ];
        $parameters = $this->denormalizer->denormalize($data, Parameter::class);
        $this->assertEquals('arrival_town', $parameters[0]->getName());
        $this->assertEquals('Rouen', $parameters[0]->getValue());
        $this->assertEquals('departure_town', $parameters[1]->getName());
        $this->assertEquals('Paris', $parameters[1]->getValue());
        $this->assertEquals('departure_date', $parameters[2]->getName());
        $this->assertEquals($dateArray, $parameters[2]->getValue());
    }

    public function testSupportsDenormalization()
    {
        $this->assertTrue($this->denormalizer->supportsDenormalization([], Parameter::class));
        $this->assertFalse($this->denormalizer->supportsDenormalization('', Parameter::class));
        $this->assertFalse($this->denormalizer->supportsDenormalization([], 'hola'));
    }
}