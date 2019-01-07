<?php

namespace GolemAi\Core\Tests\Converter;

use GolemAi\Core\Converter\SnakeToCamelConverter;
use PHPUnit\Framework\TestCase;

class SnakeToCamelConverterTest extends TestCase
{
    /**
     * @var SnakeToCamelConverter
     */
    private $converter;

    public function setUp()
    {
        $this->converter = new SnakeToCamelConverter();
    }

    /**
     * @param $value
     * @param $result
     *
     * @dataProvider snakeCaseData
     */
    public function testIsSnakeCase($value, $result)
    {
        $this->assertEquals($result, $this->converter->isSnakeCase($value));
    }

    public function snakeCaseData()
    {
        return array(
            array(1, false),
            array('hello', false),
            array('helloIAmCamelCase', false),
            array('hello_i_am_snake_case', true),
            array('hello-i-am-kebab-case', false),
        );
    }

    /**
     * @param $value
     * @param $output
     *
     * @dataProvider convertData
     */
    public function testConvert($value, $output)
    {
        $this->assertEquals($output, $this->converter->convert($value));
    }

    public function convertData()
    {
        return array(
            array(1, 1),
            array('helloIAmCamelCase', 'helloIAmCamelCase'),
            array('hello_i_am_snake_case', 'helloIAmSnakeCase'),
        );
    }
}