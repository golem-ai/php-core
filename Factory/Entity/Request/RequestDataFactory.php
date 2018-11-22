<?php

namespace GolemAi\Core\Factory\Entity\Request;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;

class RequestDataFactory implements EntityFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(array $args)
    {
        return new RequestData(
            $args['token'] ?? '',
            $args['text'] ?? '',
            $args['language'] ?? 'fr',
            $args['type'] ?? 'request',
            $args['labelling'] ?? false,
            $args['parametersDetail'] ?? true,
            $args['disableVerbose'] ?? true,
            $args['multipleInteractionSearch'] ?? false
        );
    }
}