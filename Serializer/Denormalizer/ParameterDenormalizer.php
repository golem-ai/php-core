<?php

namespace GolemAi\Core\Serializer\Denormalizer;

use GolemAi\Core\Entity\Parameter;
use GolemAi\Core\Extractor\ParametersDataExtractorInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ParameterDenormalizer implements DenormalizerInterface
{
    /**
     * @var ParametersDataExtractorInterface[]
     */
    private $dataExtractors;

    public function __construct()
    {
        $this->dataExtractors = [];
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $parameters = [];

        foreach ($data as $parameterName => $value) {
            $parameters[] = new Parameter(
                $parameterName,
                $this->extractValue($value)
            );
        }

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return
            \is_array($data)
            && Parameter::class === $type
        ;
    }

    /**
     * @param ParametersDataExtractorInterface $dataExtractor
     */
    public function addExtractor(ParametersDataExtractorInterface $dataExtractor)
    {
        $this->dataExtractors[] = $dataExtractor;
    }

    /**
     * @param $value
     * @return mixed|null
     */
    private function extractValue($value)
    {
        $finalValue = null;

        foreach ($this->dataExtractors as $dataExtractor) {
            if ($dataExtractor->supports($value)) {
                $finalValue = $dataExtractor->extractValue($value);
                break;
            }
        }

        return $finalValue;
    }
}