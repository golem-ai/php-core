<?php


namespace GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction;


use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class CallsPropertyHandler implements DenormalizerPropertyHandlerInterface
{
    use DenormalizerAwareTrait;

    const PROPERTY = 'calls';
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
        return isset($data[self::PROPERTY])
            && \is_array($data[self::PROPERTY])
        ;
    }

    /**
     * @return mixed
     */
    public function handle(array $data)
    {
        $interactions = [];

        foreach ($data[self::PROPERTY] as $call) {
            if (isset($call['parameters'])) {
                $call['parameters'] = $this->denormalizer->denormalize($call['parameters'], Parameter::class);
            }

            $interactions[] = $this->factory->create($call);
        }

        return $interactions;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return self::PROPERTY;
    }
}