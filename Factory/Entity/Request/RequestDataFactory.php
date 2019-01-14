<?php

namespace GolemAi\Core\Factory\Entity\Request;

use GolemAi\Core\Entity\RequestData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\OptionsResolverAwareTrait;

class RequestDataFactory implements EntityFactoryInterface
{
    use OptionsResolverAwareTrait;

    /**
     * @param array $args
     *
     * @return RequestData
     */
    public function create(array $args)
    {
        $this->configureOptions();
        $args = $this->optionsResolver->resolve($args);

        return new RequestData(
            $args['token'],
            $args['text'],
            $args['language'],
            $args['type'],
            $args['labelling'],
            $args['parameters_detail'],
            $args['disable_verbose'],
            $args['multiple_interaction_search'],
            $args['conversation_mode'],
            $args['conversation_code']
        );
    }

    public function getRequiredFields()
    {
        return array(
            'token',
            'text',
        );
    }

    public function getDefinedFields()
    {
        return array(
            'language',
            'type',
            'labelling',
            'parameters_detail',
            'disable_verbose',
            'multiple_interaction_search',
            'conversation_mode',
            'conversation_code'
        );
    }

    public function getFieldsDefault()
    {
        return array(
            'language' => 'fr',
            'type' => RequestData::REQUEST_TYPE,
            'labelling' => false,
            'parameters_detail' => true,
            'disable_verbose' => true,
            'multiple_interaction_search' => false,
            'conversation_mode' => false,
            'conversation_code' => ''
        );
    }
}