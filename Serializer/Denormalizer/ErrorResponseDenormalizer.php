<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ErrorResponseDenormalizer implements DenormalizerInterface
{
    private $entityFactory;

    public function __construct(EntityFactoryInterface $entityFactory)
    {
        $this->entityFactory = $entityFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $response = $this->entityFactory->create($data);

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return \is_array($data)
            && Response::class === $type
            && isset($data['type'])
            && $data['type'] === Response::ERROR_TYPE
        ;
    }
}