<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResponseDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
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
        $data['interactions'] = $this->denormalizer
            ->denormalize($data,
                Interaction::class,
                $format,
                $context
            )
        ;

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
        ;
    }
}