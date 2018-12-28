<?php

namespace GolemAi\Core\Tests\Serializer\Denormalizer;

use GolemAi\Core\Entity\ErrorResponse;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Response\ErrorResponseFactory;
use GolemAi\Core\Serializer\Denormalizer\ErrorResponseDenormalizer;
use PHPUnit\Framework\TestCase;

class ErrorResponseDenormalizerTest extends TestCase
{
    /**
     * @var ErrorResponseDenormalizer
     */
    private $denormalizer;

    /**
     * @var EntityFactoryInterface
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ErrorResponseFactory();
        $this->denormalizer = new ErrorResponseDenormalizer(
            $this->factory
        );
    }

    public function testDenormalize()
    {
        $output = $this->denormalizer->denormalize([
            'status_code' => 200,
            'type' => ''
        ], Response::class, 'json');
        $entity = $this->factory->create([
            'status_code' => 200
        ]);

        $this->assertInstanceOf(get_class($entity), $output);

        $output = $this->denormalizer->denormalize([
            'status_code' => 500,
            'type' => 'error',
            'error_code' => 456,
            'error_message' => 'This is an error message',
            'error_detail' => 'This could be anything',
        ], Response::class, 'json');


        $this->assertInstanceOf(ErrorResponse::class, $output);
        $this->assertEquals(456, $output->getErrorCode());
        $this->assertEquals('This is an error message', $output->getErrorMessage());
        $this->assertEquals('This could be anything', $output->getErrorDetail());
    }

    public function testSupportsDenormalization()
    {
        $data = [
            'type' => Response::ERROR_TYPE,
        ];
        $this->assertTrue($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [
            'type' => Response::PONG_TYPE
        ];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [
            'type' => 'toto'
        ];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));

        $data = [];
        $this->assertFalse($this->denormalizer->supportsDenormalization($data, Response::class, 'json'));
    }
}