<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResponseDataDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    private $entityFactory;

    /**
     * ResponseDenormalizer constructor.
     * @param EntityFactoryInterface $entityFactory
     */
    public function __construct(EntityFactoryInterface $entityFactory)
    {
        $this->entityFactory = $entityFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        try {
            $data['interactions'] = $this->denormalizer
                ->denormalize($data,
                    Interaction::class,
                    $format,
                    $context
                )
            ;
        } catch (NotNormalizableValueException $exception) {
            $data['interactions'] = [];
        }

        $responseData = $this->entityFactory->create($data);

        return $responseData;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return \is_array($data)
            && ResponseData::class === $type
        ;
    }
}