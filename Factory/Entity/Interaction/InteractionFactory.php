<?php

namespace GolemAi\Core\Factory\Entity\Interaction;

use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;

class InteractionFactory implements EntityFactoryInterface
{
    public function create(array $args)
    {
        return new Interaction(
            $args['id_interaction'] ?? 0,
            $args['id_context'] ?? '',
            $args['parameters'] ?? [],
            $args['incomplete'] ?? false
        );
    }
}