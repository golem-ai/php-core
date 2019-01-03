<?php

namespace GolemAi\Core\Tests\Serializer\Encoder;

use GolemAi\Core\Entity\Response;
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

    /**
     * @var StreamInterface
     */
    private $stream;
    /**
     * @var ResponseInterface
     */
    private $request;

    public function setUp()
    {
        $jsonEncoder = new JsonEncoder();

        $this->encoder = new ResponseEncoder($jsonEncoder);

        $this->stream = $this->getMockBuilder(StreamInterface::class)
            ->setMethods(['getContents', '__toString'])
            ->getMockForAbstractClass()
        ;

        $this->request = $this->getMockBuilder(ResponseInterface::class)
            ->setMethods([
                'getBody',
                'getStatusCode',
            ])
            ->getMockForAbstractClass()
        ;

        $this->request->method('getBody')->willReturn($this->stream);
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
        $this->stream->method('getContents')->willReturn('{"type":"answer", "i_am":"a_json"}');
        $this->stream->method('__toString')->willReturn('{"type":"answer", "i_am":"a_json"}');

        $statusCode = \rand(200,400);
        $this->request->method('getStatusCode')->willReturn($statusCode);

        $data = $this->encoder->decode($this->request, 'json');

        $this->assertTrue(is_array($data));
        $this->assertArrayHasKey('type', $data);
        $this->assertEquals('answer', $data['type']);
        $this->assertArrayHasKey('i_am', $data);
        $this->assertEquals('a_json', $data['i_am']);
        $this->assertArrayHasKey('status_code', $data);
        $this->assertEquals($statusCode, $data['status_code']);
    }

    public function testDecodeWithErrorResponseInterface()
    {
        $this->stream->method('getContents')->willReturn('{"type":"'.Response::ERROR_TYPE.'", "i_am":"a_json"}');
        $this->stream->method('__toString')->willReturn('{"type":"'.Response::ERROR_TYPE.'", "i_am":"a_json"}');

        $data = $this->encoder->decode($this->request, 'json');

        $this->assertTrue(is_array($data));
        $this->assertArrayHasKey('type', $data);
        $this->assertEquals(Response::ERROR_TYPE, $data['type']);
        $this->assertArrayHasKey('i_am', $data);
        $this->assertEquals('a_json', $data['i_am']);
        $this->assertArrayNotHasKey('status_code', $data);
    }

    public function testDecodeWithoutResponseInterface()
    {
        $this->expectException(\InvalidArgumentException::class);
        $request = new \stdClass();

        $this->encoder->decode($request, 'json');
    }
}