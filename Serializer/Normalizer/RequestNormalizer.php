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
            'conversation_mode' => $data->isConversationMode(),
            'disable_verbose' => $data->isDisableVerbose(),
            'labelling' => $data->isLabelling(),
            'language' => $data->getLanguage(),
            'multiple_interaction_search' => $data->isMultipleInteractionSearch(),
            'parameters_detail' => $data->isParametersDetail(),
            'text' => $data->getText(),
            'token' => $data->getToken(),
            'type' => $data->getType(),
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