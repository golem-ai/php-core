<?php

namespace GolemAi\Core\Factory\Entity\Interaction;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\OptionsResolverAwareTrait;

class InteractionFactory implements EntityFactoryInterface
{
    use OptionsResolverAwareTrait;

    /**
     * @param array $args
     *
     * @return Interaction
     */
    public function create(array $args)
    {
        $this->configureOptions();
        $args = $this->optionsResolver->resolve($args);

        return new Interaction(
            $args['id_interaction'],
            $args['id_context'],
            $args['parameters'],
            $args['parameters_detail'],
            $args['incomplete'],
            $args['id_missing_parameters'],
            $args['verbose_interaction'],
            $args['verbose_missing_parameters'],
            $args['helper_message']
        );
    }

    public function getDefinedFields()
    {
        return array();
    }

    public function getFieldsDefault()
    {
        return array(
            'id_interaction' => 0,
            'id_context' => '',
            'parameters' => array(),
            'parameters_detail' => array(),
            'incomplete' => false,
            'id_missing_parameters' => array(),
            'verbose_interaction' => '',
            'verbose_missing_parameters' => array(),
            'helper_message' => '',
        );
    }
}