<?php


namespace GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction;


use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;

class CallsPropertyHandler implements DenormalizerPropertyHandlerInterface
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
        return isset($data['calls'])
            && \is_array($data['calls'])
        ;
    }

    /**
     * @return mixed
     */
    public function handle(array $data)
    {
        $interactions = [];

        foreach ($data['calls'] as $call) {
            $interactions[] = $this->factory->create($call);
        }

        return $interactions;
    }
}