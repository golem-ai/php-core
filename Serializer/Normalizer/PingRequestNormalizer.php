<?php

namespace GolemAi\Core\Serializer\Normalizer;

use GolemAi\Core\Entity\RequestData;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PingRequestNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($data, $format = null, array $context = array())
    {
        return [
            'token' => $data->getToken(),
            'type' => $data->getType(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = array())
    {
        return
            $data instanceof RequestData
            && $data->getType() === RequestData::PING_TYPE
        ;
    }
}