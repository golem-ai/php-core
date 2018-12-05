<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
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
        $interactions = [];
        foreach ($this->propertyHandlers as $handler) {
            if ($handler->canHandle($data)) {
                $interaction = $handler->handle($data);
                $interactions = \array_merge($interaction, $interactions);
            }
        }

        return $interactions;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        if (!\is_array($data) || Interaction::class !== $type) {
            return false;
        }

        foreach ($this->propertyHandlers as $handler) {
            if ($handler->canHandle($data)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param DenormalizerPropertyHandlerInterface $handler
     */
    public function addHandler(DenormalizerPropertyHandlerInterface $handler)
    {
        $this->propertyHandlers[] = $handler;
    }
}