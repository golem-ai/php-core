<?php

namespace GolemAi\Core\Factory\Entity\Response;

use GolemAi\Core\Entity\ErrorResponse;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Factory\OptionsResolverAwareTrait;

class ErrorResponseFactory implements EntityFactoryInterface
{
    use OptionsResolverAwareTrait;

    /**
     * @param array $args
     *
     * @return ErrorResponse
     */
    public function create(array $args)
    {
        return new ErrorResponse(
            isset($args['error_code']) ? $args['error_code'] : 0,
            isset($args['error_message']) ? $args['error_message'] : '',
            isset($args['error_detail']) ? $args['error_detail'] : ''
        );
    }

    public function getRequiredFields()
    {
        return array(
            'error_code',
            'error_message',
        );
    }

    public function getDefinedFields()
    {
        return array(
            'error_detail',
        );
    }
}