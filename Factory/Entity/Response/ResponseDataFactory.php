<?php

namespace GolemAi\Core\Factory\Entity\Response;

use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\OptionsResolverAwareTrait;

class ResponseDataFactory implements EntityFactoryInterface
{
    use OptionsResolverAwareTrait;

    /**
     * @param array $args
     *
     * @return ResponseData
     */
    public function create(array $args)
    {
        $this->configureOptions();

        $args = $this->optionsResolver->resolve($args);

        return new ResponseData(
            $args['id_request'],
            $args['request_language'],
            $args['request_text'],
            $args['time_ai'],
            $args['time_total'],
            $args['interactions'],
            $args['verbose_available_interactions'],
            $args['helper_message'],
            $args['conversation_code'],
            $args['labels']
        );
    }

    public function getFieldsDefault()
    {
        return array(
            'id_request' => 0,
            'request_language' => 'fr',
            'request_text' => '',
            'time_ai' => 0.0,
            'time_total' => 0.0,
            'interactions' => array(),
            'verbose_available_interactions' => array(),
            'helper_message' => '',
            'conversation_code' => 0,
            'labels' => array(),
        );
    }
}
