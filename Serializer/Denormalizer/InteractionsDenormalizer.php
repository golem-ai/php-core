<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class InteractionsDenormalizer implements DenormalizerInterface
{
    /**
     * @var DenormalizerPropertyHandlerInterface[]
     */
    private $propertyHandlers;

    /**
     * ResponseDenormalizer constructor.
     */
    public function __construct()
    {
        $this->propertyHandlers = [];
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        foreach ($this->propertyHandlers as $handler) {
            if ($handler->canHandle($data)) {
                return $handler->handle($data);
            }
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return \is_array($data)
            && Interaction::class === $type
        ;
    }

    public function addHandler(DenormalizerPropertyHandlerInterface $handler)
    {
        $this->propertyHandlers[] = $handler;
    }
}