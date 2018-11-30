<?php

namespace GolemAi\Core\Factory\Entity\Request;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;

class RequestDataFactory implements EntityFactoryInterface
{
    /**
     * @param array $args
     *
     * @return RequestData
     */
    public function create(array $args)
    {
        return new RequestData(
            isset($args['token']) ? $args['token'] : '',
            isset($args['text']) ? $args['text'] : '',
            isset($args['language']) ? $args['language'] : 'fr',
            isset($args['type']) ? $args['type'] : RequestData::REQUEST_TYPE,
            isset($args['labelling']) ? $args['labelling'] : false,
            isset($args['parametersDetail']) ? $args['parametersDetail'] : true,
            isset($args['disableVerbose']) ? $args['disableVerbose'] : true,
            isset($args['multipleInteractionSearch']) ? $args['multipleInteractionSearch'] : false
        );
    }
}