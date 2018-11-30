<?php


namespace GolemAi\Core\Serializer\Denormalizer\PropertyHandler;


interface DenormalizerPropertyHandlerInterface
{
    /**
     * @param $data
     *
     * @return bool
     */
    public function canHandle(array $data);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function handle(array $data);
}