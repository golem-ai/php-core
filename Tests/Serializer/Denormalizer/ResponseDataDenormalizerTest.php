<?php


namespace GolemAi\Core\Tests\Serializer\Denormalizer;


use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Factory\Entity\Response\ResponseDataFactory;
use GolemAi\Core\Serializer\Denormalizer\InteractionsDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\ResponseDataDenormalizer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResponseDataDenormalizerTest extends TestCase
{
    /**
     * @var ResponseDataDenormalizer
     */
    private $denormalizer;

    /**
     * @var MockObject
     */
    private $entityFactory;
    /**
     * @var MockObject
     */
    private $interactionDenormalizer;

    public function setUp()
    {
        $this->entityFactory = $this->getMockBuilder(EntityFactoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->interactionDenormalizer = $this->getMockBuilder(DenormalizerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->denormalizer = new ResponseDataDenormalizer($this->entityFactory);
        $this->denormalizer->setDenormalizer($this->interactionDenormalizer);
    }

    public function testDenormalize()
    {
        $object = new ResponseData();
        $this->entityFactory->method('create')->willReturn($object);
        $responseData = $this->denormalizer->denormalize([], ResponseData::class);

        $this->assertEquals($object, $responseData);
    }

    public function testDenormalizeWithException()
    {
        $object = new ResponseData();
        $this->entityFactory->method('create')->willReturn($object);

        $this->interactionDenormalizer->method('denormalize')->willThrowException(new NotNormalizableValueException());
        $responseData = $this->denormalizer->denormalize([], ResponseData::class);

        $this->assertEquals($object, $responseData);
        $this->assertTrue(is_array($responseData->getInteractions()));
    }

    public function testSupportsDenormalization()
    {
        $this->assertTrue($this->denormalizer->supportsDenormalization([], ResponseData::class));
        $this->assertFalse($this->denormalizer->supportsDenormalization('tete', ResponseData::class));
    }
}