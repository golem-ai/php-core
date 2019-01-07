<?php


namespace GolemAi\Core\Serializer\Denormalizer\PropertyHandler\Interaction;


use GolemAi\Core\Entity\Interaction;
use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Factory\Entity\EntityFactoryInterface;
use GolemAi\Core\Serializer\Denormalizer\PropertyHandler\DenormalizerPropertyHandlerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class CallPropertyHandler implements DenormalizerPropertyHandlerInterface
{
    use DenormalizerAwareTrait;

    const PROPERTY = 'call';

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
        if (isset($data[self::PROPERTY]['parameters'])) {
            $parameters = $this->denormalizer->denormalize($data[self::PROPERTY]['parameters'], Parameter::class);
            $data[self::PROPERTY]['parameters'] = $parameters;
        }

        return [$this->factory->create(
            array_merge($data[self::PROPERTY], ['class' => Interaction::class])
        )];
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return self::PROPERTY;
    }
}