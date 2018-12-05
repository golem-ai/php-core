<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Parameter;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ParameterDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $parameters = [];

        foreach ($data as $parameterName => $value) {
            if (count($value) === 1) {
                $value = $value[0];
            }

            $parameters[] = new Parameter($parameterName, $value);
        }

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return
            \is_array($data)
            && Parameter::class === $type
        ;
    }
}