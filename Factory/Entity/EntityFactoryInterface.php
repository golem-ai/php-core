<?php


namespace GolemAi\Core\Factory\Entity;


interface EntityFactoryInterface
{
    /**
     * @param array $args
     * @return mixed
     */
    public function create(array $args);
}