<?php

namespace GolemAi\Core\Extractor;

class NullParameterExtractor implements ParametersDataExtractorInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function extractValue($value)
    {
        return null;
    }

    public function supports($value)
    {
        return null === $value;
    }
}