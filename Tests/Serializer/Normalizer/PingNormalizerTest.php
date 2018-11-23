<?php

namespace GolemAi\Core\Tests\Serializer\Normalizer;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Serializer\Normalizer\PingRequestNormalizer;
use GolemAi\Core\Serializer\Normalizer\RequestNormalizer;
use PHPUnit\Framework\TestCase;

class PingNormalizerTest extends TestCase
{
    /**
     * @var RequestNormalizer
     */
    private $normalizer;

    public function setUp()
    {
        $this->normalizer = new PingRequestNormalizer();
    }

    public function testNormalize()
    {
        $data = new RequestData(
            '',
            '',
            'fr',
            RequestData::PING_TYPE
        );
        $output = $this->normalizer->normalize($data, 'json');

        $this->assertTrue(\is_array($output));
        $this->assertTrue(isset($output['token']));
        $this->assertEquals($data->getToken(), $output['token']);
        $this->assertTrue(isset($output['type']));
        $this->assertEquals($data->getType(), $output['type']);
    }

    public function testSupportsNormalization()
    {
        $data = [];
        $this->assertFalse($this->normalizer->supportsNormalization($data, 'json'));

        $data = new RequestData();
        $this->assertFalse($this->normalizer->supportsNormalization($data, 'json'));

        $data = new RequestData(
            '',
            '',
            'fr',
            RequestData::PING_TYPE
        );
        $this->assertTrue($this->normalizer->supportsNormalization($data, 'json'));
    }
}