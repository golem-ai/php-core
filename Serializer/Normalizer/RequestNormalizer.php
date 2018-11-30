<?php

namespace GolemAi\Core\Serializer\Normalizer;

use GolemAi\Core\Entity\RequestData;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RequestNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($data, $format = null, array $context = array())
    {
        return [
            'token' => $data->getToken(),
            'text' => $data->getText(),
            'language' => $data->getLanguage(),
            'type' => $data->getType(),
            'labelling' => $data->isLabelling(),
            'parameters_detail' => $data->isParametersDetail(),
            'disable_verbose' => $data->isDisableVerbose(),
            'multiple_interaction_search' => $data->isMultipleInteractionSearch(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = array())
    {
        return $data instanceof RequestData;
    }
}