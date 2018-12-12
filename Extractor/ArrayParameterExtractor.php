<?php

namespace GolemAi\Core\Extractor;

class ArrayParameterExtractor implements ParametersDataExtractorInterface
{
    /**
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function extractValue($value)
    {
        return $value;
    }

    public function supports($value)
    {
        return \is_array($value) && \count($value) > 1;
    }
}