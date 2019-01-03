<?php

namespace GolemAi\Core\Tests\Extractor;

use GolemAi\Core\Extractor\ScalarParameterExtractor;
use PHPUnit\Framework\TestCase;

class ScalarParameterExtractorTest extends TestCase
{
    public function testExtractValue()
    {
        $extractor = new ScalarParameterExtractor();

        $response = ['youhou'];
        $value = $extractor->extractValue($response);

        $this->assertTrue(\is_string($value));
        $this->assertEquals($response[0], $value);
    }

    /**
     * @dataProvider supportsDataProvider
     *
     * @param $value
     * @param $result
     */
    public function testSupports($value, $result)
    {
        $extractor = new ScalarParameterExtractor();

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
            [[1], true],
            [[1, 2], false],
            [["sdf", "987s"], false],
            [["sdf", 1], false],
        ];
    }
}