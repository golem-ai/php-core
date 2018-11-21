<?php

namespace GolemAi\Core\Factory\Entity\Response;

use GolemAi\Core\Entity\Response;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;

class ResponseFactory implements EntityFactoryInterface
{
    public function create(array $args)
    {
        return new Response(
            (int) $args['id_request'] ?? 0,
            $args['type'] ?? '',
            $args['request_language'] ?? 'fr',
            $args['request_text'] ?? '',
            (float) $args['time_ai'] ?? 0,
            (float) $args['time_total'] ?? 0,
            $args['interactions'] ?? []
        );
    }
}