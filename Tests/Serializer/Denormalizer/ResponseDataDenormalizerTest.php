<?php


namespace GolemAi\Core\Tests\Serializer\Denormalizer;


use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\Entity\Interaction\InteractionFactory;
use GolemAi\Core\Factory\Entity\Response\ResponseDataFactory;
use GolemAi\Core\Serializer\Denormalizer\InteractionsDenormalizer;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction\CallsPropertyHandler;
use GolemAi\Core\Serializer\Denormalizer\ResponseDataDenormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResponseDataDenormalizerTest extends TestCase
{
    /**
     * @var ResponseDataDenormalizer
     */
    private $denormalizer;

    /**
     * @var EntityFactoryInterface
     */
    private $entityFactory;

    public function setUp()
    {
        $this->entityFactory = new ResponseDataFactory();

        $interactionFactory = new InteractionFactory();
        $interactionDenormalizer = new InteractionsDenormalizer();
        $interactionDenormalizer->addHandler(new CallPropertyHandler($interactionFactory));
        $interactionDenormalizer->addHandler(new CallsPropertyHandler($interactionFactory));

        $this->denormalizer = new ResponseDataDenormalizer($this->entityFactory);
        $this->denormalizer->setDenormalizer($interactionDenormalizer);
    }

    public function testDenormalize()
    {
        $responseData = $this->denormalizer->denormalize([], ResponseData::class);

        $this->assertInstanceOf(ResponseData::class, $responseData);
        $this->assertTrue(is_array($responseData->getInteractions()));
    }

    public function testSupportsDenormalization()
    {
        $this->assertTrue($this->denormalizer->supportsDenormalization([], ResponseData::class));
        $this->assertFalse($this->denormalizer->supportsDenormalization('tete', ResponseData::class));
    }
}