<?php


namespace GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction;


use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;

class CallPropertyHandler implements DenormalizerPropertyHandlerInterface
{
    private $factory;

    /**
     * CallPropertyHandler constructor.
     *
     * @param EntityFactoryInterface $factory
     */
    public function __construct(EntityFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function canHandle(array $data)
    {
        return isset($data['call'])
            && \is_array($data['call'])
        ;
    }

    /**
     * @return mixed
     */
    public function handle(array $data)
    {
        return [$this->factory->create($data['call'])];
    }
}