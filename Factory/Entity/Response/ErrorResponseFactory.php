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
        $this->configureOptions();
        $args = $this->optionsResolver->resolve($args);

        return new ErrorResponse(
            $args['error_code'],
            $args['error_message'],
            $args['error_detail']
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

    public function getFieldsDefault()
    {
        return array(
            'error_detail' => ''
        );
    }
}