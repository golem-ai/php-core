<?php

namespace GolemAi\Core\Tests\Serializer\Normalizer;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Serializer\Normalizer\RequestNormalizer;
use PHPUnit\Framework\TestCase;

class RequestNormalizerTest extends TestCase
{
    /**
     * @var RequestNormalizer
     */
    private $normalizer;

    public function setUp()
    {
        $this->normalizer = new RequestNormalizer();
    }

    public function testNormalize()
    {
        $data = new RequestData();
        $output = $this->normalizer->normalize($data, 'json');

        $this->assertTrue(\is_array($output));
        $this->assertTrue(isset($output['token']));
        $this->assertEquals($data->getToken(), $output['token']);
        $this->assertTrue(isset($output['text']));
        $this->assertEquals($data->getText(), $output['text']);
        $this->assertTrue(isset($output['language']));
        $this->assertEquals($data->getLanguage(), $output['language']);
        $this->assertTrue(isset($output['labelling']));
        $this->assertEquals($data->isLabelling(), $output['labelling']);
        $this->assertTrue(isset($output['parameters_detail']));
        $this->assertEquals($data->hasParametersDetail(), $output['parameters_detail']);
        $this->assertTrue(isset($output['disable_verbose']));
        $this->assertEquals($data->isDisableVerbose(), $output['disable_verbose']);
        $this->assertTrue(isset($output['multiple_interaction_search']));
        $this->assertEquals($data->isMultipleInteractionSearch(), $output['multiple_interaction_search']);
    }

    public function testSupportsNormalization()
    {
        $data = [];
        $this->assertFalse($this->normalizer->supportsNormalization($data, 'json'));

        $data = new RequestData();
        $this->assertTrue($this->normalizer->supportsNormalization($data, 'json'));
    }
}