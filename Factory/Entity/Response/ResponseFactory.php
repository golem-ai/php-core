<?php

namespace GolemAi\Core\Factory\Entity\Response;

use GolemAi\Core\Entity\Response;
use GolemAi\Core\Entity\ResponseData;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\OptionsResolverAwareTrait;

class ResponseFactory implements EntityFactoryInterface
{
    use OptionsResolverAwareTrait;

    /**
     * @param array $args
     *
     * @return Response
     */
    public function create(array $args)
    {
        $this->configureOptions();

        $args = $this->optionsResolver->resolve($args);

        return new Response(
            (int) $args['status_code'],
            $args['type'],
            $args['response_data']
        );
    }

    /**
     * @return array
     */
    public function getFieldsDefault()
    {
        return array(
            'status_code' => 200,
            'type' => '',
            'response_data' => null,
        );
    }

    /**
     * @return array
     */
    public function getFieldsType()
    {
        return array(
            'response_data' => array(
                ResponseData::class,
                'null',
            ),
        );
    }
}