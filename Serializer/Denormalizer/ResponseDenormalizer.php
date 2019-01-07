<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
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
        $data = $this->getResponseData($data, $format, $context);

        return $this->entityFactory->create(array_merge($data, ['class' => Response::class]));
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return \is_array($data)
            && Response::class === $type
            && isset($data['type'])
            && $data['type'] === Response::ANSWER_TYPE
        ;
    }

    private function getResponseData($data, $format = null, array $context = array()) {
        $data['data'] = $this->denormalizer
            ->denormalize(
                $data,
                ResponseData::class,
                $format,
                $context
            )
        ;

        return $data;
    }
}