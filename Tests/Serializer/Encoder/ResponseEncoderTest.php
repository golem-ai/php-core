<?php

namespace GolemAi\Core\Tests\Serializer\Encoder;

use GolemAi\Core\Serializer\Encoder\ResponseEncoder;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ResponseEncoderTest extends TestCase
{
    /**
     * @var ResponseEncoder
     */
    private $encoder;

    public function setUp()
    {
        $jsonEncoder = new JsonEncoder();

        $this->encoder = new ResponseEncoder($jsonEncoder);
    }

    public function testSupportsDecoding()
    {
        $this->assertTrue($this->encoder->supportsDecoding('golem_response'));
        $this->assertFalse($this->encoder->supportsDecoding('json'));
    }

    public function testSupportsEncoding()
    {
        $this->assertTrue($this->encoder->supportsEncoding('json'));
        $this->assertFalse($this->encoder->supportsEncoding('golem_response'));
    }

    public function testEncode()
    {
        $jsonEncoder = new JsonEncoder();
        $data = ['tata', 'toto'];

        $this->assertEquals(
            $jsonEncoder->encode($data, 'json'),
            $this->encoder->encode($data, 'json')
        );
    }

    public function testDecodeWithResponseInterface()
    {
        $stream = $this->getMockBuilder(StreamInterface::class)
            ->setMethods(['getContents', '__toString'])
            ->getMockForAbstractClass()
        ;
        $stream->method('getContents')->willReturn('{"i_am":"a_json"}');
        $stream->method('__toString')->willReturn('{"i_am":"a_json"}');

        $statusCode = \rand(200,400);
        $request = $this->getMockBuilder(ResponseInterface::class)
            ->setMethods([
                'getBody',
                'getStatusCode',
            ])
            ->getMockForAbstractClass()
        ;


        $request->method('getBody')->willReturn($stream);
        $request->method('getStatusCode')->willReturn($statusCode);

        $data = $this->encoder->decode($request, 'json');

        $this->assertTrue(is_array($data));
        $this->assertArrayHasKey('i_am', $data);
        $this->assertEquals('a_json', $data['i_am']);
        $this->assertArrayHasKey('status_code', $data);
        $this->assertEquals($statusCode, $data['status_code']);
    }

    public function testDecodeWithoutResponseInterface()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $request = new \stdClass();

        $this->encoder->decode($request, 'json');
    }
}