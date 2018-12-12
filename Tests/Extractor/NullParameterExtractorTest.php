<?php

namespace GolemAi\Core\Tests\Extractor;

use GolemAi\Core\Extractor\NullParameterExtractor;
use PHPUnit\Framework\TestCase;

class NullParameterExtractorTest extends TestCase
{
    public function testExtractValue()
    {
        $extractor = new NullParameterExtractor();

        $this->assertNull($extractor->extractValue(null));
        $this->assertNull($extractor->extractValue(1));
        $this->assertNull($extractor->extractValue("sq321"));
        $this->assertNull($extractor->extractValue(new \stdClass()));
    }
}