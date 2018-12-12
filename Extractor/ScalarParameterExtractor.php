<?php

namespace GolemAi\Core\Extractor;

class ScalarParameterExtractor implements ParametersDataExtractorInterface
{
    /**
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function extractValue($value)
    {
        return $value[0];
    }

    public function supports($value)
    {
        return \is_array($value) && \count($value) === 1;
    }
}