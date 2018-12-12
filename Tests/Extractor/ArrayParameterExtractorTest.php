<?php

namespace GolemAi\Core\Tests\Extractor;

use GolemAi\Core\Extractor\ArrayParameterExtractor;
use PHPUnit\Framework\TestCase;

class ArrayParameterExtractorTest extends TestCase
{
    public function testExtractValue()
    {
        $extractor = new ArrayParameterExtractor();

        $response = ['param1' => 'ok', 'param2' => 'ol'];
        $value = $extractor->extractValue($response);

        $this->assertTrue(\is_array($value));
        $this->assertEquals($response, $value);
    }

    /**
     * @dataProvider supportsDataProvider
     *
     * @param $value
     * @param $result
     */
    public function testSupports($value, $result)
    {
        $extractor = new ArrayParameterExtractor();

        $this->assertEquals($extractor->supports($value), $result);
    }

    public function supportsDataProvider()
    {
        return [
            [1, false],
            ["2", false],
            [true, false],
            [false, false],
            [[], false],
            [[1], false],
            [[1, 2], true],
            [["sdf", "987s"], true],
            [["sdf", 1], true],
        ];
    }
}