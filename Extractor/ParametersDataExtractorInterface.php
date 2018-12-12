<?php

namespace GolemAi\Core\Extractor;

interface ParametersDataExtractorInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function extractValue($value);

    /**
     * @param $value
     * @return bool
     */
    public function supports($value);

}