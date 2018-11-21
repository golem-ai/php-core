<?php


namespace GolemAi\Core\Serializer\Denormalizer\PropertyHandler;


interface PropertyHandlerInterface
{
    /**
     * @param $data
     *
     * @return bool
     */
    public function canHandle(array $data): bool;

    /**
     * @param $data
     *
     * @return mixed
     */
    public function handle(array $data);
}